<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\ProductProject;
use App\Models\Project;
use App\Services\ChangeLoggerService;
use App\Services\ChangeLogService;
use App\Services\ProjectService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use Inertia\Response;
use Throwable;

class ProjectController extends Controller
{
    public ProjectService $service;

    public function __construct()
    {
        $this->service = new ProjectService();
    }

    /**
     * Display a listing of the resource.
     *
     * @param  ?string  $slug
     * @return Response
     */
    public function index(?string $slug = null): Response
    {
        return Inertia::render('Projects/Index', [
            'dataTable'             => fn () => $this->service->getIndexMethodDataTable($slug),
            'showProductsDataTable' => Inertia::lazy(fn () => $this->service->getShowProductsDataTable()),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return Inertia::render('Projects/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreProjectRequest $request
     * @return RedirectResponse
     */
    public function store(StoreProjectRequest $request): RedirectResponse
    {
        DB::beginTransaction();

        try {
            $this->service->createProject($request);

            DB::commit();

            return redirect()->route('projects.edit', ['project' => $this->service->getProject()->id])->with('success', 'Записа беше създаден успешно.');
        } catch (Throwable $th) {
            DB::rollBack();

            Log::error($th->getMessage(), ['exception' => $th]);

            return redirect()->back()->withErrors(['Error creating record.']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  Project  $project
     * @return Response
     */
    public function show(Project $project): Response
    {
        $project->load(['changeLogsLimited']);

        return Inertia::render('Projects/Show', [
            'project'    => $project,
            'dataTable'  => fn () => $this->service->getProductsDataTable($project->id),
            'changeLogs' => Inertia::lazy(fn () => ChangeLogService::getChangeLogsDataTable($project)),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Project  $project
     * @return Response
     */
    public function edit(Project $project): Response
    {
        $project->load(['changeLogsLimited']);

        return Inertia::render('Projects/Edit', [
            'project'    => $project,
            'dataTable'  => fn () => $this->service->getProductsDataTable($project->id),
            'changeLogs' => Inertia::lazy(fn () => ChangeLogService::getChangeLogsDataTable($project)),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateProjectRequest $request
     * @param  Project              $project
     * @return RedirectResponse
     */
    public function update(UpdateProjectRequest $request, Project $project): RedirectResponse
    {
        DB::beginTransaction();

        try {
            $this->service->setProject($project)->updateProject($request);

            DB::commit();

            return back()->with('success', 'Записа беше актуализиран успешно.');
        } catch (Throwable $th) {
            DB::rollBack();

            Log::error($th->getMessage(), ['exception' => $th]);

            return redirect()->back()->withErrors(['Error updating record.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Project          $project
     * @return RedirectResponse
     */
    public function destroy(Project $project): RedirectResponse
    {
        try {
            $project->delete();

            return redirect()->back()->with('success', 'The record has been successfully deleted.');
        } catch (Throwable $th) {
            Log::error($th->getMessage(), ['exception' => $th]);

            return redirect()->back()->withErrors(['Error deleting record.']);
        }
    }

    /**
     * Remove product from project.
     *
     * @param  mixed            $request
     * @return RedirectResponse
     */
    public function destroyProduct(Request $request): RedirectResponse
    {
        try {
            $productProject = ProductProject::with('product.quantity', 'project:id,warehouse')->find($request->id);
            $product = $productProject->product;
            $changeLoggerService = new ChangeLoggerService($product, ['quantity']);

            $productQuantity = $product->quantity->where('warehouse', $productProject->project->warehouse)->first();
            $productQuantity->quantity = $productQuantity->quantity + $productProject->quantity;
            $productProject->delete();

            $productQuantity->save();

            $changeLoggerService->logChanges($product);

            return redirect()->back()->with('success', 'The record has been successfully deleted.');
        } catch (Throwable $th) {
            Log::error($th->getMessage(), ['exception' => $th]);

            return redirect()->back()->withErrors(['Error deleting record.']);
        }
    }
}

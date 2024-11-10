<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\ProductProject;
use App\Models\Project;
use App\Services\DataTable\DataTable;
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
     */
    public function index(): Response
    {
        return Inertia::render('Projects/Index', [
            'dataTable'             => fn () => $this->service->getIndexMethodDataTable(),
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

            return redirect()->route('projects.edit', ['project' => $this->service->getProject()->id])->with('success', 'The record has been successfully created.');
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
    public function show(Project $project)
    {
        $project->load(['changeLogs']);

        $dataTable = (new DataTable(
            ProductProject::where('project_id', $project->id)
        ))
            ->setRelation('creator')
            ->setRelation('product', ['id', 'name'])
            ->setColumn('id', '#', true, true)
            ->setColumn('creator.name', 'Creator', true, true)
            ->setColumn('product.name', 'Name', true, true)
            ->setColumn('quantity', 'Quantity', true, true)
            ->setColumn('created_at', 'Created', true, true)
            ->setDateColumn('created_at', 'dd.mm.YYYY H:i')
            ->run();

        return Inertia::render('Projects/Show', compact('project', 'dataTable'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Project  $project
     * @return Response
     */
    public function edit(Project $project): Response
    {
        $project->load(['changeLogs']);

        $dataTable = (new DataTable(
            ProductProject::where('project_id', $project->id)
        ))
            ->setRelation('creator')
            ->setRelation('product', ['id', 'name'])
            ->setColumn('id', '#', true, true)
            ->setColumn('creator.name', 'Creator', true, true)
            ->setColumn('product.name', 'Name', true, true)
            ->setColumn('quantity', 'Quantity', true, true)
            ->setColumn('created_at', 'Created', true, true)
            ->setColumn('action', 'Action')
            ->setDateColumn('created_at', 'dd.mm.YYYY H:i')
            ->run();

        return Inertia::render('Projects/Edit', compact('project', 'dataTable'));
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

            return back()->with('success', 'The record has been successfully updated.');
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
            $productProject = ProductProject::find($request->id);
            $productProject->delete();

            return redirect()->back()->with('success', 'The record has been successfully deleted.');
        } catch (Throwable $th) {
            Log::error($th->getMessage(), ['exception' => $th]);

            return redirect()->back()->withErrors(['Error deleting record.']);
        }
    }
}

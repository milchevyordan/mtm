<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\Warehouse;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;
use App\Services\DataTable\DataTable;
use App\Services\ProjectService;
use Illuminate\Http\RedirectResponse;
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
        $dataTable = (new DataTable(
            Project::query()
        ))
            ->setColumn('id', '#', true, true)
            ->setColumn('warehouse', 'Warehouse', true, true)
            ->setColumn('name', 'Name', true, true)
            ->setColumn('created_at', 'Date', true, true)
            ->setColumn('action', 'Action')
            ->setDateColumn('created_at', 'dd.mm.YYYY H:i')
            ->setEnumColumn('warehouse', Warehouse::class)
            ->run();

        return Inertia::render('Projects/Index', compact('dataTable'));
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
     * @param Project $project
     */
    public function show(Project $project)
    {
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

        return Inertia::render('Projects/Edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateProjectRequest $request
     * @param Project              $project
     */
    public function update(UpdateProjectRequest $request, Project $project)
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
     * @param Project $project
     */
    public function destroy(Project $project)
    {
    }
}

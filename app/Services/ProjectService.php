<?php

declare(strict_types=1);

namespace App\Services;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\ProductProject;
use App\Models\Project;
use App\Services\DataTable\DataTable;

class ProjectService
{
    /**
     * Context product.
     *
     * @var Project
     */
    private Project $model;

    /**
     * Get the value of model.
     *
     * @return Project
     */
    public function getProject(): Project
    {
        return $this->model;
    }

    /**
     * Set the value of model.
     *
     * @param  Project $model
     * @return self
     */
    public function setProject(Project $model): self
    {
        $this->model = $model;

        return $this;
    }

    /**
     * Create a new ProjectService instance.
     */
    public function __construct()
    {
        $this->setProject(new Project());
    }

    /**
     * Update the project.
     *
     * @param  StoreProjectRequest $request
     * @return self
     */
    public function createProject(StoreProjectRequest $request): self
    {
        $validatedRequest = $request->validated();

        $project = new Project();
        $project->fill($validatedRequest);
        $project->creator_id = auth()->id();
        $project->save();

        $this->setProject($project);

        return $this;
    }

    /**
     * Update the project.
     *
     * @param  UpdateProjectRequest $request
     * @return self
     */
    public function updateProject(UpdateProjectRequest $request): self
    {
        $project = $this->getProject();

        $changeLoggerService = new ChangeLoggerService($project);

        $validatedRequest = $request->validated();

        $project->update($validatedRequest);

        $changeLoggerService->logChanges($project);

        return $this;
    }

    /**
     * Return datatable of products connected to this project.
     *
     * @return null|DataTable
     */
    public function getShowProductsDataTable(): DataTable|null
    {
        $projectId = request()->input('project_id');

        if (! $projectId) {
            return null;
        }

        return (new DataTable(
            ProductProject::where('project_id', $projectId)
        ))
            ->setRelation('creator')
            ->setRelation('product', ['id', 'name'])
            ->setColumn('creator.name', 'Creator', true, true)
            ->setColumn('product.name', 'Name', true, true)
            ->setColumn('quantity', 'Quantity', true, true)
            ->setColumn('created_at', 'Date', true, true)
            ->setDateColumn('created_at', 'dd.mm.YYYY H:i')
            ->run();
    }
}

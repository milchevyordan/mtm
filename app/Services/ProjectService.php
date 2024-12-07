<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\ProductType;
use App\Enums\Warehouse;
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
     * @param  null|string $slug
     * @return DataTable
     */
    public function getIndexMethodDataTable(?string $slug): DataTable
    {
        $warehouseValue = $slug ? Warehouse::getCaseByName($slug)?->value : null;

        $dataTable = (new DataTable(
            Project::when($warehouseValue, function ($query) use ($warehouseValue) {
                $query->where('warehouse', $warehouseValue);
            })
        ))
            ->setColumn('id', '#', true, true);

        if (! $warehouseValue) {
            $dataTable->setColumn('warehouse', 'Склад', true, true)
                ->setEnumColumn('warehouse', Warehouse::class);
        }

        return $dataTable->setColumn('name', 'Име', true, true)
            ->setColumn('created_at', 'Създаден', true, true)
            ->setColumn('action', 'Действие')
            ->setDateColumn('created_at', 'dd.mm.YYYY H:i')
            ->run();
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

        return $this->getProductsDataTable($projectId);
    }

    /**
     * Return datatable of products connected to this project.
     *
     * @param            $projectId
     * @return DataTable
     */
    public function getProductsDataTable($projectId): DataTable
    {
        return (new DataTable(
            ProductProject::with('product')->where('project_id', $projectId)
        ))
            ->setRelation('creator')
            ->setRelation('product', ['id', 'name', 'type', 'internal_id'])
            ->setColumn('product.id', '#', true, true)
            ->setColumn('creator.name', 'Създател', true, true)
            ->setColumn('product.name', 'Име', true, true)
            ->setColumn('product.type', 'Тип', false, true)
            ->setColumn('product.internal_id', 'Вътрешно #', true, true)
            ->setColumn('quantity', 'Количество', true, true)
            ->setColumn('created_at', 'Добавен', true, true)
            ->setColumn('action', 'Действие')
            ->setDateColumn('created_at', 'dd.mm.YYYY H:i')
            ->setEnumColumn('product.type', ProductType::class)
            ->run();
    }
}

<?php

declare(strict_types=1);

namespace App\Services;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;

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
     * Update the product.
     *
     * @param  StoreProjectRequest $request
     * @return self
     */
    public function createProject(StoreProjectRequest $request): self
    {
        $validatedRequest = $request->validated();

        $product = new Project();
        $product->fill($validatedRequest);
        $product->creator_id = auth()->id();
        $product->save();

        $this->setProject($product);

        return $this;
    }

    /**
     * Update the product.
     *
     * @param  UpdateProjectRequest $request
     * @return self
     */
    public function updateProject(UpdateProjectRequest $request): self
    {
        $product = $this->getProject();

        $changeLoggerService = new ChangeLoggerService($product);

        $validatedRequest = $request->validated();

        $product->update($validatedRequest);

        $changeLoggerService->logChanges($product);

        return $this;
    }
}

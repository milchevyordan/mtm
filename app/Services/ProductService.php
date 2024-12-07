<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\ProductType;
use App\Enums\Warehouse;
use App\Events\MinimumQuantityReached;
use App\Http\Requests\AddProductToProjectRequest;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductQuantityRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Models\ProductProject;
use App\Models\ProductQuantity;
use App\Services\DataTable\DataTable;

class ProductService
{
    /**
     * Map of warehouse names to relations.
     *
     * @var array
     */
    private array $warehouseRelations = [
        Warehouse::Varna->name       => 'quantityVarna',
        Warehouse::France->name      => 'quantityFrance',
        Warehouse::Netherlands->name => 'quantityNetherlands',
    ];

    /**
     * Map of warehouse names to input column and name.
     *
     * @var array
     */
    private array $warehouseColumns = [
        Warehouse::Varna->name       => ['quantity_varna', 'Varna'],
        Warehouse::France->name      => ['quantity_france', 'France'],
        Warehouse::Netherlands->name => ['quantity_netherlands', 'Netherlands'],
    ];

    /**
     * Context product.
     *
     * @var Product
     */
    private Product $model;

    /**
     * Get the value of model.
     *
     * @return Product
     */
    public function getProduct(): Product
    {
        return $this->model;
    }

    /**
     * Set the value of model.
     *
     * @param  Product $model
     * @return self
     */
    public function setProduct(Product $model): self
    {
        $this->model = $model;

        return $this;
    }

    /**
     * Create a new ProductService instance.
     */
    public function __construct()
    {
        $this->setProduct(new Product());
    }

    /**
     * Create a new ProductService instance.
     *
     * @param  null|string $slug
     * @return DataTable
     */
    public function getIndexMethodDatatable(?string $slug): DataTable
    {
        $dataTable = (new DataTable(Product::query()))
            ->setRelation('quantity');

        if (isset($this->warehouseRelations[$slug])) {
            $dataTable->setRelation($this->warehouseRelations[$slug]);
        } else {
            foreach ($this->warehouseRelations as $relation) {
                $dataTable->setRelation($relation);
            }
        }

        $dataTable->setColumn('id', '№', true, true)
            ->setColumn('name', 'Име', true, true)
            ->setColumn('specification', 'Спецификация', true, true)
            ->setColumn('type', 'Тип', true, true)
            ->setColumn('internal_id', 'Вътрешен №', true, true);

        if (isset($this->warehouseColumns[$slug])) {
            [$column, $label] = $this->warehouseColumns[$slug];
            $dataTable->setColumn($column, $label);
        } else {
            foreach ($this->warehouseColumns as [$column, $label]) {
                $dataTable->setColumn($column, $label);
            }
        }

        return $dataTable
            ->setColumn('created_at', 'Създаден', true, true)
            ->setColumn('action', 'Действие')
            ->setDateColumn('created_at', 'dd.mm.YYYY H:i')
            ->setEnumColumn('type', ProductType::class)
            ->run();
    }

    /**
     * Update the product.
     *
     * @param  StoreProductRequest $request
     * @return self
     */
    public function createProduct(StoreProductRequest $request): self
    {
        $validatedRequest = $request->validated();

        $product = new Product();
        $product->fill($validatedRequest);
        $product->creator_id = auth()->id();
        $product->save();

        $quantitiesData = [];

        foreach ($validatedRequest['quantities'] as $key => $quantity) {
            $quantitiesData[] = [
                'warehouse' => Warehouse::getCaseByName($key)->value,
                'quantity'  => $quantity,
            ];
        }

        $product->quantity()->createMany($quantitiesData);

        $this->setProduct($product);

        return $this;
    }

    /**
     * Update the product.
     *
     * @param  UpdateProductRequest $request
     * @return self
     */
    public function updateProduct(UpdateProductRequest $request): self
    {
        $product = $this->getProduct();

        $changeLoggerService = new ChangeLoggerService($product, ['quantity']);

        $validatedRequest = $request->validated();

        $product->update($validatedRequest);

        $quantitiesData = [];
        $fireMinimumQuantityReachedEvent = false;
        foreach ($validatedRequest['quantities'] as $key => $quantity) {
            $quantitiesData[] = [
                'product_id' => $product->id,
                'warehouse'  => Warehouse::getCaseByName($key)->value,
                'quantity'   => $quantity,
                'updated_at' => now(),
            ];

            if ($quantity < $validatedRequest['minimum_quantity']) {
                $fireMinimumQuantityReachedEvent = true;
            }
        }

        ProductQuantity::upsert(
            $quantitiesData,
            ['product_id', 'warehouse'],
            ['quantity', 'updated_at']
        );

        $changeLoggerService->logChanges($product);

        if ($fireMinimumQuantityReachedEvent) {
            event(new MinimumQuantityReached($product));
        }

        return $this;
    }

    /**
     * Update the product's quantity.
     *
     * @param  UpdateProductQuantityRequest $request
     * @return self
     */
    public function updateProductQuantity(UpdateProductQuantityRequest $request): self
    {
        $validatedRequest = $request->validated();

        $productQuantity = ProductQuantity::find($validatedRequest['id'])->load('product');

        if (! $productQuantity) {
            return $this;
        }

        $product = $productQuantity->product;
        $changeLoggerService = new ChangeLoggerService($product, ['quantity']);

        $productQuantity->update([
            'quantity' => $validatedRequest['quantity'],
        ]);

        if ($validatedRequest['quantity'] < $product->minimum_quantity) {
            event(new MinimumQuantityReached($product));
        }

        $changeLoggerService->logChanges($product);

        return $this;
    }

    /**
     * Update the product's quantity.
     *
     * @param  AddProductToProjectRequest $request
     * @return self
     */
    public function addProductToProject(AddProductToProjectRequest $request): self
    {
        $validatedRequest = $request->validated();

        $productProject = new ProductProject();
        $productProject->fill($validatedRequest);
        $productProject->creator_id = auth()->id();
        $productProject->save();

        $productQuantity = ProductQuantity::where('product_id', $validatedRequest['product_id'])
            ->where('warehouse', $validatedRequest['warehouse'])
            ->with('product')
            ->first();

        if (! $productQuantity) {
            return $this;
        }

        $product = $productQuantity->product;
        $changeLoggerService = new ChangeLoggerService($product, ['quantity']);

        $productQuantity->update([
            'quantity' => $productQuantity->quantity - $validatedRequest['quantity'],
        ]);

        if ($validatedRequest['quantity'] < $product->minimum_quantity) {
            event(new MinimumQuantityReached($product));
        }

        $changeLoggerService->logChanges($product);

        return $this;
    }

    /**
     * Return datatable of projects connected to this product.
     *
     * @return null|DataTable
     */
    public function getShowProjectsDataTable(): DataTable|null
    {
        $productId = request()->input('product_id');

        if (! $productId) {
            return null;
        }

        return $this->getProjectsDataTable($productId);
    }

    /**
     * Return datatable of projects connected to this product.
     *
     * @param            $productId
     * @return DataTable
     */
    public function getProjectsDataTable($productId): DataTable
    {
        return (new DataTable(
            ProductProject::where('product_id', $productId)
        ))
            ->setRelation('project', ['id', 'name', 'warehouse'])
            ->setRelation('creator')
            ->setColumn('project.id', '№', true, true)
            ->setColumn('creator.name', 'Създател', true, true)
            ->setColumn('project.name', 'Име', true, true)
            ->setColumn('project.warehouse', 'Склад', false, true)
            ->setColumn('quantity', 'Количество', true, true)
            ->setColumn('created_at', 'Създаден', true, true)
            ->setColumn('action', 'Действие')
            ->setDateColumn('created_at', 'dd.mm.YYYY H:i')
            ->setEnumColumn('project.warehouse', Warehouse::class)
            ->run();
    }
}

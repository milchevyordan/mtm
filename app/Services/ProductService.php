<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\Warehouse;
use App\Events\MinimumQuantityReached;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductQuantityRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Models\ProductQuantity;

class ProductService
{
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

        $changeLoggerService = new ChangeLoggerService($product);

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

        $productQuantity = ProductQuantity::find($validatedRequest['id']);

        if (! $productQuantity) {
            return $this;
        }

        $productQuantity->update([
            'quantity' => $validatedRequest['quantity'],
        ]);

        $product = $productQuantity->product;
        if ($validatedRequest['quantity'] < $product->minimum_quantity) {
            event(new MinimumQuantityReached($product));
        }

        return $this;
    }
}

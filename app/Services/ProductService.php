<?php

declare(strict_types=1);

namespace App\Services;

use App\Events\MinimumQuantityReached;
use App\Http\Requests\UpdateProductQuantityRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;

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
     * @param  UpdateProductRequest|UpdateProductQuantityRequest $request
     * @return self
     */
    public function updateProduct(UpdateProductRequest|UpdateProductQuantityRequest $request): self
    {
        $product = $this->getProduct();

        $changeLoggerService = new ChangeLoggerService($product);

        if ((! is_null($product->quantity_france) && ($product->quantity_france < $product->minimum_quantity)) || (! is_null($product->quantity_netherlands) && ($product->quantity_netherlands < $product->minimum_quantity))) {
            event(new MinimumQuantityReached($product));
        }

        $product->update($request->validated());

        $changeLoggerService->logChanges($product);

        return $this;
    }
}

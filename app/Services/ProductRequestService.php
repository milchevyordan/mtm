<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\ProductRequestStatus;
use App\Enums\Warehouse;
use App\Http\Requests\StoreProductRequestRequest;
use App\Models\ProductProductRequest;
use App\Models\ProductRequest;
use App\Services\DataTable\DataTable;

class ProductRequestService
{
    /**
     * Context product.
     *
     * @var ProductRequest
     */
    private ProductRequest $model;

    /**
     * Get the value of model.
     *
     * @return ProductRequest
     */
    public function getProductRequest(): ProductRequest
    {
        return $this->model;
    }

    /**
     * Set the value of model.
     *
     * @param  ProductRequest $model
     * @return self
     */
    public function setProductRequest(ProductRequest $model): self
    {
        $this->model = $model;

        return $this;
    }

    /**
     * Create a new ProductRequestService instance.
     */
    public function __construct()
    {
        $this->setProductRequest(new ProductRequest());
    }

    /**
     * Create the report.
     *
     * @param  StoreProductRequestRequest $request
     * @return self
     */
    public function createProductRequest(StoreProductRequestRequest $request): self
    {
        $validatedRequest = $request->validated();

        $productRequest = new ProductRequest();
        $productRequest->fill($validatedRequest);
        $productRequest->creator_id = auth()->id();
        $productRequest->save();
        $this->setProductRequest($productRequest);

        $this->syncProducts($validatedRequest['products']);

        return $this;
    }

    /**
     * Update vehicles relation of the model resource.
     *
     * @param       $products
     * @return void
     */
    public function syncProducts($products): void
    {
        $productRequestId = $this->getProductRequest()->id;

        $productProductRequestsInsert = [];
        foreach ($products as $product) {
            $productProductRequestsInsert[] = [
                'product_request_id' => $productRequestId,
                'product_id'         => $product['product_id'],
                'quantity'           => $product['quantity'],
                'created_at'         => now(),
            ];
        }

        ProductProductRequest::insert($productProductRequestsInsert);
    }

    /**
     * Return datatable shown in index method.
     *
     * @return DataTable
     */
    public function getIndexMethodDataTable(): DataTable
    {
        return (new DataTable(
            ProductRequest::query()
        ))
            ->setRelation('creator')
            ->setColumn('id', '#', true, true)
            ->setColumn('creator.name', 'Creator', true, true)
            ->setColumn('warehouse', 'Warehouse', true, true)
            ->setColumn('status', 'Status', true, true)
            ->setColumn('created_at', 'Created', true, true)
            ->setColumn('accepted_at', 'Accepted', true, true)
            ->setColumn('action', 'Action')
            ->setDateColumn('created_at', 'dd.mm.YYYY H:i')
            ->setDateColumn('accepted_at', 'dd.mm.YYYY H:i')
            ->setEnumColumn('status', ProductRequestStatus::class)
            ->setEnumColumn('warehouse', Warehouse::class)
            ->run();
    }
}

<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\ProductRequestStatus;
use App\Enums\ProductType;
use App\Enums\Warehouse;
use App\Http\Requests\StoreProductRequestRequest;
use App\Http\Requests\UpdateProductRequestRequest;
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
     * Create the product request.
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
     * Update the product request with actual quantity received and update change log of products.
     *
     * @param  UpdateProductRequestRequest $request
     * @return self
     */
    public function updateProductRequest(UpdateProductRequestRequest $request): self
    {
        $productRequest = $this->getProductRequest();

        $validatedRequest = $request->validated();

        $productRequest->status = $validatedRequest['status'];
        $productRequest->save();

        $productRequest->productProductRequest()->upsert(
            $validatedRequest['products'] ?? [],
            ['id'],
            ['actual_quantity', 'quantity']
        );

        $validatedProducts = collect($validatedRequest['products']);
        foreach ($productRequest->productQuantities()->with('product')->get() as $productQuantity) {
            $matchingProduct = $validatedProducts->firstWhere('product_id', $productQuantity->product_id);

            if (! $matchingProduct) {
                continue;
            }

            $product = $productQuantity->product;
            $changeLoggerService = new ChangeLoggerService($product, ['quantity']);

            $productQuantity->quantity += $matchingProduct['actual_quantity'];
            $productQuantity->save();

            $changeLoggerService->logChanges($product);
        }

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
            ->setColumn('id', '№', true, true)
            ->setColumn('creator.name', 'Създател', true, true)
            ->setColumn('warehouse', 'За Склад', true, true)
            ->setColumn('status', 'Статус', true, true)
            ->setColumn('created_at', 'Създадена', true, true)
            ->setColumn('updated_at', 'Последна промяна', true, true)
            ->setColumn('action', 'Действие')
            ->setDateColumn('created_at', 'dd.mm.YYYY H:i')
            ->setDateColumn('updated_at', 'dd.mm.YYYY H:i')
            ->setEnumColumn('status', ProductRequestStatus::class)
            ->setEnumColumn('warehouse', Warehouse::class)
            ->run();
    }

    /**
     * Return datatable shown in index method.
     *
     * @param            $productRequestId
     * @return DataTable
     */
    public function getProductsDataTable($productRequestId): DataTable
    {
        return (new DataTable(
            ProductProductRequest::where('product_request_id', $productRequestId)
        ))
            ->setRelation('product', ['id', 'name', 'type', 'internal_id', 'specification'])
            ->setColumn('product.id', '№', true, true)
            ->setColumn('product.name', 'Име', true, true)
            ->setColumn('product.specification', 'Спецификация', true, true)
            ->setColumn('product.type', 'Тип', false, true)
            ->setColumn('product.internal_id', 'Вътрешен №', true, true)
            ->setColumn('quantity', 'Количество Поръчано', true, true)
            ->setColumn('actual_quantity', 'Реално Количество Пристигнало', true, true)
            ->setColumn('action', 'Действие')
            ->setEnumColumn('product.type', ProductType::class)
            ->run();
    }
}

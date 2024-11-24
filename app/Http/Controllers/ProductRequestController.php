<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\ProductRequestStatus;
use App\Http\Requests\StoreProductRequestRequest;
use App\Http\Requests\UpdateProductRequestRequest;
use App\Models\ProductProductRequest;
use App\Models\ProductRequest;
use App\Services\DataTable\DataTable;
use App\Services\ProductRequestService;
use App\Services\ProductService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use Inertia\Response;
use Throwable;

class ProductRequestController extends Controller
{
    public ProductRequestService $service;

    public function __construct()
    {
        $this->service = new ProductRequestService();
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        return Inertia::render('ProductRequests/Index', [
            'dataTable' => fn () => $this->service->getIndexMethodDataTable(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return Inertia::render('ProductRequests/Create', [
            'dataTable' => fn () => (new ProductService())->getIndexMethodDatatable(null),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreProductRequestRequest $request
     * @return RedirectResponse
     */
    public function store(StoreProductRequestRequest $request): RedirectResponse
    {
        DB::beginTransaction();

        try {
            $this->service->createProductRequest($request);

            DB::commit();

            return redirect()->route('product-requests.edit', ['product_request' => $this->service->getProductRequest()->id])->with('success', 'The record has been successfully created.');
        } catch (Throwable $th) {
            DB::rollBack();

            Log::error($th->getMessage(), ['exception' => $th]);

            return redirect()->back()->withErrors(['Error creating record.']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  ProductRequest $productRequest
     * @return Response
     */
    public function show(ProductRequest $productRequest): Response
    {
        $dataTable = (new DataTable(
            ProductProductRequest::where('product_request_id', $productRequest->id)
        ))
            ->setRelation('product', ['id', 'name'])
            ->setColumn('product.name', 'Name', true, true)
            ->setColumn('quantity', 'Quantity Ordered', true, true)
            ->setColumn('actual_quantity', 'Actual Quantity Received', true, true)
            ->setColumn('action', 'Action')
            ->run();

        return Inertia::render('ProductRequests/Show', [
            'productRequest' => $productRequest,
            'dataTable'      => fn () => $dataTable,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  ProductRequest $productRequest
     * @return Response
     */
    public function edit(ProductRequest $productRequest): Response
    {
        if (ProductRequestStatus::Not_delivered_yet != $productRequest->status) {
            abort(403);
        }

        $productRequest->load('productProductRequest');

        $dataTable = (new DataTable(
            ProductProductRequest::where('product_request_id', $productRequest->id)
        ))
            ->setRelation('product', ['id', 'name'])
            ->setColumn('product.name', 'Name', true, true)
            ->setColumn('quantity', 'Quantity Ordered', true, true)
            ->setColumn('actual_quantity', 'Actual Quantity Received', true, true)
            ->setColumn('action', 'Action')
            ->run();

        return Inertia::render('ProductRequests/Edit', [
            'productRequest'        => $productRequest,
            'dataTable'             => fn () => $dataTable,
            'productProductRequest' => fn () => $productRequest->productProductRequest->pluck(null, 'product_id'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateProductRequestRequest $request
     * @param  ProductRequest              $productRequest
     * @return RedirectResponse
     */
    public function update(UpdateProductRequestRequest $request, ProductRequest $productRequest): RedirectResponse
    {
        DB::beginTransaction();

        try {
            $this->service->setProductRequest($productRequest)->updateProductRequest($request);

            DB::commit();

            return redirect()->route('product-requests.show', ['product_request' => $this->service->getProductRequest()->id])->with('success', 'The record has been successfully created.');
        } catch (Throwable $th) {
            DB::rollBack();

            Log::error($th->getMessage(), ['exception' => $th]);

            return redirect()->back()->withErrors(['Error updating record.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  ProductRequest   $productRequest
     * @return RedirectResponse
     */
    public function destroy(ProductRequest $productRequest): RedirectResponse
    {
        try {
            $productRequest->delete();

            return redirect()->back()->with('success', 'The record has been successfully deleted.');
        } catch (Throwable $th) {
            Log::error($th->getMessage(), ['exception' => $th]);

            return redirect()->back()->withErrors(['Error deleting record.']);
        }
    }
}

<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequestRequest;
use App\Http\Requests\UpdateProductRequestRequest;
use App\Models\ProductRequest;
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

            return redirect()->route('product-requests.show', ['report' => $this->service->getProductRequest()->id])->with('success', 'The record has been successfully created.');
        } catch (Throwable $th) {
            DB::rollBack();

            Log::error($th->getMessage(), ['exception' => $th]);

            return redirect()->back()->withErrors(['Error creating record.']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param ProductRequest $productRequest
     */
    public function show(ProductRequest $productRequest)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ProductRequest $productRequest
     */
    public function edit(ProductRequest $productRequest)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateProductRequestRequest $request
     * @param ProductRequest              $productRequest
     */
    public function update(UpdateProductRequestRequest $request, ProductRequest $productRequest)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ProductRequest $productRequest
     */
    public function destroy(ProductRequest $productRequest)
    {
    }
}

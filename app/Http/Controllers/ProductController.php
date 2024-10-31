<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductQuantityRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use Inertia\Response;
use Throwable;

class ProductController extends Controller
{
    public ProductService $service;

    public function __construct()
    {
        $this->service = new ProductService();
    }

    /**
     * Display a listing of the resource.
     *
     * @param  Request  $request
     * @return Response
     */
    public function index(Request $request): Response
    {
        return Inertia::render('Products/Index', [
            'dataTable' => $this->service->getIndexMethodDatatable($request->slug),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return Inertia::render('Products/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreProductRequest $request
     * @return RedirectResponse
     */
    public function store(StoreProductRequest $request): RedirectResponse
    {
        DB::beginTransaction();

        try {
            $this->service->createProduct($request);

            DB::commit();

            return redirect()->route('products.edit', ['product' => $this->service->getProduct()->id])->with('success', 'The record has been successfully created.');
        } catch (Throwable $th) {
            DB::rollBack();

            Log::error($th->getMessage(), ['exception' => $th]);

            return redirect()->back()->withErrors(['Error creating record.']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Product $product
     */
    public function show(Product $product)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Product  $product
     * @return Response
     */
    public function edit(Product $product): Response
    {
        $product->load(['changeLogs', 'quantity']);

        return Inertia::render('Products/Edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateProductRequest $request
     * @param  Product              $product
     * @return RedirectResponse
     */
    public function update(UpdateProductRequest $request, Product $product): RedirectResponse
    {
        DB::beginTransaction();

        try {
            $this->service->setProduct($product)->updateProduct($request);

            DB::commit();

            return back()->with('success', 'The record has been successfully updated.');
        } catch (Throwable $th) {
            DB::rollBack();

            Log::error($th->getMessage(), ['exception' => $th]);

            return redirect()->back()->withErrors(['Error updating record.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     */
    public function destroy(Product $product)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  UpdateProductQuantityRequest $request
     * @return RedirectResponse
     */
    public function updateQuantity(UpdateProductQuantityRequest $request): RedirectResponse
    {
        DB::beginTransaction();

        try {
            $this->service->updateProductQuantity($request);

            DB::commit();

            return back()->with('success', 'The record has been successfully updated.');
        } catch (Throwable $th) {
            DB::rollBack();

            Log::error($th->getMessage(), ['exception' => $th]);

            return redirect()->back()->withErrors(['Error updating record.']);
        }
    }
}

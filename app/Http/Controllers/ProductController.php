<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Services\ChangeLoggerService;
use App\Services\DataTable\DataTable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use Inertia\Response;
use Throwable;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataTable = (new DataTable(
            Product::select(Product::$defaultSelectFields)
        ))
            ->setRelation('availability')
            ->setColumn('id', '#', true, true)
            ->setColumn('name', __('Name'), true, true)
            ->setColumn('internal_id', __('Internal Id'), true, true)
            ->setColumn('availability_france', __('France'), true, true)
            ->setColumn('availability_netherlands', __('Netherlands'), true, true)
            ->setColumn('created_at', __('Date'), true, true)
            ->setColumn('action', __('Action'))
            ->setDateColumn('created_at', 'dd.mm.YYYY H:i')
            ->run();

        return Inertia::render('Products/Index', compact('dataTable'));
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
            $validatedRequest = $request->validated();

            $product = new Product();
            $product->fill($validatedRequest);
            $product->creator_id = auth()->id();
            $product->save();

            DB::commit();

            return redirect()->route('products.edit', ['product' => $product->id])->with('success', __('The record has been successfully created.'));
        } catch (Throwable $th) {
            DB::rollBack();

            Log::error($th->getMessage(), ['exception' => $th]);

            return redirect()->back()->withErrors([__('Error creating record.')]);
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
        $product->load(['changeLogs', 'availability']);

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
            $changeLoggerService = new ChangeLoggerService($product);

            $product->update($request->validated());

            $changeLoggerService->logChanges($product);

            DB::commit();

            return back()->with('success', __('The record has been successfully updated.'));
        } catch (Throwable $th) {
            DB::rollBack();

            Log::error($th->getMessage(), ['exception' => $th]);

            return redirect()->back()->withErrors([__('Error updating record.')]);
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
}

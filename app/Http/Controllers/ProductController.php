<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Services\DataTable\DataTable;
use Inertia\Inertia;

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
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreProductRequest $request
     */
    public function store(StoreProductRequest $request)
    {
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
     * @param Product $product
     */
    public function edit(Product $product)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateProductRequest $request
     * @param Product              $product
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
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

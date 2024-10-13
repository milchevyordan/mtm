<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\DataTable\DataTable;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataTable = (new DataTable(
            User::select(User::$defaultSelectFields)
        ))
            ->setColumn('id', '#', true, true)
            ->setColumn('name', __('Name'), true, true)
            ->setColumn('email', __('Email'), true, true)
            ->setColumn('created_at', __('Date'), true, true)
            ->setColumn('action', __('Action'))
            ->setDateColumn('created_at', 'dd.mm.YYYY H:i')
            ->run();

        return Inertia::render('Users/Index', compact('dataTable'));
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
     * @param Request $request
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param string $id
     */
    public function show(string $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param string $id
     */
    public function edit(string $id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param string  $id
     */
    public function update(Request $request, string $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $id
     */
    public function destroy(string $id)
    {
    }
}

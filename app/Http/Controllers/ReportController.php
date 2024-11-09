<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreReportRequest;
use App\Http\Requests\UpdateReportRequest;
use App\Models\Report;
use App\Services\ReportService;
use Inertia\Inertia;
use Inertia\Response;

class ReportController extends Controller
{
    public ReportService $service;

    public function __construct()
    {
        $this->service = new ReportService();
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        return Inertia::render('Reports/Index', [
            'dataTable' => fn () => $this->service->getIndexMethodDataTable(),
        ]);
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
     * @param StoreReportRequest $request
     */
    public function store(StoreReportRequest $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param Report $report
     */
    public function show(Report $report)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Report $report
     */
    public function edit(Report $report)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateReportRequest $request
     * @param Report              $report
     */
    public function update(UpdateReportRequest $request, Report $report)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Report $report
     */
    public function destroy(Report $report)
    {
    }
}

<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreReportRequest;
use App\Models\ProductReport;
use App\Models\Project;
use App\Models\Report;
use App\Services\DataTable\DataTable;
use App\Services\DataTable\Ordering;
use App\Services\MultiSelectService;
use App\Services\ReportService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use Inertia\Response;
use Throwable;

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
    public function create(): Response
    {
        return Inertia::render('Reports/Create', [
            'projects' => fn () => (new MultiSelectService(Project::query()))->dataForSelect(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreReportRequest $request
     * @return RedirectResponse
     */
    public function store(StoreReportRequest $request): RedirectResponse
    {
        DB::beginTransaction();

        try {
            $this->service->createReport($request);

            DB::commit();

            return redirect()->route('reports.show', ['report' => $this->service->getReport()->id])->with('success', 'The record has been successfully created.');
        } catch (Throwable $th) {
            DB::rollBack();

            Log::error($th->getMessage(), ['exception' => $th]);

            return redirect()->back()->withErrors(['Error creating record.']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  Report   $report
     * @return Response
     */
    public function show(Report $report): Response
    {
        $report->load(['projects:id']);

        $dataTable = (new DataTable(
            ProductReport::where('report_id', $report->id)
        ))
            ->setOrdering(new Ordering('product_id'))
            ->setRelation('product', ['id', 'name'])
            ->setColumn('product.name', 'Name', true, true)
            ->setColumn('quantity', 'Quantity', true, true)
            ->run();

        return Inertia::render('Reports/Show', [
            'report'    => $report,
            'projects'  => fn () => (new MultiSelectService(Project::whereIn('id', $report->projects->pluck('id'))))->dataForSelect(),
            'dataTable' => fn () => $dataTable,
        ]);
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

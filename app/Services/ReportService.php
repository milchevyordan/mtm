<?php

declare(strict_types=1);

namespace App\Services;

use App\Http\Requests\StoreReportRequest;
use App\Models\ProductProject;
use App\Models\Report;
use App\Services\DataTable\DataTable;
use App\Services\Pdf\Pagination\Paginator;
use App\Services\Pdf\PdfService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class ReportService
{
    /**
     * Context product.
     *
     * @var Report
     */
    private Report $model;

    /**
     * Get the value of model.
     *
     * @return Report
     */
    public function getReport(): Report
    {
        return $this->model;
    }

    /**
     * Set the value of model.
     *
     * @param  Report $model
     * @return self
     */
    public function setReport(Report $model): self
    {
        $this->model = $model;

        return $this;
    }

    /**
     * Create a new ReportService instance.
     */
    public function __construct()
    {
        $this->setReport(new Report());
    }

    /**
     * Create the report.
     *
     * @param  StoreReportRequest $request
     * @return self
     */
    public function createReport(StoreReportRequest $request): self
    {
        $validatedRequest = $request->validated();

        $report = new Report();
        $report->fill($validatedRequest);
        $report->creator_id = auth()->id();
        $report->save();

        $productReportInserts = [];
        foreach (ProductProject::whereIn('project_id', $validatedRequest['projects'])
            ->whereBetween('created_at', [Carbon::parse($validatedRequest['date_from'])->startOfDay(), Carbon::parse($validatedRequest['date_to'])->endOfDay()])
            ->get() as $productProject) {
            $productId = $productProject->product_id;

            if (isset($productReportInserts[$productId])) {
                $productReportInserts[$productId]['quantity'] += $productProject->quantity;
            } else {
                $productReportInserts[$productId] = [
                    'quantity' => $productProject->quantity,
                ];
            }
        }

        $report->projects()->attach($validatedRequest['projects']);
        $report->products()->attach($productReportInserts);

        $this->setReport($report);

        return $this;
    }

    /**
     * Create pdf and return its name or path.
     *
     * @return string
     */
    public function createReportPdf(): string
    {
        $report = $this->getReport();
        $report->load('products:id,name,internal_id,type,specification', 'projects:id,name,warehouse,created_at', 'creator');

        $pdfService = new PdfService(
            'templates/report',
            [
                'report' => $report,
            ],
        );

        $fileOutput = $pdfService->setPaginator(new Paginator(x: 40, y: 800))->setCanvasImageRenderers()->generate();

        $uniqueName = "отчет_{$report->id}" . '_' . time() . '_' . uniqid() . '.pdf';

        Storage::disk('public')->put($uniqueName, $fileOutput);

        $report->pdf_path = $uniqueName;
        $report->save();

        return $uniqueName;
    }

    /**
     * Update the report.
     *
     * @return DataTable
     */
    public function getIndexMethodDataTable(): DataTable
    {
        return (new DataTable(
            Report::query()
        ))
            ->setRelation('creator')
            ->setColumn('id', '№', true, true)
            ->setColumn('creator.name', 'Създател', true, true)
            ->setColumn('date_from', 'Дата От', true, true)
            ->setColumn('date_to', 'Дата До', true, true)
            ->setColumn('created_at', 'Създаден', true, true)
            ->setColumn('action', 'Действие')
            ->setDateColumn('created_at', 'dd.mm.YYYY H:i')
            ->setDateColumn('date_from', 'dd.mm.YYYY')
            ->setDateColumn('date_to', 'dd.mm.YYYY')
            ->run();
    }
}

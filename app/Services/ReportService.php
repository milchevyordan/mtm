<?php

declare(strict_types=1);

namespace App\Services;

use App\Http\Requests\StoreReportRequest;
use App\Models\ProductProject;
use App\Models\Report;
use App\Services\DataTable\DataTable;

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
        foreach (ProductProject::whereIn('project_id', $validatedRequest['projects'])->whereBetween('created_at', [$validatedRequest['date_from'], $validatedRequest['date_to']])->get() as $productProject) {
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
     * Update the report.
     *
     * @return DataTable
     */
    public function getIndexMethodDataTable(): DataTable
    {
        return (new DataTable(
            Report::query()
        ))
            ->setColumn('id', '#', true, true)
            ->setColumn('date_from', 'Date From', true, true)
            ->setColumn('date_to', 'Date To', true, true)
            ->setColumn('created_at', 'Created', true, true)
            ->setColumn('action', 'Action')
            ->setDateColumn('created_at', 'dd.mm.YYYY H:i')
            ->setDateColumn('date_from', 'dd.mm.YYYY')
            ->setDateColumn('date_to', 'dd.mm.YYYY')
            ->run();
    }
}

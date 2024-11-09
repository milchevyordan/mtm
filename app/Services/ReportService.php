<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\Warehouse;
use App\Http\Requests\StoreReportRequest;
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
            ->setColumn('warehouse', 'Warehouse', true, true)
            ->setColumn('name', 'Name', true, true)
            ->setColumn('created_at', 'Date', true, true)
            ->setColumn('action', 'Action')
            ->setDateColumn('created_at', 'dd.mm.YYYY H:i')
            ->setEnumColumn('warehouse', Warehouse::class)
            ->run();
    }
}

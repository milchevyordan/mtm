<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\ChangeLog;
use App\Services\DataTable\DataTable;
use Illuminate\Database\Eloquent\Model;

class ChangeLogService
{
    /**
     * Return change logs datatable.
     *
     * @param  Model|string $model
     * @return DataTable
     */
    public static function getChangeLogsDataTable(Model|string $model): DataTable
    {
        $all = 'string' == gettype($model);

        $dataTable = (new DataTable(
            $all ? ChangeLog::where('changeable_type', $model) : $model->changeLogs()->getQuery()
        ))
            ->setRelation('creator');

        if ($all) {
            $dataTable->setColumn('changeable_id', '№', true, true);
        }

        return
            $dataTable->setColumn('creator.name', 'Създател', true, true)
                ->setColumn('change', 'Change', true)
                ->setColumn('created_at', 'Създаден', true, true)
                ->setDateColumn('created_at', 'dd.mm.YYYY H:i')
                ->run();
    }

    /**
     * Return index page change logs (latest ones for the model).
     *
     * @param  string $model
     * @return mixed
     */
    public static function getChangeLogsLimited(string $model): mixed
    {
        return ChangeLog::where('changeable_type', $model)->with(['creator'])->latest()->limit(20)->get();
    }
}

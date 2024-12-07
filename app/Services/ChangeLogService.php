<?php

declare(strict_types=1);

namespace App\Services;

use App\Services\DataTable\DataTable;
use Illuminate\Database\Eloquent\Model;

class ChangeLogService
{
    /**
     * Return change logs datatable.
     *
     * @param  Model     $model
     * @return DataTable
     */
    public static function getChangeLogsDataTable(Model $model): DataTable
    {
        return (new DataTable(
            $model->changeLogs()->getQuery()
        ))
            ->setRelation('creator')
            ->setColumn('creator.name', 'Създател', true, true)
            ->setColumn('change', 'Change', true)
            ->setColumn('created_at', 'Създаден', true, true)
            ->setDateColumn('created_at', 'dd.mm.YYYY H:i')
            ->run();
    }
}

<?php

declare(strict_types=1);

namespace App\Exports;

use App\Models\ProductRequest;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;

class ProductRequestExport implements FromCollection, WithHeadings, WithMapping, WithEvents
{
    private ProductRequest $productRequest;

    public function __construct(ProductRequest $productRequest)
    {
        $this->productRequest = $productRequest;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return $this->productRequest->products;
    }

    public function headings(): array
    {
        return [
            '№',
            'Име',
            'Спецификация',
            'Тип',
            'Вътрешен №',
            'Количество Поръчано',
        ];
    }

    /**
     * Map the product data for each row.
     *
     * @param mixed $row
     */
    public function map($row): array
    {
        return [
            $row->id,
            $row->name,
            $row->specification,
            $row->type?->name ? str_replace('_', ' ', $row->type->name) : '',
            $row->internal_id,
            $row->pivot->quantity,
        ];
    }

    /**
     * Auto stretch columns.
     *
     * @return mixed
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                foreach (range('A', 'F') as $columnID) {
                    $event->sheet->getDelegate()->getColumnDimension($columnID)->setAutoSize(true);
                }
            },
        ];
    }
}

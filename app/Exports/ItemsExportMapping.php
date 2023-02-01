<?php

namespace App\Exports;

use App\Models\Item;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class ItemsExportMapping implements FromCollection, WithMapping, WithHeadings, ShouldAutoSize, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Item::with('category', 'lendings')->get();
    }

    public function map($item) : array {
        if ($item->repair_total == 0) {
            $repair = '-';
        }else {
            $repair = $item->repair_total;
        }
        return [
            $item->category->name,
            $item->name,
            $item->total,
            $repair,
            Carbon::parse($item->updated_at)->toFormattedDateString()
        ];
    }

    public function headings() : array {
        return [
            'Category',
            'Name Item',
            'Total',
            'Repair Total',
            'Last Updated'
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:W1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(12);
                $styleArray = [
                    'borders' => [
                        'outline' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                            'color' => ['argb' => '000000'],
                        ],
                    ],
                ];
                
                $event->sheet->getStyle('A1:E1')->applyFromArray($styleArray);
            },
        ];
    }
}

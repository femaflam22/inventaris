<?php

namespace App\Exports;

use App\Models\Lending;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class LendingsExportMapping implements FromCollection, WithMapping, WithHeadings, ShouldAutoSize, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Lending::with('item', 'user')->get();
    }

    public function map($lending) : array {
        if (is_null($lending['return_date'])) {
            $returnDate = '-';
        }else {
            $returnDate = Carbon::parse($lending->return_date)->toFormattedDateString();
        }
        return [
            $lending->item->name,
            $lending->total_item,
            $lending->name,
            $lending->ket,
            Carbon::parse($lending->date)->toFormattedDateString(),
            $returnDate,
            $lending->user->name
        ];
    }

    public function headings() : array {
        return [
            'Item',
            'Total',
            'Name',
            'Ket.',
            'Date',
            'Return Date',
            'Edited By'
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
                
                $event->sheet->getStyle('A1:G1')->applyFromArray($styleArray);
            },
        ];
    }
}

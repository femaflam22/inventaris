<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class OperatorsExportMapping implements FromCollection, WithMapping, WithHeadings, ShouldAutoSize, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::where('role', 'operator')->get();
    }

    public function map($user) : array {
        if ($user->status == "original") {
            if ($user['email'] == "operator@gmail.com") {
                $password = 'operatorwikrama';
            }else {
                $data = User::where('role', '=', $user['role'])->get();
                $password = substr($user->email, 0,4) . count($data);
            }
        }else {
            $password = "This account already edited the password";
        }

        return[
            $user->name,
            $user->email,
            $password
        ];
    }

    public function headings() : array {
        return[
            'Name',
            'Email',
            'Password'
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
                
                $event->sheet->getStyle('A1:C1')->applyFromArray($styleArray);
            },
        ];
    }
}

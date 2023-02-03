<?php

namespace App\Exports;

use \Maatwebsite\Excel\Sheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Events\AfterSheet;

class ExcelExport implements FromView,ShouldAutoSize,WithEvents
{
    protected $report; 

    public function __construct(array $report,$totalRow)
    {
        $this->report = $report;
        $this->totalRow = $totalRow;
        
    }

    public function array(): array
    {
        return $this->report;
    }
    
    public function view(): View
    {
        return view('report.export', [
            'data' => $this->report,
        ]);
    }
    public function registerEvents(): array
    {

        Sheet::macro('styleCells', function (Sheet $sheet, string $cellRange, array $style) {
            $sheet->getDelegate()->getStyle($cellRange)->applyFromArray($style);
        });
        return [
           AfterSheet::class    => function (AfterSheet $event) {
                $event->sheet->getDelegate()->getParent()->getDefaultStyle()->getFont()->setName('Pyidaungsu');

                $cellRange = 'A1:S2'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setBold(true);
                $event->sheet->styleCells(
                    'A1:S2',
                    [
                    'alignment' => [
                        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    ],
                ]
                );
                $totalrow=$this->totalRow + 2;
                // dd($this->totalRow);
                $rowRange = 'A1:S'.$totalrow;
                $event->sheet->styleCells(
                    $rowRange,
                    [
                        'alignment' => [
                        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                        ],

                        'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color'       => ['argb' => '00000000'],
                        ],
                    ]
                ]
                );

                $rowRange = 'B3:B'.$totalrow;
                $event->sheet->styleCells(
                    $rowRange,
                    [
                        'alignment' => [
                        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
                        ],
                    ]
                );

                $rowRange = 'M3:M'.$totalrow;
                $event->sheet->styleCells(
                    $rowRange,
                    [
                        'alignment' => [
                        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
                        ],
                    ]
                );
            },
        ];

    }
}

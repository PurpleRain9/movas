<?php

namespace App\Exports;

use \Maatwebsite\Excel\Sheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class AllapplicantExport implements FromView,ShouldAutoSize,WithEvents,WithChunkReading
{
    protected $report; 

    public function __construct(array $report,$totalRow)
    {
        $this->report = $report;
        $this->totalRow = $totalRow;
        
    }
    public function chunkSize(): int
    {
        return 10;
    }

    public function array(): array
    {
        return $this->report;
    }
    
    public function view(): View
    {
        return view('report.allapplicant', [
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

                $cellRange = 'A1:U2'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setBold(true);
                $event->sheet->styleCells(
                    'A1:U2',
                    [
                    'alignment' => [
                        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    ],
                ]
                );
                $totalrow=$this->totalRow + 2;
                // dd($this->totalRow);
                $rowRange = 'A1:U'.$totalrow;
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

                $rowRange = 'N3:Q'.$totalrow;
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

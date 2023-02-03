<?php

namespace App\Exports;

use App\Models\Director;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class ExportDirector implements FromView, ShouldAutoSize, WithEvents
{
    public function __construct($directors)
    {
        $this->directors = $directors;
    }

    public function view(): View
    {
        return view('excel.direcotorsexport', [
            'directors' => $this->directors
        ]);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $event->sheet->getStyle('A1:E30')->applyFromArray([
                    'font' => [
                        'name' => 'PyiDaungSu',
                    ]
                ]);
            }
        ];
    }
}

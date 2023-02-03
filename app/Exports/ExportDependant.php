<?php

namespace App\Exports;

use App\Models\Dependant;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class ExportDependant implements FromView, ShouldAutoSize, WithEvents
{
    public function __construct($dependants)
    {
        $this->dependants = $dependants;
    }

    public function view(): View
    {
        return view('excel.dependantsexport', [
            'dependants' => $this->dependants
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

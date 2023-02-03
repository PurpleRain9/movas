<?php

namespace App\Exports;

use App\Models\ForeignTechician;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class ForeignTechExport implements FromView, ShouldAutoSize, WithEvents
{
    public function __construct($foreign_technicians)
    {
        $this->foreign_technicians = $foreign_technicians;
    }

    public function view(): View
    {
        return view('excel.foreign_technicians', [
            'foreign_technicians' => $this->foreign_technicians
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

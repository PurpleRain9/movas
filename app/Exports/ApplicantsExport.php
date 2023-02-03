<?php

namespace App\Exports;

use App\Models\VisaApplicationHead;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class ApplicantsExport implements FromView, ShouldAutoSize, WithEvents
{

    public function __construct($applicants)
    {
        $this->applicants = $applicants;
    }

    public function view(): View
    {
        return view('excel.applicant', [
            'applicants' => $this->applicants
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

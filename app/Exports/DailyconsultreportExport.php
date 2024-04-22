<?php

namespace App\Exports;

use App\Models\DailyConsultationreport;

//use Maatwebsite\Excel\Concerns\FromQuery;

use Maatwebsite\Excel\Concerns\Exportable;
//use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Support\Facades\Crypt;
//class ReceptionExport implements FromQuery,   WithHeadings





class DailyconsultreportExport implements FromView, WithStyles, ShouldAutoSize
{

  private $oneRow;

   public function __construct($oneRow)
   {
        $this->oneRow = $oneRow;
   }
   public function view(): View
   {
       $oneRow = $this->oneRow;
       return view('Reception.exportReport', [
           'data' => $oneRow,
       ]);

    }
    public function styles(Worksheet $sheet)
    {
        // Apply border to all cells
        $sheet->getStyle('A1:' . $sheet->getHighestColumn() . $sheet->getHighestRow())
              ->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                // Set row height for a specific row
                $event->sheet->getRowDimension(2)->setRowHeight(100); // Adjust the row number and height

                // Or you can also use setAutoSize for specific columns
                $event->sheet->getColumnDimension('A')->setAutoSize(false);
                $event->sheet->getColumnDimension('A')->setWidth(100); // Adjust the column width

                // ... Repeat the above lines for other columns as needed ...
            },
        ];
    }

}// class end

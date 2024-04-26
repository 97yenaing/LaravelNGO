<?php

namespace App\Exports\dispensing;

use Maatwebsite\Excel\Concerns\Exportable;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromCollection;

class dispensingExport implements FromView
{
    private $oringindata;

    public function __construct($oringindata)
    {
        $this->oringindata = $oringindata; // Corrected variable assignment
    }

    public function view(): View
    {
        return view('Dispensing.export.dispensingexportData', [
            'ex_data' => $this->oringindata, // Corrected variable reference
        ]);
    }
  
}

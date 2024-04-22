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

class dispensing_Balance_Export implements FromView
{
    private $Dispensing;

    public function __construct($Dispensing)
    {
        $this->Dispensing = $Dispensing; // Corrected variable assignment
    }

    public function view(): View
    {
        return view('Dispensing.export.balance_exportData', [
            'balance_data' => $this->Dispensing, // Corrected variable reference
        ]);
    }
  
}

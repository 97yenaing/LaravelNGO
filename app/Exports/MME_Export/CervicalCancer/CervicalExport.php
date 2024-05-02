<?php

namespace App\Exports\MME_Export\CervicalCancer;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Illuminate\Support\Facades\Schema;

class CervicalExport implements FromView, WithColumnFormatting
{
    private $cervical_records;
    public function __construct( $cervical_records)
    {
        $this->cervical_records =  $cervical_records;
    }

    public function view(): View
    {
        return view("MME.Export.Cervical_Cancer.CervicalCancer", [
            "cervical_records" => $this->cervical_records,
        ]);
    }
    public function columnFormats(): array
    {
        return [
        'I' => 'dd-mm-yyyy',
        'N'=>'dd-mm-yyyy',
        'O'=>'dd-mm-yyyy',
        'AS'=>'dd-mm-yyyy',
        'AT'=>'dd-mm-yyyy',
        'AU'=>'dd-mm-yyyy',
        'AW'=>'dd-mm-yyyy',
        'BD'=>'dd-mm-yyyy',
        ];
    }
}
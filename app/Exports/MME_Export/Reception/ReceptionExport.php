<?php

namespace App\Exports\MME_Export\Reception;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Illuminate\Support\Facades\Schema;


class ReceptionExport implements FromView, WithColumnFormatting
{
    private $reception_exports;
    public function __construct($reception_exports)
    {
        $this->reception_exports = $reception_exports;
        
    }

    public function view():View{
      
      return view('MME.Export.Reception.Reception_export', [
       'exports_dataes'=>$this->reception_exports
      ]);
    }
    public function columnFormats(): array
    {
        return [
            "K"=>"d-m-yyyy",
            "AQ"=>"d-m-yyyy",
        ];
    }

}
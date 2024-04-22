<?php

namespace App\Exports\PreTB;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;


class PreTB_Export implements FromView, WithColumnFormatting
{
    private $pretb_exdataes;
    

    public function __construct($pretb_exdataes)
    {
        $this->pretb_exdataes = $pretb_exdataes;
        
    }

    public function view():View{
        
        return view('TB.export.pretb.pretb_export', [
            'pretb_exdataes' =>  $this->pretb_exdataes // Corrected variable reference 
        ]);
    }
   
    public function columnFormats(): array
    {
        return [
            "J"=>"d-m-yyyy",
            "M"=>"d-m-yyyy",
            "N"=>"d-m-yyyy",
            "P"=>"d-m-yyyy",
            "R"=>"d-m-yyyy",
            "T"=>"d-m-yyyy",
            "V"=>"d-m-yyyy",
        ];
    }

}
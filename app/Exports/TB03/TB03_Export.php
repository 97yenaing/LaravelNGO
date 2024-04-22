<?php

namespace App\Exports\TB03;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;


class TB03_Export implements FromView, WithColumnFormatting
{
    private $tb03_exdataes;
    

    public function __construct($tb03_exdataes)
    {
        $this->tb03_exdataes = $tb03_exdataes;
        
    }

    public function view():View{
        
        return view('TB.export.tb03_export', [
            'tb03_exdataes' =>  $this->tb03_exdataes // Corrected variable reference 
        ]);
    }
   
    public function columnFormats(): array
    {
        return [
            "E"=>"d-m-yyyy",
            "P"=>"d-m-yyyy",
            "T"=>"d-m-yyyy",
            "U"=>"d-m-yyyy",
            "AN"=>"d-m-yyyy",
            "AO"=>"d-m-yyyy",
        ];
    }

}
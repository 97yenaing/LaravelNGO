<?php

namespace App\Exports\NCD;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Illuminate\Support\Facades\Schema;


class NCD_Register_Export implements FromView, WithColumnFormatting
{
    private $ncd_reg_exDataes;
    public function __construct($ncd_reg_exDataes)
    {
        $this->ncd_reg_exDataes = $ncd_reg_exDataes;
        
    }

    public function view():View{
        $column_names = Schema::getColumnListing('ncd_pt_registers');
        
        return view('NCD.export.ncd_reg_export', [
            'ncd_reg_exDataes' =>  $this->ncd_reg_exDataes,
            'columns_name'=>$column_names // Corrected variable reference 
        ]);
    }
    public function columnFormats(): array
    {
        return [
            "F"=>"d-m-yyyy",
            "M"=>"d-m-yyyy",
            "O"=>"d-m-yyyy",
            "Q"=>"d-m-yyyy",
            "S"=>"d-m-yyyy",
            "U"=>"d-m-yyyy",
            "x"=>"d-m-yyyy",
            "Z"=>"d-m-yyyy",

        ];
    }

}

<?php

namespace App\Exports\NCD;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Illuminate\Support\Facades\Schema;


class NCD_Follow_Export implements FromView, WithColumnFormatting
{
    private $ncd_fol_exDataes;
    public function __construct($ncd_fol_exDataes)
    {
        $this->ncd_fol_exDataes = $ncd_fol_exDataes;
        
    }

    public function view():View{
        return view('NCD.export.ncd_fol_export', [
            'ncd_fol_exDataes' =>  $this->ncd_fol_exDataes,
        ]);
    }
    public function columnFormats(): array
    {
        return [
          "D"=>"d-m-YYYY",
          "E"=>"d-m-YYYY",
          "T"=>"d-m-YYYY",
          "Y"=>"d-m-YYYY",
          "AA"=>"d-m-YYYY",
          "AC"=>"d-m-YYYY",
          "CS"=>"d-m-YYYY",
        ];
    }

}
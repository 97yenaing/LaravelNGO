<?php

namespace App\Exports\TB_IPT;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;


class TBIPT_Export implements FromView, WithColumnFormatting
{
    private $tbipt_exdataes;
    

    public function __construct($tbipt_exdataes)
    {
        $this->tbipt_exdataes = $tbipt_exdataes;
        
    }

    public function view():View{
        
        return view('TB.export.IPT_export.tb_ipt_export', [
            'tbipt_exdataes' =>  $this->tbipt_exdataes // Corrected variable reference 
        ]);
    }
   
    public function columnFormats(): array
    {
        return [
            "H"=>"d-m-yyyy",
            "I"=>"d-m-yyyy",
            "J"=>"d-m-yyyy",

        ];
    }

}
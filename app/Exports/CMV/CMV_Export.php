<?php

namespace App\Exports\CMV;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;


class CMV_Export implements FromView, WithColumnFormatting
{
    private $cmv_exDatases;
    

    public function __construct($cmv_exDatases)
    {
        $this->cmv_exDatases = $cmv_exDatases;
        
    }

    public function view():View{
        return view('CMV.export.cmv_export', [
            'cmv_exdatases' =>  $this->cmv_exDatases // Corrected variable reference 
        ]);
    }
    public function columnFormats(): array
    {
        return [
            "J"=>"d-m-yyyy",
            "O"=>"d-m-yyyy",
            "Q"=>"d-m-yyyy",
            "AB"=>"d-m-yyyy"

        ];
    }

}

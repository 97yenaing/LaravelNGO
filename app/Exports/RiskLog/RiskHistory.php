<?php

namespace App\Exports\RiskLog;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;


class RiskHistory implements FromView, WithColumnFormatting
{
    private $final_log;
    

    public function __construct($final_log)
    {
        $this->final_log = $final_log;
        
    }

    public function view():View{
        //dd($this->final_log);
        return view('RiskHistory.Export.RiskLog_export', [
            'final_log' =>  $this->final_log // Corrected variable reference 
        ]);
        
    }
    public function columnFormats(): array
    {
        return [
            // "J"=>"d-m-yyyy",
            // "O"=>"d-m-yyyy",
            // "Q"=>"d-m-yyyy"

        ];
    }

}
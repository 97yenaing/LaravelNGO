<?php

namespace App\Exports\Counselling;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

use Illuminate\Support\Facades\Schema;

class HtsReport implements FromView
{
    private $hts_result;
    public function __construct($hts_result)
    {
        $this->hts_result = $hts_result;
        
    }

    public function view(): View
    {   
        return view("Counsellor.export.excelReport",["hts_result"=>$this->hts_result]);
    }
    
}
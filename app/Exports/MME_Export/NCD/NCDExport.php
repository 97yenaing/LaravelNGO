<?php

namespace App\Exports\MME_Export\NCD;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Illuminate\Support\Facades\Schema;

class NCDExport implements FromView, WithColumnFormatting
{
    private $ncd_records, $testName;
    public function __construct($ncd_records, $testName)
    {
        $this->ncd_records = $ncd_records;
        $this->testName = $testName;
    }

    public function view(): View
    {
        return view("MME.Export.NCD.NCD_" . $this->testName, [
            "ncd_records" => $this->ncd_records,
        ]);
    }
    public function columnFormats(): array
    {
        if ($this->testName=="Follow_Up") {
            return [
                "D" => "d-m-YYYY",
                "E" => "d-m-YYYY",
                "T" => "d-m-YYYY",
                "Y" => "d-m-YYYY",
                "AA" => "d-m-YYYY",
                "AC" => "d-m-YYYY",
                "CS" => "d-m-YYYY",
            ];
        } else {
            return [
                "F" => "d-m-YYYY",
                "M" => "d-m-YYYY",
                "O" => "d-m-YYYY",
                "Q" => "d-m-YYYY",
                "S" => "d-m-YYYY",
                "U" => "d-m-YYYY",
                "X" => "d-m-YYYY",
                "Z" => "d-m-YYYY",
            ];
        }
        
    }
}
<?php

namespace App\Exports\MME_Export\Counselling;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Illuminate\Support\Facades\Schema;

class CounsellingExport implements FromView, WithColumnFormatting
{
    private $counselling_records, $testName;
    public function __construct($counselling_records, $testName)
    {
        $this->counselling_records = $counselling_records;
        $this->testName = $testName;
    }

    public function view(): View
    {
        return view("MME.Export.Counselling." . $this->testName, [
            "counselling_records" => $this->counselling_records,
        ]);
    }
    public function columnFormats(): array
    {
        if ($this->testName == "Counselling_Export") {
            return [
                "M" => "d-m-yyyy",
            ];
        } else {
            return [
                "J" => "d-m-yyyy",
                "T" => "d-m-yyyy",
                "Y" => "d-m-yyyy",
                "AC" => "d-m-yyyy",
            ];
        }
    }
}

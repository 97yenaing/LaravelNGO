<?php

namespace App\Exports\MME_Export\STI;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Illuminate\Support\Facades\Schema;

class STIExport implements FromView, WithColumnFormatting
{
    private $sti_records, $testName;
    public function __construct($sti_records, $testName)
    {
        $this->sti_records = $sti_records;
        $this->testName = $testName;
    }

    public function view(): View
    {
        return view("MME.Export.STI.STI_" . $this->testName, [
            "sti_records" => $this->sti_records,
        ]);
    }
    public function columnFormats(): array
    {
        return [
            "J" => "d-m-YYYY",
        ];
    }
}

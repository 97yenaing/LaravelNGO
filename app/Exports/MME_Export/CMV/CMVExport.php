<?php

namespace App\Exports\MME_Export\CMV;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Illuminate\Support\Facades\Schema;

class CMVExport implements FromView, WithColumnFormatting
{
    private $cmv_records;
    public function __construct( $cmv_records)
    {
        $this->cmv_records =  $cmv_records;
    }

    public function view(): View
    {
        return view("MME.Export.CMV.CMV_Export", [
            "cmv_records" => $this->cmv_records,
        ]);
    }
    public function columnFormats(): array
    {
        return [
          "J"=>"d-m-yyyy",
          "O"=>"d-m-yyyy",
          "Q"=>"d-m-yyyy"
        ];
    }
}
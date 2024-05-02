<?php

namespace App\Exports\MME_Export\TB;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Illuminate\Support\Facades\Schema;

class TBExport implements FromView, WithColumnFormatting
{
    private $tb_records, $testName;
    public function __construct($tb_records, $testName)
    {
        $this->tb_records = $tb_records;
        $this->testName = $testName;
    }

    public function view(): View
    {
        return view("MME.Export.TB." . $this->testName, [
            "tb_records" => $this->tb_records,
        ]);
    }
    public function columnFormats(): array
    {   if($this->testName=="TB03_Register"){
          return [
            "E"=>"d-m-yyyy",
            "P"=>"d-m-yyyy",
            "T"=>"d-m-yyyy",
            "U"=>"d-m-yyyy",
            "AN"=>"d-m-yyyy",
            "AO"=>"d-m-yyyy",
          ];
        }else if($this->testName=="Pre_TB"){
          return [
            "J"=>"d-m-yyyy",
            "M"=>"d-m-yyyy",
            "N"=>"d-m-yyyy",
            "P"=>"d-m-yyyy",
            "R"=>"d-m-yyyy",
            "T"=>"d-m-yyyy",
            "V"=>"d-m-yyyy",
          ];
        }else{
          return [
            "H"=>"d-m-yyyy",
            "I"=>"d-m-yyyy",
            "J"=>"d-m-yyyy",
          ];
        }
    }
}
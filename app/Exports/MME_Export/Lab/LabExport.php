<?php

namespace App\Exports\MME_Export\Lab;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Illuminate\Support\Facades\Schema;

class LabExport implements FromView, WithColumnFormatting
{
    private $lab_records, $testName;
    public function __construct($lab_records, $testName)
    {
        $this->lab_records = $lab_records;
        $this->testName = $testName;
    }

    public function view(): View
    {
        return view('MME.Export.Lab.' . $this->testName, [
            'lab_records' => $this->lab_records,
        ]);
    }
    public function columnFormats(): array
    {
        if ($this->testName == 'HIV') {
            return [
                'L' => 'dd-mm-yy',
                'M' => 'dd-mm-yy',
                // 'S' => 'dd-mm-yy',
                // 'T' => 'dd-mm-yy',
            ];
        } else if ($this->testName == 'RPR') {
            return [
                //'H' => NumberFormat::FORMAT_DATE_YYYYMMDDSLASH, // Format 'H' column as "August 32, 2023"
                'L' => 'dd-mm-yyyy',
                'S' => 'dd-mm-yyyy',
                'W' => 'dd-mm-yyyy',
            ];
        } else if ($this->testName == 'STI') {
            return [
                //'H' => NumberFormat::FORMAT_DATE_YYYYMMDDSLASH, // Format 'H' column as "August 32, 2023"
                'K' => 'dd-mm-yyyy',
                'BA' => 'dd-mm-yyyy',
            ];
        } else if ($this->testName == 'HepB_C') {
            return [
                //'H' => NumberFormat::FORMAT_DATE_YYYYMMDDSLASH, // Format 'H' column as "August 32, 2023"
                'J' => 'dd-mm-yyyy',
                'V' => 'dd-mm-yyyy',
            ];
        } else if ($this->testName == 'Urine') {
            return [
                //'H' => NumberFormat::FORMAT_DATE_YYYYMMDDSLASH, // Format 'H' column as "August 32, 2023"
                'J' => 'dd-mm-yyyy',
                'AM' => 'dd-mm-yyyy',
            ];
        } else if ($this->testName == 'OI') {
            return [
                //'H' => NumberFormat::FORMAT_DATE_YYYYMMDDSLASH, // Format 'H' column as "August 32, 2023"
                'M' => 'dd-mm-yyyy',
                'AF' => 'dd-mm-yyyy',
            ];
        } else if ($this->testName == 'General') {
            return [
                //'H' => NumberFormat::FORMAT_DATE_YYYYMMDDSLASH, // Format 'H' column as "August 32, 2023"
                'J' => 'dd-mm-yyyy',
                'AG' => 'dd-mm-yyyy',
            ];
        } else if ($this->testName == 'Stool') {
            return [
                //'H' => NumberFormat::FORMAT_DATE_YYYYMMDDSLASH, // Format 'H' column as "August 32, 2023"
                'J' => 'dd-mm-yyyy',
                'U' => 'dd-mm-yyyy',
            ];
        } else if ($this->testName == 'AFB') {
            return [
                //'H' => NumberFormat::FORMAT_DATE_YYYYMMDDSLASH, // Format 'H' column as "August 32, 2023"
                'K' => 'dd-mm-yyyy',
                'X' => 'dd-mm-yyyy',
                'AC' => 'dd-mm-yyyy',
                'AH' => 'dd-mm-yyyy',
            ];
        } else if ($this->testName == 'Covid19') {
            return [
                //'H' => NumberFormat::FORMAT_DATE_YYYYMMDDSLASH, // Format 'H' column as "August 32, 2023"
                'K' => 'dd-mm-yyyy',
                'S' => 'dd-mm-yyyy',
            ];
        } else if ($this->testName == 'Viral_load') {
            return [
                //'H' => NumberFormat::FORMAT_DATE_YYYYMMDDSLASH, // Format 'H' column as "August 32, 2023"
                'J' => 'dd-mm-yyyy',
                'L' => 'dd-mm-yyyy',
                'M' => 'dd-mm-yyyy',
                'N' => 'dd-mm-yyyy',
                'O' => 'dd-mm-yyyy',
            ];
        }
    }
}

<?php

namespace App\Exports\Counselling;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class MentalExport implements FromCollection, WithMapping, WithHeadings, WithChunkReading, WithColumnFormatting, WithColumnWidths
{
  private $mental_data;
  public function __construct($mental_data)
  {
    $this->mental_data = $mental_data;
  }
  public function collection()
  {
    return $this->mental_data;
  }
  public function map($row): array
  {
    return [
      $row["Clinic Code"],
      $row["Counselling_Date"],
      $row['Pid'],
      $row['FuchiaID'],
      $row['Gender'],
      $row['Reg year'],
      $row["Register Agey"],
      $row['Register Agem'],
      $row['Current Agey'],
      $row['Current Agem'],
      $row['Main Risk'],
      $row['Sub Risk'],
      $row['Final Result'],
      $row['Q1_Q2'],
      $row['Q3_Q4'],
      $row['gad7_amount'],
      $row['PHQ9_amount'],
      $row['Drug3M'],
      $row['SexDrug'],
      $row['ChemSex'],
      $row['Remark'],
    ];
  }
  public function headings(): array
  {
    return [
      'Clinic Code',
      'Visit Date',
      'Pid',
      'FuchiaID',
      'Gender',
      'Reg Year',
      'Register Age',
      'Register Age(Month)',
      'Current Age',
      'Current Age(Month)',
      'Main Risk',
      'Sub Risk',
      'HIV status',
      'PHQ4 (Q1+Q2)',
      'PHQ4 (Q3+Q4)',
      'GAD7 score',
      'PHQ9 score',
      '1. Any type of drug use within 3 months',
      '2. Sexual activities under the drug effect',
      '3. Assessment for problematic chemsex (during last 1 month)',
      'Remark'
    ];
  }
  public function chunkSize(): int
  {
    return 5000; // Process 1,000 rows at a time
  }
  public function columnWidths(): array
  {
    $columns = [];
    foreach (range('A', 'Z') as $char) {
      $columns[] = $char;
    }
    return array_fill_keys($columns, 15);
  }
  public function columnFormats(): array
  {

    return [
      "B" => "d-m-yyyy",
    ];
  }
}

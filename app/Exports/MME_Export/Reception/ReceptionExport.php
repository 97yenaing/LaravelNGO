<?php

namespace App\Exports\MME_Export\Reception;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

class ReceptionExport implements FromCollection, WithMapping, WithHeadings, WithChunkReading, WithColumnFormatting, WithColumnWidths
{
  private $reception_exports;
  public function __construct(Collection $reception_exports)
  {
    $this->reception_exports = $reception_exports;
  }
  public function collection()
  {
    return $this->reception_exports;
  }
  public function map($row): array
  {
    return [

      $row['Clinic Code'],
      $row['Pid'],
      $row['Eyes_code'],
      $row['Reg year'],
      $row['Register Agey'],
      $row['Register Agem'],
      $row['Current Agey'],
      $row['Current Agem'],
      $row['Gender'],
      $row['FuchiaID'],
      $row['PrEPCode'],
      $row['Visit Date'],

      $row['Main Risk'],
      $row['Sub Risk'],

      $row['Fever'],

      $row["Diagnosis_data"]['phacheck'],
      $row["Diagnosis_data"]['pha_new_old'],
      $row["Diagnosis_data"]['pha_cohort'],

      $row["Diagnosis_data"]['artcheck'],
      $row["Diagnosis_data"]['art_new_old'],
      $row["Diagnosis_data"]['art_cohort'],

      $row["Diagnosis_data"]['prepcheck'],
      $row["Diagnosis_data"]['prep_new_old'],

      $row["Diagnosis_data"]['pmtctcheck'],
      $row["Diagnosis_data"]['pmtct_new_old'],

      $row["Diagnosis_data"]['anccheck'],
      $row["Diagnosis_data"]['anc_new_old'],

      $row["Diagnosis_data"]['fmaplancheck'],
      $row["Diagnosis_data"]['famaplan_new_old'],

      $row["Diagnosis_data"]['gneralcheck'],
      $row["Diagnosis_data"]['general_new_old'],
      $row["Diagnosis_data"]['general_diagnosis'],
      $row["Diagnosis_data"]['OPD'],
      $row["Diagnosis_data"]['ncdcheck'],
      $row["Diagnosis_data"]['ncd_new_old'],
      $row["Diagnosis_data"]['ncd_diagnosis'],
      $row["Diagnosis_data"]['ncd_drugSupply'],
      $row["Diagnosis_data"]['hivTBcheck'],
      $row["Diagnosis_data"]['hivTB_new_old'],
      $row["Diagnosis_data"]['fcentercheck'],
      $row["Diagnosis_data"]['feedcentre_new_old'],
      $row["Diagnosis_data"]['labInvestcheck'],
      $row["Diagnosis_data"]['labInvest_new_old'],

      $row['Next Appointment Date'],
      $row['Mode'],
      $row['Unplan'],
      $row['MUAC'],
      $row['Remark'],
      $row['Online'],
    ];
  }
  public function headings(): array
  {
    return [

      'Clinic Code',
      'Pid',
      'Eyes scan code',

      'Register Year',
      'Register Agey',
      'Register Agem(Month)',
      'Current Agey',
      'Current Agem(Month)',
      'Gender',
      'FuchiaID',
      'PrEPCode',
      'Visit Date',

      'Main Risk',
      'Sub Risk',

      'Refer to Fever Team',

      'PHA',
      'PHA New/Old',
      'PHA MAM Cohort',

      'ART',
      'ART New/Old',
      'ART MAM Cohort',

      'PrEP',
      'PrEP New/Old',

      'PMTCT',
      'PMTCT New/Old',

      'ANC',
      'ANC New/Old',

      'Family Planning',
      'Family Planning New/Old',

      'General',
      'General New/Old',
      'General Type of Diagnosis',
      'OPD',

      'NCD',
      'NCD New/Old',
      'NCD Type of Diagnosis',
      'NCD MAM Co-hort',

      'HIV(-) (TB)',
      'HIV(-)(TB) New/Old',

      'Feeding Center',
      'FC New/Old',

      'Lab Investigation Only',
      'Lab Invest New/Old',

      'Next Appointment Date',
      'Mode',
      'Unplan',
      'MUAC',
      'Remark',
      'Online',
    ];
  }
  public function chunkSize(): int
  {
    return 5000; // Process 1,000 rows at a time
  }
  public function columnFormats(): array
  {
    return [
      "L" => "d-m-yyyy",
      "AR" => "d-m-yyyy",
    ];
  }
  public function columnWidths(): array
  {
    return array_fill_keys(range('A', 'Z'), 15);
  }
}

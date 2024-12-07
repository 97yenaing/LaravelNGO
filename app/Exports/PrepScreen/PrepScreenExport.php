<?php

namespace App\Exports\PrepScreen;


use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PrepScreenExport implements FromCollection, WithMapping, WithHeadings, WithChunkReading, WithColumnFormatting, WithColumnWidths
{
  private $prepScreenData;


  public function __construct($prepScreenData)
  {
    $this->prepScreenData = $prepScreenData;
  }
  public function collection()
  {
    return  $this->prepScreenData;
  }
  public function headings(): array
  {
    return [
      'General ID',
      'Intial Date',
      'Name',
      'Phone 1',
      'Phone 2',
      'Prep ID',
      'DHIS2 ID',
      'Sex',
      'Sex Other',
      'Register Age',
      'Current Age',
      'Region',
      'Brith Region',
      'Brith Town',
      'Main Risk',
      'Sub Risk',
      'Facility Name',
      'Virtual KPSC',
      'Navigator Code',
      'Navigator Name',
      'Consider Sex',
      'Consider Sex Other',
      'Sex With',
      'Sex_as_main_source 6 Month',
      'Injected_drugs 6 Month',
      'Wtihout_condom_more_one',
      'Sex_one_more_hiv_risk',
      'History_sti',
      'History PEP',
      'Share_inj_mat',
      'Sex HIV Positive',
      'Requst Prep',
      'Risk_past_72hour',
      'Symtom_past_28day',
      'Reason',
      'HIV Neagative',
      'Tast Date',
      'Result Receive Date',
      'Test Result',
      'Reative Date',
      'Confirmation result',
      'Substantial_risk',
      'No_symptom',
      'PrEP Eligible',
      'No Necessary',
      'No Necessary Reason'


    ];
  }
  public function map($row): array
  {
    return [
      $row["Pid"],
      $row['Inital_date'],
      $row['Name'],
      $row['Phone'],
      $row['Phone2'],
      $row['PrEPCode'],
      $row['DHIS2_id'],
      $row['Gender'],
      $row['Sex_other'],
      $row['Register Agey'],
      $row['Current Agey'],
      $row['Region'],
      $row['Birth_state'],
      $row['Birth_township'],
      $row['Main Risk'],
      $row['Sub Risk'],
      $row['Facility_name'],
      $row['Virtual_KPSC'],
      $row['Nav_code'],
      $row['Peer_Name'],
      $row['Consider_sex'],
      $row['Consider_other_sex'],
      $row['Sex_with'],
      $row['Sex_orgam_6month'],
      $row['Drug_use_6month'],
      $row['Sex_one_noCon'],
      $row['Sex_oneMore_HIV'],
      $row['Sex_STI_transmit'],
      $row['PEP_expose'],
      $row['Inject_equi_share'],
      $row['Sex_HIV_noTre'],
      $row['Prep_req'],
      $row['Risk_case_72H'],
      $row['Symptoms_28D'],
      $row['Reason'],
      $row['HIV_neg'],
      $row['Test_date'],
      $row['Result_date'],
      $row['Test_result'],
      $row['Reative_date'],
      $row['Confirm_result'],
      $row['HIV_sub_risk'],
      $row['HIV_sup_infection'],
      $row['Prep_eligible'],
      $row['NO_necesary'],
      $row['No_reason']


    ];
  }
  public function columnWidths(): array
  {
    $columns = [];
    foreach (range('A', 'Z') as $char) {
      $columns[] = $char;
    }
    return array_fill_keys($columns, 15);
  }

  public function chunkSize(): int
  {
    return 5000; // Process 1,000 rows at a time
  }

  public function columnFormats(): array
  {
    return [
      "B" => "d-m-yyyy",
      "AK" => "d-m-yyyy",
      "AL" => "d-m-yyyy",
      "AN" => "d-m-yyyy",
    ];
  }
}

<?php

namespace App\Exports\MME_Export\TB;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

class TBExport implements FromCollection, WithMapping, WithHeadings, WithChunkReading, WithColumnFormatting, WithColumnWidths
{
  private $tb_records, $testName;
  private $index = 0;
  public function __construct($tb_records, $testName)
  {
    $this->tb_records = $tb_records;
    $this->testName = $testName;
  }

  public function collection()
  {
    return $this->tb_records;
  }
  public function map($row): array
  {
    if ($this->testName == "TB03_Register") {
      return [
        $row->getConnectionName(),
        $row["State_TB03"],
        $row["Township_TB03"],
        $row["FaciName_TB03"],
        $row["RePariod_TB03"],
        $row["TreDate_TB03"],
        $row["TNumber_TB03"],
        $row["Nationality_TB03"],
        $row["Gender"],
        $row['Register Agey'],
        $row['Current Agey'],
        $row["ReferFrom_TB03"],
        $row["TypePatient_TB03"],
        $row["TBsite_TB03"],
        $row["EPTBsite_TB03"],
        $row["TranferIn_TB03"],
        $row["TreRegimens_TB03"],
        $row["TreDate_TB03"],
        $row["Smoke_status_TB03"],
        $row["DMstatue_TB03"],
        $row["Hivstatus_TB03"],
        $row["CPT_start_TB03"],
        $row["ART_start_TB03"],
        $row["Microscope_Res_TB03"],
        $row["XRay_Res_TB03"],
        $row["Xpert_Res_TB03"],
        $row["Calture_Res_TB03"],
        $row["2ndMicroscope_Res_TB03"],
        $row["2ndXpert_Res_TB03"],
        $row["2ndCulture_Res_TB03"],
        $row["3rdMicroscope_Res_TB03"],
        $row["3rdXpert_Res_TB03"],
        $row["3rdCulture_Res_TB03"],
        $row["5rdMicroscope_Res_TB03"],
        $row["5rdXpert_Res_TB03"],
        $row["5rdCulture_Res_TB03"],
        $row["EndTX_Microscope_Res_TB03"],
        $row["EndTX_XRay_Res_TB03"],
        $row["EndTX_Xpert_Res_TB03"],
        $row["1stDst"],
        $row["TrementOut_TB03"],
        $row["Intial_RegimenDate_TB03"],
        $row["TrementOut_Date_TB03"],
        $row["BioClinical_TB03"],
        $row["Counsellor_TB03"],
        $row["Remark_TB03"],
        $row["FuchiaID_TB03"],
        $row["Pid_TB03"],
      ];
    } else if ($this->testName == "Pre_TB") {
      return [
        $row->getConnectionName(),
        $row["Clinic_code"],
        $row["Pid_preTB"],
        $row["FuchiaID"],
        $row['Reg year'],
        $row['Register Agey'],
        $row['Register Agem'],
        $row['Current Agey'],
        $row['Current Agem'],
        $row['Gender'],

        $row["VisitDate_preTB"],
        $row["KAP_preTB"],
        $row["ModEntry_preTB"],
        $row["TBscreenDate_preTB"],
        $row["NextVDate_preTB"],
        $row["HTCRes_preTB"],
        $row["HTCDate_preTB"],
        $row["AFBRes_preTB"],
        $row["AFBDate_preTB"],
        $row["GeneXpertRes_preTB"],
        $row["GeneXpertDate_preTB"],
        $row["CXRRes_preTB"],
        $row["CXRDate_preTB"],
        $row[""], //may yan
        $row[""], //may yan

        $row["FeverDay_preTB"],
        $row["CoughDay_preTB"],
        $row["NsweatDay_preTB"],
        $row["LowDay_preTB"],
        $row["LoaDay_preTB"],

        $row["LympDay_preTB"],
        $row["LympDes_preTB"],
        $row["ReasonCXR_preTB"],
        $row["Recheck_preTB"],
        $row["Month_TBantiTre_preTB"],
        $row["MDprovisional_diagnosisPlan_preTB"],
        $row["Antibiotic_preTB"],
        $row["Sus_ActiveTB_preTB"],
        $row["Other_preTB"],
        $row["FurtherCounsulting_preTB"],
        $row["CounsulingNO_preTB"],
        $row["Radiologist_preTB"],
        $row["MDmanagementPlan_preTB"],
        $row["TechAdvice_preTB"],
        $row["TechAdvice_yes_preTB"],
        $row["MDname_preTB"],
        $row["CaseNode"],

      ];
    } else {
      $this->index++;
      return [
        $row->getConnectionName(),
        $this->index,
        $row["Clinic_code"],
        $row["Pid_iptTB"],
        $row["FuchiaID_iptTB"],

        $row["Register Agey"],
        $row["Current Agey"],
        $row["Gender"],
        $row["IPT_regDate"],
        $row["IPT_startDate"],
        $row["IPT_disconDate"],
        $row["Outcome"],
        $row["Remark"],
        $row["Counsellor"],
      ];
    }
  }
  public function headings(): array
  {
    if ($this->testName == "TB03_Register") {
      return [
        "Database",
        "State/Region Name",
        "Township Name",
        "Facility Name",
        "Reporting Period",
        "Treatment Registar Date",

        "TB Code",
        "Nationality",
        "Sex",


        "Register Age",
        "Current Age",
        "Refered from ",

        "Type of Patient's",
        "Type of Disease",
        "Specify ______ (if EP)
            Site of EPTB
          ",
        "Transfer in",
        "Treatment Regimens",
        "Treatment Start Date",
        "Smoking Status",
        "DM Status",
        "HIV Status",
        "CPT Start Date",
        "ART Start Date",
        "Microscope Result",
        "X-Ray Result",
        "Xpert Result",
        "Culture Result",

        "2nd month Microscope Result",
        "2nd month Xpert Result",
        "2nd month Culture",
        "3rd month Microscope Result",
        "3rd month Xpert Result",
        "3rd month Culture",
        "5th month Microscope Result",

        "5th month Xpert Result",
        "5th month Culture",
        "End of Tx Microscope Result",

        "End of Tx X-Ray Result",

        "End of Tx Xpert Result",
        "1st line DST result",
        "Treatment Outcome",
        "Initial Regimen Started Date",
        "Outcome Date",
        "bacteriological/clinical ",
        "Consular Name",
        "Remark",
        "Fuchia ID",
        "General ID",
      ];
    } else if ($this->testName == "Pre_TB") {
      return [
        "Database",
        "Clinic ID",
        "General ID",
        "Fuchia ID",
        "Register Year",
        "Register Age",
        "Register Age(Month)",

        "Agey",
        "Agem",
        "Sex",
        "Visit Date",
        "KAP:",
        "Mode of entry:",
        "Date of TB screening:",
        "Date of next visit:",
        "HTC result:",
        "HTC Date:",
        "Sputum AFB result:",
        "Sputum AFB date:",
        "GeneXpert result:",
        "GeneXpert date:",
        "Place of CXR:",
        "CXR date:",
        "Lymphadenopathy:", //may yan
        "Previous anti-TB history:", //may yan
        "Fever (days):",
        "Cough (days):",
        "Night sweat (days):",
        "LOW (days):",
        "LOA (days):",
        "Lymphadenopathy (days):",
        "Lymphadenopathy(Describe)",
        "Reason for CXR request:",
        "Recheck after (days of antibiotics):",
        "Months of anti-TB treatment:",
        "MD's provisional diagnosis/action plan:",
        "Antibiotics:",
        "Suspicion on active TB:",
        "Others:",
        "Further consulting needed:",
        "IF No, why:",
        "Radiologist opinion:",
        "MD's Management plan:",
        "Need Tech team advice:",
        "Teach Team advice(Describe)",
        "MD's Name:",
        "Case Noted:",
      ];
    } else {
      return [
        "Database",
        'Sr.',
        'Clinic Code',
        'General ID',
        'Clinic Reg No. (ART No.)',

        'Register Age',
        'Current Age',
        'Sex (M/F)',
        'IPT Registration date (DD/MM/YY)',
        'Really IPT Start date',
        'IPT<br> Discontinuation<br> date (DD/MM/YY)',
        'Outcome',
        'Remarks',
        'Counsellor',
      ];
    }
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
    if ($this->testName == "TB03_Register") {
      return [
        "F" => "d-m-yyyy",
        "Q" => "d-m-yyyy",
        "U" => "d-m-yyyy",
        "V" => "d-m-yyyy",
        "AO" => "d-m-yyyy",
        "AP" => "d-m-yyyy",
      ];
    } else if ($this->testName == "Pre_TB") {
      return [
        "K" => "d-m-yyyy",
        "N" => "d-m-yyyy",
        "O" => "d-m-yyyy",
        "Q" => "d-m-yyyy",
        "S" => "d-m-yyyy",
        "U" => "d-m-yyyy",
        "W" => "d-m-yyyy",
      ];
    } else {
      return [
        "I" => "d-m-yyyy",
        "J" => "d-m-yyyy",
        "K" => "d-m-yyyy",
      ];
    }
  }
}

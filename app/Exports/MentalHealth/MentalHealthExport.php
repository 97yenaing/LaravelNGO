<?php

namespace App\Exports\MentalHealth;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class MentalHealthExport  implements FromCollection, WithMapping, WithHeadings, WithChunkReading, WithColumnFormatting, WithColumnWidths
{
  private $mentalData, $exportName;

  public function __construct($mentalData, $exportName)
  {
    $this->mentalData = $mentalData;
    $this->exportName = $exportName;
  }
  public function collection()
  {
    return  $this->mentalData;
  }

  public function headings(): array
  {
    if ($this->exportName == "Register") {
      return [
        'Clinic',
        'General ID',
        'Fuchia ID',
        'PrEP ID',
        'Age',
        'Sex',
        'HIV status',
        'Registration date',
        'Risk factor',
        'if PWID',
        'OST',
        'Alcohol drinking',
        'PHQ4 (Q1+2)',
        'PHQ4 (Q3+4)',
        'GAD7',
        'PHQ9',
        'Psychosis',
        'Psy Symptoms',
        'Others',
        'Duration',
        'Suicidal risk (Attempt or thought)',
        'If Yes,',
        '1.Drug uses within 3months ( any type)',
        'Willingness to change',
        '2.Sexual activities under the drug effect',
        'Willingness to change2',
        '3.Injectable drug use',
        'Timeframe',
        'ASSIST Score ( Screening)',
        'Name of drug',
        'Score',
        'Name of drug2',
        'Score2',
        'Name of drug3',
        'Score3',
        'Name of drug4',
        'Score4',
        'Name of drug5',
        'Score5',
        'Brief Intervention(BI)',
        'Planned goal',
        'Plan detail',
        'Stage of BI',
        'If no BI,why',
        'Psychosocial Intervention at MAM',
        'Pharmacological management at MAM',
        'Fluoxetine',
        'Haloparidol',
        'Others2',
        'Refer to psychiatrists',
        "MD's initial",
        "CSL's initial",
        'Next follow up date',
      ];
    } elseif ($this->exportName == "FollowUp") {
      return [
        'Clinic',
        'Visit Date',
        'General ID',
        'FUCHIA ID',
        'PrEP ID',
        'Age',
        'Gender',
        'Risk factor',
        'Hiv Result',
        'Improvement of symptoms(any)',
        'Adherence problem for mental health drugs',
        'Mental Health assessment rescreening',
        'PHQ4(Q1/Q2)',
        'PHQ4(Q3/Q4)',
        'PHQ9',
        'GAD7',
        'No assessment rescreening',
        'Drug use assessment',
        'If yes,ASSIST rescreening',
        'Name of drug',
        'Score',
        'Risk',
        'Name of drug 2',
        'Score2',
        'Risk2',
        'Name of drug 3',
        'Score3',
        'Risk3',
        'Name of drug 4',
        'Score4',
        'Risk4',
        'Name of drug 5',
        'Score5',
        'Risk5',
        'Name of drug 6',
        'Score6',
        'Risk6',
        'Brief intervention(BI)',
        'Any change in planned goal',
        'State of BI',
        'Suicidal Risk between the last visit and current visit',
        'Pharmacological side effects',
        'Extrapyramidal side effect',
        'Other side effect',
        'Management side effect',
        'Artane(Trihexyphenidyl)',
        'Other Management',
        'Continue the same treatment',
        'Increased the dosage',
        'Reduced the dosage',
        'Tapering the drug',
        'Restart the drug',
        'Refer to psychiatrist',
        'Stopping the drug',
        'Psychosocial intervention at MAM',
        'Refer to psychiatrist17',
        "MD's initial",
        "CSL's initial",
        'Next follow up date',
      ];
    }
  }
  public function map($row): array
  {
    if ($this->exportName == "Register") {
      return [
        $row["Clinic Code"],
        $row["Pid"],
        $row["FuchiaID"],
        $row["PrePCode"],
        $row["Current Agey"],
        $row["Gender"],
        $row["HivResult"],
        $row["Reg_date"],
        $row["Main Risk"],
        $row["If_pwud"],
        $row["If_pwudEx"],
        $row["Alcohol_drinking"],
        $row["Q1_Q2"],
        $row["Q3_Q4"],
        $row["gad7_amount"],
        $row["PHQ9_amount"],
        $row["Psychosis"],
        $row["Symptoms"],
        $row["Psy_others"],
        $row["Duration"],
        $row["Suicidal_risk"],
        $row["Sucidal_yes"],
        $row["Drug_uses3month"],
        $row["Drug_willingness"],
        $row["Sexual_drug"],
        $row["SexualDrug_willigness"],
        $row["Injectable"],
        $row["Injectable_yes"], //TimeFrame
        $row["Drug_name_1"],
        $row["Drug_name_1_risk"],
        $row["Drug_name_2"],
        $row["Drug_name_2_risk"],
        $row["Drug_name_3"],
        $row["Drug_name_3_risk"],
        $row["Drug_name_4"],
        $row["Drug_name_4_risk"],
        $row["Drug_name_5"],
        $row["Drug_name_5_risk"],
        $row["Brief"],
        $row["Brief_plan"],
        $row["Brief_plan_detail"],
        $row["Brief_stage"],
        $row["Brief_no"],
        $row["Psychosocial_mam"],
        $row["Pharmacologica_mam"],
        $row["Fluoxetine"],
        $row["Haloparidol"],
        $row["Tre_other"],
        $row["Refer_psychiatrist"],
        $row["MD_initial"],
        $row["CSL_initial"],
        $row["Next_meetdate"],

      ];
    } elseif ($this->exportName == "FollowUp") {
      return [
        $row["Clinic Code"],
        $row["Visit_date"],
        $row["Pid"],
        $row["FuchiaID"],
        $row["PrePCode"],
        $row["Current Agey"],
        $row["Gender"],
        $row["Main Risk"],
        $row["HivResult"],
        $row["Improve_symp"],
        $row["Adh_problem"],
        $row["Mental_asses_rescreen"],
        $row["Q1_Q2"],
        $row["Q3_Q4"],
        $row["gad7_amount"],
        $row["PHQ9_amount"],
        $row["No_asses_describe"],
        $row["Drug_reassesment"],
        $row["Assist_score_screen"],
        $row["Drug_1"],
        $row["Scroe_1"],
        $row["Scroe_1_risk"],
        $row["Drug_2"],
        $row["Scroe_2"],
        $row["Scroe_2_risk"],
        $row["Drug_3"],
        $row["Scroe_3"],
        $row["Scroe_3_risk"],
        $row["Drug_4"],
        $row["Scroe_4"],
        $row["Scroe_4_risk"],
        $row["Drug_5"],
        $row["Scroe_5"],
        $row["Scroe_5_risk"],
        $row["Drug_6"],
        $row["Scroe_6"],
        $row["Scroe_6_risk"],
        $row["Brief"],
        $row["Brief_plan_changeDetail"],
        $row["Brief_stage"],
        $row["Sucidal_risk_between_lastVist"],
        $row["Phamological_effect"],
        $row["Extrapyramidal_effect"],
        $row["Other_effect"],
        $row["Management_effect"],
        $row["Artane"],
        $row["Other_management"],
        $row["Continue_same_traeat_describe"],
        $row["Increase_dosage_describe"],
        $row["Reduce_dosage_describe"],
        $row["Tapering_drug_describe"],
        $row["Restart_drug_describe"],
        $row["Refer_psychiatrist"],
        $row["Stop_drug"],
        $row["Psy_interview_mam"],
        $row["Other_refer_psychiatrist"],
        $row["MD_initial"],
        $row["CSL_initial"],
        $row["Next_meetdate"],

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
    if ($this->exportName == "Register") {
      return [
        'H' => 'dd-mm-yyyy',
        'BA' => 'dd-mm-yyyy',
      ];
    } else {
      return [
        'B' => 'dd-mm-yyyy',
        'BG' => 'dd-mm-yyyy',
      ];
    }
  }
}

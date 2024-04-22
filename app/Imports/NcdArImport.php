<?php

namespace App\Imports;
use App\Models\Ncd_AR;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class NcdArImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Ncd_AR([
            //'name'     => $row[0],
          //  'email'    => $row[1],
          //  'password' => Hash::make($row[2])

            'pid'                         => $row[0],
            'Visit_date'                  => $row[1],
            'NCD_diagnosis'               => $row[2],
            'ar_num'                      => $row[3],
            'ar_date'                     => $row[4],

            'ar_bmi'                      => $row[5],
            'ar_systBP'                   => $row[6],
            'Annual_Check_Pulse_for_AF'   => $row[7],

            'ar_fbs'                      => $row[8],
            'ar_hba1c'                    => $row[9],
            'Urine_Protein'               => $row[10],
            'Urine_glucose'               => $row[11],

            'ar_creatinine'               => $row[12],
            'ar_CrCl'                     => $row[13],
            'ar_urine_acr'                => $row[14],
            'ar_total_chol'               => $row[15],
            'ar_HDL'                      => $row[16],

            'ar_LDL'                      => $row[17],
            'ar_Triglyceride'             => $row[18],
            'ar_ALT'                      => $row[19],
            'ar_CVD_risk_score'           => $row[20],
            'ar_Dia_foot_check'           => $row[21],

            'ar_Refer_retinopathy_2_yearly'=> $row[22],
            'ar_dietary_advice'           => $row[23],
            'ar_Advice_physical_activity' => $row[24],
            'ar_discuss_smoking'          => $row[25],
            'ar_doc'                      => $row[26]
        ]);
    }
}

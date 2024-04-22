<?php

namespace App\Imports;
use App\Models\HtyANcdFollowup;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class NcdFollowupImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {


        return new HtyANcdFollowup([
            //'name'     => $row[0],
          //  'email'    => $row[1],
          //  'password' => Hash::make($row[2])
            'pid'                         => $row[0],
            'pt_fuchiaid'                 => $row[1],
            'Visit_date'                  => $row[2],
            'visit_type'                  => $row[3],
            'visitdt'                     => $row[4],
            'fu_fuchiaid'                 => $row[5],
            'NCD_Diagnosis'               => $row[6],
            'weight'                      => $row[7],
            'height'                      => $row[8],
            'bmi'                         => $row[9],
            'curage'                      => $row[10],
            'stage_of_hypertension'       => $row[11],
            'rbs_result'                  => $row[12],
            'fbs_result'                  => $row[13],
            'HBA1C'                       => $row[14],
            'HbA1C_Unit'                  => $row[15],
            'fsystBP'                     => $row[16],
            'fdiasBP'                     => $row[17],
            'urinalysis'                  => $row[18],
            'creatinine'                  => $row[19],
            'Serum_creatinine_unit'       => $row[20],
            'invistigations'              => $row[21],
            'rbs_next_appt'               => $row[22],
            'crcl'                        => $row[23],
            'fbs_next_appt'               => $row[24],
            'hba1c_next_appt'             => $row[25],
            'urine_acr'                   => $row[26],
            'bp_next_appt'                => $row[27],
            'total_cholesterol'           => $row[28],
            'Total_Cholesterol_Unit'      => $row[29],
            'uri_next_appt'               => $row[30],
            'triglyceride'                => $row[31],
            'Triglyceride_unit'           => $row[32],
            'hdl'                         => $row[33],
            'HDL_unit'                    => $row[34],
            'ldl'                         => $row[35],
            'LDL unit'                    => $row[36],
            'CVD risk'                    => $row[37],
            'Statin_Y/N'                  => $row[38],
            'alt'                         => $row[39],
            'Urine_done/not_done'         => $row[40],
            'protein_res'                 => $row[41],
            'glucose_res'                 => $row[42],
            'urine_oth'                   => $row[43],
            'oth_inv1'                    => $row[44],
            'oth_inv1_res'                => $row[45],
            'oth_inv2'                    => $row[46],
            'oth_inv2_res'                => $row[47],
            'oth_inv3'                    => $row[48],
            'oth_inv3_res'                => $row[49],
            'oth_inv4'                    => $row[50],
            'oth_inv4_res'                => $row[51],
            'oth_inv5'                    => $row[52],
            'oth_inv5_res'                => $row[53],
            'oth_inv6'                    => $row[54],
            'oth_inv6_res'                => $row[55],
            'Lifestyle_advice'            => $row[56],
            'Medication_changed'          => $row[57],
            'Patient_adherence_to_medication'=> $row[58],
            'Amlodipine_dose'             => $row[59],
            'Amlodipine_frequency'        => $row[60],
            'famlodipine_dur'             => $row[61],
            'Enalapril_dose'              => $row[62],
            'Enalapril_frequency'         => $row[63],
            'fenalapril_dur'              => $row[64],
            'Atorvastain_dose'            => $row[65],
            'Atorvastain_frequency'       => $row[66],
            'fatorvastain_dur'            => $row[67],
            'Hydrochlorothiazide dose'    => $row[68],
            'Hydrochlorothiazide frequency'=> $row[69],
            'fhydrochlorothiazide_dur'    => $row[70],
            'Aspirin_dose'                => $row[71],
            'Aspirin_frequency'           => $row[72],
            'faspirin_dur'                => $row[73],
            'Metformin_500_dose'          => $row[74],
            'Metformin_500_frequency'     => $row[75],
            'fmetformin500_dur'           => $row[76],
            'Metformin_1000_dose'         => $row[77],
            'Metformin_1000_frequency'    => $row[78],
            'fmetformin1000_dur'          => $row[79],
            'Gliclazide_500_dose'         => $row[80],
            'Gliclazide_500_frequency'    => $row[81],
            'fgliclazide500_dur'          => $row[82],
            'Gliclazide_1000_dose'        => $row[83],
            'Gliclazide_1000_frequency'   => $row[84],
            'fgliclazide1000_dur'         => $row[85],
            'Symptom_hypoglycemia'        => $row[86],
            'oth_complains'               => $row[87],
            'Followup_Other_Medication'   => $row[88],
            'foth_med_spec'               => $row[89],
            'Referral_to_secondary_care'  => $row[90],
            'ref_res'                     => $row[91],
            'Hypertension_control'        => $row[92],
            'Diabetes_control'            => $row[93],
            'Next_appointment_date'       => $row[94],
            'Doctor_Name'                 => $row[95]
        ]);
    }
}

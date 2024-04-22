<?php

namespace App\Imports;

use App\Models\LabAfbTest;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Crypt;
class Lab_afb_Import implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $table = 'General';
        return new LabAfbTest([
            'clinic code' => $row[0],
            'CID' => $row[1],
            'fuchiacode' => $row[2],
            'agey' => $row[3],
            'agem' => $row[4],
            'Gender' => Crypt::encrypt_light($row[5], $table),
            'Requested Doctor' => Crypt::encrypt_light($row[6], $table),
            'visit_date' => $row[7],
            'Patient Type' => Crypt::encrypt_light($row[8], $table),
            'Patient Type Sub' => Crypt::encrypt_light($row[9], $table),
            'afb_pt_name' => Crypt::encryptString($row[10], $table),
            'afb_pt_address' => Crypt::encryptString($row[11], $table),
            'Previous_TB' => Crypt::encrypt_light($row[12], $table),
            'HIV_status' => Crypt::encrypt_light($row[13], $table),
            'reason_for_exam' => Crypt::encrypt_light($row[14], $table),
            'afb_Pt_type' => Crypt::encrypt_light($row[15], $table),
            'follow_up_mt' => Crypt::encrypt_light($row[16], $table),
            'speci_type' => Crypt::encrypt_light($row[17], $table),
            'oth_spe_ty' => Crypt::encrypt_light($row[18], $table),
            'slide_num_1' => Crypt::encrypt_light($row[19], $table),
            'speci_receive_dt1' => $row[20],
            'visual_app_1' => Crypt::encrypt_light($row[21], $table),
            'afb_result1' => Crypt::encrypt_light($row[22], $table),
            'slide1_grading1' => Crypt::encrypt_light($row[23], $table),
            'slide_num_2' => $row[24],
            'speci_receive_dt2' => $row[25],
            'visual_app_2' => Crypt::encrypt_light($row[26], $table),
            'afb_result2' => Crypt::encrypt_light($row[27], $table),
            'slide2_grading2' => Crypt::encrypt_light($row[28], $table),
            'afb_lab_techca' => Crypt::encrypt_light($row[29], $table),
            'afb_issue_date' => $row[30],
        ]);
    }
}

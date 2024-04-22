<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cervicalcancer extends Model
{
    use HasFactory;
    protected $fillable=[
            'Clinic_code',
            "General ID",
            "FuchiaID",
            "Agey",
            "Hiv_Status",
            "FSW",
            "Visit_date",
            "No_previous_preg",
            "Birth_spacing_met",
            "LMP",
            "UCG_test_date",
            "UCG_test_res",
            "Discharge",
            "Cervix_bleed_touch",
            "Tenderness",
        
            "Malignancy",
            "Comments_spec",
            "Breast_self",
            "Breast_family_his",
            "Breast_examination",
            "Breast_abnormal_find_breast",
            "Breast_remark",

            "Sti_Complaint",
            "Sti_examination",
            "VIA_Screening_History",
            "VIA_test",
            "VIA_postpone_reason",
            "VIA_specify_reason",
            "SCJ",
            "VIA_test_Result",
            "refer_OG",
            "Counselling_VIA_result_done",
            "Eglible_thermal_ablation",
            "Eglible_thermal_ablation_reason",
            "Eglible_thermal_ablation_specify",
            "Thermal_ablation_done",
            "Thermal_No_specify",
            "Thermal_other_specify",
            "Postpone_date",
            "Thermal_ablation_result",
            "Thermal_ablation_performed",
            "Date",
            "Followup_date",
            "Tertiary_Further_treatment",
            "AE(Y/N)",
            "AE_Date",
            "Complaint",
            "Complaint_yes",
            "Complaint_other",
            "Refer_Hosp",
            "AE_realated_thermal_ablation",
            "Treatment",
            "AE_followUp_Date",
    ];
    protected $connection ='mysql';
    public function ptconfig(){
        return $this->belongsTo(PtConfig::class,"General ID","Pid");
    }

}

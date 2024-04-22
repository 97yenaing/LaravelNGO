<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NcdAnual extends Model
{
    use HasFactory;
    protected $fillable = [
      'pid'  ,
      'Visit_date' ,
      'NCD_diagnosis',
      'ar_num' ,
      'ar_date' ,

      'ar_bmi',
      'ar_systBP',
      'Annual_Check_Pulse_for_AF',

      'ar_fbs'  ,
      'ar_hba1c'  ,
      'Urine_Protein',
      'Urine_glucose',

      'ar_creatinine' ,
      'ar_CrCl' ,
      'ar_urine_acr',
      'ar_total_chol',
      'ar_HDL' ,

      'ar_LDL',
      'ar_Triglyceride',
      'ar_ALT' ,
      'ar_CVD_risk_score',
      'ar_Dia_foot_check',

      'ar_Refer_retinopathy_2_yearly',
      'ar_dietary_advice' ,
      'ar_Advice_physical_activity',
      'ar_discuss_smoking' ,
      'ar_doc'
    ];
}

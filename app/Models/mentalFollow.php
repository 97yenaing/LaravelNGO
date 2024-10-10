<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mentalFollow extends Model
{
    use HasFactory;
    protected $fillable = [
        'Pid',
        'Visit_date',
        'Improve_symp',
        'Adh_problem',
        'Mental_asses_rescreen',
        'No_asses_describe',
        'Drug_reassesment',
        'Assist_score_screen',
        'Scroe_1',
        'Scroe_1_risk',
        'Scroe_2',
        'Scroe_2_risk',
        'Scroe_3',
        'Scroe_3_risk',
        'Scroe_4',
        'Scroe_4_risk',
        'Brief',
        'Brief_plan',
        'Brief_plan_detail',
        'Brief_plan_changeDetail',
        'Brief_stage',
        'Sucidal_risk_between_lastVist',
        'Phamological_effect',
        'Extrapyramidal_effect',
        'Other_effect',
        'Management_effect',
        'Artane',
        'Other_management',
        'Continue_same_traeat',
        'Continue_same_traeat_describe',
        'Increase_dosage',
        'Increase_dosage_describe',
        'Reduce_dosage',
        'Reduce_dosage_describe',
        'Tapering_drug',
        'Tapering_drug_describe',
        'Restart_drug',
        'Restart_drug_describe',
        'Refer_psychiatrist',
        'Stop_drug',
        'Psy_interview_mam',
        'Other_refer_psychiatrist',
        'Mental_hospital',
        'General_hospital',
        'Private_psychiatrist',
        'MD_initial', // Use string for fixed-length text
        'CSL_initial',
        'Next_meetdate',
    ];
}

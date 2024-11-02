<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mentalRegister extends Model
{
    protected $connection = 'mysql';
    use HasFactory;
    protected $fillable = [
        'Pid',
        'Hiv_status',
        'If_pwud',
        'If_pwudEx',
        'Alcohol_drinking',
        'Reg_date',
        'Psychosis',
        'Symptoms',
        'Psy_others',
        'Duration',
        'Suicidal_risk',
        'Sucidal_yes',
        'Drug_uses3month',
        'Drug_willingness',
        'Sexual_drug',
        'SexualDrug_willigness',
        'Injectable',
        'Injectable_yes',
        'ASSIST_score',
        'Drug_name_1',
        'Drug_name_1_risk',
        'Drug_name_2',
        'Drug_name_2_risk',
        'Drug_name_3',
        'Drug_name_3_risk',
        'Drug_name_4',
        'Drug_name_4_risk',
        'Drug_name_5',
        'Drug_name_5_risk',
        'Brief',
        'Brief_plan',
        'Brief_plan_detail',
        'Brief_stage',
        'Brief_no',
        'Psychosocial_mam',
        'Pharmacologica_mam',
        'Fluoxetine',
        'Haloparidol',
        'Tre_other',
        'Refer_psychiatrist',
        'Mental_hospital',
        'General_hospital',
        'Private_psychiatrist',
        'MD_initial',
        'CSL_initial',
        'Next_meetdate',

    ];
    public function ptconfig()
    {
        return $this->belongsTo(PtConfig::class, 'Pid', 'Pid');
    }
}

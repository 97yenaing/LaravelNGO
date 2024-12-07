<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class prepScreen extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    protected $fillable = [
        'Pid',
        'Inital_date',
        'DHIS2_id',
        'Sex_other',
        'Birth_state',
        'Birth_township',
        'Facility_name',
        'Virtual_KPSC',
        'Nav_code',
        'Consider_sex',
        'Consider_other_sex',
        'Sex_with',
        'Sex_orgam_6month',
        'Drug_use_6month',
        'Sex_one_noCon',
        'Sex_oneMore_HIV',
        'Sex_STI_transmit',
        'PEP_expose',
        'Inject_equi_share',
        'Sex_HIV_noTre',
        'Prep_req',
        'Risk_case_72H',
        'Symptoms_28D',
        'Reason',
        'HIV_neg',
        'Test_date',
        'Result_date',
        'Test_result',
        'Reative_date',
        'Confirm_result',
        'HIV_sub_risk',
        'HIV_sup_infection',
        'Prep_eligible',
        'NO_necesary',
        'No_reason',
        //ko myo min ss DB
        'die_effect',
        'oth_might_think',
        'time_req_followup',
        'safety_med',
        'effectiveness_med',
        'other',
        'other_specify',
        'ref_pep',
        'ref_hiv_retest',
        'ref_hiv_treat',
    ];

    public function ptconfig()
    {
        return $this->belongsTo(PtConfig::class, 'Pid', 'Pid');
    }
}

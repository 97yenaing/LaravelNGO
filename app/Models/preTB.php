<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class preTB extends Model
{
    use HasFactory;
    protected $fillable = [
        'Clinic_code',
        'Pid_preTB',
        'FuchiaID_preTB', 
        'Agey_preTB',
        'Agem_preTB',
        'Gender_preTB',
        'VisitDate_preTB',
        'KAP_preTB',
        'ModEntry_preTB',
        'NextVDate_preTB',
        'TBscreenDate_preTB',
        'HTCRes_preTB',
        'HTCDate_preTB',
        'AFBRes_preTB',
        'AFBDate_preTB',
        'GeneXpertRes_preTB',
        'GeneXpertDate_preTB',
        'CXRRes_preTB',
        'CXRDate_preTB',
        'FeverDay_preTB',
        'CoughDay_preTB',

        'LowDay_preTB',
        'LoaDay_preTB',
        'lymph_check',
        
        'AntiTB_History_preTB',
        'NsweatDay_preTB',

        'LympDay_preTB',
        'LympDes_preTB',

        'ReasonCXR_preTB',
        'Recheck_preTB',
        'Month_TBantiTre_preTB',
        'MDprovisional_diagnosisPlan_preTB',
        'Antibiotic_preTB',
        'Sus_ActiveTB_preTB',
        'FurtherCounsulting_preTB',
        'CounsulingNO_preTB',
        'Other_preTB',
        'Radiologist_preTB',
        'MDmanagementPlan_preTB',
        'TechAdvice_preTB',
        'TechAdvice_yes_preTB',
        'MDname_preTB',
        'CaseNodeIn',
        'CaseNode',
    ];
    protected $connection ='mysql';
    public function ptconfig(){
        return $this->belongsTo(PtConfig::class,"Pid_preTB","Pid");
    }
}

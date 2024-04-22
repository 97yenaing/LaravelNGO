<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tb_registerO3 extends Model
{
    use HasFactory;
    protected $fillable = [
            'Clinic_code',
            'Pid_TB03',
            'FuchiaID_TB03', 
            'TNumber_TB03',
            'Age_TB03',
            'Gender',
            'TreDate_TB03',
            'State_TB03',
            'Township_TB03',
            'Nationality_TB03',
            'FaciName_TB03',
            'RePariod_TB03',
            'TranferIn_TB03',
            'ReferFrom_TB03',
            'TypePatient_TB03',
            'TBsite_TB03',
            'EPTBsite_TB03',
            'TreRegimens_TB03',
            'Smoke_status_TB03',
            'DMstatue_TB03',
            'Hivstatus_TB03',
            'ART_start_TB03',
            'CPT_start_TB03',
            'Microscope_Res_TB03',
            'Xpert_Res_TB03',
            'XRay_Res_TB03',
            'Calture_Res_TB03',
            'Counsellor_TB03',
            'BioClinical_TB03',
            '2ndMicroscope_Res_TB03',
            '2ndXpert_Res_TB03',
            '3rdMicroscope_Res_TB03',
            '3rdXpert_Res_TB03',
            '5rdMicroscope_Res_TB03',
            '5rdXpert_Res_TB03',
            'EndTX_Microscope_Res_TB03',
            'EndTX_XRay_Res_TB03',
            'EndTX_Xpert_Res_TB03',
            'TrementOut_TB03',
            'Intial_RegimenDate_TB03',
            'TrementOut_Date_TB03',
            'EstimentOut_Date_TB03',
            'Remark_TB03',
            '1stDst',
            '2ndCulture_Res_TB03',
            '3rdCulture_Res_TB03',
            '5rdCulture_Res_TB03'
    ];
    protected $connection ='mysql';
    public function ptconfig(){
        return $this->belongsTo(PtConfig::class,"Pid_TB03","Pid");
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cmv extends Model
{
    use HasFactory;
    protected $fillable=[
        "Clinic_code",
        "Pid_cmv",
        "FuchiaID_cmv",
        "Sex",
        "Agey",
        "Visit_date",
        "Patient_Type",
        "Art_Status",
        "Currnt_Art_Regime",
        "Art_StartDate",
        "Most_CD4",
        "Recent_CD4Date",
        "Symptom",
        "Vision_Right",
        "Vision_Left",
        "Finding_Right",
        "Finding_Rdx",
        "Finding_Left",
        "Finding_Ldx",
        "Treatment_Right",
        "Treatment_Left",
        "Doctor_name",
        'Remark',
        'Org',
        'Follow_Date',
        'updated_by'
    ];
    protected $connection ='mysql';
    public function ptconfig(){
        return $this->belongsTo(PtConfig::class,"Pid_cmv","Pid");
    }
}

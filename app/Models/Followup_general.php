<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Followup_general extends Model
{
    use HasFactory;
      protected $fillable =[
        "Clinic Code",
        "Pid",
        "Agey",
        "Agem",
        "Gender",
        "FuchiaID",
        "PrEPCode",
        'Visit Date',

        "Main Risk",
        "Sub Risk",

        "Patient Type",
        "New_Old",
        "Fever",
        "Diagnosis",
        "Support",

        "Patient Type_1",
        "New_Old_1",
        "Fever_1",
        "Diagnosis_1",
        "Support_1",
        'Current_MD',

        // "Patient Type_2",
        // "New_Old_2",
        // "Fever_2",
        // "Diagnosis_2",
        // "Support_2",

        "Next Appointment Date",
        'Follow_up_md',// Add according to AClinic
        'Mode',
        'Unplan',
        'created_by',
        'updated_by',
        'Weight',
        'Height',
        'MUAC',
        'Pateint_Diagnosis',
        'Remark',
        'Online'
      ];

      public function logSheet()
    {
        return $this->hasMany(PreventionLogsheet::class,'Pid');
    }
   public function hiv()
  {
    
    return $this->hasOne(Lab::class, 'CID', 'Pid');
  }

    protected $connection ='mysql';
    public function ptconfig(){
        return $this->belongsTo(PtConfig::class,"Pid","Pid");
    }
}
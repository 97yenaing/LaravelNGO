<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreventionCBS extends Model
{
    use HasFactory;
    protected $fillable = [
        "Clinic Code",
        'Pid',
        "FuchiaID",
        "PrEPCode",
        "Visit_Date",
        
        "Agey",
        "Sex",
        "Main_Risk",
        "Sub_Risk",
        "HIV result",
        "New_Old",//Reached KP and their Partners (Calender yr)
        "Meeting Point",
        "Service Provision",
        "Retesting",//     Retesting within the calender year(Yes/No)
        "HIV_determine_result",
        "HIV Sero-Status",
        "Counselling_pretest",
        "Counselling_posttest",
        "Refer_to",//     If reactive refer to
        "date_confirm",//     Date of arrival at confirmation Facility (DD/MM/YY)
        "HIV Sero-Status", //     HIV Sero-status after confirmation
        "Remark",

        "Service_Modality",
        "Mode_of_Entry",
    ];
    protected $connection ='mysql';
    public function ptconfig(){
        return $this->belongsTo(PtConfig::class,"Pid","Pid");
    }
}

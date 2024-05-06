<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreventionLogsheet extends Model
{
    use HasFactory;
 
    protected $fillable = [
    
            "He Code"               ,
            "Clinic Code"           ,
            'Pid'                   ,
            
            "PrEPCode"              ,
            "Reg_Date"              ,
            "Agey"                  ,
            "Sex"                   ,
            "Initial Risk"          ,// add         
            "Risk changed"          ,// add  
            "Changed_Risk"          ,// add  
            "Risk changed Date"     ,// add  
            "Visit_Date"            ,
            "Visit Type"            ,// add  
            "New_Old"               ,

            "Main_Risk"             ,
            "Sub_Risk"              ,
            "Substantial Risk"      ,
            "Meeting Point"         ,
            "Service Provision1"    ,
            "Service Provision2"    ,
            "Service Provision3"    ,
            "HE_Section"            ,
            "Ns_distribute"         ,
            "Condom_m"              ,
            "Condom_f"              ,
            "Ns_return"             ,

            "HIV Status"            ,
            "Test_duration"         ,
            "HTS done"              ,
            "HIV_1st_result"        ,// add  
            "HIV_2nd_result"        ,// add  
            "HIV_3rd_result"        ,// add  
            "HIV_Final_result"      ,// Final
            "date_confirm"          ,
            "FuchiaID"              ,

            "Reach_whom"            ,
            // township_log	 need to ask (Reuse or not)
            "Source_doc"            ,
            "Remark"                ,
            "Month"                 ,// add  
            "Reg Year"              ,// add  
            "Visit Year"            ,// add  
            "Current Age"           ,// add
            "Mental_Health"  ,
            "PHQ4_Q1_Q2",
            "PHQ4_Q3_Q4",
            "OST_Done",
            "OST_Accept",
            "Decline_Reason",
            "OST_Initial_Date",
            "Test_Clinic",
            "Test_New_Old",
            'OST_Eligible',
            'Decline_Reason_new',
            'Referral_Coupon',
            'updated_by',
    
    ];
    protected $connection ='mysql';
    public function ptconfig(){
        return $this->belongsTo(PtConfig::class,"Pid","Pid");
    }

}
<?php

namespace App\Exports;;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use App\Models\PtConfig;
use App\Models\Patients;
use Illuminate\Support\Facades\Crypt;

class RiskChange 
{   
    public static function risk_Change($pid,$main_risk) {
        
        foreach ($pid as $key => $once_pid) {
            if($main_risk[$key]=="PWID/MSM"){
                
                PtConfig::where("Pid",$once_pid)->update([
                    'Main Risk'=>Crypt::encrypt_light("IDU","General"),
                    'Sub Risk'=>Crypt::encrypt_light("PWID_MSM","General"),
                    'Former Risk'=>Crypt::encrypt_light("IDU","General"),
                ]);
                Patients::where("Pid",$once_pid)->update([
                    'Main Risk'=>Crypt::encrypt_light("IDU","General"),
                    'Sub Risk'=>Crypt::encrypt_light("PWID_MSM","General"),
                    'Former Risk'=>Crypt::encrypt_light("IDU","General"),
                ]);

            }else{
                PtConfig::where("Pid",$once_pid)->update([
                    'Main Risk'=>Crypt::encrypt_light($main_risk[$key],"General"),
                    'Sub Risk'=>null,
                    'Former Risk'=>Crypt::encrypt_light($main_risk[$key],"General"),
                ]);
                Patients::where("Pid",$once_pid)->update([
                    'Main Risk'=>Crypt::encrypt_light($main_risk[$key],"General"),
                    'Sub Risk'=>null,
                    'Former Risk'=>Crypt::encrypt_light($main_risk[$key],"General"),
                ]);
            }
            
        }
    }
}

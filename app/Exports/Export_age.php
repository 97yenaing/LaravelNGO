<?php

namespace App\Exports;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Illuminate\Support\Facades\Crypt;
use Carbon\Carbon;


class Export_age 
{
    public static function Export_general($config,$vdate,$DOB,$origin_data){
        $modify=$origin_data;
        if($vdate==null){
            $currentYear = Carbon::now()->year;
            $currentMonth = Carbon::now()->month;
        }else{
            
            $vdate=explode("-",$vdate);
            $currentYear=$vdate[0];
            $currentMonth=$vdate[1];
        }
        $config["Pid"]=strval($config["Pid"]);
        $DOB=Crypt::DecryptString($DOB);
        $DOB=explode("-",$DOB);
        
        if(strlen($config["Pid"])==11){
            $clinic_code=substr($config["Pid"], 1, 2);
            $he_code=substr($config["Pid"], 0, 1);
            $reg_year="20".substr($config["Pid"],3, 2);
            $code=substr($config["Pid"],5);
        }else if(strlen($config["Pid"])==12){
            $clinic_code=substr($config["Pid"], 2, 2);
            $he_code=substr($config["Pid"], 0, 2);
            $reg_year="20".substr($config["Pid"],4, 2);
            $code=substr($config["Pid"],6);
        }else if(strlen($config["Pid"])==10){
            $clinic_code=substr($config["Pid"], 0, 2);
            $he_code="";
            $reg_year="20".substr($config["Pid"],2, 2);
            $code=substr($config["Pid"],4);
        }else{
            dd($config["Pid"]);
        }
        
        if($config["Agey"]!=0){
            $current_agey=($currentYear- $reg_year)+$config["Agey"];
            $current_agem="0";

        }else{
            if($currentYear==intval($DOB[0])){
                $current_agem=($currentMonth-intval($DOB[1]));
                $current_agey="0";
            }else{
                $current_age=$currentYear-intval($DOB[0]);
                if($current_age==1){
                    if(intval($DOB[1])>$currentMonth){
                        $current_agem=((12-intval($DOB[1]))+$currentMonth);
                        $current_agey="0";
                    }else{
                        $current_agey=$current_age;
                        $current_agem="0";
                    }
                }else{
                    $current_agey=$current_age;
                    $current_agem="0";
                }
                
               
            }
        }
        if($vdate==null&&$config["Agey"]==null){
            $current_agey=404;
            $current_agem=404;
        }
        
        for ($i=0; $i <strlen($code) ; $i++) {
           if($code[$i]!="0"){
            $code=substr($code,$i);
            break;
           }
           
        }
        
        $origin_data["Clinic Code"]=$clinic_code;
        $origin_data["He Code"]=$he_code;
        $origin_data["Reg year"]=$reg_year;
        $origin_data["Register Agey"]=$config["Agey"];
        $origin_data["Register Agem"]=$config["Agem"];
        $origin_data["Current Agey"]=$current_agey;
        $origin_data["Current Agem"]=$current_agem;

        return $origin_data;
    }
}
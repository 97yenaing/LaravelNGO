<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\PtConfig;
use App\Models\Patients;
use App\Models\Followup_general;
use App\Models\cmv;
use App\Exports\CMV\CMV_Export;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Crypt;
use App\Exports\Export_age;
use App\Exports\RiskChange;

class CmvController extends Controller
{
  public function CMV_View(){
    return view('CMV.cmv_treatment');
  }

  public function CMV(Request $request){
    $table="General";
    $cmv_general=[];
    $notice=$request["notice"];
    if($notice=="Find the Patient"){
      $cmv_histData=[];
      $Pidcmv=$request["cmv_Pid"];
      $Fidcmv=$request["cmv_Fid"];
      $cmv_general= PtConfig::select("Pid","FuchiaID","Agey","Agem","Gender")
                                        ->where('Pid', $Pidcmv)
                                        ->orwhere(function ($query) use ($Fidcmv,$Pidcmv) {
            if ($Fidcmv !== null && $Fidcmv !== "-"&& $Pidcmv==null) {
                  $query->where('FuchiaID', $Fidcmv);
              }
      })->latest()->first();

      if($cmv_general!= null){
            $cmv_general["Gender"]=Crypt::decrypt_light($cmv_general['Gender'],$table);
      }
          
      $cmv_history=cmv::where('Pid_cmv', $Pidcmv)
                              ->orwhere(function ($query) use ($Fidcmv,$Pidcmv) {
                                if ($Fidcmv != null && $Fidcmv != "-" && $Pidcmv==null) {
                                    $query->where('FuchiaID_cmv',$Fidcmv);
                                }})
                              ->get();
         

              if($cmv_history != null){
                foreach ($cmv_history as $index=>$cmv_histData) {
                  $cmv_history[$index]["Art_Status"] = Crypt::decrypt_light($cmv_histData["Art_Status"], $table);
                  $cmv_history[$index]["Currnt_Art_Regime"] = Crypt::decrypt_light($cmv_histData["Currnt_Art_Regime"], $table);
                  $cmv_history[$index]["Most_CD4"] = Crypt::decrypt_light($cmv_histData["Most_CD4"], $table);
                }
              
              }
              return response()->json([
                $cmv_general,$cmv_history
              ]);
        
    }

    else if($notice=="cmv save Record"){
      $cmvHas=cmv::where("Visit_date",$request["cmv_vDate"])->where("Pid_cmv",$request["cmv_pid"])->exists();
      if(!$cmvHas){
        cmv::create([
          "Clinic_code"=>$request["Clinic Code"],
          "Pid_cmv"=>$request["cmv_pid"],
          "FuchiaID_cmv"=>$request["cmv_fid"],
          "Sex"=>Crypt::encrypt_light($request["cmv_sex"],$table),
          "Agey"=>$request["cmv_age"],
          "Visit_date"=>$request["cmv_vDate"],
          "Patient_Type"=>$request["cmv_ptype"],
          "Art_Status"=>Crypt::encrypt_light($request["cmv_artStatus"],$table),
          "Currnt_Art_Regime"=>Crypt::encrypt_light($request["cmv_artRegime"],$table),
          "Art_StartDate"=>$request["cmv_artStartDate"],
          "Most_CD4"=>Crypt::encrypt_light($request["cmv_CD4"],$table),
          "Recent_CD4Date"=>$request["cmv_CD4Date"],
          "Symptom"=>$request["cmv_Symptoms"],
          "Vision_Right"=>$request["Find_Righteye"],
          "Vision_Left"=>$request["Find_Lefteye"],
          "Finding_Right"=>$request["cmv_RFDeye"],
          "Finding_Rdx"=>$request["cmv_RFDTeye"],
          "Finding_Left"=>$request["cmv_LFDeye"],
          "Finding_Ldx"=>$request["cmv_LFDTeye"],
          "Treatment_Right"=>$request["cmv_TreReye"],
          "Treatment_Left"=>$request["cmv_TreLeye"],
          "Doctor_name"=>$request["eye_doctor"],
          "Remark"=>$request["cmv_remark"],
          "Org"=>$request["cmv_org"],
          "Follow_Date"=>$request["cmv_FollowDate"],
         
        ]);
        return response()->json([
          "Successfully",
         ]);
      }else{
        return response()->json([
          "This Patient has been save in this day",
         ]);
      }
    }


    else if($notice=="cmv Update Record"){
      cmv::where("id",$request["update_id"])->update([
          "Clinic_code"=>$request["Clinic Code"],
          "Pid_cmv"=>$request["cmv_pid"],
          "FuchiaID_cmv"=>$request["cmv_fid"],
          "Sex"=>Crypt::encrypt_light($request["cmv_sex"],$table),
          "Agey"=>$request["cmv_age"],
          "Visit_date"=>$request["cmv_vDate"],
          "Patient_Type"=>$request["cmv_ptype"],
          "Art_Status"=>Crypt::encrypt_light($request["cmv_artStatus"],$table),
          "Currnt_Art_Regime"=>Crypt::encrypt_light($request["cmv_artRegime"],$table),
          "Art_StartDate"=>$request["cmv_artStartDate"],
          "Most_CD4"=>Crypt::encrypt_light($request["cmv_CD4"],$table),
          "Recent_CD4Date"=>$request["cmv_CD4Date"],
          "Symptom"=>$request["cmv_Symptoms"],
          "Vision_Right"=>$request["Find_Righteye"],
          "Vision_Left"=>$request["Find_Lefteye"],
          "Finding_Right"=>$request["cmv_RFDeye"],
          "Finding_Rdx"=>$request["cmv_RFDTeye"],
          "Finding_Left"=>$request["cmv_LFDeye"],
          "Finding_Ldx"=>$request["cmv_LFDTeye"],
          "Treatment_Right"=>$request["cmv_TreReye"],
          "Treatment_Left"=>$request["cmv_TreLeye"],
          "Doctor_name"=>$request["eye_doctor"],
          "Remark"=>$request["cmv_remark"],
          "Follow_Date"=>$request["cmv_FollowDate"],
      ]);
      return response()->json([
        "Successfully",
       ]);
    }

    else if($notice=="cmv Export"){
      $disForm = $request->input("cmv_dateFrom");
      $timestamp = strtotime($disForm);
      $disForm  = date('Y-m-d', $timestamp);

      $disTo=$request->input("cmv_dateTo");
      $timestamp = strtotime($disTo);
      $disTo  = date('Y-m-d', $timestamp);
            
      $cmv_export = cmv::whereBetween("Visit_date", [$disForm, $disTo])
      ->with([
        'ptconfig' => function ($query) {
            $query->select("Pid",'Date of Birth','Agey','Agem','Gender','FuchiaID');
        }
      ])
      ->get()->makeHidden(['created_at', 'updated_at']);
      
      if(count($cmv_export)!=0){
        $date_type=[
          "Visit_date","Art_StartDate","Recent_CD4Date","Follow_Date"
        ];
        $encrypt_small=[
          "Art_Status","Currnt_Art_Regime","Most_CD4","Sex"
        ];
        //$column_names = Schema::getColumnListing('cmvs');
        foreach ($cmv_export as $index => $value) {
          if($value["ptconfig"]!=null){
            $cmv_export[$index]=Export_age::Export_general($value["ptconfig"],$value["Visit_date"],$value["ptconfig"]["Date of Birth"],$cmv_export[$index]);
            $cmv_export[$index]["FuchiaID"]=$value["ptconfig"]["FuchiaID"];
            $cmv_export[$index]["Gender"]=Crypt::decrypt_light($value["ptconfig"]["Gender"],$table);
          };
          
          
          

          foreach($date_type as $column){
            if($cmv_export[$index][$column]!=null){
              $carbonDate = Carbon::createFromFormat('Y-m-d', $cmv_export[$index][$column]);
              $carbonDate = Carbon::createFromFormat('d-m-Y', $carbonDate->format('d-m-Y'));
              $cmv_export[$index][$column]=Date::dateTimeToExcel($carbonDate->toDateTime());
            } 
          }

          foreach ($encrypt_small as $column) {
            $cmv_export[$index][$column]=Crypt::decrypt_light($cmv_export[$index][$column],$table);
            $cmv_export[$index][$column] = Crypt::codeBook($cmv_export[$index][$column], "encode");
          }
        }
        
        
        return Excel::download(new CMV_Export($cmv_export), 'CMV Export'.date("d-m-Y").'.xlsx');
        
      }else{
        abort(404);
      }
    }
    else if($notice=="cmv remove Record"){
      
      $delete=cmv::where("Pid_cmv",$request["remove_patient"])->where("id",$request["remove_id"])->delete();
      if($delete){
        DB::statement('SET @id := 0');
        DB::statement('UPDATE cmvs SET id = @id := @id + 1');
        DB::statement('ALTER TABLE cmvs AUTO_INCREMENT = 1');
      }
      return response()->json($delete);
      
    }
     // $pid=[
      //   '118122000565',
      //   '118123000606',
      //   '118123000607',
      //   '118123000608',
      //   '118123000609',
      //   '17123000556',
      //   '178123000251',
      //   '178123000253',
      //   '178123000259',
      //   '178123000260',
      //   '178123000261',
      //   '188123000130',
      //   '188123000140',
      //   '188123000142',
      //   '188123000150',
      //   '198122000068',
      //   '67123000805',
      //   '78123000533',
      //   '8123000225',
      //   '8123000227',
      //   '8123000228',
      //   '8123000229',
      //   '8123000230',
      //   '8123000231',
      //   '8123000232',
      //   '8123000234',
      //   '8123000235',
      //   '8123000236',
      //   '8123000237',
      //   '8123000238',
      //   '8123000240',
      //   '8123000241',
      //   '8123000243',
      //   '8123000244',
      //   '8123000245',
      //   '8123000577',
      //   '97123000645',
      //   '97123000665',
      //   '97123000697',

      // ];
      // $sex=[
      //   'Male',
      //   'Male',
      //   'Male',
      //   'Male',
      //   'Male',
      //   'Male',
      //   'Male',
      //   'Male',
      //   'Male',
      //   'Male',
      //   'Male',
      //   'Male',
      //   'Male',
      //   'Male',
      //   'Male',
      //   'Male',
      //   'Male',
      //   'Male',
      //   'Male',
      //   'Male',
      //   'Male',
      //   'Male',
      //   'Male',
      //   'Male',
      //   'Male',
      //   'Male',
      //   'Male',
      //   'Male',
      //   'Male',
      //   'Male',
      //   'Male',
      //   'Male',
      //   'Male',
      //   'Male',
      //   'Male',
      //   'Male',
      //   'Male',
      //   'Male',
      //   'Male',
          
      // ];
      // RiskChange::risk_Change();
    
  }
}

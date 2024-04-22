<?php
namespace App\Http\Controllers;
//namespace App\Exports;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\PtConfig;
use App\Models\Patients;
use App\Models\Followup_general;
use App\Models\Tbipt;
use App\Exports\TB_IPT\TBIPT_Export;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Illuminate\Support\Facades\Crypt;
use App\Exports\Export_age;

class TBIPTController extends Controller
{
  public function TBIPT_View(){
    return view('TB.TB_IPt');
  }

  public function TBIPT(Request $request){
    $table="General";
    $notice=$request["notice"];
    if($notice=="Find Patient ID"){
      $Tbipt_Olddata=[];$Tbipt_history=[];
      $Pidipt=$request["Pid"];
      $Fidipt=$request["Fid"];
        
      
      $Tbipt_general= PtConfig::select("Name", "Clinic Code","Pid","FuchiaID","Agey","Agem","Gender",)
      ->where('Pid', $Pidipt)
      ->orwhere(function ($query) use ($Fidipt,$Pidipt) {
        if ($Fidipt !== null && $Fidipt !== "-"&& $Pidipt==null) {
              $query->where('FuchiaID', $Fidipt);
          }
      })->latest()->first();


     
      
      if($Tbipt_general!=null){
        $Tbipt_general['Name']=Crypt::decryptString($Tbipt_general['Name']);
        $Tbipt_general['Gender']=Crypt::decrypt_light($Tbipt_general['Gender'],$table);
      }
        $Tbipt_history=Tbipt::where('Pid_iptTB', $Pidipt)
        ->orWhere(function ($query) use ($Fidipt,$Pidipt) {
          if ($Fidipt !== null && $Fidipt !== "-"&& $Pidipt==null) {
                $query->where('FuchiaID_iptTB', $Fidipt);
            }
        })->get();
        

        if($Tbipt_history){
          foreach ($Tbipt_history as $key => $ipt_his) {
            $ipt_his["IPT_startDate"] = Carbon::createFromFormat('Y-m-d',  $ipt_his["IPT_startDate"]);
            $ipt_his["IPT_startDate"] = $ipt_his["IPT_startDate"]->format('d-m-Y');
          }
          $Tbipt_Olddata =Tbipt::where('Pid_iptTB', $Pidipt)
          ->orWhere(function ($query) use ($Fidipt,$Pidipt) {
            if ($Fidipt !== null && $Fidipt !== "-"&& $Pidipt==null) {
                  $query->where('FuchiaID_iptTB', $Fidipt);
              }
          })
          ->where(function ($query) {
              $query->whereNull("Outcome")
                  ->orWhere("Outcome", "-");
          })
          ->whereNull("IPT_disconDate")
          ->latest("IPT_regDate")
          ->first();
        }

      
      return response()->json([ $Tbipt_general,$Tbipt_Olddata,$Tbipt_history]);
    }

    else if($notice=="IPT save record"){
      $sex=$request->input("ipt_sex");
      Tbipt::create([
        "Clinic_code"=>$request->input("clinic Code"),
        "Pid_iptTB"=>$request->input("ipt_pid"),
        "FuchiaID_iptTB"=>$request->input("ipt_fid"), 
        "Sex"=>Crypt::encrypt_light($sex,$table), 
        "Agey"=>$request->input("ipt_agey"),
        "Agem"=>$request->input("ipt_agem"),
        "Counsellor"=>$request->input("ipt_counselor"), 
        "IPT_regDate"=>$request->input("ipt_regiDate"), 
        "IPT_startDate"=>$request->input("ipt_startDate"), 
        "IPT_disconDate"=>$request->input("ipt_DisconDate"), 
        "Outcome"=>$request->input("ipt_outcome"), 
        "Remark"=>$request->input("ipt_remark"), 
      ]);
      return response()->json(["Success"]);
      
    }

    else if($notice=="IPT updated record"){
      $sex=$request->input("ipt_sex");
      $update_id=$request->input("update_id");

      Tbipt::where("id",$update_id)->update([
        "Clinic_code"=>$request->input("clinic Code"),
        "Pid_iptTB"=>$request->input("ipt_pid"),
        "FuchiaID_iptTB"=>$request->input("ipt_fid"), 
        "Sex"=>Crypt::encrypt_light($sex,$table), 
        "Agey"=>$request->input("ipt_agey"),
        "Agem"=>$request->input("ipt_agem"),
        "Counsellor"=>$request->input("ipt_counselor"), 
        "IPT_regDate"=>$request->input("ipt_regiDate"), 
        "IPT_startDate"=>$request->input("ipt_startDate"), 
        "IPT_disconDate"=>$request->input("ipt_DisconDate"), 
        "Outcome"=>$request->input("ipt_outcome"), 
        "Remark"=>$request->input("ipt_remark"), 
      ]);
      return response()->json(["Success"]);
      
    }

    else if($notice=="Remove IPT"){
      $delete=Tbipt::where("id",$request["id"])->where("Pid_iptTB",$request["Pid"])->delete();
      if($delete){
        DB::statement('SET @id := 0');
        DB::statement('UPDATE tbipts SET id = @id := @id + 1');
        DB::statement('ALTER TABLE tbipts AUTO_INCREMENT = 1');
      }
      return response()->json($delete);
    }

    else if($notice=="Export IPT"){
      $nocofig=[];
      $nocofig_count=0;
      $dateForm=date("Y-m-d",strtotime($request["dateFrom"]));
      $dateTo=date("Y-m-d",strtotime($request["dateTo"]));
      
      $ipt_export_dataes=Tbipt::whereBetween("IPT_regDate",[$dateForm,$dateTo])
      ->with([
        'ptconfig' => function ($query) {
            $query->select("Pid",'Date of Birth','Agey','Agem','Gender','FuchiaID');
        }
      ])->get()->makeHidden(['created_at', 'updated_at']);

      

      if(count($ipt_export_dataes)!=0){
        $ipt_export_dates=["IPT_regDate","IPT_startDate","IPT_disconDate"];
        foreach($ipt_export_dataes as $index=>$ipt_export_data){
          if($ipt_export_data['ptconfig']!=null){
            $ipt_export_data=Export_age::Export_general($ipt_export_data["ptconfig"],$ipt_export_data["IPT_regDate"],$ipt_export_data["ptconfig"]["Date of Birth"],$ipt_export_data);
            $ipt_export_dataes[$index]["Gender"]=Crypt::decrypt_light($ipt_export_data['ptconfig']["Gender"],$table);
            $ipt_export_dataes[$index]["FuchiaID"]=$ipt_export_data['FuchiaID'];
          }
          foreach($ipt_export_dates as $column ){
            if($ipt_export_data[$column]!=null){
              $carbonDate = Carbon::createFromFormat('Y-m-d', $ipt_export_data[$column]);
              $carbonDate = Carbon::createFromFormat('d-m-Y', $carbonDate->format('d-m-Y'));
              $ipt_export_dataes[$index][$column]=Date::dateTimeToExcel($carbonDate->toDateTime());
            }
          }
          
        }
       
          return Excel::download(new TBIPT_Export($ipt_export_dataes), 'TBIPT_Export'.date("d-m-Y").'.xlsx');
        
        
      }else{
        abort(404);
      }
     
    }
    
  }
}
<?php

namespace App\Http\Controllers;
//use App\Exports\RiskLog\RiskHistroy;
use App\Exports\RiskLog\RiskHistory;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Models\PtConfig;
use App\Models\Patients;
use App\Models\Followup_general;
use Validator;
use Carbon\Carbon;

use Illuminate\Support\Facades\Crypt;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Shared\Date;



class RiskLogController extends Controller
{
  //new Ncd view
  public function risk_log_View(){
    return view ('RiskHistory.risk_history', [
      'final_log' =>null,
  ]);
  }
  public function risk_log(Request $request){
   $final_log=[];
   $table="General";
   $define_name=["RiskChangeDate","Old Risk","Current Risk","Due_to_patient","change_user"];
   if($request["searchType"]=="Date"){
    $validator = Validator::make($request->all(), [
        'riskLog_From' => 'required|date', // Ensures 'riskLog_From' is a valid date
        'riskLog_To' => 'required|date',
    ]);
    if ($validator->fails()) {
        return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
    }
    $request["riskLog_From"]=Carbon::parse($request["riskLog_From"])->format('Y-m-d');
    $request["riskLog_To"]=Carbon::parse($request["riskLog_To"])->format('Y-m-d');
   
    $export_viewData = Followup_general::on('mysql') // Specify the connection for Followup_general table
    ->whereBetween('Visit Date', [$request["riskLog_From"],$request["riskLog_To"]])
    ->join('confid.pt_configs', 'followup_generals.Pid', '=', 'pt_configs.Pid') // specify the connection for pt_configs table
    ->whereNotNull('pt_configs.Risk Log') // additional condition
    ->select('pt_configs.Risk Log', 'pt_configs.Pid')
    ->get();
   }else if($request["searchType"]=="ID"){
    $validator = Validator::make($request->all(), [
        'riskLog_searchID' => 'required|integer', // Ensures 'riskLog_From' is a valid date
    ]);
    if ($validator->fails()) {
        return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
    }
    $export_viewData=PtConfig::select("Risk Log","Pid")->where("Pid",$request["riskLog_searchID"])->where("Risk Log","!=",null)->get();
   }
   //dd($export_viewData);
   foreach ($export_viewData as $key => $value) {
    
    $log_counts=explode("/",$value["Risk Log"]);
    foreach ($log_counts as $log_count) {
      $risklog_detail=explode(":",$log_count);
      foreach ($risklog_detail as $index => $log) {
       if ($index==0) {
          $change_date=Carbon::parse($log)->format('d-m-Y');
       }
       else if($index==1||$index==2){
        $final_log[$value["Pid"]][$change_date][$define_name[$index]]=Crypt::decrypt_light($log,$table);
       }else{
        $final_log[$value["Pid"]][$change_date][$define_name[$index]]=$log;
       }
      }
      
    }
   }
   if($request["export_view"]=="Export"){
    return Excel::download(new RiskHistory($final_log), 'Risk_Log(Export)-'.date("d-m-Y").'.xlsx');
   }else{
    $request["riskLog_From"]=Carbon::parse($request["riskLog_From"])->format('d-m-Y');
    $request["riskLog_To"]=Carbon::parse($request["riskLog_To"])->format('d-m-Y');
    return redirect()->back()->withInput()->with('final_log', $final_log);
   }
   
  }





}

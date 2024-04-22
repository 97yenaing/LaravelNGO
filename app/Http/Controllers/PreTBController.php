<?php
namespace App\Http\Controllers;
//namespace App\Exports;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\PtConfig;
use App\Models\Patients;
use App\Models\Followup_general;
use App\Models\preTB;
use App\Exports\PreTB\PreTB_Export;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Crypt;
use App\Exports\Export_age;

class PreTBController extends Controller
{
  public function preTB_Assement_View(){
    return view('TB.preTB_Assement');
  }
  public function preTB_Assement(Request $request){
    $notice=$request->input("notice");$table="General";

    if($notice=="Find PreTB patient"){
      $preTBcont="";
      $Pid=$request->input("pre_Pid");
      $Fid=$request->input("pre_Fid");
      $preTB_general[0] = PtConfig::select("Agey","Agem", "Gender", "Pid", "FuchiaID","Clinic Code","Name")
      ->where('Pid', $Pid)
      ->orwhere(function ($query) use ($Fid) {
          if ($Fid !== null && $Fid !== "-") {
              $query->where('FuchiaID', $Fid);
          }
      })
      ->latest()
      ->first();
      if($preTB_general[0]!==null ){
          $preTB_general[0]['Name']=Crypt::decryptString($preTB_general[0]['Name']);
          $preTB_general[0]['Gender']=Crypt::decrypt_light($preTB_general[0]['Gender'],$table);
      }

         $preTBcont = preTB::where('Pid_preTB', $Pid)
         ->orWhere(function ($query) use ($Fid) {
             if ($Fid !== null && $Fid !== "-") {
                 $query->where('FuchiaID_preTB', $Fid);
             }
         })->get();
         foreach ($preTBcont as $key => $value) {
          $preTBcont[$key]["HTCRes_preTB"]=Crypt::decrypt_light($value["HTCRes_preTB"],$table);
          $value["VisitDate_preTB"] = Carbon::createFromFormat('Y-m-d',  $value["VisitDate_preTB"]);
          $value["VisitDate_preTB"] = $value["VisitDate_preTB"]->format('d-m-Y');
         }
      
        

      return response()->json([$preTB_general,$preTBcont]); 
    }
    else if($notice=="PreTB save"){
      preTB::create([
        'Clinic_code'=>$request->input("Clinic Code"),
        'Pid_preTB'=>$request->input("preTb_Pid"),
        'FuchiaID_preTB'=>$request->input("preTb_fuchiaID"), 
        'Agey_preTB'=>$request->input("preTb_agey"),
        'Agem_preTB'=>$request->input("preTb_agem"),
        'Gender_preTB'=>$request->input("preTB_gender"),
        'VisitDate_preTB'=>$request->input("preTb_vDate"),
        'KAP_preTB'=>$request->input("kap_check"),
        'ModEntry_preTB'=>$request->input("preTb_mod_entry"),
        'NextVDate_preTB'=>$request->input("preTb_nextVDate"),
        'TBscreenDate_preTB'=>$request->input("preTb_nextScreenDate"),
        'HTCRes_preTB'=>Crypt::encrypt_light($request->input("preTb_HtcRes"),"General"),
        //'HTCRes_preTB'=>$request->input("preTb_HtcRes"),
        'HTCDate_preTB'=>$request->input("preTb_HtcDate"),
        'AFBRes_preTB'=>$request->input("preTb_AfbRes"),
        'AFBDate_preTB'=>$request->input("preTb_AfbDate"),
        'GeneXpertRes_preTB'=>$request->input("preTb_geneXRes"),
        'GeneXpertDate_preTB'=>$request->input("preTb_geneXDate"),
        'CXRRes_preTB'=>$request->input("preTb_CXRRes"),
        'CXRDate_preTB'=>$request->input("preTb_CXRDate"),
        'FeverDay_preTB'=>$request->input("preTB_feverDay"),
        'CoughDay_preTB'=>$request->input("preTB_coughDay"),
        'LowDay_preTB'=>$request->input("preTB_lowDay"),
        'LoaDay_preTB'=>$request->input("preTB_loaDay"),
        'AntiTB_History_preTB'=>$request->input("antipreTb_check"),
        'NsweatDay_preTB'=>$request->input("preTB_nigthSweDay"),
        'LympDay_preTB'=>$request->input("preTB_lympDay"),
        'LympDes_preTB'=>$request->input("preTB_lympdescribe"),
        'lymph_check'=>$request->input("lympreTb_check"),
        'ReasonCXR_preTB'=>$request->input("preTb_cxrRequest"),
        'Recheck_preTB'=>$request->input("preTB_recheckAfter"),
        'Month_TBantiTre_preTB'=>$request->input("preTB_monthAntiTre"),
        'MDprovisional_diagnosisPlan_preTB'=>$request->input("preTB_MDaction"),
        'Antibiotic_preTB'=>$request->input("preTb_antibiotic"),
        'Sus_ActiveTB_preTB'=>$request->input("susAct_onpreTb"),
        'FurtherCounsulting_preTB'=>$request->input("preTb_consultneed"),
        'CounsulingNO_preTB'=>$request->input("preTB_FurCoulting_ifnoWhy"),
        'Other_preTB'=>$request->input("preTB_cxrother"),
        'Radiologist_preTB'=>$request->input("partB_radiologist"),
        'MDmanagementPlan_preTB'=>$request->input("partB_MDmanPlan"),
        'TechAdvice_preTB'=>$request->input("partB_needTeachAdv"),
        'TechAdvice_yes_preTB'=>$request->input("preTB_teachAdvice"),
        'MDname_preTB'=>$request->input("preTB_MD"),
        'CaseNodeIn'=>$request->input("preTB_CaseIn"),
        'CaseNode'=>$request->input("preTB_caseChoice"),
      ]);
      return response()->json(["Successfully"]); 
    }

    else if($notice=="preTB update"){
      $preTB_rowId=$request->input("id");
      preTB::where("id",$preTB_rowId)->update([
        'Clinic_code'=>$request->input("Clinic Code"),
        'Pid_preTB'=>$request->input("preTb_Pid"),
        'FuchiaID_preTB'=>$request->input("preTb_fuchiaID"), 
        'Agey_preTB'=>$request->input("preTb_agey"),
        'Agem_preTB'=>$request->input("preTb_agem"),
        'Gender_preTB'=>$request->input("preTB_gender"),
        'VisitDate_preTB'=>$request->input("preTb_vDate"),
        'KAP_preTB'=>$request->input("kap_check"),
        'ModEntry_preTB'=>$request->input("preTb_mod_entry"),
        'NextVDate_preTB'=>$request->input("preTb_nextVDate"),
        'TBscreenDate_preTB'=>$request->input("preTb_nextScreenDate"),
        'HTCRes_preTB'=>Crypt::encrypt_light($request->input("preTb_HtcRes"),"General"),
        //'HTCRes_preTB'=>$request->input("preTb_HtcRes"),
        'HTCDate_preTB'=>$request->input("preTb_HtcDate"),
        'AFBRes_preTB'=>$request->input("preTb_AfbRes"),
        'AFBDate_preTB'=>$request->input("preTb_AfbDate"),
        'GeneXpertRes_preTB'=>$request->input("preTb_geneXRes"),
        'GeneXpertDate_preTB'=>$request->input("preTb_geneXDate"),
        'CXRRes_preTB'=>$request->input("preTb_CXRRes"),
        'CXRDate_preTB'=>$request->input("preTb_CXRDate"),
        'FeverDay_preTB'=>$request->input("preTB_feverDay"),
        'CoughDay_preTB'=>$request->input("preTB_coughDay"),
        'LowDay_preTB'=>$request->input("preTB_lowDay"),
        'LoaDay_preTB'=>$request->input("preTB_loaDay"),
        'AntiTB_History_preTB'=>$request->input("antipreTb_check"),
        'NsweatDay_preTB'=>$request->input("preTB_nigthSweDay"),
        'LympDay_preTB'=>$request->input("preTB_lympDay"),
        'LympDes_preTB'=>$request->input("preTB_lympdescribe"),
        'lymph_check'=>$request->input("lympreTb_check"),
        'ReasonCXR_preTB'=>$request->input("preTb_cxrRequest"),
        'Recheck_preTB'=>$request->input("preTB_recheckAfter"),
        'Month_TBantiTre_preTB'=>$request->input("preTB_monthAntiTre"),
        'MDprovisional_diagnosisPlan_preTB'=>$request->input("preTB_MDaction"),
        'Antibiotic_preTB'=>$request->input("preTb_antibiotic"),
        'Sus_ActiveTB_preTB'=>$request->input("susAct_onpreTb"),
        'FurtherCounsulting_preTB'=>$request->input("preTb_consultneed"),
        'CounsulingNO_preTB'=>$request->input("preTB_FurCoulting_ifnoWhy"),
        'Other_preTB'=>$request->input("preTB_cxrother"),
        'Radiologist_preTB'=>$request->input("partB_radiologist"),
        'MDmanagementPlan_preTB'=>$request->input("partB_MDmanPlan"),
        'TechAdvice_preTB'=>$request->input("partB_needTeachAdv"),
        'TechAdvice_yes_preTB'=>$request->input("preTB_teachAdvice"),
        'MDname_preTB'=>$request->input("preTB_MD"),
        'CaseNodeIn'=>$request->input("preTB_CaseIn"),
        'CaseNode'=>$request->input("preTB_caseChoice"),
      ]);
      return response()->json(["Successfully",$preTB_rowId]);  
    }

    else if($notice=="Export PreTB"){
      $dateForm=date("Y-m-d",strtotime($request["dateFrom"]));
      $dateTo=date("Y-m-d",strtotime($request["dateTo"]));
      $pretb_export_dataes =preTB::whereBetween("TBscreenDate_preTB",[$dateForm,$dateTo])
      ->with([
        'ptconfig' => function ($query) {
          $query->select("Pid",'Date of Birth','Agey','Agem','Gender','FuchiaID');
        }
      ])
      ->get()->makeHidden(['created_at', 'updated_at']);
      
        $pretb_export_dates=["VisitDate_preTB","NextVDate_preTB","TBscreenDate_preTB","HTCDate_preTB","AFBDate_preTB","GeneXpertDate_preTB",
        "CXRDate_preTB"];
        foreach($pretb_export_dataes as $index=>$pretb_export_data){
          if($pretb_export_data["ptconfig"]!=null){
            $pretb_export_data=Export_age::Export_general($pretb_export_data["ptconfig"],$pretb_export_data["TBscreenDate_preTB"],$pretb_export_data["ptconfig"]["Date of Birth"],$pretb_export_data);
            $pretb_export_dataes[$index]["Gender"]=Crypt::decrypt_light($pretb_export_data["ptconfig"]["Gender"],$table);
            $pretb_export_dataes[$index]["FuchiaID"]=$pretb_export_data["ptconfig"]["FuchiaID"];
          };
          $pretb_export_dataes[$index]["HTCRes_preTB"]=Crypt::decrypt_light($pretb_export_data["HTCRes_preTB"],$table);
          foreach($pretb_export_dates as $column ){
            if($pretb_export_data[$column]!=null){
              $carbonDate = Carbon::createFromFormat('Y-m-d', $pretb_export_data[$column]);
              $carbonDate = Carbon::createFromFormat('d-m-Y', $carbonDate->format('d-m-Y'));
              $pretb_export_dataes[$index][$column]=Date::dateTimeToExcel($carbonDate->toDateTime());
            }
          }
        }
      
        return Excel::download(new PreTB_Export($pretb_export_dataes), 'PreTB_Export'.date("d-m-Y").'.xlsx');
      // }else{
      //   abort(404);
      // }
    }

    elseif ($notice=="Remove preTB") {
      $delete=preTB::where("id",$request["id"])->where("Pid_preTB",$request["Pid"])->delete();
      if($delete){
        DB::statement('SET @id := 0');
        DB::statement('UPDATE pre_t_b_s SET id = @id := @id + 1');
        DB::statement('ALTER TABLE pre_t_b_s AUTO_INCREMENT = 1');
      }
      return response()->json($delete);

    }
  }
}

<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\ncd_pt_register;
use App\Models\ncdFollowup;
use App\Models\PtConfig;
use App\Models\Patients;
use App\Models\Followup_general;
use App\Exports\NCD\NCD_Register_Export;
use App\Exports\NCD\NCD_Follow_Export;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Crypt;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use App\Exports\Export_age;

class ncdRegisterPtController extends Controller
{
  //new Ncd view
  public function ncd_View(){
    return view ('NCD.Ncd');
  }
  public function ncdRegister_View(){
        $dataSuccess=[[ 	"id" => 1, "name" => "Ready" ]];
        $ck=[[ 	"id" => 1, "name" => "ck" ]];
        return view ('NCD.ncdRegisterForm',[
                'success'  => $dataSuccess,
                'check'=> $ck
                ]);
         //return view('file-import');
  }
  public function ncdRegister_data(Request $request){
    $table="General";
    $notice=$request->input('notice');

    if($notice=="Find Patient"){
      $data_decrypLight=['Height','Weight'];
      $data_decryptStr=['Region','Township','Name','Father'];
      $Pid=$request->input('Pid');
      $Fid=$request->input('Fid');
      $exist_Data=[];
      $ncd_followCount=[];


      
      $patientinfo=PtConfig::select('Pid','FuchiaID','Agey','Agem','Gender','Date of Birth', 'Region', 'Township', 'Clinic Code','Name','Father','Reg Date')
      ->where('Pid', $Pid)
      ->orwhere(function ($query) use ($Fid) {
         if ($Fid!=null && $Fid != "-") {
            $query->Where('FuchiaID', $Fid);
        }
      })->first();
      
      $followInfo= Followup_general::select('Pid','Height','Weight')  ->where('Pid', $Pid)
      ->orwhere(function ($query) use ($Fid) {
         if ($Fid!=null && $Fid != "-") {
            $query->Where('FuchiaID', $Fid);
        }
      })->latest()
        ->first();
    
      if($patientinfo !=null){
        if($followInfo !=null){
          for ($i=0; $i < count($data_decrypLight) ; $i++) { 
            $patientinfo[$data_decrypLight[$i]]=Crypt::decrypt_light($followInfo[$data_decrypLight[$i]],$table);
          }
        }
        for ($i=0; $i <count($data_decryptStr); $i++) { 
          $patientinfo[$data_decryptStr[$i]]=Crypt::decryptString($patientinfo[$data_decryptStr[$i]]);
        }
        $patientinfo["Gender"]=Crypt::decrypt_light($patientinfo["Gender"],$table);
        $patientinfo["FuchiaID"]=$patientinfo["FuchiaID"];
        $patientinfo["Clinic Code"]=$patientinfo["Clinic Code"];
      }

      $ncdRegister=ncd_pt_register::where(function ($query) use ($Pid, $Fid) {
          if($Pid!="" && $Pid != "-"){
            $query->where('Pid', $Pid);
          }else if ($Fid!="" && $Fid != "-") {
            $query->orWhere('FuchiaID', $Fid);
          }
      })->exists();
      if($ncdRegister){
          $ncd_Data=ncd_pt_register::where(function ($query) use ($Pid, $Fid) {
            if($Pid!="" && $Pid != "-"){
              $query->where('Pid', $Pid);
            }else if ($Fid!="" && $Fid != "-") {
              $query->orWhere('FuchiaID', $Fid);
            }
          })->get();
          
          $ncd_Tofill=[
            'id','rowid',
            'visit_Age','age_visit',
            'Height',"ncd_Rheight",
            'Weight',"ncd_Rweight",
            'Register_Bmi',"ncd_RegisterBmi",
            "Reg_Date","ncd_regstrDate",
            "1stBP","fisrtBp",
            "1stBP_date","1stBp_Date",
            "1stHypertension","ncd1st_hyper",
            "1st_DiagDate","1stDiag_Date",
            "1st_RBS","1st_rbs",
            "1st_RBS_date","1stRBs_Date",
            "2ndBP","secondBp",
            "2ndBP_date","2ndBp_Date",
            "2nd_Hypertension","ncd2nd_hyper",
            "2nd_DiagDate","2ndDiag_Date",
            "2nd_RBS","2nd_rbs",
            "2nd_RBS_date","2ndRBs_Date",
            "3rdBP","thirdBp",
            "3rdBP_date","3rdBp_Date",
            "staging_Hypertension","ncdHyper_stag",
            "Clinical_Symptoms","ncdClinic_sym",
            "Clinical_Symptoms_Describe","clinical_sym",
            "Smoking_Status","ncdSmoke_status",
            "Amlodipine_dose","ncdAmlo_dose",
            "Amlodipine_Freq","ncdAmlo_frequency",
            "Amlodipine_duration","ncdAmlo_duration",
            "Amlodipine_durUnit","ncdAmlo_durUnit",
            "Enalapril_dose","ncdEmala_dose",
            "Enalapril_Freq","ncdEmala_frequency",
            "Enalapril_duration","ncdEmala_duration",
            "Enalapril_durUnit","ncdEmala_durUnit",
            "Atorvastain_dose","ncdator_dose",
            "Atorvastain_Freq","ncdator_frequency",
            "Atorvastain_duration","ncdator_duration",
            "Atorvastain_durUnit","ncdActor_durUnit",
            "Hydrochlorothiazide_dose","ncdhydro_dose",
            "Hydrochlorothiazide_Freq","ncdhydro_frequency",
            "Hydrochlorothiazide_duration","ncdhydro_duration",
            "Hydrochlorothiazide_durUnit","ncdhydro_durUnit",
            "Aspirin_dose","ncdAspi_dose",
            "Aspirin_Freq","ncdAspi_frequency",
            "Aspirin_duration","ncdAspi_duration",
            "Aspirin_durUnit","ncdAspi_durUnit",
            "Metformin_dose","ncdMetf_dose",
            "Metformin_Freq","ncdMetf_frequency",
            "Metformin_duration","ncdMetf_duration",
            "Metformin_durUnit","ncdMetf_durUnit",
            "Gliclazide_dose","ncdGli_dose",
            "Gliclazide_Freq","ncdGli_frequency",
            "Gliclazide_duraion","ncdGli_duration",
            "Gliclazide_durUnit","ncdGli_durUnit",
            "Other_NCD_medication","ncdother_medic",
            "Oth_ncd_med_specify","specifyNcd",
            "cur_med1","oth_medicname1",
            "cur_med1_dose","oth_does1",
            "cur_med1_freq","oth_freqency1",
            "cur_med1_duration","oth_duration1",
            "cur_med1_durUnit","th_durUnit1",
            "cur_med2","oth_medicname2",
            "cur_med2_dose","oth_does2",
            "cur_med2_freq","oth_freqency2",
            "cur_med2_duration","oth_duration2",
            "cur_med2_durUnit","th_durUnit2",
            "cur_med3","oth_medicname3",
            "cur_med3_dose","oth_does3",
            "cur_med3_freq","oth_freqency3",
            "cur_med3_duration","oth_duration3",
            "cur_med3_durUnit","th_durUnit3",
            "cur_med4","oth_medicname4",
            "cur_med4_dose","oth_does4",
            "cur_med4_freq","oth_freqency4",
            "cur_med4_duration","oth_duration4",
            "cur_med4_durUnit","th_durUnit4",
            "cur_med5","oth_medicname5",
            "cur_med5_dose","oth_does5",
            "cur_med5_freq","oth_freqency5",
            "cur_med5_duration","oth_duration5",
            "cur_med5_durUnit","th_durUnit5",
            "cur_med6","oth_medicname6",
            "cur_med6_dose","oth_does6",
            "cur_med6_freq","oth_freqency6",
            "cur_med6_duration","oth_duration6",
            "cur_med6_durUnit","th_durUnit6",
            "Dia_foot","ncdPat_diabetic",
            "Hyperlipidemia","ncdPat_hyperli",
            "Gestational_Diabetes","ncdPat_gestation",
            "Gestational_HT","ncdPat_gestHT",
            "Neuropathy","ncdPat_neuro",
            "CKD","ncdPat_ckd",
            "CVD","ncdPat_cvd",
            "Atril_Fib","ncdPat_atrial",
            "Change_in_Vision","ncdPat_changeVs",
            "Chronic_Lung_Disease","ncdPat_chronicLung",
            "Recur_infection","ncdPat_recurIf",
            "Recur_infection_comment","ncdPat_commentIf",
            "Family_Hyper","ncdfam_hyperten",
            "Family_Diabetes","ncdfam_diabetes",
    
          ];
          for ($i=0; $i <count($ncd_Tofill) ; $i++) { 
            $exist_Data[$ncd_Tofill[$i+1]]=$ncd_Data[0][$ncd_Tofill[$i]];
            $i++;
          }
          if($patientinfo !=null){
            $patientinfo=Export_age::Export_general($patientinfo,$exist_Data["ncd_regstrDate"],$patientinfo["Date of Birth"],$patientinfo);
          }
          
          $ncd_followCount=ncdFollowup::select("id","Visit_date","Pid")->where('Pid', $Pid)->orwhere(function ($query) use ($Fid) {
            if ($Fid!="" && $Fid != "-") {
                $query->orWhere('FuchiaID', $Fid);
            }
          })->get();
          foreach ($ncd_followCount as $ncd) {
            $ncd["Visit_date"]= strtotime($ncd["Visit_date"]);
            $ncd["Visit_date"] = date('d-m-Y',  $ncd["Visit_date"]);
          }

      }
      return response()->json([$patientinfo,$exist_Data,$ncd_followCount,$followInfo]); 
      

      
    }

    if($notice=="NCD_Register"){
      $fisrtBp=$request->input('1st_bptop')."/".$request->input('1st_bpbot');
      $secondBp=$request->input('2nd_bptop')."/".$request->input('2nd_bpbot');
      $thirdBp=$request->input('3rd_bptop')."/".$request->input('3rd_bpbot');
      $save_Update=$request->input('ncd_saveUpdate');
      $Pid=$request->input('Pid');
      $Fid=$request->input('Fid');
     
      if($save_Update=="Ncd Register Updated"){
        $id=$request->input('rowid');
        $upIdCode=ncd_pt_register::select("Pid","FuchiaID")->where("id",$id)->first();
        $UFid=$upIdCode["FuchiaID"];
        $UPid=$upIdCode["Pid"];
        $ncd_exist=ncd_pt_register::where(function ($query) use ($UPid, $UFid) {
          if($UPid!="" && $UPid != "-"){
            $query->where('Pid', $UPid);
          }else if ($UFid!="" && $UFid != "-") {
            $query->orWhere('FuchiaID', $UFid);
        }
        })->exists();
        if($ncd_exist){
          ncdFollowup::where(function ($query) use ($UPid, $UFid) {
            if($UPid!="" && $UPid != "-"){
              $query->where('Pid', $UPid);
            }else if ($UFid!="" && $UFid != "-") {
              $query->orWhere('FuchiaID', $UFid);
          }
          })->update([
          "Pid"=>$request->input('ncd_pid'),
          "FuchiaID"=>$request->input('ncd_fid')
          ]);
  
  
          ncd_pt_register::where("id","=",$id)->update([
            "Clinic_code"=>$request->input('Clinic_Code'),
              "Pid"=>$request->input('ncd_pid'),
              "FuchiaID"=>$request->input('ncd_fid'),
              "visit_Age"=>$request->input('age_visit'),
              "Current_Age"=>$request->input('age_current'),   
              "Gender"=>$request->input('ncd_sex'),
              "Reg_Date"=>$request->input('ncd_regstrDate'),
              "Area_Division"=>$request->input('ncd_residence'),
              "Township"=>$request->input('ncd_town'),
              "Height"=>$request->input('ncd_Rheight'),
              "Weight"=>$request->input('ncd_Rweight'),
              "Register_Bmi"=>$request->input('ncd_RegisterBmi'),
              "1stBP"=>$fisrtBp,
              "1stBP_date"=>$request->input('1stBp_Date'),
              "1stHypertension"=>$request->input('ncd1st_hyper'),
              "1st_DiagDate"=>$request->input('1stDiag_Date'),
              "1st_RBS"=>$request->input('1st_rbs'),
              "1st_RBS_date"=>$request->input('1stRBs_Date'),
              "2ndBP"=>$secondBp,
              "2ndBP_date"=>$request->input('2ndBp_Date'),
              "2nd_Hypertension"=>$request->input('ncd2nd_hyper'),
              "2nd_DiagDate"=>$request->input('2ndDiag_Date'),
              "2nd_RBS"=>$request->input('2nd_rbs'),
              "2nd_RBS_date"=>$request->input('2ndRBs_Date'),
              "3rdBP"=>$thirdBp,
              "3rdBP_date"=>$request->input('3rdBp_Date'),
              "staging_Hypertension"=>$request->input('ncdHyper_stag'),
              "Clinical_Symptoms"=>$request->input('ncdClinic_sym'),
              "Clinical_Symptoms_Describe"=>$request->input('clinical_sym'),
              "Smoking_Status"=>$request->input('ncdSmoke_status'),
              "Amlodipine_dose"=>$request->input('ncdAmlo_dose'),
              "Amlodipine_Freq"=>$request->input('ncdAmlo_frequency'),
              "Amlodipine_duration"=>$request->input('ncdAmlo_duration'),
              "Amlodipine_durUnit"=>$request->input('ncdAmlo_durUnit'),
              "Enalapril_dose"=>$request->input('ncdEmala_dose'),
              "Enalapril_Freq"=>$request->input('ncdEmala_frequency'),
              "Enalapril_duration"=>$request->input('ncdEmala_duration'),
              "Enalapril_durUnit"=>$request->input('ncdEmala_durUnit'),
              "Atorvastain_dose"=>$request->input('ncdator_dose'),
              "Atorvastain_Freq"=>$request->input('ncdator_frequency'),
              "Atorvastain_duration"=>$request->input('ncdator_duration'),
              "Atorvastain_durUnit"=>$request->input('ncdActor_durUnit'),
              "Hydrochlorothiazide_dose"=>$request->input('ncdhydro_dose'),
              "Hydrochlorothiazide_Freq"=>$request->input('ncdhydro_frequency'),
              "Hydrochlorothiazide_duration"=>$request->input('ncdhydro_duration'),
              "Hydrochlorothiazide_durUnit"=>$request->input('ncdhydro_durUnit'),
              "Aspirin_dose"=>$request->input('ncdAspi_dose'),
              "Aspirin_Freq"=>$request->input('ncdAspi_frequency'),
              "Aspirin_duration"=>$request->input('ncdAspi_duration'),
              "Aspirin_durUnit"=>$request->input('ncdAspi_durUnit'),
              "Metformin_dose"=>$request->input('ncdMetf_dose'),
              "Metformin_Freq"=>$request->input('ncdMetf_frequency'),
              "Metformin_duration"=>$request->input('ncdMetf_duration'),
              "Metformin_durUnit"=>$request->input('ncdMetf_durUnit'),
              "Gliclazide_dose"=>$request->input('ncdGli_dose'),
              "Gliclazide_Freq"=>$request->input('ncdGli_frequency'),
              "Gliclazide_duraion"=>$request->input('ncdGli_duration'),
              "Gliclazide_durUnit"=>$request->input('ncdGli_durUnit'),
              "Other_NCD_medication"=>$request->input('ncdother_medic'),
              "Oth_ncd_med_specify"=>$request->input('specifyNcd'),
              "cur_med1"=>$request->input('oth_medicname1'),
              "cur_med1_dose"=>$request->input('oth_does1'),
              "cur_med1_freq"=>$request->input('oth_freqency1'),
              "cur_med1_duration"=>$request->input('oth_duration1'),
              "cur_med1_durUnit"=>$request->input('th_durUnit1'),
              "cur_med2"=>$request->input('oth_medicname2'),
              "cur_med2_dose"=>$request->input('oth_does2'),
              "cur_med2_freq"=>$request->input('oth_freqency2'),
              "cur_med2_duration"=>$request->input('oth_duration2'),
              "cur_med2_durUnit"=>$request->input('th_durUnit2'),
              "cur_med3"=>$request->input('oth_medicname3'),
              "cur_med3_dose"=>$request->input('oth_does3'),
              "cur_med3_freq"=>$request->input('oth_freqency3'),
              "cur_med3_duration"=>$request->input('oth_duration3'),
              "cur_med3_durUnit"=>$request->input('th_durUnit3'),
              "cur_med4"=>$request->input('oth_medicname4'),
              "cur_med4_dose"=>$request->input('oth_does4'),
              "cur_med4_freq"=>$request->input('oth_freqency4'),
              "cur_med4_duration"=>$request->input('oth_duration4'),
              "cur_med4_durUnit"=>$request->input('th_durUnit4'),
              "cur_med5"=>$request->input('oth_medicname5'),
              "cur_med5_dose"=>$request->input('oth_does5'),
              "cur_med5_freq"=>$request->input('oth_freqency5'),
              "cur_med5_duration"=>$request->input('oth_duration5'),
              "cur_med5_durUnit"=>$request->input('th_durUnit5'),
              "cur_med6"=>$request->input('oth_medicname6'),
              "cur_med6_dose"=>$request->input('oth_does6'),
              "cur_med6_freq"=>$request->input('oth_freqency6'),
              "cur_med6_duration"=>$request->input('oth_duration6'),
              "cur_med6_durUnit"=>$request->input('th_durUnit6'),
              "Dia_foot"=>$request->input('ncdPat_diabetic'),
              "Hyperlipidemia"=>$request->input('ncdPat_hyperli'),
              "Gestational_Diabetes"=>$request->input('ncdPat_gestation'),
              "Gestational_HT"=>$request->input('ncdPat_gestHT'),
              "Neuropathy"=>$request->input('ncdPat_neuro'),
              "CKD"=>$request->input('ncdPat_ckd'),
              "CVD"=>$request->input('ncdPat_cvd'),
              "Atril_Fib"=>$request->input('ncdPat_atrial'),
              "Change_in_Vision"=>$request->input('ncdPat_changeVs'),
              "Chronic_Lung_Disease"=>$request->input('ncdPat_chronicLung'),
              "Recur_infection"=>$request->input('ncdPat_recurIf'),
              "Recur_infection_comment"=>$request->input('ncdPat_commentIf'),
              "Family_Hyper"=>$request->input('ncdfam_hyperten'),
              "Family_Diabetes"=>$request->input('ncdfam_diabetes'),
          ]);  
    
        }else{
          return response()->json(["Your ID do not Register"]);
        }
        
      }else{
          ncd_pt_register::create([
            "Clinic_code"=>$request->input('Clinic_Code'),
            "Pid"=>$request->input('ncd_pid'),
            "FuchiaID"=>$request->input('ncd_fid'),
            "visit_Age"=>$request->input('age_visit'),
            "Current_Age"=>$request->input('age_current'),   
            "Gender"=>$request->input('ncd_sex'),
            "Reg_Date"=>$request->input('ncd_regstrDate'),
            "Area_Division"=>$request->input('ncd_residence'),
            "Township"=>$request->input('ncd_town'),
            "Height"=>$request->input('ncd_Rheight'),
            "Weight"=>$request->input('ncd_Rweight'),
            "Register_Bmi"=>$request->input('ncd_RegisterBmi'),
            "1stBP"=>$fisrtBp,
            "1stBP_date"=>$request->input('1stBp_Date'),
            "1stHypertension"=>$request->input('ncd1st_hyper'),
            "1st_DiagDate"=>$request->input('1stDiag_Date'),
            "1st_RBS"=>$request->input('1st_rbs'),
            "1st_RBS_date"=>$request->input('1stRBs_Date'),
            "2ndBP"=>$secondBp,
            "2ndBP_date"=>$request->input('2ndBp_Date'),
            "2nd_Hypertension"=>$request->input('ncd2nd_hyper'),
            "2nd_DiagDate"=>$request->input('2ndDiag_Date'),
            "2nd_RBS"=>$request->input('2nd_rbs'),
            "2nd_RBS_date"=>$request->input('2ndRBs_Date'),
            "3rdBP"=>$thirdBp,
            "3rdBP_date"=>$request->input('3rdBp_Date'),
            "staging_Hypertension"=>$request->input('ncdHyper_stag'),
            "Clinical_Symptoms"=>$request->input('ncdClinic_sym'),
            "Clinical_Symptoms_Describe"=>$request->input('clinical_sym'),
            "Smoking_Status"=>$request->input('ncdSmoke_status'),
            "Amlodipine_dose"=>$request->input('ncdAmlo_dose'),
            "Amlodipine_Freq"=>$request->input('ncdAmlo_frequency'),
            "Amlodipine_duration"=>$request->input('ncdAmlo_duration'),
            "Amlodipine_durUnit"=>$request->input('ncdAmlo_durUnit'),
            "Enalapril_dose"=>$request->input('ncdEmala_dose'),
            "Enalapril_Freq"=>$request->input('ncdEmala_frequency'),
            "Enalapril_duration"=>$request->input('ncdEmala_duration'),
            "Enalapril_durUnit"=>$request->input('ncdEmala_durUnit'),
            "Atorvastain_dose"=>$request->input('ncdator_dose'),
            "Atorvastain_Freq"=>$request->input('ncdator_frequency'),
            "Atorvastain_duration"=>$request->input('ncdator_duration'),
            "Atorvastain_durUnit"=>$request->input('ncdActor_durUnit'),
            "Hydrochlorothiazide_dose"=>$request->input('ncdhydro_dose'),
            "Hydrochlorothiazide_Freq"=>$request->input('ncdhydro_frequency'),
            "Hydrochlorothiazide_duration"=>$request->input('ncdhydro_duration'),
            "Hydrochlorothiazide_durUnit"=>$request->input('ncdhydro_durUnit'),
            "Aspirin_dose"=>$request->input('ncdAspi_dose'),
            "Aspirin_Freq"=>$request->input('ncdAspi_frequency'),
            "Aspirin_duration"=>$request->input('ncdAspi_duration'),
            "Aspirin_durUnit"=>$request->input('ncdAspi_durUnit'),
            "Metformin_dose"=>$request->input('ncdMetf_dose'),
            "Metformin_Freq"=>$request->input('ncdMetf_frequency'),
            "Metformin_duration"=>$request->input('ncdMetf_duration'),
            "Metformin_durUnit"=>$request->input('ncdMetf_durUnit'),
            "Gliclazide_dose"=>$request->input('ncdGli_dose'),
            "Gliclazide_Freq"=>$request->input('ncdGli_frequency'),
            "Gliclazide_duraion"=>$request->input('ncdGli_duration'),
            "Gliclazide_durUnit"=>$request->input('ncdGli_durUnit'),
            "Other_NCD_medication"=>$request->input('ncdother_medic'),
            "Oth_ncd_med_specify"=>$request->input('specifyNcd'),
            "cur_med1"=>$request->input('oth_medicname1'),
            "cur_med1_dose"=>$request->input('oth_does1'),
            "cur_med1_freq"=>$request->input('oth_freqency1'),
            "cur_med1_duration"=>$request->input('oth_duration1'),
            "cur_med1_durUnit"=>$request->input('th_durUnit1'),
            "cur_med2"=>$request->input('oth_medicname2'),
            "cur_med2_dose"=>$request->input('oth_does2'),
            "cur_med2_freq"=>$request->input('oth_freqency2'),
            "cur_med2_duration"=>$request->input('oth_duration2'),
            "cur_med2_durUnit"=>$request->input('th_durUnit2'),
            "cur_med3"=>$request->input('oth_medicname3'),
            "cur_med3_dose"=>$request->input('oth_does3'),
            "cur_med3_freq"=>$request->input('oth_freqency3'),
            "cur_med3_duration"=>$request->input('oth_duration3'),
            "cur_med3_durUnit"=>$request->input('th_durUnit3'),
            "cur_med4"=>$request->input('oth_medicname4'),
            "cur_med4_dose"=>$request->input('oth_does4'),
            "cur_med4_freq"=>$request->input('oth_freqency4'),
            "cur_med4_duration"=>$request->input('oth_duration4'),
            "cur_med4_durUnit"=>$request->input('th_durUnit4'),
            "cur_med5"=>$request->input('oth_medicname5'),
            "cur_med5_dose"=>$request->input('oth_does5'),
            "cur_med5_freq"=>$request->input('oth_freqency5'),
            "cur_med5_duration"=>$request->input('oth_duration5'),
            "cur_med5_durUnit"=>$request->input('th_durUnit5'),
            "cur_med6"=>$request->input('oth_medicname6'),
            "cur_med6_dose"=>$request->input('oth_does6'),
            "cur_med6_freq"=>$request->input('oth_freqency6'),
            "cur_med6_duration"=>$request->input('oth_duration6'),
            "cur_med6_durUnit"=>$request->input('th_durUnit6'),
            "Dia_foot"=>$request->input('ncdPat_diabetic'),
            "Hyperlipidemia"=>$request->input('ncdPat_hyperli'),
            "Gestational_Diabetes"=>$request->input('ncdPat_gestation'),
            "Gestational_HT"=>$request->input('ncdPat_gestHT'),
            "Neuropathy"=>$request->input('ncdPat_neuro'),
            "CKD"=>$request->input('ncdPat_ckd'),
            "CVD"=>$request->input('ncdPat_cvd'),
            "Atril_Fib"=>$request->input('ncdPat_atrial'),
            "Change_in_Vision"=>$request->input('ncdPat_changeVs'),
            "Chronic_Lung_Disease"=>$request->input('ncdPat_chronicLung'),
            "Recur_infection"=>$request->input('ncdPat_recurIf'),
            "Recur_infection_comment"=>$request->input('ncdPat_commentIf'),
            "Family_Hyper"=>$request->input('ncdfam_hyperten'),
            "Family_Diabetes"=>$request->input('ncdfam_diabetes'),
    
          ]);
      }
      return response()->json(["success"]);
    }

    if($notice=="NCD follow save_update"){
      $mam_Bp=$request->input('ncdV_mamBp1')."/".$request->input('ncdV_mamBp2');
      $ncd_time=$request->input('ncdV_hours').":".$request->input('ncdV_minutes').":00".":".$request->input('ncdV_AP');
      $follow_update=$request->input('follow_update');
      if($follow_update=="NCD Follow Updated"){
        $follow_UpdateID=$request->input('Follow_updateID');
        ncdFollowup::where("id","=",$follow_UpdateID)->update([
          "Clinic_code"=>$request->input("Clinic_Code"),
          "Pid"=>$request->input("ncdV_pid"),
          "FuchiaID"=>$request->input("ncdV_fid"),
          "Visit_date"=>$request->input("ncdV_visit"),
          "Reg_Date"=>$request->input("Reg_Date"),
          "Agey"=>$request->input("Agey"),
          "Gender"=>$request->input("Gender"),
          "Area_Division"=>$request->input("Area_Division"),
          "Township"=>$request->input("Township"),
          "NCD_Diagnosis"=>$request->input("ncdV_diagnosis"),
          "Follow_Height"=>$request->input("follow_height"),
          "Follow_Weight"=>$request->input("ncdV_weight"),
          "Follow_Bmi"=>$request->input("ncd_FollowBmi"),
          "Type_cur_visit"=>$request->input("ncdV_Type_currentVisit"),
          "Late_visit"=>$request->input("ncdV_latein"),
          "Late_duration"=>$request->input("ncdV_lateSpe"),
          "Late_follow"=>$request->input("ncdV_FrequireIn"),
          "Late_fol_duration"=>$request->input("ncdV_FrequireDate"),
          "Next_Appointment"=>$request->input("ncdV_RT_folloDate"),
          "Time"=>$ncd_time,
          "own_clinic_Bp"=>$mam_Bp,
          "own_Bp_Stage"=>$request->input("ncdV_FBpStage"),
          "FBS"=>$request->input("ncdV_fbs"),
          "FBS_test_date"=>$request->input("ncdV_fbsDate"),
          "2HPP"=>$request->input("ncdV_2hpp"),
          "2HPP_test_date"=>$request->input("ncdV_2hppDate"),
          "Loaction_test"=>$request->input("ncdV_LocaTest"),
          "Lab_res_Date"=>$request->input("ncdV_othLabDate"),
          "Alt"=>$request->input("ncdV_othAlt"),
          "HBA1C"=>$request->input("ncdV_othHBA1C"),
          "Uring_AC_ratio"=>$request->input("ncdV_uAcratio"),
          "Glucose_res"=>$request->input("ncdV_uGly"),
          "Protein_res"=>$request->input("ncdV_uProtein"),
          "Creatinine"=>$request->input("ncdV_creatinIn"),
          "Creat_unit"=>$request->input("ncdV_cratainType"),
          "CRCL"=>$request->input("ncdV_crcl"),
          "Total_cholesterol"=>$request->input("ncdV_Totalcho"),
          "Total_cho_Unit"=>$request->input("ncdV_totalChoUnit"),
          "CVD_Risk"=>$request->input("ncdV_cvdRisk"),
          "HDL"=>$request->input("ncdV_HDL"),
          "HDL_unit"=>$request->input("ncdV_HDLunit"),
          "LDL"=>$request->input("ncdV_LDLin"),
          "LDL_unit"=>$request->input("ncdV_ldlselect"),
          "Triglyceride"=>$request->input("ncdV_trigIn"),
          "Triglyceride_unit"=>$request->input("ncdV_Trigselect"),
          "Pulse"=>$request->input("ncdV_pluse"),
          "Pulse_rate"=>$request->input("ncdV_pluRate"),
          "Diabetic_foot"=>$request->input("ncdV_diabeFoot"),
          "Diabetic_Neuropathy"=>$request->input("ncdV_diabeneu"),
          "Lifestyle advice"=>$request->input("ncdV_lifeStyle"),
          "Medication changed"=>$request->input("ncdV_Mchange"),
          "Patient_adhe medic"=>$request->input("ncdV_adherence"),
          "Drug_Supply"=>$request->input("ncdV_drugSupply"),

          "F_Amlodipine_dose"=>$request->input("ncdV_Amlo_dose"),
          "F_Amlodipine_Freq"=>$request->input("ncdV_Amlo_frequency"),
          "F_Amlodipine_duration"=>$request->input("ncdV_Amlo_duration"),
          "F_Amlodipine_durUnit"=>$request->input("ncdV_Amlo_durUnit"),

          "F_Enalapril_dose"=>$request->input("ncdV_Emala_dose"),
          "F_Enalapril_Freq"=>$request->input("ncdV_Emala_frequency"),
          "F_Enalapril_duration"=>$request->input("ncdV_Emala_duration"),
          "F_Enalapril_durUnit"=>$request->input("ncdV_Emala_durUnit"),

          "F_Atorvastain_dose"=>$request->input("ncdV_ator_dose"),
          "F_Atorvastain_Freq"=>$request->input("ncdV_ator_frequency"),
          "F_Atorvastain_duration"=>$request->input("ncdV_ator_duration"),
          "F_Atorvastain_durUnit"=>$request->input("ncdV_ator_durUnit"),

          "F_Hydrochlorothiazide_dose"=>$request->input("ncdV_hydro_dose"),
          "F_Hydrochlorothiazide_Freq"=>$request->input("ncdV_hydro_frequency"),
          "F_Hydrochlorothiazide_duration"=>$request->input("ncdV_hydro_duration"),
          "F_Hydrochlorothiazide_durUnit"=>$request->input("ncdV_hydro_durUnit"),

          "F_Aspirin_dose"=>$request->input("ncdV_Aspi_dose"),
          "F_Aspirin_Freq"=>$request->input("ncdV_Aspi_frequency"),
          "F_Aspirin_duration"=>$request->input("ncdV_Aspi_duration"),
          "F_Aspirin_durUnit"=>$request->input("ncdV_Aspi_durUnit"),

          "F_Metformin(500)_dose"=>$request->input("ncdV_Metf500_dose"),
          "F_ Metformin(500)_Freq"=>$request->input("ncdV_Metf500_frequency"),
          "F_Metformin(500)_duration"=>$request->input("ncdV_Metf500_duration"),
          "F_Metformin(500)_durUnit"=>$request->input("ncdV_Metf500_durUnit"),

          "F_Metformin(1000)_dose"=>$request->input("ncdV_Metf1000_dose"),
          "F_ Metformin(1000)_Freq"=>$request->input("ncdV_Metf1000_frequency"),
          "F_Metformin(1000)_duration"=>$request->input("ncdV_Metf1000_duration"),
          "F_Metformin(1000)_durUnit"=>$request->input("ncdV_Metf1000_durUnit"),

          "F_Gliclazide(500)_dose"=>$request->input("ncdV_Gli500_dose"),
          "F_Gliclazide(500)_Freq"=>$request->input("ncdV_Gli500_frequency"),
          "F_Gliclazide(500)_duraion"=>$request->input("ncdV_Gli500_duration"),
          "F_Gliclazide(500)_durUnit"=>$request->input("ncdV_Gli500_durUnit"),

          "F_Gliclazide(1000)_dose"=>$request->input("ncdV_Gli1000_dose"),
          "F_ Gliclazide(1000)_Freq"=>$request->input("ncdV_Gli1000_frequency"),
          "F_Gliclazide(1000)_duration"=>$request->input("ncdV_Gli1000_duration"),
          "F_Gliclazide(1000)_durUnit"=>$request->input("ncdV_Gli1000_durUnit"),
          "Symptom hypoglycemia"=>$request->input("symthom_hypo"),
          "Foth_medi"=>$request->input("ncdV_otherMeication"),
          "Foth_medi_spec"=>$request->input("ncdV_othmMspecify"),
          "Out_come"=>$request->input("ncdV_outcome"),
          "Tout_mam_clinic"=>$request->input("clinic_code"),
          "death_date"=>$request->input("ncd_dead_date"),
          "Tout_physician_data"=>$request->input("ncd_Tout_phy"),
          "Cause_of_death"=>$request->input("ncdV_deadApp"),
          "Fup_doc_initial"=>$request->input("ncdV_doctor"),
        ]);
      }else{
        ncdFollowup::create([
          "Clinic_code"=>$request->input("Clinic_Code"),
          "Pid"=>$request->input("ncdV_pid"),
          "FuchiaID"=>$request->input("ncdV_fid"),
          "Visit_date"=>$request->input("ncdV_visit"),
          "Reg_Date"=>$request->input("Reg_Date"),
          "Agey"=>$request->input("Agey"),
          "Gender"=>$request->input("Gender"),
          "Area_Division"=>$request->input("Area_Division"),
          "Township"=>$request->input("Township"),
          "NCD_Diagnosis"=>$request->input("ncdV_diagnosis"),
          "Follow_Height"=>$request->input("follow_height"),
          "Follow_Weight"=>$request->input("ncdV_weight"),
          "Follow_Bmi"=>$request->input("ncd_FollowBmi"),
          "Type_cur_visit"=>$request->input("ncdV_Type_currentVisit"),
          "Late_visit"=>$request->input("ncdV_latein"),
          "Late_duration"=>$request->input("ncdV_lateSpe"),
          "Late_follow"=>$request->input("ncdV_FrequireIn"),
          "Late_fol_duration"=>$request->input("ncdV_FrequireDate"),
          "Next_Appointment"=>$request->input("ncdV_RT_folloDate"),
          "Time"=>$ncd_time,
          "own_clinic_Bp"=>$mam_Bp,
          "own_Bp_Stage"=>$request->input("ncdV_FBpStage"),
          "FBS"=>$request->input("ncdV_fbs"),
          "FBS_test_date"=>$request->input("ncdV_fbsDate"),
          "2HPP"=>$request->input("ncdV_2hpp"),
          "2HPP_test_date"=>$request->input("ncdV_2hppDate"),
          "Loaction_test"=>$request->input("ncdV_LocaTest"),
          "Lab_res_Date"=>$request->input("ncdV_othLabDate"),
          "Alt"=>$request->input("ncdV_othAlt"),
          "HBA1C"=>$request->input("ncdV_othHBA1C"),
          "Uring_AC_ratio"=>$request->input("ncdV_uAcratio"),
          "Glucose_res"=>$request->input("ncdV_uGly"),
          "Protein_res"=>$request->input("ncdV_uProtein"),
          "Creatinine"=>$request->input("ncdV_creatinIn"),
          "Creat_unit"=>$request->input("ncdV_cratainType"),
          "CRCL"=>$request->input("ncdV_crcl"),
          "Total_cholesterol"=>$request->input("ncdV_Totalcho"),
          "Total_cho_Unit"=>$request->input("ncdV_totalChoUnit"),
          "CVD_Risk"=>$request->input("ncdV_cvdRisk"),
          "HDL"=>$request->input("ncdV_HDL"),
          "HDL_unit"=>$request->input("ncdV_HDLunit"),
          "LDL"=>$request->input("ncdV_LDLin"),
          "LDL_unit"=>$request->input("ncdV_ldlselect"),
          "Triglyceride"=>$request->input("ncdV_trigIn"),
          "Triglyceride_unit"=>$request->input("ncdV_Trigselect"),
          "Pulse"=>$request->input("ncdV_pluse"),
          "Pulse_rate"=>$request->input("ncdV_pluRate"),
          "Diabetic_foot"=>$request->input("ncdV_diabeFoot"),
          "Diabetic_Neuropathy"=>$request->input("ncdV_diabeneu"),
          "Lifestyle advice"=>$request->input("ncdV_lifeStyle"),
          "Medication changed"=>$request->input("ncdV_Mchange"),
          "Patient_adhe medic"=>$request->input("ncdV_adherence"),
          "Drug_Supply"=>$request->input("ncdV_drugSupply"),

          "F_Amlodipine_dose"=>$request->input("ncdV_Amlo_dose"),
          "F_Amlodipine_Freq"=>$request->input("ncdV_Amlo_frequency"),
          "F_Amlodipine_duration"=>$request->input("ncdV_Amlo_duration"),
          "F_Amlodipine_durUnit"=>$request->input("ncdV_Amlo_durUnit"),

          "F_Enalapril_dose"=>$request->input("ncdV_Emala_dose"),
          "F_Enalapril_Freq"=>$request->input("ncdV_Emala_frequency"),
          "F_Enalapril_duration"=>$request->input("ncdV_Emala_duration"),
          "F_Enalapril_durUnit"=>$request->input("ncdV_Emala_durUnit"),

          "F_Atorvastain_dose"=>$request->input("ncdV_ator_dose"),
          "F_Atorvastain_Freq"=>$request->input("ncdV_ator_frequency"),
          "F_Atorvastain_duration"=>$request->input("ncdV_ator_duration"),
          "F_Atorvastain_durUnit"=>$request->input("ncdV_ator_durUnit"),

          "F_Hydrochlorothiazide_dose"=>$request->input("ncdV_hydro_dose"),
          "F_Hydrochlorothiazide_Freq"=>$request->input("ncdV_hydro_frequency"),
          "F_Hydrochlorothiazide_duration"=>$request->input("ncdV_hydro_duration"),
          "F_Hydrochlorothiazide_durUnit"=>$request->input("ncdV_hydro_durUnit"),

          "F_Aspirin_dose"=>$request->input("ncdV_Aspi_dose"),
          "F_Aspirin_Freq"=>$request->input("ncdV_Aspi_frequency"),
          "F_Aspirin_duration"=>$request->input("ncdV_Aspi_duration"),
          "F_Aspirin_durUnit"=>$request->input("ncdV_Aspi_durUnit"),

          "F_Metformin(500)_dose"=>$request->input("ncdV_Metf500_dose"),
          "F_ Metformin(500)_Freq"=>$request->input("ncdV_Metf500_frequency"),
          "F_Metformin(500)_duration"=>$request->input("ncdV_Metf500_duration"),
          "F_Metformin(500)_durUnit"=>$request->input("ncdV_Metf500_durUnit"),

          "F_Metformin(1000)_dose"=>$request->input("ncdV_Metf1000_dose"),
          "F_ Metformin(1000)_Freq"=>$request->input("ncdV_Metf1000_frequency"),
          "F_Metformin(1000)_duration"=>$request->input("ncdV_Metf1000_duration"),
          "F_Metformin(1000)_durUnit"=>$request->input("ncdV_Metf1000_durUnit"),

          "F_Gliclazide(500)_dose"=>$request->input("ncdV_Gli500_dose"),
          "F_Gliclazide(500)_Freq"=>$request->input("ncdV_Gli500_frequency"),
          "F_Gliclazide(500)_duraion"=>$request->input("ncdV_Gli500_duration"),
          "F_Gliclazide(500)_durUnit"=>$request->input("ncdV_Gli500_durUnit"),

          "F_Gliclazide(1000)_dose"=>$request->input("ncdV_Gli1000_dose"),
          "F_ Gliclazide(1000)_Freq"=>$request->input("ncdV_Gli1000_frequency"),
          "F_Gliclazide(1000)_duration"=>$request->input("ncdV_Gli1000_duration"),
          "F_Gliclazide(1000)_durUnit"=>$request->input("ncdV_Gli1000_durUnit"),

          "Symptom hypoglycemia"=>$request->input("symthom_hypo"),
          "Foth_medi"=>$request->input("ncdV_otherMeication"),
          "Foth_medi_spec"=>$request->input("ncdV_othmMspecify"),
          "Out_come"=>$request->input("ncdV_outcome"),
          "Tout_mam_clinic"=>$request->input("clinic_code"),
          "death_date"=>$request->input("ncd_dead_date"),
          "Tout_physician_data"=>$request->input("ncd_Tout_phy"),
          "Cause_of_death"=>$request->input("ncdV_deadApp"),
          "Fup_doc_initial"=>$request->input("ncdV_doctor"),
        ]);
      }
      


      return response()->json([$mam_Bp]);
    }

    if($notice=="Find Follow History"){

      $idnumber=$request->input('idnumber');
      $ncdFollow_name=[
        "Pid","ncdV_pid",
        "FuchiaID","ncdV_fid",
        "Visit_date","ncdV_visit",
        "NCD_Diagnosis","ncdV_diagnosis",
        "Follow_Height","follow_height",
        "Follow_Weight","ncdV_weight",
        "Follow_Bmi","ncd_FollowBmi",
        "Type_cur_visit","ncdV_Type_currentVisit",
        "Late_visit","ncdV_latein",
        "Late_duration","ncdV_lateSpe",
        "Late_follow","ncdV_FrequireIn",
        "Late_fol_duration","ncdV_FrequireDate",
        "Next_Appointment","ncdV_RT_folloDate",
        "Time","ncdV_time",
        "own_clinic_Bp","mam_Bp",
        "own_Bp_Stage","ncdV_FBpStage",
        "FBS","ncdV_fbs",
        "FBS_test_date","ncdV_fbsDate",
        "2HPP","ncdV_2hpp",
        "2HPP_test_date","ncdV_2hppDate",
        "Loaction_test","ncdV_LocaTest",
        "Lab_res_Date","ncdV_othLabDate",
        "Alt","ncdV_othAlt",
        "HBA1C","ncdV_othHBA1C",
        "Uring_AC_ratio","ncdV_uAcratio",
        "Glucose_res","ncdV_uGly",
        "Protein_res","ncdV_uProtein",
        "Creatinine","ncdV_creatinIn",
        "Creat_unit","ncdV_cratainType",
        "CRCL","ncdV_crcl",
        "Total_cholesterol","ncdV_Totalcho",
        "Total_cho_Unit","ncdV_totalChoUnit",
        "CVD_Risk","ncdV_cvdRisk",
        "HDL","ncdV_HDL",
        "HDL_unit","ncdV_HDLunit",
        "LDL","ncdV_LDLin",
        "LDL_unit","ncdV_ldlselect",
        "Triglyceride","ncdV_trigIn",
        "Triglyceride_unit","ncdV_Trigselect",
        "Pulse","ncdV_pluse",
        "Pulse_rate","ncdV_pluRate",
        "Diabetic_foot","ncdV_diabeFoot",
        "Diabetic_Neuropathy","ncdV_diabeneu",
        "Lifestyle advice","ncdV_lifeStyle",
        "Medication changed","ncdV_Mchange",
        "Patient_adhe medic","ncdV_adherence",
        "Drug_Supply","ncdV_drugSupply",
        "F_Amlodipine_dose","ncdV_Amlo_dose",
        "F_Amlodipine_Freq","ncdV_Amlo_frequency",
          "F_Amlodipine_duration","ncdV_Amlo_duration",
          "F_Amlodipine_durUnit","ncdV_Amlo_durUnit",

          "F_Enalapril_dose","ncdV_Emala_dose",
          "F_Enalapril_Freq","ncdV_Emala_frequency",
          "F_Enalapril_duration","ncdV_Emala_duration",
          "F_Enalapril_durUnit","ncdV_Emala_durUnit",

          "F_Atorvastain_dose","ncdV_ator_dose",
          "F_Atorvastain_Freq","ncdV_ator_frequency",
          "F_Atorvastain_duration","ncdV_ator_duration",
          "F_Atorvastain_durUnit","ncdV_ator_durUnit",

          "F_Hydrochlorothiazide_dose","ncdV_hydro_dose",
          "F_Hydrochlorothiazide_Freq","ncdV_hydro_frequency",
          "F_Hydrochlorothiazide_duration","ncdV_hydro_duration",
          "F_Hydrochlorothiazide_durUnit","ncdV_hydro_durUnit",

          "F_Aspirin_dose","ncdV_Aspi_dose",
          "F_Aspirin_Freq","ncdV_Aspi_frequency",
          "F_Aspirin_duration","ncdV_Aspi_duration",
          "F_Aspirin_durUnit","ncdV_Aspi_durUnit",

          "F_Metformin(500)_dose","ncdV_Metf500_dose",
          "F_ Metformin(500)_Freq","ncdV_Metf500_frequency",
          "F_Metformin(500)_duration","ncdV_Metf500_duration",
          "F_Metformin(500)_durUnit","ncdV_Metf500_durUnit",

          "F_Metformin(1000)_dose","ncdV_Metf1000_dose",
          "F_ Metformin(1000)_Freq","ncdV_Metf1000_frequency",
          "F_Metformin(1000)_duration","ncdV_Metf1000_duration",
          "F_Metformin(1000)_durUnit","ncdV_Metf1000_durUnit",

          "F_Gliclazide(500)_dose","ncdV_Gli500_dose",
          "F_Gliclazide(500)_Freq","ncdV_Gli500_frequency",
          "F_Gliclazide(500)_duraion","ncdV_Gli500_duration",
          "F_Gliclazide(500)_durUnit","ncdV_Gli500_durUnit",

          "F_Gliclazide(1000)_dose","ncdV_Gli1000_dose",
          "F_ Gliclazide(1000)_Freq","ncdV_Gli1000_frequency",
          "F_Gliclazide(1000)_duration","ncdV_Gli1000_duration",
          "F_Gliclazide(1000)_durUnit","ncdV_Gli1000_durUnit",
        "Symptom hypoglycemia","symthom_hypo",
        "Foth_medi","ncdV_otherMeication",
        "Foth_medi_spec","ncdV_othmMspecify",
        "Out_come","ncdV_outcome",
        "Tout_mam_clinic","clinic_code",
        "death_date","ncd_dead_date",
        "Tout_physician_data","ncd_Tout_phy",
        "Cause_of_death","ncdV_deadApp",
        "Fup_doc_initial","ncdV_doctor",
      ];
      $ncdFollow_data=ncdFollowup::where("id","=",$idnumber)->first();
      for ($Fcount=0; $Fcount <count($ncdFollow_name) ; $Fcount++) { 
        $ncd_Follow_Fill[$ncdFollow_name[$Fcount+1]]=$ncdFollow_data[$ncdFollow_name[$Fcount]];
        $Fcount++;
      }
      return response()->json([$ncd_Follow_Fill]);
      

    }


    if($notice=="Remove_follow"){
      $idnumber=$request->input('idnumber');
      $pid=$request->input('pid');
      $delete=ncdFollowup::where("id","=",$idnumber)->where("Pid",$pid)->delete();
      if($delete){
        DB::statement('SET @id := 0');
        DB::statement('UPDATE ncd_followups SET id = @id := @id + 1');
        DB::statement('ALTER TABLE ncd_followups AUTO_INCREMENT = 1');
      }
      
      return response()->json($delete);
      

    }
    if($notice=="Remove register"){
      $pid=$request->input('pid');
      $ncd_delete=ncd_pt_register::where("Pid",$pid)->delete();
      if($ncd_delete){
        DB::statement('SET @id := 0');
        DB::statement('UPDATE ncd_pt_registers SET id = @id := @id + 1');
        DB::statement('ALTER TABLE ncd_pt_registers AUTO_INCREMENT = 1');
        $ncd_follow_delete=ncdFollowup::where("Pid",$pid)->delete();
        if($ncd_follow_delete){
          DB::statement('SET @id := 0');
          DB::statement('UPDATE ncd_followups SET id = @id := @id + 1');
          DB::statement('ALTER TABLE ncd_followups AUTO_INCREMENT = 1');
        }
      }
      return response()->json($ncd_delete);
    }

    if($notice=="NCD Export"){
      $ncd_exType=$request["ncd_exportType"];
      $disForm = $request->input("ncd_dateFrom");
      $timestamp = strtotime($disForm);
      $disForm  = date('Y-m-d', $timestamp);

      $disTo=$request->input("ncd_dateTo");
      $timestamp = strtotime($disTo);
      $disTo  = date('Y-m-d', $timestamp);
      
      if($ncd_exType=="Register"){
       
              
        $ncd_register_export = ncd_pt_register::whereBetween("Reg_Date", [$disForm, $disTo])
        ->with([
          'ptconfig' => function ($query) {
            $query->select("Pid",'Date of Birth','Agey','Agem','Gender','FuchiaID');
          }
        ])->get()->makeHidden(['created_at', 'updated_at']);
        if(count($ncd_register_export)!=0){
          $ncd_reg_date=[
            "Reg_Date","1stBP_date","1st_DiagDate","1st_RBS_date",
            "2ndBP_date","2nd_DiagDate","2nd_RBS_date","3rdBP_date",
            "death_date"
          ];

          foreach($ncd_register_export as $index=>$value){
            if($value["ptconfig"]!=null){
              $value=Export_age::Export_general($value["ptconfig"],$value["Reg_Date"],$value["ptconfig"]["Date of Birth"],$value);
              $value["Gender"]=Crypt::decrypt_light($value["ptconfig"]["Gender"],$table);
              $value["FuchiaID"]=$value["ptconfig"]["FuchiaID"];
            }
            foreach( $ncd_reg_date as $column ){
              if($ncd_register_export[$index][$column]!=null){
                $carbonDate = Carbon::createFromFormat('Y-m-d', $ncd_register_export[$index][$column]);
                $carbonDate = Carbon::createFromFormat('d-m-Y', $carbonDate->format('d-m-Y'));
                $ncd_register_export[$index][$column]=Date::dateTimeToExcel($carbonDate->toDateTime());
              }
            }

          }
          return Excel::download(new NCD_Register_Export($ncd_register_export), 'NCD Registered Export-'.date("d-m-Y").'.xlsx');
        }
        

      }else if($ncd_exType=="Follow up"){
        $ncd_follow_export = ncdFollowup::whereBetween("Visit_date", [$disForm, $disTo])
        ->join('ncd_pt_registers', 'ncd_followups.Pid', '=', 'ncd_pt_registers.Pid') // specify the connection for pt_configs table
        ->select('ncd_followups.*','ncd_pt_registers.Reg_Date','visit_Age')
        ->with([
          'ptconfig' => function ($query) {
            $query->select("Pid",'Date of Birth','Agey','Agem','Gender','FuchiaID');
          }
        ])->get()->makeHidden(['created_at', 'updated_at']);
        if($ncd_follow_export!=null){

          $ncd_follow_date=[
            "Visit_date","Next_Appointment","FBS_test_date","2HPP_test_date","Lab_res_Date","death_date","Reg_Date"
          ];
          foreach($ncd_follow_export as $index=>$value){
            if($value["ptconfig"]!=null){
              $value=Export_age::Export_general($value["ptconfig"],$value["Visit_date"],$value["ptconfig"]["Date of Birth"],$value);
              $value["Gender"]=Crypt::decrypt_light($value["ptconfig"]["Gender"],$table);
              $value["FuchiaID"]=$value["ptconfig"]["FuchiaID"];
            }
            foreach($ncd_follow_date as $column ){
              if($ncd_follow_export[$index][$column]!=null){
                $carbonDate = Carbon::createFromFormat('Y-m-d', $ncd_follow_export[$index][$column]);
                $carbonDate = Carbon::createFromFormat('d-m-Y', $carbonDate->format('d-m-Y'));
                $ncd_follow_export[$index][$column]=Date::dateTimeToExcel($carbonDate->toDateTime());
              }
            }
          }
          return Excel::download(new NCD_Follow_Export($ncd_follow_export), 'NCD Follow up Export-'.date("d-m-Y").'.xlsx');
        }
        
      }
    }
  }

 




}

<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\ncd_pt_register;
use App\Models\HtyANcdFollowup;
use App\Models\Patients;
use App\Models\NcdAnual;
use App\Models\Lab;

class ncdRegisterPtController extends Controller
{
  //new Ncd view
  public function ncd_View(){
    return view ('NCD.Ncd');
  }
  public function ncdRegister_View()
      {
        $dataSuccess=[[ 	"id" => 1, "name" => "Ready" ]];
        $ck=[[ 	"id" => 1, "name" => "ck" ]];
        return view ('NCD.ncdRegisterForm',[
                'success'  => $dataSuccess,
                'check'=> $ck
                ]);
         //return view('file-import');
      }

    public function ncdRegister_data(Request $request){

      $pid = $request->input('pid');
      $regdate = $request->input('regdate');
      $fhis = $request ->input('fhis');
      $arhis = $request ->input('arhis');
      $fu_id = $request->input('fu_id');
      $vdate= $request -> input ('vdate');
      $ar  = $request->input('ar_id');
      $checklab = $request->input('ckLab');
      $ckgeneral = $request->input('ckgeneral');
      $anualReview= $request->input('anualReview');

      if($anualReview==true){// to put data into anual review table
        NcdAnual::create([
        'pid' => $request->pid ,
      //  ' => $request->ar_fuchiaID,
        'Visit_date' => $request->ar_visitdate,
        'ar_date' => $request->ar_visitdate,
        'NCD_diagnosis' => $request->ar_diagnosis,
      //  ' => $request->foot ,
      //  ' => $request->hyperlipid ,
      //  ' => $request->diagestational ,
      //  ' => $request->neuropa ,
      //  ' => $request->ckd ,
      //  ' => $request->cvdmicvapvd ,
      //  ' => $request->atrial ,
      //  ' => $request->vision ,
      //  ' => $request->heart ,
        'ar_num' => $request->ar_num ,
        'ar_bmi' => $request->ar_bmi ,
      //'ar_systBP',
      //  ' => $request->ar_hyper_stage ,
        'Annual_Check_Pulse_for_AF' => $request->ck_pulse ,
        'ar_fbs' => $request->ar_fbs ,
        'ar_hba1c' => $request->ar_hba1c ,
        'Urine_Protein' => $request->ar_protein ,
        'Urine_glucose' => $request->ar_glucose ,
      //  ' => $request->ar_urineOther ,
        'ar_urine_acr' => $request->ar_urineACR ,
        'ar_ALT' => $request->ar_Alt,
        'ar_creatinine' => $request->ar_creatinine ,
      //  ' => $request->ar_creatine_unit ,
        'ar_CrCl' => $request->ar_crcl ,
        'ar_total_chol' => $request->ar_chol ,
      //  ' => $request->ar_chol_unit ,
        'ar_Triglyceride' => $request->ar_trigly,
      //  ' => $request->ar_trigly_unit ,
        'ar_HDL' => $request->ar_hdl ,
      //  ' => $request-> ar_hdl_unit ,
        'ar_LDL' => $request->ar_ldl ,
      //  ' => $request->ar_ldl_unit ,
        'ar_CVD_risk_score' => $request-> ar_cvdRisk ,
        'ar_Dia_foot_check' => $request->ar_footcheck ,
        'ar_Refer_retinopathy_2_yearly' => $request->ar_refer_retino ,
        'ar_dietary_advice' => $request->ar_dietaryAD ,
        'ar_Advice_physical_activity' => $request->ar_physicalAD ,
      //  ' => $request->ar_smokingStatus ,
        'ar_discuss_smoking' => $request->ar_smokingDiscussion ,
        'ar_doc' => $request->ar_drName
        ]);
        $dataSuccess=[[ "id" => 1, "name" => "Successfully Save the patient's data." ]];
             return response()->json([$dataSuccess]);
      }

      if($ckgeneral==true){// checking is this patient has been registered in NCD registration
        $patient = ncd_pt_register::where('pid',$pid)->first();
        $GTpatient = Patients::where('Pid',$pid)->first();

        if($patient){
          return response()->json([$patient,$GTpatient]);
        }else{

          return response()->json([$patient,$GTpatient]);
        }

      }

      // to check adn fetch  lab results

        if($checklab){
          $labdata= DB::table('urines')
                ->where('CID', '=', $ar)
                ->where('visitDate', '=', $vdate)
                ->first();
        //  $labdata = Lab::where('Pid',$ar )->where('Visit_date',$vdate)
        //            ->first();
           return response()->json([$labdata]);
        }

        if($arhis){// to check Anual review History
          $arHist= NcdAnual ::where('pid',$pid)->get();
          return response()->json([
                $arHist
              ]);
        }

        if($fhis){// to check Follow up History
            $followupHist = HtyANcdFollowup::where('pid',$pid)->get();
            return response()->json([
                  $followupHist
                ]);
        }


        // This is for followup


      //  $fu_fuchiaID = $request->input('fu_fuchiaID');
        if($fu_id){
          HtyANcdFollowup::create([
               'pid' => $request->fu_id
               //'pt_fuchiaid'     => $request->fu_fuchiaID
               ]);
         $dataSuccess=[[ 	"id" => 1, "name" => "Successfully Save the patient's data." ]];
                //return view ('NCD.ncdRegisterForm',[
                //   'success'  => $dataSuccess
                //  ]);
                  return response()->json([
                        $dataSuccess
                      ]);
              }

        if($pid AND $regdate){
          ncd_pt_register::create([
               'pid' => $request->pid,
               'Fuchsia_ID'     => $request->fuchia,
               'Age'             => $request->visitage,
               'Agey'           => $request->visitage,
               'Reg_Date'       => $request->regdate,
               'Area_Division'  => $request->state,
               'Township'        => $request->tt,
               'Height'          => $request->height,
               'Weight'           => $request->weight,
               'Gender'           => $request->gender,
               '1stBP_Up'        => $request->bpup_1st,
               '1stBP_Low'       => $request->bpdown_1st,
               '1stBP_date'      => $request->bpdate_1st,
               '2ndBP_Up'         => $request->bpup_2nd,
               '2ndBP_Low'        => $request-> bpdown_2nd,
               '2ndBP_date'      => $request->bpDate_2nd,
               '3rdBP_Up'       => $request->bpup_3rd,
               '3rdBP_Low'      => $request->bpdown_3rd,
               '3rdBP_date'      => $request->bpDate_3rd,
               'Hypertension'    => $request->hyper,
               'Hyper_Di_date'  => $request->hyperdate,
               'Diabetes'       => $request->dia,
               'Dia_Dig_date'    => $request->diaDate,
               'Stage_of_Hyper'   => $request->hyperStage,
               '1st_RBS'          => $request->rbs_1st,
               '1st_RBS_date'   => $request->rbsDate_1st,
               '2nd_RBS'        => $request->fbs_2nd,
               '2nd_RBS_date'    => $request->fbsDate_2nd,
               'Clinical_Symptoms'      => $request->cli_symptom,
               'Clinical_Symptoms_Text'  => $request->clinical_text,
               'Smoking_Status'      => $request->smoking_status,
               'Amlodipine_dose'      => $request->Amlodipine_dose,
               'Amlodipine_Freq'       => $request->Amlodipine_Freq,
               'Amlodipine_due' => $request->Amlodipine_due,
               'Enalapril_dose'  => $request->Enalapril_dose,
               'Enalapril_Freq'   => $request->Enalapril_Freq,
               'Enalapril_due'    => $request->Enalapril_due,
               'Atorvastain_dose' => $request->Atorvastain_dose,
               'Atorvastain_Freq' => $request->Atorvastain_Freq,
               'Atorvastain_due'  => $request->Atorvastain_due,
               'Hydrochlorothiazide_dose'  => $request->Hydrochlorothiazide_dose,
               'Hydrochlorothiazide_Freq'  => $request->Hydrochlorothiazide_Freq,
               'Hydrochlorothiazide_due'   => $request->Hydrochlorothiazide_due,
               'Aspirin_dose'    => $request->Aspirin_dose,
               'Aspirin_Freq'  => $request->Aspirin_Freq,
               'Aspirin_due'     => $request->Aspirin_due,
               'Metformin_dose'  => $request->Metformin_dose,
               'Metformin_Freq'   => $request->Metformin_Freq,
               'Metformin_due'  => $request->Metformin_due,
               'Gliclazide_dose'  => $request->Gliclazide_dose,
               'Gliclazide_Freq'  => $request->Gliclazide_Freq,
               'Gliclazide_due'  => $request->Gliclazide_due,
               'oth_ncd_med_spec'    => $request->otherNCDMed,
               'Other_NCD_medication'  => $request->othr_ncd_text,
               'cur_med1'             => $request->cur_med1,
               'cur_med1_dose'        => $request->cur_med1_dose,
               'cur_med1_freq' => $request->cur_med1_freq,
               'cur_med1_due' => $request->cur_med1_due,
               'cur_med2'  => $request->cur_med2,
               'cur_med2_dose' => $request->cur_med2_dose,
               'cur_med2_freq'  => $request->cur_med2_freq,
               'cur_med2_due'  => $request->cur_med2_due,
               'cur_med3'   => $request->cur_med3,
               'cur_med3_dose' => $request->cur_med3_dose,
               'cur_med3_freq'  => $request->cur_med3_freq,
               'cur_med3_due'  => $request->cur_med3_due,
               'cur_med4' => $request->cur_med4,
               'cur_med4_dose' => $request->cur_med4_dose,
               'cur_med4_freq'  => $request->cur_med4_freq,
               'cur_med4_due'   => $request->cur_med4_due,
               'cur_med5' => $request->cur_med5,
               'cur_med5_dose'  => $request->cur_med5_dose,
               'cur_med5_freq'  => $request->cur_med5_freq,
               'cur_med5_due'  => $request->cur_med5_due,
               'cur_med6'  => $request->cur_med6,
               'cur_med6_dose' => $request->cur_med6_dose,
               'cur_med6_freq' => $request->cur_med6_freq,
               'cur_med6_due'  => $request->cur_med6_due,
               'Dia_foot' => $request->diaFoot,
               'Neuropathy' => $request->neuropathy,
               'Atril_Fib'  => $request->atrial_fib,
               'Hyperlipidemia'  => $request->hyperlipidemia,
               'CKD'  => $request->ckd,
               'Change_in_Vision' => $request->change_inVision,
               'Gestational_Diabetes'  => $request->gestational_dia,
               'CVD'  => $request->cvd ,
               'Chronic_Lung_Disease'  => $request->chronic_lung_disease,
               'Recur_infection'  => $request->recur_inf,
               'Recur_infection_text' => $request->currncdmedic,
               'Family_Hyper'  => $request->hypertension,
               'Family_Diabetes' => $request->diabetes
               ]);
         $dataSuccess=[[ 	"id" => 1, "name" => "Successfully Save the patient's data." ]];
          //return view ('NCD.ncdRegisterForm',[
                //   'success'  => $dataSuccess
                //  ]);
          return response()->json([
                      $dataSuccess
                    ]);
        }
        // to check the patient is Old or New

        //  $old = array(
            //              "id"=>$pid,
            //              "history"=>"Old"
                                      //);
        //  return response()->json([
          //  $old
        //  ]);
        //}

      }



}

<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Patients;
use App\Models\PtConfig;
use App\Models\Followup_general;
use App\Models\Lab;
use App\Models\LabHbcTest;
use App\Models\Urine;
use App\Models\NcdAnual;
use App\Models\Rprtest;
use App\Models\Labstitest;
use App\Models\Lab_oi;
use App\Models\LabGeneralTest;
use App\Models\LabStoolTest;
use App\Models\LabAfbTest;
use App\Models\LabCovidTest;
use App\Models\Applog;

use Illuminate\Support\Facades\Crypt;

// For exports
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LabExport;
use App\Exports\Lab_rprExport;

/**
   * Store a new user.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */

class LabreportController extends Controller
{
  public function results(){

    return view (
      'Labs.results'
    );
  }
  public function reports(Request $request){
    $testName       = $request  ->input('testName');
    $exportName = $request ->input('exportName');
    $date_from      = $request ->input('date_from');
    $date_to        = $request ->input('date_to');
    $date_from = date($date_from);
    $date_to = date($date_to);
    switch ($testName) {
      case "hiv":
        return $this->hiv_calculator($date_from,$date_to);
        break;
      case "rpr":
        return $this->rpr_calculator($date_from,$date_to);
        break;
      case "hep_b_c":
        return $this->hep_calculator($date_from,$date_to);
        break;
      case "sti":
        return $this->sti_calculator($date_from,$date_to);
        break;
      case "sti_male":
        return $this->calculator($date_from,$date_to);
        break;
      case "tb_afb":
        return $this->tb_sputum_calculator($date_from,$date_to);
        break;
      case "dengue":
        return $this->dengue_calculator($date_from,$date_to);
        break;
      case "malaria":
        return $this->malaria_calculator($date_from,$date_to);
        break;
      case "oi":
        return $this->oi_calculator($date_from,$date_to);
        break;
      case "crypto_microscopy":
        return $this->crypto_microscopy_calculator($date_from,$date_to);
        break;
      case "pen_microscopy":
        return $this->pen_microscopy_calculator($date_from,$date_to);
        break;
      case "general":
        return $this->general_test_calculator($date_from,$date_to);
        break;

      default:

      }

    if($exportName == 'hiv'){
      return $this->exports_hiv();
    }
  }

  public function hiv_calculator($date_from,$date_to){
    $test_namy='hiv';
    $hiv_final_positive =0;$hiv_final_negative =0;$inconclusive_U_S =0;$inconclusive_S_U =0;$inconclusiveD_S_U =0;
    $hiv_lab =Lab::whereBetween('Visit_date', [$date_from, $date_to])->get();
    $num =count($hiv_lab);

    for ($i=0; $i < count($hiv_lab); $i++) {
      $final_result_det   = $hiv_lab[$i]['Detmine_Result'];
      $final_result_uni   = $hiv_lab[$i]['Unigold_Result'];
      $final_result_stat  = $hiv_lab[$i]['STAT_PAK_Result'];
      $final_result       = $hiv_lab[$i]['Final_Result'];

      if($final_result=='Positive'){
        $hiv_final_positive +=1;
      }
      if($final_result=='Negative'){
        $hiv_final_negative +=1;
      }
      if($final_result_det=='Reactive' && $final_result_uni=='Reactive' && $final_result_stat='Non Reactive'){
        $inconclusive_U_S +=1;
      }
      if($final_result_det=='Reactive' && $final_result_uni='Non Reactive' && $final_result_stat=='Reactive'){
        $inconclusive_S_U +=1;
      }
      if($final_result_det=='Non Reactive' && $final_result_uni='Reactive' && $final_result_stat=='Reactive'){
        $inconclusiveD_S_U +=1;
      }

    }
    $success=[["id"=> 1,
    "name" => "The counted number is".$num
    ]];
    return response()->json([
      $test_namy,
      $hiv_final_positive,
      $hiv_final_negative,
      $inconclusive_U_S,
      $inconclusive_S_U
    ]);
  }
  public function rpr_calculator($date_from,$date_to){
    $test_namy='rpr';
    $rpr_qualitative_male_R  =0; $rpr_qualitative_male_NR=0;$rpr_qualitative_female_R=0;$rpr_qualitative_female_NR=0;
    $RDT_positive_male=0; $RDT_negative_male=0;$RDT_positive_female=0; $RDT_negative_female=0;
    $rpr_lab =Rprtest::whereBetween('visit_date', [$date_from, $date_to])->get();


    for ($i=0; $i < count($rpr_lab); $i++) {
      $rpr_qualitative   = $rpr_lab[$i]['RPR Qualitative'];
      $gender = $rpr_lab[$i]['Gender'];
      $RDT_result = $rpr_lab[$i]['RDT Result'];

      if($gender=='Male'){ //////////////////////////////////// Male Section
        if($rpr_qualitative=='R'){
          $rpr_qualitative_male_R +=1;
        }else{
          $rpr_qualitative_male_NR +=1;
        }

        if($RDT_result=='Positive'){
          $RDT_positive_male +=1;
        }else{
          $RDT_negative_male +=1;
        }
      }
      if($gender=='Female'){ /////////////////////////////////// Female Section
        if($rpr_qualitative=='R'){
          $rpr_qualitative_female_R +=1;
        }else{
          $rpr_qualitative_female_NR +=1;
        }
        if($RDT_result=='Negative'){
          $RDT_positive_female +=1;
        }else{
          $RDT_negative_female +=1;
        }
      }
    }

    return response()->json([
      $test_namy,
      $rpr_qualitative_male_R,
      $rpr_qualitative_male_NR,
      $rpr_qualitative_female_R,
      $rpr_qualitative_female_NR,
      //5
      $RDT_positive_male,
      $RDT_positive_female,
      $RDT_negative_male,
      $RDT_negative_female,
    ]);
  }
  public function hep_calculator($date_from,$date_to){
    $test_namy='hep';

    $hep_lab =LabHbcTest::whereBetween('Visit_date', [$date_from, $date_to])->get();
    $hbs_Ag_test_anc =0;$hbs_Ag_test_fsw =0;$hbs_Ag_test_msm =0;$hbs_Ag_test_idu =0;
    $hbs_Ag_test_pkp =0;$hbs_Ag_test_cfsw =0;$hbs_Ag_test_mp =0;$hbs_Ag_test_ec =0;

    $hbs_Ag_test_lowrisk =0;$hep_B_pos_anc =0;$hep_B_pos_fsw =0;$hep_B_pos_msm =0;
    $hep_B_pos_idu =0;$hep_B_pos_pkp =0;$hep_B_pos_cfsw =0;$hep_B_pos_mp =0;
    $hep_B_pos_ec=0;$hep_B_pos_lw =0;
    $hcv_test_anc =0;$hcv_C_pos_anc =0;$hcv_test_fsw =0;$hcv_C_pos_fsw =0;$hcv_test_msm =0;$hcv_C_pos_msm =0;
    $hcv_test_idu =0;$hcv_C_pos_idu =0;$hcv_test_pkp =0;$hcv_C_pos_pkp =0;$hcv_test_cfsw =0;$hcv_C_pos_cfsw =0;
    $hcv_test_mp =0;$hcv_C_pos_mp =0;$hcv_test_ec =0;$hcv_C_pos_ec =0;$hcv_test_lw =0;$hcv_C_pos_lw =0;

    for ($i=0; $i < count($hep_lab); $i++) {
      $hep_risk   = $hep_lab[$i]['Patient_Type'];
      $hep_sub_risk   = $hep_lab[$i]['Patient Type Sub'];
      $Hep_B_result = $hep_lab[$i]['HepB Result'];
      $Hep_C_result = $hep_lab[$i]['HepC Result'];


      if($hep_risk=='ANC' || $hep_sub_risk=='ANC'){
        if($Hep_B_result=='Positive'){
          $hbs_Ag_test_anc +=1;
          $hep_B_pos_anc +=1;
        }
        if($Hep_B_result=='Negative'){
          $hbs_Ag_test_anc +=1;
        }
        if($Hep_C_result=='Positive'){
          $hcv_test_anc +=1;
          $hcv_C_pos_anc +=1;
        }
        if($Hep_C_result=='Negative'){
          $hcv_test_anc +=1;
        }

      }
      if($hep_risk=='FSW' || $hep_sub_risk=='FSW'){

        if($Hep_B_result=='Positive'){
          $hbs_Ag_test_fsw +=1;
          $hep_B_pos_fsw +=1;
        }
        if($Hep_B_result=='Negative'){
          $hbs_Ag_test_fsw +=1;
        }
        if($Hep_C_result=='Positive'){
          $hcv_test_fsw +=1;
          $hcv_C_pos_fsw +=1;
        }
        if($Hep_C_result=='Negative'){
          $hcv_test_fsw +=1;
        }
      }
      if($hep_risk=='MSM' || $hep_risk=='TG' ){

        if($Hep_B_result=='Positive'){
          $hbs_Ag_test_msm +=1;
          $hep_B_pos_msm +=1;
        }
        if($Hep_B_result=='Negative'){
          $hbs_Ag_test_msm +=1;
        }
        if($Hep_C_result=='Positive'){
          $hcv_test_msm +=1;
          $hcv_C_pos_msm +=1;
        }
        if($Hep_C_result=='Negative'){
          $hcv_test_msm +=1;
        }
      }
      if($hep_risk=='IDU' || $hep_sub_risk=='IDU'){

        if($Hep_B_result=='Positive'){
          $hbs_Ag_test_idu +=1;
          $hep_B_pos_idu +=1;
        }
        if($Hep_B_result=='Negative'){
          $hbs_Ag_test_idu +=1;
        }
        if($Hep_C_result=='Positive'){
          $hcv_test_idu +=1;
          $hcv_C_pos_idu +=1;
        }
        if($Hep_C_result=='Negative'){
          $hcv_test_idu +=1;
        }
      }
      if($hep_risk=='Partner of KP'){

        if($Hep_B_result=='Positive'){
          $hbs_Ag_test_pkp +=1;
          $hep_B_pos_pkp +=1;
        }
        if($Hep_B_result=='Negative'){
          $hbs_Ag_test_pkp +=1;
        }
        if($Hep_C_result=='Positive'){
          $hcv_test_pkp +=1;
          $hcv_C_pos_pkp +=1;
        }
        if($Hep_C_result=='Negative'){
          $hcv_test_pkp +=1;
        }
      }
      if($hep_risk=='Client of FSW' || $hep_sub_risk=='Client of FSW'){

        if($Hep_B_result=='Positive'){
          $hbs_Ag_test_cfsw +=1;
          $hep_B_pos_cfsw +=1;
        }
        if($Hep_B_result=='Negative'){
          $hbs_Ag_test_cfsw +=1;
        }
        if($Hep_C_result=='Positive'){
          $hcv_test_cfsw +=1;
          $hcv_C_pos_cfsw +=1;
        }
        if($Hep_C_result=='Negative'){
          $hcv_test_cfsw +=1;
        }
      }
      if($hep_risk=='Migrant population' || $hep_sub_risk=='Migrant population'){

        if($Hep_B_result=='Positive'){
          $hbs_Ag_test_mp +=1;
          $hep_B_pos_mp +=1;
        }
        if($Hep_B_result=='Negative'){
          $hbs_Ag_test_mp +=1;
        }
        if($Hep_C_result=='Positive'){
          $hcv_test_mp +=1;
          $hcv_C_pos_mp +=1;
        }
        if($Hep_C_result=='Negative'){
          $hcv_test_mp +=1;
        }
      }
      if($hep_risk=='Exposed child' || $hep_sub_risk=='Exposed child'){

        if($Hep_B_result=='Positive'){
          $hbs_Ag_test_ec +=1;
          $hep_B_pos_ec+=1;
        }
        if($Hep_B_result=='Negative'){
          $hbs_Ag_test_ec +=1;
        }
        if($Hep_C_result=='Positive'){
          $hcv_test_ec +=1;
          $hcv_C_pos_ec +=1;
        }
        if($Hep_C_result=='Negative'){
          $hcv_test_ec +=1;
        }
      }
      if($hep_risk=='Low risk' || $hep_sub_risk=='Low risk'){

        if($Hep_B_result=='Positive'){
          $hbs_Ag_test_lowrisk +=1;
          $hep_B_pos_lw +=1;
        }
        if($Hep_B_result=='Negative'){
          $hbs_Ag_test_lw +=1;
        }
        if($Hep_C_result=='Positive'){
          $hcv_test_lw +=1;
          $hcv_C_pos_lw +=1;
        }
        if($Hep_C_result=='Negative'){
          $hcv_test_lw +=1;
        }
      }
    }
    // Addition Section
    $hbs_test=
      $hbs_Ag_test_anc +
      $hbs_Ag_test_fsw +
      $hbs_Ag_test_msm +
      $hbs_Ag_test_idu +
      $hbs_Ag_test_pkp +
      $hbs_Ag_test_cfsw +
      $hbs_Ag_test_mp +
      $hbs_Ag_test_ec +
      $hbs_Ag_test_lowrisk;
    $hbs_b_positive=
      $hep_B_pos_anc +
      $hep_B_pos_fsw +
      $hep_B_pos_msm +
      $hep_B_pos_idu +
      $hep_B_pos_pkp +
      $hep_B_pos_cfsw +
      $hep_B_pos_mp +
      $hep_B_pos_ec+
      $hep_B_pos_lw;
    $hcv_test =
      $hcv_test_anc +
      $hcv_test_fsw +
      $hcv_test_msm +
      $hcv_test_idu +
      $hcv_test_pkp +
      $hcv_test_cfsw +
      $hcv_test_mp +
      $hcv_test_ec +
      $hcv_test_lw;
    $hcv_positive=
        $hcv_C_pos_anc +
        $hcv_C_pos_fsw +
        $hcv_C_pos_msm +
        $hcv_C_pos_idu +
        $hcv_C_pos_pkp +
        $hcv_C_pos_cfsw +
        $hcv_C_pos_mp +
        $hcv_C_pos_ec +
        $hcv_C_pos_lw;


    return response()->json([
      $test_namy,
      $hbs_Ag_test_anc ,
      $hbs_Ag_test_fsw ,
      $hbs_Ag_test_msm ,
      $hbs_Ag_test_idu ,
      $hbs_Ag_test_pkp ,
      $hbs_Ag_test_cfsw ,
      $hbs_Ag_test_mp ,
      $hbs_Ag_test_ec ,
      $hbs_Ag_test_lowrisk ,/////////////
      $hep_B_pos_anc ,
      $hep_B_pos_fsw ,
      $hep_B_pos_msm ,
      $hep_B_pos_idu ,
      $hep_B_pos_pkp ,
      $hep_B_pos_cfsw ,
      $hep_B_pos_mp ,
      $hep_B_pos_ec,
      $hep_B_pos_lw ,
      $hbs_test,// total of B test
      $hbs_b_positive,// total of B Positive

      $hcv_test_anc ,
      $hcv_test_fsw ,
      $hcv_test_msm ,
      $hcv_test_idu ,
      $hcv_test_pkp ,
      $hcv_test_cfsw ,
      $hcv_test_mp ,
      $hcv_test_ec ,
      $hcv_test_lw ,////////////////
      $hcv_test,// total hcv test
      $hcv_positive,//total of hcv positive
      $hcv_C_pos_anc ,
      $hcv_C_pos_fsw ,
      $hcv_C_pos_msm ,
      $hcv_C_pos_idu ,
      $hcv_C_pos_pkp ,
      $hcv_C_pos_cfsw ,
      $hcv_C_pos_mp ,
      $hcv_C_pos_ec ,
      $hcv_C_pos_lw ,

    ]);
  }
  public function sti_calculator($date_from,$date_to){
    $test_namy='sti';

    $sti_female_test=0;$GC_IE_female =0;$GC_Eonly_female =0;$TV_female =0;$clue_cell_female =0;$pmnl_female =0;
    $sti_male_test=0;$GC_IE_male =0;$GC_Eonly_male =0;$TV_male =0;$Candida_male=0;$pmnl_male =0;
    $sti_lab =Labstitest::whereBetween('visit_date', [$date_from, $date_to])->get();


    for ($i=0; $i < count($sti_lab); $i++) {
      $pid                                = $sti_lab[$i]['CID'];
      $gender                             = $sti_lab[$i]['Gender'];
      $U_dip_intra_cell_18                = $sti_lab[$i]['Urethra diplococci intra-cell'];
      $F_dip_intra_cell_24                = $sti_lab[$i]['Fornix diplococci intra-cell'];
      $E_cervix_dip_intra_cell_29         = $sti_lab[$i]['Endo cervix diplococci intra-cell'];
      $R_dip_intra_cell_34                = $sti_lab[$i]['Rectum diplococci intra-cell'];
      $U_dip_extra_cell_19                = $sti_lab[$i]['Urethra diplococci extra-cell'];
      $F_dip_extra_cell_25                = $sti_lab[$i]['Fornix diplococci extra-cell'];
      $E_cervix_dip_extra_cell_30         = $sti_lab[$i]['Endo cervix diplococci extra-cell'];
      $R_dip_extra_cell_35                = $sti_lab[$i]['Rectum diplococci extra-cell'];
      $Wet_Mount_Trichomonas_14           = $sti_lab[$i]['Wet Mount Trichomonas'];
      $Wet_Mount_candida_15               = $sti_lab[$i]['Wet Mount candida'];
      $Urethra_Candida_20                 = $sti_lab[$i]['Urethra Candida'];
      $Fornix_Candida_26                  = $sti_lab[$i]['Fornix Candida'];
      $Endo_cervix_Candida_31             = $sti_lab[$i]['Endo cervix Candida'];
      $Wet_Mount_clue_cell_13             = $sti_lab[$i]['Wet Mount clue cell'];
      $Fornix_Clue_Cells_22               = $sti_lab[$i]['Fornix Clue Cells'];
      $urethra_WBC_17                     = $sti_lab[$i]['urethra WBC'];
      $Fornix_WBC_23                      = $sti_lab[$i]['Fornix WBC'];
      $Endo_cervix_WBC_28                 = $sti_lab[$i]['	Endo cervix WBC'];
      $Rectum_WBC_33                      = $sti_lab[$i]['Rectum WBC'];
      if($gender=='Female'){ /////////////////////////////////// Female Section
        if($pid>1){
          $sti_female_test +=1;
          if($U_dip_intra_cell_18=='Yes' || $F_dip_intra_cell_24=='Yes' || $E_cervix_dip_intra_cell_29=='Yes' || $R_dip_intra_cell_34=='Yes'){
            $GC_IE_female +=1;
          }
          if($U_dip_extra_cell_19=='Yes' || $F_dip_extra_cell_25=='Yes' || $E_cervix_dip_extra_cell_30=='Yes' || $R_dip_extra_cell_35=='Yes'){
            $GC_Eonly_female +=1;
          }
          if($Wet_Mount_Trichomonas_14=='Yes' ){
            $TV_female +=1;
          }
          if($Wet_Mount_candida_15=='Yes' ||$Urethra_Candida_20=='Yes' ||$Fornix_Candida_26=='Yes' ||$Endo_cervix_Candida_31=='Yes' ){
            $Candida_female +=1;
          }
          if($Wet_Mount_clue_cell_13=='>20%' || $Fornix_Clue_Cells_22=='>20%' ){
            $clue_cell_female +=1;
          }
          if($urethra_WBC_17 =='20-25' || $urethra_WBC_17 =='>25'|| $Fornix_WBC_23=='20-25' || $Fornix_WBC_23=='>25' || $Endo_cervix_WBC_28=='20-25' || $Endo_cervix_WBC_28=='>25'){
             $pmnl_female += 1;
          }
        }
      }
      if($gender=='Male'){ //////////////////////////////////// Male Section
        if($pid>1){
          $sti_male_test +=1;
          if($U_dip_intra_cell_18=='Yes' || $R_dip_intra_cell_34=='Yes'){
            $GC_IE_male +=1;
          }
          if($U_dip_extra_cell_19=='Yes' || $R_dip_extra_cell_35=='Yes'){
            $GC_Eonly_male +=1;
          }
          if($Wet_Mount_Trichomonas_14=='Yes' ){
            $TV_male +=1;
          }
          if($Wet_Mount_candida_15=='Yes' || $Urethra_Candida_20=='Yes' ){
            $Candida_male +=1;
          }
          if($urethra_WBC_17 =='6-10'||$urethra_WBC_17 =='11-15'||$urethra_WBC_17 =='16-19'||$urethra_WBC_17 =='20-25' || $urethra_WBC_17 =='>25' ||
             $Rectum_WBC_33 =='6-10'|| $Rectum_WBC_33 =='11-15'|| $Rectum_WBC_33 =='16-19'|| $Rectum_WBC_33 =='20-25'|| $Rectum_WBC_33 =='>25'){
             $pmnl_male += 1;
          }
        }
      }

    }

    return response()->json([
      $test_namy,
      $sti_male_test,
      $sti_female_test,
      $GC_IE_male ,
      $GC_IE_female ,
      $GC_Eonly_male ,
      $GC_Eonly_female ,
      $TV_male ,
      $TV_female ,

      $clue_cell_female ,
      $pmnl_male ,
      $pmnl_female ,
    ]);
  }
  public function tb_sputum_calculator($date_from,$date_to){
    $test_namy='tb_afb';
    $afb_dia_pos =0;$afb_dia_neg =0;
    $afb_fol_pos =0;$afb_fol_neg =0;
    $afb_stool_pos =0;$afb_stool_neg =0;
    $afb_lymph_pos =0;$afb_lymph_neg =0;
    $afb_sssmear_pos =0;$afb_sssmear_neg =0;
    $afb_pleural_pos =0;$afb_pleural_neg =0;
    $afb_urine_pos =0;$afb_urine_neg =0;
    $afb_csf_pos =0;$afb_csf_neg =0;
    $tb_lam_neg =0;$tb_lam_pos =0;
    $afb_lab =LabAfbTest::whereBetween('visit_date', [$date_from, $date_to])->get();
    $oi_lab =Lab_oi::whereBetween('visit_date', [$date_from, $date_to])->get();
    for ($a=0; $a < count($oi_lab); $a++) {
      $tb_lam = $oi_lab[$a]['TB_LAM_Report'];
      if($tb_lam=='Negative'){
        $tb_lam_neg +=1;
      }
      if($tb_lam=='Positive'){
        $tb_lam_pos +=1;
      }
    }
    for ($i=0; $i < count($afb_lab); $i++) {
      $afb_Pt_type   = $afb_lab[$i]['afb_Pt_type'];
      $afb_result1 = $afb_lab[$i]['afb_result1'];
      $afb_result2 = $afb_lab[$i]['afb_result2'];
      $speci_type = $afb_lab[$i]['speci_type'];


      if($afb_Pt_type == 'Diagnosis'){
        if($afb_result1 =='Scanty' || $afb_result1 =='1+' || $afb_result1 =='2+' || $afb_result1 =='3+' ||
        $afb_result2 =='Scanty' || $afb_result2 =='1+' || $afb_result2 =='2+' || $afb_result2 =='3+'){
          $afb_dia_pos +=1;
        }
        if($afb_result1 =='Negative' && $afb_result2=='Negative'){
          $afb_dia_neg +=1;
        }
      }
      if($afb_Pt_type == 'Follow-up'){
        if($afb_result1 =='Scanty' || $afb_result1 =='1+' || $afb_result1 =='2+' || $afb_result1 =='3+' ||
        $afb_result2 =='Scanty' || $afb_result2 =='1+' || $afb_result2 =='2+' || $afb_result2 =='3+'){
          $afb_fol_pos +=1;
        }
        if($afb_result1 =='Negative' && $afb_result2=='Negative'){
          $afb_fol_neg +=1;
        }
      }

      /// have to ask again with ko kyaw soe
      if($speci_type=='Stool'){
        if($afb_result1 =='Scanty' || $afb_result1 =='1+' || $afb_result1 =='2+' || $afb_result1 =='3+' ||
        $afb_result2 =='Scanty' || $afb_result2 =='1+' || $afb_result2 =='2+' || $afb_result2 =='3+'){
          $afb_stool_pos +=1;
        }
        if($afb_result1 =='Negative' && $afb_result2=='Negative'){
          $afb_stool_neg +=1;
        }
      }
      if($speci_type=='Lymph node'){
        if($afb_result1 =='Scanty' || $afb_result1 =='1+' || $afb_result1 =='2+' || $afb_result1 =='3+' ||
        $afb_result2 =='Scanty' || $afb_result2 =='1+' || $afb_result2 =='2+' || $afb_result2 =='3+'){
          $afb_lymph_pos +=1;
        }
        if($afb_result1 =='Negative' && $afb_result2=='Negative'){
          $afb_lymph_neg +=1;
        }
      }
      if($speci_type=='SSSmear'){
        if($afb_result1 =='Scanty' || $afb_result1 =='1+' || $afb_result1 =='2+' || $afb_result1 =='3+' ||
        $afb_result2 =='Scanty' || $afb_result2 =='1+' || $afb_result2 =='2+' || $afb_result2 =='3+'){
          $afb_sssmear_pos +=1;
        }
        if($afb_result1 =='Negative' && $afb_result2=='Negative'){
          $afb_sssmear_neg +=1;
        }
      }
      if($speci_type=='Pleural aspiration'){
        if($afb_result1 =='Scanty' || $afb_result1 =='1+' || $afb_result1 =='2+' || $afb_result1 =='3+' ||
        $afb_result2 =='Scanty' || $afb_result2 =='1+' || $afb_result2 =='2+' || $afb_result2 =='3+'){
          $afb_pleural_pos +=1;
        }
        if($afb_result1 =='Negative' && $afb_result2=='Negative'){
          $afb_pleural_neg +=1;
        }
      }
      if($speci_type=='Urine'){
        if($afb_result1 =='Scanty' || $afb_result1 =='1+' || $afb_result1 =='2+' || $afb_result1 =='3+' ||
        $afb_result2 =='Scanty' || $afb_result2 =='1+' || $afb_result2 =='2+' || $afb_result2 =='3+'){
          $afb_urine_pos +=1;
        }
        if($afb_result1 =='Negative' && $afb_result2=='Negative'){
          $afb_urine_neg +=1;
        }
      }
      if($speci_type=='CSF'){
        if($afb_result1 =='Scanty' || $afb_result1 =='1+' || $afb_result1 =='2+' || $afb_result1 =='3+' ||
        $afb_result2 =='Scanty' || $afb_result2 =='1+' || $afb_result2 =='2+' || $afb_result2 =='3+'){
          $afb_csf_pos +=1;
        }
        if($afb_result1 =='Negative' && $afb_result2=='Negative'){
          $afb_csf_neg +=1;
        }
      }



    }
    // addition Section
    $afb_dia_total = $afb_dia_pos+$afb_dia_neg ;
    $afb_fol_total =   $afb_fol_pos+$afb_fol_neg;
    $lymph = $afb_lymph_pos +$afb_lymph_neg ;
    $sssmear = $afb_sssmear_pos +$afb_sssmear_neg ;
    $pleural = $afb_pleural_pos +$afb_pleural_neg ;
    $urine = $afb_urine_pos +$afb_urine_neg;
    $stool= $afb_stool_pos + $afb_stool_neg;
    $csf = $afb_csf_pos + $afb_csf_neg ;
    $tb_lam = $tb_lam_pos + $tb_lam_neg;
    return response()->json([
      $test_namy,
      $afb_dia_pos ,
      $afb_dia_neg ,
      $afb_fol_pos ,
      $afb_fol_neg,
      $afb_dia_total,
      $afb_fol_total,

      $lymph,
      $afb_lymph_pos ,
      $afb_lymph_neg ,
      $sssmear,
      $afb_sssmear_pos ,
      $afb_sssmear_neg ,
      $pleural,
      $afb_pleural_pos ,
      $afb_pleural_neg ,
      $urine,
      $afb_urine_pos ,
      $afb_urine_neg ,
      $stool,
      $afb_stool_pos ,
      $afb_stool_neg ,
      $csf,
      $afb_csf_pos ,
      $afb_csf_neg ,
      $tb_lam,
      $tb_lam_pos ,
      $tb_lam_neg ,

    ]);
  }
  public function dengue_calculator ($date_from,$date_to){
    $test_namy='dengue';
    $den_total_no=0;$den_ns_pos=0;$den_igg_pos=0;$den_igm_pos=0;
    $den_ns_igg_pos=0;$den_igg_igm_pos=0;$den_igm_ns_pos=0;
    $den_ns_igg_igm_pos =0;
    $dengue_lab =LabGeneralTest::whereBetween('visit_date', [$date_from, $date_to])->get();


    for ($i=0; $i < count($dengue_lab); $i++) {
      $dengue_RDT   = $dengue_lab[$i]['Dangue RDT'];
      $den_NS = $dengue_lab[$i]['NS1 Antigen'];
      $den_IgG = $dengue_lab[$i]['IgG Result'];
      $den_IgM = $dengue_lab[$i]['IgM Result'];

      if($dengue_RDT=='Done'){
        $den_total_no +=1;
        if($den_NS=='NS1Ag(+)'){
          $den_ns_pos +=1;
        }
        if($den_IgG=='IgG(+)'){
          $den_igg_pos +=1;
        }
        if($den_IgM=='IgM(+)'){
          $den_igm_pos +=1;
        }

        if($den_NS=='NS1Ag(+)' && $den_IgG=='IgG(+)'){
          $den_ns_igg_pos +=1;
        }
        if($den_IgG=='IgG(+)' && $den_IgM=='IgM(+)'){
          $den_igg_igm_pos +=1;
        }
        if($den_NS=='NS1Ag(+)' && $den_IgM=='IgM(+)'){
          $den_igm_ns_pos +=1;
        }

        if($den_NS=='NS1Ag(+)' && $den_IgG=='IgG(+)' && $den_IgM=='IgM(+)'){
          $den_ns_igg_igm_pos +=1;
        }


      }
      // Addition Section

    }

    return response()->json([
      $test_namy,
      $den_total_no,
      $den_ns_pos ,
      $den_igg_pos,
      $den_igm_pos,
      $den_ns_igg_pos ,
      $den_igm_ns_pos ,
      $den_igg_igm_pos ,
      $den_ns_igg_igm_pos ,


    ]);
  }
  public function malaria_calculator ($date_from,$date_to){
    $test_namy='malaria';
    $malaria_rdt_total=0;$mal_rdt_pf_pos=0;$mal_rdt_mix_pos=0;$mal_rdt_non_pf=0;
    $malaria_micro_total=0;$mal_micro_pf_pos =0;$mal_micro_mix_pos =0;$mal_micro_non_pf =0;
    $micro_rdt_pf_pos=0;$micro_rdt_mix_pos=0;$micro_rdt_non_pf=0;
    $micro_rdt_total =0;
    $malaria_lab =LabGeneralTest::whereBetween('visit_date', [$date_from, $date_to])->get();


    for ($i=0; $i < count($malaria_lab); $i++) {
      $malaria_RDT   = $malaria_lab[$i]['Malaria RDT Result'];
      $malaria_Micro = $malaria_lab[$i]['malaria_microscopy'];
      $mal_spec = $malaria_lab[$i]['Malaria_spec'];
      $mal_grade = $malaria_lab[$i]['Malaria_grade'];
      $mal_stage = $malaria_lab[$i]['Malaria_stage'];
      if($malaria_RDT != null){
        $malaria_rdt_total +=1;
        if($malaria_RDT=='Pf positive'){
          $mal_rdt_pf_pos +=1;
        }
        if($malaria_RDT=='Mix inf'){
          $mal_rdt_mix_pos +=1;
        }
        if($malaria_RDT=='Pv positive' ||$malaria_RDT=='Pan positive' ){
          $mal_rdt_non_pf +=1;
        }
      }
      if($malaria_Micro != null){
        $malaria_micro_total +=1;
        if($mal_spec=='Pf'){
          $mal_micro_pf_pos +=1;
        }
        if($mal_spec=='mix(pf+pv)' || $mal_spec=='mix(pf+pm)' || $mal_spec=='mix(pv+pm)' || $mal_spec=='mix(pf+po)' || $mal_spec=='mix(pv+po)'){
          $mal_micro_mix_pos +=1;
        }
        if($mal_spec=='Pv' || $mal_spec=='Pm' ||$mal_spec=='Po'){
          $mal_micro_non_pf +=1;
        }
      }
      if($malaria_RDT !=null && $malaria_Micro!=null){
        $micro_rdt_total +=1;
        if($malaria_RDT=='Pf positive' || $mal_spec=='Pf'){
          $micro_rdt_pf_pos +=1;
        }
        if($malaria_RDT=='Mix inf'|| $mal_spec=='mix(pf+pv)' || $mal_spec=='mix(pf+pm)' ||
        $mal_spec=='mix(pv+pm)' || $mal_spec=='mix(pf+po)' || $mal_spec=='mix(pv+po)'){
          $micro_rdt_mix_pos +=1;
        }
        if($malaria_RDT=='Pv positive' || $malaria_RDT=='Pan positive' || $mal_spec=='Pv' ||
        $mal_spec=='Pm' || $mal_spec=='Po'){
          $micro_rdt_non_pf +=1;
        }
      }

      }

    return response()->json([
      $test_namy,
      $malaria_rdt_total,
      $mal_rdt_pf_pos,
      $mal_rdt_mix_pos,
      $mal_rdt_non_pf,
      $mal_micro_pf_pos ,
      $mal_micro_mix_pos ,
      $mal_micro_non_pf ,
      $micro_rdt_pf_pos,
      $micro_rdt_mix_pos,
      $micro_rdt_non_pf,
      $malaria_micro_total,
      $micro_rdt_total ,

    ]);
    }
  public function oi_calculator ($date_from,$date_to){
    $test_namy='oi';
    $serum_cry_ag_pos =0;$serum_cry_ag_neg =0;$serum_cry_ag_total =0;
    $csf_cry_ag_pos =0;$csf_cry_ag_neg =0;$csf_cry_ag_total =0;
    $csf_stain_smear_neg =0;$csf_stain_smear_pos =0;$csf_stain_smear_total=0;
    $csf_india_ink_neg =0;$csf_india_ink_pos =0;$csf_india_ink_total=0;
    $skin_stain_smear_neg =0;$skin_stain_smear_pos =0;$skin_stain_smear_total=0;
    $skin_india_ink_neg =0;  $skin_india_ink_pos =0;$skin_india_ink_total=0;
    $lymph_stain_neg =0;$lymph_stain_pos =0;$lymph_india_ink_neg =0;$lymph_india_ink_pos =0;$lymph_total=0;
    $oi_lab =Lab_oi::whereBetween('visit_date', [$date_from, $date_to])->get();


    for ($i=0; $i < count($oi_lab); $i++) {
      $serum_cry_ag_test  = $oi_lab[$i]['Serum Result'];
      $csf_cry_ag_test  = $oi_lab[$i]['CSF for Cryptococcal Antigen'];
      $csf_stain_smear  = $oi_lab[$i]['CSF Smear Giemsa Stain'];
      $csf_india_ink  = $oi_lab[$i]['CSF Smear India Ink'];
      $skin_stain_smear  = $oi_lab[$i]['Skin Smear Giemsa Stain'];
      $skin_india_ink  = $oi_lab[$i]['Skin Smear India Ink'];
      $lymph_giemsa_stain = $oi_lab[$i]['lymph Giemsa Stain'];
      $lymph_india_ink = $oi_lab[$i]['lymph India Ink'];
      if($lymph_giemsa_stain != null){
        $lymph_gimesa_count = strlen($lymph_giemsa_stain);
      }else{
        $lymph_gimesa_count=0;
      }
      if($lymph_india_ink != null){
        $lymph_india_ink_count = strlen($lymph_india_ink);
      }else{
        $lymph_india_ink_count=0;
      }


      if($serum_cry_ag_test == 'Positive'){
        $serum_cry_ag_pos +=1;
      }
      if($serum_cry_ag_test == 'Negative'){
        $serum_cry_ag_neg +=1;
      }
      if($csf_cry_ag_test == 'Positive'){
        $csf_cry_ag_pos +=1;
      }
      if($csf_cry_ag_test == 'Negative'){
        $csf_cry_ag_neg +=1;
      }


      if($csf_stain_smear=='fungal not seen'){
        $csf_stain_smear_neg +=1;
      }
      if($csf_stain_smear=='Cryptococcus neoformans seen' || $csf_stain_smear=='Pencillium seen'){
        $csf_stain_smear_pos +=1;
      }
      if($csf_india_ink=='fungal not seen'){
        $csf_india_ink_neg +=1;
      }
      if($csf_india_ink=='Cryptococcus neoformans seen'|| $csf_india_ink=='Pencillium seen'){
        $csf_india_ink_pos +=1;
      }
      if($skin_stain_smear=='fungal not seen'){
        $skin_stain_smear_neg +=1;
      }
      if($skin_stain_smear=='Cryptococcus neoformans seen'|| $skin_stain_smear=='Pencillium seen'){
        $skin_stain_smear_pos +=1;
      }
      if($skin_india_ink=='fungal not seen'){
        $skin_india_ink_neg +=1;
      }
      if($skin_india_ink=='Cryptococcus neoformans seen'|| $skin_india_ink=='Pencillium seen'){
        $skin_india_ink_pos +=1;
      }

      if($lymph_giemsa_stain =='fungal not seen'){
        $lymph_stain_neg +=1;
      }
      if($lymph_giemsa_stain =='Cryptococcus neoformans seen'|| $lymph_giemsa_stain =='Pencillium seen' || $lymph_gimesa_count>2){
        $lymph_stain_pos +=1;
      }
      if($lymph_india_ink =='fungal not seen'){
        $lymph_india_ink_neg +=1;
      }
      if($lymph_india_ink =='Cryptococcus neoformans seen'|| $lymph_india_ink=='Pencillium seen' || $lymph_india_ink_count>2){
        $lymph_india_ink_pos +=1;
      }


          // Addition Section
        $serum_cry_ag_total =  $serum_cry_ag_pos + $serum_cry_ag_neg ;
        $csf_cry_ag_total   =  $csf_cry_ag_pos + $csf_cry_ag_neg;
        $csf_stain_india_total  = $csf_india_ink_pos  + $csf_stain_smear_pos;
        //$csf_india_ink_total  = $csf_india_ink_neg  + $csf_india_ink_pos;
        $skin_stain_india_total = $skin_india_ink_pos + $skin_stain_smear_pos;
        //$skin_india_ink_total = $skin_india_ink_neg + $skin_india_ink_pos;
        $lymph_total =  $lymph_stain_pos +  $lymph_india_ink_pos;

      }
        return response()->json([
          $test_namy,
          $serum_cry_ag_pos ,
          $serum_cry_ag_neg ,
          $serum_cry_ag_total ,
          $csf_cry_ag_pos ,
          $csf_cry_ag_neg ,
          $csf_cry_ag_total ,
          //$csf_stain_smear_neg ,
          $csf_stain_smear_pos ,
          //$csf_stain_smear_total,
          //$csf_india_ink_neg ,
          $csf_india_ink_pos ,
          //$csf_india_ink_total,
        //  $skin_stain_smear_neg ,
          $skin_stain_smear_pos ,
          //$skin_stain_smear_total,
        //  $skin_india_ink_neg ,
          $skin_india_ink_pos ,
          //$skin_india_ink_total,
          $csf_stain_india_total,
          $skin_stain_india_total,
          //$lymph_stain_neg ,
          $lymph_stain_pos ,
          //$lymph_india_ink_neg ,
          $lymph_india_ink_pos ,
          $lymph_total,

        ]);
      }
  public function general_test_calculator ($date_from,$date_to){
    $test_namy='general';

    $general_lab =LabGeneralTest::whereBetween('Visit_date', [$date_from, $date_to])->get();
    $urine_lab =Urine::whereBetween('visitDate', [$date_from, $date_to])->get();
    $oi_lab =Lab_oi::whereBetween('visit_date', [$date_from, $date_to])->get();
    $stool_lab =LabStoolTest::whereBetween('visit_date', [$date_from, $date_to])->get();

    $stool_re_done =0;
    for ($i=0; $i <count($stool_lab) ; $i++) {
      $stool_re   = $stool_lab[$i]['st_stool'];
      if($stool_re == '1'){
        $stool_re_done +=1;
      }
    }

    $toxo_plasma_count =0;$toxo_igG_count =0;$toxo_igM_count =0;$toxo_plasma_both=0;
    for ($i=0; $i < count($oi_lab) ; $i++) {
      $Toxo_plasma   = $oi_lab[$i]['Toxo plasma'];
      $Toxo_igG  = $oi_lab[$i]['Toxo igG'];
      $Toxo_igM = $oi_lab[$i]['Toxo igM'];
      if($Toxo_plasma == 'Done'){
        $toxo_plasma_count +=1;
      }
      if($Toxo_igG=='igG(+)' && $Toxo_igM == 'igM(+)' ){
        $toxo_plasma_both +=1;
      }else{
        if($Toxo_igG=='igG(+)'){
          $toxo_igG_count +=1;
        }else{
          if($Toxo_igM == 'igM(+)'){
            $toxo_igM_count +=1;
          }
        }


      }
    }

    $urine_Dip =0;$urine_RE =0;
    for ($i=0; $i < count($urine_lab); $i++) {
      $urineTypeofTest   = $urine_lab[$i]['Utot'];
      if($urineTypeofTest == 'D'){
        $urine_Dip +=1;
      }
      if($urineTypeofTest == 'RE'){
        $urine_RE +=1;
      }
    }

    $rbs_count =0;$fbs_count =0;$hb_percent =0;$hba1c_count =0;
    for ($i=0; $i < count($general_lab); $i++) {
      $RBS   = $general_lab[$i]['RBS'];
      $FBS   = $general_lab[$i]['FBS'];
      $haemoglobin   = $general_lab[$i]['haemoglobin'];
      $hba1c   = $general_lab[$i]['hba1c'];
      if(strlen($RBS)>1){
        $rbs_count +=1;
      }
      if(strlen($FBS)>1){
        $fbs_count +=1;
      }
      if(strlen($haemoglobin)>0){
        $hb_percent +=1;
      }
      if(strlen($hba1c)>0){
        $hba1c_count +=1;
      }
    }

    return response()->json([
      $test_namy,
      $urine_Dip,
      $urine_RE ,
      $stool_re_done ,
      $rbs_count ,
      $fbs_count ,
      $hb_percent ,
      $hba1c_count ,
      $toxo_plasma_count ,
      $toxo_igG_count ,
      $toxo_igM_count ,
      $toxo_plasma_both,
    ]);
  }

  public function export_view(){
    return view (
      'Labs.exports'
    );
  }
  // This is for exports
  public function show($x = '') {
     $path = explode('/', $x);
     // $path is an array with the directory structure
     // Do whatever you want with it e.g.
     if (empty($path)) {
         return $this->index();
     }
   }
  public function exports_files(Request $request)
  {
    $hiv_year = $request->input('year');
    //$hiv_year = $request->hiv_year;
    //$hiv_year =2021;
    //$hiv_year = 2021;
    return response()->json([
      $hiv_year,

    ]);
    //return Excel::download(new LabExport($hiv_year), 'HIV_lab_export.xlsx');
  }


  public function exports_files_rpr()
  {
    return Excel::download(new LabExport(2021), 'HIV_lab_export.xlsx');
  }
  public function exports_files_hepC()
  {
    //return Excel::download(new LabExport(2021), 'HIV_lab_export.xlsx');
  }


}

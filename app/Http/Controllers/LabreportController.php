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
  public function results()
  {
    return view(
      'Labs.results'
    );
  }
  public function reports(Request $request)
  {
    $testName       = $request->input('testName');
    $exportName = $request->input('exportName');
    $date_from      = $request->input('date_from');
    $date_to        = $request->input('date_to');
    $date_from = date($date_from);
    $date_to = date($date_to);
    switch ($testName) {
      case "hiv":
        return $this->hiv_calculator($date_from, $date_to);
        break;
      case "rpr":
        return $this->rpr_calculator($date_from, $date_to);
        break;
      case "hep_b_c":
        return $this->hep_calculator($date_from, $date_to);
        break;
      case "sti":
        return $this->sti_calculator($date_from, $date_to);
        break;
      case "sti_male":
        return $this->calculator($date_from, $date_to);
        break;
      case "tb_afb":
        return $this->tb_sputum_calculator($date_from, $date_to);
        break;
      case "dengue":
        return $this->dengue_calculator($date_from, $date_to);
        break;
      case "malaria":
        return $this->malaria_calculator($date_from, $date_to);
        break;
      case "oi":
        return $this->oi_calculator($date_from, $date_to);
        break;
      case "crypto_microscopy":
        return $this->crypto_microscopy_calculator($date_from, $date_to);
        break;
      case "pen_microscopy":
        return $this->pen_microscopy_calculator($date_from, $date_to);
        break;
      case "general":
        return $this->general_test_calculator($date_from, $date_to);
        break;

      default:
    }

    if ($exportName == 'hiv') {
      return $this->exports_hiv();
    }
  }
  public function hiv_calculator($date_from, $date_to)
  {
    $test_namy = 'hiv';
    $hiv_final_positive = 0;
    $hiv_final_negative = 0;
    $inconclusive_U_S = 0;
    $inconclusive_S_U = 0;
    $inconclusiveD_S_U = 0;
    $hiv_lab = Lab::whereBetween('vdate', [$date_from, $date_to])->get();
    $num = count($hiv_lab);


    $pos = Crypt::encrypt_light("Positive", "General");
    $neg = Crypt::encrypt_light("Negative", "General");

    $reactive = Crypt::encrypt_light("Reactive", "General");
    $non_rea = Crypt::encrypt_light("Non Reactive", "General");


    for ($i = 0; $i < count($hiv_lab); $i++) {
      $final_result_det   = $hiv_lab[$i]['Detmine_Result'];
      $final_result_uni   = $hiv_lab[$i]['Unigold_Result'];
      $final_result_stat  = $hiv_lab[$i]['STAT_PAK_Result'];
      $final_result       = $hiv_lab[$i]['Final_Result'];



      if ($final_result == $pos) {
        $hiv_final_positive += 1;
        $ff = $i + $i;
      }
      if ($final_result == $neg) {
        $hiv_final_negative += 1;
      }
      if ($final_result_det == $reactive && $final_result_uni == $reactive && $final_result_stat == $non_rea) {
        $inconclusive_U_S += 1;
      }
      if ($final_result_det == $reactive && $final_result_uni == $non_rea && $final_result_stat == $reactive) {
        $inconclusive_S_U += 1;
      }
      if ($final_result_det == $non_rea && $final_result_uni == $reactive && $final_result_stat == $reactive) {
        $inconclusiveD_S_U += 1;
      }
    }
    $success = [[
      "id" => 1,
      $hiv_final_positive => "The counted number is" . $num
    ]];

    return response()->json([
      $test_namy,
      $hiv_final_positive,
      $hiv_final_negative,
      $inconclusive_U_S,
      $inconclusive_S_U,

      $hiv_lab,
      $date_from, $date_to,

    ]);
  }
  public function rpr_calculator($date_from, $date_to)
  {
    $test_namy = 'rpr';
    $rpr_qualitative_male_R  = 0;
    $rpr_qualitative_male_NR = 0;
    $rpr_qualitative_female_R = 0;
    $rpr_qualitative_female_NR = 0;
    $RDT_positive_male = 0;
    $RDT_negative_male = 0;
    $RDT_positive_female = 0;
    $RDT_negative_female = 0;
    $rpr_lab = Rprtest::whereBetween('vdate', [$date_from, $date_to])->get();


    $pos = Crypt::encrypt_light("Positive", "General");
    $neg = Crypt::encrypt_light("Negative", "General");

    $reactive = Crypt::encrypt_light("Reactive", "General");
    $non_rea = Crypt::encrypt_light("Non Reactive", "General");

    $male = Crypt::encrypt_light("Male", "General");
    $female = Crypt::encrypt_light("Female", "General");



    for ($i = 0; $i < count($rpr_lab); $i++) {
      $rpr_qualitative   = $rpr_lab[$i]['RPR Qualitative'];
      $gender = $rpr_lab[$i]['Gender'];


      if ($gender == $male) { //////////////////////////////////// Male Section
        $RDT_result = $rpr_lab[$i]['RDT Result'];
        if ($rpr_qualitative == $reactive) {
          $rpr_qualitative_male_R += 1;
        } else if ($rpr_qualitative == $non_rea) {
          $rpr_qualitative_male_NR += 1;
        }

        if ($RDT_result == $pos) {
          $RDT_positive_male += 1;
        } else if ($RDT_result == $neg) {
          $RDT_negative_male += 1;
        }
      }
      if ($gender == $female) { /////////////////////////////////// Female Section
        $RDT_result = $rpr_lab[$i]['RDT Result'];
        if ($rpr_qualitative == $reactive) {
          $rpr_qualitative_female_R += 1;
        } else if ($rpr_qualitative == $non_rea) {
          $rpr_qualitative_female_NR += 1;
        }

        if ($RDT_result == $pos) {
          $RDT_positive_female += 1;
        } else if ($RDT_result == $neg) {
          $RDT_negative_female += 1;
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

  public function hep_calculator($date_from, $date_to)
  {
    $test_namy = 'hep';

    $hep_lab = LabHbcTest::whereBetween('vdate', [$date_from, $date_to])->get();

    $hbs_Ag_test_anc = 0;
    $hbs_Ag_test_fsw = 0;
    $hbs_Ag_test_msm = 0;
    $hbs_Ag_test_idu = 0;

    $hbs_Ag_test_pkp = 0;
    $hbs_Ag_test_cfsw = 0;
    $hbs_Ag_test_mp = 0;
    $hbs_Ag_test_ec = 0;
    $hbs_Ag_test_TB = 0;

    $hbs_Ag_test_lw = 0;
    $hep_B_pos_anc = 0;
    $hep_B_pos_fsw = 0;
    $hep_B_pos_msm = 0;

    $hep_B_pos_idu = 0;
    $hep_B_pos_pkp = 0;
    $hep_B_pos_cfsw = 0;
    $hep_B_pos_mp = 0;
    $hep_B_pos_TB = 0;

    $hep_B_pos_ec = 0;
    $hep_B_pos_lw = 0;
    $hcv_test_anc = 0;
    $hcv_C_pos_anc = 0;
    $hcv_test_fsw = 0;
    $hcv_C_pos_fsw = 0;
    $hcv_test_msm = 0;
    $hcv_C_pos_msm = 0;
    $hcv_test_idu = 0;
    $hcv_C_pos_idu = 0;
    $hcv_test_pkp = 0;
    $hcv_C_pos_pkp = 0;
    $hcv_test_cfsw = 0;
    $hcv_C_pos_cfsw = 0;
    $hcv_test_mp = 0;
    $hcv_C_pos_mp = 0;
    $hcv_test_ec = 0;
    $hcv_C_pos_ec = 0;
    $hcv_test_lw = 0;
    $hcv_C_pos_lw = 0;
    $hcv_test_TB = 0;
    $hcv_C_pos_TB = 0;
    $hbs_Ag_test_lw = 0;
    $special_gp = 0;

    $hbs_Ag_test_tg = 0;
    $hep_B_pos_tg = 0;
    $hbs_Ag_test_tg = 0;
    $hcv_test_tg = 0;
    $hcv_C_pos_tg = 0;
    $hcv_test_tg = 0;
    $hbs_Ag_test_other = 0;
    $hep_B_pos_other = 0;
    $hbs_Ag_test_other = 0;
    $hcv_test_other = 0;
    $hcv_C_pos_other = 0;
    $hcv_test_other = 0;

    $pos = Crypt::encrypt_light("Positive", "General");
    $neg = Crypt::encrypt_light("Negative", "General");

    $reactive = Crypt::encrypt_light("Reactive", "General");
    $non_rea = Crypt::encrypt_light("Non Reactive", "General");

    $male = Crypt::encrypt_light("Male", "General");
    $female = Crypt::encrypt_light("Female", "General");

    $ANC = Crypt::encrypt_light("Pregnant Mother", "General");
    $FSW = Crypt::encrypt_light("FSW", "General");
    $TG = Crypt::encrypt_light("TG", "General");
    $MSM = Crypt::encrypt_light("MSM", "General");
    $IDU = Crypt::encrypt_light("IDU", "General");
    $PWID = Crypt::encrypt_light("PWID", "General");
    $PKP = Crypt::encrypt_light("Partner of KP", "General");
    $CFSW = Crypt::encrypt_light("Client of FSW", "General");
    $migrant = Crypt::encrypt_light("Migrant Population", "General");
    $Exposed_child = Crypt::encrypt_light("Exposed Children", "General");
    $Low_risk = Crypt::encrypt_light("Low Risk", "General");
    $Special_gp = Crypt::encrypt_light("Special Groups", "General");
    $TB = Crypt::encrypt_light("TB Patient", "General");


    for ($i = 0; $i < count($hep_lab); $i++) {
      $hep_risk   = $hep_lab[$i]['Patient_Type'];
      $hep_sub_risk   = $hep_lab[$i]['Patient Type Sub'];
      $Hep_B_result = $hep_lab[$i]['HepB Result'];
      $Hep_C_result = $hep_lab[$i]['HepC Result'];

      $Main_risk_toCK = PtConfig::where('Pid', $hep_lab[$i]['CID'])->value('Main Risk');
      $Sub_risk_toCK = PtConfig::where('Pid', $hep_lab[$i]['CID'])->value('Sub Risk');




      if ($Main_risk_toCK == $ANC || $Sub_risk_toCK == $ANC) {
        if ($Hep_B_result == $pos) {
          $hbs_Ag_test_anc += 1;
          $hep_B_pos_anc += 1;
        }
        if ($Hep_B_result == $neg) {
          $hbs_Ag_test_anc += 1;
        }
        if ($Hep_C_result == $pos) {
          $hcv_test_anc += 1;
          $hcv_C_pos_anc += 1;
        }
        if ($Hep_C_result == $neg) {
          $hcv_test_anc += 1;
        }
      } else if ($Main_risk_toCK == $FSW || $Sub_risk_toCK == $FSW) {

        if ($Hep_B_result == $pos) {
          $hbs_Ag_test_fsw += 1;
          $hep_B_pos_fsw += 1;
        }
        if ($Hep_B_result == $neg) {
          $hbs_Ag_test_fsw += 1;
        }
        if ($Hep_C_result == $pos) {
          $hcv_test_fsw += 1;
          $hcv_C_pos_fsw += 1;
        }
        if ($Hep_C_result == $neg) {
          $hcv_test_fsw += 1;
        }
      } else if ($Main_risk_toCK == $MSM) {

        if ($Hep_B_result == $pos) {
          $hbs_Ag_test_msm += 1;
          $hep_B_pos_msm += 1;
        }
        if ($Hep_B_result == $neg) {
          $hbs_Ag_test_msm += 1;
        }
        if ($Hep_C_result == $pos) {
          $hcv_test_msm += 1;
          $hcv_C_pos_msm += 1;
        }
        if ($Hep_C_result == $neg) {
          $hcv_test_msm += 1;
        }
      } else if ($Main_risk_toCK == $TG) {

        if ($Hep_B_result == $pos) {
          $hbs_Ag_test_tg += 1;
          $hep_B_pos_tg += 1;
        }
        if ($Hep_B_result == $neg) {
          $hbs_Ag_test_tg += 1;
        }
        if ($Hep_C_result == $pos) {
          $hcv_test_tg += 1;
          $hcv_C_pos_tg += 1;
        }
        if ($Hep_C_result == $neg) {
          $hcv_test_tg += 1;
        }
      } else if ($Main_risk_toCK == $IDU || $Main_risk_toCK == $PWID || $Sub_risk_toCK == $IDU) {

        if ($Hep_B_result == $pos) {
          $hbs_Ag_test_idu += 1;
          $hep_B_pos_idu += 1;
        }
        if ($Hep_B_result == $neg) {
          $hbs_Ag_test_idu += 1;
        }
        if ($Hep_C_result == $pos) {
          $hcv_test_idu += 1;
          $hcv_C_pos_idu += 1;
        }
        if ($Hep_C_result == $neg) {
          $hcv_test_idu += 1;
        }
      } else if ($Main_risk_toCK == $PKP) {

        if ($Hep_B_result == $pos) {
          $hbs_Ag_test_pkp += 1;
          $hep_B_pos_pkp += 1;
        }
        if ($Hep_B_result == $neg) {
          $hbs_Ag_test_pkp += 1;
        }
        if ($Hep_C_result == $pos) {
          $hcv_test_pkp += 1;
          $hcv_C_pos_pkp += 1;
        }
        if ($Hep_C_result == $neg) {
          $hcv_test_pkp += 1;
        }
      } else if ($Main_risk_toCK == $CFSW || $Sub_risk_toCK == $CFSW) {

        if ($Hep_B_result == $pos) {
          $hbs_Ag_test_cfsw += 1;
          $hep_B_pos_cfsw += 1;
        }
        if ($Hep_B_result == $neg) {
          $hbs_Ag_test_cfsw += 1;
        }
        if ($Hep_C_result == $pos) {
          $hcv_test_cfsw += 1;
          $hcv_C_pos_cfsw += 1;
        }
        if ($Hep_C_result == $neg) {
          $hcv_test_cfsw += 1;
        }
      } else if ($Main_risk_toCK == $migrant || $Sub_risk_toCK == $migrant) {

        if ($Hep_B_result == $pos) {
          $hbs_Ag_test_mp += 1;
          $hep_B_pos_mp += 1;
        }
        if ($Hep_B_result == $neg) {
          $hbs_Ag_test_mp += 1;
        }
        if ($Hep_C_result == $pos) {
          $hcv_test_mp += 1;
          $hcv_C_pos_mp += 1;
        }
        if ($Hep_C_result == $neg) {
          $hcv_test_mp += 1;
        }
      } else if ($Main_risk_toCK == $Special_gp || $Main_risk_toCK == $TB || $Sub_risk_toCK == $TB) {

        if ($Hep_B_result == $pos) {
          $hbs_Ag_test_TB += 1;
          $hep_B_pos_TB += 1;
        }
        if ($Hep_B_result == $neg) {
          $hbs_Ag_test_TB += 1;
        }
        if ($Hep_C_result == $pos) {
          $hcv_test_TB += 1;
          $hcv_C_pos_TB += 1;
        }
        if ($Hep_C_result == $neg) {
          $hcv_test_TB += 1;
        }
      } else if ($Main_risk_toCK == $Exposed_child || $Sub_risk_toCK == $Exposed_child) {

        if ($Hep_B_result == $pos) {
          $hbs_Ag_test_ec += 1;
          $hep_B_pos_ec += 1;
        }
        if ($Hep_B_result == $neg) {
          $hbs_Ag_test_ec += 1;
        }
        if ($Hep_C_result == $pos) {
          $hcv_test_ec += 1;
          $hcv_C_pos_ec += 1;
        }
        if ($Hep_C_result == $neg) {
          $hcv_test_ec += 1;
        }
      } else if ($Main_risk_toCK == $Low_risk || $Sub_risk_toCK == $Low_risk) {

        if ($Hep_B_result == $pos) {
          $hbs_Ag_test_lw += 1;
          $hep_B_pos_lw += 1;
        }
        if ($Hep_B_result == $neg) {
          $hbs_Ag_test_lw += 1;
        }
        if ($Hep_C_result == $pos) {
          $hcv_test_lw += 1;
          $hcv_C_pos_lw += 1;
        }
        if ($Hep_C_result == $neg) {
          $hcv_test_lw += 1;
        }
      } else {
        if ($Hep_B_result == $pos) {
          $hbs_Ag_test_other += 1;
          $hep_B_pos_other += 1;
        }
        if ($Hep_B_result == $neg) {
          $hbs_Ag_test_other += 1;
        }
        if ($Hep_C_result == $pos) {
          $hcv_test_other += 1;
          $hcv_C_pos_other += 1;
        }
        if ($Hep_C_result == $neg) {
          $hcv_test_other += 1;
        }
      }
    }
    // Addition Section
    $hbs_test =
      $hbs_Ag_test_anc +
      $hbs_Ag_test_fsw +
      $hbs_Ag_test_msm +
      $hbs_Ag_test_tg +
      $hbs_Ag_test_idu +
      $hbs_Ag_test_pkp +
      $hbs_Ag_test_cfsw +
      $hbs_Ag_test_mp +
      $hbs_Ag_test_TB +
      $hbs_Ag_test_ec +
      $hbs_Ag_test_lw +
      $hbs_Ag_test_other;
    $hbs_b_positive =
      $hep_B_pos_anc +
      $hep_B_pos_fsw +
      $hep_B_pos_msm +
      $hep_B_pos_tg +
      $hep_B_pos_idu +
      $hep_B_pos_pkp +
      $hep_B_pos_cfsw +
      $hep_B_pos_mp +
      $hep_B_pos_TB +
      $hep_B_pos_ec +
      $hep_B_pos_lw +
      $hep_B_pos_other;
    $hcv_test =
      $hcv_test_anc +
      $hcv_test_fsw +
      $hcv_test_msm +
      $hcv_test_tg +
      $hcv_test_idu +
      $hcv_test_pkp +
      $hcv_test_cfsw +
      $hcv_test_mp +
      $hcv_test_TB +
      $hcv_test_ec +
      $hcv_test_lw +
      $hcv_test_other;
    $hcv_positive =
      $hcv_C_pos_anc +
      $hcv_C_pos_fsw +
      $hcv_C_pos_msm +
      $hcv_C_pos_tg +
      $hcv_C_pos_idu +
      $hcv_C_pos_pkp +
      $hcv_C_pos_cfsw +
      $hcv_C_pos_mp +
      $hcv_C_pos_TB +
      $hcv_C_pos_ec +
      $hcv_C_pos_lw +
      $hcv_C_pos_other;




    return response()->json([
      $test_namy,

      $hbs_Ag_test_anc,
      $hbs_Ag_test_fsw,
      $hbs_Ag_test_msm,
      $hbs_Ag_test_tg,
      $hbs_Ag_test_idu,
      $hbs_Ag_test_pkp,
      $hbs_Ag_test_cfsw,
      $hbs_Ag_test_mp,
      $hbs_Ag_test_ec,
      $hbs_Ag_test_TB,
      $hbs_Ag_test_lw, /////////////
      $hbs_Ag_test_other,
      $hbs_test,


      $hep_B_pos_anc,
      $hep_B_pos_fsw,
      $hep_B_pos_msm,
      $hep_B_pos_tg,
      $hep_B_pos_idu,
      $hep_B_pos_pkp,
      $hep_B_pos_cfsw,
      $hep_B_pos_mp,
      $hep_B_pos_ec,
      $hep_B_pos_TB,
      $hep_B_pos_lw,
      $hep_B_pos_other,
      $hbs_b_positive,

      $hcv_test_anc,
      $hcv_test_fsw,
      $hcv_test_msm,
      $hcv_test_tg,
      $hcv_test_idu,
      $hcv_test_pkp,
      $hcv_test_cfsw,
      $hcv_test_mp,
      $hcv_test_ec,
      $hcv_test_TB,
      $hcv_test_lw, ////////////////
      $hcv_test_other,
      $hcv_test,

      $hcv_C_pos_anc,
      $hcv_C_pos_fsw,
      $hcv_C_pos_msm,
      $hcv_C_pos_tg,
      $hcv_C_pos_idu,
      $hcv_C_pos_pkp,
      $hcv_C_pos_cfsw,
      $hcv_C_pos_mp,
      $hcv_C_pos_ec,
      $hcv_C_pos_TB,
      $hcv_C_pos_lw,
      $hcv_C_pos_other,
      $hcv_positive,



    ]);
  }
  public function sti_calculator($date_from, $date_to)
  {
    $test_namy = 'sti';

    $sti_female_test = 0;
    $GC_IE_female = 0;
    $GC_Eonly_female = 0;
    $TV_female = 0;
    $clue_cell_female = 0;
    $pmnl_female = 0;
    $sti_male_test = 0;
    $GC_IE_male = 0;
    $GC_Eonly_male = 0;
    $TV_male = 0;
    $Candida_male = 0;
    $pmnl_male = 0;

    $Candida_female = 0;
    $sti_lab = Labstitest::whereBetween('vdate', [$date_from, $date_to])->get();

    $yes = Crypt::encrypt_light("Yes", "General");
    $female = Crypt::encrypt_light("Female", "General");
    $male = Crypt::encrypt_light("Male", "General");

    $greater20 = Crypt::encrypt_light(">20%", "General");
    $twenty_25 = Crypt::encrypt_light("20-25", "General");
    $greater_25 = Crypt::encrypt_light(">25", "General");
    $six_10 = Crypt::encrypt_light("6-10", "General");
    $eleven_15 = Crypt::encrypt_light("11-15", "General");
    $sixteen_19 = Crypt::encrypt_light("16-19", "General");



    for ($i = 0; $i < count($sti_lab); $i++) {
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
      $Endo_cervix_WBC_28                 = $sti_lab[$i]['Endo cervix WBC'];
      $Rectum_WBC_33                      = $sti_lab[$i]['Rectum WBC'];
      if ($gender == $female) { /////////////////////////////////// Female Section
        if ($pid > 1) {
          $sti_female_test += 1;
          if ($U_dip_intra_cell_18 == $yes || $F_dip_intra_cell_24 == $yes || $E_cervix_dip_intra_cell_29 == $yes || $R_dip_intra_cell_34 == $yes) {
            $GC_IE_female += 1;
          } else if ($U_dip_extra_cell_19 == $yes || $F_dip_extra_cell_25 == $yes || $E_cervix_dip_extra_cell_30 == $yes || $R_dip_extra_cell_35 == $yes) {
            $GC_Eonly_female += 1;
          }



          if ($Wet_Mount_Trichomonas_14 == $yes) {
            $TV_female += 1;
          }
          if ($Wet_Mount_candida_15 == $yes || $Urethra_Candida_20 == $yes || $Fornix_Candida_26 == $yes || $Endo_cervix_Candida_31 == $yes) {
            $Candida_female += 1;
          }
          if ($Wet_Mount_clue_cell_13 == $greater20 || $Fornix_Clue_Cells_22 == $greater20) {
            $clue_cell_female += 1;
          }
          if ($urethra_WBC_17 == $twenty_25 || $urethra_WBC_17 == 6341513 || $Fornix_WBC_23 == $twenty_25 || $Fornix_WBC_23 == $greater_25 || $Endo_cervix_WBC_28 == $twenty_25 || $Endo_cervix_WBC_28 == $greater_25) {
            $pmnl_female += 1;
          }
        }
      }


      if ($gender == $male) { //////////////////////////////////// Male Section
        if ($pid > 1) {
          $sti_male_test += 1;
          if ($U_dip_intra_cell_18 == $yes || $R_dip_intra_cell_34 == $yes) {
            $GC_IE_male += 1;
          }
          if ($U_dip_extra_cell_19 == $yes || $R_dip_extra_cell_35 == $yes) {
            $GC_Eonly_male += 1;
          }
          if ($Wet_Mount_Trichomonas_14 == $yes) {
            $TV_male += 1;
          }
          if ($Wet_Mount_candida_15 == $yes || $Urethra_Candida_20 == $yes) {
            $Candida_male += 1;
          }
          if (
            $urethra_WBC_17 == $six_10 || $urethra_WBC_17 == $eleven_15 || $urethra_WBC_17 == $sixteen_19 || $urethra_WBC_17 == $twenty_25 || $urethra_WBC_17 == $greater_25 ||
            $Rectum_WBC_33 == $six_10 || $Rectum_WBC_33 == $eleven_15 || $Rectum_WBC_33 == $sixteen_19 || $Rectum_WBC_33 == $twenty_25 || $Rectum_WBC_33 == $greater_25
          ) {
            $pmnl_male += 1;
          }
        }
      }
    }

    return response()->json([
      $test_namy,
      $sti_male_test,
      $sti_female_test,
      $GC_IE_male,
      $GC_IE_female,
      $GC_Eonly_male,
      $GC_Eonly_female,
      $TV_male,
      $TV_female,


      $clue_cell_female,

      $pmnl_male,
      $pmnl_female, // 11 

      $Candida_female, //12
      $Candida_male, //13

    ]);
  }
  public function tb_sputum_calculator($date_from, $date_to)
  {
    $test_namy = 'tb_afb';
    $afb_dia_pos = 0;
    $afb_dia_neg = 0;
    $afb_fol_pos = 0;
    $afb_fol_neg = 0;
    $afb_stool_pos = 0;
    $afb_stool_neg = 0;
    $afb_lymph_pos = 0;
    $afb_lymph_neg = 0;
    $afb_sssmear_pos = 0;
    $afb_sssmear_neg = 0;
    $afb_pleural_pos = 0;
    $afb_pleural_neg = 0;
    $afb_urine_pos = 0;
    $afb_urine_neg = 0;
    $afb_csf_pos = 0;
    $afb_csf_neg = 0;
    $tb_lam_neg = 0;
    $tb_lam_pos = 0;

    $slideNum_1_count = 0;
    $slideNum_2_count = 0;
    $slideTotal = 0;
    $slOne = 0;
    $slTwo = 0;
    $slide_result_neg = 0;
    $slide_result_pos = 0;
    $slide_1_result = 0;
    $slide_2_result = 0;

    $slideNum_1_count_fup = 0;
    $slideNum_2_count_fup = 0;
    $slideTotal_fup = 0;
    $slOne_fup = 0;
    $slTwo_fup = 0;
    $slide_result_neg_fup = 0;
    $slide_result_pos_fup = 0;
    $slide_1_result_fup = 0;
    $slide_2_result_fup = 0;


    $afb_lab = LabAfbTest::whereBetween('vdate', [$date_from, $date_to])->get();
    $oi_lab = Lab_oi::whereBetween('vdate', [$date_from, $date_to])->get();

    $pos = Crypt::encrypt_light("Positive", "General");
    $neg = Crypt::encrypt_light("Negative", "General");

    $reactive = Crypt::encrypt_light("Reactive", "General");
    $non_rea = Crypt::encrypt_light("Non Reactive", "General");

    $male = Crypt::encrypt_light("Male", "General");
    $female = Crypt::encrypt_light("Female", "General");

    $Diagnosis = Crypt::encrypt_light("Diagnosis", "General");

    $Scanty = Crypt::encrypt_light("Scanty", "General");
    $one_plus = Crypt::encrypt_light("1+", "General");
    $two_plus = Crypt::encrypt_light("2+", "General");
    $three_plus = Crypt::encrypt_light("3+", "General");

    $follow_up = Crypt::encrypt_light("Follow-up", "General");

    $Sputum = Crypt::encrypt_light("Sputum", "General");

    $stool = Crypt::encrypt_light("Stool", "General");
    $lymph_node = Crypt::encrypt_light("Lymph_node", "General");
    $sssmear = Crypt::encrypt_light("SSS", "General");
    $Pleural_aspiration = Crypt::encrypt_light("Pleural aspiration", "General");
    $Urine = Crypt::encrypt_light("Urine", "General");
    $csf = Crypt::encrypt_light("CSF", "General");

    $slideNum1 = Crypt::encrypt_light("slide_num_1", "General");
    $slideNum2 = Crypt::encrypt_light("slide_num_2", "General");


    for ($a = 0; $a < count($oi_lab); $a++) {
      $tb_lam = $oi_lab[$a]['TB_LAM_Report'];
      if ($tb_lam == $neg) {
        $tb_lam_neg += 1;
      }
      if ($tb_lam == $pos) {
        $tb_lam_pos += 1;
      }
    }

    for ($i = 0; $i < count($afb_lab); $i++) {
      $afb_Pt_type   = $afb_lab[$i]['afb_Pt_type'];
      $afb_result1 = $afb_lab[$i]['afb_result1'];
      $afb_result2 = $afb_lab[$i]['afb_result2'];
      $speci_type = $afb_lab[$i]['speci_type'];

      $slOne = Crypt::decrypt_light($afb_lab[$i]['slide_num_1'], "General");
      $slTwo = Crypt::decrypt_light($afb_lab[$i]['slide_num_2'], "General");

      $slide_1_result = $afb_lab[$i]['afb_result1'];
      $slide_2_result = $afb_lab[$i]['afb_result2'];


      if ($afb_Pt_type == $Diagnosis && $speci_type == $Sputum) {
        if (
          $afb_result1 == $Scanty || $afb_result1 == $one_plus || $afb_result1 == $two_plus || $afb_result1 == $three_plus ||
          $afb_result2 == $Scanty || $afb_result2 == $one_plus || $afb_result2 == $two_plus || $afb_result2 == $three_plus
        ) {
          $afb_dia_pos += 1;
        } else if ($afb_result1 == $neg || $afb_result2 == $neg) {
          $afb_dia_neg += 1;
        }

        // This is to find AFB sputum slides total
        if ($slOne > 0) {
          $slideNum_1_count += 1;
        }
        if ($slTwo > 0) {
          $slideNum_2_count += 1;
        }
        // Slide Pos all
        if ($slide_1_result == "37324659708682328" && $slide_2_result == "37324659708682328") {
          $slide_result_neg  += 2;
        } else if ($slide_1_result == "37324659708682328" || $slide_2_result == "37324659708682328") {
          $slide_result_neg  += 1;
        }

        if (strlen($slide_1_result) < 16  && strlen($slide_1_result) > 3) {
          $slide_result_pos  += 1;
        }
        if (strlen($slide_2_result) < 16  && strlen($slide_2_result) > 3) {
          $slide_result_pos  += 1;
        }
      }
      if ($afb_Pt_type == $follow_up && $speci_type == $Sputum) {
        if (
          $afb_result1 == $Scanty || $afb_result1 == $one_plus || $afb_result1 == $two_plus || $afb_result1 == $three_plus ||
          $afb_result2 == $Scanty || $afb_result2 == $one_plus || $afb_result2 == $two_plus || $afb_result2 == $three_plus
        ) {
          $afb_fol_pos += 1;
        } else if ($afb_result1 == $neg || $afb_result2 == $neg) {
          $afb_fol_neg += 1;
        }

        // This is to find AFB sputum slides total
        if ($slOne > 0) {
          $slideNum_1_count_fup += 1;
        }
        if ($slTwo > 0) {
          $slideNum_2_count_fup += 1;
        }

        // Slide Pos all
        if ($slide_1_result == "37324659708682328" && $slide_2_result == "37324659708682328") {
          $slide_result_neg_fup  += 2;
        } else if ($slide_1_result == "37324659708682328" || $slide_2_result == "37324659708682328") {
          $slide_result_neg_fup  += 1;
        }

        if (strlen($slide_1_result) < 16  && strlen($slide_1_result) > 3) {
          $slide_result_pos_fup  += 1;
        }
        if (strlen($slide_2_result) < 16  && strlen($slide_2_result) > 3) {
          $slide_result_pos_fup  += 1;
        }
      }


      /// have to ask again with ko kyaw soe
      if ($speci_type == $stool) {
        if (
          $afb_result1 == $Scanty || $afb_result1 == $one_plus || $afb_result1 == $two_plus || $afb_result1 == $three_plus ||
          $afb_result2 == $Scanty || $afb_result2 == $one_plus || $afb_result2 == $two_plus || $afb_result2 == $three_plus
        ) {
          $afb_stool_pos += 1;
        } else if ($afb_result1 == $neg || $afb_result2 == $neg) {
          $afb_stool_neg += 1;
        }
      }
      if ($speci_type == $lymph_node) {
        if (
          $afb_result1 == $Scanty || $afb_result1 == $one_plus || $afb_result1 == $two_plus || $afb_result1 == $three_plus ||
          $afb_result2 == $Scanty || $afb_result2 == $one_plus || $afb_result2 == $two_plus || $afb_result2 == $three_plus
        ) {
          $afb_lymph_pos += 1;
        } else if ($afb_result1 == $neg || $afb_result2 == $neg) {
          $afb_lymph_neg += 1;
        }
      }
      if ($speci_type == $sssmear) {
        if (
          $afb_result1 == $Scanty || $afb_result1 == $one_plus || $afb_result1 == $two_plus || $afb_result1 == $three_plus ||
          $afb_result2 == $Scanty || $afb_result2 == $one_plus || $afb_result2 == $two_plus || $afb_result2 == $three_plus
        ) {
          $afb_sssmear_pos += 1;
        } else if ($afb_result1 == $neg || $afb_result2 == $neg) {
          $afb_sssmear_neg += 1;
        }
      }
      if ($speci_type == $Pleural_aspiration) {
        if (
          $afb_result1 == $Scanty || $afb_result1 == $one_plus || $afb_result1 == $two_plus || $afb_result1 == $three_plus ||
          $afb_result2 == $Scanty || $afb_result2 == $one_plus || $afb_result2 == $two_plus || $afb_result2 == $three_plus
        ) {
          $afb_pleural_pos += 1;
        } else if ($afb_result1 == $neg || $afb_result2 == $neg) {
          $afb_pleural_neg += 1;
        }
      }
      if ($speci_type == $Urine) {
        if (
          $afb_result1 == $Scanty || $afb_result1 == $one_plus || $afb_result1 == $two_plus || $afb_result1 == $three_plus ||
          $afb_result2 == $Scanty || $afb_result2 == $one_plus || $afb_result2 == $two_plus || $afb_result2 == $three_plus
        ) {
          $afb_urine_pos += 1;
        } else if ($afb_result1 == $neg || $afb_result2 == $neg) {
          $afb_urine_neg += 1;
        }
      }
      if ($speci_type == $csf) {
        if (
          $afb_result1 == $Scanty || $afb_result1 == $one_plus || $afb_result1 == $two_plus || $afb_result1 == $three_plus ||
          $afb_result2 == $Scanty || $afb_result2 == $one_plus || $afb_result2 == $two_plus || $afb_result2 == $three_plus
        ) {
          $afb_csf_pos += 1;
        } else if ($afb_result1 == $neg || $afb_result2 == $neg) {
          $afb_csf_neg += 1;
        }
      }
    }
    // addition Section
    $afb_dia_total = $afb_dia_pos + $afb_dia_neg;
    $afb_fol_total =   $afb_fol_pos + $afb_fol_neg;
    $lymph = $afb_lymph_pos + $afb_lymph_neg;
    $sssmear = $afb_sssmear_pos + $afb_sssmear_neg;
    $pleural = $afb_pleural_pos + $afb_pleural_neg;
    $urine = $afb_urine_pos + $afb_urine_neg;
    $stool = $afb_stool_pos + $afb_stool_neg;
    $csf = $afb_csf_pos + $afb_csf_neg;
    $tb_lam = $tb_lam_pos + $tb_lam_neg;

    $slideTotal = $slideNum_1_count + $slideNum_2_count;
    $slideTotal_fup = $slideNum_1_count_fup + $slideNum_2_count_fup;

    return response()->json([
      $test_namy,
      $afb_dia_pos,
      $afb_dia_neg,
      $afb_fol_pos,
      $afb_fol_neg,
      $afb_dia_total,
      $afb_fol_total,
      $lymph,
      $afb_lymph_pos,
      $afb_lymph_neg,
      $sssmear,
      $afb_sssmear_pos,
      $afb_sssmear_neg,
      $pleural,
      $afb_pleural_pos,
      $afb_pleural_neg,
      $urine,
      $afb_urine_pos,
      $afb_urine_neg,
      $stool,
      $afb_stool_pos,
      $afb_stool_neg,
      $csf,
      $afb_csf_pos,
      $afb_csf_neg,
      $tb_lam,
      $tb_lam_pos,
      $tb_lam_neg,

      $slideTotal, // 28
      $slide_result_pos, //29
      $slide_result_neg, //30

      $slideTotal_fup, // 31
      $slide_result_pos_fup, //32
      $slide_result_neg_fup, //33



    ]);
  }
  public function dengue_calculator($date_from, $date_to)
  {
    $test_namy = 'dengue';
    $den_total_no = 0;
    $den_ns_pos = 0;
    $den_igg_pos = 0;
    $den_igm_pos = 0;
    $den_ns_igg_pos = 0;
    $den_igg_igm_pos = 0;
    $den_igm_ns_pos = 0;
    $den_ns_igg_igm_pos = 0;
    $dengue_lab = LabGeneralTest::whereBetween('vdate', [$date_from, $date_to])->get();

    $done = Crypt::encrypt_light("Done", "General");
    $ns1ag_pos = Crypt::encrypt_light("NS1Ag(+)", "General");

    $IgG_pos = Crypt::encrypt_light("IgG(+)", "General");
    $IgM_pos = Crypt::encrypt_light("IgM(+)", "General");

    $male = Crypt::encrypt_light("Male", "General");
    $female = Crypt::encrypt_light("Female", "General");

    for ($i = 0; $i < count($dengue_lab); $i++) {
      $dengue_RDT   = $dengue_lab[$i]['Dangue RDT'];
      $den_NS = $dengue_lab[$i]['NS1 Antigen'];
      $den_IgG = $dengue_lab[$i]['IgG Result'];
      $den_IgM = $dengue_lab[$i]['IgM Result'];

      if ($dengue_RDT == 211) {
        $den_total_no += 1;
        if ($den_NS == $ns1ag_pos) {
          $den_ns_pos += 1;
        }
        if ($den_IgG == $IgG_pos) {
          $den_igg_pos += 1;
        }
        if ($den_IgM == $IgM_pos) {
          $den_igm_pos += 1;
        }

        if ($den_NS == $ns1ag_pos && $den_IgG == $IgG_pos) {
          $den_ns_igg_pos += 1;
        }
        if ($den_IgG == $IgG_pos && $den_IgM == $IgM_pos) {
          $den_igg_igm_pos += 1;
        }
        if ($den_NS == $ns1ag_pos && $den_IgM == $IgM_pos) {
          $den_igm_ns_pos += 1;
        }

        if ($den_NS == $ns1ag_pos && $den_IgG == $IgG_pos && $den_IgM == $IgM_pos) {
          $den_ns_igg_igm_pos += 1;
        }
      }
      // Addition Section

    }

    return response()->json([
      $test_namy,
      $den_total_no,
      $den_ns_pos,
      $den_igg_pos,
      $den_igm_pos,
      $den_ns_igg_pos,
      $den_igm_ns_pos,
      $den_igg_igm_pos,
      $den_ns_igg_igm_pos,


    ]);
  }
  public function malaria_calculator($date_from, $date_to)
  {
    $test_namy = 'malaria';
    $malaria_rdt_total = 0;
    $mal_rdt_pf_pos = 0;
    $mal_rdt_mix_pos = 0;
    $mal_rdt_non_pf = 0;
    $malaria_micro_total = 0;
    $mal_micro_pf_pos = 0;
    $mal_micro_mix_pos = 0;
    $mal_micro_non_pf = 0;
    $micro_rdt_pf_pos = 0;
    $micro_rdt_mix_pos = 0;
    $micro_rdt_non_pf = 0;
    $micro_rdt_total = 0;
    $malaria_lab = LabGeneralTest::whereBetween('vdate', [$date_from, $date_to])->get();

    $Pf_positive = Crypt::encrypt_light("Pf positive", "General");
    $Mix_inf = Crypt::encrypt_light("Mix inf", "General");

    $Pv_positive = Crypt::encrypt_light("Pv positive", "General");
    $Pan_positive = Crypt::encrypt_light("Pan positive", "General");

    $Pf = Crypt::encrypt_light("Pf", "General");
    $mix_pf_pv = Crypt::encrypt_light("mix(pf+pv)", "General");
    $mix_pf_pm = Crypt::encrypt_light("mix(pf+pm)", "General");
    $mix_pv_pm = Crypt::encrypt_light("mix(pv+pm)", "General");
    $mix_pf_pv = Crypt::encrypt_light("mix(pf+pv)", "General");
    $mix_pf_po = Crypt::encrypt_light("mix(pf+po)", "General");
    $mix_pv_po = Crypt::encrypt_light("mix(pv+po)", "General");

    $Pv = Crypt::encrypt_light("Pv", "General");
    $Pm = Crypt::encrypt_light("Pm", "General");
    $Po = Crypt::encrypt_light("Po", "General");


    for ($i = 0; $i < count($malaria_lab); $i++) {
      $malaria_RDT   = $malaria_lab[$i]['Malaria RDT Result'];
      $malaria_Micro = $malaria_lab[$i]['malaria_microscopy'];
      $mal_spec = $malaria_lab[$i]['Malaria_spec'];
      $mal_grade = $malaria_lab[$i]['Malaria_grade'];
      $mal_stage = $malaria_lab[$i]['Malaria_stage'];
      if ($malaria_RDT != null && $malaria_Micro != null && $malaria_RDT  != "731" && $malaria_Micro != "731") {
        $micro_rdt_total += 1;
        if ($malaria_RDT == $Pf_positive || $mal_spec == $Pf) {
          $micro_rdt_pf_pos += 1;
        }
        if (
          $malaria_RDT == $Mix_inf || $mal_spec == $mix_pf_pv || $mal_spec == $mix_pf_pm ||
          $mal_spec == $mix_pv_pm || $mal_spec == $mix_pf_po || $mal_spec == $mix_pv_po
        ) {
          $micro_rdt_mix_pos += 1;
        }
        if (
          $malaria_RDT == $Pv_positive || $malaria_RDT == $Pan_positive || $mal_spec == $Pv ||
          $mal_spec == $Pm || $mal_spec == $Po
        ) {
          $micro_rdt_non_pf += 1;
        }
      } else if ($malaria_RDT != null && $malaria_RDT  != "731") {
        $malaria_rdt_total += 1;
        if ($malaria_RDT == $Pf_positive) {
          $mal_rdt_pf_pos += 1;
        }
        if ($malaria_RDT == $Mix_inf) {
          $mal_rdt_mix_pos += 1;
        }
        if ($malaria_RDT == $Pv_positive || $malaria_RDT == $Pan_positive) {
          $mal_rdt_non_pf += 1;
        }
      } else if ($malaria_Micro != null && $malaria_Micro != "731") {
        $malaria_micro_total += 1;
        if ($mal_spec == $Pf) {
          $mal_micro_pf_pos += 1;
        }
        if ($mal_spec == $mix_pf_pv || $mal_spec == $mix_pf_pm || $mal_spec == $mix_pv_pm || $mal_spec == $mix_pf_po || $mal_spec == $mix_pv_po) {
          $mal_micro_mix_pos += 1;
        }
        if ($mal_spec == $Pv || $mal_spec == $Pm || $mal_spec == $Po) {
          $mal_micro_non_pf += 1;
        }
      }
    }

    return response()->json([
      $test_namy,
      $malaria_rdt_total,
      $mal_rdt_pf_pos,
      $mal_rdt_mix_pos,
      $mal_rdt_non_pf,
      $mal_micro_pf_pos,
      $mal_micro_mix_pos,
      $mal_micro_non_pf,
      $micro_rdt_pf_pos,
      $micro_rdt_mix_pos,
      $micro_rdt_non_pf,
      $malaria_micro_total,
      $micro_rdt_total,

    ]);
  }
  public function oi_calculator($date_from, $date_to)
  {
    $test_namy = 'oi';
    $serum_cry_ag_pos = 0;
    $serum_cry_ag_neg = 0;
    $serum_cry_ag_total = 0;
    $csf_cry_ag_pos = 0;
    $csf_cry_ag_neg = 0;
    $csf_cry_ag_total = 0;
    $csf_stain_smear_neg = 0;
    $csf_stain_smear_pos = 0;
    $csf_stain_smear_total = 0;
    $csf_stain_india_total  = 0;
    $csf_india_ink_neg = 0;
    $csf_india_ink_pos = 0;
    $csf_india_ink_total = 0;
    $skin_stain_smear_neg = 0;
    $skin_stain_smear_pos = 0;
    $skin_stain_smear_total = 0;
    $skin_stain_india_total = 0;
    $skin_india_ink_neg = 0;
    $skin_india_ink_pos = 0;
    $skin_india_ink_total = 0;
    $lymph_stain_neg = 0;
    $lymph_stain_pos = 0;
    $lymph_india_ink_neg = 0;
    $lymph_india_ink_pos = 0;
    $lymph_total = 0;









    $oi_lab = Lab_oi::whereBetween('vdate', [$date_from, $date_to])->get();

    $pos = Crypt::encrypt_light("Positive", "General");
    $neg = Crypt::encrypt_light("Negative", "General");

    $fungal_not_seen = Crypt::encrypt_light("Fungal not seen", "General");
    $Cryptococcus_neoformans_seen = Crypt::encrypt_light("Crypto: neoformans seen", "General");
    $Pencillium_seen = Crypt::encrypt_light("Pen: marneffei seen", "General");

    $Gram = Crypt::encrypt_light("Gram", "General");
    $Giemsa = Crypt::encrypt_light("Giemsa", "General");

    for ($i = 0; $i < count($oi_lab); $i++) {
      $serum_cry_ag_test  = $oi_lab[$i]['Serum Result'];
      $csf_cry_ag_test  = $oi_lab[$i]['CSF for Cryptococcal Antigen'];

      $csf_fungal_total  = $oi_lab[$i]['csf_fungal'];
      $csf_stain_smear  = $oi_lab[$i]['CSF Smear Giemsa Stain'];
      $csf_india_ink  = $oi_lab[$i]['CSF Smear India Ink'];

      $skin_fungal_total  = $oi_lab[$i]['skin_fungal'];
      $skin_stain_smear  = $oi_lab[$i]['Skin Smear Giemsa Stain'];
      $skin_india_ink  = $oi_lab[$i]['Skin Smear India Ink'];

      $lymph_giemsa_stain = $oi_lab[$i]['lymph Giemsa Stain'];
      $lymph_india_ink = $oi_lab[$i]['lymph India Ink'];


      if ($lymph_giemsa_stain != null) {
        $lymph_gimesa_count = strlen($lymph_giemsa_stain);
      } else {
        $lymph_gimesa_count = 0;
      }
      if ($lymph_india_ink != null) {
        $lymph_india_ink_count = strlen($lymph_india_ink);
      } else {
        $lymph_india_ink_count = 0;
      }


      if ($serum_cry_ag_test == $pos) {
        $serum_cry_ag_pos += 1;
      }
      if ($serum_cry_ag_test == $neg) {
        $serum_cry_ag_neg += 1;
      }
      if ($csf_cry_ag_test == $pos) {
        $csf_cry_ag_pos += 1;
      }
      if ($csf_cry_ag_test == $neg) {
        $csf_cry_ag_neg += 1;
      }





      if ($csf_fungal_total == $Gram) {
        $csf_stain_smear_total += 1;
      } else if ($csf_fungal_total == $Giemsa) {
        $csf_stain_smear_total += 1;
      }

      if ($csf_stain_smear == $fungal_not_seen) {
        $csf_stain_smear_neg += 1;
      }
      if ($csf_stain_smear == $Cryptococcus_neoformans_seen || $csf_stain_smear == $Pencillium_seen) {
        $csf_stain_smear_pos += 1;
      }
      if ($csf_india_ink == $fungal_not_seen) {
        $csf_india_ink_neg += 1;
      }
      if ($csf_india_ink == $Cryptococcus_neoformans_seen || $csf_india_ink == $Pencillium_seen) {
        $csf_india_ink_pos += 1;
      }



      if ($skin_fungal_total == $Giemsa) {
        $skin_stain_india_total += 1;
      } else if ($skin_fungal_total == $Gram) {
        $skin_stain_india_total += 1;
      }


      if ($skin_stain_smear == $fungal_not_seen) {
        $skin_stain_smear_neg += 1;
      }
      if ($skin_stain_smear == $Cryptococcus_neoformans_seen || $skin_stain_smear == $Pencillium_seen) {
        $skin_stain_smear_pos += 1;
      }
      if ($skin_india_ink == $fungal_not_seen) {
        $skin_india_ink_neg += 1;
      }
      if ($skin_india_ink == $Cryptococcus_neoformans_seen || $skin_india_ink == $Pencillium_seen) {
        $skin_india_ink_pos += 1;
      }





      if ($lymph_giemsa_stain == $fungal_not_seen) {
        $lymph_stain_neg += 1;
      }
      if ($lymph_giemsa_stain == $Cryptococcus_neoformans_seen || $lymph_giemsa_stain == $Pencillium_seen || $lymph_gimesa_count > 2) {
        $lymph_stain_pos += 1;
      }
      if ($lymph_india_ink == $fungal_not_seen) {
        $lymph_india_ink_neg += 1;
      }
      if ($lymph_india_ink == $Cryptococcus_neoformans_seen || $lymph_india_ink == $Pencillium_seen || $lymph_india_ink_count > 2) {
        $lymph_india_ink_pos += 1;
      }


      // Addition Section
      $serum_cry_ag_total =  $serum_cry_ag_pos + $serum_cry_ag_neg;
      $csf_cry_ag_total   =  $csf_cry_ag_pos + $csf_cry_ag_neg;

      //$csf_stain_smear_total  = $csf_india_ink_pos  + $csf_stain_smear_pos;

      //$skin_stain_india_total = $skin_india_ink_pos + $skin_stain_smear_pos;

      $lymph_total =  $lymph_stain_pos +  $lymph_india_ink_pos;
    }
    return response()->json([
      $test_namy,
      $serum_cry_ag_pos,
      $serum_cry_ag_neg,
      $serum_cry_ag_total,

      $csf_cry_ag_pos,
      $csf_cry_ag_neg,
      $csf_cry_ag_total,

      //   //$csf_stain_smear_neg ,
      //   $csf_stain_smear_pos ,
      //   //$csf_stain_smear_total,
      //   //$csf_india_ink_neg ,
      //   $csf_india_ink_pos ,
      //   //$csf_india_ink_total,
      // //  $skin_stain_smear_neg ,
      //   $skin_stain_smear_pos ,
      //   //$skin_stain_smear_total,
      // //  $skin_india_ink_neg ,
      //   $skin_india_ink_pos ,
      //   //$skin_india_ink_total,
      //   $csf_stain_india_total,
      //   $skin_stain_india_total,
      //   //$lymph_stain_neg ,
      //   $lymph_stain_pos ,
      //   //$lymph_india_ink_neg ,
      //   $lymph_india_ink_pos ,
      //   $lymph_total,


      //7
      $csf_stain_smear_total,
      $csf_india_ink_pos,
      $csf_stain_smear_pos,

      //10
      $csf_stain_india_total,
      $skin_india_ink_pos,
      $skin_stain_smear_pos,

      //13
      $lymph_total,
      $lymph_stain_pos,
      $lymph_india_ink_pos,


    ]);
  }
  public function general_test_calculator($date_from, $date_to)
  {
    $test_namy = 'general';

    $general_lab = LabGeneralTest::whereBetween('vdate', [$date_from, $date_to])->get();
    $urine_lab = Urine::whereBetween('visitDate', [$date_from, $date_to])->get();
    $oi_lab = Lab_oi::whereBetween('vdate', [$date_from, $date_to])->get();
    $stool_lab = LabStoolTest::whereBetween('vdate', [$date_from, $date_to])->get();

    $stool_re_done = 0;


    $one = Crypt::encrypt_light("1", "General");
    $Done = Crypt::encrypt_light("Done", "General");
    $igG_pos = Crypt::encrypt_light("igG(+)", "General");
    $igM_pos = Crypt::encrypt_light("igM(+)", "General");

    $D = Crypt::encrypt_light("Dipstick", "General");
    $RE = Crypt::encrypt_light("RE", "General");


    for ($i = 0; $i < count($stool_lab); $i++) {
      $stool_re   = $stool_lab[$i]['st_stool'];
      if ($stool_re == $one) {
        $stool_re_done += 1;
      }
    }

    $toxo_plasma_count = 0;
    $toxo_igG_count = 0;
    $toxo_igM_count = 0;
    $toxo_plasma_both = 0;
    for ($i = 0; $i < count($oi_lab); $i++) {
      $Toxo_plasma   = $oi_lab[$i]['Toxo plasma'];
      $Toxo_igG  = $oi_lab[$i]['Toxo igG'];
      $Toxo_igM = $oi_lab[$i]['Toxo igM'];

      if ($Toxo_plasma == $Done) {
        $toxo_plasma_count += 1;
      }
      if ($Toxo_igG == $igG_pos && $Toxo_igM == $igM_pos) {
        $toxo_plasma_both += 1;
      } else {
        if ($Toxo_igG == $igG_pos) {
          $toxo_igG_count += 1;
        } else {
          if ($Toxo_igM == $igM_pos) {
            $toxo_igM_count += 1;
          }
        }
      }
    }

    $urine_Dip = 0;
    $urine_RE = 0;
    for ($i = 0; $i < count($urine_lab); $i++) {
      $urineTypeofTest   = $urine_lab[$i]['Utot'];
      if ($urineTypeofTest == $D) {
        $urine_Dip += 1;
      }
      if ($urineTypeofTest == $RE) {
        $urine_RE += 1;
      }
    }

    $rbs_count = 0;
    $fbs_count = 0;
    $hb_percent = 0;
    $hba1c_count = 0;
    $RBS=null;
    for ($i = 0; $i < count($general_lab); $i++) {
      $RBS   = Crypt::decrypt_light($general_lab[$i]['RBS'], "General");
      $FBS   = Crypt::decrypt_light($general_lab[$i]['FBS'], "General");
      $haemoglobin   = Crypt::decrypt_light($general_lab[$i]['haemoglobin'], "General");
      $hba1c   = Crypt::decrypt_light($general_lab[$i]['hba1c'], "General");
      if ($RBS != null) {
        if ($RBS > 1) {
          $rbs_count += 1;
        }
      }
      if ($FBS != null) {
        if ($FBS > 1) {
          $fbs_count += 1;
        }
      }
      if ($haemoglobin != null) {
        if ($haemoglobin > 0) {
          $hb_percent += 1;
        }
      }
      if ($hba1c != null) {
        if ($hba1c > 0) {
          $hba1c_count += 1;
        }
      }
    }

    return response()->json([
      $test_namy,
      $urine_Dip,
      $urine_RE,
      $stool_re_done,
      $rbs_count,
      $fbs_count,
      $hb_percent,
      $hba1c_count,
      $toxo_plasma_count,
      $toxo_igG_count,
      $toxo_igM_count,
      $toxo_plasma_both,
    ]);
  }
  public function export_view()
  {
    return view(
      'Labs.exports'
    );
  }
  // This is for exports
  public function show($x = '')
  {
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
  // public function exports_files_rpr()
  // {
  //   return Excel::download(new LabExport(2021), 'HIV_lab_export.xlsx');
  // }
  // public function exports_files_hepC()
  // {
  //   //return Excel::download(new LabExport(2021), 'HIV_lab_export.xlsx');
  // }
}

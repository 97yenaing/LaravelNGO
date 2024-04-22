<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Followup_general;
use App\Models\PtConfig;
use App\Models\Patients;
use App\Models\DailyConsultationreport;
use Maatwebsite\Excel\Facades\Excel;

use App\Exports\DailyconsultreportExport;
use App\Exports\DailyconsultExport;

use DateTime;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;

class ConsultationController extends Controller
{
  public function report_view()
  {
    $parseData = [];
    // return view('Reception.report');

    return view(
      'Reception.report',
      ['parseData' => $parseData]
    );
  }

  public function report_cal(Request $request)
  {
    $calculator = $request->input('calculate');

    $from = $request->input('d_from');
    $to = $request->input('d_to');

    // Convert 'dd-mm-yyyy' to 'yyyy-mm-dd'
    $fromDate = DateTime::createFromFormat('d-m-Y', $from);
    $toDate = DateTime::createFromFormat('d-m-Y', $to);

    // Format the dates in 'yyyy-mm-dd'
    $from = $fromDate->format('Y-m-d');
    $to = $toDate->format('Y-m-d');
    if ($calculator == 1) {
      return $this->dataDrawer($from, $to);
    }
  }
  //database dbx_query
  public function dataDrawer($from, $to)
  {
    $fever_count_data = 0;

    $pha_new = 0;
    $art_new = 0;
    $prep_new = 0;
    $pmtct_new = 0;
    $anc_new = 0;
    $fp_new = 0;
    $feed_new = 0;
    $gen_new = 0;
    $pha_old = 0;
    $art_old = 0;
    $prep_old = 0;
    $pmtct_old = 0;
    $anc_old = 0;
    $fp_old = 0;
    $feed_old = 0;
    $gen_old = 0;

    $pha_check_new = 0;
    $art_check_new = 0;
    $prep_check_new = 0;
    $pmtct_check_new = 0;
    $anc_check_new = 0;
    $fp_check_new = 0;
    $feed_check_new = 0;
    $gen_check_new = 0;
    $pha_check_old = 0;
    $art_check_old = 0;
    $prep_check_old = 0;
    $pmtct_check_old = 0;
    $anc_check_old = 0;
    $fp_check_old = 0;
    $feed_check_old = 0;
    $gen_check_old = 0;

    $pha_check_new_u = 0;
    $art_check_new_u = 0;
    $prep_check_new_u = 0;
    $pmtct_check_new_u = 0;
    $anc_check_new_u = 0;
    $fp_check_new_u = 0;
    $feed_check_new_u = 0;
    $gen_check_new_u = 0;
    $pha_check_old_u = 0;
    $art_check_old_u = 0;
    $prep_check_old_u = 0;
    $pmtct_check_old_u = 0;
    $anc_check_old_u = 0;
    $fp_check_old_u = 0;
    $feed_check_old_u = 0;
    $gen_check_old_u = 0;

    $pha_cohort_Yes = 0;
    $pha_cohort_No = 0;
    $art_cohort_Yes = 0;
    $art_cohort_No = 0;

    $ugen_NCD_CVD_new = 0;
    $ogen_NCD_CVD_new = 0;
    $ugen_NCD_CVD_old = 0;
    $ogen_NCD_CVD_old = 0;
    $ugen_HT_only_new = 0;
    $ogen_HT_only_new = 0;
    $ugen_HT_only_old = 0;
    $ogen_HT_only_old = 0;
    $ugen_DM_only_new = 0;
    $ogen_DM_only_new = 0;
    $ugen_DM_only_old = 0;
    $ogen_DM_only_old = 0;
    $ugen_HT_DM_como_new = 0;
    $ogen_HT_DM_como_new = 0;
    $ugen_HT_DM_como_old = 0;
    $ogen_HT_DM_como_old = 0;
    $ugen_RTI_Less2wk_new = 0;
    $ogen_RTI_Less2wk_new = 0;
    $ugen_RTI_Less2wk_old = 0;
    $ogen_RTI_Less2wk_old = 0;
    $ugen_RTI_Great2wk_new = 0;
    $ogen_RTI_Great2wk_new = 0;
    $ugen_RTI_Great2wk_old = 0;
    $ogen_RTI_Great2wk_old = 0;
    $ugen_HIV_TB_new = 0;
    $ogen_HIV_TB_new = 0;
    $ugen_HIV_TB_old = 0;
    $ogen_HIV_TB_old = 0;
    $ugen_TB_relate_new = 0;
    $ogen_TB_relate_new = 0;
    $ugen_TB_relate_old = 0;
    $ogen_TB_relate_old = 0;
    $ugen_Covid_relate_new = 0;
    $ogen_Covid_relate_new = 0;
    $ugen_Covid_relate_old = 0;
    $ogen_Covid_relate_old = 0;
    $ugen_Obstructive_pul_new = 0;
    $ogen_Obstructive_pul_new = 0;
    $ugen_Obstructive_pul_old = 0;
    $ogen_Obstructive_pul_old = 0;
    $ugen_Renal_new = 0;
    $ogen_Renal_new = 0;
    $ugen_Renal_old = 0;
    $ogen_Renal_old = 0;
    $ugen_GI_Hep_new = 0;
    $ogen_GI_Hep_new = 0;
    $ugen_GI_Hep_old = 0;
    $ogen_GI_Hep_old = 0;
    $ugen_Gynaecology_new = 0;
    $ogen_Gynaecology_new = 0;
    $ugen_Gynaecology_old = 0;
    $ogen_Gynaecology_old = 0;
    $ugen_Muscul_rheuma_new = 0;
    $ogen_Muscul_rheuma_new = 0;
    $ugen_Muscul_rheuma_old = 0;
    $ogen_Muscul_rheuma_old = 0;
    $ugen_STI_new = 0;
    $ogen_STI_new = 0;
    $ugen_STI_old = 0;
    $ogen_STI_old = 0;
    $ugen_skin_infect_new = 0;
    $ogen_skin_infect_new = 0;
    $ugen_skin_infect_old = 0;
    $ogen_skin_infect_old = 0;
    $ugen_sex_violence_new = 0;
    $ogen_sex_violence_new = 0;
    $ugen_sex_violence_old = 0;
    $ogen_sex_violence_old = 0;

    $ugen_child_abuse_new = 0;
    $ogen_child_abuse_new = 0;
    $ugen_child_abuse_old = 0;
    $ogen_child_abuse_old = 0;
    $ugen_malnourish_new = 0;
    $ogen_malnourish_new = 0;
    $ugen_malnourish_old = 0;
    $ogen_malnourish_old = 0;
    $ugen_dengue_fever_new = 0;
    $ogen_dengue_fever_new = 0;
    $ugen_dengue_fever_old = 0;
    $ogen_dengue_fever_old = 0;

    $ugen_others_new = 0;
    $ogen_others_new = 0;
    $ugen_others_old = 0;
    $ogen_others_old = 0;

    $fsw = 0;
    $msm = 0;
    $tg = 0;
    $pwid = 0;
    $non_kp = 0;

    $less_15_diagnosis_null_blank = 0;
    $great_15_diagnosis_null_blank = 0;

    $General_Diag_new_u15 = 0;
    $General_Diag_new_o15 = 0;
    $General_Diag_old_u15 = 0;
    $General_Diag_new_o15 = 0;

    $lab_inv_only_new_u = 0;
    $lab_inv_only_old_u = 0;
    $lab_inv_only_new = 0;
    $lab_inv_only_old = 0;

    //for daily count
    $PHA_count_daily = 0;

    //attendence
    $sti_check_boo = [];
    $oneVisit = [];
    $diagnosisArray = [];
    $diagnosisArray_daily = [];
    $diagnosis_dataonly = [
      'phacheck', 'pha_new_old', 'pha_cohort',
      'artcheck', 'art_new_old', 'art_cohort',
      'prepcheck', 'prep_new_old',
      'pmtctcheck', 'pmtct_new_old',
      'anccheck', 'anc_new_old',
      'fmaplancheck', 'famaplan_new_old',
      'gneralcheck', 'general_new_old', 'general_diagnosis', 'OPD',
      'ncdcheck', 'ncd_new_old', 'ncd_diagnosis', 'ncd_drugSupply',
      'hivTBcheck', 'hivTB_new_old',
      'fcentercheck', 'feedcentre_new_old',
      'labInvestcheck', 'labInvest_new_old',
    ];



    $data = Followup_general::whereBetween('Visit Date', [$from, $to])->get();
    // Pluck the 'Visit Date' column and use unique to get unique dates
    $uniqueDates = $data->pluck('Visit Date')->unique()->values()->toArray();
    // Sort the unique dates array
    sort($uniqueDates);
    //   // Initialize an array to store the results

    $PHA = 0;
    $PHA_new = 0;
    $PHA_old = 0;
    $PHA_total = 0;
    $ART = 0;
    $ART_new = 0;
    $ART_old = 0;
    $ART_total = 0;
    $PrEP = 0;
    $PrEP_new = 0;
    $PrEP_old = 0;
    $PrEP_total = 0;
    $ANC = 0;
    $ANC_new = 0;
    $ANC_old = 0;
    $ANC_total = 0;
    $FP = 0;
    $FP_new = 0;
    $FP_old = 0;
    $FP_total = 0;
    $PMTCT = 0;
    $PMTCT_new = 0;
    $PMTCT_old = 0;
    $PMTCT_total = 0;
    $Feedcenter = 0;
    $Feedcenter_new = 0;
    $Feedcenter_old = 0;
    $Feedcenter_total = 0;
    $General = 0;
    $General_new = 0;
    $General_old = 0;
    $General_total = 0;
    $Hypertension_only = 0;
    $Hypertension_only_new = 0;
    $Hypertension_only_old = 0;
    $Hypertension_only_total = 0;
    $DM_only = 0;
    $DM_only_new = 0;
    $DM_only_old = 0;
    $DM_only_total = 0;
    $HT_DM_como = 0;
    $HT_DM_como_new = 0;
    $HT_DM_como_old = 0;
    $HT_DM_como_total = 0;
    $NCD_CVD = 0;
    $NCD_CVD_new = 0;
    $NCD_CVD_old = 0;
    $NCD_CVD_total = 0;
    $hivNegTB = 0;
    $hivNegTB_new = 0;
    $hivNegTB_old = 0;
    $hivNegTB_total = 0;
    $RTI_less_2wk = 0;
    $RTI_less_2wk_new = 0;
    $RTI_less_2wk_old = 0;
    $RTI_less_2wk_total = 0;
    $RTI_great_2wk = 0;
    $RTI_great_2wk_new = 0;
    $RTI_great_2wk_old = 0;
    $RTI_great_2wk_total = 0;
    $TB_relate = 0;
    $TB_relate_new = 0;
    $TB_relate_old = 0;
    $TB_relate_total = 0;
    $covid_relate = 0;
    $covid_relate_new = 0;
    $covid_relate_old = 0;
    $covid_relate_total = 0;
    $obstrctive = 0;
    $obstrctive_new = 0;
    $obstrctive_old = 0;
    $obstrctive_total = 0;
    $Renal_ds = 0;
    $Renal_ds_new = 0;
    $Renal_ds_old = 0;
    $Renal_ds_total = 0;
    $GI_Hepato = 0;
    $GI_Hepato_new = 0;
    $GI_Hepato_old = 0;
    $GI_Hepato_total = 0;
    $Gynaecology = 0;
    $Gynaecology_new = 0;
    $Gynaecology_old = 0;
    $Gynaecology_total = 0;
    $Musculo_and_rheumatology = 0;
    $Musculo_and_rheumatology_new = 0;
    $Musculo_and_rheumatology_old = 0;
    $Musculo_and_rheumatology_total = 0;
    $STI = 0;
    $STI_new = 0;
    $STI_old = 0;
    $STI_total = 0;
    $Skin_inf = 0;
    $Skin_inf_new = 0;
    $Skin_inf_old = 0;
    $Skin_inf_total = 0;
    $Sexual_violence = 0;
    $Sexual_violence_new = 0;
    $Sexual_violence_old = 0;
    $Sexual_violence_total = 0;
    $child_abuse = 0;
    $child_abuse_new = 0;
    $child_abuse_old = 0;
    $child_abuse_total = 0;
    $malnourished = 0;
    $malnourished_new = 0;
    $malnourished_old = 0;
    $malnourished_total = 0;
    $Dengue_fever = 0;
    $Dengue_fever_new = 0;
    $Dengue_fever_old = 0;
    $Dengue_fever_total = 0;
    $other = 0;
    $other_new = 0;
    $other_old = 0;
    $other_total = 0;
    $lab_iv_ck = 0;
    $lab_iv_ck_new = 0;
    $lab_iv_ck_old = 0;
    $lab_iv_ck_total = 0;

    // Loop through each row of the data
    $value_by_date = [];
    foreach ($uniqueDates as $index => $Datevalue) {

      foreach ($data as $inde => $row) {
        $counting = 0;
        $visitDate = $row->{'Visit Date'};

        if ($visitDate == $Datevalue) {
          $pt_Diagnosis = $row["Pateint_Diagnosis"];
          if ($pt_Diagnosis != "731" && $pt_Diagnosis != null && $pt_Diagnosis != "") {
            $diagnosis_cut = explode("/", $pt_Diagnosis); // spliting array return type is array
            for ($i = 0; $i < 11; $i++) {
              $diagnosis_name = explode("-", $diagnosis_cut[$i]);
              for ($j = 0; $j < count($diagnosis_name); $j++) {
                if (Str::contains($diagnosis_name[$j], '\\')) {
                  $trimmed_diagnosis = trim($diagnosis_name[$j], "\\"); // Remove backslashes
                  $diagnosis_final[$diagnosis_dataonly[$counting]] = Crypt::decrypt_light($trimmed_diagnosis, "General"); //decrpting all diagnosis and adding new object array
                  if ($diagnosis_final[$diagnosis_dataonly[$counting]] == "false") {
                    $diagnosis_final[$diagnosis_dataonly[$counting]] = "-";
                  }
                  if ($i == 6 && count($diagnosis_name) == 3 && $j == 2) {
                    $counting += 2;
                  } else {

                    $counting++;
                  }
                } else {
                  $diagnosis_final[$diagnosis_dataonly[$counting]] = Crypt::decrypt_light($diagnosis_name[$j], "General"); //decrpting all diagnosis and adding new object array
                  if ($diagnosis_final[$diagnosis_dataonly[$counting]] == "false") {
                    $diagnosis_final[$diagnosis_dataonly[$counting]] = "-";
                  }
                  if ($i == 6 && count($diagnosis_name) == 3 && $j == 2) {
                    $counting += 2;
                  } else {
                    $counting++;
                  }
                }
              }
            }
            if ($diagnosis_final["phacheck"] == "phacheck") {
              $PHA += 1;
              if ($diagnosis_final["pha_new_old"] == "New") {
                $PHA_new += 1;
              } else if ($diagnosis_final["pha_new_old"] == "Old") {
                $PHA_old += 1;
              }
            }
            if ($diagnosis_final["artcheck"] == "artcheck") {
              $ART += 1;
              if ($diagnosis_final["art_new_old"] == "New") {
                $ART_new += 1;
              } else if ($diagnosis_final["art_new_old"] == "Old") {
                $ART_old += 1;
              }
            }
            if ($diagnosis_final["prepcheck"] == "prepcheck") {
              $PrEP += 1;
              if ($diagnosis_final["prep_new_old"] == "New") {
                $PrEP_new += 1;
              } else if ($diagnosis_final["prep_new_old"] == "Old") {
                $PrEP_old += 1;
              }
            }
            if ($diagnosis_final["pmtctcheck"] == "pmtctcheck") {
              $PMTCT += 1;
              if ($diagnosis_final["pmtct_new_old"] == "New") {
                $PMTCT_new += 1;
              } else if ($diagnosis_final["pmtct_new_old"] == "Old") {
                $PMTCT_old += 1;
              }
            }

            if ($diagnosis_final["anccheck"] == "anccheck") {
              $ANC += 1;
              if ($diagnosis_final["anc_new_old"] == "New") {
                $ANC_new += 1;
              } else if ($diagnosis_final["anc_new_old"] == "Old") {
                $ANC_old += 1;
              }
            }
            if ($diagnosis_final["fmaplancheck"] == "fmaplancheck") {
              $FP += 1;
              if ($diagnosis_final["famaplan_new_old"] == "New") {
                $FP_new += 1;
              } else if ($diagnosis_final["famaplan_new_old"] == "Old") {
                $FP_old += 1;
              }
            }
            if ($diagnosis_final["fcentercheck"] == "fcentercheck") {
              $Feedcenter += 1;
              if ($diagnosis_final["feedcentre_new_old"] == "New") {
                $Feedcenter_new += 1;
              } else if ($diagnosis_final["feedcentre_new_old"] == "Old") {
                $Feedcenter_old += 1;
              }
            }
            if ($diagnosis_final["gneralcheck"] == "gneralcheck") {
              $General += 1;
              if ($diagnosis_final["general_new_old"] == "New") {
                $General_new += 1;
              } else if ($diagnosis_final["general_new_old"] == "Old") {
                $General_old += 1;
              }
            }
            if ($diagnosis_final["ncd_diagnosis"] == "Hypertension") {
              $Hypertension_only += 1;
              if ($diagnosis_final["ncd_new_old"] == "New") {
                $Hypertension_only_new += 1;
              } else if ($diagnosis_final["ncd_new_old"] == "Old") {
                $Hypertension_only_old += 1;
              }
            }
            if ($diagnosis_final["ncd_diagnosis"] == "Diabetes") {
              $DM_only += 1;
              if ($diagnosis_final["ncd_new_old"] == "New") {
                $DM_only_new += 1;
              } else if ($diagnosis_final["ncd_new_old"] == "Old") {
                $DM_only_old += 1;
              }
            }
            if ($diagnosis_final["ncd_diagnosis"] == "HT-DM-commodities") {
              $HT_DM_como += 1;
              if ($diagnosis_final["ncd_new_old"] == "New") {
                $HT_DM_como_new += 1;
              } else if ($diagnosis_final["ncd_new_old"] == "Old") {
                $HT_DM_como_old += 1;
              }
            }

            // To count daily data 
            // $diagnosis_dataonly=['phacheck','pha_new_old','pha_cohort',
            //       'artcheck','art_new_old','art_cohort',
            //   'prepcheck','prep_new_old',
            //   'pmtctcheck','pmtct_new_old',
            //   'anccheck','anc_new_old',
            //   'fmaplancheck','famaplan_new_old',
            //   'gneralcheck','general_new_old','general_diagnosis',
            //   'ncdcheck','ncd_new_old','ncd_diagnosis','ncd_drugSupply',
            //   'hivTBcheck','hivTB_new_old',
            //   'fcentercheck','feedcentre_new_old',
            //   'labInvestcheck','labInvest_new_old',];


            // RTI<2wks , RTI>=2 ,  ObstructiveDs , NCD-CVD , RenalDs , GI-Hepato , Gynaecology , Musculo-rheumatology, 
            // SkinInfect,  Covid-consul  , TB-consul ,  Sexual-viol , STI , Others , 14

            //  "RTI<2wks","RTI>=2","ObstructiveDs","Dengue-Fever",
            // "RenalDs","GI-Hepato","Malnouri","Child-Abuse",
            // "SkinInfect","Covid-consul","TB-consul","Others", 12

            if ($diagnosis_final["general_diagnosis"] == "NCD-CVD") {
              $NCD_CVD += 1;
              if ($diagnosis_final["general_new_old"] == "New") {
                $NCD_CVD_new += 1;
              } else if ($diagnosis_final["general_new_old"] == "Old") {
                $NCD_CVD_old += 1;
              }
            }
            if ($diagnosis_final["hivTBcheck"] == "hivTBcheck") {
              $hivNegTB += 1;
              if ($diagnosis_final["hivTB_new_old"] == "New") {
                $hivNegTB_new += 1;
              } else if ($diagnosis_final["hivTB_new_old"] == "Old") {
                $hivNegTB_old += 1;
              }
            }
            if ($diagnosis_final["general_diagnosis"] == "RTI<2wks") {
              $RTI_less_2wk += 1;
              if ($diagnosis_final["general_new_old"] == "New") {
                $RTI_less_2wk_new += 1;
              } else if ($diagnosis_final["general_new_old"] == "Old") {
                $RTI_less_2wk_old += 1;
              }
            }
            if ($diagnosis_final["general_diagnosis"] == "RTI>=2") {
              $RTI_great_2wk += 1;
              if ($diagnosis_final["general_new_old"] == "New") {
                $RTI_great_2wk_new += 1;
              } else if ($diagnosis_final["general_new_old"] == "Old") {
                $RTI_great_2wk_old += 1;
              }
            }
            if ($diagnosis_final["general_diagnosis"] == "TB-consul") {
              $TB_relate += 1;
              if ($diagnosis_final["general_new_old"] == "New") {
                $TB_relate_new += 1;
              } else if ($diagnosis_final["general_new_old"] == "Old") {
                $TB_relate_old += 1;
              }
            }
            if ($diagnosis_final["general_diagnosis"] == "Covid-consul") {
              $covid_relate += 1;
              if ($diagnosis_final["general_new_old"] == "New") {
                $covid_relate_new += 1;
              } else if ($diagnosis_final["general_new_old"] == "Old") {
                $covid_relate_old += 1;
              }
            }
            if ($diagnosis_final["general_diagnosis"] == "ObstructiveDs") {
              $obstrctive += 1;
              if ($diagnosis_final["general_new_old"] == "New") {
                $obstrctive_new += 1;
              } else if ($diagnosis_final["general_new_old"] == "Old") {
                $obstrctive_old += 1;
              }
            }
            if ($diagnosis_final["general_diagnosis"] == "RenalDs") {
              $Renal_ds += 1;
              if ($diagnosis_final["general_new_old"] == "New") {
                $Renal_ds_new += 1;
              } else if ($diagnosis_final["general_new_old"] == "Old") {
                $Renal_ds_old += 1;
              }
            }
            if ($diagnosis_final["general_diagnosis"] == "GI-Hepato") {
              $GI_Hepato += 1;
              if ($diagnosis_final["general_new_old"] == "New") {
                $GI_Hepato_new += 1;
              } else if ($diagnosis_final["general_new_old"] == "Old") {
                $GI_Hepato_old += 1;
              }
            }
            if ($diagnosis_final["general_diagnosis"] == "Gynaecology") {
              $Gynaecology += 1;
              if ($diagnosis_final["general_new_old"] == "New") {
                $Gynaecology_new += 1;
              } else if ($diagnosis_final["general_new_old"] == "Old") {
                $Gynaecology_old += 1;
              }
            }
            if ($diagnosis_final["general_diagnosis"] == "Musculo-rheumatology") {
              $Musculo_and_rheumatology += 1;
              if ($diagnosis_final["general_new_old"] == "New") {
                $Musculo_and_rheumatology_new += 1;
              } else if ($diagnosis_final["general_new_old"] == "Old") {
                $Musculo_and_rheumatology_old += 1;
              }
            }
            if ($diagnosis_final["general_diagnosis"] == "STI") {
              $STI += 1;
              if ($diagnosis_final["general_new_old"] == "New") {
                $STI_new += 1;
              } else if ($diagnosis_final["general_new_old"] == "Old") {
                $STI_old += 1;
              }
            }
            if ($diagnosis_final["general_diagnosis"] == "SkinInfect") {
              $Skin_inf += 1;
              if ($diagnosis_final["general_new_old"] == "New") {
                $Skin_inf_new += 1;
              } else if ($diagnosis_final["general_new_old"] == "Old") {
                $Skin_inf_old += 1;
              }
            }
            if ($diagnosis_final["general_diagnosis"] == "Sexual-viol") {
              $Sexual_violence += 1;
              if ($diagnosis_final["general_new_old"] == "New") {
                $Sexual_violence_new += 1;
              } else if ($diagnosis_final["general_new_old"] == "Old") {
                $Sexual_violence_old += 1;
              }
            }
            if ($diagnosis_final["general_diagnosis"] == "Child-Abuse") {
              $child_abuse += 1;
              if ($diagnosis_final["general_new_old"] == "New") {
                $child_abuse_new += 1;
              } else if ($diagnosis_final["general_new_old"] == "Old") {
                $child_abuse_old += 1;
              }
            }
            if ($diagnosis_final["general_diagnosis"] == "Malnouri") {
              $malnourished += 1;
              if ($diagnosis_final["general_new_old"] == "New") {
                $malnourished_new += 1;
              } else if ($diagnosis_final["general_new_old"] == "Old") {
                $malnourished_old += 1;
              }
            }
            if ($diagnosis_final["general_diagnosis"] == "Dengue-Fever") {
              $Dengue_fever += 1;
              if ($diagnosis_final["general_new_old"] == "New") {
                $Dengue_fever_new += 1;
              } else if ($diagnosis_final["general_new_old"] == "Old") {
                $Dengue_fever_old += 1;
              }
            }
            if ($diagnosis_final["general_diagnosis"] == "Others") {
              $other += 1;
              if ($diagnosis_final["general_new_old"] == "New") {
                $other_new += 1;
              } else if ($diagnosis_final["general_new_old"] == "Old") {
                $other_old += 1;
              }
            }

            if ($diagnosis_final["labInvestcheck"] == "labInvestcheck") {
              $lab_iv_ck += 1;
              if ($diagnosis_final["labInvest_new_old"] == "New") {
                $lab_iv_ck_new += 1;
              } else if ($diagnosis_final["labInvest_new_old"] == "Old") {
                $lab_iv_ck_old += 1;
              }
            }
          }
        }
      }
      $value_by_date[$Datevalue]["Date"] = $Datevalue;

      $value_by_date[$Datevalue]["PHA"]       = $PHA;
      $value_by_date[$Datevalue]["PHA_new"]   = $PHA_new;
      $value_by_date[$Datevalue]["PHA_old"]   = $PHA_old;
      $PHA_total += $PHA;
      $value_by_date[$Datevalue]["PHA_total"] = $PHA_total;
      $PHA = 0;
      $PHA_new = 0;
      $PHA_old = 0;

      $value_by_date[$Datevalue]["ART"] = $ART;
      $value_by_date[$Datevalue]["ART_new"] = $ART_new;
      $value_by_date[$Datevalue]["ART_old"] = $ART_old;
      $ART_total += $ART;
      $value_by_date[$Datevalue]["ART_total"] = $ART_total;
      $ART = 0;
      $ART_new = 0;
      $ART_old = 0;

      $value_by_date[$Datevalue]["PrEP"] = $PrEP;
      $value_by_date[$Datevalue]["PrEP_new"] = $PrEP_new;
      $value_by_date[$Datevalue]["PrEP_old"] = $PrEP_old;
      $PrEP_total += $ART;
      $value_by_date[$Datevalue]["PrEP_total"] = $PrEP_total;
      $PrEP = 0;
      $PrEP_new = 0;
      $PrEP_old = 0;

      $value_by_date[$Datevalue]["PMTCT"] = $PMTCT;
      $value_by_date[$Datevalue]["PMTCT_new"] = $PMTCT_new;
      $value_by_date[$Datevalue]["PMTCT_old"] = $PMTCT_old;
      $PMTCT_total += $PMTCT;
      $value_by_date[$Datevalue]["PMTCT_total"] = $PMTCT_total;
      $PMTCT = 0;
      $PMTCT_new = 0;
      $PMTCT_old = 0;

      $value_by_date[$Datevalue]["ANC"] = $ANC;
      $value_by_date[$Datevalue]["ANC_new"] = $ANC_new;
      $value_by_date[$Datevalue]["ANC_old"] = $ANC_old;
      $ANC_total += $ANC;
      $value_by_date[$Datevalue]["ANC_total"] = $ANC_total;
      $ANC = 0;
      $ANC_new = 0;
      $ANC_old = 0;

      $value_by_date[$Datevalue]["FP"] = $FP;
      $value_by_date[$Datevalue]["FP_new"] = $FP_new;
      $value_by_date[$Datevalue]["FP_old"] = $FP_old;
      $FP_total += $FP;
      $value_by_date[$Datevalue]["FP_total"] = $FP_total;
      $FP = 0;
      $FP_new = 0;
      $FP_old = 0;

      $value_by_date[$Datevalue]["Feedcenter"] = $Feedcenter;
      $value_by_date[$Datevalue]["Feedcenter_new"] = $Feedcenter_new;
      $value_by_date[$Datevalue]["Feedcenter_old"] = $Feedcenter_old;
      $Feedcenter_total += $Feedcenter;
      $value_by_date[$Datevalue]["Feedcenter_total"] = $Feedcenter_total;
      $Feedcenter = 0;
      $Feedcenter_new = 0;
      $Feedcenter_old = 0;

      $value_by_date[$Datevalue]["General"] = $General;
      $value_by_date[$Datevalue]["General_new"] = $General_new;
      $value_by_date[$Datevalue]["General_old"] = $General_old;
      $General_total += $General;
      $value_by_date[$Datevalue]["General_total"] = $General_total;
      $General = 0;
      $General_new = $General_old = 0;
      0;

      $value_by_date[$Datevalue]["Hypertension_only"] = $Hypertension_only;
      $value_by_date[$Datevalue]["Hypertension_only_new"] = $Hypertension_only_new;
      $value_by_date[$Datevalue]["Hypertension_only_old"] = $Hypertension_only_old;
      $Hypertension_only_total += $Hypertension_only;
      $value_by_date[$Datevalue]["Hypertension_only_total"] = $Hypertension_only_total;
      $Hypertension_only = 0;
      $Hypertension_only_new = 0;
      $Hypertension_only_old = 0;

      $value_by_date[$Datevalue]["DM_only"] = $DM_only;
      $value_by_date[$Datevalue]["DM_only_new"] = $DM_only_new;
      $value_by_date[$Datevalue]["DM_only_old"] = $DM_only_old;
      $DM_only_total += $DM_only;
      $value_by_date[$Datevalue]["DM_only_total"] = $DM_only_total;
      $DM_only = 0;
      $DM_only_new = 0;
      $DM_only_old = 0;

      $value_by_date[$Datevalue]["HT_DM_como"] = $HT_DM_como;
      $value_by_date[$Datevalue]["HT_DM_como_new"] = $HT_DM_como_new;
      $value_by_date[$Datevalue]["HT_DM_como_old"] = $HT_DM_como_old;
      $HT_DM_como_total += $HT_DM_como;
      $value_by_date[$Datevalue]["HT_DM_como_total"] = $HT_DM_como_total;
      $HT_DM_como = 0;
      $HT_DM_como_new = 0;
      $HT_DM_como_old = 0;

      $value_by_date[$Datevalue]["NCD_CVD"] = $NCD_CVD;
      $value_by_date[$Datevalue]["NCD_CVD_new"] = $NCD_CVD_new;
      $value_by_date[$Datevalue]["NCD_CVD_old"] = $NCD_CVD_old;
      $NCD_CVD_total += $NCD_CVD;
      $value_by_date[$Datevalue]["NCD_CVD_total"] = $NCD_CVD_total;
      $NCD_CVD = 0;
      $NCD_CVD_new = 0;
      $NCD_CVD_old = 0;

      $value_by_date[$Datevalue]["hivNegTB"] = $hivNegTB;
      $value_by_date[$Datevalue]["hivNegTB_new"] = $hivNegTB_new;
      $value_by_date[$Datevalue]["hivNegTB_old"] = $hivNegTB_old;
      $hivNegTB_total += $hivNegTB;
      $value_by_date[$Datevalue]["hivNegTB_total"] = $hivNegTB;
      $hivNegTB = 0;
      $hivNegTB_new = 0;
      $hivNegTB_old = 0;

      $value_by_date[$Datevalue]["RTI_less_2wk"] = $RTI_less_2wk;
      $value_by_date[$Datevalue]["RTI_less_2wk_new"] = $RTI_less_2wk_new;
      $value_by_date[$Datevalue]["RTI_less_2wk_old"] = $RTI_less_2wk_old;
      $RTI_less_2wk_total += $RTI_less_2wk;
      $value_by_date[$Datevalue]["RTI_less_2wk_total"] = $RTI_less_2wk_total;
      $RTI_less_2wk = 0;
      $RTI_less_2wk_new = 0;
      $RTI_less_2wk_old = 0;

      $value_by_date[$Datevalue]["RTI_great_2wk"] = $RTI_great_2wk;
      $value_by_date[$Datevalue]["RTI_great_2wk_new"] = $RTI_great_2wk_new;
      $value_by_date[$Datevalue]["RTI_great_2wk_old"] = $RTI_great_2wk_old;
      $RTI_great_2wk_total += $RTI_great_2wk;
      $value_by_date[$Datevalue]["RTI_great_2wk_total"] = $RTI_great_2wk_total;
      $RTI_great_2wk = 0;
      $RTI_great_2wk_new = 0;
      $RTI_great_2wk_old = 0;

      $value_by_date[$Datevalue]["TB_relate"] = $TB_relate;
      $value_by_date[$Datevalue]["TB_relate_new"] = $TB_relate_new;
      $value_by_date[$Datevalue]["TB_relate_old"] = $TB_relate_old;
      $NCD_CVD_total += $TB_relate;
      $value_by_date[$Datevalue]["TB_relate_total"] = $TB_relate_total;
      $TB_relate = 0;
      $TB_relate_new = 0;
      $TB_relate_old = 0;

      $value_by_date[$Datevalue]["covid_relate"] = $covid_relate;
      $value_by_date[$Datevalue]["covid_relate_new"] = $covid_relate_new;
      $value_by_date[$Datevalue]["covid_relate_old"] = $covid_relate_old;
      $NCD_CVD_total += $covid_relate;
      $value_by_date[$Datevalue]["covid_relate_total"] = $covid_relate_total;
      $covid_relate = 0;
      $covid_relate_new = 0;
      $covid_relate_old = 0;

      $value_by_date[$Datevalue]["obstrctive"] = $obstrctive;
      $value_by_date[$Datevalue]["obstrctive_new"] = $obstrctive_new;
      $value_by_date[$Datevalue]["obstrctive_old"] = $obstrctive_old;
      $obstrctive_total += $obstrctive;
      $value_by_date[$Datevalue]["obstrctive_total"] = $obstrctive_total;
      $obstrctive = 0;
      $obstrctive_new = 0;
      $obstrctive_old = 0;

      $value_by_date[$Datevalue]["Renal_ds"] = $Renal_ds;
      $value_by_date[$Datevalue]["Renal_ds_new"] = $Renal_ds_new;
      $value_by_date[$Datevalue]["Renal_ds_old"] = $Renal_ds_old;
      $Renal_ds_total += $Renal_ds;
      $value_by_date[$Datevalue]["Renal_ds_total"] = $Renal_ds_total;
      $Renal_ds = 0;
      $Renal_ds_new = 0;
      $Renal_ds_old = 0;

      $value_by_date[$Datevalue]["GI_Hepato"] = $GI_Hepato;
      $value_by_date[$Datevalue]["GI_Hepato_new"] = $GI_Hepato_new;
      $value_by_date[$Datevalue]["GI_Hepato_old"] = $GI_Hepato_old;
      $GI_Hepato_total += $GI_Hepato;
      $value_by_date[$Datevalue]["GI_Hepato_total"] = $GI_Hepato_total;
      $GI_Hepato = 0;
      $GI_Hepato_new = 0;
      $GI_Hepato_old = 0;

      $value_by_date[$Datevalue]["Gynaecology"] = $Gynaecology;
      $value_by_date[$Datevalue]["Gynaecology_new"] = $Gynaecology_new;
      $value_by_date[$Datevalue]["Gynaecology_old"] = $Gynaecology_old;
      $Gynaecology_total += $Gynaecology;
      $value_by_date[$Datevalue]["Gynaecology_total"] = $Gynaecology_total;
      $Gynaecology = 0;
      $Gynaecology_new = 0;
      $Gynaecology_old = 0;

      $value_by_date[$Datevalue]["Musculo_and_rheumatology"] = $Musculo_and_rheumatology;
      $value_by_date[$Datevalue]["Musculo_and_rheumatology_new"] = $Musculo_and_rheumatology_new;
      $value_by_date[$Datevalue]["Musculo_and_rheumatology_old"] = $Musculo_and_rheumatology_old;
      $Musculo_and_rheumatology_total += $Musculo_and_rheumatology;
      $value_by_date[$Datevalue]["Musculo_and_rheumatology_total"] = $Musculo_and_rheumatology_total;
      $Musculo_and_rheumatology = 0;
      $Musculo_and_rheumatology_new = 0;
      $Musculo_and_rheumatology_old = 0;

      $value_by_date[$Datevalue]["STI"] = $STI;
      $value_by_date[$Datevalue]["STI_new"] = $STI_new;
      $value_by_date[$Datevalue]["STI_old"] = $STI_old;
      $STI_total += $STI;
      $value_by_date[$Datevalue]["STI_total"] = $STI_total;
      $STI = 0;
      $STI_new = 0;
      $STI_old = 0;

      $value_by_date[$Datevalue]["Skin_inf"] = $Skin_inf;
      $value_by_date[$Datevalue]["Skin_inf_new"] = $Skin_inf_new;
      $value_by_date[$Datevalue]["Skin_inf_old"] = $Skin_inf_old;
      $Skin_inf_total += $Skin_inf;
      $value_by_date[$Datevalue]["Skin_inf_total"] = $Skin_inf_total;
      $Skin_inf = 0;
      $Skin_inf_new = 0;
      $Skin_inf_old = 0;

      $value_by_date[$Datevalue]["Sexual_violence"] = $Sexual_violence;
      $value_by_date[$Datevalue]["Sexual_violence_new"] = $Sexual_violence_new;
      $value_by_date[$Datevalue]["Sexual_violence_old"] = $Sexual_violence_old;
      $Sexual_violence_total += $Sexual_violence;
      $value_by_date[$Datevalue]["Sexual_violence_total"] = $Sexual_violence_total;
      $Sexual_violence = 0;
      $Sexual_violence_new = 0;
      $Sexual_violence_old = 0;

      $value_by_date[$Datevalue]["child_abuse"] = $child_abuse;
      $value_by_date[$Datevalue]["child_abuse_new"] = $child_abuse_new;
      $value_by_date[$Datevalue]["child_abuse_old"] = $child_abuse_old;
      $child_abuse_total += $child_abuse;
      $value_by_date[$Datevalue]["child_abuse_total"] = $child_abuse_total;
      $child_abuse = 0;
      $child_abuse_new = 0;
      $child_abuse_old = 0;

      $value_by_date[$Datevalue]["malnourished"] = $malnourished;
      $value_by_date[$Datevalue]["malnourished_new"] = $malnourished_new;
      $value_by_date[$Datevalue]["malnourished_old"] = $malnourished_old;
      $malnourished_total += $malnourished;
      $value_by_date[$Datevalue]["malnourished_total"] = $malnourished_total;
      $malnourished = 0;
      $malnourished_new = 0;
      $malnourished_old = 0;

      $value_by_date[$Datevalue]["Dengue_fever"] = $Dengue_fever;
      $value_by_date[$Datevalue]["Dengue_fever_new"] = $Dengue_fever_new;
      $value_by_date[$Datevalue]["Dengue_fever_old"] = $Dengue_fever_old;
      $Dengue_fever_total += $Dengue_fever;
      $value_by_date[$Datevalue]["Dengue_fever_total"] = $Dengue_fever_total;
      $Dengue_fever = 0;
      $Dengue_fever_new = 0;
      $Dengue_fever_old = 0;

      $value_by_date[$Datevalue]["other"] = $other;
      $value_by_date[$Datevalue]["other_new"] = $other_new;
      $value_by_date[$Datevalue]["other_old"] = $other_old;
      $other_total += $other;
      $value_by_date[$Datevalue]["other_total"] = $other_total;
      $other = 0;
      $other_new = 0;
      $other_old = 0;


      //$lab_iv_ck =0; $lab_iv_ck_new =0; $lab_iv_ck_old=0; $lab_iv_ck_total=0;
      $value_by_date[$Datevalue]["lab_inv_ck"] = $lab_iv_ck;
      $value_by_date[$Datevalue]["lab_inv_ck_new"] = $lab_iv_ck_new;
      $value_by_date[$Datevalue]["lab_inv_ck_old"] = $lab_iv_ck_old;
      $lab_iv_ck_total += $lab_iv_ck;
      $value_by_date[$Datevalue]["lab_inv_ck_total"] = $lab_iv_ck_total;
      $lab_iv_ck = 0;
      $lab_iv_ck_new = 0;
      $lab_iv_ck_old = 0;
    }



    //Main Looping
    for ($a = 0; $a < count($data); $a++) {
      $counting = 0;
      $Age = $data[$a]["Agey"];


      if ($Age < 15) {
        $pt_Diagnosis = $data[$a]["Pateint_Diagnosis"];
        if ($pt_Diagnosis != "731" && $pt_Diagnosis != null && $pt_Diagnosis != "") {
          $diagnosis_cut = explode("/", $pt_Diagnosis); // spliting array return type is array
          for ($i = 0; $i < 11; $i++) {
            $diagnosis_name = explode("-", $diagnosis_cut[$i]);
            for ($j = 0; $j < count($diagnosis_name); $j++) {
              if (Str::contains($diagnosis_name[$j], '\\')) {
                $trimmed_diagnosis = trim($diagnosis_name[$j], "\\"); // Remove backslashes
                $diagnosis_final[$diagnosis_dataonly[$counting]] = Crypt::decrypt_light($trimmed_diagnosis, "General"); //decrpting all diagnosis and adding new object array
                if ($diagnosis_final[$diagnosis_dataonly[$counting]] == "false") {
                  $diagnosis_final[$diagnosis_dataonly[$counting]] = "-";
                }

                $counting++;
              } else {
                $diagnosis_final[$diagnosis_dataonly[$counting]] = Crypt::decrypt_light($diagnosis_name[$j], "General"); //decrpting all diagnosis and adding new object array
                if ($diagnosis_final[$diagnosis_dataonly[$counting]] == "false") {
                  $diagnosis_final[$diagnosis_dataonly[$counting]] = "-";
                }


                $counting++;
              }
            }
            $diagnosisArray[0] = $diagnosis_final;
          }

          // To count daily data 
          // $diagnosis_dataonly=['phacheck','pha_new_old','pha_cohort',
          //       'artcheck','art_new_old','art_cohort',
          //   'prepcheck','prep_new_old',
          //   'pmtctcheck','pmtct_new_old',
          //   'anccheck','anc_new_old',
          //   'fmaplancheck','famaplan_new_old',
          //   'gneralcheck','general_new_old','general_diagnosis',
          //   'ncdcheck','ncd_new_old','ncd_diagnosis','ncd_drugSupply',
          //   'hivTBcheck','hivTB_new_old',
          //   'fcentercheck','feedcentre_new_old',
          //   'labInvestcheck','labInvest_new_old',];


          // RTI<2wks , RTI>=2 ,  ObstructiveDs , NCD-CVD , RenalDs , GI-Hepato , Gynaecology , Musculo-rheumatology, 
          // SkinInfect,  Covid-consul  , TB-consul ,  Sexual-viol , STI , Others , 14

          //  "RTI<2wks","RTI>=2","ObstructiveDs","Dengue-Fever",
          // "RenalDs","GI-Hepato","Malnouri","Child-Abuse",
          // "SkinInfect","Covid-consul","TB-consul","Others", 12

          //NCD-CVD,GI-Hepato,Musculo-rheumatology,Covid-consul,Child-Abuse

          // PHA
          if ($diagnosisArray[0]["pha_new_old"] == "New") {
            $pha_new += 1;
            if ($diagnosisArray[0]["phacheck"] == "phacheck") {
              $pha_check_new_u += 1;
            }
          }
          if ($diagnosisArray[0]["pha_new_old"] == "Old") {
            $pha_old += 1;
            if ($diagnosisArray[0]["phacheck"] == "phacheck") {
              $pha_check_old_u += 1;
            }
          }


          //ART
          if ($diagnosisArray[0]["art_new_old"] == "New") {
            $art_new += 1;
            if ($diagnosisArray[0]["artcheck"] == "artcheck") {
              $art_check_new_u += 1;
            }
          }
          if ($diagnosisArray[0]["art_new_old"] == "Old") {
            $art_old += 1;
            if ($diagnosisArray[0]["artcheck"] == "artcheck") {
              $art_check_old_u += 1;
            }
          }


          //PrEP
          if ($diagnosisArray[0]["prep_new_old"] == "New") {
            $prep_new += 1;
            if ($diagnosisArray[0]["prepcheck"] == "prepcheck") {
              $prep_check_new += 1;
            }
          }
          if ($diagnosisArray[0]["prep_new_old"] == "Old") {
            $prep_old += 1;
            if ($diagnosisArray[0]["prepcheck"] == "prepcheck") {
              $prep_check_old += 1;
            }
          }
          //PMTCT
          if ($diagnosisArray[0]["pmtct_new_old"] == "New") {
            $pmtct_new += 1;
            if ($diagnosisArray[0]["pmtctcheck"] == "pmtctcheck") {
              $pmtct_check_new += 1;
            }
          }
          if ($diagnosisArray[0]["pmtct_new_old"] == "Old") {
            $pmtct_old += 1;
            if ($diagnosisArray[0]["pmtctcheck"] == "pmtctcheck") {
              $pmtct_check_old += 1;
            }
          }
          //ANC
          if ($diagnosisArray[0]["anc_new_old"] == "New") {
            $anc_new += 1;
            if ($diagnosisArray[0]["anccheck"] == "anccheck") {
              $anc_check_new += 1;
            }
          }
          if ($diagnosisArray[0]["anc_new_old"] == "Old") {
            $anc_old += 1;
            if ($diagnosisArray[0]["anccheck"] == "anccheck") {
              $anc_check_old += 1;
            }
          }
          // Family planning
          if ($diagnosisArray[0]["famaplan_new_old"] == "New") {
            $fp_new += 1;
            if ($diagnosisArray[0]["fmaplancheck"] == "fmaplancheck") {
              $fp_check_new += 1;
            }
          }
          if ($diagnosisArray[0]["famaplan_new_old"] == "Old") {
            $fp_old += 1;
            if ($diagnosisArray[0]["fmaplancheck"] == "fmaplancheck") {
              $fp_check_old += 1;
            }
          }
          // Feeding Center
          if ($diagnosisArray[0]["feedcentre_new_old"] == "New") {
            $feed_new += 1;
            if ($diagnosisArray[0]["fcentercheck"] == "fcentercheck") {
              $feed_check_new_u += 1;
            }
          }
          if ($diagnosisArray[0]["feedcentre_new_old"] == "Old") {
            $feed_old += 1;
            if ($diagnosisArray[0]["fcentercheck"] == "fcentercheck") {
              $feed_check_old_u += 1;
            }
          }

          //HIV neg TB 
          if ($diagnosisArray[0]["hivTB_new_old"] == "New") {
            if ($diagnosisArray[0]["hivTBcheck"] == "hivTBcheck") {
              $ugen_HIV_TB_new += 1;
            }
          }
          if ($diagnosisArray[0]["hivTB_new_old"] == "Old") {
            if ($diagnosisArray[0]["hivTBcheck"] == "hivTBcheck") {
              $ugen_HIV_TB_old += 1;
            }
          }



          // General
          if ($diagnosisArray[0]["general_new_old"] == "New") {
            $gen_new += 1;
            if ($diagnosisArray[0]["gneralcheck"] == "gneralcheck") {
              $gen_check_new_u += 1;
            }
          }
          if ($diagnosisArray[0]["general_new_old"] == "Old") {
            $gen_old += 1;
            if ($diagnosisArray[0]["gneralcheck"] == "gneralcheck") {
              $gen_check_old_u += 1;
            }
          }

          if ($diagnosisArray[0]["gneralcheck"] == "gneralcheck") {
            //New
            //NCD-CVD,GI-Hepato,Musculo-rheumatology,Covid-consul,Child-Abuse
            $sti_check_boo[] = $diagnosisArray[0]["gneralcheck"];
            if ($diagnosisArray[0]["general_new_old"] == "New") {
              if ($diagnosisArray[0]["general_diagnosis"] == "NCD-CVD") {
                $ugen_NCD_CVD_new += 1;
              }
              if ($diagnosisArray[0]["general_diagnosis"] == "RTI<2wks") {
                $ugen_RTI_Less2wk_new += 1;
              }
              if ($diagnosisArray[0]["general_diagnosis"] == "RTI>=2") {
                $ugen_RTI_Great2wk_new += 1;
              }
              if ($diagnosisArray[0]["general_diagnosis"] == "ObstructiveDs") {
                $ugen_Obstructive_pul_new += 1;
              }
              if ($diagnosisArray[0]["general_diagnosis"] == "RenalDs") {
                $ugen_Renal_new += 1;
              }
              if ($diagnosisArray[0]["general_diagnosis"] == "GI-Hepato") {
                $ugen_GI_Hep_new += 1;
              }
              if ($diagnosisArray[0]["general_diagnosis"] == "Gynaecology") {
                $ugen_Gynaecology_new += 1;
              }
              if ($diagnosisArray[0]["general_diagnosis"] == "Musculo-rheumatology") {
                $ugen_Muscul_rheuma_new  += 1;
              }
              if ($diagnosisArray[0]["general_diagnosis"] == "SkinInfect") {
                $ugen_skin_infect_new  += 1;
              }
              if ($diagnosisArray[0]["general_diagnosis"] == "Covid-consul") {
                $ugen_Covid_relate_new  += 1;
              }
              if ($diagnosisArray[0]["general_diagnosis"] == "TB-consul") {
                $ugen_TB_relate_new  += 1;
              }
              if ($diagnosisArray[0]["general_diagnosis"] == "Sexual-viol") {
                $ugen_sex_violence_new  += 1;
              }
              if ($diagnosisArray[0]["general_diagnosis"] == "STI") {
                $ugen_STI_new  += 1;
              }
              if ($diagnosisArray[0]["general_diagnosis"] == "Others") {
                $ugen_others_new  += 1;
              }

              if ($diagnosisArray[0]["general_diagnosis"] == "Dengue-Fever") {
                $ugen_dengue_fever_new  += 1;
              }
              if ($diagnosisArray[0]["general_diagnosis"] == "Malnouri") {
                $ugen_malnourish_new  += 1;
              }
              if ($diagnosisArray[0]["general_diagnosis"] == "Child-Abuse") {
                $ugen_child_abuse_new  += 1;
              }
            }

            // Old
            if ($diagnosisArray[0]["general_new_old"] == "Old") {
              if ($diagnosisArray[0]["general_diagnosis"] == "NCD-CVD") {
                $ugen_NCD_CVD_old += 1;
              }

              if ($diagnosisArray[0]["general_diagnosis"] == "RTI<2wks") {
                $ugen_RTI_Less2wk_old += 1;
              }
              if ($diagnosisArray[0]["general_diagnosis"] == "RTI>=2") {
                $ugen_RTI_Great2wk_old += 1;
              }
              if ($diagnosisArray[0]["general_diagnosis"] == "ObstructiveDs") {
                $ugen_Obstructive_pul_old += 1;
              }
              if ($diagnosisArray[0]["general_diagnosis"] == "RenalDs") {
                $ugen_Renal_old += 1;
              }
              if ($diagnosisArray[0]["general_diagnosis"] == "GI-Hepato") {
                $ugen_GI_Hep_old += 1;
              }
              if ($diagnosisArray[0]["general_diagnosis"] == "Gynaecology") {
                $ugen_Gynaecology_old += 1;
              }
              if ($diagnosisArray[0]["general_diagnosis"] == "Musculo-rheumatology") {
                $ugen_Muscul_rheuma_old  += 1;
              }
              if ($diagnosisArray[0]["general_diagnosis"] == "SkinInfect") {
                $ugen_skin_infect_old  += 1;
              }
              if ($diagnosisArray[0]["general_diagnosis"] == "Covid-consul") {
                $ugen_Covid_relate_old  += 1;
              }
              if ($diagnosisArray[0]["general_diagnosis"] == "TB-consul") {
                $ugen_TB_relate_old  += 1;
              }
              if ($diagnosisArray[0]["general_diagnosis"] == "Sexual-viol") {
                $ugen_sex_violence_old  += 1;
              }
              if ($diagnosisArray[0]["general_diagnosis"] == "STI") {
                $ugen_STI_old  += 1;
              }
              if ($diagnosisArray[0]["general_diagnosis"] == "Others") {
                $ugen_others_old  += 1;
              }


              if ($diagnosisArray[0]["general_diagnosis"] == "Dengue-Fever") {
                $ugen_dengue_fever_old  += 1;
              }
              if ($diagnosisArray[0]["general_diagnosis"] == "Malnouri") {
                $ugen_malnourish_old  += 1;
              }
              if ($diagnosisArray[0]["general_diagnosis"] == "Child-Abuse") {
                $ugen_child_abuse_old  += 1;
              }
            }
          }






          ///  'labInvestcheck','labInvest_new_old' 
          if ($diagnosisArray[0]["labInvest_new_old"] == "New") {
            if ($diagnosisArray[0]["labInvestcheck"] == "labInvestcheck") {
              $lab_inv_only_new_u += 1;
            }
          }
          if ($diagnosisArray[0]["labInvest_new_old"] == "Old") {
            if ($diagnosisArray[0]["labInvestcheck"] == "labInvestcheck") {
              $lab_inv_only_old_u += 1;
            }
          }

          // MAM Cohort
          if ($diagnosisArray[0]["phacheck"] == "phacheck") {

            if ($diagnosisArray[0]["pha_cohort"] == "Yes") {
              $pha_cohort_Yes += 1;
            }
            if ($diagnosisArray[0]["pha_cohort"] == "No") {
              $pha_cohort_No += 1;
            }
          }
          // ART Cohort
          if ($diagnosisArray[0]["artcheck"] == "artcheck") {

            if ($diagnosisArray[0]["art_cohort"] == "Yes") {
              $art_cohort_Yes += 1;
            }
            if ($diagnosisArray[0]["art_cohort"] == "No") {
              $art_cohort_No += 1;
            }
          }
          // NCD only, DM only , NCD-DM-Como
          if ($diagnosisArray[0]["ncdcheck"] == "ncdcheck") {
            if ($diagnosisArray[0]["ncd_new_old"] == "New") {
              if ($diagnosisArray[0]["ncd_diagnosis"] == "Hypertension") {
                $ugen_HT_only_new += 1;
              }
              if ($diagnosisArray[0]["ncd_diagnosis"] == "Diabetes") {
                $ugen_DM_only_new += 1;
              }
              if ($diagnosisArray[0]["ncd_diagnosis"] == "HT-DM-commodities") {
                $ugen_HT_DM_como_new += 1;
              }
            }
            if ($diagnosisArray[0]["ncd_new_old"] == "Old") {
              if ($diagnosisArray[0]["ncd_diagnosis"] == "Hypertension") {
                $ugen_HT_only_old += 1;
              }
              if ($diagnosisArray[0]["ncd_diagnosis"] == "Diabetes") {
                $ugen_DM_only_old += 1;
              }
              if ($diagnosisArray[0]["ncd_diagnosis"] == "HT-DM-commodities") {
                $ugen_HT_DM_como_old += 1;
              }
            }
          }
        } else {
          // for ($b=0; $b < count($diagnosis_dataonly); $b++) { 
          //   $diagnosisArray[0][$diagnosis_dataonly[$b]]="";
          // }
          $less_15_diagnosis_null_blank += 1;
        }
      }
      if ($Age > 15 || $Age == 15) {
        $pt_Diagnosis = $data[$a]["Pateint_Diagnosis"];
        if ($pt_Diagnosis != "731" && $pt_Diagnosis != null && $pt_Diagnosis != "") {
          $diagnosis_cut = explode("/", $pt_Diagnosis); // spliting array return type is array
          for ($i = 0; $i < 11; $i++) {
            $diagnosis_name = explode("-", $diagnosis_cut[$i]);
            for ($j = 0; $j < count($diagnosis_name); $j++) {
              if (Str::contains($diagnosis_name[$j], '\\')) {
                $trimmed_diagnosis = trim($diagnosis_name[$j], "\\"); // Remove backslashes
                $diagnosis_final[$diagnosis_dataonly[$counting]] = Crypt::decrypt_light($trimmed_diagnosis, "General"); //decrpting all diagnosis and adding new object array
                if ($diagnosis_final[$diagnosis_dataonly[$counting]] == "false") {
                  $diagnosis_final[$diagnosis_dataonly[$counting]] = "-";
                }


                $counting++;
              } else {
                $diagnosis_final[$diagnosis_dataonly[$counting]] = Crypt::decrypt_light($diagnosis_name[$j], "General"); //decrpting all diagnosis and adding new object array
                if ($diagnosis_final[$diagnosis_dataonly[$counting]] == "false") {
                  $diagnosis_final[$diagnosis_dataonly[$counting]] = "-";
                }


                $counting++;
              }
            }
            $diagnosisArray[0] = $diagnosis_final;
          }



          // PHA
          if ($diagnosisArray[0]["pha_new_old"] == "New") {
            $pha_new += 1;
            if ($diagnosisArray[0]["phacheck"] == "phacheck") {
              $pha_check_new += 1;
            }
          }
          if ($diagnosisArray[0]["pha_new_old"] == "Old") {
            $pha_old += 1;
            if ($diagnosisArray[0]["phacheck"] == "phacheck") {
              $pha_check_old += 1;
            }
          }

          //ART
          if ($diagnosisArray[0]["art_new_old"] == "New") {
            $art_new += 1;
            if ($diagnosisArray[0]["artcheck"] == "artcheck") {
              $art_check_new += 1;
            }
          }
          if ($diagnosisArray[0]["art_new_old"] == "Old") {
            $art_old += 1;
            if ($diagnosisArray[0]["artcheck"] == "artcheck") {
              $art_check_old += 1;
            }
          }
          //PrEP
          if ($diagnosisArray[0]["prep_new_old"] == "New") {
            $prep_new += 1;
            if ($diagnosisArray[0]["prepcheck"] == "prepcheck") {
              $prep_check_new += 1;
            }
          }
          if ($diagnosisArray[0]["prep_new_old"] == "Old") {
            $prep_old += 1;
            if ($diagnosisArray[0]["prepcheck"] == "prepcheck") {
              $prep_check_old += 1;
            }
          }
          //PMTCT
          if ($diagnosisArray[0]["pmtct_new_old"] == "New") {
            $pmtct_new += 1;
            if ($diagnosisArray[0]["pmtctcheck"] == "pmtctcheck") {
              $pmtct_check_new += 1;
            }
          }
          if ($diagnosisArray[0]["pmtct_new_old"] == "Old") {
            $pmtct_old += 1;
            if ($diagnosisArray[0]["pmtctcheck"] == "pmtctcheck") {
              $pmtct_check_old += 1;
            }
          }
          //ANC
          if ($diagnosisArray[0]["anc_new_old"] == "New") {
            $anc_new += 1;
            if ($diagnosisArray[0]["anccheck"] == "anccheck") {
              $anc_check_new += 1;
            }
          }
          if ($diagnosisArray[0]["anc_new_old"] == "Old") {
            $anc_old += 1;
            if ($diagnosisArray[0]["anccheck"] == "anccheck") {
              $anc_check_old += 1;
            }
          }
          // Family planning
          if ($diagnosisArray[0]["famaplan_new_old"] == "New") {
            $fp_new += 1;
            if ($diagnosisArray[0]["fmaplancheck"] == "fmaplancheck") {
              $fp_check_new += 1;
            }
          }
          if ($diagnosisArray[0]["famaplan_new_old"] == "Old") {
            $fp_old += 1;
            if ($diagnosisArray[0]["fmaplancheck"] == "fmaplancheck") {
              $fp_check_old += 1;
            }
          }
          // Feeding Center
          if ($diagnosisArray[0]["feedcentre_new_old"] == "New") {
            $feed_new += 1;
            if ($diagnosisArray[0]["fcentercheck"] == "fcentercheck") {
              $feed_check_old += 1;
            }
          }
          if ($diagnosisArray[0]["feedcentre_new_old"] == "Old") {
            $feed_old += 1;
            if ($diagnosisArray[0]["fcentercheck"] == "fcentercheck") {
              $feed_check_old += 1;
            }
          }
          // General


          if ($diagnosisArray[0]["general_new_old"] == "New") {
            $gen_new += 1;
            if ($diagnosisArray[0]["gneralcheck"] == "gneralcheck") {
              $gen_check_new += 1;
            }
          }
          if ($diagnosisArray[0]["general_new_old"] == "Old") {
            $gen_old += 1;
            if ($diagnosisArray[0]["gneralcheck"] == "gneralcheck") {
              $gen_check_old += 1;
            }
          }

          // MAM Cohort
          if ($diagnosisArray[0]["phacheck"] == "phacheck") {

            if ($diagnosisArray[0]["pha_cohort"] == "Yes") {
              $pha_cohort_Yes += 1;
            }
            if ($diagnosisArray[0]["pha_cohort"] == "No" || $diagnosisArray[0]["pha_cohort"] == "-") {
              $pha_cohort_No += 1;
            }
          }
          // ART Cohort
          if ($diagnosisArray[0]["artcheck"] == "artcheck") {

            if ($diagnosisArray[0]["art_cohort"] == "Yes") {
              $art_cohort_Yes += 1;
            }
            if ($diagnosisArray[0]["art_cohort"] == "No" || $diagnosisArray[0]["art_cohort"] == "-") {
              $art_cohort_No += 1;
            }
          }


          // General -> New ->Ncd-CVD,RTI<2wk, 14 

          // var diagnosis_value=[    ___________________________14_____
          //   "RTI<2wks","RTI>=2","ObstructiveDs","NCD-CVD",
          //   "RenalDs","GI-Hepato","Gynaecology","Musculo-rheumatology",
          //   "SkinInfect","Covid-consul","TB-consul","Sexual-viol",
          //   "STI","Others",
          //   ];
          // var diagnosis_valueUn15=[
          //   "RTI<2wks","RTI>=2","ObstructiveDs","Dengue-Fever",
          //   "RenalDs","GI-Hepato","Malnouri","Child-Abuse",
          //   "SkinInfect","Covid-consul","TB-consul","Others",

          if ($diagnosisArray[0]["gneralcheck"] == "gneralcheck") {
            //New
            $sti_check_boo[] = $diagnosisArray[0]["gneralcheck"];
            if ($diagnosisArray[0]["general_new_old"] == "New") {
              if ($diagnosisArray[0]["general_diagnosis"] == "NCD-CVD") {
                $ogen_NCD_CVD_new += 1;
              }
              if ($diagnosisArray[0]["general_diagnosis"] == "RTI<2wks") {
                $ogen_RTI_Less2wk_new += 1;
              }
              if ($diagnosisArray[0]["general_diagnosis"] == "RTI>=2") {
                $ogen_RTI_Great2wk_new += 1;
              }
              if ($diagnosisArray[0]["general_diagnosis"] == "ObstructiveDs") {
                $ogen_Obstructive_pul_new += 1;
              }
              if ($diagnosisArray[0]["general_diagnosis"] == "RenalDs") {
                $ogen_Renal_new += 1;
              }
              if ($diagnosisArray[0]["general_diagnosis"] == "GI-Hepato") {
                $ogen_GI_Hep_new += 1;
              }
              if ($diagnosisArray[0]["general_diagnosis"] == "Gynaecology") {
                $ogen_Gynaecology_new += 1;
              }
              if ($diagnosisArray[0]["general_diagnosis"] == "Musculo-rheumatology") {
                $ogen_Muscul_rheuma_new  += 1;
              }
              if ($diagnosisArray[0]["general_diagnosis"] == "SkinInfect") {
                $ogen_skin_infect_new  += 1;
              }
              if ($diagnosisArray[0]["general_diagnosis"] == "Covid-consul") {
                $ogen_Covid_relate_new  += 1;
              }
              if ($diagnosisArray[0]["general_diagnosis"] == "TB-consul") {
                $ogen_TB_relate_new  += 1;
              }
              if ($diagnosisArray[0]["general_diagnosis"] == "Sexual-viol") {
                $ogen_sex_violence_new  += 1;
              }
              if ($diagnosisArray[0]["general_diagnosis"] == "STI") {
                $ogen_STI_new  += 1;
              }
              if ($diagnosisArray[0]["general_diagnosis"] == "Others") {
                $ogen_others_new  += 1;
              }

              if ($diagnosisArray[0]["general_diagnosis"] == "Dengue-Fever") {
                $ogen_dengue_fever_new  += 1;
              }
              if ($diagnosisArray[0]["general_diagnosis"] == "Malnouri") {
                $ogen_malnourish_new  += 1;
              }
              if ($diagnosisArray[0]["general_diagnosis"] == "Child-Abuse") {
                $ogen_child_abuse_new  += 1;
              }
            }

            // Old
            if ($diagnosisArray[0]["general_new_old"] == "Old") {
              if ($diagnosisArray[0]["general_diagnosis"] == "NCD-CVD") {
                $ogen_NCD_CVD_old += 1;
              }

              if ($diagnosisArray[0]["general_diagnosis"] == "RTI<2wks") {
                $ogen_RTI_Less2wk_old += 1;
              }
              if ($diagnosisArray[0]["general_diagnosis"] == "RTI>=2") {
                $ogen_RTI_Great2wk_old += 1;
              }
              if ($diagnosisArray[0]["general_diagnosis"] == "ObstructiveDs") {
                $ogen_Obstructive_pul_old += 1;
              }
              if ($diagnosisArray[0]["general_diagnosis"] == "RenalDs") {
                $ogen_Renal_old += 1;
              }
              if ($diagnosisArray[0]["general_diagnosis"] == "GI-Hepato") {
                $ogen_GI_Hep_old += 1;
              }
              if ($diagnosisArray[0]["general_diagnosis"] == "Gynaecology") {
                $ogen_Gynaecology_old += 1;
              }
              if ($diagnosisArray[0]["general_diagnosis"] == "Musculo-rheumatology") {
                $ogen_Muscul_rheuma_old  += 1;
              }
              if ($diagnosisArray[0]["general_diagnosis"] == "SkinInfect") {
                $ogen_skin_infect_old  += 1;
              }
              if ($diagnosisArray[0]["general_diagnosis"] == "Covid-consul") {
                $ogen_Covid_relate_old  += 1;
              }
              if ($diagnosisArray[0]["general_diagnosis"] == "TB-consul") {
                $ogen_TB_relate_old  += 1;
              }
              if ($diagnosisArray[0]["general_diagnosis"] == "Sexual-viol") {
                $ogen_sex_violence_old  += 1;
              }
              if ($diagnosisArray[0]["general_diagnosis"] == "STI") {
                $ogen_STI_old  += 1;
              }
              if ($diagnosisArray[0]["general_diagnosis"] == "Others") {
                $ogen_others_old  += 1;
              }


              if ($diagnosisArray[0]["general_diagnosis"] == "Dengue-Fever") {
                $ogen_dengue_fever_old  += 1;
              }
              if ($diagnosisArray[0]["general_diagnosis"] == "Malnouri") {
                $ogen_malnourish_old  += 1;
              }
              if ($diagnosisArray[0]["general_diagnosis"] == "Child-Abuse") {
                $ogen_child_abuse_old  += 1;
              }
            }
          }
          //HIV neg TB   $ugen_HIV_TB_new =0;$ogen_HIV_TB_new =0;$ugen_HIV_TB_old =0;$ogen_HIV_TB_old =0;

          if ($diagnosisArray[0]["hivTB_new_old"] == "New") {
            if ($diagnosisArray[0]["hivTBcheck"] == "hivTBcheck") {
              $ogen_HIV_TB_new += 1;
            }
          }
          if ($diagnosisArray[0]["hivTB_new_old"] == "Old") {
            if ($diagnosisArray[0]["hivTBcheck"] == "hivTBcheck") {
              $ogen_HIV_TB_old += 1;
            }
          }


          // Lab inv only

          if ($diagnosisArray[0]["labInvest_new_old"] == "New") {
            if ($diagnosisArray[0]["labInvestcheck"] == "labInvestcheck") {
              $lab_inv_only_new += 1;
            }
          }
          if ($diagnosisArray[0]["labInvest_new_old"] == "Old") {
            if ($diagnosisArray[0]["labInvestcheck"] == "labInvestcheck") {
              $lab_inv_only_old += 1;
            }
          }
          // NCD only, DM only , NCD-DM-Como
          if ($diagnosisArray[0]["ncdcheck"] == "ncdcheck") {
            if ($diagnosisArray[0]["ncd_new_old"] == "New") {
              if ($diagnosisArray[0]["ncd_diagnosis"] == "Hypertension") {
                $ogen_HT_only_new += 1;
              }
              if ($diagnosisArray[0]["ncd_diagnosis"] == "Diabetes") {
                $ogen_DM_only_new += 1;
              }
              if ($diagnosisArray[0]["ncd_diagnosis"] == "HT-DM-commodities") {
                $ogen_HT_DM_como_new += 1;
              }
            }
            if ($diagnosisArray[0]["ncd_new_old"] == "Old") {
              if ($diagnosisArray[0]["ncd_diagnosis"] == "Hypertension") {
                $ogen_HT_only_old += 1;
              }
              if ($diagnosisArray[0]["ncd_diagnosis"] == "Diabetes") {
                $ogen_DM_only_old += 1;
              }
              if ($diagnosisArray[0]["ncd_diagnosis"] == "HT-DM-commodities") {
                $ogen_HT_DM_como_old += 1;
              }
            }
          }
        } else {

          $great_15_diagnosis_null_blank += 1;
        }
      }


      // For Main Risk Counting
      $pt_gen_ID = $data[$a]["Pid"];
      $pt_gen_row = Patients::where('Pid', $pt_gen_ID)->first();
      if ($pt_gen_row != null) {
        $main_risk = Crypt::decrypt_light($pt_gen_row["Main Risk"], "General");
      } else {
        $main_risk = "Other";
      }
      if ($main_risk == "FSW") {
        $fsw += 1;
      }
      if ($main_risk == "MSM") {
        $msm += 1;
      }
      if ($main_risk == "TG") {
        $tg += 1;
      }
      if ($main_risk == "IDU") {
        $pwid += 1;
      }
      if ($main_risk != "FSW" && $main_risk != "MSM" && $main_risk != "TG" && $main_risk != "IDU") {
        $non_kp += 1;
      }

      // For Fever

      if ($data[$a]["Fever"] == "2832533") {
        $fever_count_data += 1;
      }
    }
    // adding General with lab investigation only.
    $gen_check_new_u  += $lab_inv_only_new_u;
    $gen_check_old_u  += $lab_inv_only_old_u;
    $gen_check_new    += $lab_inv_only_new;
    $gen_check_old    += $lab_inv_only_old;

    $ugen_others_new  += $lab_inv_only_new_u;
    $ugen_others_old  += $lab_inv_only_old_u;
    $ogen_others_new  += $lab_inv_only_new;
    $ogen_others_old  += $lab_inv_only_old;




    $lab_inv_only = $lab_inv_only_new_u + $lab_inv_only_old_u + $lab_inv_only_new + $lab_inv_only_old;



    $General_Diag_new_u15 = $ugen_NCD_CVD_new + $ugen_HT_only_new + $ugen_DM_only_new + $ugen_HT_DM_como_new + $ugen_RTI_Less2wk_new +
      $ugen_RTI_Great2wk_new + $ugen_HIV_TB_new + $ugen_TB_relate_new + $ugen_Covid_relate_new + $ugen_Obstructive_pul_new +
      $ugen_Renal_new + $ugen_GI_Hep_new + $ugen_Gynaecology_new + $ugen_Muscul_rheuma_new + $ugen_STI_new + $ugen_skin_infect_new +
      $ugen_sex_violence_new + $ugen_child_abuse_new + $ugen_malnourish_new + $ugen_dengue_fever_new + $ugen_others_new;
    $General_Diag_new_o15 = $ogen_NCD_CVD_new + $ogen_HT_only_new + $ogen_DM_only_new + $ogen_HT_DM_como_new + $ogen_RTI_Less2wk_new +
      $ogen_RTI_Great2wk_new + $ogen_HIV_TB_new + $ogen_TB_relate_new + $ogen_Covid_relate_new + $ogen_Obstructive_pul_new +
      $ogen_Renal_new + $ogen_GI_Hep_new + $ogen_Gynaecology_new + $ogen_Muscul_rheuma_new + $ogen_STI_new + $ogen_skin_infect_new +
      $ogen_sex_violence_new + $ogen_child_abuse_new + $ogen_malnourish_new + $ogen_dengue_fever_new + $ogen_others_new;

    $General_Diag_old_u15 = $ugen_NCD_CVD_old + $ugen_HT_only_old + $ugen_DM_only_old + $ugen_HT_DM_como_old + $ugen_RTI_Less2wk_old +
      $ugen_RTI_Great2wk_old + $ugen_HIV_TB_old + $ugen_TB_relate_old + $ugen_Covid_relate_old + $ugen_Obstructive_pul_old +
      $ugen_Renal_old + $ugen_GI_Hep_old + $ugen_Gynaecology_old + $ugen_Muscul_rheuma_old + $ugen_STI_old + $ugen_skin_infect_old +
      $ugen_sex_violence_old + $ugen_child_abuse_old + $ugen_malnourish_old + $ugen_dengue_fever_old + $ugen_others_old;
    $General_Diag_old_o15 = $ogen_NCD_CVD_old + $ogen_HT_only_old + $ogen_DM_only_old + $ogen_HT_DM_como_old + $ogen_RTI_Less2wk_old +
      $ogen_RTI_Great2wk_old + $ogen_HIV_TB_old + $ogen_TB_relate_old + $ogen_Covid_relate_old + $ogen_Obstructive_pul_old +
      $ogen_Renal_old + $ogen_GI_Hep_old + $ogen_Gynaecology_old + $ogen_Muscul_rheuma_old + $ogen_STI_old + $ogen_skin_infect_old +
      $ogen_sex_violence_old + $ogen_child_abuse_old + $ogen_malnourish_old + $ogen_dengue_fever_old + $ogen_others_old;


    DailyConsultationreport::truncate();
    DailyConsultationreport::create([

      'col_1'  => $pha_check_new_u,
      'col_2'  => $pha_check_new,
      'col_3'  => $pha_check_old_u,
      'col_4'  => $pha_check_old,

      'col_5'  => $art_check_new_u,
      'col_6'  => $art_check_new,
      'col_7'  => $art_check_old_u,
      'col_8'  => $art_check_old,

      'col_9'  => $prep_check_new_u,
      'col_10'  => $prep_check_new,
      'col_11'  => $prep_check_old_u,
      'col_12'  => $prep_check_old,

      'col_13'  => $pmtct_check_new_u,
      'col_14'  => $pmtct_check_new,
      'col_15'  => $pmtct_check_old_u,
      'col_16'  => $pmtct_check_old,

      'col_17'  => $anc_check_new_u,
      'col_18'  => $anc_check_new,
      'col_19'  => $anc_check_old_u,
      'col_20'  => $anc_check_old,

      'col_21'  => $fp_check_new_u,
      'col_22'  => $fp_check_new,
      'col_23'  => $fp_check_old_u,
      'col_24'  => $fp_check_old,

      'col_25'  => $feed_check_new_u,
      'col_26'  => $feed_check_new,
      'col_27'  => $feed_check_old_u,
      'col_28'  => $feed_check_old,

      'col_29'  => $gen_check_new_u,
      'col_30'  => $gen_check_new,
      'col_31'  => $gen_check_old_u,
      'col_32'  => $gen_check_old,

      //32 MAM cohort
      'col_33'  => $pha_cohort_Yes,
      'col_34'  => $art_cohort_Yes,
      'col_35'  => $pha_cohort_No,
      'col_36'  => $art_cohort_No,

      //36 General Diagnosis

      // Under General
      'col_37'  => $ugen_NCD_CVD_new,
      'col_38'  => $ogen_NCD_CVD_new,
      'col_39'  => $ugen_NCD_CVD_old,
      'col_40'  => $ogen_NCD_CVD_old,

      // Under NCD only option
      'col_41'  => $ugen_HT_only_new,
      'col_42'  => $ogen_HT_only_new,
      'col_43'  => $ugen_HT_only_old,
      'col_44'  => $ogen_HT_only_old,

      'col_45'  => $ugen_DM_only_new,
      'col_46'  => $ogen_DM_only_new,
      'col_47'  => $ugen_DM_only_old,
      'col_48'  => $ogen_DM_only_old,

      'col_49'  => $ugen_HT_DM_como_new,
      'col_50'  => $ogen_HT_DM_como_new,
      'col_51'  => $ugen_HT_DM_como_old,
      'col_52'  => $ogen_HT_DM_como_old,

      'col_61'  => $ugen_HIV_TB_new,
      'col_62'  => $ogen_HIV_TB_new,
      'col_63'  => $ugen_HIV_TB_old,
      'col_64'  => $ogen_HIV_TB_old,


      // Under General 
      'col_53'  => $ugen_RTI_Less2wk_new,
      'col_54'  => $ogen_RTI_Less2wk_new,
      'col_55'  => $ugen_RTI_Less2wk_old,
      'col_56'  => $ogen_RTI_Less2wk_old,

      'col_57'  => $ugen_RTI_Great2wk_new,
      'col_58'  => $ogen_RTI_Great2wk_new,
      'col_59'  => $ugen_RTI_Great2wk_old,
      'col_60'  => $ogen_RTI_Great2wk_old,

      'col_65'  => $ugen_TB_relate_new,
      'col_66'  => $ogen_TB_relate_new,
      'col_67'  => $ugen_TB_relate_old,
      'col_68'  => $ogen_TB_relate_old,

      'col_69'  => $ugen_Covid_relate_new,
      'col_70'  => $ogen_Covid_relate_new,
      'col_71'  => $ugen_Covid_relate_old,
      'col_72'  => $ogen_Covid_relate_old,

      'col_73'  => $ugen_Obstructive_pul_new,
      'col_74'  => $ogen_Obstructive_pul_new,
      'col_75'  => $ugen_Obstructive_pul_old,
      'col_76'  => $ogen_Obstructive_pul_old,

      'col_77'  => $ugen_Renal_new,
      'col_78'  => $ogen_Renal_new,
      'col_79'  => $ugen_Renal_old,
      'col_80'  => $ogen_Renal_old,

      'col_81'  => $ugen_GI_Hep_new,
      'col_82'  => $ogen_GI_Hep_new,
      'col_83'  => $ugen_GI_Hep_old,
      'col_84'  => $ogen_GI_Hep_old,

      'col_85'  => $ugen_Gynaecology_new,
      'col_86'  => $ogen_Gynaecology_new,
      'col_87'  => $ugen_Gynaecology_old,
      'col_88'  => $ogen_Gynaecology_old,

      'col_89'  => $ugen_Muscul_rheuma_new,
      'col_90'  => $ogen_Muscul_rheuma_new,
      'col_91'  => $ugen_Muscul_rheuma_old,
      'col_92'  => $ogen_Muscul_rheuma_old,

      'col_93'  => $ugen_STI_new,
      'col_94'  => $ogen_STI_new,
      'col_95'  => $ugen_STI_old,
      'col_96'  => $ogen_STI_old,

      'col_97'  => $ugen_skin_infect_new,
      'col_98'  => $ogen_skin_infect_new,
      'col_99'  => $ugen_skin_infect_old,
      'col_100'  => $ogen_skin_infect_old,

      'col_101'  => $ugen_sex_violence_new,
      'col_102'  => $ogen_sex_violence_new,
      'col_103'  => $ugen_sex_violence_old,
      'col_104'  => $ogen_sex_violence_old,

      'col_105'  => $ugen_child_abuse_new,
      'col_106'  => $ogen_child_abuse_new,
      'col_107'  => $ugen_child_abuse_old,
      'col_108'  => $ogen_child_abuse_old,

      'col_109'  => $ugen_malnourish_new,
      'col_110'  => $ogen_malnourish_new,
      'col_111'  => $ugen_malnourish_old,
      'col_112'  => $ogen_malnourish_old,

      'col_113'  => $ugen_dengue_fever_new,
      'col_114'  => $ogen_dengue_fever_new,
      'col_115'  => $ugen_dengue_fever_old,
      'col_116'  => $ogen_dengue_fever_old,

      'col_117'  => $ugen_others_new,
      'col_118'  => $ogen_others_new,
      'col_119'  => $ugen_others_old,
      'col_120'  => $ogen_others_old,

      //Type of Pt
      'col_121'  => $fsw,
      'col_122'  => $msm,
      'col_123'  => $tg,
      'col_124'  => $pwid,
      'col_125'  => $non_kp,

      'col_126'  => $less_15_diagnosis_null_blank,
      'col_127'  => $great_15_diagnosis_null_blank,

      'col_128'  => $lab_inv_only,

      'col_129' => $General_Diag_new_u15,
      'col_130' => $General_Diag_new_o15,
      'col_131' => $General_Diag_old_u15,
      'col_132' => $General_Diag_old_o15,

      'col_133' => $fever_count_data,

    ]);

    return response()->json([
      $pha_check_new_u,
      $pha_check_new,
      $pha_check_old_u,
      $pha_check_old,
      $art_check_new_u,
      $art_check_new,
      $art_check_old_u,
      $art_check_old,
      $prep_check_new_u,
      $prep_check_new,
      $prep_check_old_u,
      $prep_check_old,
      $pmtct_check_new_u,
      $pmtct_check_new,
      $pmtct_check_old_u,
      $pmtct_check_old,
      $anc_check_new_u,
      $anc_check_new,
      $anc_check_old_u,
      $anc_check_old,
      $fp_check_new_u,
      $fp_check_new,
      $fp_check_old_u,
      $fp_check_old,
      $feed_check_new_u,
      $feed_check_new,
      $feed_check_old_u,
      $feed_check_old,

      $gen_check_new_u,
      $gen_check_new,
      $gen_check_old_u,
      $gen_check_old,

      //32 MAM cohort
      $pha_cohort_Yes,
      $art_cohort_Yes,
      $pha_cohort_No,
      $art_cohort_No,

      //36 General Diagnosis

      // Under General
      $ugen_NCD_CVD_new,
      $ogen_NCD_CVD_new,
      $ugen_NCD_CVD_old,
      $ogen_NCD_CVD_old,

      // Under NCD only option
      $ugen_HT_only_new,
      $ogen_HT_only_new,
      $ugen_HT_only_old,
      $ogen_HT_only_old,

      $ugen_DM_only_new,
      $ogen_DM_only_new,
      $ugen_DM_only_old,
      $ogen_DM_only_old,

      $ugen_HT_DM_como_new,
      $ogen_HT_DM_como_new,
      $ugen_HT_DM_como_old,
      $ogen_HT_DM_como_old,

      // Under General 
      $ugen_RTI_Less2wk_new,
      $ogen_RTI_Less2wk_new,
      $ugen_RTI_Less2wk_old,
      $ogen_RTI_Less2wk_old,

      $ugen_RTI_Great2wk_new,
      $ogen_RTI_Great2wk_new,
      $ugen_RTI_Great2wk_old,
      $ogen_RTI_Great2wk_old,

      $ugen_HIV_TB_new,
      $ogen_HIV_TB_new,
      $ugen_HIV_TB_old,
      $ogen_HIV_TB_old,

      $ugen_TB_relate_new,
      $ogen_TB_relate_new,
      $ugen_TB_relate_old,
      $ogen_TB_relate_old,

      $ugen_Covid_relate_new,
      $ogen_Covid_relate_new,
      $ugen_Covid_relate_old,
      $ogen_Covid_relate_old,

      $ugen_Obstructive_pul_new,
      $ogen_Obstructive_pul_new,
      $ugen_Obstructive_pul_old,
      $ogen_Obstructive_pul_old,

      $ugen_Renal_new,
      $ogen_Renal_new,
      $ugen_Renal_old,
      $ogen_Renal_old,

      $ugen_GI_Hep_new,
      $ogen_GI_Hep_new,
      $ugen_GI_Hep_old,
      $ogen_GI_Hep_old,

      $ugen_Gynaecology_new,
      $ogen_Gynaecology_new,
      $ugen_Gynaecology_old,
      $ogen_Gynaecology_old,

      $ugen_Muscul_rheuma_new,
      $ogen_Muscul_rheuma_new,
      $ugen_Muscul_rheuma_old,
      $ogen_Muscul_rheuma_old,

      $ugen_STI_new,
      $ogen_STI_new,
      $ugen_STI_old,
      $ogen_STI_old,

      $ugen_skin_infect_new,
      $ogen_skin_infect_new,
      $ugen_skin_infect_old,
      $ogen_skin_infect_old,

      $ugen_sex_violence_new,
      $ogen_sex_violence_new,
      $ugen_sex_violence_old,
      $ogen_sex_violence_old,

      $ugen_child_abuse_new,
      $ogen_child_abuse_new,
      $ugen_child_abuse_old,
      $ogen_child_abuse_old,

      $ugen_malnourish_new,
      $ogen_malnourish_new,
      $ugen_malnourish_old,
      $ogen_malnourish_old,

      $ugen_dengue_fever_new,
      $ogen_dengue_fever_new,
      $ugen_dengue_fever_old,
      $ogen_dengue_fever_old,

      $ugen_others_new,
      $ogen_others_new,
      $ugen_others_old,
      $ogen_others_old,

      //Type of Pt
      $fsw,
      $msm,
      $tg,
      $pwid,
      $non_kp,

      $less_15_diagnosis_null_blank,
      $great_15_diagnosis_null_blank,


      $lab_inv_only,

      $General_Diag_new_u15,
      $General_Diag_new_o15,

      $General_Diag_old_u15,
      $General_Diag_old_o15,

      $fever_count_data,





      $value_by_date,
    ]);
  }

  public function report(Request $request)
  {
    $exp_format = $request->input('exp_format');

    if ($exp_format == 'mf') {
      $oneRow = DailyConsultationreport::get();
      return Excel::download(new DailyconsultreportExport($oneRow), 'Daily_Consulation.xlsx');
    } else if ($exp_format == 'df') {
      //dd("Daily Format");
      $parseData = json_decode($request->input('neededData'), true);


      return Excel::download(new DailyconsultExport($parseData), 'Daily_Consulation.xlsx');
    }
    // $dailyData=$request->input('dailyData');
    // //return response()->json(["hello from report exp 2"]);
    // return Excel::download(new DailyconsultExport($dailyData), 'Daily_Consulation.xlsx');

  }
}


//

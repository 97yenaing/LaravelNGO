<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Followup_general;

class ConsultationController extends Controller
{
    public function report_view(){
      return view('Reception.report');
    }
    public function report_cal(Request $request){
      $calculator=$request->input('calculate');
      $chart=$request->input('chart');
      $stiRange=$request->input('range');
      $rpMonth=$request->input('month');
      $consultYear=$request->input('year');
      if($calculator==1){
        if($consultYear=="2021"){
          if($stiRange=="onlyOne")//to calculate monthly
          {
            if($rpMonth==9){
                $from=date('2021-09-01');
                $to=date('2021-09-30');
                return $this->dataDrawer($from,$to,$rpMonth,$stiRange);
            }
            if($rpMonth==10){
                $from=date('2021-10-01');
                $to=date('2021-10-31');
                return $this->dataDrawer($from,$to,$rpMonth,$stiRange);
            }
            if($rpMonth==11){
                $from=date('2021-11-01');
                $to=date('2021-11-30');
              return $this->dataDrawer($from,$to,$rpMonth,$stiRange);
            }
            if($rpMonth==12){
                $from=date('2021-12-01');
                $to=date('2021-12-31');
              return $this->dataDrawer($from,$to,$rpMonth,$stiRange);
            }
          }
          if($stiRange=="firstQ")//to calculate First Quarter
          {

          }
          if($stiRange=="secondQ")//to calculate Second Quarter
          {

          }
          if($stiRange=="thirdQ")//to calculate Third Quarter
          {

          }
          if($stiRange=="annual")//to calculate Annual Year
          {

          }
        }
        if($consultYear=="2022"){
          if($stiRange=="onlyOne")//to calculate monthly
          {
            if($rpMonth==1){
                $from=date('2022-01-01');
                $to=date('2022-01-31');
                return $this->dataDrawer($from,$to,$rpMonth,$stiRange);
            }
            if($rpMonth==2){
                $from=date('2022-02-01');
                $to=date('2022-02-28');
                return $this->dataDrawer($from,$to,$rpMonth,$stiRange);
            }
            if($rpMonth==3){
                $from=date('2022-03-01');
                $to=date('2022-03-31');
              return $this->dataDrawer($from,$to,$rpMonth,$stiRange);
            }
            if($rpMonth==4){
                $from=date('2022-04-01');
                $to=date('2022-04-30');
                return $this->dataDrawer($from,$to,$rpMonth,$stiRange);
            }
            if($rpMonth==5){
                $from=date('2022-05-01');
                $to=date('2022-05-31');
                return $this->dataDrawer($from,$to,$rpMonth,$stiRange);
            }
            if($rpMonth==6){
                $from=date('2022-06-01');
                $to=date('2022-06-30');
                return $this->dataDrawer($from,$to,$rpMonth,$stiRange);
            }
            if($rpMonth==7){
                $from=date('2022-07-01');
                $to=date('2022-07-31');
                return $this->dataDrawer($from,$to,$rpMonth,$stiRange);
            }
            if($rpMonth==8){
                $from=date('2022-08-01');
                $to=date('2022-08-28');
                return $this->dataDrawer($from,$to,$rpMonth,$stiRange);
            }
            if($rpMonth==9){
                $from=date('2022-09-01');
                $to=date('2022-09-28');
                return $this->dataDrawer($from,$to,$rpMonth,$stiRange);
            }
            if($rpMonth==10){
                $from=date('2022-10-01');
                $to=date('2022-10-28');
                return $this->dataDrawer($from,$to,$rpMonth,$stiRange);
            }
            if($rpMonth==11){
                $from=date('2022-11-01');
                $to=date('2022-11-28');
                return $this->dataDrawer($from,$to,$rpMonth,$stiRange);
            }
            if($rpMonth==12){
                $from=date('2022-12-01');
                $to=date('2022-12-31');
                return $this->dataDrawer($from,$to,$rpMonth,$stiRange);
            }

          }
          if($stiRange=="firstQ")//to calculate First Quarter
          {

          }
          if($stiRange=="secondQ")//to calculate Second Quarter
          {

          }
          if($stiRange=="thirdQ")//to calculate Third Quarter
          {

          }
          if($stiRange=="annual")//to calculate Annual Year
          {

          }
        }
      }
    }
    //database dbx_query
    public function dataDrawer($from,$to,$rpMonth,$stiRange){
      $generalPt_m_15=0;  $generalPt_f_15=0;  $generalPt_m_16=0;  $generalPt_f_16=0;
      $STI_Pt_m_15=0;     $STI_Pt_f_15=0;     $STI_Pt_m_16=0;     $STI_Pt_f_16=0;
      $pha_Pt_m_15=0;     $pha_Pt_f_15=0;     $pha_Pt_m_16=0;     $pha_Pt_f_16=0;
      $art_Pt_m_15=0;     $art_Pt_f_15=0;     $art_Pt_m_16=0;     $art_Pt_f_16=0;
      $fc_Pt_m_15=0;      $fc_Pt_f_15=0;      $fc_Pt_m_16=0;      $fc_Pt_f_16=0;
      $pmtct_Pt_m_15=0;   $pmtct_Pt_f_15=0;   $pmtct_Pt_m_16=0;   $pmtct_Pt_f_16=0;
      $anc_Pt_m_15=0;     $anc_Pt_f_15=0;     $anc_Pt_m_16=0;     $anc_Pt_f_16=0;
      $u15_Pt_m_15=0;     $u15_Pt_f_15=0;

      $tb_Pt_m_15=0;     $tb_Pt_f_15=0;     $tb_Pt_m_16=0;     $tb_Pt_f_16=0;
      $hyper_Pt_m_15=0;  $hyper_Pt_f_15=0;  $hyper_Pt_m_16=0;  $hyper_Pt_f_16=0;
      $P_hyper_Pt_m_15=0;$P_hyper_Pt_f_15=0;$P_hyper_Pt_m_16=0;$P_hyper_Pt_f_16=0;
      $fp_Pt_f_15=0;     $fp_Pt_f_16=0;
      $dm_Pt_m_15=0;     $dm_Pt_f_15=0;     $dm_Pt_m_16=0;     $dm_Pt_f_16=0;
      $P_dm_Pt_m_15=0;   $P_dm_Pt_f_15=0;   $P_dm_Pt_m_16=0;   $P_dm_Pt_f_16=0;
      $both_Pt_m_15=0;   $both_Pt_f_15=0;   $both_Pt_m_16=0;   $both_Pt_f_16=0;
      $P_both_Pt_m_15=0; $P_both_Pt_f_15=0; $P_both_Pt_m_16=0; $P_both_Pt_f_16=0;
      $fever_Pt_m_15=0;  $fever_Pt_f_15=0;  $fever_Pt_m_16=0;  $fever_Pt_f_16=0;

      $generalPt_m_15_N=0;  $generalPt_f_15_N=0;  $generalPt_m_16_N=0;  $generalPt_f_16_N=0;
      $STI_Pt_m_15_N=0;     $STI_Pt_f_15_N=0;     $STI_Pt_m_16_N=0;     $STI_Pt_f_16_N=0;
      $pha_Pt_m_15_N=0;     $pha_Pt_f_15_N=0;     $pha_Pt_m_16_N=0;     $pha_Pt_f_16_N=0;
      $art_Pt_m_15_N=0;     $art_Pt_f_15_N=0;     $art_Pt_m_16_N=0;     $art_Pt_f_16_N=0;
      $fc_Pt_m_15_N=0;      $fc_Pt_f_15_N=0;      $fc_Pt_m_16_N=0;      $fc_Pt_f_16_N=0;
      $pmtct_Pt_m_15_N=0;   $pmtct_Pt_f_15_N=0;   $pmtct_Pt_m_16_N=0;   $pmtct_Pt_f_16_N=0;
      $anc_Pt_m_15_N=0;     $anc_Pt_f_15_N=0;     $anc_Pt_m_16_N=0;     $anc_Pt_f_16_N=0;
      $u15_N_Pt_m_15_N=0;     $u15_N_Pt_f_15_N=0;

      $tb_Pt_m_15_N=0;     $tb_Pt_f_15_N=0;     $tb_Pt_m_16_N=0;     $tb_Pt_f_16_N=0;
      $hyper_Pt_m_15_N=0;  $hyper_Pt_f_15_N=0;  $hyper_Pt_m_16_N=0;  $hyper_Pt_f_16_N=0;
      $P_hyper_Pt_m_15_N=0;$P_hyper_Pt_f_15_N=0;$P_hyper_Pt_m_16_N=0;$P_hyper_Pt_f_16_N=0;
      $fp_Pt_f_15_N=0;     $fp_Pt_f_16_N=0;
      $dm_Pt_m_15_N=0;     $dm_Pt_f_15_N=0;     $dm_Pt_m_16_N=0;     $dm_Pt_f_16_N=0;
      $P_dm_Pt_m_15_N=0;   $P_dm_Pt_f_15_N=0;   $P_dm_Pt_m_16_N=0;   $P_dm_Pt_f_16_N=0;
      $both_Pt_m_15_N=0;   $both_Pt_f_15_N=0;   $both_Pt_m_16_N=0;   $both_Pt_f_16_N=0;
      $P_both_Pt_m_15_N=0; $P_both_Pt_f_15_N=0; $P_both_Pt_m_16_N=0; $P_both_Pt_f_16_N=0;
      $fever_Pt_m_15_N=0;  $fever_Pt_f_15_N=0;  $fever_Pt_m_16_N=0;  $fever_Pt_f_16_N=0;
      //attendence
      $rp_month_consult =Followup_general::whereBetween('Visit Date', [$from, $to])->get();
      $rp_month_ID =array();
      for ($i=0; $i <count($rp_month_consult) ; $i++){
        $rp_month_ID[]=intval($rp_month_consult[$i]['id']); // this is report month's all ID
      }
      $counter = count($rp_month_consult);
      for ($i=0; $i < count($rp_month_consult); $i++) {

        $rp_pt_rows = Followup_general::whereBetween('Visit Date', [$from, $to])
                              ->orderBy('Visit Date')
                              ->where('id',$rp_month_ID[$i])
                              ->get();
        $PtAge = intval($rp_pt_rows[0]['Agey']);
        $PtGender = $rp_pt_rows[0]['Gender'];
        $PtNew_Old = $rp_pt_rows[0]['New_Old'];
        $Ptype = $rp_pt_rows[0]['Patient Type'];
        $Ptype_sub = $rp_pt_rows[0]['Patient Type Sub'];
        $Ptype_sub1 = $rp_pt_rows[0]['Patient Type Sub1'];
        if($PtNew_Old=="Old"){
          if($PtGender=="male"){
            if($PtAge < 15){
              if($Ptype =="General"){
                $generalPt_m_15 +=1;
              }
              if($Ptype=="STI"){
                $STI_Pt_m_15 +=1;
              }
              if($Ptype =="PHA"){
                $pha_Pt_m_15 +=1;
              }
              if($Ptype =="ART"){
                $art_Pt_m_15 +=1;
              }
              if($Ptype =="FC"){
                $fc_Pt_m_15 +=1;
              }
              if($Ptype =="PMTCT"){
                $pmtct_Pt_m_15 +=1;
              }
              if($Ptype =="ANC"){
                $anc_Pt_m_15 +=1;
              }
              if($Ptype =="<15"){
                $generalPt_m_15 +=1;
                $u15_Pt_m_15 +=1;
              }
              if($Ptype_sub =="TB"){
                $tb_Pt_m_15 +=1;
              }
              if($Ptype_sub == "Hypertension"){
                if($Ptype_sub1=="Hiv(Pos)"){
                  $P_hyper_Pt_m_15 +=1;
                }
                if($Ptype_sub1=="Hiv(Neg)"){
                  $hyper_Pt_m_15 +=1;
                }

              }
              if($Ptype_sub == "DM"){
                if($Ptype_sub1=="Hiv(Pos)"){
                  $P_dm_Pt_m_15 +=1;
                }
                if($Ptype_sub1=="Hiv(Neg)"){
                  $dm_Pt_m_15 +=1;
                }

              }
              if($Ptype_sub =="Both(Hypertension-DM)"){
                if($Ptype_sub1=="Hiv(Pos)"){
                  $P_both_Pt_m_15 +=1;
                }
                if($Ptype_sub1=="Hiv(Neg)"){
                  $both_Pt_m_15 +=1;
                }

              }
              if($Ptype_sub =="Fever"){
                $fever_Pt_m_15 +=1;
              }

            }
            if($PtAge >= 15){
              if($Ptype=="General"){
                $generalPt_m_16 +=1;
              }
              if($Ptype=="STI"){
                $STI_Pt_m_16 +=1;
              }
              if($Ptype=="PHA"){
                $pha_Pt_m_16 +=1;
              }
              if($Ptype=="ART"){
                $art_Pt_m_16 +=1;
              }
              if($Ptype=="FC"){
                $fc_Pt_m_16 +=1;
              }
              if($Ptype=="PMTCT"){
                $pmtct_Pt_m_16 +=1;
              }
              if($Ptype=="ANC"){
                $anc_Pt_m_16 +=1;
              }
              if($Ptype_sub =="TB"){
                $tb_Pt_m_16 +=1;
              }
              if($Ptype_sub == "Hypertension"){
                if($Ptype_sub1=="Hiv(Pos)"){
                  $P_hyper_Pt_m_16 +=1;
                }
                if($Ptype_sub1=="Hiv(Neg)"){
                  $hyper_Pt_m_16 +=1;
                }


              }
              if($Ptype_sub == "DM"){
                if($Ptype_sub1=="Hiv(Pos)"){
                  $P_dm_Pt_m_16 +=1;
                }
                if($Ptype_sub1=="Hiv(Neg)"){
                  $dm_Pt_m_16 +=1;
                }

              }
              if($Ptype_sub =="Both(Hypertension-DM)"){
                if($Ptype_sub1=="Hiv(Pos)"){
                  $P_both_Pt_m_16 +=1;
                }
                if($Ptype_sub1=="Hiv(Neg)"){
                  $both_Pt_m_16 +=1;
                }

              }
              if($Ptype_sub =="Fever"){
                $fever_Pt_m_16 +=1;
              }
            }
           }
          if($PtGender=="female"){
            if($PtAge<15){
              if($Ptype =="General"){
                $generalPt_f_15 +=1;
              }
              if($Ptype=="STI"){
                $STI_Pt_f_15 +=1;
              }
              if($Ptype =="PHA"){
                $pha_Pt_f_15 +=1;
              }
              if($Ptype =="ART"){
                $art_Pt_f_15 +=1;
              }
              if($Ptype =="FC"){
                $fc_Pt_f_15 +=1;
              }
              if($Ptype =="PMTCT"){
                $pmtct_Pt_f_15 +=1;
              }
              if($Ptype =="ANC"){
                $anc_Pt_f_15 +=1;
              }
              if($Ptype =="<15"){
                $generalPt_f_16 +=1;
                $u15_Pt_f_15 +=1;
              }
              if($Ptype_sub =="TB"){
                $tb_Pt_f_15 +=1;
              }
              if($Ptype_sub == "Hypertension"){
                if($Ptype_sub1=="Hiv(Pos)"){
                  $P_hyper_Pt_f_15 +=1;
                }
                if($Ptype_sub1=="Hiv(Neg)"){
                  $hyper_Pt_f_15 +=1;
                }

              }
              if($Ptype_sub == "FP"){
                $fp_Pt_f_15 +=1;
              }
              if($Ptype_sub == "DM"){
                if($Ptype_sub1=="Hiv(Pos)"){
                  $P_dm_Pt_f_15 +=1;
                }
                if($Ptype_sub1=="Hiv(Neg)"){
                  $dm_Pt_f_15 +=1;
                }

              }
              if($Ptype_sub =="Both(Hypertension-DM)"){
                if($Ptype_sub1=="Hiv(Pos)"){
                  $P_both_Pt_f_15 +=1;
                }
                if($Ptype_sub1=="Hiv(Neg)"){
                  $both_Pt_f_15 +=1;
                }

              }
              if($Ptype_sub =="Fever"){
                $fever_Pt_f_15 +=1;
              }
            }
            if($PtAge>=15){
              if($Ptype=="General"){
                $generalPt_f_16 +=1;
              }
              if($Ptype=="STI"){
                $STI_Pt_f_16 +=1;
              }
              if($Ptype =="PHA"){
                $pha_f_16 +=1;
              }
              if($Ptype =="ART"){
                $art_f_16 +=1;
              }
              if($Ptype =="FC"){
                $fc_f_16 +=1;
              }
              if($Ptype =="PMTCT"){
                $pmtct_f_16 +=1;
              }
              if($Ptype =="ANC"){
                $anc_f_16 +=1;
              }
              if($Ptype_sub =="TB"){
                $tb_Pt_f_16 +=1;
              }
              if($Ptype_sub == "Hypertension"){
                if($Ptype_sub1=="Hiv(Pos)"){
                  $P_hyper_Pt_f_16 +=1;
                }
                if($Ptype_sub1=="Hiv(Neg)"){
                  $hyper_Pt_f_16 +=1;
                }

              }
              if($Ptype_sub == "FP"){
                $fp_Pt_f_16 +=1;
              }
              if($Ptype_sub == "DM"){
                if($Ptype_sub1=="Hiv(Pos)"){
                  $P_dm_Pt_f_16 +=1;
                }
                if($Ptype_sub1=="Hiv(Neg)"){
                  $dm_Pt_f_16 +=1;
                }

              }
              if($Ptype_sub =="Both(Hypertension-DM)"){
                if($Ptype_sub1=="Hiv(Pos)"){
                  $P_both_Pt_f_16 +=1;
                }
                if($Ptype_sub1=="Hiv(Neg)"){
                  $both_Pt_f_16 +=1;
                }

              }
              if($Ptype_sub =="Fever"){
                $fever_Pt_f_16 +=1;
              }
            }
            }
        }
        if($PtNew_Old=="New"){
          if($PtGender=="male"){
            if($PtAge < 15){
              if($Ptype =="General"){
                $generalPt_m_15_N +=1;
              }
              if($Ptype=="STI"){
                $STI_Pt_m_15_N +=1;
              }
              if($Ptype =="PHA"){
                $pha_Pt_m_15_N +=1;
              }
              if($Ptype =="ART"){
                $art_Pt_m_15_N +=1;
              }
              if($Ptype =="FC"){
                $fc_Pt_m_15_N +=1;
              }
              if($Ptype =="PMTCT"){
                $pmtct_Pt_m_15_N +=1;
              }
              if($Ptype =="ANC"){
                $anc_Pt_m_15_N +=1;
              }
              if($Ptype =="<15_N"){
                $generalPt_m_15_N +=1;
                $u15_N_Pt_m_15_N +=1;
              }
              if($Ptype_sub =="TB"){
                $tb_Pt_m_15_N +=1;
              }
              if($Ptype_sub == "Hypertension"){
                if($Ptype_sub1=="Hiv(Pos)"){
                  $P_hyper_Pt_m_15_N +=1;
                }
                if($Ptype_sub1=="Hiv(Neg)"){
                  $hyper_Pt_m_15_N +=1;
                }

              }
              if($Ptype_sub == "DM"){
                if($Ptype_sub1=="Hiv(Pos)"){
                  $P_dm_Pt_m_15_N +=1;
                }
                if($Ptype_sub1=="Hiv(Neg)"){
                  $dm_Pt_m_15_N +=1;
                }

              }
              if($Ptype_sub =="Both(Hypertension-DM)"){
                if($Ptype_sub1=="Hiv(Pos)"){
                  $P_both_Pt_m_15_N +=1;
                }
                if($Ptype_sub1=="Hiv(Neg)"){
                  $both_Pt_m_15_N +=1;
                }

              }
              if($Ptype_sub =="Fever"){
                $fever_Pt_m_15_N +=1;
              }

            }
            if($PtAge >= 15){
              if($Ptype=="General"){
                $generalPt_m_16_N +=1;
              }
              if($Ptype=="STI"){
                $STI_Pt_m_16_N +=1;
              }
              if($Ptype=="PHA"){
                $pha_Pt_m_16_N +=1;
              }
              if($Ptype=="ART"){
                $art_Pt_m_16_N +=1;
              }
              if($Ptype=="FC"){
                $fc_Pt_m_16_N +=1;
              }
              if($Ptype=="PMTCT"){
                $pmtct_Pt_m_16_N +=1;
              }
              if($Ptype=="ANC"){
                $anc_Pt_m_16_N +=1;
              }
              if($Ptype_sub =="TB"){
                $tb_Pt_m_16_N +=1;
              }
              if($Ptype_sub == "Hypertension"){
                if($Ptype_sub1=="Hiv(Pos)"){
                  $P_hyper_Pt_m_16_N +=1;
                }
                if($Ptype_sub1=="Hiv(Neg)"){
                  $hyper_Pt_m_16_N +=1;
                }


              }
              if($Ptype_sub == "DM"){
                if($Ptype_sub1=="Hiv(Pos)"){
                  $P_dm_Pt_m_16_N +=1;
                }
                if($Ptype_sub1=="Hiv(Neg)"){
                  $dm_Pt_m_16_N +=1;
                }

              }
              if($Ptype_sub =="Both(Hypertension-DM)"){
                if($Ptype_sub1=="Hiv(Pos)"){
                  $P_both_Pt_m_16_N +=1;
                }
                if($Ptype_sub1=="Hiv(Neg)"){
                  $both_Pt_m_16_N +=1;
                }

              }
              if($Ptype_sub =="Fever"){
                $fever_Pt_m_16_N +=1;
              }
            }
           }
          if($PtGender=="female"){
            if($PtAge<15){
              if($Ptype =="General"){
                $generalPt_f_15_N +=1;
              }
              if($Ptype=="STI"){
                $STI_Pt_f_15_N +=1;
              }
              if($Ptype =="PHA"){
                $pha_Pt_f_15_N +=1;
              }
              if($Ptype =="ART"){
                $art_Pt_f_15_N +=1;
              }
              if($Ptype =="FC"){
                $fc_Pt_f_15_N +=1;
              }
              if($Ptype =="PMTCT"){
                $pmtct_Pt_f_15_N +=1;
              }
              if($Ptype =="ANC"){
                $anc_Pt_f_15_N +=1;
              }
              if($Ptype =="<15"){
                $generalPt_f_16_N +=1;
                $u15_N_Pt_f_15_N +=1;
              }
              if($Ptype_sub =="TB"){
                $tb_Pt_f_15_N +=1;
              }
              if($Ptype_sub == "Hypertension"){
                if($Ptype_sub1=="Hiv(Pos)"){
                  $P_hyper_Pt_f_15_N +=1;
                }
                if($Ptype_sub1=="Hiv(Neg)"){
                  $hyper_Pt_f_15_N +=1;
                }

              }
              if($Ptype_sub == "FP"){
                $fp_Pt_f_15_N +=1;
              }
              if($Ptype_sub == "DM"){
                if($Ptype_sub1=="Hiv(Pos)"){
                  $P_dm_Pt_f_15_N +=1;
                }
                if($Ptype_sub1=="Hiv(Neg)"){
                  $dm_Pt_f_15_N +=1;
                }

              }
              if($Ptype_sub =="Both(Hypertension-DM)"){
                if($Ptype_sub1=="Hiv(Pos)"){
                  $P_both_Pt_f_15_N +=1;
                }
                if($Ptype_sub1=="Hiv(Neg)"){
                  $both_Pt_f_15_N +=1;
                }

              }
              if($Ptype_sub =="Fever"){
                $fever_Pt_f_15_N +=1;
              }
            }
            if($PtAge>=15){
              if($Ptype=="General"){
                $generalPt_f_16_N +=1;
              }
              if($Ptype=="STI"){
                $STI_Pt_f_16_N +=1;
              }
              if($Ptype =="PHA"){
                $pha_f_16_N +=1;
              }
              if($Ptype =="ART"){
                $art_f_16_N +=1;
              }
              if($Ptype =="FC"){
                $fc_f_16_N +=1;
              }
              if($Ptype =="PMTCT"){
                $pmtct_f_16_N +=1;
              }
              if($Ptype =="ANC"){
                $anc_f_16_N +=1;
              }
              if($Ptype_sub =="TB"){
                $tb_Pt_f_16_N +=1;
              }
              if($Ptype_sub == "Hypertension"){
                if($Ptype_sub1=="Hiv(Pos)"){
                  $P_hyper_Pt_f_16_N +=1;
                }
                if($Ptype_sub1=="Hiv(Neg)"){
                  $hyper_Pt_f_16_N +=1;
                }

              }
              if($Ptype_sub == "FP"){
                $fp_Pt_f_16_N +=1;
              }
              if($Ptype_sub == "DM"){
                if($Ptype_sub1=="Hiv(Pos)"){
                  $P_dm_Pt_f_16_N +=1;
                }
                if($Ptype_sub1=="Hiv(Neg)"){
                  $dm_Pt_f_16_N +=1;
                }

              }
              if($Ptype_sub =="Both(Hypertension-DM)"){
                if($Ptype_sub1=="Hiv(Pos)"){
                  $P_both_Pt_f_16_N +=1;
                }
                if($Ptype_sub1=="Hiv(Neg)"){
                  $both_Pt_f_16_N +=1;
                }

              }
              if($Ptype_sub =="Fever"){
                $fever_Pt_f_16_N +=1;
              }
            }
            }
        }

      }
      return response()->json([

        $generalPt_m_15,
        $generalPt_f_15,
        $generalPt_m_16,
        $generalPt_f_16,
        $STI_Pt_m_15,
        $STI_Pt_f_15,
        $STI_Pt_m_16,
        $STI_Pt_f_16,
        $pha_Pt_m_15,
        $pha_Pt_f_15,
        $pha_Pt_m_16,
        $pha_Pt_f_16,
        $art_Pt_m_15,
        $art_Pt_f_15,
        $art_Pt_m_16,
        $art_Pt_f_16,
        $fc_Pt_m_15,
        $fc_Pt_f_15,
        $fc_Pt_m_16,
        $fc_Pt_f_16,
        $pmtct_Pt_m_15,
        $pmtct_Pt_f_15,
        $pmtct_Pt_m_16,
        $pmtct_Pt_f_16,
        $anc_Pt_m_15,
        $anc_Pt_f_15,
        $anc_Pt_m_16,
        $anc_Pt_f_16,
        $u15_Pt_m_15,
        $u15_Pt_f_15,
        $tb_Pt_m_15,
        $tb_Pt_f_15,
        $tb_Pt_m_16,
        $tb_Pt_f_16,
        $hyper_Pt_m_15,
        $hyper_Pt_f_15,
        $hyper_Pt_m_16,
        $hyper_Pt_f_16,
        $fp_Pt_f_15,
        $fp_Pt_f_16,
        $dm_Pt_m_15,
        $dm_Pt_f_15,
        $dm_Pt_m_16,
        $dm_Pt_f_16,
        $both_Pt_m_15,
        $both_Pt_f_15,
        $both_Pt_m_16,
        $both_Pt_f_16,
        $fever_Pt_m_15,
        $fever_Pt_f_15,
        $fever_Pt_m_16,
        $fever_Pt_f_16,
        $P_hyper_Pt_m_15,
        $P_hyper_Pt_f_15,
        $P_hyper_Pt_m_16,
        $P_hyper_Pt_f_16,
        $P_dm_Pt_m_15,
        $P_dm_Pt_f_15,
        $P_dm_Pt_m_16,
        $P_dm_Pt_f_16,
        $P_both_Pt_m_15,
        $P_both_Pt_f_15,
        $P_both_Pt_m_16,
        $P_both_Pt_f_16,

        $generalPt_m_15_N,///////////////
        $generalPt_f_15_N,
        $generalPt_m_16_N,
        $generalPt_f_16_N,
        $STI_Pt_m_15_N,   ///////////////
        $STI_Pt_f_15_N,
        $STI_Pt_m_16_N,
        $STI_Pt_f_16_N,
        $pha_Pt_m_15_N,  ///////////
        $pha_Pt_f_15_N,
        $pha_Pt_m_16_N,
        $pha_Pt_f_16_N,
        $art_Pt_m_15_N,   //////////////
        $art_Pt_f_15_N,
        $art_Pt_m_16_N,
        $art_Pt_f_16_N,
        $fc_Pt_m_15_N,    ///////////
        $fc_Pt_f_15_N,
        $fc_Pt_m_16_N,
        $fc_Pt_f_16_N,
        $pmtct_Pt_m_15_N,   ///////////
        $pmtct_Pt_f_15_N,
        $pmtct_Pt_m_16_N,
        $pmtct_Pt_f_16_N,
        $anc_Pt_m_15_N,    /////////
        $anc_Pt_f_15_N,
        $anc_Pt_m_16_N,
        $anc_Pt_f_16_N,
        $u15_N_Pt_m_15_N, //////////
        $u15_N_Pt_f_15_N,
        $tb_Pt_m_15_N,    ///////////
        $tb_Pt_f_15_N,
        $tb_Pt_m_16_N,
        $tb_Pt_f_16_N,
        $hyper_Pt_m_15_N, ///////////
        $hyper_Pt_f_15_N,
        $hyper_Pt_m_16_N,
        $hyper_Pt_f_16_N,
        $P_hyper_Pt_m_15_N, ////////////
        $P_hyper_Pt_f_15_N,
        $P_hyper_Pt_m_16_N,
        $P_hyper_Pt_f_16_N,
        $fp_Pt_f_15_N,    /////////////
        $fp_Pt_f_16_N,
        $dm_Pt_m_15_N,  /////////////
        $dm_Pt_f_15_N,
        $dm_Pt_m_16_N,
        $dm_Pt_f_16_N,
        $P_dm_Pt_m_15_N,  ////////////
        $P_dm_Pt_f_15_N,
        $P_dm_Pt_m_16_N,
        $P_dm_Pt_f_16_N,
        $both_Pt_m_15_N,   ////////////
        $both_Pt_f_15_N,
        $both_Pt_m_16_N,
        $both_Pt_f_16_N,
        $P_both_Pt_m_15_N, ////////////
        $P_both_Pt_f_15_N,
        $P_both_Pt_m_16_N,
        $P_both_Pt_f_16_N,
        $fever_Pt_m_15_N,  ///////////
        $fever_Pt_f_15_N,
        $fever_Pt_m_16_N,
        $fever_Pt_f_16_N,
      ]);

    }
}

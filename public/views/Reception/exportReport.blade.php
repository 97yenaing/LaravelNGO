<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Export Excel </title>
    <style>
    table {
      border-collapse: collapse;
      font-size: 12px;
    }
    th, td {
      border: 2px solid black;
      height:50px;
    }
  </style>
</head>
<body>
    <div class="container mt-5 text-center">
      <br>
        <!-- <h2 style="height:100px;">Clinic Consultations (overall) Report </h2> -->
        <form action="{{ route('reception_report_export') }}" method="POST" >
          <table>
            <thead>
              <tr><td style="text-align:center" colspan="9">Clinic Report (No 1)</td></tr>
              <tr><td style="text-align:center" colspan="9">Clinic Consultations (overall) report</td></tr>
              <tr><td style="text-align:center" colspan="9">Consultation numbers by category of patients</td></tr>
            </thead>
            <tbody>
              <tr>
                <td style="width:30px;">Clinic Name - HTY A</td>
              </tr>
              <tr>
                <td>Reporting Month</td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              
            </tbody>
            
          </table>

        
       
         <table class="table table-bordered" style="border: 2px solid red;">
            <thead>
              @foreach($data as  $value)
                <tr>
                    <td style="width:200px;"></td>
                    <td style="border: 2px solid red; width:80px;background-color:#d6dce5;"colspan="2" >  New </td>
                    <td style="width:80px;background-color:#d6dce5;" colspan="2"> Old </td>
                    <td></td>
                    <td style="width:300px;background-color:#d6dce5;"> Disease Categories for general patients</td>
                    <td style="width:80px;background-color:#d6dce5;" colspan="2">New</td>
                    <td style="width:80px;background-color:#d6dce5;" colspan="2">Old</td>
                    </tr>
                    <tr>
                    <td ></td>
                    <td style="background-color:#d6dce5;">&lt; 15 yrs</td>
                    <td style="background-color:#d6dce5;">&gt;= 15 yrs</td>
                    <td style="background-color:#d6dce5;">&lt; 15 yrs</td>
                    <td style="background-color:#d6dce5;">&gt;= 15 yrs</td>
                    <td></td>
                    <td style="background-color:#d6dce5;"></td>
                    <td style="background-color:#d6dce5;">&lt; 15 yrs</td>
                    <td style="background-color:#d6dce5;">&gt;= 15 yrs</td>
                    <td style="background-color:#d6dce5;">&lt; 15 yrs</td>
                    <td style="background-color:#d6dce5;">&gt;= 15 yrs</td>
                </tr>
            </thead>
          <tbody>
            <!-- G1 section -->
            <tr class="table-warning">
              <td>PHA</td>
              <td id="pha_u15_new">{{ $value['col_1'] }}</td>
              <td id="pha_o15_new">{{ $value['col_2'] }}</td>
              <td id="pha_u15_old">{{ $value['col_3'] }}</td>
              <td id="pha_o15_old">{{ $value['col_4'] }}</td>

              <td></td>

              <td>NCD/Cerebro-vascular disease CVD</td>
              <td id="ugen_ncd_cvd_new"> {{ $value[ 'col_37'] }} </td>
              <td id="ogen_ncd_cvd_new"> {{ $value[ 'col_38'] }} </td>
              <td id="ugen_ncd_cvd_old"> {{ $value[ 'col_39'] }} </td>
              <td id="ogen_ncd_cvd_old"> {{ $value[ 'col_40'] }} </td>
            </tr>
            <tr class="table-success">
              <td>ART</td>
              <td id="art_u15_new"> {{ $value[ 'col_5'] }} </td>
              <td id="art_o15_new"> {{ $value[ 'col_6'] }} </td>
              <td id="art_u15_old"> {{ $value[ 'col_7'] }} </td>
              <td id="art_o15_old"> {{ $value[ 'col_8'] }} </td>

              <td>  </td>

              <td>Hypertension only</td>
              <td id="ugen_HT_only_new"> {{ $value[ 'col_41'] }} </td>
              <td id="ogen_HT_only_new"> {{ $value[ 'col_42'] }} </td>
              <td id="ugen_HT_only_old"> {{ $value[ 'col_43'] }} </td>
              <td id="ogen_HT_only_old"> {{ $value[ 'col_44'] }} </td>
            </tr>
            <tr class="table-success">
              <td>PrEP</td>
              <td id="prep_u15_new"> {{ $value[ 'col_9'] }} </td>
              <td id="prep_o15_new"> {{ $value[ 'col_10'] }} </td>
              <td id="prep_u15_old"> {{ $value[ 'col_11'] }} </td>
              <td id="prep_o15_old"> {{ $value[ 'col_12'] }} </td>
             
              <td> </td>

              <td>DM only</td>
              <td id="ugen_DM_only_new"> {{ $value[ 'col_45'] }} </td>
              <td id="ogen_DM_only_new"> {{ $value[ 'col_46'] }} </td>
              <td id="ugen_DM_only_old"> {{ $value[ 'col_47'] }} </td>
              <td id="ogen_DM_only_old"> {{ $value[ 'col_48'] }} </td>
            </tr>
            <tr class="table-success">
              <td>PMTCT</td>
              <td id="pmtct_u15_new"> {{ $value[ 'col_13'] }} </td>
              <td id="pmtct_o15_new"> {{ $value[ 'col_14'] }} </td>
              <td id="pmtct_u15_old"> {{ $value[ 'col_15'] }} </td>
              <td id="pmtct_o15_old"> {{ $value[ 'col_16'] }} </td>
             
              <td> </td>

              <td>H/T &amp; DM comorbidity</td>
              <td id="ugen_HT_DM_como_new"> {{ $value[ 'col_49'] }} </td>
              <td id="ogen_HT_DM_como_new"> {{ $value[ 'col_50'] }} </td>
              <td id="ugen_HT_DM_como_old"> {{ $value[ 'col_51'] }} </td>
              <td id="ogen_HT_DM_como_old"> {{ $value[ 'col_52'] }} </td>
            </tr>
            <tr class="table-success">
              <td>ANC</td>
              <td id="anc_u15_new"> {{ $value[ 'col_17'] }} </td>
              <td id="anc_o15_new"> {{ $value[ 'col_18'] }} </td>
              <td id="anc_u15_old"> {{ $value[ 'col_19'] }} </td>
              <td id="anc_o15_old"> {{ $value[ 'col_20'] }} </td>
              
              <td>  </td>

              <td>RTI &lt; 2wks</td>
              <td id="ugen_RTI_Less2wk_new"> {{ $value[ 'col_53'] }} </td>
              <td id="ogen_RTI_Less2wk_new"> {{ $value[ 'col_54'] }} </td>
              <td id="ugen_RTI_Less2wk_old"> {{ $value[ 'col_55'] }} </td>
              <td id="ogen_RTI_Less2wk_old"> {{ $value[ 'col_56'] }} </td>
            </tr>
            <tr class="table-success">
              <td>FP</td>
              <td id="fp_u15_new"> {{ $value[ 'col_21'] }} </td>
              <td id="fp_o15_new"> {{ $value[ 'col_22'] }} </td>
              <td id="fp_u15_old"> {{ $value[ 'col_23'] }} </td>
              <td id="fp_o15_old"> {{ $value[ 'col_24'] }} </td>
             
              <td>  </td>

              <td>RTI &gt;= 2wks</td>
              <td id="ugen_RTI_Great2wk_new"> {{ $value[ 'col_57'] }} </td>
              <td id="ogen_RTI_Great2wk_new"> {{ $value[ 'col_58'] }} </td>
              <td id="ugen_RTI_Great2wk_old"> {{ $value[ 'col_59'] }} </td>
              <td id="ogen_RTI_Great2wk_old"> {{ $value[ 'col_60'] }} </td>
            </tr>
            <tr class="table-success">
              <td>Feeding Centre</td>
              <td id="feed_u15_new"> {{ $value[ 'col_25'] }} </td>
              <td id="feed_o15_new"> {{ $value[ 'col_26'] }} </td>
              <td id="feed_u15_old"> {{ $value[ 'col_27'] }} </td>
              <td id="feed_o15_old"> {{ $value[ 'col_28'] }} </td>
              
              <td>  </td>

              <td>HIV (-) TB</td>
              <td id="ugen_HIV_TB_new"> {{ $value[ 'col_61'] }} </td>
              <td id="ogen_HIV_TB_new"> {{ $value[ 'col_62'] }} </td>
              <td id="ugen_HIV_TB_old"> {{ $value[ 'col_63'] }} </td>
              <td id="ogen_HIV_TB_old"> {{ $value[ 'col_64'] }} </td>
            </tr> 
            
            <tr class="table-success">
              <td>General</td>
              <td id="gen_u15_new"> {{ $value[ 'col_129'] }} </td>
              <td id="gen_o15_new"> {{ $value[ 'col_130'] }} </td>
              <td id="gen_u15_old"> {{ $value[ 'col_131'] }} </td>
              <td id="gen_o15_old"> {{ $value[ 'col_132'] }} </td>
              
              <td>  </td>

              <td>TB related consultation</td>
              <td id="ugen_TB_relate_new"> {{ $value[ 'col_65'] }} </td>
              <td id="ogen_TB_relate_new"> {{ $value[ 'col_66'] }} </td>
              <td id="ugen_TB_relate_old"> {{ $value[ 'col_67'] }} </td>
              <td id="ogen_TB_relate_old"> {{ $value[ 'col_68'] }} </td>
            </tr>
            @php
                    $total_u15_new = $value['col_1'] + 
                                      $value['col_5']+
                                      $value['col_9']+
                                      $value['col_13']+
                                      $value['col_17']+
                                      $value['col_21']+
                                      $value['col_25']+
                                      $value['col_129'];
                    $total_o15_new = $value['col_2'] + 
                                      $value['col_6']+
                                      $value['col_10']+
                                      $value['col_14']+
                                      $value['col_18']+
                                      $value['col_22']+
                                      $value['col_26']+
                                      $value['col_130'];
                    $total_u15_old = $value['col_3'] + 
                                      $value['col_7']+
                                      $value['col_11']+
                                      $value['col_15']+
                                      $value['col_19']+
                                      $value['col_23']+
                                      $value['col_27']+
                                      $value['col_131'];
                    $total_o15_old = $value['col_4'] + 
                                      $value['col_8']+
                                      $value['col_12']+
                                      $value['col_16']+
                                      $value['col_20']+
                                      $value['col_24']+
                                      $value['col_28']+
                                      $value['col_132'];
                @endphp
            <tr class="table-success">
              <td>Total</td>
              <td id="total_u15_new"> {{ $total_u15_new }} </td>
              <td id="total_o15_new"> {{ $total_o15_new }} </td>
              <td id="total_u15_old"> {{ $total_u15_old }} </td>
              <td id="total_o15_old" > {{ $total_o15_old }} </td>
              
              <td>  </td>

              <td>Covid related consultation</td>
              <td id="ugen_Covid_relate_new"> {{ $value[ 'col_69'] }} </td>
              <td id="ogen_Covid_relate_new"> {{ $value[ 'col_70'] }} </td>
              <td id="ugen_Covid_relate_old"> {{ $value[ 'col_71'] }} </td>
              <td id="ogen_Covid_relate_old"> {{ $value[ 'col_72'] }} </td>
            </tr>

            <tr class="">
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              
              <td></td>

              <td>Obstructive pul. D/s</td>
              <td id="ugen_Obstructive_pul_new"> {{ $value[ 'col_73'] }} </td>
              <td id="ogen_Obstructive_pul_new"> {{ $value[ 'col_74'] }} </td>
              <td id="ugen_Obstructive_pul_old"> {{ $value[ 'col_75'] }} </td>
              <td id="ogen_Obstructive_pul_old"> {{ $value[ 'col_76'] }} </td>
            </tr>
            <tr class="">
              <td></td>
              <td >PHA</td>
              <td >ART</td>
              <td></td>
              <td></td>
              
              <td></td>

              <td>Renal D/s</td>
              <td id="ugen_Renal_new"> {{ $value[ 'col_77'] }} </td>
              <td id="ogen_Renal_new"> {{ $value[ 'col_78'] }} </td>
              <td id="ugen_Renal_old"> {{ $value[ 'col_79'] }} </td>
              <td id="ogen_Renal_old"> {{ $value[ 'col_80'] }} </td>
            </tr>
            <tr class="">
              <td>MAM cohort</td>
              <td id="pha_mam_cohort"> {{ $value[ 'col_33'] }} </td>
              <td id="art_mam_cohort"> {{ $value[ 'col_34'] }} </td>
              <td></td>
              <td></td>
              
              <td></td>

              <td>GI &amp; Hepatobiliary</td>
              <td id="ugen_GI_Hep_new"> {{ $value[ 'col_81'] }} </td>
              <td id="ogen_GI_Hep_new"> {{ $value[ 'col_82'] }} </td>
              <td id="ugen_GI_Hep_old"> {{ $value[ 'col_83'] }} </td>
              <td id="ogen_GI_Hep_old"> {{ $value[ 'col_84'] }} </td>
            </tr>
            <tr class="">
              <td>Other cohort</td>
              <td id="pha_other_cohort"> {{ $value[ 'col_35'] }} </td>
              <td id="art_other_cohort" > {{ $value[ 'col_36'] }} </td>
              <td></td>
              <td></td>
              
              <td></td>

              <td>Gynaecology</td>
              <td id="ugen_Gynaecology_new"> {{ $value[ 'col_85'] }} </td>
              <td id="ogen_Gynaecology_new"> {{ $value[ 'col_86'] }} </td>
              <td id="ugen_Gynaecology_old"> {{ $value[ 'col_87'] }} </td>
              <td id="ogen_Gynaecology_old"> {{ $value[ 'col_88'] }} </td>
            </tr>
            <tr class="">
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              
                <td></td>

              <td>Musculoskeleton and rheumatology</td>
              <td id="ugen_Muscul_rheuma_new"> {{ $value[ 'col_89'] }} </td>
              <td id="ogen_Muscul_rheuma_new"> {{ $value[ 'col_90'] }} </td>
              <td id="ugen_Muscul_rheuma_old"> {{ $value[ 'col_91'] }} </td>
              <td id="ogen_Muscul_rheuma_old"> {{ $value[ 'col_92'] }} </td>
            </tr>
            <tr class="">
              <td>Type of patients cousult</td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              
              <td></td>

              <td>STI</td>
              <td id="ugen_STI_new"> {{ $value[ 'col_93'] }} </td>
              <td id="ogen_STI_new"> {{ $value[ 'col_94'] }} </td>
              <td id="ugen_STI_old"> {{ $value[ 'col_95'] }} </td>
              <td id="ogen_STI_old"> {{ $value[ 'col_96'] }} </td>
            </tr>
            <tr class="">
              <td>FSW</td>
              <td id="fsw"> {{ $value[ 'col_121'] }} </td>
              <td></td>
              <td></td>
              <td></td>
              
              <td></td>

              <td>Skin Infection</td>
              <td id="ugen_skin_infect_new"> {{ $value[ 'col_97'] }} </td>
              <td id="ogen_skin_infect_new"> {{ $value[ 'col_98'] }} </td>
              <td id="ugen_skin_infect_old"> {{ $value[ 'col_99'] }} </td>
              <td id="ogen_skin_infect_old"> {{ $value[ 'col_100'] }} </td>
            </tr>
            <tr class="">
              <td>MSM</td>
              <td id="msm"> {{ $value[ 'col_122'] }} </td>
              <td></td>
              <td></td>
              <td></td>
              
              <td></td>

              <td>Sexual violence</td>
              <td id="ugen_sex_violence_new"> {{ $value[ 'col_101'] }} </td>
              <td id="ogen_sex_violence_new"> {{ $value[ 'col_102'] }} </td>
              <td id="ugen_sex_violence_old"> {{ $value[ 'col_103'] }} </td>
              <td id="ogen_sex_violence_old"> {{ $value[ 'col_104'] }} </td>
            </tr>
            <tr class="">
              <td>TG</td>
              <td id="tg" > {{ $value[ 'col_123'] }} </td>
              <td></td>
              <td></td>
              <td></td>
              
              <td></td>

              <td>Child Abuse</td>
              <td id="ugen_child_abuse_new"> {{ $value[ 'col_105'] }} </td>
              <td id="ogen_child_abuse_new"> {{ $value[ 'col_106'] }} </td>
              <td id="ugen_child_abuse_old"> {{ $value[ 'col_107'] }} </td>
              <td id="ogen_child_abuse_old"> {{ $value[ 'col_108'] }} </td>
            </tr>
            <tr class="">
              <td>PWID</td>
              <td id="idu"> {{ $value[ 'col_124'] }} </td>
              <td></td>
              <td></td>
              <td></td>
              
              <td></td>

              <td>Malnourished</td>
              <td id="ugen_malnourish_new"> {{ $value[ 'col_109'] }} </td>
              <td id="ogen_malnourish_new"> {{ $value[ 'col_110'] }} </td>
              <td id="ugen_malnourish_old"> {{ $value[ 'col_111'] }} </td>
              <td id="ogen_malnourish_old"> {{ $value[ 'col_112'] }} </td>
            </tr>
            <tr class="">
              <td>Non-KP</td>
              <td id="non_kp"> {{ $value[ 'col_125'] }} </td>
              <td></td>
              <td></td>
              <td></td>
              
              <td></td>

              <td>Dengue Fever</td>
              <td id="ugen_dengue_fever_new"> {{ $value[ 'col_113'] }} </td>
              <td id="ogen_dengue_fever_new"> {{ $value[ 'col_114'] }} </td>
              <td id="ugen_dengue_fever_old"> {{ $value[ 'col_115'] }} </td>
              <td id="ogen_dengue_fever_old"> {{ $value[ 'col_116'] }} </td>
            </tr>
            <tr class="">
            <td>Blank in Diagnosis Data</td>
                @php
                    $sum = $value['col_126'] + $value['col_127'];
                @endphp
              <td id="blank_in_diagnosis"> {{ $sum }} </td>
              
              <td></td>
              <td></td>
              <td></td>
              
              <td></td>

              <td>Others</td>
              <td id="ugen_others_new"> {{ $value[ 'col_117'] }} </td>
              <td id="ogen_others_new"> {{ $value[ 'col_118'] }} </td>
              <td id="ugen_others_old"> {{ $value[ 'col_119'] }} </td>
              <td id="ogen_others_old"> {{ $value[ 'col_120'] }} </td>
            </tr>
            <tr class="">
             
              <td>Refer to Fever</td>
              <td id="lab_inv_only"> {{ $value[ 'col_133'] }} </td>
              <td></td>
              <td></td>
              <td></td>
              
              <td></td>

              <td>Total</td>
              <td id="ugen_total_new"> {{ $value[ 'col_129'] }} </td>
              <td id="ogen_total_new"> {{ $value[ 'col_130'] }} </td>
              <td id="ugen_total_old"> {{ $value[ 'col_131'] }} </td>
              <td id="ogen_total_old"> {{ $value[ 'col_132'] }} </td>
            </tr> 


           
          </tbody>
        </table>
        @endforeach





        </form>
    </div>
</body>
</html>

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
         

       
       
         <table class="table table-bordered" style="border: 2px solid red;">
            <thead>
              
              <tr><td style="text-align:center" colspan="59">Clinic Consultations (daily overall) report</td></tr>
              <tr>
                <td style="text-align:center"  >Date</td>
                <td style="text-align:center" colspan="3" >PHA</td>
                <td style="text-align:center" colspan="3" >ART</td>
                <td style="text-align:center" colspan="3" >PrEP</td>
                <td style="text-align:center" colspan="3" >PMTCT</td>
                <td style="text-align:center" colspan="3" >ANC</td>
                <td style="text-align:center" colspan="3" >FP</td>
                <td style="text-align:center" colspan="3" >Feeding Centre</td>
                <td style="text-align:center" colspan="3" >General</td>
                <td style="text-align:center" colspan="2" >...</td>

                <td style="text-align:center" colspan="3" >Hypertension Only</td>
                <td style="text-align:center" colspan="3" >DM Only</td>
                <td style="text-align:center" colspan="3" >H/T and DM Como</td>
                <td style="text-align:center" colspan="3" >NCD CVD</td>
                <td style="text-align:center" colspan="3" >HIV (Neg) TB</td>
                <td style="text-align:center" colspan="3" >RTI ( &lt; 2 wks )</td>
                <td style="text-align:center" colspan="3" >RTI (&gt;= 2 wks)</td>
                <td style="text-align:center" colspan="3" >TB related Consultation</td>
                <td style="text-align:center" colspan="3" >Covid related Consultation</td>
                <td style="text-align:center" colspan="3" >Obstructive pul. D/s</td>
                <td style="text-align:center" colspan="3" >Renal D/s</td>
                <td style="text-align:center" colspan="3" >GI and Hepatobiliary</td>
                <td style="text-align:center" colspan="3" >Gynaecology</td>
                <td style="text-align:center" colspan="3" >Musculoskeleton and rheumatology</td>
                <td style="text-align:center" colspan="3" >STI</td>
                <td style="text-align:center" colspan="3" >Skin Infection</td>
                <td style="text-align:center" colspan="3" >Sexual violence</td>
                <td style="text-align:center" colspan="3" >Child Abuse</td>
                <td style="text-align:center" colspan="3" >Malnourished</td>
                <td style="text-align:center" colspan="3" >Dengue Fever</td>
                <td style="text-align:center" colspan="3" >Others</td>

              </tr>
              <tr>
                <td ></td>
                <td>New</td><td>Old</td><td style="background:orange">Total</td>
                <td>New</td><td>Old</td><td style="background:orange">Total</td>
                <td>New</td><td>Old</td><td style="background:orange">Total</td>
                <td>New</td><td>Old</td><td style="background:orange">Total</td>
                <td>New</td><td>Old</td><td style="background:orange">Total</td>
                <td>New</td><td>Old</td><td style="background:orange">Total</td>
                <td>New</td><td>Old</td><td style="background:orange">Total</td>
                <td>New</td><td>Old</td><td style="background:orange">Total</td>
                <td></td><td></td>
                <td>New</td><td>Old</td><td style="background:orange">Total</td>
                <td>New</td><td>Old</td><td style="background:orange">Total</td>
                <td>New</td><td>Old</td><td style="background:orange">Total</td>
                <td>New</td><td>Old</td><td style="background:orange">Total</td>
                <td>New</td><td>Old</td><td style="background:orange">Total</td>
                <td>New</td><td>Old</td><td style="background:orange">Total</td>
                <td>New</td><td>Old</td><td style="background:orange">Total</td>
                <td>New</td><td>Old</td><td style="background:orange">Total</td>
                <td>New</td><td>Old</td><td style="background:orange">Total</td>
                <td>New</td><td>Old</td><td style="background:orange">Total</td>
                <td>New</td><td>Old</td><td style="background:orange">Total</td>
                <td>New</td><td>Old</td><td style="background:orange">Total</td>
                <td>New</td><td>Old</td><td style="background:orange">Total</td>
                <td>New</td><td>Old</td><td style="background:orange">Total</td>
                <td>New</td><td>Old</td><td style="background:orange">Total</td>
                <td>New</td><td>Old</td><td style="background:orange">Total</td>
                <td>New</td><td>Old</td><td style="background:orange">Total</td>
                <td>New</td><td>Old</td><td style="background:orange">Total</td>
                <td>New</td><td>Old</td><td style="background:orange">Total</td>
                <td>New</td><td>Old</td><td style="background:orange">Total</td>
                <td>New</td><td>Old</td><td style="background:orange">Total</td>
                
              </tr>

            </thead>
            <tbody>
               @foreach($dailyData as $index => $value)
               
                <tr class="">
                  <td>{{ $value['Date']}}</td>
                  <td>{{ $value['PHA_new'] }}</td>
                  <td>{{ $value['PHA_old'] }}</td>
                  <td>{{ $value['PHA'] }}</td>

                  <td>{{ $value['ART_new'] }}</td>
                  <td>{{ $value['ART_old'] }}</td>
                  <td>{{ $value['ART'] }}</td>

                  <td>{{ $value['PrEP_new'] }}</td>
                  <td>{{ $value['PrEP_old'] }}</td>
                  <td>{{ $value['PrEP'] }}</td>

                  <td>{{ $value['PMTCT_new'] }}</td>
                  <td>{{ $value['PMTCT_old'] }}</td>
                  <td>{{ $value['PMTCT'] }}</td>

                  <td>{{ $value['ANC_new'] }}</td>
                  <td>{{ $value['ANC_old'] }}</td>
                  <td>{{ $value['ANC'] }}</td>

                  <td>{{ $value['FP_new'] }}</td>
                  <td>{{ $value['FP_old'] }}</td>
                  <td>{{ $value['FP'] }}</td>
                  
                  <td>{{ $value['Feedcenter_new'] }}</td>
                  <td>{{ $value['Feedcenter_old'] }}</td>
                  <td>{{ $value['Feedcenter'] }}</td>

                  <td>{{  $value['Hypertension_only_new']+$value['DM_only_new']+$value['HT_DM_como_new']+
                          $value['NCD_CVD_new'] + $value['hivNegTB_new']+$value['RTI_less_2wk_new']+$value['RTI_great_2wk_new']+
                          $value['TB_relate_new'] + $value['covid_relate_new']+$value['obstrctive_new']+$value['Renal_ds_new'] +
                          $value['GI_Hepato_new']+  $value['Gynaecology_new']+$value['Musculo_and_rheumatology_new']+
                          $value['STI_new']+$value['Skin_inf_new']+$value['Sexual_violence_new'] +$value['child_abuse_new'] +
                          $value['malnourished_new']+$value['Dengue_fever_new']+$value['other_new'] + $value['lab_inv_ck_new']
                  }}</td>
                  <td>{{ $value['Hypertension_only_old']+$value['DM_only_old']+$value['HT_DM_como_old']+
                          $value['NCD_CVD_old'] + $value['hivNegTB_old']+$value['RTI_less_2wk_old']+$value['RTI_great_2wk_old']+
                          $value['TB_relate_old'] + $value['covid_relate_old']+$value['obstrctive_old']+$value['Renal_ds_old'] +
                          $value['GI_Hepato_old']+  $value['Gynaecology_old']+$value['Musculo_and_rheumatology_old']+
                          $value['STI_old']+$value['Skin_inf_old']+$value['Sexual_violence_old'] +$value['child_abuse_old'] +
                          $value['malnourished_old']+$value['Dengue_fever_old']+$value['other_old'] + $value['lab_inv_ck_old']}}</td>
                  <td>{{ $value['Hypertension_only']+$value['DM_only']+$value['HT_DM_como']+
                          $value['NCD_CVD'] + $value['hivNegTB']+$value['RTI_less_2wk']+$value['RTI_great_2wk']+
                          $value['TB_relate'] + $value['covid_relate']+$value['obstrctive']+$value['Renal_ds'] +
                          $value['GI_Hepato']+  $value['Gynaecology']+$value['Musculo_and_rheumatology']+
                          $value['STI']+$value['Skin_inf']+$value['Sexual_violence'] +$value['child_abuse'] +
                          $value['malnourished']+$value['Dengue_fever']+$value['other'] + $value['lab_inv_ck']}}</td>
                  
                  <td></td> <td></td>
        
                  <td>{{ $value['Hypertension_only_new'] }}</td>
                  <td>{{ $value['Hypertension_only_old'] }}</td>
                  <td>{{ $value['Hypertension_only'] }}</td>

                  <td>{{ $value['DM_only_new'] }}</td>
                  <td>{{ $value['DM_only_old'] }}</td>
                  <td>{{ $value['DM_only'] }}</td>
                  
                  <td>{{ $value['HT_DM_como_new'] }}</td>
                  <td>{{ $value['HT_DM_como_old'] }}</td>
                  <td>{{ $value['HT_DM_como'] }}</td>
                  
                  <td>{{ $value['NCD_CVD_new'] }}</td>
                  <td>{{ $value['NCD_CVD_old'] }}</td>
                  <td>{{ $value['NCD_CVD'] }}</td>
                  
                  <td>{{ $value['hivNegTB_new'] }}</td>
                  <td>{{ $value['hivNegTB_old'] }}</td>
                  <td>{{ $value['hivNegTB'] }}</td>
                  
                  <td>{{ $value['RTI_less_2wk_new'] }}</td>
                  <td>{{ $value['RTI_less_2wk_old'] }}</td>
                  <td>{{ $value['RTI_less_2wk'] }}</td>
                  
                  <td>{{ $value['RTI_great_2wk_new'] }}</td>
                  <td>{{ $value['RTI_great_2wk_old'] }}</td>
                  <td>{{ $value['RTI_great_2wk'] }}</td>
                  
                  <td>{{ $value['TB_relate_new'] }}</td>
                  <td>{{ $value['TB_relate_old'] }}</td>
                  <td>{{ $value['TB_relate'] }}</td>
                  
                  <td>{{ $value['covid_relate_new'] }}</td>
                  <td>{{ $value['covid_relate_old'] }}</td>
                  <td>{{ $value['covid_relate'] }}</td>
                  
                  <td>{{ $value['obstrctive_new'] }}</td>
                  <td>{{ $value['obstrctive_old'] }}</td>
                  <td>{{ $value['obstrctive'] }}</td>
                  
                  <td>{{ $value['Renal_ds_new'] }}</td>
                  <td>{{ $value['Renal_ds_old'] }}</td>
                  <td>{{ $value['Renal_ds'] }}</td>
                  
                  <td>{{ $value['GI_Hepato_new'] }}</td>
                  <td>{{ $value['GI_Hepato_old'] }}</td>
                  <td>{{ $value['GI_Hepato'] }}</td>
                  
                  <td>{{ $value['Gynaecology_new'] }}</td>
                  <td>{{ $value['Gynaecology_old'] }}</td>
                  <td>{{ $value['Gynaecology'] }}</td>
                  
                  
                  <td>{{ $value['Musculo_and_rheumatology_new'] }}</td>
                  <td>{{ $value['Musculo_and_rheumatology_old'] }}</td>
                  <td>{{ $value['Musculo_and_rheumatology'] }}</td>
                  
                  <td>{{ $value['STI_new'] }}</td>
                  <td>{{ $value['STI_old'] }}</td>
                  <td>{{ $value['STI'] }}</td>
                  
                  <td>{{ $value['Skin_inf_new'] }}</td>
                  <td>{{ $value['Skin_inf_old'] }}</td>
                  <td>{{ $value['Skin_inf'] }}</td>

                  <td>{{ $value['Sexual_violence_new'] }}</td>
                  <td>{{ $value['Sexual_violence_old'] }}</td>
                  <td>{{ $value['Sexual_violence'] }}</td>
                  
                  <td>{{ $value['child_abuse_new'] }}</td>
                  <td>{{ $value['child_abuse_old'] }}</td>
                  <td>{{ $value['child_abuse'] }}</td>
                  
                  <td>{{ $value['malnourished_new'] }}</td>
                  <td>{{ $value['malnourished_old'] }}</td>
                  <td>{{ $value['malnourished'] }}</td>
                  
                  <td>{{ $value['Dengue_fever_new'] }}</td>
                  <td>{{ $value['Dengue_fever_old'] }}</td>
                  <td>{{ $value['Dengue_fever'] }}</td>
                  
                  <td>{{ $value['other_new'] + $value['lab_inv_ck_new'] }}</td>
                  <td>{{ $value['other_old'] + $value['lab_inv_ck_old']}}</td>
                  <td>{{ $value['other'] + $value['lab_inv_ck']}}</td>
                 
                 

                </tr>
               @endforeach
               
            </tbody>
        </table>
        





        </form>
    </div>
</body>
</html>

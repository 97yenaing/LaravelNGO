<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>

<body>
  <form>
    @csrf
    <table>
      <thead>
        <tr>
          <th style="width:150px;">Clinic code</th>
          <th style="width:150px;">General ID</th>
          <th style="width:150px;">Fuchia ID</th>
          <th style="width:150px;">NCD Register Age</th>
          <th style="width:150px;">Sex</th>
          <th style="width:150px;">Reg Date</th>
          <th style="width:150px;">Township</th>
          <th style="width:150px;">State</th>
          <th style="width:150px;">Height</th>
          <th style="width:150px;">Weight</th>
          <th style="width:150px;">Reg_BMI</th>

          <th style="width:150px;">BP(syst/dias)_1</th>
          <th style="width:150px;">BP_readdate 1</th>
          <th style="width:150px;">BP(syst/dias)_2</th>
          <th style="width:150px;">BP_readdate 2</th>
          <th style="width:150px;">BP(syst/dias)_3</th>
          <th style="width:150px;">BP_readdate 3</th>

          <th style="width:150px;">Hypertension</th>
          <th style="width:150px;">Hypertension diagnosis Date</th>
          <th style="width:150px;">Diabetes</th>
          <th style="width:150px;">Diabetes Diagnosis Date</th>
          <th style="width:150px;">Staging of hypertension</th>
          <th style="width:150px;">RBS 1st</th>
          <th style="width:150px;">RBS 1st Date</th>
          <th style="width:150px;">RBS 2nd</th>
          <th style="width:150px;">RBS 2nd Date</th>

          <th style="width:150px;">Clinical symptoms</th>
          <th style="width:150px;">Symptoms_des</th>
          <th style="width:150px;">Smoking status</th>

          <th style="width:150px;">Amlodipine dose</th>
          <th style="width:150px;">Amlodipine frequency</th>
          <th style="width:150px;">Amlodipine_duration</th>
          <th style="width:150px;">Amlodipine_dur_unit</th>

          <th style="width:150px;">Enalapril dose</th>
          <th style="width:150px;">Enalapril frequency</th>
          <th style="width:150px;">Enalapril_duration</th>
          <th style="width:150px;">Enalapril_dur_unit</th>

          <th style="width:150px;">Atorvastain dose</th>
          <th style="width:150px;">Atorvastain frequency</th>
          <th style="width:150px;">Atorvastain_duration</th>
          <th style="width:150px;">Atorvastain_dur_unit</th>

          <th style="width:150px;">Hydrochlorothiazide dose</th>
          <th style="width:150px;">Hydrochlorothiazide frequency</th>
          <th style="width:150px;">Hydrochlorothiazide_duration</th>
          <th style="width:150px;">Hydrochlorothiazide_dur_unit</th>

          <th style="width:150px;">Aspirin dose</th>
          <th style="width:150px;">Aspirin frequency</th>
          <th style="width:150px;">Aspirin_duration</th>
          <th style="width:150px;">Aspirin_dur_unit</th>

          <th style="width:150px;">Metformin dose</th>
          <th style="width:150px;">Metformin frequency</th>
          <th style="width:150px;">Metformin_duration</th>
          <th style="width:150px;">Metformin_dur_unit</th>

          <th style="width:150px;">Gliclazide dose</th>
          <th style="width:150px;">Gliclazide frequency</th>
          <th style="width:150px;">Gliclazide_duration</th>
          <th style="width:150px;">Gliclazide_dur_unit</th>


          <th style="width:150px;">Other NCD medication</th>
          <th style="width:150px;">Other_NCD_medication_specify</th>

          <th style="width:150px;">Current med1</th>
          <th style="width:150px;">Current med1_dose</th>
          <th style="width:150px;">Current med1_fre</th>
          <th style="width:150px;">Current med1_duration</th>
          <th style="width:150px;">Current med1_duration_unit</th>

          <th style="width:150px;">Current med2</th>
          <th style="width:150px;">Current med2_dose</th>
          <th style="width:150px;">Current med2_fre</th>
          <th style="width:150px;">Current med2_duration</th>
          <th style="width:150px;">Current med2_duration_unit</th>

          <th style="width:150px;">Current med3</th>
          <th style="width:150px;">Current med3_dose</th>
          <th style="width:150px;">Current med3_fre</th>
          <th style="width:150px;">Current med3_duration</th>
          <th style="width:150px;">Current med3_duration_unit</th>

          <th style="width:150px;">Current med4</th>
          <th style="width:150px;">Current med4_dose</th>
          <th style="width:150px;">Current med4_fre</th>
          <th style="width:150px;">Current med4_duration</th>
          <th style="width:150px;">Current med4_duration_unit</th>

          <th style="width:150px;">Current med5</th>
          <th style="width:150px;">Current med5_dose</th>
          <th style="width:150px;">Current med5_fre</th>
          <th style="width:150px;">Current med5_duration</th>
          <th style="width:150px;">Current med5_duration_unit</th>

          <th style="width:150px;">Current med6</th>
          <th style="width:150px;">Current med6_dose</th>
          <th style="width:150px;">Current med6_fre</th>
          <th style="width:150px;">Current med6_duration</th>
          <th style="width:150px;">Current med6_duration_unit</th>

          <th style="width:150px;">Diabetic foot</th>
          <th style="width:150px;">Hyperlipidemia</th>
          <th style="width:150px;">Gestational diabetes</th>
          <th style="width:150px;">Gestational HT</th>
          <th style="width:150px;">Neuropathy</th>
          <th style="width:150px;">CKD</th>
          <th style="width:150px;">CVD(MI/CVA/PVD)</th>
          <th style="width:150px;">Atrial fib</th>
          <th style="width:150px;">Changes in vision</th>
          <th style="width:150px;">Chronic lung disease</th>
          <th style="width:150px;">Recure infection</th>
          <th style="width:150px;">Recurrent_infection_other</th>
          <th style="width:150px;">Family history hypertension</th>
          <th style="width:150px;">Family history diabetes</th>

        </tr>
      </thead>
      <tbody>

        @foreach ($ncd_records as $ncd_record)
        <tr>
          <td>{{$ncd_record["Clinic_code"]}}</td>
          <td>{{$ncd_record["Pid"]}}</td>
          <td>{{$ncd_record["FuchiaID"]}}</td>
          <td>{{$ncd_record["Current Agey"]}}</td>
          <td>{{$ncd_record["Gender"]}}</td>
          <td>{{$ncd_record["Reg_Date"]}}</td>
          <td>{{$ncd_record["Township"]}}</td>
          <td>{{$ncd_record["Area_Division"]}}State</td>
          <td>{{$ncd_record["Height"]}}</td>
          <td>{{$ncd_record["Weight"]}}</td>
          <td>{{$ncd_record["Register_Bmi"]}}</td>

          <td>{{$ncd_record["1stBP"]}}</td>
          <td>{{$ncd_record["1stBP_date"]}}</td>
          <td>{{$ncd_record["2ndBP"]}}</td>
          <td>{{$ncd_record["2ndBP_date"]}}</td>
          <td>{{$ncd_record["3rdBP"]}}</td>
          <td>{{$ncd_record["3rdBP_date"]}}</td>

          <td>{{$ncd_record["1stHypertension"]}}</td>
          <td>{{$ncd_record["1st_DiagDate"]}}</td>
          <td>{{$ncd_record["2nd_Hypertension"]}}</td>
          <td>{{$ncd_record["2nd_DiagDate"]}}</td>
          <td>{{$ncd_record["staging_Hypertension"]}}</td>
          <td>{{$ncd_record["1st_RBS"]}}</td>
          <td>{{$ncd_record["1st_RBS_date"]}}</td>
          <td>{{$ncd_record["2nd_RBS"]}}</td>
          <td>{{$ncd_record["2nd_RBS_date"]}}</td>

          <td>{{$ncd_record["Clinical_Symptoms"]}}</td>
          <td>{{$ncd_record["Clinical_Symptoms_Describe"]}}</td>
          <td>{{$ncd_record["Smoking_Status"]}}</td>

          <td>{{$ncd_record["Amlodipine_dose"]}}</td>
          <td>{{$ncd_record["Amlodipine_Freq"]}}</td>
          <td>{{$ncd_record["Amlodipine_duration"]}}</td>
          <td>{{$ncd_record["Amlodipine_durUnit"]}}</td>

          <td>{{$ncd_record["Enalapril_dose"]}}</td>
          <td>{{$ncd_record["Enalapril_Freq"]}}</td>
          <td>{{$ncd_record["Enalapril_duration"]}}</td>
          <td>{{$ncd_record["Enalapril_durUnit"]}}</td>

          <td>{{$ncd_record["Atorvastain_dose"]}}</td>
          <td>{{$ncd_record["Atorvastain_Freq"]}}</td>
          <td>{{$ncd_record["Atorvastain_duration"]}}</td>
          <td>{{$ncd_record["Atorvastain_durUnit"]}}</td>

          <td>{{$ncd_record["Hydrochlorothiazide_dose"]}}</td>
          <td>{{$ncd_record["Hydrochlorothiazide_Freq"]}}</td>
          <td>{{$ncd_record["Hydrochlorothiazide_duration"]}}</td>
          <td>{{$ncd_record["Hydrochlorothiazide_durUnit"]}}</td>

          <td>{{$ncd_record["Aspirin_dose"]}}</td>
          <td>{{$ncd_record["Aspirin_Freq"]}}</td>
          <td>{{$ncd_record["Aspirin_duration"]}}</td>
          <td>{{$ncd_record["Aspirin_durUnit"]}}</td>

          <td>{{$ncd_record["Metformin_dose"]}}</td>
          <td>{{$ncd_record["Metformin_Freq"]}}</td>
          <td>{{$ncd_record["Metformin_duration"]}}</td>
          <td>{{$ncd_record["Metformin_durUnit"]}}</td>

          <td>{{$ncd_record["Gliclazide_dose"]}}</td>
          <td>{{$ncd_record["Gliclazide_Freq"]}}</td>
          <td>{{$ncd_record["Gliclazide_duraion"]}}</td>
          <td>{{$ncd_record["Gliclazide_durUnit"]}}</td>


          <td>{{$ncd_record["Other_NCD_medication"]}}</td>
          <td>{{$ncd_record["Oth_ncd_med_specify"]}}</td>

          <td>{{$ncd_record["cur_med1"]}}</td>
          <td>{{$ncd_record["cur_med1_dose"]}}</td>
          <td>{{$ncd_record["cur_med1_freq"]}}</td>
          <td>{{$ncd_record["cur_med1_duration"]}}</td>
          <td>{{$ncd_record["cur_med1_durUnit"]}}</td>

          <td>{{$ncd_record["cur_med2"]}}</td>
          <td>{{$ncd_record["cur_med2_dose"]}}</td>
          <td>{{$ncd_record["cur_med2_freq"]}}</td>
          <td>{{$ncd_record["cur_med2_duration"]}}</td>
          <td>{{$ncd_record["cur_med2_durUnit"]}}</td>

          <td>{{$ncd_record["cur_med3"]}}</td>
          <td>{{$ncd_record["cur_med3_dose"]}}</td>
          <td>{{$ncd_record["cur_med3_freq"]}}</td>
          <td>{{$ncd_record["cur_med3_duration"]}}</td>
          <td>{{$ncd_record["cur_med3_durUnit"]}}</td>

          <td>{{$ncd_record["cur_med4"]}}</td>
          <td>{{$ncd_record["cur_med4_dose"]}}</td>
          <td>{{$ncd_record["cur_med4_freq"]}}</td>
          <td>{{$ncd_record["cur_med4_duration"]}}</td>
          <td>{{$ncd_record["cur_med4_durUnit"]}}</td>

          <td>{{$ncd_record["cur_med5"]}}</td>
          <td>{{$ncd_record["cur_med5_dose"]}}</td>
          <td>{{$ncd_record["cur_med5_freq"]}}</td>
          <td>{{$ncd_record["cur_med5_duration"]}}</td>
          <td>{{$ncd_record["cur_med5_durUnit"]}}</td>

          <td>{{$ncd_record["cur_med6"]}}</td>
          <td>{{$ncd_record["cur_med6_dose"]}}</td>
          <td>{{$ncd_record["cur_med6_freq"]}}</td>
          <td>{{$ncd_record["cur_med6_duration"]}}</td>
          <td>{{$ncd_record["cur_med6_durUnit"]}}</td>

          <td>{{$ncd_record["Dia_foot"]}}</td>
          <td>{{$ncd_record["Hyperlipidemia"]}}</td>
          <td>{{$ncd_record["Gestational_Diabetes"]}}</td>
          <td>{{$ncd_record["Gestational_HT"]}}</td>
          <td>{{$ncd_record["Neuropathy"]}}</td>
          <td>{{$ncd_record["CKD"]}}</td>
          <td>{{$ncd_record["CVD"]}}</td>
          <td>{{$ncd_record["Atril_Fib"]}}</td>
          <td>{{$ncd_record["Change_in_Vision"]}}</td>
          <td>{{$ncd_record["Chronic_Lung_Disease"]}}</td>
          <td>{{$ncd_record["Recur_infection"]}}</td>
          <td>{{$ncd_record["Recur_infection_comment"]}}</td>
          <td>{{$ncd_record["Family_Hyper"]}}</td>
          <td>{{$ncd_record["Family_Diabetes"]}}</td>

        </tr>
        @endforeach
      </tbody>
    </table>
  </form>
</body>

</html>
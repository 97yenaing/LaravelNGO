<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form>
        @csrf
        @php
            $columnses=[
                                "Late_fol_duration" ,
                                "Next_Appointment" ,
                                "Time" ,
                                "own_clinic_Bp",
                                "own_Bp_Stage" ,
                                "FBS",
                                "FBS_test_date" ,
                                "2HPP" ,
                                "2HPP_test_date" ,
                                "Loaction_test" ,
                                "Lab_res_Date" ,
                                "Alt" ,
                                "HBA1C" ,
                                "Uring_AC_ratio" ,
                                "Glucose_res" ,
                                "Protein_res" ,
                                "Creatinine" ,
                                "Creat_unit" ,
                                "CRCL" ,
                                "Total_cholesterol" ,
                                "Total_cho_Unit" ,
                                "CVD_Risk" ,
                                "HDL" ,
                                "HDL_unit" ,
                                "LDL" ,
                                "LDL_unit" ,
                                "Triglyceride" ,
                                "Triglyceride_unit" ,
                                "Pulse" ,
                                "Pulse_rate",
                                "Diabetic_foot" ,
                                "Diabetic_Neuropathy" ,
                                "Lifestyle advice" ,
                                "Medication changed" ,
                                "Patient_adhe medic" ,
                                "Drug_Supply" ,
                                "F_Amlodipine_dose" ,
                                "F_Amlodipine_Freq" ,
                                "F_Amlodipine_duration" ,
                                "F_Amlodipine_durUnit" ,
                                "F_Enalapril_dose" ,
                                "F_Enalapril_Freq" ,
                                "F_Enalapril_duration" ,
                                "F_Enalapril_durUnit" ,
                                "F_Atorvastain_dose" ,
                                "F_Atorvastain_Freq" ,
                                "F_Atorvastain_duration" ,
                                "F_Atorvastain_durUnit" ,
                                "F_Hydrochlorothiazide_dose" ,
                                "F_Hydrochlorothiazide_Freq" ,
                                "F_Hydrochlorothiazide_duration" ,
                                "F_Hydrochlorothiazide_durUnit" ,
                                "F_Aspirin_dose" ,
                                "F_Aspirin_Freq" ,
                                "F_Aspirin_duration" ,
                                "F_Aspirin_durUnit" ,
                                "F_Metformin(500)_dose" ,
                                "F_ Metformin(500)_Freq" ,
                                "F_Metformin(500)_duration" ,
                                "F_Metformin(500)_durUnit" ,
                                "F_Metformin(1000)_dose" ,
                                "F_ Metformin(1000)_Freq" ,
                                "F_Metformin(1000)_duration" ,
                                "F_Metformin(1000)_durUnit" ,
                                "F_Gliclazide(500)_dose" ,
                                "F_Gliclazide(500)_Freq" ,
                                "F_Gliclazide(500)_duraion" ,
                                "F_Gliclazide(500)_durUnit" ,
                                "F_Gliclazide(1000)_dose" ,
                                "F_ Gliclazide(1000)_Freq" ,
                                "F_Gliclazide(1000)_duration" ,
                                "F_Gliclazide(1000)_durUnit" ,
                                "Symptom hypoglycemia" ,
                                "Foth_medi" ,
                                "Foth_medi_spec" ,
                                "Out_come" ,
                                "Tout_mam_clinic" ,
                                "Tout_physician_data" ,
                                "death_date" ,
                                "Cause_of_death" ,
                                "Fup_doc_initial" ,
                                "RBS result" ,
                                "visit_type",
            ]
        @endphp
        <table>
            <thead>
               
                <tr>

                    <th style="width:150px;">Clinic code</th>
                    <th style="width:150px;">General ID</th>
                    <th style="width:150px;">Fuchia ID </th>
                    <th style="width:150px;">Visit Date</th>
                    <th style="width:150px;">Register Date</th>
                    <th style="width:150px;">NCD Register Age</th>
                    <th style="width:150px;">NCD Follow_UP Age</th>
                    <th style="width:150px;">Sex</th>
                    <th style="width:150px;">State</th>
                    <th style="width:150px;">Township</th>    
                    <th style="width:150px;">NCD Diagnosis</th>
                    <th style="width:150px;">Height</th>
                    <th style="width:150px;">Weight</th>
                    <th style="width:150px;">BMI</th>
                    <th style="width:150px;">Type_current_visit</th>
                    <th style="width:150px;">Late_duration</th>
                    <th style="width:150px;">late_duration_unit</th>
                    <th style="width:150px;">Followup_required_Duration</th>
                    <th style="width:150px;">Fup_req_dur_unit</th>
                    <th style="width:150px;">Next:Follow_up_date</th>
                    <th style="width:150px;">Time</th>
                    <th style="width:150px;">BP MAM</th>
                    <th style="width:150px;">BP state</th>
                    <th style="width:150px;">FBS result</th>
                    <th style="width:150px;">FBS Date</th>
                    <th style="width:150px;">2HPP</th>
                    <th style="width:150px;">2Hpp Date</th>
                    <th style="width:150px;">Location_of_test</th>
                    <th style="width:150px;">Other Lab Result Date</th>
                    <th style="width:150px;">ALT</th>
                    <th style="width:150px;">HBA1C</th>
                    <th style="width:150px;">Urine_ACR</th>
                    <th style="width:150px;">Glucose result</th>
                    <th style="width:150px;">Protein result</th>
                    <th style="width:150px;">Creatinine</th>
                    <th style="width:150px;">Creatinine unit</th>
                    <th style="width:150px;">CRCL</th>
                    <th style="width:150px;">Total cholesterol</th>
                    <th style="width:150px;">Total cholesterol unit</th>
                    <th style="width:150px;">CVD_risk</th>
                    <th style="width:150px;">HDL</th>
                    <th style="width:150px;">HDL_unit</th>
                    <th style="width:150px;">LDL</th>
                    <th style="width:150px;">LDL unit</th>
                    <th style="width:150px;">Triglyceride</th>
                    <th style="width:150px;">Triglyceride unit</th>
                    <th style="width:150px;">Pulse</th>
                    <th style="width:150px;">Pulse rate</th>
                    <th style="width:150px;">Diabetic foot</th>
                    <th style="width:150px;">Diabetic Neuropathy</th>
                    <th style="width:150px;">Lifestyle advice</th>
                    <th style="width:150px;">Medication changed</th>
                    <th style="width:150px;">Patient Adherence to medication</th>
                    <th style="width:150px;">Drug supply</th>

                    <th style="width:150px;">Amlodipine dose</th>
                    <th style="width:150px;">Amlodipine frequency</th>
                    <th style="width:150px;">Amlodipine dose duration</th>
                    <th style="width:150px;">Amlodipine dose duration_unit</th>

                    <th style="width:150px;">Enalapril dose</th>
                    <th style="width:150px;">Enalapril frequency</th>
                    <th style="width:150px;">Enalapril duration</th>
                    <th style="width:150px;">Enalapril duration_unit</th>

                    <th style="width:150px;">Atorvastain dose</th>
                    <th style="width:150px;">Atorvastain frequency</th>
                    <th style="width:150px;">Atorvastain duration</th>
                    <th style="width:150px;">Atorvastain duration_unit</th>

                    <th style="width:150px;">Hydrochlorothiazide dose</th>
                    <th style="width:150px;">Hydrochlorothiazide frequency</th>
                    <th style="width:150px;">Hydrochlorothiazide duration</th>
                    <th style="width:150px;">Hydrochlorothiazide duration_unit</th>

                    <th style="width:150px;">Aspirin dose</th>
                    <th style="width:150px;">Aspirin frequency</th>
                    <th style="width:150px;">Aspirin duration</th>
                    <th style="width:150px;">Aspirin duration_unit</th>
                    
                    <th style="width:150px;">Metformin(500) dose</th>
                    <th style="width:150px;">Metformin(500) frequency</th>
                    <th style="width:150px;">Metformin(500) duration</th>
                    <th style="width:150px;">Metformin(500) duration_unit</th>

                    <th style="width:150px;">Metformin(1000) dose</th>
                    <th style="width:150px;">Metformin(1000) frequency</th>
                    <th style="width:150px;">Metformin(1000) duration</th>
                    <th style="width:150px;">Metformin(1000) duration_unit</th>

                    <th style="width:150px;">Gliclazide(500) dose</th>
                    <th style="width:150px;">Gliclazide(500) frequency</th>
                    <th style="width:150px;">Gliclazide(500) duration</th>
                    <th style="width:150px;">Gliclazide(500) duration_unit</th>

                    <th style="width:150px;">Gliclazide(1000) dose</th>
                    <th style="width:150px;">Gliclazide(1000) frequency</th>
                    <th style="width:150px;">Gliclazide(1000) duration</th>
                    <th style="width:150px;">Gliclazide(1000) duration_unit</th>

                    <th style="width:150px;">Symptom hypoglycemia</th>
                    <th style="width:150px;">Followup Other Medication</th>
                    <th style="width:150px;">Other_med_spec</th>
                    <th style="width:150px;">Outcome</th>
                    <th style="width:150px;">Tout_mam_clinic</th>
                    <th style="width:150px;">Tout_physician</th>
                    <th style="width:150px;">Death Date</th>
                    <th style="width:150px;">Cause_of_death</th>
                    <th style="width:150px;">Dr Initial</th>
                    <th style="width:150px;">RBS result</th>
                    <th style="width:150px;">Visit type(old data)</th>
                   
                </tr>
            </thead>
            <tbody>
                
                @foreach ($ncd_fol_exDataes as $ncd_fol_exData)
                    <tr>
                        <td>{{$ncd_fol_exData["Clinic Code"]}}</td>
                        <td>{{$ncd_fol_exData["Pid"]}}</td>
                        <td>{{$ncd_fol_exData["FuchiaID"]}}</td>
                        <td>{{$ncd_fol_exData["Visit_date"]}}</td>
                        <td>{{$ncd_fol_exData["Reg_Date"]}}</td>
                        <td>{{$ncd_fol_exData["visit_Age"]}}</td>{{-- get form ncd register table --}}
                        
                        <td>{{$ncd_fol_exData["Current Agey"]}}</td>
                        <td>{{$ncd_fol_exData["Gender"]}}</td>
                        <td>{{$ncd_fol_exData["Area_Division"]}}</td>
                        <td>{{$ncd_fol_exData["Township"]}}</td>    
                        <td>{{$ncd_fol_exData["NCD_Diagnosis"]}}</td>
                        <td>{{$ncd_fol_exData["Follow_Height"]}}</td>
                        <td>{{$ncd_fol_exData["Follow_Weight"]}}</td>
                        <td>{{$ncd_fol_exData["Follow_Bmi"]}}</td>
                        <td>{{$ncd_fol_exData["Type_cur_visit"]}}</td>
                        <td>{{$ncd_fol_exData["Late_visit"]}}</td>
                        <td>{{$ncd_fol_exData["Late_duration"]}}</td>
                        <td>{{$ncd_fol_exData["Late_follow"]}}</td>
                        @foreach ($columnses as $item)
                            <td>{{$ncd_fol_exData[$item]}}</td>
                        @endforeach

                   </tr>
                        
                           
                @endforeach
            </tbody>
        </table>
    </form>
    
</body>
</html>
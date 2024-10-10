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
            <?php 
            ?>
            <table>
                <thead>
                    <tr>
                    <th>Clinic Code</th>
                    <th>General ID</th>
                    <th>Fuchia ID</th>
                    <th>Reg Year</th>
                    <th>Register Age</th>
                    <th>Register Age(Month)</th>
                    <th>Current Age</th>
                    <th>Current Age(Month)</th>
                    <th>Visit Date</th>
                    <th>HIV Status</th>
                    <th>FSW</th>
                    <th>No. Previous Pregnancy</th>
                    <th>Birth spacing_method</th>
                    <th>LMP</th>

                    <th>UCG_test_date</th>
                    <th>UCG_test_result</th>
                    <th>Discharge</th>
                    <th>Cervix_bleed</th>
                    <th>Tenderness</th>
                    <th>Malignancy</th>
                    <th>Comments</th>
                    <th>Breast_self</th>
                    <th>Breast_family_his</th>
                    <th>Breast_examination</th>
                    <th>Breast_abnormal_find_breast</th>
                    <th>Breast_remark</th>
                    <th>STI_complaint</th>
                    <th>STI_examination</th>
                    <th>VIA_screening_his</th>
                    <th>VIA_test</th>
                    <th>VIA_postponed_reason</th>
                    <th>VIA_postponed_reason_oth</th>
                    <th>SCJ</th>
                    <th>VIA_test_res</th>
                    <th>Referred_OG</th>
                    <th>Counselling_via_res_by</th>
                    <th>Eligible_thermal_ablation</th>
                    <th>Eligible_thermal_ablation_rea</th>
                    <th>Eligible_thermal_ablation_rea_oth</th>
                    <th>Thermal_ablation_done</th>
                    <th>Thermal_ablation_done_rea</th>
                    <th>Thermal_ablation_done_rea_oth</th>
                    <th>Thermal_ablation_res</th>
                    <th>Thermal_ablation_per_by</th>
                    <th>Thermal_ablation_date</th>
                    <th>Date</th>
                    <th>Followup Date</th>
                    <th>Ref_to_tertiary_center_further_treatment</th>
                    <th>AE_date</th>
                    <th>Complaint</th>
                    <th>Complaint_Spec</th>
                    <th>Complaint_Spec_oth</th>
                    <th>Ref_hosipital</th>
                    <th>AE_related_thermal_ablation</th>
                    <th>Treatment</th>
                    <th>AE_followup_date</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($cervical_exdata as $index => $value)
                    <tr> 
                        {{-- @dd($value) --}}
                        <td style="width:100px;">{{ $value['Clinic_code'] }}</td>
                        <td style="width:100px;">{{ $value['General ID']}}</td>
                        <td style="width:100px;">{{ $value['FuchiaID']}}</td>
                        <td style="width:80px;">{{ $value['Reg year'] }}</td>
                        <td style="width:80px;">{{ $value['Register Agey'] }}</td>
                        <td style="width:80px;">{{ $value['Register Agem'] }}</td>
                        <td style="width:80px;">{{ $value['Current Agey'] }}</td>
                        <td style="width:80px;">{{ $value['Current Agem'] }}</td>
                        <td style="width:100px;">{{$value['Visit_date']}} </td>
                        <td style="width:100px;">{{ $value['Hiv_Status']}}</td>
                        <td style="width:100px;">{{ $value['FSW']}}</td>
                        <td style="width:100px;">{{ $value['No_previous_preg']}}</td>
                        <td style="width:100px;">{{ $value['Birth_spacing_met']}}</td>
                        <td style="width:100px;">{{$value['LMP']}}</td>
                        <td style="width:100px;">{{ $value['UCG_test_date']}}</td>
                        <td style="width:100px;">{{ $value['UCG_test_res']}}</td>
                        <td style="width:100px;">{{ $value['Discharge']}}</td>
                        <td style="width:100px;">{{ $value['Cervix_bleed_touch']}}</td>
                        <td style="width:100px;">{{ $value['Tenderness']}}</td>
                        <td style="width:100px;">{{ $value['Malignancy']}}</td>
                        <td style="width:100px;">{{ $value['Comments_spec']}}</td>

                        <td style="width:100px;">{{ $value['Breast_self']}}</td>
                        <td style="width:100px;">{{ $value['Breast_family_his']}}</td>
                        <td style="width:100px;">{{ $value['Breast_examination']}}</td>
                        <td style="width:100px;">{{ $value['Breast_abnormal_find_breast']}}</td>
                        <td style="width:100px;">{{ $value['Breast_remark']}}</td>


                        <td style="width:100px;">{{ $value['Sti_Complaint']}}</td>
                        <td style="width:100px;">{{ $value['Sti_examination']}}</td>
                        <td style="width:100px;">{{ $value['VIA_Screening_History']}}</td>
                        <td style="width:100px;">{{ $value['VIA_test']}}</td>
                        <td style="width:100px;">{{ $value['VIA_postpone_reason']}}</td>
                        <td style="width:100px;">{{ $value['VIA_specify_reason']}}</td>
                        <td style="width:100px;">{{ $value['SCJ']}}</td>
                        <td style="width:100px;">{{ $value['VIA_test_Result']}}</td>
                        <td style="width:100px;">{{ $value['refer_OG']}}</td>
                        <td style="width:100px;">{{ $value['Counselling_VIA_result_done']}}</td>
                        <td style="width:100px;">{{ $value['Eglible_thermal_ablation']}}</td>
                        <td style="width:100px;">{{ $value['Eglible_thermal_ablation_reason']}}</td>
                        <td style="width:100px;">{{ $value['Eglible_thermal_ablation_specify']}}</td>
                        <td style="width:100px;">{{ $value['Thermal_ablation_done']}}</td>
                        <td style="width:100px;">{{ $value['Thermal_No_specify']}}</td>
                        <td style="width:100px;">{{ $value['Thermal_other_specify']}}</td>
                        <td style="width:100px;">{{ $value['Thermal_ablation_result']}}</td>
                        <td style="width:100px;">{{ $value['Thermal_ablation_performed']}}</td>
                        <td style="width:100px;">{{$value['Postpone_date']}}</td>
                        <td style="width:100px;">{{ $value['Date']}}</td>
                        <td style="width:100px;">{{ $value['Followup_date']}}</td>
                        <td style="width:100px;">{{ $value['Tertiary_Further_treatment']}}</td>
                        <td style="width:100px;">{{ $value['AE_Date']}}</td>
                        <td style="width:100px;">{{ $value['Complaint']}}</td>
                        <td style="width:100px;">{{ $value['Complaint_yes']}}</td>
                        <td style="width:100px;">{{ $value['Complaint_other']}}</td>
                        <td style="width:100px;">{{ $value['Refer_Hosp']}}</td>
                        <td style="width:100px;">{{ $value['AE_realated_thermal_ablation']}}</td>
                        <td style="width:100px;">{{ $value['Treatment']}}</td>
                        <td style="width:100px;">{{ $value['AE_followUp_Date']}}</td>
                    </tr>
                    
                    @endforeach
              </tbody>
            </table>
    </form>
                
    
</body>
</html>
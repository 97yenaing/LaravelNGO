<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>

<body>
  <form action="">
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
        @foreach($cervical_records as $cervical_record)
        <tr>
          <td style="width:100px;">{{ $cervical_record['Clinic_code'] }}</td>
          <td style="width:100px;">{{ $cervical_record['General ID']}}</td>
          <td style="width:100px;">{{ $cervical_record['FuchiaID']}}</td>
          <td style="width:80px;">{{ $cervical_record['Reg year'] }}</td>
          <td style="width:80px;">{{ $cervical_record['Register Agey'] }}</td>
          <td style="width:80px;">{{ $cervical_record['Register Agem'] }}</td>
          <td style="width:80px;">{{ $cervical_record['Current Agey'] }}</td>
          <td style="width:80px;">{{ $cervical_record['Current Agem'] }}</td>
          <td style="width:100px;">{{$cervical_record['Visit_date']}} </td>
          <td style="width:100px;">{{ $cervical_record['Hiv_Status']}}</td>
          <td style="width:100px;">{{ $cervical_record['FSW']}}</td>
          <td style="width:100px;">{{ $cervical_record['No_previous_preg']}}</td>
          <td style="width:100px;">{{ $cervical_record['Birth_spacing_met']}}</td>
          <td style="width:100px;">{{$cervical_record['LMP']}}</td>
          <td style="width:100px;">{{ $cervical_record['UCG_test_date']}}</td>
          <td style="width:100px;">{{ $cervical_record['UCG_test_res']}}</td>
          <td style="width:100px;">{{ $cervical_record['Discharge']}}</td>
          <td style="width:100px;">{{ $cervical_record['Cervix_bleed_touch']}}</td>
          <td style="width:100px;">{{ $cervical_record['Tenderness']}}</td>
          <td style="width:100px;">{{ $cervical_record['Malignancy']}}</td>
          <td style="width:100px;">{{ $cervical_record['Comments_spec']}}</td>

          <td style="width:100px;">{{ $cervical_record['Breast_self']}}</td>
          <td style="width:100px;">{{ $cervical_record['Breast_family_his']}}</td>
          <td style="width:100px;">{{ $cervical_record['Breast_examination']}}</td>
          <td style="width:100px;">{{ $cervical_record['Breast_abnormal_find_breast']}}</td>
          <td style="width:100px;">{{ $cervical_record['Breast_remark']}}</td>


          <td style="width:100px;">{{ $cervical_record['Sti_Complaint']}}</td>
          <td style="width:100px;">{{ $cervical_record['Sti_examination']}}</td>
          <td style="width:100px;">{{ $cervical_record['VIA_Screening_History']}}</td>
          <td style="width:100px;">{{ $cervical_record['VIA_test']}}</td>
          <td style="width:100px;">{{ $cervical_record['VIA_postpone_reason']}}</td>
          <td style="width:100px;">{{ $cervical_record['VIA_specify_reason']}}</td>
          <td style="width:100px;">{{ $cervical_record['SCJ']}}</td>
          <td style="width:100px;">{{ $cervical_record['VIA_test_Result']}}</td>
          <td style="width:100px;">{{ $cervical_record['refer_OG']}}</td>
          <td style="width:100px;">{{ $cervical_record['Counselling_VIA_result_done']}}</td>
          <td style="width:100px;">{{ $cervical_record['Eglible_thermal_ablation']}}</td>
          <td style="width:100px;">{{ $cervical_record['Eglible_thermal_ablation_reason']}}</td>
          <td style="width:100px;">{{ $cervical_record['Eglible_thermal_ablation_specify']}}</td>
          <td style="width:100px;">{{ $cervical_record['Thermal_ablation_done']}}</td>
          <td style="width:100px;">{{ $cervical_record['Thermal_No_specify']}}</td>
          <td style="width:100px;">{{ $cervical_record['Thermal_other_specify']}}</td>
          <td style="width:100px;">{{ $cervical_record['Thermal_ablation_result']}}</td>
          <td style="width:100px;">{{ $cervical_record['Thermal_ablation_performed']}}</td>
          <td style="width:100px;">{{$cervical_record['Postpone_date']}}</td>
          <td style="width:100px;">{{ $cervical_record['Date']}}</td>
          <td style="width:100px;">{{ $cervical_record['Followup_date']}}</td>
          <td style="width:100px;">{{ $cervical_record['Tertiary_Further_treatment']}}</td>
          <td style="width:100px;">{{ $cervical_record['AE_Date']}}</td>
          <td style="width:100px;">{{ $cervical_record['Complaint']}}</td>
          <td style="width:100px;">{{ $cervical_record['Complaint_yes']}}</td>
          <td style="width:100px;">{{ $cervical_record['Complaint_other']}}</td>
          <td style="width:100px;">{{ $cervical_record['Refer_Hosp']}}</td>
          <td style="width:100px;">{{ $cervical_record['AE_realated_thermal_ablation']}}</td>
          <td style="width:100px;">{{ $cervical_record['Treatment']}}</td>
          <td style="width:100px;">{{ $cervical_record['AE_followUp_Date']}}</td>
        </tr>

        @endforeach
      </tbody>
    </table>
  </form>

</body>

</html>
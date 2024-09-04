<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>

<body>
  <form action="" method="post">
    <table>
      <thead>
        <tr>
          <td syyle="text-align:center; width:100px;">Clinic ID</td>
          <td syyle="text-align:center; width:100px;">General ID</td>
          <td syyle="text-align:center; width:100px;">Fuchia ID</td>
          <td syyle="text-align:center; width:100px;">Register Year</td>
          <td syyle="text-align:center; width:100px;">Register Age</td>
          <td syyle="text-align:center; width:100px;">Register Age(Month)</td>

          <td syyle="text-align:center; width:100px;">Agey</td>
          <td syyle="text-align:center; width:100px;">Agem</td>
          <td syyle="text-align:center; width:100px;">Sex</td>
          <td syyle="text-align:center; width:100px;">Visit Date</td>
          <td syyle="text-align:center; width:100px;">KAP:</td>
          <td syyle="text-align:center; width:100px;">Mode of entry:</td>
          <td syyle="text-align:center; width:100px;">Date of TB screening:</td>
          <td syyle="text-align:center; width:100px;">Date of next visit:</td>
          <td syyle="text-align:center; width:100px;">HTC result:</td>
          <td syyle="text-align:center; width:100px;">HTC Date:</td>
          <td syyle="text-align:center; width:100px;">Sputum AFB result:</td>
          <td syyle="text-align:center; width:100px;">Sputum AFB date:</td>
          <td syyle="text-align:center; width:100px;">GeneXpert result:</td>
          <td syyle="text-align:center; width:100px;">GeneXpert date:</td>
          <td syyle="text-align:center; width:100px;">Place of CXR:</td>
          <td syyle="text-align:center; width:100px;">CXR date:</td>
          <td syyle="text-align:center; width:100px;">Lymphadenopathy:</td>{{-- may yan --}}
          <td syyle="text-align:center; width:100px;">Previous anti-TB history:</td>{{-- may yan --}}
          <td syyle="text-align:center; width:100px;">Fever (days):</td>
          <td syyle="text-align:center; width:100px;">Cough (days):</td>
          <td syyle="text-align:center; width:100px;">Night sweat (days):</td>
          <td syyle="text-align:center; width:100px;">LOW (days):</td>
          <td syyle="text-align:center; width:100px;">LOA (days):</td>
          <td syyle="text-align:center; width:100px;">Lymphadenopathy (days):</td>
          <td syyle="text-align:center; width:100px;">Lymphadenopathy(Describe)</td>
          <td syyle="text-align:center; width:100px;">Reason for CXR request:</td>
          <td syyle="text-align:center; width:100px;">Recheck after (days of antibiotics):</td>
          <td syyle="text-align:center; width:100px;">Months of anti-TB treatment:</td>
          <td syyle="text-align:center; width:100px;">MD's provisional diagnosis/action plan:</td>
          <td syyle="text-align:center; width:100px;">Antibiotics:</td>
          <td syyle="text-align:center; width:100px;">Suspicion on active TB:</td>
          <td syyle="text-align:center; width:100px;">Others:</td>
          <td syyle="text-align:center; width:100px;">Further consulting needed:</td>
          <td syyle="text-align:center; width:100px;">IF No, why:</td>
          <td syyle="text-align:center; width:100px;">Radiologist opinion:</td>
          <td syyle="text-align:center; width:100px;">MD's Management plan:</td>
          <td syyle="text-align:center; width:100px;">Need Tech team advice:</td>
          <td syyle="text-align:center; width:100px;">Teach Team advice(Describe)</td>
          <td syyle="text-align:center; width:100px;">MD's Name:</td>
          <td syyle="text-align:center; width:100px;">Case Noted:</td>

        </tr>
      </thead>
      <tbody>
        @foreach($tb_records as $tb_record)
        <tr>
          <td>{{$tb_record["Clinic_code"]}}</td>
          <td>{{$tb_record["Pid_preTB"]}}</td>
          <td>{{$tb_record["FuchiaID"]}}</td>
          <td style="width:80px;">{{ $tb_record['Reg year'] }}</td>
          <td style="width:80px;">{{ $tb_record['Register Agey']}}</td>
          <td style="width:80px;">{{ $tb_record['Register Agem']}}</td>
          <td style="width:80px;">{{ $tb_record['Current Agey']}}</td>
          <td style="width:80px;">{{ $tb_record['Current Agem']}}</td>
          <td style="width:100px;">{{ $tb_record['Gender']}}</td>

          <td>{{$tb_record["VisitDate_preTB"]}}</td>
          <td>{{$tb_record["KAP_preTB"]}}</td>
          <td>{{$tb_record["ModEntry_preTB"]}}</td>
          <td>{{$tb_record["TBscreenDate_preTB"]}}</td>
          <td>{{$tb_record["NextVDate_preTB"]}}</td>
          <td>{{$tb_record["HTCRes_preTB"]}}</td>
          <td>{{$tb_record["HTCDate_preTB"]}}</td>
          <td>{{$tb_record["AFBRes_preTB"]}}</td>
          <td>{{$tb_record["AFBDate_preTB"]}}</td>
          <td>{{$tb_record["GeneXpertRes_preTB"]}}</td>
          <td>{{$tb_record["GeneXpertDate_preTB"]}}</td>
          <td>{{$tb_record["CXRRes_preTB"]}}</td>
          <td>{{$tb_record["CXRDate_preTB"]}}</td>
          <td>{{$tb_record[""]}}</td>{{-- may yan --}}
          <td>{{$tb_record[""]}}</td>{{-- may yan --}}

          <td>{{$tb_record["FeverDay_preTB"]}}</td>
          <td>{{$tb_record["CoughDay_preTB"]}}</td>
          <td>{{$tb_record["NsweatDay_preTB"]}}</td>
          <td>{{$tb_record["LowDay_preTB"]}}</td>
          <td>{{$tb_record["LoaDay_preTB"]}}</td>

          <td>{{$tb_record["LympDay_preTB"]}}</td>
          <td>{{$tb_record["LympDes_preTB"]}}</td>
          <td>{{$tb_record["ReasonCXR_preTB"]}}</td>
          <td>{{$tb_record["Recheck_preTB"]}}</td>
          <td>{{$tb_record["Month_TBantiTre_preTB"]}}</td>
          <td>{{$tb_record["MDprovisional_diagnosisPlan_preTB"]}}</td>
          <td>{{$tb_record["Antibiotic_preTB"]}}</td>
          <td>{{$tb_record["Sus_ActiveTB_preTB"]}}</td>
          <td>{{$tb_record["Other_preTB"]}}</td>
          <td>{{$tb_record["FurtherCounsulting_preTB"]}}</td>
          <td>{{$tb_record["CounsulingNO_preTB"]}}</td>
          <td>{{$tb_record["Radiologist_preTB"]}}</td>
          <td>{{$tb_record["MDmanagementPlan_preTB"]}}</td>
          <td>{{$tb_record["TechAdvice_preTB"]}}</td>
          <td>{{$tb_record["TechAdvice_yes_preTB"]}}</td>
          <td>{{$tb_record["MDname_preTB"]}}</td>
          <td>{{$tb_record["CaseNode"]}}</td>

        </tr>

        @endforeach
      </tbody>
    </table>
  </form>
</body>

</html>
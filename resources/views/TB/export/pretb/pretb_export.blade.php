<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                @foreach ($pretb_exdataes as $pretb_exdata)
                    <tr> 
                        <td>{{$pretb_exdata["Clinic_code"]}}</td>
                        <td>{{$pretb_exdata["Pid_preTB"]}}</td>
                        <td>{{$pretb_exdata["FuchiaID"]}}</td>
                        <td style="width:80px;">{{ $pretb_exdata['Reg year'] }}</td>
                        <td style="width:80px;">{{ $pretb_exdata['Register Agey']}}</td>
                        <td style="width:80px;">{{ $pretb_exdata['Register Agem']}}</td>
                        <td style="width:80px;">{{ $pretb_exdata['Current Agey']}}</td>
                        <td style="width:80px;">{{ $pretb_exdata['Current Agem']}}</td>
                        <td style="width:100px;">{{ $pretb_exdata['Gender']}}</td>
                        <td>{{$pretb_exdata["KAP_preTB"]}}</td>
                        <td>{{$pretb_exdata["ModEntry_preTB"]}}</td>
                        <td>{{$pretb_exdata["TBscreenDate_preTB"]}}</td>
                        <td>{{$pretb_exdata["NextVDate_preTB"]}}</td>
                        <td>{{$pretb_exdata["HTCRes_preTB"]}}</td>
                        <td>{{$pretb_exdata["HTCDate_preTB"]}}</td>
                        <td>{{$pretb_exdata["AFBRes_preTB"]}}</td>
                        <td>{{$pretb_exdata["AFBDate_preTB"]}}</td>
                        <td>{{$pretb_exdata["GeneXpertRes_preTB"]}}</td>
                        <td>{{$pretb_exdata["GeneXpertDate_preTB"]}}</td>
                        <td>{{$pretb_exdata["CXRRes_preTB"]}}</td>
                        <td>{{$pretb_exdata["CXRDate_preTB"]}}</td>
                        <td>{{$pretb_exdata["may yan"]}}</td>{{-- may yan --}}
                        <td>{{$pretb_exdata["may yan"]}}</td>{{-- may yan --}}
                        
                        <td>{{$pretb_exdata["FeverDay_preTB"]}}</td>
                        <td>{{$pretb_exdata["CoughDay_preTB"]}}</td>
                        <td>{{$pretb_exdata["NsweatDay_preTB"]}}</td>
                        <td>{{$pretb_exdata["LowDay_preTB"]}}</td>
                        <td>{{$pretb_exdata["LoaDay_preTB"]}}</td>
                       
                        <td>{{$pretb_exdata["LympDay_preTB"]}}</td>
                        <td>{{$pretb_exdata["LympDes_preTB"]}}</td>
                        <td>{{$pretb_exdata["ReasonCXR_preTB"]}}</td>
                        <td>{{$pretb_exdata["Recheck_preTB"]}}</td>
                        <td>{{$pretb_exdata["Month_TBantiTre_preTB"]}}</td>
                        <td>{{$pretb_exdata["MDprovisional_diagnosisPlan_preTB"]}}</td>
                        <td>{{$pretb_exdata["Antibiotic_preTB"]}}</td>
                        <td>{{$pretb_exdata["Sus_ActiveTB_preTB"]}}</td>
                        <td>{{$pretb_exdata["Other_preTB"]}}</td>
                        <td>{{$pretb_exdata["FurtherCounsulting_preTB"]}}</td>
                        <td>{{$pretb_exdata["CounsulingNO_preTB"]}}</td>
                        <td>{{$pretb_exdata["Radiologist_preTB"]}}</td>
                        <td>{{$pretb_exdata["MDmanagementPlan_preTB"]}}</td>
                        <td>{{$pretb_exdata["TechAdvice_preTB"]}}</td>
                        <td>{{$pretb_exdata["TechAdvice_yes_preTB"]}}</td>
                        <td>{{$pretb_exdata["MDname_preTB"]}}</td>
                        <td>{{$pretb_exdata["CaseNode"]}}</td>

                    </tr>
                    
                @endforeach
            </tbody>
        </table>
    </form>
</body>
</html>
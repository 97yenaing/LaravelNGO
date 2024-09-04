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
		<table>
			<thead>
				<tr>
					<th style="width:150px">State/Region Name</th>
					<th style="width:150px">Township Name</th>
					<th style="width:150px">Facility Name</th>
					<th style="width:150px">Reporting Period</th>
					<th style="width:150px">Treatment Registar Date</th>
					{{-- <th style="width:150px">General ID</th> --}}
					<th style="width:150px">TB Code</th>
					<th style="width:150px">Nationality</th>
					<th style="width:150px">Sex</th>
					{{-- <th style="width:150px">Reg Year</th> --}}

					<th style="width:150px">Register Age</th>
					{{-- <th style="width:150px">Register Age("Month")</th>
					<th style="width:150px">Current Age</th>
					<th style="width:150px">Current Age("Month")</th> --}}
					<th style="width:150px">Refered from </th>

					<th style="width:150px">Type of Patient's</th>
					<th style="width:150px">Type of Disease</th>
					<th style="width:150px">Specify ______ (if EP)
						Site of EPTB
					</th>
					<th style="width:150px">Transfer in</th>
					<th style="width:150px">Treatment Regimens</th>
					<th style="width:150px">Treatment Start Date</th>
					<th style="width:150px">Smoking Status</th>
					<th style="width:150px">DM Status</th>
					<th style="width:150px">HIV Status</th>
					<th style="width:150px">CPT Start Date</th>
					<th style="width:150px">ART Start Date</th>
					<th style="width:150px">Microscope Result</th>
					<th style="width:150px">X-Ray Result</th>
					<th style="width:150px">Xpert Result</th>
					<th style="width:150px">Culture Result</th>

					<th style="width:150px">2nd month Microscope Result</th>
					<th style="width:150px">2nd month Xpert Result</th>
					<th style="width:150px">2nd month Culture</th>
					<th style="width:150px">3rd month Microscope Result</th>
					<th style="width:150px">3rd month Xpert Result</th>
					<th style="width:150px">3rd month Culture</th>
					<th style="width:150px">5th month Microscope Result</th>

					<th style="width:150px">5th month Xpert Result</th>
					<th style="width:150px">5th month Culture</th>
					<th style="width:150px">End of Tx Microscope Result</th>

					<th style="width:150px">End of Tx X-Ray Result</th>

					<th style="width:150px">End of Tx Xpert Result</th>
					<th style="width:150px">1st line DST result</th>
					<th style="width:150px">Treatment Outcome</th>
					<th style="width:150px">Initial Regimen Started Date</th>
					<th style="width:150px">Outcome Date</th>
					<th style="width:150px">bacteriological/clinical </th>
					<th style="width:150px">Consular Name</th>
					<th style="width:150px">Remark</th>
					<th style="width:150px">Fuchia ID</th>
					<th style="width:150px">General ID</th>

				</tr>

			</thead>
			<tbody>
				@foreach($tb03_exdataes as $tb03_exdata)
				<tr>
					<td style="text-align:center">{{$tb03_exdata["State_TB03"]}}</td>
					<td style="text-align:center">{{$tb03_exdata["Township_TB03"]}}</td>
					<td style="text-align:center">{{$tb03_exdata["FaciName_TB03"]}}</td>
					<td style="text-align:center">{{$tb03_exdata["RePariod_TB03"]}}</td>
					<td style="text-align:center">{{$tb03_exdata["TreDate_TB03"]}}</td>
					<td style="text-align:center">{{$tb03_exdata["TNumber_TB03"]}}</td>
					{{-- <td style="text-align:center">{{$tb03_exdata["Pid_TB03"]}}</td> --}}
					<td style="text-align:center">{{$tb03_exdata["Nationality_TB03"]}}</td>
					<td style="text-align:center">{{$tb03_exdata["Gender"]}}</td>
					{{-- <td style="width:80px;">{{ $tb03_exdata['Reg year']}}</td> --}}
					<td style="width:80px;">{{ $tb03_exdata['Register Agey']}}</td>
					{{-- <td style="width:80px;">{{ $tb03_exdata['Register Agem']}}</td>
					<td style="width:80px;">{{ $tb03_exdata['Current Agey']}}</td>
					<td style="width:80px;">{{ $tb03_exdata['Current Agem']}}</td> --}}
					<td style="text-align:center">{{$tb03_exdata["ReferFrom_TB03"]}}</td>

					<td style="text-align:center">{{$tb03_exdata["TypePatient_TB03"]}}</td>
					<td style="text-align:center">{{$tb03_exdata["TBsite_TB03"]}}</td>
					<td style="text-align:center">{{$tb03_exdata["EPTBsite_TB03"]}}</td>
					<td style="text-align:center">{{$tb03_exdata["TranferIn_TB03"]}}</td>
					<td style="text-align:center">{{$tb03_exdata["TreRegimens_TB03"]}}</td>
					<td style="text-align:center">{{$tb03_exdata["TreDate_TB03"]}}</td>
					<td style="text-align:center">{{$tb03_exdata["Smoke_status_TB03"]}}</td>
					<td style="text-align:center">{{$tb03_exdata["DMstatue_TB03"]}}</td>
					<td style="text-align:center">{{$tb03_exdata["Hivstatus_TB03"]}}</td>
					<td style="text-align:center">{{$tb03_exdata["CPT_start_TB03"]}}</td>
					<td style="text-align:center">{{$tb03_exdata["ART_start_TB03"]}}</td>
					<td style="text-align:center">{{$tb03_exdata["Microscope_Res_TB03"]}}</td>
					<td style="text-align:center">{{$tb03_exdata["XRay_Res_TB03"]}}</td>
					<td style="text-align:center">{{$tb03_exdata["Xpert_Res_TB03"]}}</td>
					<td style="text-align:center">{{$tb03_exdata["Calture_Res_TB03"]}}</td>
					<td style="text-align:center">{{$tb03_exdata["2ndMicroscope_Res_TB03"]}}</td>
					<td style="text-align:center">{{$tb03_exdata["2ndXpert_Res_TB03"]}}</td>
					<td style="text-align:center">{{$tb03_exdata["2ndCulture_Res_TB03"]}}</td>
					<td style="text-align:center">{{$tb03_exdata["3rdMicroscope_Res_TB03"]}}</td>
					<td style="text-align:center">{{$tb03_exdata["3rdXpert_Res_TB03"]}}</td>
					<td style="text-align:center">{{$tb03_exdata["3rdCulture_Res_TB03"]}}</td>
					<td style="text-align:center">{{$tb03_exdata["5rdMicroscope_Res_TB03"]}}</td>
					<td style="text-align:center">{{$tb03_exdata["5rdXpert_Res_TB03"]}}</td>
					<td style="text-align:center">{{$tb03_exdata["5rdCulture_Res_TB03"]}}</td>
					<td style="text-align:center">{{$tb03_exdata["EndTX_Microscope_Res_TB03"]}}</td>
					<td style="text-align:center">{{$tb03_exdata["EndTX_XRay_Res_TB03"]}}</td>
					<td style="text-align:center">{{$tb03_exdata["EndTX_Xpert_Res_TB03"]}}</td>
					<td style="text-align:center">{{$tb03_exdata["1stDst"]}}</td>
					<td style="text-align:center">{{$tb03_exdata["TrementOut_TB03"]}}</td>
					<td style="text-align:center">{{$tb03_exdata["Intial_RegimenDate_TB03"]}}</td>
					<td style="text-align:center">{{$tb03_exdata["TrementOut_Date_TB03"]}}</td>
					<td style="text-align:center">{{$tb03_exdata["BioClinical_TB03"]}}</td>
					<td style="text-align:center">{{$tb03_exdata["Counsellor_TB03"]}}</td>
					<td style="text-align:center">{{$tb03_exdata["Remark_TB03"]}}</td>
					<td style="text-align:center">{{$tb03_exdata["FuchiaID_TB03"]}}</td>
					<td style="text-align:center">{{$tb03_exdata["Pid_TB03"]}}</td>

				</tr>
				@endforeach
			</tbody>
		</table>
	</form>

</body>

</html>
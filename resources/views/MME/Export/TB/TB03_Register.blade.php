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
          <th style="width:150px">State/Region Name</th>
          <th style="width:150px">Township Name</th>
          <th style="width:150px">Facility Name</th>
          <th style="width:150px">Reporting Period</th>
          <th style="width:150px">Treatment Registar Date</th>

          <th style="width:150px">TB Code</th>
          <th style="width:150px">Nationality</th>
          <th style="width:150px">Sex</th>


          <th style="width:150px">Register Age</th>
          <th style="width:150px">Current Age</th>
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
        @foreach($tb_records as $tb_record)
        <tr>
          <td style="text-align:center">{{$tb_record["State_TB03"]}}</td>
          <td style="text-align:center">{{$tb_record["Township_TB03"]}}</td>
          <td style="text-align:center">{{$tb_record["FaciName_TB03"]}}</td>
          <td style="text-align:center">{{$tb_record["RePariod_TB03"]}}</td>
          <td style="text-align:center">{{$tb_record["TreDate_TB03"]}}</td>
          <td style="text-align:center">{{$tb_record["TNumber_TB03"]}}</td>

          <td style="text-align:center">{{$tb_record["Nationality_TB03"]}}</td>
          <td style="text-align:center">{{$tb_record["Gender"]}}</td>

          <td style="width:80px;">{{ $tb_record['Register Agey']}}</td>

          <td style="width:80px;">{{ $tb_record['Current Agey']}}</td>
          <td style="width:80px;">{{ $tb_record['Current Agem']}}</td> --}}
          <td style="text-align:center">{{$tb_record["ReferFrom_TB03"]}}</td>

          <td style="text-align:center">{{$tb_record["TypePatient_TB03"]}}</td>
          <td style="text-align:center">{{$tb_record["TBsite_TB03"]}}</td>
          <td style="text-align:center">{{$tb_record["EPTBsite_TB03"]}}</td>
          <td style="text-align:center">{{$tb_record["TranferIn_TB03"]}}</td>
          <td style="text-align:center">{{$tb_record["TreRegimens_TB03"]}}</td>
          <td style="text-align:center">{{$tb_record["TreDate_TB03"]}}</td>
          <td style="text-align:center">{{$tb_record["Smoke_status_TB03"]}}</td>
          <td style="text-align:center">{{$tb_record["DMstatue_TB03"]}}</td>
          <td style="text-align:center">{{$tb_record["Hivstatus_TB03"]}}</td>
          <td style="text-align:center">{{$tb_record["CPT_start_TB03"]}}</td>
          <td style="text-align:center">{{$tb_record["ART_start_TB03"]}}</td>
          <td style="text-align:center">{{$tb_record["Microscope_Res_TB03"]}}</td>
          <td style="text-align:center">{{$tb_record["XRay_Res_TB03"]}}</td>
          <td style="text-align:center">{{$tb_record["Xpert_Res_TB03"]}}</td>
          <td style="text-align:center">{{$tb_record["Calture_Res_TB03"]}}</td>
          <td style="text-align:center">{{$tb_record["2ndMicroscope_Res_TB03"]}}</td>
          <td style="text-align:center">{{$tb_record["2ndXpert_Res_TB03"]}}</td>
          <td style="text-align:center">{{$tb_record["2ndCulture_Res_TB03"]}}</td>
          <td style="text-align:center">{{$tb_record["3rdMicroscope_Res_TB03"]}}</td>
          <td style="text-align:center">{{$tb_record["3rdXpert_Res_TB03"]}}</td>
          <td style="text-align:center">{{$tb_record["3rdCulture_Res_TB03"]}}</td>
          <td style="text-align:center">{{$tb_record["5rdMicroscope_Res_TB03"]}}</td>
          <td style="text-align:center">{{$tb_record["5rdXpert_Res_TB03"]}}</td>
          <td style="text-align:center">{{$tb_record["5rdCulture_Res_TB03"]}}</td>
          <td style="text-align:center">{{$tb_record["EndTX_Microscope_Res_TB03"]}}</td>
          <td style="text-align:center">{{$tb_record["EndTX_XRay_Res_TB03"]}}</td>
          <td style="text-align:center">{{$tb_record["EndTX_Xpert_Res_TB03"]}}</td>
          <td style="text-align:center">{{$tb_record["1stDst"]}}</td>
          <td style="text-align:center">{{$tb_record["TrementOut_TB03"]}}</td>
          <td style="text-align:center">{{$tb_record["Intial_RegimenDate_TB03"]}}</td>
          <td style="text-align:center">{{$tb_record["TrementOut_Date_TB03"]}}</td>
          <td style="text-align:center">{{$tb_record["BioClinical_TB03"]}}</td>
          <td style="text-align:center">{{$tb_record["Counsellor_TB03"]}}</td>
          <td style="text-align:center">{{$tb_record["Remark_TB03"]}}</td>
          <td style="text-align:center">{{$tb_record["FuchiaID_TB03"]}}</td>
          <td style="text-align:center">{{$tb_record["Pid_TB03"]}}</td>

        </tr>
        @endforeach
      </tbody>
    </table>
  </form>
</body>

</html>
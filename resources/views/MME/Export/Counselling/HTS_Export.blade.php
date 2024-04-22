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
          <th style="width:80px;">Clinic Code</th>
          <th style="width:80px;">Pid</th>
          <th style="width:80px;">FuchiaID</th>
          <th style="width:80px;">Gender</th>
          <th style="width:80px;">Register Year</th>
          <th style="width:80px;">Register Age</th>
          <th style="width:80px;">Register Age(Month)</th>
          <th style="width:80px;">Current Age</th>
          <th style="width:80px;">Current Age(Month)</th>
          <th style="width:80px;">Counselling Date</th>
          <th style="width:80px;">Counselor</th>
          <th style="width:80px;">Pre</th>
          <th style="width:80px;">Post</th>
          <th style="width:80px;">Service Modality</th>
          <th style="width:80px;">Mode of Entry</th>
          <th style="width:80px;">New_Old</th>
          <th style="width:80px;">Test Location</th>
          <th style="width:80px;">Main Risk</th>
          <th style="width:80px;">Sub Risk</th>
          <th style="width:80px;">HIV Test Date</th>
          <th style="width:80px;">HIV Test Determine</th>
          <th style="width:80px;">HIV Test UNI</th>
          <th style="width:80px;">HIV Test STAT</th>
          <th style="width:80px;">HIV Final Result</th>
          <th style="width:80px;">Syphillis Test Date</th>
          <th style="width:80px;">Syphillis RDT</th>
          <th style="width:80px;">Syphillis RPR</th>
          <th style="width:80px;">Syphillis VDRL</th>
          <th style="width:80px;">HepB/C Test Date</th>
          <th style="width:80px;">Hepatitis B</th>
          <th style="width:80px;">Hepatitis C</th>
          <th style="width:80px;">Request MD</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($counselling_records as $counselling_record)
          <tr>
            <td>{{ $counselling_record["Clinic Code"] }}</td>
            <td>{{ $counselling_record["Pid"] }}</td>
            <td>{{ $counselling_record["FuchiaID"] }}</td>
            <td>{{ $counselling_record["Gender"] }}</td>
            <td style="width:80px;">{{ $counselling_record["Reg year"] }}</td>
            <td style="width:80px;">{{ $counselling_record["Register Agey"] }}</td>
            <td style="width:80px;">{{ $counselling_record["Register Agem"] }}</td>
            <td style="width:80px;">{{ $counselling_record["Current Agey"] }}</td>
            <td style="width:80px;">{{ $counselling_record["Current Agem"] }}</td>
            <td>{{ $counselling_record["Counselling_Date"] }}</td>
            <td>{{ $counselling_record["Counsellor"] }}</td>
            <td>{{ $counselling_record["Pre"] }}</td>
            <td>{{ $counselling_record["Post"] }}</td>
            <td>{{ $counselling_record["Service_Modality"] }}</td>
            <td>{{ $counselling_record["Mode of Entry"] }}</td>
            <td>{{ $counselling_record["New_Old"] }}</td>
            <td>{{ $counselling_record["Test_Location"] }}</td>
            <td>{{ $counselling_record["Main Risk"] }}</td>
            <td>{{ $counselling_record["Sub Risk"] }}</td>
            <td>{{ $counselling_record["HIV_Test_Date"] }}</td>
            <td>{{ $counselling_record["HIV_Test_Determine"] }}</td>
            <td>{{ $counselling_record["HIV_Test_UNI"] }}</td>
            <td>{{ $counselling_record["HIV_Test_STAT"] }}</td>
            <td>{{ $counselling_record["HIV_Final_Result"] }}</td>
            <td>{{ $counselling_record["Syp_Test_Date"] }}</td>
            <td>{{ $counselling_record["Syphillis_RDT"] }}</td>
            <td>{{ $counselling_record["Syphillis_RPR"] }}</td>
            <td>{{ $counselling_record["Syphillis_VDRL"] }}</td>
            <td>{{ $counselling_record["Hep_Test_Date"] }}</td>
            <td>{{ $counselling_record["Hepatitis_B"] }}</td>
            <td>{{ $counselling_record["Hepatitis_C"] }}</td>
            <td>{{ $counselling_record["Req_Doctor"] }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </form>
</body>

</html>

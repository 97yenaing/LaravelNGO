<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Import Export Excel </title>
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
        <!-- <form action="{{ route('lab_export_link') }}" method="POST" > -->
          <form action="{{ route('counsellor_export') }}"  method="POST" >
            @csrf
            <h1>HIV</h1>
            <table>
              <thead>
         
                <tr>
                  <th style="background-color:#a6a6a6;">Clinic Code</th>
                  <th style="background-color:#a6a6a6;">General ID</th>
                  <th style="background-color:#a6a6a6;">Fuchia ID</th>
                  <th style="background-color:#a6a6a6;">Reg Year</th>
                  <th style="background-color:#a6a6a6;">Register Age</th>
                  <th style="background-color:#a6a6a6;">Register Age(Month)</th>
                  <th style="background-color:#a6a6a6;">Current Age</th>
                  <th style="background-color:#a6a6a6;">Current Agem(Month)</th>
                  <th style="background-color:#a6a6a6;">Gender</th>
                  <th style="background-color:green;">Main Risk</th>
                  <th style="background-color:green;">Sub Risk</th>
                  <th style="background-color:#a6a6a6;">Visit Date</th>
                  <th style="background-color:#a6a6a6;">Blood Collection Date</th>
                  <th style="background-color:green;">Determine Result</th>
                  <th style="background-color:green;">Unigold Result</th>
                  <th style="background-color:green;">STAT PAK Result</th>
                  <th style="background-color:green;">Final Result</th>
                  <th style="background-color:#a6a6a6;">Requested Dr</th>
                  <th style="background-color:#a6a6a6;">Inconclusive</th>
                  <th style="background-color:#a6a6a6;">Counsellor</th>
                  <th style="background-color:#a6a6a6;">Lab Technician</th>
                  <th style="background-color:#a6a6a6;">Created Date_Time</th>
                  <th style="background-color:#a6a6a6;">Updated Date_ime</th>
                 
                </tr>
              </thead>

              <tbody>
                @foreach($users as $index => $value)
                <tr>
                      <td style="width:100px;">{{ $value['Clinic Code'] }}</td>
                      <td style="width:100px;">{{ $value['CID'] }}</td>
                      <td style="width:100px;">{{ $value['fuchiacode'] }}</td>
                      <td style="width:80px;">{{ $value['Reg year'] }}</td>
                      <td style="width:80px;">{{ $value['Register Agey'] }}</td>
                      <td style="width:80px;">{{ $value['Register Agem'] }}</td>
                      <td style="width:80px;">{{ $value['Current Agey'] }}</td>
                      <td style="width:80px;">{{ $value['Current Agem'] }}</td>
                      <td style="width:100px;">{{ $value['Gender'] }}</td>
                      <td style="width:100px;">{{ $value['Patient_Type'] }}</td>
                      <td style="width:100px;">{{ $value['Patient Type Sub'] }}</td>
                      <td style="width:100px;">{{ $value['vdate'] }}</td>
                      <td style="width:100px;">{{ $value['bcollectdate'] }}</td>
                      <td style="width:100px;">{{ $value['Detmine_Result'] }}</td>
                      <td style="width:100px;">{{ $value['Unigold_Result'] }}</td>
                      <td style="width:100px;">{{ $value['STAT_PAK_Result'] }}</td>
                      <td style="width:100px;">{{ $value['Final_Result'] }}</td>
                      <td style="width:100px;">{{ $value['Req_Doctor'] }}</td>
                      <td style="width:100px;">{{ $value['Incon'] }}</td>
                      <td style="width:100px;">{{ $value['Counsellor'] }}</td>
                      <td style="width:100px;">{{ $value['LabTech'] }}</td>
                      <td style="width:100px;">{{ $value['created_at'] }}</td>
                      <td style="width:100px;">{{ $value['updated_at'] }}</td>
                </tr>
                @endforeach
              </tbody>
            </table>





        </form>
    </div>
</body>

</html>

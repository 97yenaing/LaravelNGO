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
           
            <table>
              <thead>
                <tr>
                  <th style="background-color:#a6a6a6;">Clinic Code</th>
                  <th style="background-color:#a6a6a6;">General ID</th>
                  <th style="background-color:#a6a6a6;">Fuchia ID</th>
                  <th style="background-color:#a6a6a6;">Register Year</th>
                  <th style="background-color:#a6a6a6;">Register Agey</th>
                  <th style="background-color:#a6a6a6;">Register Agem(Month)</th>
                  <th style="background-color:#a6a6a6;">Current Agey</th>
                  <th style="background-color:#a6a6a6;">Current Agem(Month)</th>
                  <th style="background-color:#a6a6a6;">Gender</th>
                  <th style="background-color:#a6a6a6;">Requested Doctor</th>
                 
                  <th style="background-color:#a6a6a6;">Visit Date</th>
                  <th style="background-color:#a6a6a6;">Main Risk</th>
                  <th style="background-color:#a6a6a6;">Sub Risk</th>
                  <th style="background-color:#a6a6a6;">Type of Patient</th>
                  <th style="background-color:#a6a6a6;">Specimen Type</th>
                  <th style="background-color:#a6a6a6;">Test Type</th>
                  <th style="background-color:#a6a6a6;">Result</th>
                  <th style="background-color:#a6a6a6;">Lab Technician</th>
                  <th style="background-color:#a6a6a6;">Issue Date</th>
                 
                 

                </tr>
              </thead>

              <tbody>
                @foreach($users as $index => $value)
                <tr>
                  <td style="width:50px;">{{ $value['Clinic Code'] }}</td>
                    <td style="width:100px;">{{ $value['CID'] }}</td>
                    <td style="width:100px;">{{ $value['fuchiacode'] }}</td>
                    <td style="width:80px;">{{ $value['Reg year'] }}</td>
                    <td style="width:80px;">{{ $value['Register Agey'] }}</td>
                    <td style="width:80px;">{{ $value['Register Agem'] }}</td>
                    <td style="width:80px;">{{ $value['Current Agey'] }}</td>
                    <td style="width:80px;">{{ $value['Current Agem'] }}</td>
                    <td style="width:100px;">{{ $value['Gender'] }}</td>
                    <td style="width:100px;">{{ $value['Req_Doctor'] }}</td>
                    <td style="width:100px;">{{ $value['vdate'] }}</td>
                    <td style="width:100px;">{{ $value['Patient_Type'] }}</td>
                    <td style="width:100px;">{{ $value['Patient Type Sub'] }}</td>
                    <td style="width:100px;">{{ $value['type_of_patient_covid'] }}</td>
                    <td style="width:100px;">{{ $value['specimen_type'] }}</td>
                    <td style="width:100px;">{{ $value['co_test_type'] }}</td>
                    <td style="width:100px;">{{ $value['covid_result'] }}</td>
                    <td style="width:100px;">{{ $value['covid_lab_tech'] }}</td>
                    <td style="width:100px;">{{ $value['covid_issue_date'] }}</td>
                </tr>
                @endforeach
              </tbody>
            </table>





        </form>
    </div>
</body>

</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Import Export Excel </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
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
                    <th style="background-color:#a6a6a6;">Visit Date</th>

                    <th style="background-color:#a6a6a6;">Requested Dr</th>
                    <th style="background-color:#a6a6a6;">Main Risk</th>
                    <th style="background-color:#a6a6a6;">Sub Risk</th>
                    <th style="background-color:#a6a6a6;">Test_done</th>
                    <th style="background-color:#a6a6a6;">Type of Test</th>
                    <th style="background-color:#a6a6a6;">Apperance</th>
                    <th style="background-color:#a6a6a6;">Tubitity</th>
                    <th style="background-color:#a6a6a6;"> PUS/WBC </th>
                    <th style="background-color:#a6a6a6;">PH</th>
                    <th style="background-color:#a6a6a6;">Protein</th>
                    <th style="background-color:#a6a6a6;">Glucose</th>
                    <th style="background-color:#a6a6a6;">RBC</th>
                    <th style="background-color:#a6a6a6;">Leukocyte</th>
                    <th style="background-color:#a6a6a6;">Nitrite</th>
                    <th style="background-color:#a6a6a6;">Ketone</th>
                    <th style="background-color:#a6a6a6;">Epithelial</th>
                    <th style="background-color:#a6a6a6;">Urobilinogen</th>
                    <th style="background-color:#a6a6a6;">Bilirubin</th>
                    <th style="background-color:#a6a6a6;">Erythrocyte</th>
                    <th style="background-color:#a6a6a6;">Crystal</th>
                    <th style="background-color:#a6a6a6;">Haemoglobin</th>
                    <th style="background-color:#a6a6a6;">Cast</th>
                    <th style="background-color:#a6a6a6;">Other</th>
                    <th style="background-color:#a6a6a6;">Cretinine</th>
                    <th style="background-color:#a6a6a6;">Albumin</th>
                    <th style="background-color:#a6a6a6;">A:C_ratio</th>
                    <th style="background-color:#a6a6a6;">Comment</th>
                    <th style="background-color:#a6a6a6;">Lab Technician</th>
                    <th style="background-color:#a6a6a6;">Issue Date</th>
                    
                 
                </tr>
              </thead>

              <tbody>
                @foreach($users as $index => $value)
                <tr>
                  {{-- @dd($value) --}}

                    <td style="width:50px;">{{ $value['Clinic Code'] }}</td>
                    <td style="width:100px;">{{ $value['CID'] }}</td>
                    <td style="width:100px;">{{ $value['fuchiacode'] }}</td>
                    <td style="width:80px;">{{ $value['Reg year'] }}</td>
                    <td style="width:80px;">{{ $value['Register Agey'] }}</td>
                    <td style="width:80px;">{{ $value['Register Agem'] }}</td>
                    <td style="width:80px;">{{ $value['Current Agey'] }}</td>
                    <td style="width:80px;">{{ $value['Current Agem'] }}</td>
                    <td style="width:50px;">{{ $value['Gender'] }}</td>
                    <td style="width:100px;">{{ $value['vdate'] }}</td>
                    <td style="width:100px;">{{ $value['Req_Doctor'] }}</td>
                    <td style="width:100px;">{{ $value['Patient_Type'] }}</td>
                    <td style="width:100px;">{{ $value['Patient Type Sub'] }}</td>
                    <td style="width:50px;">{{ $value['Utest_done'] }}</td>
                    <td style="width:50px;">{{ $value['Utot'] }}</td>
                    <td style="width:50px;">{{ $value['Ucolor'] }}</td>
                    <td style="width:50px;">{{ $value['tubitity'] }}</td>
                    <td style="width:50px;">{{ $value['Upus'] }}</td>
                    <td style="width:50px;">{{ $value['ph'] }}</td>
                    <td style="width:50px;">{{ $value['Uprotein'] }}</td>
                    <td style="width:50px;">{{ $value['Uglucose'] }}</td>
                    <td style="width:50px;">{{ $value['Urbc'] }}</td>
                    <td style="width:50px;">{{ $value['Uleu'] }}</td>
                    <td style="width:50px;">{{ $value['Unitrite'] }}</td>
                    <td style="width:50px;">{{ $value['Uketone'] }}</td>
                    <td style="width:50px;">{{ $value['Uepithelial'] }}</td>
                    <td style="width:50px;">{{ $value['Urobili'] }}</td>
                    <td style="width:50px;">{{ $value['Ubillru'] }}</td>
                    <td style="width:50px;">{{ $value['Uery'] }}</td>
                    <td style="width:50px;">{{ $value['Ucrystal'] }}</td>
                    <td style="width:50px;">{{ $value['Uhae'] }}</td>
                    <td style="width:50px;">{{ $value['Ucast'] }}</td>
                    <td style="width:50px;">{{ $value['Uother'] }}</td>
                    <td style="width:50px;">{{ $value['Cretinine'] }}</td>
                    <td style="width:50px;">{{ $value['Albumin'] }}</td>
                    <td style="width:50px;">{{ $value['A:C_ratio'] }}</td>
                    <td style="width:50px;">{{ $value['comment'] }}</td>
                    <td style="width:100px;">{{ $value['lab_tech'] }}</td>
                    <td style="width:100px;">{{ $value['issue_date'] }}</td>
                </tr>
                @endforeach
              </tbody>
            </table>





        </form>
    </div>
</body>

</html>

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
        <!-- <form action="{{ route('reception_export') }}" method="POST" > -->
          <form action="{{ route('counsellor_export') }}"  method="POST" >
            @csrf
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
                @foreach($users1 as  $user1)
                  
                <tr>
                    <td >{{ $user1['Clinic Code'] }}</td>
                    <td >{{ $user1['Pid'] }}</td>
                    <td >{{ $user1['FuchiaID'] }}</td>
                    <td >{{ $user1['Gender'] }}</td>
                    <td style="width:80px;">{{ $user1['Reg year'] }}</td>
                    <td style="width:80px;">{{ $user1['Register Agey'] }}</td>
                    <td style="width:80px;">{{ $user1['Register Agem'] }}</td>
                    <td style="width:80px;">{{ $user1['Current Agey'] }}</td>
                    <td style="width:80px;">{{ $user1['Current Agem'] }}</td>
                    <td >{{ $user1['Counselling_Date'] }}</td>
                    <td >{{ $user1['Counsellor'] }}</td>
                    <td >{{ $user1['Pre'] }}</td>
                    <td >{{ $user1['Post'] }}</td>
                    <td >{{ $user1['Service_Modality'] }}</td>
                    <td >{{ $user1['Mode of Entry'] }}</td>
                    <td >{{ $user1['New_Old'] }}</td>
                    <td >{{ $user1['Test_Location'] }}</td> 
                    <td >{{ $user1['Main Risk'] }}</td>
                    <td >{{ $user1['Sub Risk'] }}</td>
                    <td >{{ $user1['HIV_Test_Date'] }}</td>
                    <td >{{ $user1['HIV_Test_Determine'] }}</td>
                    <td >{{ $user1['HIV_Test_UNI'] }}</td>
                    <td >{{ $user1['HIV_Test_STAT'] }}</td>
                    <td >{{ $user1['HIV_Final_Result'] }}</td>
                    <td >{{ $user1['Syp_Test_Date'] }}</td>
                    <td >{{ $user1['Syphillis_RDT'] }}</td>
                    <td >{{ $user1['Syphillis_RPR'] }}</td>
                    <td >{{ $user1['Syphillis_VDRL'] }}</td>
                    <td >{{ $user1['Hep_Test_Date'] }}</td>
                    <td >{{ $user1['Hepatitis_B'] }}</td>
                    <td >{{ $user1['Hepatitis_C'] }}</td>
                    <td >{{ $user1['Req_Doctor'] }}</td>



                </tr>
                @endforeach
              </tbody>
            </table>





        </form>
    </div>
</body>

</html>

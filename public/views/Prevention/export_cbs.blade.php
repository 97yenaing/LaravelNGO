<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Export Excel </title>
   
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
          <h1>CBS</h1>
          <form action="{{ route('prevention_data') }}"  method="POST" >
            @csrf
            <table>
              <thead>
                <tr>
                  <th style="background-color:#a6a6a6; width:100px;">He Code</th>
                  <th style="background-color:#a6a6a6; width:100px;">Clinic Code</th>
                  <th style="background-color:#a6a6a6; width:100px;">Register Year</th>
                  <th style='background-color:#a6a6a6;'>Pid</th>
                  <th style='background-color:#a6a6a6;'>FuchiaID</th>
                  <th style='background-color:#a6a6a6;'>PrEPCode</th>
                  <th style='background-color:#a6a6a6;'>Visit_Date</th>
                  
                  <th style='background-color:#a6a6a6;'>Register Agey</th>
                 
                  <th style='background-color:#a6a6a6;'>Current Agey</th>
                  
                  <th style='background-color:#a6a6a6;'>Sex</th>
                  <th style='background-color:#a6a6a6;'>Main_Risk</th>
                  <th style='background-color:#a6a6a6;'>Sub_Risk</th>

                  <th style='background-color:#a6a6a6;'>New_Old</th>
                  <th style='background-color:#a6a6a6;'>Meeting Point</th>
                  <th style='background-color:#a6a6a6;'>Service Provision</th>
                  <th style='background-color:#a6a6a6;'>Retesting</th>
                  <th style='background-color:#a6a6a6;'>HIV_determine_result</th>
                  <th style='background-color:#a6a6a6;'>HIV Sero-Status</th>
                  <th style='background-color:#a6a6a6;'>Counselling_pretest</th>
                  <th style='background-color:#a6a6a6;'>Counselling_posttest</th>
                  <th style='background-color:#a6a6a6;'>Refer_to</th>
                  <th style='background-color:#a6a6a6;'>date_confirm</th>
                  <th style='background-color:#a6a6a6;'>HIV Sero-Status</th>
                  <th style='background-color:#a6a6a6;'>Remark</th>


                 
                </tr>
              </thead>

              <tbody>
                @foreach($users as $index => $value)
                <tr>
                    <td> {{ $users[$index]['He Code']  }} </td>
                    <td style="width:80px;">{{ $users[$index]['Clinic Code'] }}</td>
                    <td style="width:80px;">{{ $users[$index]['Reg year'] }}</td>
                    
                    <td style="width:80px;">{{ $users[$index]['Pid'] }} </td>
                    <td style="width:80px;">{{ $users[$index]['FuchiaID'] }} </td>
                    <td style="width:80px;">{{ $users[$index]['PrEPCode'] }} </td>
                    <td style="width:80px;">{{ $users[$index]['Visit_Date'] }} </td>
                    
                    <td style="width:80px;">{{ $value['Register Agey'] }}</td>
                   
                    <td style="width:80px;">{{ $value['Current Agey'] }}</td>
                  
                    <td style="width:80px;">{{ $users[$index]['Sex'] }} </td>
                    <td style="width:80px;">{{ $users[$index]['Main_Risk'] }} </td> 1
                    <td style="width:80px;">{{ $users[$index]['Sub_Risk'] }} </td>

                    <td style="width:80px;">{{ $users[$index]['New_Old'] }} </td>
                    <td style="width:80px;">{{ $users[$index]['Meeting Point'] }} </td>
                    <td style="width:80px;">{{ $users[$index]['Service Provision'] }} </td>
                    <td style="width:80px;">{{ $users[$index]['Retesting'] }} </td>
                    <td style="width:80px;">{{ $users[$index]['HIV_determine_result'] }} </td>
                    <td style="width:80px;">{{ $users[$index]['HIV result'] }} </td>
                    <td style="width:80px;">{{ $users[$index]['Counselling_pretest'] }} </td>
                    <td style="width:80px;">{{ $users[$index]['Counselling_posttest'] }} </td>
                    <td style="width:80px;">{{ $users[$index]['Refer_to'] }} </td>
                    <td style="width:80px;">{{ $users[$index]['date_confirm'] }} </td>
                    <td style="width:80px;">{{ $users[$index]['HIV Sero-Status'] }} </td>
                    <td style="width:80px;">{{ $users[$index]['Remark'] }} </td>
                </tr>
                @endforeach
              </tbody>
            </table>





        </form>
    </div>
</body>

</html>

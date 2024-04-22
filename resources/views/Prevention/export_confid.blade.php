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
          <form action="{{ route('prevention_data') }}"  method="POST" >
            @csrf
            <table>
              <thead>
                <tr>
                  <th style="background-color:#a6a6a6; width:100px;">He Code</th>
                  <th style="background-color:#a6a6a6; width:100px;">Clinic Code</th>
                  <th style="background-color:#a6a6a6; width:100px;">Register Year</th>
                  
                  <th style="background-color:#a6a6a6; width:100px;">Pid</th>
                  <th style="background-color:#a6a6a6; width:100px;">Fuchia ID</th>
                  <th style="background-color:#a6a6a6; width:100px;">PrEP Code</th>
                  <th style="background-color:#a6a6a6; width:100px;">Register Date</th>
                  


                  <th style="background-color:#a6a6a6; width:100px;">Register Agey</th>
                  <th style="background-color:#a6a6a6; width:100px;">Register Age month</th>
                  <th style="background-color:#a6a6a6; width:100px;">Current Age</th>
                  <th style="background-color:#a6a6a6; width:100px;">Current Age month</th>

                  <th style="background-color:#a6a6a6; width:100px;">Sex</th>
                  <th style="background-color:#a6a6a6; width:100px;">Initial Risk</th>
                  <th style="background-color:#a6a6a6; width:100px;">Risk changed</th>
                  
                  <th style="background-color:#a6a6a6; width:100px;">Risk changed Date</th>
                  <th style="background-color:#a6a6a6; width:100px;">Name</th>
                  <th style="background-color:#a6a6a6; width:100px;">Father</th>
                  <th style="background-color:#a6a6a6; width:100px;">Main Risk(Current Risk)</th>
                  <th style="background-color:#a6a6a6; width:100px;">Sub Risk</th>
                  <th style="background-color:#a6a6a6; width:100px;">Region</th>
                  <th style="background-color:#a6a6a6; width:100px;">Township</th>
                  <th style="background-color:#a6a6a6; width:100px;">Quarter</th>
                  <th style="background-color:#a6a6a6; width:100px;">Phone</th>
                  <th style="background-color:#a6a6a6; width:100px;">Phone2</th>
                  <th style="background-color:#a6a6a6; width:100px;">Phone3</th>
                  

                </tr>
              </thead>

              <tbody>
                
                @foreach($users as $index => $value)
                <tr>
                   <td style="width:80px;">{{ $users[$index]['He_code'] }}</td>
                   <td style="width:80px;">{{ $users[$index]['Clinic Code']}}</td>
                   <td style="width:80px;">{{ $value['Reg year'] }}</td>
                  
                   <td style="width:80px;">{{ $users[$index]['Pid'] }}</td>
                    <td style='width:80px;' > {{ $users[$index]['FuchiaID']}} </td>
                    <td style='width:80px;' > {{ $users[$index]['PrEPCode']}} </td>
                    <td style='width:80px;' > {{ $users[$index]['Reg Date']}} </td>
                   

                    
                    <td style="width:80px;">{{ $value['Register Agey'] }}</td>
                    <td style="width:80px;">{{ $value['Register Agem'] }}</td>
                    <td style="width:80px;">{{ $value['Current Agey'] }}</td>
                   <td style="width:80px;">{{ $value['Current Agem'] }}</td>
                    <td style='width:80px;' > {{ $users[$index]['Gender']}} </td>
                    <td style='width:80px;' > {{ $users[$index]['Former Risk']}} </td>
                    <td style='width:80px;' > {{ $users[$index]['Risk changed']}} </td>
                    <td style='width:80px;' > {{ $users[$index]['Risk Change_Date']  }} </td>
                    <td style='width:80px;' > {{ $users[$index]['Name']}} </td>
                    <td style='width:80px;' > {{ $users[$index]['Father']}} </td>
                    <td style='width:80px;' > {{ $users[$index]['Main Risk']}} </td>
                    <td style='width:80px;' > {{ $users[$index]['Sub Risk']}} </td>
                    <td style='width:80px;' > {{ $users[$index]['Region']}} </td>
                    <td style='width:80px;' > {{ $users[$index]['Township']}} </td>
                    <td style='width:80px;' > {{ $users[$index]['Quarter']}} </td>
                    <td style='width:80px;' > {{ $users[$index]['Phone']}} </td>
                    <td style='width:80px;' > {{ $users[$index]['Phone2']}} </td>
                    <td style='width:80px;' > {{ $users[$index]['Phone3']}} </td>
                </tr>
                @endforeach
              </tbody>
            </table>





        </form>
    </div>
</body>

</html>

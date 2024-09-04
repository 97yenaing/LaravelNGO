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
       
          <form>
            @csrf
           
            <table>
              <thead>
                <tr>
                  <th style="background-color:#a6a6a6;">Clinic Code</th>
                  <th style="background-color:#a6a6a6;">General ID</th>
                  <th style="background-color:#a6a6a6;">Fuchia ID</th>
                  <th style="background-color:#a6a6a6;">Prep Code</th>
                  <th style="background-color:#a6a6a6;">Age</th>
                  <th style="background-color:#a6a6a6;">Agem</th>
                  <th style="background-color:#a6a6a6;">Sex</th>
                  <th style="background-color:#a6a6a6;">Risk</th>
                  <th style="background-color:#a6a6a6;">Nurse NO.</th>
                  <th style="background-color:#a6a6a6;">Given Date</th>
                  <th style="background-color:#a6a6a6;">Medical Item</th>
                
                  


                </tr>
              </thead>

              <tbody>
                @foreach($ex_data as $index => $value)
                @php
                        $medicalDataArray = explode(';', $ex_data[$index]['Medical_Data']);
                @endphp
                  
                <tr>
                  
                    <td style="width:100px;">{{ $ex_data[$index]['Clinic Code'] }}</td>
                    <td style="width:100px;">{{ $ex_data[$index]['Pid'] }}</td>
                    <td style="width:100px;">{{ $ex_data[$index]['FuchiaID'] }}</td>
                    <td style="width:100px;">{{ $ex_data[$index]['PrEPCode'] }}</td>
                    <td style="width:100px;">{{ $ex_data[$index]['Agey'] }}</td>
                    <td style="width:100px;">{{ $ex_data[$index]['Agem'] }}</td>
                    <td style="width:100px;">{{ $ex_data[$index]['Sex'] }}</td>
                    <td style="width:100px;">{{ $ex_data[$index]['Main Risk'] }}</td>
                    <td style="width:100px;">{{ $ex_data[$index]['Nurse'] }}</td>
                    <td style="width:100px;">{{ date('d-m-Y', strtotime($ex_data[$index]['Given_Date'])) }}</td>
                    <td style="width:400px;height:150px">@for ($i = 0; $i < count($medicalDataArray)-1; $i=$i+2)
                                                {{$medicalDataArray[$i]}} (Qty={{$medicalDataArray[$i+1]}}) <br>
                                            @endfor</td>
                </tr>
                
                @endforeach
              </tbody>
            </table>





        </form>
    </div>
</body>

</html>

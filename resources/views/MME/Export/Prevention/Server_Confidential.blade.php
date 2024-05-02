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
          <th style="background-color:#a6a6a6; width:100px;">He Code</th>
          <th style="background-color:#a6a6a6; width:100px;">Clinic Code</th>
          <th style="background-color:#a6a6a6; width:100px;">Register Year</th>

          <th style="background-color:#a6a6a6; width:100px;">Pid</th>
          <th style="background-color:#a6a6a6; width:100px;">Fuchia ID</th>
          <th style="background-color:#a6a6a6; width:100px;">PrEP Code</th>
          <th style="background-color:#a6a6a6; width:100px;">Register Date</th>



          <th style="background-color:#a6a6a6; width:100px;">Register Agey</th>
          <th style="background-color:#a6a6a6; width:100px;">Register Age month</th>
          {{-- <th style="background-color:#a6a6a6; width:100px;">Date Of Birth</th> --}}


          <th style="background-color:#a6a6a6; width:100px;">Sex</th>
          <th style="background-color:#a6a6a6; width:100px;">Initial Risk</th>
          <th style="background-color:#a6a6a6; width:100px;">Risk changed</th>

          <th style="background-color:#a6a6a6; width:100px;">Risk changed Date</th>

          <th style="background-color:#a6a6a6; width:100px;">Main Risk(Current Risk)</th>
          <th style="background-color:#a6a6a6; width:100px;">Sub Risk</th>


        </tr>
      </thead>

      <tbody>

        @foreach($prevention_records as $index => $value)
        <tr>
          <td style="width:80px;">{{ $value['He_code'] }}</td>
          <td style="width:80px;">{{ $value['Clinic Code']}}</td>
          <td style="width:80px;">{{ $value['Reg year'] }}</td>

          <td style="width:80px;">{{ $value['Pid'] }}</td>
          <td style='width:80px;'> {{ $value['FuchiaID']}} </td>
          <td style='width:80px;'> {{ $value['PrEPCode']}} </td>
          <td style='width:80px;'> {{ $value['Reg Date']}} </td>



          <td style="width:80px;">{{ $value['Register Agey'] }}</td>
          <td style="width:80px;">{{ $value['Register Agem'] }}</td>
          {{-- <td style="width:80px;">{{ $value['Date of Birth'] }}</td> --}}

          <td style='width:80px;'> {{ $value['Gender']}} </td>
          <td style='width:80px;'> {{ $value['Former Risk']}} </td>
          <td style='width:80px;'> {{ $value['Risk changed']}} </td>
          <td style='width:80px;'> {{ $value['Risk Change_Date'] }} </td>

          <td style='width:80px;'> {{ $value['Main Risk']}} </td>
          <td style='width:80px;'> {{ $value['Sub Risk']}} </td>

        </tr>
        @endforeach
      </tbody>
    </table>





  </form>
</body>

</html>
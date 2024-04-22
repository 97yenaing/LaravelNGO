<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Export Excel </title>
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
          <form action="{{ route('reception_export') }}"  method="POST" >
            @csrf
            <table>
              <thead>
                <tr>
                  <th style="background-color:#a6a6a6;">Clinic Code</th>
                  <th style="background-color:#a6a6a6;">Pid</th>
                  <th style="background-color:#a6a6a6;">Agey</th>
                  <th style="background-color:#a6a6a6;">Agem</th>
                  <th style="background-color:#a6a6a6;">Gender</th>
                  <th style="background-color:#a6a6a6;">FuchiaID</th>
                  <th style="background-color:#a6a6a6;">PrEPCode</th>
                  <th style="background-color:#a6a6a6;">Visit Date</th>

                  <th style="background-color:#a6a6a6;">Main Risk</th>
                  <th style="background-color:#a6a6a6;">Sub Risk</th>

                  <th style="background-color:#a6a6a6;">Patient Type</th>
                  <th style="background-color:#a6a6a6;">New_Old</th>
                  <th style="background-color:#a6a6a6;">Fever</th>
                  <th style="background-color:#a6a6a6;">Diagnosis</th>
                  <th style="background-color:#a6a6a6;">Support</th>

                  <th style="background-color:#a6a6a6;">Patient Type_1</th>
                  <th style="background-color:#a6a6a6;">New_Old_1</th>
                  <th style="background-color:#a6a6a6;">Fever_1</th>
                  <th style="background-color:#a6a6a6;">Diagnosis_1</th>
                  <th style="background-color:#a6a6a6;">Support_1</th>

                  <th style="background-color:#a6a6a6;">Next Appointment Date</th>
                  <th style="background-color:#a6a6a6;">Mode</th>
                  <th style="background-color:#a6a6a6;">Unplan</th>


                </tr>
              </thead>

              <tbody>
                @foreach($users as $index => $value)
                <tr>
                   <td style="width:80px;">{{ $users1[$index]['Clinic Code'] }}</td>
                   <td style="width:80px;">{{ $users1[$index]['Pid'] }}</td>
                   <td style="width:80px;">{{ $users1[$index]['Agey'] }}</td>
                   <td style="width:80px;">{{ $users1[$index]['Agem'] }}</td>
                   <td style="width:80px;">{{ $users[$index]['Gender'] }}</td>
                   <td style="width:80px;">{{ $users1[$index]['FuchiaID'] }}</td>
                   <td style="width:80px;">{{ $users1[$index]['PrEPCode'] }}</td>
                   <td style="width:80px;">{{ $users1[$index]['Visit Date'] }}</td>

                   <td style="width:80px;">{{ $users[$index]['Main Risk'] }}</td>
                   <td style="width:80px;">{{ $users[$index]['Sub Risk'] }}</td>

                   <td style="width:80px;">{{ $users[$index]['Patient Type'] }}</td>
                   <td style="width:80px;">{{ $users[$index]['New_Old'] }}</td>
                   <td style="width:80px;">{{ $users[$index]['Fever'] }}</td>
                   <td style="width:80px;">{{ $users[$index]['Diagnosis'] }}</td>
                   <td style="width:80px;">{{ $users[$index]['Support'] }}</td>

                   <td style="width:80px;">{{ $users[$index]['Patient Type_1'] }}</td>
                   <td style="width:80px;">{{ $users[$index]['New_Old_1'] }}</td>
                   <td style="width:80px;">{{ $users[$index]['Fever_1'] }}</td>
                   <td style="width:80px;">{{ $users[$index]['Diagnosis_1'] }}</td>
                   <td style="width:80px;">{{ $users[$index]['Support_1'] }}</td>

                   <td style="width:80px;">{{ $users1[$index]['Next Appointment Date'] }}</td>
                   <td style="width:80px;">{{ $users1[$index]['Mode'] }}</td>
                   <td style="width:80px;">{{ $users1[$index]['Unplan'] }}</td>


                </tr>
                @endforeach
              </tbody>
            </table>





        </form>
    </div>
</body>

</html>

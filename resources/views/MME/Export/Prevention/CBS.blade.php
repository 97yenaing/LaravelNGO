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

      <tbody>
        @foreach ($prevention_records as $prevention_record)
        <tr>
          <td> {{ $prevention_record['He Code'] }} </td>
          <td style="width:80px;">{{ $prevention_record['Clinic Code'] }}</td>
          <td style="width:80px;">{{ $prevention_record['Reg year'] }}</td>

          <td style="width:80px;">{{ $prevention_record['Pid'] }} </td>
          <td style="width:80px;">{{ $prevention_record['FuchiaID'] }} </td>
          <td style="width:80px;">{{ $prevention_record['PrEPCode'] }} </td>
          <td style="width:80px;">{{ $prevention_record['Visit_Date'] }} </td>

          <td style="width:80px;">{{ $prevention_record['Register Agey'] }}</td>

          <td style="width:80px;">{{ $prevention_record['Current Agey'] }}</td>

          <td style="width:80px;">{{ $prevention_record['Sex'] }} </td>
          <td style="width:80px;">{{ $prevention_record['Main_Risk'] }} </td> 1
          <td style="width:80px;">{{ $prevention_record['Sub_Risk'] }} </td>

          <td style="width:80px;">{{ $prevention_record['New_Old'] }} </td>
          <td style="width:80px;">{{ $prevention_record['Meeting Point'] }} </td>
          <td style="width:80px;">{{ $prevention_record['Service Provision'] }} </td>
          <td style="width:80px;">{{ $prevention_record['Retesting'] }} </td>
          <td style="width:80px;">{{ $prevention_record['HIV_determine_result'] }} </td>
          <td style="width:80px;">{{ $prevention_record['HIV result'] }} </td>
          <td style="width:80px;">{{ $prevention_record['Counselling_pretest'] }} </td>
          <td style="width:80px;">{{ $prevention_record['Counselling_posttest'] }} </td>
          <td style="width:80px;">{{ $prevention_record['Refer_to'] }} </td>
          <td style="width:80px;">{{ $prevention_record['date_confirm'] }} </td>
          <td style="width:80px;">{{ $prevention_record['HIV Sero-Status'] }} </td>
          <td style="width:80px;">{{ $prevention_record['Remark'] }} </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </form>
</body>

</html>
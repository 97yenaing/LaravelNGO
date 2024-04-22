<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>

<body>
  <form action="" method="post">
    <table>
      <thead>
        <tr>
          <th>Sr.</th>
          <th style="width:200px;height:50px;text-align:center">Clinic Code</th>
          <th style="width:200px;height:50px;text-align:center">General ID</th>
          <th style="width:200px;height:50px;text-align:center">Clinic Reg No. (ART No.)</th>

          <th style="width:200px;height:50px;text-align:center">Register Age</th>
          <th style="width:200px;height:50px;text-align:center">Current Age</th>
          <th style="width:200px;height:50px;text-align:center">Sex (M/F)</th>
          <th style="width:200px;height:50px;text-align:center">IPT Registration date (DD/MM/YY)</th>
          <th style="width:200px;height:50px;text-align:center">Really IPT Start date</th>
          <th style="width:200px;height:50px;text-align:center">IPT<br> Discontinuation<br> date (DD/MM/YY)</th>
          <th style="width:200px;height:50px;text-align:center">Outcome</th>
          <th style="width:200px;height:50px;text-align:center">Remarks</th>
          <th style="width:200px;height:50px;text-align:center">Counsellor</th>
        </tr>
      </thead>
      <tbody>
        @foreach($tb_records as $index => $tb_record)
        <tr>

          <td>{{$index+1}}</td>
          <td>{{$tb_record["Clinic_code"]}}</td>
          <td>{{$tb_record["Pid_iptTB"]}}</td>
          <td>{{$tb_record["FuchiaID"]}}</td>

          <td>{{$tb_record["Register Agey"]}}
          <td>{{$tb_record["Current Agey"]}}</td>
          <td>{{$tb_record["Gender"]}}</td>
          <td>{{$tb_record["IPT_regDate"]}}</td>
          <td>{{$tb_record["IPT_startDate"]}}</td>
          <td>{{$tb_record["IPT_disconDate"]}}</td>
          <td>{{$tb_record["Outcome"]}}</td>
          <td>{{$tb_record["Remark"]}}</td>
          <td>{{$tb_record["Counsellor"]}}</td>
        </tr>
        @endforeach

      </tbody>
    </table>
  </form>
</body>

</html>
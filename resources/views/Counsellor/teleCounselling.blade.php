<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>

<body>
  <table>
    <thead>
      <tr>
        <th style="width:100px">General ID</th>
        <th style="width:100px">Name</th>
        <th style="width:100px">Current Age</th>
        <th style="width:100px">Sex</th>
        <th style="width:100px">Counselling Date</th>
        <th style="width:100px">Remark</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($users as $user)
      <tr>
        <td>{{$user["Pid"]}}</td>
        <td>{{$user["Name"]}}</td>
        @if ($user["Pid"]!=null)
        <td>{{$user["Current Agey"]}}</td>
        @else
        <td>{{$user["Age"]}}</td>
        @endif
        <td>{{$user["Gender"]}}</td>
        <td>{{$user["Call_Date"]}}</td>
        <td>{{$user["Remark"]}}</td>
      </tr>


      @endforeach
    </tbody>
  </table>
</body>

</html>
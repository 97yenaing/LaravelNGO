<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
	<form action="">
    @foreach ($final_log as $index => $item)
    <table>
        <thead>
            <tr>
                <th style="width: 100px">ID</th>
                <th style="width: 100px">Initial Risk</th>
                @foreach ($item as $key => $value)
                <th style="width: 100px">{{$key}}</th>
                <th style="width: 100px">Due to Patient</th>
                <th style="width: 100px">Change User</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @php
            $first_value = reset($item)
            @endphp
            <tr>
                <td>{{$index}}</td>
                <td>{{$first_value['Old Risk']}}</td>
                @foreach ($item as $key => $value)
                <td>{{$value["Current Risk"]}}</td>
                <td>{{$value["Due_to_patient"]}}</td>
                <td>{{$value["change_user"]}}</td>
                @endforeach
            </tr>
        </tbody>
    </table>
    @endforeach
</form>

</body>
</html>
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
        @csrf
        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th style="width:500px">Medical Item</th>
                    <th>Balance</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($balance_data as $index=> $item)
                {{-- @dd($item["Medic_item"]); --}}
                <tr>
                    <td>{{$index+1}}</td>
                    <td style="height: 50px">{{$item["Medic_item"]}}</td>
                    <td>{{$item["Stock"]}}</td>
                </tr>
                    
                @endforeach
            </tbody>
        </table>
    </form>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    {{-- @dd($tbipt_exdataes) --}}
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
                    <th style="width:200px;height:50px;text-align:center">Really IPT Start  date</th>
                    <th style="width:200px;height:50px;text-align:center">IPT<br> Discontinuation<br> date (DD/MM/YY)</th>
                    <th style="width:200px;height:50px;text-align:center">Outcome</th>
                    <th style="width:200px;height:50px;text-align:center">Remarks</th>
                    <th style="width:200px;height:50px;text-align:center">Counsellor</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tbipt_exdataes as $index => $tbipt_exdatae)
                    <tr>
                        
                        <td>{{$index+1}}</td>
                        <td>{{$tbipt_exdatae["Clinic_code"]}}</td>
                        <td>{{$tbipt_exdatae["Pid_iptTB"]}}</td>
                        <td>{{$tbipt_exdatae["FuchiaID"]}}</td>
                        
                        <td>{{$tbipt_exdatae["Register Agey"]}}
                        <td>{{$tbipt_exdatae["Current Agey"]}}</td>
                        <td>{{$tbipt_exdatae["Gender"]}}</td>
                        <td>{{$tbipt_exdatae["IPT_regDate"]}}</td>
                        <td>{{$tbipt_exdatae["IPT_startDate"]}}</td>
                        <td>{{$tbipt_exdatae["IPT_disconDate"]}}</td>
                        <td>{{$tbipt_exdatae["Outcome"]}}</td>
                        <td>{{$tbipt_exdatae["Remark"]}}</td>
                        <td>{{$tbipt_exdatae["Counsellor"]}}</td>
                    </tr>
                @endforeach
            
            </tbody>
        </table>
    </form>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form>
    @csrf
        <table>
            <thead>
                <tr>
                    <th colspan="12" style="background-color:#adb5bd;text-align:left">Eye screening form for every screening patients(for data entry)</th>
                    <th rowspan="2" style="width:150px;height:35px;background-color:#e9ec5d;text-align:center">Symptom<br>Flashes,Floater,Scotoma,Sudden vision loss,Yes(Y) or No(N)</th>
                    <th colspan="2"style="width:200px;height:35px;background-color:#0aeeab;text-align:center">Vision acuity</th>
                    <th colspan="4"style="width:400px;height:35px;background-color:#0aeeab;text-align:center">Findings</th>
                    <th colspan="2"style="width:200px;height:35px;background-color:#0aeeab;text-align:center">Treatment</th>

                </tr>
                <tr>
                    <th style="width:100px;height:40px;text-align:center;">Clinic Code</th>
                    <th style="width:100px;height:40px;text-align:center;">General ID</th>
                    <th style="width:100px;height:40px;text-align:center;">Fuchia ID</th>
                    <th style="width:100px;height:40px;text-align:center;">Sex</th>
                    <th style="width:100px;height:40px;text-align:center;">Reg Year</th>
                    <th style="width:100px;height:40px;text-align:center;">Register Age</th>
                    <th style="width:100px;height:40px;text-align:center;">Register Age(Month)</th>
                    <th style="width:100px;height:40px;text-align:center;">Current Age</th>
                    <th style="width:100px;height:40px;text-align:center;">Current Age(Month)</th>
                    

                    <th style="width:100px;height:40px;text-align:center;">Visit_date</th>
                    <th style="width:100px;height:40px;text-align:center;">Types of patients</th>
                    
                    <th style="width:150px;height:40px;text-align:center;">ART status(Yes/No)</th>
                    <th style="width:250px;height:40px;text-align:center;">Current ART Regime(Please circle)<br>1st or 2nd line</th>
                    <th style="width:200px;height:40px;text-align:center;">Current ART(1st or 2nd line)<br>started date</th>
                    
                    <th style="width:100px;height:40px;text-align:center;">Most recent CD4</th>
                    <th style="width:150px;height:40px;text-align:center;">Most recent CD4 date</th>
                    
                    <th style="width:100px;height:40px;text-align:center;background-color:#e9ec5d;">Right Eye</th>
                    <th style="width:100px;height:40px;text-align:center;background-color:#e9ec5d;">Left Eye</th>
                    <th style="width:100px;height:40px;text-align:center;background-color:#e9ec5d;">Right eye Diagnosis</th>
                    <th style="width:100px;height:40px;text-align:center;background-color:#e9ec5d;">Type of Dx (Right)</th>
                    <th style="width:100px;height:40px;text-align:center;background-color:#e9ec5d;">Left eye Diagnosis</th>
                    <th style="width:100px;height:40px;text-align:center;background-color:#e9ec5d;">Type of Dx (Left)</th>
                    <th style="width:100px;height:40px;text-align:center;background-color:#e9ec5d;">Right eye</th>
                    <th style="width:100px;height:40px;text-align:center;background-color:#e9ec5d;">Left eye</th>
                    <th style="width:100px;height:40px;text-align:center;">Eye Doctor</th>
                    <th style="width:100px;height:40px;text-align:center;">Organization</th>
                    <th style="width:100px;height:40px;text-align:center;">Follow up Date</th>
                    <th style="width:200px;height:40px;text-align:center;">Remark</th>
                </tr>
            </thead>
            <tbody>
                
                @foreach($cmv_exdatases as $cmv_exdata )
                
                <tr>
                    <td style="text-align:left">{{$cmv_exdata['Clinic Code']}}</td>
                    <td style="text-align:left">{{$cmv_exdata['Pid_cmv']}}</td>
                    <td style="text-align:left">{{$cmv_exdata['FuchiaID']}}</td>
                    <td style="text-align:left">{{$cmv_exdata['Gender']}}</td>
                    <td style="width:80px;">{{$cmv_exdata['Reg year'] }}</td>
                    <td style="width:80px;">{{ $cmv_exdata['Register Agey'] }}</td>
                    <td style="width:80px;">{{ $cmv_exdata['Register Agem'] }}</td>
                    <td style="width:80px;">{{ $cmv_exdata['Current Agey'] }}</td>
                    <td style="width:80px;">{{ $cmv_exdata['Current Agem'] }}</td>

                    <td style="text-align:left">{{$cmv_exdata['Visit_date']}}</td>
                    <td style="text-align:left">{{$cmv_exdata['Patient_Type']}}</td>
                    
                    <td style="text-align:left">{{$cmv_exdata['Art_Status']}}</td>
                    <td style="text-align:left">{{$cmv_exdata['Symptom']}}</td>

                    <td style="text-align:left">{{$cmv_exdata['Currnt_Art_Regime']}}</td>
                    <td style="text-align:left">{{$cmv_exdata['Art_StartDate']}}</td>
                    
                    <td style="text-align:left">{{$cmv_exdata['Most_CD4']}}</td>
                    <td style="text-align:left">{{$cmv_exdata['Recent_CD4Date']}}</td>
                
                
                    
                    <td style="text-align:left">{{$cmv_exdata['Vision_Right']}}</td>
                    <td style="text-align:left">{{$cmv_exdata['Vision_Left']}}</td>
                    <td style="text-align:left">{{$cmv_exdata['Finding_Right']}}</td>
                    <td style="text-align:left">{{$cmv_exdata['Finding_Rdx']}}</td>
                    <td style="text-align:left">{{$cmv_exdata['Finding_Left']}}</td>
                    <td style="text-align:left">{{$cmv_exdata['Finding_Ldx']}}</td>
                    <td style="text-align:left">{{$cmv_exdata['Treatment_Right']}}</td>
                    <td style="text-align:left">{{$cmv_exdata['Treatment_Left']}}</td>
                    <td style="text-align:left">{{$cmv_exdata['Doctor_name']}}</td>
                    <td style="text-align:left">{{$cmv_exdata['Org']}}</td>
                    <td style="text-align:left">{{$cmv_exdata['Follow_Date']}}</td>
                    <td style="text-align:left">{{$cmv_exdata['Remark']}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </form>
    
</body>
</html>

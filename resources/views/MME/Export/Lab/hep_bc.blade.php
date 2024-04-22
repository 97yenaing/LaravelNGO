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
            <thead>
                <tr>
                    <th style="background-color:#a6a6a6;">Clinic Code</th>
                    <th style="background-color:#a6a6a6;">General ID</th>
                    <th style="background-color:#a6a6a6;">Fuchia ID</th>
                    <th style="background-color:#a6a6a6;">Register Year</th>
                    <th style="background-color:#a6a6a6;">Register Agey</th>
                    <th style="background-color:#a6a6a6;">Register Agem(Month)</th>
                    <th style="background-color:#a6a6a6;">Current Agey</th>
                    <th style="background-color:#a6a6a6;">Current Agem(Month)</th>
                    <th style="background-color:#a6a6a6;">Gender</th>
                    <th style="background-color:#a6a6a6;">Visit Date</th>
                    <th style="background-color:#a6a6a6;">Requested Dr</th>
                    <th style="background-color:#a6a6a6;">Main Risk</th>
                    <th style="background-color:#a6a6a6;">Sub Risk</th>
                    <th style="background-color:#a6a6a6;">HIV Status</th>
                    <th style="background-color:#a6a6a6;">Hep B Test</th>
                    <th style="background-color:#a6a6a6;">Hep B Type of Test</th>
                    <th style="background-color:#a6a6a6;">Hep B Result</th>
                    <th style="background-color:#a6a6a6;">Hep C Test</th>
                    <th style="background-color:#a6a6a6;">Hep C Type of Test</th>
                    <th style="background-color:#a6a6a6;">Hep C Result</th>
                    <th style="background-color:#a6a6a6;">Lab Technician</th>
                    <th style="background-color:#a6a6a6;">Issue Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($lab_records as $lab_record)
                    {{-- @dd($lab_record) --}}
                    <tr>
                        <td style="width:100px;">{{ $lab_record['Clinic Code'] }}</td>
                        <td style="width:100px;">{{ $lab_record['CID'] }}</td>
                        <td style="width:100px;">{{ $lab_record['FuchiaID'] }}</td>
                        <td style="width:80px;">{{ $lab_record['Reg year'] }}</td>
                        <td style="width:80px;">{{ $lab_record['Register Agey'] }}</td>
                        <td style="width:80px;">{{ $lab_record['Register Agem'] }}</td>
                        <td style="width:80px;">{{ $lab_record['Current Agey'] }}</td>
                        <td style="width:80px;">{{ $lab_record['Current Agem'] }}</td>
                        <td style="width:100px;">{{ $lab_record['Gender'] }}</td>
                        <td style="width:100px;">{{ $lab_record['vdate'] }}</td>
                        <td style="width:100px;">{{ $lab_record['Req_Doctor'] }}</td>
                        <td style="width:100px;">{{ $lab_record['Main Risk'] }}</td>
                        <td style="width:100px;">{{ $lab_record['Sub Risk'] }}</td>
                        <td style="width:100px;">{{ $lab_record['Final_Result'] }}</td>
                        <td style="width:100px;">{{ $lab_record['HepB Test'] }}</td>
                        <td style="width:100px;">{{ $lab_record['HepB TOT'] }}</td>
                        <td style="width:100px;">{{ $lab_record['HepB Result'] }}</td>
                        <td style="width:100px;">{{ $lab_record['HepC Test'] }}</td>
                        <td style="width:100px;">{{ $lab_record['HepC TOT'] }}</td>
                        <td style="width:100px;">{{ $lab_record['HepC Result'] }}</td>
                        <td style="width:100px;">{{ $lab_record['Lab Tech'] }}</td>
                        <td style="width:100px;">{{ $lab_record['Issue Date'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </form>
</body>

</html>

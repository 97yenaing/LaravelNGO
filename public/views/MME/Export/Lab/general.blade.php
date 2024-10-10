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
                <th style="background-color:#a6a6a6;">Requested Doctor</th>

                <th style="background-color:green;">Main Risk</th>
                <th style="background-color:green;">Sub Risk</th>
                <th style="background-color:#a6a6a6;">Dangue RDT</th>
                <th style="background-color:#a6a6a6;">NS1 Antigen</th>
                <th style="background-color:#a6a6a6;">IgG Result</th>
                <th style="background-color:#a6a6a6;">IgM Result</th>
                <th style="background-color:#a6a6a6;">Malaria RDT</th>
                <th style="background-color:green;">Malaria RDT Result</th>
                <th style="background-color:#a6a6a6;">Malaria Spec</th>
                <th style="background-color:#a6a6a6;">Malaria Grade</th>
                <th style="background-color:#a6a6a6;">Malaria Stage</th>
                <th style="background-color:#a6a6a6;">Malaria Microscopy</th>
                <th style="background-color:#a6a6a6;">Malaria Microscopy Result</th>
                <th style="background-color:#a6a6a6;">RBS test</th>
                <th style="background-color:#a6a6a6;">RBS</th>
                <th style="background-color:#a6a6a6;">FBS test</th>
                <th style="background-color:#a6a6a6;">FBS</th>
                <th style="background-color:#a6a6a6;">Haemo Done</th>
                <th style="background-color:#a6a6a6;">Haemoglobin</th>
                <th style="background-color:#a6a6a6;">Hba1c</th>
                <th style="background-color:#a6a6a6;">Lab Technician</th>
                <th style="background-color:#a6a6a6;">Issue Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($lab_records as $lab_record)
                <tr>

                    <td style="width:50px;">{{ $lab_record['Clinic Code'] }}</td>
                    <td style="width:150px;">{{ $lab_record['CID'] }}</td>
                    <td style="width:150px;">{{ $lab_record['FuchiaID'] }}</td>
                    <td style="width:80px;">{{ $lab_record['Reg year'] }}</td>
                    <td style="width:80px;">{{ $lab_record['Register Agey'] }}</td>
                    <td style="width:80px;">{{ $lab_record['Register Agem'] }}</td>
                    <td style="width:80px;">{{ $lab_record['Current Agey'] }}</td>
                    <td style="width:80px;">{{ $lab_record['Current Agem'] }}</td>
                    <td style="width:150px;">{{ $lab_record['Gender'] }}</td>
                    <td style="width:150px;">{{ $lab_record['vdate'] }}</td>
                    <td style="width:150px;">{{ $lab_record['Req_Doctor'] }}</td>

                    <td style="width:150px;">{{ $lab_record['Main Risk'] }}</td>
                    <td style="width:150px;">{{ $lab_record['Sub Risk'] }}</td>
                    <td style="width:150px;">{{ $lab_record['Dangue RDT'] }}</td>
                    <td style="width:150px;">{{ $lab_record['NS1 Antigen'] }}</td>
                    <td style="width:150px;">{{ $lab_record['IgG Result'] }}</td>
                    <td style="width:150px;">{{ $lab_record['IgM Result'] }}</td>
                    <td style="width:150px;">{{ $lab_record['Malaria RDT'] }}</td>
                    <td style="width:150px;">{{ $lab_record['Malaria RDT Result'] }}</td>

                    <td style="width:150px;">{{ $lab_record['Malaria_spec'] }}</td>
                    <td style="width:150px;">{{ $lab_record['Malaria_grade'] }}</td>
                    <td style="width:150px;">{{ $lab_record['Malaria_stage'] }}</td>
                    <td style="width:150px;">{{ $lab_record['malaria_microscopy'] }}</td>
                    <td style="width:150px;">{{ $lab_record['Malaria Microscopy Result'] }}</td>
                    <td style="width:150px;">{{ $lab_record['RBS test'] }}</td>
                    <td style="width:150px;">{{ $lab_record['RBS'] }}</td>
                    <td style="width:150px;">{{ $lab_record['FBS test'] }}</td>
                    <td style="width:150px;">{{ $lab_record['FBS'] }}</td>
                    <td style="width:150px;">{{ $lab_record['haemo_done'] }}</td>
                    <td style="width:150px;">{{ $lab_record['haemoglobin'] }}</td>
                    <td style="width:150px;">{{ $lab_record['hba1c'] }}</td>
                    <td style="width:150px;">{{ $lab_record['Lab Tech'] }}</td>
                    <td style="width:150px;">{{ $lab_record['Issue Date'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>

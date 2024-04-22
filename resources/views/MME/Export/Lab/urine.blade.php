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
                    <th style="background-color:#a6a6a6;">Test_done</th>
                    <th style="background-color:#a6a6a6;">Type of Test</th>
                    <th style="background-color:#a6a6a6;">Apperance</th>
                    <th style="background-color:#a6a6a6;">Tubitity</th>
                    <th style="background-color:#a6a6a6;"> PUS/WBC </th>
                    <th style="background-color:#a6a6a6;">PH</th>
                    <th style="background-color:#a6a6a6;">Protein</th>
                    <th style="background-color:#a6a6a6;">Glucose</th>
                    <th style="background-color:#a6a6a6;">RBC</th>
                    <th style="background-color:#a6a6a6;">Leukocyte</th>
                    <th style="background-color:#a6a6a6;">Nitrite</th>
                    <th style="background-color:#a6a6a6;">Ketone</th>
                    <th style="background-color:#a6a6a6;">Epithelial</th>
                    <th style="background-color:#a6a6a6;">Urobilinogen</th>
                    <th style="background-color:#a6a6a6;">Bilirubin</th>
                    <th style="background-color:#a6a6a6;">Erythrocyte</th>
                    <th style="background-color:#a6a6a6;">Crystal</th>
                    <th style="background-color:#a6a6a6;">Haemoglobin</th>
                    <th style="background-color:#a6a6a6;">Cast</th>
                    <th style="background-color:#a6a6a6;">Other</th>
                    <th style="background-color:#a6a6a6;">Cretinine</th>
                    <th style="background-color:#a6a6a6;">Albumin</th>
                    <th style="background-color:#a6a6a6;">A:C_ratio</th>
                    <th style="background-color:#a6a6a6;">Comment</th>
                    <th style="background-color:#a6a6a6;">Lab Technician</th>
                    <th style="background-color:#a6a6a6;">Issue Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($lab_records as $lab_record)
                    <tr>
                        <td style="width:50px;">{{ $lab_record['Clinic Code'] }}</td>
                        <td style="width:100px;">{{ $lab_record['CID'] }}</td>
                        <td style="width:100px;">{{ $lab_record['FuchiaID'] }}</td>
                        <td style="width:80px;">{{ $lab_record['Reg year'] }}</td>
                        <td style="width:80px;">{{ $lab_record['Register Agey'] }}</td>
                        <td style="width:80px;">{{ $lab_record['Register Agem'] }}</td>
                        <td style="width:80px;">{{ $lab_record['Current Agey'] }}</td>
                        <td style="width:80px;">{{ $lab_record['Current Agem'] }}</td>
                        <td style="width:50px;">{{ $lab_record['Gender'] }}</td>
                        <td style="width:100px;">{{ $lab_record['vdate'] }}</td>
                        <td style="width:100px;">{{ $lab_record['Req_Doctor'] }}</td>
                        <td style="width:100px;">{{ $lab_record['Main Risk'] }}</td>
                        <td style="width:100px;">{{ $lab_record['Sub Risk'] }}</td>
                        <td style="width:50px;">{{ $lab_record['Utest_done'] }}</td>
                        <td style="width:50px;">{{ $lab_record['Utot'] }}</td>
                        <td style="width:50px;">{{ $lab_record['Ucolor'] }}</td>
                        <td style="width:50px;">{{ $lab_record['tubitity'] }}</td>
                        <td style="width:50px;">{{ $lab_record['Upus'] }}</td>
                        <td style="width:50px;">{{ $lab_record['ph'] }}</td>
                        <td style="width:50px;">{{ $lab_record['Uprotein'] }}</td>
                        <td style="width:50px;">{{ $lab_record['Uglucose'] }}</td>
                        <td style="width:50px;">{{ $lab_record['Urbc'] }}</td>
                        <td style="width:50px;">{{ $lab_record['Uleu'] }}</td>
                        <td style="width:50px;">{{ $lab_record['Unitrite'] }}</td>
                        <td style="width:50px;">{{ $lab_record['Uketone'] }}</td>
                        <td style="width:50px;">{{ $lab_record['Uepithelial'] }}</td>
                        <td style="width:50px;">{{ $lab_record['Urobili'] }}</td>
                        <td style="width:50px;">{{ $lab_record['Ubillru'] }}</td>
                        <td style="width:50px;">{{ $lab_record['Uery'] }}</td>
                        <td style="width:50px;">{{ $lab_record['Ucrystal'] }}</td>
                        <td style="width:50px;">{{ $lab_record['Uhae'] }}</td>
                        <td style="width:50px;">{{ $lab_record['Ucast'] }}</td>
                        <td style="width:50px;">{{ $lab_record['Uother'] }}</td>
                        <td style="width:50px;">{{ $lab_record['Cretinine'] }}</td>
                        <td style="width:50px;">{{ $lab_record['Albumin'] }}</td>
                        <td style="width:50px;">{{ $lab_record['A:C_ratio'] }}</td>
                        <td style="width:50px;">{{ $lab_record['comment'] }}</td>
                        <td style="width:100px;">{{ $lab_record['lab_tech'] }}</td>
                        <td style="width:100px;">{{ $lab_record['issue_date'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </form>
</body>

</html>

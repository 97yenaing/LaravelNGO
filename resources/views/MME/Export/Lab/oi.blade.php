<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <table>
        <thead>
            <tr>
                <th style="background-color:#a6a6a6;">Clinic Code</th>
                <th style="background-color:#a6a6a6;">CID</th>
                <th style="background-color:#a6a6a6;">FuchiaID</th>
                <th style="background-color:#a6a6a6;">Sex</th>
                <th style="background-color:#a6a6a6;">Register Year</th>
                <th style="background-color:#a6a6a6;">Register Agey</th>
                <th style="background-color:#a6a6a6;">Register Agem(Month)</th>
                <th style="background-color:#a6a6a6;">Current Agey</th>
                <th style="background-color:#a6a6a6;">Current Agem(Month)</th>
                <th style="background-color:green;">Main Risk</th>
                <th style="background-color:green;">Sub Risk</th>
                <th style="background-color:#a6a6a6;">Req_Doctor</th>
                <th style="background-color:#a6a6a6;">Visit Date</th>

                <th style="background-color:green;">TB_LAM_Report</th>
                <th style="background-color:#a6a6a6;">Toxoplasma Antibody</th>
                <th style="background-color:#a6a6a6;">Toxo igG</th>
                <th style="background-color:#a6a6a6;">Toxo igM</th>

                <th style="background-color:green;">Serum Cryptococcal Antigen</th>
                <!--serum result -->
                <th style="background-color:#a6a6a6;">Dilution </th>
                <!--Serum_pos -->

                <th style="background-color:green;">CSF for Cryptococcal Antigen</th>
                <th style="background-color:#a6a6a6;">Dilution</th>
                <!--csf_crypto_pos -->

                <th style="background-color:#a6a6a6;">CSF Smear </th>
                <!--csf_fungal -->
                <th style="background-color:#a6a6a6;">CSF Gram stain Result </th>
                <!--CSF Smear Giemsa Stain -->
                <th style="background-color:#a6a6a6;">CSF India Ink Result </th>
                <!--CSF Smear India Ink -->

                <th style="background-color:#a6a6a6;">Skin Smear</th>
                <!--skin_fungal -->
                <th style="background-color:#a6a6a6;">Skin Smear Giemsa Stain</th>
                <!--Skin Smear Giemsa Stain -->
                <th style="background-color:#a6a6a6;">Skin Smear India Ink</th>
                <!--Skin Smear India Ink -->

                <th style="background-color:#a6a6a6;">Other Smear</th>
                <!--lymph_test -->
                <th style="background-color:#a6a6a6;">Other Giemsa Stain</th>
                <!--Other Giemsa Ink -->
                <th style="background-color:#a6a6a6;">Other India Ink</th>
                <!--Other India Ink -->

                <th style="background-color:#a6a6a6;">Lab Techanician</th>
                <th style="background-color:#a6a6a6;">Issued Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($lab_records as $lab_record)
                <tr>
                    <td style="width:50px;">{{ $lab_record['Clinic Code'] }}</td>
                    <td style="width:50px;">{{ $lab_record['CID'] }}</td>
                    <td style="width:50px;">{{ $lab_record['FuchiaID'] }}</td>
                    <td style="width:50px;">{{ $lab_record['Gender'] }}</td>
                    <td style="width:80px;">{{ $lab_record['Reg year'] }}</td>
                    <td style="width:80px;">{{ $lab_record['Register Agey'] }}</td>
                    <td style="width:80px;">{{ $lab_record['Register Agem'] }}</td>
                    <td style="width:80px;">{{ $lab_record['Current Agey'] }}</td>
                    <td style="width:80px;">{{ $lab_record['Current Agem'] }}</td>
                    <td style="width:100px;">{{ $lab_record['Main Risk'] }}</td>
                    <td style="width:100px;">{{ $lab_record['Sub Risk'] }}</td>
                    <td style="width:100px;">{{ $lab_record['Req_Doctor'] }}</td>
                    <td style="width:100px;">{{ $lab_record['vdate'] }}</td>


                    <td style="width:50px;">{{ $lab_record['TB_LAM_Report'] }}</td>
                    <td style="width:50px;">{{ $lab_record['Toxo plasma'] }}</td>
                    <td style="width:50px;">{{ $lab_record['Toxo igG'] }}</td>
                    <td style="width:50px;">{{ $lab_record['Toxo igM'] }}</td>

                    <td style="width:50px;">{{ $lab_record['Serum Result'] }}</td>
                    <td style="width:50px;">{{ $lab_record['serum_pos'] }}</td>
                    <td style="width:50px;">{{ $lab_record['CSF for Cryptococcal Antigen'] }}
                    </td>
                    <td style="width:50px;">{{ $lab_record['csf_crypto_pos'] }}</td>

                    <td style="width:50px;">{{ $lab_record['csf_fungal'] }}</td>
                    <td style="width:50px;">{{ $lab_record['CSF Smear Giemsa Stain'] }}</td>
                    <td style="width:50px;">{{ $lab_record['CSF Smear India Ink'] }}</td>

                    <td style="width:50px;">{{ $lab_record['skin_fungal'] }}</td>
                    <td style="width:50px;">{{ $lab_record['Skin Smear Giemsa Stain'] }}</td>
                    <td style="width:50px;">{{ $lab_record['Skin Smear India Ink'] }}</td>

                    <td style="width:50px;">{{ $lab_record['lymph_test'] }}</td>
                    <td style="width:50px;">{{ $lab_record['Lymph Giemsa Stain'] }}</td>
                    <td style="width:50px;">{{ $lab_record['Lymph India Ink'] }}</td>

                    <td style="width:50px;">{{ $lab_record['Lab Techanician'] }}</td>
                    <td style="width:50px;">{{ $lab_record['issued'] }}</td>
                </tr>
            @endforeach

        </tbody>
    </table>
</body>

</html>

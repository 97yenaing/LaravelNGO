<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Import Export Excel </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <style>
        table {
            border-collapse: collapse;
            font-size: 12px;
        }

        th,
        td {
            border: 2px solid black;
            height: 50px;
        }
    </style>
</head>

<body>
    <div class="container mt-5 text-center">
        <!-- <form action="{{ route('lab_export_link') }}" method="POST" > -->
        <form action="{{ route('counsellor_export') }}" method="POST">
            @csrf
            <h1>OI</h1>
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

                        <th style="background-color:green;">Serum Cryptococcal Antigen</th> <!--serum result -->
                        <th style="background-color:#a6a6a6;">Dilution </th><!--Serum_pos -->

                        <th style="background-color:green;">CSF for Cryptococcal Antigen</th>
                        <th style="background-color:#a6a6a6;">Dilution</th> <!--csf_crypto_pos -->

                        <th style="background-color:#a6a6a6;">CSF Smear </th><!--csf_fungal -->
                        <th style="background-color:#a6a6a6;">CSF Gram stain Result </th><!--CSF Smear Giemsa Stain -->
                        <th style="background-color:#a6a6a6;">CSF India Ink Result </th><!--CSF Smear India Ink -->

                        <th style="background-color:#a6a6a6;">Skin Smear</th><!--skin_fungal -->
                        <th style="background-color:#a6a6a6;">Skin Smear Giemsa Stain</th>
                        <!--Skin Smear Giemsa Stain -->
                        <th style="background-color:#a6a6a6;">Skin Smear India Ink</th><!--Skin Smear India Ink -->

                        <th style="background-color:#a6a6a6;">Other Smear</th><!--lymph_test -->
                        <th style="background-color:#a6a6a6;">Other Giemsa Stain</th><!--Other Giemsa Ink -->
                        <th style="background-color:#a6a6a6;">Other India Ink</th><!--Other India Ink -->

                        <th style="background-color:#a6a6a6;">Lab Techanician</th>
                        <th style="background-color:#a6a6a6;">Issued Date</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($users as $index => $value)
                        <tr>

                            <td style="width:50px;">{{ $value['Clinic Code'] }}</td>
                            <td style="width:50px;">{{ $value['CID'] }}</td>
                            <td style="width:50px;">{{ $value['fuchiacode'] }}</td>
                            <td style="width:50px;">{{ $value['Gender'] }}</td>
                            <td style="width:80px;">{{ $value['Reg year'] }}</td>
                            <td style="width:80px;">{{ $value['Register Agey'] }}</td>
                            <td style="width:80px;">{{ $value['Register Agem'] }}</td>
                            <td style="width:80px;">{{ $value['Current Agey'] }}</td>
                            <td style="width:80px;">{{ $value['Current Agem'] }}</td>
                            <td style="width:100px;">{{ $value['Patient_Type'] }}</td>
                            <td style="width:100px;">{{ $value['Patient Type Sub'] }}</td>
                            <td style="width:100px;">{{ $value['Req_Doctor'] }}</td>
                            <td style="width:100px;">{{ $value['vdate'] }}</td>


                            <td style="width:50px;">{{ $value['TB_LAM_Report'] }}</td>
                            <td style="width:50px;">{{ $value['Toxo plasma'] }}</td>
                            <td style="width:50px;">{{ $value['Toxo igG'] }}</td>
                            <td style="width:50px;">{{ $value['Toxo igM'] }}</td>

                            <td style="width:50px;">{{ $value['Serum Result'] }}</td>
                            <td style="width:50px;">{{ $value['serum_pos'] }}</td>
                            <td style="width:50px;">{{ $value['CSF for Cryptococcal Antigen'] }}</td>
                            <td style="width:50px;">{{ $value['csf_crypto_pos'] }}</td>

                            <td style="width:50px;">{{ $value['csf_fungal'] }}</td>
                            <td style="width:50px;">{{ $value['CSF Smear Giemsa Stain'] }}</td>
                            <td style="width:50px;">{{ $value['CSF Smear India Ink'] }}</td>

                            <td style="width:50px;">{{ $value['skin_fungal'] }}</td>
                            <td style="width:50px;">{{ $value['Skin Smear Giemsa Stain'] }}</td>
                            <td style="width:50px;">{{ $value['Skin Smear India Ink'] }}</td>

                            <td style="width:50px;">{{ $value['lymph_test'] }}</td>
                            <td style="width:50px;">{{ $value['Lymph Giemsa Stain'] }}</td>
                            <td style="width:50px;">{{ $value['Lymph India Ink'] }}</td>

                            <td style="width:50px;">{{ $value['Lab Techanician'] }}</td>
                            <td style="width:50px;">{{ $value['issued'] }}</td>




                        </tr>
                    @endforeach
                </tbody>
            </table>





        </form>
    </div>
</body>

</html>

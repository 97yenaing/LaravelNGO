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
                <th style="background-color:#a6a6a6;">Clinic Code </th>
                <th style="background-color:#a6a6a6;">General ID </th>
                <th style="background-color:#a6a6a6;">Fuchia ID </th>
                <th style="background-color:#a6a6a6;">Register Year</th>
                <th style="background-color:#a6a6a6;">Register Agey</th>
                <th style="background-color:#a6a6a6;">Register Agem(Month)</th>
                <th style="background-color:#a6a6a6;">Current Agey</th>
                <th style="background-color:#a6a6a6;">Current Agem(Month)</th>
                <th style="background-color:#a6a6a6;">Gender </th>
                <th style="background-color:#a6a6a6;">Requested Doctor </th>
                <th style="background-color:#a6a6a6;">Visit Date </th>
                <th style="background-color:#a6a6a6;">Main Risk </th>
                <th style="background-color:#a6a6a6;">Sub Risk </th>
                <th style="background-color:#a6a6a6;">Patient's Name </th>
                <th style="background-color:#a6a6a6;">Patient Address </th>
                <th style="background-color:#a6a6a6;">Previous TB </th>
                <th style="background-color:#a6a6a6;">HIV Status </th>
                <th style="background-color:#a6a6a6;">Reason_for_exam </th>
                <th style="background-color:#a6a6a6;">Patient Type </th>
                <th style="background-color:#a6a6a6;">Follow Up Month </th>
                <th style="background-color:#a6a6a6;">Specimen type </th>
                <th style="background-color:#a6a6a6;">oth_spe_ty </th>

                <th style="background-color:#a6a6a6;">Slide Number 1 </th>
                <th style="background-color:#a6a6a6;">Specimen receive date 1 </th>
                <th style="background-color:#a6a6a6;">Visual Appearance 1 </th>
                <th style="background-color:#a6a6a6;">Result 1 </th>
                <th style="background-color:#a6a6a6;">Slide Grading, 1 </th>

                <th style="background-color:#a6a6a6;">Slide Number 2 </th>
                <th style="background-color:#a6a6a6;">Specimen receive date 2 </th>
                <th style="background-color:#a6a6a6;">Visual Apperance 2 </th>
                <th style="background-color:#a6a6a6;">Result 2 </th>
                <th style="background-color:#a6a6a6;">Slide grading 2 </th>

                <th style="background-color:#a6a6a6;">Lab technician </th>
                <th style="background-color:#a6a6a6;">Issue date </th>

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
                    <td style="width:100px;">{{ $lab_record['Gender'] }}</td>
                    <td style="width:100px;">{{ $lab_record['Req_Doctor'] }}</td>
                    <td style="width:100px;">{{ $lab_record['vdate'] }}</td>
                    <td style="width:100px;">{{ $lab_record['Main Risk'] }}</td>
                    <td style="width:100px;">{{ $lab_record['Sub Risk'] }}</td>
                    <td style="width:100px;"></td>
                    <td style="width:250px;"></td>
                    <td style="width:100px;">{{ $lab_record['Previous_TB'] }}</td>
                    <td style="width:100px;">{{ $lab_record['Final_Result'] }}</td>
                    <td style="width:100px;">{{ $lab_record['reason_for_exam'] }}</td>
                    <td style="width:100px;">{{ $lab_record['afb_Pt_type'] }}</td>
                    <td style="width:100px;">{{ $lab_record['follow_up_mt'] }}</td>
                    <td style="width:100px;">{{ $lab_record['speci_type'] }}</td>
                    <td style="width:100px;">{{ $lab_record['oth_spe_ty'] }}</td>

                    <td style="width:100px;">{{ $lab_record['slide_num_1'] }}</td>
                    <td style="width:100px;">{{ $lab_record['speci_receive_dt1'] }}</td>
                    <td style="width:100px;">{{ $lab_record['visual_app_1'] }}</td>
                    <td style="width:100px;">{{ $lab_record['afb_result1'] }}</td>
                    <td style="width:100px;">{{ $lab_record['slide1_grading1'] }}</td>


                    <td style="width:100px;">{{ $lab_record['slide_num_2'] }}</td>
                    <td style="width:100px;">{{ $lab_record['speci_receive_dt2'] }}</td>
                    <td style="width:100px;">{{ $lab_record['visual_app_2'] }}</td>
                    <td style="width:100px;">{{ $lab_record['afb_result2'] }}</td>
                    <td style="width:100px;">{{ $lab_record['slide2_grading2'] }}</td>

                    <td style="width:100px;">{{ $lab_record['afb_lab_techca'] }}</td>
                    <td style="width:100px;">{{ $lab_record['afb_issue_date'] }}</td>



                </tr>
            @endforeach
        </tbody>

    </table>
</body>

</html>

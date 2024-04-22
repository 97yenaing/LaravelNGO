<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
          <th style="background-color:#a6a6a6;">Reg Year</th>
          <th style="background-color:#a6a6a6;">Register Age</th>
          <th style="background-color:#a6a6a6;">Register Age(Month)</th>
          <th style="background-color:#a6a6a6;">Current Age</th>
          <th style="background-color:#a6a6a6;">Current Agem(Month)</th>
          <th style="background-color:#a6a6a6;">Gender</th>
          <th style="background-color:green;">Main Risk</th>
          <th style="background-color:green;">Sub Risk</th>
          <th style="background-color:#a6a6a6;">Visit Date</th>
          <th style="background-color:#a6a6a6;">Blood Collection Date</th>
          <th style="background-color:green;">Determine Result</th>
          <th style="background-color:green;">Unigold Result</th>
          <th style="background-color:green;">STAT PAK Result</th>
          <th style="background-color:green;">Final Result</th>
          <th style="background-color:#a6a6a6;">Requested Dr</th>
          <th style="background-color:#a6a6a6;">Inconclusive</th>
          <th style="background-color:#a6a6a6;">Counsellor</th>
          <th style="background-color:#a6a6a6;">Lab Technician</th>
          <th style="background-color:#a6a6a6;">Created Date_Time</th>
          <th style="background-color:#a6a6a6;">Updated Date_ime</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($lab_records as $lab_record)
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
          <td style="width:100px;">{{ $lab_record['Main Risk']}}</td>
          <td style="width:100px;">{{ $lab_record['Sub Risk']}}</td>
          <td style="width:100px;">{{ $lab_record['vdate'] }}</td>
          <td style="width:100px;">{{ $lab_record['bcollectdate'] }}</td>
          <td style="width:100px;">{{ $lab_record['Detmine_Result'] }}</td>
          <td style="width:100px;">{{ $lab_record['Unigold_Result'] }}</td>
          <td style="width:100px;">{{ $lab_record['STAT_PAK_Result'] }}</td>
          <td style="width:100px;">{{ $lab_record['Final_Result'] }}</td>
          <td style="width:100px;">{{ $lab_record['Req_Doctor'] }}</td>
          <td style="width:100px;">{{ $lab_record['Incon'] }}</td>
          <td style="width:100px;">{{ $lab_record['Counsellor'] }}</td>
          <td style="width:100px;">{{ $lab_record['LabTech'] }}</td>
          <td style="width:100px;">{{ $lab_record['created_at'] }}</td>
          <td style="width:100px;">{{ $lab_record['updated_at'] }}</td>
        </tr> 
        @endforeach
      </tbody>
    </table>
  </form>
</body>
</html>
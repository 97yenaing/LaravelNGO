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
          <th style="background-color:#a6a6a6;">Reg Year</th>
          <th style="background-color:#a6a6a6;">Register Age</th>
          <th style="background-color:#a6a6a6;">Register Age(Month)</th>
          <th style="background-color:#a6a6a6;">Current Age</th>
          <th style="background-color:#a6a6a6;">Current Age(Month)</th>
          <th style="background-color:#a6a6a6;">Gender</th>
          <th style="background-color:green;">Main Risk</th>
          <th style="background-color:green;">Sub Risk</th>
          <th style="background-color:#a6a6a6;">Visit Date</th>
          <th style="background-color:#a6a6a6;">RDT (Yes/No)</th>
          <th style="background-color:green;">RDT Result</th>
          <th style="background-color:#a6a6a6;">RPR (Yes/No)</th>
          <th style="background-color:green;">RPR Result</th>
          <th style="background-color:#a6a6a6;">Titre Current</th>
          <th style="background-color:#a6a6a6;">Titre Last</th>
          <th style="background-color:#a6a6a6;">Titre Last Date</th>
          <th style="background-color:#a6a6a6;">Requested Dr</th>
          <th style="background-color:#a6a6a6;">Counsellor</th>
          <th style="background-color:#a6a6a6;">Lab Techanician</th>
          <th style="background-color:#a6a6a6;">Issue Date</th>
          <th style="background-color:#a6a6a6;">Created Date_Time</th>
          <th style="background-color:#a6a6a6;">Updated Date_Time</th>
         
        </tr>
      </thead>
      <tbody>
        @foreach ($lab_records as $lab_record)
        
          <tr>
            <td style="width:100px;">{{ $lab_record['Clinic Code'] }}</td>      
            <td style="width:100px;">{{ $lab_record['pid'] }}</td>
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
            <td style="width:100px;">{{ $lab_record['RDT(Yes/No)'] }}</td>
            <td style="width:100px;">{{ $lab_record['RDT Result'] }}</td>
            <td style="width:100px;">{{ $lab_record['Quantitative(Yes/No)'] }}</td>
            <td style="width:100px;">{{ $lab_record['RPR Qualitative'] }}</td>

            <td style="width:100px;">{{ $lab_record['Titre(current)'] }}</td>
            <td style="width:100px;">{{ $lab_record['Titre(Last)'] }}</td>
            <td style="width:100px;">{{ $lab_record['TitreLastDate'] }}</td>
            <td style="width:100px;">{{ $lab_record['Req_Doctor']}}</td>
            <td style="width:100px;">{{ $lab_record['Counsellor'] }}</td>
            <td style="width:100px;">{{ $lab_record['Lab Tech'] }}</td>
            <td style="width:100px;">{{ $lab_record['Issue Date'] }}</td>

            <td style="width:130px;">{{ $lab_record['created_at'] }}</td>
            <td style="width:130px;">{{ $lab_record['updated_at'] }}</td>
          </tr>
            
        @endforeach
      </tbody>
    </table>
  </form>
  
</body>
</html>
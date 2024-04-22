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
          <th style="background-color:#a6a6a6;">Requested Doctor</th>
          <th style="background-color:#a6a6a6;">Visit Date</th>
          <th style="background-color:green;">Main Risk</th>
          <th style="background-color:green;">Sub Risk</th>

          <th style="background-color:#a6a6a6;">Wet Mount clue cell</th>
          <th style="background-color:#a6a6a6;">Wet Mount Trichomonas</th>
          <th style="background-color:#a6a6a6;">Wet Mount candida</th>
          <th style="background-color:#a6a6a6;">wetoth</th>
          <th style="background-color:#a6a6a6;">urethra WBC</th>
          <th style="background-color:#a6a6a6;">Urethra diplococci intra-cell</th>
          <th style="background-color:#a6a6a6;">Urethra diplococci extra-cell</th>
          <th style="background-color:#a6a6a6;">Urethra Candida</th>
          <th style="background-color:#a6a6a6;">uoth</th>
          <th style="background-color:#a6a6a6;">Fornix Clue Cells</th>
          <th style="background-color:#a6a6a6;">Fornix WBC</th>
          <th style="background-color:#a6a6a6;">Fornix diplococci intra-cell</th>
          <th style="background-color:#a6a6a6;">Fornix diplococci extra-cell</th>
          <th style="background-color:#a6a6a6;">Fornix Candida</th>
          <th style="background-color:#a6a6a6;">pfother</th>
          <th style="background-color:#a6a6a6;">Endo cervix WBC</th>
          <th style="background-color:#a6a6a6;">Endo cervix diplococci intra-cell</th>
          <th style="background-color:#a6a6a6;">Endo cervix diplococci extra-cell</th>
          <th style="background-color:#a6a6a6;">Endo cervix Candida</th>
          <th style="background-color:#a6a6a6;">eother</th>
          <th style="background-color:#a6a6a6;">Rectum WBC</th>
          <th style="background-color:#a6a6a6;">Rectum diplococci intra-cell</th>
          <th style="background-color:#a6a6a6;">Rectum diplococci extra-cell</th>
          <th style="background-color:#a6a6a6;">rother</th>
          <th style="background-color:#a6a6a6;">First Per Urine</th>
          <th style="background-color:#a6a6a6;">Epithelial cells</th>
          <th style="background-color:#a6a6a6;">PMNL cells</th>
          <th style="background-color:#a6a6a6;">First Per Urine Diplococci Intra-Cell</th>
          <th style="background-color:#a6a6a6;">First Per Urine Diplococci Extra-Cell</th>
          <th style="background-color:#a6a6a6;">fpu_oth</th>
          <th style="background-color:#a6a6a6;">Other Bacteria</th>
          <th style="background-color:#a6a6a6;">Clue cells result</th>
          <th style="background-color:#a6a6a6;">PMNL result</th>
          <th style="background-color:#a6a6a6;">trichomonas result</th>
          <th style="background-color:#a6a6a6;">diplococci intra cell result</th>
          <th style="background-color:#a6a6a6;">diplococci extra cell result</th>
          <th style="background-color:#a6a6a6;">spermatozoites result</th>
          <th style="background-color:#a6a6a6;">candida result</th>

          <th style="background-color:#a6a6a6;">Lab Techanician</th>
          <th style="background-color:#a6a6a6;">idate</th>
          <th style="background-color:#a6a6a6;">Created Date_ Time</th>
          <th style="background-color:#a6a6a6;">Updated Date_ Time</th>        
        </tr>
      </thead>
      <tbody>
        @foreach ($lab_records as $lab_record)
        <tr>
         
         <td style="width:150px;">{{ $lab_record['Clinic Code'] }}</td>
         <td style="width:150px;">{{ $lab_record['CID'] }}</td>
         <td style="width:150px;">{{ $lab_record['FuchiaID'] }}</td>
         <td style="width:80px;">{{ $lab_record['Reg year'] }}</td>
         <td style="width:80px;">{{ $lab_record['Register Agey'] }}</td>
         <td style="width:80px;">{{ $lab_record['Register Agem'] }}</td>
         <td style="width:80px;">{{ $lab_record['Current Agey'] }}</td>
         <td style="width:80px;">{{ $lab_record['Current Agem'] }}</td>
         <td style="width:150px;">{{ $lab_record['Gender'] }}</td>
         <td style="width:150px;">{{ $lab_record['Req_Doctor'] }}</td>
         <td style="width:150px;">{{ $lab_record['vdate'] }}</td>
         <td style="width:150px;">{{ $lab_record['Main Risk'] }}</td>
         <td style="width:150px;">{{ $lab_record['Sub Risk'] }}</td>

         <td style="width:150px;">{{ $lab_record['Wet Mount clue cell'] }}</td>
         <td style="width:150px;">{{ $lab_record['Wet Mount Trichomonas'] }}</td>
         <td style="width:150px;">{{ $lab_record['Wet Mount candida'] }}</td>
         <td style="width:150px;">{{ $lab_record['wetoth'] }}</td>
         <td style="width:150px;">{{ $lab_record['urethra WBC'] }}</td>
         <td style="width:150px;">{{ $lab_record['Urethra diplococci intra-cell'] }}</td>
         <td style="width:150px;">{{ $lab_record['Urethra diplococci extra-cell'] }}</td>
         <td style="width:150px;">{{ $lab_record['Urethra Candida'] }}</td>
         <td style="width:150px;">{{ $lab_record['uoth'] }}</td>
         <td style="width:150px;">{{ $lab_record['Fornix Clue Cells'] }}</td>
         <td style="width:150px;">{{ $lab_record['Fornix WBC'] }}</td>
         <td style="width:150px;">{{ $lab_record['Fornix diplococci intra-cell'] }}</td>
         <td style="width:150px;">{{ $lab_record['Fornix diplococci extra-cell'] }}</td>
         <td style="width:150px;">{{ $lab_record['Fornix Candida'] }}</td>
         <td style="width:150px;">{{ $lab_record['pfother'] }}</td>
         <td style="width:150px;">{{ $lab_record['Endo cervix WBC'] }}</td>
         <td style="width:150px;">{{ $lab_record['Endo cervix diplococci intra-cell'] }}</td>
         <td style="width:150px;">{{ $lab_record['Endo cervix diplococci extra-cell'] }}</td>
         <td style="width:150px;">{{ $lab_record['Endo cervix Candida'] }}</td>
         <td style="width:150px;">{{ $lab_record['eother'] }}</td>
         <td style="width:150px;">{{ $lab_record['Rectum WBC'] }}</td>
         <td style="width:150px;">{{ $lab_record['Rectum diplococci intra-cell'] }}</td>
         <td style="width:150px;">{{ $lab_record['Rectum diplococci extra-cell'] }}</td>
         <td style="width:150px;">{{ $lab_record['rother'] }}</td>
         <td style="width:150px;">{{ $lab_record['First Per Urine'] }}</td>
         <td style="width:150px;">{{ $lab_record['Epithelial cells'] }}</td>
         <td style="width:150px;">{{ $lab_record['PMNL cells'] }}</td>
         <td style="width:150px;">{{ $lab_record['First Per Urine Diplococci Intra-Cell'] }}</td>
         <td style="width:150px;">{{ $lab_record['First Per Urine Diplococci Extra-Cell'] }}</td>
         <td style="width:150px;">{{ $lab_record['fpu_oth'] }}</td>
         <td style="width:150px;">{{ $lab_record['Other Bacteria'] }}</td>
         <td style="width:150px;">{{ $lab_record['Clue cells result'] }}</td>
         <td style="width:150px;">{{ $lab_record['PMNL result'] }}</td>
         <td style="width:150px;">{{ $lab_record['trichomonas result'] }}</td>
         <td style="width:150px;">{{ $lab_record['diplococci intra cell result'] }}</td>
         <td style="width:150px;">{{ $lab_record['diplococci extra cell result'] }}</td>
         <td style="width:150px;">{{ $lab_record['spermatozoites result'] }}</td>
         <td style="width:150px;">{{ $lab_record['candida result'] }}</td>

         <td style="width:150px;">{{ $lab_record['Lab Techanician'] }}</td>
         <td style="width:150px;">{{ $lab_record['idate'] }}</td>
         <td style="width:150px;">{{ $lab_record['created_at'] }}</td>
         <td style="width:150px;">{{ $lab_record['updated_at'] }}</td>
       </tr>
            
        @endforeach
      </tbody>
    </table>
  </form>
  
</body>
</html>
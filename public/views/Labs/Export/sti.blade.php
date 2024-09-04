<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Import Export Excel </title>
    
    <style>
    table {
      border-collapse: collapse;
      font-size: 12px;
    }

    th, td {
      border: 2px solid black;
      height:50px;
    }
  </style>
</head>

<body>
    <div class="container mt-5 text-center">
        <!-- <form action="{{ route('lab_export_link') }}" method="POST" > -->
          <form action="{{ route('counsellor_export') }}"  method="POST" >
            @csrf
            
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
                @foreach($users as $index => $value)
                <tr>
                   {{-- @dd($value); --}}
                  <td style="width:150px;">{{ $value['Clinic Code'] }}</td>
                  <td style="width:150px;">{{ $value['CID'] }}</td>
                  <td style="width:150px;">{{ $value['fuchiacode'] }}</td>
                  <td style="width:80px;">{{ $value['Reg year'] }}</td>
                  <td style="width:80px;">{{ $value['Register Agey'] }}</td>
                  <td style="width:80px;">{{ $value['Register Agem'] }}</td>
                  <td style="width:80px;">{{ $value['Current Agey'] }}</td>
                  <td style="width:80px;">{{ $value['Current Agem'] }}</td>
                  <td style="width:150px;">{{ $value['Gender'] }}</td>
                  <td style="width:150px;">{{ $value['Req_Doctor'] }}</td>
                  <td style="width:150px;">{{ $value['vdate'] }}</td>
                  <td style="width:150px;">{{ $value['Patient_Type'] }}</td>
                  <td style="width:150px;">{{ $value['Patient Type Sub'] }}</td>

                  <td style="width:150px;">{{ $value['Wet Mount clue cell'] }}</td>
                  <td style="width:150px;">{{ $value['Wet Mount Trichomonas'] }}</td>
                  <td style="width:150px;">{{ $value['Wet Mount candida'] }}</td>
                  <td style="width:150px;">{{ $value['wetoth'] }}</td>
                  <td style="width:150px;">{{ $value['urethra WBC'] }}</td>
                  <td style="width:150px;">{{ $value['Urethra diplococci intra-cell'] }}</td>
                  <td style="width:150px;">{{ $value['Urethra diplococci extra-cell'] }}</td>
                  <td style="width:150px;">{{ $value['Urethra Candida'] }}</td>
                  <td style="width:150px;">{{ $value['uoth'] }}</td>
                  <td style="width:150px;">{{ $value['Fornix Clue Cells'] }}</td>
                  <td style="width:150px;">{{ $value['Fornix WBC'] }}</td>
                  <td style="width:150px;">{{ $value['Fornix diplococci intra-cell'] }}</td>
                  <td style="width:150px;">{{ $value['Fornix diplococci extra-cell'] }}</td>
                  <td style="width:150px;">{{ $value['Fornix Candida'] }}</td>
                  <td style="width:150px;">{{ $value['pfother'] }}</td>
                  <td style="width:150px;">{{ $value['Endo cervix WBC'] }}</td>
                  <td style="width:150px;">{{ $value['Endo cervix diplococci intra-cell'] }}</td>
                  <td style="width:150px;">{{ $value['Endo cervix diplococci extra-cell'] }}</td>
                  <td style="width:150px;">{{ $value['Endo cervix Candida'] }}</td>
                  <td style="width:150px;">{{ $value['eother'] }}</td>
                  <td style="width:150px;">{{ $value['Rectum WBC'] }}</td>
                  <td style="width:150px;">{{ $value['Rectum diplococci intra-cell'] }}</td>
                  <td style="width:150px;">{{ $value['Rectum diplococci extra-cell'] }}</td>
                  <td style="width:150px;">{{ $value['rother'] }}</td>
                  <td style="width:150px;">{{ $value['First Per Urine'] }}</td>
                  <td style="width:150px;">{{ $value['Epithelial cells'] }}</td>
                  <td style="width:150px;">{{ $value['PMNL cells'] }}</td>
                  <td style="width:150px;">{{ $value['First Per Urine Diplococci Intra-Cell'] }}</td>
                  <td style="width:150px;">{{ $value['First Per Urine Diplococci Extra-Cell'] }}</td>
                  <td style="width:150px;">{{ $value['fpu_oth'] }}</td>
                  <td style="width:150px;">{{ $value['Other Bacteria'] }}</td>
                  <td style="width:150px;">{{ $value['Clue cells result'] }}</td>
                  <td style="width:150px;">{{ $value['PMNL result'] }}</td>
                  <td style="width:150px;">{{ $value['trichomonas result'] }}</td>
                  <td style="width:150px;">{{ $value['diplococci intra cell result'] }}</td>
                  <td style="width:150px;">{{ $value['diplococci extra cell result'] }}</td>
                  <td style="width:150px;">{{ $value['spermatozoites result'] }}</td>
                  <td style="width:150px;">{{ $value['candida result'] }}</td>

                  <td style="width:150px;">{{ $value['Lab Techanician'] }}</td>
                  <td style="width:150px;">{{ $value['idate'] }}</td>
                  <td style="width:150px;">{{ $value['created_at'] }}</td>
                  <td style="width:150px;">{{ $value['updated_at'] }}</td>
                </tr>
                @endforeach
              </tbody>
            </table>





        </form>
    </div>
</body>

</html>

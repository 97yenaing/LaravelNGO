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
                @foreach($users as $index => $value)
                <tr>
                   
                    <td style="width:50px;">{{ $value['Clinic Code'] }}</td>
                    <td style="width:150px;">{{ $value['CID'] }}</td>
                    <td style="width:150px;">{{ $value['fuchiacode'] }}</td>
                    <td style="width:80px;">{{ $value['Reg year'] }}</td>
                    <td style="width:80px;">{{ $value['Register Agey'] }}</td>
                    <td style="width:80px;">{{ $value['Register Agem'] }}</td>
                    <td style="width:80px;">{{ $value['Current Agey'] }}</td>
                    <td style="width:80px;">{{ $value['Current Agem'] }}</td>
                    <td style="width:150px;">{{ $value['Gender'] }}</td>
                    <td style="width:150px;">{{ $value['vdate'] }}</td>
                    <td style="width:150px;">{{ $value['Req_Doctor'] }}</td>

                    <td style="width:150px;">{{ $value['Patient_Type'] }}</td>
                    <td style="width:150px;">{{ $value['Patient Type Sub'] }}</td>
                    <td style="width:150px;">{{ $value['Dangue RDT'] }}</td>
                    <td style="width:150px;">{{ $value['NS1 Antigen'] }}</td>
                    <td style="width:150px;">{{ $value['IgG Result'] }}</td>
                    <td style="width:150px;">{{ $value['IgM Result'] }}</td>
                    <td style="width:150px;">{{ $value['Malaria RDT'] }}</td>
                    <td style="width:150px;">{{ $value['Malaria RDT Result'] }}</td>
                    
                    <td style="width:150px;">{{ $value['Malaria_spec'] }}</td>
                    <td style="width:150px;">{{ $value['Malaria_grade'] }}</td>
                    <td style="width:150px;">{{ $value['Malaria_stage'] }}</td>
                    <td style="width:150px;">{{ $value['malaria_microscopy'] }}</td>
                    <td style="width:150px;">{{ $value['Malaria Microscopy Result'] }}</td>
                    <td style="width:150px;">{{ $value['RBS test'] }}</td>
                    <td style="width:150px;">{{ $value['RBS'] }}</td>
                    <td style="width:150px;">{{ $value['FBS test'] }}</td>
                    <td style="width:150px;">{{ $value['FBS'] }}</td>
                    <td style="width:150px;">{{ $value['haemo_done'] }}</td>
                    <td style="width:150px;">{{ $value['haemoglobin'] }}</td>
                    <td style="width:150px;">{{ $value['hba1c'] }}</td>
                    <td style="width:150px;">{{ $value['Lab Tech'] }}</td>
                    <td style="width:150px;">{{ $value['Issue Date'] }}</td>
                </tr>
                @endforeach
              </tbody>
            </table>





        </form>
    </div>
</body>

</html>

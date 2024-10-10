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
        <th style="background-color:#a6a6a6; width:100px;">He Code</th>
        <th style="background-color:#a6a6a6; width:100px;">Clinic Code</th>
        <th style="background-color:#a6a6a6; width:100px;">Register Year</th>
        <th style="background-color:#a6a6a6; width:100px;">Pid</th>
        <th style="background-color:#a6a6a6; width:100px;">Fuchia ID</th>
        <th style="background-color:#a6a6a6; width:100px;">PrEP Code</th>
        <th style="background-color:#a6a6a6; width:100px;">Name</th>
        <th style="background-color:#a6a6a6; width:100px;">Register Date</th>
        <th style="background-color:#a6a6a6; width:100px;">Visit Date</th>
        <th style="background-color:#a6a6a6; width:100px;">Register Agey</th>
        <th style="background-color:#a6a6a6; width:100px;">Register Age month</th>
        <th style="background-color:#a6a6a6; width:100px;">Current Age</th>
        <th style="background-color:#a6a6a6; width:100px;">Current Age month</th>
        <th style="background-color:#a6a6a6; width:100px;">Sex</th>
        <th style="background-color:#a6a6a6; width:100px;">Initial Risk</th>
        <th style="background-color:#a6a6a6; width:100px;">Risk changed</th>
        <th style="background-color:#a6a6a6; width:100px;">Risk changed Date</th>
        <th style="background-color:#a6a6a6; width:100px;">Main Risk(Current Risk)</th>
        <th style="background-color:#a6a6a6; width:100px;">Sub Risk</th>
        <th style="background-color:#a6a6a6; width:100px;">Township</th>
        <th style="background-color:#a6a6a6; width:100px;">New_Old</th>
        <th style="background-color:#a6a6a6; width:100px;">Substantial Risk</th>
        <th style="background-color:#a6a6a6; width:100px;">Meeting Point</th>
        <th style="background-color:#a6a6a6; width:100px;">Service Provision1</th>
        <th style="background-color:#a6a6a6; width:100px;">Service Provision2</th>
        <th style="background-color:#a6a6a6; width:100px;">Service Provision3</th>
        <th style="background-color:#a6a6a6; width:100px;">HE_Section</th>
        <th style="background-color:#a6a6a6; width:100px;">Ns_distribute</th>
        <th style="background-color:#a6a6a6; width:100px;">Condom_m</th>
        <th style="background-color:#a6a6a6; width:100px;">Condom_f</th>
        <th style="background-color:#a6a6a6; width:100px;">Ns_return</th>
        <th style="background-color:#a6a6a6; width:100px;">HIV Status</th>
        <th style="background-color:#a6a6a6; width:100px;">Test_duration</th>
        <th style="background-color:#a6a6a6; width:100px;">HTS done</th>
        <th style="background-color:#a6a6a6; width:100px;">HIV_Final_result</th>
        <th style="background-color:#a6a6a6; width:100px;">date_confirm</th>
        <th style="background-color:#a6a6a6; width:100px;">Reach_whom</th>
        <th style="background-color:#a6a6a6; width:100px;">Source_doc</th>
        <th style="background-color:#a6a6a6; width:100px;">Mental_Health</th>
        <th style="background-color:#a6a6a6; width:100px;">PHQ4_Q1_Q2</th>
        <th style="background-color:#a6a6a6; width:100px;">PHQ4_Q3_Q4</th>
        <th style="background-color:#a6a6a6; width:100px;">OST_Done</th>
        <th style="background-color:#a6a6a6; width:100px;">OST_Accept</th>
        <th style="background-color:#a6a6a6; width:100px;">Decline_Reason</th>
        <th style="background-color:#a6a6a6; width:100px;">OST_Initial_Date</th>
        <th style="background-color:#a6a6a6; width:100px;">Test_Clinic</th>
        <th style="background-color:#a6a6a6; width:100px;">Test_New_Old</th>
        <th style="background-color:#a6a6a6; width:100px;">Remark</th>
      </tr>
    </thead>
    <tbody>

      @foreach ($prevention_records as $prevention_record)
      <tr>
        <td> {{ $prevention_record['He Code'] }} </td>
        <td style="width:80px;">{{ $prevention_record['Clinic Code'] }}</td>
        <td> {{ $prevention_record['Reg year'] }} </td>

        <td style="width:80px;">{{ $prevention_record['Pid'] }}</td>
        <td> {{ $prevention_record['FuchiaID'] }} </td>
        <td> {{ $prevention_record['PrEPCode'] }} </td>
        <td> {{ $prevention_record['Name'] }} </td>

        <td> {{ $prevention_record['Reg_Date'] }} </td>

        <td> {{ $prevention_record['Visit_Date'] }} </td>


        <td style="width:80px;">{{ $prevention_record['Register Agey'] }}</td>
        <td style="width:80px;">{{ $prevention_record['Register Agem'] }}</td>
        <td style="width:80px;">{{ $prevention_record['Current Agey'] }}</td>
        <td style="width:80px;">{{ $prevention_record['Current Agem'] }}</td>
        <td> {{ $prevention_record['Sex']}} </td>

        <td> {{ $prevention_record['Initial Risk'] }} </td>
        <td> {{ $prevention_record['Risk changed'] }} </td>
        <td> {{ $prevention_record['Risk changed Date'] }} </td>



        <td> {{ $prevention_record['Main_Risk'] }} </td>
        <td> {{ $prevention_record['Sub_Risk'] }} </td>
        <td> {{ $prevention_record['Township'] }} </td>


        <td> {{ $prevention_record['New_Old'] }} </td>
        <td> {{ $prevention_record['Substantial Risk'] }} </td>
        <td> {{ $prevention_record['Meeting Point'] }} </td>
        <td> {{ $prevention_record['Service Provision1'] }} </td>
        <td> {{ $prevention_record['Service Provision2'] }} </td>
        <td> {{ $prevention_record['Service Provision3'] }} </td>
        <td> {{ $prevention_record['HE_Section'] }} </td>
        <td> {{ $prevention_record['Ns_distribute'] }} </td>
        <td> {{ $prevention_record['Condom_m'] }} </td>
        <td> {{ $prevention_record['Condom_f'] }} </td>
        <td> {{ $prevention_record['Ns_return'] }} </td>
        <td> {{ $prevention_record['HIV Status'] }} </td>

        <td> {{ $prevention_record['Test_duration'] }} </td>
        <td> {{ $prevention_record['HTS done'] }} </td>
        <td> {{ $prevention_record['HIV_Final_result'] }} </td>
        <td> {{ $prevention_record['date_confirm'] }} </td>
        <td> {{ $prevention_record['Reach_whom'] }} </td>

        <td>{{ $prevention_record['Source_doc']}} </td>
        <td>{{ $prevention_record['Mental_Health']}} </td>
        <td>{{ $prevention_record['PHQ4_Q1_Q2']}} </td>
        <td>{{ $prevention_record['PHQ4_Q3_Q4']}} </td>
        <td>{{ $prevention_record['OST_Done']}} </td>
        <td>{{ $prevention_record['OST_Accept']}} </td>
        <td>{{ $prevention_record['Decline_Reason']}} </td>
        <td>{{ $prevention_record['OST_Initial_Date']}} </td>
        <td>{{ $prevention_record['Test_Clinic']}} </td>
        <td>{{ $prevention_record['Test_New_Old']}} </td>
        <td> {{ $prevention_record['Remark'] }} </td>
      </tr>

      @endforeach
    </tbody>
  </table>
</body>

</html>
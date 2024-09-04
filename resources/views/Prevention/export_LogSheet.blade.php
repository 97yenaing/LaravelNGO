<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Export Excel </title>

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
    <!-- <form action="{{ route('reception_export') }}" method="POST" > -->
    <form action="{{ route('prevention_data') }}" method="POST">
      @csrf
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
            <th style="background-color:#a6a6a6; width:100px;">Eligible for OST
              (Yes/No)</th>
            <th style="background-color:#a6a6a6; width:100px;">Offer accepted
              (Yes/No)</th>
            <th style="background-color:#a6a6a6; width:100px;">Referral Coupon no.</th>
            <th style="background-color:#a6a6a6; width:100px;">Decline_Reason</th>

            <th style="background-color:#a6a6a6; width:100px;">Test_Clinic</th>

            <th style="background-color:#a6a6a6; width:100px;">Remark</th>
          </tr>
        </thead>

        <tbody>

          @foreach($users as $index => $value)
          <tr>
            <td> {{ $users[$index]['He Code'] }} </td>
            <td style="width:80px;">{{ $users[$index]['Clinic Code'] }}</td>
            <td> {{ $users[$index]['Reg year'] }} </td>

            <td style="width:80px;">{{ $users[$index]['Pid'] }}</td>
            <td> {{ $users[$index]['FuchiaID'] }} </td>
            <td> {{ $users[$index]['PrEPCode'] }} </td>
            <td> {{ $users[$index]['Name'] }} </td>

            <td> {{ $users[$index]['Reg_Date'] }} </td>

            <td> {{ $users[$index]['Visit_Date'] }} </td>


            <td style="width:80px;">{{ $value['Register Agey'] }}</td>
            <td style="width:80px;">{{ $value['Register Agem'] }}</td>
            <td style="width:80px;">{{ $value['Current Agey'] }}</td>
            <td style="width:80px;">{{ $value['Current Agem'] }}</td>
            <td> {{ $users[$index]['Sex']}} </td>

            <td> {{ $users[$index]['Initial Risk'] }} </td>
            <td> {{ $users[$index]['Risk changed'] }} </td>
            <td> {{ $users[$index]['Risk changed Date'] }} </td>



            <td> {{ $users[$index]['Main Risk'] }} </td>
            <td> {{ $users[$index]['Sub Risk'] }} </td>
            <td> {{ $users[$index]['Township'] }} </td>


            <td> {{ $users[$index]['New_Old'] }} </td>
            <td> {{ $users[$index]['Substantial Risk'] }} </td>
            <td> {{ $users[$index]['Meeting Point'] }} </td>
            <td> {{ $users[$index]['Service Provision1'] }} </td>
            <td> {{ $users[$index]['Service Provision2'] }} </td>
            <td> {{ $users[$index]['Service Provision3'] }} </td>
            <td> {{ $users[$index]['HE_Section'] }} </td>
            <td> {{ $users[$index]['Ns_distribute'] }} </td>
            <td> {{ $users[$index]['Condom_m'] }} </td>
            <td> {{ $users[$index]['Condom_f'] }} </td>
            <td> {{ $users[$index]['Ns_return'] }} </td>
            <td> {{ $users[$index]['HIV Status'] }} </td>

            <td> {{ $users[$index]['Test_duration'] }} </td>
            <td> {{ $users[$index]['HTS done'] }} </td>
            <td> {{ $users[$index]['HIV_Final_result'] }} </td>
            <td> {{ $users[$index]['date_confirm'] }} </td>
            <td> {{ $users[$index]['Reach_whom'] }} </td>

            <td>{{ $users[$index]['Source_doc']}} </td>
            <td>{{ $users[$index]['Mental_Health']}} </td>
            <td>{{ $users[$index]['PHQ4_Q1_Q2']}} </td>
            <td>{{ $users[$index]['PHQ4_Q3_Q4']}} </td>
            {{-- <td>{{ $users[$index]['OST_Done']}} </td> --}}
            <td>{{ $users[$index]['OST_Eligible']}} </td>
            <td>{{ $users[$index]['OST_Accept']}} </td>
            <td>{{ $users[$index]['Referral_Coupon']}} </td>
            <td>{{ $users[$index]['Decline_Reason_new']}} </td>
            {{-- <td>{{ $users[$index]['OST_Initial_Date']}} </td> --}}
            <td>{{ $users[$index]['Test_Clinic']}} </td>
            <td> {{ $users[$index]['Remark'] }} </td>



          </tr>
          @endforeach
        </tbody>
      </table>





    </form>
  </div>
</body>

</html>
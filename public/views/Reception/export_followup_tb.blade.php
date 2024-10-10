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

    th, td {
      border: 2px solid black;
      height:50px;
    }
  </style>
</head>
@php
   
@endphp
<body>
    <div class="container mt-5 text-center">
        <!-- <form action="{{ route('reception_export') }}" method="POST" > -->
          <form action="{{ route('reception_export') }}"  method="POST" >
            @csrf
            <table>
              <thead>
                <tr>
                  <th style="background-color:#a6a6a6;">Clinic Code</th>
                  <th style="background-color:#a6a6a6;">Pid</th>
                  <th style="background-color:#a6a6a6;">Register Year</th>
                    <th style="background-color:#a6a6a6;">Register Agey</th>
                    <th style="background-color:#a6a6a6;">Register Agem(Month)</th>
                    <th style="background-color:#a6a6a6;">Current Agey</th>
                    <th style="background-color:#a6a6a6;">Current Agem(Month)</th>
                  <th style="background-color:#a6a6a6;">Gender</th>
                  <th style="background-color:#a6a6a6;">FuchiaID</th>
                  <th style="background-color:#a6a6a6;">PrEPCode</th>
                  <th style="background-color:#a6a6a6;">Visit Date</th>

                  <th style="background-color:#a6a6a6;">Main Risk</th>
                  <th style="background-color:#a6a6a6;">Sub Risk</th>

                  <th style="background-color:#a6a6a6;">Refer to Fever Team</th>

                  <th style="background-color:#a6a6a6;">PHA</th>
                  <th style="background-color:#a6a6a6;">PHA New/Old</th>
                  <th style="background-color:#a6a6a6;">PHA MAM Cohort</th>
                 
                  <th style="background-color:#a6a6a6;">ART</th>
                  <th style="background-color:#a6a6a6;">ART New/Old</th>
                  <th style="background-color:#a6a6a6;">ART MAM Cohort</th>

                  <th style="background-color:#a6a6a6;">PrEP</th>
                  <th style="background-color:#a6a6a6;">PrEP New/Old</th>

                  <th style="background-color:#a6a6a6;">PMTCT</th>
                  <th style="background-color:#a6a6a6;">PMTCT New/Old</th>

                  <th style="background-color:#a6a6a6;">ANC</th>
                  <th style="background-color:#a6a6a6;">ANC New/Old</th>

                  <th style="background-color:#a6a6a6;">Family Planning</th>
                  <th style="background-color:#a6a6a6;">Family Planning New/Old</th>

                  <th style="background-color:#a6a6a6;">General</th>
                  <th style="background-color:#a6a6a6;">General New/Old</th>
                  <th style="background-color:#a6a6a6;">General Type of Diagnosis</th>
                  <th style="background-color:#a6a6a6;">OPD</th>
                  
                  <th style="background-color:#a6a6a6;">NCD</th>
                  <th style="background-color:#a6a6a6;">NCD New/Old</th>
                  <th style="background-color:#a6a6a6;">NCD Type of Diagnosis</th>
                  <th style="background-color:#a6a6a6;">NCD MAM Co-hort</th>

                  <th style="background-color:#a6a6a6;">HIV(-) (TB)</th>
                  <th style="background-color:#a6a6a6;">HIV(-)(TB) New/Old</th>

                  <th style="background-color:#a6a6a6;">Feeding Center</th>
                  <th style="background-color:#a6a6a6;">FC New/Old</th>

                  <th style="background-color:#a6a6a6;">Lab Investigation Only</th>
                  <th style="background-color:#a6a6a6;">Lab Invest New/Old</th>

                  <th style="background-color:#a6a6a6;">Next Appointment Date</th>
                  <th style="background-color:#a6a6a6;">Mode</th>
                  <th style="background-color:#a6a6a6;">Unplan</th>
                  <th style="background-color:#a6a6a6;">MUAC</th>
                  <th style="background-color:#a6a6a6;">Remark</th>
                  <th style="background-color:#a6a6a6;">Online</th>


                </tr>
              </thead>
              <tbody>
                @foreach($users as $index => $value)
                <tr> 
                   <td style="width:80px;">{{ $users1[$index]['Clinic Code'] }}</td>
                   <td style="width:80px;">{{ $users1[$index]['Pid'] }}</td>
                   
                   <td style="width:80px;">{{ $users1[$index]['Reg year'] }}</td>
                    <td style="width:80px;">{{ $users1[$index]['Register Agey'] }}</td>
                    <td style="width:80px;">{{ $users1[$index]['Register Agem'] }}</td>
                    <td style="width:80px;">{{ $users1[$index]['Current Agey'] }}</td>
                   <td style="width:80px;">{{ $users1[$index]['Current Agem'] }}</td>
                   <td style="width:80px;">{{ $users1[$index]['Gender'] }}</td>
                   <td style="width:80px;">{{ $users1[$index]['FuchiaID'] }}</td>
                   <td style="width:80px;">{{ $users1[$index]['PrEPCode'] }}</td>
                   <td style="width:80px;">{{ $users1[$index]['Visit Date'] }}</td>

                   <td style="width:80px;">{{ $users1[$index]['Main Risk'] }}</td>
                   <td style="width:80px;">{{ $users1[$index]['Sub Risk'] }}</td>
                  
                   <td style="width:80px;">{{ $users[$index]['Fever'] }}</td>

                   <td style="width:80px;">{{ $users2[$index]['phacheck'] }}</td>
                   <td style="width:80px;">{{ $users2[$index]['pha_new_old'] }}</td>
                   <td style="width:80px;">{{ $users2[$index]['pha_cohort'] }}</td>

                   <td style="width:80px;">{{ $users2[$index]['artcheck'] }}</td>
                   <td style="width:80px;">{{ $users2[$index]['art_new_old'] }}</td>
                   <td style="width:80px;">{{ $users2[$index]['art_cohort'] }}</td>

                  <td style="width:80px;">{{ $users2[$index]['prepcheck'] }}</td>
                   <td style="width:80px;">{{ $users2[$index]['prep_new_old'] }}</td>

                   <td style="width:80px;">{{ $users2[$index]['pmtctcheck'] }}</td>
                   <td style="width:80px;">{{ $users2[$index]['pmtct_new_old'] }}</td>

                   <td style="width:80px;">{{ $users2[$index]['anccheck'] }}</td>
                   <td style="width:80px;">{{ $users2[$index]['anc_new_old'] }}</td>

                   <td style="width:80px;">{{ $users2[$index]['fmaplancheck'] }}</td>
                   <td style="width:80px;">{{ $users2[$index]['famaplan_new_old'] }}</td>

                   <td style="width:80px;">{{ $users2[$index]['gneralcheck'] }}</td>
                   <td style="width:80px;">{{ $users2[$index]['general_new_old'] }}</td>
                   <td style="width:80px;">{{ $users2[$index]['general_diagnosis'] }}</td>
                    @if(array_key_exists("OPD",$users2[$index]))
                      <td style="width:80px;">{{ $users2[$index]['OPD'] }}</td>
                    @else
                      <td style="width:80px;"></td>
                    
                    @endif
                   

                   <td style="width:80px;">{{ $users2[$index]['ncdcheck'] }}</td>
                   <td style="width:80px;">{{ $users2[$index]['ncd_new_old'] }}</td>
                   <td style="width:80px;">{{ $users2[$index]['ncd_diagnosis'] }}</td>
                   <td style="width:80px;">{{ $users2[$index]['ncd_drugSupply'] }}</td>

                   <td style="width:80px;">{{ $users2[$index]['hivTBcheck'] }}</td>
                   <td style="width:80px;">{{ $users2[$index]['hivTB_new_old'] }}</td>

                   <td style="width:80px;">{{ $users2[$index]['fcentercheck'] }}</td>
                   <td style="width:80px;">{{ $users2[$index]['feedcentre_new_old'] }}</td>

                   <td style="width:80px;">{{ $users2[$index]['labInvestcheck'] }}</td>
                   <td style="width:80px;">{{ $users2[$index]['labInvest_new_old'] }}</td>

                   <td style="width:80px;">{{ $users1[$index]['Next Appointment Date'] }}</td>
                   <td style="width:80px;">{{ $users1[$index]['Mode'] }}</td>
                   <td style="width:80px;">{{ $users1[$index]['Unplan'] }}</td>
                   <td style="width:80px;">{{ $users[$index]['MUAC'] }}</td>
                   <td style="width:200px;">{{ $users1[$index]['Remark'] }}</td>
                   <td style="width:200px;">{{ $users1[$index]['Online'] }}</td>


                </tr>
                @endforeach
              </tbody>
            </table>





        </form>
    </div>
</body>

</html>

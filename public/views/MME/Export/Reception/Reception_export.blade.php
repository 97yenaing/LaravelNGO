<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Export Excel </title>
    <style>
  </style>
</head>
@php
   
@endphp
<body>
    <div class="container mt-5 text-center">
      <form action=""  method="POST" >
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
                  <th style="background-color:#a6a6a6;">Created By</th>
                  <th style="background-color:#a6a6a6;">Updated By</th>
                  <th style="background-color:#a6a6a6;">Created at</th>
                  <th style="background-color:#a6a6a6;">Update at</th>


                </tr>
              </thead>
              <tbody>
                @foreach($exports_dataes as $index => $value)
               
                <tr> 
                   <td style="width:80px;">{{ $value['Clinic Code'] }}</td>
                   <td style="width:80px;">{{ $value['Pid'] }}</td>
                   
                   <td style="width:80px;">{{ $value['Reg year'] }}</td>
                    <td style="width:80px;">{{ $value['Register Agey'] }}</td>
                    <td style="width:80px;">{{ $value['Register Agem'] }}</td>
                    <td style="width:80px;">{{ $value['Current Agey'] }}</td>
                   <td style="width:80px;">{{ $value['Current Agem'] }}</td>
                   <td style="width:80px;">{{ $value['Gender'] }}</td>
                   <td style="width:80px;">{{ $value['FuchiaID'] }}</td>
                   <td style="width:80px;">{{ $value['PrEPCode'] }}</td>
                   <td style="width:80px;">{{ $value['Visit Date'] }}</td>

                   <td style="width:80px;">{{ $value['Main Risk'] }}</td>
                   <td style="width:80px;">{{ $value['Sub Risk'] }}</td>
                  
                   <td style="width:80px;">{{ $value['Fever'] }}</td>

                   <td style="width:80px;">{{ $value[$index]['phacheck'] }}</td>
                   <td style="width:80px;">{{ $value[$index]['pha_new_old'] }}</td>
                   <td style="width:80px;">{{ $value[$index]['pha_cohort'] }}</td>

                   <td style="width:80px;">{{ $value[$index]['artcheck'] }}</td>
                   <td style="width:80px;">{{ $value[$index]['art_new_old'] }}</td>
                   <td style="width:80px;">{{ $value[$index]['art_cohort'] }}</td>

                  <td style="width:80px;">{{ $value[$index]['prepcheck'] }}</td>
                   <td style="width:80px;">{{ $value[$index]['prep_new_old'] }}</td>

                   <td style="width:80px;">{{ $value[$index]['pmtctcheck'] }}</td>
                   <td style="width:80px;">{{ $value[$index]['pmtct_new_old'] }}</td>

                   <td style="width:80px;">{{ $value[$index]['anccheck'] }}</td>
                   <td style="width:80px;">{{ $value[$index]['anc_new_old'] }}</td>

                   <td style="width:80px;">{{ $value[$index]['fmaplancheck'] }}</td>
                   <td style="width:80px;">{{ $value[$index]['famaplan_new_old'] }}</td>

                   <td style="width:80px;">{{ $value[$index]['gneralcheck'] }}</td>
                   <td style="width:80px;">{{ $value[$index]['general_new_old'] }}</td>
                   <td style="width:80px;">{{ $value[$index]['general_diagnosis'] }}</td>
                    @if(array_key_exists("OPD",$value[$index]))
                      <td style="width:80px;">{{ $value[$index]['OPD'] }}</td>
                    @else
                      <td style="width:80px;"></td>
                    
                    @endif
                   

                   <td style="width:80px;">{{ $value[$index]['ncdcheck'] }}</td>
                   <td style="width:80px;">{{ $value[$index]['ncd_new_old'] }}</td>
                   <td style="width:80px;">{{ $value[$index]['ncd_diagnosis'] }}</td>
                   <td style="width:80px;">{{ $value[$index]['ncd_drugSupply'] }}</td>

                   <td style="width:80px;">{{ $value[$index]['hivTBcheck'] }}</td>
                   <td style="width:80px;">{{ $value[$index]['hivTB_new_old'] }}</td>

                   <td style="width:80px;">{{ $value[$index]['fcentercheck'] }}</td>
                   <td style="width:80px;">{{ $value[$index]['feedcentre_new_old'] }}</td>

                   <td style="width:80px;">{{ $value[$index]['labInvestcheck'] }}</td>
                   <td style="width:80px;">{{ $value[$index]['labInvest_new_old'] }}</td>

                   <td style="width:80px;">{{ $value['Next Appointment Date'] }}</td>
                   <td style="width:80px;">{{ $value['Mode'] }}</td>
                   <td style="width:80px;">{{ $value['Unplan'] }}</td>
                   <td style="width:80px;">{{$value['MUAC'] }}</td>
                   <td style="width:200px;">{{ $value['Remark'] }}</td>
                   <td style="width:80px;">{{ $value['Online'] }}</td>
                   <td style="width:200px;">{{ $value['created_by'] }}</td>
                   <td style="width:80px;">{{ $value['updated_by'] }}</td>
                   <td style="width:80px;">{{ $value['created_at'] }}</td>
                   <td style="width:80px;">{{ $value['updated_at'] }}</td>
                   
                </tr>
                @endforeach
              </tbody>
            </table>





        </form>
    </div>
</body>

</html>

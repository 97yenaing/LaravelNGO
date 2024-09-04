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
    <form action="{{ route('counsellor_export') }}" method="POST">
      @csrf
      <table>
        <thead>
          <tr>
            <th style="width:100px;">Clinic Code</th>
            <th style="width:100px;">Pid</th>
            <th style="width:100px;">FuchiaID</th>
            <th style="width:100px;">PrEP_ID</th>
            <th style="width:100px;">Gender</th>
            <th style="width:100px;">Reg Year</th>
            <th style="width:100px;">Register Age</th>
            <th style="width:100px;">Register Age(Month)</th>
            <th style="width:100px;">Current Age</th>
            <th style="width:100px;">Current Age(Month)</th>
            <th style="width:100px;">Main Risk</th>
            <th style="width:100px;">Sub Risk</th>
            <th style="width:100px;">Counselling Date</th>
            <th style="width:100px;">Counselor</th>
            <th style="width:100px;">HTS done</th>
            <th style="width:100px;">Reason</th>
            <th style="width:100px;">Status</th>
            <th style="width:100px;">PrEP</th>
            <th style="width:100px;">PrEP Status</th>
            <th style="width:100px;">Pre</th>
            <th style="width:100px;">Post</th>
            <th style="width:100px;">C1</th>
            <th style="width:100px;">C2</th>
            <th style="width:100px;">C2_Done</th>

            <th style="width:100px;">C3</th>
            <th style="width:100px;">ADH</th>
            <th style="width:100px;">Stable</th>
            <th style="width:100px;">&#60;15 Disclosure</th>
            <th style="width:200px;">&#60;15 Disclosure Define</th>
            <th style="width:100px;">&#60;5 ADH</th>
            <th style="width:100px;">OST</th>
            <th style="width:100px;">ART+TB</th>
            <th style="width:100px;">ART+TB Define</th>
            <th style="width:100px;">Only IPT</th>
            <th style="width:100px;">Only TB</th>
            <th style="width:100px;">Only TB_Define</th>
            <th style="width:100px;">NCD</th>
            <th style="width:100px;">ANC</th>
            <th style="width:100px;">PFA</th>
            <th style="width:100px;">PHQ9</th>
            <th style="width:100px;">PHQ9_Define</th>
            <th style="width:100px;">Other</th>
            <th style="width:100px;">EAC</th>
            <th style="width:100px;">FHT</th>
            <th style="width:100px;">C P case</th>
            <th style="width:100px;">PMTCT</th>
            <th style="width:100px;">PHQ4</th>
            <th style="width:100px;">GAD7</th>
            <th style="width:100px;">GAD7_Define</th>
            <th style="width:100px;">Brest Cancer</th>
            <th style="width:100px;">Hep C</th>
            <th style="width:100px;">ART+OST</th>
            <th style="width:100px;">D1</th>
            <th style="width:100px;">D2</th>
            <th style="width:100px;">D3</th>
            <th style="width:100px;">D4</th>
            <th style="width:100px;">CAGE</th>



            <!-- <th style="">Pre</th>
                  <th style="">Post</th>
                  <th style="">Service Modality</th>
                  <th style="">Mode of Entry</th>
                  <th style="">New_Old</th>
                  <th style="">Counselling Date</th>
                  <th style="">Test Location</th>
                  <th style="">Main Risk</th>
                  <th style="">Sub Risk</th>
                  <th style="">HIV Test Date</th>
                  <th style="">HIV Test Determine</th>
                  <th style="">HIV Test UNI</th>
                  <th style="">HIV Test STAT</th>
                  <th style="">HIV Final Result</th>
                  <th style="">Syphillis Test Date</th>
                  <th style="">Syphillis RDT</th>
                  <th style="">Syphillis RPR</th>
                  <th style="">Syphillis VDRL</th>
                  <th style="">HepB/C Test Date</th>
                  <th style="">Hepatitis B</th>
                  <th style="">Hepatitis C</th> -->

          </tr>
        </thead>

        <tbody>
          @foreach($users1 as $index => $value)

          {{-- @dd($value); --}}
          <tr>
            <td>{{ $users1[$index]['Clinic Code'] }}</td>
            <td>{{ $users1[$index]['Pid'] }}</td>
            <td>{{ $users1[$index]['FuchiaID'] }}</td>
            <td>{{ $users1[$index]['PrEPCode'] }}</td>

            <td>{{ $users1[$index]['Gender'] }}</td>
            <td style="width:80px;">{{ $value['Reg year'] }}</td>
            <td style="width:80px;">{{ $value['Register Agey'] }}</td>
            <td style="width:80px;">{{ $value['Register Agem'] }}</td>
            <td style="width:80px;">{{ $value['Current Agey'] }}</td>
            <td style="width:80px;">{{ $value['Current Agem'] }}</td>
            <td>{{ $users1[$index]["Main Risk"] }}</td>
            <td>{{ $users1[$index]["Sub Risk"] }}</td>
            <td style=width:100px;>{{$users1[$index]['Counselling_Date']}}</td>

            <td>{{ $users1[$index]['Counsellor'] }}</td>
            <td>{{ $users1[$index]['HTSdone'] }}</td>
            <td>{{ $users1[$index]['Reason'] }}</td>
            <td>{{ $users1[$index]['Status'] }}</td>

            <td>{{ $users1[$index]['PrEP'] }}</td>

            <td>{{ $users1[$index]['PrEP Status'] }}</td>

            <td>{{ $users1[$index]['Pre'] }}</td>
            <td>{{ $users1[$index]['Post'] }}</td>
            <td>{{ $users1[$index]['C1']}}</td>
            <td>{{ $users1[$index]['C2']}}</td>
            <td>{{ $users1[$index]['c2_done']}}</td>
            <td>{{ $users1[$index]['C3']}}</td>
            <td>{{ $users1[$index]['ADH'] }}</td>
            <td>{{ $users1[$index]['stable']}}</td>
            <td>{{ $users1[$index]['Child under15 Dis'] }}</td>
            <td>{{ $users1[$index]['Disclosure_Define'] }}</td>

            <td>{{ $users1[$index]['Child under15 ADH'] }}</td>
            <td>{{ $users1[$index]['MMT'] }}</td>
            <td>{{ $users1[$index]['IPT'] }}</td> {{-- ART+TB --}}

            <td>{{ $users1[$index]['PHATB_Define'] }}</td>
            <td>{{ $users1[$index]['Only_IPT'] }}</td>


            <td>{{ $users1[$index]['TB'] }}</td>
            <td>{{ $users1[$index]['Only_TB_Define'] }}</td>
            <td>{{ $users1[$index]['NCD'] }}</td>
            <td>{{ $users1[$index]['ANC'] }}</td>
            <td>{{ $users1[$index]['PFA'] }}</td>
            <td>{{ $users1[$index]['PHQ9'] }}</td>
            <td>{{ $users1[$index]['PHQ9_Define'] }}</td>
            <td>{{ $users1[$index]['Other'] }}</td>
            <td>{{ $users1[$index]['EAC'] }}</td>
            <td>{{ $users1[$index]['HMT'] }}</td>
            <td>{{ $users1[$index]['C P case'] }}</td>
            <td>{{ $users1[$index]['PMTCT'] }}</td>
            <td>{{ $users1[$index]['phq4']}}</td>
            <td>{{ $users1[$index]['gad7']}}</td>
            <td>{{ $users1[$index]['gad7_Define']}}</td>
            <td>{{ $users1[$index]['brest_cancer']}}</td>
            <td>{{ $users1[$index]['hepC']}}</td>
            <td>{{ $users1[$index]['art_ost']}}</td>
            <td>{{ $users1[$index]['d1']}}</td>
            <td>{{ $users1[$index]['d2']}}</td>
            <td>{{ $users1[$index]['d3']}}</td>
            <td>{{ $users1[$index]['d4']}}</td>
            <td>{{ $users1[$index]['cage']}}</td>
          </tr>
          @endforeach
        </tbody>
      </table>





    </form>
  </div>
</body>

</html>
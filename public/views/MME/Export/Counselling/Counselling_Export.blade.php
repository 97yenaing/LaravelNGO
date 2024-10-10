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
          <th style="width:100px;">&#60;5 ADH</th>
          <th style="width:100px;">OST</th>
          <th style="width:100px;">ART+TB/TPT</th>
          <th style="width:100px;">Only TB</th>
          <th style="width:100px;">NCD</th>
          <th style="width:100px;">ANC</th>
          <th style="width:100px;">PFA</th>
          <th style="width:100px;">PHQ9</th>
          <th style="width:100px;">Other</th>
          <th style="width:100px;">EAC</th>
          <th style="width:100px;">FHT</th>
          <th style="width:100px;">C P case</th>
          <th style="width:100px;">PMTCT</th>
          <th style="width:100px;">PHQ4</th>
          <th style="width:100px;">GAD7</th>
          <th style="width:100px;">Brest Cancer</th>
          <th style="width:100px;">Hep C</th>
          <th style="width:100px;">ART+OST</th>
          <th style="width:100px;">D1</th>
          <th style="width:100px;">D2</th>
          <th style="width:100px;">D3</th>
          <th style="width:100px;">D4</th>
          <th style="width:100px;">CAGE</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($counselling_records as $counselling_record)
          <tr>
            <td>{{ $counselling_record["Clinic Code"] }}</td>
            <td>{{ $counselling_record["Pid"] }}</td>
            <td>{{ $counselling_record["FuchiaID"] }}</td>
            <td>{{ $counselling_record["PrEPCode"] }}</td>

            <td>{{ $counselling_record["Gender"] }}</td>
            <td style="width:80px;">{{ $counselling_record["Reg year"] }}</td>
            <td style="width:80px;">{{ $counselling_record["Register Agey"] }}
            </td>
            <td style="width:80px;">{{ $counselling_record["Register Agem"] }}
            </td>
            <td style="width:80px;">{{ $counselling_record["Current Agey"] }}
            </td>
            <td style="width:80px;">{{ $counselling_record["Current Agem"] }}
            </td>
            <td>{{ $counselling_record["Main Risk"] }}</td>
            <td>{{ $counselling_record["Sub Risk"] }}</td>
            <td style=width:100px;>
              {{ $counselling_record["Counselling_Date"] }}
            </td>

            <td>{{ $counselling_record["Counsellor"] }}</td>
            <td>{{ $counselling_record["HTSdone"] }}</td>
            <td>{{ $counselling_record["Reason"] }}</td>
            <td>{{ $counselling_record["Status"] }}</td>

            <td>{{ $counselling_record["PrEP"] }}</td>

            <td>{{ $counselling_record["PrEP Status"] }}</td>

            <td>{{ $counselling_record["Pre"] }}</td>
            <td>{{ $counselling_record["Post"] }}</td>
            <td>{{ $counselling_record["C1"] }}</td>
            <td>{{ $counselling_record["C2"] }}</td>
            <td>{{ $counselling_record["c2_done"] }}</td>
            <td>{{ $counselling_record["C3"] }}</td>
            <td>{{ $counselling_record["ADH"] }}</td>
            <td>{{ $counselling_record["stable"] }}</td>

            <td>{{ $counselling_record["Child under15 Dis"] }}</td>
            <td>{{ $counselling_record["Child under15 ADH"] }}</td>
            <td>{{ $counselling_record["MMT"] }}</td>
            <td>{{ $counselling_record["IPT"] }}</td>
            <td>{{ $counselling_record["TB"] }}</td>
            <td>{{ $counselling_record["NCD"] }}</td>
            <td>{{ $counselling_record["ANC"] }}</td>
            <td>{{ $counselling_record["PFA"] }}</td>
            <td>{{ $counselling_record["PHQ9"] }}</td>
            <td>{{ $counselling_record["Other"] }}</td>
            <td>{{ $counselling_record["EAC"] }}</td>
            <td>{{ $counselling_record["HMT"] }}</td>
            <td>{{ $counselling_record["C P case"] }}</td>
            <td>{{ $counselling_record["PMTCT"] }}</td>
            <td>{{ $counselling_record["phq4"] }}</td>
            <td>{{ $counselling_record["gad7"] }}</td>
            <td>{{ $counselling_record["brest_cancer"] }}</td>
            <td>{{ $counselling_record["hepC"] }}</td>
            <td>{{ $counselling_record["art_ost"] }}</td>
            <td>{{ $counselling_record["d1"] }}</td>
            <td>{{ $counselling_record["d2"] }}</td>
            <td>{{ $counselling_record["d3"] }}</td>
            <td>{{ $counselling_record["d4"] }}</td>
            <td>{{ $counselling_record["cage"] }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </form>
</body>

</html>

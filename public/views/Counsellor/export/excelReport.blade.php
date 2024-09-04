<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>

<body>
  <table class="table" style="background-color: #cd646485;">
    <thead>
      <tr>
        <th style="text-align: center" colspan="19"><b>MAM/NAP Satelite Site Activies Report</b></th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><b>Center</b></td>
        <td><input type="text"></td>{{--data center --}}
        <td colspan="3"></td>
        <td colspan="4" style="text-align: center"><b>ယခုလ HIV (+) File တွဲ</b></td>
        <td><input type="text"></td>{{-- HIV (+) File တွဲ data --}}
        <td colspan="5"></td>
        <td colspan="2" rowspan="2" style="text-align: center"><b>Inconuclusive</b></td>
        <td><b>New</b></td>
        <td>{{$hts_result["inconslusive_new"]}}</td>{{--New data --}}
      </tr>
      <tr>
        <td><b>Month</b></td>
        <td><input type="text"></td>{{-- Month data --}}
        <td colspan="3"></td>
        <td colspan="4" style="text-align: center"><b>ယခုလ HIV (+) File မတွဲ</b></td>
        <td><input type="text"></td>{{-- HIV (+) File မတွဲ data --}}
        <td colspan="5"></td>
        <td><b>Old</b></td>
        <td>{{$hts_result["inconslusive_old"]}}</td>{{--Old data --}}
      </tr>
      <tr>
        <td colspan="4"></td>
        <td style="text-align: center" colspan="5"><b>ယခုလ HIV (+) ယာယီ File တွဲ</b></td>
        <td><input type="text"></td>{{-- ယခုလ HIV (+) ယာယီ File တွဲ data --}}
        <td colspan="9"></td>
      </tr>
      <tr>
        <td colspan="3"></td>
        <td colspan="6" style="text-align: center"><b>ယခင်လ များမှ HIV (+) ယခုလ မှ File တွဲ</b></td>
        <td><input type="text"></td>{{-- ယခင်လ များမှ HIV (+) ယခုလ မှ File တွဲ data --}}
        <td colspan="9"></td>
      </tr>
      <tr>
        <td rowspan="3"></td>
        <td rowspan="3" style="text-align: center;"><b>Total
            Candidate</b></td>
        <td rowspan="3" style="text-align: center;"><b>C1</b></td>
        <td rowspan="3" style="text-align: center;"><b>C2</b></td>
        <td rowspan="3" style="background-color: #000000"></td>
        <td rowspan="3" style="text-align: center;"><b>C3</b></td>
        <td rowspan="3" style="text-align: center;"><b>ADH</b></td>
        <td rowspan="3" style="text-align: center;"><b>EAC</b></td>
        <td rowspan="3" style="text-align: center;"><b>PMTCT</b></td>
        <td rowspan="3" style="text-align: center;"><b>Stable</b></td>
        <td rowspan="3" style="text-align: center;"><b>HepC</b></td>
        <td colspan="4" style="text-align: center;"><b>Child</b></td>
        <td rowspan="3" style="text-align: center;"><b>CP case</b></td>
        <td rowspan="3" style="text-align: center;"><b>NCD</b></td>
        <td rowspan="3" style="text-align: center;"><b>ANC</b></td>
        <td rowspan="3" style="text-align: center;"><b>IPT</b></td>
      </tr>
      <tr>
        <td colspan="2" style="text-align: center;"><b>Disclosur</b></td>
        <td colspan="2" style="text-align: center;"><b>Adolesent</b></td>
      </tr>
      <tr>
        <td style="text-align: center;"><b>Par</b></td>
        <td style="text-align: center;"><b>Full</b></td>
        <td style="text-align: center;"><b>ADA</b></td>
        <td style="text-align: center;"><b>Child</b></td>
      </tr>
      <tr>
        <td style="text-align: center"><b>No of Clients</b></td>
        <td style="text-align: center;">{{$hts_result["first_total"]}}</td>{{--Total --}}
        <td style="text-align: center;">{{$hts_result["C1"]}}</td>{{--C1 --}}
        <td style="text-align: center;">{{$hts_result["C2"]}}</td>{{--C2 --}}
        <td style="background-color: #000000"></td>
        <td style="text-align: center;">{{$hts_result["C3"]}}</td>{{--C3 --}}
        <td style="text-align: center;">{{$hts_result["ADH"]}}</td>{{--ADH --}}
        <td style="text-align: center;">{{$hts_result["EAC"]}}</td>{{--EAC --}}
        <td style="text-align: center;">{{$hts_result["PMTCT"]}}</td>{{--PMTCT --}}
        <td style="text-align: center;">{{$hts_result["stable"]}}</td>{{--Stable --}}
        <td style="text-align: center;">{{$hts_result["hepC"]}}</td>{{--HepC --}}
        <td style="text-align: center;">{{$hts_result["dis_partial"]}}</td>{{--C_par --}}
        <td style="text-align: center;">{{$hts_result["dis_full"]}}</td>{{--C_full --}}
        <td style="text-align: center;">{{$hts_result["ada"]}}</td>{{--C_adh --}}
        <td style="text-align: center;">{{$hts_result["ada_child"]}}</td>{{--C_child --}}
        <td style="text-align: center;">{{$hts_result["C P case"]}}</td>{{--CP_case --}}
        <td style="text-align: center;">{{$hts_result["NCD"]}}</td>{{--C_NCD --}}
        <td style="text-align: center;">{{$hts_result["ANC"]}}</td>{{--C_ANC --}}
        <td style="text-align: center;">{{$hts_result["Only_IPT"]}}</td>{{--C_IPT --}}


      </tr>{{-- No of Clients --}}

      <tr>
        <td style="text-align: center"><b>No of Session</b></td>
        <td style="text-align: center;">{{$hts_result["first_total"]}}</td>{{--Total --}}
        <td style="text-align: center;">{{$hts_result["C1"]}}</td>{{--C1 --}}
        <td style="text-align: center;">{{$hts_result["C2"]}}</td>{{--C2 --}}
        <td style="background-color: #000000"></td>
        <td style="text-align: center;">{{$hts_result["C3"]}}</td>{{--C3 --}}
        <td style="text-align: center;">{{$hts_result["ADH"]}}</td>{{--ADH --}}
        <td style="text-align: center;">{{$hts_result["EAC"]}}</td>{{--EAC --}}
        <td style="text-align: center;">{{$hts_result["PMTCT"]}}</td>{{--PMTCT --}}
        <td style="text-align: center;">{{$hts_result["stable"]}}</td>{{--Stable --}}
        <td style="text-align: center;">{{$hts_result["hepC"]}}</td>{{--HepC --}}
        <td style="text-align: center;">{{$hts_result["dis_partial"]}}</td>{{--C_par --}}
        <td style="text-align: center;">{{$hts_result["dis_full"]}}</td>{{--C_full --}}
        <td style="text-align: center;">{{$hts_result["ada"]}}</td>{{--C_adh --}}
        <td style="text-align: center;">{{$hts_result["ada_child"]}}</td>{{--C_child --}}
        <td style="text-align: center;">{{$hts_result["C P case"]}}</td>{{--CP_case --}}
        <td style="text-align: center;">{{$hts_result["NCD"]}}</td>{{--C_NCD --}}
        <td style="text-align: center;">{{$hts_result["ANC"]}}</td>{{--C_ANC --}}
        <td style="text-align: center;">{{$hts_result["Only_IPT"]}}</td>{{--C_IPT --}}
      </tr>{{-- No of Session --}}

      <tr>
        <td colspan="19"></td>
      </tr>

      <tr>
        <td rowspan="3"></td>
        <td rowspan="3" style="text-align: center"><b>Total Candidate</b></td>
        <td rowspan="5" colspan="2" style="text-align: center; background-color:#000000"></td>
        <td colspan="6" style="text-align: center"><b>MH</b></td>
        <td rowspan="2" colspan="2" style="text-align: center;"><b>PrEP</b></td>
        <td rowspan="2" colspan="4" style="text-align: center;"><b>SBIRT</b></td>
        <td rowspan="3" style="text-align: center;"><b>FHT</b></td>
        <td rowspan="2" colspan="4" style="text-align: center;"><b>OST</b></td>
      </tr>
      <tr>
        <td rowspan="2" style="text-align: center;"><b>PFA</b></td>
        <td rowspan="2" style="text-align: center;"><b>PHQ4</b></td>
        <td colspan="2" style="text-align: center;"><b>PHQ9</b></td>
        <td colspan="2" style="text-align: center;"><b>GAD7</b></td>
      </tr>
      <tr>
        <td style="text-align: center;"><b>N</b></td>
        <td style="text-align: center;"><b>F</b></td>
        <td style="text-align: center;"><b>N</b></td>
        <td style="text-align: center;"><b>F</b></td>
        <td style="text-align: center;"><b>N</b></td>
        <td style="text-align: center;"><b>F</b></td>
        <td style="text-align: center;"><b>D1</b></td>
        <td style="text-align: center;"><b>D2</b></td>
        <td style="text-align: center;"><b>D3</b></td>
        <td style="text-align: center;"><b>D4</b></td>
        <td style="text-align: center;"><b>ART+OST</b></td>
        <td style="text-align: center;"><b>OST</b></td>
      </tr>

      <tr>
        <td style="text-align: center;"><b>No of Clients</b></td>
        <td style="text-align: center;">{{$hts_result["second_total"]}}</td>{{--nc_Total Candidate --}}
        <td style="text-align: center;">{{$hts_result["PFA"]}}</td>{{--nc_PFA --}}
        <td style="text-align: center;">{{$hts_result["phq4"]}}</td>{{--nc_PHQ4 --}}
        <td style="text-align: center;">{{$hts_result["phq9_partial"]}}</td>{{--nc_PHQ9 N --}}
        <td style="text-align: center;">{{$hts_result["phq9_follow"]}}</td>{{--nc_PHQ9 F --}}
        <td style="text-align: center;">{{$hts_result["gad7_partial"]}}</td>{{--nc_GAD7_N --}}
        <td style="text-align: center;">{{$hts_result["gad7_follow"]}}</td>{{--nc_GAD7_F --}}
        <td style="text-align: center;">{{$hts_result["prep_new"]}}</td>{{--nc_PrEP_N --}}
        <td style="text-align: center;">{{$hts_result["prep_follow"]}}</td>{{--nc_PrEP_F --}}
        <td style="text-align: center;">{{$hts_result["d1"]}}</td>{{--nc_SBIRT D1 --}}
        <td style="text-align: center;">{{$hts_result["d2"]}}</td>{{--nc_SBIRT D2 --}}
        <td style="text-align: center;">{{$hts_result["d3"]}}</td>{{--nc_SBIRT D3 --}}
        <td style="text-align: center;">{{$hts_result["d4"]}}</td>{{--nc_SBIRT D4 --}}
        <td style="text-align: center;">{{$hts_result["HMT"]}}</td>{{--nc_FHT --}}
        <td style="text-align: center;">{{$hts_result["art_ost"]}}</td>{{--nc_OST_ART --}}
        <td style="text-align: center;">{{$hts_result["MMT"]}}</td>{{--nc_OST--}}
      </tr>
      <tr>
        <td style="text-align: center;"><b>No of Session</b></td>
        <td style="text-align: center;">{{$hts_result["second_total"]}}</td>{{--ns_Total Candidate --}}
        <td style="text-align: center;">{{$hts_result["PFA"]}}</td>{{--nc_PFA --}}
        <td style="text-align: center;">{{$hts_result["phq4"]}}</td>{{--nc_PHQ4 --}}
        <td style="text-align: center;">{{$hts_result["phq9_partial"]}}</td>{{--nc_PHQ9 N --}}
        <td style="text-align: center;">{{$hts_result["phq9_follow"]}}</td>{{--nc_PHQ9 F --}}
        <td style="text-align: center;">{{$hts_result["gad7_partial"]}}</td>{{--nc_GAD7_N --}}
        <td style="text-align: center;">{{$hts_result["gad7_follow"]}}</td>{{--nc_GAD7_F --}}
        <td style="text-align: center;">{{$hts_result["prep_new"]}}</td>{{--nc_PrEP_N --}}
        <td style="text-align: center;">{{$hts_result["prep_follow"]}}</td>{{--nc_PrEP_F --}}
        <td style="text-align: center;">{{$hts_result["d1"]}}</td>{{--nc_SBIRT D1 --}}
        <td style="text-align: center;">{{$hts_result["d2"]}}</td>{{--nc_SBIRT D2 --}}
        <td style="text-align: center;">{{$hts_result["d3"]}}</td>{{--nc_SBIRT D3 --}}
        <td style="text-align: center;">{{$hts_result["d4"]}}</td>{{--nc_SBIRT D4 --}}
        <td style="text-align: center;">{{$hts_result["HMT"]}}</td>{{--nc_FHT --}}
        <td style="text-align: center;">{{$hts_result["art_ost"]}}</td>{{--nc_OST_ART --}}
        <td style="text-align: center;">{{$hts_result["MMT"]}}</td>{{--nc_OST--}}
      </tr>

      <tr>
        <td colspan="19"></td>
      </tr>

      <tr>
        <td rowspan="2"></td>
        <td colspan="2" style="text-align: center"><b>New PT</b></td>
        <td colspan="2" style="text-align: center"><b>M2</b></td>
        <td colspan="2" style="text-align: center"><b>M3</b></td>
        <td colspan="2" style="text-align: center"><b>M5</b></td>
        <td colspan="2" style="text-align: center"><b>M6</b></td>
        <td colspan="2" style="text-align: center"><b>M8</b></td>
        <td></td>
        <td colspan="3" style="text-align: center"><b>Total HTC Test (New+Old)</b></td>
        <td colspan="2" style="text-align: center"><b>{{$hts_result["total_htc_test"]}}</b></td>{{--Total HTC Test
        (New+Old) data--}}
      </tr>
      <tr>
        <td style="text-align: center"><b>PHA</b></td>
        <td style="text-align: center"><b>OTB</b></td>
        <td style="text-align: center"><b>PHA</b></td>
        <td style="text-align: center"><b>OTB</b></td>
        <td style="text-align: center"><b>PHA</b></td>
        <td style="text-align: center"><b>OTB</b></td>
        <td style="text-align: center"><b>PHA</b></td>
        <td style="text-align: center"><b>OTB</b></td>
        <td style="text-align: center"><b>PHA</b></td>
        <td style="text-align: center"><b>OTB</b></td>
        <td style="text-align: center"><b>PHA</b></td>
        <td style="text-align: center"><b>OTB</b></td>
        <td></td>
        <td colspan="3" style="text-align: center"><b>Positive</b></td>
        <td colspan="2" style="text-align: center"><b>{{$hts_result["htc_positive"]}}</b></td>{{--Positive data--}}
      </tr>

      <tr>
        <td style="text-align: center"><b>No of Clients</b></td>
        <td style="text-align: center">{{$hts_result["phaTB_m0"]}}</td>
        <td style="text-align: center">{{$hts_result["tb_m0"]}}</td>
        <td style="text-align: center">{{$hts_result["phaTB_m2"]}}</td>
        <td style="text-align: center">{{$hts_result["tb_m2"]}}</td>
        <td style="text-align: center">{{$hts_result["phaTB_m3"]}}</td>
        <td style="text-align: center">{{$hts_result["tb_m3"]}}</td>
        <td style="text-align: center">{{$hts_result["phaTB_m5"]}}</td>
        <td style="text-align: center">{{$hts_result["tb_m5"]}}</td>
        <td style="text-align: center">{{$hts_result["phaTB_m6"]}}</td>
        <td style="text-align: center">{{$hts_result["tb_m6"]}}</td>
        <td style="text-align: center">{{$hts_result["phaTB_m8"]}}</td>
        <td style="text-align: center">{{$hts_result["tb_m8"]}}</td>
        <td></td>
        <td colspan="3" style="text-align: center"><b>Total No of clients CSl</b></td>
        <td colspan="2" style="text-align: center"><b>{{$hts_result["phatb_total"]}}</b></td>{{--Total No of clients
        CSl--}}
      </tr>

      <tr>
        <td style="text-align: center"><b>No of Session</b></td>
        <td style="text-align: center">{{$hts_result["phaTB_m0"]}}</td>
        <td style="text-align: center">{{$hts_result["tb_m0"]}}</td>
        <td style="text-align: center">{{$hts_result["phaTB_m2"]}}</td>
        <td style="text-align: center">{{$hts_result["tb_m2"]}}</td>
        <td style="text-align: center">{{$hts_result["phaTB_m3"]}}</td>
        <td style="text-align: center">{{$hts_result["tb_m3"]}}</td>
        <td style="text-align: center">{{$hts_result["phaTB_m5"]}}</td>
        <td style="text-align: center">{{$hts_result["tb_m5"]}}</td>
        <td style="text-align: center">{{$hts_result["phaTB_m6"]}}</td>
        <td style="text-align: center">{{$hts_result["tb_m6"]}}</td>
        <td style="text-align: center">{{$hts_result["phaTB_m8"]}}</td>
        <td style="text-align: center">{{$hts_result["tb_m8"]}}</td>
        <td></td>
        <td colspan="3" style="text-align: center"><b>Total No of Session CSl</b></td>
        <td colspan="2" style="text-align: center"><b>{{$hts_result["phatb_total"]}}</b></td>{{--Total No of Session
        CSl--}}
      </tr>

    </tbody>
  </table>
</body>

</html>
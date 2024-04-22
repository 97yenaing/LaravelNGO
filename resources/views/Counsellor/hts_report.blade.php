@extends('layouts.app')
@section('content')
@auth

<body>
  <form action="" method="post">
    <div class="container containers page-color">
      <div class="row" style="justify-content: center">
        <div class="col-sm-2">
          <label for="" class="form-label">From Date</label>
          <div class="date-holder">
            <input type="text" id="" name="from_date" class="form-control Gdate" placeholder="dd-mm-yyyy">
            <img src="../img/calendar3.svg" class="dateimg" alt="date">
          </div>
        </div>
        <div class="col-sm-2">
          <label for="" class="form-label">To Date</label>
          <div class="date-holder">
            <input type="text" id="" name="to_date" class="form-control Gdate" placeholder="dd-mm-yyyy">
            <img src="../img/calendar3.svg" class="dateimg" alt="date">
          </div>
        </div>
        <div class="col-sm-2">
          <button class="btn update-batton counsel-report-btn">Export report</button>
        </div>
      </div>
      <table class="table">
        <thead>
          <tr>
            <th style="text-align: center" colspan="19"><b>MAM/NAP Satelite Site Activies Report</b></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><b>Center</b></td>
            <td></td>{{--data center --}}
            <td colspan="3"></td>
            <td colspan="4" style="text-align: center"><b>ယခုလ HIV (+) File တွဲ</b></td>
            <td></td>{{-- HIV (+) File တွဲ data --}}
            <td colspan="2"></td>
            <td colspan="2" rowspan="2" style="text-align: center"><b>Inconuclusive</b></td>
            <td><b>New</b></td>
            <td></td>{{--New data --}}
          </tr>
          <tr>
            <td><b>Month</b></td>
            <td></td>{{-- Month data --}}
            <td colspan="3"></td>
            <td colspan="4" style="text-align: center"><b>ယခုလ HIV (+) File မတွဲ</b></td>
            <td></td>{{-- HIV (+) File မတွဲ data --}}
            <td colspan="2"></td>
            <td><b>Old</b></td>
            <td></td>{{--Old data --}}
          </tr>
          <tr>
            <td colspan="4"></td>
            <td style="text-align: center" colspan="5"><b>ယခုလ HIV (+) ယာယီ File တွဲ</b></td>
            <td></td>{{-- ယခုလ HIV (+) ယာယီ File တွဲ data --}}
            <td colspan="6"></td>
          </tr>
          <tr>
            <td colspan="3"></td>
            <td colspan="6" style="text-align: center"><b>ယခင်လ များမှ HIV (+) ယခုလ မှ File တွဲ</b></td>
            <td></td>{{-- ယခင်လ များမှ HIV (+) ယခုလ မှ File တွဲ data --}}
            <td colspan="6"></td>
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
            <td style="text-align: center;"></td>{{--Total --}}
            <td style="text-align: center;"></td>{{--C1 --}}
            <td style="text-align: center;"></td>{{--C2 --}}
            <td style="background-color: #000000"></td>
            <td style="text-align: center;"></td>{{--C3 --}}
            <td style="text-align: center;"></td>{{--ADH --}}
            <td style="text-align: center;"></td>{{--EAC --}}
            <td style="text-align: center;"></td>{{--PMTCT --}}
            <td style="text-align: center;"></td>{{--Stable --}}
            <td style="text-align: center;"></td>{{--HepC --}}
            <td style="text-align: center;"></td>{{--C_par --}}
            <td style="text-align: center;"></td>{{--C_full --}}
            <td style="text-align: center;"></td>{{--C_adh --}}
            <td style="text-align: center;"></td>{{--C_child --}}
            <td style="text-align: center;"></td>{{--CP_case --}}
            <td style="text-align: center;"></td>{{--C_NCD --}}
            <td style="text-align: center;"></td>{{--C_ANC --}}
            <td style="text-align: center;"></td>{{--C_IPT --}}


          </tr>{{-- No of Clients --}}

          <tr>
            <td style="text-align: center"><b>No of Session</b></td>
            <td style="text-align: center;"></td>{{--Total --}}
            <td style="text-align: center;"></td>{{--C1 --}}
            <td style="text-align: center;"></td>{{--C2 --}}
            <td style="background-color: #000000"></td>
            <td style="text-align: center;"></td>{{--C3 --}}
            <td style="text-align: center;"></td>{{--ADH --}}
            <td style="text-align: center;"></td>{{--EAC --}}
            <td style="text-align: center;"></td>{{--PMTCT --}}
            <td style="text-align: center;"></td>{{--Stable --}}
            <td style="text-align: center;"></td>{{--HepC --}}
            <td style="text-align: center;"></td>{{--C_par --}}
            <td style="text-align: center;"></td>{{--C_full --}}
            <td style="text-align: center;"></td>{{--C_adh --}}
            <td style="text-align: center;"></td>{{--C_child --}}
            <td style="text-align: center;"></td>{{--CP_case --}}
            <td style="text-align: center;"></td>{{--C_NCD --}}
            <td style="text-align: center;"></td>{{--C_ANC --}}
            <td style="text-align: center;"></td>{{--C_IPT --}}
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
            <td style="text-align: center;"></td>{{--nc_Total Candidate --}}
            <td style="text-align: center;"></td>{{--nc_PFA --}}
            <td style="text-align: center;"></td>{{--nc_PHQ4 --}}
            <td style="text-align: center;"></td>{{--nc_PHQ9 N --}}
            <td style="text-align: center;"></td>{{--nc_PHQ9 F --}}
            <td style="text-align: center;"></td>{{--nc_GAD7_N --}}
            <td style="text-align: center;"></td>{{--nc_GAD7_F --}}
            <td style="text-align: center;"></td>{{--nc_PrEP_N --}}
            <td style="text-align: center;"></td>{{--nc_PrEP_F --}}
            <td style="text-align: center;"></td>{{--nc_SBIRT D1 --}}
            <td style="text-align: center;"></td>{{--nc_SBIRT D2 --}}
            <td style="text-align: center;"></td>{{--nc_SBIRT D3 --}}
            <td style="text-align: center;"></td>{{--nc_SBIRT D4 --}}
            <td style="text-align: center;"></td>{{--nc_FHT --}}
            <td style="text-align: center;"></td>{{--nc_OST_ART --}}
            <td style="text-align: center;"></td>{{--nc_OST--}}
          </tr>
          <tr>
            <td style="text-align: center;"><b>No of Session</b></td>
            <td style="text-align: center;"></td>{{--ns_Total Candidate --}}
            <td style="text-align: center;"></td>{{--ns_PFA --}}
            <td style="text-align: center;"></td>{{--ns_PHQ4 --}}
            <td style="text-align: center;"></td>{{--ns_PHQ9 N --}}
            <td style="text-align: center;"></td>{{--ns_PHQ9 F --}}
            <td style="text-align: center;"></td>{{--ns_GAD7_N --}}
            <td style="text-align: center;"></td>{{--ns_GAD7_F --}}
            <td style="text-align: center;"></td>{{--ns_PrEP_N --}}
            <td style="text-align: center;"></td>{{--ns_PrEP_F --}}
            <td style="text-align: center;"></td>{{--ns_SBIRT D1 --}}
            <td style="text-align: center;"></td>{{--ns_SBIRT D2 --}}
            <td style="text-align: center;"></td>{{--ns_SBIRT D3 --}}
            <td style="text-align: center;"></td>{{--ns_SBIRT D4 --}}
            <td style="text-align: center;"></td>{{--ns_FHT --}}
            <td style="text-align: center;"></td>{{--ns_OST_ART --}}
            <td style="text-align: center;"></td>{{--ns_OST--}}
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
            <td colspan="2" style="text-align: center"><b></b></td>{{--Total HTC Test (New+Old) data--}}
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
            <td colspan="2" style="text-align: center"><b></b></td>{{--Positive data--}}
          </tr>

          <tr>
            <td style="text-align: center"><b>No of Clients</b></td>
            <td style="text-align: center"></td>
            <td style="text-align: center"></td>
            <td style="text-align: center"></td>
            <td style="text-align: center"></td>
            <td style="text-align: center"></td>
            <td style="text-align: center"></td>
            <td style="text-align: center"></td>
            <td style="text-align: center"></td>
            <td style="text-align: center"></td>
            <td style="text-align: center"></td>
            <td style="text-align: center"></td>
            <td style="text-align: center"></td>
            <td></td>
            <td colspan="3" style="text-align: center"><b>Total No of clients CSl</b></td>
            <td colspan="2" style="text-align: center"><b></b></td>{{--Total No of clients CSl--}}
          </tr>

          <tr>
            <td style="text-align: center"><b>No of Session</b></td>
            <td style="text-align: center"></td>
            <td style="text-align: center"></td>
            <td style="text-align: center"></td>
            <td style="text-align: center"></td>
            <td style="text-align: center"></td>
            <td style="text-align: center"></td>
            <td style="text-align: center"></td>
            <td style="text-align: center"></td>
            <td style="text-align: center"></td>
            <td style="text-align: center"></td>
            <td style="text-align: center"></td>
            <td style="text-align: center"></td>
            <td></td>
            <td colspan="3" style="text-align: center"><b>Total No of Session CSl</b></td>
            <td colspan="2" style="text-align: center"><b></b></td>{{--Total No of Session CSl--}}
          </tr>

        </tbody>
      </table>

    </div>
  </form>


</body>
@endauth
@endsection
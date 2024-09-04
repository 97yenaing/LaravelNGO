@extends('layouts.app')
  <link rel="stylesheet" href="/css/lab.css" type="text/css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
@section('content')
@auth
  <div class="container">
    <div class="col-sm-12">
      <h4>Monthly or Annual Reports of STD</h4>
    </div>
    <div id="indicator_1">
      <div class="row">
        <div class="col-sm-12">
          <span>1. Total clinic attendance("1st+Repeat" from Clinic Register)</span>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-2">
          <select class="form-control" id="clinic">
          <!--  <option value="71">A</option>
            <option value="72">B</option>
            <option value="83">C1</option> -->
            <option value="81">C2</option>
          <!--  <option value="73">SPT</option>
            <option value="74">TL</option>
            <option value="22">BKK</option>
            <option value="76">TBZY</option>
            <option value="82">Taze</option>
            <option value="">PH</option>
            <option value="">NK</option>
            <option value="">DH</option>
            <option value="">WK</option> -->
          </select><br>
        </div>
        <div class="col-sm-2">
          <select class="form-control" id="range">
            <option value="onlyOne">Monthly</option>
            <option value="annual">Annual</option>
          </select><br>
        </div>

        <div class="col-sm-2">
          <select class="form-control" id="month" >
            <option value="">Month</option>
            <option value="1">1.Jan</option>
            <option value="2">2.Feb</option>
            <option value="3">3.March</option>
            <option value="4">4.April</option>
            <option value="5">5.May</option>
            <option value="6">6.June</option>
            <option value="7">7.July</option>
            <option value="8">8.August</option>
            <option value="9">9.Sept</option>
            <option value="10">10.Oct</option>
            <option value="11">11.Nov</option>
            <option value="12">12.Dec</option>
          </select><br>
        </div>
        <div class="col-sm-2">
          <select class="form-control" id="year">
            <option value="">Year</option>
            <option value="2022">2022</option>
            <option value="2021">2021</option>
          </select><br>
        </div>

        <div class="col-sm-2">
          <button type="button" class="btn btn-dark"  onclick="calculate()" >Calculate</button>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-6">
        <span>Episodes </span>
        <canvas id="myChart" style="width:100%;height:400px;"></canvas>
      </div>
      <div class="col-sm-6">
        <span>Syphillis Testing</span>
        <canvas id="myChart2" style="width:100%;height:400px; "></canvas>
      </div>
    </div>
    <br>

    <div id="monthlyTable" class="table-responsive">
      <table class="table">
        <thead class="thead-dark">
          <tr>
            <td>STD Report</td>
            <td>Male</td>
            <td>Female</td>
            <td>Total</td>
          </tr>
        </thead>
        <tbody>
          <tr class="table-primary">
            <td>Total clinic attendance</td>
            <td id="att_m"></td>
            <td id="att_f"></td>
            <td id="att_t"></td>
          </tr>
          <tr class="table-success">
            <td>STI Patients(epicodes)</td>
            <td id="epi_m"></td>
            <td id="epi_f"></td>
            <td id="epi_t"></td>
          </tr>
          <tr class="table-danger">
            <td>Patients with genital ulcers</td>
            <td id="g1_m"></td>
            <td id="g1_f"></td>
            <td id="g1_t"></td>
          </tr>
          <tr class="table-info">
            <td>Patients with genito-urinary discharge</td>
            <td id="g2_m"></td>
            <td id="g2_f"></td>
            <td id="g2_t"></td>
          </tr>
          <tr class="table-warning">
            <td>Patients with other STIs</td>
            <td id="g3_m"></td>
            <td id="g3_f"></td>
            <td id="g3_t"></td>
          </tr>
        </tbody>
      </table>
    </div>

    <div class="row">
      <div class="col-sm-10" style="margin: auto;">
        <div id="monthlyTable">
      <table class="table table-bordered">
        <thead>
          <tr>
            <td style="width:5px;padding:0px">Sr</td>
            <td style="width:10px;">Diseases</td>
            <td style="width:10px;">Sex</td>
            <td style="width:10px;">0-14 yrs</td>
            <td style="width:10px;">15-24 yrs</td>
            <td style="width:10px;">25 yrs and above</td>
          </tr>
        </thead>
        <tbody>
          <!-- G1 section -->
          <tr class="table-success">
            <td>Genital Ulcer Diseases (GUDs) 1.</td>
            <td>Syphilis (a) Primary</td>
            <td>M</td>
            <td id="sy_14_m"></td>
            <td id="sy_24_m"></td>
            <td id="sy_25_m"></td>
          </tr>
          <tr class="table-success">
            <td colspan=""></td>
            <td></td>
            <td>F</td>
            <td id="sy_14_f"></td>
            <td id="sy_24_f"></td>
            <td id="sy_25_f"></td>
          </tr>
          <tr class="table-success">
            <td></td>
            <td>Syphilis (b) Secondary</td>
            <td>M</td>
            <td id="sec_14_m"></td>
            <td id="sec_24_m"></td>
            <td id="sec_25_m"></td>
          </tr>
          <tr class="table-success">
            <td></td>
            <td></td>
            <td>F</td>
            <td id="sec_14_f"></td>
            <td id="sec_24_f"></td>
            <td id="sec_25_f"></td>
          </tr>
          <tr class="table-success">
            <td>2</td>
            <td>Chancroid</td>
            <td>M</td>
            <td id="chan_14_m"></td>
            <td id="chan_24_m"></td>
            <td id="chan_25_m"></td>
          </tr>
          <tr class="table-success">
            <td></td>
            <td></td>
            <td>F</td>
            <td id="chan_14_f"></td>
            <td id="chan_24_f"></td>
            <td id="chan_25_f"></td>
          </tr>
          <tr class="table-success">
            <td>3</td>
            <td>Genital Herpes</td>
            <td>M</td>
            <td id="gherp_14_m"></td>
            <td id="gherp_24_m"></td>
            <td id="gherp_25_m"></td>
          </tr>
          <tr class="table-success">
            <td></td>
            <td></td>
            <td>F</td>
            <td id="gherp_14_f"></td>
            <td id="gherp_24_f"></td>
            <td id="gherp_25_f"></td>
          </tr>
          <tr class="table-success">
            <td>4</td>
            <td>Genital Scabies</td>
            <td>M</td>
            <td id="gscab_14_m"></td>
            <td id="gscab_24_m"></td>
            <td id="gscab_25_m"></td>
          </tr>
          <tr class="table-success">
            <td></td>
            <td></td>
            <td>F</td>
            <td id="gscab_14_f"></td>
            <td id="gscab_24_f"></td>
            <td id="gscab_25_f"></td>
          </tr>
          <tr class="table-success">
            <td>5</td>
            <td>Other</td>
            <td>M</td>
            <td id="oth_14_m"></td>
            <td id="oth_24_m"></td>
            <td id="oth_25_m"></td>
          </tr>
          <tr class="table-success">
            <td></td>
            <td></td>
            <td>F</td>
            <td id="oth_14_f"></td>
            <td id="oth_24_f"></td>
            <td id="oth_25_f"></td>
          </tr>
          <tr class="table-success">
            <td></td>
            <td>Total</td>
            <td>M</td>
            <td id="total_14_g1"></td>
            <td id="total_24_g1"></td>
            <td id="total_25_g1"></td>
          </tr>
          <tr class="table-success">
            <td></td>
            <td></td>
            <td>F</td>
            <td id="total_14_f_g1"></td>
            <td id="total_24_f_g1"></td>
            <td id="total_25_f_g1"></td>
          </tr>
          <!-- end          -->
          <!-- G2 section         -->

          <tr class="table-success">
            <td>Genital Discharge Diseases (GDDs) 1.</td>
            <td>Gonorrhea</td>
            <td>M</td>
            <td id="gono_14_m"></td>
            <td id="gono_24_m"></td>
            <td id="gono_25_m"></td>
          </tr>
          <tr class="table-success">
            <td></td>
            <td></td>
            <td>F</td>
            <td id="gono_14_f"></td>
            <td id="gono_24_f"></td>
            <td id="gono_25_f"></td>
          </tr>
          <tr class="table-success">
            <td>2</td>
            <td>Non Gonococcal urethritis/</td>
            <td>M</td>
            <td id="nonGono_ure_14_m"></td>
            <td id="nonGono_ure_24_m"></td>
            <td id="nonGono_ure_25_m"></td>
          </tr>
          <tr class="table-success">
            <td></td>
            <td>Non Gonococcal Cervicitis</td>
            <td>F</td>
            <td id="nonGono_ure_14_f"></td>
            <td id="nonGono_ure_24_f"></td>
            <td id="nonGono_ure_25_f"></td>
          </tr>
          <tr class="table-success">
            <td>3</td>
            <td>Trichomonas infection</td>
            <td>M</td>
            <td id="tricho_14_m"></td>
            <td id="tricho_24_m"></td>
            <td id="tricho_25_m"></td>
          </tr>
          <tr class="table-success">
            <td></td>
            <td></td>
            <td>F</td>
            <td id="tricho_14_f"></td>
            <td id="tricho_24_f"></td>
            <td id="tricho_25_f"></td>
          </tr>
          <tr class="table-success">
            <td>4</td>
            <td>Genital Candidiasis</td>
            <td>M</td>
            <td id="gen_can_14_m"></td>
            <td id="gen_can_24_m"></td>
            <td id="gen_can_25_m"></td>
          </tr>
          <tr class="table-success">
            <td></td>
            <td></td>
            <td>F</td>
            <td id="gen_can_14_f"></td>
            <td id="gen_can_24_f"></td>
            <td id="gen_can_25_f"></td>
          </tr>
          <tr class="table-success">
            <td>5</td>
            <td>Bacterial Vaginosis</td>
            <td>F</td>
            <td id="bac_14_f"></td>
            <td id="bac_24_f"></td>
            <td id="bac_25_f"></td>
          </tr>
          <tr class="table-success">
            <td></td>
            <td>Total</td>
            <td>M</td>
            <td id="g2_14_m"></td>
            <td id="g2_24_m"></td>
            <td id="g2_25_m"></td>
          </tr>
          <tr class="table-success">
            <td></td>
            <td></td>
            <td>F</td>
            <td id="g2_14_f"></td>
            <td id="g2_24_f"></td>
            <td id="g2_25_f"></td>
          </tr>

          <!-- end          -->
          <!-- G3          -->

          <tr class="table-success">
            <td>Other STDs 1.</td>
            <td>Congenital Syphilis</td>
            <td>M</td>
            <td id="con_syp_14_m"></td>
            <td id="con_syp_24_m"></td>
            <td id="con_syp_25_m"></td>
          </tr>
          <tr class="table-success">
            <td></td>
            <td></td>
            <td>F</td>
            <td id="con_syp_14_f"></td>
            <td id="con_syp_24_f"></td>
            <td id="con_syp_25_f"></td>
          </tr>
          <tr class="table-success">
            <td>2</td>
            <td>Latent Syphilis</td>
            <td>M</td>
            <td id="lat_sy_14_m"></td>
            <td id="lat_sy_24_m"></td>
            <td id="lat_sy_25_m"></td>
          </tr>
          <tr class="table-success">
            <td></td>
            <td></td>
            <td>F</td>
            <td id="lat_sy_14_f"></td>
            <td id="lat_sy_24_f"></td>
            <td id="lat_sy_25_f"></td>
          </tr>
          <tr class="table-success">
            <td>3</td>
            <td>Latent Syphilis (Pregnancy)</td>
            <td>M</td>
            <td id="lat_sy_pre_14_m"></td>
            <td id="lat_sy_pre_24_m"></td>
            <td id="lat_sy_pre_25_m"></td>
          </tr>
          <tr class="table-success">
            <td></td>
            <td></td>
            <td>F</td>
            <td id="lat_sy_pre_14_f"></td>
            <td id="lat_sy_pre_24_f"></td>
            <td id="lat_sy_pre_25_f"></td>
          </tr>
          <tr class="table-success">
            <td>4</td>
            <td>Molluscum Contagiosum</td>
            <td>M</td>
            <td id="mol_con_14_m"></td>
            <td id="mol_con_24_m"></td>
            <td id="mol_con_25_m"></td>
          </tr>
          <tr class="table-success">
            <td></td>
            <td></td>
            <td>F</td>
            <td id="mol_con_14_f"></td>
            <td id="mol_con_24_f"></td>
            <td id="mol_con_25_f"></td>
          </tr>
          <tr class="table-success">
            <td>5</td>
            <td>Bubos</td>
            <td>M</td>
            <td id="bub_14_m"></td>
            <td id="bub_24_m"></td>
            <td id="bub_25_m"></td>
          </tr>
          <tr class="table-success">
            <td></td>
            <td></td>
            <td>F</td>
            <td id="bub_14_f"></td>
            <td id="bub_24_f"></td>
            <td id="bub_25_f"></td>
          </tr>
          <tr class="table-success">
            <td>6</td>
            <td>Genital Warts</td>
            <td>M</td>
            <td id="gen_wet_14_m"></td>
            <td id="gen_wet_24_m"></td>
            <td id="gen_wet_25_m"></td>
          </tr>
          <tr class="table-success">
            <td></td>
            <td></td>
            <td>F</td>
            <td id="gen_wet_14_f"></td>
            <td id="gen_wet_24_f"></td>
            <td id="gen_wet25_f"></td>
          </tr>
          <tr class="table-success">
            <td>7</td>
            <td>Others</td>
            <td>M</td>
            <td id="otho_14_m"></td>
            <td id="otho_24_m"></td>
            <td id="otho_25_m"></td>
          </tr>
          <tr class="table-success">
            <td></td>
            <td></td>
            <td>F</td>
            <td id="otho_14_f"></td>
            <td id="otho_24_f"></td>
            <td id="otho_25_f"></td>
          </tr>
          <tr class="table-success">
            <td></td>
            <td>Total</td>
            <td>M</td>
            <td id="g3_14_m"></td>
            <td id="g3_24_m"></td>
            <td id="g3_25_m"></td>
          </tr>
          <tr class="table-success">
            <td></td>
            <td></td>
            <td>F</td>
            <td id="g3_14_f"></td>
            <td id="g3_24_f"></td>
            <td id="g3_25_f"></td>
          </tr>
          <!-- end          -->
        </tbody>
      </table>
    </div>
      </div>
    </div>
    <div class="row" style="margin: auto;">
      <div class="col-sm-10"style="margin: auto;">
        <div class="col-sm-10">
          Syphillis Testing
        </div>
        <div class="" id="rpr_results">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th></th>
            <th>1. Clients</th>
            <th>Sex</th>
            <th colspan="2">0-14 yrs</th>
            <th colspan="2">15-24 yrs</th>
            <th colspan="2">25-yrs and above</th>

          </tr>
          <tr>
            <th></th>
            <th></th>
            <th></th>
            <th>Test</th>
            <th>Result</th>
            <th>Test</th>
            <th>Result</th>
            <th>Test</th>
            <th>Result</th>
          </tr>
        </thead>
        <tbody>
          <tr class="table-success">
            <td>(iii)</td>
            <td>MSM</td>
            <td>M</td>
            <td id="msm_test_14"></td>
            <td id="msm_result_14"></td>
            <td id="msm_test_24"></td>
            <td id="msm_result_24"></td>
            <td id="msm_test_25"></td>
            <td id="msm_result_25"></td>
          </tr>
          <tr class="table-success">
            <td>(iv)</td>
            <td>TGW</td>
            <td>M</td>
            <td id="tg_test_14"></td>
            <td id="tg_result_14"></td>
            <td id="tg_test_24"></td>
            <td id="tg_result_24"></td>
            <td id="tg_test_25"></td>
            <td id="tg_result_25"></td>
          </tr>
          <tr class="table-success">
            <td>(v)</td>
            <td>PWID</td>
            <td>M</td>
            <td id="idu_test_14"></td>
            <td id="idu_result_14"></td>
            <td id="idu_test_24"></td>
            <td id="idu_result_24"></td>
            <td id="idu_test_25"></td>
            <td id="idu_result_25"></td>
          </tr>
        </tbody>
      </table>
    </div>
      </div>
    </div>

    <br>
    <div class="row">
      <div id="toshowHead"></div>
      <div id="toshow"></div>
    </div>
    <br>


</div>
@endauth
@endsection
  <script type="text/javascript">

  function calculate(){
    var clinic = document.getElementById("clinic").value;
    var range = document.getElementById("range").value;
    var month = document.getElementById("month").value;
    var year = document.getElementById("year").value;
    let calculate = 1;
      $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                 }
     });
     $.ajax({
          type:'POST',
          url:"{{route('sticalculate')}}",
          //dataType:'json',
          //processData:false,
          //contentType: 'application/json',
          data:{
                calculate:calculate,
                clinic:clinic,
                range:range,
                month:month,
                year:year
              },
          //data: rprDataset,
          success:function(response){

                $('#monthlyTable').show();

                $('#att_m').empty();
                $('#att_f').empty();
                $('#att_t').empty();

                $('#epi_m').empty();
                $('#epi_f').empty();
                $('#epi_t').empty();

                $('#g1_m').empty();
                $('#g1_f').empty();
                $('#g1_t').empty();
                console.log(response);
                document.getElementById('att_m').innerHTML=response[0];
                document.getElementById('att_f').innerHTML=response[1];
                document.getElementById('att_t').innerHTML=response[0]+response[1];

                document.getElementById('sy_14_m').innerHTML=response[2];
                document.getElementById('sy_14_f').innerHTML=response[3];
                document.getElementById('sy_24_m').innerHTML=response[4];
                document.getElementById('sy_24_f').innerHTML=response[5];
                document.getElementById('sy_25_m').innerHTML=response[6];
                document.getElementById('sy_25_f').innerHTML=response[7];

                document.getElementById('sec_14_m').innerHTML=response[8];
                document.getElementById('sec_14_f').innerHTML=response[9];
                document.getElementById('sec_24_m').innerHTML=response[10];
                document.getElementById('sec_24_f').innerHTML=response[11];
                document.getElementById('sec_25_m').innerHTML=response[12];
                document.getElementById('sec_25_f').innerHTML=response[13];

                document.getElementById('chan_14_m').innerHTML=response[14];
                document.getElementById('chan_14_f').innerHTML=response[15];
                document.getElementById('chan_24_m').innerHTML=response[16];
                document.getElementById('chan_24_f').innerHTML=response[17];
                document.getElementById('chan_25_m').innerHTML=response[18];
                document.getElementById('chan_25_f').innerHTML=response[19];

                document.getElementById('gherp_14_m').innerHTML=response[20];
                document.getElementById('gherp_14_f').innerHTML=response[21];
                document.getElementById('gherp_24_m').innerHTML=response[22];
                document.getElementById('gherp_24_f').innerHTML=response[23];
                document.getElementById('gherp_25_m').innerHTML=response[24];
                document.getElementById('gherp_25_f').innerHTML=response[25];

                document.getElementById('gscab_14_m').innerHTML=response[26];
                document.getElementById('gscab_14_f').innerHTML=response[27];
                document.getElementById('gscab_24_m').innerHTML=response[28];
                document.getElementById('gscab_24_f').innerHTML=response[29];
                document.getElementById('gscab_25_m').innerHTML=response[30];
                document.getElementById('gscab_25_f').innerHTML=response[31];

                document.getElementById('oth_14_m').innerHTML=response[32];
                document.getElementById('oth_14_f').innerHTML=response[33];
                document.getElementById('oth_24_m').innerHTML=response[34];
                document.getElementById('oth_24_f').innerHTML=response[35];
                document.getElementById('oth_25_m').innerHTML=response[36];
                document.getElementById('oth_25_f').innerHTML=response[37];
                var g1_14_m =response[2]+ response[8]+ response[14]+response[20]+response[26]+response[32];
                document.getElementById('total_14_g1').innerHTML=g1_14_m;
                var g1_14_f =response[3]+ response[9]+ response[15]+response[21]+response[27]+response[33];
                document.getElementById('total_14_f_g1').innerHTML=g1_14_f;
                var g1_24_m =response[4]+ response[10]+ response[16]+response[22]+response[28]+response[34];
                document.getElementById('total_24_g1').innerHTML=g1_24_m;
                var g1_24_f =response[5]+ response[11]+ response[17]+response[23]+response[29]+response[35];
                document.getElementById('total_24_f_g1').innerHTML=g1_24_f;
                var g1_25_m =response[6]+ response[12]+ response[18]+response[24]+response[30]+response[36];
                document.getElementById('total_25_g1').innerHTML=g1_25_m;
                var g1_25_f =response[7]+ response[13]+ response[19]+response[25]+response[31]+response[37];
                document.getElementById('total_25_f_g1').innerHTML=g1_25_f;

                var g1_male_total=g1_14_m + g1_24_m + g1_25_m;
                document.getElementById('g1_m').innerHTML= g1_male_total;
                var g1_female_total = g1_14_f + g1_24_f + g1_25_f;
                document.getElementById('g1_f').innerHTML= g1_female_total;
                var g1_grandtotal= g1_male_total + g1_female_total;
                document.getElementById('g1_t').innerHTML= g1_grandtotal;
                //G2
                document.getElementById("gono_14_m").innerHTML=response[38];
                document.getElementById("gono_14_f").innerHTML=response[39];
                document.getElementById("gono_24_m").innerHTML=response[40];
                document.getElementById("gono_24_f").innerHTML=response[41];
                document.getElementById("gono_25_m").innerHTML=response[42];
                document.getElementById("gono_25_f").innerHTML=response[43];

                document.getElementById("nonGono_ure_14_m").innerHTML=response[44];
                document.getElementById("nonGono_ure_14_f").innerHTML=response[45];
                document.getElementById("nonGono_ure_24_m").innerHTML=response[46];
                document.getElementById("nonGono_ure_24_f").innerHTML=response[47];
                document.getElementById("nonGono_ure_25_m").innerHTML=response[48];
                document.getElementById("nonGono_ure_25_f").innerHTML=response[49];

                document.getElementById("tricho_14_m").innerHTML=response[50];
                document.getElementById("tricho_14_f").innerHTML=response[51];
                document.getElementById("tricho_24_m").innerHTML=response[52];
                document.getElementById("tricho_24_f").innerHTML=response[53];
                document.getElementById("tricho_25_m").innerHTML=response[54];
                document.getElementById("tricho_25_f").innerHTML=response[55];

                document.getElementById("gen_can_14_m").innerHTML=response[56];
                document.getElementById("gen_can_14_f").innerHTML=response[57];
                document.getElementById("gen_can_24_m").innerHTML=response[58];
                document.getElementById("gen_can_24_f").innerHTML=response[59];
                document.getElementById("gen_can_25_m").innerHTML=response[60];
                document.getElementById("gen_can_25_f").innerHTML=response[61];

                document.getElementById("bac_14_f").innerHTML=response[62];
                document.getElementById("bac_24_f").innerHTML=response[63];
                document.getElementById("bac_25_f").innerHTML=response[64];

                var g2_14_m=response[38]+response[44]+response[50]+response[56];
                document.getElementById('g2_14_m').innerHTML= g2_14_m;
                var g2_14_f=response[39]+response[45]+response[51]+response[57]+response[62];
                document.getElementById('g2_14_f').innerHTML= g2_14_f;
                var g2_24_m=response[40]+response[46]+response[52]+response[58];
                document.getElementById('g2_24_m').innerHTML= g2_24_m;
                var g2_24_f =response[41]+response[47]+response[53]+response[59]+response[63];
                document.getElementById('g2_24_f').innerHTML= g2_24_f;
                var g2_25_m =response[42]+response[48]+response[54]+response[60];
                document.getElementById('g2_25_m').innerHTML= g2_25_m;
                var g2_25_f =response[43]+response[49]+response[55]+response[61]+response[64];
                document.getElementById('g2_25_f').innerHTML= g2_25_f;
                // g2 Total //
                var g2_m= g2_14_m + g2_24_m + g2_25_m;
                document.getElementById('g2_m').innerHTML= g2_m;
                var g2_f= g2_14_f + g2_24_f + g2_25_f;
                document.getElementById('g2_f').innerHTML= g2_f;
                var g2_t= g2_m +  g2_f ;
                document.getElementById('g2_t').innerHTML= g2_t;

                //G3
                document.getElementById('con_syp_14_m').innerHTML=response[65];
                document.getElementById('con_syp_14_f').innerHTML=response[66];
                document.getElementById('con_syp_24_m').innerHTML=response[67];
                document.getElementById('con_syp_24_f').innerHTML=response[68];
                document.getElementById('con_syp_25_m').innerHTML=response[69];
                document.getElementById('con_syp_25_f').innerHTML=response[70];

                document.getElementById('lat_sy_14_m').innerHTML=response[71];
                document.getElementById('lat_sy_14_f').innerHTML=response[72];
                document.getElementById('lat_sy_24_m').innerHTML=response[73];
                document.getElementById('lat_sy_24_f').innerHTML=response[74];
                document.getElementById('lat_sy_25_m').innerHTML=response[75];
                document.getElementById('lat_sy_25_f').innerHTML=response[76];

                document.getElementById('lat_sy_pre_14_m').innerHTML=response[77];
                document.getElementById('lat_sy_pre_14_f').innerHTML=response[78];
                document.getElementById('lat_sy_pre_24_m').innerHTML=response[79];
                document.getElementById('lat_sy_pre_24_f').innerHTML=response[80];
                document.getElementById('lat_sy_pre_25_m').innerHTML=response[81];
                document.getElementById('lat_sy_pre_25_f').innerHTML=response[82];

                document.getElementById('mol_con_14_m').innerHTML=response[83];
                document.getElementById('mol_con_14_f').innerHTML=response[84];
                document.getElementById('mol_con_24_m').innerHTML=response[85];
                document.getElementById('mol_con_24_f').innerHTML=response[86];
                document.getElementById('mol_con_25_m').innerHTML=response[87];
                document.getElementById('mol_con_25_f').innerHTML=response[88];

                document.getElementById('bub_14_m').innerHTML=response[89];
                document.getElementById('bub_14_f').innerHTML=response[90];
                document.getElementById('bub_24_m').innerHTML=response[91];
                document.getElementById('bub_24_f').innerHTML=response[92];
                document.getElementById('bub_25_m').innerHTML=response[93];
                document.getElementById('bub_25_f').innerHTML=response[94];

                document.getElementById('gen_wet_14_m').innerHTML=response[95];
                document.getElementById('gen_wet_14_f').innerHTML=response[96];
                document.getElementById('gen_wet_24_m').innerHTML=response[97];
                document.getElementById('gen_wet_24_f').innerHTML=response[98];
                document.getElementById('gen_wet_25_m').innerHTML=response[99];
                document.getElementById('gen_wet25_f').innerHTML=response[100];

                document.getElementById('otho_14_m').innerHTML=response[101];
                document.getElementById('otho_14_f').innerHTML=response[102];
                document.getElementById('otho_24_m').innerHTML=response[103];
                document.getElementById('otho_24_f').innerHTML=response[104];
                document.getElementById('otho_25_m').innerHTML=response[105];
                document.getElementById('otho_25_f').innerHTML=response[106];

                var g3_14_m=response[65]+response[71]+response[77]+response[83]+response[89]+response[95]+response[101];
                document.getElementById('g3_14_m').innerHTML= g3_14_m;
                var g3_14_f=response[66]+response[72]+response[78]+response[84]+response[90]+response[96]+response[102];
                document.getElementById('g3_14_f').innerHTML= g3_14_f;
                var g3_24_m=response[67]+response[73]+response[79]+response[85]+response[91]+response[97]+response[103];
                document.getElementById('g3_24_m').innerHTML= g3_24_m;
                var g3_24_f =response[68]+response[74]+response[80]+response[86]+response[92]+response[98]+response[104];
                document.getElementById('g3_24_f').innerHTML= g3_24_f;
                var g3_25_m =response[69]+response[75]+response[81]+response[87]+response[93]+response[99]+response[105];
                document.getElementById('g3_25_m').innerHTML= g3_25_m;
                var g3_25_f =response[70]+response[76]+response[82]+response[88]+response[94]+response[100]+response[106];
                document.getElementById('g3_25_f').innerHTML= g3_25_f;
                // G3 Total //
                var g3_m= g3_14_m + g3_24_m + g3_25_m;
                document.getElementById('g3_m').innerHTML= g3_m;
                var g3_f= g3_14_f + g3_24_f + g3_25_f;
                document.getElementById('g3_f').innerHTML= g3_f;
                var g3_t= g3_m + g3_f ;
                document.getElementById('g3_t').innerHTML= g3_t;

                var epi_m = g1_male_total + g2_m + g3_m ;
                var epi_f = g1_female_total + g2_f + g3_f ;
                var epi_t = epi_m + epi_f ;

                document.getElementById('epi_m').innerHTML= epi_m;
                document.getElementById('epi_f').innerHTML= epi_f;
                document.getElementById('epi_t').innerHTML= epi_t;

                //RPR  results
                document.getElementById('msm_test_14').innerHTML=response[107];
                document.getElementById('msm_result_14').innerHTML=response[108];
                document.getElementById('msm_test_24').innerHTML=response[109];
                document.getElementById('msm_result_24').innerHTML=response[110];
                document.getElementById('msm_test_25').innerHTML=response[111];
                document.getElementById('msm_result_25').innerHTML=response[112];

                document.getElementById('tg_test_14').innerHTML=response[113];
                document.getElementById('tg_result_14').innerHTML=response[114];
                document.getElementById('tg_test_24').innerHTML=response[115];
                document.getElementById('tg_result_24').innerHTML=response[116];
                document.getElementById('tg_test_25').innerHTML=response[117];
                document.getElementById('tg_result_25').innerHTML=response[118];

                document.getElementById('idu_test_14').innerHTML=response[119];
                document.getElementById('idu_result_14').innerHTML=response[120];
                document.getElementById('idu_test_24').innerHTML=response[121];
                document.getElementById('idu_result_24').innerHTML=response[122];
                document.getElementById('idu_test_25').innerHTML=response[123];
                document.getElementById('idu_result_25').innerHTML=response[124];

                var msm_test_total    = response[107]+response[109]+response[111];
                var tg_test_total     = response[113]+response[115]+response[117];
                var msm_result_total  = response[108]+response[110]+response[112];
                var tg_result_total   = response[114]+response[116]+response[118];
                var idu_test_total    = response[119]+response[121]+response[123];
                var idu_result_total  = response[120]+response[122]+response[124];

                var msm_P_percent     = parseInt((msm_result_total/msm_test_total)*100);
                var tg_P_percent      = parseInt((tg_result_total/tg_test_total)*100);
                var idu_P_percent      = (idu_result_total/idu_test_total)*100;

                /// For Chart
                const chart0 = new Chart('myChart', {
                                              type: 'doughnut',
                                              data: {
                                                        labels: [
                                                                'Genital ulcers',
                                                                'Genito-urinary discharge',
                                                                'other STI'
                                                                ],
                                              datasets: [{
                                                          label: 'My First Dataset',
                                                          data: [g1_male_total, g2_m, g3_m],
                                                          backgroundColor: [
                                                            'rgb(191, 54, 43)',
                                                            'rgb(204, 161, 54)',
                                                            'rgb(10,125,140)'
                                                                            ],

                                                                          }]
                                                                      },
                                                            options: {
                                                                plugins: {
                                                                    title: {
                                                                        display: true,
                                                                        text: 'Episodes'
                                                                    }
                                                                }
                                                            }
                                      });


                                ////////////////////////////// kjlsdjfisaofjsdiafjs;ad
                                const data = {
                                              labels: [
                                                'MSM',
                                                'TGW',
                                                'PWID',
                                              ],
                                              datasets: [{
                                                type: 'bar',
                                                label: 'Tests',
                                                data: [msm_test_total,tg_test_total,idu_test_total],
                                                borderColor: 'rgb(255, 99, 132)',
                                                backgroundColor: 'rgba(84, 61, 56,0.2)'
                                              }, {
                                                type: 'line',
                                                label: 'Results',
                                                data: [msm_result_total,tg_result_total,idu_result_total],
                                                fill: false,
                                                borderColor: 'rgb(171, 38, 79)',
                                              }]
                                            };

                                const config = {
                                                    type: 'bar',
                                                    data,
                                                    options: {
                                                      plugins: {
                                                              title: {
                                                                  display: true,
                                                                  text: 'Syphillis Testing',
                                                              }
                                                          },
                                                      scales: {
                                                        y: {
                                                          beginAtZero: true
                                                        }
                                                      },
                                                      scaleId:{
                                                        text:''
                                                      }
                                                      
                                                    }
                                                };

                                const mixedChart = new Chart('myChart2',
                                                    config
                                );






































































                                        //////////////////////////////////////////////////////////////



                            }









       });

}
</script>

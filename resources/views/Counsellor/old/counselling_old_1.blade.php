@extends('layouts.app')



@section('content')
@auth
<div class="container">
    <ul class="nav nav-tabs" id="" >
      <li class="nav-item">
        <a class="nav-link active " data-toggle="tab" href="#first" onclick="">General Data</a>
      </li>
      <li class="nav-item">
        <a class="nav-link  " data-toggle="tab" href="#second" onclick="">HTS Report</a>
      </li>
      <li class="nav-item">
        <a class="nav-link  " data-toggle="tab" href="#third" onclick="">Lab's Results</a>
      </li>
    </ul>
    <div class="tab-content">
      <div class="tab-pane container active" id="first">
        <div style="margin:auto" id="toshowResult"></div>
        <div id="hider0" class="container" style="background:#E1F5C4">
        <br>
        <!--   <form class="" id="reg" method="post" > -->
        @csrf
        <div class="row justify-content-center">
          <div class="col-md-12 "  >
              <h3 class='header-text' style="text-align: center;">Counselling Room</h3>
          </div>
        </div><br><br>
              <div class="row">
                <div class="col-md-2">
                  <input  type="text" class="form-control" autofocus id="gid" placeholder="General ID or Fuchia ID" >
                </div>
                <div class="col-md-1">
                  <button  class="btn btn-warning" onclick="ptData()">Search</button>
                </div>

                <div class="col-md-6">
                  <label style="color:red;" class='form-control' id="responseText"> Response Box</label>
                </div>
                <div class="col-sm-2">

                </div>
                <div class="col-md-1">
                  <button  class="btn btn-success" onclick="refresh()">Refresh</button>
                </div>

              </div><br>
              <br>
              <div class="row">
                <div class="col-sm-12">
                  <label id="gen_data"class="form-control"></label>
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-md-2">
                  <select class="form-select" id="counsellor" required>
                    <option value="col_1">Counsellor 1</option>
                    <option value="col_2">Counsellor 2</option>
                    <option value="col_3">Counsellor 3</option>
                    <option value="col_4">Counsellor 4</option>
                    <option value="col_5">Counsellor 5</option>
                  </select>
                </div>
                <div class="col-sm-3">
                  <div class="input-group mb-2">
                    <div class="input-group-prepend">
                      <span class="input-group-text">Counselling Date</span>
                    </div>
                    <input type="date"  id="vDate"  class="form-control" required>
                  </div>
                </div>
                <div class="col-md-2">
                  <input type="checkbox" id="pre"  > <span style='color: blue;' >Pre-test Counselling</span>     <br>
                  <input type="checkbox" id="post"   > <span style='color: red;'>Post-test Counselling</span>
                </div>
                <div class="col-sm-2">
                  <div>
                  <select class="form-control" id="Ptype" onchange="PatientType()" >
                    <option selected disabled value="">Main Risk</option>
                    <option id="preg_mom" value="Pregnant Mother">Pregnant Mother</option>
                    <option id="sp_preg_mom" value="Spouse of pregnant mother">Spouse of pregnant mother</option>
                    <option id="" value="Exposed Children">Exposed Children</option>
                    <option id="" value="Low Risk">Low Risk</option>
                    <option id="" value="PWUD">PWUD</option>
                    <option id="fsw" value="FSW">FSW</option>
                    <option id="cl_fsw" value="Client of FSW">Client of FSW</option>
                    <option id="msm" value="MSM">MSM</option>
                    <option id="" value="IDU">IDU</option>
                    <option id="tg" value="TG">TG</option>
                    <option id="pt_kp" value="Partner of KP">Partner of KP</option>
                    <option id="pt_kp_plhiv" value="Partner of PLHIV">Partner of PLHIV</option>
                    <option id="" value="Special Groups">Special Groups</option>
                    <option value="Migrant Population">Migrant Population</option>
                  </select>
                </div>
                </div>
                <div class="col-sm-2" >
                  <div>
                    <select class="form-control" id="tt_sub"  >
                    <option selected disabled value="">Sub Risk</option>
                    <option value="PP">PP</option>
                    <option value="MP">MP</option>
                    <option value="HIV(Pos)">HIV(Pos)</option>
                    <option value="HIV(Neg)Woman">HIV(Neg)Woman</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="Youth(15-24)">Youth(15-24)</option>
                    <option value="Other Low Risk">Other Low Risk</option>
                    <option value="FSW_PWID">FSW_PWID</option>
                    <option value="FSW_PWUD">FSW_PWUD</option>
                    <option value="MSM_PWID">MSM_PWID</option>
                    <option value="MSM_PWUD">MSM_PWUD</option>
                    <option value="PWID_FSW">PWID_FSW</option>
                    <option value="PWID_MSM">PWID_MSM</option>
                    <option value="TG_PWID">TG_PWID</option>
                    <option value="TG_PWUD">TG_PWUD</option>
                    <option value="TG_SW">TG_SW</option>
                    <option value="Partner of PWID">Partner of PWID</option>
                    <option value="Partner of FSW">Partner of FSW</option>
                    <option value="Female of MSM">Female of MSM</option>
                    <option value="TB Patient">TB Patient</option>
                    <option value="Institutionalize">Institutionalize</option>
                    <option value="Uniformed Services Personnel">Uniformed Services Personnel</option>
                  </select>
                  </div>
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-sm-2 reception-region">
                  <div>
                    <select  class="form-select reception-select"  id="state"  required onchange="region(this.value)">
                      <option selected disabled value="">State/Region</option>
                      <option value="Ayeyarwady">Ayeyarwady</option>
                      <option value="Bago(East)">Bago(East)</option>
                      <option value="Bago(West)">Bago(West)</option>
                      <option value="Chin">Chin</option>
                      <option value="Kachin">Kachin</option>
                      <option value="Kayah">Kayah</option>
                      <option value="Kayin">Kayin</option>
                      <option value="Mgway">Mgway</option>
                      <option value="Mandalay">Mandalay</option>
                      <option value="Mon">Mon</option>
                      <option value="NaypyiTaw">NaypyiTaw</option>
                      <option value="Rakhine">Rakhine</option>
                      <option value="Sagaing">Sagaing</option>
                      <option value="Shan(East)">Shan(East)</option>
                      <option value="Shan(North)">Shan(North)</option>
                      <option value="Shan(South)">Shan(South)</option>
                      <option value="Tanintharyi">Tanintharyi</option>
                      <option value="Yangon">Yangon</option>
                    </select>
                  </div>
                </div>
                <div class="col-sm-2 reception-township" >
                  <div>
                    <select class="form-select reception-select" id="township"  >
                      <option id="tt_opt"></option>
                      <option selected disabled value="">Township</option>
                      <option value="Insein">Insein</option><option value="MingalarDon" >MingalarDon</option><option value= "Hmawbi">Hmawbi</option>
                      <option value="Hlegu">Hlegu</option><option value="Taikkyi" >Taikkyi</option><option value="Htantabin" >Htantabin</option>
                      <option value="Shwepyithar">Shwepyithar</option><option value= "Hlaingtharya">Hlaingtharya</option><option value="Thingangyun" >Thingangyun</option>
                      <option value= "Yankin">Yankin</option><option value= "South Okkalapa">South Okkalapa</option><option value= "North Okkalapa">North Okkalapa</option>
                      <option value= "Thaketa">Thaketa</option><option value="Dawbon">Dawbon</option><option value="Tamwe" >Tamwe</option>
                      <option value= "Pazundaung">Pazundaung</option><option value= "Botahtaung">Botahtaung</option><option value="Dagon Myothit (South)" >Dagon Myothit (South)</option>
                      <option value= "Dagon Myothit (North)">Dagon Myothit (North)</option><option value="Dagon Myothit (East)">Dagon Myothit (East)</option>
                      <option value= "Dagon Myothit (Seikkan)">Dagon Myothit (Seikkan)</option><option value= "Mingalartaungnyunt">Mingalartaungnyunt</option>
                      <option value= "Thanlyin">Thanlyin</option><option value= "Kyauktan">Kyauktan</option><option value= "Thongwa">Thongwa</option>
                      <option value= "Kayan">Kayan</option><option value= "Twantay">Twantay</option><option value= "Kawhmu">Kawhmu</option>
                      <option value= "Kungyangon">Kungyangon</option><option value= "Dala">Dala</option><option value= "Seikgyikanaungto">Seikgyikanaungto</option>
                      <option value= "Cocokyun">Cocokyun</option><option value= "Kyauktada">Kyauktada</option><option value= "Pabedan">Pabedan</option>
                      <option value= "Lanmadaw">Lanmadaw</option><option value="Latha" >Latha</option><option value= "Ahlone">Ahlone</option>
                      <option value= "Kyeemyindaing">Kyeemyindaing</option><option value="Sanchaung" >Sanchaung</option><option value= "Hlaing">Hlaing</option>
                      <option value= "Kamaryut">Kamaryut</option><option value= "Mayangone">Mayangone</option><option value= "Dagon">Dagon</option>
                      <option value= "Bahan">Bahan</option><option value= "Seikkan">Seikkan</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-2">
                  <input type="text" id="quarter" placeholder="Ward or Village" class="form-control" required>
                </div>
                <div class="col-sm-2" >
                  <div>
                    <input id="phone" class="form-control" placeholder="Phone No.1" type="text" name="" placeholder="09123459789">
                  </div>
                </div>
                <div class="col-sm-2" >
                  <div>
                    <input id="phone2" class="form-control" placeholder="Phone No.2" type="text" name="" placeholder="09123459789">
                  </div>
                </div>
                <div class="col-sm-2" >
                  <div>
                    <input id="phone3" class="form-control"placeholder="Phone No.3" type="text" name="" placeholder="09123459789">
                  </div>
                </div>
              </div>
              <br>
              <div class="row"> <!--service -->
                <div class="col-md-2">
                  <select class="form-select"onchange="Service_Modality()" id="service"required>
                    <option selected disabled >Service Modality</option>
                    <option value="Community">Community</option>
                    <option value="Facility">Facility</option>
                  </select>
                </div>
                <div class="col-md-2">
                  <select class="form-select" id="m_o_entry"required>
                    <option selected disabled value="">Mode of Entry</option>
                    <option value="Index">Index</option>
                    <option value="SNS">SNS</option>
                    <option value="TB">TB</option>
                    <option value="STI">STI</option>
                    <option value="HIV-ST">HIV-ST</option>
                    <option value="VCT">VCT</option>

                    <option value="Moble/CBS">Mobile/CBS</option>
                    <option value="SNS">SNS</option>
                    <option value="Index">Index</option>
                    <option value="HIV-ST">HIV-ST</option>
                  </select>
                </div>
                <div class="col-md-2">
                  <select class="form-select" id="new_old"required>
                    <option selected disabled value="">New/Old(Within the Calendar Year)</option>
                    <option value="New">New</option>
                    <option value="Old">Old</option>
                  </select>
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-sm-5"><!--HIV -->
                  <div class="row">
                    <label >HIV Test Results</label>
                    <div class="input-group mb-2">
                      <div class="input-group-prepend">
                        <span class="input-group-text">Date</span>
                      </div>
                      <input type="date"  id="hiv_test_date"  class="form-control" required>
                      <div class="input-group-prepend">
                        <button onclick="hiv_test_date()" class="input-group-text">Fetch</button>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-3">
                      <label>Determine</label>
                      <select onchange="determineResult()" class="form-control"id="d_result" name="" >
                        <option value=""></option>
                        <option value="Reactive">Reactive</option>
                        <option value="Non Reactive">Non Reactive</option>
                        <option value="Invalid">Invalid</option>
                      </select>
                    </div>
                    <div class="col-md-3">
                      <label>Uni-Gold</label>
                      <select class="form-control" onchange="hiv_uni_result()" id="uni_result" name="" >
                        <option id="uni_bl" value=""></option>
                        <option value="Reactive">Reactive</option>
                        <option value="Non Reactive">Non Reactive</option>
                        <option value="Invalid">Invalid</option>
                      </select>
                    </div>
                    <div class="col-md-3">
                      <label>STAT-PAK</label>
                      <select class="form-control" onchange="hiv_result_cal()" id="stat_result" name="" >
                        <option id="stat_bl" value=""></option>
                        <option value="Reactive">Reactive</option>
                        <option value="Non Reactive">Non Reactive</option>
                        <option value="Invalid">Invalid</option>
                      </select>
                    </div>
                    <div class="col-md-3">
                      <label>Final Result</label>
                      <select class="form-control"id="final_result">
                        <option value=""></option>
                        <option id="pos" value="Positive">Positive</option>
                        <option id="neg" value="Negative">Negative</option>
                        <option id="incon" value="Inconclusive">Inconclusive</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="row">
                    <label>Syphillis Test Results</label>
                    <div class="input-group mb-2">
                      <div class="input-group-prepend">
                        <span class="input-group-text">Date</span>
                      </div>
                      <input type="date"  id="syp_date"  class="form-control" required>
                      <div class="input-group-prepend">
                        <button onclick="Rrp_test_date()" class="input-group-text">Fetch</button>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <label>RDT</label>
                      <select class="form-control" id="Sy_rdt_result"  >
                        <option value=""></option>
                        <option value="Positive">Positive</option>
                        <option value="Negative">Negative</option>
                      </select>
                    </div>
                    <div class="col-md-4">
                      <label>RPR</label>
                      <select onchange ='titre()'class="form-control" id="qualitative"  >
                        <option value=""></option>
                        <option value="R">Reactive</option>
                        <option value="NR">Non Reactive</option>
                      </select>
                    </div>
                    <div class="col-md-4">
                      <label>VDRL</label>
                      <label id="syp_vdrl"   class="form-control" ></label>
                    </div>
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="row">
                    <label>Hepatitis Test Results</label>
                    <div class="input-group mb-2">
                      <div class="input-group-prepend">
                        <span class="input-group-text">Date</span>
                      </div>
                      <input type="date"  id="hep_date"  class="form-control" required>
                      <div class="input-group-prepend">
                        <button onclick="hepB_test_date()" class="input-group-text">Fetch</button>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <label>B</label>
                      <select class="form-control" id="B_result"  >
                        <option value=""></option>
                        <option value="Positive">Positive</option>
                        <option value="Negative">Negative</option>
                      </select>
                    </div>
                    <div class="col-md-6">
                      <label>C</label>
                      <select class="form-control" id="C_result"  >
                        <option value=""></option>
                        <option value="Positive">Positive</option>
                        <option value="Negative">Negative</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <br>
              <div class='row' >
                <div class="col-sm-1" >
                  <button type="button" id="updateBton" onclick="update()" class="btn btn-warning">Save</button>
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-sm-2">

                </div>
                <div class="col-sm-2"></div>
                <div class="col-sm-2">

                </div>
                <div class="col-sm-2"></div>
                <div class="col-sm-2">
                </div>
              </div>
              <br>
        </div><br>
      </div>
      <div class="tab-pane container " id="second">
        <h1>Second</h1>
      </div>
      <div class="tab-pane container " id="third">
        <h1>Third</h1>
      </div>
    </div>
    </div>
</div>

@endauth
@endsection
<script type="text/javascript" language="javascript">
let Ptype_sub="";let pregMum=0;let spm=0;let epc=0; let lr =0;let fsw = 0; let msm= 0 ;let idu = 0;let pkp =0;let sg=0;let tg=0;
  let generatedID=0;
  let generatedID1=0;
  let genID=[];
  let ddDate=0;
  let service ='';
  let General_ID=0; let Fuchia_ID =0; let Gender=""; let Age=0;

function hiv_test_date(){
  hiv_test = 1;
  var gid =document.getElementById('gid').value;
  var hiv_test_date = document.getElementById("hiv_test_date").value;
  document.getElementById("syp_date").value=hiv_test_date;
  document.getElementById("hep_date").value=hiv_test_date;
  var  data={
         hiv_test       :hiv_test,
         gid            :gid,
         hiv_test_date  :hiv_test_date,
       };
  $.ajaxSetup({
     headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
     }
   });
      $.ajax({
           type:'POST',
           url:"{{route('counsellor_room')}}",
           dataType:'json',
         //  processData:false,
           contentType:'application/json',
           data: JSON.stringify(data),
           success:function(response){
              console.log(response);

              document.getElementById('d_result').value=response[0][0]["Detmine_Result"];
              document.getElementById('uni_result').value=response[0][0]["Unigold_Result"];
              document.getElementById('stat_result').value=response[0][0]["STAT_PAK_Result"];
              document.getElementById('final_result').value=response[0][0]["Final_Result"];
           }
        });
}
function hiv_result_cal(){
  var d_result = document.getElementById("d_result").value;
  var uni_result = document.getElementById("uni_result").value;
  var stat_result = document.getElementById("stat_result").value;
    if(d_result=="Reactive" && uni_result=="Reactive" && stat_result=="Reactive"){
      document.getElementById("pos").selected="true";
    }
    if(d_result=="Reactive"){
      if(uni_result=="Reactive" && stat_result=="Non Reactive"){
        document.getElementById("incon").selected="true";
      }
    }if(d_result=="Reactive"){
      if(uni_result=="Non Reactive" && stat_result=="Reactive"){
        document.getElementById("incon").selected="true";
      }
    }
    if(d_result=="Reactive"){
      if(uni_result=="Reactive" && stat_result=="Non Reactive"){
        document.getElementById("incon").selected="true";
      }
    }
    if(d_result=="Reactive"){
      if(uni_result=="Non Reactive" && stat_result=="Non Reactive"){
        document.getElementById("neg").selected="true";
      }
    }
    if( uni_result=="Invalid" || stat_result=="Invalid"){
      //document.getElementById('stat_result').disabled =true ;
      document.getElementById("incon").selected="true";
    }


}
function determineResult(){
    var result= document.getElementById('d_result').value;
    if(result == "Reactive"){
      document.getElementById('uni_result').disabled =false ;
      document.getElementById('stat_result').disabled =false ;
    }
    if(result == "Non Reactive"){
      document.getElementById("uni_bl").selected="true";
      document.getElementById("stat_bl").selected="true";
      document.getElementById('neg').selected =true ;
      document.getElementById('uni_result').disabled =true ;
      document.getElementById('stat_result').disabled =true ;
    }
    if(result == "Invalid"){
      document.getElementById("uni_bl").selected="true";
      document.getElementById("stat_bl").selected="true";
      document.getElementById('uni_result').disabled =true ;
      document.getElementById('stat_result').disabled =true ;
    }
}
function hiv_uni_result(){
  var uni_result = document.getElementById("uni_result").value;
  if(uni_result=="Non Reactive" || uni_result=="Invalid"){
    //document.getElementById('stat_result').disabled =true ;
    document.getElementById("incon").selected="true";
  }
}

function Rrp_test_date(){
  rpr_test = 1;
  var gid =document.getElementById('gid').value;
  var rpr_test_date = document.getElementById("syp_date").value;

  var  data={
         rpr_test       :rpr_test,
         gid            :gid,
         rpr_test_date  :rpr_test_date,
       };
  $.ajaxSetup({
     headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
     }
   });
      $.ajax({
           type:'POST',
           url:"{{route('counsellor_room')}}",
           dataType:'json',
         //  processData:false,
           contentType:'application/json',
           data: JSON.stringify(data),
           success:function(response){
              console.log(response);

              document.getElementById('Sy_rdt_result').value=response[0][0]["RDT Result"];
              document.getElementById('qualitative').value=response[0][0]["RPR Qualitative"];

           }
        });
}
function hepB_test_date(){
  hepB_test = 1;
  var gid =document.getElementById('gid').value;
  var hepB_test_date = document.getElementById("hep_date").value;

  var  data={
         hepB_test      :hepB_test,
         gid            :gid,
         hepB_test_date  :hepB_test_date,
       };
  $.ajaxSetup({
     headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
     }
   });
      $.ajax({
           type:'POST',
           url:"{{route('counsellor_room')}}",
           dataType:'json',
         //  processData:false,
           contentType:'application/json',
           data: JSON.stringify(data),
           success:function(response){
              console.log(response);

              document.getElementById('B_result').value=response[0][0]["HepB Result"]
              document.getElementById('C_result').value=response[0][0]["HepC Result"];

           }
        });
}
function ptData(){// to find patient data

  // For Date
  var date = new Date();
  var day = date.getDate();
  var month = date.getMonth() + 1;
  var year = date.getFullYear();
  if (month < 10) month = "0" + month;
  if (day < 10) day = "0" + day;
  var today = year + "-" + month + "-" + day;
  document.getElementById('vDate').value = today;
  document.getElementById('hiv_test_date').value = today;
  document.getElementById('syp_date').value = today;
  document.getElementById('hep_date').value = today;

  var gid =document.getElementById('gid').value;
  var c_code = 81;
  var gidLength = gid.length;


  document.getElementById('responseText').innerHTML="";

  let ckID = 1;
  var checkPatient = 1;
  var ckdata = {
                  gid:gid,
                  ckID:ckID,
                  year:year,
                };
  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
       }
     });
  $.ajax({
      type:'POST',
      url:"{{route('counsellor_room')}}",
      dataType:'json',
      contentType: 'application/json',
      data: JSON.stringify(ckdata),
      success:function(response){
        clearFacts();
         console.log(response);
          if(response[0]==null)
          {
            document.getElementById('responseText').innerHtML="";
            document.getElementById('responseText').innerHtML="There is no data.";

          }
          if (response[0] != null)
          {
              document.getElementById('responseText').innerHtML="";
              generatedID=response[0]['id'];
                     // For Age Calculation
                     var bd_date = response[9];// date of birth decrypted data
                     var dateSplited = bd_date.split("-");
                     var dtYear = dateSplited[0];
                     var dtMonth = dateSplited[1];
              if(dtYear == year)
                {
                  document.getElementById("agem").value= (month+1) - dtMonth;
                }else{
                       var Adate = new Date();
                       var Aday = Adate.getDate();
                       var Amonth = Adate.getMonth() + 1;
                       var Ayear = Adate.getFullYear();
                       var toshowYear = Ayear - Number(dtYear);
                       Age = toshowYear;// Global

                     }
                     General_ID = response[0]["Pid"];// Global
                     Fuchia_ID = response[0]["FuchiaID"];//Global
                     Gender = response[0]["Gender"];//Global
                     var Name = response[1];
                     var Region = response[2];
                     var Township = response[3];
                     var qut = response[4];
                     if(qut == ''){
                       document.getElementById("quarter").value='';
                     }else{
                       console.log("qut"+qut);
                       document.getElementById("quarter").value=qut;
                     }

                     if(Fuchia_ID == null){
                       Fuchia_ID = "____";
                     }
                     if(Gender == null){
                       Gender == "____";
                     }
                     if(Age == null){
                       Age = "____";
                     }
                     if(Region == null){
                       Region = '____';
                     }
                     if(Township == null){
                       Township = '____';
                     }

                  document.getElementById("gen_data").innerHTML =
                    "General ID :"+ response[0]['Pid']+",&nbsp;&nbsp;&nbsp;&nbsp;"+
                    "Fuchia ID :"+ Fuchia_ID +",&nbsp;&nbsp;&nbsp;&nbsp;"+
                    "Name :"+ response[1]+",&nbsp;&nbsp;&nbsp;&nbsp;"+
                    "Sex :"+ Gender +",&nbsp;&nbsp;&nbsp;&nbsp;"+
                    "Age :"+ Age +",&nbsp;&nbsp;&nbsp;&nbsp;"+
                    "Region :"+ Region +",&nbsp;&nbsp;&nbsp;&nbsp;"+
                    "Township :"+ Township;



                   document.getElementById("vDate").value=today;
                   document.getElementById("phone").value=response[5];
                   document.getElementById("phone2").value=response[6];
                   document.getElementById("phone3").value=response[7];
                   document.getElementById("Ptype").value=response[0]["Main Risk"];
                   document.getElementById("tt_sub").value=response[0]["Sub Risk"];
                   var new_old_ck = response[8];
                   if(new_old_ck == true){
                     document.getElementById("new_old").value="Old";
                   }else{
                     document.getElementById("new_old").value="New";
                     document.getElementById("new_old").style="color:red";
                   }

                   //document.getElementById("gid_1").disabled=true;
                   //document.getElementById("name").disabled=true;
                   //document.getElementById("father").disabled=true;
                   //document.getElementById("gender").disabled=true;
                   //document.getElementById("agey").disabled=true;
                   //document.getElementById("agem").disabled=true;
                   //document.getElementById("dob").disabled=true;
                   //document.getElementById("state").disabled=true;
                   //document.getElementById("tt").disabled=true;
                   //document.getElementById("fid").disabled=true;
                  // document.getElementById("vDate").disabled=true;

                 }
               }
         });


      //}else{
      //  clearFacts();
      //  document.getElementById('responseText').innerHTML="ID'length is  < 10";

      //  document.getElementById('updateBton').disabled=true;

    //  }
  }
function getAge(bd_date) {

      var dates = bd_date.split("-");
      var d = new Date();

      var useryear = dates[0];
      var usermonth = dates[1];
      var userday = dates[2];

      var curday = d.getDate();
      var realMonth = d.getMonth();
      var curmonth = d.getMonth()+1;
      var curyear = d.getFullYear();

      if(curyear == useryear){
        var age = realMonth - usermonth;
        console.log("month"+ age);
      }else{
        var age = curyear - useryear;
        console.log("age"+ age);
      }
      if((curmonth < usermonth) || ( (curmonth == usermonth) && curday < userday   )){
          age--;
      }

      return age;
  }

function update(){ // to update Data by Counsellor
  let update =1;
  let clinic_code = 81;
  // gid            :General_ID, Global Variables
  //fuchiaID       :Fuchia_ID,
  //gender         :Gender,
  //agey           :Age,
  var cdate = document.getElementById("vDate").value;
  var counsellor = document.getElementById("counsellor").value;

  var pre = document.getElementById("pre").checked;
  var post = document.getElementById("post").checked;

  if(pre == true){
    pre = "Yes";
  }else{
    pre = "No";
  }
  if(post == true){
    post = "Yes";
  }else{
    post = "No";
  }

  var state = document.getElementById("state").value;
  var township = document.getElementById("township").value;
  var quarter = document.getElementById("quarter").value;
  var phone = document.getElementById("phone").value;
  var phone2 = document.getElementById("phone2").value;
  var phone3 = document.getElementById("phone3").value;

  var Main_risk = document.getElementById("Ptype").value;
  var Sub_risk = document.getElementById("tt_sub").value;

  var service = document.getElementById("service").value;
  var mode_of_entry = document.getElementById("m_o_entry").value;
  var new_old = document.getElementById("new_old").value;

  var hiv_test_date = document.getElementById("hiv_test_date").value;
  var hiv_determine = document.getElementById("d_result").value;
  var hiv_unigold = document.getElementById("uni_result").value;
  var hiv_stat = document.getElementById("stat_result").value;
  var hiv_final = document.getElementById("final_result").value;

  var syp_date = document.getElementById("syp_date").value;
  var syp_rdt = document.getElementById("Sy_rdt_result").value;
  var syp_rpr = document.getElementById("qualitative").value;
  var syp_vdrl = document.getElementById("syp_vdrl").value;

  var hep_date = document.getElementById("hep_date").value;
  var hep_b = document.getElementById("B_result").value;
  var hep_c = document.getElementById("C_result").value;

  var  data={
         update         :update,
         clinic_code    :clinic_code,

         gid            :General_ID,
         fuchiaID       :Fuchia_ID,
         gender         :Gender,
         agey           :Age,

         cdate          :cdate,
         counsellor     :counsellor,
         pre            :pre,
         post           :post,

         state          :state,
         township       :township,
         quarter        :quarter,
         phone          :phone,
         phone2         :phone2,
         phone3         :phone3,

         Main_risk      :Main_risk,
         Sub_risk       :Sub_risk,
         service        :service,
         mode_of_entry  :mode_of_entry,
         new_old        :new_old,

         hiv_test_date  :hiv_test_date,
         hiv_determine  :hiv_determine,
         hiv_unigold    :hiv_unigold,
         hiv_stat       :hiv_stat,
         hiv_final      :hiv_final,

         syp_date       :syp_date,
         syp_rdt        :syp_rdt,
         syp_rpr        :syp_rpr,
         syp_vdrl       :syp_vdrl,
         hep_date       :hep_date,
         hep_b          :hep_b,
         hep_c          :hep_c,
       };
  $.ajaxSetup({
     headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
     }
   });
      $.ajax({
           type:'POST',
           url:"{{route('counsellor_room')}}",
           dataType:'json',
         //  processData:false,
           contentType:'application/json',
           data: JSON.stringify(data),
           success:function(response){
              console.log(response);
              console.log("This is I Wanted "+ response[1]);
              alert("Your data has been collected.");
                //alert("Your data has been collected.");
                location.reload(true);// to refresh the page
                document.getElementById('regbutton').disabled=false;
           }
        });
} // To Update Data // to update data // to update data

function region(){
  //to check state in Region option
  var state = document.getElementById("state").value;

    if(state == "Shan(East)"){//
        var Tcount = 15;
        const shan_e = [];
        shan_e[0] = "Kengtung"; shan_e[1] = "Mongkhet"; shan_e[2] = "Mongyang";
        shan_e[3] = "Mongla";  shan_e[4] = "Monghsat";  shan_e[5] = "Mongping";
        shan_e[6] = "Mongton"; shan_e[7] = "Tachileik";  shan_e[8] = "Monghpyak";
        shan_e[9] = "Mongyawng"; shan_e[10] = "Mong Hpen"; shan_e[11] = "Ho Tawng (Ho Tao)";
        shan_e[12] = "Mong Pawk"; shan_e[13] = "Mong Kar";  shan_e[14] = "Nam Hpai";

        // to clear option in select township
        var tt_inner = document.getElementById('tt');
        if(tt_inner.innerHTML!=null){
          tt_inner.innerHTML="";
        }
        // to show township
         for (var i = 0; i < Tcount; i++) {
           // get reference to select element
           var sel = document.getElementById('tt');
           // create new option element
           var opt = document.createElement("option");
           // create text node to add to option element (opt)
           opt.appendChild( document.createTextNode(shan_e[i]) );
           // set value property of opt
           opt.value = shan_e[i];
           // add opt to end of select box (sel)
           sel.appendChild(opt);
         }
       }
    if(state == "Sagaing"){//
      var Tcount = 34;
      const sagaing = [];
      sagaing[0] = "Sagaing"; sagaing[1] = "Myinmu"; sagaing[2] = "Myaung";
      sagaing[3] = "Shwebo";  sagaing[4] = "Khin-U";  sagaing[5] = "Wetlet";
      sagaing[6] = "Kanbalu"; sagaing[7] = "Kyunhla";  sagaing[8] = "Ye-U";
      sagaing[9] = "Tabayin"; sagaing[10] = "Taze"; sagaing[11] = "Monywa";
      sagaing[12] = "Budalin";sagaing[13] = "Ayadaw";sagaing[14] = "Chaung-U";
      sagaing[15] = "Yinmarbin";  sagaing[16] = "Kani"; sagaing[17] = "Salingyi";
      sagaing[18] = "Pale"; sagaing[19] = "Katha"; sagaing[20] = "Indaw";
      sagaing[21] = "Tigyaing";  sagaing[22] = "Banmauk"; sagaing[23] = "Kawlin";
      sagaing[24] = "Wuntho"; sagaing[25] = "Pinlebu";sagaing[26] = "Kale";
      sagaing[27] = "Kalewa";sagaing[28] = "Mingin"; sagaing[29] = "Tamu";
      sagaing[30] = "Mawlaik";sagaing[31] = "Paungbyin";sagaing[32] = "Hkamti";
      sagaing[33] = "Homalin"; sagaing[34] = "Lay Shi";  sagaing[35] = "Lahe";
       sagaing[36] = "Nanyun";

      // to clear option in select township
      var tt_inner = document.getElementById('tt');
      if(tt_inner.innerHTML!=null){
        tt_inner.innerHTML="";
      }
      // to show township
       for (var i = 0; i < Tcount; i++) {
         // get reference to select element
         var sel = document.getElementById('tt');
         // create new option element
         var opt = document.createElement("option");
         // create text node to add to option element (opt)
         opt.appendChild( document.createTextNode(sagaing[i]) );
         // set value property of opt
         opt.value = sagaing[i];
         // add opt to end of select box (sel)
         sel.appendChild(opt);
       }
      }
    if(state == "Rakhine"){//
      var Tcount = 17;
      const rakhine = [];
      rakhine[0] = "Sittwe"; rakhine[1] = "Ponnagyun"; rakhine[2] = "Mrauk-U";
      rakhine[3] = "Kyauktaw";  rakhine[4] = "Minbya";  rakhine[5] = "Myebon";
      rakhine[6] = "Pauktaw"; rakhine[7] = "Rathedaung";  rakhine[8] = "Maungdaw";
      rakhine[9] = "Buthidaung"; rakhine[10] = "Kyaukpyu"; rakhine[11] = "Munaung";
      rakhine[12] = "Ramree"; rakhine[13] = "Ann";rakhine[14] = "Thandwe";rakhine[15] = "Toungup";
      rakhine[16] = "Gwa";
      // to clear option in select township
      var tt_inner = document.getElementById('tt');
      if(tt_inner.innerHTML!=null){
        tt_inner.innerHTML="";
      }
      // to show township
       for (var i = 0; i < Tcount; i++) {
         // get reference to select element
         var sel = document.getElementById('tt');
         // create new option element
         var opt = document.createElement("option");
         // create text node to add to option element (opt)
         opt.appendChild( document.createTextNode(rakhine[i]) );
         // set value property of opt
         opt.value = rakhine[i];
         // add opt to end of select box (sel)
         sel.appendChild(opt);
       }
      }

  //Nay Pyi Taw
    if(state == "Nay Pyi Taw"){//
      var Tcount = 8;
      const naypyitaw = [];
      naypyitaw[0] = "Zay Yar Thi Ri"; naypyitaw[1] = "Za Bu Thi Ri"; naypyitaw[2] = "Tatkon";
      naypyitaw[3] = "Det Khi Na Thi Ri";  naypyitaw[4] = "Poke Ba Thi Ri";  naypyitaw[5] = "Pyinmana";
      naypyitaw[6] = "Lewe"; naypyitaw[7] = "Oke Ta Ra Thi Ri";
      // to clear option in select township
      var tt_inner = document.getElementById('tt');
      if(tt_inner.innerHTML!=null){
        tt_inner.innerHTML="";
      }
      // to show township
       for (var i = 0; i < Tcount; i++) {
         // get reference to select element
         var sel = document.getElementById('tt');
         // create new option element
         var opt = document.createElement("option");
         // create text node to add to option element (opt)
         opt.appendChild( document.createTextNode(naypyitaw[i]) );
         // set value property of opt
         opt.value = naypyitaw[i];
         // add opt to end of select box (sel)
         sel.appendChild(opt);
       }
    }

  //Mon
    if(state == "Mon"){//
        var Tcount = 10;
        const kachin = [];
        mon[0] = "Mawlamyine"; mon[1] = "Kyaikmaraw"; mon[2] = "Chaungzon";
        mon[3] = "Thanbyuzayat";  mon[4] = "Mudon";  mon[5] = "Ye";
        mon[6] = "Thaton"; mon[7] = "Paung";  mon[8] = "Kyaikto";
        mon[9] = "Bilin";
        // to clear option in select township
        var tt_inner = document.getElementById('tt');
        if(tt_inner.innerHTML!=null){
          tt_inner.innerHTML="";
        }
        // to show township
         for (var i = 0; i < Tcount; i++) {
           // get reference to select element
           var sel = document.getElementById('tt');
           // create new option element
           var opt = document.createElement("option");
           // create text node to add to option element (opt)
           opt.appendChild( document.createTextNode(mon[i]) );
           // set value property of opt
           opt.value = mon[i];
           // add opt to end of select box (sel)
           sel.appendChild(opt);
         }
  }

  //Mandalay
    if(state == "Mandalay"){
          var Tcount = 28;
          const mandalay = [];
          mandalay[0] = "Aungmyaythazan"; mandalay[1] = "Chanayethazan"; mandalay[2] = "Mahaaungmyay";
          mandalay[3] = "Chanmyathazi";  mandalay[4] = "Pyigyitagon";  mandalay[5] = "Amarapura";
          mandalay[6] = "Patheingyi"; mandalay[7] = "Pyinoolwin";  mandalay[8] = "Madaya";
          mandalay[9] = "Singu"; mandalay[10] = "Mogoke"; mandalay[11] = "Thabeikkyin";
          mandalay[12] = "Kyaukse"; mandalay[13] = "Sintgaing";  mandalay[14] = "Myittha";
          mandalay[15] = "Tada-U";  mandalay[16] = "Myingyan"; mandalay[17] = "Taungtha";
          mandalay[18] = "Natogyi"; mandalay[19] = "Kyaukpadaung"; mandalay[20] = "Ngazun";
          mandalay[21] = "Nyaung-U";  mandalay[22] = "Yamethin"; mandalay[23] = "Pyawbwe";
          mandalay[24] = "Meiktila"; mandalay[25] = "Mahlaing";mandalay[26] = "Thazi";
          mandalay[27] = "Wundwin";

          // to clear option in select township
          var tt_inner = document.getElementById('tt');
          if(tt_inner.innerHTML!=null){
            tt_inner.innerHTML="";
          }
          // to show township
           for (var i = 0; i < Tcount; i++) {
             // get reference to select element
             var sel = document.getElementById('tt');
             // create new option element
             var opt = document.createElement("option");
             // create text node to add to option element (opt)
             opt.appendChild( document.createTextNode(mandalay[i]) );
             // set value property of opt
             opt.value = mandalay[i];
             // add opt to end of select box (sel)
             sel.appendChild(opt);
           }
        }

  //Magway
    if(state == "Magway"){
        var Tcount = 26;
        const magway = [];
        magway[0] = "Magway"; magway[1] = "Yenangyaung"; magway[2] = "Chauk";
        magway[3] = "Taungdwingyi";  magway[4] = "Myothit";  magway[5] = "Natmauk";
        magway[6] = "Minbu"; magway[7] = "Pwintbyu";  magway[8] = "Ngape";
        magway[9] = "Lemyethna"; magway[10] = "Salin"; magway[11] = "Sidoktaya";
        magway[12] = "Thayet"; magway[13] = "Minhla";  magway[14] = "Mindon";
        magway[15] = "Kamma";  magway[16] = "Aunglan"; magway[17] = "Sinbaungwe";
        magway[18] = "Pakokku"; magway[19] = "Yesagyo"; magway[20] = "Myaing";
        magway[21] = "Pauk";  magway[22] = "Seikphyu"; magway[23] = "Gangaw";
        magway[24] = "Tilin"; magway[25] = "Saw";
        // to clear option in select township
        var tt_inner = document.getElementById('tt');
        if(tt_inner.innerHTML!=null){
          tt_inner.innerHTML="";
        }
        // to show township
         for (var i = 0; i < Tcount; i++) {
           // get reference to select element
           var sel = document.getElementById('tt');
           // create new option element
           var opt = document.createElement("option");
           // create text node to add to option element (opt)
           opt.appendChild( document.createTextNode(magway[i]) );
           // set value property of opt
           opt.value = magway[i];
           // add opt to end of select box (sel)
           sel.appendChild(opt);
         }
  }

    if(state == "Kayin"){//
        var Tcount = 7;
        const kayin = [];
        kayin[0] = "Hpa-An"; kayin[1] = "Hlaingbwe"; kayin[2] = "Hpapun";
        kayin[3] = "Thandaunggyi";  kayin[4] = "Myawaddy";  kayin[5] = "Kawkareik";
        kayin[6] = "Kyainseikgyi";
        // to clear option in select township
        var tt_inner = document.getElementById('tt');
        if(tt_inner.innerHTML!=null){
          tt_inner.innerHTML="";
        }
        // to show township
         for (var i = 0; i < Tcount; i++) {
           // get reference to select element
           var sel = document.getElementById('tt');
           // create new option element
           var opt = document.createElement("option");
           // create text node to add to option element (opt)
           opt.appendChild( document.createTextNode(kayin[i]) );
           // set value property of opt
           opt.value = kayin[i];
           // add opt to end of select box (sel)
           sel.appendChild(opt);
         }
  }

    if(state == "Kayah"){//
      var Tcount = 7;
      const kayah = [];
      kayah[0] = "Loikaw"; kayah[1] = "Demoso"; kayah[2] = "Hpruso";
      kayah[3] = "Shadaw";  kayah[4] = "Bawlake";  kayah[5] = "Hpasawng";
      kayah[6] = "Mese";
      // to clear option in select township
      var tt_inner = document.getElementById('tt');
      if(tt_inner.innerHTML!=null){
        tt_inner.innerHTML="";
      }
      // to show township
       for (var i = 0; i < Tcount; i++) {
         // get reference to select element
         var sel = document.getElementById('tt');
         // create new option element
         var opt = document.createElement("option");
         // create text node to add to option element (opt)
         opt.appendChild( document.createTextNode(kayah[i]) );
         // set value property of opt
         opt.value = kayah[i];
         // add opt to end of select box (sel)
         sel.appendChild(opt);
       }
  }

    if(state == "Kachin"){//
        var Tcount = 17;
        const kachin = [];
        kachin[0] = "Myitkyina"; kachin[1] = "Waingmaw"; kachin[2] = "Injangyang";
        kachin[3] = "Tanai";  kachin[4] = "Chipwi";  kachin[5] = "Tsawlaw";
        kachin[6] = "Mohnyin"; kachin[7] = "Mogaung";  kachin[8] = "Hpakant";
        kachin[9] = "Bhamo"; kachin[10] = "Momauk"; kachin[11] = "Mansi";
        kachin[12] = "Puta-O"; kachin[13] = "Sumprabum";  kachin[14] = "Machanbaw";
        kachin[15] = "Nawngmun";  kachin[16] = "Khaunglanhpu";
        // to clear option in select township
        var tt_inner = document.getElementById('tt');
        if(tt_inner.innerHTML!=null){
          tt_inner.innerHTML="";
        }
        // to show township
         for (var i = 0; i < Tcount; i++) {
           // get reference to select element
           var sel = document.getElementById('tt');
           // create new option element
           var opt = document.createElement("option");
           // create text node to add to option element (opt)
           opt.appendChild( document.createTextNode(kachin[i]) );
           // set value property of opt
           opt.value = kachin[i];
           // add opt to end of select box (sel)
           sel.appendChild(opt);
         }
       }

    if(state == "Chin"){
        var Tcount = 9;
        const chin = [];
        chin[0] = "Falam"; chin[1] = "Hakha"; chin[2] = "Thantlang";
        chin[3] = "Tedim";  chin[4] = "Tonzang";  chin[5] = "Mindat";
        chin[6] = "Matupi"; chin[7] = "Kanpetlet";  chin[8] = "Paletwa";
        // to clear option in select township
        var tt_inner = document.getElementById('tt');
        if(tt_inner.innerHTML!=null){
          tt_inner.innerHTML="";
        }
        // to show township
         for (var i = 0; i < Tcount; i++) {
           // get reference to select element
           var sel = document.getElementById('tt');
           // create new option element
           var opt = document.createElement("option");
           // create text node to add to option element (opt)
           opt.appendChild( document.createTextNode(chin[i]) );
           // set value property of opt
           opt.value = chin[i];
           // add opt to end of select box (sel)
           sel.appendChild(opt);
         }
       }

    if(state == "Bago(West)"){//
      var Tcount = 14;
      const Bago_E = [];
      Bago_E[0] = "Pyay"; Bago_E[1] = "Paukkhaung"; Bago_E[2] = "Padaung";
      Bago_E[3] = "Paungde";  Bago_E[4] = "Thegon";  Bago_E[5] = "Shwedaung";
      Bago_E[6] = "Thayarwady"; Bago_E[7] = "Letpadan";  Bago_E[8] = "Minhla";
      Bago_E[9] = "Okpho"; Bago_E[10] = "Zigon"; Bago_E[11] = "Nattalin";
      Bago_E[12] = "Monyo"; Bago_E[13] = "Gyobingauk";
      // to clear option in select township
      var tt_inner = document.getElementById('tt');
      if(tt_inner.innerHTML!=null){
        tt_inner.innerHTML="";
      }
      // to show township
       for (var i = 0; i < Tcount; i++) {
         // get reference to select element
         var sel = document.getElementById('tt');
         // create new option element
         var opt = document.createElement("option");
         // create text node to add to option element (opt)
         opt.appendChild( document.createTextNode(Bago_E[i]) );
         // set value property of opt
         opt.value = Bago_E[i];
         // add opt to end of select box (sel)
         sel.appendChild(opt);
       }
      }
    //Ayeyarwady
    if(state == "Ayeyarwady"){
      var Tcount = 26;
      const Ayeyar = [];
      Ayeyar[0] = "Pathein"; Ayeyar[1] = "Kangyidaunt"; Ayeyar[2] = "Thabaung";
      Ayeyar[3] = "Ngapudaw";  Ayeyar[4] = "Kyonpyaw";  Ayeyar[5] = "Yegyi";
      Ayeyar[6] = "Kyaunggon"; Ayeyar[7] = "Hinthada";  Ayeyar[8] = "Zalun";
      Ayeyar[9] = "Lemyethna"; Ayeyar[10] = "Myanaung"; Ayeyar[11] = "Kyangin";
      Ayeyar[12] = "Ingapu"; Ayeyar[13] = "Myaungmya";  Ayeyar[14] = "Einme";
      Ayeyar[15] = "Labutta";  Ayeyar[16] = "Wakema"; Ayeyar[17] = "Mawlamyinegyun";
      Ayeyar[18] = "Maubin"; Ayeyar[19] = "Pantanaw"; Ayeyar[20] = "Nyaungdon";
      Ayeyar[21] = "Danubyu";  Ayeyar[22] = "Pyapon"; Ayeyar[23] = "Bogale";
      Ayeyar[24] = "Kyaiklat"; Ayeyar[25] = "Dedaye";
      // to clear option in select township
      var tt_inner = document.getElementById('tt');
      if(tt_inner.innerHTML!=null){
        tt_inner.innerHTML="";
      }
      // to show township
       for (var i = 0; i < Tcount; i++) {
         // get reference to select element
         var sel = document.getElementById('tt');
         // create new option element
         var opt = document.createElement("option");
         // create text node to add to option element (opt)
         opt.appendChild( document.createTextNode(Ayeyar[i]) );
         // set value property of opt
         opt.value = Ayeyar[i];
         // add opt to end of select box (sel)
         sel.appendChild(opt);
       }
  }
    //Bago(east)
    if(state == "Bago(East)"){
      var Tcount = 14;
      const bago = [];
        bago[0] = "Bago";  bago[1] = "Thanatpin"; bago[2] = "Kawa";
        bago[3] = "Waw"; bago[4] = "Nyaunglebin"; bago[5] = "Kyauktaga";
        bago[6] = "Daik-U";  bago[7] = "Shwegyin";  bago[8] = "Taungoo";
        bago[9] = "Yedashe"; bago[10] = "Kyaukkyi"; bago[11] = "Phyu";
        bago[12] = "Oktwin"; bago[13] = "Htantabin";
        // to clear option in select township
        var tt_inner = document.getElementById('tt');
        if(tt_inner.innerHTML!=null){
          tt_inner.innerHTML="";
        }
      // to show township
       for (var i = 0; i < Tcount; i++) {
         // get reference to select element
         var sel = document.getElementById('tt');
         // create new option element
         var opt = document.createElement("option");
         // create text node to add to option element (opt)
         opt.appendChild( document.createTextNode(bago[i]) );
         // set value property of opt
         opt.value = bago[i];
         // add opt to end of select box (sel)
         sel.appendChild(opt);
       }
     }
  if(state == "Yangon"){
         var Tcount = 45;
         const yangon = [];
          yangon[0] ="Hlaingtharya";yangon[1] ="MingalarDon" ;yangon[2] = "Hmawbi";
          yangon[3] ="Hlegu";yangon[4] ="Taikkyi" ;yangon[5]="Htantabin" ;
          yangon[6] ="Shwepyithar" ;yangon[7] = "Insein";yangon[8] ="Thingangyun" ;
          yangon[9] = "Yankin";yangon[10] = "South Okkalapa";yangon[11] = "North Okkalapa";
          yangon[12] = "Thaketa";yangon[13] ="Dawbon";yangon[14] ="Tamwe" ;
          yangon[15] = "Pazundaung";yangon[16] = "Botahtaung";yangon[17]  ="Dagon Myothit (South)" ;
          yangon[18]  = "Dagon Myothit (North)";yangon[19] ="Dagon Myothit (East)";
          yangon[20] = "Dagon Myothit (Seikkan)";yangon[21]= "Mingalartaungnyunt";
          yangon[22] = "Thanlyin";yangon[23] = "Kyauktan";yangon[24] = "Thongwa";
          yangon[25] = "Kayan";yangon[26] = "Twantay";yangon[27] = "Kawhmu";
          yangon[28] = "Kungyangon";yangon[29] = "Dala";yangon[30] = "Seikgyikanaungto";
          yangon[31] = "Cocokyun";yangon[32] = "Kyauktada";yangon[33] = "Pabedan";
          yangon[34] = "Lanmadaw";yangon[35] ="Latha" ;yangon[36] = "Ahlone";
          yangon[37] = "Kyeemyindaing";yangon[38] ="Sanchaung" ;yangon[39] = "Hlaing";
          yangon[40] = "Kamaryut";yangon[41] = "Mayangone";yangon[42] = "Dagon";
          yangon[43] = "Bahan";yangon[44] = "Seikkan";
          // to clear option in select township
          var tt_inner = document.getElementById('tt');
          if(tt_inner.innerHTML!=null){
            tt_inner.innerHTML="";
          }
          // to show township
          for (var i = 0; i < Tcount; i++) {
            // get reference to select element
            var sel = document.getElementById('tt');
            // create new option element
            var opt = document.createElement("option");
            // create text node to add to option element (opt)
            opt.appendChild( document.createTextNode(yangon[i]) );
            // set value property of opt
            opt.value = yangon[i];
            // add opt to end of select box (sel)
            sel.appendChild(opt);
          }
       }
     }
function Psub(){
    var ptCat = document.getElementById("Ptype").value;

    if(ptCat == "PHA"){//
               var Tcount = 2;
               const ptype_sub = [];
               ptype_sub[0] = "OPD"; ptype_sub[1] = "DC";

               // to clear option in select township
               var tt_inner = document.getElementById('tt_sub');

               if(tt_inner.innerHTML!=null){
                 tt_inner.innerHTML="";

               }
               // to show township
                for (var i = 0; i < Tcount; i++) {
                  // get reference to select element
                  var sel = document.getElementById('tt_sub');

                  // create new option element
                  var opt = document.createElement("option");

                  // create text node to add to option element (opt)
                  opt.appendChild( document.createTextNode(ptype_sub[i]) );

                  // set value property of opt
                  opt.value = ptype_sub[i];

                  // add opt to end of select box (sel)
                  sel.appendChild(opt);


                }
              }
    if(ptCat == "ART"){//
                         var Tcount = 2;
                         const ptype_sub = [];
                         ptype_sub[0] = "OPD"; ptype_sub[1] = "DC";

                         // to clear option in select township
                         var tt_inner = document.getElementById('tt_sub');
                         if(tt_inner.innerHTML!=null){
                           tt_inner.innerHTML="";
                         }
                         // to show township
                          for (var i = 0; i < Tcount; i++) {
                            // get reference to select element
                            var sel = document.getElementById('tt_sub');
                            // create new option element
                            var opt = document.createElement("option");
                            // create text node to add to option element (opt)
                            opt.appendChild( document.createTextNode(ptype_sub[i]) );
                            // set value property of opt
                            opt.value = ptype_sub[i];
                            // add opt to end of select box (sel)
                            sel.appendChild(opt);

                          }
    }
    if(ptCat == "STI"){//
                         var Tcount = 3;
                         const ptype_sub = [];
                         ptype_sub[0] = "SW";ptype_sub[1] = "MSM";

                         // to clear option in select township
                         var tt_inner = document.getElementById('tt_sub');
                         if(tt_inner.innerHTML!=null){
                           tt_inner.innerHTML="";
                         }
                         // to show township
                          for (var i = 0; i < Tcount; i++) {
                            // get reference to select element
                            var sel = document.getElementById('tt_sub');
                            // create new option element
                            var opt = document.createElement("option");
                            // create text node to add to option element (opt)
                            opt.appendChild( document.createTextNode(ptype_sub[i]) );
                            // set value property of opt
                            opt.value = ptype_sub[i];
                            // add opt to end of select box (sel)
                            sel.appendChild(opt);
                          }
    }
    if(ptCat == "FC"){//
                         var Tcount = 2;
                         const ptype_sub = [];
                         ptype_sub[0] = "DC"; ptype_sub[1] = "ATFP";

                         // to clear option in select township
                         var tt_inner = document.getElementById('tt_sub');
                         if(tt_inner.innerHTML!=null){
                           tt_inner.innerHTML="";
                         }
                         // to show township
                          for (var i = 0; i < Tcount; i++) {
                            // get reference to select element
                            var sel = document.getElementById('tt_sub');
                            // create new option element
                            var opt = document.createElement("option");
                            // create text node to add to option element (opt)
                            opt.appendChild( document.createTextNode(ptype_sub[i]) );
                            // set value property of opt
                            opt.value = ptype_sub[i];
                            // add opt to end of select box (sel)
                            sel.appendChild(opt);
                          }
    }
    if(ptCat == "General"){//
                         var Tcount = 8;
                         const ptype_sub = [];
                         ptype_sub[0]="";
                         ptype_sub[1] = "TB"; ptype_sub[2] = "Hypertension";ptype_sub[3] = "FP";
                         ptype_sub[4] = "DM";ptype_sub[5] = "Both(Hypertension-DM)";ptype_sub[6]="Fever";
                         ptype_sub[7]="Other";
                         // to clear option in select township
                         var tt_inner = document.getElementById('tt_sub');
                         if(tt_inner.innerHTML!=null){
                           tt_inner.innerHTML="";
                         }
                         // to show township
                          for (var i = 0; i < Tcount; i++) {
                            // get reference to select element
                            var sel = document.getElementById('tt_sub');
                            // create new option element
                            var opt = document.createElement("option");
                            // create text node to add to option element (opt)
                            opt.appendChild( document.createTextNode(ptype_sub[i]) );
                            // set value property of opt
                            opt.value = ptype_sub[i];
                            opt.setAttribute("onclick","General()");
                            // add opt to end of select box (sel)
                            sel.appendChild(opt);
                          }
    }
    if(ptCat == "PMTCT"){
      var Tcount = 2;
      const ptype_sub = [];
      ptype_sub[0] ="";
      ptype_sub[1] = "OPD"; ptype_sub[2] = "DC";

      // to clear option in select township
      var tt_inner = document.getElementById('tt_sub');

      if(tt_inner.innerHTML!=null){
        tt_inner.innerHTML="";

      }
      // to show township
       for (var i = 0; i < Tcount; i++) {
         // get reference to select element
         var sel = document.getElementById('tt_sub');

         // create new option element
         var opt = document.createElement("option");

         // create text node to add to option element (opt)
         opt.appendChild( document.createTextNode(ptype_sub[i]) );

         // set value property of opt
         opt.value = ptype_sub[i];

         // add opt to end of select box (sel)
         sel.appendChild(opt);


       }
    }
    if(ptCat == "ANC"){
      var Tcount = 2;
      const ptype_sub = [];
      ptype_sub[0] ="";
      ptype_sub[1] = "OPD"; ptype_sub[2] = "DC";

      // to clear option in select township
      var tt_inner = document.getElementById('tt_sub');

      if(tt_inner.innerHTML!=null){
        tt_inner.innerHTML="";

      }
      // to show township
       for (var i = 0; i < Tcount; i++) {
         // get reference to select element
         var sel = document.getElementById('tt_sub');

         // create new option element
         var opt = document.createElement("option");

         // create text node to add to option element (opt)
         opt.appendChild( document.createTextNode(ptype_sub[i]) );

         // set value property of opt
         opt.value = ptype_sub[i];

         // add opt to end of select box (sel)
         sel.appendChild(opt);


       }
    }
    if(ptCat == "<15"){
      var Tcount = 2;
      const ptype_sub = [];
      ptype_sub[0] ="";
      ptype_sub[1] = "OPD"; ptype_sub[2] = "DC";
      // to clear option in select township
      var tt_inner = document.getElementById('tt_sub');

      if(tt_inner.innerHTML!=null){
        tt_inner.innerHTML="";

      }
      // to show township
       for (var i = 0; i < Tcount; i++) {
         // get reference to select element
         var sel = document.getElementById('tt_sub');

         // create new option element
         var opt = document.createElement("option");

         // create text node to add to option element (opt)
         opt.appendChild( document.createTextNode(ptype_sub[i]) );

         // set value property of opt
         opt.value = ptype_sub[i];

         // add opt to end of select box (sel)
         sel.appendChild(opt);


       }
    }
 }
function General(){
  var oiName = document.getElementById("tt_sub").value;

  if(oiName == "Hypertension" || oiName =='DM' || oiName=='Both(Hypertension-DM)'){
    var Tcount = 3;
    const ptype_sub = [];
    ptype_sub[0]="";
    ptype_sub[1] = "Hiv (Pos)"; ptype_sub[2] = "Hiv (neg)";

    // to clear option in select township

    if(tt_inner_2.innerHTML!=null){
      tt_inner_2.innerHTML="";
    }
    // to show township
     for (var i = 0; i < Tcount; i++) {
       // get reference to select element
       var sel = document.getElementById('tt_sub_2');
       // create new option element
       var opt = document.createElement("option");
       // create text node to add to option element (opt)
       opt.appendChild( document.createTextNode(ptype_sub[i]) );
       // set value property of opt
       opt.value = ptype_sub[i];

       // add opt to end of select box (sel)
       sel.appendChild(opt);
     }
  }

}

function refresh(){
    location.reload(true);
  }
function clearFacts(){
  //document.getElementById("gid_1").value="";
  //document.getElementById("name").value="";
  //document.getElementById("father").value="";
  //document.getElementById("agey").value="";
  //document.getElementById("agem").value="";
  //document.getElementById("gender").value="";
  //document.getElementById("fid").value="";
  //document.getElementById("state").value="";
  //document.getElementById("tt_opt").value="";
  //document.getElementById("state").value="";
  //document.getElementById("quarter").value="";
  document.getElementById("Ptype").value="";
  document.getElementById("tt_sub").value="";


}
function dateOfBirth(){
  var estimated_DoB=0;
      let vDate_dob = document.getElementById('vDate').value;
      let agey_dob = document.getElementById("agey").value;
      let agem_dob = document.getElementById("agem").value;
      let dob_input = document.getElementById('dob').value;
      if(dob_input.length=='0'){
      if(agey_dob == "" && agem_dob == ""){
        alert("Input Age or Month");
      }
      if(agey_dob.length>0){
        var Adate = new Date();
        var Aday = Adate.getDate();
        var Amonth = Adate.getMonth() + 1;
        var Ayear = Adate.getFullYear();
        var estimated_Year = Ayear - agey_dob;
        var estimated_Month = Amonth - 1 ;
        var estimated_Day = Aday;
        if(estimated_Month < 10){estimated_Month = "0" + estimated_Month;}
        if(estimated_Day < 10){estimated_Day="0" + estimated_Day;}
        estimated_DoB = estimated_Year + "-" + estimated_Month + "-" + estimated_Day;
        //document.getElementById('dob').value= estimated_DoB;
      }
      if(agem_dob.length>1){
        document.getElementById('agey').value="";
        var Adate = new Date();
        var Aday = Adate.getDate();
        var Amonth = Adate.getMonth() + 1;
        var Ayear = Adate.getFullYear();
        var estimated_Year = Ayear - 0;
        var estimated_Month = Amonth - agem_dob ;
        if(estimated_Month == 0){
          estimated_Year = estimated_Year-1;
          estimated_Month = estimated_Month + 12;
        }
        if(estimated_Month == -1){
          estimated_Year = estimated_Year-1;
          estimated_Month = estimated_Month + 11;
        }
        if(estimated_Month == -2){
          estimated_Year = estimated_Year-1;
          estimated_Month = estimated_Month + 10;
        }
        var estimated_Day = Aday;
        if(estimated_Month < 10){estimated_Month = "0" + estimated_Month;}
        if(estimated_Day < 10){estimated_Day="0" + estimated_Day;}
        estimated_DoB = estimated_Year + "-" + estimated_Month + "-" + estimated_Day;
        //document.getElementById('dob').value= estimated_DoB;
      }
    }else{
      estimated_DoB = document.getElementById('dob').value;
    }
    ddDate = estimated_DoB;
  }

function PatientType(){
      var type= document.getElementById('Ptype').value;
      if(tt_sub.innerHTML!=null){
        tt_sub.innerHTML="";
      }
      $("#tt_sub").empty();
      if(type == "Pregnant Mother"){
          var sel = document.getElementById('tt_sub');
          // create new option element
          var opt0 = document.createElement("option");
          var opt1 = document.createElement("option");
          var opt2 = document.createElement("option");
          // create text node to add to option element (opt)
        //  opt0.appendChild( document.createTextNode(""));
        //  opt1.appendChild( document.createTextNode("PP"));
        //  opt2.appendChild( document.createTextNode("MP"));
          // set value property of opt
          opt1.setAttribute('id','opt_ext_pp');
          opt2.setAttribute('id','opt_ext_mp');

          opt1.value = "PP";
          opt2.value = "MP";
          opt0.text = "";
          opt1.text = "PP";
          opt2.text = "MP";
          pregMum = 1;
          sel.addEventListener("click", Ptypesub);

          // add opt to end of select box (sel)
          sel.add(opt0);
          sel.add(opt1);
          sel.add(opt2);

      }
      if(type == "Spouse of pregnant mother"){

        var sel = document.getElementById('tt_sub');
        // create new option element
        var opt0 = document.createElement("option");
        var opt1 = document.createElement("option");
        var opt2 = document.createElement("option");
        // create text node to add to option element (opt)
        opt0.appendChild( document.createTextNode(""));
        opt1.appendChild( document.createTextNode("HIV(Pos)"));
        opt2.appendChild( document.createTextNode("HIV(Neg)Woman"));
        // set value property of opt
        opt0.value ="";
        opt1.value ="HIV(Pos)";
        opt2.value ="HIV(Neg)Woman";
        // add opt to end of select box (sel)
        opt1.setAttribute('id','opt_ext_hivPos');
        opt2.setAttribute('id','opt_ext_hivNeg');

        sel.addEventListener("click", Ptypesub);
        ////
        sel.appendChild(opt0);
        sel.appendChild(opt1);
        sel.appendChild(opt2);
        spm =1;

      }
      if(type == "Exposed Children"){

        var sel = document.getElementById('tt_sub');
        // create new option element
        var opt0 = document.createElement("option");
        var opt1 = document.createElement("option");
        var opt2 = document.createElement("option");
        var opt3 = document.createElement("option");
        var opt4 = document.createElement("option");
        // create text node to add to option element (opt)
        opt0.appendChild( document.createTextNode(""));
        opt1.appendChild( document.createTextNode("1"));
        opt2.appendChild( document.createTextNode("2"));
        opt3.appendChild( document.createTextNode("3"));
        opt4.appendChild( document.createTextNode("4"));

        // set value property of opt
        opt0.value = 0;
        opt1.value = 1;
        opt2.value = 2;
        opt3.value = 3;
        opt4.value = 4;
        ///////
        opt0.setAttribute('id','opt_ext_ec_0');
        opt1.setAttribute('id','opt_ext_ec_1');
        opt2.setAttribute('id','opt_ext_ec_2');
        opt3.setAttribute('id','opt_ext_ec_3');
        opt4.setAttribute('id','opt_ext_ec_4');

        sel.addEventListener("click", Ptypesub);
        // add opt to end of select box (sel)
        sel.appendChild(opt0);
        sel.appendChild(opt1);
        sel.appendChild(opt2);
        sel.appendChild(opt3);
        sel.appendChild(opt4);
        epc = 1;
      }
      if(type == "Low risk"){
        var sel = document.getElementById('tt_sub');
        // create new option element
        var opt0 = document.createElement("option");
        //var opt1 = document.createElement("option");
        var opt2 = document.createElement("option");
        var opt3 = document.createElement("option");
        // create text node to add to option element (opt)
        opt0.appendChild( document.createTextNode(""));
        //opt1.appendChild( document.createTextNode("PWUD"));
        opt2.appendChild( document.createTextNode("Youth (15-24)"));
        opt3.appendChild( document.createTextNode("Other Low Risk"));

        opt0.setAttribute('id','opt_lr_0');
        //opt1.setAttribute('id','opt_lr_pwud');
        opt2.setAttribute('id','opt_lr_youth');
        opt3.setAttribute('id','opt_lr_other');
        // set value property of opt
        opt0.value = "";
        //opt1.value = "pwud";
        opt2.value = "Youth(15-24)";
        opt3.value = "Other Low Risk";

        sel.addEventListener("click", Ptypesub);
        // add opt to end of select box (sel)
        sel.appendChild(opt0);
        //sel.appendChild(opt1);
        sel.appendChild(opt2);
        sel.appendChild(opt3);
        lr = 1;
      }
      // PWUD
      if(type == "FSW"){
        var sel = document.getElementById('tt_sub');
        // create new option element
        var opt0 = document.createElement("option");
        var opt1 = document.createElement("option");
        var opt2 = document.createElement("option");
        // create text node to add to option element (opt)
        opt0.appendChild( document.createTextNode(""));
        opt1.appendChild( document.createTextNode("FSW PWID"));
        opt2.appendChild( document.createTextNode("FSW PWUD"));
        // set value property of opt
        opt0.value = "";
        opt1.value = "FSW_PWID";
        opt2.value = "FSW_PWUD";

        opt0.setAttribute('id','opt_fsw_0');
        opt1.setAttribute('id','opt_fsw_pwid');
        opt2.setAttribute('id','opt_fsw_pwud');

        sel.addEventListener("click", Ptypesub);
        // add opt to end of select box (sel)
        sel.appendChild(opt0);
        sel.appendChild(opt1);
        sel.appendChild(opt2);
        fsw = 1;
      }
      if(type == "Client of FSW"){
        opt0.value = "";
      }
      if(type == "MSM"){
        msm =1;
        var sel = document.getElementById('tt_sub');
        // create new option element
        var opt0 = document.createElement("option");
        var opt1 = document.createElement("option");
        var opt2 = document.createElement("option");
        // create text node to add to option element (opt)
        opt0.appendChild( document.createTextNode(""));
        opt1.appendChild( document.createTextNode("MSM PWID"));
        opt2.appendChild( document.createTextNode("MSM PWUD"));
        // set value property of opt
        opt0.value = "";
        opt1.value = "MSM_PWID";
        opt2.value = "MSM_PWUD";

        opt0.setAttribute('id','opt_msm_0');
        opt1.setAttribute('id','opt_msm_pwid');
        opt2.setAttribute('id','opt_msm_pwud');

        sel.addEventListener("click", Ptypesub);

        // add opt to end of select box (sel)
        sel.appendChild(opt0);
        sel.appendChild(opt1);
        sel.appendChild(opt2);

      }
      if(type == "IDU"){
        var sel = document.getElementById('tt_sub');
        // create new option element
        var opt0 = document.createElement("option");
        var opt1 = document.createElement("option");
        var opt2 = document.createElement("option");

        // create text node to add to option element (opt)
        opt0.appendChild( document.createTextNode(""));
        opt1.appendChild( document.createTextNode("PWID/FSW"));
        opt2.appendChild( document.createTextNode("PWID/MSM"));
        // set value property of opt
        opt0.value = "";
        opt1.value = "PWID_FSW";
        opt2.value = "PWID_MSM";

        opt0.setAttribute('id','opt_idu_0');
        opt1.setAttribute('id','opt_idu_fsw');
        opt2.setAttribute('id','opt_idu_msm');

        sel.addEventListener("click", Ptypesub);

        // add opt to end of select box (sel)
        sel.appendChild(opt0);
        sel.appendChild(opt1);
        sel.appendChild(opt2);
        idu = 1;

      }
      if(type == "TG"){
        var sel = document.getElementById('tt_sub');
        // create new option element
        var opt0 = document.createElement("option");
        var opt1 = document.createElement("option");
        var opt2 = document.createElement("option");
        var opt3 = document.createElement("option");
        // create text node to add to option element (opt)
        opt0.appendChild( document.createTextNode(""));
        opt1.appendChild( document.createTextNode("TG/PWID"));
        opt2.appendChild( document.createTextNode("TG/PWUD"));
        opt3.appendChild( document.createTextNode("TG/SW"));
        // set value property of opt
        opt0.value = "";
        opt1.value = "TG_PWID";
        opt2.value = "TG_PWUD";
        opt3.value = "TG_SW";

        opt0.setAttribute('id','opt_tg_0');
        opt1.setAttribute('id','opt_tg_pwid');
        opt2.setAttribute('id','opt_tg_pwud');
        opt3.setAttribute('id','opt_tg_sw');

        sel.addEventListener("click", Ptypesub);

        // add opt to end of select box (sel)
        sel.appendChild(opt0);
        sel.appendChild(opt1);
        sel.appendChild(opt2);
        sel.appendChild(opt3);
        tg=1;
      }
      if(type == "Partner of KP"){
        var sel = document.getElementById('tt_sub');
        // create new option element
        var opt0 = document.createElement("option");
        var opt1 = document.createElement("option");
        var opt2 = document.createElement("option");
        var opt3 = document.createElement("option");
        var opt4 = document.createElement("option");
        // create text node to add to option element (opt)
        opt0.appendChild( document.createTextNode(""));
        opt1.appendChild( document.createTextNode("Partner of PWID"));
        opt2.appendChild( document.createTextNode("Partner of FSW"));
        opt3.appendChild( document.createTextNode("Female of MSM"));
        opt4.appendChild( document.createTextNode("Partner of TG"));
        // set value property of opt

        opt0.value = "";
        opt1.value = "Partner of PWID";
        opt2.value = "Partner of FSW";
        opt3.value = "Female of MSM";
        opt4.value = "Partner of TG";

        opt0.setAttribute('id','opt_pkp_0');
        opt1.setAttribute('id','opt_pkp_pwid');
        opt2.setAttribute('id','opt_pkp_fsw');
        opt3.setAttribute('id','opt_pkp_msm');
        opt4.setAttribute('id','opt_pkp_tg');

        sel.addEventListener("click", Ptypesub);
          // add opt to end of select box (sel)
          sel.appendChild(opt0);
          sel.appendChild(opt1);
          sel.appendChild(opt2);
          sel.appendChild(opt3);
          sel.appendChild(opt4);
          pkp = 1;
        }
        // partner of PLHIV
      if(type == "Special Groups"){
        var sel = document.getElementById('tt_sub');
        // create new option element
        var opt0 = document.createElement("option");
        var opt1 = document.createElement("option");
        var opt2 = document.createElement("option");
        var opt3 = document.createElement("option");

        // create text node to add to option element (opt)
        opt0.appendChild( document.createTextNode(""));
        opt1.appendChild( document.createTextNode("TB Patient"));
        opt2.appendChild( document.createTextNode("Institutionalize"));
        opt3.appendChild( document.createTextNode("Uniformed Services Personnel"));

        // set value property of opt

        opt0.value = "";
        opt1.value = "TB Patient";
        opt2.value = "Institutionalize";
        opt3.value = "Uniformed Services Personnel";

        opt0.setAttribute('id','opt_sg_0');
        opt1.setAttribute('id','opt_sg_TB');
        opt2.setAttribute('id','opt_sg_insti');
        opt3.setAttribute('id','opt_sg_uni');

        sel.addEventListener("click", Ptypesub);
        // add opt to end of select box (sel)
        sel.appendChild(opt0);
        sel.appendChild(opt1);
        sel.appendChild(opt2);
        sel.appendChild(opt3);

        sg=1;
      }
      // migrant
  }
function Ptypesub(){
      if(pregMum == 1){
        var pp = document.getElementById('opt_ext_pp').value;
        var mp = document.getElementById('opt_ext_mp').value;
        if(pp!=null){
          if(document.getElementById("opt_ext_pp").selected == true){Ptype_sub="PP";}
        }
        if(mp != null){
          if(document.getElementById("opt_ext_mp").selected == true){Ptype_sub="MP";}
        }
      }
      if(spm == 1){
        var hiv_pos =document.getElementById('opt_ext_hivPos').value;
        var hiv_neg =document.getElementById("opt_ext_hivNeg").value;
        if( hiv_pos != null){
          if(document.getElementById("opt_ext_hivPos").selected == true){Ptype_sub="HIV(Pos)";}
        }
        if(hiv_neg !=null){
          if(document.getElementById("opt_ext_hivNeg").selected == true){Ptype_sub="HIV(Neg)Woman";}
        }

      }
      if(epc == 1){
        var ec1 = document.getElementById("opt_ext_ec_1").value;
        var ec2 = document.getElementById("opt_ext_ec_2").value;
        var ec3 = document.getElementById("opt_ext_ec_3").value;
        var ec4 = document.getElementById("opt_ext_ec_4").value;
        if(ec1!=null){
          if(document.getElementById("opt_ext_ec_1").selected == true){Ptype_sub="1";}
        }
        if(ec2!=null){
          if(document.getElementById("opt_ext_ec_2").selected == true){Ptype_sub="2";}
        }
        if(ec3!=null){
          if(document.getElementById("opt_ext_ec_3").selected == true){Ptype_sub="3";}
        }
        if(ec4!=null){
          if(document.getElementById("opt_ext_ec_4").selected == true){Ptype_sub="4";}
        }
      }
      if(lr == 1){
        var lr_youth = document.getElementById("opt_lr_youth").value;
        //var lr_pwud = document.getElementById("opt_lr_youth").value;
        var lr_other = document.getElementById("opt_lr_youth").value;
        if(lr_youth != null){

          if(document.getElementById("opt_lr_youth").selected == true){Ptype_sub="Youth (15-24)";}
        }
        //if(lr_pwud){
        //  if(document.getElementById("opt_lr_pwud").selected == true){Ptype_sub="PWUD";}
        //}
        if(lr_other != null){
          if(document.getElementById("opt_lr_other").selected == true){Ptype_sub="Other Low Risk";}
        }
      }
      if(fsw == 1){
        var fswpwid = document.getElementById('opt_fsw_pwid').value;
        var fswpwud = document.getElementById('opt_fsw_pwud').value;
        if( fswpwid != null){
          if(document.getElementById("opt_fsw_pwid").selected == true){Ptype_sub="FSW_PWID";}
        }
        if(fswpwud != null){
          if(document.getElementById("opt_fsw_pwud").selected == true){Ptype_sub='FSW_PWUD';}
        }
      }
      if(msm == 1){
        var msmpwid = document.getElementById("opt_msm_pwid").value;
        var msmpwud = document.getElementById("opt_msm_pwud").value;
        if(msmpwid){
          if(document.getElementById("opt_msm_pwid").selected == true){Ptype_sub="MSM_PWID";}
        }
        if(msmpwud){
          if(document.getElementById("opt_msm_pwud").selected == true){Ptype_sub="MSM_PWUD";}
        }
      }
      if(idu == 1){
        var idu_fsw = document.getElementById("opt_idu_fsw").value;
        var idu_msm = document.getElementById("opt_idu_msm").value;
        if(idu_fsw != null){
          if(document.getElementById("opt_idu_fsw").selected == true){Ptype_sub="PWID_FSW";}
        }
        if(idu_msm){
          if(document.getElementById("opt_idu_msm").selected == true){Ptype_sub="PWID_MSM";}
        }
      }
      if(pkp == 1){
        var pkp_pwid=document.getElementById("opt_pkp_pwid").value;
        var pkp_fsw = document.getElementById("opt_pkp_fsw").value;
        var pkp_msm = document.getElementById("opt_pkp_msm").value;
        var pkp_plhiv = document.getElementById("opt_pkp_plhiv").value;
        if(pkp_pwid!=null){
          if(document.getElementById("opt_pkp_pwid").selected == true){Ptype_sub="Partner of PWID";}
        }
        if(pkp_fsw){
          if(document.getElementById("opt_pkp_fsw").selected == true){Ptype_sub="Partner of FSW";}
        }
        if(pkp_msm!=null){
          if(document.getElementById("opt_pkp_msm").selected == true){Ptype_sub="Female of MSM";}
        }
        //if(pkp_plhiv){
        //  if(document.getElementById("opt_pkp_plhiv").selected == true){Ptype_sub="Partener of PLHIV";}
        //}
      }
      if(sg == 1){
        var sg_TB=document.getElementById("opt_sg_TB").value;
        var sg_insti=document.getElementById("opt_sg_insti").value;
        var sg_uni = document.getElementById("opt_sg_uni").value;
        var sg_mig =document.getElementById("opt_sg_mig").value;
        if(sg_TB != null){
          if(document.getElementById("opt_sg_TB").selected == true){Ptype_sub="TB Patient";}
        }
        if(sg_insti !=null){
          if(document.getElementById("opt_sg_insti").selected == true){Ptype_sub="Institutionalize";}
        }
        if(sg_uni != null){
          if(document.getElementById("opt_sg_uni").selected == true){Ptype_sub="Uniformed Services Personnel";}
        }
        //if(sg_mig != null){
        //  if(document.getElementById("opt_sg_mig").selected == true){Ptype_sub="Migrant Population";}
        //}
      }
      if(tg == 1){
        var tg_pwid =document.getElementById("opt_tg_pwid").value;
        var tg_pwud =document.getElementById("opt_tg_pwud").value;
        var tg_sw =document.getElementById("opt_tg_sw").value;
        if(tg_pwid != null){
          if(document.getElementById("opt_tg_pwid").selected == true){Ptype_sub="TG_PWID";}
        }
        if(tg_pwud != null){
          if(document.getElementById("opt_tg_pwud").selected == true){Ptype_sub="TG_PWUD";}
        }
        if(tg_sw != null){
          if(document.getElementById("opt_tg_sw").selected == true){Ptype_sub="TG_SW";}
        }
      }
      console.log(Ptype_sub);
  }

  function Service_Modality(){
        var type= document.getElementById('service').value;
        if(m_o_entry.innerHTML!=null){
          m_o_entry.innerHTML="";
        }
        $("#m_o_entry").empty();
        if(type == "Community"){
            var sel = document.getElementById('m_o_entry');
            // create new option element
            var opt0 = document.createElement("option");
            var opt1 = document.createElement("option");
            var opt2 = document.createElement("option");
            var opt3 = document.createElement("option");
            var opt4 = document.createElement("option");
            var opt5 = document.createElement("option");
            var opt6 = document.createElement("option");


            // create text node to add to option element (opt)
          //  opt0.appendChild( document.createTextNode(""));
          //  opt1.appendChild( document.createTextNode("PP"));
          //  opt2.appendChild( document.createTextNode("MP"));
            // set value property of opt
          //  opt1.setAttribute('id','opt_ext_pp');
          //  opt2.setAttribute('id','opt_ext_mp');

          //opt1.value ="Index";

            opt1.text ="Index";
            opt2.text ="SNS";
            opt3.text ="TB";
            opt4.text ="STI";
            opt5.text ="HIV-ST";
            opt6.text ="VCT";
            service = 1;
            sel.addEventListener("click", Ptypesub);

            // add opt to end of select box (sel)
            sel.add(opt0);
            sel.add(opt1);
            sel.add(opt2);
            sel.add(opt3);
            sel.add(opt4);
            sel.add(opt5);
            sel.add(opt6);


        }
        if(type == "Facility"){
            var sel = document.getElementById('m_o_entry');
            // create new option element
            var opt0 = document.createElement("option");
            var opt1 = document.createElement("option");
            var opt2 = document.createElement("option");
            var opt3 = document.createElement("option");
            var opt4 = document.createElement("option");

            // create text node to add to option element (opt)
          //  opt0.appendChild( document.createTextNode(""));
          //  opt1.appendChild( document.createTextNode("PP"));
          //  opt2.appendChild( document.createTextNode("MP"));
            // set value property of opt
          //  opt1.setAttribute('id','opt_ext_pp');
          //  opt2.setAttribute('id','opt_ext_mp');

          //opt1.value ="Index";

            opt1.text ="Moble/CBS";
            opt2.text ="SNS";
            opt3.text ="Index";
            opt4.text ="HIV-ST";

            service = 1;
            sel.addEventListener("click", Ptypesub);
            // add opt to end of select box (sel)
            sel.add(opt0);
            sel.add(opt1);
            sel.add(opt2);
            sel.add(opt3);
            sel.add(opt4);

        }


    }
</script>

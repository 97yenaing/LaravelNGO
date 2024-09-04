<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
@extends('layouts.app')



@section('content')
@auth
<div id="customAlertBox" class="custom-alert" style="display:none">
    <label>SuccessFully Collected</label>
    <button  class="btn btn-warning " id="cus_alert" onclick="custom_alert()">OK</button>   
</div>
<div id="hts_warining" class="hts-warning" style="display:none">
    <label>Your Hts Data is not Complete</label>
    <button  class="btn btn-warning " id="cus_alert" onclick="custom_alert()">OK</button>   
</div>
<p class="btn-gnavi">
				<span></span>
				<span></span>
				<span></span>
			</p>
<div class="container containers ">
    <ul class="nav nav-tabs toggle consulor-list" id="hidden-title" >
      <li class="nav-item">
        <a class="nav-link active toggle-link" data-toggle="tab" href="#first" id="firstPage" onclick="">Counselling facts and HTS data entry</a>
      </li>
       <li class="nav-item">
        <a class="nav-link toggle-link " data-toggle="tab" href="#second" id="secondPage" onclick="">HTS Data/Update</a>
      </li>
      <!-- <li class="nav-item">
        <a class="nav-link  " data-toggle="tab" href="#third" onclick="">Lab's Results</a>
      </li> -->

    </ul>

    <div class="tab-content containers">
      <div class="tab-pane container containers active cosulor-parent-div" id="first">
        <div style="margin:auto" id="toshowResult"></div>
        <div id="hider0" class="container containers">
        <br>
        <!--   <form class="" id="reg" method="post" > -->
        @csrf
        <div class="row justify-content-center">
          <div class="col-md-12 "  >
              <h3 class='header-text' style="text-align: center;">Counselling Room</h3>
          </div>
        </div>

              <div class="row counGeneral">
                <div class="col-md-2 ">
                  <input  type="text" class="form-control" autofocus id="gid" placeholder="General ID or Fuchia ID" >
                </div>
                <div class="col-md-1">
                  <button  class="btn btn-warning update-batton" id="hts-search" onclick="ptData()">Search</button>
                </div>
                <!-- <div class="col-sm-2">

                </div> -->
                <div class="col-md-1 consulor-refresh ">
                  <button  class="btn btn-success refresh-follow consulor-rfr-btn" onclick="refresh()">Refresh</button>
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
              <div class="row">
                <div class="col-sm-2 do-test">
                  <label for="">Counselling / Patient_record</label>
                  <select class="form-control" id="test_do" onchange="testDo()" >
                    <option selected value="counsel_info">Counselling</option>
                    <option  value="pat_record">Patient_record</option>
                  </select>
                </div>
               <div class="col-sm-2 conunselling_type">
                  <label>HTS Entry / Counselling Only</label>
                  <select class="form-control"id="coun_count" onchange="Counselling_Count()" >
                    <option selected value="one">Counselling Only</option>
                    <option  value="two">HTS Entry and Counselling</option>
                  </select>
               </div>            
              </div>
                <div class="col-sm-3 consulor-date">
                  <label for="">Counselling Date</label>
                  <div class="input-group mb-2 ">
                    <input type="date"  id="vDate"  class="form-control" required>
                  </div>
                </div>
                <div class="col-md-2 consulor-div">
                  <label for="">Counselor</label>
                  <select class="form-select" id="counsellor" onchange="updateORsave()" required>
                    <option value="-"></option>
                    <option value="col_1">Counsellor 1</option>
                    <option value="col_2">Counsellor 2</option>
                    <option value="col_3">Counsellor 3</option>
                    <option value="col_4">Counsellor 4</option>
                    <option value="col_5">Counsellor 5</option>
                    <option value="col_6">Counsellor 6</option>
                    <option value="col_7">Counsellor 7</option>
                    <option value="col_8">Counsellor 8</option>
                    <option value="col_9">Counsellor 9</option>
                    <option value="col_10">Counsellor 10</option>
                    <option value="col_11">Counsellor 11</option>
                    <option value="col_12">Counsellor 12</option>
                    <option value="col_13">Counsellor 13</option>
                    <option value="col_14">Counsellor 14</option>
                    <option value="col_5">Counsellor 15</option>
                    <option value="col_1">Counsellor 16</option>
                    <option value="col_2">Counsellor 17</option>
                    <option value="col_3">Counsellor 18</option>
                    <option value="col_4">Counsellor 19</option>
                    <option value="col_5">Counsellor 20</option>
                    <option value="col_1">Counsellor 21</option>
                    <option value="col_2">Counsellor 22</option>
                    <option value="col_3">Counsellor 23</option>
                    <option value="col_4">Counsellor 24</option>
                    <option value="col_5">Counsellor 25</option>
                    <option value="col_1">Counsellor 26</option>
                    <option value="col_2">Counsellor 27</option>
                    <option value="col_3">Counsellor 28</option>
                    <option value="col_4">Counsellor 29</option>
                    <option value="col_5">Counsellor 30</option>
                    <option value="col_1">Counsellor 31</option>
                    <option value="col_2">Counsellor 32</option>
                    <option value="col_3">Counsellor 33</option>
                    <option value="col_4">Counsellor 34</option>
                    <option value="col_5">Counsellor 35</option>
                  </select>
                </div>
                <div class="col-sm-2 change-risk">
                  <label for="">Risk_Change</label>
                  <select class="form-control" id="riskChangeLab" onchange="riskChangeLab()" >
                    <option  value="Yes">Yes</option>
                    <option selected value="No">No</option>
                  </select>
                </div>
                <div class="col-sm-3 labTest-date" style="display:none">
                  <label for="">Lab Test Date</label>
                  <div class="input-group mb-2 ">
                    <input type="date" onblur="LabTestDate()" id="labTestDate"  class="form-control" disabled required>
                  </div>
                </div>
                
               
              </div>
              <br>
              <div class="row  ">
              <!-- counselor-riskRow -->
                 <div class="col-md-2 consulor-mainrisk">
                  <label for="">Main Risk</label>
                  <select class="form-control" id="main_risk" onchange="PatientType()" disabled>
                    <option selected  value="-"></option>
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
                  <div class="col-sm-2 consulor-subrisk" >
                    <label for="">Sub Risk</label>
                      <select class="form-control" id="sub_risk" disabled >
                      <option selected value="-"></option>
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
                  <div class="col-md-3 consulor-date ">
                    <label  class="form-label">Date Of Birth</label>
                    <div class="input-group mb-3">
                      <input  type="date" id="dob" onblur="dateOfBirth_to_age()" class="form-control reception-dateformat" disabled >
                  </div>
                  </div>
                  <div class="col-md-2 consulor-age" >
                    <label for="validationCustom02" class="form-label">Age(Year)</label>
                    <input type="number" id="agey" onblur="dateOfBirth()" class="form-control" disabled >
                    <div class="valid-feedback">
                      plz put patient age.
                    </div>
                  </div>
                  <div class="col-md-2 consulor-age">
                    <label for="validationCustom02" class="form-label">Age(Month)</label>
                    <input type="number" id="agem" onchange="monthValid()" class="form-control" disabled >
                    <div class="valid-feedback">
                      plz put patient age.
                    </div>
                  </div>
                  <div class="row ">
                    <div class="col-sm-2 consulor-srt" id="state_hide">
                      <label for="">State / Region</label>
                      
                      <select  class="form-select reception-select"  id="state"  required onchange="region(this.value)">
                        <option selected  value="-"></option>
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
                    <div class="col-sm-2 consulor-srt" id="township_hide">
                      <label for="">Township</label>
                      
                        <select class="form-select reception-select" id="township"   >
                          <option id="tt_opt"></option>
                          <option selected  value="-"></option>
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
                    <div class="col-md-2 consulor-srt"id="quarter_hide">
                      <label for="">Ward/Village(detail)</label>
                      <input type="text" id="quarter"  class="form-control" required >
                    </div>
                    <div class="col-sm-2 consulor-srt" id="phone_hide">
                      <label for="">Phone No.1</label>
                      <div>
                        <input id="phone" class="form-control"  type="text" name="" placeholder="09123459789" >
                      </div>
                    </div>
                    <div class="col-sm-2 consulor-srt" id="phone2_hide" >
                      <label for="">Phone No.2</label>
                      <div>
                        <input id="phone2" class="form-control"  type="text" name="" placeholder="09123459789" >
                      </div>
                    </div>
                    <div class="col-sm-2 consulor-srt"id="phone3_hide" >
                      <label for="">Phone No.3</label>
                      <div>
                        <input id="phone3" class="form-control" type="text" name="" placeholder="09123459789" >
                      </div>
                    </div>

                  </div>
                  <div class="col-md-3">
                    <button type="button" id="riskUpdate" onclick="riskUpdate()" class="btn btn-warning update-batton " style="display:none" >Only Patient Info_Update</button>
                  </div>
                 
                </div>


              
              <br>
              <div class="counselling_test">
                  <!-- <div class="row">
                    <div class="col-md-3" id="hts-onOff">
                      <label class="switch" style="float:left;">
                        <input type="checkbox" checked id="switch_toggle" onchange="switchToggle()">
                        <span class="slider round"></span>
                      </label>
                      <label>HTS Entry On/Off</label>
                    </div>
                  </div> -->
                  <div class="row hts-entry"> <!--service -->
                    <div class="col-md-2 consulor-srt consulor-switch">
                      <label for="">Service Modality</label>
                      <select class="form-select"onchange="Service_Modality()" id="service"required>
                        <option selected  value="-" ></option>
                        <option value="Community">Community</option>
                        <option value="Facility">Facility</option>
                      </select>
                    </div>
                    <div class="col-md-2 consulor-srt consulor-switch">
                      <label for="">Mode of Entry</label>
                      <select class="form-select" id="m_o_entry"required>
                        <option selected  value="-"></option>
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
                    <div class="col-md-2 consulor-srt consulor-switch">
                      <label for="">New/Old</label>
                      <select class="form-select" id="new_old"required>
                        <option selected  value="-"></option>
                        <option value="New">New</option>
                        <option value="Old">Old</option>
                      </select>
                    </div>
                    <div class="col-md-2 consulor-srt consulor-switch">
                      <label for="">Test Location</label>
                      <select class="form-select" id="lab_location" onchange="Lab_locate()">
                        <option selected  value="clinic_lab">Clinic Lab</option>
                        <option value="self_test">Self test</option> 
                        <option value="cbs">Cbs</option> 
                        <option value="privite">Privite</option>
                       
                      </select>
                    </div>
                  </div>
                  <div class="row hts-entry">
                    <div class="col-sm-5 consulor-result consulor-switch"><!--HIV -->
                      <div class="row">
                        <label >HIV Test Results</label>
                        <div class="input-group mb-2 no-margin">
                          <div class="input-group-prepend no-margin">
                            <span class="input-group-text">Date</span>
                          </div>
                          <input type="date"  id="hiv_test_date"  class="form-control" required>
                          <div class="input-group-prepend no-margin">
                            <button onclick="hiv_test_date()" class="input-group-text">Fetch</button>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-3">
                          <label>Determine</label>
                          <select onchange="determineResult()" class="form-control"id="d_result" name="" disabled >
                            <option value=""></option>
                            <option value="Reactive">Reactive</option>
                            <option value="Non Reactive">Non Reactive</option>
                            <option value="Invalid">Invalid</option>
                          </select>
                        </div>
                        <div class="col-md-3">
                          <label>Uni-Gold</label>
                          <select class="form-control" onchange="hiv_uni_result()" id="uni_result" name="" disabled >
                            <option id="uni_bl" value=""></option>
                            <option value="Reactive">Reactive</option>
                            <option value="Non Reactive">Non Reactive</option>
                            <option value="Invalid">Invalid</option>
                          </select>
                        </div>
                        <div class="col-md-3">
                          <label>STAT-PAK</label>
                          <select class="form-control" onchange="hiv_result_cal()" id="stat_result" name="" disabled >
                            <option id="stat_bl" value=""></option>
                            <option value="Reactive">Reactive</option>
                            <option value="Non Reactive">Non Reactive</option>
                            <option value="Invalid">Invalid</option>
                          </select>
                        </div>
                        <div class="col-md-3">
                          <label>Final Result</label>
                          <select class="form-control"id="final_result" disabled>
                            <option value=""></option>
                            <option id="Positive" value="Positive">Positive</option>
                            <option id="Negative" value="Negative">Negative</option>
                            <option id="Inconclusive" value="Inconclusive">Inconclusive</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    
                    <div class="col-sm-3 consulor-result consulor-switch">
                      <div class="row">
                        <label>Hepatitis Test Results</label>
                        <div class="input-group mb-2">
                          <div class="input-group-prepend no-margin">
                            <span class="input-group-text">Date</span>
                          </div>
                          <input type="date"  id="hep_date"  class="form-control" required>
                          <div class="input-group-prepend no-margin">
                            <button onclick="hepB_test_date()" class="input-group-text">Fetch</button>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <label>HBsAg</label>
                          <select class="form-control" id="B_result" disabled >
                            <option value=""></option>
                            <option value="Positive">Positive</option>
                            <option value="Negative">Negative</option>
                          </select>
                        </div>
                        <div class="col-md-6">
                          <label>HCV Ab</label>
                          <select class="form-control" id="C_result" disabled >
                            <option value=""></option>
                            <option value="Positive">Positive</option>
                            <option value="Negative">Negative</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-4 consulor-result consulor-switch">
                      <div class="row">
                        <label>Syphillis Test Results</label>
                        <div class="input-group mb-2">
                          <div class="input-group-prepend no-margin">
                            <span class="input-group-text">Date</span>
                          </div>
                          <input type="date"  id="syp_date"  class="form-control" required>
                          <div class="input-group-prepend no-margin">
                            <button onclick="Rrp_test_date()" class="input-group-text">Fetch</button>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-4">
                          <label>RDT</label>
                          <select class="form-control" id="Sy_rdt_result" disabled >
                            <option value=""></option>
                            <option value="Positive">Positive</option>
                            <option value="Negative">Negative</option>
                          </select>
                        </div>
                        <div class="col-md-4">
                          <label>RPR</label>
                          <select class="form-control" id="qualitative" disabled >
                            <option value=""></option>
                            <option value="Reactive">Reactive</option>
                            <option value="Non Reactive">Non Reactive</option>
                          </select>
                        </div>
                        <div class="col-md-4">
                          <label>VDRL</label>
                          <input id="syp_vdrl" class="form-control" type="text" name="" value="" disabled>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row counHTS-prepost">
                    <div class="col-md-2 counselling-prePost" >

                      <div class="">
                        <input type="checkbox" id="pre" class="con-prepost "  ><span style="background-color: #0F6292;">Pre-test Counselling</span>
                      </div>
                      <div class="">
                        <input type="checkbox" id="post" class="con-prepost"  ><span style="background-color: #0F6292;">Post-test Counselling</span>
                      </div>

                    </div>
                    <div class="col-md-2 consulor-srt "id="hts_test_done_hide">
                      <label for="">HTS Testing</label>
                      <select class="form-select" onchange="reason()" id="hts_test_done"required>
                        <option value="Yes">Yes</option>
                        <option value="No" selected>No</option>
                      </select>
                    </div>
                    <div class="col-md-2 consulor-srt "id="hts_test_no_reason_hide">
                      <label for="">Reason</label>
                      <select class="form-select"onchange="" id="hts_test_no_reason"required>
                        <option selected  value="-" ></option>
                        <option value="KC">KC</option>
                        <option value="OVP">OVP</option>
                        <option value="Denied">Client Denied</option>
                      </select>
                    </div>
                    <div class="col-md-2"id="status_hide">
                      <label for="">Status</label>
                      <select class="form-select"onchange="" disabled id="status">
                        <option selected  value="-" ></option>
                        <option value="Enroll to Clinic">Enroll to Clinic</option>
                        <option value="Refer or Temporary">Refer or Temporary</option>
                        <option value="Client denied">Client denied</option>
                      </select>
                    </div>
                    <div class="col-md-2 " id="prep_hide" >
                      <div class="consulor-prepCounseling">
                      <input type="checkbox" id="prep" class="con-prepost"  ><span style="background-color: #0F6292;">PrEP Counselling</span>
                      </div>
                    </div>
                    <div class="col-md-2 "id="prep_status_hide">
                      <label for="">PrEP Status</label>
                      <select class="form-select"onchange="" id="prep_status"required>
                        <option selected  value="-" ></option>
                        <option value="Initiate_Enroll">InitiateEnroll to Clinic</option>
                        <option value="Follow_Up">Follow Up</option>
                        <option value="Restart">Restart</option>
                        <option value="Stop">Stop</option>
                      </select>
                    </div>
                  </div>
                  <br class="pc">
                  <div class="row counselling-type">
                      <h3 id="toc_title_hide" class="header-text">Type of Counselling</h3>
                        <div class="form-check-inline col-sm-1"id="c1_hide">
                            <label class="form-check-label">
                              <input type="checkbox" class="form-check-input" id="c1" value="">C1
                            </label>
                        </div>
                        <div class="form-check-inline col-sm-1" id="c2_hide">
                            <label class="form-check-label">
                              <input type="checkbox" class="form-check-input" id="c2" value="">C2
                            </label>
                        </div>
                        <div class="form-check-inline col-sm-1"id="c3_hide">
                            <label class="form-check-label">
                              <input type="checkbox" class="form-check-input" id="c3" value="">C3
                            </label>
                        </div>
                        <div class="form-check-inline col-sm-1"id="adh_hide">
                            <label class="form-check-label">
                              <input type="checkbox" class="form-check-input" id="adh" value="">ADH
                            </label>
                        </div>
                        <div class="form-check-inline col-sm-1"id="child_adoles_hide">
                            <label class="form-check-label">
                              <input type="checkbox" class="form-check-input" id="child_adoles" value=""> < 15 Adoles-Child
                            </label>
                        </div>
                        <div class="form-check-inline col-sm-1"id="child_dis_hide">
                            <label class="form-check-label">
                              <input type="checkbox" class="form-check-input" id="child_dis" value=""> < 15 Dis-Child
                            </label>
                        </div>
                        <div class="form-check-inline col-sm-1"id="child_adh_hide">
                            <label class="form-check-label">
                              <input type="checkbox" class="form-check-input" id="child_adh" value=""> < 15 ADH-Child
                            </label>
                        </div>
                        <div class="form-check-inline col-sm-1"id="mmt_hide">
                            <label class="form-check-label">
                              <input type="checkbox" class="form-check-input" id="mmt" value=""> MMT
                            </label>
                        </div>
                        <div class="form-check-inline col-sm-1"id="ipt_hide">
                            <label class="form-check-label">
                              <input type="checkbox" class="form-check-input" id="ipt" value=""> IPT
                            </label>
                        </div>
                        <div class="form-check-inline col-sm-1"id="tb_hide">
                            <label class="form-check-label">
                              <input type="checkbox" class="form-check-input" id="tb"value=""> TB
                            </label>
                        </div>

                      <div class="form-check-inline col-sm-1"id="ncd_hide">
                          <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" id="ncd"value=""> NCD
                          </label>
                      </div>
                      <div class="form-check-inline col-sm-1"id="anc_hide" >
                          <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" id="anc" value=""> ANC
                          </label>
                      </div>
                      <div class="form-check-inline col-sm-1"id="pfa_hide">
                          <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" id="pfa" value=""> PFA
                          </label>
                      </div>
                      <div class="form-check-inline col-sm-1"id="phq9_hide">
                          <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" id="phq9" value=""> PHQ9
                          </label>
                      </div>
                      <div class="form-check-inline col-sm-1"id="other_hide">
                          <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" id="other"value=""> Other
                          </label>
                      </div>
                      <div class="form-check-inline col-sm-1" id="eac_hide">
                          <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" id="eac" value=""> EAC
                          </label>
                      </div>
                      <div class="form-check-inline col-sm-1"id="hmt_hide">
                          <label class="form-check-label">
                            <input type="checkbox" class="form-check-input"id="hmt" value="">FHT
                          </label>
                      </div>
                      <div class="form-check-inline col-sm-1"id="c_p_case_hide">
                          <label class="form-check-label">
                            <input type="checkbox" class="form-check-input"id="c_p_case" value=""> C P case
                          </label>
                      </div>
                      <div class="form-check-inline col-sm-1"id="pmtct_hide">
                          <label class="form-check-label">
                            <input type="checkbox" class="form-check-input"id="pmtct" value=""> PMTCT
                          </label>
                      </div>
                    </div>

                  <br>
                  <div class='row' >

                    <div class="col-sm-2 tablet-pc" >
                      <button type="button" id="saveBton" onclick="Save()" class="btn btn-warning update-batton ">Save</button>
                    </div>
                    <div class="col-sm-2" >
                      <button type="button" id="updateBton" style="display:none;" onclick="updateHTS()" class="btn btn-warning update-batton ">Update</button>
                    </div>
                    <div class="col-md-6 ">
                      <label style="color:yellow;"  id="responseText">With Lab Risk Data Updated</label>
                    </div>
                  </div>
              </div>
            
        </div><br>
      </div>
      <div class="tab-pane container containers cosulor-parent-div" id="second">
        <div>
          <div>
              <h2 class="header-text">HTS Data Update Section</h2>
          </div>
        </div><br>

              <div class="row ">
                <div class="col-sm-2 search-type">
                  <label>Date or ID search</label>
                  <select class="form-control" id="search_type" onchange="type_Search()">
                    <option selected value="date_type">Date</option>
                    <option value="id_type">ID</option>
                  </select>
                </div>
                <div class="col-sm-2 update-counHts">
                  <label>Counselling/HTS</label>
                  <select class="form-control" id="update_type" onchange="updated_type()">
                    <option selected value="upd_counsel">Counselling Updated</option>
                    <option value="upd_HTS">HTS_Updated</option>
                  </select>
              </div>
              </div>
             
              
              <div class="row date_typeRow">
                <div class="col-sm-1 counHTS-Formtext ">
                  <label for="validationCustom01" class="form-label HTS-label">From</label>
                </div>
                <div class="col-sm-2 counHTS-date">
                  <input id="dateFrom" type="date" autofocus class="form-control" >
                </div>
                <div class="col-sm-1 counHTS-Totext">
                  <label for="validationCustom01" class="form-label HTS-label">To</label>
                </div>
                <div class="col-sm-2 counHTS-date">
                  <input id="dateTo" type="date"  class="form-control" >
                </div>
                <div class="col-md-2 id_searchType " style="display:none">
                  <input type="text" class="form-control" autofocus="" id="sid" placeholder="General ID ">
                </div>
                <div class="col-sm-1 no-margin">
                  <button type="button" id="updateBton" onclick="HTS_list()" class="btn btn-primary counHTS-show ">Show</button>
                </div>
              </div>
              <div class="row justify-content-center appointment-table">
                <h4 id='total_len'></h4>
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th >Serial</th>
                      <th class="tablet-pc">Row N0.</th>
                      <th>General ID</th>
                      <th>Fuchia ID</th>
                      <th>Date</th>
                      <!-- <th>Main Risk</th>
                      <th>Sub Risk</th>
                      <th>HIV Final Result</th>
                      <th>New / Old</th> -->
                      <th class="tablet-pc">To Update</th>
                    </tr>
                  </thead>
                  <tbody id='list'>
                  </tbody>
                </table>
              </div>
      </div>
      <div class="tab-pane container cosulor-parent-div " id="third">
        <h1>Third</h1>
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
  let General_ID=0; let Fuchia_ID =0; let Gender=""; let Age=0; let hts_row_address=0;
  let resp=0;
  let address=0;
  let updatedType = 1;//updated list show counselling Only

function Lab_locate(){
  var lab_located=$("#lab_location").val();
  if(lab_located=="clinic_lab"||lab_located=="self_test"||lab_located=="cbs"){
    $("#d_result,#uni_result,#stat_result,#final_result,#B_result,#C_result,#Sy_rdt_result,#qualitative,#syp_vdrl").prop("disabled",true);
  }else{
    $("#d_result,#uni_result,#stat_result,#final_result,#B_result,#C_result,#Sy_rdt_result,#qualitative,#syp_vdrl").prop("disabled",false);
  }
}  

function riskChangeLab() {
 
  if($("#riskChangeLab").val() =="Yes"){
    $(".labTest-date").show();
    $("#main_risk,#sub_risk").prop("disabled",false)
  }else {
    $(".labTest-date").hide();
    $("#main_risk,#sub_risk").prop("disabled",true)
  }
}

function custom_alert(){
 
  $(".cosulor-parent-div").removeClass('freeze-body');
  $("#customAlertBox").hide();
  $("#hts_warining").hide();
  location.reload(true);


}

function testDo()  {
  var test_do=$("#test_do").val();
  console.log(test_do);
  if(test_do=="counsel_info"){
    
    $(".counselling_test").show();
    $("#riskUpdate").hide();
    $(".conunselling_type").show();
    Counselling_Count();
    

  }else {
    $(".counselling_test").hide();
    $("#riskUpdate").show();
    $(".conunselling_type").hide();
    $("#labTestDate").prop("disabled",false);

  }
}
function type_Search() {
  var s_type=$("#search_type").val();
  if(s_type=="id_type"){
    $(".counHTS-Formtext,.counHTS-date,.counHTS-Totext,.counHTS-date").hide();
    $(".id_searchType").show();
    $("#dateFrom").val("");
    $("#dateTo").val("");
  }else {
    $(".counHTS-Formtext,.counHTS-date,.counHTS-Totext,.counHTS-date").show();
    $(".id_searchType").hide();
    $(".id_searchType").val("");
  }
}

function updated_type() {
  var update_HTScoun=$("#update_type").val();
  if(update_HTScoun=="upd_counsel") {
    updatedType = 1;//updated list show counselling Only
    $("#update_type").css("background-color","#20c997");
    
  }else {
    updatedType = 0;//updated list show HTs
    $("#update_type").css("background-color","#ffc107");
  }
}
 
 
function HTS_list(){
    /*
    // For Date
    var date = new Date();
    var day = date.getDate();
    var month = date.getMonth() + 1;
    var year = date.getFullYear();
    if (month < 10) month = "0" + month;
    if (day < 10) day = "0" + day;
    var today = year + "-" + month + "-" + day;
    document.getElementById('vDate').value = today;
    */
    var listShow = 1;
    var search_ID=$("#sid").val();
    var dateFrom =document.getElementById('dateFrom').value;
    dateFrom = formatDate(dateFrom); // date FormatChange YYYY/MM/DD
    var dateTo =document.getElementById('dateTo').value;
    dateTo = formatDate(dateTo); // date FormatChange YYYY/MM/DD
    console.log(search_ID);
    console.log(updatedType);
    var ckdata = {
                    dateFrom:dateFrom,
                    dateTo:dateTo,
                    listShow:listShow,
                    search_ID:search_ID,
                    updatedType:updatedType,

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
          $("#list").empty();
          $(".appointment-table p").empty();
          console.log(response);
          resp = response;
          if(response!="no data"){
            for (var i = 0; i < response[0].length; i++) {
              var rowName = "tr_"+i;
              var btnName = "btn_"+i;
              var srNum = i + 1;

              var result_body1 =
              "<tr style='background-color:#A7DBD8; color:#000000;'"+ "id='"+rowName+"'>"
                +"<td id='updateSerial1'>"+srNum+"</td>"
                +"<td class='tablet-pc' >"+response[0][i]['id']+"</td>"
                +"<td id='col_3'>"+response[0][i]['Pid']+"</td>"
                +"<td>"+response[0][i]['FuchiaID']+"</td>"
                +"<td >"+(response[0][i]['Counselling_Date'])+"</td>"
                //  +"<td >"+response[0][i]['Main Risk']+"</td>"
                //  +"<td>"+response[0][i]['Sub Risk']+"</td>"
                //  +"<td>"+response[0][i]['HIV_Final_Result']+"</td>"
                //  +"<td>"+response[0][i]['New_Old']+"</td>"
                +"<td class= tablet-pc id='"+btnName+"'>"+"<a data-toggle='tab'  href='#first' onclick='updateFiller()'  >"+ "Update"+"</a>"+"</td>"
              +"</tr>";
              $("#list").append(result_body1);
            }
          }else {
             var result_body1 = "<p class='no-updateData'>Patient Does Not Have In This Date Please Choice Correct Date</p>"
             $(".appointment-table").append(result_body1);
          }
          

          }
        });
    } // to show HTS data rows
function updateFiller(){
  
      

      $("#firstPage").addClass("active");
      $("#secondPage").removeClass("active");
      // $("#test_do").val("counsel_info").prop("selected", true);
      // testDo();
      $("#main_risk,#sub_risk").prop("disabled",false)

      $("#saveBton").hide();
      $("#labTestDate").hide();
      $("#updateBton").show();
      $(".conunselling_type,.do-test,.change-risk").hide();
      $(".counselling-type input[type='checkbox']").each(function(index) {
      $(this).addClass( "chk" + (index + 1));
    })
      

      var parent = event.target.parentElement.id;// collecting id of the targeted parent
      var coparent = document.getElementById(parent).parentElement.id;// collecti
       address = document.getElementById(coparent).childNodes[1].innerHTML;
      var id      = document.getElementById(coparent).childNodes[2].innerHTML;
      var res_date      = document.getElementById(coparent).childNodes[4].innerHTML;
      // to global variable

      var decryptFetch=1;
      var search_ID=$("#sid").val();
      var dateFrom =document.getElementById('dateFrom').value;
      dateFrom = formatDate(dateFrom); // date FormatChange YYYY/MM/DD
      console.log(dateFrom);
      var dateTo =document.getElementById('dateTo').value;
      dateTo = formatDate(dateTo); // date FormatChange YYYY/MM/DD
      console.log(dateTo);
      console.log(search_ID+"search");
      var data = {
        dateFrom:dateFrom,
        dateTo:dateTo,
        address:address,
        decryptFetch:decryptFetch,
        id:id,
        res_date:res_date,
        search_ID:search_ID,
        updatedType:updatedType,
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
          data: JSON.stringify(data),
          success:function(response){
            $('.consulor-switch').hide();
            console.log(response);
            hts_row_address = address;
            console.log(hts_row_address);
            var Pid = response[0];
              General_ID=response[0];// to global varriable
            var FuchiaID = response[1];
              Fuchia_ID=response[1];// to global varriable
            var Sex = response[10];
              Gender =response[10];// to global varriable

            document.getElementById("gen_data").innerHTML =
              "General ID :"+ Pid+",&nbsp;&nbsp;&nbsp;&nbsp;"+
              //+
               "Fuchia ID :"+ FuchiaID +",&nbsp;&nbsp;&nbsp;&nbsp;"+
              // "Name :"+ response[1]+",&nbsp;&nbsp;&nbsp;&nbsp;"+
               "Sex :"+ Sex +",&nbsp;&nbsp;&nbsp;&nbsp;";
              // "Age(yr) :"+ response[2] +",&nbsp;&nbsp;&nbsp;&nbsp;";
              // "Age(m) :"+ Agem +",&nbsp;&nbsp;&nbsp;&nbsp;"+
              // "Region :"+ Region +",&nbsp;&nbsp;&nbsp;&nbsp;"+
              // "Township :"+ Township;
            $("#gid").val(response[0]);
            $("#gid").prop("disabled",true);
              
              $("#agey").val(response[2]);
              Age = response[2];// to global varriable
              $("#vDate").val(response[6]);
              $("#counsellor").val(response[11]);
              $("#state").val(response[29]);
              region();
              $("#township").val(response[30]);
              $("#quarter").val(response[28]);
              $("#phone").val(response[25]);
              $("#phone2").val(response[26]);
              $("#phone3").val(response[27]);


              if(response[3]==1){
                document.getElementById("pre").checked="true";
              }
              if(response[4]==1){
                document.getElementById("post").checked="true";
              }



              $("#main_risk").val(response[14]);
              $("#sub_risk").val(response[15]);
              if(updatedType==0){
                $('.consulor-switch').show();

                      var new_old = response[5];

                      toString(new_old);
                      if(new_old>300000){
                        new_old="New";
                          $("#new_old").val("New");
                      }else{
                        $("#new_old").val("Old");
                      }
                      $("#hiv_test_date").val(response[7]);
                      $('#d_result').val(response[16]);
                      $('#uni_result').val(response[17]);
                      $('#stat_result').val(response[18]);
                      $('#final_result').val(response[19]);


                      $("#syp_date").val(response[8]);
                      $('#Sy_rdt_result').val(response[20]);
                      $('#qualitative').val(response[21]);

                      $("#hep_date").val(response[9]);
                      $('#B_result').val(response[23]);
                      $('#C_result').val(response[24]);

                      $("#service").val(response[12]);
                      $("#m_o_entry").val(response[13]);

              }

             
              
              if($('#d_result').val !="" && $('#final_result').val!="" ){
                $("#hts_test_done").val("Yes").prop("selected", true);
              }
              $("#hts-search").prop("disabled", true);
              $("#updateBton").prop("disabled", false);
              
               var data_fillNO=1;
               for(var check=37;check<56;check++){
                if(response[check]==1){
                  $(".chk"+data_fillNO).prop("checked", true);
                }
                data_fillNO++;

               } //fill type of counselling
               if(response[36]==1){
                $("#prep").prop("checked", true);
               }
               $("#hts_test_no_reason").val(response[34]);
               $("#status").val(response[35]);
               $("#prep_status").val(response[33]);





             
            }
          });
          DateTo_text();
      } // filling data to HTS register
function updateHTS(){
          var htsUpdate= 1;
          console.log(address+"primary key");

          var clinic_code = 81;
          var pid=$("#gid").val();
          var Counselling_Date = document.getElementById("vDate").value;
          Counselling_Date = formatDate(Counselling_Date); // date FormatChange YYYY/MM/DD

          var Main_Risk = document.getElementById("main_risk").value;
          if(Main_Risk.length<1){
            Main_Risk="-";
          }
          var Sub_Risk = document.getElementById("sub_risk").value;
          if(Sub_Risk.length<1){
            Sub_Risk="-";
          }

          var Counsellor = document.getElementById("counsellor").value;
          var state = document.getElementById("state").value;
          if(state.length<1){
          state="-";
          }
          var township = document.getElementById("township").value;
          if(township.length<1){
            township="-";
          }
          var quarter = document.getElementById("quarter").value;
          if(quarter.length<1){
            quarter="-";
          }
          var phone = document.getElementById("phone").value;
          if(phone.length<1){
            phone="-";
          }
          var phone2 = document.getElementById("phone2").value;
          if(phone2.length<1){
            phone2="-";
          }
          var phone3 = document.getElementById("phone3").value;
          if(phone3.length<1){
            phone3="-";
          }
          var service = document.getElementById("service").value;
          if(service.length<1){
            service="-";
          }
          var mode_of_entry = document.getElementById("m_o_entry").value;
          if(mode_of_entry.length<1){
            mode_of_entry="-";
          }
          var new_old = document.getElementById("new_old").value;
          if(new_old.length<1){
            new_old="-";
          }
      var hiv_test_date = document.getElementById("hiv_test_date").value;
      hiv_test_date = formatDate(hiv_test_date); // date FormatChange YYYY/MM/DD
      if(hiv_test_date.length<1){
        hiv_test_date="-";
      }
      var hiv_determine = document.getElementById("d_result").value;
      if(!hiv_determine.length){
        hiv_determine="-";
      }else{
        console.log("hello hiv determine");
        $("#hts_test_done").val("Yes").prop("selected", true);
        var HTSdone = document.getElementById("hts_test_done").value;
        console.log(HTSdone);
      }
     
      var hiv_unigold = document.getElementById("uni_result").value;
      if(hiv_unigold.length<1){
        hiv_unigold="-";
      }
      var hiv_stat = document.getElementById("stat_result").value;
      if(hiv_stat.length<1){
        hiv_stat="-";
      }
      var hiv_final = document.getElementById("final_result").value;
      if(hiv_final.length<1){
        hiv_final="-";
      }

      var syp_date = document.getElementById("syp_date").value;
      syp_date = formatDate(syp_date); // date FormatChange YYYY/MM/DD
      if(syp_date.length<1){
        syp_date="-";
      }
      var syp_rdt = document.getElementById("Sy_rdt_result").value;
      if(syp_rdt.length<1){
        syp_rdt="-";
      }
      var syp_rpr = document.getElementById("qualitative").value;
      if(syp_rpr.length<1){
        syp_rpr="-";
      }
      var syp_vdrl = document.getElementById("syp_vdrl").value;
      if(syp_vdrl.length<1){
        syp_vdrl="-";
      }

      var hep_date = document.getElementById("hep_date").value;
      hep_date = formatDate(hep_date); // date FormatChange YYYY/MM/DD
      if(hep_date.length<1){
        hep_date="-";
      }
      var hep_b = document.getElementById("B_result").value;
      if(hep_b.length<1){
        hep_b="-";
      }
      var hep_c = document.getElementById("C_result").value;
      if(hep_c.length<1){
        hep_c="-";
      }
      var HTSdone = document.getElementById("hts_test_done").value;
            
      var Reason = document.getElementById("hts_test_no_reason").value;
      var Status = document.getElementById("status").value;
      var PrEP_Status = document.getElementById("prep_status").value;

      var PrEP = document.getElementById("prep").checked;
      if(PrEP == true){
        PrEP = 1;
      }else{  PrEP = 0;}
      var Pre = document.getElementById("pre").checked;
      if(Pre==true){
        Pre = 1;
      }else{Pre=0;}
      var Post = document.getElementById("post").checked;
      if(Post == true){
        Post = 1;
      }else{Post = 0;}
      var c1 = document.getElementById("c1").checked;
      if(c1 == true){
        c1 = 1;
      }else{  c1 = 0;}
      var c2 = document.getElementById("c2").checked;
      if(c2 == true){
        c2 = 1;
      }else{  c2 = 0;}
      var c3 = document.getElementById("c3").checked;
      if(c3 == true){
        c3 = 1;
      }else{  c3 = 0;}
      var adh = document.getElementById("adh").checked;
      if(adh == true){
        adh = 1;
      }else{  adh = 0;}
      var Child_under15_Adoles = document.getElementById("child_adoles").checked;
      if(Child_under15_Adoles == true){
        Child_under15_Adoles = 1;
      }else{  Child_under15_Adoles = 0;}
      var Child_under15_Dis = document.getElementById("child_dis").checked;
      if(Child_under15_Dis == true){
        Child_under15_Dis = 1;
      }else{  Child_under15_Dis = 0;}
      var Child_under15_ADH = document.getElementById("child_adh").checked;
      if(Child_under15_ADH == true){
        Child_under15_ADH = 1;
      }else{  Child_under15_ADH = 0;}
      var mmt = document.getElementById("mmt").checked;
      if(mmt == true){
        mmt = 1;
      }else{  mmt = 0;}
      var ipt = document.getElementById("ipt").checked;
      if(ipt == true){
        ipt = 1;
      }else{  ipt = 0;}
      var tb = document.getElementById("tb").checked;
      if(tb == true){
        tb = 1;
      }else{  tb = 0;}
      var ncd = document.getElementById("ncd").checked;
      if(ncd == true){
        ncd = 1;
      }else{  ncd = 0;}
      var anc = document.getElementById("anc").checked;
      if(anc == true){
        anc = 1;
      }else{  anc = 0;}
      var pfa = document.getElementById("pfa").checked;
      if(pfa == true){
        pfa = 1;
      }else{  pfa = 0;}
      var phq9 = document.getElementById("phq9").checked;
      if(phq9 == true){
        phq9 = 1;
      }else{  phq9 = 0;}
      var Other = document.getElementById("other").checked;
      if(Other == true){
        Other = 1;
      }else{  Other = 0;}
      var eac = document.getElementById("eac").checked;
      if(eac == true){
        eac = 1;
      }else{  eac = 0;}
      var hmt = document.getElementById("hmt").checked;
      if(hmt == true){
        hmt = 1;
      }else{  hmt = 0;}
      var c_p_case = document.getElementById("c_p_case").checked;
      if(c_p_case == true){
        c_p_case = 1;
      }else{  c_p_case = 0;}
      var pmtct = document.getElementById("pmtct").checked;
      if(pmtct == true){
        pmtct = 1;
      }else{  pmtct = 0;}

       
  

        var Updated_data_hts={
       
          htsUpdate:htsUpdate,
          updatedType:updatedType,
          pid: pid,
          Counselling_Date : Counselling_Date,
          Counsellor : Counsellor,
          Main_Risk : Main_Risk,
          Sub_Risk : Sub_Risk,
          state          :state,
          address:address,
             township       :township,
             quarter        :quarter,
             phone          :phone,
             phone2         :phone2,
             phone3         :phone3,

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

             Pre : Pre,
             Post : Post,
             HTSdone : HTSdone,
             Reason : Reason,
             Status : Status,
             PrEP : PrEP ,
             PrEP_Status : PrEP_Status,
             c1 : c1,
             c2 : c2,
             c3 : c3,
             adh : adh,
             Child_under15_Adoles : Child_under15_Adoles,
             Child_under15_Dis : Child_under15_Dis,
             Child_under15_ADH : Child_under15_ADH,
             mmt : mmt,
             ipt : ipt,
             tb : tb,
             ncd : ncd,
             anc : anc,
             pfa : pfa,
             phq9 : phq9,
             Other : Other,
             eac : eac,
             hmt : hmt,
             c_p_case : c_p_case,
             pmtct:pmtct,
          };
         
   console.log(Updated_data_hts);
   

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
                 data: JSON.stringify(Updated_data_hts),
                 success:function(response){
                  console.log(response);
                  var resp =response[0];
                switch(resp) {
                case 2.1:alert("Do not test in HIV(or)RPR,(or)Hebc");break;
                case 2.3:alert("do not have In Hts Data");break;
                case 2.4:alert("do not have counselling_record data");break;
                case 1: $('html, body').animate({ scrollTop: 0 }, 'fast');
                        $("#customAlertBox").show();
                        $(".cosulor-parent-div").addClass('freeze-body');;break;
                
                }

               if(resp.length>5){
                $("#responseText").empty();
                var test_name=["Viral Load","Covid","Afb","Stool","General","OI","Sti","Urine","RPR","Hebc","Hiv"];
                var mesage_result="";
                
                
                for(var up_res=0;up_res<response[0].length;up_res++){
                  $("#responseText").empty();
                  if(response[0][up_res]==true){
                    
                   var mesage_result=mesage_result.concat("",test_name[up_res]+"/");
                  }
                }
                $("#responseText").text(mesage_result+"Updated ");
                alert("Successfully Updated in HTS Lab and Other table in Risk")
               }

                  
                  
                   }
                 });

} // to updata data in HTS register

// function riskUpdate(){
//   //var agey = document.getElementById("agey").value;
//   var gid = document.getElementById("gid").value;
//   var Main_Risk = document.getElementById("main_risk").value;
//   var Sub_Risk = document.getElementById("sub_risk").value;
//   var risk_age_update = 1;
//   var data={
//     risk_age_update:risk_age_update,
//     //agey:agey,
//     gid:gid,
//     Main_Risk:Main_Risk,
//     Sub_Risk:Sub_Risk,
//   };
//   console.log(data);
//   $.ajaxSetup({
//       headers: {
//           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
//        }
//      });
//   $.ajax({
//       type:'POST',
//       url:"{{route('counsellor_room')}}",
//       dataType:'json',
//       contentType: 'application/json',
//       data: JSON.stringify(data),
//       success:function(response){

//         console.log(response);
//         alert("We updataed the Risk information and age.");
//         location.reload();
//         }
//       });
// }

function riskUpdate(){   //Only Patient Info
  //var agey = document.getElementById("agey").value;
  dateOfBirth()

  
  var cdate = document.getElementById("vDate").value;
  cdate =formatDate(cdate);
 
  

  var risk_changeDate= document.getElementById("labTestDate").value;
  console.log(risk_changeDate+"hi risk first change")
  if(risk_changeDate!=""){
    risk_changeDate =formatDate(risk_changeDate);
  }
  console.log(risk_changeDate+"hi risk change")
  
  var state = document.getElementById("state").value;
      if(state.length<1){
        state="-";
      }
      var township = document.getElementById("township").value;
      if(township.length<1){
        township="-";
      }
      var quarter = document.getElementById("quarter").value;
      if(quarter.length<1){
        quarter="-";
      }
      var phone = document.getElementById("phone").value;
      if(phone.length<1){
        phone="-";
      }
      var phone2 = document.getElementById("phone2").value;
      if(phone2.length<1){
        phone2="-";
      }
      var phone3 = document.getElementById("phone3").value;
      if(phone3.length<1){
        phone3="-";
      }
      var Main_Risk = document.getElementById("main_risk").value;
      if(Main_Risk.length<1){
        Main_Risk="-";
      }
      var Sub_Risk = document.getElementById("sub_risk").value;
      if(Sub_Risk.length<1){
        Sub_Risk="-";
      }
      var Agey = document.getElementById("agey").value;
      var Agem=0;
      if(!Agey){
        Agey="0";
        Agem= document.getElementById("agem").value;
      }
  var gid = document.getElementById("gid").value;
  var pt_data_update = 1;
  var risk_data={
    pt_data_update:pt_data_update,
    cdate:cdate,
    //agey:agey,
    gid:gid,
    Main_Risk:Main_Risk,
    Sub_Risk:Sub_Risk,
    state          :state,
    township       :township,
    quarter        :quarter,
    phone          :phone,
    phone2         :phone2,
    phone3         :phone3,
    Agey           :Agey,
    Agem           :Agem,
    Date_of_Birth:ddDate,
    risk_changeDate:risk_changeDate                
  };
  console.log(risk_data);
 
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
             data: JSON.stringify(risk_data),
             success:function(response){
               console.log(response);
              
                alert(" Patientdata has been Updated.");

               
               
              //  location.reload(true);// to refresh the page
              //document.getElementById('regbutton').disabled=false;
             }
          });

}

function Counselling_Count() {
 if( $("#coun_count").val()=="one"){
  $("#responseText").text("Without Lab Data");
  $("#labTestDate").prop("disabled",true);
  $("#hts-onOff").hide();
  $(".consulor-switch").hide();
 }else{
   $("#responseText").text("With Lab Risk Data Updated");
   $("#labTestDate").prop("disabled",false);
   $("#hts-onOff").show();
   $(".consulor-switch").show();
   
 }

}




// function Save(){
//     var switch_ck  = document.getElementById("switch_toggle").checked;
//     console.log(switch_ck+"switch");
//     dateOfBirth();
//     console.log(ddDate+"hello date of birth");

//     if(switch_ck == false){
//       console.log(switch_ck+"hello switch");

//             var both_hts_coun = 1;

//             var clinic_code = 81;

//             var Pid = resp[0]["Pid"];
//             var FuchiaID = resp[0]["FuchiaID"];
//             var PrEPCode = resp[0]["PrEPCode"];
//             var Gender = resp[10];

//             var Agey = resp[0]["Agey"];

//             var Agem = resp[0]["Agem"];
//             var dob = resp[9];
//             if(resp[9]==null){
//               var date = new Date();
//               var year = date.getFullYear();

//               var calYear = year - Agey ;
//               var calDob = calYear + "-" + "6" + "-" + "15";
//               console.log(calDob);
//             }else{
//               var calDob = resp[9];
//             }


//             var Counselling_Date = document.getElementById("vDate").value;
//             Counselling_Date = formatDate(Counselling_Date); // date FormatChange YYYY/MM/DD
//             var Counsellor = document.getElementById("counsellor").value;
//             var Main_Risk = document.getElementById("main_risk").value;
//             var Sub_Risk = document.getElementById("sub_risk").value;


//             var HTSdone = document.getElementById("hts_test_done").value;
            
//             var Reason = document.getElementById("hts_test_no_reason").value;
//             var Status = document.getElementById("status").value;
//             var PrEP_Status = document.getElementById("prep_status").value;


//       var state = document.getElementById("state").value;
//       if(state.length<1){
//         state="-";
//       }
//       var township = document.getElementById("township").value;
//       if(township.length<1){
//         township="-";
//       }
//       var quarter = document.getElementById("quarter").value;
//       if(quarter.length<1){
//         quarter="-";
//       }
//       var phone = document.getElementById("phone").value;
//       if(phone.length<1){
//         phone="-";
//       }
//       var phone2 = document.getElementById("phone2").value;
//       if(phone2.length<1){
//         phone2="-";
//       }
//       var phone3 = document.getElementById("phone3").value;
//       if(phone3.length<1){
//         phone3="-";
//       }
//       var Main_Risk = document.getElementById("main_risk").value;
//       if(Main_Risk.length<1){
//         Main_Risk="-";
//       }
//       var Sub_Risk = document.getElementById("sub_risk").value;
//       if(Sub_Risk.length<1){
//         Sub_Risk="-";
//       }
//       var service = document.getElementById("service").value;
//       if(service.length<1){
//         service="-";
//       }
//       var mode_of_entry = document.getElementById("m_o_entry").value;
//       if(mode_of_entry.length<1){
//         mode_of_entry="-";
//       }
//       var new_old = document.getElementById("new_old").value;
//       if(new_old.length<1){
//         new_old="-";
//       }

//       var hiv_test_date = document.getElementById("hiv_test_date").value;
//       hiv_test_date = formatDate(hiv_test_date); // date FormatChange YYYY/MM/DD
//       if(hiv_test_date.length<1){
//         hiv_test_date="-";
//       }
//       var hiv_determine = document.getElementById("d_result").value;
//       if(!hiv_determine.length){
//         hiv_determine="-";
//       }else{
//         console.log("hello hiv determine");
//         $("#hts_test_done").val("Yes").prop("selected", true);
//         var HTSdone = document.getElementById("hts_test_done").value;
//         console.log(HTSdone);
//       }
     
//       var hiv_unigold = document.getElementById("uni_result").value;
//       if(hiv_unigold.length<1){
//         hiv_unigold="-";
//       }
//       var hiv_stat = document.getElementById("stat_result").value;
//       if(hiv_stat.length<1){
//         hiv_stat="-";
//       }
//       var hiv_final = document.getElementById("final_result").value;
//       if(hiv_final.length<1){
//         hiv_final="-";
//       }

//       var syp_date = document.getElementById("syp_date").value;
//       syp_date = formatDate(syp_date); // date FormatChange YYYY/MM/DD
//       if(syp_date.length<1){
//         syp_date="-";
//       }
//       var syp_rdt = document.getElementById("Sy_rdt_result").value;
//       if(syp_rdt.length<1){
//         syp_rdt="-";
//       }
//       var syp_rpr = document.getElementById("qualitative").value;
//       if(syp_rpr.length<1){
//         syp_rpr="-";
//       }
//       var syp_vdrl = document.getElementById("syp_vdrl").value;
//       if(syp_vdrl.length<1){
//         syp_vdrl="-";
//       }

//       var hep_date = document.getElementById("hep_date").value;
//       hep_date = formatDate(hep_date); // date FormatChange YYYY/MM/DD
//       if(hep_date.length<1){
//         hep_date="-";
//       }
//       var hep_b = document.getElementById("B_result").value;
//       if(hep_b.length<1){
//         hep_b="-";
//       }
//       var hep_c = document.getElementById("C_result").value;
//       if(hep_c.length<1){
//         hep_c="-";
//       }



//       var PrEP = document.getElementById("prep").checked;
//       if(PrEP == true){
//         PrEP = 1;
//       }else{  PrEP = 0;}
//       var Pre = document.getElementById("pre").checked;
//       if(Pre==true){
//         Pre = 1;
//       }else{Pre=0;}
//       var Post = document.getElementById("post").checked;
//       if(Post == true){
//         Post = 1;
//       }else{Post = 0;}
//       var c1 = document.getElementById("c1").checked;
//       if(c1 == true){
//         c1 = 1;
//       }else{  c1 = 0;}
//       var c2 = document.getElementById("c2").checked;
//       if(c2 == true){
//         c2 = 1;
//       }else{  c2 = 0;}
//       var c3 = document.getElementById("c3").checked;
//       if(c3 == true){
//         c3 = 1;
//       }else{  c3 = 0;}
//       var adh = document.getElementById("adh").checked;
//       if(adh == true){
//         adh = 1;
//       }else{  adh = 0;}
//       var Child_under15_Adoles = document.getElementById("child_adoles").checked;
//       if(Child_under15_Adoles == true){
//         Child_under15_Adoles = 1;
//       }else{  Child_under15_Adoles = 0;}
//       var Child_under15_Dis = document.getElementById("child_dis").checked;
//       if(Child_under15_Dis == true){
//         Child_under15_Dis = 1;
//       }else{  Child_under15_Dis = 0;}
//       var Child_under15_ADH = document.getElementById("child_adh").checked;
//       if(Child_under15_ADH == true){
//         Child_under15_ADH = 1;
//       }else{  Child_under15_ADH = 0;}
//       var mmt = document.getElementById("mmt").checked;
//       if(mmt == true){
//         mmt = 1;
//       }else{  mmt = 0;}
//       var ipt = document.getElementById("ipt").checked;
//       if(ipt == true){
//         ipt = 1;
//       }else{  ipt = 0;}
//       var tb = document.getElementById("tb").checked;
//       if(tb == true){
//         tb = 1;
//       }else{  tb = 0;}
//       var ncd = document.getElementById("ncd").checked;
//       if(ncd == true){
//         ncd = 1;
//       }else{  ncd = 0;}
//       var anc = document.getElementById("anc").checked;
//       if(anc == true){
//         anc = 1;
//       }else{  anc = 0;}
//       var pfa = document.getElementById("pfa").checked;
//       if(pfa == true){
//         pfa = 1;
//       }else{  pfa = 0;}
//       var phq9 = document.getElementById("phq9").checked;
//       if(phq9 == true){
//         phq9 = 1;
//       }else{  phq9 = 0;}
//       var Other = document.getElementById("other").checked;
//       if(Other == true){
//         Other = 1;
//       }else{  Other = 0;}
//       var eac = document.getElementById("eac").checked;
//       if(eac == true){
//         eac = 1;
//       }else{  eac = 0;}
//       var hmt = document.getElementById("hmt").checked;
//       if(hmt == true){
//         hmt = 1;
//       }else{  hmt = 0;}
//       var c_p_case = document.getElementById("c_p_case").checked;
//       if(c_p_case == true){
//         c_p_case = 1;
//       }else{  c_p_case = 0;}
//       var pmtct = document.getElementById("pmtct").checked;
//       if(pmtct == true){
//         pmtct = 1;
//       }else{  pmtct = 0;}


//       var  col_data={
//         both_hts_coun      :both_hts_coun,
//         Date_of_Birth:ddDate,

//         clinic_code : clinic_code ,
//         Pid : Pid,
//         FuchiaID : FuchiaID ,
//         PrEPCode : PrEPCode,
//         Gender : Gender,
//         Agey : Agey,
//         Agem : Agem,
//         calDob:calDob,

//         Counselling_Date : Counselling_Date,
//         Counsellor : Counsellor,
//         Main_Risk : Main_Risk,
//         Sub_Risk : Sub_Risk,

//              state          :state,
//              township       :township,
//              quarter        :quarter,
//              phone          :phone,
//              phone2         :phone2,
//              phone3         :phone3,

//              service        :service,
//              mode_of_entry  :mode_of_entry,
//              new_old        :new_old,

//              hiv_test_date  :hiv_test_date,
//              hiv_determine  :hiv_determine,
//              hiv_unigold    :hiv_unigold,
//              hiv_stat       :hiv_stat,
//              hiv_final      :hiv_final,

//              syp_date       :syp_date,
//              syp_rdt        :syp_rdt,
//              syp_rpr        :syp_rpr,
//              syp_vdrl       :syp_vdrl,
//              hep_date       :hep_date,
//              hep_b          :hep_b,
//              hep_c          :hep_c,

//              Pre : Pre,
//              Post : Post,
//              HTSdone : HTSdone,
//              Reason : Reason,
//              Status : Status,
//              PrEP : PrEP ,
//              PrEP_Status : PrEP_Status,
//              c1 : c1,
//              c2 : c2,
//              c3 : c3,
//              adh : adh,
//              Child_under15_Adoles : Child_under15_Adoles,
//              Child_under15_Dis : Child_under15_Dis,
//              Child_under15_ADH : Child_under15_ADH,
//              mmt : mmt,
//              ipt : ipt,
//              tb : tb,
//              ncd : ncd,
//              anc : anc,
//              pfa : pfa,
//              phq9 : phq9,
//              Other : Other,
//              eac : eac,
//              hmt : hmt,
//              c_p_case : c_p_case,
//              pmtct : pmtct,
//            };
//            console.log(col_data+"fale ka ngar pl");


//     }else{
//       console.log("sending data from only");
//       var counsellingOnly = 1;
//       var clinic_code = 81;

//       var Pid = resp[0]["Pid"];
//       var FuchiaID = resp[0]["FuchiaID"];
//       var PrEPCode = resp[0]["PrEPCode"];
//       var Gender = resp[10];
//       var Agey = resp[0]["Agey"];
//       var Agem = resp[0]["Agem"];

//       var state = document.getElementById("state").value;
//       if(state.length<1){
//         state="-";
//       }
//       var township = document.getElementById("township").value;
//       if(township.length<1){
//         township="-";
//       }
      
//       var quarter = document.getElementById("quarter").value;
//       if(quarter.length<1){
//         quarter="-";
//       }
//       var phone = document.getElementById("phone").value;
//       if(phone.length<1){
//         phone="-";
//       }
//       var phone2 = document.getElementById("phone2").value;
//       if(phone2.length<1){
//         phone2="-";
//       }
//       var phone3 = document.getElementById("phone3").value;
//       if(phone3.length<1){
//         phone3="-";
//       }

//       if(resp[9]==null){
//         var date = new Date();
//         var year = date.getFullYear();
//         var aggey = document.getElementById("agey").value;
//         var calYear = year - aggey ;
//         Agey = aggey;
//         var calDob = calYear + "-" + "6" + "-" + "15";
//         console.log(calDob);
//       }else{
//         var date = new Date();
//         var year = date.getFullYear();
//         var aggey = document.getElementById("agey").value;
//         var calYear = year - aggey ;
//         var calDob = calYear + "-" + "6" + "-" + "15";


//         var dobLast = resp[9];
//         dobLast = dobLast.split("-");

//         var LastYear = parseInt(dobLast[0]);
//         console.log(LastYear);
//         console.log(calYear);
//         if(calYear == LastYear){
//           console.log(calYear +","+ dobLast);
//           console.log("you arrived here A");
//         }else{
//           var calYear = year - aggey ;
//           Agey = aggey;
//           var calDob = calYear + "-" + "6" + "-" + "15";
//           console.log("you arrived here B");
//         }


//       }

//       var Counselling_Date = document.getElementById("vDate").value;
//       Counselling_Date = formatDate(Counselling_Date); // date FormatChange YYYY/MM/DD
//       var Counsellor = document.getElementById("counsellor").value;
//       var Main_Risk = document.getElementById("main_risk").value;
//       var Sub_Risk = document.getElementById("sub_risk").value;


//       var HTSdone = document.getElementById("hts_test_done").value;
//       var Reason = document.getElementById("hts_test_no_reason").value;
//       var Status = document.getElementById("status").value;
//       var PrEP_Status = document.getElementById("prep_status").value;

//       var PrEP = document.getElementById("prep").checked;
//       if(PrEP == true){
//         PrEP = 1;
//       }else{  PrEP = 0;}

//       var Pre = document.getElementById("pre").checked;
//       if(Pre==true){
//         Pre = 1;
//       }else{Pre=0;}

//       var Post = document.getElementById("post").checked;
//       if(Post == true){
//         Post = 1;
//       }else{Post = 0;}
//       var c1 = document.getElementById("c1").checked;
//       if(c1 == true){
//         c1 = 1;
//       }else{  c1 = 0;}

//       var c2 = document.getElementById("c2").checked;
//       if(c2 == true){
//         c2 = 1;
//       }else{  c2 = 0;}

//       var c3 = document.getElementById("c3").checked;
//       if(c3 == true){
//         c3 = 1;
//       }else{  c3 = 0;}

//       var adh = document.getElementById("adh").checked;
//       if(adh == true){
//         adh = 1;
//       }else{  adh = 0;}

//       var Child_under15_Adoles = document.getElementById("child_adoles").checked;
//       if(Child_under15_Adoles == true){
//         Child_under15_Adoles = 1;
//       }else{  Child_under15_Adoles = 0;}

//       var Child_under15_Dis = document.getElementById("child_dis").checked;
//       if(Child_under15_Dis == true){
//         Child_under15_Dis = 1;
//       }else{  Child_under15_Dis = 0;}

//       var Child_under15_ADH = document.getElementById("child_adh").checked;
//       if(Child_under15_ADH == true){
//         Child_under15_ADH = 1;
//       }else{  Child_under15_ADH = 0;}

//       var mmt = document.getElementById("mmt").checked;
//       if(mmt == true){
//         mmt = 1;
//       }else{  mmt = 0;}

//       var ipt = document.getElementById("ipt").checked;
//       if(ipt == true){
//         ipt = 1;
//       }else{  ipt = 0;}

//       var tb = document.getElementById("tb").checked;
//       if(tb == true){
//         tb = 1;
//       }else{  tb = 0;}

//       var ncd = document.getElementById("ncd").checked;
//       if(ncd == true){
//         ncd = 1;
//       }else{  ncd = 0;}

//       var anc = document.getElementById("anc").checked;
//       if(anc == true){
//         anc = 1;
//       }else{  anc = 0;}

//       var pfa = document.getElementById("pfa").checked;
//       if(pfa == true){
//         pfa = 1;
//       }else{  pfa = 0;}

//       var phq9 = document.getElementById("phq9").checked;
//       if(phq9 == true){
//         phq9 = 1;
//       }else{  phq9 = 0;}

//       var Other = document.getElementById("other").checked;
//       if(Other == true){
//         Other = 1;
//       }else{  Other = 0;}

//       var eac = document.getElementById("eac").checked;
//       if(eac == true){
//         eac = 1;
//       }else{  eac = 0;}

//       var hmt = document.getElementById("hmt").checked;
//       if(hmt == true){
//         hmt = 1;
//       }else{  hmt = 0;}

//       var c_p_case = document.getElementById("c_p_case").checked;
//       if(c_p_case == true){
//         c_p_case = 1;
//       }else{  c_p_case = 0;}

//       var pmtct = document.getElementById("pmtct").checked;
//       if(pmtct == true){
//         pmtct = 1;
//       }else{  pmtct = 0;}
//        console.log(counsellingOnly,clinic_code,Pid,FuchiaID,PrEPCode,Gender,Agey, Agem);

//       var col_data= {
//         Date_of_Birth:ddDate,
//          counsellingOnly:counsellingOnly,
//          clinic_code : clinic_code ,
//          Pid : Pid,
//          FuchiaID : FuchiaID,
//          PrEPCode : PrEPCode,
//          Gender : Gender,
//          Agey : Agey,
//          Agem : Agem,
//          calDob:calDob,

//          Counselling_Date : Counselling_Date,
//          Counsellor : Counsellor,
//          Main_Risk : Main_Risk,
//          Sub_Risk : Sub_Risk,
//          state          :state,
//          township       :township,
//          quarter        :quarter,
//          phone          :phone,
//          phone2         :phone2,
//          phone3         :phone3,
//          Pre : Pre,
//          Post : Post,
//          HTSdone : HTSdone,
//          Reason : Reason,
//          Status : Status,
//          PrEP : PrEP ,
//          PrEP_Status : PrEP_Status,
//          c1 : c1,
//          c2 : c2,
//          c3 : c3,
//          adh : adh,
//          Child_under15_Adoles : Child_under15_Adoles,
//          Child_under15_Dis : Child_under15_Dis,
//          Child_under15_ADH : Child_under15_ADH,
//          mmt : mmt,
//          ipt : ipt,
//          tb : tb,
//          ncd : ncd,
//          anc : anc,
//          pfa : pfa,
//          phq9 : phq9,
//          Other : Other,
//          eac : eac,
//          hmt : hmt,
//          c_p_case : c_p_case,
//          pmtct : pmtct,
//         };
        

//    }

//     console.log(col_data);
    

//     $.ajaxSetup({
//        headers: {
//            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
//        }
//      });
//         $.ajax({
//              type:'POST',
//              url:"{{route('counsellor_room')}}",
//              dataType:'json',
//            //  processData:false,
//              contentType:'application/json',
//              data: JSON.stringify(col_data),
//              success:function(response){
//                console.log(response);
//                alert("Your data has been collected.");
//                //location.reload(true);// to refresh the page
//               //document.getElementById('regbutton').disabled=false;
//              }
//           });
// }


function Save(){
    var  hts_counselling=0;var counsellingOnly=0;
    var switch_ck  =$("#coun_count").val();
    console.log(switch_ck+"switch question");
    if(switch_ck =="two"){
    var  hts_counselling=1;   // 1 for  HTS and counselling / 0 for only counselling
    }else {
    var counsellingOnly=1;
    } 
    
    
    dateOfBirth();
    console.log(ddDate+"hello date of birth"+hts_counselling);
    var calDob=ddDate;
    var pre_post = document.getElementById("coun_count").value;
    
    
    if(pre_post=="one"){
      labTestDates="preTest"
    }else{
      if($("#riskChangeLab").val()=="No"){
        labTestDates="postTest"
      }else{
        if($("#labTestDate").val()==""){
        alert("Please Fill correct Lab Test date")
        $("#labTestDate").focus();
        }else{
        var labTestDate = document.getElementById("labTestDate").value;
        labTestDates = formatDate(labTestDate); // date FormatChange YYYY/MM/DD
        }
      }
      
           
    }
    
   
            var clinic_code = 81;

            var Pid = resp[0]["Pid"];
            var FuchiaID = resp[0]["FuchiaID"];
            var PrEPCode = resp[0]["PrEPCode"];
            var Gender = resp[10];

            var Agey =  document.getElementById("agey").value;

            var Agem = document.getElementById("agem").value;
           
            if(!Agem){
              Agem=0;
            }
           
            
           

            var Counselling_Date = document.getElementById("vDate").value;
            Counselling_Date = formatDate(Counselling_Date); // date FormatChange YYYY/MM/DD

            var Counsellor = document.getElementById("counsellor").value;
            var HTSdone = document.getElementById("hts_test_done").value;
            
            var Reason = document.getElementById("hts_test_no_reason").value;
            var Status = document.getElementById("status").value;
            var PrEP_Status = document.getElementById("prep_status").value;
            var test_locate=$("#lab_location").val();
            console.log(test_locate+"test location")

           console.log ("second save pharse");
      var state = document.getElementById("state").value;
      if(state.length<1){
        state="-";
      }
      var township = document.getElementById("township").value;
      if(township.length<1){
        township="-";
      }
      var quarter = document.getElementById("quarter").value;
      if(quarter.length<1){
        quarter="-";
      }
      var phone = document.getElementById("phone").value;
      if(phone.length<1){
        phone="-";
      }
      var phone2 = document.getElementById("phone2").value;
      if(phone2.length<1){
        phone2="-";
      }
      var phone3 = document.getElementById("phone3").value;
      if(phone3.length<1){
        phone3="-";
      }
      var Main_Risk = document.getElementById("main_risk").value;
      if(Main_Risk.length<1){
        Main_Risk="-";
      }
      var Sub_Risk = document.getElementById("sub_risk").value;
      if(Sub_Risk.length<1){
        Sub_Risk="-";
      }
      var service = document.getElementById("service").value;
      if(service.length<1){
        service="-";
      }
      var mode_of_entry = document.getElementById("m_o_entry").value;
      if(mode_of_entry.length<1){
        mode_of_entry="-";
      }
      var new_old = document.getElementById("new_old").value;
      if(new_old.length<1){
        new_old="-";
      }

      var hiv_test_date = document.getElementById("hiv_test_date").value;
      hiv_test_date = formatDate(hiv_test_date); // date FormatChange YYYY/MM/DD
      if(hiv_test_date.length<1){
        hiv_test_date="-";
      }
      var hiv_determine = document.getElementById("d_result").value;
      if(!hiv_determine.length){
        hiv_determine="-";
      }else{
        console.log("hello hiv determine");
        $("#hts_test_done").val("Yes").prop("selected", true);
        var HTSdone = document.getElementById("hts_test_done").value;
        console.log(HTSdone);
      }
     
      var hiv_unigold = document.getElementById("uni_result").value;
      if(hiv_unigold.length<1){
        hiv_unigold="-";
      }
      var hiv_stat = document.getElementById("stat_result").value;
      if(hiv_stat.length<1){
        hiv_stat="-";
      }
      var hiv_final = document.getElementById("final_result").value;
      if(hiv_final.length<1){
        hiv_final="-";
      }

      var syp_date = document.getElementById("syp_date").value;
      syp_date = formatDate(syp_date); // date FormatChange YYYY/MM/DD
      if(syp_date.length<1){
        syp_date="-";
      }
      var syp_rdt = document.getElementById("Sy_rdt_result").value;
      if(syp_rdt.length<1){
        syp_rdt="-";
      }
      var syp_rpr = document.getElementById("qualitative").value;
      if(syp_rpr.length<1){
        syp_rpr="-";
      }
      var syp_vdrl = document.getElementById("syp_vdrl").value;
      if(syp_vdrl.length<1){
        syp_vdrl="-";
      }

      var hep_date = document.getElementById("hep_date").value;
      hep_date = formatDate(hep_date); // date FormatChange YYYY/MM/DD
      if(hep_date.length<1){
        hep_date="-";
      }
      var hep_b = document.getElementById("B_result").value;
      if(hep_b.length<1){
        hep_b="-";
      }
      var hep_c = document.getElementById("C_result").value;
      if(hep_c.length<1){
        hep_c="-";
      }



      var PrEP = document.getElementById("prep").checked;
      if(PrEP == true){
        PrEP = 1;
      }else{  PrEP = 0;}
      var Pre = document.getElementById("pre").checked;
      if(Pre==true){
        Pre = 1;
      }else{Pre=0;}
      var Post = document.getElementById("post").checked;
      if(Post == true){
        Post = 1;
      }else{Post = 0;}
      var c1 = document.getElementById("c1").checked;
      if(c1 == true){
        c1 = 1;
      }else{  c1 = 0;}
      var c2 = document.getElementById("c2").checked;
      if(c2 == true){
        c2 = 1;
      }else{  c2 = 0;}
      var c3 = document.getElementById("c3").checked;
      if(c3 == true){
        c3 = 1;
      }else{  c3 = 0;}
      var adh = document.getElementById("adh").checked;
      if(adh == true){
        adh = 1;
      }else{  adh = 0;}
      var Child_under15_Adoles = document.getElementById("child_adoles").checked;
      if(Child_under15_Adoles == true){
        Child_under15_Adoles = 1;
      }else{  Child_under15_Adoles = 0;}
      var Child_under15_Dis = document.getElementById("child_dis").checked;
      if(Child_under15_Dis == true){
        Child_under15_Dis = 1;
      }else{  Child_under15_Dis = 0;}
      var Child_under15_ADH = document.getElementById("child_adh").checked;
      if(Child_under15_ADH == true){
        Child_under15_ADH = 1;
      }else{  Child_under15_ADH = 0;}
      var mmt = document.getElementById("mmt").checked;
      if(mmt == true){
        mmt = 1;
      }else{  mmt = 0;}
      var ipt = document.getElementById("ipt").checked;
      if(ipt == true){
        ipt = 1;
      }else{  ipt = 0;}
      var tb = document.getElementById("tb").checked;
      if(tb == true){
        tb = 1;
      }else{  tb = 0;}
      var ncd = document.getElementById("ncd").checked;
      if(ncd == true){
        ncd = 1;
      }else{  ncd = 0;}
      var anc = document.getElementById("anc").checked;
      if(anc == true){
        anc = 1;
      }else{  anc = 0;}
      var pfa = document.getElementById("pfa").checked;
      if(pfa == true){
        pfa = 1;
      }else{  pfa = 0;}
      var phq9 = document.getElementById("phq9").checked;
      if(phq9 == true){
        phq9 = 1;
      }else{  phq9 = 0;}
      var Other = document.getElementById("other").checked;
      if(Other == true){
        Other = 1;
      }else{  Other = 0;}
      var eac = document.getElementById("eac").checked;
      if(eac == true){
        eac = 1;
      }else{  eac = 0;}
      var hmt = document.getElementById("hmt").checked;
      if(hmt == true){
        hmt = 1;
      }else{  hmt = 0;}
      var c_p_case = document.getElementById("c_p_case").checked;
      if(c_p_case == true){
        c_p_case = 1;
      }else{  c_p_case = 0;}
      var pmtct = document.getElementById("pmtct").checked;
      if(pmtct == true){
        pmtct = 1;
      }else{  pmtct = 0;}

      if(hts_counselling==1){
        console.log("hello hts hi")
        console.log( hiv_final+service+mode_of_entry+new_old+"data hts")
        if(hiv_final=="-"||service=="-"||mode_of_entry=="-"||new_old =="-"){
          console.log("freeze body")
          $('html, body').animate({ scrollTop: 0 }, 'fast');
          $("#hts_warining").show();
          $(".cosulor-parent-div").addClass('freeze-body');
        }else if(hts_counselling==1) {
          var  col_data={
       
            clinic_code : clinic_code ,
            Pid : Pid,
            counsellingOnly:counsellingOnly,
            FuchiaID : FuchiaID ,
            PrEPCode : PrEPCode,
            Gender : Gender,
            Agey : Agey,
            Agem : Agem,
            calDob:calDob,
            test_locate:test_locate,
            

            labTestDate:labTestDates,
            Counselling_Date : Counselling_Date,
            Counsellor : Counsellor,
            Main_Risk : Main_Risk,
            Sub_Risk : Sub_Risk,

            state          :state,
            township       :township,
            quarter        :quarter,
            phone          :phone,
            phone2         :phone2,
            phone3         :phone3,

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

            Pre : Pre,
            Post : Post,
            HTSdone : HTSdone,
            Reason : Reason,
            Status : Status,
            PrEP : PrEP ,
            PrEP_Status : PrEP_Status,
            c1 : c1,
            c2 : c2,
            c3 : c3,
            adh : adh,
            Child_under15_Adoles : Child_under15_Adoles,
            Child_under15_Dis : Child_under15_Dis,
            Child_under15_ADH : Child_under15_ADH,
            mmt : mmt,
            ipt : ipt,
            tb : tb,
            ncd : ncd,
            anc : anc,
            pfa : pfa,
            phq9 : phq9,
            Other : Other,
            eac : eac,
            hmt : hmt,
            c_p_case : c_p_case,
            pmtct : pmtct,
            hts_counselling : hts_counselling,
          };
          console.log(col_data+"hello data ");
         
        } 
      }else if(counsellingOnly==1){
        var  col_data={
       clinic_code : clinic_code ,
       Pid : Pid,
       counsellingOnly:counsellingOnly,
       FuchiaID : FuchiaID ,
       PrEPCode : PrEPCode,
       Gender : Gender,
       Agey : Agey,
       Agem : Agem,
       calDob:calDob,
       

       labTestDate:labTestDates,
       Counselling_Date : Counselling_Date,
       Counsellor : Counsellor,
       Main_Risk : Main_Risk,
       Sub_Risk : Sub_Risk,

       state          :state,
       township       :township,
       quarter        :quarter,
       phone          :phone,
       phone2         :phone2,
       phone3         :phone3,

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

       Pre : Pre,
       Post : Post,
       HTSdone : HTSdone,
       Reason : Reason,
       Status : Status,
       PrEP : PrEP ,
       PrEP_Status : PrEP_Status,
       c1 : c1,
       c2 : c2,
       c3 : c3,
       adh : adh,
       Child_under15_Adoles : Child_under15_Adoles,
       Child_under15_Dis : Child_under15_Dis,
       Child_under15_ADH : Child_under15_ADH,
       mmt : mmt,
       ipt : ipt,
       tb : tb,
       ncd : ncd,
       anc : anc,
       pfa : pfa,
       phq9 : phq9,
       Other : Other,
       eac : eac,
       hmt : hmt,
       c_p_case : c_p_case,
       pmtct : pmtct,
       hts_counselling : hts_counselling,
     };        
     console.log(col_data+"hello data ");
      }

      console.log(col_data+"hello data ");
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
             data: JSON.stringify(col_data),
             success:function(response){
               console.log(response);
               console.log(response[0].length+"hello length");

               
                var resp =response[0];
                switch(resp) {
                case 0:alert("This Patient Don't Test in Lab Please First Point  to Lab");break;
                case 1: $('html, body').animate({ scrollTop: 0 }, 'fast');
                        $("#customAlertBox").show();
                       $(".cosulor-parent-div").addClass('freeze-body');
                       
                       
                      
                  
                  break;
                case 1.5: $('html, body').animate({ scrollTop: 0 }, 'fast');
                        $("#customAlertBox").show();
                       $(".cosulor-parent-div").addClass('freeze-body');
                       
                      
                  
                  break;
                case 1.1:alert("This Patient do not test in Any_Lab at"+labTestDate);break;
                case 2:alert("This Patient do not Pass Reception Center");break;
                case 2.1:alert("This Patient do not test Any HTS Test on");break;
                case 2.2:alert("This Patient has been Collected in thsi day");break;
                }

               if(resp.length>5){
                $("#responseText").empty();
                var test_name=["Hiv","Rpr","Hbc","Urine","Oi","Sti_Lab","Afb","General","Stool","Covid","Viral"];
                var mesage_result="";
                
                
                for(var up_res=0;up_res<response[0].length;up_res++){
                  $("#responseText").empty();
                  if(response[0][up_res]=="1"){
                    console.log("hello 1")
                   var mesage_result=mesage_result.concat("",test_name[up_res]+"/");
                  }
                }
                $("#responseText").text(mesage_result+"Updated in"+$("#labTestDate").val());
                $(".alert").css("background-color","yellow");
                $('html, body').animate({ scrollTop: 0 }, 'fast');
                $("#customAlertBox").show();
                 $(".cosulor-parent-div").addClass('freeze-body');

                 
                
               }
                
               
                
               
             
               
               //location.reload(true);// to refresh the page
              //document.getElementById('regbutton').disabled=false;
             }
          });
}
function reason(){
  var hts_test_done =document.getElementById('hts_test_done').value;
  if(hts_test_done=="Yes"){
    document.getElementById('hts_test_no_reason').disabled=true;
    document.getElementById('status').disabled=false;
  }else{
    document.getElementById('hts_test_no_reason').disabled=false;
    document.getElementById('status').disabled=true;
  }
}
function updateORsave(){
  let duplicateEntry = 1;
  var checkPatient = 1;
  var ckdata = {
                  gid:gid,
                  duplicateEntry:duplicateEntry,

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
          { $( "#responseText" ).toggle(1000);
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


                   //document.getElementById("vDate").value=today;
                   document.getElementById("state").value=response[2];
                   document.getElementById("township").value=response[3];
                   document.getElementById("phone").value=response[5];
                   document.getElementById("phone2").value=response[6];
                   document.getElementById("phone3").value=response[7];
                   document.getElementById("main_risk").value=response[0]["Main Risk"];
                   document.getElementById("sub_risk").value=response[0]["Sub Risk"];
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


                 }
               }
         });


}
function hiv_test_date(){
  hiv_test = 1;
  var gid =document.getElementById('gid').value;
  var hiv_test_date = document.getElementById("hiv_test_date").value;
  document.getElementById("syp_date").value=hiv_test_date;
  document.getElementById("hep_date").value=hiv_test_date;
  hiv_test_date = formatDate(hiv_test_date); // date FormatChange YYYY/MM/DD
  console.log(hiv_test_date+"hiv test date");

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

              document.getElementById('d_result').value=response[1];
              document.getElementById('uni_result').value=response[2];
              document.getElementById('stat_result').value=response[3];
              
              // document.getElementById('d_result').value="Reactive";
              // document.getElementById('uni_result').value="Reactive";
              // document.getElementById('stat_result').value="Reactive";
              var Hivtest_result_return = response[4];
              document.getElementById('final_result').value= Hivtest_result_return;
              if(Hivtest_result_return=="Negative"){
                document.getElementById('hts_test_done').value="Yes";
                document.getElementById('status').disabled=true;
              }else{
                  document.getElementById('hts_test_done').value="Yes";
              }

              document.getElementById('hts_test_no_reason').disabled=true;



           }
        });
} //Fetching HIV test Result from Lab
function hiv_result_cal(){
  var d_result = document.getElementById("d_result").value;
  var uni_result = document.getElementById("uni_result").value;
  var stat_result = document.getElementById("stat_result").value;
  console.log(d_result);
  console.log(uni_result);
  console.log(stat_result);

    if(d_result=="Reactive" && uni_result=="Reactive" && stat_result=="Reactive"){
      document.getElementById("Positive").selected="true";
    }
    if(d_result=="Reactive"){
      if(uni_result=="Reactive" && stat_result=="Non Reactive"){
        document.getElementById("Inconclusive").selected="true";
      }
    }if(d_result=="Reactive"){
      if(uni_result=="Non Reactive" && stat_result=="Reactive"){
        document.getElementById("Inconclusive").selected="true";
      }
    }
    if(d_result=="Reactive"){
      if(uni_result=="Reactive" && stat_result=="Non Reactive"){
        document.getElementById("Inconclusive").selected="true";
      }
    }
    if(d_result=="Reactive"){
      if(uni_result=="Non Reactive" && stat_result=="Non Reactive"){
        document.getElementById("Negative").selected="true";
      }
    }
    if( uni_result=="Invalid" || stat_result=="Invalid"){
      //document.getElementById('stat_result').disabled =true ;
      document.getElementById("Inconclusive").selected="true";
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
    document.getElementById('stat_result').disabled =true ;
    document.getElementById("Inconclusive").selected="true";
  }else {
    document.getElementById('stat_result').disabled =false;
  }
}

function Rrp_test_date(){
  rpr_test = 1;
  var gid =document.getElementById('gid').value;
  var rpr_test_date = document.getElementById("syp_date").value;
  rpr_test_date = formatDate(rpr_test_date); // date FormatChange YYYY/MM/DD

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

              document.getElementById('Sy_rdt_result').value=response[1];
              document.getElementById('qualitative').value=response[2];

           }
        });
}
function hepB_test_date(){
  hepB_test = 1;
  var gid =document.getElementById('gid').value;
  var hepB_test_date = document.getElementById("hep_date").value;
  hepB_test_date = formatDate(hepB_test_date); // date FormatChange YYYY/MM/DD

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

              document.getElementById('B_result').value=response[1];
              document.getElementById('C_result').value=response[2];

           }
        });
}

// function switchToggle() {
//   $( ".consulor-switch" ).toggle(1000);
//   // $("#updateBton").toggle(1000);

// }
function ptData(){// to find patient data
  document.getElementById("updateBton").disabled=true;
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
  document.getElementById('labTestDate').value = today;

  var gid =document.getElementById('gid').value;
  var c_code = 81;
  var gidLength = gid.length;

  $(".counselling-type input[type='checkbox']").each(function(index) {
      $(this).removeClass( "chk" + (index + 1));
    }) // removing  Class to fill already have  data ye naing
      



  

  let ckID = 1;
  var checkPatient = 1;
  var ckdata = {
                  gid:gid,
                  ckID:ckID,
                  year:year,
                  today:today,
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
         resp = response;
          // if(response[0] == null)


          // { $( "#responseText" ).toggle(1000);
          //   document.getElementById('gen_data').innerHTML="";
          //   document.getElementById('gen_data').innerHTML="There is no data.";

          // }
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
                  //document.getElementById("agem").value= (month+1) - dtMonth;
                  var Agem = (month+1) - dtMonth;
                }else{
                       var Adate = new Date();
                       var Aday = Adate.getDate();
                       var Amonth = Adate.getMonth() + 1;
                       var Ayear = Adate.getFullYear();
                       var toshowYear = Ayear - Number(dtYear);
                       Age = toshowYear;// Global
                       document.getElementById("agey").value= Age;

                     }
                     if(response[13]=="new"){
                      $("#dob,#agey,#agem").prop("disabled",false);
                     }
                     General_ID = response[0]["Pid"];// Global
                     Fuchia_ID = response[0]["FuchiaID"];//Global
                     Gender = response[10];//Global
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
                     if(Agem == null){
                       Agem = "_";
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
                    // "Age(yr) :"+ Age +",&nbsp;&nbsp;&nbsp;&nbsp;"+
                    // "Age(m) :"+ Agem +",&nbsp;&nbsp;&nbsp;&nbsp;"+
                    // "Region :"+ Region +",&nbsp;&nbsp;&nbsp;&nbsp;"+
                    "Township :"+ Township;


                   //document.getElementById("vDate").value=today;
                   document.getElementById("state").value=response[2];
                   document.getElementById("township").value=response[3];
                   document.getElementById("phone").value=response[5];
                   document.getElementById("phone2").value=response[6];
                   document.getElementById("phone3").value=response[7];
                   document.getElementById("dob").value=response[9];
                   document.getElementById("main_risk").value=response[11];
                   PatientType();
                   document.getElementById("sub_risk").value=response[12];
                   var new_old_ck = response[8];
                   if(new_old_ck == true){
                     document.getElementById("new_old").value="Old";
                   }else{
                     document.getElementById("new_old").value="New";
                     document.getElementById("new_old").style="color:red";
                   }
                   if(response[15]==true){
                    if(response[14][0]=="1"){
                    $("#pre").prop("checked",true);
                    }
                    if(response[14][1]=="1"){
                      $("#post").prop("checked",true);
                    }

                    $(".counselling-type input[type='checkbox']").each(function(index) {
                        $(this).addClass( "chk" + (index + 1));
                        console.log("hi checked data")
                      }) // adding Class to fill already have  data
        
                    $("#hts_test_done").val(response[14][2]);
                    $("#hts_test_no_reason").val(response[14][3]);
                    $("#status").val(response[14][4]);
                    if(response[14][5]=="1"){
                      $("#prep").prop("checked",true);
                    }
                    $("#prep_status").val(response[14][6]);
                    var data_fillNO=1;// to fill the class type of counseling data
                    for(var check=7;check<26;check++){
                      if(response[14][check]==1){
                        $(".chk"+data_fillNO).prop("checked", true);
                      }
                      data_fillNO++;

                    }
                   }
                   $("#hts-search").prop("disabled",true);
  




                 

                   

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
function risk_update(){ // to update Data by Counsellor
  let update =1;
  var clinic_code = 81;
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
  if(state.length<1){
    state="-";
  }
  var township = document.getElementById("township").value;
  if(township.length<1){
    township="-";
  }
  var quarter = document.getElementById("quarter").value;
  if(quarter.length<1){
    quarter="-";
  }
  var phone = document.getElementById("phone").value;
  if(phone.length<1){
    phone="-";
  }
  var phone2 = document.getElementById("phone2").value;
  if(phone2.length<1){
    phone2="-";
  }
  var phone3 = document.getElementById("phone3").value;
  if(phone3.length<1){
    phone3="-";
  }
  var Main_risk = document.getElementById("main_risk").value;
  if(Main_risk.length<1){
    Main_risk="-";
  }
  var Sub_risk = document.getElementById("sub_risk").value;
  if(Sub_risk.length<1){
    Sub_risk="-";
  }
  var service = document.getElementById("service").value;
  if(service.length<1){
    service="-";
  }
  var mode_of_entry = document.getElementById("m_o_entry").value;
  if(mode_of_entry.length<1){
    mode_of_entry="-";
  }
  var new_old = document.getElementById("new_old").value;
  if(new_old.length<1){
    new_old="-";
  }

  var hiv_test_date = document.getElementById("hiv_test_date").value;
  if(hiv_test_date.length<1){
    hiv_test_date="-";
  }
  var hiv_determine = document.getElementById("d_result").value;
  if(hiv_determine.length<1){
    hiv_determine="-";
  }
  var hiv_unigold = document.getElementById("uni_result").value;
  if(hiv_unigold.length<1){
    hiv_unigold="-";
  }
  var hiv_stat = document.getElementById("stat_result").value;
  if(hiv_stat.length<1){
    hiv_stat="-";
  }
  var hiv_final = document.getElementById("final_result").value;
  if(hiv_final.length<1){
    hiv_final="-";
  }

  var syp_date = document.getElementById("syp_date").value;
  if(syp_date.length<1){
    syp_date="-";
  }
  var syp_rdt = document.getElementById("Sy_rdt_result").value;
  if(syp_rdt.length<1){
    syp_rdt="-";
  }
  var syp_rpr = document.getElementById("qualitative").value;
  if(syp_rpr.length<1){
    syp_rpr="-";
  }
  var syp_vdrl = document.getElementById("syp_vdrl").value;
  if(syp_vdrl.length<1){
    syp_vdrl="-";
  }

  var hep_date = document.getElementById("hep_date").value;
  if(hep_date.length<1){
    hep_date="-";
  }
  var hep_b = document.getElementById("B_result").value;
  if(hep_b.length<1){
    hep_b="-";
  }
  var hep_c = document.getElementById("C_result").value;
  if(hep_c.length<1){
    hep_c="-";
  }

  var  data={
         update         :update,
         clinic_code    :clinic_code,
         cdate          :cdate,


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
             if(response[0]==true){
               alert("Duplicate data entry");
             }else{
               alert("Your data has been collected.");
             }


            location.reload(true);// to refresh the page

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
        var tt_inner = document.getElementById('township');
        if(tt_inner.innerHTML!=null){
          tt_inner.innerHTML="";
        }
        // to show township
         for (var i = 0; i < Tcount; i++) {
           // get reference to select element
           var sel = document.getElementById('township');
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
      var tt_inner = document.getElementById('township');
      if(tt_inner.innerHTML!=null){
        tt_inner.innerHTML="";
      }
      // to show township
       for (var i = 0; i < Tcount; i++) {
         // get reference to select element
         var sel = document.getElementById('township');
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
      var tt_inner = document.getElementById('township');
      if(tt_inner.innerHTML!=null){
        tt_inner.innerHTML="";
      }
      // to show township
       for (var i = 0; i < Tcount; i++) {
         // get reference to select element
         var sel = document.getElementById('township');
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
      var tt_inner = document.getElementById('township');
      if(tt_inner.innerHTML!=null){
        tt_inner.innerHTML="";
      }
      // to show township
       for (var i = 0; i < Tcount; i++) {
         // get reference to select element
         var sel = document.getElementById('township');
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
        const mon = [];
        mon[0] = "Mawlamyine"; mon[1] = "Kyaikmaraw"; mon[2] = "Chaungzon";
        mon[3] = "Thanbyuzayat";  mon[4] = "Mudon";  mon[5] = "Ye";
        mon[6] = "Thaton"; mon[7] = "Paung";  mon[8] = "Kyaikto";
        mon[9] = "Bilin";
        // to clear option in select township
        var tt_inner = document.getElementById('township');
        if(tt_inner.innerHTML!=null){
          tt_inner.innerHTML="";
        }
        // to show township
         for (var i = 0; i < Tcount; i++) {
           // get reference to select element
           var sel = document.getElementById('township');
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
          var tt_inner = document.getElementById('township');
          if(tt_inner.innerHTML!=null){
            tt_inner.innerHTML="";
          }
          // to show township
           for (var i = 0; i < Tcount; i++) {
             // get reference to select element
             var sel = document.getElementById('township');
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
        var tt_inner = document.getElementById('township');
        if(tt_inner.innerHTML!=null){
          tt_inner.innerHTML="";
        }
        // to show township
         for (var i = 0; i < Tcount; i++) {
           // get reference to select element
           var sel = document.getElementById('township');
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
        var tt_inner = document.getElementById('township');
        if(tt_inner.innerHTML!=null){
          tt_inner.innerHTML="";
        }
        // to show township
         for (var i = 0; i < Tcount; i++) {
           // get reference to select element
           var sel = document.getElementById('township');
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
      var tt_inner = document.getElementById('township');
      if(tt_inner.innerHTML!=null){
        tt_inner.innerHTML="";
      }
      // to show township
       for (var i = 0; i < Tcount; i++) {
         // get reference to select element
         var sel = document.getElementById('township');
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
        var tt_inner = document.getElementById('township');
        if(tt_inner.innerHTML!=null){
          tt_inner.innerHTML="";
        }
        // to show township
         for (var i = 0; i < Tcount; i++) {
           // get reference to select element
           var sel = document.getElementById('township');
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
        var tt_inner = document.getElementById('township');
        if(tt_inner.innerHTML!=null){
          tt_inner.innerHTML="";
        }
        // to show township
         for (var i = 0; i < Tcount; i++) {
           // get reference to select element
           var sel = document.getElementById('township');
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
      var tt_inner = document.getElementById('township');
      if(tt_inner.innerHTML!=null){
        tt_inner.innerHTML="";
      }
      // to show township
       for (var i = 0; i < Tcount; i++) {
         // get reference to select element
         var sel = document.getElementById('township');
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
      var tt_inner = document.getElementById('township');
      if(tt_inner.innerHTML!=null){
        tt_inner.innerHTML="";
      }
      // to show township
       for (var i = 0; i < Tcount; i++) {
         // get reference to select element
         var sel = document.getElementById('township');
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
        var tt_inner = document.getElementById('township');
        if(tt_inner.innerHTML!=null){
          tt_inner.innerHTML="";
        }
      // to show township
       for (var i = 0; i < Tcount; i++) {
         // get reference to select element
         var sel = document.getElementById('township');
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
          var tt_inner = document.getElementById('township');
          if(tt_inner.innerHTML!=null){
            tt_inner.innerHTML="";
          }
          // to show township
          for (var i = 0; i < Tcount; i++) {
            // get reference to select element
            var sel = document.getElementById('township');
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
function refresh(){
    location.reload(true);
  }
function clearFacts(){
  document.getElementById("responseText").value="";
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
  //document.getElementById("main_risk").value="";
  //document.getElementById("sub_risk").value="";


}
function Service_Modality(){
        var type= document.getElementById('service').value;
        if(m_o_entry.innerHTML!=null){
          m_o_entry.innerHTML="";
        }
        $("#m_o_entry").empty();
        if(type == "Facility"){
            var sel = document.getElementById('m_o_entry');
            // create new option element
            var opt0 = document.createElement("option");
            var opt1 = document.createElement("option");
            var opt2 = document.createElement("option");
            var opt3 = document.createElement("option");
            var opt4 = document.createElement("option");
            var opt5 = document.createElement("option");
            var opt6 = document.createElement("option");

            opt1.text ="Index";
            opt2.text ="SNS";
            opt3.text ="TB";
            opt4.text ="STI";
            opt5.text ="HIV-ST";
            opt6.text ="VCT";
            service = 1;

            // add opt to end of select box (sel)
            sel.add(opt0);
            sel.add(opt1);
            sel.add(opt2);
            sel.add(opt3);
            sel.add(opt4);
            sel.add(opt5);
            sel.add(opt6);


        }
        if(type == "Community"){
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
            // sel.addEventListener("click", Ptypesub);
            // add opt to end of select box (sel)
            sel.add(opt0);
            sel.add(opt1);
            sel.add(opt2);
            sel.add(opt3);
            sel.add(opt4);

        }


 }



function PatientType(){
      var type= document.getElementById('main_risk').value;
      if(sub_risk.innerHTML!=null){
        sub_risk.innerHTML="";
      }
      console.log("hello sub Risk")


      $("#sub_risk").empty();
      if(type == "Pregnant Mother"){
          var sel = document.getElementById('sub_risk');
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
          sel.addEventListener("click", sub_risk);

          // add opt to end of select box (sel)
          sel.add(opt0);
          sel.add(opt1);
          sel.add(opt2);

      }
      if(type == "Spouse of pregnant mother"){

        var sel = document.getElementById('sub_risk');
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

        sel.addEventListener("click", sub_risk);
        ////
        sel.appendChild(opt0);
        sel.appendChild(opt1);
        sel.appendChild(opt2);
        spm =1;

      }
      if(type == "Exposed Children"){

        var sel = document.getElementById('sub_risk');
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

        sel.addEventListener("click", sub_risk);
        // add opt to end of select box (sel)
        sel.appendChild(opt0);
        sel.appendChild(opt1);
        sel.appendChild(opt2);
        sel.appendChild(opt3);
        sel.appendChild(opt4);
        epc = 1;
      }
      if(type == "Low risk"){
        var sel = document.getElementById('sub_risk');
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

        sel.addEventListener("click", sub_risk);
        // add opt to end of select box (sel)
        sel.appendChild(opt0);
        //sel.appendChild(opt1);
        sel.appendChild(opt2);
        sel.appendChild(opt3);
        lr = 1;
      }
      if(type == "PWUD"){
        var sel = document.getElementById('sub_risk');
        var opt0 = document.createElement("option");
        opt0.appendChild( document.createTextNode(""));
        opt0.value = "-";
        opt0.setAttribute('id','opt_pwud_0');
        sel.addEventListener("click", sub_risk);
        sel.appendChild(opt0);

      }
      if(type == "FSW"){
        var sel = document.getElementById('sub_risk');
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

        sel.addEventListener("click", sub_risk);
        // add opt to end of select box (sel)
        sel.appendChild(opt0);
        sel.appendChild(opt1);
        sel.appendChild(opt2);
        fsw = 1;
      }
      if(type == "Client of FSW"){
        var sel = document.getElementById('sub_risk');
        var opt0 = document.createElement("option");
        opt0.appendChild( document.createTextNode(""));
        opt0.value = "-";
        opt0.setAttribute('id','opt_cfsw_0');
        sel.addEventListener("click", sub_risk);
        sel.appendChild(opt0);

      }
      if(type == "MSM"){
        msm =1;
        var sel = document.getElementById('sub_risk');
        // create new option element
        var opt0 = document.createElement("option");
        var opt1 = document.createElement("option");
        var opt2 = document.createElement("option");
        // create text node to add to option element (opt)
        opt0.appendChild( document.createTextNode(""));
        opt1.appendChild( document.createTextNode("MSM_PWID"));
        opt2.appendChild( document.createTextNode("MSM_PWUD"));
        // set value property of opt
        opt0.value = "";
        opt1.value = "MSM_PWID";
        opt2.value = "MSM_PWUD";

        opt0.setAttribute('id','opt_msm_0');
        opt1.setAttribute('id','opt_msm_pwid');
        opt2.setAttribute('id','opt_msm_pwud');

        sel.addEventListener("click", sub_risk);

        // add opt to end of select box (sel)
        sel.appendChild(opt0);
        sel.appendChild(opt1);
        sel.appendChild(opt2);

      }
      if(type == "IDU"){
        var sel = document.getElementById('sub_risk');
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

        sel.addEventListener("click", sub_risk);

        // add opt to end of select box (sel)
        sel.appendChild(opt0);
        sel.appendChild(opt1);
        sel.appendChild(opt2);
        idu = 1;

      }
      if(type == "TG"){
        var sel = document.getElementById('sub_risk');
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

        sel.addEventListener("click", sub_risk);

        // add opt to end of select box (sel)
        sel.appendChild(opt0);
        sel.appendChild(opt1);
        sel.appendChild(opt2);
        sel.appendChild(opt3);
        tg=1;
      }
      if(type == "Partner of KP"){
        var sel = document.getElementById('sub_risk');
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

        sel.addEventListener("click", sub_risk);
          // add opt to end of select box (sel)
          sel.appendChild(opt0);
          sel.appendChild(opt1);
          sel.appendChild(opt2);
          sel.appendChild(opt3);
          sel.appendChild(opt4);
          pkp = 1;
        }
        // partner of PLHIV
      if(type == "Partner of PLHIV"){
          var sel = document.getElementById('sub_risk');
          var opt0 = document.createElement("option");
          opt0.appendChild( document.createTextNode(""));
          opt0.value = "-";
          opt0.setAttribute('id','opt_pplhiv_0');
          sel.addEventListener("click", sub_risk);
          sel.appendChild(opt0);

        }
      if(type == "Special Groups"){
        var sel = document.getElementById('sub_risk');
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

        sel.addEventListener("click", sub_risk);
        // add opt to end of select box (sel)
        sel.appendChild(opt0);
        sel.appendChild(opt1);
        sel.appendChild(opt2);
        sel.appendChild(opt3);

        sg=1;
      }
      if(type == "Migrant Population"){
        var sel = document.getElementById('sub_risk');
        var opt0 = document.createElement("option");
        opt0.appendChild( document.createTextNode(""));
        opt0.value = "-";
        opt0.setAttribute('id','opt_mig_0');
        sel.addEventListener("click", sub_risk);
        sel.appendChild(opt0);

      }
  }





</script>


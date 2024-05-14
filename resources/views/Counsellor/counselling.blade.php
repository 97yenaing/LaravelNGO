@extends('layouts.app')
@section('content')
@auth
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('js/Counselling/counselling.js') }}"></script>

<div id="customAlertBox" class="custom-alert" style="display:none">
  <label>SuccessFully Collected</label>
  <button class="btn btn-warning " id="cus_alert" onclick="custom_alert()">OK</button>
</div>
<div id="hts_warining" class="hts-warning" style="display:none">
  <label>Your Hts Data is not Complete</label>
  <button class="btn btn-warning " id="cus_alert" onclick="custom_alert()">OK</button>
</div>
<p class="btn-gnavi">
  <span></span>
  <span></span>
  <span></span>
</p>
<div class="container containers ">
  <ul class="nav nav-tabs toggle consulor-list" id="hidden-title">
    <li class="nav-item">
      <a class="nav-link active toggle-link" data-toggle="tab" href="#first" id="firstPage" onclick="">Counselling facts
        and HTS data entry</a>
    </li>
    <li class="nav-item">
      <a class="nav-link toggle-link " data-toggle="tab" href="#second" id="secondPage" onclick="">HTS
        Data/Update</a>
    </li>
    <li class="nav-item">
      <a class="nav-link toggle-link " data-toggle="tab" href="#HTS-remaining" id='hts_remaining_page'
        onclick="HTS_remaining()">HTS_Remaining</a>
    </li>
    <li class="nav-item">
      <a class="nav-link toggle-link " data-toggle="tab" href="#export">Export</a>
    </li>

  </ul>

  <div class="tab-content containers">
    <div class="tab-pane container containers active cosulor-parent-div" id="first">
      <div style="margin:auto" id="toshowResult"></div>
      <div id="hider0" class="container containers">
        <br>
        <!--   <form class="" id="reg" method="post" > -->
        @csrf
        <div class="row justify-content-center">
          <div class="col-md-12 ">
            <h3 class='header-text' style="text-align: center;">Counselling Room</h3>
          </div>
        </div>

        <div class="row counGeneral">
          <div class="col-md-2 coun_searchID">
            <label for="">Search ID</label>
            <input type="text" class="form-control" autofocus id="gid" placeholder="General ID or Fuchia ID">
          </div>
          <div class="col-md-2 consulor-date">
            <label for="">Counselling Date</label>
            <!-- <input type="date"  id="vDate"  class="form-control" required> -->
            <div class="date-holder">
              <input type="text" id="vDate" class="form-control Gdate" placeholder="dd-mm-yyyy">
              <img src="../img/calendar3.svg" class="dateimg" alt="date">
            </div>
          </div>
          <div class="col-md-1">
            <button class="btn btn-warning update-batton" id="hts-search" onclick="ptData()">Search</button>
          </div>
          <!-- <div class="col-sm-2">

                            </div> -->
          <div class="col-md-1 consulor-refresh ">
            <button class="btn btn-success refresh-follow consulor-rfr-btn" onclick="refresh()">Refresh</button>
          </div>

        </div><br>

        <br>
        <div class="row">
          <div class="col-sm-12">
            <label id="gen_data" class="form-control"></label>
          </div>
        </div>
        <br>
        <div class="row">
          <div class="row">
            <div class="col-sm-3 do-test">
              <label for="">Counselling / Patient_record</label>
              <select class="form-control" id="test_do" onchange="testDo()">
                <option selected value="counsel_info">Counselling</option>
                <option value="pat_record">Patient_record</option>
              </select>
            </div>
            <div class="col-sm-3 conunselling_type">
              <label>HTS Entry / Counselling Only</label>
              <select class="form-control" id="coun_count" onchange="Counselling_Count()">
                <option selected value="one">Counselling Only</option>
                <option value="two">HTS Entry and Counselling</option>
              </select>
            </div>
          </div>

          <div class="col-sm-2 consul-registerDate">
            <label for="">Register Date</label>
            <!-- <input type="date"  id="vDate"  class="form-control" required> -->
            <div class="date-holder">
              <input type="text" id="coun_reg_date" class="form-control Gdate" placeholder="dd-mm-yyyy" disabled>
              <img src="../img/calendar3.svg" class="dateimg" alt="date">
            </div>
          </div>
          <div class="col-md-2 consulor-date ">
            <label class="form-label">Date Of Birth</label>
            <!-- <input  type="date" id="dob" onblur="dateOfBirth_to_age()" class="form-control reception-dateformat" disabled > -->
            <div class="date-holder">
              <input type="text" id="dob" onblur="dateOfBirth()" class="form-control Gdate dob reception-dateformat"
                placeholder="dd-mm-yyyy">
              <img src="../img/calendar3.svg" class="dateimg" alt="date">
            </div>
          </div>
          <div class="col-md-2 consulor-div">
            <label for="">Counselor</label>
            <select class="form-select" id="counsellor">
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
              <option value="col_15">Counsellor 15</option>
              <option value="col_16">Counsellor 16</option>
              <option value="col_17">Counsellor 17</option>
              <option value="col_18">Counsellor 18</option>
              <option value="col_19">Counsellor 19</option>
              <option value="col_20">Counsellor 20</option>
              <option value="col_21">Counsellor 21</option>
              <option value="col_22">Counsellor 22</option>
              <option value="col_23">Counsellor 23</option>
              <option value="col_24">Counsellor 24</option>
              <option value="col_25">Counsellor 25</option>
              <option value="col_26">Counsellor 26</option>
              <option value="col_27">Counsellor 27</option>
              <option value="col_28">Counsellor 28</option>
              <option value="col_29">Counsellor 29</option>
              <option value="col_30">Counsellor 30</option>
              <option value="col_31">Counsellor 31</option>
              <option value="col_32">Counsellor 32</option>
              <option value="col_33">Counsellor 33</option>
              <option value="col_34">Counsellor 34</option>
              <option value="col_35">Counsellor 35</option>
            </select>
          </div>
          <div class="col-sm-2 change-risk">
            <label for="">Defined_Risk</label>
            <select class="form-control" id="riskChangeLab" onchange="riskChangeLab()">
              <option value="Yes">Yes</option>
              <option selected value="No">No</option>
            </select>
          </div>
          <div class="col-sm-2 labTest-date" style="display:none">
            <label for="" class="form-label">Due to patient</label>
            <select name="" id="risk_change_resason" class="form-select">
              <option value=""></option>
              <option value="Yes">Yes</option>
            </select>
          </div>

          <div class="col-sm-2 labTest-date" style="display:none">
            <label for="">Risk Change Date</label>
            <div class="date-holder">
              <input type="text" id="labTestDate" class="form-control Gdate" placeholder="dd-mm-yyyy">
              <img src="../img/calendar3.svg" class="dateimg" alt="date">
            </div>
            <!-- <input type="date"  id="labTestDate"  class="form-control" disabled required> -->
          </div>


        </div>
        <br>
        <div class="row  ">
          <!-- counselor-riskRow -->
          <div class="col-md-2 consulor-mainrisk">
            <label for="">Main Risk</label>
            <select class="form-control" id="main_risk" onchange="PatientType()" disabled>
              <option selected value="-"></option>
              <option id="preg_mom" value="Pregnant Mother">Pregnant Mother</option>
              <option id="sp_preg_mom" value="Spouse of pregnant mother">Spouse of pregnant mother
              </option>
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
          <div class="col-sm-2 consulor-subrisk">
            <label for="">Sub Risk</label>
            <select class="form-control" id="sub_risk" disabled>
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

          <div class="col-md-2 counsulor-regAge">
            <label for="validationCustom02" class="form-label">Register Age</label>
            <input type="number" id="agey_register" onblur="reg_age_change()" class="form-control">
          </div>
          <div class="col-md-2 counsulor-regAge">
            <label for="validationCustom02" class="form-label">Reg_Age(M)</label>
            <input type="number" id="agem_register" onblur="reg_age_change()" class="form-control">
          </div>
          <div class="col-md-2 consulor-age">
            <label for="validationCustom02" class="form-label">Current Age(Year)</label>
            <input type="number" id="agey" class="form-control">
            <div class="valid-feedback">
              plz put patient age.
            </div>
          </div>
          <div class="col-md-2 consulor-age">
            <label for="validationCustom02" class="form-label">Current Age(Month)</label>
            <input type="number" id="agem" onchange="monthValid()" class="form-control">
            <div class="valid-feedback">
              plz put patient age.
            </div>
          </div>

          <div class="col-md-2" style="display: none">
            <label for="validationCustom02" class="form-label">Register Age(month)</label>
            <input type="number" id="agem_register" class="form-control">
          </div>


          <div class="col-sm-2 consulor-srt" id="state_hide">
            <label for="">State / Region</label>

            <select class="form-select reception-select" id="state" required onchange="region(this.value)">
              <option selected value="-"></option>
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

            <select class="form-select reception-select" id="township">
              <option id="tt_opt"></option>
              <option selected value="-"></option>
              <option value="Insein">Insein</option>
              <option value="MingalarDon">MingalarDon</option>
              <option value="Hmawbi">Hmawbi</option>
              <option value="Hlegu">Hlegu</option>
              <option value="Taikkyi">Taikkyi</option>
              <option value="Htantabin">Htantabin</option>
              <option value="Shwepyithar">Shwepyithar</option>
              <option value="Hlaingtharya">Hlaingtharya</option>
              <option value="Thingangyun">Thingangyun</option>
              <option value="Yankin">Yankin</option>
              <option value="South Okkalapa">South Okkalapa</option>
              <option value="North Okkalapa">North Okkalapa</option>
              <option value="Thaketa">Thaketa</option>
              <option value="Dawbon">Dawbon</option>
              <option value="Tamwe">Tamwe</option>
              <option value="Pazundaung">Pazundaung</option>
              <option value="Botahtaung">Botahtaung</option>
              <option value="Dagon Myothit (South)">Dagon Myothit (South)</option>
              <option value="Dagon Myothit (North)">Dagon Myothit (North)</option>
              <option value="Dagon Myothit (East)">Dagon Myothit (East)</option>
              <option value="Dagon Myothit (Seikkan)">Dagon Myothit (Seikkan)</option>
              <option value="Mingalartaungnyunt">Mingalartaungnyunt</option>
              <option value="Thanlyin">Thanlyin</option>
              <option value="Kyauktan">Kyauktan</option>
              <option value="Thongwa">Thongwa</option>
              <option value="Kayan">Kayan</option>
              <option value="Twantay">Twantay</option>
              <option value="Kawhmu">Kawhmu</option>
              <option value="Kungyangon">Kungyangon</option>
              <option value="Dala">Dala</option>
              <option value="Seikgyikanaungto">Seikgyikanaungto</option>
              <option value="Cocokyun">Cocokyun</option>
              <option value="Kyauktada">Kyauktada</option>
              <option value="Pabedan">Pabedan</option>
              <option value="Lanmadaw">Lanmadaw</option>
              <option value="Latha">Latha</option>
              <option value="Ahlone">Ahlone</option>
              <option value="Kyeemyindaing">Kyeemyindaing</option>
              <option value="Sanchaung">Sanchaung</option>
              <option value="Hlaing">Hlaing</option>
              <option value="Kamaryut">Kamaryut</option>
              <option value="Mayangone">Mayangone</option>
              <option value="Dagon">Dagon</option>
              <option value="Bahan">Bahan</option>
              <option value="Seikkan">Seikkan</option>
            </select>

          </div>
          <div class="col-md-2 consulor-srt" id="quarter_hide">
            <label for="">Ward/Village(detail)</label>
            <input type="text" id="quarter" class="form-control" required>
          </div>
          <div class="col-sm-2 consulor-srt" id="phone_hide">
            <label for="">Phone No.1</label>
            <div>
              <input id="phone" class="form-control" type="text" name="" placeholder="09123459789">
            </div>
          </div>
          <div class="col-sm-2 consulor-srt" id="phone2_hide">
            <label for="">Phone No.2</label>
            <div>
              <input id="phone2" class="form-control" type="text" name="" placeholder="09123459789">
            </div>
          </div>
          <div class="col-sm-2 consulor-srt" id="phone3_hide">
            <label for="">Phone No.3</label>
            <div>
              <input id="phone3" class="form-control" type="text" name="" placeholder="09123459789">
            </div>
          </div>


          <div class="col-md-3">
            <button type="button" id="riskUpdate" onclick="Save_and_Update()" class="btn btn-warning update-batton "
              style="display:none">Only Patient
              Info_Update</button>
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
          <div class="row hts-entry">
            <!--service -->
            <div class="col-md-2 consulor-srt consulor-switch">
              <label for="">Service Modality</label>
              <select class="form-select" onchange="Service_Modality()" id="service" required>
                <option selected value="-"></option>
                <option value="Community">Community</option>
                <option value="Facility">Facility</option>
              </select>
            </div>
            <div class="col-md-2 consulor-srt consulor-switch">
              <label for="">Mode of Entry</label>
              <select class="form-select" id="m_o_entry" required>
                <option selected value="-"></option>
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
              <select class="form-select" id="new_old" required>
                <option selected value="-"></option>
                <option value="New">New</option>
                <option value="Old">Old</option>
              </select>
            </div>
            <div class="col-md-2 consulor-srt consulor-switch">
              <label for="">Test Type</label>
              <select class="form-select" id="lab_location" onchange="Lab_locate()">
                <option selected value="clinic_lab">Clinic Lab</option>
                <option value="self_test">Self test</option>
                <option value="cbs">Cbs</option>
                <option value="private">Private</option>

              </select>
            </div>
          </div>
          <div class="row hts-entry">
            <div class="col-sm-5 consulor-result consulor-switch">
              <!--HIV -->
              <div class="row">
                <label>HIV Test Results</label>
                <div class="input-group mb-2 no-margin">
                  <div class="date-holder">
                    <input type="text" id="hiv_test_date" class="form-control Gdate" placeholder="dd-mm-yyyy">
                    <img src="../img/calendar3.svg" class="dateimg" alt="date">
                  </div>
                  <!-- <input type="date"  id="hiv_test_date"  class="form-control" required> -->
                  <div class="input-group-prepend no-margin">
                    <button onclick="hiv_test_date()" class="btn btn-info input-group-text fetch-color">Fetch</button>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-3">
                  <label>Determine</label>
                  <select onchange="determineResult()" class="form-control" id="d_result" name="" disabled>
                    <option value=""></option>
                    <option value="Reactive">Reactive</option>
                    <option value="Non Reactive">Non Reactive</option>
                    <option value="Invalid">Invalid</option>
                  </select>
                </div>
                <div class="col-md-3">
                  <label>Uni-Gold</label>
                  <select class="form-control" onchange="hiv_uni_result()" id="uni_result" name="" disabled>
                    <option id="uni_bl" value=""></option>
                    <option value="Reactive">Reactive</option>
                    <option value="Non Reactive">Non Reactive</option>
                    <option value="Invalid">Invalid</option>
                  </select>
                </div>
                <div class="col-md-3">
                  <label>STAT-PAK</label>
                  <select class="form-control" onchange="hiv_result_cal()" id="stat_result" name="" disabled>
                    <option id="stat_bl" value=""></option>
                    <option value="Reactive">Reactive</option>
                    <option value="Non Reactive">Non Reactive</option>
                    <option value="Invalid">Invalid</option>
                  </select>
                </div>
                <div class="col-md-3">
                  <label>Final Result</label>
                  <select class="form-control" id="final_result" disabled>
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
                  <div class="date-holder">
                    <input type="text" id="hep_date" class="form-control Gdate" placeholder="dd-mm-yyyy">
                    <img src="../img/calendar3.svg" class="dateimg" alt="date">
                  </div>
                  <div class="input-group-prepend no-margin">
                    <button onclick="hepB_test_date()" class="btn btn-info input-group-text fetch-color">Fetch</button>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <label>HBsAg</label>
                  <select class="form-control" id="B_result" disabled>
                    <option value=""></option>
                    <option value="Positive">Positive</option>
                    <option value="Negative">Negative</option>
                  </select>
                </div>
                <div class="col-md-6">
                  <label>HCV Ab</label>
                  <select class="form-control" id="C_result" disabled>
                    <option value=""></option>
                    <option value="Positive">Positive</option>
                    <option value="Negative">Negative</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="col-sm-4 consulor-result consulor-switch">
              <div class="row">
                <label class="counsel-syphillis">Syphillis Test Results /Last Dilution: </label> <span
                  id="ls_rpr_dilution"></span>
                <div class="input-group mb-2">
                  <!-- <input type="date"  id="syp_date"  class="form-control" required> -->
                  <div class="date-holder">
                    <input type="text" id="syp_date" class="form-control Gdate" placeholder="dd-mm-yyyy">
                    <img src="../img/calendar3.svg" class="dateimg" alt="date">
                  </div>
                  <div class="input-group-prepend no-margin">
                    <button onclick="Rrp_test_date()" class="btn btn-info input-group-text fetch-color">Fetch</button>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <label>RDT</label>
                  <select class="form-control" id="Sy_rdt_result" disabled>
                    <option value=""></option>
                    <option value="Positive">Positive</option>
                    <option value="Negative">Negative</option>
                  </select>
                </div>
                <div class="col-md-4">
                  <label>RPR</label>
                  <select class="form-control" id="qualitative" disabled>
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
            <div class="col-md-2 counselling-prePost">

              <div class="">
                <input type="checkbox" id="pre" class="con-prepost" name="Pre"><label class="form-label"
                  style="background-color: #0F6292;display: inline;">Pre-test
                  Counselling</label>
              </div>
              <div class="">
                <input type="checkbox" id="post" class="con-prepost" name="Post"><label class="form-label"
                  style="background-color: #0F6292;display: inline;">Post-test
                  Counselling</label>
              </div>

            </div>
            <div class="col-md-2 consulor-srt " id="hts_test_done_hide">
              <label for="">HTS Testing</label>
              <select class="form-select" onchange="reason()" id="hts_test_done" required>
                <option value="Yes">Yes</option>
                <option value="No" selected>No</option>
              </select>
            </div>
            <div class="col-md-2 consulor-srt " id="hts_test_no_reason_hide">
              <label for="">Reason</label>
              <select class="form-select" onchange="" id="hts_test_no_reason" required>
                <option selected value="-"></option>
                <option value="KC">KC</option>
                <option value="OVP">OVP</option>
                <option value="RPR Only">RPR Only</option>
                <option value="Denied">Client Denied</option>
              </select>
            </div>
            <div class="col-md-2" id="status_hide">
              <label for="">Status</label>
              <select class="form-select" onchange="" disabled id="status">
                <option selected value="-"></option>
                <option value="Enroll to Clinic">Enroll to Clinic</option>
                <option value="Refer or Temporary">Refer or Temporary</option>
                <option value="Client denied">Client denied</option>
              </select>
            </div>
            <div class="col-md-2 " id="prep_hide">
              <div class="consulor-prepCounseling">
                <input type="checkbox" id="prep" class="con-prepost" name="PrEP"><label class="form-label"
                  style="background-color: #0F6292;display: inline;">PrEP
                  Counselling</label>
              </div>
            </div>
            <div class="col-md-2 " id="prep_status_hide">
              <label for="">PrEP Status</label>
              <select class="form-select" onchange="" id="prep_status" required>
                <option selected value="-"></option>
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
            <div class="form-check-inline col-sm-1" id="c1_hide">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" id="c1" value="" name="c1">C1
              </label>
            </div>
            <div class="form-check-inline col-sm-1" id="c2_hide">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" id="c2" value="" name="c2">C2
              </label>
            </div>
            <div class="form-check-inline col-sm-1" id="c2_hide" style="display:none">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" id="c2_done" value="" name="c2_done">C2 Done
              </label>
            </div>
            <div class="form-check-inline col-sm-1" id="c3_hide">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" id="c3" value="" name="c3">C3
              </label>
            </div>
            <div class="form-check-inline col-sm-1" id="adh_hide">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" id="adh" value="" name="adh">ADH
              </label>
            </div>
            <div class="form-check-inline col-sm-1" id="eac_hide">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" id="eac" value="" name="eac"> EAC
              </label>
            </div>
            <div class="form-check-inline col-sm-1" id="stable_hide">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" id="stable" value="" name="stable">Stable
              </label>
            </div>
            <div class="form-check-inline col-sm-1" id="pmtct_hide">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" id="pmtct" value="" name="pmtct"> PMTCT
              </label>
            </div>
            <div class="form-check-inline col-sm-1" id="presention_hide">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" id="presention" value="" name="case_presention"> Case
                Presention
              </label>
            </div>
            <div class="form-check-inline col-sm-1" id="ncd_hide">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" id="ncd" value="" name="ncd"> NCD
              </label>
            </div>
            <div class="form-check-inline col-sm-1" id="child_adoles_hide" style="display:none">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" id="child_adoles" value="" name="Child_under15_Adoles">
                &#60;15 Adoles
              </label>
            </div>
            <div class="form-check-inline col-sm-1" id="child_dis_hide">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" id="child_dis" value="" onclick="counsellingDo(this)"
                  name="Child_under15_Dis">
                &#60;15 Disclosure
              </label>
              <select name="disclosure_def" id="child_dis_sub" class="form-select sub-select">
                <option value=""></option>
                <option value="Partial">Partial</option>
                <option value="Full">Full</option>
              </select>
            </div>
            <div class="form-check-inline col-sm-1" id="child_adh_hide">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" id="child_adh" value="" name="Child_under15_ADH">&#60;15
                ADH
              </label>
            </div>
            <div class="form-check-inline col-sm-1" id="c_p_case_hide">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" id="c_p_case" value="" name="c_p_case"> C P case
              </label>
            </div>
            <div class="form-check-inline col-sm-1" id="pfa_hide">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" id="pfa" value="" name="pfa"> PFA
              </label>
            </div>
            <div class="form-check-inline col-sm-1" id="phq9_hide">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input " id="phq9" value="" name="phq9"
                  onclick="counsellingDo(this)"> PHQ9
              </label>
              <select name="phq9_def" id="phq9_sub" class="form-select sub-select">
                <option value=""></option>
                <option value="Partial">Partial</option>
                <option value="Follow up">Follow up</option>
              </select>
            </div>
            <div class="form-check-inline col-sm-1">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" id="hepC" name="hepC" value=""> Hep C
              </label>
            </div>
            <div class="form-check-inline col-sm-1" id="hmt_hide">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" id="hmt" value="" name="hmt">FHT
              </label>
            </div>
            <div class="form-check-inline col-sm-1" id="ipt_hide">
              <label class="form-check-label ">
                <input type="checkbox" class="form-check-input" id="ipt" value="" onclick="counsellingDo(this)"
                  name="ipt"> ART+TB
              </label>{{-- ipt is art+tb --}}

              <select name="ipt_artTB_def" id="ipt_sub" class="form-select sub-select">
                <option value=""></option>
                <option value="month 0">month 0</option>
                <option value="month 2">month 2</option>
                <option value="month 3">month 3</option>
                <option value="month 5">month 5</option>
                <option value="month 6">month 6</option>
                <option value="month 8">month 8</option>
                <option value="month 10">month 10</option>
                <option value="month 12">month 12</option>
              </select>
            </div>
            <div class="form-check-inline col-sm-1" id="mmt_hide">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" id="mmt" value="" name="mmt"> OST
              </label>
            </div>

            <div class="form-check-inline col-sm-1" id="tb_hide">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" id="tb" value="" name="tb"
                  onclick="counsellingDo(this)">Only TB
              </label>
              <select name="tb_def" id="tb_sub" class="form-select sub-select">
                <option value=""></option>
                <option value="month 0">month 0</option>
                <option value="month 2">month 2</option>
                <option value="month 3">month 3</option>
                <option value="month 5">month 5</option>
                <option value="month 6">month 6</option>
                <option value="month 8">month 8</option>
                <option value="month 10">month 10</option>
                <option value="month 12">month 12</option>
              </select>
            </div>
            <div class="form-check-inline col-sm-1" id="onlyIpt_hide">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" id="onlyIpt" value="" name="only_ipt"> Only IPT
              </label>
            </div>


            <div class="form-check-inline col-sm-1" id="anc_hide">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" id="anc" value="" name="anc"> ANC
              </label>
            </div>


            <div class="form-check-inline col-sm-1" id="other_hide">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" id="other" value="" name="Other"> Other
              </label>
            </div>


            <div class="form-check-inline col-sm-1">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" id="phq4" value="" name="phq4"> PHQ4
              </label>
            </div>
            <div class="form-check-inline col-sm-1">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" id="gad7" value="" onclick="counsellingDo(this)"
                  name="gad7"> GAD7
              </label>
              <select name="gad7_def" id="gad7_sub" class="form-select sub-select">
                <option value=""></option>
                <option value="Partial">Partial</option>
                <option value="Follow up">Follow up</option>
              </select>
            </div>
            <div class="form-check-inline col-sm-1">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" id="brest_cancer" value="" name="brest_cancer"> Breast
                Cancer
              </label>
            </div>

            <div class="form-check-inline col-sm-1">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" id="art_ost" value="" name="art_ost"> ART+OST
              </label>
            </div>
            <div class="form-check-inline col-sm-1">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" id="d1" value="" name="d1"> D1
              </label>
            </div>
            <div class="form-check-inline col-sm-1">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" id="d2" value="" name="d2">D2
              </label>
            </div>
            <div class="form-check-inline col-sm-1">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" id="d3" value="" name="d3"> D3
              </label>
            </div>
            <div class="form-check-inline col-sm-1">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" id="d4" value="" name="d4"> D4
              </label>
            </div>
            <div class="form-check-inline col-sm-1">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" id="cage" value="" name="cage"> CAGE
              </label>
            </div>
          </div>

          <br>
          <div class='row'>

            <div class="col-sm-2 tablet-pc">
              <button type="button" id="saveBton" onclick="Save_and_Update()"
                class="btn btn-warning update-batton ">Save</button>
            </div>
            <div class="col-sm-2">
              <button type="button" id="updateBton" style="display:none;" onclick="Save_and_Update()"
                class="btn btn-warning update-batton ">Update</button>
            </div>
            <div class="col-md-6 ">
              <label style="color:yellow;" id="responseText">With Lab Risk Data Updated</label>
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
          <select class="form-control" id="update_type">
            <option selected value="upd_counsel">Counselling Updated</option>
            <option value="upd_HTS">HTS_Updated</option>
          </select>
        </div>
        <div class="col-sm-2 counHTS-date">
          <label for="validationCustom01" class="form-label HTS-label">From(dd-mm-yyyy)</label>
          <div class="date-holder">
            <input type="text" id="dateFrom" class="form-control Gdate" placeholder="dd-mm-yyyy">
            <img src="../img/calendar3.svg" class="dateimg" alt="date">
          </div>
          <!-- <input id="dateFrom" type="date" autofocus class="form-control" > -->
        </div>

        <div class="col-sm-2 counHTS-date">
          <label for="validationCustom01" class="form-label HTS-label">To(dd-mm-yyyy)</label>
          <div class="date-holder">
            <input type="text" id="dateTo" class="form-control Gdate" placeholder="dd-mm-yyyy">
            <img src="../img/calendar3.svg" class="dateimg" alt="date">
          </div>
          <!-- <input id="dateTo" type="date"  class="form-control" > -->
        </div>
        <div class="col-md-2 id_searchType " style="display:none">
          <input type="text" class="form-control" autofocus="" id="sid" placeholder="General ID ">
        </div>
        <div class="col-sm-1 no-margin counselShow">
          <button type="button" id="updateBton" onclick="HTS_list()" class="btn btn-primary counHTS-show ">Show</button>
        </div>
      </div>


      <!-- <div class="row date_typeRow">
                            
                            
                          </div> -->
      <div class="row justify-content-center counselHTS-table">
        <table class="table  counsel-update-list">
          <thead>
            {{-- <tr>
              <th>Serial</th>
              <th>General ID</th>
              <th>Fuchia ID</th>
              <th>Visit Date</th>
              <th class="tablet-pc">To Update</th>
            </tr> --}}
          </thead>
          <tbody id='list'>
          </tbody>
        </table>
      </div>
    </div>
    <div class="tab-pane container containers cosulor-parent-div" id="HTS-remaining">
      <h2 class="header-text">HTS Remaning List</h2>

      <div class="row">
        <div class="col-sm-3 hts-remaining-info" id="hts_remaing_count">
          <h4>HTS Remaining Patient-0</h4>
        </div>
      </div>
      <div class="hts_remaining_block">
        <div class="row">
          <div class="col-sm-2 hts-remain-date">
            <label for="" class="form-label">HTS Start Date</label>
            <div class="date-holder">
              <input type="text" id="date_HTS_From" class="form-control Gdate" placeholder="dd-mm-yyyy">
              <img src="../img/calendar3.svg" class="dateimg" alt="date">
            </div>
          </div>
          <div class="col-sm-2 hts-remain-date">
            <label for="" class="form-label">HTS End Date</label>
            <div class="date-holder">
              <input type="text" id="date_HTS_To" class="form-control Gdate" placeholder="dd-mm-yyyy">
              <img src="../img/calendar3.svg" class="dateimg" alt="date">
            </div>
          </div>
          <div class="col-sm-2 hts-remain-date">
            <button class="btn btn-info hts-remain-btn" onclick="HTS_remaining()">Search</button>
          </div>
        </div>
        <div id="remainig_hts_list">
          <div class="row hts-main-head">
            <div class="col-sm-1">No.</div>
            <div class="col-sm-2 remian-head-Id">General ID</div>
            <div class="col-sm-2 remian-head-age">Age</div>
            <div class="col-sm-2 remian-head-sex">Sex</div>
            <div class="col-sm-2 remian-head-risk">Risk</div>
            <div class="col-sm-2 remian-head-vdate">Visit date</div>
          </div>

        </div>

      </div>
    </div>
    <div class="tab-pane container containers cosulor-parent-div " id="export">
      <h1>Export</h1>
      <form action="{{ route('counsellor_export') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <br>
        <div class="row ">

          <div class="col-md-2 export-counHts">
            <label for="">HTS or Counselling data</label>
            <select class="form-select" name="hts_coul" required>
              <option value="hts_data">HTS Data</option>
              <option value="counsel_data">Counselling Data</option>
            </select>
          </div>

          <div class="col-sm-2 counexport-date">
            <label class="form-label HTS-label">From(dd-mm-yyyy)</label>
            <!-- <input id="from_export" name="dateFrom" type="date" autofocus class="form-control" > -->
            <div class="date-holder">
              <input type="text" id="from_export" name="dateFrom" class="form-control Gdate" placeholder="dd-mm-yyyy">
              <img src="../img/calendar3.svg" class="dateimg" alt="date">
            </div>
          </div>

          <div class="col-sm-2 counexport-date">
            <label class="form-label HTS-label">To(dd-mm-yyyy)</label>
            <!-- <input id="to_export" name="dateTo" type="date"  class="form-control" > -->
            <div class="date-holder">
              <input type="text" id="to_export" name="dateTo" class="form-control Gdate" placeholder="dd-mm-yyyy">
              <img src="../img/calendar3.svg" class="dateimg" alt="date">
            </div>
          </div>
          <div class="col-sm-1  coun-export no-margin">
            <button class="btn btn-primary counHTS-show ">Export</button>
          </div>
        </div>
        <br>
      </form>
    </div>
  </div>

</div>

@endauth
@endsection
<script type="text/javascript" language="javascript">
  let Ptype_sub = "";
  let pregMum = 0;
  let spm = 0;
  let epc = 0;
  let lr = 0;
  let fsw = 0;
  let msm = 0;
  let idu = 0;
  let pkp = 0;
  let sg = 0;
  let tg = 0;
  let generatedID = 0;
  let generatedID1 = 0;
  let genID = [];
  let ddDate = 0;
  let service = '';
  let patient_generalInfo = [];
  let Age = 0;
  let hts_row_address = 0;
  let resp = 0;
  let address = 0;
  let updatedType = 1; //updated list show counselling Only
  let old_risk;
  let counselling_type_array=[
    "Pre","pre",   // db,id
    "Post","post",
    "HTSdone","hts_test_done",
    "Reason","hts_test_no_reason",
    "Status","status",
    "PrEP","prep",
    "PrEP Status","prep_status",
    "C1","c1",
    "C2","c2",
    "C3","c3",
    "ADH","adh",
    "Child under15 Adoles","child_adoles",
    "Child under15 Dis","child_dis",
    "Child under15 ADH","child_adh",
    "MMT","mmt",//now OSt
    "IPT","ipt",
    "TB","tb",
    "NCD","ncd",
    "ANC","anc",
    "PFA","pfa",
    "PHQ9","phq9",
    "Other","other",
    "EAC","eac",
    "HMT","hmt",
    "C P case","c_p_case",
    "PMTCT","pmtct",
    "c2_done","c2_done",
    "stable","stable",
    "phq4","phq4",
    "gad7","gad7",
    "brest_cancer","brest_cancer",
    "hepC","hepC",
    "art_ost","art_ost",
    "d1","d1",
    "d2","d2",
    "d3","d3",
    "d4","d4",
    "cage","cage",
    "Disclosure_Define","child_dis_sub",
    "Case_Presention","presention",
    "PHQ9_Define","phq9_sub",
    "PHATB_Define","ipt_sub",
    "Only_IPT","onlyIpt",
    "Only_TB_Define","tb_sub",
    "gad7_Define","gad7_sub",
  ]


  function HTS_remaining() {
    var datefrom = formatDate($("#date_HTS_From").val());
    var dateto = formatDate($("#date_HTS_To").val());
    if (datefrom == '' && dateto == '') {
      datefrom = dateto = today;
    }
    let hts_remain = {
      datefrom: datefrom,
      dateto: dateto,
      notice: "HTS Remaining"
    }
    console.log(hts_remain)
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
      }
    });
    $.ajax({
      type: 'POST',
      url: "{{ route('counsellor_room') }}",
      dataType: 'json',
      contentType: 'application/json',
      data: JSON.stringify(hts_remain),
      success: function(response) {
        console.log(response);
        counting = (Object.keys(response[0]).length);
        $("#hts_remaing_count h4").text("HTS Remaining Patient--" + counting)
        $(".remain_data").remove();
        for (let hts_count = 0; hts_count < counting; hts_count++) {
          var hts_remain_list = $("<div>").attr({
              class: 'row remain_data'
            })
            .append($("<div>").attr({
              class: 'col-sm-1'
            }).text(hts_count + 1))
            .append($("<div>").attr({
              class: 'col-sm-2'
            }).append($("<button class='btn btn-info'  onclick='To_entry_section()'>").text(
              response[0][hts_count]["CID"])))
            .append($("<div>").attr({
              class: 'col-sm-2'
            }).text(response[0][hts_count]["agey"]))
            .append($("<div>").attr({
              class: 'col-sm-2'
            }).text(response[0][hts_count]["Gender"]))
            .append($("<div>").attr({
              class: 'col-sm-2'
            }).text(response[0][hts_count]["Patient_Type"]))
            .append($("<div>").attr({
              class: 'col-sm-2'
            }).text(response[0][hts_count]["vdate"]));
          $("#remainig_hts_list").append(hts_remain_list);

        }
      }
    })
  }

  function counsellingDo(targetid) {
    let checkid = $(targetid).attr("id");
    if ($(targetid).prop("checked")) {
      $(targetid).parent().parent().children().eq(1).show();
    } else {
      $(targetid).parent().parent().children().eq(1).val("").hide();
    }
  }

  function To_entry_section() {
    $("#first input,#first select").val("");
    $("#first span").text("");
    $("#riskChangeLab").val("No");
    $("#test_do").val("counsel_info");
    $("#coun_count").val("one");
    $("#first input[type='checkbox']:checked").prop("checked", false);
    $("#firstPage,#first").addClass("active");
    $("#hts_remaining_page,#HTS-remaining").removeClass("active");
    var gid = $(event.target).text();
    var vdate = $(event.target).parent().parent().children().eq(5).text();
    $("#gid").val(gid);
    $("#vDate").val(vdate);
  }

  function Lab_locate() {
    var lab_located = $("#lab_location").val();
    if (lab_located == "clinic_lab" || lab_located == "self_test" || lab_located == "cbs") {
      $("#d_result,#uni_result,#stat_result,#final_result,#B_result,#C_result,#Sy_rdt_result,#qualitative,#syp_vdrl")
        .prop("disabled", true);
    } else {
      $("#d_result,#uni_result,#stat_result,#final_result,#B_result,#C_result,#Sy_rdt_result,#qualitative,#syp_vdrl")
        .prop("disabled", false);
    }
  }

  function riskChangeLab() {

    if ($("#riskChangeLab").val() == "Yes") {
      $(".labTest-date").show();
      $("#main_risk,#sub_risk").prop("disabled", false)
    } else {
      $(".labTest-date").hide();
      $("#main_risk,#sub_risk").prop("disabled", true)
    }
  }

  function custom_alert() {

    $(".cosulor-parent-div").removeClass('freeze-body');
    $("#customAlertBox").hide();
    $("#hts_warining").hide();
    location.reload(true);


  }

  function testDo() {
    var test_do = $("#test_do").val();
    console.log(test_do);
    if (test_do == "counsel_info") {

      $(".counselling_test").show();
      $("#riskUpdate").hide();
      $(".conunselling_type").show();
      Counselling_Count();


    } else {
      $(".counselling_test").hide();
      $("#riskUpdate").show();
      $(".conunselling_type").hide();
      $("#labTestDate").prop("disabled", false);

    }
  }

  function type_Search() {
    var s_type = $("#search_type").val();
    if (s_type == "id_type") {
      $(".counHTS-Formtext,.counHTS-date,.counHTS-Totext,.counHTS-date").hide();
      $(".id_searchType").show();
      $("#dateFrom").val("");
      $("#dateTo").val("");
    } else {
      $(".counHTS-Formtext,.counHTS-date,.counHTS-Totext,.counHTS-date").show();
      $(".id_searchType").hide();
      $(".id_searchType").val("");
    }
  }

  function HTS_list() {
    var listShow = 1;
    var search_ID = $("#sid").val();
    var dateFrom = document.getElementById('dateFrom').value;
    dateFrom = formatDate(dateFrom); // date FormatChange YYYY/MM/DD
    var dateTo = document.getElementById('dateTo').value;
    dateTo = formatDate(dateTo); // date FormatChange YYYY/MM/DD

    if ($("#update_type").val() == "upd_counsel") {
      updatedType = 1;
    } else {
      updatedType = 0;
    }
    var ckdata = {
      dateFrom: dateFrom,
      dateTo: dateTo,
      listShow: listShow,
      search_ID: search_ID,
      updatedType: updatedType,

    };
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
      }
    });
    $.ajax({
      type: 'POST',
      url: "{{ route('counsellor_room') }}",
      dataType: 'json',
      contentType: 'application/json',
      data: JSON.stringify(ckdata),
      success: function(response) {
        $("#list").empty();
        $(".counsel-update-list thead tr").remove();
        $(".appointment-table p").empty();
        console.log(response);
        resp = response;

        if (response != "no data") {
          if (response[1] == 0) {
            var couns_update_thead = $("<tr>").append($("<td>").text("No."))
              .append($("<td>").text("General_ID"))
              .append($("<td>").text("Fuchia_ID"))
              .append($("<td>").text("Visit Date"))
              .append($("<td>").text("Age"))
              .append($("<td>").text("Age(M)"))
              .append($("<td>").text("Risk"))
              .append($("<td>").text("HIV Result"))
              .append($("<td>").text("New/Old"))
              .append($("<td>").text("To Updated"))
            $(".counsel-update-list thead").append(couns_update_thead);

          } else {
            var couns_update_thead = $("<tr>").append($("<td>").text("No."))
              .append($("<td>").text("General_ID"))
              .append($("<td>").text("Fuchia_ID"))
              .append($("<td>").text("Visit Date"))
              .append($("<td>").text("Age"))
              .append($("<td>").text("Agem(M)"))
              .append($("<td>").text("Risk"))
              .append($("<td>").text("To Updated"))
            $(".counsel-update-list thead").append(couns_update_thead);

          }
          for (var i = 0; i < response[0].length; i++) {
            var rowName = "tr_" + i;
            var btnName = "btn_" + i;
            var srNum = i + 1;

            if (response[1] == 0) {
              var result_body1 =
                "<tr style='background-color:#A7DBD8; color:#000000;'" + "id='" + rowName +
                "'>" +
                "<td id='updateSerial1'>" + srNum + "</td>" +
                "<td id='col_3'>" + response[0][i]['Pid'] + "</td>" +
                "<td>" + response[0][i]['FuchiaID'] + "</td>" +
                "<td >" + (response[0][i]['Counselling_Date']) + "</td>" +
                "<td>" + response[0][i]['Register Age'] + "</td>" +
                "<td>" + response[0][i]['Register Agem'] + "</td>" +
                "<td>" + response[0][i]['Main Risk'] + "</td>" +
                "<td>" + response[0][i]['HIV_Final_Result'] + "</td>" +
                "<td>" + response[0][i]['New_Old'] + "</td>" +
                "<td class= tablet-pc id='" + btnName + "'>" +
                "<button class='btn btn-info btn-warning' id='counselling_update_" +
                response[0][i]['id'] + "'  onclick='updateFiller()'  >" + "Update" +
                "</button>" +
                "<button class='btn btn-info btn-danger counsel-delete' id='counselling_remove_" +
                response[0][i]['id'] + "' onclick='remove_row()'  >" + "Delete" +
                "</button>" + "</td>" +
                "</tr>";
            } else {
              var result_body1 =
                "<tr style='background-color:#A7DBD8; color:#000000;'" + "id='" + rowName +
                "'>" +
                "<td id='updateSerial1'>" + srNum + "</td>" +
                "<td id='col_3'>" + response[0][i]['Pid'] + "</td>" +
                "<td>" + response[0][i]['FuchiaID'] + "</td>" +
                "<td >" + (response[0][i]['Counselling_Date']) + "</td>" +
                "<td>" + response[0][i]['Register Age'] + "</td>" +
                "<td>" + response[0][i]['Register Agem'] + "</td>" +
                "<td>" + response[0][i]['Main Risk'] + "</td>" +
                "<td class= tablet-pc id='" + btnName + "'>" +
                "<button class='btn btn-info btn-warning' id='counselling_update_" +
                response[0][i]['id'] + "'  onclick='updateFiller()'  >" + "Update" +
                "</button>" +
                "<button class='btn btn-info btn-danger counsel-delete' id='counselling_remove_" +
                response[0][i]['id'] + "' onclick='remove_row()'  >" + "Delete" +
                "</button>" + "</td>" +
                "</tr>";

            }

            $("#list").append(result_body1);
          }
        } else {
          var result_body1 =
            "<p class='no-updateData'>Patient Does Not Have In This Date Please Choice Correct Date</p>"
          $(".appointment-table").append(result_body1);
        }

        updatedType = response[1];

      }
    });
  } // to show HTS data rows
  function updateFiller() {
    $("#saveBton").hide();
    $("#labTestDate").hide();
    $("#updateBton").show();
    $(".conunselling_type,.do-test,.change-risk").hide();
    address = event.target.id.match(/\d+/)[0];
    var id = $(event.target).parent().parent().children().eq(1).text();
    var res_date = formatDate($(event.target).parent().parent().children().eq(3).text());
    var decryptFetch = 1;
    var search_ID = $("#sid").val();
    var dateFrom = document.getElementById('dateFrom').value;
    dateFrom = formatDate(dateFrom); // date FormatChange YYYY/MM/DD
    var dateTo = document.getElementById('dateTo').value;
    dateTo = formatDate(dateTo); // date FormatChange YYYY/MM/DD
    var data = {
      address: address,
      decryptFetch: decryptFetch,
      id: id,
      res_date: res_date,
      updatedType: updatedType,
    };
    console.log(data);

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
      }
    });
    $.ajax({
      type: 'POST',
      url: "{{ route('counsellor_room') }}",
      dataType: 'json',
      contentType: 'application/json',
      data: JSON.stringify(data),
      success: function(response) {
        $("#first input,#first select").val("");
        $("#first span").text("");
        $("#riskChangeLab").val("No");

        $("#first input[type='checkbox']:checked").prop("checked", false);
        $("#firstPage,#first").addClass("active");
        $("#secondPage,#second").removeClass("active");
        $('.consulor-switch').hide();
        console.log(response);
        register_date = response[31]['Reg Date']
        console.log(register_date + "reg date");
        patient_generalInfo["Pid"] = response[0]; // Global
        patient_generalInfo["Fuchia_ID"] = response[1]; //Global
        patient_generalInfo["Gender"] = response[10]; //Global
        patient_generalInfo["PrEPCode"] = response[31]["PrEPCode"]; //Global
        patient_generalInfo["Clinic Code"] = response[31]["Clinic Code"]
        date_origin = response[31]["Agey"] // golbal variable in app blade;

        var Pid = response[0];

        var FuchiaID = response[1];

        var Sex = response[10];


        document.getElementById("gen_data").innerHTML =
          "General ID :" + Pid + ",&nbsp;&nbsp;&nbsp;&nbsp;" +
          "Fuchia ID :" + FuchiaID + ",&nbsp;&nbsp;&nbsp;&nbsp;" +
          "Sex :" + Sex + ",&nbsp;&nbsp;&nbsp;&nbsp;";

        $("#gid").val(response[0]);
        $("#gid").prop("disabled", true);

        // $("#agey").val(response[2]);

        Age = response[2]; // to global varriable
        $("#vDate").val(response[6]);
        $("#counsellor").val(response[11]);
        $("#state").val(response[29]);
        region();
        $("#township").val(response[30]);
        $("#quarter").val(response[28]);
        $("#phone").val(response[25]);
        $("#phone2").val(response[26]);
        $("#phone3").val(response[27]);


        if (response[3] == 1) {
          document.getElementById("pre").checked = "true";
        }
        if (response[4] == 1) {
          document.getElementById("post").checked = "true";
        }



        $("#main_risk").val(response[14]);
        $("#sub_risk").val(response[15]);
        $("#coun_reg_date").val(register_date);
        if (updatedType == 0) {
          $('.consulor-switch').show();

          $("#new_old").val(response[5]);


          $("#lab_location").val(response[56])
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



        if ($('#d_result').val != "" && $('#final_result').val != "") {
          $("#hts_test_done").val("Yes").prop("selected", true);
        }
        $("#hts-search").prop("disabled", true);
        $("#updateBton").prop("disabled", false);

        var data_fillNO = 1;
        for (var check = 37; check < response.length - 1; check++) {
          if (response[check] == 1) {
            $(".chk" + data_fillNO).prop("checked", true);
          }
          data_fillNO++;

        } //fill type of counselling
        if (response[36] == 1) {
          $("#prep").prop("checked", true);
        }
        $("#hts_test_no_reason").val(response[34]);
        $("#status").val(response[35]);
        $("#prep_status").val(response[33]);
        $("#agey_register").val(date_origin)
        $("#agem_register").val(response[31]["Agem"])
        $(".change-risk,#labTestDate").show();

        DateTo_text();
        dateOfBirth();
      }
    });

  } // filling data to HTS register


  function remove_row() {
    var id = event.target.id.match(/\d+/)[0];
    var Pid = $(event.target).parent().parent().children().eq(1).text();
    var counselling_date = formatDate($(event.target).parent().parent().children().eq(3).text());
    var htsUpdate = "remove_row";
    let remove_data = {
      id: id,
      Pid,
      Pid,
      counselling_date: counselling_date,
      update_type: updatedType,
      htsUpdate: htsUpdate,
    }
    console.log(remove_data);
    if (confirm("Are you sure to delete this data")) {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        }
      });
      $.ajax({
        type: 'POST',
        url: "{{ route('counsellor_room') }}",
        dataType: 'json',
        contentType: 'application/json',
        data: JSON.stringify(remove_data),
        success: function(response) {
          alert(response);
          if (response != "Your Wrong Credential contant to Admin" && response !=
            "You don't have permission to delete this record") {
            HTS_list();
          }
        }
      })

    }

  }

  function Counselling_Count() {
    if ($("#coun_count").val() == "one") {
      $("#responseText").text("Without Lab Data");
      $("#labTestDate").prop("disabled", true);
      $("#hts-onOff").hide();
      $(".consulor-switch").hide();
    } else {
      $("#responseText").text("With Lab Risk Data Updated");
      $("#labTestDate").prop("disabled", false);
      $("#hts-onOff").show();
      $(".consulor-switch").show();

    }

  }

  function Save_and_Update() {
    var pt_data_update = $(event.target).text();
    console.log(pt_data_update);
    var hts_counselling = 0;
    var counsellingOnly = 0;
    var switch_ck = $("#coun_count").val();
    console.log(switch_ck + "switch question");
    if (switch_ck == "two") {
      var hts_counselling = 1; // 1 for  HTS and counselling / 0 for only counselling
    } else {
      var counsellingOnly = 1;
    }


    dateOfBirth();
    console.log(ddDate + "hello date of birth" + hts_counselling);
    var calDob = ddDate;
    var pre_post = document.getElementById("coun_count").value;
    var Pid = patient_generalInfo["Pid"];
    var FuchiaID = patient_generalInfo["Fuchia_ID"];
    var PrEPCode = patient_generalInfo["PrEPCode"];
    var Gender = patient_generalInfo["Gender"];
    clinic_code = patient_generalInfo["Clinic Code"];

    var created_by = document.getElementById("navbarDropdown").innerHTML;
    var Agey = document.getElementById("agey").value;
    var Agem = document.getElementById("agem").value;
    if (!Agem) {
      Agem = 0;
    }
    var Counselling_Date = document.getElementById("vDate").value;
    Counselling_Date = formatDate(Counselling_Date); // date FormatChange YYYY/MM/DD

    var Counsellor = document.getElementById("counsellor").value;
    var HTSdone = document.getElementById("hts_test_done").value;

    var Reason = document.getElementById("hts_test_no_reason").value;
    var Status = document.getElementById("status").value;
    var PrEP_Status = document.getElementById("prep_status").value;
    var test_locate = $("#lab_location").val();


    var state = document.getElementById("state").value;
    if (state.length < 1) {
      state = "-";
    }
    var township = document.getElementById("township").value;
    if (township.length < 1) {
      township = "-";
    }
    var quarter = document.getElementById("quarter").value;
    if (quarter.length < 1) {
      quarter = "-";
    }
    var phone = document.getElementById("phone").value;
    if (phone.length < 1) {
      phone = "-";
    }
    var phone2 = document.getElementById("phone2").value;
    if (phone2.length < 1) {
      phone2 = "-";
    }
    var phone3 = document.getElementById("phone3").value;
    if (phone3.length < 1) {
      phone3 = "-";
    }
    var Main_Risk = document.getElementById("main_risk").value;
    if (Main_Risk.length < 1) {
      Main_Risk = "-";
    }
    var Sub_Risk = document.getElementById("sub_risk").value;
    if (Sub_Risk.length < 1) {
      Sub_Risk = "-";
    }
    var service = document.getElementById("service").value;
    if (service.length < 1) {
      service = "-";
    }
    var mode_of_entry = document.getElementById("m_o_entry").value;
    if (mode_of_entry.length < 1) {
      mode_of_entry = "-";
    }
    var new_old = document.getElementById("new_old").value;
    if (new_old.length < 1) {
      new_old = "-";
    }

    var hiv_test_date = document.getElementById("hiv_test_date").value;
    hiv_test_date = formatDate(hiv_test_date); // date FormatChange YYYY/MM/DD
    if (hiv_test_date.length < 1) {
      hiv_test_date = "-";
    }
    var hiv_determine = document.getElementById("d_result").value;
    if (!hiv_determine.length) {
      hiv_determine = "-";
    } else {
      console.log("hello hiv determine");
      $("#hts_test_done").val("Yes").prop("selected", true);
      var HTSdone = document.getElementById("hts_test_done").value;
      console.log(HTSdone);
    }

    var hiv_unigold = document.getElementById("uni_result").value;
    if (hiv_unigold.length < 1) {
      hiv_unigold = "-";
    }
    var hiv_stat = document.getElementById("stat_result").value;
    if (hiv_stat.length < 1) {
      hiv_stat = "-";
    }
    var hiv_final = document.getElementById("final_result").value;
    if (hiv_final.length < 1) {
      hiv_final = "-";
    }

    var syp_date = document.getElementById("syp_date").value;
    syp_date = formatDate(syp_date); // date FormatChange YYYY/MM/DD
    if (syp_date.length < 1) {
      syp_date = "-";
    }
    var syp_rdt = document.getElementById("Sy_rdt_result").value;
    if (syp_rdt.length < 1) {
      syp_rdt = "-";
    }
    var syp_rpr = document.getElementById("qualitative").value;
    if (syp_rpr.length < 1) {
      syp_rpr = "-";
    }
    var syp_vdrl = document.getElementById("syp_vdrl").value;
    if (syp_vdrl.length < 1) {
      syp_vdrl = "-";
    }

    var hep_date = document.getElementById("hep_date").value;
    hep_date = formatDate(hep_date); // date FormatChange YYYY/MM/DD
    if (hep_date.length < 1) {
      hep_date = "-";
    }
    var hep_b = document.getElementById("B_result").value;
    if (hep_b.length < 1) {
      hep_b = "-";
    }
    var hep_c = document.getElementById("C_result").value;
    if (hep_c.length < 1) {
      hep_c = "-";
    }
    var col_data = {};

    if (hts_counselling == 1 || counsellingOnly == 1 || pt_data_update == "Only Patient Info_Update" ||
      pt_data_update == "Update") {

      if (pt_data_update == "Only Patient Info_Update" || pt_data_update == "Update") {
        hts_counselling = 0;
        counsellingOnly = 0;
      }
      if (hts_counselling == 1) {
        hts_OK = true
        if (hiv_final == "" || service == "" || mode_of_entry == "" || new_old == "") {
          console.log("freeze body")
          $('html, body').animate({
            scrollTop: 0
          }, 'fast');
          $("#hts_warining").show();
          $(".cosulor-parent-div").addClass('freeze-body');
          var hts_OK = false;
        }
      }
      if (hts_OK || counsellingOnly == 1 || pt_data_update == "Only Patient Info_Update" || pt_data_update ==
        "Update") {
        col_data = {
          clinic_code: clinic_code,
          Pid: Pid,
          FuchiaID: FuchiaID,
          PrEPCode: PrEPCode,
          Gender: Gender,
          created_by: created_by,
          Agey: Agey,
          Agem: Agem,
          calDob: calDob,
          test_locate: test_locate,
          edit: edit,
          Counselling_Date: Counselling_Date,
          Counsellor: Counsellor,
          Main_Risk: Main_Risk,
          Sub_Risk: Sub_Risk,

          state: state,
          township: township,
          quarter: quarter,
          phone: phone,
          phone2: phone2,
          phone3: phone3,

          service: service,
          mode_of_entry: mode_of_entry,
          new_old: new_old,

          hiv_test_date: hiv_test_date,
          hiv_determine: hiv_determine,
          hiv_unigold: hiv_unigold,
          hiv_stat: hiv_stat,
          hiv_final: hiv_final,

          syp_date: syp_date,
          syp_rdt: syp_rdt,
          syp_rpr: syp_rpr,
          syp_vdrl: syp_vdrl,
          hep_date: hep_date,
          hep_b: hep_b,
          hep_c: hep_c,

          PrEP_Status:PrEP_Status,
          HTSdone: HTSdone,
          Reason: Reason,
          Status: Status,
          hts_counselling: hts_counselling,
          counsellingOnly: counsellingOnly,
          pt_data_update: pt_data_update,
        };
        if (pt_data_update == "Update") {
          col_data["address"] = address;
          col_data["updatedType"] = updatedType;
        }
        if ($("#riskChangeLab").val() == "No") {
          col_data['labTestDate'] = Counselling_Date;
        } else {
          col_data['change_risk_rason'] = $("#risk_change_resason").val();
          col_data['labTestDate'] = col_data["risk_change_date"] = formatDate(document.getElementById(
            "labTestDate").value);
          col_data['old_risk'] = old_risk;
        }




        col_data["register_age"] = $("#agey_register").val();
        $("#first input[type='checkbox']").each(function(index) {
          col_data[$(this).attr("name")] =$(this).prop("checked")? 1:0 ;
          $(this).addClass("chk" + (index + 1));
        })
        $(".counselling-type select").each(function(index) {
          if($(this).parent().find("input").prop("checked")){
            $(this).val() == "" ? (alert("Counselling အမျိုးအစား ကို သတ်မှတ် ပေးပါ၊၊"),$(this).focus(),$(this).css("border-color","red")) : col_data[$(this).attr("name")] = $(this).val();
            
          }else{
            col_data[$(this).attr("name")] = $(this).val()
          }
        })
        
        console.log(col_data);
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
          }
        });
        $.ajax({
          type: 'POST',
          url: "{{ route('counsellor_room') }}",
          dataType: 'json',
          //  processData:false,
          contentType: 'application/json',
          data: JSON.stringify(col_data),
          success: function(response) {
            console.log(response);
            console.log(response[0].length + "hello length");


            var resp = response[0];
            switch (resp) {
              case 0:
                alert("This Patient Don't Test in Lab Please First Point  to Lab");
                break;
              case 1:
                $('html, body').animate({
                  scrollTop: 0
                }, 'fast');
                $("#customAlertBox").show();
                $(".cosulor-parent-div").addClass('freeze-body');




                break;
              case 1.5:
                $('html, body').animate({
                  scrollTop: 0
                }, 'fast');
                $("#customAlertBox").show();
                $(".cosulor-parent-div").addClass('freeze-body');



                break;
              case 1.1:
                alert("This Patient do not test in Any_Lab at" + labTestDate);
                break;
              case 2:
                alert("This Patient do not Pass Reception Center");
                break;
              case 2.1:
                alert("This Patient do not test Any HTS Test on");
                break;
              case 2.2:
                alert("This Patient has been Collected in thsi day");
                break;
              case 3:
                alert("This Patient can not update,contant to Admin");
                break;
              case 3.2:
                alert("Your Update is not complete,'Fail'");
                break;
            }

            if (resp.length > 5) {
              $("#responseText").empty();
              var test_name = ["Hiv", "Rpr", "Hbc", "Urine", "Oi", "Sti_Lab", "Afb",
                "General", "Stool", "Covid", "Viral"
              ];
              var mesage_result = "";


              for (var up_res = 0; up_res < response[0].length; up_res++) {
                $("#responseText").empty();
                if (response[0][up_res] == "1") {
                  console.log("hello 1")
                  var mesage_result = mesage_result.concat("", test_name[up_res] + "/");
                }
              }
              $("#responseText").text(mesage_result + "Updated in" + $("#labTestDate").val());
              $(".alert").css("background-color", "yellow");
              $('html, body').animate({
                scrollTop: 0
              }, 'fast');
              $("#customAlertBox").show();
              $(".cosulor-parent-div").addClass('freeze-body');



            }
          }
        });

      }
    }
  }

  function reason() {
    var hts_test_done = document.getElementById('hts_test_done').value;
    if (hts_test_done == "Yes") {
      document.getElementById('hts_test_no_reason').disabled = true;
      document.getElementById('status').disabled = false;
    } else {
      document.getElementById('hts_test_no_reason').disabled = false;
      document.getElementById('status').disabled = true;
    }
  }

  function hiv_test_date() {
    hiv_test = 1;
    var gid = document.getElementById('gid').value;
    var hiv_test_date = document.getElementById("hiv_test_date").value;
    document.getElementById("syp_date").value = hiv_test_date;
    document.getElementById("hep_date").value = hiv_test_date;
    hiv_test_date = formatDate(hiv_test_date); // date FormatChange YYYY/MM/DD
    console.log(hiv_test_date + "hiv test date");

    var data = {
      hiv_test: hiv_test,
      gid: gid,
      hiv_test_date: hiv_test_date,
    };
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
      }
    });
    $.ajax({
      type: 'POST',
      url: "{{ route('counsellor_room') }}",
      dataType: 'json',
      //  processData:false,
      contentType: 'application/json',
      data: JSON.stringify(data),
      success: function(response) {
        console.log(response);

        document.getElementById('d_result').value = response[1];
        document.getElementById('uni_result').value = response[2];
        document.getElementById('stat_result').value = response[3];

        var Hivtest_result_return = response[4];
        document.getElementById('final_result').value = Hivtest_result_return;
        if (Hivtest_result_return == "Negative") {
          document.getElementById('hts_test_done').value = "Yes";
          document.getElementById('status').disabled = true;
        } else {
          document.getElementById('hts_test_done').value = "Yes";
        }

        document.getElementById('hts_test_no_reason').disabled = true;



      }
    });
  } //Fetching HIV test Result from Lab
  function hiv_result_cal() {
    var d_result = document.getElementById("d_result").value;
    var uni_result = document.getElementById("uni_result").value;
    var stat_result = document.getElementById("stat_result").value;
    console.log(d_result);
    console.log(uni_result);
    console.log(stat_result);

    if (d_result == "Reactive" && uni_result == "Reactive" && stat_result == "Reactive") {
      document.getElementById("Positive").selected = "true";
    }
    if (d_result == "Reactive") {
      if (uni_result == "Reactive" && stat_result == "Non Reactive") {
        document.getElementById("Inconclusive").selected = "true";
      }
    }
    if (d_result == "Reactive") {
      if (uni_result == "Non Reactive" && stat_result == "Reactive") {
        document.getElementById("Inconclusive").selected = "true";
      }
    }
    if (d_result == "Reactive") {
      if (uni_result == "Reactive" && stat_result == "Non Reactive") {
        document.getElementById("Inconclusive").selected = "true";
      }
    }
    if (d_result == "Reactive") {
      if (uni_result == "Non Reactive" && stat_result == "Non Reactive") {
        document.getElementById("Negative").selected = "true";
      }
    }
    if (uni_result == "Invalid" || stat_result == "Invalid") {
      //document.getElementById('stat_result').disabled =true ;
      document.getElementById("Inconclusive").selected = "true";
    }


  }

  function determineResult() {
    var result = document.getElementById('d_result').value;
    if (result == "Reactive") {
      document.getElementById('uni_result').disabled = false;
      document.getElementById('stat_result').disabled = false;
    }
    if (result == "Non Reactive") {
      document.getElementById("uni_bl").selected = "true";
      document.getElementById("stat_bl").selected = "true";
      document.getElementById('neg').selected = true;
      document.getElementById('uni_result').disabled = true;
      document.getElementById('stat_result').disabled = true;
    }
    if (result == "Invalid") {
      document.getElementById("uni_bl").selected = "true";
      document.getElementById("stat_bl").selected = "true";
      document.getElementById('uni_result').disabled = true;
      document.getElementById('stat_result').disabled = true;
    }
  }

  function hiv_uni_result() {
    var uni_result = document.getElementById("uni_result").value;
    if (uni_result == "Non Reactive" || uni_result == "Invalid") {
      document.getElementById('stat_result').disabled = true;
      document.getElementById("Inconclusive").selected = "true";
    } else {
      document.getElementById('stat_result').disabled = false;
    }
  }

  function Rrp_test_date() {
    rpr_test = 1;
    var gid = document.getElementById('gid').value;
    var rpr_test_date = document.getElementById("syp_date").value;
    rpr_test_date = formatDate(rpr_test_date); // date FormatChange YYYY/MM/DD

    var data = {
      rpr_test: rpr_test,
      gid: gid,
      rpr_test_date: rpr_test_date,
    };
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
      }
    });
    $.ajax({
      type: 'POST',
      url: "{{ route('counsellor_room') }}",
      dataType: 'json',
      //  processData:false,
      contentType: 'application/json',
      data: JSON.stringify(data),
      success: function(response) {
        console.log(response);

        document.getElementById('Sy_rdt_result').value = response[1];
        document.getElementById('qualitative').value = response[2];

      }
    });
  }

  function hepB_test_date() {
    hepB_test = 1;
    var gid = document.getElementById('gid').value;
    var hepB_test_date = document.getElementById("hep_date").value;
    hepB_test_date = formatDate(hepB_test_date); // date FormatChange YYYY/MM/DD

    var data = {
      hepB_test: hepB_test,
      gid: gid,
      hepB_test_date: hepB_test_date,
    };
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
      }
    });
    $.ajax({
      type: 'POST',
      url: "{{ route('counsellor_room') }}",
      dataType: 'json',
      //  processData:false,
      contentType: 'application/json',
      data: JSON.stringify(data),
      success: function(response) {
        console.log(response);

        document.getElementById('B_result').value = response[1];
        document.getElementById('C_result').value = response[2];

      }
    });
  }

  function ptData() { // to find patient data
    document.getElementById("updateBton").disabled = true;
    console.log(edit + "edit")
    // For Date

    var vdate = document.getElementById('vDate').value;
    year = vdate.split("-")[2];
    document.getElementById('hiv_test_date').value = vdate;
    document.getElementById('syp_date').value = vdate;
    document.getElementById('hep_date').value = vdate;
    document.getElementById('labTestDate').value = vdate;

    var gid = document.getElementById('gid').value;
    var c_code = 81;
    var gidLength = gid.length;

    $(".counselling-type input[type='checkbox']").each(function(index) {
      $(this).removeClass("chk" + (index + 1));
    }) // removing  Class to fill already have  data ye naing

    let ckID = 1;
    var checkPatient = 1;
    var ckdata = {
      gid: gid,
      ckID: ckID,
      year: year,
      vdate: formatDate(vdate),
    };
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
      }
    });
    $.ajax({
      type: 'POST',
      url: "{{ route('counsellor_room') }}",
      dataType: 'json',
      contentType: 'application/json',
      data: JSON.stringify(ckdata),
      success: function(response) {
        console.log(response);
          if (response[0] != null) {
            register_date = response[0]["Reg Date"]
            old_risk = response[11];
            resp = response;
            if (register_date != null && register_date != "") {
              document.getElementById('responseText').innerHtML = "";
              generatedID = response[0]['id'];
              if (response[13] == "new") {
                $("#dob").prop("disabled", false);
              }

              patient_generalInfo["Pid"] = response[0]["Pid"]; // Global
              patient_generalInfo["Fuchia_ID"] = response[0]["FuchiaID"]; //Global
              patient_generalInfo["PrEPCode"] = response[0]["PrEPCode"]; //Global
              patient_generalInfo["Gender"] = response[10]; //Global
              patient_generalInfo["Clinic Code"] = response[0]["Clinic Code"]
              $("#agey_register").val(response[0]['Agey'])
              $("#agem_register").val(response[0]['Agem'])
              $("#coun_reg_date").val(register_date);
              Agem = response[0]['Agem']
              var Name = response[1];
              var Region = response[2];
              var Township = response[3];
              var qut = response[4];
              if (qut == '') {
                document.getElementById("quarter").value = '';
              } else {
                console.log("qut" + qut);
                document.getElementById("quarter").value = qut;
              }

              if (patient_generalInfo["Pid"] == null) {
                patient_generalInfo["Pid"] = "____";
              }
              if (patient_generalInfo["Gender"] == null) {
                patient_generalInfo["Gender"] == "____";
              }
              if (Age == null) {
                Age = "____";
              }
              if (Agem == null) {
                Agem = "_";
              }
              if (Region == null) {
                Region = '____';
              }
              if (Township == null) {
                Township = '____';
              }
              dilution = response[16];
              if (dilution == null) {
                dilution = '____';
              }
              var dil_date = response[17];

              var dil_date = dil_date.split("-");
              var dilYear = dil_date[0];
              var dilMonth = dil_date[1];
              var dilDay = dil_date[2];
              dil_date = dilDay + "-" + dilMonth + "-" + dilYear;

              if (dil_date == null) {
                dil_date = "_";
              }
              document.getElementById("gen_data").innerHTML =
                "General ID :" + patient_generalInfo["Pid"] + ",&nbsp;&nbsp;&nbsp;&nbsp;" +
                "Fuchia ID :" + patient_generalInfo["Fuchia_ID"] +
                ",&nbsp;&nbsp;&nbsp;&nbsp;" +
                "Name :" + response[1] + ",&nbsp;&nbsp;&nbsp;&nbsp;" +
                "Sex :" + patient_generalInfo["Gender"] + ",&nbsp;&nbsp;&nbsp;&nbsp;" +
                "Township :" + Township + ",&nbsp;&nbsp;&nbsp;&nbsp;" +
                "Last RPR Dilution :" + dilution + "(" + dil_date + ")"

              ;



              //document.getElementById("vDate").value=today;
              document.getElementById("state").value = response[2];
              document.getElementById("township").value = response[3];
              document.getElementById("phone").value = response[5];
              document.getElementById("phone2").value = response[6];
              document.getElementById("phone3").value = response[7];
              // document.getElementById("dob").value=response[9];

              document.getElementById("main_risk").value = response[11];
              PatientType();
              document.getElementById("sub_risk").value = response[12];
              var new_old_ck = response[8];
              if (new_old_ck == true) {
                document.getElementById("new_old").value = "Old";
              } else {
                document.getElementById("new_old").value = "New";
                document.getElementById("new_old").style = "color:red";
              }
              if (response[15] == true) {
                // $.each(counselling_type_array, function( index, value ) {
                //   if($("#"+counselling_type_array[index+1]).is("select")){
                //     $("#"+counselling_type_array[index+1]).is("select").val(response[14][index])
                //   }
                //   $("#"+counselling_type_array[index+1])
                // });
                for (let check_select = 0; check_select < counselling_type_array.length; check_select+=2) {
                  if($("#"+counselling_type_array[check_select+1]).is("select")){
                    $("#"+counselling_type_array[check_select+1]).val(response[14][counselling_type_array[check_select]])
                  }else{
                    response[14][counselling_type_array[check_select]] == 1 ? ($("#"+counselling_type_array[check_select+1]).prop("checked",true)):$("#"+counselling_type_array[check_select+1]).prop("checked",false);
                  }
                }

                // if (response[14][0] == "1") {
                //   $("#pre").prop("checked", true);
                // }
                // if (response[14][1] == "1") {
                //   $("#post").prop("checked", true);
                // }

                // $(".counselling-type input[type='checkbox']").each(function(index) {
                //   $(this).addClass("chk" + (index + 1));
                // }) // adding Class to fill already have  data

                // $("#hts_test_done").val(response[14][2]);
                // $("#hts_test_no_reason").val(response[14][3]);
                // $("#status").val(response[14][4]);
                // if (response[14][5] == "1") {
                //   $("#prep").prop("checked", true);
                // }
                // $("#prep_status").val(response[14][6]);
                // var data_fillNO = 1; // to fill the class type of counseling data
                // for (var check = 7; check < response[14].length; check++) {
                //   if (response[14][check] == 1) {
                //     $(".chk" + data_fillNO).prop("checked", true);
                //   }
                //   data_fillNO++;
                // }
              }

              $("#ls_rpr_dilution").text(response[16]);

              $("#hts-search").prop("disabled", true);

              date_origin = response[0]["Agey"]

              DateTo_text();
              dateOfBirth();


            } else {
              alert("This Patient do not include Register Date Fill at Reception")
            }
          }else {
            alert("This Patient do not pass reception")
          }
        

      }
    });






  }

  function region() {
    //to check state in Region option
    var state = document.getElementById("state").value;

    if (state == "Shan(East)") { //
      var Tcount = 15;
      const shan_e = [];
      shan_e[0] = "Kengtung";
      shan_e[1] = "Mongkhet";
      shan_e[2] = "Mongyang";
      shan_e[3] = "Mongla";
      shan_e[4] = "Monghsat";
      shan_e[5] = "Mongping";
      shan_e[6] = "Mongton";
      shan_e[7] = "Tachileik";
      shan_e[8] = "Monghpyak";
      shan_e[9] = "Mongyawng";
      shan_e[10] = "Mong Hpen";
      shan_e[11] = "Ho Tawng (Ho Tao)";
      shan_e[12] = "Mong Pawk";
      shan_e[13] = "Mong Kar";
      shan_e[14] = "Nam Hpai";

      // to clear option in select township
      var tt_inner = document.getElementById('township');
      if (tt_inner.innerHTML != null) {
        tt_inner.innerHTML = "";
      }
      // to show township
      for (var i = 0; i < Tcount; i++) {
        // get reference to select element
        var sel = document.getElementById('township');
        // create new option element
        var opt = document.createElement("option");
        // create text node to add to option element (opt)
        opt.appendChild(document.createTextNode(shan_e[i]));
        // set value property of opt
        opt.value = shan_e[i];
        // add opt to end of select box (sel)
        sel.appendChild(opt);
      }
    }
    if (state == "Sagaing") { //
      var Tcount = 34;
      const sagaing = [];
      sagaing[0] = "Sagaing";
      sagaing[1] = "Myinmu";
      sagaing[2] = "Myaung";
      sagaing[3] = "Shwebo";
      sagaing[4] = "Khin-U";
      sagaing[5] = "Wetlet";
      sagaing[6] = "Kanbalu";
      sagaing[7] = "Kyunhla";
      sagaing[8] = "Ye-U";
      sagaing[9] = "Tabayin";
      sagaing[10] = "Taze";
      sagaing[11] = "Monywa";
      sagaing[12] = "Budalin";
      sagaing[13] = "Ayadaw";
      sagaing[14] = "Chaung-U";
      sagaing[15] = "Yinmarbin";
      sagaing[16] = "Kani";
      sagaing[17] = "Salingyi";
      sagaing[18] = "Pale";
      sagaing[19] = "Katha";
      sagaing[20] = "Indaw";
      sagaing[21] = "Tigyaing";
      sagaing[22] = "Banmauk";
      sagaing[23] = "Kawlin";
      sagaing[24] = "Wuntho";
      sagaing[25] = "Pinlebu";
      sagaing[26] = "Kale";
      sagaing[27] = "Kalewa";
      sagaing[28] = "Mingin";
      sagaing[29] = "Tamu";
      sagaing[30] = "Mawlaik";
      sagaing[31] = "Paungbyin";
      sagaing[32] = "Hkamti";
      sagaing[33] = "Homalin";
      sagaing[34] = "Lay Shi";
      sagaing[35] = "Lahe";
      sagaing[36] = "Nanyun";

      // to clear option in select township
      var tt_inner = document.getElementById('township');
      if (tt_inner.innerHTML != null) {
        tt_inner.innerHTML = "";
      }
      // to show township
      for (var i = 0; i < Tcount; i++) {
        // get reference to select element
        var sel = document.getElementById('township');
        // create new option element
        var opt = document.createElement("option");
        // create text node to add to option element (opt)
        opt.appendChild(document.createTextNode(sagaing[i]));
        // set value property of opt
        opt.value = sagaing[i];
        // add opt to end of select box (sel)
        sel.appendChild(opt);
      }
    }
    if (state == "Rakhine") { //
      var Tcount = 17;
      const rakhine = [];
      rakhine[0] = "Sittwe";
      rakhine[1] = "Ponnagyun";
      rakhine[2] = "Mrauk-U";
      rakhine[3] = "Kyauktaw";
      rakhine[4] = "Minbya";
      rakhine[5] = "Myebon";
      rakhine[6] = "Pauktaw";
      rakhine[7] = "Rathedaung";
      rakhine[8] = "Maungdaw";
      rakhine[9] = "Buthidaung";
      rakhine[10] = "Kyaukpyu";
      rakhine[11] = "Munaung";
      rakhine[12] = "Ramree";
      rakhine[13] = "Ann";
      rakhine[14] = "Thandwe";
      rakhine[15] = "Toungup";
      rakhine[16] = "Gwa";
      // to clear option in select township
      var tt_inner = document.getElementById('township');
      if (tt_inner.innerHTML != null) {
        tt_inner.innerHTML = "";
      }
      // to show township
      for (var i = 0; i < Tcount; i++) {
        // get reference to select element
        var sel = document.getElementById('township');
        // create new option element
        var opt = document.createElement("option");
        // create text node to add to option element (opt)
        opt.appendChild(document.createTextNode(rakhine[i]));
        // set value property of opt
        opt.value = rakhine[i];
        // add opt to end of select box (sel)
        sel.appendChild(opt);
      }
    }

    //Nay Pyi Taw
    if (state == "Nay Pyi Taw") { //
      var Tcount = 8;
      const naypyitaw = [];
      naypyitaw[0] = "Zay Yar Thi Ri";
      naypyitaw[1] = "Za Bu Thi Ri";
      naypyitaw[2] = "Tatkon";
      naypyitaw[3] = "Det Khi Na Thi Ri";
      naypyitaw[4] = "Poke Ba Thi Ri";
      naypyitaw[5] = "Pyinmana";
      naypyitaw[6] = "Lewe";
      naypyitaw[7] = "Oke Ta Ra Thi Ri";
      // to clear option in select township
      var tt_inner = document.getElementById('township');
      if (tt_inner.innerHTML != null) {
        tt_inner.innerHTML = "";
      }
      // to show township
      for (var i = 0; i < Tcount; i++) {
        // get reference to select element
        var sel = document.getElementById('township');
        // create new option element
        var opt = document.createElement("option");
        // create text node to add to option element (opt)
        opt.appendChild(document.createTextNode(naypyitaw[i]));
        // set value property of opt
        opt.value = naypyitaw[i];
        // add opt to end of select box (sel)
        sel.appendChild(opt);
      }
    }

    //Mon
    if (state == "Mon") { //
      var Tcount = 10;
      const mon = [];
      mon[0] = "Mawlamyine";
      mon[1] = "Kyaikmaraw";
      mon[2] = "Chaungzon";
      mon[3] = "Thanbyuzayat";
      mon[4] = "Mudon";
      mon[5] = "Ye";
      mon[6] = "Thaton";
      mon[7] = "Paung";
      mon[8] = "Kyaikto";
      mon[9] = "Bilin";
      // to clear option in select township
      var tt_inner = document.getElementById('township');
      if (tt_inner.innerHTML != null) {
        tt_inner.innerHTML = "";
      }
      // to show township
      for (var i = 0; i < Tcount; i++) {
        // get reference to select element
        var sel = document.getElementById('township');
        // create new option element
        var opt = document.createElement("option");
        // create text node to add to option element (opt)
        opt.appendChild(document.createTextNode(mon[i]));
        // set value property of opt
        opt.value = mon[i];
        // add opt to end of select box (sel)
        sel.appendChild(opt);
      }
    }

    //Mandalay
    if (state == "Mandalay") {
      var Tcount = 28;
      const mandalay = [];
      mandalay[0] = "Aungmyaythazan";
      mandalay[1] = "Chanayethazan";
      mandalay[2] = "Mahaaungmyay";
      mandalay[3] = "Chanmyathazi";
      mandalay[4] = "Pyigyitagon";
      mandalay[5] = "Amarapura";
      mandalay[6] = "Patheingyi";
      mandalay[7] = "Pyinoolwin";
      mandalay[8] = "Madaya";
      mandalay[9] = "Singu";
      mandalay[10] = "Mogoke";
      mandalay[11] = "Thabeikkyin";
      mandalay[12] = "Kyaukse";
      mandalay[13] = "Sintgaing";
      mandalay[14] = "Myittha";
      mandalay[15] = "Tada-U";
      mandalay[16] = "Myingyan";
      mandalay[17] = "Taungtha";
      mandalay[18] = "Natogyi";
      mandalay[19] = "Kyaukpadaung";
      mandalay[20] = "Ngazun";
      mandalay[21] = "Nyaung-U";
      mandalay[22] = "Yamethin";
      mandalay[23] = "Pyawbwe";
      mandalay[24] = "Meiktila";
      mandalay[25] = "Mahlaing";
      mandalay[26] = "Thazi";
      mandalay[27] = "Wundwin";

      // to clear option in select township
      var tt_inner = document.getElementById('township');
      if (tt_inner.innerHTML != null) {
        tt_inner.innerHTML = "";
      }
      // to show township
      for (var i = 0; i < Tcount; i++) {
        // get reference to select element
        var sel = document.getElementById('township');
        // create new option element
        var opt = document.createElement("option");
        // create text node to add to option element (opt)
        opt.appendChild(document.createTextNode(mandalay[i]));
        // set value property of opt
        opt.value = mandalay[i];
        // add opt to end of select box (sel)
        sel.appendChild(opt);
      }
    }

    //Magway
    if (state == "Magway") {
      var Tcount = 26;
      const magway = [];
      magway[0] = "Magway";
      magway[1] = "Yenangyaung";
      magway[2] = "Chauk";
      magway[3] = "Taungdwingyi";
      magway[4] = "Myothit";
      magway[5] = "Natmauk";
      magway[6] = "Minbu";
      magway[7] = "Pwintbyu";
      magway[8] = "Ngape";
      magway[9] = "Lemyethna";
      magway[10] = "Salin";
      magway[11] = "Sidoktaya";
      magway[12] = "Thayet";
      magway[13] = "Minhla";
      magway[14] = "Mindon";
      magway[15] = "Kamma";
      magway[16] = "Aunglan";
      magway[17] = "Sinbaungwe";
      magway[18] = "Pakokku";
      magway[19] = "Yesagyo";
      magway[20] = "Myaing";
      magway[21] = "Pauk";
      magway[22] = "Seikphyu";
      magway[23] = "Gangaw";
      magway[24] = "Tilin";
      magway[25] = "Saw";
      // to clear option in select township
      var tt_inner = document.getElementById('township');
      if (tt_inner.innerHTML != null) {
        tt_inner.innerHTML = "";
      }
      // to show township
      for (var i = 0; i < Tcount; i++) {
        // get reference to select element
        var sel = document.getElementById('township');
        // create new option element
        var opt = document.createElement("option");
        // create text node to add to option element (opt)
        opt.appendChild(document.createTextNode(magway[i]));
        // set value property of opt
        opt.value = magway[i];
        // add opt to end of select box (sel)
        sel.appendChild(opt);
      }
    }

    if (state == "Kayin") { //
      var Tcount = 7;
      const kayin = [];
      kayin[0] = "Hpa-An";
      kayin[1] = "Hlaingbwe";
      kayin[2] = "Hpapun";
      kayin[3] = "Thandaunggyi";
      kayin[4] = "Myawaddy";
      kayin[5] = "Kawkareik";
      kayin[6] = "Kyainseikgyi";
      // to clear option in select township
      var tt_inner = document.getElementById('township');
      if (tt_inner.innerHTML != null) {
        tt_inner.innerHTML = "";
      }
      // to show township
      for (var i = 0; i < Tcount; i++) {
        // get reference to select element
        var sel = document.getElementById('township');
        // create new option element
        var opt = document.createElement("option");
        // create text node to add to option element (opt)
        opt.appendChild(document.createTextNode(kayin[i]));
        // set value property of opt
        opt.value = kayin[i];
        // add opt to end of select box (sel)
        sel.appendChild(opt);
      }
    }

    if (state == "Kayah") { //
      var Tcount = 7;
      const kayah = [];
      kayah[0] = "Loikaw";
      kayah[1] = "Demoso";
      kayah[2] = "Hpruso";
      kayah[3] = "Shadaw";
      kayah[4] = "Bawlake";
      kayah[5] = "Hpasawng";
      kayah[6] = "Mese";
      // to clear option in select township
      var tt_inner = document.getElementById('township');
      if (tt_inner.innerHTML != null) {
        tt_inner.innerHTML = "";
      }
      // to show township
      for (var i = 0; i < Tcount; i++) {
        // get reference to select element
        var sel = document.getElementById('township');
        // create new option element
        var opt = document.createElement("option");
        // create text node to add to option element (opt)
        opt.appendChild(document.createTextNode(kayah[i]));
        // set value property of opt
        opt.value = kayah[i];
        // add opt to end of select box (sel)
        sel.appendChild(opt);
      }
    }

    if (state == "Kachin") { //
      var Tcount = 17;
      const kachin = [];
      kachin[0] = "Myitkyina";
      kachin[1] = "Waingmaw";
      kachin[2] = "Injangyang";
      kachin[3] = "Tanai";
      kachin[4] = "Chipwi";
      kachin[5] = "Tsawlaw";
      kachin[6] = "Mohnyin";
      kachin[7] = "Mogaung";
      kachin[8] = "Hpakant";
      kachin[9] = "Bhamo";
      kachin[10] = "Momauk";
      kachin[11] = "Mansi";
      kachin[12] = "Puta-O";
      kachin[13] = "Sumprabum";
      kachin[14] = "Machanbaw";
      kachin[15] = "Nawngmun";
      kachin[16] = "Khaunglanhpu";
      // to clear option in select township
      var tt_inner = document.getElementById('township');
      if (tt_inner.innerHTML != null) {
        tt_inner.innerHTML = "";
      }
      // to show township
      for (var i = 0; i < Tcount; i++) {
        // get reference to select element
        var sel = document.getElementById('township');
        // create new option element
        var opt = document.createElement("option");
        // create text node to add to option element (opt)
        opt.appendChild(document.createTextNode(kachin[i]));
        // set value property of opt
        opt.value = kachin[i];
        // add opt to end of select box (sel)
        sel.appendChild(opt);
      }
    }

    if (state == "Chin") {
      var Tcount = 9;
      const chin = [];
      chin[0] = "Falam";
      chin[1] = "Hakha";
      chin[2] = "Thantlang";
      chin[3] = "Tedim";
      chin[4] = "Tonzang";
      chin[5] = "Mindat";
      chin[6] = "Matupi";
      chin[7] = "Kanpetlet";
      chin[8] = "Paletwa";
      // to clear option in select township
      var tt_inner = document.getElementById('township');
      if (tt_inner.innerHTML != null) {
        tt_inner.innerHTML = "";
      }
      // to show township
      for (var i = 0; i < Tcount; i++) {
        // get reference to select element
        var sel = document.getElementById('township');
        // create new option element
        var opt = document.createElement("option");
        // create text node to add to option element (opt)
        opt.appendChild(document.createTextNode(chin[i]));
        // set value property of opt
        opt.value = chin[i];
        // add opt to end of select box (sel)
        sel.appendChild(opt);
      }
    }

    if (state == "Bago(West)") { //
      var Tcount = 14;
      const Bago_E = [];
      Bago_E[0] = "Pyay";
      Bago_E[1] = "Paukkhaung";
      Bago_E[2] = "Padaung";
      Bago_E[3] = "Paungde";
      Bago_E[4] = "Thegon";
      Bago_E[5] = "Shwedaung";
      Bago_E[6] = "Thayarwady";
      Bago_E[7] = "Letpadan";
      Bago_E[8] = "Minhla";
      Bago_E[9] = "Okpho";
      Bago_E[10] = "Zigon";
      Bago_E[11] = "Nattalin";
      Bago_E[12] = "Monyo";
      Bago_E[13] = "Gyobingauk";
      // to clear option in select township
      var tt_inner = document.getElementById('township');
      if (tt_inner.innerHTML != null) {
        tt_inner.innerHTML = "";
      }
      // to show township
      for (var i = 0; i < Tcount; i++) {
        // get reference to select element
        var sel = document.getElementById('township');
        // create new option element
        var opt = document.createElement("option");
        // create text node to add to option element (opt)
        opt.appendChild(document.createTextNode(Bago_E[i]));
        // set value property of opt
        opt.value = Bago_E[i];
        // add opt to end of select box (sel)
        sel.appendChild(opt);
      }
    }
    //Ayeyarwady
    if (state == "Ayeyarwady") {
      var Tcount = 26;
      const Ayeyar = [];
      Ayeyar[0] = "Pathein";
      Ayeyar[1] = "Kangyidaunt";
      Ayeyar[2] = "Thabaung";
      Ayeyar[3] = "Ngapudaw";
      Ayeyar[4] = "Kyonpyaw";
      Ayeyar[5] = "Yegyi";
      Ayeyar[6] = "Kyaunggon";
      Ayeyar[7] = "Hinthada";
      Ayeyar[8] = "Zalun";
      Ayeyar[9] = "Lemyethna";
      Ayeyar[10] = "Myanaung";
      Ayeyar[11] = "Kyangin";
      Ayeyar[12] = "Ingapu";
      Ayeyar[13] = "Myaungmya";
      Ayeyar[14] = "Einme";
      Ayeyar[15] = "Labutta";
      Ayeyar[16] = "Wakema";
      Ayeyar[17] = "Mawlamyinegyun";
      Ayeyar[18] = "Maubin";
      Ayeyar[19] = "Pantanaw";
      Ayeyar[20] = "Nyaungdon";
      Ayeyar[21] = "Danubyu";
      Ayeyar[22] = "Pyapon";
      Ayeyar[23] = "Bogale";
      Ayeyar[24] = "Kyaiklat";
      Ayeyar[25] = "Dedaye";
      // to clear option in select township
      var tt_inner = document.getElementById('township');
      if (tt_inner.innerHTML != null) {
        tt_inner.innerHTML = "";
      }
      // to show township
      for (var i = 0; i < Tcount; i++) {
        // get reference to select element
        var sel = document.getElementById('township');
        // create new option element
        var opt = document.createElement("option");
        // create text node to add to option element (opt)
        opt.appendChild(document.createTextNode(Ayeyar[i]));
        // set value property of opt
        opt.value = Ayeyar[i];
        // add opt to end of select box (sel)
        sel.appendChild(opt);
      }
    }
    //Bago(east)
    if (state == "Bago(East)") {
      var Tcount = 14;
      const bago = [];
      bago[0] = "Bago";
      bago[1] = "Thanatpin";
      bago[2] = "Kawa";
      bago[3] = "Waw";
      bago[4] = "Nyaunglebin";
      bago[5] = "Kyauktaga";
      bago[6] = "Daik-U";
      bago[7] = "Shwegyin";
      bago[8] = "Taungoo";
      bago[9] = "Yedashe";
      bago[10] = "Kyaukkyi";
      bago[11] = "Phyu";
      bago[12] = "Oktwin";
      bago[13] = "Htantabin";
      // to clear option in select township
      var tt_inner = document.getElementById('township');
      if (tt_inner.innerHTML != null) {
        tt_inner.innerHTML = "";
      }
      // to show township
      for (var i = 0; i < Tcount; i++) {
        // get reference to select element
        var sel = document.getElementById('township');
        // create new option element
        var opt = document.createElement("option");
        // create text node to add to option element (opt)
        opt.appendChild(document.createTextNode(bago[i]));
        // set value property of opt
        opt.value = bago[i];
        // add opt to end of select box (sel)
        sel.appendChild(opt);
      }
    }
    if (state == "Yangon") {
      var Tcount = 45;
      const yangon = [];
      yangon[0] = "Hlaingtharya";
      yangon[1] = "MingalarDon";
      yangon[2] = "Hmawbi";
      yangon[3] = "Hlegu";
      yangon[4] = "Taikkyi";
      yangon[5] = "Htantabin";
      yangon[6] = "Shwepyithar";
      yangon[7] = "Insein";
      yangon[8] = "Thingangyun";
      yangon[9] = "Yankin";
      yangon[10] = "South Okkalapa";
      yangon[11] = "North Okkalapa";
      yangon[12] = "Thaketa";
      yangon[13] = "Dawbon";
      yangon[14] = "Tamwe";
      yangon[15] = "Pazundaung";
      yangon[16] = "Botahtaung";
      yangon[17] = "Dagon Myothit (South)";
      yangon[18] = "Dagon Myothit (North)";
      yangon[19] = "Dagon Myothit (East)";
      yangon[20] = "Dagon Myothit (Seikkan)";
      yangon[21] = "Mingalartaungnyunt";
      yangon[22] = "Thanlyin";
      yangon[23] = "Kyauktan";
      yangon[24] = "Thongwa";
      yangon[25] = "Kayan";
      yangon[26] = "Twantay";
      yangon[27] = "Kawhmu";
      yangon[28] = "Kungyangon";
      yangon[29] = "Dala";
      yangon[30] = "Seikgyikanaungto";
      yangon[31] = "Cocokyun";
      yangon[32] = "Kyauktada";
      yangon[33] = "Pabedan";
      yangon[34] = "Lanmadaw";
      yangon[35] = "Latha";
      yangon[36] = "Ahlone";
      yangon[37] = "Kyeemyindaing";
      yangon[38] = "Sanchaung";
      yangon[39] = "Hlaing";
      yangon[40] = "Kamaryut";
      yangon[41] = "Mayangone";
      yangon[42] = "Dagon";
      yangon[43] = "Bahan";
      yangon[44] = "Seikkan";
      // to clear option in select township
      var tt_inner = document.getElementById('township');
      if (tt_inner.innerHTML != null) {
        tt_inner.innerHTML = "";
      }
      // to show township
      for (var i = 0; i < Tcount; i++) {
        // get reference to select element
        var sel = document.getElementById('township');
        // create new option element
        var opt = document.createElement("option");
        // create text node to add to option element (opt)
        opt.appendChild(document.createTextNode(yangon[i]));
        // set value property of opt
        opt.value = yangon[i];
        // add opt to end of select box (sel)
        sel.appendChild(opt);
      }
    }
  }

  function refresh() {
    location.reload(true);
  }

  function clearFacts() {
    document.getElementById("responseText").value = "";
  }

  function Service_Modality() {
    var type = document.getElementById('service').value;
    if (m_o_entry.innerHTML != null) {
      m_o_entry.innerHTML = "";
    }
    $("#m_o_entry").empty();
    if (type == "Facility") {
      var sel = document.getElementById('m_o_entry');
      // create new option element
      var opt0 = document.createElement("option");
      var opt1 = document.createElement("option");
      var opt2 = document.createElement("option");
      var opt3 = document.createElement("option");
      var opt4 = document.createElement("option");
      var opt5 = document.createElement("option");
      var opt6 = document.createElement("option");

      opt1.text = "Index";
      opt2.text = "SNS";
      opt3.text = "TB";
      opt4.text = "STI";
      opt5.text = "HIV-ST";
      opt6.text = "VCT";
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
    if (type == "Community") {
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

      opt1.text = "Moble/CBS";
      opt2.text = "SNS";
      opt3.text = "Index";
      opt4.text = "HIV-ST";

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

  function PatientType() {
    var type = document.getElementById('main_risk').value;
    if (sub_risk.innerHTML != null) {
      sub_risk.innerHTML = "";
    }
    console.log("hello sub Risk")


    $("#sub_risk").empty();
    if (type == "Pregnant Mother") {
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
      opt1.setAttribute('id', 'opt_ext_pp');
      opt2.setAttribute('id', 'opt_ext_mp');

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
    if (type == "Spouse of pregnant mother") {

      var sel = document.getElementById('sub_risk');
      // create new option element
      var opt0 = document.createElement("option");
      var opt1 = document.createElement("option");
      var opt2 = document.createElement("option");
      // create text node to add to option element (opt)
      opt0.appendChild(document.createTextNode(""));
      opt1.appendChild(document.createTextNode("HIV(Pos)"));
      opt2.appendChild(document.createTextNode("HIV(Neg)Woman"));
      // set value property of opt
      opt0.value = "";
      opt1.value = "HIV(Pos)";
      opt2.value = "HIV(Neg)Woman";
      // add opt to end of select box (sel)
      opt1.setAttribute('id', 'opt_ext_hivPos');
      opt2.setAttribute('id', 'opt_ext_hivNeg');

      sel.addEventListener("click", sub_risk);
      ////
      sel.appendChild(opt0);
      sel.appendChild(opt1);
      sel.appendChild(opt2);
      spm = 1;

    }
    if (type == "Exposed Children") {

      var sel = document.getElementById('sub_risk');
      // create new option element
      var opt0 = document.createElement("option");
      var opt1 = document.createElement("option");
      var opt2 = document.createElement("option");
      var opt3 = document.createElement("option");
      var opt4 = document.createElement("option");
      // create text node to add to option element (opt)
      opt0.appendChild(document.createTextNode(""));
      opt1.appendChild(document.createTextNode("1"));
      opt2.appendChild(document.createTextNode("2"));
      opt3.appendChild(document.createTextNode("3"));
      opt4.appendChild(document.createTextNode("4"));

      // set value property of opt
      opt0.value = 0;
      opt1.value = 1;
      opt2.value = 2;
      opt3.value = 3;
      opt4.value = 4;
      ///////
      opt0.setAttribute('id', 'opt_ext_ec_0');
      opt1.setAttribute('id', 'opt_ext_ec_1');
      opt2.setAttribute('id', 'opt_ext_ec_2');
      opt3.setAttribute('id', 'opt_ext_ec_3');
      opt4.setAttribute('id', 'opt_ext_ec_4');

      sel.addEventListener("click", sub_risk);
      // add opt to end of select box (sel)
      sel.appendChild(opt0);
      sel.appendChild(opt1);
      sel.appendChild(opt2);
      sel.appendChild(opt3);
      sel.appendChild(opt4);
      epc = 1;
    }
    if (type == "Low Risk") {
      var sel = document.getElementById('sub_risk');
      // create new option element
      var opt0 = document.createElement("option");
      //var opt1 = document.createElement("option");
      var opt2 = document.createElement("option");
      var opt3 = document.createElement("option");
      // create text node to add to option element (opt)
      opt0.appendChild(document.createTextNode(""));
      //opt1.appendChild( document.createTextNode("PWUD"));
      opt2.appendChild(document.createTextNode("Youth (15-24)"));
      opt3.appendChild(document.createTextNode("Other Low Risk"));

      opt0.setAttribute('id', 'opt_lr_0');
      //opt1.setAttribute('id','opt_lr_pwud');
      opt2.setAttribute('id', 'opt_lr_youth');
      opt3.setAttribute('id', 'opt_lr_other');
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
    if (type == "PWUD") {
      var sel = document.getElementById('sub_risk');
      var opt0 = document.createElement("option");
      opt0.appendChild(document.createTextNode(""));
      opt0.value = "-";
      opt0.setAttribute('id', 'opt_pwud_0');
      sel.addEventListener("click", sub_risk);
      sel.appendChild(opt0);

    }
    if (type == "FSW") {
      var sel = document.getElementById('sub_risk');
      // create new option element
      var opt0 = document.createElement("option");
      var opt1 = document.createElement("option");
      var opt2 = document.createElement("option");
      // create text node to add to option element (opt)
      opt0.appendChild(document.createTextNode(""));
      opt1.appendChild(document.createTextNode("FSW PWID"));
      opt2.appendChild(document.createTextNode("FSW PWUD"));
      // set value property of opt
      opt0.value = "";
      opt1.value = "FSW_PWID";
      opt2.value = "FSW_PWUD";

      opt0.setAttribute('id', 'opt_fsw_0');
      opt1.setAttribute('id', 'opt_fsw_pwid');
      opt2.setAttribute('id', 'opt_fsw_pwud');

      sel.addEventListener("click", sub_risk);
      // add opt to end of select box (sel)
      sel.appendChild(opt0);
      sel.appendChild(opt1);
      sel.appendChild(opt2);
      fsw = 1;
    }
    if (type == "Client of FSW") {
      var sel = document.getElementById('sub_risk');
      var opt0 = document.createElement("option");
      opt0.appendChild(document.createTextNode(""));
      opt0.value = "-";
      opt0.setAttribute('id', 'opt_cfsw_0');
      sel.addEventListener("click", sub_risk);
      sel.appendChild(opt0);

    }
    if (type == "MSM") {
      msm = 1;
      var sel = document.getElementById('sub_risk');
      // create new option element
      var opt0 = document.createElement("option");
      var opt1 = document.createElement("option");
      var opt2 = document.createElement("option");
      // create text node to add to option element (opt)
      opt0.appendChild(document.createTextNode(""));
      opt1.appendChild(document.createTextNode("MSM_PWID"));
      opt2.appendChild(document.createTextNode("MSM_PWUD"));
      // set value property of opt
      opt0.value = "";
      opt1.value = "MSM_PWID";
      opt2.value = "MSM_PWUD";

      opt0.setAttribute('id', 'opt_msm_0');
      opt1.setAttribute('id', 'opt_msm_pwid');
      opt2.setAttribute('id', 'opt_msm_pwud');

      sel.addEventListener("click", sub_risk);

      // add opt to end of select box (sel)
      sel.appendChild(opt0);
      sel.appendChild(opt1);
      sel.appendChild(opt2);

    }
    if (type == "IDU") {
      var sel = document.getElementById('sub_risk');
      // create new option element
      var opt0 = document.createElement("option");
      var opt1 = document.createElement("option");
      var opt2 = document.createElement("option");

      // create text node to add to option element (opt)
      opt0.appendChild(document.createTextNode(""));
      opt1.appendChild(document.createTextNode("PWID/FSW"));
      opt2.appendChild(document.createTextNode("PWID/MSM"));
      // set value property of opt
      opt0.value = "";
      opt1.value = "PWID_FSW";
      opt2.value = "PWID_MSM";

      opt0.setAttribute('id', 'opt_idu_0');
      opt1.setAttribute('id', 'opt_idu_fsw');
      opt2.setAttribute('id', 'opt_idu_msm');

      sel.addEventListener("click", sub_risk);

      // add opt to end of select box (sel)
      sel.appendChild(opt0);
      sel.appendChild(opt1);
      sel.appendChild(opt2);
      idu = 1;

    }
    if (type == "TG") {
      var sel = document.getElementById('sub_risk');
      // create new option element
      var opt0 = document.createElement("option");
      var opt1 = document.createElement("option");
      var opt2 = document.createElement("option");
      var opt3 = document.createElement("option");
      // create text node to add to option element (opt)
      opt0.appendChild(document.createTextNode(""));
      opt1.appendChild(document.createTextNode("TG/PWID"));
      opt2.appendChild(document.createTextNode("TG/PWUD"));
      opt3.appendChild(document.createTextNode("TG/SW"));
      // set value property of opt
      opt0.value = "";
      opt1.value = "TG_PWID";
      opt2.value = "TG_PWUD";
      opt3.value = "TG_SW";

      opt0.setAttribute('id', 'opt_tg_0');
      opt1.setAttribute('id', 'opt_tg_pwid');
      opt2.setAttribute('id', 'opt_tg_pwud');
      opt3.setAttribute('id', 'opt_tg_sw');

      sel.addEventListener("click", sub_risk);

      // add opt to end of select box (sel)
      sel.appendChild(opt0);
      sel.appendChild(opt1);
      sel.appendChild(opt2);
      sel.appendChild(opt3);
      tg = 1;
    }
    if (type == "Partner of KP") {
      var sel = document.getElementById('sub_risk');
      // create new option element
      var opt0 = document.createElement("option");
      var opt1 = document.createElement("option");
      var opt2 = document.createElement("option");
      var opt3 = document.createElement("option");
      var opt4 = document.createElement("option");
      // create text node to add to option element (opt)
      opt0.appendChild(document.createTextNode(""));
      opt1.appendChild(document.createTextNode("Partner of PWID"));
      opt2.appendChild(document.createTextNode("Partner of FSW"));
      opt3.appendChild(document.createTextNode("Female of MSM"));
      opt4.appendChild(document.createTextNode("Partner of TG"));
      // set value property of opt

      opt0.value = "";
      opt1.value = "Partner of PWID";
      opt2.value = "Partner of FSW";
      opt3.value = "Female of MSM";
      opt4.value = "Partner of TG";

      opt0.setAttribute('id', 'opt_pkp_0');
      opt1.setAttribute('id', 'opt_pkp_pwid');
      opt2.setAttribute('id', 'opt_pkp_fsw');
      opt3.setAttribute('id', 'opt_pkp_msm');
      opt4.setAttribute('id', 'opt_pkp_tg');

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
    if (type == "Partner of PLHIV") {
      var sel = document.getElementById('sub_risk');
      var opt0 = document.createElement("option");
      opt0.appendChild(document.createTextNode(""));
      opt0.value = "-";
      opt0.setAttribute('id', 'opt_pplhiv_0');
      sel.addEventListener("click", sub_risk);
      sel.appendChild(opt0);

    }
    if (type == "Special Groups") {
      var sel = document.getElementById('sub_risk');
      // create new option element
      var opt0 = document.createElement("option");
      var opt1 = document.createElement("option");
      var opt2 = document.createElement("option");
      var opt3 = document.createElement("option");

      // create text node to add to option element (opt)
      opt0.appendChild(document.createTextNode(""));
      opt1.appendChild(document.createTextNode("TB Patient"));
      opt2.appendChild(document.createTextNode("Institutionalize"));
      opt3.appendChild(document.createTextNode("Uniformed Services Personnel"));

      // set value property of opt

      opt0.value = "";
      opt1.value = "TB Patient";
      opt2.value = "Institutionalize";
      opt3.value = "Uniformed Services Personnel";

      opt0.setAttribute('id', 'opt_sg_0');
      opt1.setAttribute('id', 'opt_sg_TB');
      opt2.setAttribute('id', 'opt_sg_insti');
      opt3.setAttribute('id', 'opt_sg_uni');

      sel.addEventListener("click", sub_risk);
      // add opt to end of select box (sel)
      sel.appendChild(opt0);
      sel.appendChild(opt1);
      sel.appendChild(opt2);
      sel.appendChild(opt3);

      sg = 1;
    }
    if (type == "Migrant Population") {
      var sel = document.getElementById('sub_risk');
      var opt0 = document.createElement("option");
      opt0.appendChild(document.createTextNode(""));
      opt0.value = "-";
      opt0.setAttribute('id', 'opt_mig_0');
      sel.addEventListener("click", sub_risk);
      sel.appendChild(opt0);

    }
  }
</script>
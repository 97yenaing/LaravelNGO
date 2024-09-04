@php
  use Carbon\Carbon;
@endphp
@extends('layouts.app')
@auth
  @section('content')
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('js/Log_CBS/log-cbs.js') }}"></script>

    <body>
      <p class="btn-gnavi">
        <span></span>
        <span></span>
        <span></span>
      </p>
      <div class="container containers">
        <ul class="nav nav-tabs toggle"
          id="hidden-title">
          <li class="nav-item">
            <a class="nav-link active toggle-link c_fid"
              data-toggle="tab"
              href="#confid">Confidential Facts</a>
          </li>
          <li class="nav-item">
            <a class="nav-link toggle-link l_sheet"
              data-toggle="tab"
              href="#log_sheet">Log Sheet</a>
          </li>
          <li class="nav-item">
            <a class="nav-link toggle-link nav_follow"
              data-toggle="tab"
              href="#follow">Follow up history</a>
          </li>
          <li class="nav-item">
            <a class="nav-link toggle-link nav_export"
              data-toggle="tab"
              href="#export">Export</a>
          </li>

        </ul> <!-- *adding containers clss -->
      </div>
      <div style="margin:auto"
        id="toshowResult"></div>
      <div id="hider0"
        class="container containers page-color">
        <!-- *adding containers clss -->
        <div class="tab-content">
          <!-- Confidential Entry -->
          <div class="tab-pane container containers  active"
            id="confid">
            <div class="row justify-content-center">
              <div class="col-md-12 ">
                <h2 class="header-text confidential-head">Confidential Facts
                  <label for=""
                    class="form-label confidental-head-label"
                    id="confi-newOld"></label>
                </h2>
              </div>
            </div>
            <div class="row">
              <div class="col-md-1">
                <label class="">Peer Code </label>
                <select class="form-control"
                  id="he_code">
                  <option value="0"></option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                  <option value="6">6</option>
                  <option value="7">7</option>
                  <option value="8">8</option>
                  <option value="9">9</option>
                  <option value="10">10</option>
                  <option value="11">11</option>
                  <option value="12">12</option>
                  <option value="13">13</option>
                  <option value="14">14</option>
                  <option value="15">15</option>
                  <option value="16">16</option>
                  <option value="17">17</option>
                  <option value="18">18</option>
                  <option value="19">19</option>
                  <option value="20">20</option>
                  <option value="21">21</option>
                  <option value="22">22</option>
                  <option value="23">23</option>
                  <option value="24">24</option>
                  <option value="25">25</option>
                  <option value="26">26</option>
                  <option value="27">27</option>
                  <option value="28">28</option>
                  <option value="29">29</option>
                  <option value="30">30</option>
                  <option value="31">31</option>
                  <option value="32">32</option>
                  <option value="33">33</option>
                  <option value="34">34</option>
                  <option value="35">35</option>
                </select>
              </div>
              <div class="col-md-1">
                <label class="">Clinics </label>
                <select class="form-control"
                  id="clinic_code">
                  <option value="81">HTY-C2</option>
                  <option value="1">MAM Office</option>
                  <option value="71">HTY-A</option>
                  <option value="72">HTY-B</option>
                  <option value="73">SPT</option>
                  <option value="74">Thanlyin</option>
                  <option value="75">Winka</option>
                  <option value="76">TBZY</option>
                  <option value="77">PTO-DT</option>
                  <option value="78">PTO-MCB</option>
                  <option value="80">Hpakant</option>
                  <option value="82">Taze</option>
                  <option value="83">HTY-C1</option>
                  <option value="84">SDG</option>

                </select>
              </div>
              <div class="col-md-1">
                <label class="">Year </label>
                <select class="form-control"
                  id="year_code">
                  <option value="10">2010</option>

                </select>
              </div>
              <div class="col-md-2">
                <label class="">Serial Number</label>
                <input type="number"
                  id="pt_code"
                  class="form-control">
              </div>
              <div class="col-md-1">
                <button onclick="peerCode()"
                  class="prev-combine"> Search</button>
              </div>
              <div class="col-md-1">
                <label for="">>>></label>
                <button onclick="jumpLogSheet()">Log Sheet</button>
              </div>

              <div class="col-md-1 consulor-mainrisk">
                <label for=""> Risk Change ?</label>
                <input id="risk_change_checkbox"
                  type="checkbox"
                  onchange="risk_change_date()"
                  value="yes">
              </div>

              <div class="col-md-1 "
                id="risk_really_change"
                style="display: none">
                <label class="form-label">Risk Change</label>
                <select class="form-select">
                  <option value=""></option>
                  <option value="Yes">Yes</option>
                </select>
              </div>

              <div class="col-md-1 prev-refresh">

                <button class="btn btn-success reception-refresh refresh-follow"
                  onclick="refresh()">Refresh</button>
              </div>
            </div>
            <div class="row">

              <div class="col-md-2 reception-code1">
                <label for="validationCustom01"
                  class="form-label">General ID</label>
                <label autofocus
                  id="gid"
                  class="form-control"></label>
              </div>
              <div class="col-md-2 reception-code2">
                <label for="validationCustom01"
                  class="form-label">Fuchia ID</label>
                <div class="input-group mb-3">
                  <input type="text"
                    id="fid"
                    class="form-control">
                  <div class="input-group-append no-margin">
                    <button class="btn btn-primary reception-serach"
                      onclick="ptData()"
                      type="button">Search</button>
                  </div>
                </div>
              </div>
              <div class="col-md-2 reception-pfn">
                <label class="form-label">PrEP Code</label>
                <input type="text"
                  id="prepCode"
                  placeholder='Pr/049/B0000/23'
                  class="form-control"
                  required>
              </div> <br class="tablet">
              <div class="col-md-2 reception-pfn">
                <label class="form-label">Name</label>
                <input type="text"
                  id="name"
                  class="form-control"
                  required>
              </div>
              <div class="col-md-2 reception-pfn  reception-father ">
                <label class="form-label">Father's Name</label>
                <input type="text"
                  id="father"
                  class="form-control"
                  required>
              </div>
              <div class="col-md-2 reception-gender">
                <label class="form-label">Sex</label>
                <select class="form-select reception-select"
                  id="gender"
                  required>
                  <option value=""></option>
                  <option value="Male">Male</option>
                  <option value="Female">Female</option>
                </select>
              </div>
            </div>
            <div class="row recepatient-info">
              <div class="col-md-2 reception-visitDate">
                <label class="form-label"
                  id="regDateText">Registration Date</label>
                <div class="date-holder">
                  <input type="text"
                    id="register_date"
                    class="form-control Gdate date-verify "
                    onchange="reg_date_change()"
                    placeholder="dd-mm-yyyy">
                  <img src="../img/calendar3.svg"
                    class="dateimg"
                    alt="date">
                </div>
              </div>
              <div class="col-md-2 reception-visitDate">
                <label class="form-label">Date Of Birth</label>
                <div class="date-holder">
                  <input type="text"
                    id="dob"
                    class="form-control Gdate reception-dateformat "
                    placeholder="dd-mm-yyyy">
                  <img src="../img/calendar3.svg"
                    class="dateimg"
                    alt="date">
                </div>
              </div>

              <div class="col-md-2">
                <label for=""
                  class="form-label">Register Age(year)</label>
                <input type="number"
                  id="agey_register"
                  class="form-control"
                  onblur="reg_age_change()">
              </div>
              <div class="col-md-2">
                <label for=""
                  class="form-label">Register Age(month)</label>
                <input type="number"
                  class="form-control"
                  id="agem_register">
              </div>
              <div class="col-md-2">
                <label for="validationCustom02"
                  class="form-label">Current Age(Year)</label>
                <input type="number"
                  id="agey"
                  class="form-control">
              </div>
              <div class="col-md-2">
                <label for="validationCustom02"
                  class="form-label">Current Age(Month)</label>
                <input type="number"
                  id="agem"
                  onchange="monthValid()"
                  class="form-control">
              </div>
              <div class="col-md-2 consulor-mainrisk">
                <label for="">Main Risk</label>
                <select class="form-control"
                  id="main_risk"
                  onchange="PatientType()">
                  <option selected
                    value=""></option>
                  <option id="preg_mom"
                    value="Pregnant Mother">Pregnant Mother</option>
                  <option id="sp_preg_mom"
                    value="Spouse of pregnant mother">Spouse of pregnant mother
                  </option>
                  <option id=""
                    value="Exposed Children">Exposed Children</option>
                  <option id=""
                    value="Low Risk">Low Risk</option>
                  <option id=""
                    value="PWUD">PWUD</option>
                  <option id="fsw"
                    value="FSW">FSW</option>
                  <option id="cl_fsw"
                    value="Client of FSW">Client of FSW</option>
                  <option id="msm"
                    value="MSM">MSM</option>
                  <option id=""
                    value="IDU">IDU</option>
                  <option id="tg"
                    value="TG">TG</option>
                  <option id="pt_kp"
                    value="Partner of KP">Partner of KP</option>
                  <option id="pt_kp_plhiv"
                    value="Partner of PLHIV">Partner of PLHIV</option>
                  <option id=""
                    value="Special Groups">Special Groups</option>
                  <option value="Migrant Population">Migrant Population</option>
                </select>
              </div>
              <div class="col-sm-2 consulor-subrisk">
                <label for="">Sub Risk</label>
                <select class="form-control"
                  id="sub_risk">
                  <option selected
                    value=""></option>
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

              <div class="col-md-2 consulor-mainrisk">
                <label for="">Patient Visit Date</label>

                <div class="date-holder">
                  <input type="text"
                    disabled
                    id="risk_change_date"
                    class="form-control Gdate  "
                    placeholder="dd-mm-yyyy">
                  <img src="../img/calendar3.svg"
                    class="dateimg"
                    alt="date">
                </div>
              </div>

              <div class="col-md-2 consulor-mainrisk">
                <label for="">Change Risk</label>
                <select class="form-control"
                  id="main_riskChange"
                  onchange="main_riskChange(this)"
                  disabled>
                  <option selected
                    value=""></option>
                  <option id="preg_mom"
                    value="Pregnant Mother">Pregnant Mother</option>
                  <option id="sp_preg_mom"
                    value="Spouse of pregnant mother">Spouse of pregnant mother
                  </option>
                  <option id=""
                    value="Exposed Children">Exposed Children</option>
                  <option id=""
                    value="Low Risk">Low Risk</option>
                  <option id=""
                    value="PWUD">PWUD</option>
                  <option id="fsw"
                    value="FSW">FSW</option>
                  <option id="cl_fsw"
                    value="Client of FSW">Client of FSW</option>
                  <option id="msm"
                    value="MSM">MSM</option>
                  <option id=""
                    value="IDU">IDU</option>
                  <option id="tg"
                    value="TG">TG</option>
                  <option id="pt_kp"
                    value="Partner of KP">Partner of KP</option>
                  <option id="pt_kp_plhiv"
                    value="Partner of PLHIV">Partner of PLHIV</option>
                  <option id=""
                    value="Special Groups">Special Groups</option>
                  <option value="Migrant Population">Migrant Population</option>
                </select>
              </div>

              <div class="col-sm-2 reception-region">
                <label for="validationCustom02"
                  class="form-label">State/ Region</label>
                <div>
                  <select class="form-select reception-select"
                    id="state"
                    onchange="region(this.value)">
                    <option selected
                      disabled
                      value="">Choose....................</option>
                    <option value=""></option>
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
              <div class="col-sm-2 reception-township">
                <label for="validationCustom02"
                  class="form-label">Township</label>
                <div>
                  <select class="form-select reception-select"
                    id="tt">
                    <option id="tt_opt"></option>
                    <option selected
                      disabled
                      value="">Choose...............</option>
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
              </div>
              <div class="col-md-2 consulor-srt"
                id="quarter_hide">
                <label for="">Ward/Village(detail)</label>
                <input type="text"
                  id="quarter"
                  class="form-control"
                  required>
              </div>
              <div class="col-sm-2 consulor-srt"
                id="phone_hide">
                <label for="">Phone No.1</label>
                <div>
                  <input id="phone"
                    class="form-control"
                    type="text"
                    name=""
                    placeholder="09123459789">
                </div>
              </div>
              <div class="col-sm-2 consulor-srt"
                id="phone2_hide">
                <label for="">Phone No.2</label>
                <div>
                  <input id="phone2"
                    class="form-control"
                    type="text"
                    name=""
                    placeholder="09123459789">
                </div>
              </div>
              <div class="col-sm-2 consulor-srt"
                id="phone3_hide">
                <label for="">Phone No.3</label>
                <div>
                  <input id="phone3"
                    class="form-control"
                    type="text"
                    name=""
                    placeholder="09123459789">
                </div>
              </div>

            </div>
            <div class="row">
              <div class="col-sm-2 reception-re-fo">
                <button type="button"
                  style="display:none;"
                  id="regbutton"
                  onclick="confidentialSave(1)"
                  class="btn btn-primary reception-register">Register</button>
                <button type="button"
                  style="display:none;"
                  id="updatebutton"
                  onclick="confidentialSave(2)"
                  class="btn btn-primary reception-register">Update</button>
              </div>
            </div>
          </div>
          <!-- Log Sheet -->
          <div class="tab-pane container containers fade"
            id="log_sheet">
            <div class="log-sheetSection">
              <br>
              <div class="row">
                <div class="col-sm-12">
                  <h5 id="generalInfo"></h5>
                </div>
              </div>
              <div class="row">
                <div class="col-md-2">
                  <input id="log_sheet_ID_change"
                    type="checkbox"
                    onchange="show_update_ID_box()">If need
                  to change General
                  ID
                </div>
                <div class="col-md-2">
                  <input type="number"
                    placeholder="General ID"
                    id="updateID"
                    class="form-control">
                </div>
                <div class="col-md-1">
                  <button type="button"
                    onclick="serarch_change()"
                    id="log_serach_chagne"
                    class="btn btn-primary logsheet_id_change_btn">Search</button>
                </div>
              </div>
              <div class="log-first">
                <div class="row">
                  <div class="col-md-2">
                    <label class="form-label">Visit Date</label>
                  </div>
                  <div class="col-md-2">
                    <div class="date-holder">
                      <input type="text"
                        id="vDate"
                        required
                        class="form-control Gdate date-verify"
                        onblur="define_new_old()"
                        placeholder="dd-mm-yyyy">
                      <img src="../img/calendar3.svg"
                        class="dateimg"
                        alt="date">
                    </div>
                  </div>
                  <div class="col-md-2">
                    <label for="">Services Provision 1</label>
                  </div>
                  <div class="col-md-2">
                    <select class="form-control"
                      id="serve_pro_1">
                      <option value="Yes">Yes</option>
                      <option value="No">No</option>
                    </select>
                  </div>
                  <div class="col-md-2">
                    <label for="">Services Provision 2</label>
                  </div>
                  <div class="col-md-2">
                    <select class="form-control"
                      id="serve_pro_2">
                      <option value="Yes">Yes</option>
                      <option value="No">No</option>
                    </select>
                  </div>
                  {{-- <div class="col-md-2">
                <label for="">Substantial Risk</label>
              </div>
              <div class="col-md-1">
                <select class="form-control" id="substan_risk">
                  <option value="Yes">Yes</option>
                  <option value="No">No</option>
                </select>
              </div> --}}
                  {{-- <div class="col-md-2">
                <label for="">Meeting Point</label>
              </div>
              <div class="col-md-3">
                <input type="text" id="meeting_point" class="form-control">
              </div> --}}
                </div>
                <div class="row">

                  <div class="col-md-2">
                    <label for="">Services Provision 3</label>
                  </div>
                  <div class="col-md-2">
                    <select class="form-control"
                      id="serve_pro_3">
                      <option value="Yes">Yes</option>
                      <option value="No">No</option>
                    </select>
                  </div>
                  <div class="col-md-2">
                    <label class="">Reach New/Old</label>
                  </div>
                  <div class="col-md-2">
                    <span style="background-color:orange;"
                      class="form-control"
                      id="new_old"></span>
                  </div>
                  <div class="col-md-2">
                    <label for="">NS distribution </label>
                  </div>
                  <div class="col-md-2">
                    <input type="number"
                      id="ns_distribution"
                      class="form-control">
                  </div>
                </div>
                {{-- <div class="row">
              <div class="dropdown col-md-2 he-checkbox" id="he_check">
                <button class="btn btn-secondary dropdown-toggle he-sesion" type="button" id="dropdownMenuButton"
                  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  HE Session
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  <label class="dropdown-item">
                    <input type="checkbox" on="hecheck()" onchange="hecheck()" id="he_hiv" value="HIV(1)"> HIV(1)
                  </label>
                  <label class="dropdown-item">
                    <input type="checkbox" id="he_sti" onchange="hecheck()" value="STI(2)">
                    STI(2)
                  </label>
                  <label class="dropdown-item">
                    <input type="checkbox" id="he_safe_inj" onchange="hecheck()" value="Safe injection(3)"> Safe
                    injection(3)
                  </label>
                  <label class="dropdown-item">
                    <input type="checkbox" id="he_safe_sex" onchange="hecheck()" value="Safe sex(4)"> Safe sex(4)
                  </label>
                  <label class="dropdown-item">
                    <input type="checkbox" id="he_mmt" onchange="hecheck()" value="MMT(5)">
                    MMT(5)
                  </label>
                  <label class="dropdown-item">
                    <input type="checkbox" id="he_tb" onchange="hecheck()" value="TB">
                    TB
                  </label>
                  <label class="dropdown-item">
                    <input type="checkbox" id="he_family_planning" onchange="hecheck()" value="Family Planning"> Family
                    Planning
                  </label>
                  <label class="dropdown-item">
                    <input type="checkbox" id="he_overdose" onchange="hecheck()" value="Overdose"> Overdose
                  </label>
                  <label class="dropdown-item">
                    <input type="checkbox" id="he_hcv" onchange="hecheck()" value="HBV HCV">
                    HBV HCV
                  </label>
                </div>
              </div>

              <div class="col-md-5">
                <span class="He-span form-control"></span>
              </div>

            </div> --}}
                <div class="row">
                  <div class="col-md-2">
                    <label for="">Condom(Male)</label>
                  </div>
                  <div class="col-md-2">
                    <input type="number"
                      id="condom_male"
                      class="form-control">
                  </div>
                  <div class="col-md-2">
                    <label for="">Condom(Female) </label>
                  </div>
                  <div class="col-md-2">
                    <input type="number"
                      id="condom_female"
                      class="form-control">
                  </div>
                  <div class="col-md-2">
                    <label for="">NS returned</label>
                  </div>
                  <div class="col-md-2">
                    <input type="number"
                      id="ns_return"
                      class="form-control">
                  </div>
                  {{-- <div class="col-md-2">
                <label for="">Test New/Old </label>
              </div>
              <div class="col-md-2">
                <span id="lab_new_old" style="background-color:#ff9900;" class="form-control">
              </div> --}}
                </div>
                <div class="row">

                  <div class="col-md-2">
                    <label for="">HIV Status </label>
                  </div>
                  <div class="col-md-2">
                    <select class="form-control"
                      id="hiv_status"
                      onchange="hiv_status()">

                      <option value="1">Unknown 1</option>
                      <option value="2">Known Negative 2</option>
                      <option value="3">Known Positive 3</option>
                      <option value="4">ART 4</option>
                    </select>
                  </div>
                  <div class="col-md-2">
                    <label for="">***************</label>
                  </div>
                  <div class="col-md-2"
                    id="hiv_status_sub_div"
                    style="display:none">
                    <select class="form-control"
                      id="hiv_status_sub">
                      <option value=""></option>
                      <option value="2.1">tested < 6
                          month
                          ago
                          2.1
                          </option>
                      <option value="2.2">tested > 6 month ago 2.2 </option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="log-second">
                <div class="row">
                  <div class="col-md-2">
                    <label for="">HTS testing done(Y/N) </label>
                  </div>
                  <div class="col-md-2">
                    <select class="form-control"
                      id="hts_test">
                      <option value=""></option>
                      <option value="Yes">Yes</option>
                      <option value="No">No</option>
                    </select>
                  </div>
                  <div class="col-md-2">
                    <label for="">Final Result </label>
                  </div>
                  <div class="col-md-2">
                    <select class="form-control"
                      id="hiv_result">
                      <option value=""></option>
                      <option value="Positive">Positive</option>
                      <option value="Negative">Negative</option>
                      <option value="Inconclusive">Inconclusive</option>
                    </select>
                  </div>
                  <div class="col-md-2">
                    <label for="">Date of Confirmation </label>
                  </div>
                  <div class="col-md-2">
                    <div class="date-holder">
                      <input type="text"
                        id="hiv_comfirm_date"
                        class="form-control Gdate date-verify "
                        placeholder="dd-mm-yyyy">
                      <img src="../img/calendar3.svg"
                        class="dateimg"
                        alt="date">
                    </div>
                  </div>
                </div>
                <div class="row">

                  {{-- <div class="col-md-2">
                <label class="form-label">Tested Clinic</label>
              </div>
              <div class="col-md-2">
                <select class="form-control" id="test_clinic">
                  <option value=""></option>
                  <option value="HTY-C2">HTY-C2</option>
                  <option value="MAM Office">MAM Office</option>
                  <option value="HTY-A">HTY-A</option>
                  <option value="HTY-B">HTY-B</option>
                  <option value="SPT">SPT</option>
                  <option value="Thanlyin">Thanlyin</option>
                  <option value="Winka">Winka</option>
                  <option value="TBZY">TBZY</option>
                  <option value="PTO-DT">PTO-DT</option>
                  <option value="PTO-MCB">PTO-MCB</option>
                  <option value="Hpakant">Hpakant</option>
                  <option value="Taze">Taze</option>
                  <option value="HTY-C1">HTY-C1</option>
                  <option value="SDG">SDG</option>
                </select>
              </div> --}}

                  <div class="col-md-2">
                    <label for="">Source Document </label>
                  </div>
                  <div class="col-md-2">
                    <select class="form-control"
                      id="source_doc"
                      onchange="oneOrtwo()">
                      <option value=""></option>
                      <option value="Prevention Logsheet">Prevention Logsheet</option>
                      <option value="CBS">CBS</option>
                    </select>
                  </div>
                  {{-- <div class="col-md-3">
                <label for="" class="form-label">Mental Health Assessment Done</label>
              </div>
              <div class="col-md-1">
                <select name="" id="mental_health" class="form-select">
                  <option value=""></option>
                  <option value="Yes">Yes</option>
                  <option value="No">No</option>
                </select>
              </div> --}}
                  {{-- <div class="col-md-2">
                <label for="" class="form-label">PHQ4_Scoring(Q1&Q2)</label>
              </div>
              <div class="col-md-2">
                <select name="" id="PHQ4_Q1_Q2" class="form-select">
                  <option value=""></option>
                  <option value="<3">&#60;3</option>
                  <option value=">=3">>=3</option>
                </select>
              </div>
              <div class="col-md-2">
                <label for="" class="form-label">PHQ4_Scoring(Q3&Q4)</label>
              </div>
              <div class="col-md-2">
                <select name="" id="PHQ4_Q3_Q4" class="form-select">
                  <option value=""></option>
                  <option value="<3">&#60;3</option>
                  <option value=">=3">>=3</option>
                </select>
              </div> --}}
                  {{-- <div class="col-md-2">
                <label for="" class="form-label">OST Offered Done</label>
              </div>
              <div class="col-md-2">
                <select name="" id="OST_Offer_Done" class="form-select">
                  <option value=""></option>
                  <option value="Yes">Yes</option>
                  <option value="No">No</option>
                </select>
              </div> --}}

                  <div class="col-md-2">
                    <label for=""
                      class="form-label">Eligible for OST</label>
                  </div>
                  <div class="col-md-2">
                    <select name=""
                      id="OST_Eligible"
                      class="form-select"
                      disabled>
                      <option value=""></option>
                      <option value="Yes">Yes</option>
                      <option value="No">No</option>
                    </select>
                  </div>
                  <div class="col-md-2">
                    <label for=""
                      class="form-label">OST Offered Accepted</label>
                  </div>
                  <div class="col-md-2">
                    <select name=""
                      id="OST_Offer_Accepted"
                      class="form-select"
                      disabled>
                      <option value=""></option>
                      <option value="Yes">Yes</option>
                      <option value="No">No</option>
                    </select>
                  </div>

                  {{-- <div class="col-md-2">
                <label for="" class="form-label">OST initiated Date</label>
              </div>
              <div class="col-md-2">
                <div class="date-holder">
                  <input type="text" id="OST_Intial_Date" required="" class="form-control Gdate date-verify "
                    placeholder="dd-mm-yyyy">
                  <img src="../img/calendar3.svg" class="dateimg" alt="date">
                </div>
              </div> --}}

                </div>
                <div class="row">
                  <div class="col-md-2">
                    <label for=""
                      class="form-label">Referral Coupon no.</label>
                  </div>
                  <div class="col-md-2">
                    <input type="text"
                      id="referral_cupon"
                      class="form-control">
                  </div>
                  <div class="col-md-2">
                    <label for=""
                      class="form-label">Decline Reason</label>
                  </div>
                  <div class="col-md-2">
                    <select name=""
                      id="Decline_Reason"
                      class="form-select">
                      <option value=""></option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                      <option value="5">5</option>
                    </select>
                  </div>
                  <div class="col-md-2">
                    <label for="">Reach by whom </label>
                  </div>
                  <div class="col-md-2">
                    <select class="form-control"
                      id="reach_by_whom"
                      onchange="final_Result_confirm()">
                      <option value=""></option>
                      <option value="PE1">PE-1</option>
                      <option value="PE2">PE-2</option>
                      <option value="PE3">PE-3</option>
                      <option value="PE4">PE-4</option>
                      <option value="PE5">PE-5</option>
                      <option value="PE6">PE-6</option>
                      <option value="PE7">PE-7</option>
                      <option value="PE8">PE-8</option>
                      <option value="PE9">PE-9</option>
                      <option value="PE10">PE-10</option>
                      <option value="PE11">PE-11</option>
                      <option value="PE12">PE-12</option>
                      <option value="PE13">PE-13</option>
                      <option value="PE14">PE-14</option>
                      <option value="PE15">PE-15</option>
                      <option value="PE16">PE-16</option>
                      <option value="PE17">PE-17</option>
                      <option value="PE18">PE-18</option>
                      <option value="PE19">PE-19</option>
                      <option value="PE20">PE-20</option>
                      <option value="PE21">PE-21</option>
                      <option value="PE22">PE-22</option>
                      <option value="PE23">PE-23</option>
                      <option value="PE24">PE-24</option>
                      <option value="PE25">PE-25</option>
                      <option value="PE26">PE-26</option>
                      <option value="PE27">PE-27</option>
                      <option value="PE28">PE-28</option>
                      <option value="PE29">PE-29</option>
                      <option value="PE30">PE-30</option>
                      <option value="PE31">PE-31</option>
                      <option value="PE32">PE-32</option>
                      <option value="PE33">PE-33</option>
                      <option value="PE34">PE-34</option>
                      <option value="PE35">PE-35</option>

                      <option value="A">A</option>
                      <option value="B">B</option>
                      <option value="C1">C1</option>
                      <option value="C2">C2</option>
                      <option value="TL">TL</option>
                      <option value="SPT">SPT</option>
                      <option value="SDG">SDG</option>
                      <option value="OAS-A">OAS-A</option>
                      <option value="OAS-B">OAS-B</option>
                      <option value="OAS-C1">OAS-C1</option>
                      <option value="OAS-C2">OAS-C2</option>
                      <option value="OAS-TL">OAS-TL</option>
                      <option value="OAS-SPT">OAS-SPT</option>
                      <option value="OAS-SDG">OAS-SDG</option>
                      <option value="BKK">BKK</option>
                    </select>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-2">
                    <label for="">Remark </label>
                  </div>
                  <div class="col-md-10">
                    <input type="text"
                      id="remark"
                      class="form-control">
                  </div>
                </div>
                <div class="row log-button">
                  <div class="col-sm-2 ">
                    <button type="button"
                      id="logsheet_save"
                      onclick="logSheetSave(this)"
                      class="btn btn-primary log-save">Log-Sheet_Save</button>
                  </div>
                </div>
              </div>

            </div>
            <div class="cbs-Section"
              id="cbs-section"
              style="display:none;">
              <div class="row">
                <div class="col-md-2">
                  <label for="">Visit Date</label>

                  <div class="date-holder">
                    <input type="text"
                      id="vDate2"
                      class="form-control Gdate date-verify "
                      placeholder="dd-mm-yyyy">
                    <img src="../img/calendar3.svg"
                      class="dateimg"
                      alt="date">
                  </div>
                </div>
                <div class="col-md-2">
                  <label for="">Meeting Point</label>
                  <input type="text"
                    id="meetingPoint2"
                    class="form-control">
                </div>
                <div class="col-md-3">
                  <label for="">Reached KP and their Partners (Cal yr) </label>
                  <span style="background-color:orange;"
                    class="form-control"
                    id="reached_kp_partners"></span>
                </div>
                <div class="dropdown col-md-2">
                  <button class="btn btn-secondary dropdown-toggle cbs-serviceTK"
                    type="button"
                    id="dropdownMenuButton"
                    data-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false">
                    Service Provision
                  </button>
                  <div class="dropdown-menu"
                    id="cbs_Check"
                    aria-labelledby="dropdownMenuButton">
                    <label class="dropdown-item">
                      <input type="checkbox"
                        onchange="cbs_check()"
                        id="service_pro_he"
                        value="HE"> HE
                    </label>
                    <label class="dropdown-item">
                      <input type="checkbox"
                        onchange="cbs_check()"
                        id="service_pro_condom"
                        value="Condom"> Condom
                    </label>
                    <label class="dropdown-item">
                      <input type="checkbox"
                        onchange="cbs_check()"
                        id="service_pro_nsp"
                        value="NSP"> NSP
                    </label>
                    <label class="dropdown-item">
                      <input type="checkbox"
                        onchange="cbs_check()"
                        id="service_pro_sti"
                        value="STI"> STI
                    </label>
                    <label class="dropdown-item">
                      <input type="checkbox"
                        id="service_pro_cbs"
                        onchange="cbs_check()"
                        value="CBS counselling"> CBS
                      Counselling
                    </label>
                  </div>
                </div>
                <div class="col-md-3">
                  <span class="cbsCheck-span form-control"></span>
                </div>

                <div class="col-md-3">
                  <label for="">Retesting within the calender year(Yes/No) </label>

                  <select class="form-control"
                    id="retesting">
                    <option value=""></option>
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                  </select>
                </div>
                <div class="col-md-2">
                  <label for="">HIV Status Duration</label>
                  <select class="form-control"
                    id="HIV_status_2">
                    <option value=""></option>
                    <option value="1">Unknown</option>
                    <option value="2.1">tested < 6
                        month
                        ago
                        2.1
                        </option>
                    <option value="2.2">tested > 6 month ago 2.2 </option>
                  </select>
                </div>
                <div class="col-md-2">
                  <label for="">Pre-test Counselling</label>
                  <select class="form-control"
                    id="pre_test_counsel">
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                  </select>
                </div>
                <div class="col-md-2">
                  <label for="">Post-test Counselling</label>

                  <select class="form-control"
                    id="post_test_counsel">
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                  </select>
                </div>
                <div class="col-md-2">
                  <label for="">HIV Determine Result</label>

                  <select class="form-control"
                    id="determine_result"
                    onchange="cbs_hiv_determine()">
                    <option value=""></option>
                    <option value="Reactive">Reactive</option>
                    <option value="Non Reactive">Non Reactive</option>
                    <option value="Invalid">Invalid</option>
                  </select>
                </div>
                <div class="col-md-3">
                  <label for="">If reactive refer to </label>

                  <input type="text"
                    id="if_reactive_refer"
                    class="form-control">
                </div>
                <div class="col-md-4">
                  <label for="">Date of arrival at confirmation Facility </label>

                  <div class="date-holder">
                    <input type="text"
                      id="date_arrival_confirm_facility"
                      class="form-control Gdate date-verify "
                      placeholder="dd-mm-yyyy">
                    <img src="../img/calendar3.svg"
                      class="dateimg"
                      alt="date">
                  </div>
                </div>
                <div class="col-md-3">
                  <label for="">HIV Final Result after confirmation</label>

                  <select class="form-control"
                    id="hiv_status_after_confirm"
                    onchange="cbs_hiv_final_confirm()">
                    <option value=""></option>
                    <option value="Positive">Positive</option>
                    <option value="Negative">Negative</option>
                    <option value="Inconclusive">Inconclusive</option>
                  </select>
                </div>
              </div>
              <div class="row hts-entry">
                <!--service -->
                <div class="col-md-2 consulor-srt ">
                  <label for="">Service Modality</label>
                  <select class="form-select"
                    onchange="Service_Modality()"
                    id="service"
                    required>
                    <option value="Community">Community</option>
                    <option value="Facility">Facility</option>
                  </select>
                </div>
                <div class="col-md-2 consulor-srt ">
                  <label for="">Mode of Entry</label>
                  <select class="form-select"
                    id="m_o_entry"
                    required>
                    <option value="Mobile/CBS">Mobile/CBS</option>
                    <option value="Index">Index</option>
                    <option value="SNS">SNS</option>
                    <option value="TB">TB</option>
                    <option value="STI">STI</option>
                    <option value="HIV-ST">HIV-ST</option>
                    <option value="VCT">VCT</option>

                    <option value="SNS">SNS</option>
                    <option value="Index">Index</option>
                    <option value="HIV-ST">HIV-ST</option>
                  </select>
                </div>
              </div>
              <div class="row log-button">
                <div class="col-sm-2 ">
                  <button type="button"
                    id="cbs_save"
                    onclick="cbsSave()"
                    class="btn btn-primary log-save">CBs Save</button>
                </div>
              </div>
            </div>
          </div>
          <!-- Export -->
          <div class="tab-pane container containers fade"
            id="follow">
            <div class="log_sheet_history">
              <h1 class="header-text">Log Sheet History</h1>
              <div>
                <table class="table table-hover table-bordered">
                  <thead>
                    <tr>
                      <td>
                        NO.
                      </td>
                      <td>General ID</td>
                      <td>Visit Date</td>
                      <td></td>
                    </tr>
                  </thead>
                  <tbody id="list">

                  </tbody>
                </table>

              </div>
            </div>
            <div class="cbs_history">
              <h1 class="header-text">CBS History</h1>
              <div>
                <table class="table table-hover table-bordered">
                  <thead>
                    <tr>
                      <td>
                        NO.
                      </td>
                      <td>General ID</td>
                      <td>Visit Date</td>
                      <td></td>
                    </tr>
                  </thead>
                  <tbody id="list2">

                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="tab-pane container containers fade"
            id="export">
            <br>
            <form action="{{ route('prevention_data') }}"
              method="POST"
              enctype="multipart/form-data">
              @csrf
              <div class="row justify-content-center">
                <h1>Export</h1>
              </div><br>
              <div class="row justify-content-center">
                <div class="col-md-2">
                  <select id="tb_name"
                    name="tb_name"
                    class="form-control">
                    <option value="log_sheet">Log Sheet</option>
                    <option value="cbs">CBS</option>
                    <option value="confid">Confidential</option>
                  </select>
                </div>
                <div class="col-md-1">
                  <label for="">From</label>
                </div>
                <div class="col-md-2">

                  <div class="date-holder">
                    <input type="text"
                      id="ddFrom"
                      name="ddFrom"
                      class="form-control Gdate  "
                      placeholder="dd-mm-yyyy">
                    <img src="../img/calendar3.svg"
                      class="dateimg"
                      alt="date">
                  </div>
                </div>
                <div class="col-md-1">
                  <label for="">To</label>
                </div>
                <div class="col-md-2">

                  <div class="date-holder">
                    <input type="text"
                      id="ddTo"
                      name="ddTo"
                      class="form-control Gdate date-verify  "
                      placeholder="dd-mm-yyyy">
                    <img src="../img/calendar3.svg"
                      class="dateimg"
                      alt="date">
                  </div>
                </div>
                <div class="col-sm-3">
                  <button class="btn btn-dark"
                    id="prev_export">Export</button>
                </div>
              </div><br>
              <div class="row">
                <div class="col-sm-4"></div>
              </div>
              <br>
              <div class="row">
                <div id="toshowHead"></div>
                <div id="toshow"></div>
              </div>
              <div>
                <input name="functionLoco"
                  style="display:none"
                  value="15"></input>
              </div>
              <br>
            </form>
          </div>

        </div>
      </div>
      </div>
    </body>
  @endsection
@endauth

<script type="text/javascript"
  language="javascript">
  let generatedID = 0;
  let text = 0;
  let ptID = 0;
  let rowNumber = 0;
  let year = 0;
  let Age = 0;
  let generatedID1 = 0;
  let genID = [];
  let ddDate = 0;
  let resp;
  let LS_updateSignal = 0;
  let Ls_ID_change = 0;
  let hts_date = 0;
  let log_seleName = [
    // 'substainRisk',
    'serProvi_1', 'serProvi_2', 'serProvi_3', 'hiv_status1', 'hiv_status2',
    'Hts_done', 'final_result', //'test_clinic', , 
    'source_doc',
    //'Mental_Health', 'PHQ4_1_2','PHQ4_3_4',
    'OST_eligible', 'OST_accept', 'decline_reason', 'reach_whom'
  ];
  let log_inputName = [
    'updateIDchange', 'vdate', //'meet_point', 
    'ns_distru',
    'comdome_male', 'comdome_female', 'ns_return',
    'date_comfirm', 'referral_coupon', 'log_remark',
  ];

  let log_checkName = [
    'ifIdchange', 'hiv_1', 'sti_2', 'self_inject_3', 'safe_sex_4',
    'mmt_5', "tb", 'family_plan', 'overdose', 'hbvhcv',
  ];

  function hiv_test_determine() {
    var test_yes = $("#hts_test").val();
    console.log("test is fine");
    if (test_yes == "No" || test_yes == "-") {
      $("#hiv_result").val("-");
      $("#hiv_result").prop("disabled", true)
    } else {
      $("#hiv_result").prop("disabled", false)
    }
  }

  function risk_change_date() {
    console.log("risk change date");
    var risk_change_checkbox = $("#risk_change_checkbox").val();


    if ($(event.target).is(":checked")) {
      $("#main_riskChange").prop("disabled", false);
      $("#risk_change_date").prop("disabled", false);
      $("#risk_really_change").show()

    } else {
      $("#main_riskChange").prop("disabled", true);
      $("#risk_change_date").prop("disabled", true);
      $("#risk_really_change select").val("");
      $("#risk_really_change").hide();
    }
  }

  function main_riskChange(select) {
    if ($(select).val() == "IDU") {
      $("#OST_Eligible, #OST_Offer_Accepted").prop("disabled", false);
    } else {
      $("#OST_Eligible, #OST_Offer_Accepted").prop("disabled", true).val("");
    }
  }

  function ptData() { // to find patient data

    // For Date
    var date = new Date();
    var day = date.getDate();
    var month = date.getMonth() + 1;
    year = date.getFullYear(); // Global
    if (month < 10) month = "0" + month;
    if (day < 10) day = "0" + day;
    var today = year + "-" + month + "-" + day;
    // document.getElementById('vDate').value = today;
    // document.getElementById('hiv_test_date').value = today;
    // document.getElementById('syp_date').value = today;
    // document.getElementById('hep_date').value = today;
    // document.getElementById('labTestDate').value = today;

    var generalID = document.getElementById('gid').innerHTML;
    var Fuchia_ID = $("#fid").val();
    console.log("general" + generalID);

    $(".counselling-type input[type='checkbox']").each(function(index) {
      $(this).removeClass("chk" + (index + 1));
    }) // removing  Class to fill already have  data ye naing


    var functionLoco = 1;
    var ckID = 1;

    var ckdata = {
      generalID: generalID,
      Fuchia_ID: Fuchia_ID,
      ckID: ckID,
      functionLoco: functionLoco,
    };


    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
      }
    });


    $.ajax({
      type: 'POST',
      url: "{{ route('prevention_data') }}",
      dataType: 'json',
      contentType: 'application/json',
      data: JSON.stringify(ckdata),
      success: function(response) {
        console.log(response);
        resp = response;
        if (response[0] != null) {
          $("#confi-newOld").text("Old patient")
          generatedID = response[0]['id'];
          //   For Age Calculation

          //  if(response[13]=="new"){
          //   $("#dob,#agey,#agem").prop("disabled",false);
          //  }
          General_ID = response[0]["Pid"].toString(); // Global
          Fuchia_ID = response[0]["FuchiaID"]; //Global

          if (General_ID.length > 10) {
            $("#he_code").val(General_ID.substr(0, General_ID.length - 10));
          }

          $("#fid").val(Fuchia_ID);
          $("#gid").text(General_ID);

          var PrEPCode = response[0]["PrEPCode"];
          Gender = response[7]; //Global
          var Name = response[1];
          var Father = response[2];
          var Region = response[4];
          var Township = response[5];

          var qut = response[6];
          if (qut == '') {
            document.getElementById("quarter").value = '';
          } else {
            console.log("qut" + qut);
            document.getElementById("quarter").value = qut;
          }

          document.getElementById("register_date").value = response[0]["Reg Date"];
          document.getElementById("generalInfo").innerHTML =
            "General ID :" + response[0]['Pid'] + ",&nbsp;&nbsp;&nbsp;&nbsp;" +
            "Fuchia ID :" + Fuchia_ID + ",&nbsp;&nbsp;&nbsp;&nbsp;" +
            "Name :" + response[1] + ",&nbsp;&nbsp;&nbsp;&nbsp;" +
            "Sex :" + Gender + ",&nbsp;&nbsp;&nbsp;&nbsp;" +
            "Main Risk :" + response[11] + ",&nbsp;&nbsp;&nbsp;&nbsp;" +
            "Sub Risk :" + response[12] + ",&nbsp;&nbsp;&nbsp;&nbsp;" +
            "Register Age :" + response[0]["Agey"] + ",&nbsp;&nbsp;&nbsp;&nbsp;" +
            "Township :" + Township + ",&nbsp;&nbsp;&nbsp;&nbsp;";


          document.getElementById("fid").value = Fuchia_ID;
          document.getElementById("prepCode").value = PrEPCode;

          document.getElementById("name").value = Name;
          document.getElementById("father").value = Father;
          document.getElementById("state").value = Region;
          region();
          document.getElementById("tt").value = Township;
          document.getElementById("quarter").value = qut;

          document.getElementById("gender").value = Gender;

          document.getElementById("phone").value = response[8];
          document.getElementById("phone2").value = response[9];
          document.getElementById("phone3").value = response[10];

          // document.getElementById("dob").value=response[3];

          document.getElementById("main_risk").value = response[11];
          document.getElementById("main_risk").disabled = true;
          document.getElementById("risk_change_checkbox").disabled = false;

          PatientType();
          document.getElementById("sub_risk").value = response[12];
          //  var new_old_ck = response[8];
          //  if(new_old_ck == true){
          //    document.getElementById("new_old").value="Old";
          //  }else{
          //    document.getElementById("new_old").value="New";
          //    document.getElementById("new_old").style="color:red";
          //  }

          if (response[13].length > 0) {

          }
          if (response[15] == true) {
            if (response[14][0] == "1") {
              $("#pre").prop("checked", true);
            }
            if (response[14][1] == "1") {
              $("#post").prop("checked", true);
            }

            $(".counselling-type input[type='checkbox']").each(function(index) {
              $(this).addClass("chk" + (index + 1));
              console.log("hi checked data")
            }) // adding Class to fill already have  data

            $("#hts_test_done").val(response[14][2]);
            $("#hts_test_no_reason").val(response[14][3]);
            $("#status").val(response[14][4]);
            if (response[14][5] == "1") {
              $("#prep").prop("checked", true);
            }
            $("#prep_status").val(response[14][6]);
            var data_fillNO = 1; // to fill the class type of counseling data
            for (var check = 7; check < 26; check++) {
              if (response[14][check] == 1) {
                $(".chk" + data_fillNO).prop("checked", true);
              }
              data_fillNO++;

            }
          }

          $("#ls_rpr_dilution").text(response[16]);

          $("#hts-search").prop("disabled", true);

          DateTo_text();
          dob_input = response[3];
          $("#agey_register").val(response[0]["Agey"])
          dateOfBirth();

          $("#regbutton").css("display", "none");
          $("#updatebutton").css("display", "block");

        } else {
          // appear Rigister button
          $("#updatebutton").css("display", "none");
          $("#regbutton").css("display", "block");
          $("#confi-newOld").text("New patient");
          document.getElementById("risk_change_checkbox").disabled = true;
          document.getElementById("main_risk").disabled = false;

          document.getElementById("fid").value = "";
          document.getElementById("prepCode").value = "";

          document.getElementById("name").value = "";
          document.getElementById("father").value = "";
          document.getElementById("state").value = "";
          document.getElementById("tt").value = "";
          document.getElementById("quarter").value = "";

          document.getElementById("gender").value = "";

          document.getElementById("phone").value = "";
          document.getElementById("phone2").value = "";
          document.getElementById("phone3").value = "";

          document.getElementById("main_risk").value = "";
          document.getElementById("sub_risk").value = "";
          document.getElementById("dob").value = "";
          document.getElementById("agey").value = "";
          document.getElementById("agem").value = "";
          $("#register_date,#agey_register,#agem_register").val("");
          document.getElementById("generalInfo").innerHTML = "New Patient";



        }
        // follow up history For Log sheet
        $(".log_sheet_hisData").remove();
        //$(".appointment-table p").empty();

        if (response[13] != "no data") {
          for (var i = 0; i < response[13].length; i++) {
            var rowName = "tr_" + i;
            var btnName = "btn_" + i;
            var srNum = i + 1;

            var result_body1 =
              "<tr style='background-color:#A7DBD8; color:#000000;'" + "id='" + rowName +
              "' class='log_sheet_hisData'>"
              // +"<td id='updateSerial1'>"+srNum+"</td>"
              +
              "<td class='tablet-pc' >" + (i + 1) + "</td>" +
              "<td id='col_3'>" + response[13][i]['Pid'] + "</td>" +
              "<td >" + (response[13][i]['Visit_Date']) + "</td>"
              //  +"<td >"+response[0][i]['Main Risk']+"</td>"
              +
              "<td class= tablet-pc id='" + btnName + "'>" +
              "<button class='btn btn-info btn-primary log-sheet-edit' onclick='row_num(1)' id='logsheet_edit_" +
              response[13][i]['id'] + "'>" + "Edit Log Sheet" + "</button>" +
              "<button class='btn btn-info btn-danger' onclick='row_num(1)' id='logsheet_remove_" +
              response[13][i]['id'] + "'>" + "Delete Data" + "</button>" + "</td>" +
              "</tr>";
            $("#list").append(result_body1);


          }
        } else {
          //var result_body1 = "<p class='no-updateData'>Patient Does Not Have In This Date Please Choice Correct Date</p>"
          // $(".appointment-table").append(result_body1);
        }

        // follow up history for CBS
        $(".cbs_hisData").remove();
        //$(".appointment-table p").empty()

        if (response[14] != "no data") {
          for (var i = 0; i < response[14].length; i++) {
            var rowName2 = "tr2_" + i;
            var btnName2 = "btn2_" + i;
            var srNum2 = i + 1;

            var result_body2 =
              "<tr style='background-color:#A7DBD8; color:#000000;'" + "id='" + rowName2 +
              "' class='cbs_hisData'>"
              // +"<td id='updateSerial1'>"+srNum+"</td>"
              +
              "<td class='tablet-pc' >" + (i + 1) + "</td>" +
              "<td id='col_3'>" + response[14][i]['Pid'] + "</td>" +
              "<td >" + (response[14][i]['Visit_Date']) + "</td>"
              //  +"<td >"+response[0][i]['Main Risk']+"</td>"
              +
              "<td class= tablet-pc id='" + btnName2 + "'>" +
              "<button  class='btn btn-info btn-primary log-sheet-edit' onclick='row_num(2)' id='logsheet_edit_" +
              response[14][i]['id'] + "'>" + "Edit CBS" + "</button>" +
              "<button class='btn btn-info btn-danger' onclick='row_num(2)' id='CBS_remove_" +
              response[14][i]['id'] + "'>" + "Delete Data" + "</button>" + "</td>" +
              "</tr>";
            $("#list2").append(result_body2);


          }
        } else {
          //var result_body1 = "<p class='no-updateData'>Patient Does Not Have In This Date Please Choice Correct Date</p>"
          // $(".appointment-table").append(result_body1);
        }
        if ($("#main_risk").val() == "IDU"||response[11] == "PWID") {
          $("#OST_Eligible, #OST_Offer_Accepted").prop("disabled", false);
        } else {
          $("#OST_Eligible, #OST_Offer_Accepted").prop("disabled", true).val("");
        }

      }

    });

  }

  //function Location ( 2 ) Search with Fuchia ID

  function confidentialSave(num) {
    // For Date
    //alert("Confidential Register clicked" + num);
    var date = new Date();
    var day = date.getDate();
    var month = date.getMonth() + 1;
    var year = date.getFullYear();
    if (month < 10) month = "0" + month;
    if (day < 10) day = "0" + day;
    var today = year + "-" + month + "-" + day;

    if (num == 1) {
      var functionLoco = 3;
      var goal = 1;
    } else {
      var functionLoco = 4;
      var goal = 2;
    }
    console.log("function location is " + functionLoco);

    var created_by = document.getElementById("navbarDropdown").innerHTML;

    var clinic_code = $("#clinic_code").val();
    var gid = $("#gid").text();
    var fid = $("#fid").val();
    var prepCode = $("#prepCode").val();
    var regDate = formatDate($("#register_date").val());

    var name = $("#name").val();
    var father = $("#father").val();
    var gender = $("#gender").val();
    //var dob           = $("#dob").val();
    dateOfBirth();
    dob = ddDate;
    console.log("date of birth from confid save is --> " + dob);

    var agey = $("#agey").val();
    var agem = $("#agem").val();
    var main_risk = $("#main_risk").val();
    var sub_risk = $("#sub_risk").val();

    var changeriskDate = formatDate($("#risk_change_date").val());
    var main_riskChange = $("#main_riskChange").val();
    console.log("Main risk changed Date is here ->>" + changeriskDate)
    var state = $("#state").val();
    var tt = $("#tt").val();
    var quarter = $("#quarter").val();
    var phone = $("#phone").val();
    var phone2 = $("#phone2").val();
    var phone3 = $("#phone3").val();
    var risk_really_change = $("#risk_really_change select").val();


    var confid = {
      goal: goal,
      register_agey: $("#agey_register").val(),
      register_agem: $("#agem_register").val(),
      functionLoco: functionLoco,
      clinic_code: clinic_code,
      gid: gid,
      fid: fid,
      prepCode: prepCode,
      regDate: regDate,
      name: name,
      father: father,
      gender: gender,
      dob: dob,
      agey: agey,
      agem: agem,
      main_risk: main_risk,
      sub_risk: sub_risk,
      changeriskDate: changeriskDate,
      main_riskChange: main_riskChange,
      risk_really_change: risk_really_change,
      state: state,
      tt: tt,
      quarter: quarter,
      phone: phone,
      phone2: phone2,
      phone3: phone3,
      created_by: created_by,
    };

    console.log(confid);
    if (gid.length > 8 && $("#agey_register").val() > 0 && regDate.length > 0) {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        }
      });


      $.ajax({
        type: 'POST',
        url: "{{ route('prevention_data') }}",
        dataType: 'json',
        contentType: 'application/json',
        data: JSON.stringify(confid),
        success: function(response) {
          console.log(response);
          alert("Collect Confidential Fact")
          resp = response[1]; // Add data to Global variable "resp"
          document.getElementById("generalInfo").innerHTML =
            "General ID :" + response[1][0]['Pid'] + ",&nbsp;&nbsp;&nbsp;&nbsp;" +
            "Fuchia ID :" + response[1][0]['FuchiaID'] + ",&nbsp;&nbsp;&nbsp;&nbsp;" +
            "Name :" + response[1][1] + ",&nbsp;&nbsp;&nbsp;&nbsp;" +
            "Sex :" + response[1][7] + ",&nbsp;&nbsp;&nbsp;&nbsp;" +
            // "Age(yr) :"+ Age +",&nbsp;&nbsp;&nbsp;&nbsp;"+
            // "Age(m) :"+ Agem +",&nbsp;&nbsp;&nbsp;&nbsp;"+
            // "Region :"+ Region +",&nbsp;&nbsp;&nbsp;&nbsp;"+
            "Township :" + response[1][5] + ",&nbsp;&nbsp;&nbsp;&nbsp;";
        }
      });

    } else {
      alert("Your wrong permission check your data")
    }


  }

  // Yenaing Function
  function logSheetSave(button) {
    if (LS_updateSignal == 222) {
      update();
    } else {
      var logSheet_data = {}; // Nga Sarrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrr
      $(".log-sheetSection select").each(function(index) {
        logSheet_data[log_seleName[index]] = $(this).val();
      });
      $(".log-sheetSection input[type!='checkbox']").each(function(index) {
        if ($(this).hasClass("Gdate")) {
          logSheet_data[log_inputName[index]] = formatDate($(this).val());
        } else {
          logSheet_data[log_inputName[index]] = $(this).val();
        }
      });
      $(".log-sheetSection input[type='checkbox']").each(function(index) {
        if ($(this).prop('checked')) {
          logSheet_data[log_checkName[index]] = $(this).val();
        } else {
          logSheet_data[log_checkName[index]] = "";
        }

      });

      logSheet_data["Pid"] = resp[0]["Pid"];
      logSheet_data["FuchiaID"] = resp[0]["FuchiaID"];
      logSheet_data["PrEPCode"] = resp[0]["PrEPCode"];
      logSheet_data["Sex"] = resp[7];
      logSheet_data["Age"] = $("#agey").val();

      logSheet_data["Initial_Risk"] = resp[0]["Former Risk"];
      // logSheet_data["Risk_changed_Date"]=resp[0]["Risk Change_Date"];


      // logSheet_data["Visit_Year"]=resp[0]["Reg Date"].split("-")[0];// From Global var defined by PtData()
      // logSheet_data["Current_Age"]=$("#agey").val();// From Global var defined by PtData()

      logSheet_data["Main_Risk"] = resp[11];
      logSheet_data["Sub_Risk"] = resp[12];
      logSheet_data["Township"] = resp[5];
      // logSheet_data["Reg_Date"]=resp[0]["Reg Date"];// Registration date

      logSheet_data["New_old"] = $("#new_old").text(); //Reach New Old
      logSheet_data["Lab_New_old"] = $("#lab_new_old").text();


      // logSheet_data["vDate"] = formatDate($("#vDate").val());
      logSheet_data["functionLoco"] = "5";

      logSheet_data["He_code"] = $("#he_code").val();
      logSheet_data["clinic_code"] = $("#he_code").val();
      console.log(logSheet_data);

      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        }
      });
      $.ajax({
        type: 'POST',
        url: "{{ route('prevention_data') }}",
        dataType: 'json',
        //  processData:false,
        contentType: 'application/json',
        data: JSON.stringify(logSheet_data),
        beforeSend: function() {
          $(button).prop("disabled", true);
          timeoutHandle = setTimeout(oneClick, 3000);
        },
        success: function(response) {
          $(button).prop("disabled", false);
          clearTimeout(timeoutHandle);

          console.log(response);
          if (response[0] == false) {
            alert("Duplicate Data has not been allowed.");
          } else {
            alert("collected data");

            //$(".appointment-table p").empty();

            if (response[1] != null) {


              var ser_no = Number($("#list tr:last-child() td:first-child()").text()) + 1;

              var result_body1 =
                "<tr style='background-color:#A7DBD8;' color:'#000000'; class='log_sheet_hisData'>"
                // +"<td id='updateSerial1'>"+srNum+"</td>"
                +
                "<td class='tablet-pc' >" + ser_no + "</td>" +
                "<td id='col_3'>" + response[1]['Pid'] + "</td>" +
                "<td >" + (response[1]['Visit_Date']) + "</td>"
                //  +"<td >"+response[0][i]['Main Risk']+"</td>"
                +
                "<td class= tablet-pc >" +
                "<button class='btn btn-info btn-primary log-sheet-edit' onclick='row_num(1)' id='logsheet_edit_" +
                response[1]['id'] + "'>" + "Edit Log Sheet" + "</button>" +
                "<button class='btn btn-info btn-danger' onclick='row_num(1)' id='logsheet_remove_" +
                response[1]['id'] + "'>" + "Delete Data" + "</button>" + "</td>" +
                "</tr>";
              $("#list").append(result_body1);
              $("#logsheet_save").text("Update");
              LS_updateSignal = 222;
            }
          }

          // location.reload(true);
        }
      });
    }
  } //log Sheet save 

  function define_new_old() {
    LS_updateSignal
    let vdate = $("#vDate").val();
    let visit_year = vdate.split("-")[2];
    var gid = $("#gid").text();
    var new_old = {
      general_ID: gid,
      visit_year: visit_year,
      LS_updateSignal: LS_updateSignal,
      vdate: formatDate(vdate),
      functionLoco: 17,
    }
    console.log(new_old);

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
      }
    });
    $.ajax({
      type: 'POST',
      url: "{{ route('prevention_data') }}",
      dataType: 'json',
      //  processData:false,
      contentType: 'application/json',
      data: JSON.stringify(new_old),

      success: function(response) {
        console.log(response);
        if (response[0]["logCBS_reach"] == true) {
          // $("#lab_new_old").text("Old");
          $("#new_old").text("Old");
        } else {
          // $("#lab_new_old").text("New");
          $("#new_old").text("New");
        }
        if (response[0]["lob_result"] != null) {
          $("#hiv_result").val(response[0]["lob_result"]);
        }
      }
    });

  }

  function determineReactive() {
    var determineResult = $("#determine_result").val();
    var visitDate = $("#vDate").val();
    console.log("Determine Result is" + determineResult);
    if (determineResult == "Reactive") {
      var determine_result = {};
      //console.log(resp);


      determine_result["Pid"] = resp[0]["Pid"];
      determine_result["vDate"] = visitDate;
      determine_result["functionLoco"] = "7";

      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        }
      });
      $.ajax({
        type: 'POST',
        url: "{{ route('prevention_data') }}",
        dataType: 'json',
        //  processData:false,
        contentType: 'application/json',
        data: JSON.stringify(determine_result),

        success: function(response) {
          console.log(response);
          alert("got");
          // if(response[0]==false){
          //   alert("Duplicate Data has not been allowed.");
          // }else{
          //   alert ("collected data");
          // }

          // // location.reload(true);
        }
      });
    }
  }

  function cbsSave() {

    if (LS_updateSignal == 333) {
      update();
    } else {



      var cbs_name = ['retesting', 'HIV_status_2', 'pre_counsel', 'post_counsel', 'hiv_determine', 'hiv_final',
        'service', 'mode',
      ];
      var cbs_data = {};
      var cbsDate_input = ['vDate2', 'meetingPoint2', 'reactive_refer', 'date_confirm'];
      var cbs_check = ['he', 'condome', 'nsp', 'cbs_sti', 'cbs_counselling'];
      console.log($("#cbs_vDate").val());

      $(".cbs-Section select").each(function(index) {
        cbs_data[cbs_name[index]] = $(this).val();
      });

      $(".cbs-Section input[type!='checkbox']").each(function(index) {

        if (index == 0 || index == 3) {
          cbs_data[cbsDate_input[index]] = formatDate($(this).val());
        } else {
          cbs_data[cbsDate_input[index]] = $(this).val();
        }

      });
      $(".cbs-Section input[type='checkbox']").each(function(index) {
        if ($(this).prop('checked')) {
          cbs_data[cbs_check[index]] = $(this).val();
        } else {
          cbs_data[cbs_check[index]] = "";
        }

      });



      cbs_data["functionLoco"] = "6";

      cbs_data['reachKp_ptcalender'] = $("#reached_kp_partners").text();
      cbs_data["Clinic_Code"] = $("#clinic_code").val();
      cbs_data["Pid"] = $("#gid").text();
      cbs_data["FuchiaID"] = $("#fid").val();
      cbs_data["PrEPCode"] = $("#prepCode").val();;
      cbs_data["Agey"] = $("#agey").val();
      cbs_data["Sex"] = $("#gender").val();
      cbs_data["Risk"] = $("#main_risk").val();




      console.log(cbs_data);

      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        }
      });
      $.ajax({
        type: 'POST',
        url: "{{ route('prevention_data') }}",
        dataType: 'json',
        //  processData:false,
        contentType: 'application/json',
        data: JSON.stringify(cbs_data),

        success: function(response) {
          console.log(response);
          if (response[0] == false) {
            alert("Duplicate Data has not been allowed.");
          } else {
            alert("collected data");
            // follow up history
            if (response[1] != "") {
              for (var i = 0; i < response[1].length; i++) {
                var rowName2 = "tr2_" + i;
                var btnName2 = "btn2_" + i;
                var srNum2 = i + 1;

                var result_body2 =
                  "<tr style='background-color:#A7DBD8; color:#000000;'" + "id='" +
                  rowName2 + "' class='cbs_hisData'>"
                  // +"<td id='updateSerial1'>"+srNum+"</td>"
                  +
                  "<td class='tablet-pc' >" + (i + 1) + "</td>" +
                  "<td id='col_3'>" + response[1][i]['Pid'] + "</td>" +
                  "<td >" + (response[1][i]['Visit_Date']) + "</td>"
                  //  +"<td >"+response[0][i]['Main Risk']+"</td>"
                  +
                  "<td class= tablet-pc id='" + btnName2 + "'>" +
                  "<button  class='btn btn-info btn-primary log-sheet-edit' onclick='row_num(2)' id='logsheet_edit_" +
                  response[1][i]['id'] + "'>" + "Edit CBS" + "</button>" +
                  "<button class='btn btn-info btn-danger' onclick='row_num(2)' id='CBS_remove_" +
                  response[1][i]['id'] + "'>" + "Delete Data" + "</button>" + "</td>" +
                  "</tr>";
                $("#list2").append(result_body2);
              }
            }
          }

          // location.reload(true);
        }
      });
    }
  }

  function hecheck() {

    $(".He-span").text("");
    var log_checkName = [
      'Hiv(1)/', 'Sti(2)/', 'Self_inject(3)/', 'Safe_sex(4)/',
      'MMT(5)/', "TB/", 'Family_Planing/', 'Overdose/', 'HBV HCV',
    ]
    var check_text = [];
    $("#he_check input[type='checkbox']").each(function(index) {
      if ($(this).prop('checked')) {
        check_text[index] = log_checkName[index];

      } else {
        check_text[index] = "";
      }
    })
    for (var i = 0; i < check_text.length; i++) {
      var he_text = $(".He-span").text();
      $(".He-span").text(he_text + "\t" + check_text[i]);
    }

  }

  function cbs_check() {
    $(".cbsCheck-span").text("");
    var cbs_checkName = [
      'HE/', 'Condom/', 'NSP/', 'STI/', 'CBS Counselling'
    ]
    var check_text = [];
    $("#cbs_Check input[type='checkbox']").each(function(index) {
      if ($(this).prop('checked')) {
        check_text[index] = cbs_checkName[index];

      } else {
        check_text[index] = "";
      }
    })
    for (var i = 0; i < check_text.length; i++) {
      var cbs_text = $(".cbsCheck-span").text();
      $(".cbsCheck-span").text(cbs_text + "\t" + check_text[i]);
    }

  }

  function send_fup() {

    let ptFollowup = 1;
    var functionLoco = 4;
    var clinic_code = document.getElementById("clinic_code").value;

    var gid = document.getElementById("gid").innerHTML;
    var created_by = document.getElementById("navbarDropdown").innerHTML;
    var agey = document.getElementById("agey").value;
    var agem = document.getElementById("agem").value;
    var gender = document.getElementById("gender").value;
    var regDate = document.getElementById("register_date").value;
    regDate = formatDate(regDate);
    dateOfBirth();
    var dobdate = ddDate;

    var fuchiaID = document.getElementById("fid").value;
    var prepCode = document.getElementById("prepCode").value;

    if (!dobdate) {
      dobdate = "0000-00-00";
    }

    var agey = document.getElementById("agey").value;
    if (!agey) {
      agey = 0;
    }
    var agem = document.getElementById("agem").value;
    if (!agem) {
      agem = 0;
    }
    var gender = document.getElementById("gender").value;
    if (!gender) {
      gender = "-";
    }
    var regDate1 = document.getElementById("register_date").value;
    $.get("js/date.js", function(regDate1) {
      var regDate = formatDate(regDate1);

    });
    console.log(regDate1 + "Hello regDate1")
    console.log(regDate + "test");
    dateOfBirth();
    var dobdate = ddDate;


    var state = document.getElementById("state").value;
    if (!state) {
      state = "-";
    }
    var tt = document.getElementById("tt").value;
    if (!tt) {
      tt = "-";
    }
    var fuchiaID = document.getElementById("fid").value;
    if (!fuchiaID) {
      fuchiaID = "-";
    }
    var prepCode = document.getElementById("prepCode").value;
    if (!prepCode) {
      prepCode = "-";
    }


    var main_risk = "-";
    var sub_risk = "-";

    if (gid.length == 10) { //Mode 1= Walk in , 2= Peer with 11,12 code.length;
      var mode = 0;
    } else {
      var mode = 1;
    }
    if (fuchiaID.length < 1) {
      fuchiaID = "-";
    }
    var Patient_Type = "-";
    var New_Old = "-";
    var Fever = "-";
    var Diagnosis = "-";
    var Support = "-";

    var Patient_Type_1 = "-";
    var New_Old_1 = "-";
    var Fever_1 = "-";
    var Diagnosis_1 = "-";
    var Support_1 = "-";

    var Patient_Type_2 = "-";
    var New_Old_2 = "-";
    var Fever_2 = "-";
    var Diagnosis_2 = "-";
    var Support_2 = "-";
    var unplan = 0;

    var pati = {
      functionLoco: functionLoco,
      ptFollowup: ptFollowup,
      clinic_code: clinic_code,
      gid: gid,
      mode: mode,
      fuchiaID: fuchiaID,
      prepCode: prepCode,
      agey: agey,
      agem: agem,
      gender: gender,
      regDate: regDate,
      dobdate: dobdate,

      main_risk: main_risk,
      sub_risk: sub_risk,

      Patient_Type: Patient_Type,
      New_Old: New_Old,
      Fever: Fever,
      Diagnosis: Diagnosis,
      Support: Support,

      Patient_Type_1: Patient_Type_1,
      New_Old_1: New_Old_1,
      Fever_1: Fever_1,
      Diagnosis_1: Diagnosis_1,
      Support_1: Support_1,

      Patient_Type_2: Patient_Type_2,
      New_Old_2: New_Old_2,
      Fever_2: Fever_2,
      Diagnosis_2: Diagnosis_2,
      Support_2: Support_2,

      unplan: unplan,
      created_by: created_by,
    };
    var len_data = gid.length;
    if (len_data > 0) {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        }
      });
      $.ajax({
        type: 'POST',
        url: "{{ route('prevention_data') }}",
        dataType: 'json',
        //  processData:false,
        contentType: 'application/json',
        data: JSON.stringify(pati),
        success: function(response) {
          console.log(response);
          if (response[0] == true) {
            alert("Duplicate Entry");
          } else {
            alert("Your data has been collected.");
          }

          //alert("Your data has been collected.");
          location.reload(true); // to refresh the page
          document.getElementById('regbutton').disabled = false;
        }
      });
    } else {

    }

  }


  // function location ( 7 ) to find pt data with General ID  in return section

  function PatientType() {
    var type = document.getElementById('main_risk').value;
    if (sub_risk.innerHTML != null) {
      sub_risk.innerHTML = "";
    }
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
    if (type == "Low risk") {
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
    // PWUD
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
      opt0.value = "";
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
      opt1.appendChild(document.createTextNode("MSM PWID"));
      opt2.appendChild(document.createTextNode("MSM PWUD"));
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
    //main_riskChange();
    // migrant
  } //Risk
  function getAge(bd_date) {

    var dates = bd_date.split("-");
    var d = new Date();

    var useryear = dates[0];
    var usermonth = dates[1];
    var userday = dates[2];

    var curday = d.getDate();
    var realMonth = d.getMonth();
    var curmonth = d.getMonth() + 1;
    var curyear = d.getFullYear();

    if (curyear == useryear) {
      var age = realMonth - usermonth;
      console.log("month" + age);
    } else {
      var age = curyear - useryear;
      console.log("age" + age);
    }
    if ((curmonth < usermonth) || ((curmonth == usermonth) && curday < userday)) {
      age--;
    }

    return age;
  }
  // Search

  function refresh() {
    location.reload(true);
  }

  function followupHistory() {
    var gid = document.getElementById('id_hist').value;
    ptID = gid;
    var ck_followUpHistory = 1;
    var functionLoco = 11;
    var ckdata = {
      gid: gid,
      functionLoco: functionLoco,
      ck_followUpHistory: ck_followUpHistory
    };
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
      }
    });
    $.ajax({
      type: 'POST',
      url: "{{ route('prevention_data') }}",
      dataType: 'json',
      contentType: 'application/json',
      data: JSON.stringify(ckdata),
      success: function(response) {
        console.log(response);
        $("#followupHistory").empty();
        for (var i = 0; i < response[0].length; i++) {

          var rowName = "tr_" + i;
          var btnName = "btn_" + i;
          var srNum = i + 1;
          var but_ton1 =
            "<a  data-toggle='tab' href='#rpr' onclick='rpr_row_0(resp)' class='nav-link btn btn-warning'>" +
            "Update Data" + "</a>";
          var result_body1 =
            "<tr style='background-color:#A7DBD8;'" + "id='" + rowName + "'>" +
            "<td id='updateSerial1'>" + srNum + "</td>" +
            "<td >" + response[0][i]['id'] + "</td>" +
            "<td >" + response[0][i]['Visit Date'] + "</td>" +
            "<td id='col_3'>" + response[0][i]['Pid'] + "</td>" +
            "<td>" + response[0][i]['FuchiaID'] + "</td>" +
            "<td>" + response[0][i]['PrEPCode'] + "</td>" +
            "<td >" + response[0][i]['Agey'] + "</td>" +
            "<td>" + response[1] + "</td>" +
            "<td  id='" + btnName + "'>" +
            "<a style='border-bottom:4px solid yellow;' onclick='row_num()' >" + "Update" +
            "</a>" + "</td>" +
            "</tr>";
          $("#followupHistory").append(result_body1);
        }



        if ($(window).width() < 1161 && $(window).width() > 599.9) {
          $("#followupHistory-tablet").empty();
          console.log("hello tablet cc");
          var result_body_tablet = "<ul class='clearfix'>" + "<li>" + 'General ID.- ' +
            "<b id='tablet_updateID'>" + response[0][0]['Pid'] + "</b>" + "</li>" + "<li>" +
            'Fuchia ID- ' + response[0][0]['FuchiaID'] + "</li>" + "<li>" + 'PrEPCode- ' +
            response[0][0]['PrEPCode'] + "</li>" + "<li>" + 'Age- ' + response[0][0]['Agey'] +
            "</li>" + "<li>" + 'sex- ' + response[1] + "</li>" + "</ul>";
          $("#followupHistory-tablet").append(result_body_tablet);
          // result_body_tablet="<ul class='clearfix'>"+"<li>"+response[0][0]['Pid']+"</li>"+"<li>"+response[0][0]['FuchiaID']+"</li>"+"<li>"+response[0][0]['PrEPCode']+"</li>"+"<li>"+response[0][0]['Agey']+"</li>"+"<li>"+response[0][0]['Gender']+"</li>"+"</ul>";
          // $("#followupHistory-tablet").append(result_body_tablet);
          result_body_tablet = "<ul class='clearfix'>" + "<li>" + 'NO.' + "</li>" + "<li>" +
            'Row ID' + "</li>" + "<li>" + 'Visit Date' + "</li>" + "<li>" + '' + "</li>" +
            "</ul>";
          $("#followupHistory-tablet").append(result_body_tablet);
          for (var i = 0; i < response[0].length; i++) {
            var srNum = i + 1;
            var btnName = "btn_" + i;
            var rowName = "ul_" + i;

            var result_body_tablet = "<ul class='clearfix'" + "id='" + rowName + "'>" + "<li>" +
              srNum + "</li>" + "<li>" + response[0][i]['id'] + "</li>" +
              "<li>" + response[0][i]['Visit Date'] + "</li>" +
              "<li id='" + btnName + "'>" + "<button onclick='row_num()' >" + "Update" +
              "</button>" + "</li>" + "</ul>";
            $("#followupHistory-tablet").append(result_body_tablet);
          }


        } else if ($(window).width() < 600) {
          $("#followupHistory-mobile").empty();

          var result_body_mobile =
            "<h5 style='display:inline-block;margin-right:4%;color:#b0d991'>" + "General Id-" +
            "</h5>" + "<b id='mobile_updateID'>" + response[0][0]['Pid'] + "</>"
          $("#followupHistory-mobile").append(result_body_mobile);
          result_body_mobile = "<ul class='clearfix'>" + "<li>" + 'NO.' + "</li>" + "<li>" +
            'Visit Date' + "</li>" + "<li>" + 'Fuchia ID' + "</li>" + "</ul>";
          $("#followupHistory-mobile").append(result_body_mobile);


          for (var i = 0; i < response[0].length; i++) {
            var srNum = i + 1;

            var result_body_mobile = "<ul class='clearfix'>" + "<li>" + srNum + "</li>" +
              "<li>" +
              response[0][i]['Visit Date'] + "</li>" +
              "<li>" + response[0][i]['FuchiaID'] + "</li>" + "</ul>";
            $("#followupHistory-mobile").append(result_body_mobile);
          }

        }


      }
    });

  }

  function row_num(section) { // to get row ID from follow up History
    // if ($(window).width()<1160 &&$(window).width()>599.9 ) {
    //   ptID = document.getElementById("tablet_updateID").innerHTML;
    // }else if ($(window).width()<600){
    //   ptID = document.getElementById("mobile_updateID").innerHTML;

    // }


    hts_date = formatDate($(event.target).parent().parent().children().eq(2)
      .text()); // collecting id of the targeted parent
    rowNumber = event.target.id.match(/\d+/)[0];
    ptID = $(event.target).parent().parent().children().eq(1).text();
    var edit_del = $(event.target).text();
    if (edit_del == "Delete Data") {
      if (confirm("Are you sure Delete this data")) {
        if (section == 1) {
          remove_prevention_row("logsheet");
        } else if (section == 2) {
          remove_prevention_row("cbs");
        }
      }

    } else {
      $(".l_sheet,#log_sheet").removeClass("fade");
      $(".l_sheet,#log_sheet").addClass("active");
      $(".nav_follow,#follow").removeClass("active");

      if (section == 1) {
        updateFiller(rowNumber, ptID, 1);
      } else if (section == 2) {
        updateFiller(rowNumber, ptID, 2);
      }
    }


  }

  function remove_prevention_row(about) {
    var functionLoco = 16 // to remove logsheet and cbs
    let remove_data = {
      functionLoco: functionLoco,
      Pid: ptID,
      rowNumber: rowNumber,
      hts_date: hts_date,
      functionLoco: functionLoco,
      about: about
    }
    console.log(remove_data);
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
      }
    });
    $.ajax({
      type: 'POST',
      url: "{{ route('prevention_data') }}",
      dataType: 'json',
      contentType: 'application/json',
      data: JSON.stringify(remove_data),
      success: function(response) {
        console.log(response);
        if (response == "Success delete") {
          alert(response)
          ptData();
        } else {
          alert(response)
        }
      }
    })

  }
  // function location ( 12 ) to fill data in new form
  function updateFiller(text, ptID, section) {

    let rowID = text;
    rowNumber = text;
    var toUpdateFollowup = 1;

    if (section == 1) {
      var functionLoco = 8;
    } else if (section == 2) {
      var functionLoco = 12
    }


    var ckdata = {
      ptID: ptID,
      rowID: rowID,
      hts_date: hts_date,
      functionLoco: functionLoco,
      toUpdateFollowup: toUpdateFollowup
    };
    console.log(ckdata);
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
      }
    });
    $.ajax({
      type: 'POST',
      url: "{{ route('prevention_data') }}",
      dataType: 'json',
      contentType: 'application/json',
      data: JSON.stringify(ckdata),
      success: function(response) {
        console.log(response);

        // Log Sheet
        if (response[2] == 1) {
          $("#vDate").val(response[0]["Visit_Date"]);
          // $("#substan_risk").val(response[0]["Substantial Risk"]);
          // $("#meeting_point").val(response[0]["Meeting Point"]);
          $("#serve_pro_1").val(response[0]["Service Provision1"]);
          $("#serve_pro_2").val(response[0]["Service Provision2"]);
          $("#serve_pro_3").val(response[0]["Service Provision3"]);

          // HE Section ...
          // if (response[0]["HE_Section"] !== null) {
          //     $(".He-span").text("");
          //     var He_Section = response[0]["HE_Section"].split(",");
          //     $("#he_check input[type='checkbox']").prop("checked", false);
          //     for (let index = 0; index < He_Section.length; index++) {
          //         if (He_Section[index] == "HIV(1)") {
          //             $("#he_hiv").prop("checked", true);
          //         }
          //         if (He_Section[index] == "STI(2)") {
          //             $("#he_sti").prop("checked", true);
          //         }
          //         if (He_Section[index] == "Safe injection(3)") {
          //             $("#he_safe_inj").prop("checked", true);
          //         }
          //         if (He_Section[index] == "Safe sex(4)") {
          //             $("#he_safe_sex").prop("checked", true);
          //         }
          //         if (He_Section[index] == "MMT(5)") {
          //             $("#he_mmt").prop("checked", true);
          //         }
          //         if (He_Section[index] == "TB") {
          //             $("#he_tb").prop("checked", true);
          //         }
          //         if (He_Section[index] == "Family Planning") {
          //             $("#he_family_planning").prop("checked", true);
          //         }
          //         if (He_Section[index] == "Overdose") {
          //             $("#he_overdose").prop("checked", true);
          //         }
          //         if (He_Section[index] == "HBV HCV") {
          //             $("#he_hcv").prop("checked", true);
          //         }
          //     }
          //     for (var i = 0; i < He_Section.length; i++) {
          //         var he_text = $(".He-span").text();
          //         $(".He-span").text(he_text + "\t" + He_Section[i] + "/");
          //     }

          // }


          $("#ns_distribution").val(response[0]["Ns_distribute"]);
          $("#condom_male").val(response[0]["Condom_m"]);
          $("#condom_female").val(response[0]["Condom_f"]);
          $("#ns_return").val(response[0]["Ns_return"]);

          $("#hiv_status").val(response[0]["HIV Status"]);
          if (response[1] == "2") {
            $("#hiv_status_sub_div").show();
          } else {
            $("#hiv_status_sub_div").hide();
          }
          $("#new_old").text(response[0]["New_Old"]);
          $("#hiv_status_sub").val(response[0]["Test_duration"]);
          $("#hts_test").val(response[0]["HTS done"]);
          $("#hiv_result").val(response[0]["HIV_Final_result"]);
          $("#hiv_comfirm_date").val(response[0]["date_confirm"]);

          $("#reach_by_whom").val(response[0]["Reach_whom"]);
          $("#source_doc").val(response[0]["Source_doc"]);
          $("#remark").val(response[0]["Remark"]);
          $("#test_clinic").val(response[0]["Test_Clinic"])
          $("#mental_health").val(response[0]["Mental_Health"])
          $("#PHQ4_Q1_Q2").val(response[0]["PHQ4_Q1_Q2"])
          $("#PHQ4_Q3_Q4").val(response[0]["PHQ4_Q3_Q4"])
          $("#OST_Offer_Accepted").val(response[0]["OST_Accept"])
          // $("#OST_Offer_Done").val(response[0]["OST_Done"])
          $("#OST_Eligible").val(response[0]["OST_Eligible"]);
          $("#referral_cupon").val(response[0]["Referral_Coupon"]);
          $("#Decline_Reason").val(response[0]["Decline_Reason_new"])
          // $("#Decline_Reason").val(response[0]["Decline_Reason"])
          // $("#OST_Intial_Date").val(response[0]["OST_Initial_Date"])
          $("#lab_new_old").text(response[0]["Test_New_Old"])

          $("#logsheet_save").text("Update");

          LS_updateSignal = 222;

          resp = response[1]; // Data from config
        }

        // CBS
        else if (response[2] == 2) {
          $("#cbs_save").text("Update");

          $("#cbs-section").show();

          $("#vDate2").val(response[0]["Visit_Date"]);

          $("#meetingPoint2").val(response[0]["Meeting Point"]);
          $("#reached_kp_partners").text(response[0]["New_Old"]);

          // HE Section ...
          $(".cbsCheck-span").text("");
          var service_provision = response[0]["Service Provision"].split(",");
          $("#he_check input[type='checkbox']").prop("checked", false);
          for (let index = 0; index < service_provision.length; index++) {
            if (service_provision[index] == "HE") {
              $("#service_pro_he").prop("checked", true);
            }
            if (service_provision[index] == "Condom") {
              $("#service_pro_condom").prop("checked", true);
            }
            if (service_provision[index] == "NSP") {
              $("#service_pro_nsp").prop("checked", true);
            }
            if (service_provision[index] == "SSTI") {
              $("#service_pro_sti").prop("checked", true);
            }
            if (service_provision[index] == "CBS counselling") {
              $("#service_pro_cbs").prop("checked", true);
            }

          }
          for (var i = 0; i < service_provision.length; i++) {
            var he_text = $(".cbsCheck-span").text();
            $(".cbsCheck-span").text(he_text + "\t" + service_provision[i] + "/");
          }
          //  $("#reached_kp_partners").val(response[0][""]);


          $("#retesting").val(response[0]["Retesting"]);
          $("#pre_test_counsel").val(response[0]["Counselling_pretest"]);
          $("#post_test_counsel").val(response[0]["Counselling_posttest"]);
          $("#determine_result").val(response[0][
            "HIV_determine_result"
          ]); // HIV status in controller
          $("#if_reactive_refer").val(response[0]["Refer_to"]);
          $("#date_arrival_confirm_facility").val(response[0]["date_confirm"]);

          $("#hiv_status_after_confirm").val(response[0]["HIV Sero-Status"]);
          $("#HIV_status_2").val(response[0]["HIV result"]);

          // From HTS Data Table


          $("#service").val(response[0]["Service_Modality"]);
          $("#m_o_entry").val(response[0]["Mode_of_Entry"]);
          $("#reached_kp_partners").text(response[0]["New_Old"]);
          //  $("#").val(response[0][""]);


          // console.log(response[11]);console.log([6]);
          // console.log("hello response")

          // rowNumber = response[12];

          LS_updateSignal = 333;

          resp[0] = response[1]; // Data from config




        }
        DateTo_text();
        define_new_old();
        //mental_validation();
        hiv_test_determine();

      }

    });




  }
  // function location ( 13 ) to save update data
  function update() {

    if (LS_updateSignal == 222) {
      var f_up_update = 1;
      var functionLoco = 9;
      var logSheet_data = {}; // 
      console.log(resp);
      $(".log-sheetSection select").each(function(index) {
        logSheet_data[log_seleName[index]] = $(this).val();
        console.log($(this).attr("id"));
      });
      $(".log-sheetSection input[type!='checkbox']").each(function(index) {
        if ($(this).hasClass("Gdate")) {
          logSheet_data[log_inputName[index]] = formatDate($(this).val());
        } else {
          logSheet_data[log_inputName[index]] = $(this).val();
        }
      });
      $(".log-sheetSection input[type='checkbox']").each(function(index) {
        if ($(this).prop('checked')) {
          logSheet_data[log_checkName[index]] = $(this).val();
        } else {
          logSheet_data[log_checkName[index]] = "";
        }

      });

      logSheet_data["Pid"] = resp["Pid"];
      logSheet_data["FuchiaID"] = resp["FuchiaID"];
      logSheet_data["PrEPCode"] = resp["PrEPCode"];
      logSheet_data["Sex"] = resp["Gender"];
      logSheet_data["Age"] = $("#agey").val();
      logSheet_data["Main_Risk"] = resp["Main Risk"];
      logSheet_data["Sub_Risk"] = resp["Sub Risk"];
      logSheet_data["Reg_Date"] = resp["Reg Date"]; // Registration date

      logSheet_data["New_old"] = $("#new_old").text();
      logSheet_data["Lab_New_old"] = $("#lab_new_old").text();

      //logSheet_data["vDate"]=formatDate($("#vDate").val());
      logSheet_data["functionLoco"] = functionLoco;

      logSheet_data["He_code"] = $("#he_code").val();
      logSheet_data["clinic_code"] = $("#he_code").val();
      logSheet_data["RowID"] = rowNumber;

      console.log("This is from log sheet data , ID is " + logSheet_data["Pid"]);
      console.log(logSheet_data);

      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        }
      });
      $.ajax({
        type: 'POST',
        url: "{{ route('prevention_data') }}",
        dataType: 'json',
        contentType: 'application/json',
        data: JSON.stringify(logSheet_data),
        success: function(response) {
          alert("You have update the followup data of the patient.");
          location.reload(true); // to refresh the page

        }

      });
    } else if (LS_updateSignal == 333) {

      var cbs_name = ['retesting', 'HIV_status_2', 'pre_counsel', 'post_counsel', 'hiv_determine', 'hiv_final',
        'service', 'mode',
      ];
      var cbs_data = {};
      var cbsDate_input = ['vDate2', 'meetingPoint2', 'reactive_refer', 'date_confirm'];
      var cbs_check = ['he', 'condome', 'nsp', 'cbs_sti', 'cbs_counselling'];


      $(".cbs-Section select").each(function(index) {
        cbs_data[cbs_name[index]] = $(this).val();
      });

      $(".cbs-Section input[type!='checkbox']").each(function(index) {

        if (index == 0 || index == 3) {
          cbs_data[cbsDate_input[index]] = formatDate($(this).val());
        } else {
          cbs_data[cbsDate_input[index]] = $(this).val();
        }

      });
      $(".cbs-Section input[type='checkbox']").each(function(index) {
        if ($(this).prop('checked')) {
          cbs_data[cbs_check[index]] = $(this).val();
        } else {
          cbs_data[cbs_check[index]] = "";
        }

      });

      cbs_data["vDate"] = formatDate($("#vDate").val());
      cbs_data["meeting_point"] = $("#meeting_point").val();
      cbs_data["functionLoco"] = "13";
      cbs_data["RowID"] = rowNumber;

      cbs_data['reachKp_ptcalender'] = $("#reached_kp_partners").text();
      cbs_data["Clinic_Code"] = resp[0]["Clinic Code"];
      cbs_data["Pid"] = resp[0]["Pid"];
      cbs_data["FuchiaID"] = resp[0]["FuchiaID"];
      cbs_data["PrEPCode"] = resp[0]["PrEPCode"];
      cbs_data["Agey"] = $("#agey").val();
      cbs_data["Sex"] = resp[0]["Gender"];
      cbs_data["Risk"] = resp[0]["Main Risk"];
      console.log(cbs_data);



      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        }
      });
      $.ajax({
        type: 'POST',
        url: "{{ route('prevention_data') }}",
        dataType: 'json',
        //  processData:false,
        contentType: 'application/json',
        data: JSON.stringify(cbs_data),

        success: function(response) {
          console.log(response);
          if (response[0] == false) {
            alert("Duplicate Data has not been allowed.");
          } else {
            alert("collected data");
          }
          location.reload(true);
        }
      });
    }

  }

  function peerCode() {

    var peercode = document.getElementById("he_code").value;
    var cliniccode = document.getElementById("clinic_code").value;
    var yearcode = document.getElementById("year_code").value;
    var ptcode = document.getElementById("pt_code").value;

    var lenCode = 0;

    console.log(ptcode);
    if (ptcode.length == 6) {
      if (peercode == "0") {
        peercode = cliniccode + yearcode + ptcode;
      } else {
        peercode = peercode + cliniccode + yearcode + ptcode;
      }
      document.getElementById("gid").innerHTML = peercode;
      ptData();
    } else if (ptcode.length == 5) {
      ptcode = "0" + ptcode;
      if (peercode == "0") {
        peercode = cliniccode + yearcode + ptcode;
      } else {
        peercode = peercode + cliniccode + yearcode + ptcode;
      }
      document.getElementById("gid").innerHTML = peercode;
      ptData();
    } else if (ptcode.length == 4) {
      ptcode = "00" + ptcode;
      if (peercode == "0") {
        peercode = cliniccode + yearcode + ptcode;
      } else {
        peercode = peercode + cliniccode + yearcode + ptcode;
      }
      document.getElementById("gid").innerHTML = peercode;
      ptData();
    } else if (ptcode.length == 3) {
      ptcode = "000" + ptcode;
      if (peercode == "0") {
        peercode = cliniccode + yearcode + ptcode;
      } else {
        peercode = peercode + cliniccode + yearcode + ptcode;
      }
      document.getElementById("gid").innerHTML = peercode;
      ptData();
    } else if (ptcode.length == 2) {
      ptcode = "0000" + ptcode;
      if (peercode == "0") {
        peercode = cliniccode + yearcode + ptcode;
      } else {
        peercode = peercode + cliniccode + yearcode + ptcode;
      }
      document.getElementById("gid").innerHTML = peercode;
      ptData();
    } else if (ptcode.length == 1) {
      ptcode = "00000" + ptcode;
      if (peercode == "0") {
        peercode = cliniccode + yearcode + ptcode;
      } else {
        peercode = peercode + cliniccode + yearcode + ptcode;
      }
      document.getElementById("gid").innerHTML = peercode;

      ptData();
    } else {
      alert("Please make sure patient code .");
      document.getElementById("pt_code").value = "";
      document.getElementById("gid").innerHTML = "";
      document.getElementById("pt_code").focus();
    }



  }

  function hiv_status() {
    var hiv_status = document.getElementById("hiv_status").value;
    if (hiv_status == 2) {
      $("#hiv_status_sub_div").show();


      var knownNeg_ID = $("#gid").text();
      var functionLoco = 14;
      var vdate = formatDate($("#vDate").val());
      var id = {
        ptid: knownNeg_ID,
        functionLoco: functionLoco,
        vdate: vdate
      };
      console.log(id);

      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        }
      });
      $.ajax({
        type: 'POST',
        url: "{{ route('prevention_data') }}",
        dataType: 'json',
        contentType: 'application/json',
        data: JSON.stringify(id),
        success: function(response) {
          console.log(response);
          alert("Last" + response[0] + "Months")
          if (response[0] < 6) {
            $("#hiv_status_sub").val("2.1");

          } else {
            $("#hiv_status_sub").val("2.2");
          }

        }
      });




    } else {
      $("#hiv_status_sub").val("");
      $("#hiv_status_sub_div").hide();
    }
  }

  function oneOrtwo() {
    var source = $("#source_doc").val();
    if (source == "CBS") {
      // show CBS
      $("#cbs-section").show();
      $("#vDate2").val(formatDate($("#vDate").val()));
      $("#meetingPoint2").val($("#meeting_point").val());
      $("#HIV_status_2").val($("#hiv_status_sub").val());
    } else {
      $("#cbs-section").hide();
    }
    DateTo_text();
  }

  function show_update_ID_box() {
    $("#log_sheet_ID_change").prop("checked") ? $("#log_serach_chagne").text("Change") : $("#log_serach_chagne")
      .text("Search");
  }

  function serarch_change() {
    var ptID_Change = $("#updateID").val();
    var functionLoco = 10;
    var search_change = ($("#log_sheet_ID_change").prop("checked")) ? "Update" : "Search";

    var ckdata = {
      ptID_Change: ptID_Change,
      functionLoco: functionLoco,
    };
    if (search_change == "Search") {
      $("#gid").text(ptID_Change);
      ptData();
    } else {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        }
      });
      $.ajax({
        type: 'POST',
        url: "{{ route('prevention_data') }}",
        dataType: 'json',
        contentType: 'application/json',
        data: JSON.stringify(ckdata),
        success: function(response) {
          if (resp[0]["Pid"].length > 5) {
            resp = response;
            console.log("This is from update_id_change" + resp[0]["Pid"]);
            Ls_ID_change = 1;
          } else {
            alert("Unknown ID");
            $("#GupdateID").val("");
          }
        }
      });
    }



  }

  function final_Result_confirm() {
    if ($("#hiv_result").val() == "Positive" && $("#test_clinic").val() == "HTY-C2") {
      $("#hiv_comfirm_date").prop("disabled", false);
      var functionLoco = 11;
      var hiv_confirm_date = formatDate($("#hiv_comfirm_date").val());
      var to_ck_id = resp[0]["Pid"];
      var ck_hiv_test_confirm = {
        to_ck_id: to_ck_id,
        hiv_confirm_date: hiv_confirm_date,
        functionLoco: functionLoco,
      };
      console.log("This is Ck data::>" + ck_hiv_test_confirm[0]);
      console.log("response data from Pt data function :>" + resp);

      if (hiv_confirm_date.length > 9 && $("#hiv_result").val().length > 5) {

        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
          }
        });
        $.ajax({
          type: 'POST',
          url: "{{ route('prevention_data') }}",
          dataType: 'json',
          contentType: 'application/json',
          data: JSON.stringify(ck_hiv_test_confirm),
          success: function(response) {
            console.log(response);

            if (response[0]["Final_Result"] == $("#hiv_result").val()) {
              console.log("Final result is OK::> " + response[0]["Final_Result"]);
            } else {

              console.log("Final result is " + response[0]["Final_Result"]);
              alert("Wrong result or date.");
              $("#reach_by_whom").val("-");
              $("#hiv_result").focus();
            }

          }

        });
      } else if (hiv_confirm_date.length < 9 && $("#hiv_result").val().length > 5) {
        alert("Please put the confirm date");
        $("#hiv_comfirm_date").focus();
      } else {
        $("#hiv_comfirm_date").val("");
      }

    } else if ($("#hiv_result").val() == "Negative") {
      $("#hiv_comfirm_date").prop("disabled", true);
    }

  }

  function cbs_hiv_final_confirm() {
    var functionLoco = 11;
    var hiv_confirm_date = formatDate($("#date_arrival_confirm_facility").val());
    var to_ck_id = resp[0]["Pid"];
    var ck_hiv_test_confirm = {
      to_ck_id: to_ck_id,
      hiv_confirm_date: hiv_confirm_date,
      functionLoco: functionLoco,
    };
    console.log("This is Ck data::>" + ck_hiv_test_confirm[0]);
    console.log("response data from Pt data function :>" + resp);

    if (hiv_confirm_date.length > 9 && $("#hiv_status_after_confirm").val().length > 5 && $("#test_clinic").val() ==
      "HTY-C2") {

      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        }
      });
      $.ajax({
        type: 'POST',
        url: "{{ route('prevention_data') }}",
        dataType: 'json',
        contentType: 'application/json',
        data: JSON.stringify(ck_hiv_test_confirm),
        success: function(response) {
          console.log(response);

          console.log("response here is :>>>>>" + response.length);
          if (response[0]["Final_Result"] == $("#hiv_status_after_confirm").val()) {
            console.log("Final result is OK::> " + response[0]["Final_Result"]);
          } else {

            console.log("Final result is " + response[0]["Final_Result"]);
            alert("Wrong result or date.");
            $("#hiv_status_after_confirm").val("-");
            $("#date_arrival_confirm_facility").focus();
          }



        }

      });
    } else if (hiv_confirm_date.length < 9 && $("#hiv_status_after_confirm").val().length > 5) {
      alert("Please put the confirm date");
      $("#date_arrival_confirm_facility").focus();
    }

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

  function cbs_hiv_determine() {
    if ($("#determine_result").val() == "Reactive") {
      $("#if_reactive_refer").prop("disabled", false);
      $("#date_arrival_confirm_facility").prop("disabled", false);
      $("#hiv_status_after_confirm").prop("disabled", false);
    } else if ($("#determine_result").val() == "Non Reactive") {
      $("#if_reactive_refer").prop("disabled", true);
      $("#date_arrival_confirm_facility").prop("disabled", true);
      $("#hiv_status_after_confirm").prop("disabled", true);
    }
  }

  function jumpLogSheet() {
    $(".c_fid ,#confid").removeClass("active");
    $(".c_fid").css("color", "blue");
    $(".l_sheet,#log_sheet").addClass("active");
    $("#confid").addClass("fade");
    $("#log_sheet").removeClass("fade");
  }

  function mental_validation() {

    if ($("#mental_health").val() == "No") {
      $("#PHQ4_Q1_Q2,#PHQ4_Q3_Q4").prop("disabled", true);
      $("#PHQ4_Q1_Q2,#PHQ4_Q3_Q4").val("-");

    } else {
      $("#PHQ4_Q1_Q2,#PHQ4_Q3_Q4").prop("disabled", false);
    }

    if ($("#OST_Offer_Done").val() == "No") {
      $("#OST_Offer_Accepted,#OST_Intial_Date,#Decline_Reason").prop("disabled", true);
      $("#OST_Offer_Accepted,#Decline_Reason").val("-");
      $("#OST_Intial_Date").val("");
    } else {
      $("#OST_Offer_Accepted,#OST_Intial_Date,#Decline_Reason").prop("disabled", false);


      if ($("#OST_Offer_Accepted").val() == "Yes") {
        $("#Decline_Reason").prop("disabled", true);
        $("#OST_Intial_Date").prop("disabled", false);
        $("#Decline_Reason").val("-")
      } else {
        $("#Decline_Reason").prop("disabled", false);
        $("#OST_Intial_Date").prop("disabled", true);
        $("#OST_Intial_Date").val();
      }

      // if($("#Decline_Reason").val()!=''){
      //   $("#OST_Intial_Date").prop("disabled",true);
      //   $("#OST_Intial_Date").val()
      // }else{
      //   $("#OST_Intial_Date").prop("disabled",false);
      // }
    }
  }
</script>

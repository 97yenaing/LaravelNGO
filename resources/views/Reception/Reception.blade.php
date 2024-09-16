@extends('layouts.app')
@stack('css')
@auth
@section('content')
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('js/reception.js') }}"></script>
<link href="{{ asset('js/jquery.min.js') }}"
  media="print"
  rel="stylesheet" />

<body>
  @php
  @endphp
  <p class="btn-gnavi">
    <span></span>
    <span></span>
    <span></span>
  </p>
  <div class="container containers">
    @if ($mam_clinicID=="81")
    <button class="btn btn-success predefine"
      id="preCode_define">Pre-define</button>
    @endif

    <ul class="nav nav-tabs toggle  reception-list"
      id="hidden-title">
      <li class="nav-item">
        <a class="nav-link active toggle-link "
          data-toggle="tab"
          href="#reception">Add New / Follow Up</a>
      </li>
      <li class="nav-item">
        <a class="nav-link toggle-link"
          data-toggle="tab"
          href="#return">Diagnosis Data</a>
      </li>
      <li class="nav-item">
        <a class="nav-link toggle-link"
          data-toggle="tab"
          href="#follow">Follow Up History</a>
      </li>
      <li class="nav-item">
        <a class="nav-link toggle-link"
          data-toggle="tab"
          href="#next">Next Appointment List</a>
      </li>
      <li class="nav-item">
        <a class="nav-link toggle-link"
          data-toggle="tab"
          href="#recepint_PtList"
          onclick="showPatientList()">Consultation Records</a>
      </li>
      <li class="nav-item">
        <a class="nav-link toggle-link"
          data-toggle="tab"
          href="#recepint_PtList2">Patient List</a>
      </li>
      <li class="nav-item">
        <a class="nav-link toggle-link"
          data-toggle="tab"
          href="#search_name">Search By Name</a>
      </li>
      <li class="nav-item">
        <a class="nav-link toggle-link"
          data-toggle="tab"
          href="#export">Export</a>
      </li>
      <li class="nav-item">
        <a class="nav-link toggle-link"
          data-toggle="tab"
          href="#qrexport">QR Export</a>
      </li>
    </ul> <!-- *adding containers clss -->

    <ul class="predefine-section clearfix">
      <li>
        <input type="number"
          class="form-control"
          id="pre_number">
      </li>
      <li><button class="btn btn-info preAdd-Btn"
          onclick="preadd()">Generate</button></li>
    </ul>

    <div style="margin:auto"
      id="toshowResult"></div>
    <div id="hider0"
      class="container containers page-color">
      <!-- *adding containers clss -->

      <div class="tab-content">
        <div class="tab-pane container containers active"
          id="reception">
          <div class="row justify-content-center">
            <div class="col-md-10">
              <ul class="clearfix current-md-list">
                @foreach ($current_md as $key => $item)
                <li>{{ $key }}-</li>
                <li>{{ $item }}</li>
                @endforeach

              </ul>
            </div>
            <div class="col-md-2">
              <button class="btn btn-success reception-refresh refresh-follow reception-clinic"
                onclick="refresh()">Refresh</button>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-4 clearfix">
              <p style="float:left;">Response :</p>
              <p style="float:left;"
                id="responseText"></p>
            </div>
          </div>

          <div class="row">
            <div class="col-md-2 reception-geneFun">
              <!-- style="margin-left:50px; -->
              <input type="text" class="form-control" id="search_id" placeholder="General ID or Fuchia ID">
            </div>
            <div class="col-md-2 reception-s-update-div ">
              <button class="btn  s-t-update update-batton" onclick="searchID()">Search to Update</button>
              <!-- *Remover class btn-warning -->
            </div>
            @foreach ($lastPt as $key => $value)
            <div class="col-md-3 reception-laID">
              <label class="form-control reception-laID-label"
                id="lastID"> Last ID ({{ $value->Pid }})

                <a class="reception-neID">Next ID</a> <a id="nextID"
                  onclick="idgiven()"
                  style="color:red;">{{ $value->Pid + 1 }}</a>
              </label>
            </div><br class="tablet">
            @endforeach
            <div class="col-sm-2">
              <select name=""
                id="online_follow"
                class="form-select">
                <option value="No">Online Reach</option>
                <option value="Prevent Yangon">Prevent Yangon</option>
                <option value="SHE">SHE</option>
                <option value="Helping Hand">Helping Hand</option>
                <option value="Other">Other</option>
              </select>

            </div>

          </div><br>

          <div class="row">

            <div class="col-md-1">
              <select class="form-control"
                id="he_code">
                <option value="0"
                  selected></option>
              </select>
            </div>
            <div class="col-md-2">
              <select class="form-control"
                id="clinic_code">
                <option value="71">HTY-A ( 71 )</option>
                <option value="72">HTY-B ( 72 )</option>
                <option value="81">HTY-C2 ( 81 )</option>
                <option value="73">SPT ( 73 )</option>
                <option value="74">TL ( 74 )</option>
                <option value="75">Winka ( 75 )</option>
                <option value="76">TBZY ( 76 )</option>
                <option value="77">PTO-DT ( 77 )</option>
                <option value="78">PTO-MCB ( 78 )</option>
                <option value="80">Hpakant ( 80 )</option>
                <option value="82">Taze ( 82 )</option>
                <option value="83">HTY-C1 ( 83 )</option>
                <option value="84">SDG ( 84 )</option>
                <option value="90">90</option>
                <option value="94">94</option>
              </select>

            </div>
            <div class="col-md-1">
              <select class="form-control"
                id="year_code">
                <option value="10">2010</option>
              </select>
            </div>
            <div class="col-md-2">
              <input type="number"
                id="pt_code"
                placeholder="Serial code input"
                class="form-control">
            </div>
            <div class="col-md-2">
              <input type="number"
                id="eyes_code"
                placeholder="Eye Scan Code"
                class="form-control">
            </div>
            <div class="col-md-1">
              <button onclick="peerCode()"
                class="code-combine"> Search</button>
            </div>
            <div class="col-sm-2">

              <select class="form-select reception-select"
                id="current_md"
                required="">
                <option value=""
                  selected
                  disabled>Current MD</option>
                <option value=""></option>
                <option value="TL">Team Leader MD</option>
                <option value="MD1">1</option>
                <option value="MD2">2</option>
                <option value="MD3">3</option>
                <option value="MD4">4</option>
                <option value="MD5">5</option>
                <option value="MD6">6</option>
                <option value="MD7">7</option>
                <option value="MD8">8</option>
                <option value="MD9">9</option>
                <option value="MD10">10</option>
                <option value="MD11">11</option>
                <option value="MD12">12</option>
                <option value="MD13">13</option>
                <option value="MD14">14</option>
                <option value="MD15">15</option>
                <option value="MD16">16</option>
                <option value="MD17">17</option>
                <option value="MD18">18</option>
                <option value="MD19">19</option>
                <option value="MD20">20</option>
                <option value="MD21">21</option>
                <option value="MD22">22</option>
                <option value="MD23">23</option>
                <option value="MD24">24</option>
                <option value="MD25">25</option>
                <option value="MD26">26</option>
                <option value="MD27">27</option>
                <option value="MD28">28</option>
                <option value="MD29">29</option>
                <option value="MD30">30</option>
                <option value="MD31">31</option>
                <option value="MD32">32</option>
                <option value="MD33">33</option>
                <option value="MD34">34</option>
                <option value="MD35">35</option>

                <option value="MDF1">MD-F1</option>
                <option value="MDF2">MD-F2</option>
                <option value="MDF3">MD-F3</option>
                <option value="MDF4">MD-F4</option>
                <option value="MDF5">MD-F5</option>

              </select>
            </div>

          </div>
          <div class="row">

            <div class="col-md-2 reception-code1">
              <label for="validationCustom01"
                class="form-label">General ID</label>
              <div class="input-group mb-3">
                <input type="number"
                  autofocus
                  id="gid"
                  class="form-control reception_id">

              </div>
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
              <label class="form-label">Register Date</label>
              <div class="date-holder">
                <input type="text"
                  id="register_date"
                  class="form-control Gdate date-verify reception-dateformat"
                  onchange="reg_date_change()"
                  placeholder="dd-mm-yyyy"
                  disabled>
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
                  class="form-control Gdate dob reception-dateformat"
                  placeholder="dd-mm-yyyy">
                <img src="../img/calendar3.svg"
                  class="dateimg"
                  alt="date">
              </div>
            </div>
            <div class="col-md-2">
              <label for="validationCustom02"
                class="form-label">Register Age</label>
              <input type="number"
                id="agey_register"
                class="form-control"
                onblur="reg_age_change()">
            </div>
            <div class="col-md-2">
              <label for="validationCustom02"
                class="form-label">Register Age(month)</label>
              <input type="number"
                id="agem_register"
                class="form-control">
            </div>
            <div class="col-md-2">
              <label for="validationCustom02"
                class="form-label">Current Age</label>
              <input type="number"
                id="agey"
                class="form-control">
              <div class="valid-feedback">
                plz put patient age.
              </div>
            </div>
            <div class="col-md-2">
              <label for="validationCustom02"
                class="form-label">Current Age(Month)</label>
              <input type="number"
                id="agem"
                onchange="monthValid()"
                class="form-control">
              <div class="valid-feedback">
                plz put patient age.
              </div>
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
                  value="Spouse of pregnant mother">Spouse of pregnant mother</option>
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
                  <option selected
                    disabled
                    value=""></option>
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
                  <option selected
                    disabled
                    value="">Choose...............</option>
                  <option id="tt_opt"></option>
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
            <div class="col-sm-2">
              <label for=""
                class="form-label">Quarter</label>
              <input type="text"
                name=""
                class="form-control"
                id="quarter">
            </div>
            <div class="col-md-2 reception-visitDate">
              <label class="form-label">Visit Date</label>
              <!-- <input type="date" onblur="dateOver(2)" id="vDate" class="form-control" required  > -->
              <div class="date-holder">
                <input type="text"
                  id="vDate"
                  class="form-control Gdate date-verify"
                  placeholder="dd-mm-yyyy">
                <img src="../img/calendar3.svg"
                  class="dateimg"
                  alt="date">
              </div>
            </div>
            <div class="col-md-2">
              <label class="form-label">Last Visit Date</label>
              <div class="date-holder">
                <input type="text"
                  id="reception_LastVDate"
                  class="form-control Gdate"
                  disabled
                  placeholder="dd-mm-yyyy">
                <img src="../img/calendar3.svg"
                  class="dateimg"
                  alt="date">
              </div>
            </div>

            <div class="col-md-2 reception-weight">
              <label class="form-label">Weight (kg)</label>
              <input id="weight"
                type="number"
                class="form-control"
                required>
            </div>
            <div class="col-md-2 reception-height">
              <label class="form-label">Height (cm)</label>
              <input id="heigth"
                class="form-control"
                required>
            </div>
            <div class="col-md-2 reception-muac">
              <label class="form-label">MUAC</label>
              <select class="form-control reception-select"
                id="muac"
                required>
                <option value=""></option>
                <option value="green">Green</option>
                <option value="red">Red</option>
                <option value="yellow">Yellow</option>
                <option value="orange">Orange</option>
              </select>
            </div>
            <div class="col-md-2">
              <label class="form-label">Print QR/Bar Code</label>
              <select class="form-control"
                id="qrcode_print">
                <option value="No">No</option>
                <option value="Yes">Yes</option>

              </select>

            </div>

            <div class="col-md-12"
              style="display: none"
              id="reception_remark_block">
              <label for=""
                class="form-label">Remark</label>
              <input type="text"
                id="reception_remark"
                class="form-control">
            </div>

          </div>

          <div class="row">
            <div class="col-sm-2 reception-re-fo">
              <button type="button"
                id="regbutton"
                onclick="send(this)"
                class="btn btn-primary reception-register"
                disabled>Register</button>
              <button type="button"
                id="followBton"
                onclick="send_fup(this)"
                class="btn btn-info reception-follow refresh-follow"
                disabled>Follow Up</button>
              <button type="button"
                id="updateBton"
                onclick="update_reg(this)"
                class="btn update-batton"
                disabled>Update</button>
            </div>
          </div>

        </div>

        <div class="tab-pane container containers fade"
          id="return">

          @csrf
          <div class="row justify-content-center">
            <ul class="next-md-list clearfix"
              id="next_md_list">

            </ul>
          </div><br>
          <div class="row">
            <div class="col-sm-4 clearfix">
              <p style="float:left;">Response :</p>
              <p style="float:left;"
                id="responseText"></p>
            </div>
          </div>
          <div class="row ">
            <!-- justify-content-center -->
            <div class="col-md-4 reception-code1 no-margin">
              <label for="validationCustom01"
                class="form-label">General ID OR Fuchia ID</label>
              <div class="input-group mb-3">
                <input type="number"
                  autofocus
                  id="gid_return"
                  class="form-control"
                  placeholder="General ID">
                <input type="text"
                  id="fid_return"
                  class="form-control"
                  placeholder="Fuchia ID">
                <div class="input-group-append no-margin">
                  <button class="btn btn-primary reception-serach "
                    onclick="ptData_return()"
                    type="button"
                    id="return-reception">Search</button>
                </div>
              </div>
            </div>
            <div class="col-sm-2 return-input no-margin">
              <label for="validationCustom01"
                class="form-label">Visit Date</label>
              <!-- <input id="fup_date" onblur="dateOver(3)" type="date"  class="form-control"> -->
              <div class="date-holder">
                <input type="text"
                  id="fup_date"
                  class="form-control Gdate date-verify"
                  placeholder="dd-mm-yyyy">
                <img src="../img/calendar3.svg"
                  class="dateimg"
                  alt="date">
              </div>
              <div class="valid-feedback">
                Plz put Patient's Issue Date.
              </div>
            </div>
            <div class="col-sm-2 return-input no-margin">
              <label for="validationCustom01"
                class="form-label">Next Appointment Date</label>
              <!-- <input id="nDate" type="date" value="" class="form-control"  > -->
              <div class="date-holder">
                <input type="text"
                  id="nDate"
                  class="form-control Gdate"
                  placeholder="dd-mm-yyyy"
                  onblur="find_next_md()">
                <img src="../img/calendar3.svg"
                  class="dateimg"
                  alt="date">
              </div>
            </div>

            <div class="col-sm-2">
              <label for="validationCustom01"
                class="form-label">Follow Up MD</label>
              <select class="form-select reception-select"
                id="follow_up_md"
                required="">
                <option value=""></option>
                <option value="TL">Team Leader MD</option>
                <option value="MD1">1</option>
                <option value="MD2">2</option>
                <option value="MD3">3</option>
                <option value="MD4">4</option>
                <option value="MD5">5</option>
                <option value="MD6">6</option>
                <option value="MD7">7</option>
                <option value="MD8">8</option>
                <option value="MD9">9</option>
                <option value="MD10">10</option>
                <option value="MD11">11</option>
                <option value="MD12">12</option>
                <option value="MD13">13</option>
                <option value="MD14">14</option>
                <option value="MD15">15</option>
                <option value="MD16">16</option>
                <option value="MD17">17</option>
                <option value="MD18">18</option>
                <option value="MD19">19</option>
                <option value="MD20">20</option>
                <option value="MD21">21</option>
                <option value="MD22">22</option>
                <option value="MD23">23</option>
                <option value="MD24">24</option>
                <option value="MD25">25</option>
                <option value="MD26">26</option>
                <option value="MD27">27</option>
                <option value="MD28">28</option>
                <option value="MD29">29</option>
                <option value="MD30">30</option>
                <option value="MD31">31</option>
                <option value="MD32">32</option>
                <option value="MD33">33</option>
                <option value="MD34">34</option>
                <option value="MD35">35</option>

                <option value="MDF1">MD-F1</option>
                <option value="MDF2">MD-F2</option>
                <option value="MDF3">MD-F3</option>
                <option value="MDF4">MD-F4</option>
                <option value="MDF5">MD-F5</option>

              </select>
            </div>

            <div id="resDiaSecton"
              class="clearfix resDiaBlock">

              <div class="pha_artbox">
                <ul class="clearfix"
                  id="pha_ul">
                  <li><input type="checkbox"
                      id="phacheck"
                      name=""><label>PHA</label></li>
                  <li><label class="form-label new-old">New/Old</label>
                    <select class="form-select reception-select"
                      id="pha_new_old"
                      required="">
                      <option value=""></option>
                      <option value="New">New</option>
                      <option value="Old">Old</option>
                    </select>
                  </li>
                  <li><label class="form-label">MAM Cohort</label>
                    <select class="form-select reception-select"
                      id="pha_cohort"
                      required="">
                      <option value=""></option>
                      <option value="Yes">Yes</option>
                      <option value="No">No</option>
                    </select>
                  </li>
                </ul>
                <ul class="clearfix"
                  id="art_ul">
                  <li><input type="checkbox"
                      id="artcheck"
                      name=""><label>ART</label></li>
                  <li><label class="form-label new-old">New/Old</label>
                    <select class="form-select reception-select"
                      id="art_new_old"
                      required="">
                      <option value=""></option>
                      <option value="New">New</option>
                      <option value="Old">Old</option>
                    </select>
                  </li>
                  <li><label class="form-label">MAM Cohort</label>
                    <select class="form-select reception-select"
                      id="art_cohort"
                      required="">
                      <option value=""></option>
                      <option value="Yes">Yes</option>
                      <option value="No">No</option>
                    </select>
                  </li>

                </ul>
              </div>
              <div class="prep_pmtctbox">
                <ul class="clearfix"
                  id="prep_ul">
                  <li><input type="checkbox"
                      id="prepcheck"
                      name=""><label>PrEP</label></li>
                  <li><label class="form-label new-old">New/Old</label>
                    <select class="form-select reception-select"
                      id="prep_new_old"
                      required="">
                      <option value=""></option>
                      <option value="New">New</option>
                      <option value="Old">Old</option>
                    </select>
                  </li>

                </ul>
                <ul class="clearfix"
                  id="pmtct_ul">
                  <li><input type="checkbox"
                      id="pmtctcheck"
                      name=""><label>PMTCT</label></li>
                  <li><label class="form-label new-old">New/Old</label>
                    <select class="form-select reception-select"
                      id="pmtct_new_old"
                      required="">
                      <option value=""></option>
                      <option value="New">New</option>
                      <option value="Old">Old</option>
                    </select>
                  </li>
                </ul>
              </div>
              <div class="anc_familybox">
                <ul class="clearfix"
                  id="anc_ul">
                  <li><input type="checkbox"
                      id="anccheck"
                      name=""><label>ANC</label></li>
                  <li><label class="form-label new-old">New/Old</label>
                    <select class="form-select reception-select"
                      id="anc_new_old"
                      required="">
                      <option value=""></option>
                      <option value="New">New</option>
                      <option value="Old">Old</option>
                    </select>
                  </li>
                </ul>
                <ul class="clearfix"
                  id="fmaily_ul">
                  <li><input type="checkbox"
                      id="fmaplancheck"
                      name=""><label>Family Planning</label></li>
                  <li><label class="form-label new-old">New/Old</label>
                    <select class="form-select reception-select"
                      id="famaplan_new_old"
                      required="">
                      <option value=""></option>
                      <option value="New">New</option>
                      <option value="Old">Old</option>
                    </select>
                  </li>
                </ul>
              </div>

              <div class="ncd_generalbox">
                <ul class="clearfix"
                  id="general_ul">
                  <li><input type="checkbox"
                      id="gneralcheck"
                      name=""><label>General</label></li>
                  <li><label class="form-label new-old">New/Old</label>
                    <select class="form-select reception-select"
                      id="general_new_old"
                      required="">
                      <option value=""></option>
                      <option value="New">New</option>
                      <option value="Old">Old</option>
                    </select>
                  </li>
                  <li><label class="form-label">Type of Diagnosis</label>
                    <select class="form-select reception-select"
                      id="general_diagnosis"
                      required="">
                      <option value=""></option>
                    </select>
                  </li>
                  <li><label class="form-label">OPD</label>
                    <select class="form-select reception-select"
                      id="OPD"
                      required="">
                      <option value="No"
                        selected>No</option>
                      <option value="Yes">Yes</option>
                    </select>
                  </li>

                </ul>
                <ul class="clearfix"
                  id="ncd_ul">
                  <li><input type="checkbox"
                      id="ncdcheck"
                      name=""><label>NCD</label></li>
                  <li><label class="form-label new-old">New/Old</label>
                    <select class="form-select reception-select"
                      id="ncd_new_old"
                      required="">
                      <option value=""></option>
                      <option value="New">New</option>
                      <option value="Old">Old</option>
                    </select>
                  </li>
                  <li><label class="form-label">Type of Diagnosis</label>
                    <select class="form-select reception-select"
                      id="ncd_diagnosis"
                      required="">
                      <option value=""></option>
                    </select>
                  </li>
                  <li><label class="form-label">Drug Supply By MAM</label>
                    <select class="form-select reception-select"
                      id="ncd_drugSupply"
                      required="">
                      <option value=""></option>
                      <option value="Yes">Yes</option>
                      <option value="No">No</option>
                    </select>
                  </li>

                </ul>
                <ul class="clearfix"
                  id="hivTB_ul">
                  <li><input type="checkbox"
                      id="hivTBcheck"
                      name=""><label>HIV(-)TB</label></li>
                  <li><label class="form-label new-old">New/Old</label>
                    <select class="form-select reception-select"
                      id="hivTB_new_old"
                      required="">
                      <option value=""></option>
                      <option value="New">New</option>
                      <option value="Old">Old</option>
                    </select>
                  </li>
                </ul>

              </div>
              <div class="feed_labInvestbox">
                <ul class="clearfix"
                  id="feed_ul">
                  <li><input type="checkbox"
                      id="fcentercheck"
                      name=""><label>Feeding Centre</label></li>
                  <li><label class="form-label new-old">New/Old</label>
                    <select class="form-select reception-select"
                      id="feedcentre_new_old"
                      required="">
                      <option value=""></option>
                      <option value="New">New</option>
                      <option value="Old">Old</option>
                    </select>
                  </li>
                </ul>
                <ul class="clearfix"
                  id="lab_Invest_ul">
                  <li><input type="checkbox"
                      id="labInvestcheck"
                      name=""><label>Lab Investigation Only</label></li>
                  <li><label class="form-label new-old">New/Old</label>
                    <select class="form-select reception-select"
                      id="labInvest_new_old"
                      required="">
                      <option value=""></option>
                      <option value="New">New</option>
                      <option value="Old">Old</option>
                    </select>
                  </li>
                </ul>

              </div>

            </div>

            <div class="row">
              <div class="col-sm-2 refer-block">
                <label class="form-label">Refer to Fever Team</label>
                <select class="form-select reception-select"
                  id="refer_fever"
                  required="">
                  <option value="No">No</option>
                  <option value="Yes">Yes</option>

                </select>
              </div>
              <div class="col-sm-2">
                <label class="form-label">Mpox suspected</label>
                <select class="form-select reception-select"
                  id="mpox_yes_no"
                  required="">
                  <option value=""></option>
                  <option value="No">No</option>
                  <option value="Yes">Yes</option>
                </select>
              </div>
              <div class="col-sm-2">
                <label class="form-label">Mpox suspected Rash</label>
                <select class="form-select reception-select"
                  id="mpox_rash_yes_no"
                  required="" disabled>
                  <option value=""> </option>
                  <option value="No">No</option>
                  <option value="Yes">Yes</option>
                </select>
              </div>
              <div class="col-sm-6">
                <label class="form-label">Further Mx</label>
                <select class="form-select reception-select"
                  id="mpox_fur_mx"
                  required="" disabled>
                  <option value=""> </option>
                  <option value="1.Treated at MAM">1.Treated at MAM</option>
                  <option value="2.Referred to other center">2.Referred to other center</option>
                </select>

              </div>
              <div class="col-sm-1 return-save">
                <button type="button"
                  id="updateBton"
                  onclick="save(this)"
                  class="btn btn-warning  update-batton">Save</button>
              </div>
            </div>
          </div>
        </div>

        <div class="tab-pane container containers fade"
          id="next">
          @csrf
          <div>
            <div>
              <h2 class="header-text">Next Appointment Lists</h2>
            </div>
          </div><br>

          <div class="row reception-appointmentInfo ">
            <div class="col-sm-4 appointment-date">
              <label for="validationCustom01"
                class="form-label appointment-label">Next Appointment Date</label>
              <!-- <input id="ndate" type="date" autofocus class="form-control" id="validationCustom01"> -->

              <div class="date-holder">
                <input type="text"
                  id="nextSerachDate"
                  class="form-control Gdate"
                  placeholder="dd-mm-yyyy">
                <img src="../img/calendar3.svg"
                  class="dateimg"
                  alt="date">
              </div>

            </div>
            <div class="col-sm-3 appointemt-search">
              <label for="validationCustom01"
                class="form-label">Type</label>
              <select class="form-control reception-select"
                id="visit_type"
                required>
                <option selected
                  disabled
                  value="">Choose....................</option>
                <option value="All">All</option>
                <option value="PHA">PHA</option>
                <option value="ART">ART</option>
                <option value="PrEP">PrEP</option>
                <option value="ANC">ANC</option>
                <option value="NCD">NCD</option>
                <option value="hivtb">HIV(-)TB</option>
                <option value="FC">Feeding Centre</option>
                <option value="General">General</option>
                <option value="PMTCT">PMTCT</option>
                <option value="lab_iv_only"> Lab Investigation Only</option>
              </select>

            </div>
            <div class="col-sm-1 next-serachBatton">
              <button type="button"
                id="updateBton"
                onclick="search_nextAppointment()"
                class="btn btn-primary appointment-serach reception-select">Search</button>
            </div>
          </div>
          <div class="row justify-content-center appointment-table">
            <h4 id='total_len'></h4>
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>Serial</th>
                  <th>General ID</th>
                  <th>Fuchia ID</th>
                  <th>PrEP ID</th>
                  <th>Next Appointment Date</th>
                </tr>
              </thead>
              <tbody id='list'>
              </tbody>
            </table>
          </div>

        </div>

        <div class="tab-pane container containers fade"
          id="follow">
          <div class="page-color">
            <div>

              <h2 class="header-text">Test History Of the Patient</h2>

            </div>
            <div class="row reception-followSection"
              style="margin:auto;">
              <div class="col-md-3">
                <input id="id_hist"
                  type="text"
                  autofocus
                  class="form-control"
                  placeholder="Patient's ID"
                  required>
                <div class="valid-feedback">
                  Plz put Patient's ID.
                </div>
              </div>
              <div class="col-md-3">
                <button type="button"
                  onclick="followupHistory()"
                  class="btn btn-primary btn-lg btn-searchFollowup">Search Follow up History</button>
              </div>
            </div>
            <br>
            <div class="row "
              style="margin:auto;">
              <div class="mobile"
                id="followupHistory-mobile"></div>
              <div class="tablet"
                id="followupHistory-tablet">
              </div>
              <div class="col-md-12 pc">
                <table class="table table-hover table-bordered">
                  <thead>
                    <tr class="follow-table">
                      <th>No.</th>
                      <th>Visit Date</th>
                      <th>General ID</th>
                      <th>Fuchia ID</th>
                      <th>PrEPCode</th>
                      <th>Age</th>
                      <th>Sex</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody id="followupHistory"
                    calss="tablet-pc">
                </table>
              </div>
            </div>
          </div>

          <div id="updatePageView"
            class="container containers"
            style="display:none">
            <!-- *adding containers clss -->
            <div style="margin:auto"
              id="toshowResult"></div>
            <div class="container containers page-color">
              <!-- *adding containers clss -->
              <br>
              <!--   <form class="" id="reg" method="post" > -->

              <div class="row justify-content-center">
                <div class="col-md-12 ">
                  <h2 class="header-text">Follow Up Update Page</h2>
                </div>
              </div><br>
              <div class="row">
                <div class="col-sm-4 clearfix">
                  <p style="float:left;">Response :</p>
                  <p style="float:left;"
                    id="responseText"></p>
                </div>
              </div>
              <div class="row">

                <div class="col-sm-2 reception-code1">
                  <label for="validationCustom01"
                    class="form-label">General ID</label>
                  <div class="input-group mb-3">
                    <input type="number"
                      autofocus
                      id="gid_toupdate"
                      class="form-control">

                    <div class="input-group-append no-margin">
                      <button class="btn btn-primary reception-serach"
                        type="button">Search</button>
                    </div>
                  </div>
                </div>
                <div class="col-sm-2 reception-code2">
                  <label for="validationCustom01"
                    class="form-label">Fuchia ID</label>
                  <div class="input-group mb-3">
                    <input type="text"
                      id="fid_toupdate"
                      class="form-control">
                    <div class="input-group-append no-margin">
                      <button class="btn btn-primary reception-serach"
                        type="button">Search</button>
                    </div>
                  </div>
                </div>
                <div class="col-md-2 receptionFollow-pfn">
                  <label class="form-label">PrEP Code</label>
                  <input type="text"
                    id="prepCode_toupdate"
                    placeholder='Pr/049/B0000/23'
                    class="form-control"
                    required>
                </div> <br class="tablet">
                <div class="col-md-2 receptionFollow-visitDate">
                  <label class="form-label">Visit Date</label>
                  <!-- <input type="date" onblur="dateOver(4)" id="vDate_toupdate" class="form-control" required  > -->
                  <div class="date-holder">
                    <input type="text"
                      id="vDate_toupdate"
                      class="form-control Gdate date-verify"
                      placeholder="dd-mm-yyyy">
                    <img src="../img/calendar3.svg"
                      class="dateimg"
                      alt="date">
                  </div>
                </div>
                <div class="col-md-2 receptionFollow-gender">
                  <label class="form-label">Sex</label>
                  <select class="form-select reception-select"
                    id="gender_toupdate"
                    required>
                    <option value=""></option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                  </select>
                </div>
                <div class="col-md-1 receptionFollow-ageYear">
                  <label for="validationCustom02"
                    class="form-label">Age(Year)</label>
                  <input type="number"
                    id="agey_toupdate"
                    class="form-control">
                  <div class="valid-feedback">
                    plz put patient age.
                  </div>
                </div>
                <div class="col-md-1 receptionFollow-ageMonth">
                  <label for="validationCustom02"
                    class="form-label">Age(Month)</label>
                  <input type="number"
                    id="agem_toupdate"
                    class="form-control">
                  <div class="valid-feedback">
                    plz put patient age.
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-3">
                  <label class="form-label">Refer to Fever Team</label>
                  <select class="form-select reception-select"
                    id="refer_feverupdate"
                    required="">
                    <option value=""></option>
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                  </select>
                </div>

                <div class="col-sm-2 return-input ">
                  <label for="validationCustom01"
                    class="form-label">Next Appointment Date</label>
                  <!-- <input id="nDate_toupdate" type="date" value="" class="form-control"  > -->
                  <div class="date-holder">
                    <input type="text"
                      id="nDate_toupdate"
                      class="form-control Gdate"
                      placeholder="dd-mm-yyyy">
                    <img src="../img/calendar3.svg"
                      class="dateimg"
                      alt="date">
                  </div>
                </div>
                <div class="col-sm-2 ">
                  <label for="validationCustom01"
                    class="form-label">Follow Up MD</label>
                  <select class="form-select reception-select"
                    id="follow_up_md_toupdate"
                    required="">
                    <option value=""></option>
                    <option value="TL">Team Leader MD</option>
                    <option value="MD1">1</option>
                    <option value="MD2">2</option>
                    <option value="MD3">3</option>
                    <option value="MD4">4</option>
                    <option value="MD5">5</option>
                    <option value="MD6">6</option>
                    <option value="MD7">7</option>
                    <option value="MD8">8</option>
                    <option value="MD9">9</option>
                    <option value="MD10">10</option>
                    <option value="MD11">11</option>
                    <option value="MD12">12</option>
                    <option value="MD13">13</option>
                    <option value="MD14">14</option>
                    <option value="MD15">15</option>
                    <option value="MD16">16</option>
                    <option value="MD17">17</option>
                    <option value="MD18">18</option>
                    <option value="MD19">19</option>
                    <option value="MD20">20</option>
                    <option value="MD21">21</option>
                    <option value="MD22">22</option>
                    <option value="MD23">23</option>
                    <option value="MD24">24</option>
                    <option value="MD25">25</option>
                    <option value="MD26">26</option>
                    <option value="MD27">27</option>
                    <option value="MD28">28</option>
                    <option value="MD29">29</option>
                    <option value="MD30">30</option>
                    <option value="MD31">31</option>
                    <option value="MD32">32</option>
                    <option value="MD33">33</option>
                    <option value="MD34">34</option>
                    <option value="MD35">35</option>

                    <option value="MDF1">MD-F1</option>
                    <option value="MDF2">MD-F2</option>
                    <option value="MDF3">MD-F3</option>
                    <option value="MDF4">MD-F4</option>
                    <option value="MDF5">MD-F5</option>

                  </select>
                </div>
                <div class="col-sm-2">
                  <select name=""
                    id="online_followupdate"
                    class="form-select"
                    style="margin-top:35px">
                    <option value="No">Online Reach</option>
                    <option value="Prevent Yangon">Prevent Yangon</option>
                    <option value="SHE">SHE</option>
                    <option value="Helping Hand">Helping Hand</option>
                    <option value="Other">Other</option>
                  </select>
                </div>
              </div>
              <div id="resDiaSecton2"
                class="clearfix resDiaBlock">
                <div class="pha_artbox">
                  <ul class="clearfix"
                    id="pha_ulupdate">
                    <li><input type="checkbox"
                        id="phacheckupdate"
                        name=""><label>PHA</label></li>
                    <li><label class="form-label new-old">New/Old</label>
                      <select class="form-select reception-select"
                        id="pha_new_oldupdate"
                        required="">
                        <option value=""></option>
                        <option value="New">New</option>
                        <option value="Old">Old</option>
                      </select>
                    </li>
                    <li><label class="form-label">MAM Cohort</label>
                      <select class="form-select reception-select"
                        id="pha_cohortupdate"
                        required="">
                        <option value=""></option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                      </select>
                    </li>
                  </ul>
                  <ul class="clearfix"
                    id="art_ul_update">
                    <li><input type="checkbox"
                        id="artcheckupdate"
                        name=""><label>ART</label></li>
                    <li><label class="form-label new-old">New/Old</label>
                      <select class="form-select reception-select"
                        id="art_new_oldupdate"
                        required="">
                        <option value=""></option>
                        <option value="New">New</option>
                        <option value="Old">Old</option>
                      </select>
                    </li>
                    <li><label class="form-label">MAM Cohort</label>
                      <select class="form-select reception-select"
                        id="art_cohortupdate"
                        required="">
                        <option value=""></option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                      </select>
                    </li>

                  </ul>
                </div>
                <div class="prep_pmtctbox">
                  <ul class="clearfix"
                    id="prep_ulupdate">
                    <li><input type="checkbox"
                        id="prepcheckupdate"
                        name=""><label>PrEP</label></li>
                    <li><label class="form-label new-old">New/Old</label>
                      <select class="form-select reception-select"
                        id="prep_new_oldupdate"
                        required="">
                        <option value=""></option>
                        <option value="New">New</option>
                        <option value="Old">Old</option>
                      </select>
                    </li>

                  </ul>
                  <ul class="clearfix"
                    id="pmtct_ul">
                    <li><input type="checkbox"
                        id="pmtctcheckupdate"
                        name=""><label>PMTCT</label></li>
                    <li><label class="form-label new-old">New/Old</label>
                      <select class="form-select reception-select"
                        id="pmtct_new_oldupdate"
                        required="">
                        <option value=""></option>
                        <option value="New">New</option>
                        <option value="Old">Old</option>
                      </select>
                    </li>
                  </ul>
                </div>
                <div class="anc_familybox">
                  <ul class="clearfix"
                    id="anc_ulupdate">
                    <li><input type="checkbox"
                        id="anccheckupdate"
                        name=""><label>ANC</label></li>
                    <li><label class="form-label new-old">New/Old</label>
                      <select class="form-select reception-select"
                        id="anc_new_oldupdate"
                        required="">
                        <option value=""></option>
                        <option value="New">New</option>
                        <option value="Old">Old</option>
                      </select>
                    </li>
                  </ul>
                  <ul class="clearfix"
                    id="fmaily_ulupdate">
                    <li><input type="checkbox"
                        id="fmaplancheckupdate"
                        name=""><label>Family Planning</label></li>
                    <li><label class="form-label new-old">New/Old</label>
                      <select class="form-select reception-select"
                        id="famaplan_new_oldupdate"
                        required="">
                        <option value=""></option>
                        <option value="New">New</option>
                        <option value="Old">Old</option>
                      </select>
                    </li>
                  </ul>
                </div>

                <div class="ncd_generalbox">
                  <ul class="clearfix"
                    id="general_ulupdate">
                    <li><input type="checkbox"
                        id="gneralcheckupdate"
                        name=""><label>General</label></li>
                    <li><label class="form-label new-old">New/Old</label>
                      <select class="form-select reception-select"
                        id="general_new_oldupdate"
                        required="">
                        <option value=""></option>
                        <option value="New">New</option>
                        <option value="Old">Old</option>
                      </select>
                    </li>
                    <li><label class="form-label">Type of Diagnosis</label>
                      <select class="form-select reception-select"
                        id="general_diagnosisupdate"
                        required="">
                        <option value=""></option>
                      </select>
                    </li>
                    <li><label class="form-label">OPD</label>
                      <select class="form-select reception-select"
                        id="OPDupdate"
                        required="">
                        <option value="No">No</option>
                        <option value="Yes">Yes</option>
                      </select>
                    </li>

                  </ul>
                  <ul class="clearfix"
                    id="ncd_ulupdate">
                    <li><input type="checkbox"
                        id="ncdcheckupdate"
                        name=""><label>NCD</label></li>
                    <li><label class="form-label new-old">New/Old</label>
                      <select class="form-select reception-select"
                        id="ncd_new_oldupdate"
                        required="">
                        <option value=""></option>
                        <option value="New">New</option>
                        <option value="Old">Old</option>
                      </select>
                    </li>
                    <li><label class="form-label">Type of Diagnosis</label>
                      <select class="form-select reception-select"
                        id="ncd_diagnosisupdate"
                        required="">
                        <option value=""></option>
                      </select>
                    </li>
                    <li><label class="form-label">Drug Supply By MAM</label>
                      <select class="form-select reception-select"
                        id="ncd_drugSupplyupdate"
                        required="">
                        <option value=""></option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                      </select>
                    </li>

                  </ul>
                  <ul class="clearfix"
                    id="hivTB_ulupdate">
                    <li><input type="checkbox"
                        id="hivTBcheckupdate"
                        name=""><label>HIV(-)TB</label></li>
                    <li><label class="form-label new-old">New/Old</label>
                      <select class="form-select reception-select"
                        id="hivTB_new_oldupdate"
                        required="">
                        <option value=""></option>
                        <option value="New">New</option>
                        <option value="Old">Old</option>
                      </select>
                    </li>
                  </ul>

                </div>
                <div class="feed_labInvestbox">
                  <ul class="clearfix"
                    id="feed_ulupdate">
                    <li><input type="checkbox"
                        id="fcentercheckupdate"
                        name=""><label>Feeding Centre</label></li>
                    <li><label class="form-label new-old">New/Old</label>
                      <select class="form-select reception-select"
                        id="feedcentre_new_oldupdate"
                        required="">
                        <option value=""></option>
                        <option value="New">New</option>
                        <option value="Old">Old</option>
                      </select>
                    </li>
                  </ul>
                  <ul class="clearfix"
                    id="lab_Invest_ulupdate">
                    <li><input type="checkbox"
                        id="labInvestcheckupdate"
                        name=""><label>Lab Investigation Only</label>
                    </li>
                    <li><label class="form-label new-old">New/Old</label>
                      <select class="form-select reception-select"
                        id="labInvest_new_oldupdate"
                        required="">
                        <option value=""></option>
                        <option value="New">New</option>
                        <option value="Old">Old</option>
                      </select>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="row">
                <div class="col-md-2 reception-weight">
                  <label class="form-label">Weight</label>
                  <input id="weight_update"
                    type="number"
                    class="form-control"
                    required>
                </div>
                <div class="col-md-2 reception-height">
                  <label class="form-label">Height</label>
                  <input id="heigth_update"
                    class="form-control"
                    required>
                </div>
                <div class="col-md-2 reception-muac">
                  <label class="form-label">MUAC</label>
                  <select class="form-control reception-select"
                    id="muac_update"
                    required>
                    <option value=""></option>
                    <option value="green">Green</option>
                    <option value="red">Red</option>
                    <option value="yellow">Yellow</option>
                    <option value="orange">Orange</option>
                  </select>
                </div>
                <div class="col-sm-2">
                  <label for="validationCustom01"
                    class="form-label">Current MD</label>
                  <select class="form-select reception-select"
                    id="current_md_update"
                    required="">
                    <option value=""></option>
                    <option value="TL">Team Leader MD</option>
                    <option value="MD1">1</option>
                    <option value="MD2">2</option>
                    <option value="MD3">3</option>
                    <option value="MD4">4</option>
                    <option value="MD5">5</option>
                    <option value="MD6">6</option>
                    <option value="MD7">7</option>
                    <option value="MD8">8</option>
                    <option value="MD9">9</option>
                    <option value="MD10">10</option>
                    <option value="MD11">11</option>
                    <option value="MD12">12</option>
                    <option value="MD13">13</option>
                    <option value="MD14">14</option>
                    <option value="MD15">15</option>
                    <option value="MD16">16</option>
                    <option value="MD17">17</option>
                    <option value="MD18">18</option>
                    <option value="MD19">19</option>
                    <option value="MD20">20</option>
                    <option value="MD21">21</option>
                    <option value="MD22">22</option>
                    <option value="MD23">23</option>
                    <option value="MD24">24</option>
                    <option value="MD25">25</option>
                    <option value="MD26">26</option>
                    <option value="MD27">27</option>
                    <option value="MD28">28</option>
                    <option value="MD29">29</option>
                    <option value="MD30">30</option>
                    <option value="MD31">31</option>
                    <option value="MD32">32</option>
                    <option value="MD33">33</option>
                    <option value="MD34">34</option>
                    <option value="MD35">35</option>

                    <option value="MDF1">MD-F1</option>
                    <option value="MDF2">MD-F2</option>
                    <option value="MDF3">MD-F3</option>
                    <option value="MDF4">MD-F4</option>
                    <option value="MDF5">MD-F5</option>

                  </select>
                </div>
                <div class="col-md-4">
                  <label for=""
                    class="form-label">Remark</label>
                  <input type="text"
                    id="remark_update"
                    class="form-control">
                </div>
                <div class="col-sm-2">
                  <label class="form-label">Mpox suspected</label>
                  <select class="form-select reception-select"
                    id="mpox_yes_no_update"
                    required="" onchange="mox_update()">
                    <option value=""></option>
                    <option value="No">No</option>
                    <option value="Yes">Yes</option>
                  </select>
                </div>
                <div class="col-sm-2">
                  <label class="form-label">Mpox suspected Rash</label>
                  <select class="form-select reception-select"
                    id="mpox_rash_yes_no_update"
                    required="" disabled>
                    <option value=""> </option>
                    <option value="No">No</option>
                    <option value="Yes">Yes</option>
                  </select>
                </div>
                <div class="col-sm-8">
                  <label class="form-label">Further Mx</label>

                  <select class="form-select reception-select"
                    id="mpox_fur_mx_update"
                    required="" disabled>
                    <option value=""> </option>
                    <option value="1.Treated at MAM">1.Treated at MAM</option>
                    <option value="2.Referred to other center">2.Referred to other center</option>
                  </select>
                </div>

              </div>
              <div class="row">
                <div class="col-sm-2 reception-re-fo">
                  <button type="button"
                    id="updateBton"
                    onclick="update(this)"
                    class="btn update-batton">Update</button>
                </div>
              </div>
              <br>

            </div>

          </div>
        </div>

        <div class="tab-pane container containers fade"
          id="search_name">
          <div class="row">
            <div class="col-sm-2">
              <label for=""
                class="form-laber">Select Year</label>
              <select name=""
                class="form-select"
                onchange="SeachByName()"
                id="name_serach_year">
                <option value=""></option>
                <option value="10">2010</option>
              </select>

            </div>
            <div class="col-sm-4">
              <input type="text"
                id="search_input_name"
                class="form-control search-input-name"
                placeholder="Type name Correctly"
                onchange="Find_name()">
            </div>
          </div>
          <div id="show_name_result"
            class="show-name-result">
            <table class="table table-hover table-bordered">
              <thead>
                <tr>
                  <td>General ID</td>
                  <td>Fuchia ID</td>
                  <td>Name</td>
                  <td>Father Name</td>
                  <td>Register Age</td>
                  <td>Register Date</td>
                </tr>
              </thead>
              <tbody>

              </tbody>
            </table>
          </div>

        </div>

        <div class="tab-pane container containers fade"
          id="export">
          <form action="{{ route('reception_export') }}"
            method="POST"
            enctype="multipart/form-data">
            @csrf
            <br>
            <div class="row justify-content-center">
              <h1>Export</h1>
            </div><br>
            <div class="row justify-content-center">
              <div class="col-md-2">
                <label for="">From(dd-mm-yyyy)</label>
                <!-- <input type="date" class="form-control" id="ddFrom" name="Datefrom" value=""> -->
                <div class="date-holder">
                  <input type="text"
                    id="ddFrom"
                    class="form-control Gdate"
                    name="Datefrom"
                    placeholder="dd-mm-yyyy">
                  <img src="../img/calendar3.svg"
                    class="dateimg"
                    alt="date">
                </div>
              </div>

              <div class="col-md-2">
                <label for="">To(dd-mm-yyyy)</label>
                <!-- <input  type="date" class="form-control" id="ddTo" name="Dateto" value=""> -->
                <div class="date-holder">
                  <input type="text"
                    id="ddTo"
                    class="form-control Gdate"
                    name="Dateto"
                    placeholder="dd-mm-yyyy">
                  <img src="../img/calendar3.svg"
                    class="dateimg"
                    alt="date">
                </div>
              </div>
              <div class="col-sm-3">
                <button class="btn btn-dark rec-exportbtn">Follow Up Data Export</button>
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
            <br>
          </form>
        </div>
        <div class="tab-pane container containers fade"
          id="recepint_PtList">
          <h2 class="header-text">Consulation Records</h2>
          <div class="rec-patient-list ">
            <div class="row">
              <div class="col-sm-2">
                <label for=""
                  class="form-label">Search type</label>
                <select name=""
                  class="form-select"
                  id="find_reception_type"
                  onchange="show_consultation_record()">
                  <option value=""></option>
                  <option value="PrepCode">Prep</option>
                </select>
              </div>
              <div class="col-sm-2">
                <label for=""
                  class="form-laber">From Date</label>
                <div class="date-holder">
                  <input type="text"
                    id="rec_show_date"
                    class="form-control Gdate date-verify"
                    placeholder="dd-mm-yyyy">
                  <img src="../img/calendar3.svg"
                    class="dateimg"
                    alt="date">
                </div>
              </div>
              <div class="col-sm-2">
                <label for=""
                  class="form-laber">To Date</label>
                <div class="date-holder">
                  <input type="text"
                    id="rec_date_To"
                    class="form-control Gdate date-verify"
                    placeholder="dd-mm-yyyy">
                  <img src="../img/calendar3.svg"
                    class="dateimg"
                    alt="date">
                </div>
              </div>
              <div class="col-sm-2">
                <button class="btn btn-info"
                  onclick="showPatientList()"
                  style="margin-top: 35px">Show Patient
                  List</button>
              </div>
              <div class="col-sm-2">
                <label for=""
                  class="form-label"
                  id="reception_find_noti"></label>
              </div>
            </div>
            <table class="table  table-bordered">
              <thead>
                <tr>
                  <td>General ID</td>
                  <td>Fuchia ID</td>
                  <td>Prep New/Old</td>
                  <td>Name</td>
                  <td>Gender</td>
                  <td>Risk</td>
                  <td>Next Appointment Date</td>
                </tr>
              </thead>
              <tbody>

              </tbody>
            </table>

          </div>
        </div>

        <div class="tab-pane container containers fade"
          id="recepint_PtList2">
          <h2 class="header-text">Patient List</h2>
          <div class="rec-patient-list2 ">
            <div class="row">
              <div class="col-sm-2">
                <label for=""
                  class="form-laber">Find Date</label>
                <div class="date-holder">
                  <input type="text"
                    id="rec_show_date2"
                    class="form-control Gdate date-verify"
                    placeholder="dd-mm-yyyy">
                  <img src="../img/calendar3.svg"
                    class="dateimg"
                    alt="date">
                </div>
              </div>
              <div class="col-sm-2">
                <button class="btn btn-info"
                  onclick="showPatientList2(this)"
                  style="margin-top: 35px">Show
                  Patient
                  List</button>
              </div>
            </div>
            <div class="row no-margin rec-patient-header">
              <div class="col-sm-1 no-margin">NO.</div>
              <div class="col-sm-2 no-margin">General ID</div>
              <div class="col-sm-2 no-margin">Fuchia ID</div>
              <div class="col-sm-2 no-margin">Name</div>
              <div class="col-sm-2 no-margin">Father's Name</div>
              <div class="col-sm-1 no-margin">Sex</div>
              <div class="col-sm-1 no-margin">Register Age</div>
              <div class="col-sm-1 no-margin">Register Month</div>
            </div>

          </div>
        </div>
        <div class="tab-pane container containers fade"
          id="qrexport">
          <div class="row">
            <div class="col-sm-2">
              <label for=""
                class="form-lable">GeneralID</label>
              <input type="number"
                name="generalID"
                id="qr_Pid"
                class="form-control">
            </div>
            <div class="col-sm-2">
              <button class="btn  s-t-update update-batton"
                style="margin-top:33px"
                onclick="qrExport(this)">Print QR</button>

            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

  <section id="print-section">
    <div class="row">
      <div class="col-sm-4">
        <label for="" class="form-label qr-label"></label>
        <div class="qr-code"></div>
      </div>
      <div class="col-sm-4">
        <label for="" class="form-label qr-label"></label>
        <div class="qr-code"></div>
      </div>
      <div class="col-sm-4">
        <label for="" class="form-label qr-label"></label>
        <div class="qr-code"></div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-4">
        <label for="" class="form-label qr-label"></label>
        <div class="qr-code"></div>
      </div>
      <div class="col-sm-4">
        <label for="" class="form-label qr-label"></label>
        <div class="qr-code"></div>
      </div>
      <div class="col-sm-4">
        <label for="" class="form-label qr-label"></label>
        <div class="qr-code"></div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12" style="justify-content: center;">
        <label for="" class="form-label qr-label"></label>
        <div class="qr-code"></div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12" style="justify-content: center;">
        <label for="" class="form-label qr-label"></label>
        <div class="qr-code"></div>
      </div>
    </div>


  </section>

</body>
@endsection
@endauth
<script type="text/javascript"
  language="javascript">
  let generatedID = 0;
  let text = 0;
  let ptID = 0;
  let rowNumber = 0;
  let generatedID1 = 0;
  let genID = [];
  let ddDate = 0;
  let age;
  let updateCheck, preCode = 0; // general and ncd select box determination update or simple click
  let serch_name_result; // to find by name
  let consultation_record; // for consultation_records;
  var diagnosis = [
    "1.RTI(<2wks)", "2.RTI(≥2 wks)", "3. Obstructive pul. D/s", "4. NCD/Cerebro-vascular diseases (CVD)", "5.Renal D/s", "6.GI & Hepatobiliary", "7.Gynaecology", "8.Musculoskeleton and rheumatology", "9.Skin Infection", "10.Covid related consultation", "11.TB related consultation", "12.Sexual violence", "13.STI", "14.Others",
  ];
  var diagnosis_value = [
    "RTI<2wks", "RTI>=2", "ObstructiveDs", "NCD-CVD", "RenalDs", "GI-Hepato", "Gynaecology", "Musculo-rheumatology", "SkinInfect", "Covid-consul", "TB-consul", "Sexual-viol", "STI", "Others",
  ];
  var diagnosisUn15 = [
    "1.RTI(<2wks)", "2.RTI(≥2 wks)", "3. Obstructive pul. D/s", "4.Dengue Fever", "5.Renal D/s", "6.GI & Hepatobiliary", "7.Malnourished", "8.Child Abuse", "9.Skin Infection", "10.Covid related consultation", "11.TB related consultation", "12.Others",

  ];
  var diagnosis_valueUn15 = [
    "RTI<2wks", "RTI>=2", "ObstructiveDs", "Dengue-Fever", "RenalDs", "GI-Hepato", "Malnouri", "Child-Abuse", "SkinInfect", "Covid-consul", "TB-consul", "Others",
  ];

  function showPatientList() {
    if ($("#rec_show_date").val() == "") {
      var rec_show_findDate = formatDate(todayIn);
    } else {
      var rec_show_findDate = formatDate($("#rec_show_date").val());
    }
    if ($("#rec_show_date").val() == "") {
      var rec_show_To = formatDate(todayIn);
    } else {
      var rec_show_To = formatDate($("#rec_date_To").val());
    }
    var differenceInMilliseconds = Math.abs(new Date(rec_show_findDate) - new Date(rec_show_To));

    // Convert milliseconds to days
    var differenceInDays = differenceInMilliseconds / (1000 * 60 * 60 * 24);

    var ckdata = {
      notice: "Find Patient List",
      rec_show_findDate: rec_show_findDate, //from
      rec_show_To: rec_show_To //to
    }
    console.log(ckdata);
    if (differenceInDays < 11 && new Date(rec_show_findDate) <= new Date(rec_show_To)) {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        }
      });
      $.ajax({
        type: 'POST',
        url: "{{ route('reception_road') }}",
        dataType: 'json',
        contentType: 'application/json',
        data: JSON.stringify(ckdata),
        success: function(response) {
          console.log(response);
          consultation_record = response;
          show_consultation_record();


        }
      })
    } else {
      alert("Wrong Formatted or exceed 10 day");
      $("#rec_show_date,#rec_date_To").val("");
    }



  }

  function mox_update() {
    if ($("#mpox_yes_no_update").val() == "Yes") {
      $("#mpox_rash_yes_no_update,#mpox_fur_mx_update").prop("disabled", false);
    } else {
      $("#mpox_rash_yes_no_update").prop("disabled", true).val("");
      $("#mpox_fur_mx_update").prop("disabled", true).val("");
    }
  }

  function qrExport(button) {
    let changeQR = {
      Pid: $("#qr_Pid").val(),
      notice: "Change to QR",
    }
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
      }
    });
    $.ajax({
      type: 'POST',
      url: "{{ route('reception_road') }}",
      dataType: 'json',
      contentType: 'application/json',
      data: JSON.stringify(changeQR),
      beforeSend: function() {
        $(button).prop("disabled", true);
        timeoutHandle = setTimeout(oneClick, 3000);
      },
      success: function(response) {
        $(button).prop("disabled", false);
        clearTimeout(timeoutHandle);
        // alert("You add from "+(Number(stillID)+1)+" to "+(Number(stillID)+Number(preCount)));
        // history.go(0);

        console.log(response);
        if (response == "No ID") {
          alert("ဤ ID သည် Confidential အချက်အလက်များမရှိပါ၊၊ Reception တွင် စရင်းသွင်းပးပါ၊၊");
        } else {
          $('.qr-code').html(response.barcode2DHtml);
          $(".container").hide();
          $("#print-section").show();
          window.print();
          $("#print-section").hide();
          location.reload(true);
        }

      }
    })
  }

  function showPatientList2(button) {

    if ($("#rec_show_date2").val() == "") {
      var rec_show_findDate = formatDate(todayIn);
    } else {
      var rec_show_findDate = formatDate($("#rec_show_date2").val());
    }
    var functionLoco = 14;
    var ckdata = {
      functionLoco: functionLoco,
      rec_show_findDate: rec_show_findDate,
    }
    console.log(ckdata);

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
      }
    });
    $.ajax({
      type: 'POST',
      url: "{{ route('reception_road') }}",
      dataType: 'json',
      contentType: 'application/json',
      data: JSON.stringify(ckdata),
      beforeSend: function() {
        // Set a timeout to show the loading div after 3 seconds
        $(button).prop("disabled", true);
        timeoutHandle = setTimeout(oneClick, 3000);
      },
      success: function(response) {
        $(button).prop("disabled", false);
        clearTimeout(timeoutHandle);
        console.log(response);
        $(".pt-list-record").remove();
        $.each(response[0], function(index, value) {
          var Pt_list = $("<div>").attr("class", "row pt-list-record rec-patient-header no-margin")
            .append($("<div>").attr({
              class: "col-sm-1 no-margin"
            }).text(index + 1))
            .append($("<div>").attr({
              class: "col-sm-2 no-margin"
            }).text(value["Pid"]))
            .append($("<div>").attr("class", "col-sm-2 no-margin").text(value["FuchiaID"]))
            .append($("<div>").attr("class", "col-sm-2 no-margin").text(value["Name"]))
            .append($("<div>").attr("class", "col-sm-2 no-margin").text(value["Father"]))
            .append($("<div>").attr("class", "col-sm-1 no-margin").text(value["Gender"]))
            .append($("<div>").attr("class", "col-sm-1 no-margin").text(value["Agey"]))
            .append($("<div>").attr("class", "col-sm-1 no-margin").text(value["Agem"]));
          $(".rec-patient-list2").append(Pt_list);
        });
      }
    })


  }

  function show_consultation_record() {
    if (consultation_record.length > 0) {
      $(".rec-patient-list table tbody tr").remove();
      var prep_patient = 0;
      var prep_new = 0;
      var prep_old = 0;
      $.each(consultation_record, function(index, value) {
        if (value["prep"] != null && value["prep"] != "") {
          prep_patient += 1;
          if (value["prep"] == "New") {
            prep_new += 1
          } else {
            prep_old++;
          }
        }
        if ($("#find_reception_type").val() == "PrepCode") {
          if (value["prep"] != null && value["prep"] != "") {
            var Pt_list = $("<tr>")
              .append($("<td>").text(value["Pid"]))
              .append($("<td>").text(value["FuchiaID"]))
              .append($("<td>").text(value["prep"]))
              .append($("<td>").text(value["Name"]))
              .append($("<td>").text(value["Gender"]))
              .append($("<td>").text(value["Main Risk"]))
              .append($("<td>").text(value["Next Appointment Date"]));
            $(".rec-patient-list table tbody").append(Pt_list);

          }
        } else {
          var Pt_list = $("<tr>").attr({
              id: "ptlist" + index
            })
            .append($("<td>").text(value["Pid"]))
            .append($("<td>").text(value["FuchiaID"]))
            .append($("<td>").text(value["prep"]))
            .append($("<td>").text(value["Name"]))
            .append($("<td>").text(value["Gender"]))
            .append($("<td>").text(value["Main Risk"]))
            .append($("<td>").text(value["Next Appointment Date"]));
          $(".rec-patient-list table tbody").append(Pt_list);
          if (value["Pateint_Diagnosis"] == null || value["Pateint_Diagnosis"] == "731") {
            $("#ptlist" + index).css("background-color", "#ffa20078")
          }
        }
      });
      $("#reception_find_noti").html("Total patient:" + consultation_record.length +
        "<br>" + "Total Prep patient:" + prep_patient + "<br>" + "Prep New:" + prep_new + "<br>" + "Prep Old:" + prep_old)

    }
  }

  function preadd() {
    var preCount = $("#pre_number").val();

    if (preCount < 21 && preCount > 0) {
      var stillID = @json($value['Pid']);
      var preDefine = {
        notice: "Predfine General Code",
        preCount: preCount,
        stillID: stillID,
        clinic_code: mam_clinicID,
      }
      console.log(preDefine);
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        }
      });
      $.ajax({
        type: 'POST',
        url: "{{ route('reception_road') }}",
        dataType: 'json',
        contentType: 'application/json',
        data: JSON.stringify(preDefine),
        success: function(response) {
          alert("You add from " + (Number(stillID) + 1) + " to " + (Number(stillID) + Number(preCount)));
          history.go(0);
        }
      })

    }

  }

  function find_next_md() {
    var next_app_date = formatDate($("#nDate").val());
    var find_next_md = {
      notice: "find next md",
      next_app_date: next_app_date,
    }
    console.log(find_next_md);
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
      }
    });
    $.ajax({
      type: 'POST',
      url: "{{ route('reception_road') }}",
      dataType: 'json',
      //  processData:false,
      contentType: 'application/json',
      data: JSON.stringify(find_next_md),
      success: function(response) {
        console.log(response)
        $("#next_md_list li").remove();
        if (Object.keys(response).length > 0) {
          $.each(response, function(index, next_md) {
            var next_md_list = $("<li>").text(index + "-").add($("<li>").text(next_md));
            $("#next_md_list").append(next_md_list);
          })
        } else {
          // $("#next_md_list").append($("<li>").text("All Doctor is free at--"+$("#nDate").val()))
        }

      }
    })
  }

  function diagnosis_validation(target_valid) {
    var diag_valid_check = $("#" + target_valid + " input[type='checkbox']")
    var all_fine_diagnosis = true;

    $.each(diag_valid_check, function(index, value) {
      if ($("#" + value.id).prop("checked")) {
        var diag_child_selects = $("#" + value.id).parent().parent().find("select");

        var isFine = true; // Flag variable

        $.each(diag_child_selects, function(c_index, c_value) {
          if ($("#" + c_value.id).val() == "" || $("#" + c_value.id).val() == null) {
            isFine = false;
            return false; // Exit the inner loop as soon as an empty value is found
          }
        });
        if (!isFine) {
          all_fine_diagnosis = false;
          return false; // Exit the outer loop as soon as an empty value is found
        }
      }
    });
    return all_fine_diagnosis;
  }

  function SeachByName() {
    var serach_name_data = {
      serch_year: $("#name_serach_year").val(),
      notice: "Serach By name"
    }
    $("#show_name_result table tbody tr").remove();
    $("#search_input_name").val("");
    console.log(serach_name_data);
    if ($("#name_serach_year").val() != "") {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        }
      });
      $.ajax({
        type: 'POST',
        url: "{{ route('reception_road') }}",
        dataType: 'json',
        //  processData:false,
        contentType: 'application/json',
        data: JSON.stringify(serach_name_data),
        success: function(response) {
          if (response[0].length > 0) {
            console.log(response)
            $("#search_input_name").show();
            serch_name_result = response[0];
          } else {
            alert("There is no Clinet in this year")
          }

        }
      })

    }

  }


  // function location ( 1 ) to ready New Id and first checked is that the new one and return
  function idgiven() {
    clearFacts();
    document.getElementById('gid').value = document.getElementById('nextID').innerHTML;
    // For Date
    var date = new Date();
    var day = date.getDate();
    var month = date.getMonth() + 1;
    var year = date.getFullYear().toString();
    console.log(year);
    if (month < 10) month = "0" + month;
    if (day < 10) day = "0" + day;
    var today = year + "-" + month + "-" + day;
    document.getElementById('vDate').value = today;
    $("#clinic_code").val(mam_clinicID)
    $("#year_code").val(year.slice(year.length - 2, year.length));
    var gid = document.getElementById('gid').value;
    var searchIDtoCK = document.getElementById('search_id').value;
    var functionLoco = 1;
    if (searchIDtoCK.length < 5) {
      let ckID = 1;
      var checkPatient = 1;
      var ckdata = {
        functionLoco: functionLoco,
        gid: gid,
        ckID: ckID
      };
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        }
      });
      $.ajax({
        type: 'POST',
        url: "{{ route('reception_road') }}",
        dataType: 'json',
        contentType: 'application/json',
        data: JSON.stringify(ckdata),
        success: function(response) {
          $("#qrcode_print").val("No");
          if (response[0] == null) {
            document.getElementById('regbutton').disabled = false;
            document.getElementById('updateBton').disabled = true;
            document.getElementById('followBton').disabled = true;
            $("#clinic_code").prop("disabled", true);
            document.getElementById('responseText').innerHTML = "";
            document.getElementById('responseText').innerHTML = "The new code was checked ,it is the new ID.";
            document.getElementById('fid').focus();
            $("#register_date,#register_date,#agey_register,#agem_register").prop("disabled", false)
          }
          if (response[0] != null) {
            generatedID = response[0]['id'];
            if (response[1] != null) {
              document.getElementById('responseText').innerHTML = "";
              document.getElementById('responseText').innerHTML = "We have got data.";
            }
            document.getElementById("name").value = response[1];
            document.getElementById("father").value = response[2];
            document.getElementById('gender').value = response[0]["Gender"];
            document.getElementById("agey").value = response[0]["Agey"];
            document.getElementById("agem").value = response[0]["Agem"];
            document.getElementById("state").value = response[0]["Region"];
            document.getElementById("tt_opt").value = response[0]["Township"];
            // document.getElementById("quarter").value=response[0]["Quarter"];
            document.getElementById("fid").value = response[0]["FuchiaID"];
            //document.getElementById("vdate").value=response[0]["Reg Date"];
            //document.getElementById("dob").value=response[0]["Date Of Birth"];
            document.getElementById('main_risk').disabled = false;
            document.getElementById('sub_risk').disabled = false;
            $("#clinic_code").prop("disabled", false);

            document.getElementById('regbutton').disabled = true;
            document.getElementById('updateBton').disabled = true;
            document.getElementById('followBton').disabled = false;
          }
        }
      });
    }
  }
  //functionLocation ( 1 ) Search General with ID
  function ptData() {
    // For Date
    var date = new Date();
    var day = date.getDate();
    var month = date.getMonth() + 1;
    var year = date.getFullYear();
    if (month < 10) month = "0" + month;
    if (day < 10) day = "0" + day;
    var today = year + "-" + month + "-" + day;
    document.getElementById('vDate').value = today;


    var gid = document.getElementById('gid').value;
    var Fid = $("#fid").val();
    var searchIDtoCK = document.getElementById('search_id').value;
    var gidLength = gid.length;
    if (gidLength > 9 || Fid.length > 5 || eyes_code != null) {
      document.getElementById('responseText').innerHTML = "";
      if (searchIDtoCK.length < 5 || Fid.length > 5 || eyes_code != null) {
        var functionLoco = 1;
        let ckID = 1;
        var checkPatient = 1;
        var ckdata = {
          gid: gid,
          Fid: Fid,
          eye_code: $("#eyes_code").val(),
          functionLoco: functionLoco,
          ckID: ckID,
        };
        console.log(ckdata);
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
          }
        });
        $.ajax({
          type: 'POST',
          url: "{{ route('reception_road') }}",
          dataType: 'json',
          contentType: 'application/json',
          data: JSON.stringify(ckdata),
          success: function(response) {
            console.log(response);
            console.log(response.length);
            $("#qrcode_print").val("No");
            if (response[0] == null) {
              document.getElementById("gid").value = gid;
              document.getElementById('regbutton').disabled = false;
              document.getElementById('updateBton').disabled = true;
              document.getElementById('followBton').disabled = true;
              document.getElementById("responseText").innerHTML = "There is no data for this client."
              $("#register_date").prop("disabled", false);
              alert("New Patient");
              DateTo_text();
            }
            if (response.length > 8) {
              if (response[0] != null) {
                var response7 = response[7];
                $("#eyes_code").val(response[0]["Eyes_code"]);
                if (response7 != null) {
                  var nextDate = response[7]["Next Appointment Date"];
                  $("#reception_LastVDate").val(response[7]["Visit Date"]);


                  if (today != nextDate) {
                    document.getElementById('responseText').innerHTML = "Unplanned Visit";
                  } else {
                    document.getElementById('responseText').innerHTML = "Planned  Visit";
                  }
                  $("#regbutton,#updateBton").prop("disabled", true);
                  $("#followBton").prop("disabled", false);
                  $("#register_date").prop("disabled", true);

                } else {
                  document.getElementById('responseText').innerHTML = "";
                  document.getElementById('responseText').innerHTML = "We have got data.";
                }

                generatedID = response[0]['id'];
                register_date = response[0]['Reg Date'];
                if (response[1] != null) { // For Name
                  document.getElementById("name").value = response[1];
                }
                if (response[2] != null) { //For Father
                  document.getElementById("father").value = response[2];
                }

                if (response[3] != null) { // For Date of Birth and Age
                  var closeBtn = 0;
                  var bd_date = response[3];
                  dob_input = response[3];
                  var registerAge = response[0]["Agey"];
                  dob_month = dob_input.split("-")[1];
                  dob_day = dob_input.split("-")[2];
                  if (dob_month == "6" && dob_day == "15" && registerAge == 1) {
                    dob_input = "";
                  }
                  var registerDate = response[0]["Reg Date"];

                  if (bd_date == "" || bd_date == null || bd_date == "0" || bd_date.length < 2) {
                    // not get date of birth form pt config
                    if (registerAge <= 0 && response[0]["Agem"] <= 0) {
                      alert("Age မှားနေပါသည်။");
                      $("#search_id").focus();
                      $('#search_id').val(gid);
                      $('#agey').css("background", "red");
                      closeBtn = 1;
                    }
                  } else {
                    var dateSplited = bd_date.split("-");
                    var dtYear = dateSplited[0];
                    var dtMonth = dateSplited[1];
                    if (dtYear.length != 4) {
                      alert("Age မှားနေပါသည်။");
                      $("#search_id").focus();
                      $('#search_id').val(gid);
                      $('#agey').css("background", "red");
                      closeBtn = 1;
                    }

                  }

                  if (response[4] != null) { // For Region
                    document.getElementById("state").value = response[4];
                    region();
                  }
                  if (response[5] != null) { // For Township
                    document.getElementById("tt").value = response[5];
                  }
                  document.getElementById('gender').value = response[8];
                  document.getElementById('quarter').value = response[6];
                  document.getElementById("gid").value = response[0]["Pid"];
                  document.getElementById("fid").value = response[0]["FuchiaID"];
                  document.getElementById("prepCode").value = response[0]["PrEPCode"];
                  $("#main_risk").val(response[0]["Main Risk"]);
                  PatientType()
                  $("#sub_risk").val(response[0]["Sub Risk"]);
                  $("#register_date").val(response[0]["Reg Date"]);
                  $("#agey_register").val(response[0]["Agey"]);
                  $("#agem_register").val(response[0]["Agem"]);



                  //  document.getElementById("vDate").value=today;

                  $("#heigth").val(response[9]);

                  if (registerAge > 12) {
                    $(".reception-muac").hide();
                  }

                  document.getElementById('prepCode').disabled = true;
                  document.getElementById('name').disabled = true;
                  document.getElementById('father').disabled = true;
                  document.getElementById('gender').disabled = true;
                  document.getElementById('state').disabled = true;
                  document.getElementById('tt').disabled = true;



                  document.getElementById('dob').disabled = true;
                  document.getElementById('agey').disabled = true;
                  document.getElementById('agem').disabled = true;
                  $("#agey_register,#agem_register").prop("disabled", true)
                  document.getElementById('main_risk').disabled = true;
                  document.getElementById('sub_risk').disabled = true;
                  if ((response[0]["Main Risk"] == null || response[0]["Main Risk"] == "-") && (response[0]["FuchiaID"] != null || response[0][
                      "FuchiaID"
                    ] != "-")) {
                    $("#main_risk,#sub_risk").prop("disabled", false);
                  }


                  document.getElementById('regbutton').disabled = true;
                  document.getElementById('updateBton').disabled = true;
                  document.getElementById('followBton').disabled = false;
                  $("#reception_remark_block").show();
                  if (closeBtn == 1) {
                    document.getElementById('followBton').disabled = true;
                  }

                }

              }
              DateTo_text();

              dateOfBirth();
            } else if (response.length == 2) {
              $("#regbutton,#updateBton").prop("disabled", true);
              preCode = response[1];
              $("#responseText").text("Pre define patient").css("color", "#0cf21e");
              document.getElementById('regbutton').disabled = true;
              document.getElementById('updateBton').disabled = true;
              $("#followBton,#register_date,#agey_register,#agem_register").prop("disabled", false);
            }

          }
        });
      }
    } else {
      clearFacts();
      document.getElementById('responseText').innerHTML = "ID'length is  < 10";
      document.getElementById('regbutton').disabled = true;
      document.getElementById('updateBton').disabled = true;
      document.getElementById('followBton').disabled = true;
    }


  }
  //function Location ( 2 ) Search with Fuchia ID
  function searchFuchiaID() {
    // For Date
    var date = new Date();
    var day = date.getDate();
    var month = date.getMonth() + 1;
    var year = date.getFullYear();
    if (month < 10) month = "0" + month;
    if (day < 10) day = "0" + day;
    var today = year + "-" + month + "-" + day;
    document.getElementById('vDate').value = today;

    let fuchiaShar = 1;
    var functionLoco = 2;
    let fuID = document.getElementById('fid').value;

    var pati = {
      functionLoco: functionLoco,
      fuchiaShar: fuchiaShar,
      fuID: fuID,
    };
    console.log(pati);
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
      }
    });
    $.ajax({
      type: 'POST',
      url: "{{ route('reception_road') }}",
      dataType: 'json',
      //  processData:false,
      contentType: 'application/json',
      data: JSON.stringify(pati),
      success: function(response) {
        console.log(response);
        if (response[0] == null) {
          document.getElementById('regbutton').disabled = false;
          document.getElementById('updateBton').disabled = true;
          document.getElementById('followBton').disabled = true;
          var new_old = document.getElementById('new_old');
          if (new_old.innerHTML != null) {
            new_old.innerHTML = "";
          }
          var sel = document.getElementById('new_old');
          var opt = document.createElement("option");
          opt.appendChild(document.createTextNode("There is no data for this client."));
          opt.value = "New";
          sel.appendChild(opt);
          sel.style.color = "red";
        }
        if (response[0] != null) {
          clearFacts();
          generatedID = response[0]['id'];

          // var new_old = document.getElementById('new_old');
          // if(new_old.innerHTML!=null){
          //   new_old.innerHTML="";
          // }
          // var sel = document.getElementById('new_old');
          $("#responseText").text("We have Got Data")
          if (response[1] != null) { // For Name
            document.getElementById("name").value = response[1];
          }
          if (response[2] != null) { //For Father
            document.getElementById("father").value = response[2];
          }
          if (response[3] != null) { // For Date of Birth and Age
            var bd_date = response[3];
            var dateSplited = bd_date.split("-");

            var dtYear = dateSplited[0];
            var dtMonth = dateSplited[1];

            if (dtYear == year) {
              document.getElementById("agem").value = Number(dtMonth) + Number(month);
            } else {
              var Adate = new Date();
              var Aday = Adate.getDate();
              var Amonth = Adate.getMonth() + 1;
              var Ayear = Adate.getFullYear();
              var toshowYear = Ayear - Number(dtYear);
              // document.getElementById("agey").value=getAge(bd_date);
              document.getElementById("agey").value = toshowYear;
            }
          }
          document.getElementById('gender').value = response[0]["Gender"];

          document.getElementById("gid").value = response[0]["Pid"];


          if (response[4] != null) { // For Region
            document.getElementById("state").value = response[4];
          }
          if (response[5] != null) { // For Township
            document.getElementById("tt").value = response[5];
          }


          document.getElementById("fid").value = response[0]["FuchiaID"];
          document.getElementById("vDate").value = today;
          //document.getElementById("dob").value=response[0]["Date of Birth"];
          //document.getElementById("Ptype").value=response[0]["Patient Type"];
          //document.getElementById("tt_sub").value=response[0]["Patient Type Sub"];
          //document.getElementById("tt_sub_2").value=response[0]["Patient Type Sub1"];
          $("#regbutton,#updateBton,#name,#father,#gender,#state,#tt,#dob,#agey,#agem,#main_risk,#sub_risk")
            .prop("disabled", true);
          $("##followBton").prop("disabled", false);

        }



        if (response[0] == null) {
          document.getElementById('responseText').innerHTML = "";
          document.getElementById('responseText').innerHTML = "Wrong ID";
          document.getElementById('updateBton').disabled = true;
          document.getElementById('regbutton').disabled = false;
          //location.reload(true);
        }

      }
    });


  }
  // function location ( 3 ) Add new patient
  function send(button) {
    let gtReg = 1;
    var functionLoco = 3;
    var created_by = document.getElementById("navbarDropdown").innerHTML;
    var gid = document.getElementById("gid").value;
    let qrok = $("#qrcode_print").val();
    var clinic_code = document.getElementById("clinic_code").value;
    var name = document.getElementById("name").value;
    if (name.length < 1) {
      name = "-";
    }
    var father = document.getElementById("father").value;
    if (father.length < 1) {
      father = "-";
    }
    var agey = document.getElementById("agey").value;
    if (agey.length < 1) {
      agey = 0;
    }
    var agem = document.getElementById("agem").value;
    if (agem.length < 1) {
      agem = 0;
    }
    var gender = document.getElementById("gender").value;
    if (gender.length < 1) {
      gender = "-";
    }
    var vdate = document.getElementById("vDate").value;
    vdate = formatDate(vdate); // Date formatChange function
    console.log(vdate + "visit date")

    dateOfBirth();
    var dobdate = ddDate;




    var state = document.getElementById("state").value;
    if (state.length < 1) {
      state = "-";
    }
    var tt = document.getElementById("tt").value;
    if (tt.length < 1) {
      tt = "-";
    }
    var fuchiaID = document.getElementById("fid").value;
    var prepCode = document.getElementById("prepCode").value;
    var main_risk = document.getElementById("main_risk").value;
    var sub_risk = document.getElementById("sub_risk").value;
    if (gid.length == 10) { //Mode 0= Walk in , 1= Peer with 11,12 code.length;
      var mode = 0;
      console.log("mode is" + mode);
    } else {
      var mode = 1;
      console.log("mode is" + mode);
    }
    var unplan = 0;


    var pre_register = $("#pre_reg").val();
    var register_age = $("#agey_register").val();
    var register_agem = $("#agem_register").val();
    var height = document.getElementById("heigth").value;
    var weight = document.getElementById("weight").value;
    var muac = document.getElementById("muac").value;

    var pati = {
      register_date: register_date,
      register_age: register_age,
      register_agem: register_agem,
      functionLoco: functionLoco,
      gtReg: gtReg,
      clinic_code: clinic_code,
      gid: gid,
      mode: mode,
      fuchiaID: fuchiaID,
      prepCode: prepCode,
      name: name,
      father: father,
      agey: agey,
      agem: agem,
      gender: gender,
      vdate: vdate,
      dobdate: dobdate,
      state: state,
      height: height,
      muac: muac,
      weight: weight,
      tt: tt,
      quarter: $("#quarter").val(),
      main_risk: main_risk,
      sub_risk: sub_risk,
      unplan: unplan,
      created_by: created_by,
      pre_register: pre_register,
      current_md: $("#current_md").val(),
      eyes_code: $("#eyes_code").val(),
      online: $("#online_follow").val(),

    };
    console.log(pati);

    if (gid.length > 0 && ((register_age > 0 && register_age < 150 && register_agem == 0) ||
        (register_agem > 0 && register_agem < 12 && register_age == 0)) && gender.length > 2 && register_date.length > 5) {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        }
      });
      $.ajax({
        type: 'POST',
        url: "{{ route('reception_road') }}",
        dataType: 'json',
        //  processData:false,
        contentType: 'application/json',
        data: JSON.stringify(pati),
        beforeSend: function() {
          $(button).prop("disabled", true);
          timeoutHandle = setTimeout(oneClick, 3000);
        },
        success: function(response) {
          $(button).prop("disabled", false);
          clearTimeout(timeoutHandle);

          if (response[0] == "duplicate") {
            alert("Duplicate Entry");
            location.reload(true); // to refresh the page
          } else {
            alert("အချက်အလက်များကို သိမ်းပြီးပါပြီ။");
            console.log(response);

            if (qrok == "Yes") {

              $('.qr-code').html(response.barcode2DHtml);
              $(".container").hide();
              $("#print-section").show();
              window.print();
              $("#print-section").show();
            }

            location.reload(true); // to refresh the page
          }
        },
        error: function(response) {
          console.log(response)
          alert(response["responseJSON"]["error"]);
        }
      });

    } else {
      alert("အချက်အလက်များမပြည့်စုံသေးပါ။");
    }
  }
  // function location (4) add follow up

  function send_fup(button) {

    let ptFollowup = 1;
    var functionLoco = 4;
    var clinic_code = document.getElementById("clinic_code").value;
    let qrok = $("#qrcode_print").val();
    var gid = document.getElementById("gid").value;
    var created_by = document.getElementById("navbarDropdown").innerHTML;
    var agey = document.getElementById("agey").value;
    var agem = document.getElementById("agem").value;
    var gender = document.getElementById("gender").value;
    var vdate = document.getElementById("vDate").value;
    var height = document.getElementById("heigth").value;
    var weight = document.getElementById("weight").value;
    var muac = document.getElementById("muac").value;
    vdate = formatDate(vdate);
    dateOfBirth();
    var dobdate = ddDate;

    var fuchiaID = document.getElementById("fid").value;
    var prepCode = document.getElementById("prepCode").value;

    if (!dobdate) {
      dobdate = "";
    }


    if (!agey) {
      agey = 0;
    }
    var agem = document.getElementById("agem").value;
    if (!agem) {
      agem = 0;
    }
    var gender = document.getElementById("gender").value;
    if (!gender) {
      gender = "";
    }

    vdate = formatDate($("#vDate").val());
    console.log(vdate + "test");
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
      fuchiaID = "";
    }

    var prepCode = document.getElementById("prepCode").value;
    if (!prepCode) {
      prepCode = "";
    }


    var main_risk = $("#main_risk").val();
    var sub_risk = $("#sub_risk").val();
    var quarter = $("#quarter").val();


    if (gid.length == 10) { //Mode 1= Walk in , 2= Peer with 11,12 code.length;
      var mode = 0;
    } else {
      var mode = 1;
    }
    if (fuchiaID.length < 1) {
      fuchiaID = "-";
    }
    var unplan = 0;
    var register_age = $("#agey_register").val();
    var register_agem = $("#agem_register").val();
    var pati = {
      register_date: register_date,
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
      vdate: vdate,
      dobdate: dobdate,
      register_age: register_age,
      register_agem: register_agem,
      quarter: quarter,

      main_risk: main_risk,
      sub_risk: sub_risk,
      preCode: preCode,
      unplan: unplan,
      created_by: created_by,
      height: height,
      muac: muac,
      weight: weight,
      name: $("#name").val(),
      father_name: $("#father").val(),
      state: $("#state").val(),
      township: $("#tt").val(),
      remark: $("#reception_remark").val(),
      current_md: $("#current_md").val(),
      online: $("#online_follow").val(),
    };
    console.log(pati)

    if (gid.length > 0 && ((register_age > 0 && register_age < 150 && register_agem == 0) ||
        (register_agem > 0 && register_agem < 12 && register_age == 0)) && gender.length > 2 && register_date.length > 5) {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        }
      });
      $.ajax({
        type: 'POST',
        url: "{{ route('reception_road') }}",
        dataType: 'json',
        //  processData:false,
        contentType: 'application/json',
        data: JSON.stringify(pati),
        beforeSend: function() {
          $(button).prop("disabled", true);
          timeoutHandle = setTimeout(oneClick, 3000);
        },
        success: function(response) {
          $(button).prop("disabled", false);
          clearTimeout(timeoutHandle);
          console.log(response);
          if (response[0] == true) {
            alert("Duplicate Entry");
          } else {
            alert("အချက်အလက်များကို သိမ်းပြီးပါပြီ။");
            if (qrok == "Yes") {

              $('.qr-code').html(response.barcode2DHtml);
              $(".container").hide();
              window.print();
              $("#print-section").show();
            }
          }
          location.reload(true); // to refresh the page

        }
      });
    } else {
      alert("အချက်အလက်များ မပြည့်စုံသေးပါ။");
    }

  }
  // function location ( 5 ) finding data with General ID of Fuchia ID to Edit or Update data
  function searchID() {
    // For Date
    let search_par = 1;
    var functionLoco = 5;
    let Pt_ID = document.getElementById("search_id").value;
    var pati = {
      search_par: search_par,
      functionLoco: functionLoco,
      Pt_ID: Pt_ID,
    };
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
      }
    });
    $.ajax({
      type: 'POST',
      url: "{{ route('reception_road') }}",
      dataType: 'json',
      //  processData:false,
      contentType: 'application/json',
      data: JSON.stringify(pati),
      success: function(response) {
        clearFacts();
        console.log(response);
        $("#qrcode_print").val("No");
        $("#weight,#muac,#heigth").val("")
        $("#weight,#muac,#heigth,#current_md").parent().hide();

        if (response[0] == null) {
          alert("This ID do not have in this clinic")
        } else {
          $("#name").val(response[0]["Name"]);
          $("#father").val(response[0]["Father"]);
          $("#main_risk").val(response[0]["Main Risk"]);
          PatientType();

          $("#sub_risk").val(response[0]["Sub Risk"]);
          $("#fid").val(response[0]["FuchiaID"]);
          $("#gender").val(response[0]["Gender"])
          $("#gid").val(response[0]["Pid"])
          $("#register_date").val(response[0]["Reg Date"])
          $("#agey_register").val(response[0]["Agey"])
          $("#agem_register").val(response[0]["Agem"])
          $("#agey").val(response[0]["current_age"])
          $("#agem").val(response[0]["current_month"])
          $("#state").val(response[0]["Region"])
          region();
          $("#tt").val(response[0]["Township"])
          $("#quarter").val(response[0]["Quarter"])
          $("#clinic_code").val(response[0]["Clinic Code"])
          $("#eyes_code").val(response[0]["Eyes_code"])
          $("#search_id").val(response[0]["Pid"]).prop("disabled", true)

          $("#main_risk,#sub_risk,#regbutton,#followBton").prop("disabled", true);
          $("#updateBton,#register_date,#prepCode,#name,#father,#gender,#state,#tt,#dob").prop("disabled", false);
          register_date = ""; // for register date change;
          dob_input = "";
          DateTo_text()
          $('#barcode').html(response.barcode1DHtml);
          $('#qrcode').html(response.barcode2DHtml);
        }
      }
    });
  }
  // function locatjion ( 6 ) to update data to config table and patient table
  function update_reg(button) {
    let update_reg = 1;
    var functionLoco = 6;
    var clinic_code = document.getElementById("clinic_code").value;
    var gid = document.getElementById("gid").value;
    var created_by = document.getElementById("navbarDropdown").innerHTML;
    let qrok = $("#qrcode_print").val();
    var gid_len = gid.length;
    if (gid_len == 10 || gid_len == 11 || gid_len == 12) {


      if (gid_len == 10) { //Mode 1= Walk in , 2= Peer with 11,12 code.length;
        var mode = 0;
      } else {
        var mode = 1;
      }
      var fuchiaID = document.getElementById("fid").value;
      var prepCode = document.getElementById("prepCode").value;
      var name = document.getElementById("name").value;
      var father = document.getElementById("father").value;
      var agey = document.getElementById("agey_register").value;
      var agem = document.getElementById("agem_register").value;
      var gender = document.getElementById("gender").value;
      var vdate = document.getElementById("register_date").value;
      vdate = formatDate(vdate); // Date formatChange function
      var original_ID = $("#search_id").val();

      dateOfBirth();
      var dobdate = ddDate;
      //var dobdate = document.getElementById("dob").value;
      console.log("date of birth" + dobdate);
      var state = document.getElementById("state").value;
      var quarter = document.getElementById("quarter").value;
      var tt = document.getElementById("tt").value;


      var pati = {
        update_reg: update_reg,
        functionLoco: functionLoco,
        clinic_code: clinic_code,
        original_ID: original_ID,
        gid: gid,
        mode: mode,
        fuchiaID: fuchiaID,
        prepCode: prepCode,

        generatedID: generatedID,
        generatedID1: generatedID1,
        genID: genID,

        name: name,
        father: father,
        agey: agey,
        agem: agem,
        gender: gender,
        vdate: vdate,
        quarter: quarter,
        dobdate: dobdate,
        state: state,
        tt: tt,
        eyes_code: $("#eyes_code").val(),
        created_by: created_by,

      };
      console.log(pati)
      if (((agey > 0 && agey < 150 && agem == 0) ||
          (agem > 0 && agem < 12 && agey == 0)) && gender.length > 2 && vdate.length > 5) {
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
          }
        });
        $.ajax({
          type: 'POST',
          url: "{{ route('reception_road') }}",
          dataType: 'json',
          //  processData:false,
          contentType: 'application/json',
          data: JSON.stringify(pati),
          beforeSend: function() {
            $(button).prop("disabled", true);
            timeoutHandle = setTimeout(oneClick, 3000);
          },
          success: function(response) {
            $(button).prop("disabled", false);
            clearTimeout(timeoutHandle);
            $('#agey').css("background", "red");
            console.log(response);
            if (qrok == "Yes") {

              $('.qr-code').html(response.barcode2DHtml);
              $(".container").hide();
              $("#print-section").show();
              window.print();
            }

            alert("အချက်အလက်များကို သိမ်းပြီးပါပြီ။");

            location.reload(true); // to refresh the page
            document.getElementById('regbutton').disabled = false;
          }
        });
      } else {
        alert("အချက်အလက်များ မပြည့်စုံသေးပါ။");
      }

    } else {
      alert("General ID ထည့်သွင်းပေးပါ။");
    }

  }
  ///****////****///****///****////****///****///****////****///****///****////****///****///****////****///****
  // Return Section
  // function location ( 7 ) to find pt data with General ID  in return section
  function ptData_return() {
    var gid_return = document.getElementById('gid_return').value;
    var fid_return = $("#fid_return").val();
    //var c_code = document.getElementById("clinic_code").innerHTML;
    var gidLength = gid_return.length;
    if (gidLength > 9 || fid_return.length > 6) {
      //document.getElementById('responseText').innerHTML="";
      let ckID_return = 1;
      var checkPatient = 1;
      var functionLoco = 7;
      var ckdata = {
        gid_return: gid_return,
        fid_return: fid_return,
        functionLoco: functionLoco,
        ckID_return: ckID_return,
      };
      console.log(ckdata);
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        }
      });
      $.ajax({
        type: 'POST',
        url: "{{ route('reception_road') }}",
        dataType: 'json',
        contentType: 'application/json',
        data: JSON.stringify(ckdata),
        success: function(response) {
          clearFacts();
          console.log(response);

          age = response[0]["Current Agey"];
          agem = response[0]["Current Agem"];
          if (response[0] != null) {
            document.getElementById("fid_return").value = response[0]["FuchiaID"];
            document.getElementById("gid_return").value = response[0]["Pid"];
            document.getElementById("fup_date").value = response[0]["Visit Date"];
            document.getElementById("nDate").value = response[0]["Next Appointment Date"];
            var id = response[0]["Pid"];
            $("#responseText").append("General ID =>" + "" + id);
            $("#responseText").css("color", "red");
          } else {
            document.getElementById("fid_return").value = '';
            document.getElementById("fup_date").value = '';
            document.getElementById("nDate").value = '';
            document.getElementById("responseText").innerHTML = '';
            $("#responseText").append("There is no data.");
            $("#responseText").css("color", "red");
          }

          // if (age < 13) {
          //   $("#fmaplancheck").prop("disabled", true);
          // }
          if (response[0]['Gender'] == "195997324") {
            $("#fmaplancheck").prop("disabled", true);
            $("#anccheck").prop("disabled", true);

            $("#pmtctcheck").prop("disabled", true);
          }
          DateTo_text();

        }
      });

    } else {
      clearFacts();
      document.getElementById('responseText').innerHTML = "ID'length is  < 10";

    }
  }
  // function location ( 9 ) to save next appointment date and diagnosis data
  function save(button) {
    let next = 1;
    var functionLoco = 9;
    var gid = document.getElementById("gid_return").value;
    var fid = document.getElementById("fid_return").value;
    var fvDate = document.getElementById("fup_date").value;
    var follow_up_md = document.getElementById("follow_up_md").value;
    var nDate = document.getElementById("nDate").value;
    nDate = formatDate(nDate); // Date formatChange function
    fvDate = formatDate(fvDate);



    var Diagnosis_Data = {
      next: next,
      functionLoco: functionLoco,
      gid: gid,
      nDate: nDate,
      follow_up_md: follow_up_md,
      fvDate: fvDate,
      fid: fid,

    }

    var diag_check = [
      'phacheck', 'artcheck', 'prepcheck', 'pmtctcheck', 'anccheck', 'fmaplancheck', 'gneralcheck', 'ncdcheck', 'hivTBcheck', 'fcentercheck', 'labInvestcheck',
    ]
    var diag_select = ['pha_new_old', 'pha_cohort', 'prep_new_old', 'anc_new_old', 'art_new_old', 'art_cohort', 'pmtct_new_old', 'famaplan_new_old', 'general_new_old', 'general_diagnosis', 'OPD', 'feedcentre_new_old', 'ncd_new_old', 'ncd_diagnosis', 'ncd_drugSupply', 'hivTB_new_old', 'labInvest_new_old', 'refer_fever', ]
    console.log(diag_select.length + "select")
    for (var i = 0; i < diag_check.length; i++) {
      if ($("#" + diag_check[i]).prop('checked')) {
        Diagnosis_Data[diag_check[i]] = diag_check[i];

      } else {
        Diagnosis_Data[diag_check[i]] = ""
      }
    } //checkbox input collecting 
    for (var j = 0; j < diag_select.length; j++) {
      Diagnosis_Data[diag_select[j]] = $("#" + diag_select[j]).val();
    } //selectbox data collecting
    if (Diagnosis_Data["OPD"] == null) {
      Diagnosis_Data["OPD"] = "No";
    }
    Diagnosis_Data["mpox suspected"] = $("#mpox_yes_no").val();
    Diagnosis_Data["mpox rash"] = $("#mpox_rash_yes_no").val();
    Diagnosis_Data["mpox futher"] = $("#mpox_fur_mx").val();




    console.log(Diagnosis_Data);
    if (gid.length > 0 && diagnosis_validation("resDiaSecton")) {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        }
      });
      $.ajax({
        type: 'POST',
        url: "{{ route('reception_road') }}",
        dataType: 'json',
        //  processData:false,
        contentType: 'application/json',
        data: JSON.stringify(Diagnosis_Data),
        beforeSend: function() {
          $(button).prop("disabled", true);
          timeoutHandle = setTimeout(oneClick, 3000);
        },
        success: function(response) {
          $(button).prop("disabled", false);
          clearTimeout(timeoutHandle);
          console.log(response);
          if (!nDate) {
            alert("Diagnosis Data များကို သိမ်းပြီးပါပြီ။");
          } else {
            alert("Next-appointment Date နှင့် Diagnosis Data များကို သိမ်းပြီးပါပြီ။");
          }

          location.reload(true); // to refresh the page
        }
      });

    } else {
      alert("အချက်အလက်များ ပြည့်စုံအောင် ဖြည့်သွင်းပါ။");
    }
  }
  // functjion location ( 10 ) to find data next appointment with category in nextappointment section
  function search_nextAppointment() {
    var ndate = document.getElementById('nextSerachDate').value;
    ndate = formatDate(ndate); // Date formatChange function
    console.log(ndate);

    var visit_type = document.getElementById('visit_type').value;
    console.log(visit_type);
    var functionLoco = 10;
    var ckdata = {
      ndate: ndate,
      functionLoco: functionLoco,
      visit_type: visit_type,
    };
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
      }
    });
    $.ajax({
      type: 'POST',
      url: "{{ route('reception_road') }}",
      dataType: 'json',
      contentType: 'application/json',
      data: JSON.stringify(ckdata),
      success: function(response) {
        console.log(response);
        var serialNo = 0;
        var next_diagnosis = Object.keys(response[0]).length
        var next_type = Object.keys(response[1]).length

        var total_ID = next_diagnosis + next_type;

        // var show_list=response;
        if (total_ID > 0) {

          document.getElementById("total_len").innerHTML = '';
          document.getElementById("list").innerHTML = '';
          $("#total_len").append("Total Patient for (" + ndate + ") is " + total_ID + ".");
          if (next_diagnosis > 0) {
            for (var diag = 1; diag <= next_diagnosis; diag++) {
              console.log("hello diag")
              var gen_id_null = response[0][diag][0]["Pid"];
              console.log(gen_id_null + "fine");
              if (gen_id_null == null) {
                gen_id_null = '-';
              }
              var fuchia_null = response[0][diag][0]["FuchiaID"];
              if (fuchia_null == null) {
                fuchia_null = "-";
              }
              var prep_null = response[0][diag][0]["PrEPCode"];
              if (prep_null == null) {
                prep_null = "-";
              }
              serialNo = serialNo + 1;

              var unplan_alert = response[0][diag][0]["Unplan"];
              var rows = ("<tr class=reception_nextList" + unplan_alert + ">" +
                "<td >" + serialNo + "</td>" +
                "<td>" + gen_id_null + "</td>" +
                "<td>" + fuchia_null + "</td>" +
                "<td>" + prep_null + "</td>" +
                //"<td>"+ response[0][i]["Patient Type"]+"</td>"+
                "<td>" + response[0][diag][0]["Next Appointment Date"] + "</td>" +

                "</tr>");

              $("#list").append(rows);
              if (unplan_alert == 2) {
                console.log("hello unplan is 2");
                $(".reception_nextList2").css({
                  'background-color': 'green'
                });
                // $("#reception_nextList").css('background-color': 'yellow');
              }
              if (unplan_alert == 1) {
                console.log("hello unplan is 1");
                $(".reception_nextList1").css({
                  'background-color': 'red'
                });
                // $("#reception_nextList").css('background-color': 'yellow');
              }

            }
          }
          if (next_type > 0) {
            for (var diag = 0; diag < next_type; diag++) {
              console.log("hello type diag")
              var gen_id_null = response[1][diag]["Pid"];
              console.log(gen_id_null + "fine");
              if (gen_id_null == null) {
                gen_id_null = '-';
              }
              var fuchia_null = response[1][diag]["FuchiaID"];
              if (fuchia_null == null) {
                fuchia_null = "-";
              }
              var prep_null = response[1][diag]["PrEPCode"];
              if (prep_null == null) {
                prep_null = "-";
              }
              serialNo = serialNo + 1;
              var unplan_alert = response[1][diag]["Unplan"];
              var rows = ("<tr class=reception_nextList" + unplan_alert + ">" +
                "<td >" + serialNo + "</td>" +
                "<td>" + gen_id_null + "</td>" +
                "<td>" + fuchia_null + "</td>" +
                "<td>" + prep_null + "</td>" +
                //"<td>"+ response[0][i]["Patient Type"]+"</td>"+
                "<td>" + response[1][diag]["Next Appointment Date"] + "</td>" +

                "</tr>");

              $("#list").append(rows);
              if (unplan_alert == 2) {
                console.log("hello unplan is 2");
                $(".reception_nextList2").css({
                  'background-color': 'green'
                });
                // $("#reception_nextList").css('background-color': 'yellow');
              }
              if (unplan_alert == 1) {
                console.log("hello unplan is 1");
                $(".reception_nextList1").css({
                  'background-color': 'red'
                });
                // $("#reception_nextList").css('background-color': 'yellow');
              }

            }
          }
        } else {
          document.getElementById("total_len").innerHTML = '';
          document.getElementById("total_len").innerHTML = 'There is no data.';
          document.getElementById("list").innerHTML = '';
        }
      }
    });
  }
  // function location ( 11 ) to show  history

  function PatientType() {
    let type = $("#main_risk").val();

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
    // migrant
  } //Risk


  // Search

  function ncdCheck() {
    if (updateCheck == "click" || updateCheck == "fromUpdate") {
      console.log("hello ncd");
      var heperten = $("<option></option").text("Hypertension only").val("Hypertension");
      var diabetes = $("<option></option").text("Diabetes only").val("Diabetes");
      var hdcommo = $("<option></option").text("H/T & DM commodities").val("HT-DM-commodities");


      if (updateCheck == "click") {
        $("#ncd_ul li:nth-child(4)").show();
        $("#ncd_diagnosis").append(heperten, diabetes, hdcommo);
      } else if (updateCheck == "fromUpdate") {
        $("#ncd_ulupdate li:nth-child(4)").show();
        $("#ncd_diagnosisupdate").append(heperten, diabetes, hdcommo);
      }

    } else if (updateCheck == "noclick") {
      $("#ncd_diagnosis option:not(:first)").remove();
      $("#ncd_drugSupply").val("-");
      $("#ncd_ul li:nth-child(4)").hide();

    } else if (updateCheck == "noupdate") {
      $("#ncd_diagnosisupdate option:not(:first)").remove();
      $("#ncd_drugSupplyupdate").val("-");
      $("ncd_ulupdate li:nth-child(4)").hide();

    }

  }

  function generalCheck() {
    var patientAge = age;
    if (updateCheck == "click" || updateCheck == "fromUpdate") {
      if (patientAge > 14) {
        for (var diag = 0; diag < diagnosis.length; diag++) {
          var diagnosis_tag = $("<option></option>").text(diagnosis[diag]).val(diagnosis_value[diag]);
          if (updateCheck == "click") {
            $("#general_diagnosis").append(diagnosis_tag);
          } else if (updateCheck == "fromUpdate") {
            $("#general_diagnosisupdate").append(diagnosis_tag);
          }

        }
      } else if (patientAge < 15) {
        for (var diag = 0; diag < diagnosisUn15.length; diag++) {
          var diagnosis_tag = $("<option></option>").text(diagnosisUn15[diag]).val(diagnosis_valueUn15[diag]);
          if (updateCheck == "click") {
            $("#general_diagnosis").append(diagnosis_tag);
          } else if (updateCheck == "fromUpdate") {
            $("#general_diagnosisupdate").append(diagnosis_tag);
          }
        }

      }

    } else if (updateCheck == "noclick") {
      $("#general_diagnosis option:not(:first)").remove();

    } else if (updateCheck == "noupdate") {
      $("#general_diagnosisupdate option:not(:first)").remove();

    }
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
      url: "{{ route('reception_road') }}",
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
          var but_ton1 = "<a  data-toggle='tab' href='#rpr' onclick='rpr_row_0(resp)' class='nav-link btn btn-warning'>" + "Update Data" + "</a>";
          var result_body1 =
            "<tr style='background-color:#A7DBD8;'" + "id='" + rowName + "'>" +
            "<td id='updateSerial1'>" + srNum + "</td>" +
            "<td >" + response[0][i]['Visit Date'] + "</td>" +
            "<td id='col_3'>" + response[0][i]['Pid'] + "</td>" +
            "<td>" + response[0][i]['FuchiaID'] + "</td>" +
            "<td>" + response[0][i]['PrEPCode'] + "</td>" +
            "<td >" + response[0][i]['Current Agey'] + "</td>" +
            "<td>" + response[0][i]["Gender"] + "</td>" +
            "<td  id='" + btnName + "'>" + "<button class='btn btn-info'style=';margin-right:10%' onclick='row_num()'" + "id=" + "rec_Fup_" + response[
              0][i]['id'] + ">Update" +
            "</button>" + "<button class='btn btn-danger' id=rec_Rev_" + response[0][i]['id'] + " onclick='row_num()'>Delete Row" +
            "</button>" + "</td>" +
            "</tr>";
          $("#followupHistory").append(result_body1);
        }



        if ($(window).width() < 1161 && $(window).width() > 599.9) {
          $("#followupHistory-tablet").empty();
          console.log("hello tablet cc");
          var result_body_tablet = "<ul class='clearfix'>" + "<li>" + 'General ID.- ' + "<b id='tablet_updateID'>" + response[0][0]['Pid'] + "</b>" +
            "</li>" + "<li>" + 'Fuchia ID- ' + response[0][0]['FuchiaID'] + "</li>" + "<li>" + 'PrEPCode- ' + response[0][0]['PrEPCode'] + "</li>" +
            "<li>" + 'Age- ' + response[0][0]['Agey'] + "</li>" + "<li>" + 'sex- ' + response[1] + "</li>" + "</ul>";
          $("#followupHistory-tablet").append(result_body_tablet);
          // result_body_tablet="<ul class='clearfix'>"+"<li>"+response[0][0]['Pid']+"</li>"+"<li>"+response[0][0]['FuchiaID']+"</li>"+"<li>"+response[0][0]['PrEPCode']+"</li>"+"<li>"+response[0][0]['Agey']+"</li>"+"<li>"+response[0][0]['Gender']+"</li>"+"</ul>";
          // $("#followupHistory-tablet").append(result_body_tablet);
          result_body_tablet = "<ul class='clearfix'>" + "<li>" + 'NO.' + "</li>" + "<li>" + 'Row ID' + "</li>" + "<li>" + 'Visit Date' + "</li>" +
            "<li>" + '' + "</li>" + "</ul>";
          $("#followupHistory-tablet").append(result_body_tablet);
          for (var i = 0; i < response[0].length; i++) {
            var srNum = i + 1;
            var btnName = "btn_" + i;
            var rowName = "ul_" + i;

            var result_body_tablet = "<ul class='clearfix'" + "id='" + rowName + "'>" + "<li>" + srNum + "</li>" + "<li>" + response[0][i]['id'] +
              "</li>" +
              "<li>" + response[0][i]['Visit Date'] + "</li>" +
              "<li id='" + btnName + "'>" + "<button onclick='row_num()' >" + "Update" + "</button>" + "</li>" + "</ul>";
            $("#followupHistory-tablet").append(result_body_tablet);
          }


        } else if ($(window).width() < 600) {
          $("#followupHistory-mobile").empty();

          var result_body_mobile = "<h5 style='display:inline-block;margin-right:4%;color:#b0d991'>" + "General Id-" + "</h5>" +
            "<b id='mobile_updateID'>" + response[0][0]['Pid'] + "</>"
          $("#followupHistory-mobile").append(result_body_mobile);
          result_body_mobile = "<ul class='clearfix'>" + "<li>" + 'NO.' + "</li>" + "<li>" + 'Visit Date' + "</li>" + "<li>" + 'Fuchia ID' + "</li>" +
            "</ul>";
          $("#followupHistory-mobile").append(result_body_mobile);


          for (var i = 0; i < response[0].length; i++) {
            var srNum = i + 1;

            var result_body_mobile = "<ul class='clearfix'>" + "<li>" + srNum + "</li>" + "<li>" +
              response[0][i]['Visit Date'] + "</li>" +
              "<li>" + response[0][i]['FuchiaID'] + "</li>" + "</ul>";
            $("#followupHistory-mobile").append(result_body_mobile);
          }

        }


      }
    });

  }

  function removeRow(id, Pid) {
    let remove_seq = {
      id: id,
      Pid: Pid,
      pointer: "followup_generals",
      notice: "Remove Patient Follow_up",
    }
    console.log(remove_seq)
    if (confirm("Are you sure you want to Delete?")) {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        }
      });
      $.ajax({
        type: 'POST',
        url: "{{ route('reception_road') }}",
        dataType: 'json',
        contentType: 'application/json',
        data: JSON.stringify(remove_seq),
        success: function(response) {

          if (response == "1") {
            alert("Successfull Delete")
            followupHistory();
          }
        }
      })
    }

  }

  function row_num() { // to get row ID from follow up History
    var parent = event.target.parentElement.id; // collecting id of the targeted parent
    var coparent = document.getElementById(parent).parentElement.id; // collecti
    text = event.target.id.match(/\d+/)[0];
    ptID = document.getElementById(coparent).childNodes[2].innerHTML;

    if ($(window).width() < 1161 && $(window).width() > 599.9) {
      ptID = document.getElementById("tablet_updateID").innerHTML;
    } else if ($(window).width() < 600) {
      ptID = document.getElementById("mobile_updateID").innerHTML;

    }
    if (event.target.textContent == "Update") {
      updateFiller(text, ptID);
    } else {
      removeRow(text, ptID)
    }


  }

  // function location ( 12 ) to fill data in new form
  function updateFiller(text, ptID) {

    rowNumber = text;

    var toUpdateFollowup = 1;
    var functionLoco = 12;
    var ckdata = {
      ptID: ptID,
      rowID: rowNumber,
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
      url: "{{ route('reception_road') }}",
      dataType: 'json',
      contentType: 'application/json',
      data: JSON.stringify(ckdata),
      success: function(response) {
        console.log(response);
        console.log("Filled");
        $("#updatePageView").show();

        document.getElementById("gid_toupdate").value = response[0][0]["Pid"];
        document.getElementById("clinic_code").value = response[0][0]["Clinic Code"];
        document.getElementById("fid_toupdate").value = response[0][0]["FuchiaID"];
        document.getElementById("prepCode_toupdate").value = response[0][0]["PrEPCode"];
        document.getElementById("vDate_toupdate").value = response[0][0]["Visit Date"];
        document.getElementById("agey_toupdate").value = response[0][0]["Current Agey"];
        document.getElementById("agem_toupdate").value = response[0][0]["Current Agem"];
        document.getElementById("gender_toupdate").value = response[1]["gender"];
        document.getElementById("follow_up_md_toupdate").value = response[0][0]["Follow_up_md"];
        document.getElementById("nDate_toupdate").value = response[0][0]["Next Appointment Date"];
        document.getElementById("remark_update").value = response[0][0]["Remark"];
        document.getElementById("current_md_update").value = response[0][0]["Current_MD"];
        document.getElementById("refer_feverupdate").value = response[1]["refer_fever"];

        $("#resDiaSecton2 div ul li select").prop("disabled", true);
        if (response[0][0]["Online"] != null) {
          document.getElementById("online_followupdate").value = response[0][0]["Online"];
        }

        var diag_check = [
          'phacheck', 'artcheck', 'prepcheck', 'pmtctcheck', 'anccheck', 'fmaplancheck', 'gneralcheck', 'ncdcheck', 'hivTBcheck', 'fcentercheck', 'labInvestcheck',
        ]
        var diag_select = ['pha_new_old', 'pha_cohort', 'prep_new_old', 'anc_new_old', 'art_new_old', 'art_cohort', 'pmtct_new_old', 'famaplan_new_old', 'general_new_old', 'general_diagnosis', 'OPD', 'feedcentre_new_old', 'ncd_new_old', 'ncd_diagnosis', 'ncd_drugSupply', 'hivTB_new_old', 'labInvest_new_old', ]
        age = $("#agey_toupdate").val();
        for (var i = 0; i < diag_check.length; i++) {
          $("#" + diag_check[i] + "update").prop('checked', false);
          if (response[2][diag_check[i]] == diag_check[i]) {
            $("#" + diag_check[i] + "update").prop('checked', true)
            var updat_checkID = $("#" + diag_check[i] + "update").parent().parent().attr('id')
            console.log(updat_checkID + "ok");
            $("#" + updat_checkID + " li select").prop("disabled", false);
          }
        }
        if ($("#gneralcheckupdate").is(":checked")) {
          updateCheck = "fromUpdate"
          generalCheck();
        } else {
          updateCheck = "noupdate"
          generalCheck();
        };
        if ($("#ncdcheckupdate").is(":checked")) {
          updateCheck = "fromUpdate"
          ncdCheck();
        } else {
          updateCheck = "noupdate"
          ncdCheck();
        }
        for (var diag_sel = 0; diag_sel < diag_select.length; diag_sel++) {
          $("#" + diag_select[diag_sel] + "update").val(response[2][diag_select[diag_sel]]);
        }
        $("#weight_update").val(response[1]["weight"]);
        $("#heigth_update").val(response[1]["height"]);
        $("#muac_update").val(response[1]["muac"]);

        //update check validation 
        pha_art_prepUPdateCheck();

        if (response[0][0]['Gender'] == "195997324") {
          $("#fmaplancheckupdate").prop("disabled", true);
          $("#anccheckupdate").prop("disabled", true);

          $("#pmtctcheckupdate").prop("disabled", true);
        }

        $("#mpox_yes_no_update").val(response[0][0]["Mpox_suspected"]);
        mox_update()
        $("#mpox_rash_yes_no_update").val(response[0][0]["Mpox_sus_rash"]);
        $("#mpox_fur_mx_update").val(response[0][0]["Mpox_mx"]);

        DateTo_text();

      }
    });




  }
  // function location ( 13 ) to save update data
  function update(button) {
    var f_up_update = 1;
    var functionLoco = 13;
    var clinic_code = document.getElementById("clinic_code").value;
    var updated_by = document.getElementById("navbarDropdown").innerHTML;
    var pid = document.getElementById("gid_toupdate").value;
    var fid = document.getElementById("fid_toupdate").value;
    var prepCode = document.getElementById("prepCode_toupdate").value;
    var vDate = document.getElementById("vDate_toupdate").value;
    vDate = formatDate(vDate); // Date formatChange function
    var agey = document.getElementById("agey_toupdate").value;
    var agem = document.getElementById("agem_toupdate").value;
    var follow_up_md = document.getElementById("follow_up_md_toupdate").value;
    var nDate = document.getElementById("nDate_toupdate").value;
    nDate = formatDate(nDate); // Date formatChange function
    var gender = document.getElementById("gender_toupdate").value;
    var weight = $("#weight_update").val();
    var height = $("#heigth_update").val();
    var muac = $("#muac_update").val();




    var f_up_data = {
      functionLoco: functionLoco,
      rowNumber: rowNumber,
      f_up_update: f_up_update,
      pid: pid,
      fid: fid,
      clinic_code: clinic_code,
      prepCode: prepCode,
      vDate: vDate,
      agey: agey,
      agem: agem,
      follow_up_md: follow_up_md,
      nDate: nDate,
      gender: gender,
      updated_by: updated_by,
      weight: weight,
      height: height,
      muac: muac,
      remark: $("#remark_update").val(),
      current_md: $("#current_md_update").val(),
      online: $("#online_followupdate").val(),

    };
    var diag_check = [
      'phacheck', 'artcheck', 'prepcheck', 'pmtctcheck', 'anccheck', 'fmaplancheck', 'gneralcheck', 'ncdcheck', 'hivTBcheck', 'fcentercheck', 'labInvestcheck',
    ]
    var diag_select = ['pha_new_old', 'pha_cohort', 'prep_new_old', 'anc_new_old', 'art_new_old', 'art_cohort', 'pmtct_new_old', 'famaplan_new_old', 'general_new_old', 'general_diagnosis', 'OPD', 'feedcentre_new_old', 'ncd_new_old', 'ncd_diagnosis', 'ncd_drugSupply', 'hivTB_new_old', 'labInvest_new_old', 'refer_fever', ]
    console.log(diag_select.length + "select")
    for (var i = 0; i < diag_check.length; i++) {
      if ($("#" + diag_check[i] + "update").prop('checked')) {
        f_up_data[diag_check[i]] = diag_check[i];

      } else {
        f_up_data[diag_check[i]] = ""
      }
    } //checkbox input collecting 
    for (var j = 0; j < diag_select.length; j++) {
      f_up_data[diag_select[j]] = $("#" + diag_select[j] + "update").val();
    } //selectbox data collecting
    f_up_data["mpox suspected"] = $("#mpox_yes_no_update").val();
    f_up_data["mpox rash"] = $("#mpox_rash_yes_no_update").val();
    f_up_data["mpox futher"] = $("#mpox_fur_mx_update").val();

    console.log(f_up_data);
    if (pid.length > 8 && ((agey > 0 && agey < 150 && agem == 0) || (agem > 0 && agem < 12 && agey == 0)) && vDate.length > 5 && gender.length > 2 &&
      diagnosis_validation("resDiaSecton2")) {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        }
      });
      $.ajax({
        type: 'POST',
        url: "{{ route('reception_road') }}",
        dataType: 'json',
        contentType: 'application/json',
        data: JSON.stringify(f_up_data),
        beforeSend: function() {
          $(button).prop("disabled", true);
          timeoutHandle = setTimeout(oneClick, 3000);
        },
        success: function(response) {
          $(button).prop("disabled", false);
          clearTimeout(timeoutHandle);
          alert("အချက်အလက်များ ပြင်ဆင်ဖြည့်သွင်းပြီးပါပြီ။");
          location.reload(true); // to refresh the page
          $("#updatePageView").hide();

          console.log(response);
        }

      });
    } else {
      alert("အချက်အလက်များ မပြည့်စုံသေးပါ။");
    }
  }



  function pha_art_prepUPdateCheck() {
    if ($("#phacheckupdate").is(":checked")) {
      $("#artcheckupdate,#prepcheckupdate").prop("disabled", true)

    } else if ($("#artcheckupdate").is(":checked")) {
      $("#phacheckupdate,#prepcheckupdate").prop("disabled", true)
    } else if ($("#prepcheckupdate").is(":checked")) {
      $("#phacheckupdate,#artcheckupdate").prop("disabled", true)
    } else {
      $("#phacheckupdate,#prepcheckupdate,#artcheckupdate").prop("disabled", false)
    }
  }

  function peerCode() {
    clearFacts()
    var peercode = document.getElementById("he_code").value;
    var he_code = document.getElementById("he_code").value;
    var cliniccode = document.getElementById("clinic_code").value;
    var yearcode = document.getElementById("year_code").value;
    var ptcode = document.getElementById("pt_code").value;
    let eyes_code = $("#eyes_code").val();
    var lenCode = 0;

    console.log(ptcode);

    if (ptcode.length == 6) {
      if (peercode == "0") {
        peercode = cliniccode + yearcode + ptcode;
      } else {
        peercode = peercode + cliniccode + yearcode + ptcode;
      }
      document.getElementById("gid").value = peercode;
    } else if (ptcode.length == 5) {
      ptcode = "0" + ptcode;
      if (peercode == "0") {
        peercode = cliniccode + yearcode + ptcode;
      } else {
        peercode = peercode + cliniccode + yearcode + ptcode;
      }
      document.getElementById("gid").value = peercode;
    } else if (ptcode.length == 4) {
      ptcode = "00" + ptcode;
      if (peercode == "0") {
        peercode = cliniccode + yearcode + ptcode;
      } else {
        peercode = peercode + cliniccode + yearcode + ptcode;
      }
      document.getElementById("gid").value = peercode;
    } else if (ptcode.length == 3) {
      ptcode = "000" + ptcode;
      if (peercode == "0") {
        peercode = cliniccode + yearcode + ptcode;
      } else {
        peercode = peercode + cliniccode + yearcode + ptcode;
      }
      document.getElementById("gid").value = peercode;

    } else if (ptcode.length == 2) {
      ptcode = "0000" + ptcode;
      if (peercode == "0") {
        peercode = cliniccode + yearcode + ptcode;
      } else {
        peercode = peercode + cliniccode + yearcode + ptcode;
      }
      document.getElementById("gid").value = peercode;

    } else if (ptcode.length == 1) {
      ptcode = "00000" + ptcode;
      if (peercode == "0") {
        peercode = cliniccode + yearcode + ptcode;
      } else {
        peercode = peercode + cliniccode + yearcode + ptcode;
      }
      document.getElementById("gid").value = peercode;


    } else {
      if (eyes_code.length == 0) {
        alert("General ID မှားနေပါသည်။");
      }
      console.log(eyes_code.length + "eye length");
      document.getElementById("pt_code").value = "";
      document.getElementById("gid").value = "";
      document.getElementById("pt_code").focus();
    }

    if (cliniccode == mam_clinicID && he_code == "0") {
      var nextID = $("#nextID").text();
      if (peercode.length == 10 && peercode > nextID) {
        alert("The new ID is greater than Next ID of the reception");
        location.reload();
      } else if (peercode < nextID || peercode == nextID) {
        if (peercode != 0) {
          document.getElementById("gid").value = peercode;
        }

      } else {
        alert("Wrong ID");
        //$("#gid).val()="" ;
        location.reload();
      }
    }
    ptData();

  }
</script>
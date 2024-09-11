@extends('layouts.app')

@section('content')
@auth
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('js/TB_js/tb-Reg-03.js') }}"></script>
<div class="container containers">
  <ul class="nav nav-tabs toggle"
    id="">
    <li class="nav-item">
      <a class="nav-link active toggle-link"
        data-toggle="pill"
        href="#Tb_registerForm">Tb_Register_03</a>
    </li>

    <li class="nav-item">
      <a class="nav-link  toggle-link"
        data-toggle="pill"
        href="#tb_export">Export</a>
    </li>

    <li class="nav-item">
      <a class="nav-link  toggle-link"
        data-toggle="pill"
        href="#tb_report">Report</a>
    </li>
  </ul>
  <div class="tab-content tb-parent-div">
    <div class="tab-pane tb-register03 active"
      id="Tb_registerForm">
      <div id="tb03_main">
        <div style="position: relative">
          <h2 class="header-text">
            TB Register_03
          </h2>
          <button class="btn btn-info tb03-history"
            id="tb03-history"
            onclick="view_history()">Follow Up</button>
          <label for=""
            id="count_follw"
            class="form-label count-follow"></label>
          <button class="btn refresh-follow tb03-refresh"
            id="tbo3_refresh"
            style="float:right">Refresh</button>
        </div>
        <div id="Tb_generalData">
          <div class="row">
            <div class="col-sm-2 TB-idChange"
              id="ID_changeBlock">
              <input type="checkbox"
                id="TBid_change"
                disabled="true">
              <label class="form-label">ID change?</label>
            </div>
            <div class="col-sm-3 TB-idChange"
              id="new_RC_Block">
              <input type="checkbox"
                id="TBexit_newRec"
                name="sameIdNewRc"
                onclick="same_ID_newRc()">
              <label class="form-label">Same ID New Record</label>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <div class="input-group mb-3 tb-generalCode">
                <input type="number"
                  id="TB03_pid"
                  class="form-control"
                  placeholder="General ID">
                <input type="text"
                  id="TB03_fuchiaId"
                  class="form-control"
                  placeholder="Fuchia ID">
                <input type="text"
                  id="TB03_id"
                  class="form-control"
                  placeholder="Township TB Reg Number">
                <button class="btn btn-primary"
                  onclick="findTB03_patient()"
                  type="button">Search</button>
              </div>
            </div>
            <div class="col-sm-3">
              <label for="validationCustom01"
                class="form-label">Register Age</label>
              <span id="TB03_age"
                type="number"
                class="form-control"></span>
            </div>
            <div class="col-sm-3">
              <label for="validationCustom01"
                class="form-label">Reg Age(Month)</label>
              <span id="TB03_regMonth"
                class="form-control"></span>
            </div>
            <div class="col-sm-3">
              <label for="validationCustom01"
                class="form-label">Current Age</label>
              <input type='number' id="agey"
                class="form-control" disabled>
            </div>
            <div class="col-sm-3">
              <label for="validationCustom01"
                class="form-label">Current Age(Month)</label>
              <input type='number' id="agem"
                class="form-control" disabled>
            </div>
            <div class="col-sm-2">
              <label for="validationCustom01"
                class="form-label">Sex</label>
              <span id="TB03_gender"
                class="form-control"></span>
            </div>

            <div class="col-sm-2 tb-region">
              <label for="validationCustom02"
                class="form-label">State/ Region</label>
              <span class="form-control"
                id="TB03_state"></span>
            </div>
            <div class="col-sm-2 tb-township">
              <label for="validationCustom02"
                class="form-label">Township</label>
              <span class="form-control"
                id="TB03_town"></span>
            </div>
          </div>
        </div>
        <div id="tb_info">

          <div class="row">
            <div class="col-sm-2">
              <label for="validationCustom01"
                class="form-label">Treatment Date</label>
              <div class="date-holder">
                <input type="text"
                  class="form-control Gdate"
                  id="TB03_tremDate"
                  placeholder="dd-mm-yyyy">
                <img src="../img/calendar3.svg"
                  class="dateimg"
                  alt="date">
              </div>
            </div>
            <div class="col-sm-2">
              <label for="validationCustom01"
                class="form-label">Nationality</label>
              <select class="form-control"
                id="TB03_nationality"
                name="">
                <option value=""></option>
                <option value="N">N</option>
                <option value="NN">NN</option>
              </select>
            </div>
            <div class="col-sm-4">
              <label for="validationCustom01"
                class="form-label">Facility name</label>
              <select class="form-control"
                id="TB03_facility"
                name="">
                <option value=""></option>
                <option value="AHRN (Kachin) WM, PK, BM">AHRN (Kachin) WM, PK, BM</option>
                <option value="AHRN (Shan North) Laukkai, Lashio">AHRN (Shan North) Laukkai, Lashio</option>
                <option value="MDM, (Myitkyina, Mokaung, Moenyin)">MDM, (Myitkyina, Mokaung, Moenyin)</option>
                <option value="MDM, Ygn (Hlaing)">MDM, Ygn (Hlaing)</option>
                <option value="MAM">MAM</option>
                <option value="MMA">MMA</option>
                <option value="MSF-CH (Dawei)">MSF-CH (Dawei)</option>
                <option value="MSF-H (Kachin)Myitkyina, WM, Phaknt, BM, MK)">MSF-H (Kachin)(Myitkyina, WM, Phaknt, BM,
                  MK)</option>
                <option value="MSF-H (Rakhine)">MSF-H (Rakhine)</option>
                <option value="MSF-H (Shan-north) Muse, Lashio">MSF-H (Shan-north) Muse, Lashio</option>
                <option value="MSF-H (Yangon) Insein, Tharketa">MSF-H (Yangon) Insein, Tharketa</option>

              </select>
            </div>
            <div class="col-sm-2">
              <label for="validationCustom01"
                class="form-label">Reporting Period</label>
              <select class="form-control"
                id="TB03_reportPeriod"
                name="">
                <option value=""></option>
                <option value="1st_Qtr">1st Qtr</option>
                <option value="2nd_Qtr">2nd Qtr</option>
                <option value="3rd_Qtr">3rd Qtr</option>
                <option value="4th_Qtr">4th Qtr</option>
              </select>
            </div>
            <div class="col-sm-2">
              <label for="validationCustom01"
                class="form-label">Transfer in</label>
              <select class="form-control"
                id="TB03_transfer"
                name="">
                <option value=""></option>
                <option value="Y">Yes</option>
                <option value="N">No</option>
              </select>
            </div>
          </div>
          <div class="row"
            id="TB03_locate">
            <div class="col-sm-2">
              <label for="validationCustom01"
                class="form-label">Refer From</label>
              <select class="form-control"
                id="TB03_referFrom"
                name="">
                <option value=""></option>
                <option value="AHRN">AHRN</option>
                <option value="ARC">ARC</option>
                <option value="BHS/PHS">BHS/PHS</option>
                <option value="Community Volunteer">Community Volunteer</option>
                <option value="DM Clinic">DM Clinic</option>
                <option value="Drug Seller">Drug Seller</option>
                <option value="IOM">IOM</option>
                <option value="KPHW">KPHW</option>
                <option value="MAM">MAM</option>
                <option value="MHAA">MHAA</option>
                <option value="MMA">MMA</option>
                <option value="MMCWA">MMCWA</option>
                <option value="MNCH">MNCH</option>
                <option value="Mobile Team">Mobile Team</option>
                <option value="MRCS">MRCS</option>
                <option value="MWAF">MWAF</option>
                <option value="PPM Hosp">PPM Hosp</option>
                <option value="Union">Union</option>
                <option value="HPA">HPA</option>
                <option value="EHO">EHO</option>
                <option value="STD/NAP">STD/NAP</option>
                <option value="GP">GP</option>
                <option value="Top Center">Top Center</option>
                <option value="World Vision">World Vision</option>
                <option value="Public Hosp">Public Hosp</option>
                <option value="Private Hosp">Private Hosp</option>
                <option value="Prison">Prison</option>
                <option value="PSI">PSI</option>
                <option value="SMRU">SMRU</option>
                <option value="SR2">SR2</option>
                <option value="SR4">SR4</option>
                <option value="Self">Self</option>
              </select>
            </div>
            <div class="col-sm-2">
              <label for="validationCustom01"
                class="form-label">Type of Patient's</label>
              <select class="form-control"
                id="TB03_typePatient"
                name="">
                <option value=""></option>
                <option value="N">N</option>
                <option value="R">R</option>
                <option value="F">F</option>
                <option value="L">L</option>
                <option value="O">O</option>
                <option value="U">U</option>
              </select>
            </div>
            <div class="col-sm-2">
              <label for="validationCustom01"
                class="form-label">TB Site</label>
              <select class="form-control"
                id="TB03_site"
                name="">
                <option value=""></option>
                <option value="P">P</option>
                <option value="EP">EP</option>
                <option value="EP-TBM">EP-TBM</option>
              </select>
            </div>
            <div class="col-sm-2">
              <label for="validationCustom01"
                class="form-label">Treatment Regimens</label>
              <select class="form-control"
                id="TB03_treRegimens"
                name="">
                <option value=""></option>
                <option value="I">I</option>
                <option value="R">R</option>
                <option value="C">C</option>
                <option value="M">M</option>
              </select>
            </div>
            <div class="col-sm-2">
              <label for="validationCustom01"
                class="form-label">Smoking Status</label>
              <select class="form-control"
                id="TB03_smoke"
                name="">
                <option value=""></option>
                <option value="C">C</option>
                <option value="P">P</option>
                <option value="N">N</option>
                <option value="U">U</option>
              </select>
            </div>
            <div class="col-sm-2">
              <label for="validationCustom01"
                class="form-label">DM Status</label>
              <select class="form-control"
                id="TB03_dm"
                name="">
                <option value=""></option>
                <option value="Y">Yes</option>
                <option value="N">No</option>
                <option value="U">Unknow</option>
              </select>
            </div>
            <div class="col-sm-12">
              <label for="validationCustom01"
                class="form-label">Specify _(if EP)/Site of EPTB</label>
              <input id="TB03_EPTB"
                type="text"
                class="form-control">
            </div>
          </div>
          <div class="row tb_essential"
            id="TB03_essentialData">
            <div class="row tb_hivActivites">
              <h3 class="header-text">TB/HIV Activites</h3>

              <div class="col-sm-2">
                <label for="validationCustom01"
                  class="form-label">HIV Status</label>
                <select class="form-control"
                  id="TB03_hiv"
                  name="">
                  <option value=""></option>
                  <option value="P">Positive</option>
                  <option value="N">Negative</option>
                  <option value="U">Unknow</option>
                </select>
              </div>
              <div class="col-sm-3">
                <label for="validationCustom01"
                  class="form-label">ART Start Date</label>
                <div class="date-holder">
                  <input type="text"
                    class="form-control Gdate"
                    id="TB03_ART"
                    placeholder="dd-mm-yyyy">
                  <img src="../img/calendar3.svg"
                    class="dateimg"
                    alt="date">
                </div>
              </div>
              <div class="col-sm-3">
                <label for="validationCustom01"
                  class="form-label">CPT Start Date</label>
                <div class="date-holder">
                  <input type="text"
                    class="form-control Gdate"
                    id="TB03_CPT"
                    placeholder="dd-mm-yyyy">
                  <img src="../img/calendar3.svg"
                    class="dateimg"
                    alt="date">
                </div>
              </div>
            </div>

          </div>
          <div class="row tb_sartDiag">
            <h3 class="header-text">At the time of TB Diagnosis</h3>
            <div class="col-sm-3">
              <label for="validationCustom01"
                class="form-label">Microscope Result</label>
              <select class="form-control"
                id="TB03_microscope"
                name="">
                <option value=""></option>
                <option value="P">Positive</option>
                <option value="N">Negative</option>
                <option value="U">Unknow</option>
              </select>
            </div>
            <div class="col-sm-3">
              <label for="validationCustom01"
                class="form-label">XRay Result</label>
              <select class="form-control"
                id="TB03_Xray"
                name="">
                <option value=""></option>
                <option value="N">Normal</option>
                <option value="A">Active TB</option>
                <option value="O">Abnormal Other > TB</option>
                <option value="ND">Not Done</option>
              </select>
            </div>
            <div class="col-sm-3">
              <label for="validationCustom01"
                class="form-label">Xpert Result</label>
              <select class="form-control"
                id="TB03_Xpert"
                name="">
                <option value=""></option>
                <option value="N">N</option>
                <option value="I">I</option>
                <option value="T">T</option>
                <option value="RR">RR</option>
                <option value="TI">TI</option>
                <option value="TT">TT</option>
              </select>
            </div>

            <div class="col-sm-3">
              <label for="validationCustom01"
                class="form-label">Culture Result</label>
              <select class="form-control"
                id="TB03_culture"
                name="">
                <option value=""></option>
                <option value="N">N</option>
                <option value="S">S</option>
                <option value="P">P</option>
                <option value="NT">NT</option>
                <option value="C">C</option>
              </select>
            </div>
            <div class="col-sm-3">
              <label for="validationCustom01"
                class="form-label">Counsellor Name</label>
              <select class="form-select"
                id="TB03_counselor"
                required="">
                <option value=""></option>
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
            <div class="col-sm-3">
              <label for="validationCustom01"
                class="form-label">bacteriological/clinical</label>
              <input id="TB03_bactlogical"
                type="text"
                class="form-control">
            </div>
          </div>

          <div class="row"
            id="tb_time">
            <div class="row">
              <div class="col-sm-2">
                <button class="tb-time-Tab"
                  id="tb-m2">Month 2</button>
              </div>
              <div class="col-sm-2">
                <button class="tb-time-Tab"
                  id="tb-m3">Month 3</button>
              </div>
              <div class="col-sm-2">
                <button class="tb-time-Tab"
                  id="tb-m5">Month 5</button>
              </div>
              <div class="col-sm-2">
                <button class="tb-time-Tab"
                  id="tb-endDiag">End Treatment</button>
              </div>
            </div>
            <div class="col-md-6 tb-m2">
              <div class="row ">
                <h3 class="header-text">Month 2 Result</h3>
                <div class="col-sm-4">
                  <label for="validationCustom01"
                    class="form-label">Microscope</label>
                  <select class="form-control"
                    id="TB03_2ndmicroscope"
                    name="">
                    <option value=""></option>
                    <option value="P">Positive</option>
                    <option value="N">Negative</option>
                    <option value="U">Unknow</option>
                  </select>
                </div>
                <div class="col-sm-4">
                  <label for="validationCustom01"
                    class="form-label">Xpert</label>
                  <select class="form-control"
                    id="TB03_2ndXpert"
                    name="">
                    <option value=""></option>
                    <option value="N">N</option>
                    <option value="I">I</option>
                    <option value="T">T</option>
                    <option value="RR">RR</option>
                    <option value="TI">TI</option>
                  </select>
                </div>
                <div class="col-sm-4">
                  <label for="validationCustom01"
                    class="form-label">Culture</label>
                  <select class="form-control"
                    id="TB03_culture_m2"
                    name="">
                    <option value=""></option>
                    <option value="N">N</option>
                    <option value="S">S</option>
                    <option value="P">P</option>
                    <option value="NT">NT</option>
                    <option value="C">C</option>
                  </select>
                </div>
              </div>

            </div>

            <div class="col-md-6 tb-m3">
              <h3 class="header-text">Month 3 Result</h3>
              <div class="row">
                <div class="col-sm-4">
                  <label for="validationCustom01"
                    class="form-label">Microscope</label>
                  <select class="form-control"
                    id="TB03_3rdmicroscope"
                    name="">
                    <option value=""></option>
                    <option value="P">Positive</option>
                    <option value="N">Negative</option>
                    <option value="U">Unknow</option>
                  </select>
                </div>
                <div class="col-sm-4">
                  <label for="validationCustom01"
                    class="form-label">Xpert</label>
                  <select class="form-control"
                    id="TB03_3rdXpert"
                    name="">
                    <option value=""></option>
                    <option value="N">N</option>
                    <option value="I">I</option>
                    <option value="T">T</option>
                    <option value="RR">RR</option>
                    <option value="TI">TI</option>
                  </select>
                </div>
                <div class="col-sm-4">
                  <label for="validationCustom01"
                    class="form-label">Culture</label>
                  <select class="form-control"
                    id="TB03_culture_m3"
                    name="">
                    <option value=""></option>
                    <option value="N">N</option>
                    <option value="S">S</option>
                    <option value="P">P</option>
                    <option value="NT">NT</option>
                    <option value="C">C</option>
                  </select>
                </div>
              </div>

            </div>

            <div class="col-md-6 tb-m5">
              <h3 class="header-text">Month 5 Result</h3>
              <div class="row">
                <div class="col-sm-4">
                  <label for="validationCustom01"
                    class="form-label">Microscope</label>
                  <select class="form-control"
                    id="TB03_5thmicroscope"
                    name="">
                    <option value=""></option>
                    <option value="P">Positive</option>
                    <option value="N">Negative</option>
                    <option value="U">Unknow</option>
                  </select>
                </div>
                <div class="col-sm-4">
                  <label for="validationCustom01"
                    class="form-label">Xpert</label>
                  <select class="form-control"
                    id="TB03_5thXpert"
                    name="">
                    <option value=""></option>
                    <option value="N">N</option>
                    <option value="I">I</option>
                    <option value="T">T</option>
                    <option value="RR">RR</option>
                    <option value="TI">TI</option>
                  </select>
                </div>
                <div class="col-sm-4">
                  <label for="validationCustom01"
                    class="form-label">Culture</label>
                  <select class="form-control"
                    id="TB03_culture_m5"
                    name="">
                    <option value=""></option>
                    <option value="N">N</option>
                    <option value="S">S</option>
                    <option value="P">P</option>
                    <option value="NT">NT</option>
                    <option value="C">C</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="col-md-6 tb-endDiag">
              <h3 class="header-text">End of Treatment</h3>
              <div class="row">
                <div class="col-sm-4">
                  <label for="validationCustom01"
                    class="form-label"> Microscope</label>
                  <select class="form-control"
                    id="TB03_endmicroscope"
                    name="">
                    <option value=""></option>
                    <option value="P">Positive</option>
                    <option value="N">Negative</option>
                    <option value="U">Unknow</option>
                  </select>
                </div>
                <div class="col-sm-4">
                  <label for="validationCustom01"
                    class="form-label">XRay</label>
                  <select class="form-control"
                    id="TB03_endXray"
                    name="">
                    <option value=""></option>
                    <option value="N">Normal</option>
                    <option value="A">Active TB</option>
                    <option value="O">Abnormal Other > TB</option>
                    <option value="ND">Not Done</option>
                  </select>
                </div>
                <div class="col-sm-4">
                  <label for="validationCustom01"
                    class="form-label">Xpert</label>
                  <select class="form-control"
                    id="TB03_endXpert"
                    name="">
                    <option value=""></option>
                    <option value="N">N</option>
                    <option value="I">I</option>
                    <option value="T">T</option>
                    <option value="RR">RR</option>
                    <option value="TI">TI</option>
                  </select>
                </div>

              </div>

            </div>
            <div class="col-sm-2">
              <label for=""
                class="form-label">1st line DST</label>
              <select name=""
                id="1st_dst"
                class="form-select">
                <option value=""></option>
                <option value="R">R</option>
                <option value="S">S</option>
                <option value="C">C</option>
                <option value="NA">NA</option>
              </select>
            </div>
            <div class="col-sm-2">
              <label for="validationCustom01"
                class="form-label">Treatment Outcome</label>
              <select class="form-control"
                id="TB03_outcome"
                name="">
                <option value=""></option>
                <option value="C">C</option>
                <option value="TC">TC</option>
                <option value="F">F</option>
                <option value="D">D</option>
                <option value="LFU">LFU</option>
                <option value="N">N</option>
                <option value="SLD">SLD</option>
              </select>
            </div>
            <div class="col-sm-3">
              <label for="validationCustom01"
                class="form-label">Initial Regimen Started Date</label>
              <div class="date-holder">
                <input type="text"
                  class="form-control Gdate"
                  id="TB03_IRSD"
                  placeholder="dd-mm-yyyy">
                <img src="../img/calendar3.svg"
                  class="dateimg"
                  alt="date">
              </div>
            </div>
            <div class="col-sm-2">
              <label for="validationCustom01"
                class="form-label">Outcome Date</label>
              <div class="date-holder">
                <input type="text"
                  class="form-control Gdate"
                  id="TB03_outDate"
                  placeholder="dd-mm-yyyy">
                <img src="../img/calendar3.svg"
                  class="dateimg"
                  alt="date">
              </div>
            </div>

            <div class="col-sm-3">
              <label for="validationCustom01"
                class="form-label">Estimated Outcome Date</label>
              <div class="date-holder">
                <input type="text"
                  class="form-control Gdate"
                  id="TB03_EoutDate"
                  placeholder="dd-mm-yyyy">
                <img src="../img/calendar3.svg"
                  class="dateimg"
                  alt="date">
              </div>
            </div>
            <div class="col-sm-12">
              <label for="validationCustom01"
                class="form-label">Remark</label>
              <input id="TB03_remark"
                type="text"
                class="form-control">
            </div>

          </div>
          <div class="row"
            style="justify-content:center">
            <div class="col-sm-2">
              <button class="btn btn-info TB-button"
                onclick="TB03_saveUp(this)"
                disabled="true">Register-TB-03</button>
            </div>
          </div>
        </div>

      </div>
      <div id="tb03_history"
        style="display: none">
        <table class="table  table-bordered">
          <thead>
            <tr>
              <th>NO.</th>
              <th>General ID</th>
              <th>Treatment Date</th>
              <th>Out Come Result</th>
              <th>Out Come Date</th>
              <th><button class="btn btn-info"
                  id="TB03_retrun">Main page</button></th>
            </tr>
          </thead>
          <tbody></tbody>
        </table>
      </div>

    </div>
    <div class="tab-pane fade"
      id="tb_report">
      <h2 class="header-text">Report TB</h2>
      <form action="{{ route('tb03_data') }}"
        method="POST">
        @csrf
        <div class="row export-div">
          <div class="col-sm-2">
            <label class="form-label">Select Report Type</label>
            <select class="form-select tb-03-report"
              name="TB_03_report">
              <option value="TB_O7">TB-O7</option>
              <option value="TB_O8">TB-O8</option>
              <option value="TB_03_IPT">TB-IPT</option>
            </select>
          </div>
          <div class="col-sm-2">
            <label class="form-label">Form</label>
            <div class="date-holder">
              <input type="text"
                class="form-control Gdate"
                name="dateFrom"
                id="tb_exportStart"
                placeholder="dd-mm-yyyy">
              <img src="../img/calendar3.svg"
                class="dateimg"
                alt="date">
            </div>
          </div>
          <div class="col-sm-2">
            <label class="form-label">To</label>
            <div class="date-holder">
              <input type="text"
                class="form-control Gdate"
                name="dateTo"
                id="tb_exportEnd"
                placeholder="dd-mm-yyyy">
              <img src="../img/calendar3.svg"
                class="dateimg"
                alt="date">
            </div>
          </div>
          <div class="col-sm-2">
            <select class="form-select TB-03-report-type"
              name="TB_03_report_type">
              <option value=""></option>
              <option value="Report_view">Only Report View</option>
            </select>
          </div>
          <div class="col-sm-2">
            <button class="btn btn-info tb-reBtn">Report</button>
          </div>
          <div class="col-sm-1"
            style="display:none">
            <input value="TB 03 Report"
              name="notice">
          </div>

        </div>

      </form>
      <!-- export date -->

    </div>

    <div class="tab-pane fade"
      id="tb_export">
      <h2 class="header-text">TB 03 Export</h2>
      <form action=""
        method="post">
        @csrf
        <div class="row export-div">
          <div class="col-sm-2">
            <label class="form-label">form</label>
            <div class="date-holder">
              <input type="text"
                class="form-control Gdate"
                id="tb_03_exportFrom"
                name="dateFrom"
                placeholder="dd-mm-yyyy">
              <img src="../img/calendar3.svg"
                class="dateimg"
                alt="date">
            </div>
          </div>
          <div class="col-sm-2">
            <label class="form-label">To</label>
            <div class="date-holder">
              <input type="text"
                class="form-control Gdate"
                id="tb_03_exportTo"
                name="dateTo"
                placeholder="dd-mm-yyyy">
              <img src="../img/calendar3.svg"
                class="dateimg"
                alt="date">
            </div>
          </div>
          <div class="col-sm-2">
            <button class="btn btn-info tb-exBtn">Export</button>
          </div>
          <div class="col-sm-1"
            style="display:none">
            <input value="TB 03 Export"
              name="notice">
          </div>
        </div>
      </form>
    </div>

  </div>

</div>
@endauth
@endsection
<script type="text/javascript">
  // count input 41
  let clinic_Code = "";
  let tB03_UP = "",
    updateRid, TB03_hisData;
  var Tbexit_id = [
    'TNumber_TB03', "TB03_id",
    'Age_TB03', "TB03_age",
    'Gender', "TB03_gender",
    'TreDate_TB03', "TB03_tremDate",
    'State_TB03', "TB03_state",
    'Township_TB03', "TB03_town",
    'Nationality_TB03', "TB03_nationality",
    'FaciName_TB03', "TB03_facility",
    'RePariod_TB03', "TB03_reportPeriod",
    'TranferIn_TB03', "TB03_transfer",
    'ReferFrom_TB03', "TB03_referFrom",
    'TypePatient_TB03', "TB03_typePatient",
    'TBsite_TB03', "TB03_site",
    'EPTBsite_TB03', "TB03_EPTB",
    'TreRegimens_TB03', "TB03_treRegimens",
    'Smoke_status_TB03', "TB03_smoke",
    'DMstatue_TB03', "TB03_dm",
    'Hivstatus_TB03', "TB03_hiv",
    'ART_start_TB03', "TB03_ART",
    'CPT_start_TB03', "TB03_CPT",
    'Microscope_Res_TB03', "TB03_microscope",
    'Xpert_Res_TB03', "TB03_Xpert",
    'XRay_Res_TB03', "TB03_Xray",
    'Calture_Res_TB03', "TB03_culture",
    'Counsellor_TB03', "TB03_counselor",
    'BioClinical_TB03', "TB03_bactlogical",
    '2ndMicroscope_Res_TB03', "TB03_2ndmicroscope",
    '2ndXpert_Res_TB03', "TB03_2ndXpert",
    '2ndCulture_Res_TB03', 'TB03_culture_m2',
    '3rdMicroscope_Res_TB03', "TB03_3rdmicroscope",
    '3rdXpert_Res_TB03', "TB03_3rdXpert",
    '3rdCulture_Res_TB03', 'TB03_culture_m3',
    '5rdMicroscope_Res_TB03', "TB03_5thmicroscope",
    '5rdXpert_Res_TB03', "TB03_5thXpert",
    '5rdCulture_Res_TB03', 'TB03_culture_m5',
    'EndTX_Microscope_Res_TB03', "TB03_endmicroscope",
    'EndTX_XRay_Res_TB03', "TB03_endXray",
    'EndTX_Xpert_Res_TB03', "TB03_endXpert",
    '1stDst', '1st_dst',
    'TrementOut_TB03', "TB03_outcome",
    'Intial_RegimenDate_TB03', "TB03_IRSD",
    'TrementOut_Date_TB03', "TB03_outDate",
    'EstimentOut_Date_TB03', "TB03_EoutDate",
    'Remark_TB03', "TB03_remark",
  ]
  let tb03_regDate;
  let tb03_Dob;

  function findTB03_patient() {
    var Pid03 = $("#TB03_pid").val();
    var Fid03 = $("#TB03_fuchiaId").val();
    var TB03_Id = $("#TB03_id").val();
    var ID_change = "";
    if ($("#TBid_change").is(":checked")) {
      ID_change = "yes";
    }
    var Fid03 = {
      Pid03: Pid03,
      Fid03: Fid03,
      TB03_Id: TB03_Id,
      ID_change: ID_change,
      notice: "Find TB03 patient"
    }
    console.log(Fid03);
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
      }
    });
    $.ajax({
      type: 'POST',
      url: "{{ route('tb03_data') }}",
      dataType: 'json',
      //  processData:false,
      contentType: 'application/json',
      data: JSON.stringify(Fid03),
      success: function(response) {
        console.log(response);
        console.log(response.length);
        $("#tb03_remove").show()
        $("#tb03-history").show()
        if (response[0] !== null) {
          $("#tb_info .TB-button").prop("disabled", false);
          clinic_Code = response[0]['Clinic Code'];
          $("#TB03_pid").val(response[0]['Pid']);
          $("#TB03_fuchiaId").val(response[0]['FuchiaID']);
          $("#TB03_town").text(response[0]['Township']);
          $("#TB03_state").text(response[0]['Region']);
          $("#TB03_age").text(response[0]['Agey']);
          $("#TB03_regMonth").text(response[0]['Agem']);
          $("#TB03_gender").text(response[0]['Gender']);
          tb03_regDate = response[0]['Reg Date'];
          tb03_Dob = response[0]['Date of Birth'];


          if (ID_change != "yes") {
            $("#tb_info .TB-button").text("Register-TB-03");
            $("#Tb_registerForm h2").text("TB Register_03");
          }

        } else {
          alert("Your ID is not register")
          $("#tb03_remove").hide();
        }

        let tb_transation = response[1].length;
        TB03_hisData = response[1];
        $(".history_row").remove();
        $("#count_follw").text("Follow Up- " + TB03_hisData.length);
        TB03_hisData.forEach(function(value, index) {
          let tb03his_detail = $("<tr class='history_row'>")
            .append($("<td>").text(Number(index) + 1))
            .append($("<td>").text(value["Pid_TB03"]))
            .append($("<td>").text(value["TreDate_TB03"]))
            .append($("<td>").text(value["TrementOut_Date_TB03"]))
            .append($("<td>").text(value["TrementOut_TB03"]))
            .append($("<td>").append($("<button class='btn btn-info' onclick='Tb03_viewDeatail()' id='detail_" + index + "'>").text("Detail"))
              .append($("<button class='btn btn-danger' onclick='TB03_remove()'id='remove_" + index + "'>").text("Delete")));
          $("#tb03_history table tbody").append(tb03his_detail);
        });

        if (tb_transation > 0 && response[1][tb_transation - 1]["TrementOut_TB03"] == null && response[1][tb_transation - 1]["TrementOut_Date_TB03"] == null) {
          for (var i = 0; i < Tbexit_id.length; i++) {

            if ($("#" + Tbexit_id[i + 1]).is("input,select")) {
              $("#" + Tbexit_id[i + 1]).val(response[1][tb_transation - 1][Tbexit_id[i]]);
              i = i + 1;
            } else if ($("#" + Tbexit_id[i + 1]).is("select")) {
              $("#" + Tbexit_id[i + 1]).text(response[1][tb_transation - 1][Tbexit_id[i]]);
              i = i + 1;
            }
          }

          $("#Tb_registerForm h2").text("Existing TB Register_03");
          $("#tb_info .TB-button").text("Update TB_03")
          $("#Tb_registerForm .tb-generalCode").children().prop("disabled", function(index) {
            return index !== 2;
          });
          DateTo_text();
          net_age(response[0]['Reg Date'], response[0]['Date of Birth'], $('#TB03_tremDate').val());

          tB03_UP = "Update 03";
          updateRid = response[1][tb_transation - 1]["id"];
          clinic_Code = response[1][tb_transation - 1]["Clinic_code"];

        }





      }

    });
  }

  function TB03_remove() {
    updateRid = event.target.id.match(/\d+/)[0];
    remvoe_data = {
      Pid: $(event.target).parent().siblings().eq(1).text(),
      id: TB03_hisData[updateRid]["id"],
      notice: "Remvoe TB03"
    }
    console.log(remvoe_data);
    if (confirm("Are you sure delete this data")) {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        }
      });
      $.ajax({
        type: 'POST',
        url: "{{ route('tb03_data') }}",
        dataType: 'json',
        //  processData:false,
        contentType: 'application/json',
        data: JSON.stringify(remvoe_data),
        success: function(response) {
          console.log(response);
          if (response == 1) {
            alert("Success Delete")
            $("#TB03_pid").val($(event.target).parent().siblings().eq(1).text());
            findTB03_patient();
          } else {
            alert("Wrong permission")
          }
        }
      })
    }
  }

  function TB03_saveUp(button) {
    let TB03_data = {},
      TB_03Exist = "";
    $("#Tb_registerForm input,#Tb_registerForm select,#Tb_registerForm span").each(function(index) {
      var Tb03_name = $(this).attr('id');
      TB03_data["notice"] = "TB_03 Register";

      if (tB03_UP == "Update 03") {
        TB03_data["notice"] = "TB_03 Update";
        TB03_data["Rid"] = updateRid;
      }

      if ($(this).is("input,select")) {
        if ($(this).is("input") && $(this).hasClass("Gdate")) {
          TB03_data[Tb03_name] = formatDate($(this).val());
        } else {
          TB03_data[Tb03_name] = $(this).val();
        }
      } else if ($(this).is("span")) {
        TB03_data[Tb03_name] = $(this).text();
      }
      console.log(Tb03_name)
    })
    TB03_data["Clinic Code"] = clinic_Code;


    console.log(Object.keys(TB03_data).length);
    console.log(Object.keys(TB03_data))
    console.log(TB03_data)
    console.log("TB 03 save");
    if (TB03_data["TB03_gender"] == "Female") {
      TB03_data["TB03_gender"] = "F"
    } else {
      TB03_data["TB03_gender"] = "M"
    }
    if ($("#TBexit_newRec").prop('checked') == true) {
      TB03_data["SameID"] = 1;
    } else {
      TB03_data["SameID"] = 0;
    }

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
      }
    });
    $.ajax({
      type: 'POST',
      url: "{{ route('tb03_data') }}",

      dataType: 'json',
      contentType: 'application/json',
      data: JSON.stringify(TB03_data),
      beforeSend: function() {
        $(button).prop("disabled", true);
        timeoutHandle = setTimeout(oneClick, 3000);
      },
      success: function(response) {
        $(button).prop("disabled", false);
        clearTimeout(timeoutHandle);
        console.log(response);
        if (response == "No save") {
          alert(response);
        } else {
          alert("successfully")
          history.go(0);
        }



      }
    })
  }

  function view_history() {
    $("#tb03_history").show();
    $("#tb03_main").hide();
    console.log(TB03_hisData)

  }

  function Tb03_viewDeatail() {
    $("#tb_info input,#tb_info select").val("");
    $("#tb03_history").hide();
    $("#tb03_main").show();
    $(".TB-idChange input[type='checkbox']").prop("disabled", false);
    updateRid = event.target.id.match(/\d+/)[0];
    for (var i = 0; i < Tbexit_id.length; i++) {
      if ($("#" + Tbexit_id[i + 1]).is("input,select")) {
        $("#" + Tbexit_id[i + 1]).val(TB03_hisData[updateRid][Tbexit_id[i]]);
        i = i + 1;
      } else if ($("#" + Tbexit_id[i + 1]).is("select")) {
        $("#" + Tbexit_id[i + 1]).text(TB03_hisData[updateRid][Tbexit_id[i]]);
        i = i + 1;
      }
    }
    $("#Tb_registerForm h2").text("Update TB Register_03");
    $("#tb_info .TB-button").text("Update TB_03");
    $("#Tb_registerForm .tb-generalCode").children().prop("disabled", function(index) {
      return index !== 2;
    });
    tB03_UP = "Update 03";
    $(".TB-idChange input[type='checkbox']").prop("checked", false);
    $(".TB-idChange").show();
    updateRid = TB03_hisData[updateRid]['id'];
    DateTo_text();
    net_age(tb03_regDate, tb03_Dob, $("#TB03_tremDate").val());
  }

  function same_ID_newRc() {
    let org_tB03_UP = tB03_UP
    if ($("#TBexit_newRec").is(":checked")) {
      $("#tb_info input,#tb_info select").val("");
      $("#tb_info .TB-button").text("Register-TB-03");
      $("#Tb_registerForm h2").text("TB Register_03");
      $("#ID_changeBlock").hide();
      tB03_UP = "";
      alert("To add new record without outcome in old records.")
    } else {
      $("#ID_changeBlock").show();

    }
  }
</script>
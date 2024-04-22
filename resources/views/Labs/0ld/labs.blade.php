@extends('layouts.app')
@section('content')
@auth
<body>
  <!-- <form class="lab-form" id="hivTest" method="post"> -->
    @csrf
    <div class="container containers lab-containers " id="save-update-print">
      <div id="header_bar">
        <div class="row"  style="margin:auto;padding-top:20px;" > <!-- Upper Section -->
          <div class="">
            <button type="button" id="btn_refresh" onclick="wd_reload()">Refresh</button>
          </div>

          <!-- <div class="col-sm-2">
          <h2 id='app-User'>{{ Auth::user()->name }}</h2>
        </div> -->
        <div class="col-md-12 "  >
          <!-- <h2 id='app-User'>{{ Auth::user()->name }}</h2> -->

          <h2 class="header-text">Laboratory</h2>
        </div>
        <!-- <div id="main" class="col-sm-3 header-text">
        <div style="background-color:coral;"></div>
        <div style="background-color:lightblue;" id="myBlueDiv"> -->
        <!-- <p id="borderimg" class="h3" >Laboratory</p> -->
        <!-- </div>
        <div style="background-color:khaki;"></div>
      </div> -->
      <div class="col-sm-2">
        <div id="unregistered"></div>
      </div>
      </div>
        <!-- Nav tabs -->
          <p class="btn-gnavi">
            <span></span>
            <span></span>
            <span></span>
          </p>
          <ul class="nav nav-tabs toggle lab-second-link" id="hidden-title" >
            <li class="nav-item">
              <a class="nav-link active toggle-link " id="hiv_tab" data-toggle="tab" href="#hiv" onclick="hideTab(hider=1)">HIV Test</a>
            </li>
            <li class="nav-item">
              <a class="nav-link toggle-link" data-toggle="tab" id="rpr_tab" href="#rpr" onclick="hideTab(hider=2)">RPR Test</a>
            </li>
            <li class="nav-item">
              <a class="nav-link toggle-link" data-toggle="tab" id="sti_tab" href="#sti" onclick="hideTab(hider=3)">STI Test</a>
            </li>
            <li class="nav-item">
              <a class="nav-link toggle-link" data-toggle="tab" id="bc_tab" href="#hbc" onclick="hideTab(hider=4)">Hepatitis B/C</a>
            </li>
            <li class="nav-item">
              <a class="nav-link toggle-link"  data-toggle="tab" id="urine_tab" href="#urine" onclick="hideTab(hider=5)">Urine</a>
            </li>
            <li class="nav-item">
              <a class="nav-link toggle-link" data-toggle="tab" id="oi_tab"href="#oi"onclick="hideTab(hider=6)">OI Test</a>
            </li>
            <li class="nav-item">
              <a class="nav-link toggle-link" data-toggle="tab" id="gt_tab" href="#gt"onclick="hideTab(hider=7)">General Test</a>
            </li>
            <li class="nav-item">
              <a class="nav-link toggle-link" data-toggle="tab" id="stool_tab" href="#stool"onclick="hideTab(hider=8)">Stool</a>
            </li>
            <li class="nav-item">
              <a class="nav-link toggle-link" data-toggle="tab" id="afb_tab" href="#afb"onclick="hideTab(hider=9)">AFB</a>
            </li>
            <li class="nav-item">
              <a class="nav-link toggle-link" data-toggle="tab"id="covid_tab" href="#covid"onclick="hideTab(hider=10)">Covid-19</a>
            </li>
            <li class="nav-item">
              <a class="nav-link toggle-link" data-toggle="tab" id="viral_tab"href="#viral_load"onclick="hideTab(hider=11)">Viral Load</a>
            </li>
            <li class="nav-item">
              <a class="nav-link toggle-link" data-toggle="tab"id="search_tab" href="#finder" onclick="hideTab(hider=12)">Search & Update</a>
            </li>
            <li class="nav-item">
              <a class="nav-link toggle-link" data-toggle="tab" id="" href="#export" >Export</a>
            </li>
          </ul>
      </div>
    </div>
    <div class="container containers lab-containers" id="hider0" > <!--addding id  hider0 -->
      <div class="row" >
        <div class="col-sm-12">
          <h3 id='updateTitle'></h3>
        </div>
      </div>
      <div id="hider0">
        <div class="row genral-info" >
          <div class="col-sm-3 general-task">
            <label for="validationCustom01" class="form-label">Patient's ID</label>
            <input id="cid" type="number" autofocus onchange="ptData()" class="form-control" id="validationCustom01" >
            <div class="valid-feedback">
              Plz put Patient's ID.
            </div>
          </div>
          <div class="col-sm-3 general-task">
            <label for="validationCustom01" class="form-label">Fuchia ID</label>
            <input id="fuchiaID" type="text"  class="form-control" id="validationCustom01" >{{ Auth::user()->FuchiaID }}
            <div class="valid-feedback">
              Plz put Patient's fuchia ID.
            </div>
          </div>
          <div class="col-sm-3 general-task">
            <label for="validationCustom01" class="form-label">Visit Date  (dd  mm  yyyy)</label>
            <input id="vDate" type="date"  onblur="dateOver(1)" value="" class="form-control"  >
            <div class="valid-feedback">
              Plz put Patient's Visit Date.
            </div>
          </div>
          <div class="col-sm-3 general-task clearfix">
            <label for="validationCustom01" class="form-label labMain-rqdoctor">Requested Doctor</label>
            <select class="form-control lab-reqdoctor" id="md"  >
              <option value="-"></option>
              <option value="MD-1">MD1</option>
              <option value="MD-2">MD2</option>
              <option value="MD-3">MD3</option>
              <option value="MD-4">MD4</option>
              <option value="MD-5">MD5</option>
              <option value="MD-6">MD6</option>
              <option value="MD-7">MD7</option>
              <option value="MD-8">MD8</option>
              <option value="MD-9">MD9</option>
              <option value="MD-10">MD10</option>
              <option value="MD-11">MD11</option>
              <option value="MD-12">MD12</option>
              <option value="MD-13">MD13</option>
              <option value="MD-14">MD14</option>
              <option value="MD-15">MD15</option>
              <option value="MD-16">MD16</option>
              <option value="MD-17">MD17</option>
              <option value="MD-18">MD18</option>
              <option value="MD-19">MD19</option>
              <option value="MD-20">MD20</option>
              <option value="MD-21">MD21</option>
              <option value="MD-22">MD22</option>
              <option value="MD-23">MD23</option>
              <option value="MD-24">MD24</option>
              <option value="MD-25">MD25</option>
              <option value="MD-26">MD26</option>
              <option value="MD-27">MD27</option>
              <option value="MD-28">MD28</option>
              <option value="MD-29">MD29</option>
              <option value="MD-30">MD30</option>
              <option value="MD-31">MD31</option>
              <option value="MD-32">MD32</option>
              <option value="MD-33">MD33</option>
              <option value="MD-34">MD34</option>
              <option value="MD-35">MD35</option>
              <option value="MD-36">MD36</option>
              <option value="MD-37">MD37</option>
              <option value="MD-38">MD38</option>
              <option value="MD-39">MD39</option>
              <option value="MD-40">MD40</option>
              <option value="MD-41">MD41</option>
              <option value="MD-42">MD42</option>
              <option value="MD-43">MD43</option>
              <option value="MD-44">MD44</option>
              <option value="MD-45">MD45</option>
              <option value="MD-46">MD46</option>
              <option value="MD-47">MD47</option>
              <option value="MD-48">MD48</option>
              <option value="MD-49">MD49</option>
              <option value="MD-50">MD50</option>
            </select><br>
          </div>
          <div class="col-sm-2 lab-year-div clearfix">
            <label for="validationCustom01" class="form-label label-year">Age</label>
            <span id="agey" type="number"  class="form-control lab-year" id="validationCustom01" >{{ Auth::user()->Age }}</span>
            <div class="valid-feedback">
              Plz put Patient's Age.
            </div>
          </div>
          <div class="col-sm-2 lab-year-div clearfix">
            <label for="validationCustom01" class="form-label label-year">Month</label>
            <span id="agem" type="number"  class="form-control lab-year"  id="validationCustom01" ></span>
            <div class="valid-feedback">
              Plz put Patient's Age.
            </div>
          </div>
          <div class="col-sm-2 lab-year-sex  clearfix">
            <label for="validationCustom01" class="form-label label-sex">Sex</label>
            <span type="text" class="form-control lab-sex"   id="gender" value="">{{ Auth::user()->Sex }}</span>
          </div>


          <div class="col-sm-3 main-risk" >
            <label  class="form-label risk-label">Main-Risk</label>
            <span class="form-control mrisk-data" id="Ptype" onchange="PatientType()" >

            </span>
          </div>
          <div class="col-sm-3 sub-risk">
            <label class="form-label risk-label" for="">Sub-Risk</label>
            <span class="form-control srisk-data" id="ext"  >

            </span>
          </div>
        </div>
      </div>
    </div>
    <!-- Tab panes -->
    <div id="hider1">
      <div class="tab-content lab-containers">
        <div class="tab-pane container active lab-incon-div " id="hiv">
              <div class="row">
            <div class="col-sm-6">
              <div class="form-check-inline lab-incon ">
                <label class="form-check-label">
                  <input type="checkbox"id="inconslusive" class="form-check-input " value="">Inconclusive follow up
                </label>
              </div>
            </div>
          </div>
              <div class="row">
            <div class="col-sm-3 hiv-bloodDate">
              <label for="validationCustom01" class="form-label">Blood Collect Date (dd  mm  yyyy)</label>
              <input id="bcdate" type="date"  onblur="dateOver(2)" class="form-control" id="validationCustom01">
              <div class="valid-feedback">
                Plz put Patient's Blood Collection Date.
              </div>
            </div>
            <div class="col-sm-3 hiv-test">
              <label for="validationCustom01" class="form-label">Name of Counsellor</label>
              <select class="form-control" id="counselor" name="" >
                <option value="0 "> </option>
                <option value="1">Counselor 1</option>
                <option value="2">Counselor 2</option>
                <option value="3">Counselor 3</option>
                <option value="4">Counselor 4</option>
                <option value="5">Counselor 5</option>
                <option value="6">Counselor 6</option>
                <option value="7">Counselor 7</option>
                <option value="8">Counselor 8</option>
                <option value="9">Counselor 9</option>
                <option value="10">Counselor 10</option>
                <option value="11">Counselor 11</option>
                <option value="12">Counselor 12</option>
                <option value="13">Counselor 13</option>
                <option value="14">Counselor 14</option>
                <option value="15">Counselor 15</option>
                <option value="16">Counselor 16</option>
                <option value="17">Counselor 17</option>
                <option value="18">Counselor 18</option>
                <option value="19">Counselor 19</option>
                <option value="20">Counselor 20</option>
                <option value="21">Counselor 21</option>
                <option value="22">Counselor 22</option>
                <option value="23">Counselor 23</option>
                <option value="24">Counselor 24</option>
                <option value="25">Counselor 25</option>
                <option value="26">Counselor 26</option>
                <option value="27">Counselor 27</option>
                <option value="28">Counselor 28</option>
                <option value="29">Counselor 29</option>
                <option value="30">Counselor 30</option>
                <option value="31">Counselor 31</option>
                <option value="32">Counselor 32</option>
                <option value="33">Counselor 33</option>
                <option value="34">Counselor 34</option>
                <option value="35">Counselor 35</option>
              </select>
            </div>
            <div class="col-sm-2 hiv-test">
              <label  class="form-label">Determine Result</label>
              <select onchange="determineResult()" class="form-control"id="d_result" name="" >
                <option value="-"></option>
                <option value="Reactive">Reactive</option>
                <option value="Non Reactive">Non Reactive</option>
                <option value="Invalid">Invalid</option>
              </select>
            </div>
            <div class="col-sm-2 hiv-test">
              <label  class="form-label">UNI-Gold Result</label>
              <select class="form-control" onchange="hiv_result_cal()" id="uni_result" name="" >
                <option id="uni_bl" value="-"></option>
                <option value="Reactive">Reactive</option>
                <option value="Non Reactive">Non Reactive</option>
                <option value="Invalid">Invalid</option>
              </select>
            </div>
            <div class="col-sm-2 hiv-test">
              <label  class="form-label">STAT-PAK Result</label>
              <select class="form-control" onchange="hiv_result_cal()" id="stat_result" name="" >
                <option id="stat_bl" value="-"></option>
                <option value="Reactive">Reactive</option>
                <option value="Non Reactive">Non Reactive</option>
                <option value="Invalid">Invalid</option>
              </select>
            </div>
          </div>
              <div class="row">
            <div class="col-sm-3">
              <label  class="form-label">Result</label>
              <select class="form-control"id="final_result">
                <option value="-"></option>
                <option id="pos" value="Positive">Positive</option>
                <option id="neg" value="Negative">Negative</option>
                <option id="incon" value="Inconclusive">Inconclusive</option>
              </select>
            </div>
            <div class="col-sm-9">
              <label  class="form-label">Comment</label>
              <input id="comment" type="text"  class="form-control" value="-" >
            </div>
          </div>
              <div class="row">
            <div class="col-sm-3 lab-technician">
              <label  class="form-label">Lab Technician</label>
              <select class="form-control"id="lab_tech" name="" >
                <option value="-"></option>
                <option value="Tech_1">Lab Technician 1</option>
                <option value="Tech_2">Lab Technician 2</option>
                <option value="Tech_3">Lab Technician 3</option>
                <option value="Tech_4">Lab Technician 4</option>
                <option value="Tech_5">Lab Technician 5</option>
                <option value="Tech_6">Lab Technician 6</option>
                <option value="Tech_7">Lab Technician 7</option>
              </select>
            </div>

            <div class="col-sm-3 hiv-issue">
              <label for="validationCustom01" class="form-label ">Issue Date(dd mm yyyy)</label>
              <input id="issue_date" type="date" onblur="dateOver(3)" class="form-control" id="validationCustom01">
              <div class="valid-feedback">
                Plz put Patient's Issue Date.
              </div>
            </div>
          </div>
              <div class="row save-updte">
            <div class="col-sm-3"style="padding-top:10px;">
              <button type="button" id="hivSave" onclick="hiv_save()" class="btn btn-primary btn-lg save-batton ">Save & Print</button>
            </div>
            <div class="col-sm-2">
              <span id="noti"></span>
            </div>
            <div class="col-sm-3" style="padding-top:10px;">
              <button type="button" style="display:none;" id="hivUpdate_btn" onclick="hivUpdate()" class="btn btn-warning btn-lg update-batton ">updateData</button>
            </div>
          </div>
        </div>
        <div class="tab-pane container fade lab-incon-div " id="rpr">
          <div class="row">
            <!-- <div class="col-sm-2"></div> -->

            <div class="col-sm-2 rdt-test">
              <label  class="form-label">Syphillis RDT</label>
              <select class="form-control" id="rdtYes_no" onchange="validation_rdt()" >
                <option value="-"></option>
                <option value="Done">Done</option>
                <!-- <option value="No">No</option> -->
              </select>
            </div>
            <div class="col-sm-2 rdt-test">
              <label  class="form-label">Syphillis RDT Result </label>
              <select class="form-control" id="Sy_rdt_result" disabled="true"   >
                <option  value="-"></option>
                <option value="Positive">Positive</option>
                <option value="Negative">Negative</option>
              </select>
            </div>
            <div class="col-sm-2 rdt-test">
              <label for="validationCustom01" class="form-label">RPR Test</label>
              <select class="form-control" id="rprYes-NO" onchange="validation_rpr()" >
                <option value="-"></option>
                <option value="Done">Done</option>
                <!-- <option value="No">No</option> -->
              </select>
            </div>
            <div class="col-sm-2 rdt-test">
              <label  class="form-label">RPR Result </label>
              <select onchange ='titre()'class="form-control" disabled="true" id="qualitative"  >
                <option value="-"></option>
                <option value="Reactive">Reactive</option>
                <option value="Non Reactive">Non Reactive</option>
              </select>
            </div>
            <div class="col-sm-2 rdt-test">
              <label  class="form-label">Titre (Current)</label>
              <select class="form-control" disabled="true" id="titreCur"   >
                <option value="-"></option>
                <option value="Neat">Neat</option>
                <option value="1:2">1:2</option>
                <option value="1:4">1:4</option>
                <option value="1:8">1:8</option>
                <option value="1:16">1:16</option>
                <option value="1:32">1:32</option>
                <option value="1:64">1:64</option>
                <option value="1:128">1:128</option>
                <option value="1:256">1:256</option>
                <option value="1:512">1:512</option>
                <option value="1:1024">1:1024</option>
                <option value="More than 1024">More than 1024</option>
              </select>
            </div>

          </div>
          <div class="row">
            <!-- <div class="col-sm-2"></div> -->
            <div class="col-sm-2  tire_lastVisit">
              <label  class="form-label">Titre (Last Visit)</label>
              <select class="form-control"  id="titreLast"  >
                <option value="-"></option>
                <option value="Neat">Neat</option>
                <option value="1:2">1:2</option>
                <option value="1:4">1:4</option>
                <option value="1:8">1:8</option>
                <option value="1:16">1:16</option>
                <option value="1:32">1:32</option>
                <option value="1:64">1:64</option>
                <option value="1:128">1:128</option>
                <option value="1:256">1:256</option>
                <option value="1:512">1:512</option>
                <option value="1:1024">1:1024</option>
                <option value="More than 1024">More than 1024</option>
              </select>
            </div>
            <div class="col-sm-3 lab-date">
              <label  class="form-label">Last Titre Date</label>
              <input class="form-control" type='date' id="lastTitreDate" value="" placeholder="Date">
            </div>
            <!-- <div class="col-sm-2">  </div> -->
            <div class="col-sm-6 rpr-comment">
              <label class="form-label">Comment</label>
              <input type="text"id="rprComment" class ="form-control"  value="">
            </div>

          </div>
          <div class="row">
            <div class="col-sm-3 lab-technicianRPR">
              <label  class="form-label">Lab Technician</label>
              <select class="form-control" id="rpr_lab_tech" name="" >
                <option value="-"></option>
                <option value="Lab Tech1">Lab Technician 1</option>
                <option value="Lab Tech2">Lab Technician 2</option>
                <option value="Lab Tech3">Lab Technician 3</option>
                <option value="Lab Tech4">Lab Technician 4</option>
                <option value="Lab Tech5">Lab Technician 5</option>
                <option value="Lab Tech6">Lab Technician 6</option>
                <option value="Lab Tech7">Lab Technician 7</option>
              </select>
            </div>
            <div class="col-sm-5 lab-counsellor">

              <label for="validationCustom01" class="form-label">Name of Counsellor</label>
              <select class="form-control" id="rpr_counselor" name="" >
                <option value="-"></option>
                <option value="1">Counselor 1</option>
                <option value="2">Counselor 2</option>
                <option value="3">Counselor 3</option>
                <option value="4">Counselor 4</option>
                <option value="5">Counselor 5</option>
                <option value="6">Counselor 6</option>
                <option value="7">Counselor 7</option>
                <option value="8">Counselor 8</option>
                <option value="9">Counselor 9</option>
                <option value="10">Counselor 10</option>
                <option value="11">Counselor 11</option>
                <option value="12">Counselor 12</option>
                <option value="13">Counselor 13</option>
                <option value="14">Counselor 14</option>
                <option value="15">Counselor 15</option>
                <option value="16">Counselor 16</option>
                <option value="17">Counselor 17</option>
                <option value="18">Counselor 18</option>
                <option value="19">Counselor 19</option>
                <option value="20">Counselor 20</option>
                <option value="21">Counselor 21</option>
                <option value="22">Counselor 22</option>
                <option value="23">Counselor 23</option>
                <option value="24">Counselor 24</option>
                <option value="25">Counselor 25</option>
                <option value="26">Counselor 26</option>
                <option value="27">Counselor 27</option>
                <option value="28">Counselor 28</option>
                <option value="29">Counselor 29</option>
                <option value="30">Counselor 30</option>
                <option value="31">Counselor 31</option>
                <option value="32">Counselor 32</option>
                <option value="33">Counselor 33</option>
                <option value="34">Counselor 34</option>
                <option value="35">Counselor 35</option>

              </select>

            </div>
            <div class="col-sm-4 lab-issueDate">
              <label for="validationCustom01" class="form-label">Issue Date(dd mm yyyy)</label>
              <input id="rpr_issue_date" type="date" onblur="dateOver(4)" class="form-control" id="validationCustom01">
              <div class="valid-feedback">
                Plz put Patient's Issue Date.
              </div>
            </div>
          </div>
          <div class="row save-updte">
            <div class="col-sm-3"style="padding-top:10px;">
              <button type="button" id="rprSave" onclick="rpr_save()" class="btn btn-primary btn-lg save-batton ">Save & Print</button>
            </div>
            <div class="col-sm-2">
              <span id="noti_rpr"></span>
            </div>
            <div class="col-sm-3" style="padding-top:10px;">
              <button type="button" id="rprUpdate_btn" style="display:none;" onclick="rprUpdate()" class="btn btn-warning btn-lg update-batton "> Update Data</button>
            </div>
          </div>
        </div>
        <div class="tab-pane container fade lab-incon-div" id="hbc">
          <div class="row">
            <div class="col-sm-3 hbc-test">
              <label for="validationCustom01" class="form-label">Hepatitis B Ag(RDT)</label>
              <select class="form-control" id="hepB" onchange="validation()"  >
                <option value="-"></option>
                <option value="Done">Done</option>
                <!-- <option value="No">No</option> -->
              </select>
            </div>

            <div class="col-sm-3 hbc-test">
              <label for="validationCustom01" class="form-label">Hepatitis B Result</label>
              <select class="form-control" disabled="ture" id="B_result"  >
                <option value="-"></option>
                <option value="Positive">Positive</option>
                <option value="Negative">Negative</option>
              </select>
            </div>


            <div class="col-sm-3 hbc-test">
              <label for="validationCustom01" class="form-label">Hepatitis C Ab(RDT) </label>
              <select class="form-control"  id="c_test" onchange="validation()" >
                <option value="-"></option>
                <option value="Done">Done</option>
                <!-- <option value="No">No</option> -->
              </select>
            </div>

            <div class="col-sm-3 hbc-test">
              <label for="validationCustom01" class="form-label">Heptitis C Result </label>
              <select class="form-control" disabled="ture" id="c_result"  >
                <option value="-"></option>
                <option value="Positive">Positive</option>
                <option value="Negative">Negative</option>
              </select>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-3 lab-technician">
              <label  class="form-label">Lab Technician</label>
              <select class="form-control"id="C_lab_tech" name="" >
                <option value="-"></option>
                <option value="Lab Tech 1">Lab Technician 1</option>
                <option value="Lab Tech 2">Lab Technician 2</option>
                <option value="Lab Tech 3">Lab Technician 3</option>
                <option value="Lab Tech 4">Lab Technician 4</option>
                <option value="Lab Tech 5">Lab Technician 5</option>
                <option value="Lab Tech 6">Lab Technician 6</option>
                <option value="Lab Tech 7">Lab Technician 7</option>
              </select>
            </div>
            <div class="col-sm-3 lab-issueDate">
              <label for="validationCustom01" class="form-label">Issue Date(dd  mm  yy)</label>
              <input id="C_issueDate" type="date" onblur="dateOver(5)" class="form-control" id="validationCustom01">
              <div class="valid-feedback">
                Plz put Patient's Issue Date.
              </div>
            </div>
          </div>
          <div class="row save-updte">
            <div class="col-sm-3"style="padding-top:20px;">
              <button onclick="hbc_save()" id='hbcSave'type="button" class="btn btn-primary btn-lg save-batton ">Save & Print</button>
            </div>
            <div class="col-sm-2">
              <span id="noti_hbc"></span>
            </div>
            <div class="col-sm-3"style="padding-top:20px;">
              <button onclick="hbcUpdate()" style="display:none;"id='hbcUpdate_btn'type="button" class="btn btn-warning btn-lg update-batton"> Update Data</button>
            </div>


          </div>
        </div>
        <div class="tab-pane container fade lab-incon-div" id="sti">
          <div class="table-responsive-sm">
            <table class="table table-bordered sti-table onlySti-mobile">
              <thead>
                <tr>
                  <th></th>
                  <th colspan="2">Wet Mount</th>
                  <th colspan="3" >Gram Stain</th>
                </tr>
                <tr>
                  <th></th>
                  <th></th>
                  <th>Urethra</th>
                  <th>Post, fornix</th>
                  <th>Endo cervix</th>
                  <th>Rectum</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Clue Cells %</td>
                  <td>
                    <select class="form-select" id="clue_cells" >
                      <option value="-"></option>
                      <option value="Nil"> Nil </option>
                      <option value="<20%"> < 20% </option>
                      <option value=">20%"> > 20% </option>
                    </select>
                  </td>
                  <td>

                  </td>
                  <td>
                    <select class="form-select" id="clue_post_fornix" >
                      <option value="-"></option>
                      <option value="Nil"> Nil </option>
                      <option value="<20%"> < 20% </option>
                      <option value=">20% "> > 20% </option>
                    </select>
                  </td>
                  <td></td>
                  <td></td>

                </tr>
                <tr>
                  <td>PMNL cells / HPF</td>
                  <td></td>
                  <td>
                    <select class="form-select" id="pmnl_urethra" >
                      <option value="-"></option>
                      <option value="Nil"> Nil </option>
                      <option value="1-5"> 1-5 </option>
                      <option value="6-10"> 6-10 </option>
                      <option value="11-15"> 11-15 </option>
                      <option value="16-19"> 16-19 </option>
                      <option value="20-25"> 20-25 </option>
                      <option value=">25"> > 25 </option>
                    </select>
                  </td>
                  <td>
                    <select class="form-select" id="pmnl_post_fix" >
                      <option value="-"></option>
                      <option value="Nil"> Nil </option>
                      <option value="1-5"> 1-5 </option>
                      <option value="6-10"> 6-10 </option>
                      <option value="11-15"> 11-15 </option>
                      <option value="16-19"> 16-19 </option>
                      <option value="20-25"> 20-25 </option>
                      <option value=">25"> > 25 </option>
                    </select>
                  </td>
                  <td>
                    <select class="form-select" id="pmnl_endocevix" >
                      <option value="-"></option>
                      <option value="Nil"> Nil </option>
                      <option value="1-5"> 1-5 </option>
                      <option value="6-10"> 6-10 </option>
                      <option value="11-15"> 11-15 </option>
                      <option value="16-19"> 16-19 </option>
                      <option value="20-25"> 20-25 </option>
                      <option value=">25"> > 25 </option>
                    </select>
                  </td>
                  <td>
                    <select class="form-select" id="pmnl_rectum" >
                      <option value="-"></option>
                      <option value="Nil"> Nil </option>
                      <option value="1-5"> 1-5 </option>
                      <option value="6-10"> 6-10 </option>
                      <option value="11-15"> 11-15 </option>
                      <option value="16-19"> 16-19 </option>
                      <option value="20-25"> 20-25 </option>
                      <option value=">25"> > 25 </option>
                    </select>
                  </td>

                </tr>
                <tr>
                  <td>Trichomonas</td>
                  <td>
                    <select class="form-select" id="tricho_wet" >
                      <option value="-"> </option>
                      <option value="Yes"> Yes </option>
                      <option value="No"> No </option>
                    </select>
                  </td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>

                </tr>
                <tr>
                  <td>Gram (-) diplococci intra-cell</td>
                  <td>
                  </td>
                  <td>
                    <select class="form-select" id="gram_intra_urethra" >
                      <option value="-"> </option>
                      <option value="No"> No </option>
                      <option value="Yes"> Yes </option>
                    </select>
                  </td>
                  <td>
                    <select class="form-select" id="gram_intra_postfornix" >
                      <option value="-"> </option>
                      <option value="No"> No </option>
                      <option value="Yes"> Yes </option>
                    </select>
                  </td>
                  <td>
                    <select class="form-select" id="gram_intra_endo" >
                      <option value="-"> </option>
                      <option value="No"> No </option>
                      <option value="Yes"> Yes </option>
                    </select>
                  </td>
                  <td>
                    <select class="form-select" id="gram_intra_rectum" >
                      <option value="-"> </option>
                      <option value="No"> No </option>
                      <option value="Yes"> Yes </option>
                    </select>
                  </td>

                </tr>
                <tr>
                  <td>Gram (-) diplococci extra-cell</td>
                  <td></td>
                  <td>
                    <select class="form-select" id="gram_extra_urethra" >
                      <option value="-"> </option>
                      <option value="No"> No </option>
                      <option value="Yes"> Yes </option>
                    </select>
                  </td>
                  <td>
                    <select class="form-select" id="gram_extra_postfornix" >
                      <option value="-"> </option>
                      <option value="No"> No </option>
                      <option value="Yes"> Yes </option>
                    </select>
                  </td>
                  <td>
                    <select class="form-select" id="gram_extra_endo" >
                      <option value="-"> </option>
                      <option value="No"> No </option>
                      <option value="Yes"> Yes </option>
                    </select>
                  </td>
                  <td>
                    <select class="form-select" id="gram_extra_rectum" >
                      <option value="-"> </option>
                      <option value="No"> No </option>
                      <option value="Yes"> Yes </option>
                    </select>
                  </td>

                </tr>
                <tr>
                  <td>Candida</td>
                  <td>
                    <select class="form-select" id="candida_wet" >
                      <option value="-"> </option>
                      <option value="No"> No </option>
                      <option value="Yes"> Yes </option>
                    </select>
                  </td>
                  <td>
                    <select class="form-select" id="candida_urethra" >
                      <option value="-"> </option>
                      <option value="No"> No </option>
                      <option value="Yes"> Yes </option>
                    </select>
                  </td>
                  <td>
                    <select class="form-select" id="candida_postfornix" >
                      <option value="-"> </option>
                      <option value="No"> No </option>
                      <option value="Yes"> Yes </option>
                    </select>
                  </td>
                  <td>
                    <select class="form-select" id="candida_endo" >
                      <option value="-"> </option>
                      <option value="No"> No </option>
                      <option value="Yes"> Yes </option>
                    </select>
                  </td>
                  <td>
                  </td>
                </tr>
                <tr>
                  <td>Spermatazoites, RBCs, others: </td>
                  <td>
                    <input type="text" class="form-control" id="Sper_other_wet" value="-">
                  </td>
                  <td>
                    <input type="text" class="form-control" id="Sper_other_urethra" value="-">
                  </td>
                  <td>
                    <input type="text" class="form-control" id="Sper_other_post" value="-">
                  </td>
                  <td>
                    <input type="text" class="form-control" id="Sper_other_endo" value="-">
                  </td>
                  <td>
                    <input type="text" class="form-control" id="Sper_other_rectum" value="-">
                  </td>

                </tr>
              </tbody>
            </table>
            <table class="table table-bordered sti-table onlySti-mobile" id="u_table2">
              <tbody>
                <tr>
                  <td>Urine Exam (FPU)</td>
                  <td>
                    <select class="form-select" onchange="validation()" id="urine_exam_done" >
                      <option value="-">  </option>
                      <option value="Done"> Done </option>
                      <!-- <option value="No"> Not Done </option> -->
                    </select>
                  </td>
                </tr>
                <tr>

                </tr>
                <tr>
                  <td>Gram(-) diplococci intra-cell </td>
                  <td>
                    <select
                    class="form-select" id="intra_cell" disabled="true" >
                    <option value="-"></option>
                    <option value="Yes"> Yes </option>
                    <option value="No"> No </option>
                  </select>
                </td>
                <td>
                  Epithelial cells
                </td>
                <td>
                  <select class="form-select" id="epithelial_cell" disabled="true" >
                    <option value="-"></option>
                    <option value="< 10"> < 10 </option>
                    <option value="> 10"> > 10 </option>
                  </select>
                </td>

              </tr>
              <tr>
                <td>
                  Gram(-) diplococci extra-cell
                </td>
                <td>
                  <select class="form-select" id="extra_cell" disabled="true">
                    <option value="-"></option>
                    <option value="Yes"> Yes </option>
                    <option value="No"> No </option>
                  </select>
                </td>
                <td>
                  PMNL cells
                </td>
                <td>
                  <select class="form-select" id="pmnl_cell" disabled="true" >
                    <option value="-"></option>
                    <option value="Nil"> Nil </option>
                    <option value="1-5"> 1-5 </option>
                    <option value="6-10"> 6-10 </option>
                    <option value="11-15"> 11-15 </option>
                    <option value="16-19"> 16-19 </option>
                    <option value="20-25"> 20-25 </option>
                    <option value=">25"> > 25 </option>
                  </select>
                </td>
              </tr>
              <tr>
                <td>
                  Other Bacteria(Gram Stain)
                </td>
                <td colspan="3">
                  <input disabled="true" type="text" id="other_baceria" class="form-control" name="" value="-">
                </td>
              </tr>
            </tbody>
            </table>
          </div>
            <p class="btn-stiList">
              <span></span>
              <span></span>
              <span></span>
            </p>

              <div class="labsti-list">
                <ul id="sti-diseaseTest" class="sti-diseaseTest">
                  <li class="diseaseTest">Clue Cells %</li>
                  <li class="diseaseTest">PMNL cells / HPF</li>
                  <li class="diseaseTest">Trichomonas</li>
                  <li class="diseaseTest">Gram (-) diplococci intra-cell</li>
                  <li class="diseaseTest">Gram (-) diplococci extra-cell</li>
                  <li class="diseaseTest">Candida</li>
                  <li class="diseaseTest">Spermatazoites, RBCs, others:</li>
                </ul>
                <div class="row">
                  <div class="sti-wet">
                    <label class="wet-label">Wet Moun</label>
                    <div class='clue'>
                      <select class="form-select  no-label" id="clue_cells">
                        <option value="-"></option>
                        <option value="Nil"> Nil </option>
                        <option value="<20%"> &lt; 20% </option>
                        <option value=">20%"> &gt; 20% </option>
                      </select>
                    </div>
                    <div class="pmnl">
                      <label>Urethra</label>
                      <select class="form-select" id="pmnl_urethra">
                        <option value="-"></option>
                        <option value="Nil"> Nil </option>
                        <option value="1-5"> 1-5 </option>
                        <option value="6-10"> 6-10 </option>
                        <option value="11-15"> 11-15 </option>
                        <option value="16-19"> 16-19 </option>
                        <option value="20-25"> 20-25 </option>
                        <option value=">25"> &gt; 25 </option>
                      </select>
                    </div>

                    <div class="trich">
                      <select class="form-select trich" id="tricho_wet">
                        <option value="-"> </option>
                        <option value="Yes"> Yes </option>
                        <option value="No"> No </option>
                      </select>
                    </div>

                    <div class="gram-intra">
                      <label>Urethra</label>
                      <select class="form-select" id="gram_intra_urethra">
                        <option value="-"> </option>
                        <option value="No"> No </option>
                        <option value="Yes"> Yes </option>
                      </select>
                    </div>

                    <div class="gram-extra">
                      <label>Urethra</label>
                      <select class="form-select" id="gram_extra_urethra">
                        <option value="-"> </option>
                        <option value="No"> No </option>
                        <option value="Yes"> Yes </option>
                      </select>
                    </div>

                    <div class="candida ">
                      <select class="form-select no-label" id="candida_wet">
                        <option value="-"> </option>
                        <option value="No"> No </option>
                        <option value="Yes"> Yes </option>
                      </select>
                      <label>Urethra</label>
                      <select class="form-select" id="candida_urethra">
                        <option value="-"> </option>
                        <option value="No"> No </option>
                        <option value="Yes"> Yes </option>
                      </select>

                    </div>

                    <div class="spermatazoites">
                      <input type="text" class="form-control no-label" id="Sper_other_wet" value="-">
                      <label>Urethra</label>
                      <input type="text" class="form-control" id="Sper_other_urethra" value="-">

                    </div>



                  </div>
                  <div class="sti-grim">
                    <label class="gram-label">Gram Stain</label>
                    <div class="clue">
                      <label>Post, fornix</label>
                      <select class="form-select" id="clue_post_fornix">
                        <option value="-"></option>
                        <option value="Nil"> Nil </option>
                        <option value="<20%"> &lt; 20% </option>
                        <option value=">20% "> &gt; 20% </option>
                      </select>
                    </div>
                    <div class="pmnl">
                      <label>Post, fornix</label>
                      <select class="form-select" id="pmnl_post_fix">
                        <option value="-"></option>
                        <option value="Nil"> Nil </option>
                        <option value="1-5"> 1-5 </option>
                        <option value="6-10"> 6-10 </option>
                        <option value="11-15"> 11-15 </option>
                        <option value="16-19"> 16-19 </option>
                        <option value="20-25"> 20-25 </option>
                        <option value=">25"> &gt; 25 </option>
                      </select>
                      <label>Endo cervix</label>
                      <select class="form-select" id="pmnl_endocevix">
                        <option value="-"></option>
                        <option value="Nil"> Nil </option>
                        <option value="1-5"> 1-5 </option>
                        <option value="6-10"> 6-10 </option>
                        <option value="11-15"> 11-15 </option>
                        <option value="16-19"> 16-19 </option>
                        <option value="20-25"> 20-25 </option>
                        <option value=">25"> &gt; 25 </option>
                      </select>
                      <label>Rectum</label>
                      <select class="form-select" id="pmnl_rectum">
                        <option value="-"></option>
                        <option value="Nil"> Nil </option>
                        <option value="1-5"> 1-5 </option>
                        <option value="6-10"> 6-10 </option>
                        <option value="11-15"> 11-15 </option>
                        <option value="16-19"> 16-19 </option>
                        <option value="20-25"> 20-25 </option>
                        <option value=">25"> &gt; 25 </option>
                      </select>


                    </div>
                    <div class="gram-intra">
                      <label>Post, fornix</label>
                      <select class="form-select" id="gram_intra_postfornix">
                        <option value="-"> </option>
                        <option value="No"> No </option>
                        <option value="Yes"> Yes </option>
                      </select>
                      <label>Endo cervix</label>
                      <select class="form-select" id="gram_intra_endo">
                        <option value="-"> </option>
                        <option value="No"> No </option>
                        <option value="Yes"> Yes </option>
                      </select>
                      <label>Rectum</label>
                      <select class="form-select" id="gram_intra_rectum">
                        <option value="-"> </option>
                        <option value="No"> No </option>
                        <option value="Yes"> Yes </option>
                      </select>

                    </div>
                    <div class="gram-extra">
                      <label>Post, fornix</label>
                      <select class="form-select" id="gram_extra_postfornix">
                        <option value="-"> </option>
                        <option value="No"> No </option>
                        <option value="Yes"> Yes </option>
                      </select>
                      <label>Endo cervix</label>
                      <select class="form-select" id="gram_extra_endo">
                        <option value="-"> </option>
                        <option value="No"> No </option>
                        <option value="Yes"> Yes </option>
                      </select>
                      <label>Rectum</label>
                      <select class="form-select" id="gram_extra_rectum">
                        <option value="-"> </option>
                        <option value="No"> No </option>
                        <option value="Yes"> Yes </option>
                      </select>

                    </div>
                    <div class="candida">
                      <label>Post, fornix</label>
                      <select class="form-select" id="candida_postfornix">
                        <option value="-"> </option>
                        <option value="No"> No </option>
                        <option value="Yes"> Yes </option>
                      </select>
                      <label>Endo cervix</label>
                      <select class="form-select" id="candida_endo">
                        <option value="-"> </option>
                        <option value="No"> No </option>
                        <option value="Yes"> Yes </option>
                      </select>

                    </div>
                    <div class="spermatazoites">
                      <label>Post, fornix</label>
                      <input type="text" class="form-control" id="Sper_other_post" value="-">
                      <label>Endo cervix</label>
                      <input type="text" class="form-control" id="Sper_other_endo" value="-">
                      <label>Rectum</label>
                      <input type="text" class="form-control" id="Sper_other_rectum" value="-">

                    </div>



                  </div>
                  <div class="row stiLab-UrineExam">
                    <div>
                      <label>Urine Exam (FPU)</label>
                      <select class="form-select" onchange="validation()" id="urine_exam_done">
                        <option value="-">  </option>
                        <option value="Done"> Done </option>
                      </select>
                    </div>
                    <div>
                      <label> Gram(-) diplococci intra-cell</label>
                      <select class="form-select" id="intra_cell">
                        <option value="-"></option>
                        <option value="Yes"> Yes </option>
                        <option value="No"> No </option>
                      </select>
                    </div>
                    <div>
                      <label>Epithelial cells</label>
                      <select class="form-select" id="epithelial_cell">
                        <option value="-"></option>
                        <option value="< 10"> &lt; 10 </option>
                        <option value="> 10"> &gt; 10 </option>
                      </select>
                    </div>
                    <div>
                      <label> Gram(-) diplococci extra-cell</label>
                      <select class="form-select" id="extra_cell">
                        <option value="-"></option>
                        <option value="Yes"> Yes </option>
                        <option value="No"> No </option>
                      </select>
                    </div>
                    <div>
                      <label>PMNL cells</label>
                      <select class="form-select" id="pmnl_cell">
                        <option value="-"></option>
                        <option value="Nil"> Nil </option>
                        <option value="1-5"> 1-5 </option>
                        <option value="6-10"> 6-10 </option>
                        <option value="11-15"> 11-15 </option>
                        <option value="16-19"> 16-19 </option>
                        <option value="20-25"> 20-25 </option>
                        <option value=">25"> &gt; 25 </option>
                      </select>
                    </div>
                    <div>
                      <label>Other Bacteria(Gram Stain)</label>
                      <input type="text" id="other_baceria" class="form-control" name="" value="-">
                    </div>

                  </div>


                </div>

              </div>

              <div class="row">
                <div class="col-sm-3 lab-technician">
                  <label  class="form-label">Lab Technician</label>
                  <select class="form-control"id="sti_lab_tech" name="" >
                    <option value="-"></option>
                    <option value="Lab Tech 1">Lab Technician 1</option>
                    <option value="Lab Tech 2">Lab Technician 2</option>
                    <option value="Lab Tech 3">Lab Technician 3</option>
                    <option value="Lab Tech 4">Lab Technician 4</option>
                    <option value="Lab Tech 5">Lab Technician 5</option>
                    <option value="Lab Tech 6">Lab Technician 6</option>
                    <option value="Lab Tech 7">Lab Technician 7</option>
                  </select>
                </div>


                <div class="col-sm-3 lab-issueDate">
                  <label for="validationCustom01" class="form-label">Issue Date(dd mm yyyy)</label>
                  <input id="sti_issueDate" type="date" onblur="dateOver(6)" class="form-control" id="validationCustom01">
                  <div class="valid-feedback">
                    Plz put Patient's Issue Date.
                  </div>
                </div>
              </div>
              <div class="row save-updte">
                <div class="col-sm-3" style="padding-top:10px;">
                  <button type="button" id="stiSave" onclick="sti_save()" class="btn btn-primary btn-lg save-batton ">Save & Print</button>
                </div>
                <div class="col-sm-2">
                  <span id="noti_sti"></span>
                </div>
                <div class="col-sm-3" id="stiUpdate" style="padding-top:10px;">

                  <button onclick="stiUpdate()" style="display:none;" id='stiUpdate_btn' type="button" class="btn btn-warning btn-lg update-batton"> Update Data</button>
                </div>
              </div>
            </div>
        <div class="tab-pane container fade lab-incon-div" id="urine">
              <!--    <div class="row">
              <div class="col-sm-3" >
              <label class="form-label">Urine Test Done</label>
              <select class="form-control" id="Utest_done">
              <option value="-"></option>
              <option value="1">Done</option>
              <option value="0">Not Done</option>
                </select>
              </div>
                </div> -->
            <div class="row">
              <div class="col-sm-3" >
                <label class="form-label">Type of Test</label>
                <select class="form-control" id="Utot" onchange="urineChoice()">
                  <option value="-"></option>
                  <option value="RE">Routine Examination</option>
                  <option value="Dipstick" id="D">Dipstick</option>
                </select>
              </div>
              <div class="col-sm-3" >
                <label class="form-label">Apperance</label>
                <select class="form-control" id="Uapp">
                  <option value="-"></option>
                  <option value="Deep Yellow">Deep Yellow</option>
                  <option value="Yellow">Yellow</option>
                  <option value="Pale Yellow">Pale Yellow</option>
                  <option value="Blood Stain">Blood Stain</option>
                  <option value="Milky">Milky</option>
                </select>
              </div>
              <div class="col-sm-3" >
                <label class="form-label">Tubitity</label>
                <select class="form-control" id="tubitity">
                  <option value="-"></option>
                  <option value="Clear">Clear</option>
                  <option value="Turbid">Turbid</option>
                </select>
              </div>
              <div class="col-sm-3" >
                <label class="form-label">Pus/ WBC</label>
                <select class="form-control" id="Upus">
                  <option value="-"></option>
                  <option value="<5/HPF"> < 5/HPF </option>
                  <option value="5-10/HPF"> 5-10/HPF </option>
                  <option value=">10/HPF"> >10/HPF</option>
                  <option value="nil">Nil</option>
                </select>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-3" >
                <label class="form-label">PH</label>
                <select class="form-control" id="ph">
                  <option value="-"></option>
                  <option value="Acid"> Acid </option>
                  <option value="Alkaline"> Alkaline</option>
                </select>
              </div>
              <div class="col-sm-3" >
                <label class="form-label">Protein</label>
                <select class="form-control" id="Uprotein">
                  <option value="-"></option>
                  <option value="Nil">Nil</option>
                  <option value="1+">1+</option>
                  <option value="2+">2+</option>
                  <option value="3+">3+</option>
                </select>
              </div>
              <div class="col-sm-3" >
                <label class="form-label">Glucose</label>
                <select class="form-control" id="Uglucose">
                  <option value="-"></option>
                  <option value="nil">Nil</option>
                  <option value="1+">1+</option>
                  <option value="2+">2+</option>
                  <option value="3+">3+</option>
                  <option value="4+">4+</option>
                </select>
              </div>
              <div class="col-sm-3" >
                <label class="form-label">RBC</label>
                <select class="form-control" id="Urbc">
                  <option value="-"></option>
                  <option value="<5/HPF"> < 5/HPF </option>
                  <option value="5-10/HPF"> 5-10/HPF </option>
                  <option value=">10/HPF" >10/HPF</option>
                  <option value="nil">Nil</option>
                </select>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-3" >
                <label class="form-label">Leukocyte</label>
                <select class="form-control" id="Uleu">
                  <option value="-"></option>
                  <option value="nil">Nil</option>
                  <option value="1+">1+</option>
                  <option value="2+">2+</option>
                  <option value="3+">3+</option>
                  <option value="4+">4+</option>
                </select>
              </div>
              <div class="col-sm-3" >
                <label class="form-label">Nitrite</label>
                <select class="form-control" id="Unitrite">
                  <option value="-"></option>
                  <option value="Positive">Positive</option>
                  <option value="Negative">Negative</option>
                </select>
              </div>
              <div class="col-sm-3" >
                <label class="form-label">Ketone</label>
                <select class="form-control" id="ketone">
                  <option value="-"></option>
                  <option value="nil">Nil</option>
                  <option value="1+">1+</option>
                  <option value="2+">2+</option>
                  <option value="3+">3+</option>
                  <option value="4+">4+</option>
                </select>
              </div>
              <div class="col-sm-3" >
                <label class="form-label">Epithelial Cell</label>
                <select class="form-control" id="Uepithelial">
                  <option value="-"></option>
                  <option value="< 10"> < 10 </option>
                  <option value="> 10"> > 10 </option>
                </select>

              </div>
              <div class="col-sm-3" >
                <label class="form-label">Urobilinogen</label>
                <select class="form-control" id="Urobili">
                  <option value="-"></option>
                  <option value="nil">Nil</option>
                  <option value="1+">1+</option>
                  <option value="2+">2+</option>
                  <option value="3+">3+</option>
                  <option value="4+">4+</option>
                </select>
              </div>
              <div class="col-sm-3" >
                <label class="form-label">Bilirubin</label>
                <select class="form-control" id="Ubiliru">
                  <option value="-"></option>
                  <option value="nil">Nil</option>
                  <option value="1+">1+</option>
                  <option value="2+">2+</option>
                  <option value="3+">3+</option>
                  <option value="4+">4+</option>
                </select>
              </div>
              <div class="col-sm-3" >
                <label class="form-label">Erythrocyte</label>
                <select class="form-control" id="Uery">
                  <option value="-"></option>
                  <option value="nil">Nil</option>
                  <option value="1+">1+</option>
                  <option value="2+">2+</option>
                  <option value="3+">3+</option>
                  <option value="4+">4+</option>
                </select>
              </div>
              <div class="col-sm-3" >
                <label class="form-label">Crystal</label>
                <select class="form-control" id="Ucrystal">
                  <option value="-"></option>
                  <option value="Ca++ Oxalate">Ca++ Oxalate</option>
                  <option value="Ca++ Carbonat">Ca++ Carbonate</option>
                  <option value="Triple Phosphat">Triple Phosphate</option>
                  <option value="Uric Acid">Uric Acid</option>
                  <option value="Amorphous Urate">Amorphous Urate</option>
                  <option value="Amorphous Phosphate">Amorphous Phosphate</option>
                  <option value="Nil">Nil</option>
                </select>
              </div>

            </div>
            <div class="row">
              <div class="col-sm-3" >
                <label class="form-label">Haemoglobin</label>
                <select class="form-control" id="Uhae">
                  <option value="-"></option>
                  <option value="nil">Nil</option>
                  <option value="1+">1+</option>
                  <option value="2+">2+</option>
                  <option value="3+">3+</option>
                  <option value="4+">4+</option>
                </select>
              </div>

              <div class="col-sm-3" >
                <label class="form-label">Cast</label>
                <select class="form-control" id="Ucast">
                  <option value="-"></option>
                  <option value="Granular Cast">Granular Cast</option>
                  <option value="Waxy Cast">Waxy Cast</option>
                  <option value="Hyaline Cast">Hyaline Cast</option>
                  <option value="Cellular Cast">Cellular Cast</option>
                  <option value="Nil">Nil</option>
                </select>
              </div>
              <div class="col-sm-6" >
                <label class="form-label">Other</label>
                <input type="text"class="form-control"id="Uother" value="">
              </div>
            </div>
            <div class="row urine-analyzer">
              <label class="form-label">Analyzer (2 CE)Results</label>
              <div class="col-sm-3" >
                <label class="form-label">Cretinine (mg/dl)</label>
                <input  type="number"  class="form-control" id="cretinine" value="">
              </div>
              <div class="col-sm-3" >
                <label class="form-label">Albumin(mg/L)</label>
                <input  type="number"class="form-control" id="albumin" value="">
              </div>
              <div class="col-sm-3" >
                <label class="form-label">A : C (ratio)mg/g</label>
                <select class="form-control" id="a_c_ratio">
                  <option value="-"></option>
                  <option value="<30"> < 30 </option>
                  <option value=">30"> > 30 </option>
                </select>
              </div>
            </div>
            <div class="row">

              <div class="col-sm-6 urine-comment" >
                <label class="form-label">Comment</label>
                <input type="text"class="form-control" id="Ument" value="">
              </div>
            </div>
            <div class="row">
              <div class="col-sm-3 lab-technician">
                <label  class="form-label">Lab Technician</label>
                <select class="form-control"id="u_lab_tech" name="" >
                  <option value="-"></option>
                  <option value="Lab Tech 1">Lab Technician 1</option>
                  <option value="Lab Tech 2">Lab Technician 2</option>
                  <option value="Lab Tech 3">Lab Technician 3</option>
                  <option value="Lab Tech 4">Lab Technician 4</option>
                  <option value="Lab Tech 5">Lab Technician 5</option>
                  <option value="Lab Tech 6">Lab Technician 6</option>
                  <option value="Lab Tech 7">Lab Technician 7</option>
                </select>
              </div>


              <div class="col-sm-3 lab-issueDate">
                <label for="validationCustom01" class="form-label">Issue Date(dd  mm  yy)</label>
                <input id="u_issuDate" type="date" onblur="dateOver(7)" class="form-control" id="validationCustom01">
                <div class="valid-feedback">
                  Plz put Patient's Issue Date.
                </div>
              </div>

              <br>
            </div>
            <div class="row save-updte">
              <div class="col-sm-3"style="padding-top:10px;">
                <button type="button" id="urineSave" onclick="Urine()" class="btn btn-primary btn-lg save-batton">Save & Print</button>
              </div>
              <div class="col-sm-2">
                <span id="noti_urine"></span>
              </div>
              <div class="col-sm-3"id="urineUpdate"style="padding-top:10px;">
                <button onclick="urineUpdate()" style="display:none;" id='urineUpdate_btn'type="button" class="btn btn-warning btn-lg update-batton"> Update Data</button>
              </div>
            </div>
          </div>
        <div class="tab-pane container fade lab-incon-div" id="oi">
          <div class="row">
            <div class="col-sm-3 oi-tb" >
              <label class="form-label">Urine TB LAM</label>
              <select class="form-control" id="tb_lam">
                <option value="-"></option>
                <option value="Positive">Positive</option>
                <option value="Negative">Negative</option>
              </select>
            </div>
            <div class="col-sm-3 oi-toxoanti" >
              <label class="form-label">Toxoplasma Antibody</label>
              <select class="form-control" id="toxo_plasma" onchange=validation()>
                <option value="-"></option>
                <option value="Done">Done</option>
                <!-- <option value="Not Done">Not Done</option> -->
              </select>
            </div>
            <div class="col-sm-3" >
              <label class="form-label">IgG</label>
              <select class="form-control" disabled="true" id="toxo_igG">
                <option value="-"></option>
                <option value="IgG(+)">IgG(+)</option>
                <option value="IgG(+)">IgG(-)</option>
              </select>
            </div>
            <div class="col-sm-3" >
              <label class="form-label">IgM</label>
              <select class="form-control" disabled="true" id="toxo_igm">
                <option value="-"></option>
                <option value="IgM(+)">IgM(+)</option>
                <option value="IgM(-)">IgM(-)</option>
              </select>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-3 oi-serum" >
              <label class="form-label">Serum Cryptococcal Antigen</label>
              <select class="form-control" id="serum_cry_antigen">
                <option value="-"></option>
                <option value="Positive">Positive</option>
                <option value="Negative">Negative</option>
              </select>
            </div>
            <div class="col-sm-3 oi-dilu" >
              <label class="form-label">Dilution</label>
              <input type="text" id="serum_cry_dil" class="form-control urine-dilu" name="" value="-">
            </div>

            <div class="col-sm-3 oi-csf" >
              <label class="form-label ">CSF for cryptococcal Antigen</label>
              <select class="form-control" id="csf_cry_antigen">
                <option value="-"></option>
                <option value="Positive">Positive</option>
                <option value="Negative">Negative</option>
              </select>
            </div>
            <div class="col-sm-3 oi-dilu" >
              <label class="form-label">Dilution</label>
              <input type="text" id="csf_dil" class="form-control urine-dilu" name="" value="-">
            </div>
          </div>
          <div class="row oi-indLink">
            <div class="col-sm-3 oi-csf" >
              <label class="form-label">CSF Smear</label>
              <select class="form-control" id="csf_smear" onchange=validation()>
                <option value="-"></option>
                <option value="Done">Done</option>
                <!-- <option value="Not Done">Not Done</option> -->
              </select>
            </div>
            <div class="col-sm-3 oi-giemsa" >
              <label class="form-label">Giemsa stain Result</label>
              <select class="form-control" id="giemsa_stain_result" disabled="true">
                <option value="-"></option>
                <option value="Cryptococcus neoformans seen">Cryptococcus neoformans seen</option>
                <option value="Pencillium seen">Pencillium seen</option>
                <option value="fungal not seen">fungal not seen</option>
                <option value="Not Done">Not Done</option>
              </select>
            </div>
            <div class="col-sm-3 oi-giemsa" >
              <label class="form-label">India Ink Result</label>
              <select class="form-control" id="india_ink_result" disabled="true">
                <option value="-"></option>
                <option value="Cryptococcus neoformans seen">Cryptococcus neoformans seen</option>
                <option value="Pencillium seen">Pencillium seen</option>
                <option value="fungal not seen">fungal not seen</option>
                <option value="Not Done">Not Done</option>
              </select>
            </div>
          </div>
          <div class="row oi-indLink">
            <div class="col-sm-3 oi-smear" >
              <label class="form-label">Skin Smear</label>
              <select class="form-control" id="skin_smear" onchange=validation()>
                <option value="-"></option>
                <option value="Done">Done</option>
                <!-- <option value="Not Done">Not Done</option> -->
              </select>
            </div>
            <div class="col-sm-3 oi-giemsa" >
              <label class="form-label">Giemsa stain Result</label>
              <select class="form-control" id="skin_giemsa_stain_result" disabled="true">
                <option value="-"></option>
                <option value="Cryptococcus neoformans seen">Cryptococcus neoformans seen</option>
                <option value="Pencillium seen">Pencillium seen</option>
                <option value="fungal not seen">fungal not seen</option>
                <option value="Not Done">Not Done</option>
              </select>
            </div>
            <div class="col-sm-3 oi-giemsa" >
              <label class="form-label">India Ink Result</label>
              <select class="form-control" id="skin_india_ink_result" disabled="true">
                <option value="-"></option>
                <option value="Cryptococcus neoformans seen">Cryptococcus neoformans seen</option>
                <option value="Pencillium seen">Pencillium seen</option>
                <option value="fungal not seen">fungal not seen</option>
                <option value="Not Done">Not Done</option>
              </select>
            </div>
          </div>
          <div class="row oi-indLink">
            <div class="col-sm-3 oi-lymph" >
              <label class="form-label">Lymph Nodes</label>
              <select class="form-control" id="lymph_test" onchange=validation()>
                <option value="-"></option>
                <option value="Done">Done</option>
                <!-- <option value="Not Done">Not Done</option> -->
              </select>
            </div>
            <div class="col-sm-3 oi-giemsa">
              <label class="form-label">Giemsa stain Result</label>
              <select class="form-control" id="lymph_giemsa_stain" disabled="true">
                <option value="-"></option>
                <option value="Cryptococcus neoformans seen">Cryptococcus neoformans seen</option>
                <option value="Pencillium seen">Pencillium seen</option>
                <option value="fungal not seen">fungal not seen</option>
                <option value="Not Done">Not Done</option>
              </select>
            </div>
            <div class="col-sm-3 oi-giemsa" >
              <label class="form-label">India Ink Result</label>
              <select class="form-control" id="lymph_india_ink" disabled="true">
                <option value="-"></option>
                <option value="Cryptococcus neoformans seen">Cryptococcus neoformans seen</option>
                <option value="Pencillium seen">Pencillium seen</option>
                <option value="fungal not seen">fungal not seen</option>
                <option value="Not Done">Not Done</option>
              </select>
            </div>
          </div>
          <div class="row">
          <div class="col-sm-3 lab-technician">
            <label  class="form-label">Lab Technician</label>
            <select class="form-control"id="oi_lab_tech" name="" >
              <option value="-"></option>
              <option value="Lab Tech 1">Lab Technician 1</option>
              <option value="Lab Tech 2">Lab Technician 2</option>
              <option value="Lab Tech 3">Lab Technician 3</option>
              <option value="Lab Tech 4">Lab Technician 4</option>
              <option value="Lab Tech 5">Lab Technician 5</option>
              <option value="Lab Tech 6">Lab Technician 6</option>
              <option value="Lab Tech 7">Lab Technician 7</option>
            </select>
          </div>

          <!-- <div class="col-sm-2">
          </div> -->
          <div class="col-sm-3 lab-issueDate">
          <label for="validationCustom01" class="form-label">Issue Date(dd  mm  yyyy)</label>
          <input id="oi_issue_date" type="date"  onblur="dateOver(8)" class="form-control" id="validationCustom01">
          <div class="valid-feedback">
            Plz put Patient's Issue Date.
          </div>
          </div>
          </div>
          <div class="row save-updte">
              <div class="col-sm-3"style="padding-top:10px;">
                <button type="button" id="oiSave" onclick="oi_save()" class="btn btn-primary btn-lg save-batton">Save & Print</button>
              </div>
              <div class="col-sm-2">
                <span id="noti_oi"></span>
              </div>
              <div class="col-sm-3" id="oiUpdate" style="padding-top:10px;">
                <!-- <button onclick="oiUpdate()" id='oiUpdate_btn' type="button" class="btn btn-warning btn-lg update-batton"> Update Data</button> -->
                <button onclick="oiUpdate()"style="display:none;" id='oiUpdate_btn' type="button" class="btn btn-warning btn-lg update-batton"> Update Data</button>
              </div>
            </div>
          </div>
        <div class="tab-pane container fade lab-incon-div" id="gt">
            <div class="row">
              <div class="col-sm-3 gt-dangueRdt" >
                <label class="form-label">Dangue RDT Test</label>
                <select class="form-control" id="dangue_rdt" onchange=validation()>
                  <option value="-"></option>
                  <option value="1">Done</option>
                  <!-- <option value="0">Not Done</option> -->
                </select>
              </div>
              <div class="col-sm-3 gt-ns1" >
                <label class="form-label">NS1 Antigen</label>
                <select class="form-control" id="NS1_antigen"disabled="true">
                  <option value="-"></option>
                  <option value="NS1 Ag(+)">NS1 Ag(+)</option>
                  <option value="NS1 Ag(-)">NS1 Ag(-)</option>
                </select>
              </div>
              <div class="col-sm-3" >
                <label class="form-label">IgG</label>
                <select class="form-control" id="igG" disabled="true">
                  <option value="-"></option>
                  <option value="IgG(+)">IgG(+)</option>
                  <option value="IgG(-)">IgG(-)</option>
                </select>
              </div>
              <div class="col-sm-3" >
                <label class="form-label">IgM</label>
                <select class="form-control" id="igm"disabled="true">
                  <option value="-"></option>
                  <option value="IgM(+)">IgM(+)</option>
                  <option value="IgM(-)">IgM(-)</option>
                </select>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-3 gt-rdt" >
                <label class="form-label">Malaria RDT</label>
                <select class="form-control" id="malaria_rdt"onchange=validation()>
                  <option value="-"></option>
                  <option value="1">Done</option>
                  <option value="0">Not Done</option>
                </select>
              </div>
              <div class="col-sm-3 gt-rdt" >
                <label class="form-label">RDT Result</label>
                <select class="form-control" id="malaria_rdt_result" disabled="true">
                  <option value="-"></option>
                  <option value="Negative">Negative</option>
                  <option value="Pf Positive">Pf Positive</option>
                  <option value="Pv Positive">Pv Positive</option>
                  <option value="Pan Positive">Pan Positive</option>
                  <option value="Mix inf">Mix infection</option>
                </select>
              </div>
              <div class="col-sm-3 gt-malria" >
                <label class="form-label">Malaria Microscopy</label>
                <select class="form-control" id="malaria_microscopy"onchange=validation() >
                  <option value="-"></option>
                  <option value="1">Done</option>
                  <!-- <option value="0">Not Done</option> -->
                </select>
              </div>
              <div class="col-sm-1 gt-sgs" >
                <label class="form-label">Species</label>
                <select class="form-control" id="mal_spec" disabled="true">
                  <option value="-"></option>
                  <option value="Not Seen">Not Seen</option>
                  <option value="Pf">Pf</option>
                  <option value="Pv">Pv</option>
                  <option value="Pm">Pm</option>
                  <option value="Po">Po</option>
                  <option value="mix(pf+pv)">Mix(Pf+Pv)</option>
                  <option value="mix(pf+pm)">Mix(Pf+Pm)</option>
                  <option value="mix(pv+pm)">Mix(Pv+Pm)</option>
                  <option value="mix(pf+po)">Mix(Pf+Po)</option>
                  <option value="mix(pv+po)">Mix(Pv+Po)</option>
                </select>
              </div>
              <div class="col-sm-1 gt-sgs" >
                <label class="form-label">Grade</label>
                <select class="form-control" id="mal_grade" disabled="true">
                  <option value="-"></option>
                  <option value="(+)">(+)</option>
                  <option value="(++)">(++)</option>
                  <option value="(+++)">(+++)</option>
                  <option value="(++++)">(++++)</option>
                  <option value="(++++)">(++++)</option>

                </select>
              </div>
              <div class="col-sm-1 gt-sgs" >
                <label class="form-label">Stages</label>
                <select class="form-control" id="mal_stage" disabled="true">
                  <option value="-"></option>
                  <option value="t">t</option>
                  <option value="g">g</option>
                  <option value="tg">tg</option>
                  <option value="tsg">tsg</option>
                </select>
              </div>
            </div>
            <div class="row">
              <!-- <div class="col-sm-3" >
              <label class="form-label">RBS</label>
              <select class="form-control" id="rbs">
              <option value="-"></option>
              <option value="1">Done</option>
              <option value="0">Not Done</option>
            </select>
              </div> -->
            <div class="col-sm-3 gt-result" >
            <label class="form-label">RBS Result</label>
            <input type="number" class="form-control" id="rbs_result"  onchange="RBSResult()" value="0">
          </div>
              <!-- <div class="col-sm-3" >
              <label class="form-label">FBS</label>
              <select class="form-control" id="fbs">
              <option value="-"></option>
              <option value="1">Done</option>
              <option value="0">Not Done</option>
              </select>
              </div> -->
              <div class="col-sm-3 gt-result" >
            <label class="form-label">FBS Result</label>
            <input type="number" class="form-control" id="fbs_result" value="0" onchange="FBSResult()">
          </div>
            <div class="col-sm-3 gt-homodl" >
            <label class="form-label">Haemoglobin % (g/dl)</label>
            <input type="number" class="form-control" id="haemoPercent" value="0" onchange="haemo()">
          </div>
            <div class="col-sm-3 gt-hba1c" >
            <label class="form-label">HbA1C</label>
            <input type="number" class="form-control" id="hba1c" value="0">
          </div>
          </div>

          <div class="row">
            <div class="col-sm-3 lab-technician">
              <label  class="form-label">Lab Technician</label>
              <select class="form-control"id="gt_lab_tech" name="" >
                <option value="-"></option>
                <option value="Lab Tech 1">Lab Technician 1</option>
                <option value="Lab Tech 2">Lab Technician 2</option>
                <option value="Lab Tech 3">Lab Technician 3</option>
                <option value="Lab Tech 4">Lab Technician 4</option>
                <option value="Lab Tech 5">Lab Technician 5</option>
                <option value="Lab Tech 6">Lab Technician 6</option>
                <option value="Lab Tech 7">Lab Technician 7</option>
              </select>
            </div>
            <!-- <div class="col-sm-3">
          </div>
          <div class="col-sm-2">
          </div> -->
          <div class="col-sm-3 lab-issueDate">
            <label for="validationCustom01" class="form-label">Issue Date(dd  mm  yyyy)</label>
            <input id="gt_issue_date" type="date" onblur="dateOver(9)" class="form-control" id="validationCustom01">
            <div class="valid-feedback">
              Plz put Patient's Issue Date.
            </div>
          </div>
          </div>
          <div class="row save-updte">
            <div class="col-sm-3" style="padding-top:10px;">
              <button type="button" id="gtSave" onclick="gt_save()" class="btn btn-primary btn-lg save-batton">Save & Print</button>
            </div>
            <div class="col-sm-2">
              <span id="noti_gt"></span>
            </div>
            <div class="col-sm-3" style="padding-top:10px;">
              <button type="button" style="display:none;" id="gtUpdate_btn" onclick="gtUpdate()" class="btn btn-warning btn-lg update-batton"> Update Data</button>  <!-- gt-save -->
            </div>
          </div>
        </div>
        <div class="tab-pane container fade lab-incon-div" id="stool">
          <div class="row" id="stDrow_1">
            <div class="col-sm-3" >
              <label class="form-label">Stool RE Test Done</label>
              <select class="form-control" id="st_stool" onchange=validation()>
                <option value="-"></option>
                <option value="1">Done</option>
                <!-- <option value="0">Not Done</option> -->
              </select>
            </div>
            <div class="col-sm-3" >
              <label class="form-label">Colour</label>
              <select class="form-control" id="st_colour" disabled='true'>
                <option value="-"></option>
                <option value="yellow">Yellow</option>
                <option value="Brown">Brown</option>
                <option value="Black">Black</option>
                <option value="Bloodstain">Blood Stain</option>
              </select>
            </div>
            <div class="col-sm-3" >
              <label class="form-label">WBCs/ PUS cell</label>
              <select class="form-control" id="wbc_pus_cell" disabled='true'>
                <option value="-"></option>
                <option value="Present">Present</option>
                <option value="Absent">Absent</option>
              </select>
            </div>
            <div class="col-sm-3" >
              <label class="form-label">Consistency</label>
              <select class="form-control" id="st_consistency" disabled='true'>
                <option value="-"></option>
                <option value="solid">Solid</option>
                <option value="soft">Soft</option>
                <option value="liquid">Liquid</option>
                <option value="mucus">Mucus</option>
                <option value="rice_watery">Rice Watery</option>
              </select>
            </div>
          </div>
          <div class="row" id="stDrow_2">
            <div class="col-sm-3" >
              <label class="form-label">RBCs</label>
              <select class="form-control" id="st_rbcs" disabled='true'>
                <option value="-"></option>
                <option value="Present">Present</option>
                <option value="Absent">Absent</option>
              </select>
            </div>
            <div class="col-sm-9">
              <label class="form-label" >Other</label>
              <input type="text" id="st_other" class="form-control" value="-" disabled='true'>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12">
              <label class="form-label">Comment</label>
              <input type="text" id="st_comment" class="form-control" value="-">
            </div>
          </div>
          <div class="row">
            <div class="col-sm-3 lab-technician">
              <label  class="form-label">Lab Technician</label>
              <select class="form-control"id="st_lab_tech" name="" >
                <option value="-"></option>
                <option value="Lab Tech 1">Lab Technician 1</option>
                <option value="Lab Tech 2">Lab Technician 2</option>
                <option value="Lab Tech 3">Lab Technician 3</option>
                <option value="Lab Tech 4">Lab Technician 4</option>
                <option value="Lab Tech 5">Lab Technician 5</option>
                <option value="Lab Tech 6">Lab Technician 6</option>
                <option value="Lab Tech 7">Lab Technician 7</option>
              </select>
            </div>

            <div class="col-sm-3 lab-issueDate">
              <label for="validationCustom01" class="form-label">Issue Date(dd  mm  yyyy)</label>
              <input id="st_issue_date" type="date" onblur="dateOver(10)" class="form-control" id="validationCustom01">
              <div class="valid-feedback">
                Plz put Patient's Issue Date.
              </div>
            </div>
          </div>
          <div class="row save-updte">
            <div class="col-sm-3"style="padding-top:10px;">
              <button type="button" id="stoolSave" onclick="stSave()" class="btn btn-primary btn-lg save-batton">Save & Print</button>
            </div>
            <div class="col-sm-2">
              <span id="noti_st"></span>
            </div>
            <div class="col-sm-3" style="padding-top:10px;">
              <button onclick="stUpdate()"style="display:none;" id='stUpdate_btn'type="button" class="btn btn-warning btn-lg update-batton"> Update Data</button>
            </div>
          </div>
        </div>
        <div class="tab-pane container fade lab-incon-div" id="afb">
          <div class="row">
            <div class="col-sm-3" >
              <label class="form-label">Patient Name</label>
              <span  id="afb_pt_name"class="form-control" ></span>
            </div>
            <div class="col-sm-9" >
              <label class="form-label">Patient Address</label>
              <span  id="afb_pt_address"class="form-control" ></span>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-3 afb-previous">
              <label  class="form-label">Previous Tretment TB</label>
              <select class="form-control"id="Previous_TB" name="" >
                <option value="-"></option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
                <option value="Unknown">Unknown</option>
              </select>
            </div>
            <div class="col-sm-3">
              <label  class="form-label">HIV Status</label>
              <select class="form-control"id="HIV_status" name="" >
                <option value="-"></option>
                <option value="Positive">Positive</option>
                <option value="Negative">Negative</option>
                <option value="Unknown">Unknown</option>
              </select>
            </div>
          </div>
          <div class="row afb-reasonRow">
            <div class="col-sm-3 afb-reasonExam" >
              <label class="form-label">Reason for examination</label>
              <input type="text" id="reason_for_exam"class="form-control" name="" value="">
            </div>
            <div class="col-sm-3 afb-diagnosis">
              <label  class="form-label">Diagnosis/Followup</label>
              <select class="form-control"id="afb_Pt_type" name="" >
                <option value="-"></option>
                <option value="Diagnosis">Diagnosis</option>
                <option value="Follow-up">FollowUp</option>
              </select>
            </div>
            <div class="col-sm-3">
              <label  class="form-label">Follow Up Month</label>
              <select class="form-control"id="follow_up_mt" name="" >
                <option value="-"></option>
                <option value="Month 2">Month 2</option>
                <option value="Month 3">Month 3</option>
                <option value="Month 4">Month 4</option>
                <option value="Month 5">Month 5</option>
                <option value="Month 6">Month 6</option>
                <option value="Month 7">Month 7</option>
                <option value="Month 8">Month 8</option>
                <option value="Month 12">Month 12</option>
              </select>
            </div>
            <div class="col-sm-3">
              <label  class="form-label">Specimen type</label>
              <select class="form-control"id="speci_type" name="" >
                <option value="-"></option>
                <option value="Sputum">Sputum</option>
                <option value="Lymph_node">Lymph nodes</option>
                <option value="SSS">SSS</option>
                <option value="Flural Aspiration">Fleural aspirate</option>
                <option value="Urine">Urine</option>
                <option value="Stool">Stool</option>
                <option value="CSF">CSF</option>
              </select>
            </div>
          </div>
          <div class="row afb-sample">
            <div class="col-sm-4" >
              <label  class="form-label">Sample 1</label>  <!-- -->
            </div>
            <!-- <div class="col-sm-3">  </div> -->
            <div class="col-sm-4">
              <label  class="form-label">Sample 2</label>  <!-- color:red; -->
            </div>
          </div>
          <div class="row afb-slide" >
            <div class="col-sm-4" >
              <label class="form-label">Slide Number</label>
              <input type="number" id="slide_num_1"class="form-control" value="0" >
            </div>
            <!-- <div class="col-sm-3">  </div> -->
            <div class="col-sm-4" >
              <label class="form-label">Slide Number</label>
              <input type="number" id="slide_num_2"class="form-control" value="0" >
            </div>
          </div>
          <div class="row afb-slidedata afbslide-date" >

            <div class="col-sm-4" >
              <label class="form-label">Specimen received date</label>
              <input type="date" onblur="dateOver(13)" id="speci_receive_dt1"class="form-control" name="" value="-">
            </div>
            <!-- <div class="col-sm-3"> </div>  -->
            <div class="col-sm-4 " >
              <label class="form-label">Specimen received date</label>
              <input type="date" onblur="dateOver(14)" id="speci_receive_dt2"class="form-control" name="" value="-">
            </div>
          </div>
          <div class="row afb-slidedata" >
            <div class="col-sm-4">
              <label  class="form-label">Visual Appearance</label>
              <select class="form-control"id="visual_app_1" name="" >
                <option value="-"></option>
                <option value="Sputum">Sputum</option>
                <option value="Non Sputum">Non sputum</option>
                <option value="Blood Stain">Blood stain</option>
              </select>
            </div>
            <!-- <div class="col-sm-3">  </div> -->
            <div class="col-sm-4">
              <label  class="form-label">Visual Appearance</label>
              <select class="form-control"id="visual_app_2" name="" >
                <option value="-"></option>
                <option value="Sputum">Sputum</option>
                <option value="Non Sputum">Non Sputum</option>
                <option value="Blood Stain">Blood Stain</option>
              </select>
            </div>
          </div>
          <div class="row afb-slidedata" >
            <div class="col-sm-4">
              <label  class="form-label">AFB Result</label>
              <select class="form-control"id="afb_result1" name="" >
                <option value="-"></option>
                <option value="Scanty">Scanty</option>
                <option value="1+">1+</option>
                <option value="2+">2+</option>
                <option value="3+">3+</option>
                <option value="Negative">Negative</option>
              </select>
            </div>
            <!-- <div class="col-sm-3">  </div> -->
            <div class="col-sm-4">
              <label  class="form-label"> AFB Result </label>
              <select class="form-control"id="afb_result2" name="" >
                <option value="-"></option>
                <option value="Scanty">Scanty</option>
                <option value="1+">1+</option>
                <option value="2+">2+</option>
                <option value="3+">3+</option>
                <option value="Negative">Negative</option>
              </select>
            </div>
          </div>
          <div class="row afb-slidedata">
            <div class="col-sm-4">
              <label  class="form-label">Scanty Grading</label>
              <select class="form-control"id="sacnty_grading1" name="" >
                <option value="-"></option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
              </select>
            </div>
            <!-- <div class="col-sm-4">  </div> -->
            <div class="col-sm-4">
              <label  class="form-label">Scanty Grading</label>
              <select class="form-control"id="sacnty_grading2" name="" >
                <option value="-"></option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
              </select>
            </div>
          </div>
          <div class="row" >
            <div class="col-sm-3 lab-technician">
              <label  class="form-label">Lab Technician</label>
              <select class="form-control"id="afb_lab_tech" name="" >
                <option value="-"></option>
                <option value="Lab Tech 1">Lab Technician 1</option>
                <option value="Lab Tech 2">Lab Technician 2</option>
                <option value="Lab Tech 3">Lab Technician 3</option>
                <option value="Lab Tech 4">Lab Technician 4</option>
                <option value="Lab Tech 5">Lab Technician 5</option>
                <option value="Lab Tech 6">Lab Technician 6</option>
                <option value="Lab Tech 7">Lab Technician 7</option>
              </select>
            </div>

            <div class="col-sm-3 lab-issueDate">
              <label for="validationCustom01" class="form-label">Issue Date(dd  mm yyyy)</label>
              <input id="afb_issue_date" type="date" onblur="dateOver(10)" class="form-control" id="validationCustom01">
              <div class="valid-feedback">
                Plz put Patient's Issue Date.
              </div>
            </div>
          </div>
          <div class="row save-updte" >
            <div class="col-sm-3"style="padding-top:10px;">
              <button type="button" id="afbSave" onclick="afb_save()" class="btn btn-primary btn-lg save-batton">Save & Print</button>
            </div>
            <div class="col-sm-2">
              <span id="noti_afb"></span>
            </div>
            <div class="col-sm-3"style="padding-top:10px;" >
              <button onclick="afbUpdate()" style="display:none;" id='afbUpdate_btn'type="button" class="btn btn-warning btn-lg update-batton"> Update Data</button>
            </div>
          </div>
        </div>
        <div class="tab-pane container fade lab-incon-div" id="covid">
          <div class="row">
            <div class="col-sm-1 covid-age" >
              <label class="form-label">Age</label>
              <input type="number" id="co_Age"class="form-control" name="" value="">
            </div>
            <div class="col-sm-2 covid-tpatient">
              <label  class="form-label">Type of Patient</label>
              <select class="form-control"id="type_of_patient_covid" name="" >
                <option value="-"></option>
                <option value="PHA">PHA</option>
                <option value="General">General</option>
              </select>
            </div>
            <div class="col-sm-2 covid-testType">
              <label  class="form-label">Specimen Type</label>
              <select class="form-control"id="specimen_type" name="" >
                <option value="-"></option>
                <option value="Nasopharyngeal">Nasopharyngeal</option>
                <option value="Oropharyngeal">Oropharyngeal</option>
                <option value="Other">Other</option>
              </select>
            </div>
            <div class="col-sm-2 covid-testType">
              <label  class="form-label">Test Type</label>
              <select class="form-control"id="co_test_type" name="" >
                <option value="-"></option>
                <option value="Rapid Test(Ag)">Rapid Test(Ag)</option>
                <option value="Rapid Test(Ab)">Rapid Test(Ab)</option>
                <option value="PCR">PCR</option>
              </select>
            </div>
            <div class="col-sm-1 covid-testType">
              <label  class="form-label">Result</label>
              <select class="form-control"id="covid_result" name="" >
                <option value="-"></option>
                <option value="Positive">Positive</option>
                <option value="Negative">Negative</option>
              </select>
            </div>
            <div class="col-sm-4 covid-comment"  >
              <label class="form-label">Comment</label>
              <input type="text" id="co_comment"class="form-control">
            </div>
          </div>
          <div class="row" >
            <div class="col-sm-3 lab-technician">
              <label  class="form-label">Lab Technician</label>
              <select class="form-control"id="covid_lab_tech" name="" >
                <option value="-"></option>
                <option value="Lab Tech 1">Lab Technician 1</option>
                <option value="Lab Tech 2">Lab Technician 2</option>
                <option value="Lab Tech 3">Lab Technician 3</option>
                <option value="Lab Tech 4">Lab Technician 4</option>
                <option value="Lab Tech 5">Lab Technician 5</option>
                <option value="Lab Tech 6">Lab Technician 6</option>
                <option value="Lab Tech 7">Lab Technician 7</option>
              </select>
            </div>

            <div class="col-sm-3 lab-issueDate">
              <label for="validationCustom01" class="form-label">Issue Date(dd  mm  yyyy)</label>
              <input id="covid_issue_date" type="date" onblur="dateOver(12)" class="form-control" id="validationCustom01">
              <div class="valid-feedback">
                Plz put Patient's Issue Date.
              </div>
            </div>
          </div>
          <div class="row save-updte" >
            <div class="col-sm-3"style="padding-top:10px;">
              <button type="button" id="covidSave" onclick="covidData()" class="btn btn-primary btn-lg save-batton">Save & Print</button>
            </div>
            <div class="col-sm-2">
              <span id="noti_covid"></span>
            </div>
            <div class="col-sm-3"style="padding-top:10px;">
              <button onclick="covidUpdate()" style="display:none;" id='covidUpdate_btn'type="button" class="btn btn-warning btn-lg update-batton"> Update Data</button>
            </div>
          </div>
        </div>
        <div class="tab-pane container fade viralLoad-container" id="viral_load" >
          <div class="row ">
            <div class="col-sm-3 viralLoad-arso" >
              <label class="form-label">ART initiation</label>
              <input type="date" id="art_initial_date_time"  class="form-control" name="" value="">
            </div>
            <div class="col-sm-2 viralLoad-arso">
              <label  class="form-label">ART duration(Months)</label>
              <input type="number" id="art_duration" onfocus="art_duration_month()" class="form-control"  placeholder="Months" >
            </div>
            <div class="col-sm-3 viralLoad-arso">
              <label  class="form-label">Sample shipment date</label>
              <input type="date" id="sample_ship_date"class="form-control" name="" value="">
            </div>
            <div class="col-sm-3 viralLoad-arso">
              <label  class="form-label">Sample sent to</label>
              <select class="form-control"id="sample_sent_to" name="" >
                <option value="-"></option>
                <option value="NHL">NHL</option>
                <option value="Office Lab">Office Lab</option>
                <option value="Other">Other</option>
              </select>
            </div>
            <div class="col-sm-2 viralLoad-arso" >
              <label class="form-label">Other Organization Code</label>
              <input type="text" id="other_org_code"class="form-control">
            </div>

          </div>
          <div class="row viralLoad-dateResult" >
            <div class="col-sm-3">
              <label  class="form-label">Result Received date</label>
              <input type="date" id="result_received_date"class="form-control" name="" value=" ">
            </div>
            <div class="col-sm-2 viralLoad-arso" >
              <label  class="form-label">Detectable</label>
              <select class="form-control"id="detectable" onchange="viral_load_detect()" >
                <option value="Detectable">Detectable</option>
                <option value="Undetectable">Undetectable</option>
              </select>
            </div>
            <div class="col-sm-2  viralLoad-arso" style="display:none;" id="div_of_viral_load_st" >
              <label  class="form-label"> If Undetectable</label>
              <select class="form-control" id="viral_load_result_st">
                <option value="< 10">< 10</option>
                <option value="< 40"> < 40</option>
                <option value="< 250"> < 250</option>
              </select>
            </div>
            <div class="col-sm-2" id="div_of_viral_load" >
              <label class="form-label">Viral Load Result</label>
              <input type="number" id="viral_load_result"class="form-control" value="0">
            </div>
            <div class="col-sm-3" >
              <label class="form-label">Remark</label>
              <input type="text" id="remark"class="form-control">
            </div>


          </div>
          <div class="row save-updte" >
            <div class="col-sm-3"style="padding-top:10px;">
              <button type="button" id="viralSave" onclick="viral_load()" class="btn btn-primary btn-lg save-batton">Save & Print</button>
            </div>
            <div class="col-sm-2">
              <span id="noti_viral"></span>
            </div>
            <div class="col-sm-3"style="padding-top:10px;">
              <button onclick="viral_loadUpdate()" style="display:none;" id='viralUpdate_btn'type="button" class="btn btn-warning btn-lg update-batton"> Update Data</button>
            </div>
          </div>
        </div>
        <div class="tab-pane container fade lab-incon-div" id="finder">
          <div class="">
          <div class="row">
            <div class="col-sm-12">
              <label class="form-label header-text">Test History Of the Patient</label>
            </div>
          </div>
          <div class="row finder-row">
            <div class="col-md-3">
              <input id="id_hist" type="number" autofocus  class="form-control" placeholder="Patient's ID" >
              <div class="valid-feedback">
                Plz put Patient's ID.
              </div>
            </div>
            <div class="col-md-4">
              <button type="button"  onclick="testHistory()" class="btn btn-primary btn-lg">Search Tests History</button>
            </div>
          </div>
          <br>
          <div class="row " style="margin:auto;">
            <div class="col-md-12 finder-table">
              <table class="table table-hover table-bordered" >
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Date</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody id="testHistory" >
                </tbody>
              </table>
            </div>
          </div>
          </div>

        </div>  <!--  search and update -->
        <div class="tab-pane container containers cosulor-parent-div " id="export">
            <h1>Export</h1>
            <form action="{{ route('lab_export_link') }}" method="POST" enctype="multipart/form-data">
              @csrf
            <br>
            <div class="row ">
             
              <div class="col-md-2 ">
                <label for="">Choose Test</label>
                <select class="form-select"  name="testNN"required>
                  <option selected  value="-"></option>
                  <option value="hiv">HIV Test</option>
                  <option value="rpr">RPR Test</option>
                  <option value="sti">STI Test</option>
                  <option value="hep_bc">Hep B/C Test</option>
                  <option value="urine">Urine Test</option>
                  <option value="oi">OI Test</option>
                  <option value="general">General Test</option>
                  <option value="stool">Stool Test</option>
                  <option value="afb">AFB Test</option>
                  <option value="covid19">Covid_19 Test</option>
                  <option value="viral">Viral Load Test</option>
                </select>
              </div>
            
              <div class="col-sm-2 counHTS-date">
                <label  class="form-label HTS-label">From(dd-mm-yyyy)</label>
                <input id="from_export" name="dateFrom" type="date" autofocus class="form-control" >
              </div>
             
              <div class="col-sm-2 counHTS-date">
                <label  class="form-label HTS-label">To(dd-mm-yyyy)</label>
                <input id="to_export" name="dateTo" type="date"  class="form-control" >
              </div>
              <div class="col-sm-1 no-margin">
                <button   class="btn btn-primary lab-exportBtn">Export</button>
              </div>
            </div>
            <br>
            </form>
          </div>
    </div>

      </div>
      <br>
    </div>

    <div class="container">
      <div id="toshowResult" style="border: 1px solid #000000;" class='print-dispaly'>
        <div class="row">
          <div class="col-sm-12"id="printLogo" ></div>
        </div>
        <div class="row"id="printPtInfo">
        </div>
        <div class="row"id="printResultTable"></div>
      </div> <!-- Print Page View -->
    </div>
  <!-- </form> -->
</body>
@endauth
@endsection
<script type="text/javascript">

let present=0;
let PtID=0;
let Ptype_sub="";let pregMum=0;let spm=0;let epc=0; let lr =0;let fsw = 0; let msm= 0 ;let idu = 0;let pkp =0;let sg=0;let tg=0;
let hider = 0;let bton= 0; let resp = 0;let rowNo=0; let rowID=0; let liveID=0;
let updateBundle=[];
var pirnt_header="";
let resp_old =[];
let update_rowNo_hiv = 0;
let update_rowNo_rpr = 0;
let update_rowNo_sti = 0;
let update_rowNo_hbc = 0;
let update_rowNo_urine = 0;
let update_rowNo_oi = 0;
let update_rowNo_gt = 0;
let update_rowNo_st = 0;
let update_rowNo_afb = 0;
let update_rowNo_covid = 0;
let update_rowNo_viral = 0;

let save_update_hiv=0;
let save_update_rpr=0;
let save_update_sti=0;
let save_update_hbc=0;
let save_update_urine=0;
let save_update_oi=0;
let save_update_gt=0;
let save_update_st=0;
let save_update_afb=0;
let save_update_covid=0;
let save_update_viral=0;
// For Date
var date = new Date();
var day = date.getDate();
var month = date.getMonth() + 1;
var year = date.getFullYear();
if (month < 10) month = "0" + month;
if (day < 10) day = "0" + day;
var today = year + "-" + month + "-" + day;
var agey =0; var agem=0; var gender =""; var main_risk =""; var sub_risk="";



function ptData(){
  // For Date
  var date = new Date();
  var day = date.getDate();
  var month = date.getMonth() + 1;
  var year = date.getFullYear();
  if (month < 10) month = "0" + month;
  if (day < 10) day = "0" + day;
  var today = year + "-" + month + "-" + day;
  document.getElementById('vDate').value = today;
  document.getElementById('issue_date').value = today;
  document.getElementById('C_issueDate').value = today;
  document.getElementById('u_issuDate').value = today;
  document.getElementById('rpr_issue_date').value = today;
  document.getElementById('st_issue_date').value = today;
  document.getElementById('oi_issue_date').value = today;
  document.getElementById('gt_issue_date').value = today;
  document.getElementById('afb_issue_date').value = today;
  document.getElementById('covid_issue_date').value = today;
  document.getElementById('sti_issueDate').value = today;
  document.getElementById('bcdate').value = today;
  // End of Date
  var cid = document.getElementById("cid").value;
  var checkPatient = 1;
  var ckdata = {
    cid:cid,
    checkPatient:checkPatient
  };
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
    }
  });
  $.ajax({
    type:'POST',
    url:"{{route('tests')}}",

    dataType:'json',
    //  processData:false,
    contentType: 'application/json',
    data: JSON.stringify(ckdata),
    success:function(response){
      console.log(response);
      if(response[0]){
        // checked the patient's is in DB, OK to save
        present=1;
      }
      document.getElementById('unregistered').innerHTML="";
      if(response[1] != null){ // For RPR last Titre Result of the patient
        document.getElementById('titreLast').value=response[8];
        document.getElementById('titreLast').style="color:red;";
        console.log("the length is rpr titre current"+ response[8].length);
        if(response[8].length>2){
          document.getElementById('rdtYes_no').disabled="true";
        }
        document.getElementById('lastTitreDate').value=response[1]["visit_date"];
        document.getElementById('lastTitreDate').style="color:red;";
      }
      if(response[0]== null){
        location.reload(true);// to refresh the page
      }
      if (response[0] != null) {
        // to open input box
        document.getElementById('fuchiaID').disabled=false;
        document.getElementById('agey').disabled=false;
        document.getElementById('agem').disabled=false;
        document.getElementById('gender').disabled=false;
        document.getElementById('vDate').disabled=false;
        document.getElementById('md').disabled=false;
        document.getElementById('Ptype').disabled=false;
        document.getElementById('ext').disabled=false;
        //button enabled
        //   document.getElementById('patientData').style.visibility = "visible";
        document.getElementById('unregistered').style.visibility = "hidden";
        document.getElementById('urineSave').disabled=false;
        // get data
        var ptdata = document.getElementById('patientData');
        // output response.
        // document.getElementById('patientIDshow').innerHTML=response[0]["Pid"];
        // document.getElementById('ageshow').innerHTML=  response[0]["Age"];
        //   document.getElementById('sexshow').innerHTML= response[0]["Sex"];
        document.getElementById('fuchiaID').value= response[0]["FuchiaID"];
        var bd_date = response[3];
        var dateSplited = bd_date.split("-");
        var dtYear = dateSplited[0];
        var dtMonth = dateSplited[1];
        if(dtYear == year){
          document.getElementById("agem").innerHTML= (month+1) - dtMonth;
        }else{
          document.getElementById("agey").innerHTML=getAge(bd_date);
        }
        document.getElementById('gender').innerHTML= response[5];
        document.getElementById('afb_pt_name').innerHTML= response[2];
        ////console.log(response);
        document.getElementById('afb_pt_address').innerHTML=response[4];
        document.getElementById('co_Age').value= response[0]["Agey"];
        var main_risk = response[6];
        var sub_risk = response[7];
        if(main_risk != null){
          document.getElementById('Ptype').innerHTML="";
          document.getElementById('Ptype').innerHTML=main_risk;
        }
        if(sub_risk != null){
          document.getElementById('ext').innerHTML=sub_risk;
        }
        var ac_gender= response[5];
        if(ac_gender == "Male"){


          document.getElementById('clue_post_fornix').disabled=true;
          document.getElementById('pmnl_endocevix').disabled=true;
          document.getElementById('pmnl_post_fix').disabled=true;
          document.getElementById('gram_intra_postfornix').disabled=true;
          document.getElementById('gram_intra_endo').disabled=true;
          document.getElementById('gram_extra_postfornix').disabled=true;
          document.getElementById('gram_extra_endo').disabled=true;
          document.getElementById('candida_postfornix').disabled=true;
          document.getElementById('candida_endo').disabled=true;
          document.getElementById('Sper_other_post').disabled=true;
          document.getElementById('Sper_other_endo').disabled=true;
        }
        if(ac_gender=="Female"){
          document.getElementById('clue_post_fornix').disabled=false;
          document.getElementById('pmnl_urethra').disabled=false;
          document.getElementById('pmnl_post_fix').disabled=false;
          document.getElementById('gram_intra_postfornix').disabled=false;
          document.getElementById('gram_intra_endo').disabled=false;
          document.getElementById('gram_extra_postfornix').disabled=false;
          document.getElementById('gram_extra_endo').disabled=false;
          document.getElementById('candida_postfornix').disabled=false;
          document.getElementById('candida_endo').disabled=false;
          document.getElementById('Sper_other_post').disabled=false;
          document.getElementById('Sper_other_endo').disabled=false;

          // document.getElementById('pmnl_rectum').disabled=true;
          // document.getElementById('gram_intra_rectum').disabled=true;
          // document.getElementById('gram_extra_rectum').disabled=true;
          // document.getElementById('Sper_other_rectum').disabled=true;

        }
      }
    }
  });



}
function validation(){
  var ide = event.target.id;
  var uvalid = $("#urine_exam_done").val();
  var hepatB=$('#hepB').val();
  var hepatC=$('#c_test').val();
  var toxo=$('#toxo_plasma').val();
  var csf_sm=$('#csf_smear').val();
  var skin_sm=$('#skin_smear').val();
  var lymp=$('#lymph_test').val();
  var dangue_rdt=$('#dangue_rdt').val();
  var malaria_rdt=$('#malaria_rdt').val();
  var malaria_microscopy=$('#malaria_microscopy').val();
  var st_stool=$('#st_stool').val();

  switch(ide) {
    case "urine_exam_done" :
    if(uvalid=="Done") {
      $("#u_table2").find('select,input').prop('disabled', false);
    }else if(uvalid=="-"){
      ////console.log("hello disable");
      $("#u_table2").find('select,input').prop('disabled',true);
      $("#u_table2").find('#urine_exam_done').prop('disabled',false);
    }
    break;
    case "hepB":
    if(hepatB=="Done"){
      $('#B_result').prop('disabled',false);
    }else if(hepatB=="-"){
      $('#B_result').prop('disabled',true)
    }
    break;
    case "c_test":
    if(hepatC=="Done"){
      $('#c_result').prop('disabled',false);
    }else if(hepatC=="-"){
      $('#c_result').prop('disabled',true);
    }
    break;
    case "toxo_plasma":
    if(toxo=="Done"){
      $('#toxo_igG').prop('disabled',false);
      $('#toxo_igm').prop('disabled',false);
    }else if(hepatC=="-"){
      $('#toxo_igG').prop('disabled',true);
      $('#toxo_igm').prop('disabled',true);
    }
    break;
    case "csf_smear":
    if(csf_sm=="Done"){
      $('#giemsa_stain_result').prop('disabled',false);
      $('#india_ink_result').prop('disabled',false);
    }else if(csf_sm=="-"){
      $('#giemsa_stain_result').prop('disabled',true);
      $('#india_ink_result').prop('disabled',true);
    }
    break;
    case "skin_smear":
    if(skin_sm=="Done"){
      $('#skin_giemsa_stain_result').prop('disabled',false);
      $('#skin_india_ink_result').prop('disabled',false);
    }else if(skin_sm=="-"){
      $('#skin_giemsa_stain_result').prop('disabled',true);
      $('#skin_india_ink_result').prop('disabled',true);
    }
    break;
    case "lymph_test":
    if(lymp=="Done"){
      $('#lymph_giemsa_stain').prop('disabled',false);
      $('#lymph_india_ink').prop('disabled',false);
    }else if(lymp=="-"){
      $('#lymph_giemsa_stain').prop('disabled',true);
      $('#lymph_india_ink').prop('disabled',true);
    }
    break;
    case "dangue_rdt":
    if(dangue_rdt=="1"){
      ////console.log("hello dangue");
      $('#NS1_antigen').prop('disabled',false);
      $('#igG').prop('disabled',false);
      $('#igm').prop('disabled',false);
    }else if(dangue_rdt=="-"){
      // NS1_antigen
      $('#NS1_antigen').prop('disabled',true);
      $('#igG').prop('disabled',true);
      $('#igm').prop('disabled',true);
    }
    break;

    case "malaria_rdt":
    if(malaria_rdt=="1"){
      $('#malaria_rdt_result').prop('disabled',false);
    }else if(malaria_rdt=="-"||malaria_rdt=="0"){
      $('#malaria_rdt_result').prop('disabled',true);
    }
    break;
    case "malaria_microscopy":
    if(malaria_microscopy=="1"){

      $('#mal_spec').prop('disabled',false);
      $('#mal_grade').prop('disabled',false);
      $('#mal_stage').prop('disabled',false);
    }else if(dangue_rdt=="-"){

      $('#mal_spec').prop('disabled',true);
      $('#mal_grade').prop('disabled',true);
      $('#mal_stage').prop('disabled',true);
    }
    break;
    case "st_stool":
    if(st_stool=="1"){
      ////console.log("hello stool enable");
      $('#stDrow_2').find('select,input').prop('disabled',false);
      $('#stDrow_1').find('select,input').prop('disabled',false);

    }else if(st_stool=="-"){
      ////console.log("hello stool disable");
      $('#stDrow_2').find('select,input').prop('disabled',true);
      $('#stDrow_1').find('select,input').prop('disabled',true);
      $('#st_stool').prop('disabled',false);

    }
    break;
    default:
    // code block
  }

}
function validation_rdt(){
  var rdt_yes = $('#rdtYes_no').val();
  if(rdt_yes =="-"){
    $('#Sy_rdt_result').prop('disabled',true);
  }else{
    $('#Sy_rdt_result').prop('disabled',false);
  }
}
function validation_rpr(){
  var rpr_yes = $('#rprYes-NO').val();
  if(rpr_yes =="-"){
    $('#qualitative').prop('disabled',true);
  }else{
    $('#qualitative').prop('disabled',false);
  }
}
function validation_rpr_reactive(){
  var rpr_reactive = $('#qualitative').val();
  if(rpr_reactive =="Reactive"){
    $('#titreCur').prop('disabled',false);
  }else{
    $('#titreCur').prop('disabled',true);
  }
}
// This is HIV data test and results
function hiv_save(){

  var cid = document.getElementById("cid").value;
  var created_by = document.getElementById("navbarDropdown").innerHTML;
  var agey = $("#agey").text();
  var agem = $("#agem").text
  agey = parseInt(agey);//changing to number
  agem = parseInt(agem);
  if(isNaN(agey)){
    agey=0;
  }
  if(isNaN(agem)){
    agem=0;
  }
  var gender = $("#gender").text();
  gender= String(gender);
  var fuchiaID = document.getElementById("fuchiaID").value;

  var clinic = 81;
  var vDate = document.getElementById("vDate").value;

  vDate = formatDate(vDate); // date FormatChange YYYY/MM/DD


  var Ptype = $("#Ptype").text();
  var ext_sub = $("#ext").text();
  if(ext_sub.length<33){// the blank response from text count is 32
    ext_sub ="-";
  }
  var reqDoctor = document.getElementById("md").value;

  var bcdate = $("#bcdate").val();
  bcdate = formatDate(bcdate); // date FormatChange YYYY/MM/DD

  var Incon = document.getElementById("inconslusive").checked;
  if(Incon == true){
    Incon = 1;
  }
  var d_result = $("#d_result").val();
  var uni_result = $("#uni_result").val();
  var stat_result = $("#stat_result").val();
  var final_result = $("#final_result").val();
  var comment = $("#comment").val();
  var lab_tech = $("#lab_tech").val();
  var issue_date = $("#issue_date").val();
  issue_date = formatDate(issue_date); // date FormatChange YYYY/MM/DD

  var reqDoctor = $("#md").val();
  var counsellor = $("#counselor").val();
  pirnt_header  = "HIV Test";

  var hiv=2;
  var hivdata={
    update_rowNo_hiv:update_rowNo_hiv,
    clinic:clinic,
    hiv:hiv,
    cid:cid,
    fuchiaID:fuchiaID,
    agey:agey,
    agem:agem,
    gender:gender,
    vDate:vDate,
    Ptype:Ptype,
    ext_sub:ext_sub,
    bcdate:bcdate,
    d_result:d_result,
    uni_result:uni_result,
    stat_result:stat_result,
    final_result:final_result,
    reqDoctor:reqDoctor,
    counsellor:counsellor,
    lab_tech:lab_tech,
    Incon,
    created_by:created_by,
  };

  if(cid.length >8 && final_result !="-" && present == 1){
    if (confirm("Are you sure you want to do save?")) {

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
      }
    });
    $.ajax({
      type:'POST',
      url:"{{route('tests')}}",
      dataType:'json',
      //  processData:false,
      contentType: 'application/json',
      data: JSON.stringify(hivdata),
      success:function(response){
        $("#printLogo").empty();
        $("#printPtInfo").empty();
        $("#printResultTable").empty();
        if(isNaN(agem)){
          var agems="__";
        }else {
          var agems=agem;
        }
        console.log(fuchiaID+"Fuchia ID")
        if(fuchiaID=="-"){
         var fuchiaID_print= "_________";
        }else {
          var fuchiaID_print=fuchiaID;
        };

        if(Number.isNaN(agey))  {
          var ageys= "____";
        }else {
          var ageys=agey;
        };

        if(reqDoctor.length <1){
          reqDoctor= "__________";
        };
        if (counselor <1){
          counselor="____";
        };
        if (lab_tech <1){
          lab_tech="_______";
        };

        //<img src="cinqueterre.jpg" class="rounded" alt="Cinque Terre">
        var logo =
        "<div class='row'>"+
        "<div class='d-flex justify-content-center' >"+

        "<h4  class='print-header clearfix'>"+  "<img src='/logoMAM.jpg'  alt='logo' style='width:70px;height:70px;'>"+
        "<p class='hiv-p'>"+"HIV Test Result"+"</p>"+"</h4>"+
        "</div>"+
        "</div>";

        var result_title=
        "<div class='d-flex justify-content-center print-coheader-list'>"+
        "<ul class='clearfix hiv-coheader'>"+
        "<li class='first-li'>"+"ID:"+"</li>"+"<li>"+cid+","+"</li>"+

        "<li class='first-li'>"+"Fuchia ID:"+"</li>"+"<li>"+fuchiaID_print+","+"</li>"+
        // "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
        "<li class='first-li'>"+"Date:"+"</li>"+"<li>"+vDate+","+"</li>"+
        // "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
        "<li class='first-li'>"+"Age(Y):"+"</li>"+"<li>"+ageys+","+"</li>"+
        // "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
        "<li class='first-li'>"+"Age(M):"+"</li>"+"<li>"+agems+","+"</li>"+
        // "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
        "<li class='first-li'>"+"Sex:"+"</li>"+"<li>"+gender+","+"</li>"+
        "</ul>"+

        "</div>";

        var result_body = "<div class='d-flex justify-content-center'>"
        +"<table class='table  print-hiv-table'>"+
        "<thead>"+
        "<tr>" +"<td>"+"NO."+"<td>"+"Test Name"+"</td>"+"<td>"+"Result"+"</td>"+"</tr>"+
        "</thead>"+
        "<tbody>"+
        "<tr id='tbrow'>"+"<td>"+"1"+"<td>"+"Determine Result"+"</td>"+"<td>"+"<p class='print-tr'id='hiv_save1' style=''>"+d_result+"</p>"+"</td>"+"</tr>"+
        "<tr id='tbrow'>"+"<td>"+"2"+"<td>"+"Uni-Gold Result"+"</td>"+"<td>"+"<p class='print-tr'id='hiv_save2' style=''>"+uni_result+"</p>"+"</td>"+"</tr>"+
        "<tr id='tbrow'>"+"<td>"+"3"+"<td>"+"Stat-Pak Result"+"</td>"+"<td>"+"<p class='print-tr' id='hiv_save3' style=''>"+stat_result+"</p>"+"</td>"+"</tr>"+
        "<tr id='tbrow'>"+"<td>"+""+"<td style='font-weight:bold'>"+"Final Result"+"</td>"+"<td style='font-weight:bold'>"+"<p class='print-tr' id='hiv_save4' style=''>"+final_result+"</p>"+"</td>"+"</tr>"+
        "<tr id='tbrow'>"+"<td>"+""+"<td>"+"Comment :"+"</td>"+"<td>"+"<p class='print-tr' id='hiv_save5' style=''>"+comment+"</p>"+"</td>"+"</tr>"+
        "</tbody>"+
        "</table>" +
        "</div>";
        var result_footer=
        "<div class='print-hiv-footer'>"
        +"<ul class='clearfix print-hiv-footer'>"+
        "<li class='first-li'>"
        +"Requested Doctor:"+"</li>"+"<li>"+reqDoctor+","+"</li>"
        +
        "<li class='first-li'>"
        +"Counsellor:"+"</li>"+"<li>"+counsellor+","+"</li>"
        +
        // "Counselor ::"+counselor+
        "<li>"
        +"Issue by-:"+"</li>"+"<li>"+lab_tech+","+"</li>"

        // "Issue by- "+lab_tech+
        +
        "<li>"
        +"Issue Date :"+"</li>"+"<li>"+issue_date+","+"</li>"
        +
        // "Issue Date :"+issue_date+
        "</div>";

        $("#printLogo").append(logo);

        $("#printPtInfo").append(result_title);

        $("#printResultTable").append(result_body+result_footer);

        $("#header_bar").hide();
        $("#save-update-print").hide();

        var hiv_save_id=[];
        for(var i=1;i<6;i++){
          hiv_save_id[i]='hiv_save'+i;

        }

        for(var i=0;i<=hiv_save_id.length;i++)
        {
          var hiv_data = hiv_save_id[i];
          if(!$('#'+hiv_data).text() || $('#'+hiv_data).text()=="-")
          $('#'+hiv_data).css('background-color','grey')
        }


        var ckUpdater = response[0][0]['name'];
        if(ckUpdater == 'updated')
        {
          alert("We have updated the data");
        }
        else{
        //  alert("We have collected test information of the patient.");
        }


        $("#app").hide();
        $("#hider0").hide();
        $("#hider1").hide();
        $('#save-update-print').hide();
        //  $( "#toshowResult" ).removeClass( "print-dispaly" );
        $( "#toshowResult" ).show();
        window.print();
        $("#app").show();
        $("#hider0").show();
        $("#hider1").show();
        $("#hidden-title").show();
        $("#toshowResult").hide();
        $("#save-update-print").show();
        $("#header_bar").show();

        }
      });
      } else {
       console.log("cancel");

      }
    }else{
      // Validation to the ID
      setTimeout(function(){
        $("#noti").show();
        document.getElementById('noti').innerHTML="Please check the 'ID' or 'Results'.";
        document.getElementById('noti').style="background-color:red;";
      },500);
      setTimeout(function(){
        document.getElementById('noti').innerHTML="";
        $("#noti").hide();

      },5000);

    }


}
function hivUpdate(){

  var updated_by = document.getElementById("navbarDropdown").innerHTML;


  update_rowNo_hiv= resp[0][0]['id'];
  var cid = $("#cid").val();
  var agey = $("#agey").text();
  var agem = $("#agem").text();
  var gender = $("#gender").text();
  var fuchiaID = $("#fuchiaID").val();
  var clinic = 81;
  var vDate = $("#vDate").val();
  vDate = formatDate(vDate); // date FormatChange YYYY/MM/DD
  var Ptype = $("#Ptype").text();
  var ext_sub = $("#ext").text();
  var reqDoctor = $("#md").val();
  agey = parseInt(agey);//changing to number
  agem = parseInt(agem);
  gender= String(gender);
  var bcdate = $("#bcdate").val();
  bcdate = formatDate(bcdate); // date FormatChange YYYY/MM/DD
  var Incon = document.getElementById("inconslusive").checked;
  if(Incon == true){
    Incon = 1;
  }
  var d_result = $("#d_result").val();
  var uni_result = $("#uni_result").val();
  var stat_result = $("#stat_result").val();
  var final_result = $("#final_result").val();
  var comment = $("#comment").val();
  var lab_tech = $("#lab_tech").val();
  var issue_date = $("#issue_date").val();
  issue_date = formatDate(issue_date); // date FormatChange YYYY/MM/DD

  var reqDoctor = $("#md").val();
  var counsellor = $("#counselor").val();



  //var hivForm = document.getElementById('hivTest');
  if(save_update_hiv == 1){

    var hiv_update =3;// For Updating Section Only
    var appUser = document.getElementById("navbarDropdown").innerHTML;// to collect app user from application nav bar
    ////console.log(appUser);
    var org_info = 'RowID->'+resp[0][0]['id']+',FuchiaCode->'+resp[0][0]["fuchiacode"]+ ',GeneralID->' +resp[0][0]["CID"]+ ',Age(year)->' +resp[0][0]["agey"]+
    ',Age(Mo)->' +resp[0][0]["agem"]+ ',Gender->' +resp[0][0]["Gender"]+ ',Visit Date->' +resp[0][0]["Visit_date"]+ ',Risk->' +resp[0][0]['Patient_Type']+
    ',Sub-Risk->' +resp[0][0]['Patient Type Sub']+ ',MD->' +resp[0][0]['Req_Doct']+ ',BC Date->' +resp[0][0]['bcollectdate']+ ',DeterminResult->' +resp[0][0]['Detmine_Result']+
    ',Unigold Result->' +resp[0][0]['Unigold_Result']+ ',STAT Result->' +resp[0][0]['STAT_PAK_Result']+ ',Final Result->' +resp[0][0]['Final_Result']+',Inconclusive->'+resp[0][0]["Incon"];
    var updated_info = 'FuchiaID->'+fuchiaID +',GeneralID->'+ cid+',Age(year)->'+agey+',Age(mo)->'+agem+',Gender->'+gender+',Visit Date->'+vDate+',Risk->'+Ptype+',Sub-risk'+ext_sub+',MD->'+reqDoctor+',BC date->'+bcdate+',DetermineResult->'+d_result+',UniGoldResult->'+uni_result+',STAT Result->'+stat_result+',Final Result->'+final_result+',Inconclusive->'+Incon;
    var hivdata={
      updated_info:updated_info,
      org_info:org_info,
      appUser:appUser,
      update_rowNo_hiv:update_rowNo_hiv,
      hiv_update:hiv_update,
      cid:cid,
      fuchiaID:fuchiaID,
      agey:agey,
      agem:agem,
      gender:gender,
      vDate:vDate,
      Ptype:Ptype,
      ext_sub:ext_sub,

      clinic:clinic,
      bcdate:bcdate,
      d_result:d_result,
      uni_result:uni_result,
      stat_result:stat_result,
      final_result:final_result,
      Incon:Incon,

      reqDoctor:reqDoctor,
      lab_tech:lab_tech,
      counsellor:counsellor,

      updated_by:updated_by,
    };
  }
    if(cid.length >8 && final_result !="-"){
    if (confirm("Are you sure you want to do save?")) {
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
          }
        });
        $.ajax({
      type:'POST',
      url:"{{route('tests')}}",
      dataType:'json',
      //  processData:false,
      contentType: 'application/json',
      data: JSON.stringify(hivdata),
      success:function(response){
        $("#printLogo").empty();
        $("#printPtInfo").empty();
        $("#printResultTable").empty();
        $("#app").hide();
        $("#hider0").hide();
        $("#hider1").hide();
        $('#save-update-print').hide();
        $( "#toshowResult" ).removeClass( "print-dispaly" );
        if(reqDoctor== null){
          reqDoctor= "__________";
        };
        if (counsellor <1){
          counsellor="____";
        };
        if (lab_tech <1){
          lab_tech="_______";
        };
        if (issue_date <1){
          issue_date ="_______";
        };
        if(fuchiaID.length < 1){
          fuchiaID = "__________"
        }
        if(Number.isNaN(agey))  {
          var ageys= "____";
        }else {
          var ageys=agey;
        };
        if(isNaN(agem)){
          var agems="__";
        }else {
          var agems=agem;
        }


        var logo =
        "<div class='row'>"+
        "<div class='d-flex justify-content-center' >"+

        "<h4  class='print-header clearfix'>"+  "<img src='/logoMAM.jpg'  alt='logo' style='width:70px;height:70px;'>"+
        "<p class='hiv-p'>"+"HIV Test Result (Updated)"+"</p>"+"</h4>"+
        "</div>"+
        "</div>";

        var result_title=
        "<div class='d-flex justify-content-center print-coheader-list'>"+
        "<ul class='clearfix' style='width:84%;padding-left: 5%;'>"+
        "<li class='first-li'>"+"ID:"+"</li>"+"<li>"+cid+","+"</li>"+

        "<li class='first-li'>"+"Fuchia ID:"+"</li>"+"<li>"+fuchiaID+","+"</li>"+
        // "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
        "<li class='first-li'>"+"Date:"+"</li>"+"<li>"+vDate+","+"</li>"+
        // "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
        "<li class='first-li'>"+"Age(Y):"+"</li>"+"<li>"+ageys+","+"</li>"+
        // "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
        "<li class='first-li'>"+"Age(M):"+"</li>"+"<li>"+agems+","+"</li>"+
        // "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
        "<li class='first-li'>"+"Sex:"+"</li>"+"<li>"+gender+","+"</li>"+
        "</ul>"+

        "</div>";

        var result_body = "<div class='d-flex justify-content-center'>"
        +"<table class='table  print-hiv-table'>"+
        "<thead>"+
        "<tr>" +"<td>"+"NO."+"<td>"+"Test Name"+"</td>"+"<td>"+"Result"+"</td>"+"</tr>"+
        "</thead>"+
        "<tbody>"+
        "<tr id='tbrow'>"+"<td>"+"1"+"<td>"+"Determine Result"+"</td>"+"<td>"+"<p class='print-tr'id='hiv_save1' style=''>"+d_result+"</p>"+"</td>"+"</tr>"+
        "<tr id='tbrow'>"+"<td>"+"2"+"<td>"+"Uni-Gold Result"+"</td>"+"<td>"+"<p class='print-tr'id='hiv_save2' style=''>"+uni_result+"</p>"+"</td>"+"</tr>"+
        "<tr id='tbrow'>"+"<td>"+"3"+"<td>"+"Stat-Pak Result"+"</td>"+"<td>"+"<p class='print-tr' id='hiv_save3' style=''>"+stat_result+"</p>"+"</td>"+"</tr>"+
        "<tr id='tbrow'>"+"<td>"+""+"<td style='font-weight:bold'>"+"Final Result"+"</td>"+"<td style='font-weight:bold'>"+"<p class='print-tr' id='hiv_save4' style=''>"+final_result+"</p>"+"</td>"+"</tr>"+
        "<tr id='tbrow'>"+"<td>"+""+"<td>"+"Comment :"+"</td>"+"<td>"+"<p class='print-tr' id='hiv_save5' style=''>"+comment+"</p>"+"</td>"+"</tr>"+
        "</tbody>"+
        "</table>" +
        "</div>";
        var result_footer=
        "<div class='print-hiv-footer'>"
        +"<ul class='clearfix print-hiv-footer'>"+
        "<li class='first-li'>"
        +"Requested Doctor:"+"</li>"+"<li>"+reqDoctor+","+"</li>"
        +
        "<li class='first-li'>"
        +"Counselor:"+"</li>"+"<li>"+counsellor+","+"</li>"
        +
        // "Counselor ::"+counselor+
        "<li>"
        +"Issue by-:"+"</li>"+"<li>"+lab_tech+","+"</li>"

        // "Issue by- "+lab_tech+
        +
        "<li>"
        +"Issue Date :"+"</li>"+"<li>"+issue_date+","+"</li>"
        +
        // "Issue Date :"+issue_date+
        "</div>";

        $("#printLogo").append(logo);

        $("#printPtInfo").append(result_title);

        $("#printResultTable").append(result_body+result_footer);

        $("#header_bar").hide();
        $('#save-update-print').hide();

        var hiv_save_id=[];
        for(var i=1;i<6;i++){
          hiv_save_id[i]='hiv_save'+i;

        }

        for(var i=0;i<=hiv_save_id.length;i++)
        {
          var hiv_data = hiv_save_id[i];
          if(!$('#'+hiv_data).text() || $('#'+hiv_data).text()=="-")
          $('#'+hiv_data).css('background-color','grey')
        }
        $("#app").hide();
        $("#hider0").hide();
        $("#hider1").hide();
        $("#hidden-title").hide();
        $("#header_bar").hide();
        $("#save-update-print").hide();


        $("#toshowResult").show();
        window.print();
        var ckUpdater = response[0][0]['name'];
        if(ckUpdater == 'updated')
        {
          alert("We have updated the data");
        }
        else{
          alert("We have collected test information of the patient.");
        }
        $("#app").show();
        $("#hider0").show();
        $("#hider1").show();
        $("#hidden-title").show();
        $("#header_bar").show();
        $("#save-update-print").show();

        $("#toshowResult").hide();
      }
    });

        }else  {

          }
        }else{
          // Validation to the ID
          setTimeout(function(){
            $("#noti").show();
            document.getElementById('noti').innerHTML="Please check the 'ID' or 'Results'.";
            document.getElementById('noti').style="background-color:red;";
          },500);
          setTimeout(function(){
            document.getElementById('noti').innerHTML="";
            $("#noti").hide();

          },5000);
        }

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
// ****************************************************
function rpr_save(){
  var cid = document.getElementById("cid").value;
  var created_by = document.getElementById("navbarDropdown").innerHTML;
  var agey = $("#agey").text();
  var agem = $("#agem").text
  agey = parseInt(agey);//changing to number
  agem = parseInt(agem);
  if(isNaN(agey)){
    agey=0;
  }
  if(isNaN(agem)){
    agem=0;
  }
  var gender = $("#gender").text();
  gender= String(gender);
  var fuchiaID = document.getElementById("fuchiaID").value;
  // var clinic = document.getElementById("clinic").innerHTML;
  var clinic = 81;
  var vDate = document.getElementById("vDate").value;
  vDate = formatDate(vDate); // date FormatChange YYYY/MM/DD
  var Ptype = $("#Ptype").text();
  var ext_sub = $("#ext").text();
  if(ext_sub.length<33){// the blank response from text count is 32
    ext_sub ="-";
  }
  var reqDoctor = document.getElementById("md").value;



  ///////////////////////////////
  var rdtYes_no = $("#rdtYes_no").val();
  var Sy_rdt_result = $("#Sy_rdt_result").val();
  var rprYes_NO = $("#rprYes-NO").val();
  var qualitative = $("#qualitative").val();
  var titreCur = $("#titreCur").val();
  var titreLast = $("#titreLast").val();
  var lastTireDate = $('#lastTitreDate').val();
  lastTireDate = formatDate(lastTireDate); // date FormatChange YYYY/MM/DD
  var reqDoctor = $("#md").val();
  var rpr_counselor = $("#rpr_counselor").val();
  var lab_tech_rpr = $("#rpr_lab_tech").val();
  var rpr_issue_date = $("#rpr_issue_date").val();
  rpr_issue_date = formatDate(rpr_issue_date); // date FormatChange YYYY/MM/DD
  var comment = $("#rprComment").val();
  var rprTest=1;
  var rprDataset = {
    rprTest:rprTest,
    cid:cid,
    fuchiaID:fuchiaID,
    vDate:vDate,
    Ptype:Ptype,
    ext_sub:ext_sub,
    agey:agey,
    agem:agem,
    gender:gender,
    clinic:clinic,

    rdtYes_no:rdtYes_no,
    Sy_rdt_result:Sy_rdt_result,
    rprYes_NO:rprYes_NO,
    qualitative:qualitative,
    titreCur:titreCur,
    titreLast:titreLast,
    lastTireDate:lastTireDate,

    rpr_issue_date:rpr_issue_date,
    rpr_counselor:rpr_counselor,
    reqDoctor:reqDoctor,
    lab_tech_rpr:lab_tech_rpr,

    created_by:created_by,

  };
  // to prevent no data entry from clients
  var result_present = 0;
  if(Sy_rdt_result.length > 5 ){
    var result_present = 1;
  }
  if(qualitative.length > 5 ){
    var result_present = 1;
  }

  if(cid.length >8 && result_present==1 && present == 1){
    if (confirm("Are you sure you want to do save?")) {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        }
      });

    $.ajax({
      type:'POST',
      url:"{{route('tests')}}",
      dataType:'json',
      //processData:false,
      contentType: 'application/json',
      data: JSON.stringify(rprDataset),
      //data: rprDataset,
      success:function(response){

        if(reqDoctor.length < 1){
          reqDoctor= "__________";
        };

        if (rpr_counselor <1){
          rpr_counselor="____";
        };

        if (lab_tech <1){
          lab_tech="_______";
        };

        if (rpr_issue_date  <1){
          rpr_issue_date ="_______";
        };

        if(fuchiaID.length < 1){
          fuchiaID = "__________"
        };

        if(Number.isNaN(agey))  {
          var ageys= "____";
        }else {
          var ageys=agey;
        };

        if(agem.length < 1){
          var agems="__";
        }else {
          var agems=agem;
        };
        var result_title=
        "<div class='d-flex justify-content-center print-coheader-list'>"+
        "<ul class='clearfix' style='width:84%;padding-left: 5%;'>"+
        "<li class='first-li'>"+"ID:"+"</li>"+"<li>"+cid+","+"</li>"+
        "<li class='first-li'>"+"Fuchia ID:"+"</li>"+"<li>"+fuchiaID+","+"</li>"+
        // "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
        "<li class='first-li'>"+"Date:"+"</li>"+"<li>"+vDate+","+"</li>"+
        // "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
        "<li class='first-li'>"+"Age(Y):"+"</li>"+"<li>"+ageys+","+"</li>"+
        // "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
        "<li class='first-li'>"+"Age(M):"+"</li>"+"<li>"+agems+","+"</li>"+
        // "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
        "<li class='first-li'>"+"Sex:"+"</li>"+"<li>"+gender+","+"</li>"+
        "</ul>"+

        "</div>";

        var logo =
        "<div class='row'>"+
        "<div class='d-flex justify-content-center' >"+

        "<h4  class='print-header clearfix'>"+  "<img src='/logoMAM.jpg'  alt='logo' style='width:70px;height:70px;'>"+
        "<p class='hiv-p'>"+"RPR Test Result"+"</p>"+"</h4>"+
        "</div>"+
        "</div>";
        var result_footer=
        "<div class='print-hiv-footer'>"
        +"<ul class='clearfix'>"+
        "<li class='first-li'>"
        +"Requested Doctor:"+"</li>"+"<li>"+reqDoctor+","+"</li>"
        +
        "<li class='first-li'>"
        +"Counselor:"+"</li>"+"<li>"+rpr_counselor+","+"</li>"
        +
        // "Counselor ::"+counselor+
        "<li>"
        +"Issue by-:"+"</li>"+"<li>"+lab_tech_rpr+","+"</li>"

        // "Issue by- "+lab_tech+
        +
        "<li>"
        +"Issue Date :"+"</li>"+"<li>"+rpr_issue_date+","+"</li>"
        +
        // "Issue Date :"+issue_date+
        "</div>";
        if(Sy_rdt_result.length < 1){
          Sy_rdt_result = "Not Done";
        }
        if(qualitative.length < 1){
          qualitative = "Not Done";
        }
        var result_body = "<br>"+"<div class='d-flex justify-content-center'>"+"<table class='table print-hiv-table'>"+
        "<thead>"+
        "<tr>" +"<td>"+"NO."+"</td>"+"<td>"+"Test Name"+"</td>"+"<td>"+"Result"+"</td>"+"</tr>"+
        "</thead>"
        +
        "<tbody>"+
        "<tr>"+"<td>"+"1"+"</td>"+"<td>"+"Syphillis RDT Result"+"</td>"+"<td>"+"<p class='print-tr'id='rpr_save1' style=''>"+Sy_rdt_result+"</p>"+"</td>"+"</tr>"+
        "<tr>"+"<td>"+"2"+"</td>"+"<td>"+"RPR Result"+"</td>"+"<td>"+"<p class='print-tr'id='rpr_save2' style=''>"+qualitative+"</p>"+"</td>"+"</tr>"+
        "<tr>"+"<td>"+"3"+"</td>"+"<td>"+"Titre(Current)"+"</td>"+"<td>"+"<p class='print-tr'id='rpr_save3' style=''>"+titreCur+"</p>"+"</td>"+"</tr>"+
        "<tr>"+"<td>"+""+"</td>"+"<td>"+"Titre(Last)"+"</td>"+"<td>"+"<p class='print-tr'id='rpr_save4' style=''>"+titreLast+"</p>"+"</td>"+"</tr>"+
        //"<tr>"+"<td>"+"Comment"+"</td>"+"<td>"+comment+"</td>"+"<td>"+""+"</td>"+"</tr>"+
        "</tbody>"+
        "</table>" +"</div>";
        $("#printLogo").empty();
        $("#printPtInfo").empty();
        $("#printResultTable").empty();

        $("#printLogo").append(logo);
        $("#printPtInfo").append(result_title);
        $("#printResultTable").append(result_body+result_footer);

        $("#header_bar").hide();
        $("#save-update-print").hide();
        var rpr_save_id=[];
        for(var i=1;i<6;i++){
          rpr_save_id[i]='rpr_save'+i;

        }
        for(var i=0;i<=rpr_save_id.length;i++)
        {
          var rpr_data = rpr_save_id[i];
          if(!$('#'+rpr_data).text() || $('#'+rpr_data).text()=="-")
          $('#'+rpr_data).css('background-color','grey')
          ////console.log(!$('#'+rpr_data).text());
        }

        $("#app").hide();
        $("#hider0").hide();
        $("#hider1").hide();
        $('#save-update-print').hide();
        //  $( "#toshowResult" ).removeClass( "print-dispaly" );
        $( "#toshowResult" ).show();
        window.print();
        var ckUpdater = response[0][0]['name'];
        if(ckUpdater == 'updated')
        {
          alert("We have updated the data");
        }
        else{
          alert("We have collected test information of the patient.");
        }
        $("#app").show();
        $("#hider0").show();
        $("#hider1").show();
        $("#hidden-title").show();
        $("#toshowResult").hide();
        $("#save-update-print").show();
        $("#header_bar").show();
        //   location.reload(true);// to refresh the page

      }
    });

        }else{
          console.log("Cancel");
        }
    }else{
      // Validation to the ID

      setTimeout(function(){
        $("#noti_rpr").show();
        document.getElementById('noti_rpr').innerHTML="Please check the 'ID' or 'Results'.";
        document.getElementById('noti_rpr').style="background-color:red;";
      },500);
      setTimeout(function(){
        document.getElementById('noti_rpr').innerHTML="";
        $("#noti_rpr").hide();

      },5000);
    }
}
function rprUpdate(){
  var updated_by = document.getElementById("navbarDropdown").innerHTML;

  var cid = $("#cid").val();
  var agey = $("#agey").text();
  var agem = $("#agem").text();
  var gender = $("#gender").text();
  var fuchiaID = $("#fuchiaID").val();
  var clinic = 81;
  var vDate = $("#vDate").val();
  vDate = formatDate(vDate); // date FormatChange YYYY/MM/DD
  var Ptype = $("#Ptype").text();
  var ext_sub = $("#ext").text();
  var reqDoctor = $("#md").val();
  agey = parseInt(agey);//changing to number
  //agem = parseInt(agem);
  gender= String(gender);
  var rdtYes_no = $("#rdtYes_no").val();
  var Sy_rdt_result = $("#Sy_rdt_result").val();
  var rprYes_NO = $("#rprYes-NO").val();
  var qualitative = $("#qualitative").val();
  var titreCur = $("#titreCur").val();
  var lastTireDate = $('#lastTitreDate').val();
  lastTireDate = formatDate(lastTireDate); // date FormatChange YYYY/MM/DD
  var titreLast = $("#titreLast").val();

  var lab_tech_rpr = $("#rpr_lab_tech").val();
  var rpr_issue_date = $("#rpr_issue_date").val();
  rpr_issue_date = formatDate(rpr_issue_date); // date FormatChange YYYY/MM/DD
  var rpr_counselor = $("#rpr_counselor").val();
  var reqDoctor = $("#md").val();
  var rpr_counselor = $("#rpr_counselor").val();
  var comment = $("#rprComment").val();

  if(save_update_rpr==2){
    update_rowNo_rpr= resp[1][0]['id'];
    var rprTest=2;
    var appUser = document.getElementById("navbarDropdown").innerHTML;// to collect app user from application nav bar
    var org_info = 'RowID->'+resp[1][0]['id']
    +',FuchiaID->' +resp[1][0]["fuchiacode"]
    + ',GeneralID->' +resp[1][0]["pid"]
    + ',Age(year)->' +resp[1][0]["agey"]
    + ',Age(mo)->' +resp[1][0]["agem"]
    + ',Gender->' +resp[1][0]["Gender"]
    + ',Visit Date->' +resp[1][0]["visit_date"]
    + ',Risk->' +resp[1][0]['Type Of Patient']
    + ',Sub risk->' +resp[1][0]['Patient Type Sub']
    + ',RPR Qualitative->' +resp[1][0]['RPR Qualitative']
    + ',RDT(Yes/NO)->' +resp[1][0]['RDT(Yes/No)']
    + ',RDT Result->' +resp[1][0]['RDT Result']
    + ',Quantative(Yes/No)->' +resp[1][0]['Quantitative(Yes/No)']
    + ',Qualitative(Yes/No)->' +resp[1][0]['Qualitative(Yes/No)']
    + ',Titre(Cur)->' +resp[1][0]['Titre(current)']
    + ',Titre(Last)->' +resp[1][0]['Titre(Last)'];


    var updated_info =
    'FuchiaID->'+fuchiaID +
    ',GeneralID->'+cid+
    ',Age(year)->'+agey+
    ',Age(mo)->'+agem+
    ',Gender->'+gender+
    ',Visit Date->'+vDate+
    ',Risk->'+Ptype+
    ',Sub Risk->'+ext_sub+
    ',MD ->'+reqDoctor+
    ',RPR_Yes_No->'+rprYes_NO+
    ',RDT Yes_NO->'+rdtYes_no+
    ',Syphillis RDT Result->'+Sy_rdt_result+
    ',Qualitative->'+qualitative+
    ',Titre Current->'+titreCur+
    ',Titre Last->'+titreLast;

    var rprDataset = {
      updated_info:updated_info,
      org_info:org_info,
      appUser:appUser,
      update_rowNo_rpr:update_rowNo_rpr,

      rprTest:rprTest,
      cid:cid,
      fuchiaID:fuchiaID,
      vDate:vDate,
      Ptype:Ptype,
      ext_sub:ext_sub,
      agey:agey,
      agem:agem,
      gender:gender,
      clinic:clinic,

      rdtYes_no:rdtYes_no,
      Sy_rdt_result:Sy_rdt_result,
      rprYes_NO:rprYes_NO,
      qualitative:qualitative,
      titreCur:titreCur,
      titreLast:titreLast,
      lastTireDate:lastTireDate,

      lab_tech_rpr:lab_tech_rpr,
      reqDoctor:reqDoctor,
      rpr_counselor:rpr_counselor,
      rpr_issue_date:rpr_issue_date,
      comment:comment,

      updated_by:updated_by,
    };
  }

  if(cid.length >8 && lab_tech_rpr.length >0){
    if (confirm("Are you sure you want to do save?")) {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        }
      });

      $.ajax({
      type:'POST',
      url:"{{route('tests')}}",
      dataType:'json',
      //processData:false,
      contentType: 'application/json',
      data: JSON.stringify(rprDataset),
      //data: rprDataset,
      success:function(response){
        $("#printLogo").empty();
        $("#printPtInfo").empty();
        $("#printResultTable").empty();
        $("#app").hide();
        $("#hider0").hide();
        $("#hider1").hide();
        $("#save-update-print").hide();
        $( "#toshowResult" ).removeClass( "print-dispaly" );
        if(reqDoctor==null){
          reqDoctor= "__________";
        };

        if (!rpr_counselor){
          rpr_counselor="____";
        };

        if (!lab_tech){
          lab_tech="_______";
        };

        if (!rpr_issue_date){
          rpr_issue_date ="_______";
        };

        if(fuchiaID.length < 1){
          fuchiaID = "__________"
        };

        if(Number.isNaN(agey))  {
          var ageys= "____";
        }else {
          var ageys=agey;
        };

        if(agem.length < 1){
          var agems="__";
        }else {
          var agems=agem;
        };
        if (qualitative == null) {
          qualitative = ' ';
        };
        if (titreCur== null) {
          titreCur= ' ';
        }
        if (titreLast==null) {
          titreLast = '-';
        }
        ////console.log("rpr body");


        var result_title=
        "<div class='d-flex justify-content-center print-coheader-list'>"+
        "<ul class='clearfix' style='width:84%;padding-left: 5%;'>"+
        "<li class='first-li'>"+"ID:"+"</li>"+"<li>"+cid+","+"</li>"+
        "<li class='first-li'>"+"Fuchia ID:"+"</li>"+"<li>"+fuchiaID+","+"</li>"+
        // "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
        "<li class='first-li'>"+"Date:"+"</li>"+"<li>"+vDate+","+"</li>"+
        // "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
        "<li class='first-li'>"+"Age(Y):"+"</li>"+"<li>"+ageys+","+"</li>"+
        // "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
        "<li class='first-li'>"+"Age(M):"+"</li>"+"<li>"+agems+","+"</li>"+
        // "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
        "<li class='first-li'>"+"Sex:"+"</li>"+"<li>"+gender+","+"</li>"+
        "</ul>"+
        "</div>";
        var logo =
        "<div class='row'>"+
        "<div class='d-flex justify-content-center' >"+
        "<h4  class='print-header clearfix'>"+  "<img src='/logoMAM.jpg'  alt='logo' style='width:70px;height:70px;'>"+
        "<p class='hiv-p'>"+"RPR Test Result (Updated)"+"</p>"+"</h4>"+
        "</div>"+
        "</div>";
        var result_footer=
        "<div class='print-hiv-footer'>"
        +"<ul class='clearfix'>"+
        "<li class='first-li'>"
        +"Requested Doctor:"+"</li>"+"<li>"+reqDoctor+","+"</li>"
        +
        "<li class='first-li'>"
        +"Counselor:"+"</li>"+"<li>"+rpr_counselor+","+"</li>"
        +
        // "Counselor ::"+counselor+
        "<li>"
        +"Issue by-:"+"</li>"+"<li>"+lab_tech_rpr+","+"</li>"

        // "Issue by- "+lab_tech+
        +
        "<li>"
        +"Issue Date :"+"</li>"+"<li>"+rpr_issue_date+","+"</li>"
        +
        // "Issue Date :"+issue_date+
        "</div>";
        if(Sy_rdt_result.length < 1){
          Sy_rdt_result = "Not Done";
        }
        if(qualitative.length < 1){
          qualitative = "Not Done";
        }
        // var result_body = "<br>"+"<div class='d-flex justify-content-center'>"+"<table class='table print-hiv-table'>"+
        //     "<thead>"+
        //         "<tr>"+"<td>"+"NO."+ "<td>"+"Test Name"+"</td>"+"<td>"+"Result"+"</td>"+"</tr>"+
        //     "</thead>"
        //     +
        //     "<tbody>"+
        //         "<tr>"+"<td>"+"1"+"</td>"+"<td>"+"Syphillis RDT Result"+"</td>"+"<td>"+Sy_rdt_result+"</td>"+"</tr>"+
        //         "<tr>"+"<td>"+"2"+"</td>"+"<td>"+"RPR Result"+"</td>"+"<td>"+qualitative+"</td>"+"</tr>"+
        //         "<tr>"+"<td>"+"3"+"</td>"+"<td>"+"Titre(Current)"+"</td>"+"<td>"+titreCur+"</td>"+"</tr>"+
        //         "<tr>"+"<td>"+""+"</td>"+"<td>"+"Titre(Last)"+"</td>"+"<td>"+titreLast+"</td>"+"</tr>"+
        //       //"<tr>"+"<td>"+"Comment"+"</td>"+"<td>"+comment+"</td>"+"<td>"+""+"</td>"+"</tr>"+
        //   "</tbody>"+
        // "</table>"+"</div>";
        var result_body = "<br>"+"<div class='d-flex justify-content-center'>"+"<table class='table print-hiv-table'>"+
        "<thead>"+
        "<tr>" +"<td>"+"NO."+"</td>"+"<td>"+"Test Name"+"</td>"+"<td>"+"Result"+"</td>"+"</tr>"+
        "</thead>"
        +
        "<tbody>"+
        "<tr>"+"<td>"+"1"+"</td>"+"<td>"+"Syphillis RDT Result"+"</td>"+"<td>"+"<p class='print-tr'id='rpr_save1' style=''>"+Sy_rdt_result+"</p>"+"</td>"+"</tr>"+
        "<tr>"+"<td>"+"2"+"</td>"+"<td>"+"RPR Result"+"</td>"+"<td>"+"<p class='print-tr'id='rpr_save2' style=''>"+qualitative+"</p>"+"</td>"+"</tr>"+
        "<tr>"+"<td>"+"3"+"</td>"+"<td>"+"Titre(Current)"+"</td>"+"<td>"+"<p class='print-tr'id='rpr_save3' style=''>"+titreCur+"</p>"+"</td>"+"</tr>"+
        "<tr>"+"<td>"+""+"</td>"+"<td>"+"Titre(Last)"+"</td>"+"<td>"+"<p class='print-tr'id='rpr_save4' style=''>"+titreLast+"</p>"+"</td>"+"</tr>"+
        //"<tr>"+"<td>"+"Comment"+"</td>"+"<td>"+comment+"</td>"+"<td>"+""+"</td>"+"</tr>"+
        "</tbody>"+
        "</table>" +"</div>";
        $("#printLogo").append(logo);
        $("#printPtInfo").append(result_title);
        $("#printResultTable").append(result_body+result_footer);
        $("#header_bar").hide();
        // $("#print")
        var rpr_save_id=[];
        for(var i=1;i<5;i++){
          rpr_save_id[i]='rpr_save'+i;

        }
        ////console.log(rpr_save_id[4]);
        for(var i=0;i<=rpr_save_id.length;i++)
        {
          var rpr_data = rpr_save_id[i];
          if(!$('#'+rpr_data).text() || $('#'+rpr_data).text()=="-"){
            $('#'+rpr_data).css('background-color','grey');
            ////console.log(!$('#'+rpr_data).text());
            ////console.log($('#'+rpr_data).text());
            ////console.log("hello color"+i);

          }


        }

        $("#app").hide();
        $("#hider0").hide();
        $("#hider1").hide();
        $("#hidden-title").hide();
        $("#header_bar").hide();
        $("#save-update-print").hide();


        $("#toshowResult").show();
        window.print();
        var ckUpdater = response[0][0]['name'];
        if(ckUpdater == 'updated')
        {
          alert("We have updated the data");
        }
        else{
          alert("We have collected test information of the patient.");
        }
        $("#app").show();
        $("#hider0").show();
        $("#hider1").show();
        $("#hidden-title").show();
        $("#header_bar").show();
        $("#save-update-print").show();

        $("#toshowResult").hide();

      }
    });
      }else{
        console.log("Cancel");
      }
    }else{
      $("#noti").show();
      document.getElementById('noti').innerHTML="Please input data first";
    }
}


//*****************************************************
function sti_save(){

  var cid = document.getElementById("cid").value;
  var created_by = document.getElementById("navbarDropdown").innerHTML;
  var agey = $("#agey").text();
  var agem = $("#agem").text
  agey = parseInt(agey);//changing to number
  agem = parseInt(agem);

  var gender = $("#gender").text();
  gender= String(gender);
  var fuchiaID = document.getElementById("fuchiaID").value;
  // var clinic = document.getElementById("clinic").innerHTML;
  var clinic = 81;
  var vDate = document.getElementById("vDate").value;
  vDate = formatDate(vDate); // date FormatChange YYYY/MM/DD
  var Ptype = $("#Ptype").text();
  var ext_sub = $("#ext").text();
  if(ext_sub.length<33){// the blank response from text count is 32
    ext_sub ="-";
  }
  var reqDoctor = document.getElementById("md").value;

  ///////////////////////
  var bcdate = $("#bcdate").val();
  bcdate = formatDate(bcdate); // date FormatChange YYYY/MM/DD

  var  clue_cells= $("#clue_cells").val();
  var  clue_post_fornix= $("#clue_post_fornix").val();
  // next line
  var  pmnl_urethra= $("#pmnl_urethra").val();
  var  pmnl_post_fix= $("#pmnl_post_fix").val();
  var  pmnl_endocevix= $("#pmnl_endocevix").val();
  var  pmnl_rectum= $("#pmnl_rectum").val();
  // next line
  var  tricho_wet= $("#tricho_wet").val();
  //
  var  gram_intra_urethra= $("#gram_intra_urethra").val();
  var  gram_intra_postfornix= $("#gram_intra_postfornix").val();
  var  gram_intra_endo= $("#gram_intra_endo").val();
  var  gram_intra_rectum = $("#gram_intra_rectum").val();
  //
  var  gram_extra_urethra= $("#gram_extra_urethra").val();
  var  gram_extra_postfornix= $("#gram_extra_postfornix").val();
  var  gram_extra_endo= $("#gram_extra_endo").val();
  var  gram_extra_rectum= $("#gram_extra_rectum").val();
  //
  var  candida_wet= $("#candida_wet").val();
  var  candida_urethra= $("#candida_urethra").val();
  var  candida_postfornix= $("#candida_postfornix").val();
  var  candida_endo= $("#candida_endo").val();
  //
  var  Sper_other_wet= $("#Sper_other_wet").val();
  var  Sper_other_urethra= $("#Sper_other_urethra").val();
  var  Sper_other_post= $("#Sper_other_post").val();
  var  Sper_other_endo= $("#Sper_other_endo").val();
  var  Sper_other_rectum= $("#Sper_other_rectum").val();
  //
  var  urine_exam_done= $("#urine_exam_done").val();
  var  epithelial_cell= $("#epithelial_cell").val();
  //
  var  intra_cell= $("#intra_cell").val();
  var  pmnl_cell= $("#pmnl_cell").val();
  //
  var  extra_cell= $("#extra_cell").val();
  //
  var  oth_bact= $("#other_baceria").val();
  //
  var  sti_lab_tech= $("#sti_lab_tech").val();
  var  sti_issuDate= $("#sti_issueDate").val();
  sti_issuDate = formatDate(sti_issuDate); // date FormatChange YYYY/MM/DD


  var stiTest = 1;
  var stiDataset = {
    stiTest : stiTest,
    cid:cid,
    fuchiaID:fuchiaID,
    agey:agey,
    agem:agem,
    gender:gender,
    vDate:vDate,
    Ptype:Ptype,
    ext_sub:ext_sub,
    reqDoctor:reqDoctor,
    clinic:clinic,
    bcdate:bcdate,

    clue_cells:clue_cells,
    clue_post_fornix:clue_post_fornix,
    //  clue_cell_result:clue_cell_result,
    pmnl_urethra:pmnl_urethra,
    pmnl_post_fix:pmnl_post_fix,
    pmnl_endocevix:pmnl_endocevix,
    pmnl_rectum:pmnl_rectum,
    //  pmnl_cell_result:pmnl_cell_result,
    tricho_wet:tricho_wet,
    //  tricho_result:tricho_result,
    gram_intra_urethra:gram_intra_urethra,
    gram_intra_postfornix:gram_intra_postfornix,
    gram_intra_endo:gram_intra_endo,
    gram_intra_rectum :gram_intra_rectum,
    //  gram_intra_result:gram_intra_result,
    gram_extra_urethra:gram_extra_urethra,
    gram_extra_postfornix:gram_extra_postfornix,
    gram_extra_endo:gram_extra_endo,
    gram_extra_rectum:gram_extra_rectum,
    //  gram_extra_result:gram_extra_result,
    candida_wet:candida_wet,
    candida_urethra:candida_urethra,
    candida_postfornix:candida_postfornix,
    candida_endo:candida_endo,
    //  candida_result:candida_result,
    Sper_other_wet:Sper_other_wet,
    Sper_other_urethra:Sper_other_urethra,
    Sper_other_post:Sper_other_post,
    Sper_other_endo:Sper_other_endo,
    Sper_other_rectum:Sper_other_rectum,
    urine_exam_done:urine_exam_done,
    epithelial_cell:epithelial_cell,
    intra_cell:intra_cell,
    pmnl_cell:pmnl_cell,
    extra_cell:extra_cell,
    sti_lab_tech:sti_lab_tech,
    sti_issuDate:sti_issuDate,
    oth_bact:oth_bact,

    created_by:created_by,
  };

  if(cid.length >8 && gender.length>2 && sti_lab_tech.length>2 && present == 1 ){
    if (confirm("Are you sure you want to do save?")) {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        }
      });
    $.ajax({
      type:'POST',
      url:"{{route('tests')}}",
      dataType:'json',
      //processData:false,
      contentType: 'application/json',
      data: JSON.stringify(stiDataset),
      //data: rprDataset,
      success:function(response){
        $("#printLogo").empty();
        $("#printPtInfo").empty();
        $("#printResultTable").empty();
        // $("#app").hide();
        // $("#hider0").hide();
        // $("#hider1").hide();
        // $("#save-update-print").hide();
        // $( "#toshowResult" ).removeClass( "print-dispaly" );
        if(isNaN(agey)){
          agey=0;
        }
        if(isNaN(agem)){
          agem=0;
        }

        if(reqDoctor.length<1){
          reqDoctor= "__________";
        };


        if (sti_lab_tech.length <1){
          lab_tech="_______";
        };

        if (sti_issuDate.length  <1){
          rpr_issue_date ="_______";
        };

        if(fuchiaID.length < 1){
          fuchiaID = "__________"
        };

        if(Number.isNaN(agey))  {
          var ageys= "____";
        }else {
          var ageys=agey;
        };

        if(Number.isNaN(agem)){
          var agems="__";
        }else {
          var agems=agem;
        };

        var logo =
        "<div class='row'>"+
        "<div class='d-flex justify-content-center' >"+

        "<h4  class='print-header clearfix'>"+  "<img src='/logoMAM.jpg'  alt='logo' style='width:70px;height:70px;'>"+
        "<p class='hiv-p'>"+"STI Test"+"</p>"+"</h4>"+
        "</div>"+
        "</div>";
        var result_title=
        "<div class='d-flex justify-content-center print-coheader-list'>"+
        "<ul class='clearfix' style='width:84%;padding-left: 5%;'>"+
        "<li class='first-li'>"+"ID:"+"</li>"+"<li>"+cid+","+"</li>"+

        "<li class='first-li'>"+"Fuchia ID:"+"</li>"+"<li>"+fuchiaID+","+"</li>"+
        // "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
        "<li class='first-li'>"+"Date:"+"</li>"+"<li>"+vDate+","+"</li>"+
        // "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
        "<li class='first-li'>"+"Age(Y):"+"</li>"+"<li>"+ageys+","+"</li>"+
        // "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
        "<li class='first-li'>"+"Age(M):"+"</li>"+"<li>"+agems+","+"</li>"+
        // "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
        "<li class='first-li'>"+"Sex:"+"</li>"+"<li>"+gender+","+"</li>"+
        "</ul>"+

        "</div>";

        var result_footer=
        "<div class='print-hiv-footer'>"
        +"<ul class='clearfix print-sti-footer'>"+
        "<li class='first-li'>"
        +"Requested Doctor:"+"</li>"+"<li>"+reqDoctor+","+"</li>"
        +
        "<li>"
        +"Issue by-:"+"</li>"+"<li>"+sti_lab_tech+","+"</li>"
        +
        "<li>"
        +"Issue Date :"+"</li>"+"<li>"+sti_issuDate+","+"</li>"
        +
        "</div>";
        var result_body ="<div class='d-flex justify-content-center print-sti-first'>"+"<table class='table print-sti-table'>"+
        "<thead>"+
        "<tr>"
        +"<td>"+"NO."+"</td>"
        +"<td>"+"Test Name"+"</td>"
        +"<td>"+"Wet Mount"+"</td>"
        +"<td>"+"(Gram Stain) Urethra"+"</td>"
        +"<td>"+"(Gram Stain) Post,fornix"+"</td>"
        +"<td>"+"(Gram Stain) Endo cervix"+"</td>"
        +"<td>"+"(Gram Stain) Rectum"+"</td>"
        +"</tr>"+
        "</thead>"
        +
        "<tbody>"
        +"<tr>"
        +"<td>"+"1"+"</td>"
        +"<td>"+"Clue Cells %"+"</td>"
        +"<td>"+"<p class='print-tr' id='sti_save1' style=''>"+clue_cells+"</p>"+"</td>"
        +"<td>"+"<p class='print-tr'id='no_entry1' style=''>"+"-"+"</p>"+"</td>"
        +"<td id='grey-box-0' class=''>"+"<p class='print-tr'id='sti_save2' style=''>"+clue_post_fornix+"</p>"+"</td>"
        +"<td id='grey-box-1' class=''>"+"<p class='print-tr'id='no_entry15' style=''>"+"-"+"</p>"+"</td>"
        +"<td>"+"<p class='print-tr'id='no_entry2'  style=''>"+"-"+"</p>"+"</td>"
        +"</tr>"
        +"<tr>"
        +"<td>"+"2"+"</td>"
        +"<td>"+"PMNL cells/HPF"+"</td>"
        +"<td>"+"<p class='print-tr'id='no_entry3'  style=''>"+"-"+"</p>"+"</td>"
        +"<td>"+"<p class='print-tr' id='sti_save3' style=''>"+pmnl_urethra+"</p>"+"</td>"
        +"<td id='grey-box-2'>"+"<p class='print-tr' id='sti_save4' style=''>"+pmnl_post_fix+"</p>"+"</td>"
        +"<td id='grey-box-3'>"+"<p class='print-tr' id='sti_save5' style=''>"+pmnl_endocevix+"</p>"+"</td>"
        +"<td>"+"<p class='print-tr'id='sti_save6' style=''>"+pmnl_rectum+"</p>"+"</td>"
        +"</tr>"
        +"<tr>"
        +"<td>"+"3"+"</td>"
        +"<td>"+"Trichomonas"+"</td>"
        +"<td>"+"<p class='print-tr'id='sti_save7' style=''>"+tricho_wet+"</p>"+"</td>"
        +"<td>"+"<p class='print-tr'id='no_entry4'  style=''>"+"-"+"</p>"+"</td>"
        +"<td id='grey-box-4' class=''>"+"<p class='print-tr'id='no_entry5'  style=''>"+"-"+"</p>"+"</td>"
        +"<td id='grey-box-5' class=''>"+"<p class='print-tr'id='no_entry6'  style=''>"+"-"+"</p>"+"</td>"
        +"<td>"+"<p class='print-tr'id='no_entry7'  style=''>"+"-"+"</p>"+"</td>"
        +"</tr>"
        +"<tr>"
        +"<td>"+"4"+"</td>"
        +"<td>"+"Gram(-) diplococci intra-cell"+"</td>"
        +"<td>"+"<p class='print-tr'id='no_entry8'  style=''>"+"-"+"</p>"+"</td>"
        +"<td>"+"<p class='print-tr' id='sti_save8' style=''>"+gram_intra_urethra+"</p>"+"</td>"
        +"<td id='grey-box-6'>"+"<p class='print-tr'id='sti_save9' style=''>"+gram_intra_postfornix+"</p>"+"</td>"
        +"<td id='grey-box-7'>"+"<p class='print-tr'id='sti_save10' style=''>"+gram_intra_endo+"</p>"+"</td>"
        +"<td>"+"<p class='print-tr' id='sti_save11' style=''>"+gram_intra_rectum+"</p>"+"</td>"
        +"</tr>"
        +"<tr>"
        +"<td>"+"5"+"</td>"
        +"<td>"+"Gram(-) diplococci extra-cell"+"</td>"
        +"<td>"+"<p class='print-tr'id='no_entry9'  style=''>"+"-"+"</p>"+"</td>"
        +"<td>"+"<p class='print-tr'id='sti_save12' style=''>"+gram_extra_urethra+"</p>"+"</td>"
        +"<td id='grey-box-8'>"+"<p class='print-tr'id='sti_save13' style=''>"+gram_extra_postfornix+"</p>"+"</td>"
        +"<td id='grey-box-9'>"+"<p class='print-tr'id='sti_save14' style=''>"+gram_extra_endo+"</p>"+"</td>"
        +"<td>"+"<p class='print-tr'id='sti_save15' style=''>"+gram_extra_rectum+"</p>"+"</td>"
        +"</tr>"
        +"<tr>"
        +"<td>"+"6"+"</td>"
        +"<td>"+"Candida"+"</td>"
        +"<td>"+"<p class='print-tr' id='sti_save16' style=''>"+candida_wet+"</p>"+"</td>"
        +"<td>"+"<p class='print-tr' id='sti_save17' style=''>"+candida_urethra+"</p>"+"</td>"
        +"<td id='grey-box-10'>"+"<p class='print-tr' id='sti_save18' style=''>"+candida_postfornix+"</p>"+"</td>"
        +"<td id='grey-box-11'>"+"<p class='print-tr' id='sti_save19' style=''>"+candida_endo+"</p>"+"</td>"
        +"<td>"+"<p class='print-tr'id='no_entry10'  style=''>"+"-"+"</p>"+"</td>"
        +"</tr>"
        +"<tr>"
        +"<td>"+"7"+"</td>"
        +"<td>"+"Supermatozoites,RBCs,others:"+"</td>"
        +"<td>"+"<p class='print-tr' id='sti_save20' style=''>"+Sper_other_wet+"</p>"+"</td>"
        +"<td>"+"<p class='print-tr' id='sti_save21' style=''>"+Sper_other_urethra+"</p>"+"</td>"
        +"<td id='grey-box-12'>"+"<p class='print-tr' id='sti_save22' style=''>"+Sper_other_post+"</p>"+"</td>"
        +"<td id='grey-box-13'>"+"<p class='print-tr' id='sti_save23' style=''>"+Sper_other_endo+"</p>"+"</td>"
        +"<td>"+"<p class='print-tr'id='sti_save24' style=''>"+Sper_other_rectum+"</p>"+"</td>"
        +"</tr>"+
        "</tbody>"+
        "</table>"+
        "</div>"+
        "<div class='print-sti-urine'>"+
        "<table  class='table print-sti-table'>"+
        "<tbody>"+
        "<thead>"+
        "<tr>"
        +"<td>"+"NO."+"</td>"
        +"<td>"+"Urine exam (FPU)"+"</td>"
        +"<td>"+"</td>"
        +"</tr>"+
        "</thead>"

        +"<tr>"
        +"<td>"+"1."+"</td>"
        +"<td>"+"Gram(-) diplocci intra-cell"+"</td>"
        +"<td>"+"<p class='print-tr'id='sti_save26' style=''>"+intra_cell+"</p>"+"</td>"
        +"<td>"+"<p class='print-tr' style=''>"+""+"</p>"+"</td>"
        +"<td class='print-tr'>"+"4."+"</td>"
        +"<td class='print-tr'>"+"Epithelial cells"+"</td>"
        +"<td>"+"<p class='print-tr' id='sti_save27' style=''>"+epithelial_cell+"</p>"+"</td>"
        // +"<td>"+""+"</td>"
        +"</tr>"
        +"<tr>"
        +"<td>"+"2"+"</td>"
        +"<td>"+"Gram(-) diplocci extra-cell"+"</td>"
        +"<td>"+"<p class='print-tr' id='sti_save28' style=''>"+extra_cell+"</p>"+"</td>"
        +"<td>"+"<p class='print-tr' style=''>"+""+"</p>"+"</td>"
        +"<td class='print-tr'>"+"5."+"</td>"
        +"<td class='print-tr'>"+"PMNL cells"+"</td>"
        +"<td>"+"<p class='print-tr' id='sti_save29' style=''>"+pmnl_cell+"</p>"+"</td>"
        // +"<td>"+""+"</td>"
        +"</tr>"
        +"<tr>"
        +"<td>"+"3"+"</td>"
        +"<td>"+"Other bacteria(Gram Stain)"+"</td>"
        +"<td>"+"<p class='print-tr'id='sti_save30' style=''>"+oth_bact+"</p>"+"</td>"

        +"</tr>"+

        //  "<tr>"+"<td>"+"PMNL cells"+"</td>"+"<td>"+comment+"</td>"+"<td>"+""+"</td>"+"</tr>"+
        "</tbody>"+
        "</table>"+"</div>" ;




        $("#printLogo").append(logo);
        $("#printPtInfo").append(result_title);
        $("#printResultTable").append(result_body + result_footer);
        $("#header_bar").hide();

        //document.getElementById('grey-box-0').style="background-color:grey";
        $("#grey-box-0").addClass("grey-boxes");
        $("#grey-box-1").addClass("grey-boxes");
        $("#grey-box-2").addClass("grey-boxes");
        $("#grey-box-3").addClass("grey-boxes");
        $("#grey-box-4").addClass("grey-boxes");
        $("#grey-box-5").addClass("grey-boxes");
        $("#grey-box-6").addClass("grey-boxes");
        $("#grey-box-7").addClass("grey-boxes");
        $("#grey-box-8").addClass("grey-boxes");
        $("#grey-box-9").addClass("grey-boxes");
        $("#grey-box-10").addClass("grey-boxes");
        $("#grey-box-11").addClass("grey-boxes");
        $("#grey-box-12").addClass("grey-boxes");
        $("#grey-box-13").addClass("grey-boxes");

        var sti_save_id=[];
        for(var i=1;i<31;i++){
          sti_save_id[i]='sti_save'+i;

        }
        var no_entry_id=[];
        for(var i=1;i<16;i++){
          no_entry_id[i]='no_entry'+i;

        }

        for(var i=0;i<=sti_save_id.length;i++)
        {
          var sti_data = sti_save_id[i];
          if(!$('#'+sti_data).text() || $('#'+sti_data).text()=="-")
          $('#'+sti_data).css('background-color','grey')
        }
        for(var i=0;i<=no_entry_id.length;i++)
        {
          var no_entry_data = no_entry_id[i];
          if(!$('#'+no_entry_data).text() || $('#'+no_entry_data).text()=="-")
          $('#'+no_entry_data).css('background-color','black')

        }


        $("#app").hide();
        $("#hider0").hide();
        $("#hider1").hide();
        $('#save-update-print').hide();
        //  $( "#toshowResult" ).removeClass( "print-dispaly" );
        $( "#toshowResult" ).show();
        window.print();
        var ckUpdater = response[0][0]['name'];
        if(ckUpdater == 'updated')
        {
          alert("We have updated the data");
        }
        else{
          alert("We have collected test information of the patient.");
        }
        $("#app").show();
        $("#hider0").show();
        $("#hider1").show();
        $("#hidden-title").show();
        $("#toshowResult").hide();
        $("#save-update-print").show();
        $("#header_bar").show();
        //location.reload(true);// to refresh the page
      }
    });
    }else{
      console.log("Cancel");
    }

      }else{
        // Validation to the ID

        setTimeout(function(){
          $("#noti_rpr").show();
          document.getElementById('noti_sti').innerHTML="Please check the 'ID' or 'Lab Technician' or 'Gender'.";
          document.getElementById('noti_sti').style="background-color:red;";
        },500);
        setTimeout(function(){
          document.getElementById('noti_sti').innerHTML="";
          $("#noti_sti").hide();

        },5000);
      }
}
function stiUpdate(){

  var updated_by = document.getElementById("navbarDropdown").innerHTML;

  var cid = $("#cid").val();
  var agey = $("#agey").text();
  var agem = $("#agem").text();
  var gender = $("#gender").text();
  var fuchiaID = $("#fuchiaID").val();
  var clinic = 81;
  var vDate = $("#vDate").val();
  vDate = formatDate(vDate); // date FormatChange YYYY/MM/DD
  var Ptype = $("#Ptype").text();
  var ext_sub = $("#ext").text();
  var reqDoctor = $("#md").val();
  agey = parseInt(agey);//changing to number
  agem = parseInt(agem);
  gender= String(gender);
  var bcdate = $("#bcdate").val();
  bcdate = formatDate(bcdate); // date FormatChange YYYY/MM/DD
  //
  var  clue_cells= $("#clue_cells").val();
  var  clue_post_fornix= $("#clue_post_fornix").val();
  //
  var  pmnl_urethra= $("#pmnl_urethra").val();
  var  pmnl_post_fix= $("#pmnl_post_fix").val();
  var  pmnl_endocevix= $("#pmnl_endocevix").val();
  var  pmnl_rectum= $("#pmnl_rectum").val();
  //
  var  tricho_wet= $("#tricho_wet").val();
  //
  var  gram_intra_urethra= $("#gram_intra_urethra").val();
  var  gram_intra_postfornix= $("#gram_intra_postfornix").val();
  var  gram_intra_endo= $("#gram_intra_endo").val();
  var  gram_intra_rectum = $("#gram_intra_rectum").val();
  //
  var  gram_extra_urethra= $("#gram_extra_urethra").val();
  var  gram_extra_postfornix= $("#gram_extra_postfornix").val();
  var  gram_extra_endo= $("#gram_extra_endo").val();
  var  gram_extra_rectum= $("#gram_extra_rectum").val();
  //
  var  candida_wet= $("#candida_wet").val();
  var  candida_urethra= $("#candida_urethra").val();
  var  candida_postfornix= $("#candida_postfornix").val();
  var  candida_endo= $("#candida_endo").val();
  //
  var  Sper_other_wet= $("#Sper_other_wet").val();
  var  Sper_other_urethra= $("#Sper_other_urethra").val();
  var  Sper_other_post= $("#Sper_other_post").val();
  var  Sper_other_endo= $("#Sper_other_endo").val();
  var  Sper_other_rectum= $("#Sper_other_rectum").val();
  //
  var  urine_exam_done= $("#urine_exam_done").val();
  var  epithelial_cell= $("#epithelial_cell").val();
  //
  var  intra_cell= $("#intra_cell").val();
  var  pmnl_cell= $("#pmnl_cell").val();
  //
  var  extra_cell= $("#extra_cell").val();
  //
  var  oth_bact= $("#other_baceria").val();
  //
  var  sti_lab_tech= $("#sti_lab_tech").val();
  var  sti_issuDate= $("#sti_issueDate").val();
  sti_issuDate = formatDate(sti_issuDate); // date FormatChange YYYY/MM/DD




  //let  clue_cell_result= document.getElementById("clue_cell_result").value;
  //let  pmnl_cell_result= document.getElementById("pmnl_cell_result").value;
  //let  tricho_result= document.getElementById("tricho_result").value;
  //     tricho_result = parseInt(tricho_result);//changing to number
  //let  gram_intra_result= document.getElementById("gram_intra_result").value;
  //     gram_intra_result = parseInt(gram_intra_result);
  //let  gram_extra_result= document.getElementById("gram_extra_result").value;
  //     gram_extra_result = parseInt(gram_extra_result);
  //let  candida_result= document.getElementById("candida_result").value;
  //     candida_result = parseInt(candida_result);
  if(save_update_sti == 3){
    //event.preventDefalult();
    var stiTest = 2;
    update_rowNo_sti= resp[2][0]['id'];
    var appUser = document.getElementById("navbarDropdown").innerHTML;// to collect app user from application nav bar

    var org_info = 'RowID->'+resp[2][0]['id']
    +',FuchiaID->' +resp[2][0]["fuchiacode"]
    + ',GeneralID->' +resp[2][0]["CID"]
    + ',Age(year)->' +resp[2][0]["agey"]
    + ',Age(mo)->' +resp[2][0]["agem"]
    + ',Gender->' +resp[2][0]["Gender"]
    + ',Visit Date->' +resp[2][0]["visit_date"]
    + ',Risk->' +resp[2][0]['Type Of Patient']
    + ',Sub risk->' +resp[2][0]['Patient Type Sub']

    + ',Requested Doctor->' +resp[2][0]['Requested Doctor']
    + ',Requested Doctor New->' +resp[2][0]['Requested Doctor New']
    + ',Wet Mount clue cell->' +resp[2][0]['Wet Mount clue cell']
    + ',->' +resp[2][0]['Wet Mount Trichomonas']
    +',Wet Mount candida' +resp[2][0]['Wet Mount candida']
    +',wetoth'+resp[2][0]['wetoth']
    +',urethra WBC'+resp[2][0]['urethra WBC']
    +',Urethra diplococci intra-cell'+resp[2][0]['Urethra diplococci intra-cell']
    +',Urethra diplococci extra-cell'+resp[2][0]['Urethra diplococci extra-cell']
    +',Urethra Candida'+resp[2][0]['Urethra Candida']
    +',uoth'+resp[2][0]['uoth']
    +',Fornix Clue Cells'+resp[2][0]['Fornix Clue Cells']
    +',PMNL WBC'+resp[2][0]['PMNL WBC']
    +',Fornix diplococci intra-cell'+resp[2][0]['Fornix diplococci intra-cell']
    +',Fornix diplococci extra-cell'+resp[2][0]['Fornix diplococci extra-cell']
    +',Fornix Candida'+resp[2][0]['Fornix Candida']
    +',pfother'+resp[2][0]['pfother']
    +',Endo cervix WBC'+resp[2][0]['Endo cervix WBC']
    +',Endo cervix diplococci intra-cell'+resp[2][0]['Endo cervix diplococci intra-cell']
    +',Endo cervix diplococci extra-cell'+resp[2][0]['Endo cervix diplococci extra-cell']
    +',Endo cervix Candida'+resp[2][0]['Endo cervix Candida']
    +',eother'+resp[2][0]['eother']
    +',Rectum WBC'+resp[2][0]['Rectum WBC']
    +',Rectum diplococci intra-cell'+resp[2][0]['Rectum diplococci intra-cell']
    +',Rectum diplococci extra-cell'+resp[2][0]['Rectum diplococci extra-cell']
    +',rother'+resp[2][0]['rother']
    +',First Per Urine'+resp[2][0]['First Per Urine']
    +',Epithelial cells'+resp[2][0]['Epithelial cells']
    +',PMNL cells'+resp[2][0]['PMNL cells']
    +',First Per Urine Diplococci Intra-Cell'+resp[2][0]['First Per Urine Diplococci Intra-Cell']
    +',First Per Urine Diplococci Extra-Cell'+resp[2][0]['First Per Urine Diplococci Extra-Cell']
    +',fpu_oth'+resp[2][0]['fpu_oth']
    +',Lab Techanician'+resp[2][0]['Lab Techanician']
    +',idate'+resp[2][0]['idate']
    +',visitID'+resp[2][0]['visitID']
    +',Clue cells result'+resp[2][0]['Clue cells result']
    +',PMNL result'+resp[2][0]['PMNL result']
    +',trichomonas result'+resp[2][0]['trichomonas result']
    +',diplococci intra cell result'+resp[2][0]['diplococci intra cell result']
    +',diplococci extra cell result'+resp[2][0]['diplococci extra cell result']
    +',spermatozoites result'+resp[2][0]['spermatozoites result']
    +',candida result'+resp[2][0]['candida result'];



    var updated_info =
    'cid->'+cid+
    'fuchiaID->'+fuchiaID+
    'agey->'+agey+
    'agem->'+agem+
    'gender->'+gender+
    'vDate->'+vDate+
    'Ptype->'+Ptype+
    'ext_sub->'+ext_sub+
    'reqDoctor->'+reqDoctor+
    'clinic->'+clinic+
    'bcdate->'+bcdate+
    'clue_cells->'+clue_cells+
    'clue_post_fornix->'+clue_post_fornix+

    'pmnl_urethra->'+pmnl_urethra+
    'pmnl_post_fix->'+pmnl_post_fix+
    'pmnl_endocevix->'+pmnl_endocevix+
    'pmnl_rectum->'+pmnl_rectum+
    //'pmnl_cell_result->'+pmnl_cell_result+
    'tricho_wet->'+tricho_wet+

    'gram_intra_urethra->'+gram_intra_urethra+
    'gram_intra_postfornix->'+gram_intra_postfornix+
    'gram_intra_endo->'+gram_intra_endo+
    'gram_intra_rectum ->'+gram_intra_rectum+

    'gram_extra_urethra->'+gram_extra_urethra+
    'gram_extra_postfornix->'+gram_extra_postfornix+
    'gram_extra_endo->'+gram_extra_endo+
    'gram_extra_rectum->'+gram_extra_rectum+

    'candida_wet->'+candida_wet+
    'candida_urethra->'+candida_urethra+
    'candida_postfornix->'+candida_postfornix+
    'candida_endo->'+candida_endo+

    'Sper_other_wet->'+Sper_other_wet+
    'Sper_other_urethra->'+Sper_other_urethra+
    'Sper_other_post->'+Sper_other_post+
    'Sper_other_endo->'+Sper_other_endo+
    'Sper_other_rectum->'+Sper_other_rectum+
    'urine_exam_done->'+urine_exam_done+
    'epithelial_cell->'+epithelial_cell+
    'intra_cell->'+intra_cell+
    'pmnl_cell->'+pmnl_cell+
    'extra_cell->'+extra_cell+
    'sti_lab_tech->'+sti_lab_tech+
    'sti_issuDate->'+sti_issuDate+
    'oth_bact->'+oth_bact;
    ////console.log("hello Updated start");

    var stiDataset = {
      updated_info:updated_info,
      org_info:org_info,
      appUser:appUser,
      update_rowNo_sti:update_rowNo_sti,

      stiTest:stiTest,

      cid:cid,
      fuchiaID:fuchiaID,
      agey:agey,
      agem:agem,
      gender:gender,
      vDate:vDate,
      Ptype:Ptype,
      ext_sub:ext_sub,
      reqDoctor:reqDoctor,
      clinic:clinic,
      bcdate:bcdate,

      clue_cells:clue_cells,
      clue_post_fornix:clue_post_fornix,

      pmnl_urethra:pmnl_urethra,
      pmnl_post_fix:pmnl_post_fix,
      pmnl_endocevix:pmnl_endocevix,
      pmnl_rectum:pmnl_rectum,

      tricho_wet:tricho_wet,

      gram_intra_urethra:gram_intra_urethra,
      gram_intra_postfornix:gram_intra_postfornix,
      gram_intra_endo:gram_intra_endo,
      gram_intra_rectum :gram_intra_rectum,

      gram_extra_urethra:gram_extra_urethra,
      gram_extra_postfornix:gram_extra_postfornix,
      gram_extra_endo:gram_extra_endo,
      gram_extra_rectum:gram_extra_rectum,

      candida_wet:candida_wet,
      candida_urethra:candida_urethra,
      candida_postfornix:candida_postfornix,
      candida_endo:candida_endo,

      Sper_other_wet:Sper_other_wet,
      Sper_other_urethra:Sper_other_urethra,
      Sper_other_post:Sper_other_post,
      Sper_other_endo:Sper_other_endo,
      Sper_other_rectum:Sper_other_rectum,
      urine_exam_done:urine_exam_done,
      epithelial_cell:epithelial_cell,
      intra_cell:intra_cell,
      pmnl_cell:pmnl_cell,
      extra_cell:extra_cell,
      sti_lab_tech:sti_lab_tech,
      sti_issuDate:sti_issuDate,
      oth_bact:oth_bact,

      updated_by:updated_by,
    };
  }
  ////console.log("hello Updated start1");
  if(cid.length >8 && gender.length>2 && sti_lab_tech.length>2){
    if (confirm("Are you sure you want to do save?")) {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        }
      });
      $.ajax({
      type:'POST',
      url:"{{route('tests')}}",
      dataType:'json',
      //processData:false,
      contentType: 'application/json',
      data: JSON.stringify(stiDataset),
      //data: rprDataset,
      success:function(response){
        $("#app").hide();
        $("#hider0").hide();
        $("#hider1").hide();
        $("#save-update-print").hide();
        $( "#toshowResult" ).removeClass( "print-dispaly" );
        $("#printLogo").empty();
        $("#printPtInfo").empty();
        $("#printResultTable").empty();
        $( "#toshowResult" ).show();
        
        ////console.log("hello Updated start2");

        if(!reqDoctor){
          reqDoctor= "__________";
        };


        if (!sti_lab_tech){
          lab_tech="_______";
        };

        if (!sti_issuDate){
          rpr_issue_date ="_______";
        };

        if(!fuchiaID){
          fuchiaID = "__________"
        };

        if(Number.isNaN(agey))  {
          var ageys= "____";
        }else {
          var ageys=agey;
        };

        if(Number.isNaN(agem)){
          var agems="__";
        }else {
          var agems=agem;
        };
        if(!oth_bact){
          oth_bact="-";
        }

        ////console.log("hello Updated");

        var logo =
        "<div class='row'>"+
        "<div class='d-flex justify-content-center' >"+

        "<h4  class='print-header clearfix'>"+  "<img src='/logoMAM.jpg'  alt='logo' style='width:70px;height:70px;'>"+
        "<p class='hiv-p'>"+"STI Test"+"</p>"+"</h4>"+
        "</div>"+
        "</div>";
        var result_title=
        "<div class='d-flex justify-content-center print-coheader-list'>"+
        "<ul class='clearfix' style='width:84%;padding-left: 5%;'>"+
        "<li class='first-li'>"+"ID:"+"</li>"+"<li>"+cid+","+"</li>"+

        "<li class='first-li'>"+"Fuchia ID:"+"</li>"+"<li>"+fuchiaID+","+"</li>"+
        // "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
        "<li class='first-li'>"+"Date:"+"</li>"+"<li>"+vDate+","+"</li>"+
        // "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
        "<li class='first-li'>"+"Age(Y):"+"</li>"+"<li>"+ageys+","+"</li>"+
        // "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
        "<li class='first-li'>"+"Age(M):"+"</li>"+"<li>"+agems+","+"</li>"+
        // "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
        "<li class='first-li'>"+"Sex:"+"</li>"+"<li>"+gender+","+"</li>"+
        "</ul>"+

        "</div>";

        var result_footer=
        "<div class='print-hiv-footer'>"
        +"<ul class='clearfix print-sti-footer'>"+
        "<li class='first-li'>"
        +"Requested Doctor:"+"</li>"+"<li>"+reqDoctor+","+"</li>"
        +
        "<li>"
        +"Issue by-:"+"</li>"+"<li>"+sti_lab_tech+","+"</li>"
        +
        "<li>"
        +"Issue Date :"+"</li>"+"<li>"+sti_issuDate+","+"</li>"
        +
        "</div>";

        var result_body = "<div class='d-flex justify-content-center print-sti-first'>"+"<table class='table print-sti-table'>"+
        "<thead>"+
        "<tr>"
        +"<td>"+"NO."+"</td>"
        +"<td>"+"Test Name"+"</td>"
        +"<td>"+"Wet Mount"+"</td>"
        +"<td>"+"(Gram Stain) Urethra"+"</td>"
        +"<td>"+"(Gram Stain) Post,fornix"+"</td>"
        +"<td>"+"(Gram Stain) Endo cervix"+"</td>"
        +"<td>"+"(Gram Stain) Rectum"+"</td>"
        +"</tr>"+
        "</thead>"
        +
        "<tbody>"
        +"<tr>"
        +"<td>"+"1"+"</td>"
        +"<td>"+"Clue Cells %"+"</td>"
        +"<td>"+"<p class='print-tr' id='sti_save1' style=''>"+clue_cells+"</p>"+"</td>"
        +"<td>"+"<p class='print-tr'id='no_entry1' style=''>"+"-"+"</p>"+"</td>"
        +"<td id='grey-box-0' class=''>"+"<p class='print-tr'id='sti_save2' style=''>"+clue_post_fornix+"</p>"+"</td>"
        +"<td id='grey-box-1' class=''>"+"<p class='print-tr'id='no_entry15' style=''>"+"-"+"</p>"+"</td>"
        +"<td>"+"<p class='print-tr'id='no_entry2'  style=''>"+"-"+"</p>"+"</td>"
        +"</tr>"
        +"<tr>"
        +"<td>"+"2"+"</td>"
        +"<td>"+"PMNL cells/HPF"+"</td>"
        +"<td>"+"<p class='print-tr'id='no_entry3'  style=''>"+"-"+"</p>"+"</td>"
        +"<td>"+"<p class='print-tr' id='sti_save3' style=''>"+pmnl_urethra+"</p>"+"</td>"
        +"<td id='grey-box-2'>"+"<p class='print-tr' id='sti_save4' style=''>"+pmnl_post_fix+"</p>"+"</td>"
        +"<td id='grey-box-3'>"+"<p class='print-tr' id='sti_save5' style=''>"+pmnl_endocevix+"</p>"+"</td>"
        +"<td>"+"<p class='print-tr'id='sti_save6' style=''>"+pmnl_rectum+"</p>"+"</td>"
        +"</tr>"
        +"<tr>"
        +"<td>"+"3"+"</td>"
        +"<td>"+"Trichomonas"+"</td>"
        +"<td>"+"<p class='print-tr'id='sti_save7' style=''>"+tricho_wet+"</p>"+"</td>"
        +"<td>"+"<p class='print-tr'id='no_entry4'  style=''>"+"-"+"</p>"+"</td>"
        +"<td id='grey-box-4' class=''>"+"<p class='print-tr'id='no_entry5'  style=''>"+"-"+"</p>"+"</td>"
        +"<td id='grey-box-5' class=''>"+"<p class='print-tr'id='no_entry6'  style=''>"+"-"+"</p>"+"</td>"
        +"<td>"+"<p class='print-tr'id='no_entry7'  style=''>"+"-"+"</p>"+"</td>"
        +"</tr>"
        +"<tr>"
        +"<td>"+"4"+"</td>"
        +"<td>"+"Gram(-) diplococci intra-cell"+"</td>"
        +"<td>"+"<p class='print-tr'id='no_entry8'  style=''>"+"-"+"</p>"+"</td>"
        +"<td>"+"<p class='print-tr' id='sti_save8' style=''>"+gram_intra_urethra+"</p>"+"</td>"
        +"<td id='grey-box-6'>"+"<p class='print-tr'id='sti_save9' style=''>"+gram_intra_postfornix+"</p>"+"</td>"
        +"<td id='grey-box-7'>"+"<p class='print-tr'id='sti_save10' style=''>"+gram_intra_endo+"</p>"+"</td>"
        +"<td>"+"<p class='print-tr' id='sti_save11' style=''>"+gram_intra_rectum+"</p>"+"</td>"
        +"</tr>"
        +"<tr>"
        +"<td>"+"5"+"</td>"
        +"<td>"+"Gram(-) diplococci extra-cell"+"</td>"
        +"<td>"+"<p class='print-tr'id='no_entry9'  style=''>"+"-"+"</p>"+"</td>"
        +"<td>"+"<p class='print-tr'id='sti_save12' style=''>"+gram_extra_urethra+"</p>"+"</td>"
        +"<td id='grey-box-8'>"+"<p class='print-tr'id='sti_save13' style=''>"+gram_extra_postfornix+"</p>"+"</td>"
        +"<td id='grey-box-9'>"+"<p class='print-tr'id='sti_save14' style=''>"+gram_extra_endo+"</p>"+"</td>"
        +"<td>"+"<p class='print-tr'id='sti_save15' style=''>"+gram_extra_rectum+"</p>"+"</td>"
        +"</tr>"
        +"<tr>"
        +"<td>"+"6"+"</td>"
        +"<td>"+"Candida"+"</td>"
        +"<td>"+"<p class='print-tr' id='sti_save16' style=''>"+candida_wet+"</p>"+"</td>"
        +"<td>"+"<p class='print-tr' id='sti_save17' style=''>"+candida_urethra+"</p>"+"</td>"
        +"<td id='grey-box-10'>"+"<p class='print-tr' id='sti_save18' style=''>"+candida_postfornix+"</p>"+"</td>"
        +"<td id='grey-box-11'>"+"<p class='print-tr' id='sti_save19' style=''>"+candida_endo+"</p>"+"</td>"
        +"<td>"+"<p class='print-tr'id='no_entry10'  style=''>"+"-"+"</p>"+"</td>"
        +"</tr>"
        +"<tr>"
        +"<td>"+"7"+"</td>"
        +"<td>"+"Supermatozoites,RBCs,others:"+"</td>"
        +"<td>"+"<p class='print-tr' id='sti_save20' style=''>"+Sper_other_wet+"</p>"+"</td>"
        +"<td>"+"<p class='print-tr' id='sti_save21' style=''>"+Sper_other_urethra+"</p>"+"</td>"
        +"<td id='grey-box-12'>"+"<p class='print-tr' id='sti_save22' style=''>"+Sper_other_post+"</p>"+"</td>"
        +"<td id='grey-box-13'>"+"<p class='print-tr' id='sti_save23' style=''>"+Sper_other_endo+"</p>"+"</td>"
        +"<td>"+"<p class='print-tr'id='sti_save24' style=''>"+Sper_other_rectum+"</p>"+"</td>"
        +"</tr>"+
        "</tbody>"+
        "</table>"+
        "</div>"+
        "<div class='print-sti-urine'>"+
        "<table  class='table print-sti-table'>"+
        "<tbody>"+
        "<thead>"+
        "<tr>"
        +"<td>"+"NO."+"</td>"
        +"<td>"+"Urine exam (FPU)"+"</td>"
        +"</tr>"+
        "</thead>"

        +"<tr>"
        +"<td>"+"1."+"</td>"
        +"<td>"+"Gram(-) diplocci intra-cell"+"</td>"
        +"<td>"+"<p class='print-tr'id='sti_save26' style=''>"+intra_cell+"</p>"+"</td>"
        +"<td class='print-tr'>"+"4"+"</td>"
        +"<td class='print-tr'>"+"Epithelial cells"+"</td>"
        +"<td>"+"<p class='print-tr' id='sti_save27' style=''>"+epithelial_cell+"</p>"+"</td>"
        // +"<td>"+""+"</td>"
        +"</tr>"
        +"<tr>"
        +"<td>"+"2"+"</td>"
        +"<td>"+"Gram(-) diplocci extra-cell"+"</td>"
        +"<td>"+"<p class='print-tr' id='sti_save28' style=''>"+extra_cell+"</p>"+"</td>"
        +"<td class='print-tr'>"+"5"+"</td>"
        +"<td class='print-tr'>"+"PMNL cells"+"</td>"
        +"<td>"+"<p class='print-tr' id='sti_save29' style=''>"+pmnl_cell+"</p>"+"</td>"
        // +"<td>"+""+"</td>"
        +"</tr>"
        +"<tr>"
        +"<td>"+"3"+"</td>"
        +"<td>"+"Other bacteria(Gram Stain)"+"</td>"
        +"<td>"+"<p class='print-tr'id='sti_save30' style=''>"+oth_bact+"</p>"+"</td>"

        +"</tr>"+

        //  "<tr>"+"<td>"+"PMNL cells"+"</td>"+"<td>"+comment+"</td>"+"<td>"+""+"</td>"+"</tr>"+
        "</tbody>"+
        "</table>"+"</div>" ;




        $("#printLogo").append(logo);
        $("#printPtInfo").append(result_title);
        $("#printResultTable").append(result_body + result_footer);
        $("#header_bar").hide();
        // $("#grey-box-13").addClass("grey-boxes");
        for(var g=0;g<14;g++){
          $("#grey-box-"+g).addClass("grey-boxes");

        }

        var sti_save_id=[];
        for(var i=1;i<31;i++){
          sti_save_id[i]='sti_save'+i;

        }
        var no_entry_id=[];
        for(var i=1;i<16;i++){
          no_entry_id[i]='no_entry'+i;

        }

        for(var i=0;i<=sti_save_id.length;i++)
        {
          var sti_data = sti_save_id[i];
          if(!$('#'+sti_data).text() || $('#'+sti_data).text()=="-")
          $('#'+sti_data).css('background-color','grey')
        }
        for(var i=0;i<=no_entry_id.length;i++)
        {
          var no_entry_data = no_entry_id[i];
          if(!$('#'+no_entry_data).text() || $('#'+no_entry_data).text()=="-")
          $('#'+no_entry_data).css('background-color','black')

        }

        window.print();
        var ckUpdater = response[0][0]['name'];
        if(ckUpdater == 'updated')
        {
          alert("We have updated the data");
        }
        else{
          alert("We have collected test information of the patient.");
        }
        $("#app").show();
        $("#hider0").show();
        $("#hider1").show();
        $("#hidden-title").show();
        $("#header_bar").show();
        $("#save-update-print").show();

        $("#toshowResult").hide();
      }
    });
      }else{
        console.log("Cancel");
      }
    }else{
      // Validation to the ID
      setTimeout(function(){
        $("#noti_rpr").show();
        document.getElementById('noti_sti').innerHTML="Please check the 'ID' or 'Lab Technician' or 'Gender'.";
        document.getElementById('noti_sti').style="background-color:red;";
      },500);
      setTimeout(function(){
        document.getElementById('noti_sti').innerHTML="";
        $("#noti_sti").hide();
      },5000);
    }
}
//*****************************************************
function hbc_save(){
  var cid = document.getElementById("cid").value;
  var created_by = document.getElementById("navbarDropdown").innerHTML;
  var agey = $("#agey").text();
  var agem = $("#agem").text
  agey = parseInt(agey);//changing to number
  agem = parseInt(agem);
  if(isNaN(agey)){
    agey=0;
  }
  if(isNaN(agem)){
    agem=0;
  }
  var gender = $("#gender").text();
  gender= String(gender);
  var fuchiaID = document.getElementById("fuchiaID").value;
  // var clinic = document.getElementById("clinic").innerHTML;
  var clinic = 81;
  var vDate = document.getElementById("vDate").value;
  vDate = formatDate(vDate); // date FormatChange YYYY/MM/DD
  var Ptype = $("#Ptype").text();
  var ext_sub = $("#ext").text();
  if(ext_sub.length<33){// the blank response from text count is 32
    ext_sub ="-";
  }
  var reqDoctor = document.getElementById("md").value;

  var hepB = document.getElementById("hepB").value;
  var b_result = document.getElementById("B_result").value;
  var c_test = document.getElementById("c_test").value;
  var c_result = document.getElementById("c_result").value;
  var c_lab_tech = document.getElementById("C_lab_tech").value;
  var c_issueDate = document.getElementById("C_issueDate").value;
  c_issueDate = formatDate(c_issueDate); // date FormatChange YYYY/MM/DD
  ////console.log(c_issueDate+"c issue date");
  var totB = "Ag(RDT)";
  var totC = "Ab(RDT)";
  var hbc = 1;
  var hbcdata={
    hbc:hbc,
    cid:cid,
    fuchiaID:fuchiaID,
    agey:agey,
    agem:agem,
    gender:gender,
    vDate:vDate,
    Ptype:Ptype,
    ext_sub:ext_sub,
    reqDoctor:reqDoctor,
    clinic:clinic,
    hepB:hepB,
    totB:totB,
    b_result:b_result,
    c_test:c_test,
    totC:totC,
    c_result:c_result,
    c_lab_tech:c_lab_tech,
    c_issueDate:c_issueDate,

    created_by:created_by,
  };
  ////console.log(hbcdata);

  if(cid.length >8 &&  b_result.length >4 && present == 1){
    if (confirm("Are you sure you want to do save?")) {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        }
      });
    $.ajax({
      type:'POST',
      url:"{{route('tests')}}",
      dataType:'json',
      //  processData:false,
      contentType: 'application/json',
      data: JSON.stringify(hbcdata),
      success:function(response){
        $("#printLogo").empty();
        $("#printPtInfo").empty();
        $("#printResultTable").empty();
        // $('#app').hide();
        // $("#hider0").hide();
        // $("#hider1").hide();
        // $("#save-update-print").hide();
        // $( "#toshowResult" ).removeClass( "print-dispaly" );


        if(reqDoctor==null){
          reqDoctor= "__________";
        };

        if (c_lab_tech <1){
          lab_tech="_______";
        };

        if (c_issueDate <1){
          c_issueDate ="_______";
        };

        if(fuchiaID.length < 1){
          fuchiaID = "__________"
        };

        if(Number.isNaN(agey))  {
          var ageys= "____";
        }else {
          var ageys=agey;
        };

        if(Number.isNaN(agem)){
          var agems="__";
        }else {
          var agems=agem;
        };


        var logo =
        "<div class='row'>"+
        "<div class='d-flex justify-content-center' >"+
        "<h4  class='print-header clearfix'>"+  "<img src='/logoMAM.jpg'  alt='logo' style='width:70px;height:70px;'>"+
        "<p class='hiv-p'>"+"Hepatitis B and C Test Result"+"</p>"+"</h4>"+
        "</div>"+
        "</div>";
        var result_title=
        "<div class='d-flex justify-content-center print-coheader-list'>"+
        "<ul class='clearfix' style='width:84%;padding-left: 5%;'>"+
        "<li class='first-li'>"+"ID:"+"</li>"+"<li>"+cid+","+"</li>"+
        "<li class='first-li'>"+"Fuchia ID:"+"</li>"+"<li>"+fuchiaID+","+"</li>"+
        // "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
        "<li class='first-li'>"+"Date:"+"</li>"+"<li>"+vDate+","+"</li>"+
        // "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
        "<li class='first-li'>"+"Age(Y):"+"</li>"+"<li>"+ageys+","+"</li>"+
        // "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
        "<li class='first-li'>"+"Age(M):"+"</li>"+"<li>"+agems+","+"</li>"+
        // "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
        "<li class='first-li'>"+"Sex:"+"</li>"+"<li>"+gender+","+"</li>"+
        "</ul>"+
        "</div>";
        var result_footer=
        "<div class='print-hiv-footer'>"
        +"<ul class='clearfix print-hbc-footer'>"+
        "<li class='first-li'>"
        +"Requested Doctor:"+"</li>"+"<li>"+reqDoctor+","+"</li>"
        // +
        // "<li class='first-li'>"
        // +"Counselor:"+"</li>"+"<li>"+rpr_counselor+","+"</li>"
        +
        // "Counselor ::"+counselor+
        "<li>"
        +"Issue by-:"+"</li>"+"<li>"+c_lab_tech+","+"</li>"

        // "Issue by- "+lab_tech+
        +
        "<li>"
        +"Issue Date :"+"</li>"+"<li>"+c_issueDate+","+"</li>"
        +
        // "Issue Date :"+issue_date+
        "</div>";
        var result_body = "<div class='d-flex justify-content-center'>"+"<table class='table print-hbc-table'>"+ //+"Test Name"+"</td>"
        "<thead>"+
        "<tr>"  +"<td>"+"NO."+"</td>"+"<td>"+"Test Name"+"</td>"+"<td>"+"Type of Test"+"</td>"+"<td>"+"Result"+"</td>"+"</tr>"+
        "</thead>"+
        "<tbody>"+
        "<tr>" +"<td>"+"1"+"</td>"+"<td>"+"Hepatitis B"+"</td>"+"<td>"+"Ag(RDT)"+"</td>"+"<td>"+"<p class='print-tr'id='hbc_save1' style=''>"+b_result+"</td>"+"</p>"+"</tr>"+
        "<tr>" +"<td>"+"2"+"</td>"+"<td>"+"Hepatitis C"+"</td>"+"<td>"+"Ab(RDT)"+"</td>"+"<td>"+"<p class='print-tr'id='hbc_save2' style=''>"+c_result+"</td>"+"</p>"+"</tr>"+
        "</tbody>"+
        "</table>" +"</div>";




        $("#printLogo").append(logo);

        $("#printPtInfo").append(result_title);

        $("#printResultTable").append(result_body+result_footer);

        $("#header_bar").hide();
        ////console.log("end hebc");
        var hbc_save_id=[];
        for(var i=1;i<3;i++){
          hbc_save_id[i]='hbc_save'+i;

        }
        for(var i=1;i<=hbc_save_id.length;i++)
        {
          var hbc_data = hbc_save_id[i];
          if(!$('#'+hbc_data).text() || $('#'+hbc_data).text()=="-")
          $('#'+hbc_data).css('background-color','grey')
        }

        $("#app").hide();
        $("#hider0").hide();
        $("#hider1").hide();
        $('#save-update-print').hide();
        //  $( "#toshowResult" ).removeClass( "print-dispaly" );
        $( "#toshowResult" ).show();
        window.print();
        var ckUpdater = response[0][0]['name'];
        if(ckUpdater == 'updated')
        {
          alert("We have updated the data");
        }
        else{
          alert("We have collected test information of the patient.");
        }
        $("#app").show();
        $("#hider0").show();
        $("#hider1").show();
        $("#hidden-title").show();
        $("#toshowResult").hide();
        $("#save-update-print").show();
        $("#header_bar").show();
        //location.reload(true);// to refresh the page
      }
    });
       }else{
          console.log("Cancel");
        }
  }else{
        // Validation to the ID
        setTimeout(function(){
          $("#noti_hbc").show();
          document.getElementById('noti_hbc').innerHTML="Please check the 'ID' or 'Results'.";
          document.getElementById('noti_hbc').style="background-color:red;";
        },500);
        setTimeout(function(){
          document.getElementById('noti_hbc').innerHTML="";
          $("#noti_hbc").hide();

        },5000);
      }
}
function hbcUpdate(){

  var updated_by = document.getElementById("navbarDropdown").innerHTML;


  var cid = $("#cid").val();
  var agey = $("#agey").text();
  var agem = $("#agem").text();
  var gender = $("#gender").text();
  var fuchiaID = $("#fuchiaID").val();
  var clinic = 81;
  var vDate = $("#vDate").val();
  vDate = formatDate(vDate); // date FormatChange YYYY/MM/DD
  var Ptype = $("#Ptype").text();
  var ext_sub = $("#ext").text();
  var reqDoctor = document.getElementById("md").value;
  agey = parseInt(agey);//changing to number
  agem = parseInt(agem);
  gender= String(gender);
  

  var hepB = document.getElementById("hepB").value;

  var b_result = document.getElementById("B_result").value;
  var c_test = document.getElementById("c_test").value;

  var c_result = document.getElementById("c_result").value;
  var c_lab_tech = document.getElementById("C_lab_tech").value;
  var c_issueDate = document.getElementById("C_issueDate").value;
  c_issueDate = formatDate(c_issueDate); // date FormatChange YYYY/MM/DD



  if(save_update_hbc == 4){ // Updata Section
    update_rowNo_hbc= resp[3][0]['id'];
    var hbc = 2;
    var appUser = document.getElementById("navbarDropdown").innerHTML;// to collect app user from application nav bar
    var org_info = 'RowID->'+resp[3][0]['id']
    +',FuchiaID->' +resp[3][0]["fuchiacode"]
    + ',GeneralID->' +resp[3][0]["CID"]
    + ',Age(year)->' +resp[3][0]["agey"]
    + ',Age(mo)->' +resp[3][0]["agem"]
    + ',Gender->' +resp[3][0]["Gender"]
    + ',Visit Date->' +resp[3][0]["Visit_date"]
    + ',Risk->' +resp[3][0]['Patient_Type']
    + ',Sub risk->' +resp[3][0]['Patient Type Sub']
    + ',Hiv Status->' +resp[3][0]['Hiv status']
    + ',Hep B Test->' +resp[3][0]['Hep B Test']
    + ',Hep C Test->' +resp[3][0]['HepC Test']
    + ',Lab Tech->' +resp[3][0]['Lab Tech']
    + ',Issue Date->' +resp[3][0]['Issue Date'];
    var updated_info =
    'FuchiaID->'+fuchiaID +
    ',GeneralID->'+cid+
    ',Age(year)->'+agey+
    ',Age(mo)->'+agem+
    ',Gender->'+gender+
    ',Visit Date->'+vDate+
    ',Risk->'+Ptype+
    ',Sub Risk->'+ext_sub+
    ',MD ->'+reqDoctor+
    ',Hep B Test->'+hepB+
    ',Hep B Result->'+b_result+
    ',Hep C Test->'+c_test+
    ',Hep C Result->'+c_result+
    ',Lab Tech'+c_lab_tech+
    ',Issue Date'+c_issueDate;
    var hbcdata={
      updated_info:updated_info,
      org_info:org_info,
      appUser:appUser,
      update_rowNo_hbc:update_rowNo_hbc,

      hbc:hbc,
      cid:cid,
      fuchiaID:fuchiaID,
      agey:agey,
      agem:agem,
      gender:gender,
      vDate:vDate,
      Ptype:Ptype,
      ext_sub:ext_sub,
      reqDoctor:reqDoctor,
      clinic:clinic,
      bcdate:bcdate,
      hepB:hepB,

      b_result:b_result,
      c_test:c_test,

      c_result:c_result,
      c_lab_tech:c_lab_tech,
      c_issueDate:c_issueDate,

      updated_by: updated_by,
    };
  }
  if(cid.length >8  && c_result.length >0 || b_result.length >0 ){
    if (confirm("Are you sure you want to do save?")) {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        }
      });
        $.ajax({
          type:'POST',
          url:"{{route('tests')}}",
          dataType:'json',
          //  processData:false,
          contentType: 'application/json',
          data: JSON.stringify(hbcdata),
          success:function(response){
            console.log(response)
            $("#printLogo").empty();
            $("#printPtInfo").empty();
            $("#printResultTable").empty();
            $("#hider0").hide();
            $("#hider1").hide();
            $("#save-update-print").hide();
            $( "#toshowResult" ).removeClass( "print-dispaly" );


            if(reqDoctor==null){
              reqDoctor= "__________";
            };

            if (c_lab_tech <1){
              lab_tech="_______";
            };

            if (c_issueDate <1){
              c_issueDate ="_______";
            };

            if(fuchiaID.length < 1){
              fuchiaID = "__________"
            };

            if(Number.isNaN(agey))  {
              var ageys= "____";
            }else {
              var ageys=agey;
            };

            if(Number.isNaN(agem)){
              var agems="__";
            }else {
              var agems=agem;
            };
            var logo =
            "<div class='row'>"+
            "<div class='d-flex justify-content-center' >"+
            "<h4  class='print-header clearfix'>"+  "<img src='/logoMAM.jpg'  alt='logo' style='width:70px;height:70px;'>"+
            "<p class='hiv-p'>"+"Hepatitis B and C Test Result (Updated)"+"</p>"+"</h4>"+
            "</div>"+
            "</div>";
            var result_title=
            "<div class='d-flex justify-content-center print-coheader-list'>"+
            "<ul class='clearfix' style='width:84%;padding-left: 5%;'>"+
            "<li class='first-li'>"+"ID:"+"</li>"+"<li>"+cid+","+"</li>"+

            "<li class='first-li'>"+"Fuchia ID:"+"</li>"+"<li>"+fuchiaID+","+"</li>"+
            // "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
            "<li class='first-li'>"+"Date:"+"</li>"+"<li>"+vDate+","+"</li>"+
            // "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
            "<li class='first-li'>"+"Age(Y):"+"</li>"+"<li>"+ageys+","+"</li>"+
            // "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
            "<li class='first-li'>"+"Age(M):"+"</li>"+"<li>"+agems+","+"</li>"+
            // "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
            "<li class='first-li'>"+"Sex:"+"</li>"+"<li>"+gender+","+"</li>"+
            "</ul>"+

            "</div>";
            var result_footer=
            "<div class='print-hiv-footer'>"
            +"<ul class='clearfix print-hbc-footer'>"+
            "<li class='first-li'>"
            +"Requested Doctor:"+"</li>"+"<li>"+reqDoctor+","+"</li>"
            // +
            // "<li class='first-li'>"
            // +"Counselor:"+"</li>"+"<li>"+rpr_counselor+","+"</li>"
            +
            // "Counselor ::"+counselor+
            "<li>"
            +"Issue by-:"+"</li>"+"<li>"+c_lab_tech+","+"</li>"

            // "Issue by- "+lab_tech+
            +
            "<li>"
            +"Issue Date :"+"</li>"+"<li>"+c_issueDate+","+"</li>"
            +
            // "Issue Date :"+issue_date+
            "</div>";
            // var result_body = "<br>"+"<div class='col-sm-10 'style='width:100%'>"+"<table class='table print-hiv-table'>"+ //+"Test Name"+"</td>"
            //     "<thead>"+
            //         "<tr>"  +"<td>"+"NO."+"</td>"+"<td>"+"Test Name"+"</td>"+"<td>"+"Type of Test"+"</td>"+"<td>"+"Result"+"</td>"+"</tr>"+
            //     "</thead>"+
            //     "<tbody>"+
            //         "<tr>" +"<td>"+"1"+"</td>"+"<td>"+"Hepatitis B"+"</td>"+"<td>"+"Ag(RDT)"+"</td>"+"<td>"+b_result+"</td>"+"</tr>"+
            //         "<tr>" +"<td>"+"2"+"</td>"+"<td>"+"Hepatitis C"+"</td>"+"<td>"+"Ab(RDT)"+"</td>"+"<td>"+c_result+"</td>"+"</tr>"+
            //   "</tbody>"+
            // "</table>" +"</div>";
            var result_body = "<div class='d-flex justify-content-center' >"+"<table class='table print-hbc-table'>"+ //+"Test Name"+"</td>"
            "<thead>"+
            "<tr>"  +"<td>"+"NO."+"</td>"+"<td>"+"Test Name"+"</td>"+"<td>"+"Type of Test"+"</td>"+"<td>"+"Result"+"</td>"+"</tr>"+
            "</thead>"+
            "<tbody>"+
            "<tr>" +"<td>"+"1"+"</td>"+"<td>"+"Hepatitis B"+"</td>"+"<td>"+"Ag(RDT)"+"</td>"+"<td>"+"<p class='print-tr'id='hbc_save1' style=''>"+b_result+"</td>"+"</p>"+"</tr>"+
            "<tr>" +"<td>"+"2"+"</td>"+"<td>"+"Hepatitis C"+"</td>"+"<td>"+"Ab(RDT)"+"</td>"+"<td>"+"<p class='print-tr'id='hbc_save2' style=''>"+c_result+"</td>"+"</p>"+"</tr>"+
            "</tbody>"+
            "</table>" +"</div>";

            $("#printLogo").append(logo);

            $("#printPtInfo").append(result_title);

            $("#printResultTable").append(result_body+result_footer);

            $("#header_bar").hide();
            var hbc_save_id=[];
            for(var i=1;i<3;i++){
              hbc_save_id[i]='hbc_save'+i;

            }
            for(var i=1;i<=hbc_save_id.length;i++)
            {
              var hbc_data = hbc_save_id[i];
              if(!$('#'+hbc_data).text() || $('#'+hbc_data).text()=="-")
              $('#'+hbc_data).css('background-color','grey')
            }


            $("#app").hide();
            $("#hider0").hide();
            $("#hider1").hide();
            $("#hidden-title").hide();
            $("#header_bar").hide();
            $("#save-update-print").hide();


            $("#toshowResult").show();
            window.print();
            var ckUpdater = response[0][0]['name'];
            if(ckUpdater == 'updated')
            {
              alert("We have updated the data");
            }
            else{
              alert("We have collected test information of the patient.");
            }
            $("#app").show();
            $("#hider0").show();
            $("#hider1").show();
            $("#hidden-title").show();
            $("#header_bar").show();
            $("#save-update-print").show();

            $("#toshowResult").hide();
          }
        });
      }else{
        console.log("Cancel");
      }
    }else{
      // Validation to the ID
      setTimeout(function(){
        $("#noti_hbc").show();
        document.getElementById('noti_hbc').innerHTML="Please check the 'ID' or 'Results'.";
        document.getElementById('noti_hbc').style="background-color:red;";
      },500);
      setTimeout(function(){
        document.getElementById('noti_hbc').innerHTML="";
        $("#noti_hbc").hide();

      },5000);
    }

}
//*****************************************************
function Urine(){
  var cid = document.getElementById("cid").value;
  var created_by = document.getElementById("navbarDropdown").innerHTML;
  var agey = $("#agey").text();
  var agem = $("#agem").text
  agey = parseInt(agey);//changing to number
  agem = parseInt(agem);
  if(isNaN(agey)){
    agey=0;
  }
  if(isNaN(agem)){
    agem=0;
  }
  var gender = $("#gender").text();
  gender= String(gender);
  var fuchiaID = document.getElementById("fuchiaID").value;
  // var clinic = document.getElementById("clinic").innerHTML;
  var clinic = 81;
  var vDate = document.getElementById("vDate").value;
  vDate = formatDate(vDate); // date FormatChange YYYY/MM/DD
  var Ptype = $("#Ptype").text();
  var ext_sub = $("#ext").text();
  if(ext_sub.length<33){// the blank response from text count is 32
    ext_sub ="-";
  }
  var reqDoctor = document.getElementById("md").value;

  //var utest = document.getElementById("Utest_done").value;
  var typeoftest = document.getElementById("Utot").value;
  if(typeoftest){
    var utest_done="Done";
  }else{
    var utest_done="Not Done";
  }
  var appear = document.getElementById("Uapp").value;
  var color= document.getElementById("tubitity").value;
  var pus = document.getElementById("Upus").value;
  var uph = document.getElementById("ph").value;
  var protein = document.getElementById("Uprotein").value;
  var glucose = document.getElementById("Uglucose").value;
  var rbc = document.getElementById("Urbc").value;
  var leu = document.getElementById("Uleu").value;
  var nitrite = document.getElementById("Unitrite").value;
  var ketone = document.getElementById("ketone").value;
  var epithelial = document.getElementById("Uepithelial").value;
  var robili = document.getElementById('Urobili').value;
  var billru = document.getElementById('Ubiliru').value;
  var ery = document.getElementById('Uery').value;
  var crystal = document.getElementById('Ucrystal').value;
  var hae = document.getElementById('Uhae').value;
  var other = document.getElementById('Uother').value;

  if(other.length<1){
    other="-";
  }
  var cast = document.getElementById('Ucast').value;
  var Ument= document.getElementById('Ument').value;
  if(Ument.length<1){
    Ument="-";
  }
  var cretinine= document.getElementById('cretinine').value;
  if(cretinine.length<1){
    cretinine =0;var cretinine_show="-";
  }else{
    var cretinine_show=cretinine;
  }
  var albumin= document.getElementById('albumin').value;
  if(albumin.length<1){
    albumin=0; var albumin_show = "-";
  }else{
    var albumin_show= albumin;
  }
  var a_c_ratio= document.getElementById('a_c_ratio').value;

  var lab_tech= document.getElementById('u_lab_tech').value;
  var issue_date= document.getElementById('u_issuDate').value;
  issue_date = formatDate(issue_date); // date FormatChange YYYY/MM/DD


  var urineTest = 1;
  var urineData = {
    urineTest :urineTest ,
    cid:cid,
    fuchiaID:fuchiaID,
    vDate:vDate,
    Ptype:Ptype,
    ext_sub:ext_sub,
    agey:agey,
    agem:agem,
    gender:gender,
    reqDoctor:reqDoctor,
    clinic:clinic,

    typeoftest :typeoftest,
    utest_done:utest_done,
    color :color,
    appear :appear,
    pus :pus,
    uph :uph,
    protein :protein,
    glucose :glucose,
    rbc :rbc,
    leu :leu,
    nitrite :nitrite,
    ketone :ketone,
    epithelial :epithelial,
    robili:robili,
    billru:billru,
    ery :ery,
    crystal :crystal,
    hae :hae,
    other :other,
    cast :cast,
    Ument:Ument,

    cretinine:cretinine,
    albumin:albumin,
    a_c_ratio:a_c_ratio,

    lab_tech:lab_tech,
    issue_date:issue_date,

    created_by:created_by,
  };

  if(cid.length >8 && lab_tech.length > 2 && present == 1){
    if (confirm("Are you sure you want to do save?")) {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        }
      });
        $.ajax({
          type:'POST',
          url:"{{route('tests')}}",
          dataType:'json',
          //  processData:false,
          contentType: 'application/json',
          data: JSON.stringify(urineData),
          success:function(response){
            $("#printLogo").empty();
            $("#printPtInfo").empty();
            $("#printResultTable").empty();
            // $("#app").hide();
            // $("#hider0").hide();
            // $("#hider1").hide();
            // $("#save-update-print").hide();
            // $( "#toshowResult" ).removeClass( "print-dispaly" );
            if(reqDoctor.length<1){
              reqDoctor= "__________";
            };

            if (lab_tech <1){
              lab_tech="_______";
            };

            if (issue_date  <1){
              issue_date ="_______";
            };

            if(fuchiaID.length < 1){
              fuchiaID = "__________"
            };
            if(Number.isNaN(agey))  {
              var ageys= "____";
            }else {
              var ageys=agey;
            };
            if(agem.length < 1){
              var agems="__";
            }else {
              var agems=agem;
            };
            var logo =
            "<div class='row'>"+
            "<div class='d-flex justify-content-center' >"+

            "<h4  class='print-header clearfix'>"+  "<img src='/logoMAM.jpg'  alt='logo' style='width:70px;height:70px;'>"+
            "<p class='hiv-p'>"+"Urine Test Result"+"</p>"+"</h4>"+
            "</div>"+
            "</div>";
            var result_title=
            "<div class='d-flex justify-content-center print-coheader-list'>"+
            "<ul class='clearfix' style='width:84%;padding-left: 5%;'>"+
            "<li class='first-li'>"+"ID:"+"</li>"+"<li>"+cid+","+"</li>"+

            "<li class='first-li'>"+"Fuchia ID:"+"</li>"+"<li>"+fuchiaID+","+"</li>"+
            // "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
            "<li class='first-li'>"+"Date:"+"</li>"+"<li>"+vDate+","+"</li>"+
            // "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
            "<li class='first-li'>"+"Age(Y):"+"</li>"+"<li>"+ageys+","+"</li>"+
            // "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
            "<li class='first-li'>"+"Age(M):"+"</li>"+"<li>"+agems+","+"</li>"+
            // "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
            "<li class='first-li'>"+"Sex:"+"</li>"+"<li>"+gender+","+"</li>"+
            "</ul>"+

            "</div>";
            var result_footer=
            "<div class='print-hiv-footer'>"
            +"<ul class='clearfix print-sti-footer'>"+
            "<li class='first-li'>"
            +"Requested Doctor:"+"</li>"+"<li>"+reqDoctor+","+"</li>"
            +
            "<li>"
            +"Issue by-:"+"</li>"+"<li>"+lab_tech+","+"</li>"
            +
            "<li>"
            +"Issue Date :"+"</li>"+"<li>"+issue_date+","+"</li>"
            +
            "</div>";
            var result_body = "<br>"  +"<div class='col-sm-10' style='width:100%'>"+"<table class='table  print-urine-table'>"+
            "<thead>"+
            "<tr>"+
            "<td>"+"No."+"</td>"+
            "<td>"+"Test Name"+"</td>"+
            "<td>"+"Results"+"</td>"+
            "<td>"+"No."+"</td>"+
            "<td>"+"Test Name"+"</td>"+
            "<td>"+"Results"+"</td>"+
            "</tr>"+
            "</thead>"+
            "<tbody>"+


            "<tr>"+
            "<td >"+"1."+"</td>"+
            "<td>"+"Type Of Test"+"</td>"+
            "<td>"+"<p class='print-tr'id='urine_save1' style=''>"+typeoftest+"</p>"+"</td>"+

            "<td>"+"1."+"</td>"+
            "<td>"+"pus/WBC"+"</td>"+
            "<td>"+"<p class='print-tr'id='urine_save14' style=''>"+pus+"</p>"+"</td>"+
            "</tr>"+
            "<tr>"+
            "<td>"+"2."+"</td>"+
            "<td>"+"Apperance"+"</td>"+
            "<td>"+"<p class='print-tr'id='urine_save2' style=''>"+appear+"</p>"+"</td>"+
            "<td>"+"2."+"</td>"+
            "<td>"+"RBC"+"</td>"+
            "<td>"+"<p class='print-tr'id='urine_save16' style=''>"+rbc+"</p>"+"</td>"+
            "</tr>"+
            "<tr>"+
            "<td>"+"3."+"</td>"+
            "<td>"+"Tubitity"+"</td>"+
            "<td>"+"<p class='print-tr'id='urine_save13' style=''>"+color+"</p>"+"</td>"+
            "<td>"+"3."+"</td>"+
            "<td>"+"Epithelial Cell"+"</td>"+
            "<td>"+"<p class='print-tr'id='urine_save18' style=''>"+epithelial+"</p>"+"</td>"+
            "</tr>"+
            "<tr>"+
            "<td>"+"4."+"</td>"+
            "<td>"+"PH"+"</td>"+
            "<td>"+"<p class='print-tr'id='urine_save3' style=''>"+uph+"</p>"+"</td>"+
            "<td>"+"4."+"</td>"+
            "<td>"+"Crystal"+"</td>"+
            "<td>"+"<p class='print-tr'id='urine_save20' style=''>"+crystal+"</p>"+"</td>"+
            "</tr>"+
            "<tr>"+
            "<td>"+"5."+"</td>"+
            "<td>"+"Protein"+"</td>"+
            "<td>"+"<p class='print-tr'id='urine_save15' style=''>"+protein+"</p>"+"</td>"+
            "<td>"+"5."+"</td>"+
            "<td>"+"Cast"+"</td>"+
            "<td>"+"<p class='print-tr'id='urine_save10' style=''>"+cast+"</p>"+"</td>"+

            "</tr>"+
            "<tr>"+
            "<td>"+"6."+"</td>"+
            "<td>"+"Glucose"+"</td>"+
            "<td>"+"<p class='print-tr'id='urine_save4' style=''>"+glucose+"</p>"+"</td>"+
            "<td>"+"6."+"</td>"+
            "<td>"+"Other "+"</td>"+
            "<td>"+"<p class='print-tr'id='urine_save21' style=''>"+other +"</p>"+"</td>"+
            "</tr>"+
            "<tr>"+
            "<td>"+"7."+"</td>"+
            "<td>"+"Leukocyte"+"</td>"+
            "<td>"+"<p class='print-tr'id='urine_save5' style=''>"+leu+"</p>"+"</td>"+
            "<td>"+""+"</td>"+
            "<td>"+""+"</td>"+
            "<td>"+""+"</td>"+
            "</tr>"+
            "<tr>"+
            "<td>"+"8."+"</td>"+
            "<td>"+"Nitrite"+"</td>"+
            "<td>"+"<p class='print-tr'id='urine_save17' style=''>"+nitrite+"</p>"+"</td>"+
            "<td>"+""+"</td>"+
            "<td>"+""+"</td>"+
            "<td>"+""+"</td>"+
            "</tr>"+
            "<tr>"+
            "<td>"+"9."+"</td>"+
            "<td>"+"Ketone"+"</td>"+
            "<td>"+"<p class='print-tr'id='urine_save6' style=''>"+ketone+"</p>"+"</td>"+
            "<td>"+""+"</td>"+
            "<td>"+""+"</td>"+
            "<td>"+""+"</td>"+
            "</tr>"+
            "<tr>"+
            "<td>"+"10."+"</td>"+
            "<td>"+"Urobilinogen"+"</td>"+
            "<td>"+"<p class='print-tr'id='urine_save7' style=''>"+robili+"</p>"+"</td>"+
            "<td>"+""+"</td>"+
            "<td>"+""+"</td>"+
            "<td>"+""+"</td>"+
            "</tr>"+
            "<tr>"+
            "<td>"+"11."+"</td>"+
            "<td>"+"Bilirubin"+"</td>"+
            "<td>"+"<p class='print-tr'id='urine_save19' style=''>"+billru+"</p>"+"</td>"+
            "<td>"+""+"</td>"+
            "<td>"+""+"</td>"+
            "<td>"+""+"</td>"+
            "</tr>"+
            "<tr>"+
            "<td>"+"12."+"</td>"+
            "<td>"+"Erythrocyte"+"</td>"+
            "<td>"+"<p class='print-tr'id='urine_save8' style=''>"+ery+"</p>"+"</td>"+
            "<td>"+""+"</td>"+
            "<td>"+""+"</td>"+
            "<td>"+""+"</td>"+
            "</tr>"+
            "<tr>"+
            "<td>"+"13."+"</td>"+
            "<td>"+"Haemoglobin"+"</td>"+
            "<td>"+"<p class='print-tr'id='urine_save9' style=''>"+hae+"</p>"+"</td>" +
            "<td>"+""+"</td>"+
            "<td>"+""+"</td>"+
            "<td>"+""+"</td>"+
            "</tr>"+
            "<td>"+""+"</td>"+
            "<td>"+""+"</td>"+
            "<td>"+""+"</td>"+

            "<td>"+"1."+"</td>"+
            "<td>"+"Cretinine (mg/dl)"+"</td>"+
            "<td>"+"<p class='print-tr'id='urine_save11' style=''>"+cretinine_show+"</p>"+"</td>"+

            "</tr>"+
            "<tr>"+
            "<td>"+""+"</td>"+
            "<td>"+""+"</td>"+
            "<td>"+""+"</td>"+
            "<td>"+"2."+"</td>"+
            "<td>"+"Albumin(mg/L)"+"</td>"+
            "<td>"+"<p class='print-tr'id='urine_save23' style=''>"+albumin_show+"</p>"+"</td>"+

            "</tr>"+
            "<tr>"+
            "<td>"+""+"</td>"+
            "<td>"+""+"</td>"+
            "<td>"+""+"</td>"+
            "<td>"+"3."+"</td>"+
            "<td>"+"A : C (ratio)mg/g"+"</td>"+
            "<td>"+"<p class='print-tr'id='urine_save12' style=''>"+a_c_ratio+"</p>"+"</td>"+
            // "<td>"+"<p class='print-tr'id='urine_no_entry1' style=''>"+"-"+"</p>"+"</td>"+
            // "<td>"+"<p class='print-tr'id='urine_no_entry2' style=''>"+"-"+"</p>"+"</td>"+
            // "<td>"+"<p class='print-tr'id='urine_no_entry3' style=''>"+"-"+"</p>"+"</td>"+
            "</tr>"+
            "<tr>"+
            "<td>"+""+"</td>"+
            "<td>"+"Comment"+"</td>"+
            "<td>"+"<p class='print-tr'id='urine_save22' style=''>"+Ument+"</p>"+"</td>"+
            "<td>"+""+"</td>"+
            "<td>"+""+"</td>"+
            "<td>"+""+"</td>"+
            "</tr>"+
            "<tr>"+
            "</tbody>"+
            "</table>" +"</div>";
            $("#printLogo").append(logo);
            $("#printPtInfo").append(result_title);
            $("#printResultTable").append(result_body+result_footer);
            $("#header_bar").hide();
            ////console.log(a_c_ratio +"acratio");
            ////console.log(response);
            var urine_save_id=[];
            for(var i=1;i<24;i++){
              urine_save_id[i]='urine_save'+i;

            }
            var no_entry_id=[];
            for(var i=1;i<4;i++){
              no_entry_id[i]='urine_no_entry'+i;

            }

            for(var i=0;i<=urine_save_id.length;i++)
            {
              var urine_data = urine_save_id[i];
              if(!$('#'+urine_data).text() || $('#'+urine_data).text()=="-"||$('#'+urine_data).text()=="0")
              $('#'+urine_data).css('background-color','grey');
            }
            for(var i=0;i<=no_entry_id.length;i++)
            {
              var no_entry_data = no_entry_id[i];
              if(!$('#'+no_entry_data).text() || $('#'+no_entry_data).text()=="-")
              $('#'+no_entry_data).css('background-color','black');
            }

            $("#app").hide();
            $("#hider0").hide();
            $("#hider1").hide();
            $('#save-update-print').hide();
            //  $( "#toshowResult" ).removeClass( "print-dispaly" );
            $( "#toshowResult" ).show();
            window.print();
            var ckUpdater = response[0][0]['name'];
            if(ckUpdater == 'updated')
            {
              alert("We have updated the data");
            }
            else{
              alert("We have collected test information of the patient.");
            }
            $("#app").show();
            $("#hider0").show();
            $("#hider1").show();
            $("#hidden-title").show();
            $("#toshowResult").hide();
            $("#save-update-print").show();
            $("#header_bar").show();
            //location.reload(true);// to refresh the page
          }
        });
      }else{
        console.log("Cancel");
      }
    }else{
        // Validation to the ID
        setTimeout(function(){
          $("#noti_urine").show();
          document.getElementById('noti_urine').innerHTML="Please check the 'ID' or 'Results'.";
          document.getElementById('noti_urine').style="background-color:red;";
        },500);
        setTimeout(function(){
          document.getElementById('noti_urine').innerHTML="";
          $("#noti_urine").hide();

        },5000);
      }
}
function urineUpdate(){
  var updated_by = document.getElementById("navbarDropdown").innerHTML;


  var cid = document.getElementById("cid").value;

  var agey = $("#agey").text();
  var agem = $("#agem").text
  agey = parseInt(agey);//changing to number
  agem = parseInt(agem);
  if(isNaN(agey)){
    agey=0;
  }
  if(isNaN(agem)){
    agem=0;
  }
  var gender = $("#gender").text();
  gender= String(gender);
  var fuchiaID = document.getElementById("fuchiaID").value;
  // var clinic = document.getElementById("clinic").innerHTML;
  var clinic = 81;
  var vDate = document.getElementById("vDate").value;
  vDate = formatDate(vDate); // date FormatChange YYYY/MM/DD
  var Ptype = $("#Ptype").text();
  var ext_sub = $("#ext").text();
  if(ext_sub.length<33){// the blank response from text count is 32
    ext_sub ="-";
  }
  var reqDoctor = document.getElementById("md").value;

  //var utest = document.getElementById("Utest_done").value;
  var typeoftest = document.getElementById("Utot").value;
  var appear = document.getElementById("Uapp").value;
  var color= document.getElementById("tubitity").value;
  var pus = document.getElementById("Upus").value;
  var uph = document.getElementById("ph").value;
  var protein = document.getElementById("Uprotein").value;
  var glucose = document.getElementById("Uglucose").value;
  var rbc = document.getElementById("Urbc").value;
  var leu = document.getElementById("Uleu").value;
  var nitrite = document.getElementById("Unitrite").value;
  var ketone = document.getElementById("ketone").value;
  var epithelial = document.getElementById("Uepithelial").value;
  var robili = document.getElementById('Urobili').value;
  var billru = document.getElementById('Ubiliru').value;
  var ery = document.getElementById('Uery').value;
  var crystal = document.getElementById('Ucrystal').value;
  var hae = document.getElementById('Uhae').value;
  var other = document.getElementById('Uother').value;

  if(other.length<1){
    other="-";
  }
  var cast = document.getElementById('Ucast').value;
  var Ument= document.getElementById('Ument').value;
  if(Ument.length<1){
    Ument="-";
  }
  var cretinine= document.getElementById('cretinine').value;
  if(cretinine.length<1){
    cretinine =0;
  }
  var albumin= document.getElementById('albumin').value;
  if(albumin.length<1){
    albumin=0;
  }
  var a_c_ratio= document.getElementById('a_c_ratio').value;

  var lab_tech= document.getElementById('u_lab_tech').value;
  var issue_date= document.getElementById('u_issuDate').value;
  issue_date = formatDate(issue_date); // date FormatChange YYYY/MM/DD

  if(save_update_urine == 5){
    var urineTest = 2;

    update_rowNo_urine= resp[4][0]['id'];

    var appUser = document.getElementById("navbarDropdown").innerHTML;// to collect app user from application nav bar

    var org_info =
    'RowID->'+resp[4][0]['id']
    +',FuchiaCode->'+resp[4][0]["fuchiacode"]
    + ',GeneralID->' +resp[4][0]["CID"]
    + ',Age(year)->' +resp[4][0]["agey"]
    +',Age(Mo)->' +resp[4][0]["agem"]
    + ',Gender->' +resp[4][0]["Gender"]
    + ',Visit Date->' +resp[4][0]["visitDate"]


    + ',Utest_done->' +resp[4][0]['Utest_done']
    + ',Type of Test->' +resp[4][0]['Utot']
    + ',Color->' +resp[4][0]['Ucolor']
    +',Uapp->' +resp[4][0]['Uapp']
    + ',Upus->' +resp[4][0]['Upus']
    + ',ph->' +resp[4][0]['ph']
    + ',protein->' +resp[4][0]['Uprotein']
    + ',glucose->' +resp[4][0]['Uglucose']
    + ',rbc->' +resp[4][0]['Urbc']
    + ',leu->' +resp[4][0]['Uleu']
    + ',nitrite->' +resp[4][0]['Unitrite']
    + ',ketone->' +resp[4][0]['Uketone']
    + ',epithelial->' +resp[4][0]['Uepithelial']
    + ',robili->' +resp[4][0]['Urobili']
    + ',billru->' +resp[4][0]['Ubillru']
    + ',Uery->' +resp[4][0]['Uery']
    + ',crystal->' +resp[4][0]['Ucrystal']
    + ',hae->' +resp[4][0]['Uhae']
    + ',other->' +resp[4][0]['Uother']
    + ',cast->' +resp[4][0]['Ucast']
    + ',comment->' +resp[4][0]['comment']
    + ',lab_tech->' +resp[4][0]['lab_tech']
    + ',issue_date->' +resp[4][0]['issue_date'];


    var updated_info = 'FuchiaID->'+fuchiaID +',GeneralID->'+ cid ;
    var urineData = {

      updated_info:updated_info,
      org_info:org_info,
      appUser:appUser,
      update_rowNo_urine:update_rowNo_urine,

      urineTest :urineTest ,
      cid:cid,
      fuchiaID:fuchiaID,
      vDate:vDate,
      Ptype:Ptype,
      ext_sub:ext_sub,
      agey:agey,
      agem:agem,
      gender:gender,
      reqDoctor:reqDoctor,
      clinic:clinic,


      typeoftest :typeoftest,
      color :color,
      appear :appear,
      pus :pus,
      uph :uph,
      protein :protein,
      glucose :glucose,
      rbc :rbc,
      leu :leu,
      nitrite :nitrite,
      ketone :ketone,
      epithelial :epithelial,
      robili:robili,
      billru:billru,
      ery :ery,
      crystal :crystal,
      hae :hae,
      other :other,
      cast :cast,
      Ument:Ument,
      lab_tech:lab_tech,
      issue_date:issue_date,


      cretinine:cretinine,
      albumin:albumin,
      a_c_ratio:a_c_ratio,

      updated_by:updated_by,
    };
  }

  if(cid.length >8 && lab_tech.length > 2 ){
    if (confirm("Are you sure you want to do save?")) {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
      }
    });
    $.ajax({
      type:'POST',
      url:"{{route('tests')}}",
      dataType:'json',
      //  processData:false,
      contentType: 'application/json',
      data: JSON.stringify(urineData),
      success:function(response){
        //$("#toshowResult").clear();
        $("#printLogo").empty();
        $("#printPtInfo").empty();
        $("#printResultTable").empty();

        alert("You arrived success");
        $("#app").hide();
        $("#hider0").hide();
        $("#hider1").hide();
        $("#save-update-print").hide();
        $( "#toshowResult" ).removeClass( "print-dispaly" );
        if(reqDoctor.length<1){
          reqDoctor= "__________";
        };

        if (lab_tech <1){
          lab_tech="_______";
        };

        if (issue_date  <1){
          issue_date ="_______";
        };

        if(fuchiaID.length < 1){
          fuchiaID = "__________"
        };

        if(Number.isNaN(agey))  {
          var ageys= "____";
        }else {
          var ageys=agey;
        };

        if(agem.length < 1){
          var agems="__";
        }else {
          var agems=agem;
        };

        var logo =
        "<div class='row'>"+
        "<div class='d-flex justify-content-center' >"+

        "<h4  class='print-header clearfix'>"+  "<img src='/logoMAM.jpg'  alt='logo' style='width:70px;height:70px;'>"+
        "<p class='hiv-p'>"+"Urine Test Result (Updated)"+"</p>"+"</h4>"+
        "</div>"+
        "</div>";
        var result_title=
        "<div class='d-flex justify-content-center print-coheader-list'>"+
        "<ul class='clearfix' style='width:84%;padding-left: 5%;'>"+
        "<li class='first-li'>"+"ID:"+"</li>"+"<li>"+cid+","+"</li>"+

        "<li class='first-li'>"+"Fuchia ID:"+"</li>"+"<li>"+fuchiaID+","+"</li>"+
        // "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
        "<li class='first-li'>"+"Date:"+"</li>"+"<li>"+vDate+","+"</li>"+
        // "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
        "<li class='first-li'>"+"Age(Y):"+"</li>"+"<li>"+ageys+","+"</li>"+
        // "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
        "<li class='first-li'>"+"Age(M):"+"</li>"+"<li>"+agems+","+"</li>"+
        // "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
        "<li class='first-li'>"+"Sex:"+"</li>"+"<li>"+gender+","+"</li>"+
        "</ul>"+

        "</div>";
        var result_footer=
        "<div class='print-hiv-footer'>"
        +"<ul class='clearfix print-sti-footer'>"+
        "<li class='first-li'>"
        +"Requested Doctor:"+"</li>"+"<li>"+reqDoctor+","+"</li>"
        // +
        // "<li class='first-li'>"
        // +"Counselor:"+"</li>"+"<li>"+rpr_counselor+","+"</li>"
        +
        // "Counselor ::"+counselor+
        "<li>"
        +"Issue by-:"+"</li>"+"<li>"+lab_tech+","+"</li>"

        // "Issue by- "+lab_tech+
        +
        "<li>"
        +"Issue Date :"+"</li>"+"<li>"+issue_date+","+"</li>"
        +
        // "Issue Date :"+issue_date+
        "</div>";


        var result_body = "<br>"  +"<div class='col-sm-10' style='width:100%'>"+"<table class='table  print-urine-table'>"+
        "<thead>"+
        "<tr>"+
        "<td>"+"No."+"</td>"+
        "<td>"+"Test Name"+"</td>"+
        "<td>"+"Results"+"</td>"+
        "<td>"+"No."+"</td>"+
        "<td>"+"Test Name"+"</td>"+
        "<td>"+"Results"+"</td>"+
        "</tr>"+
        "</thead>"+
        "<tbody>"+
        "<tr>"+
        "<td>"+"1."+"</td>"+
        "<td>"+"Type Of Test"+"</td>"+
        "<td>"+"<p class='print-tr'id='urine_save1' style=''>"+typeoftest+"</p>"+"</td>"+
        "<td>"+"13."+"</td>"+
        "<td>"+"Tubitity"+"</td>"+
        "<td>"+"<p class='print-tr'id='urine_save13' style=''>"+color+"</p>"+"</td>"+
        "</tr>"+
        "<tr>"+
        "<td>"+"2."+"</td>"+
        "<td>"+"Apperance"+"</td>"+
        "<td>"+"<p class='print-tr'id='urine_save2' style=''>"+appear+"</p>"+"</td>"+
        "<td>"+"14."+"</td>"+
        "<td>"+"pus/WBC"+"</td>"+
        "<td>"+"<p class='print-tr'id='urine_save14' style=''>"+pus+"</p>"+"</td>"+
        "</tr>"+
        "<tr>"+
        "<td>"+"3."+"</td>"+
        "<td>"+"PH"+"</td>"+
        "<td>"+"<p class='print-tr'id='urine_save3' style=''>"+uph+"</p>"+"</td>"+
        "<td>"+"15."+"</td>"+
        "<td>"+"Protein"+"</td>"+
        "<td>"+"<p class='print-tr'id='urine_save15' style=''>"+protein+"</p>"+"</td>"+
        "</tr>"+
        "<tr>"+
        "<td>"+"4."+"</td>"+
        "<td>"+"Glucose"+"</td>"+
        "<td>"+"<p class='print-tr'id='urine_save4' style=''>"+glucose+"</p>"+"</td>"+
        "<td>"+"16."+"</td>"+
        "<td>"+"RBC"+"</td>"+
        "<td>"+"<p class='print-tr'id='urine_save16' style=''>"+rbc+"</p>"+"</td>"+
        "</tr>"+
        "<tr>"+
        "<td>"+"5."+"</td>"+
        "<td>"+"Leukocyte"+"</td>"+
        "<td>"+"<p class='print-tr'id='urine_save5' style=''>"+leu+"</p>"+"</td>"+
        "<td>"+"17."+"</td>"+
        "<td>"+"Nitrite"+"</td>"+
        "<td>"+"<p class='print-tr'id='urine_save17' style=''>"+nitrite+"</p>"+"</td>"+
        "</tr>"+
        "<tr>"+
        "<td>"+"6."+"</td>"+
        "<td>"+"Ketone"+"</td>"+
        "<td>"+"<p class='print-tr'id='urine_save6' style=''>"+ketone+"</p>"+"</td>"+
        "<td>"+"18."+"</td>"+
        "<td>"+"Epithelial Cell"+"</td>"+
        "<td>"+"<p class='print-tr'id='urine_save18' style=''>"+epithelial+"</p>"+"</td>"+
        "</tr>"+
        "<tr>"+
        "<td>"+"7."+"</td>"+
        "<td>"+"Urobilinogen"+"</td>"+
        "<td>"+"<p class='print-tr'id='urine_save7' style=''>"+robili+"</p>"+"</td>"+
        "<td>"+"19."+"</td>"+
        "<td>"+"Bilirubin"+"</td>"+
        "<td>"+"<p class='print-tr'id='urine_save19' style=''>"+billru+"</p>"+"</td>"+
        "</tr>"+
        "<tr>"+
        "<td>"+"8."+"</td>"+
        "<td>"+"Erythrocyte"+"</td>"+
        "<td>"+"<p class='print-tr'id='urine_save8' style=''>"+ery+"</p>"+"</td>"+
        "<td>"+"20."+"</td>"+
        "<td>"+"Crystal"+"</td>"+
        "<td>"+"<p class='print-tr'id='urine_save20' style=''>"+crystal+"</p>"+"</td>"+
        "</tr>"+
        "<tr>"+
        "<td>"+"9."+"</td>"+
        "<td>"+"Haemoglobin"+"</td>"+
        "<td>"+"<p class='print-tr'id='urine_save9' style=''>"+hae+"</p>"+"</td>" +
        "<td>"+"21."+"</td>"+
        "<td>"+"Other "+"</td>"+
        "<td>"+"<p class='print-tr'id='urine_save21' style=''>"+other +"</p>"+"</td>"+
        "</tr>"+
        "<tr>"+
        "<td>"+"10."+"</td>"+
        "<td>"+"Cast"+"</td>"+
        "<td>"+"<p class='print-tr'id='urine_save10' style=''>"+cast+"</p>"+"</td>"+
        "<td>"+"22."+"</td>"+
        "<td>"+"Comment"+"</td>"+
        "<td>"+"<p class='print-tr'id='urine_save22' style=''>"+Ument+"</p>"+"</td>"+
        "</tr>"+
        "<tr>"+
        "<td>"+"11."+"</td>"+
        "<td>"+"Cretinine (mg/dl)"+"</td>"+
        "<td>"+"<p class='print-tr'id='urine_save11' style=''>"+cretinine+"</p>"+"</td>"+
        "<td>"+"23."+"</td>"+
        "<td>"+"Albumin(mg/L)"+"</td>"+
        "<td>"+"<p class='print-tr'id='urine_save23' style=''>"+albumin+"</p>"+"</td>"+
        "</tr>"+
        "<tr>"+
        "<td>"+"12."+"</td>"+
        "<td>"+"A : C (ratio)mg/g"+"</td>"+
        "<td>"+"<p class='print-tr'id='urine_save12' style=''>"+a_c_ratio+"</p>"+"</td>"+
        "<td>"+"<p class='print-tr'id='urine_no_entry1' style=''>"+"-"+"</p>"+"</td>"+
        "<td>"+"<p class='print-tr'id='urine_no_entry2' style=''>"+"-"+"</p>"+"</td>"+
        "<td>"+"<p class='print-tr'id='urine_no_entry3' style=''>"+"-"+"</p>"+"</td>"+
        "</tr>"+
        "</tbody>"+
        "</table>" +"</div>";
        $("#printLogo").append(logo);
        $("#printPtInfo").append(result_title);
        $("#printResultTable").append(result_body+result_footer);
        $("#header_bar").hide();
        ////console.log(cretinine);
        ////console.log(albumin);
        ////console.log(a_c_ratio);

        var urine_save_id=[];
        for(var i=1;i<24;i++){
          urine_save_id[i]='urine_save'+i;

        }
        var no_entry_id=[];
        for(var i=1;i<4;i++){
          no_entry_id[i]='urine_no_entry'+i;

        }

        for(var i=0;i<=urine_save_id.length;i++)
        {
          var urine_data = urine_save_id[i];
          if(!$('#'+urine_data).text() || $('#'+urine_data).text()=="-"||$('#'+urine_data).text()=="0")
          $('#'+urine_data).css('background-color','grey');
        }
        for(var i=0;i<=no_entry_id.length;i++)
        {
          var no_entry_data = no_entry_id[i];
          if(!$('#'+no_entry_data).text() || $('#'+no_entry_data).text()=="-")
          $('#'+no_entry_data).css('background-color','black');
        }

        $("#app").hide();
        $("#hider0").hide();
        $("#hider1").hide();
        $("#hidden-title").hide();
        $("#header_bar").hide();
        $("#save-update-print").hide();


        $("#toshowResult").show();

        window.print();
        var ckUpdater = response[0][0]['name'];
        if(ckUpdater == 'updated')
        {
          alert("We have updated the data");
        }
        else{
          alert("We have collected test information of the patient.");
        }
        $("#app").show();
        $("#hider0").show();
        $("#hider1").show();
        $("#hidden-title").show();
        $("#header_bar").show();
        $("#save-update-print").show();

        $("#toshowResult").hide();

      }
    });
      }else{
        console.log("Cancel");
      }
  }else{
    // Validation to the ID
    setTimeout(function(){
      $("#noti_urine").show();
      document.getElementById('noti_urine').innerHTML="Please check the 'ID' or 'Results'.";
      document.getElementById('noti_urine').style="background-color:red;";
    },500);
    setTimeout(function(){
      document.getElementById('noti_urine').innerHTML="";
      $("#noti_urine").hide();

    },5000);
  }

}

function urineChoice() {
  var urineTest = document.querySelector('#Utot').value;
  if(urineTest=="Dipstick") {
    $("#Upus").prop('disabled', true);
    $("#Urbc").prop('disabled', true);
    $("#Uepithelial").prop('disabled', true);
    $("#Ucrystal").prop('disabled', true);
    $("#Ucast").prop('disabled', true);
    $("#Uother").prop('disabled', true);
  }else {
    $("#Upus").prop('disabled', false);
    $("#Urbc").prop('disabled', false);
    $("#Uepithelial").prop('disabled', false);
    $("#Ucrystal").prop('disabled', false);
    $("#Ucast").prop('disabled', false);
    $("#Uother").prop('disabled', false);
  }
}
//*****************************************************
function oi_save(){
  var cid = document.getElementById("cid").value;
  var created_by = document.getElementById("navbarDropdown").innerHTML;
  var agey = $("#agey").text();
  var agem = $("#agem").text
  agey = parseInt(agey);//changing to number
  agem = parseInt(agem);
  if(isNaN(agey)){
    agey=0;
  }
  if(isNaN(agem)){
    agem=0;
  }
  var gender = $("#gender").text();
  gender= String(gender);
  var fuchiaID = document.getElementById("fuchiaID").value;
  // var clinic = document.getElementById("clinic").innerHTML;
  var clinic = 81;
  var vDate = document.getElementById("vDate").value;
  vDate = formatDate(vDate); // date FormatChange YYYY/MM/DD
  var Ptype = $("#Ptype").text();
  var ext_sub = $("#ext").text();
  if(ext_sub.length<33){// the blank response from text count is 32
    ext_sub ="-";
  }
  var reqDoctor = document.getElementById("md").value;
  ///////////////
  var tb_lam_report       = document.getElementById('tb_lam').value;

  var toxo_plasma    = document.getElementById('toxo_plasma').value;
  var toxo_igG       = document.getElementById('toxo_igG').value;
  var toxo_igm       = document.getElementById('toxo_igm').value;

  var serum_cry_antigen   = document.getElementById('serum_cry_antigen').value;
  var serum_cry_due       = document.getElementById('serum_cry_dil').value;
  var csf_cry_antigen     = document.getElementById('csf_cry_antigen').value;
  var csf_due             = document.getElementById('csf_dil').value;

  var csf_smear           = document.getElementById('csf_smear').value;
  var giemsa_stain_result = document.getElementById('giemsa_stain_result').value;
  var india_ink_result    = document.getElementById('india_ink_result').value;

  var skin_smear          = document.getElementById('skin_smear').value;
  var skin_giemsa_stain_result   = document.getElementById('skin_giemsa_stain_result').value;
  var skin_india_ink_result      = document.getElementById('skin_india_ink_result').value;

  var lymph_test = document.getElementById('lymph_test').value;
  var lymph_giemsa_stain = document.getElementById('lymph_giemsa_stain').value;
  var lymph_india_ink = document.getElementById('lymph_india_ink').value;

  //var type_sample   = document.getElementById('type_sample').value;
  //var gram_stain_result    = document.getElementById('gram_stain_result').value;
  var oi_lab_tech   = document.getElementById('oi_lab_tech').value;
  var oi_issue_date = document.getElementById('oi_issue_date').value;
  oi_issue_date = formatDate(oi_issue_date); // date FormatChange YYYY/MM/DD
  //var oi_visitID    = document.getElementById('').value;
  var oi_save_id=[];
  for(var i=1;i<31;i++){
    oi_save_id[i]='oi_save'+i;

  }
  var no_entry_id=[];
  for(var i=1;i<16;i++){
    no_entry_id[i]='oi_no_entry'+i;

  }


  var oiTest = 1;
  var oiData={
    oiTest:oiTest,
    cid:cid,
    fuchiaID:fuchiaID,
    agey:agey,
    agem:agem,
    gender:gender,
    vDate:vDate,
    Ptype:Ptype,
    ext_sub:ext_sub,
    reqDoctor:reqDoctor,
    clinic:clinic,
    tb_lam_report:tb_lam_report,
    toxo_plasma:toxo_plasma,
    toxo_igG:toxo_igG,
    toxo_igm:toxo_igm,
    serum_cry_antigen:serum_cry_antigen,
    serum_cry_due:serum_cry_due,
    csf_cry_antigen:csf_cry_antigen,
    csf_due:csf_due,
    csf_smear:csf_smear,
    giemsa_stain_result:giemsa_stain_result,
    india_ink_result:india_ink_result,
    skin_smear:skin_smear,
    skin_giemsa_stain_result:skin_giemsa_stain_result,
    skin_india_ink_result:skin_india_ink_result,
    lymph_test:lymph_test,
    lymph_giemsa_stain:lymph_giemsa_stain,
    lymph_india_ink:lymph_india_ink,
    //type_sample:type_sample,
    //gram_stain_result:gram_stain_result,
    oi_lab_tech:oi_lab_tech,
    oi_issue_date:oi_issue_date,

    created_by:created_by,
  };

  if(cid.length >8 && oi_lab_tech.length > 2 && present == 1){
    if (confirm("Are you sure you want to do save?")) {
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
          }
        });
          $.ajax({
            type:'POST',
            url:"{{route('tests')}}",
            dataType:'json',
            //processData:false,
            contentType: 'application/json',
            data: JSON.stringify(oiData),
            //data: rprDataset,
            success:function(response){
              $("#printLogo").empty();
              $("#printPtInfo").empty();
              $("#printResultTable").empty();
              // $("#app").hide();
              // $("#hider0").hide();
              // $("#hider1").hide();
              // $("#save-update-print").hide();
              // $( "#toshowResult" ).removeClass( "print-dispaly" );


              if(reqDoctor.length < 1){
                reqDoctor= "__________";
              };

              if (lab_tech <1){
                lab_tech="_______";
              };

              if (rpr_issue_date  <1){
                rpr_issue_date ="_______";
              };

              if(fuchiaID.length < 1){
                fuchiaID = "__________"
              };

              if(Number.isNaN(agey))  {
                var ageys= "____";
              }else {
                var ageys=agey;
              };

              if(Number.isNaN(agem))  {
                var agems= "____";
              }else {
                var agems=agem;
              };

              var logo =
              "<div class='row'>"+
              "<div class='d-flex justify-content-center' >"+

              "<h4  class='print-header clearfix'>"+  "<img src='/logoMAM.jpg'  alt='logo' style='width:70px;height:70px;'>"+
              "<p class='hiv-p'>"+"OI Test Result"+"</p>"+"</h4>"+
              "</div>"+
              "</div>";
              var result_title=
              "<div class='d-flex justify-content-center print-coheader-list'>"+
              "<ul class='clearfix' style='width:84%;padding-left: 5%;'>"+
              "<li class='first-li'>"+"ID:"+"</li>"+"<li>"+cid+","+"</li>"+

              "<li class='first-li'>"+"Fuchia ID:"+"</li>"+"<li>"+fuchiaID+","+"</li>"+
              // "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
              "<li class='first-li'>"+"Date:"+"</li>"+"<li>"+vDate+","+"</li>"+
              // "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
              "<li class='first-li'>"+"Age(Y):"+"</li>"+"<li>"+ageys+","+"</li>"+
              // "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
              "<li class='first-li'>"+"Age(M):"+"</li>"+"<li>"+agems+","+"</li>"+
              // "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
              "<li class='first-li'>"+"Sex:"+"</li>"+"<li>"+gender+","+"</li>"+
              "</ul>"+

              "</div>";
              var result_footer=
              "<div class='print-hiv-footer'>"
              +"<ul class='clearfix print-sti-footer'>"+
              "<li class='first-li'>"
              +"Requested Doctor:"+"</li>"+"<li>"+reqDoctor+","+"</li>"
              // +
              // "<li class='first-li'>"
              // +"Counselor:"+"</li>"+"<li>"+rpr_counselor+","+"</li>"
              +
              // "Counselor ::"+counselor+
              "<li>"
              +"Issue by-:"+"</li>"+"<li>"+oi_lab_tech +","+"</li>"

              // "Issue by- "+lab_tech+
              +
              "<li>"
              +"Issue Date :"+"</li>"+"<li>"+oi_issue_date+","+"</li>"
              +
              // "Issue Date :"+issue_date+
              "</div>";

              var result_body = "<div class='d-flex justify-content-center' >"+"<table class='table  print-oi-table'>"+
              "<thead>"+
              "<tr>"+"<td>"+"NO."+"</td>"+"<td>"+"Test Name"+"</td>"+"<td>"+"Result"+"</td>"+"<td>"+"Dilution"+"</td>"+"</tr>"+
              "</thead>"+
              "<tbody>"+
              "<tr>"+"<td>"+"1."+"</td>"+"<td>"+"TB LAM"+"</td>"+"<td>"+"<p class='print-tr'id='oi_save1' style=''>"+tb_lam_report+"</p>"+"</td>"+"<td>"+"<p class='print-tr'id='oi_no_entry1' style=''>"+"-"+"</p>"+"</td>"+"</tr>"+

              "<tr>"+"<td>"+"2."+"</td>"+"<td>"+"Serum Cryptococcal Antigen"+"</td>"+"<td>"+"<p class='print-tr'id='oi_save2' style=''>"+serum_cry_antigen+"</p>"+"</td>"+"<td>"+"<p class='print-tr'id='oi_save12' style=''>"+serum_cry_due+"</p>"+"</td>"+"</tr>"+

              "<tr>"+"<td>"+"3."+"</td>"+"<td>"+"CSF for Cryptococcal Antigen"+"</td>"+"<td>"+"<p class='print-tr'id='oi_save3' style=''>"+csf_cry_antigen+"</p>"+"</td>"+"<td>"+"<p class='print-tr'id='oi_save13' style=''>"+csf_due+"</p>"+"</td>"+"</tr>"+

              // "<tr>"+"<td>"+"4."+"</td>"+"<td>"+"CSF Smear"+"</td>"+"<td>"+"<p class='print-tr'id='oi_save4' style=''>"+csf_smear+"</p>"+"</td>"+"<td>"+"<p class='print-tr'id='oi_no_entry2' style=''>"+"-"+"</p>"+"</td>"+"</tr>"+

              "<tr>"+"<td>"+"5."+"</td>"+"<td>"+"CSF Smear: Giemsa stain Result"+"</td>"+"<td>"+"<p class='print-tr'id='oi_save5' style=''>"+giemsa_stain_result+"</p>"+"</td>"+"<td>"+"<p class='print-tr'id='oi_no_entry3' style=''>"+"-"+"</p>"+"</td>"+"</tr>"+

              "<tr>"+"<td>"+"6."+"</td>"+"<td>"+"CSF Smear: India Ink Result"+"</td>"+"<td>"+"<p class='print-tr'id='oi_save6' style=''>"+india_ink_result+"</p>"+"</td>"+"<td>"+"<p class='print-tr'id='oi_no_entry4' style=''>"+"-"+"</p>"+"</td>"+"</tr>"+

              // "<tr>"+"<td>"+"7."+"</td>"+"<td>"+"Skin Smear"+"</td>"+"<td>"+"<p class='print-tr'id='oi_save7' style=''>"+skin_smear+"</p>"+"</td>"+"<td>"+"<p class='print-tr'id='oi_no_entry5' style=''>"+"-"+"</p>"+"</td>"+"</tr>"+

              "<tr>"+"<td>"+"8."+"</td>"+"<td>"+"Skin Smear: Giemsa stain Result"+"</td>"+"<td>"+"<p class='print-tr'id='oi_save8' style=''>"+skin_giemsa_stain_result+"</p>"+"</td>"+"<td>"+"<p class='print-tr'id='oi_no_entry6' style=''>"+"-"+"</p>"+"</td>"+"</tr>"+

              "<tr>"+"<td>"+"9."+"</td>"+"<td>"+"Skin Smear: India ink Result"+"</td>"+"<td>"+"<p class='print-tr'id='oi_save9' style=''>"+skin_india_ink_result+"</p>"+"</td>"+"<td>"+"<p class='print-tr'id='oi_no_entry7' style=''>"+"-"+"</p>"+"</td>"+"</tr>"+

              "<tr>"+"<td>"+"10."+"</td>"+"<td>"+"Lymph Nodes: Gimesa Stain Result"+"</td>"+"<td>"+"<p class='print-tr'id='oi_save10' style=''>"+lymph_giemsa_stain+"</p>"+"</td>"+"<td>"+"<p class='print-tr'id='oi_no_entry8' style=''>"+"-"+"</p>"+"</td>"+"</tr>"+

              "<tr>"+"<td>"+"11."+"</td>"+"<td>"+"Lymph Nodes: India Ink Result"+"</td>"+"<td>"+"<p class='print-tr'id='oi_save11' style=''>"+lymph_india_ink+"</p>"+"</td>"+"<td>"+"<p class='print-tr'id='oi_no_entry9' style=''>"+"-"+"</p>"+"</td>"+"</tr>"+

              //"<tr>"+"<td>"+"Type of Sample"+"</td>"+"<td>"+type_sample+"</td>"+"<td>"+""+"</td>"+"</tr>"+
              //"<tr>"+"<td>"+"Gram stain Result"+"</td>"+"<td>"+gram_stain_result+"</td>"+"<td>"+""+"</td>"+"</tr>"+

              "</tbody>"+
              "</table>" +"</div>";


              $("#printLogo").append(logo);

              $("#printPtInfo").append(result_title);

              $("#printResultTable").append(result_body+result_footer);

              $("#header_bar").hide();
              for(var i=0;i<=oi_save_id.length;i++)
              {
                var oi_data = oi_save_id[i];
                if(!$('#'+oi_data).text() || $('#'+oi_data).text()=="-")
                $('#'+oi_data).css('background-color','grey')
              }
              for(var i=0;i<=no_entry_id.length;i++)
              {
                var no_entry_data = no_entry_id[i];
                if(!$('#'+no_entry_data).text() || $('#'+no_entry_data).text()=="-")
                $('#'+no_entry_data).css('background-color','black')
              }
              $("#app").hide();
              $("#hider0").hide();
              $("#hider1").hide();
              $('#save-update-print').hide();
              //  $( "#toshowResult" ).removeClass( "print-dispaly" );
              $( "#toshowResult" ).show();
              window.print();
              var ckUpdater = response[0][0]['name'];
              if(ckUpdater == 'updated')
              {
                alert("We have updated the data");
              }
              else{
                alert("We have collected test information of the patient.");
              }
              $("#app").show();
              $("#hider0").show();
              $("#hider1").show();
              $("#hidden-title").show();
              $("#toshowResult").hide();
              $("#save-update-print").show();
              $("#header_bar").show();
              //location.reload(true);// to refresh the page

            }
          });
      }else{
        console.log("Cancel");
      }
  }else{
    // Validation to the ID
    setTimeout(function(){
      $("#noti_oi").show();
      document.getElementById('noti_oi').innerHTML="Please check the 'ID' or 'Results'.";
      document.getElementById('noti_oi').style="background-color:red;";
    },500);
    setTimeout(function(){
      document.getElementById('noti_oi').innerHTML="";
      $("#noti_oi").hide();

    },5000);
  }
}
function oiUpdate(){
  var updated_by = document.getElementById("navbarDropdown").innerHTML;

  var cid = document.getElementById("cid").value;
  var agey = document.getElementById("agey").value;
  var agem = document.getElementById("agem").value;
  var gender = document.getElementById("gender").value;
  var fuchiaID = document.getElementById("fuchiaID").value;
  var clinic = 81;
  var vDate = document.getElementById("vDate").value;
  vDate = formatDate(vDate); // date FormatChange YYYY/MM/DD
  var Ptype = document.getElementById("Ptype").value;
  var ext_sub = $("#ext").val();
  ////console.log(ext_sub);
  var reqDoctor = document.getElementById("md").value;
  agey = parseInt(agey);//changing to number
  agem = parseInt(agem);
  gender= String(gender);
  var tb_lam_report       = document.getElementById('tb_lam').value;

  var toxo_plasma       = document.getElementById('toxo_plasma').value;
  var toxo_igG       = document.getElementById('toxo_igG').value;
  var toxo_igm       = document.getElementById('toxo_igm').value;

  var serum_cry_antigen   = document.getElementById('serum_cry_antigen').value;
  var serum_cry_due       = document.getElementById('serum_cry_dil').value;
  var csf_cry_antigen     = document.getElementById('csf_cry_antigen').value;
  var csf_due             = document.getElementById('csf_dil').value;
  var csf_smear           = document.getElementById('csf_smear').value;
  var giemsa_stain_result = document.getElementById('giemsa_stain_result').value;
  var india_ink_result    = document.getElementById('india_ink_result').value;
  var skin_smear          = document.getElementById('skin_smear').value;
  var skin_giemsa_stain_result   = document.getElementById('skin_giemsa_stain_result').value;
  var skin_india_ink_result      = document.getElementById('skin_india_ink_result').value;
  var lymph_test = document.getElementById('lymph_test').value;
  var lymph_giemsa_stain = document.getElementById('lymph_giemsa_stain').value;
  var lymph_india_ink = document.getElementById('lymph_india_ink').value;
  //var type_sample   = document.getElementById('type_sample').value;
  //var gram_stain_result    = document.getElementById('gram_stain_result').value;
  var oi_lab_tech   = document.getElementById('oi_lab_tech').value;
  var oi_issue_date = document.getElementById('oi_issue_date').value;
  oi_issue_date = formatDate(oi_issue_date); // date FormatChange YYYY/MM/DD
  //var oi_visitID    = document.getElementById('').value;


  if(save_update_oi == 6){
    update_rowNo_oi= resp[5][0]['id'];
    var oiTest = 2;
    var appUser = document.getElementById("navbarDropdown").innerHTML;// to collect app user from application nav bar
    var org_info = 'RowID->'+resp[5][0]['id']
    +',FuchiaID->' +resp[5][0]["fuchiacode"]
    + ',GeneralID->' +resp[5][0]["CID"]
    + ',Age(year)->' +resp[5][0]["agey"]
    + ',Age(mo)->' +resp[5][0]["agem"]
    + ',Gender->' +resp[5][0]["Gender"]
    + ',Visit Date->' +resp[5][0]["visit_date"]
    + ',Risk->' +resp[5][0]['Type Of Patient']
    + ',Sub risk->' +resp[5][0]['Patient Type Sub']

    + ',TB_LAM_Report->' +resp[5][0]['TB_LAM_Report']

    + ',Toxo_plasma->' +resp[5][0]['TB_LAM_Report']
    + ',Toxo_igG->' +resp[5][0]['TB_LAM_Report']
    + ',Toxo_igM->' +resp[5][0]['TB_LAM_Report']

    + ',Serum Result->' +resp[5][0]['Serum Result']
    + ',Serum Pos->' +resp[5][0]['serum_pos']
    + ',CSF For Cryptococcal Antigen->' +resp[5][0]['CSF for Cryptococcal Antigen']
    + ',CSF crypto Pos->' +resp[5][0]['csf_crypto_pos']
    + ',CSF Fungal->' +resp[5][0]['csf_fungal']
    + ',CSF Smear Giemsa Stain->' +resp[5][0]['CSF Smear Giemsa Stain']
    + ',CSF Smear India Ink->' +resp[5][0]['CSF Smear India Ink']
    + ',Skin Fungal->' +resp[5][0]['skin_fungal']
    + ',Skin Smear Giemsa Stain->' +resp[5][0]['Skin Smear Giemsa Stain']
    + ',Other Smear->' +resp[5][0]['other_Smear']
    + ',Skin Smear India Ink->' +resp[5][0]['Skin Smear India Ink']
    + ',Sample Type->' +resp[5][0]['sample_type']
    + ',Other Gram->' +resp[5][0]['other_gram']
    + ',Lab Tech->' +resp[5][0]['Lab Techanician']
    + ',Issude Date->' +resp[5][0]['issued'];
    var updated_info =
    'FuchiaID->'+fuchiaID+
    ',Age(year)->'+agey+
    ',Age(mo)->'+agem+
    ',Gender->'+gender+
    ',Visit Date ->'+vDate+
    ',Risk->'+Ptype+
    ',Sub Risk->'+ext_sub+
    ',MD ->'+reqDoctor+
    ',Clinic->'+clinic+
    ',TB_Lam_report->'+tb_lam_report+
    ',toxo_plasma->'+toxo_plasma +
    ',toxo_igG->'+toxo_igG +
    ',toxo_igm->'+toxo_igm +
    ',Serum Cry antigen->'+serum_cry_antigen+
    ',Serum Cry due->'+serum_cry_due+
    ',CSF cry antigen->'+csf_cry_antigen+
    ',CSF due->'+csf_due+
    ',CSF Smear->'+csf_smear+
    ',Giemsa Stain Result->'+giemsa_stain_result+
    ',India Ink Result->'+india_ink_result+
    ',Skin Smear->'+skin_smear+
    ',Skin Giemsa Stain Result->'+skin_giemsa_stain_result+
    ',Skin India Ink Result->'+skin_india_ink_result+
    ',Lymph->'+lymph_test+
    ',Lymph_gimesa->'+lymph_giemsa_stain+
    ',Lymph_india->'+lymph_india_ink+
    //',Type Sample->'+type_sample+
    //',Gram Stain Result->'+gram_stain_result+
    ',Lab Tech->'+oi_lab_tech+
    ',Issue Date->'+oi_issue_date;
    var oiData={
      updated_info:updated_info,
      org_info:org_info,
      appUser:appUser,
      update_rowNo_oi:update_rowNo_oi,
      oiTest:oiTest,

      cid:cid,
      fuchiaID:fuchiaID,
      agey:agey,
      agem:agem,
      gender:gender,
      vDate:vDate,
      Ptype:Ptype,
      ext_sub:ext_sub,
      reqDoctor:reqDoctor,
      clinic:clinic,
      tb_lam_report:tb_lam_report,
      toxo_plasma:toxo_plasma,
      toxo_igG:toxo_igG,
      toxo_igm:toxo_igm,
      serum_cry_antigen:serum_cry_antigen,
      serum_cry_due:serum_cry_due,
      csf_cry_antigen:csf_cry_antigen,
      csf_due:csf_due,
      csf_smear:csf_smear,
      giemsa_stain_result:giemsa_stain_result,
      india_ink_result:india_ink_result,
      skin_smear:skin_smear,
      skin_giemsa_stain_result:skin_giemsa_stain_result,
      skin_india_ink_result:skin_india_ink_result,
      lymph_test:lymph_test,
      lymph_giemsa_stain:lymph_giemsa_stain,
      lymph_india_ink,
      //type_sample:type_sample,
      //gram_stain_result:gram_stain_result,
      oi_lab_tech:oi_lab_tech,
      oi_issue_date:oi_issue_date,

      updated_by:updated_by,
    };
  }
  if(cid.length >8 && oi_lab_tech.length>2){
    if (confirm("Are you sure you want to do save?")) {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
      }
    });
    $.ajax({
      type:'POST',
      url:"{{route('tests')}}",
      dataType:'json',
      //processData:false,
      contentType: 'application/json',
      data: JSON.stringify(oiData),
      //data: rprDataset,
      success:function(response){
        $("#printLogo").empty();
        $("#printPtInfo").empty();
        $("#printResultTable").empty();
        $("#app").hide();
        $("#hider0").hide();
        $("#hider1").hide();
        $("#save-update-print").hide();
        $( "#toshowResult" ).removeClass( "print-dispaly" );
        if(reqDoctor.length < 1){
          reqDoctor= "__________";
        };
        if (lab_tech <1){
          lab_tech="_______";
        };
        if (rpr_issue_date  <1){
          rpr_issue_date ="_______";
        };
        if(fuchiaID.length < 1){
          fuchiaID = "__________"
        };
        if(Number.isNaN(agey))  {
          var ageys= "____";
        }else {
          var ageys=agey;
        };

        if(Number.isNaN(agem))  {
          var agems= "____";
        }else {
          var agems=agem;
        };
        var logo =
        "<div class='row'>"+
        "<div class='d-flex justify-content-center' >"+
        "<h4  class='print-header clearfix'>"+  "<img src='/logoMAM.jpg'  alt='logo' style='width:70px;height:70px;'>"+
        "<p class='hiv-p'>"+"OI Test Result (Updated)"+"</p>"+"</h4>"+
        "</div>"+
        "</div>";
        var result_title=
        "<div class='d-flex justify-content-center print-coheader-list'>"+
        "<ul class='clearfix' style='width:84%;padding-left: 5%;'>"+
        "<li class='first-li'>"+"ID:"+"</li>"+"<li>"+cid+","+"</li>"+
        "<li class='first-li'>"+"Fuchia ID:"+"</li>"+"<li>"+fuchiaID+","+"</li>"+
        "<li class='first-li'>"+"Date:"+"</li>"+"<li>"+vDate+","+"</li>"+
        "<li class='first-li'>"+"Age(Y):"+"</li>"+"<li>"+ageys+","+"</li>"+
        "<li class='first-li'>"+"Age(M):"+"</li>"+"<li>"+agems+","+"</li>"+
        "<li class='first-li'>"+"Sex:"+"</li>"+"<li>"+gender+","+"</li>"+
        "</ul>"+

        "</div>";
        var result_footer=
        "<div class='print-hiv-footer'>"
        +"<ul class='clearfix print-sti-footer'>"+
        "<li class='first-li'>"
        +"Requested Doctor:"+"</li>"+"<li>"+reqDoctor+","+"</li>"
        +
        "<li>"
        +"Issue by-:"+"</li>"+"<li>"+oi_lab_tech +","+"</li>"

        +
        "<li>"
        +"Issue Date :"+"</li>"+"<li>"+oi_issue_date+","+"</li>"
        +

        "</div>";
        var result_body = "<div class='d-flex justify-content-center' >"+"<table class='table  print-oi-table'>"+
        "<thead>"+
        "<tr>"+"<td>"+"NO."+"</td>"+"<td>"+"Test Name"+"</td>"+"<td>"+"Result"+"</td>"+"<td>"+"Dilution"+"</td>"+"</tr>"+
        "</thead>"+
        "<tbody>"+
        "<tr>"+"<td>"+"1."+"</td>"+"<td>"+"TB LAM"+"</td>"+"<td>"+"<p class='print-tr'id='oi_save1' style=''>"+tb_lam_report+"</p>"+"</td>"+"<td>"+"<p class='print-tr'id='oi_no_entry1' style=''>"+"-"+"</p>"+"</td>"+"</tr>"+

        "<tr>"+"<td>"+"2."+"</td>"+"<td>"+"Serum Cryptococcal Antigen"+"</td>"+"<td>"+"<p class='print-tr'id='oi_save2' style=''>"+serum_cry_antigen+"</p>"+"</td>"+"<td>"+"<p class='print-tr'id='oi_save12' style=''>"+serum_cry_due+"</p>"+"</td>"+"</tr>"+

        "<tr>"+"<td>"+"3."+"</td>"+"<td>"+"CSF for Cryptococcal Antigen"+"</td>"+"<td>"+"<p class='print-tr'id='oi_save3' style=''>"+csf_cry_antigen+"</p>"+"</td>"+"<td>"+"<p class='print-tr'id='oi_save13' style=''>"+csf_due+"</p>"+"</td>"+"</tr>"+

        // "<tr>"+"<td>"+"4."+"</td>"+"<td>"+"CSF Smear"+"</td>"+"<td>"+"<p class='print-tr'id='oi_save4' style=''>"+csf_smear+"</p>"+"</td>"+"<td>"+"<p class='print-tr'id='oi_no_entry2' style=''>"+"-"+"</p>"+"</td>"+"</tr>"+

        "<tr>"+"<td>"+"5."+"</td>"+"<td>"+"CSF Smear: Giemsa stain Result"+"</td>"+"<td>"+"<p class='print-tr'id='oi_save5' style=''>"+giemsa_stain_result+"</p>"+"</td>"+"<td>"+"<p class='print-tr'id='oi_no_entry3' style=''>"+"-"+"</p>"+"</td>"+"</tr>"+

        "<tr>"+"<td>"+"6."+"</td>"+"<td>"+"CSF Smear: India Ink Result"+"</td>"+"<td>"+"<p class='print-tr'id='oi_save6' style=''>"+india_ink_result+"</p>"+"</td>"+"<td>"+"<p class='print-tr'id='oi_no_entry4' style=''>"+"-"+"</p>"+"</td>"+"</tr>"+

        // "<tr>"+"<td>"+"7."+"</td>"+"<td>"+"Skin Smear"+"</td>"+"<td>"+"<p class='print-tr'id='oi_save7' style=''>"+skin_smear+"</p>"+"</td>"+"<td>"+"<p class='print-tr'id='oi_no_entry5' style=''>"+"-"+"</p>"+"</td>"+"</tr>"+

        "<tr>"+"<td>"+"8."+"</td>"+"<td>"+"Skin Smear: Giemsa stain Result"+"</td>"+"<td>"+"<p class='print-tr'id='oi_save8' style=''>"+skin_giemsa_stain_result+"</p>"+"</td>"+"<td>"+"<p class='print-tr'id='oi_no_entry6' style=''>"+"-"+"</p>"+"</td>"+"</tr>"+

        "<tr>"+"<td>"+"9."+"</td>"+"<td>"+"Skin Smear: India ink Result"+"</td>"+"<td>"+"<p class='print-tr'id='oi_save9' style=''>"+skin_india_ink_result+"</p>"+"</td>"+"<td>"+"<p class='print-tr'id='oi_no_entry7' style=''>"+"-"+"</p>"+"</td>"+"</tr>"+

        "<tr>"+"<td>"+"10."+"</td>"+"<td>"+"Lymph Nodes: Gimesa Stain Result"+"</td>"+"<td>"+"<p class='print-tr'id='oi_save10' style=''>"+lymph_giemsa_stain+"</p>"+"</td>"+"<td>"+"<p class='print-tr'id='oi_no_entry8' style=''>"+"-"+"</p>"+"</td>"+"</tr>"+

        "<tr>"+"<td>"+"11."+"</td>"+"<td>"+"Lymph Nodes: India Ink Result"+"</td>"+"<td>"+"<p class='print-tr'id='oi_save11' style=''>"+lymph_india_ink+"</p>"+"</td>"+"<td>"+"<p class='print-tr'id='oi_no_entry9' style=''>"+"-"+"</p>"+"</td>"+"</tr>"+

        //"<tr>"+"<td>"+"Type of Sample"+"</td>"+"<td>"+type_sample+"</td>"+"<td>"+""+"</td>"+"</tr>"+
        //"<tr>"+"<td>"+"Gram stain Result"+"</td>"+"<td>"+gram_stain_result+"</td>"+"<td>"+""+"</td>"+"</tr>"+

        "</tbody>"+
        "</table>" +"</div>";


        $("#printLogo").append(logo);

        $("#printPtInfo").append(result_title);

        $("#printResultTable").append(result_body+result_footer);

        $("#header_bar").hide();
        var oi_save_id=[];
        for(var i=1;i<31;i++){
          oi_save_id[i]='oi_save'+i;

        }
        var no_entry_id=[];
        for(var i=1;i<16;i++){
          no_entry_id[i]='oi_no_entry'+i;

        }

        for(var i=0;i<=oi_save_id.length;i++)
        {
          var oi_data = oi_save_id[i];
          if(!$('#'+oi_data).text() || $('#'+oi_data).text()=="-")
          $('#'+oi_data).css('background-color','grey')
        }
        for(var i=0;i<=no_entry_id.length;i++)
        {
          var no_entry_data = no_entry_id[i];
          if(!$('#'+no_entry_data).text() || $('#'+no_entry_data).text()=="-")
          $('#'+no_entry_data).css('background-color','black')
        }

        $("#app").hide();
        $("#hider0").hide();
        $("#hider1").hide();
        $("#hidden-title").hide();
        $("#header_bar").hide();
        $("#save-update-print").hide();


        $("#toshowResult").show();
        window.print();
        var ckUpdater = response[0][0]['name'];
        if(ckUpdater == 'updated')
        {
          alert("We have updated the data");
        }
        else{
          alert("We have collected test information of the patient.");
        }
        $("#app").show();
        $("#hider0").show();
        $("#hider1").show();
        $("#hidden-title").show();
        $("#header_bar").show();
        $("#save-update-print").show();

        $("#toshowResult").hide();
      }
    });
    }else{
      console.log("Cancel");
    }
  }else{
    // Validation to the ID
    setTimeout(function(){
      $("#noti_oi").show();
      document.getElementById('noti_oi').innerHTML="Please check the 'ID' or 'Results'.";
      document.getElementById('noti_oi').style="background-color:red;";
    },500);
    setTimeout(function(){
      document.getElementById('noti_oi').innerHTML="";
      $("#noti_oi").hide();

    },5000);
  }
}
//******************************************************
function afb_save(){
  var afbTest = 1;

  var cid = document.getElementById("cid").value;
  var created_by = document.getElementById("navbarDropdown").innerHTML;
  var agey = $("#agey").text();
  var agem = $("#agem").text
  agey = parseInt(agey);//changing to number
  agem = parseInt(agem);
  if(isNaN(agey)){
    agey=0;
  }
  if(isNaN(agem)){
    agem=0;
  }
  var gender = $("#gender").text();
  gender= String(gender);
  var fuchiaID = document.getElementById("fuchiaID").value;
  // var clinic = document.getElementById("clinic").innerHTML;
  var clinic = 81;
  var vDate = document.getElementById("vDate").value;
  vDate = formatDate(vDate); // date FormatChange YYYY/MM/DD
  var Ptype = $("#Ptype").text();
  var ext_sub = $("#ext").text();
  if(ext_sub.length<33){// the blank response from text count is 32
    ext_sub ="-";
  }
  var reqDoctor = document.getElementById("md").value;
  var afb_pt_name         = document.getElementById('afb_pt_name').innerHTML;
  var afb_pt_address      = document.getElementById('afb_pt_address').innerHTML;
  var Previous_TB         = document.getElementById('Previous_TB').value;
  var HIV_status          = document.getElementById('HIV_status').value;
  var reason_for_exam     = document.getElementById('reason_for_exam').value;
  var afb_Pt_type         = document.getElementById('afb_Pt_type').value;
  var follow_up_mt        = document.getElementById('follow_up_mt').value;
  var speci_type          = document.getElementById('speci_type').value;
  var slide_num_1         = document.getElementById('slide_num_1').value;
  var slide_num_2         = document.getElementById('slide_num_2').value;
  var speci_receive_dt1   = document.getElementById('speci_receive_dt1').value;
  speci_receive_dt1 = formatDate(speci_receive_dt1); // date FormatChange YYYY/MM/DD
  var speci_receive_dt2   = document.getElementById('speci_receive_dt2').value;
  speci_receive_dt2 = formatDate(speci_receive_dt2); // date FormatChange YYYY/MM/DD
  var visual_app_1        = document.getElementById('visual_app_1').value;
  var visual_app_2        = document.getElementById('visual_app_2').value;
  var afb_result1         = document.getElementById('afb_result1').value;
  var afb_result2         = document.getElementById('afb_result2').value;
  var sacnty_grading1     = document.getElementById('sacnty_grading1').value;
  var sacnty_grading2     = document.getElementById('sacnty_grading2').value;
  var afb_lab_tech      = document.getElementById('afb_lab_tech').value;
  var afb_issue_date      = document.getElementById('afb_issue_date').value;
  afb_issue_date = formatDate(afb_issue_date); // date FormatChange YYYY/MM/DD

  var afbData={
    afbTest             :afbTest,
    cid                 :cid,
    fuchiaID            :fuchiaID,
    agey                :agey,
    agem                :agem,
    gender              :gender,
    vDate               :vDate,
    Ptype               :Ptype,
    ext_sub             :ext_sub,
    reqDoctor           :reqDoctor,
    clinic              :clinic,
    afb_pt_name        :afb_pt_name,
    afb_pt_address     :afb_pt_address,
    Previous_TB        :Previous_TB,
    HIV_status         :HIV_status,
    reason_for_exam    :reason_for_exam,
    afb_Pt_type        :afb_Pt_type,
    follow_up_mt       :follow_up_mt,
    speci_type         :speci_type,
    slide_num_1        :slide_num_1,
    slide_num_2        :slide_num_2,
    speci_receive_dt1  :speci_receive_dt1,
    speci_receive_dt2  :speci_receive_dt2,
    visual_app_1       :visual_app_1,
    visual_app_2       :visual_app_2,
    afb_result1        :afb_result1,
    afb_result2        :afb_result2,
    sacnty_grading1    :sacnty_grading1,
    sacnty_grading2    :sacnty_grading2,
    afb_lab_tech       :afb_lab_tech,
    afb_issue_date     :afb_issue_date,

    created_by:created_by,
  };
  if(cid.length>8 && afb_lab_tech.length>2 && present==1){
    if (confirm("Are you sure you want to do save?")) {
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
          }
        });
        $.ajax({
          type:'POST',
          url:"{{route('tests')}}",
          dataType:'json',
          //processData:false,
          contentType: 'application/json',
          data: JSON.stringify(afbData),
          //data: rprDataset,
          success:function(response){
            $("#printLogo").empty();
            $("#printPtInfo").empty();
            $("#printResultTable").empty();
            // $("#app").hide();
            //  $("#hider0").hide();
            //  $("#hider1").hide();
            //  $("#save-update-print").hide();
            //  $( "#toshowResult" ).removeClass( "print-dispaly" );
            if(reqDoctor.length<1){
              reqDoctor= "__________";
            };

            if ( afb_lab_tech   <1){
              afb_issue_date ="_______";
            };

            if (afb_issue_date <1){
              afb_issue_date="_______";
            };

            if(fuchiaID.length < 1){
              fuchiaID = "__________"
            };

            if(Number.isNaN(agey))  {
              var ageys= "____";
            }else {
              var ageys=agey;
            };

            if(Number.isNaN(agem))  {
              var agems= "____";
            }else {
              var agems=agem;
            };
            var logo =
            "<div class='row'>"+
            "<div class='d-flex justify-content-center' >"+

            "<h4  class='print-header clearfix'>"+  "<img src='/logoMAM.jpg'  alt='logo' style='width:70px;height:70px;'>"+
            "<p class='hiv-p'>"+"AFB Test Result"+"</p>"+"</h4>"+
            "</div>"+
            "</div>";
            var result_title=
            "<div class='d-flex justify-content-center print-coheader-list'>"+
            "<ul class='clearfix' style='width:84%;padding-left: 5%;'>"+
            "<li class='first-li'>"+"ID:"+"</li>"+"<li>"+cid+","+"</li>"+

            "<li class='first-li'>"+"Fuchia ID:"+"</li>"+"<li>"+fuchiaID+","+"</li>"+
            // "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
            "<li class='first-li'>"+"Date:"+"</li>"+"<li>"+vDate+","+"</li>"+
            // "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
            "<li class='first-li'>"+"Age(Y):"+"</li>"+"<li>"+ageys+","+"</li>"+
            // "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
            "<li class='first-li'>"+"Age(M):"+"</li>"+"<li>"+agems+","+"</li>"+
            // "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
            "<li class='first-li'>"+"Sex:"+"</li>"+"<li>"+gender+","+"</li>"+
            "</ul>"+

            "</div>";
            var result_footer=
            "<div class='print-hiv-footer'>"
            +"<ul class='clearfix print-sti-footer'>"+
            "<li class='first-li'>"
            +"Requested Doctor:"+"</li>"+"<li>"+reqDoctor+","+"</li>"
            // +
            // "<li class='first-li'>"
            // +"Counselor:"+"</li>"+"<li>"+rpr_counselor+","+"</li>"
            +
            // "Counselor ::"+counselor+
            "<li>"
            +"Issue by-:"+"</li>"+"<li>"+afb_lab_tech+","+"</li>"

            // "Issue by- "+lab_tech+
            +
            "<li>"
            +"Issue Date :"+"</li>"+"<li>"+afb_issue_date+","+"</li>"
            +
            // "Issue Date :"+issue_date+
            "</div>";

            var result_body = "<div class='d-flex justify-content-center' >"+"<table class='table  print-hiv-table'>"+ //+"Test Name"+"</td>"

            "<thead>"+
            "<tr>" +"<td>"+"NO."+"</td>"+"<td>"+"Test Name"+"</td>"+"<td>"+"Sample (1) Result"+"</td>"+"<td>"+"Sample (2) Result"+"</td>"+"</tr>"+
            "</thead>"+
            "<tbody>"+

            "<tr>" +"<td>"+"1."+"</td>"+"<td>"+"Slide Number"+"</td>"+"<td>"+"<p class='print-tr'id='afb_save1' style=''>"+slide_num_1+"</p>"+"</td>"+"<td>"+"<p class='print-tr'id='afb_save2' style=''>"+slide_num_2+"</p>"+"</td>"+"</tr>"+
            "<tr>" +"<td>"+"2."+"</td>"+"<td>"+"Specimen received date"+"</td>"+"<td>"+"<p class='print-tr'id='afb_save3' style=''>"+speci_receive_dt1+"</p>"+"</td>"+"<td>"+"<p class='print-tr'id='afb_save4' style=''>"+speci_receive_dt2+"</p>"+"</td>"+"</tr>"+
            "<tr>"+"<td>"+"3."+"</td>"+"<td>"+"Visual Appearance"+"</td>"+"<td>"+"<p class='print-tr'id='afb_save5' style=''>"+visual_app_1+"</p>"+"</td>"+"<td>"+"<p class='print-tr'id='afb_save6' style=''>"+visual_app_2+"</p>"+"</td>"+"</tr>"+
            "<tr>"+"<td>"+"4."+"</td>"+"<td style='font-weight:900'>"+"AFB Result"+"</td>"+"<td style='font-weight:900'>"+"<p class='print-tr'id='afb_save7' style=''>"+afb_result1+"</p>" +"</td>"+"<td style='font-weight:900'>"+"<p class='print-tr'id='afb_save8' style=''>"+afb_result2+"</p>"+"</td>"+"</tr>"+
            "<tr>"+"<td>"+"5."+"</td>"+"<td>"+"Scanty Grading"+"</td>"+"<td>"+"<p class='print-tr'id='afb_save9' style=''>"+sacnty_grading1+"</p>"+"</td>"+"<td>"+"<p class='print-tr'id='afb_save10' style=''>"+sacnty_grading2+"</p>"+"</td>"+"</tr>"+
            "</tbody>"+
            "</table>" +"</div>"+"</div>";

            $("#printLogo").append(logo);

            $("#printPtInfo").append(result_title);

            $("#printResultTable").append(result_body+result_footer);

            $("#header_bar").hide();

            var afb_save_id=[];
            for(var i=1;i<11;i++){
              afb_save_id[i]='afb_save'+i;

            }

            for(var i=0;i<=afb_save_id.length;i++)
            {
              var afb_data = afb_save_id[i];
              if(!$('#'+afb_data).text() || $('#'+afb_data).text()=="-"||$('#'+afb_data).text()=="0"){
                $('#'+afb_data).css('background-color','grey')

              }

            }
            $("#app").hide();
            $("#hider0").hide();
            $("#hider1").hide();
            $('#save-update-print').hide();
            //  $( "#toshowResult" ).removeClass( "print-dispaly" );
            $( "#toshowResult" ).show();
            window.print();
            var ckUpdater = response[0][0]['name'];
            if(ckUpdater == 'updated')
            {
              alert("We have updated the data");
            }
            else{
              alert("We have collected test information of the patient.");
            }
            $("#app").show();
            $("#hider0").show();
            $("#hider1").show();
            $("#hidden-title").show();
            $("#toshowResult").hide();
            $("#save-update-print").show();
            $("#header_bar").show();
            //location.reload(true);// to refresh the page

          }
        });
      }else{
        console.log("Cancel");
      }
  }else{
    // Validation to the ID
    setTimeout(function(){
      $("#noti_afb").show();
      document.getElementById('noti_afb').innerHTML="Please check the 'ID' or 'Results'.";
      document.getElementById('noti_afb').style="background-color:red;";
    },500);
    setTimeout(function(){
      document.getElementById('noti_afb').innerHTML="";
      $("#noti_afb").hide();

    },5000);
  }
}
function afbUpdate(){
  var updated_by = document.getElementById("navbarDropdown").innerHTML;

  var cid = document.getElementById("cid").value;
  var agey = $("#agey").text();
  var agem = $("#agem").text
  agey = parseInt(agey);//changing to number
  agem = parseInt(agem);
  if(isNaN(agey)){
    agey=0;
  }
  if(isNaN(agem)){
    agem=0;
  }
  var gender = $("#gender").text();
  gender= String(gender);
  var fuchiaID = document.getElementById("fuchiaID").value;
  // var clinic = document.getElementById("clinic").innerHTML;
  var clinic = 81;
  var vDate = document.getElementById("vDate").value;
  vDate = formatDate(vDate); // date FormatChange YYYY/MM/DD
  var Ptype = $("#Ptype").text();
  var ext_sub = $("#ext").text();
  if(ext_sub.length<33){// the blank response from text count is 32
    ext_sub ="-";
  }
  var reqDoctor = document.getElementById("md").value;
  var afb_pt_name         = document.getElementById('afb_pt_name').innerHTML;
  var afb_pt_address      = document.getElementById('afb_pt_address').innerHTML;

  var Previous_TB         = document.getElementById('Previous_TB').value;
  var HIV_status          = document.getElementById('HIV_status').value;
  var reason_for_exam     = document.getElementById('reason_for_exam').value;
  var afb_Pt_type         = document.getElementById('afb_Pt_type').value;
  var follow_up_mt        = document.getElementById('follow_up_mt').value;
  var speci_type          = document.getElementById('speci_type').value;
  var slide_num_1         = document.getElementById('slide_num_1').value;
  var slide_num_2         = document.getElementById('slide_num_2').value;
  var speci_receive_dt1   = document.getElementById('speci_receive_dt1').value;
  speci_receive_dt1 = formatDate(speci_receive_dt1); // date FormatChange YYYY/MM/DD
  var speci_receive_dt2   = document.getElementById('speci_receive_dt2').value;
  speci_receive_dt2 = formatDate(speci_receive_dt2); // date FormatChange YYYY/MM/DD
  var visual_app_1        = document.getElementById('visual_app_1').value;
  var visual_app_2        = document.getElementById('visual_app_2').value;
  var afb_result1         = document.getElementById('afb_result1').value;
  var afb_result2         = document.getElementById('afb_result2').value;
  var sacnty_grading1     = document.getElementById('sacnty_grading1').value;
  var sacnty_grading2     = document.getElementById('sacnty_grading2').value;
  var afb_lab_tech      = document.getElementById('afb_lab_tech').value;
  var afb_issue_date      = document.getElementById('afb_issue_date').value;
  afb_issue_date = formatDate(afb_issue_date); // date FormatChange YYYY/MM/DD
  if(!slide_num_2)
  {
    slide_num_2="0";
  };
  if(save_update_afb == 9){
    var afbTest = 2;

    update_rowNo_afb= resp[8][0]['id'];
    var appUser = document.getElementById("navbarDropdown").innerHTML;// to collect app user from application nav bar
    var org_info = 'RowID->'+resp[8][0]['id']
    +',FuchiaID->' +resp[8][0]["fuchiacode"]
    + ',GeneralID->' +resp[8][0]["CID"]
    + ',Age(year)->' +resp[8][0]["agey"]
    + ',Age(mo)->' +resp[8][0]["agem"]
    + ',Gender->' +resp[8][0]["Gender"]
    + ',Visit Date->' +resp[8][0]["visit_date"]
    + ',Risk->' +resp[8][0]['Patient Type']
    + ',Sub risk->' +resp[8][0]['Patient Type Sub']
    + ',Requested Dr  ->' +resp[8][0]['Requested Doctor']

    +', afb_pt_name         ->' + resp[8][0]['afb_pt_name']
    +', afb_pt_address      ->' + resp[8][0]['afb_pt_address']
    +', Previous_TB         ->' + resp[8][0]['Previous_TB']
    +', HIV_status          ->' + resp[8][0]['HIV_status']
    +', reason_for_exam     ->' + resp[8][0]['reason_for_exam']
    +', afb_Pt_type         ->' + resp[8][0]['afb_Pt_type']
    +', follow_up_mt        ->' + resp[8][0]['follow_up_mt']
    +', speci_type          ->' + resp[8][0]['speci_type']
    +', slide_num_1         ->' + resp[8][0]['slide_num_1']
    +', slide_num_2         ->' + resp[8][0]['slide_num_2']
    +', speci_receive_dt1   ->' + resp[8][0]['speci_receive_dt1']
    +', speci_receive_dt2   ->' + resp[8][0]['speci_receive_dt2']
    +', visual_app_1        ->' + resp[8][0]['visual_app_1']
    +', visual_app_2        ->' + resp[8][0]['visual_app_2']
    +', afb_result1         ->' + resp[8][0]['afb_result1']
    +', afb_result2         ->' + resp[8][0]['afb_result2']
    +', sacnty_grading1     ->' + resp[8][0]['slide1_grading1']
    +', sacnty_grading2     ->' + resp[8][0]['slide2_grading2']
    +', afb_lab_tech      ->' + resp[8][0]['afb_lab_techca']
    +', afb_issue_date      ->' + resp[8][0]['afb_issue_date'];


    var updated_info ='FuchiaID->'+fuchiaID
    +',Age(year)->'+agey
    +',Age(mo)->'+agem
    +',Gender->'+gender
    +',Visit Date ->'+vDate
    +',Risk->'+Ptype
    +',Sub Risk->'+ext_sub
    +',MD ->'+reqDoctor
    +',Clinic->'+clinic
    +', Afb_pt_name ->'+afb_pt_name
    +', Afb_pt_address ->'+afb_pt_address
    +', Previous_TB ->'+Previous_TB
    +', HIV_status ->'+HIV_status
    +', Reason_for_exam ->'+reason_for_exam
    +', Afb_Pt_type ->'+afb_Pt_type
    +', Follow_up_mt ->'+follow_up_mt
    +', speci_type ->'+speci_type
    +', slide_num_1 ->'+slide_num_1
    +', slide_num_2 ->'+slide_num_2
    +', speci_receive_dt1 ->'+speci_receive_dt1
    +', speci_receive_dt2 ->'+speci_receive_dt2
    +', visual_app_1 ->'+visual_app_1
    +', visual_app_2 ->'+visual_app_2
    +', afb_result1 ->'+afb_result1
    +', afb_result2 ->'+afb_result2
    +', sacnty_grading1 ->'+sacnty_grading1
    +', sacnty_grading2 ->'+sacnty_grading2
    +', afb_lab_tech ->'+afb_lab_tech
    +', afb_issue_date ->'+afb_issue_date ;

    var afbData={
      updated_info        :updated_info,
      org_info            :org_info,
      appUser             :appUser,
      update_rowNo_afb    :update_rowNo_afb,
      afbTest             :afbTest,

      cid                 :cid,
      fuchiaID            :fuchiaID,
      agey                :agey,
      agem                :agem,
      gender              :gender,
      vDate               :vDate,
      Ptype               :Ptype,
      ext_sub             :ext_sub,
      reqDoctor           :reqDoctor,
      clinic              :clinic,
      afb_pt_name        :afb_pt_name,
      afb_pt_address     :afb_pt_address,
      Previous_TB        :Previous_TB,
      HIV_status         :HIV_status,
      reason_for_exam    :reason_for_exam,
      afb_Pt_type        :afb_Pt_type,
      follow_up_mt       :follow_up_mt,
      speci_type         :speci_type,
      slide_num_1        :slide_num_1,
      slide_num_2        :slide_num_2,
      speci_receive_dt1  :speci_receive_dt1,
      speci_receive_dt2  :speci_receive_dt2,
      visual_app_1       :visual_app_1,
      visual_app_2       :visual_app_2,
      afb_result1        :afb_result1,
      afb_result2        :afb_result2,
      sacnty_grading1    :sacnty_grading1,
      sacnty_grading2    :sacnty_grading2,
      afb_lab_tech       :afb_lab_tech,
      afb_issue_date     :afb_issue_date,

      updated_by          :updated_by,
    };

  }
  if(cid.length>8){
    if (confirm("Are you sure you want to do save?")) {
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
          }
        });
        $.ajax({
          type:'POST',
          url:"{{route('tests')}}",
          dataType:'json',
          //processData:false,
          contentType: 'application/json',
          data: JSON.stringify(afbData),
          //data: rprDataset,
          success:function(response){
            $("#printLogo").empty();
            $("#printPtInfo").empty();
            $("#printResultTable").empty();
            $("#app").hide();
            $("#hider0").hide();
            $("#hider1").hide();
            $("#save-update-print").hide();
            $( "#toshowResult" ).removeClass( "print-dispaly" );
            if(reqDoctor.length<1){
              reqDoctor= "__________";
            };

            if ( afb_lab_tech   <1){
              afb_issue_date ="_______";
            };

            if (afb_issue_date <1){
              afb_issue_date="_______";
            };

            if(fuchiaID.length < 1){
              fuchiaID = "__________"
            };

            if(Number.isNaN(agey))  {
              var ageys= "____";
            }else {
              var ageys=agey;
            };

            if(Number.isNaN(agem))  {
              var agems= "____";
            }else {
              var agems=agem;
            };
            if(!slide_num_2){

              slide_num_2="0";
            };



            var logo =
            "<div class='row'>"+
            "<div class='d-flex justify-content-center' >"+

            "<h4  class='print-header clearfix'>"+  "<img src='/logoMAM.jpg'  alt='logo' style='width:70px;height:70px;'>"+
            "<p class='hiv-p'>"+"AFB Test Result (Updated)"+"</p>"+"</h4>"+
            "</div>"+
            "</div>";
            var result_title=
            "<div class='d-flex justify-content-center print-coheader-list'>"+
            "<ul class='clearfix' style='width:84%;padding-left: 5%;'>"+
            "<li class='first-li'>"+"ID:"+"</li>"+"<li>"+cid+","+"</li>"+

            "<li class='first-li'>"+"Fuchia ID:"+"</li>"+"<li>"+fuchiaID+","+"</li>"+
            // "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
            "<li class='first-li'>"+"Date:"+"</li>"+"<li>"+vDate+","+"</li>"+
            // "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
            "<li class='first-li'>"+"Age(Y):"+"</li>"+"<li>"+ageys+","+"</li>"+
            // "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
            "<li class='first-li'>"+"Age(M):"+"</li>"+"<li>"+agems+","+"</li>"+
            // "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
            "<li class='first-li'>"+"Sex:"+"</li>"+"<li>"+gender+","+"</li>"+
            "</ul>"+

            "</div>";
            var result_footer=
            "<div class='print-hiv-footer'>"
            +"<ul class='clearfix print-sti-footer'>"+
            "<li class='first-li'>"
            +"Requested Doctor:"+"</li>"+"<li>"+reqDoctor+","+"</li>"
            // +
            // "<li class='first-li'>"
            // +"Counselor:"+"</li>"+"<li>"+rpr_counselor+","+"</li>"
            +
            // "Counselor ::"+counselor+
            "<li>"
            +"Issue by-:"+"</li>"+"<li>"+afb_lab_tech+","+"</li>"

            // "Issue by- "+lab_tech+
            +
            "<li>"
            +"Issue Date :"+"</li>"+"<li>"+afb_issue_date+","+"</li>"
            +
            // "Issue Date :"+issue_date+
            "</div>";
            var result_body = "<div class='d-flex justify-content-center' >"+"<table class='table  print-hiv-table'>"+ //+"Test Name"+"</td>"

            "<thead>"+
            "<tr>" +"<td>"+"NO."+"</td>"+"<td>"+"Test Name"+"</td>"+"<td>"+"Sample (1) Result"+"</td>"+"<td>"+"Sample (2) Result"+"</td>"+"</tr>"+
            "</thead>"+
            "<tbody>"+

            "<tr>" +"<td>"+"1."+"</td>"+"<td>"+"Slide Number"+"</td>"+"<td>"+"<p class='print-tr'id='afb_save1' style=''>"+slide_num_1+"</p>"+"</td>"+"<td>"+"<p class='print-tr'id='afb_save2' style=''>"+slide_num_2+"</p>"+"</td>"+"</tr>"+
            "<tr>" +"<td>"+"2."+"</td>"+"<td>"+"Specimen received date"+"</td>"+"<td>"+"<p class='print-tr'id='afb_save3' style=''>"+speci_receive_dt1+"</p>"+"</td>"+"<td>"+"<p class='print-tr'id='afb_save4' style=''>"+speci_receive_dt2+"</p>"+"</td>"+"</tr>"+
            "<tr>"+"<td>"+"3."+"</td>"+"<td>"+"Visual Appearance"+"</td>"+"<td>"+"<p class='print-tr'id='afb_save5' style=''>"+visual_app_1+"</p>"+"</td>"+"<td>"+"<p class='print-tr'id='afb_save6' style=''>"+visual_app_2+"</p>"+"</td>"+"</tr>"+
            "<tr>"+"<td>"+"4."+"</td>"+"<td style='font-weight:900'>"+"AFB Result"+"</td>"+"<td style='font-weight:900'>"+"<p class='print-tr'id='afb_save7' style=''>"+afb_result1+"</p>" +"</td>"+"<td style='font-weight:900'>"+"<p class='print-tr'id='afb_save8' style=''>"+afb_result2+"</p>"+"</td>"+"</tr>"+
            "<tr>"+"<td>"+"5."+"</td>"+"<td>"+"Scanty Grading"+"</td>"+"<td>"+"<p class='print-tr'id='afb_save9' style=''>"+sacnty_grading1+"</p>"+"</td>"+"<td>"+"<p class='print-tr'id='afb_save10' style=''>"+sacnty_grading2+"</p>"+"</td>"+"</tr>"+
            "</tbody>"+
            "</table>" +"</div>"+"</div>";

            $("#printLogo").append(logo);

            $("#printPtInfo").append(result_title);

            $("#printResultTable").append(result_body+result_footer);

            $("#header_bar").hide();

            var afb_save_id=[];
            for(var i=1;i<11;i++){
              afb_save_id[i]='afb_save'+i;

            }

            for(var i=0;i<=afb_save_id.length;i++)
            {
              var afb_data = afb_save_id[i];
              if(!$('#'+afb_data).text() || $('#'+afb_data).text()=="-"||$('#'+afb_data).text()=="0"){
                $('#'+afb_data).css('background-color','grey')

              }

            }
            $("#app").hide();
            $("#hider0").hide();
            $("#hider1").hide();
            $("#hidden-title").hide();
            $("#header_bar").hide();
            $("#save-update-print").hide();


            $("#toshowResult").show();
            window.print();
            var ckUpdater = response[0][0]['name'];
            if(ckUpdater == 'updated')
            {
              alert("We have updated the data");
            }
            else{
              alert("We have collected test information of the patient.");
            }
            $("#app").show();
            $("#hider0").show();
            $("#hider1").show();
            $("#hidden-title").show();
            $("#header_bar").show();
            $("#save-update-print").show();

            $("#toshowResult").hide();

          }
        });
      }else{
        console.log("Cancel");
      }
  }else{
    // Validation to the ID
    setTimeout(function(){
      $("#noti_afb").show();
      document.getElementById('noti_afb').innerHTML="Please check the 'ID' or 'Results'.";
      document.getElementById('noti_afb').style="background-color:red;";
    },500);
    setTimeout(function(){
      document.getElementById('noti_afb').innerHTML="";
      $("#noti_afb").hide();

    },5000);
  }
}
//******************************************************
function gt_save(){

  var cid = document.getElementById("cid").value;
  var created_by = document.getElementById("navbarDropdown").innerHTML;
  var agey = $("#agey").text();
  var agem = $("#agem").text
  agey = parseInt(agey);//changing to number
  agem = parseInt(agem);
  if(isNaN(agey)){
    agey=0;
  }
  if(isNaN(agem)){
    agem=0;
  }
  var gender = $("#gender").text();
  gender= String(gender);
  var fuchiaID = document.getElementById("fuchiaID").value;

  // var clinic = document.getElementById("clinic").innerHTML;
  var clinic = 81;
  var vDate = document.getElementById("vDate").value;
  vDate = formatDate(vDate); // date FormatChange YYYY/MM/DD
  var Ptype = $("#Ptype").text();
  var ext_sub = $("#ext").text();
  if(ext_sub.length<33){// the blank response from text count is 32
    ext_sub ="-";
  }

  var reqDoctor = document.getElementById("md").value;
  ///////////////////
  var dangue_rdt          = document.getElementById('dangue_rdt').value;
  var NS1_antigen         = document.getElementById('NS1_antigen').value;
  var igG                 = document.getElementById('igG').value;
  var igm                 = document.getElementById('igm').value;
  var mal_spec            = document.getElementById('mal_spec').value;
  var malaria_rdt_done    = document.getElementById('malaria_rdt').value;
  var malaria_rdt_result  = document.getElementById('malaria_rdt_result').value;
  var mal_grade           = document.getElementById('mal_grade').value;
  var mal_stage           = document.getElementById('mal_stage').value;
  var malaria_microscopy_result  = mal_spec+mal_grade+mal_stage;



  var malaria_done        = document.getElementById('malaria_microscopy').value;

  // var rbs                 = document.getElementById('rbs').value;

  var rbs_result          = document.getElementById('rbs_result').value;
  // var fbs                 = document.getElementById('fbs').value;
  ////console.log(rbs_result);

  var fbs_result          = document.getElementById('fbs_result').value;
  // var gt_haemoglobin      = document.getElementById('gt_haemoglobin').value;

  ////console.log(fbs_result );

  var haemoPercent        = document.getElementById('haemoPercent').value;
  var hba1c               = document.getElementById('hba1c').value;

  ////console.log(hba1c);

  var gt_lab_tech         = document.getElementById('gt_lab_tech').value;
  var gt_issue_date       = document.getElementById('gt_issue_date').value;
  gt_issue_date = formatDate( gt_issue_date ); // date FormatChange YYYY/MM/DD




  var gtTest = 1;
  var gtData={

    gtTest              :gtTest,

    cid                 :cid,
    fuchiaID            :fuchiaID,
    agey                :agey,
    agem                :agem,
    gender              :gender,
    vDate               :vDate,
    Ptype               :Ptype,
    ext_sub             :ext_sub,
    reqDoctor           :reqDoctor,
    clinic              :clinic,

    dangue_rdt          : dangue_rdt,
    NS1_antigen         : NS1_antigen,
    igG                 : igG,
    igm                 : igm,
    malaria_rdt_done    : malaria_rdt_done ,
    malaria_rdt_result  : malaria_rdt_result,
    mal_spec            :mal_spec,
    mal_grade           :mal_grade,
    mal_stage           :mal_stage,
    malaria_done        : malaria_done ,
    malaria_microscopy_result   : malaria_microscopy_result,
    // rbs                 : rbs,
    rbs_result          : rbs_result,
    // fbs                 : fbs,
    fbs_result          : fbs_result,
    // gt_haemoglobin      : gt_haemoglobin,
    haemoPercent        : haemoPercent,

    hba1c               : hba1c,
    gt_lab_tech         : gt_lab_tech,
    gt_issue_date       : gt_issue_date,

    created_by:created_by,
  };


  if(cid.length>8 && gt_lab_tech.length>2 && present==1){
    if (confirm("Are you sure you want to do save?")) {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        }
      });
        $.ajax({
          type:'POST',
          url:"{{route('tests')}}",
          dataType:'json',
          //processData:false,
          contentType: 'application/json',
          data: JSON.stringify(gtData),
          //data: rprDataset,
          success:function(response){
            $("#printLogo").empty();
            $("#printPtInfo").empty();
            $("#printResultTable").empty();
            // $("#app").hide();
            // $("#hider0").hide();
            // $("#hider1").hide();
            // $("#save-update-print").hide();
            // $( "#toshowResult" ).removeClass( "print-dispaly" );

            var gt_save_id=[];
            for(var i=1;i<8;i++){
              gt_save_id[i]='gt_save'+i;

            }

            if(reqDoctor==null){
              reqDoctor= "__________";
            };

            if (lab_tech <1){
              lab_tech="_______";
            };

            if (gt_issue_date    <1){
              gt_issue_date   ="_______";
            };

            if(fuchiaID.length < 1){
              fuchiaID = "__________"
            };

            if(Number.isNaN(agey))  {
              var ageys= "____";
            }else {
              var ageys=agey;
            };

            if(Number.isNaN(agem))  {
              var agems= "____";
            }else {
              var agems=agem;
            };

            var logo =
            "<div class='row'>"+
            "<div class='d-flex justify-content-center' >"+

            "<h4  class='print-header clearfix'>"+  "<img src='/logoMAM.jpg'  alt='logo' style='width:70px;height:70px;'>"+
            "<p class='hiv-p'>"+"General Test Result"+"</p>"+"</h4>"+
            "</div>"+
            "</div>";
            var result_title=
            "<div class='d-flex justify-content-center print-coheader-list'>"+
            "<ul class='clearfix' style='width:84%;padding-left: 5%;'>"+
            "<li class='first-li'>"+"ID:"+"</li>"+"<li>"+cid+","+"</li>"+

            "<li class='first-li'>"+"Fuchia ID:"+"</li>"+"<li>"+fuchiaID+","+"</li>"+
            // "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
            "<li class='first-li'>"+"Date:"+"</li>"+"<li>"+vDate+","+"</li>"+
            // "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
            "<li class='first-li'>"+"Age(Y):"+"</li>"+"<li>"+ageys+","+"</li>"+
            // "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
            "<li class='first-li'>"+"Age(M):"+"</li>"+"<li>"+agems+","+"</li>"+
            // "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
            "<li class='first-li'>"+"Sex:"+"</li>"+"<li>"+gender+","+"</li>"+
            "</ul>"+

            "</div>";
            var result_footer=
            "<div class='print-hiv-footer'>"
            +"<ul class='clearfix print-sti-footer'>"+
            "<li class='first-li'>"
            +"Requested Doctor:"+"</li>"+"<li>"+reqDoctor+","+"</li>"
            // +
            // "<li class='first-li'>"
            // +"Counselor:"+"</li>"+"<li>"+rpr_counselor+","+"</li>"
            +
            // "Counselor ::"+counselor+
            "<li>"
            +"Issue by-:"+"</li>"+"<li>"+gt_lab_tech+","+"</li>"

            // "Issue by- "+lab_tech+
            +
            "<li>"
            +"Issue Date :"+"</li>"+"<li>"+gt_issue_date+","+"</li>"
            +
            // "Issue Date :"+issue_date+
            "</div>";

            var result_body = "<div class='d-flex justify-content-center' >"+"<table class='table  print-hiv-table'>"+
            "<thead>"+
            "<tr>" +"<td>"+"NO."+"</td>"+"<td>"+"Test Name"+"</td>"+"<td>"+"Result"+"</td>"+"</tr>"+
            "</thead>"+
            "<tbody>"+
            "<tr id='tbrow'>"+"<td>"+"1."+"</td>"+"<td>"+"Dangue Result"+"</td>"+"<td>"+"<p class='print-tr'id='gt_save1' style=''>"+NS1_antigen+','+igG+','+igm+"</p>"+"</td>"+"</tr>"+
            "<tr id='tbrow'>"+"<td>"+"2."+"</td>"+"<td>"+"Malaria RDT Result"+"</td>"+"<td>"+"<p class='print-tr'id='gt_save2' style=''>"+malaria_rdt_result+"</p>"+"</td>"+"</tr>"+
            "<tr id='tbrow'>"+"<td>"+"3."+"</td>"+"<td>"+"Microscopy Result"+"</td>"+"<td>"+"<p class='print-tr'id='gt_save3' style=''>"+malaria_microscopy_result+"</p>"+"</td>"+"</tr>"+
            "<tr id='tbrow'>"+"<td>"+"4."+"</td>"+"<td>"+"RBS(mg/dl)"+"</td>"+"<td>"+"<p class='print-tr'id='gt_save4' style=''>"+rbs_result+"</p>"+"</td>"+"</tr>"+
            "<tr id='tbrow'>"+"<td>"+"5."+"</td>"+"<td>"+"FBS(mg/dl)"+"</td>"+"<td>"+"<p class='print-tr'id='gt_save5' style=''>"+fbs_result+"</p>"+"</td>"+"</tr>"+
            "<tr id='tbrow'>"+"<td>"+"6."+"</td>"+"<td>"+"Haemoglobin % (g/dl)"+"</td>"+"<td>"+"<p class='print-tr'id='gt_save6' style=''>"+haemoPercent+"</p>"+"</td>"+"</tr>"+
            "<tr id='tbrow'>"+"<td>"+"7."+"</td>"+"<td>"+"HbA1C %"+"</td>"+"<td>"+"<p class='print-tr'id='gt_save7' style=''>"+hba1c+"</p>"+"</td>"+"</tr>"+
            "</tbody>"+
            "</table>" +"</div>";

            $("#printLogo").append(logo);

            $("#printPtInfo").append(result_title);

            $("#printResultTable").append(result_body+result_footer);

            $("#header_bar").hide();
            
            for(var i=0;i<=gt_save_id.length;i++)
            {
              var gt_data = gt_save_id[i];
              if($('#'+gt_data).text()=="0" || $('#'+gt_data).text()=="-"||$('#'+gt_data).text()=="---"||$('#'+gt_data).text()=="-,-,-")
              $('#'+gt_data).css('background-color','grey')
              ////console.log(!$('#'+gt_data).text())

            }

            $("#app").hide();
            $("#hider0").hide();
            $("#hider1").hide();
            $('#save-update-print').hide();
            //  $( "#toshowResult" ).removeClass( "print-dispaly" );
            $( "#toshowResult" ).show();
            window.print();
            var ckUpdater = response[0][0]['name'];
            if(ckUpdater == 'updated')
            {
              alert("We have updated the data");
            }
            else{
              alert("We have collected test information of the patient.");
            }
            $("#app").show();
            $("#hider0").show();
            $("#hider1").show();
            $("#hidden-title").show();
            $("#toshowResult").hide();
            $("#save-update-print").show();
            $("#header_bar").show();
            //location.reload(true);// to refresh the page
          }
        });
      }else{
        console.log("Cancel");
      }
  }else{
    // Validation to the ID
    setTimeout(function(){
      $("#noti_gt").show();
      document.getElementById('noti_gt').innerHTML="Please check the 'ID' or 'Results'.";
      document.getElementById('noti_gt').style="background-color:red;";
    },500);
    setTimeout(function(){
      document.getElementById('noti_gt').innerHTML="";
      $("#noti_gt").hide();

    },5000);
  }
}
function gtUpdate(){
  var updated_by = document.getElementById("navbarDropdown").innerHTML;


  var update_per = 0;
  var cid = document.getElementById("cid").value;
  var agey = $("#agey").text();
  var agem = $("#agem").text
  agey = parseInt(agey);//changing to number
  agem = parseInt(agem);
  if(isNaN(agey)){
    agey=0;
  }
  if(isNaN(agem)){
    agem=0;
  }
  var gender = $("#gender").text();
  gender= String(gender);
  var fuchiaID = document.getElementById("fuchiaID").value;

  // var clinic = document.getElementById("clinic").innerHTML;
  var clinic = 81;
  var vDate = document.getElementById("vDate").value;
  vDate = formatDate(vDate); // date FormatChange YYYY/MM/DD
  var Ptype = $("#Ptype").text();
  var ext_sub = $("#ext").text();
  if(ext_sub.length<33){// the blank response from text count is 32
    ext_sub ="-";
  }

  var reqDoctor = document.getElementById("md").value;
  ///////////////////
  var dangue_rdt          = document.getElementById('dangue_rdt').value;
  var NS1_antigen         = document.getElementById('NS1_antigen').value;
  var igG                 = document.getElementById('igG').value;
  var igm                 = document.getElementById('igm').value;
  var mal_spec            = document.getElementById('mal_spec').value;
  var malaria_rdt_done    = document.getElementById('malaria_rdt').value;
  var malaria_rdt_result  = document.getElementById('malaria_rdt_result').value;
  var mal_grade           = document.getElementById('mal_grade').value;
  var mal_stage           = document.getElementById('mal_stage').value;
  var malaria_microscopy_result  = mal_spec+mal_grade+mal_stage;



  var malaria_done        = document.getElementById('malaria_microscopy').value;

  // var rbs                 = document.getElementById('rbs').value;

  var rbs_result          = document.getElementById('rbs_result').value;
  // var fbs                 = document.getElementById('fbs').value;
  ////console.log(rbs_result);

  var fbs_result          = document.getElementById('fbs_result').value;
  // var gt_haemoglobin      = document.getElementById('gt_haemoglobin').value;

  ////console.log(fbs_result );

  var haemoPercent        = document.getElementById('haemoPercent').value;
  var hba1c               = document.getElementById('hba1c').value;

  ////console.log(hba1c);

  var gt_lab_tech         = document.getElementById('gt_lab_tech').value;
  var gt_issue_date       = document.getElementById('gt_issue_date').value;
  gt_issue_date = formatDate(gt_issue_date); // date FormatChange YYYY/MM/DD

  //  var cid = document.getElementById("cid").value;
  //  var agey = $("#agey").text();
  //  var agem = $("#agem").text
  //  agey = parseInt(agey);//changing to number
  //  agem = parseInt(agem);
  //  if(isNaN(agey)){
  //    agey=0;
  //  }
  //  if(isNaN(agem)){
  //    agem=0;
  //  }
  //  var gender = $("#gender").text();
  //  gender= String(gender);
  //  var fuchiaID = document.getElementById("fuchiaID").value;
  //  // var clinic = document.getElementById("clinic").innerHTML;
  //  var clinic = 81;
  //  var vDate = document.getElementById("vDate").value;
  //  var Ptype = $("#Ptype").text();
  //  var ext_sub = $("#ext").text();
  //  if(ext_sub.length<33){// the blank response from text count is 32
  //    ext_sub ="-";
  //  }
  //  var reqDoctor = document.getElementById("md").value;
  //  ///////////////////
  //  var dangue_rdt          = document.getElementById('dangue_rdt').value;
  //  var NS1_antigen         = document.getElementById('NS1_antigen').value;
  //  var igG                 = document.getElementById('igG').value;
  //  var igm                 = document.getElementById('igm').value;
  //  var mal_spec            = document.getElementById('mal_spec').value;
  //  var malaria_rdt_done    = document.getElementById('malaria_rdt').value;
  //  var malaria_rdt_result  = document.getElementById('malaria_rdt_result').value;
  //  var mal_grade           = document.getElementById('mal_grade').value;
  //  var mal_stage           = document.getElementById('mal_stage').value;
  //  var malaria_microscopy_result  = mal_spec+mal_grade+mal_stage;

  //  var malaria_done        = document.getElementById('malaria_microscopy').value;
  //  var rbs                 = document.getElementById('rbs').value;
  //  var rbs_result          = document.getElementById('rbs_result').value;
  //  var fbs                 = document.getElementById('fbs').value;
  //  var fbs_result          = document.getElementById('fbs_result').value;
  //  var gt_haemoglobin      = document.getElementById('gt_haemoglobin').value;
  //  var haemoPercent        = document.getElementById('haemoPercent').value;
  //  var hba1c               = document.getElementById('hba1c').value;
  //  var gt_lab_tech         = document.getElementById('gt_lab_tech').value;
  //  var gt_issue_date       = document.getElementById('gt_issue_date').value;

  if(save_update_gt ==7){
    var gtTest = 2;
    update_rowNo= resp[6][0]['id'];
    console.log(update_rowNo);
    var appUser = document.getElementById("navbarDropdown").innerHTML;// to collect app user from application nav bar
    var org_info = 'RowID->'+resp[6][0]['id']
    +',FuchiaID->' +resp[6][0]["fuchiacode"]
    + ',GeneralID->' +resp[6][0]["CID"]
    + ',Age(year)->' +resp[6][0]["agey"]
    + ',Age(mo)->' +resp[6][0]["agem"]
    + ',Gender->' +resp[6][0]["Gender"]
    + ',Visit Date->' +resp[6][0]["Visit_date"]
    + ',Risk->' +resp[6][0]['Patient_Type']
    + ',Sub risk->' +resp[6][0]['Patient Type Sub']
    + ',Requested Dr  ->' +resp[6][0]['Requested Doctor old ']
    + ',Dangue RDT  ->' +resp[6][0]['Dangue RDT']
    + ',NS1 Antigen  ->' +resp[6][0]['NS1 Antigen']
    + ',IgG Result ->' +resp[6][0]['IgG Result']
    + ',IgM Result->' +resp[6][0]['IgM Result']
    + ',Malaria RDT Result->' +resp[6][0]['Malaria RDT Result']
    + ',Malaria Microscopy Done ->' +resp[6][0]['malaria_microscopy']
    + ',Malaria Microscopy Result  ->' +resp[6][0]['Malaria Microscopy Result']
    //  + ',RBS->' +resp[6][0]['RBS']
    //  + ',FBS->' +resp[6][0]['FBS']
    //  + ',Haemoglobin->' +resp[6][0]['haemoglobin']
    + ',HbA1C->' +resp[6][0]['hba1c']
    + ',Malaria Spec->' +resp[6][0]['Malaria_spec']
    + ',Malaria Grade->' +resp[6][0]['Malaria_grade']
    + ',Malaria Stage->' +resp[6][0]['Malaria_stage']
    + ',Lab Tech->' +resp[6][0]['Lab Tech']
    +',Issue Date->' +resp[6][0]['Issue Date'];

    var updated_info ='FuchiaID->'+fuchiaID
    +',Age(year)->'+agey
    +',Age(mo)->'+agem
    +',Gender->'+gender
    +',Visit Date ->'+vDate
    +',Risk->'+Ptype
    +',Sub Risk->'+ext_sub
    +',MD ->'+reqDoctor
    +',Clinic->'+clinic
    +',Dangue RDT  ->' +dangue_rdt
    + ',NS1 Antigen  ->' +NS1_antigen
    + ',IgG Result ->' +igG
    + ',IgM Result->' +igm
    + ',Malaria RDT Result->' +malaria_rdt_result
    + ',Malaria Spec->' +mal_spec
    + ',Malaria Grade->' +mal_grade
    + ',Malaria Stage->' +mal_stage
    + ',Malaria Microscopy ->' +malaria_done
    + ',Malaria Microscopy Result ->' +malaria_microscopy_result
    + ',RBS->' +rbs_result
    //+ ',FBS->' +fbs
    + ',Haemoglobin->' +haemoPercent
    + ',HbA1C->' +hba1c
    + ',Lab Tech->' +gt_lab_tech
    +',Issue Date->' +gt_issue_date ;
    var gtData={
      updated_info        :updated_info,
      org_info            :org_info,
      appUser             :appUser,
      update_rowNo_gt     :update_rowNo,
      gtTest              :gtTest,

      cid                 :cid,
      fuchiaID            :fuchiaID,
      agey                :agey,
      agem                :agem,
      gender              :gender,
      vDate               :vDate,
      Ptype               :Ptype,
      ext_sub             :ext_sub,
      reqDoctor           :reqDoctor,
      clinic              :clinic,

      dangue_rdt          : dangue_rdt,
      NS1_antigen         : NS1_antigen,
      igG                 : igG,
      igm                 : igm,
      malaria_rdt         : malaria_rdt,
      malaria_rdt_result  : malaria_rdt_result,
      mal_spec            :mal_spec,
      mal_grade           :mal_grade,
      mal_stage           :mal_stage,
      malaria_done        : malaria_done ,
      malaria_microscopy_result   : malaria_microscopy_result,
      //rbs                 : rbs,
      rbs_result          : rbs_result,
      //fbs                 : fbs,
      fbs_result          : fbs_result,
      //gt_haemoglobin      : gt_haemoglobin,
      haemoPercent        : haemoPercent,
      hba1c               : hba1c,
      gt_lab_tech         : gt_lab_tech,
      gt_issue_date       : gt_issue_date,

      updated_by          : updated_by,
    };


  }
  if(cid.length>8 ){
    if (confirm("Are you sure you want to do save?")) {
     
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
      }
    });
    $.ajax({
      type:'POST',
      url:"{{route('tests')}}",
      dataType:'json',
      //processData:false,
      contentType: 'application/json',
      data: JSON.stringify(gtData),
      //data: rprDataset,
      success:function(response){
        $("#printLogo").empty();
        $("#printPtInfo").empty();
        $("#printResultTable").empty();
        $("#toshwoResult").empty();

        $("#app").hide();
        $("#hider0").hide();
        $("#hider1").hide();
        $("#save-update-print").hide();
        $( "#toshowResult" ).removeClass( "print-dispaly" );

        if(reqDoctor==null){
          reqDoctor= "__________";
        };

        if (lab_tech <1){
          lab_tech="_______";
        };

        if (rpr_issue_date  <1){
          rpr_issue_date ="_______";
        };

        if(fuchiaID.length < 1){
          fuchiaID = "__________"
        };

        if(Number.isNaN(agey))  {
          var ageys= "____";
        }else {
          var ageys=agey;
        };

        if(Number.isNaN(agem))  {
          var agems= "____";
        }else {
          var agems=agem;
        };

        var logo =
        "<div class='row'>"+
        "<div class='d-flex justify-content-center' >"+

        "<h4  class='print-header clearfix'>"+  "<img src='/logoMAM.jpg'  alt='logo' style='width:70px;height:70px;'>"+
        "<p class='hiv-p'>"+"General Test Result (Updated)"+"</p>"+"</h4>"+
        "</div>"+
        "</div>";
        var result_title=
        "<div class='d-flex justify-content-center print-coheader-list'>"+
        "<ul class='clearfix' style='width:84%;padding-left: 3%;'>"+
        "<li class='first-li'>"+"ID:"+"</li>"+"<li>"+cid+","+"</li>"+

        "<li class='first-li'>"+"Fuchia ID:"+"</li>"+"<li>"+fuchiaID+","+"</li>"+
        // "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
        "<li class='first-li'>"+"Date:"+"</li>"+"<li>"+vDate+","+"</li>"+
        // "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
        "<li class='first-li'>"+"Age(Y):"+"</li>"+"<li>"+ageys+","+"</li>"+
        // "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
        "<li class='first-li'>"+"Age(M):"+"</li>"+"<li>"+agems+","+"</li>"+
        // "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
        "<li class='first-li'>"+"Sex:"+"</li>"+"<li>"+gender+","+"</li>"+
        "</ul>"+

        "</div>";
        var result_footer=
        "<div class='print-hiv-footer'>"
        +"<ul class='clearfix print-sti-footer'>"+
        "<li class='first-li'>"
        +"Requested Doctor:"+"</li>"+"<li>"+reqDoctor+","+"</li>"
        // +
        // "<li class='first-li'>"
        // +"Counselor:"+"</li>"+"<li>"+rpr_counselor+","+"</li>"
        +
        // "Counselor ::"+counselor+
        "<li>"
        +"Issue by-:"+"</li>"+"<li>"+gt_lab_tech+","+"</li>"

        // "Issue by- "+lab_tech+
        +
        "<li>"
        +"Issue Date :"+"</li>"+"<li>"+gt_issue_date+","+"</li>"
        +
        // "Issue Date :"+issue_date+
        "</div>";


        //  var result_body = "<br>" +"<div class='col-sm-10' style='width:100%'>"+"<table class='table  print-hiv-table'>"+
        //      "<thead>"+
        //          "<th>" +"<td>"+"NO."+"</td>"+"<td>"+"Test Name"+"</td>"+"<td>"+"Result"+"</td>"+"</th>"+
        //      "</thead>"+
        //      "<tbody>"+
        //          "<tr id='tbrow'>"+"<td>"+"1."+"</td>"+"<td>"+"Dangue Result"+"</td>"+"<td>"+NS1_antigen+"</td>"+"</tr>"+
        //          "<tr id='tbrow'>"+"<td>"+"2."+"</td>"+"<td>"+"IgG"+"</td>"+"<td>"+igG+"</td>"+"</tr>"+
        //          "<tr id='tbrow'>"+"<td>"+"3."+"</td>"+"<td>"+"IgM"+"</td>"+"<td>"+igm+"</td>"+"</tr>"+

        //          "<tr id='tbrow'>"+"<td>"+"4."+"</td>"+"<td>"+"Malaria RDT Result"+"</td>"+"<td>"+malaria_rdt_result+"</td>"+"</tr>"+
        //          "<tr id='tbrow'>"+"<td>"+"5."+"</td>"+"<td>"+"Microscopy Result"+"</td>"+"<td>"+malaria_microscopy_result+"</td>"+"</tr>"+
        //          "<tr id='tbrow'>"+"<td>"+"6."+"</td>"+"<td>"+"RBS(mg/dl)"+"</td>"+"<td>"+rbs_result+"</td>"+"</tr>"+
        //          "<tr id='tbrow'>"+"<td>"+"7."+"</td>"+"<td>"+"FBS(mg/dl)"+"</td>"+"<td>"+fbs_result+"</td>"+"</tr>"+
        //          "<tr id='tbrow'>"+"<td>"+"8."+"</td>"+"<td>"+"Haemoglobin % (g/dl)"+"</td>"+"<td>"+haemoPercent+"</td>"+"</tr>"+
        //          "<tr id='tbrow'>"+"<td>"+"9."+"</td>"+"<td>"+"HbA1C %"+"</td>"+"<td>"+hba1c+"</td>"+"</tr>"+
        //    "</tbody>"+
        //  "</table>" +"</div>"+"</div>";
        var result_body ="<div class='d-flex justify-content-center' >"+"<table class='table  print-hiv-table'>"+
        "<thead>"+
        "<tr>" +"<td>"+"NO."+"</td>"+"<td>"+"Test Name"+"</td>"+"<td>"+"Result"+"</td>"+"</tr>"+
        "</thead>"+
        "<tbody>"+
        "<tr id='tbrow'>"+"<td>"+"1."+"</td>"+"<td>"+"Dangue Result"+"</td>"+"<td>"+"<p class='print-tr'id='gt_save1' style=''>"+NS1_antigen+','+igG+','+igm+"</p>"+"</td>"+"</tr>"+
        "<tr id='tbrow'>"+"<td>"+"2."+"</td>"+"<td>"+"Malaria RDT Result"+"</td>"+"<td>"+"<p class='print-tr'id='gt_save2' style=''>"+malaria_rdt_result+"</p>"+"</td>"+"</tr>"+
        "<tr id='tbrow'>"+"<td>"+"3."+"</td>"+"<td>"+"Microscopy Result"+"</td>"+"<td>"+"<p class='print-tr'id='gt_save3' style=''>"+malaria_microscopy_result+"</p>"+"</td>"+"</tr>"+
        "<tr id='tbrow'>"+"<td>"+"4."+"</td>"+"<td>"+"RBS(mg/dl)"+"</td>"+"<td>"+"<p class='print-tr'id='gt_save4' style=''>"+rbs_result+"</p>"+"</td>"+"</tr>"+
        "<tr id='tbrow'>"+"<td>"+"5."+"</td>"+"<td>"+"FBS(mg/dl)"+"</td>"+"<td>"+"<p class='print-tr'id='gt_save5' style=''>"+fbs_result+"</p>"+"</td>"+"</tr>"+
        "<tr id='tbrow'>"+"<td>"+"6."+"</td>"+"<td>"+"Haemoglobin % (g/dl)"+"</td>"+"<td>"+"<p class='print-tr'id='gt_save6' style=''>"+haemoPercent+"</p>"+"</td>"+"</tr>"+
        "<tr id='tbrow'>"+"<td>"+"7."+"</td>"+"<td>"+"HbA1C %"+"</td>"+"<td>"+"<p class='print-tr'id='gt_save7' style=''>"+hba1c+"</p>"+"</td>"+"</tr>"+
        "</tbody>"+
        "</table>" +"</div>";

        $("#printLogo").append(logo);

        $("#printPtInfo").append(result_title);

        $("#printResultTable").append(result_body+result_footer);



        $("#app").hide();
        $("#hider0").hide();
        $("#hider1").hide();
        $("#hidden-title").hide();
        $("#header_bar").hide();
        $("#save-update-print").hide();


        $("#toshowResult").show();
        window.print();
        var ckUpdater = response[0][0]['name'];
        if(ckUpdater == 'updated')
        {
          alert("We have updated the data");
        }
        else{
          alert("We have collected test information of the patient.");
        }
        $("#app").show();
        $("#hider0").show();
        $("#hider1").show();
        $("#hidden-title").show();
        $("#header_bar").show();
        $("#save-update-print").show();

        $("#toshowResult").hide();
      }
    });


  }else{
    $("#noti").show();
    document.getElementById('noti').innerHTML="Please input data first";
    setTimeout(function(){
      document.getElementById('noti_gt').innerHTML="";
      $("#noti_gt").hide();

    },5000);
  }
  
  }
}
//*******************************************************
function stSave(){
  if(save_update_st == 8){
    var stTest = 2;
  }else{
    var stTest = 1;
  }
  var cid = document.getElementById("cid").value;
  var created_by = document.getElementById("navbarDropdown").innerHTML;
  var agey = $("#agey").text();
  var agem = $("#agem").text
  agey = parseInt(agey);//changing to number
  agem = parseInt(agem);
  if(isNaN(agey)){
    agey=0;
  }
  if(isNaN(agem)){
    agem=0;
  }
  var gender = $("#gender").text();
  gender= String(gender);
  var fuchiaID = document.getElementById("fuchiaID").value;
  // var clinic = document.getElementById("clinic").innerHTML;
  var clinic = 81;
  var vDate = document.getElementById("vDate").value;
  vDate = formatDate(vDate); // date FormatChange YYYY/MM/DD
  var Ptype = $("#Ptype").text();
  var ext_sub = $("#ext").text();
  if(ext_sub.length<33){// the blank response from text count is 32
    ext_sub ="-";
  }
  var reqDoctor = document.getElementById("md").value;
  ///////////////////

  var st_stool            = document.getElementById('st_stool').value;
  var st_colour           = document.getElementById('st_colour').value;
  var wbc_pus_cell        = document.getElementById('wbc_pus_cell').value;
  var st_consistency      = document.getElementById('st_consistency').value;
  var st_rbcs             = document.getElementById('st_rbcs').value;
  var st_other            = document.getElementById('st_other').value;
  var st_comment          = document.getElementById('st_comment').value;
  var st_lab_tech         = document.getElementById('st_lab_tech').value;
  console.log(st_lab_tech+"present"+present);
  var st_issue_date       = document.getElementById('st_issue_date').value;
  st_issue_date = formatDate(st_issue_date); // date FormatChange YYYY/MM/DD

  let stData={
    stTest              :stTest,
    cid                 :cid,
    fuchiaID            :fuchiaID,
    agey                :agey,
    agem                :agem,
    gender              :gender,
    vDate               :vDate,
    Ptype               :Ptype,
    ext_sub             :ext_sub,
    reqDoctor           :reqDoctor,
    clinic              :clinic,

    st_stool            : st_stool,
    st_colour           : st_colour,
    wbc_pus_cell        : wbc_pus_cell,
    st_consistency      : st_consistency,
    st_rbcs             : st_rbcs,
    st_other            : st_other,
    st_comment          : st_comment ,
    st_lab_tech         : st_lab_tech,
    st_issue_date       : st_issue_date,

    created_by          : created_by,

  };
  if(cid.length >8 && st_lab_tech.length > 2 && present==1){
    if (confirm("Are you sure you want to do save?")) {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
      }
    });
    $.ajax({
      type:'POST',
      url:"{{route('tests')}}",
      dataType:'json',
      //processData:false,
      contentType: 'application/json',
      data: JSON.stringify(stData),
      //data: rprDataset,
      success:function(response){
        $("#printLogo").empty();
        $("#printPtInfo").empty();
        $("#printResultTable").empty();
        // $("#app").hide();
        //  $("#hider0").hide();
        //  $("#hider1").hide();
        //  $("#save-update-print").hide();
        //  $( "#toshowResult" ).removeClass( "print-dispaly" );


        if(reqDoctor < 1){
          reqDoctor= "__________";
        };

        if (st_lab_tech.length<1){
          st_lab_tech="_______";
        };

        if (st_issue_date.length <1){
          st_issue_date ="_______";
        };

        if(fuchiaID.length < 1){
          fuchiaID = "__________"
        };

        if(Number.isNaN(agey))  {
          var ageys= "____";
        }else {
          var ageys=agey;
        };

        if(Number.isNaN(agem))  {
          var agems= "____";
        }else {
          var agems=agem;
        };

        var logo =
        "<div class='row'>"+
        "<div class='d-flex justify-content-center' >"+

        "<h4  class='print-header clearfix'>"+"<img src='/logoMAM.jpg'  alt='logo' style='width:70px;height:70px;'>"+
        "<p class='hiv-p'>"+"Stool Test Result"+"</p>"+"</h4>"+
        "</div>"+
        "</div>";
        var result_title=
        "<div class='d-flex justify-content-center print-coheader-list'>"+
        "<ul class='clearfix' style='width:84%;padding-left: 5%;'>"+
        "<li class='first-li'>"+"ID:"+"</li>"+"<li>"+cid+","+"</li>"+

        "<li class='first-li'>"+"Fuchia ID:"+"</li>"+"<li>"+fuchiaID+","+"</li>"+
        // "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
        "<li class='first-li'>"+"Date:"+"</li>"+"<li>"+vDate+","+"</li>"+
        // "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
        "<li class='first-li'>"+"Age(Y):"+"</li>"+"<li>"+ageys+","+"</li>"+
        // "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
        "<li class='first-li'>"+"Age(M):"+"</li>"+"<li>"+agems+","+"</li>"+
        // "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
        "<li class='first-li'>"+"Sex:"+"</li>"+"<li>"+gender+","+"</li>"+
        "</ul>"+

        "</div>";
        var result_footer=
        "<div class='print-hiv-footer'>"
        +"<ul class='clearfix print-sti-footer'>"+
        "<li class='first-li'>"
        +"Requested Doctor:"+"</li>"+"<li>"+reqDoctor+","+"</li>"
        // +
        // "<li class='first-li'>"
        // +"Counselor:"+"</li>"+"<li>"+rpr_counselor+","+"</li>"
        +
        // "Counselor ::"+counselor+
        "<li>"
        +"Issue by-:"+"</li>"+"<li>"+st_lab_tech+","+"</li>"

        // "Issue by- "+lab_tech+
        +
        "<li>"
        +"Issue Date :"+"</li>"+"<li>"+st_issue_date+","+"</li>"
        +
        // "Issue Date :"+issue_date+
        "</div>";
        var result_body = "<div class='d-flex justify-content-center' >"+"<table class='table  print-hiv-table'>"+
        "<thead>"+
        "<tr>" +"<td>"+"NO."+"</td>"+"<td>"+"Test Name"+"</td>"+"<td>"+"Result"+"</td>"+"</tr>"+
        "</thead>"+
        "<tbody>"+
        "<tr>"+"<td>"+"1."+"</td>"+"<td>"+"Color"+"</td>"+"<td>"+"<p class='print-tr'id='st_save1' style=''>"+st_colour+"</p>"+"</td>"+"</tr>"+
        "<tr>"+"<td>"+"2."+"</td>"+"<td>"+"WBCs/ PUS cell"+"</td>"+"<td>"+"<p class='print-tr'id='st_save2' style=''>"+wbc_pus_cell+"</p>"+"</td>"+"</tr>"+
        "<tr>"+"<td>"+"3."+"</td>"+"<td>"+"RBC"+"</td>"+"<td>"+"<p class='print-tr'id='st_save3' style=''>"+st_rbcs +"</p>"+"</td>"+"</tr>"+
        "<tr>"+"<td>"+"4."+"</td>"+"<td>"+"Consistency"+"</td>"+"<td>"+"<p class='print-tr'id='st_save4' style=''>"+st_consistency+"</p>"+"</td>"+"</tr>"+
        "<tr>"+"<td>"+"5."+"</td>"+"<td>"+"Other"+"</td>"+"<td>"+"<p class='print-tr'id='st_save5' style=''>"+st_other+"</p>"+"</td>"+"</tr>"+
        "</tbody>"+
        "</table>" +"</div>";

        $("#printLogo").append(logo);

        $("#printPtInfo").append(result_title);

        $("#printResultTable").append(result_body+result_footer);

        $("#header_bar").hide();
        var st_save_id=[];
        for(var i=1;i<6;i++){
          st_save_id[i]='st_save'+i;

        }
        for(var i=0;i<=st_save_id.length;i++)
        {
          var st_data = st_save_id[i];
          if(!$('#'+st_data).text() || $('#'+st_data).text()=="-")
          $('#'+st_data).css('background-color','grey')
        }

        $("#app").hide();
        $("#hider0").hide();
        $("#hider1").hide();
        $('#save-update-print').hide();
        //  $( "#toshowResult" ).removeClass( "print-dispaly" );
        $( "#toshowResult" ).show();
        window.print();
        var ckUpdater = response[0][0]['name'];
        if(ckUpdater == 'updated')
        {
          alert("We have updated the data");
        }
        else{
          alert("We have collected test information of the patient.");
        }
        $("#app").show();
        $("#hider0").show();
        $("#hider1").show();
        $("#hidden-title").show();
        $("#toshowResult").hide();
        $("#save-update-print").show();
        $("#header_bar").show();
        //location.reload(true);// to refresh the page
      }
    });
    }else{
      console.log("Cancel");
    }
  }else{
    // Validation to the ID
    setTimeout(function(){
      $("#noti_st").show();
      document.getElementById('noti_st').innerHTML="Please check the 'ID' or 'Results'.";
      document.getElementById('noti_st').style="background-color:red;";
    },500);
    setTimeout(function(){
      document.getElementById('noti_st').innerHTML="";
      $("#noti_st").hide();

    },5000);
  }
}

function stUpdate(){
  var updated_by = document.getElementById("navbarDropdown").innerHTML;


  var cid = document.getElementById("cid").value;
  var agey = $("#agey").text();
  var agem = $("#agem").text
  agey = parseInt(agey);//changing to number
  agem = parseInt(agem);
  if(isNaN(agey)){
    agey=0;
  }
  if(isNaN(agem)){
    agem=0;
  }
  var gender = $("#gender").text();
  gender= String(gender);
  var fuchiaID = document.getElementById("fuchiaID").value;
  // var clinic = document.getElementById("clinic").innerHTML;
  var clinic = 81;
  var vDate = document.getElementById("vDate").value;
  vDate = formatDate(vDate); // date FormatChange YYYY/MM/DD
  var Ptype = $("#Ptype").text();
  var ext_sub = $("#ext").text();
  if(ext_sub.length<33){// the blank response from text count is 32
    ext_sub ="-";
  }
  var reqDoctor = document.getElementById("md").value;
  ///////////////////

  var st_stool            = document.getElementById('st_stool').value;
  var st_colour           = document.getElementById('st_colour').value;
  var wbc_pus_cell        = document.getElementById('wbc_pus_cell').value;
  var st_consistency      = document.getElementById('st_consistency').value;
  var st_rbcs             = document.getElementById('st_rbcs').value;
  var st_other            = document.getElementById('st_other').value;
  var st_comment          = document.getElementById('st_comment').value;
  var st_lab_tech         = document.getElementById('st_lab_tech').value;
  var st_issue_date       = document.getElementById('st_issue_date').value;
  st_issue_date  = formatDate(st_issue_date); // date FormatChange YYYY/MM/DD



  if(save_update_st == 8){
    var stTest = 2;

    update_rowNo_st= resp[7][0]['id'];
    console.log(save_update_st);
    console.log(update_rowNo_st);
    console.log(resp);
    var appUser = document.getElementById("navbarDropdown").innerHTML;// to collect app user from application nav bar
    var org_info = 'RowID->'+resp[7][0]['id']
    +',FuchiaID->' +resp[7][0]["fuchiacode"]
    + ',GeneralID->' +resp[7][0]["CID"]
    + ',Age(year)->' +resp[7][0]["agey"]
    + ',Age(mo)->' +resp[7][0]["agem"]
    + ',Gender->' +resp[7][0]["Gender"]
    + ',Visit Date->' +resp[7][0]["visit_date"]
    + ',Risk->' +resp[7][0]['Patient Type']
    + ',Sub risk->' +resp[7][0]['Patient Type Sub']
    + ',Requested Dr  ->' +resp[7][0]['Requested Doctor']

    +', st_stool ->'+resp[7][0]["st_stool"]
    +', st_colour ->'+resp[7][0]["st_colour"]
    +', wbc_pus_cell ->'+resp[7][0]["wbc_pus_cell"]
    +', st_consistency ->'+resp[7][0]["st_consistency"]
    +', st_rbcs ->'+resp[7][0]["rbcs"]
    +', st_other ->'+resp[7][0]["st_other"]
    +', st_comment ->'+resp[7][0]["st_comment"]
    +', st_lab_tech ->'+resp[7][0]["st_lab_tech"]
    +', st_issue_date ->'+resp[7][0]["st_issue_date"];


    var updated_info ='FuchiaID->'+fuchiaID
    +',Age(year)->'+agey
    +',Age(mo)->'+agem
    +',Gender->'+gender
    +',Visit Date ->'+vDate
    +',Risk->'+Ptype
    +',Sub Risk->'+ext_sub
    +',MD ->'+reqDoctor
    +',Clinic->'+clinic

    +', st_stool ->'+st_stool
    +', st_colour ->'+st_colour
    +', wbc_pus_cell ->'+wbc_pus_cell
    +', st_consistency ->'+st_consistency
    +', st_rbcs ->'+st_rbcs
    +', st_other ->'+st_other
    +', st_comment ->'+st_comment
    +', st_lab_tech ->'+st_lab_tech
    +', st_issue_date ->'+st_issue_date

    + ',Lab Tech->' +gt_lab_tech
    +',Issue Date->' +gt_issue_date
    ;


    let stData={
      updated_info        :updated_info,
      org_info            :org_info,
      appUser             :appUser,
      update_rowNo_st  :update_rowNo_st,
      stTest              :stTest,

      cid                 :cid,
      fuchiaID            :fuchiaID,
      agey                :agey,
      agem                :agem,
      gender              :gender,
      vDate               :vDate,
      Ptype               :Ptype,
      ext_sub             :ext_sub,
      reqDoctor           :reqDoctor,
      clinic              :clinic,

      st_stool            : st_stool,
      st_colour           : st_colour,
      wbc_pus_cell        : wbc_pus_cell,
      st_consistency      : st_consistency,
      st_rbcs             : st_rbcs,
      st_other            : st_other,
      st_comment          : st_comment ,
      st_lab_tech         : st_lab_tech,
      st_issue_date       : st_issue_date,

      updated_by          : updated_by,
    };

    if(cid.length >8){
        if (confirm("Are you sure you want to do save?")) {
          $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
          });
            $.ajax({
              type:'POST',
              url:"{{route('tests')}}",
              dataType:'json',
              //processData:false,
              contentType: 'application/json',
              data: JSON.stringify(stData),
              //data: rprDataset,
              success:function(response){
                $("#printLogo").empty();
                $("#printPtInfo").empty();
                $("#printResultTable").empty();
                $("#app").hide();
                $("#hider0").hide();
                $("#hider1").hide();
                $("#save-update-print").hide();
                $( "#toshowResult" ).removeClass( "print-dispaly" );
                if(reqDoctor < 1){
                  reqDoctor= "__________";
                };

                if (st_lab_tech <1){
                  st_lab_tech="_______";
                };

                if (st_issue_date <1){
                  st_issue_date ="_______";
                };

                if(fuchiaID.length < 1){
                  fuchiaID = "__________"
                };

                if(Number.isNaN(agey))  {
                  var ageys= "____";
                }else {
                  var ageys=agey;
                };

                if(agem.length < 1){
                  var agems="__";
                }else {
                  var agems=agem;
                };

                var logo =
                "<div class='row'>"+
                "<div class='d-flex justify-content-center' >"+

                "<h4  class='print-header clearfix'>"+  "<img src='/logoMAM.jpg'  alt='logo' style='width:70px;height:70px;'>"+
                "<p class='hiv-p'>"+"Stool Test Result (Updated)"+"</p>"+"</h4>"+
                "</div>"+
                "</div>";
                var result_title=
                "<div class='d-flex justify-content-center print-coheader-list'>"+
                "<ul class='clearfix' style='width:84%;padding-left: 5%;'>"+
                "<li class='first-li'>"+"ID:"+"</li>"+"<li>"+cid+","+"</li>"+

                "<li class='first-li'>"+"Fuchia ID:"+"</li>"+"<li>"+fuchiaID+","+"</li>"+
                // "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
                "<li class='first-li'>"+"Date:"+"</li>"+"<li>"+vDate+","+"</li>"+
                // "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
                "<li class='first-li'>"+"Age(Y):"+"</li>"+"<li>"+ageys+","+"</li>"+
                // "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
                "<li class='first-li'>"+"Age(M):"+"</li>"+"<li>"+agems+","+"</li>"+
                // "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
                "<li class='first-li'>"+"Sex:"+"</li>"+"<li>"+gender+","+"</li>"+
                "</ul>"+

                "</div>";
                var result_footer=
                "<div class='print-hiv-footer'>"
                +"<ul class='clearfix print-sti-footer'>"+
                "<li class='first-li'>"
                +"Requested Doctor:"+"</li>"+"<li>"+reqDoctor+","+"</li>"
                // +
                // "<li class='first-li'>"
                // +"Counselor:"+"</li>"+"<li>"+rpr_counselor+","+"</li>"
                +
                // "Counselor ::"+counselor+
                "<li>"
                +"Issue by-:"+"</li>"+"<li>"+st_lab_tech+","+"</li>"

                // "Issue by- "+lab_tech+
                +
                "<li>"
                +"Issue Date :"+"</li>"+"<li>"+st_issue_date+","+"</li>"
                +
                // "Issue Date :"+issue_date+
                "</div>";
                var result_body = "<div class='d-flex justify-content-center' >"+"<table class='table  print-hiv-table'>"+
                "<thead>"+
                "<tr>" +"<td>"+"NO."+"</td>"+"<td>"+"Test Name"+"</td>"+"<td>"+"Result"+"</td>"+"</tr>"+
                "</thead>"+
                "<tbody>"+
                "<tr>"+"<td>"+"1."+"</td>"+"<td>"+"Color"+"</td>"+"<td>"+"<p class='print-tr'id='st_save1' style=''>"+st_colour+"</p>"+"</td>"+"</tr>"+
                "<tr>"+"<td>"+"2."+"</td>"+"<td>"+"WBCs/ PUS cell"+"</td>"+"<td>"+"<p class='print-tr'id='st_save2' style=''>"+wbc_pus_cell+"</p>"+"</td>"+"</tr>"+
                "<tr>"+"<td>"+"3."+"</td>"+"<td>"+"RBC"+"</td>"+"<td>"+"<p class='print-tr'id='st_save3' style=''>"+st_rbcs +"</p>"+"</td>"+"</tr>"+
                "<tr>"+"<td>"+"4."+"</td>"+"<td>"+"Consistency"+"</td>"+"<td>"+"<p class='print-tr'id='st_save4' style=''>"+st_consistency+"</p>"+"</td>"+"</tr>"+
                "<tr>"+"<td>"+"5."+"</td>"+"<td>"+"Other"+"</td>"+"<td>"+"<p class='print-tr'id='st_save5' style=''>"+st_other+"</p>"+"</td>"+"</tr>"+
                "</tbody>"+
                "</table>" +"</div>";

                $("#printLogo").append(logo);

                $("#printPtInfo").append(result_title);

                $("#printResultTable").append(result_body+result_footer);

                $("#header_bar").hide();
                var st_save_id=[];
                for(var i=1;i<6;i++){
                  st_save_id[i]='st_save'+i;

                }
                for(var i=0;i<=st_save_id.length;i++)
                {
                  var st_data = st_save_id[i];
                  if(!$('#'+st_data).text() || $('#'+st_data).text()=="-")
                  $('#'+st_data).css('background-color','grey')
                }

                $("#app").hide();
                $("#hider0").hide();
                $("#hider1").hide();
                $("#hidden-title").hide();
                $("#header_bar").hide();
                $("#save-update-print").hide();

                $("#toshowResult").show();


                window.print();
                var ckUpdater = response[0][0]['name'];
                if(ckUpdater == 'updated')
                {
                  alert("We have updated the data");
                }
                else{
                  alert("We have collected test information of the patient.");
                }

                $("#app").show();
                $("#hider0").show();
                $("#hider1").show();
                $("#hidden-title").show();
                $("#header_bar").show();
                $("#save-update-print").show();

                $("#toshowResult").hide();
              }
            });
          }else{
            console.log("Cancel");
          }

    }else{
      // Validation to the ID
      setTimeout(function(){
        $("#noti_st").show();
        document.getElementById('noti_st').innerHTML="Please check the 'ID' or 'Results'.";
        document.getElementById('noti_st').style="background-color:red;";
      },500);
      setTimeout(function(){
        document.getElementById('noti_st').innerHTML="";
        $("#noti_st").hide();

      },5000);
    }
  }else{
    $("#noti").show();
    document.getElementById('noti').innerHTML="";
  }
}


//*******************************************************
function covidData(){

  var covidTest = 1;
  var cid = document.getElementById("cid").value;
  var created_by = document.getElementById("navbarDropdown").innerHTML;
  var agey = $("#agey").text();
  var agem = $("#agem").text
  agey = parseInt(agey);//changing to number
  agem = parseInt(agem);
  if(isNaN(agey)){
    agey=0;
  }
  if(isNaN(agem)){
    agem=0;
  }
  var gender = $("#gender").text();
  gender= String(gender);
  var fuchiaID = document.getElementById("fuchiaID").value;
  // var clinic = document.getElementById("clinic").innerHTML;
  var clinic = 81;
  var vDate = document.getElementById("vDate").value;
  vDate = formatDate(vDate); // date FormatChange YYYY/MM/DD
  var Ptype = $("#Ptype").text();
  var ext_sub = $("#ext").text();
  if(ext_sub.length<33){// the blank response from text count is 32
    ext_sub ="-";
  }
  var reqDoctor = document.getElementById("md").value;

  ////////////////////////////
  let co_Age                = document.getElementById('co_Age').value;
  let type_of_patient_covid = document.getElementById('type_of_patient_covid').value;
  let specimen_type         = document.getElementById('specimen_type').value;
  let co_test_type          = document.getElementById('co_test_type').value;
  let covid_result          = document.getElementById('covid_result').value;
  let co_comment            = document.getElementById('co_comment').value;
  let covid_lab_tech        = document.getElementById('covid_lab_tech').value;
  let covid_issue_date        = document.getElementById('covid_issue_date').value;
  covid_issue_date  = formatDate(covid_issue_date ); // date FormatChange YYYY/MM/DD
  let covidData={
    covidTest           :covidTest,
    cid                 :cid,
    fuchiaID            :fuchiaID,
    agey                :agey,
    agem                :agem,
    gender              :gender,
    vDate               :vDate,
    Ptype               :Ptype,
    ext_sub             :ext_sub,
    reqDoctor           :reqDoctor,
    clinic              :clinic,
    co_Age                 :co_Age,
    type_of_patient_covid  :type_of_patient_covid,
    specimen_type          :specimen_type ,
    co_test_type           :co_test_type,
    covid_result           :covid_result,
    covid_lab_tech         :covid_lab_tech,
    covid_issue_date       :covid_issue_date,

    created_by:created_by,
  };
  if(cid.length>8 && covid_lab_tech.length>2 && covid_result.length>2 && present==1){
      if (confirm("Are you sure you want to do save?")) {
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
          }
        });
        $.ajax({
          type:'POST',
          url:"{{route('tests')}}",
          dataType:'json',
          //processData:false,
          contentType: 'application/json',
          data: JSON.stringify(covidData),
          //data: rprDataset,
          success:function(response){
            $("#printLogo").empty();
            $("#printPtInfo").empty();
            $("#printResultTable").empty();
            // $("#app").hide();
            // $("#hider0").hide();
            // $("#hider1").hide();
            // $("#save-update-print").hide();
            // $( "#toshowResult" ).removeClass( "print-dispaly" );
            if(reqDoctor.length<1){
              reqDoctor= "__________";
            };

            if (covid_lab_tech <1){
              covid_lab_tech="_______";
            };

            if (covid_issue_date  <1){
              covid_issue_date ="_______";
            };

            if(fuchiaID.length < 1){
              fuchiaID = "__________"
            };

            if(Number.isNaN(agey))  {
              var ageys= "____";
            }else {
              var ageys=agey;
            };

            if(Number.isNaN(agem)){
              var agems="__";
            }else {
              var agems=agem;
            };
            ////console.log(co_test_type+"helo")
            ////console.log(covid_result+"delo")


            var logo =
            "<div class='row'>"+
            "<div class='d-flex justify-content-center' >"+

            "<h4  class='print-header clearfix'>"+  "<img src='/logoMAM.jpg'  alt='logo' style='width:70px;height:70px;'>"+
            "<p class='hiv-p'>"+"Covid-19 Test Result"+"</p>"+"</h4>"+
            "</div>"+
            "</div>";
            var result_title=
            "<div class='d-flex justify-content-center print-coheader-list'>"+
            "<ul class='clearfix' style='width:84%;padding-left: 5%;'>"+
            "<li class='first-li'>"+"ID:"+"</li>"+"<li>"+cid+","+"</li>"+

            "<li class='first-li'>"+"Fuchia ID:"+"</li>"+"<li>"+fuchiaID+","+"</li>"+
            // "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
            "<li class='first-li'>"+"Date:"+"</li>"+"<li>"+vDate+","+"</li>"+
            // "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
            "<li class='first-li'>"+"Age(Y):"+"</li>"+"<li>"+ageys+","+"</li>"+
            // "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
            "<li class='first-li'>"+"Age(M):"+"</li>"+"<li>"+agems+","+"</li>"+
            // "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
            "<li class='first-li'>"+"Sex:"+"</li>"+"<li>"+gender+","+"</li>"+
            "</ul>"+
            "</div>";
            var result_title_2=
            "<div class='d-flex justify-content-center print-coheader-list'>"+
            "<ul class='clearfix' style='width:84%;padding-left: 5%;'>"+
            "<li class='first-li'>"+"Type of Patient"+"</li>"+"<li>"+type_of_patient_covid+","+"</li>"+
            "<li class='first-li'>"+"Specimen Type"+"</li>"+"<li>"+specimen_type+","+"</li>"+
            "</ul>"+
            "</div>";
            var result_footer=
            "<div class='print-hiv-footer'>"
            +"<ul class='clearfix print-sti-footer'>"+
            "<li class='first-li'>"
            +"Requested Doctor:"+"</li>"+"<li>"+reqDoctor+","+"</li>"
            +
            "<li>"
            +"Issue by-:"+"</li>"+"<li>"+covid_lab_tech +","+"</li>"
            +
            "<li>"
            +"Issue Date :"+"</li>"+"<li>"+covid_issue_date+","+"</li>"
            +
            "</div>";


            var result_body = "<div class='d-flex justify-content-center' >"+"<table class='table  print-hiv-table'>"+
            "<thead>"+
            "<tr>"+"<td>"+"NO."+"</td>" +"<td>"+"Test Name"+"</td>"+"<td>"+"Result"+"</td>"+"</tr>"+
            "</thead>"+
            "<tbody>"+
            "<tr>"+"<td>"+"1."+"</td>"+"<td style='padding:0px'>"+"<p class='print-tr'id='covid_save1' style=''>"+co_test_type+"</p>"+"</td>"+"<td>"+"<p class='print-tr'id='covid_save2' style=''>"+covid_result+"</p>"+"</td>"+"</tr>"+
            "</tbody>"+
            "</table>" +"</div>";

            var covid_save_id=[];
            for(var i=1;i<3;i++){
              covid_save_id[i]='covid_save'+i;

            }

            for(var i=0;i<=covid_save_id.length;i++)
            {
              var covid_data = covid_save_id[i];
              ////console.log($('#'+covid_data).text());
              if(!$('#'+covid_data).text() || $('#'+covid_data).text()=="-"){
                ////console.log($('#'+covid_data).text()+"hello ");
                $('#'+covid_data).css('background-color','grey')

              }

            }


            $("#printLogo").append(logo);
            $("#printPtInfo").append(result_title);
            $("#printResultTable").append(result_title_2+result_body+result_footer);
            $("#header_bar").hide();

            var covid_save_id=[];
            for(var i=1;i<3;i++){
              covid_save_id[i]='covid_save'+i;

            }

            for(var i=0;i<=covid_save_id.length;i++)
            {
              var covid_data = covid_save_id[i];

              if(!$('#'+covid_data).text() || $('#'+covid_data).text()=="-"){

                $('#'+covid_data).css('background-color','grey')

              }

            }

            $("#app").hide();
            $("#hider0").hide();
            $("#hider1").hide();
            $('#save-update-print').hide();
            //  $( "#toshowResult" ).removeClass( "print-dispaly" );
            $( "#toshowResult" ).show();
            window.print();
            var ckUpdater = response[0][0]['name'];
            if(ckUpdater == 'updated')
            {
              alert("We have updated the data");
            }
            else{
              alert("We have collected test information of the patient.");
            }
            $("#app").show();
            $("#hider0").show();
            $("#hider1").show();
            $("#hidden-title").show();
            $("#toshowResult").hide();
            $("#save-update-print").show();
            $("#header_bar").show();
            //location.reload(true);// to refresh the page
          }
        });
      }else{
        console.log("Cancel");
      }

  }else{
    // Validation to the ID
    setTimeout(function(){
      $("#noti_covid").show();
      document.getElementById('noti_covid').innerHTML="Please check the 'ID' or 'Results'.";
      document.getElementById('noti_covid').style="background-color:red;";
    },500);
    setTimeout(function(){
      document.getElementById('noti_covid').innerHTML="";
      $("#noti_covid").hide();

    },5000);
  }
}
function covidUpdate(){
  var updated_by = document.getElementById("navbarDropdown").innerHTML;


  var cid = document.getElementById("cid").value;
  var agey = $("#agey").text();
  var agem = $("#agem").text
  agey = parseInt(agey);//changing to number
  agem = parseInt(agem);
  if(isNaN(agey)){
    agey=0;
  }
  if(isNaN(agem)){
    agem=0;
  }
  var gender = $("#gender").text();
  gender= String(gender);
  var fuchiaID = document.getElementById("fuchiaID").value;
  // var clinic = document.getElementById("clinic").innerHTML;
  var clinic = 81;
  var vDate = document.getElementById("vDate").value;
  vDate = formatDate(vDate); // date FormatChange YYYY/MM/DD
  var Ptype = $("#Ptype").text();
  var ext_sub = $("#ext").text();
  if(ext_sub.length<33){// the blank response from text count is 32
    ext_sub ="-";
  }
  var reqDoctor = document.getElementById("md").value;

  ////////////////////////////
  var co_Age                = document.getElementById('co_Age').value;
  var type_of_patient_covid = document.getElementById('type_of_patient_covid').value;
  var specimen_type         = document.getElementById('specimen_type').value;
  var co_test_type          = document.getElementById('co_test_type').value;
  var covid_result          = document.getElementById('covid_result').value;
  var co_comment            = document.getElementById('co_comment').value;
  var covid_lab_tech        = document.getElementById('covid_lab_tech').value;
  var covid_issue_date        = document.getElementById('covid_issue_date').value;
  covid_issue_date = formatDate(covid_issue_date); // date FormatChange YYYY/MM/DD

  if(save_update_covid == 10){
    var covidTest = 2;
    update_rowNo_covid= resp[9][0]['id'];
    var appUser = document.getElementById("navbarDropdown").innerHTML;// to collect app user from application nav bar
    var org_info = 'RowID->'+resp[9][0]['id']
    +',FuchiaID->' +resp[9][0]["fuchiacode"]
    + ',GeneralID->' +resp[9][0]["CID"]
    + ',Age(year)->' +resp[9][0]["agey"]
    + ',Age(mo)->' +resp[9][0]["agem"]
    + ',Gender->' +resp[9][0]["Gender"]
    + ',Visit Date->' +resp[9][0]["visit_date"]
    + ',Risk->' +resp[9][0]['Patient Type']
    + ',Sub risk->' +resp[9][0]['Patient Type Sub']
    + ',Requested Dr  ->' +resp[9][0]['Requested Doctor']
    +', co_Age ->' +resp[9][0]['co_Age']
    +', type_of_patient_covid ->' +resp[9][0]['type_of_patient_covid']
    +', specimen_type ->' +resp[9][0]['specimen_type']
    +', co_test_type ->' +resp[9][0]['co_test_type']
    +', covid_result ->' +resp[9][0]['covid_result']
    +', co_comment ->' +resp[9][0]['co_comment']
    +', covid_lab_tech ->' +resp[9][0]['covid_lab_tech']
    +', covid_issue_date ->' +resp[9][0]['covid_issue_date'];
    var updated_info ='FuchiaID->'+fuchiaID
    +',Age(year)->'+agey
    +',Age(mo)->'+agem
    +',Gender->'+gender
    +',Visit Date ->'+vDate
    +',Risk->'+Ptype
    +',Sub Risk->'+ext_sub
    +',MD ->'+reqDoctor
    +',Clinic->'+clinic
    +', co_Age->' +co_Age
    +', type_of_patient_covid ->' +type_of_patient_covid
    +', specimen_type ->' +specimen_type
    +', co_test_type ->' +co_test_type
    +', covid_result ->' +covid_result
    +', co_comment->' +co_comment
    +', covid_lab_tech ->' +covid_lab_tech
    +', covid_issue_date ->' +covid_issue_date ;

    var covidData={
      updated_info        :updated_info,
      org_info            :org_info,
      appUser             :appUser,
      update_rowNo_covid  :update_rowNo_covid,
      covidTest           :covidTest,

      cid                 :cid,
      fuchiaID            :fuchiaID,
      agey                :agey,
      agem                :agem,
      gender              :gender,
      vDate               :vDate,
      Ptype               :Ptype,
      ext_sub             :ext_sub,
      reqDoctor           :reqDoctor,
      clinic              :clinic,

      co_Age                 :co_Age,
      type_of_patient_covid  :type_of_patient_covid,
      specimen_type          :specimen_type ,
      co_test_type           :co_test_type,
      covid_result           :covid_result,
      covid_lab_tech         :covid_lab_tech,
      covid_issue_date       :covid_issue_date,

      updated_by              : updated_by,
    };
  }
  if(cid.length>8 && covid_lab_tech.length>2 && covid_result.length>2){
      if (confirm("Are you sure you want to do save?")) {
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
          }
        });
        $.ajax({
          type:'POST',
          url:"{{route('tests')}}",
          dataType:'json',
          //processData:false,
          contentType: 'application/json',
          data: JSON.stringify(covidData),
          //data: rprDataset,
          success:function(response){
            $("#printLogo").empty();
            $("#printPtInfo").empty();
            $("#printResultTable").empty();

            $("#app").hide();
            $("#hider0").hide();
            $("#hider1").hide();
            $("#save-update-print").hide();
            $( "#toshowResult" ).removeClass( "print-dispaly" );
            if(reqDoctor.length<1){
              reqDoctor= "__________";
            };

            if (covid_lab_tech <1){
              covid_lab_tech="_______";
            };

            if (covid_issue_date  <1){
              covid_issue_date ="_______";
            };

            if(fuchiaID.length < 1){
              fuchiaID = "__________"
            };

            if(Number.isNaN(agey))  {
              var ageys= "____";
            }else {
              var ageys=agey;
            };

            if(Number.isNaN(agem)){
              var agems="__";
            }else {
              var agems=agem;
            };


            var logo =
            "<div class='row'>"+
            "<div class='d-flex justify-content-center' >"+

            "<h4  class='print-header clearfix'>"+  "<img src='/logoMAM.jpg'  alt='logo' style='width:70px;height:70px;'>"+
            "<p class='hiv-p'>"+"Covid Test Result (Updated)"+"</p>"+"</h4>"+
            "</div>"+
            "</div>";
            var result_title=
            "<div class='d-flex justify-content-center print-coheader-list'>"+
            "<ul class='clearfix' style='width:84%;padding-left: 5%;'>"+
            "<li class='first-li'>"+"ID:"+"</li>"+"<li>"+cid+","+"</li>"+

            "<li class='first-li'>"+"Fuchia ID:"+"</li>"+"<li>"+fuchiaID+","+"</li>"+
            // "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
            "<li class='first-li'>"+"Date:"+"</li>"+"<li>"+vDate+","+"</li>"+
            // "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
            "<li class='first-li'>"+"Age(Y):"+"</li>"+"<li>"+ageys+","+"</li>"+
            // "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
            "<li class='first-li'>"+"Age(M):"+"</li>"+"<li>"+agems+","+"</li>"+
            // "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
            "<li class='first-li'>"+"Sex:"+"</li>"+"<li>"+gender+","+"</li>"+
            "</ul>"+
            "</div>";
            var result_title_2=
            "<div class='d-flex justify-content-center print-coheader-list'>"+
            "<ul class='clearfix' style='width:84%;padding-left: 5%;'>"+
            "<li class='first-li'>"+"Type of Patient"+"</li>"+"<li>"+type_of_patient_covid+","+"</li>"+
            "<li class='first-li'>"+"Specimen Type"+"</li>"+"<li>"+specimen_type+","+"</li>"+
            "</ul>"+
            "</div>";
            var result_footer=
            "<div class='print-hiv-footer'>"
            +"<ul class='clearfix print-sti-footer'>"+
            "<li class='first-li'>"
            +"Requested Doctor:"+"</li>"+"<li>"+reqDoctor+","+"</li>"
            // +
            // "<li class='first-li'>"
            // +"Counselor:"+"</li>"+"<li>"+rpr_counselor+","+"</li>"
            +
            // "Counselor ::"+counselor+
            "<li>"
            +"Issue by-:"+"</li>"+"<li>"+covid_lab_tech +","+"</li>"

            // "Issue by- "+lab_tech+
            +
            "<li>"
            +"Issue Date :"+"</li>"+"<li>"+covid_issue_date+","+"</li>"
            +
            // "Issue Date :"+issue_date+
            "</div>";

            //var result_header =;
            var result_body ="<div class='d-flex justify-content-center' >"+"<table class='table  print-hiv-table'>"+
            "<thead>"+
            "<tr>"+"<td>"+"NO."+"</td>" +"<td>"+"Test Name"+"</td>"+"<td>"+"Result"+"</td>"+"</tr>"+
            "</thead>"+
            "<tbody>"+
            "<tr>"+"<td>"+"1."+"</td>"+"<td style='padding:0px'>"+"<p class='print-tr'id='covid_save1' style=''>"+co_test_type+"</p>"+"</td>"+"<td>"+"<p class='print-tr'id='covid_save2' style=''>"+covid_result+"</p>"+"</td>"+"</tr>"+
            "</tbody>"+
            "</table>" +"</div>";

            var covid_save_id=[];
            for(var i=1;i<3;i++){
              covid_save_id[i]='covid_save'+i;

            }

            for(var i=0;i<=covid_save_id.length;i++)
            {
              var covid_data = covid_save_id[i];
              ////console.log($('#'+covid_data).text());
              if(!$('#'+covid_data).text() || $('#'+covid_data).text()=="-"){
                ////console.log($('#'+covid_data).text()+"hello ");
                $('#'+covid_data).css('background-color','grey')

              }

            }


            $("#printLogo").append(logo);
            $("#printPtInfo").append(result_title);
            $("#printResultTable").append(result_title_2+result_body+result_footer);
            $("#header_bar").hide();

            var covid_save_id=[];
            for(var i=1;i<3;i++){
              covid_save_id[i]='covid_save'+i;

            }

            for(var i=0;i<=covid_save_id.length;i++)
            {
              var covid_data = covid_save_id[i];

              if(!$('#'+covid_data).text() || $('#'+covid_data).text()=="-"){

                $('#'+covid_data).css('background-color','grey')

              }

            }
            $("#app").hide();
            $("#hider0").hide();
            $("#hider1").hide();
            $("#hidden-title").hide();
            $("#header_bar").hide();
            $("#save-update-print").hide();


            $("#toshowResult").show();
            window.print();
            var ckUpdater = response[0][0]['name'];
            if(ckUpdater == 'updated')
            {
              alert("We have updated the data");
            }
            else{
              alert("We have collected test information of the patient.");
            }
            $("#app").show();
            $("#hider0").show();
            $("#hider1").show();
            $("#hidden-title").show();
            $("#header_bar").show();
            $("#save-update-print").show();

            $("#toshowResult").hide();
          }
        });
      }else{
        console.log("Cancel");
      }
  }else{
    // Validation to the ID
    setTimeout(function(){
      $("#noti_covid").show();
      document.getElementById('noti_covid').innerHTML="Please check the 'ID' or 'Results'.";
      document.getElementById('noti_covid').style="background-color:red;";
    },500);
    setTimeout(function(){
      document.getElementById('noti_covid').innerHTML="";
      $("#noti_covid").hide();

    },5000);
  }
}

//*******************************************************
function viral_load(){
  var viral_loadTest = 1;
  var cid = document.getElementById("cid").value;
  var created_by = document.getElementById("navbarDropdown").innerHTML;
  var agey = $("#agey").text();
  var agem = $("#agem").text
  agey = parseInt(agey);//changing to number
  agem = parseInt(agem);
  if(isNaN(agey)){
    agey=0;
  }
  if(isNaN(agem)){
    agem=0;
  }
  var gender = $("#gender").text();
  gender= String(gender);
  var fuchiaID = document.getElementById("fuchiaID").value;
  // var clinic = document.getElementById("clinic").innerHTML;
  var clinic = 81;
  var vDate = document.getElementById("vDate").value;
  vDate = formatDate(vDate); // date FormatChange YYYY/MM/DD
  var Ptype = $("#Ptype").text();
  var ext_sub = $("#ext").text();
  if(ext_sub.length<33){// the blank response from text count is 32
    ext_sub ="-";
  }
  var reqDoctor = document.getElementById("md").value;
  //********************************************
  var art_initial_date_time = document.getElementById("art_initial_date_time").value;
  art_initial_date_time = formatDate(art_initial_date_time); // date FormatChange YYYY/MM/DD

  var art_duration = document.getElementById("art_duration").value;


  var sample_ship_date = document.getElementById("sample_ship_date").value;
  sample_ship_date = formatDate(sample_ship_date); // date FormatChange YYYY/MM/DD
  var sample_sent_to = document.getElementById("sample_sent_to").value;
  var result_received_date = document.getElementById("result_received_date").value;
  result_received_date = formatDate(result_received_date); // date FormatChange YYYY/MM/DD


  var  detectable= $("#detectable").val();
  if(detectable == "detectable"){
    var viral_load_result= $("#viral_load_result").val();

  }else{
    var viral_load_result= $("#viral_load_result_st").val();
  }

  var other_org_code = document.getElementById("other_org_code").value;
  var remark = document.getElementById("remark").value;
  update_rowNo=0;
  let viral_loadData={
    viral_loadTest      :viral_loadTest,
    cid                 :cid,
    fuchiaID            :fuchiaID,
    agey                :agey,
    agem                :agem,
    gender              :gender,
    vDate               :vDate,
    Ptype               :Ptype,
    ext_sub             :ext_sub,
    reqDoctor           :reqDoctor,
    clinic              :clinic,

    art_initial_date_time:art_initial_date_time,
    art_duration        :art_duration,
    sample_ship_date    :sample_ship_date,
    sample_sent_to      :sample_sent_to,
    result_received_date:result_received_date,
    detectable          :detectable,
    viral_load_result   :viral_load_result,
    other_org_code      :other_org_code,
    remark              :remark,

    created_by          : created_by,

  };
  console.log(viral_load_result + "viral load result");
  if(cid.length>8 && viral_load_result.length >2 && present==1){
    if (confirm("Are you sure you want to do save?")) {
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
          }
        });
        $.ajax({
          type:'POST',
          url:"{{route('tests')}}",
          dataType:'json',
          //processData:false,
          contentType: 'application/json',
          data: JSON.stringify(viral_loadData),
          //data: rprDataset,
          success:function(response){
            $("#printLogo").empty();
            $("#printPtInfo").empty();
            $("#printResultTable").empty();
            // $("#app").hide();
            // $("#hider0").hide();
            // $("#hider1").hide();
            // $("#save-update-print").hide();
            // $( "#toshowResult" ).removeClass( "print-dispaly" );
            if(!result_received_date){
              result_received_date= "-"
            };
            if(viral_load_result==0){
              viral_load_result= "-"
            };
            if(reqDoctor.length<1){
              reqDoctor= "__________";
            };

            if (covid_lab_tech <1){
              covid_lab_tech="_______";
            };

            if (covid_issue_date  <1){
              covid_issue_date ="_______";
            };

            if(fuchiaID.length < 1){
              fuchiaID = "__________"
            };

            if(Number.isNaN(agey))  {
              var ageys= "____";
            }else {
              var ageys=agey;
            };

            if(Number.isNaN(agem)){
              var agems="__";
            }else {
              var agems=agem;
            };


            var logo =
            "<div class='row'>"+
            "<div class='d-flex justify-content-center' >"+

            "<h4  class='print-header clearfix'>"+  "<img src='/logoMAM.jpg'  alt='logo' style='width:70px;height:70px;'>"+
            "<p class='hiv-p'>"+"Covid-19 Test Result"+"</p>"+"</h4>"+
            "</div>"+
            "</div>";
            var result_title=
            "<div class='d-flex justify-content-center print-coheader-list'>"+
            "<ul class='clearfix' style='width:84%;padding-left: 5%;'>"+
            "<li class='first-li'>"+"ID:"+"</li>"+"<li>"+cid+","+"</li>"+

            "<li class='first-li'>"+"Fuchia ID:"+"</li>"+"<li>"+fuchiaID+","+"</li>"+
            // "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
            "<li class='first-li'>"+"Date:"+"</li>"+"<li>"+vDate+","+"</li>"+
            // "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
            "<li class='first-li'>"+"Age(Y):"+"</li>"+"<li>"+ageys+","+"</li>"+
            // "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
            "<li class='first-li'>"+"Age(M):"+"</li>"+"<li>"+agems+","+"</li>"+
            // "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
            "<li class='first-li'>"+"Sex:"+"</li>"+"<li>"+gender+","+"</li>"+
            "</ul>"+
            "</div>";
            var result_title_2=
            "<div class='d-flex justify-content-center print-coheader-list'>"+
            "<ul class='clearfix' style='width:84%;padding-left: 5%;'>"+
            "<li class='first-li'>"+"ART_initial_date_time"+"</li>"+"<li>"+art_initial_date_time+","+"</li>"+
            "<li class='first-li'>"+"ART_duration"+"</li>"+"<li>"+art_duration+","+"</li>"+
            "<li class='first-li'>"+"Sample_ship_date"+"</li>"+"<li>"+sample_ship_date+","+"</li>"+
            "<li class='first-li'>"+"Sample_sent_to"+"</li>"+"<li>"+sample_sent_to+","+"</li>"+
            "<li class='first-li'>"+"Other_org_code"+"</li>"+"<li>"+other_org_code+","+"</li>"+

            "</ul>"+
            "</div>";
            var result_footer=
            "<div class='print-hiv-footer'>"
            +"<ul class='clearfix print-sti-footer'>"+
            "<li class='first-li'>"
            +"Requested Doctor:"+"</li>"+"<li>"+reqDoctor+","+"</li>"
            +
            //  "<li>"
            //  +"Issue by-:"+"</li>"+"<li>"+covid_lab_tech +","+"</li>"
            //  +
            //  "<li>"
            //  +"Issue Date :"+"</li>"+"<li>"+covid_issue_date+","+"</li>"
            //  +
            "</div>";


            var result_body = "<div class='d-flex justify-content-center' >"+"<table class='table  print-hiv-table'>"+
            "<thead>"+
            "<tr>"+"<td>"+"NO."+"</td>" +"<td>"+"Result Received Date"+"</td>"+"<td>"+"Viral_Load_Result"+"</td>"+"</tr>"+
            "</thead>"+
            "<tbody>"+
            "<tr>"+"<td>"+"1."+"</td>"+"<td style='padding:0%'>"+"<p class='print-tr'id='viral_save1' style=''>"+result_received_date+"</p>"+"</td>"+
            "<td>"+"<p class='print-tr'id='viral_save2' style=''>"+viral_load_result+"</p>"+"</td>"+"</tr>"+
            "</tbody>"+
            "</table>" +"</div>";

            $("#printLogo").append(logo);
            $("#printPtInfo").append(result_title);
            $("#printResultTable").append(result_title_2+result_body+result_footer);
            $("#header_bar").hide();
            ////console.log(result_received_date+"    viral date");
            ////console.log(viral_load_result+"    viral result");
            var viral_save_id=[];
            for(var i=1;i<3;i++){
              viral_save_id[i]='viral_save'+i;

            }
            for(var i=0;i<=viral_save_id.length;i++)
            {
              var viral_data = viral_save_id[i];
              if(!$('#'+viral_data).text() || $('#'+viral_data).text()=="-")
              $('#'+viral_data).css('background-color','grey')
            }
            $("#app").hide();
            $("#hider0").hide();
            $("#hider1").hide();
            $('#save-update-print').hide();
            //  $( "#toshowResult" ).removeClass( "print-dispaly" );
            $( "#toshowResult" ).show();
            window.print();
            var ckUpdater = response[0][0]['name'];
            if(ckUpdater == 'updated')
            {
              alert("We have updated the data");
            }
            else{
              alert("We have collected test information of the patient.");
            }
            $("#app").show();
            $("#hider0").show();
            $("#hider1").show();
            $("#hidden-title").show();
            $("#toshowResult").hide();
            $("#save-update-print").show();
            $("#header_bar").show();
            //location.reload(true);// to refresh the page
          }
        });

        }else{
          console.log("Cancel");
        }
    }else{
      // Validation to the ID
      setTimeout(function(){
        $("#noti_viral").show();
        document.getElementById('noti_viral').innerHTML="Please check the 'ID' or 'Results'.";
        document.getElementById('noti_viral').style="background-color:red;";
      },500);
      setTimeout(function(){
        document.getElementById('noti_viral').innerHTML="";
        $("#noti_viral").hide();

      },5000);
    }


}
function viral_loadUpdate(){
  var updated_by = document.getElementById("navbarDropdown").innerHTML;


  var viral_loadTest = 2;
  var cid = document.getElementById("cid").value;
  var agey = $("#agey").text();
  var agem = $("#agem").text
  agey = parseInt(agey);//changing to number
  agem = parseInt(agem);
  if(isNaN(agey)){
    agey=0;
  }
  if(isNaN(agem)){
    agem=0;
  }
  var gender = $("#gender").text();
  gender= String(gender);
  var fuchiaID = document.getElementById("fuchiaID").value;
  // var clinic = document.getElementById("clinic").innerHTML;
  var clinic = 81;
  var vDate = document.getElementById("vDate").value;
  vDate = formatDate(vDate); // date FormatChange YYYY/MM/DD
  var Ptype = $("#Ptype").text();
  var ext_sub = $("#ext").text();
  if(ext_sub.length<33){// the blank response from text count is 32
    ext_sub ="-";
  }
  var reqDoctor = document.getElementById("md").value;
  //********************************************
  var art_initial_date_time = document.getElementById("art_initial_date_time").value;
  art_initial_date_time = formatDate(art_initial_date_time); // date FormatChange YYYY/MM/DD

  var art_duration = document.getElementById("art_duration").value;


  var sample_ship_date = document.getElementById("sample_ship_date").value;
  sample_ship_date = formatDate(sample_ship_date); // date FormatChange YYYY/MM/DD
  var sample_sent_to = document.getElementById("sample_sent_to").value;
  var result_received_date = document.getElementById("result_received_date").value;
  result_received_date = formatDate(result_received_date); // date FormatChange YYYY/MM/DD


  var  detectable= $("#detectable").val();
  if(detectable == "Undetectable"){
    var viral_load_result= $("#viral_load_result_st").val();
  }else{
    var viral_load_result= $("#viral_load_result").val();
  }

  var other_org_code = document.getElementById("other_org_code").value;
  var remark = document.getElementById("remark").value;
  update_rowNo=0;


  update_rowNo_viralLoad= resp[10][0]['id'];
  var appUser = document.getElementById("navbarDropdown").innerHTML;// to collect app user from application nav bar
  var org_info = 'System_Row_ID->'+resp[10][0]['id']
  +',FuchiaID->' +resp[10][0]["fuchiacode"]
  + ',GeneralID->' +resp[10][0]["CID"]
  + ',Age(year)->' +resp[10][0]["agey"]
  + ',Age(mo)->' +resp[10][0]["agem"]
  + ',Gender->' +resp[10][0]["Gender"]
  + ',Risk->' +resp[10][0]['Main-Risk']
  + ',Sub risk->' +resp[10][0]['Sub-Risk']
  + ',Requested Dr  ->' +resp[10][0]['Requested Dr']

  +', ART_ini_date ->' +resp[10][0]['ART_ini_date']
  +', ART_duration ->' +resp[10][0]['ART_duration']
  +', Sample_Ship_Date ->' +resp[10][0]['Sample_Ship_Date']
  +', vdate ->' +resp[10][0]['vdate']
  +', Sample Sent to ->' +resp[10][0]['Sample Sent to']
  +', Result received date ->' +resp[10][0]['Result received date']
  +', Viral Load Result ->' +resp[10][0]['Viral Load Result']
  +', Other org code ->' +resp[10][0]['Other org code']
  +', Remark ->' +resp[10][0]['Remark'];

  var updated_info ='FuchiaID->'+fuchiaID
  +',Age(year)->'+agey
  +',Age(mo)->'+agem
  +',Gender->'+gender
  +',Visit Date ->'+vDate
  +',Risk->'+Ptype
  +',Sub Risk->'+ext_sub
  +',MD ->'+reqDoctor
  +',Clinic->'+clinic

  +',ART_ini_date->'+art_initial_date_time
  +',ART_duration->'+art_duration
  +',Sample_Ship_Date->'+sample_ship_date
  +',Sample Sent to->'+sample_sent_to
  +',Result received date->'+result_received_date
  +',Viral Load Result->'+viral_load_result
  +',Other org code->'+other_org_code
  +',Remark->'+remark;
  let viral_loadData={

    updated_info        :updated_info,
    org_info            :org_info,
    appUser             :appUser,
    update_rowNo_viralLoad  :update_rowNo_viralLoad,

    viral_loadTest      :viral_loadTest,
    cid                 :cid,
    fuchiaID            :fuchiaID,
    agey                :agey,
    agem                :agem,
    gender              :gender,
    vDate               :vDate,
    Ptype               :Ptype,
    ext_sub             :ext_sub,
    reqDoctor           :reqDoctor,
    clinic              :clinic,

    art_initial_date_time :art_initial_date_time,
    art_duration          :art_duration,
    sample_ship_date      :sample_ship_date,
    sample_sent_to        :sample_sent_to,
    result_received_date  :result_received_date,
    detectable          :detectable,
    viral_load_result     :viral_load_result,
    other_org_code        :other_org_code,
    remark                :remark,

    updated_by            :updated_by,

  };

  if(cid.length>8 && viral_load_result.length >2 ){
    if (confirm("Are you sure you want to do update?")) {
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
          }
        });
        $.ajax({
          type:'POST',
          url:"{{route('tests')}}",
          dataType:'json',
          //processData:false,
          contentType: 'application/json',
          data: JSON.stringify(viral_loadData),
          //data: rprDataset,
          success:function(response){
            $("#printLogo").empty();
            $("#printPtInfo").empty();
            $("#printResultTable").empty();
            // $("#app").hide();
            // $("#hider0").hide();
            // $("#hider1").hide();
            // $("#save-update-print").hide();
            // $( "#toshowResult" ).removeClass( "print-dispaly" );
            if(!result_received_date){
              result_received_date= "-"
            };
            if(viral_load_result==0){
              viral_load_result= "-"
            };
            if(reqDoctor.length<1){
              reqDoctor= "__________";
            };

            if (covid_lab_tech <1){
              covid_lab_tech="_______";
            };

            if (covid_issue_date  <1){
              covid_issue_date ="_______";
            };

            if(fuchiaID.length < 1){
              fuchiaID = "__________"
            };

            if(Number.isNaN(agey))  {
              var ageys= "____";
            }else {
              var ageys=agey;
            };

            if(Number.isNaN(agem)){
              var agems="__";
            }else {
              var agems=agem;
            };


            var logo =
            "<div class='row'>"+
            "<div class='d-flex justify-content-center' >"+

            "<h4  class='print-header clearfix'>"+  "<img src='/logoMAM.jpg'  alt='logo' style='width:70px;height:70px;'>"+
            "<p class='hiv-p'>"+"Viral Load Test Result(updated)"+"</p>"+"</h4>"+
            "</div>"+
            "</div>";
            var result_title=
            "<div class='d-flex justify-content-center print-coheader-list'>"+
            "<ul class='clearfix' style='width:84%;padding-left: 5%;'>"+
            "<li class='first-li'>"+"ID:"+"</li>"+"<li>"+cid+","+"</li>"+

            "<li class='first-li'>"+"Fuchia ID:"+"</li>"+"<li>"+fuchiaID+","+"</li>"+
            // "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
            "<li class='first-li'>"+"Date:"+"</li>"+"<li>"+vDate+","+"</li>"+
            // "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
            "<li class='first-li'>"+"Age(Y):"+"</li>"+"<li>"+ageys+","+"</li>"+
            // "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
            "<li class='first-li'>"+"Age(M):"+"</li>"+"<li>"+agems+","+"</li>"+
            // "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
            "<li class='first-li'>"+"Sex:"+"</li>"+"<li>"+gender+","+"</li>"+
            "</ul>"+
            "</div>";
            var result_title_2=
            "<div class='d-flex justify-content-center print-coheader-list'>"+
            "<ul class='clearfix' style='width:84%;padding-left: 5%;'>"+
            "<li class='first-li'>"+"ART_initial_date_time"+"</li>"+"<li>"+art_initial_date_time+","+"</li>"+
            "<li class='first-li'>"+"ART_duration"+"</li>"+"<li>"+art_duration+","+"</li>"+
            "<li class='first-li'>"+"Sample_ship_date"+"</li>"+"<li>"+sample_ship_date+","+"</li>"+
            "<li class='first-li'>"+"Sample_sent_to"+"</li>"+"<li>"+sample_sent_to+","+"</li>"+
            "<li class='first-li'>"+"Other_org_code"+"</li>"+"<li>"+other_org_code+","+"</li>"+

            "</ul>"+
            "</div>";
            var result_footer=
            "<div class='print-hiv-footer'>"
            +"<ul class='clearfix print-sti-footer'>"+
            "<li class='first-li'>"
            +"Requested Doctor:"+"</li>"+"<li>"+reqDoctor+","+"</li>"
            +
            //  "<li>"
            //  +"Issue by-:"+"</li>"+"<li>"+covid_lab_tech +","+"</li>"
            //  +
            //  "<li>"
            //  +"Issue Date :"+"</li>"+"<li>"+covid_issue_date+","+"</li>"
            //  +
            "</div>";


            var result_body ="<div class='d-flex justify-content-center' >"+"<table class='table  print-hiv-table'>"+
            "<thead>"+
            "<tr>"+"<td>"+"NO."+"</td>" +"<td>"+"Result Received Date"+"</td>"+"<td>"+"Viral_Load_Result"+"</td>"+"</tr>"+
            "</thead>"+
            "<tbody>"+
            "<tr>"+"<td>"+"1."+"</td>"+"<td style='padding:0%'>"+"<p class='print-tr'id='viral_save1' style=''>"+result_received_date+"</p>"+"</td>"+
            "<td>"+"<p class='print-tr'id='viral_save2' style=''>"+viral_load_result+"</p>"+"</td>"+"</tr>"+
            "</tbody>"+
            "</table>" +"</div>";

            $("#printLogo").append(logo);
            $("#printPtInfo").append(result_title);
            $("#printResultTable").append(result_title_2+result_body+result_footer);
            $("#header_bar").hide();
            ////console.log(result_received_date+"    viral date");
            ////console.log(viral_load_result+"    viral result");
            var viral_save_id=[];
            for(var i=1;i<3;i++){
              viral_save_id[i]='viral_save'+i;

            }
            for(var i=0;i<=viral_save_id.length;i++)
            {
              var viral_data = viral_save_id[i];
              if(!$('#'+viral_data).text() || $('#'+viral_data).text()=="-")
              $('#'+viral_data).css('background-color','grey')
            }
            $("#app").hide();
            $("#hider0").hide();
            $("#hider1").hide();
            $('#save-update-print').hide();
            //  $( "#toshowResult" ).removeClass( "print-dispaly" );
            $( "#toshowResult" ).show();
            window.print();
            var ckUpdater = response[0][0]['name'];
            if(ckUpdater == 'updated')
            {
              alert("We have updated the data");
            }
            else{
              alert("We have collected test information of the patient.");
            }
            $("#app").show();
            $("#hider0").show();
            $("#hider1").show();
            $("#hidden-title").show();
            $("#toshowResult").hide();
            $("#save-update-print").show();
            $("#header_bar").show();
            //location.reload(true);// to refresh the page
          }
        });

        }else{
          console.log("Cancel");
        }
    }else{
      // Validation to the ID
      setTimeout(function(){
        $("#noti_viral").show();
        document.getElementById('noti_viral').innerHTML="Please check the 'ID' or 'Results'.";
        document.getElementById('noti_viral').style="background-color:red;";
      },500);
      setTimeout(function(){
        document.getElementById('noti_viral').innerHTML="";
        $("#noti_viral").hide();

      },5000);
    }


}
//*******************************************************
function PatientType(){
  var type= document.getElementById('Ptype').value;
  if(ext.innerHTML!=null){
    ext.innerHTML="";
  }
  if(type == "Pregnant Mother"){
    var sel = document.getElementById('ext');
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

    opt1.value = "pp";
    opt2.value = "mp";
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

    var sel = document.getElementById('ext');
    // create new option element
    var opt0 = document.createElement("option");
    var opt1 = document.createElement("option");
    var opt2 = document.createElement("option");
    // create text node to add to option element (opt)
    opt0.appendChild( document.createTextNode(""));
    opt1.appendChild( document.createTextNode("HIV(Pos)"));
    opt2.appendChild( document.createTextNode("HIV(Neg)Woman"));
    // set value property of opt
    opt0.value = "";
    opt1.value = 1;
    opt2.value = 2;
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

    var sel = document.getElementById('ext');
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
    var sel = document.getElementById('ext');
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
    opt2.value = "youth";
    opt3.value = "otherLR";

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
    var sel = document.getElementById('ext');
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
    opt1.value = "fswpwid";
    opt2.value = "fswpwud";

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
    var sel = document.getElementById('ext');
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
    opt1.value = "msmpwid";
    opt2.value = "msmpwud";

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
    var sel = document.getElementById('ext');
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
    opt1.value = "pwidfsw";
    opt2.value = "pwidmsm";

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
    var sel = document.getElementById('ext');
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
    opt1.value = "tgpwid";
    opt2.value = "tgpwud";
    opt3.value = "tgsw";

    opt0.setAttribute('id','opt_tg_0');
    opt1.setAttribute('id','opt_tg_pwid');
    opt2.setAttribute('id','opt_tg_pwud');
    opt3.setAttribute('id','opt_tg_sg');

    sel.addEventListener("click", Ptypesub);

    // add opt to end of select box (sel)
    sel.appendChild(opt0);
    sel.appendChild(opt1);
    sel.appendChild(opt2);
    sel.appendChild(opt3);
    tg=1;
  }
  if(type == "Partner of KP"){
    var sel = document.getElementById('ext');
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
    opt0.value = 0;
    opt1.value = 1;
    opt2.value = 2;
    opt3.value = 3;
    opt4.value = 4;

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
    var sel = document.getElementById('ext');
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
    opt0.value = 0;
    opt1.value = 1;
    opt2.value = 2;
    opt3.value = 3;

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
    var lr_pwud = document.getElementById("opt_lr_youth").value;
    var lr_other = document.getElementById("opt_lr_youth").value;
    if(lr_youth != null){
      if(document.getElementById("opt_lr_youth").selected == true){Ptype_sub="Youth (15-24)";}
    }
    if(lr_pwud){
      if(document.getElementById("opt_lr_pwud").selected == true){Ptype_sub="PWUD";}
    }
    if(lr_other != null){
      if(document.getElementById("opt_lr_other").selected == true){Ptype_sub="Other Low Risk";}
    }
  }
  if(fsw == 1){
    var fswpwid = document.getElementById('opt_fsw_pwid').value;
    var fswpwud = document.getElementById('opt_fsw_pwud').value;
    if( fswpwid != null){
      if(document.getElementById("opt_fsw_pwid").selected == true){Ptype_sub="fswpwid";}
    }
    if(fswpwud != null){
      if(document.getElementById("opt_fsw_pwud").selected == true){Ptype_sub='fswpwud';}
    }
  }
  if(msm == 1){
    var msmpwid = document.getElementById("opt_msm_pwid").value;
    var msmpwud = document.getElementById("opt_msm_pwud").value;
    if(msmpwid){
      if(document.getElementById("opt_msm_pwid").selected == true){Ptype_sub="msmpwid";}
    }
    if(msmpwud){
      if(document.getElementById("opt_msm_pwud").selected == true){Ptype_sub="msmpwud";}
    }
  }
  if(idu == 1){
    var idu_fsw = document.getElementById("opt_idu_fsw").value;
    var idu_msm = document.getElementById("opt_idu_msm").value;
    if(idu_fsw != null){
      if(document.getElementById("opt_idu_fsw").selected == true){Ptype_sub="pwidfsw";}
    }
    if(idu_msm){
      if(document.getElementById("opt_idu_msm").selected == true){Ptype_sub="pwidmsm";}
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
    if(pkp_plhiv){
      if(document.getElementById("opt_pkp_plhiv").selected == true){Ptype_sub="Partener of PLHIV";}
    }
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
    if(sg_mig != null){
      if(document.getElementById("opt_sg_mig").selected == true){Ptype_sub="Migrant Population";}
    }
  }
  if(tg == 1){
    var tg_pwid =document.getElementById("opt_tg_pwid").value;
    var tg_pwud =document.getElementById("opt_tg_pwud").value;
    if(tg_pwid != null){
      if(document.getElementById("opt_tg_pwid").selected == true){Ptype_sub="tgpwid";}
    }
    if(tg_pwud != null){
      if(document.getElementById("opt_tg_pwud").selected == true){Ptype_sub="tgpwud";}
    }
  }
}
function next(){
  location.reload(true);
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
    ////console.log("month"+ age);
  }else{
    var age = curyear - useryear;
    ////console.log("age"+ age);
  }
  if((curmonth < usermonth) || ( (curmonth == usermonth) && curday < userday   )){
    age--;
  }

  return age;
}
function hideTab(hider){
  switch(hider) {
    case 1:
    document.getElementById('hivSave').disabled=false;
    $('#hider0').show();
    document.getElementById('updateTitle').innerHTML="";
    break;
    case 2:
    document.getElementById('rprSave').disabled=false;
    $('#hider0').show();
    document.getElementById('updateTitle').innerHTML="";
    break;
    case 3:
    document.getElementById('stiSave').disabled=false;
    $('#hider0').show();
    document.getElementById('updateTitle').innerHTML="";
    break;
    case 4:
    document.getElementById('hbcSave').disabled=false;
    $('#hider0').show();
    document.getElementById('updateTitle').innerHTML="";
    break;
    case 5:
    document.getElementById('urineSave').disabled=false;
    $('#hider0').show();
    document.getElementById('updateTitle').innerHTML="";
    break;
    case 6:
    document.getElementById('oiSave').disabled=false;
    $('#hider0').show();
    document.getElementById('updateTitle').innerHTML="";
    break;
    case 7:
    document.getElementById('gtSave').disabled=false;
    $('#hider0').show();
    document.getElementById('updateTitle').innerHTML="";
    break;
    case 8:
    document.getElementById('stoolSave').disabled=false;
    $('#hider0').show();
    document.getElementById('updateTitle').innerHTML="";
    break;
    case 9:
    document.getElementById('afbSave').disabled=false;
    $('#hider0').show();
    document.getElementById('updateTitle').innerHTML="";
    break;
    case 10:
    document.getElementById('covidSave').disabled=false;
    $('#hider0').show();
    document.getElementById('updateTitle').innerHTML="";
    break;
    case 11:
    document.getElementById('hivSave').disabled=false;
    $('#hider0').show();
    document.getElementById('updateTitle').innerHTML="";
    break;
    case 12:
    document.getElementById('hivSave').disabled=false;
    $('#hider0').hide();
    document.getElementById('updateTitle').innerHTML="";
    break;
    default:
    $('#hider0').show();
    document.getElementById('updateTitle').innerHTML="";


  }
}


var vdate_array =[];
var selected_Date=0;
// 1. test History -> 2. row_num() -> 3.updateFiller(testSection)
function row_num(){// to get row ID from follow up History
  var parent = event.target.parentElement.id;// collecting id of the targeted parent
  var coparent = document.getElementById(parent).parentElement.id;// collecti
  selected_Date = document.getElementById(coparent).childNodes[1].innerHTML;
  var drawData = 1;
  var ckdata = {
    drawData:drawData,
    PtID:PtID,
    selected_Date:selected_Date,
  };
  ////console.log(ckdata);
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
    }
  });
  $.ajax({
    type:'POST',
    url:"{{route('tests')}}",
    dataType:'json',
    contentType: 'application/json',
    data: JSON.stringify(ckdata),
    success:function(response){
      //console.log(response);
      resp = response;
      mainFiller(selected_Date);
    }
  });


}
// function location ( 12 ) to fill data in new form
function updateFiller(rowID,PtID,testSection){
  var toFill = 1;
  ////console.log(rowID,PtID,testSection);
  $("#hidden-title li a").removeClass("active");
  switch (testSection) {

    case "HIV":
    $("#hiv_tab").addClass("active");
    var test_name_tofill = "HIV";
    break;

    case "RPR":
    $("#rpr_tab").addClass("active");
    var test_name_tofill = "RPR";
    ////console.log("RPR");
    break;

    case "STI":
    $("#sti_tab").addClass("active");
    var test_name_tofill = "STI";
    ////console.log("STI");
    break;
    case "HBC":
    $("#bc_tab").addClass("active");
    var test_name_tofill = "HBC";
    ////console.log("HBC");
    break;

    case "Urine":
    $("#urine_tab").addClass("active");
    var test_name_tofill = "Urine";
    ////console.log("Urine");
    break;
    case "OI":
    $("#oi_tab").addClass("active");
    var test_name_tofill = "OI";
    ////console.log("OI");
    break;
    case "General":
    $("#gt_tab").addClass("active");
    var test_name_tofill = "General";
    ////console.log("General");
    break;
    case "Stool":
    $("#stool_tab").addClass("active");
    var test_name_tofill = "Stool";
    ////console.log("Stool");
    break;
    case "AFB":
    $("#afb_tab").addClass("active");
    var test_name_tofill = "AFB";
    ////console.log("AFB");
    break;
    case "Covid":
    $("#covid_tab").addClass("active");
    var test_name_tofill = "Covid";
    ////console.log("Covid");
    break;
    case "Viral_load":
    $("#viral_tab").addClass("active");
    var test_name_tofill = "Viral_load";
    ////console.log("Viral_load");
    break;

    default:

  }
  //var functionLoco=12;
  var ckdata = {  PtID:PtID,
    rowID:rowID,
    test_name_tofill:test_name_tofill,
    toFill:toFill,
  };
  ////console.log(ckdata);
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
    }
  });
  $.ajax({
    type:'POST',
    url:"{{route('tests')}}",
    dataType:'json',
    contentType: 'application/json',
    data: JSON.stringify(ckdata),
    success:function(response){
      ////console.log("the response text of resp title is ____"+response[0]);
      switch (response[0]) {
        case "HIV":
        resp = response;
        HivFiller(rowID,PtID,resp);
        break;
        case "RPR":
        resp = response;
        RprFiller(rowID,PtID,resp);
        break;
        case "STI":
        resp = response;
        StiFiller(rowID,PtID,resp);
        break;
        case "HBC":
        resp = response;
        HbcFiller(rowID,PtID,resp);
        break;
        case "Urine":
        resp = response;
        UrineFiller(rowID,PtID,resp);
        break;
        case "OI":
        resp = response;
        OiFiller(rowID,PtID,resp);
        break;
        case "General":
        resp = response;
        GtFiller(rowID,PtID,resp);
        break;
        case "Stool":
        resp = response;
        StoolFiller(rowID,PtID,resp);
        break;
        case "AFB":
        resp = response;
        AfbFiller(rowID,PtID,resp);
        break;
        case "Covid":
        resp = response;
        CovidFiller(rowID,PtID,resp);
        break;
        case "Viral_load":
        resp = response;
        Viral_load_Filler(rowID,PtID,resp);
        break;
        default:

      }



    }
  });




}
function testHistory(){
  var id_hist= $('#id_hist').val();
  PtID = id_hist;
  var getAllHistory = 1;
  var id_data={
    id_hist:id_hist,
    getAllHistory:getAllHistory,
  }

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
    }
  });

  $.ajax({
    type:'POST',
    url:"{{route('tests')}}",
    dataType:'json',
    contentType: 'application/json',
    data: JSON.stringify(id_data),

    success:function(response){
      resp = response;
      if(response[14].length>0){
        for (var i = 0; i < response[14].length; i++) {
          var rowName = "tr_hiv_"+i;
          var btnName = "btn_hiv_"+i;
          var srNum = i + 1;
          var testSection = "HIV";
          var tabName = "";
          vdate_array[i] = response[14][i];// Global array
          console.log(response[14]);
          var result_body1 =
          "<tr style='background-color:#A7DBD8;'"+ "id='"+rowName+"'>"
          +"<td id='updateSerial0'>"+srNum+"</td>"
          //+"<td >"+response[13][i]['id']+"</td>"
          +"<td >"+response[14][i]+"</td>"
          //+"<td>"+""+"</td>"
          +"<td id='"+btnName+"'>"+ "<a  data-toggle='tab'  onclick='row_num()' class='nav-link btn btn-warning'>"+" Update Data"+"</a>"+"</td>"
          +"</tr>";
          $("#testHistory").append(result_body1);
        }
      }
    }
  });
} // to show test history
function updateData(bton,resp,rowNo){
  switch (bton) {
    case 1:
    document.getElementById('updateTitle').innerHTML="Hiv Test Update";
    $('#hider0').show();
    break;
    case 2:
    document.getElementById('updateTitle').innerHTML="RPR Test Update";
    $('#hider0').show();
    RprFiller(resp,rowNo);
    break;
    case 3:
    document.getElementById('updateTitle').innerHTML="STI Test Update";
    $('#hider0').show();
    StiFiller(resp,rowNo);
    break;
    case 4:
    document.getElementById('updateTitle').innerHTML="Hep B/C Test Update";
    $('#hider0').show();
    HbcFiller(resp,rowNo);
    break;
    case 5:
    document.getElementById('updateTitle').innerHTML="Urine Test Update";
    $('#hider0').show();
    UrineFiller(resp,rowNo);
    break;
    case 6:
    document.getElementById('updateTitle').innerHTML="OI Test Update";
    $('#hider0').show();
    OiFiller(resp,rowNo);
    break;
    case 7:
    document.getElementById('updateTitle').innerHTML="General Test Update";
    $('#hider0').show();
    GtFiller(resp,rowNo);
    case 8:
    document.getElementById('updateTitle').innerHTML="Stool Test Update";
    $('#hider0').show();
    StoolFiller(resp,rowNo);
    break;
    case 9:
    document.getElementById('updateTitle').innerHTML="AFB Test Update";
    $('#hider0').show();
    AfbFiller(resp,rowNo);
    break;
    case 10:
    document.getElementById('updateTitle').innerHTML="Covid Test Update";
    $('#hider0').show();
    CovidFiller(resp,rowNo);
    break;
    default:
  }
}

// To Update Entry Fillers
function fillerDraw(rowID,PtID,testSection){
  var toFill = 1;
  ////console.log(rowID,PtID,testSection);
  $("#hidden-title li a").removeClass("active");
  switch (testSection) {

    case "HIV":
    $("#hiv_tab").addClass("active");
    var test_name_tofill = "HIV";
    break;

    case "RPR":
    $("#rpr_tab").addClass("active");
    var test_name_tofill = "RPR";
    ////console.log("RPR");
    break;

    case "STI":
    $("#sti_tab").addClass("active");
    var test_name_tofill = "STI";
    ////console.log("STI");
    break;
    case "HBC":
    $("#bc_tab").addClass("active");
    var test_name_tofill = "HBC";
    ////console.log("HBC");
    break;

    case "Urine":
    $("#urine_tab").addClass("active");
    var test_name_tofill = "Urine";
    ////console.log("Urine");
    break;
    case "OI":
    $("#oi_tab").addClass("active");
    var test_name_tofill = "OI";
    ////console.log("OI");
    break;
    case "General":
    $("#gt_tab").addClass("active");
    var test_name_tofill = "General";
    ////console.log("General");
    break;
    case "Stool":
    $("#stool_tab").addClass("active");
    var test_name_tofill = "Stool";
    ////console.log("Stool");
    break;
    case "AFB":
    $("#afb_tab").addClass("active");
    var test_name_tofill = "AFB";
    ////console.log("AFB");
    break;
    case "Covid":
    $("#covid_tab").addClass("active");
    var test_name_tofill = "Covid";
    ////console.log("Covid");
    break;
    case "Viral_load":
    $("#viral_tab").addClass("active");
    var test_name_tofill = "Viral_load";
    ////console.log("Viral_load");
    break;

    default:

  }
  //var functionLoco=12;
  var ckdata = {  PtID:PtID,
    rowID:rowID,
    test_name_tofill:test_name_tofill,
    toFill:toFill,
  };
  ////console.log(ckdata);
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
    }
  });
  $.ajax({
    type:'POST',
    url:"{{route('tests')}}",
    dataType:'json',
    contentType: 'application/json',
    data: JSON.stringify(ckdata),
    success:function(response){
      ////console.log("the response text of resp title is ____"+response[0]);
      switch (response[0]) {
        case "HIV":
        resp = response;
        HivFiller(rowID,PtID,resp);
        break;
        case "RPR":
        resp = response;
        RprFiller(rowID,PtID,resp);
        break;
        case "STI":
        resp = response;
        StiFiller(rowID,PtID,resp);
        break;
        case "HBC":
        resp = response;
        HbcFiller(rowID,PtID,resp);
        break;
        case "Urine":
        resp = response;
        UrineFiller(rowID,PtID,resp);
        break;
        case "OI":
        resp = response;
        OiFiller(rowID,PtID,resp);
        break;
        case "General":
        resp = response;
        GtFiller(rowID,PtID,resp);
        break;
        case "Stool":
        resp = response;
        StoolFiller(rowID,PtID,resp);
        break;
        case "AFB":
        resp = response;
        AfbFiller(rowID,PtID,resp);
        break;
        case "Covid":
        resp = response;
        CovidFiller(rowID,PtID,resp);
        break;
        case "Viral_load":
        resp = response;
        Viral_load_Filler(rowID,PtID,resp);
        break;
        default:

      }



    }
  });




}
function mainFiller(selected_Date){
  $("#hivUpdate").empty();
  $("#hider0").show();
  $("#hider1").show();
  console.log(resp);

  var headerOK="";
  for (var i = 0; i < resp.length; i++) {
    if(resp[i].length>0){
      switch (i) {
        case 0 :
        headerOK = "hiv";
        break;
        case 1 :
        headerOK = "rpr";
        break;
        case 2 :
        headerOK = "sti";
        break;
        case 3 :
        headerOK = "hbc";
        break;
        case 4 :
        headerOK = "urine";
        break;
        case 5 :
        headerOK = "oi";
        break;
        case 6 :
        headerOK = "general";
        break;
        case 7 :
        headerOK = "stool";
        break;
        case 8 :
        headerOK = "afb";
        break;
        case 9 :
        headerOK = "covid";
        break;
        case 10 :
        headerOK = "viral";
        break;
        default:
      }
      if(headerOK.length>2){
        i=12;
      }
    }
  }

  $('.nav-item a').css("background-color","");

  for (var i = 0; i < resp[0].length; i++) {
    $('#hiv_tab').css("background-color","red");
    save_update_hiv=1;
    if(resp[0][i]["Visit_date"]==selected_Date){
      if(headerOK == 'hiv'){
        document.getElementById('fuchiaID').value= resp[0][i]["fuchiacode"];
        document.getElementById('cid').value= resp[0][i]["CID"];
        document.getElementById('agey').innerHTML= resp[0][i]["agey"];
        document.getElementById('agem').innerHTML= resp[0][i]["agem"];
        document.getElementById('gender').innerHTML= resp[0][i]["Gender"];
        document.getElementById('vDate').value= resp[0][i]["Visit_date"];

        document.getElementById("Ptype").innerHTML=resp[0][i]["Patient_Type"];
        document.getElementById("ext").innerHTML=resp[0][i]["Patient Type Sub"];
        document.getElementById("md").value=resp[0][i]["Req_Doct"];
      }
      document.getElementById("lab_tech").value=resp[0][i]["LabTech"];
      document.getElementById("counselor").value=resp[0][i]["Counsellor"];
      document.getElementById("bcdate").value=resp[0][i]["bcollectdate"];
      document.getElementById("d_result").value=resp[0][i]["Detmine_Result"];
      document.getElementById("uni_result").value=resp[0][i]["Unigold_Result"];
      document.getElementById("stat_result").value=resp[0][i]["STAT_PAK_Result"];
      document.getElementById("final_result").value=resp[0][i]["Final_Result"];

      $("#hivSave").hide();
    }
  }
  for (var i = 0; i < resp[1].length; i++) {
    $('#rpr_tab').css("background-color","red");
    save_update_rpr=2;
    if(resp[1][i]["visit_date"]==selected_Date){

      if(headerOK=="rpr"){
        document.getElementById('fuchiaID').value= resp[1][i]["fuchiacode"];
        document.getElementById('cid').value= resp[1][i]["pid"];
        document.getElementById('agey').innerHTML= resp[1][i]["agey"];
        document.getElementById('agem').innerHTML= resp[1][i]["agem"];
        document.getElementById('gender').innerHTML= resp[1][i]["Gender"];
        document.getElementById('vDate').value= resp[1][i]["visit_date"];
        document.getElementById("Ptype").innerHTML=resp[1][i]["Type Of Patient"];
        document.getElementById("ext").innerHTML=resp[1][i]["Patient Type Sub"];
        document.getElementById("md").value=resp[1][i]["Req Dr"];
      }


      document.getElementById("Ptype").innerHTML=resp[1][i]["Type Of Patient"];
      document.getElementById("ext").innerHTML=resp[1][i]["Patient Type Sub"];
      document.getElementById("md").value=resp[1][i]["Req Dr"];
      document.getElementById("rpr_counselor").value=resp[1][i]["Counsellor"];


      document.getElementById("rdtYes_no").value      =resp[1][i]["RDT(Yes/No)"];
      document.getElementById("Sy_rdt_result").value  =resp[1][i]["RDT Result"];
      document.getElementById('Sy_rdt_result').disabled=false;
      document.getElementById("rprYes-NO").value      =resp[1][i]["Quantitative(Yes/No)"];
      document.getElementById("qualitative").value    =resp[1][i]["RPR Qualitative"];
      document.getElementById("qualitative").disabled=false;
      document.getElementById("titreCur").value       =resp[1][i]["Titre(current)"];
      document.getElementById("titreCur").disabled=false;
      document.getElementById("titreLast").value      =resp[1][i]["Titre(Last)"];
      document.getElementById("lastTitreDate").value  =resp[1][i]["TitreLastDate"];
      document.getElementById("rpr_lab_tech").value   =resp[1][i]["Lab Tech"];
      document.getElementById("rpr_issue_date").value =resp[1][i]["Issue Date"];

      $("#hivSave").hide();
    }
  }
  for (var i = 0; i < resp[2].length; i++) {
    $('#sti_tab').css("background-color","red");
    save_update_sti=3;
    if(resp[2][i]["visit_date"]==selected_Date){
      if(headerOK=="sti"){
        document.getElementById('fuchiaID').value= resp[2][i]["fuchiacode"];
        document.getElementById('cid').value= resp[2][i]["CID"];
        document.getElementById('agey').innerHTML= resp[2][i]["agey"];
        document.getElementById('agem').innerHTML= resp[2][i]["agem"];
        document.getElementById('gender').innerHTML= resp[2][i]["Gender"];
        document.getElementById('vDate').value= resp[2][i]["visit_date"];
        document.getElementById("Ptype").innerHTML=resp[2][i]["Type Of Patient"];
        document.getElementById("ext").innerHTML=resp[2][i]["Patient Type Sub"];
        document.getElementById("md").value=resp[2][i]["Requested Doctor"];
      }

      //var sex =resp[2];
      var sex=document.getElementById('gender').innerHTML

      if(sex == "Male"){
        document.getElementById('clue_post_fornix').disabled=true;
        document.getElementById('pmnl_endocevix').disabled=true;
        document.getElementById('pmnl_post_fix').disabled=true;
        document.getElementById('gram_intra_postfornix').disabled=true;
        document.getElementById('gram_intra_endo').disabled=true;
        document.getElementById('gram_extra_postfornix').disabled=true;
        document.getElementById('gram_extra_endo').disabled=true;
        document.getElementById('candida_postfornix').disabled=true;
        document.getElementById('candida_endo').disabled=true;
        document.getElementById('Sper_other_post').disabled=true;
        document.getElementById('Sper_other_endo').disabled=true;
      }

      //document.getElementById('vDate').value= resp[2][[i]]["visit_date"];

      //document.getElementById("Ptype").innerHTML=
      //document.getElementById("ext").innerHTML=
      //document.getElementById("md").value=resp[2][i][""];
      //document.getElementById("bcdate").value=resp[2][i][""];resp[1][[0]]['bcollectdate'];

      document.getElementById("clue_cells").value=resp[2][i]["Wet Mount clue cell"];//[[0]]['Wet Mount clue cell'];

      document.getElementById("clue_post_fornix").value=resp[2][i]["Fornix Clue Cells"];//]['Fornix Clue Cells'];
      //
      document.getElementById("pmnl_urethra").value=resp[2][i]["urethra WBC"];//]['urethra WBC'];
      document.getElementById("pmnl_post_fix").value=resp[2][i]["Fornix WBC"];//]['Fornix WBC'];
      document.getElementById("pmnl_endocevix").value=resp[2][i]["Endo cervix WBC"];//]['Endo cervix WBC'];
      document.getElementById("pmnl_rectum").value=resp[2][i]["Rectum WBC"];//]['Rectum WBC'];
      //
      document.getElementById("tricho_wet").value=resp[2][i]["Wet Mount Trichomonas"];//]['Wet Mount Trichomonas'];
      //
      document.getElementById("gram_intra_urethra").value=resp[2][i]["Urethra diplococci intra-cell"];//]['Urethra diplococci intra-cell'];
      document.getElementById("gram_intra_postfornix").value=resp[2][i]["Fornix diplococci intra-cell"];//]['Fornix diplococci intra-cell'];
      document.getElementById("gram_intra_endo").value=resp[2][i]["Endo cervix diplococci intra-cell"];//]['Endo cervix diplococci intra-cell'];
      document.getElementById("gram_intra_rectum").value=resp[2][i]["Rectum diplococci intra-cell"];//]['Rectum diplococci intra-cell'];
      //
      document.getElementById("gram_extra_urethra").value=resp[2][i]["Urethra diplococci extra-cell"];//]['Urethra diplococci extra-cell'];
      document.getElementById("gram_extra_postfornix").value=resp[2][i]["Fornix diplococci extra-cell"];//]['Fornix diplococci extra-cell'];
      document.getElementById("gram_extra_endo").value=resp[2][i]["Endo cervix diplococci extra-cell"];//]['Endo cervix diplococci extra-cell'];
      document.getElementById("gram_extra_rectum").value=resp[2][i]["Rectum diplococci extra-cell"];//]['Rectum diplococci extra-cell'];
      //
      document.getElementById("candida_wet").value=resp[2][i]["Wet Mount candida"];//]['Wet Mount candida'];
      document.getElementById("candida_urethra").value=resp[2][i]["Urethra Candida"];//]['Urethra Candida'];
      document.getElementById("candida_postfornix").value=resp[2][i]["Fornix Candida"];//]['Fornix Candida'];
      document.getElementById("candida_endo").value=resp[2][i]["Endo cervix Candida"];//]['Endo cervix Candida'];
      //
      document.getElementById("Sper_other_wet").value=resp[2][i]["wetoth"];//]['wetoth'];
      document.getElementById("Sper_other_urethra").value=resp[2][i]["uoth"];//]['uoth'];
      document.getElementById("Sper_other_post").value=resp[2][i]["pfother"];//]['pfother'];
      document.getElementById("Sper_other_endo").value=resp[2][i]["eother"];//]['eother'];
      document.getElementById("Sper_other_rectum").value=resp[2][i]["rother"];//]['rother'];
      //
      document.getElementById("urine_exam_done").value=resp[2][i]["First Per Urine"];//]['First Per Urine'];
      document.getElementById("epithelial_cell").value=resp[2][i]["Epithelial cells"];//]['Epithelial cells'];
      //
      document.getElementById("intra_cell").value=resp[2][i]["First Per Urine Diplococci Intra-Cell"];//]['First Per Urine Diplococci Intra-Cell'];
      document.getElementById("pmnl_cell").value=resp[2][i]["PMNL cells"];//]['PMNL cells'];
      //
      document.getElementById("extra_cell").value=resp[2][i]["First Per Urine Diplococci Extra-Cell"];//]['First Per Urine Diplococci Extra-Cell'];
      //
      document.getElementById("other_baceria").value=resp[2][i]["Other Bacteria"];//]['Other Bacteria'];
      //let  oth_bact= document.getElementById("other_baceria").value;
      //

      document.getElementById("epithelial_cell").disabled=false;//]['Epithelial cells'];
      //
      document.getElementById("intra_cell").disabled=false;//]['First Per Urine Diplococci Intra-Cell'];
      document.getElementById("pmnl_cell").disabled=false;//]['PMNL cells'];
      //
      document.getElementById("extra_cell").disabled=false;//]['First Per Urine Diplococci Extra-Cell'];
      //
      document.getElementById("other_baceria").disabled=false;//]['Other Bacteria'];


      document.getElementById("sti_lab_tech").value=resp[2][i]["Lab Techanician"];//]['Lab Techanician'];
      document.getElementById("sti_issueDate").value=resp[2][i]["idate"];

      $("#hivSave").hide();
    }
  }
  for (var i = 0; i < resp[3].length; i++) {
    $('#bc_tab').css("background-color","red");
    save_update_hbc=4;
    if (headerOK=="hbc") {
      document.getElementById('fuchiaID').value= resp[3][i]["fuchiacode"];
      document.getElementById('cid').value= resp[3][i]["CID"];
      document.getElementById('agey').innerHTML= resp[3][i]["agey"];
      document.getElementById('agem').innerHTML= resp[3][i]["agem"];
      document.getElementById('gender').innerHTML= resp[3][i]["Gender"];
      document.getElementById('vDate').value= resp[3][i]["Visit_date"];
      document.getElementById("Ptype").innerHTML=resp[3][i]["Patient_Type"];
      document.getElementById("ext").innerHTML=resp[3][i]["Patient Type Sub"];
      document.getElementById("md").value=resp[3][i]["Requested Doctor old"];
    }


    document.getElementById("hepB").value=resp[3][i]["HepB Test"];//['HepB Test'];
    document.getElementById("B_result").value=resp[3][i]["HepB Result"];//['HepB Result'];

    document.getElementById("c_test").value=resp[3][i]["HepC Test"];//['HepC Test'];
    document.getElementById("c_result").value=resp[3][i]["HepC Result"];//['HepC Result'];
    document.getElementById("C_lab_tech").value=resp[3][i]["Lab Tech"];//['Lab Tech'];
    document.getElementById("C_issueDate").value=resp[3][i]['Issue Date'];

    document.getElementById("B_result").disabled=false;
    document.getElementById("c_result").disabled=false;
  }
  for (var i = 0; i < resp[4].length; i++) {
    $('#urine_tab').css("background-color","red");
    save_update_urine=5;
    if(headerOK=="urine"){
      document.getElementById('fuchiaID').value= resp[4][i]["fuchiacode"];//
      document.getElementById('cid').value= resp[4][i]["CID"];
      document.getElementById('agey').innerHTML= resp[4][i]["agey"];
      document.getElementById('agem').innerHTML= resp[4][i]["agem"];
      document.getElementById('gender').innerHTML= resp[4][i]["Gender"];
      document.getElementById('vDate').value= resp[4][i]["visitDate"];
      document.getElementById("Ptype").innerHTML=resp[4][i]["Main Risk"];
      document.getElementById("ext").innerHTML=resp[4][i]["Sub Risk"];
      document.getElementById("md").value=resp[4][i]["Requested Dr"];
    }
    document.getElementById("Utot").value=resp[4][i]["Utot"];//[0]['Utot'];
    //document.getElementById("Ucolor").value=resp[1]//[0]['Ucolor'];
    document.getElementById("Uapp").value=resp[4][i]["Uapp"];//[0]['Uapp'];
    document.getElementById("tubitity").value=resp[4][i]["Ucolor"];//[0]['Ucolor'];
    document.getElementById("Upus").value=resp[4][i]["Upus"];//[0]['Upus'];
    document.getElementById("ph").value=resp[4][i]["ph"];//[0]['ph'];
    document.getElementById("Uprotein").value=resp[4][i]["Uprotein"];//[0]['Uprotein'];
    document.getElementById("Uglucose").value=resp[4][i]["Uglucose"];//[0]['Uglucose'];
    document.getElementById("Urbc").value=resp[4][i]["Urbc"];//[0]['Urbc'];
    document.getElementById("Uleu").value=resp[4][i]["Uleu"];//[0]['Uleu'];
    document.getElementById("Unitrite").value=resp[4][i]["Unitrite"];//[0]['Unitrite'];
    document.getElementById("ketone").value=resp[4][i]["ketone"];//[0]['Uketone'];
    document.getElementById("Uepithelial").value=resp[4][i]["Uepithelial"];//[0]['Uepithelial'];
    document.getElementById('Urobili').value=resp[4][i]["Urobili"];//[0]['Urobili'];
    document.getElementById('Ubiliru').value=resp[4][i]["Ubiliru"]//[0]['Ubillru'];
    document.getElementById('Uery').value=resp[4][i]["Uery"];//[0]['Uery'];
    document.getElementById('Ucrystal').value=resp[4][i]["Ucrystal"];//[0]['Ucrystal'];
    document.getElementById('Uhae').value=resp[4][i]["Uhae"];//[0]['Uhae'];
    document.getElementById('Uother').value=resp[4][i]["Uother"];//[0]['Uother'];
    document.getElementById('Ucast').value=resp[4][i]["Ucast"];//[0]['Ucast'];
    document.getElementById('Ument').value=resp[4][i]["Ument"];//[0]['comment'];

    document.getElementById('cretinine').value=resp[4][i]["Cretinine"];//[0]['Cretinine'];
    document.getElementById('albumin').value=resp[4][i]["Albumin"];//[0]['Albumin'];
    document.getElementById('a_c_ratio').value=resp[4][i]["A:C_ratio"];//[0]['A:C_ratio'];

    document.getElementById('u_lab_tech').value=resp[4][i]["lab_tech"];//[0]['lab_tech'];
    document.getElementById('u_issuDate').value=resp[4][i]["issue_date"];
  }
  for (var i = 0; i < resp[5].length; i++) {
    $('#oi_tab').css("background-color","red");
    console.log("oi tab background color");
    save_update_oi=6;
    if(headerOK=="oi"){
      document.getElementById('fuchiaID').value= resp[5][i]["fuchiacode"];
      document.getElementById('cid').value= resp[5][i]["CID"];
      document.getElementById('agey').innerHTML= resp[5][i]["agey"];
      document.getElementById('agem').innerHTML= resp[5][i]["agem"];
      document.getElementById('gender').innerHTML= resp[5][i]["Gender"];
      document.getElementById('vDate').value= resp[5][i]["visit_date"];
      document.getElementById("Ptype").innerHTML=resp[5][i]["Main Risk"];
      document.getElementById("ext").innerHTML=resp[5][i]["Sub Risk"];
      document.getElementById("md").value=resp[5][i]["Requested Doctor"];
    }
    document.getElementById('tb_lam').value=resp[5][i]["TB_LAM_Report"];
    document.getElementById('toxo_plasma').value=resp[5][i]["Toxo plasma"];//[0]['Toxo plasma'];
    document.getElementById('toxo_igG').value=resp[5][i]["Toxo igG"];//[0]['Toxo igG'];
    document.getElementById('toxo_igm').value=resp[5][i]["Toxo igM"];//[0]['Toxo igM'];

    document.getElementById('serum_cry_antigen').value=resp[5][i]["Serum Result"];//[0]['Serum Result'];
    document.getElementById('serum_cry_dil').value=resp[5][i]["serum_pos"];//[0]['serum_pos'];
    document.getElementById('csf_cry_antigen').value=resp[5][i]["CSF for Cryptococcal Antigen"];//[0]['Serum Result'];
    document.getElementById('csf_dil').value=resp[5][i]["csf_crypto_pos"];//[0]['serum_pos'];

    document.getElementById('csf_smear').value=resp[5][i]["csf_fungal"];//[0]['CSF Smear India Ink'];
    document.getElementById('giemsa_stain_result').value=resp[5][i]["CSF Smear Giemsa Stain"];//[0]['CSF Smear Giemsa Stain'];
    document.getElementById('india_ink_result').value=resp[5][i]["CSF Smear India Ink"];//[0]['lymph India Ink'];

    document.getElementById('skin_smear').value=resp[5][i]["skin_fungal"];//[0]['Skin Smear India Ink'];
    document.getElementById('skin_giemsa_stain_result').value=resp[5][i]["Skin Smear Giemsa Stain"];//[0]['lymph Giemsa Stain'];
    document.getElementById('skin_india_ink_result').value=resp[5][i]["Skin Smear India Ink"];//[0]['Skin Smear India Ink'];

    document.getElementById('lymph_test').value=resp[5][i]["lymph_test"];//[0][''];
    document.getElementById('lymph_giemsa_stain').value=resp[5][i]["lymph Giemsa Stain"];//[0]['lymph Giemsa Stain'];
    document.getElementById('lymph_india_ink').value=resp[5][i]["lymph India Ink"];//[0]['lymph India Ink'];


    //document.getElementById('oth_smear').value=resp[1][0]['other_Smear'];
    //document.getElementById('type_sample').value=resp[1][0]['sample_type'];


    //document.getElementById('gram_stain_result').value=resp[1][0]['other_gram'];
    document.getElementById('oi_lab_tech').value=resp[5][i]["Lab Techanician"];
    //document.getElementById('oi_issue_date').value=resp[5][i][""];

    document.getElementById('toxo_igG').disabled=false;
    document.getElementById('toxo_igm').disabled=false;
    document.getElementById('giemsa_stain_result').disabled=false;
    document.getElementById('india_ink_result').disabled=false;
    document.getElementById('skin_giemsa_stain_result').disabled=false;
    document.getElementById('skin_india_ink_result').disabled=false;
    document.getElementById('lymph_giemsa_stain').disabled=false;
    document.getElementById('lymph_india_ink').disabled=false;
   

  }
  for (var i = 0; i < resp[6].length; i++) {
    $('#gt_tab').css("background-color","red");
    save_update_gt=7;
    if(headerOK=="general"){
      document.getElementById('fuchiaID').value= resp[6][i]["fuchiacode"];
      document.getElementById('cid').value= resp[6][i]["CID"];
      document.getElementById('agey').innerHTML= resp[6][i]["agey"];
      document.getElementById('agem').innerHTML= resp[6][i]["agem"];
      document.getElementById('gender').innerHTML= resp[6][i]["Gender"];
      document.getElementById('vDate').value= resp[6][i]["Visit_date"];
      document.getElementById("Ptype").innerHTML=resp[6][i]["Patient_Type"];
      document.getElementById("ext").innerHTML=resp[6][i]["Patient Type Sub"];
      document.getElementById("md").value=resp[6][i]["Requested Doctor new"];
    }
    document.getElementById('dangue_rdt').value=resp[6][i]["Dangue RDT"];   // ['Dangue RDT'];
    document.getElementById('NS1_antigen').value=resp[6][i]["NS1 Antigen"];   // ['NS1 Antigen'];
    document.getElementById('igG').value=resp[6][i]["IgG Result"];   // ['IgG Result'];
    document.getElementById('igm').value=resp[6][i]["IgM Result"];   // ['IgM Result'];
    document.getElementById('malaria_rdt').value=resp[6][i]["Malaria RDT"];   // ['Malaria RDT'];
    document.getElementById('malaria_rdt_result').value=resp[6][i]["Malaria RDT Result"];  // ['Malaria RDT Result'];
    document.getElementById('malaria_microscopy').value=resp[6][i]["malaria_microscopy"];   // ['malaria_microscopy'];
    document.getElementById('mal_spec').value=resp[6][i]["Malaria_spec"];   // ['Malaria_spec'];
    document.getElementById('mal_grade').value=resp[6][i]["Malaria_grade"];   // ['Malaria_grade'];
    document.getElementById('mal_stage').value=resp[6][i]["Malaria_stage"];   // ['Malaria_stage'];
    //var malaria_microscopy  = mal_spec+mal_grade+mal_stage=resp[1] ;   // [''];

    //  document.getElementById('microscopy_result').value=resp[1] ;   // ['malaria_microscopy'];
    //document.getElementById('rbs').value=resp[16] ;   // ['RBS test'];
    document.getElementById('rbs_result').value=resp[6][i]["RBS"];   // ['RBS'];
    //document.getElementById('fbs').value=resp[18] ;   // ['FBS test'];
    document.getElementById('fbs_result').value=resp[6][i]["FBS"];   // ['FBS'];
    document.getElementById('haemoPercent').value=resp[6][i]["haemoglobin"];   // ['haemoglobin'];

    document.getElementById('hba1c').value=resp[6][i]["hba1c"];  // ['hba1c'];
    document.getElementById('gt_lab_tech').value=resp[6][i][""];   // ['Lab Tech'];
    // document.getElementById('gt_issue_date').value=resp[1][0]['Issue Date'];

    /*
    document.getElementById('gtSave').disabled=true;
    var btnCon_gt = document.getElementById('gtUpdate');
    // create new option element
    var btn_gt = document.createElement('button');
    btn_gt.setAttribute('name','editor');
    btn_gt.setAttribute('class','btn btn-warning btn-lg');
    btn_gt.setAttribute('id','btn_gt_update');
    btn_gt.innerHTML='Edit Data';
    btn_gt.addEventListener("click", gtSave);

    btnCon_gt.append(btn_gt); */
    document.getElementById('gtSave').disabled=true;

    document.getElementById('NS1_antigen').disabled=false;
    document.getElementById('igG').disabled=false;
    document.getElementById('igm').disabled=false;
    document.getElementById('malaria_rdt_result').disabled=false;
    document.getElementById('mal_spec').disabled=false;
    document.getElementById('mal_grade').disabled=false;
    document.getElementById('mal_stage').disabled=false;

  }
  for (var i = 0; i < resp[7].length; i++) {
    $('#stool_tab').css("background-color","red");
    save_update_st=8;
    update_rowNo_st= resp[7][0]['id'];
    if(headerOK=="stool"){
      document.getElementById('fuchiaID').value= resp[7][i]["fuchiacode"];
      document.getElementById('cid').value= resp[7][i]["CID"];
      document.getElementById('agey').innerHTML= resp[7][i]["agey"];
      document.getElementById('agem').innerHTML= resp[7][i]["agem"];
      document.getElementById('gender').innerHTML= resp[7][i]["Gender"];
      document.getElementById('vDate').value= resp[7][i]["visit_date"];
      document.getElementById("Ptype").innerHTML=resp[7][i]["Patient Type"];
      document.getElementById("ext").innerHTML=resp[7][i]["Patient Type Sub"];
      document.getElementById("md").value=resp[7][i]["Requested Doctor"];
    }
    document.getElementById('st_stool').value=resp[7][i]["st_stool"];  //['st_stool'];
    document.getElementById('st_colour').value=resp[7][i]["st_colour"];   //['st_colour'];
    document.getElementById('wbc_pus_cell').value=resp[7][i]["wbc_pus_cell"];   //['wbc_pus_cell'];
    document.getElementById('st_consistency').value=resp[7][i]["st_consistency"];   //['st_consistency'];
    document.getElementById('st_rbcs').value=resp[7][i]["st_rbcs"];   //['st_rbcs'];
    document.getElementById('st_other').value=resp[7][i]["st_other"];   //['st_other'];
    //document.getElementById('st_comment').value=resp[7][i][""];   //['st_comment'];
    document.getElementById('st_lab_tech').value=resp[7][i]["st_lab_tech"];  //['st_lab_tech'];
    document.getElementById('st_issue_date').value=resp[7][i][""]; ;


    document.getElementById('st_colour').disabled=false;
    document.getElementById('wbc_pus_cell').disabled=false;
    document.getElementById('st_consistency').disabled=false;
    document.getElementById('st_rbcs').disabled=false;
    document.getElementById('st_other').disabled=false;

    document.getElementById('mal_grade').disabled=false;
    document.getElementById('mal_stage').disabled=false;
  }
  for (var i = 0; i < resp[8].length; i++) {
    $('#afb_tab').css("background-color","red");
    save_update_afb=9;
    if(headerOK=="afb"){
      document.getElementById('fuchiaID').value= resp[8][i]["fuchiacode"];
      document.getElementById('cid').value= resp[8][i]["CID"];
      document.getElementById('agey').innerHTML= resp[8][i]["agey"];
      document.getElementById('agem').innerHTML= resp[8][i]["agem"];
      document.getElementById('gender').innerHTML= resp[8][i]["Gender"];
      document.getElementById('vDate').value= resp[8][i]["visit_date"];
      document.getElementById("Ptype").innerHTML=resp[8][i]["Patient Type"];
      document.getElementById("ext").innerHTML=resp[8][i]["Patient Type Sub"];
      document.getElementById("md").value=resp[8][i]["Requested Doctor"];
    }
    document.getElementById('afb_pt_name').innerHTML=resp[8][i]["afb_pt_name"];// encrypted data from PtConfig
    document.getElementById('afb_pt_address').innerHTML=resp[8][i]["afb_pt_address"];// encrypted data from PtConfig
    document.getElementById('Previous_TB').value=resp[8][i]["Previous_TB"]; //['Previous_TB'];
    document.getElementById('HIV_status').value=resp[8][i]["HIV_status"]; //['HIV_status'];
    document.getElementById('reason_for_exam').value=resp[8][i]["reason_for_exam"]; //['reason_for_exam'];
    document.getElementById('afb_Pt_type').value=resp[8][i]["afb_Pt_type"]; //['afb_Pt_type'];
    document.getElementById('follow_up_mt').value=resp[8][i]["follow_up_mt"]; //['follow_up_mt'];
    document.getElementById('speci_type').value=resp[8][i]["speci_type"]; //['speci_type'];
    document.getElementById('slide_num_1').value=resp[8][i]["slide_num_1"]; //['slide_num_1'];
    document.getElementById('slide_num_2').value=resp[8][i]["slide_num_2"]; //['slide_num_2'];
    //document.getElementById('speci_receive_dt1').value=resp[8][i][""];
    //  document.getElementById('speci_receive_dt2').value=resp[8][i][""];
    document.getElementById('visual_app_1').value=resp[8][i]["visual_app_1"]; //['visual_app_1'];
    document.getElementById('visual_app_2').value=resp[8][i]["visual_app_2"]; //['visual_app_2'];
    document.getElementById('afb_result1').value=resp[8][i]["afb_result1"]; //['afb_result1'];
    document.getElementById('afb_result2').value=resp[8][i]["afb_result2"]; //['afb_result2'];
    document.getElementById('sacnty_grading1').value=resp[8][i]["slide1_grading1"]; //['slide1_grading1'];
    document.getElementById('sacnty_grading2').value=resp[8][i]["slide2_grading2"]; //['slide2_grading2'];
    document.getElementById('afb_lab_tech').value=resp[8][i]["afb_lab_techca"]; //['afb_lab_techca'];
    //  document.getElementById('afb_issue_date').value=resp[8][i][""];
  }
  for (var i = 0; i < resp[9].length; i++) {
    $('#covid_tab').css("background-color","red");
    save_update_covid=10;
    if(headerOK=="covid"){
      document.getElementById('fuchiaID').value= resp[9][i]["fuchiacode"];
      document.getElementById('cid').value= resp[9][i]["CID"];
      document.getElementById('agey').innerHTML= resp[9][i]["agey"];
      document.getElementById('agem').innerHTML= resp[9][i]["agem"];
      document.getElementById('gender').innerHTML= resp[9][i]["Gender"];
      document.getElementById('vDate').value= resp[9][i]["Visit_date"];
      document.getElementById("Ptype").innerHTML=resp[9][i]["Patient Type"];
      document.getElementById("ext").innerHTML=resp[9][i]["Patient Type Sub"];
      document.getElementById("md").value=resp[9][i]["Requested Doctor"];
    }
    document.getElementById('co_Age').value=resp[9][i]["co_Age"];  //['co_Age'];
    document.getElementById('type_of_patient_covid').value=resp[9][i]["type_of_patient_covid"];  //['type_of_patient_covid'];
    document.getElementById('specimen_type').value=resp[9][i]["specimen_type"];  //['specimen_type'];
    document.getElementById('co_test_type').value=resp[9][i]["co_test_type"]; //['co_test_type'];
    document.getElementById('covid_result').value=resp[9][i]["covid_result"];  //['covid_result'];
    //document.getElementById('co_comment').value=resp[1];  //[''];
    document.getElementById('covid_lab_tech').value=resp[9][i]["covid_lab_tech"];//['covid_lab_tech'];
    //document.getElementById('covid_issue_date').value=resp[1][0]['covid_issue_date'];
  }
  for (var i = 0; i < resp[10].length; i++) {
    $('#viral_tab').css("background-color","red");
    save_update_viral=11;
    if(headerOK=="viral"){
      document.getElementById('fuchiaID').value= resp[10][i]["fuchiacode"];
      document.getElementById('cid').value= resp[10][i]["CID"];
      document.getElementById('agey').innerHTML= resp[10][i]["agey"];
      document.getElementById('agem').innerHTML= resp[10][i]["agem"];
      document.getElementById('gender').innerHTML= resp[10][i]["Gender"];
      document.getElementById('vDate').value= resp[10][i]["vdate"];
      document.getElementById("Ptype").innerHTML=resp[10][i]["Patient_Type"];
      document.getElementById("ext").innerHTML=resp[10][i]["Patient Type Sub"];
      document.getElementById("md").value=resp[10][i]["Req_Doct"];
    }
    document.getElementById("art_initial_date_time").value= resp[10][i]["ART_ini_date"];
    document.getElementById("art_duration").value= resp[10][i]["ART_duration"];
    document.getElementById("sample_ship_date").value= resp[10][i]["Sample_Ship_Date"];
    document.getElementById("sample_sent_to").value= resp[10][i]["Sample Sent to"];
    document.getElementById("result_received_date").value= resp[10][i]["Result received date"];


    document.getElementById("detectable").value= resp[10][i]["Detect"];
    if(resp[10][i]["Detect"] == "Detectable"){
      $("#div_of_viral_load").show();
      $("#div_of_viral_load_st").hide();
    }else{
      $("#div_of_viral_load_st").show();
      $("#div_of_viral_load").hide();
    }
    document.getElementById("viral_load_result").value= resp[10][i]["Viral Load Result"];
    document.getElementById("other_org_code").value= resp[10][i]["Other org code"];
    document.getElementById("remark").value= resp[10][i]["Remark"];

  }
  DateTo_text();


  $('#hivUpdate_btn').show();
  $('#rprUpdate_btn').show();
  $('#stiUpdate_btn').show();
  $('#hbcUpdate_btn').show();
  $('#urineUpdate_btn').show();
  $('#oiUpdate_btn').show();
  $('#gtUpdate_btn').show();
  $('#stUpdate_btn').show();
  $('#afbUpdate_btn').show();
  $('#covidUpdate_btn').show();
  $('#viralUpdate_btn').show();

  $('#hivSave').hide();
  $('#rprSave').hide();
  $('#stiSave').hide();
  $('#hbcSave').hide();
  $('#urineSave').hide();
  $('#oiSave').hide();
  $('#gtSave').hide();
  $('#stoolSave').hide();
  $('#afbSave').hide();
  $('#covidSave').hide();
  $('#viralSave').hide();
 }

function ageCal(){
  var bd_date = resp[3];
  var dateSplited = bd_date.split("-");
  var dtYear = dateSplited[0];
  var dtMonth = dateSplited[1];
  if(dtYear == year){
    agem = (month+1) - dtMonth;
    document.getElementById("agem").innerHTML= (month+1) - dtMonth;
  }else{
    agey = getAge(bd_date);
    document.getElementById("agey").innerHTML=getAge(bd_date);
  }
  ////console.log(resp);
  gender= resp[0]["Gender"];
}
function RBSResult() {

  var no = document.getElementById("rbs_result").value;
  if(no<9 || no>600) {
    alert("RBS result should have between 10 to 600");
    document.getElementById("rbs_result").value=" ";
  }
}
function FBSResult() {

  var no = document.getElementById("fbs_result").value;
  if(no<9 || no>600) {
    alert("FBS result should have between 10 to 600");
    document.getElementById("fbs_result").value=" ";
  }
}
function haemo(){

  var  hae= document.getElementById("haemoPercent").value;
  if(hae < 1 || hae > 20) {
    alert("haemoPercent result should have between 1 to 20");
    document.getElementById("haemoPercent").value="";
  }
}
function dateOver(date_verify){
  switch(date_verify) {
    case 1:
    var vDate = $("#vDate").val();
    var idInsert = "vDate";
    break;
    case 2:
    var vDate = $("#bcdate").val();
    var idInsert = "bcdate";
    break;
    case 3:
    var vDate = $("#issue_date").val();
    var idInsert = "issue_date";
    break;
    case 4:
    var vDate = $("#rpr_issue_date").val();
    var idInsert = "rpr_issue_date";
    break;
    case 5:
    var vDate = $("#C_issueDate").val();
    var idInsert = "C_issueDate";
    break;
    case 6:
    var vDate = $("#sti_issueDate").val();
    var idInsert = "sti_issueDate";
    break;
    case 7:
    var vDate = $("#u_issuDate").val();
    var idInsert = "u_issuDate";
    break;
    case 8:
    var vDate = $("#oi_issue_date").val();
    var idInsert = "oi_issue_date";
    break;
    case 9:
    var vDate = $("#gt_issue_date").val();
    var idInsert = "gt_issue_date";
    break;
    case 11:
    var vDate = $("#afb_issue_date").val();
    var idInsert = "afb_issue_date";
    break;
    case 12:
    var vDate = $("#covid_issue_date").val();
    var idInsert = "covid_issue_date";
    break;
    case 13:
    var vDate = $("#speci_receive_dt1").val();
    var idInsert = "speci_receive_dt1";
    break;
    case 14:
    var vDate = $("#speci_receive_dt2").val();
    var idInsert = "speci_receive_dt2";
    break;
    default:
    // code block
  }


  
  var date = new Date();
	  var day = date.getDate();
	  var month = date.getMonth() + 1;
	  var year = date.getFullYear();
	  if (month < 10) month = "0" + month;
	  if (day < 10) day = "0" + day;
	  var today = year + "-" + month + "-" + day;

	  var vDate = vDate.split("-");
   var firstDate=vDate[0];
  if(firstDate.length<3){
    var day_input   = vDate[0];
	  var month_input = vDate[1];
	  var year_input  = vDate[2];
    if(day_input.length==1){
      day_input="0"+day_input;      
    }
    if(month_input.length==1){
      month_input="0"+month_input;
    }
    if(year_input.length==2){
      year_input="20"+year_input;
    }

  }else if(firstDate.length>3){
    var day_input   = vDate[2];
	  var month_input = vDate[1];
	  var year_input  = vDate[0];
  }
  var datetarget=event.target.id;
  console.log(datetarget+"date target is here");

  $("#"+datetarget).val(year_input+"-"+month_input+"-"+day_input);

	 

	    if(year_input >=  year){
	          if(year_input > year){
	            alert("Input Year is greater than current Year.");
	            document.getElementById(idInsert).value=today;
	          }
	          if(year_input == year){
	            if(month_input > month){
	              alert("Input Month is greater than current Month.");
	              document.getElementById(idInsert).value=today;
	            }
	          }
	          if(month_input == month){
	            if(day_input > day){
	              alert("Input Day is greater than current Day.");
	              document.getElementById(idInsert).value=today;
	            }
	          }
	    }else{
	        if(year_input < 2009){
	          alert("Date input is less than 2009");
	          document.getElementById(idInsert).value=today;
	        }
	    }

}
function art_duration_month(date){

  var art_date = document.getElementById("art_initial_date_time").value;
  art_date = formatDate(art_date);
  //console.log("art date "+ art_date);

  var dateSplited = art_date.split("-");
  var year1 = dateSplited[0];
  var month1 = dateSplited[1];
  var day1 = dateSplited[2];


  var date = new Date();
  var day2 = date.getDate();
  var month2 = date.getMonth() + 1;
  var year2 = date.getFullYear();

  var diffMonths = (year2 - year1) * 12 + (month2 - month1);

  if (day2 < day1) {
    diffMonths--;
  }
  document.getElementById("art_duration").value=diffMonths;

}
function wd_reload(){
  location.reload(true);
}

function viral_load_detect(){

  var  detectable= $("#detectable").val();
  if(detectable == "Undetectable"){

    console.log("undetectable"+detectable);
    $("#div_of_viral_load_st").show();
    $("#div_of_viral_load").hide();
  }else{
    $("#div_of_viral_load").show();
    $("#div_of_viral_load_st").hide();
  }
}

function titre(){
  var rpr_reactive = $("#qualitative").val();
  if(rpr_reactive == "Reactive"){
    document.getElementById("titreCur").disabled=false;
  }else{
    document.getElementById("titreCur").disabled=true;
  }


}
</script>

@extends('layouts.app')
@section('content')
@auth
<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('js/jquery-ui.min.js')}}"></script>
<script src="{{asset('js/ncd.js')}}"></script>
<!-- Nav pills -->
<div class="container containers">
  <ul class="nav nav-tabs toggle  ncd-list" id="hidden-title" >
        <li class="nav-item">
          <a class="nav-link active toggle-link " data-toggle="tab" href="#ncdRegister" >NCD Register</a>
        </li>
        <li class="nav-item">
          <a class="nav-link toggle-link " data-toggle="tab" href="#ncd_export" >Ncd Export</a>
        </li>
  </ul>
  <div class="tab-content page-color">
    
    <div class="tab-pane ncd-Section active" id="ncdRegister" >
        <div id="ncd_followList" class="ncd-followList">
          <div class="row no-margin">
            <h2>NCD Follow Up History
            	<button class="btn ncd-cancelBtn" id="ncd_followCancel" onclick="Follow_cancel()" style="float: right;background-color: beige;">To Register</button>
            </h2>
            <div class="col-sm-2 follow_id no-margin">No.</div>
            <div class="col-sm-3 follow_general no-margin">General ID</div>
            <div class="col-sm-3 follow_general no-margin">Visit Date</div>
            <div class="col-sm-2 follow_general no-margin"></div>
            <div class="col-sm-2 follow_general no-margin"></div>
            
          </div>
          
        </div>
      <div id="ncd_existing" >
        <div class="header-text">
          <h2></h2>
          <div class="ncd_followTime">
            <h2></h2>
          </div>
          <button  class="btn btn-info ncd_followview" id="ncd_followView">Follow up History</button>
          <button  class="btn btn-info ncd_Addfollow" id="ncd_followAdd">Add Follow Up</button> 
          <button class="btn btn-warning ncd-refresh" onclick="next()">Next Patient</button>
        </div><!-- header -->
        <div class="row">
          <div class="col-sm-3 ncd_RIdchange">
            <input type="checkbox" value="ncd Reg Id change" id="ncd_regIDchange">
            <label class="form-label">Register ID change?</label>
          </div>
          <div class="col-sm-9"><label class="form-label follow_timeLabel"></label></div>
        </div>

        <div class="ncd-generalInfo">
          <div class="row">
            <div class="col-sm-6">
              <div class="input-group mb-3 ncd-generalCode">
                <input type="number" id="ncd_pid" class="form-control" placeholder="General ID">
                <input type="text" id="ncd_fid" class="form-control" placeholder="Fuchia ID">
                <div class="input-group-append no-margin">
                  <button class="btn btn-primary" onclick="findncd_patient()" type="button">Search</button>
                </div>
              </div>
            </div>
            <div class="col-sm-2">
              <label class="form-label">NCD Reg_Age</label>
              <span  class="form-control" id="age_visit"></span>
            </div>
            {{-- <div class="col-sm-2">
              <label class="form-label">Current Age</label>
              <span  class="form-control" id="age_current"></span>
            </div> --}}
            <div class="col-sm-2">
              <label class="form-label">Sex</label>
              <span  class="form-control" id="ncd_sex"></span>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-2">
              <label  class="form-label">Registration Date</label>
              <div class="date-holder">
                <input type="text" id="ncd_regstrDate" class="form-control Gdate" onblur="ncd_reg_age()" placeholder="dd-mm-yyyy">
                <img src="../img/calendar3.svg" class="dateimg" alt="date">
              </div>
            </div>
            <div class="col-sm-2">
              <label class="form-label">Weight(kg)</label>
              <input type="number" class="form-control" id="ncd_Rweight">
            </div>
            <div class="col-sm-2">
              <label class="form-label">Height(cm)</label>
              <input class="form-control" id="ncd_Rheight">
            </div>
           
            <div class="col-sm-2">
              <label class="form-label">Register BMI</label>
              <span class="form-control" id="ncd_RegisterBmi"></span>
            </div>
            
            <div class="col-sm-2">
              <label  class="form-label">Area of Residence</label>
              <span class="form-control" id="ncd_residence"></span>
            </div>
            <div class="col-sm-2">
              <label for="validationCustom02" class="form-label">Township</label>
              <span class="form-control" id="ncd_town"></span>        
            </div>
            
          </div>
        </div>

        <div><h3>NCD Diagnosis</h3></div><!-- header -->

        <div class="ncd-Diagnosi">
          <div class="row">
            <div class="col-sm-2">
              <label class="form-label">1st BP Reading</label>
              <div class="input-group no-margin">
                <input type="number" class="form-control" id="1st_bptop">
                <input type="number" class="form-control" id="1st_bpbot">
              </div>
            </div>
            <div class="col-sm-2">
              <label class="form-label">1st BP Read Date</label>
              <div class="date-holder">
                <input type="text" class="form-control Gdate" id="1stBp_Date" placeholder="dd-mm-yyyy">
                <img src="../img/calendar3.svg" class="dateimg" alt="date">
              </div>
            </div>
            <div class="col-sm-2">
              <label class="form-label">Hypertension</label>
              <select class="form-select" id="ncd1st_hyper">
                <option value="-"></option>
                <option value="Known">Known</option>
                <option value="New">New</option>
                <option value="No">No</option>
              </select>
            </div>
            <div class="col-sm-2">
              <label class="form-label">Diagnosis Date</label>
              <div class="date-holder">
                <input type="text" class="form-control Gdate" id="1stDiag_Date" placeholder="dd-mm-yyyy">
                <img src="../img/calendar3.svg" class="dateimg" alt="date">
              </div>
            </div>
            <div class="col-sm-2">
              <label class="form-label">1st Time RBS</label>
              <input type="" class="form-control" id="1st_rbs">
            </div>
            <div class="col-sm-2">
              <label class="form-label">1st Time RBS Date</label>
              <div class="date-holder">
                <input type="text" class="form-control Gdate" id="1stRBs_Date" placeholder="dd-mm-yyyy">
                <img src="../img/calendar3.svg" class="dateimg" alt="date">
              </div>
            </div>


          </div>
          <div class="row">
            <div class="col-sm-2">
              <label class="form-label">2nd BP Reading</label>
              <div class="input-group no-margin">
                <input type="number" class="form-control" id="2nd_bptop">
                <input type="number" class="form-control" id="2nd_bpbot">
              </div>
            </div>
            <div class="col-sm-2">
              <label class="form-label">2nd BP Read Date</label>
              <div class="date-holder">
                <input type="text" class="form-control Gdate" id="2ndBp_Date" placeholder="dd-mm-yyyy">
                <img src="../img/calendar3.svg" class="dateimg" alt="date">
              </div>
            </div>
            <div class="col-sm-2">
              <label class="form-label">Diabetes</label>
              <select class="form-select" id="ncd2nd_hyper">
                <option value="-"></option>
                <option value="Known">Known</option>
                <option value="New">New</option>
                <option value="No">No</option>
              </select>
            </div>
            <div class="col-sm-2">
              <label class="form-label">Diagnosis Date</label>
              <div class="date-holder">
                <input type="text" class="form-control Gdate" id="2ndDiag_Date" placeholder="dd-mm-yyyy">
                <img src="../img/calendar3.svg" class="dateimg" alt="date">
              </div>
            </div>
            <div class="col-sm-2">
              <label class="form-label">2nd Time RBS</label>
              <input type="" class="form-control" id="2nd_rbs">
            </div>
            <div class="col-sm-2">
              <label class="form-label">2nd Time RBS Date</label>
              <div class="date-holder">
                <input type="text" class="form-control Gdate" id="2ndRBs_Date" placeholder="dd-mm-yyyy">
                <img src="../img/calendar3.svg" class="dateimg" alt="date">
              </div>
            </div>


          </div>
          <div class="row">
            <div class="col-sm-2">
              <label class="form-label">3rd BP Reading</label>
              <div class="input-group no-margin">
                <input type="number" class="form-control" id="3rd_bptop">
                <input type="number" class="form-control" id="3rd_bpbot">
              </div>
            </div>
            <div class="col-sm-2">
              <label class="form-label">3rd BP Read Date</label>
              <div class="date-holder">
                <input type="text" class="form-control Gdate" id="3rdBp_Date" placeholder="dd-mm-yyyy">
                <img src="../img/calendar3.svg" class="dateimg" alt="date">
              </div>
            </div>
            <div class="col-sm-3">
              <label class="form-label">Staging of hypertension</label>
              <select class="form-select" id="ncdHyper_stag">
                <option value="-"></option>
                <option value="Stage1">Stage1: 140/90 - 159/99</option>
                <option value="Stage2">Stage2: 160/100 - 179/109</option>
                <option value="Stage3">Stage3: >= 180/110</option>
                <option value="Stage4">4</option>
              </select>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-2">
              <label class="form-label"> Clinical Symptoms</label>
              <select class="form-select speDetermine-1" id="ncdClinic_sym">
                <option value="-"></option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
              </select>
            </div>
            <div class="col-sm-8">
              <label class="form-label">If yes, Please describe</label>
              <input type="text" class="form-control limit-input speDetermine-2" id="clinical_sym">
            </div>
            <div class="col-sm-2">
                <label class="form-label">Smoking Status</label>
                <select class="form-select" id="ncdSmoke_status">
                  <option value="-"></option>
                  <option value="Yes">Yes</option>
                  <option value="No">No</option>
                  <option value="Ex-smoker">Ex-smoker</option>
              </select>
            </div>
              
            
          </div>
        </div>

        <div>
            <h3>If know NCD,list current NCD Medications</h3>
        </div><!-- header -->

        <div class="current-ncdMedic">
          
          <div class="row">
            <div class="col-sm-3">
              <label class="form-label">Medication Name</label>
            </div>
            <div class="col-sm-2">
              <label class="form-label">Dose</label>
            </div>
            <div class="col-sm-2">
              <label class="form-label">Frequency</label>
            </div>
            <div class="col-sm-2">
              <label class="form-label">Duration</label>
            </div>
            <div class="col-sm-2">
              <label class="form-label">Duration(Unit)</label>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-3">
              <label class="form-label">Amlodipine PO</label>
            </div>
            <div class="col-sm-2">
              <select class="form-select" id="ncdAmlo_dose">
                <option value="-"></option>
                <option value="5mg">5mg</option>
                <option value="10mg">10mg</option>
              </select>
            </div>
            <div class="col-sm-2">
              <select class="form-select" id="ncdAmlo_frequency">
                <option value="-"></option>
                <option value="CM">CM</option>
                <option value="OD">OD</option>
                <option value="BD">BD</option>
                <option value="TDS">TDS</option>
                <option value="HS">HS</option>
              </select>
            </div>
            <div class="col-sm-2">
              <input type="text" class="form-control" id="ncdAmlo_duration">
            </div>
            <div class="col-sm-2">
              <select class="form-select" id="ncdAmlo_durUnit">
                <option value="-"></option>
                <option value="days">Days</option>
                <option value="weeks">Weeks</option>
                <option value="months">Months</option>
              </select>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-3">
              <label class="form-label">Emalapril PO</label>
            </div>
            <div class="col-sm-2">
              <select class="form-select" id="ncdEmala_dose">
                <option value="-"></option>
                <option value="2.5mg">2.5mg</option>
                <option value="5mg">5mg</option>
                <option value="7.5mg">7.5mg</option>
                <option value="10mg">10mg</option>
                <option value="15mg">15mg</option>
                <option value="20mg">20mg</option>
              </select>
            </div>
            <div class="col-sm-2">
              <select class="form-select" id="ncdEmala_frequency">
                <option value="-"></option>
                <option value="CM">CM</option>
                <option value="OD">OD</option>
                <option value="BD">BD</option>
                <option value="TDS">TDS</option>
                <option value="HS">HS</option>
              </select>
            </div>
            <div class="col-sm-2">
              <input type="text" class="form-control" id="ncdEmala_duration">
            </div>
            <div class="col-sm-2">
              <select class="form-select" id="ncdEmala_durUnit">
                <option value="-"></option>
                <option value="days">Days</option>
                <option value="weeks">Weeks</option>
                <option value="months">Months</option>
              </select>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-3">
              <label class="form-label">Atorvastatin PO</label>
            </div>
            <div class="col-sm-2">
              <select class="form-select" id="ncdator_dose">
                <option value="-"></option>
                <option value="10mg">10mg</option>
                <option value="20mg">20mg</option>
                <option value="40mg">40mg</option>
                <option value="80mg">80mg</option>
              </select>
            </div>
            <div class="col-sm-2">
              <select class="form-select" id="ncdator_frequency">
                <option value="-"></option>
                <option value="CM">CM</option>
                <option value="OD">OD</option>
                <option value="BD">BD</option>
                <option value="TDS">TDS</option>
                <option value="HS">HS</option>
              </select>
            </div>
            <div class="col-sm-2">
              <input type="text" class="form-control" id="ncdator_duration">
            </div>
            <div class="col-sm-2">
              <select class="form-select" id="ncdActor_durUnit">
                <option value="-"></option>
                <option value="days">Days</option>
                <option value="weeks">Weeks</option>
                <option value="months">Months</option>
              </select>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-3">
              <label class="form-label">Hydrochlorothiazide PO</label>
            </div>
            <div class="col-sm-2">
              <select class="form-select" id="ncdhydro_dose">
                <option value="-"></option>
                <option value="12.5mg">12.5mg</option>
                <option value="25mg">25mg</option>
        	<option value="50mg">50mg</option>
              </select>
            </div>
            <div class="col-sm-2">
              <select class="form-select" id="ncdhydro_frequency">
                <option value="-"></option>
                <option value="CM">CM</option>
                <option value="OD">OD</option>
                <option value="BD">BD</option>
                <option value="TDS">TDS</option>
                <option value="HS">HS</option>
              </select>
            </div>
            <div class="col-sm-2">
              <input type="text" class="form-control"id="ncdhydro_duration">
            </div>
            <div class="col-sm-2">
              <select class="form-select" id="ncdhydro_durUnit">
                <option value="-"></option>
                <option value="days">Days</option>
                <option value="weeks">Weeks</option>
                <option value="months">Months</option>
              </select>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-3">
              <label class="form-label">Aspirin PO</label>
            </div>
            <div class="col-sm-2">
              <select class="form-select" id="ncdAspi_dose">
                <option value="-"></option>
                <option value="75mg">75mg</option>
              </select>
            </div>
            <div class="col-sm-2">
              <select class="form-select" id="ncdAspi_frequency">
                <option value="-"></option>
                <option value="CM">CM</option>
                <option value="OD">OD</option>
                <option value="BD">BD</option>
                <option value="TDS">TDS</option>
                <option value="HS">HS</option>
              </select>
            </div>
            <div class="col-sm-2">
              <input type="text" class="form-control" id="ncdAspi_duration">
            </div>
            <div class="col-sm-2">
              <select class="form-select" id="ncdAspi_durUnit">
                <option value="-"></option>
                <option value="days">Days</option>
                <option value="weeks">Weeks</option>
                <option value="months">Months</option>
              </select>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-3">
              <label class="form-label">Metformin PO</label>
            </div>
            <div class="col-sm-2">
              <select class="form-select" id="ncdMetf_dose">
                <option value="-"></option>
                <option value="500mg">500mg</option>
                <option value="1000mg">1000mg</option>
                <option value="1500mg">1500mg</option>
              </select>
            </div>
            <div class="col-sm-2">
              <select class="form-select" id="ncdMetf_frequency">
                <option value="-"></option>
                <option value="CM">CM</option>
                <option value="OD">OD</option>
                <option value="BD">BD</option>
                <option value="TDS">TDS</option>
                <option value="HS">HS</option>
              </select>
            </div>
            <div class="col-sm-2">
              <input type="text" class="form-control" id="ncdMetf_duration">
            </div>
            <div class="col-sm-2">
              <select class="form-select" id="ncdMetf_durUnit">
                <option value="-"></option>
                <option value="days">Days</option>
                <option value="weeks">Weeks</option>
                <option value="months">Months</option>
              </select>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-3">
              <label class="form-label">Gliclazide PO</label>
            </div>
            <div class="col-sm-2">
              <select class="form-select" id="ncdGli_dose">
                <option value="-"></option>
                <option value="40mg">40mg</option>
                <option value="80mg">80mg</option>
                <option value="160mg">160mg</option>
              </select>
            </div>
            <div class="col-sm-2">
              <select class="form-select" id="ncdGli_frequency">
                <option value="-"></option>
                <option value="CM">CM</option>
                <option value="OD">OD</option>
                <option value="BD">BD</option>
                <option value="TDS">TDS</option>
                <option value="HS">HS</option>
              </select>
            </div>
            <div class="col-sm-2">
              <input type="text" class="form-control" id="ncdGli_duration">
            </div>
            <div class="col-sm-2">
              <select class="form-select" id="ncdGli_durUnit">
                <option value="-"></option>
                <option value="days">Days</option>
                <option value="weeks">Weeks</option>
                <option value="months">Months</option>
              </select>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-3">
              <label class="form-label">Other NCD Medication:</label>
            </div>
            <div class="col-sm-1">
              <select class="form-select speDetermine-3 " id="ncdother_medic">
                <option value="-"></option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
              </select>

            </div>
            <div class="col-sm-2">
              <label class="form-label ">(If Yes Please specify)</label>
            </div>
            <div class="col-sm-6">
              <input type="text" class="form-control limit-input  speDetermine-4" id="specifyNcd">
            </div>
          </div>
          

        </div>
        <div>
            <h3>Other Current Medication</h3>
        </div><!-- header -->

        <div class="othCurrent-ncdMedic">
         
          <div class="row">
            <div class="col-sm-3">
              <label class="form-label">Medication Name</label>
            </div>
            <div class="col-sm-2">
              <label class="form-label">Dose</label>
            </div>
            <div class="col-sm-2">
              <label class="form-label">Frequency</label>
            </div>
            <div class="col-sm-2">
              <label class="form-label">Duration</label>
            </div>
            <div class="col-sm-2">
              <label class="form-label">Duration(Unit)</label>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-3">
              <input type="text" class="form-control" id="oth_medicname1">
            </div>
            <div class="col-sm-2">
              <input type="text" class="form-control" id="oth_does1">
            </div>
            <div class="col-sm-2">
              <input type="text" class="form-control" id="oth_freqency1">
            </div>
            <div class="col-sm-2">
              <input type="text" class="form-control" id="oth_duration1">
            </div>
            <div class="col-sm-2">
              <select class="form-select" id="th_durUnit1">
                <option value="-"></option>
                <option value="days">Days</option>
                <option value="weeks">Weeks</option>
                <option value="months">Months</option>
              </select>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-3">
              <input type="text" class="form-control" id="oth_medicname2">
            </div>
            <div class="col-sm-2">
              <input type="text" class="form-control" id="oth_does2">
            </div>
            <div class="col-sm-2">
              <input type="text" class="form-control" id="oth_freqency2">
            </div>
            <div class="col-sm-2">
              <input type="text" class="form-control" id="oth_duration2">
            </div>
            <div class="col-sm-2">
              <select class="form-select" id="th_durUnit2">
                <option value="-"></option>
                <option value="days">Days</option>
                <option value="weeks">Weeks</option>
                <option value="months">Months</option>
              </select>
            </div>
          </div> <!-- 2 -->
        
          <div class="row">
            <div class="col-sm-3">
              <input type="text" class="form-control" id="oth_medicname3">
            </div>
            <div class="col-sm-2">
              <input type="text" class="form-control" id="oth_does3">
            </div>
            <div class="col-sm-2">
              <input type="text" class="form-control" id="oth_freqency3">
            </div>
            <div class="col-sm-2">
              <input type="text" class="form-control" id="oth_duration3">
            </div>
            <div class="col-sm-2">
              <select class="form-select" id="th_durUnit3">
                <option value="-"></option>
                <option value="days">Days</option>
                <option value="weeks">Weeks</option>
                <option value="months">Months</option>
              </select>
            </div>
          </div><!-- 3 -->
          <div class="row">
            <div class="col-sm-3">
              <input type="text" class="form-control" id="oth_medicname4">
            </div>
            <div class="col-sm-2">
              <input type="text" class="form-control" id="oth_does4">
            </div>
            <div class="col-sm-2">
              <input type="text" class="form-control" id="oth_freqency4">
            </div>
            <div class="col-sm-2">
              <input type="text" class="form-control" id="oth_duration4">
            </div>
            <div class="col-sm-2">
              <select class="form-select" id="th_durUnit4">
                <option value="-"></option>
                <option value="days">Days</option>
                <option value="weeks">Weeks</option>
                <option value="months">Months</option>
              </select>
            </div>
          </div><!-- 4 -->
          <div class="row">
            <div class="col-sm-3">
              <input type="text" class="form-control" id="oth_medicname5">
            </div>
            <div class="col-sm-2">
              <input type="text" class="form-control" id="oth_does5">
            </div>
            <div class="col-sm-2">
              <input type="text" class="form-control" id="oth_freqency5">
            </div>
            <div class="col-sm-2">
              <input type="text" class="form-control" id="oth_duration5">
            </div>
            <div class="col-sm-2">
              <select class="form-select" id="th_durUnit5">
                <option value="-"></option>
                <option value="days">Days</option>
                <option value="weeks">Weeks</option>
                <option value="months">Months</option>
              </select>
            </div>
          </div><!-- 5 -->
          <div class="row">
            <div class="col-sm-3">
              <input type="text" class="form-control" id="oth_medicname6">
            </div>
            <div class="col-sm-2">
              <input type="text" class="form-control" id="oth_does6">
            </div>
            <div class="col-sm-2">
              <input type="text" class="form-control" id="oth_freqency6">
            </div>
            <div class="col-sm-2">
              <input type="text" class="form-control" id="oth_duration6">
            </div>
            <div class="col-sm-2">
              <select class="form-select" id="th_durUnit6">
                <option value="-"></option>
                <option value="days">Days</option>
                <option value="weeks">Weeks</option>
                <option value="months">Months</option>
              </select>
            </div>
          </div><!-- 6 -->

        </div>
        <div>
            <h3>Patient History</h3>
        </div><!-- header -->

        <div class="ncd_patientHist">
          
          <div class="row">
            <div class="col-sm-3">
              <label class="form-label">Diabetic foot</label>
              <select class="form-select" id="ncdPat_diabetic">
                <option value="-"></option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
              </select>
            </div>
            <div class="col-sm-3">
              <label class="form-label">Hyperlipidemia</label>
              <select class="form-select" id="ncdPat_gestation">
                <option value="-"></option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
              </select>
            </div>
            <div class="col-sm-3">
              <label class="form-label">Gestational diabetes</label>
              <select class="form-select" id="ncdPat_hyperli">
                <option value="-"></option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
                <option value="NA">NA</option>
              </select>
            </div>
            <div class="col-sm-3">
              <label class="form-label">Gestational HT</label>
              <select class="form-select" id="ncdPat_gestHT">
                <option value="-"></option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
                <option value="NA">NA</option>
              </select>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-3">
              <label class="form-label">Neuropathy</label>
              <select class="form-select" id="ncdPat_neuro">
                <option value="-"></option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
              </select>
            </div>
            <div class="col-sm-3">
              <label class="form-label">CKD</label>
              <select class="form-select" id="ncdPat_ckd">
                <option value="-"></option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
              </select>
            </div>
            <div class="col-sm-3">
              <label class="form-label">CVD(MI/CVA/PVD)</label>
              <select class="form-select" id="ncdPat_cvd">
                <option value="-"></option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
              </select>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-3">
              <label class="form-label">Atrial fib:</label>
              <select class="form-select" id="ncdPat_atrial">
                <option value="-"></option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
              </select>
            </div>
            <div class="col-sm-3">
              <label class="form-label">Changes in vision</label>
              <select class="form-select" id="ncdPat_changeVs">
                <option value="-"></option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
              </select>
            </div>
            <div class="col-sm-3">
              <label class="form-label">Chronic lung diseases</label>
              <select class="form-select" id="ncdPat_chronicLung">
                <option value="-"></option>
                <option value="COPD">COPD</option>
                <option value="Asthma">Asthma</option>
                <option value="No known">No known</option>
                <option value="lung diseases">lung diseases</option>
              </select>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-3">
              <label class="form-label">Recur.infection</label>
              <select class="form-select speDetermine-5" id="ncdPat_recurIf">
                <option value="-"></option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
              </select>
            </div>
            <div class="col-sm-6">
              <label class="form-label ">If Yes,commment on infection</label>
              <input class="form-control limit-input speDetermine-6" type="text" id="ncdPat_commentIf">
            </div>
          </div>
        </div>
        <div><h3>Family Planing<h3></div><!-- header -->
        <div class="ncd_familyHistory"> 
          <div class="row">
            <div class="col-sm-3">
              <label class="form-label">Hypertension</label>
              <select class="form-select" id="ncdfam_hyperten">
                <option value="-"></option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
              </select>
            </div>
            <div class="col-sm-3">
              <label class="form-label">Diabetes</label>
              <select class="form-select" id="ncdfam_diabetes">
                <option value="-"></option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
              </select>
            </div>
          </div>
        </div>
        <div class="ncd_btn">
          <button onclick="ncdRecord()" class="btn btn-info ncd_recordSave" id="ncd_RegisterBtn">Save Record</button>
          <button onclick="remove_register()" class="btn btn-danger" style="display: none" id="ncd_remove_Register">Delete_Register</button>
        </div>
        
      </div>

      <div id="ncdfollow_upAdd" style="display:none">
        <div class="header-text">
          <div class="ncd_followTime">
            <label class="form-label follow_timeLabel"></label>
          </div>
          <button  class="btn btn-info ncd_followview" id="ncd-toRegister">To-Register</button>
        </div> <!-- header -->
        <div class="ncdV-general">
          <div class="row">
            <div class="col-sm-6">
              <div class="input-group mb-3 ncd-generalCode">
                <input type="number" id="ncdV_pid" class="form-control" placeholder="General ID"  disabled="true">
                <input type="text" id="ncdV_fid" class="form-control" placeholder="Fuchia ID" disabled="true">
              </div>
            </div>
            <div class="col-sm-2">
              <label class="form-label">Visit Date</label>
              <div class="date-holder">
                <input type="text" class="form-control Gdate" id="ncdV_visit" placeholder="dd-mm-yyyy">
                <img src="../img/calendar3.svg" class="dateimg" alt="date">
              </div>
            </div>
            <div class="col-sm-2">
              <label class="form-label">NCD Diagnosis</label>
              <select class="form-select" id="ncdV_diagnosis">
                <option value="-"></option>
                <option value="Hypertension">Hyperntension</option>
                <option value="Diabetes">Diabetes</option>
                <option value="Both">Both</option>
              </select>
            </div>
            <div class="col-sm-2">
              <label class="form-label">BMI</label>
              <span class="form-control" id="ncd_FollowBmi"></span>
            </div>
           
          </div>
        </div>

        <div>
          <h3>Admission and Follow-up</h3> <!-- header -->
          <div class="admis-ncdFollow">
            <div class="row">
              <div class="col-sm-2">
                <label class="form-label">Type of current visit</label>
                <select class="form-select speDetermine-7" id="ncdV_Type_currentVisit">
                  <option value="-"></option>
                  <option value="on time">on time</option>
                  <option value="late">late</option>
                  <option value="unplanned">unplanned</option>
                </select>
              </div>
              <div class="col-sm-3">
                <label class="form-label">If late visit,Specify the duration</label>
                <div class="input-group no-margin">
                  <input class="form-control limit-input speDetermine-8" id="ncdV_latein">
                  <select class="form-select limit-input speDetermine-8" id="ncdV_lateSpe">
                    <option value="-"></option>
                    <option value="days">days</option>
                    <option value="weeks">weeks</option>
                    <option value="Months">months</option>
                  </select>
                </div>
              </div>
              <div class="col-sm-3">
                <label class="form-label">Follow up required</label>
                <div class="input-group no-margin">
                  <input class="form-control" id="ncdV_FrequireIn">
                  <select class="form-select" id="ncdV_FrequireDate">
                    <option value="-"></option>
                    <option value="days">days</option>
                    <option value="weeks">weeks</option>
                    <option value="Months">months</option>
                  </select>
                </div>
              </div>
              <div class="col-sm-3">
                <!-- <label class="form-label">Registration:Follow-up Date</label> -->
                <label class="form-label">Next:Follow-up Date</label>
                <div class="date-holder">
                  <input type="text" class="form-control Gdate" id="ncdV_RT_folloDate" placeholder="dd-mm-yyyy">
                  <img src="../img/calendar3.svg" class="dateimg" alt="date">
                </div>
              </div>
              <div class="col-sm-5">
                <div class="row">
                  <div class="col-sm-5">
                    <label class="form-label">Hours</label>
                    <input type="number" class="form-control" id="ncdV_hours">
                  </div>
                  <div class="col-sm-5">
                    <label class="form-label">Minutes</label>
                    <input type="number" class="form-control" id="ncdV_minutes">
                  </div>
                  <div class="col-sm-2">
                    <label class="form-label">AM/PM</label>
                    <select  class="form-select" id="ncdV_AP">
                      <option value="-"></option>
                      <option value="AM">AM</option>
                      <option value="PM">PM</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>

        </div>

        <div><h3>Blood Sugar / Hypertension monitoring</h3></div> <!-- header -->
        <div class="blood-sugarMoni">
          <div class="row">
            <div class="col-sm-2">
              <label class="form-label">MAM Clinic Bp</label>
              <div class="input-group no-margin">
                <input class="form-control" type="number" id="ncdV_mamBp1">
                <input class="form-control" type="number" id="ncdV_mamBp2">
              </div>
            </div>
            <div class="col-sm-2">
              <label class="form-label">Blood pressure stage</label>
              <select class="form-select" id="ncdV_FBpStage">
                <option value="-"></option>
                <option value="<140/90">&#60;140/90</option>
                <option value="Stage1">Stage1: 140/90 - 159/99</option>
                <option value="Stage2">Stage2: 160/100 - 179-109</option>
                <option value="Stage3">Stage3: >=180/110</option>
              </select>    
            </div>
            <div class="col-sm-2">
              <label class="form-label">FBS</label>
              <input class="form-control"  id="ncdV_fbs">
            </div>
            <div class="col-sm-2">
              <label class="form-label">FBS test Date</label>
              <div class="date-holder">
                <input type="text" class="form-control Gdate" id="ncdV_fbsDate" placeholder="dd-mm-yyyy">
                <img src="../img/calendar3.svg" class="dateimg" alt="date">
              </div>
            </div>
            <div class="col-sm-2">
              <label class="form-label">2HPP</label>
              <input class="form-control"  id="ncdV_2hpp">
            </div>
            <div class="col-sm-2">
              <label class="form-label">2HPP test Date</label>
              <div class="date-holder">
                <input type="text" class="form-control Gdate"  id="ncdV_2hppDate" placeholder="dd-mm-yyyy">
                <img src="../img/calendar3.svg" class="dateimg" alt="date">
              </div>
            </div>
            <div class="col-sm-2">
              <label class="form-label">Test Location</label>
              <select class="form-select" id="ncdV_LocaTest">
                <option value="-"></option>
                <option value="MAM clinic">MAM clinic</option>
                <option value="Outside MAM">Outside MAM</option>
              </select>    
              
            </div>
          </div>
        </div>

        <div>
          <h3>Other lab result(most recent result):</h3>
        </div><!-- header -->
        <div class="ncdv-labresult">
          <div class="row">
            <div class="col-sm-3">
              <label class="form-label">Other lab result Date</label>
              <div class="date-holder">
                <input type="text" class="form-control Gdate"  id="ncdV_othLabDate" placeholder="dd-mm-yyyy">
                <img src="../img/calendar3.svg" class="dateimg" alt="date">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-1">
              <label class="form-label">ALT(IU/ml)</label>
              <input class="form-control" id="ncdV_othAlt">
            </div>
            <div class="col-sm-2">
              <label class="form-label">HBA1C: (g/dl)</label>
              <input class="form-control" id="ncdV_othHBA1C">
            </div>
            <div class="col-sm-3">
              <label class="form-label">Urine A:C ratio</label>
              <input class="form-control" id="ncdV_uAcratio">
            </div>
            <div class="col-sm-3">
              <label class="form-label">Urine test: Glycosuria</label>
              <input class="form-control" id="ncdV_uGly">
            </div>
            <div class="col-sm-3">
              <label class="form-label">Urine test: Proteinuria</label>
              <input class="form-control" id="ncdV_uProtein">
            </div>
          </div>
          <div class="row">
            <div class="col-sm-2">
              <label class="form-label">Creatinine</label>
              <div class="input-group no-margin">
                <input class="form-control" type="number" id="ncdV_creatinIn">
                <select class="form-select" id="ncdV_cratainType">
                  <option value="-"></option>
                  <option value="mg/dl">mg/dl</option>
                  <option value="umo/L">umo/L</option>
                </select>
              </div>
            </div>
            <div class="col-sm-2">
              <label class="form-label">Cr/Cl(ml/min)</label>
              <input class="form-control" type="number" id="ncdV_crcl">
            </div>
            <div class="col-sm-2">
              <label class="form-label">Total Cholesterol</label>
              <div class="input-group no-margin">
                <input class="form-control" type="number" id="ncdV_Totalcho">
                <select class="form-select" id="ncdV_totalChoUnit">
                  <option value="-"></option>
                  <option value="mg/dl">mg/dl</option>
                  <option value="mmoL">mmol</option>
                </select>
              </div>
            </div>
            <div class="col-sm-2">
              <label class="form-label">CVD risk</label>
              <select class="form-select" id="ncdV_cvdRisk">
                  <option value="-"></option>
                  <option value="<10%">&#60;10%</option>
                  <option value="10% to <20%">10% to &#60;20%</option>
                  <option value="20% to 30%">20% to 30%</option>
                  <option value="30% to <40%">30% to &#60;40% </option>
                  <option value=">40%">>40%</option>  
              </select>
            </div>
            <div class="col-sm-2">
              <label class="form-label">HDL</label>
              <div class="input-group no-margin">
                <input class="form-control" type="number" id="ncdV_HDL">
                <select class="form-select" id="ncdV_HDLunit">
                  <option value="-"></option>
                  <option value="mg/dl">mg/dl</option>
                  <option value="mmoL">mmol/L</option>
                </select>
              </div>
            </div>
            <div class="col-sm-2">
              <label class="form-label">LDL</label>
              <div class="input-group no-margin">
                <input class="form-control" type="number" id="ncdV_LDLin">
                <select class="form-select" id="ncdV_ldlselect">
                  <option value="-"></option>
                  <option value="mg/dl">mg/dl</option>
                  <option value="mmoL">mmol/L</option>
                </select>
              </div>
            </div>
            <div class="col-sm-3">
              <label class="form-label">Triglyceride</label>
              <div class="input-group no-margin">
                <input class="form-control" type="number" id="ncdV_trigIn">
                <select class="form-select" id="ncdV_Trigselect">
                  <option value="-"></option>
                  <option value="mg/dl">mg/dl</option>
                  <option value="mmoL">mmol/L</option>
                </select>
              </div>
            </div>
          </div>
        </div>

        <div><h3>Physical examination</h3></div> <!-- header -->
        <div class="ncdv-PhysicalEx">
          <div class="row">
            <div class="col-sm-2">
              <label calss="form-label">Pluse</label>
              <select class="form-select" id="ncdV_pluse">
                <option value="-"></option>
                <option value="Regular">Regular</option>
                <option value="Regularly irregular">Regularly irregular</option>
                <option value="irregular irregular">irregular irregular</option> 
              </select>
            </div>
            <div class="col-sm-2">
              <label calss="form-label">Pluse rate</label>
              <input class="form-control" id="ncdV_pluRate">
            </div>
            <div class="col-sm-1">
              <label calss="form-label">Weight(kg)</label>
              <input class="form-control" id="ncdV_weight">
            </div>
            <div class="col-sm-2">
              <label calss="form-label">Diabetic foot</label>
              <select class="form-select" id="ncdV_diabeFoot">
                <option value="-"></option>
                <option vlaue="Yes">Yes</option>
                <option vlaue="No">No</option>
              </select>
            </div>
            <div class="col-sm-2">
              <label calss="form-label">Diabetic neuropathy</label>
              <select class="form-select" id="ncdV_diabeneu">
                <option value="-"></option>
                <option vlaue="Yes">Yes</option>
                <option vlaue="No">No</option>
              </select>
            </div>
            <div class="col-sm-3">
              <label calss="form-label">Lifestyle Advice</label>
              <select class="form-select" id="ncdV_lifeStyle">
                <option value="-"></option>
                <option vlaue="Yes">Yes</option>
                <option vlaue="No">No</option>
              </select>
            </div>


          </div>
          <div class="row">
            <div class="col-sm-3">
              <label calss="form-label">Medication changed</label>
              <select class="form-select" id="ncdV_Mchange">
                <option value="-"></option>
                <option vlaue="Yes">Yes</option>
                <option vlaue="No">No</option>
              </select>
            </div>
            <div class="col-sm-3">
              <label calss="form-label">Patient adherence to medication</label>
              <select class="form-select" id="ncdV_adherence">
                <option value="-"></option>
                <option vlaue="Good">Good</option>
                <option vlaue="Average">Average</option>
                <option value="Poor">Poor</option>
              </select>
            </div>
            <div class="col-sm-2">
              <label calss="form-label">Drug Supply</label>
              <select class="form-select" id="ncdV_drugSupply">
                <option value="-"></option>
                <option vlaue="MAM supply">MAM supply</option>
                <option vlaue="Self-funded">Self-funded</option>
              </select>
            </div>

          </div>
          <div class="row">
            <div class="col-sm-3">
              <label class="form-label">Medication Name</label>
            </div>
            <div class="col-sm-2">
              <label class="form-label">Dose</label>
            </div>
            <div class="col-sm-2">
              <label class="form-label">Frequency</label>
            </div>
            <div class="col-sm-2">
              <label class="form-label">Duration</label>
            </div>
            <div class="col-sm-2">
              <label class="form-label">Duration(Unit)</label>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-3">
              <label class="form-label">Amlodipine PO</label>
            </div>
            <div class="col-sm-2">
              <select class="form-select" id="ncdV_Amlo_dose">
                <option value="-"></option>
                <option value="5mg">5mg</option>
                <option value="10mg">10mg</option>
              </select>
            </div>
            <div class="col-sm-2">
              <select class="form-select" id="ncdV_Amlo_frequency">
                <option value="-"></option>
                <option value="CM">CM</option>
                <option value="OD">OD</option>
                <option value="BD">BD</option>
                <option value="TDS">TDS</option>
                <option value="HS">HS</option>
              </select>
            </div>
            <div class="col-sm-2">
              <input type="text" class="form-control" id="ncdV_Amlo_duration">
            </div>
            <div class="col-sm-2">
              <select class="form-select" id="ncdV_Amlo_durUnit">
                <option value="-"></option>
                <option value="days">Days</option>
                <option value="weeks">Weeks</option>
                <option value="months">Months</option>
              </select>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-3">
              <label class="form-label">Emalapril PO</label>
            </div>
            <div class="col-sm-2">
              <select class="form-select" id="ncdV_Emala_dose">
                <option value="-"></option>
                <option value="2.5mg">2.5mg</option>
                <option value="5mg">5mg</option>
                <option value="7.5mg">7.5mg</option>
                <option value="10mg">10mg</option>
                <option value="15mg">15mg</option>
                <option value="20mg">20mg</option>
              </select>
            </div>
            <div class="col-sm-2">
              <select class="form-select" id="ncdV_Emala_frequency">
                <option value="-"></option>
                <option value="CM">CM</option>
                <option value="OD">OD</option>
                <option value="BD">BD</option>
                <option value="TDS">TDS</option>
                <option value="HS">HS</option>
              </select>
            </div>
            <div class="col-sm-2">
              <input type="text" class="form-control" id="ncdV_Emala_duration">
            </div>
            <div class="col-sm-2">
              <select class="form-select" id="ncdV_Emala_durUnit">
                <option value="-"></option>
                <option value="days">Days</option>
                <option value="weeks">Weeks</option>
                <option value="months">Months</option>
              </select>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-3">
              <label class="form-label">Atorvastatin PO</label>
            </div>
            <div class="col-sm-2">
              <select class="form-select" id="ncdV_ator_dose">
                <option value="-"></option>
                <option value="10mg">10mg</option>
                <option value="20mg">20mg</option>
                <option value="40mg">40mg</option>
                <option value="80mg">80mg</option>
              </select>
            </div>
            <div class="col-sm-2">
              <select class="form-select" id="ncdV_ator_frequency">
                <option value="-"></option>
                <option value="CM">CM</option>
                <option value="OD">OD</option>
                <option value="BD">BD</option>
                <option value="TDS">TDS</option>
                <option value="HS">HS</option>
              </select>
            </div>
            <div class="col-sm-2">
              <input type="text" class="form-control" id="ncdV_ator_duration">
            </div>
            <div class="col-sm-2">
              <select class="form-select" id="ncdV_ator_durUnit">
                <option value="-"></option>
                <option value="days">Days</option>
                <option value="weeks">Weeks</option>
                <option value="months">Months</option>
              </select>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-3">
              <label class="form-label">Hydrochlorothiazide PO</label>
            </div>
            <div class="col-sm-2">
              <select class="form-select" id="ncdV_hydro_dose">
                <option value="-"></option>
                <option value="12.5mg">12.5mg</option>
                <option value="25mg">25mg</option>
                <option value="50mg">50mg</option>
              </select>
            </div>
            <div class="col-sm-2">
              <select class="form-select" id="ncdV_hydro_frequency">
                <option value="-"></option>
                <option value="CM">CM</option>
                <option value="OD">OD</option>
                <option value="BD">BD</option>
                <option value="TDS">TDS</option>
                <option value="HS">HS</option>
              </select>
            </div>
            <div class="col-sm-2">
              <input type="text" class="form-control"id="ncdV_hydro_duration">
            </div>
            <div class="col-sm-2">
              <select class="form-select" id="ncdV_hydro_durUnit">
                <option value="-"></option>
                <option value="days">Days</option>
                <option value="weeks">Weeks</option>
                <option value="months">Months</option>
              </select>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-3">
              <label class="form-label">Aspirin PO</label>
            </div>
            <div class="col-sm-2">
              <select class="form-select" id="ncdV_Aspi_dose">
                <option value="-"></option>
                <option value="75mg">75mg</option>
              </select>
            </div>
            <div class="col-sm-2">
              <select class="form-select" id="ncdV_Aspi_frequency">
                <option value="-"></option>
                <option value="CM">CM</option>
                <option value="OD">OD</option>
                <option value="BD">BD</option>
                <option value="TDS">TDS</option>
                <option value="HS">HS</option>
              </select>
            </div>
            <div class="col-sm-2">
              <input type="text" class="form-control" id="ncdV_Aspi_duration">
            </div>
            <div class="col-sm-2">
              <select class="form-select" id="ncdV_Aspi_durUnit">
                <option value="-"></option>
                <option value="days">Days</option>
                <option value="weeks">Weeks</option>
                <option value="months">Months</option>
              </select>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-3">
              <label class="form-label">Metformin PO(500)</label>
            </div>
            <div class="col-sm-2">
              <select class="form-select" id="ncdV_Metf500_dose">
                <option value="-"></option>
                <option value="500mg">500mg</option>
                <option value="1000mg">1000mg</option>
                <option value="1500mg">1500mg</option>
              </select>
            </div>
            <div class="col-sm-2">
              <select class="form-select" id="ncdV_Metf500_frequency">
                <option value="-"></option>
                <option value="CM">CM</option>
                <option value="OD">OD</option>
                <option value="BD">BD</option>
                <option value="TDS">TDS</option>
                <option value="HS">HS</option>
              </select>
            </div>
            <div class="col-sm-2">
              <input type="text" class="form-control" id="ncdV_Metf500_duration">
            </div>
            <div class="col-sm-2">
              <select class="form-select" id="ncdV_Metf500_durUnit">
                <option value="-"></option>
                <option value="days">Days</option>
                <option value="weeks">Weeks</option>
                <option value="months">Months</option>
              </select>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-3">
              <label class="form-label">Metformin PO(1000)</label>
            </div>
            <div class="col-sm-2">
              <select class="form-select" id="ncdV_Metf1000_dose">
                <option value="-"></option>
                <option value="500mg">500mg</option>
                <option value="1000mg">1000mg</option>
                <option value="1500mg">1500mg</option>
              </select>
            </div>
            <div class="col-sm-2">
              <select class="form-select" id="ncdV_Metf1000_frequency">
                <option value="-"></option>
                <option value="CM">CM</option>
                <option value="OD">OD</option>
                <option value="BD">BD</option>
                <option value="TDS">TDS</option>
                <option value="HS">HS</option>
              </select>
            </div>
            <div class="col-sm-2">
              <input type="text" class="form-control" id="ncdV_Metf1000_duration">
            </div>
            <div class="col-sm-2">
              <select class="form-select" id="ncdV_Metf1000_durUnit">
                <option value="-"></option>
                <option value="days">Days</option>
                <option value="weeks">Weeks</option>
                <option value="months">Months</option>
              </select>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-3">
              <label class="form-label">Gliclazide PO(500)</label>
            </div>
            <div class="col-sm-2">
              <select class="form-select" id="ncdV_Gli500_dose">
                <option value="-"></option>
                <option value="40mg">40mg</option>
                <option value="80mg">80mg</option>
                <option value="120mg">120mg</option>
                <option value="160mg">160mg</option>
              </select>
            </div>
            <div class="col-sm-2">
              <select class="form-select" id="ncdV_Gli500_frequency">
                <option value="-"></option>
                <option value="CM">CM</option>
                <option value="OD">OD</option>
                <option value="BD">BD</option>
                <option value="TDS">TDS</option>
                <option value="HS">HS</option>
              </select>
            </div>
            <div class="col-sm-2">
              <input type="text" class="form-control" id="ncdV_Gli500_duration">
            </div>
            <div class="col-sm-2">
              <select class="form-select" id="ncdV_Gli500_durUnit">
                <option value="-"></option>
                <option value="days">Days</option>
                <option value="weeks">Weeks</option>
                <option value="months">Months</option>
              </select>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-3">
              <label class="form-label">Gliclazide PO(1000)</label>
            </div>
            <div class="col-sm-2">
              <select class="form-select" id="ncdV_Gli1000_dose">
                <option value="-"></option>
                <option value="40mg">40mg</option>
                <option value="80mg">80mg</option>
                <option value="160mg">160mg</option>
              </select>
            </div>
            <div class="col-sm-2">
              <select class="form-select" id="ncdV_Gli1000_frequency">
                <option value="-"></option>
                <option value="CM">CM</option>
                <option value="OD">OD</option>
                <option value="BD">BD</option>
                <option value="TDS">TDS</option>
                <option value="HS">HS</option>
              </select>
            </div>
            <div class="col-sm-2">
              <input type="text" class="form-control" id="ncdV_Gli1000_duration">
            </div>
            <div class="col-sm-2">
              <select class="form-select" id="ncdV_Gli1000_durUnit">
                <option value="-"></option>
                <option value="days">Days</option>
                <option value="weeks">Weeks</option>
                <option value="months">Months</option>
              </select>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6" style="margin-top:20px">
              <label class="form-label">If diabetic and Pescribed and Gliclazide, ask patient about sympthom of hypoglycemia</label>
            </div>
            <div class="col-sm-1">
              <select class="form-select" id="symthom_hypo">
                <option value="-"></option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
              </select>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-2">
              <label class="form-label">Other medication</label>
              <select class="form-select speDetermine-9" id="ncdV_otherMeication">
                <option value="-"></option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
              </select>
            </div>
            <div class="col-sm-7">
              <label class="form-label">If yes,Please specify</label>
              <input class="form-control limit-input speDetermine-10" id="ncdV_othmMspecify"> 
            </div>
            <div class="col-sm-3">
              <label class="form-label">Doctor Init</label>
              <input class="form-control" id="ncdV_doctor">
            </div>
            
          </div>
          <div class="row">
            <div class="col-sm-3">
              <label class="form-label">Outcome if applicable</label>
              <select class="form-select" id="ncdV_outcome">
                <option value="-"></option>
                <option value="T/out to other MAM clinic">T/out to other MAM clinic</option>
                <option value="T/out to physician">T/out to physician</option>
                <option value="Dead">Dead</option>
              </select>
            </div>
            <div class="col-sm-3" id="ncd_clinic_code" style="display:none">
              <label class="form-label">MAM Clinic</label>
              <select class="form-control" id="clinic_code">
                <option value=""></option>
                <option value="81">HTY-C2 ( 81 )</option>
                <option value="71">HTY-A ( 71 )</option>
                <option value="72">HTY-B ( 72 )</option>
                <option value="73">SPT (  73 )</option>
                <option value="74">TL (  74 )</option>
                <option value="75">Winka ( 75 )</option>
                <option value="76">TBZY ( 76 )</option>
                <option value="77">PTO-DT ( 77 )</option>
                <option value="78">PTO-MCB ( 78 )</option>
                <option value="80">Hpakant ( 80 )</option>    
                <option value="82">Taze ( 82 )</option>
                <option value="83">HTY-C1 ( 83 )</option>
              </select>
            </div>
            <div class="col-sm-3" id="ncd_dead_dateBlock"style="display:none">
              <label>Dead Date</label>
              <div class="date-holder">
                <input type="text" id="ncd_dead_date" class="form-control Gdate" placeholder="dd-mm-yyyy">
                <img src="../img/calendar3.svg" class="dateimg" alt="date">
              </div>
            </div>
            <div class="col-sm-3" id="ncd_Tout_phyBlock"style="display:none">
              <label>T/out to physician</label>
              <input class="form-control" id="ncd_Tout_phy">
            </div>


            <div class="col-sm-3">
              <label class="form-label">Cause of dead if applicable</label>
              <select class="form-select" id="ncdV_deadApp">
                <option value="-"></option>
                <option value="Related to NCD">Related to NCD</option>
                <option value="Not Related to NCD">Not Related to NCD</option>
                <option value="Not known">Not known</option>
              </select>
            </div>
            
            <div class="col-sm-3">
              <label class="form-label">RBS(mg/dl)</label>
              <input class="form-control" id="ncdV_rbs">
            </div>
          </div>
        </div>
        <div class="ncd_btn">
          <button onclick="ncdfollowRecord()" id="ncdV_saveUp" class="btn btn-info ncd_recordSave">Save Visit</button>
        </div>


      </div>

    
  
      </div>
    </div>
    <div class="tab-pane  ncd-Section fade" id="ncd_export">
      <div class="header-text">
        <h2>NCD Export Section</h2>
      </div>      
      <form action="{{ route('ncd') }}" method="POST">
        @csrf
        <div class="row "style="justify-content:center;">
        <div class="col-sm-2">
            <label class="form-label">Table Name</label>
            <select class="form-select" name="ncd_exportType">
              <option value="Register">Register</option>
              <option value="Follow up">Follow up</option>
            </select>
          </div>
          <div class="col-sm-3">
            <label for="validationCustom01" class="form-label">From</label>        
              <div class="date-holder">
                <input type="text" class="form-control Gdate" id="ncd_fromDate" name="ncd_dateFrom" placeholder="dd-mm-yyyy">
                <img src="../img/calendar3.svg" class="dateimg" alt="date">
              </div>
          </div>
          <div class="col-sm-3">
            <label for="validationCustom01" class="form-label">To</label>
              <div class="date-holder">
                <input type="text" class="form-control Gdate" id="ncd_ToDate" name="ncd_dateTo" placeholder="dd-mm-yyyy">
                <img src="../img/calendar3.svg" class="dateimg" alt="date">
              </div>
          </div>
          
                    
          <div class="col-sm-1" style="display:none"><input  name="notice"  value="NCD Export"></div>
          <div class="col-sm-2">
            <button class="btn btn-primary export-ccBtn">Export</button>
          </div>
                    
        </div>
      </form>          
    </div>
  </div>
</div> <!-- *adding containers class -->
@endauth
@endsection

<script type="text/javascript" language="javascript">
  let ncdRecord_data={},ncdRecord_followdata={};let Clinic_Code,today,ncd_UPsave,rowid,follow_height,follow_update,ncdIdswitch,config;

  function outCome_applicable() {
    ncdV_outcome=$("#ncdV_outcome").val();
    if(ncdV_outcome=="T/out to other MAM clinic"){
      $("#ncd_clinic_code").show()
      $("#ncd_dead_dateBlock,#ncd_Tout_phyBlock").hide();
      $("#ncd_dead_date,#ncd_Tout_phy").val("");
    }else if(ncdV_outcome=="T/out to physician"){
      $("#ncd_Tout_phyBlock").show()
      $("#ncd_dead_dateBlock,#ncd_clinic_code").hide();
      $("#ncd_dead_date,#clinic_code").val("");
    }else if(ncdV_outcome=="Dead"){
      $("#ncd_dead_dateBlock").show()
      $("#ncd_Tout_phyBlock,#ncd_clinic_code").hide();
      $("#ncd_Tout_phy,#clinic_code").val("");
    }else{
      $("#ncd_Tout_phyBlock,#ncd_clinic_code,#ncd_dead_dateBlock").hide();
      $("#ncd_Tout_phy,#clinic_code,#ncd_dead_date").val("");
    }
  }
  function bmiCalculate(bmiW,bmiH){
    if(bmiH!=""&&bmiW!=""){
      bmiH=bmiH/100;
      bmiH=bmiH*bmiH;
      bmiresut=(bmiW/bmiH).toFixed(2);
      return bmiresut;
    }else{
      bmiresut="0.00";
      return bmiresut;
    }
    
  }
  function findncd_patient(){
    var Pid=$("#ncd_pid").val();
    var Fid=$("#ncd_fid").val();
    var Idchange=$("#ncd_regIDchange").val()
    console.log(Idchange);
    var ncd_id={
      Pid       :Pid,
      Fid       :Fid,
      notice    :"Find Patient"
    }
    console.log(ncd_id);
    $.ajaxSetup({
                  headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                }
    });
    $.ajax({
        type:'POST',
        url:"{{route('ncd')}}",
        dataType:'json',
        contentType: 'application/json',
        data: JSON.stringify(ncd_id),
        success:function(response){
          console.log(response);
          config=response[0];
          if(response[0]!=null){
            
            $("#ncd_pid,#ncdV_pid").val(response[0]["Pid"]);
            $("#ncd_fid,#ncdV_fid").val(response[0]["FuchiaID"]);
            //
            // $("#age_current").text(response[0]["C_Agey"]);
            $("#ncd_sex").text(response[0]["Gender"]);
            $("#ncd_residence").text(response[0]["Region"]);
            $("#ncd_town").text(response[0]["Township"]);
            if(response[0]["Height"]=="Invalid value"){
              $("#ncd_Rheight").val("");
              follow_height="";
            }else{
              $("#ncd_Rheight").val(response[0]["Height"]);
              follow_height=response[0]["Height"];
            }
            $("#ncd_Rweight,#ncdV-weight").val(response[0]["Weight"])
            // $("#ncd_regstrDate").val(today);
            $(".follow_timeLabel").text("");
            $(".cancel-btn").remove();
            Clinic_Code=response[0]['Clinic Code']
            var patient_info = 
                                "Name-" + response[0]['Name'] + $("<span>").css("margin-left", "3%").prop('outerHTML') +
                                "Father Name-" + response[0]['Father'];
            $(".follow_timeLabel").append(patient_info);
            $("#age_visit").text(response[0]["Current Agey"]);
          }
          if(Object.keys(response[1]).length>1){
              ncd_UPsave="Ncd Register Updated";
              $(".ncd_followTime h2").text("NCD Existing Patient");
              $("#ncd_regIDchange").prop("disabled",false);
              $("#ncd_regIDchange").prop("checked",false);
              $("#ncd_pid,#ncd_fid,.ncd-generalCode button").prop("disabled",true);
              var fill_dataKey=Object.keys(response[1])//to fill data get array name
              rowid=response[1]['rowid'];
              $(".follow_datalist").remove();
              $(".follow_timeLabel").append("Follow-" + response[2].length + $("<span>").css("margin-left", "3%").prop('outerHTML'));

              let BPdata=["1st_bptop","1st_bpbot","2nd_bptop","2nd_bpbot","3rd_bptop","3rd_bpbot"]// to fill BP Ncd
              let BP_name=["fisrtBp","secondBp","thirdBp"]
              var bpNo=0;
              for (let bp_name = 0; bp_name < BP_name.length; bp_name++) {
              	if(response[1][BP_name[bp_name]] == null || response[1][BP_name[bp_name]]== undefined){
              		console.log("BP null");
              	}else{
              		var bpSplit=response[1][BP_name[bp_name]].split("/")
                  $("#"+BPdata[bpNo++]).val(bpSplit[0]);
                  $("#"+BPdata[bpNo++]).val(bpSplit[1]);
                  console.log(bpSplit);
              	}
                
                
              } //fill BP data 

              for (let ncd_Rdata = 0; ncd_Rdata < fill_dataKey.length; ncd_Rdata++) {
                if($("#"+fill_dataKey[ncd_Rdata]).is("input,select")){
                  $("#"+fill_dataKey[ncd_Rdata]).val(response[1][fill_dataKey[ncd_Rdata]]);
                }else if($("#"+fill_dataKey[ncd_Rdata]).is("span")){
                  $("#"+fill_dataKey[ncd_Rdata]).text(response[1][fill_dataKey[ncd_Rdata]]);
                }
              } // fill other Register data

              for (let ncdf_count = (response[2].length)-1; ncdf_count >=0 ; ncdf_count--) {
              var follow_list=$("<div>").attr({class:"row no-margin follow_datalist"}).append($("<div>").attr({class:"col-sm-2 no-margin"}).text(Number(ncdf_count)+1))
              .append($("<div>").attr({class:"col-sm-3 no-margin"}).text(response[2][ncdf_count]["Pid"]))
              .append($("<div>").attr({class:"col-sm-3 no-margin"}).text(response[2][ncdf_count]["Visit_date"]))
              .append($("<div>").attr({class:"col-sm-2 no-margin"})
              .append($("<button>").attr({class:"btn btn-info",id:"ncdF_btn_"+response[2][ncdf_count]["id"],onclick:"view_followDetail()"}).text("View Detail")))
              .append($("<div>").attr({class:"col-sm-2 no-margin"})
              .append($("<button>").attr({class:"btn btn-danger",id:"ncdD_btn_"+response[2][ncdf_count]["id"],onclick:"remove_followDetail()"}).text("Delete")));
              $("#ncd_followList").append(follow_list);
              }
              $("#ncd_RegisterBtn").text("Updat-Record")
              $("#ncd_followAdd,#ncd_followView,#ncd_remove_Register").show();
          }else{
              if($("#ncd_regIDchange").is(":checked")){

              }else{
                $(".ncd_followTime h2").text("NCD New Patient");
                $("#ncd_regIDchange").prop("disabled",true);

                $('#ncd_existing').find('input, span,select').not('.ncd-generalInfo input, .ncd-generalInfo span').val('');
                $('#ncdfollow_upAdd').find('input, span,select').not('.ncdV-general input, .ncdV-general span').val('');

                $("#ncd_existing").show();
                $("#ncdfollow_upAdd,#ncd_followAdd,#ncd_followView,#ncd_remove_Register").hide();
                $("#ncd_RegisterBtn").text("Save Record");
                
                ncd_UPsave="";
              }
              

          }//Existing data fill  

            let bmiW=Number($("#ncd_Rweight").val());
            let bmiH=Number($("#ncd_Rheight").val());
            $(".ncd_btn button").prop("disabled",false)
            // $("#ncdV_visit").val(today);
            DateTo_text();
            bmiCalculate(bmiW,bmiH);
            ncd_reg_age()
            $("#ncd_RegisterBmi").text(bmiresut);
          
          

        }})
  }

  function ncd_reg_age(){
    if(config!=null&&config!=""){
      var ncd_redDate=$("#ncd_regstrDate").val();
      if(ncd_redDate.length>4){
        ncd_redDate=ncd_redDate.split("-");
        var born_year=config["Reg Date"].split("-")[0]-config["Agey"];
        var ncd_reg_age=ncd_redDate[2]-born_year;
        $("#age_visit").text(ncd_reg_age);
      }
      
    }else{
      alert("This Patient do not have Confidential");
    }
    

  }
  function ncdRecord(){
    $("#ncd_existing select").each(function(index) {
      var id_name=$(this).attr('id');
      ncdRecord_data[id_name]=$(this).val();
    });
    $("#ncd_existing input").each(function(index) {
      var id_name=$(this).attr('id');
      if($(this).hasClass("Gdate")){
        ncdRecord_data[id_name]=formatDate($(this).val());
      }else{
        ncdRecord_data[id_name]=$(this).val();
      }
      
    });
    $("#ncd_existing span").each(function(index) {
      var id_name=$(this).attr('id');
      ncdRecord_data[id_name]=$(this).text();
    });
    ncdRecord_data["Clinic_Code"]=Clinic_Code;
    ncdRecord_data["notice"]="NCD_Register";
    ncdRecord_data["ncd_saveUpdate"]=ncd_UPsave;
    ncdRecord_data["rowid"]=rowid;


    console.log(ncdRecord_data);
    console.log(Object.keys(ncdRecord_data));
    console.log("Length="+Object.keys(ncdRecord_data).length);
    $.ajaxSetup({
                  headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                }
    });
    $.ajax({
        type:'POST',
        url:"{{route('ncd')}}",
        dataType:'json',
        contentType: 'application/json',
        data: JSON.stringify(ncdRecord_data),
        success:function(response){
          console.log(response);
          alert(response)
          if(response=="success"){
            history.go(0);
          }
          
        }
    })

    
  }
  function ncdfollowRecord(){
    ncdRecord_followdata["Clinic_Code"]=Clinic_Code;
    // ncdRecord_followdata["Agey"]=$("#age_current").text();
    ncdRecord_followdata["Gender"]=$("#ncd_sex").text();
    ncdRecord_followdata["Reg_Date"]=formatDate($("#ncd_regstrDate").val());
    ncdRecord_followdata["Area_Division"]=$("#ncd_residence").text();
    ncdRecord_followdata["Township"]=$("#ncd_town").text();
    ncdRecord_followdata["notice"]="NCD follow save_update";
    ncdRecord_followdata["follow_update"]=follow_update;
    ncdRecord_followdata["follow_height"]=follow_height;
    count=6;
    $("#ncdfollow_upAdd input,#ncdfollow_upAdd select,#ncdfollow_upAdd span").each(function(index){
      var id_name=$(this).attr('id');
      console.log(id_name);
      if($(this).is('input,select')){
        if($(this).hasClass("Gdate")){
          ncdRecord_followdata[id_name]=formatDate($(this).val());
        }else{
          ncdRecord_followdata[id_name]=$(this).val();
        }
        
      }else{
        ncdRecord_followdata[id_name]=$(this).text();
      }
     
    })
    console.log(ncdRecord_followdata)
    $.ajaxSetup({
                  headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                }
    });
    $.ajax({
      type:'POST',
      url:"{{route('ncd')}}",
      dataType:'json',
      contentType: 'application/json',
      data: JSON.stringify(ncdRecord_followdata),
      success:function(response){
        console.log(response)
        alert("successfully save");
        history.go(0);

        
          
      }
    })
  }
  function view_followDetail(){
    var idnumber=event.target.id.match(/\d+/);
    var find_follow={
      notice:"Find Follow History",
      idnumber:idnumber[0],
    }
    console.log(find_follow);
    $.ajaxSetup({
                  headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                }
    });
    $.ajax({
      type:'POST',
      url:"{{route('ncd')}}",
      dataType:'json',
      contentType: 'application/json',
      data: JSON.stringify(find_follow),
      success:function(response){
        console.log(response)
        var ncd_FollowID=Object.keys(response[0]);
        console.log(ncd_FollowID);
        var mamfollowBp=response[0]["mam_Bp"].split("/")
        console.log(mamfollowBp);
        $("#ncdV_mamBp1").val(mamfollowBp[0]);
        $("#ncdV_mamBp2").val(mamfollowBp[1]);
        // $("#ncdV_visit").attr("type","date");
        // $("#ncdV_visit").parent().removeClass("dateicon")
        // $("#ncdV_visit").parent().children().last().remove();
        if(response[0]["ncdV_time"]!=null){
          var ncdV_time=response[0]["ncdV_time"].split(":");
          $("#ncdV_hours").val(ncdV_time[0]);
          $("#ncdV_minutes").val(ncdV_time[1]);
          $("#ncdV_AP").val(ncdV_time[3]);
        }

        for (let ncdFollow = 0; ncdFollow < ncd_FollowID.length; ncdFollow++) {
          if($("#"+ncd_FollowID[ncdFollow]).is("input,select")){
            $("#"+ncd_FollowID[ncdFollow]).val(response[0][ncd_FollowID[ncdFollow]]);
          }else{
            $("#"+ncd_FollowID[ncdFollow]).text(response[0][ncd_FollowID[ncdFollow]]);
          }
          
        }
        $("#ncd_existing").removeClass("freeze-body").css("opacity",1);
        $("#ncd_followList,#ncd_existing").hide();
        $("#ncdfollow_upAdd").show()
        $("#ncdV_saveUp").text("Update-History")
        follow_update="NCD Follow Updated";
        ncdRecord_followdata["Follow_updateID"]=idnumber;
        $("#ncdV_pid,#ncdV_fid").prop("disabled",false);
        outCome_applicable()

        DateTo_text();

        
          
      }
    })
  }

  function Follow_cancel(){
    $("#ncd_existing").removeClass("freeze-body").css("opacity",1);
    $("#ncd_followList").hide();
  }

  function remove_followDetail(){
    var idnumber=event.target.id.match(/\d+/)[0];
    var pid=$(event.target).parent().siblings(':nth-child(2)').text();;

    var find_follow={
      notice:"Remove_follow",
      idnumber:idnumber,
      pid:pid,
    }
    console.log(find_follow);
    if(confirm("Are you sure Delete this Row")){
      $.ajaxSetup({
                  headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                }
      });
      $.ajax({
        type:'POST',
        url:"{{route('ncd')}}",
        dataType:'json',
        contentType: 'application/json',
        data: JSON.stringify(find_follow),
        success:function(response){
          
          if(response==1){
            alert("Success Delete");
            findncd_patient();
          }else{
            alert("Wrong permission")
          }
          
        }
      })
    }
    
  }

  function remove_register(){
    var find_follow={
      notice:"Remove register",
      pid:config["Pid"],
    }
    console.log(find_follow);
    if(confirm("Are you sure Delete this  all NCD data")){
      $.ajaxSetup({
                  headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                }
      });
      $.ajax({
        type:'POST',
        url:"{{route('ncd')}}",
        dataType:'json',
        contentType: 'application/json',
        data: JSON.stringify(find_follow),
        success:function(response){
          
          if(response==1){
            alert("Success Delete");
            history.go(0);
          }else{
            alert("Wrong permission")
          }
          
        }
      })
    }
  }

  function next(){
    history.go(0);
  }

</script>

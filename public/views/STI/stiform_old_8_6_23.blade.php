@extends('layouts.app')
  
@section('content')
@auth
 <body ></body>  <!--onload="findRegisterData()" onlod function change form gender//yenaing -->
  <div class="container containers assist-sti ">
    <!-- Nav pills -->
    <h2 class="header-text ">STI Entry</h2>
    <p class="btn-gnavi">
				<span></span>
				<span></span>
				<span></span>
			</p>
    <ul class="nav nav-tabs toggle sti-colist"id="hidden-title">
        <li class="nav-item">
          <a class="nav-link active toggle-link" data-toggle="pill" href="#home">Register</a>
        </li>
        <li class="nav-item">
          <a class="nav-link toggle-link" data-toggle="pill" onclick="" href="#menu1">Physical Exam</a>
        </li>
        <li class="nav-item">
          <a class="nav-link toggle-link" data-toggle="pill" onclick="" href="#menu2">Lab Results & Treatment</a>
        </li>
        <li>
          <a class="nav-link toggle-link"  data-toggle="pill" onclick="" href="#menu3">Follow Up History</a>
        </li>
        <li>
          <a class="nav-link toggle-link" data-toggle="pill" onclick="" href="#menu4">RPR Test History</a>
        </li>
        <li>
          <a class="nav-link " data-toggle="pill" onclick="" href="#"> *** </a>
        </li>
        <li>
          <a class="nav-link toggle-link" data-toggle="pill" onclick="" href="#menu5">Search and Update</a>
        </li>
        <li>
          <div class="col-sm-12" id="gChoice"></div>
        </li>
        <li>
            <h5 id="toshow"></h5>
        </li>
      </ul>
    <!-- Page content -->
    <!-- Data descriptin  Yes== 1, No== 0, NA=Missing== 9, Within 3 months==1,> 3months ago == 2,from HE team ==1,from partner==2,
        from others==3, symptomatic==1,asymptomatic==0,abundant==1,normal==0,paingfull==1,painless==0, single==1,multiple==2,
         clear==1,white==2,yellow==3,bloody==4,other==5,unilateal==1,bilateral==2,tender=1,non_tender==0,visible==1,not-visible==0,
         smell+ == 1,smell- ==0,
     -->
        <!-- Tab panes -->
      <div class="tab-content assist-parent-div">
          <div class="tab-pane  active" id="home">
            <div>
              <button type="button" id="btn_refresh" onclick="wd_reload()">Refresh</button>
            </div>
            <div id="registerForm" >
                <div class="register-first-section"> <!-- register-first-section  -->
                    <br>
                    <div class="row sti-Id">
                      <div class="col-sm-3">
                          <label for="validationCustom01" class="form-label">General ID</label>
                        <div class="input-group mb-3">
                            <input type="number" id="pid" class="form-control" >
                            <div class="input-group-append no-margin">
                              <button class="btn btn-primary" onclick="findRegisterData()" type="button" id="pid-search">Search</button>
                            </div>
                        </div>
                        <!-- onclick="findRegisterData()" -->
                      </div>
                      <div class="col-sm-2">
                          <label for="validationCustom01" class="form-label">Fuchia ID</label>
                          <input id="fuchia" class="form-control" id="validationCustom01" >
                          <div class="valid-feedback">
                            Plz put number
                          </div>
                      </div>
                        <div class="col-sm-2">
                            <label for="validationCustom01" class="form-label">Age</label>
                            <span id="age"   class="form-control" ></span>
                          </div>
                          <div class="col-sm-2">
                              <label for="validationCustom01" class="form-label">Gender</label>
                              <span id="gender" class="form-control" id="validationCustom01" ></span> 
                                                            
                          </div>
                      </div>
                      <!-- <div class="col-sm-3">
                        <label for="validationCustom01" class="form-label">Select Male or Female Form</label>
                        <select class="form-control" id="genderbtn"  onchange="gender()" name="" >
                          <option value="NA"></option>
                          <option value="male">Male Form</option>
                          <option value="female">Female Form</option>
                        </select>
                      </div> -->
                      <div class="col-sm-4">

                      </div>
                      <div class="col-sm-4">

                      </div>
                    </div>
                    <div class="row sti-firstSecond">

                      <div class="col-sm-3">
                          <label for="validationCustom01" class="form-label">First Visit</label>
                          <select class="form-control" id="firstVisit"  name="" >
                            <option value="0"></option>
                            <option value="1">Yes</option>
                            <option value="2">No</option>
                            <option value="9">Missing</option>
                          </select>
                        </div>
                        <div class="col-sm-3">
                            <label for="validationCustom01" class="form-label">If Last Visit</label>
                            <select class="form-control" id="lastVisit"  name="" >
                              <option value="0"></option>
                              <option value="1">Within 3 months</option>
                              <option  value="2"> > 3 months ago</option>
                              <option value="9">Missing</option>
                            </select>
                          </div>
                          <div class="col-md-3">
                              <label  class="form-label">Heard about clinic</label>
                              <select class="form-control" id="aboutclinic" required>
                                <option value="0"></option>
                                <option value="1">From HE Team</option>
                                <option value="2">From Partner</option>
                                <option value="3">From Others</option>
                                <option value="4">Missing</option>

                              </select>
                            </div>
                            <div class="col-sm-3">
                                <label for="validationCustom01" class="form-label">Registration/Follow-Up Date</label>
                                <!-- <input required id="regdate" onchange="duplicateClear()" type="date"  class="form-control" id="validationCustom01"  > -->
                                <input id="regdate" type="date"  onblur="duplicateClear()"  class="form-control" id="validationCustom01" asp-for="regdate" asp-format="{0:yyyy-MM-dd}"  >
                                <div class="valid-feedback">
                                  <!-- pattern="yy-mm-dd" -->
                                  Plz put number
                                </div>
                              </div>
                    </div>
                    <br>
                </div>  
               <div class="register-second-section row">
                  <h2 class="sti-diagnosis">STI diagnosis</h2>
                  <div class="col-sm-6 sti-check hide " id="lastVisit_Check">
                      <span id="lastVisit_Date" class="badge badge-dark"> Check </span>
                  </div>           
                  <div class="row sti-risk">
                        <div class="col-sm-3">
                           <label for="validationCustom01" class="form-label">Episode</label>
                            <select class="form-select" id="episode" name="" >
                              <option value="0"></option>
                              <option value="1">Yes</option>
                              <option value="2">No</option>
                              <option value="9">Missing</option>
                            </select>
                        </div>
                        <div class="col-sm-3">
                          <label for="validationCustom01" class="form-label">Reasons For Visit</label>
                          <select onchange="visit()" class="form-select" id="reason" name="" >
                            <option value="0"></option>
                            <option value="1">Symptomatic</option>
                            <option value="2">Asymptomatic</option>
                            <option value="9">Missing</option>
                          </select>
                        </div>
                        <div class="col-sm-3" id="m1">
                            <label for="validationCustom01" class="form-label">Risk Factor_Male</label>
                            <!-- <select class="form-select"id="ptype"  >
                                <option value="0"></option>
                                <option value="MSM">MSM </option>
                                <option value="TGW">TGW</option>
                                <option value="CFSW">Client of FSW</option>
                                <option value="PWID">PWID</option>
                                <option value="PWUD">PWUD</option>
                                <option value="P_of_KP">Partner of KP</option>
                                <option value="Other">Other</option>
                              </select> -->
                              <span class="form-control"id="ptype"></span>
                            </div>
                            <div  id="f1" class="col-sm-3">
                                <label for="validationCustom01" class="form-label">Risk Factor_Female</label>
                                <span class="form-control"id="fe_ptype"></span>
                                <!-- <select class="form-select"id="fe_ptype">
                                  <option value=""></option>
                                  <option id="preg_mom" value="Pregnant Mother">Pregnant Mother</option>
                                  <option id="sp_preg_mom" value="Spouse of pregnant mother">Spouse of pregnant mother</option>
                                  <option id="" value="Exposed Children">Exposed Children</option>
                                  <option id="" value="Low risk">Low risk</option>
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
                                  </select> -->
                                </div>
                                
                  </div>
                  <div>
                  <div class="row sti-male sti-registerMale" id="sti-maleID"> <!-- male -->
                    <h2>Test For Male</h2>
                   <div class="col-sm-3"id="m2">
                      <label for="validationCustom01" class="form-label">Urethral discharge</label>
                      <select class="form-select" id="urethral_discharge" name="" >
                        <option value="0"></option>
                        <option value="1">Yes</option>
                        <option value="2">No</option>
                        <option value="9">Missing</option>
                      </select>
                    </div>
                    <div class="col-sm-3" id="m3">
                      <label for="validationCustom01" class="form-label">How long days</label>
                      <input id="howlong_days" type="number" class="form-control" id="validationCustom01">
                      <div class="valid-feedback">
                        Plz put number
                      </div>
                    </div>
                    <div class="row">
                       <div class="col-sm-3" id="m4">
                         <label for="validationCustom01" class="form-label">Scrotal Swelling</label>
                         <select id="scrotal_swelling"class="form-select" name="" >
                           <option value="0"></option>
                           <option value="1">Yes</option>
                           <option value="2">No</option>
                           <option value="9">Missing</option>
                         </select>
                       </div>
                      
                       <div class="col-sm-3" id="m5">
                         <label for="validationCustom01" class="form-label">How Long</label>
                         <input id="hl_scrotal_swelling" type="text" class="form-control" id="validationCustom01">
                       </div>
                       <div class="col-sm-3"id="m6">
                         <label for="validationCustom01" class="form-label">Tender/ Non-Tender</label>
                         <select id="tender"class="form-select" name="" >
                           <option value="0"></option>
                           <option value="1">tender</option>
                           <option value="2">Non-tender</option>
                           <option value="9">Missing</option>
                         </select>
                       </div>
                   </div>
                  </div>
                
              
                <div id="sti-femaleID" class="sti-female sti-registerFemale"><!-- femmale div--> 
                    <h2>Test For female</h2> 
                    <div class="row">  <!-- femmale -->
                      <div class="col-sm-3" id="f2">
                          <label for="validationCustom01" class="form-label">Abnormal vaginal discharge</label>
                          <select class="form-select" id="abVagdischarge"  >
                            <option value="0"></option>
                            <option value="1">Yes</option>
                            <option value="2">No</option>
                            <option value="9">Missing</option>
                          </select>
                      </div>
                      <div class="col-sm-2" id="f3">
                          <label for="validationCustom01" class="form-label">How Long</label>
                          <input type="number"class="form-control" id="hl_ab_va_dis"name="" value="0">
                      </div>
                    </div>
                    <div class="row"><!-- femmale -->
                      <div class="col-sm-3" id="f4">
                          <label for="validationCustom01" class="form-label">Linked with menstruation</label>
                          <select class="form-select" id="Link_menstra"  >
                            <option value="0"></option>
                            <option value="1">Yes</option>
                            <option value="2">No</option>
                            <option value="9">Missing</option>
                          </select>
                      </div>
                      <div class="col-sm-2" id="f5">
                          <label for="validationCustom01" class="form-label">Amount</label>
                          <select class="form-select" id="Amount"  >
                            <option value="0"></option>
                            <option value="1">Abundant</option>
                            <option value="2">Normal</option>
                            <option value="2">NA</option>
                          </select>
                      </div>
                      <div class="col-sm-2" id="f6">
                          <label for="validationCustom01" class="form-label">Colour</label>
                          <select class="form-select" id="colour" onchange="col()" >
                            <option value="0"></option>
                            <option value="1">Clear</option>
                            <option value="2">White</option>
                            <option value="3">Yellow</option>
                            <option value="4">Bloody</option>
                            <option value="5">Other</option>
                            <option value="9">Missing</option>
                          </select>
                      </div>
                      <div class="col-sm-3" id="f14">
                          <label for="validationCustom01" class="form-label">Other(Specify)</label>
                          <input type="text"class="form-control" id="other_specify"name="" value="0">
                      </div>
                    </div>
                    <div class="row"><!-- femmale -->
                      <div class="col-sm-3" id="f7">
                          <label for="validationCustom01" class="form-label">Abnormal vaginal odour</label>
                          <select class="form-select" id="odour"  >
                            <option value="0"></option>
                            <option value="1">Yes</option>
                            <option value="2">No</option>
                            <option value="9">Missing</option>
                          </select>
                      </div>
                      <div class="col-sm-3" id="f8">
                          <label for="validationCustom01" class="form-label">Lower abdominal pain </label>
                          <select class="form-select" id="lower_abd_pain"  >
                            <option value="0"></option>
                            <option value="1">Yes</option>
                            <option value="2">No</option>
                            <option value="9">Missing</option>
                          </select>
                      </div>
                      <div class="col-sm-2" id="f9">
                          <label for="validationCustom01" class="form-label">How Long</label>
                          <input class="form-control" type="number" id="hl_abd_pain"name="" value="0">
                      </div>
                    </div>
                    <div class="row"><!-- femmale -->
                      <div class="col-sm-2" id="f10">
                          <label for="validationCustom01" class="form-label">Fever </label>
                          <select class="form-select" id="fever"  >
                            <option value="0"></option>
                            <option value="1">Yes</option>
                            <option value="2">No</option>
                            <option value="9">Missing</option>
                          </select>
                      </div>
                      <div class="col-sm-4" id="f11">
                          <label for="validationCustom01" class="form-label">Recent Termination Pregnancy </label>
                          <select class="form-select" id="terminate_preg"  >
                            <option value="0"></option>
                            <option value="1">Yes</option>
                            <option value="2">No</option>
                            <option value="9">Missing</option>
                          </select>
                      </div>
                      <div class="col-sm-2" id="f12">
                          <label for="validationCustom01" class="form-label">Dyspareunia</label>
                          <select class="form-select" id="dyspareunia"  >
                            <option value="0"></option>
                            <option value="1">Yes</option>
                            <option value="2">No</option>
                            <option value="9">Missing</option>
                          </select>
                      </div>
                    </div>
                    <div class="row"><!-- femmale -->
                      <div class="col-sm-12" id="f13">
                          <label for="validationCustom01" class="form-label">Other GI Symptoms</label>
                          <input type="text"class="form-control" id="oth_gi_sym"name="" value="0">
                      </div>
                    </div>
                    </div> 
                    <div class="sti-common sti-registerCommon" id="sti-commonID">  <!-- common div -->   
                      <h2>Test For Any Sex</h2> 
                    <div class="row"><!-- common -->
                          <div class="col-sm-3" id="g1">
                                <label for="validationCustom01" class="form-label">Dysuria</label>
                                <select class="form-select" id="dysuria" name="" >
                                  <option value="0"></option>
                                  <option value="1">Yes</option>
                                  <option value="2">No</option>
                                  <option value="9">Missing</option>
                                </select>
                            </div>
                          <div class="col-sm-3"id="g2">
                                <label for="validationCustom01" class="form-label">How long</label>
                                <input id="howlong_dysuria" type="number" max="250" class="form-control" id="validationCustom01">
                                <div class="valid-feedback">
                                  Plz put number
                                </div>
                            </div>
                          <div class="col-sm-3"id="g3">
                                      <label for="validationCustom01" class="form-label">Genital Prutitus</label>
                                      <select class="form-select" id="genital_prutitus" name="" >
                                        <option value="0"></option>
                                        <option value="1">Yes</option>
                                        <option value="2">No</option>
                                        <option value="9">Missing</option>
                                      </select>
                            </div>
                          <div class="col-sm-3"id="g4">
                                <label for="validationCustom01" class="form-label">How long</label>
                                <input id="howlong_genital_pruti" type="number" max="250" class="form-control" id="validationCustom01">
                                <div class="valid-feedback">
                                  Plz put number
                                </div>
                            </div>
                    </div>
                    <div class="row"><!-- common -->
                          <div class="col-sm-4"id="g5">
                                    <label for="validationCustom01" class="form-label">Genital burnig or Pain</label>
                                    <select class="form-select" id="genital_burn" name="" >
                                      <option value="0"></option>
                                      <option value="1">Yes</option>
                                      <option value="2">No</option>
                                      <option value="9">Missing</option>
                                    </select>
                                  </div>
                          <div class="col-sm-3"id="g6">
                                    <label for="validationCustom01" class="form-label">How Long</label>
                                    <input id="howlong_genital_burn" type="number" class="form-control" id="validationCustom01">
                                    <div class="valid-feedback">
                                      Plz put number
                                    </div>
                                  </div>
                    </div>
                    <div class="row"><!-- common -->
                          <div class="col-sm-2"id="g7">
                                    <label for="validationCustom01" class="form-label">Genital ulcer</label>
                                    <select id="genital_ulcer"class="form-select" name="" >
                                      <option value="0"></option>
                                      <option value="1">Yes</option>
                                      <option value="2">No</option>
                                      <option value="9">Missing</option>
                                    </select>
                                  </div>
                          <div class="col-sm-2"id="g8">
                                    <label for="validationCustom01" class="form-label">How Long</label>
                                    <input id="howlong_genital_ulcer" type="text" class="form-control" id="validationCustom01">

                                  </div>
                          <div class="col-sm-2"id="g9">
                                    <label for="validationCustom01" class="form-label">Pain</label>
                                    <select id="pain"class="form-select" name="" >
                                      <option value="0"></option>
                                      <option value="1">Painful</option>
                                      <option value="2">Painless</option>
                                      <option value="9">Missing</option>
                                    </select>
                                  </div>
                          <div class="col-sm-2"id="g10">
                                    <label for="validationCustom01" class="form-label">Ulcer</label>
                                    <select id="ulcer"class="form-select" name="" >
                                      <option value="0"></option>
                                      <option value="1">Single</option>
                                      <option value="2">Multiple</option>
                                      <option value="9">Missing</option>
                                    </select>
                                  </div>
                          <div class="col-sm-4"id="g11">
                                    <label for="validationCustom01" class="form-label">Prodormal itch/buring</label>
                                    <select id="prodormal_itch"class="form-select" name="" >
                                      <option value="0"></option>
                                      <option value="1">Yes</option>
                                      <option value="2">No</option>
                                      <option value="9">Missing</option>
                                    </select>
                                  </div>
                          <div class="col-sm-4"id="g12">
                                    <label for="validationCustom01" class="form-label">Started as vesicles /blisters</label>
                                    <select id="start_vesicles"class="form-select" name="" >
                                      <option value="0"></option>
                                      <option value="1">Yes</option>
                                      <option value="2">No</option>
                                      <option value="9">Missing</option>
                                    </select>
                                  </div>
                          <div class="col-sm-2"id="g13">
                                    <label for="validationCustom01" class="form-label">Recurrent</label>
                                    <select id="recurrent"class="form-select" name="" >
                                      <option value="0"></option>
                                      <option value="1">Yes</option>
                                      <option value="2">No</option>
                                      <option value="9">Missing</option>
                                    </select>
                                  </div>
                          <div class="col-sm-2"id="g14">
                                    <label for="validationCustom01" class="form-label">Last Episode</label>
                                    <select id="last_episode"class="form-select" name="" >
                                      <option value="0"></option>
                                      <option value="1">Yes</option>
                                      <option value="2">No</option>
                                      <option value="9">Missing</option>
                                    </select>
                                  </div>
                          <div class="col-sm-4"id="g15">
                                    <label for="validationCustom01" class="form-label">Patient Suspects Herpes</label>
                                    <select id="patient_suspect_herpes"class="form-select" name="" >
                                      <option value="0"></option>
                                      <option value="1">Yes</option>
                                      <option value="2">No</option>
                                      <option value="9">Missing</option>
                                    </select>
                                  </div>
                      </div>
                    <div class="row"><!-- common -->
                          <div class="col-sm-3" id="g16">
                            <label for="validationCustom01" class="form-label">Inguinal lymph node</label>
                            <select id="inguinal_lymph_node"class="form-select" name="" >
                              <option value="0"></option>
                              <option value="1">Yes</option>
                              <option value="2">No</option>
                              <option value="9">Missing</option>
                            </select>
                          </div>
                          <div class="col-sm-2" id="g17" >
                            <label for="validationCustom01" class="form-label">How Long</label>
                            <input id="hl_inguinal_lymph_node" type="text" class="form-control" id="validationCustom01">
                          </div>
                          <div class="col-sm-3" id="g18">
                            <label for="validationCustom01" class="form-label">Unilateal/Bilateral</label>
                            <select id="unilateal"class="form-select" name="" >
                              <option value="0"></option>
                              <option value="1">Unilateal</option>
                              <option value="2">Bilateral</option>
                              <option value="9">Missing</option>
                            </select>
                          </div>
                          <div class="col-sm-4" id="g19" >
                            <label for="validationCustom01" class="form-label">Leg ulcer/other infection</label>
                            <select id="leg_ulcer_inf"class="form-select" name="" >
                              <option value="0"></option>
                              <option value="1">Yes</option>
                              <option value="2">No</option>
                              <option value="9">Missing</option>
                            </select>
                          </div>
                      </div>
                      <div class="row"><!-- common -->
                          <div class="col-sm-3"id="g20">
                            <label for="validationCustom01" class="form-label">Genital Warts</label>
                            <select id="genital_wart"class="form-select" name="" >
                              <option value="0"></option>
                              <option value="1">Yes</option>
                              <option value="2">No</option>
                              <option value="9">Missing</option>
                            </select>
                          </div>
                          <div class="col-sm-2"id="g21">
                            <label for="validationCustom01" class="form-label">How Long</label>
                            <input id="hl_genital_wart" type="text" class="form-control" id="validationCustom01">
                          </div>
                      </div>
                    </div>
                  </div>
               </div>  
            </div>
          
          <div class="tab-pane  fade sti-phySection"  id="menu1">
            <div class="followup phyExam-section" id="followup" >

                <br>
                  <div class="row sti-exam">
                    <div class="col-sm-3">
                       <label for="validationCustom01" class="form-label">Physical Exam</label>
                        <select class="form-select"  id="physical_exam" name="" onchange="stiPhysical()">
                          <option value="0"></option>
                          <option value="1">Yes</option>
                          <option value="2">No</option>
                          <option value="9">Missing</option>
                        </select>
                    </div>
                  </div>
                  <div class="row sti-female sti-phyfemale" id="stiPhy-femaleID"><!-- female -->
                     <h2>Test For Female</h2>
                    <div class="col-sm-3 wash-v3ah" id="f15">
                       <label for="validationCustom01" class="form-label">Washed inside < 1 hour </label>
                        <select class="form-select" id="wash_inside" name="" >
                          <option value="0"></option>
                          <option value="1">Yes</option>
                          <option value="2">No</option>
                          <option value="9">Missing</option>
                        </select>
                    </div>
                    <div class="col-sm-3 wash-v3ah" id="f16">
                       <label for="validationCustom01" class="form-label">Vulvar erythema</label>
                        <select class="form-select"id="vulvar_erythema" name="" >
                          <option value="0"></option>
                          <option value="1">Yes</option>
                          <option value="2">No</option>
                          <option value="9">Missing</option>
                        </select>
                    </div>
                    <div class="col-sm-3 wash-v3ah" id="f17">
                       <label for="validationCustom01" class="form-label">Vulvar odema</label>
                        <select class="form-select" id="vulvar_odema" name="" >
                          <option value="0"></option>
                          <option value="1">Yes</option>
                          <option value="2">No</option>
                          <option value="9">Missing</option>
                        </select>
                    </div>
                    <div class="col-sm-3 wash-v3ah" id="f18">
                       <label for="validationCustom01" class="form-label">Vaginal Discharge</label>
                        <select class="form-select" id="vag_dis" name="" >
                          <option value="0"></option>
                          <option value="1">Yes</option>
                          <option value="2">No</option>
                          <option value="9">Missing</option>
                        </select>
                    </div>
                    <div class="col-sm-3 wash-v3ah" id="f19">
                       <label for="validationCustom01" class="form-label">Amount</label>
                        <select class="form-select" id="vag_dis_amount" name="" >
                          <option value="0"></option>
                          <option value="1">Abundant</option>
                          <option value="2">Normal</option>
                          <option value="2">NA</option>
                        </select>
                    </div>
                    <div class="col-sm-3 wash-v3ah" id="f20">
                       <label for="validationCustom01" class="form-label">Homogeneous</label>
                        <select class="form-select" id="homogeneous" name="" >
                          <option value="0"></option>
                          <option value="1">Yes</option>
                          <option value="2">No</option>
                          <option value="9">Missing</option>
                        </select>
                    </div>
                    
                    <div class="col-sm-3 wash-v3ah" id="f21">
                       <label for="validationCustom01" class="form-label">Colour</label>
                        <select class="form-select" id="vag_dis_colour" >
                          <option value="1"> Clear</option>
                          <option value="2"> White</option>
                          <option value="3"> Yellow</option>
                          <option value="4"> Bloody</option>
                          <option value="2"> NA</option>
                        </select>
                    </div>
                    <div class="col-sm-3 wash-v3ah" id="f22">
                       <label for="validationCustom01" class="form-label">Smell(Without KOH)</label>
                        <select class="form-select" id="smell_koh" name="" >
                          <option value="0"></option>
                          <option value="1">Smell(+)</option>
                          <option value="2">Smell(-)</option>
                          <option value="3">NA</option>
                        </select>
                    </div>
                    <div class="col-sm-12" id="f31">
                       <label for="validationCustom01" class="form-label">Location</label>
                       <Input id="genital_ulc_location"  class="form-control" >
                     </div>
                    <div class="row"><!-- female -->
                     <div class="col-sm-3" id="f23">
                       <label for="validationCustom01" class="form-label">Vaginal wall injury</label>
                        <select class="form-select" id="phi_vag_wall" name="" >
                          <option value="0"></option>
                          <option value="1">Yes</option>
                          <option value="2">No</option>
                          <option value="9">Missing</option>
                        </select>
                    </div>
                    <div class="col-sm-3" id="f24">
                       <label for="validationCustom01" class="form-label">Adnexal tenderness</label>
                        <select class="form-select" id="phi_ad_tender" name="" >
                          <option value="0"></option>
                          <option value="1">Yes</option>
                          <option value="2">No</option>
                          <option value="9">Missing</option>
                        </select>
                     </div>
                     <div class="col-sm-3" id="f25">
                       <label for="validationCustom01" class="form-label">Adnexal enlargement</label>
                        <select class="form-select" id="phi_ad_enlarge" name="" >
                          <option value="0"></option>
                          <option value="1">Yes</option>
                          <option value="2">No</option>
                          <option value="9">Missing</option>
                        </select>
                    </div>
                   </div>
                   <div class="row"><!-- female -->
                    <div class="col-sm-3" id="f29">
                      <label for="validationCustom01" class="form-label">Genital blisters</label>
                      <select id="genital_blisters"  class="form-select" name="" >
                        <option value="0"></option>
                        <option value="1">Yes</option>
                        <option value="2">No</option>
                        <option value="9">Missing</option>
                      </select>
                    </div>
                    <div class="col-sm-9" id="f30">
                       <label for="validationCustom01" class="form-label">Location</label>
                       <Input id="genital_blisters_location"  class="form-control" >
                     </div>
                   </div>
                    <div class="col-sm-3" id="f26">
                       <label for="validationCustom01" class="form-label">KOH smell test</label>
                        <select class="form-select" id="phi_koh_smell" name="" >
                          <option value="0"></option>
                          <option value="1">Smell(+)</option>
                          <option value="2">Smell(-)</option>
                          <option value="9">Missing</option>
                        </select>
                    </div>
                    <div class="col-sm-3" id="f27">
                       <label for="validationCustom01" class="form-label">pH Vagina</label>
                        <select class="form-select" id="phi_ph_vagina" name="" >
                          <option value="0"></option>
                          <option value="<=4.5"> <=4.5 </option>
                          <option value=">=4.6"> >=4.6 </option>
                          <option value="Miss">Missing</option>
                        </select>
                    </div>
                    <div class="col-sm-12" id="f28">
                       <label for="validationCustom01" class="form-label">Make drawing and describe</label>
                        <Input class="form-control" id="phi_drawing_f" name="" >
                    </div>
                  </div>               
                  <div class="row sti-male sti-phymale" id="stiPhy-maleID">
                     <h2>Test For Male</h2>
                    <div class="col-sm-4 stiPhysical-urinated" id="m7">
                       <label for="validationCustom01" class="form-label">Urinated within < 1 hour before visit</label>
                        <select class="form-select"  id="urinated_within1hr"  >
                          <option value="0"></option>
                          <option value="1">Yes</option>
                          <option value="2">No</option>
                          <option value="9">Missing</option>
                        </select>
                    </div>
                    <div class="col-sm-2" id="m8">
                       <label for="validationCustom01" class="form-label">Discharge</label>
                        <select class="form-select" id="discharge" name="" >
                          <option value="0"></option>
                          <option value="1">Visible</option>
                          <option value="2">Not Visible</option>
                          <option value="2">NA</option>
                        </select>
                    </div>
                    <div class="col-sm-3" id="m9">
                       <label for="validationCustom01" class="form-label">Discharge after milking</label>
                        <select class="form-select"  id="discharge_after_milking" name="" >
                          <option value="0"></option>
                          <option value="1">Visible</option>
                          <option value="2">Not Visible</option>
                          <option value="2">NA</option>
                        </select>
                    </div>
                    <div class="col-sm-2" id="m10">
                       <label for="validationCustom01" class="form-label">Colour</label>
                        <select class="form-select"  id="male_colour" name="" >
                          <option value="0"></option>
                          <option value="1">Clear</option>
                          <option value="2">White</option>
                          <option value="3">Yellow</option>
                          <option value="4">Bloody</option>
                          <option value="2">NA</option>
                        </select>
                    </div>
                    <div class="col-sm-3" id="m11">
                       <label for="validationCustom01" class="form-label">Erythema on glans</label>
                        <select class="form-select"  id="phi_erythema" name="" >
                          <option value="0"></option>
                          <option value="1">Yes</option>
                          <option value="2">No</option>
                          <option value="9">Missing</option>
                        </select>
                    </div>
                    <div class="col-sm-3" id="m12">
                       <label for="validationCustom01" class="form-label">Blisters on Penis</label>
                        <select class="form-select"  id="phi_blister_penis" name="" >
                          <option value="0"></option>
                          <option value="1">Yes</option>
                          <option value="2">No</option>
                          <option value="9">Missing</option>
                        </select>
                    </div>
                    
                   
                    <div class="col-sm-2" id="m13">
                       <label for="validationCustom01" class="form-label">Estimated Size</label>
                       <input id="phi_estimated_size"  class="form-control" type="text" name="" value="0">
                    </div>
                    <div class="col-sm-2" id="m14">
                       <label for="validationCustom01" class="form-label">Scrotal swelling</label>
                        <select class="form-select"  id="phi_scrotal_swelling" name="" >
                          <option value="0"></option>
                          <option value="1">Yes</option>
                          <option value="2">No</option>
                          <option value="9">Missing</option>
                        </select>
                    </div>
                    <div class="col-sm-2" id="m15">
                       <label for="validationCustom01" class="form-label">Estimated Size</label>
                        <select class="form-select"  id="phi_esti_size" name="" >
                          <option value="0"></option>
                          <option value="1">Yes</option>
                          <option value="2">No</option>
                          <option value="9">Missing</option>
                        </select>
                    </div>
                    <div class="col-sm-2" id="m16">
                       <label for="validationCustom01" class="form-label">Unilateal/Bilateral</label>
                        <select class="form-select"  id="phi_unilateal" name="" >
                          <option value="0"></option>
                          <option value="1">Yes</option>
                          <option value="2">No</option>
                          <option value="9">Missing</option>
                        </select>
                    </div>
                    <div class="col-sm-3" id="m17">
                       <label for="validationCustom01" class="form-label">Tender/Non-Tender</label>
                        <select class="form-select"  id="phi_tender_non" name="" >
                          <option value="0"></option>
                          <option value="1">Yes</option>
                          <option value="2">No</option>
                          <option value="9">Missing</option>
                        </select>
                    </div>
                    <div class="col-sm-2" id="m18">
                       <label for="validationCustom01" class="form-label">Erythema</label>
                        <select class="form-select"  id="phi_erythema1" name="" >
                          <option value="0"></option>
                          <option value="1">Yes</option>
                          <option value="2">No</option>
                          <option value="9">Missing</option>
                        </select>
                    </div>
                    <div class="col-sm-4" id="m19">
                       <label for="validationCustom01" class="form-label">Make Drawing and describe size</label>
                        <select class="form-select"  id="phi_drawing" name="" >
                          <option value="0"></option>
                          <option value="1">Yes</option>
                          <option value="2">No</option>
                          <option value="9">Missing</option>
                        </select>
                    </div>
                  </div>
                 <div class="row sti-common sti-phycommon" id="stiPhy-commonID">
                    <h2>Test For Any Sex</h2>
                    <div class="row">
                      <div class="col-sm-3" id="g22">
                        <label for="validationCustom01" class="form-label">Genital ulcer</label>
                          <select class="form-select"  id="phi_genital_ulcer" name="" >
                            <option value="0"></option>
                            <option value="1">Yes</option>
                            <option value="2">No</option>
                            <option value="9">Missing</option>
                          </select>
                      </div>
                      <div class="col-sm-3" id="g23">
                        <label for="validationCustom01" class="form-label">Signle/Multiple</label>
                          <select class="form-select" id="phi_single_multiple" name="" >
                            <option value="0"></option>
                            <option value="1">Single</option>
                            <option value="9">Multiple</option>
                            <option value="9">Missing</option>
                          </select>
                      </div>
                      <div class="col-sm-3" id="g24">
                        <label for="validationCustom01" class="form-label">Painfull/Painless </label>
                          <select class="form-select"  id="phi_painfull" name="" >
                            <option value="0"></option>
                            <option value="1">Painfull</option>
                            <option value="2">Painless</option>
                            <option value="9">Missing</option>
                          </select>
                      </div>
                      <div class="col-sm-3" id="g25" >
                        <label for="validationCustom01" class="form-label">Herpes suspected </label>
                          <select class="form-select"  id="phi_herpes_suspected" name="" >
                            <option value="0"></option>
                            <option value="1">Yes</option>
                            <option value="2">No</option>
                            <option value="9">Missing</option>
                          </select>
                      </div>
                    </div>
                    <div class="row stiPhy-anysexSecond">
                      <div class="col-sm-3"id="g26">
                        <label for="validationCustom01" class="form-label">Inguinal bubo </label>
                          <select class="form-select" id="phi_inguinal_bubo" name="" >
                            <option value="0"></option>
                            <option value="1">Yes</option>
                            <option value="2">No</option>
                            <option value="9">Missing</option>
                          </select>
                      </div>
                      <div class="col-sm-3"id="g27">
                        <label for="validationCustom01" class="form-label">Fluctant </label>
                          <select class="form-select" id="phi_fluctant" name="" >
                            <option value="0"></option>
                            <option value="1">Yes</option>
                            <option value="2">No</option>
                            <option value="9">Missing</option>
                          </select>
                      </div>
                      <div class="col-sm-3"id="g28">
                        <label for="validationCustom01" class="form-label">Tender/non tender </label>
                          <select class="form-select" id="phi_tender" name="" >
                            <option value="0"></option>
                            <option value="1">Yes</option>
                            <option value="2">No</option>
                            <option value="9">Missing</option>
                          </select>
                      </div>
                      <div class="col-sm-3"id="g29">
                        <label for="validationCustom01" class="form-label">Other Leg infection </label>
                          <select class="form-select" id="phi_leg_inf" name="" >
                            <option value="0"></option>
                            <option value="1">Yes</option>
                            <option value="2">No</option>
                            <option value="9">Missing</option>
                          </select>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-3"id="g30">
                        <label for="validationCustom01" class="form-label">Genital Warts</label>
                          <select class="form-select" id="phi_genital_wart" name="" >
                            <option value="0"></option>
                            <option value="1">Yes</option>
                            <option value="2">No</option>
                            <option value="9">Missing</option>
                          </select>
                      </div>
                      <div class="col-sm-3"id="g31">
                        <label for="validationCustom01" class="form-label">Crab lice</label>
                          <select class="form-select" id="phi_crab_lice" name="" >
                            <option value="0"></option>
                            <option value="1">Yes</option>
                            <option value="2">No</option>
                            <option value="9">Missing</option>
                          </select>
                      </div>
                      <div class="col-sm-3"id="g32">
                        <label for="validationCustom01" class="form-label">Scabies</label>
                          <select class="form-select" id="phi_scabies" name="" >
                            <option value="0"></option>
                            <option value="1">Yes</option>
                            <option value="2">No</option>
                            <option value="9">Missing</option>
                          </select>
                      </div>
                    </div> 
                  </div>           
                  
                 </div>
                
                  <br>

              
            </div>
          
          <div class="tab-pane  fade" id="menu2">
              <div class="LabRT-section">
                <br>
                <div class="sti-female sti-labFemale" id="stiLab-femaleID">  <!-- femlae -->
                  <h2>Test for Female</h2>
                  <div class="row" >  <!-- femlae -->
                    
                    <div class="col-sm-6" id="f32">
                       <label for="validationCustom01" class="form-label">Previous STI<br class="tablet">(compl or confirmed)(2)</label>
                        <select class="form-select"  id="cal1" name="" >
                          <option value="0"></option>
                          <option value="1">Yes</option>
                          <option value="2">No</option>
                          <option value="9">Missing</option>
                        </select>
                    </div>
                    <div class="col-sm-6"id="f33" >
                       <label for="validationCustom01" class="form-label">New partner within<br class="tablet"> past 3 months (2)</label>
                        <select class="form-select"  id="cal2" name="" >
                          <option value="0"></option>
                          <option value="1">Yes</option>
                          <option value="2">No</option>
                          <option value="9">Missing</option>
                        </select>
                    </div>
                  </div>
                  <div class="row"> <!-- femlae -->
                    <div class="col-sm-6 female-row " id="f34">
                       <label for="validationCustom01" class="form-label">Patient compl.<br class="tablet">Dysuria or genital ulcer(3)</label>
                        <select class="form-select" id="cal3" name="" >
                          <option value="0"></option>
                          <option value="1">Yes</option>
                          <option value="2">No</option>
                          <option value="9">Missing</option>
                        </select>
                    </div>
                    <div class="col-sm-6" id="f35">
                       <label for="validationCustom01" class="form-label">Partner compl.<br class="tablet">Genital symptoms (3)</label>
                        <select class="form-select"  id="cal4" name="" >
                          <option value="0"></option>
                          <option value="1">Yes</option>
                          <option value="2">No</option>
                          <option value="9">Missing</option>
                        </select>
                    </div>
                  </div>
                  <div class="row"> <!-- femlae -->
                    <div class="col-sm-6 female-row " id="f36">
                       <label for="validationCustom01" class="form-label">Patient compl.<br class="tablet"> Lower abdominal pain (1)</label>
                        <select class="form-select"  id="cal5" name="" >
                          <option value="0"></option>
                          <option value="1">Yes</option>
                          <option value="2">No</option>
                          <option value="9">Missing</option>
                        </select>
                    </div>
                    <div class="col-sm-6"id="f37">
                       <label for="validationCustom01" class="form-label">Sex worker</label><br class="tablet">
                        <select class="form-select"  id="cal6" name="" >
                          <option value="0"></option>
                          <option value="1">Yes</option>
                          <option value="2">No</option>
                          <option value="9">Missing</option>
                        </select>
                    </div>
                  </div>
                  <br>
                  <div class="row" > <!-- femlae -->
                      <div class="col-sm-3 calculate-score" id="f38">
                        <button onclick="calSore()" type="button" class="btn btn-dark">Calculate Score</button>
                      </div>
                      <div class="col-sm-2 calculate-score" id="f39">
                        <label class="form-label">Score</label>
                      </div>
                      <div class="col-sm-2 calculate-score" id="f40">
                        <span id="scoreNum" class="badge bg-danger sti-score">-</span>
                      </div>
                      <div class="col-sm-2 calculate-score"id="f41">
                        <label class="form-label">Risk Group</label>
                      </div>
                      <div class="col-sm-2 calculate-score" id="f42">
                        <span id="risktext"class="badge bg-danger sti-score">-</span>
                      </div>
                  </div>
                  <div class="row" > <!-- femlae -->
                    <div class="col-sm-12 sti-risk-remark" id="f43">
                      <label class="form-label">Risk Remark</label>
                      <input id="riskRemark" class="form-control"type="text" name="" value="0">
                    </div>
                  </div>
                  <div class="row " > <!-- femlae -->
                    <div class="col-sm-12" id="f44">
                      <h2> Do a risk assement for Cervical infection<br class="sti-mobile"><br class="sti-tablet"> (*Spontaneous expressed complaints Only)<br class="sti-mobile"> fof HR<br class="sti-tablet"> women of irregular visit( Last Visit > 3 mths ago).</h2>
                    </div>
                  </div>
                  <div class="row stiPhy-abomal" > <!-- femlae -->
                    <div class="col-sm-6 sti-cervical-infection"id="f45">
                       <label for="validationCustom01" class="form-label">Abnormal yellow discharge (if only abnormal<br class='sti-mobile'> abundant discaarge)(2)</label>
                        <select class="form-select"  id="ab_yellow_discharge" name="" >
                          <option value="0"></option>
                          <option value="1">Yes</option>
                          <option value="2">No</option>
                          <option value="9">Missing</option>
                        </select>
                    </div>
                    <div class="col-sm-6"id="f46">
                       <label for="validationCustom01" class="form-label">Pain during sexual untercourse (1)</label>
                        <select class="form-select"  id="cal7" name="" >
                          <option value="0"></option>
                          <option value="1">Yes</option>
                          <option value="2">No</option>
                          <option value="9">Missing</option>
                        </select>
                    </div>
                  </div>
                  <div class="row " > <!-- femlae -->
                    <div class="col-sm-6 sti-cervical-infection"id="f47">
                       <label for="validationCustom01" class="form-label">Dysuria<br class="sti-tablet">(1)</label>
                        <select class="form-select"  id="cal8" name="" >
                          <option value="0"></option>
                          <option value="1">Yes</option>
                          <option value="2">No</option>
                          <option value="9">Missing</option>
                        </select>
                    </div>
                    <div class="col-sm-6" id="f48">
                       <label for="validationCustom01" class="form-label">Unprotected sex with new clients<br class="sti-tablet"> (1)</label>
                        <select class="form-select"  id="cal9" name="" >
                          <option value="0"></option>
                          <option value="1">Yes</option>
                          <option value="2">No</option>
                          <option value="9">Missing</option>
                        </select>
                    </div>
                  </div>
                  <div class="row " > <!-- femlae -->
                    <div class="col-sm-6 sti-cervical-infection"id="f49">
                       <label for="validationCustom01" class="form-label">Lower abdominal pain<br class="sti-tablet"> (1)</label>
                        <select class="form-select"  id="cal10" name="" >
                          <option value="0"></option>
                          <option value="1">Yes</option>
                          <option value="2">No</option>
                          <option value="9">Missing</option>
                        </select>
                    </div>
                    <div class="col-sm-6" id="f50">
                       <label for="validationCustom01" class="form-label">Partner discharge/ Ulcer<br class="sti-tablet"> (2)</label>
                        <select class="form-select"  id="fe_partner_ulcer" name="" >
                          <option value="0"></option>
                          <option value="1">Yes</option>
                          <option value="2">No</option>
                          <option value="9">Missing</option>
                        </select>
                    </div>
                  </div>

                  
                </div>  
                 <div class="LabTR-patient"> <!-- male -->
                 <div class="sti-male sti-labMale" id="stiLab-maleID">
                  <h2>Test for male</h2>

                  <div class="row"  >
                      <div class="col-sm-12" id="m20">
                        <h2> Do risk assessment for sexual<br class="sti-mobile"> transmitted infection<br class="sti-tablet"> (only for MSM).</h2>
                      </div>
                    </div>
                  <div class="row"  >
                      <div class="col-sm-6"id="m21" >
                        <label for="validationCustom01" class="form-label">Patient's First Visit To Clinic</label>
                        <select class="form-select" id="pt_1st_visit" name="" >
                          <option value="0"></option>
                          <option value="1">Yes</option>
                          <option value="2">No</option>
                          <option value="3">NA</option>
                        </select>
                      </div>
                      <div class="col-sm-6"id="m22">
                        <label for="validationCustom01" class="form-label">Patient's episode of discharge since the last visit.</label>
                        <select class="form-select" id="pt_epi_dis_lastvisit" name="" >
                          <option value="0"></option>
                          <option value="1">Yes</option>
                          <option value="2">No</option>
                          <option value="3">NA</option>
                        </select>
                      </div>
                    </div>
                    <div class="row" >
                      <div class="col-sm-6" id="m23">
                        <label for="validationCustom01" class="form-label">Patient had unproteced sex with new partner.</label>
                        <select class="form-select" id="unprotected_sex" name="" >
                          <option value="0"></option>
                          <option value="1">Yes</option>
                          <option value="2">No</option>
                          <option value="3">NA</option>
                        </select>
                      </div>
                      <div class="col-sm-6" id="m24">
                        <label for="validationCustom01" class="form-label">Patient genital sign/symptoms</label>
                        <select class="form-select" id="genital_sign" name="" >
                          <option value="0"></option>
                          <option value="1">Yes</option>
                          <option value="2">No</option>
                          <option value="3">NA</option>
                        </select>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-12"id="m25">
                        <label for="">If any of above questions answered "Yes" ,Risk assessment (+)</label>
                      </div>
                    </div>
                    
                 </div>
                  <div class="row" ><!-- OI -->
                    <div class="col-sm-12 LabTR-genital">
                    <div class="row" >
                      <div class="col-sm-12"id="g33" >
                        <label class="form-label" for="">Presumptive Diagnosis</label>
                        <input class="form-control" type="text" name="" id="presumptive_diag"value="0">
                      </div>
                    </div>
                      <label for="validationCustom01" class="form-label"></label>
                      <div class="tablet-mobile LbtDisease-block">
                        <ul class="disease-std clearfix">
                          <li id="ucler_li">Genital Ulcer Disease(GUD)s</li>
                          <li id="disharge_li">Genital Disharge Diseases(GDS)s</li>
                          <li id="other_li">Other STDs</li>
                        </ul>
                        <div class="ucler-list clearfix">
                          <ul class="clearfix">
                            <li>
                              <label>Primary Syphillis</label>
                                  <select id="primary_syphillis_tb"class="" name="">
                                    <option value="3">No</option>
                                    <option value="1">Yes</option>
                                  </select>
                            </li>
                            <li>
                              <label>Secondary Syphillis</label>
                              <select id="secondary_syphillis_tb" class="" name="">
                                    <option value="2">No</option>
                                    <option value="1">Yes</option>
                              </select>
                            </li>
                            <li>
                              <label>Chancroid</label>
                              <select id="chancroid_tb" class="" name="">
                                    <option value="2">No</option>
                                    <option value="1">Yes</option>
                              </select>
                            </li>
                            <li>
                              <label>Genital Herpes</label>
                              <select id="genital_herpes3_tb"class="" name="">
                                    <option value="2">No</option>
                                    <option value="1">Yes</option>
                              </select>
                            </li>
                            <li>
                              <label>Genital Scabies</label>
                              <select id="genital_scabies3_tb"class="" name="">
                                    <option value="2">No</option>
                                    <option value="1">Yes</option>
                              </select>
                            </li>
                            <li>
                              <label>Others</label>
                              <select id="others3_tb" class="" name="">
                                    <option value="2">No</option>
                                    <option value="1">Yes</option>
                              </select>
                            </li>
                            
                          <ul>

                        </div>
                        <div class="disharge-list clearfix">
                          <ul class="clearfix">
                            <li>
                              <label>Gonorrhoea</label>
                              <select id="gonorrhoea_tb" class="" name="">
                                  <option value="2">No</option>
                                  <option value="1">Yes</option>
                              </select>
                            </li>
                            <li>
                              <label>Non-Gonococcal Urethritis</label>
                              <select id="non_gono_urethri_tb"class="" name="">
                                  <option value="2">No</option>
                                  <option value="1">Yes</option>
                              </select>
                            </li>
                            <li id="m28">
                              <label>Non-Gonococal proctitis</label>
                              <select id="non_gono_procti_tb" class="" name="">
                                  <option value="2">No</option>
                                  <option value="1">Yes</option>
                              </select>
                            </li>
                            <li>
                              <label>Trichomonas</label>
                              <select id="trichomonas_tb" class="" name="">
                                  <option value="2">No</option>
                                  <option value="1">Yes</option>
                              </select>
                            </li>
                            <li>
                              <label>Gential Candidiosis</label>
                              <select id="genital_candidiosis_tb" class="" name="">
                                  <option value="2">No</option>
                                  <option value="1">Yes</option>
                              </select>
                            </li>
                            <li>
                              <label>Baterial Vaginosis</label>
                              <select id="baterial_vaginosis_tb"class="" name="">
                                  <option value="2">No</option>
                                  <option value="1">Yes</option>
                              </select>

                            </li>
                          </ul>
                        </div>
                        <div class="otherStd-list clearfix">
                          <ul class="clearfix">
                            <li>  
                              <label>Congenial Syphillis</label>
                              <select id="congenial_syphillis_tb" class="" name="">
                                  <option value="2">No</option>
                                  <option value="1">Yes</option>
                              </select>
                            </li>
                            <li>
                            <label>Latent Syphillis</label>
                                <select id="latent_syphillis_tb"class="" name="">
                                  <option value="0"></option>
                                  <option id="latent_syphillis_no" value="2">No</option>
                                  <option id="latent_syphillis_yes" value="1">Yes</option>
                                </select>
                             
                            </li>
                            <li id="f55">
                              <label>Non-Gonococal Cervities</label>
                              <select id="non_gono_cervities_tb" class="" name="">
                                  <option value="2">No</option>
                                  <option value="1">Yes</option>
                              </select>
                            </li>
                            <li id="f56">
                              <label>Latent Syphillis (pregnancy)</label>
                              <select  id="latent_syp_pregancy_tb" class="" name="">
                                  <option value="2">No</option>
                                  <option value="1">Yes</option>
                              </select>
                            </li>
                            <li>
                              <label>Molluscum Contagiosum</label>
                              <select id="molluscum_contagiosum_tb" class="" name="">
                                  <option value="2">No</option>
                                  <option value="1">Yes</option>
                              </select>
                            </li>
                            <li>
                                <label>Bubos</label>
                                <select id="bubos_tb"class="" name="">
                                  <option value="2">No</option>
                                  <option value="1">Yes</option>
                                </select>
                            </li>
                            <li>
                                <label> Genital Warts</label>
                                <select id="genital_warts3_tb"class="" name="">
                                  <option value="2">No</option>
                                  <option value="1">Yes</option>
                                </select>
                            </li>
                            <li>
                                <label>Others</label>
                                <select id="others33_tb"class="" name="">
                                  <option value="2">No</option>
                                  <option value="1">Yes</option>
                                </select>
                            </li>
                           

                          </ul>
                        </div>
                        
                           
                      </div>

                      <div class="table-responsive pc">
                        <table class="table table-borderless">
                          <thead>
                            <tr>
                              <th>Genital Ulcer Disease(GUD)s</th>
                              <th>Genital Disharge Diseases(GDS)s</th>
                              <th>Other STDs</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>
                                <label>Primary Syphillis</label>
                                <select id="primary_syphillis"class="" name="">
                                  <option value="2">No</option>
                                  <option value="1">Yes</option>
                                </select>
                              </td>
                              <td>
                                <label>Gonorrhoea</label>
                                <select id="gonorrhoea" class="" name="">
                                  <option value="2">No</option>
                                  <option value="1">Yes</option>
                                </select>
                              </td>
                              <td style>
                                <label>Congenial Syphillis</label>
                                <select id="congenial_syphillis" class="" name="">
                                  <option value="2">No</option>
                                  <option value="1">Yes</option>
                                </select>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                <label>Secondary Syphillis</label>
                                <select id="secondary_syphillis" class="" name="">
                                  <option value="2">No</option>
                                  <option value="1">Yes</option>
                                </select>
                              </td>
                              <td>
                                <label>Non-Gonococcal Urethritis</label>
                                <select id="non_gono_urethri"class="" name="">
                                  <option value="2">No</option>
                                  <option value="1">Yes</option>
                                </select>
                              </td>
                              <td>
                                <label>Latent Syphillis</label>
                                <select id="latent_syphillis"class="" name="">
                                  <option value="0"></option>
                                  <option id="latent_syphillis_no" value="2">No</option>
                                  <option id="latent_syphillis_yes" value="1">Yes</option>
                                </select>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                <label>Chancroid</label>
                                <select id="chancroid" class="" name="">
                                  <option value="2">No</option>
                                  <option value="1">Yes</option>
                                </select>
                              </td>
                              <td id="m27">
                                <label>Non-Gonococal proctitis</label>
                                <select id="non_gono_procti" class="" name="">
                                  <option value="2">No</option>
                                  <option value="1">Yes</option>
                                </select>
                              </td>
                              <td id="f54">
                                <label>Non-Gonococal Cervities</label>
                                <select id="non_gono_cervities" class="" name="">
                                  <option value="2">No</option>
                                  <option value="1">Yes</option>
                                </select>
                              </td>
                              <td id="f51">
                                <label>Latent Syphillis (pregnancy)</label>
                                <select  id="latent_syp_pregancy" class="" name="">
                                  <option value="2">No</option>
                                  <option value="1">Yes</option>
                                </select>
                              </td>
                              <td>
                                <label>Molluscum Contagiosum</label>
                                <select id="molluscum_contagiosum" class="" name="">
                                  <option value="2">No</option>
                                  <option value="1">Yes</option>
                                </select>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                <label>Genital Herpes</label>
                                <select id="genital_herpes3"class="" name="">
                                  <option value="2">No</option>
                                  <option value="1">Yes</option>
                                </select>
                              </td>
                              <td>
                                <label>Trichomonas</label>
                                <select id="trichomonas" class="" name="">
                                  <option value="2">No</option>
                                  <option value="1">Yes</option>
                                </select>
                              </td>
                              <td>
                                <label>Bubos</label>
                                <select id="bubos"class="" name="">
                                  <option value="2">No</option>
                                  <option value="1">Yes</option>
                                </select>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                <label>Genital Scabies</label>
                                <select id="genital_scabies3"class="" name="">
                                  <option value="2">No</option>
                                  <option value="1">Yes</option>
                                </select>
                              </td>
                              <td>
                                <label>Gential Candidiosis</label>
                                <select id="genital_candidiosis" class="" name="">
                                  <option value="2">No</option>
                                  <option value="1">Yes</option>
                                </select>
                              </td>
                              <td>
                                <label> Genital Warts</label>
                                <select id="genital_warts3"class="" name="">
                                  <option value="2">No</option>
                                  <option value="1">Yes</option>
                                </select>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                <label>Others</label>
                                <select id="others3" class="" name="">
                                  <option value="2">No</option>
                                  <option value="1">Yes</option>
                                </select>
                              </td>
                              <td>
                                <label>Baterial Vaginosis</label>
                                <select id="baterial_vaginosis"class="" name="">
                                  <option value="2">No</option>
                                  <option value="1">Yes</option>
                                </select>
                              </td>
                              <td>
                                <label>Others</label>
                                <select id="others33"class="" name="">
                                  <option value="2">No</option>
                                  <option value="1">Yes</option>
                                </select>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                <br>
                  <div class="row"><!-- treatment -->
                      <div class="col-sm-12">
                        <h3>Treatment (Fill in dose)</h3>
                      </div>
                     </div>
                    <div class="row">
                     <div class="LabRDT-treatment-checkbox"> 
                     <div class="col-sm-3">
                        <input type="checkbox" id="tre_azythro" name="" ><label>1.</label><label> Azythro</label>
                      </div>
                      <div class="col-sm-3">
                        <input type="checkbox" id="tre_cefixim" ><label>2.</label><label> Cefixim</label>
                      </div>
                      <div class="col-sm-3">
                        <input type="checkbox" id="tre_ciprofloxacin" ><label>3.</label><label> Ciprofloxacin</label>
                      </div>
                      <div class="col-sm-3">
                          <input type="checkbox" id="tre_tinidazole" ><label>4.</label><label> Tinidazole</label>
                      </div>
                    
                   
                      <div class="col-sm-3">
                        <input type="checkbox" id="tre_fluconazole" ><label>5.</label><label> Fluconazole</label>
                      </div>
                      <div class="col-sm-3">
                        <input type="checkbox" id="tre_doxycycline" ><label>6.</label><label> Doxycycline</label>
                      </div>
                      <div class="col-sm-3">
                        <input type="checkbox" id="tre_ceftriaxone" ><label>7.</label><label> Ceftriaxone</label>
                      </div>
                      <div class="col-sm-3">
                          <input type="checkbox" id="tre_benzpen" ><label>8.</label><label> Benz Pen</label>
                      </div>
                    
                   
                      <div class="col-sm-3" id="f52" >
                        <input type="checkbox"  id="clotrimazole" ><label>9.</label><label> Clotrimazole vaginal tab</label>
                      </div>
                      <div class="col-sm-3" id="m26" >
                        <input type="checkbox" id="no_treament1" ><label>10.</label><label> No Treatment</label>
                      </div>
                      <div class="col-sm-3" id="f53">
                        <input type="checkbox" id="no_treament" ><label>10.</label> <label>No Treatment</label>
                      </div>
                    
                     </div> 
                  <div class="LabRDT-treatment-allergy"> 
                     <div class="row">
                      <div class="col-sm-3">
                        <label for="validationCustom01" class="form-label">Allergy</label>
                         <select class="form-select" id="allergy" name="" >
                           <option value="0"></option>
                           <option value="1">Yes</option>
                           <option value="2">No</option>
                           <option value="9">Missing</option>
                         </select>
                      </div>
                      <div class="col-sm-3">
                        <label for="validationCustom01" class="form-label">Sulfa</label>
                         <select class="form-select" id="sulfa" name="" >
                           <option value="0"></option>
                           <option value="1">Yes</option>
                           <option value="2">No</option>
                           <option value="9">Missing</option>
                         </select>
                      </div>
                      <div class="col-sm-3">
                        <label for="validationCustom01" class="form-label">Parter Treatment Given</label>
                         <select class="form-select" id="parter_treatment_given" name="" >
                           <option value="0"></option>
                           <option value="1">Yes</option>
                           <option value="2">No</option>
                           <option value="9">Missing</option>
                         </select>
                      </div>
                      <div class="col-sm-3">
                        <label for="validationCustom01" class="form-label">Condom given</label>
                         <select class="form-select" id="condom" name="" >
                           <option value="0"></option>
                           <option value="1">Yes</option>
                           <option value="2">No</option>
                           <option value="9">Missing</option>
                         </select>
                      </div>
                     </div> <!--allgery -->
                    <div class="row">
                      <div class="col-sm-12">
                        <label class="form-label" for="">Remark for Treatment</label>
                        <input class="form-control" type="text" id="remarkTreatment" value="0">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-12">
                        <label class="form-label" for="">Follow Up</label>
                        <input class="form-control" type="text" id="follwupText" value="0">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-12">
                        <label class="form-label" for="">Clinician Name</label>
                        <input class="form-control" type="text" id="clinicainName" value="0">
                      </div>
                    </div>
                  </div>  
                      <br> <!-- Medic -->
               </div>

                   <div class="row sti-button"> <!-- Buttons -->
                     <div class="col-sm-3 show-button" id=save-male>
                         <button id="male_btn" onclick="sendDataMale()" class="btn btn-warning btn-block save-batton">Save(Male)</button>
                     </div>
                     <div class="col-sm-3 show-button" id=update-male>
                         <button id="maleUpdate_btn" onclick="Sti_Male_Updater(updateResp_M)" class="btn btn-success btn-block update-batton">Update STI (Male)</button>
                     </div>
                     <div class="col-sm-3 show-button" id=save-female>
                         <button id="female_btn" onclick="sendDataFemale()" class="btn btn-warning btn-block save-batton">Save(Female)</button>
                     </div>
                     <div class="col-sm-3 show-button" id=update-female>
                         <button id="femaleUpdate_btn" onclick="Sti_Female_Updater(updateResp_F)" class="btn btn-success btn-block update-batton">Update STI (Female)</button>
                     </div>
                   </div>
               </div>
               </div>
               </div>
         
         


         <div class="tab-pane assist-history fade" id="menu3">
            <div class="row ">
              <h2>STI follow up History</h2>
            </div>
            <div class="row" style="margin:auto;">
                    <table class="table table-hover table-bordered" >
                      <thead>
                        <tr>
                          <th >Serial No.</th>
                          <th>Clinic Code</th>
                          <th>Gender</th>
                          <th>Age</th>
                          <th>Risk Factor</th>
                          <th>Visit Date</th>
                        </tr>
                      </thead>
                      <tbody id="testHistory" >
                      </tbody>
                    </table>
            </div>
          </div>
          <div class="tab-pane assist-history fade" id="menu4">
            <div class="row">
              <h2>RPR Test History</h2>
            </div>
                <div class="row" style="margin:auto;">
                    <table class="table table-hover " >
                                  <thead>
                                    <tr>
                                      <th>No.</th>
                                      <th>Row-ID</th>
                                      <th>Visit Date</th>
                                      <th>RPR Result</th>
                                    </tr>
                                  </thead>
                                  <tbody id="rprHistory" >
                                  </tbody>
                                </table>
                </div>
          </div>
          <div class="tab-pane assist-history fade" id="menu5">
            <div class="row">
              <h2>Search Data in STI Register and Update</h2>
            </div>
            <div class="row">
              <div class="col-sm-3">
                <label for="validationCustom01" class="form-label">General ID</label>
                <input id="pid_shar" type='number' class="form-control"  required>
                <!-- <ul>
                  <li class="update-batton">Search to Update<li>
                </ul> -->
              </div>
              <div class="col-sm-3">
              
              <button id="pid_shar"  onclick="findRegDataUpdate()" class="form-control btn btn-warning update-batton general-id" > Search ID</button>
              </div>
            </div>
                <div class="row" style="margin:auto;">
                    <table class="table table-hover " >
                                  <thead>
                                    <tr>
                                      <th>No.</th>
                                      <th>Row-ID</th>
                                      <th>Visit Date</th>

                                    </tr>
                                  </thead>
                                  <tbody id="stiUpdate" >
                                  </tbody>
                                </table>
                
                

          </div>
          
          
      </div>
        
   </div>
  </body>
@endauth
@endsection
<script type="text/javascript" language="javascript">
      var general =['g1','g2','g3','g4','g5','g6','g7','g8','g9','g10',
      'g11','g12','g13','g14','g15','g16','g17','g18','g19','g20',
      'g21','g22','g23','g24','g25','g26','g27','g28','g29','g30',
      'g31','g32','g33'];
      var female =
      ['f1','f2','f3','f4','f5','f6','f7','f8','f9','f10',
      'f11','f12','f13','f14','f15','f16','f17','f18','f19','f20',
      'f21','f22','f23','f24','f25','f26','f27','f28','f29','f30',
      'f31','f32','f33','f34','f35','f36','f37','f38','f39','f40',
      'f41','f42','f43','f44','f45','f46','f47','f48','f49','f50',
      'f51','f52','f53','f54','f55','f56',];
      var male =
      ['m1','m2','m3','m4','m5','m6','m7','m8','m9','m10',
      'm11','m12','m13','m14','m15','m16','m17','m18','m19','m20',
      'm21','m22','m23','m24','m25','m26','m27','m28'];
      var resp = 0;var rowNo=0; var updateResp_M=0; var rowNo_r=0;var agesti;var gendersti;
      var ptypesti;var updatedsex;var fill_id;let riskCal = "";var updateResp_F="";
 
function wd_reload(){
  location.reload();
}
function findRegisterData(){
  console.log("F=> findRegisterData()");
  $("#testHistory").empty();
  $("rprHistory").empty();
  
  

        let  pid = document.getElementById("pid").value;
        //  let  pid_shar = document.getElementById("pid_shar").value;
        let  ckpatient_find=1; // to find ID that have or not in controller;

        
          
          var pid_update = 1;
          var  data={
                      pid:pid,
                      ckpatient_find:ckpatient_find,
                    };
        

            

          if (pid.length> 6){
            $.ajaxSetup({
                   headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
              });

              $.ajax({
                  type:'POST',
                  url:"{{route('stiData')}}",
                  dataType:'json',
                  contentType: 'application/json',
                  data: JSON.stringify(data),
                success:function(response){
                  console.log(response);

                            resp = response; // to define global variable

                             var countResponse = response.length;
                             var r0 =response[0].length;//patients
                             var r1 =response[1].length;//sti_Male
                             var r2 =response[2].length;//sti_female
                             var r3 =response[3].length;//rpr Result
                             var r4 = response[4];//sex
                             
                             var r6 = response[6].length//Rpr result;
                             
                             var date = new Date();
                                      var day = date.getDate().toString();
                                      var month = date.getMonth() + 1;
                                      month="0"+ month.toString();
                                      var year = date.getFullYear().toString();
                                      var today = year + "-" + month + "-" + day;
                                      // console.log(typeOf(month));
                                      console.log(typeof month);
                                      console.log(typeof year);
                                      console.log(typeof day);

                                      document.getElementById('regdate').value = today;


                             if(countResponse>0){
                                  // Follow Up Histroy block
                                  if(r1>0){
                                     for (var i = 0; i < response[1].length; i++) {
                                       var fup_history ="<tr style='background-color:#69D2E7;'>"+
                                                                "<td style='padding-left:20px;' >"+ i +"</td>"+
                                                                "<td>"+response[1][i]['clinic']+"</td>"+
                                                                "<td>"+response[1][i]['male_sex']+"</td>"+
                                                                "<td>"+response[1][i]['age']+"</td>"+
                                                                "<td>"+response[1][i]['male_risk']+"</td>"+
                                                                "<td >"+response[1][i]['Visit_date']+
                                                        "</tr>";
                                         $("#testHistory").append(fup_history);

                                     }
                               }
                                  if(r2>0){
                                    for (var i = 0; i < response[2].length; i++) {
                                      var fup_history ="<tr style='background-color:#69D2E7;'>"+
                                                               "<td style='padding-left:20px;' >"+ i +"</td>"+
                                                               "<td>"+response[2][i]['clinic']+"</td>"+
                                                               "<td>"+response[2][i]['female_sex']+"</td>"+
                                                               "<td>"+response[2][i]['age']+"</td>"+
                                                               "<td>"+response[2][i]['female_risk']+"</td>"+
                                                               "<td >"+response[2][i]['Visit_date']+
                                                       "</tr>";
                                        $("#testHistory").append(fup_history);

                                    }
                               }
                                 //// end of Follow Up History history block
                               //document.getElementById("gender").value=response[0]["gender"];
                               if(r0 > 0){ /////////////////////////////////////////////////////// ====>>>>>>>>>>>>>>> Need to change "r0"
                                 document.getElementById('age').innerHTML=response[0][0]["Agey"];
                                 agesti=response[0][0]["Agey"];
                                 document.getElementById('pid').innerHTML=response[0][0]["CID"];
                                 document.getElementById('fuchia').value=response[0][0]["FuchiaID"];
                                 document.getElementById('gender').innerHTML=response[4];//Gender
                                 console.log(response[4]+"gender form ptconfig");
                                 gendersti=response[4];
                                 
                                 


                                   $("#age").css({"color":"#f469a9","font-weight":"bold"});
                                   $("#pid").css({"color":"#f469a9","font-weight":"bold"});
                                   $("#fuchia").css({"color":"#f469a9","font-weight":"bold"});
                                   $("#gender").css({"color":"#f469a9","font-weight":"bold"});
                                   $("#ptype").css({"color":"#f469a9","font-weight":"bold"});
                                   $("#fe_ptype").css({"color":"#f469a9","font-weight":"bold"});
                                   $("#genderbtn").css({"color":"#f469a9","font-weight":"bold"});

                                 var gender_changer =document.getElementById('gender').innerHTML;
                                
                                 
                                    //  if(gender_changer == "NA"){
                                    //   // firstPage();
                                    //    for (var i = 0; i < 54; i++){
                                    //      document.getElementById(female[i]).style.display = "none";
                                    //    }
                                    //    //document.getElementById('Clotrimazole').style.display = "none";
                                    //    //  document.getElementById('no_treament').style.display = "none";
                                    //    for (var i = 0; i < 27; i++){
                                    //      document.getElementById(male[i]).style.display = "block";
                                    //    }
                                    //    document.getElementById('genderbtn').value="NA";
                                    //  }

                                    //to show and hid button and div  yenaing
                                   
                                    $("#save-male").addClass('show-button');
                                    $("#save-female").addClass('show-button');
                                    $("#update-female").addClass('show-button');
                                    $("#update-male").addClass('show-button');
                                    $('#sti-maleID').removeClass('hide');
                                    $('#sti-femaleID').removeClass('hide');
                                    $('#stiPhy-maleID').removeClass('hide');
                                    $('#stiPhy-femaleID').removeClass('hide');
                                    $('#lastVisit_Check').addClass('hide');
                                    $('#stiLab-maleID').removeClass('hide');
                                    $('#m27').removeClass('hide');
                                    $('#f51').removeClass('hide');
                                    
                                    $('#stiLab-femaleID').removeClass('hide');
                                    $('#sti-commonID').removeClass('hide');
                                    $('#f1').removeClass('hide');
                                    
                                    $('#m26').removeClass('hide');
                                    $('#m27').removeClass('hide');

                                    for(var females=52;females<57;females++){
                                        
                                        $('#'+female[females]).removeClass('hide');
                                       }


                                     if(gender_changer=="Male"){
                                      console.log("hello hide and show");
                                      $("#save-male").removeClass('show-button');
                                      $('#stiLab-femaleID').addClass('hide');
                                      $('#stiPhy-femaleID').addClass('hide');
                                      $('#sti-femaleID').addClass('hide');
                                       $('#f1').addClass('hide');
                                      $('#lastVisit_Check').removeClass('hide');
                                       $('#f51').addClass('hide');
                                       for(var females=51;females<58;females++){
                                        
                                        $('#'+female[females]).addClass('hide');
                                       }
                                       



                                      document.getElementById('ptype').innerHTML=response[5];
                                      ptypesti=response[5];

                                      var cal_last_date = response[1].length;
                                      if(cal_last_date > 0){
                                      var a = cal_last_date - 1;
                                      
                                      if (!response[1][a]["Visit_date"]&&!response[1][a]["male_risk"]) {
                                         
                                          document.getElementById('lastVisit_Date').innerHTML="There is no Last Visit Date and Last Risk";
                                      }else {
                                          if(!response[1][a]["Visit_date"]) {
                                              response[1][a]["Visit_date"] = "NO Last Visit Date"
                                          } 
                                          if(!response[1][a]["male_risk"]){
                                              response[1][a]["male_risk"] = "No Last Rist Data"
                                          }
                                      document.getElementById('lastVisit_Date').innerHTML="Last Visit Date >>__"+response[1][a]["Visit_date"]+"/__*****__/"+"Last Risk >>__"+ response[1][a]["male_risk"];
                                      
                                      }
                                      
                                      }else{
                                      document.getElementById('lastVisit_Date').innerHTML="Last Visit Date >>> Empty";
                                      $("#lastVisit_Date").css({"color":"red","font-weight":"bold"});
                                      }
                                      


                                      //    document.getElementById("male_btn").disabled=false;
                                      //    document.getElementById("female_btn").disabled= true;
                                      //    document.getElementById("maleUpdate_btn").disabled= true;
                                      //    document.getElementById("femaleUpdate_btn").disabled= true;
                                     }else  if(gender_changer =="Female"){
                                      
                                      $("#save-female").removeClass('show-button');
                                      $('#sti-maleID').addClass('hide');
                                      $('#m1').addClass('hide');                                      // firstPage();
                                      $('#lastVisit_Check').removeClass('hide');
                                      $('#stiLab-maleID').addClass('hide');
                                      $('#stiPhy-maleID').addClass('hide');
                                      $('#m27').addClass('hide');
                                      $('#m26').addClass('hide');
                                      $('#m27').addClass('hide');
                                      ptypesti=response[5];


                                  
                                       document.getElementById('fe_ptype').innerHTML=response[5]

                                       var cal_last_date = response[2].length;
                                       console.log(cal_last_date);
                                       if(cal_last_date > 0){
                                         var a = cal_last_date - 1;
                                         if (!response[2][a]["Visit_date"]&&!response[2][a]["female_risk"]) {
                                            document.getElementById('lastVisit_Date').innerHTML="There is no Last Visit Date and Last Risk"
                                         }else {
                                            if(!response[2][a]["Visit_date"]) {
                                            response[2][a]["Visit_date"] = "NO Last Visit Date"
                                        } 
                                        if(!response[2][a]["female_risk"]){
                                            response[2][a]["female_risk"] = "No Last Risk Data"
                                        }
                                            document.getElementById('lastVisit_Date').innerHTML="Last Visit Date >>__"+response[2][a]["Visit_date"]+"/__*****__/"+"Last Risk >>__"+ response[2][a]["female_risk"];
                                          $("#lastVisit_Date").css({"color":"#f469a9","font-weight":"bold"});
                                         }
                                        
                                       }else{
                                         document.getElementById('lastVisit_Date').innerHTML="Last Visit Date >>> Empty";
                                          $("#lastVisit_Date").css({"color":"red","font-weight":"bold"});
                                       }
                                    //    document.getElementById("male_btn").disabled=true;
                                    //    document.getElementById("female_btn").disabled= false;
                                    //    document.getElementById("maleUpdate_btn").disabled= true;
                                    //    document.getElementById("femaleUpdate_btn").disabled= true;
                                     }
                                    

                               }else{
                                 var  nodata = "<p>"+"This ID has no STI Form Data."+"</p>" ;
                                 $('#toshow').empty();
                                 $("#toshow").append(nodata);
                               }
                               // Test History
                            }
                            // RPR section
                            if(r3 > 0){// RPR Test Result
                              
                              for(var i=0;i<r3;i++){
                                var result_body0 ="<tr style='background-color:#69D2E7;'>"+
                                                         "<td id='updateSerial0'>"+(i+1)+"</td>"+"<td>"+response[3][i]['id']+"</td>"+"<td >"+response[3][i]['vdate']+"</td>"+
                                                         "<td >"+response[6][i]+"</td>"+
                                                 "</tr>";
                                $("#rprHistory").append(result_body0);

                              }
                              if(response[6][r6-1]=="Reactive"){
                                $("#latent_syphillis").val("1");
                                $("#latent_syphillis").css({"color":"#e83e8c","font-weight":"500","border":"1px solid #ffc107"});

                              }
                            
                            }
                            // $("#save-male").addClass('show-button');
                            // $("#save-female").addClass('show-button');
                    }
                }); // ajax end

          }else{
                let  toshowtext = "<p>"+"Patient's ID should be more than six digit."+"</p>" ;
                $('#toshow').empty();
                $("#toshow").append(toshowtext);
              }
}
function findRegDataUpdate(){
    console.log("F=> findRegDataUpdate()");
        
        var  pid_shar = document.getElementById("pid_shar").value;
        var  ckPatient=1;
        $("#stiUpdate").empty();
        


        if (pid_shar){
          pid = pid_shar;
          var pid_update = 1;
          var  data={
                      pid:pid,
                      ckPatient:ckPatient
                    };
        }else{
          var  data={
                      pid:pid,
                      ckPatient:ckPatient
                    };
        }

           len = pid.length;

          if (len > 6){
            $.ajaxSetup({
                   headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
              });

              $.ajax({
                  type:'POST',
                  url:"{{route('stiData')}}",
                  dataType:'json',
                  contentType: 'application/json',
                  data: JSON.stringify(data),
                success:function(response){
                  console.log(response);
                            resp = response; // to define global variable

                             var countResponse = response.length;
                             fill_id =response[0];
                             var r1 =response[1].length;//sti_Male
                             var r2 =response[2].length;//sti_female
                             var r3 =response[3].length;//rpr Result
                             var r4 = response[4];// Update

                             if(countResponse>0){
                               //document.getElementById("gender").value=response[0]["gender"];
                                 if(r1 > 0){ // Male
                                     // Male Section
                                     
                                     for(var male_row=0;male_row<r1;male_row++){
                                      var maleIDcount=0;
  
                                       var but_ton0 = "<a  data-toggle='tab' href='#home' onclick='stiupdated()' class='nav-link btn btn-warning'>"+"GO-Updated"+"</a>" ;
                                       var result_body0 ="<tr style='background-color:#69D2E7;' id=updateSerial_male"+male_row+maleIDcount+">"+
                                                                "<td>"+(male_row+1)+"</td>"+"<td>"+response[1][male_row]['id']+"</td>"+"<td >"+response[1][male_row]['Visit_date']+"</td>"+
                                                                "<td id=updateSerial_male"+male_row+(maleIDcount+1)+">"+but_ton0+"</td>"+
                                                        "</tr>";
                                       if(r4 == 333){
                                         $("#stiUpdate").append(result_body0);
                                       }
                                       
                                     }
                                     updatedsex="male";
                                     console.log(updatedsex);
                                   
                                 }
                                 if(r2 > 0){//Female
                                   // Female Section
                                  
                                   for(var female_row=0;female_row<r2;female_row++){
                                      var femaleIDcount=0;
                                       var but_ton0 = "<a  data-toggle='tab' href='#home'onclick='stiupdated()' class='nav-link btn btn-warning'>"+"GO-Updated"+"</a>" ;
                                       var result_body0 ="<tr style='background-color:#69D2E7;'id=updateSerial_female"+female_row+femaleIDcount+">"+
                                                                "<td id='updateSerial0'>"+(female_row+1)+"</td>"+"<td>"+response[2][female_row]['id']+"</td>"+"<td >"+response[2][female_row]['Visit_date']+"</td>"+
                                                                "<td id=updateSerial_female"+female_row+(femaleIDcount+1)+">"+but_ton0+"</td>"+
                                                        "</tr>";
                                       if(r4 == 333){
                                         $("#stiUpdate").append(result_body0);
                                       }
                                     }
                                     updatedsex="female";
                                    console.log(updatedsex+"hello female sex");
                                    

                                 }
                               // Test History
                            }
                    }
                }); // ajax end
          }else{
                let  toshowtext = "<p>"+"Patient's ID should be more than six digit."+"</p>" ;
                $('#toshow').empty();
                $("#toshow").append(toshowtext);
              }
}


function followUp_update(optid){
  var abc = resp[2];
  console.log(abc);
  console.log(followup_Hist_ID);
}

function Update(signal_b){
  console.log(resp[1].length);
  var loonum = resp[1].length;
  for (var i = 0; i <loonum ; i++) {
          //document.getElementById("pid").value=resp[1][i][''];
          document.getElementById("firstVisit").value=resp[1][i][''];
          document.getElementById("lastVisit").value=resp[1][i]['last_vis_within'];
          document.getElementById('aboutclinic').value=resp[1][i]['about_clinic'];
          document.getElementById("age").value=resp[1][i]['age'];
          document.getElementById("regdate").value=resp[1][i]['Visit date'];
          document.getElementById("fuchia").value=resp[1][i][''];
          document.getElementById("gender").value=resp[1][i]['gender'];
          document.getElementById("episode").value=resp[1][i]['episode'];
          document.getElementById("reason").value=resp[1][i]['Reason for Visit'];
          document.getElementById("ptype").value=resp[1][i]['risk_factor'];
          document.getElementById("urethral_discharge").value=resp[1][i]['urethral_disc'];
          document.getElementById("howlong_days").value=resp[1][i]['urethral_disc_hl'];
          document.getElementById("dysuria").value=resp[1][i]['dysuria'];
          document.getElementById("howlong_dysuria").value=resp[1][i]['dysuria_hl'];
          document.getElementById("genital_prutitus").value=resp[1][i]['genital_prut'];
          document.getElementById("howlong_genital_pruti").value=resp[1][i]['genital_prut_hl'];
          document.getElementById("genital_burn").value=resp[1][i]['genital_pain'];
          document.getElementById("howlong_genital_burn").value=resp[1][i]['genital_pain_hl'];
          document.getElementById("genital_ulcer").value=resp[1][i]['genital_ulcer'];
          document.getElementById("howlong_genital_ulcer").value=resp[1][i]['genital_ulcer_hl'];
          document.getElementById("pain").value=resp[1][i]['pain'];
          document.getElementById("ulcer").value=resp[1][i]['ulcer'];
          document.getElementById("prodormal_itch").value=resp[1][i]['prodromal_itch'];
          document.getElementById("start_vesicles").value=resp[1][i]['vesicles'];
          document.getElementById("recurrent").value=resp[1][i]['recurrent'];
          document.getElementById("last_episode").value=resp[1][i]['last_episode'];
          document.getElementById("patient_suspect_herpes").value=resp[1][i]['suspects_herpes'];
          document.getElementById("inguinal_lymph_node").value=resp[1][i]['ing_lymph_node'];
          document.getElementById("hl_inguinal_lymph_node").value=resp[1][i]['ing_lymph_node_hl'];
          document.getElementById("unilateal").value=resp[1][i]['unilateal'];
          document.getElementById("leg_ulcer_inf").value=resp[1][i]['leg_ulcer'];
          document.getElementById("scrotal_swelling").value=resp[1][i]['scrotal_swelling'];
          document.getElementById("hl_scrotal_swelling").value=resp[1][i]['scrotal_swelling_hl'];
          document.getElementById("tender").value=resp[1][i]['td_ntd'];
          document.getElementById("genital_wart").value=resp[1][i]['gen_wart'];
          document.getElementById("hl_genital_wart").value=resp[1][i]['gen_wart_hl'];
          document.getElementById("physical_exam").value=resp[1][i]['physical_exam'];
          document.getElementById("urinated_within1hr").value=resp[1][i]['urinated_wit_1h'];
          document.getElementById("discharge").value=resp[1][i]['discharge'];
          document.getElementById("discharge_after_milking").value=resp[1][i]['discharge_milk'];
          document.getElementById("colour").value=resp[1][i]['colour'];
          document.getElementById("phi_erythema").value=resp[1][i]['erythema'];
          document.getElementById("phi_blister_penis").value=resp[1][i]['blisters'];
          document.getElementById("phi_genital_ulcer").value=resp[1][i]['gen_ulcer'];
          document.getElementById("phi_estimated_size").value=resp[1][i]['esti_size'];
          document.getElementById("phi_single_multiple").value=resp[1][i]['sing_multi'];
          document.getElementById("phi_painfull").value=resp[1][i]['pain_full_less'];
          document.getElementById("phi_herpes_suspected").value=resp[1][i]['herpes_suspect'];
          document.getElementById("phi_inguinal_bubo").value=resp[1][i]['inguinal_bubo'];
          document.getElementById("phi_fluctant").value=resp[1][i]['fluctant'];
          document.getElementById("phi_tender").value=resp[1][i]['tendr_ntender'];
          document.getElementById("phi_leg_inf").value=resp[1][i]['oth_leg_inf'];
          document.getElementById("phi_genital_wart").value=resp[1][i]['phy_genital_wart'];
          document.getElementById("phi_crab_lice").value=resp[1][i]['crab_lice'];
          document.getElementById("phi_scabies").value=resp[1][i]['scabies'];
          document.getElementById("phi_scrotal_swelling").value=resp[1][i]['gscrotal_swelling'];
          document.getElementById("phi_esti_size").value=resp[1][i]['estimated_siz'];
          document.getElementById("phi_unilateal").value=resp[1][i]['unilateal_bilateral'];
          document.getElementById("phi_tender_non").value=resp[1][i]['gtender_ntender'];
          document.getElementById("phi_erythema1").value=resp[1][i]['erythem'];
          document.getElementById("phi_drawing").value=resp[1][i]['dis_size'];
        //  document.getElementById("pt_1st_visit").value=resp[1][i][''];
          document.getElementById("pt_epi_dis_lastvisit").value=resp[1][i]['epi_discharge'];
          document.getElementById("unprotected_sex").value=resp[1][i]['unprot_sex_new_part'];
          document.getElementById("genital_sign").value=resp[1][i]['genital_signs'];
          document.getElementById("presumptive_diag").value=resp[1][i]['presumptive_diag'];
          document.getElementById("primary_syphillis").value=resp[1][i]['pri_syphillis'];
          document.getElementById("gonorrhoea").value=resp[1][i]['Gonorhoea'];
          document.getElementById("congenial_syphillis").value=resp[1][i]['congenial_syphillis'];
          document.getElementById("secondary_syphillis").value=resp[1][i]['sec_syphillis'];
          document.getElementById("non_gono_urethri").value=resp[1][i]['non_gono_urethritis'];
          document.getElementById("latent_syphillis").value=resp[1][i]['latent_syphillis'];
          document.getElementById("chancroid").value=resp[1][i]['chancroid'];
          //document.getElementById("non_gono_procti").value=resp[1][i][''];
          document.getElementById("molluscum_contagiosum").value=resp[1][i]['molluscum_contag'];
          document.getElementById("genital_herpes3").value=resp[1][i][''];
          document.getElementById("trichomonas").value=resp[1][i][''];
          document.getElementById("bubos").value=resp[1][i]['bubos'];
          //document.getElementById("genital_scabies3").value=resp[1][i][''];
          //document.getElementById("genital_candidiosis").value=resp[1][i][''];
          //document.getElementById("genital_warts3").value=resp[1][i][''];
          //document.getElementById("others3").value=resp[1][i][''];
        //  document.getElementById("baterial_vaginosis").value=resp[1][i][''];
          //document.getElementById("others33").value=resp[1][i][''];
          //document.getElementById("tre_azythro").value=resp[1][i]['tre_azythro'];
        //  document.getElementById("tre_cefixim").value=resp[1][i]['tre_cefixim'];
          //document.getElementById("tre_ciprofloxacin").value=resp[1][i]['tre_ciprofloxacin'];
          //document.getElementById("tre_tinidazole").checked=resp[1][i]['tre_tinidazole'];
          //document.getElementById("tre_fluconazole").checked=resp[1][i][''];
        //  document.getElementById("tre_doxycycline").checked=resp[1][i][''];
        //  document.getElementById("tre_ceftriaxone").checked=resp[1][i][''];
        //  document.getElementById("tre_benzpen").checked=resp[1][i][''];
        //  document.getElementById("no_treament1").checked=resp[1][i][''];
          document.getElementById("allergy").value=resp[1][i]['al_Penicillin'];
          document.getElementById("sulfa").value=resp[1][i]['al_sulfa'];
          document.getElementById("parter_treatment_given").value=resp[1][i]['part_treat'];
          document.getElementById("condom").value=resp[1][i]['condom_giv'];
          document.getElementById("remarkTreatment").value=resp[1][i]['	tre_remarks'];
          document.getElementById("follwupText").value=resp[1][i]['followup'];
          document.getElementById("clinicainName").value=resp[1][i]['	clinician_name'];

  }
}
function calSore(){
  console.log("calculate");
  let cal1 = Number(document.getElementById('cal1').value);
  let cal2 = Number(document.getElementById('cal2').value);
  let cal3 = Number(document.getElementById('cal3').value);
  let cal4 = Number(document.getElementById('cal4').value);
  let cal5 = Number(document.getElementById('cal5').value);
  let cal6 = Number(document.getElementById('cal6').value);
  if(cal1==1){
    cal1=2;
  }else{
    cal1=0
  }

  if(cal2==1){
    cal2=2;
  }else {
    cal2=0;
  }
  if(cal3==1){
    cal3=3;
  }else {
    cal3=0;
  }
  if(cal4==1){
    cal4=3;
  }else {
    cal4=0;
  }
  if(cal5==1){
    cal5=1;
  }else {
    cal5=0;
  }
  if(cal6==1){
    cal6=3;
  }else {
    cal6=0;
  }
  
     
    
  
  let scoreAns = cal1+cal2+cal3+cal4+cal5+cal6;
   
  console.log(scoreAns);
  if(scoreAns<3){
    document.getElementById('scoreNum').innerHTML= scoreAns;
    document.getElementById('risktext').innerHTML= "Low Risk";
    riskCal = "Low Risk";

  }
  if(scoreAns > 2){
    document.getElementById('scoreNum').innerHTML= scoreAns;
    document.getElementById('risktext').innerHTML= "High Risk";
    riskCal = "High Risk";

  }

}

//yeniang disabale
function visit(){ 
  var rvisit = document.getElementById("reason").value;
  if(rvisit== "2") {
   
    for (var i = 1; i < 14; i++){
      
    $("#"+female[i]).find('select').prop('disabled', true);
    $("#"+female[i]).find('input').prop('disabled', true);
   }
    for (var i = 1; i <6; i++){
      $("#"+male[i]).find('select').prop('disabled', true);
      $("#"+male[i]).find('input').prop('disabled', true);   }
   
   for(var i =0;i<21;i++) {
    
    $("#"+general[i]).find('select').prop('disabled', true);
      $("#"+general[i]).find('input').prop('disabled', true);
     }
    }else if(rvisit==1||rvisit==9){
      for (var i = 1; i < 14; i++){
      
      $("#"+female[i]).find('select').prop('disabled', false);
    $("#"+female[i]).find('input').prop('disabled', false);
   }
    for (var i = 1; i < 8; i++){
      $("#"+male[i]).find('select').prop('disabled', false);
      $("#"+male[i]).find('input').prop('disabled', false);   }
   
   for(var i =0;i<21;i++) {
      $("#"+general[i]).find('select').prop('disabled', false);
      $("#"+general[i]).find('input').prop('disabled', false);
     }
    }
    
}
function stiPhysical(){
  var phy="";
  // var phy = document.querySelector("physical_exam").value;
   phy = document.getElementById("physical_exam").value;
  console.log (phy);
  if(phy== 2) {
     for(var i= 14;i<31;i++){  
    // $("#menu1").find(female[i]).prop('disabled', true);
    $("#"+female[i]).find('select').prop('disabled', true);
    $("#"+female[i]).find('input').prop('disabled', true);
    
    console.log ("disable female true");
  }
     for(var i =6;i<19;i++) {
      $("#"+male[i]).find('select').prop('disabled', true);
      $("#"+male[i]).find('input').prop('disabled', true);
     } 
     for(var i =21;i<32;i++) {
      $("#"+general[i]).find('select').prop('disabled', true);
      $("#"+general[i]).find('input').prop('disabled', true);
     } 
  

  }else if(phy==1||phy==9) {
    for(var i= 14;i<41;i++){  
    // $("#menu1").find(female[i]).prop('disabled', true);
    $("#"+female[i]).find('select').prop('disabled', false);
    $("#"+female[i]).find('input').prop('disabled', false);
    
    console.log ("disable female true");
  }
     for(var i =6;i<19;i++) {
      $("#"+male[i]).find('select').prop('disabled', false);
      $("#"+male[i]).find('input').prop('disabled', false);
     } 
     for(var i =21;i<32;i++) {
      $("#"+general[i]).find('select').prop('disabled', false);
      $("#"+general[i]).find('input').prop('disabled', false);
     } 
  }

 
}


function sendDataMale(){
      var sti_male=1;
      //first page
      var pid = document.getElementById("pid").value;
      //var clinic = document.getElementById("clinic").innerHTML);
      var clinic = 71;
      var firstVisit = document.getElementById("firstVisit").value;
      var lastVisit = document.getElementById("lastVisit").value;
      var aboutclinic = document.getElementById('aboutclinic').value;
      var age = agesti;//from search data in ptconfig tabel
      console.log("age"+age)
      var regdate = document.getElementById("regdate").value;
      regdate=formatDate(regdate);

      var created_by = $("#navbarDropdown").text();

      var fuchia = document.getElementById("fuchia").value;
      var gender = gendersti //from search data in ptconfig tabel
      console.log(gender+"gender is sex")
      var episode = document.getElementById("episode").value;
      var reason = document.getElementById("reason").value;
      var ptype = ptypesti;//from search data in ptconfig tabel
      var urethral_discharge = document.getElementById("urethral_discharge").value;
      var howlong_days = document.getElementById("howlong_days").value;
      var dysuria = document.getElementById("dysuria").value;
      var howlong_dysuria = document.getElementById("howlong_dysuria").value;
      var genital_prutitus = document.getElementById("genital_prutitus").value;
      var howlong_genital_pruti = document.getElementById("howlong_genital_pruti").value;
      var genital_burn = document.getElementById("genital_burn").value;
      var howlong_genital_burn = document.getElementById("howlong_genital_burn").value;
      var genital_ulcer = document.getElementById("genital_ulcer").value;
      var howlong_genital_ulcer = document.getElementById("howlong_genital_ulcer").value;
      var pain = document.getElementById("pain").value;
      var ulcer = document.getElementById("ulcer").value;
      var prodormal_itch = document.getElementById("prodormal_itch").value;
      var start_vesicles = document.getElementById("start_vesicles").value;
      var recurrent = document.getElementById("recurrent").value;
      var last_episode = document.getElementById("last_episode").value;
      var patient_suspect_herpes = document.getElementById("patient_suspect_herpes").value;
      var inguinal_lymph_node = document.getElementById("inguinal_lymph_node").value;
      var hl_inguinal_lymph_node = document.getElementById("hl_inguinal_lymph_node").value;
      var unilateal = document.getElementById("unilateal").value;
      var leg_ulcer_inf = document.getElementById("leg_ulcer_inf").value;
      var scrotal_swelling = document.getElementById("scrotal_swelling").value;
      var hl_scrotal_swelling = document.getElementById("hl_scrotal_swelling").value;
      var tender = document.getElementById("tender").value;
      var genital_wart = document.getElementById("genital_wart").value;
      var hl_genital_wart = document.getElementById("hl_genital_wart").value;
      //first end
      //second page
      var   physical_exam = document.getElementById("physical_exam").value;
      var   urinated_within1hr = document.getElementById("urinated_within1hr").value;
      var   discharge = document.getElementById("discharge").value;
      var   discharge_after_milking = document.getElementById("discharge_after_milking").value;
      var   colour = document.getElementById("male_colour").value;
      console.log("male"+colour+"hi male colour");

      var   phi_erythema = document.getElementById("phi_erythema").value;
      var   phi_blister_penis = document.getElementById("phi_blister_penis").value;
      var   phi_genital_ulcer = document.getElementById("phi_genital_ulcer").value;
      var   phi_estimated_size = document.getElementById("phi_estimated_size").value;
      var   phi_single_multiple = document.getElementById("phi_single_multiple").value;
      var   phi_painfull = document.getElementById("phi_painfull").value;
      var   phi_herpes_suspected = document.getElementById("phi_herpes_suspected").value;
      var   phi_inguinal_bubo = document.getElementById("phi_inguinal_bubo").value;
      var   phi_fluctant = document.getElementById("phi_fluctant").value;
      var   phi_tender = document.getElementById("phi_tender").value;
      var   phi_leg_inf = document.getElementById("phi_leg_inf").value;
      var   phi_genital_wart = document.getElementById("phi_genital_wart").value;
      var   phi_crab_lice = document.getElementById("phi_crab_lice").value;
      var   phi_scabies = document.getElementById("phi_scabies").value;
      var   phi_scrotal_swelling = document.getElementById("phi_scrotal_swelling").value;
      var   phi_esti_size = document.getElementById("phi_esti_size").value;
      var   phi_unilateal = document.getElementById("phi_unilateal").value;
      var   phi_tender_non = document.getElementById("phi_tender_non").value;
      var   phi_erythema1 = document.getElementById("phi_erythema1").value;
      var   phi_drawing = document.getElementById("phi_drawing").value;
      //female
      //second page end
      //third page
      var   pt_1st_visit = document.getElementById("pt_1st_visit").value;
      var   pt_epi_dis_lastvisit = document.getElementById("pt_epi_dis_lastvisit").value;
      var   unprotected_sex = document.getElementById("unprotected_sex").value;
      var   genital_sign = document.getElementById("genital_sign").value;
      var   presumptive_diag = document.getElementById("presumptive_diag").value;
      var   primary_syphillis = document.getElementById("primary_syphillis").value;
      console.log( primary_syphillis+" primary_syphillis");
      var   gonorrhoea = document.getElementById("gonorrhoea").value;
      console.log(gonorrhoea+"gonorrhoea");
      var   congenial_syphillis = document.getElementById("congenial_syphillis").value;
      console.log(congenial_syphillis+"congenial_syphillis");
      var   secondary_syphillis = document.getElementById("secondary_syphillis").value;
      var   non_gono_urethri = document.getElementById("non_gono_urethri").value;
      var   latent_syphillis = document.getElementById("latent_syphillis").value;
      var   chancroid = document.getElementById("chancroid").value;
      var   non_gono_procti = document.getElementById("non_gono_procti").value;
      var   molluscum_contagiosum = document.getElementById("molluscum_contagiosum").value;
      var   genital_herpes3 = document.getElementById("genital_herpes3").value;
      var   trichomonas = document.getElementById("trichomonas").value;
      var   bubos = document.getElementById("bubos").value;
      var   genital_scabies3 = document.getElementById("genital_scabies3").value;
      var   genital_candidiosis = document.getElementById("genital_candidiosis").value;
      var   genital_warts3 = document.getElementById("genital_warts3").value;
      var   others3 = document.getElementById("others3").value;
      var   baterial_vaginosis = document.getElementById("baterial_vaginosis").value;
      var   others33 = document.getElementById("others33").value;
      var   tre_azythro = document.getElementById("tre_azythro").checked;
      console.log("varible oK")
            if(tre_azythro==true){
              tre_azythro="1";
            }else{tre_azythro="0";}
      var   tre_cefixim = document.getElementById("tre_cefixim").checked;
            if(tre_cefixim==true){
              tre_cefixim="1";
            }else{tre_cefixim="0";}
      var   tre_ciprofloxacin = document.getElementById("tre_ciprofloxacin").checked;
            if(tre_ciprofloxacin==true){
              tre_ciprofloxacin="1";
            }else{tre_ciprofloxacin="0";}
      var   tre_tinidazole = document.getElementById("tre_tinidazole").checked;
            if(tre_tinidazole==true){
              tre_tinidazole="1";
            }else{tre_tinidazole="0";}
      var   tre_fluconazole = document.getElementById("tre_fluconazole").checked;
            if(tre_fluconazole==true){
              tre_fluconazole="1";
            }else{tre_fluconazole="0";}
      var   tre_doxycycline = document.getElementById("tre_doxycycline").checked;
            if(tre_doxycycline==true){
              tre_doxycycline="1";
            }else{tre_doxycycline="0";}
      var   tre_ceftriaxone = document.getElementById("tre_ceftriaxone").checked;
            if(tre_ceftriaxone==true){
              tre_ceftriaxone="1";
            }else{tre_ceftriaxone="0";}
      var   tre_benzpen = document.getElementById("tre_benzpen").checked;
            if(tre_benzpen==true){
              tre_benzpen="1";
            }else{tre_benzpen="0";}
      var   no_treament1 = document.getElementById("no_treament1").checked;
            if(no_treament1==true){
              no_treament1="1";
            }else{no_treament1="0";}
      var   allergy = document.getElementById("allergy").value;
      var   sulfa = document.getElementById("sulfa").value;
      var   parter_treatment_given = document.getElementById("parter_treatment_given").value;
      var   condom=document.getElementById("condom").value;
      var   remarkTreatment = document.getElementById("remarkTreatment").value;
      var   follwupText = document.getElementById("follwupText").value;
      var   clinicainName = document.getElementById("clinicainName").value;
      console.log("varible oK")

      var stiData_male ={
        created_by:created_by,
        updated_by:"-",
        sti_male:sti_male,
         pid:pid,
         clinic:clinic,
         firstVisit:firstVisit,
         lastVisit:lastVisit,
         aboutclinic:aboutclinic,
         age:age,
         regdate:regdate,
         fuchia:fuchia,

         gender:gender,
         episode:episode,
         reason:reason,
         ptype:ptype,
         urethral_discharge:urethral_discharge,
         howlong_days:howlong_days,
         dysuria:dysuria,
         howlong_dysuria:howlong_dysuria,
         genital_prutitus :genital_prutitus,
         howlong_genital_pruti :howlong_genital_pruti,
         genital_burn :genital_burn,
         howlong_genital_burn :howlong_genital_burn,
         genital_ulcer :genital_ulcer,
         howlong_genital_ulcer :howlong_genital_ulcer,
         pain :pain,
         ulcer :ulcer,
         prodormal_itch :prodormal_itch,
         start_vesicles :start_vesicles,
         recurrent :recurrent,
         last_episode :last_episode,
         patient_suspect_herpes :patient_suspect_herpes,
         inguinal_lymph_node :inguinal_lymph_node,
         hl_inguinal_lymph_node :hl_inguinal_lymph_node,
         unilateal :unilateal,
         leg_ulcer_inf :leg_ulcer_inf,
         scrotal_swelling :scrotal_swelling,
         hl_scrotal_swelling :hl_scrotal_swelling,
         tender:tender,
         genital_wart:genital_wart,
         hl_genital_wart:hl_genital_wart,
        //first end
        //second page
         physical_exam :physical_exam,
         urinated_within1hr :urinated_within1hr,
         discharge :discharge,
         discharge_after_milking :discharge_after_milking,
         colour :colour,
         phi_erythema :phi_erythema,
         phi_blister_penis :phi_blister_penis,
         phi_genital_ulcer :phi_genital_ulcer,
         phi_estimated_size :phi_estimated_size,
         phi_single_multiple :phi_single_multiple,
         phi_painfull :phi_painfull,
         phi_herpes_suspected :phi_herpes_suspected,
         phi_inguinal_bubo :phi_inguinal_bubo,
         phi_fluctant :phi_fluctant,
         phi_tender :phi_tender,
         phi_leg_inf :phi_leg_inf,
         phi_genital_wart :phi_genital_wart,
         phi_crab_lice :phi_crab_lice,
         phi_scabies :phi_scabies,
         phi_scrotal_swelling :phi_scrotal_swelling,
         phi_estimated_size :phi_estimated_size,
         phi_unilateal :phi_unilateal,
         phi_tender_non :phi_tender_non,
         phi_erythema1 :phi_erythema1,
         phi_drawing :phi_drawing,
        //second page end
        //third page
         pt_1st_visit :pt_1st_visit,
         pt_epi_dis_lastvisit :pt_epi_dis_lastvisit,
         unprotected_sex :unprotected_sex,
         genital_sign :genital_sign,
         presumptive_diag :presumptive_diag,
         primary_syphillis :primary_syphillis,
         gonorrhoea :gonorrhoea,
         congenial_syphillis :congenial_syphillis,
         secondary_syphillis :secondary_syphillis,
         non_gono_urethri :non_gono_urethri,
         latent_syphillis :latent_syphillis,
         chancroid :chancroid,
         non_gono_procti :non_gono_procti,
         molluscum_contagiosum :molluscum_contagiosum,
         genital_herpes3 :genital_herpes3,
         trichomonas :trichomonas,
         bubos :bubos,
         genital_scabies3 :genital_scabies3,
         genital_candidiosis :genital_candidiosis,
         genital_warts3 :genital_warts3,
         others3 :others3,
         baterial_vaginosis :baterial_vaginosis,
         others33 :others33,
         tre_azythro :tre_azythro,
         tre_cefixim :tre_cefixim,
         tre_ciprofloxacin :tre_ciprofloxacin,
         tre_tinidazole :tre_tinidazole,
         tre_fluconazole :tre_fluconazole,
         tre_doxycycline :tre_doxycycline,
         tre_ceftriaxone :tre_ceftriaxone,
         tre_benzpen :tre_benzpen,
         no_treament1 :no_treament1,
         allergy :allergy,
         sulfa :sulfa,
         parter_treatment_given :parter_treatment_given,
         condom :condom,
         remarkTreatment:remarkTreatment,
         follwupText:follwupText,
         clinicainName:clinicainName,
         phi_esti_size:phi_esti_size,
      };
      console.log(stiData_male)

      $.ajaxSetup({
         headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
         }
       });
      $.ajax({
               type:'POST',
               url:"{{route('stiData')}}",
               dataType:'json',
             //  processData:false,
               contentType: 'application/json',
               data: JSON.stringify(stiData_male),
               
             

         success:function(response){

              alert("We collected the data.");
              console.log(response);
              // location.reload(true);
              }
            });

}
function sendDataFemale(){
      let sti_female=1;
      //first page
      let fe_pid = document.getElementById("pid").value;
      let fe_first_genital_ulcer = document.getElementById("genital_ulcer").value;
      let fuchiaID= document.getElementById("fuchia").value;
      let fe_clinic = 81;
      let fe_firstVisit = document.getElementById("firstVisit").value;
      console.log(fe_firstVisit+"fe_firstVisit")
      let fe_lastVisit = document.getElementById("lastVisit").value;
      let fe_aboutclinic = document.getElementById('aboutclinic').value;
       fe_age = agesti;
      var created_by = $("#navbarDropdown").text();
      console.log(created_by+"created whom");

      console.log(fe_age+"age is fine");
      let fe_regdate = document.getElementById("regdate").value;
      fe_regdate=formatDate(fe_regdate);
      console.log(fe_regdate);
      let fe_fuchia = document.getElementById("fuchia").value;
      let fe_gender = gendersti;
      let fe_episode = document.getElementById("episode").value;
      let fe_reason = document.getElementById("reason").value;
      let fe_ptype = ptypesti;
      //  (female)
      let fe_abVagdischarge = document.getElementById('abVagdischarge').value;
      let fe_hl_ab_va_dis = document.getElementById('hl_ab_va_dis').value;
      let fe_Link_menstra = document.getElementById('Link_menstra').value;
      let fe_Amount = document.getElementById('Amount').value;
      let fe_colour = document.getElementById('colour').value;
      let fe_oth_colour = document.getElementById('other_specify').value;
      let fe_odour = document.getElementById('odour').value;
      let fe_lower_abd_pain = document.getElementById('lower_abd_pain').value;
      let fe_hl_abd_pain = document.getElementById('hl_abd_pain').value;
      let fe_fever = document.getElementById('fever').value;
      let fe_terminate_preg = document.getElementById('terminate_preg').value;
      let fe_dyspareunia = document.getElementById('dyspareunia').value;
      let fe_oth_gi_sym = document.getElementById('oth_gi_sym').value;
      let fe_dysuria = document.getElementById("dysuria").value;
      let fe_howlong_dysuria = document.getElementById("howlong_dysuria").value;
      let fe_genital_prutitus = document.getElementById("genital_prutitus").value;
      let fe_howlong_genital_pruti = document.getElementById("howlong_genital_pruti").value;
      let fe_genital_burn = document.getElementById("genital_burn").value;
      let fe_howlong_genital_burn = document.getElementById("howlong_genital_burn").value;

      let fe_howlong_genital_ulcer = document.getElementById("howlong_genital_ulcer").value;
      let fe_pain = document.getElementById("pain").value;
      let fe_ulcer = document.getElementById("ulcer").value;
      let fe_prodormal_itch = document.getElementById("prodormal_itch").value;
      let fe_start_vesicles = document.getElementById("start_vesicles").value;
      let fe_recurrent = document.getElementById("recurrent").value;
      let fe_last_episode = document.getElementById("last_episode").value;
      let fe_patient_suspect_herpes = document.getElementById("patient_suspect_herpes").value;
      let fe_inguinal_lymph_node = document.getElementById("inguinal_lymph_node").value;
      let fe_hl_inguinal_lymph_node = document.getElementById("hl_inguinal_lymph_node").value;
      let fe_unilateal = document.getElementById("unilateal").value;
      let fe_leg_ulcer_inf = document.getElementById("leg_ulcer_inf").value;
      let fe_genital_wart = document.getElementById("genital_wart").value;
      let fe_hl_genital_wart = document.getElementById("hl_genital_wart").value;
      let fe_other_specify = document.getElementById('other_specify').value;
      let fe_physical_exam = document.getElementById("physical_exam").value;
      let fe_wash_inside = document.getElementById('wash_inside').value;
      let fe_vulvar_erythema = document.getElementById('vulvar_erythema').value;
      let fe_vulvar_odema = document.getElementById('vulvar_odema').value;
      let fe_vag_dis = document.getElementById('vag_dis').value;
      let fe_vag_dis_amount = document.getElementById('vag_dis_amount').value;
      let fe_homogeneous = document.getElementById('homogeneous').value;
      let fe_vag_dis_colour = document.getElementById('vag_dis_colour').value;
      let fe_smell_koh = document.getElementById('smell_koh').value;
      let fe_phi_vag_wall = document.getElementById('phi_vag_wall').value;
      let fe_phi_ad_tender = document.getElementById('phi_ad_tender').value;
      let fe_phi_ad_enlarge = document.getElementById('phi_ad_enlarge').value;

      let fe_genital_blisters = document.getElementById('genital_blisters').value;
      let fe_genital_blisters_location = document.getElementById('genital_blisters_location').value;
      let fe_genital_ulcer =document.getElementById("phi_genital_ulcer").value;
      let fe_genital_ulc_location = document.getElementById('genital_ulc_location').value;
      let fe_tender = document.getElementById("phi_tender").value;

      let   fe_estimated_size = document.getElementById("phi_estimated_size").value;
      let   fe_single_multiple = document.getElementById("phi_single_multiple").value;
      let   fe_painfull = document.getElementById("phi_painfull").value;
      let   fe_herpes_suspected = document.getElementById("phi_herpes_suspected").value;
      let   fe_inguinal_bubo = document.getElementById("phi_inguinal_bubo").value;
      let   fe_fluctant = document.getElementById("phi_fluctant").value;
      let   fe_leg_inf = document.getElementById("phi_leg_inf").value;
      let   fephi_genital_wart = document.getElementById("phi_genital_wart").value;
      let   fe_crab_lice = document.getElementById("phi_crab_lice").value;
      let   fe_scabies = document.getElementById("phi_scabies").value;
      let   fe_koh_smell = document.getElementById('phi_koh_smell').value;
      let   fe_ph_vagina = document.getElementById('phi_ph_vagina').value;
      let   fe_drawing_f = document.getElementById('phi_drawing_f').value;
      let cal1 =document.getElementById('cal1').value;
      let cal2 =document.getElementById('cal2').value;
      let cal3 = document.getElementById('cal3').value;
      let cal4 = document.getElementById('cal4').value;
      let cal5 = document.getElementById('cal5').value;
      let cal6 = document.getElementById('cal6').value;
          scoreAns= document.getElementById('scoreNum').innerHTML;
      
      let   riskRemark = document.getElementById('riskRemark').value;
      let   fe_primary_syphillis = document.getElementById("primary_syphillis").value;
      let   fe_presumptive_diag = document.getElementById("presumptive_diag").value;
      let   fe_gonorrhoea = document.getElementById("gonorrhoea").value;
      let   fe_congenial_syphillis = document.getElementById("congenial_syphillis").value;
            console.log(fe_congenial_syphillis+"congenial_SYP")
      let   fe_secondary_syphillis = document.getElementById("secondary_syphillis").value;
      let   fe_non_gono_urethri = document.getElementById("non_gono_urethri").value;
      let   fe_latent_syphillis = document.getElementById("latent_syphillis").value;
      let   fe_latent_syp_pregancy = document.getElementById('latent_syp_pregancy').value;
      let   fe_chancroid = document.getElementById("chancroid").value;
      let   fe_non_gono_cervities = document.getElementById("non_gono_cervities").value;
      let   fe_molluscum_contagiosum = document.getElementById("molluscum_contagiosum").value;
      let   fe_genital_herpes3 = document.getElementById("genital_herpes3").value;
      let   fe_trichomonas = document.getElementById("trichomonas").value;
      let   fe_bubos = document.getElementById("bubos").value;
      let   fe_genital_scabies3 = document.getElementById("genital_scabies3").value;
      let   fe_genital_candidiosis = document.getElementById("genital_candidiosis").value;
      let   fe_genital_warts3 = document.getElementById("genital_warts3").value;
      let   fe_others3 = document.getElementById("others3").value;
      let   fe_baterial_vaginosis = document.getElementById("baterial_vaginosis").value;
      let   fe_others33 = document.getElementById("others33").value;

      let   fe_tre_azythro = document.getElementById("tre_azythro").checked;
            if(fe_tre_azythro==true){
                fe_tre_azythro="1";
            }else{fe_tre_azythro=0;}
      let   fe_tre_cefixim = document.getElementById("tre_cefixim").checked;
            if(fe_tre_cefixim==true){
              fe_tre_cefixim="1";
            }else{fe_tre_cefixim=0;}
      let   fe_tre_ciprofloxacin = document.getElementById("tre_ciprofloxacin").checked;
            if(fe_tre_ciprofloxacin==true){
              fe_tre_ciprofloxacin="1";
            }else{fe_tre_ciprofloxacin=0;}
      let   fe_tre_tinidazole = document.getElementById("tre_tinidazole").checked;
            if(fe_tre_tinidazole==true){
              fe_tre_tinidazole="1";
            }else{fe_tre_tinidazole=0;}
      let   fe_tre_fluconazole = document.getElementById("tre_fluconazole").checked;
            if(fe_tre_fluconazole==true){
              fe_tre_fluconazole="1";
            }else{fe_tre_fluconazole=0;}
      let   fe_tre_doxycycline = document.getElementById("tre_doxycycline").checked;
            if(fe_tre_doxycycline==true){
              fe_tre_doxycycline="1";
            }else{fe_tre_doxycycline=0;}
      let   fe_tre_ceftriaxone = document.getElementById("tre_ceftriaxone").checked;
            if(fe_tre_ceftriaxone==true){
              fe_tre_ceftriaxone="1";
            }else{fe_tre_ceftriaxone=0;}
      let   fe_tre_benzpen = document.getElementById("tre_benzpen").checked;
            if(fe_tre_benzpen==true){
              fe_tre_benzpen="1";
            }else{fe_tre_benzpen=0;}
      let   fe_clotrimazole = document.getElementById('clotrimazole').checked;
            if(fe_clotrimazole==true){
              fe_clotrimazole="1";
            }else{fe_clotrimazole=0;}
      let   fe_no_treament = document.getElementById("no_treament").checked;
            if(fe_no_treament==true){
              fe_no_treament="1";
            }else{fe_no_treament=0;}
      let   fe_allergy = document.getElementById("allergy").value;
      let   fe_sulfa = document.getElementById("sulfa").value;
      let   fe_parter_treatment_given = document.getElementById("parter_treatment_given").value;
      let   fe_condom = document.getElementById("condom").value;
      let   fe_ab_yellow_discharge = document.getElementById('ab_yellow_discharge').value;
      let   cal7 = document.getElementById('cal7').value;
      let   cal8 = document.getElementById('cal8').value;
      let   cal9 = document.getElementById('cal9').value;
      let   cal10 = document.getElementById('cal10').value;
      let   fe_partner_ulcer = document.getElementById('fe_partner_ulcer').value;
      let   fe_remarkTreatment = document.getElementById("remarkTreatment").value;
      let   fe_follwupText = document.getElementById("follwupText").value;
      let   fe_clinicainName = document.getElementById("clinicainName").value;
      var updated_by = "-";
      

      data_female={

          //first page

          created_by:created_by,
          updated_by:updated_by,
           sti_female:sti_female,
           fe_pid:fe_pid,
           fe_fuchiaID:fuchiaID,
           fe_clinic:fe_clinic,
           fe_firstVisit:fe_firstVisit,
           fe_lastVisit:fe_lastVisit,
           fe_aboutclinic:fe_aboutclinic,
           fe_age:fe_age,
           fe_regdate:fe_regdate,
           fe_fuchia:fe_fuchia,
           fe_gender:fe_gender,
           fe_episode:fe_episode,
           fe_reason:fe_reason,
           fe_ptype:fe_ptype,
          // (female)
           fe_abVagdischarge:fe_abVagdischarge,
           fe_hl_ab_va_dis:fe_hl_ab_va_dis,
           fe_Link_menstra:fe_Link_menstra,
           fe_Amount:fe_Amount,
           fe_colour:fe_colour,
           fe_oth_colour:fe_oth_colour,
           fe_odour:fe_odour,
           fe_lower_abd_pain:fe_lower_abd_pain,
           fe_hl_abd_pain:fe_hl_abd_pain,
           fe_fever:fe_fever,
           fe_terminate_preg:fe_terminate_preg,
           fe_dyspareunia:fe_dyspareunia,
           fe_oth_gi_sym:fe_oth_gi_sym,
           fe_dysuria:fe_dysuria,
           fe_howlong_dysuria:fe_howlong_dysuria,
           fe_genital_prutitus:fe_genital_prutitus,
           fe_howlong_genital_pruti:fe_howlong_genital_pruti,
           fe_genital_burn:fe_genital_burn,
           
           fe_howlong_genital_burn:fe_howlong_genital_burn,
           fe_first_genital_ulcer:fe_first_genital_ulcer,
           fe_howlong_genital_ulcer:fe_howlong_genital_ulcer,
           fe_pain:fe_pain,
           fe_ulcer:fe_ulcer,
           fe_prodormal_itch:fe_prodormal_itch,
           fe_start_vesicles:fe_start_vesicles,
           fe_recurrent:fe_recurrent,
           fe_last_episode:fe_last_episode,
           fe_patient_suspect_herpes:fe_patient_suspect_herpes,
           fe_inguinal_lymph_node:fe_inguinal_lymph_node,
           fe_hl_inguinal_lymph_node:fe_hl_inguinal_lymph_node,
           fe_unilateal:fe_unilateal,
           fe_leg_ulcer_inf:fe_leg_ulcer_inf,
           fe_genital_wart:fe_genital_wart,
           fe_hl_genital_wart:fe_hl_genital_wart,
           fe_other_specify:fe_other_specify,
           fe_physical_exam:fe_physical_exam,
           fe_wash_inside:fe_wash_inside,
           fe_vulvar_erythema:fe_vulvar_erythema,
           fe_vulvar_odema:fe_vulvar_odema,
           fe_vag_dis:fe_vag_dis,
           fe_vag_dis_amount:fe_vag_dis_amount,
           fe_homogeneous:fe_homogeneous,
           fe_vag_dis_colour:fe_vag_dis_colour,
           fe_smell_koh:fe_smell_koh,
           fe_phi_vag_wall:fe_phi_vag_wall,
           fe_phi_ad_tender:fe_phi_ad_tender,
           fe_phi_ad_enlarge:fe_phi_ad_enlarge,

           fe_genital_blisters:fe_genital_blisters,
           fe_genital_blisters_location:fe_genital_blisters_location,
           fe_genital_ulcer:fe_genital_ulcer,
           fe_genital_ulc_location:fe_genital_ulc_location,
           fe_tender:fe_tender,

             fe_estimated_size :fe_estimated_size,
             fe_single_multiple :fe_single_multiple,
             fe_painfull :fe_painfull,
             fe_herpes_suspected:fe_herpes_suspected,
             fe_inguinal_bubo :fe_inguinal_bubo,
             fe_fluctant :fe_fluctant,
             fe_leg_inf :fe_leg_inf,
             fephi_genital_wart :fephi_genital_wart,
             fe_crab_lice :fe_crab_lice,
             fe_scabies :fe_scabies,
             fe_koh_smell :fe_koh_smell,
             fe_ph_vagina :fe_ph_vagina,
             fe_drawing_f :fe_drawing_f,
             cal1 :cal1,
             cal2 :cal2,
             cal3 :cal3,
             cal4 :cal4,
             cal5 :cal5,
             cal6 :cal6,

             scoreAns:scoreAns,
             riskCal:riskCal,
             riskRemark:riskRemark,
             fe_primary_syphillis :fe_primary_syphillis,
             fe_presumptive_diag:fe_presumptive_diag,
             fe_gonorrhoea :fe_gonorrhoea,
             fe_congenial_syphillis :fe_congenial_syphillis,
             fe_secondary_syphillis :fe_secondary_syphillis,
             fe_non_gono_urethri :fe_non_gono_urethri,
             fe_latent_syphillis :fe_latent_syphillis,
             fe_latent_syp_pregancy :fe_latent_syp_pregancy,
             fe_chancroid :fe_chancroid,
             fe_non_gono_cervities:fe_non_gono_cervities,
             fe_molluscum_contagiosum :fe_molluscum_contagiosum,
             fe_genital_herpes3 :fe_genital_herpes3,
             fe_trichomonas :fe_trichomonas,
             fe_bubos :fe_bubos,
             fe_genital_scabies3 :fe_genital_scabies3,
             fe_genital_candidiosis :fe_genital_candidiosis,
             fe_genital_warts3 :fe_genital_warts3,
             fe_others3:fe_others3,
             fe_baterial_vaginosis:fe_baterial_vaginosis,
             fe_others33 :fe_others33,
             fe_tre_azythro :fe_tre_azythro,
             fe_tre_cefixim :fe_tre_cefixim,
             fe_tre_ciprofloxacin :fe_tre_ciprofloxacin,
             fe_tre_tinidazole :fe_tre_tinidazole,
             fe_tre_fluconazole :fe_tre_fluconazole,
             fe_tre_doxycycline :fe_tre_doxycycline,
             fe_tre_ceftriaxone :fe_tre_ceftriaxone,
             fe_tre_benzpen :fe_tre_benzpen,
             fe_clotrimazole :fe_clotrimazole,
             fe_no_treament :fe_no_treament,
             fe_allergy :fe_allergy,
             fe_sulfa :fe_sulfa,
             fe_parter_treatment_given :fe_parter_treatment_given,
             fe_condom :fe_condom,

             fe_ab_yellow_discharge :fe_ab_yellow_discharge,
             cal7 :cal7,
             cal8 :cal8,
             cal9 :cal9,
             cal10 :cal10,
             fe_partner_ulcer :fe_partner_ulcer,
             fe_remarkTreatment:fe_remarkTreatment,
             fe_follwupText :fe_follwupText,
             fe_clinicainName:fe_clinicainName,
          },
          console.log(data_female+"female data")
      //143
     
      $.ajaxSetup({
         headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
         }
       });
      $.ajax({
               type:'POST',
               url:"{{route('stiData')}}",
               dataType:'json',
             //  processData:false,
               contentType: 'application/json',
               data: JSON.stringify(data_female),
         success:function(response){
              // console.log(alert("The patient's data has been saved.Thank you."));
              //
                //if (response) {
                //  $('#success-message').text(response.success);
                //$('#registerForm').reload();// to reset form register
              //  }
            //  console.log(response[0]['name']);
              console.log(response);
              alert("We collected the data.");
              // location.reload(true);
              }
      });


}

function autoinputData(){
  //history_links.innerHTML="";
  //ftitle.innerHTML="";
  // title on Sidebar
   let ar_id= document.getElementById('pid').value;
   let vdate= document.getElementById('ar_visitdate').value;
   let ckLab = 1;
    $.ajaxSetup({
       headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
      });
    $.ajax({
      type:'POST',
      url:"{{route('ncd')}}",
      data:{
            ckLab:ckLab,
            ar_id:ar_id,
            vdate:vdate
          },
        success:function(response){
                 len = response.length;
                console.log(len);
                console.log(response[0]["Uprotein"]);
                console.log(response[0]["Uglucose"]);

              document.getElementById("bprotein").value= response[0]["Uprotein"];
              document.getElementById("bprotein").innerHTML= response[0]["Uprotein"];
              document.getElementById("bglucose").value= response[0]["Uglucose"];
              document.getElementById("bglucose").innerHTML= response[0]["Uglucose"];
              // $test=document.getElementById("bprotein").value;
            //  console.log("the result is "+ $test);
            //   sel = document.getElementById('ar_protein');
              // create new option element
            //   opt = document.createElement("option");
              // create text node to add to option element (opt)
            //  opt.appendChild( document.createTextNode(response[0]["Uprotein"]) );
              // set value property of opt
            //  opt.value = response[0]["Uprotein"];
              // add opt to end of select box (sel)
            //  sel.appendChild(opt);
              }
        });
}
function reason(){
    let rea= document.getElementById('reason').value;
    if(rea == "Asymptomatic")
    {
      console.log("asymptomatic");
      document.getElementById('urethral_discharge').disabled =true ;
      document.getElementById('howlong_days').disabled =true ;
      document.getElementById('dysuria').disabled =true ;
      document.getElementById('howlong_dysuria').disabled =true ;
      document.getElementById('genital_prutitus').disabled =true ;
      document.getElementById('howlong_genital_pruti').disabled =true ;
      document.getElementById('genital_burn').disabled =true ;
      document.getElementById('howlong_genital_burn').disabled =true ;
      document.getElementById('genital_ulcer').disabled =true ;
      document.getElementById('howlong_genital_ulcer').disabled =true ;
      document.getElementById('pain').disabled =true ;
      document.getElementById('ulcer').disabled =true ;
      document.getElementById('prodormal_itch').disabled =true ;
      document.getElementById('start_vesicles').disabled =true ;
      document.getElementById('recurrent').disabled =true ;
      document.getElementById('last_episode').disabled =true ;
      document.getElementById('patient_suspect_herpes').disabled =true ;
      document.getElementById('inguinal_lymph_node').disabled =true ;

    }

    if(rea == "Symptomatic")
    {
      console.log("asymptomatic");
      document.getElementById('urethral_discharge').disabled =false;
      document.getElementById('urethral_discharge').disabled =false;
      document.getElementById('urethral_discharge').disabled =false;
      document.getElementById('urethral_discharge').disabled =false;
      document.getElementById('urethral_discharge').disabled =false;
      document.getElementById('urethral_discharge').disabled =false;
      document.getElementById('urethral_discharge').disabled =false;
      document.getElementById('urethral_discharge').disabled =false;
      document.getElementById('urethral_discharge').disabled =false;
      document.getElementById('urethral_discharge').disabled =false;
      document.getElementById('urethral_discharge').disabled =false;
      document.getElementById('urethral_discharge').disabled =false;
      document.getElementById('urethral_discharge').disabled =false;
      document.getElementById('urethral_discharge').disabled =false;
    }

}
function col(){
  let ckcolour= document.getElementById('colour').value;
  console.log(ckcolour);
  if(ckcolour == "5"){
    document.getElementById('other_specify').disabled= false;
  }else{
    document.getElementById('other_specify').disabled= true;
  }
}
function unregisterReject(){
  document.getElementById('firstVisit').disabled= false;
  document.getElementById('lastVisit').disabled= true;
  document.getElementById('firstVisit').disabled= false;
  document.getElementById('aboutclinic').disabled= false;
  document.getElementById('age').disabled= false;
  document.getElementById('regdate').disabled= false;
  document.getElementById('fuchia').disabled= false;
}
// Male Section
function stiupdated(){
  console.log("Hello Updated function");
  var parent = event.target.parentElement.id;// collecting id of the targeted parent
  var coparent = document.getElementById(parent).parentElement.id;// collecti
  var updated_rowID = document.getElementById(coparent).childNodes[1].innerHTML;

  $(".sti-colist li:nth-child(7) a").removeClass('active');
  $(".sti-colist li:first-child a").addClass('active');
  $("#home select,#menu1 select,#menu2 select").prop("selectedIndex", -1);
  $("#home span,#home input,#menu1 span,#menu1 input,#menu2 span,#menu2 input").text("");

   $("#home select,#menu1 select,#menu2 select").css({"color":"#f469a9","font-weight":"bold"})
   $("#home span,#home input,#menu1 span,#menu1 input,#menu2 span,#menu2 input").css({"color":"#f469a9","font-weight":"bold"});

  
 
  var sti_Updated_fill="sti_fill_data";
  var updated_dataSti={
    fill_id:fill_id,// CID or PID
    updated_rowID:updated_rowID,// DB primary key 
    updatedsex:updatedsex,
    sti_Updated_fill:sti_Updated_fill,
    
  };
  console.log(updated_dataSti);


 
              $.ajaxSetup({
                   headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
              });
            

              $.ajax({
                  type:'POST',
                  url:"{{route('stiData')}}",
                  dataType:'json',
                  contentType: 'application/json',
                  data: JSON.stringify(updated_dataSti),
                success:function(response){
                  // console.log(response);
                  if(updatedsex=="male"){
                    console.log(response);
                    StiFiller_Male(response);
                   


                  }else if(updatedsex=="female"){
                    StiFiller_Female(response);

                  }
                }
                })
  

}


function StiFiller_Male(resp){
  var  general_object = resp[0][0]; // Accessing the first object
  const male_object = resp[1][0];
  updateResp_M=resp[1][0];

  var general_length = Object.keys(general_object).length;
  var male_length= Object.keys(male_object).length;
  
  console.log(general_object);
  console.log(male_object);

  console.log(general_object.Agey);
  console.log(general_object.FuchiaID);
  console.log(general_object['Main Risk']);
  

 console.log(general_length);
 console.log(male_length);

  
  

  // yenaing hide and show
    $('#update-male').addClass('show-button');
    $('#update-female').addClass('show-button');
    $('#save-male').addClass('show-button');
    $('#save-female').addClass('show-button');

    $('#sti-maleID').removeClass('hide');
    $('#sti-femaleID').removeClass('hide');
    $('#stiPhy-maleID').removeClass('hide');
    $('#stiPhy-femaleID').removeClass('hide');
    $('#lastVisit_Check').addClass('hide');
    $('#stiLab-maleID').removeClass('hide');
    $('#m27').removeClass('hide');
    $('#f51').removeClass('hide');
    $('#f54').removeClass('hide');
    $('#stiLab-femaleID').removeClass('hide');
    $('#sti-commonID').removeClass('hide');
    $('#f1').removeClass('hide');

    $('#f54').addClass('hide');
    $('#stiLab-femaleID').addClass('hide');
    $('#stiPhy-femaleID').addClass('hide');
    $('#sti-femaleID').addClass('hide');
    $('#f1').addClass('hide');
    $('#lastVisit_Check').removeClass('hide');
    $('#f51').addClass('hide');
    $('#f52').addClass('hide');
    $('#f54').addClass('hide'); 
    $('#f53').addClass('hide');
  document.getElementById("pid-search").disabled= true;
  $("#lastVisit_Date").addClass('hide');
  
    if(general_length>0 && male_length>0){
   
    
      $('#update-male').removeClass('show-button')
     
       document.getElementById("maleUpdate_btn").disabled= false;
        
        var clinicss =male_object["clinic"];
       
        var sti_male_fill=[
          "pid",'CID',
          'fuchia',"fuchiaID",
          
          
          
          
          "firstVisit","tbl_treat_diagnosis_first_visit",
          "lastVisit","last_vis_within",
          'aboutclinic',"about_clinic",
          
          "regdate","Visit_date",
          // 
          "episode","episode",
          "reason","Reason for Visit",
          
          "urethral_discharge","urethral_disc",
          "howlong_days","urethral_disc_hl",
          "dysuria","dysuria",
          "howlong_dysuria","dysuria_hl",
          "genital_prutitus","genital_prut",
          "howlong_genital_pruti","genital_prut_hl",

          "genital_burn","genital_pain",
          "howlong_genital_burn","genital_pain_hl",

          "genital_ulcer","genital_ulcer",
          "howlong_genital_ulcer","genital_ulcer_hl",

          "pain","pain",
          "ulcer","ulcer",


          "prodormal_itch","prodromal_itch",
          "start_vesicles","vesicles",
          "recurrent","recurrent",
          "last_episode","last_episode",
          "patient_suspect_herpes","suspects_herpes",
          "inguinal_lymph_node","ing_lymph_node",
          "hl_inguinal_lymph_node","ing_lymph_node_hl",
          "unilateal","unilateal",
          "leg_ulcer_inf","leg_ulcer",
          "scrotal_swelling","scrotal_swelling",
          "hl_scrotal_swelling","scrotal_swelling_hl",
          "tender","td_ntd",
          "genital_wart","gen_wart",
          "hl_genital_wart","gen_wart_hl",
          //first end
          //second page
          "physical_exam","physical_exam",
          "urinated_within1hr","urinated_wit_1h",
          "discharge","discharge",
          "discharge_after_milking","discharge_milk",
          "male_colour","colour",
          "phi_erythema","erythema",
          "phi_blister_penis","blisters",
          "phi_genital_ulcer","gen_ulcer",
          "phi_estimated_size","esti_size",
          "phi_single_multiple","sing_multi",
          "phi_painfull","pain_full_less",
          "phi_herpes_suspected","herpes_suspect",
          "phi_inguinal_bubo","inguinal_bubo",
          "phi_fluctant","fluctant",
          "phi_tender","tendr_ntender",
          "phi_leg_inf","oth_leg_inf",
          "phi_genital_wart","phy_genital_wart",
          "phi_crab_lice","crab_lice",
          "phi_scabies","scabies",
          "phi_scrotal_swelling","gscrotal_swelling",
          "phi_esti_size","estimated_siz",
          "phi_unilateal","unilateal_bilateral",
          "phi_tender_non","gtender_ntender",
          "phi_erythema1","erythem",
          "phi_drawing","des_size",
          //female
          //second page end
          //third page
          "pt_1st_visit","tbl_treat_diagnosis_first_visit",
          "pt_epi_dis_lastvisit","epi_discharge",
          "unprotected_sex","unprot_sex_new_part",
          "genital_sign","genital_signs",
          "presumptive_diag","presumptive_diag",
          "primary_syphillis","pri_syphillis",
          "gonorrhoea","Gonorhoea",
          "congenial_syphillis","congenial_syphillis",
          "secondary_syphillis","sec_syphillis",
          "non_gono_urethri","non_gono_urethritis",
          "latent_syphillis","latent_syphillis",
          "chancroid","chancroid",
          "non_gono_procti","non_gono_procti",
          "molluscum_contagiosum","molluscum_contag",
          "genital_herpes3","gen_herpes",
          "trichomonas","trichomonas",
          "bubos","bubos",
          "genital_scabies3","gen_scabies",
          "genital_candidiosis","genital_candidiosis",
          "genital_warts3","othstd_genital_warts",
          "others3","gud_other",
          "baterial_vaginosis","beterial_vaginosis",
          "others33","other(please specify)",
          

          "allergy","al_Penicillin",
          "sulfa","al_sulfa",
          "parter_treatment_given","part_treat",
          "condom","condom_giv",
          "remarkTreatment","tre_remarks",
          "follwupText","followup",
          "clinicainName","clinician_name",
        ];
        var sti_maleFill_span =[
          "ptype","risk_factor",
          "age",'age',
          "gender","gender",
        ]
        var sti_maleCheck_fill=[
          "tre_azythro","tre_azythro",

          "tre_cefixim","tre_cefixim",

          "tre_ciprofloxacin","tre_ciprofloxacin",

          "tre_tinidazole","tre_tinidazole",

          "tre_fluconazole","tre_fluconazole",

          "tre_doxycycline","tre_doxycycline",

          "tre_ceftriaxone","tre_ceftriaxone",

          "tre_benzpen","tre_benz_pen",

          "no_treament1","no_treat",
          "trichomonas","trichomonas",
         

        ]
        for(var i=0;i<sti_maleFill_span.length;i++) {
          document.getElementById(sti_maleFill_span[i]).innerHTML =male_object[sti_maleFill_span[(i+1)]];
         
          i=i+1;
        }
        for(var i=0;i<sti_male_fill.length;i++) {
          document.getElementById(sti_male_fill[i]).value =male_object[sti_male_fill[(i+1)]];
          i=i+1;
        }
        for(var i=0;i<sti_maleCheck_fill.length;i++){
           i=i+1;
          if(male_object[sti_maleCheck_fill[i]]=="1"){
           
           $("#"+sti_maleCheck_fill[i-1]).prop("checked",true);
           
          }

        }
        
        visit();
        stiPhysical();
        DateTo_text();
   }else{
      var  nodata = "<p>"+"This ID has no STI Form Data."+"</p>" ;
      $('#toshow').empty();
      $("#toshow").append(nodata);
    }

}

function Sti_Male_Updater(updateResp_M){
  console.log(updateResp_M);
   var updateID = updateResp_M["id"];
  console.log(updateID);
  
  var clinic="71";
  var updated_by=$("#navbarDropdown").text();
  var male_updatedData= [
      //first page
    "pid","pid",
    //"clinic","clinic").innerHTML);
    
    "firstVisit","firstVisit",
    "lastVisit","lastVisit",
    "aboutclinic","aboutclinic",
    
    

    "fuchia","fuchia",
    
    "episode","episode",
    "reason","reason",
    
    "urethral_discharge","urethral_discharge",
    "howlong_days","howlong_days",
    "dysuria","dysuria",
    "howlong_dysuria","howlong_dysuria",
    "genital_prutitus","genital_prutitus",
    "howlong_genital_pruti","howlong_genital_pruti",
    "genital_burn","genital_burn",
    "howlong_genital_burn","howlong_genital_burn",
    "genital_ulcer","genital_ulcer",
    "howlong_genital_ulcer","howlong_genital_ulcer",
    "pain","pain",
    "ulcer","ulcer",
    "prodormal_itch","prodormal_itch",
    "start_vesicles","start_vesicles",
    "recurrent","recurrent",
    "last_episode","last_episode",
    "patient_suspect_herpes","patient_suspect_herpes",
    "inguinal_lymph_node","inguinal_lymph_node",
    "hl_inguinal_lymph_node","hl_inguinal_lymph_node",
    "unilateal","unilateal",
    "leg_ulcer_inf","leg_ulcer_inf",
    "scrotal_swelling","scrotal_swelling",
    "hl_scrotal_swelling","hl_scrotal_swelling",
    "tender","tender",
    "genital_wart","genital_wart",
    "hl_genital_wart","hl_genital_wart",
    //first end
    //second page
    "physical_exam","physical_exam",
    "urinated_within1hr","urinated_within1hr",
    "discharge","discharge",
    "discharge_after_milking","discharge_after_milking",
    "colour","male_colour",
    "phi_erythema","phi_erythema",
    "phi_blister_penis","phi_blister_penis",
    "phi_genital_ulcer","phi_genital_ulcer",
    "phi_estimated_size","phi_estimated_size",
    "phi_single_multiple","phi_single_multiple",
    "phi_painfull","phi_painfull",
    "phi_herpes_suspected","phi_herpes_suspected",
    "phi_inguinal_bubo","phi_inguinal_bubo",
    "phi_fluctant","phi_fluctant",
    "phi_tender","phi_tender",
    "phi_leg_inf","phi_leg_inf",
    "phi_genital_wart","phi_genital_wart",
    "phi_crab_lice","phi_crab_lice",
    "phi_scabies","phi_scabies",
    "phi_scrotal_swelling","phi_scrotal_swelling",
    "phi_esti_size","phi_esti_size",
    "phi_unilateal","phi_unilateal",
    "phi_tender_non","phi_tender_non",
    "phi_erythema1","phi_erythema1",
    "phi_drawing","phi_drawing",
    //female
    //second page end
    //third page
    "pt_1st_visit","pt_1st_visit",
    "pt_epi_dis_lastvisit","pt_epi_dis_lastvisit",
    "unprotected_sex","unprotected_sex",
    "genital_sign","genital_sign",
    "presumptive_diag","presumptive_diag",
    "primary_syphillis","primary_syphillis",
    "gonorrhoea","gonorrhoea",
    "congenial_syphillis","congenial_syphillis",
    "secondary_syphillis","secondary_syphillis",
    "non_gono_urethri","non_gono_urethri",
    "latent_syphillis","latent_syphillis",
    "chancroid","chancroid",
    "non_gono_procti","non_gono_procti",
    "molluscum_contagiosum","molluscum_contagiosum",
    "genital_herpes3","genital_herpes3",
    "trichomonas","trichomonas",
    "bubos","bubos",
    "genital_scabies3","genital_scabies3",
    "genital_candidiosis","genital_candidiosis",
    "genital_warts3","genital_warts3",
    "others3","others3",
    "baterial_vaginosis","baterial_vaginosis",
    "others33","others33",
    "allergy","allergy",
    "sulfa","sulfa",
    "parter_treatment_given","parter_treatment_given",
    "condom","condom",
    "remarkTreatment","remarkTreatment",
    "follwupText","follwupText",
    "clinicainName","clinicainName",
    
    
  ];// to get data form view 

  var male_sapnUpdated_data= [
    "age","age",
    "gender","gender",
    "ptype","ptype",

  ]//to get data from span tag(age,gender,risk)

  var treatement_dos=[
    "tre_azythro","tre_azythro",
    "tre_cefixim","tre_cefixim",
    "tre_ciprofloxacin","tre_ciprofloxacin",
    "tre_tinidazole","tre_tinidazole",
    "tre_fluconazole","tre_fluconazole",
    "tre_doxycycline","tre_doxycycline",
    "tre_ceftriaxone","tre_ceftriaxone",
    "tre_benzpen","tre_benzpen",
    "no_treament1","no_treament1",
     
  ];//check box data

  var collected_data=[];
  var j=0;
  for(var i=0;i<male_updatedData.length;i++) {
    collected_data[j]=male_updatedData[i];
    collected_data[j+1]=$("#"+male_updatedData[i+1]).val();
    i=i+1;
    j=j+2;
  }
  for(var i=0;i<male_sapnUpdated_data.length;i++) {
    collected_data[j]=male_sapnUpdated_data[i];
    collected_data[j+1]=$("#"+male_sapnUpdated_data[i+1]).text();
    i=i+1;
    j=j+2;
  }
  for(var i=0;i<treatement_dos.length;i++){
    collected_data[j]=treatement_dos[i];
    if(document.getElementById(treatement_dos[i+1]).checked==true){
      console.log(treatement_dos[i]+document.getElementById(treatement_dos[i+1]).checked+"check");
      collected_data[j+1]="1";
    }else{
      collected_data[j+1]="0";
    }
    i=i+1;
    j=j+2;

  }

  collected_data[j]="regdate";
  console.log($("#regdate").val()+"date is no call")
  collected_data[j+1]=formatDate($("#regdate").val());

  console.log("hello is cdata");
  var k=0;
  var fill_toJson={"updateID":updateID,'sti_male':2,'clinic':'71','updated_by':updated_by}
  ;
  for(var i=0;i<collected_data.length;i++){
    
    
    fill_toJson[collected_data[k]]=collected_data[k+1];
    k=k+2;
    
  }
  // male_toUpdated.push(fill_toJson);
  console.log(fill_toJson);
 
  $.ajaxSetup({
         headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
         }
       });
      $.ajax({
               type:'POST',
               url:"{{route('stiData')}}",
               dataType:'json',
             //  processData:false,
               contentType: 'application/json',
               data: JSON.stringify(fill_toJson),
               
             

         success:function(response){

              alert("We collected the data Updated.");
              console.log(response);
              // location.reload(true);
              }
            });
}

function StiFiller_Female(resp){
  var  general_object = resp[0][0];
  const female_object = resp[2][0];
    
  updateResp_F=resp[2][0];
  console.log(updateResp_F);
  console.log(female_object);
  console.log(general_object["Agey"]+"age is fine");
  console.log(general_object["Gender"]+"gender is fine");
  
  // document.getElementById("male_btn").disabled= true;
  // document.getElementById("female_btn").disabled= true;
  // document.getElementById("maleUpdate_btn").disabled= true;

  // hide and show button yenaing

  $('#sti-maleID').removeClass('hide');
  $('#sti-femaleID').removeClass('hide');
  $('#stiPhy-maleID').removeClass('hide');
  $('#stiPhy-femaleID').removeClass('hide');
  $('#lastVisit_Check').addClass('hide');
  $('#stiLab-maleID').removeClass('hide');
  $('#m27').removeClass('hide');
  $('#f51').removeClass('hide');
  $('#f54').removeClass('hide');
  $('#stiLab-femaleID').removeClass('hide');
  $('#sti-commonID').removeClass('hide');
  $('#f1').removeClass('hide');
                                

  $('#update-male').addClass('show-button');
  $('#save-male').addClass('show-button');
  $('#save-female').addClass('show-button');
  $('#update-female').removeClass('show-button');
  
  
  $('#sti-maleID').addClass('hide');
  $('#m1').addClass('hide');                                      // firstPage();
  $('#lastVisit_Check').removeClass('hide');
  $('#stiLab-maleID').addClass('hide');
  $('#stiPhy-maleID').addClass('hide');
  $('#m26').addClass('hide');
  $('#m27').addClass('hide');

  document.getElementById("pid-search").disabled= true;
  

                                        //  if(gender_changer == "NA"){
                                        //    for (var i = 0; i < 54; i++){
                                        //      document.getElementById(female[i]).style.display = "none";
                                        //    }
                                        //    //document.getElementById('Clotrimazole').style.display = "none";
                                        //    //  document.getElementById('no_treament').style.display = "none";
                                        //    for (var i = 0; i < 27; i++){
                                        //      document.getElementById(male[i]).style.display = "block";
                                        //    }
                                        // //    document.getElementById('genderbtn').value="NA";
                                        //  }
                                        //  if(gender_changer=="male"){
                                        //    for (var i = 0; i < 54; i++) {
                                        //      document.getElementById(female[i]).style.display = "none";
                                        //    }
                                        //  //  document.getElementById('Clotrimazole').style.display = "none";
                                        //  //  document.getElementById('no_treament').style.display = "none";
                                        //    for (var i = 0; i < 27; i++) {
                                        //      document.getElementById(male[i]).style.display = "block";
                                        //    }
                                        // //    document.getElementById('gender').value="male";

                                        //    document.getElementById("male_btn").disabled=true;
                                        //    document.getElementById("female_btn").disabled= true;
                                        //    document.getElementById("maleUpdate_btn").disabled= false;
                                        //    document.getElementById("femaleUpdate_btn").disabled= true;
                                        //  }
                                        //  if(gender_changer=="female"){
                                        //    for (var i = 0; i < 54; i++) {
                                        //      document.getElementById(female[i]).style.display = "block";
                                        //    }
                                        //  //  document.getElementById('Clotrimazole').style.display = "block";
                                        //  //  document.getElementById('no_treament').style.display = "block";
                                        //    for (var i = 0; i < 27; i++) {
                                        //      document.getElementById(male[i]).style.display = "none";
                                        //    }
                                        //    document.getElementById('genderbtn').value="female";

                                        //    document.getElementById("male_btn").disabled=true;
                                        //    document.getElementById("female_btn").disabled= true;
                                        //    document.getElementById("maleUpdate_btn").disabled= true;
                                        //    document.getElementById("femaleUpdate_btn").disabled= false;
                                        //  }
                                        
  
  var sit_femaleFill=[ 
    "pid","CID",
    "fuchia","fuchiaID",

    "phi_single_multiple","gent_ulcer_sm",
    "cal1","prev_STI",
    "cal2","new_pat_past_3mont",
    "cal3","patient_genital_ulcer",
    "cal4","part_compl_gential_sym",
    "cal5","patient_compl_low_abd",
    "cal6","sworker",
      
      
    "firstVisit","first_visit",
    "lastVisit","last_vis_within",
    'aboutclinic',"about_clinic",
    
    "regdate","Visit_date",
    "genital_blisters_location","genital_blisters_Location",

    "phi_painfull","gential_ulcer_pain",

    "genital_ulcer","gen_ulcer",

    
    "episode","episode",
    "reason","rea_for_visit",
    
    //  (female)
    'abVagdischarge',"abn_vaginal_disc",
    'hl_ab_va_dis',"abn_vaginal_disc_long",
    'Link_menstra',"linked_menstru",
    'Amount',"amount",
    'colour',"colour",
    'other_specify',"colour_oth",// Need to check again
    'odour',"abn_veginal_odour",
    'lower_abd_pain',"l_abn_pain",
    'hl_abd_pain',"l_abon_pain_hl",
    'fever',"fever",
    'terminate_preg',"rec_terminate_preg",
    'dyspareunia',"dyspareunia",
    'oth_gi_sym',"oth_GI_sympt",
    "dysuria","dysuria",
    "howlong_dysuria","dysuria_hl",
    "genital_prutitus","gen_prutitus",
    "howlong_genital_pruti","gen_prutitus_hl",
    "genital_burn","gen_burn_pain",
    "howlong_genital_burn","gen_burn_pain_hl",

    "howlong_genital_ulcer","gen_ulcer_hl",
    "pain","pain",
    "ulcer","ulcer",
    "prodormal_itch","prodromal_itch",
    "start_vesicles","vesicles",
    "recurrent","recurrent",
    "last_episode","recurrent_last_episode",
    "patient_suspect_herpes","patient_suspects_herpes",
    "inguinal_lymph_node","inguinal_ln",
    "hl_inguinal_lymph_node","inguinal_ln_hl",
    "unilateal","unilateal_Bilateral",
    "leg_ulcer_inf","leg_ulcer_oth_inf",
    "genital_wart","genital_warts",
    "hl_genital_wart","genital_warts_hl",
    "phi_tender","fluctuant_tender",
    //  'other_specify',"",
    "physical_exam","phy_exam_done",
    'wash_inside',"washed_inside",
    'vulvar_erythema',"vulvar_erythema",
    'vulvar_odema',"vulvar_odema",
    'vag_dis',"vaginal_discharge",
    'vag_dis_amount',"vag_dis_amount",
    'homogeneous',"homogeneous",
    'vag_dis_colour',"homogeneous_col",// need to check agin
    'smell_koh',"smell_without_KOH",
    'phi_vag_wall',"vaginal_wall_injury",
    'phi_ad_tender',"adnexal_tenderness",
    'phi_ad_enlarge',"adnexal_enlargement",
    "primary_syphillis","pri_syphillis",
    "presumptive_diag","presumptive_diag",
    "gonorrhoea","Gonorhoea",
    
    "secondary_syphillis","sec_syphillis",
    "non_gono_urethri","non_gono_urethritis",
    "latent_syphillis","latent_syphillis",
    'latent_syp_pregancy',"latent_syphillis_preg",
    "chancroid","chancroid",
    "non_gono_cervities","non_gono_cervities",
    "molluscum_contagiosum","molluscum_contag",
    "genital_herpes3","gen_herpes",
    "trichomonas","trichomonas",
    "bubos","bubos",
    "genital_scabies3","gen_scabies",
    "genital_candidiosis","genital_candidiosis",
    "genital_warts3","othstd_genital_warts",
    "others3","ostd_other",// need to check again
    "baterial_vaginosis","beterial_vaginosis",
    "genital_ulc_location","gential_ulcerl",
    "riskRemark","risk_cal_remark",

    'genital_blisters',"genital_blisters",
    "phi_genital_ulcer","gential_ulcer",
    "phi_herpes_suspected","susp_herpes",
    "phi_inguinal_bubo","inguinal_bubo",
    "phi_fluctant","fluctuant",
    "phi_leg_inf","oth_leg_infection",
    "phi_genital_wart","genital_wart",
    "phi_crab_lice","crab_lice",
    "phi_scabies","scablices",
    'phi_koh_smell',"KOH_smell_test",
    'phi_ph_vagina',"pH_vagina",
    'phi_drawing_f',"des_size",
    "allergy","al_Penicillin",
    "sulfa","al_sulfa",
    "parter_treatment_given","part_treat",
    "condom","condom_giv",
    "remarkTreatment","tre_remarks",
    "follwupText","followup",
    "clinicainName","clinician",
    "ab_yellow_discharge","abn_yellow_disc",
    "cal7","pain_dur_sexual",
    "cal8","dysuria",
    "cal9","unp_sex_new_clients",
    "cal10","low_abd_pain",
    "fe_partner_ulcer","partner_ulcer",
    "congenial_syphillis","congenial_syphillis",
    "others33","other_STD",


    
    
  ];
  var sti_femaleCheck_fill=[
    "tre_azythro","tre_azythro",

    "tre_cefixim","tre_cefixim",

    "tre_ciprofloxacin","tre_ciprofloxacin",

    "tre_tinidazole","tre_tinidazole",

    "tre_doxycycline","tre_doxycycline",

    "tre_ceftriaxone","tre_ceftriaxone",

    "tre_benzpen","tre_benz_pen",

    'clotrimazole',"clotrimazole_vaginal_tab",

    "no_treament","tre_Other",
    "tre_fluconazole","tre_fluconazole",
  ];
  var sti_female_span =[
    'scoreNum','rg_score',
    'risktext','risk',
    'riskRemark','risk_cal_remark',
    'age','age',
    'fe_ptype','risk_factor',
    'gender','gender'
  ];

  for(var i=0;i<sti_female_span.length;i++) {
          document.getElementById(sti_female_span[i]).innerHTML =female_object[sti_female_span[(i+1)]];
         
          i=i+1;
  }
  for(var i=0;i<sit_femaleFill.length;i++) {
          document.getElementById(sit_femaleFill[i]).value =female_object[sit_femaleFill[(i+1)]];
          i=i+1;
  }
  for(var i=0;i<sti_femaleCheck_fill.length;i++){
    i=i+1;
    if(female_object[sti_femaleCheck_fill[i]]=="1"){
           
     $("#"+sti_femaleCheck_fill[i-1]).prop("checked",true);
           
    }

  }

  DateTo_text();
  

 
  //document.getElementById('genital_location').value= female_object["gentital_blisters_location"];
 
  //  document.getElementById('genital_ulc_location').value= female_object[""];
  //  document.getElementById("tender").value= female_object[""];

  //  document.getElementById("phi_estimated_size").value= female_object[""];
  //  document.getElementById("phi_single_multiple").value= female_object[""];
  //  document.getElementById("phi_painfull").value= female_object[""];

  



  
  //document.getElementById("others33").value= female_object[""];// need to check again

  

  
  //  document.getElementById('ab_yellow_discharge').value= female_object[""];
  //  document.getElementById('cal7').value= female_object[""];
  //  document.getElementById('cal8').value= female_object[""];
  //  document.getElementById('cal9').value= female_object[""];
  //  document.getElementById('cal10').value= female_object[""];
  //  document.getElementById('fe_partner_ulcer').value= female_object[""];
 

    

                                   

}
function Sti_Female_Updater(updateResp_F){
  console.log(resp);
  console.log(rowNo);
  var updateID = updateResp_F["id"];

  var sti_female=2;
  var clinic="71";
  var updated_by=$("#navbarDropdown").text();

  var female_updatedData=[
    'fe_first_genital_ulcer',"genital_ulcer",
      'fe_firstVisit',"firstVisit",
      
      'fe_lastVisit',"lastVisit",
      'fe_aboutclinic','aboutclinic',
      'fe_fuchia',"fuchia",
     
      'fe_episode',"episode",
      'fe_reason',"reason",
     
      //  (female)
      'fe_abVagdischarge','abVagdischarge',
      'fe_hl_ab_va_dis','hl_ab_va_dis',
      'fe_Link_menstra','Link_menstra',
      'fe_Amount','Amount',
      'fe_colour','colour',
      'fe_oth_colour','other_specify',
      'fe_odour','odour',
      'fe_lower_abd_pain','lower_abd_pain',
      'fe_hl_abd_pain','hl_abd_pain',
      'fe_fever','fever',
      'fe_terminate_preg','terminate_preg',
      'fe_dyspareunia','dyspareunia',
      'fe_oth_gi_sym','oth_gi_sym',
      'fe_dysuria',"dysuria",
      'fe_howlong_dysuria',"howlong_dysuria",
      'fe_genital_prutitus',"genital_prutitus",
      'fe_howlong_genital_pruti',"howlong_genital_pruti",
      'fe_genital_burn',"genital_burn",
      'fe_howlong_genital_burn',"howlong_genital_burn",

      'fe_howlong_genital_ulcer',"howlong_genital_ulcer",
      'fe_pain',"pain",
      'fe_ulcer',"ulcer",
      'fe_prodormal_itch',"prodormal_itch",
      'fe_start_vesicles',"start_vesicles",
      'fe_recurrent',"recurrent",
      'fe_last_episode',"last_episode",
      'fe_patient_suspect_herpes',"patient_suspect_herpes",
      'fe_inguinal_lymph_node',"inguinal_lymph_node",
      'fe_hl_inguinal_lymph_node',"hl_inguinal_lymph_node",
      'fe_unilateal',"unilateal",
      'fe_leg_ulcer_inf',"leg_ulcer_inf",
      'fe_genital_wart',"genital_wart",
      'fe_hl_genital_wart',"hl_genital_wart",
      'fe_other_specify','other_specify',
      'fe_physical_exam',"physical_exam",
      'fe_wash_inside','wash_inside',
      'fe_vulvar_erythema','vulvar_erythema',
      'fe_vulvar_odema','vulvar_odema',
      'fe_vag_dis','vag_dis',
      'fe_vag_dis_amount','vag_dis_amount',
      'fe_homogeneous','homogeneous',
      'fe_vag_dis_colour','vag_dis_colour',
      'fe_smell_koh','smell_koh',
      'fe_phi_vag_wall','phi_vag_wall',
      'fe_phi_ad_tender','phi_ad_tender',
      'fe_phi_ad_enlarge','phi_ad_enlarge',

      'fe_genital_blisters','genital_blisters',
      'fe_genital_blisters_location','genital_blisters_location',
      'fe_genital_ulcer',"phi_genital_ulcer",
      'fe_genital_ulc_location','genital_ulc_location',
      'fe_tender',"phi_tender",

      'fe_estimated_size',"phi_estimated_size",
      'fe_single_multiple',"phi_single_multiple",
      'fe_painfull',"phi_painfull",
      'fe_herpes_suspected',"phi_herpes_suspected",
      'fe_inguinal_bubo',"phi_inguinal_bubo",
      'fe_fluctant',"phi_fluctant",
      'fe_leg_inf',"phi_leg_inf",
      'fephi_genital_wart',"phi_genital_wart",
      'fe_crab_lice',"phi_crab_lice",
      'fe_scabies',"phi_scabies",
      'fe_koh_smell','phi_koh_smell',
      'fe_ph_vagina','phi_ph_vagina',
      'fe_drawing_f','phi_drawing_f',

      'riskRemark','riskRemark',
      'fe_primary_syphillis',"primary_syphillis",
      'fe_presumptive_diag',"presumptive_diag",
      'fe_gonorrhoea',"gonorrhoea",
      'fe_congenial_syphillis',"congenial_syphillis",
          
      'fe_secondary_syphillis',"secondary_syphillis",
      'fe_non_gono_urethri',"non_gono_urethri",
      'fe_latent_syphillis',"latent_syphillis",
      'fe_latent_syp_pregancy','latent_syp_pregancy',
      'fe_chancroid',"chancroid",
      'fe_non_gono_cervities',"non_gono_cervities",
      'fe_molluscum_contagiosum',"molluscum_contagiosum",
      'fe_genital_herpes3',"genital_herpes3",
      'fe_trichomonas',"trichomonas",
      'fe_bubos',"bubos",
      'fe_genital_scabies3',"genital_scabies3",
      'fe_genital_candidiosis',"genital_candidiosis",
      'fe_genital_warts3',"genital_warts3",
      'fe_others3',"others3",
      'fe_baterial_vaginosis',"baterial_vaginosis",
      'fe_others33',"others33",

      'fe_allergy',"allergy",
      'fe_sulfa',"sulfa",
      'fe_parter_treatment_given',"parter_treatment_given",
      'fe_condom',"condom",
      'fe_ab_yellow_discharge','ab_yellow_discharge',
      'cal7','cal7',
      'cal8','cal8',
      'cal9','cal9',
      'cal10','cal10',
      'fe_partner_ulcer','fe_partner_ulcer',
      'fe_remarkTreatment',"remarkTreatment",
      'fe_follwupText',"follwupText",
      'fe_clinicainName',"clinicainName",


      'cal1','cal1',
      'cal2','cal2',
      'cal3','cal3',
      'cal4','cal4',
      'cal5','cal5',
      'cal6','cal6',

  ]
  var treatement_dos=[
    "fe_tre_azythro","tre_azythro",
    "fe_tre_cefixim","tre_cefixim",
    "fe_tre_ciprofloxacin","tre_ciprofloxacin",
    "fe_tre_tinidazole","tre_tinidazole",
    "fe_tre_fluconazole","tre_fluconazole",
    "fe_tre_doxycycline","tre_doxycycline",
    "fe_tre_ceftriaxone","tre_ceftriaxone",
    "fe_tre_benzpen","tre_benzpen",
    "fe_clotrimazole","clotrimazole",
    "fe_no_treament","no_treament"

  ]

  var female_sapnUpdated_data=[
    "scoreAns","scoreNum",
    "risk","risktext",
    "updated_by","navbarDropdown"
  ]

  var collected_data=[];
  var j=0;
  for(var i=0;i<female_updatedData.length;i++) {
    collected_data[j]=female_updatedData[i];
    collected_data[j+1]=$("#"+female_updatedData[i+1]).val();
    i=i+1;
    j=j+2;
  }
  for(var i=0;i<female_sapnUpdated_data.length;i++) {
    collected_data[j]=female_sapnUpdated_data[i];
    collected_data[j+1]=$("#"+female_sapnUpdated_data[i+1]).text();
    i=i+1;
    j=j+2;
  }
  for(var i=0;i<treatement_dos.length;i++){
    collected_data[j]=treatement_dos[i];
    if(document.getElementById(treatement_dos[i+1]).checked==true){
      console.log(treatement_dos[i]+document.getElementById(treatement_dos[i+1]).checked+"check");
      collected_data[j+1]="1";
    }else{
      collected_data[j+1]="0";
    }
    i=i+1;
    j=j+2;

  }

  collected_data[j]="regdate";
  console.log($("#regdate").val()+"date is no call")
  collected_data[j+1]=formatDate($("#regdate").val());

  console.log("hello is cdata");
  console.log(updated_by);
  var k=0;
  var fill_toJson_female={"updateID":updateID,'sti_female':2,'clinic':71,};
  
  for(var i=0;i<collected_data.length;i++){
    
    
    fill_toJson_female[collected_data[k]]=collected_data[k+1];
    k=k+2;
    
  }
  console.log(fill_toJson_female);
 
  $.ajaxSetup({
         headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
         }
       });
      $.ajax({
               type:'POST',
               url:"{{route('stiData')}}",
               dataType:'json',
             //  processData:false,
               contentType: 'application/json',
               data: JSON.stringify(fill_toJson_female),
               
             

         success:function(response){

              alert("We collected the data Updated.");
              console.log(response);
              // location.reload(true);
              }
            });

  
      

     
      

  
  
}

function RprFiller(resp,rowNo_r){
  console.log("You arrived RprFiller");
   var RPR_result = resp[3][rowNo_r]["RPR Qualitative"];
   console.log(RPR_result);

   if(RPR_result == "R"){
     console.log("RRR");
     document.getElementById('latent_syphillis').style.color='red';
     document.getElementById('latent_syphillis').value=1;
     //document.getElementById("latent_syphillis_yes").selected = true;
   }
   if(RPR_result == "NR"){
    // document.getElementById("latent_syphillis_no").selected = true;
     document.getElementById('latent_syphillis').value=0;
     document.getElementById('latent_syphillis').style.color='green';
   }
}

function duplicateClear(){
  
  var id_to_check = document.getElementById("pid").value ;
  var date_to_check = document.getElementById("regdate").value ;
  var duplicate_gender = document.getElementById("gender").value;
  console.log("You arrived Reddate");
        $.ajaxSetup({
           headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
          });

          $.ajax({
          type:'POST',
          url:"{{route('stiData')}}",
          data:{
            id_to_check:id_to_check,
            date_to_check:date_to_check,
            duplicate_gender:duplicate_gender
            },
           success:function(response){
                console.log(response);
                if(response[0]==true){
                  alert("Duplicate ID and Date Entry in the same Day.");
                  location.reload(true);
                }

                }
              });
}

</script>

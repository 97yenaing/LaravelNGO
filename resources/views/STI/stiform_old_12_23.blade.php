@extends('layouts.app')
  <link rel="stylesheet" href="/css/STI/stiform.css">
@section('content')
@auth
  <body onload="gender()"></body>
  <div class="container">
    <!-- Nav pills -->
    <br>
    <ul class="nav nav-tabs" style="left:150px;">
        <li class="nav-item">
          <a class="nav-link active" data-toggle="pill" href="#home">Register</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="pill" onclick="" href="#menu1">Physical Exam</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="pill" onclick="" href="#menu2">Lab Results & Treatment</a>
        </li>
        <li>
          <a class="nav-link"  data-toggle="pill" onclick="" href="#menu3">Follow Up History</a>
        </li>
        <li>
          <a class="nav-link" data-toggle="pill" onclick="" href="#menu4">RPR Test History</a>
        </li>
        <li>
          <a class="nav-link" data-toggle="pill" onclick="" href="#menu5">Search and Update</a>
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
      <div class="tab-content">
          <div class="tab-pane  active" id="home">
            <div id="registerForm" >
                <div class=""  style="background:#E1F5C4;" >
                    <br>
                    <div class="row">
                      <div class="col-sm-3">
                        <label for="validationCustom01" class="form-label">General ID</label>
                        <input id="pid" type='number' onchange="ckeckpid()"  class="form-control"  required>
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
                            <input id="age" type="number"  class="form-control" >
                          </div>
                          <div class="col-sm-2">
                              <label for="validationCustom01" class="form-label">Gender</label>
                              <input id="gender" class="form-control" id="validationCustom01" >
                              <div class="valid-feedback">
                                Plz put number
                              </div>
                            </div>
                      <div class="col-sm-3">
                        <label for="validationCustom01" class="form-label">Select Male or Female Form</label>
                        <select class="form-control" id="genderbtn"  onchange="gender()" name="" >
                          <option value="NA"></option>
                          <option value="male">Male</option>
                          <option value="female">Female</option>
                        </select>
                      </div>
                      <div class="col-sm-4"></div>
                      <div class="col-sm-4">

                      </div>
                    </div>
                    <div class="row">

                      <div class="col-sm-3">
                          <label for="validationCustom01" class="form-label">First Visit</label>
                          <select class="form-control" id="firstVisit"  name="" >
                            <option value=""></option>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                            <option value="9">Missing</option>
                          </select>
                        </div>
                        <div class="col-sm-3">
                            <label for="validationCustom01" class="form-label">If Last Visit</label>
                            <select class="form-control" id="lastVisit"  name="" >
                              <option value=""></option>
                              <option value="1">Within 3 months</option>
                              <option  value="2"> > 3 months ago</option>
                              <option value="9">Missing</option>
                            </select>
                          </div>
                          <div class="col-md-3">
                              <label  class="form-label">Heard about clinic</label>
                              <select class="form-control" id="aboutclinic" required>
                                <option value=""></option>
                                <option value=1>From HE Team</option>
                                <option value=2>From Partner</option>
                                <option value=3>From Others</option>
                                <option value=4>Missing</option>

                              </select>
                            </div>
                            <div class="col-sm-3">
                                <label for="validationCustom01" class="form-label">Registration Date</label>
                                <input required id="regdate" type="date" pattern="yy-mm-dd" class="form-control" id="validationCustom01" >
                                <div class="valid-feedback">
                                  Plz put number
                                </div>
                              </div>
                    </div>
                    <br>
              </div>
              <div class="" style="background:#E1F5C4;">
                  <h5>STI diagnosis</h5>
                  <div class="row">
                        <div class="col-sm-2">
                           <label for="validationCustom01" class="form-label">Episode</label>
                            <select class="form-select" id="episode" name="" >
                              <option value=""></option>
                              <option value="1">Yes</option>
                              <option value="0">No</option>
                              <option value="9">Missing</option>
                            </select>
                        </div>
                        <div class="col-sm-2">
                          <label for="validationCustom01" class="form-label">Reasons For Visit</label>
                          <select onchange="" class="form-select" id="reason" name="" >
                            <option value=""></option>
                            <option value="1">Symptomatic</option>
                            <option value="0">Asymptomatic</option>
                            <option value="9">Missing</option>
                          </select>
                        </div>
                        <div class="col-sm-2" id="m1">
                            <label for="validationCustom01" class="form-label">Risk Factor</label>
                            <select class="form-control"id="ptype"  >
                                <option value=""></option>
                                <option value="msm">MSM </option>
                                <option value="tgw">TGW</option>
                                <option value="cfsw">Client of FSW</option>
                                <option value="fsw">FSW</option>
                                <option value="pwid">PWID</option>
                                <option value="pwud">PWUD</option>
                                <option value="p_of_kp">Partner of KP</option>
                                <option value="other">Other</option>
                              </select>
                            </div>
                            <div  id="f1" class="col-sm-2">
                                <label for="validationCustom01" class="form-label">Risk Factor</label>
                                <select class="form-control"id="fe_ptype" onchange="" >
                                    <option value=""></option>
                                    <option value="FSW">FSW </option>
                                    <option value="pwid">PWID</option>
                                    <option value="pwud">PWUD</option>
                                    <option value="p_of_kp">Partner of KP</option>
                                    <option value="ANC_PP">ANC_PP</option>
                                    <option value="ANC_MP">ANC_MP</option>
                                    <option value="Other">Other</option>
                                  </select>
                                </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-2"id="m2">
                      <label for="validationCustom01" class="form-label">Urethral discharge</label>
                      <select class="form-select" id="urethral_discharge" name="" >
                        <option value=""></option>
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                        <option value="9">Missing</option>
                      </select>
                    </div>
                    <div class="col-sm-2" id="m3">
                      <label for="validationCustom01" class="form-label">How long days</label>
                      <input id="howlong_days" type="number" class="form-control" id="validationCustom01">
                      <div class="valid-feedback">
                        Plz put number
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-4" id="f2">
                        <label for="validationCustom01" class="form-label">Abnormal vaginal discharge</label>
                        <select class="form-select" id="abVagdischarge"  >
                          <option value=""></option>
                          <option value="1">Yes</option>
                          <option value="0">No</option>
                          <option value="9">Missing</option>
                        </select>
                    </div>
                    <div class="col-sm-2" id="f3">
                        <label for="validationCustom01" class="form-label">How Long</label>
                        <input type="number"class="form-control" id="hl_ab_va_dis"name="" value="">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-4" id="f4">
                        <label for="validationCustom01" class="form-label">Linked with menstruation</label>
                        <select class="form-select" id="Link_menstra"  >
                          <option value=""></option>
                          <option value="1">Yes</option>
                          <option value="0">No</option>
                          <option value="9">Missing</option>
                        </select>
                    </div>
                    <div class="col-sm-2" id="f5">
                        <label for="validationCustom01" class="form-label">Amount</label>
                        <select class="form-select" id="Amount"  >
                          <option value=""></option>
                          <option value="1">Abundant</option>
                          <option value="0">Normal</option>
                          <option value="9">NA</option>
                        </select>
                    </div>
                    <div class="col-sm-2" id="f6">
                        <label for="validationCustom01" class="form-label">Colour</label>
                        <select class="form-select" id="colour" onchange="col()" >
                          <option value=""></option>
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
                        <input type="text"class="form-control" id="other_specify"name="" value="">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-4" id="f7">
                        <label for="validationCustom01" class="form-label">Abnormal vaginal odour</label>
                        <select class="form-select" id="odour"  >
                          <option value=""></option>
                          <option value="1">Yes</option>
                          <option value="0">No</option>
                          <option value="9">Missing</option>
                        </select>
                    </div>
                    <div class="col-sm-4" id="f8">
                        <label for="validationCustom01" class="form-label">Lower abdominal pain </label>
                        <select class="form-select" id="lower_abd_pain"  >
                          <option value=""></option>
                          <option value="1">Yes</option>
                          <option value="0">No</option>
                          <option value="9">Missing</option>
                        </select>
                    </div>
                    <div class="col-sm-2" id="f9">
                        <label for="validationCustom01" class="form-label">How Long</label>
                        <input class="form-control" type="number" id="hl_abd_pain"name="" value="">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-2" id="f10">
                        <label for="validationCustom01" class="form-label">Fever </label>
                        <select class="form-select" id="fever"  >
                          <option value=""></option>
                          <option value="1">Yes</option>
                          <option value="0">No</option>
                          <option value="9">Missing</option>
                        </select>
                    </div>
                    <div class="col-sm-4" id="f11">
                        <label for="validationCustom01" class="form-label">Recent Termination Pregnancy </label>
                        <select class="form-select" id="terminate_preg"  >
                          <option value=""></option>
                          <option value="1">Yes</option>
                          <option value="0">No</option>
                          <option value="9">Missing</option>
                        </select>
                    </div>
                    <div class="col-sm-2" id="f12">
                        <label for="validationCustom01" class="form-label">Dyspareunia</label>
                        <select class="form-select" id="dyspareunia"  >
                          <option value=""></option>
                          <option value="1">Yes</option>
                          <option value="0">No</option>
                          <option value="9">Missing</option>
                        </select>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12" id="f13">
                        <label for="validationCustom01" class="form-label">Other GI Symptoms</label>
                        <input type="text"class="form-control" id="oth_gi_sym"name="" value="">
                    </div>
                  </div>
                  <div class="row">
                        <div class="col-sm-2" id="g1">
                              <label for="validationCustom01" class="form-label">Dysuria</label>
                              <select class="form-select" id="dysuria" name="" >
                                <option value=""></option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                                <option value="9">Missing</option>
                              </select>
                          </div>
                        <div class="col-sm-2"id="g2">
                              <label for="validationCustom01" class="form-label">How long</label>
                              <input id="howlong_dysuria" type="number" max="250" class="form-control" id="validationCustom01">
                              <div class="valid-feedback">
                                Plz put number
                              </div>
                          </div>
                        <div class="col-sm-2"id="g3">
                                    <label for="validationCustom01" class="form-label">Genital Prutitus</label>
                                    <select class="form-select" id="genital_prutitus" name="" >
                                      <option value=""></option>
                                      <option value="1">Yes</option>
                                      <option value="0">No</option>
                                      <option value="9">Missing</option>
                                    </select>
                          </div>
                        <div class="col-sm-2"id="g4">
                              <label for="validationCustom01" class="form-label">How long</label>
                              <input id="howlong_genital_pruti" type="number" max="250" class="form-control" id="validationCustom01">
                              <div class="valid-feedback">
                                Plz put number
                              </div>
                          </div>
                  </div>
                  <div class="row">
                        <div class="col-sm-4"id="g5">
                                  <label for="validationCustom01" class="form-label">Genital burnig or Pain</label>
                                  <select class="form-select" id="genital_burn" name="" >
                                    <option value=""></option>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
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
                  <div class="row">
                        <div class="col-sm-2"id="g7">
                                  <label for="validationCustom01" class="form-label">Genital ulcer</label>
                                  <select id="genital_ulcer"class="form-select" name="" >
                                    <option value=""></option>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
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
                                    <option value=""></option>
                                    <option value="1">Painful</option>
                                    <option value="0">Painless</option>
                                    <option value="9">Missing</option>
                                  </select>
                                </div>
                        <div class="col-sm-2"id="g10">
                                  <label for="validationCustom01" class="form-label">Ulcer</label>
                                  <select id="ulcer"class="form-select" name="" >
                                    <option value=""></option>
                                    <option value="1">Single</option>
                                    <option value="2">Multiple</option>
                                    <option value="9">Missing</option>
                                  </select>
                                </div>
                        <div class="col-sm-3"id="g11">
                                  <label for="validationCustom01" class="form-label">Prodormal itch/buring</label>
                                  <select id="prodormal_itch"class="form-select" name="" >
                                    <option value=""></option>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                    <option value="9">Missing</option>
                                  </select>
                                </div>
                        <div class="col-sm-3"id="g12">
                                  <label for="validationCustom01" class="form-label">Started as vesicles /blisters</label>
                                  <select id="start_vesicles"class="form-select" name="" >
                                    <option value=""></option>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                    <option value="9">Missing</option>
                                  </select>
                                </div>
                        <div class="col-sm-2"id="g13">
                                  <label for="validationCustom01" class="form-label">Recurrent</label>
                                  <select id="recurrent"class="form-select" name="" >
                                    <option value=""></option>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                    <option value="9">Missing</option>
                                  </select>
                                </div>
                        <div class="col-sm-2"id="g14">
                                  <label for="validationCustom01" class="form-label">Last Episode</label>
                                  <select id="last_episode"class="form-select" name="" >

                                  </select>
                                </div>
                        <div class="col-sm-3"id="g15">
                                  <label for="validationCustom01" class="form-label">Patient Suspects Herpes</label>
                                  <select id="patient_suspect_herpes"class="form-select" name="" >
                                    <option value=""></option>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                    <option value="9">Missing</option>
                                  </select>
                                </div>
                     </div>
                  <div class="row">
                        <div class="col-sm-3" id="g16">
                          <label for="validationCustom01" class="form-label">Inguinal lymph node</label>
                          <select id="inguinal_lymph_node"class="form-select" name="" >
                            <option value=""></option>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
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
                            <option value=""></option>
                            <option value="1">Unilateal</option>
                            <option value="2">Bilateral</option>
                            <option value="9">Missing</option>
                          </select>
                        </div>
                        <div class="col-sm-3" id="g19" >
                          <label for="validationCustom01" class="form-label">Leg ulcer/other infection</label>
                          <select id="leg_ulcer_inf"class="form-select" name="" >
                            <option value=""></option>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                            <option value="9">Missing</option>
                          </select>
                        </div>
                     </div>
                     <div class="row">
                       <div class="col-sm-3" id="m4">
                         <label for="validationCustom01" class="form-label">Scrotal Swelling</label>
                         <select id="scrotal_swelling"class="form-select" name="" >
                           <option value=""></option>
                           <option value="1">Yes</option>
                           <option value="0">No</option>
                           <option value="9">Missing</option>
                         </select>
                       </div>
                       <div class="col-sm-2" id="m5">
                         <label for="validationCustom01" class="form-label">How Long</label>
                         <input id="hl_scrotal_swelling" type="text" class="form-control" id="validationCustom01">
                       </div>
                       <div class="col-sm-3"id="m6">
                         <label for="validationCustom01" class="form-label">Tender/ Non-Tender</label>
                         <select id="tender"class="form-select" name="" >
                           <option value=""></option>
                           <option value="1">tender</option>
                           <option value="0">Non-tender</option>
                           <option value="9">Missing</option>
                         </select>
                       </div>
                     </div>
                  <div class="row">
                        <div class="col-sm-3"id="g20">
                          <label for="validationCustom01" class="form-label">Genital Warts</label>
                          <select id="genital_wart"class="form-select" name="" >
                            <option value=""></option>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
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
          <div class="tab-pane  fade"  style="background:#E1F5C4;" id="menu1">
            <div class="followup" id="followup" >

                <br>
                  <div class="row">
                    <div class="col-sm-2">
                       <label for="validationCustom01" class="form-label">Physical Exam</label>
                        <select class="form-select"  id="physical_exam" name="" >
                          <option value=""></option>
                          <option value="1">Yes</option>
                          <option value="0">No</option>
                          <option value="9">Missing</option>
                        </select>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-4" id="m7">
                       <label for="validationCustom01" class="form-label">Urinated within < 1 hour before visit</label>
                        <select class="form-select"  id="urinated_within1hr"  >
                          <option value=""></option>
                          <option value="1">Yes</option>
                          <option value="0">No</option>
                          <option value="9">Missing</option>
                        </select>
                    </div>
                    <div class="col-sm-2" id="m8">
                       <label for="validationCustom01" class="form-label">Discharge</label>
                        <select class="form-select" id="discharge" name="" >
                          <option value=""></option>
                          <option value="1">Visible</option>
                          <option value="0">Not Visible</option>
                          <option value="9">NA</option>
                        </select>
                    </div>
                    <div class="col-sm-3" id="m9">
                       <label for="validationCustom01" class="form-label">Discharge after milking</label>
                        <select class="form-select"  id="discharge_after_milking" name="" >
                          <option value=""></option>
                          <option value="1">Visible</option>
                          <option value="0">Not Visible</option>
                          <option value="9">NA</option>
                        </select>
                    </div>
                    <div class="col-sm-2" id="m10">
                       <label for="validationCustom01" class="form-label">Colour</label>
                        <select class="form-select"  id="colour" name="" >
                          <option value=""></option>
                          <option value="1">Clear</option>
                          <option value="2">White</option>
                          <option value="3">Yellow</option>
                          <option value="4">Bloody</option>
                          <option value="9">NA</option>
                        </select>
                    </div>
                    <div class="col-sm-3" id="f15">
                       <label for="validationCustom01" class="form-label">Washed inside < 1 hour </label>
                        <select class="form-select" id="wash_inside" name="" >
                          <option value=""></option>
                          <option value="1">Yes</option>
                          <option value="0">No</option>
                          <option value="9">Missing</option>
                        </select>
                    </div>
                    <div class="col-sm-3" id="f16">
                       <label for="validationCustom01" class="form-label">Vulvar erythema</label>
                        <select class="form-select"id="vulvar_erythema" name="" >
                          <option value=""></option>
                          <option value="1">Yes</option>
                          <option value="0">No</option>
                          <option value="9">Missing</option>
                        </select>
                    </div>
                    <div class="col-sm-3" id="f17">
                       <label for="validationCustom01" class="form-label">Vulvar odema</label>
                        <select class="form-select" id="vulvar_odema" name="" >
                          <option value=""></option>
                          <option value="1">Yes</option>
                          <option value="0">No</option>
                          <option value="9">Missing</option>
                        </select>
                    </div>
                    <div class="col-sm-3" id="f18">
                       <label for="validationCustom01" class="form-label">Vaginal Discharge</label>
                        <select class="form-select" id="vag_dis" name="" >
                          <option value=""></option>
                          <option value="1">Yes</option>
                          <option value="0">No</option>
                          <option value="9">Missing</option>
                        </select>
                    </div>
                    <div class="col-sm-3" id="f19">
                       <label for="validationCustom01" class="form-label">Amount</label>
                        <select class="form-select" id="vag_dis_amount" name="" >
                          <option value=""></option>
                          <option value="1">Abundant</option>
                          <option value="0">Normal</option>
                          <option value="9">NA</option>
                        </select>
                    </div>
                    <div class="col-sm-3" id="f20">
                       <label for="validationCustom01" class="form-label">Homogeneous</label>
                        <select class="form-select" id="homogeneous" name="" >
                          <option value=""></option>
                          <option value="1">Yes</option>
                          <option value="0">No</option>
                          <option value="9">Missing</option>
                        </select>
                    </div>
                    <div class="col-sm-3" id="f21">
                       <label for="validationCustom01" class="form-label">Colour</label>
                        <select class="form-select" id="vag_dis_colour"multiple >
                          <option value="1"> Clear</option>
                          <option value="2"> White</option>
                          <option value="3"> Yellow</option>
                          <option value="4"> Bloody</option>
                          <option value="9"> NA</option>
                        </select>
                    </div>
                    <div class="col-sm-3" id="f22">
                       <label for="validationCustom01" class="form-label">Smell(Without KOH)</label>
                        <select class="form-select" id="smell_koh" name="" >
                          <option value=""></option>
                          <option value="1">Smell(+)</option>
                          <option value="0">Smell(-)</option>
                          <option value="9">NA</option>
                        </select>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-3" id="f23">
                       <label for="validationCustom01" class="form-label">Vaginal wall injury</label>
                        <select class="form-select" id="phi_vag_wall" name="" >
                          <option value=""></option>
                          <option value="1">Yes</option>
                          <option value="0">No</option>
                          <option value="9">Missing</option>
                        </select>
                    </div>
                    <div class="col-sm-3" id="f24">
                       <label for="validationCustom01" class="form-label">Adnexal tenderness</label>
                        <select class="form-select" id="phi_ad_tender" name="" >
                          <option value=""></option>
                          <option value="1">Yes</option>
                          <option value="0">No</option>
                          <option value="9">Missing</option>
                        </select>
                    </div>
                    <div class="col-sm-3" id="f25">
                       <label for="validationCustom01" class="form-label">Adnexal enlargement</label>
                        <select class="form-select" id="phi_ad_enlarge" name="" >
                          <option value=""></option>
                          <option value="1">Yes</option>
                          <option value="0">No</option>
                          <option value="9">Missing</option>
                        </select>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-2" id="f29">
                      <label for="validationCustom01" class="form-label">Genital blisters</label>
                      <select id="genital_blisters"  class="form-select" name="" >
                        <option value=""></option>
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                        <option value="9">Missing</option>
                      </select>
                    </div>
                    <div class="col-sm-8" id="f30">
                       <label for="validationCustom01" class="form-label">Location</label>
                       <Input id="genital_location"  class="form-control" >
                     </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-3" id="m11">
                       <label for="validationCustom01" class="form-label">Erythema on glans</label>
                        <select class="form-select"  id="phi_erythema" name="" >
                          <option value=""></option>
                          <option value="1">Yes</option>
                          <option value="0">No</option>
                          <option value="9">Missing</option>
                        </select>
                    </div>
                    <div class="col-sm-3" id="m12">
                       <label for="validationCustom01" class="form-label">Blisters on Penis</label>
                        <select class="form-select"  id="phi_blister_penis" name="" >
                          <option value=""></option>
                          <option value="1">Yes</option>
                          <option value="0">No</option>
                          <option value="9">Missing</option>
                        </select>
                    </div>
                    <div class="col-sm-2" id="g22">
                       <label for="validationCustom01" class="form-label">Genital ulcer</label>
                        <select class="form-select"  id="phi_genital_ulcer" name="" >
                          <option value=""></option>
                          <option value="1">Yes</option>
                          <option value="0">No</option>
                          <option value="9">Missing</option>
                        </select>
                    </div>
                    <div class="col-sm-8" id="f31">
                       <label for="validationCustom01" class="form-label">Location</label>
                       <Input id="genital_ulc_location"  class="form-control" >
                     </div>
                    <div class="col-sm-2" id="m13">
                       <label for="validationCustom01" class="form-label">Estimated Size</label>
                       <input id="phi_estimated_size"  class="form-control" type="text" name="" value="">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-2" id="g23">
                       <label for="validationCustom01" class="form-label">Signle/Multiple</label>
                        <select class="form-select" id="phi_single_multiple" name="" >
                          <option value=""></option>
                          <option value="1">Single</option>
                          <option value="2">Multiple</option>
                          <option value="9">Missing</option>
                        </select>
                    </div>
                    <div class="col-sm-2" id="g24">
                       <label for="validationCustom01" class="form-label">Painfull/Painless </label>
                        <select class="form-select"  id="phi_painfull" name="" >
                          <option value=""></option>
                          <option value="1">Painfull</option>
                          <option value="2">Painless</option>
                          <option value="9">Missing</option>
                        </select>
                    </div>
                    <div class="col-sm-2" id="g25" >
                       <label for="validationCustom01" class="form-label">Herpes suspected </label>
                        <select class="form-select"  id="phi_herpes_suspected" name="" >
                          <option value=""></option>
                          <option value=1>Yes</option>
                          <option value=0>No</option>
                          <option value=9>Missing</option>
                        </select>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-3"id="g26">
                       <label for="validationCustom01" class="form-label">Inguinal bubo </label>
                        <select class="form-select" id="phi_inguinal_bubo" name="" >
                          <option value=""></option>
                          <option value=1>Yes</option>
                          <option value=0>No</option>
                          <option value=9>Missing</option>
                        </select>
                    </div>
                    <div class="col-sm-3"id="g27">
                       <label for="validationCustom01" class="form-label">Fluctant </label>
                        <select class="form-select" id="phi_fluctant" name="" >
                          <option value=""></option>
                          <option value=1>Yes</option>
                          <option value=0>No</option>
                          <option value=9>Missing</option>
                        </select>
                    </div>
                    <div class="col-sm-3"id="g28">
                       <label for="validationCustom01" class="form-label">Tender/non tender </label>
                        <select class="form-select" id="phi_tender" name="" >
                          <option value=""></option>
                          <option value=1>Yes</option>
                          <option value=0>No</option>
                          <option value=9>Missing</option>
                        </select>
                    </div>
                    <div class="col-sm-3"id="g29">
                       <label for="validationCustom01" class="form-label">Other Leg infection </label>
                        <select class="form-select" id="phi_leg_inf" name="" >
                          <option value=""></option>
                          <option value=1>Yes</option>
                          <option value=0>No</option>
                          <option value=9>Missing</option>
                        </select>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-2"id="g30">
                       <label for="validationCustom01" class="form-label">Genital Warts</label>
                        <select class="form-select" id="phi_genital_wart" name="" >
                          <option value=""></option>
                          <option value=1>Yes</option>
                          <option value=0>No</option>
                          <option value=9>Missing</option>
                        </select>
                    </div>
                    <div class="col-sm-2"id="g31">
                       <label for="validationCustom01" class="form-label">Crab lice</label>
                        <select class="form-select" id="phi_crab_lice" name="" >
                          <option value=""></option>
                          <option value=1>Yes</option>
                          <option value=0>No</option>
                          <option value=9>Missing</option>
                        </select>
                    </div>
                    <div class="col-sm-2"id="g32">
                       <label for="validationCustom01" class="form-label">Scabies</label>
                        <select class="form-select" id="phi_scabies" name="" >
                          <option value=""></option>
                          <option value=1>Yes</option>
                          <option value=0>No</option>
                          <option value=9>Missing</option>
                        </select>
                    </div>
                    <div class="col-sm-2" id="f26">
                       <label for="validationCustom01" class="form-label">KOH smell test</label>
                        <select class="form-select" id="phi_koh_smell" name="" >
                          <option value=""></option>
                          <option value="1">Smell(+)</option>
                          <option value="0">Smell(-)</option>
                          <option value="9">Missing</option>
                        </select>
                    </div>
                    <div class="col-sm-2" id="f27">
                       <label for="validationCustom01" class="form-label">pH Vagina</label>
                        <select class="form-select" id="phi_ph_vagina" name="" >
                          <option value=""></option>
                          <option value="<=4.5"> <=4.5 </option>
                          <option value=">=4.6"> >=4.6 </option>
                          <option value="Miss">Missing</option>
                        </select>
                    </div>
                    <div class="col-sm-12" id="f28">
                       <label for="validationCustom01" class="form-label">Make drawing and describe</label>
                        <Input class="form-select" id="phi_drawing_f" name="" >
                    </div>
                    <div class="col-sm-2" id="m14">
                       <label for="validationCustom01" class="form-label">Scrotal swelling</label>
                        <select class="form-select"  id="phi_scrotal_swelling" name="" >
                          <option value=""></option>
                          <option value="1">Yes</option>
                          <option value="0">No</option>
                          <option value="9">Missing</option>
                        </select>
                    </div>
                    <div class="col-sm-2" id="m15">
                       <label for="validationCustom01" class="form-label">Estimated Size</label>
                        <select class="form-select"  id="phi_esti_size" name="" >
                          <option value=""></option>
                          <option value="1">Yes</option>
                          <option value="0">No</option>
                          <option value="9">Missing</option>
                        </select>
                    </div>
                    <div class="col-sm-2" id="m16">
                       <label for="validationCustom01" class="form-label">Unilateal/Bilateral</label>
                        <select class="form-select"  id="phi_unilateal" name="" >
                          <option value=""></option>
                          <option value="1">Yes</option>
                          <option value="0">No</option>
                          <option value="9">Missing</option>
                        </select>
                    </div>
                    <div class="col-sm-3" id="m17">
                       <label for="validationCustom01" class="form-label">Tender/Non-Tender</label>
                        <select class="form-select"  id="phi_tender_non" name="" >
                          <option value=""></option>
                          <option value="1">Yes</option>
                          <option value="0">No</option>
                          <option value="9">Missing</option>
                        </select>
                    </div>
                    <div class="col-sm-2" id="m18">
                       <label for="validationCustom01" class="form-label">Erythema</label>
                        <select class="form-select"  id="phi_erythema1" name="" >
                          <option value=""></option>
                          <option value="1">Yes</option>
                          <option value="0">No</option>
                          <option value="9">Missing</option>
                        </select>
                    </div>
                    <div class="col-sm-4" id="m19">
                       <label for="validationCustom01" class="form-label">Make Drawing and describe size</label>
                        <select class="form-select"  id="phi_drawing" name="" >
                          <option value=""></option>
                          <option value="1">Yes</option>
                          <option value="0">No</option>
                          <option value="9">Missing</option>
                        </select>
                    </div>
                  </div>
                  <br>

              </div>
            </div>
          <div class="tab-pane  fade" id="menu2">
              <div class="" style="background:#E1F5C4;" >
                <br>
                  <div class="row" >
                    <div class="col-sm-6" id="f32">
                       <label for="validationCustom01" class="form-label">Previous STI(compl or confirmed)(2)</label>
                        <select class="form-select"  id="cal1" name="" >
                          <option value=""></option>
                          <option value= 2>Yes</option>
                          <option value= 0>No</option>
                          <option value="0">Missing</option>
                        </select>
                    </div>
                    <div class="col-sm-6"id="f33" >
                       <label for="validationCustom01" class="form-label">New partner within past 3 months (2)</label>
                        <select class="form-select"  id="cal2" name="" >
                          <option value=""></option>
                          <option value=2>Yes</option>
                          <option value=0>No</option>
                          <option value="0">Missing</option>
                        </select>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-4" id="f34">
                       <label for="validationCustom01" class="form-label">Patient compl.Dysuria or genital ulcer(3)</label>
                        <select class="form-select" id="cal3" name="" >
                          <option value=""></option>
                          <option value=3>Yes</option>
                          <option value=0>No</option>
                          <option value="0">Missing</option>
                        </select>
                    </div>
                    <div class="col-sm-4" id="f35">
                       <label for="validationCustom01" class="form-label">Partner compl.Genital symptoms (3)</label>
                        <select class="form-select"  id="cal4" name="" >
                          <option value=""></option>
                          <option value=3>Yes</option>
                          <option value=0>No</option>
                          <option value="0">Missing</option>
                        </select>
                    </div>
                  </div>
                  <div class="row" >
                    <div class="col-sm-4" id="f36">
                       <label for="validationCustom01" class="form-label">Patient compl. Lower abdominal pain (1)</label>
                        <select class="form-select"  id="cal5" name="" >
                          <option value=""></option>
                          <option value=1>Yes</option>
                          <option value=0>No</option>
                          <option value="0">Missing</option>
                        </select>
                    </div>
                    <div class="col-sm-4"id="f37">
                       <label for="validationCustom01" class="form-label">Sex worker</label>
                        <select class="form-select"  id="cal6" name="" >
                          <option value=""></option>
                          <option value=3>Yes</option>
                          <option value=0>No</option>
                          <option value="0">Missing</option>
                        </select>
                    </div>
                  </div>
                  <br>
                  <div class="row" >
                      <div class="col-sm-3" id="f38">
                        <button onclick="calSore()" type="button" class="btn btn-dark">Calculate Score</button>
                      </div>
                      <div class="col-sm-2" id="f39">
                        <label class="form-label">Score</label>
                      </div>
                      <div class="col-sm-2" id="f40">
                        <span id="scoreNum" class="badge bg-danger">-</span>
                      </div>
                      <div class="col-sm-2"id="f41">
                        <label class="form-label">Risk Group</label>
                      </div>
                      <div class="col-sm-2" id="f42">
                        <span id="risktext"class="badge bg-danger">-</span>
                      </div>
                  </div>
                  <div class="row" >
                    <div class="col-sm-12" id="f43">
                      <label class="form-label">Risk Remark</label>
                      <input id="riskRemark" class="form-control"type="text" name="" value="">
                    </div>
                  </div>
                  <div class="row" >
                    <div class="col-sm-12" id="f44">
                      <h5> Do a risk assement for Cervical infection (* Spontaneous expressed complaints ONLY) fof HR women of irregular visit( Last Visit > 3 mths ago).</h5>
                    </div>
                  </div>
                  <div class="row" >
                    <div class="col-sm-6"id="f45">
                       <label for="validationCustom01" class="form-label">Abnormal yellow discharge (if only abnormal abundant discaarge)(2)</label>
                        <select class="form-select"  id="ab_yellow_discharge" name="" >
                          <option value=""></option>
                          <option value=1>Yes</option>
                          <option value=0>No</option>
                          <option value="9">Missing</option>
                        </select>
                    </div>
                    <div class="col-sm-6"id="f46">
                       <label for="validationCustom01" class="form-label">Pain during sexual untercourse (1)</label>
                        <select class="form-select"  id="cal7" name="" >
                          <option value=""></option>
                          <option value=1>Yes</option>
                          <option value=0>No</option>
                          <option value="9">Missing</option>
                        </select>
                    </div>
                  </div>
                  <div class="row" >
                    <div class="col-sm-6"id="f47">
                       <label for="validationCustom01" class="form-label">Dysuria(1)</label>
                        <select class="form-select"  id="cal8" name="" >
                          <option value=""></option>
                          <option value=1>Yes</option>
                          <option value=0>No</option>
                          <option value=9>Missing</option>
                        </select>
                    </div>
                    <div class="col-sm-6" id="f48">
                       <label for="validationCustom01" class="form-label">Unprotected sex with new clients (1)</label>
                        <select class="form-select"  id="cal9" name="" >
                          <option value=""></option>
                          <option value=1>Yes</option>
                          <option value=0>No</option>
                          <option value="9">Missing</option>
                        </select>
                    </div>
                  </div>
                  <div class="row" >
                    <div class="col-sm-6"id="f49">
                       <label for="validationCustom01" class="form-label">Lower abdominal pain (1)</label>
                        <select class="form-select"  id="cal10" name="" >
                          <option value=""></option>
                          <option value=1>Yes</option>
                          <option value=0>No</option>
                          <option value="9">Missing</option>
                        </select>
                    </div>
                    <div class="col-sm-6" id="f50">
                       <label for="validationCustom01" class="form-label">Partner discharge/ Ulcer (2)</label>
                        <select class="form-select"  id="fe_partner_ulcer" name="" >
                          <option value=""></option>
                          <option value=1>Yes</option>
                          <option value=0>No</option>
                          <option value="9">Missing</option>
                        </select>
                    </div>
                  </div>

                  <div class="row"  >
                    <div class="col-sm-12" id="m20">
                      <h5> Do risk assessment for sexual transmitted infection (only for MSM).</h5>
                    </div>
                  </div>
                  <div class="row"  >
                    <div class="col-sm-6"id="m21" >
                      <label for="validationCustom01" class="form-label">Patient's First Visit To Clinic</label>
                       <select class="form-select" id="pt_1st_visit" name="" >
                         <option value=""></option>
                         <option value="1">Yes</option>
                         <option value="0">No</option>
                         <option value="9">NA</option>
                       </select>
                    </div>
                    <div class="col-sm-6"id="m22">
                      <label for="validationCustom01" class="form-label">Patient had an episode of discharge since the last visit.</label>
                       <select class="form-select" id="pt_epi_dis_lastvisit" name="" >
                         <option value=""></option>
                         <option value="1">Yes</option>
                         <option value="0">No</option>
                         <option value="9">NA</option>
                       </select>
                    </div>
                  </div>
                  <div class="row" >
                    <div class="col-sm-6" id="m23">
                      <label for="validationCustom01" class="form-label">Patient had unproteced sex with new partner.</label>
                       <select class="form-select" id="unprotected_sex" name="" >
                         <option value=""></option>
                         <option value="1">Yes</option>
                         <option value="0">No</option>
                         <option value="9">NA</option>
                       </select>
                    </div>
                    <div class="col-sm-6" id="m24">
                      <label for="validationCustom01" class="form-label">Patient genital sign/symptoms</label>
                       <select class="form-select" id="genital_sign" name="" >
                         <option value=""></option>
                         <option value="1">Yes</option>
                         <option value="0">No</option>
                         <option value="9">NA</option>
                       </select>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12"id="m25">
                      <label for="">If any of above questions answered "Yes" ,Risk assessment (+)</label>
                    </div>
                  </div>
                  <div class="row" >
                    <div class="col-sm-12"id="g33" >
                      <label class="form-label" for="">Presumptive Diagnosis</label>
                      <input class="form-control" type="text" name="" id="presumptive_diag"value="">
                    </div>
                  </div>
                  <div class="row" ><!-- OI -->
                    <div class="col-sm-12">
                      <label for="validationCustom01" class="form-label"></label>
                      <div class="table-responsive">
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
                              <td style="width:200px;">
                                <label style="width:190px">Primary Syphillis</label>
                                <select id="primary_syphillis"class="" name="">
                                  <option value="0">No</option>
                                  <option value="1">Yes</option>
                                </select>
                              </td>
                              <td style="width:200px;">
                                <label style="width:190px">Gonorrhoea</label>
                                <select id="gonorrhoea" class="" name="">
                                  <option value="0">No</option>
                                  <option value="1">Yes</option>
                                </select>
                              </td>
                              <td style="width:200px;">
                                <label style="width:190px">Congenial Syphillis</label>
                                <select id="congenial_syphillis" class="" name="">
                                  <option value="0">No</option>
                                  <option value="1">Yes</option>
                                </select>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                <label style="width:190px">Secondary Syphillis</label>
                                <select id="secondary_syphillis" class="" name="">
                                  <option value="0">No</option>
                                  <option value="1">Yes</option>
                                </select>
                              </td>
                              <td>
                                <label style="width:190px">Non-Gonococcal Urethritis</label>
                                <select id="non_gono_urethri"class="" name="">
                                  <option value="0">No</option>
                                  <option value="1">Yes</option>
                                </select>
                              </td>
                              <td>
                                <label style="width:190px">Latent Syphillis</label>
                                <select id="latent_syphillis"class="" name="">
                                  <option value=""></option>
                                  <option id="latent_syphillis_no" value=0>No</option>
                                  <option id="latent_syphillis_yes" value=1>Yes</option>
                                </select>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                <label style="width:190px">Chancroid</label>
                                <select id="chancroid" class="" name="">
                                  <option value="0">No</option>
                                  <option value="1">Yes</option>
                                </select>
                              </td>
                              <td id="m27">
                                <label style="width:190px">Non-Gonococal proctitis</label>
                                <select id="non_gono_procti" class="" name="">
                                  <option value="0">No</option>
                                  <option value="1">Yes</option>
                                </select>
                              </td>
                              <td id="f54">
                                <label style="width:190px">Non-Gonococal Cervities</label>
                                <select id="non_gono_cervities" class="" name="">
                                  <option value="0">No</option>
                                  <option value="1">Yes</option>
                                </select>
                              </td>
                              <td id="f51">
                                <label style="width:190px">Latent Syphillis (pregnancy)</label>
                                <select  id="latent_syp_pregancy" class="" name="">
                                  <option value="0">No</option>
                                  <option value="1">Yes</option>
                                </select>
                              </td>
                              <td>
                                <label style="width:190px">Molluscum Contagiosum</label>
                                <select id="molluscum_contagiosum" class="" name="">
                                  <option value="0">No</option>
                                  <option value="1">Yes</option>
                                </select>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                <label style="width:190px">Genital Herpes</label>
                                <select id="genital_herpes3"class="" name="">
                                  <option value="0">No</option>
                                  <option value="1">Yes</option>
                                </select>
                              </td>
                              <td>
                                <label style="width:190px">Trichomonas</label>
                                <select id="trichomonas" class="" name="">
                                  <option value="0">No</option>
                                  <option value="1">Yes</option>
                                </select>
                              </td>
                              <td>
                                <label style="width:190px">Bubos</label>
                                <select id="bubos"class="" name="">
                                  <option value="0">No</option>
                                  <option value="1">Yes</option>
                                </select>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                <label style="width:190px">Genital Scabies</label>
                                <select id="genital_scabies3"class="" name="">
                                  <option value="0">No</option>
                                  <option value="1">Yes</option>
                                </select>
                              </td>
                              <td>
                                <label style="width:190px">Gential Candidiosis</label>
                                <select id="genital_candidiosis" class="" name="">
                                  <option value="0">No</option>
                                  <option value="1">Yes</option>
                                </select>
                              </td>
                              <td>
                                <label style="width:190px"> Genital Warts</label>
                                <select id="genital_warts3"class="" name="">
                                  <option value="0">No</option>
                                  <option value="1">Yes</option>
                                </select>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                <label style="width:190px">Others</label>
                                <select id="others3" class="" name="">
                                  <option value="0">No</option>
                                  <option value="1">Yes</option>
                                </select>
                              </td>
                              <td>
                                <label style="width:190px">Baterial Vaginosis</label>
                                <select id="baterial_vaginosis"class="" name="">
                                  <option value="0">No</option>
                                  <option value="1">Yes</option>
                                </select>
                              </td>
                              <td>
                                <label style="width:190px">Others</label>
                                <select id="others33"class="" name="">
                                  <option value="0">No</option>
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
                        <h5>Treatment (Fill in dose)</h5>
                      </div>
                     </div>
                  <div class="row">
                      <div class="col-sm-3">
                        <input type="checkbox" id="tre_azythro" name="" > 1. Azythro
                      </div>
                      <div class="col-sm-3">
                        <input type="checkbox" id="tre_cefixim" > 2. Cefixim
                      </div>
                      <div class="col-sm-3">
                        <input type="checkbox" id="tre_ciprofloxacin" > 3. Ciprofloxacin
                      </div>
                      <div class="col-sm-3">
                          <input type="checkbox" id="tre_tinidazole" > 4. Tinidazole
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-3">
                        <input type="checkbox" id="tre_fluconazole" > 5. Fluconazole
                      </div>
                      <div class="col-sm-3">
                        <input type="checkbox" id="tre_doxycycline" > 6. Doxycycline
                      </div>
                      <div class="col-sm-3">
                        <input type="checkbox" id="tre_ceftriaxone" > 7. Ceftriaxone
                      </div>
                      <div class="col-sm-3">
                          <input type="checkbox" id="tre_benzpen" > 8. Benz Pen
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-3" id="f52" >
                        <input type="checkbox"  id="clotrimazole" > 9. Clotrimazole vaginal tab
                      </div>
                      <div class="col-sm-3" id="m26" >
                        <input type="checkbox" id="no_treament1" > 9. No Treatment
                      </div>
                      <div class="col-sm-3" id="f53">
                        <input type="checkbox" id="no_treament" > 10. No Treatment
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-3">
                        <label for="validationCustom01" class="form-label">Allergy</label>
                         <select class="form-select" id="allergy" name="" >
                           <option value=""></option>
                           <option value="1">Yes</option>
                           <option value="0">No</option>
                           <option value="9">Missing</option>
                         </select>
                      </div>
                      <div class="col-sm-3">
                        <label for="validationCustom01" class="form-label">Sulfa</label>
                         <select class="form-select" id="sulfa" name="" >
                           <option value=""></option>
                           <option value="1">Yes</option>
                           <option value="0">No</option>
                           <option value="9">Missing</option>
                         </select>
                      </div>
                      <div class="col-sm-3">
                        <label for="validationCustom01" class="form-label">Parter Treatment Given</label>
                         <select class="form-select" id="parter_treatment_given" name="" >
                           <option value=""></option>
                           <option value="1">Yes</option>
                           <option value="0">No</option>
                           <option value="9">Missing</option>
                         </select>
                      </div>
                      <div class="col-sm-3">
                        <label for="validationCustom01" class="form-label">Condom given</label>
                         <select class="form-select" id="condom" name="" >
                           <option value=""></option>
                           <option value="1">Yes</option>
                           <option value="0">No</option>
                           <option value="9">Missing</option>
                         </select>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-12">
                        <label class="form-label" for="">Remark for Treatment</label>
                        <input class="form-control" type="text" id="remarkTreatment" value="">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-12">
                        <label class="form-label" for="">Follow Up</label>
                        <input class="form-control" type="text" id="follwupText" value="">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-12">
                        <label class="form-label" for="">Clinician Name</label>
                        <input class="form-control" type="text" id="clinicainName" value="">
                      </div>
                    </div>
                      <br> <!-- Medic -->
                </div>
                   <div class="row"> <!-- Buttons -->
                     <div class="col-sm-4">
                         <button id="male_btn" onclick="sendDataMale()" class="btn btn-warning btn-block">Register Male</button>
                     </div>
                     <div class="col-sm-4">
                         <button id="female_btn" onclick="sendDataFemale()" class="btn btn-warning btn-block">Register Female</button>
                     </div>
                   </div>
          </div>
          <div class="tab-pane  fade" id="menu3">
            <div class="row">
              <h5>STI follow up History</h5>
            </div>



            <div class="row" style="margin:auto;">
                    <table class="table table-hover table-bordered" >
                      <thead>
                        <tr>
                          <th style="padding-left:100px;">No.</th>
                          <th>Row-ID</th>
                          <th>Visit Date</th>

                        </tr>
                      </thead>
                      <tbody id="testHistory" >
                      </tbody>
                    </table>
            </div>
          </div>
          <div class="tab-pane  fade" id="menu4">
            <div class="row">
              <h5>RPR Test History</h5>
            </div>
                <div class="row" style="margin:auto;">
                    <table class="table table-hover " >
                                  <thead>
                                    <tr>
                                      <th style="padding-left:100px;">No.</th>
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
          <div class="tab-pane fade" id="menu5">
            <div class="row">
              <h4>Search Data in STI Register and Update</h4>
            </div>
            <div class="row">
              <div class="col-sm-3">
                <label for="validationCustom01" class="form-label">General ID</label>
                <input id="pid_shar" type='number' onchange="ckeckpid()"  class="form-control"  required>
              </div>
            </div>
                <div class="row" style="margin:auto;">
                    <table class="table table-hover " >
                                  <thead>
                                    <tr>
                                      <th style="padding-left:100px;">No.</th>
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
      </div>
    </body>
@endauth
@endsection
<script type="text/javascript" language="javascript">
      let general =['g1','g2','g3','g4','g5','g6','g7','g8','g9','g10',
      'g11','g12','g13','g14','g15','g16','g17','g18','g19','g20',
      'g21','g22','g23','g24','g25','g26','g27','g28','g29','g30',
      'g31','g32','g33'];
      let female =
      ['f1','f2','f3','f4','f5','f6','f7','f8','f9','f10',
      'f11','f12','f13','f14','f15','f16','f17','f18','f19','f20',
      'f21','f22','f23','f24','f25','f26','f27','f28','f29','f30',
      'f31','f32','f33','f34','f35','f36','f37','f38','f39','f40',
      'f41','f42','f43','f44','f45','f46','f47','f48','f49','f50',
      'f51','f52','f53','f54'];
      let male =
      ['m1','m2','m3','m4','m5','m6','m7','m8','m9','m10',
      'm11','m12','m13','m14','m15','m16','m17','m18','m19','m20',
      'm21','m22','m23','m24','m25','m26','m27'];
      let resp = 0;let rowNo=0;

function ckeckpid(){
        let  pid = document.getElementById("pid").value;
        let  pid_shar = document.getElementById("pid_shar").value;
        let  ckPatient=1;

        if (pid_shar){
          pid = pid_shar;
          var pid_update = 1;
          var  data={
                      pid:pid,
                      pid_update:pid_update,
                      ckPatient:ckPatient
                    };
        }else{
          var  data={
                      pid:pid,
                      ckPatient:ckPatient
                    };
        }

           len = pid.length;
          console.log(len);
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
                             var r0 =response[0].length;//patients
                             var r1 =response[1].length;//sti_Male
                             var r2 =response[2].length;//sti_female
                             var r3 =response[3].length;//rpr Result
                             var r4 = response[4];// Update

                             if(countResponse>0){
                               //document.getElementById("gender").value=response[0]["gender"];
                               if(r0 > 0){ /////////////////////////////////////////////////////// ====>>>>>>>>>>>>>>> Need to change "r0"
                                 document.getElementById('age').value=response[0][0]["Agey"];

                                 document.getElementById('fuchia').value=response[0][0]["FuchiaID"];
                                 document.getElementById('gender').value=response[0][0]["Gender"];
                                 if(r1 > 0){ // Male

                                   if(r1 == 1){

                                     var but_ton0 = "<a  data-toggle='tab' href='#hiv'  onclick='sti_row()' class='nav-link btn btn-warning'>"+"Update Data"+"</a>" ;
                                     var result_body0 ="<tr style='background-color:#69D2E7;'>"+
                                                              "<td style='padding-left:100px;' id='updateSerial0'>"+'1'+"</td>"+"<td>"+response[1][0]['id']+"</td>"+"<td >"+response[1][0]['Visit date']+"</td>"+
                                                              +"<td>"+but_ton0+"</td>"+
                                                      "</tr>";
                                     if(r4 == 333){
                                       $("#stiUpdate").append(result_body0);
                                     }else{
                                       $("#testHistory").append(result_body0);
                                     }
                                   }
                                   if(r1 == 2){

                                     var but_ton0 = "<a  data-toggle='tab' href='#hiv'  onclick='sti_row()' class='nav-link btn btn-warning'>"+"Update Data"+"</a>" ;
                                     var result_body0 ="<tr style='background-color:#69D2E7;'>"+
                                                              "<td style='padding-left:100px;' id='updateSerial0'>"+'1'+"</td>"+"<td>"+response[1][0]['id']+"</td>"+
                                                              "<td >"+response[1][0]['Visit date']+"</td>"+"</td>"+"<td>"+but_ton0+"</td>"+
                                                       "</tr>";
                                    if(r4>0){
                                        $("#stiUpdate").append(result_body0);
                                    }else{
                                        $("#testHistory").append(result_body0);
                                        }


                                     var but_ton1 = "<a  data-toggle='tab' href='#hiv'  onclick='sti_row_1()' class='nav-link btn btn-warning'>"+"Update Data"+"</a>" ;
                                     var result_body1 ="<tr style='background-color:#69D2E7;'>"+
                                                              "<td style='padding-left:100px;' id='updateSerial0'>"+'2'+"</td>"+"<td>"+response[1][1]['id']+"</td>"+
                                                              "<td >"+response[1][1]['Visit date']+"</td>"+"<td>"+but_ton1+"</td>"+
                                                      "</tr>";
                                    if(r4>0){
                                        $("#stiUpdate").append(result_body0);
                                    }else{
                                        $("#testHistory").append(result_body0);
                                }
                                   }
                                   if(r1 == 3){

                                     var but_ton0 = "<a  data-toggle='tab' href='#hiv'  onclick='sti_row()' class='nav-link btn btn-warning'>"+"Update Data"+"</a>" ;
                                     var result_body0 ="<tr style='background-color:#69D2E7;'>"+
                                                              "<td style='padding-left:100px;' id='updateSerial0'>"+'1'+"</td>"+"<td>"+response[1][0]['id']+"</td>"+
                                                              "<td >"+response[1][0]['Visit date']+"</td>"+"</td>"+"<td>"+but_ton0+"</td>"+
                                                       "</tr>";
                                     $("#testHistory").append(result_body0);
                                     var but_ton1 = "<a  data-toggle='tab' href='#hiv'  onclick='sti_row_1()' class='nav-link btn btn-warning'>"+"Update Data"+"</a>" ;
                                     var result_body1 ="<tr style='background-color:#69D2E7;'>"+
                                                              "<td style='padding-left:100px;' id='updateSerial0'>"+'2'+"</td>"+"<td>"+response[1][1]['id']+"</td>"+
                                                              "<td >"+response[1][1]['Visit date']+"</td>"+"</td>"+"<td>"+but_ton1+"</td>"+
                                                      "</tr>";
                                     $("#testHistory").append(result_body1);
                                     var but_ton2 = "<a  data-toggle='tab' href='#hiv'  onclick='sti_row_2()' class='nav-link btn btn-warning'>"+"Update Data"+"</a>" ;
                                     var result_body2 ="<tr style='background-color:#69D2E7;'>"+
                                                              "<td style='padding-left:100px;' id='updateSerial0'>"+'3'+"</td>"+"<td>"+response[1][2]['id']+"</td>"+
                                                              "<td >"+response[1][2]['Visit date']+"</td>"+"</td>"+"<td>"+but_ton2+"</td>"+
                                                      "</tr>";
                                     $("#testHistory").append(result_body2);
                                   }

                                 }
                                 if(r2 > 0){//Female

                                 }
                                 if(r3 > 0){// RPR Test Result
                                   if(r3 == 1){
                                     var but_ton0 = "<a  data-toggle='tab' href='#hiv'  onclick='rpr_row0()' class='nav-link btn btn-warning'>"+"Fetch Data"+"</a>" ;
                                     var result_body0 ="<tr style='background-color:#69D2E7;'>"+
                                                              "<td style='padding-left:100px;' id='updateSerial0'>"+'1'+"</td>"+"<td>"+response[3][0]['id']+"</td>"+"<td >"+response[3][0]['visit_date']+"</td>"+
                                                              "<td >"+response[3][0]['RPR Qualitative']+"</td>"+"<td>"+but_ton0+"</td>"+
                                                      "</tr>";
                                     $("#rprHistory").append(result_body0);
                                   }
                                   if(r3 == 2){
                                     var but_ton0 = "<a  data-toggle='tab' href='#hiv'  onclick='rpr_row0()' class='nav-link btn btn-warning'>"+"Fetch Data"+"</a>" ;
                                     var result_body0 ="<tr style='background-color:#69D2E7;'>"+
                                                              "<td style='padding-left:100px;' id='updateSerial0'>"+'1'+"</td>"+"<td>"+response[3][0]['id']+"</td>"+"<td >"+response[3][0]['visit_date']+"</td>"+
                                                              "<td >"+response[3][0]['RPR Qualitative']+"</td>"+"<td>"+but_ton0+"</td>"+
                                                      "</tr>";
                                     $("#rprHistory").append(result_body0);
                                     var but_ton1 = "<a  data-toggle='tab' href='#hiv'  onclick='rpr_row1()' class='nav-link btn btn-warning'>"+"Fetch Data"+"</a>" ;
                                     var result_body1 ="<tr style='background-color:#69D2E7;'>"+
                                                              "<td style='padding-left:100px;' id='updateSerial0'>"+'2'+"</td>"+"<td>"+response[3][1]['id']+"</td>"+"<td >"+response[3][1]['visit_date']+"</td>"+
                                                              "<td >"+response[3][1]['RPR Qualitative']+"</td>"+"<td>"+but_ton1+"</td>"+
                                                      "</tr>";
                                     $("#rprHistory").append(result_body1);

                                   }
                                   if(r3 == 3){
                                     var but_ton0 = "<a  data-toggle='tab' href='#hiv'  onclick='rpr_row0()' class='nav-link btn btn-warning'>"+"Fetch Data"+"</a>" ;
                                     var result_body0 ="<tr style='background-color:#69D2E7;'>"+
                                                              "<td style='padding-left:100px;' id='updateSerial0'>"+'1'+"</td>"+"<td>"+response[3][0]['id']+"</td>"+"<td >"+response[3][0]['visit_date']+"</td>"+
                                                              "<td >"+response[3][0]['RPR Qualitative']+"</td>"+"<td>"+but_ton0+"</td>"+
                                                      "</tr>";
                                     $("#rprHistory").append(result_body0);
                                     var but_ton1 = "<a  data-toggle='tab' href='#hiv'  onclick='rpr_row1()' class='nav-link btn btn-warning'>"+"Fetch Data"+"</a>" ;
                                     var result_body1 ="<tr style='background-color:#69D2E7;'>"+
                                                              "<td style='padding-left:100px;' id='updateSerial0'>"+'2'+"</td>"+"<td>"+response[3][1]['id']+"</td>"+"<td >"+response[3][1]['visit_date']+"</td>"+
                                                              "<td >"+response[3][1]['RPR Qualitative']+"</td>"+"<td>"+but_ton1+"</td>"+
                                                      "</tr>";
                                     $("#rprHistory").append(result_body1);
                                     var but_ton2 = "<a  data-toggle='tab' href='#hiv'  onclick='rpr_row2()' class='nav-link btn btn-warning'>"+"Fetch Data"+"</a>" ;
                                     var result_body2 ="<tr style='background-color:#69D2E7;'>"+
                                                              "<td style='padding-left:100px;' id='updateSerial0'>"+'3'+"</td>"+"<td>"+response[3][2]['id']+"</td>"+"<td >"+response[3][2]['visit_date']+"</td>"+
                                                              "<td >"+response[3][2]['RPR Qualitative']+"</td>"+"<td>"+but_ton2+"</td>"+
                                                      "</tr>";
                                     $("#rprHistory").append(result_body2);
                                   }
                                   if(r3 == 4){
                                     var but_ton0 = "<a  data-toggle='tab' href='#hiv'  onclick='rpr_row0()' class='nav-link btn btn-warning'>"+"Fetch Data"+"</a>" ;
                                     var result_body0 ="<tr style='background-color:#69D2E7;'>"+
                                                              "<td style='padding-left:100px;' id='updateSerial0'>"+'1'+"</td>"+"<td>"+response[3][0]['id']+"</td>"+"<td >"+response[3][0]['visit_date']+"</td>"+
                                                              "<td >"+response[3][0]['RPR Qualitative']+"</td>"+"<td>"+but_ton0+"</td>"+
                                                      "</tr>";
                                     $("#rprHistory").append(result_body0);
                                     var but_ton1 = "<a  data-toggle='tab' href='#hiv'  onclick='rpr_row1()' class='nav-link btn btn-warning'>"+"Fetch Data"+"</a>" ;
                                     var result_body1 ="<tr style='background-color:#69D2E7;'>"+
                                                              "<td style='padding-left:100px;' id='updateSerial0'>"+'2'+"</td>"+"<td>"+response[3][1]['id']+"</td>"+"<td >"+response[3][1]['visit_date']+"</td>"+
                                                              "<td >"+response[3][1]['RPR Qualitative']+"</td>"+"<td>"+but_ton1+"</td>"+
                                                      "</tr>";
                                     $("#rprHistory").append(result_body1);
                                     var but_ton2 = "<a  data-toggle='tab' href='#hiv'  onclick='rpr_row2()' class='nav-link btn btn-warning'>"+"Fetch Data"+"</a>" ;
                                     var result_body2 ="<tr style='background-color:#69D2E7;'>"+
                                                              "<td style='padding-left:100px;' id='updateSerial0'>"+'3'+"</td>"+"<td>"+response[3][2]['id']+"</td>"+"<td >"+response[3][2]['visit_date']+"</td>"+
                                                              "<td >"+response[3][2]['RPR Qualitative']+"</td>"+"<td>"+but_ton2+"</td>"+
                                                      "</tr>";
                                     $("#rprHistory").append(result_body2);
                                     var but_ton3 = "<a  data-toggle='tab' href='#hiv'  onclick='rpr_row3()' class='nav-link btn btn-warning'>"+"Fetch Data"+"</a>" ;
                                     var result_body3 ="<tr style='background-color:#69D2E7;'>"+
                                                              "<td style='padding-left:100px;' id='updateSerial0'>"+'4'+"</td>"+"<td>"+response[3][3]['id']+"</td>"+"<td >"+response[3][3]['visit_date']+"</td>"+
                                                              "<td >"+response[3][3]['RPR Qualitative']+"</td>"+"<td>"+but_ton3+"</td>"+
                                                      "</tr>";
                                     $("#rprHistory").append(result_body3);
                                   }
                                 }
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
function rprFiller(signal_a){
    //console.log(resp[1].length);
    //console.log(document.getElementById("li1").innerHTML);
    var loonum = resp[1].length;
    for (var i = 0; i <loonum ; i++) {
      var liname = "li" + i;
      console.log(i);
      if(signal_a == 1){
        alert("i = 1");
      }
      if(signal_a == 2){
        alert("i = 1");
      }
      if( signal_a == resp[1][i]["visit_date"]){
        if(resp[1][i]["RPR Qualitative"]=="R"){
          //console.log(resp[1][i]["RPR Qualitative"]);
          //console.log(document.getElementById(liname).innerHTML);
          //console.log(liname);
          //console.log(resp[1][i]["visit_date"]);
          document.getElementById("latent_syphillis_yes").selected = true;
          alert("RPR Qualitative: React");
        }else{
          document.getElementById("latent_syphillis_no").selected = true;
          alert("RPR Qualitative: Non-React");
        }

      }else{
        console.log("You did not click 13;");
      }
    }
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
  let scoreAns = cal1+cal2+cal3+cal4+cal5+cal6;
  let riskCal = "";
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
function firstPage(){
  let gender =document.getElementById('genderbtn').value;
      if(gender == "NA"){
        for (var i = 0; i < 54; i++){
          document.getElementById(female[i]).style.display = "none";
        }
        //document.getElementById('Clotrimazole').style.display = "none";
        //  document.getElementById('no_treament').style.display = "none";
        for (var i = 0; i < 27; i++){
          document.getElementById(male[i]).style.display = "block";
        }
      }
      if(gender=="male"){
        for (var i = 0; i < 54; i++) {
          document.getElementById(female[i]).style.display = "none";
        }
      //  document.getElementById('Clotrimazole').style.display = "none";
      //  document.getElementById('no_treament').style.display = "none";
        for (var i = 0; i < 27; i++) {
          document.getElementById(male[i]).style.display = "block";
        }
      }
      if(gender=="female"){
        for (var i = 0; i < 54; i++) {
          document.getElementById(female[i]).style.display = "block";
        }
      //  document.getElementById('Clotrimazole').style.display = "block";
      //  document.getElementById('no_treament').style.display = "block";
        for (var i = 0; i < 27; i++) {
          document.getElementById(male[i]).style.display = "none";
        }
      }
}
function gender(){
  console.log("gender arrived");
  let gender =document.getElementById('genderbtn').value;
  if(gender=="NA"){
    document.getElementById('female_btn').disabled= true;
    firstPage();
  }
  if(gender=="male"){
      firstPage();
      document.getElementById('female_btn').disabled=true;
      document.getElementById('male_btn').disabled=false;
      console.log("male");
  }
  if(gender=="female"){
    firstPage();
    document.getElementById('female_btn').disabled=false;
    document.getElementById('male_btn').disabled=true;
    console.log("female");
  }
}
function sendDataMale(){
      let sti_male=1;
      //first page
      let pid = document.getElementById("pid").value;
      //let clinic = document.getElementById("clinic").innerHTML);
      let clinic = 71;
      let firstVisit = document.getElementById("firstVisit").value;
      let lastVisit = document.getElementById("lastVisit").value;
      let aboutclinic = document.getElementById('aboutclinic').value;
      let age = document.getElementById("age").value;
      let regdate = document.getElementById("regdate").value;
      console.log(regdate);
      let fuchia = document.getElementById("fuchia").value;
      let gender = document.getElementById("gender").value;
      let episode = document.getElementById("episode").value;
      let reason = document.getElementById("reason").value;
      let ptype = document.getElementById("ptype").value;
      let urethral_discharge = document.getElementById("urethral_discharge").value;
      let howlong_days = document.getElementById("howlong_days").value;
      let dysuria = document.getElementById("dysuria").value;
      let howlong_dysuria = document.getElementById("howlong_dysuria").value;
      let genital_prutitus = document.getElementById("genital_prutitus").value;
      let howlong_genital_pruti = document.getElementById("howlong_genital_pruti").value;
      let genital_burn = document.getElementById("genital_burn").value;
      let howlong_genital_burn = document.getElementById("howlong_genital_burn").value;
      let genital_ulcer = document.getElementById("genital_ulcer").value;
      let howlong_genital_ulcer = document.getElementById("howlong_genital_ulcer").value;
      let pain = document.getElementById("pain").value;
      let ulcer = document.getElementById("ulcer").value;
      let prodormal_itch = document.getElementById("prodormal_itch").value;
      let start_vesicles = document.getElementById("start_vesicles").value;
      let recurrent = document.getElementById("recurrent").value;
      let last_episode = document.getElementById("last_episode").value;
      let patient_suspect_herpes = document.getElementById("patient_suspect_herpes").value;
      let inguinal_lymph_node = document.getElementById("inguinal_lymph_node").value;
      let hl_inguinal_lymph_node = document.getElementById("hl_inguinal_lymph_node").value;
      let unilateal = document.getElementById("unilateal").value;
      let leg_ulcer_inf = document.getElementById("leg_ulcer_inf").value;
      let scrotal_swelling = document.getElementById("scrotal_swelling").value;
      let hl_scrotal_swelling = document.getElementById("hl_scrotal_swelling").value;
      let tender = document.getElementById("tender").value;
      let genital_wart = document.getElementById("genital_wart").value;
      let hl_genital_wart = document.getElementById("hl_genital_wart").value;
      //first end
      //second page
      let   physical_exam = document.getElementById("physical_exam").value;
      let   urinated_within1hr = document.getElementById("urinated_within1hr").value;
      let   discharge = document.getElementById("discharge").value;
      let   discharge_after_milking = document.getElementById("discharge_after_milking").value;
      let   colour = document.getElementById("colour").value;
      let   phi_erythema = document.getElementById("phi_erythema").value;
      let   phi_blister_penis = document.getElementById("phi_blister_penis").value;
      let   phi_genital_ulcer = document.getElementById("phi_genital_ulcer").value;
      let   phi_estimated_size = document.getElementById("phi_estimated_size").value;
      let   phi_single_multiple = document.getElementById("phi_single_multiple").value;
      let   phi_painfull = document.getElementById("phi_painfull").value;
      let   phi_herpes_suspected = document.getElementById("phi_herpes_suspected").value;
      let   phi_inguinal_bubo = document.getElementById("phi_inguinal_bubo").value;
      let   phi_fluctant = document.getElementById("phi_fluctant").value;
      let   phi_tender = document.getElementById("phi_tender").value;
      let   phi_leg_inf = document.getElementById("phi_leg_inf").value;
      let   phi_genital_wart = document.getElementById("phi_genital_wart").value;
      let   phi_crab_lice = document.getElementById("phi_crab_lice").value;
      let   phi_scabies = document.getElementById("phi_scabies").value;
      let   phi_scrotal_swelling = document.getElementById("phi_scrotal_swelling").value;
      let   phi_esti_size = document.getElementById("phi_esti_size").value;
      let   phi_unilateal = document.getElementById("phi_unilateal").value;
      let   phi_tender_non = document.getElementById("phi_tender_non").value;
      let   phi_erythema1 = document.getElementById("phi_erythema1").value;
      let   phi_drawing = document.getElementById("phi_drawing").value;
      //female
      //second page end
      //third page
      let   pt_1st_visit = document.getElementById("pt_1st_visit").value;
      let   pt_epi_dis_lastvisit = document.getElementById("pt_epi_dis_lastvisit").value;
      let   unprotected_sex = document.getElementById("unprotected_sex").value;
      let   genital_sign = document.getElementById("genital_sign").value;
      let   presumptive_diag = document.getElementById("presumptive_diag").value;
      let   primary_syphillis = document.getElementById("primary_syphillis").value;
      let   gonorrhoea = document.getElementById("gonorrhoea").value;
      let   congenial_syphillis = document.getElementById("congenial_syphillis").value;
      let   secondary_syphillis = document.getElementById("secondary_syphillis").value;
      let   non_gono_urethri = document.getElementById("non_gono_urethri").value;
      let   latent_syphillis = document.getElementById("latent_syphillis").value;
      let   chancroid = document.getElementById("chancroid").value;
      let   non_gono_procti = document.getElementById("non_gono_procti").value;
      let   molluscum_contagiosum = document.getElementById("molluscum_contagiosum").value;
      let   genital_herpes3 = document.getElementById("genital_herpes3").value;
      let   trichomonas = document.getElementById("trichomonas").value;
      let   bubos = document.getElementById("bubos").value;
      let   genital_scabies3 = document.getElementById("genital_scabies3").value;
      let   genital_candidiosis = document.getElementById("genital_candidiosis").value;
      let   genital_warts3 = document.getElementById("genital_warts3").value;
      let   others3 = document.getElementById("others3").value;
      let   baterial_vaginosis = document.getElementById("baterial_vaginosis").value;
      let   others33 = document.getElementById("others33").value;
      let   tre_azythro = document.getElementById("tre_azythro").checked;
            if(tre_azythro==true){
              tre_azythro=1;
            }else{tre_azythro=0;}
      let   tre_cefixim = document.getElementById("tre_cefixim").checked;
            if(tre_cefixim==true){
              tre_cefixim=1;
            }else{tre_cefixim=0;}
      let   tre_ciprofloxacin = document.getElementById("tre_ciprofloxacin").checked;
            if(tre_ciprofloxacin==true){
              tre_ciprofloxacin=1;
            }else{tre_ciprofloxacin=0;}
      let   tre_tinidazole = document.getElementById("tre_tinidazole").checked;
            if(tre_tinidazole==true){
              tre_tinidazole=1;
            }else{tre_tinidazole=0;}
      let   tre_fluconazole = document.getElementById("tre_fluconazole").checked;
            if(tre_fluconazole==true){
              tre_fluconazole=1;
            }else{tre_fluconazole=0;}
      let   tre_doxycycline = document.getElementById("tre_doxycycline").checked;
            if(tre_doxycycline==true){
              tre_doxycycline=1;
            }else{tre_doxycycline=0;}
      let   tre_ceftriaxone = document.getElementById("tre_ceftriaxone").checked;
            if(tre_ceftriaxone==true){
              tre_ceftriaxone=1;
            }else{tre_ceftriaxone=0;}
      let   tre_benzpen = document.getElementById("tre_benzpen").checked;
            if(tre_benzpen==true){
              tre_benzpen=1;
            }else{tre_benzpen=0;}
      let   no_treament1 = document.getElementById("no_treament1").checked;
            if(no_treament1==true){
              no_treament1=1;
            }else{no_treament1=0;}
      let   allergy = document.getElementById("allergy").value;
      let   sulfa = document.getElementById("sulfa").value;
      let   parter_treatment_given = document.getElementById("parter_treatment_given").value;
      let   condom=document.getElementById("condom").value;
      let   remarkTreatment = document.getElementById("remarkTreatment").value;
      let   follwupText = document.getElementById("follwupText").value;
      let   clinicainName = document.getElementById("clinicainName").value;


      $.ajaxSetup({
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });

        $.ajax({
        type:'POST',
        url:"{{route('stiData')}}",
        data:{
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
           clinicainName:clinicainName
          },
         success:function(response){
              // console.log(alert("The patient's data has been saved.Thank you."));
              //
                //if (response) {
                //  $('#success-message').text(response.success);
                //$('#registerForm').reload();// to reset form register
              //  }
              alert("We collected the data.");
              console.log(response);
              location.reload(true);
              }
            });

}
function sendDataFemale(){
      let sti_female=1;
      //first page
      let fe_pid = document.getElementById("pid").value;
      let fe_clinic = document.getElementById("clinic").innerHTML;
      let fe_firstVisit = document.getElementById("firstVisit").value;
      let fe_lastVisit = document.getElementById("lastVisit").value;
      let fe_aboutclinic = document.getElementById('aboutclinic').value;
      let fe_age = document.getElementById("age").value;
      let fe_regdate = document.getElementById("regdate").value;
      console.log(fe_regdate);
      let fe_fuchia = document.getElementById("fuchia").value;
      let fe_gender = document.getElementById("gender").value;
      let fe_episode = document.getElementById("episode").value;
      let fe_reason = document.getElementById("reason").value;
      let fe_ptype = document.getElementById("fe_ptype").value;
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
      let fe_genital_location = document.getElementById('genital_location').value;
      let fe_genital_ulcer =document.getElementById("phi_genital_ulcer").value;
      let fe_genital_ulc_location = document.getElementById('genital_ulc_location').value;
      let fe_tender = document.getElementById("tender").value;

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
      let cal1 = Number(document.getElementById('cal1').value);
      let cal2 = Number(document.getElementById('cal2').value);
      let cal3 = Number(document.getElementById('cal3').value);
      let cal4 = Number(document.getElementById('cal4').value);
      let cal5 = Number(document.getElementById('cal5').value);
      let cal6 = Number(document.getElementById('cal6').value);
      scoreAns= cal1+cal2+cal3+cal4+cal5+cal6;
      if(scoreAns<3){
        riskCal ="Low Risk";
      }
      if(scoreAns > 2){
        riskCal ="High Risk";
      }
      let   riskRemark = document.getElementById('riskRemark').value;
      let   fe_primary_syphillis = document.getElementById("primary_syphillis").value;
      let   fe_presumptive_diag = document.getElementById("presumptive_diag").value;
      let   fe_gonorrhoea = document.getElementById("gonorrhoea").value;
      let   fe_congenial_syphillis = document.getElementById("congenial_syphillis").value;
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
                fe_tre_azythro=1;
            }else{fe_tre_azythro=0;}
      let   fe_tre_cefixim = document.getElementById("tre_cefixim").checked;
            if(fe_tre_cefixim==true){
              fe_tre_cefixim=1;
            }else{fe_tre_azythro=0;}
      let   fe_tre_ciprofloxacin = document.getElementById("tre_ciprofloxacin").checked;
            if(fe_tre_ciprofloxacin==true){
              fe_tre_ciprofloxacin=1;
            }else{fe_tre_ciprofloxacin=0;}
      let   fe_tre_tinidazole = document.getElementById("tre_tinidazole").checked;
            if(fe_tre_tinidazole==true){
              fe_tre_tinidazole=1;
            }else{fe_tre_tinidazole=0;}
      let   fe_tre_fluconazole = document.getElementById("tre_fluconazole").checked;
            if(fe_tre_fluconazole==true){
              fe_tre_fluconazole=1;
            }else{fe_tre_fluconazole=0;}
      let   fe_tre_doxycycline = document.getElementById("tre_doxycycline").checked;
            if(fe_tre_doxycycline==true){
              fe_tre_doxycycline=1;
            }else{fe_tre_doxycycline=0;}
      let   fe_tre_ceftriaxone = document.getElementById("tre_ceftriaxone").checked;
            if(fe_tre_ceftriaxone==true){
              fe_tre_ceftriaxone=1;
            }else{fe_tre_azythro=0;}
      let   fe_tre_benzpen = document.getElementById("tre_benzpen").checked;
            if(fe_tre_benzpen==true){
              fe_tre_benzpen=1;
            }else{fe_tre_benzpen=0;}
      let   fe_clotrimazole = document.getElementById('clotrimazole').checked;
            if(fe_clotrimazole==true){
              fe_clotrimazole=1;
            }else{fe_clotrimazole=0;}
      let   fe_no_treament = document.getElementById("no_treament").checked;
            if(fe_no_treament==true){
              fe_no_treament=1;
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
      //143
      $.ajaxSetup({
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });

        $.ajax({
        type:'POST',
        url:"{{route('stiData')}}",
        data:{
          //first page
           sti_female:sti_female,
           fe_pid:fe_pid,
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
           fe_genital_ulcer:fe_genital_ulcer,
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
           fe_genital_location:fe_genital_location,
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
              location.reload(true);
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
  if(ckcolour == "other"){
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

function sti_row(){StiFiller(resp,rowNo=0);}
function sti_row_1(){StiFiller(resp,rowNo=1);}
function sti_row_2(){StiFiller(resp,rowNo=2);}

function rpr_row0(){RprFiller(resp,rowNo=0);}
function rpr_row1(){RprFiller(resp,rowN0=1);}
function rpr_row2(){RprFiller(resp,rowNo=2);}
function rpr_row3(){RprFiller(resp,rowNo=3);}

function StiFiller(resp,rowNo){
  //$("#hivUpdate").empty();
  //$("#hider0").show();
  //$("#hider1").show();
  //update_rowNo = resp[0][rowNo]["id"];
  save_update=1;

  document.getElementById('fuchiaID').value= resp[0][rowNo]["fuchiacode"];
  document.getElementById('cid').value= resp[0][rowNo]["CID"];

}
function RprFiller(resp,rowNo){
   var RPR_result = resp[3][rowNo]["RPR Qualitative"];
   if(RPR_result == 'R'){
     document.getElementById('latent_syphillis').style.color='red';
     document.getElementById('latent_syphillis').value=1;
   }else{
     document.getElementById('latent_syphillis').value=0;
     document.getElementById('latent_syphillis').style.color='green';
   }

}
</script>

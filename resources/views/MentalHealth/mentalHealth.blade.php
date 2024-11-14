@extends('layouts.app')
@section('content')
@auth
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('js/MentalHealth/mental.js') }}"></script>
<div class="container containers">
  <ul class="nav nav-tabs toggle  ncd-list"
    id="hidden-title">
    <li class="nav-item">
      <a class="nav-link active toggle-link "
        data-toggle="tab"
        href="#mentalHalth">MentalHealth</a>
    </li>
    <li class="nav-item">
      <a class="nav-link toggle-link "
        data-toggle="tab"
        href="#mentalHealthExport">Mental Export</a>
    </li>
  </ul>
  <section class="tab-content page-color">
    <div class="tab-pane active mental-block active" id="mentalHalth">
      <section id="patient_information">
        <h2 class="header-text" id="mental_head">Mental Health & sexualized drug use– Registration Form</h2>
        <button type="button" class="btn btn-info mental-followHistoy" id="metal_followBtn">Follow Up History</button>
        <button type="button" class="btn btn-warning mental-toFollow" id="metal_toFollowBtn">To Follow Up</button>
        <button type="button" class="btn btn-warning mental-toRegister" id="metal_toRegisterBtn">To Register</button>
      </section>
      <section class="mental-register" id="mental_register">
        <section id="patientIdentifine">
          <div class="subTb-header">
            <h3>Patient Identificationn</h3>
          </div>
          <div class="row">
            <div class="col-sm-2">
              <label for="" class="form-label">Reg Date</label>
              <div class="date-holder input-group-append no-margin">
                <input type="text" id="mentalRegDate" name="mentalRegDate" class="form-control Gdate" placeholder="dd-mm-yyyy">
                <img src="../img/calendar3.svg" class="dateimg" alt="date">
              </div>
            </div>
            <div class="col-sm-3">
              <label for="validationCustom01" class="form-label">General ID</label>
              <div class="input-group">
                <input type="number" name="Pid" id="Pid" class="form-control input-group-append no-margin" placeholder="General ID">
                <div class="input-group-append no-margin">
                  <button class="btn btn-primary" onclick="findRegisterData()" type="button">Search</button>
                </div>
              </div>
              <!-- onclick="findRegisterData()" -->
            </div>
            <div class="col-sm-2">
              <label for="" class='form-label'>Fuchia ID</label>
              <span class="form-control" name="fuchia"></span>
            </div>
            <div class="col-sm-2">
              <label for="" class='form-label'>PrEP ID</label>
              <span class="form-control" name="prep"></span>
            </div>
            <div class="col-sm-1">
              <label for="" class='form-label'>Cur_Age</label>
              <span class="form-control" name="curAge"></span>
            </div>
            <div class="col-sm-2">
              <label for="" class='form-label'>Sex</label>
              <span class="form-control" name="sex"></span>
            </div>
            <div class="col-sm-2">
              <label for="" class='form-label'>HIV Status</label>
              <select name="mentalHIV" id="mental_hiv" class="form-control" disabled>
                <option value="">Unknown</option>
                <option value="Positive">Positive</option>
                <option value="Negative">Negative</option>
                <option value="Inconclusive">Inconclusive</option>
              </select>
            </div>
            <div class="col-sm-2">
              <label for="" class='form-label'>Main Risk</label>
              <select name="mainRisk" id="mental_mrisk" class="mental-mrisk form-select" disabled></select>
            </div>
            <div class="col-sm-2">
              <label for="" class='form-label'>Sub Risk</label>
              <select name="subRisk" id="mental_srisk" class="mental-srisk form-select" disabled></select>
            </div>
            <div class="col-sm-2">
              <label for="" class="form-label">if “PWID”</label>
              <select name="ifPWID" id="ifPWID" class="form-select" disabled>
                <option value=""></option>
                <option value="Active">Active</option>
                <option value="Ex">Ex</option>
              </select>
            </div>
            <div class="col-sm-2">
              <label for="" class="form-label">if “Ex”</label>
              <select name="ifEx" id="ifEx" class="form-select" disabled>
                <option value=""></option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
              </select>
            </div>
            <div class="col-sm-2">
              <label for="" class="form-label">Alcohol drinking</label>
              <select name="alcoholDrink" id="alcohol_drink" class="form-select">
                <option value=""></option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
                <option value="Ex-drinker">Ex-drinker</option>
              </select>
            </div>

          </div>

        </section>

        <section id="assessment">
          <div class="subTb-header">
            <h3>Assessments</h3>
          </div>
          <div class="row">
            <div class="col-sm-2">
              <label for="" class="form-label">PHQ4(Q1/Q2)</label>
              <input type="number" name="phq4Q1Q2" id="phq4Q1Q2Register" class="form-control">
            </div>
            <div class="col-sm-2">
              <label for="" class="form-label">PHQ4(Q3/Q4)</label>
              <input type="number" name="phq4Q3Q4" id="phq4Q3Q4Register" class="form-control">
            </div>
            <div class="col-sm-2">
              <label for="" class="form-label">GAD7</label>
              <input type="number" name="gad7Score" id="gad7ScoreRegister" class="form-control">
            </div>
            <div class="col-sm-2">
              <label for="" class="form-label">PHQ9</label>
              <input type="number" name="phq9Score" id="phq9ScoreRegister" class="form-control">
            </div>
          </div>

        </section>

        <section id="Psychosis">
          <div class="subTb-header">
            <h3>Psychosis</h3>
          </div>
          <div class="row">
            <div class="col-sm-2">
              <label for="" class="form-label">Psychosis</label>
              <select name="psychosis" id="psychosis" class="form-select">
                <option value=""></option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
              </select>
            </div>
            <div class="col-sm-2">
              <label for="" class="form-label">Symptoms</label>
              <select name="symptoms" id="symptoms" class="form-select">
                <option value=""></option>
                <option value="Delusion">Delusion</option>
                <option value="Illusion">Illusion</option>
                <option value="Hallucination">Hallucination</option>
              </select>
            </div>
            <div class="col-sm-6">
              <label for="" class="form-label">Others</label>
              <input type="text" name="others" id="others" class="form-control">
            </div>
            <div class="col-sm-2">
              <label for="" class="form-label">Duration</label>
              <select name="duration" id="duration" class="form-control">
                <option value=""></option>
                <option value="< 1 month">
                  < 1 month</option>
                <option value="1–6 months">1–6 months</option>
                <option value=">6 months">>6months</option>
              </select>
            </div>
          </div>

        </section>

        <section id="sucidal">
          <div class="subTb-header">
            <h3>Suicidal Risk (Attempt or Thought)</h3>
          </div>
          <div class="row">
            <div class="col-sm-4">
              <label for="" class="form-label">Suicidal Risk (Attempt or Thought)</label>
              <select name="sucidalRisk" id="sucidalRisk" class="form-select">
                <option value=""></option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
              </select>
            </div>
            <div class="col-sm-2">
              <label for="" class="form-label">if yes,</label>
              <select name="sucidalTime" id="sucidalTime" class="form-select" disabled>
                <option value=""></option>
                <option value="Within last 6 months">Within last 6 months</option>
                <option value="Beyond last 6 months">Beyond last 6 months</option>
              </select>
            </div>
            <div class="col-sm-4">
              <label for="" class="form-label">1. Drug uses within 3 months (any type)</label>
              <select name="drugUse" id="drugUse" class="form-control">
                <option value=""></option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
              </select>
            </div>
            <div class="col-sm-2">
              <label for="" class="form-label">willingness change</label>
              <select name="drugWillness" id="drugWillness" class="form-select" disabled>
                <option value=""></option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
              </select>
            </div>
            <div class="col-sm-4">
              <label for="" class="form-label">2.Sexual activities under the drug effect</label>
              <select name="drugSexUse" id="drugSexUse" class="form-control">
                <option value=""></option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
              </select>
            </div>
            <div class="col-sm-2">
              <label for="" class="form-label">willingness change</label>
              <select name="drugSexWillness" id="drugSexWillness" class="form-select" disabled>
                <option value=""></option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
              </select>
            </div>
            <div class="col-sm-4">
              <label for="" class="form-label">3. Injectable Drug Use</label>
              <select name="injectDrugUse" id="injectDrugUse" class="form-control">
                <option value=""></option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
              </select>
            </div>
            <div class="col-sm-2">
              <label for="" class="form-label">Timeframe</label>
              <select name="injectDrugYes" id="injectDrugYes" class="form-select" disabled>
                <option value=""></option>
                <option value="Within last 3 months">Within last 3 months</option>
                <option value="Beyond last 3 months">Beyond last 3 months</option>
              </select>
            </div>
          </div>

        </section>

        <section id="assistScoreSection">
          <div class="subTb-header">
            <h3>ASSIST Score (Screenning)</h3>
          </div>
          <div class="row">
            <div class="col-sm-4">
              <label class="form-label" for="">ASSIST Score (Screenning)</label>
              <select name="assistScore" id="assistScore" class="form-select">
                <option value=""></option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
              </select>
            </div>
            <div class="col-sm-4">
              <label for="validationCustom01" class="form-label">Name of Drug</label>
              <div class="input-group mb-4">
                <input type="text" name="drugname-1" id="drugname_1" class="form-control input-group-append no-margin" placeholder="Name Drug">

                <select name="drug-1-Risk" id="drug1_Risk" class="form-select">
                  <option value=""></option>
                  <option value="0-3 (Low risk)">0-3 (Low risk)</option>
                  <option value="4-26 (Moderate risk)">4-26 (Moderate risk)</option>
                  <option value=">27 (High risk)">>27 (High risk)</option>
                </select>


              </div>
              <!-- onclick="findRegisterData()" -->
            </div>
            <div class="col-sm-4">
              <label for="validationCustom01" class="form-label">Name of Drug</label>
              <div class="input-group mb-4">
                <input type="text" name="drugname-2" id="drugname_2" class="form-control input-group-append no-margin" placeholder="Name Drug">
                <select name="drug-2-Risk" id="drug2_Risk" class="form-select">
                  <option value=""></option>
                  <option value="0-3 (Low risk)">0-3 (Low risk)</option>
                  <option value="4-26 (Moderate risk)">4-26 (Moderate risk)</option>
                  <option value=">27 (High risk)">>27 (High risk)</option>
                </select>
              </div>
            </div>
            <div class="col-sm-4">
              <label for="validationCustom01" class="form-label">Name of Drug</label>
              <div class="input-group mb-4">
                <input type="text" name="drugname-3" id="drugname_3" class="form-control input-group-append no-margin" placeholder="Name Drug">
                <select name="drug-3-Risk" id="drug3_Risk" class="form-select">
                  <option value=""></option>
                  <option value="0-3 (Low risk)">0-3 (Low risk)</option>
                  <option value="4-26 (Moderate risk)">4-26 (Moderate risk)</option>
                  <option value=">27 (High risk)">>27 (High risk)</option>
                </select>
              </div>
            </div>
            <div class="col-sm-4">
              <label for="validationCustom01" class="form-label">Name of Drug</label>
              <div class="input-group mb-4">
                <input type="text" name="drugname-4" id="drugname_4" class="form-control input-group-append no-margin" placeholder="Name Drug">
                <select name="drug-4-Risk" id="drug4_Risk" class="form-select">
                  <option value=""></option>
                  <option value="0-3 (Low risk)">0-3 (Low risk)</option>
                  <option value="4-26 (Moderate risk)">4-26 (Moderate risk)</option>
                  <option value=">27 (High risk)">>27 (High risk)</option>
                </select>
              </div>
            </div>
            <div class="col-sm-4">
              <label for="validationCustom01" class="form-label">Name of Drug</label>
              <div class="input-group mb-4">
                <input type="text" name="drugname-5" id="drugname_5" class="form-control input-group-append no-margin" placeholder="Name Drug">
                <select name="drug-5-Risk" id="drug5_Risk" class="form-select">
                  <option value=""></option>
                  <option value="0-3 (Low risk)">0-3 (Low risk)</option>
                  <option value="4-26 (Moderate risk)">4-26 (Moderate risk)</option>
                  <option value=">27 (High risk)">>27 (High risk)</option>
                </select>
              </div>
            </div>

          </div>
        </section>

        <section id="brief">
          <div class="subTb-header">
            <h3>Brief Intervention (BI)</h3>
          </div>
          <div class="row">
            <div class="col-sm-3">
              <label for="" class="form-label">Brief Intervention (BI)</label>
              <select name="bi" id="bi" class="form-select">
                <option value=""></option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
              </select>
            </div>
            <div class="col-sm-3">
              <label for="" class="form-label">If yes, BI, planned goal:</label>
              <select name="planGo" id="planGo" class="form-select" disabled>
                <option value=""></option>
                <option value="Sexualized drug use behavior">Sexualized drug use behavior</option>
                <option value="Drug use">Drug use</option>

              </select>
            </div>
            <div class="col-sm-6">
              <label for="" class="form-label">Please describe details of planned goal:</label>
              <input type="text" name="planDescribe" id="planDescribe" class="form-control" disabled>
            </div>
            <div class="col-sm-6">
              <label for="" class="form-label">Stage of Brief Intervention (BI)</label>
              <select name="stageBi" id="stageBi" class="form-select">
                <option value=""></option>
                <option value="D1">D1</option>
                <option value="D2">D2</option>
                <option value="D3">D3</option>
                <option value="D4">D4</option>
              </select>
            </div>
            <div class="col-sm-6">
              <label for="" class="form-label">If no BI, why?</label>
              <select name="noBi" id="noBi" class="form-select" disabled>
                <option value=""></option>
                <option value="No screnning yet with ASSIST">No screnning yet with ASSIST</option>
                <option value="Plan on the next time">Plan on the next time</option>
                <option value="Still on the prcess of enhanced motivation">Still on the prcess of enhanced motivation</option>
                <option value="No willingness to change">No willingness to change</option>
              </select>
            </div>

          </div>
        </section>

        <section id="mentalTreatment">
          <div class="subTb-header">
            <h3>Treatment (Please tick to all applies)</h3>
          </div>
          <div class="row">
            <div class="form-check-inline col-sm-6">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" id="psyMAM" value="" name="psyMAM"> Psychosocial intervention at MAM
              </label>
            </div>
            <div class="form-check-inline col-sm-6">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" id="phamacoMAM" value="" name="phamacoMAM"> Pharmacological management at MAM
              </label>
            </div>
            <div class="col-sm-4">
              <label for="" class="form-label">Fluoxetine</label>
              <select name="fluoxetine" id="fluoxetine" class="form-select" disabled>
                <option value=""></option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
              </select>
            </div>
            <div class="col-sm-4">
              <label for="" class="form-label">Haloparidol</label>
              <!-- <input type="text" name="haloparidol" id="haloparidol" class="form-control" disabled> -->
              <select name="haloparidol" id="haloparidol" class="form-select" disabled>
                <option value=""></option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
              </select>
            </div>
            <div class="col-sm-4">
              <label for="" class="form-label">other</label>
              <input type="text" name="treatmentOther" id="treatmentOther" class="form-control" disabled>
            </div>
            <div class="col-sm-3">
              <label class="form-label"> Refer to psychiatrist</label>
              <select name="referPsychiatrist" id="referPsychiatrist" class="form-control">
                <option value=""></option>
                <option value="Mental hospital">Mental hospital</option>
                <option value="General hospital">General hospital</option>
                <option value="Private psychiatrist">Private psychiatrist</option>
              </select>
            </div>
            <div class="col-sm-3">
              <label for="" class="form-label">MD’s Initial</label>
              <input type="text" name="mdInit" id="mdInit" class="form-control">
            </div>
            <div class="col-sm-3">
              <label for="" class="form-label">CSL’s Initial</label>
              <input type="text" name="cslInit" id="cslInit" class="form-control">
            </div>
            <div class="col-sm-3">
              <label for="" class="form-label">Next Follow up date</label>
              <div class="date-holder">
                <input type="text" id="nextFollowDate" name="nextFollowDate" class="form-control Gdate" placeholder="dd-mm-yyyy">
                <img src="../img/calendar3.svg" class="dateimg" alt="date">
              </div>

            </div>
          </div>
        </section>

        <section>
          <div class="row" style="justify-content: center;">
            <div class="col-sm-3">
              <button type="button" class="btn btn-info" value="saveMental" id="saveUPdate" onclick="SaveUpdateMentalHealth(this)" disabled>Save Mental Register</button>
            </div>
          </div>
        </section>

      </section>
      <section id="mental_follow" class="mental-follow">
        <section>
          <div class="subTb-header">
            <h3>Patient Identificationn</h3>
          </div>
          <div class="row">
            <div class="col-sm-2">
              <label for="" class="form-label">General ID</label>
              <span class="form-control" name="Pid" id="PidFollow"></span>
            </div>
            <div class="col-sm-2">
              <label for="" class="form-label">Fuchia ID</label>
              <span class="form-control" name="fuchia" id="Fuchia"></span>
            </div>
            <div class="col-sm-2">
              <label for="" class="form-label">PrEP ID</label>
              <span class="form-control" name="prep" id="Prep"></span>
            </div>
            <div class="col-sm-2">
              <label for="" class="form-label">Visit Date</label>
              <div class="date-holder">
                <input type="text" id="mentalVisitDate" name="mentalVisitDate" class="form-control Gdate" placeholder="dd-mm-yyyy">
                <img src="../img/calendar3.svg" class="dateimg" alt="date">
              </div>
            </div>
            <div class="col-sm-2"><button class="btn btn-info" onclick=" getFollowMark()" style="margin-top:35px">search</button></div>
          </div>
        </section>
        <!-- Patient Identificationn -->

        <section>
          <div class="subTb-header">
            <h3>Assessments</h3>
          </div>
          <div class="row">
            <div class="col-sm-4">
              <label for="" class="form-label">Improvement of symptoms (any):</label>
              <select name="impSymptoms" id="impSymptomsFollow" class="form-select">
                <option value=""></option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
              </select>
            </div>
            <div class="col-sm-4">
              <label for="" class="form-label">Adherence problem</label>
              <select name="Adherence_problem" id="Adherence_problemFollow" class="form-select">
                <option value=""></option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
                <option value="NA">NA</option>
              </select>
            </div>
            <div class="col-sm-4">
              <label for="" class="form-label">Mental Health assessment rescreening</label>
              <select name="mental_rescreen" id="mental_rescreenFollow" class="form-select">
                <option value=""></option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
                <option value="NA">NA</option>
              </select>
            </div>
            <div class="col-sm-2">
              <label for="" class="form-label">PHQ4(Q1/Q2)</label>
              <input type="number" name="phq4Q1Q2" id="phq4Q1Q2Follow" class="form-control">
            </div>
            <div class="col-sm-2">
              <label for="" class="form-label">PHQ4(Q3/Q4)</label>
              <input type="number" name="phq4Q3Q4" id="phq4Q3Q4Follow" class="form-control">
            </div>
            <div class="col-sm-2">
              <label for="" class="form-label">GAD7</label>
              <input type="number" name="gad7Score" id="gad7ScoreFollow" class="form-control">
            </div>
            <div class="col-sm-2">
              <label for="" class="form-label">PHQ9</label>
              <input type="number" name="phq9Score" id="phq9ScoreFollow" class="form-control">
            </div>
            <div class="col-sm-12">
              <label for="" class="form-label">If No, please describe the reason:</label>
              <input type="text" name="noRescreen" id="noRescreen" class="form-control">
            </div>


          </div>
        </section>
        <!-- Assessments -->

        <section>
          <div class="subTb-header">
            <h3>ASSIST Score (Rescreenning)</h3>
          </div>
          <div class="row">
            <div class="col-sm-3">
              <label class="form-label" for="">Drug use reassessment:</label>
              <select name="drugUseReassement" id="drugUseReassement" class="form-select">
                <option value=""></option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
              </select>
            </div>
            <div class="col-sm-3">
              <label class="form-label" for="">ASSIST Score (Screenning)</label>
              <select name="assistScore" id="assistScoreFollow" class="form-select" disabled>
                <option value=""></option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
              </select>
            </div>
            <div class="col-sm-2">
              <label for="" class="form-label">Drug 1</label>
              <input type="text" class="form-control" name="followDrug_1" id="followDrug_1">
            </div>
            <div class="col-sm-4">
              <label for="validationCustom01" class="form-label">Score-1 && Risk</label>
              <div class="input-group mb-4">
                <select id="drugScore-1" name="drugScore-1" onchange="calucuteRisk(this)" class="form-control input-group-append no-margin" disabled>
                  <option value=""></option>
                  <option value="0-3">0-3</option>
                  <option value="4-26">4-26</option>
                  <option value=">27">&gt;27</option>
                </select>
                <select name="drugScore-1-Risk" id="drugScore-1-Risk" class="form-select" disabled>
                  <option value=""></option>
                  <option value="Low risk">Low risk</option>
                  <option value="Moderate risk">Moderate risk</option>
                  <option value="High risk">High risk</option>
                </select>


              </div>
              <!-- onclick="findRegisterData()" -->
            </div>
            <div class="col-sm-2">
              <label for="" class="form-label">Drug 3</label>
              <input type="text" class="form-control" name="followDrug_2" id="followDrug_2">
            </div>
            <div class="col-sm-4">
              <label for="validationCustom01" class="form-label">Score-2 && Risk</label>
              <div class="input-group mb-4">
                <select name="drugScore-2" id="drugScore-2" onchange="calucuteRisk(this)" class="form-select input-group-append no-margin" disabled>
                  <option value=""></option>
                  <option value="0-3">0-3</option>
                  <option value="4-26">4-26</option>
                  <option value=">27">&gt;27</option>
                </select>
                <select name="drugScore-2-Risk" id="drugScore-2-Risk" class="form-select" disabled>
                  <option value=""></option>
                  <option value="Low risk">Low risk</option>
                  <option value="Moderate risk">Moderate risk</option>
                  <option value="High risk">High risk</option>
                </select>

              </div>
            </div>
            <div class="col-sm-2">
              <label for="" class="form-label">Drug 3</label>
              <input type="text" class="form-control" name="followDrug_3" id="followDrug_3">
            </div>
            <div class="col-sm-4">
              <label for="validationCustom01" class="form-label">Score-3 && Risk</label>
              <div class="input-group mb-4">
                <select name="drugScore-3" id="drugScore-3" onchange="calucuteRisk(this)" class="form-select  input-group-append no-margin" disabled>
                  <option value=""></option>
                  <option value="0-3">0-3</option>
                  <option value="4-26">4-26</option>
                  <option value=">27">&gt;27</option>
                </select>
                <select name="drugScore-3-Risk" id="drugScore-3-Risk" class="form-select" disabled>
                  <option value=""></option>
                  <option value="Low risk">Low risk</option>
                  <option value="Moderate risk">Moderate risk</option>
                  <option value="High risk">High risk</option>
                </select>
              </div>
            </div>
            <div class="col-sm-2">
              <label for="" class="form-label">Drug 4</label>
              <input type="text" class="form-control" name="followDrug_4" id="followDrug_4">
            </div>
            <div class="col-sm-4">
              <label for="validationCustom01" class="form-label">Score-4 && Risk</label>
              <div class="input-group mb-4">
                <select name="drugScore-4" id="drugScore-4" onchange="calucuteRisk(this)" class="form-select input-group-append no-margin" disabled>
                  <option value=""></option>
                  <option value="0-3">0-3</option>
                  <option value="4-26">4-26</option>
                  <option value=">27">&gt;27</option>
                </select>
                <select name="drugScore-4-Risk" id="drugScore-4-Risk" class="form-select" disabled>
                  <option value=""></option>
                  <option value="Low risk">Low risk</option>
                  <option value="Moderate risk">Moderate risk</option>
                  <option value="High risk">High risk</option>
                </select>
              </div>
            </div>
            <div class="col-sm-2">
              <label for="" class="form-label">Drug 5</label>
              <input type="text" class="form-control" name="followDrug_5" id="followDrug_5">
            </div>
            <div class="col-sm-4">
              <label for="validationCustom01" class="form-label">Score-5 && Risk</label>
              <div class="input-group mb-4">
                <select name="drugScore-5" id="drugScore-5" onchange="calucuteRisk(this)" class="form-select input-group-append no-margin" disabled>
                  <option value=""></option>
                  <option value="0-3">0-3</option>
                  <option value="4-26">4-26</option>
                  <option value=">27">&gt;27</option>
                </select>
                <select name="drugScore-5-Risk" id="drugScore-5-Risk" class="form-select" disabled>
                  <option value=""></option>
                  <option value="Low risk">Low risk</option>
                  <option value="Moderate risk">Moderate risk</option>
                  <option value="High risk">High risk</option>
                </select>
              </div>
            </div>
            <div class="col-sm-2">
              <label for="" class="form-label">Drug 6</label>
              <input type="text" class="form-control" name="followDrug_6" id="followDrug_6">
            </div>
            <div class="col-sm-4">
              <label for="validationCustom01" class="form-label">Score-6 && Risk</label>
              <div class="input-group mb-4">
                <select name="drugScore-6" id="drugScore-6" onchange="calucuteRisk(this)" class="form-select input-group-append no-margin" disabled>
                  <option value=""></option>
                  <option value="0-3">0-3</option>
                  <option value="4-26">4-26</option>
                  <option value=">27">&gt;27</option>
                </select>
                <select name="drugScore-6-Risk" id="drugScore-6-Risk" class="form-select" disabled>
                  <option value=""></option>
                  <option value="Low risk">Low risk</option>
                  <option value="Moderate risk">Moderate risk</option>
                  <option value="High risk">High risk</option>
                </select>
              </div>
            </div>



          </div>
        </section>
        <!-- ASSIST Score (Rescreenning) -->

        <section id="brief">
          <div class="subTb-header">
            <h3>Brief Intervention (BI)</h3>
          </div>
          <div class="row">
            <div class="col-sm-3">
              <label for="" class="form-label">Brief Intervention (BI)</label>
              <select name="bi" id="rebi" class="form-select">
                <option value=""></option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
                <option value="NA">NA</option>
              </select>
            </div>
            <div class="col-sm-3">
              <label for="" class="form-label">If yes, BI, planned goal:</label>
              <select name="planGo" id="rePlanGo" class="form-select" disabled="">
                <option value=""></option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>

              </select>
            </div>
            <div class="col-sm-6">
              <label for="" class="form-label">Please describe details of planned goal:</label>
              <input type="text" name="planDescribe" id="replanDescribe" class="form-control" disabled="">
            </div>
            <div class="col-sm-6">
              <label for="" class="form-label">If plan change,desribe detail</label>
              <input type="text" name="changePlanDescribe" id="changePlanDescribe" class="form-control">
            </div>
            <div class="col-sm-6">
              <label for="" class="form-label">Stage of Brief Intervention (BI)</label>
              <select name="stageBi" id="stageBiFollow" class="form-select">
                <option value=""></option>
                <option value="D1">D1</option>
                <option value="D2">D2</option>
                <option value="D3">D3</option>
                <option value="D4">D4</option>
              </select>
            </div>
            <div class="col-sm-12">
              <label for="" class="form-label">Suicidal Risk (Attempt or Thought) between the last visit and the current visit:</label>
              <select name="suicidalRiskBetween" id="suicidalRiskBetween" class="form-select">
                <option value=""></option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
              </select>
            </div>
          </div>
        </section>
        <!-- Brief Intervention (BI) -->

        <section>
          <div class="subTb-header">
            <h3>Pharmacological side effects</h3>
          </div>
          <div class="row">
            <div class="col-sm-4">
              <label for="" class="form-label">Pharmacological side effects:</label>
              <select name="pharmaSideEffect" id="pharmaSideEffect" class="form-select">
                <option value=""></option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
              </select>
            </div>
            <div class="col-sm-4">
              <label for="" class="form-label">Extrapyramidal side effect</label>
              <select name="extrapySideEffect" id="extrapySideEffect" class="form-select">
                <option value=""></option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
              </select>
            </div>
            <div class="col-sm-4">
              <label for="" class="form-label">Other side effec</label>
              <input type="text" name="otherSideEffect" id="otherSideEffect" class="form-control">
            </div>
          </div>
        </section>
        <!-- Pharmacological side effects -->

        <section>
          <div class="subTb-header">
            <h3>Management of side effects</h3>
          </div>
          <div class="row">
            <div class="col-sm-4">
              <label class="form-label">Management of side effects</label>
              <input type="text" name="manageSideEffect" id="manageSideEffect" class="form-control">
            </div>
            <div class="col-sm-3">
              <label class="form-label">Artane (Trihexyphenidyl)</label>
              <select name="artane" id="artaneFollow" class="form-select">
                <option value=""></option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
              </select>
            </div>
            <div class="col-sm-5">
              <label for="" class="form-label">Other management</label>
              <input type="text" name="otherManage" id="otherManage" class="form-control">
            </div>
          </div>
        </section>
        <!-- Management of side effects -->

        <section id="pharmaloTre">
          <div class="subTb-header">
            <h3>Pharmacological treatment</h3>
          </div>
          <div class="row">
            <div class="form-check-inline col-sm-4">
              <label class="form-check-label"><input type="checkbox" class="form-check-input" id="sameTre" value="" name="sameTre">Continue the same treatment</label>
            </div>
            <div class="col-sm-8"><input type="text" name="sameTreDosage" id="sameTreDosage" class="form-control" disabled></div>

            <div class="form-check-inline col-sm-4">
              <label class="form-check-label"><input type="checkbox" class="form-check-input" id="incDo" value="" name="incDo">Increased the dosage</label>
            </div>
            <div class="col-sm-8"><input type="text" name="incDoDosage" id="incDoDosage" class="form-control" disabled></div>

            <div class="form-check-inline col-sm-4">
              <label class="form-check-label"><input type="checkbox" class="form-check-input" id="reduceDo" value="" name="reduceDo">Reduced the dosage</label>
            </div>
            <div class="col-sm-8"><input type="text" name="reduceDoDosage" id="reduceDoDosage" class="form-control" disabled></div>

            <div class="form-check-inline col-sm-4">
              <label class="form-check-label"><input type="checkbox" class="form-check-input" id="tapDurg" value="" name="tapDurg">Tapering the drug</label>
            </div>
            <div class="col-sm-8"><input type="text" name="tapDurgDosage" id="tapDurgDosage" class="form-control" disabled></div>

            <div class="form-check-inline col-sm-4">
              <label class="form-check-label"><input type="checkbox" class="form-check-input" id="restartDrug" value="" name="restartDrug">Restart the drug</label>
            </div>
            <div class="col-sm-8"><input type="text" name="restartDrugDosage" id="restartDrugDosage" class="form-control" disabled></div>

            <div class="form-check-inline col-sm-4">
              <label class="form-check-label"><input type="checkbox" class="form-check-input" id="referpsy" value="" name="referpsy">Refer to psychiatrist </label>
            </div>
            <div class="form-check-inline col-sm-4">
              <label class="form-check-label"><input type="checkbox" class="form-check-input" id="stopDrug" value="" name="stopDrug">Stopping the drug</label>
            </div>
          </div>

        </section>
        <!-- Pharmacological treatment -->

        <section id="otherManageSection">
          <div class="subTb-header">
            <h3>Other management: </h3>
          </div>
          <div class="row">
            <div class="form-check-inline col-sm-4">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" id="psyMAMFollow" value="" name="psyMAM">Psychosocial intervention at MAM
              </label>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-3">
              <label class="form-label"> Refer to psychiatrist</label>
              <select name="referPsychiatristOther" id="referPsychiatristOther" class="form-control">
                <option value=""></option>
                <option value="Mental hospital">Mental hospital</option>
                <option value="General hospital">General hospital</option>
                <option value="Private psychiatrist">Private psychiatrist</option>
              </select>
            </div>
            <div class="col-sm-3">
              <label for="" class="form-label">MD’s Initial</label>
              <input type="text" name="mdInit" id="mdInitFollow" class="form-control">
            </div>
            <div class="col-sm-3">
              <label for="" class="form-label">CSL’s Initial</label>
              <input type="text" name="cslInit" id="cslInitFollow" class="form-control">
            </div>
            <div class="col-sm-3">
              <label for="" class="form-label">Next Follow up date</label>
              <div class="date-holder">
                <input type="text" id="nextFollowDateFollow" name="nextFollowDate" class="form-control Gdate" placeholder="dd-mm-yyyy">
                <img src="../img/calendar3.svg" class="dateimg" alt="date">
              </div>

            </div>
          </div>
        </section>

        <section>
          <div class="row" style="justify-content: center;">
            <div class="col-sm-3">
              <button type="button" class="btn btn-info" id="mentaFollowBtn" onclick="saveUPMentalFollow(this)" value="saveMentalFollow" disabled>Save Mental Follow</button>
            </div>
          </div>
        </section>

      </section>
      <section id="mentalFollowHistory">
        <h3 class="header-text">Mental Health Follow Up History</h3>
        <div class="row" style="justify-content: center;">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>No.</th>
                <th>General ID</th>
                <th>Visit Date</th>
                <th></th>
              </tr>
            </thead>
            <tbody></tbody>
          </table>
        </div>

        <div class="row" style="justify-content: center;">
          <div class="col-sm-3">
            <button class="btn btn-info" id="toFollowForm">To Follow Form</button>
          </div>
        </div>

      </section>


    </div>

    <div class="tab-pane  mental-block " id="mentalHealthExport">
      <form action="{{ route('mentalControl') }}" method="post">
        @csrf
        <section class="" id="mental_export">
          <h2 class="header-text">Mental Health Export Data</h2>
        </section>
        <section>
          <div class="row">
            <div class="col-sm-2">
              <label for="ExportType" class="form-label">Export Type</label>
              <select name="ExportType" id="" class="form-select">
                <option value="Register">Register</option>
                <option value="FollowUp">Follow up</option>
              </select>
            </div>
            <div class="col-sm-2">
              <label for="FromDate" class="form-label">From Date</label>
              <div class="date-holder">
                <input type="text" id="FromDate" name="FromDate" class="form-control Gdate" placeholder="dd-mm-yyyy">
                <img src="../img/calendar3.svg" class="dateimg" alt="date">
              </div>
              @error('FromDate')
              <div class="alert alert-danger">Please input date</div>
              @enderror

            </div>
            <div class="col-sm-2">
              <label for="ToDate" class="form-label">To Date</label>
              <div class="date-holder">
                <input type="text" id="ToDate" name="ToDate" class="form-control Gdate" placeholder="dd-mm-yyyy">
                <img src="../img/calendar3.svg" class="dateimg" alt="date">
              </div>
              @error('ToDate')
              <div class="alert alert-danger">Please input date</div>
              @enderror
            </div>
            <div class="col-sm-2" style="display: none;">
              <input type="text" name="notice" value="Export Mental Data">
            </div>
            <div class="col-sm-2">
              <button class="btn btn-info" style="margin-top: 35px;">Export</button>
            </div>
          </div>

        </section>

      </form>
    </div>

  </section>
</div>
@endauth
@endsection
<script>
  const mentalReg = [
    'ifPWID', 'If_pwud',
    'ifEx', 'If_pwudEx',
    'alcohol_drink', 'Alcohol_drinking',
    'mentalRegDate', 'Reg_date',
    'psychosis', 'Psychosis',
    'symptoms', 'Symptoms',
    'others', 'Psy_others',

    'duration', 'Duration',
    'sucidalRisk', 'Suicidal_risk',
    'sucidalTime', 'Sucidal_yes',
    'drugUse', 'Drug_uses3month',
    'drugWillness', 'Drug_willingness',
    'drugSexUse', 'Sexual_drug',
    'drugSexWillness', 'SexualDrug_willigness',
    'injectDrugUse', 'Injectable',
    'injectDrugYes', 'Injectable_yes',
    'assistScore', 'ASSIST_score',
    'drugname_1', 'Drug_name_1',
    'drug1_Risk', 'Drug_name_1_risk',
    'drugname_2', 'Drug_name_2',
    'drug2_Risk', 'Drug_name_2_risk',
    'drugname_3', 'Drug_name_3',
    'drug3_Risk', 'Drug_name_3_risk',
    'drugname_4', 'Drug_name_4',
    'drug4_Risk', 'Drug_name_4_risk',
    'drugname_5', 'Drug_name_5',
    'drug5_Risk', 'Drug_name_5_risk',
    'bi', 'Brief',
    'planGo', 'Brief_plan',
    'planDescribe', 'Brief_plan_detail',
    'stageBi', 'Brief_stage',
    'noBi', 'Brief_no',
    'fluoxetine', 'Fluoxetine',
    'haloparidol', 'Haloparidol',
    'treatmentOther', 'Tre_other',
    'referPsychiatrist', 'Refer_psychiatrist',
    'mdInit', 'MD_initial',
    'cslInit', 'CSL_initial',
    'nextFollowDate', 'Next_meetdate',
  ]
  const mentalCheck = [
    'psyMAM', 'Psychosocial_mam',
    'phamacoMAM', 'Pharmacologica_mam',
  ]
  const mentalFollowList = [
    //'tag ID','Column name'
    'mentalVisitDate', 'Visit_date',
    'impSymptomsFollow', 'Improve_symp',
    'Adherence_problemFollow',
    'Adh_problem',
    'mental_rescreenFollow', 'Mental_asses_rescreen',
    'noRescreen', 'No_asses_describe',
    'drugUseReassement', 'Drug_reassesment',
    'assistScoreFollow', 'Assist_score_screen',
    'followDrug_1', 'Drug_1',
    'drugScore-1', 'Scroe_1',
    'drugScore-1-Risk', 'Scroe_1_risk',
    'followDrug_2', 'Drug_2',
    'drugScore-2', 'Scroe_2',
    'drugScore-2-Risk', 'Scroe_2_risk',
    'followDrug_3', 'Drug_3',
    'drugScore-3', 'Scroe_3',
    'drugScore-3-Risk', 'Scroe_3_risk',
    'followDrug_4', 'Drug_4',
    'drugScore-4', 'Scroe_4',
    'drugScore-4-Risk', 'Scroe_4_risk',
    'followDrug_5', 'Drug_5',
    'drugScore-5', 'Scroe_5',
    'drugScore-5-Risk', 'Scroe_5_risk',

    'followDrug_6', 'Drug_6',
    'drugScore-6', 'Scroe_6',
    'drugScore-6-Risk', 'Scroe_6_risk',
    'rebi', 'Brief',
    'rePlanGo', 'Brief_plan',
    'replanDescribe', 'Brief_plan_detail',
    'changePlanDescribe', 'Brief_plan_changeDetail',
    'stageBiFollow', 'Brief_stage',
    'suicidalRiskBetween', 'Sucidal_risk_between_lastVist',
    'pharmaSideEffect', 'Phamological_effect',
    'extrapySideEffect', 'Extrapyramidal_effect',
    'otherSideEffect', 'Other_effect',
    'manageSideEffect', 'Management_effect',
    'artaneFollow', 'Artane',
    'otherManage', 'Other_management',
    'sameTre', 'Continue_same_traeat',
    'sameTreDosage', 'Continue_same_traeat_describe',
    'incDo', 'Increase_dosage',
    'incDoDosage', 'Increase_dosage_describe',
    'reduceDo', 'Reduce_dosage',
    'reduceDoDosage', 'Reduce_dosage_describe',
    'tapDurg', 'Tapering_drug',
    'tapDurgDosage', 'Tapering_drug_describe',
    'restartDrug', 'Restart_drug',
    'restartDrugDosage', 'Restart_drug_describe',
    'referpsy', 'Refer_psychiatrist',
    'stopDrug', 'Stop_drug',
    'psyMAMFollow', 'Psy_interview_mam',
    'referPsychiatristOther', 'Other_refer_psychiatrist',
    'mdInitFollow', 'MD_initial', // Use smdInitFollowtring for fixed-length text
    'cslInitFollow', 'CSL_initial',
    'nextFollowDateFollow', 'Next_meetdate',
  ]
  let mentalFollow;
  let mentalRegister; //Follow array data;
  let followID; //for followup update ID;

  function pwidRisk() {
    let mentalRisk;
    mentalRisk = $("#mental_mrisk").val()
    if (mentalRisk == "PWUD" || mentalRisk == "IDU") {
      $("#ifPWID").prop('disabled', false)
      let ifpwud = $("#ifPWID").val();
      if (ifpwud == "Ex") {
        $("#ifEx").prop("disabled", false);
      } else {
        $("#ifEx").prop("disabled", true).val("");
      }
    } else {
      $("#ifEx,#ifPWID").prop("disabled", true).val("");
    }
  }

  function sucidalRisk() {
    $("#sucidalRisk").val() == "Yes" ?
      $("#sucidalTime").prop("disabled", false) :
      $("#sucidalTime").prop("disabled", true).val("");
  }

  function drugUse() {
    $("#drugUse").val() == "Yes" ?
      $("#drugWillness").prop("disabled", false) :
      $("#drugWillness").prop("disabled", true).val("");
  }

  function drugSexUse() {
    $("#drugSexUse").val() == "Yes" ?
      $("#drugSexWillness").prop("disabled", false) :
      $("#drugSexWillness").prop("disabled", true).val("");
  }

  function injectDrug() {
    $("#injectDrugUse").val() == "Yes" ?
      $("#injectDrugYes").prop("disabled", false) :
      $("#injectDrugYes").prop("disabled", true).val("");
  }

  function biref() {
    $("#bi").val() == "Yes" ?
      ($("#planGo, #planDescribe").prop("disabled", false), $("#noBi").prop("disabled", true)) :
      ($("#bi").val() == "No" ?
        ($("#planGo, #planDescribe").prop("disabled", true).val(""), $("#noBi").prop("disabled", false).val("")) :
        $("#planGo, #planDescribe, #noBi").prop("disabled", true).val(""));
  }

  function pharmacological() {
    $("#phamacoMAM").prop('checked') == true ?
      $("#fluoxetine,#haloparidol,#treatmentOther").prop('disabled', false) :
      $("#fluoxetine,#haloparidol,#treatmentOther").prop('disabled', true).val("");
  }

  //Follow up Vilidation
  function drugassemnt() {

    $("#drugUseReassement").val() == "Yes" ?
      $("#assistScoreFollow,#drugScore-1,#drugScore-2,#drugScore-3,#drugScore-4,#drugScore-5,#drugScore-6").prop("disabled", false) :
      $("#assistScoreFollow,#drugScore-1,#drugScore-2,#drugScore-3,#drugScore-4,#drugScore-5,#drugScore-6").prop("disabled", true).val("");
  }

  function birefRe() {
    $("#rebi").val() == "Yes" ? $("#replanGo, #replanDescribe").prop("disabled", false) :
      $("#replanGo, #replanDescribe").prop("disabled", true).val("");
  }

  function calucuteRisk(index) {
    let followRiskId = $(index).attr("id");
    let data = $("#" + followRiskId).val();
    if (data == "0-3") {
      $("#" + followRiskId + "-Risk").val("Low risk");
    } else if (data == "4-26") {
      $("#" + followRiskId + "-Risk").val("Moderate risk");
    } else if (data == ">27") {
      $("#" + followRiskId + "-Risk").val("High risk");
    } else {
      $("#" + followRiskId + "-Risk").val("");
    }

  }

  function pharmaloTre() {
    $("#pharmaloTre input[type='checkbox']").each(function(index) {
      let checkid = $(this).attr('id');
      console.log(checkid + "dosage");
      $("#" + checkid).prop("checked") == true ? $("#" + checkid + "Dosage").prop("disabled", false) :
        $("#" + checkid + "Dosage").prop("disabled", true).val("");
    });
  }

  function findRegisterData() {
    let regDate = formatDate($("#mentalRegDate").val());

    let mentalFind = {
      Pid: $("#Pid").val(),
      RegisterDate: regDate,
      notice: "Find Confidential"
    }
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
      }
    });
    $.ajax({
      type: 'POST',
      url: "{{ route('mentalControl') }}",
      dataType: 'json',
      contentType: 'application/json',
      data: JSON.stringify(mentalFind),
      success: function(response) {
        console.log(response);
        if (response) {
          mentalFollow = response['mental_follow'];

          $("#mentalRegDate").val(response['Reg Date']);
          $("span[name='fuchia']").text(response['FuchiaID']);
          $("span[name='prep']").text(response['PrEPCode']);
          $("span[name='curAge']").text(response['Current Agey']);
          $("span[name='sex']").text(response['Gender']);
          $("select[name='mainRisk']").val(response['Main Risk']);
          $("#PidFollow").text(response['Pid']);

          subRiskCreate("mental-srisk", "#mental_mrisk");

          $("select[name='subRisk']").val(response['Sub Risk']);

          pwidRisk();
          $("#phq4Q1Q2Register").val(response['mentalScreening']['Q1_Q2']);
          $("#phq4Q3Q4Register").val(response['mentalScreening']['Q1_Q2']);
          $("#gad7ScoreRegister").val(response['mentalScreening']['gad7_amount']);
          $("#phq9ScoreRegister").val(response['mentalScreening']['PHQ9_amount']);
          if (response["mental_register"] != null) {
            mentalRegister = response["mental_register"];
            $("#mental_hiv").val(response["hivResult"]);
            $("#metal_toFollowBtn").show();
            for (let index = 0; index < mentalReg.length; index += 2) {
              $("#" + mentalReg[index]).val(response["mental_register"][mentalReg[index + 1]])
            }
            for (let index = 0; index < mentalCheck.length; index += 2) {
              if (response["mental_register"][mentalCheck[index + 1]] == 1) {
                $("#" + mentalCheck[index]).prop('checked', true)
              } else {
                $("#" + mentalCheck[index]).prop('checked', false)
              }
            }
            $("#saveUPdate").val("updateMental").text("Update Mental Register");
            $("#mental_head").text("Update Mental Health & sexualized drug use– Registration Form")
            sucidalRisk();
            drugUse();
            drugSexUse();
            injectDrug();
            biref();
            pharmacological()
          } else {
            $("#metal_toFollowBtn").show();
            $("#mental_head").text("Mental Health & sexualized drug use– Registration Form");

          }
          DateTo_text();
          $("#saveUPdate").prop("disabled", false);
          followHistory()
        } else {
          alert("This ID don't have Screening or Confidential")
          $("#mental_register input,#mental_register select").val("");
          $("#mental_register span").text("");
          $("#saveUPdate").prop("disabled", true);
          $("#mentalRegDate").focus();
        }
      }
    })
  }

  function followHistory() {
    let tableRow;
    $("#mentalFollowHistory table tbody").empty();
    $.each(mentalFollow, function(key, value) {
      let vdatefollow = value["Visit_date"] ?
        value["Visit_date"].split("-") : [];

      // Check if vdatefollow has the expected format
      let formattedDate =
        vdatefollow.length === 3 ?
        `${vdatefollow[2]}-${vdatefollow[1]}-${vdatefollow[0]}` :
        "Invalid date";

      tableRow = $("<tr>")
        .append($("<td>").text(key + 1))
        .append($("<td>").text(value["Pid"]))
        .append($("<td>").text(formattedDate))
        .append(
          $("<td>")
          .append(
            $(
              "<button class='btn btn-info mentalDetail' onclick='fillFollowDeatail()'>"
            )
            .attr({
              id: "Detail" + key
            })
            .text("Detail")
          )
          .append(
            $(
              "<button class='btn btn-danger followremove' onclick='deleteFollow()'>"
            )
            .attr({
              id: "remove" + key
            })
            .text("Delete")
          )
        );
      $("#mentalFollowHistory table tbody").append(tableRow);
    });
  }

  function SaveUpdateMentalHealth(button) {
    let saveUpdate = $(button).val();
    let mentalData = {};
    if (saveUpdate == "updateMental") {
      mentalData["updatePid"] = mentalRegister["Pid"];
      mentalData["updateID"] = mentalRegister["id"];
    }
    $("#mental_register input,#mental_register select").each(function(index) {
      if ($(this).is('input[type="checkbox"]')) {
        if ($(this).is(':checked')) {
          mentalData[$(this).attr('name')] = 1;
        } else {
          mentalData[$(this).attr('name')] = 0;
        }
      } else if ($(this).hasClass('Gdate')) {
        mentalData[$(this).attr('name')] = formatDate($(this).val())
      } else {
        mentalData[$(this).attr('name')] = $(this).val()
      }
    })
    mentalData["notice"] = saveUpdate;
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
      }
    });
    $.ajax({
      type: 'POST',
      url: "{{ route('mentalControl') }}",

      dataType: 'json',
      contentType: 'application/json',
      data: JSON.stringify(mentalData),
      beforeSend: function() {
        $(button).prop("disabled", true);
        timeoutHandle = setTimeout(oneClick, 3000);
      },
      success: function(response) {
        $(button).prop("disabled", false);
        clearTimeout(timeoutHandle);
        if (response) {
          alert("Scuccess porcess")
          location.reload();
        } else {
          alert("Fail process");
        }
      }
    })
  }

  function getFollowMark() {
    let getfollowmark = {
      "Pid": $("#PidFollow").text(),
      "visitDate": formatDate($("#mentalVisitDate").val()),
      "notice": "getFollowMark"
    }
    console.log(getfollowmark);
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
      }
    });
    $.ajax({
      type: 'POST',
      url: "{{ route('mentalControl') }}",

      dataType: 'json',
      contentType: 'application/json',
      data: JSON.stringify(getfollowmark),
      success: function(response) {
        console.log(response);
        if (response != false) {
          $("#phq4Q1Q2Follow").val(response["Q1_Q2"]);
          $("#phq4Q3Q4Follow").val(response["Q3_Q4"]);
          $("#gad7ScoreFollow").val(response["gad7_amount"]);
          $("#phq9ScoreFollow").val(response["PHQ9_amount"]);
          $("#mentaFollowBtn").prop("disabled", false);
        } else {
          alert("This patient don't screning in this date")
          $("#mentaFollowBtn").prop("disabled", true)
          $("#mentalVisitDate").focus();
        }

      }
    })
  }

  function saveUPMentalFollow(button) {
    let menalFollowCollect = {}
    let saveUpdate = $("#mentaFollowBtn").val();
    if (saveUpdate == "updateMentalFollow") {
      menalFollowCollect["id"] = followID;
    }
    $("#mental_follow input,#mental_follow select").each(function(index) {
      if ($(this).is('input[type="checkbox"]')) {
        if ($(this).is(':checked')) {
          menalFollowCollect[$(this).attr('name')] = 1;
        } else {
          menalFollowCollect[$(this).attr('name')] = 0;
        }
      } else if ($(this).hasClass('Gdate')) {
        menalFollowCollect[$(this).attr('name')] = formatDate($(this).val())
      } else {
        menalFollowCollect[$(this).attr('name')] = $(this).val()
      }
    })
    menalFollowCollect["notice"] = saveUpdate;
    menalFollowCollect["Pid"] = $("#PidFollow").text();
    console.log(menalFollowCollect);
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
      }
    });
    $.ajax({
      type: 'POST',
      url: "{{ route('mentalControl') }}",

      dataType: 'json',
      contentType: 'application/json',
      data: JSON.stringify(menalFollowCollect),
      beforeSend: function() {
        $(button).prop("disabled", true);
        timeoutHandle = setTimeout(oneClick, 3000);
      },
      success: function(response) {
        $(button).prop("disabled", false);
        clearTimeout(timeoutHandle);
        if (response) {
          alert("Success process");
          location.reload()
        } else {
          alert("Fail process")
        }
      }
    })
  }

  function fillFollowDeatail() {
    let target = $(event.target).attr("id").match(/\d+/)[0];
    followID = mentalFollow[target]['id'];
    $("#mental_follow input,#mental_follow select").val("");
    $("#mental_follow input[type='checkbox']").prop('checked', false);
    for (let index = 0; index < mentalFollowList.length; index += 2) {
      if ($("#" + mentalFollowList[index]).is('input[type="checkbox"]')) {
        if (mentalFollow[target][mentalFollowList[index + 1]] == 1) {
          $("#" + mentalFollowList[index]).prop("checked", true);
        }
      } else {
        $("#" + mentalFollowList[index]).val(mentalFollow[target][mentalFollowList[index + 1]]);
      }
    }
    $("#patient_information,#mental_follow").show();
    DateTo_text();
    getFollowMark()
    $("#mentaFollowBtn").text("Update Follow").val("updateMentalFollow");
    drugassemnt();
    birefRe();
    pharmaloTre();
    $("#mental_head").text("Mental Health & Sexualized drug use- Follow Up Update Form ")
    $("#mentalFollowHistory").hide();
    $(".followremove").prop("disabled", false);
    $("#remove" + target).prop("disabled", true);

  }

  function deleteFollow() {
    let target = $(event.target).attr("id").match(/\d+/)[0];
    followID = mentalFollow[target]['id'];
    let deletvdate = $(event.target).parent().parent().children().eq(2).text();;
    let deletData = {
      "Pid": $("#PidFollow").text(),
      "notice": "DeleteMentalFollow",
      "vdate": formatDate(deletvdate),
      "id": followID,
    }
    console.log(deletData);
    if (confirm("Are you sure this ID" + deletData["Pid"] + " and visit date-" + deletvdate)) {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        }
      });
      $.ajax({
        type: 'POST',
        url: "{{ route('mentalControl') }}",
        dataType: 'json',
        contentType: 'application/json',
        data: JSON.stringify(deletData),
        success: function(response) {
          if (response != false) {
            alert("Success delete process");
            mentalFollow = response;
            followHistory();
          } else {
            alert("Fail delete process")
          }
        }
      })
    }

  }
</script>
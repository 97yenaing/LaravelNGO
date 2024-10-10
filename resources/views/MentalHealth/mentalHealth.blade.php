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
    <div class="tab-pane active mental-block">
      <section id="patient_information">
        <label for="" class="form-label"></label>
        <h2 class="header-text" id="mental_head">Mental Health & sexualized drug use– Registration Form</h2>
      </section>
      <section class="mental-register" id="mental_register">
        <section id="patientIdentifine">
          <div class="subTb-header">
            <h3>Patient Identificationn</h3>
          </div>
          <div class="row">
            <div class="col-sm-3">
              <label for="" class="form-label">General ID</label>
              <div class="input-group mb-3">
                <input type="number" name="Pid" id="Pid" class="form-control input-group-append no-margin" placeholder="General ID">
                <div class="input-group-append no-margin">
                  <button class="btn btn-primary" onclick="findRegisterData()" type="button">Search</button>
                </div>
              </div>
              <!-- onclick="findRegisterData()" -->
            </div>
            <div class="col-sm-2">
              <label for="" class='form-label'>Fuchia ID</label>
              <span class="form-control"></span>
            </div>
            <div class="col-sm-2">
              <label for="" class='form-label'>PrEP ID</label>
              <span class="form-control"></span>
            </div>
            <div class="col-sm-1">
              <label for="" class='form-label'>Cur_Age</label>
              <span class="form-control"></span>
            </div>
            <div class="col-sm-2">
              <label for="" class='form-label'>Sex</label>
              <span class="form-control"></span>
            </div>
            <div class="col-sm-2">
              <label for="" class='form-label'>HIV Status</label>
              <select name="mentalHIV" id="" class="form-control">
                <option value=""></option>
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
              <select name="alcoholDrink" id="" class="form-select">
                <option value=""></option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
                <option value="Ex-drinker">Ex-drinker</option>
              </select>
            </div>
            <div class="col-sm-2">
              <label for="" class="form-label">Reg Date</label>
              <div class="date-holder">
                <input type="text" id="mentalRegDate" name="mentalRegDate" class="form-control Gdate" placeholder="dd-mm-yyyy">
                <img src="../img/calendar3.svg" class="dateimg" alt="date">
              </div>
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
              <input type="number" name="phq4Q1Q2" id="" class="form-control">
            </div>
            <div class="col-sm-2">
              <label for="" class="form-label">PHQ4(Q3/Q4)</label>
              <input type="number" name="phq4Q3Q4" id="" class="form-control">
            </div>
            <div class="col-sm-2">
              <label for="" class="form-label">GAD7</label>
              <input type="number" name="gad7Score" id="" class="form-control">
            </div>
            <div class="col-sm-2">
              <label for="" class="form-label">PHQ9</label>
              <input type="number" name="phq9Score" id="" class="form-control">
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
              <select name="psychosis" id="" class="form-select">
                <option value=""></option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
              </select>
            </div>
            <div class="col-sm-2">
              <label for="" class="form-label">Symptoms</label>
              <select name="symptoms" id="" class="form-select">
                <option value=""></option>
                <option value="Delusion">Delusion</option>
                <option value="Illusion">Illusion</option>
                <option value="Hallucination">Hallucination</option>
              </select>
            </div>
            <div class="col-sm-6">
              <label for="" class="form-label">Others</label>
              <input type="text" name="others" id="" class="form-control">
            </div>
            <div class="col-sm-2">
              <label for="" class="form-label">Duration</label>
              <select name="duration" id="" class="form-control">
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
              <label for="" class="form-label">If Question 3 yes,</label>
              <select name="injectDrugYes" id="injectDrugYes" class="form-select" disabled>
                <option value=""></option>
                <option value="Within last 3 months">Within last 3 months</option>
                <option value="Beyond last 3 months">Beyond last 3 months</option>
              </select>
            </div>
          </div>

        </section>

        <section id="assistScore">
          <div class="subTb-header">
            <h3>ASSIST Score (Screenning)</h3>
          </div>
          <div class="row">
            <div class="col-sm-4">
              <label class="form-label" for="">ASSIST Score (Screenning)</label>
              <select name="assistScore" id="" class="form-select">
                <option value=""></option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
              </select>
            </div>
            <div class="col-sm-4">
              <label for="validationCustom01" class="form-label">Name of Drug</label>
              <div class="input-group mb-4">
                <input type="text" name="drugname-1" id="" class="form-control input-group-append no-margin" placeholder="Name Drug">

                <select name="drug-1-Risk" id="" class="form-select">
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
                <input type="text" name="drugname-2" id="" class="form-control input-group-append no-margin" placeholder="Name Drug">
                <select name="drug-2-Risk" id="" class="form-select">
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
                <input type="text" name="drugname-3" id="" class="form-control input-group-append no-margin" placeholder="Name Drug">
                <select name="drug-3-Risk" id="" class="form-select">
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
                <input type="text" name="drugname-4" id="" class="form-control input-group-append no-margin" placeholder="Name Drug">
                <select name="drug-4-Risk" id="" class="form-select">
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
                <input type="text" name="drugname-5" id="" class="form-control input-group-append no-margin" placeholder="Name Drug">
                <select name="drug-5-Risk" id="" class="form-select">
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
                <input type="checkbox" class="form-check-input" id="" value="" name="psyMAM"> Psychosocial intervention at MAM
              </label>
            </div>
            <div class="form-check-inline col-sm-6">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" id="phamacoMAM" value="" name="phamacoMAM"> Pharmacological management at MAM
              </label>
            </div>
            <div class="col-sm-4">
              <label for="" class="form-label">Fluoxetine</label>
              <input type="text" name="fluoxetine" id="fluoxetine" class="form-control" disabled>
            </div>
            <div class="col-sm-4">
              <label for="" class="form-label">Haloparidol</label>
              <input type="text" name="haloparidol" id="haloparidol" class="form-control" disabled>
            </div>
            <div class="col-sm-4">
              <label for="" class="form-label">other</label>
              <input type="text" name="treatmentOther" id="treatmentOther" class="form-control" disabled>
            </div>
            <div class="form-check-inline col-sm-3">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" id="" value="" name="referPsy"> Refer to psychiatrist
              </label>
            </div>
            <div class="col-sm-9 radio-check">
              <div class="form-group">
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="Hosipital" id="mentalHos" value="">
                  <label class="form-check-label idfixradio" for="radioDelete">
                    Mental hospital
                  </label>
                  <input class="form-check-input" type="radio" name="Hosipital" id="genralHos" value="">
                  <label class="form-check-label idfixradio" for="radioMarge">
                    General hospital
                  </label>
                  <input class="form-check-input" type="radio" name="Hosipital" id="privitePsychia" value="">
                  <label class="form-check-label" for="radioMarge">
                    Private psychiatrist
                  </label>
                </div>
              </div>
            </div>
            <div class="col-sm-4">
              <label for="" class="form-label">MD’s Initial</label>
              <input type="text" name="mdInit" id="" class="form-control">
            </div>
            <div class="col-sm-4">
              <label for="" class="form-label">CSL’s Initial</label>
              <input type="text" name="cslInit" id="" class="form-control">
            </div>
            <div class="col-sm-4">
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
              <button type="button" class="btn btn-info">Save Mental Register</button>
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
              <span class="form-control" name="Pid" id="Pid"></span>
            </div>
            <div class="col-sm-2">
              <label for="" class="form-label">Fuchia ID</label>
              <span class="form-control" name="Fuchia" id="Fuchia"></span>
            </div>
            <div class="col-sm-2">
              <label for="" class="form-label">PrEP ID</label>
              <span class="form-control" name="Prep" id="Prep"></span>
            </div>
            <div class="col-sm-2">
              <label for="" class="form-label">Visit Date</label>
              <div class="date-holder">
                <input type="text" id="mentalRegDate" name="mentalRegDate" class="form-control Gdate" placeholder="dd-mm-yyyy">
                <img src="../img/calendar3.svg" class="dateimg" alt="date">
              </div>
            </div>
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
              <select name="impSymptoms" id="" class="form-select">
                <option value=""></option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
              </select>
            </div>
            <div class="col-sm-4">
              <label for="" class="form-label">Adherence problem</label>
              <select name="Adherence_problem" id="" class="form-select">
                <option value=""></option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
                <option value="NA">NA</option>
              </select>
            </div>
            <div class="col-sm-4">
              <label for="" class="form-label">Mental Health assessment rescreening</label>
              <select name="mental_rescreen" id="" class="form-select">
                <option value=""></option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
                <option value="NA">NA</option>
              </select>
            </div>
            <div class="col-sm-2">
              <label for="" class="form-label">PHQ4(Q1/Q2)</label>
              <input type="number" name="phq4Q1Q2" id="" class="form-control">
            </div>
            <div class="col-sm-2">
              <label for="" class="form-label">PHQ4(Q3/Q4)</label>
              <input type="number" name="phq4Q3Q4" id="" class="form-control">
            </div>
            <div class="col-sm-2">
              <label for="" class="form-label">GAD7</label>
              <input type="number" name="gad7Score" id="" class="form-control">
            </div>
            <div class="col-sm-2">
              <label for="" class="form-label">PHQ9</label>
              <input type="number" name="phq9Score" id="" class="form-control">
            </div>
            <div class="col-sm-12">
              <label for="" class="form-label">If No, please describe the reason:</label>
              <input type="number" name="noRescreen" id="" class="form-control">
            </div>


          </div>
        </section>
        <!-- Assessments -->

        <section>
          <div class="subTb-header">
            <h3>ASSIST Score (Rescreenning)</h3>
          </div>
          <div class="row">
            <div class="col-sm-4">
              <label class="form-label" for="">Drug use reassessment:</label>
              <select name="drugUseReassement" id="drugUseReassement" class="form-select">
                <option value=""></option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
              </select>
            </div>
            <div class="col-sm-4">
              <label class="form-label" for="">ASSIST Score (Screenning)</label>
              <select name="assistScore" id="assistScore" class="form-select" disabled>
                <option value=""></option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
              </select>
            </div>
            <div class="col-sm-4">
              <label for="validationCustom01" class="form-label">Score && Risk</label>
              <div class="input-group mb-4">
                <input type="text" name="drugScore-1" id="drugScore-1" class="form-control input-group-append no-margin" placeholder="Score 1" disabled>
                <select name="drugScore-1-Risk" id="drugScore-1-Risk" class="form-select" disabled>
                  <option value=""></option>
                  <option value="0-3 (Low risk)">0-3 (Low risk)</option>
                  <option value="4-26 (Moderate risk)">4-26 (Moderate risk)</option>
                  <option value=">27 (High risk)">&gt;27 (High risk)</option>
                </select>


              </div>
              <!-- onclick="findRegisterData()" -->
            </div>
            <div class="col-sm-4">
              <label for="validationCustom01" class="form-label">Score && Risk</label>
              <div class="input-group mb-4">
                <input type="text" name="drugScore-2" id="drugScore-2" class="form-control input-group-append no-margin" placeholder="Score 2" disabled>
                <select name="drugScore-2-Risk" id="drugScore-2-Risk" class="form-select" disabled>
                  <option value=""></option>
                  <option value="0-3 (Low risk)">0-3 (Low risk)</option>
                  <option value="4-26 (Moderate risk)">4-26 (Moderate risk)</option>
                  <option value=">27 (High risk)">&gt;27 (High risk)</option>
                </select>
              </div>
            </div>
            <div class="col-sm-4">
              <label for="validationCustom01" class="form-label">Score && Risk</label>
              <div class="input-group mb-4">
                <input type="text" name="drugScore-3" id="drugScore-3" class="form-control input-group-append no-margin" placeholder="Score 3" disabled>
                <select name="drugScore-3-Risk" id="drugScore-3-Risk" class="form-select" disabled>
                  <option value=""></option>
                  <option value="0-3 (Low risk)">0-3 (Low risk)</option>
                  <option value="4-26 (Moderate risk)">4-26 (Moderate risk)</option>
                  <option value=">27 (High risk)">&gt;27 (High risk)</option>
                </select>
              </div>
            </div>
            <div class="col-sm-4">
              <label for="validationCustom01" class="form-label">Score && Risk</label>
              <div class="input-group mb-4">
                <input type="text" name="drugScore-4" id="drugScore-4" class="form-control input-group-append no-margin" placeholder="Score 4" disabled>
                <select name="drugScore-4-Risk" id="drugScore-4-Risk" class="form-select" disabled>
                  <option value=""></option>
                  <option value="0-3 (Low risk)">0-3 (Low risk)</option>
                  <option value="4-26 (Moderate risk)">4-26 (Moderate risk)</option>
                  <option value=">27 (High risk)">&gt;27 (High risk)</option>
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
              <select name="stageBi" id="stageBi" class="form-select">
                <option value=""></option>
                <option value="D1">D1</option>
                <option value="D2">D2</option>
                <option value="D3">D3</option>
                <option value="D4">D4</option>
              </select>
            </div>
            <div class="col-sm-12">
              <label for="" class="form-label">Suicidal Risk (Attempt or Thought) between the last visit and the current visit:</label>
              <select name="suicidalRiskBetween" id="r" class="form-select">
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
                <option value="Yes"></option>
                <option value="No"></option>
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
              <input type="text" name="manageSideEffect" class="form-control">
            </div>
            <div class="col-sm-3">
              <label class="form-label">Artane (Trihexyphenidyl)</label>
              <select name="artane" id="" class="form-select">
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
                <input type="checkbox" class="form-check-input" id="" value="" name="psyMAM">Psychosocial intervention at MAM
              </label>
            </div>
            <div class="form-check-inline col-sm-4">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" id="" value="" name="referpsyOther">Refer to psychiatris
              </label>
            </div>
            <div class="col-sm-12 radio-check">
              <div class="form-group">
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="Hosipital" id="mentalHos" value="">
                  <label class="form-check-label idfixradio" for="radioDelete">
                    Mental hospital
                  </label>
                  <input class="form-check-input" type="radio" name="Hosipital" id="genralHos" value="">
                  <label class="form-check-label idfixradio" for="radioMarge">
                    General hospital
                  </label>
                  <input class="form-check-input" type="radio" name="Hosipital" id="privitePsychia" value="">
                  <label class="form-check-label" for="radioMarge">
                    Private psychiatrist
                  </label>
                </div>
              </div>
            </div>
            <div class="col-sm-4">
              <label for="" class="form-label">MD’s Initial</label>
              <input type="text" name="mdInit" id="" class="form-control">
            </div>
            <div class="col-sm-4">
              <label for="" class="form-label">CSL’s Initial</label>
              <input type="text" name="cslInit" id="" class="form-control">
            </div>
            <div class="col-sm-4">
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
              <button type="button" class="btn btn-info">Save Mental Follow</button>
            </div>
          </div>
        </section>

      </section>

    </div>
  </section>
</div>
@endauth
@endsection
<script>
  function pwidRisk() {
    let mentalRisk;
    mentalRisk = $("#mental_mrisk").val()
    if (mentalRisk == "PWUD") {
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
      $("#planGo, #planDescribe").prop("disabled", false) :
      ($("#bi").val() == "No" ?
        ($("#planGo, #planDescribe").prop("disabled", true).val(""), $("#noBi").prop("disabled", false)) :
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
      $("#assistScore,#drugScore-1,#drugScore-1-Risk,#drugScore-2,#drugScore-2-Risk,#drugScore-3,#drugScore-3-Risk,#drugScore-4,#drugScore-4-Risk").prop("disabled", false) :
      $("#assistScore,#drugScore-1,#drugScore-1-Risk,#drugScore-2,#drugScore-2-Risk,#drugScore-3,#drugScore-3-Risk,#drugScore-4,#drugScore-4-Risk").prop("disabled", true).val("");
  }

  function birefRe() {
    $("#rebi").val() == "Yes" ? $("#replanGo, #replanDescribe").prop("disabled", false) :
      $("#replanGo, #replanDescribe").prop("disabled", true).val("");
  }

  function pharmaloTre() {
    $("#pharmaloTre input[type='checkbox']").each(function(index) {
      let checkid = $(this).attr('id');
      $("#" + checkid).prop("checked") == true ? $("#" + checkid + "Dosage").prop("disabled", false) :
        $("#" + checkid + "Dosage").prop("disabled", true).val("");
    });
  }

  function findRegisterData() {}
</script>
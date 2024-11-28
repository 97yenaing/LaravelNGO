@extends('layouts.app')
@section('content')
@auth
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('js/Prep/prepScreen.js') }}"></script>
<div class="container containers">
  <ul class="nav nav-tabs toggle  ncd-list"
    id="hidden-title">
    <li class="nav-item">
      <a class="nav-link active toggle-link "
        data-toggle="tab"
        href="#prepScreen">PrepScreen</a>
    </li>
    <li class="nav-item">
      <a class="nav-link toggle-link "
        data-toggle="tab"
        href="#prepScreenExport">PrepScreen Export</a>
    </li>
  </ul>
  <section class="tab-content page-color">
    <div class="tab-pane active mental-block active" id="prepScreen">
      <h2 class="header-text" id="prepScreen_head">Pre-Exposure Prophylaxis (PrEP) Screnning for Substantial Risk and Eligibility</h2>
      <section id="patient_information">
        <h2 class="subTb-header">Client Information</h2>
        <div class="row">
          <div class="col-sm-2">
            <label for="" class="form-label">General ID</label>
            <input type="number" class="form-control" name="Pid" id="pid">
          </div>
          <div class="col-sm-2">
            <label for="" class="form-label">Initial Client Visit</label>
            <div class="date-holder">
              <input type="text" name="intialDate" id="intitalDate" class="form-control Gdate date-verify reception-dateformat" placeholder="dd-mm-yyyy">
              <img src="../img/calendar3.svg" class="dateimg" alt="date">
            </div>
          </div>

          <div class="col-sm-2"> <button class="btn btn-primary" onclick="findRegisterData()" type="button" style="margin-top: 35px; width:70%">Search</button></div>
          <div class="col-sm-2">
            <label for="" class="form-label">Prep ID</label>
            <span class="form-control" id="prepID"></span>
          </div>
          <div class="col-sm-2">
            <label for="" class="form-label">Name</label>
            <span class="form-control" id="name"></span>
          </div>
          <div class="col-sm-2">
            <label for="" class="form-label">State</label>
            <span class="form-control" id="stateSpan"></span>
          </div>
          <div class="col-sm-2">
            <label for="" class="form-label">Phone 1</label>
            <input type="number" class="form-control" id="phone1" name="phone1">
          </div>
          <div class="col-sm-2">
            <label for="" class="form-label">Phone 2</label>
            <input type="number" class="form-control" id="phone2" name="phone2">
          </div>
          <div class="col-sm-2">
            <label for="" class="form-label">DHIS2 ID</label>
            <input type="number" class="form-control" id="dhis2" name="dhis2">
          </div>
          <div class="col-sm-2">
            <label for="" class="form-label">Sex</label>
            <span class="form-control" id="sex"></span>
          </div>
          <div class="col-sm-2">
            <label for="" class="form-label">Sex Other</label>
            <input type="number" class="form-control" id="sexOther" name="sexOther">
          </div>
          <div class="col-sm-2">
            <label for="" class="form-label">Age</label>
            <span class="form-control" id="age"></span>
          </div>
          <div class="col-sm-3">
            <label for="validationCustom02" class="form-label">State/ Region of birth</label>
            <select class="form-select reception-select" name="stateBirth" id="state" onchange="region(this)">
              <option selected="" disabled="" value="">Choose....................</option>
              <option selected="" value=""></option>
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
          <div class="col-sm-3">
            <label for="validationCustom02" class="form-label">Township of birth</label>
            <select class="form-select reception-select" name="prepTown" id="tt">
              <option selected="" disabled="" value="">Choose...............</option>
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
          <div class="col-sm-2">
            <label for="" class="form-label">Main Risk</label>
            <span class="form-control" id="mainRisk"></span>
          </div>
          <div class="col-sm-2">
            <label for="" class="form-label">Sub Risk</label>
            <span class="form-control" id="subRisk"></span>
          </div>

        </div>
      </section>

      <section id="faciltyName">
        <h2 class="subTb-header">Facility Information</h2>
        <div class="row">
          <div class="col-sm-2">
            <label for="" class="form-label">Facility Name</label>
            <select class="form-select" name="clinic" id="clinic_code">
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

          <div class="col-sm-2">
            <label for="" class="form-label">Virtual KPSC</label>
            <select name="virtualKPSC" id="virtualKPSC" class="form-select">
              <option value=""></option>
              <option value="Yes">Yes</option>
              <option value="No">No</option>
            </select>
          </div>

          <div class="col-sm-2">
            <label for="" class="form-label">Navigator Code</label>
            <select class="form-control" name="peerCode" id="peerCode">
              <option value=""></option>
              <option value="1">PE-1</option>
              <option value="2">PE-2</option>
              <option value="3">PE-3</option>
              <option value="4">PE-4</option>
              <option value="5">PE-5</option>
              <option value="6">PE-6</option>
              <option value="7">PE-7</option>
              <option value="8">PE-8</option>
              <option value="9">PE-9</option>
              <option value="10">PE-10</option>
              <option value="11">PE-11</option>
              <option value="12">PE-12</option>
              <option value="13">PE-13</option>
              <option value="14">PE-14</option>
              <option value="15">PE-15</option>
            </select>
          </div>
          <div class="col-sm-2">
            <label for="" class="form-label">Persion Completing Form</label>
            <span class="form-control" name="peerName" id="peerName"></span>
          </div>

        </div>
      </section>

      <section id="sexDrugRisk">
        <h2 class="subTb-header">Sexual and Drug Injection Core Risk Classification</h2>
        <div class="row">
          <div class="col-sm-6">
            <label for="" class="form-label">1. Do you consider yourself male, female,transgender,or other?</label>
            <select name="considerSex" id="considerSex" class="form-select">
              <option value=""></option>
              <option value="1">Male</option>
              <option value="2">Female</option>
              <option value="3">TG</option>
            </select>
          </div>
          <div class="col-sm-6">
            <label for="" class="form-label">Other,Specify</label>
            <input type="text" class="form-control" id="otherSexSpeci" name="otherSexSpeci">
          </div>
          <div class="col-sm-6">
            <label for="" class="form-label">Do you have sex with </label>
            <select name="sexWith" id="sexWith" class="form-select">
              <option value=""></option>
              <option value="1">Men/TGW</option>
              <option value="2">Woman Only</option>
              <option value="3">Both Men and Women</option>
              <option value="4">No response</option>
            </select>
          </div>
          <div class="col-sm-6">
            <label for="" class="form-label">Have you exchanged sex as your main source of income in the last 6 months?</label>
            <select name="exchangeSex" id="exchangeSex" class="form-select">
              <option value=""></option>
              <option value="1">Yes</option>
              <option value="2">No</option>
              <option value="3">No Response</option>
            </select>
          </div>
          <div class="col-sm-12">
            <label for="" class="form-label">In the last 6 months, have you injected illicit or illegal drugs?</label>
            <select name="drugUse" id="drugUse" class="form-select">
              <option value=""></option>
              <option value="1">Yes</option>
              <option value="2">No</option>
              <option value="3">No Response</option>
            </select>
          </div>
        </div>
      </section>

      <section id="subHIV">
        <h2 class="subTb-header">Screnning for Substantial Risk for HIV Infection</h2>
        <div class="row">
          <div class="col-sm-12">
            <h5>1. If client is sexually active in a high HIV prevalance population PLUS reports ANY one oth the below in the last 6 months.</h5>
          </div>
          <div class="form-check-inline col-sm-12">
            <label class="form-check-label">
              (a) Reports vaginal or anal intercourse without condoms with more than one partner
              <input type="checkbox" class="form-check-input" id="v_analNoCon" value="" name="vAnalNoCon">
            </label>
          </div>
          <div class="form-check-inline col-sm-12">
            <label class="form-check-label">
              (b) Has a sex partner with one or more HIV risk:
              <input type="checkbox" class="form-check-input" id="sexHIV" value="" name="sexHIV">
            </label>
          </div>
          <div class="form-check-inline col-sm-12">
            <label class="form-check-label">
              (c) History transmitte infection (STI) of a sexually
              <input type="checkbox" class="form-check-input" id="sexSTI" value="" name="sexSTI">
            </label>
          </div>
          <div class="form-check-inline col-sm-12">
            <label class="form-check-label">
              (d) History of use of post-exposure prophylaxis (PEP)
              <input type="checkbox" class="form-check-input" id="postPEP" value="" name="postPEP">
            </label>
          </div>
          <div class="col-sm-12">
            <h5>2. If client reports history of sharing injection material or equipment in the last 6 months.</h5>
          </div>
          <div class="form-check-inline col-sm-12">
            <label class="form-check-label">
              History of sharing injection material or equipment.
              <input type="checkbox" class="form-check-input" id="shareEquip" value="" name="shareEquip">
            </label>
          </div>
          <div class="col-sm-12">
            <h5>3. If client reports having a sexual partner in the last 6 months who is HIV positive AND who has not been on effective * HIV treatment ) ( * the partner has been on effective * HIV treatment</h5>
          </div>
          <div class="form-check-inline col-sm-12">
            <label class="form-check-label">
              History of HIV-positive sex partner not on effective treatment
              <input type="checkbox" class="form-check-input" id="sexHIVNoTre" value="" name="sexHIVNoTre">
            </label>
          </div>
          <div class="form-check-inline col-sm-12">
            <label class="form-check-label">
              4. Requesting PrEP?
              <input type="checkbox" class="form-check-input" id="reqPrep" value="" name="reqPrep">
            </label>
          </div>



        </div>
      </section>

      <section id="expoHIV">
        <h2 class="subTb-header">Recent Exposure to HIV</h2>
        <div class="row">
          <div class="col-sm-12">
            <label for="" class="form-label" style="text-align: left;">
              In the past 72 hours, have you had sex without a condom with someone whose HIV status in positive or not known to you, or have you shared injection equipment with someone whose HIV status is positive or unknown to you?
            </label>
          </div>
          <div class="col-sm-2">
            <select name="riskPast72H" id="riskPast72H" class="form-select">
              <option value=""></option>
              <option value="1">Yes</option>
              <option value="2">No</option>
              <option value="3">Don't Know</option>
            </select>
          </div>
          <div class="col-sm-12">
            <label for="" class="form-label" style="text-align: left;">
              In the past 28 days , have you had symptoms of a cold or flu, including fever, fatigue, sore throat,headache, or muscle pain or soreness?
            </label>
          </div>
          <div class="col-sm-2">
            <select name="coldFlu28D" id="coldFlu28D" class="form-select">
              <option value=""></option>
              <option value="1">Yes</option>
              <option value="2">No</option>
              <option value="3">Don't Know</option>
            </select>
          </div>
          <div class="col-sm-12">
            <label for="" class="form-label">Reason</label>
            <input type="text" name="expoHIVReason" id="expoHIVReason" class="form-control">
          </div>
        </div>
      </section>

      <section id="serviceClient">
        <h2 class="subTb-header">PrEP Elibibility</h2>
        <div class="row">
          <div class="col-sm-2">
            <label for="" class="form-label">HIV non-reactive/negative</label>
            <select name="hivNeg" id="hivNeg" class="form-select">
              <option value=""></option>
              <option value="1">Yes</option>
              <option value="2">No</option>
            </select>

          </div>
          <div class="col-sm-2">
            <label for="" class="form-label">Test Date</label>
            <div class="date-holder">
              <input type="text" name="testDate" id="testDate" class="form-control Gdate date-verify reception-dateformat" placeholder="dd-mm-yyyy">
              <img src="../img/calendar3.svg" class="dateimg" alt="date">
            </div>
          </div>
          <div class="col-sm-2">
            <label for="" class="form-label">Result Receive Date</label>
            <div class="date-holder">
              <input type="text" name="receiveDate" id="receiveDate" class="form-control Gdate date-verify reception-dateformat" placeholder="dd-mm-yyyy">
              <img src="../img/calendar3.svg" class="dateimg" alt="date">
            </div>
          </div>
          <div class="col-sm-2">
            <label for="" class="form-label">Test Result</label>
            <select name="testResult" id="testResult" class="form-select">
              <option value=""></option>
              <option value="Non Reactive">Non Reactive</option>
              <option value="Reactive">Reactive</option>
            </select>
          </div>
          <div class="col-sm-2">
            <label for="" class="form-label">Reative Date</label>
            <div class="date-holder">
              <input type="text" name="reativeDate" id="reativeDate" class="form-control Gdate date-verify reception-dateformat" placeholder="dd-mm-yyyy">
              <img src="../img/calendar3.svg" class="dateimg" alt="date">
            </div>
          </div>
          <div class="col-sm-2">
            <label for="" class="form-label">Confirmation result</label>
            <select name="conResult" id="conResult" class="form-select">
              <option value=""></option>
              <option value="Non Reactive">Non Reactive</option>
              <option value="Reactive">Reactive</option>
            </select>
          </div>
          <div class="col-sm-3">
            <label for="" class="form-label">HIV substantial risk</label>
            <select name="hivSubRisk" id="hivSubRisk" class="form-select">
              <option value=""></option>
              <option value="1">Yes</option>
              <option value="2">No</option>
            </select>
          </div>

          <div class="col-sm-3">
            <label for="" class="form-label">Has no suspicion of acute HIV Infection?</label>
            <select name="acuteHiv" id="acuteHiv" class="form-select">
              <option value=""></option>
              <option value="1">Yes</option>
              <option value="2">No</option>
              <option value="3">Unknown</option>
            </select>
          </div>
          <div class="col-sm-2">
            <label for="" class="form-label">PrEP Eligible</label>
            <select name="prepEli" id="prepEli" class="form-select">
              <option value="1">Yes</option>
              <option value="2">No</option>
            </select>
          </div>

        </div>
      </section>
      <section id="prepScreenControl">
        <div class="row">
          <div class="col-sm-2">
            <button class="btn btn-info" id="screenBTn" value="savePrep" onclick="saveUpdate(this)">Save Screen</button>
          </div>
        </div>
      </section>

    </div>

    <div class="tab-pane mental-block" id="prepScreenExport">
      <form>
        @csrf
        <section class="" id="prepScreen_export">
          <h2 class="header-text">Prep Screen Export Data</h2>
        </section>
        <section>
          <div class="row">
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
              <input type="text" name="notice" value="Export prep screen">
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
  let screenFill = [
    //target Id,Column Name
    'Pid', 'Pid',
    'intitalDate', 'Inital_date',
    'dhis2', 'DHIS2_id',
    'sexOtherstate', 'Sex_other',
    'state', 'Birth_state',
    'tt', 'Birth_township',
    'clinic_code', 'Facility_name',
    'virtualKPSC', 'Virtual_KPSC',
    'peerCode', 'Nav_code',
    'considerSex', 'Consider_sex',
    'otherSexSpeci', 'Consider_other_sex',
    'sexWith', 'Sex_with',
    'exchangeSex', 'Sex_orgam_6month',
    'drugUse', 'Drug_use_6month',
    'v_analNoCon', 'Sex_ondrugUsee_noCon',
    'sexHIV', 'Sex_oneMore_HIV',
    'sexSTI', 'Sex_STI_transmit',
    'postPEP', 'PEP_expose',
    'shareEquip', 'Inject_equi_share',
    'sexHIVNoTre', 'Sex_HIV_noTre',
    'reqPrep', 'Prep_req',
    'riskPast72H', 'Risk_case_72H',
    'coldFlu28D', 'Symptoms_28D',
    'expoHIVReason', 'Reason',
    'hivNeg', 'HIV_neg',
    'testDate', 'Test_date',
    'receiveDate', 'Result_date',
    'testResult', 'Test_result',
    'reativeDate', 'Reative_date',
    'conResult', 'Confirm_result',
    'hivSubRisk', 'HIV_sub_risk',
    'acuteHiv', 'HIV_sup_infection',
    'prepEli', 'Prep_eligible',
  ]
  let prepHistory;
  let updatePrepID;

  function findRegisterData() {
    let prepFind = {
      Pid: $("#pid").val(),
      regDate: formatDate($("#intitalDate").val()),
      notice: "Search register",
    }
    console.log(prepFind);
    if (prepFind['regDate']) {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        }
      });
      $.ajax({
        type: 'POST',
        url: "{{ route('prepControl') }}",
        dataType: 'json',
        contentType: 'application/json',
        data: JSON.stringify(prepFind),
        success: function(response) {
          if (response != false) {
            console.log(response);
            prepHistory = response['prep_screen'];
            $('#prepID').text(response['PrEPCode']);
            $('#name').text(response['Name']);
            $('#stateSpan').text(response['Region']);
            $('#phone1').text(response['Phone']);
            $('#phone2').text(response['Phone2']);
            $('#sex').text(response['Gender']);
            $('#age').text(response['Current Agey']);
            $('#mainRisk').text(response['Main Risk']);
            $('#subRisk').text(response['Sub Risk']);

          } else {
            alert("This patient don't register in clinic");
          }
        }
      })
    } else {
      alert('please Fill Date and ID');
    }

  }

  function saveUpdate(button) {

    let prepData = {};

    let saveUpdate = $(button).val();
    if (saveUpdate == "updatePrep") {
      prepData["updateID"] = updatePrepID;
      prepData["notice"] = "Update prep"
    } else {
      prepData["notice"] = "Save prep"
    }
    $("#prepScreen input,#prepScreen select").each(function(index) {
      if ($(this).is('input[type="checkbox"]')) {
        if ($(this).is(':checked')) {
          prepData[$(this).attr('name')] = 1;
        } else {
          prepData[$(this).attr('name')] = 0;
        }
      } else if ($(this).hasClass('Gdate')) {
        prepData[$(this).attr('name')] = formatDate($(this).val())
      } else {
        prepData[$(this).attr('name')] = $(this).val()
      }
    })
    console.log(prepData);
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
      }
    });
    $.ajax({
      type: 'POST',
      url: "{{ route('prepControl') }}",

      dataType: 'json',
      contentType: 'application/json',
      data: JSON.stringify(prepData),
      // beforeSend: function() {
      //   $(button).prop("disabled", true);
      //   timeoutHandle = setTimeout(oneClick, 3000);
      // },
      success: function(response) {
        //$(button).prop("disabled", false);
        //clearTimeout(timeoutHandle);
        console.log("OK")
      }
    })
  }
</script>
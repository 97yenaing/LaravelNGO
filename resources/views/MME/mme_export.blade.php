<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport"
    content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible"
    content="ie=edge">
  <title>Document</title>
</head>
@extends('layouts.app')

@section('content')
@auth

<body>
  <form action={{ route('mme_export') }}
    method="post">
    @csrf
    <div class="page-color containers container">
      <h1 class="header-text">M&E All Data Export</h1>
      <div class="row">
        <div class="col-sm-2">
          <label for=""
            class="form-label">Export Type</label>
          <select name="road"
            id="type_choice"
            class="form-select"
            onchange="complete_fun()">
            <option value=""></option>
            <option value="0">Reception</option>
            <option value="1">Lab</option>
            <option value="2">Counselling</option>
            <option value="3">STI</option>
            <option value="4">Prevention</option>
            <option value="5">Cervical Cancer</option>
            <option value="6">CMV</option>
            <option value="7">NCD</option>
            <option value="8">TB-03</option>
            <option value="9">Pre TB</option>
            <option value="10">IPT</option>
          </select>
          @error('road')
          <div class="alert alert-danger">Please select export type</div>
          @enderror
        </div>
        <div class="col-sm-2"
          id="other_block">
          <label for=""
            class="form-label"
            id="other">Sub Type</label>
          <select name="other"
            id="other_type"
            class="form-select"
            disabled>

          </select>

        </div>
        {{-- <div class="col-sm-2">
          <label for="" class="form-lable">Clinic</label>
          <select name="clinic_road" id="" class="form-select">
            <option value="0">HTY-A</option>
            <option value="1">HTY-C1</option>
            <option value="2">HTY-C2</option>
            <option value="3">HTY-B</option>
            <option value="4">SPT</option>
            <option value="5">SDG</option>
            <option value="6">TL</option>
          </select>
          @error('clinic_road')
          <div class="alert alert-danger">Chosse Correct Clinic</div>
          @enderror
        </div> --}}

        <div class="col-sm-2 radio-check">
          <div class="form-group">
            <div class="form-check">
              <input class="form-check-input"
                type="radio"
                name="exportQuarter"
                id="byDate"
                value="ByDate"
                onclick="choice_type()"
                checked="checked">

              <label class="form-check-label idfixradio"
                for="radioDelete">
                By Date
              </label>
              <input class="form-check-input"
                type="radio"
                name="exportQuarter"
                id="All Data"
                value="All Data"
                onclick="choice_type()">

              <label class="form-check-label"
                for="radioMarge">
                All Data
              </label>
            </div>
          </div>
        </div>

        <div class="col-sm-2">
          <label for=""
            class="form-label">From Date</label>
          <div class="date-holder">
            <input type="text"
              id="ddFrom"
              class="form-control Gdate"
              name="From_date"
              placeholder="dd-mm-yyyy">
            <img src="../img/calendar3.svg"
              class="dateimg"
              alt="date">
          </div>
          @error('From_date')
          <div class="alert alert-danger">Please input date</div>
          @enderror
        </div>
        <div class="col-sm-2">
          <label for=""
            class="form-label">To Date</label>
          <div class="date-holder">
            <input type="text"
              id="ddTo"
              class="form-control Gdate"
              name="To_date"
              placeholder="dd-mm-yyyy">
            <img src="../img/calendar3.svg"
              class="dateimg"
              alt="date">
          </div>
          @error('To_date')
          <div class="alert alert-danger">Please input date</div>
          @enderror
        </div>
        <div class="col-sm-2">
          <label for="" class="form-label">Export Type</label>
          <select name="typeExport" class="form-select" id="">
            <option value="xlsx">xlsx</option>
            <option value="csv">csv</option>
          </select>
        </div>

      </div>
      <div class="row clinic_select">
        <h2 class="header-text">Clinic Select</h2>
        <div class="col-sm-2">
          <div class="form-check idfix-check">
            <input class="form-check-input"
              type="checkbox"
              name="clinics[]"
              onclick='clinicSelect()'
              value="All"
              {{ in_array('All', old('clinics', [])) ? 'checked' : '' }}>
            <label class="form-check-label"
              for="">
              All Clinic
            </label>
          </div>
        </div>
        <div class="col-sm-2">
          <div class="form-check idfix-check">
            <input class="form-check-input"
              type="checkbox"
              name="clinics[]"
              onclick='clinicSelect()'
              value="0"
              {{ in_array('0', old('clinics', [])) ? 'checked' : '' }}>
            <label class="form-check-label"
              for="">
              MAM A
            </label>
          </div>
        </div>
        <div class="col-sm-2">
          <div class="form-check idfix-check">
            <input class="form-check-input"
              type="checkbox"
              name="clinics[]"
              onclick='clinicSelect()'
              value="1"
              {{ in_array('1', old('clinics', [])) ? 'checked' : '' }}>
            <label class="form-check-label">
              MAM B
            </label>
          </div>
        </div>
        <div class="col-sm-2">
          <div class="form-check idfix-check">
            <input class="form-check-input"
              type="checkbox"
              name="clinics[]"
              onclick='clinicSelect()'
              value="2"
              {{ in_array('2', old('clinics', [])) ? 'checked' : '' }}>
            <label class="form-check-label"
              for="">
              MAM_C1
            </label>
          </div>
        </div>
        <div class="col-sm-2">
          <div class="form-check idfix-check">
            <input class="form-check-input"
              type="checkbox"
              name="clinics[]"
              onclick='clinicSelect()'
              value="3"
              {{ in_array('3', old('clinics', [])) ? 'checked' : '' }}>
            <label class="form-check-label"
              for="">
              MAM_C2
            </label>
          </div>
        </div>
        <div class="col-sm-2">
          <div class="form-check idfix-check">
            <input class="form-check-input"
              type="checkbox"
              name="clinics[]"
              onclick='clinicSelect()'
              value="4"
              {{ in_array('4', old('clinics', [])) ? 'checked' : '' }}>
            <label class="form-check-label"
              for="">
              SPT
            </label>
          </div>
        </div>
        <div class="col-sm-2">
          <div class="form-check idfix-check">
            <input class="form-check-input"
              type="checkbox"
              name="clinics[]"
              onclick='clinicSelect()'
              value="5"
              {{ in_array('5', old('clinics', [])) ? 'checked' : '' }}>
            <label class="form-check-label">
              SDG
            </label>
          </div>
        </div>
        <div class="col-sm-2">
          <div class="form-check idfix-check">
            <input class="form-check-input"
              type="checkbox"
              name="clinics[]"
              onclick='clinicSelect()'
              value="6"
              {{ in_array('6', old('clinics', [])) ? 'checked' : '' }}>
            <label class="form-check-label">
              Tl
            </label>
          </div>
        </div>

      </div>
      <div class="row" style="justify-content: center;">
        <div class="col-sm-2">
          <button class="btn btn-info"
            style="margin-top: 35px">Export</button>
        </div>
      </div>
      @error('clincs')
      <div class="alert alert-danger">Must Choice at least one clinic</div>
      @enderror

    </div>
  </form>
</body>
@endauth
@endsection

</html>
<script type="text/javascript">
  function complete_fun() {
    let type = $("#type_choice").val();
    let test, test_name;
    $("#other_type").empty().prop("disabled", false);
    $(".clinic_select").show();
    $(".clinic_select input[type='checkbox']").prop("disabled", false);

    switch (type) {
      case "0":
        $("#other").text("Sub Type")
        $("#other_type").empty().prop("disabled", true);
        $(".clinic_select input[type='checkbox']:eq(0)").prop("disabled", true);
        $(".clinic_select input[type='checkbox']").prop("checked", false);
      case "3": //Sti
        if (type == "3") {

          $("#other").text("Gender");
          test = ['Male', 'Female']
          $("#other_type").empty().prop("disabled", false);

          test.forEach(function(value, index) {
            var option = $("<option value='" + value + "'>" + value + "</option>");
            $("#other_type").append(option);
          });
        }
        break;
      case "1": //Lab

        $("#other").text("Test Type");
        test = ['hiv', 'rpr', 'sti', 'hep_bc', 'urine', 'oi', 'general', 'stool', 'afb', 'covid19', 'viral'];
        test_name = ['HIV Test', 'RPR Test', 'STI Test', 'Hep B/C Test', 'Urine Test', 'OI Test', 'General Test', 'Stool Test', 'AFB Test', 'Covid Test', 'Viral Load Test']
        $("#other_type").empty();
        test.forEach(function(value, index) {
          var option = $("<option value='" + value + "'>" + test_name[index] + "</option>");
          $("#other_type").append(option);
        });
        break;
      case "2": //Counsellor

        $("#other").text("Counselling Type");
        test = ["counsel_data", "hts_data"]
        test_name = ['Counselling', 'HTS']
        $("#other_type").empty();
        test.forEach(function(value, index) {
          var option = $("<option value='" + value + "'>" + test_name[index] + "</option>");
          $("#other_type").append(option);
        });
        break;
      case "4": //Prevention

        $("#other").text("Export Type");
        test = ["log_sheet", "cbs", "confidential"]
        test_name = ['Log Sheet', 'CBS', "Confidential"]
        $("#other_type").empty();
        test.forEach(function(value, index) {
          var option = $("<option value='" + value + "'>" + test_name[index] + "</option>");
          $("#other_type").append(option);
        });
        break;
      case "7": //NCD
        $("#other").text("NCD Export Type");
        test = ["Register", "Follow_Up"]
        test_name = ['NCD Register', 'NCD Follow up']
        $("#other_type").empty();
        test.forEach(function(value, index) {
          var option = $("<option value='" + value + "'>" + test_name[index] + "</option>");
          $("#other_type").append(option);
        });
        break;
      default:
        $("#other").text("Sub Type")
        $("#other_type").empty().prop("disabled", true);

    }
  }

  function clinicSelect() {
    let typeChoice = $("#type_choice").val();

    console.log($(event.target).prop("checked"));
    if (typeChoice == "0") {
      $(".clinic_select input[type='checkbox']").prop("checked", false);
      $(event.target).prop("checked", true);
    }
    if ($(event.target).val() == "All" && typeChoice != "0") {
      $(".clinic_select input[type='checkbox']").prop("checked", false);
      $(event.target).prop("checked", true);
    } else {
      $(".clinic_select input[type='checkbox']:eq(0)").prop("checked", false);
    }
  }

  function choice_type() {
    let type = $(event.target).val();
    if (type == "All Data") {
      $("#ddFrom").val("01-01-2000");
      $("#ddTo").val(todayIn);
      $("#ddFrom,#ddTo").prop("disabled", true)
    } else {
      $("#ddFrom,#ddTo").prop("disabled", false).val("");
    }
  }
</script>
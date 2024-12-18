@extends('layouts.app')
@section('content')
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/jquery-ui.min.js') }}"></script>
@auth
<p class="btn-gnavi">
  <span></span>
  <span></span>
  <span></span>
</p>
<ul class="nav nav-tabs toggle" id="hidden-title">
  <li class="nav-item">
    <a class="nav-link active toggle-link" data-toggle="pill" href="#showRiskLog">Show Risk Log</a>
  </li>
  <li class="nav-item">
    <a class="nav-link  toggle-link" data-toggle="pill" href="#updateRiskLog">Update Risk Log</a>
  </li>
</ul>
<div class="tab-content container containers">

  <div class="tab-pane active" id="showRiskLog">
    <form action="{{ route('risk_log_data') }}" method="post">
      @php
      $final_log = session('final_log');
      @endphp
      @csrf
      <div class="page-color riskLog-section">
        <div class="row">
          <div class="col-sm-2">
            <label for="" class="form-label">Select Type</label>
            <select class="form-select" name="searchType" id="riskLog_searchType" onchange="riskLogType()">
              <option value="Date" {{ old('searchType')=='Date' ? 'selected' : '' }}>Search Date</option>
              <option value="ID" {{ old('searchType')=='ID' ? 'selected' : '' }}>Search ID</option>
            </select>
          </div>
          <div class="col-sm-2 risklog-date"
            style="{{ old('searchType') == 'Date' || old('searchType') == null ? 'display:block' : 'display:none' }}">
            <label for="riskLog_From" class="form-label">From Date</label>
            <div class="date-holder">
              <input type="text" class="form-control Gdate" value="{{ old('riskLog_From') }}" name="riskLog_From"
                id="riskLog_From" placeholder="dd-mm-yyyy">
              <img src="../img/calendar3.svg" class="dateimg" alt="date">
            </div>
            @error('riskLog_From')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror

          </div>
          <div class="col-sm-2 risklog-date"
            style="{{ old('searchType') == 'Date' || old('searchType') == null ? 'display:block' : 'display:none' }}">
            <label for="riskLog_To" class="form-label">To Date</label>
            <div class="date-holder">
              <input type="text" class="form-control Gdate" value="{{ old('riskLog_To') }}" name="riskLog_To"
                id="riskLog_To" placeholder="dd-mm-yyyy">

              <img src="../img/calendar3.svg" class="dateimg" alt="date">
            </div>
            @error('riskLog_To')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror

          </div>
          <div class="col-sm-2 riskLog-id" style="{{ old('searchType') == 'ID' ? 'display:block' : 'display:none' }}">
            <label for="" class="form-label">General ID</label>
            <input type="number" class="form-control" name="riskLog_searchID" value="{{ old('riskLog_searchID') }}"
              id="riskLog_id">
            @error('riskLog_searchID')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
          </div>

          <div class="col-sm-2">
            <select class="form-select" name="export_view" id="risklog_wantCategory"
              style="margin-top: 35px;background-color: #c4b20f">
              <option value="Export" {{ old('export_view')=='Export' ? 'selected' : '' }}>Export Risk Log</option>
              <option value="riskLog_view" {{ old('export_view')=='riskLog_view' ? 'selected' : '' }}>Only Risk log View
              </option>
            </select>
          </div>
          <input type="text" name="notice" value="RiskLogView" style="display: none">
          <div class="col-sm-2">
            <button class="btn btn-info" style="margin-top: 35px">Continue</button>
          </div>



        </div>

        @if ($final_log != null)
        <h1 class="header-text">Risk History</h1>
        <div class="row" style="text-align: center">
          <div class="col-sm-2">
            <h3>ID</h3>
          </div>
          <div class="col-sm-2">
            <h3>Change Date</h3>
          </div>
          <div class="col-sm-2">
            <h3>Old Risk</h3>
          </div>
          <div class="col-sm-2">
            <h3>Current Risk</h3>
          </div>
          <div class="col-sm-2">
            <h3>Due to Patient</h3>
          </div>
          <div class="col-sm-2">
            <h3>Change User</h3>
          </div>
        </div>
        @foreach ($final_log as $key => $item)
        @if (count($final_log[$key]) > 0)
        <div class="row">
          <div class="col-sm-2">
            <label for="" class="form-label">{{ $key }}</label>
          </div>
          <div class="col-sm-2">
            <select name="" class="form-control" id="change_date" onchange="risk_change_date()">
              <option value=""></option>
              @foreach ($item as $index => $item)
              <option value="{{ $index }}">{{ $index }}</option>
              @endforeach
            </select>
          </div>
          <div class="col-sm-2">
            <label for="" class="form-label" id="old_risk"></label>
          </div>
          <div class="col-sm-2">
            <label for="" class="form-label" id="current_risk"></label>
          </div>
          <div class="col-sm-2">
            <label for="" class="form-label" id="due_patient"></label>
          </div>
          <div class="col-sm-2">
            <label for="" class="form-label" id="change_user"></label>
          </div>
        </div>
        @endif
        @endforeach
        @endif
      </div>

    </form>
  </div>

  <div class="tab-pane" id="updateRiskLog">
    <section class="page-color container containers ">
      <div class="row">
        <div class="col-sm-3">
          <label for="" class="form-label">General ID</label>
          <input type="number" class="form-select" id="riskUpdateId">
        </div>
        <div class="col-sm-2"><button class="btn btn-info" style="margin-top: 35px"
            onclick="risklogSearch(this)">Search</button></div>
      </div>
      <div class="row pc">
        <div class="log-col">
          <label class="form-label">Change Date</labbel>
        </div>
        <div class="log-col">
          <label class="form-label">Main Risk <br> (old)</labbel>
        </div>
        <div class="log-col">
          <label class="form-label">Sub Risk<br>(old)</labbel>
        </div>
        <div class="log-col">
          <label class="form-label">Main Risk<br>(current)</labbel>
        </div>
        <div class="log-col">
          <label class="form-label">Main Risk<br>(current)</labbel>
        </div>
        <div class="logsmall-col">
          <label class="form-label">By Patient</labbel>
        </div>
        <div class="log-col">
          <label class="form-label">Update By</labbel>
        </div>
        <div class="log-col">

        </div>
      </div>
    </section>
  </div>


</div>

@endauth
<script type="text/javascript">
  var final_log = @json($final_log);
  let $searchIDLog;

  console.log(final_log);

  function riskLogType() {
    var search_riskType = $("#riskLog_searchType").val();
    if (search_riskType == "Date") {
      $(".riskLog-id").hide();
      $("#riskLog_id").val("");
      $(".risklog-date").show();


    } else if (search_riskType == "ID") {
      $(".risklog-date").hide();
      $("#riskLog_From,#riskLog_To").val("");
      $(".riskLog-id").show();
    }

  }

  function risk_change_date() {
    var changeDate = $(event.target).val();
    var gid = $(event.target).parent().parent().children().eq(0).find("label").text();
    if (changeDate.length > 5) {
      $(event.target)
        .parent()
        .parent()
        .children().eq(2) // Use eq(2) to get the third child
        .find('.form-label') // Assuming the label has a class "form-label"
        .text(final_log[gid][changeDate]["Old Risk"]);
      $(event.target)
        .parent()
        .parent()
        .children().eq(3)
        .find('.form-label')
        .text(final_log[gid][changeDate]["Current Risk"]);
      $(event.target)
        .parent()
        .parent()
        .children().eq(4) // Use eq(2) to get the third child
        .find('.form-label') // Assuming the label has a class "form-label"
        .text(final_log[gid][changeDate]["Due_to_patient"]);
      $(event.target)
        .parent()
        .parent()
        .children().eq(5) // Use eq(2) to get the third child
        .find('.form-label') // Assuming the label has a class "form-label"
        .text(final_log[gid][changeDate]["change_user"]);
    } else {
      $(event.target)
        .parent()
        .parent()
        .children().filter(function(index) {
          return index >= 2 && index <= 5; // Filter elements with indices 2, 3, 4, and 5
        })
        .find('.form-label') // Assuming the label has a class "form-label"
        .text("");
    }
  }

  function risklogSearch(button) {
    let riskLogUpdate = {
      generalID: $("#riskUpdateId").val(),
      notice: "RiskLogUpdate",
    };
    console.log(riskLogUpdate);
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
      },
    });
    $.ajax({
      type: 'POST',
      url: "{{ route('risk_log_data') }}",
      dataType: 'json',
      contentType: 'application/json',
      data: JSON.stringify(riskLogUpdate),
      timeout: 10000,
      beforeSend: function() {
        // Set a timeout to show the loading div after 3 seconds
        $(button).prop("disabled", true);
        timeoutHandle = setTimeout(function() {

          $("#loadingSpinner").css("opacity", 1).addClass("spinner");
          $(".tab-content").css("opacity", 0.3);
          $(".tab-content").addClass("freeze-body");
        }, 3000);
      },
      success: function(response) {
        $(button).prop("disabled", false);
        clearTimeout(timeoutHandle);

        console.log(response[riskLogUpdate["generalID"]]);
        let count = 0;
        $("section .row:nth-child(n+3)").remove();
        $.each(response[riskLogUpdate["generalID"]], function(index, value) {
          let changeDate = index.split('-');
          if (changeDate.length > 3) {
            index = changeDate[0] + "-" + changeDate[1] + "-" + changeDate[2];
          }

          riskLogview = $("<div id='" + index + "' class='row loghistory-row'>")
            .append($("<div class='tablet log-col'>")
              .append($("<label class='form-label'>").attr({
                class: "form-label",
              }).text("Change Date")))
            .append($("<div class='log-col'>").append($("<div>")
              .append($("<div>").attr({
                  class: "date-holder"
                }).append($("<input>")
                  .attr({
                    id: "date" + count,
                    class: "form-control Gdate",
                    name: "riskChangeDate",
                    placeholder: "dd-mm-yyyy",
                    onchange: "dateformatValid()"
                  }).val(index))
                .append($("<img>").attr({
                  src: "../img/calendar3.svg",
                  class: "dateimg",
                  alt: "date",
                  onclick: "dateCalender()"
                }))
              )))
            .append($("<div class='tablet log-col'>")
              .append($("<label class='form-label'>").attr({
                class: "form-label",
              }).text("Main Risk(old)")))
            .append($("<div class='log-col'>").append($("<select>")
              .attr({
                class: 'form-select mainriskblock' + count,
                id: 'oldrisk' + count,
                name: "mainRiskOld",
                onchange: 'subRiskCreate(' + '"subriskold' + count + '","#oldrisk' + count + '")'
              }).val(value["Old Risk"])))
            .append($("<div class='tablet log-col'>")
              .append($("<label class='form-label'>").attr({
                class: "form-label",
              }).text("Sub Risk(old)")))
            .append($("<div class='log-col'>").append($("<select>")
              .attr({
                class: 'form-select subriskold' + count,
                name: "subRiskOld",
                id: 'oldsub' + count,
              }).val(value["Old Sub Risk"])))
            .append($("<div class='tablet log-col'>")
              .append($("<label class='form-label'>").attr({
                class: "form-label",
              }).text("Main Risk(current)")))
            .append($("<div class='log-col'>").append($("<select>")
              .attr({
                class: 'form-select mainriskblock' + count,
                id: "currentmain" + count,
                name: "mainRiskCurrent",
                onchange: 'subRiskCreate(' + '"subriskcurrent' + count + count + '","#currentmain' + count + '")'
              }).val(value["Current Risk"])))
            .append($("<div class='tablet log-col'>")
              .append($("<label class='form-label'>").attr({
                class: "form-label",
              }).text("Sub Risk(current)")))
            .append($("<div class='log-col'>").append($("<select>")
              .attr({
                class: 'form-select subriskcurrent' + count + count,
                name: 'subRiskCurrent',
                id: 'currentsub' + count,
              }).val(value["Current Sub Risk"])))
            .append($("<div class='tablet log-col'>")
              .append($("<label class='form-label'>").attr({
                class: "form-label",
              }).text("By Patient")))
            .append($("<div class='logsmall-col'>").append($("<span>").attr({
              class: "form-control",
              name: "duetoPatient",
            }).text(value["Due_to_patient"])))
            .append($("<div class='tablet log-col'>")
              .append($("<label class='form-label'>").attr({
                class: "form-label",
              }).text("Update By")))
            .append($("<div class='log-col'>").append($("<label>").attr({
              class: "form-label",
              name: "changeUser",
            }).text(value["change_user"])))

            .append($("<div class='log-col'>").append($("<button>").attr({
              class: "btn btn-danger",
              onclick: "DeleteLog()",
              id: "DeleteLog" + count,
            }).text("DeleteLog")))

          $("section").append(riskLogview);
          mainRiskCreate("mainriskblock" + count);
          $('#oldrisk' + count).val((value["Old Risk"]))
          $('#currentmain' + count).val((value["Current Risk"]))
          subRiskCreate("subriskold" + count, '#oldrisk' + count)
          subRiskCreate("subriskcurrent" + count + count, '#currentmain' + count)
          $('#currentsub' + count).val((value["Current Sub Risk"]))
          $('#oldsub' + count).val((value["Old Sub Risk"]))
          count++;
        });
        //$("table tr td span, table tr td  select, table tr td input,table tr td button").css("margin-top", "5px");
        $("section").append(
          $("<div class='row' style='justify-content:center'>").append(
            $("<div class='col-sm-2' >").append(
              $("<button class='btn btn-info' onclick='updateRiskLog(this)'>").text("UpdateRiskLog")
            )
          )
        );
        $("#currentmain" + (count - 1) + ',#currentsub' + (count - 1) + ",#DeleteLog" + (count - 1)).prop("disabled", true);
        console.log("#currentmain" + (count - 1));
        $searchIDLog = riskLogUpdate["generalID"];


      }
    })

  }

  function DeleteLog() {
    $(event.target).parent().parent().remove();
  }

  function updateRiskLog(button) {
    let counting = 0;
    let riskLogUpdate = {
      riskFinaldata: {}
    };

    $(".loghistory-row").each(function(index) {
      riskLogUpdate['riskFinaldata'][counting] = {};

      $(this).find("input, span, select").each(function() {
        if ($(this).is('input, select')) {
          if ($(this).hasClass("Gdate")) {
            riskLogUpdate['riskFinaldata'][counting][$(this).attr("name")] = formatDate($(this).val());
          } else {
            riskLogUpdate['riskFinaldata'][counting][$(this).attr("name")] = $(this).val();
          }
        } else {
          riskLogUpdate['riskFinaldata'][counting][$(this).attr("name")] = $(this).text();
        }
      });
      counting++;

    });



    riskLogUpdate["notice"] = "Updating Risk Log";
    riskLogUpdate["generalID"] = $searchIDLog;
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
      },
    });
    $.ajax({
      type: 'POST',
      url: "{{ route('risk_log_data') }}",
      dataType: 'json',
      contentType: 'application/json',
      data: JSON.stringify(riskLogUpdate),
      timeout: 10000,
      beforeSend: function() {
        // Set a timeout to show the loading div after 3 seconds
        $(button).prop("disabled", true);
        timeoutHandle = setTimeout(function() {

          $("#loadingSpinner").css("opacity", 1).addClass("spinner");
          $(".tab-content").css("opacity", 0.3);
          $(".tab-content").addClass("freeze-body");
        }, 3000);
      },
      success: function(response) {
        $(button).prop("disabled", false);
        clearTimeout(timeoutHandle);
        console.log(response);
        alert("Successfull Risk History Update")
      }
    })
  }
</script>
@endsection
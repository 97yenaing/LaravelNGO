@extends('layouts.app')
@section('content')
<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('js/jquery-ui.min.js')}}"></script>
@auth
<form action="{{ route('risk_log_data') }}" method="post" class="container containers">
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
        style="{{ old('searchType') == 'Date'||old('searchType') == null ? 'display:block' : 'display:none' }}">
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
        style="{{ old('searchType') == 'Date' ||old('searchType') == null ? 'display:block' : 'display:none' }}">
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
      <div class="col-sm-2 riskLog-id" style="{{old('searchType') == 'ID' ? 'display:block' : 'display:none' }}">
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

      <div class="col-sm-2">
        <button class="btn btn-info" style="margin-top: 35px">Continue</button>
      </div>


    </div>

    @if ($final_log!=null)

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
    @foreach ($final_log as $key=> $item)

    <div class="row">
      <div class="col-sm-2">
        <label for="" class="form-label">{{$key}}</label>
      </div>
      <div class="col-sm-2">
        <select name="" class="form-select" id="change_date" onchange="risk_change_date()">
          <option value=""></option>
          @foreach ($item as $index=> $item)
          <option value="{{$index}}">{{$index}}</option>
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
    @endforeach


    @endif
  </div>

</form>
@endauth
@endsection
{{-- <script src="resources/views/RiskHistory/risk_histroy.js" defer>
  --}}
<script type="text/javascript">

  var final_log=@json($final_log);
  console.log(final_log);
  function riskLogType(){
   var search_riskType=$("#riskLog_searchType").val();
   if(search_riskType=="Date"){
    $(".riskLog-id").hide();
    $("#riskLog_id").val("");
    $(".risklog-date").show();
   

   }else if(search_riskType=="ID"){
    $(".risklog-date").hide();
    $("#riskLog_From,#riskLog_To").val("");
    $(".riskLog-id").show();
   }

  }
  function risk_change_date(){
    var changeDate=$(event.target).val();
    var gid=$(event.target).parent().parent().children().eq(0).find("label").text();
    if(changeDate.length>5){
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
    }else{
      $(event.target)
      .parent()
      .parent()
      .children().filter(function(index) {
          return index >= 2 && index <= 5; // Filter elements with indices 2, 3, 4, and 5
      })
      .find('.form-label') // Assuming the label has a class "form-label"
      .text("");
    }
    


    console.log(gid);
  }
</script>
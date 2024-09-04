<!DOCTYPE html>
@extends('layouts.app')
  
@section('content')
@auth
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>All Export data</title>
</head>
<body>
  <form action={{ route('all_export') }} method="post">
    @csrf
    <div class="page-color containers container">
      <h1 class="header-text">All Data Export Section</h1>
      <div class="row">
        <div class="col-sm-2">
          <label for="" class="form-label">Export Type</label>
          <select name="road" id="type_choice" class="form-select" onchange="complete_fun()">
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
        <div class="col-sm-2" id="other_block" style="display: none">
          <label for="" class="form-label" id="other"></label>
          <select name="" id="other_type" class="form-select">
          </select>
        </div>
        <div class="col-sm-2">
          <label for="" class="form-label">From Date</label>
          <div class="date-holder">
            <input type="text" id="ddFrom" class="form-control Gdate" name="" placeholder="dd-mm-yyyy">
            <img src="../img/calendar3.svg" class="dateimg" alt="date">
          </div>
        </div>
        <div class="col-sm-2">
          <label for="" class="form-label">To Date</label>
          <div class="date-holder">
            <input type="text" id="ddTo" class="form-control Gdate" name="" placeholder="dd-mm-yyyy">
            <img src="../img/calendar3.svg" class="dateimg" alt="date">
          </div>
        </div>
        <div class="col-sm-2">
          <button class="btn btn-info" style="margin-top: 35px">Export</button>
        </div>

        

      </div>
      <input type="text" value="hello" id="target" name="Target" style="display: none">
      <input type="text" value="hi" id="notice" name="notice" style="display: none">
    </div>
    
  </form>
@endauth
@endsection
</body>
</html>
<script type="text/javascript">
  function complete_fun(){
    let type=$("#type_choice").val();
    let test,test_name;
    console.log(type);
    switch (type) {
      case "0"://Reception
      case "3": //Sti
        $("#ddFrom").attr('name','Datefrom');
        $("#ddTo").attr('name','Dateto');
        $("#target").val("export");
        $("#notice").val("");
        $("#other_block").hide();
        $("#other_type").attr("name","")
        if(type=="3"){
          $("#other_block").show();
          $("#other_type").attr("name","sex");
          $("#other").text("Gender");
          test=['Male','Female']
          $("#other_type").empty();
          test.forEach(function(value, index) {
            var option = $("<option value='" + value + "'>" + value + "</option>");
            $("#other_type").append(option);
          });
        }
        break;
      case "1"://Lab
        $("#ddFrom").attr('name','dateFrom');
        $("#ddTo").attr('name','dateTo');
        $("#target").val("export");
        $("#notice").val("");
        $("#other_block").show();
        $("#other_type").attr("name","testNN");
        $("#other").text("Test Type");
        test=['hiv','rpr','sti','hep_bc','urine','oi','general','stool','afb','covid19','viral'];
        test_name=['HIV Test','RPR Test','STI Test','Hep B/C Test','Urine Test','OI Test','General Test','Stool Test','AFB Test','Covid Test','Viral Load Test']
        $("#other_type").empty();
        test.forEach(function(value, index) {
          var option = $("<option value='" + value + "'>" +test_name[index] + "</option>");
          $("#other_type").append(option);
        });
        break;
      case "2"://Counsellor
        $("#ddFrom").attr('name','dateFrom');
        $("#ddTo").attr('name','dateTo');
        $("#target").val("export_starter");
        $("#notice").val("");
        $("#other_block").show();
        $("#other_type").attr("name","hts_coul");
        $("#other").text("Counselling Type");
         test=["counsel_data","hts_data"]
         test_name=['Counselling','HTS']
        $("#other_type").empty();
        test.forEach(function(value, index) {
          var option = $("<option value='" + value + "'>" +test_name[index]+ "</option>");
          $("#other_type").append(option);
        });
        break;
      case "4"://Prevention
        $("#ddFrom").attr('name','ddFrom');
        $("#ddTo").attr('name','ddTo');
        $("#target").val("export");
        $("#notice").val("");
        $("#other_block").show();
        $("#other_type").attr("name","tb_name");
        $("#other").text("Export Type");
         test=["log_sheet","cbs","confid"]
         test_name=['Log Sheet','CBS','Confidential']
        $("#other_type").empty();
        test.forEach(function(value, index) {
          var option = $("<option value='" + value + "'>" +test_name[index]+ "</option>");
          $("#other_type").append(option);
        });
        break;
      case "5": //Cervical Cancer
        $("#ddFrom").attr('name','cc_dateFrom');
        $("#ddTo").attr('name','cc_dateTo');
        $("#target").val("cc_data");
        $("#notice").val("Export_Cancer");
        $("#other_block").hide();
        $("#other_type").attr("name","");
        break;
      case "6": //CMV
        $("#ddFrom").attr('name','cmv_dateFrom');
        $("#ddTo").attr('name','cmv_dateTo');
        $("#target").val("CMV");
        $("#notice").val("cmv Export");
        $("#other_block").hide();
        $("#other_type").attr("name","");
        break;
      case "7"://NCD
        $("#ddFrom").attr('name','ncd_dateFrom');
        $("#ddTo").attr('name','ncd_dateTo');
        $("#target").val("ncdRegister_data");
        $("#notice").val("NCD Export");
        $("#other_block").show();
        $("#other_type").attr("name","ncd_exportType");
        $("#other").text("NCD Export Type");
         test=["Register","Follow up"]
         test_name=['NCD Register','NCD Follow up']
        $("#other_type").empty();
        test.forEach(function(value, index) {
          var option = $("<option value='" + value + "'>" + test_name[index] + "</option>");
          $("#other_type").append(option);
        });
        break;
      case "8": //TB03
        $("#ddFrom").attr('name','dateFrom');
        $("#ddTo").attr('name','dateTo');
        $("#target").val("Tb03");
        $("#notice").val("TB 03 Export");
        $("#other_block").hide();
        $("#other_type").attr("name","");
        break;
      case "9": //Pre TB
        $("#ddFrom").attr('name','dateFrom');
        $("#ddTo").attr('name','dateTo');
        $("#target").val("preTB_Assement");
        $("#notice").val("Export PreTB");
        $("#other_block").hide();
        $("#other_type").attr("name","");
        break;
      case "10": //TB IPT
        $("#ddFrom").attr('name','dateFrom');
        $("#ddTo").attr('name','dateTo');
        $("#target").val("TBIPT");
        $("#notice").val("Export IPT");
        $("#other_block").hide();
        $("#other_type").attr("name","");
        break;
      
      default:
        $("#ddFrom").attr('name','').val("");
        $("#ddTo").attr('name','').val("");
        $("#target").val("");
        $("#notice").val("");
        $("#other_block").hide();
        $("#other_type").empty();
        $("#other_type").attr("name","");
        break;
    }

  }
</script>
@extends('layouts.app')

@section('content')
@auth
<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('js/jquery-ui.min.js')}}"></script>
<script src="{{asset('js/dispencing.js')}}"></script>

<div id="Dispencing_report" class="tab-pane container containers page-color clearfix">
        <div class="header-text dis-reportHeader">
          <h2>Consumption Report</h2>
          <select class="form-select condome-report" id="condome_rp" name="">
            <option value=""></option>
            <option value="maleCon" sletcted="">Male condom</option>
            <option value="femaleCon">female condom</option>
          </select>
        </div>
        <div id="dis_exportDate">
          <div class="dis-exportData">
            <div class="row">
              <div class="col-sm-7">
                <select name="" id="dis_rp_type" class="form-select">
                  <option value="only-patient">Only Patient</option>
                  <option value="Clinic Out">Clinic Out</option>
                  <option value="Expired Out">Expired Out</option>
                  <option value="Damage Out">Damage Out</option>
                  <option value="Donation Out">Donation Out</option>
                  <option value="Other Patient">Other Patient</option>
                  <option value="Other">Other</option>
                  <option value="Family Planning">Family Planning</option>
                  <option value="All">All use</option>
                </select>
              </div>
              <div class="col-sm-5">
                <select class="form-select medicother_select" id="rp_clinic_find" style="margin-top: 0px;display:none">
                  <option value="HTY-C2(81)">HTY-C2(81)</option>
                  <option value="HTY-A(71)">HTY-A(71)</option>
                  <option value="HTY-B(72)">HTY-B(72)</option>
                  <option value="SPT(73)">SPT(73)</option>
                  <option value="Winka(75)">Winka(75)</option>
                  <option value="TBZY(76)">TBZY(76)</option>
                  <option value="PTO-DT(77)">PTO-DT(77)</option>
                  <option value="PTO-MCB(78)">PTO-MCB(78)</option>
                  <option value="Hpakant(80)">Hpakant(80)</option>
                  <option value="Taze(82)">Taze(82)</option>
                  <option value="HTY-C1(83)">HTY-C1(83)</option>
                  <option value="Aye Nyein Myintar">Aye Nyein Myintar</option>
                  <option value="Lotus">Lotus</option>
                  <option value="MMTN">MMTN</option>
                  <option value="BAHAN">BAHAN</option>
                  <option value="Lab">Lab</option>
                  <option value="SDG">SDG</option>
                  <option value="TLL">TLL</option>
                  <option value="BKKe">BKKe</option>
                </select>
              </div>
              
            </div>
            <div class="row">
              <div class="col-md-12">
                  <label class="form-label">From-Date</label>
                  <div class="date-holder">
                    <input type="text" id="dis_fromDate" class="form-control Gdate" placeholder="dd-mm-yyyy">
                    <img src="../img/calendar3.svg" class="dateimg" alt="date">
              	 </div>
              </div>
            </div>
            
            <div class="row">
              <div class="col-md-12">
                  <label class="form-label">To-Date</label>
                  <div class="date-holder">
                    <input type="text" id="dis_toDate" class="form-control Gdate" placeholder="dd-mm-yyyy">
                    <img src="../img/calendar3.svg" class="dateimg" alt="date">
              	 </div>
              </div>
            </div>
            
            <div class="row">
              <div class="col-sm-12 clearfix" id="dis_countLabelBtn">
                  <button class="btn btn-dark dis-exportBtn" onclick="dis_report()">Report</button>
                  <label class="form-label" id="dis_exportCount"></label>
              </div>
            </div>
            
          </div>
        </div>
        <div id="expord_data">
          <div class="row">
            <div class="col-sm-12">
              <input type="text" id="search_rp_data" class="form-control" onchange="search_rp_item()">
            </div>
            </div>
           
          <div class="row export-row no-margin" id="export_Header">
            <div class="col-sm-1 no-margin">No.</div>
            <div class="col-sm-9 no-margin">Medical Items</div>
            <div class="col-sm-2 no-margin">Qty</div>
          </div>

        </div>
        <div id="report_detail" class="report-detail">
          <div class="header-text" id="rp_medicName"></div>
          <div class="row no-margin" style="justify-content:center;">
            <div class="col-sm-1 rp-detailhead no-margin">No.</div>
            <div class="col-sm-2 rp-detailhead no-margin">General ID</div>
            <div class="col-sm-2 rp-detailhead no-margin">FuchiaID</div>
            <div class="col-sm-2 rp-detailhead no-margin">Risk</div>
            <div class="col-sm-2 rp-detailhead no-margin">Given Date</div>
            <div class="col-sm-2 rp-detailhead no-margin">Quantity</div>
          </div>
        </div>
        <div id="reportCon_detail" class="reportCon-detail">
          <div class="header-text" id="rp_ConName"></div>
          <div class="row no-margin" style="justify-content:center;">
            <div class="col-sm-1 rp-detailhead no-margin">No.</div>
            <div class="col-sm-2 rp-detailhead no-margin">Risk</div>
            <div class="col-sm-2 rp-detailhead no-margin">Total</div>
          </div>
        </div>
</div>
@endauth
@endsection
<script type="text/javascript">
let  itemsArray = @json($items);
let reportDeatail;let condomeList=[]; let  condomeMale={},condomeFemale={};
function dis_report(){
  var dis_from=formatDate($("#dis_fromDate").val());
  var dis_to=formatDate($("#dis_toDate").val());
  var startDate=new Date(dis_from);
  var endDate=new Date(dis_to);
  var timeDiff= endDate.getTime()-startDate.getTime();
  var daysDiff = Math.floor(timeDiff / (1000 * 3600 * 24))+1;
  var rp_type=$("#dis_rp_type").val();
  if(rp_type=="Clinic Out"){
    rp_type=$("#rp_clinic_find").val();
  }
  $(".export-rowData").remove();
  $("#condome_rp").hide();
  if(daysDiff<32 && daysDiff>0){
    $("#dis_exportCount").text(daysDiff+"Days Report")
    var dis_export_data={
      notice:"Report_data",
      dis_from:dis_from,
      dis_to:dis_to,
      rp_type:rp_type,
    }
    console.log(dis_export_data);
    $.ajaxSetup({
                  headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                }
    });
    $.ajax({
        type:'POST',
        url:"{{route('dispencing_data')}}",
        dataType:'json',
        contentType: 'application/json',
        data: JSON.stringify(dis_export_data),
        success:function(response){
          console.log(response)
          reportDeatail=response[1]
          to_search=response[0];
          console.log(Object.keys(response[0]).length);
          if(Object.keys(response[0]).length>0){
            var number=1;var conorder=0
            keys = [];
            values = [];
            $("#search_rp_data").val("");
            
            
            $.each(response[0], function(key, value) {
              keys.push(key);
              values.push(value);
            })
            for(var i=0;i<keys.length;i++){
              if(keys[i]==300||keys[i]==304){
                condomeList[keys[i]]=response[1][keys[i]];
              }
                var medic_exlist=$("<div>").attr({class:"row export-rowData no-margin",id:"export_row"+keys[i],})
                              .append($("<div>").attr({class:"col-sm-1 no-margin"}).text(number))
                              .append($("<div>").attr({class:"col-sm-9 medic-reponame no-margin"}).text(itemsArray[keys[i]]["Medic_item"])
                              .append($("<button>").attr({class:"btn medictake-patient",id:"medic_takeList"+keys[i],onclick:"takerList()"}).text("Detail")))
                              .append($("<div>").attr({class:"col-sm-2 no-margin"}).text(values[i]));
                $("#expord_data").append(medic_exlist);
                number++;
              
            
            }
           
            console.log(condomeList+"condome List")//using condome
            if(condomeList.length>0){
                $("#condome_rp").show();
                var ckeys=[],ckeys300=[],ckeys304=[]; var cvalues=[],cvalues300=[],cvalues304=[];
              if(Object.keys(condomeList).length>0){
                $.each(Object.keys(condomeList),function(key,value){
                  ckeys.push(key);
                  cvalues.push(value);

                });
              
                if(condomeList.hasOwnProperty(300)){
                  $.each(Object.keys(condomeList[300]),function(key,value){
                  ckeys300.push(key);
                  cvalues300.push(value);
                 });
                }
                if(condomeList.hasOwnProperty(304)){
                  $.each(Object.keys(condomeList[304]),function(key,value){
                  ckeys304.push(key);
                  cvalues304.push(value);
                 });
                }
                $.each(condomeMale, function(Name, Value) {
                  // Set the property value to 0
                  condomeMale[Name] = 0;
                });
                $.each(condomeFemale, function(Name, Value) {
                  // Set the property value to 0
                  condomeFemale[Name] = 0;
                });
                

                condomeMale["Other"]=0;
                condomeFemale["Other"]=0;
                
                for(var cdome=0;cdome<ckeys.length;cdome++){
                  roNo=cvalues[cdome]; // getting No.of condome
                 
                 // creating one arry name to add 
                  for(var cdCount=0;cdCount<Object.keys(condomeList[cvalues[cdome]]).length;cdCount++){
                    if(roNo=="300"){
                      var dis_Risk=condomeList[cvalues[cdome]][cvalues300[cdCount]]["Main Risk"]
                      console.log(dis_Risk);
                      console.log("hell male")
                        if(dis_Risk!="-" && dis_Risk !="Invalid value"){
                            if (condomeMale.hasOwnProperty(dis_Risk)) {
                              console.log("has risk ok");
                               condomeMale[dis_Risk]+=Number(condomeList[cvalues[cdome]][cvalues300[cdCount]]["Use"])
                              
                            } else {
                                // The number does not exist in the array
                                condomeMale[dis_Risk]=Number(condomeList[cvalues[cdome]][cvalues300[cdCount]]["Use"])
                            }
                        }else{
                            if($.isNumeric(condomeList[cvalues[cdome]][cvalues300[cdCount]]["Pid"])){
                              if (condomeMale.hasOwnProperty("Undefined_Risk")) {
                                condomeMale["Undefined_Risk"]+=Number(condomeList[cvalues[cdome]][cvalues300[cdCount]]["Use"])
                              } else {
                                // The number does not exist in the array
                                condomeMale["Undefined_Risk"]=Number(condomeList[cvalues[cdome]][cvalues300[cdCount]]["Use"])
                              }
                             
                            }else{
                              condomeMale["Other"]+=Number(condomeList[cvalues[cdome]][cvalues300[cdCount]]["Use"])
                            }
                            
                            }
                    }else if(roNo=="304"){
                        var dis_Risk=condomeList[cvalues[cdome]][cvalues304[cdCount]]["Main Risk"]
                        if(dis_Risk!="-" && dis_Risk !="Invalid value"){
                            if (condomeFemale.hasOwnProperty(dis_Risk)) {
                              condomeFemale[dis_Risk]+=Number(condomeList[cvalues[cdome]][cvalues304[cdCount]]["Use"])
                              console.log("has risk ok")
                            } else {
                                // The number does not exist in the array
                                condomeFemale[dis_Risk]=Number(condomeList[cvalues[cdome]][cvalues304[cdCount]]["Use"])
                            }
                          }else{
                            if($.isNumeric(condomeList[cvalues[cdome]][cvalues304[cdCount]]["Pid"])){
                              if (condomeFemale.hasOwnProperty("Undefined_Risk")) {
                                condomeFemale["Undefined_Risk"]+=Number(condomeList[cvalues[cdome]][cvalues304[cdCount]]["Use"])
                              } else {
                                // The number does not exist in the array
                                condomeFemale["Undefined_Risk"]=Number(condomeList[cvalues[cdome]][cvalues304[cdCount]]["Use"])
                              }
                             
                            }else{
                              condomeFemale["Other"]+=Number(condomeList[cvalues[cdome]][cvalues304[cdCount]]["Use"])
                            }
                            
                            }
                    }
                   
                  } 
                }
              }
            }else{
              $("#condome_rp").hide();
            }
          }else {
            alert("Don't use medical item in these days")
           
          }
        }
    })
  }else{
    alert("Your Report Days is Greather than 31 Days or less than 1")
  }

}
function takerList(){
  $("#condome_rp").prop("disabled",true);
  var medic_detailId=$(event.target).attr("id").match(/\d+/)[0];
  console.log(medic_detailId);
  console.log(reportDeatail)
  $("#dis_exportDate,#expord_data").hide();
  $("#report_detail").show();
  $("#rp_medicName").text(itemsArray[medic_detailId]["Medic_item"]);

  var keys = [];
  var values = [];
  $.each(reportDeatail[medic_detailId], function(key, value) {
    keys.push(key);
    values.push(value);
  })
  for(var rp=0;rp<keys.length;rp++){
    var rp_take=$("<div>").attr({class:"row no-margin rpDetail_row"}).css("justify-content","center")
    .append($("<div>").attr({class:"col-sm-1 no-margin rpDetail_data"}).text(rp+1))
    .append($("<div>").attr({class:"col-sm-2 no-margin rpDetail_data"}).text(reportDeatail[medic_detailId][keys[rp]]["Pid"]))
    .append($("<div>").attr({class:"col-sm-2 no-margin rpDetail_data"}).text(reportDeatail[medic_detailId][keys[rp]]["FuchiaID"]))
    .append($("<div>").attr({class:"col-sm-2 no-margin rpDetail_data"}).text(reportDeatail[medic_detailId][keys[rp]]["Main Risk"]))
    .append($("<div>").attr({class:"col-sm-2 no-margin rpDetail_data"}).text(reportDeatail[medic_detailId][keys[rp]]["GivenDate"]))
    .append($("<div>").attr({class:"col-sm-2 no-margin rpDetail_data"}).text(reportDeatail[medic_detailId][keys[rp]]["Use"]));
    $("#report_detail").append(rp_take);
  }
  $("#report_detail").append($("<div>").attr({class:"row no-margin rpDetail_row"}).css("justify-content","center")
  .append($("<div>").attr({class:"col-sm-2 rpDetail_btnRow"})
  .append($("<button>").attr({class:"btn refresh-follow",id:"to_report",onclick:"toreport()"}).text("To Report"))));
  

  console.log(keys)

}
function toreport(){
  console.log("hide is here");
  $("#report_detail").hide();
  $("#dis_exportDate,#expord_data").show();
  $("#rp_medicName").empty();
  $(".rpDetail_row").remove();
  $("#condome_rp").prop("disabled",false);
}

function search_rp_item(){
  var serach_item=$("#search_rp_data").val()
  if(Object.keys(to_search).length>1){
    keys = [];
    values = [];
    report_medic_name=[];
    number=1;
            
            
    $.each(to_search, function(key, value) {
      keys.push(key);
      values.push(value);
    })
    console.log(values);
    $.each(keys,function(index,value){
      report_medic_name[value]=itemsArray[value]["Medic_item"];
    })

    console.log(report_medic_name);
    console.log(serach_item);
    medicine_listName=[];
    report_medic_name.filter(function(item,index){
      medicine_list[index]= item.toLowerCase().includes(serach_item.toLowerCase());
        if(medicine_list[index]==true){
            medicine_listName[index]=item;
        }
    })
    console.log(medicine_listName);
    $(".export-rowData").remove();

    $.each(medicine_listName,function(index,value){
     if(value!=null){
      var medic_exlist=$("<div>").attr({class:"row export-rowData no-margin",id:"export_row"+index,})
                              .append($("<div>").attr({class:"col-sm-1 no-margin"}).text(number))
                              .append($("<div>").attr({class:"col-sm-9 medic-reponame no-margin"}).text(value)
                              .append($("<button>").attr({class:"btn medictake-patient",id:"medic_takeList"+index,onclick:"takerList()"}).text("Detail")))
                              .append($("<div>").attr({class:"col-sm-2 no-margin"}).text(to_search[index]));
      $("#expord_data").append(medic_exlist);
      number++;
     }
      
    })

  }
  

}
</script>

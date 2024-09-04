@extends('layouts.app')

@section('content')
@auth
<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('js/jquery-ui.min.js')}}"></script>
<script src="{{asset('js/dispencing.js')}}"></script>
<p class="btn-gnavi">
  <span></span>
  <span></span>
  <span></span>
</p>

<div class="container containers page-color">
  <ul class="nav nav-tabs toggle dispencing_ul" id="hidden-title">
    <li class="nav-item">
      <a class="nav-link active toggle-link" data-toggle="tab" href="#comsumption_section" onclick="">Daily
        Consumption</a>
    </li>
    <li class="nav-item">
      <a class="nav-link toggle-link " data-toggle="tab" href="#Dispencing_stock" onclick="">Stock</a>
    </li>
    <li class="nav-item">
      <a class="nav-link toggle-link " data-toggle="tab" href="#Medical_add">Medical Item Add</a>
    </li>
    <li class="nav-item">
      <a class="nav-link toggle-link " data-toggle="tab" href="#consumption_data">Consumption Data</a>
    </li>
    <li class="nav-item">
      <a class="nav-link toggle-link " data-toggle="tab" href="#medical_entry">Stock Add List</a>
    </li>

  </ul>
  <div class="tab-content containers">
    <div id="comsumption_section" class="tab-pane active">
      <div class="header-text consum-header">
        <h2>Consumption Section</h2>
        <button class="btn btn-success dis-SerachBtn save-batton" id="search_update">To Edit</button>
        <select class="form-select medic_othercon" id="consumtype" name="">
          <option value="Patient" sletcted="">Patient</option>
          <option value="Clinic Out">Clinic Out</option>
          <option value="Expired Out">Expired Out</option>
          <option value="Damage Out">Damage Out</option>
          <option value="Donation Out">Donation Out</option>
          <option value="Other Patient">Other Patient</option>
          <option value="Other">Other</option>
        </select>
      </div>

      <div class="consumption-Info">
        <div class="row dis-comsumMenu">
          <div class="col-md-2" id="mid_block">
            <input type="text" class="form-control" autofocus id="mid" placeholder="General ID or Fuchia ID">
          </div>
          <div class="col-sm-2">
            <label for="validationCustom01" class="form-label">Visit Date</label>
            <!-- <input id="vDate" type="date" value="" class="form-control"  > -->
            <div class="date-holder">
              <input type="text" id="vDate" class="form-control Gdate" placeholder="dd-mm-yyyy">
              <img src="../img/calendar3.svg" class="dateimg" alt="date">
            </div>
          </div>
          <div class="col-md-1">
            <button class="btn btn-warning update-batton" id="dispensing_search" onclick="ptData()">Search</button>
          </div>
          <div class="col-sm-2">
            <label for="validationCustom01" class="form-label">Nurse Name</label>
            <select class="form-control" id="nurse_name">
              <option value=""></option>
              <option value="nurse1">Nurse 1</option>
              <option value="nurse2">Nurse 2</option>
              <option value="nurse3">Nurse 3</option>
              <option value="nurse4">Nurse 4</option>
              <option value="nurse5">Nurse 5</option>
            </select><br>
          </div>


          <div class="col-md-3 dis-saveRefresh">
            <button class="btn btn-success refresh-follow consulor-rfr-btn" onclick="refresh()">Refresh</button>
            <button class="btn btn-success dis-saveBtn save-batton" id="dis_save" onclick="dispencing_saveUpdate()"
              disabled="true">save</button>
            <button class="btn btn-success dis-saveBtn save-batton" id="dis_update" onclick="dispencing_saveUpdate()"
              style="display:none">Updated</button>
          </div>
        </div>

        <div class="row">
          <div class="col-md-2">
            <select class="form-control" id="medic_risk">
              <option selected="" value="-">Risk show</option>
              <option value="-"></option>
              <option id="preg_mom" value="Pregnant Mother">Pregnant Mother</option>
              <option id="sp_preg_mom" value="Spouse of pregnant mother">Spouse of pregnant mother</option>
              <option id="" value="Exposed Children">Exposed Children</option>
              <option id="" value="Low Risk">Low Risk</option>
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
            </select>
          </div>
          <div class="col-md-10 consumtion_ptspan">
            <span class="form-control" id="comsum_generalInfo"></span>
          </div>

        </div>

        <div class="row" id="medic_check">
          <div class="col-md-5" id="medicine_show">
            <label class="form-label" for="">Search Medicine Name</label>
            <input type="text" class="form-control" id="medicine_name" />
          </div>
          <div class="col-md-7">
            <div class="medic_area"></div>
          </div>
        </div> <!-- General -->
        <div id="saveQuantity" style="display:none">
          <div class="save-quantity" id="saveQuantityList">
            <h3 calss="header-text">You need to fill quantity.</h3>

          </div>
        </div>

      </div>
      <div class="medic-searchUpdate freeze-body">
        <div class="row">
          <div class="col-sm-2">
            <select class="form-select consmumUp-other" id="consumUptype" name="">
              <option value="Patient" sletcted="">Patient</option>
              <option value="Clinic Out">Clinic Out</option>
              <option value="Expired Out">Expired Out</option>
              <option value="Damage Out">Damage Out</option>
              <option value="Donation Out">Donation Out</option>
              <option value="Other Patient">Other Patient</option>
              <option value="Other">Other</option>
            </select>
          </div>

          <div class="col-md-2 ">
            <input type="text" class="form-control dis_updatedID" autofocus="" id="dis_Updategid"
              placeholder="General ID or Fuchia ID">
          </div>
          <div class="col-md-3">
            <label class="form-label">Dispencing Date</label>
            <!-- <input id="dis_updatedate" type="date"  class="form-control date1"  asp-format="{0:yyyy-MM-dd}"> -->
            <div class="date-holder">
              <input type="text" id="dis_updatedate" class="form-control Gdate" placeholder="dd-mm-yyyy">
              <img src="../img/calendar3.svg" class="dateimg" alt="date">
            </div>
          </div>
          <div class="col-md-3">
            <button class="btn btn-warining update-batton dis-updtedBtn" id="dis_update"
              onclick="dis_updateSearch()">Search to Update</button>
          </div>
          <div class="col-md-2">
            <button class="btn btn-cancelUpdate" id="dis_cancel">Cancel Update</button>
          </div>
        </div>
        <div class="show-update-list">
          <div class="row show-update-header">
            <div class="col-sm-1">NO.</div>
            <div class="col-sm-2">Time</div>
            <div class="col-sm-2">Go-Update</div>
          </div>
        </div>

      </div>
      <!-- Serach to Update Section -->

    </div>
    <div id="Dispencing_stock" class="tab-pane fade">
      <div class="header-text">
        <h2>Stock Section</h2>
      </div>
      <div class="row">
        <div class="col-sm-12" id="medicineStock_show">
          <label class="form-label" for="">Search Medicine Name</label>
          <input type="text" class="form-control" id="medicine_stockname">
        </div>
      </div>

      <!-- <div class="row">
          <div class="col-md-2">
            <label class="form-label" >Serial Number</label>
            <input type="number"class="form-control" id="dis_serialNo">
          </div>
          <div class="col-md-10">
            <label class="form-label">Item Name</label>
            <input type="text"class="form-control" id="dis_name" >
          </div>
        </div>
        <div class="row">
          <div class="col-md-2">
            <label class="form-label">Stock</label>
            <input type="number"class="form-control" >
          </div>
          <div class="col-md-2">
            <label class="form-label">Comsumption Count</label>
            <input type="number"class="form-control" id="stock_comsumCount">
          </div>
          <div class="col-md-3">
            <label class="form-label">Manufacturing Date</label>
            <input id="dis_manuDate" type="date"  class="form-control date1"  asp-format="{0:yyyy-MM-dd}">
          </div>
          <div class="col-md-3">
            <label class="form-label">Exp Date</label>
            <input id="dis_expDate" type="date"  class="form-control date1"  asp-format="{0:yyyy-MM-dd}">
          </div>
          

          <div class="col-md-2">
            <button class="btn btn-warining save-batton dis-addStock">ADD</button>
          </div>
        </div> -->
    </div>
    <div id="Medical_add" class="tab-pane fade">
      <div class="header-text consum-header">
        <h2>Medical Add Section</h2>
        <select class="form-select medic_addEdit" onchange="addEdit()" id="Add_Edit" name="">
          <option value="Edit" sletcted>Edit</option>
          <option value="Add">Add</option>
        </select>
      </div>
      <div class="row" id="medicineEdit_show">
        <div class="col-sm-2">
          <label class="form-label" for="">Item No.</label>
          <span class="form-control medic-itemNo" id="medic_itemNo"></span>
        </div>
        <div class="col-sm-8">
          <label class="form-label" for="">New Medicine Name</label>
          <input type="text" class="form-control" id="medicine_ItemEdit"><!-- medicine_newname -->
        </div>

        <div class="col-sm-2">
          <button class="btn btn-success dis-newItem save-batton" id="new_Medic" onclick="newItem_save()"
            style="display:none">ADD</button>
          <button class="btn btn-success dis-newItem save-batton" id="Edit_medic" onclick="MedicItem_Edit()"
            disabled="true">Edit</button>
        </div>
      </div>


    </div>
    <div id="consumption_data" class="tab-pane fade">
      <br>
      <div class="row">
        <div class="col-sm-2">
          <div class="date-holder">
            <input type="text" id="givenDate_toshow" class="form-control Gdate" placeholder="dd-mm-yyyy">
            <img src="../img/calendar3.svg" class="dateimg" alt="date">
          </div>
        </div>
        <div class="col-sm-2">
          <button onclick="show_consumption_data()" class="btn dis-show-consum btn-warning">Show</button>
        </div>
        <div class="col-sm-2">
          <button onclick="show_consumption_clear()" class="btn dis-show-consum btn-success">Clear</button>
        </div>

      </div>

      <div id="con_table_view">
        <table class="table table-hover table-info">
          <thead>
            <tr>
              <td>No.</td>
              <td>Given Date</td>
              <td>General ID</td>
              <td>Fuchia ID</td>
              <td>Sex</td>
              <td>Age</td>
              <td>Nurse</td>
              <td>Medical Items</td>
              <td></td>
            </tr>
          </thead>
          <tbody>
            @foreach($todayConsumption as $key=> $con)
            <tr>
              <td>{{ $key+1 }}</td>
              <td>{{ date('d-m-Y', strtotime($con->Given_Date)) }}</td>
              <td>{{ $con->Pid }}</td>
              <td>{{ $con->FuchiaID }}</td>
              <td>{{ Crypt::decrypt_light($con->Sex,"General")}}</td>
              <td>{{ $con->Agey }}</td>
              <td>{{ $con->Nurse }}</td>
              <td>
                <ul style="text-align: left;">
                  @php
                  $medicalDataArray = explode(';', $con->Medical_Data);
                  @endphp
                  @foreach($medicalDataArray as $item)
                  <li>{{ trim($item) }}</li>
                  @endforeach
                </ul>
              </td>
              <td>
                <button class="btn btn-danger" id='medical_remove_{{$con->id}}'
                  onclick="remove_medical_list(this)">Delete</button>
              </td>
            </tr>
            @endforeach

          </tbody>
        </table>
      </div>
      <div id="second_table" style="display:none;">
        <table class="table table-info">
          <thead>
            <tr>
              <td>No.</td>
              <td>Given Date</td>
              <td>General ID</td>
              <td>Fuchia ID</td>
              <td>Sex</td>
              <td>Age</td>
              <td>Nurse</td>
              <td>Medical Items</td>
              <td></td>
            </tr>
          </thead>
          <tbody id="con_row_bydate">

          </tbody>
        </table>
      </div>

    </div>
    <div id="medical_entry" class="tab-pane fade">
      <div class="row">
        <div class="col-sm-1">
          <label for="" class="form-label"><b>From</b></label>
        </div>
        <div class="col-sm-2">
          <div class="date-holder">
            <input type="text" id="medic_entry_Date_from" class="form-control Gdate" placeholder="dd-mm-yyyy">
            <img src="../img/calendar3.svg" class="dateimg" alt="date">
          </div>
        </div>
        <div class="col-sm-1">
          <label for="" class="form-label"><b>To</b></label>
        </div>
        <div class="col-sm-2">
          <div class="date-holder">
            <input type="text" id="medic_entry_Date_to" class="form-control Gdate" placeholder="dd-mm-yyyy">
            <img src="../img/calendar3.svg" class="dateimg" alt="date">
          </div>
        </div>
        <div class="col-sm-2">
          <button class="btn dis-show-consum btn-warning" onclick="show_medic_entryList()">Show</button>
        </div>
        <div class="col-sm-2">
          <button onclick="medic_entry_clear()" class="btn dis-show-consum btn-success">Clear</button>
        </div>
      </div>
      <div id="medical_entry_list">
        <div class="row medical-entry-list-head">
          <div class="col-sm-1">No.</div>
          <div class="col-sm-7">Medical Name</div>
          <div class="col-sm-2">Arrival Date</div>
          <div class="col-sm-2">Add Stock</div>
        </div>
      </div>
    </div>

  </div>
</div>
@endauth
@endsection
<script type="text/javascript">
  let  itemsArray = @json($items);
let medic_count=0;let save_medicdata={};
let patient_general;let updateSave;
let updated_originData;let Updated_originStock;// to calculate stock and remaing stock in user interface
let clinicCode,
updated_data;// to retreve data when update data record is more than one 
let show_rc=0;// to show retrive data room; in search to update function
let consumType=document.getElementById("consumtype");


function disOtherChoice(fineID,otherID,orginalID,origianlClass){
  consumType=$("#"+fineID).val();
  
  
    if(consumType=="Clinic Out"){
      var $medic_findIN = $("#"+orginalID);
      var $medic_other = $("<select>").attr({ class: "form-select medicother_select", id:otherID});
      var other_optionMedic = ["HTY-C2(81)", "HTY-A(71)", "HTY-B(72)", "SPT(73)", "Winka(75)", "TBZY(76)", "PTO-DT(77)", "PTO-MCB(78)", "Hpakant(80)", "Taze(82)", "HTY-C1(83)", "Aye Nyein Myintar", "Lotus", "MMTN", "BAHAN","Lab","SDG","TLL","BKKe"];
      $.each(other_optionMedic, function (index, value) {
        $("<option>").attr("value", value).text(value).appendTo($medic_other);
      });
      $medic_findIN.replaceWith($medic_other); 
      $("#dispensing_search").hide();
      
      if($("#dis_Updategid").val()!=""){
        $("#other_find").val($("#dis_Updategid").val());
      }
     
    }else{
      var defined_saveType="";
      var disabled_type="";
      if(consumType!="Patient"){
        defined_saveType=consumType;
        disabled_type=true;
        $("#dispensing_search").hide();
      }else{
        $("#dispensing_search").show();
        disabled_type=false;
      }
      var medic_orgin=$("<input>").attr({
                                          class: "form-control "+origianlClass,
                                          id: orginalID,
                                          placeholder: "General ID or Fuchia ID"
                                        }).prop({
                                          "autofocus": true,
                                          "disabled":disabled_type,
                                        }).val(defined_saveType);

      $("#"+otherID).replaceWith(medic_orgin);
      $("#"+orginalID).replaceWith(medic_orgin);
    }
}


function ptData(){
  
  var vdate= formatDate($("#vDate").val());

    var mid = document.getElementById("mid").value;
    var notice = "ptData";
    var ckdata = {
                        mid:mid,
                        vdate:vdate,
                        notice:notice
                      };
    console.log(ckdata)
    $.ajaxSetup({
       headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
       }
     });
     $.ajax({
          type:'POST',
          url:"{{route('dispencing_data')}}",

               dataType:'json',
             //  processData:false,
               contentType: 'application/json',
               data: JSON.stringify(ckdata),
          success:function(response){
            console.log(response);
            if(Object.keys(response).length==1){
              patient_general=response;
              $(".dis-saveBtn").prop("disabled",false);

              if(response[0]["Agey"]==0){
                var age=response[0]["Agem"]+"month";
              }else{
              var age=response[0]["Agey"]+"years";
              }
              clinicCode=response[0]["Clinic Code"];
              $("#mid").val(response[0]["Pid"])
              $("#medic_risk").val(response[0]["Main Risk"]); 
              var patient_data="Patient's Name ="+response[0]["Name"]+",     "+"Father's Name ="+response[0]["Father"]+",     "+"Fuchia ID ="+response[0]["FuchiaID"]+
              ",     "+"Age ="+age+",     "+"Sex ="+response[0]["Gender"];
              $("#comsum_generalInfo").text(patient_data);
            }else{
              alert(response);
            }
          }
         });
}
function refresh(){
  location.reload();
}
function PatientType(){
    var type= document.getElementById('Ptype').value;
    if(ext.innerHTML!=null){
      ext.innerHTML="";
    }
    if(type == "Pregnant Mother"){
        var sel = document.getElementById('ext');
        // create new option element
        var opt0 = document.createElement("option");
        var opt1 = document.createElement("option");
        var opt2 = document.createElement("option");
        // create text node to add to option element (opt)
      //  opt0.appendChild( document.createTextNode(""));
      //  opt1.appendChild( document.createTextNode("PP"));
      //  opt2.appendChild( document.createTextNode("MP"));
        // set value property of opt
        opt1.setAttribute('id','opt_ext_pp');
        opt2.setAttribute('id','opt_ext_mp');

        opt1.value = "pp";
        opt2.value = "mp";
        opt0.text = "";
        opt1.text = "PP";
        opt2.text = "MP";
        pregMum = 1;
        sel.addEventListener("click", Ptypesub);

        // add opt to end of select box (sel)
        sel.add(opt0);
        sel.add(opt1);
        sel.add(opt2);

    }
    if(type == "Spouse of pregnant mother"){

      var sel = document.getElementById('ext');
      // create new option element
      var opt0 = document.createElement("option");
      var opt1 = document.createElement("option");
      var opt2 = document.createElement("option");
      // create text node to add to option element (opt)
      opt0.appendChild( document.createTextNode(""));
      opt1.appendChild( document.createTextNode("HIV(Pos)"));
      opt2.appendChild( document.createTextNode("HIV(Neg)Woman"));
      // set value property of opt
      opt0.value = "";
      opt1.value = 1;
      opt2.value = 2;
      // add opt to end of select box (sel)
      opt1.setAttribute('id','opt_ext_hivPos');
      opt2.setAttribute('id','opt_ext_hivNeg');

      sel.addEventListener("click", Ptypesub);
      ////
      sel.appendChild(opt0);
      sel.appendChild(opt1);
      sel.appendChild(opt2);
      spm =1;

    }
    if(type == "Exposed Children"){

      var sel = document.getElementById('ext');
      // create new option element
      var opt0 = document.createElement("option");
      var opt1 = document.createElement("option");
      var opt2 = document.createElement("option");
      var opt3 = document.createElement("option");
      var opt4 = document.createElement("option");
      // create text node to add to option element (opt)
      opt0.appendChild( document.createTextNode(""));
      opt1.appendChild( document.createTextNode("1"));
      opt2.appendChild( document.createTextNode("2"));
      opt3.appendChild( document.createTextNode("3"));
      opt4.appendChild( document.createTextNode("4"));

      // set value property of opt
      opt0.value = 0;
      opt1.value = 1;
      opt2.value = 2;
      opt3.value = 3;
      opt4.value = 4;
      ///////
      opt0.setAttribute('id','opt_ext_ec_0');
      opt1.setAttribute('id','opt_ext_ec_1');
      opt2.setAttribute('id','opt_ext_ec_2');
      opt3.setAttribute('id','opt_ext_ec_3');
      opt4.setAttribute('id','opt_ext_ec_4');

      sel.addEventListener("click", Ptypesub);
      // add opt to end of select box (sel)
      sel.appendChild(opt0);
      sel.appendChild(opt1);
      sel.appendChild(opt2);
      sel.appendChild(opt3);
      sel.appendChild(opt4);
      epc = 1;
    }
    if(type == "Low risk"){
      var sel = document.getElementById('ext');
      // create new option element
      var opt0 = document.createElement("option");
      var opt1 = document.createElement("option");
      var opt2 = document.createElement("option");
      var opt3 = document.createElement("option");
      // create text node to add to option element (opt)
      opt0.appendChild( document.createTextNode(""));
      opt1.appendChild( document.createTextNode("PWUD"));
      opt2.appendChild( document.createTextNode("Youth (15-24)"));
      opt3.appendChild( document.createTextNode("Other Low Risk"));

      opt0.setAttribute('id','opt_lr_0');
      opt1.setAttribute('id','opt_lr_pwud');
      opt2.setAttribute('id','opt_lr_youth');
      opt3.setAttribute('id','opt_lr_other');
      // set value property of opt
      opt0.value = "";
      opt1.value = "pwud";
      opt2.value = "youth";
      opt3.value = "otherLR";

      sel.addEventListener("click", Ptypesub);
      // add opt to end of select box (sel)
      sel.appendChild(opt0);
      sel.appendChild(opt1);
      sel.appendChild(opt2);
      sel.appendChild(opt3);
      lr = 1;
    }
    if(type == "FSW"){
      var sel = document.getElementById('ext');
      // create new option element
      var opt0 = document.createElement("option");
      var opt1 = document.createElement("option");
      var opt2 = document.createElement("option");
      // create text node to add to option element (opt)
      opt0.appendChild( document.createTextNode(""));
      opt1.appendChild( document.createTextNode("FSW PWID"));
      opt2.appendChild( document.createTextNode("FSW PWUD"));
      // set value property of opt
      opt0.value = "";
      opt1.value = "fswpwid";
      opt2.value = "fswpwud";

      opt0.setAttribute('id','opt_fsw_0');
      opt1.setAttribute('id','opt_fsw_pwid');
      opt2.setAttribute('id','opt_fsw_pwud');

      sel.addEventListener("click", Ptypesub);
      // add opt to end of select box (sel)
      sel.appendChild(opt0);
      sel.appendChild(opt1);
      sel.appendChild(opt2);
      fsw = 1;
    }
    if(type == "Client of FSW"){
      opt0.value = "";
    }
    if(type == "MSM"){
      var sel = document.getElementById('ext');
      // create new option element
      var opt0 = document.createElement("option");
      var opt1 = document.createElement("option");
      var opt2 = document.createElement("option");
      // create text node to add to option element (opt)
      opt0.appendChild( document.createTextNode(""));
      opt1.appendChild( document.createTextNode("MSM PWID"));
      opt2.appendChild( document.createTextNode("MSM PWUD"));
      // set value property of opt
      opt0.value = "";
      opt1.value = "msmpwid";
      opt2.value = "msmpwud";

      opt0.setAttribute('id','opt_msm_0');
      opt1.setAttribute('id','opt_msm_pwid');
      opt2.setAttribute('id','opt_msm_pwud');

      sel.addEventListener("click", Ptypesub);

      // add opt to end of select box (sel)
      sel.appendChild(opt0);
      sel.appendChild(opt1);
      sel.appendChild(opt2);
      msm =0;
    }
    if(type == "IDU"){
      var sel = document.getElementById('ext');
      // create new option element
      var opt0 = document.createElement("option");
      var opt1 = document.createElement("option");
      var opt2 = document.createElement("option");
      // create text node to add to option element (opt)
      opt0.appendChild( document.createTextNode(""));
      opt1.appendChild( document.createTextNode("PWID/FSW"));
      opt2.appendChild( document.createTextNode("PWID/MSM"));
      // set value property of opt
      opt0.value = "";
      opt1.value = "pwidfsw";
      opt2.value = "pwidmsm";

      opt0.setAttribute('id','opt_idu_0');
      opt1.setAttribute('id','opt_idu_fsw');
      opt2.setAttribute('id','opt_idu_msm');

      sel.addEventListener("click", Ptypesub);

      // add opt to end of select box (sel)
      sel.appendChild(opt0);
      sel.appendChild(opt1);
      sel.appendChild(opt2);
      idu = 1;

    }
    if(type == "Partner of KP"){
      var sel = document.getElementById('ext');
      // create new option element
      var opt0 = document.createElement("option");
      var opt1 = document.createElement("option");
      var opt2 = document.createElement("option");
      var opt3 = document.createElement("option");
      var opt4 = document.createElement("option");
      // create text node to add to option element (opt)
      opt0.appendChild( document.createTextNode(""));
      opt1.appendChild( document.createTextNode("Partner of PWID"));
      opt2.appendChild( document.createTextNode("Partner of FSW"));
      opt3.appendChild( document.createTextNode("Female of MSM"));
      opt4.appendChild( document.createTextNode("Partner of PLHIV"));
      // set value property of opt
      opt0.value = 0;
      opt1.value = 1;
      opt2.value = 2;
      opt3.value = 3;
      opt4.value = 4;

      opt0.setAttribute('id','opt_pkp_0');
      opt1.setAttribute('id','opt_pkp_pwid');
      opt2.setAttribute('id','opt_pkp_fsw');
      opt3.setAttribute('id','opt_pkp_msm');
      opt4.setAttribute('id','opt_pkp_plhiv');

      sel.addEventListener("click", Ptypesub);
        // add opt to end of select box (sel)
        sel.appendChild(opt0);
        sel.appendChild(opt1);
        sel.appendChild(opt2);
        sel.appendChild(opt3);
        sel.appendChild(opt4);
        pkp = 1;
      }
    if(type == "Special Groups"){
      var sel = document.getElementById('ext');
      // create new option element
      var opt0 = document.createElement("option");
      var opt1 = document.createElement("option");
      var opt2 = document.createElement("option");
      var opt3 = document.createElement("option");
      var opt4 = document.createElement("option");
      // create text node to add to option element (opt)
      opt0.appendChild( document.createTextNode(""));
      opt1.appendChild( document.createTextNode("TB Patient"));
      opt2.appendChild( document.createTextNode("Institutionalize"));
      opt3.appendChild( document.createTextNode("Uniformed Services Personnel"));
      opt4.appendChild( document.createTextNode("Migrant Population"));
      // set value property of opt
      opt0.value = 0;
      opt1.value = 1;
      opt2.value = 2;
      opt3.value = 3;
      opt4.value = 4;
      opt0.setAttribute('id','opt_sg_0');
      opt1.setAttribute('id','opt_sg_TB');
      opt2.setAttribute('id','opt_sg_insti');
      opt3.setAttribute('id','opt_sg_uni');
      opt4.setAttribute('id','opt_sg_mig');


      sel.addEventListener("click", Ptypesub);
      // add opt to end of select box (sel)
      sel.appendChild(opt0);
      sel.appendChild(opt1);
      sel.appendChild(opt2);
      sel.appendChild(opt3);
      sel.appendChild(opt4);
      sg=1;
    }
    if(type == "TG"){
      var sel = document.getElementById('ext');
      // create new option element
      var opt0 = document.createElement("option");
      var opt1 = document.createElement("option");
      var opt2 = document.createElement("option");
      // create text node to add to option element (opt)
      opt0.appendChild( document.createTextNode(""));
      opt1.appendChild( document.createTextNode("TG/PWID"));
      opt2.appendChild( document.createTextNode("TG/PWUD"));
      // set value property of opt
      opt0.value = "";
      opt1.value = "tgpwid";
      opt2.value = "tgpwud";

      opt0.setAttribute('id','opt_tg_0');
      opt1.setAttribute('id','opt_tg_pwid');
      opt2.setAttribute('id','opt_tg_pwud');


      sel.addEventListener("click", Ptypesub);

      // add opt to end of select box (sel)
      sel.appendChild(opt0);
      sel.appendChild(opt1);
      sel.appendChild(opt2);
      tg=1;
    }
}
function Ptypesub(){
    if(pregMum == 1){
      var pp = document.getElementById('opt_ext_pp').value;
      var mp = document.getElementById('opt_ext_mp').value;
      if(pp!=null){
        if(document.getElementById("opt_ext_pp").selected == true){Ptype_sub="PP";}
      }
      if(mp != null){
        if(document.getElementById("opt_ext_mp").selected == true){Ptype_sub="MP";}
      }
    }
    if(spm == 1){
      var hiv_pos =document.getElementById('opt_ext_hivPos').value;
      var hiv_neg =document.getElementById("opt_ext_hivNeg").value;
      if( hiv_pos != null){
        if(document.getElementById("opt_ext_hivPos").selected == true){Ptype_sub="HIV(Pos)";}
      }
      if(hiv_neg !=null){
        if(document.getElementById("opt_ext_hivNeg").selected == true){Ptype_sub="HIV(Neg)Woman";}
      }

    }
    if(epc == 1){
      var ec1 = document.getElementById("opt_ext_ec_1").value;
      var ec2 = document.getElementById("opt_ext_ec_2").value;
      var ec3 = document.getElementById("opt_ext_ec_3").value;
      var ec4 = document.getElementById("opt_ext_ec_4").value;
      if(ec1!=null){
        if(document.getElementById("opt_ext_ec_1").selected == true){Ptype_sub="1";}
      }
      if(ec2!=null){
        if(document.getElementById("opt_ext_ec_2").selected == true){Ptype_sub="2";}
      }
      if(ec3!=null){
        if(document.getElementById("opt_ext_ec_3").selected == true){Ptype_sub="3";}
      }
      if(ec4!=null){
        if(document.getElementById("opt_ext_ec_4").selected == true){Ptype_sub="4";}
      }
    }
    if(lr == 1){
      var lr_youth = document.getElementById("opt_lr_youth").value;
      var lr_pwud = document.getElementById("opt_lr_youth").value;
      var lr_other = document.getElementById("opt_lr_youth").value;
      if(lr_youth != null){
        if(document.getElementById("opt_lr_youth").selected == true){Ptype_sub="Youth (15-24)";}
      }
      if(lr_pwud){
        if(document.getElementById("opt_lr_pwud").selected == true){Ptype_sub="PWUD";}
      }
      if(lr_other != null){
        if(document.getElementById("opt_lr_other").selected == true){Ptype_sub="Other Low Risk";}
      }
    }
    if(fsw == 1){
      var fswpwid = document.getElementById('opt_fsw_pwid').value;
      var fswpwud = document.getElementById('opt_fsw_pwud').value;
      if( fswpwid != null){
        if(document.getElementById("opt_fsw_pwid").selected == true){Ptype_sub="fswpwid";}
      }
      if(fswpwud != null){
        if(document.getElementById("opt_fsw_pwud").selected == true){Ptype_sub='fswpwud';}
      }
    }
    if(msm == 1){
      var msmpwid = document.getElementById("opt_msm_pwid").value;
      var msmpwud = document.getElementById("opt_msm_pwud").value;
      if(msmpwid){
        if(document.getElementById("opt_msm_pwid").selected == true){Ptype_sub="msmpwid";}
      }
      if(msmpwud){
        if(document.getElementById("opt_msm_pwud").selected == true){Ptype_sub="msmpwud";}
      }
    }
    if(idu == 1){
      var idu_fsw = document.getElementById("opt_idu_fsw").value;
      var idu_msm = document.getElementById("opt_idu_msm").value;
      if(idu_fsw != null){
        if(document.getElementById("opt_idu_fsw").selected == true){Ptype_sub="pwidfsw";}
      }
      if(idu_msm){
        if(document.getElementById("opt_idu_msm").selected == true){Ptype_sub="pwidmsm";}
      }
    }
    if(pkp == 1){
      var pkp_pwid=document.getElementById("opt_pkp_pwid").value;
      var pkp_fsw = document.getElementById("opt_pkp_fsw").value;
      var pkp_msm = document.getElementById("opt_pkp_msm").value;
      var pkp_plhiv = document.getElementById("opt_pkp_plhiv").value;
      if(pkp_pwid!=null){
        if(document.getElementById("opt_pkp_pwid").selected == true){Ptype_sub="Partner of PWID";}
      }
      if(pkp_fsw){
        if(document.getElementById("opt_pkp_fsw").selected == true){Ptype_sub="Partner of FSW";}
      }
      if(pkp_msm!=null){
        if(document.getElementById("opt_pkp_msm").selected == true){Ptype_sub="Female of MSM";}
      }
      if(pkp_plhiv){
        if(document.getElementById("opt_pkp_plhiv").selected == true){Ptype_sub="Partener of PLHIV";}
      }
    }
    if(sg == 1){
      var sg_TB=document.getElementById("opt_sg_TB").value;
      var sg_insti=document.getElementById("opt_sg_insti").value;
      var sg_uni = document.getElementById("opt_sg_uni").value;
      var sg_mig =document.getElementById("opt_sg_mig").value;
      if(sg_TB != null){
        if(document.getElementById("opt_sg_TB").selected == true){Ptype_sub="TB Patient";}
      }
      if(sg_insti !=null){
        if(document.getElementById("opt_sg_insti").selected == true){Ptype_sub="Institutionalize";}
      }
      if(sg_uni != null){
        if(document.getElementById("opt_sg_uni").selected == true){Ptype_sub="Uniformed Services Personnel";}
      }
      if(sg_mig != null){
        if(document.getElementById("opt_sg_mig").selected == true){Ptype_sub="Migrant Population";}
      }
    }
    if(tg == 1){
      var tg_pwid =document.getElementById("opt_tg_pwid").value;
      var tg_pwud =document.getElementById("opt_tg_pwud").value;
      if(tg_pwid != null){
        if(document.getElementById("opt_tg_pwid").selected == true){Ptype_sub="tgpwid";}
      }
      if(tg_pwud != null){
        if(document.getElementById("opt_tg_pwud").selected == true){Ptype_sub="tgpwud";}
      }
    }
}
function check_medi(){
  var check_mediID=event.target.id;
  if ($("#"+check_mediID).is(':checked')) {
    var medi_stock=$('<span>').attr({
                                  id:"stock"+check_mediID,
                                }).addClass("form-control");
    var medi_quantity=$('<input>').attr({
                                    type: 'number',
                                    id:"quantity"+check_mediID,
                                    onchange:"medic_Quantity()",
                                  }).css({
                                    'width':'100%',
                                  }).addClass("form-control");
    var checkArea=check_mediID.match(/\d+/);

   $("#"+check_mediID).prop("disabled",true);
    medic_count++;
    var stock_div=$('<div>').addClass("col-sm-6").append($('<label>').text("Stock")).append(medi_stock);
    var quantity_div=$('<div>').attr({class:'col-sm-6'}).append($('<label>').text("Quantity")).append(medi_quantity);
    var medistock_div=$('<div>').attr({class:"row st_qtRow"+check_mediID}).append(quantity_div);
    $("#"+check_mediID).parent().append(medistock_div.append(stock_div));
    var medic_nameList=$('<div>').attr({class:"medi-listName",id:"list_"+checkArea,}).append($('<label>').attr({class:"medic_nameNo"})
    .text(medic_count)).append($('<label>').attr({class:"medic_nameLabel"})
    .text($("#label"+check_mediID).text())).append($('<input>').attr({class:"medic-Lableqty",id:"medic_qtyLable"})
    .val(0)).append($('<button>')
    .text("Remove").attr({class:'btn btn-remove',onclick:"remove_medicList()"}))
 
    $(".medic_area").append(medic_nameList);
    $("#quantitycheck"+checkArea).focus();
    console.log(itemsArray);
    $("#stock"+check_mediID).text(itemsArray[checkArea]["Stock"]);
    $("#dis_save").prop("disabled",false);
  }//removing and rewriting text area

 
}
function remove_medicList(){
 var medicListID=$(event.target).parent().attr('id');
 var sequenceID=medicListID.match(/\d+/);
  if($("#check"+sequenceID).is(":checked")){
    $("#check"+sequenceID).prop({
      "checked":false,
      "disabled":false,
    });

    $(".st_qtRowcheck"+sequenceID).remove();

  }
 $("#"+medicListID).remove();
 $("#list_"+sequenceID).remove();

 var medic_childCount= $(".medic_area").children().toArray();
 for(var lChild=0;lChild<medic_childCount.length;lChild++){   // list No. serial
  var child_sequence=$(medic_childCount[lChild]).attr('id');
  console.log(child_sequence);
  $("#"+child_sequence+" .medic_nameNo").text(lChild+1);
   
 }
 medic_count=medic_childCount.length




}
function medic_Quantity(){
 var medic_quantity=event.target.id;
 var medic_quantityID=medic_quantity.match(/\d+/);
 var medic_QuaValue=Number($("#"+medic_quantity).val());
 var medic_StockQuantity=itemsArray[medic_quantityID]["Stock"];
 console.log(medic_StockQuantity+""+medic_QuaValue);
 if(medic_QuaValue > 0 && medic_QuaValue <= medic_StockQuantity){
  $("#list_"+medic_quantityID+" #medic_qtyLable").val(medic_QuaValue);
 }else{
  alert("Quantity shold be greather than Zero and less than or equal Stock")
  $("#"+medic_quantity).val("");
 }
 
 

}
function dispencing_saveUpdate(){
    var saveMedic_list=$(".medic_area").children('div').toArray();
    updateSave=event.target.id;
    var countNO=0
    var generalInfo={};
    console.log(updateSave);
    var nurse=$("#nurse_name").val();
    var clinic_code=clinicCode;
    var given_date=formatDate($("#vDate").val());
    consumType=$("#consumtype").val();

    if(updateSave=="dis_update"||consumType!="Patient"){
      follow_date="";
    }else{
      follow_date=patient_general[0]["Visit Date"];
    }
    console.log(follow_date+"date");
    if(given_date==follow_date||updateSave=="dis_update"||consumType!="Patient"){
      for(var sChild=0;sChild<saveMedic_list.length;sChild++){
        var savechild_sequence=$(saveMedic_list[sChild]).attr('id');
        if(updateSave=="dis_update"){
          if($("#"+savechild_sequence+" #medic_qtyLable").is("label")){
            var saveQty=$("#"+savechild_sequence+" #medic_qtyLable").text().match(/\d+/);
            saveQty=saveQty[0];
          }else{
            var saveQty=$("#"+savechild_sequence+" #medic_qtyLable").val();
          }
          console.log(saveQty+"Update Qty")
        }else{
          var saveQty=$("#"+savechild_sequence+" #medic_qtyLable").val();
          console.log(saveQty);
        }
        var savename=savechild_sequence.match(/\d+/);
        countNO++
        console.log(countNO+"helllo count"+saveQty);
        
        if(saveQty!=0){
          var value_medic=[savename,saveQty];
          console.log(value_medic);
          save_medicdata[countNO]=value_medic[0][0];
          if(updateSave=="dis_update"){
            save_medicdata[++countNO]=value_medic[1];
          }else{
            save_medicdata[++countNO]=value_medic[1];
          }
        }
      }
    
     
      if(updateSave==="dis_update"){
        if($("#consumtype").val()!="Patient"){
          var Pid=$("#other_find").val();
        }else{
          var Pid=$("#mid").val();
        }
        generalInfo={
          notice    :"comsumption_update",
          Nurse     :nurse,
          id        :updated_data[0][show_rc]["id"],
          Clinic_Code:clinic_code,
          Given_Date:given_date,
          Pid       :Pid,
        }
        var final_data={save_medicdata,generalInfo,updated_originData};
      }else if(consumType!="Patient"){
          var pid=$("#other_find").val();
          if(pid==null){
            var pid=$("#mid").val();
          }
          generalInfo={
            notice    :"comsumption_save",
            Nurse     :nurse,
            Clinic_Code:0,
            Given_Date:given_date,
            saveType:consumType,
            Pid       :pid,
            FuchiaID  :"-",
            PrEPCode  :"-",
            Sex       :"-",
            Agey      :0,
            Agem      :0,
            Main_Risk  :'-',
          }
          var final_data={save_medicdata,generalInfo}; 

      }else{
        
          generalInfo={
            notice    :"comsumption_save",
            Nurse     :nurse,
            Clinic_Code:clinic_code,
            Given_Date:given_date,
            saveType:consumType,
            Pid       :patient_general[0]["Pid"],
            FuchiaID  :patient_general[0]["FuchiaID"],
            PrEPCode  :patient_general[0]["PrEPCode"],
            Sex       :patient_general[0]["Gender"],
            Agey      :patient_general[0]["Agey"],
            Agem      :patient_general[0]["Agem"],
            Main_Risk :patient_general[0]["Main Risk"],
          }
            var final_data={save_medicdata,generalInfo}; 
        }
          
      
     
      
      
      if(Object.keys(save_medicdata).length==(saveMedic_list.length)*2){
        console.log(final_data);
        
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
            data: JSON.stringify(final_data),
            success:function(response){
              console.log(response);
              if(response=="already_Given"){
                alert("This patient has been given")
                // location.reload();
              }else if(response=="Medicine is empty"||response=="Your Transation is wrong"){
                alert(response);
              }else{
                alert("Successfully Save")
                location.reload();
              }
              
            }
        });

      }else{
        
        $("#saveQuantityList").children(":not(h3)").remove();
        Quanttity();
      }
      
    }else{
        alert("This patient Do not pass reception")
      }
   
   



   

  
}
function Quanttity(){
  var qtyMedic_list=$(".medic_area").children().toArray();
  for(var qChild=0;qChild<qtyMedic_list.length;qChild++){
      var qtychild_sequence=$(qtyMedic_list[qChild]).attr('id');
      var qtychild_number=qtychild_sequence.match(/\d+/);
      var qtyamount=$("#"+qtychild_sequence+" #medic_qtyLable").val();
      
      if(qtyamount==0){
        var qtyname=($("#"+qtychild_sequence+" .medic_nameLabel").text());
        var medicQty_nameList=$('<div>').attr({id:"listQty_"+qtychild_number,class:"listQtyblock"})
        .append($('<label>').attr({class:"repaire_nameLabel",type:"number"})
        .text(qtyname)).append($('<input>').attr({class:"medic_repaireqty ",type:"number"
          ,placeholder:"Quantity",onChange:"medic_Quantity()",id:"reqty_"+qtychild_number,})).append($('<button>')
    .text("Remove").attr({class:'btn btn-remove',onclick:"remove_medicList()"}))
        $("#saveQuantityList").append(medicQty_nameList);
        $("#medic_check").addClass("freeze-body");
        $("#medic_check").css({opacity:0.1})
        $("#saveQuantity").css({display:"block"})
        
        
      }
    }
    $("#saveQuantityList").append($('<button>').attr({onclick:"reparieOK()",class:"btn save-batton",}).text("OK").css({width:"20%"}));

  
}
function reparieOK(){
  var repaireList=$("#saveQuantityList").children("div").toArray();
  var mediczero_list=$(".medic_area").children("div").toArray();
  console.log(mediczero_list.length);
  if(mediczero_list.length<1){
    $("#dis_save").prop("disabled",true);
  }
  var togo;
  console.log(repaireList);
  var shouldbreak=false;
  $.each(repaireList,function(index){
    if(shouldbreak){
      return false;
    }
    var repaireId=$(repaireList[index]).attr('id');
    var reparieQty=$("#"+repaireId+" .medic_repaireqty").val();
    if(reparieQty==null||reparieQty<1){
       togo="cancel"
      $("#"+repaireId+" .medic_repaireqty").focus();
      shouldbreak=true;
    }

  })
  if(togo!="cancel"){
    $("#saveQuantity").hide();
    $("#medic_check").removeClass("freeze-body").css({opacity:"1"});
  }

}

function checkStock_medi(){
  var stock_check=event.target.id;
  var idnumber=stock_check.match(/\d+/);
  if($("#"+stock_check).is(":checked")){
    var stock_blog=$("<div>").attr({id:"stock_blog"+idnumber,class:"row"}).append($("<div>").attr({class:"col-sm-2"})
    .append($("<label>").attr({class:"form-label"}).text("In Stock"))
    .append($("<span>").attr({id:"instock"+idnumber,class:"form-control"})))
    .append($("<div>").attr({class:"col-sm-2"})
    .append($("<label>").attr({class:"form-label"}).text("Quantity"))
    .append($("<input>").attr({id:"stockQty"+idnumber,type:"number",class:"form-control"})))
    .append($("<div>").attr({class:"col-sm-3"})
    .append($("<label>").attr({class:"form-label"}).text("Exp-Date"))
    .append($("<div>").attr({class:"date-holder"}).append($("<input>")
    .attr({id:"stock_expDate"+idnumber,class:"form-control Gdate",placeholder:"dd-mm-yyyy",onchange:"dateformatValid()"}))
    .append($("<img>").attr({src:"../img/calendar3.svg",class:"dateimg",alt:"date",onclick:"dateCalender()"}))))
    .append($("<div>").attr({class:"col-sm-3"})
    .append($("<label>").attr({class:"form-label"}).text("Arriving-Date"))
    .append($("<div>").attr({class:"date-holder"}).append($("<input>")
    .attr({id:"stock_arivalDate"+idnumber,class:"form-control Gdate",placeholder:"dd-mm-yyyy",onchange:"dateformatValid()"}))
    .append($("<img>").attr({src:"../img/calendar3.svg",class:"dateimg",alt:"date",onclick:"dateCalender()"}))))
    .append($("<div>").attr({class:"col-sm-2"})
    .append($("<button>").attr({class:"btn btn-warining save-batton dis-addStock",onclick:"stockAdd()",id:"sto_add"+idnumber}).text("ADD")));

    $("#"+stock_check).parent().append(stock_blog);
    
    var notice="Stock_remaining"
    var stock_remain={id:idnumber,
                      notice:notice};
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
      data: JSON.stringify(stock_remain),
      success:function(response){
        console.log(response);
        $("#instock"+idnumber).text(response[0]["Stock"]) 

      }
    })

  }else{
    $("#stock_blog"+idnumber).remove();
  }
  

}
function stockAdd(){
  var btn_id=event.target.id
  var idnumber=btn_id.match(/\d+/);
  var instock=Number($("#instock"+idnumber).text());
  var stockQty=Number($("#stockQty"+idnumber).val());
  var total_stock=instock+stockQty;
  var exp_date=formatDate($("#stock_expDate"+idnumber).val());
  var arival_date=formatDate($("#stock_arivalDate"+idnumber).val());
  var stock_Add={
                  id:idnumber,
                  total_stock:total_stock,
                  stockQty:stockQty,
                  exp_date:exp_date,
                  arival_date:arival_date,
                  notice:"Stock_Add"
                };
  console.log(stock_Add);
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
      data: JSON.stringify(stock_Add),
      success:function(response){
        alert("successfully")
        console.log(response);
        $("#stock_blog"+idnumber).remove();
        $("#checkStock"+idnumber).prop({"checked":false}) 
      }
  })
  
  
  
}
function newItem_save() {
  var new_midic=$("#medicine_newname").val();
  var idnumber=$("#medic_itemNo").text();
  var new_itemAdd={
                    new_midic:new_midic,
                    notice:"New Medic Add",
                    idnumber:idnumber,
                  };
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
      data: JSON.stringify(new_itemAdd),
      success:function(response){
        alert("successfully Save")
        // location.reload();
        console.log(response);
        $("#medicine_newname").val("");
        $("#medic_itemNo").text(response[0]);
        

       
      }
  })
}
function dis_updateSearch(){
  var upId=$("#dis_Updategid").val();
  
  var upDate=formatDate($("#dis_updatedate").val());
  
  var update_Data={
    notice:"Update_FindConsumption",
    upId:upId,
    upDate:upDate,
  }
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
      data: JSON.stringify(update_Data),
      success:function(response){
        
        
        console.log(response)
        updated_data=response;
        $(".show-update-list").hide();
        if(response[0].length>1){
         $(".show-update-data").remove();
         $(".show-update-list").show();
         $.each(response[0],function(index, item){
          var medic_update_show_list=$("<div>").attr({class:"row show-update-data"})
            .append($("<div>").attr({class:"col-sm-1"}).text(index+1))
            .append($("<div>").attr({class:"col-sm-2"}).text(item["createdAT"]))
            .append(
              $("<div>").attr({class:"col-sm-2"})
              .append($("<button>").attr({class:"btn btn-info btn-warining",id:"medic_update_"+index,onclick:"show_update_data()"}).text("To-Update"))
            )
          $(".show-update-list").append(medic_update_show_list);
         })
         
        }else if(response[0].length==1){
          updated_originData=updated_data[0][show_rc]["Medical_Data"];
          Updated_originStock=updated_data[1][show_rc];
          show_update_detail(response[0][show_rc]);
        }else{
          alert("Can not find data");
        }
      }
  })
}

function show_update_data(){
  show_rc=event.target.id.match(/\d+/)[0];
  updated_originData=updated_data[0][show_rc]["Medical_Data"];
  Updated_originStock=updated_data[1][show_rc];
  show_update_detail(updated_data[0][show_rc]);
}
function show_update_detail(update_show_detail){
        $("#vDate,#consumtype").prop("disabled",true);
        if($("#consumtype").val()=="Patient"){
          $("#other_find,#mid").prop("disabled",true);
        }else{
          $("#other_find,#mid").prop("disabled",false);
        }
        $(".medic_area").empty();
       

        $("#medicine_show").children('div').remove();
        $("#vDate").val("");
        $("#medicine_name").val("");
        var idnumber;
        if(update_show_detail["Agey"]=="0"){
          var age=update_show_detail["Agem"]+"Months"
        }else{
          var age=update_show_detail["Agey"]+"Years"
        }
        $("#mid").val(update_show_detail["Pid"]);
        $("#nurse_name").val(update_show_detail["Nurse"]);
        clinicCode=update_show_detail["Clinic Code"]
        $("#vDate").val(update_show_detail["Given_Date"]);
        DateTo_text();
        $("#comsum_generalInfo").text("Prep-Code: "+update_show_detail["PrEPCode"]+"Fuchia-Code:"+update_show_detail["FuchiaID"]+"Age:"+age);

        var medicList= update_show_detail["Medical_Data"].split("-");
       
        $(".medic_area").children('div').remove();
        $.each(medicList, function(index, item) {
          if(index!=0&&index % 2 == 0){
           
            var medic_nameList=$('<div>').attr({class:"medi-listName",id:"list_"+idnumber,}).append($('<label>').attr({class:"medic_nameNo"})
                                .text("")).append($('<label>').attr({class:"medic_nameLabel"})
                                .text(itemsArray[idnumber]['Medic_item'])).append($('<input>')
                                .attr({class:"medic-Lableqty",id:"medic_qtyLable",onChange:"updateQtyCheck()"}).val(item))
                                .append($('<button>').text("Remove").attr({class:'btn btn-remove',onclick:"remove_medicList()"}))
            
            $(".medic_area").append(medic_nameList);                    
          }else if(index!=0){
            idnumber=item;
          }
          $("#dis_save").hide();
          $("#dis_update").show();
         
        })
        $(".medic-searchUpdate").css({opacity:"",top:""}).addClass("freeze-body");
        $(".consumption-Info").css({position:"",opacity:""}).removeClass("freeze-body")
  
}
function updateQtyCheck(){
  var toCheck=0;
  var upQtyparent=$(event.target).parent().attr('id');
  var changeqty=$(event.target).val();
  if(changeqty!=0&&changeqty>0&&changeqty!=""){
    var origin_data=updated_originData.split("-");
    var idnumber=upQtyparent.match(/\d+/);
    console.log(idnumber+"idnumber")
    for(var i=1;i<origin_data.length;i++){
      if(origin_data[i]==idnumber){
        toCheck+=Number(origin_data[i+1]);
        console.log(toCheck+"origin_data")
      }
      i++;
    }
    for(var j=0;j<Updated_originStock.length;j++){
      if(Updated_originStock[j]==idnumber){
        toCheck+=Number(Updated_originStock[j+1]);
        console.log(toCheck+"Updated_originStock");
      }
      j++;
    }
    if(toCheck<changeqty){
      alert("Your Update Quantity is greather than IN-Stock")
      $("#"+upQtyparent+" input").val("")
      $("#"+upQtyparent+" input").focus();
    }
  }else{
    alert("Quantity Should be greather than Zero or Remove this medicine item")
    $("#"+upQtyparent+" input").val("0");
    $("#"+upQtyparent+" input").focus();
  }
}

function check_mediEdit(){
  var idnumber=$(event.target).val();
  $("#medicine_ItemEdit").val(itemsArray[idnumber]["Medic_item"]);
  $("#medic_itemNo").text(idnumber);
  $("#Edit_medic").prop("disabled",false);
}
function MedicItem_Edit(){
  id=$("#medic_itemNo").text();
  Mname=$("#medicine_ItemEdit").val();
  var medic_edit={
    notice:"Medic ItemEdit",
    id:id,
    Mname:Mname,
  }
  console.log(medic_edit);
}
function addEdit(){
  var editAdd=$("#Add_Edit").val();
        if(editAdd=="Add"){
            $("#medicineEdit_show div:nth-child(2) input").val("");
            $("#medicineEdit_show div:nth-child(2) input").attr({id:"medicine_newname"});
            $("#Edit_medic").hide();
            $("#new_Medic").show();
            var addEdit_medic={
              notice:"Medic AddEdit"
            }
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
              data: JSON.stringify(addEdit_medic),
              success:function(response){
                console.log(response)
                $("#medic_itemNo").text(response[0]);
              }
          })

        }else{
            $("#medicineEdit_show div:nth-child(2) input").val("");
            $("#medicineEdit_show div:nth-child(2) input").attr({id:"medicine_ItemEdit"});
            $("#Edit_medic").show();
            $("#new_Medic").hide();
        }
}

function show_consumption_data() {
  var givenDate = formatDate($("#givenDate_toshow").val());
  var notice = "consumption_data_view";
  var givDate = {
    givenDate: givenDate,
    notice: notice,
  };
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
    },
  });
  $.ajax({
    type: 'POST',
    url: "{{ route('dispencing_data') }}",
    dataType: 'json',
    contentType: 'application/json',
    data: JSON.stringify(givDate),
    success: function (response) {
      console.log(response);
      $("#con_table_view").hide();
      $("#con_row_bydate").empty();
      $("#second_table").show();
      
      
      if (response[0].length > 0) {
     
        for (let index = 0; index < response[0].length; index++) {
          var medicalDataHtml = "";
          var medicalDataArray = response[0][index]["Medical_Data"].split(';'); // Split by "/"
          $.each(medicalDataArray, function (i, item) {
            item = item.trim();
            medicalDataHtml +=
              "<li>" + item + "</li>";
          });
          // Format the given date in "d-m-y" format
          var givenDate = new Date(response[0][index]["Given_Date"]);
          var day = givenDate.getDate();
          var month = givenDate.getMonth() + 1; // Month is zero-based, so add 1
          var year = givenDate.getFullYear(); // Get the last two digits of the year
          var formattedGivenDate = (day < 10 ? '0' : '') + day+ '-' + (month < 10 ? '0' : '') + month + '-' + year ;
          
          var tableBody =
            "<tr style=''>" +
            "<td >" + (index+1) + "</td>" +
            "<td >" + formattedGivenDate + "</td>" +
            "<td >" + response[0][index]["Pid"] + "</td>" +
            "<td >" + response[0][index]['FuchiaID'] + "</td>" +
            "<td >" + response[0][index]['Sex'] + "</td>" +
            "<td >" + response[0][index]['Agey'] + "</td>" +
            "<td >" + response[0][index]['Nurse'] + "</td>" +
            "<td >" +
            "<ul id='medical-data-list' style='text-align: left;'>" +
            medicalDataHtml +
            "</ul>" +
            "</td>" +
            "<td><button class='btn btn-danger' onclick='remove_medical_list(this)' id=medical_remove_"+response[0][index]["id"]+">Delete</button></td>"+
            "</tr>";
          $("#con_row_bydate").append(tableBody);
        }
      }
    },
  });
}

function show_consumption_clear(){
  $("#second_table").hide();
  $("#con_table_view").show();
  var currentDate = new Date();
  var year = currentDate.getFullYear();
  var month = currentDate.getMonth() + 1; // Month is zero-based, so add 1
  var day = currentDate.getDate();

  // Format the date as a string (e.g., "YYYY-MM-DD")
  var formattedDate = (day < 10 ? '0' : '') + day + '-' + (month < 10 ? '0' : '') + month + '-' + year; 
    $("#givenDate_toshow").val(formattedDate);
}

function show_medic_entryList(){
  var entryDate_from=formatDate($("#medic_entry_Date_from").val());
  var entryDate_to=formatDate($("#medic_entry_Date_to").val());
  let entryShow={
    entryDate_from:entryDate_from,
    entryDate_to:entryDate_to,
    notice:"Find Entry medical item"
  }
  console.log(entryShow);
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
    },
  });
  $.ajax({
    type: 'POST',
    url: "{{ route('dispencing_data') }}",
    dataType: 'json',
    contentType: 'application/json',
    data: JSON.stringify(entryShow),
    success: function (response) {
      console.log(response);
      if(response[0].length>0){
        $(".medical-entry-list").remove();
        $.each(response[0], function(index, medicine) {
          var entry_data=$("<div>").attr({class:"row medical-entry-list"})
            .append($("<div>").attr({class:"col-sm-1"}).text(index+1))
            .append($("<div>").attr({class:"col-sm-7"}).text(itemsArray[medicine["Serial Number"]]["Medic_item"]))
            .append($("<div>").attr({class:"col-sm-2"}).text(medicine["Arrival_Date"]))
            .append($("<div>").attr({class:"col-sm-2"}).text(medicine["Amount"]));
          $("#medical_entry_list").append(entry_data);
          
        })
      }else{
        alert("No Add Medicine between these days")
      }
    }
  })

}

function remove_medical_list(button){
  row_id=event.target.id.match(/\d+/)[0];
  var give_date= formatDate($(button).closest('tr').find('td:eq(1)').text());
  var remove_medical_row={
    notice:"Remove Row",
    row_id:row_id,
    give_date:give_date,

  }
  console.log(remove_medical_row);
  if(confirm("Are you sure delete")){
    $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
    },
    });
    $.ajax({
      type: 'POST',
      url: "{{ route('dispencing_data') }}",
      dataType: 'json',
      contentType: 'application/json',
      data: JSON.stringify(remove_medical_row),
      success: function (response) {
        console.log(response);
        if(response==true){
          alert("Successfully Delete")
          show_consumption_data();
        }else{
          alert("Wrong Creditail")
        }
      }
    })
  }
  
 
  
}

</script>
@extends('layouts.app')
  
@section('content')
@auth
<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('js/jquery-ui.min.js')}}"></script>
<script src="{{asset('js/CMV/cmv.js')}}"></script>
<div class="container containers">
    <ul class="nav nav-tabs toggle"id="">
            <li class="nav-item">
                <a class="nav-link active toggle-link" data-toggle="pill" href="#cmv">CMV</a>
            </li>
            <li class="nav-item">
                <a class="nav-link toggle-link" data-toggle="pill" href="#cmv_export">CMV Export</a>
            </li>        
    </ul>
    <div class="tab-content page-color">
        <div class="tab-pane active" id="cmv" >
            
            <div id="cmv_Info">
                <div class="header-text cmv-header" id="cmv_header">
                    <h2>New CMV Section</h2>
                    <button class="btn btn-info cmv-historyBtn" id="cmv_history" type="button">History</button>
                    <button class="btn refresh-follow cervical_refresh" id="cmv_refresh" >Refresh</button>
                    <label class="from-label cmvhistory-alert" id="cmv_historyAlert"></label>
                    <div class="cmv_IDchangeBlock">
                        <input type="checkbox" id="cmv_idChange">
                        <label class="from-label">ID Change ?</label> 
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="input-group mb-3 cmv-generalCode">
                            <input type="number" id="cmv_pid" class="form-control" placeholder="General ID">
                            <input type="text" id="cmv_fid" class="form-control" placeholder="Fuchia ID">
                            <div class="input-group-append no-margin">
                                <button class="btn btn-primary" onclick="findcmv_patient()" type="button">Search</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <label class="form-label">Sex</label>
                        <span class="form-control" id="cmv_sex"></span>
                    </div>
                    <div class="col-sm-2">
                        <label class="form-label">Age</label>
                        <span id="cmv_age" class="form-control"></span> 
                    </div>
                    <div class="col-sm-2">
                        <label  class="form-label">Visit Date</label>
                        <div class="date-holder">
                            <input type="text" class="form-control Gdate" id="cmv_vDate" placeholder="dd-mm-yyyy">
                            <img src="../img/calendar3.svg" class="dateimg" alt="date">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <label class="form-label">Patient Type</label>
                        <select class="form-select" id="cmv_ptype">
                            <option value=""></option>
                            <option value="New">New</option>
                            <option value="Old">Old</option>
                        </select>
                    </div>

                </div>
                <div class="row">
                    <div class="col-sm-2">
                        <label class="form-label">ART Status</label>
                        <select class="form-select" id="cmv_artStatus">
                            <option value=""></option>
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                    </div>
                    <div class="col-sm-2">
                        <label class="form-label">Current ART Regime</label>
                        <select class="form-select" id="cmv_artRegime">
                            <option value=""></option>
                            <option value="1st">1st</option>
                            <option value="2nd">2nd</option>
                        </select>
                    </div>
                    <div class="col-sm-2">
                        <label  class="form-label">Art Start Date</label>
                        <div class="date-holder">
                            <input type="text" class="form-control Gdate" id="cmv_artStartDate" placeholder="dd-mm-yyyy">
                            <img src="../img/calendar3.svg" class="dateimg" alt="date">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <label class="form-label">Most Recent CD4</label>
                        <input type="number" id="cmv_CD4" class="form-control"></input> 
                    </div>
                    <div class="col-sm-2">
                        <label  class="form-label">Recent CD4 Date</label>
                        <div class="date-holder">
                            <input type="text" class="form-control Gdate" id="cmv_CD4Date" placeholder="dd-mm-yyyy">
                            <img src="../img/calendar3.svg" class="dateimg" alt="date">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <label class="form-label">Symptoms</label>
                        <select class="form-select" id="cmv_Symptoms" placeholder="hello">
                            <option value="" disabled selected>Flashes,Floater,Scotoma,Sudden vision loss</option>
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4 vision">
                        <h3>Vision Acuity</h3>
                        <div class="row">
                            <div class="col-sm-6">
                                <label class="form-label">Right Eye</label>
                                <div class="input-group mb-3"> 
                                    <select class="form-select" id="cmv_RVeye">
                                        <option value=""></option>
                                        <option value="no eye">No Eye</option>
                                        <option value="6">6</option>
                                        <option value="CF">CF</option>
                                        <option value="HM">HM</option>
                                        <option value="LP">LP</option>
                                        <option value="NLP">NLP</option>
                                    </select>
                                    <input type="text" id="cmv_Rveye2" class="form-control"  style="display:none">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label">Left Eye</label>
                                <div class="input-group mb-3"> 
                                    <select class="form-select" id="cmv_LVeye">
                                        <option value=""></option>
                                        <option value="no eye">No Eye</option>
                                        <option value="6">6</option>
                                        <option value="CF">CF</option>
                                        <option value="HM">HM</option>
                                        <option value="LP">LP</option>
                                        <option value="NLP">NLP</option>
                                    </select>
                                    <input type="text" id="cmv_Lveye2" class="form-control"  style="display:none">
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="col-sm-8 finding">
                        <h3>Findings</h3>
                        <div class="row">
                            <div class="col-sm-3">
                                <label class="form-label">Right Eye Diagnosis</label>
                                <select class="form-select" id="cmv_RFDeye">
                                    <option value=""></option>
                                    <option value="Active_CMV">Active_CMV</option>
                                    <option value="Inactive_CMV">Inactive_CMV</option>
                                    <option value="Extensive _CMV">Extensive _CMV</option>
                                    <option value="RD">RD</option>
                                    <option value="TB_G">TB_G</option>
                                    <option value="CWS">CWS</option>
                                    <option value="NAD">NAD</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                            <div class="col-sm-3">
                                <label class="form-label">Type of Dx (Right)</label>
                                <select class="form-select" id="cmv_RFDTeye">
                                    <option value=""></option>
                                    <option value="New">New</option>
                                    <option value="FU">FU</option>
                                    <option value="Relapse">Relapse</option>
                                    <option value="Most likely CMV">Most likely CMV </option>
                                    <option value="UK">UK</option>
                                </select>
                            </div>
                            <div class="col-sm-3">
                                <label class="form-label">Left Eye Diagnosis</label>
                                <select class="form-select" id="cmv_LFDeye">
                                    <option value=""></option>
                                    <option value="Active_CMV">Active_CMV</option>
                                    <option value="Inactive_CMV">Inactive_CMV</option>
                                    <option value="Extensive _CMV">Extensive _CMV</option>
                                    <option value="RD">RD</option>
                                    <option value="TB_G">TB_G</option>
                                    <option value="CWS">CWS</option>
                                    <option value="NAD">NAD</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                            <div class="col-sm-3">
                                <label class="form-label">Type of Dx (Left)</label>
                                <select class="form-select" id="cmv_LFDTeye">
                                    <option value=""></option>
                                    <option value="New">New</option>
                                    <option value="FU">FU</option>
                                    <option value="Relapse">Relapse</option>
                                    <option value="Most likely CMV">Most likely CMV </option>
                                    <option value="UK">UK</option>
                                </select>
                            </div>
                        </div>

                    </div>

                </div>
                <div class="row">
                    <div class="col-sm-4 treatment">
                        <h3>Treatment</h3>
                        <div class="row">
                            <div class="col-sm-6">
                                <label class="form-label">Right Eye</label>
                                <select class="form-select" id="cmv_TreReye">
                                    <option value=""></option>
                                    <option value="Injection only">Injection only</option>
                                    <option value="Valgan only">Valgan only</option>
                                    <option value="Injection with valgan">Injection with valgan</option>
                                    <option value="Observation">Observation</option>
                                    <option value="No treatment">No treatment</option>
                                </select>

                            </div>
                            <div class="col-sm-6">
                                <label class="form-label">Left Eye</label>
                                <select class="form-select" id="cmv_TreLeye">
                                    <option value=""></option>
                                    <option value="Injection only">Injection only</option>
                                    <option value="Valgan only">Valgan only</option>
                                    <option value="Injection with valgan">Injection with valgan</option>
                                    <option value="Observation">Observation</option>
                                    <option value="No treatment">No treatment</option>
                                </select>

                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="row">
                    <div class="col-sm-2">
                        
                        <div class="row">
                            <div class="col-sm-12">
                                <label class="form-label">Eye Doctor</label>
                                <input class="form-control" id="eye_doctor">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <label for="" class="form-label">Organization</label>
                        <input type="text" name="" class="form-control" id="cmv_org">
                    </div>
                    <div class="col-sm-2">
                        <label for="" class="form-label">Follow Date</label>
                        <div class="date-holder">
                            <input type="text" class="form-control Gdate" id="cmv_FollowDate" placeholder="dd-mm-yyyy">
                            <img src="../img/calendar3.svg" class="dateimg" alt="date">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label">Remark</label>
                        <input class="form-control" id="cmv_remark">
                  </div>
                </div>
                <div class="row cmv_InfoBtn">
                    <div class="col-sm-2">
                        <button class="btn btn-info cmv-saveUp" id="cmv_saveUP" onclick="cmv_SaveUp(this)"disabled>Save Record</save>
                    </div>
                </div>
            </div>

            <div id="cmv_historyBlock" style="display:none">
                <h3 class="header-text">CMV History</h3>
                <div class="row no-margin " style="justify-content:center">
                    <div class="col-sm-1 no-margin cmv_historyHead">NO.</div>
                    <div class="col-sm-2 no-margin cmv_historyHead">General ID</div>
                    <div class="col-sm-2 no-margin cmv_historyHead">FuchiaID</div>
                    <div class="col-sm-2 no-margin cmv_historyHead">Visit Date</div>
                    <div class="col-sm-2"></div>
                </div>
            </div>

        </div>
        <div class="tab-pane fade" id="cmv_export">
            <div class="header-text">
                <h2>CMV Export Section</h2>
            </div>
            <form action="{{ route('cmv_data') }}" method="POST">
                @csrf
                <div class="row" style="justify-content:center;">
                    <div class="col-sm-3">
                        <label for="validationCustom01" class="form-label">From</label>
                        
                        <div class="date-holder">
                            <input type="text" class="form-control Gdate" id="cmv_fromDate" name="cmv_dateFrom" placeholder="dd-mm-yyyy">
                            <img src="../img/calendar3.svg" class="dateimg" alt="date">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <label for="validationCustom01" class="form-label">To</label>
                        <div class="date-holder">
                            <input type="text" class="form-control Gdate" id="cmv_ToDate" name="cmv_dateTo" placeholder="dd-mm-yyyy">
                            <img src="../img/calendar3.svg" class="dateimg" alt="date">
                        </div>
                    </div>
                    
                    <div class="col-sm-1" style="display:none"><input  name="notice"  value="cmv Export"></div>
                    <div class="col-sm-2">
                        <button class="btn btn-primary export-ccBtn">Export</button>
                    </div>
                    
                </div>
            </form>  

        </div>
    </div>
</div>

@endauth
@endsection
<script type="text/javascript">
    let clinic_code;let cmv_history,update_Id,serachRes={};
    let cmv_insertList=[
          "Clinic_code","Clinic Code",
          "Pid_cmv","cmv_pid",
          "FuchiaID_cmv","cmv_fid",
          "Sex","cmv_sex",
          "Agey","cmv_age",
          "Visit_date","cmv_vDate",
          "Patient_Type","cmv_ptype",
          "Art_Status","cmv_artStatus",
          "Currnt_Art_Regime","cmv_artRegime",
          "Art_StartDate","cmv_artStartDate",
          "Most_CD4","cmv_CD4",
          "Recent_CD4Date","cmv_CD4Date",
          "Symptom","cmv_Symptoms",
          "Vision_Right","Find_Righteye",
          "Vision_Left","Find_Lefteye",
          "Finding_Right","cmv_RFDeye",
          "Finding_Rdx","cmv_RFDTeye",
          "Finding_Left","cmv_LFDeye",
          "Finding_Ldx","cmv_LFDTeye",
          "Treatment_Right","cmv_TreReye",
          "Treatment_Left","cmv_TreLeye",
          "Doctor_name","eye_doctor",
          "Remark","cmv_remark",
          "Follow_Date","cmv_FollowDate",
          "Org","cmv_org"
    ]
    function findcmv_patient(){
        var cmv_Pid=$("#cmv_pid").val();
        var cmv_Fid=$("#cmv_fid").val();
        var cmv_Ptsearch={
            cmv_Pid:cmv_Pid,
            cmv_Fid:cmv_Fid,
            notice:"Find the Patient"
        }
        console.log(cmv_Ptsearch);
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                }
        });
        $.ajax({
            type:'POST',
            url:"{{route('cmv_data')}}",
            dataType:'json',
            contentType: 'application/json',
            data: JSON.stringify(cmv_Ptsearch),
            success:function(response){
              console.log(response);
              serachRes=response[0]
              if(response!=null){
                $("#cmv_pid").prop("disabled",true);
                $("#cmv_fid").val(response[0]["FuchiaID"]);
                $("#cmv_sex").text(response[0]["Gender"]);
                $("#cmv_age").text(response[0]["Agey"])
                $("#cmv_saveUP").prop("disabled",false);
                clinic_code=response[0]["Clinic Code"];

              }
                if(response[1].length>0){
                    cmv_history=response[1]
                    $("#cmv_history").show();
                    $("#cmv_historyAlert").text(response[1].length+"  Record").show();
                }

              
              
            }
        })
    }
    function cmv_SaveUp(button){
        let cmv_name;let cmv_data={};
        $("#cmv_Info input, #cmv_Info span, #cmv_Info select").each(function() {
             cmv_name=$(this).attr("id");
            if($(this).is("input,select")){
                if($(this).hasClass("Gdate")&&$(this).is("input")){
                  cmv_data[cmv_name]=formatDate($(this).val());  
                }else{
                    cmv_data[cmv_name]=($(this).val());
                }
            }else if($(this).is("span")){
                cmv_data[cmv_name]=($(this).text());
            }           
        })
        if($("#cmv_RVeye").val()=="6"||$("#cmv_RVeye").val()=="CF"){
            cmv_data["Find_Righteye"]=cmv_data["cmv_RVeye"]+"/"+cmv_data["cmv_Rveye2"];
        }else{
            cmv_data["Find_Righteye"]=cmv_data["cmv_RVeye"];
        }

        if($("#cmv_LVeye").val()=="6"||$("#cmv_LVeye").val()=="CF"){
            cmv_data["Find_Lefteye"]=cmv_data["cmv_LVeye"]+"/"+cmv_data["cmv_Lveye2"];
        }else{
            cmv_data["Find_Lefteye"]=cmv_data["cmv_LVeye"];
        }
        
        cmv_data["Clinic Code"]=clinic_code;
        cmv_data["notice"]="cmv save Record";
        if(update_Id){
            cmv_data["notice"]="cmv Update Record";
            cmv_data["update_id"]=update_Id;

        }
        console.log(serachRes["Pid"]+"//"+cmv_data["cmv_pid"]);
        console.log(cmv_data)
        if(serachRes["Pid"] == cmv_data["cmv_pid"]){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                }
            });
            $.ajax({
                type:'POST',
                url:"{{route('cmv_data')}}",
                dataType:'json',
                contentType: 'application/json',
                data: JSON.stringify(cmv_data),
                 beforeSend: function() {
            $(button).prop("disabled", true);
            timeoutHandle = setTimeout(oneClick, 3000);
          },
          success: function(response) {
            $(button).prop("disabled", false);
            clearTimeout(timeoutHandle);
                alert(response);
                history.go(0);
                
                }
            });
        }else{
            alert("Wrong Credential.")
        }
        
    }
    function cmv_History(){
        $("#cmv_historyBlock").hide();
        $("#cmv_Info").show();
        update_Id=$(event.target).attr("id").match(/\d+/)[0];
        cmv_his_room=$(event.target).parent().parent().children().first().text()-1;

        for(var j=0;j<cmv_insertList.length;j=j+2){
            if($("#"+cmv_insertList[j+1]).is("span")){
               
            }else{
                $("#"+cmv_insertList[j+1]).val(cmv_history[cmv_his_room][cmv_insertList[j]]);
            }
            
        }
        vision_Reye=cmv_history[cmv_his_room]["Vision_Right"].split("/");
        vision_Leye=cmv_history[cmv_his_room]["Vision_Left"].split("/");
        $("#cmv_RVeye").val(vision_Reye[0]);
        $("#cmv_LVeye").val(vision_Leye[0]);
        cmv_VisionEyes();
        $("#cmv_Rveye2").val(vision_Reye[1]);
        $("#cmv_Lveye2").val(vision_Leye[1]);
        $(".cmv_IDchangeBlock").show();
        $("#cmv_header h2").text("CMV Update Section");
        $("#cmv_saveUP").text("Update Record")
        DateTo_text();
    }
    function cmv_Remove(){
        remove_id=$(event.target).attr("id").match(/\d+/)[0];
        remove_patient=$(event.target).parent().siblings().eq(1).text();
        remove_data={
            remove_id:remove_id,
            remove_patient:remove_patient,
						notice:"cmv remove Record",
        }
        console.log(remove_data);
				if(confirm("Are you sure this CMV data")){
					$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
					});
					$.ajax({
									type:'POST',
									url:"{{route('cmv_data')}}",
									dataType:'json',
									contentType: 'application/json',
									data: JSON.stringify(remove_data),
									success:function(response){
									alert(response);
									history.go(0);
									
									}
					});
				}
        

    }

    function  cmv_VisionEyes(){
        if($("#cmv_RVeye").val()=="6"||$("#cmv_RVeye").val()=="CF"){
            $("#cmv_Rveye2").show();
        }else{
            $("#cmv_Rveye2").hide();
        }
        if($("#cmv_LVeye").val()=="6"||$("#cmv_LVeye").val()=="CF"){
            $("#cmv_Lveye2").show();
        }else{
            $("#cmv_Lveye2").hide();
        }
    }
    function Gotohome(){
        $("#cmv_historyBlock").hide();
        $("#cmv_Info").show();
    }
</script>

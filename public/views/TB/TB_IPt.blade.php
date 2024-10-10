@extends('layouts.app')
  
@section('content')
@auth
<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('js/jquery-ui.min.js')}}"></script>
<script src="{{asset('js/TB_js/tbIPT.js')}}"></script>
<div class="container containers">
    <ul class="nav nav-tabs toggle"id="">
            <li class="nav-item">
                <a class="nav-link active toggle-link" data-toggle="pill" href="#Tb_IPT">TB-IPT</a>
            </li>
            <li class="nav-item">
                <a class="nav-link  toggle-link" data-toggle="pill" href="#tb_export">Export</a>
            </li>         
    </ul>
    <div class="tab-content tb-parent-div">
        <div class="tab-pane active Tb-IPTSection" id="Tb_IPT">
            <div id="ipt_mainData">
                <div class="header-text ipt-header" id="ipt_header">
                    <h2>
                      New TB IPT Section
                      <button class="btn refresh-follow" id="ipt_refresh" style="float: right">Refresh</button>
                    </h2>
                    <button class="btn btn-info ipt-historyBtn" id="ipt_history" type="button">History</button>
                   
                    <label class="from-label history-alert" id="ipt_historyAlert"></label>
                    <div class="ipt_IDchangeBlock">
                        <input type="checkbox" id="ipt_idChange">
                        <label class="from-label">ID Change ?</label> 
                    </div>
                   

                </div>
                <div class="iptGeneral-info">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="input-group mb-3 tbIPt-generalCode">
                                <input type="number" id="ipt_pid" class="form-control" placeholder="General ID">
                                <input type="text" id="ipt_fid" class="form-control" placeholder="Fuchia ID">
                                <div class="input-group-append no-margin">
                                    <button class="btn btn-primary" onclick="findIpt_patient()" type="button">Search</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <label  class="form-label">Name</label>
                            <span id="ipt_name" class="form-control"></span> 
                        </div>
                        <div class="col-sm-2">
                            <label  class="form-label">Sex</label>
                            <span id="ipt_sex" class="form-control"></span> 
                        </div>
                        <div class="col-sm-2">
                            <label  class="form-label">Register Age(Year)</label>
                            <span id="ipt_agey" class="form-control"></span> 
                        </div>
                        <div class="col-sm-2">
                            <label  class="form-label">Register Age(Month)</label>
                            <span id="ipt_agem" class="form-control"></span> 
                        </div>

                    
                    </div>
                
                </div>
                <div class="ipt_data">
                    <div class="row">
                        <div class="col-sm-2 ipt-counsellor">
                            <label for="validationCustom01" class="form-label">Name of Counsellor</label>
                            <select class="form-control" id="ipt_counselor" name="">
                                <option value="0 "> </option>
                                <option value="1">Counselor 1</option>
                                <option value="2">Counselor 2</option>
                                <option value="3">Counselor 3</option>
                                <option value="4">Counselor 4</option>
                                <option value="5">Counselor 5</option>
                                <option value="6">Counselor 6</option>
                                <option value="7">Counselor 7</option>
                                <option value="8">Counselor 8</option>
                                <option value="9">Counselor 9</option>
                                <option value="10">Counselor 10</option>
                                <option value="11">Counselor 11</option>
                                <option value="12">Counselor 12</option>
                                <option value="13">Counselor 13</option>
                                <option value="14">Counselor 14</option>
                                <option value="15">Counselor 15</option>
                                <option value="16">Counselor 16</option>
                                <option value="17">Counselor 17</option>
                                <option value="18">Counselor 18</option>
                                <option value="19">Counselor 19</option>
                                <option value="20">Counselor 20</option>
                                <option value="21">Counselor 21</option>
                                <option value="22">Counselor 22</option>
                                <option value="23">Counselor 23</option>
                                <option value="24">Counselor 24</option>
                                <option value="25">Counselor 25</option>
                                <option value="26">Counselor 26</option>
                                <option value="27">Counselor 27</option>
                                <option value="28">Counselor 28</option>
                                <option value="29">Counselor 29</option>
                                <option value="30">Counselor 30</option>
                                <option value="31">Counselor 31</option>
                                <option value="32">Counselor 32</option>
                                <option value="33">Counselor 33</option>
                            </select>
                        </div>
                        <div class="col-sm-2">
                            <label for="validationCustom01" class="form-label">IPT Register date</label>
                            <div class="date-holder">
                                <input type="text" class="form-control Gdate" id="ipt_regiDate" placeholder="dd-mm-yyyy">
                                <img src="../img/calendar3.svg" class="dateimg" alt="date">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <label  class="form-label">Really IPT Start  date</label>
                            <div class="date-holder">
                                <input type="text" class="form-control Gdate" id="ipt_startDate" placeholder="dd-mm-yyyy">
                                <img src="../img/calendar3.svg" class="dateimg" alt="date">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <label  class="form-label">IPT Discontinuation date</label>
                            <div class="date-holder">
                                <input type="text" class="form-control Gdate" id="ipt_DisconDate" placeholder="dd-mm-yyyy">
                                <img src="../img/calendar3.svg" class="dateimg" alt="date">
                            </div>
                        </div>
                        <!-- <div class="col-sm-3">
                            <label  class="form-label">IPT Discontinuation date</label>
                            <div class="date-holder">
                                <input type="text" class="form-control Gdate" id="ipt_DisconDate2" placeholder="dd-mm-yyyy">
                                <img src="../img/calendar3.svg" class="dateimg" alt="date">
                            </div>
                        </div> -->
                        <div class="col-sm-2">
                            <label class="form-label">Outcome</label>
                            <select class="form-control" id="ipt_outcome">
                                <option value="-"></option>
                                <option value="Completed >6months">Completed > 6months</option>
                                <option value="D/C side effects">D/C side effects</option>
                                <option value="D/C moved">D/C moved</option>
                                <option value="D/C by patient">D/C by patient</option>
                                <option value="Develop TB">Develop TB</option>
                                <option value="Died">Died</option>
                            </select>
                        </div>
                        <div class="col-sm-12">
                            <label  class="form-label">Remark</label>
                            <input id="ipt_remark" type="text" class="form-control"> 
                        </div>
                    </div>
                </div>
                <div class="ipt_btn">
                    <div class="row">
                        <div class="col-sm-3">
                            <button class="btn btn-success ipt_save" onclick="ipt_SaveUp()" id="iptsaveUp" disabled="true">Save Record</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ipt-historyshow" id="ipt_historyShow">
                <div class="header-text ipt_historyHead">
                    <h3>IPT Records</h3>
                </div>
                <div class="ipt-followList" id="ipt_followList">
                    <div class="row no-margin">
                        <div class="col-sm-1 no-margin">NO</div>
                        <div class="col-sm-2 no-margin">General ID</div>
                        <div class="col-sm-2 no-margin">Fuchia ID</div>
                        <div class="col-sm-2 no-margin">Ipt Start Date</div>
                        <div class="col-sm-2 no-margin">Outcome Result</div>
                        <div class="col-sm-2 no-margin"></div>
                    </div>
                </div>
                <div style="text-align:center"><button class="btn iptHis-cancel" id="iptHis-cancel">Cancel</button></div>
                
            </div>
            
            
        </div>
        <div class="tab-pane fade" id="tb_export">
            <h2 class="header-text">Export</h2>
            <form action="{{ route('tb_IPT_data') }}" method="post">
                @csrf
                <div class="row export-div">
                    <div class="col-sm-2">
                        <label class="form-label">Form</label>
                        <div class="date-holder">
                            <input type="text" class="form-control Gdate" name="dateFrom" id="tb_exportStart" placeholder="dd-mm-yyyy">
                            <img src="../img/calendar3.svg" class="dateimg" alt="date">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <label class="form-label">To</label>
                        <div class="date-holder">
                            <input type="text" class="form-control Gdate" name="dateTo" id="tb_exportEnd" placeholder="dd-mm-yyyy">
                            <img src="../img/calendar3.svg" class="dateimg" alt="date">
                        </div>
                    </div>
                    <div class="col-sm-2 ipt-exportBtn"><button class="btn btn-info">Export IPT</button></div>
                    <div class="col-sm-1" style="display: none;"><input name="notice"  value="Export IPT"></div>
                </div>
            </form>
            
            <!-- export date -->
        </div>
       

    </div>

</div>
@endauth
@endsection
<script type="text/javascript">

    let clinic_code,update_id,ipt_history=[];
    let ipt_fill=[
        "Pid_iptTB","ipt_pid",
        "FuchiaID_iptTB","ipt_fid", 
        "Counsellor","ipt_counselor", 
        "IPT_regDate","ipt_regiDate", 
        "IPT_startDate","ipt_startDate", 
        "IPT_disconDate","ipt_DisconDate", 
        "Outcome","ipt_outcome", 
        "Remark","ipt_remark", 
    ]
    function findIpt_patient(){
        var find_iptPatient={
            Pid:$("#ipt_pid").val(),
            Fid:$("#ipt_fid").val(),
            notice:"Find Patient ID",
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });
        $.ajax({
                type:'POST',
                url:"{{route('tb_IPT_data')}}",
                dataType:'json',
                //  processData:false,
                contentType: 'application/json',
                data: JSON.stringify(find_iptPatient),
                success:function(response){
                    console.log(response);
                    if(response[0]!=null){
                        $("#ipt_pid").val(response[0]["Pid"]);
                        $("#ipt_fid").val(response[0]["FuchiaID"]);
                        $("#ipt_name").text(response[0]["Name"]);
                        $("#ipt_sex").text(response[0]["Gender"]);
                        $("#ipt_agey").text(response[0]["Agey"]);
                        $("#ipt_agem").text(response[0]["Agem"]);
                        clinic_code=response[0]["Clinic Code"];
                        $(".ipt_save").prop("disabled",false);
                    }else {
                        alert("Your ID do not have in Clinic or May be wrong ID")
                        // history.go(0);
                    }
                       
                        $("#ipt_pid,#ipt_fid").prop("disabled",true);
                        console.log(ipt_fill.length);
                        if(response[2].length>0){
                            ipt_history=response[2];
                            $("#ipt_history,#ipt_historyAlert,.ipt_IDchangeBlock").show();
                            $("#ipt_historyAlert").text(response[2].length+" Records");
                            if(response[1]!=null){
                                for(var i=4;i<ipt_fill.length;i=i+2){

                                    $("#"+ipt_fill[i+1]).val(response[1][ipt_fill[i]]);
                                }
                                $("#Tb_IPT h2").text("Old TB IPT Save Form")
                                update_id=response[1]["id"];
                            }

                        }
                        

                        DateTo_text();
                    
                    
                }
        })
    }

    function ipt_SaveUp(){
        var Ipt_data={};
        $("#Tb_IPT input,#Tb_IPT select,#Tb_IPT span").each(function(index){
            var idname=$(this).attr("id");
            
            if($(this).is("input,select")){
                if($(this).is("input") && $(this).hasClass("Gdate")){
                    Ipt_data[idname]=formatDate($(this).val());
                }else{
                    Ipt_data[idname]=$(this).val();
                }
                

            }else if($(this).is("span")){
                Ipt_data[idname]=$(this).text();
            }
        })

        Ipt_data["notice"]="IPT save record";
        Ipt_data["clinic Code"]=clinic_code;
        if(update_id){
            Ipt_data["notice"]="IPT updated record";
            Ipt_data["update_id"]=update_id;
        }

        console.log(Ipt_data);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });
        $.ajax({
                type:'POST',
                url:"{{route('tb_IPT_data')}}",
                dataType:'json',
                //  processData:false,
                contentType: 'application/json',
                data: JSON.stringify(Ipt_data),
                success:function(response){
                    console.log(response);
                    alert("Successfully collected")
                    history.go(0);
                }
        })
    }

    function ipt_remove() {
        id=event.target.id.match(/\d+/)[0];
        var Pid = $(event.target).parent().parent().children().eq(1).text();
        delete_data={
            id:id,
            Pid:Pid,
            notice:"Remove IPT",
        }
        console.log(delete_data);
        if(confirm("Are you sure delete this row")){
          $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
          });
          $.ajax({
                  type:'POST',
                  url:"{{route('tb_IPT_data')}}",
                  dataType:'json',
                  //  processData:false,
                  contentType: 'application/json',
                  data: JSON.stringify(delete_data),
                  success:function(response){
                      console.log(response);
                      if(response==1){
                        alert("Success Delete");
                        findIpt_patient();
                        $("#ipt_mainData").show();
                        ("#ipt_historyShow").hide();
                      }else{
                        alert("Wrong Permisiion")
                      }
                  }
          })
        }
        
    }

    function ipt_hisView(){
        $("#ipt_mainData").show();
        $("#ipt_historyShow").hide();
        var togetData = $(event.target).parent().parent().children().first().text();
        togetData-=1;
        for(var j=0;j<ipt_fill.length;j=j+2){
            if($("#"+ipt_fill[j+1]).is("span")){
                $("#"+ipt_fill[j+1]).text(ipt_history[togetData][ipt_fill[j]]);
            }else{
                $("#"+ipt_fill[j+1]).val(ipt_history[togetData][ipt_fill[j]]);
            }
            
           }
           $("#Tb_IPT h2").text(" TB IPT Updated Form");
           update_id=$(event.target).attr("id").match(/\d+/)[0];
           $("#iptsaveUp").text("Update Record")
           DateTo_text();


    }
</script>
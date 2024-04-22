@extends('layouts.app')
  
@section('content')
@auth
<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('js/jquery-ui.min.js')}}"></script>
<script src="{{asset('js/TB_js/pretb.js')}}"></script>
{{-- do not save and update Age fuchia gender  --}}
<div class="container containers">
    <ul class="nav nav-tabs toggle"id="">
            <li class="nav-item">
                <a class="nav-link active toggle-link" data-toggle="pill" href="#preTbAssment">Pre-TB Assement</a>
            </li> 
            <li class="nav-item">
                <a class="nav-link  toggle-link" data-toggle="pill" href="#tb_export">Export</a>
            </li>         
    </ul>
    <div class="tab-content tb-parent-div">
        <div class="tab-pane active preTbSection" id="preTbAssment">
                <div class="preTB-follow" id="preTB_Fsection">
                    <div class="row"><h2>PreTB Follow Histroy</h2>
                      
                    </div>
                    <div class="row FpreTB-coheader">
                        <div class="col-sm-1">No.</div>
                        <div class="col-sm-4">General Id</div>
                        <div class="col-sm-4">Visit Date</div>
                        <div class="col-sm-3">
                            <button class="btn btn-info" id="main_page_return">Main Page</button>
                        </div>
                    </div>
                </div>
                <div class="preFollow-button">
                    <button class="btn" id="preTB_history">PreTB-History</button>
                </div>
                <div class="IDchange-comfirm">
                    <div class="row">
                        <h2>Do you wanna change ID</h2>
                    </div>
                    <div class="row idchange-Btnrow">
                        <div class="col-sm-2 pretb-Idchange">
                            <button class="btn IDchange-yesBtn " id="preTB_idYes">Yes</button>
                        </div>
                        <div class="col-sm-2 pretb-Idchange">
                            <button class="btn IDchange-noBtn " id="preTB_idNo">No</button>
                        </div>
                    </div>
                    
                </div>
                <div class="preTB_Entry">
                    <div class="header-text">
                        <h2>New PreTB Assessment</h2>
                        <div class="preTB-refresh"> <button class="btn refresh-follow " id="preTB_refresh">Refresh</button></div>
                    </div>
                    <div class="part-section">
                        <h3>Part A :Before consulting with radiologist/supervisors</h3>
                        <div class="row">
                            <div class="col-sm-4 preTB-search">
                                <div class="input-group">
                                    <input id="preTb_Pid" class="form-control" placeholder="General ID" >
                                    <input id="preTb_fuchiaID" class="form-control" placeholder="Fuchia ID">
                                    <button class="btn btn-primary"  type="button" onclick="preTB_search()">Search</button>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <label for="validationCustom01" class="form-label">Name</label>
                                <span id="preTb_name"   class="form-control" ></span>
                            </div>
                            <div class="col-sm-2">
                                <label for="validationCustom01" class="form-label">Register Age(Year)</label>
                                <span id="preTb_agey"   class="form-control" ></span>
                            </div>
                            <div class="col-sm-2">
                                <label for="validationCustom01" class="form-label">Register Age(Month)</label>
                                <span id="preTb_agem"   class="form-control" ></span>
                            </div>
                            <div class="col-sm-2">
                                <label for="validationCustom01" class="form-label">Gender</label>
                                <span id="preTB_gender" class="form-control" id="validationCustom01" ></span>                                                  
                            </div>
                            <div class="col-sm-2">
                                <label for="validationCustom01" class="form-label">Visit Date</label>
                                <div class="date-holder">
                                    <input type="text" class="form-control Gdate" id="preTb_vDate" placeholder="dd-mm-yyyy">
                                    <img src="../img/calendar3.svg" class="dateimg" alt="date">
                                </div>
                            </div>
                            <div class="col-sm-1 kap-block">
                                <input type="checkbox" id="kap_check" name=""><label>KAP</label>
                            </div>
                        </div>
                        <div class="subTb-section">
                            <div class="subTb-header"><h3>Visits</h3></div>
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="">Mode of Entry</label>
                                    <select class="form-select" id="preTb_mod_entry" required="">
                                        <option value="general">General</option>
                                        <option value="plhiv">PLHIV</option>
                                        <option value="ncd">NCD</option>
                                    </select>      
                                </div>
                                
                                <div class="col-sm-3">
                                    <label for="validationCustom01" class="form-label">Date of TB Screening</label>
                                    <div class="date-holder">
                                        <input type="text" class="form-control Gdate" id="preTb_nextScreenDate" placeholder="dd-mm-yyyy">
                                        <img src="../img/calendar3.svg" class="dateimg" alt="date">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <label for="validationCustom01" class="form-label">Date of Next Visit</label>
                                    <div class="date-holder">
                                        <input type="text" class="form-control Gdate" id="preTb_nextVDate" placeholder="dd-mm-yyyy">
                                        <img src="../img/calendar3.svg" class="dateimg" alt="date">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="subTb-section preTB-BioRes">
                            <div class="subTb-header"><h3>Biological Result</h3></div>
                            <div class="row">
                                <div class="col-sm-6 preTb-HTC-block">
                                    <input type="checkbox" id="htcpre_check" name=""><label class="preTB_bioChecklabel">HTC</label>
                                    <div class="htcpre_checkData">
                                        <div class="row">
                                            <div class="col-sm-5">
                                                <label>HTC result</label>
                                            </div>
                                            <div class="col-sm-7">
                                                <select class="form-select" id="preTb_HtcRes">
                                                    <option value="-"></option>
                                                    <option value="R">R</option>
                                                    <option value="NR">NR</option>
                                                    <option value="ND">ND</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-5">
                                                <label>HTC Date</label>
                                            </div>
                                            <div class="col-sm-7">
                                                <div class="date-holder">
                                                    <input type="text" class="form-control Gdate" id="preTb_HtcDate" placeholder="dd-mm-yyyy">
                                                    <img src="../img/calendar3.svg" class="dateimg" alt="date">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6 preTb-AFB-block">
                                    <input type="checkbox" id="afbpreTb_check" name=""><label class="preTB_bioChecklabel">Sputum AFB</label>
                                    <div class="afbpreTb_checkData">
                                        <div class="row">
                                            <div class="col-sm-5">
                                                <label>AFB result</label>
                                            </div>
                                            <div class="col-sm-7">
                                                <select class="form-select" id="preTb_AfbRes">
                                                    <option value="-"></option>
                                                    <option value="Positive">Positive</option>
                                                    <option value="Negative">Negative</option>
                                                    <option value="Result Pending">Result Pending</option>
                                                    <option value="Not Done">Not Done</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-5">
                                                <label>AFB Date</label>
                                            </div>
                                            <div class="col-sm-7">
                                                <div class="date-holder">
                                                    <input type="text" class="form-control Gdate" id="preTb_AfbDate" placeholder="dd-mm-yyyy">
                                                    <img src="../img/calendar3.svg" class="dateimg" alt="date">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 preTb-Genex-block">
                                    <input type="checkbox" id="genexTb_check" name=""><label class="preTB_bioChecklabel">GenXpert</label>
                                    <div class="genexTb_checkData">
                                        <div class="row">
                                            <div class="col-sm-5">
                                                <label>GeneXpert result</label>
                                            </div>
                                            <div class="col-sm-7">
                                                <select class="form-select" id="preTb_geneXRes">
                                                    <option value="-"></option>
                                                    <option value="MTB D">MTB D</option>
                                                    <option value="MTB ND">MTB ND</option>
                                                    <option value="RRN">RRN</option>
                                                    <option value="RRY">RRY</option>
                                                    <option value="Result Pending">Result Pending</option>
                                                    <option value="Not Done">Not Done</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-5">
                                                <label>GeneXpert Date</label>
                                            </div>
                                            <div class="col-sm-7">
                                                <div class="date-holder">
                                                    <input type="text" class="form-control Gdate" id="preTb_geneXDate" placeholder="dd-mm-yyyy">
                                                    <img src="../img/calendar3.svg" class="dateimg" alt="date">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 preTb-CXR-block">
                                    <input type="checkbox" id="cxrTb_check" name=""><label class="preTB_bioChecklabel">CXR</label>
                                    <div class="cxrTb_checkData">
                                        <div class="row">
                                            <div class="col-sm-5">
                                                <label>CXR result</label>
                                            </div>
                                            <div class="col-sm-7">
                                                <select class="form-select" id="preTb_CXRRes">
                                                    <option value="-"></option>
                                                    <option value="MAM">MAM</option>
                                                    <option value="NO MAM">NO MAM</option> 
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-5">
                                                <label>CXR Date</label>
                                            </div>
                                            <div class="col-sm-7">
                                                <div class="date-holder">
                                                    <input type="text" class="form-control Gdate" id="preTb_CXRDate" placeholder="dd-mm-yyyy">
                                                    <img src="../img/calendar3.svg" class="dateimg" alt="date">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="subTb-section tb-newClsym">
                            <div class="subTb-header"><h3>New clinical symptoms</h3></div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <input type="checkbox" id="feverpreTb_check" name="">
                                    <label class="new_clinicalLabel">Fever</label>
                                    <div class="feverpreTb_checkData">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label>Day:</label>
                                            </div>
                                            <div class="col-sm-8">
                                                <input class="form-control" type="number" id="preTB_feverDay">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-sm-6">
                                    <input type="checkbox" id="coughpreTb_check" name="">
                                    <label class="new_clinicalLabel">Cough</label>
                                    <div class="coughpreTb_checkData">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label>Day:</label>
                                            </div>
                                            <div class="col-sm-8">
                                                <input class="form-control" type="number" id="preTB_coughDay">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <input type="checkbox" id="nigghtSwpreTb_check" name="">
                                    <label class="new_clinicalLabel">Nigth sweat</label>
                                    <div class="nigghtSwpreTb_checkData">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label>Day:</label>
                                            </div>
                                            <div class="col-sm-8">
                                                <input class="form-control" type="number" id="preTB_nigthSweDay">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            
                                <div class="col-sm-6">
                                    <input type="checkbox" id="lowpreTb_check" name="">
                                    <label class="new_clinicalLabel">LOW</label>
                                    <div class="lowpreTb_checkData">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label>Day:</label>
                                            </div>
                                            <div class="col-sm-8">
                                                <input class="form-control" type="number" id="preTB_lowDay">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <input type="checkbox" id="loapreTb_check" name="">
                                    <label class="new_clinicalLabel">LOA</label>
                                    <div class="loapreTb_checkData">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label>Day:</label>
                                            </div>
                                            <div class="col-sm-8">
                                                <input class="form-control" type="number" id="preTB_loaDay">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <input type="checkbox" id="antipreTb_check" name="">
                                    <label class="new_clinicalLabel">Previous anti-TB history</label>
                                </div>
                               
                                <div class="col-sm-6">
                                    <input type="checkbox" id="lympreTb_check" name="">
                                    <label class="new_clinicalLabel">Lymphadenopathy</label>
                                    <div class="lympreTb_checkData">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label>Day:</label>
                                            </div>
                                            <div class="col-sm-8">
                                                <input class="form-control" type="number" id="preTB_lympDay">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label>Describe:</label>
                                            </div>
                                            <div class="col-sm-8">
                                                <input class="form-control" type="text" id="preTB_lympdescribe">
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            

                            </div>
                        </div>
                        <div class="subTb-section tb-reasonCXR">
                            <div class="subTb-header "><h3>Reason CXR Result</h3></div>
                            
                            <div class="row">
                                <div class="col-sm-3">
                                    <label>Reason for CXR request</label>
                                    <select class="form-select" id="preTb_cxrRequest" required="">
                                        <option value="-"></option>
                                        <option value="tbDiagnosis">For Tb diagnosis</option>
                                        <option value="Asym tracing">Asym contact tracing</option>
                                        <option value="Other">Other</option>
                                    </select>
                                
                                </div>
                                <div class="col-sm-3">
                                    <label>Recheck after (days of antibiotic)</label>
                                    <input type="number" id="preTB_recheckAfter" name="" class="form-control">
                                </div>
                                <div class="col-sm-1 preTB-CXRor">
                                    <label>OR</label>
                                </div>
                                <div class="col-sm-3">
                                    <label>Months of TB anti trement</label>
                                    <input type="number" id="preTB_monthAntiTre" name="" class="form-control">
                                </div>
                            </div>
                            
                        </div>
                        <div class="subTb-section tb-BeforeCXR">
                            <div class="subTb-header "><h3>Before CXR Result</h3></div>
                            
                            <div class="row">
                                <div class="col-sm-12">
                                    <label>MD's provisional diagnosis/Action plan</label>
                                    <input type="textarea" id="preTB_MDaction" name="" class="form-control">
                                </div>
                                <div class="col-sm-3 ">
                                    <input type="checkbox" id="preTb_antibiotic" name=""><label>Antibiotic</label>
                                </div>
                            
                            </div>
                            
                        </div>
                        <div class="subTb-section tb-CXRreading">
                            <div class="subTb-header "><h3>CXR reading by MDs (prior radiologist)</h3></div>
                            
                            <div class="row" id="CXRreading_data">
                                <div class="col-sm-3 CXR-dataCheck">
                                    <input type="checkbox" id="susAct_onpreTb" name=""><label>Suspicoin on Active TB</label>
                                </div>
                                <div class="col-sm-3 CXR-dataCheck">
                                    <input type="checkbox" id="preTb_consultneed" name=""><label>Further consulting needed</label>
                                </div>
                                <div class="col-sm-6">
                                    <label>If no, Why</label>
                                    <input type="textarea" id="preTB_FurCoulting_ifnoWhy" name="" class="form-control">
                                </div>
                                <div class="col-sm-12">
                                    <label>Other</label>
                                    <input type="textarea" id="preTB_cxrother" name="" class="form-control">
                                </div>
                            </div>
                            
                        </div>

                    </div>
                    <div class="part-section">
                        <div class=""><h3>Part B :After consulting with radiologist/supervisors</h3></div>
                        <div class="row" id="partB_data">
                            <div class="col-sm-12">
                                <label>Radiologist opinion</label>
                                <input type="text" class="form-control" id="partB_radiologist" name="">
                            </div>
                            <div class="col-sm-12">
                                <label>MD's Management Plan</label>
                                <input type="text" class="form-control" id="partB_MDmanPlan" name="">
                            </div>
                            <div class="col-sm-3 need_teachAdv">
                                <input type="checkbox" id="partB_needTeachAdv" name=""><label>Need Teach team advice</label>
                            </div>
                            <div class="col-sm-2">
                            <label class="form-label">Advice</label>
                            </div>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" id="preTB_teachAdvice" disabled="true" name="">
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-sm-2">
                            <label class="form-label">MD's Name</label>
                            <input class="form-control" id="preTB_MD">
                        </div>
                        <div class="col-sm-4">
                            <label class="form-label">Case Noted</label>
                            <div class="input-group">
                                <input class="form-control" id="preTB_CaseIn">
                                <select class="form-select" id="preTB_caseChoice">
                                    <option value="-"></option>
                                    <option value="Pending">Pending</option>
                                    <option value="Close">Close</option>
                                </select>
                            </div>
                            
                        </div>
                    </div>
                    <div class="row preTB_button">
                        <div class="col-sm-2">
                            <button class="btn btn-success preTB-assSave" onclick="preTB_asseSave()" disabled="true">Save Record</button>
                        </div>
                    </div>
                </div>  
        </div>
        <div class="tab-pane fade" id="tb_export">
            <h2 class="header-text">Export</h2>
            <form action="{{ route('preTB_Assement_data') }}" method="post">
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
                    <div class="col-sm-2 ipt-exportBtn"><button class="btn btn-info">Export PreTB</button></div>
                    <div class="col-sm-1" style="display: none;"><input name="notice"  value="Export PreTB"></div>
                </div>
            </form>
        </div>
       

    </div>

</div>
@endauth
@endsection
<script type="text/javascript">
    let follow_cCode,Fhistory_data,update_alert,preTB_Follow_UpNo;
    let preTB_idData=[
        "Pid_preTB","preTb_Pid",
        // "FuchiaID_preTB","preTb_fuchiaID", 
        // "Agey_preTB","preTb_agey",
        // "Agem_preTB","preTb_agem",
        // "Gender_preTB","preTB_gender",
        "VisitDate_preTB","preTb_vDate",
        "KAP_preTB","kap_check",
        "ModEntry_preTB","preTb_mod_entry",
        "NextVDate_preTB","preTb_nextVDate",
        "AntiTB_History_preTB","antipreTb_check",
        "TBscreenDate_preTB","preTb_nextScreenDate",
        "ReasonCXR_preTB","preTb_cxrRequest",
        "Recheck_preTB","preTB_recheckAfter",
        "Month_TBantiTre_preTB","preTB_monthAntiTre",
        "MDprovisional_diagnosisPlan_preTB","preTB_MDaction",
        "Antibiotic_preTB","preTb_antibiotic",
        "Sus_ActiveTB_preTB","susAct_onpreTb",
        "FurtherCounsulting_preTB","preTb_consultneed",
        "CounsulingNO_preTB","preTB_FurCoulting_ifnoWhy",
        "Other_preTB","preTB_cxrother",
        "Radiologist_preTB","partB_radiologist",
        "MDmanagementPlan_preTB","partB_MDmanPlan",
        "TechAdvice_preTB","partB_needTeachAdv",
        "TechAdvice_yes_preTB","preTB_teachAdvice",
        "MDname_preTB","preTB_MD",
        "CaseNodeIn","preTB_CaseIn",
        "CaseNode","preTB_caseChoice",
        "HTCRes_preTB","preTb_HtcRes",
        "HTCDate_preTB","preTb_HtcDate",
        "AFBRes_preTB","preTb_AfbRes",
        "AFBDate_preTB","preTb_AfbDate",
        "GeneXpertRes_preTB","preTb_geneXRes",
        "GeneXpertDate_preTB","preTb_geneXDate",
        "CXRRes_preTB","preTb_CXRRes",
        "CXRDate_preTB","preTb_CXRDate",
        "FeverDay_preTB","preTB_feverDay",
        "CoughDay_preTB","preTB_coughDay",
        "LowDay_preTB","preTB_lowDay",
        "LoaDay_preTB","preTB_loaDay",
        "NsweatDay_preTB","preTB_nigthSweDay",
        "LympDay_preTB","preTB_lympDay",
        "LympDes_preTB","preTB_lympdescribe",
        "lymph_check","lympreTb_check",
    ]

    let preTB_hideId=[
        "preTb_HtcRes",
        "preTb_HtcDate",
        "preTb_AfbRes",
        "preTb_AfbDate",
        "preTb_geneXRes",
        "preTb_geneXDate",
        "preTb_CXRRes",
        "preTb_CXRDate",
        "preTB_feverDay",
        "preTB_coughDay",
        "preTB_lowDay",
        "preTB_loaDay",
        "preTB_nigthSweDay",
        "preTB_lympDay",
    ] // for showing data when update fill

    function preTB_search(){
        var pre_Pid=$("#preTb_Pid").val();
        var pre_Fid=$("#preTb_fuchiaID").val();
        var notice="Find PreTB patient";
        var preTB_find={
            pre_Pid:pre_Pid,
            pre_Fid:pre_Fid,
            notice:notice,
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });
        $.ajax({
            type:'POST',
            url:"{{route('preTB_Assement_data')}}",
            dataType:'json',
            //  processData:false,
            contentType: 'application/json',
            data: JSON.stringify(preTB_find),
            success:function(response){
                console.log(response);
                if(response[0][0]!==null){
                    $("#preTb_Pid").val(response[0][0]["Pid"]);
                    $("#preTb_fuchiaID").val(response[0][0]["FuchiaID"]);
                    $("#preTb_agey").text(response[0][0]["Agey"]);
                    $("#preTb_agem").text(response[0][0]["Agem"]);
                    $("#preTB_gender").text(response[0][0]["Gender"]);
                    $("#preTb_name").text(response[0][0]["Name"]);
                    follow_cCode=response[0][0]["Clinic Code"]
                    $("#preTb_vDate").val(today);
                    $(".preTB-search div").children().prop("disabled",true);
                    $(".preTB_button button").prop("disabled",false)
                }else{
                    alert("Your ID is not register")
                    $(".preTB-search div").children().val("");
                    $("#preTb_Pid").focus();
                }
                    if(response[1].length!=0){
                        $(".preFollow-button").show();
                    }else{
                        $(".preFollow-button").hide();
                    }
                    DateTo_text();
                    Fhistory_data=response[1];// for updated data in js file
               
                

            }
            
        });
    }
    function preTB_asseSave(){
        var preTB_saveData={};
        $("#preTbAssment input,#preTbAssment select,#preTbAssment span").each(function(index){
            var id_name=$(this).attr("id");
            if($(this).is("input,select")){
                if($(this).is("input[type='checkbox']")){
                  if($(this).is(":checked")){
                    preTB_saveData[id_name]="1";
                  }else{
                    preTB_saveData[id_name]="0"
                  }  
                }else{
                   if($(this).hasClass('Gdate')){
                    preTB_saveData[id_name]=formatDate($(this).val());
                   }else{
                    preTB_saveData[id_name]=$(this).val();
                   }
                    
                }
            }else if($(this).is("span")){
                preTB_saveData[id_name]=$(this).text();
            }
            console.log(id_name);
        })
        preTB_saveData["Clinic Code"]=follow_cCode;
        preTB_saveData["notice"]="PreTB save";
        if(update_alert=="preTB update"){
            preTB_saveData["notice"]=update_alert;
            preTB_saveData["id"]=Fhistory_data[preTB_Follow_UpNo]["id"];
        }

        console.log(preTB_saveData);
        console.log(Object.keys(preTB_saveData).length);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });
        $.ajax({
            type:'POST',
            url:"{{route('preTB_Assement_data')}}",
            dataType:'json',
            //  processData:false,
            contentType: 'application/json',
            data: JSON.stringify(preTB_saveData),
            success:function(response){
                console.log(response);
                alert("Successfully Save")
                history.go(0);
            }
            
        });
    }
    function preTB_FollowData(){
        var preTB_FBtnId=event.target.id;
        preTB_Follow_UpNo=Number(preTB_FBtnId.match(/\d+/)[0]);
        $(".part-section input[type='checkbox'").prop("checked",false);
        
                for(var i=0;i<preTB_idData.length;i++){
                    if($("#"+preTB_idData[++i]).is("input,select")){
                        if($("#"+preTB_idData[i]).is("input[type='checkbox'")){
                            if(Fhistory_data[preTB_Follow_UpNo][preTB_idData[i-1]]=="1"){
                                $("#"+preTB_idData[i]).prop("checked",true);
                            }
                        }else{
                            $("#"+preTB_idData[i]).val("");
                            $("#"+preTB_idData[i]).val(Fhistory_data[preTB_Follow_UpNo][preTB_idData[i-1]]);
                        }
                      
                    }else{
                        $("#"+preTB_idData[i]).text("");
                        $("#"+preTB_idData[i]).text(Fhistory_data[preTB_Follow_UpNo][preTB_idData[i-1]])
                    }
                }
                for(var j=0;j<preTB_hideId.length;j++){
                    if($("#" + preTB_hideId[j]).hasClass("Gdate")){
                        var preCheckname=$("#"+preTB_hideId[j]).parent().parent().parent().parent().attr("class");
                    }else{
                        var preCheckname=$("#"+preTB_hideId[j]).parent().parent().parent().attr("class");
                    }
                    if (($("#" + preTB_hideId[j]).val())!==null &&($("#" + preTB_hideId[j]).val())!=="-" && ($("#" + preTB_hideId[j]).val()).trim() !== '') {
                        $("."+preCheckname).show();
                        var modifiedClassName = preCheckname.replace('Data', '');
                        console.log(modifiedClassName);
                        $("#"+modifiedClassName).prop("checked",true);
                        if(j<4||j==9){
                            $("."+preCheckname).parent().css("height","130px")
                        }else{
                            $("."+preCheckname).parent().css("height","65px")
                        }
                    }else{
                        $("."+preCheckname).hide();
                        $("."+preCheckname).parent().css("height","45px")
                    }
                }
                if($("#lympreTb_check").is(":checked")){
                    $(".lympreTb_checkData").show();
                    $(".lympreTb_checkData").parent().css("height","130px")
                }
                if($("#partB_needTeachAdv").is(":checked")){
                    $("#preTB_teachAdvice").prop("disabled",false);
                }
                update_alert="preTB update";
                $(".preTB-assSave").text("Update Record");
                $(".preTB-search .input-group").children().prop("disabled",false);
                $("#preTB_Fsection").hide();
                $(".part-section").removeClass("freeze-body").css("opacity","1");
                $(".preTB_Entry .header-text h2").text("Update PreTB Assessment")
                $("#preTb_Pid").focus();
                DateTo_text();
    }

    function preTB_remove(){
      var preTB_removeId=event.target.id;
      preTB_removeId=Number(preTB_removeId.match(/\d+/)[0]);
      remove_data={
        id:Fhistory_data[preTB_removeId]["id"],
        Pid:Fhistory_data[preTB_removeId]["Pid_preTB"],
        notice:"Remove preTB",
      }
      console.log(remove_data);
      if(confirm("Are you sure delete this data")){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });
        $.ajax({
            type:'POST',
            url:"{{route('preTB_Assement_data')}}",
            dataType:'json',
            //  processData:false,
            contentType: 'application/json',
            data: JSON.stringify(remove_data),
            success:function(response){
              if(response==1){
                alert("Success Delete")
                preTB_search();
                $("#preTB_Fsection").hide();
                $(".part-section").removeClass("freeze-body").css("opacity","1");
              }else{
                alert("Wrong Permission");
              }
            }
        })
      }

    }
</script>
@extends('layouts.app')
@section('content')
@auth
<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('js/jquery-ui.min.js')}}"></script>
<script src="{{asset('js/Cervical_cancer/cervical_cancer.js')}}"></script>
<div class="container containers">
    <ul class="nav nav-tabs toggle"id="">
      <li class="nav-item">
        <a class="nav-link active toggle-link" data-toggle="pill" href="#cancer_screening">Cervical Cancer Screening</a>
      </li>  
      <li class="nav-item">
        <a class="nav-link toggle-link" data-toggle="pill" href="#cancer_Export">Cervical Cancer Export</a>
      </li>      
    </ul>
    <div class="tab-content page-color">
      <div class="tab-pane active" id="cancer_screening">
        <div id="screening_Info">
          <div class="header-text cercival-header" id="cercival_header">
            <h2>New Cervical Cancer Screening 
            </h2>
                <button class="btn btn-info cervical-historyBtn" id="cervical_history" type="button">History</button>
                <label class="from-label cercivalHis-alert" id="cercival_historyAlert"></label>
                <button class="btn refresh-follow cervical_refresh" id="CC_refresh" style="float:right">Refresh</button>
                <div class="cercival_IDchangeBlock">
                  <input type="checkbox" id="cercival_idChange">
                  <label class="from-label">ID Change ?</label> 
                </div>
          </div>

          <div class="row cercival-personalInfo">
            <h3> <div class="cc_underline"> Personal Information </div> </h3>
            <div class="col-sm-4">
              <div class="input-group mb-3 cercival-generalCode">
                <input type="number" id="cercival_pid" class="form-control" placeholder="General ID">
                <input type="text" id="cercival_fid" class="form-control" placeholder="Fuchia ID">
                <div class="input-group-append no-margin">
                  <button class="btn btn-primary" id="cercival_ptFind" onclick="findcercival_patient()" type="button">Search</button>
                </div>
              </div>
            </div>
            <div class="col-sm-2">
              <label class="form-label">Register_Age</label>
              <span  class="form-control cervical-age " id="cervical_age"></span>
            </div>
            <div class="col-sm-2">
              <label class="form-label">HIV Status</label>
              <select class="form-select" id="crecival_hivStatus">
                <option value="-"></option>
                <option value="1">Positive</option>
                <option value="2">Negative</option>
                <option value="3">Unknown</option>
              </select>
            </div>
            <div class="col-sm-2">
              <label class="form-label">Female Sex Worker</label>
              <select class="form-select" id="crecival_FSW">
                <option value="-"></option>
                <option value="1">Yes</option>
                <option value="2">No</option>
              </select>
            </div>
            <div class="col-sm-2">
              <label class="form-label">Visit Date</label>
              <div class="date-holder">
                <input type="text" class="form-control Gdate date-verify" id="cercival_VDate" placeholder="dd-mm-yyyy">
                <img src="../img/calendar3.svg" class="dateimg" alt="date">
              </div>
            </div>
          </div>

          <div class="row cercival-ObMenhis">
            <h3> <div class="cc_underline"> Obstetric and Menstrual History </div> </h3>
            <div class="col-sm-3">
              <label class="form-label">Number of Previous Pregnancies</label>
              <input class="form-control cercivla-Prevpreg" id="num_prev_preg">
            </div>
            <div class="col-sm-3">
              <label class="form-label">Current Birth Spacing Method</label>
              <select class="form-select cercivla-birthSpacing" id="birth_spacing_met">
                <option value="-"></option>
                <option value="1">Pill</option>
                <option value="2">DMPA</option>
                <option value="3">Implant</option>
                <option value="4">IUD</option>
                <option value="5">None</option>
              </select>
            </div>
            <div class="col-sm-2">
              <label class="form-label">LMP</label>
              <div class="date-holder">
                <input type="text" class="form-control Gdate"id="cercival_LMP" placeholder="dd-mm-yyyy">
                <img src="../img/calendar3.svg" class="dateimg" alt="date">
              </div>
            </div>
            <div class="col-sm-2">
              <label class="form-label">UCG Tested Date</label>
              <div class="date-holder">
                <input type="text" class="form-control Gdate" id="UCG_test_date" placeholder="dd-mm-yyyy">
                <img src="../img/calendar3.svg" class="dateimg" alt="date">
              </div>
            </div>
            <div class="col-sm-2">
              <label class="form-label">UCG Tested result</label>
              <select class="form-select" id="UCG_test_res">
                <option value="-"></option>
                <option value="1">Positive</option>
                <option value="2">Negative</option>
              </select>
            </div>
          </div>

          <div class="row cercival-breat">
            <h3> <div class="cc_underline"> Breast Cancer Screening and Examinaiton </div></h3>
              <div class="col-sm-7">
                <label class="form-label breast-label">1. Have you had any cancer like breast cancer , ovarian cancer,cervical cancer?</label>
              </div>
              <div class="col-sm-1">
                <select class="form-select" id="crecival_selfhave">
                  <option value="-"></option>
                  <option value="1">Yes</option>
                  <option value="2">No</option>
                </select>
              </div>
              <div class="col-sm-7">
                <label class="form-label breast-label">2. Any family history of cancer like breast cancer,ovarian cancer,cervical cancer?</label>
              </div>
              <div class="col-sm-1">
                <select class="form-select" id="crecival_familyHis_have">
                  <option value="-"></option>
                  <option value="1">Yes</option>
                  <option value="2">No</option>
                </select>
              </div>
              <div class="col-sm-7">
                <label class="form-label breast-label">3. Breast examination done or not</label>
              </div>
              <div class="col-sm-1">
                <select class="form-select" id="crecival_breastExam">
                  <option value="-"></option>
                  <option value="1">Yes</option>
                  <option value="2">No</option>
                  <option value="3">NA</option>
                </select>
              </div>
              <div class="col-sm-7">
                <label class="form-label breast-label">4. If yes,any abnormal findings on breast</label>
              </div>
              <div class="col-sm-1">
                <select class="form-select" id="crecival_abnormal_breast" disabled>
                  <option value="-"></option>
                  <option value="1">Yes</option>
                  <option value="2">No</option>
                  
                </select>
              </div>
              <div class="col-sm-12">
                <label class="form-label">Remark if present</label>
                <input class="form-control" id="breast_remark" disabled>
              </div>

          </div>

          <div class="row cercival-SpeculumEx">
            <h3> <div class="cc_underline"> Speculum Examination </div> </h3>
            <div class="col-sm-3">
              <label class="form-label">Discharge</label>
              <select class="form-select" id="discharge">
                <option value="-"></option>
                <option value="1">Positive</option>
                <option value="2">Negative</option>
              </select>
            </div>
            <div class="col-sm-3">
              <label class="form-label">Cervix bleed on touch</label>
              <select class="form-select" id="cervix_bleed">
                <option value="-"></option>
                <option value="1">Positive</option>
                <option value="2">Negative</option>
              </select>
            </div>
            <div class="col-sm-3">
              <label class="form-label">Tenderness</label>
              <select class="form-select" id="tenderness">
                <option value="-"></option>
                <option value="1">Positive</option>
                <option value="2">Negative</option>
              </select>
            </div>
            <div class="col-sm-3">
              <label class="form-label">Malignancy</label>
              <select class="form-select" id="malignancy">
                <option value="-"></option>
                <option value="1">Suspect</option>
                <option value="2">Not suspect</option>
              </select>
            </div>
            <div class="col-sm-12">
              <label class="form-label">Comments</label>
              <input class="form-control" id="spc_comments">
            </div>

          </div>

          <div class="row cercival-stiCom">
            <div class="col-sm-2">
              <h3> <div class="cc_underline"> STI complaint </div></h3>
              <label class="form-label">STI Complaint</label>
              <select class="form-select" id="sti_complaint">
                <option value="-"></option>
                <option value="1">Yes</option>
                <option value="2">No</option>
              </select>
            </div>
            <div class="col-sm-2"></div>

            <div class="col-sm-3">
              <h3>STI examination</h3>
              <label class="form-label">STI examination</label>
              <select class="form-select" id="sti_examination">
                <option value="-"></option>
                <option value="1">Done</option>
                <option value="2">Not Done</option>
              </select>
            </div>
          </div>

          <div class="row cercival-viascreening">
            <h3> <div class="cc_underline"> VIA Screening History </div></h3>
            <div class="col-sm-3">
              <label class="form-label">VIA Screening History</label>
              <select class="form-select" id="via_screening_his">
                <option value="-"></option>
                <option value="1">Fist time VIA</option>
                <option value="2">Follow-up After</option>
                <option value="3">Follow-up 1 year after thermal ablation</option>
              </select>
            </div>
            <div class="col-sm-2">
              <label class="form-label">VIA test</label>
              <select class="form-select" id="via_test">
                <option value="-"></option>
                <option value="1">Done</option>
                <option value="2">NotDone</option>
                <option value="3">Postponed due to</option>
              </select>
            </div>
            <div class="col-sm-3">
              <label class="form-label">VIA test Postpone Reason</label>
              <select class="form-select" id="via_postponed_reason" disabled>
                <option value="-"></option>
                <option value="1">Very ill</option>
                <option value="2">Pregnancy</option>
                <option value="3">Less than 12 weeks after dilivery</option>
                <option value="4">Clinical evidence of genital infection</option>
                <option value="5">Prior or currently history of cervical surgery</option>
                <option value="6">Suspicion of Cancer</option>
                <option value="7">Menstruation</option>
                <option value="8">Other(please specify)</option>
              </select>
            </div>
            <div class="col-sm-4">
              <label class="form-label">Other(please specify)</label>
              <input class="form-control" id="via_postponed_reason_oth" disabled>
            </div>

          </div>

          <div class="row cercival-finding">
            <h3> <div class="cc_underline"> VIA finding </div></h3>
            <div class="col-sm-2">
              <label class="form-label">SCJ</label>
              <select class="form-select" id="SCJ">
                <option value="-"></option>
                <option value="1">Was clearly seen</option>
                <option value="2">Not all seen</option>
              </select>
            </div>
            <div class="col-sm-2">
              <label class="form-label">VIA test result</label>
              <select class="form-select" id="via_test_res">
                <option value="-"></option>
                <option value="1">Negative</option>
                <option value="2">Postive</option>
                <option value="3">Suspicious for cancer</option>
              </select>
            </div>
            <div class="col-sm-2">
              <label class="form-label">Refer to OG</label>
              <select class="form-select" id="referred_OG">
                <option value="-"></option>
                <option value="1">Yes</option>
                <option value="2">No</option>
              </select>
            </div>
            <div class="col-sm-6">
              <label class="form-label">Counselling for VIA result done by</label>
              <input class="form-control" id="counselling_via_res_by">
              
            </div>

          </div>

          <div class="row cercival-thermal">
            <h3> <div class="cc_underline"> For Thermal Ablation </div></h3>
            <div class="col-sm-4">
              <label class="form-label">Eligible for thermal ablation</label>
              <select class="form-select" id="eligible_thermal_ablation">
                <option value="-"></option>
                <option value="1">Yes</option>
                <option value="2">No</option>
              </select>
            </div>
            <div class="col-sm-4">
              <label class="form-label">If No,please specify reason</label>
              <select class="form-select" id="eligible_thermal_ablation_rea" disabled>
                <option value="-"></option>
                <option value="1">Evidence of genital infection</option>
                <option value="2">Location,size and extension of the lesion</option>
                <option value="3">Other,please specify</option>
              </select>
            </div>
            <div class="col-sm-4">
              <label class="form-label">If No,please specify reason</label>
              <input class="form-control" id="eligible_thermal_ablation_rea_oth" disabled>
            </div>

          </div>

          <div class="row cercival-eligible">
            <h3> <div class="cc_underline"> Eligible patient: </div></h3>
            <div class="col-sm-3">
              <label class="form-label">Thermal ablation done</label>
              <select class="form-select" id="thermal_ablation">
                <option value="-"></option>
                <option value="1">Yes</option>
                <option value="2">No</option>
              </select>
            </div>
            <div class="col-sm-2">
              <label class="form-label">If No,specify reason</label>
              <select class="form-select" id="thermal_ablation_rea" disabled>
                <option value="-"></option>
                <option value="1">Patient refuse for treatment</option>
                <option value="2">Postpone to</option>
                <option value="3">other,please specify</option>
              </select>
            </div>

            <div class="col-sm-3" id="eligible_specifyDate">
              <div id="eligible_other" style="display:none" >
                <label class="form-label">If Other,specify</label>
                <input class="form-control" id="thermal_ablation_rea_oth">
              </div>
              <div id="eligible_postpone" style="display:none">
                <label class="form-label">Postpone Date</label>
                <div class="date-holder">
                  <input type="text" class="form-control Gdate" id="eligible_postpone_date" placeholder="dd-mm-yyyy">
                  <img src="../img/calendar3.svg" class="dateimg" alt="date">
                </div>
              </div>
            </div>

            <div class="col-sm-4">
              <label class="form-label">Thermal Ablation Result</label>
              <input class="form-control" id="thermal_ablation_res">
            </div>

            <div class="col-sm-3">
              <label class="form-label">Thermal Ablation performed by:</label>
              <input class="form-control" id="thermal_ablation_per_by">
            </div>
            <div class="col-sm-2">
              <label class="form-label">Date</label>
              <div class="date-holder">
                <input type="text" class="form-control Gdate" id="thermal_ablation_date" placeholder="dd-mm-yyyy">
                <img src="../img/calendar3.svg" class="dateimg" alt="date">
              </div>
            </div>
            <div class="col-sm-2">
              <label class="form-label">Follow up Date</label>
              <div class="date-holder">
                <input type="text" class="form-control Gdate" id="followup_date" placeholder="dd-mm-yyyy">
                <img src="../img/calendar3.svg" class="dateimg" alt="date">
              </div>
            </div>
            <div class="col-sm-5">
              <label class="form-label">Referred to Tertiary center for futher treatment</label>
              <select class="form-select" id="ref_to_tertiary_center_fut_treat">
                <option value="-"></option>
                <option value="1">Yes</option>
                <option value="2">No</option>
              </select>
            </div>
          </div>

          <div class="row cercival-adverse">
            <div class="row">
              <h3> <div class="cc_underline"> Adverse Events(Post thermal ablation treatment) </div></h3>
              <div class="col-sm-2">
                <label class="form-label">AE(Y/N)</label>
                <select class="form-select" id="ae">
                  <option value="-"></option>
                  <option value="1">Yes</option>
                  <option value="2">No</option>
                </select>
              </div>
            </div>
            <div class="Ae-info" id="Ae_info">
              <div class="row">
                <div class="col-sm-2">
                  <label class="form-label">AE Date:</label>
                  <div class="date-holder">
                    <input type="text" class="form-control Gdate" id="ae_date" placeholder="dd-mm-yyyy">
                    <img src="../img/calendar3.svg" class="dateimg" alt="date">
                  </div>
                </div>
                <div class="col-sm-2">
                  <label class="form-label">Complaint</label>
                  <select class="form-select" id="complaint">
                    <option value="-"></option>
                    <option value="1">Yes</option>
                    <option value="2">No</option>
                  </select>
                </div>
                <div class="col-sm-3">
                  <label class="form-label">Complaint,if Yes</label>
                  <select class="form-select" id="complaint_spec" disabled>
                    <option value="-"></option>
                    <option value="1">Fever for more than two days</option>
                    <option value="2">Servere bleeding(beyond a heavy period with blood cl)</option>
                    <option value="3">Foul-smelling discharge</option>
                    <option value="4">Severse abdominal pain</option>
                    <option value="5">Other,please specify</option>
                  </select>
                </div>
                <div class="col-sm-3">
                  <label class="form-label">Complaint other</label>
                  <input class="form-control" id="complaint_spec_oth" disabled>
                </div>
                <div class="col-sm-2">
                  <label class="form-label">Refer to Hospital</label>
                  <select class="form-select" id="ref_hos">
                    <option value="-"></option>
                    <option value="1">Yes</option>
                    <option value="2">No</option>
                  </select>
                </div>
                <div class="col-sm-4">
                  <label class="form-label">Adverse evetns related to thermal ablation</label>
                  <select class="form-select" id="ae_thermal_relAblation">
                    <option value="-"></option>
                    <option value="1">Yes</option>
                    <option value="2">No</option>
                  </select>
                </div>
                <div class="col-sm-4">
                  <label class="form-label">Treatment</label>
                  <input class="form-control" id="treatment">
                </div>
                <div class="col-sm-2">
                  <label class="form-label">Follow up Date</label>
                  <div class="date-holder">
                    <input type="text" class="form-control Gdate" id="AE_followup_date" placeholder="dd-mm-yyyy">
                    <img src="../img/calendar3.svg" class="dateimg" alt="date">
                  </div>
                </div>

              </div>
            </div>
            

          </div>
          <div class="row cercival-btnBlock">
            <div class="col-sm-2">
              <button class="btn btn-info cercival-save" id="cercival_save"onclick="Cercival_saveUP()" disabled>Save Record</button>
            </div>
          </div>

        </div>
        <div class="cercival-history" id="cercival_historyBolck">
          <h3 class="header-text">Cercival Cancer History</h3>

          <div id="history_ListData">
            <div class="row no-margin his_ListHead" style="justify-content:center">
              <div class="col-sm-1 no-margin ">NO.</div>
              <div class="col-sm-2 no-margin ">General ID</div>
              <div class="col-sm-2 no-margin ">Fuchia ID</div>
              <div class="col-sm-2 no-margin ">Visit Date</div>
              <div class="col-sm-4 no-margin "></div>
            </div>
          </div>
          <div class="row" style="justify-content:center">
            <div class="col-sm-2">
              <button class="btn btn-info cercival-goHome" onclick="gotoHome()">To Record</button>
            
            </div>
          </div>
        
        </div>
      </div>
      

      <div class="tab-pane fade" id="cancer_Export">
        <div class="header-text">
          <h2>Cencervial Cancer Export Section</h2>
        </div>
        <form action="{{ route('cc_data') }}" method="POST">
          @csrf
          <div class="row" style="justify-content:center;">
              <div class="col-sm-3">
                <label for="validationCustom01" class="form-label">From</label>
                
                <div class="date-holder">
                  <input type="text" class="form-control Gdate" id="cc_fromDate" name="cc_dateFrom" placeholder="dd-mm-yyyy">
                  <img src="../img/calendar3.svg" class="dateimg" alt="date">
                </div>
              </div>
              <div class="col-sm-3">
                <label for="validationCustom01" class="form-label">To</label>
                <div class="date-holder">
                  <input type="text" class="form-control Gdate" id="cc_ToDate" name="cc_dateTo" placeholder="dd-mm-yyyy">
                  <img src="../img/calendar3.svg" class="dateimg" alt="date">
                </div>
              </div>
             
              <div class="col-sm-1" style="display:none"><input  name="notice"  value="Export_Cancer"></div>
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
  let generalInfo,clinic_code,update_Id,Update_General;
  let cercival_his_fill=[
                        "General ID","cercival_pid",
                        "FuchiaID","cercival_fid",
                        "Agey","cervical_age",
                        "Hiv_Status","crecival_hivStatus",
                        "FSW","crecival_FSW",
                        "Visit_date","cercival_VDate",
                        "No_previous_preg","num_prev_preg",
                        "Birth_spacing_met","birth_spacing_met",
                        "LMP","cercival_LMP",
                        "UCG_test_date","UCG_test_date",
                        "UCG_test_res","UCG_test_res",
                        "Breast_self","crecival_selfhave",
                        "Breast_family_his","crecival_familyHis_have",
                        "Breast_examination","crecival_breastExam",
                        "Breast_abnormal_find_breast","crecival_abnormal_breast",
                        "Breast_remark","breast_remark",
        
                        "Discharge","discharge",
                        "Cervix_bleed_touch","cervix_bleed",
                        "Tenderness","tenderness",
                    
                        "Malignancy","malignancy",
                        "Comments_spec","spc_comments",
                        
        
                        "Sti_Complaint","sti_complaint",
                        "Sti_examination","sti_examination",
                        "VIA_Screening_History","via_screening_his",
                        "VIA_test","via_test",
                        "VIA_postpone_reason","via_postponed_reason",
                        "VIA_specify_reason","via_postponed_reason_oth",
                        "SCJ","SCJ",
                        "VIA_test_Result","via_test_res",
                        "refer_OG","referred_OG",
                        "Counselling_VIA_result_done","counselling_via_res_by",
                        "Eglible_thermal_ablation","eligible_thermal_ablation",
                        "Eglible_thermal_ablation_reason","eligible_thermal_ablation_rea",
                        "Eglible_thermal_ablation_specify","eligible_thermal_ablation_rea_oth",
                        "Thermal_ablation_done","thermal_ablation",
                        "Thermal_No_specify","thermal_ablation_rea",
                        "Thermal_other_specify","thermal_ablation_rea_oth",
                        "Postpone_date","eligible_postpone_date",
                        "Thermal_ablation_result","thermal_ablation_res",
                        "Thermal_ablation_performed","thermal_ablation_per_by",
                        "Date","thermal_ablation_date",
                        "Followup_date","followup_date",
                        "Tertiary_Further_treatment","ref_to_tertiary_center_fut_treat",
                        "AE(Y/N)","ae",
                        "AE_Date","ae_date",
                        "Complaint","complaint",
                        "Complaint_yes","complaint_spec",
                        "Complaint_other","complaint_spec_oth",
                        "Refer_Hosp","ref_hos",
                        "AE_realated_thermal_ablation","ae_thermal_relAblation",
                        "Treatment","treatment",
                        "AE_followUp_Date","AE_followup_date",
  ]
  function cercival_endisabled(){
        
        if($("#crecival_breastExam").val()=="1"){
            $("#crecival_abnormal_breast").prop("disabled",false);
        }else{
            $("#crecival_abnormal_breast,#breast_remark").prop("disabled",true).val("");
        }

        if($("#crecival_abnormal_breast").val()=="1"){
            $("#breast_remark").prop("disabled",false);
        }else{
            $("#breast_remark").prop("disabled",true).val("");
        }

        if($("#via_test").val()=="3"){
            $("#via_postponed_reason").prop("disabled",false);
        }else{
            $("#via_postponed_reason").prop("disabled",true).val("-");
            $("#via_postponed_reason_oth").prop("disabled",true).val("")
        }

        if($("#crecival_breastExam").val()=="1"){
            $("#crecival_abnormal_breast").prop("disabled",false);
        }else{
            $("#crecival_abnormal_breast,#breast_remark").prop("disabled",true).val("");
        }

        if($("#crecival_abnormal_breast").val()=="1"){
            $("#breast_remark").prop("disabled",false);
        }else{
            $("#breast_remark").prop("disabled",true).val("");
        }

        if($("#via_test").val()=="3"){
            $("#via_postponed_reason").prop("disabled",false);
        }else{
            $("#via_postponed_reason").prop("disabled",true).val("-");
            $("#via_postponed_reason_oth").prop("disabled",true).val("")
        }

        if($("#via_postponed_reason").val()=="8"){
            $("#via_postponed_reason_oth").prop("disabled",false);
        }else{
            $("#via_postponed_reason_oth").prop("disabled",true).val("");
        }

        if($("#eligible_thermal_ablation").val()=="2"){
            $("#eligible_thermal_ablation_rea").prop("disabled",false);
        }else{
            $("#eligible_thermal_ablation_rea").prop("disabled",true).val("-");
            $("#eligible_thermal_ablation_rea_oth").prop("disabled",true).val("")
        }

        if($("#eligible_thermal_ablation_rea").val()=="3"){
            $("#eligible_thermal_ablation_rea_oth").prop("disabled",false);
        }else{
            $("#eligible_thermal_ablation_rea_oth").prop("disabled",true).val("");
        }

        if($("#thermal_ablation").val()=="2"){
            $("#thermal_ablation_rea").prop("disabled",false);
        }else{
            $("#thermal_ablation_rea").prop("disabled",true).val("");
            $("#thermal_ablation_rea_oth,#eligible_postpone_date").val("");
            $("#eligible_postpone,#eligible_other").hide();
        }

        if($("#thermal_ablation_rea").val()=="2"){
            $("#eligible_postpone").show();
            $("#thermal_ablation_rea_oth").val("");
            $("#eligible_other").hide()
        }else if($("#thermal_ablation_rea").val()=="3"){
            $("#eligible_other").show();
            $("#eligible_postpone_date").val("");
            $("#eligible_postpone").hide()
        }else{
            $("#thermal_ablation_rea_oth,#eligible_postpone_date").val("");
            $("#eligible_postpone,#eligible_other").hide();

        }

        if($("#ae").val()=="1"){
            $("#Ae_info").show();
        }else {
            $("#Ae_info").hide();
            $("#Ae_info input,#Ae_info select").val("");
            $("#complaint_spec,#complaint_spec_oth").prop("disabled",true);
        }

        if($("#complaint").val()=="1"){
            $("#complaint_spec").prop("disabled",false);
        }else{
            $("#complaint_spec,#complaint_spec_oth").prop("disabled",true);
            $("#complaint_spec,#complaint_spec_oth").val("");
        }

        if($("#complaint_spec").val()=="5"){
            $("#complaint_spec_oth").prop("disabled",false);
        }else{
            $("#complaint_spec_oth").prop("disabled",true);
            $("#complaint_spec_oth").val("");
        }

       
  }

  function findcercival_patient(callback){
   let find_Cercival={
    Pid:$("#cercival_pid").val(),
    Fid:$("#cercival_fid").val(),
    notice:"Find the Patient",
   }
   console.log(find_Cercival);
    $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                  }
    });
    $.ajax({
            type:'POST',
            url:"{{route('cc_data')}}",
            dataType:'json',
            contentType: 'application/json',
            data: JSON.stringify(find_Cercival),
            success:function(response){
              console.log(response);
              generalInfo=response;
              if(response[0][0]!=null){
               
                $("#cercival_pid").val(generalInfo[0][0]["Pid"]);
                $("#cercival_fid").val(generalInfo[0][0]["FuchiaID"]);
                $("#cervical_age").text(generalInfo[0][0]["Agey"])
                $("#cercival_pid,#cercival_fid,#cercival_ptFind").prop("disabled",true);
                $("#cercival_save").prop("disabled",false);
                $("#cercival_VDate").val(todayIn);
                clinic_code=generalInfo[0][0]["Clinic Code"];
              }else{
                alert("This ID isn't registered. Please ask to reception counter.")
              }  

                
                if(generalInfo[0][1].length>0){
                  
                  $("#cercival_historyAlert").text(generalInfo[0][1].length+" Records")
                  $("#cervical_history,#cercival_historyAlert").show();
                }
              
              if (typeof callback === "function") {
                callback();
              }
              
              
            }
    })
    
  }

  function Cercival_saveUP(){
    let Cercival_SaveUP_Data={};
    $("#screening_Info input,#screening_Info select,#screening_Info span").each(function(){
      var Id_name=$(this).attr("id");
      if($(this).is("input,select")){
        if($(this).hasClass("Gdate")){
          Cercival_SaveUP_Data[Id_name]=formatDate($(this).val());
        }else{
          Cercival_SaveUP_Data[Id_name]=$(this).val();
        }
      }else if($(this).is("span")){
        Cercival_SaveUP_Data[Id_name]=$(this).text();
      }

    })
    Cercival_SaveUP_Data["notice"]="Cercival Save Record";
    Cercival_SaveUP_Data["Clinic Code"]=clinic_code;
    if(update_Id){
      Cercival_SaveUP_Data["notice"]="Cercival Updated Record";
      Cercival_SaveUP_Data["update_Id"]=update_Id;
      console.log(cercival_his_room);
      Cercival_SaveUP_Data["update_GenerlID"]=Update_General;


    }
    console.log(Cercival_SaveUP_Data);


    if(Cercival_SaveUP_Data["cercival_pid"]==generalInfo[0][0]["Pid"] && (Cercival_SaveUP_Data["cervical_age"]!=""&& Cercival_SaveUP_Data["cervical_age"]!="0"&& Cercival_SaveUP_Data["cervical_age"]<=100)){
      $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                  }
      });
      $.ajax({
              type:'POST',
              url:"{{route('cc_data')}}",
              dataType:'json',
              contentType: 'application/json',
              data: JSON.stringify(Cercival_SaveUP_Data),
              success:function(response){
                console.log(response);
                if(response=="This patients don't pass reception"||response=="Today, This patients has been collected"){
                  alert(response);
                  // $('html, body').animate({ scrollTop: 0 }, 'fast');
                }else{
                  alert(response);
                  history.go(0);
                }
                

              }
      })

    }else{
      alert("Wrong creditial or wrong Age")
     // history.go(0);
    }
    
    
  }

  function cercival_History(){
    update_Id=$(event.target).attr("id").match(/\d+/)[0];
    cercival_his_room=$(event.target).parent().parent().children().first().text()-1;
    for(var i=0;i<cercival_his_fill.length;i=i+2){
      if($("#"+cercival_his_fill[i+1]).is("input,select")){
        $("#"+cercival_his_fill[i+1]).val(generalInfo[0][1][cercival_his_room][cercival_his_fill[i]])
      }else if($("#"+cercival_his_fill[i+1]).is("span")){
        $("#"+cercival_his_fill[i+1]).text(generalInfo[0][1][cercival_his_room][cercival_his_fill[i]])
      }
    }
    Update_General=generalInfo[0][1][cercival_his_room]["General ID"]
    DateTo_text();
    cercival_endisabled();
    $("#cercival_historyBolck").hide();
    $("#screening_Info").show();
    $("#cercival_save").text("Updated Record");
    $("#cercival_header h2").text("Update Cercival Cancer Screening");
    $(".cercival_IDchangeBlock").show();

  }

  function cercival_remove(){
   var rownumber=event.target.id.match(/\d+/)[0];
   var visit_date=$(event.target).parent().parent().children().eq(3).text();
   var generalID=$(event.target).parent().parent().children().eq(1).text();
   let cervical_remove={
    rownumber:rownumber,
    visit_date:visit_date,
    generalID:generalID,
    notice:"remove cercival data"
   }
   console.log(cervical_remove);
   if(confirm("Are you sure to Delete this cercival cancer data")){
    $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                  }
    });
    $.ajax({
              type:'POST',
              url:"{{route('cc_data')}}",
              dataType:'json',
              contentType: 'application/json',
              data: JSON.stringify(cervical_remove),
              success:function(response){
                console.log(response);
                if(response=="Successfull Delete"){
                  alert(response);
                  findcercival_patient(function() {
                    $("#cervical_history").click();
                  });
                }else{
                  alert(response);
                }
              }
    })
   }
  }

  function gotoHome(){
    $("#cercival_historyBolck").hide();
    $("#screening_Info").show();
  }

</script>
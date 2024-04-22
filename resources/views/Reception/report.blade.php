
@extends('layouts.app')
  
  
@section('content')
@auth

  <script src="{{asset('js/jquery.min.js')}}"></script>
  <script src="{{asset('js/jquery-ui.min.js')}}"></script>
  <script src="{{asset('js/Reception_report/receptionReport.js')}}"></script>

   
  
 
<form action="{{ route('reception_report_export') }}" method="POST" enctype="multipart/form-data">
	@csrf

  <input type="hidden" name="neededData" id="needArray" > 


  <div class="container">
  <div class="row">
      <div class="col-sm-12">
        <h3 style="color:black;margin:auto;">Clinic Overall Registration Report</h3>
      </div>
    </div>
  
      <div class="row" id="wannaHide">
        <div class="col-sm-2">
          <label  class="form-label" style="color:black;">From</label>
          <div class="date-holder">
                <input type="text" id="d_from" class="form-control Gdate date-verify" placeholder="dd-mm-yyyy">
                <img src="../img/calendar3.svg" class="dateimg" alt="date">
          </div>
        </div>
        <div class="col-sm-2">
          <label class="form-label" style="color:black;">To</label>
          <div class="date-holder">
                <input type="text" id="d_to" class="form-control Gdate date-verify" placeholder="dd-mm-yyyy">
                <img src="../img/calendar3.svg" class="dateimg" alt="date">
          </div>
        </div>

        
        <div class="col-sm-2">
        <label class="form-label" style="color:black;"> Format </label>
            <select class="form-control" name="exp_format" >
                        <option value="mf">Monthly Format</option>
                        <option value="df">Daily Format</option>
            </select>
        </div>
        <div class="col-sm-2">
          <label class="form-label" style="color:black;">.</label>
          <button type="button" class="btn btn-dark rp_cal" id="rec_reportCal"  onclick="calculate()" >Calculate</button>
          <button type="submit" class="btn btn-dark" onclick="afterExcel()" disabled>Export</button>
        </div>
        <div class="col-sm-2">
        <label class="form-label" style="color:black;">.</label>
          <button type="button" class="btn btn-info"  onclick="Refresh()" >Refresh</button>
        </div>
        <div class="col-sm-2">
        <label class="form-label" style="color:black;">.</label>
          <button type="button" class="btn btn-info"  onclick="hider()" >Prepare for Print</button>
        </div>
      </div>
    </div>
    </form>		
    
    <div class="row">
     
      <div class="col-sm-10" style="margin: auto;">
        <div id="monthlyTable">
          <table class="table table-bordered">
          <thead>
            <tr>
              <td class="table-primary rec-report-head"style="width:300px;padding:0px"></td>
              <td class="table-primary rec-report-head"style="width:100px;padding-left:150px;"colspan="2" >  New </td>
              <td class="table-primary rec-report-head"style="width:100px;padding-left:150px;" colspan="2"> Old </td>
              <td></td>
              <td class="table-primary rec-report-head"> Disease Categories for general patients</td>
              <td class="table-primary rec-report-head" colspan="2">New</td>
              <td class="table-primary rec-report-head" colspan="2">Old</td>
            </tr>
            <tr>
              <td class="table-primary rec-report-head"></td>
              <td class="table-primary rec-report-head"> < 15 yrs </td>
              <td class="table-primary rec-report-head" > >= 15 yrs </td>
              <td class="table-primary rec-report-head"> < 15 yrs </td>
              <td class="table-primary rec-report-head" > >= 15 yrs </td>
              
              <td></td>

              <td class="table-primary rec-report-head"></td>
              <td class="table-primary rec-report-head"> < 15 yrs </td>
              <td class="table-primary rec-report-head" > >= 15 yrs </td>
              <td class="table-primary rec-report-head"> < 15 yrs </td>
              <td class="table-primary rec-report-head" > >= 15 yrs </td>
            </tr>
          </thead>
          <tbody>
            <!-- G1 section -->
            <tr>
              <td class="table-info">PHA</td>
              <td class="table-info"id="pha_u15_new"></td>
              <td class="table-info"id="pha_o15_new"></td>
              <td class="table-info"id="pha_u15_old"></td>
              <td class="table-info"id="pha_o15_old"></td>

              <td></td>

              <td class="table-info-1">NCD/Cerebro-vascular disease (CVD)</td>
              <td class="table-info-1" id="ugen_ncd_cvd_new"></td>
              <td class="table-info-1" id="ogen_ncd_cvd_new"></td>
              <td class="table-info-1" id="ugen_ncd_cvd_old"></td>
              <td class="table-info-1" id="ogen_ncd_cvd_old"></td>
            </tr>
            <!-- 1 -->
            <tr>
              <td class="table-info">ART</td>
              <td class="table-info" id="art_u15_new"></td>
              <td class="table-info" id="art_o15_new"></td>
              <td class="table-info" id="art_u15_old"></td>
              <td class="table-info" id="art_o15_old"></td>

              <td></td>

              <td class="table-info-1">Hypertension only</td>
              <td class="table-info-1" id="ugen_HT_only_new"></td>
              <td class="table-info-1" id="ogen_HT_only_new"></td>
              <td class="table-info-1" id="ugen_HT_only_old"></td>
              <td class="table-info-1" id="ogen_HT_only_old"></td>
            </tr>
            <!-- 2 -->
            <tr>
              <td class="table-info">PrEP</td>
              <td class="table-info" id="prep_u15_new"></td>
              <td class="table-info" id="prep_o15_new"></td>
              <td class="table-info" id="prep_u15_old"></td>
              <td class="table-info" id="prep_o15_old"></td>
             
              <td></td>

              <td class="table-info-1">DM only</td>
              <td class="table-info-1" id="ugen_DM_only_new"></td>
              <td class="table-info-1" id="ogen_DM_only_new"></td>
              <td class="table-info-1" id="ugen_DM_only_old"></td>
              <td class="table-info-1" id="ogen_DM_only_old"></td>
            </tr>
            <!-- 3 -->
            <tr>
              <td class="table-info">PMTCT</td>
              <td class="table-info" id="pmtct_u15_new"></td>
              <td class="table-info" id="pmtct_o15_new"></td>
              <td class="table-info" id="pmtct_u15_old"></td>
              <td class="table-info" id="pmtct_o15_old"></td>
             
              <td></td>

              <td class="table-info-1">H/T & DM comorbidity</td>
              <td class="table-info-1" id="ugen_HT_DM_como_new"></td>
              <td class="table-info-1" id="ogen_HT_DM_como_new"></td>
              <td class="table-info-1" id="ugen_HT_DM_como_old"></td>
              <td class="table-info-1" id="ogen_HT_DM_como_old"></td>
            </tr>
            <!-- 4 -->
            <tr>
              <td class="table-info">ANC</td>
              <td class="table-info" id="anc_u15_new"></td>
              <td class="table-info" id="anc_o15_new"></td>
              <td class="table-info" id="anc_u15_old"></td>
              <td class="table-info" id="anc_o15_old"></td>
              
              <td></td>

              <td class="table-info-1">RTI ( < 2 wks)</td>
              <td class="table-info-1" id="ugen_RTI_Less2wk_new"></td>
              <td class="table-info-1" id="ogen_RTI_Less2wk_new"></td>
              <td class="table-info-1" id="ugen_RTI_Less2wk_old"></td>
              <td class="table-info-1" id="ogen_RTI_Less2wk_old"></td>
            </tr>
            <!-- 5 -->
            <tr>
              <td class="table-info">FP</td>
              <td class="table-info" id="fp_u15_new"></td>
              <td class="table-info" id="fp_o15_new"></td>
              <td class="table-info" id="fp_u15_old"></td>
              <td class="table-info" id="fp_o15_old"></td>
             
              <td></td>

              <td class="table-info-1">RTI ( >= 2 wks)</td>
              <td class="table-info-1" id="ugen_RTI_Great2wk_new"></td>
              <td class="table-info-1" id="ogen_RTI_Great2wk_new"></td>
              <td class="table-info-1" id="ugen_RTI_Great2wk_old"></td>
              <td class="table-info-1" id="ogen_RTI_Great2wk_old"></td>
            </tr>
            <!-- 6 -->
            <tr>
              <td class="table-info">Feeding Centre</td>
              <td class="table-info" id="feed_u15_new"></td>
              <td class="table-info" id="feed_o15_new"></td>
              <td class="table-info" id="feed_u15_old"></td>
              <td class="table-info" id="feed_o15_old"></td>
              
              <td></td>

              <td class="table-info-1">HIV (-) TB</td>
              <td class="table-info-1" id="ugen_HIV_TB_new"></td>
              <td class="table-info-1" id="ogen_HIV_TB_new"></td>
              <td class="table-info-1" id="ugen_HIV_TB_old"></td>
              <td class="table-info-1" id="ogen_HIV_TB_old"></td>
            </tr> 
            
            <tr>
              <td class="table-info" class="table-info">General</td>
              <td class="table-info" class="table-info" id="gen_u15_new"></td>
              <td class="table-info" class="table-info" id="gen_o15_new"></td>
              <td class="table-info" class="table-info" id="gen_u15_old"></td>
              <td class="table-info" class="table-info" id="gen_o15_old"></td>
              
              <td></td>

              <td class="table-info-1">TB related consultation</td>
              <td class="table-info-1" id="ugen_TB_relate_new"></td>
              <td class="table-info-1" id="ogen_TB_relate_new"></td>
              <td class="table-info-1" id="ugen_TB_relate_old"></td>
              <td class="table-info-1" id="ogen_TB_relate_old"></td>
            </tr>

            <tr>
              <td class="table-info">Total</td>
              <td class="table-info" id="total_u15_new"></td>
              <td class="table-info" id="total_o15_new"></td>
              <td class="table-info" id="total_u15_old"></td>
              <td class="table-info" id="total_o15_old" ></td>
              
              <td></td>

              <td class="table-info-1">Covid related consultation</td>
              <td class="table-info-1" id="ugen_Covid_relate_new"></td>
              <td class="table-info-1" id="ogen_Covid_relate_new"></td>
              <td class="table-info-1" id="ugen_Covid_relate_old"></td>
              <td class="table-info-1" id="ogen_Covid_relate_old"></td>
            </tr>
            <!-- 9 -->

            <tr class="">
              <td></td>
              <td ></td>
              <td id=""></td>
              <td id=""></td>
              <td ></td>
              
              <td></td>

              <td class="table-info-1">Obstructive pul. D/s</td>
              <td class="table-info-1" id="ugen_Obstructive_pul_new"></td>
              <td class="table-info-1" id="ogen_Obstructive_pul_new"></td>
              <td class="table-info-1" id="ugen_Obstructive_pul_old"></td>
              <td class="table-info-1" id="ogen_Obstructive_pul_old"></td>
            </tr>
            <tr class="">
              <td class="table-primary rec-report-head"></td>
              <td class="table-primary rec-report-head" >PHA</td>
              <td class="table-primary rec-report-head" id="">ART</td>
              <td class="table-primary rec-report-head" id=""></td>
              <td class="table-primary rec-report-head" ></td>
              
              <td></td>

              <td class="table-info-1">Renal D/s</td>
              <td class="table-info-1" id="ugen_Renal_new"></td>
              <td class="table-info-1" id="ogen_Renal_new"></td>
              <td class="table-info-1" id="ugen_Renal_old"></td>
              <td class="table-info-1" id="ogen_Renal_old"></td>
            </tr>
            <tr class="">
              <td class="table-info-2">MAM cohort</td>
              <td class="table-info-2" id="pha_mam_cohort"></td>
              <td class="table-info-2" id="art_mam_cohort"></td>
              <td class="table-info-2" id=""></td>
              <td class="table-info-2" id="" ></td>
              
              <td></td>

              <td class="table-info-1" class="table-info-1">GI & Hepatobiliary</td>
              <td class="table-info-1" class="table-info-1" id="ugen_GI_Hep_new"></td>
              <td class="table-info-1" class="table-info-1" id="ogen_GI_Hep_new"></td>
              <td class="table-info-1" class="table-info-1" id="ugen_GI_Hep_old"></td>
              <td class="table-info-1" class="table-info-1" id="ogen_GI_Hep_old"></td>
            </tr>
            <tr class="">
              <td class="table-info-2">Other cohort</td>
              <td class="table-info-2" id="pha_other_cohort"></td>
              <td class="table-info-2" id="art_other_cohort" ></td>
              <td class="table-info-2" id=""></td>
              <td class="table-info-2" ></td>
              
              <td></td>

              <td class="table-info-1">Gynaecology</td>
              <td class="table-info-1" id="ugen_Gynaecology_new"></td>
              <td class="table-info-1" id="ogen_Gynaecology_new"></td>
              <td class="table-info-1" id="ugen_Gynaecology_old"></td>
              <td class="table-info-1" id="ogen_Gynaecology_old"></td>
            </tr>
            <tr class="">
              <td></td>
              <td ></td>
              <td id=""></td>
              <td id=""></td>
              <td ></td>
              
              <td></td>

              <td class="table-info-1">Musculoskeleton and rheumatology</td>
              <td class="table-info-1" id="ugen_Muscul_rheuma_new"></td>
              <td class="table-info-1" id="ogen_Muscul_rheuma_new"></td>
              <td class="table-info-1" id="ugen_Muscul_rheuma_old"></td>
              <td class="table-info-1" id="ogen_Muscul_rheuma_old"></td>
            </tr>
            <tr class="">
              <td class="table-primary rec-report-head">Type of patients cousulte</td>
              <td class="table-primary"></td>
              <td class="table-primary" id=""></td>
              <td class="table-primary" id=""></td>
              <td></td>
              
              <td></td>

              <td class="table-info-1">STI</td>
              <td class="table-info-1" id="ugen_STI_new"></td>
              <td class="table-info-1" id="ogen_STI_new"></td>
              <td class="table-info-1" id="ugen_STI_old"></td>
              <td class="table-info-1" id="ogen_STI_old"></td>
            </tr>
            <tr class="">
              <td class="table-info-3">FSW</td>
              <td class="table-info-3" id="fsw"></td>
              <td class="table-info-3" id=""></td>
              <td class="table-info-3" id=""></td>
              <td></td>
              
              <td></td>

              <td class="table-info-1">Skin Infection</td>
              <td class="table-info-1" id="ugen_skin_infect_new"></td>
              <td class="table-info-1" id="ogen_skin_infect_new"></td>
              <td class="table-info-1" id="ugen_skin_infect_old"></td>
              <td class="table-info-1" id="ogen_skin_infect_old"></td>
            </tr>
            <tr class="">
              <td class="table-info-3">MSM</td>
              <td class="table-info-3" id="msm"></td>
              <td class="table-info-3" id=""></td>
              <td class="table-info-3" id=""></td>
              <td ></td>
              
              <td></td>

              <td class="table-info-1">Sexual violence</td>
              <td class="table-info-1" id="ugen_sex_violence_new"></td>
              <td class="table-info-1" id="ogen_sex_violence_new"></td>
              <td class="table-info-1" id="ugen_sex_violence_old"></td>
              <td class="table-info-1" id="ogen_sex_violence_old"></td>
            </tr>
            <tr class="">
              <td class="table-info-3">TG</td>
              <td class="table-info-3" id="tg" ></td>
              <td class="table-info-3" id=""></td>
              <td class="table-info-3" id=""></td>
              <td ></td>
              
              <td></td>

              <td class="table-info-1">Child Abuse</td>
              <td class="table-info-1" id="ugen_child_abuse_new"></td>
              <td class="table-info-1" id="ogen_child_abuse_new"></td>
              <td class="table-info-1" id="ugen_child_abuse_old"></td>
              <td class="table-info-1" id="ogen_child_abuse_old"></td>
            </tr>
            <tr class="">
              <td class="table-info-3">PWID</td>
              <td class="table-info-3" id="idu"></td>
              <td class="table-info-3" id=""></td>
              <td class="table-info-3" id=""></td>
              <td ></td>
              
              <td></td>

              <td class="table-info-1">Malnourished</td>
              <td class="table-info-1" id="ugen_malnourish_new"></td>
              <td class="table-info-1" id="ogen_malnourish_new"></td>
              <td class="table-info-1" id="ugen_malnourish_old"></td>
              <td class="table-info-1" id="ogen_malnourish_old"></td>
            </tr>
            <tr class="">
              <td class="table-info-3">Non-KP</td>
              <td class="table-info-3" id="non_kp"></td>
              <td class="table-info-3" id=""></td>
              <td class="table-info-3" id=""></td>
              <td ></td>
              
              <td></td>

              <td class="table-info-1">Dengue Fever</td>
              <td class="table-info-1" id="ugen_dengue_fever_new"></td>
              <td class="table-info-1" id="ogen_dengue_fever_new"></td>
              <td class="table-info-1" id="ugen_dengue_fever_old"></td>
              <td class="table-info-1" id="ogen_dengue_fever_old"></td>
            </tr>
            <tr class="">
              <td class="table-info-3">Blank in Diagnosis Data</td>
              <td class="table-info-3" id="blank_in_diagnosis"></td>
              <td class="table-info-3" id=""></td>
              <td class="table-info-3" id=""></td>
              <td ></td>
              
              <td></td>

              <td class="table-info-1">Others</td>
              <td class="table-info-1" id="ugen_others_new"></td>
              <td class="table-info-1" id="ogen_others_new"></td>
              <td class="table-info-1" id="ugen_others_old"></td>
              <td class="table-info-1" id="ogen_others_old"></td>
            </tr>

            <tr class="">
              <td class="table-info-3">Refer to Fever Team</td>
              <td class="table-info-3" id="ref_fever"></td>
              <td class="table-info-3" id=""></td>
              <td class="table-info-3" id=""></td>
              <td ></td>
              
              <td></td>

              <td class="table-info-1">Total</td>
              <td class="table-info-1" id="ugen_total_new"></td>
              <td class="table-info-1" id="ogen_total_new"></td>
              <td class="table-info-1" id="ugen_total_old"></td>
              <td class="table-info-1" id="ogen_total_old"></td>
            </tr>


           
          </tbody>
        </table>
        </div>
      </div>
    </div>
   
    <div class="row">

      <div class="col-sm-6">
        <span> </span>
        <canvas id="myChart" style="width:100%;height:400px;"></canvas>
      </div>
      <div class="col-sm-6">
        <span></span>
        <canvas id="myChart2" style="width:100%;height:400px; "></canvas>
      </div>
    </div>
    <br>

    <div class="row">
      <div id="toshowHead"></div>
      <div id="toshow"></div>
    </div>
    <br>
</div>
@endauth
@endsection
  <script type="text/javascript">
  var parseData = {!! json_encode($parseData) !!};
function calculate(){

    var d_from = document.getElementById("d_from").value;
    var d_to = document.getElementById("d_to").value;
   

    let calculate = 1;
      $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                 }
     });
     $.ajax({
          type:'POST',
          url:"{{route('consultation_report_cal')}}",
          //dataType:'json',
          //processData:false,
          //contentType: 'application/json',
          data:{
                d_from:d_from,
                d_to:d_to,
                calculate:calculate,
              },
          //data: rprDataset,
          success:function(response){
                console.log(response);
                $(".rp_cal").prop("disabled",true);

                $("button[type='submit']").prop("disabled",false);
                
                console.log(response[1]);
                document.getElementById('pha_u15_new').innerHTML=response[0];
                document.getElementById('pha_o15_new').innerHTML=response[1];
                document.getElementById('pha_u15_old').innerHTML=response[2];
                document.getElementById('pha_o15_old').innerHTML=response[3];

                document.getElementById('art_u15_new').innerHTML=response[4];
                document.getElementById('art_o15_new').innerHTML=response[5];
                document.getElementById('art_u15_old').innerHTML=response[6];
                document.getElementById('art_o15_old').innerHTML=response[7];

                document.getElementById('prep_u15_new').innerHTML=response[8];
                document.getElementById('prep_o15_new').innerHTML=response[9];
                document.getElementById('prep_u15_old').innerHTML=response[10];
                document.getElementById('prep_o15_old').innerHTML=response[11];

                document.getElementById('pmtct_u15_new').innerHTML=response[12];
                document.getElementById('pmtct_o15_new').innerHTML=response[13];
                document.getElementById('pmtct_u15_old').innerHTML=response[14];
                document.getElementById('pmtct_o15_old').innerHTML=response[15];

                document.getElementById('anc_u15_new').innerHTML=response[16];
                document.getElementById('anc_o15_new').innerHTML=response[17];
                document.getElementById('anc_u15_old').innerHTML=response[18];
                document.getElementById('anc_o15_old').innerHTML=response[19];

                document.getElementById('fp_u15_new').innerHTML=response[20];
                document.getElementById('fp_o15_new').innerHTML=response[21];
                document.getElementById('fp_u15_old').innerHTML=response[22];
                document.getElementById('fp_o15_old').innerHTML=response[23];

                document.getElementById('feed_u15_new').innerHTML=response[24];
                document.getElementById('feed_o15_new').innerHTML=response[25];
                document.getElementById('feed_u15_old').innerHTML=response[26];
                document.getElementById('feed_o15_old').innerHTML=response[27];

                document.getElementById('gen_u15_new').innerHTML=response[128];
                document.getElementById('gen_o15_new').innerHTML=response[129];
                document.getElementById('gen_u15_old').innerHTML=response[130];
                document.getElementById('gen_o15_old').innerHTML=response[131];

                document.getElementById('total_u15_new').innerHTML=response[0]+response[4]+response[8]+response[12]+response[16]+response[20]+response[24]+response[128];
                document.getElementById('total_o15_new').innerHTML=response[1]+response[5]+response[9]+response[13]+response[17]+response[21]+response[25]+response[129];
                document.getElementById('total_u15_old').innerHTML=response[2]+response[6]+response[10]+response[14]+response[18]+response[22]+response[26]+response[130];
                document.getElementById('total_o15_old').innerHTML=response[3]+response[7]+response[11]+response[15]+response[19]+response[23]+response[27]+response[131];

                // MAM Cohort
                document.getElementById('pha_mam_cohort').innerHTML=response[32];
                document.getElementById('art_mam_cohort').innerHTML=response[33];
                document.getElementById('pha_other_cohort').innerHTML=response[34];
                document.getElementById('art_other_cohort').innerHTML=response[35];
                // General Diagnosis
                document.getElementById('ugen_ncd_cvd_new').innerHTML=response[36];
                document.getElementById('ogen_ncd_cvd_new').innerHTML=response[37];
                document.getElementById('ugen_ncd_cvd_old').innerHTML=response[38];
                document.getElementById('ogen_ncd_cvd_old').innerHTML=response[39];

                document.getElementById('ugen_HT_only_new').innerHTML=response[40];
                document.getElementById('ogen_HT_only_new').innerHTML=response[41];
                document.getElementById('ugen_HT_only_old').innerHTML=response[42];
                document.getElementById('ogen_HT_only_old').innerHTML=response[43];

                document.getElementById('ugen_DM_only_new').innerHTML=response[44];
                document.getElementById('ogen_DM_only_new').innerHTML=response[45];
                document.getElementById('ugen_DM_only_old').innerHTML=response[46];
                document.getElementById('ogen_DM_only_old').innerHTML=response[47];

                document.getElementById('ugen_HT_DM_como_new').innerHTML=response[48];
                document.getElementById('ogen_HT_DM_como_new').innerHTML=response[49];
                document.getElementById('ugen_HT_DM_como_old').innerHTML=response[50];
                document.getElementById('ogen_HT_DM_como_old').innerHTML=response[51];

                document.getElementById('ugen_RTI_Less2wk_new').innerHTML=response[52];
                document.getElementById('ogen_RTI_Less2wk_new').innerHTML=response[53];
                document.getElementById('ugen_RTI_Less2wk_old').innerHTML=response[54];
                document.getElementById('ogen_RTI_Less2wk_old').innerHTML=response[55];

                document.getElementById('ugen_RTI_Great2wk_new').innerHTML=response[56];
                document.getElementById('ogen_RTI_Great2wk_new').innerHTML=response[57];
                document.getElementById('ugen_RTI_Great2wk_old').innerHTML=response[58];
                document.getElementById('ogen_RTI_Great2wk_old').innerHTML=response[59];

                document.getElementById('ugen_HIV_TB_new').innerHTML=response[60];
                document.getElementById('ogen_HIV_TB_new').innerHTML=response[61];
                document.getElementById('ugen_HIV_TB_old').innerHTML=response[62];
                document.getElementById('ogen_HIV_TB_old').innerHTML=response[63];

                document.getElementById('ugen_TB_relate_new').innerHTML=response[64];
                document.getElementById('ogen_TB_relate_new').innerHTML=response[65];
                document.getElementById('ugen_TB_relate_old').innerHTML=response[66];
                document.getElementById('ogen_TB_relate_old').innerHTML=response[67];

                document.getElementById('ugen_Covid_relate_new').innerHTML=response[68];
                document.getElementById('ogen_Covid_relate_new').innerHTML=response[69];
                document.getElementById('ugen_Covid_relate_old').innerHTML=response[70];
                document.getElementById('ogen_Covid_relate_old').innerHTML=response[71];

                document.getElementById('ugen_Obstructive_pul_new').innerHTML=response[72];
                document.getElementById('ogen_Obstructive_pul_new').innerHTML=response[73];
                document.getElementById('ugen_Obstructive_pul_old').innerHTML=response[74];
                document.getElementById('ogen_Obstructive_pul_old').innerHTML=response[75];

                document.getElementById('ugen_Renal_new').innerHTML=response[76];
                document.getElementById('ogen_Renal_new').innerHTML=response[77];
                document.getElementById('ugen_Renal_old').innerHTML=response[78];
                document.getElementById('ogen_Renal_old').innerHTML=response[79];

                document.getElementById('ugen_GI_Hep_new').innerHTML=response[80];
                document.getElementById('ogen_GI_Hep_new').innerHTML=response[81];
                document.getElementById('ugen_GI_Hep_old').innerHTML=response[82];
                document.getElementById('ogen_GI_Hep_old').innerHTML=response[83];

                document.getElementById('ugen_Gynaecology_new').innerHTML=response[84];
                document.getElementById('ogen_Gynaecology_new').innerHTML=response[85];
                document.getElementById('ugen_Gynaecology_old').innerHTML=response[86];
                document.getElementById('ogen_Gynaecology_old').innerHTML=response[87];

                document.getElementById('ugen_Muscul_rheuma_new').innerHTML=response[88];
                document.getElementById('ogen_Muscul_rheuma_new').innerHTML=response[89];
                document.getElementById('ugen_Muscul_rheuma_old').innerHTML=response[90];
                document.getElementById('ogen_Muscul_rheuma_old').innerHTML=response[91];

                document.getElementById('ugen_STI_new').innerHTML=response[92];
                document.getElementById('ogen_STI_new').innerHTML=response[93];
                document.getElementById('ugen_STI_old').innerHTML=response[94];
                document.getElementById('ogen_STI_old').innerHTML=response[95];

                document.getElementById('ugen_skin_infect_new').innerHTML=response[96];
                document.getElementById('ogen_skin_infect_new').innerHTML=response[97];
                document.getElementById('ugen_skin_infect_old').innerHTML=response[98];
                document.getElementById('ogen_skin_infect_old').innerHTML=response[99];

                document.getElementById('ugen_sex_violence_new').innerHTML=response[100];
                document.getElementById('ogen_sex_violence_new').innerHTML=response[101];
                document.getElementById('ugen_sex_violence_old').innerHTML=response[102];
                document.getElementById('ogen_sex_violence_old').innerHTML=response[103];

                document.getElementById('ugen_child_abuse_new').innerHTML=response[104];
                document.getElementById('ogen_child_abuse_new').innerHTML=response[105];
                document.getElementById('ugen_child_abuse_old').innerHTML=response[106];
                document.getElementById('ogen_child_abuse_old').innerHTML=response[107];

                document.getElementById('ugen_malnourish_new').innerHTML=response[108];
                document.getElementById('ogen_malnourish_new').innerHTML=response[109];
                document.getElementById('ugen_malnourish_old').innerHTML=response[110];
                document.getElementById('ogen_malnourish_old').innerHTML=response[111];

                document.getElementById('ugen_dengue_fever_new').innerHTML=response[112];
                document.getElementById('ogen_dengue_fever_new').innerHTML=response[113];
                document.getElementById('ugen_dengue_fever_old').innerHTML=response[114];
                document.getElementById('ogen_dengue_fever_old').innerHTML=response[115];

                document.getElementById('ugen_others_new').innerHTML=response[116];
                document.getElementById('ogen_others_new').innerHTML=response[117];
                document.getElementById('ugen_others_old').innerHTML=response[118];
                document.getElementById('ogen_others_old').innerHTML=response[119];

                document.getElementById('fsw').innerHTML=response[120];
                document.getElementById('msm').innerHTML=response[121];
                document.getElementById('tg').innerHTML=response[122];
                document.getElementById('idu').innerHTML=response[123];
                document.getElementById('non_kp').innerHTML=response[124];

                document.getElementById('blank_in_diagnosis').innerHTML=response[125] + response[126];
                //document.getElementById('lab_inv_only').innerHTML=response[127];
                
                document.getElementById('ugen_total_new').innerHTML=response[128];
                document.getElementById('ogen_total_new').innerHTML=response[129];
                document.getElementById('ugen_total_old').innerHTML=response[130];
                document.getElementById('ogen_total_old').innerHTML=response[131];

                document.getElementById('ref_fever').innerHTML=response[132];
                
               
               
              
                  var parseData = response[133];
                  // dot = JSON.stringify(parseData);
                  //$('#neededData').val(JSON.stringify(parseData));
                  //$('#neededData').val(response[133]);
                  //$('.Form').prop('disabled', false);  // Enable the form
                  $('#needArray').val(JSON.stringify(parseData));
                console.log(parseData);
              }
       });
}


function change_permission(){
  $(".rp_cal").prop("disabled",false);
  $("button[type='submit']").prop("disabled",true);
}

function Refresh(){
  history.go(0);
}
function hider(){
  $("#wannaHide").hide();
}
</script>

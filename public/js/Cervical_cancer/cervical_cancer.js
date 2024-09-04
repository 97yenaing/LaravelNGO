
$(document).ready(function(){
    $('html, body').animate({ scrollTop: 0 }, 'fast');
    $("#cercival_pid").focus();

    $("#crecival_breastExam,#crecival_abnormal_breast,#via_test,#via_postponed_reason,#eligible_thermal_ablation,"+
        "#eligible_thermal_ablation_rea,#thermal_ablation,#thermal_ablation_rea,#ae,#complaint,#complaint_spec")
    .change(function(){
        cercival_endisabled()
    })

    $("#cervical_history").click(function cercival_history_show(){
        $("#cercival_historyBolck").show();
        $("#screening_Info").hide();
        $(".cercival_hisDataRow").remove();
        for(i=0;i<generalInfo[0][1].length;i++){
            
            var cercival_HisList=$("<div>").attr({class:"row no-margin cercival_hisDataRow"})
            .append($("<div>").attr({class:"col-sm-1 no-margin cercival-hisData"}).text((i+1)))
            .append($("<div>").attr({class:"col-sm-2 no-margin cercival-hisData"}).text(generalInfo[0][1][i]["General ID"]))
            .append($("<div>").attr({class:"col-sm-2 no-margin cercival-hisData"}).text(generalInfo[0][1][i]["FuchiaID"]))
            .append($("<div>").attr({class:"col-sm-2 no-margin cercival-hisData"}).text(generalInfo[0][1][i]["Visit_date"]))
            .append($("<div>").attr({class:"col-sm-4 no-margin cercival-hisData"})
            .append($("<button>").attr({class:"btn btn-info cercival-his-detailBtn",id:"cercival_detail"+generalInfo[0][1][i]["id"],onclick:"cercival_History()"}).text("Detail Data"))
            .append($("<button>").attr({class:"btn btn-danger cercival-his-deleteBtn",id:"cercival_detail"+generalInfo[0][1][i]["id"],onclick:"cercival_remove()"}).text("Delete Data")));
            $("#history_ListData").append(cercival_HisList);
            
        }
        
       
    })

    $("#cercival_idChange").click(function(){
        if($("#cercival_idChange").is(":checked")){
            $("#cercival_pid,#cercival_fid,#cercival_ptFind").prop("disabled",false);
            $("#cercival_save").prop("disabled",true);
        }else{
            $("#cercival_pid,#cercival_fid,#cercival_ptFind").prop("disabled",true);
        }
    })
    $("#CC_refresh").click(function(){
        history.go(0)
    })


})
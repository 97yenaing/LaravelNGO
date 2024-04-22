$(document).ready(function(){
    $("#cmv_pid").focus();
    $("#cmv_vDate").val(todayIn);
    $("#cmv_RVeye,#cmv_LVeye").click(function(){
        cmv_VisionEyes();
        
    });

    $("#cmv_history").click(function(){
        console.log(cmv_history);
        $(".cmv_hisDataRow,#cmv_goHomeBtn").remove();
        $("#cmv_historyBlock").show();
        $("#cmv_Info").hide();
        cmv_history.forEach((cmvhistory_row,index) => {
            let cmv_HisList=$("<div>").attr({class:"row no-margin cmv_hisDataRow"})
            .append($("<div>").attr({class:"col-sm-1 no-margin cmv-hisData"}).text(index+1))
            .append($("<div>").attr({class:"col-sm-2 no-margin cmv-hisData"}).text(cmvhistory_row["Pid_cmv"]))
            .append($("<div>").attr({class:"col-sm-2 no-margin cmv-hisData"}).text(cmvhistory_row["FuchiaID_cmv"]))
            .append($("<div>").attr({class:"col-sm-2 no-margin cmv-hisData"}).text(cmvhistory_row["Visit_date"]))
            .append($("<div>").attr({class:"col-sm-2 no-margin cmv-hisData"}).append($("<button>").attr({class:"btn btn-info",id:"cmv_detail"+cmvhistory_row["id"],onclick:"cmv_History()"}).text("Detail"))
            .append($("<button>").attr({class:"btn btn-danger",id:"cmv_remove"+cmvhistory_row["id"],onclick:"cmv_Remove()"}).text("Delete")))
            $("#cmv_historyBlock").append(cmv_HisList);
            console.log(cmvhistory_row);
        });
        let cmv_goHome=$("<div>").attr({class:"row",style:"justify-content:center",id:"cmv_goHomeBtn"})
                        .append($("<div>").attr({class:"col-sm-2"}).append($("<button>").attr({class:"btn btn-info cmv-gohomeBtn",onclick:"Gotohome()"}).text("To Record")));
        $("#cmv_historyBlock").append(cmv_goHome);
    })

    $("#cmv_idChange").click(function(){
        if($("#cmv_idChange").is(":checked")){
            $(".cmv-generalCode").children().prop("disabled",false);
            $("#cmv_saveUP").prop("disabled",true);
        }else{
            $(".cmv-generalCode").children().prop("disabled",true);
        }

    })
    $("#cmv_refresh").click(function(){
        history.go(0);
    })



    
});
$(document).ready(function(){
    $("#ipt_history").click(function(){
        console.log(ipt_history);
        $("#ipt_mainData").hide();
        $("#ipt_historyShow").show();
        $(".ipt-hisrow").remove();
        console.log(ipt_history.length);
        for(var i=0;i<ipt_history.length;i++){
            var ipt_hiscount=$("<div>").attr({class:"row ipt-hisrow no-margin"})
            .append($("<div>").attr({class:"col-sm-1 ipt-hisdata no-margin"}).text(i+1))
            .append($("<div>").attr({class:"col-sm-2 ipt-hisdata no-margin"}).text(ipt_history[i]["Pid_iptTB"]))
            .append($("<div>").attr({class:"col-sm-2 ipt-hisdata no-margin"}).text(ipt_history[i]["FuchiaID_iptTB"]))
            .append($("<div>").attr({class:"col-sm-2 ipt-hisdata no-margin"}).text(ipt_history[i]["IPT_startDate"]))
            .append($("<div>").attr({class:"col-sm-2 ipt-hisdata no-margin"}).text(ipt_history[i]["Outcome"]))
            .append($("<div>").attr({class:"col-sm-2 ipt-hisdata no-margin"})
            .append($("<button>").attr({class:"btn ipt-hisBtn",onclick:"ipt_hisView()",id:"ipt_hisBtn"+ipt_history[i]["id"]}).text("Detail"))
            .append($("<button>").attr({class:"btn btn-danger",onclick:"ipt_remove()",id:"ipt_remove"+ipt_history[i]["id"]}).text("Delete")))
            
            $("#ipt_followList").append(ipt_hiscount);
        }

    })
    $("#iptHis-cancel").click(function(){
        $("#ipt_mainData").show();
        $("#ipt_historyShow").hide();
    })
    $("#ipt_idChange").click(function(){
        if($(this).is(":checked")){
            $(".tbIPt-generalCode input").prop("disabled",false);
            $("#iptsaveUp").prop("disabled",true);
        }else{
            $(".tbIPt-generalCode input").prop("disabled",true);
        }
       
    })
    $("#ipt_refresh").click(function() {
        history.go(0);
    })
})
$(document).ready(function(){
    $('html, body').animate({ scrollTop: 0 }, 'slow');
    $("#preTb_Pid").focus();
    $(".preTB-BioRes input[type='checkbox']").click(function(){
        if($(this).is(":checked")){
            $("."+$(this).attr("id")+"Data").show();
            $(this).parent().css({height:"130px"})
        }else{
            $("."+$(this).attr("id")+"Data").hide();
            $(this).parent().css({height:"45px"});
            $("." + $(this).attr("id") + "Data").find("input,select").val("");
        }
        
    })
    $(".tb-newClsym input[type='checkbox']").click(function(){
        if($(this).is(":checked")){
            $("."+$(this).attr("id")+"Data").show();
            console.log($(this).attr("id"));
            if($(this).attr("id")=="lympreTb_check"){
                $(this).parent().css({height:"130px"})
            }else{
                $(this).parent().css({height:"65px"})
            }
            
        }else{
            console.log("hello uncheck")
            $("."+$(this).attr("id")+"Data").hide();
            $("." + $(this).attr("id") + "Data").find("input,select").val("");
            $(this).parent().css({height:"45px"});
        }
        
    })

    $("#partB_needTeachAdv").click(function(){
        if($(this).is(":checked")){
            $("#preTB_teachAdvice").prop("disabled",false)
        }else {
            $("#preTB_teachAdvice").prop("disabled",true)
        }
    })

    $("#preTB_history").click(function(){
        console.log(Fhistory_data)
        $(".preTB-Flist").remove();
        $("#preTB_Fsection").show();
        $(".part-section").addClass("freeze-body").css("opacity","0.1");
        for (let prefollow = 0; prefollow < Fhistory_data.length; prefollow++) {
            var preTB_Flist=$("<div>").attr({class:"row no-margin preTB-Flist"}).append($("<div>").attr({class:"col-sm-1 no-margin preTB_FNo"}).text(prefollow+1))
                            .append($("<div>").attr({class:"col-sm-4 no-margin preTB_FID"}).text(Fhistory_data[prefollow]["Pid_preTB"]))
                            .append($("<div>").attr({class:"col-sm-4 no-margin preTB_FvDate"}).text(Fhistory_data[prefollow]["TBscreenDate_preTB"]))
                            .append($("<div>").attr({class:"col-sm-3 no-margin preTB_Fview"})
                            .append($("<button>").attr({class:"btn preTB_FViewBtn",id:"preTBview_"+prefollow,onclick:"preTB_FollowData()"}).text("Detail"))
                            .append($("<button>").attr({class:"btn btn-danger",id:"preTB_remove_"+prefollow,onclick:"preTB_remove()"}).text("Delete")));
            $("#preTB_Fsection").append(preTB_Flist);
                    
        }
    })

    $("#main_page_return").click(function(){
        $("#preTB_Fsection").hide();
        $(".part-section").removeClass("freeze-body").css("opacity","1");
    })

    $(".preTB-search .input-group").children().change(function(){

        if(update_alert=="preTB update"){
            console.log("hello change btn")
            $(".preTB_button button").prop("disabled",true);
            $("#preTB_history").hide();
            $(".IDchange-comfirm").show();
            $(".part-section").addClass("freeze-body").css("opacity","0.01");
        }
        
    })
    $("#preTB_idYes,#preTB_idNo").click(function(){

        var id_yesNo=event.target.id;
        if(id_yesNo=="preTB_idYes"){
            $("#preTB_history").show();
            $(".IDchange-comfirm").hide();
            $(".part-section").removeClass("freeze-body").css("opacity","1");
            $(".preTB-search button").focus();
        }else{
            $("#preTb_Pid").val(Fhistory_data[0]["Pid_preTB"]);
            $("#preTb_fuchiaID").val(Fhistory_data[0]["FuchiaID_preTB"]);
            $("#preTB_history").show();
            $(".IDchange-comfirm").hide();
            $(".part-section").removeClass("freeze-body").css("opacity","1");
            $(".preTB-search button").focus();
            $(".preTB_button button").prop("disabled",false);
        }
        
    })
    $("#preTB_refresh").click(function(){
        history.go(0);
    })
   
})
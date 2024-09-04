$(document).ready(function(){
    $("#TB03_pid").focus();
    $(".tb-m2 select,.tb-m3 select,.tb-m5 select,.tb-endDiag select").prop("disabled",true);
    $("#tb-m2,#tb-m3,#tb-m5,#tb-endDiag").click(function(){
        // $(this).parent().parent().children("label").css({
        //     "background-color": "#00dcff"
        // });

        $(this).closest(".row").find("button").css({
            "background-color": "#00dcff"
        });
        $(this).css({
            "background-color":"#ff6900",
        })
        $(".tb-m2 select,.tb-m3 select,.tb-m5 select,.tb-endDiag select").prop("disabled",true);
        var tb_tab=$(this).attr("id");
        $("."+tb_tab+" select").prop("disabled",false);
        console.log(tb_tab);

    })
    $("#TBid_change").click(function(){
       if($("#TBid_change").is(":checked")){
        $("#Tb_registerForm .tb-generalCode").children().prop("disabled",false);
        $("#tb_info .TB-button,#tb03_remove").prop("disabled",true);
        $("#Tb_registerForm .tb-generalCode").children().eq(2).prop("disabled",false)
        alert("To change ID of TB-03 register,1. search ID,2. click 'Follow Up' button ,3. click 'Detail' button,4. check ID change check box, 5. Insert required ID,then click update TB-03 button.")
        $("#new_RC_Block").hide();
       }else{
        $("#Tb_registerForm .tb-generalCode").children().prop("disabled", function(index) {
            return index !== 2;
        });
        $("#new_RC_Block").show();
       } 
    })
    $("#tbo3_refresh").click(function(){
        history.go(0);
    })
    $("#TB03_retrun").click(function(){
        $("#tb03_history").hide();
        $("#tb03_main").show();
    })
})
$(document).ready(function(){
    $('html, body').animate({ scrollTop: 0 }, 'slow');
    $("#ncd_pid").focus();
    $("#ncd_regIDchange,.limit-input").prop("disabled",true);
     
    $("#ncd_followView").click(function(){
       $("#ncd_existing").addClass("freeze-body").css("opacity",0.01);
       $("#ncd_followList").show();

    })

    $("#ncd_followAdd").click(function(){
        $("#ncd_existing").hide();
        $("#ncdfollow_upAdd").show();
    })

    $("#ncd-toRegister").click(function(){
        $("#ncd_existing").show();
        $("#ncdfollow_upAdd").hide();
    })

    $("#ncd_Rweight,#ncdV_weight").blur(function(){
       let idname=event.target.id;
       console.log(idname);
       if(idname=="ncd_Rweight"){
        let bmiW=Number($("#ncd_Rweight").val());
        let bmiH=Number($("#ncd_Rheight").val());
        bmiCalculate(bmiW,bmiH);
        $("#ncd_RegisterBmi").text(bmiresut);
       }else{
        let bmiW=Number($("#ncdV_weight").val());
        let bmiH=follow_height;
        bmiCalculate(bmiW,bmiH);
        $("#ncd_FollowBmi").text(bmiresut);
       } 
       
    })

    $("#ncd_followAdd").click(function(){
        let bmiW=Number($("#ncdV_weight").val());
        let bmiH=follow_height;
        console.log(bmiW+bmiH+"hello")
        bmiCalculate(bmiW,bmiH);
        $("#ncd_FollowBmi").text(bmiresut);
    })
    
    $("#ncdV_time").change(function(){
        var time=$("#ncdV_time").val();
        var timesplit=time.split(":");
        if(timesplit.length>1){
            if(timesplit[1]<60){
                if(timesplit[0]<12){
                    $("#ncdV_time").val(timesplit[0]+":"+timesplit[1]+":00 AM");
                }else if(timesplit[0]>12){
                    if(timesplit[0]!=24){
                        var evenTime=timesplit[0]-12;
                        $("#ncdV_time").val(evenTime+":"+timesplit[1]+":00 PM");
                    }else{
                        alert("you should change date");
                        $("#ncdV_time").val("");
                        $("#ncdV_visit").focus();
                    }
                    
                }else{
                    $("#ncdV_time").val(timesplit[0]+":"+timesplit[1]+":00 PM");
                }
            }else{
                alert("Your minute should be less than 60");
                $("#ncdV_time").val("").focus();
               
            }
          
        }else{
            alert("Your time formated is wrong");
            $("#ncdV_time").val("").focus();

        }

    })

    $("#ncdV_pid,#ncdV_fid").click(function(){
        console.log($("#ncdV_pid").val());
        $("#ncd_pid").val($("#ncdV_pid").val());
        $("#ncdV_fid").val($("#ncdV_fid").val());
        findncd_patient();
    })
    $("#ncd_regIDchange").click(function(){
        if($(this).is(":checked")){
            $("#ncd_pid,#ncd_fid,.ncd-generalCode button").prop("disabled",false);
            $(".ncd_btn button").prop("disabled",true)
        }else{
            $("#ncd_pid,#ncd_fid,.ncd-generalCode button").prop("disabled",true);
            $(".ncd_btn button").prop("disabled",false)
        }
    })
    $("#ncdClinic_sym,#ncdother_medic,#ncdPat_recurIf,#ncdV_Type_currentVisit,#ncdV_otherMeication").change(function(){
        var limit_class = $(this).attr("class").split(" ");
        var desiredClass;
        
        for (var i = 0; i < limit_class.length; i++) {
            if (limit_class[i].startsWith("speDetermine-")) {
                desiredClass = limit_class[i];
                break;
            }
        }

        if (desiredClass) {
            var speDetermine = desiredClass.replace(/[0-9]/g, '');
            var counter = desiredClass.match(/(\d+)/);
            var change_id=Number(counter[0])+1;
            if($(this).val()=="Yes"||$(this).val()=="late"){
                $("."+speDetermine +change_id).prop("disabled",false);
            }else{
                $("."+speDetermine +change_id).prop("disabled",true);
            }
            console.log(speDetermine + counter[0]);
        }
    });
    $("#ncdV_outcome").change(function(){
        outCome_applicable();
    })

   
    
   
})
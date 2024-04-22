// const { forEach } = require("lodash");

$(document).ready(function(){
    console.log(itemsArray);
    var despencing_store=[];
    medicine_list=[]
    $("#vDate,#medic_entry_Date_from,#medic_entry_Date_to,#givenDate_toshow").val(todayIn);
    let fine_ty,originalID,orignalCalss,consum_Search;
    for(var i=0;i<itemsArray.length;i++){
        despencing_store[i]=itemsArray[i]["Medic_item"]
    }
    function check(text){
        medicine_listName=[];
        var list=0;
         despencing_store.filter(function(item){
            medicine_list[list]= item.toLowerCase().includes(text.toLowerCase());
            if(medicine_list[list]==true){
                medicine_listName[list]=item;
            }
            list++;

        })
    
    } // Search Function for medicine

    $("#dis_rp_type").change(function(){
        rp_clinic=$(this).val();
        if(rp_clinic=="Clinic Out"){
            $("#rp_clinic_find").show();
        }else{
            $("#rp_clinic_find").hide();
        }
    })

    $("#medicine_name,#medicine_stockname,#medicine_ItemEdit").on('input',function(){
        var stockOrconsum=event.target.id;
        if(stockOrconsum=="medicine_name"){
            var div_head="check_mediSection";
            var medi_divID="medicineID";
            var check_blog="labelcheck";
            var check_id="check"
            var check_funtion="check_medi()";
            var show_parent="medicine_show";
        }else if(stockOrconsum=="medicine_stockname"){
            var div_head="checkStock_mediSection";
            var medi_divID="medicine_StockID";
            var check_blog="labelStockcheck";
            var check_id="checkStock"
            var check_funtion="checkStock_medi()";
            var show_parent="medicineStock_show";
        }else if(stockOrconsum=="medicine_ItemEdit"){
            var div_head="checkEdit_mediSection";
            var medi_divID="medicineEditID";
            var check_blog="labelcheckEdit";
            var check_id="checkEdit"
            var check_funtion="check_mediEdit()";
            var show_parent="medicineEdit_show";
        }

        
        
        var inputText=$(this).val();
        if(inputText.length>0){
            check(inputText);
            var match=medicine_listName;
            
            keys=Object.keys(match);
            if(keys.length>0){
                $("."+div_head).remove();
                for (var i = 0; i < keys.length; i++) {
                    var check_div=$('<div>').attr({
                        id:medi_divID+keys[i],
                        class:"col-sm-12 "+div_head,
                    });
                    var check_mediLabel=$('<label>').text(match[keys[i]]).css({
                        "display": "inline-block",
                        "position": "relative",
                        "bottom": "16px",
                        "left": "2%"
                    }).attr({
                                
                                id:check_blog+keys[i],
                            });
                    var check_box=$('<input>').attr({
                                        type: 'checkbox',
                                        id:check_id+keys[i],
                                        value:keys[i],
                                        onclick:check_funtion,
                                        });
                    var check_input=check_div.append(check_box);

                    $("#"+show_parent).append(check_input.append(check_mediLabel));

                }
                var saveMedic_list=$(".medic_area").children('div').toArray();
                for(var sChild=0;sChild<saveMedic_list.length;sChild++){
                    var savechild_sequence=$(saveMedic_list[sChild]).attr('id');
                    var idnumber=savechild_sequence.match(/\d+/);
                    $("#check"+idnumber).prop({checked:true,disabled:true});
                }

            }else{
            $("."+div_head).remove();
            }
        }else{
            $(".check_mediSection").remove();
        }
        
        $(document).keydown(function(e) {
            // Check if the pressed key is the Enter key
            if (e.keyCode === 13) {
                $("#medicine_name").val("");
                $("#medicine_name").focus();
            }
            if (e.keyCode === 38) {
                $("#medicine_name").val("");
                $("#medicine_name").focus();
            }
        });


    })// find or not fucntion

    
    $("#search_update").on('click',function(){
        
        $(".consumption-Info").css({position:"relative",opacity:"0.1"}).addClass("freeze-body")
        $(".medic-searchUpdate").css({opacity:"1",top:"20%"}).removeClass("freeze-body");

    })//To Update Section

    $("#dis_cancel,#dis_update").on('click',function(){
        let UpdeterClick=$(event.target).attr("id"); 
        if(UpdeterClick=="dis_update"&& $("#consumUptype").val()!="Patient"){
            
            $("#consumtype").val($("#consumUptype").val());
            console.log("Hello update click")
            originalID="mid"
            orignalCalss=""
            fine_ty="other_find"
            consum_Search="consumtype"
            disOtherChoice(consum_Search,fine_ty,originalID,orignalCalss);
        }else if(UpdeterClick=="dis_cancel"){
            $(".medic-searchUpdate").css({opacity:"",top:""}).addClass("freeze-body");
            $(".consumption-Info").css({position:"",opacity:""}).removeClass("freeze-body")
            $("#consumtype").show();
        }
        
    })

    $("#consumtype,#consumUptype").on("change",function(){
        consum_Search=$(event.target).attr("id");
        console.log(consum_Search);
        if(consum_Search=="consumtype"){
             originalID="mid";
             orignalCalss="";
             fine_ty="other_find";
            console.log(fine_ty);
        }else{
             fine_ty="dis_Updategid"
             originalID="dis_Updategid"
             orignalCalss="dis_updatedID"
        }
        disOtherChoice(consum_Search,fine_ty,originalID,orignalCalss);//("selectTypeID","choiceTypeID")
        if(consum_Search=="consumUptype"){
            $(".medic-searchUpdate .medicother_select").css("margin-top","35px")
            //  
        }else {
            $(".medicother_select").css("margin-top","0px")
        }
    })

    $("#condome_rp").on("change",function(){
        let rp_cdomeType=$("#condome_rp").val();
        if(rp_cdomeType==""){
            $("#dis_exportDate,#expord_data").show();
            $("#reportCon_detail").hide();
        }else{
           $("#reportCon_detail").show();
           $("#dis_exportDate,#expord_data").hide();
           $(".cdomeUse").remove();
           console.log(condomeMale);
           console.log(condomeFemale);
            if(rp_cdomeType=="maleCon"){
                let mckeys=[],mcvalues=[];
                $("#rp_ConName").text(itemsArray[300]["Medic_item"])
                $.each(condomeMale, function(key, value) {
                    mckeys.push(key);
                    mcvalues.push(value);
                  })
                  console.log(mckeys.length);
                for(var mconList=0;mconList<mckeys.length; mconList++){
                    var mconDetail=$("<div>").attr({class:"row no-margin cdomeUse"}).css("justify-content","center")
                    .append($("<div>").attr({class:"col-sm-1 male_conrpDeatail no-margin"}).text(mconList+1))
                    .append($("<div>").attr({class:"col-sm-2 male_conrpDeatail no-margin"}).text(mckeys[mconList]))
                    .append($("<div>").attr({class:"col-sm-2 male_conrpDeatail no-margin"}).text(mcvalues[mconList]))
                    $("#reportCon_detail").append(mconDetail);
                }
            }else if(rp_cdomeType=="femaleCon"){
                let fckeys=[],fcvalues=[];
                $("#rp_ConName").text(itemsArray[304]["Medic_item"])
                $.each(condomeFemale, function(key, value) {
                    fckeys.push(key);
                    fcvalues.push(value);
                  })
                  console.log(fckeys.length);
                for(var fconList=0;fconList<fckeys.length; fconList++){
                    var fconDetail=$("<div>").attr({class:"row no-margin cdomeUse"}).css("justify-content","center")
                    .append($("<div>").attr({class:"col-sm-1 female_conrpDeatail no-margin"}).text(fconList+1))
                    .append($("<div>").attr({class:"col-sm-2 female_conrpDeatail no-margin"}).text(fckeys[fconList]))
                    .append($("<div>").attr({class:"col-sm-2 female_conrpDeatail no-margin"}).text(fcvalues[fconList]))
                    $("#reportCon_detail").append(fconDetail);
                }
            }
        }
       
    })
    
    
    
    
  
});

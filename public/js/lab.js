$(document).ready(function () {
    $("#vDate,#lab_follow_dateFrom,#lab_follow_dateTo").val(todayIn);
	$(function () {
            $('.diseaseTest').on('click', function () {
                        $(".clue").hide();
                        $(".pmnl").hide();
                        $(".trich").hide();
                        $(".gram-intra").hide();
                        $(".gram-extra").hide();
                        $(".candida").hide();
                        $(".spermatazoites").hide();
                        $('.diseaseTest').css("background-color","") ;
                        $('.diseaseTest').css("color","") ;
                        var target = $( event.target );
                        target.css("background-color","#f8fafc") ;
                        target.css("color","#495057");
                        var index = $(this).index();
                        switch(index){
                            case 0:
                                $(".clue").show();
                            break;
                            case 1: 
                                $(".pmnl").show();
                            break;
                            case 2:
                                $(".trich").show();
                            break;
                            case 3:
                                $(".gram-intra").show();
                            break;
                            case 4:
                                $(".gram-extra").show();
                            break;
                            case 5:
                                $(".candida").show();
                            break;
                            case 6:
                                $(".spermatazoites").show();
                            break;
                            

                        }
                                            
                        $('#sti-diseaseTest').stop().animate({
                            left: -300,
                        }, 500);
                        $(".btn-stiList").removeClass('hb-open');
                                                    
                    });

                });
    
    $("#csf_smear").change(function() {
    	
        gramChange();// function in lab-blade
    });
    $("#skin_smear").change(function() {
        gramChange1();// function in lab-blade
    });
    $("#lymph_test").change(function() {
        gramChange2();// function in lab-blade
    });
    $("#specimen_type").change(function() {     
        specimanType();// function in lab-blade
    });
    $("#lab_export_tab,#lab_follow_up,#search_tab").click(function() {     
        $("#hider0").hide();
    });
    $("#btn_printblock").click(function() {     
       $("#printSection").show();
       $(".lab-incon-div,#header_bar,.genral-info").addClass("freeze-body");

       $(".lab-incon-div,#header_bar,.genral-info").css({
        opacity: 0.1,
        
       })
       
    });
    $("#cancel_print").click(function() {     
        $("#printSection").hide();
        $(".lab-incon-div,#header_bar,.genral-info").removeClass("freeze-body");
 
        $(".lab-incon-div,#header_bar,.genral-info").css({
         opacity: 1,
         
        })  
     });

     $(".lab-second-link li a").click(function() {     
       var linkID=$(this).attr("id");
       console.log(linkID+"link ID is here")
       if(linkID=="search_tab"||linkID=="lab_export_tab"){
        $("#btn_printblock").hide();
       }else{
        $("#btn_printblock").show();
       }
     });


  
    

    });

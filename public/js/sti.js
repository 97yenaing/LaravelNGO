$(document).ready(function () {
    $('html, body').animate({ scrollTop: 0 }, 'slow');
    //$("#regdate").val(todayIn);
    $("#pid").focus();
	$(function () {
        $('#ucler_li').on('click', function () {
            $('#ucler_li').css("background-color","#1C82AD");
            $('#other_li').css("background-color","#dc3545");
            $('#disharge_li').css("background-color","#dc3545");

			$(".ucler-list").toggle();
            $(".disharge-list").hide();
            $(".otherStd-list").hide();
            

		});
        $('#disharge_li').on('click', function () {
            $('#disharge_li').css("background-color","#1C82AD");
            $('#ucler_li').css("background-color","#dc3545");
            $('#other_li').css("background-color","#dc3545")

			$(".disharge-list").toggle();
            $(".ucler-list").hide();
            $(".otherStd-list").hide();
            
		});
        $('#other_li').on('click', function () {
            $('#other_li').css("background-color","#1C82AD")
            $('#disharge_li').css("background-color","#dc3545");
            $('#ucler_li').css("background-color","#dc3545");
            
			$(".otherStd-list").toggle();
            $(".ucler-list").hide();
            $(".disharge-list").hide();
            
		});
        $('.btn-stiList').on('click', function () {
			var leftVal = 0;
			if ($(this).hasClass('hb-open')) {
				leftVal = -300;
				$(this).removeClass('hb-open');
			} else {
				$(this).addClass('hb-open');
			}

			$('#sti-diseaseTest').stop().animate({
				left: leftVal
			}, 500);
		});
		

	});
    $("#sti_id_change").change(function(){
        if($("#sti_id_change").prop("checked")){
            $("#pid-search,#pid,#regdate").prop("disabled",false);
            $("#update-male,#update-female").addClass("show-button")
        }else{
            $("#pid-search,#pid,#regdate").prop("disabled",true);
            if($("#gender").text()=="Male"){
                $("#update-male").removeClass("show-button")
            }else if($("#gender").text()=="Female"){
                $("#update-female").removeClass("show-button")
            }
        }
    })

});

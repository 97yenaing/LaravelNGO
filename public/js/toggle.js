$(document).ready(function () {
	$(function () {
		$('.btn-gnavi').on('click', function () {
			var leftVal = 0;
			if ($(this).hasClass('hb-open')) {
				leftVal = -300;
				$(this).removeClass('hb-open');
			} else {
				$(this).addClass('hb-open');
			}

			$('#hidden-title').stop().animate({
				left: leftVal
			}, 500);
		});
        $('.toggle-link').on('click', function () {                           
                $('#hidden-title').stop().animate({
                    left: -300,
                }, 500);
                $(".btn-gnavi").removeClass('hb-open');
                                              
		});
		$('.btn-gnavitop').on('click', function () {
			var leftVal = 0;
			if ($(this).hasClass('hb-open')) {
				leftVal = -300;
				$(this).removeClass('hb-open');
			} else {
				$(this).addClass('hb-open');
			}

			$('#main-title').stop().animate({
				left: leftVal
			}, 500);
		});
		$('.dropdown-item').on('click', function () {                           
			$('#main-title').stop().animate({
				left: -300,
			}, 500);
			$(".btn-gnavitop").removeClass('hb-open');
										  
	});

       
        
       
        
       


	});

});



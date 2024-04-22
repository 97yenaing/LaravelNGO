$(document).ready(function(){
    var images=[];
    images = ["image1.png", "image2.png", "image3.png", "image4.png", "image5.png", "image6.png"];
    var currentIndex = 0;
        
       

        $(window).resize(function() {
                console.log("window");
                var screenWidth = $(window).width();
         if(screenWidth<1161 && screenWidth>599){
            images= ["imagetb1.png", "imagetb2.png", "imagetb3.png", "imagetb4.png", "imagetb5.png", "imagetb6.png"];
                
            }else if (screenWidth<600){
                images= ["imagemb1.png", "imagemb2.png", "imagemb3.png", "imagemb4.png", "imagemb5.png", "imagemb6.png"];
            }else {
               
                images = ["image1.png", "image2.png", "image3.png", "image4.png", "image5.png", "image6.png"];
            }
            
            
    });
    setInterval(function(){
            currentIndex = (currentIndex + 1) % images.length;
            
            
            // Create a new image element with the next image
            var $nextImage = $('<img>').attr('src','img/welcome/'+images[currentIndex]).attr('id', 'optWelcome-img').css('display', 'none');
            $('#welcome-img').append($nextImage);
            
            // Fade out the current image and remove it from the DOM
            $('#optWelcome-img').fadeOut(1000, function(){
                $('#welcome-img').children().not(":last").remove();
               
            });
            
            // Fade in the next image
            $nextImage.fadeIn(1000);
                }, 30000); // Set the interval to 1 minute (in milliseconds)
  
});

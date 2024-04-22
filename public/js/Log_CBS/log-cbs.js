$(document).ready(function(){
    $("#mental_health,#OST_Offer_Done,#OST_Offer_Accepted,#Decline_Reason").change(function(){
       
        mental_validation();
    })
    $("#hts_test").change(function(){
        hiv_test_determine();
    })
})
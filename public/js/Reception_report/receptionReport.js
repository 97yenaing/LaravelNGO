$(document).ready(function(){
    $('html, body').animate({ scrollTop: 0 }, 'slow');
    console.log(today);
    var year=today.split("-")[0];
    console.log(year);
    var origin_opt=$("#year option:last-child").val();
    net_year=year-origin_opt;
    for (let index = 1; index <= net_year; index++) {
        var set_opt=$("<option>").attr({value:2023+index}).text(2020+index)
        $("#year").append(set_opt);
    }
})
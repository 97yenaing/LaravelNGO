$(document).ready(function(){
  today=$.datepicker.formatDate('yy-mm-dd', new Date());
  todayIn=$.datepicker.formatDate('dd-mm-yy', new Date());

  var year=today.split("-")[0];
  
  var origin_option=$("#year_code option:last-child").val();
  var origin_opt=Number($("#year_code option:last-child").text());
  net_year=year-origin_opt;
  for (let index = 1; index <= net_year; index++) {
      var set_opt=$("<option>").attr({value:Number(origin_option)+index}).text(origin_opt+index)
      $("#year_code,#name_serach_year").append(set_opt);
  }
  $("#year_code option:last-child()").prop("selected",true);
  $("#agem,#agey").prop("disabled",true);
  
// Date to text -----> ext to Date Section


  $(".dateimg").click(function(event) {
    dateCalender();
  });
  $(".Gdate").change(function(){
    dateformatValid();
  })

  $(".date-verify").blur(function(){
    var varifydate=$(this).val();
    var date = new Date();
    var day = date.getDate();
    var month = date.getMonth() + 1;
    var year = date.getFullYear();
    var confirmDate= varifydate.split(/[-\/]/);
    var day_input   = confirmDate[0];
    var month_input = confirmDate[1];
    var year_input  = confirmDate[2];
    if(year_input >=  year){
      if(year_input > year){
        alert("Input Year is greater than current Year.");
        $(this).val(todayIn)
      }
      if(year_input == year){
        if(month_input > month){
          alert("Input Month is greater than current Month.");
          $(this).val(todayIn)
        }
      }
      if(month_input == month){
        if(day_input > day){
          alert("Input Day is greater than current Day.");
          $(this).val(todayIn)
        }
      }
    }else{
      if(year_input < 2009){
        alert("Date input is less than 2009");
        $(this).val(todayIn)
      }
    }

  })
 
 
  // Click Section
  $(".reception-serach,.s-t-update").click(function() {
    console.log("click reception")
   
    setTimeout(function() {
      DateTo_text();
  }, 50);
  });
  $("#nextID,#hts-search").click(function() {
    console.log("click reception")
   
    setTimeout(function() {
      DateTo_text();
  }, 50);
  });

  $("#pid-search").click(function() {  //sti_search
    console.log("click reception")
   
    setTimeout(function() {
      DateTo_text();
  }, 50);
  });

  $(".counGeneral div:nth-child(2)").click(function() { //counselling
    setTimeout(function() {
      DateTo_text();
  }, 50);
  });

  $("#cid").blur(function() {     // For lab date
    setTimeout(function() {
      DateTo_text();
  }, 50);
  });
  $("#fuchiaID").blur(function() {     // For lab date
    setTimeout(function() {
      DateTo_text();
  }, 50);
  });

  $('table tbody').on('click', 'tr td a', function() {
    console.log("click reception")
   
    setTimeout(function() {
      DateTo_text();
  }, 100);
  });
  $('input[type="text"').on('change',function(){
    let inputid=event.target.id;
    let input_length=$("#"+inputid).val().length;
    if(input_length>255){
      alert("Your Input is too much,please insert 100 character max")
      $("#"+inputid).val("").focus();
    }
  })

  

});
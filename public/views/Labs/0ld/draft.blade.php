function rprUpdate(){
  var cid = $("#cid").val();
  var agey = $("#agey").text();
  var agem = $("#agem").text();
  var gender = $("#gender").text();
  var fuchiaID = $("#fuchiaID").val();
  var clinic = 81;
  var vDate = $("#vDate").val();
  var Ptype = $("#Ptype").text();
  var ext_sub = $("#ext").text();
  var reqDoctor = $("#md").val();
  agey = parseInt(agey);//changing to number
  //agem = parseInt(agem);
  gender= String(gender);
  var rdtYes_no = $("#rdtYes_no").val();
  var Sy_rdt_result = $("#Sy_rdt_result").val();
  var rprYes_NO = $("#rprYes-NO").val();
  var qualitative = $("#qualitative").val();
  var titreCur = $("#titreCur").val();
  var lastTireDate = $('#lastTitreDate').val();
  var titreLast = $("#titreLast").val();

  var lab_tech_rpr = $("#rpr_lab_tech").val();
  var rpr_issue_date = $("#rpr_issue_date").val();
  var rpr_counselor = $("#rpr_counselor").val();
  var reqDoctor = $("#md").val();
  var rpr_counselor = $("#rpr_counselor").val();
  var comment = $("#rprComment").val();

                if(save_update==2){
                  update_rowNo= resp[1][rowNo]['id'];
                  var rprTest=2;
                  var appUser = document.getElementById("app-User").innerHTML;
                  var org_info = 'RowID->'+resp[1][rowNo]['id']
                  +',FuchiaID->' +resp[1][rowNo]["fuchiacode"]
                  + ',GeneralID->' +resp[1][rowNo]["pid"]
                  + ',Age(year)->' +resp[1][rowNo]["agey"]
                  + ',Age(mo)->' +resp[1][rowNo]["agem"]
                  + ',Gender->' +resp[1][rowNo]["Gender"]
                  + ',Visit Date->' +resp[1][rowNo]["visit_date"]
                  + ',Risk->' +resp[1][rowNo]['Type Of Patient']
                  + ',Sub risk->' +resp[1][rowNo]['Patient Type Sub']
                  + ',RPR Qualitative->' +resp[1][rowNo]['RPR Qualitative']
                  + ',RDT(Yes/NO)->' +resp[1][rowNo]['RDT(Yes/No)']
                  + ',RDT Result->' +resp[1][rowNo]['RDT Result']
                  + ',Quantative(Yes/No)->' +resp[1][rowNo]['Quantitative(Yes/No)']
                  + ',Qualitative(Yes/No)->' +resp[1][rowNo]['Qualitative(Yes/No)']
                  + ',Titre(Cur)->' +resp[1][rowNo]['Titre(current)']
                  + ',Titre(Last)->' +resp[1][rowNo]['Titre(Last)'];


                  var updated_info =
                  'FuchiaID->'+fuchiaID +
                  ',GeneralID->'+cid+
                  ',Age(year)->'+agey+
                  ',Age(mo)->'+agem+
                  ',Gender->'+gender+
                  ',Visit Date->'+vDate+
                  ',Risk->'+Ptype+
                  ',Sub Risk->'+ext_sub+
                  ',MD ->'+reqDoctor+
                  ',RPR_Yes_No->'+rprYes_NO+
                  ',RDT Yes_NO->'+rdtYes_no+
                  ',Syphillis RDT Result->'+Sy_rdt_result+
                  ',Qualitative->'+qualitative+
                  ',Titre Current->'+titreCur+
                  ',Titre Last->'+titreLast;
                    var rprDataset = {
                    updated_info:updated_info,
                    org_info:org_info,
                    appUser:appUser,
                    update_rowNo:update_rowNo,

                    rprTest:rprTest,
                    cid:cid,
                    fuchiaID:fuchiaID,
                    vDate:vDate,
                    Ptype:Ptype,
                    ext_sub:ext_sub,
                    agey:agey,
                    agem:agem,
                    gender:gender,
                    clinic:clinic,

                    rdtYes_no:rdtYes_no,
                    Sy_rdt_result:Sy_rdt_result,
                    rprYes_NO:rprYes_NO,
                    qualitative:qualitative,
                    titreCur:titreCur,
                    titreLast:titreLast,
                    lastTireDate:lastTireDate,

                    lab_tech_rpr:lab_tech_rpr,
                    reqDoctor:reqDoctor,
                    rpr_counselor:rpr_counselor,
                    rpr_issue_date:rpr_issue_date,
                    comment:comment,
                    };
                }

                if(cid.length >8 && lab_tech_rpr.length >0){
                  $.ajaxSetup({
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                             }
                           });
                  $.ajax({
                      type:'POST',
                      url:"{{route('tests')}}",
                      dataType:'json',
                      //processData:false,
                      contentType: 'application/json',
                      data: JSON.stringify(rprDataset),
                      //data: rprDataset,
                      success:function(response){
                              $("#app").hide();
                              $("#hider0").hide();
                              $("#hider1").hide();
                              $("#save-update-print").hide();
                              $( "#toshowResult" ).removeClass( "print-dispaly" );
                  if(reqDoctor==null){
                    reqDoctor= "__________";
                  };

                  if (rpr_counselor.length <1){
                    rpr_counselor="____";
                  };

                  if (lab_tech.length <1){
                    lab_tech="_______";
                  };

                  if (rpr_issue_date  <1){
                    rpr_issue_date ="_______";
                  };

                  if(fuchiaID.length < 1){
                    fuchiaID = "__________"
                  };

                  if(Number.isNaN(agey))  {
                     var ageys= "____";
                  }else {
                    var ageys=agey;
                  };

                  if(agem.length < 1){
                     var agems="__";
                    }else {
                       var agems=agem;
                  };
                  if (qualitative == null) {
                    qualitative = ' ';
                  };
                  if (titreCur== null) {
                    titreCur= ' ';
                  }
                  if (titreLast==null) {
                    titreLast = ' ';
                  }


                              var result_title=
                              "<div class='d-flex justify-content-center print-coheader-list'>"+
                                "<ul class='clearfix' style='width:84%;padding-left: 5%;'>"+
                                "<li class='first-li'>"+"ID:"+"</li>"+"<li>"+cid+","+"</li>"+
                                "<li class='first-li'>"+"Fuchia ID:"+"</li>"+"<li>"+fuchiaID+","+"</li>"+
                                // "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
                                "<li class='first-li'>"+"Date:"+"</li>"+"<li>"+vDate+","+"</li>"+
                                // "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
                                "<li class='first-li'>"+"Age(Y):"+"</li>"+"<li>"+ageys+","+"</li>"+
                                // "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
                                "<li class='first-li'>"+"Age(M):"+"</li>"+"<li>"+agems+","+"</li>"+
                                // "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
                                "<li class='first-li'>"+"Sex:"+"</li>"+"<li>"+gender+","+"</li>"+
                                "</ul>"+
                              "</div>";
                              var logo =
                                        "<div class='row'>"+
                                          "<div class='d-flex justify-content-center' >"+
                                            "<h4  class='print-header clearfix'>"+  "<img src='/logoMAM.jpg'  alt='logo' style='width:70px;height:70px;'>"+
                                            "<p class='hiv-p'>"+"RPR Test Result (Updated)"+"</p>"+"</h4>"+
                                          "</div>"+
                                        "</div>";
                              var result_footer=
                              "<div class='print-hiv-footer'>"
                              +"<ul class='clearfix'>"+
                                  "<li class='first-li'>"
                                  +"Requested Doctor:"+"</li>"+"<li>"+reqDoctor+","+"</li>"
                                  +
                                  "<li class='first-li'>"
                                  +"Counselor:"+"</li>"+"<li>"+rpr_counselor+","+"</li>"
                                  +
                                  // "Counselor ::"+counselor+
                                  "<li>"
                                  +"Issue by-:"+"</li>"+"<li>"+lab_tech_rpr+","+"</li>"

                                  // "Issue by- "+lab_tech+
                                  +
                                  "<li>"
                                  +"Issue Date :"+"</li>"+"<li>"+rpr_issue_date+","+"</li>"
                                  +
                                  // "Issue Date :"+issue_date+
                              "</div>";
                              if(Sy_rdt_result.length < 1){
                                Sy_rdt_result = "Not Done";
                              }
                              if(qualitative.length < 1){
                                qualitative = "Not Done";
                              }
                            var result_body = "<br>"+"<div class='d-flex justify-content-center'>"+"<table class='table print-hiv-table'>"+
                                "<thead>"+
                                    "<tr>"+"<td>"+"NO."+ "<td>"+"Test Name"+"</td>"+"<td>"+"Result"+"</td>"+"</tr>"+
                                "</thead>"
                                +
                                "<tbody>"+
                                    "<tr>"+"<td>"+"1"+"</td>"+"<td>"+"Syphillis RDT Result"+"</td>"+"<td>"+Sy_rdt_result+"</td>"+"</tr>"+
                                    "<tr>"+"<td>"+"2"+"</td>"+"<td>"+"RPR Result"+"</td>"+"<td>"+qualitative+"</td>"+"</tr>"+
                                    "<tr>"+"<td>"+"3"+"</td>"+"<td>"+"Titre(Current)"+"</td>"+"<td>"+titreCur+"</td>"+"</tr>"+
                                    "<tr>"+"<td>"+""+"</td>"+"<td>"+"Titre(Last)"+"</td>"+"<td>"+titreLast+"</td>"+"</tr>"+
                                  //"<tr>"+"<td>"+"Comment"+"</td>"+"<td>"+comment+"</td>"+"<td>"+""+"</td>"+"</tr>"+
                              "</tbody>"+
                            "</table>"+"</div>";
                            $("#printLogo").append(logo);
                            $("#printPtInfo").append(result_title);
                            $("#printResultTable").append(result_body+result_footer);
                            $("#header_bar").hide();
                            $("#print")
                            window.print();
                            var ckUpdater = response[0][0]['name'];
                            if(ckUpdater == 'updated')
                            {
                              alert("We have updated the data");
                            }
                            else{
                              alert("We have collected test information of the patient.");
                            }
                            location.reload(true);// to refresh the page

                      }
                     });
                   }else{
                     $("#noti").show();
                     document.getElementById('noti').innerHTML="Please input data first";
                   }
            }

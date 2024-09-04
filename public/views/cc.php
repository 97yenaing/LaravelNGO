<script type="text/javascript">
function rpr_save(){

          var cid = document.getElementById("cid").value;
          var agey = document.getElementById("agey").value;
          var agem = document.getElementById("agem").value;
          var gender = document.getElementById("gender").value;
          var fuchiaID = document.getElementById("fuchiaID").value;
          var clinic = document.getElementById("clinic").innerHTML;
          var vDate = document.getElementById("vDate").value;
          var Ptype = document.getElementById("Ptype").value;
          Ptype_ext= Ptype_sub;
          var reqDoctor = document.getElementById("md").value;
          agey = parseInt(agey);//changing to number
          //agem = parseInt(agem);
          gender= String(gender);
          let rprYes_NO = document.getElementById("rprYes-NO").value;
          let rdtYes_no = document.getElementById("rdtYes_no").value;
          let Sy_rdt_result = document.getElementById("Sy_rdt_result").value;
          let qualitative = document.getElementById("qualitative").value;

          let titreCur = document.getElementById("titreCur").value;
          let titreLast = document.getElementById("titreLast").value;
          let lab_tech_rpr = document.getElementById("lab_tech_rpr").value;
          let rpr_issue_date = document.getElementById("rpr_issue_date").value;
          let comment = document.getElementById("rprComment").value;

          update_rowNo= resp[1][rowNo]['id'];

          if(save_update == 2){// Update Section
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
            ',Sub Risk->'+Ptype_ext+
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
              Ptype_ext:Ptype_ext,
              agey:agey,
              agem:agem,
              gender:gender,
              reqDoctor:reqDoctor,
              clinic:clinic,
              rprYes_NO:rprYes_NO,
              rdtYes_no:rdtYes_no,
              Sy_rdt_result:Sy_rdt_result,
              qualitative:qualitative,
              titreCur:titreCur,
              titreLast:titreLast,
              lab_tech_rpr:lab_tech_rpr,
              rpr_issue_date:rpr_issue_date,
              comment:comment
            };

          }else{
            var rprTest=1;
            var rprDataset = {
              rprTest:rprTest,
              cid:cid,
              fuchiaID:fuchiaID,
              vDate:vDate,
              Ptype:Ptype,
              Ptype_ext:Ptype_ext,
              agey:agey,
              agem:agem,
              gender:gender,
              reqDoctor:reqDoctor,
              clinic:clinic,
              rprYes_NO:rprYes_NO,
              rdtYes_no:rdtYes_no,
              Sy_rdt_result:Sy_rdt_result,
              qualitative:qualitative,

              titreCur:titreCur,
              titreLast:titreLast,
              lab_tech_rpr:lab_tech_rpr,
              bcdate:bcdate
            };
          }


          if(cid.length >8 && Sy_rdt_result.length >0){

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

                  if (response != null) {
                    alert("You have collected test information of the patient.");
                      $("#hider0").hide();
                      $("#hider1").hide();

                      if(isNaN(agem)){
                        agem=0;
                      }
                      var logo ="<img src='{{asset('img/logoMAM.jpg')}}'style='width:70px;height:70px;float:left;'>"+
                                "<h1 style='padding-left:130px;float:left;'>"+"Laboratory"+"</h1>"+"<br>"+"<br>"+
                                "<h1 style='padding-left:100px;float:left;'>"+"RPR Test Result"+"</h1>";
                      var result_title= "<span style='padding-left:5px;float:left;'>"+"ID ::"+cid+
                      "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+"Fuchia ID::"+fuchiaID+
                      "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+"Date::"+vDate+"</span>"+
                                        "<span style='padding-left:5px;float:left;'>"+"Age(Y)::"+agey+
                                        "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+"Age(M)::"+agem+
                                        "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+"Gender::"+gender+"</span>";
                      var result_header ="<span style='padding-left:5px;float:left;'>"+"Requested Doctor::"+reqDoctor+
                                        "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
                                        "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" +"Counselor ::"+counselor+"</span>";
                    var result_body = "<br>"+"<table class='table table-bordered'>"+
                        "<thead>"+
                            "<tr>" +"<td>"+"Test Name"+"</td>"+"<td>"+"Result"+"</td>"+"</tr>"+
                        "</thead>"
                        +
                        "<tbody>"+
                            "<tr>"+"<td>"+"Syphillis RDT Result"+"</td>"+"<td>"+Sy_rdt_result+"</td>"+"</tr>"+

                            "<tr>"+"<td>"+"Titre(Current)"+"</td>"+"<td>"+titreCur+"</td>"+"</tr>"+
                            "<tr>"+"<td>"+"Titre(Last)"+"</td>"+"<td>"+titreLast+"</td>"+"</tr>"+
                          //"<tr>"+"<td>"+"Comment"+"</td>"+"<td>"+comment+"</td>"+"<td>"+""+"</td>"+"</tr>"+
                      "</tbody>"+
                    "</table>" ;

                    var result_footer="<span style='padding-left:5px;'>"+"Issue by- "+lab_tech_rpr+
                    "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
                    "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
                       "Issue Date :"+rpr_issue_date+ "</span>";
                    //$("#toshowResult").append(printTable);
                    $("#printLogo").append(logo);
                    //$("#printTestTitle").append(TestTitle);
                    $("#printPtInfo").append(result_title+result_header);
                    $("#printResultTable").append(result_body+result_footer);


                  //  $("#toshowResult").append(hivResultForm);
                    $("#header_bar").hide();
                    window.print();
                    $("#toshowResult").hide();
                    $("#header_bar").show();
                    $("#hider0").show();
                    $("#hider1").show();
                    location.reload(true);// to refresh the page
                  }
                }
               });
             }else{
               $("#noti").show();
               document.getElementById('noti').innerHTML="Please input data first";
             }
      }
function sti_save(){
        if(save_update == 3){
          let stiTest = 2;
        }else{
          let stiTest = 1;
        }

          var cid = document.getElementById("cid").value;
          var agey = document.getElementById("agey").value;
          var agem = document.getElementById("agem").value;
          var gender = document.getElementById("gender").value;
          var fuchiaID = document.getElementById("fuchiaID").value;
          var clinic = document.getElementById("clinic").innerHTML;
          var vDate = document.getElementById("vDate").value;
          var Ptype = document.getElementById("Ptype").value;
          var ext_sub = Ptype_sub;
          var reqDoctor = document.getElementById("md").value;
          agey = parseInt(agey);//changing to number
          agem = parseInt(agem);
          gender= String(gender);
          var bcdate = document.getElementById("bcdate").value;

          let  clue_cells= document.getElementById("clue_cells").value;
          let  clue_post_fornix= document.getElementById("clue_post_fornix").value;
          let  clue_cell_result= document.getElementById("clue_cell_result").value;
          let  pmnl_urethra= document.getElementById("pmnl_urethra").value;
          let  pmnl_post_fix= document.getElementById("pmnl_post_fix").value;
          let  pmnl_endocevix= document.getElementById("pmnl_endocevix").value;
          let  pmnl_rectum= document.getElementById("pmnl_rectum").value;
          let  pmnl_cell_result= document.getElementById("pmnl_cell_result").value;
          let  tricho_wet= document.getElementById("tricho_wet").value;
          let  tricho_result= document.getElementById("tricho_result").value;
               tricho_result = parseInt(tricho_result);//changing to number
          let  gram_intra_urethra= document.getElementById("gram_intra_urethra").value;
          let  gram_intra_postfornix= document.getElementById("gram_intra_postfornix").value;
          let  gram_intra_endo= document.getElementById("gram_intra_endo").value;
          let  gram_intra_rectum = document.getElementById("gram_intra_rectum").value;
          let  gram_intra_result= document.getElementById("gram_intra_result").value;
               gram_intra_result = parseInt(gram_intra_result);
          let  gram_extra_urethra= document.getElementById("gram_extra_urethra").value;
          let  gram_extra_postfornix= document.getElementById("gram_extra_postfornix").value;
          let  gram_extra_endo= document.getElementById("gram_extra_endo").value;
          let  gram_extra_rectum= document.getElementById("gram_extra_rectum").value;
          let  gram_extra_result= document.getElementById("gram_extra_result").value;
               gram_extra_result = parseInt(gram_extra_result);
          let  candida_wet= document.getElementById("candida_wet").value;
          let  candida_urethra= document.getElementById("candida_urethra").value;
          let  candida_postfornix= document.getElementById("candida_postfornix").value;
          let  candida_endo= document.getElementById("candida_endo").value;
          let  candida_result= document.getElementById("candida_result").value;
               candida_result = parseInt(candida_result);

          let  Sper_other_wet= document.getElementById("Sper_other_wet").value;
          let  Sper_other_urethra= document.getElementById("Sper_other_urethra").value;
          let  Sper_other_post= document.getElementById("Sper_other_post").value;
          let  Sper_other_endo= document.getElementById("Sper_other_endo").value;
          let  Sper_other_rectum= document.getElementById("Sper_other_rectum").value;

          let  urine_exam_done= document.getElementById("urine_exam_done").value;
          let  epithelial_cell= document.getElementById("epithelial_cell").value;
          let  intra_cell= document.getElementById("intra_cell").value;
          let  pmnl_cell= document.getElementById("pmnl_cell").value;
          let  extra_cell= document.getElementById("extra_cell").value;
          let  sti_lab_tech= document.getElementById("sti_lab_tech").value;
          let  sti_issuDate= document.getElementById("sti_issueDate").value;
          let  oth_bact= document.getElementById("other_baceria").value;

          let stiDataset = {
             stiTest : stiTest,
             cid:cid,
             fuchiaID:fuchiaID,
             agey:agey,
             agem:agem,
             gender:gender,
             vDate:vDate,
             Ptype:Ptype,
             ext_sub:ext_sub,
             reqDoctor:reqDoctor,
             clinic:clinic,
             bcdate:bcdate,

              clue_cells:clue_cells,
              clue_post_fornix:clue_post_fornix,
              clue_cell_result:clue_cell_result,
              pmnl_urethra:pmnl_urethra,
              pmnl_post_fix:pmnl_post_fix,
              pmnl_endocevix:pmnl_endocevix,
              pmnl_rectum:pmnl_rectum,
              pmnl_cell_result:pmnl_cell_result,
              tricho_wet:tricho_wet,
              tricho_result:tricho_result,
              gram_intra_urethra:gram_intra_urethra,
              gram_intra_postfornix:gram_intra_postfornix,
              gram_intra_endo:gram_intra_endo,
              gram_intra_rectum :gram_intra_rectum,
              gram_intra_result:gram_intra_result,
              gram_extra_urethra:gram_extra_urethra,
              gram_extra_postfornix:gram_extra_postfornix,
              gram_extra_endo:gram_extra_endo,
              gram_extra_rectum:gram_extra_rectum,
              gram_extra_result:gram_extra_result,
              candida_wet:candida_wet,
              candida_urethra:candida_urethra,
              candida_postfornix:candida_postfornix,
              candida_endo:candida_endo,
              candida_result:candida_result,
              Sper_other_wet:Sper_other_wet,
              Sper_other_urethra:Sper_other_urethra,
              Sper_other_post:Sper_other_post,
              Sper_other_endo:Sper_other_endo,
              Sper_other_rectum:Sper_other_rectum,
              urine_exam_done:urine_exam_done,
              epithelial_cell:epithelial_cell,
              intra_cell:intra_cell,
              pmnl_cell:pmnl_cell,
              extra_cell:extra_cell,
              sti_lab_tech:sti_lab_tech,
              sti_issuDate:sti_issuDate,
              oth_bact:oth_bact,
              };
          if(cid.length >8 ){
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
               data: JSON.stringify(stiDataset),
                //data: rprDataset,
                success:function(response){
                    alert("You have collected test information of the patient.");
                      $("#hider0").hide();
                      $("#hider1").hide();
                    //results
                    var  clue_result= document.getElementById("clue_cell_result").value;
                    var  pmnl_result= document.getElementById("pmnl_cell_result").value;
                    var  triresult= document.getElementById("tricho_result").value;
                    var  gram_result= document.getElementById("gram_intra_result").value;
                    var  gram_ex_result= document.getElementById("gram_extra_result").value;
                    var  can_result= document.getElementById("candida_result").value;

                    if(clue_cells=="1"){
                      clue_cells = "Positive";
                    }else{clue_cells = "Negative";}

                    if(pmnl_result=="1"){
                      pmnl_result = "Positive";
                    }else{pmnl_result = "Negative";}

                    if(triresult=="1"){
                      triresult = "Positive";
                    }else{triresult = "Negative";}

                    if(gram_result=="1"){
                      gram_result = "Positive";
                    }else{gram_result = "Negative";}

                    if(gram_ex_result=="1"){
                      gram_ex_result = "Positive";
                    }else{gram_ex_result = "Negative";}

                    if(can_result=="1"){
                      can_result = "Positive";
                    }else{can_result= "Negative";}

                    if(isNaN(agem)){
                      agem=0;
                    }
                    var logo ="<img src='{{asset('img/logoMAM.jpg')}}'style='width:70px;height:70px;float:left;'>"+
                              "<h1 style='padding-left:130px;float:left;'>"+"Laboratory"+"</h1>"+"<br>"+"<br>"+
                              "<h1 style='padding-left:100px;float:left;'>"+"STI Test Result"+"</h1>";
                    var result_title= "<span style='padding-left:5px;float:left;'>"+"ID ::"+cid+
                    "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+"Fuchia ID::"+fuchiaID+
                    "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+"Date::"+vDate+"</span>"+
                                      "<span style='padding-left:5px;float:left;'>"+"Age(Y)::"+agey+
                                      "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+"Age(M)::"+agem+
                                      "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+"Gender::"+gender+"</span>";
                    var result_header ="<span style='padding-left:5px;float:left;'>"+"Requested Doctor::"+reqDoctor+
                                      "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
                                      "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" +"Counselor ::"+counselor+"</span>";
                    var result_body = "<br>"+"<table class='table table-sm'>"+
                        "<thead>"+
                            "<tr>"
                                  +"<th style='width:90px;'>"+""+"</th>"
                                  +"<th>"+"Wet Mount"+"</th>"
                                  +"<th>"+""+"</th>"
                                  +"<th>"+"Gram Stain"+"</th>"
                                  +"<th>"+""+"</th>"
                                  +"<th>"+""+"</th>"
                                  +"<th>"+""+"</th>"
                            +"</tr>"+
                            "<tr>"
                                  +"<td>"+"Test Name"+"</td>"
                                  +"<td>"+"Wet Mount"+"</td>"
                                  +"<td>"+"Urethra"+"</td>"
                                  +"<td>"+"Post, fornix"+"</td>"
                                  +"<td>"+"Endo cervix"+"</td>"
                                  +"<td>"+"Rectum"+"</td>"
                                  +"<td>"+"Result"+"</td>"
                            +"</tr>"+
                        "</thead>"
                        +
                        "<tbody>"
                            +"<tr>"
                              +"<td>"+"Clue Cells %"+"</td>"
                              +"<td>"+clue_cells+"</td>"
                              +"<td>"+""+"</td>"
                              +"<td>"+clue_post_fornix+"</td>"
                              +"<td>"+""+"</td>"
                              +"<td>"+""+"</td>"
                              +"<td>"+clue_result+"</td>"
                            +"</tr>"+
                            "<tr>"+
                            "<td>"+"PMNL cells/HPF"+"</td>"
                              +"<td>"+""+"</td>"
                              +"<td>"+pmnl_urethra+"</td>"
                              +"<td>"+pmnl_post_fix+"</td>"
                              +"<td>"+pmnl_endocevix+"</td>"
                              +"<td>"+pmnl_rectum+"</td>"
                              +"<td>"+pmnl_result+"</td>"
                            +"</tr>"+
                            "<tr>"
                              +"<td>"+"Trichomonas"+"</td>"
                              +"<td>"+tricho_wet+"</td>"
                              +"<td>"+"</td>"
                              +"<td>"+"</td>"
                              +"<td>"+"</td>"
                              +"<td>"+"</td>"
                              +"<td>"+triresult+"</td>"+
                            "</tr>"+
                            "<tr>"
                            +"<td>"+"Gram(-) diplococci intra-cell"+"</td>"
                              +"<td>"+"</td>"
                              +"<td>"+gram_intra_urethra+"</td>"
                              +"<td>"+gram_intra_postfornix+"</td>"
                              +"<td>"+gram_intra_endo+"</td>"
                              +"<td>"+gram_intra_rectum+"</td>"
                              +"<td>"+gram_result+"</td>"
                            +"</tr>"+
                            "<tr>"
                              +"<td>"+"Gram(-) diplococci extra-cell"+"</td>"
                                +"<td>"+"</td>"
                                +"<td>"+gram_extra_urethra+"</td>"
                                +"<td>"+gram_extra_postfornix+"</td>"
                                +"<td>"+gram_extra_endo+"</td>"
                                +"<td>"+gram_extra_rectum+"</td>"
                                +"<td>"+gram_ex_result+"</td>"
                              +"</tr>"+
                            "<tr>"
                                +"<td>"+"Candida"+"</td>"
                                +"<td>"+candida_wet+"</td>"
                                +"<td>"+candida_urethra+"</td>"
                                +"<td>"+candida_postfornix+"</td>"
                                +"<td>"+candida_endo+"</td>"
                                +"<td>"+"</td>"
                                +"<td>"+can_result+"</td>"
                            +"</tr>"+
                            "<tr>"
                              +"<td>"+"Supermatozoites,RBCs,others:"+"</td>"
                                +"<td>"+Sper_other_wet+"</td>"
                                +"<td>"+Sper_other_urethra+"</td>"
                                +"<td>"+Sper_other_post+"</td>"
                                +"<td>"+Sper_other_endo+"</td>"
                                +"<td>"+Sper_other_rectum+"</td>"
                                +"<td>"+"</td>"
                              +"</tr>"+
                            "<tr>"
                              +"<td>"+"Urine exam (FPU)"+"</td>"
                                +"<td>"+urine_exam_done+"</td>"
                                +"<td>"+"</td>"
                                +"<td>"+"Epithelial cells"+"</td>"
                                +"<td>"+epithelial_cell+"</td>"
                              +"</tr>"+
                            "<tr>"
                              +"<td>"+"Gram(-) diplocci intra-cell"+"</td>"
                                +"<td>"+intra_cell+"</td>"
                                +"<td>"+""+"</td>"
                                +"<td>"+"PMNL cells"+"</td>"
                                +"<td>"+pmnl_cell+"</td>"
                              +"</tr>"+
                            "<tr>"
                              +"<td>"+"Gram(-) diplocci extra-cell"+"</td>"
                                +"<td>"+extra_cell+"</td>"
                                +"<td>"+""+"</td>"
                                +"<td>"+""+"</td>"
                              +"</tr>"+
                            "<tr>"
                              +"<td>"+"Other bacteria(Gram Stain)"+"</td>"
                                +"<td>"+oth_bact+"</td>"
                                +"<td>"+""+"</td>"
                                +"<td>"+""+"</td>"
                              +"</tr>"+
                            "<tr>"
                                +"<td>"+"Lab Technician"+"</td>"
                                +"<td>"+sti_lab_tech+"</td>"
                                +"<td>"+""+"</td>"
                                +"<td>"+""+"</td>"
                            +"</tr>"+
                            "<tr>"
                                +"<td>"+"Issue Date"+"</td>"
                                +"<td>"+sti_issuDate+"</td>"
                                +"<td>"+""+"</td>"
                                +"<td>"+""+"</td>"
                            +"</tr>"+
                          //  "<tr>"+"<td>"+"PMNL cells"+"</td>"+"<td>"+comment+"</td>"+"<td>"+""+"</td>"+"</tr>"+
                      "</tbody>"+
                    "</table>" ;
                    var result_footer="<span style='padding-left:5px;'>"+"Issue by- "+sti_lab_tech+
                    "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
                    "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
                       "Issue Date :"+sti_issuDate+ "</span>";
                    //$("#toshowResult").append(printTable);
                    $("#printLogo").append(logo);
                    //$("#printTestTitle").append(TestTitle);
                    $("#printPtInfo").append(result_title+result_header);
                    $("#printResultTable").append(result_body+result_footer);


                  //  $("#toshowResult").append(hivResultForm);
                    $("#header_bar").hide();
                    window.print();
                    $("#toshowResult").hide();
                    $("#header_bar").show();
                    $("#hider0").show();
                    $("#hider1").show();
                    location.reload(true);// to refresh the page

                }
               });
             }else{
               $("#noti").show();
               document.getElementById('noti').innerHTML="Please input data first";
             }
      }
function hbcSave(){


        var cid = document.getElementById("cid").value;
        var agey = document.getElementById("agey").value;
        var agem = document.getElementById("agem").value;
        var gender = document.getElementById("gender").value;
        var fuchiaID = document.getElementById("fuchiaID").value;
        var clinic = document.getElementById("clinic").innerHTML;
        var vDate = document.getElementById("vDate").value;
        var Ptype = document.getElementById("Ptype").value;
        var ext_sub = Ptype_sub;
        var reqDoctor = document.getElementById("md").value;
        agey = parseInt(agey);//changing to number
        agem = parseInt(agem);
        gender= String(gender);
        var bcdate = document.getElementById("bcdate").value;

        var hepB = document.getElementById("hepB").value;

        var b_result = document.getElementById("B_result").value;
        var c_test = document.getElementById("c_test").value;

        var c_result = document.getElementById("c_result").value;
        var c_lab_tech = document.getElementById("C_lab_tech").value;
        var c_issueDate = document.getElementById("C_issueDate").value;

        update_rowNo= resp[3][rowNo]['id'];

        if(save_update == 4){ // Updata Section
          var hbc = 2;
          var appUser = document.getElementById("app-User").innerHTML;


          var org_info = 'RowID->'+resp[3][rowNo]['id']
          +',FuchiaID->' +resp[3][rowNo]["fuchiacode"]
          + ',GeneralID->' +resp[3][rowNo]["CID"]
          + ',Age(year)->' +resp[3][rowNo]["agey"]
          + ',Age(mo)->' +resp[3][rowNo]["agem"]
          + ',Gender->' +resp[3][rowNo]["Gender"]
          + ',Visit Date->' +resp[3][rowNo]["Visit_date"]
          + ',Risk->' +resp[3][rowNo]['Patient_Type']
          + ',Sub risk->' +resp[3][rowNo]['Patient Type Sub']
          + ',Hiv Status->' +resp[3][rowNo]['Hiv status']
          + ',Hep B Test->' +resp[3][rowNo]['Hep B Test']
          + ',Hep C Test->' +resp[3][rowNo]['HepC Test']
          + ',Lab Tech->' +resp[3][rowNo]['Lab Tech']
          + ',Issue Date->' +resp[3][rowNo]['Issue Date'];


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
          ',Hep B Test->'+hepB+
          ',Hep B Result->'+b_result+
          ',Hep C Test->'+c_test+
          ',Hep C Result->'+c_result+
          ',Lab Tech'+c_lab_tech+
          ',Issue Date'+c_issueDate;




          var hbcdata={
                    updated_info:updated_info,
                    org_info:org_info,
                    appUser:appUser,
                    update_rowNo:update_rowNo,

                     hbc:hbc,
                     cid:cid,
                     fuchiaID:fuchiaID,
                     agey:agey,
                     agem:agem,
                     gender:gender,
                     vDate:vDate,
                     Ptype:Ptype,
                     ext_sub:ext_sub,
                     reqDoctor:reqDoctor,
                     clinic:clinic,
                     bcdate:bcdate,
                     hepB:hepB,

                     b_result:b_result,
                     c_test:c_test,

                     c_result:c_result,
                     c_lab_tech:c_lab_tech,
                     c_issueDate:c_issueDate
                   };
        }else{
          var hbc = 1;
          var hbcdata={
                     hbc:hbc,
                     cid:cid,
                     fuchiaID:fuchiaID,
                     agey:agey,
                     agem:agem,
                     gender:gender,
                     vDate:vDate,
                     Ptype:Ptype,
                     ext_sub:ext_sub,
                     reqDoctor:reqDoctor,
                     clinic:clinic,
                     bcdate:bcdate,
                     hepB:hepB,

                     b_result:b_result,
                     c_test:c_test,

                     c_result:c_result,
                     c_lab_tech:c_lab_tech,
                     c_issueDate:c_issueDate
                   };
        }

          if(cid.length >8  && c_result.length >0 || b_result.length >0 ){
            alert("arrived here");
              $.ajaxSetup({
                 headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                 }
               });
              $.ajax({
                       type:'POST',
                       url:"{{route('tests')}}",
                       dataType:'json',
                     //  processData:false,
                       contentType: 'application/json',
                       data: JSON.stringify(hbcdata),
                       success:function(response){

                              if (response) {
                                alert("You have collected test information of the patient.");
                                  $("#hider0").hide();
                                  $("#hider1").hide();
                                if(isNaN(agem)){
                                  agem=0;
                                }
                                var logo ="<img src='{{asset('img/logoMAM.jpg')}}'style='width:70px;height:70px;float:left;'>"+
                                          "<h1 style='padding-left:130px;float:left;'>"+"Laboratory"+"</h1>"+"<br>"+"<br>"+
                                          "<h1 style='padding-left:100px;float:left;'>"+"HBC Test Result"+"</h1>";
                                var result_title= "<span style='padding-left:5px;float:left;'>"+"ID ::"+cid+
                                "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+"Fuchia ID::"+fuchiaID+
                                "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+"Date::"+vDate+"</span>"+
                                                  "<span style='padding-left:5px;float:left;'>"+"Age(Y)::"+agey+
                                                  "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+"Age(M)::"+agem+
                                                  "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+"Gender::"+gender+"</span>";
                                var result_header ="<span style='padding-left:5px;float:left;'>"+"Requested Doctor::"+reqDoctor+
                                                  "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
                                                  "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" +"Counselor ::"+counselor+"</span>";
                                var result_body = "<br>"+"<table class='table table-sm'>"+
                                    "<thead>"+
                                        "<tr>" +"<td>"+"Test Name"+"</td>"+"<td>"+"Type Of Test"+"</td>"+"<td>"+"Result"+"</td>"+"<td>"+"Remark"+"</td>"+"</tr>"+
                                    "</thead>"+
                                    "<tbody>"+
                                        "<tr>"+"<td>"+"Hepatitis B"+"</td>"+"<td>"+"Ag(RDT)"+"</td>"+"<td>"+b_result+"</td>"+"<td>"+""+"</td>"+"</tr>"+
                                        "<tr>"+"<td>"+"Hepatitis C"+"</td>"+"<td>"+"Ab(RDT)"+"</td>"+"<td>"+c_result+"</td>"+"<td>"+""+"</td>"+"</tr>"+
                                  "</tbody>"+
                                "</table>" ;

                                var result_footer="<span style='padding-left:5px;'>"+"Issue by- "+c_lab_tech+
                                "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
                                "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
                                   "Issue Date :"+c_issueDate+ "</span>";
                                   //$("#toshowResult").append(printTable);
                                   $("#printLogo").append(logo);
                                   //$("#printTestTitle").append(TestTitle);
                                   $("#printPtInfo").append(result_title+result_header);
                                   $("#printResultTable").append(result_body+result_footer);


                                 //  $("#toshowResult").append(hivResultForm);
                                   $("#header_bar").hide();
                                   window.print();
                                   $("#toshowResult").hide();
                                   $("#header_bar").show();
                                   $("#hider0").show();
                                   $("#hider1").show();
                                   location.reload(true);// to refresh the page
                              }
                       }
                });
             }else{
                     $("#noti").show();
                     document.getElementById('noti').innerHTML="Please input data first";
                   }
      }
function Urine(){
        if(save_update == 5){
          var urineTest = 2;
        }else{
          var urineTest = 1;
        }


        var cid = document.getElementById("cid").value;
        var agey = document.getElementById("agey").value;
        var agem = document.getElementById("agem").value;
        var gender = document.getElementById("gender").value;
        var fuchiaID = document.getElementById("fuchiaID").value;
        var clinic = document.getElementById("clinic").innerHTML;
        var vDate = document.getElementById("vDate").value;
        var Ptype = document.getElementById("Ptype").value;
        var ext_sub = Ptype_sub;
        console.log(ext_sub);
        var reqDoctor = document.getElementById("md").value;
        agey = parseInt(agey);//changing to number
        agem = parseInt(agem);
        gender= String(gender);


        var utest = document.getElementById("Utest_done").value;
        var typeoftest = document.getElementById("Utot").value;
        var color = document.getElementById("Ucolor").value;
        var appear = document.getElementById("Uapp").value;
        var pus = document.getElementById("Upus").value;
        var uph = document.getElementById("ph").value;
        var protein = document.getElementById("Uprotein").value;
        var glucose = document.getElementById("Uglucose").value;
        var rbc = document.getElementById("Urbc").value;
        var leu = document.getElementById("Uleu").value;
        var nitrite = document.getElementById("Unitrite").value;
        var ketone = document.getElementById("ketone").value;
        var epithelial = document.getElementById("Uepithelial").value;
        var robili = document.getElementById('Urobili').value;
        var billru = document.getElementById('Ubiliru').value;
        var ery = document.getElementById('Uery').value;
        var crystal = document.getElementById('Ucrystal').value;
        var hae = document.getElementById('Uhae').value;
        var other = document.getElementById('Uother').value;
        var cast = document.getElementById('Ucast').value;
        var Ument= document.getElementById('Ument').value;

        var lab_tech= document.getElementById('u_lab_tech').value;
        var issue_date= document.getElementById('u_issuDate').value;

                  var urineData = {
                    urineTest :urineTest ,

                    cid:cid,
                    fuchiaID:fuchiaID,
                    vDate:vDate,
                    Ptype:Ptype,
                    ext_sub:ext_sub,
                    agey:agey,
                    agem:agem,
                    gender:gender,
                    reqDoctor:reqDoctor,
                    clinic:clinic,

                    utest :utest,
                    typeoftest :typeoftest,
                    color :color,
                    appear :appear,
                    pus :pus,
                    uph :uph,
                    protein :protein,
                    glucose :glucose,
                    rbc :rbc,
                    leu :leu,
                    nitrite :nitrite,
                    ketone :ketone,
                    epithelial :epithelial,
                    robili:robili,
                    billru:billru,
                    ery :ery,
                    crystal :crystal,
                    hae :hae,
                    other :other,
                    cast :cast,
                    Ument:Ument,
                    lab_tech:lab_tech,
                    issue_date:issue_date
                  };
          if(cid.length >8 ){
            $.ajaxSetup({
               headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
               }
             });
             $.ajax({
                  type:'POST',
                  url:"{{route('tests')}}",
                  dataType:'json',
                //  processData:false,
                  contentType: 'application/json',
                  data: JSON.stringify(urineData),
                  success:function(response){
                    if (response) {
                      alert("You have collected test information of the patient.");
                        $("#hider0").hide();
                        $("#hider1").hide();
                        if(isNaN(agem)){
                          agem=0;
                        }
                        var logo ="<img src='{{asset('img/logoMAM.jpg')}}'style='width:70px;height:70px;float:left;'>"+
                                  "<h1 style='padding-left:130px;float:left;'>"+"Laboratory"+"</h1>"+"<br>"+"<br>"+
                                  "<h1 style='padding-left:100px;float:left;'>"+"Urine Test Result"+"</h1>";
                        var result_title= "<span style='padding-left:5px;float:left;'>"+"ID ::"+cid+
                        "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+"Fuchia ID::"+fuchiaID+
                        "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+"Date::"+vDate+"</span>"+
                                          "<span style='padding-left:5px;float:left;'>"+"Age(Y)::"+agey+
                                          "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+"Age(M)::"+agem+
                                          "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+"Gender::"+gender+"</span>";
                        var result_header ="<span style='padding-left:5px;float:left;'>"+"Requested Doctor::"+reqDoctor+
                                          "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
                                          "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" +"Counselor ::"+counselor+"</span>";

                      var result_body = "<br>"+"<table class='table table-sm'>"+
                          "<thead>"+
                              "<tr>" +"<td>"+"Test Name"+"</td>"+"<td>"+"Result"+"</td>"+"<td>"+"Remark"+"</td>"+"</tr>"+
                          "</thead>"+
                          "<tbody>"+

                              "<tr>"+"<td>"+"Type Of Test"+"</td>"+"<td>"+typeoftest+"</td>"+"<td>"+""+"</td>"+"</tr>"+
                              "<tr>"+"<td>"+"Apperance"+"</td>"+"<td>"+color+"</td>"+"<td>"+""+"</td>"+"</tr>"+
                              "<tr>"+"<td>"+"Apperance Sub"+"</td>"+"<td>"+appear+"</td>"+"<td>"+""+"</td>"+"</tr>"+
                              "<tr>"+"<td>"+"pus/WBC"+"</td>"+"<td>"+pus+"</td>"+"<td>"+""+"</td>"+"</tr>"+
                              "<tr>"+"<td>"+"PH"+"</td>"+"<td>"+uph+"</td>"+"<td>"+""+"</td>"+"</tr>"+
                              "<tr>"+"<td>"+"Protein"+"</td>"+"<td>"+protein+"</td>"+"<td>"+""+"</td>"+"</tr>"+
                              "<tr>"+"<td>"+"Glucose"+"</td>"+"<td>"+glucose+"</td>"+"<td>"+""+"</td>"+"</tr>"+
                              "<tr>"+"<td>"+"RBC"+"</td>"+"<td>"+rbc+"</td>"+"<td>"+""+"</td>"+"</tr>"+
                              "<tr>"+"<td>"+"Leukocyte"+"</td>"+"<td>"+leu+"</td>"+"<td>"+""+"</td>"+"</tr>"+
                              "<tr>"+"<td>"+"Nitrite"+"</td>"+"<td>"+nitrite+"</td>"+"<td>"+""+"</td>"+"</tr>"+
                              "<tr>"+"<td>"+"Ketone"+"</td>"+"<td>"+ketone+"</td>"+"<td>"+""+"</td>"+"</tr>"+
                              "<tr>"+"<td>"+"Epithelial Cell"+"</td>"+"<td>"+epithelial+"</td>"+"<td>"+""+"</td>"+"</tr>"+
                              "<tr>"+"<td>"+"Urobilinogen"+"</td>"+"<td>"+robili+"</td>"+"<td>"+""+"</td>"+"</tr>"+
                              "<tr>"+"<td>"+"Bilirubin"+"</td>"+"<td>"+billru+"</td>"+"<td>"+""+"</td>"+"</tr>"+
                              "<tr>"+"<td>"+"Erythrocyte"+"</td>"+"<td>"+ery+"</td>"+"<td>"+""+"</td>"+"</tr>"+
                              "<tr>"+"<td>"+"Crystal"+"</td>"+"<td>"+crystal+"</td>"+"<td>"+""+"</td>"+"</tr>"+
                              "<tr>"+"<td>"+"Haemoglobin"+"</td>"+"<td>"+hae+"</td>"+"<td>"+""+"</td>"+"</tr>"+
                              "<tr>"+"<td>"+"Other "+"</td>"+"<td>"+other +"</td>"+"<td>"+""+"</td>"+"</tr>"+
                              "<tr>"+"<td>"+"Cast"+"</td>"+"<td>"+cast+"</td>"+"<td>"+""+"</td>"+"</tr>"+
                              "<tr>"+"<td>"+"Comment"+"</td>"+"<td>"+Ument+"</td>"+"<td>"+""+"</td>"+"</tr>"+
                        "</tbody>"+
                      "</table>" ;

                      var result_footer="<span style='padding-left:5px;'>"+"Issue by- "+lab_tech+
                      "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
                      "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
                         "Issue Date :"+issue_date+ "</span>";
                      //$("#toshowResult").append(printTable);
                      $("#printLogo").append(logo);
                      //$("#printTestTitle").append(TestTitle);
                      $("#printPtInfo").append(result_title+result_header);
                      $("#printResultTable").append(result_body+result_footer);


                    //  $("#toshowResult").append(hivResultForm);
                      $("#header_bar").hide();
                      window.print();
                      $("#toshowResult").hide();
                      $("#header_bar").show();
                      $("#hider0").show();
                      $("#hider1").show();
                      location.reload(true);// to refresh the page
                    }
                  }
                 });
               }else{
                       $("#noti").show();
                       document.getElementById('noti').innerHTML="Please input data first";
                     }
      }
function oiSave(){


          var cid = document.getElementById("cid").value;
          var agey = document.getElementById("agey").value;
          var agem = document.getElementById("agem").value;
          var gender = document.getElementById("gender").value;
          var fuchiaID = document.getElementById("fuchiaID").value;
          var clinic = document.getElementById("clinic").innerHTML;
          var vDate = document.getElementById("vDate").value;
          var Ptype = document.getElementById("Ptype").value;
          var ext_sub = Ptype_sub;
          console.log(ext_sub);
          var reqDoctor = document.getElementById("md").value;
          agey = parseInt(agey);//changing to number
          agem = parseInt(agem);
          gender= String(gender);
          let tb_lam_report       = document.getElementById('tb_lam').value;
          let serum_cry_antigen   = document.getElementById('serum_cry_antigen').value;
          let serum_cry_due       = document.getElementById('serum_cry_dil').value;
          let csf_cry_antigen     = document.getElementById('csf_cry_antigen').value;
          let csf_due             = document.getElementById('csf_dil').value;
          let csf_smear           = document.getElementById('csf_smear').value;
          let giemsa_stain_result = document.getElementById('giemsa_stain_result').value;
          let india_ink_result    = document.getElementById('india_ink_result').value;
          let skin_smear          = document.getElementById('skin_smear').value;
          let skin_giemsa_stain_result   = document.getElementById('skin_giemsa_stain_result').value;
          let skin_india_ink_result      = document.getElementById('skin_india_ink_result').value;
          let oth_smear = document.getElementById('oth_smear').value;
          let type_sample   = document.getElementById('type_sample').value;
          let gram_stain_result    = document.getElementById('gram_stain_result').value;
          let oi_lab_tech   = document.getElementById('oi_lab_tech').value;
          let oi_issue_date = document.getElementById('oi_issue_date').value;
          //let oi_visitID    = document.getElementById('').value;


          if(save_update == 6){
            update_rowNo= resp[5][rowNo]['id'];
            var oiTest = 2;
            var appUser = document.getElementById("app-User").innerHTML;
            var org_info = 'RowID->'+resp[5][rowNo]['id']
            +',FuchiaID->' +resp[5][rowNo]["fuchiacode"]
            + ',GeneralID->' +resp[5][rowNo]["CID"]
            + ',Age(year)->' +resp[5][rowNo]["agey"]
            + ',Age(mo)->' +resp[5][rowNo]["agem"]
            + ',Gender->' +resp[5][rowNo]["Gender"]
            + ',Visit Date->' +resp[5][rowNo]["visit_date"]
            + ',Risk->' +resp[5][rowNo]['Type Of Patient']
            + ',Sub risk->' +resp[5][rowNo]['Patient Type Sub']

            + ',TB_LAM_Report->' +resp[5][rowNo]['TB_LAM_Report']
            + ',Serum Result->' +resp[5][rowNo]['Serum Result']
            + ',Serum Pos->' +resp[5][rowNo]['serum_pos']
            + ',CSF For Cryptococcal Antigen->' +resp[5][rowNo]['CSF for Cryptococcal Antigen']
            + ',CSF crypto Pos->' +resp[5][rowNo]['csf_crypto_pos']
            + ',CSF Fungal->' +resp[5][rowNo]['csf_fungal']
            + ',CSF Smear Giemsa Stain->' +resp[5][rowNo]['CSF Smear Giemsa Stain']
            + ',CSF Smear India Ink->' +resp[5][rowNo]['CSF Smear India Ink']
            + ',Skin Fungal->' +resp[5][rowNo]['skin_fungal']
            + ',Skin Smear Giemsa Stain->' +resp[5][rowNo]['Skin Smear Giemsa Stain']
            + ',Other Smear->' +resp[5][rowNo]['other_Smear']
            + ',Skin Smear India Ink->' +resp[5][rowNo]['Skin Smear India Ink']
            + ',Sample Type->' +resp[5][rowNo]['sample_type']
            + ',Other Gram->' +resp[5][rowNo]['other_gram']
            + ',Lab Tech->' +resp[5][rowNo]['Lab Techanician']
            + ',Issude Date->' +resp[5][rowNo]['issued'];


            var updated_info =
            'FuchiaID->'+fuchiaID+
            ',Age(year)->'+agey+
            ',Age(mo)->'+agem+
            ',Gender->'+gender+
            ',Visit Date ->'+vDate+
            ',Risk->'+Ptype+
            ',Sub Risk->'+ext_sub+
            ',MD ->'+reqDoctor+
            ',Clinic->'+clinic+
            ',TB_Lam_report->'+tb_lam_report+
            ',Serum Cry antigen->'+serum_cry_antigen+
            ',Serum Cry due->'+serum_cry_due+
            ',CSF cry antigen->'+csf_cry_antigen+
            ',CSF due->'+csf_due+
            ',CSF Smear->'+csf_smear+
            ',Giemsa Stain Result->'+giemsa_stain_result+
            ',India Ink Result->'+india_ink_result+
            ',Skin Smear->'+skin_smear+
            ',Skin Giemsa Stain Result->'+skin_giemsa_stain_result+
            ',Skin India Ink Result->'+skin_india_ink_result+
            ',Other Smear->'+oth_smear+
            ',Type Sample->'+type_sample+
            ',Gram Stain Result->'+gram_stain_result+
            ',Lab Tech->'+oi_lab_tech+
            ',Issue Date->'+oi_issue_date;



            let oiData={
                        updated_info:updated_info,
                        org_info:org_info,
                        appUser:appUser,
                        update_rowNo:update_rowNo,
                        oiTest:oiTest,
                        cid:cid,
                        fuchiaID:fuchiaID,
                        agey:agey,
                        agem:agem,
                        gender:gender,
                        vDate:vDate,
                        Ptype:Ptype,
                        ext_sub:ext_sub,
                        reqDoctor:reqDoctor,
                        clinic:clinic,
                        tb_lam_report:tb_lam_report,
                        serum_cry_antigen:serum_cry_antigen,
                        serum_cry_due:serum_cry_due,
                        csf_cry_antigen:csf_cry_antigen,
                        csf_due:csf_due,
                        csf_smear:csf_smear,
                        giemsa_stain_result:giemsa_stain_result,
                        india_ink_result:india_ink_result,
                        skin_smear:skin_smear,
                        skin_giemsa_stain_result:skin_giemsa_stain_result,
                        skin_india_ink_result:skin_india_ink_result,
                        oth_smear:oth_smear,
                        type_sample:type_sample,
                        gram_stain_result:gram_stain_result,
                        oi_lab_tech:oi_lab_tech,
                        oi_issue_date:oi_issue_date
                      };
          }else{
            var oiTest = 1;
            let oiData={
                        oiTest:oiTest,
                        cid:cid,
                        fuchiaID:fuchiaID,
                        agey:agey,
                        agem:agem,
                        gender:gender,
                        vDate:vDate,
                        Ptype:Ptype,
                        ext_sub:ext_sub,
                        reqDoctor:reqDoctor,
                        clinic:clinic,
                        tb_lam_report:tb_lam_report,
                        serum_cry_antigen:serum_cry_antigen,
                        serum_cry_due:serum_cry_due,
                        csf_cry_antigen:csf_cry_antigen,
                        csf_due:csf_due,
                        csf_smear:csf_smear,
                        giemsa_stain_result:giemsa_stain_result,
                        india_ink_result:india_ink_result,
                        skin_smear:skin_smear,
                        skin_giemsa_stain_result:skin_giemsa_stain_result,
                        skin_india_ink_result:skin_india_ink_result,
                        oth_smear:oth_smear,
                        type_sample:type_sample,
                        gram_stain_result:gram_stain_result,
                        oi_lab_tech:oi_lab_tech,
                        oi_issue_date:oi_issue_date
                      };
            }



                if(cid.length >8){

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
                        data: JSON.stringify(oiData),
                        //data: rprDataset,
                        success:function(response){
                          if (response) {
                            alert("You have collected test information of the patient.");
                              $("#hider0").hide();
                              $("#hider1").hide();
                              if(isNaN(agem)){
                                agem=0;
                              }
                              var logo ="<img src='{{asset('img/logoMAM.jpg')}}'style='width:70px;height:70px;float:left;'>"+
                                        "<h1 style='padding-left:130px;float:left;'>"+"Laboratory"+"</h1>"+"<br>"+"<br>"+
                                        "<h1 style='padding-left:100px;float:left;'>"+"OI Test Result"+"</h1>";
                              var result_title= "<span style='padding-left:5px;float:left;'>"+"ID ::"+cid+
                              "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+"Fuchia ID::"+fuchiaID+
                              "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+"Date::"+vDate+"</span>"+
                                                "<span style='padding-left:5px;float:left;'>"+"Age(Y)::"+agey+
                                                "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+"Age(M)::"+agem+
                                                "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+"Gender::"+gender+"</span>";
                              var result_header ="<span style='padding-left:5px;float:left;'>"+"Requested Doctor::"+reqDoctor+
                                                "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
                                                "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" +"Counselor ::"+counselor+"</span>";

                            var result_body = "<br>"+"<table class='table table-sm'>"+
                                "<thead>"+
                                    "<tr>" +"<td>"+"Test Name"+"</td>"+"<td>"+"Result"+"</td>"+"<td>"+"Remark"+"</td>"+"<td>"+""+"</td>"+"</tr>"+
                                "</thead>"+
                                "<tbody>"+
                                    "<tr>"+"<td>"+"TB LAM"+"</td>"+"<td>"+tb_lam_report+"</td>"+"<td>"+""+"</td>"+"</tr>"+
                                    "<tr>"+"<td>"+"Serum Cryptococcal Antigen"+"</td>"+"<td>"+serum_cry_antigen+"</td>"+"<td>"+serum_cry_due+"</td>"+"</tr>"+
                                    "<tr>"+"<td>"+"CSF for Cryptococcal Antigen"+"</td>"+"<td>"+csf_cry_antigen+"</td>"+"<td>"+csf_due+"</td>"+"</tr>"+
                                    "<tr>"+"<td>"+"CSF Smear"+"</td>"+"<td>"+csf_smear+"</td>"+"<td>"+""+"</td>"+"</tr>"+
                                    "<tr>"+"<td>"+"Giemsa stain Result"+"</td>"+"<td>"+giemsa_stain_result+"</td>"+"<td>"+""+"</td>"+"</tr>"+
                                    "<tr>"+"<td>"+"India Ink Result"+"</td>"+"<td>"+india_ink_result+"</td>"+"<td>"+""+"</td>"+"</tr>"+
                                    "<tr>"+"<td>"+"Skin Smear"+"</td>"+"<td>"+skin_smear+"</td>"+"<td>"+""+"</td>"+"</tr>"+
                                    "<tr>"+"<td>"+"Giemsa stain Result"+"</td>"+"<td>"+skin_giemsa_stain_result+"</td>"+"<td>"+""+"</td>"+"</tr>"+
                                    "<tr>"+"<td>"+"India ink Result"+"</td>"+"<td>"+skin_india_ink_result+"</td>"+"<td>"+""+"</td>"+"</tr>"+
                                    "<tr>"+"<td>"+"Other Smear"+"</td>"+"<td>"+oth_smear+"</td>"+"<td>"+""+"</td>"+"</tr>"+
                                    "<tr>"+"<td>"+"Type of Sample"+"</td>"+"<td>"+type_sample+"</td>"+"<td>"+""+"</td>"+"</tr>"+
                                    "<tr>"+"<td>"+"Gram stain Result"+"</td>"+"<td>"+gram_stain_result+"</td>"+"<td>"+""+"</td>"+"</tr>"+
                                    "<tr>"+"<td>"+"Lab Technician "+"</td>"+"<td>"+oi_lab_tech+"</td>"+"<td>"+"Issue Date"+"</td>"+"<td>"+oi_issue_date+"</td>"+"</tr>"+
                              "</tbody>"+
                            "</table>" ;

                            var result_footer="<span style='padding-left:5px;'>"+"Issue by- "+oi_lab_tech+
                            "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
                            "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
                               "Issue Date :"+oi_issue_date+ "</span>";
                            //$("#toshowResult").append(printTable);
                            $("#printLogo").append(logo);
                            //$("#printTestTitle").append(TestTitle);
                            $("#printPtInfo").append(result_title+result_header);
                            $("#printResultTable").append(result_body+result_footer);


                          //  $("#toshowResult").append(hivResultForm);
                            $("#header_bar").hide();
                            window.print();
                            $("#toshowResult").hide();
                            $("#header_bar").show();
                            $("#hider0").show();
                            $("#hider1").show();
                            location.reload(true);// to refresh the page
                          }
                        }
                       });

                    }else{
                          $("#noti").show();
                          document.getElementById('noti').innerHTML="Please input data first";
                        }
       }
function gtSave(){
         if(save_update == 7){
           var gtTest = 2;
         }else{
           var gtTest = 1;
         }
         var cid                 = document.getElementById("cid").value;
         var agey                = document.getElementById("agey").value;
         var agem                = document.getElementById("agem").value;
         var gender              = document.getElementById("gender").value;
         var fuchiaID            = document.getElementById("fuchiaID").value;
         var clinic              = document.getElementById("clinic").innerHTML;
         var vDate               = document.getElementById("vDate").value;
         var Ptype               = document.getElementById("Ptype").value;
         var ext_sub             = Ptype_sub;
         var reqDoctor           = document.getElementById("md").value;
         agey                    = parseInt(agey);//changing to number
         agem                    = parseInt(agem);
         gender                  = String(gender);

         let dangue_rdt          = document.getElementById('dangue_rdt').value;
         let NS1_antigen         = document.getElementById('NS1_antigen').value;
         let igG                 = document.getElementById('igG').value;
         let igm                 = document.getElementById('igm').value;
         let malaria_rdt         = document.getElementById('malaria_rdt').value;
         let malaria_rdt_result  = document.getElementById('malaria_rdt_result').value;
         let malaria_microscopy  = document.getElementById('malaria_microscopy').value;
         let microscopy_result   = document.getElementById('microscopy_result').value;
         let rbs                 = document.getElementById('rbs').value;
         let rbs_result          = document.getElementById('rbs_result').value;
         let fbs                 = document.getElementById('fbs').value;
         let fbs_result          = document.getElementById('fbs_result').value;
         let gt_haemoglobin      = document.getElementById('gt_haemoglobin').value;
         let haemoPercent        = document.getElementById('haemoPercent').value;
         let hba1c               = document.getElementById('hba1c').value;
         let gt_lab_tech         = document.getElementById('gt_lab_tech').value;
         let gt_issue_date       = document.getElementById('gt_issue_date').value;
         //let oi_visitID    = document.getElementById('').value;
         let gtData={
                       gtTest              :gtTest,
                       cid                 :cid,
                       fuchiaID            :fuchiaID,
                       agey                :agey,
                       agem                :agem,
                       gender              :gender,
                       vDate               :vDate,
                       Ptype               :Ptype,
                       ext_sub             :ext_sub,
                       reqDoctor           :reqDoctor,
                       clinic              :clinic,
                       dangue_rdt          : dangue_rdt,
                       NS1_antigen         : NS1_antigen,
                       igG                 : igG,
                       igm                 : igm,
                       malaria_rdt         : malaria_rdt,
                       malaria_rdt_result  : malaria_rdt_result,
                       malaria_microscopy  : malaria_microscopy,
                       microscopy_result   : microscopy_result,
                       rbs                 : rbs,
                       rbs_result          : rbs_result,
                       fbs                 : fbs,
                       fbs_result          : fbs_result,
                       gt_haemoglobin      : gt_haemoglobin,
                       haemoPercent        : haemoPercent,
                       hba1c               : hba1c,
                       gt_lab_tech         : gt_lab_tech,
                       gt_issue_date       : gt_issue_date,
                   };
             if(cid.length>8){

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
                       data: JSON.stringify(gtData),
                       //data: rprDataset,
                       success:function(response){
                         if (response) {
                           alert("You have collected test information of the patient.");
                             $("#hider0").hide();
                             $("#hider1").hide();
                             if(isNaN(agem)){
                               agem=0;
                             }
                             var logo ="<img src='{{asset('img/logoMAM.jpg')}}'style='width:70px;height:70px;float:left;'>"+
                                       "<h1 style='padding-left:130px;float:left;'>"+"Laboratory"+"</h1>"+"<br>"+"<br>"+
                                       "<h1 style='padding-left:100px;float:left;'>"+"General Test Result"+"</h1>";
                             var result_title= "<span style='padding-left:5px;float:left;'>"+"ID ::"+cid+
                             "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+"Fuchia ID::"+fuchiaID+
                             "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+"Date::"+vDate+"</span>"+
                                               "<span style='padding-left:5px;float:left;'>"+"Age(Y)::"+agey+
                                               "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+"Age(M)::"+agem+
                                               "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+"Gender::"+gender+"</span>";
                             var result_header ="<span style='padding-left:5px;float:left;'>"+"Requested Doctor::"+reqDoctor+
                                               "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
                                               "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" +"Counselor ::"+counselor+"</span>";

                           var result_body = "<br>"+"<table class='table table-sm'>"+
                               "<thead>"+
                                   "<tr>" +"<td>"+"Test Name"+"</td>"+"<td>"+"Result"+"</td>"+"</tr>"+
                               "</thead>"+
                               "<tbody>"+
                                   "<tr id='tbrow'>"+"<td>"+"Dangue Result"+"</td>"+"<td>"+NS1_antigen+"</td>"+"</tr>"+
                                   "<tr id='tbrow'>"+"<td>"+"IgG"+"</td>"+"<td>"+igG+"</td>"+"</tr>"+
                                   "<tr id='tbrow'>"+"<td>"+"IgM"+"</td>"+"<td>"+igm+"</td>"+"</tr>"+

                                   "<tr id='tbrow'>"+"<td>"+"Malaria RDT Result"+"</td>"+"<td>"+malaria_rdt_result+"</td>"+"</tr>"+
                                   "<tr id='tbrow'>"+"<td>"+"Microscopy Result"+"</td>"+"<td>"+microscopy_result+"</td>"+"</tr>"+
                                   "<tr id='tbrow'>"+"<td>"+"RBS(mg/dl)"+"</td>"+"<td>"+rbs_result+"</td>"+"</tr>"+
                                   "<tr id='tbrow'>"+"<td>"+"FBS(mg/dl)"+"</td>"+"<td>"+fbs_result+"</td>"+"</tr>"+
                                   "<tr id='tbrow'>"+"<td>"+"Haemoglobin % (g/dl)"+"</td>"+"<td>"+haemoPercent+"</td>"+"</tr>"+
                                   "<tr id='tbrow'>"+"<td>"+"HbA1C %"+"</td>"+"<td>"+hba1c+"</td>"+"</tr>"+
                             "</tbody>"+
                           "</table>" ;

                           var result_footer="<span style='padding-left:5px;'>"+"Issue by- "+gt_lab_tech+
                           "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
                           "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
                              "Issue Date :"+gt_issue_date+ "</span>";
                           //$("#toshowResult").append(printTable);
                           $("#printLogo").append(logo);
                           //$("#printTestTitle").append(TestTitle);
                           $("#printPtInfo").append(result_title+result_header);
                           $("#printResultTable").append(result_body+result_footer);


                         //  $("#toshowResult").append(hivResultForm);
                           $("#header_bar").hide();
                           window.print();
                           $("#toshowResult").hide();
                           $("#header_bar").show();
                           $("#hider0").show();
                           $("#hider1").show();
                           location.reload(true);// to refresh the page
                         }
                       }
                      });
                   }else{
                         $("#noti").show();
                         document.getElementById('noti').innerHTML="Please input data first";
                         }

}
function stSave(){
         if(save_update == 8){
           var stTest = 2;
         }else{
           var stTest = 1;
         }
         var cid                 = document.getElementById("cid").value;
         var agey                = document.getElementById("agey").value;
         var agem                = document.getElementById("agem").value;
         var gender              = document.getElementById("gender").value;
         var fuchiaID            = document.getElementById("fuchiaID").value;
         var clinic              = document.getElementById("clinic").innerHTML;
         var vDate               = document.getElementById("vDate").value;
         var Ptype               = document.getElementById("Ptype").value;
         var ext_sub             = Ptype_sub;
         var reqDoctor           = document.getElementById("md").value;
         agey                    = parseInt(agey);//changing to number
         agem                    = parseInt(agem);
         gender                  = String(gender);

         let st_stool            = document.getElementById('st_stool').value;
         let st_colour           = document.getElementById('st_colour').value;
         let wbc_pus_cell        = document.getElementById('wbc_pus_cell').value;
         let st_consistency      = document.getElementById('st_consistency').value;
         let st_rbcs             = document.getElementById('st_rbcs').value;
         let st_other            = document.getElementById('st_other').value;
         let st_comment          = document.getElementById('st_comment').value;
         let st_lab_tech         = document.getElementById('st_lab_tech').value;
         let st_issue_date       = document.getElementById('st_issue_date').value;

         let stData={
                       stTest              :stTest,
                       cid                 :cid,
                       fuchiaID            :fuchiaID,
                       agey                :agey,
                       agem                :agem,
                       gender              :gender,
                       vDate               :vDate,
                       Ptype               :Ptype,
                       ext_sub             :ext_sub,
                       reqDoctor           :reqDoctor,
                       clinic              :clinic,

                       st_stool            : st_stool,
                       st_colour           : st_colour,
                       wbc_pus_cell        : wbc_pus_cell,
                       st_consistency      : st_consistency,
                       st_rbcs             : st_rbcs,
                       st_other            : st_other,
                       st_comment          : st_comment ,
                       st_lab_tech         : st_lab_tech,
                       st_issue_date       : st_issue_date,

                   };
                   if(cid.length >8){

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
                       data: JSON.stringify(stData),
                       //data: rprDataset,
                       success:function(response){
                         if (response) {
                           alert("You have collected test information of the patient.");
                             $("#hider0").hide();
                             $("#hider1").hide();
                             if(isNaN(agem)){
                               agem=0;
                             }
                             var logo ="<img src='{{asset('img/logoMAM.jpg')}}'style='width:70px;height:70px;float:left;'>"+
                                       "<h1 style='padding-left:130px;float:left;'>"+"Laboratory"+"</h1>"+"<br>"+"<br>"+
                                       "<h1 style='padding-left:100px;float:left;'>"+"Stool Test Result"+"</h1>";
                             var result_title= "<span style='padding-left:5px;float:left;'>"+"ID ::"+cid+
                             "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+"Fuchia ID::"+fuchiaID+
                             "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+"Date::"+vDate+"</span>"+
                                               "<span style='padding-left:5px;float:left;'>"+"Age(Y)::"+agey+
                                               "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+"Age(M)::"+agem+
                                               "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+"Gender::"+gender+"</span>";
                             var result_header ="<span style='padding-left:5px;float:left;'>"+"Requested Doctor::"+reqDoctor+
                                               "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
                                               "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" +"Counselor ::"+counselor+"</span>";
                           var result_body = "<br>"+"<table class='table table-sm'>"+
                               "<thead>"+
                                   "<tr>" +"<td>"+"Test Name"+"</td>"+"<td>"+"Result"+"</td>"+"<td>"+"Remark"+"</td>"+"</tr>"+
                               "</thead>"+
                               "<tbody>"+
                                   "<tr>"+"<td>"+"Stool"+"</td>"+"<td>"+st_stool+"</td>"+"<td>"+""+"</td>"+"</tr>"+
                                   "<tr>"+"<td>"+"Color"+"</td>"+"<td>"+st_colour+"</td>"+"<td>"+""+"</td>"+"</tr>"+
                                   "<tr>"+"<td>"+"WWBCs/ PUS cell"+"</td>"+"<td>"+wbc_pus_cell+"</td>"+"<td>"+""+"</td>"+"</tr>"+
                                   "<tr>"+"<td>"+"Consistency"+"</td>"+"<td>"+st_consistency+"</td>"+"<td>"+""+"</td>"+"</tr>"+
                                   "<tr>"+"<td>"+"Other"+"</td>"+"<td>"+st_other+"</td>"+"<td>"+""+"</td>"+"</tr>"+
                             "</tbody>"+
                           "</table>" ;
                           var result_footer="<span style='padding-left:5px;'>"+"Issue by- "+st_lab_tech+
                           "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
                           "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
                              "Issue Date :"+st_issue_date+ "</span>";
                           //$("#toshowResult").append(printTable);
                           $("#printLogo").append(logo);
                           //$("#printTestTitle").append(TestTitle);
                           $("#printPtInfo").append(result_title+result_header);
                           $("#printResultTable").append(result_body+result_footer);


                         //  $("#toshowResult").append(hivResultForm);
                           $("#header_bar").hide();
                           window.print();
                           $("#toshowResult").hide();
                           $("#header_bar").show();
                           $("#hider0").show();
                           $("#hider1").show();
                           location.reload(true);// to refresh the page
                         }
                       }
                      });
                    }else{
                           $("#noti").show();
                           document.getElementById('noti').innerHTML="Please input data first";
                         }
}
function afbSave(){
         if(save_update == 9){
           var afbTest = 2;
         }else{
           var afbTest = 1;
         }
         var cid                 = document.getElementById("cid").value;
         var agey                = document.getElementById("agey").value;
         var agem                = document.getElementById("agem").value;
         var gender              = document.getElementById("gender").value;
         var fuchiaID            = document.getElementById("fuchiaID").value;
         var clinic              = document.getElementById("clinic").innerHTML;
         var vDate               = document.getElementById("vDate").value;
         var Ptype               = document.getElementById("Ptype").value;
         var ext_sub             = Ptype_sub;
         var reqDoctor           = document.getElementById("md").value;
         agey                    = parseInt(agey);//changing to number
         agem                    = parseInt(agem);
         gender                  = String(gender);

         let afb_pt_name         = document.getElementById('afb_pt_name').value;
         let afb_pt_address      = document.getElementById('afb_pt_address').value;
         let Previous_TB         = document.getElementById('Previous_TB').value;
         let HIV_status          = document.getElementById('HIV_status').value;
         let reason_for_exam     = document.getElementById('reason_for_exam').value;
         let afb_Pt_type         = document.getElementById('afb_Pt_type').value;
         let follow_up_mt        = document.getElementById('follow_up_mt').value;
         let speci_type          = document.getElementById('speci_type').value;
         let slide_num_1         = document.getElementById('slide_num_1').value;
         let slide_num_2         = document.getElementById('slide_num_2').value;
         let speci_receive_dt1   = document.getElementById('speci_receive_dt1').value;
         let speci_receive_dt2   = document.getElementById('speci_receive_dt2').value;
         let visual_app_1        = document.getElementById('visual_app_1').value;
         let visual_app_2        = document.getElementById('visual_app_2').value;
         let afb_result1         = document.getElementById('afb_result1').value;
         let afb_result2         = document.getElementById('afb_result2').value;
         let sacnty_grading1     = document.getElementById('sacnty_grading1').value;
         let sacnty_grading2     = document.getElementById('sacnty_grading2').value;
         let afb_lab_tech      = document.getElementById('afb_lab_tech').value;
         let afb_issue_date      = document.getElementById('afb_issue_date').value;

         let afbData={
                       afbTest             :afbTest,
                       cid                 :cid,
                       fuchiaID            :fuchiaID,
                       agey                :agey,
                       agem                :agem,
                       gender              :gender,
                       vDate               :vDate,
                       Ptype               :Ptype,
                       ext_sub             :ext_sub,
                       reqDoctor           :reqDoctor,
                       clinic              :clinic,
                        afb_pt_name        :afb_pt_name,
                        afb_pt_address     :afb_pt_address,
                        Previous_TB        :Previous_TB,
                        HIV_status         :HIV_status,
                        reason_for_exam    :reason_for_exam,
                        afb_Pt_type        :afb_Pt_type,
                        follow_up_mt       :follow_up_mt,
                        speci_type         :speci_type,
                        slide_num_1        :slide_num_1,
                        slide_num_2        :slide_num_2,
                        speci_receive_dt1  :speci_receive_dt1,
                        speci_receive_dt2  :speci_receive_dt2,
                        visual_app_1       :visual_app_1,
                        visual_app_2       :visual_app_2,
                        afb_result1        :afb_result1,
                        afb_result2        :afb_result2,
                        sacnty_grading1    :sacnty_grading1,
                        sacnty_grading2    :sacnty_grading2,
                        afb_lab_tech       :afb_lab_tech,
                        afb_issue_date     :afb_issue_date,
                   };
               if(cid.length>8){
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
                       data: JSON.stringify(afbData),
                       //data: rprDataset,
                       success:function(response){
                         if (response) {
                           alert("You have collected test information of the patient.");
                             $("#hider0").hide();
                             $("#hider1").hide();
                             if(isNaN(agem)){
                               agem=0;
                             }
                             var logo ="<img src='{{asset('img/logoMAM.jpg')}}'style='width:70px;height:70px;float:left;'>"+
                                       "<h1 style='padding-left:130px;float:left;'>"+"Laboratory"+"</h1>"+"<br>"+"<br>"+
                                       "<h1 style='padding-left:100px;float:left;'>"+"AFB Test Result"+"</h1>";
                             var result_title= "<span style='padding-left:5px;float:left;'>"+"ID ::"+cid+
                             "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+"Fuchia ID::"+fuchiaID+
                             "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+"Date::"+vDate+"</span>"+
                                               "<span style='padding-left:5px;float:left;'>"+"Age(Y)::"+agey+
                                               "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+"Age(M)::"+agem+
                                               "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+"Gender::"+gender+"</span>";
                             var result_header ="<span style='padding-left:5px;float:left;'>"+"Requested Doctor::"+reqDoctor+
                                               "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
                                               "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" +"Counselor ::"+counselor+"</span>";

                           var result_body = "<br>"+"<table class='table table-sm'>"+
                               "<thead>"+
                                   "<tr>" +"<td>"+"Test Name"+"</td>"+"<td>"+"Result"+"</td>"+"<td>"+"Result"+"</td>"+"</tr>"+
                               "</thead>"+
                               "<tbody>"+
                                   "<tr>"+"<td>"+""+"</td>"+"<td>"+"Sample 1"+"</td>"+"<td>"+"Sample 2"+"</td>"+"</tr>"+
                                   "<tr>"+"<td>"+"Slide Number"+"</td>"+"<td>"+slide_num_1+"</td>"+"<td>"+slide_num_2+"</td>"+"</tr>"+
                                   "<tr>"+"<td>"+"Specimen received date"+"</td>"+"<td>"+speci_receive_dt1+"</td>"+"<td>"+speci_receive_dt2+"</td>"+"</tr>"+
                                   "<tr>"+"<td>"+"Visual Appearance"+"</td>"+"<td>"+visual_app_1+"</td>"+"<td>"+visual_app_2+"</td>"+"</tr>"+
                                   "<tr>"+"<td>"+"AFB Result"+"</td>"+"<td>"+afb_result1 +"</td>"+"<td>"+afb_result2+"</td>"+"</tr>"+
                                   "<tr>"+"<td>"+"Scanty Grading"+"</td>"+"<td>"+sacnty_grading1+"</td>"+"<td>"+sacnty_grading2+"</td>"+"</tr>"+
                             "</tbody>"+
                           "</table>" ;
                           var result_footer="<span style='padding-left:5px;'>"+"Issue by- "+afb_lab_tech+
                           "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
                           "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
                              "Issue Date :"+afb_issue_date+ "</span>";
                           //$("#toshowResult").append(printTable);
                           $("#printLogo").append(logo);
                           //$("#printTestTitle").append(TestTitle);
                           $("#printPtInfo").append(result_title+result_header);
                           $("#printResultTable").append(result_body+result_footer);


                         //  $("#toshowResult").append(hivResultForm);
                           $("#header_bar").hide();
                           window.print();
                           $("#toshowResult").hide();
                           $("#header_bar").show();
                           $("#hider0").show();
                           $("#hider1").show();
                           location.reload(true);// to refresh the page
                         }
                       }
                      });
                    }else{
                         $("#noti").show();
                         document.getElementById('noti').innerHTML="Please input data first";
                         }
}
function covidData(){
         if(save_update == 10){
           var covidTest = 2;
         }else{
           var covidTest = 1;
         }
         var cid                 = document.getElementById("cid").value;
         var agey                = document.getElementById("agey").value;
         var agem                = document.getElementById("agem").value;
         var gender              = document.getElementById("gender").value;
         var fuchiaID            = document.getElementById("fuchiaID").value;
         var clinic              = document.getElementById("clinic").innerHTML;
         var vDate               = document.getElementById("vDate").value;
         var Ptype               = document.getElementById("Ptype").value;
         var ext_sub             = Ptype_sub;
         var reqDoctor           = document.getElementById("md").value;
         agey                    = parseInt(agey);//changing to number
         agem                    = parseInt(agem);
         gender                  = String(gender);
         let co_Age                = document.getElementById('co_Age').value;
         let type_of_patient_covid = document.getElementById('type_of_patient_covid').value;
         let specimen_type         = document.getElementById('specimen_type').value;
         let co_test_type          = document.getElementById('co_test_type').value;
         let covid_result          = document.getElementById('covid_result').value;
         let co_comment            = document.getElementById('co_comment').value;
         let covid_lab_tech        = document.getElementById('covid_lab_tech').value;
         let covid_issue_date        = document.getElementById('covid_issue_date').value;
         let covidData={
                       covidTest           :covidTest,
                       cid                 :cid,
                       fuchiaID            :fuchiaID,
                       agey                :agey,
                       agem                :agem,
                       gender              :gender,
                       vDate               :vDate,
                       Ptype               :Ptype,
                       ext_sub             :ext_sub,
                       reqDoctor           :reqDoctor,
                       clinic              :clinic,
                        co_Age                 :co_Age,
                        type_of_patient_covid  :type_of_patient_covid,
                        specimen_type          :specimen_type ,
                        co_test_type           :co_test_type,
                        covid_result           :covid_result,
                        covid_lab_tech         :covid_lab_tech,
                        covid_issue_date       :covid_issue_date,
                   };
             if(cid.length>8){
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
                       data: JSON.stringify(covidData),
                       //data: rprDataset,
                       success:function(response){
                         if (response) {
                           alert("You have collected test information of the patient.");
                             $("#hider0").hide();
                             $("#hider1").hide();
                             if(isNaN(agem)){
                               agem=0;
                             }
                             var logo ="<img src='{{asset('img/logoMAM.jpg')}}'style='width:70px;height:70px;float:left;'>"+
                                       "<h1 style='padding-left:130px;float:left;'>"+"Laboratory"+"</h1>"+"<br>"+"<br>"+
                                       "<h1 style='padding-left:100px;float:left;'>"+"Covid Test Result"+"</h1>";
                             var result_title= "<span style='padding-left:5px;float:left;'>"+"ID ::"+cid+
                             "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+"Fuchia ID::"+fuchiaID+
                             "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+"Date::"+vDate+"</span>"+
                                               "<span style='padding-left:5px;float:left;'>"+"Age(Y)::"+agey+
                                               "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+"Age(M)::"+agem+
                                               "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+"Gender::"+gender+"</span>";
                             var result_header ="<span style='padding-left:5px;float:left;'>"+"Requested Doctor::"+reqDoctor+
                                               "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
                                               "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" +"Counselor ::"+counselor+"</span>";
                           var result_body = "<br>"+"<table class='table table-sm'>"+
                               "<thead>"+
                                   "<tr>" +"<td>"+"Test Name"+"</td>"+"<td>"+"Result"+"</td>"+"<td>"+"</tr>"+
                               "</thead>"+
                               "<tbody>"+
                                   "<tr>"+"<td>"+"Age"+"</td>"+"<td>"+co_Age+"</td>"+"</td>"+"</tr>"+
                                   "<tr>"+"<td>"+"Type of Patient"+"</td>"+"<td>"+type_of_patient_covid+"</td>"+"</tr>"+
                                   "<tr>"+"<td>"+"Specimen type "+"</td>"+"<td>"+specimen_type +"</td>"+"</tr>"+
                                   "<tr>"+"<td>"+"Test Type"+"</td>"+"<td>"+co_test_type+"</td>"+"</tr>"+
                                   "<tr>"+"<td>"+"Result"+"</td>"+"<td>"+covid_result+"</td>"+"</tr>"+
                             "</tbody>"+
                           "</table>" ;
                           var result_footer="<span style='padding-left:5px;'>"+"Issue by- "+covid_lab_tech+
                           "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
                           "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
                              "Issue Date :"+covid_issue_date+ "</span>";
                           //$("#toshowResult").append(printTable);
                           $("#printLogo").append(logo);
                           //$("#printTestTitle").append(TestTitle);
                           $("#printPtInfo").append(result_title+result_header);
                           $("#printResultTable").append(result_body+result_footer);


                         //  $("#toshowResult").append(hivResultForm);
                           $("#header_bar").hide();
                           window.print();
                           $("#toshowResult").hide();
                           $("#header_bar").show();
                           $("#hider0").show();
                           $("#hider1").show();
                           location.reload(true);// to refresh the page
                         }
                       }
                      });
                    }else{
                           $("#noti").show();
                           document.getElementById('noti').innerHTML="Please input data first";
                         }
}

success:function(response){

   var ckUpdater = response[0][0]['name'];


     if(ckUpdater == 'updated'){
       console.log(ckUpdater);

       $("#hider0").hide();
       $("#hider1").hide();


       var logo ="<img src='{{asset('img/logoMAM.jpg')}}'style='width:70px;height:70px;float:left;'>"+
                 "<h1 style='padding-left:130px;float:left;'>"+"Laboratory"+"</h1>"+"<br>"+"<br>"+
                 "<h1 style='padding-left:100px;float:left;'>"+"HIV Test Result"+"</h1>";

     $("#printLogo").append(logo);
     alert('unFinished,Fuck!');
     //  window.print();
     //  location.reload(true);// to refresh the page

     }else{


         alert("You have collected test information of the patient.");
           $("#hider0").hide();
           $("#hider1").hide();
         if(isNaN(agem)){
           agem=0;
         }

         var logo ="<img src='{{asset('img/logoMAM.jpg')}}'style='width:70px;height:70px;float:left;'>"+
                   "<h1 style='padding-left:130px;float:left;'>"+"Laboratory"+"</h1>"+"<br>"+"<br>"+
                   "<h1 style='padding-left:100px;float:left;'>"+"HIV Test Result"+"</h1>";
         var result_title= "<span style='padding-left:5px;float:left;'>"+"ID ::"+cid+
         "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+"Fuchia ID::"+fuchiaID+
         "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+"Date::"+vDate+"</span>"+
         "<span style='padding-left:5px;float:left;'>"+"Age(Y)::"+agey+
         "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+"Age(M)::"+agem+
         "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+"Gender::"+gender+"</span>";
         var result_header ="<span style='padding-left:5px;float:left;'>"+"Requested Doctor::"+reqDoctor+
         "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
         "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" +"Counselor ::"+counselor+"</span>";
         var result_body = "<br>"+"<table class='table table-sm table-bordered'>"+
             "<thead>"+
                 "<tr>" +"<td>"+"Test Name"+"</td>"+"<td>"+"Result"+"</td>"+"</tr>"+
             "</thead>"+
             "<tbody>"+
                 "<tr id='tbrow'>"+"<td>"+"Determine Result"+"</td>"+"<td>"+d_result+"</td>"+"</tr>"+
                 "<tr id='tbrow'>"+"<td>"+"Uni-Gold Result"+"</td>"+"<td>"+uni_result+"</td>"+"</tr>"+
                 "<tr id='tbrow'>"+"<td>"+"Stat-Pak Result"+"</td>"+"<td>"+stat_result+"</td>"+"</tr>"+
                 "<tr id='tbrow'>"+"<td>"+"Final Result"+"</td>"+"<td>"+final_result+"</td>"+"</tr>"+
                 "<tr id='tbrow'>"+"<td>"+"Comment :"+"</td>"+"<td>"+comment+"</td>"+"</tr>"+
           "</tbody>"+
         "</table>" ;
         var result_footer="<span style='padding-left:5px;'>"+"Issue by- "+lab_tech+"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
         "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
            "Issue Date :"+issue_date+ "</span>";


         $("#printLogo").append(logo);

         $("#printPtInfo").append(result_title+result_header);

         $("#printResultTable").append(result_body+result_footer);

         $("#header_bar").hide();

         window.print();
         $("#toshowResult").hide();
         $("#header_bar").show();
         $("#hider0").show();
         $("#hider1").show();
         location.reload(true);// to refresh the page

   }

}
</script>

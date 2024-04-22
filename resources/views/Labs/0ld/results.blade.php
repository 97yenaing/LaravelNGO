@extends('layouts.app')
  <link rel="stylesheet" href="">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>

@section('content')
@auth
<body>
  <div class="container">
      <!--
        <h4> Exports </h4>
        <table class="table table-bordered">
        <thead>
            <tr>
                <th><button type="button" id="" onclick="" class="btn btn-info btn-lg">Hiv Test</button></th>
                <th><button type="button" id="" onclick="" class="btn btn-info btn-lg">RPR Test</button></th>
                <th><button type="button" id="" onclick="" class="btn btn-info btn-lg">STI Test</button></th>
                <th><button type="button" id="" onclick="" class="btn btn-info btn-lg">Hep B/C Test</button></th>
                <th><button type="button" id="" onclick="" class="btn btn-info btn-lg">Urine Test</button></th>
            </tr>
        </thead>
        <tbody>
                    <tr>
                        <td><button type="button" id="" onclick="" class="btn btn-info btn-lg">OI Test</button></td>
                        <td><button type="button" id="" onclick="" class="btn btn-info btn-lg">General Test</button></td>
                        <td><button type="button" id="" onclick="" class="btn btn-info btn-lg">Stool Test</button></td>
                        <td><button type="button" id="" onclick="" class="btn btn-info btn-lg">AFB Test</button></td>
                        <td><button type="button" id="" onclick="" class="btn btn-info btn-lg">Covid Test</button></td>

                    </tr>
        </tbody>
      </table> -->
    <div id="header0">
      <div class="row">
        <div class="">
          <h4>Report Calculations</h4>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-2">
          <label class="form-label">Test Name</label>
          <select class="form-control" id="test_name"  >
            <option value=""></option>
            <option value="hiv">HIV testing</option>
            <option value="rpr">PRP</option>
            <option value="hep_b_c">Hep B & C</option>
            <option value="sti">STI</option>
            <option value="tb_afb">TB AFB Tests</option>
            <option value="dengue">Dengue</option>
            <option value="malaria">Malaria</option>
            <option value="oi">OI</option>
            <option value="general">General test</option>
          </select><br>
        </div>
        <div class="col-sm-2">
          <label  class="form-label">From</label>
          <input id="d_from" type="date" autofocus  class="form-control"  required>
        </div>
        <div class="col-sm-2">
          <label for="validationCustom01" class="form-label">To</label>
          <input id="d_to" type="date" onchange="days_show()" class="form-control"  required>
        </div>
        <div class="col-sm-1">
          <label  class="form-label">Days</label>
          <input id="days_show" type="number"   class="form-control">
        </div>
        <div class="col-sm-1">
          <br>
          <button type="button"  id="" onclick="count()" class="btn btn-primary btn-lg ">Count</button>
        </div>
        <div class="col-sm-2">
          <br>
          <button type="button"  id="" onclick="clear_page()" class="btn btn-success btn-lg ">Clear</button>
        </div>
        <div class="col-sm-2">
          <br>
          <button type="button"  id="" onclick="hide()" class="btn btn-success btn-lg ">Hide to Print</button>
        </div>
      </div>
    </div>


      <div class="row">
        <div class='col-sm-12'id="reportSpace">  </div>
      </div>
      <div class="row">
        <div class='col-sm-12'id="reportSpace1">  </div>
      </div>



    </div>
  </body>
@endauth
@endsection
<script type="text/javascript">
  resp =[];
  function hide(){
    $('#header0').hide();
  }
  function days_show(){
    document.getElementById('days_show').value="";

    var date_from = document.getElementById('d_from').value;
    var date_to = document.getElementById('d_to').value;

    var dd_from = new Date(date_from);
    var dd_to = new Date(date_to);

    var daysCount= dd_to.getTime() - dd_from.getTime();
    var df_indays = (daysCount/(1000 * 3600 * 24))+1;

    document.getElementById('days_show').value= df_indays;
  }
  function count(){
    var testName= document.getElementById('test_name').value;
    var date_from = document.getElementById('d_from').value;
    var date_to = document.getElementById('d_to').value;
    let rp_data ={
      testName:testName,
      date_from:date_from,
      date_to:date_to,
    };
    $.ajaxSetup({
       headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
       }
     });
        $.ajax({
             type:'POST',
             url:"{{route('lab-results')}}",
             dataType:'json',
           //  processData:false,
             contentType:'application/json',
             data: JSON.stringify(rp_data),
             success:function(response){
               var test_namy = response[0];
               switch (test_namy) {
                 case 'hiv':
                    resp = response;
                    hiv_report_table(resp);
                   break;
                 case 'rpr':
                    resp = response;
                    rpr_report_table(resp);
                    break;
                case 'hep':
                    resp = response;
                    hep_report_table(resp);
                    break;
                case 'sti':
                    resp = response;
                    sti_report_table(resp);
                    break;
                case 'tb_afb':
                    resp = response;
                    tb_report_table(resp);
                    break;

                case 'dengue':
                    resp = response;
                    dengue_report_table(resp);
                    break;
                case 'malaria':
                    resp = response;
                    malaria_report_table(resp);
                    break;
                case 'oi':
                    resp = response;
                    oi_report_table(resp);
                    break;
                case 'general':
                    resp = response;
                    generalTest_report_table(resp);
                    break;
                 default:

               }
             }

              });
  }
  function clear_page(){
      location.reload(true);
  }
  function hiv_report_table(){
    var date_from = document.getElementById('d_from').value;
    var date_to = document.getElementById('d_to').value;
        var hivTotalCount = resp[1]+resp[2]+resp[3]+resp[4];
        var inconClusive  = resp[3]+resp[4];
        var from_to = "<h4>"+"HIV Testing Report"+"("+date_from+"     to    "+date_to+")"+"</h4>";
        var result_body = "<br>"+"<table class='table table-bordered'>"+
            "<thead>"+
                "<tr>" +"<td>"+"Total No"+"</td>"+"<td>"+"Positive"+"</td>"+"<td>"+"Negative"+"</td>"+"<td>"+"Inconclusive(Total)"+"<td>"+"Inconclusive(U+, S-)"+"<td>"+"Inconclusive(U-, S+)"+"</td>"+"</tr>"+
            "</thead>"+
            "<tbody>"+
                "<tr>"+"<td>"+hivTotalCount+"</td>"+"<td>"+resp[1]+"</td>"+"<td>"+resp[2]+"</td>"+"<td>"+inconClusive+"</td>"+"<td>"+resp[3]+"</td>"+"<td>"+resp[4]+"</td>"+"</tr>"+
          "</tbody>"+
        "</table>" ;
        $("#reportSpace").append(from_to+result_body);

  }
  function rpr_report_table(){
    var date_from = document.getElementById('d_from').value;
    var date_to = document.getElementById('d_to').value;
        var rprMale= resp[1]+resp[2];
        var rprFemale= resp[3]+resp[4];
        var rdt_male = resp[5]+resp[7];
        var rdt_female= resp[6]+resp[8];
        var from_to = "<h4>"+"RPR Testing Report"+"("+date_from+"     to    "+date_to+")"+"</h4>";
        var result_body = "<br>"+"<table class='table table-bordered'>"+
            "<thead>"+
                "<tr>" +"<td>"+"RPR"+"</td>"+"<td>"+"Total No"+"</td>"+"<td>"+"Reactive"+"</td>"+"<td>"+"Non reactive"+"</td>"+"<td>"+""+"<td>"+"Total Syphillis RDT"+"<td>"+"RDT positive"+"</td>"+"</tr>"+
            "</thead>"+
            "<tbody>"+
                "<tr>"+"<td>"+"Male"+"<td>"+rprMale+"</td>"+"</td>"+"<td>"+resp[1]+"</td>"+"<td>"+resp[2]+"</td>"+"<td>"+""+"</td>"+"<td>"+rdt_male+"</td>"+"<td>"+resp[5]+"</td>"+"</tr>"+
                "<tr>"+"<td>"+"Female"+"<td>"+rprFemale+"</td>"+"</td>"+"<td>"+resp[3]+"</td>"+"<td>"+resp[4]+"</td>"+"<td>"+""+"</td>"+"<td>"+rdt_female+"</td>"+"<td>"+resp[6]+"</td>"+"</tr>"+
          "</tbody>"+
        "</table>" ;
        $("#reportSpace").append(from_to+result_body);

  }
  function hep_report_table(){
    var date_from = document.getElementById('d_from').value;
    var date_to = document.getElementById('d_to').value;
        var from_to = "<h4>"+"Hep B & C Testing Report"+"("+date_from+"     to    "+date_to+")"+"</h4>";
        var result_body = "<br>"+"<table class='table table-bordered'>"+
            "<thead>"+
                "<tr>"
                  +"<td>"+"Hep B & C"+"</td>"+
                  "<td>"+"ANC"+"</td>"+
                  "<td>"+"SW"+"</td>"+
                  "<td>"+"MSM"+"</td>"+
                  "<td>"+"IDU"+"</td>"+
                  "<td>"+"Partners of KAP"+"</td>"+
                  "<td>"+"Clients of FSW"+"</td>"+
                  "<td>"+"Migrant"+"</td>"+
                  "<td>"+"Exposed child"+"</td>"+
                  "<td>"+"Low risk"+"</td>"+
                  "<td>"+"Total No"+"</td>"+
                "</tr>"+
            "</thead>"+
            "<tbody>"+
                "<tr>"+
                    "<td>"+"total HBs Ag test"+"</td>"+
                    "<td>"+resp[1]+"</td>"+
                    "<td>"+resp[2]+"</td>"+
                    "<td>"+resp[3]+"</td>"+
                    "<td>"+resp[4]+"</td>"+
                    "<td>"+resp[5]+"</td>"+
                    "<td>"+resp[6]+"</td>"+
                    "<td>"+resp[7]+"</td>"+
                    "<td>"+resp[8]+"</td>"+
                    "<td>"+resp[9]+"</td>"+
                    "<td>"+resp[19]+"</td>"+
                "</tr>"+
                "<tr>"+
                    "<td>"+"HBs Ag Positive"+"</td>"+
                    "<td>"+resp[10]+"</td>"+
                    "<td>"+resp[11]+"</td>"+
                    "<td>"+resp[12]+"</td>"+
                    "<td>"+resp[13]+"</td>"+
                    "<td>"+resp[14]+"</td>"+
                    "<td>"+resp[15]+"</td>"+
                    "<td>"+resp[16]+"</td>"+
                    "<td>"+resp[17]+"</td>"+
                    "<td>"+resp[18]+"</td>"+
                    "<td>"+resp[20]+"</td>"+

                "</tr>"+
                "<tr>"+
                    "<td>"+"Total HCV Ab test"+"</td>"+
                    "<td>"+resp[21]+"</td>"+
                    "<td>"+resp[22]+"</td>"+
                    "<td>"+resp[23]+"</td>"+
                    "<td>"+resp[24]+"</td>"+
                    "<td>"+resp[25]+"</td>"+
                    "<td>"+resp[26]+"</td>"+
                    "<td>"+resp[27]+"</td>"+
                    "<td>"+resp[28]+"</td>"+
                    "<td>"+resp[29]+"</td>"+
                    "<td>"+resp[30]+"</td>"+

                "</tr>"+
                "<tr>"+
                    "<td>"+"HCV Ab Positive"+"</td>"+
                    "<td>"+resp[32]+"</td>"+
                    "<td>"+resp[33]+"</td>"+
                    "<td>"+resp[34]+"</td>"+
                    "<td>"+resp[35]+"</td>"+
                    "<td>"+resp[36]+"</td>"+
                    "<td>"+resp[37]+"</td>"+
                    "<td>"+resp[38]+"</td>"+
                    "<td>"+resp[39]+"</td>"+
                    "<td>"+resp[40]+"</td>"+
                    "<td>"+resp[31]+"</td>"+
                "</tr>"+

          "</tbody>"+
        "</table>" ;
        $("#reportSpace").append(from_to+result_body);
  }
  function sti_report_table(){
    var date_from = document.getElementById('d_from').value;
    var date_to = document.getElementById('d_to').value;

        var from_to = "<h4>"+"STI (Female) Testing Report"+"("+date_from+"     to    "+date_to+")"+"</h4>";
        var result_body = "<br>"+"<table class='table table-bordered'>"+
            "<thead>"+
                "<tr>" +"<td>"+"Total No."+"</td>"+"<td>"+"GC (IE)"+"</td>"+"<td>"+"GC (E)Only"+"</td>"+"<td>"+"TV"+"<td>"+"Candida"+"<td>"+"Clue cell >20%"+"</td>"+"<td>"+"PMNL>20"+"</td>"+"</tr>"+
            "</thead>"+
            "<tbody>"+
                "<tr>"+"<td>"+resp[2]+"</td>"+"<td>"+resp[4]+"</td>"+"<td>"+resp[6]+"</td>"+"<td>"+resp[8]+"</td>"+"<td>"+resp[9]+"</td>"+"<td>"+resp[11]+"</td>"+"</tr>"+
          "</tbody>"+
        "</table>" ;
        $("#reportSpace").append(from_to+result_body);

        var from_to1 = "<h4>"+"STI (Male) Testing Report"+"("+date_from+"     to    "+date_to+")"+"</h4>";
        var result_body1 = "<br>"+"<table class='table table-bordered'>"+
            "<thead>"+
                "<tr>" +"<td>"+"Total No."+"</td>"+"<td>"+"GC (I)"+"</td>"+"<td>"+"GC (E)Only"+"</td>"+"<td>"+"TV"+"<td>"+"Candida"+"<td>"+"Clue cell >20%"+"</td>"+"<td>"+"PMNL>20"+"</td>"+"</tr>"+
            "</thead>"+
            "<tbody>"+
                  "<tr>"+"<td>"+resp[1]+"</td>"+"<td>"+resp[3]+"</td>"+"<td>"+resp[5]+"</td>"+"<td>"+resp[7]+"</td>"+"<td>"+""+"</td>"+"<td>"+resp[10]+"</td>"+"</tr>"+
          "</tbody>"+
        "</table>" ;
        $("#reportSpace1").append(from_to1+result_body1);
  }
  function tb_report_table(){
    var date_from = document.getElementById('d_from').value;
    var date_to = document.getElementById('d_to').value;

        var from_to = "<h4>"+"TB (Sputum) Testing Report"+"("+date_from+"     to    "+date_to+")"+"</h4>";
        var result_body = "<br>"+"<table class='table table-bordered'>"+
            "<thead>"+
                "<tr>" +"<td>"+"TB (Sputum)"+"</td>"+"<td>"+"Dx"+"</td>"+"<td>"+""+"</td>"+"<td>"+""+"</td>"+"<td>"+"F/U"+"<td>"+""+"<td>"+""+"</td>"+"</tr>"+
                  "<tr>" +"<td>"+""+"</td>"+"<td>"+"Total No"+"</td>"+"<td>"+"Positive"+"</td>"+"<td>"+"Negative"+"</td>"+"<td>"+"Total No."+"</td>"+"<td>"+"Positive"+"</td>"+"<td>"+"Negative.:"+"</td>"+"</tr>"+
            "</thead>"+
            "<tbody>"+
                "<tr>"+"<td>"+"Patient"+"</td>"+"<td>"+resp[5]+"</td>"+"<td>"+resp[1]+"</td>"+"<td>"+resp[2]+"</td>"+"<td>"+resp[6]+"</td>"+"<td>"+resp[3]+"</td>"+"<td>"+resp[4]+"</td>"+"</tr>"+

          "</tbody>"+
        "</table>" ;
        $("#reportSpace").append(from_to+result_body);

        var from_to1 = "<h4>"+"TB (Other) Testing Report"+"("+date_from+"     to    "+date_to+")"+"</h4>";
        var result_body1 = "<br>"+"<table class='table table-bordered'>"+
            "<thead>"+
                  "<tr>" +"<td>"+"TB (Other)"+"</td>"+"<td>"+"Lymph node"+"</td>"+"<td>"+"SSSmear"+"</td>"+"<td>"+"Pleural aspiration"+"</td>"+"<td>"+"Urine"+"</td>"+"<td>"+"Stool"+"</td>"+"<td>"+"CSF"+"</td>"+"</tr>"+
            "</thead>"+
            "<tbody>"+
                "<tr>"+"<td>"+"Total No"+"</td>"+"<td>"+resp[7]+"</td>"+"<td>"+resp[10]+"</td>"+"<td>"+resp[13]+"</td>"+"<td>"+resp[16]+"</td>"+"<td>"+resp[19]+"</td>"+"<td>"+resp[22]+"</td>"+"</tr>"+
                "<tr>"+"<td>"+"Positive"+"</td>"+"<td>"+resp[8]+"</td>"+"<td>"+resp[11]+"</td>"+"<td>"+resp[14]+"</td>"+"<td>"+resp[17]+"</td>"+"<td>"+resp[20]+"</td>"+"<td>"+resp[23]+"</td>"+"</tr>"+
                "<tr>"+"<td>"+"Negative"+"</td>"+"<td>"+resp[9]+"</td>"+"<td>"+resp[12]+"</td>"+"<td>"+resp[15]+"</td>"+"<td>"+resp[18]+"</td>"+"<td>"+resp[21]+"</td>"+"<td>"+resp[24]+"</td>"+"</tr>"+

          "</tbody>"+
        "</table>" ;
        $("#reportSpace").append(from_to1+result_body1);

        var from_to2 = "<h4>"+"TB LAM Testing Report"+"("+date_from+"     to    "+date_to+")"+"</h4>";
        var result_body2 = "<br>"+"<table class='table table-bordered'>"+
            "<thead>"+
                  "<tr>" +"<td>"+"Total No"+"</td>"+"<td>"+"Positive"+"</td>"+"<td>"+"Negative"+"</td>"+"</tr>"+
            "</thead>"+
            "<tbody>"+
                "<tr>"+"<td>"+resp[25]+"</td>"+"<td>"+resp[26]+"</td>"+"<td>"+resp[27]+"</tr>"+


          "</tbody>"+
        "</table>" ;
        $("#reportSpace").append(from_to2+result_body2);
  }
  function dengue_report_table(){
    var date_from = document.getElementById('d_from').value;
    var date_to = document.getElementById('d_to').value;

        var from_to = "<h4>"+"Dengue Testing Report"+"("+date_from+"     to    "+date_to+")"+"</h4>";
        var result_body = "<br>"+"<table class='table table-bordered'>"+
            "<thead>"+
                "<tr>" +"<td>"+"Total No."+"</td>"+"<td>"+"NS1(+)"+"</td>"+"<td>"+"IgG(+)"+"</td>"+"<td>"+"IgM(+)"+"</td>"+"<td>"+"NS1(+),IgG(+)"+"<td>"+"NS1(+),IgM(+)"+"<td>"+"IgG(+),IgM(+)"+"</td>"+
                "<td>"+"NS1(+),IgG(+),IgM(+)"+"</td>"+"</tr>"+
            "</thead>"+
            "<tbody>"+
                "<tr>"+"<td>"+resp[1]+"</td>"+"<td>"+resp[2]+"</td>"+"<td>"+resp[3]+"</td>"+"<td>"+resp[4]+"</td>"+"<td>"+resp[5]+"</td>"+"<td>"+resp[6]+"</td>"+"<td>"+resp[7]+"</td>"+"</tr>"+

          "</tbody>"+
        "</table>" ;
        $("#reportSpace").append(from_to+result_body);


  }
  function malaria_report_table(){
    var date_from = document.getElementById('d_from').value;
    var date_to = document.getElementById('d_to').value;

        var from_to = "<h4>"+"Malaria Testing Report"+"("+date_from+"     to    "+date_to+")"+"</h4>";
        var result_body = "<br>"+"<table class='table table-bordered'>"+
            "<thead>"+
                "<tr>" +"<td>"+"Malaria"+"</td>"+"<td>"+"Total"+"</td>"+"<td>"+"PF"+"</td>"+"<td>"+"Mix"+"</td>"+"<td>"+"Non PF(pv,po,pm)"+"<td>"+"</tr>"+
            "</thead>"+
            "<tbody>"+
                "<tr>"+"<td>"+"RDT"+"</td>"+"<td>"+resp[1]+"</td>"+"<td>"+resp[2]+"</td>"+"<td>"+resp[3]+"</td>"+"<td>"+resp[4]+"</td>"+"</tr>"+
                "<tr>"+"<td>"+"Microscopy"+"</td>"+"<td>"+resp[11]+"</td>"+"<td>"+resp[5]+"</td>"+"<td>"+resp[6]+"</td>"+resp[7]+"</td>"+"</tr>"+
                "<tr>"+"<td>"+"RDT,Microscopy"+"</td>"+"<td>"+resp[12]+"</td>"+"<td>"+resp[8]+"</td>"+"<td>"+resp[9]+"</td>"+resp[10]+"</td>"+"</tr>"+
          "</tbody>"+
        "</table>" ;
        $("#reportSpace").append(from_to+result_body);
  }
  function oi_report_table(){
    var date_from = document.getElementById('d_from').value;
    var date_to = document.getElementById('d_to').value;

        var from_to = "<h4>"+"Oi Testing Report"+"("+date_from+"     to    "+date_to+")"+"</h4>";
        var result_body = "<br>"+"<table class='table table-bordered'>"+
            "<thead>"+
                "<tr>" +"<td>"+"OI Test"+"</td>"+"<td>"+"Total No."+"</td>"+"<td>"+"Positive"+"</td>"+"<td>"+"Negative"+"</td>"+"</tr>"+
            "</thead>"+
            "<tbody>"+
                "<tr>"+"<td>"+"Serum Crypto Ag test"+"</td>"+"<td>"+resp[3]+"</td>"+"<td>"+resp[1]+"</td>"+"<td>"+resp[2]+"</td>"+"</tr>"+
                "<tr>"+"<td>"+"CSF Crypto Ag test"+"</td>"+"<td>"+resp[6]+"</td>"+"<td>"+resp[4]+"</td>"+"<td>"+resp[5]+"</td>"+"</tr>"+
          "</tbody>"+
        "</table>" ;
        $("#reportSpace").append(from_to+result_body);

        var from_to1 = "<h4>"+"AFB Testing Report"+"("+date_from+"     to    "+date_to+")"+"</h4>";
        var result_body1 = "<br>"+"<table class='table table-bordered'>"+
            "<thead>"+
                  "<tr>" +"<td>"+"Crypto Microscopy"+"</td>"+"<td>"+"Total No."+"</td>"+"<td>"+"Stain  Smear"+"</td>"+"<td>"+"India Ink"+"</td>"+"</tr>"+
            "</thead>"+
            "<tbody>"+
            "<tr>"+"<td>"+"CSF"+"</td>"+"<td>"+resp[11]+"</td>"+"<td>"+resp[7]+"</td>"+"<td>"+resp[8]+"</td>"+"</tr>"+
            "<tr>"+"<td>"+"Skin"+"</td>"+"<td>"+resp[12]+"</td>"+"<td>"+resp[9]+"</td>"+"<td>"+resp[10]+"</td>"+"</tr>"+
            "<tr>"+"<td>"+"Lymph"+"</td>"+"<td>"+resp[15]+"</td>"+"<td>"+resp[13]+"</td>"+"<td>"+resp[14]+"</td>"+"</tr>"+
          "</tbody>"+
        "</table>" ;
        $("#reportSpace").append(from_to1+result_body1);
  }
  function generalTest_report_table(){
    var date_from = document.getElementById('d_from').value;
    var date_to = document.getElementById('d_to').value;

        var from_to = "<h4>"+"General Testing Report"+"("+date_from+"     to    "+date_to+")"+"</h4>";
        var result_body = "<br>"+"<table class='table table-bordered'>"+
            "<thead>"+
                "<tr>" +"<td>"+"General Tests"+"</td>"+"<td>"+"Total No."+"</td>"+"</tr>"+

            "</thead>"+
            "<tbody>"+
                "<tr>" +"<td>"+"Urine Dip"+"</td>"+"<td>"+resp[1]+"</td>"+"</tr>"+
                "<tr>" +"<td>"+"Stool"+"</td>"+"<td>"+resp[3]+"</td>"+"</tr>"+
                "<tr>" +"<td>"+"RBS"+"</td>"+"<td>"+resp[4]+"</td>"+"</tr>"+
                "<tr>" +"<td>"+"FBS"+"</td>"+"<td>"+resp[5]+"</td>"+"</tr>"+
                "<tr>" +"<td>"+"Hb%"+"</td>"+"<td>"+resp[6]+"</td>"+"</tr>"+
                "<tr>" +"<td>"+"Urine 2 CE"+"</td>"+"<td>"+''+"</td>"+"</tr>"+
                "<tr>" +"<td>"+"Urine RE"+"</td>"+"<td>"+resp[2]+"</td>"+"</tr>"+
                "<tr>" +"<td>"+"Hb A1c"+"</td>"+"<td>"+resp[7]+"</td>"+"</tr>"+
                "<tr>" +"<td>"+"Toxo"+"</td>"+"<td>"+resp[8]+"</td>"+"<td>"+'IgG => '+resp[9]+"</td>"+"<td>"+'IgM => '+resp[10]+"</td>"
                +"<td>"+'IgG,IgM => '+resp[11]+"</td>"+"</tr>"


          "</tbody>"+
        "</table>" ;
        $("#reportSpace").append(from_to+result_body);


  }

</script>

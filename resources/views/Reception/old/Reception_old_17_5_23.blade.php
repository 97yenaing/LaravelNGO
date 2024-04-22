@extends('layouts.app')
@stack('css')
@auth
@section('content')
<body >
<p class="btn-gnavi">
				<span></span>
				<span></span>
				<span></span>
			</p>
  <div class="container containers">
  <ul class="nav nav-tabs toggle  reception-list" id="hidden-title" >
        <li class="nav-item">
          <a class="nav-link active toggle-link " data-toggle="tab" href="#reception" >Add New / Follow Up</a>
        </li>
        <li class="nav-item">
          <a class="nav-link toggle-link" data-toggle="tab" href="#return" >Diagnosis Data</a>
        </li>
        <li class="nav-item">
          <a class="nav-link toggle-link" data-toggle="tab" href="#next" >Next Appointment list</a>
        </li>
        <li class="nav-item">
          <a class="nav-link toggle-link" data-toggle="tab" href="#follow" >Follow up history</a>
        </li>
      </ul> <!-- *adding containers clss -->
    <div style="margin:auto" id="toshowResult"></div>
  <div id="hider0" class="container containers page-color" >  <!-- *adding containers clss -->

    <div class="tab-content">
      <div class="tab-pane container containers active" id="reception">
          <div class="row justify-content-center">
          <div class="col-md-12 "  >
              <h2 class="header-text">Registration,Follow Up<br class="mobile"> and Update Page</h2>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-4 clearfix">
            <p style="float:left;">Response :</p> <p style="float:left;" id="responseText"></p>
          </div>

        </div>
          <div class="row">
            <div class="col-md-2 reception-geneFun"> <!-- style="margin-left:50px; -->
              <input  type="text" class="form-control" id="search_id" placeholder="General ID or Fuchia ID" >
            </div>
            <div class="col-md-2 reception-s-update-div ">
            <button  class="btn  s-t-update update-batton" onclick="searchID()">Search to Update</button>  <!-- *Remover class btn-warning -->
            </div>
            @foreach($lastPt as $key => $value)
            <div class="col-md-3 reception-laID">
              <label class="form-control reception-laID-label" id="lastID">  Last ID ({{ $value -> Pid}})

              <a  class="reception-neID" >Next ID</a>   <a id="nextID" onclick="idgiven()" style="color:red;">{{ $value -> Pid+1}}</a>
                </label>
            </div><br class="tablet">
          @endforeach

            <div class="col-md-1 reception-clinic" >
              <!-- <label id="clinic_code">Clinic:{{ Auth::user()->clinic }}</label> -->
              <button  class="btn btn-success reception-refresh refresh-follow" onclick="refresh()">Refresh</button>
            </div>


          </div><br>
              <div class="row">

                <div class="col-md-2 reception-code1">
                    <label for="validationCustom01" class="form-label">General ID</label>
                  <div class="input-group mb-3">
                      <input type="number" autofocus id="gid" class="form-control" >

                      <div class="input-group-append no-margin">
                        <button class="btn btn-primary reception-serach" onclick="ptData()" type="button">Search</button>
                      </div>
                  </div>
                </div>
                <div class="col-md-2 reception-code2">
                    <label for="validationCustom01" class="form-label">Fuchia ID</label>
                  <div class="input-group mb-3">
                      <input type="text" id="fid" class="form-control" >
                      <div class="input-group-append no-margin">
                        <button class="btn btn-primary reception-serach" onclick="searchFuchiaID()" type="button">Search</button>
                      </div>
                  </div>
                </div>
                <div class="col-md-2 reception-pfn">
                  <label  class="form-label">PrEP Code</label>
                  <input type="text" id="prepCode" placeholder='Pr/049/B0000/23'class="form-control" required>
                </div> <br class="tablet">
                <div class="col-md-2 reception-pfn">
                  <label  class="form-label">Name</label>
                  <input type="text" id="name" class="form-control" required>
                </div>
                <div class="col-md-2 reception-pfn  reception-father ">
                  <label  class="form-label">Father's Name</label>
                  <input type="text" id="father" class="form-control" required>
                </div>
                <div class="col-md-2 reception-gender">
                  <label  class="form-label">Sex</label>
                  <select class="form-select reception-select" id="gender"required>
                    <option value=""></option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                  </select>
                </div>
              </div>
              <div class="row recepatient-info">
                <div class="col-md-2 reception-visitDate">
                  <label  class="form-label">Date Of Birth</label>
                  <div class="input-group mb-3">
                      <input  type="date"  id="dob" onblur="dateOfBirth_to_age()" class="form-control reception-dateformat">
                  </div>
                </div>
                <div class="col-md-1 reception-age" >
                  <label for="validationCustom02" class="form-label">Age(Year)</label>
                  <input type="number" id="agey" class="form-control"  >
                  <div class="valid-feedback">
                    plz put patient age.
                  </div>
                </div>
                <div class="col-md-1">
                  <label for="validationCustom02" class="form-label">Age(Month)</label>
                  <input type="number" id="agem" onchange="monthValid()" class="form-control" >
                  <div class="valid-feedback">
                    plz put patient age.
                  </div>
                </div>
                <div class="col-md-2 consulor-mainrisk">
                  <label for="">Main Risk</label>
                  <select class="form-control" id="main_risk" onchange="PatientType()" >
                    <option selected  value="-"></option>
                    <option id="preg_mom" value="Pregnant Mother">Pregnant Mother</option>
                    <option id="sp_preg_mom" value="Spouse of pregnant mother">Spouse of pregnant mother</option>
                    <option id="" value="Exposed Children">Exposed Children</option>
                    <option id="" value="Low Risk">Low Risk</option>
                    <option id="" value="PWUD">PWUD</option>
                    <option id="fsw" value="FSW">FSW</option>
                    <option id="cl_fsw" value="Client of FSW">Client of FSW</option>
                    <option id="msm" value="MSM">MSM</option>
                    <option id="" value="IDU">IDU</option>
                    <option id="tg" value="TG">TG</option>
                    <option id="pt_kp" value="Partner of KP">Partner of KP</option>
                    <option id="pt_kp_plhiv" value="Partner of PLHIV">Partner of PLHIV</option>
                    <option id="" value="Special Groups">Special Groups</option>
                    <option value="Migrant Population">Migrant Population</option>
                  </select>
                </div>
                <div class="col-sm-2 consulor-subrisk" >
                  <label for="">Sub Risk</label>
                    <select class="form-control" id="sub_risk"  >
                    <option selected value="-"></option>
                    <option value="PP">PP</option>
                    <option value="MP">MP</option>
                    <option value="HIV(Pos)">HIV(Pos)</option>
                    <option value="HIV(Neg)Woman">HIV(Neg)Woman</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="Youth(15-24)">Youth(15-24)</option>
                    <option value="Other Low Risk">Other Low Risk</option>
                    <option value="FSW_PWID">FSW_PWID</option>
                    <option value="FSW_PWUD">FSW_PWUD</option>
                    <option value="MSM_PWID">MSM_PWID</option>
                    <option value="MSM_PWUD">MSM_PWUD</option>
                    <option value="PWID_FSW">PWID_FSW</option>
                    <option value="PWID_MSM">PWID_MSM</option>
                    <option value="TG_PWID">TG_PWID</option>
                    <option value="TG_PWUD">TG_PWUD</option>
                    <option value="TG_SW">TG_SW</option>
                    <option value="Partner of PWID">Partner of PWID</option>
                    <option value="Partner of FSW">Partner of FSW</option>
                    <option value="Female of MSM">Female of MSM</option>
                    <option value="TB Patient">TB Patient</option>
                    <option value="Institutionalize">Institutionalize</option>
                    <option value="Uniformed Services Personnel">Uniformed Services Personnel</option>
                  </select>

                </div>


                <div class="col-sm-2 reception-region">
                  <label for="validationCustom02" class="form-label">State/ Region</label>
                  <div>
                    <select  class="form-select reception-select"  id="state"   onchange="region(this.value)">
                      <option selected disabled value="">Choose....................</option>
                      <option value="Ayeyarwady">Ayeyarwady</option>
                      <option value="Bago(East)">Bago(East)</option>
                      <option value="Bago(West)">Bago(West)</option>
                      <option value="Chin">Chin</option>
                      <option value="Kachin">Kachin</option>
                      <option value="Kayah">Kayah</option>
                      <option value="Kayin">Kayin</option>
                      <option value="Mgway">Mgway</option>
                      <option value="Mandalay">Mandalay</option>
                      <option value="Mon">Mon</option>
                      <option value="NaypyiTaw">NaypyiTaw</option>
                      <option value="Rakhine">Rakhine</option>
                      <option value="Sagaing">Sagaing</option>
                      <option value="Shan(East)">Shan(East)</option>
                      <option value="Shan(North)">Shan(North)</option>
                      <option value="Shan(South)">Shan(South)</option>
                      <option value="Tanintharyi">Tanintharyi</option>
                      <option value="Yangon">Yangon</option>
                    </select>
                  </div>
                </div>
                <div class="col-sm-2 reception-township" >
                  <label for="validationCustom02" class="form-label">Township</label>
                  <div>
                    <select class="form-select reception-select" id="tt"  >
                      <option id="tt_opt"></option>
                      <option selected disabled value="">Choose...............</option>
                      <option value="Insein">Insein</option><option value="MingalarDon" >MingalarDon</option><option value= "Hmawbi">Hmawbi</option>
                      <option value="Hlegu">Hlegu</option><option value="Taikkyi" >Taikkyi</option><option value="Htantabin" >Htantabin</option>
                      <option value="Shwepyithar">Shwepyithar</option><option value= "Hlaingtharya">Hlaingtharya</option><option value="Thingangyun" >Thingangyun</option>
                      <option value= "Yankin">Yankin</option><option value= "South Okkalapa">South Okkalapa</option><option value= "North Okkalapa">North Okkalapa</option>
                      <option value= "Thaketa">Thaketa</option><option value="Dawbon">Dawbon</option><option value="Tamwe" >Tamwe</option>
                      <option value= "Pazundaung">Pazundaung</option><option value= "Botahtaung">Botahtaung</option><option value="Dagon Myothit (South)" >Dagon Myothit (South)</option>
                      <option value= "Dagon Myothit (North)">Dagon Myothit (North)</option><option value="Dagon Myothit (East)">Dagon Myothit (East)</option>
                      <option value= "Dagon Myothit (Seikkan)">Dagon Myothit (Seikkan)</option><option value= "Mingalartaungnyunt">Mingalartaungnyunt</option>
                      <option value= "Thanlyin">Thanlyin</option><option value= "Kyauktan">Kyauktan</option><option value= "Thongwa">Thongwa</option>
                      <option value= "Kayan">Kayan</option><option value= "Twantay">Twantay</option><option value= "Kawhmu">Kawhmu</option>
                      <option value= "Kungyangon">Kungyangon</option><option value= "Dala">Dala</option><option value= "Seikgyikanaungto">Seikgyikanaungto</option>
                      <option value= "Cocokyun">Cocokyun</option><option value= "Kyauktada">Kyauktada</option><option value= "Pabedan">Pabedan</option>
                      <option value= "Lanmadaw">Lanmadaw</option><option value="Latha" >Latha</option><option value= "Ahlone">Ahlone</option>
                      <option value= "Kyeemyindaing">Kyeemyindaing</option><option value="Sanchaung" >Sanchaung</option><option value= "Hlaing">Hlaing</option>
                      <option value= "Kamaryut">Kamaryut</option><option value= "Mayangone">Mayangone</option><option value= "Dagon">Dagon</option>
                      <option value= "Bahan">Bahan</option><option value= "Seikkan">Seikkan</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-2 reception-visitDate">
                  <label  class="form-label">Visit Date</label>
                  <input type="date" onblur="dateOver(2)" id="vDate" class="form-control" required  >
                </div>
              </div>


              <div class="row">
                <div class="col-sm-2 reception-re-fo">
                    <button type="button" id="regbutton" onclick="send()" class="btn btn-primary reception-register">Register</button>
                    <button type="button" id="followBton" onclick="send_fup()" class="btn btn-info reception-follow refresh-follow">Follow Up</button>
                    <button type="button" id="updateBton" onclick="update_reg()" class="btn update-batton">Update</button>
                </div>
              </div>



      </div>

      <div class="tab-pane container containers fade" id="return">

       @csrf
        <div class="row justify-content-center">
          <div class="col-md-12 "  >
              <h2 class="header-text">Diagnosis and Next Appointment Date</h2>
          </div>
        </div><br>
        <div class="row">
          <div class="col-sm-4 clearfix">
            <p style="float:left;">Response :</p> <p style="float:left;" id="responseText"></p>
          </div>
        </div>
        <div class="row ">      <!-- justify-content-center -->
								<div class="col-md-3 reception-code1">
                    <label for="validationCustom01" class="form-label">General ID</label>
                  <div class="input-group mb-3">
                      <input type="number" autofocus id="gid_return" class="form-control" >

                      <div class="input-group-append no-margin">
                        <button class="btn btn-primary reception-serach" onclick="ptData_return()" type="button">Search</button>
                      </div>
                  </div>
                </div>
                <div class="col-md-3 reception-code2">
                    <label for="validationCustom01" class="form-label">Fuchia ID</label>
                  <div class="input-group mb-3">
                      <input type="text" id="fid_return" class="form-control" >
                      <div class="input-group-append no-margin">
                        <button class="btn btn-primary reception-serach" onclick="searchFuID()" type="button">Search</button>
                      </div>
                  </div>
                </div>
                <div class="col-sm-2 return-input">
                  <label for="validationCustom01" class="form-label">Visit Date</label>
                  <input id="fup_date" onblur="dateOver(3)" type="date"  class="form-control" id="validationCustom01">
                  <div class="valid-feedback">
                    Plz put Patient's Issue Date.
                  </div>
                </div>
                <div class="col-sm-2 return-input ">
                  <label for="validationCustom01" class="form-label">Next Appointment Date</label>
                  <input id="nDate" type="date" value="" class="form-control"  >
                  <div class="valid-feedback">
                    Plz put Patient's Visit Date.
                  </div>
                </div>
              </div>
              <div class="row clearfix">
              <div class="col-md-3 reception-reason-visit clearfix">
                <label for="validationCustom02" class="form-label reception-consu-label">Type of Consultation</label>
                <ul class=" reception-consu-ul clearfix ">
                <li class="reception-show" onclick="show_1_row()"><img src="../img/plus-square-fill.svg" alt="icon"></i></li>
                </ul>
                <div>
                  <select  class="form-select reception-select"  id="Ptype" required onchange="Consulation()">
                    <option selected disabled value="">Choose....................</option>
                    <option value="PHA">PHA</option>
                    <option value="ART">ART</option>
                    <option value="PrEP">PrEP</option>
                    <option value="PMTCT">PMTCT</option>
                    <option value="ANC">ANC</option>
                    <option  value="FP">Family Planning</option>
                    <option value="FC">Feeding Centre</option>
                    <option value="General">General</option>
                    <option value="lab_iv_only"> Lab Investigation Only</option>
                  </select>
                </div>
              </div>
              <div class="col-md-1 reception-newOld">
                <label  class="form-label new-old" >New/Old</label>
                <select class="form-select reception-select" id="new_old"required>
                  <option value=""></option>
                  <option value="New">New</option>
                  <option value="Old">Old</option>
                </select>
              </div>
              <div id="sub_category_box" class="col-md-8 sub_category_box clearfix">
              </div>

            </div>
            <br>
            <div class="row" id="add_more1" style="display:none">
              <div class="col-md-2 reception-reason-visit reception-add-select">
                <label for="validationCustom02" class="form-label reception-consu-label">Type of Consultation</label>
                <ul class=" reception-consu-ul clearfix">
                <li class="reception-show" onclick="remove_1_row()"><img src="../img/dash-square-fill.svg" alt="remove_icon"></i></li>
                </ul>
                <div>
                  <select  class="form-select reception-select"  id="Ptype_1" required onchange="Consulation1()">
                    <option selected disabled value="">Choose....................</option>
                    <!-- <option value="PHA">PHA</option>
                    <option value="ART">ART</option> -->
                    <option value="PrEP">PrEP</option>
                    <option value="PMTCT">PMTCT</option>
                    <option value="ANC">ANC</option>
                    <option  value="FP">Family Planning</option>
                    <option value="FC">Feeding Centre</option>
                    <option value="General">General</option>
                    <option value="lab_iv_only"> Lab Investigation Only</option>
                  </select>
                </div>
              </div>
              <div class="col-md-2 reception-newOld">
                <label  class="form-label new-old">New/Old</label>
                <select class="form-select reception-select tablet-newold" id="new_old_1"required>
                  <option value=""></option>
                  <option value="New">New</option>
                  <option value="Old">Old</option>
                </select>
              </div>
              <div id="sub_category_box_1" class="col-md-8 sub_category_box">
              </div><br>

            </div>
            <!-- <div class="row" id="add_more2">
              <div class="col-md-2 reception-reason-visit reception-add-select">
                <label for="validationCustom02" class="form-label reception-consu-label">Type of Consultation</label>
                <ul class=" reception-consu-ul clearfix">
                <li class="reception-show" onclick="remove_2_row()"><i class="bi bi-dash-square-fill"></i></li>
              </ul>
                <div>
                  <select  class="form-select reception-select"  id="Ptype_2" required onchange="Consulation2()">
                    <option selected disabled value="">Choose....................</option>
                    <option value="PHA">PHA</option>
                    <option value="ART">ART</option>
                    <option value="PrEP">PrEP</option>
                    <option value="PMTCT">PMTCT</option>
                    <option value="ANC">ANC</option>
                    <option  value="FP">Family Planning</option>
                    <option value="FC">Feeding Centre</option>
                    <option value="General">General</option>
                    <option value="lab_iv_only"> Lab Investigation Only</option>
                  </select>
                </div>
              </div>
              <div class="col-md-2 reception-gender">
                <label  class="form-label new-old">New/Old</label>
                <select class="form-select reception-select" id="new_old_2"required>
                  <option value=""></option>
                  <option value="New">New</option>
                  <option value="Old">Old</option>
                </select>
              </div>
              <div id="sub_category_box_2" class="col-md-8 sub_category_box">
              </div>

            </div> <br> -->

              <div class="row">
                <div class="col-sm-11"></div>
                <div class="col-sm-1 return-save">
                  <button type="button" id="updateBton" onclick="save()" class="btn btn-warning  update-batton">Save</button>
                </div>
              </div>
      </div>

      <div class="tab-pane container containers fade" id="next">
          @csrf
        <div>
          <div>
              <h2 class="header-text">Next Appointment Lists</h2>
          </div>
        </div><br>

          <div class="row reception-appointmentInfo ">
            <div class="col-sm-2 appointment-text ">
              <label for="validationCustom01" class="form-label appointment-label">Next Appointment Date</label>
            </div>
            <div class="col-sm-2 appointment-date">
              <input id="ndate" type="date" autofocus class="form-control" id="validationCustom01">
              <div class="valid-feedback">
                Plz put Patient's Issue Date.
              </div>
            </div>
            <div class="col-sm-3 appointemt-search">
              <label for="validationCustom01" class="form-label">Type</label>



                <select  class="form-select reception-select"  id="visit_type"  required >
                  <option selected disabled value="">Choose....................</option>
                  <option value="PHA">PHA</option>
                  <option value="ART">ART</option>
									<option value="PrEP">PrEP</option>
                  <option value="STI">STI</option>
                  <option value="FC">Feeding Centre</option>
                  <option value="General">General</option>
                  <option value="PMTCT">PMTCT</option>
                  <option value="ANC">ANC</option>
                  <option value="<15">< 15</option>
                  <option value="lab_iv_only"> Lab Investigation Only</option>
                </select>

            </div>
            <div class="col-sm-1 next-serachBatton">
              <button type="button" id="updateBton" onclick="search_nextAppointment()" class="btn btn-primary appointment-serach reception-select">Search</button>
            </div>
          </div>
          <div class="row justify-content-center appointment-table">
            <h4 id='total_len'></h4>
            <table class="table table-bordered">
              <thead>
                <tr>
                <th>Serial</th>
                  <th>General ID</th>
                  <th>Fuchia ID</th>
                  <th>PrEP ID</th>
                  <th>Next Appointment Date</th>
                </tr>
              </thead>
              <tbody id='list'>
              </tbody>
            </table>
          </div>

      </div>

      <div class="tab-pane container containers fade" id="follow">
        <div class="page-color">
        <div>

            <h2 class="header-text">Test History Of the Patient</h2>

        </div>
        <div class="row reception-followSection" style="margin:auto;">
          <div class="col-md-3">
            <input id="id_hist" type="text" autofocus  class="form-control" placeholder="Patient's ID" required>
              <div class="valid-feedback">
                Plz put Patient's ID.
              </div>
          </div>
          <div class="col-md-3">
                <button type="button"  onclick="followupHistory()" class="btn btn-primary btn-lg">Search Follow up History</button>
          </div>
        </div>
        <br>
        <div class="row " style="margin:auto;">
          <div class="mobile" id="followupHistory-mobile"></div>
          <div class="tablet" id="followupHistory-tablet">
          </div>
          <div class="col-md-12 pc">
            <table class="table table-hover table-bordered" >
              <thead>
                <tr class="follow-table">
                  <th >No.</th>
                  <th>Row-ID</th>
                  <th>Visit Date</th>
                  <th>General ID</th>
                  <th>Fuchia ID</th>
                  <th>PrEPCode</th>
                  <th>Age</th>
                  <th>Sex</th>
                </tr>
              </thead>
              <tbody id="followupHistory" calss="tablet-pc">
            </table>
          </div>
        </div>
        </div>



        <div id="updatePageView" class="container containers" style="display:none"> <!-- *adding containers clss -->
          <div style="margin:auto" id="toshowResult"></div>
          <div  class="container containers page-color" >  <!-- *adding containers clss -->
            <br>
          <!--   <form class="" id="reg" method="post" > -->

            <div class="row justify-content-center">
              <div class="col-md-12 "  >
                  <h2 class="header-text">Follow Up Update Page</h2>
              </div>
            </div><br>
            <div class="row">
              <div class="col-sm-4 clearfix">
                <p style="float:left;">Response :</p> <p style="float:left;" id="responseText"></p>
              </div>
            </div>
            <div class="row">

                  <div class="col-sm-2 reception-code1">
                      <label for="validationCustom01" class="form-label">General ID</label>
                    <div class="input-group mb-3">
                        <input type="number" autofocus id="gid_toupdate" class="form-control" >

                        <div class="input-group-append no-margin">
                          <button class="btn btn-primary reception-serach"  type="button">Search</button>
                        </div>
                    </div>
                  </div>
                  <div class="col-sm-2 reception-code2">
                      <label for="validationCustom01" class="form-label">Fuchia ID</label>
                    <div class="input-group mb-3">
                        <input type="text" id="fid_toupdate" class="form-control" >
                        <div class="input-group-append no-margin">
                          <button class="btn btn-primary reception-serach"  type="button">Search</button>
                        </div>
                    </div>
                  </div>
                  <div class="col-md-2 receptionFollow-pfn">
                    <label  class="form-label">PrEP Code</label>
                    <input type="text" id="prepCode_toupdate" placeholder='Pr/049/B0000/23'class="form-control" required>
                  </div> <br class="tablet">
                  <div class="col-md-2 receptionFollow-visitDate">
                    <label  class="form-label">Visit Date</label>
                    <input type="date" onblur="dateOver(4)" id="vDate_toupdate" class="form-control" required  >
                  </div>
                  <div class="col-md-2 receptionFollow-gender">
                    <label  class="form-label">Sex</label>
                    <select class="form-select reception-select" id="gender_toupdate"required>
                      <option value="-"></option>
                      <option value="Male">Male</option>
                      <option value="Female">Female</option>
                    </select>
                  </div>
                  <div class="col-md-1 receptionFollow-ageYear">
                    <label for="validationCustom02" class="form-label">Age(Year)</label>
                    <input type="number" id="agey_toupdate" class="form-control" >
                    <div class="valid-feedback">
                      plz put patient age.
                    </div>
                  </div>
                  <div class="col-md-1 receptionFollow-ageMonth">
                    <label for="validationCustom02" class="form-label">Age(Month)</label>
                    <input type="number" id="agem_toupdate" class="form-control" >
                    <div class="valid-feedback">
                      plz put patient age.
                    </div>
                  </div>
                </div>
              <div class="row">
                      <div class="col-md-2 receptionFollow-consult">
                        <label for="">Type of Consultation</label>
                        <select  class="form-select reception-select"  id="Ptype_toupdate" >
                          <option value="-"></option>
                          <option value="PHA">PHA</option>
                          <option value="ART">ART</option>
                          <option value="PrEP">PrEP</option>
                          <option value="PMTCT">PMTCT</option>
                          <option value="ANC">ANC</option>
                          <option  value="FP">Family Planning</option>
                          <option value="FC">Feeding Centre</option>

                          <option value="lab_iv_only"> Lab Investigation Only</option>
                        </select>
                      </div>

                    <div class="col-md-1 receptionFollow-newOld">
                      <label >New/Old</label>
                      <select class="form-select" id="new_old_toupdate"required>
                        <option value="-"></option>
                        <option value="New">New</option>
                        <option value="Old">Old</option>
                      </select>
                    </div>
                    <div class="col-md-3 receptionFollow-refer">
                      <label    >Refer to Fever Team</label>
                      <select class="form-select" id="sub_1_toupdate"required>
                        <option value="-"></option>
												<option value="MAM_Cohort_Yes">MAM Cohort - Yes</option>
												<option value="MAM_Cohort_No">MAM Cohort - No</option>
												<option value="Ref_Fever_No">Refer to Fever Team - No</option>
												<option value="Ref_Fever_Yes">Refer to Fever Team - Yes</option>
                      </select>
                    </div>
                    <div class="col-md-3 receptionFollow-category ">
                      <label    >Diseases Category</label>
                      <select class="form-select" id="sub_2_toupdate"required>
												<option value="-"></option>
												<option value="1. HIV (-) TB">1. HIV (-) TB</option>
												<option value="2. Hypertension only">2. Hypertension only</option>
												<option value="3. Diabetes only">3. Diabetes only</option>
												<option value="4. H/T & DM commodities">4. H/T & DM commodities</option>
												<option value="5. RTI(< 2wks)">5. RTI(< 2wks)</option>
												<option value="6. RTI(>=2wks)">6. RTI(>=2wks)</option>
												<option value="7. Obstructive Pul. D/s">7. Obstructive Pul. D/s</option>
												<option value="8. NCD/ Cerebrovascular diseases (CVD)">8. NCD/ Cerebrovascular diseases (CVD)</option>
												<option value="9. Renal D/s">9. Renal D/s</option>
												<option value="10. GI & Hepatobiliary">10. GI & Hepatobiliary</option>
												<option value="11. Gynaecology">11. Gynaecology</option>
												<option value="12. Musculoskeleton and rheumatology">12. Musculoskeleton and rheumatology </option>
												<option value="13. Skin infection">13. Skin infection</option>
												<option value="14. Covid related consultation">14. Covid related consultation</option>
												<option value="15. TB related consultation">15. TB related consultation</option>
												<option value="16. Sexual violence">16. Sexual violence</option>
												<option value="17. STI">17. STI</option>
												<option value="18. DF">18. DF</option>
												<option value="19. Malnourished">19. Malnourished</option>
												<option value="20. Child Abuse">20. Child Abuse</option>
												<option value="21. Others">21. Others</option>
                      </select>
                    </div>
                    <div class="col-md-3 receptionFollow-supply">
                      <label    >Supply</label>
                      <select class="form-select" id="sub_3_toupdate"required>
                        <option value="-"></option>
                        <option value="Drug supply by MAM-Yes">Drug supply by MAM-Yes</option>
                        <option value="Drug supply by MAM-No">Drug supply by MAM-No</option>
                      </select>
                    </div>
                  </div>
              <div class="row">
                        <div class="col-md-2 receptionFollow-consult">
                            <label for="">Type of Consultation</label>
                            <select  class="form-select reception-select"  id="Ptype_1_toupdate" >
                              <option value="-"></option>
                              <option value="PHA">PHA</option>
                              <option value="ART">ART</option>
                              <option value="PrEP">PrEP</option>
                              <option value="PMTCT">PMTCT</option>
                              <option value="ANC">ANC</option>
                              <option  value="FP">Family Planning</option>
                              <option value="FC">Feeding Centre</option>
                              <option value="General">General</option>
                              <option value="lab_iv_only"> Lab Investigation Only</option>
                            </select>
                          </div>
                        <div class="col-md-1 receptionFollow-newOld">
                          <label >New/Old</label>
                          <select class="form-select" id="new_old_1_toupdate"required>
                            <option value="-"></option>
                            <option value="New">New</option>
                            <option value="Old">Old</option>
                          </select>
                        </div>
                        <div class="col-md-3 receptionFollow-refer ">
                          <label >Refer to Fever Team</label>
                          <select class="form-select" id="sub_1_1_toupdate"required>
                            <option value="-"></option>
                            <option value="MAM_Cohort_Yes">MAM Cohort - Yes</option>
                            <option value="MAM_Cohort_No">MAM Cohort - No</option>
                            <option value="Ref_Fever_No">Refer to Fever Team - No</option>
                            <option value="Ref_Fever_Yes">Refer to Fever Team - Yes</option>
                          </select>
                        </div>
                        <div class="col-md-3 receptionFollow-category ">
                          <label>Diseases Category</label>
                          <select class="form-select" id="sub_2_2_toupdate"required>
                            <option value="-"></option>
                            <option value="1. HIV (-) TB">1. HIV (-) TB</option>
                            <option value="2. Hypertension only">2. Hypertension only</option>
                            <option value="3. Diabetes only">3. Diabetes only</option>
                            <option value="4. H/T & DM commodities">4. H/T & DM commodities</option>
                            <option value="5. RTI(< 2wks)">5. RTI(< 2wks)</option>
                            <option value="6. RTI(>=2wks)">6. RTI(>=2wks)</option>
                            <option value="7. Obstructive Pul. D/s">7. Obstructive Pul. D/s</option>
                            <option value="8. NCD/ Cerebrovascular diseases (CVD)">8. NCD/ Cerebrovascular diseases (CVD)</option>
                            <option value="9. Renal D/s">9. Renal D/s</option>
                            <option value="10. GI & Hepatobiliary">10. GI & Hepatobiliary</option>
                            <option value="11. Gynaecology">11. Gynaecology</option>
                            <option value="12. Musculoskeleton and rheumatology">12. Musculoskeleton and rheumatology </option>
                            <option value="13. Skin infection">13. Skin infection</option>
                            <option value="14. Covid related consultation">14. Covid related consultation</option>
                            <option value="15. TB related consultation">15. TB related consultation</option>
                            <option value="16. Sexual violence">16. Sexual violence</option>
                            <option value="17. STI">17. STI</option>
                            <option value="18. DF">18. DF</option>
                            <option value="19. Malnourished">19. Malnourished</option>
                            <option value="20. Child Abuse">20. Child Abuse</option>
                            <option value="21. Others">21. Others</option>
                          </select>
                        </div>
                        <div class="col-md-3 receptionFollow-supply ">
                          <label >Supply</label>
                          <select class="form-select" id="sub_3_3_toupdate"required>
                            <option value="-"></option>
                            <option value="Drug supply by MAM-Yes">Drug supply by MAM-Yes</option>
                            <option value="Drug supply by MAM-No">Drug supply by MAM-No</option>
                          </select>
                        </div>
                      </div>

              <div class="row">
                <div class="col-sm-2 return-input ">
                  <label for="validationCustom01" class="form-label">Next Appointment Date</label>
                  <input id="nDate_toupdate" type="date" value="" class="form-control"  >
                  <div class="valid-feedback">
                    Plz put Patient's Visit Date.
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-2 reception-re-fo">
                      <button type="button" id="updateBton" onclick="update()" class="btn update-batton">Update</button>
                </div>
              </div>
            <br>


      </div>
    </div>
  </div>
  <!--   <form class="" id="reg" method="post" > -->
    @csrf

    </div>
    </body>
@endsection
@endauth
<script type="text/javascript" language="javascript">
  let generatedID=0; let text =0; let ptID=0;let rowNumber=0;
  let generatedID1=0;
  let genID=[];
  let ddDate=0;
 
// function location ( 1 ) to ready New Id and first checked is that the new one and return
function idgiven(){
	  clearFacts();
	  document.getElementById('gid').value = document.getElementById('nextID').innerHTML;
	  // For Date
	  var date = new Date();
	  var day = date.getDate();
	  var month = date.getMonth() + 1;
	  var year = date.getFullYear();
	  if (month < 10) month = "0" + month;
	  if (day < 10) day = "0" + day;
	  var today = year + "-" + month + "-" + day;
	  document.getElementById('vDate').value = today;

	  var gid =document.getElementById('gid').value;
	  var searchIDtoCK = document.getElementById('search_id').value;
		var functionLoco=1;
	  if(searchIDtoCK.length<5){
	  let ckID = 1;
	  var checkPatient = 1;
	  var ckdata = {
										functionLoco:functionLoco,
	                  gid:gid,
	                  ckID:ckID
	                };
	  $.ajaxSetup({
	      headers: {
	          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
	       }
	     });
	  $.ajax({
	      type:'POST',
	      url:"{{route('reception_road')}}",
	      dataType:'json',
	      contentType: 'application/json',
	      data: JSON.stringify(ckdata),
	      success:function(response){

	          if(response[0]==null){
	                    document.getElementById('regbutton').disabled=false;
	                    document.getElementById('updateBton').disabled=true;
	                    document.getElementById('followBton').disabled=true;
	                    document.getElementById('responseText').innerHTML="";
	                    document.getElementById('responseText').innerHTML="The new code was checked ,it is the new ID.";
	                       document.getElementById('fid').focus();
	                 }
	                 if (response[0] != null) {
	                     generatedID=response[0]['id'];
	                   if(response[1]!= null){
	                    document.getElementById('responseText').innerHTML="";
	                    document.getElementById('responseText').innerHTML="We have got data.";
	                   }
	                   document.getElementById("name").value=response[1];
	                   document.getElementById("father").value=response[2];
	                   document.getElementById('gender').value= response[0]["Gender"];
	                   document.getElementById("agey").value=response[0]["Agey"];
	                   document.getElementById("agem").value=response[0]["Agem"];
	                   document.getElementById("state").value=response[0]["Region"];
	                   document.getElementById("tt_opt").value=response[0]["Township"];
	                  // document.getElementById("quarter").value=response[0]["Quarter"];
	                   document.getElementById("fid").value=response[0]["FuchiaID"];
	                   //document.getElementById("vdate").value=response[0]["Reg Date"];
	                   //document.getElementById("dob").value=response[0]["Date Of Birth"];
	                   document.getElementById('main_risk').disabled=false;
	                   document.getElementById('sub_risk').disabled=false;

	                   document.getElementById('regbutton').disabled=true;
	                   document.getElementById('updateBton').disabled=true;
	                   document.getElementById('followBton').disabled=false;
	                 }
	               }
	         });
	        }
	}
//functionLocation ( 1 ) Search General with ID
function ptData(){
	  // For Date
	  var date = new Date();
	  var day = date.getDate();
	  var month = date.getMonth() + 1;
	  var year = date.getFullYear();
	  if (month < 10) month = "0" + month;
	  if (day < 10) day = "0" + day;
	  var today = year + "-" + month + "-" + day;
	  document.getElementById('vDate').value = today;

	  var gid =document.getElementById('gid').value;
	  var searchIDtoCK = document.getElementById('search_id').value;
	  var c_code = 81;

	  var gidLength = gid.length;
	  if(gidLength>9){
	    document.getElementById('responseText').innerHTML="";
	  if(searchIDtoCK.length<5){
	  var functionLoco = 1;
		let ckID = 1;
	  var checkPatient = 1;
	  var ckdata = {
	                  gid:gid,
	                  functionLoco:functionLoco,
										ckID:ckID,
	                };
	  $.ajaxSetup({
	      headers: {
	          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
	       }
	     });
	  $.ajax({
	      type:'POST',
	      url:"{{route('reception_road')}}",
	      dataType:'json',
	      contentType: 'application/json',
	      data: JSON.stringify(ckdata),
	      success:function(response){
	        console.log(response);
	        clearFacts();
	          if(response[0]==null)
	          {
	                    document.getElementById("gid").value = gid;
	                    document.getElementById('regbutton').disabled=false;
	                    document.getElementById('updateBton').disabled=true;
	                    document.getElementById('followBton').disabled=true;
	                    document.getElementById("response").innerHTML="There is no data for this client."
	          }
	          if (response[0] != null)
	          {
	            var response7 = response[7];
	            if(response7 != null){
	              var nextDate =  response[7]["Next Appointment Date"];
							
									if(today != nextDate){
		                document.getElementById('responseText').innerHTML="Unplanned Visit";                
		              }else {
                    document.getElementById('responseText').innerHTML="Planned  Visit";
                  }

								

	            }else{
	              document.getElementById('responseText').innerHTML="";
	              document.getElementById('responseText').innerHTML="We have got data.";
	            }



	                     generatedID=response[0]['id'];


	                     //document.getElementById('responseText').innerHTML=response[7];


	                   if(response[1] != null){ // For Name
	                     document.getElementById("name").value=response[1];

	                   }
	                   if(response[2] != null){//For Father
	                     document.getElementById("father").value=response[2];
	                   }
	                   if(response[3] != null){// For Date of Birth and Age
	                     var bd_date = response[3];
	                     var dateSplited = bd_date.split("-");

	                     var dtYear = dateSplited[0];
	                     var dtMonth = dateSplited[1];

	                     if(dtYear == year){
	                      document.getElementById("agem").value=Number(dtMonth) + Number(month);
	                     }else{
	                       var Adate = new Date();
	                       var Aday = Adate.getDate();
	                       var Amonth = Adate.getMonth() + 1;
	                       var Ayear = Adate.getFullYear();
	                       var toshowYear = Ayear - Number(dtYear);
	                      // document.getElementById("agey").value=getAge(bd_date);
	                       document.getElementById("agey").value= toshowYear;
	                     }
	                   }
	                   if(response[4]!= null){ // For Region
	                     document.getElementById("state").value=response[4];
	                   }
	                   if(response[5]!= null){ // For Township
	                     document.getElementById("tt").value=response[5];
	                   }
	                   document.getElementById('gender').value= response[8];
	                   document.getElementById("gid").value=response[0]["Pid"];
	                   document.getElementById("fid").value=response[0]["FuchiaID"];
	                   document.getElementById("prepCode").value=response[0]["PrEPCode"];

	                   document.getElementById("vDate").value=today;
	                   //document.getElementById("dob").value=response[0]["Date of Birth"];
	                   //document.getElementById("Ptype").value=response[0]["Patient Type"];
	                   //document.getElementById("tt_sub").value=response[0]["Patient Type Sub"];
	                   //document.getElementById("tt_sub_2").value=response[0]["Patient Type Sub1"];

	                   document.getElementById('prepCode').disabled=true;
	                   document.getElementById('name').disabled=true;
	                   document.getElementById('father').disabled=true;
	                   document.getElementById('gender').disabled=true;
	                   document.getElementById('state').disabled=true;
	                   document.getElementById('tt').disabled=true;


	                   document.getElementById('dob').disabled=true;
	                   document.getElementById('agey').disabled=true;
	                   document.getElementById('agem').disabled=true;

	                   document.getElementById('main_risk').disabled=true;
	                   document.getElementById('sub_risk').disabled=true;

	                   document.getElementById('regbutton').disabled=true;
	                   document.getElementById('updateBton').disabled=true;
	                   document.getElementById('followBton').disabled=false;
	         }
	        }
	      });
	    }
	  }else
	  {
	        clearFacts();
	        document.getElementById('responseText').innerHTML="ID'length is  < 10";
	        document.getElementById('regbutton').disabled=true;
	        document.getElementById('updateBton').disabled=true;
	        document.getElementById('followBton').disabled=true;
	  }
	}
//function Location ( 2 ) Search with Fuchia ID
function searchFuchiaID(){
	  // For Date
	  var date = new Date();
	  var day = date.getDate();
	  var month = date.getMonth() + 1;
	  var year = date.getFullYear();
	  if (month < 10) month = "0" + month;
	  if (day < 10) day = "0" + day;
	  var today = year + "-" + month + "-" + day;
	  document.getElementById('vDate').value = today;

	  let fuchiaShar =1;
		var functionLoco = 2;
	  let fuID = document.getElementById('fid').value;
	  let ckSearch_ID= document.getElementById('gid').value;


	  var  pati={
					functionLoco:functionLoco,
	        fuchiaShar:fuchiaShar,
	        fuID:fuID,
	       };
	  $.ajaxSetup({
	     headers: {
	         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
	     }
	   });
	      $.ajax({
	           type:'POST',
	           url:"{{route('reception_road')}}",
	           dataType:'json',
	         //  processData:false,
	           contentType:'application/json',
	           data: JSON.stringify(pati),
	           success:function(response){

	               if(response[0]==null){
	                         document.getElementById('regbutton').disabled=false;
	                         document.getElementById('updateBton').disabled=true;
	                         document.getElementById('followBton').disabled=true;
	                         var new_old = document.getElementById('new_old');
	                         if(new_old.innerHTML!=null){
	                           new_old.innerHTML="";
	                         }
	                            var sel = document.getElementById('new_old');
	                            var opt = document.createElement("option");
	                            opt.appendChild( document.createTextNode("There is no data for this client."));
	                            opt.value = "New";
	                            sel.appendChild(opt);
	                            sel.style.color = "red";
	                      }
	                      if (response[0] != null) {
	                        clearFacts();
	                          generatedID=response[0]['id'];
	                          var new_old = document.getElementById('new_old');
	                          if(new_old.innerHTML!=null){
	                            new_old.innerHTML="";
	                          }
	                             var sel = document.getElementById('new_old');
	                             var opt = document.createElement("option");
	                             opt.appendChild( document.createTextNode("We have got Data."));
	                             opt.value = "Old";
	                             sel.appendChild(opt);
	                             sel.style.color = "blue";
	                        if(response[1] != null){ // For Name
	                          document.getElementById("name").value=response[1];
	                        }
	                        if(response[2] != null){//For Father
	                          document.getElementById("father").value=response[2];
	                        }
	                        if(response[3] != null){// For Date of Birth and Age
	                          var bd_date = response[3];
	                          var dateSplited = bd_date.split("-");

	                          var dtYear = dateSplited[0];
	                          var dtMonth = dateSplited[1];

	                          if(dtYear == year){
	                           document.getElementById("agem").value=Number(dtMonth) + Number(month);
	                          }else{
	                            var Adate = new Date();
	                            var Aday = Adate.getDate();
	                            var Amonth = Adate.getMonth() + 1;
	                            var Ayear = Adate.getFullYear();
	                            var toshowYear = Ayear - Number(dtYear);
	                           // document.getElementById("agey").value=getAge(bd_date);
	                            document.getElementById("agey").value= toshowYear;
	                          }
	                        }
	                        document.getElementById('gender').value= response[0]["Gender"];

	                        document.getElementById("gid").value=response[0]["Pid"];


	                        if(response[4]!= null){ // For Region
	                          document.getElementById("state").value=response[4];
	                        }
	                        if(response[5]!= null){ // For Township
	                          document.getElementById("tt").value=response[5];
	                        }


	                        document.getElementById("fid").value=response[0]["FuchiaID"];
	                        document.getElementById("vDate").value=today;
	                        //document.getElementById("dob").value=response[0]["Date of Birth"];
	                        //document.getElementById("Ptype").value=response[0]["Patient Type"];
	                        //document.getElementById("tt_sub").value=response[0]["Patient Type Sub"];
	                        //document.getElementById("tt_sub_2").value=response[0]["Patient Type Sub1"];
	                        document.getElementById('regbutton').disabled=true;
	                        document.getElementById('updateBton').disabled=true;
	                        document.getElementById('followBton').disabled=false;

	                        document.getElementById('name').disabled=true;
	                        document.getElementById('father').disabled=true;
	                        document.getElementById('gender').disabled=true;
	                        document.getElementById('state').disabled=true;
	                        document.getElementById('tt').disabled=true;
	                        //document.getElementById('quarter').disabled=true;
	                        //document.getElementById('phone').disabled=true;
	                        document.getElementById('dob').disabled=true;
	                        document.getElementById('agey').disabled=true;
	                        document.getElementById('agem').disabled=true;
	                        document.getElementById('main_risk').disabled=true;
	                        document.getElementById('sub_risk').disabled=true;

	                      }



	            if(response[0]==null)
	            {
	              document.getElementById('responseText').innerHTML="";
	              document.getElementById('responseText').innerHTML="Wrong ID";
	              document.getElementById('updateBton').disabled=true;
	              document.getElementById('regbutton').disabled=false;
	              //location.reload(true);
	            }

	           }
	          });


	}
// function location ( 3 ) Add new patient
function send(){
	    let gtReg =1;
			var functionLoco=3;
	    let clinic_code = 81;
	    var gid = document.getElementById("gid").value;

	    var name = document.getElementById("name").value;
	    if(name.length<1){
	      name="-";
	    }
	    var father = document.getElementById("father").value;
	    if(father.length<1){
	      father="-";
	    }
	    var agey = document.getElementById("agey").value;
	    if(agey.length<1){
	      agey=0;
	    }
	    var agem = document.getElementById("agem").value;
	    if(agem.length<1){
	      agem=0;
	    }
	    var gender = document.getElementById("gender").value;
	    if(gender.length<1){
	      gender="-";
	    }
	    var vdate = document.getElementById("vDate").value;
      vdate = formatDate(vdate); // Date formatChange function
      console.log(vdate+"visit date")

	    dateOfBirth();
	    var dobdate = ddDate;
     



	    var state = document.getElementById("state").value;
	    if(state.length<1){
	      state="-";
	    }
	    var tt = document.getElementById("tt").value;
	    if(tt.length<1){
	      tt="-";
	    }
	    var fuchiaID = document.getElementById("fid").value;
	    if(fuchiaID.length<1){
	      fuchiaID = "-";

	    }

	    var prepCode = document.getElementById("prepCode").value;
	    if(prepCode.length<1){
	      prepCode="-";
	    }


	    var main_risk =document.getElementById("main_risk").value;
	    var sub_risk =document.getElementById("sub_risk").value;
	    if(gid.length == 10){ //Mode 0= Walk in , 1= Peer with 11,12 code.length;
	      var mode =0;
	      console.log("mode is"+mode);
	    }else{
	      var mode = 1;
	      console.log("mode is"+mode);
	    }
      var unplan=0;
      
     
	    var  pati={
						functionLoco:functionLoco,
	           gtReg:gtReg,
	           clinic_code:clinic_code,
	           gid:gid,
	           mode:mode,
	           fuchiaID:fuchiaID,
	           prepCode:prepCode,
	           name:name,
	           father:father,
	           agey:agey,
	           agem:agem,
	           gender:gender,
	           vdate:vdate,
	           dobdate:dobdate,
	           state:state,
	           tt:tt,
	           main_risk:main_risk,
	           sub_risk:sub_risk,
             unplan:unplan,

	         };

	    if(gid.length<8){
	      alert("Please make suer General Code!");
	    }{
	    $.ajaxSetup({
	       headers: {
	           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
	       }
	     });
	        $.ajax({
	             type:'POST',
	             url:"{{route('reception_road')}}",
	             dataType:'json',
	           //  processData:false,
	             contentType:'application/json',
	             data: JSON.stringify(pati),
	             success:function(response){
	               if(response[0]=="duplicate"){
	                 alert("Duplicate Entry");
	                 location.reload(true);// to refresh the page
	               }else{
	                 alert("We have collected the facts.");
	                 $("#hider0").hide();
	                 var idBarcode ="<div style='margin:auto'>"+"<img id='barcodePaper' />"+"</div>";
	                 var Reg_title= "<h1>"+"New Patient Registration"+"</h1>"+"<br>";

	                 var regDate="<span>"+"Register Date::"+vdate+"</span>"+"<br>";

	                  $("#toshowResult").append(Reg_title+idBarcode+regDate);
	                  //JsBarcode("#barcodePaper", gid);
	                  //window.print();
	                  //$("#toshowResult").hide();
	                  //$("#hider0").show();
	                  location.reload(true);// to refresh the page
	               }
	             }
	            });
	          }
	        }
// function location (4) add follow up
function send_fup(){

	  let ptFollowup =1;
		var functionLoco=4;
	  let clinic_code = 81;
	  var gid = document.getElementById("gid").value;

	  var agey = document.getElementById("agey").value;
	  var agem = document.getElementById("agem").value;
	  var gender = document.getElementById("gender").value;
	  var vdate = document.getElementById("vDate").value;
    vdate = formatDate(vdate);
	  dateOfBirth();
	  var dobdate = ddDate;

	  var fuchiaID = document.getElementById("fid").value;
	  var prepCode = document.getElementById("prepCode").value;

	  if(!dobdate){
	    dobdate="0000-00-00";
	  }

	  var agey = document.getElementById("agey").value;
	  if(!agey){
	    agey=0;
	  }
	  var agem = document.getElementById("agem").value;
	  if(!agem){
	    agem=0;
	  }
	  var gender = document.getElementById("gender").value;
	  if(!gender){
	    gender="-";
	  }
	  var vdate1 = document.getElementById("vDate").value;
    $.get("js/date.js", function(vdate1) {
    var vdate = formatDate(vdate1);

  });
  console.log(vdate1+"Hello vdate1")
    console.log(vdate+"test");
	  dateOfBirth();
	  var dobdate = ddDate;


	  var state = document.getElementById("state").value;
	  if(!state){
	    state="-";
	  }
	  var tt = document.getElementById("tt").value;
	  if(!tt){
	    tt="-";
	  }
	  var fuchiaID = document.getElementById("fid").value;
	  if(!fuchiaID){
	    fuchiaID = "-";
	  }
	  var prepCode = document.getElementById("prepCode").value;
	  if(!prepCode){
	    prepCode="-";
	  }


	  var main_risk ="-";
	  var sub_risk ="-";

	  if(gid.length == 10){ //Mode 1= Walk in , 2= Peer with 11,12 code.length;
	    var mode =0;
	  }else{
	    var mode = 1;
	  }
	  if(fuchiaID.length<1){
	    fuchiaID="-";
	  }
	  var Patient_Type="-";
	  var New_Old="-";
	  var Fever="-";
	  var Diagnosis="-";
	  var Support="-";

	  var Patient_Type_1="-";
	  var New_Old_1="-";
	  var Fever_1="-";
	  var Diagnosis_1="-";
	  var Support_1="-";

	  var Patient_Type_2="-";
	  var New_Old_2="-";
	  var Fever_2="-";
	  var Diagnosis_2="-";
	  var Support_2="-";
    var unplan=0;

	  var  pati={
					 functionLoco:functionLoco,
	         ptFollowup:ptFollowup,
	         clinic_code:clinic_code,
	         gid:gid,
	         mode:mode,
	         fuchiaID:fuchiaID,
	         prepCode:prepCode,
	         agey:agey,
	         agem:agem,
	         gender:gender,
	         vdate:vdate,
	         dobdate:dobdate,

	         main_risk:main_risk,
	         sub_risk:sub_risk,

	         Patient_Type:Patient_Type ,
	           New_Old:New_Old ,
	           Fever:Fever ,
	           Diagnosis:Diagnosis ,
	           Support:Support ,

	           Patient_Type_1:Patient_Type_1 ,
	           New_Old_1:New_Old_1 ,
	           Fever_1:Fever_1 ,
	           Diagnosis_1:Diagnosis_1 ,
	           Support_1:Support_1 ,

	           Patient_Type_2:Patient_Type_2 ,
	           New_Old_2:New_Old_2 ,
	           Fever_2:Fever_2 ,
	           Diagnosis_2:Diagnosis_2 ,
	           Support_2:Support_2 ,

	           unplan:unplan,
	       };
	  var len_data= gid.length;
	  if(len_data > 0){
	    $.ajaxSetup({
	       headers: {
	           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
	       }
	     });
	        $.ajax({
	             type:'POST',
	             url:"{{route('reception_road')}}",
	             dataType:'json',
	           //  processData:false,
	             contentType:'application/json',
	             data: JSON.stringify(pati),
	             success:function(response){
                console.log(response);
	                if(response[0]== true){
	                  alert("Duplicate Entry");
	                }else{
	                  alert("Your data has been collected.");
	                }

	                  //alert("Your data has been collected.");
	                  location.reload(true);// to refresh the page
	                  document.getElementById('regbutton').disabled=false;
	             }
	          });
	  }else{

	  }

	}
// function location ( 5 ) finding data with General ID of Fuchia ID to Edit or Update data
function searchID(){
  // For Date
  var date = new Date();
  var day = date.getDate();
  var month = date.getMonth() + 1;
  var year = date.getFullYear();
  if (month < 10) month = "0" + month;
  if (day < 10) day = "0" + day;
  var today = year + "-" + month + "-" + day;
  document.getElementById('vDate').value = today;

  let search_par =1;
	var functionLoco=5;
  let Pt_ID = document.getElementById("search_id").value;
  var  pati={
        search_par:search_par,
				functionLoco:functionLoco,
        Pt_ID:Pt_ID,
       };
       $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
          }
        });
      $.ajax({
           type:'POST',
           url:"{{route('reception_road')}}",
           dataType:'json',
         //  processData:false,
           contentType:'application/json',
           data: JSON.stringify(pati),
           success:function(response){
             clearFacts();
              console.log(response);

               if(response[0]==null){


                         document.getElementById('regbutton').disabled=false;
                         document.getElementById('updateBton').disabled=true;
                         document.getElementById('followBton').disabled=true;
                         // var new_old = document.getElementById('new_old');
                         // if(new_old.innerHTML!=null){
                         //   new_old.innerHTML="";
                         // }
                         //    var sel = document.getElementById('new_old');
                         //    var opt = document.createElement("option");
                         //    opt.appendChild( document.createTextNode("There is no Data for the client."));
                         //    opt.value = "New";
                         //    sel.appendChild(opt);
                         //    sel.style.color = "red";
                      }
                      if (response[0] != null) {

													generatedID   = response[0]['id'];
											 		if(response[9]!=null){
														 generatedID1  = response[9]['id'];
														var num =response[10].length;
														var k = 'genID';
														for(i = 0; i < num; i++) {
																//eval('var '+ k + i + '=' + response[4][i]['id'] + ';');
																genID[i]=response[10][i]['id'];
														}

													}

                          // var new_old = document.getElementById('new_old');
                          // if(new_old.innerHTML!=null){
                          //   new_old.innerHTML="";
                          // }
                          //    var sel = document.getElementById('new_old');
                          //    var opt = document.createElement("option");
                          //    opt.appendChild( document.createTextNode("We have got Data."));
                          //    opt.value = "Old";
                          //    sel.appendChild(opt);
                          //    sel.style.color = "blue";

                        if(response[1] != null){ // For Name
                          document.getElementById("name").value=response[1];

                        }
                        if(response[2] != null){//For Father
                          document.getElementById("father").value=response[2];
                        }
                        document.getElementById("agey").value= response[0]["Agey"];
                        document.getElementById("agem").value= response[0]["Agem"];
                        //document.getElementById("dob").value= response[3];
                        if(response[3]!=null){
                          var bd_date = response[3];
                          var dateSplited = bd_date.split("-");

                          var dtYear = dateSplited[0];
                          var dtMonth = dateSplited[1];
                          if(dtMonth<10564){
                            dtMonth= "0"+dtMonth;
                          }
                          var dtDay = dateSplited[2];
                          var dob_to_show = dtYear+"-"+dtMonth+"-"+dtDay;
                          document.getElementById("dob").value=dob_to_show;
                        }else{

												}


                        document.getElementById('gender').value= response[8];

                        document.getElementById("gid").value=response[0]["Pid"];


                        if(response[4]!= null){ // For Region
                          document.getElementById("state").value=response[4];
                        }
                        if(response[5]!= null){ // For Township
                          document.getElementById("tt").value=response[5];
                        }
                        //if(response[6]!= null){ // For Quarter
                        //  document.getElementById("quarter").value=response[6];
                        //}

                        document.getElementById("fid").value=response[0]["FuchiaID"];
                        document.getElementById("prepCode").value=response[0]["PrEPCode"];
                        document.getElementById("vDate").value=response[0]["Reg Date"];
                        //document.getElementById("dob").value=response[0]["Date of Birth"];
                        //document.getElementById("Ptype").value=response[0]["Patient Type"];
                        //document.getElementById("tt_sub").value=response[0]["Patient Type Sub"];
                        //document.getElementById("tt_sub_2").value=response[0]["Patient Type Sub1"];
                        document.getElementById('main_risk').disabled=true;
                        document.getElementById('sub_risk').disabled=true;

                        document.getElementById('regbutton').disabled=true;
                        document.getElementById('updateBton').disabled=false;
                        document.getElementById('followBton').disabled=true;


                        document.getElementById('prepCode').disabled=false;
                        document.getElementById('name').disabled=false;
                        document.getElementById('father').disabled=false;
                        document.getElementById('gender').disabled=false;
                        document.getElementById('state').disabled=false;
                        document.getElementById('tt').disabled=false;
                        //document.getElementById('quarter').disabled=false;
                        //document.getElementById('phone').disabled=false;
                        document.getElementById('dob').disabled=false;
                        document.getElementById('agey').disabled=false;
                        document.getElementById('agem').disabled=false;

                      }
                    }
              });

}
// function locatjion ( 6 ) to update data to config table and patient table
function update_reg(){
  let update_reg =1;
	var functionLoco=6;
  let clinic_code = 81;
  var gid = document.getElementById("gid").value;
  var gid_len = gid.length;
  if(gid_len== 10 || gid_len==11 || gid_len==12 ){


  if(gid_len == 10){ //Mode 1= Walk in , 2= Peer with 11,12 code.length;
    var mode =0;
  }else{
    var mode = 1;
  }
  var fuchiaID = document.getElementById("fid").value;
  var prepCode = document.getElementById("prepCode").value;
  var name = document.getElementById("name").value;
  var father = document.getElementById("father").value;
  var agey = document.getElementById("agey").value;
  var agem = document.getElementById("agem").value;
  var gender = document.getElementById("gender").value;
  var vdate = document.getElementById("vDate").value;
  vdate = formatDate(vdate); // Date formatChange function
	dateOfBirth();
	var dobdate = ddDate;
  //var dobdate = document.getElementById("dob").value;

  var state = document.getElementById("state").value;
  var tt = document.getElementById("tt").value;


  var  pati={
         update_reg:update_reg,
				 functionLoco:functionLoco,
         clinic_code:clinic_code,
         gid:gid,
         mode:mode,
         fuchiaID:fuchiaID,
         prepCode:prepCode,

         generatedID:generatedID,
         generatedID1:generatedID1,
         genID:genID,

         name:name,
         father:father,
         agey:agey,
         agem:agem,
         gender:gender,
         vdate:vdate,
         dobdate:dobdate,
         state:state,
         tt:tt,


       };
  $.ajaxSetup({
     headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
     }
   });
      $.ajax({
           type:'POST',
           url:"{{route('reception_road')}}",
           dataType:'json',
         //  processData:false,
           contentType:'application/json',
           data: JSON.stringify(pati),
           success:function(response){
              console.log(response);
              console.log("This is I Wanted "+ response[1]);
              alert("Your data has been collected.");

                location.reload(true);// to refresh the page
                document.getElementById('regbutton').disabled=false;
           }
        });
      }else{
        alert("please input General ID to update data.");
      }
}

///****////****///****///****////****///****///****////****///****///****////****///****///****////****///****
// Return Section
// function location ( 7 ) to find pt data with General ID  in return section
function ptData_return(){
  var gid_return =document.getElementById('gid_return').value;
  //var c_code = document.getElementById("clinic_code").innerHTML;
  var gidLength = gid_return.length;
  if(gidLength>9){
    //document.getElementById('responseText').innerHTML="";
  let ckID_return = 1;
  var checkPatient = 1;
	var functionLoco=7;
  var ckdata = {
                  gid_return:gid_return,
									functionLoco:functionLoco,
                  ckID_return:ckID_return,
                };
  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
       }
     });
  $.ajax({
      type:'POST',
      url:"{{route('reception_road')}}",
      dataType:'json',
      contentType: 'application/json',
      data: JSON.stringify(ckdata),
      success:function(response){
        clearFacts();
        console.log(response);
          if(response[0] != null){
            document.getElementById("fid_return").value=response[0]["FuchiaID"];
            document.getElementById("fup_date").value=response[0]["Visit Date"];
            document.getElementById("nDate").value=response[0]["Next Appointment Date"];
            var id = response[0]["Pid"];
             $("#responseText").append("General ID =>"+ "" +id);
             $("#responseText").css("color", "red");
          }else{
            document.getElementById("fid_return").value='';
            document.getElementById("fup_date").value='';
            document.getElementById("nDate").value='';
            document.getElementById("responseText").innerHTML='';
             $("#responseText").append("There is no data.");
             $("#responseText").css("color", "red");
          }
        }
      });

    }else{
        clearFacts();
        document.getElementById('responseText').innerHTML="ID'length is  < 10";

      }
  }

  function getAge(bd_date) {

      var dates = bd_date.split("-");
      var d = new Date();

      var useryear = dates[0];
      var usermonth = dates[1];
      var userday = dates[2];

      var curday = d.getDate();
      var realMonth = d.getMonth();
      var curmonth = d.getMonth()+1;
      var curyear = d.getFullYear();

      if(curyear == useryear){
        var age = realMonth - usermonth;
        console.log("month"+ age);
      }else{
        var age = curyear - useryear;
        console.log("age"+ age);
      }
      if((curmonth < usermonth) || ( (curmonth == usermonth) && curday < userday   )){
          age--;
      }

      return age;
  }
// function location ( 8 ) to find pt data wiht Fuchia ID in return section
function searchFuID(){

	  var fuchiaShar =1;
		var functionLoco=8;
	  var fid_return = document.getElementById('fid_return').value;

	  var  pati={
	        fuchiaShar:fuchiaShar,
					functionLoco:functionLoco,
	        fid_return:fid_return,
	       };
	  $.ajaxSetup({
	     headers: {
	         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
	     }
	   });
	      $.ajax({
	           type:'POST',
	           url:"{{route('reception_road')}}",
	           dataType:'json',
	         //  processData:false,
	           contentType:'application/json',
	           data: JSON.stringify(pati),
	           success:function(response){
	            if(response[0] != null){
	              console.log(response);
	              document.getElementById("gid_return").value=response[0]["Pid"];
	              document.getElementById("fup_date").value=response[0]["Visit Date"];
	            }else{
	              document.getElementById("gid_return").value='';
	              document.getElementById("fup_date").value='';
	              document.getElementById("nDate").value='';
	              document.getElementById("responseText").innerHTML='';
	               $("#responseText").append("There is no data.");
	               $("#responseText").css("color", "red");
	            }

	           }
	          });


	}
// function location ( 9 ) to save next appointment date and diagnosis data
function save(){
    let next =1;
		var functionLoco=9;
    var gid = document.getElementById("gid_return").value;
    var pData = document.getElementById("responseText").innerHTML;
    var nDate = document.getElementById("nDate").value;
		nDate = formatDate(nDate); // Date formatChange function
     if(!nDate){
       nDate ="0000-00-00";
     }
    var fDate = document.getElementById('fup_date').value;
    fDate = formatDate(fDate); // Date formatChange function

    if(hide_signal==1){// 2,0
      console.log("hide_signal == 1");
      var Patient_Type=document.getElementById("Ptype").value;
      var New_Old=document.getElementById("new_old").value;
      var Fever="-";
      var Diagnosis="-";
      var Support="-";

      var Patient_Type_1="-";
      var New_Old_1="-";
      var Fever_1="-";
      var Diagnosis_1="-";
      var Support_1="-";
    }
    if(hide_signal==2){// 3,0
      console.log("hide_signal == 2");
      var Patient_Type=document.getElementById("Ptype").value;
      var New_Old=document.getElementById("new_old").value;
      var Fever=document.getElementById("sub_1").value;
      var Diagnosis="-";
      var Support="-";

      var Patient_Type_1="-";
      var New_Old_1="-";
      var Fever_1="-";
      var Diagnosis_1="-";
      var Support_1="-";
    }
    if(hide_signal==3){//4,0
      console.log("hide_signal == 3");
      var Patient_Type=document.getElementById("Ptype").value;
      var New_Old=document.getElementById("new_old").value;
      var Fever=document.getElementById("sub_1").value;
      var Diagnosis=document.getElementById("sub_2").value;
      var Support="-";

      var Patient_Type_1="-";
      var New_Old_1="-";
      var Fever_1="-";
      var Diagnosis_1="-";
      var Support_1="-";
    }
    if(hide_signal==4){ //5,0
      console.log("hide_signal == 4");
      var Patient_Type=document.getElementById("Ptype").value;
      var New_Old=document.getElementById("new_old").value;
      var Fever=document.getElementById("sub_1").value;
      var Diagnosis=document.getElementById("sub_2").value;
      var Support=document.getElementById("sub_3").value;

      var Patient_Type_1="-";
      var New_Old_1="-";
      var Fever_1="-";
      var Diagnosis_1="-";
      var Support_1="-";
    }
    //*************************************** first row end
    if(hide_signal==5){//2,2
      console.log("hide_signal == 5");
      var Patient_Type=document.getElementById("Ptype").value;
      var New_Old=document.getElementById("new_old").value;
      var Fever="-";
      var Diagnosis="-";
      var Support="-";
      var Patient_Type_1=document.getElementById("Ptype_1").value;
      var New_Old_1=document.getElementById("new_old_1").value;
      var Fever_1="-";
      var Diagnosis_1="-";
      var Support_1="-";
    }
    // no 2,3
    // if(hide_signal==6){//2,3
    //   console.log("hide_signal == 6");
    //   var Patient_Type=document.getElementById("Ptype").value;
    //   var New_Old=document.getElementById("new_old").value;
    //   var Fever="-";
    //   var Diagnosis="-";
    //   var Support="-";
    //   var Patient_Type_1=document.getElementById("Ptype_1").value;
    //   var New_Old_1=document.getElementById("new_old_1").value;
    //   var Fever_1=document.getElementById("sub_1_1").value;
    //   var Diagnosis_1="-";
    //   var Support_1="-";
    // }
    if(hide_signal==7){//2,4
      console.log("hide_signal == 7");
      var Patient_Type=document.getElementById("Ptype").value;
      var New_Old=document.getElementById("new_old").value;
      var Fever="-";
      var Diagnosis="-";
      var Support="-";
      var Patient_Type_1=document.getElementById("Ptype_1").value;
      var New_Old_1=document.getElementById("new_old_1").value;
      var Fever_1=document.getElementById("sub_1_1").value;
      var Diagnosis_1=document.getElementById("sub_2_1").value;
      var Support_1="-";
    }
    if(hide_signal==8){//2,5
      console.log("hide_signal == 8");
      var Patient_Type=document.getElementById("Ptype").value;
      var New_Old=document.getElementById("new_old").value;
      var Fever="-";
      var Diagnosis="-";
      var Support="-";
      var Patient_Type_1=document.getElementById("Ptype_1").value;
      var New_Old_1=document.getElementById("new_old_1").value;
      var Fever_1=document.getElementById("sub_1_1").value;
      var Diagnosis_1=document.getElementById("sub_2_1").value;
      var Support_1=document.getElementById("sub_3_1").value;
    }

    if(hide_signal==9){ //3,2
      console.log("hide_signal == 9");
      var Patient_Type=document.getElementById("Ptype").value;
      var New_Old=document.getElementById("new_old").value;
      var Fever=document.getElementById("sub_1").value;
      var Diagnosis="-";
      var Support="-";
      var Patient_Type_1=document.getElementById("Ptype_1").value;
      var New_Old_1=document.getElementById("new_old_1").value;
      var Fever_1="-";
      var Diagnosis_1="-";
      var Support_1="-";
    }
    //no 3,3
    if(hide_signal==10){ //3,4
      console.log("hide_signal == 10");
      var Patient_Type=document.getElementById("Ptype").value;
      var New_Old=document.getElementById("new_old").value;
      var Fever=document.getElementById("sub_1").value;
      var Diagnosis="-";
      var Support="-";
      var Patient_Type_1=document.getElementById("Ptype_1").value;
      var New_Old_1=document.getElementById("new_old_1").value;
      var Fever_1=document.getElementById("sub_1_1").value;
      var Diagnosis_1=document.getElementById("sub_2_1").value;
      var Support_1="-";
    }
    if(hide_signal==11){ //3,5
      console.log("hide_signal == 11");
      var Patient_Type=document.getElementById("Ptype").value;
      var New_Old=document.getElementById("new_old").value;
      var Fever=document.getElementById("sub_1").value;
      var Diagnosis="-";
      var Support="-";
      var Patient_Type_1=document.getElementById("Ptype_1").value;
      var New_Old_1=document.getElementById("new_old_1").value;
      var Fever_1=document.getElementById("sub_1_1").value;
      var Diagnosis_1=document.getElementById("sub_2_1").value;
      var Support_1=document.getElementById("sub_3_1").value;
    }

    if(hide_signal==12){ //4,2
      console.log("hide_signal == 12");
      var Patient_Type=document.getElementById("Ptype").value;
      var New_Old=document.getElementById("new_old").value;
      var Fever=document.getElementById("sub_1").value;
      var Diagnosis=document.getElementById("sub_2").value;
      var Support="-";
      var Patient_Type_1=document.getElementById("Ptype_1").value;
      var New_Old_1=document.getElementById("new_old_1").value;
      var Fever_1="-";
      var Diagnosis_1="-";
      var Support_1="-";
    }
    // no 4,3 // 4,4 // 4,5
    if(hide_signal==13){ //5,2
      console.log("hide_signal == 13");
      var Patient_Type=document.getElementById("Ptype").value;
      var New_Old=document.getElementById("new_old").value;
      var Fever=document.getElementById("sub_1").value;
      var Diagnosis=document.getElementById("sub_2").value;
      var Support=document.getElementById("sub_3").value;

      var Patient_Type_1=document.getElementById("Ptype_1").value;
      var New_Old_1=document.getElementById("new_old_1").value;
      var Fever_1="-";
      var Diagnosis_1="-";
      var Support_1="-";
    }
    // no 5,3 //5,4 // 5,5
    if(hide_signal==5){
          var Patient_Type_1=document.getElementById("Ptype_1").value;
          var New_Old_1=document.getElementById("new_old_1").value;
          var Fever_1=document.getElementById("sub_1_1").value;
          var Diagnosis_1=document.getElementById("sub_2_1").value;
          var Support_1=document.getElementById("sub_3_1").value;
    }

    // var Patient_Type_2=document.getElementById("Ptype_2").value;
    // var New_Old_2=document.getElementById("new_old_2").value;
    // var Fever_2=document.getElementById("sub_1_2").value;
    // var Diagnosis_2=document.getElementById("sub_2_2").value;
    // var Support_2=document.getElementById("sub_3_2").value;

        var  data={
           next:next,
					 functionLoco:functionLoco,
           gid:gid,
           nDate:nDate,
           fDate:fDate,

           Patient_Type:Patient_Type ,
           New_Old:New_Old ,
           Fever:Fever ,
           Diagnosis:Diagnosis ,
           Support:Support ,

           Patient_Type_1:Patient_Type_1 ,
           New_Old_1:New_Old_1 ,
           Fever_1:Fever_1 ,
           Diagnosis_1:Diagnosis_1 ,
           Support_1:Support_1 ,
           //
           // Patient_Type_2:Patient_Type_2 ,
           // New_Old_2:New_Old_2 ,
           // Fever_2:Fever_2 ,
           // Diagnosis_2:Diagnosis_2 ,
           // Support_2:Support_2 ,

         };
    if(gid.length>0){
      $.ajaxSetup({
         headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
         }
       });
          $.ajax({
               type:'POST',
               url:"{{route('reception_road')}}",
               dataType:'json',
             //  processData:false,
               contentType:'application/json',
               data: JSON.stringify(data),
               success:function(response){
                console.log(response);
                if(!nDate){
                  alert("You only saved Diagnosis");
                }else{
                  alert("You saved nextappointment date and diagnoisi");
                }

                location.reload(true);// to refresh the page
               }
              });

    }else{
      alert("Please make sure General Code Or Next Appointment Date");
      location.reload(true);// to refresh the page
          }
}
// functjion location ( 10 ) to find data next appointment with category in nextappointment section
function search_nextAppointment(){
      /*
      // For Date
      var date = new Date();
      var day = date.getDate();
      var month = date.getMonth() + 1;
      var year = date.getFullYear();
      if (month < 10) month = "0" + month;
      if (day < 10) day = "0" + day;
      var today = year + "-" + month + "-" + day;
      document.getElementById('vDate').value = today;
      */
      var ndate =document.getElementById('ndate').value;
			ndate = formatDate(ndate); // Date formatChange function
			console.log(ndate);

      var visit_type =document.getElementById('visit_type').value;
			console.log(visit_type);
			var functionLoco=10;
      var ckdata = {
                      ndate:ndate,
											functionLoco:functionLoco,
                      visit_type:visit_type,
                    };
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
          }
        });
      $.ajax({
          type:'POST',
          url:"{{route('reception_road')}}",
          dataType:'json',
          contentType: 'application/json',
          data: JSON.stringify(ckdata),
          success:function(response){
            console.log(response);
              if(response[0].length >0){
                console.log("pass 1");
                document.getElementById("total_len").innerHTML='';
                document.getElementById("list").innerHTML='';
                console.log(response);
              var total_ID = response[0].length;
              $("#total_len").append("Total Patient for ("+ndate+") is "+total_ID+".");

                for (var i = 0; i < response[0].length; i++) {


                  var reason_from_table = response[0][i]["Patient Type"];

                  var gen_id_null = response[0][i]["Pid"];
                  if(gen_id_null == null){
                    gen_id_null = '-';
                  }
                  var fuchia_null = response[0][i]["FuchiaID"];
                  if(fuchia_null == null){
                    fuchia_null = "-";
                  }
                  var prep_null = response[0][i]["PrEPCode"];
                  if(prep_null == null){
                    prep_null = "-";
                  }
                  var unplan_alert = response[0][i]["Unplan"];
                  
                  var serialNo = i + 1;
                  var rows =("<tr class=reception_nextList"+unplan_alert+">"+
                              "<td >"+ serialNo +"</td>"+
                              "<td>"+ gen_id_null+"</td>"+
                              "<td>"+ fuchia_null+"</td>"+
                              "<td>"+ prep_null+"</td>"+
                              //"<td>"+ response[0][i]["Patient Type"]+"</td>"+
                              "<td>"+response[0][i]["Next Appointment Date"]+"</td>"+

                            "</tr>");
                            
                  $("#list").append(rows);
                  if(unplan_alert==2){
                              console.log("hello unplan is 2");
                              $(".reception_nextList2").css({
                                'background-color': 'green'
                              });
                              // $("#reception_nextList").css('background-color': 'yellow');
                   }
                   if(unplan_alert==1){
                              console.log("hello unplan is 1");
                              $(".reception_nextList1").css({
                                'background-color': 'red'
                              });
                              // $("#reception_nextList").css('background-color': 'yellow');
                     }
                }
              }else{
                document.getElementById("total_len").innerHTML='';
                document.getElementById("total_len").innerHTML='There is no data.';
                document.getElementById("list").innerHTML='';
              }
            }
          });
}
// function location ( 11 ) to show  history






function PatientType(){
        var type= document.getElementById('main_risk').value;
        if(sub_risk.innerHTML!=null){
          sub_risk.innerHTML="";
        }
        $("#sub_risk").empty();
        if(type == "Pregnant Mother"){
            var sel = document.getElementById('sub_risk');
            // create new option element
            var opt0 = document.createElement("option");
            var opt1 = document.createElement("option");
            var opt2 = document.createElement("option");
            // create text node to add to option element (opt)
          //  opt0.appendChild( document.createTextNode(""));
          //  opt1.appendChild( document.createTextNode("PP"));
          //  opt2.appendChild( document.createTextNode("MP"));
            // set value property of opt
            opt1.setAttribute('id','opt_ext_pp');
            opt2.setAttribute('id','opt_ext_mp');

            opt1.value = "PP";
            opt2.value = "MP";
            opt0.text = "";
            opt1.text = "PP";
            opt2.text = "MP";
            pregMum = 1;
            sel.addEventListener("click", sub_risk);

            // add opt to end of select box (sel)
            sel.add(opt0);
            sel.add(opt1);
            sel.add(opt2);

        }
        if(type == "Spouse of pregnant mother"){

          var sel = document.getElementById('sub_risk');
          // create new option element
          var opt0 = document.createElement("option");
          var opt1 = document.createElement("option");
          var opt2 = document.createElement("option");
          // create text node to add to option element (opt)
          opt0.appendChild( document.createTextNode(""));
          opt1.appendChild( document.createTextNode("HIV(Pos)"));
          opt2.appendChild( document.createTextNode("HIV(Neg)Woman"));
          // set value property of opt
          opt0.value ="";
          opt1.value ="HIV(Pos)";
          opt2.value ="HIV(Neg)Woman";
          // add opt to end of select box (sel)
          opt1.setAttribute('id','opt_ext_hivPos');
          opt2.setAttribute('id','opt_ext_hivNeg');

          sel.addEventListener("click", sub_risk);
          ////
          sel.appendChild(opt0);
          sel.appendChild(opt1);
          sel.appendChild(opt2);
          spm =1;

        }
        if(type == "Exposed Children"){

          var sel = document.getElementById('sub_risk');
          // create new option element
          var opt0 = document.createElement("option");
          var opt1 = document.createElement("option");
          var opt2 = document.createElement("option");
          var opt3 = document.createElement("option");
          var opt4 = document.createElement("option");
          // create text node to add to option element (opt)
          opt0.appendChild( document.createTextNode(""));
          opt1.appendChild( document.createTextNode("1"));
          opt2.appendChild( document.createTextNode("2"));
          opt3.appendChild( document.createTextNode("3"));
          opt4.appendChild( document.createTextNode("4"));

          // set value property of opt
          opt0.value = 0;
          opt1.value = 1;
          opt2.value = 2;
          opt3.value = 3;
          opt4.value = 4;
          ///////
          opt0.setAttribute('id','opt_ext_ec_0');
          opt1.setAttribute('id','opt_ext_ec_1');
          opt2.setAttribute('id','opt_ext_ec_2');
          opt3.setAttribute('id','opt_ext_ec_3');
          opt4.setAttribute('id','opt_ext_ec_4');

          sel.addEventListener("click", sub_risk);
          // add opt to end of select box (sel)
          sel.appendChild(opt0);
          sel.appendChild(opt1);
          sel.appendChild(opt2);
          sel.appendChild(opt3);
          sel.appendChild(opt4);
          epc = 1;
        }
        if(type == "Low risk"){
          var sel = document.getElementById('sub_risk');
          // create new option element
          var opt0 = document.createElement("option");
          //var opt1 = document.createElement("option");
          var opt2 = document.createElement("option");
          var opt3 = document.createElement("option");
          // create text node to add to option element (opt)
          opt0.appendChild( document.createTextNode(""));
          //opt1.appendChild( document.createTextNode("PWUD"));
          opt2.appendChild( document.createTextNode("Youth (15-24)"));
          opt3.appendChild( document.createTextNode("Other Low Risk"));

          opt0.setAttribute('id','opt_lr_0');
          //opt1.setAttribute('id','opt_lr_pwud');
          opt2.setAttribute('id','opt_lr_youth');
          opt3.setAttribute('id','opt_lr_other');
          // set value property of opt
          opt0.value = "";
          //opt1.value = "pwud";
          opt2.value = "Youth(15-24)";
          opt3.value = "Other Low Risk";

          sel.addEventListener("click", sub_risk);
          // add opt to end of select box (sel)
          sel.appendChild(opt0);
          //sel.appendChild(opt1);
          sel.appendChild(opt2);
          sel.appendChild(opt3);
          lr = 1;
        }
        // PWUD
        if(type == "FSW"){
          var sel = document.getElementById('sub_risk');
          // create new option element
          var opt0 = document.createElement("option");
          var opt1 = document.createElement("option");
          var opt2 = document.createElement("option");
          // create text node to add to option element (opt)
          opt0.appendChild( document.createTextNode(""));
          opt1.appendChild( document.createTextNode("FSW PWID"));
          opt2.appendChild( document.createTextNode("FSW PWUD"));
          // set value property of opt
          opt0.value = "";
          opt1.value = "FSW_PWID";
          opt2.value = "FSW_PWUD";

          opt0.setAttribute('id','opt_fsw_0');
          opt1.setAttribute('id','opt_fsw_pwid');
          opt2.setAttribute('id','opt_fsw_pwud');

          sel.addEventListener("click", sub_risk);
          // add opt to end of select box (sel)
          sel.appendChild(opt0);
          sel.appendChild(opt1);
          sel.appendChild(opt2);
          fsw = 1;
        }
        if(type == "Client of FSW"){
          opt0.value = "";
        }
        if(type == "MSM"){
          msm =1;
          var sel = document.getElementById('sub_risk');
          // create new option element
          var opt0 = document.createElement("option");
          var opt1 = document.createElement("option");
          var opt2 = document.createElement("option");
          // create text node to add to option element (opt)
          opt0.appendChild( document.createTextNode(""));
          opt1.appendChild( document.createTextNode("MSM PWID"));
          opt2.appendChild( document.createTextNode("MSM PWUD"));
          // set value property of opt
          opt0.value = "";
          opt1.value = "MSM_PWID";
          opt2.value = "MSM_PWUD";

          opt0.setAttribute('id','opt_msm_0');
          opt1.setAttribute('id','opt_msm_pwid');
          opt2.setAttribute('id','opt_msm_pwud');

          sel.addEventListener("click", sub_risk);

          // add opt to end of select box (sel)
          sel.appendChild(opt0);
          sel.appendChild(opt1);
          sel.appendChild(opt2);

        }
        if(type == "IDU"){
          var sel = document.getElementById('sub_risk');
          // create new option element
          var opt0 = document.createElement("option");
          var opt1 = document.createElement("option");
          var opt2 = document.createElement("option");

          // create text node to add to option element (opt)
          opt0.appendChild( document.createTextNode(""));
          opt1.appendChild( document.createTextNode("PWID/FSW"));
          opt2.appendChild( document.createTextNode("PWID/MSM"));
          // set value property of opt
          opt0.value = "";
          opt1.value = "PWID_FSW";
          opt2.value = "PWID_MSM";

          opt0.setAttribute('id','opt_idu_0');
          opt1.setAttribute('id','opt_idu_fsw');
          opt2.setAttribute('id','opt_idu_msm');

          sel.addEventListener("click", sub_risk);

          // add opt to end of select box (sel)
          sel.appendChild(opt0);
          sel.appendChild(opt1);
          sel.appendChild(opt2);
          idu = 1;

        }
        if(type == "TG"){
          var sel = document.getElementById('sub_risk');
          // create new option element
          var opt0 = document.createElement("option");
          var opt1 = document.createElement("option");
          var opt2 = document.createElement("option");
          var opt3 = document.createElement("option");
          // create text node to add to option element (opt)
          opt0.appendChild( document.createTextNode(""));
          opt1.appendChild( document.createTextNode("TG/PWID"));
          opt2.appendChild( document.createTextNode("TG/PWUD"));
          opt3.appendChild( document.createTextNode("TG/SW"));
          // set value property of opt
          opt0.value = "";
          opt1.value = "TG_PWID";
          opt2.value = "TG_PWUD";
          opt3.value = "TG_SW";

          opt0.setAttribute('id','opt_tg_0');
          opt1.setAttribute('id','opt_tg_pwid');
          opt2.setAttribute('id','opt_tg_pwud');
          opt3.setAttribute('id','opt_tg_sw');

          sel.addEventListener("click", sub_risk);

          // add opt to end of select box (sel)
          sel.appendChild(opt0);
          sel.appendChild(opt1);
          sel.appendChild(opt2);
          sel.appendChild(opt3);
          tg=1;
        }
        if(type == "Partner of KP"){
          var sel = document.getElementById('sub_risk');
          // create new option element
          var opt0 = document.createElement("option");
          var opt1 = document.createElement("option");
          var opt2 = document.createElement("option");
          var opt3 = document.createElement("option");
          var opt4 = document.createElement("option");
          // create text node to add to option element (opt)
          opt0.appendChild( document.createTextNode(""));
          opt1.appendChild( document.createTextNode("Partner of PWID"));
          opt2.appendChild( document.createTextNode("Partner of FSW"));
          opt3.appendChild( document.createTextNode("Female of MSM"));
          opt4.appendChild( document.createTextNode("Partner of TG"));
          // set value property of opt

          opt0.value = "";
          opt1.value = "Partner of PWID";
          opt2.value = "Partner of FSW";
          opt3.value = "Female of MSM";
          opt4.value = "Partner of TG";

          opt0.setAttribute('id','opt_pkp_0');
          opt1.setAttribute('id','opt_pkp_pwid');
          opt2.setAttribute('id','opt_pkp_fsw');
          opt3.setAttribute('id','opt_pkp_msm');
          opt4.setAttribute('id','opt_pkp_tg');

          sel.addEventListener("click", sub_risk);
            // add opt to end of select box (sel)
            sel.appendChild(opt0);
            sel.appendChild(opt1);
            sel.appendChild(opt2);
            sel.appendChild(opt3);
            sel.appendChild(opt4);
            pkp = 1;
          }
          // partner of PLHIV
        if(type == "Special Groups"){
          var sel = document.getElementById('sub_risk');
          // create new option element
          var opt0 = document.createElement("option");
          var opt1 = document.createElement("option");
          var opt2 = document.createElement("option");
          var opt3 = document.createElement("option");

          // create text node to add to option element (opt)
          opt0.appendChild( document.createTextNode(""));
          opt1.appendChild( document.createTextNode("TB Patient"));
          opt2.appendChild( document.createTextNode("Institutionalize"));
          opt3.appendChild( document.createTextNode("Uniformed Services Personnel"));

          // set value property of opt

          opt0.value = "";
          opt1.value = "TB Patient";
          opt2.value = "Institutionalize";
          opt3.value = "Uniformed Services Personnel";

          opt0.setAttribute('id','opt_sg_0');
          opt1.setAttribute('id','opt_sg_TB');
          opt2.setAttribute('id','opt_sg_insti');
          opt3.setAttribute('id','opt_sg_uni');

          sel.addEventListener("click", sub_risk);
          // add opt to end of select box (sel)
          sel.appendChild(opt0);
          sel.appendChild(opt1);
          sel.appendChild(opt2);
          sel.appendChild(opt3);

          sg=1;
        }
        // migrant
    } //Risk
function getAge(bd_date) {

      var dates = bd_date.split("-");
      var d = new Date();

      var useryear = dates[0];
      var usermonth = dates[1];
      var userday = dates[2];

      var curday = d.getDate();
      var realMonth = d.getMonth();
      var curmonth = d.getMonth()+1;
      var curyear = d.getFullYear();

      if(curyear == useryear){
        var age = realMonth - usermonth;
        console.log("month"+ age);
      }else{
        var age = curyear - useryear;
        console.log("age"+ age);
      }
      if((curmonth < usermonth) || ( (curmonth == usermonth) && curday < userday   )){
          age--;
      }

      return age;
  }



// Search
function region(){
  //to check state in Region option
  var state = document.getElementById("state").value;

    if(state == "Shan(East)"){//
        var Tcount = 15;
        const shan_e = [];
        shan_e[0] = "Kengtung"; shan_e[1] = "Mongkhet"; shan_e[2] = "Mongyang";
        shan_e[3] = "Mongla";  shan_e[4] = "Monghsat";  shan_e[5] = "Mongping";
        shan_e[6] = "Mongton"; shan_e[7] = "Tachileik";  shan_e[8] = "Monghpyak";
        shan_e[9] = "Mongyawng"; shan_e[10] = "Mong Hpen"; shan_e[11] = "Ho Tawng (Ho Tao)";
        shan_e[12] = "Mong Pawk"; shan_e[13] = "Mong Kar";  shan_e[14] = "Nam Hpai";

        // to clear option in select township
        var tt_inner = document.getElementById('tt');
        if(tt_inner.innerHTML!=null){
          tt_inner.innerHTML="";
        }
        // to show township
         for (var i = 0; i < Tcount; i++) {
           // get reference to select element
           var sel = document.getElementById('tt');
           // create new option element
           var opt = document.createElement("option");
           // create text node to add to option element (opt)
           opt.appendChild( document.createTextNode(shan_e[i]) );
           // set value property of opt
           opt.value = shan_e[i];
           // add opt to end of select box (sel)
           sel.appendChild(opt);
         }
       }
    if(state == "Sagaing"){//
      var Tcount = 34;
      const sagaing = [];
      sagaing[0] = "Sagaing"; sagaing[1] = "Myinmu"; sagaing[2] = "Myaung";
      sagaing[3] = "Shwebo";  sagaing[4] = "Khin-U";  sagaing[5] = "Wetlet";
      sagaing[6] = "Kanbalu"; sagaing[7] = "Kyunhla";  sagaing[8] = "Ye-U";
      sagaing[9] = "Tabayin"; sagaing[10] = "Taze"; sagaing[11] = "Monywa";
      sagaing[12] = "Budalin";sagaing[13] = "Ayadaw";sagaing[14] = "Chaung-U";
      sagaing[15] = "Yinmarbin";  sagaing[16] = "Kani"; sagaing[17] = "Salingyi";
      sagaing[18] = "Pale"; sagaing[19] = "Katha"; sagaing[20] = "Indaw";
      sagaing[21] = "Tigyaing";  sagaing[22] = "Banmauk"; sagaing[23] = "Kawlin";
      sagaing[24] = "Wuntho"; sagaing[25] = "Pinlebu";sagaing[26] = "Kale";
      sagaing[27] = "Kalewa";sagaing[28] = "Mingin"; sagaing[29] = "Tamu";
      sagaing[30] = "Mawlaik";sagaing[31] = "Paungbyin";sagaing[32] = "Hkamti";
      sagaing[33] = "Homalin"; sagaing[34] = "Lay Shi";  sagaing[35] = "Lahe";
       sagaing[36] = "Nanyun";

      // to clear option in select township
      var tt_inner = document.getElementById('tt');
      if(tt_inner.innerHTML!=null){
        tt_inner.innerHTML="";
      }
      // to show township
       for (var i = 0; i < Tcount; i++) {
         // get reference to select element
         var sel = document.getElementById('tt');
         // create new option element
         var opt = document.createElement("option");
         // create text node to add to option element (opt)
         opt.appendChild( document.createTextNode(sagaing[i]) );
         // set value property of opt
         opt.value = sagaing[i];
         // add opt to end of select box (sel)
         sel.appendChild(opt);
       }
      }
    if(state == "Rakhine"){//
      var Tcount = 17;
      const rakhine = [];
      rakhine[0] = "Sittwe"; rakhine[1] = "Ponnagyun"; rakhine[2] = "Mrauk-U";
      rakhine[3] = "Kyauktaw";  rakhine[4] = "Minbya";  rakhine[5] = "Myebon";
      rakhine[6] = "Pauktaw"; rakhine[7] = "Rathedaung";  rakhine[8] = "Maungdaw";
      rakhine[9] = "Buthidaung"; rakhine[10] = "Kyaukpyu"; rakhine[11] = "Munaung";
      rakhine[12] = "Ramree"; rakhine[13] = "Ann";rakhine[14] = "Thandwe";rakhine[15] = "Toungup";
      rakhine[16] = "Gwa";
      // to clear option in select township
      var tt_inner = document.getElementById('tt');
      if(tt_inner.innerHTML!=null){
        tt_inner.innerHTML="";
      }
      // to show township
       for (var i = 0; i < Tcount; i++) {
         // get reference to select element
         var sel = document.getElementById('tt');
         // create new option element
         var opt = document.createElement("option");
         // create text node to add to option element (opt)
         opt.appendChild( document.createTextNode(rakhine[i]) );
         // set value property of opt
         opt.value = rakhine[i];
         // add opt to end of select box (sel)
         sel.appendChild(opt);
       }
      }

  //Nay Pyi Taw
    if(state == "Nay Pyi Taw"){//
      var Tcount = 8;
      const naypyitaw = [];
      naypyitaw[0] = "Zay Yar Thi Ri"; naypyitaw[1] = "Za Bu Thi Ri"; naypyitaw[2] = "Tatkon";
      naypyitaw[3] = "Det Khi Na Thi Ri";  naypyitaw[4] = "Poke Ba Thi Ri";  naypyitaw[5] = "Pyinmana";
      naypyitaw[6] = "Lewe"; naypyitaw[7] = "Oke Ta Ra Thi Ri";
      // to clear option in select township
      var tt_inner = document.getElementById('tt');
      if(tt_inner.innerHTML!=null){
        tt_inner.innerHTML="";
      }
      // to show township
       for (var i = 0; i < Tcount; i++) {
         // get reference to select element
         var sel = document.getElementById('tt');
         // create new option element
         var opt = document.createElement("option");
         // create text node to add to option element (opt)
         opt.appendChild( document.createTextNode(naypyitaw[i]) );
         // set value property of opt
         opt.value = naypyitaw[i];
         // add opt to end of select box (sel)
         sel.appendChild(opt);
       }
    }

  //Mon
    if(state == "Mon"){//
        var Tcount = 10;
        const kachin = [];
        mon[0] = "Mawlamyine"; mon[1] = "Kyaikmaraw"; mon[2] = "Chaungzon";
        mon[3] = "Thanbyuzayat";  mon[4] = "Mudon";  mon[5] = "Ye";
        mon[6] = "Thaton"; mon[7] = "Paung";  mon[8] = "Kyaikto";
        mon[9] = "Bilin";
        // to clear option in select township
        var tt_inner = document.getElementById('tt');
        if(tt_inner.innerHTML!=null){
          tt_inner.innerHTML="";
        }
        // to show township
         for (var i = 0; i < Tcount; i++) {
           // get reference to select element
           var sel = document.getElementById('tt');
           // create new option element
           var opt = document.createElement("option");
           // create text node to add to option element (opt)
           opt.appendChild( document.createTextNode(mon[i]) );
           // set value property of opt
           opt.value = mon[i];
           // add opt to end of select box (sel)
           sel.appendChild(opt);
         }
  }

  //Mandalay
    if(state == "Mandalay"){
          var Tcount = 28;
          const mandalay = [];
          mandalay[0] = "Aungmyaythazan"; mandalay[1] = "Chanayethazan"; mandalay[2] = "Mahaaungmyay";
          mandalay[3] = "Chanmyathazi";  mandalay[4] = "Pyigyitagon";  mandalay[5] = "Amarapura";
          mandalay[6] = "Patheingyi"; mandalay[7] = "Pyinoolwin";  mandalay[8] = "Madaya";
          mandalay[9] = "Singu"; mandalay[10] = "Mogoke"; mandalay[11] = "Thabeikkyin";
          mandalay[12] = "Kyaukse"; mandalay[13] = "Sintgaing";  mandalay[14] = "Myittha";
          mandalay[15] = "Tada-U";  mandalay[16] = "Myingyan"; mandalay[17] = "Taungtha";
          mandalay[18] = "Natogyi"; mandalay[19] = "Kyaukpadaung"; mandalay[20] = "Ngazun";
          mandalay[21] = "Nyaung-U";  mandalay[22] = "Yamethin"; mandalay[23] = "Pyawbwe";
          mandalay[24] = "Meiktila"; mandalay[25] = "Mahlaing";mandalay[26] = "Thazi";
          mandalay[27] = "Wundwin";

          // to clear option in select township
          var tt_inner = document.getElementById('tt');
          if(tt_inner.innerHTML!=null){
            tt_inner.innerHTML="";
          }
          // to show township
           for (var i = 0; i < Tcount; i++) {
             // get reference to select element
             var sel = document.getElementById('tt');
             // create new option element
             var opt = document.createElement("option");
             // create text node to add to option element (opt)
             opt.appendChild( document.createTextNode(mandalay[i]) );
             // set value property of opt
             opt.value = mandalay[i];
             // add opt to end of select box (sel)
             sel.appendChild(opt);
           }
        }

  //Magway
    if(state == "Magway"){
        var Tcount = 26;
        const magway = [];
        magway[0] = "Magway"; magway[1] = "Yenangyaung"; magway[2] = "Chauk";
        magway[3] = "Taungdwingyi";  magway[4] = "Myothit";  magway[5] = "Natmauk";
        magway[6] = "Minbu"; magway[7] = "Pwintbyu";  magway[8] = "Ngape";
        magway[9] = "Lemyethna"; magway[10] = "Salin"; magway[11] = "Sidoktaya";
        magway[12] = "Thayet"; magway[13] = "Minhla";  magway[14] = "Mindon";
        magway[15] = "Kamma";  magway[16] = "Aunglan"; magway[17] = "Sinbaungwe";
        magway[18] = "Pakokku"; magway[19] = "Yesagyo"; magway[20] = "Myaing";
        magway[21] = "Pauk";  magway[22] = "Seikphyu"; magway[23] = "Gangaw";
        magway[24] = "Tilin"; magway[25] = "Saw";
        // to clear option in select township
        var tt_inner = document.getElementById('tt');
        if(tt_inner.innerHTML!=null){
          tt_inner.innerHTML="";
        }
        // to show township
         for (var i = 0; i < Tcount; i++) {
           // get reference to select element
           var sel = document.getElementById('tt');
           // create new option element
           var opt = document.createElement("option");
           // create text node to add to option element (opt)
           opt.appendChild( document.createTextNode(magway[i]) );
           // set value property of opt
           opt.value = magway[i];
           // add opt to end of select box (sel)
           sel.appendChild(opt);
         }
  }

    if(state == "Kayin"){//
        var Tcount = 7;
        const kayin = [];
        kayin[0] = "Hpa-An"; kayin[1] = "Hlaingbwe"; kayin[2] = "Hpapun";
        kayin[3] = "Thandaunggyi";  kayin[4] = "Myawaddy";  kayin[5] = "Kawkareik";
        kayin[6] = "Kyainseikgyi";
        // to clear option in select township
        var tt_inner = document.getElementById('tt');
        if(tt_inner.innerHTML!=null){
          tt_inner.innerHTML="";
        }
        // to show township
         for (var i = 0; i < Tcount; i++) {
           // get reference to select element
           var sel = document.getElementById('tt');
           // create new option element
           var opt = document.createElement("option");
           // create text node to add to option element (opt)
           opt.appendChild( document.createTextNode(kayin[i]) );
           // set value property of opt
           opt.value = kayin[i];
           // add opt to end of select box (sel)
           sel.appendChild(opt);
         }
  }

    if(state == "Kayah"){//
      var Tcount = 7;
      const kayah = [];
      kayah[0] = "Loikaw"; kayah[1] = "Demoso"; kayah[2] = "Hpruso";
      kayah[3] = "Shadaw";  kayah[4] = "Bawlake";  kayah[5] = "Hpasawng";
      kayah[6] = "Mese";
      // to clear option in select township
      var tt_inner = document.getElementById('tt');
      if(tt_inner.innerHTML!=null){
        tt_inner.innerHTML="";
      }
      // to show township
       for (var i = 0; i < Tcount; i++) {
         // get reference to select element
         var sel = document.getElementById('tt');
         // create new option element
         var opt = document.createElement("option");
         // create text node to add to option element (opt)
         opt.appendChild( document.createTextNode(kayah[i]) );
         // set value property of opt
         opt.value = kayah[i];
         // add opt to end of select box (sel)
         sel.appendChild(opt);
       }
  }

    if(state == "Kachin"){//
        var Tcount = 17;
        const kachin = [];
        kachin[0] = "Myitkyina"; kachin[1] = "Waingmaw"; kachin[2] = "Injangyang";
        kachin[3] = "Tanai";  kachin[4] = "Chipwi";  kachin[5] = "Tsawlaw";
        kachin[6] = "Mohnyin"; kachin[7] = "Mogaung";  kachin[8] = "Hpakant";
        kachin[9] = "Bhamo"; kachin[10] = "Momauk"; kachin[11] = "Mansi";
        kachin[12] = "Puta-O"; kachin[13] = "Sumprabum";  kachin[14] = "Machanbaw";
        kachin[15] = "Nawngmun";  kachin[16] = "Khaunglanhpu";
        // to clear option in select township
        var tt_inner = document.getElementById('tt');
        if(tt_inner.innerHTML!=null){
          tt_inner.innerHTML="";
        }
        // to show township
         for (var i = 0; i < Tcount; i++) {
           // get reference to select element
           var sel = document.getElementById('tt');
           // create new option element
           var opt = document.createElement("option");
           // create text node to add to option element (opt)
           opt.appendChild( document.createTextNode(kachin[i]) );
           // set value property of opt
           opt.value = kachin[i];
           // add opt to end of select box (sel)
           sel.appendChild(opt);
         }
       }

    if(state == "Chin"){
        var Tcount = 9;
        const chin = [];
        chin[0] = "Falam"; chin[1] = "Hakha"; chin[2] = "Thantlang";
        chin[3] = "Tedim";  chin[4] = "Tonzang";  chin[5] = "Mindat";
        chin[6] = "Matupi"; chin[7] = "Kanpetlet";  chin[8] = "Paletwa";
        // to clear option in select township
        var tt_inner = document.getElementById('tt');
        if(tt_inner.innerHTML!=null){
          tt_inner.innerHTML="";
        }
        // to show township
         for (var i = 0; i < Tcount; i++) {
           // get reference to select element
           var sel = document.getElementById('tt');
           // create new option element
           var opt = document.createElement("option");
           // create text node to add to option element (opt)
           opt.appendChild( document.createTextNode(chin[i]) );
           // set value property of opt
           opt.value = chin[i];
           // add opt to end of select box (sel)
           sel.appendChild(opt);
         }
       }

    if(state == "Bago(West)"){//
      var Tcount = 14;
      const Bago_E = [];
      Bago_E[0] = "Pyay"; Bago_E[1] = "Paukkhaung"; Bago_E[2] = "Padaung";
      Bago_E[3] = "Paungde";  Bago_E[4] = "Thegon";  Bago_E[5] = "Shwedaung";
      Bago_E[6] = "Thayarwady"; Bago_E[7] = "Letpadan";  Bago_E[8] = "Minhla";
      Bago_E[9] = "Okpho"; Bago_E[10] = "Zigon"; Bago_E[11] = "Nattalin";
      Bago_E[12] = "Monyo"; Bago_E[13] = "Gyobingauk";
      // to clear option in select township
      var tt_inner = document.getElementById('tt');
      if(tt_inner.innerHTML!=null){
        tt_inner.innerHTML="";
      }
      // to show township
       for (var i = 0; i < Tcount; i++) {
         // get reference to select element
         var sel = document.getElementById('tt');
         // create new option element
         var opt = document.createElement("option");
         // create text node to add to option element (opt)
         opt.appendChild( document.createTextNode(Bago_E[i]) );
         // set value property of opt
         opt.value = Bago_E[i];
         // add opt to end of select box (sel)
         sel.appendChild(opt);
       }
      }
    //Ayeyarwady
    if(state == "Ayeyarwady"){
      var Tcount = 26;
      const Ayeyar = [];
      Ayeyar[0] = "Pathein"; Ayeyar[1] = "Kangyidaunt"; Ayeyar[2] = "Thabaung";
      Ayeyar[3] = "Ngapudaw";  Ayeyar[4] = "Kyonpyaw";  Ayeyar[5] = "Yegyi";
      Ayeyar[6] = "Kyaunggon"; Ayeyar[7] = "Hinthada";  Ayeyar[8] = "Zalun";
      Ayeyar[9] = "Lemyethna"; Ayeyar[10] = "Myanaung"; Ayeyar[11] = "Kyangin";
      Ayeyar[12] = "Ingapu"; Ayeyar[13] = "Myaungmya";  Ayeyar[14] = "Einme";
      Ayeyar[15] = "Labutta";  Ayeyar[16] = "Wakema"; Ayeyar[17] = "Mawlamyinegyun";
      Ayeyar[18] = "Maubin"; Ayeyar[19] = "Pantanaw"; Ayeyar[20] = "Nyaungdon";
      Ayeyar[21] = "Danubyu";  Ayeyar[22] = "Pyapon"; Ayeyar[23] = "Bogale";
      Ayeyar[24] = "Kyaiklat"; Ayeyar[25] = "Dedaye";
      // to clear option in select township
      var tt_inner = document.getElementById('tt');
      if(tt_inner.innerHTML!=null){
        tt_inner.innerHTML="";
      }
      // to show township
       for (var i = 0; i < Tcount; i++) {
         // get reference to select element
         var sel = document.getElementById('tt');
         // create new option element
         var opt = document.createElement("option");
         // create text node to add to option element (opt)
         opt.appendChild( document.createTextNode(Ayeyar[i]) );
         // set value property of opt
         opt.value = Ayeyar[i];
         // add opt to end of select box (sel)
         sel.appendChild(opt);
       }
  }
    //Bago(east)
    if(state == "Bago(East)"){
      var Tcount = 14;
      const bago = [];
        bago[0] = "Bago";  bago[1] = "Thanatpin"; bago[2] = "Kawa";
        bago[3] = "Waw"; bago[4] = "Nyaunglebin"; bago[5] = "Kyauktaga";
        bago[6] = "Daik-U";  bago[7] = "Shwegyin";  bago[8] = "Taungoo";
        bago[9] = "Yedashe"; bago[10] = "Kyaukkyi"; bago[11] = "Phyu";
        bago[12] = "Oktwin"; bago[13] = "Htantabin";
        // to clear option in select township
        var tt_inner = document.getElementById('tt');
        if(tt_inner.innerHTML!=null){
          tt_inner.innerHTML="";
        }
      // to show township
       for (var i = 0; i < Tcount; i++) {
         // get reference to select element
         var sel = document.getElementById('tt');
         // create new option element
         var opt = document.createElement("option");
         // create text node to add to option element (opt)
         opt.appendChild( document.createTextNode(bago[i]) );
         // set value property of opt
         opt.value = bago[i];
         // add opt to end of select box (sel)
         sel.appendChild(opt);
       }
     }
  if(state == "Yangon"){
         var Tcount = 45;
         const yangon = [];
          yangon[0] ="Hlaingtharya";yangon[1] ="MingalarDon" ;yangon[2] = "Hmawbi";
          yangon[3] ="Hlegu";yangon[4] ="Taikkyi" ;yangon[5]="Htantabin" ;
          yangon[6] ="Shwepyithar" ;yangon[7] = "Insein";yangon[8] ="Thingangyun" ;
          yangon[9] = "Yankin";yangon[10] = "South Okkalapa";yangon[11] = "North Okkalapa";
          yangon[12] = "Thaketa";yangon[13] ="Dawbon";yangon[14] ="Tamwe" ;
          yangon[15] = "Pazundaung";yangon[16] = "Botahtaung";yangon[17]  ="Dagon Myothit (South)" ;
          yangon[18]  = "Dagon Myothit (North)";yangon[19] ="Dagon Myothit (East)";
          yangon[20] = "Dagon Myothit (Seikkan)";yangon[21]= "Mingalartaungnyunt";
          yangon[22] = "Thanlyin";yangon[23] = "Kyauktan";yangon[24] = "Thongwa";
          yangon[25] = "Kayan";yangon[26] = "Twantay";yangon[27] = "Kawhmu";
          yangon[28] = "Kungyangon";yangon[29] = "Dala";yangon[30] = "Seikgyikanaungto";
          yangon[31] = "Cocokyun";yangon[32] = "Kyauktada";yangon[33] = "Pabedan";
          yangon[34] = "Lanmadaw";yangon[35] ="Latha" ;yangon[36] = "Ahlone";
          yangon[37] = "Kyeemyindaing";yangon[38] ="Sanchaung" ;yangon[39] = "Hlaing";
          yangon[40] = "Kamaryut";yangon[41] = "Mayangone";yangon[42] = "Dagon";
          yangon[43] = "Bahan";yangon[44] = "Seikkan";
          // to clear option in select township
          var tt_inner = document.getElementById('tt');
          if(tt_inner.innerHTML!=null){
            tt_inner.innerHTML="";
          }
          // to show township
          for (var i = 0; i < Tcount; i++) {
            // get reference to select element
            var sel = document.getElementById('tt');
            // create new option element
            var opt = document.createElement("option");
            // create text node to add to option element (opt)
            opt.appendChild( document.createTextNode(yangon[i]) );
            // set value property of opt
            opt.value = yangon[i];
            // add opt to end of select box (sel)
            sel.appendChild(opt);
          }
       }
     }

function General(){
  /*
  var oiName = document.getElementById("tt_sub").value;

  if(oiName == "Hypertension" || oiName =='DM' || oiName=='Both(Hypertension-DM)'){
    var Tcount = 3;
    const ptype_sub = [];
    ptype_sub[0]="";
    ptype_sub[1] = "Hiv (Pos)"; ptype_sub[2] = "Hiv (neg)";

    // to clear option in select township
    var tt_inner_2 = document.getElementById('tt_sub_2');
    if(tt_inner_2.innerHTML!=null){
      tt_inner_2.innerHTML="";
    }
    // to show township
     for (var i = 0; i < Tcount; i++) {
       // get reference to select element
       var sel = document.getElementById('tt_sub_2');
       // create new option element
       var opt = document.createElement("option");
       // create text node to add to option element (opt)
       opt.appendChild( document.createTextNode(ptype_sub[i]) );
       // set value property of opt
       opt.value = ptype_sub[i];

       // add opt to end of select box (sel)
       sel.appendChild(opt);
     }
  }*/

}
function refresh(){
    location.reload(true);
  }
function clearFacts(){
  document.getElementById("gid").value="";
  document.getElementById("name").value="";
  document.getElementById("father").value="";
  document.getElementById("agey").value="";
  document.getElementById("agem").value="";
  document.getElementById("gender").value="";
  document.getElementById("fid").value="";
  document.getElementById("prepCode").value="";
  document.getElementById("state").value="";
  document.getElementById("tt_opt").value="";
  document.getElementById("state").value="";
  //document.getElementById("quarter").value="";
  //document.getElementById("Ptype").value="";
  //document.getElementById("tt_sub").value="";
  //document.getElementById("tt_sub_2").value="";
  //document.getElementById("new_old").value="";

}

function monthValid(){
  var agey_test = document.getElementById('agey').value;
  if(!agey_test){
    console.log("Month is OK.");
  }else{
    alert("Please input one of the entry in Age(Year) or Age (Month)");
    document.getElementById('agey').value="";
    document.getElementById('agem').value="";
    document.getElementById('dob').value="";
  }

}

// Reception Return function
// let generatedID=0;
  // let generatedID1=0;
  // let genID=[];
  // let ddDate=0;
  // let hide_signal=0;



function clearFacts(){
  document.getElementById("fid").value="";
  document.getElementById("fup_date").value="";

  document.getElementById("nDate").value="";
}
function hide_rows(){
  $("#add_more1").hide();
  $("#add_more2").hide();
}
function show_1_row(){
  $("#add_more1").show();
}
function show_2_row(){
  $("#add_more2").show();
}
function remove_1_row(){
  $("#add_more1").hide();
}
function remove_2_row(){
  $("#add_more2").hide();
}

function Consulation(){

    var ptCat = document.getElementById("Ptype").value;
    if(ptCat == "PHA" || ptCat == "ART"){//
      var sub_box= document.getElementById("sub_category_box");
      if(sub_box.innerHTML!=null){
        sub_box.innerHTML="";
      }
      var select = document.createElement("select");
      sub_box.appendChild(select);
      select.setAttribute('id','sub_1');
              var Tcount = 2;
              const ptype_sub = [];
              ptype_sub[0] = "MAM Cohort - Yes"; ptype_sub[1] = "MAM Cohort - No";
              var sub1_inner = document.getElementById('sub_1');
              if(sub1_inner.innerHTML!=null){
                sub1_inner.innerHTML="";
              }
                for (var i = 0; i < Tcount; i++) {
                  var sel = document.getElementById('sub_1');
                  var opt = document.createElement("option");
                  opt.appendChild( document.createTextNode(ptype_sub[i]) );

									if(i==0){
										opt.value="MAM_Cohort_Yes";
									}else{
										opt.value="MAM_Cohort_No";
									}
                  select.appendChild(opt);
                }
                hide_signal=2;
    }
    if(ptCat == "General"){//
      hide_signal=3;
      var sub_box= document.getElementById("sub_category_box");
      if(sub_box.innerHTML!=null){
        sub_box.innerHTML="";
      }
      var select = document.createElement("select");
      var select1 = document.createElement("select");
      var select3 = document.createElement("select");
      ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
      sub_box.appendChild(select);
      select.setAttribute('id','sub_1');
              var Tcount = 2;
              const ptype_sub = [];
              ptype_sub[0] = "Refer to Fever Team - No"; ptype_sub[1] = "Refer to Fever Team - Yes";
              if(select.innerHTML!=null){
                select.innerHTML="";
              }
                for (var i = 0; i < Tcount; i++) {
                  var sel = document.getElementById('sub_1');
                  var opt = document.createElement("option");
                  opt.appendChild( document.createTextNode(ptype_sub[i]) );
                  if(i==0){
                    opt.value="Ref_Fever_No";
                  }else{
                    opt.value="Ref_Fever_Yes";
                  }

                  select.appendChild(opt);
                }
      ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
      if(select3.innerHTML!=null){
        select3.innerHTML="";
      }
      sub_box.appendChild(select1);
      select1.setAttribute('id','sub_2');
              Tcount = 21;


              ptype_sub[0] = "1. HIV (-) TB";
              ptype_sub[1] = "2. Hypertension only";
              ptype_sub[2] = "3. Diabetes only";
              ptype_sub[3] = "4. H/T & DM commodities";
              ptype_sub[4] = "5. RTI(< 2wks)";
              ptype_sub[5] = "6. RTI(>=2wks)";
              ptype_sub[6] = "7. Obstructive Pul. D/s";
              ptype_sub[7] = "8. NCD/ Cerebrovascular diseases (CVD)";
              ptype_sub[8] = "9. Renal D/s";
              ptype_sub[9] = "10. GI & Hepatobiliary";
              ptype_sub[10] = "11. Gynaecology";
              ptype_sub[11] = "12. Musculoskeleton and rheumatology";
              ptype_sub[12] = "13. Skin infection";
              ptype_sub[13]="14. Covid related consultation";
              ptype_sub[14]="15. TB related consultation";
              ptype_sub[15] = "16. Sexual violence";
              ptype_sub[16] = "17. STI";
              ptype_sub[17] = "18. DF";
              ptype_sub[18] = "19. Malnourished";
              ptype_sub[19] = "20. Child Abuse";
              ptype_sub[20] = "21. Others";
              if(select1!=null){
                select1.innerHTML="";
              }
              var opt_name= [];
                for (var i = 0; i < Tcount; i++) {
                  var sel = document.getElementById('sub_2');
                  var opt = document.createElement("option");
                  opt.appendChild( document.createTextNode(ptype_sub[i]) );
                  var num_gv = i+1;
                  opt_name[i] = "option_"+i;
                  opt.setAttribute('id',opt_name[i]);
                  opt.value = ptype_sub[i];
                  select1.appendChild(opt);
                }
                document.getElementById("sub_2").addEventListener("change", function(){
									select3.removeAttribute('class','hide-select');
                  var sb = document.querySelector('#sub_2')
                    var index_ck = sb.selectedIndex;
                    select3.setAttribute('id','sub_3');
                    if(index_ck==1 || index_ck ==2 || index_ck == 3){
											  hide_signal=4;
                      sub_box.appendChild(select3);
                                var Tcount = 2;
                                const ptype_sub = [];
                                ptype_sub[0] = "Drug supply by MAM-Yes"; ptype_sub[1] = "Drug supply by MAM-No";
                                if(select3.innerHTML!=null){
                                  select3.innerHTML="";
                                }
                                for (var i = 0; i < Tcount; i++) {
                                  var sel = document.getElementById('sub_3');
                                  var opt = document.createElement("option");
                                  opt.appendChild( document.createTextNode(ptype_sub[i]) );
                                  if(i==0){
                                    opt.value="No";
                                  }else{
                                    opt.value="Yes";
                                  }
                                  select3.appendChild(opt);
                                }
                    }else{

                      select3.setAttribute('class','hide-select');
											hide_signal=3;
                    }


                }, false);

    }
    if(ptCat == "PrEP" || ptCat == "PMTCT" || ptCat == "ANC" || ptCat == "FP" || ptCat == "FC" || ptCat == "lab_iv_only"){
      $("#sub_1").addClass("hide-select");
      $("#sub_2").addClass("hide-select");
      $("#sub_3").addClass("hide-select");
      hide_signal=1;
    }
}

function Consulation1(){
    console.log("you arrived cousulation 2");
    var ptCat = document.getElementById("Ptype_1").value;
    console.log(ptCat);
    // if(ptCat == "PHA" || ptCat == "ART"){//
    //   console.log("PHA or ART");
    //   if(hide_signal==1){
    //     hide_signal=6;
    //   }
    //
    //   var sub_box= document.getElementById("sub_category_box_1");
    //   if(sub_box.innerHTML!=null){
    //     sub_box.innerHTML="";
    //   }
    //   //sub_box.append(sub_1);
    //
    //   var select = document.createElement("select");
    //   //var text = document.createElement("label");
    //   //text.innerHTML="***";
    //   //sub_box.appendChild(text);
    //   sub_box.appendChild(select);
    //
    //   select.setAttribute('id','sub_1_1');
    //            var Tcount = 2;
    //            const ptype_sub = [];
    //            ptype_sub[0] = "MAM Cohort - Yes"; ptype_sub[1] = "MAM Cohort - No";
    //
    //            // to clear option in select township
    //            var sub1_inner = document.getElementById('sub_1_1');
    //
    //            if(sub1_inner.innerHTML!=null){
    //              sub1_inner.innerHTML="";
    //
    //            }
    //            // to show township
    //             for (var i = 0; i < Tcount; i++) {
    //               // get reference to select element
    //               var sel = document.getElementById('sub_1_1');
    //
    //               // create new option element
    //               var opt = document.createElement("option");
    //
    //               // create text node to add to option element (opt)
    //               opt.appendChild( document.createTextNode(ptype_sub[i]) );
    //
    //               // set value property of opt
    //               opt.value = ptype_sub[i];
    //
    //               // add opt to end of select box (sel)
    //               select.appendChild(opt);
    //               //document.getElementById('tt_sub_2').innerHTML="";
    //
    //             }
    //           }
    if(ptCat == "General"){//
      if(hide_signal==1){
        hide_signal=7;
      }
      if(hide_signal==2){//PHA or ART 3,4
        hide_signal=10;
      }



      var sub_box= document.getElementById("sub_category_box_1");
      if(sub_box.innerHTML!=null){
        sub_box.innerHTML="";
      }
      var select = document.createElement("select");
      var select1 = document.createElement("select");
      var select3 = document.createElement("select");
      ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
      sub_box.appendChild(select);
      select.setAttribute('id','sub_1_1');
                var Tcount = 2;
                const ptype_sub = [];
                ptype_sub[0] = "Refer to Fever Team - No"; ptype_sub[1] = "Refer to Fever Team - Yes";
                if(select.innerHTML!=null){
                  select.innerHTML="";
                }
                for (var i = 0; i < Tcount; i++) {
                  var sel = document.getElementById('sub_1_1');
                  var opt = document.createElement("option");
                  opt.appendChild( document.createTextNode(ptype_sub[i]) );
									if(i==0){
                    opt.value="Ref_Fever_No";
                  }else{
                    opt.value="Ref_Fever_Yes";
                  }

                  select.appendChild(opt);
                }
      ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
      if(select3.innerHTML!=null){
        select3.innerHTML="";
      }
      sub_box.appendChild(select1);
      select1.setAttribute('id','sub_2_1');
      Tcount = 21;
      ptype_sub[0] = "1. HIV (-) TB";
      ptype_sub[1] = "2. Hypertension only";
      ptype_sub[2] = "3. Diabetes only";
      ptype_sub[3] = "4. H/T & DM commodities";
      ptype_sub[4] = "5. RTI(< 2wks)";
      ptype_sub[5] = "6. RTI(>=2wks)";
      ptype_sub[6] = "7. Obstructive Pul. D/s";
      ptype_sub[7] = "8. NCD/ Cerebrovascular diseases (CVD)";
      ptype_sub[8] = "9. Renal D/s";
      ptype_sub[9] = "10. GI & Hepatobiliary";
      ptype_sub[10] = "11. Gynaecology";
      ptype_sub[11] = "12. Musculoskeleton and rheumatology";
      ptype_sub[12] = "13. Skin infection";
      ptype_sub[13]="14. Covid related consultation";
      ptype_sub[14]="15. TB related consultation";
      ptype_sub[15] = "16. Sexual violence";
      ptype_sub[16] = "17. STI";
      ptype_sub[17] = "18. DF";
      ptype_sub[18] = "19. Malnourished";
      ptype_sub[19] = "20. Child Abuse";
      ptype_sub[20] = "21. Others";
                if(select1!=null){
                  select1.innerHTML="";
                }
                var opt_name= [];
                for (var i = 0; i < Tcount; i++) {
                  var sel = document.getElementById('sub_2_1');
                  var opt = document.createElement("option");
                  opt.appendChild( document.createTextNode(ptype_sub[i]) );
                  opt_name[i] = "option_"+i;
                  var num_gi = i + 1;
                  opt.setAttribute('id',opt_name[i]);
                  opt.value = ptype_sub[i];
                  select1.appendChild(opt);
                }

                document.getElementById("sub_2_1").addEventListener("change", function(){
									select3.removeAttribute('class','hide-select');
                  if(hide_signal==1){
                    hide_signal=8;
                  }

                    var sb = document.querySelector('#sub_2_1')
                      var index_ck = sb.selectedIndex;
                      if(index_ck==1 || index_ck ==2 || index_ck == 3){

												if(hide_signal==10){//PHA or ART  3,5
			                    hide_signal=11;
			                    console.log("hide signal 11");
			                  }

                        sub_box.appendChild(select3);
                        select3.setAttribute('id','sub_3_1');
                                var Tcount = 2;
                                const ptype_sub = [];
                                ptype_sub[0] = "Drug supply by MAM-Yes"; ptype_sub[1] = "Drug supply by MAM-No";
                                if(select3.innerHTML!=null){
                                  select3.innerHTML="";
                                }
                                  for (var i = 0; i < Tcount; i++) {
                                    var sel = document.getElementById('sub_3_1');
                                    var opt = document.createElement("option");
                                    opt.appendChild( document.createTextNode(ptype_sub[i]) );
                                    if(i==0){
                                      opt.value="No";
                                    }else{
                                      opt.value="Yes";
                                    }
                                  //  opt.value = ptype_sub[i];
                                    select3.appendChild(opt);
                                  }
                      }else{

                          select3.setAttribute('class','hide-select');

                      }

                  }, false);

    }
    if(ptCat == "PrEP" || ptCat == "PMTCT" || ptCat == "ANC" || ptCat == "FP" || ptCat == "FC" || ptCat == "lab_iv_only"){
      $("#sub_1_1").addClass("hide-select");
      $("#sub_2_1").addClass("hide-select");
      $("#sub_3_1").addClass("hide-select");
      if(hide_signal==1){
        hide_signal=5;
      }
      if(hide_signal==2){//PHA or ART
        hide_signal=9;
      }
      if(hide_signal==3){//PHA or ART 4,2
        hide_signal=12;
      }
      if(hide_signal==4){//PHA or ART 5,2
        hide_signal=13;
      }


    }
}
//  Reception Next-Appointment function_list
// Reception FollowUp fucnction_List

function hide(){
  $("#updatePageView").hide();
}


function followupHistory(){
	  var gid =document.getElementById('id_hist').value;
	  ptID = gid;
	  var ck_followUpHistory =1;
		var functionLoco=11;
	  var ckdata = {
	                  gid:gid,
										functionLoco:functionLoco,
	                  ck_followUpHistory:ck_followUpHistory
	                };
	  $.ajaxSetup({
	      headers: {
	          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
	       }
	     });
	  $.ajax({
	      type:'POST',
	      url:"{{route('reception_road')}}",
	      dataType:'json',
	      contentType: 'application/json',
	      data: JSON.stringify(ckdata),
	      success:function(response){
	        console.log(response);
          $("#followupHistory").empty();
	        for (var i = 0; i < response[0].length; i++) {
            
	          var rowName = "tr_"+i;
	          var btnName = "btn_"+i;
	          var srNum = i + 1;
	          var but_ton1 = "<a  data-toggle='tab' href='#rpr' onclick='rpr_row_0(resp)' class='nav-link btn btn-warning'>"+"Update Data"+"</a>" ;
	           var result_body1 =
	           "<tr style='background-color:#A7DBD8;'"+ "id='"+rowName+"'>"
	             +"<td id='updateSerial1'>"+srNum+"</td>"
	             +"<td >"+response[0][i]['id']+"</td>"
	             +"<td >"+response[0][i]['Visit Date']+"</td>"
	             +"<td id='col_3'>"+response[0][i]['Pid']+"</td>"
	             +"<td>"+response[0][i]['FuchiaID']+"</td>"
	             +"<td>"+response[0][i]['PrEPCode']+"</td>"
	             +"<td >"+response[0][i]['Agey']+"</td>"
	             +"<td>"+response[1]+"</td>"
	             +"<td  id='"+btnName+"'>"+"<a style='border-bottom:4px solid yellow;' onclick='row_num()' >"+ "Update"+"</a>"+"</td>"
	           +"</tr>";
	           $("#followupHistory").append(result_body1);
	        }
	        
	          
	         
	  if ($(window).width() < 1161 && $(window).width()>599.9 ) {
      $("#followupHistory-tablet").empty();
	    console.log ("hello tablet cc");
	    var result_body_tablet="<ul class='clearfix'>"+"<li>"+'General ID.- '+"<b id='tablet_updateID'>"+response[0][0]['Pid']+"</b>"+"</li>"+"<li>"+'Fuchia ID- '+response[0][0]['FuchiaID']+"</li>"+"<li>"+'PrEPCode- '+response[0][0]['PrEPCode']+"</li>"+"<li>"+'Age- '+response[0][0]['Agey']+"</li>"+"<li>"+'sex- '+response[1]+"</li>"+"</ul>";
	    $("#followupHistory-tablet").append(result_body_tablet);
	    // result_body_tablet="<ul class='clearfix'>"+"<li>"+response[0][0]['Pid']+"</li>"+"<li>"+response[0][0]['FuchiaID']+"</li>"+"<li>"+response[0][0]['PrEPCode']+"</li>"+"<li>"+response[0][0]['Agey']+"</li>"+"<li>"+response[0][0]['Gender']+"</li>"+"</ul>";
	    // $("#followupHistory-tablet").append(result_body_tablet);
	    result_body_tablet="<ul class='clearfix'>"+"<li>"+'NO.'+"</li>"+"<li>"+'Row ID'+"</li>"+"<li>"+'Visit Date'+"</li>"+"<li>"+''+"</li>"+"</ul>";
	    $("#followupHistory-tablet").append(result_body_tablet);
	    for (var i = 0; i < response[0].length; i++) {
	          var srNum = i + 1;
	          var btnName = "btn_"+i;
	          var rowName = "ul_"+i;

	            var result_body_tablet = "<ul class='clearfix'"+ "id='"+rowName+"'>"+"<li>"+srNum+"</li>"+"<li>"+response[0][i]['id']+"</li>"
	            +"<li>"+response[0][i]['Visit Date']+"</li>"
	            +"<li id='"+btnName+"'>"+"<button onclick='row_num()' >"+ "Update"+"</button>"+"</li>"+"</ul>";
	           $("#followupHistory-tablet").append(result_body_tablet);
	        }


	  } else if($(window).width()<600 ) {
      $("#followupHistory-mobile").empty();

	    var result_body_mobile="<h5 style='display:inline-block;margin-right:4%;color:#b0d991'>"+"General Id-"+"</h5>"+"<b id='mobile_updateID'>"+response[0][0]['Pid']+"</>"
	        $("#followupHistory-mobile").append(result_body_mobile);
	        result_body_mobile="<ul class='clearfix'>"+"<li>"+'NO.'+"</li>"+"<li>"+'Visit Date'+"</li>"+"<li>"+'Fuchia ID'+"</li>"+"</ul>";
	        $("#followupHistory-mobile").append(result_body_mobile);


	        for (var i = 0; i < response[0].length; i++) {
	          var srNum = i + 1;

	            var result_body_mobile = "<ul class='clearfix'>"+"<li>"+srNum+"</li>"+"<li>"
	            +response[0][i]['Visit Date']+"</li>"
	            +"<li>"+response[0][i]['FuchiaID']+"</li>"+"</ul>";
	           $("#followupHistory-mobile").append(result_body_mobile);
	        }

	    }
	  

	   }
	    });

	}
function row_num(){// to get row ID from follow up History
	  var parent = event.target.parentElement.id;// collecting id of the targeted parent
	  var coparent = document.getElementById(parent).parentElement.id;// collecti
	  text = document.getElementById(coparent).childNodes[1].innerHTML;
		ptID = document.getElementById(coparent).childNodes[3].innerHTML;
    
    if ($(window).width()<1160 &&$(window).width()>599.9 ) {
      ptID = document.getElementById("tablet_updateID").innerHTML;
    }else if ($(window).width()<600){
      ptID = document.getElementById("mobile_updateID").innerHTML;

    }
    
	  updateFiller(text,ptID);
	  }

	// function location ( 12 ) to fill data in new form
function updateFiller(text,ptID){

	  let rowID = text;
	  var toUpdateFollowup = 1;
		var functionLoco=12;
	  var ckdata = {  ptID:ptID,
	                  rowID:rowID,
										functionLoco:functionLoco,
	                  toUpdateFollowup:toUpdateFollowup
	                };
		console.log(ckdata);
	  $.ajaxSetup({
	      headers: {
	          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
	       }
	     });
	  $.ajax({
	      type:'POST',
	      url:"{{route('reception_road')}}",
	      dataType:'json',
	      contentType: 'application/json',
	      data: JSON.stringify(ckdata),
	      success:function(response){
	        console.log(response);
					console.log("Filled");
	        $("#updatePageView").show();

	        document.getElementById("gid_toupdate").value      = response[0][0]["Pid"];

	        document.getElementById("fid_toupdate").value      = response[0][0]["FuchiaID"];
	        document.getElementById("prepCode_toupdate").value = response[0][0]["PrEPCode"];
	        document.getElementById("vDate_toupdate").value    = response[0][0]["Visit Date"];
	        document.getElementById("agey_toupdate").value     = response[0][0]["Agey"];
	        document.getElementById("agem_toupdate").value     = response[0][0]["Agem"];
					document.getElementById("nDate_toupdate").value    = response[0][0]["Next Appointment Date"];

	        document.getElementById("gender_toupdate").value     = response[1];
	        document.getElementById("Ptype_toupdate").value     = response[2];
	        document.getElementById("new_old_toupdate").value   = response[3];
	        document.getElementById("sub_1_toupdate").value     = response[4];
	        document.getElementById("sub_2_toupdate").value     = response[5];
	        document.getElementById("sub_3_toupdate").value     = response[6];

	        document.getElementById("Ptype_1_toupdate").value     = response[7];
	        document.getElementById("new_old_1_toupdate").value   = response[8];
	        document.getElementById("sub_1_1_toupdate").value     = response[9];
	        document.getElementById("sub_2_2_toupdate").value     = response[10];
	        document.getElementById("sub_3_3_toupdate").value     = response[11];
	        console.log(response[11]);console.log([6]);
	        console.log("hello response")

	        rowNumber = response[12];

	        }
	      });




	}
	// function location ( 13 ) to save update data
function update(){
	  var f_up_update = 1;
		var functionLoco= 13;
	  var pid = document.getElementById("gid_toupdate").value;
	  var fid = document.getElementById("fid_toupdate").value;
	  var prepCode = document.getElementById("prepCode_toupdate").value;
	  var vDate = document.getElementById("vDate_toupdate").value;
	  vDate = formatDate(vDate); // Date formatChange function

	  var agey = document.getElementById("agey_toupdate").value;
	  var agem = document.getElementById("agem_toupdate").value;

		var nDate = document.getElementById("nDate_toupdate").value;
	  nDate = formatDate(nDate); // Date formatChange function


	  var gender = document.getElementById("gender_toupdate").value;
	  var ptype = document.getElementById("Ptype_toupdate").value;
	  var new_old = document.getElementById("new_old_toupdate").value;
	  var sub_1 = document.getElementById("sub_1_toupdate").value;
	  var sub_2 = document.getElementById("sub_2_toupdate").value;
	  var sub_3 = document.getElementById("sub_3_toupdate").value;

	  var ptype_1 = document.getElementById("Ptype_1_toupdate").value;
	  var new_old_1 = document.getElementById("new_old_1_toupdate").value;
	  var sub_1_1 = document.getElementById("sub_1_1_toupdate").value;
	  var sub_2_2 = document.getElementById("sub_2_2_toupdate").value;
	  var sub_3_3 = document.getElementById("sub_3_3_toupdate").value;


	  var f_up_data = {
										functionLoco:functionLoco,
	                  rowNumber:rowNumber,
	                  f_up_update:f_up_update,
	                  pid:pid,
	                  fid:fid,
	                  prepCode:prepCode,
	                  vDate:vDate,
	                  agey:agey,
	                  agem:agem,
	                  nDate:nDate,
	                  gender:gender,
	                  ptype:ptype,
	                  new_old:new_old,
	                  sub_1:sub_1,
	                  sub_2:sub_2,
	                  sub_3:sub_3,
	                  ptype_1:ptype_1,
	                  new_old_1:new_old_1,
	                  sub_1_1:sub_1_1,
	                  sub_2_2:sub_2_2,
	                  sub_3_3:sub_3_3,

	                };
	  $.ajaxSetup({
	      headers: {
	          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
	       }
	     });
	  $.ajax({
	      type:'POST',
	      url:"{{route('reception_road')}}",
	      dataType:'json',
	      contentType: 'application/json',
	      data: JSON.stringify(f_up_data),
	      success:function(response){
	        alert("You have update the followup data of the patient.");
	        location.reload(true);// to refresh the page
	        $("#updatePageView").hide();
	        }

	    });
	}


function dateOver(date_verify){
	      switch(date_verify) {
	      case 1:
	        var vDate = $("#dob").val();
	        var idInsert = "dob";
	        break;
	      case 2:
	        var vDate = $("#vDate").val();
	        var idInsert = "vDate";
	        break;
	      case 3:
	        var vDate = $("#fup_date").val();
	        var idInsert = "fup_date";
	        break;
				case 4:
		        var vDate = $("#vDate_toupdate").val();
		        var idInsert = "vDate_toupdate";
		        break;

	      default:
	        // code block
	    }


	  var date = new Date();
	  var day = date.getDate();
	  var month = date.getMonth() + 1;
	  var year = date.getFullYear();
	  if (month < 10) month = "0" + month;
	  if (day < 10) day = "0" + day;
	  var today = year + "-" + month + "-" + day;

	  var vDate = vDate.split("-");
    var vDate = vDate.split("/");
	  var day_input   = vDate[0];
	  var month_input = vDate[1];
	  var year_input  = vDate[2];

	    if(year_input >=  year){
	          if(year_input > year){
	            alert("Input Year is greater than current Year.");
	            document.getElementById(idInsert).value=today;
	          }
	          if(year_input == year){
	            if(month_input > month){
	              alert("Input Month is greater than current Month.");
	              document.getElementById(idInsert).value=today;
	            }
	          }
	          if(month_input == month){
	            if(day_input > day){
	              alert("Input Day is greater than current Day.");
	              document.getElementById(idInsert).value=today;
	            }
	          }
	    }else{
	        if(year_input < 2009){
	          alert("Date input is less than 2009");
	          document.getElementById(idInsert).value=today;
	        }
	    }
	}
</script>

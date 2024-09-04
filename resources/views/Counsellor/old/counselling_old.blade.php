@extends('layouts.app')

  <link rel="stylesheet" href="/css/Reception/reception.css" type="text/css">

@section('content')
@auth
  <div class="container">
    <div style="margin:auto" id="toshowResult"></div>

  <div id="hider0" class="container" style="background:#E1F5C4">
    <br>
  <!--   <form class="" id="reg" method="post" > -->
    @csrf
    <div class="row justify-content-center">
      <div class="col-md-12 "  >
          <h3 style="text-align: center;">Counselling Room</h3>
      </div>
    </div><br><br>
      <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-2">
          <input  type="text" class="form-control"onchange="ptData()" autofocus id="search_id" placeholder="General ID or Fuchia ID" >
        </div>
        <div class="col-md-4">
          <span style="color:red;" id="responseText"></span>
        </div>
        <div class="col-md-2">
          <button  class="btn btn-success" onclick="refresh()">Refresh</button>
        </div>

      </div><br>
          <div class="row">
            <div class="col-md-1" style="margin-left:50px;">
              <label  class="form-label"> Clinic Code </label><br>
              <label style="color:red;"id="clinic_code">{{ Auth::user()->clinic }}</label>
            </div>
            <div class="col-md-2">
              <label  class="form-label">General ID</label>
              <input id="gid" type="number"   class="form-control"  required>
            </div>

            <div class="col-md-2">
              <label class="form-label">Fuchia ID</label>
              <input id="fid" class="form-control" onchange="searchFuchiaID()" >
            </div>
            <div class="col-md-2">
              <label  class="form-label">Name</label>
              <input type="text" id="name" class="form-control" required>
            </div>
            <div class="col-md-2">
              <label  class="form-label">Father</label>
              <input type="text" id="father" class="form-control" required>
            </div>
            <div class="col-md-2">
              <label  class="form-label">Gender</label>
              <select class="form-select" id="gender"required>
                <option value=""></option>
                <option value="male">Male</option>
                <option value="female">Female</option>
              </select>
            </div>

          </div>
          <div class="row">
            <div class="col-md-2"style="margin-left:50px;">
              <label  class="form-label">Visit Date</label>
              <input type="date"  id="vDate" class="form-control" required>

            </div>

            <div class="col-md-1" >
              <label for="validationCustom02" class="form-label">Age in Year</label>
              <input type="number" id="agey" class="form-control"   required>
              <div class="valid-feedback">
                plz put patient age.
              </div>
            </div>
            <div class="col-md-2">
              <label for="validationCustom02" class="form-label">Age in Month</label>
              <input type="number" id="agem" class="form-control" >
              <div class="valid-feedback">
                plz put patient age.
              </div>
            </div>
            <div class="col-md-2">
              <label  class="form-label">Date Of Birth</label>
              <div class="input-group mb-3">
                  <input  type="date" id="dob"  class="form-control">
              </div>
            </div>

            <div class="col-sm-2">
              <label for="validationCustom02" class="form-label">State/ Region</label>
              <div>
                <select  class="form-select"  id="state"  required onchange="region(this.value)">
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
            <div class="col-sm-2" >
              <label for="validationCustom02" class="form-label">Township</label>
              <div>
                <select class="form-select" id="tt"  >
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

          </div>
          <div class="row">
            <div class="col-md-2"style="margin-left:50px;">
              <label  class="form-label">Ward or Village</label>
              <input type="text" id="quarter" class="form-control" required>
            </div>
            <div class="col-sm-2" >
              <label for="validationCustom02" style='color:red;' class="form-label">Phone No.</label>
              <div>
                <input id="phone" class="form-control" type="text" name="" placeholder="09123459789">
              </div>
            </div>
            <div class="col-sm-2">
              <label for="validationCustom02"style='color:red;' class="form-label">Main Risk</label>
              <div>
                <select class="form-control" id="Ptype"  >
                  <option value=""></option>
                  <option id="preg_mom" value="Pregnant Mother">Pregnant Mother</option>
                  <option id="sp_preg_mom" value="Spouse of pregnant mother">Spouse of pregnant mother</option>
                  <option id="" value="Exposed Children">Exposed Children</option>
                  <option id="" value="Low risk">Low risk</option>
                  <option id="fsw" value="FSW">FSW</option>
                  <option id="cl_fsw" value="Client of FSW">Client of FSW</option>
                  <option id="msm" value="MSM">MSM</option>
                  <option id="" value="IDU">IDU</option>
                  <option id="pt_kp" value="Partner of KP">Partner of KP</option>
                  <option id="" value="Special Groups">Special Groups</option>
                  <option id="tg" value="TG">TG</option>
                </select>
              </div>
            </div>
            <div class="col-sm-2" >
              <label for="validationCustom02"style='color:red;' class="form-label">Sub Risk 1</label>
              <div>
                <select class="form-control" id="tt_sub"  >
                  <option value=""></option>
                  <option value="PP">PP</option>
                  <option value="MP">MP</option>
                  <option value="HIV(Pos)">HIV(Pos)</option>
                  <option value="HIV(Neg)Woman">HIV(Neg)Woman</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="Youth(15-24)">Youth(15-24)</option>
                  <option value="PWUD">PWUD</option>
                  <option value="Other Low Risk">Other Low Risk</option>
                  <option value="fswpwid">fswpwid</option>
                  <option value="fswpwud">fswpwud</option>
                  <option value="msmpwid">msmpwid</option>
                  <option value="msmpwud">msmpwud</option>
                  <option value="pwidfsw">pwidfsw</option>
                  <option value="pwidmsm">pwidmsm</option>
                  <option value="Partner of PWID">Partner of PWID</option>
                  <option value="Partner of FSW">Partner of FSW</option>
                  <option value="Female of MSM">Female of MSM</option>
                  <option value="Partner of PLHIV">Partener of PLHIV</option>
                  <option value="TB Patient">TB Patient</option>
                  <option value="Institutionalize">Institutionalize</option>
                  <option value="Uniformed Services Personnel">Uniformed Services Personnel</option>
                  <option value="Migrant Population">Migrant Population</option>
                  <option value="tgpwid">tgpwid</option>
                  <option value="tgpwud">tgpwud</option>
                </select>
              </div>
            </div>
            <div class="col-sm-2" >
              <label for="validationCustom02" class="form-label">New/Old</label>
              <div>
                <select class="form-select" id="new_old">
                  <option value="New">New</option>
                  <option value="Old">Old</option>
                </select>
              </div>
            </div>
            <div class="col-sm-1" >
              <label for="validationCustom02" class="form-label">***</label>
              <button type="button" id="updateBton" onclick="update()" class="btn btn-warning">Update</button>
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-sm-2"style="margin-left:50px;">

            </div>
            <div class="col-sm-2"></div>
            <div class="col-sm-2">

            </div>
            <div class="col-sm-2"></div>
            <div class="col-sm-2">

            </div>
          </div>
          <br>
    </div><br>

    </div>

@endauth
@endsection
<script type="text/javascript" language="javascript">
  let generatedID=0;
  let generatedID1=0;
  let genID=[];
  let ddDate=0;
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

  var gid =document.getElementById('search_id').value;
  var searchIDtoCK = document.getElementById('search_id').value;
  var c_code = document.getElementById("clinic_code").innerHTML;
  var gidLength = gid.length;
  if(gidLength>9){
    document.getElementById('responseText').innerHTML="";
  if(searchIDtoCK.length>9){
  let ckID = 1;
  var checkPatient = 1;
  var ckdata = {
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
      url:"{{route('counsellor_room')}}",
      dataType:'json',
      contentType: 'application/json',
      data: JSON.stringify(ckdata),
      success:function(response){
        clearFacts();
          if(response[0]==null){



                    var new_old = document.getElementById('new_old');
                    if(new_old.innerHTML!=null){
                      new_old.innerHTML="";
                    }
                       var sel = document.getElementById('new_old');
                       var opt = document.createElement("option");
                       opt.appendChild( document.createTextNode("New"));
                       opt.value = "New";
                       sel.appendChild(opt);
                       sel.style.color = "red";
                 }
                 if (response[0] != null) {
                     generatedID=response[0]['id'];


                   if(response[1]!= null){
                     var new_old = document.getElementById('new_old');
                     if(new_old.innerHTML!=null){
                       new_old.innerHTML="";
                     }
                        var sel = document.getElementById('new_old');
                        var opt = document.createElement("option");
                        opt.appendChild( document.createTextNode("Old"));
                        opt.value = "Old";
                        sel.appendChild(opt);
                        sel.style.color = "red";
                   }
                   document.getElementById("name").value=response[1];
                   document.getElementById("father").value=response[2];
                   document.getElementById('gender').value= response[0]["Gender"];
                   var bd_date = response[0]["Date of Birth"];
                   var dateSplited = bd_date.split("-");

                   var dtYear = dateSplited[0];
                   var dtMonth = dateSplited[1];

                   if(dtYear == year){
                     document.getElementById("agem").value= (month+1) - dtMonth;
                   }else{
                     document.getElementById("agey").value=getAge(bd_date);
                   }
                   document.getElementById("gid").value=response[0]["Pid"];
                   document.getElementById("state").value=response[0]["Region"];
                   document.getElementById("tt").value=response[0]["Township"];
                   document.getElementById("quarter").value=response[0]["Quarter"];
                   document.getElementById("fid").value=response[0]["FuchiaID"];
                   document.getElementById("vDate").value=today;
                   //document.getElementById("dob").value=response[0]["Date of Birth"];
                   document.getElementById("Ptype").value=response[0]["Main Risk"];
                   document.getElementById("tt_sub").value=response[0]["Sub Risk"];




                 }
               }
         });
        }
      }else{
        clearFacts();
        document.getElementById('responseText').innerHTML="ID'length is  < 10";

        document.getElementById('updateBton').disabled=true;

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
function update(){
  let update =1;
  let clinic_code = document.getElementById("clinic_code").innerHTML;
  var gid = document.getElementById("gid").value;
  var name = document.getElementById("name").value;
  var father = document.getElementById("father").value;
  var agey = document.getElementById("agey").value;
  var agem = document.getElementById("agem").value;
  var gender = document.getElementById("gender").value;
  var vdate = document.getElementById("vDate").value;
  var dobdate = document.getElementById("dob").value;
  var state = document.getElementById("state").value;
  var tt = document.getElementById("tt").value;
  var quarter = document.getElementById("quarter").value;
  var fuchiaID = document.getElementById("fid").value;
  var Ptype = document.getElementById("Ptype").value;
  var tt_sub = document.getElementById("tt_sub").value;

  var  pati={
         update:update,
         clinic_code:clinic_code,
         gid:gid,
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
         quarter:quarter,
         fuchiaID:fuchiaID,
         Ptype:Ptype,
         tt_sub:tt_sub,

       };
  $.ajaxSetup({
     headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
     }
   });
      $.ajax({
           type:'POST',
           url:"{{route('counsellor_room')}}",
           dataType:'json',
         //  processData:false,
           contentType:'application/json',
           data: JSON.stringify(pati),
           success:function(response){
              console.log(response);
              console.log("This is I Wanted "+ response[1]);
              alert("Your data has been collected.");
                //alert("Your data has been collected.");
                location.reload(true);// to refresh the page
                document.getElementById('regbutton').disabled=false;
           }
        });
}
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
function Psub(){
    var ptCat = document.getElementById("Ptype").value;

    if(ptCat == "PHA"){//
               var Tcount = 2;
               const ptype_sub = [];
               ptype_sub[0] = "OPD"; ptype_sub[1] = "DC";

               // to clear option in select township
               var tt_inner = document.getElementById('tt_sub');

               if(tt_inner.innerHTML!=null){
                 tt_inner.innerHTML="";

               }
               // to show township
                for (var i = 0; i < Tcount; i++) {
                  // get reference to select element
                  var sel = document.getElementById('tt_sub');

                  // create new option element
                  var opt = document.createElement("option");

                  // create text node to add to option element (opt)
                  opt.appendChild( document.createTextNode(ptype_sub[i]) );

                  // set value property of opt
                  opt.value = ptype_sub[i];

                  // add opt to end of select box (sel)
                  sel.appendChild(opt);


                }
              }
    if(ptCat == "ART"){//
                         var Tcount = 2;
                         const ptype_sub = [];
                         ptype_sub[0] = "OPD"; ptype_sub[1] = "DC";

                         // to clear option in select township
                         var tt_inner = document.getElementById('tt_sub');
                         if(tt_inner.innerHTML!=null){
                           tt_inner.innerHTML="";
                         }
                         // to show township
                          for (var i = 0; i < Tcount; i++) {
                            // get reference to select element
                            var sel = document.getElementById('tt_sub');
                            // create new option element
                            var opt = document.createElement("option");
                            // create text node to add to option element (opt)
                            opt.appendChild( document.createTextNode(ptype_sub[i]) );
                            // set value property of opt
                            opt.value = ptype_sub[i];
                            // add opt to end of select box (sel)
                            sel.appendChild(opt);

                          }
    }
    if(ptCat == "STI"){//
                         var Tcount = 3;
                         const ptype_sub = [];
                         ptype_sub[0] = "SW";ptype_sub[1] = "MSM";

                         // to clear option in select township
                         var tt_inner = document.getElementById('tt_sub');
                         if(tt_inner.innerHTML!=null){
                           tt_inner.innerHTML="";
                         }
                         // to show township
                          for (var i = 0; i < Tcount; i++) {
                            // get reference to select element
                            var sel = document.getElementById('tt_sub');
                            // create new option element
                            var opt = document.createElement("option");
                            // create text node to add to option element (opt)
                            opt.appendChild( document.createTextNode(ptype_sub[i]) );
                            // set value property of opt
                            opt.value = ptype_sub[i];
                            // add opt to end of select box (sel)
                            sel.appendChild(opt);
                          }
    }
    if(ptCat == "FC"){//
                         var Tcount = 2;
                         const ptype_sub = [];
                         ptype_sub[0] = "DC"; ptype_sub[1] = "ATFP";

                         // to clear option in select township
                         var tt_inner = document.getElementById('tt_sub');
                         if(tt_inner.innerHTML!=null){
                           tt_inner.innerHTML="";
                         }
                         // to show township
                          for (var i = 0; i < Tcount; i++) {
                            // get reference to select element
                            var sel = document.getElementById('tt_sub');
                            // create new option element
                            var opt = document.createElement("option");
                            // create text node to add to option element (opt)
                            opt.appendChild( document.createTextNode(ptype_sub[i]) );
                            // set value property of opt
                            opt.value = ptype_sub[i];
                            // add opt to end of select box (sel)
                            sel.appendChild(opt);
                          }
    }
    if(ptCat == "General"){//
                         var Tcount = 8;
                         const ptype_sub = [];
                         ptype_sub[0]="";
                         ptype_sub[1] = "TB"; ptype_sub[2] = "Hypertension";ptype_sub[3] = "FP";
                         ptype_sub[4] = "DM";ptype_sub[5] = "Both(Hypertension-DM)";ptype_sub[6]="Fever";
                         ptype_sub[7]="Other";
                         // to clear option in select township
                         var tt_inner = document.getElementById('tt_sub');
                         if(tt_inner.innerHTML!=null){
                           tt_inner.innerHTML="";
                         }
                         // to show township
                          for (var i = 0; i < Tcount; i++) {
                            // get reference to select element
                            var sel = document.getElementById('tt_sub');
                            // create new option element
                            var opt = document.createElement("option");
                            // create text node to add to option element (opt)
                            opt.appendChild( document.createTextNode(ptype_sub[i]) );
                            // set value property of opt
                            opt.value = ptype_sub[i];
                            opt.setAttribute("onclick","General()");
                            // add opt to end of select box (sel)
                            sel.appendChild(opt);
                          }
    }
    if(ptCat == "PMTCT"){
      var Tcount = 2;
      const ptype_sub = [];
      ptype_sub[0] ="";
      ptype_sub[1] = "OPD"; ptype_sub[2] = "DC";

      // to clear option in select township
      var tt_inner = document.getElementById('tt_sub');

      if(tt_inner.innerHTML!=null){
        tt_inner.innerHTML="";

      }
      // to show township
       for (var i = 0; i < Tcount; i++) {
         // get reference to select element
         var sel = document.getElementById('tt_sub');

         // create new option element
         var opt = document.createElement("option");

         // create text node to add to option element (opt)
         opt.appendChild( document.createTextNode(ptype_sub[i]) );

         // set value property of opt
         opt.value = ptype_sub[i];

         // add opt to end of select box (sel)
         sel.appendChild(opt);


       }
    }
    if(ptCat == "ANC"){
      var Tcount = 2;
      const ptype_sub = [];
      ptype_sub[0] ="";
      ptype_sub[1] = "OPD"; ptype_sub[2] = "DC";

      // to clear option in select township
      var tt_inner = document.getElementById('tt_sub');

      if(tt_inner.innerHTML!=null){
        tt_inner.innerHTML="";

      }
      // to show township
       for (var i = 0; i < Tcount; i++) {
         // get reference to select element
         var sel = document.getElementById('tt_sub');

         // create new option element
         var opt = document.createElement("option");

         // create text node to add to option element (opt)
         opt.appendChild( document.createTextNode(ptype_sub[i]) );

         // set value property of opt
         opt.value = ptype_sub[i];

         // add opt to end of select box (sel)
         sel.appendChild(opt);


       }
    }
    if(ptCat == "<15"){
      var Tcount = 2;
      const ptype_sub = [];
      ptype_sub[0] ="";
      ptype_sub[1] = "OPD"; ptype_sub[2] = "DC";
      // to clear option in select township
      var tt_inner = document.getElementById('tt_sub');

      if(tt_inner.innerHTML!=null){
        tt_inner.innerHTML="";

      }
      // to show township
       for (var i = 0; i < Tcount; i++) {
         // get reference to select element
         var sel = document.getElementById('tt_sub');

         // create new option element
         var opt = document.createElement("option");

         // create text node to add to option element (opt)
         opt.appendChild( document.createTextNode(ptype_sub[i]) );

         // set value property of opt
         opt.value = ptype_sub[i];

         // add opt to end of select box (sel)
         sel.appendChild(opt);


       }
    }
 }
function General(){
  var oiName = document.getElementById("tt_sub").value;

  if(oiName == "Hypertension" || oiName =='DM' || oiName=='Both(Hypertension-DM)'){
    var Tcount = 3;
    const ptype_sub = [];
    ptype_sub[0]="";
    ptype_sub[1] = "Hiv (Pos)"; ptype_sub[2] = "Hiv (neg)";

    // to clear option in select township

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
  }

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
  document.getElementById("state").value="";
  document.getElementById("tt_opt").value="";
  document.getElementById("state").value="";
  document.getElementById("quarter").value="";
  document.getElementById("Ptype").value="";
  document.getElementById("tt_sub").value="";

  document.getElementById("new_old").value="";

}
function dateOfBirth(){
  var estimated_DoB=0;
      let vDate_dob = document.getElementById('vDate').value;
      let agey_dob = document.getElementById("agey").value;
      let agem_dob = document.getElementById("agem").value;
      let dob_input = document.getElementById('dob').value;
      if(dob_input.length=='0'){
      if(agey_dob == "" && agem_dob == ""){
        alert("Input Age or Month");
      }
      if(agey_dob.length>0){
        var Adate = new Date();
        var Aday = Adate.getDate();
        var Amonth = Adate.getMonth() + 1;
        var Ayear = Adate.getFullYear();
        var estimated_Year = Ayear - agey_dob;
        var estimated_Month = Amonth - 1 ;
        var estimated_Day = Aday;
        if(estimated_Month < 10){estimated_Month = "0" + estimated_Month;}
        if(estimated_Day < 10){estimated_Day="0" + estimated_Day;}
        estimated_DoB = estimated_Year + "-" + estimated_Month + "-" + estimated_Day;
        //document.getElementById('dob').value= estimated_DoB;
      }
      if(agem_dob.length>1){
        document.getElementById('agey').value="";
        var Adate = new Date();
        var Aday = Adate.getDate();
        var Amonth = Adate.getMonth() + 1;
        var Ayear = Adate.getFullYear();
        var estimated_Year = Ayear - 0;
        var estimated_Month = Amonth - agem_dob ;
        if(estimated_Month == 0){
          estimated_Year = estimated_Year-1;
          estimated_Month = estimated_Month + 12;
        }
        if(estimated_Month == -1){
          estimated_Year = estimated_Year-1;
          estimated_Month = estimated_Month + 11;
        }
        if(estimated_Month == -2){
          estimated_Year = estimated_Year-1;
          estimated_Month = estimated_Month + 10;
        }
        var estimated_Day = Aday;
        if(estimated_Month < 10){estimated_Month = "0" + estimated_Month;}
        if(estimated_Day < 10){estimated_Day="0" + estimated_Day;}
        estimated_DoB = estimated_Year + "-" + estimated_Month + "-" + estimated_Day;
        //document.getElementById('dob').value= estimated_DoB;
      }
    }else{
      estimated_DoB = document.getElementById('dob').value;
    }
    ddDate = estimated_DoB;
  }

</script>

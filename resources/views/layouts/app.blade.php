<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- enter new meta -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <?php

  use Illuminate\Support\Facades\Crypt;
  ?>
  <title>MAM</title>

  <!-- Scripts -->
  <script src="{{ asset('js/jquery.min.js') }}"></script>
  <script src="{{ asset('js/jquery-ui.min.js') }}"></script>
  <script src="{{ asset('js/slider.js') }}"></script>
  <script src="{{ asset('js/app.js') }}" defer></script>
  <script src="{{ asset('js/date.js') }}"></script>
  <script src="{{ asset('js/toggle.js') }}"></script>

  {{-- --}}
  <!-- Bootstrap CSS -->
  <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" media="print" rel="stylesheet">
  <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" media="screen" rel="stylesheet">


  <!-- Bootstrap Bundle with Popper -->
  <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>


  <!-- Styles -->



  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="/css/common.css" type="text/css">
  <link href="{{ asset('css/Jquery_UI/jquery_ui.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="/css/Reception/reception.css" type="text/css">
  <link rel="stylesheet" href="/css/Reception/reception-return.css" type="text/css">
  <link rel="stylesheet" href="/css/Reception/next-appointment.css" type="text/css">
  <link rel="stylesheet" href="/css/Reception/reception-follow.css" type="text/css">
  <link rel="stylesheet" href="/css/Lab/lab.css" type="text/css">
  <link rel="stylesheet" href="/css/dispencing.css">
  <link rel="stylesheet" href="/css/Counsellor/counselling.css" type="text/css">
  <link rel="stylesheet" href="/css/STI/stiform.css">
  <link rel="stylesheet" href="/css/STI/prevention.css">

  <link rel="stylesheet" href="/css/NCD/ncdregister.css">
  <link rel="stylesheet" href="/css/NCD/ncd.css">
  <link rel="stylesheet" href="/css/CMV/cmv.css">
  <link rel="stylesheet" href="/css/CercivalCancer/cercivalCancer.css">
  <link rel="stylesheet" href="/css/STI/tb.css">
  <link rel="stylesheet" href="/css/TbSection/tb.css">
  <link rel="stylesheet" href="/css/TbSection/Tb-IPT.css">
  <link rel="stylesheet" href="/css/TbSection/preTbassement.css">
  <link rel="stylesheet" href="/css/MentalHealth/mental.css">
  <link rel="stylesheet" href="/css/Admin/admin.css">
  <link rel="stylesheet" href="{{ asset('css/excel/excel.css') }}">

</head>

<body>
  @if (Route::has('login'))
  @php
  $mam_clinicID = Auth::user()->clinic ?? null;
  @endphp
  @endif
  <div id="app">
    <nav class="navbar navbar-expand-md navbar-light shadow-sm navbar">
      <!--bg-white  -->
      <div class="container containers">
        <!-- *adding containers clss -->
        <a class="navbar-brand nav-link" style="display:none" href="{{ url('/') }}">

        </a>

        @auth
        <!-- id="navbarSupportedContent" -->
        <!-- class="collapse navbar-collapse"  -->
        <div class="main-link">
          <!-- Left Side Of Navbar -->
          <img src='/logoMAM.jpg' class="rounded mx-auto d-block" alt='logo' style='width:70px;height:70px;'>

          <p class="btn-gnavitop">
            <span></span>
            <span></span>
            <span></span>
          </p>
          @if (Auth::user()->type == 1)
          <ul class="nav nav-tabs reception-nav-ul main-nav" id="main-title">
            <li class="nav-item dropdown recption-dropdown">
              <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href=''>Clinic' Reception </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{ url('Reception/Reception') }}">Clinic Reception</a></li>
                <li><a class="dropdown-item" href="{{ url('import/GeneralPatientImport') }}">General Import</a></li>
              </ul>
            </li>

            <li class="nav-item dropdown recption-dropdown">
              <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href=''>Reports </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{ url('Reception/report') }}">Clinic's Consultation Report</a></li>
              </ul>
            </li>
            <li class="nav-item dropdown recption-dropdown">
              <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href=''>Information </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{ url('Manage/info') }}">Announcements</a></li>
              </ul>
            </li>

          </ul>
          @endif
          @if (Auth::user()->type == 2)
          <ul class="nav nav-tabs assist-nav-ul main-nav" id="main-title">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href=''>Programs</a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{ url('STI/stiform') }}">STI Forms</a></li>
                <li><a class="dropdown-item" href="{{ url('Prevention/log_sheet') }}">Prevention</a></li>
                <li><a class="dropdown-item" href="{{ url('Cervical_cancer/screnning') }}">Cervical Cancer Screnning</a>
                </li>
                <li><a class="dropdown-item" href="{{ url('CMV/cmv_treatment') }}">CMV</a></li>
                <li><a class="dropdown-item" href="{{ url('NCD/Ncd') }}">NCD</a></li>
                <li><a class="dropdown-item" href="{{ url('TB/tb03') }}">TB-03</a></li>
                <li><a class="dropdown-item" href="{{ url('TB/preTB_Assement') }}">Pre- TB assement</a></li>
                <li><a class="dropdown-item" href="{{ url('TB/TB_IPT') }}">IPT</a></li>
                <li><a class="dropdown-item" href="{{ url('MentalHealth/mentalHealth') }}">Mental Health</a></li>
                <li><a class="dropdown-item" href="{{ url('RiskHistory/risk_history') }}">Risk Log</a></li>
                <li><a class="dropdown-item" href="{{ url('All_Export/export_all') }}">Export All Data</a></li>
                <li><a class="dropdown-item" href="{{ url('MME/mme_export') }}">MNE Export</a></li>


                <li><a class="dropdown-item" href="{{ url('Id_Fix/Id_Delete') }}">ID Fix</a></li>


              </ul>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href=''>Reports </a>
              <ul class="dropdown-menu">

                <li><a class="dropdown-item" href="{{ url('Reports/STI_Report') }}">STI report</a></li>
              </ul>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href=''>Information </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{ url('Manage/info') }}">Announcements</a></li>
              </ul>
            </li>


          </ul>
          @endif
          @if (Auth::user()->type == '3')
          <ul class="nav nav-tabs lab-nav main-nav" id="main-title">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href=''>Lab</a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{ url('Labs/labs') }}">Labs</a></li>
              </ul>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href=''>Reports</a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{ url('Labs/results') }}">Lab's Reports </a></li>
              </ul>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href=''>Information </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{ url('Manage/info') }}">Announcements</a></li>
              </ul>
            </li>

          </ul>
          @endif
          @if (Auth::user()->type == 4)
          <ul class="nav nav-tabs consel-mainlist main-nav" id="main-title">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="">Counselling Room</a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{ url('Counsellor/counselling') }}">Counselling Entry</a></li>
                <li>
                  <a class="dropdown-item" href="{{ url('Counsellor/hts_report') }}">HTS Report</a>
                </li>
                <li><a class="dropdown-item" href="{{ url('TB/TB_IPT') }}">IPT</a></li>
                <li><a class="dropdown-item" href="{{ url('RiskHistory/risk_history') }}">Risk Log</a></li>

              </ul>
            </li>
          </ul>
          @endif


          @if (Auth::user()->type == 5)
          <ul class="nav nav-tabs assist-nav-ul main-nav" id="main-title">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href=''>Programs</a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{ url('Dispensing/dispensing') }}">Dispensing</a></li>
                <li><a class="dropdown-item" href="{{ url('Dispensing/dispensingReport') }}">Report</a></li>
              </ul>
            </li>

            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href=''>Information </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{ url('Manage/info') }}">Announcements</a></li>
              </ul>
            </li>


          </ul>
          @endif
          @if (Auth::user()->type == 6)
          <ul class="nav nav-tabs admin-list" id="main-title">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href=''>Manage</a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{ url('Manage/users') }}">Add/Delete User</a></li>
                <li><a class="dropdown-item" href="{{ url('Manage/users_list') }}">User List</a></li>
                <li><a class="dropdown-item" href="{{ url('Manage/announcement') }}">Announcements</a></li>
              </ul>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href=''>Reports</a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{ url('Reception/report') }}">Clinic Consultation</a></li>
                <li><a class="dropdown-item" href="{{ url('Manage/users_list') }}">Workloads</a></li>
                <li><a class="dropdown-item" href="{{ url('Reception/patients') }}">Stock</a></li>
              </ul>
            </li>
            <li class="nav-item">
              <a class="nav-link" href=''>About</a>
            </li>

          </ul>
          @endif
          @if (Auth::user()->type == 7)
          <ul class="nav nav-tabs reception-nav-ul main-nav" id="main-title">
            <li class="recption-dropdown">
              <a class="dropdown-item" href="{{ url('Dispensing/dispensing') }}">Consumption</a>
            </li>
            <li class="nav-item dropdown recption-dropdown"><a class="dropdown-item"
                href="{{ url('Dispensing/dispensingReport') }}">Dispensing Report</a>
            </li>
            <li class="nav-item dropdown recption-dropdown"><a class="dropdown-item"
                href="{{ url('Dispensing/dispensingExport') }}">Dispensing Export</a>
            </li>


          </ul>
          @endif

          <!-- <ul class="navbar-nav ms-auto"> *  CLINIC CODE
                                <li>
                                      <label style="color:red;" class="form-control" id="clinic">Clinic Code :{{ Auth::user()->clinic }}</label>
                                </li>
                              </ul> -->
          @endauth
          <!-- Right Side Of Navbar -->
          <ul class="navbar-nav ms-auto ">

            <!-- Authentication Links -->
            @guest
            @if (Route::has('login'))
            <li class="nav-item">
              <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
            @endif
            @if (Route::has('register'))
            <li class="nav-item">
              <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>

            </li>
            @endif
            @else
            <li class="nav-item dropdown">
              <a id="navbarDropdown" name='appUser' class="nav-link dropdown-toggle" href='' role="button"
                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }}
              </a>

              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                  {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                  @csrf
                </form>
              </div>
            </li>
            @endguest
          </ul>
        </div>
      </div>
    </nav>
  </div>
  <main class="py-4">
    <div class="" id="loadingSpinner"></div>
    @yield('content')

  </main>

</body>

</html>
<script type="text/javascript">
  let edit = "0"; // for only age update in counsellor blade
  let date_origin = "0"; // orginal age in  counsellor blade
  let register_date = "";
  let dob_input = "";
  let input_date = $("input[type='date']").length;
  var mam_clinicID = @json($mam_clinicID);
  const options = [{
      value: "-",
      text: ""
    },
    {
      value: "Pregnant Mother",
      text: "Pregnant Mother"
    },
    {
      value: "Spouse of pregnant mother",
      text: "Spouse of pregnant mother"
    },
    {

      value: "Exposed Children",
      text: "Exposed Children"
    },
    {

      value: "Low Risk",
      text: "Low Risk"
    },
    {

      value: "PWUD",
      text: "PWUD"
    },
    {
      value: "FSW",
      text: "FSW"
    },
    {
      value: "Client of FSW",
      text: "Client of FSW"
    },
    {
      value: "MSM",
      text: "MSM"
    },
    {

      value: "IDU",
      text: "IDU"
    },
    {
      value: "TG",
      text: "TG"
    },
    {
      value: "Partner of KP",
      text: "Partner of KP"
    },
    {
      value: "Partner of PLHIV",
      text: "Partner of PLHIV"
    },
    {

      value: "Special Groups",
      text: "Special Groups"
    },
    {

      value: "Migrant Population",
      text: "Migrant Population"
    }
  ];
  const subOptions = {
    "Pregnant Mother": [
      ["", "PP", "MP"]
    ],
    "Spouse of pregnant mother": [
      ["", "HIV(Pos)", "HIV(Neg)Woman"]
    ],
    "Exposed Children": [
      ["", "0", "1", "3", "4"]
    ],
    "Low Risk": [
      ["", "Youth(15-24)", "Other Low Risk"]
    ],
    "PWUD": [
      [""]
    ],
    "FSW": [
      ["", "FSW_PWID", "FSW_PWUD"],
      ["", "FSW/PWID", "FSW/PWUD"]
    ],
    "Client of FSW": [
      [""]
    ],
    "MSM": [
      ["", "MSM_PWID", "MSM_PWUD"],
      ["", "MSM/PWID", "MSM/PWUD"]
    ],
    "IDU": [
      ["", "PWID_FSW", "PWID_MSM"],
      ["", "PWID/FSW", "PWID/MSM"]
    ],
    "TG": [
      ["", "TG_PWID", "TG_PWUD", "TG_SW"],
      ["", "TG/PWID", "TG/PWUD", "TG/SW"]
    ],
    "Partner of KP": [
      ["", "Partner of PWID", "Partner of FSW", "Female of MSM", "Partner of TG"],
      ["", "Partner of PWID", "Partner of FSW", "Female Partner of MSM", "Partner of TG"]
    ],
    "Partner of PLHIV": [
      [""]
    ],
    "Special Groups": [
      ["", "TB Patient", "Institutionalize", "Uniformed Services Personnel"]
    ],
    "Migrant Population": [
      [""]
    ]
  };
  document.getElementById("clinic_code").value = @json($mam_clinicID);
  // const select = $('<select />', {
  //   class: 'form-select',
  //   id: 'main_risk',
  //   onchange: 'MainPatientType()',
  // });//for Main Risk

  // const sub_select = $('<select />', {
  //   class: 'form-select',
  //   id: 'sub_risk',
  // });

  function mainRiskCreate(MainRiskIdBlock) {
    $.each(options, function(index, option) {
      $('<option />', {
        id: option.id,
        value: option.value,
        text: option.text
      }).appendTo($('.' + MainRiskIdBlock));
    });
  }

  function subRiskCreate(SubRiskIdBlock, risk) {
    mainriskValue = $(risk).val();
    console.log(subOptions[mainriskValue], mainriskValue, risk, SubRiskIdBlock);
    $("." + SubRiskIdBlock).empty();
    if (subOptions[mainriskValue].length == 2) {
      $.each(subOptions[mainriskValue][0], function(index, subOption) {
        console.log(subOption);
        $('<option /> ', {
          value: subOption,
          text: subOptions[mainriskValue][1][index],
        }).appendTo($("." + SubRiskIdBlock));

      });
    } else {
      $.each(subOptions[mainriskValue][0], function(index, subOption) {
        $(' <option /> ', {
          value: subOption,
          text: subOption,
        }).appendTo($("." + SubRiskIdBlock));
      });
    }
  }

  function formatDate(dateStr) {
    if (dateStr != "") {
      console.log("FormatDate arrived");
      var dateObj = $.datepicker.parseDate("dd-mm-yy", dateStr);
      var formattedDate = $.datepicker.formatDate("yy-mm-dd", dateObj);
      return formattedDate;
    } else {
      var formattedDate = "";
      return formattedDate;
    }
  }

  function region() {
    //to check state in Region option
    var state = document.getElementById("state").value;
    console.log(state + "state")
    var tt_inner = document.getElementById('tt');
    var sel = document.getElementById('tt');
    if (tt_inner === null) {
      tt_inner = document.getElementById('township');
      var sel = document.getElementById('township');
    } else {

    }
    if (tt_inner.innerHTML != null) {
      tt_inner.innerHTML = "";
    }


    if (state == "Shan(East)") { //
      var Tcount = 15;
      const shan_e = [];
      shan_e[0] = "Kengtung";
      shan_e[1] = "Mongkhet";
      shan_e[2] = "Mongyang";
      shan_e[3] = "Mongla";
      shan_e[4] = "Monghsat";
      shan_e[5] = "Mongping";
      shan_e[6] = "Mongton";
      shan_e[7] = "Tachileik";
      shan_e[8] = "Monghpyak";
      shan_e[9] = "Mongyawng";
      shan_e[10] = "Mong Hpen";
      shan_e[11] = "Ho Tawng (Ho Tao)";
      shan_e[12] = "Mong Pawk";
      shan_e[13] = "Mong Kar";
      shan_e[14] = "Nam Hpai";

      // to clear option in select township


      // to show township
      for (var i = 0; i < Tcount; i++) {
        // get reference to select element

        // create new option element
        var opt = document.createElement("option");
        // create text node to add to option element (opt)
        opt.appendChild(document.createTextNode(shan_e[i]));
        // set value property of opt
        opt.value = shan_e[i];
        // add opt to end of select box (sel)
        sel.appendChild(opt);
      }
    } else if (state == "Sagaing") { //
      var Tcount = 34;
      const sagaing = [];
      sagaing[0] = "Sagaing";
      sagaing[1] = "Myinmu";
      sagaing[2] = "Myaung";
      sagaing[3] = "Shwebo";
      sagaing[4] = "Khin-U";
      sagaing[5] = "Wetlet";
      sagaing[6] = "Kanbalu";
      sagaing[7] = "Kyunhla";
      sagaing[8] = "Ye-U";
      sagaing[9] = "Tabayin";
      sagaing[10] = "Taze";
      sagaing[11] = "Monywa";
      sagaing[12] = "Budalin";
      sagaing[13] = "Ayadaw";
      sagaing[14] = "Chaung-U";
      sagaing[15] = "Yinmarbin";
      sagaing[16] = "Kani";
      sagaing[17] = "Salingyi";
      sagaing[18] = "Pale";
      sagaing[19] = "Katha";
      sagaing[20] = "Indaw";
      sagaing[21] = "Tigyaing";
      sagaing[22] = "Banmauk";
      sagaing[23] = "Kawlin";
      sagaing[24] = "Wuntho";
      sagaing[25] = "Pinlebu";
      sagaing[26] = "Kale";
      sagaing[27] = "Kalewa";
      sagaing[28] = "Mingin";
      sagaing[29] = "Tamu";
      sagaing[30] = "Mawlaik";
      sagaing[31] = "Paungbyin";
      sagaing[32] = "Hkamti";
      sagaing[33] = "Homalin";
      sagaing[34] = "Lay Shi";
      sagaing[35] = "Lahe";
      sagaing[36] = "Nanyun";

      // to clear option in select township

      if (tt_inner.innerHTML != null) {
        tt_inner.innerHTML = "";
      }
      // to show township
      for (var i = 0; i < Tcount; i++) {
        // get reference to select element

        // create new option element
        var opt = document.createElement("option");
        // create text node to add to option element (opt)
        opt.appendChild(document.createTextNode(sagaing[i]));
        // set value property of opt
        opt.value = sagaing[i];
        // add opt to end of select box (sel)
        sel.appendChild(opt);
      }
    } else if (state == "Rakhine") { //
      var Tcount = 17;
      const rakhine = [];
      rakhine[0] = "Sittwe";
      rakhine[1] = "Ponnagyun";
      rakhine[2] = "Mrauk-U";
      rakhine[3] = "Kyauktaw";
      rakhine[4] = "Minbya";
      rakhine[5] = "Myebon";
      rakhine[6] = "Pauktaw";
      rakhine[7] = "Rathedaung";
      rakhine[8] = "Maungdaw";
      rakhine[9] = "Buthidaung";
      rakhine[10] = "Kyaukpyu";
      rakhine[11] = "Munaung";
      rakhine[12] = "Ramree";
      rakhine[13] = "Ann";
      rakhine[14] = "Thandwe";
      rakhine[15] = "Toungup";
      rakhine[16] = "Gwa";
      // to clear option in select township

      if (tt_inner.innerHTML != null) {
        tt_inner.innerHTML = "";
      }
      // to show township
      for (var i = 0; i < Tcount; i++) {
        // get reference to select element

        // create new option element
        var opt = document.createElement("option");
        // create text node to add to option element (opt)
        opt.appendChild(document.createTextNode(rakhine[i]));
        // set value property of opt
        opt.value = rakhine[i];
        // add opt to end of select box (sel)
        sel.appendChild(opt);
      }
    }

    //Nay Pyi Taw
    else if (state == "NaypyiTaw") { //
      var Tcount = 8;
      const naypyitaw = [];
      naypyitaw[0] = "Zay Yar Thi Ri";
      naypyitaw[1] = "Za Bu Thi Ri";
      naypyitaw[2] = "Tatkon";
      naypyitaw[3] = "Det Khi Na Thi Ri";
      naypyitaw[4] = "Poke Ba Thi Ri";
      naypyitaw[5] = "Pyinmana";
      naypyitaw[6] = "Lewe";
      naypyitaw[7] = "Oke Ta Ra Thi Ri";
      // to clear option in select township

      if (tt_inner.innerHTML != null) {
        tt_inner.innerHTML = "";
      }
      // to show township
      for (var i = 0; i < Tcount; i++) {
        // get reference to select element

        // create new option element
        var opt = document.createElement("option");
        // create text node to add to option element (opt)
        opt.appendChild(document.createTextNode(naypyitaw[i]));
        // set value property of opt
        opt.value = naypyitaw[i];
        // add opt to end of select box (sel)
        sel.appendChild(opt);
      }
    }

    //Mon
    else if (state == "Mon") {
      var Tcount = 10;
      const mon = [];

      mon[0] = "Mawlamyine";
      mon[1] = "Kyaikmaraw";
      mon[2] = "Chaungzon";
      mon[3] = "Thanbyuzayat";
      mon[4] = "Mudon";
      mon[5] = "Ye";
      mon[6] = "Thaton";
      mon[7] = "Paung";
      mon[8] = "Kyaikto";
      mon[9] = "Bilin";

      // to clear option in select township



      // to show township
      for (var i = 0; i < Tcount; i++) {
        // get reference to select element

        // create new option element
        var opt = document.createElement("option");
        // create text node to add to option element (opt)
        opt.appendChild(document.createTextNode(mon[i]));
        // set value property of opt
        opt.value = mon[i];
        // add opt to end of select box (sel)
        sel.appendChild(opt);
      }
    }

    //Mandalay
    else if (state == "Mandalay") {
      var Tcount = 28;
      const mandalay = [];
      mandalay[0] = "Aungmyaythazan";
      mandalay[1] = "Chanayethazan";
      mandalay[2] = "Mahaaungmyay";
      mandalay[3] = "Chanmyathazi";
      mandalay[4] = "Pyigyitagon";
      mandalay[5] = "Amarapura";
      mandalay[6] = "Patheingyi";
      mandalay[7] = "Pyinoolwin";
      mandalay[8] = "Madaya";
      mandalay[9] = "Singu";
      mandalay[10] = "Mogoke";
      mandalay[11] = "Thabeikkyin";
      mandalay[12] = "Kyaukse";
      mandalay[13] = "Sintgaing";
      mandalay[14] = "Myittha";
      mandalay[15] = "Tada-U";
      mandalay[16] = "Myingyan";
      mandalay[17] = "Taungtha";
      mandalay[18] = "Natogyi";
      mandalay[19] = "Kyaukpadaung";
      mandalay[20] = "Ngazun";
      mandalay[21] = "Nyaung-U";
      mandalay[22] = "Yamethin";
      mandalay[23] = "Pyawbwe";
      mandalay[24] = "Meiktila";
      mandalay[25] = "Mahlaing";
      mandalay[26] = "Thazi";
      mandalay[27] = "Wundwin";

      // to clear option in select township

      if (tt_inner.innerHTML != null) {
        tt_inner.innerHTML = "";
      }
      // to show township
      for (var i = 0; i < Tcount; i++) {
        // get reference to select element

        // create new option element
        var opt = document.createElement("option");
        // create text node to add to option element (opt)
        opt.appendChild(document.createTextNode(mandalay[i]));
        // set value property of opt
        opt.value = mandalay[i];
        // add opt to end of select box (sel)
        sel.appendChild(opt);
      }
    }

    //Magway
    else if (state == "Mgway") {
      var Tcount = 26;
      const magway = [];
      magway[0] = "Magway";
      magway[1] = "Yenangyaung";
      magway[2] = "Chauk";
      magway[3] = "Taungdwingyi";
      magway[4] = "Myothit";
      magway[5] = "Natmauk";
      magway[6] = "Minbu";
      magway[7] = "Pwintbyu";
      magway[8] = "Ngape";
      magway[9] = "Lemyethna";
      magway[10] = "Salin";
      magway[11] = "Sidoktaya";
      magway[12] = "Thayet";
      magway[13] = "Minhla";
      magway[14] = "Mindon";
      magway[15] = "Kamma";
      magway[16] = "Aunglan";
      magway[17] = "Sinbaungwe";
      magway[18] = "Pakokku";
      magway[19] = "Yesagyo";
      magway[20] = "Myaing";
      magway[21] = "Pauk";
      magway[22] = "Seikphyu";
      magway[23] = "Gangaw";
      magway[24] = "Tilin";
      magway[25] = "Saw";
      // to clear option in select township


      // to show township
      for (var i = 0; i < Tcount; i++) {
        // get reference to select element

        // create new option element
        var opt = document.createElement("option");
        // create text node to add to option element (opt)
        opt.appendChild(document.createTextNode(magway[i]));
        // set value property of opt
        opt.value = magway[i];
        // add opt to end of select box (sel)
        sel.appendChild(opt);
      }
    } else if (state == "Kayin") { //
      var Tcount = 7;
      const kayin = [];
      kayin[0] = "Hpa-An";
      kayin[1] = "Hlaingbwe";
      kayin[2] = "Hpapun";
      kayin[3] = "Thandaunggyi";
      kayin[4] = "Myawaddy";
      kayin[5] = "Kawkareik";
      kayin[6] = "Kyainseikgyi";
      // to clear option in select township


      // to show township
      for (var i = 0; i < Tcount; i++) {
        // get reference to select element

        // create new option element
        var opt = document.createElement("option");
        // create text node to add to option element (opt)
        opt.appendChild(document.createTextNode(kayin[i]));
        // set value property of opt
        opt.value = kayin[i];
        // add opt to end of select box (sel)
        sel.appendChild(opt);
      }
    } else if (state == "Kayah") { //
      var Tcount = 7;
      const kayah = [];
      kayah[0] = "Loikaw";
      kayah[1] = "Demoso";
      kayah[2] = "Hpruso";
      kayah[3] = "Shadaw";
      kayah[4] = "Bawlake";
      kayah[5] = "Hpasawng";
      kayah[6] = "Mese";
      // to clear option in select township

      if (tt_inner.innerHTML != null) {
        tt_inner.innerHTML = "";
      }
      // to show township
      for (var i = 0; i < Tcount; i++) {
        // get reference to select element

        // create new option element
        var opt = document.createElement("option");
        // create text node to add to option element (opt)
        opt.appendChild(document.createTextNode(kayah[i]));
        // set value property of opt
        opt.value = kayah[i];
        // add opt to end of select box (sel)
        sel.appendChild(opt);
      }
    } else if (state == "Kachin") { //
      var Tcount = 17;
      const kachin = [];
      kachin[0] = "Myitkyina";
      kachin[1] = "Waingmaw";
      kachin[2] = "Injangyang";
      kachin[3] = "Tanai";
      kachin[4] = "Chipwi";
      kachin[5] = "Tsawlaw";
      kachin[6] = "Mohnyin";
      kachin[7] = "Mogaung";
      kachin[8] = "Hpakant";
      kachin[9] = "Bhamo";
      kachin[10] = "Momauk";
      kachin[11] = "Mansi";
      kachin[12] = "Puta-O";
      kachin[13] = "Sumprabum";
      kachin[14] = "Machanbaw";
      kachin[15] = "Nawngmun";
      kachin[16] = "Khaunglanhpu";
      // to clear option in select township


      // to show township
      for (var i = 0; i < Tcount; i++) {
        // get reference to select element

        // create new option element
        var opt = document.createElement("option");
        // create text node to add to option element (opt)
        opt.appendChild(document.createTextNode(kachin[i]));
        // set value property of opt
        opt.value = kachin[i];
        // add opt to end of select box (sel)
        sel.appendChild(opt);
      }
    } else if (state == "Chin") {
      var Tcount = 9;
      const chin = [];
      chin[0] = "Falam";
      chin[1] = "Hakha";
      chin[2] = "Thantlang";
      chin[3] = "Tedim";
      chin[4] = "Tonzang";
      chin[5] = "Mindat";
      chin[6] = "Matupi";
      chin[7] = "Kanpetlet";
      chin[8] = "Paletwa";
      // to clear option in select township


      // to show township
      for (var i = 0; i < Tcount; i++) {
        // get reference to select element

        // create new option element
        var opt = document.createElement("option");
        // create text node to add to option element (opt)
        opt.appendChild(document.createTextNode(chin[i]));
        // set value property of opt
        opt.value = chin[i];
        // add opt to end of select box (sel)
        sel.appendChild(opt);
      }
    } else if (state == "Bago(West)") { //
      var Tcount = 14;
      const Bago_E = [];
      Bago_E[0] = "Pyay";
      Bago_E[1] = "Paukkhaung";
      Bago_E[2] = "Padaung";
      Bago_E[3] = "Paungde";
      Bago_E[4] = "Thegon";
      Bago_E[5] = "Shwedaung";
      Bago_E[6] = "Thayarwady";
      Bago_E[7] = "Letpadan";
      Bago_E[8] = "Minhla";
      Bago_E[9] = "Okpho";
      Bago_E[10] = "Zigon";
      Bago_E[11] = "Nattalin";
      Bago_E[12] = "Monyo";
      Bago_E[13] = "Gyobingauk";
      // to clear option in select township

      if (tt_inner.innerHTML != null) {
        tt_inner.innerHTML = "";
      }
      // to show township
      for (var i = 0; i < Tcount; i++) {
        // get reference to select element

        // create new option element
        var opt = document.createElement("option");
        // create text node to add to option element (opt)
        opt.appendChild(document.createTextNode(Bago_E[i]));
        // set value property of opt
        opt.value = Bago_E[i];
        // add opt to end of select box (sel)
        sel.appendChild(opt);
      }
    }
    //Ayeyarwady
    else if (state == "Ayeyarwady") {
      var Tcount = 26;
      const Ayeyar = [];
      Ayeyar[0] = "Pathein";
      Ayeyar[1] = "Kangyidaunt";
      Ayeyar[2] = "Thabaung";
      Ayeyar[3] = "Ngapudaw";
      Ayeyar[4] = "Kyonpyaw";
      Ayeyar[5] = "Yegyi";
      Ayeyar[6] = "Kyaunggon";
      Ayeyar[7] = "Hinthada";
      Ayeyar[8] = "Zalun";
      Ayeyar[9] = "Lemyethna";
      Ayeyar[10] = "Myanaung";
      Ayeyar[11] = "Kyangin";
      Ayeyar[12] = "Ingapu";
      Ayeyar[13] = "Myaungmya";
      Ayeyar[14] = "Einme";
      Ayeyar[15] = "Labutta";
      Ayeyar[16] = "Wakema";
      Ayeyar[17] = "Mawlamyinegyun";
      Ayeyar[18] = "Maubin";
      Ayeyar[19] = "Pantanaw";
      Ayeyar[20] = "Nyaungdon";
      Ayeyar[21] = "Danubyu";
      Ayeyar[22] = "Pyapon";
      Ayeyar[23] = "Bogale";
      Ayeyar[24] = "Kyaiklat";
      Ayeyar[25] = "Dedaye";
      // to clear option in select township

      if (tt_inner.innerHTML != null) {
        tt_inner.innerHTML = "";
      }
      // to show township
      for (var i = 0; i < Tcount; i++) {
        // get reference to select element

        // create new option element
        var opt = document.createElement("option");
        // create text node to add to option element (opt)
        opt.appendChild(document.createTextNode(Ayeyar[i]));
        // set value property of opt
        opt.value = Ayeyar[i];
        // add opt to end of select box (sel)
        sel.appendChild(opt);
      }
    }
    //Bago(east)
    else if (state == "Bago(East)") {
      var Tcount = 14;
      const bago = [];
      bago[0] = "Bago";
      bago[1] = "Thanatpin";
      bago[2] = "Kawa";
      bago[3] = "Waw";
      bago[4] = "Nyaunglebin";
      bago[5] = "Kyauktaga";
      bago[6] = "Daik-U";
      bago[7] = "Shwegyin";
      bago[8] = "Taungoo";
      bago[9] = "Yedashe";
      bago[10] = "Kyaukkyi";
      bago[11] = "Phyu";
      bago[12] = "Oktwin";
      bago[13] = "Htantabin";
      // to clear option in select township


      // to show township
      for (var i = 0; i < Tcount; i++) {
        // get reference to select element

        // create new option element
        var opt = document.createElement("option");
        // create text node to add to option element (opt)
        opt.appendChild(document.createTextNode(bago[i]));
        // set value property of opt
        opt.value = bago[i];
        // add opt to end of select box (sel)
        sel.appendChild(opt);
      }
    } else if (state == "Shan(North)") {

      if (tt_inner.innerHTML != null) {
        tt_inner.innerHTML = "";
      }
    } else if (state == "Shan(South)") {

      if (tt_inner.innerHTML != null) {
        tt_inner.innerHTML = "";
      }
    } else if (state == "Tanintharyi") {

      if (tt_inner.innerHTML != null) {
        tt_inner.innerHTML = "";
      }
    } else if (state == "Yangon") {
      var Tcount = 45;
      const yangon = [];
      yangon[0] = "Hlaingtharya";
      yangon[1] = "MingalarDon";
      yangon[2] = "Hmawbi";
      yangon[3] = "Hlegu";
      yangon[4] = "Taikkyi";
      yangon[5] = "Htantabin";
      yangon[6] = "Shwepyithar";
      yangon[7] = "Insein";
      yangon[8] = "Thingangyun";
      yangon[9] = "Yankin";
      yangon[10] = "South Okkalapa";
      yangon[11] = "North Okkalapa";
      yangon[12] = "Thaketa";
      yangon[13] = "Dawbon";
      yangon[14] = "Tamwe";
      yangon[15] = "Pazundaung";
      yangon[16] = "Botahtaung";
      yangon[17] = "Dagon Myothit (South)";
      yangon[18] = "Dagon Myothit (North)";
      yangon[19] = "Dagon Myothit (East)";
      yangon[20] = "Dagon Myothit (Seikkan)";
      yangon[21] = "Mingalartaungnyunt";
      yangon[22] = "Thanlyin";
      yangon[23] = "Kyauktan";
      yangon[24] = "Thongwa";
      yangon[25] = "Kayan";
      yangon[26] = "Twantay";
      yangon[27] = "Kawhmu";
      yangon[28] = "Kungyangon";
      yangon[29] = "Dala";
      yangon[30] = "Seikgyikanaungto";
      yangon[31] = "Cocokyun";
      yangon[32] = "Kyauktada";
      yangon[33] = "Pabedan";
      yangon[34] = "Lanmadaw";
      yangon[35] = "Latha";
      yangon[36] = "Ahlone";
      yangon[37] = "Kyeemyindaing";
      yangon[38] = "Sanchaung";
      yangon[39] = "Hlaing";
      yangon[40] = "Kamaryut";
      yangon[41] = "Mayangone";
      yangon[42] = "Dagon";
      yangon[43] = "Bahan";
      yangon[44] = "Seikkan";
      // to clear option in select township

      if (tt_inner.innerHTML != null) {
        tt_inner.innerHTML = "";
      }
      // to show township
      for (var i = 0; i < Tcount; i++) {
        // get reference to select element

        // create new option element
        var opt = document.createElement("option");
        // create text node to add to option element (opt)
        opt.appendChild(document.createTextNode(yangon[i]));
        // set value property of opt
        opt.value = yangon[i];
        // add opt to end of select box (sel)
        sel.appendChild(opt);
      }
    } else {
      $("#sub_risk").empty();
    }
  }

  function oneClick() {
    $("#loadingSpinner").css("opacity", 1).addClass("spinner");
    $(".tab-content").css("opacity", 0.3);
    $(".tab-content").addClass("freeze-body");
  }

  function net_age(reg_date, date_ofBirth, visit_date) {
    console.log(date_ofBirth + "date of birth is here");
    if (reg_date != 0 && reg_date != "" && reg_date != null && reg_date != "undefined") {
      reg_year = reg_date.split("-")[0];
      reg_month = reg_date.split('-')[1];
      dob_year = date_ofBirth.split('-')[0];
      dob_month = date_ofBirth.split('-')[1];

      if (visit_date == null || visit_date == "" || visit_date == undefined) {
        var Adate = new Date();
        current_month = Adate.getMonth() + 1
        current_year = Adate.getFullYear();
      } else {
        visit_date = visit_date.split("-");
        current_month = visit_date[1];
        current_year = visit_date[2];
      }

      // var Adate = new Date();
      // current_month=Adate.getMonth()+1
      // current_year=Adate.getFullYear();


      reg_age = reg_year - dob_year;
      current_age = current_year - dob_year;
      if (reg_age == 1) {
        if (dob_month > reg_month) {

          reg_age_month = (12 - dob_month) + Number(reg_month);
          reg_age = 0;
        } else {
          reg_age = 1;
          reg_age_month = 0;
        }
      } else if (reg_age == 0) {
        reg_age_month = reg_month - dob_month;
        reg_age = 0
      } else {
        reg_age_month = 0;
      }

      if (current_age == 1) {
        if (dob_month > current_month) {
          current_age_month = (12 - dob_month) + Number(current_month);
          current_age = 0;
        } else {
          current_age = 1;
          current_age_month = 0;
        }
      } else if (current_age == 0) {
        current_age_month = current_month - dob_month;
        current_age = 0
      } else {
        current_age_month = 0;
      }
      $("#agey_register").val(reg_age);
      $("#agem_register").val(reg_age_month);
      $("#agey").val(current_age);
      $("#agem").val(current_age_month);
      console.log(reg_age_month, current_age_month)


    } else {
      alert("Register Date မပါသေးပါ။")
      $("#register_date").focus();
      return;
    }

  }

  function DateTo_text() {
    $("input.Gdate[type='text']").each(function(index) {
      if ($(this).val() != "" && $(this).val().split('-')[0].length > 3) {
        var dateData = $(this).val();
        var dateSplit = dateData.split(/[-\/]/);
        console.log(dateSplit[0].length)
        if (dateSplit[0].length > 3) {
          var date_yy = dateSplit[0];
          var date_mm = dateSplit[1];
          var date_dd = dateSplit[2];
          $(this).val(date_dd + "-" + date_mm + "-" + date_yy);
        } else if (dateSplit[0].length < 3) {
          var date_yy = dateSplit[2];
          var date_mm = dateSplit[1];
          var date_dd = dateSplit[0];
          $(this).val(date_dd + "-" + date_mm + "-" + date_yy);
        }
      }

    });
  }

  function dateOfBirth() {

    var estimated_DoB = 0;
    var vDate_dob = document.getElementById('vDate').value;
    var agey_dob = document.getElementById("agey_register").value;
    var agem_dob = document.getElementById("agem_register").value;
    console.log(dob_input, register_date + "dob adn reg");
    if (dob_input == "") {
      console.log(document.getElementById('dob').value + "dob")
      dob_input = formatDate(document.getElementById('dob').value);
    }
    if (register_date == "") {
      register_date = formatDate($("#register_date").val());
    }
    console.log("hello DoB function");

    var Adate = new Date();
    var Ayear = Adate.getFullYear();
    var birth_year = Ayear - agey_dob;

    var Bmonth = register_date.split('-')[1];
    var reg_forDob = register_date.split('-');
    var reg_date_year = reg_forDob[0];
    if (dob_input.length == 0) {
      if (agey_dob == "" && agem_dob == "") {
        alert("Input Register Age or Date of birth");
      } else {
        var dobarray = dob_input.split("-");
        var dt_yearDay = dobarray[0];
        var dtYear = dobarray[2];
        if (agey_dob > 0) { // For Age in Year
          if (agey_dob == 1) {

            var estimated_Year = reg_date_year - agey_dob;
            var estimated_Month = reg_forDob[1];
            var estimated_Day = reg_forDob[2];
            estimated_DoB = estimated_Year + "-" + estimated_Month + "-" + estimated_Day;
            //console.log(estimated_DoB+"you are fool dob");
          } else {
            var estimated_Year = reg_date_year - agey_dob;
            var estimated_Month = 6; //Fixed Define Month of Birth "June"
            var estimated_Day = 1; //Fixed Define day of Birth "1st"
            if (estimated_Month < 10) {
              estimated_Month = "0" + estimated_Month;
            }
            if (estimated_Day < 10) {
              estimated_Day = "0" + estimated_Day;
            }
            estimated_DoB = estimated_Year + "-" + estimated_Month + "-" + estimated_Day;
          }

        } else if (agem_dob > 0) { // For Age in Month

          var estimated_Year = reg_date_year;
          var estimated_Month = Bmonth - agem_dob;
          console.log(estimated_Month);
          if (estimated_Month < 0) {
            estimated_Month = 12 + estimated_Month;
            estimated_Year = estimated_Year - 1;

          }

          if (estimated_Month == 0) {
            estimated_Year = estimated_Year - 1;
            estimated_Month = estimated_Month + 12;
          }
          var estimated_Day = 1; //fixed defined  estimated Day " 1st "
          if (estimated_Month < 10) {
            estimated_Month = "0" + estimated_Month;
          }
          if (estimated_Day < 10) {
            estimated_Day = "0" + estimated_Day;
          }
          estimated_DoB = estimated_Year + "-" + estimated_Month + "-" + estimated_Day;

          console.log(estimated_DoB + "dob months is here")

        }
        ddDate = estimated_DoB;

      }
    } else {
      if (dob_input == undefined) {
        estimated_DoB = document.getElementById('dob').value;
        ddDate = formatDate(estimated_DoB);
      } else {
        ddDate = dob_input;
      }

      // $("#dob").val(ddDate);
    }
    if (agem_dob == 12) {
      $("#agem_register").val("");
      $("#agey_register").focus();
      alert("if month is 12,add one year to age")
    } else {
      net_age(register_date, ddDate, vDate_dob); //register_date

    }
    if (date_origin != agey_dob) {
      edit = 1; // date_origin must come form confidential DB age
    }
  }

  function reg_age_change() {
    dob_input = "";
    dateOfBirth();
  }

  function reg_date_change() {
    register_date = "";
  }

  function dateOfBirth_to_age() {
    var Adate = new Date();
    var Aday = Adate.getDate();
    var Bmonth = Adate.getMonth() + 1;
    var Ayear = Adate.getFullYear();


    var estimated_DoB = 0;

    var dob_input = document.getElementById('dob').value;
    console.log(dob_input + "date of birth function");

    if (!dob_input) {
      document.getElementById('agey').value = "";
    } else {
      var dobarray = dob_input.split("-");
      var dt_yearDay = dobarray[0];
      if (dt_yearDay.length < 3) {
        var dtYear = dobarray[2]
      } else {
        var dtYear = dt_yearDay
      }
      console.log(dtYear + "date of Year only");

      if (dtYear == Ayear) {
        var AgeMonth = dobarray[1];
        document.getElementById('agem').value = Bmonth - AgeMonth;
        document.getElementById('agey').value = "";
        $("#agey_register").val("");
      } else {
        document.getElementById('agey').value = Ayear - dtYear;
        register_age = Number(register_date.split("-")[0]) - dtYear;
        $("#agem").val("");

        $("#agey_register").val(register_age);
      }

    }
  }

  function dateCalender() {
    var dateid = $(event.target).prev("input").attr("id"); // Get the ID of the input field
    var notDisabled = !$("#" + dateid).parent().children().first().is(":disabled");
    if (notDisabled) {
      var dateFormat = "dd-mm-yy"; // Define the date format
      $("#" + dateid).datepicker({
        dateFormat: dateFormat,
        onSelect: function() {
          $("#" + dateid).focus();
          $(this).datepicker("hide");
          $("#" + dateid).removeClass("hasDatepicker");
        }
      });
      $("#" + dateid).datepicker("show");
    }

  }

  function dateformatValid() {
    var date_val = $(event.target).val();
    console.log(date_val);
    var dateForm = date_val.split(/[-/]/);
    if (dateForm[0] > 31 || dateForm[0].length > 2) {
      alert("Invalid Day.");
      $(event.target).val("").focus();
    } else {
      if (dateForm[0].length == 1) {
        var days = "0" + dateForm[0];
      } else {
        var days = dateForm[0];
      }
      if (dateForm[1] > 12 || dateForm[0].length > 2) {
        alert("Invalid Month.")
        $(event.target).val("").focus();
      } else {
        if (dateForm[1].length == 1) {
          var months = "0" + dateForm[1];
        } else {
          var months = dateForm[1];
        }
        if (dateForm[2].length != 2 && dateForm[2].length != 4) {
          alert("Invalid Year.")
          $(event.target).val("").focus();
        } else {
          if (dateForm[2].length == 2) {
            var years = "20" + dateForm[2];
            $(event.target).val(days + "-" + months + "-" + years)
          } else if (dateForm[2].length == 4) {
            var years = dateForm[2];
            console.log("right date")
            $(event.target).val(days + "-" + months + "-" + years)
          } else {
            alert("Invalid Year.");
            $(event.target).val("").focus();
          }

        }
      }
    }
    $("#ui-datepicker-div").remove();
  }



  function refresh() {
    location.reload(true);
  }

  function clearFacts() {
    $(".recepatient-info select,.recepatient-info input,#prepCode,#name,#father,#gender").val("");
    $(".recepatient-info select,.recepatient-info input,#prepCode,#name,#father,#gender").prop("disabled", false);
    $("#agey,#agem").prop("disabled", true);
  }
</script>
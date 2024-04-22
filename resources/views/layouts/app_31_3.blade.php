<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
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
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/slider.js')}}"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{asset('js/toggle.js')}}"></script>
    <script src="{{asset('js/sti.js')}}"></script>
    <script src="{{asset('js/lab.js')}}"></script>

    <!-- Bootstrap CSS -->
    <link href="{{asset('bootstrap/css/bootstrap.min.css')}}" media="print" rel="stylesheet">
    <link href="{{asset('bootstrap/css/bootstrap.min.css')}}" media="screen" rel="stylesheet">


    <!-- Bootstrap Bundle with Popper -->
    <script src="{{asset('bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.0/dist/JsBarcode.all.min.js"></script> -->
        <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script> -->

    <!-- Styles -->

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="/css/common.css" type="text/css">
    <link rel="stylesheet" href="/css/Reception/reception.css" type="text/css">
    <link rel="stylesheet" href="/css/Reception/reception-return.css" type="text/css">
    <link rel="stylesheet" href="/css/Reception/next-appointment.css" type="text/css">
    <link rel="stylesheet" href="/css/Reception/reception-follow.css" type="text/css">
    <link rel="stylesheet" href="/css/Lab/lab.css" type="text/css">
    <link rel="stylesheet" href="/css/Counsellor/counselling.css" type="text/css">
    <link rel="stylesheet" href="/css/STI/stiform.css">
    <link rel="stylesheet" href="/css/Admin/admin.css">

</head>
<body >
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light shadow-sm navbar">    <!--bg-white  -->
            <div class="container containers" >                                <!-- *adding containers clss -->
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
                        @if (Auth::user()->type==1)
                          <ul class="nav nav-tabs reception-nav-ul main-nav" id="main-title">
                            <li class="nav-item dropdown recption-dropdown">
                              <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#">Clinic' Reception </a>
                              <ul class="dropdown-menu">
                                  <li><a class="dropdown-item" href="{{url('Reception/Reception')}}">Clinic Reception</a></li>
                                  <!-- <li><a class="dropdown-item" href="{{url('Reception/Reception_return')}}">Return to Reception</a></li>
                                  <li><a class="dropdown-item" href="{{url('Reception/Reception_next')}}">Next Appointment List</a></li>
                                  <li><a class="dropdown-item" href="{{url('Reception/reception_followup_history')}}">follow_up_history</a></li>
                                  <li><a class="dropdown-item" href="{{url('Reception/patients')}}">Patients List </a></li>
                                 <li><a class="dropdown-item" href="{{url('import/GeneralPatientImport')}}">General Import</a></li> -->
                              </ul>
                            </li>
                            <li class="nav-item dropdown recption-dropdown">
                              <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#">Exports Files </a>
                              <ul class="dropdown-menu">
                                  <li><a class="dropdown-item" href="{{url('Reception/exports')}}">Register Data Export</a></li>
                                  <li><a class="dropdown-item" href="{{url('Reception/export_followup')}}">Follow Up Data Export</a></li>
                              </ul>
                            </li>
                            <li class="nav-item dropdown recption-dropdown">
                              <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#">Reports </a>
                              <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{url('Reception/report')}}">Clinic C2 Consultation</a></li>
                              </ul>
                            </li>
                            <li class="nav-item dropdown recption-dropdown">
                              <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#">Information </a>
                              <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{url('Manage/info')}}">Announcements</a></li>
                              </ul>
                            </li>

                          </ul>
                        @endif
                        @if (Auth::user()->type==2)
                          <ul class="nav nav-tabs assist-nav-ul main-nav" id="main-title">
                            <li class="nav-item dropdown">
                              <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#">Programs</a>
                              <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{url('STI/stiform')}}">STI Forms</a></li>
                                  <li><a class="dropdown-item" href="{{url('Reception/patients')}}">Patients List </a></li>
                              <!--  <li><a class="dropdown-item" href="{{url('STI/sti-patients')}}">STI Patients List </a></li> -->
                              <!--  <li><a class="dropdown-item" href="{{url('NCD/Ncd')}}">NCD Forms</a></li> -->
                              </ul>
                            </li>
                            <li class="nav-item dropdown">
                              <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#">Exports Files </a>
                              <ul class="dropdown-menu">
                                  <li><a class="dropdown-item" href="{{url('Reception/exports')}}">Register Data Export</a></li>
                                  <li><a class="dropdown-item" href="{{url('Reception/export_followup')}}">Follow Up Data Export</a></li>
                              </ul>
                            </li>
                            <li class="nav-item dropdown">
                              <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#">Reports </a>
                              <ul class="dropdown-menu">

                                    <li><a class="dropdown-item" href="{{url('Reports/STI_Report')}}">STI report</a></li>
                              </ul>
                            </li>
                            <li class="nav-item dropdown">
                              <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#">Information </a>
                              <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{url('Manage/info')}}">Announcements</a></li>
                              </ul>
                            </li>

                           <li class="nav-item dropdown">
                              <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#">Import Files</a>
                              <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{url('import/Stimale_Import')}}">STI-Male Import</a></li>
                               <li><a class="dropdown-item" href="{{url('import/StiFemale_Import')}}">STI-Female Import</a></li>
                                <li><a class="dropdown-item" href="{{url('import/RprlabresultsImport')}}">RPR_lab_results Import</a></li>

                              </ul>
                            </li>
                            <!--
                            <li class="nav-item dropdown">
                              <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#">Export Files</a>
                              <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{url('import/NcdRegImport')}}">NCD Register</a></li>
                                <li><a class="dropdown-item" href="{{url('import/NcdArImport')}}">NCD AR</a></li>
                                <li><a class="dropdown-item" href="{{url('import/NcdFollowup')}}">NCD Follow Up</a></li>

                              </ul>
                            </li>   -->

                          </ul>
                        @endif
                        @if (Auth::user()->type=="3")
                          <ul class="nav nav-tabs lab-nav main-nav" id="main-title">
                            <li class="nav-item dropdown">
                              <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#">Lab</a>
                              <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{url('Labs/labs')}}">Labs</a></li>
                                <li><a class="dropdown-item" href="{{url('Reception/patients')}}">Patients List </a></li>
                              <!--  <li><a class="dropdown-item" href="{{url('import/lab_hiv_import')}}">Lab's Old data Import</a></li> -->
                              <!--  <li><a class="dropdown-item" href="{{url('import/passport')}}">Test</a></li>
                                <li><a class="dropdown-item" href="{{url('Labs/results')}}">Lab's Reports </a></li>
                                <li><a class="dropdown-item" href="{{url('Labs/exports')}}">Lab's Exports </a></li> -->
                              </ul>
                            </li>
                            <li class="nav-item dropdown">
                              <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#">Reports</a>
                              <ul class="dropdown-menu">
                              <li><a class="dropdown-item" href="{{url('Labs/results')}}">Lab's Reports </a></li>
                              <!--  <li><a class="dropdown-item" href="{{url('import/lab_hiv_import')}}">Lab's Old data Import</a></li> -->
                              <!--  <li><a class="dropdown-item" href="{{url('import/passport')}}">Test</a></li> -->
                              </ul>
                            </li>
                            <li class="nav-item dropdown">
                              <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#">Exports</a>
                              <ul class="dropdown-menu">
                              <!--  <li><a class="dropdown-item" href="{{url('import/lab_hiv_import')}}">Lab's Old data Import</a></li> -->
                              <!--  <li><a class="dropdown-item" href="{{url('import/passport')}}">Test</a></li> -->
                                <li><a class="dropdown-item" href="{{url('Labs/export')}}">Export </a></li>
                              </ul>
                            </li>
                            <li class="nav-item dropdown">
                              <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#">Information </a>
                              <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{url('Manage/info')}}">Announcements</a></li>
                              </ul>
                            </li>

                          </ul>
                        @endif
                        @if (Auth::user()->type==4)
                          <ul class="nav nav-tabs consel-mainlist" id="main-title"style="width:90%">
                            <li class="nav-item dropdown">
                              <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#">Counselling</a>
                              <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{url('Counsellor/counselling')}}">Counselling Room</a></li>
                                <li><a class="dropdown-item" href="{{url('Reception/patients')}}">Patients List </a></li>

                              </ul>
                            </li>

                            <li class="nav-item dropdown">
                              <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#">Information </a>
                              <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{url('Manage/info')}}">Announcements</a></li>
                              </ul>
                            </li>

                          </ul>
                        @endif


                    @if (Auth::user()->type==5)
                      <ul id="main-title" id="main-title">
                        <li class="nav-item dropdown">

                          <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#">Dispensing</a>
                            <ul class="dropdown-menu">
                              <li><a class="dropdown-item" href="{{url('Dispensing/dispensing')}}">Dispensing </a></li>
                            </ul>
                          </li>
                          <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#">Reports</a>
                          <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{url('Reports/STI_Report')}}">STI Reports</a></li>
                          </ul>
                         </li>
                      </ul>
                    @endif

                    @if (Auth::user()->type==6)
                        <ul class="nav nav-tabs admin-list" id="main-title">
                          <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#">Manage</a>
                            <ul class="dropdown-menu">
                              <li><a class="dropdown-item" href="{{url('Manage/users')}}">Add/Delete User</a></li>
                              <li><a class="dropdown-item" href="{{url('Manage/users_list')}}">User List</a></li>
                              <li><a class="dropdown-item" href="{{url('Manage/announcement')}}">Announcements</a></li>
                            </ul>
                          </li>
                          <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#">Reports</a>
                            <ul class="dropdown-menu">
                              <li><a class="dropdown-item" href="{{url('Reception/report')}}">Clinic Consultation</a></li>
                              <li><a class="dropdown-item" href="{{url('Manage/users_list')}}">Workloads</a></li>
                              <li><a class="dropdown-item" href="{{url('Reception/patients')}}">Stock</a></li>
                            </ul>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="#">About</a>
                          </li>

                        </ul>
                     @endif

                        <!-- <ul class="navbar-nav ms-auto"> *  CLINIC CODE
                          <li>
                                <label style="color:red;" class="form-control" id="clinic">Clinic Code :{{Auth::user()->clinic}}</label>
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
                                <a id="navbarDropdown" name='appUser' class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
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
            @yield('content')
        </main>

</body>
</html>
<script type="text/javascript">

</script>

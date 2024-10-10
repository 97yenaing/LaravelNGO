<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="{{asset('js/jquery.min.js')}}"></script>
        <script src="{{asset('js/welcome.js')}}"></script>


        <script src="{{asset('js/slider.js')}}"></script>
        

        <title>MAM-Welcome_Pages</title>
        <link rel="stylesheet" href="/css/Welcome/welcome.css">
    </head>
    <body>

            <div class="content">
                <img  class="logo" src="img/mamLogo.png" alt="MAM-LOGO">
                @if (Route::has('login'))
                            <div class="top-right links">
                                @auth
                                    <a href="{{ url('/home') }}">Home</a>
                                @else
                                    <a href="{{ route('login') }}">Login</a>
                                    
                                @endauth
                            </div>
                @endif 
                <div>
                    <h1>Health Information<br class="mobile"> System</h1>
                    <h2>improving access to<br class="mobile"> Health care for all people in<br class="mobile"><br class="tablet"> Myanmar</h1>
                   
                </div>
                <div class="deshboard">

                   
                </div>
                
            </div>
            <div id="welcome-img">
                <img class="pc" id="optWelcome-imgp" src="img/welcome/image1.png">
                <img class="tablet" id="optWelcome-imgt" src="img/welcome/imagetb1.png">
                <img class="moblile" id="optWelcome-imgm" src="img/welcome/imagemb1.png">
            </div>

    </body>
    
</html>

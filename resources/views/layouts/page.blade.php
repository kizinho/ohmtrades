<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" />
<head>
   <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicons -->
    <link rel="icon" href="{{asset($settings['favicon']) }}">
    <link rel="shortcut icon" href="{{asset($settings['favicon']) }}">
    <link rel="apple-touch-icon"   href="{{asset($settings['favicon']) }}">
    <link rel="apple-touch-icon"  href="{{asset($settings['favicon']) }}">
    <link rel="apple-touch-icon"  href="{{asset($settings['favicon']) }}">
    <link rel="apple-touch-icon"  href="{{asset($settings['favicon']) }}">
    @yield('title')

      <!-- Critical preload -->
    <link rel="preload" href="{{ asset("frontend/js/vendors/uikit.min.js")}}" as="script">
    <link rel="preload" href="{{ asset("frontend/css/vendors/uikit.min.css")}}" as="style">
    <link rel="preload" href="{{ asset("frontend/css/style.css")}}" as="style">
    <!-- Icon preload -->
    <link rel="preload" href="{{ asset("frontend/fonts/fa-brands-400.woff2")}}" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="{{ asset("frontend/fonts/fa-solid-900.woff2")}}" as="font" type="font/woff2" crossorigin>
    <!-- Font preload -->
    <link rel="preload" href="{{ asset("frontend/fonts/rubik-v9-latin-500.woff2")}}" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="{{ asset("frontend/fonts/rubik-v9-latin-300.woff2")}}" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="{{ asset("frontend/fonts/rubik-v9-latin-regular.woff2")}}" as="font" type="font/woff2" crossorigin>
 <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
    <!-- Stylesheet -->
    <link rel="stylesheet" href="{{ asset("frontend/css/vendors/uikit.min.css")}}">
    <link rel="stylesheet" href="{{ asset("frontend/css/style.css")}}">
    <style>

        #snackbar_error {
            visibility: hidden;
            min-width: 250px;
            margin-left: -125px;
            background-color: red;
            color: #fff;
            text-align: center;
            border-radius: 2px;
            padding: 16px;
            position: fixed;
            z-index: 2000;
            left: 50%;
            bottom: 30px;
            font-size: 17px;
        }

        #snackbar_error.show {
            visibility: visible;
            -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
            animation: fadein 0.5s, fadeout 0.5s 2.5s;
        }
        #snackbar_success {
            visibility: hidden;
            min-width: 250px;
            margin-left: -125px;
            background-color: green;
            color: #fff;
            text-align: center;
            border-radius: 2px;
            padding: 16px;
            position: fixed;
            z-index: 2000;
            left: 50%;
            bottom: 30px;
            font-size: 17px;
        }

        #snackbar_success.show {
            visibility: visible;
            -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
            animation: fadein 0.5s, fadeout 0.5s 2.5s;
        }

        #google_translate_element {
            position: relative;
        }

        .goog-logo-link {
            display: none !important;
        }

        .goog-logo-link #text {
            display: none !important;
        }

        .goog-te-gadget {
            font-size: 0px !important;
        }

        .goog-te-gadget div {
            display: inline;
        }

        .goog-te-gadget div select {
            width: 130px;
            height: 40px;
            background: transparent;
            border: 1px solid #701f2f !important;
            color: #ddd5d5;
            outline: none;
            border: none;
        }

        .goog-te-gadget div select option {
            border: 1px solid #701f2f !important;
        }

        .goog-te-gadget div select option:hover {
            cursor: pointer;
        }

        .goog-te-gadget div select:hover {
            border: 1px solid #701f2f !important;
            cursor: pointer;
        }
    </style>  

</head>
<body>
   <!-- preloader begin -->
    <div class="in-loader">
        <div></div>
        <div></div>
        <div></div>
    </div>
    <!-- preloader end -->
  
    @include('layouts.nav-page')
    @yield('content')
    @include('layouts.footer')
  
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
    <div id="snackbar_error"></div>
    <div id="snackbar_success"></div>
    <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
        }
    </script>

    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
       <script src="{{ asset('admin/js/jquery-3.3.1.min.js')}}"></script>
<script src="{{ asset("frontend/js/vendors/uikit.min.js")}}"></script>
    <script src="{{ asset("frontend/js/vendors/indonez.min.js")}}"></script>
    <script src="{{ asset("frontend/js/config-theme.js")}}"></script>

	

 
    <!-- Main file-->

   
  

    @yield('script')
    <script>
        $(".deleted-list").on("submit", function () {

            return confirm("Are you sure?");
        });

        function messageAlertError() {
            var x = document.getElementById("snackbar_error");
            x.className = "show";
            setTimeout(function () {
                x.className = x.className.replace("show", "");
            }, 5000);
            $(".modal").hide();
        }
        function messageAlertSuccess() {
            var x = document.getElementById("snackbar_success");
            x.className = "show";
            setTimeout(function () {
                x.className = x.className.replace("show", "");
            }, 5000);
            $(".modal").hide();
        }
    </script>
    @if(session()->has('message.level'))
    <script type="text/javascript">
        var message = "{!! session('message.content') !!}";
        $("#snackbar_error").html(message);
                @if (session('message.level') == 'error')
        messageAlertError();
                @else
        $("#snackbar_success").html(message);
        messageAlertSuccess();
        @endif

    </script>

    @endif
 @if ($errors->has('email'))
 <script type="text/javascript">
    var message = "{!!  $errors->first('email') !!}";
    $("#snackbar_error").html(message);
    messageAlertError();
          
</script>
 
 @endif

    @if (session('status'))
 <script type="text/javascript">
    var message = "{!!  session('status') !!}";
    $("#snackbar_success").html(message);
    messageAlertSuccess();
</script>
 
 @endif
</body>
</html>

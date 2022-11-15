<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" />
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicons -->
    <link rel="icon" href="{{asset($settings['favicon']) }}">
    <link rel="shortcut icon" href="{{asset($settings['favicon']) }}">
    <link rel="apple-touch-icon"   href="{{asset($settings['favicon']) }}">
    <link rel="apple-touch-icon"  href="{{asset($settings['favicon']) }}">
    <link rel="apple-touch-icon"  href="{{asset($settings['favicon']) }}">
    <link rel="apple-touch-icon"  href="{{asset($settings['favicon']) }}">
    @yield('title')
    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
    <link href="{{ asset('dashboard/assets/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ asset('dashboard/assets/plugins/font-awesome/css/all.min.css')}}" rel="stylesheet">
    <link href="{{ asset('dashboard/assets/plugins/waves/waves.min.css')}}" rel="stylesheet">
    <link href="{{ asset('dashboard/assets/plugins/nvd3/nv.d3.min.css')}}" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="{{ asset('dashboard/datatables.min.css')}}"/>
<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
    <!-- Theme Styles -->
    <link href="{{ asset('dashboard/assets/css/alpha.min.css')}}" rel="stylesheet">
    <link href="{{ asset('dashboard/assets/css/custom.css')}}" rel="stylesheet">


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

    </style>  

</head>
<body>
        <div class="loader">
            <div class="spinner-border text-primary" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
     <div class="alpha-app">
        @include('layouts.nav_dashboard')
        @yield('content')

     </div>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
    <div id="snackbar_error"></div>
    <div id="snackbar_success"></div>
    <script src="{{asset('dashboard/assets/plugins/jquery/jquery-3.4.1.min.js')}}"></script>
    <script src="{{asset('dashboard/assets/plugins/bootstrap/popper.min.js')}}"></script>
    <script src="{{asset('dashboard/assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('dashboard/assets/plugins/waves/waves.min.js')}}"></script>
    <script src="{{asset('dashboard/assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
    <script src="{{asset('dashboard/assets/plugins/d3/d3.min.js')}}"></script>
    <script src="{{asset('dashboard/assets/plugins/nvd3/nv.d3.min.js')}}"></script>
    <script src="{{asset('dashboard/assets/plugins/jquery-sparkline/jquery.sparkline.min.js')}}"></script>
    <script src="{{asset('dashboard/assets/plugins/flot/jquery.flot.min.js')}}"></script>
    <script src="{{asset('dashboard/assets/plugins/flot/jquery.flot.time.min.js')}}"></script>
    <script src="{{asset('dashboard/assets/plugins/flot/jquery.flot.symbol.min.js')}}"></script>
    <script src="{{asset('dashboard/assets/plugins/flot/jquery.flot.resize.min.js')}}"></script>
    <script src="{{asset('dashboard/assets/plugins/flot/jquery.flot.tooltip.min.js')}}"></script>
    <script src="{{asset('dashboard/assets/js/alpha.min.js')}}"></script>
    <script src="{{asset('dashboard/assets/js/pages/dashboard.js')}}"></script>
    
    <script>
$(".deleted").on("submit", function () {

    return confirm("Are you sure?");
});
    </script>

    <script>
        $(".deleted-list").on("submit", function () {

            return confirm("Are you sure?");
        });
    </script>
    <script>
        $('#myModal').appendTo("body").modal('show');
    </script>

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

</body>
</html>

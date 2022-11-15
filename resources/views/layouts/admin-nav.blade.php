<!-- cp navi wrapper Start -->
<nav class="cd-dropdown d-block d-sm-block d-md-block d-lg-none d-xl-none">
    <h2><a href="{{url('/')}}"> <img src="{{asset($settings['logo']) }}" style="width:200px;height:100px"> </a></h2>
    <a href="#0" class="cd-close">Close</a>
    <ul class="cd-dropdown-content">

        <li class="active"><a href="#"> Home </a></li>
        <li><a href="{{url('about-us')}}"> about us </a></li>
        @Auth
        <li class="has-children">
            <a href="#">dashboard</a>
            <ul class="cd-secondary-dropdown icon_menu is-hidden">
                <li class="go-back"><a href="#0">Menu</a></li>
             
            </ul>
        </li>  
        @endAuth
        <li><a href="{{url('contus-us')}}"> contact us </a></li>
        @Auth

        <li><a href="{{url('office')}}">{{Auth::user()->first_name}} {{Auth::user()->last_name}}</a></li>
        <li><a href="#" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();"> Logout </a></li>
        @else


        <li><a href="{{url('login')}}"> login </a></li>
        <li><a href="{{url('register')}}"> register </a></li>
        @endAuth

    </ul>
    <!-- .cd-dropdown-content -->
</nav>
<div class="cp_navi_main_wrapper inner_header_wrapper float_left">
    <div class="container-fluid">
        <div class="cp_logo_wrapper">
            <a href="{{url('/')}}">
                <img src="{{asset($settings['logo']) }}" style="width:230px;height:60px" alt="logo">
            </a>
        </div>
        <!-- mobile menu area start -->
        <header class="mobail_menu d-block d-sm-block d-md-block d-lg-none d-xl-none">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="cd-dropdown-wrapper">
                            <a class="house_toggle inner_toggle" href="#0">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 31.177 31.177" style="enable-background:new 0 0 31.177 31.177;" xml:space="preserve" width="25px" height="25px">
                                <g>
                                <g>
                                <path class="menubar" d="M30.23,1.775H0.946c-0.489,0-0.887-0.398-0.887-0.888S0.457,0,0.946,0H30.23    c0.49,0,0.888,0.398,0.888,0.888S30.72,1.775,30.23,1.775z" fill="#004165" />
                                </g>
                                <g>
                                <path class="menubar" d="M30.23,9.126H12.069c-0.49,0-0.888-0.398-0.888-0.888c0-0.49,0.398-0.888,0.888-0.888H30.23    c0.49,0,0.888,0.397,0.888,0.888C31.118,8.729,30.72,9.126,30.23,9.126z" fill="#004165" />
                                </g>
                                <g>
                                <path class="menubar" d="M30.23,16.477H0.946c-0.489,0-0.887-0.398-0.887-0.888c0-0.49,0.398-0.888,0.887-0.888H30.23    c0.49,0,0.888,0.397,0.888,0.888C31.118,16.079,30.72,16.477,30.23,16.477z" fill="#004165" />
                                </g>
                                <g>
                                <path class="menubar" d="M30.23,23.826H12.069c-0.49,0-0.888-0.396-0.888-0.887c0-0.49,0.398-0.888,0.888-0.888H30.23    c0.49,0,0.888,0.397,0.888,0.888C31.118,23.43,30.72,23.826,30.23,23.826z" fill="#004165" />
                                </g>
                                <g>
                                <path class="menubar" d="M30.23,31.177H0.946c-0.489,0-0.887-0.396-0.887-0.887c0-0.49,0.398-0.888,0.887-0.888H30.23    c0.49,0,0.888,0.398,0.888,0.888C31.118,30.78,30.72,31.177,30.23,31.177z" fill="#004165" />
                                </g>
                                </g>
                                </svg>
                            </a>
                            <!-- .cd-dropdown -->

                        </div>
                    </div>
                </div>
            </div>
            <!-- .cd-dropdown-wrapper -->
        </header>
        <div class="top_header_right_wrapper">
            <div class="header_btn">
                <ul>
                    @Auth
                    <li>
                        <a href="{{url('/office')}}"> {{Auth::user()->first_name}} {{Auth::user()->last_name}}</a> </li>
                    <li>
                        <a href="#" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();"> Logout </a> </li>
                    @else
                    <li>
                        <a href="{{url('register')}}"> register </a> </li>
                    <li>
                        <a href="{{url('login')}}"> login </a> </li>
                    @endAuth
                </ul>


            </div>
        </div>

        <div class="cp_navigation_wrapper main_top_wrapper">
            <div class="mainmenu d-xl-block d-lg-block d-md-none d-sm-none d-none">
                <ul class="main_nav_ul">             
                    <li><a href="{{url('/')}}" class="gc_main_navigation">Home</a></li> 
                    <li><a href="{{url('about-us')}}" class="gc_main_navigation">about us</a></li>                
                    @Auth
                   

                    @endAuth
                   
                </ul>
            </div>
            <!-- mainmenu end -->
        </div>
    </div>
</div>

<!-- navi wrapper End -->
<!-- inner header wrapper start -->
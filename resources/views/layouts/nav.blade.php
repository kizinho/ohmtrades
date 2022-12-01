<div id="preloader"></div>

<header class="navbar navbar-expand-lg navbar-dark">
    <div class="container-md">
        <div class="navbar-brand align-items-center" id="logo">
            <img src="{{asset($settings['logo']) }}" width="100" height="50" class="w-50 me-3">
            <p>{{$settings['site_name']}}</p>
        </div>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main-nav"
                aria-control="main-nav" aria-expanded="false" aria-label="Toggle Nav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end align-items-center" id="main-nav">
            <ul class="navbar-nav">
                <li class="nav-item h6"><a class="nav-link" href="#logo">Home</a></li>
                <li class="nav-item h6"><a class="nav-link" href="#content-about-us">About</a></li>
                <li class="nav-item h6"><a class="nav-link" href="#content-our-pool">Our Pool</a></li>
                <li class="nav-item h6"><a class="nav-link" href="#content-our-services">Services</a></li>
                <li class="nav-item h6"><a class="nav-link" href="#content-contact-us">Contact Us</a></li>
                <li class="nav-item h6"><a class="nav-link px-4" href=""
                                           class="btn btn-outline-primary px-4">Sign
                        Up</a>
                </li>
            </ul>
        </div>

    </div>

</header>















<!--<header id="header" class="onepage-header" data-spy="affix" data-offset-top="197">
    <div class="container">
        <div class="row scroll-hide">
            <div class="header-top-bar">
                <div class="col-md-6 col-sm-8">
                    <div class="left-text text-left">
                        <span><i class="fa fa-envelope-o"></i>{{$settings['site_email']}}</span>
                        <span><i class="fa fa-phone"></i>{{$settings['site_phone']}}</span>
                    </div>
                </div>
                <div class="col-md-6 col-sm-4">
                    <div class="right-text text-right">
                        <ul class="social-icons text-right white-color">
                            <li class="google-plus">
                                <a title="Youtube+" target="_blank" href="#"><i class="fa fa-youtube"></i></a>
                            </li>
                            <li class="facebook">
                                <a title="Facebook" target="_blank" href="#"><i class="fa fa-facebook"></i></a>
                            </li>
                            <li class="twitter">
                                <a title="Twitter" target="_blank" href="#"><i class="fa fa-twitter"></i></a>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
        /*end row top bar*/

        <div class="row">
            <div class="header-main-bar">
                <div class="col-md-2 col-xs-12">
                    <div class="logo">
                        <a class="visible-sec" href="{{url('/')}}" title="{{$settings['site_name']}}"> <img 
alt="{{$settings['site_name']}}" src="{{asset($settings['logo']) }}"> </a>
                        <div class="hidden-sec slim-wrap" data-image="{{$settings['site_name']}}" data-homelink="{{url('/')}}" data-imagealt="{{$settings['site_name']}}">
                            <ul id="menu-one-page-menu" class="slimmenu">
                                <li id="menu-item-62" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-62 active active-page"><a href="{{url('/')}}">Home</a></li>
                                <li id="menu-item-63" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-63"><a href="#about">About</a></li>
                                <li id="menu-item-64" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-64"><a href="#team">Team</a></li>
                                <li id="menu-item-65" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-65"><a href="#testimonial">Testimonial</a></li>
                                <li id="menu-item-66" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-66"><a href="#blog">Blog</a></li>
                                <li id="menu-item-67" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-67"><a href="#contact">Contact</a></li>
                                <li id="menu-item-161" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-161"><a href="blog/index.html">Multipages</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-10">
                    <div class="navbar-collapse nav-main-collapse collapse visible-sec">
                        <nav class="nav-main mega-menu">
                            <div class="searchmenu">

                                <div class="container">
                                    <div>
                                        <button class="log">Login</button>
                                        <button class="reg">Register</button>
                                    </div>
                                </div>
                            </div>
                            <ul id="mainMenu" class="nav nav-pills nav-main pull-right onepage-menu">
                                <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-62 @if(request()->path() == '/') active @endif"><a href="{{url('/')}}">Home</a></li>
                                <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-63"><a href="#about">About Us</a></li>
                                <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-64"><a href="#team">Referral</a></li>
                                <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-65"><a href="#testimonial">Forex</a></li>
                                <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-66"><a href="#blog">Contact Us</a></li>

                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>






























<style>








    .site-header .navbar-brand img {
  width: 200px!important;
}
</style>
 Header  
        <header class="site-header header-s1 is-transparent is-sticky">
                 Topbar 
                <div class="topbar">
                        <div class="container">
                                <div class="row">
                                        <div class="top-aside top-left">
                                                <ul class="top-nav">
                                                        <li><a href="{{url('forex')}}">Forex</a></li>
                                                        <li><a href="{{url('about-us')}}">About us</a></li>
                                                        <li><a href="{{url('contact-us')}}">Contact</a></li>
                                                          <li><a href="{{url('ecosystem')}}">Ecosystem</a></li>
                                              
                                                </ul>
                                        </div>
                                        <div class="top-aside top-right clearfix">
                                                <ul class="top-contact clearfix">
                                                        <li class="t-email t-email1">
                                                                <em class="fa fa-envelope-o" aria-hidden="true"></em>
                                                                <span><a href="mailto:{{$settings['site_email']}}">{{$settings['site_email']}}</a></span>
                                                        </li>
                                                        <li class="t-phone t-phone1">
                                                                <em class="fa fa-phone" aria-hidden="true"></em>
                                                                <span>+19175146371 or +447418349729</span>
                                                        </li>
                                                </ul>
                                        </div>
                                </div>
                        </div>
                </div>
                 #end Topbar 
                 Navbar 
                <div class="navbar navbar-primary">
                        <div class="container">
                                 Logo 
                                <a class="navbar-brand" href="">
                                        <img class="logo logo-dark" alt="logo" src="{{asset($settings['logo']) }}"  srcset="{{asset($settings['logo']) }} 2x">
                                        <img class="logo logo-light" alt="logo" src="{{asset($settings['logo']) }}" srcset="{{asset($settings['logo']) }} 2x">
                                </a>
                                 #end Logo 
                                <div class="navbar-header">
                                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#mainnav" aria-expanded="false">
                                                <span class="sr-only">Menu</span>
                                                <span class="icon-bar"></span>
                                                <span class="icon-bar"></span>
                                                <span class="icon-bar"></span>
                                        </button>
                                         Q-Button for Mobile 
                                        <div class="quote-btn"><a class="btn" href="{{url('login')}}">Sign in</a></div>
                                </div>
                                 MainNav 
                                <nav class="navbar-collapse collapse" id="mainnav">
                                        <ul class="nav navbar-nav">
                                                <li class="@if(request()->path() == '/') active @endif"><a href="{{url('/')}}">Home</a></li>
                                                <li class="@if(request()->path() == 'about-us') active @endif"><a href="{{url('about-us')}}">About us</a></li>
                                                
                                                <li class="@if(request()->path() == 'plans') active @endif"><a href="{{url('plans')}}">Plans</a></li>
                                                <li class="@if(request()->path() == 'education-pack') active @endif"><a href="{{url('education-pack')}}">Education Packs</a></li>
                                                <li class="@if(request()->path() == 'forex') active @endif"><a href="{{url('forex')}}">Forex</a></li>
                                                <li class="@if(request()->path() == 'referral') active @endif"><a href="{{url('referral')}}">Referral</a></li>
                                                <li class="@if(request()->path() == 'login') active @endif"><a href="{{url('login')}}">Login</a></li>
                                                <li id="google_translate_element"></li>
                                        </ul>
                                </nav>     
                                 #end MainNav 
                        </div>
                </div>
                 #end Navbar 
                 @yield('sub')
        </header>
         End Header -->

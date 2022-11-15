<!--<style>
    .show {
        background: #701f2f  !important;
    }
    .dropdown-item {
        color: #fff  !important;
    }
    .dropdown-item:hover {
        background: #701f2f  !important;
    }
</style>-->

<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="{{url('/')}}" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{asset($settings['logo']) }}" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{asset($settings['logo']) }}" alt="" height="17">
                    </span>
                </a>

                <a href="{{url('/')}}" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{asset($settings['logo']) }}" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{asset($settings['logo']) }}" alt="" height="19">
                    </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm font-size-10 header-item waves-effect" id="vertical-menu-btn">
                <i class="fa fa-fw fa-bars"></i>
            </button>

        </div>

        <div class="d-flex">



            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item waves-effect">
                    <span id="google_translate_element" class=""></span>
                </button>

            </div>


            <div class="dropdown d-none d-lg-inline-block ms-1">
                <button type="button" class="btn header-item noti-icon waves-effect" data-bs-toggle="fullscreen">
                    <i class="bx bx-fullscreen"></i>
                </button>
            </div>


            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle header-profile-user" src="@if(empty(Auth::user()->photo)){{asset('user/img/avatar-default.png')}} @else {{url(Auth::user()->photo)}} @endif"
                         alt="Header Avatar">
                    <span class="d-none d-xl-inline-block ms-1" key="t-henry">{{ucfirst(Auth::user()->last_name)}} {{ucfirst(Auth::user()->first_name)}}</span>
                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <!-- item-->
                    <a class="dropdown-item" href="{{url('profile/personal')}}"><i class="bx bx-user font-size-16 align-middle me-1"></i> <span key="t-profile">Profile</span></a>
                    <a class="dropdown-item" href="{{url('withdraw')}}"><i class="fa fa-money font-size-16 align-middle me-1"></i> <span key="t-my-wallet">Withdraw Funds</span></a>
                    <div class="dropdown-divider"></div>
                    <a onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();"class="dropdown-item text-danger" href="#"><i class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i> <span key="t-logout">Logout</span></a>
                </div>
            </div>



        </div>
    </div>
</header>




<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li>
                    <a href="{{url('office')}}" class="waves-effect">
                        <i class="bx bx-home-circle"></i>
                        <span key="t-chat">Dashboard</span>
                    </a>
                </li>
                
                 <li>
                    <a href="{{url('profile/personal')}}" class="waves-effect">
                        <i class="fa fa-user"></i>
                        <span key="t-chat">Profile</span>
                    </a>
                </li>
                  <li>
                    <a href="{{url('withdraw')}}" class="waves-effect">
                        <i class="fa fa-money"></i>
                        <span key="t-chat">Withdraw Funds</span>
                    </a>
                </li>
<!--                   <li>
                    <a href="{{url('account/deposit')}}" class="waves-effect">
                        <i class="fa fa-database"></i>
                        <span key="t-chat">Fund Deposit</span>
                    </a>
                </li>-->
                <li>
                    <a href="{{url('deposits')}}" class="waves-effect">
                        <i class="fa fa-money"></i>
                        <span key="t-chat">New Investment</span>
                    </a>
                </li>
                  <li>
                    <a href="{{url('account/education-pack')}}" class="waves-effect">
                        <i class="fa fa-pie-chart"></i>
                        <span key="t-chat">Buy Trading Signal</span>
                    </a>
                </li>
                  
                <li>
                    <a href="{{url('referrals')}}" class="waves-effect">
                        <i class="fa fa-link"></i>
                        <span key="t-chat">Referrals/Affiliate link</span>
                    </a>
                </li>
              
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-compress-alt"></i>
                        <span key="t-layouts">Transactions</span>
                    </a>

                    <ul class="sub-menu" aria-expanded="true">
                        <li><a href="{{url('transactions')}}" key="t-light-sidebar">All</a></li>
<!--                          <li><a href="{{url('fund_deposit_history')}}" key="t-compact-sidebar">Fund Deposit History</a></li>-->
                        <li><a href="{{url('deposit_history')}}" key="t-compact-sidebar">Investment History</a></li>
                        <li><a href="{{url('withdraw_history')}}" key="t-icon-sidebar">Withdraw History</a></li>
                        <li><a href="{{url('earnings')}}" key="t-icon-sidebar">Earnings History</a></li>
                        <li><a href="{{url('account/education-license-history')}}" key="t-boxed-width">Trading Signal  History</a></li>
                    </ul>
                </li>

                <li>
                    <a href="#"onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();" class="waves-effect">
                        <i class="bx bx-power-off"></i>
                        <span key="">Logout</span>
                    </a>
                </li>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->

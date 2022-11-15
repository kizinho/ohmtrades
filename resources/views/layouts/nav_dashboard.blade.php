

<!-- inner header wrapper end -->
<div class="l-sidebar">
    <div class="l-sidebar__content">
        <nav class="c-menu js-menu" id="mynavi">

            @can('isAdmin')
            <ul class="u-list crm_drop_second_ul">
                <li class="crm_navi_icon">
                    <div class="c-menu__item__inner"><a href="{{url('office')}}"><i class="fa fa-dashboard"></i></a>
                    </div>
                </li>
                <li class="c-menu__item crm_navi_icon_cont">
                    <a href="{{url('office')}}">
                        <div class="c-menu-item__title">Dashoard</div>
                    </a>
                </li>
            </ul>  


            <ul class="u-list crm_drop_second_ul">
                <li class="crm_navi_icon">
                    <div class="c-menu__item__inner"><a href="#"><i class="fa fa-cog"></i></a>
                        <ul class="crm_hover_menu">

                            <li><a href="{{url('settings')}}"> <i class="fa fa-circle"></i> Basic Settings</a></li>
                            <li><a href="{{url('plan-setting')}}"> <i class="fa fa-circle"></i> Plans Setting</a></li>
                            <li><a href="{{url('coin-setting')}}"> <i class="fa fa-circle"></i> Coins Setting</a></li>
                            <li><a href="{{url('compound-setting')}}"> <i class="fa fa-circle"></i> Compounds Setting</a></li>
                        </ul>
                    </div>
                </li>
                <li class="c-menu__item is-active has-sub crm_navi_icon_cont">
                    <a href="#">
                        <div class="c-menu-item__title"><span>Web Settings</span><i class="no_badge">4</i>
                        </div>
                    </a>
                    <ul>

                        <li><a href="{{url('settings')}}"> <i class="fa fa-circle"></i> Basic Settings</a></li>
                        <li><a href="{{url('plan-setting')}}"> <i class="fa fa-circle"></i> Plans Setting</a></li>
                        <li><a href="{{url('coin-setting')}}"> <i class="fa fa-circle"></i> Wallet Address Setting</a></li>
                        <li><a href="{{url('compound-setting')}}"> <i class="fa fa-circle"></i> Compounds Setting</a></li>

                    </ul>
                </li>
            </ul>

            <ul class="u-list crm_drop_second_ul">
                <li class="crm_navi_icon">
                    <div class="c-menu__item__inner"><a href="#"><i class="fa fa-globe"></i></a>
                        <ul class="crm_hover_menu">


                            <li><a href="{{url('users')}}"> <i class="fa fa-circle"></i> Manage Users</a></li>
                            <li><a href="{{url('manage-deposit')}}"> <i class="fa fa-circle"></i> Manage Investments</a></li>
                            <li><a href="{{url('manage-withdraw')}}"> <i class="fa fa-circle"></i> Manage Withdraws</a></li>
<!--                            <li><a href="{{url('manage-fund-deposit')}}"> <i class="fa fa-circle"></i> Manage Fund Deposit</a></li>-->
                            <li><a href="{{url('manage-transaction')}}"> <i class="fa fa-circle"></i> Manage Transactions</a></li>
                        </ul>
                    </div>
                </li>
                <li class="c-menu__item is-active has-sub crm_navi_icon_cont">
                    <a href="#">
                        <div class="c-menu-item__title"><span>Activities</span><i class="no_badge">5</i>
                        </div>
                    </a>
                    <ul>
                        <li><a href="{{url('users')}}"> <i class="fa fa-circle"></i> Manage Users</a></li>
                        <li><a href="{{url('manage-deposit')}}"> <i class="fa fa-circle"></i> Manage Investments</a></li>
                        <li><a href="{{url('manage-withdraw')}}"> <i class="fa fa-circle"></i> Manage Withdraws</a></li>
<!--                        <li><a href="{{url('manage-fund-deposit')}}"> <i class="fa fa-circle"></i> Manage Fund Deposit</a></li>-->
                        <li><a href="{{url('manage-transaction')}}"> <i class="fa fa-circle"></i> Manage Transactions</a></li>

                    </ul>
                </li>
            </ul>
            <ul class="u-list crm_drop_second_ul">
                <li class="crm_navi_icon">
                    <div class="c-menu__item__inner"><a href="#"><i class="fa fa-ellipsis-v"></i></a>
                        <ul class="crm_hover_menu">

                            <li><a href="{{url('eduction-plan-setting')}}"> <i class="fa fa-circle"></i> Plans Setting</a></li>
                            <li><a href="{{url('send-signals')}}"> <i class="fa fa-circle"></i> Send Signals</a></li>
                            <li><a href="{{url('manage-education-user-sub')}}"> <i class="fa fa-circle"></i> User Subscriptions</a></li>
                        </ul>
                    </div>
                </li>
                <li class="c-menu__item is-active has-sub crm_navi_icon_cont">
                    <a href="#">
                        <div class="c-menu-item__title"><span>Education Pack</span>
                        </div>
                    </a>
                    <ul>

                        <li><a href="{{url('eduction-plan-setting')}}"> <i class="fa fa-circle"></i> Plans Setting</a></li>
                        <li><a href="{{url('send-signals')}}"> <i class="fa fa-circle"></i> Send Signals</a></li>
                        <li><a href="{{url('manage-education-user-sub')}}"> <i class="fa fa-circle"></i> User Subscriptions</a></li>

                    </ul>
                </li>
            </ul>


            <ul class="u-list crm_drop_second_ul">
                <li class="crm_navi_icon">
                    <div class="c-menu__item__inner"><a href="{{url('mailing')}}"><i class="fa fa-envelope"></i></a>
                    </div>
                </li>
                <li class="c-menu__item crm_navi_icon_cont">
                    <a href="{{url('mailing')}}">
                        <div class="c-menu-item__title">Mailing System</div>
                    </a>
                </li>
            </ul>  


            @endcan
            <ul class="u-list crm_drop_second_ul">
                <li class="crm_navi_icon">
                    <div class="c-menu__item__inner"><a href="#"><i class="fa fa-sort"></i></a>
                    </div>
                </li>
                <li class="c-menu__item crm_navi_icon_cont">
                    <a href="#" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                        <div class="c-menu-item__title">Logout</div>
                    </a>
                </li>
            </ul>  
        </nav>
    </div>
</div>


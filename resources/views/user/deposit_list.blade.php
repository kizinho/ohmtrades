@section('title')
<title>{{ucfirst($settings['site_name'])}} &mdash;Deposit List</title>
<meta  name="description" content="Confirm fund">
<meta itemprop="keywords" name="keywords" content="{{ucfirst($settings['site_name'])}} - Deposit List"/>
<meta name="author" content="{{ucfirst($settings['site_name'])}}" />

@endsection
@extends('layouts.dashboard')
@section('content')


<div class="page_title_section dashboard_title">

    <div class="page_header">
        <div class="container">
            <div class="row">

                <div class="col-xl-9 col-lg-7 col-md-7 col-12 col-sm-7">

                    <h1>Deposit Lists </h1>
                </div>
                <div class="col-xl-3 col-lg-5 col-md-5 col-12 col-sm-5">
                    <div class="sub_title_section">
                        <ul class="sub_title">
                            <li> <a href="{{url('/')}}"> Home </a>&nbsp; / &nbsp; </li>
                            <li>Deposit Lists</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('layouts.nav_dashboard')
<!-- Main section Start -->
<div class="l-main">         
    @include('layouts.account')

    <!--  deposit wrapper start -->
    <div class="deposit_list_wrapper float_left">

        <div class="row">

            <div class="col-md-12 col-lg-12 col-sm-12 col-12">
                <div class="sv_heading_wraper">

                    <h3>deposit lists</h3>

                </div>
            </div>
        </div>
        <div class="crm_customer_table_main_wrapper deposit_tables float_left">
            <div class="row">
                <div class="col-md-12 col-lg-12 col-sm-12 col-12">
                    <div class="deposit_tab_wrapper">
                        <ul class="nav nav-tabs">
                            <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#home"> active deposit</a>
                            </li>
                            <li class="nav-item"> <a class="nav-link " data-toggle="tab" href="#menu1">Completed deposit</a>
                            </li>
                            <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#menu2"> pending deposit</a>
                            </li>
                            </li>

                        </ul>
                    </div>
                </div>
                <div class="col-md-12 col-lg-12 col-sm-12 col-12">
                    <div class="tab-content">
                        <div id="home" class="tab-pane active">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-12">
                                    <div class="table-responsive">
                                        <table class="myTable table datatables cs-table crm_customer_table_inner_Wrapper">
                                            <thead>
                                                <tr>
                                                    <th class="width_table1">plan name</th>
                                                    <th class="width_table1">deposit amount</th>
                                                    <th class="width_table1">gateway</th>
                                                    <th class="width_table1">status</th>
                                                    <th class="width_table1">investment date</th>
                                                    <th class="width_table1">End date</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($active_deposits as $deposit)
                                                <tr class="background_white">

                                                    <td>
                                                        <div class="media cs-media">

                                                            <div class="media-body">
                                                                <h5>{{$deposit->plan->name}}</h5>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="pretty p-svg p-curve">${{number_format($deposit->amount,2)}}</div>
                                                    </td>
                                                    <td>
                                                        <div class="pretty p-svg p-curve">{{$deposit->usercoin->coin->name}}</div>
                                                    </td>
                                                    <td>
                                                        <div class="pretty p-svg p-curve deposit_active">active</div>
                                                    </td>
                                                    <td>
                                                        <div class="pretty p-svg p-curve">{{ date('F d, Y', strtotime($deposit->created_at)) }} {{ date('g:i A', strtotime($deposit->created_at)) }}</div>
                                                    </td>

                                                    <td>
                                                        <div class="pretty p-svg p-curve"> {{$deposit->due_pay->diffForHumans()}}</div>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="menu1" class="tab-pane fade">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-12">
                                    <div class="table-responsive">
                                        <table class="myTable table datatables cs-table crm_customer_table_inner_Wrapper">
                                            <thead>
                                                <tr>
                                                    <th class="width_table1">plan name</th>
                                                    <th class="width_table1">deposit amount</th>
                                                    <th class="width_table1">gateway</th>
                                                    <th class="width_table1">status</th>
                                                    <th class="width_table1">investment date</th>
                                                    <th class="width_table1">End date</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($completed_deposits as $deposit)
                                                <tr class="background_white">

                                                    <td>
                                                        <div class="media cs-media">

                                                            <div class="media-body">
                                                                <h5>{{$deposit->plan->name}}</h5>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="pretty p-svg p-curve">${{number_format($deposit->amount,2)}}</div>
                                                    </td>
                                                    <td>
                                                        <div class="pretty p-svg p-curve">{{$deposit->usercoin->coin->name}}</div>
                                                    </td>
                                                    <td>
                                                        <div class="pretty p-svg p-curve deposit_matured">Matured</div>
                                                    </td>
                                                    <td>
                                                        <div class="pretty p-svg p-curve">{{ date('F d, Y', strtotime($deposit->created_at)) }} {{ date('g:i A', strtotime($deposit->created_at)) }}</div>
                                                    </td>

                                                    <td>
                                                        <div class="pretty p-svg p-curve"> {{$deposit->due_pay->diffForHumans()}}</div>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="menu2" class="tab-pane fade">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-12">
                                    <div class="table-responsive">
                                        <table class="myTable table datatables cs-table crm_customer_table_inner_Wrapper">
                                            <thead>
                                                <tr>
                                                    <th class="width_table1">plan name</th>
                                                    <th class="width_table1">deposit amount</th>
                                                    <th class="width_table1">gateway</th>
                                                    <th class="width_table1">status</th>
                                                    <th class="width_table1">investment date</th>
                                                    <th class="width_table1">End date</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($pending_deposits as $deposit)
                                                <tr class="background_white">

                                                    <td>
                                                        <div class="media cs-media">

                                                            <div class="media-body">
                                                                <h5>{{$deposit->plan->name}}</h5>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="pretty p-svg p-curve">${{number_format($deposit->amount,2)}}</div>
                                                    </td>
                                                    <td>
                                                        <div class="pretty p-svg p-curve">{{$deposit->usercoin->coin->name}}</div>
                                                    </td>
                                                    <td>
                                                        <div class="pretty p-svg p-curve deposit_pending">Pending</div>
                                                    </td>
                                                    <td>
                                                        <div class="pretty p-svg p-curve">{{ date('F d, Y', strtotime($deposit->created_at)) }} {{ date('g:i A', strtotime($deposit->created_at)) }}</div>
                                                    </td>

                                                    <td>
                                                        <div class="pretty p-svg p-curve"> Nill</div>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--  deposit wrapper end -->
    @endsection


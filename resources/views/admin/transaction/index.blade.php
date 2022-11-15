@section('title')
<title>{{ucfirst($settings['site_name'])}} &mdash;All Transactions</title>
<meta  name="description" content="Confirm fund">
<meta itemprop="keywords" name="keywords" content="{{ucfirst($settings['site_name'])}} - All Transactions"/>
<meta name="author" content="{{ucfirst($settings['site_name'])}}" />

@endsection
@extends('layouts.dashboard')
@section('content')


<div class="page_title_section dashboard_title">

    <div class="page_header">
        <div class="container">
            <div class="row">

                <div class="col-xl-9 col-lg-7 col-md-7 col-12 col-sm-7">

                    <h1>All Transactions </h1>
                </div>
                <div class="col-xl-3 col-lg-5 col-md-5 col-12 col-sm-5">
                    <div class="sub_title_section">
                        <ul class="sub_title">
                            <li> <a href="{{url('/')}}"> Home </a>&nbsp; / &nbsp; </li>
                            <li>All Transactions</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('layouts.nav_dashboard')
<!-- Main section Start -->
<div class="l-main mb-5 mt-5">         
    <div class="clearfix"></div>
    <br/>           
  
     <!--  transactions wrapper start -->
            <div class="last_transaction_wrapper float_left">

                <div class="row">

                    <div class="col-md-12 col-lg-12 col-sm-12 col-12">
                        <div class="sv_heading_wraper">

                            <h3> transaction history</h3>

                        </div>
                    </div>
                    <div class="crm_customer_table_main_wrapper float_left">
                        <div class="crm_ct_search_wrapper">
                            <div class="crm_ct_search_bottom_cont_Wrapper">
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="ttr table datatables cs-table crm_customer_table_inner_Wrapper">
                                <thead>
                               <tr>
                                <th class="width_table1">transaction ID</th>
                                <th class="width_table1">amount (USD)</th>
                                <th class="width_table1">description</th>
                                <th class="width_table1">User</th>
                                <th class="width_table1">Status</th>
                                <th class="width_table1">date</th>

                            </tr>
                        </thead>
                        <tbody>
                            @forelse($transactions as $hi)
                            <tr class="background_white">

                                <td>
                                    <div class="media cs-media">

                                        <div class="media-body">
                                            <h5>{{$hi->transaction_id}}</h5>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="pretty p-svg p-curve">USD{{number_format($hi->amount)}}</div>
                                </td>
                                <td>
                                    <div class="pretty p-svg p-curve">{{$hi->description}}</div>
                                </td>
                                <td>
                                    <div class="pretty p-svg p-curve">{{$hi->user->first_name}} {{$hi->user->last_name}}</div>
                                </td>
                                <td>
                                    @if($hi->status == false)
                                     <div class="pretty p-svg p-curve badge deposit_pending">Pending</div>
                                    @else
                                    <div class="pretty p-svg p-curve badge deposit_active">Confirmed</div>
                                    @endif
                                </td>
                                <td class="flag">
                                    <div class="pretty p-svg p-curve">{{ date('F d, Y', strtotime($hi->created_at)) }} {{ date('g:i A', strtotime($hi->created_at)) }}</div>
                                </td>

                            </tr>
                            @empty
                            TRANSACTIONS
                            @endforelse
                        </tbody>
                    </table>


                        </div>
                    </div>
                </div>
            </div>
            <!--  transactions wrapper end -->
    @endsection


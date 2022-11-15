@section('title')
<title>{{ucfirst($settings['site_name'])}} &mdash; Manage Withdraw</title>
<meta  name="description" content="Manage Withdraw">
<meta itemprop="keywords" name="keywords" content="{{ucfirst($settings['site_name'])}} - Manage Withdraw"/>
<meta name="author" content="{{ucfirst($settings['site_name'])}}" />

@endsection
@extends('layouts.dashboard')
@section('content')

<div class="page_title_section dashboard_title">

    <div class="page_header">
        <div class="container">
            <div class="row">

                <div class="col-xl-9 col-lg-7 col-md-7 col-12 col-sm-7">

                    <h1>Manage Payouts
                    </h1>
                </div>
                <div class="col-xl-3 col-lg-5 col-md-5 col-12 col-sm-5">
                    <div class="sub_title_section">
                        <ul class="sub_title">
                            <li> <a href="{{url('/')}}"> Home </a>&nbsp; / &nbsp; </li>
                            <li>Manage Payouts
                            </li>
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
  
    <!--  deposit wrapper start -->
    <div class="deposit_list_wrapper float_left">

        <div class="row">

            <div class="col-md-12 col-lg-12 col-sm-12 col-12">
                <div class="sv_heading_wraper">

                    <h3>Manage Payouts
                    </h3>

                </div>
            </div>
        </div>

        <form  class="form-group mb-5"  method=get name=opts action="{{route('manage-withdraw')}}" enctype="multipart/form-data">
            @csrf
            <td>
                <select name=type class="inpts form-control" onchange="document.opts.submit();">
                    <option value="" @if(empty($type))selected @endif>All Withdraw</option>
                    <option value="completed" @if($type == 'completed')selected @endif>Completed Withdraw</option>
                    <option value="pending" @if($type == 'pending')selected @endif>Pending Withdraw</option>

                </select>
        </form>



        <div class="clearfix"></div>
        <br/>


        <div class="crm_customer_table_main_wrapper float_left">
            <div class="crm_ct_search_wrapper">
                <div class="crm_ct_search_bottom_cont_Wrapper">
                </div>
            </div>
            <div class="table-responsive">
                <table class="withdraw table datatables cs-table crm_customer_table_inner_Wrapper">
                    <thead>
                        <tr>
                            <th class="width_table1">txt ID</th>
                             <th class="width_table1">User</th>
                            <th class="width_table1">amount (USD)</th>
                            <th class="width_table1">Amount to Pay</th>
                            <th class="width_table1">Charge</th>
                            <th class="width_table1">payment mode</th>
                            <th class="width_table1">Wallet Address</th>
                            <th class="width_table1">Status</th>
                            <th class="width_table1">Date</th>
                            <th class="width_table1">Options</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($withdraws as $withdraw)
                        <tr class="background_white">
                         
                            <td>
                                <div class="media cs-media">

                                    <div class="media-body">
                                        <h5>{{$withdraw->transaction_id}}</h5>
                                    </div>
                                </div>
                            </td>
                               <td>{{$withdraw->user->first_name}} {{$withdraw->user->last_name}}</td>
                            <td>
                                <div class="pretty p-svg p-curve">USD{{number_format($withdraw->amount,2)}}</div>
                            </td>
                            <td>
                                <div class="pretty p-svg p-curve">USD{{number_format($withdraw->amount - $withdraw->withdraw_charge,2)}}</div>
                            </td>
                            <td>
                                <div class="pretty p-svg p-curve">USD{{number_format($withdraw->withdraw_charge,2)}}</div>
                            </td>
                            <td>
                                <div class="pretty p-svg p-curve">{{$withdraw->address_name}}</div>
                            </td>
                            <td>
                                <div class="" style="">{{$withdraw->address}}</div>
                            </td>
                            
                            <td>
                                @if($withdraw->status == false)
                                <div class="pretty p-svg p-curve badge deposit_pending">Pending</div>
                                @else
                                <div class="pretty p-svg p-curve badge deposit_active">Paid</div>
                                @endif
                            </td>
                            <td class="flag">
                                <div class="pretty p-svg p-curve">{{ date('F d, Y', strtotime($withdraw->created_at)) }} {{ date('g:i A', strtotime($withdraw->created_at)) }}</div>
                            </td>
                               <td>
                    <nav class="navbar navbar-expand">
                        <ul class="navbar-nav">
                            <!-- Dropdown -->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown"> <i class="fa fa-ellipsis-v"></i>
                                </a>
                                <div class="dropdown-menu"> 


                                    <form  class="deleted" style="display: inline-block!important"  role="form" method="POST"
                                           action="{{route('delete-withdraw',['id'=>$withdraw->id])}}" >
                                        @csrf   
                                        <button type="submit"class="dropdown-item text-danger">
                                            <i class="fa fa-trash"></i> Delete
                                        </button>
                                    </form>
                                    @if($withdraw->confirm == true && $withdraw->status == false)
                                    <form  class="deleted" style="display: inline-block!important"  role="form" method="POST"
                                           action="{{route('confirm-withdraw',['id'=>$withdraw->id])}}" >
                                        @csrf   
                                        <button type="submit"class="dropdown-item text-success">
                                            <i class="fa fa-check"></i> Confirm Withdraw
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </li>
                        </ul>
                    </nav>
                                      </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>


            </div>
        </div>





    </div>
    <!-- /.card -->


    @section('script')



    @endsection

    @endsection

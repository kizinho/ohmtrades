@section('title')
<title>{{ucfirst($settings['site_name'])}} &mdash; {{ucfirst($user->username)}} Edit Account</title>
<meta  name="description" content="{{ucfirst($user->username)}} Edit Account">
<meta itemprop="keywords" name="keywords" content="{{ucfirst($settings['site_name'])}} - {{ucfirst($user->username)}} Edit Account"/>
<meta name="author" content="{{ucfirst($settings['site_name'])}} {{ucfirst($user->username)}}" />

@endsection
@extends('layouts.dashboard')
@section('content')

<div class="page_title_section dashboard_title">

    <div class="page_header">
        <div class="container">
            <div class="row">

                <div class="col-xl-9 col-lg-7 col-md-7 col-12 col-sm-7">

                    <h1>View Profile </h1>
                </div>
                <div class="col-xl-3 col-lg-5 col-md-5 col-12 col-sm-5">
                    <div class="sub_title_section">
                        <ul class="sub_title">
                            <li> <a href="{{url('/')}}"> Home </a>&nbsp; / &nbsp; </li>
                            <li>Profile</li>
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
    @include('layouts.account')

    <div class="view_profile_wrapper_top float_left">

        <div class="row">

            <div class="col-md-12 col-lg-12 col-sm-12 col-12">
                <div class="sv_heading_wraper">

                    <h3>profile</h3>

                </div>

            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="">
                            <!-- Main content -->
                            <section class="content">
                                <div class="row">
                                    <div class="col-xl-4 col-lg-4">

                                        <!-- Profile Image -->
                                        <div class="box card card-body">
                                            <div class="box-body box-profile">
                                                <br>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="bg-success p-3 mt-3 text-white">
                                                            <div class="">
                                                                <dl class="">

                                                                    @foreach($user->coin as $ucoin)
                                                                    <dt>{{$ucoin->coin->name}}</dt>
                                                                    @php
                                                                    $main = 0;
                                                                    $ref = 0;
                                                                    $profit = 0;
                                                                    @endphp
                                                                    @foreach($ucoin->userWithdraw as $money)

                                                                    @if($money->type == "Main Balance")
                                                                    @php
                                                                    $main += $money->amount;
                                                                    @endphp
                                                                    @endif
                                                                    @if($money->type == "Referral Bonus")
                                                                    @php
                                                                    $ref += $money->amount;
                                                                    @endphp

                                                                    @endif
                                                                    @if($money->type == "Profit")
                                                                    @php
                                                                    $profit += $money->amount;
                                                                    @endphp

                                                                    @endif


                                                                    @endforeach
                                                                    <dd>
                                                                        main :&nbsp;&nbsp;${{number_format($main,2)}}
                                                                        &nbsp;&nbsp;  Profit:&nbsp;&nbsp;${{number_format($profit,2)}}
                                                                        &nbsp;&nbsp;  Ref:&nbsp;&nbsp;${{number_format($ref,2)}}
                                                                    </dd>
                                                                    <hr>
                                                                    @endforeach

                                                                </dl>
                                                            </div>

                                                            Referral Name : @if(empty($name_ref)) Nill @else {{$name_ref->user->first_name}} {{$name_ref->user->last_name}} @endif
                                                        </div>
                                                    </div>

                                                    <h5 class="title w-p100 mt-4 mb-0 p-4 text-danger">Last Transactions</h5>
                                                    <div class="col-12">
                                                        <div class="media-list media-list-hover w-p100 mt-0">
                                                            @foreach($transactions as $transaction)
                                                            <h5 class="media media-single py-3 px-0 w-p100 justify-content-between">
                                                                <p>
                                                                    <i class=" text-success pr-3 font-size-12 text-white"></i>{{$transaction->type}}					  
                                                                </p>
                                                                <p class="text-right pull-right">@if($transaction->status == false)<span class="badge badge-sm badge-danger mb-2 text-white">pending</span> @else <span class="badge badge-sm badge-success mb-5 text-white">success</span>@endif<br>${{number_format($transaction->amount,2)}}</p>
                                                            </h5>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /.box-body -->
                                        </div>
                                        <!-- /.box -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-xl-8 col-lg-8">
                                        <div class="box box-solid box-inverse box-dark mb-4">
                                            <div class="box-header with-border mb-4">
                                                <h3 class="box-title">Personal details</h3>
                                            </div>
                                            <!-- /.box-header -->
                                            <div class="box-body">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <form  class="form-group"  method="POST" action="{{route('edit_account')}}" enctype="multipart/form-data">
                                                            @csrf
                                                            <input value="{{$user->id}}" type="hidden" name="id">
                                                            <div class="form-group row">
                                                                <label class="col-sm-2 col-form-label active">First Name</label>
                                                                <div class="col-sm-10">
                                                                    <input value='{{$user->first_name}}' type="text" name="first_name"  class="form-control" readonly="">

                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label class="col-sm-2 col-form-label active">Last Name</label>
                                                                <div class="col-sm-10">
                                                                    <input id="first_name" name=last_name value='{{$user->last_name}}' type="text"  class="form-control">

                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label class="col-sm-2 col-form-label active">Phone Number</label>
                                                                <div class="col-sm-10">
                                                                    <input name=phone_no value='{{$user->phone_no}}' type="tel"  class="form-control">

                                                                </div>
                                                            </div>


                                                            <div class="form-group row">
                                                                <label class="col-sm-2 col-form-label active">Email Adress</label>
                                                                <div class="col-sm-10">
                                                                    <input id="email" name=email value='{{$user->email}}' type="email" class="form-control">
                                                                </div>
                                                            </div>
                                                           
                                                            @can('isAdmin')
                                                            <div class="form-group row">
                                                                <label class="col-sm-2 col-form-label active">User Status</label>
                                                                <div class="col-sm-10">
                                                                    <select  name="code" class="form-control">
                                                                        <option value="" selected disabled>choose status</option>
                                                                        <option value="0" {{$user->code == 0 ? 'selected' : '' }}> Not Verified </option>
                                                                        <option value="1" {{$user->code == 1 ? 'selected' : '' }}> Verified</option>

                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-sm-2 col-form-label active">User Role</label>
                                                                <div class="col-sm-10">
                                                                    <select  name="type" class="form-control">
                                                                        <option value="" selected disabled>User Type</option>

                                                                        <option value="admin" {{$user->type == 'admin' ? 'selected' : '' }}> Admin </option>
                                                                        <option value="user" {{$user->type == 'user' ? 'selected' : '' }}> User</option>


                                                                    </select>
                                                                </div>
                                                            </div>
                                                            @endCan
                                                            <div class="form-group row">
                                                                <label class="col-sm-2 col-form-label"></label>
                                                                <div class="col-sm-10">
                                                                    <button type="submit" class="btn btn-success text-white">Change</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div><!--
                                                    <!-- /.col -->
                                                </div>
                                                <!-- /.row -->
                                            </div>
                                            <!-- /.box-body -->
                                        </div>
                                        <!-- /.box -->
                                        <div class="box box-solid box-inverse box-dark mt-4">
                                            <div class="box-header with-border mb-4">
                                                <h3 class="box-title">Password</h3>
                                            </div>
                                            <!-- /.box-header -->
                                            <div class="box-body">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <form  class="form-group"  method="POST" action="{{route('edit_account')}}" enctype="multipart/form-data">
                                                            @csrf
                                                            <input value="{{$user->id}}" type="hidden" name="id">
                                                            <div class="form-group row">
                                                                <label class="col-sm-2 col-form-label">New Password</label>
                                                                <div class="col-sm-10">
                                                                    <input class="form-control" type="password" name="password" placeholder="Enter password">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-sm-2 col-form-label">Confirm New Password</label>
                                                                <div class="col-sm-10">
                                                                    <input class="form-control" type="password" id="password-confirm" name="confirm_password" placeholder="Confirm Password">
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label class="col-sm-2 col-form-label"></label>
                                                                <div class="col-sm-10">
                                                                    <button type="submit" class="btn btn-success text-white">Change</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <!-- /.col -->
                                                </div>
                                                <!-- /.row -->
                                            </div>
                                            <!-- /.box-body -->
                                        </div>
                                        <!-- /.box -->
<!--                                        <div class="box box-solid box-inverse box-dark mt-4 mb-5">
                                            <div class="box-header with-border mb-4">
                                                <h3 class="box-title">{{$user->first_name}} {{$user->last_name}}  Wallet</h3>
                                            </div>
                                             /.box-header 
                                            <div class="box-body">
                                                <div class="row">
                                                    <div class="col-12">
                                                        @foreach($user->coin as $coins)
                                                        <div class="form-group row">
                                                            <label class="col-sm-2 col-form-label active">{{$coins->coin->name}}</label>
                                                            <div class="col-sm-10">
                                                                <input class="form-control" name="{{$coins->coin->slug}}" value="{{$coins->address}}" type="text" placeholder="Wallet address">
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                        <div class="form-group row">
                                                            <label class="col-sm-2 col-form-label"></label>
                                                            <div class="col-sm-10">
                                                                <button type="submit" class="btn btn-success text-white">Change</button>
                                                                <button type="button" class=" btn btn-primary text-white btn-default" data-toggle="modal" data-target="#modal-default">
                                                                    Add New Wallet
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                        <br/>


                                                    </div>
                                                     /.col 
                                                </div>
                                                 /.row 
                                            </div>
                                             /.box-body 
                                        </div>-->

                                        <div class="modal fade" id="modal-default" >
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">

                                                    <div class="modal-header ">
                                                        <h4 class="modal-title">Add Wallet</h4>

                                                        <button type="button" class="close btn btn-theme  btn-primary" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>

                                                    <div class="modal-body">
                                                        <form class="" method="Post" action="{{url('add-wallet')}}">
                                                            @csrf    
                                                            <input value="{{$user->id}}" type="hidden" name="id">
                                                            <div class="form-group"> 
                                                                <select name="coin" class="form-control select2 w-p100 select2-hidden-accessible" tabindex="-1" aria-hidden="true">
                                                                    <option value="" selected disabled>Choose Option</option>
                                                                    @foreach($coinsEnable as $coin_c)

                                                                    <option value="{{$coin_c->id}}">{{$coin_c->name}}
                                                                        (@if(empty($coin_c->usercoinUser)) Avaliable @else Enabled @endif)
                                                                    </option>

                                                                    @endforeach

                                                                </select>






                                                            </div>
                                                            <div class="clearfix"></div>
                                                            <br/>
                                                            <div class="form-group"> 
                                                                <input name="address" placeholder="Enter wallet address" class="form-control" style="color:#000!important" placeholder="Enter Address">
                                                            </div>
                                                            <div class="modal-footer justify-content-between">
                                                                <button type="button" class="btn btn-theme btn-circle btn-primary" data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-theme btn-success">Add Wallet</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>

                                        @can('isAdmin')
<!--                                        <div class="box box-solid box-inverse box-dark mt-4 mb-5">
                                            <div class="box-header with-border mb-3">
                                                <h3 class="box-title">Manage Funds</h3>
                                            </div>
                                            <br/>
                                             /.box-header 
                                            <div class="box-body">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <form method="POST" action="{{route('fund',['user_id'=>$user->id])}}">
                                                            @csrf
                                                            <div class="form-group row">
                                                                <label class="col-sm-2 col-form-label active">Select Wallet:</label>
                                                                <div class="col-sm-10">
                                                                    <select name="coin" class="form-control select2 w-p100 select2-hidden-accessible" tabindex="-1" aria-hidden="true">
                                                                        <option value="" selected disabled>Choose Option</option>
                                                                        @foreach($user->coin as $coins)

                                                                        <option value="{{$coins->coin_id}}">{{$coins->coin->name}}</option>

                                                                        @endforeach

                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-sm-2 col-form-label active">Select Fund Type:</label>
                                                                <div class="col-sm-10">
                                                                    <select name="type" class="form-control select2 w-p100 select2-hidden-accessible" tabindex="-1" aria-hidden="true">
                                                                        <option value="" selected disabled>Choose Option</option>
                                                                        <option value="add"> Add</option>
                                                                        <option value="substract"> Substract</option>

                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-sm-2 col-form-label active">Send fund to:</label>
                                                                <div class="col-sm-10">
                                                                    <select name="type_fund" class="form-control select2 w-p100 select2-hidden-accessible" tabindex="-1" aria-hidden="true">
                                                                        <option value="" selected disabled>Choose Option</option>
                                                                        <option value="balance"> Balance</option>
                                                                        <option value="earn"> Profit</option>
                                                                        <option value="bonus"> Referral Bonus</option>

                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-sm-2 col-form-label active">Amount</label>
                                                                <div class="col-sm-10">
                                                                    <input class="form-control" type="number" name="amount" placeholder="Enter Amount">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-sm-2 col-form-label active"></label>
                                                                <div class="col-sm-10">
                                                                    <button type="submit" class="btn btn-success text-white">Submit</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                     /.col 
                                                </div>
                                                 /.row 
                                            </div>
                                             /.box-body 
                                        </div>-->

                                        @endCan

                                        <!-- /.box -->

                                    </div>
                                    <!-- /.col -->
                                </div>
                            </section>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @endsection



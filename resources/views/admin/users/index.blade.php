@section('title')
<title>{{ucfirst($settings['site_name'])}} &mdash; Manage Users</title>
<meta  name="description" content="Manage Users">
<meta itemprop="keywords" name="keywords" content="{{ucfirst($settings['site_name'])}} - Manage Users"/>
<meta name="author" content="{{ucfirst($settings['site_name'])}}" />

@endsection
@extends('layouts.dashboard')
@section('content')

<div class="page_title_section dashboard_title">

    <div class="page_header">
        <div class="container">
            <div class="row">

                <div class="col-xl-9 col-lg-7 col-md-7 col-12 col-sm-7">

                    <h1>Manage Users
                    </h1>
                </div>
                <div class="col-xl-3 col-lg-5 col-md-5 col-12 col-sm-5">
                    <div class="sub_title_section">
                        <ul class="sub_title">
                            <li> <a href="{{url('/')}}"> Home </a>&nbsp; / &nbsp; </li>
                            <li>Manage Users
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

                    <h3>Manage Users
                    </h3>

                </div>
            </div>
        </div>


        <button type="button" class="btn btn-theme btn-circle btn-success mb-4" data-toggle="modal" data-target="#modal-default">
            Add New Users
        </button>

        <div class="modal fade" id="modal-default" >
            <div class="modal-dialog modal-lg">
                <div class="modal-content">

                    <div class="modal-header ">
                        <h4 class="modal-title">Add User</h4>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <form class="" method="Post" action="{{url('add-user')}}">
                            @csrf    

                            <div class="form-group icon_form comments_form">

                                <input type="text" class="form-control require" name="first_name" value="" placeholder="First Name *" required="">

                            </div>

                            <div class="form-group icon_form comments_form">

                                <input type="text" class="form-control require" name="last_name" value="" placeholder="Last Name *" required="">

                            </div>
                           

                            <div class="form-group icon_form comments_form">

                                <input type="email" class="form-control require" name="email" value="" placeholder="Email *" required="">

                            </div>
                           
                            <div class="form-group icon_form comments_form">

                                <input type="password" class="form-control require" name="password" placeholder="Password *" required="">

                            </div>

                            <div class="form-group icon_form comments_form">

                                <input type="password" class="form-control require" name="confirm_password" placeholder="Repeat Password *" required="">

                            </div>
                           

                            <div class="form-group icon_form comments_form">
                                <select  name="type" class="form-control">
                                    <option value="" selected disabled>Select User Type</option>
                                    <option value="admin"> Admin </option>
                                    <option value="user"> User </option>

                                </select>

                            </div>





                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success btn-circle">Add</button>
                    </div>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->



        <div class="crm_customer_table_main_wrapper deposit_tables float_left">
            <div class="row">
                <div class="col-md-12 col-lg-12 col-sm-12 col-12">
                    <div class="deposit_tab_wrapper">
                        <ul class="nav nav-tabs">
                            <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#home"> All users</a>
                            </li>
                            <li class="nav-item"> <a class="nav-link " data-toggle="tab" href="#menu1">Verified Users</a>
                            </li>
                            <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#menu2"> None Verified Users</a>
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
                                        <table class="render table datatables cs-table crm_customer_table_inner_Wrapper">
                                            <thead>
                                                <tr>
                                                    <th class="width_table1">Username</th>
                                                    <th class="width_table1">Email</th>
                                                    <th class="width_table1">Type</th>
                                                    <th class="width_table1">status</th>
                                                    <th class="width_table1">Date Joined</th>
                                                    <th class="width_table1">Options</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($all_users as $user)
                                                <tr class="background_white">

                                                    <td>
                                                        <div class="media cs-media">

                                                            <div class="media-body">
                                                                <h5>{{$user->first_name}} {{$user->last_name}}</h5>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="pretty p-svg p-curve">{{$user->email}}</div>
                                                    </td>
                                                    <td>
                                                        <div class="pretty p-svg p-curve">{{$user->type}}</div>
                                                    </td>
                                                    @if($user->code == false)
                                                    <td>
                                                        <div class="pretty p-svg p-curve deposit_pending">not verified</div>
                                                    </td>
                                                    @else
                                                    <td>
                                                        <div class="pretty p-svg p-curve deposit_active">verified</div>
                                                    </td>
                                                    @endif
                                                    <td>
                                                        <div class="pretty p-svg p-curve">{{ date('F d, Y', strtotime($user->created_at)) }} {{ date('g:i A', strtotime($user->created_at)) }}</div>
                                                    </td>

                                                    <td>
                                                        <nav class="navbar navbar-expand">
                                                            <ul class="navbar-nav">
                                                                <!-- Dropdown -->
                                                                <li class="nav-item dropdown">
                                                                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown"> <i class="fa fa-ellipsis-v"></i>
                                                                    </a>
                                                                    <div class="dropdown-menu"> 

                                                                        <a href="{{ url('view-user', $user->id) }}" class="dropdown-item text-success">
                                                                            <i class="fa fa-eye"></i> view
                                                                        </a>
                                                                        <form  class="deleted" style="display: inline-block!important"  role="form" method="POST"
                                                                               action="{{route('delete-user',['id'=>$user->id])}}" >
                                                                            @csrf   
                                                                            <button type="submit"class=" dropdown-item text-danger text-primary">
                                                                                <i class="fa fa-trash"></i> delete
                                                                            </button>
                                                                        </form> 

                                                                        <a href="{{ url('user-login', $user->id) }}" class="dropdown-item">
                                                                            <i class="fa fa-sign"> </i> login
                                                                        </a>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </nav>
                                                    </td>
                                                </tr>
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
                                        <table class="render table datatables cs-table crm_customer_table_inner_Wrapper">
                                            <thead>
                                                <tr>
                                                    <th class="width_table1">Username</th>
                                                    <th class="width_table1">Email</th>
                                                    <th class="width_table1">Type</th>
                                                    <th class="width_table1">status</th>
                                                    <th class="width_table1">Date Joined</th>
                                                    <th class="width_table1">Options</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($verified_users as $user)
                                                <tr class="background_white">

                                                    <td>
                                                        <div class="media cs-media">

                                                            <div class="media-body">
                                                                <h5>{{$user->username}}</h5>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="pretty p-svg p-curve">{{$user->email}}</div>
                                                    </td>
                                                    <td>
                                                        <div class="pretty p-svg p-curve">{{$user->type}}</div>
                                                    </td>
                                                    @if($user->code == false)
                                                    <td>
                                                        <div class="pretty p-svg p-curve deposit_pending">not verified</div>
                                                    </td>
                                                    @else
                                                    <td>
                                                        <div class="pretty p-svg p-curve deposit_active">verified</div>
                                                    </td>
                                                    @endif
                                                    <td>
                                                        <div class="pretty p-svg p-curve">{{ date('F d, Y', strtotime($user->created_at)) }} {{ date('g:i A', strtotime($user->created_at)) }}</div>
                                                    </td>

                                                    <td>
                                                        <nav class="navbar navbar-expand">
                                                            <ul class="navbar-nav">
                                                                <!-- Dropdown -->
                                                                <li class="nav-item dropdown">
                                                                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown"> <i class="fa fa-ellipsis-v"></i>
                                                                    </a>
                                                                    <div class="dropdown-menu"> 

                                                                        <a href="{{ url('view-user', $user->id) }}" class="dropdown-item text-success">
                                                                            <i class="fa fa-eye"></i> view
                                                                        </a>
                                                                        <form  class="deleted" style="display: inline-block!important"  role="form" method="POST"
                                                                               action="{{route('delete-user',['id'=>$user->id])}}" >
                                                                            @csrf   
                                                                            <button type="submit"class=" dropdown-item text-danger text-primary">
                                                                                <i class="fa fa-trash"></i> delete
                                                                            </button>
                                                                        </form> 

                                                                        <a href="{{ url('user-login', $user->id) }}" class="dropdown-item">
                                                                            <i class="fa fa-sign"> </i> login
                                                                        </a>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </nav>
                                                    </td>
                                                </tr>
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
                                        <table class="render table datatables cs-table crm_customer_table_inner_Wrapper">
                                            <thead>
                                                <tr>
                                                    <th class="width_table1">Username</th>
                                                    <th class="width_table1">Email</th>
                                                    <th class="width_table1">Type</th>
                                                    <th class="width_table1">status</th>
                                                    <th class="width_table1">Date Joined</th>
                                                    <th class="width_table1">Options</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($unverified_users as $user)
                                                <tr class="background_white">

                                                    <td>
                                                        <div class="media cs-media">

                                                            <div class="media-body">
                                                                <h5>{{$user->username}}</h5>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="pretty p-svg p-curve">{{$user->email}}</div>
                                                    </td>
                                                    <td>
                                                        <div class="pretty p-svg p-curve">{{$user->type}}</div>
                                                    </td>
                                                    @if($user->code == false)
                                                    <td>
                                                        <div class="pretty p-svg p-curve deposit_pending">not verified</div>
                                                    </td>
                                                    @else
                                                    <td>
                                                        <div class="pretty p-svg p-curve deposit_active">verified</div>
                                                    </td>
                                                    @endif
                                                    <td>
                                                        <div class="pretty p-svg p-curve">{{ date('F d, Y', strtotime($user->created_at)) }} {{ date('g:i A', strtotime($user->created_at)) }}</div>
                                                    </td>

                                                    <td>
                                                        <nav class="navbar navbar-expand">
                                                            <ul class="navbar-nav">
                                                                <!-- Dropdown -->
                                                                <li class="nav-item dropdown">
                                                                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown"> <i class="fa fa-ellipsis-v"></i>
                                                                    </a>
                                                                    <div class="dropdown-menu"> 

                                                                        <a href="{{ url('view-user', $user->id) }}" class="dropdown-item text-success">
                                                                            <i class="fa fa-eye"></i> view
                                                                        </a>
                                                                        <form  class="deleted" style="display: inline-block!important"  role="form" method="POST"
                                                                               action="{{route('delete-user',['id'=>$user->id])}}" >
                                                                            @csrf   
                                                                            <button type="submit"class=" dropdown-item text-danger text-primary">
                                                                                <i class="fa fa-trash"></i> delete
                                                                            </button>
                                                                        </form> 

                                                                        <a href="{{ url('user-login', $user->id) }}" class="dropdown-item">
                                                                            <i class="fa fa-sign"> </i> login
                                                                        </a>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </nav>
                                                    </td>
                                                </tr>
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






    <!-- /.content -->


    @section('script')

    <!-- This is data table -->
    <script src="{{asset('assets/vendor_components/datatable/datatables.min.js')}}"></script>

    <!-- Crypto Admin for Data Table -->
    <script src="{{asset('dashboard/js/pages/data-table.js')}}"></script>


    @endsection



    @endsection


@section('title')
<title>{{ucfirst($settings['site_name'])}} &mdash; Manage Deposit</title>
<meta  name="description" content="Manage Deposit">
<meta itemprop="keywords" name="keywords" content="{{ucfirst($settings['site_name'])}} - Manage Deposit"/>
<meta name="author" content="{{ucfirst($settings['site_name'])}}" />

@endsection
@extends('layouts.dashboard')
@section('content')

<div class="page_title_section dashboard_title">

    <div class="page_header">
        <div class="container">
            <div class="row">

                <div class="col-xl-9 col-lg-7 col-md-7 col-12 col-sm-7">

                    <h1>Manage Deposits
                    </h1>
                </div>
                <div class="col-xl-3 col-lg-5 col-md-5 col-12 col-sm-5">
                    <div class="sub_title_section">
                        <ul class="sub_title">
                            <li> <a href="{{url('/')}}"> Home </a>&nbsp; / &nbsp; </li>
                            <li>Manage Deposits
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

                    <h3>Manage Deposits
                    </h3>

                </div>
            </div>
        </div>

        <form  class="form-group mb-5 mt-5 mb-4"  method=get name=opts action="{{route('manage-deposit')}}" enctype="multipart/form-data">
            @csrf
            <td>
                <select name=type class="inpts form-control" onchange="document.opts.submit();">
                    <option value="" @if(empty($type))selected @endif>All Deposit</option>
                    <option value="running" @if($type == 'running')selected @endif>Running Deposit</option>
                    <option value="completed" @if($type == 'completed')selected @endif>Completed Deposit</option>
                    <option value="confirmed" @if($type == 'confirmed')selected @endif>Confirmed Deposit</option>
                    <option value="pending" @if($type == 'pending')selected @endif>Pending Deposit</option>

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
                <table class="dd table datatables cs-table crm_customer_table_inner_Wrapper">
                    <thead>
                        <tr>
                            <th class="width_table1">User</th>
                            <th class="width_table1">Plan</th>
                            <th class="width_table1">payment mode</th>
                            <th class="width_table1">Amount(USD)</th>
                            <th class="width_table1">Profit</th>
                            <th class="width_table1">End Date</th>
                            <th class="width_table1">Status</th>
                            <th class="width_table1">Date</th>
                            <th class="width_table1">Options</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($deposits as $deposit)
                        <tr class="background_white">

                            <td>
                                <div class="media cs-media">

                                    <div class="media-body">
                                        <h5>{{$deposit->user->first_name}} {{$deposit->user->last_name}}</h5>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="pretty p-svg p-curve">{{$deposit->plan->name}}</div>
                            </td>
                            <td>
                                <div class="pretty p-svg p-curve">{{$deposit->usercoin->coin->name}}</div>
                            </td>
                            <td>
                                <div class="pretty p-svg p-curve">USD{{number_format($deposit->amount,2)}}</div>
                            </td>
                            <td>
                                <div class="pretty p-svg p-curve">USDT{{number_format($deposit->earn,2)}}</div>
                            </td>
                            <td>
                                @if(empty($deposit->due_pay))
                                <div class="pretty p-svg p-curve">Nill</div>
                                @else
                                <div class="pretty p-svg p-curve"> {{$deposit->due_pay->diffForHumans()}}</div>
                                @endif
                            </td>

                            <td>
                                @if($deposit->status == false && empty($deposit->due_pay))
                                <div class="pretty p-svg p-curve badge deposit_pending">Pending</div>
                                @elseif($deposit->status == false && !empty($deposit->due_pay))
                                <div class="pretty p-svg p-curve badge deposit_matured">Running</div>
                                @else 
                                <div class="pretty p-svg p-curve badge deposit_active">Completed</div>
                                @endif

                            </td>
                            <td class="flag">
                                <div class="pretty p-svg p-curve">{{ date('F d, Y', strtotime($deposit->created_at)) }} {{ date('g:i A', strtotime($deposit->created_at)) }}</div>
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
                                                       action="{{route('delete-deposit',['id'=>$deposit->id])}}" >
                                                    @csrf   
                                                    <button type="submit"class="dropdown-item text-danger">
                                                        <i class="fa fa-trash"> Delete</i>
                                                    </button>
                                                </form>
                                                <button type="button" class="dropdown-item text-primary" data-toggle="modal" data-target="#view{{$deposit->id}}">
                                                    <i class="fa fa-eye "></i> View
                                                </button>

                                                <button type="button" class="dropdown-item text-primary" data-toggle="modal" data-target="#edit{{$deposit->id}}">
                                                    <i class="fa fa-edit "></i> Edit
                                                </button>

                                                @if($deposit->status_deposit == false)
                                                <form  class="deleted" style="display: inline-block!important"  role="form" method="POST"
                                                       action="{{route('confirm-deposit',['id'=>$deposit->id])}}" >
                                                    @csrf   
                                                    <button type="submit"class="dropdown-item text-success">
                                                        <i class="fa fa-check"></i> Confirm Payment
                                                    </button>
                                                </form>
                                                @endif
                                            </div>
                                        </li>
                                    </ul>
                                </nav>
                            </td>
                        </tr>
                    <div class="modal fade" id="edit{{$deposit->id}}">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <h4 class="modal-title">Edit Deposit</h4>
                                    <button type="button" class="close btn btn-theme  btn-primary" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form class="" method="Post" action="{{route('edit-deposit',['id'=>$deposit->id])}}">
                                        @csrf  
                                        <div class="form-group">
                                            <label class="active">Amount</label>
                                            <input type="text" name="amount" value="{{$deposit->amount}}" class="form-control" placeholder="Amount">
                                        </div>


                                        <div class="form-group">
                                            <label class="active">Compound</label>

                                            <select  name="plan" class="form-control">
                                                <option value="" selected disabled>Select Plan</option>
                                                @foreach($plans as $plan)
                                                <option value="{{$plan->id}}" {{$deposit->plan_id == $plan->id ? 'selected' : '' }}> {{$plan->name}} </option>
                                                @endforeach



                                            </select>
                                        </div>

                                </div>
                                <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-theme btn-circle btn-primary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-theme btn-circle btn-success">Save</button>
                                </div>
                                </form>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                    @if($deposit->proofImages->isNotEmpty())
                    <div class="modal fade" id="view{{$deposit->id}}">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <h4 class="modal-title">View Deposit Proof</h4>
                                    <button type="button" class="close btn btn-theme  btn-primary" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    
                                    <strong> Images:    </strong>
                                 <div class="row">
                                 @foreach($deposit->proofImages as $proof)
                                 <div class="col-md-6">
                                 <img src="{{asset('deposit/proof/'.$proof->path)}}" style="width: 100%;height: 200px">
                                 </div>
                                    @endforeach
                                 </div>
                                 <br>
                                 <strong> Message:</strong>  @foreach($deposit->proofMessage as $proof)
                                 {{$proof->message}}
                                 @endforeach
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                    </div>
                    @endif
                    @endforeach
                    </tbody>
                </table>


            </div>
        </div>
    </div>





    @section('script')

    @endsection

    @endsection


@section('title')
<title>{{ucfirst($settings['site_name'])}} &mdash; Manage Education Pack</title>
<meta  name="description" content="Manage Education Pack">
<meta itemprop="keywords" name="keywords" content="{{ucfirst($settings['site_name'])}} - Manage Education Pack"/>
<meta name="author" content="{{ucfirst($settings['site_name'])}}" />

@endsection
@extends('layouts.dashboard')
@section('content')

<div class="page_title_section dashboard_title">

    <div class="page_header">
        <div class="container">
            <div class="row">

                <div class="col-xl-9 col-lg-7 col-md-7 col-12 col-sm-7">

                    <h1>Education Pack
                    </h1>
                </div>
                <div class="col-xl-3 col-lg-5 col-md-5 col-12 col-sm-5">
                    <div class="sub_title_section">
                        <ul class="sub_title">
                            <li> <a href="{{url('/')}}"> Home </a>&nbsp; / &nbsp; </li>
                            <li>Education Pack
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

                    <h3>Education Pack
                    </h3>

                </div>
            </div>
        </div>

        <form  class="form-group mb-5 mt-5 mb-4"  method=get name=opts action="{{route('manage-education-user-sub')}}" enctype="multipart/form-data">
            @csrf
            <td>
                <select name=type class="inpts form-control" onchange="document.opts.submit();">
                    <option value="" @if(empty($type))selected @endif>All Education Pack</option>
                    <option value="confirmed" @if($type == 'confirmed')selected @endif>Confirmed Education Pack</option>
                    <option value="pending" @if($type == 'pending')selected @endif>Pending Education Pack</option>

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
                <table class="myTable table datatables cs-table crm_customer_table_inner_Wrapper">
                    <thead>
                        <tr>
                            <th class="width_table1">User</th>
                            <th class="width_table1">Plan</th>
                            <th class="width_table1">Amount(USD)</th>
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
                                <div class="pretty p-svg p-curve">USD{{number_format($deposit->amount,2)}}</div>
                            </td>

                            <td>
                                @if(empty($deposit->due_pay))
                                <div class="pretty p-svg p-curve">Nill</div>
                                @else
                                <div class="pretty p-svg p-curve"> {{$deposit->due_pay->diffForHumans()}}</div>
                                @endif
                            </td>

                            <td>
                                @if($deposit->due_pay < \Carbon\Carbon::now())
                                <div class="pretty p-svg p-curve badge deposit_active">Completed</div>
                                @elseif(empty($deposit->due_pay))
                                <div class="pretty p-svg p-curve badge deposit_pending">Pending</div>
                                @elseif(!empty($deposit->due_pay))
                                <div class="pretty p-svg p-curve badge deposit_active">Confirmed</div>

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
                                                       action="{{route('delete-deposit-education-license',['id'=>$deposit->id])}}" >
                                                    @csrf   
                                                    <button type="submit"class="dropdown-item text-danger">
                                                        <i class="fa fa-trash"> Delete</i>
                                                    </button>
                                                </form>

                                                <button type="button" class="dropdown-item text-primary" data-toggle="modal" data-target="#view{{$deposit->id}}">
                                                    <i class="fa fa-eye "></i> View
                                                </button>

                                                @if($deposit->status_deposit == false)
                                                <form  class="deleted" style="display: inline-block!important"  role="form" method="POST"
                                                       action="{{route('confirm-deposit-education-license',['id'=>$deposit->id])}}" >
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


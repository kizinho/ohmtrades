@section('title')
<title>{{ucfirst($settings['site_name'])}} &mdash; Withdrawal</title>
<meta  name="description" content="Withdrawal">
<meta itemprop="keywords" name="keywords" content="{{ucfirst($settings['site_name'])}} - Withdrawal"/>
<meta name="author" content="{{ucfirst($settings['site_name'])}}" />

@endsection
@extends('layouts.dashboard')
@section('content')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Withdrawal </h4>


                    </div>

                </div>
            </div>
        </div>
        





        <div class="col-md-6 offset-md-3 ">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">@if(empty($type))Current Balance: @else Investment Capital: @endif @if(empty($user_withdraw))
                                                $0.0  USD
                                                @else
                                                ${{number_format($user_withdraw->amount, 2)}} USD
                                                @endif
                                                </h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{route('withdraw')}}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="p_id" name="plan" class="form-control">
                        @if(empty($type))
                        <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected">
                            <span class="input-group-btn input-group-prepend"><button class="btn btn-info bootstrap-touchspin-down" type="button">Amount</button>
                            </span><span class="input-group-addon bootstrap-touchspin-prefix input-group-prepend">
                               </span>
                            <input data-toggle="touchspin" type="text" name="amount" placeholder="enter amount" class="form-control dd" required>
                            <span class="input-group-btn input-group-append"><button class="btn btn-info bootstrap-touchspin-up" type="button">$</button></span>
                        </div>
                        @else
                        <input name="amount" type="hidden" value="{{$user_withdraw->amount}}">
                         <input name="type" type="hidden" value="{{$type}}">
                          <input name="id" type="hidden" value="{{$id}}">
                        @endif
                         <br> <br>
                           <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected">
                            <span class="input-group-btn input-group-prepend"><button class="btn btn-info bootstrap-touchspin-down" type="button">Wallet name</button>
                            </span><span class="input-group-addon bootstrap-touchspin-prefix input-group-prepend">
                               </span>
                            <input data-toggle="touchspin" type="text" name="address_name" placeholder="eg bitcoin" class="form-control dd" required>
                            <span class="input-group-btn input-group-append"></span>
                        </div>
                          <br> <br>
                           <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected">
                            <span class="input-group-btn input-group-prepend"><button class="btn btn-info bootstrap-touchspin-down" type="button">Withdrawal Address</button>
                            </span><span class="input-group-addon bootstrap-touchspin-prefix input-group-prepend">
                               </span>
                            <input data-toggle="touchspin" type="text" name="address" placeholder="enter address" class="form-control dd" required>
                            <span class="input-group-btn input-group-append"></span>
                        </div>
                       
                        <br> <br>
                                <div class="text-center">
                                    <button class="btn btn-primary btn-block mt-3">Submit</button>
                                </div>
                          

                    </form>
                </div>
            </div>
        </div>




    </div> <!-- container-fluid -->
</div>











@endsection

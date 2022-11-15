  
@extends('layouts.dashboard')

@section('content')

<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Select Payment Gateway</h4>



                    </div>
                </div>
            </div>
            <!-- end page title -->
              <div class="row">
             @foreach($coins as $coin)
            <div class="col-xl-6 col-sm-6">
                <div class="card text-center">
                    <div class="card-body">
                        <div class="avatar-sm mx-auto mb-4">
                            <span class="avatar-title rounded-circle bg-info bg-soft text-primary font-size-16">
                                <img src="{{asset($coin->photo)}}" style="width:50px;height:50px">
                            </span>
                        </div>
                        <h5 class="font-size-15 mb-1"><a href="javascript: void(0);" class="text-muted">
                             @if($coin->id == 1)
                                    {{$btc_amount}}  {{$btc_name}}
                                    @elseif($coin->id == 2)
                                    {{$eth_amount}}  {{$eth_name}}
                                    @else
                                     {{$usdt_amount}}  {{$usdt_name}}
                                    @endif
                            </a></h5>
                      
                        <div>
                            <a href="javascript: void(0);" class="badge bg-primary font-size-11 m-1">amount</a>
                            <a href="javascript: void(0);" class="badge bg-primary font-size-11 m-1">{{$gateway['amount']}} usd</a>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent border-top">
                    
                                  <div class="text-center">

                                    <a class="btn btn-warning text-white" href="{{route('deposit-plan-payment')}}?gateway={{$coin->slug}}&gateway_amount=@if($coin->id == 1){{$btc_amount}}@elseif($coin->id == 2){{$eth_amount}} @else {{$usdt_amount}} @endif &gateway_value=@if($coin->id == 1) bitcoin @elseif($coin->id == 2) ethereum @else usdt @endif" class="b-wallet__invest">Pay Now</a>

                                </div>
                        
                    </div>
                </div>
            </div>
             @endforeach
        </div>


        </div> <!-- container-fluid -->
    </div>
   


@endsection

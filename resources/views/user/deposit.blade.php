@section('title')
<title>{{ucfirst($settings['site_name'])}} &mdash; Deposit Investment</title>
<meta  name="description" content="Deposit Investment">
<meta itemprop="keywords" name="keywords" content="{{ucfirst($settings['site_name'])}} - Deposit Investment"/>
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
                        <h4 class="mb-sm-0 font-size-18">Choose Plan </h4>


                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">

            @foreach($plans as $key => $plan)
            <div class="col-xl-3 col-md-6">
                <div class="card plan-box">
                    <div class="card-body p-4">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <h5>{{$plan->name}}</h5>
                            </div>

                        </div>

                        <hr>
                        <div class="plan-features mt-5">

                            <p><i class="bx bx-checkbox-square text-info me-2"></i> ${{number_format($plan->min)}}-@if($plan->max == 0)UNLIMITED @else ${{number_format($plan->max)}} @endif</p>
                            <p>
                                @if($plan->name == 'Vip package')
                               <i class="bx bx-checkbox-square text-info me-2"></i>  ({{number_format($plan->percentage,1)}}% weekly return) + 3% withdrawal fees goes into vip founder pool . The 3% withdrawal
                                fees will be shared among all vip partner. 
                                @elseif($plan->name == 'Vvip package')
                               <i class="bx bx-checkbox-square text-info me-2"></i>  ({{number_format($plan->percentage,1)}}% weekly return) + 1% company pool of monthly deposits .
                                All the funds that enters the company monthly , 1% of the funds will be shared among the vvip.
                                @elseif($plan->name == 'Premium')
                              <i class="bx bx-checkbox-square text-info me-2"></i>   Up to {{number_format($plan->percentage,1)}}% profit returns weekly for a period of 90days contract, after which you can withdraw both your capital and profits if you wish not to renew your contract.
                                @elseif($plan->name == 'NFP TRADES')
                               <i class="bx bx-checkbox-square text-info me-2"></i>  Traded every first Friday of the month, {{number_format($plan->percentage,1)}}% profit returns instantly plus capital once trade ends for the day, PAYOUT WITH 24 hours!!
                                @else
                                <i class="bx bx-checkbox-square text-info me-2"></i>  {{number_format($plan->percentage,1)}}% @if($plan->name == 'Our promo package') daily @else weekly @endif return
                               
                               @endif
                            </p>
                            <p> <i class="bx bx-checkbox-square text-info me-2"></i>  @if($plan->name == 'Our promo package') 30 @else 90 @endif days contract After which you can withdraw Capital if you wish not to renew your contract.
                               </p>

                        </div>
                        <div class="text-center ">
                            <a a data-plan="{{$plan->id}}" href="javascript: void(0);" class="btn btn-primary btn-sm  select_plan">Buy this plan</a>
                        </div>
                    </div>

                </div>
            </div>
            @endforeach

        </div>   





        <div class="col-xl-12 col-lg-12 show "style="display:none">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Current Balance: @if(empty(Auth::user()->earn))
                        $0.0  USD
                        @else
                        ${{number_format(Auth::user()->earn->amount, 2)}} USD
                        @endif </h4>
                </div>
                <div class="card-body">
                    <form method="POST" id="p" action="{{route('select-gateway')}}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="p_id" name="plan" class="form-control">
                        <input type="hidden" name="type" value="license" class="form-control">
                        <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected">
                            <span class="input-group-btn input-group-prepend"><button class="btn btn-info bootstrap-touchspin-down" type="button">Amount</button>
                            </span><span class="input-group-addon bootstrap-touchspin-prefix input-group-prepend">
                                <span class="input-group-text"id="amount" ></span></span>
                            <input data-toggle="touchspin" type="text" name="amount" placeholder="enter amount" class="form-control dd" required>
                            <span class="input-group-btn input-group-append"><button class="btn btn-info bootstrap-touchspin-up" type="button">$</button></span>
                        </div>
                        <input type="hidden" id="type" name="type_old" class="form-control">
                        <br> <br>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="text-center">
                                    <button class="btn btn-info btn-block mt-3 new" id="new">Buy under this plan</button>
                                </div>
                            </div>
<!-- 
                            <div class="col-md-6">
                                <div class="text-center">
                                    <button class="btn btn-warning btn-block mt-3 old" id="old">Add to the existing plan</button>
                                </div>
                            </div>
                            -->
                        </div>

                    </form>
                </div>
            </div>
        </div>




    </div> <!-- container-fluid -->
</div>











@section('script')

<script>

    $('#p').submit(function (event) {
        let disable = document.getElementById('sp');
        disable.setAttribute('disabled', 'true');
        let disableOld = document.getElementById('old');
        disableOld.setAttribute('disabled', 'true');
    });
    $('#old').click(function () {
        $('#type').val('');
        $("#type").val($("#type").val() + 'old');

    });
    $('#new').click(function () {
        $('#type').val('');

    });

    $('.select_plan').click(function () {
        var planID = $(this).attr('data-plan');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function () {
                $(".mmodal").show();
            },
            complete: function () {
                $(".mmodal").hide();
            }

        });
        if (planID) {
            $.ajax({
                type: "GET",
                url: "{{url('get-plan')}}?plan_id=" + planID,
                success: function (res) {
                    if (res) {
                        $('#p_id').val('');
                        $('#plan_value').val('');
                        $('#amount').val('');
                        $('#sign').val('');
                        $('#plan_compound').val('');
                        $('.plan_profit').val('');
                        $("#plan_value").val($("#plan_value").val() + res.min);
                        $("#amount").html(res.amount);
                        $("#plan_compound").val($("#plan_compound").val() + res.percentage);
                        $(".plan_profit").html(res.profit);
                        $("#p_id").val($("#p_id").val() + res.p_id);
                        $("#sign").html(res.sign);
                        $(".show").show();
                        $('html, body').animate({
                            scrollTop: $(".dd").offset().top
                        });
                    } else {
                        $('#plan_value').val('');
                        $('#sign').val('');
                        $('#plan_compound').val('');
                        $('#plan_profit').val('');
                        $('#p_id').val('');
                        $(".show").hide();
                        $('#amount').val('');
                    }
                }
            });
        } else {
            $('#plan_value').val('');
            $('#sign').val('');
            $('#plan_compound').val('');
            $('.plan_profit').val('');
            $('#p_id').val('');
            $(".show").hide();
            $('#amount').val('');
        }
    });
</script>

@endsection
@endsection

@section('title')
<title>{{ucfirst($settings['site_name'])}} :::PLAN</title>
<meta  name="description" content="PLAN">
<meta itemprop="keywords" name="keywords" content="{{ucfirst($settings['site_name'])}} - PLAN"/>
<meta name="author" content="{{ucfirst($settings['site_name'])}}" />
<style>

</style>
@endsection
@extends('layouts.app')
@section('sub')
<div class="banner banner-static">
    <div class="banner-cpn">
        <div class="container">
            <div class="content row">

                <div class="banner-text">
                    <h1 class="page-title">Investment Plans</h1>
                    <p>We offers you the best trading plans</p>						
                </div>
                <div class="page-breadcrumb">
                    <ul class="breadcrumb">
                        <li><a href="{{url('/')}}">Home</a></li>
                        <li class="active"><span>Our plans</span></li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
    <div class="banner-bg imagebg" style="box-shadow:inset 0 0 0 2000px #3c763dad ">
        <img src="frontend/image/banner-inside-a-plan.jpg" alt="" />
    </div>
</div>
@endsection
@section('content')
<div class="section section-contents section-pad" style="background:#222;color: #fff!important">
    <div class="container">
        <div class="content">
          
            <div class="col-sm-12"><div class="row">
                    
                @foreach($plans as $key=> $plan)
                <div class="col-md-4">
                    <div class="card" style="background:#2e2d2d;border-radius: 8px;margin-bottom: 20px;text-align: center!important">
                  
                <p class="heading-sm-lead" style="font-size: 25px"> {{$plan->name}}</p>

                <p class="lead">${{number_format($plan->min)}}-@if($plan->max == 0)UNLIMITED @else ${{number_format($plan->max)}} @endif</p>
                <p style="padding:8px">
                    @if($plan->name == 'Vip package')
                    ({{number_format($plan->percentage,1)}}% weekly return) + 3% withdrawal fees goes into vip founder pool . The 3% withdrawal
                    fees will be shared among all vip partner. 
                    @elseif($plan->name == 'Vvip package')
                    ({{number_format($plan->percentage,1)}}% weekly return) + 1% company pool of monthly deposits .
                    All the funds that enters the company monthly , 1% of the funds will be shared among the vvip.
                    @elseif($plan->name == 'Premium')
                    Up to {{number_format($plan->percentage,1)}}% profit returns weekly for a period of 90days contract, after which you can withdraw both your capital and profits if you wish not to renew your contract.
                    @elseif($plan->name == 'NFP TRADES')
                    Traded every first Friday of the month, {{number_format($plan->percentage,1)}}% profit returns instantly plus capital once trade ends for the day, PAYOUT WITH 24 hours!!
                    @else
                    {{number_format($plan->percentage,1)}}% @if($plan->name == 'Our promo package') daily @else weekly @endif return 
                    @endif
                </p>
                <p> @if($plan->name == 'Our promo package') 30 @else 90 @endif days contract After which you can withdraw Capital if you wish not to renew your contract.</p>
                <div class="package-footer">
                    <button class="btn"><a style="color:#fff" href="{{url('account/deposit')}}">DEPOSIT</a></button>
                </div>
                <br>     <br>
                        </div>
                </div>
                @endforeach
</div>
            </div>
        </div>
    </div>
</div>


@endsection

@section('title')

<title>{{ucfirst($settings['site_name'])}} :::One-Time Password</title>
<meta  name="description" content=" :::One-Time Password">
<meta itemprop="keywords" name="keywords" content="{{ucfirst($settings['site_name'])}}  :::One-Time Password"/>
<meta name="author" content="{{ucfirst($settings['site_name'])}}" />
<meta name="csrf-token" content="{{ csrf_token() }}">

@endsection
@extends('layouts.app')
@section('sub')
<div class="banner banner-static">
    <div class="banner-cpn">
        <div class="container">
            <div class="content row">

                <div class="banner-text">
                    <h1 class="page-title">2factor validation</h1>
                    <p>securely login into your account</p>						
                </div>
                <div class="page-breadcrumb">
                    <ul class="breadcrumb">
                        <li><a href="{{url('/')}}">Home</a></li>
                        <li class="active"><span>2factor validation</span></li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
    <div class="banner-bg imagebg" style="box-shadow:inset 0 0 0 2000px #3c763dad ">
        <img src="{{asset('frontend/image/auth.jpg')}}" alt="" />
    </div>
</div>
@endsection
@section('content')
<div class="section section-contents section-contact section-pad" style="
     background-image: url({{asset('frontend/image/auth-pad.jpg')}});background-size: cover;box-shadow:inset 0 0 0 2000px #252728b8;color: #fff!important">
    <div class="container">
        <div class="content row">
            <div class="col-sm-5 col-sm-offset-3">
                <form  method="POST" action="{{url('2fa/validate') }}" class="form">

                    @csrf
                    <div class="form-group row">
                        <div class="form-field col-md-12 form-m-bttm">
                            <input  name="totp" type="text" placeholder="OTP code*" value="{{ $totp ?? old('totp') }}" class="form-control required">
                        </div>

                    </div>


                    <div class="text-center">
                        <button type="submit" class="btn">Validate</button>
                    </div>

                </form>


            </div>
        </div>
    </div>
</div>



@endsection
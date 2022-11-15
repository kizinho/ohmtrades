@section('title')
<title>{{ucfirst($settings['site_name'])}} &mdash; User Verify Account</title>
<meta  name="description" content="User Verify Account">
<meta itemprop="keywords" name="keywords" content="{{ucfirst($settings['site_name'])}} - User Verify Account"/>
<meta name="author" content="{{ucfirst($settings['site_name'])}}" />

@endsection
@extends('layouts.app')
@section('sub')
<div class="banner banner-static">
    <div class="banner-cpn">
        <div class="container">
            <div class="content row">

                <div class="banner-text">
                    <h1 class="page-title">Verify Account</h1>
                    <p>activate your account</p>						
                </div>
                <div class="page-breadcrumb">
                    <ul class="breadcrumb">
                        <li><a href="{{url('/')}}">Home</a></li>
                        <li class="active"><span>Verify Account</span></li>
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
             
                  <div class="text-center">
                      <h1 class="text-white" style="color:#fff!important">Verify<span class="">  Account</span></h1>
                </div>
                <br>  <br>       
         
                 <div class="center ">Verification link has been sent to your email address please use it to activate your account.</div>
             
                    <br/>
                    <div class="center">
                    <a href="{{url('resend')}}" class="thm-btn thm-tran-bg"> Didn't see it? Resend Code</a>
                    

            </div>
            </div>
        </div>
    </div>








@endsection


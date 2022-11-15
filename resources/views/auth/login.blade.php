@section('title')
<title>{{ucfirst($settings['site_name'])}} &mdash; User Login Account</title>
<meta  name="description" content="User Login Account">
<meta itemprop="keywords" name="keywords" content="{{ucfirst($settings['site_name'])}} - User Login Account"/>
<meta name="author" content="{{ucfirst($settings['site_name'])}}" />

@endsection
@extends('layouts.app')
@section('sub')
<div class="banner banner-static">
    <div class="banner-cpn">
        <div class="container">
            <div class="content row">

                <div class="banner-text">
                    <h1 class="page-title">Account Login</h1>
                    <p>login to your trading account</p>						
                </div>
                <div class="page-breadcrumb">
                    <ul class="breadcrumb">
                        <li><a href="{{url('/')}}">Home</a></li>
                        <li class="active"><span>Account Login</span></li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
    <div class="banner-bg imagebg" style="box-shadow:inset 0 0 0 2000px #3c763dad ">
        <img src="frontend/image/auth.jpg" alt="" />
    </div>
</div>
@endsection
@section('content')
<div class="section section-contents section-contact section-pad" style="
     background-image: url(frontend/image/auth-pad.jpg);background-size: cover;box-shadow:inset 0 0 0 2000px #252728b8;color: #fff!important">
    <div class="container">
        <div class="content row">
            <div class="col-sm-5 col-sm-offset-3">
                <p class="text-center">Don't have an account? 
                    <a href="{{url('register')}}">Register here</a></p>
                <!-- login form begin -->
                <form  method="POST" action="{{ route('login') }}" class="uk-grid uk-form">
                    @csrf

                    <div class="form-group row">
                        <div class="form-field col-md-12 form-m-bttm">
                            <input  name="email" type="email" placeholder="Email*" class="form-control required">
                        </div>

                    </div>

                    <div class="form-group row">
                        <div class="form-field col-md-12 form-m-bttm">
                            <input  name="password" type="password" placeholder="Password*" class="form-control required">
                        </div>

                    </div>

                    <div class="text-center">
                        <label class="uk-align-right"><a class="uk-link-reset" href="{{route('password.request')}}">Forgot password?</a></label>
                    </div>
                    <div class="text-center">
                        <button class="btn" type="submit" name="submit">Sign in</button>
                    </div>
                </form>
                <!-- login form end -->

            </div>
        </div>
    </div>
</div>




@endsection
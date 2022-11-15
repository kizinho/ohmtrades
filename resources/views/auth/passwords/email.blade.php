@section('title')
<title>{{ucfirst($settings['site_name'])}} &mdash; User Password Reset Link</title>
<meta  name="description" content="User Password Reset Link">
<meta itemprop="keywords" name="keywords" content="{{ucfirst($settings['site_name'])}} - User Password Reset Link"/>
<meta name="author" content="{{ucfirst($settings['site_name'])}}" />

@endsection
@extends('layouts.app')
@section('sub')
<div class="banner banner-static">
    <div class="banner-cpn">
        <div class="container">
            <div class="content row">

                <div class="banner-text">
                    <h1 class="page-title">Forgot Password</h1>
                    <p>recover your lost password</p>						
                </div>
                <div class="page-breadcrumb">
                    <ul class="breadcrumb">
                        <li><a href="{{url('/')}}">Home</a></li>
                        <li class="active"><span>Forgot Password</span></li>
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
                <form  method="POST" action="{{ route('password.email') }}" class="uk-grid uk-form">
                    @csrf
                    <div class="form-group row">
                        <div class="form-field col-md-12 form-m-bttm">
                            <input  name="email" type="email" placeholder="Email*" class="form-control required">
                        </div>

                    </div>



                    <div class="text-center">
                        <button class="btn"
                                type="submit" name="submit">Password Reset</button>
                    </div>
                </form>
                <!-- login form end -->

            </div>
        </div>
    </div>
</div>




























@endsection
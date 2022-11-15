@section('title')
<title>{{ucfirst($settings['site_name'])}} :::Teams</title>
<meta  name="description" content=":::Teams">
<meta itemprop="keywords" name="keywords" content="{{ucfirst($settings['site_name'])}} - :::Teams"/>
<meta name="author" content="{{ucfirst($settings['site_name'])}}" />

@endsection
@extends('layouts.app')
@section('content')

<div class="inner-banner has-base-color-overlay text-center" style="background: url(images/background/1.jpg);">
    <div class="container">
        <div class="box">
            <h3>Our Team</h3>
        </div>
    </div>
    <div class="breadcumb-wrapper">
        <div class="container">
            <div class="pull-left">
                <ul class="list-inline link-list">
                    <li>
                        <a href="{{url('/')}}">Home</a>
                    </li>
                    <li>
                       Our Team
                    </li>
                </ul>
            </div>

        </div>
    </div>
</div>



<section class="about-faq sec-padd">
    <div class="container">
        <div class="row">
         
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="about-info">
                   
                    <div class="text">
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown</p>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown</p>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown</p>
                    </div>


                </div>
            </div>


        </div>
    </div>
</section>


@endsection
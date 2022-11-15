@section('title')
<title>{{ucfirst($settings['site_name'])}} &mdash; Contact Us</title>
<meta  name="description" content="Contact Us">
<meta itemprop="keywords" name="keywords" content="{{ucfirst($settings['site_name'])}} - Contact Us"/>
<meta name="author" content="{{ucfirst($settings['site_name'])}}" />

@endsection
@extends('layouts.app')
@section('content')




   <!-- immer banner start -->
   <section class="inner-banner pt-80 pb-95" style="background-image: url({{ asset('frontend/img/banner/inner-banner.jpg')}});" data-overlay="7">
    <div class="container mt-100">
            <div class="row z-5 align-items-center">
                <div class="col-md-8 text-center text-md-left">
                    <h1 class="f-700 green">Videos</h1>
                    <span class="green-line bg-green d-none d-md-inline-block"></span>
                </div>
                <div class="col-md-4 text-center text-md-right">
                    <nav aria-label="breadcrumb" class="banner-breadcump">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a href="{{url('/')}}"><i class="fas fa-home fs-12 mr-5"></i>Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Videos</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
<script src="//widgets.coingecko.com/coingecko-coin-price-marquee-widget.js"></script>
<coingecko-coin-price-marquee-widget  coin-ids="bitcoin,ethereum,eos,ripple,litecoin" currency="usd" background-color="#ffffff" locale="en"></coingecko-coin-price-marquee-widget> 

   <br>
   <div class=" card card-body">
   <h1 class="text-center">Investors testimonials and mining our mining machinery</h1>
   </div>
<br>
    <!-- Videos area start -->
<center>
<video controls="controls" autoplay>
  <source src="{{ asset('frontend/img/vid1.mp4')}}" type="video/mp4">
  <source src="{{ asset('frontend/img/vid1.mp4')}}" type="video/ogg">
  

</video>
<br>
<video controls="controls" >
  <source src="{{ asset('frontend/img/vid2.mp4')}}" type="video/mp4">
  <source src="{{ asset('frontend/img/vid2.mp4')}}" type="video/ogg">

</video>
<br>
<video controls="controls" >
  <source src="{{ asset('frontend/img/vid3.mp4')}}" type="video/mp4">
  <source src="{{ asset('frontend/img/vid3.mp4')}}" type="video/ogg">

</video>
<br>
<video controls="controls" >
  <source src="{{ asset('frontend/img/vid4.mp4')}}" type="video/mp4">
  <source src="{{ asset('frontend/img/vid4.mp4')}}" type="video/ogg">

</video>
<br>
<video controls="controls" >
  <source src="{{ asset('frontend/img/vid5.mp4')}}" type="video/mp4">
  <source src="{{ asset('frontend/img/vid5.mp4')}}" type="video/ogg">

</video>
</center>
    <!-- Videos area end -->

@endsection
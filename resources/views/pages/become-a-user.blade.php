@section('title')
<title>{{ucfirst($settings['site_name'])}} ::: Become a User</title>
<meta  name="description" content="::: Become a User">
<meta itemprop="keywords" name="keywords" content="{{ucfirst($settings['site_name'])}} - ::: Become a User"/>
<meta name="author" content="{{ucfirst($settings['site_name'])}}" />

@endsection
@extends('layouts.app')
@section('content')
<div class="inner-banner has-base-color-overlay text-center" style="background: url(images/background/1.jpg);">
    <div class="container">
        <div class="box">
            <h3>   Become a user</h3>
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
                        Become a user
                    </li>
                </ul>
            </div>

        </div>
    </div>
</div>
<section class="contact_us sec-padd">
    <div class="container">
        <div class="row">
            <div class="page-content">
                <section class="become-a-user c-section c-section--has-skewed-bg">
                    <div class="c-section-skewed-bg-container">
                        <div class="c-section-skewed-bg"></div>
                    </div>
                    <div class="container relative">

                        <div class="c-section-content">
                            <div class="row">
                                <div class="col-12 col-md-12">
                                    <article class="article">
                                        <p>  {{$settings['site_name']}} has developed a transparent and fluid communication within its platform structure, which allows {{$settings['site_name']}} not just to set the most ambitious goals but to also successfully achieve them within a designated timeframe.</P>
                                        <p>Our users are professionals and newcomers who want to get rewards and bonuses available to the users of the {{$settings['site_name']}} platform, only made possible by application of technologies of tomorrow and with the synergy of the best talents on the market.
                                        </p>
                                        <p>Every THURSDAY AND FRIDAY {{$settings['site_name']}} users receive a report with information on the average performance of the platform in the FOREX MARKET FOR THE WEEK POSTED IN THE OFFICIAL GROUP. </article>
                                    </p>
                                    <br>
                                    <div class="text-center ">
                                      <a  href="{{url('register')}}">
                                    <div class="text-center text-md-left mt-6 mt-md-8">
                                  <button class="thm-btn thm-color">
                                               Register now 
                                           
                                     
                                       </button>
                                    </div>
                                            </a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </section>
            </div>



        </div>
    </div>
</section>
@endsection
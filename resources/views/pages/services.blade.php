@section('title')
<title>{{ucfirst($settings['site_name'])}} :::Services</title>
<meta  name="description" content=":::Services">
<meta itemprop="keywords" name="keywords" content="{{ucfirst($settings['site_name'])}} - :::Services"/>
<meta name="author" content="{{ucfirst($settings['site_name'])}}" />

@endsection
@extends('layouts.app')
@section('content')

@section('sub')
 <div class="uk-width-1-1 in-breadcrumb">
                        <ul class="uk-breadcrumb uk-text-uppercase"><li><a href="{{url('/')}}">Home</a></li><li><a href="#"></a></li>
                          </ul>
                    </div>
@endsection
<main>
       <div class="uk-section uk-padding-large">
        <div class="uk-container in-wave-2">
            <div class="uk-grid" data-aos="fade-up" data-aos-once="true">
                <div class="uk-width-3-4@m">
                    <h1 class="uk-margin-remove-bottom">Our<span class="in-highlight"> Services</span></h1>
                    <p class="uk-text-lead uk-text-muted uk-margin-small-top uk-margin-bottom">Get all services that we offer</p>
                </div>
            </div>
            <div class="uk-grid-medium uk-grid-match" data-uk-grid>
                <div class="uk-width-1-2@s uk-width-1-3@m" data-aos="flip-right" data-aos-once="true">
                    <div class="uk-card uk-card-default uk-card-body uk-border-rounded uk-background-contain uk-background-bottom-center" style="background-image: url(frontend/img/forex.jpg); background-size: cover;box-shadow:inset 0 0 0 2000px #bde0f9e0">
                        <h5 class="uk-margin-remove">
                            <a href="#">Forex Trading </a>
                        </h5>

                        <p>Trade 182 FX spot pairs and 140 forwards across majors, minors, exotics and metals.</p>
                    </div>
                </div>
                <div class="uk-width-1-2@s uk-width-1-3@m" data-aos="flip-left" data-aos-once="true">
                    <div class="uk-card uk-card-default uk-card-body uk-border-rounded uk-background-contain uk-background-bottom-center" style="background-image: url(frontend/img/forex.jpg); background-size: cover;box-shadow:inset 0 0 0 2000px #bde0f9e0">
                        <h5 class="uk-margin-remove">
                            <a href="#">CFDs</a>
                        </h5>

                        <p>Go long or short on 9,000+ instruments with tight spreads & low commissions.</p>
                    </div>
                </div>
                <div class="uk-width-1-2@s uk-width-1-3@m" data-aos="flip-right" data-aos-once="true">
                    <div class="uk-card uk-card-default uk-card-body uk-border-rounded uk-background-contain uk-background-bottom-center" style="background-image: url(frontend/img/forex.jpg); background-size: cover;box-shadow:inset 0 0 0 2000px #bde0f9e0">
                        <h5 class="uk-margin-remove">
                            <a href="#">Loan Startups</a>
                        </h5>

                        <p>We finance/loan startups for shares benefit.</p>
                    </div>
                </div>
                <div class="uk-width-1-2@s uk-width-1-3@m" data-aos="flip-left" data-aos-once="true">
                    <div class="uk-card uk-card-default uk-card-body uk-border-rounded uk-background-contain uk-background-bottom-center" style="background-image: url(frontend/img/forex.jpg); background-size: cover;box-shadow:inset 0 0 0 2000px #bde0f9e0">
                        <h5 class="uk-margin-remove">
                            <a href="#">Financial market  </a>
                        </h5>

                        <p>We trade Crypto(mining), options, forex, stock, index and commodities.</p>
                    </div>
                </div>
                 <div class="uk-width-1-2@s uk-width-1-3@m" data-aos="flip-right" data-aos-once="true">
                    <div class="uk-card uk-card-default uk-card-body uk-border-rounded uk-background-contain uk-background-bottom-center" style="background-image: url(frontend/img/forex.jpg); background-size: cover;box-shadow:inset 0 0 0 2000px #bde0f9e0">
                        <h5 class="uk-margin-remove">
                            <a href="#">Real Estate </a>
                        </h5>

                        <p>We offer Real Estate consultancy, property management and Real Estate development. We develop, manage, sell and lease properties of all categories including JV( joint venture), fix and flip.</p>
                    </div>
                </div>
                 <div class="uk-width-1-2@s uk-width-1-3@m" data-aos="flip-left" data-aos-once="true">
                    <div class="uk-card uk-card-default uk-card-body uk-border-rounded uk-background-contain uk-background-bottom-center" style="background-image: url(frontend/img/forex.jpg); background-size: cover;box-shadow:inset 0 0 0 2000px #bde0f9e0">
                        <h5 class="uk-margin-remove">
                            <a href="#">Production </a>
                        </h5>

                        <p>We produce, distribute and export fibre optic cables.</p>
                    </div>
                </div>
            </div>
          
        </div>
    </div>
</main>

        @endsection
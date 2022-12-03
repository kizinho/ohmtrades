@section('title')
<title>{{ucfirst($settings['site_name'])}} :: Forex trading and signal company</title>
<meta name="description" content="OHMTrade is a universally recognized FX institute that provides trading education, trading signals, and comprehensive market analysis for aspiring and professional traders">
<meta itemprop="keywords" name="keywords" content="{{ucfirst($settings['site_name'])}}:: Forex company"/>
<meta name="author" content="{{ucfirst($settings['site_name'])}}" />
    <link rel='stylesheet'   href='{{ asset("frontend/static/css/home.css")}}' type='text/css' media='all' />
<script type="application/ld+json">
    {
    "@context": "https://schema.org",
    "@type": "Forex trading and signal company",
    "name": "Forex trading and signal company",
    "description": "OHMTrade is a universally recognized FX institute that provides trading education, trading signals, and comprehensive market analysis for aspiring and professional traders",
    "provider": {
    "@type": "Organization",
    "name": "OHMTrade",
    "sameAs": "https://cobitfx.com"
    }
    }
</script>
@endsection
@extends('layouts.app')

@section('content')
<hr class="border-light">
     <section class="landing">
        <div class="landing-content">
            <p> <span>#1</span> Web3 investing site in the world</p>
            <h2 class="mb-sm-5 mb-0">More than an <br><span>investment</span> platform</h2>
            <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                Dolor aliquam enim donec eget molestie lectus leo tortor, pharetra.</p>
            <div class="btn" id="buttons">
                <a href="#">
                    <p>Start Investing</p>
                </a>
                <a href="#">
                    <p>How it works</p>
                </a>
            </div>
        </div>
     <img class="img-fluid" src="{{ asset("frontend/static/images/wallet-hand.png")}}">
    </section>
    <img id="tape" src="{{ asset("frontend/static/images/tape.png")}}">
    <section class="about container mb-lg-5 d-flex flex-sm-row flex-column" id="content-about-us">
        <div>
            <h3>What is OHMTrades</h3>
            <p>Enfthi3 is an online trading academy that has been established to educate people who are underserved by
                financial institutions globally.
                We believe that financial literacy is the key difference maker and
                provides a strong foundation for individuals to take control of their personal economy and work towards
                a better future. In conjuction with our best in class education. we have built a platform where members
                are offered a life-altering opportunity.</p>
        </div>
        <iframe src="https://youtube.com/embed/1pBuwKwaHp0" class="w-100" title="description"></iframe>


    </section>
    <img id="tape" src="{{ asset("frontend/static/images/tape.png")}}">
    <section class="about container mb-lg-5 d-flex flex-sm-row flex-column" id="content-about-us">
        <div>
            <h3>What is OHMTrades</h3>
            <p>Enfthi3 is an online trading academy that has been established to educate people who are underserved by
                financial institutions globally.
                We believe that financial literacy is the key difference maker and
                provides a strong foundation for individuals to take control of their personal economy and work towards
                a better future. In conjuction with our best in class education. we have built a platform where members
                are offered a life-altering opportunity.</p>
        </div>
        <iframe src="https://youtube.com/embed/1pBuwKwaHp0" class="w-100" title="description"></iframe>


    </section>
    <section class="core-values" id="content-our-services">
        <div class="core-values-content container">
            <h2 class="text-center">Our Core Values</h2>
            <p class="text-center">The core values at Validus lay a strong foundation that has cultivated an environment
                where success is a
                by-product of conducting business ethically and sustainably. Our core values are our north star, guiding
                the Validus ship in times of triumph and turbulence.</p>
            <div class="core-card-container d-flex flex-sm-row flex-column">
                <div class="core-value-cards w-100">
                    <div class="title">
                        <img src="{{ asset("frontend/static/images/core-icon.png")}}">
                        <h4>Loyalty</h4>
                    </div>
                    <div>
                        <p class="description"> Founders have endeavoured to put the needs of members before their own.
                            The company has been
                            built to serve its people first and foremost.
                            Our dedication to our members has fostered loyalty with ease, and this will be the driving
                            force
                            for us to build one of the largest networks in the world.</p>
                    </div>


                </div>
                <div class="core-value-cards w-100">
                    <div class="title">
                        <img src="{{ asset("frontend/static/images/core-icon.png")}}">
                        <h4>Equality</h4>
                    </div>
                    <div>
                        <p class="description"> Founders have endeavoured to put the needs of members before their own.
                            The company has been
                            built to serve its people first and foremost.
                            Our dedication to our members has fostered loyalty with ease, and this will be the driving
                            force
                            for us to build one of the largest networks in the world.</p>
                    </div>


                </div>
                <div class="core-value-cards w-100">
                    <div class="title">
                        <img src="{{ asset("frontend/static/images/core-icon.png")}}">
                        <h4>Integrity</h4>
                    </div>
                    <div>
                        <p class="description"> Founders have endeavoured to put the needs of members before their own.
                            The company has been
                            built to serve its people first and foremost.
                            Our dedication to our members has fostered loyalty with ease, and this will be the driving
                            force
                            for us to build one of the largest networks in the world.</p>
                    </div>


                </div>
            </div>
        </div>
    </section>
    <section class="referral">
        <div class="referral-content container">
            <div class="referral-box">
                <div class="box-description">
                    <h5>Refer and earn
                        <span>3% Deposit Bonus</span>
                    </h5>
                    <a href="{{url('register')}}">Join Affiliate/ Referral Programme </a>
                </div>
                <img src="{{ asset("frontend/static/images/referral-frame.png")}}">
            </div>
            <div class="referral-description d-flex container flex-column flex-sm-row " id="content-our-pool">
                <div class="content">
                    <h3>The OHM Pool</h3>
                    <p>
                        The OHMTrades Pool is a combination of Crypto-based products run by OHMTrades. It contains
                        primarily of Forex trading, Stock trading, Crypto trading, Nodes, Staking, NFTs, Launchpads,
                        and
                        data analysis.
                        The OHMTrades pool has been set up to reward the active VIP members of the Pool as part of
                        the
                        company's loyalty program.
                        <span id="new-paragraph">
                            It operates on a “compounding with freedom” model, and rewards are allocated monthly
                        </span>

                    </p>
                </div>
                <img src="{{ asset("frontend/static/images/OHm-portal.png")}}">

            </div>
        </div>

    </section>
    <section class="broker-reviews container">
        <div class="title">
            <h5>Broker reviews</h5>
            <div></div>
        </div>
        <div class="content d-flex flex-sm-row flex-column">
            <div class="broker-card">
                <img src="{{ asset("frontend/static/images/broker1-barron.png")}}">
                <p>Rooted #1 Overall Best
                    Online Broker 2020</p>
            </div>
            <div class="broker-card">
                <img src="{{ asset("frontend/static/images/broker2-investor.png")}}">
                <p>Rooted #1 Overall Best
                    Online Broker 2020</p>
            </div>
            <div class="broker-card">
                <img src="{{ asset("frontend/static/images/broker3-kliplinger.png")}}">
                <p>Rooted #1 Overall Best
                    Online Broker 2020</p>
            </div>
            <div class="broker-card">
                <img src="{{ asset("frontend/static/images/broker4-stock.png")}}">
                <p>Rooted #1 Overall Best
                    Online Broker 2020</p>
            </div>
        </div>

    </section>
    @section('script')
     <script src="{{ asset("frontend/static/javascript/home.js")}}"></script>
     @endsection
@endsection

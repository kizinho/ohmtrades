@section('title')
<title>{{ucfirst($settings['site_name'])}} :::Become Partner </title>
<meta  name="description" content=":::Become Partner">
<meta itemprop="keywords" name="keywords" content="{{ucfirst($settings['site_name'])}} - :::Become Partner"/>
<meta name="author" content="{{ucfirst($settings['site_name'])}}" />

@endsection
@section('css')
   <link rel="stylesheet" href="{{ asset("frontend/css/main.css")}}">
@endsection
@extends('layouts.app')
@section('content')
<header class="page-header-fold">
    <div class="page-header-details">
        <br>   <br>
        <h1 class="fold-header-text">OUR <br/> <span class="text-header-bg">REFERRAL <br/><span
                class="accent">PROGRAM</span> </span>
        </h1>
        <p>Cobitfx offers users a whole new level of
            advantages, unmatched in the market of Forex.
            Any Cobitfx member can become a platform
            affiliate user by just simply registering an account and activating <a href="#" class="fw-bold">Affiliate
                Program
                Dashboard.</a>
        </p>

    </div>
</header>
<main>
    <section class="referral-levels">
        <div class="container">
            <div class="text-center">
                <h2>10 LEVEL PROGRAMS</h2>
            </div>
            <ul class="list-unstyled levels">
                <li class="level">
                    <div>
                        <i class="fa fa-tree"></i>
                        <header class="text-center">
                            <h6>Level 1</h6>
                        </header>
                        <p>
                            (direct referral 8%)
                        </p>
                    </div>
                </li>

                <li class="level">
                    <div>
                        <i class="fa fa-tree"></i>
                        <header class="text-center">
                            <h6>Level 2</h6>
                            <span>(Locked)</span>
                        </header>
                        <p>Opens up with 4 people (indirect referral 6%)</p>
                    </div>
                </li>


                <li class="level">
                    <div>
                        <i class="fa fa-tree"></i>
                        <header class="text-center">
                            <h6>Level 3</h6>
                            <span>(Locked)</span>
                        </header>
                        <p>Opens up with 3 people (indirect referral 2%)</p>
                    </div>
                </li>

                <li class="level">
                    <div>
                        <i class="fa fa-tree"></i>
                        <header class="text-center">
                            <h6>Level 4</h6>
                            <span>(Locked)</span>
                        </header>
                        <p>Opens up with 2 people (indirect referral 3%)</p>
                    </div>
                </li>

                <li class="level">
                    <div>
                        <i class="fa fa-tree"></i>
                        <header class="text-center">
                            <h6>Level 5</h6>
                            <span>(Locked)</span>
                        </header>
                        <p>Opens up with 3 people (indirect referral 4%)</p>
                    </div>
                </li>

                <li class="level">
                    <div>
                        <i class="fa fa-tree"></i>
                        <header class="text-center">
                            <h6>Level 6</h6>
                        </header>
                        <p>(indirect referral 1%)</p>
                    </div>
                </li>

                <li class="level">
                    <div>
                        <i class="fa fa-tree"></i>
                        <header class="text-center">
                            <h6>Level 7</h6>
                        </header>
                        <p>(indirect referral 1%)</p>
                    </div>
                </li>

                <li class="level">
                    <div>
                        <i class="fa fa-tree"></i>
                        <header class="text-center">
                            <h6>Level 8</h6>
                        </header>
                        <p>(indirect referral 0.5%)</p>
                    </div>
                </li>

                <li class="level">
                    <div>
                        <i class="fa fa-tree"></i>
                        <header class="text-center">
                            <h6>Level 9</h6>
                        </header>
                        <p>(indirect referral 0.5%)</p>
                    </div>
                </li>

                <li class="level">
                    <div>
                        <i class="fa fa-tree"></i>
                        <header class="text-center">
                            <h6>Level 10</h6>
                        </header>
                        <p>(indirect referral 1%)</p>
                    </div>
                </li>
            </ul>
            <div class="referral-level-explanation">
                <p>These bonuses are paid instantly once the customer gets involved. If you refer a customer, you earn
                    8% referral bonus of the amount deposited instantly (level 1) and if the customer you refer brings
                    in another customer upto 4 people you earn 6% referral bonuses from the customer your direct
                    referral brings along( level 2) and stops at level 10 which is 1%.</p>

                <p>The more these people re-invests the more you earn. A referral commission depending on the referral
                    level the customer falls in.</p>
            </div>
        </div>
    </section>
    <section class="profit-breakdown">
        <header>
            <h1>PROFIT <span class="text-header-bg">OVER PROFIT <br/> <span class="accent">COMMISSION</span></span></h1>

        </header>
        <main>
            <div class="container">
                <div class="row">
                    <div class="col-sm-4 col-md-3 ">
                        <div class="breakdown text-center">
                            <h6>Level 1</h6>
                            <div class="info primary">Direct referral 5%</div>
                            <p>Open up with 5 people (first week)</p>
                        </div>
                    </div>

                    <div class="col-sm-4 col-md-3">
                        <div class="breakdown text-center">
                            <h6>Level 2</h6>
                            <div class="info secondary">Direct referral 5%, 2.5%, 2.5%</div>
                            <p> open up with 10 people (first week, second week and third week)</p>
                        </div>
                    </div>

                    <div class="col-sm-4 col-md-3 ">
                        <div class="breakdown text-center">
                            <h6>Level 3</h6>
                            <div class="info primary">direct referral 5%,
                                2.5%, 2.5%, 2.5%
                            </div>
                            <p>open up with 15 people (first week, second week, third week and fourth week)</p>
                        </div>
                    </div>
                    <div class="col-sm-4 col-md-3">
                        <div class="breakdown text-center">
                            <h6>Level 4</h6>
                            <div class="info secondary">direct referral 5%,
                                5%, 2.5%, 2.5%
                            </div>
                            <p> open up with 20 people (first week, second week, third week and fourth week)</p>
                        </div>
                    </div>
                    <div class="col-sm-4 col-md-3">
                        <div class="breakdown text-center">
                            <h6>Level 5</h6>
                            <div class="info primary">Direct
                                referral 5%, 5%,
                                5%, 2.5%
                            </div>
                            <p> open up with 30 people (first week, second week, third week and fourth week)</p>
                        </div>
                    </div>
                    <div class="col-sm-4 col-md-3">
                        <div class="breakdown text-center">
                            <h6>Level 6</h6>
                            <div class="info secondary">Direct
                                referral 10%,
                                5%, 5%, 2.5%
                            </div>
                            <p>open up with 40 people (first week, second week, third week and fourth week</p>
                        </div>
                    </div>
                    <div class="col-sm-4 col-md-3 ">
                        <div class="breakdown text-center">
                            <h6>Level 7</h6>
                            <div class="info primary">direct referral
                                10%, 10%, 5%,
                                5%, 2.5%, 2.5%
                            </div>
                            <p>open up with 60 people (first week, second week, third week, fourth week, fifth week and
                                six week)</p>
                        </div>
                    </div>
                    <div class="col-sm-4 col-md-3">
                        <div class="breakdown text-center">
                            <h6>Level 8</h6>
                            <div class="info secondary">direct referral
                                10%, 10%, 10%,
                                5%, 5%, 5%
                            </div>
                            <p>open up with 80 people (first week, second week, third week, fourth week, fifth week and
                                six week)</p>
                        </div>
                    </div>
                    <div class="col-sm-4 col-md-3">
                        <div class="breakdown text-center">
                            <h6>Level 9</h6>
                            <div class="info primary">Direct referral
                                10%, 10%, 10%,
                                10%, 10%, 10%
                            </div>
                            <p>open up with 120 people (first week, second week, third week, fourth week, fifth week and
                                six week)</p>
                        </div>
                    </div>
                    <div class="col-sm-4 col-md-3">
                        <div class="breakdown text-center">
                            <h6>Level 10</h6>
                            <div class="info secondary">Direct referral
                                10%, 10%, 10%,
                                10%, 10%, 10%
                            </div>
                            <p> open up with 120 people (first week, second week, third week, fourth week, fifth week
                                and six week)</p>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </section>
    <section class="rewards-and-gifts">
        <img src="{{ asset("frontend/img/rank-1.jpg")}}" alt="rank" width="100%">
        <div class="text-center">
            <h2 class="text-center">REWARDS & GIFTS</h2>
        </div>
        <div class="container">
            <div class="reward">
                <p><b>Level 1:</b> Direct — Rolex watch; model submariner date two-tone blue . Worth $20,000. Opens up
                    with
                    2 people that invested in 100k package </p>
            </div>
            <div class="reward">
                <p><b>Level 2:</b> Direct — Rolex watch: model submariner date two-tone blue worth $20,000 and all
                    expenses
                    paid
                    trip to Dubai for vacation 14 days trip. Opens up with 4 people that invested in 100k package each
                </p>
            </div>
        </div>
    </section>
    <section class="secondary-brand-text">
        <div class="container">

            <p>
                Become our affiliate user today, and seize limitless opportunities offered by Cobitfx.

                Create your affiliate network by recommending Cobitfx's platform to potential users.
            </p>

            <p>
                The bigger your Affiliate network - the more bonuses and rewards you receive.

                Affiliate program bonuses are distributed from the platform's resources received
                through its operations on the Forex market.</p>
            <p>
                Our platform users are part of the Cobitfx community.
            </p>

        </div>
    </section>
</main>
@endsection
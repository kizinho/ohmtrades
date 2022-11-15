@section('title')
<title>{{ucfirst($settings['site_name'])}} :::EDUCATION</title>
<meta  name="description" content="EDUCATION">
<meta itemprop="keywords" name="keywords" content="{{ucfirst($settings['site_name'])}} - EDUCATION"/>
<meta name="author" content="{{ucfirst($settings['site_name'])}}" />
<style>
    .package-wrapper {
        background: linear-gradient(-45deg,#48350e,#40384a);
        height: 500px;
        width: 100%;
        padding-top: 10px;
        color: white;
        margin-top: 20px;
        box-shadow: 0 10px 10px rgba(0,0,0,.5);

    }

    .briefcase {
        font-size: 50px;
        margin-top: 40px;
        padding-bottom: 10px;
    }

    .package-price {
        font-size: 30px;
        margin-top: 10px;
    }
    .package-list {
        list-style-type: none;
        text-align: center;
        padding-left: 0;
        margin-top: 0;
        margin-bottom: 0;
        padding-top: 10px;
        li {
            margin-left: 0;
            padding: 5px;


        }
    }
    p {
        margin: 0
    }



    li {
        &:before {
            content: "\f046";
            font-family: FontAwesome;
            display: inline-block;
            padding-right: 5px;
        }
        &:nth-child(n+4) {
            &:before {
                content: "\f00d";
                font-family: FontAwesome;
                display: inline-block;
                padding-right: 5px;
            }
        }


    }
</style>
<style>
    h3{
        color : #5ecd67!important
    }
    h4,h5{
        color:#bbc9d5!important
    }
</style>
@endsection
@extends('layouts.app')
@section('sub')
@section('sub')
<div class="banner banner-static">
    <div class="banner-cpn">
        <div class="container">
            <div class="content row">

                <div class="banner-text">
                    <h1 class="page-title">Educational Pack</h1>
                    <p>With our educational pack we gives you the best trading signals and when buy any of our packs.</p>						
                </div>
                <div class="page-breadcrumb">
                    <ul class="breadcrumb">
                        <li><a href="{{url('/')}}">Home</a></li>
                        <li class="active"><span>Educational Pack</span></li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
    <div class="banner-bg imagebg" style="box-shadow:inset 0 0 0 2000px #3c763dad ">
        <img src="frontend/image/banner-inside-a-signal.jpg" alt="" />
    </div>
</div>
@endsection
@section('content')
<div class="section section-contents section-pad"  style="
     background-image: url(frontend/image/back-about.jpg);background-size: cover;box-shadow:inset 0 0 0 2000px #252728b8">
    <div class="container">
        <div class="content col-sm-8 col-sm-offset-2" style="background:#123213ad;color: #fff !important;padding: 16px;border-radius: 8px">
            <p>
            <h3> Affiliate Compensation Plan</h3>
            Every sale of a monthly subscription generates different commissions that are 
            available to Affiliates once the subscription is confirmed. Commission processing is in real time. 
            Per Subscription, there are 1 Direct Commission, 
            7 Indirect Commissions and 1 Top Affiliate Commission.
            The only qualification is to have an active account with Cobitfx.
            Subscription renewals will also pay the same commissions. Commissions are paid in BITCOINS AND ETHEREUM at the stated rate below in USD.
            </p>
  <h3> 
      Direct Commissions</h3>
            <p>
            For each subscription that you sell / refer you receive a 23% commission 
            known as a Direct Commission. You make unlimited first generation sales and referrals. (Unlimited width)
            </p>

            <h3>   Indirect Commissions</h3>
            <p>
            Making a second subscription sale will unlock Levels 2-7 for 8% 
            Indirect Commissions as well as commission compression. Compression occurs when an Affiliate is no longer active.
            We pay the next active Affiliate in the line of sponsorship, effectively paying out all available commissions.
            </p>

            <h3>  Top Affiliate Infinity Bonus</h3>
            <p>
            This bonus commission is paid out to people that qualify by having at 
            least 15 current subscribers that have also enrolled at least 5 subscribers each. 
            </p>
        </div>
    </div>
</div>


@endsection
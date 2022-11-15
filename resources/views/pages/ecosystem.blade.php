@section('title')
<title>{{ucfirst($settings['site_name'])}} :::Ecosystem </title>
<meta  name="description" content=":::Ecosystem">
<meta itemprop="keywords" name="keywords" content="{{ucfirst($settings['site_name'])}} - :::Ecosystem"/>
<meta name="author" content="{{ucfirst($settings['site_name'])}}" />

@endsection
@extends('layouts.app')
@section('sub')
<div class="banner banner-static">
    <div class="banner-cpn">
        <div class="container">
            <div class="content row">

                <div class="banner-text">
                    <h1 class="page-title">Ecosystem</h1>
                    <p>Welcome to our Ecosystem.</p>						
                </div>
                <div class="page-breadcrumb">
                    <ul class="breadcrumb">
                        <li><a href="{{url('/')}}">Home</a></li>
                        <li class="active"><span>Ecosystem</span></li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
    <div class="banner-bg imagebg" style="box-shadow:inset 0 0 0 2000px #3c763dad ">
        <img src="frontend/image/banner-inside-a-eco.jpg" alt="" />
    </div>
</div>
@endsection
@section('content')

<div class="section section-contents section-pad">
    <div class="container">
        <div class="content row row-vm">

      <section class="c-section ecosystem-sec mt-6 mt-md-12">
        <div class="container">
          <div class="row ai-c">
               <div class="col-12 col-md-6 mt-6 mt-md-0">
              <h2 class="c-section-title">{{$settings['site_name']}} Blockchain</h2>
              <div class="c-section-content">
                <article class="article">
                  <p>The {{$settings['site_name']}} Blockchain will use distinctive cryptography that is resistant to attacks, even if they are carried out with the use of quantum computing processing power, and will allow avoiding the fundamental security weaknesses of the modern cryptographic methods. A globally integrated network of nodes and consensus mechanism used will ensure the efficiency of transactions performed within the blockchain network</p>
                </article>
              </div>
            </div>
              <div class="col-12 col-md-6"><img class="img-contain" src="frontend/image/block.jpg" style="width:100%;height: 300px" alt=""></div>
           
          </div>
          <br>
          <hr>
          <div class="mt-6 mt-md-12">
            <div class="row ai-c">
              <div class="col-12 col-md-6"><img class="img-contain" src="frontend/image/bank.jpg" style="width:100%;height: 300px" alt=""></div>
              <div class="col-12 col-md-6 mt-6 mt-md-0">
                <h2 class="c-section-title">{{$settings['site_name']}} Digital Bank</h2>
                <div class="c-section-content">
                  <article class="article">
                    <p>It is no secret that the future of the financial world lies within complete digitalization of all financial processes, products and services. {{$settings['site_name']}} plans on developing its own Digital Bank based on the {{$settings['site_name']}} Blockchain platform, which will reduce the operational costs of the entire network and set new quality standards for financial services.</p>
                  </article>
                </div>
              </div>
            </div>
          </div>
           <br>
           <hr>
          <div class="mt-6 mt-md-12">
            <div class="row ai-c">
                  <div class="col-12 col-md-6 mt-6 mt-md-0">
                <h2 class="c-section-title">Socio-economic Platform</h2>
                <div class="c-section-content">
                  <article class="article">
                    <p>Thanks to the functionality offered by {{$settings['site_name']}} socio-economic platform, private clients and businesses from any part of the world will be able to maintain transparent terms of cooperation with business partners, and ensure profitability of transactions for the sale and purchase of businesses, goods and services. The platform will allow digitalization of business processes, and also offer decentralized public voting for state, commercial and social management institutions.</p>
                  </article>
                </div>
              </div>
              <div class="col-12 col-md-6 order-md-last"><img class="img-contain" src="frontend/image/so.jpg" style="width:100%;height: 300px" alt=""></div>
            
            </div>
           </div>
    </div>
</section>
                </div>
    </div>   </div>
</section>
@endsection
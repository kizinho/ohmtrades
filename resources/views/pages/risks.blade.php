@section('title')
<title>{{ucfirst($settings['site_name'])}} :::Risk</title>
<meta  name="description" content=":::Risk">
<meta itemprop="keywords" name="keywords" content="{{ucfirst($settings['site_name'])}} - :::Risk"/>
<meta name="author" content="{{ucfirst($settings['site_name'])}}" />
    <link href="{{ asset('frontend/css/risks.css')}}" rel="stylesheet">
@endsection
@extends('layouts.app')
@section('content')
   <div class="c-layout__inner">
        <div class="c-layout__wrapper">
          <main class="c-layout__main" id="main">
<div class="page-content">
              <section class="risks c-section c-section--has-skewed-bg">
                <div class="c-section-skewed-bg-container">
                  <div class="c-section-skewed-bg"></div>
                </div>
                <div class="container relative">
                  <div class="c-section-header">
                    <h1 class="c-page-title roadmap__title">Risk<br>policy</h1>
                  </div>
                  <div class="c-section-content">
                    <div class="risks__items">
                      <div class="risks__sec-wrapper">
                        <div class="risks__sec">
                          <h2 class="risks__subtitle">Operational risk policy</h2>
                          <article class="article">
                            <p><strong>The highest level of security of {{$settings['site_name']}} platform resources is ensured by strict compliance with a set of the following measures:</strong></p>
                            <ul class="c-ul c-ul--circle">
                              <li>The platform's resources allocated towards operations on the cryptocurrency market are under full and direct control of the Risk Management Department;</li>
                              <li>Resources of the platform are deposited on the exchanges' wallets and multi-signature cold storage wallets.</li>
                            </ul>
                            <p><strong>The Compliance and Security Department protects {{$settings['site_name']}} platform resources from any fraud, industrial espionage, and other types of electronic or physical threats or attacks.</strong></p>
                          </article>
                        </div>
                        <div class="risks__sec">
                          <h2 class="risks__subtitle">Trading risk policy</h2>
                          <article class="article">
                            <p>Maintaining high-performance indicators would be impossible without application of the risk policy to all the operation methods used by the {{$settings['site_name']}} platform on the cryptocurrency market.</p>
                            <p>The platform's resources used in active operations are distributed to sub-accounts. The volume of resources allocated towards various algorithmic systems or traditional methods of operations is determined by evaluating the main efficiency KPIs.</p>
                          </article>
                        </div>
                      </div>
                      <div class="risks__sec2">
                        <h2 class="risks__subtitle risks__sec2-title">Risk factors</h2><img class="risks__sec2-icon" src="frontend/img/risks-sec2-icon.png" alt="">
                        <article class="article">
                          <p><strong>Risk is an inseparable part of any business process, and even though {{$settings['site_name']}} is operating within strict guidelines aimed at managing and minimizing the potential risks, {{$settings['site_name']}} platform users should be aware of all the existing risks:</strong></p>
                          <ul class="c-ul c-ul--circle c-ul--mrg">
                            <li>Inherent risk;</li>
                            <li>The risk of impairment of resources;</li>
                            <li>The risk of tighter cryptocurrency assets regulation or restrictions on {{$settings['site_name']}} platform operations by the regulator;</li>
                            <li>The risk of inefficiency or failure of the algorithmic systems;</li>
                            <li>The risk of incompetent internal actions and processes;</li>
                            <li>The risk of unauthorized access to the {{$settings['site_name']}} platform resources by third parties.</li>
                          </ul>
                        </article>
                      </div>
                    </div>
                  </div>
                </div>
              </section>
            </div>
              
          </main>
@endsection
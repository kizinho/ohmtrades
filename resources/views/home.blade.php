  
@extends('layouts.dashboard')
@section('content')
@can('isUser')
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.css'>

<style>
    
    .progress {
        background-color: #36541561!important;
    }
    code {
        color: #39662e!important;
    }
    .progress-bar {

        background-color: #236613!important;

    }
    #news-slider{
        margin-top: 40px;
        margin-bottom: 40px;
    }
    .post-slide{
        background:linear-gradient(#2f621a,#2f621a);
        margin: 20px 15px 20px;
        border-radius: 15px;
        padding-top: 1px;
        box-shadow: 0px 14px 22px -9px #bbcbd8;
    }
    .post-slide .post-img{
        position: relative;
        overflow: hidden;
        border-radius: 10px;
        margin: -12px 15px 8px 15px;
        margin-left: -10px;
    }
    .post-slide .post-img img{
        width: 100%;
        height:130px;
        transform: scale(1,1);
        transition:transform 0.2s linear;
    }
    .post-slide:hover .post-img img{
        transform: scale(1.1,1.1);
    }
    .post-slide .over-layer{
        width:100%;
        height:100%;
        position: absolute;
        top:0;
        left:0;
        opacity:0;
        background: linear-gradient(-45deg, rgba(6,190,244,0.75) 0%, rgba(45,112,253,0.6) 100%);
        transition:all 0.50s linear;
    }
    .post-slide:hover .over-layer{
        opacity:1;
        text-decoration:none;
    }
    .post-slide .over-layer i{
        position: relative;
        top:45%;
        text-align:center;
        display: block;
        color:#fff;
        font-size:25px;
    }
    .post-slide .post-content{
        background:linear-gradient(#2f621a,#2f621a);
        padding: 2px 20px 40px;
        border-radius: 15px;
    }
    .post-slide .post-title a{
        font-size:15px;
        font-weight:bold;
        color:#fff;
        display: inline-block;
        text-transform:uppercase;
        transition: all 0.3s ease 0s;
    }
    .post-slide .post-title a:hover{
        text-decoration: none;
        color:#3498db;
    }
    .post-slide .post-description{
        line-height:24px;
        color:#808080;
        margin-bottom:25px;
    }
    .post-slide .post-date{
        color:#a9a9a9;
        font-size: 14px;
    }
    .post-slide .post-date i{
        font-size:20px;
        margin-right:8px;
        color: #CFDACE;
    }
    .post-slide .read-more{
        padding: 7px 20px;
        float: right;
        font-size: 12px;
        background: linear-gradient(#2f621a,#2f621a);
        color: #ffffff;
        box-shadow: 0px 10px 20px -10px #1376c5;
        border-radius: 25px;
        text-transform: uppercase;
    }
    .post-slide .read-more:hover{
        background: #3498db;
        text-decoration:none;
        color:#fff;
    }
    .owl-controls .owl-buttons{
        text-align:center;
        margin-top:20px;
    }
    .owl-controls .owl-buttons .owl-prev{
        background:linear-gradient(#2f621a,#2f621a);
        position: absolute;
        top:-13%;
        left:15px;
        padding: 0 18px 0 15px;
        border-radius: 50px;
        color:#fff!important;
        box-shadow: 3px 14px 25px -10px #92b4d0;
        transition: background 0.5s ease 0s;
    }
    .owl-controls .owl-buttons .owl-next{
        background:linear-gradient(#2f621a,#2f621a);
        position: absolute;
        top:-13%;
        right: 15px;
        padding: 0 15px 0 18px;
        border-radius: 50px;
        box-shadow: -3px 14px 25px -10px #92b4d0;
        transition: background 0.5s ease 0s;
    }
    .owl-controls .owl-buttons .owl-prev:after,
    .owl-controls .owl-buttons .owl-next:after{
        content:"\f104";
        font-family: FontAwesome;
        color: #333;
        font-size:30px;
    }
    .owl-controls .owl-buttons .owl-next:after{
        content:"\f105";
    }
    @media only screen and (max-width:1280px) {
        .post-slide .post-content{
            padding: 0px 15px 25px 15px;
        }
    }
</style>
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Dashboard</h4>



                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">

                <div class="col-xl-12">
                    <div class="row">
                        <div class="">
                            <input id="inputReferralLink" type="hidden" value="{{url('/')}}/{{Auth::user()->username}}" class="form-control text-center" readonly>
                           
                               <div class="btn btn-primary embd-btn" style="    border: 2px solid #7e7b14!important;
    background-color: #7e7b14!important;
    box-sizing: border-box;float: right">
                                   Affiliate link : {{url('/')}}/{{Auth::user()->username}}</div>
                        </div>
                                               
                        <div class="clearfix"></div>
                        <br><br>
                        <div class="col-md-4">
                            <div class="card mini-stats-wid">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <p class="text-muted fw-medium">Current balance</p>
                                            <h4 class="mb-0"> @if(empty(Auth::user()->earn))
                                                $0.0  USD
                                                @else
                                                ${{number_format(Auth::user()->earn->amount, 2)}} USD
                                                @endif</h4>
                                        </div>

                                        <div class="flex-shrink-0 align-self-center">
                                            <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                                                <span class="avatar-title">
                                                    <i class="fa fa-dollar font-size-24"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card mini-stats-wid">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <p class="text-muted fw-medium">Total profits</p>
                                            <h4 class="mb-0"> ${{number_format($earned + $monthly, 2)}}</h4>
                                        </div>

                                        <div class="flex-shrink-0 align-self-center ">
                                            <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                                <span class="avatar-title">
                                                    <i class="fa fa-box font-size-24"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card mini-stats-wid">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <p class="text-muted fw-medium">Total withdraw</p>
                                            <h4 class="mb-0">${{number_format($completed_withdraw, 2)}}</h4>
                                        </div>

                                        <div class="flex-shrink-0 align-self-center">
                                            <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                                <span class="avatar-title">
                                                    <i class="fa fa-caret-up font-size-24"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->


                </div>
            </div>


            <div class="row">

                <div class="col-xl-12">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card mini-stats-wid">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <p class="text-muted fw-medium">Referral bonus </p>
                                            <h4 class="mb-0"> 
                                                ${{number_format($bonus, 2)}}

                                            </h4>
                                        </div>

                                        <div class="flex-shrink-0 align-self-center">
                                            <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                                                <span class="avatar-title">
                                                    <i class="fa fa-line-chart font-size-24"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card mini-stats-wid">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <p class="text-muted fw-medium">Initial capital</p>
                                            <h4 class="mb-0">@if(empty(Auth::user()->earn))
                                                $0.0  USD
                                                @else
                                                ${{number_format(Auth::user()->earn->initial_capital, 2)}} USD
                                                @endif</h4>
                                        </div>

                                        <div class="flex-shrink-0 align-self-center ">
                                            <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                                <span class="avatar-title">
                                                    <i class="fa fa-dollar font-size-24"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if(!empty($name_ref))
                        <div class="col-md-4">
                            <div class="card mini-stats-wid">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <p class="text-muted fw-medium">Sponsor </p>
                                            <h4 class="mb-0">{{$name_ref->user->first_name}}  {{$name_ref->user->last_name}}</h4>
                                        </div>

                                        <div class="flex-shrink-0 align-self-center">
                                            <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                                <span class="avatar-title">
                                                    <img class="rounded-circle header-profile-user" src="@if(empty($name_ref->user->photo)){{asset('user/img/avatar-default.png')}} @else {{url($name_ref->user->photo)}} @endif"
                                                         alt="sponsor Avatar">
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                         <div class="col-md-4">
                            <div class="card mini-stats-wid">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <p class="text-muted fw-medium"> Vip founder pool </p>
                                            <h4 class="mb-0"> 
                                                ${{number_format($settings['founder_pool'], 2)}}

                                            </h4>
                                        </div>

                                        <div class="flex-shrink-0 align-self-center">
                                            <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                                                <span class="avatar-title">
                                                    <i class="fa fa-percentage font-size-24"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                         @if($paid >=1)
                          <div class="col-md-4">
                            <div class="card mini-stats-wid">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <p class="text-muted fw-medium"> Active/Inactive </p>
                                            <h6 class="mb-0"> 
                                            
                                         
                                           <p>active people referred : {{number_format($direct)}}</p>
                                              
                                                <p> inactive people referred : {{number_format($indirect)}}</p>

                                           
                                               

                                            </h6>
                                        </div>

                                        <div class="flex-shrink-0 align-self-center">
                                            <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                                                <span class="avatar-title">
                                                    <i class="fa fa-box font-size-24"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                         <div class="col-md-4">
                              <a href="{{url('deposits')}}">
                            <div class="card mini-stats-wid">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <p class="text-muted fw-medium">Package </p>
                                            <h4 class="mb-0"> 
                                                 Purchase Package

                                            </h4>
                                        </div>

                                        <div class="flex-shrink-0 align-self-center">
                                            <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                                                <span class="avatar-title">
                                                    <i class="fa fa-link font-size-24"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                              </a>
                        </div>
                        
                        
                        
                        
                    </div>



                </div>
            </div>


            <!-- TradingView Widget BEGIN -->
            <div class="tradingview-widget-container">
                <div class="tradingview-widget-container__widget"></div>
                <div class="tradingview-widget-copyright"></div>
                <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-ticker-tape.js" async>
{
"symbols": [
{
"proName": "FOREXCOM:SPXUSD",
        "title": "S&P 500"
},
{
"proName": "FOREXCOM:NSXUSD",
        "title": "US 100"
},
{
"proName": "FX_IDC:EURUSD",
        "title": "EUR/USD"
},
{
"proName": "BITSTAMP:BTCUSD",
        "title": "Bitcoin"
},
{
"proName": "BITSTAMP:ETHUSD",
        "title": "Ethereum"
}
],
        "showSymbolLogo": true,
        "colorTheme": "dark",
        "isTransparent": false,
        "displayMode": "adaptive",
        "locale": "en"
}
                </script>
            </div>
            <!-- TradingView Widget END -->
            <br>
            <div class="col-md-6 offset-md-3">
                <div class="text-center card" >  
                    <div class="card-body">
                        <h2>Calculate your Profits</h2>
                        <div class="row">
                               <div class="col-md-6 mt-4">
                                <input id="amount_cal" placeholder="enter amount" class="form-control">
                                 <input id="duration" value="2190" type="hidden">
                                <br>
                                <h5> Invested (USD)</h5>
                                <div class="" id="regularFund"><h6>00</h6></div>
                                <hr>
                                <h5> Weekly return</h5>
                                <div class="" id="btc"><h6>00</h6></div>
                             
                             

                               </div>
                            <div class="col-md-6 mt-4">
                                <select class="form-control" id="planSelect">
                                    <option value="" selected disabled>Select plan</option>
                                    @foreach($plans as $key=> $plan)
                                    <option value="{{$plan->id}}">  {{$plan->name}} (${{number_format($plan->min)}} - @if($plan->max == 0)UNLIMITED @else ${{number_format($plan->max)}} @endif)</option>
                                    @endforeach
                                </select>  
                                 <input id="duration" value="2190" type="hidden">
                                <br>
                                <h5> 90 days return <span id="percent">00</span></h5>
                                <div class="" id="returnAmount"><h6>00</h6></div>
                                <hr>
 <h5> Capital returned</h5>
                                <div class="" id="regularFundP"><h6>00</h6></div>
                               
 <hr>
 <h5> Total</h5>
                                <div class="" id="total"><h6>00</h6></div>
                               


                               
                               

                            </div>


                            <div class="text-center">
                                <button class="btn btn-success btn-block mt-3 select_plan">Calculate Now</button>
                            </div>


                        </div>
                    </div>
                </div>
            </div>


            @if($active == true)

            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div id="news-slider" class="owl-carousel">


                            @foreach($signals as $signal)
                            <div class="post-slide">
                                <div class="post-img">
                                    <img src="{{asset($signal->image)}}" alt="">
                                    <a href="{{url('read/'.$signal->slug)}}" class="over-layer"><i class="fa fa-link"></i></a>
                                </div>
                                <div class="post-content">
                                    <h3 class="post-title">
                                        <a href="{{url('read/'.$signal->slug)}}">{{$signal->title}}</a>
                                    </h3>
                                    <span class="post-date"><i class="fa fa-clock-o"></i>{{ date('F d, Y', strtotime($signal->created_at)) }}</span>
                                    <a href="{{url('read/'.$signal->slug)}}" class="read-more">{{$signal->trading_pair}}</a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            @else 
            <div class="col-md-6 offset-md-3">
                <div class="text-center card" >  
                    <div class="card-body">
                        You have not purchased Trading Signal or Renew your Subscription
                        <a href="{{url('account/education-pack')}}"
                           class="nav-link active">Renew/Subscribe Now</a>
                    </div>
                </div>
            </div>
            <br/>
            @endif

            <div class="col-md-12">
                <br>
                <h3>Latest Transactions</h3>
                <div class="row">
                    
                    <div class="col-md-6">
                         <br>
                      <h5>Deposits</h5>   
                        <div class="card mt-2">
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table align-middle table-nowrap results-hi">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">DATE</th>
                                    <th scope="col">AMOUNT</th>
                                    <th scope="col">CURRENCY</th>

                                </tr>
                            </thead>
                            <tbody>
                                @forelse($deposits as $hi)
                                <tr>
                                    <td>
                                        {{ date('F d, Y', strtotime($hi->created_at)) }} {{ date('g:i A', strtotime($hi->created_at)) }}
                                    </td>
                                  
                                    <td>
                                        <p class="text-muted mb-0">${{number_format($hi->amount)}}</p>
                                    </td>

                                    <td>
                                        <p class="text-muted mb-0">{{$hi->usercoin->coin->name }}</p>
                                    </td>

                                  
                                </tr>

                                @endforeach

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
                        
                    </div>   
                    
                    
                         <div class="col-md-6">
                              <br>
                          <h5>Withdrawals</h5> 
                                       <div class="card mt-2">
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table align-middle table-nowrap results-hi">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">DATE</th>
                                    <th scope="col">AMOUNT</th>
                                    <th scope="col">CURRENCY</th>

                                </tr>
                            </thead>
                            <tbody>
                                @forelse($withdraws as $hi)
                                <tr>
                                    <td>
                                        {{ date('F d, Y', strtotime($hi->created_at)) }} {{ date('g:i A', strtotime($hi->created_at)) }}
                                    </td>
                                  
                                    <td>
                                        <p class="text-muted mb-0">${{number_format($hi->amount,2)}}</p>
                                    </td>

                                    <td>
                                        <p class="text-muted mb-0">{{$hi->address_name }}</p>
                                    </td>

                                  
                                </tr>

                                @endforeach

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
                        
                    </div>   
                    
                    
                </div> 
                
                
                 <br>
            </div>

            <div class="col-xl-12">
                <div class="row offset-md-2">
                    <div class="col-md-4">
                        <!-- TradingView Widget BEGIN -->
                        <div class="tradingview-widget-container">
                            <div class="tradingview-widget-container__widget"></div>
                            <div class="tradingview-widget-copyright"> </div>
                            <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-market-overview.js" async>
{
"colorTheme": "dark",
        "dateRange": "12M",
        "showChart": true,
        "locale": "en",
        "largeChartUrl": "",
        "isTransparent": false,
        "showSymbolLogo": true,
        "showFloatingTooltip": false,
        "width": "400",
        "height": "660",
        "plotLineColorGrowing": "rgba(41, 98, 255, 1)",
        "plotLineColorFalling": "rgba(41, 98, 255, 1)",
        "gridLineColor": "rgba(240, 243, 250, 0)",
        "scaleFontColor": "rgba(120, 123, 134, 1)",
        "belowLineFillColorGrowing": "rgba(41, 98, 255, 0.12)",
        "belowLineFillColorFalling": "rgba(41, 98, 255, 0.12)",
        "belowLineFillColorGrowingBottom": "rgba(41, 98, 255, 0)",
        "belowLineFillColorFallingBottom": "rgba(41, 98, 255, 0)",
        "symbolActiveColor": "rgba(41, 98, 255, 0.12)",
        "tabs": [
        {
        "title": "Indices",
                "symbols": [
                {
                "s": "FOREXCOM:SPXUSD",
                        "d": "S&P 500"
                },
                {
                "s": "FOREXCOM:NSXUSD",
                        "d": "US 100"
                },
                {
                "s": "FOREXCOM:DJI",
                        "d": "Dow 30"
                },
                {
                "s": "INDEX:NKY",
                        "d": "Nikkei 225"
                },
                {
                "s": "INDEX:DEU40",
                        "d": "DAX Index"
                },
                {
                "s": "FOREXCOM:UKXGBP",
                        "d": "UK 100"
                }
                ],
                "originalTitle": "Indices"
        },
        {
        "title": "Futures",
                "symbols": [
                {
                "s": "CME_MINI:ES1!",
                        "d": "S&P 500"
                },
                {
                "s": "CME:6E1!",
                        "d": "Euro"
                },
                {
                "s": "COMEX:GC1!",
                        "d": "Gold"
                },
                {
                "s": "NYMEX:CL1!",
                        "d": "Crude Oil"
                },
                {
                "s": "NYMEX:NG1!",
                        "d": "Natural Gas"
                },
                {
                "s": "CBOT:ZC1!",
                        "d": "Corn"
                }
                ],
                "originalTitle": "Futures"
        },
        {
        "title": "Bonds",
                "symbols": [
                {
                "s": "CME:GE1!",
                        "d": "Eurodollar"
                },
                {
                "s": "CBOT:ZB1!",
                        "d": "T-Bond"
                },
                {
                "s": "CBOT:UB1!",
                        "d": "Ultra T-Bond"
                },
                {
                "s": "EUREX:FGBL1!",
                        "d": "Euro Bund"
                },
                {
                "s": "EUREX:FBTP1!",
                        "d": "Euro BTP"
                },
                {
                "s": "EUREX:FGBM1!",
                        "d": "Euro BOBL"
                }
                ],
                "originalTitle": "Bonds"
        },
        {
        "title": "Forex",
                "symbols": [
                {
                "s": "FX:EURUSD"
                },
                {
                "s": "FX:GBPUSD"
                },
                {
                "s": "FX:USDJPY"
                },
                {
                "s": "FX:USDCHF"
                },
                {
                "s": "FX:AUDUSD"
                },
                {
                "s": "FX:USDCAD"
                }
                ],
                "originalTitle": "Forex"
        }
        ]
}
                            </script>
                        </div>
                        <!-- TradingView Widget END -->
                    </div>
                    <div class="col-md-4">
                        <!-- TradingView Widget BEGIN -->
                        <div class="tradingview-widget-container">
                            <div class="tradingview-widget-container__widget"></div>
                            <div class="tradingview-widget-copyright"></div>
                            <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-forex-cross-rates.js" async>
{
"width": 770,
        "height": 400,
        "currencies": [
                "EUR",
                "USD",
                "JPY",
                "GBP",
                "CHF",
                "AUD",
                "CAD",
                "NZD",
                "CNY"
        ],
        "isTransparent": false,
        "colorTheme": "dark",
        "locale": "en"
}
                            </script>
                        </div>
                        <!-- TradingView Widget END -->
                    </div>
                </div>
            </div>








            <!-- end row -->
        </div>
        <!-- container-fluid -->
    </div>
</div>

<!-- End Page-content -->


@endcan

@can('isAdmin') 
<div class="page_title_section dashboard_title">

    <div class="page_header">
        <div class="container">
            <div class="row">

                <div class="col-xl-9 col-lg-7 col-md-7 col-12 col-sm-7">

                    <h1>Dashboard </h1>
                </div>
                <div class="col-xl-3 col-lg-5 col-md-5 col-12 col-sm-5">
                    <div class="sub_title_section">
                        <ul class="sub_title">
                            <li> <a href="{{url('/')}}"> Home </a>&nbsp; / &nbsp; </li>
                            <li>My Dashboard</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('layouts.nav_dashboard')
<!-- Main section Start -->
<div class="l-main mb-5 mt-5">     

    <div class="clearfix"></div>
    <br/>
    <!--  account wrapper start -->
    <div class="account_wrapper float_left mb-5">

        <div class="row">


            <div class="col-md-12 col-lg-12 col-sm-12 col-12">
                <div class="sv_heading_wraper">

                    <h3>Admin Statistics </h3>

                </div>

            </div>
            <div class="col-md-4 col-lg-4 col-xl-3 col-sm-6 col-12">
                <div class="investment_box_wrapper color_1 float_left card-new">
                    <a href="#">
                        <div class="investment_icon_wrapper float_left">
                            <i class="fa fa-money"></i>
                            <h1>All Balance</h1>
                        </div>

                        <div class="invest_details float_left ">
                            <table class="invest_table">
                                <tbody>
                                    <tr>
                                        <td class="invest_td1">Total Balance</td>
                                        <td class="invest_td1"> : {{$all_total_balance}} USD</td>
                                    </tr>


                                </tbody>
                            </table>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-md-4 col-lg-4 col-xl-3 col-sm-6 col-12">
                <div class="investment_box_wrapper color_2 float_left card-new">
                    <a href="{{url('manage-deposit')}}">
                        <div class="investment_icon_wrapper float_left">
                            <i class="fa fa-sort"></i>
                            <h1>Deposits</h1>
                        </div>

                        <div class="invest_details float_left ">
                            <div class="text-center">
                                <a href="{{url('manage-deposit')}}"> view <i class="fa fa-eye"></i></a>
                            </div>
                            <div class="clearfix"></div>
                            <table class="invest_table">
                                <tbody>
                                    <tr>
                                        <td class="invest_td1">Total Deposit</td>
                                        <td class="invest_td1"> : {{number_format($all_total_deposit,2)}} USD</td>
                                    </tr>
                                    <tr>
                                        <td class="invest_td1">Active Deposit</td>
                                        <td class="invest_td1"> : {{number_format($all_active_deposit,2)}} USD</td>
                                    </tr>


                                </tbody>
                            </table>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-md-4 col-lg-4 col-xl-3 col-sm-6 col-12">
                <div class="investment_box_wrapper color_3 float_left card-new">
                    <a href="{{url('users')}}">
                        <div class="investment_icon_wrapper float_left">
                            <i class="fa fa-users"></i>
                            <h1>Users</h1>
                        </div>

                        <div class="invest_details float_left ">
                            <div class="text-center">
                                <a href="{{url('users')}}"> view <i class="fa fa-eye"></i></a>
                            </div>
                            <div class="clearfix"></div>
                            <table class="invest_table">
                                <tbody>
                                    <tr>
                                        <td class="invest_td1">Total Users</td>
                                        <td class="invest_td1"> : {{number_format($users)}}</td>
                                    </tr>


                                </tbody>
                            </table>
                        </div>
                    </a>
                </div>
            </div>


            <div class="col-md-4 col-lg-4 col-xl-3 col-sm-6 col-12">
                <div class="investment_box_wrapper color_4 float_left card-new">
                    <a href="{{url('plan-setting')}}">
                        <div class="investment_icon_wrapper float_left">
                            <i class="fa fa-box"></i>
                            <h1>Plans</h1>
                        </div>

                        <div class="invest_details float_left ">
                            <div class="text-center">
                                <a href="{{url('plan-setting')}}"> view <i class="fa fa-eye"></i></a>
                            </div>
                            <div class="clearfix"></div>
                            <table class="invest_table">
                                <tbody>
                                    <tr>
                                        <td class="invest_td1">Total Plans</td>
                                        <td class="invest_td1"> : {{number_format(count($plans))}}</td>
                                    </tr>


                                </tbody>
                            </table>
                        </div>
                    </a>
                </div>
            </div>



            <div class="col-md-12 col-lg-12 col-sm-12 col-12">
                <div class="sv_heading_wraper">

                    <h3>Deposits Statistics </h3>

                </div>

            </div>




            <div class="col-md-4 col-lg-4 col-xl-3 col-sm-6 col-12">
                <div class="investment_box_wrapper color_5 float_left card-new">
                    <a href="{{url('manage-deposit')}}">
                        <div class="investment_icon_wrapper float_left">
                            <i class="fa fa-line-chart"></i>
                            <h1>Deposits</h1>
                        </div>

                        <div class="invest_details float_left ">
                            <div class="text-center">
                                <a href="{{url('manage-deposit')}}"> view <i class="fa fa-eye"></i></a>
                            </div>
                            <div class="clearfix"></div>
                            <table class="invest_table">
                                <tbody>
                                    <tr>
                                        <td class="invest_td1">Total Deposits</td>
                                        <td class="invest_td1"> : {{number_format($all_deposits)}}</td>
                                    </tr>
                                    <tr>
                                        <td class="invest_td1"><a href="{{url('manage-deposit?type=running')}}">Active Investments</a></td>
                                        <td class="invest_td1"> : {{number_format($active_investment)}}</td>
                                    </tr>
                                    <tr>
                                        <td class="invest_td1"><a href="{{url('manage-deposit?type=completed')}}">Completed Investments</a></td>
                                        <td class="invest_td1"> : {{number_format($completed_investment)}}</td>
                                    </tr>
                                    <tr>
                                        <td class="invest_td1"><a href="{{url('manage-deposit?type=pending')}}">Pending Deposits</a></td>
                                        <td class="invest_td1"> : {{number_format($pending_investment)}}</td>
                                    </tr>
                                    <tr>
                                        <td class="invest_td1"><a href="{{url('manage-deposit?type=confirmed')}}">Confirmed Deposits</a></td>
                                        <td class="invest_td1"> : {{number_format($confirm_investment)}}</td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </a>
                </div>
            </div>


            <div class="col-md-4 col-lg-4 col-xl-3 col-sm-6 col-12">
                <div class="investment_box_wrapper color_6 float_left card-new">
                    <a href="{{url('manage-withdraw')}}">
                        <div class="investment_icon_wrapper float_left">

                            <h1>Payouts</h1>
                        </div>

                        <div class="invest_details float_left ">
                            <div class="text-center">
                                <a href="{{url('manage-withdraw')}}"> view <i class="fa fa-eye"></i></a>
                            </div>
                            <div class="clearfix"></div>
                            <table class="invest_table">
                                <tbody>
                                    <tr>
                                        <td class="invest_td1">Total Payouts</td>
                                        <td class="invest_td1"> : {{number_format($all_withdraws)}}</td>
                                    </tr>
                                    <tr>
                                        <td class="invest_td1"><a href="{{url('manage-withdraw?type=pending')}}">Pending Payouts</a></td>
                                        <td class="invest_td1"> : {{number_format($withdraws_pending)}}</td>
                                    </tr>
                                    <tr>
                                        <td class="invest_td1"><a href="{{url('manage-withdraw?type=completed')}}">Completed Payouts</a></td>
                                        <td class="invest_td1"> : {{number_format($withdraws_complete)}}</td>
                                    </tr>


                                </tbody>
                            </table>
                        </div>
                    </a>
                </div>
            </div>


            <div class="col-12">
                <div class="box">
                    <div class="box-body">
                        <iframe src="https://www.exchangerates.org.uk/widget/ER-LRTICKER.php?w=auto&amp;s=1&amp;mc=GBP&amp;mbg=FFFFFF&amp;bs=no&amp;bc=000044&amp;f=helvetica&amp;fs=11px&amp;fc=000044&amp;lc=19335C&amp;lhc=faa31c&amp;vc=FE9A00&amp;vcu=008000&amp;vcd=FF0000&amp;" width="100%" height="30" frameborder="0" scrolling="no" marginwidth="0" marginheight="0"></iframe>

                    </div>
                </div>
            </div>


            <!--  account wrapper end -->
            <!--  transactions wrapper start -->
            <div class="last_transaction_wrapper float_left">

                <div class="row">

                    <div class="col-md-12 col-lg-12 col-sm-12 col-12">
                        <div class="sv_heading_wraper">

                            <h3>LAST 5 TRANSACTIONS</h3>

                        </div>
                    </div>
                    <div class="crm_customer_table_main_wrapper float_left">
                        <div class="crm_ct_search_wrapper">
                            <div class="crm_ct_search_bottom_cont_Wrapper">
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="tt table datatables cs-table crm_customer_table_inner_Wrapper">
                                <thead>
                                    <tr>
                                        <th class="width_table1">transaction ID</th>
                                        <th class="width_table1">amount (USD)</th>
                                        <th class="width_table1">description</th>
                                        <th class="width_table1">Status</th>
                                        <th class="width_table1">date</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($transactions_admin as $hi)
                                    <tr class="background_white">

                                        <td>
                                            <div class="media cs-media">

                                                <div class="media-body">
                                                    <h5>{{$hi->transaction_id}}</h5>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="pretty p-svg p-curve">USD{{number_format($hi->amount)}}</div>
                                        </td>
                                        <td>
                                            <div class="pretty p-svg p-curve">{{$hi->description}}</div>
                                        </td>

                                        <td>
                                            @if($hi->status == false)
                                            <div class="pretty p-svg p-curve badge deposit_pending">Pending</div>
                                            @else
                                            <div class="pretty p-svg p-curve badge deposit_active">Confirmed</div>
                                            @endif
                                        </td>
                                        <td class="flag">
                                            <div class="pretty p-svg p-curve">{{ date('F d, Y', strtotime($hi->created_at)) }} {{ date('g:i A', strtotime($hi->created_at)) }}</div>
                                        </td>

                                    </tr>
                                    @empty
                                    TRANSACTIONS
                                    @endforelse
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
            <!--  transactions wrapper end -->




        </div>
    </div>

    @endCan 


    @section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.js'></script>
    <script>

                                                                    $('.select_plan').click(function () {
                                                                        var amount = $("#amount_cal").val();
                                                                        var duration = $("#duration").val();
                                                                         var p = $("#planSelect").val();
                                                                        if (!amount) {
                                                                            $("#snackbar_error").html('No amount Entered');
                                                                            messageAlertError();
                                                                            return false;
                                                                        }
                                                                            if (!duration) {
                                                                            $("#snackbar_error").html('No duration selected');
                                                                            messageAlertError();
                                                                            return false;
                                                                        }
                                                                            if (!p) {
                                                                            $("#snackbar_error").html('No plan selected');
                                                                            messageAlertError();
                                                                            return false;
                                                                        }
                                                                        var planID = p;
                                                                        $.ajaxSetup({
                                                                            headers: {
                                                                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                                                            },
                                                                            beforeSend: function () {
                                                                                $("#snackbar_success").html('Calculation in progress please wait');
                                                                                messageAlertSuccess();
                                                                            },
                                                                            complete: function () {
                                                                                $("#snackbar_success").html('Your reward caluclation is ready , you can now pay');
                                                                                messageAlertSuccess();
                                                                            }
                                                                        });
                                                                        if (planID) {
                                                                            $.ajax({
                                                                                type: "GET",
                                                                                url: "{{url('get-coin')}}?amount=" + amount + "&plan_id=" + planID+ "&duration=" + duration,
                                                                                success: function (res) {
                                                                                    if (res) {
                                                                                        if (res['status'] === 401) {
                                                                                            $("#snackbar_error").html(res['message_danger']);
                                                                                            messageAlertError();
                                                                                            return false;
                                                                                        }
                                                                                        $('#plan').val('');
                                                                                        $('#amount').val('');
                                                                                        $('#returnAmount').val('');
                                                                                        $('#regularFund').val('');
                                                                                         $('#regularFundP').val('');
                                                                                        $('#directFund').val('');
                                                                                           $('#total').val('');
                                                                                                $('#percent').val('');
                                                                                        $('#btc').val('');
                                                                                        $('#eth').val('');
                                                                                        $('#direct_bonus').val('');
                                                                                        $("#plan").val($("#plan").val() + res.plan);
                                                                                        $("#amount").val($("#amount").val() + res.amount_cal);
                                                                                        $("#returnAmount").text(res.return);
                                                                                        $("#regularFund").html(res.amount);
                                                                                         $("#regularFundP").html(res.amount);
                                                                                        $("#directFund").html(res.net_profit);
                                                                                        $("#btc").html(res.btc);
                                                                                        $("#eth").html(res.eth);
                                                                                        $('#direct_bonus').html(res.direct_bonus);
                                                                                         $("#total").html(res.total);
                                                                                           $("#percent").html(res.percent);
                                                                                     


                                                                                    } else {
                                                                                        $('#returnAmount').val('');
                                                                                        $('#regularFund').val('');
                                                                                        $('#directFund').val('');
                                                                                        $('#btc').val('');
                                                                                        $('#eth').val('');
                                                                                         $('#regularFundP').val('');
                                                                                        $('#direct_bonus').val('');
                                                                                        $('#plan').val('');
                                                                                        $('#amount').val('');
                                                                                          $('#percent').val('');
                                                                                           $('#total').val('');
                                                                                    }
                                                                                }
                                                                            });
                                                                        } else {
                                                                            $('#returnAmount').val('');
                                                                            $('#regularFund').val('');
                                                                            $('#direct_bonus').val('');
                                                                            $('#directFund').val('');
                                                                            $('#btc').val('');
                                                                             $('#regularFundP').val('');
                                                                            $('#eth').val('');
                                                                            $('#plan').val('');
                                                                               $('#total').val('');
                                                                                 $('#percent').val('');
                                                                            $('#amount').val('');
                                                                        }


                                                                    });



$(document).ready(function () {
$("#news-slider").owlCarousel({
items: 4,
        autoplayTimeout: 10000,
        autoplayHoverPause: false,
        itemsDesktop: [1199, 3],
        itemsDesktopSmall: [980, 2],
        itemsMobile: [600, 1],
        navigation: true,
        navigationText: ["", ""],
        pagination: true,
        autoPlay: true
});
});
 @if($ranking >= 100)
   var poppy = localStorage.getItem('diamond');

if(!poppy){
    function PopUp(){
         swal({
            title: "Congrats",
            html: true,
             buttons: false,
            text: "your new rank is Diamond",
            timer: 10000,
             icon: "success",
        }).then((value) => {
         
        }).catch(swal.noop);
                                            
       localStorage.setItem('diamond','true',(60*24*345));
    }

    setTimeout(function(){
        PopUp();
    },100);

   
  
}
                                              @elseif($ranking >= 50)
             var poppy = localStorage.getItem('super');

if(!poppy){
    function PopUp(){
         swal({
            title: "Congrats",
            html: true,
             buttons: false,
            text: "your new rank is Super Star",
            timer: 10000,
             icon: "success",
        }).then((value) => {
         
        }).catch(swal.noop);
                                            
       localStorage.setItem('super','true',(60*24*345));
    }

    setTimeout(function(){
        PopUp();
    },100);

   
  
}
                                             @elseif($ranking >= 20)
                                           var poppy = localStorage.getItem('boss');

if(!poppy){
    function PopUp(){
         swal({
            title: "Congrats",
            html: true,
             buttons: false,
            text: "your new rank is Boss",
            timer: 10000,
             icon: "success",
        }).then((value) => {
         
        }).catch(swal.noop);
                                            
       localStorage.setItem('boss','true',(60*24*345));
    }

    setTimeout(function(){
        PopUp();
    },100);

   
  
}
                                             @elseif($ranking >= 10)
            var poppy = localStorage.getItem('legend');

if(!poppy){
    function PopUp(){
         swal({
            title: "Congrats",
            html: true,
             buttons: false,
            text: "your new rank is Legend",
            timer: 10000,
             icon: "success",
        }).then((value) => {
         
        }).catch(swal.noop);
                                            
       localStorage.setItem('legend','true',(60*24*345));
    }

    setTimeout(function(){
        PopUp();
    },100);

   
  
}
                                            @elseif($ranking >= 3)
                                          var poppy = localStorage.getItem('founder');

if(!poppy){
    function PopUp(){
         swal({
            title: "Congrats",
            html: true,
             buttons: false,
            text: "your new rank is founder",
            timer: 10000,
             icon: "success",
        }).then((value) => {
         
        }).catch(swal.noop);
                                            
       localStorage.setItem('founder','true',(60*24*345));
    }

    setTimeout(function(){
        PopUp();
    },100);

   
  
}
                                           
                                          @else
                                          
                                            
                                            @endif
       
   
    </script>
    <script>
        $('.embd-btn').click(function () {
            var copyInput = document.getElementById("inputReferralLink");
            copyInput.type = 'text';
            copyInput.select();
            document.execCommand("copy");
            copyInput.type = 'hidden';
            let message = "Referral link Copied Successfully: " + copyInput.value;
            $("#snackbar_success").html(message);
            messageAlertSuccess();
        });

    </script>
    @endsection

    @endsection

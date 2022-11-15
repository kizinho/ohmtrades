@section('title')
<title>{{ucfirst($settings['site_name'])}} &mdash; {{Auth::user()->usernme}} Mailling</title>
<meta  name="description" content="{{Auth::user()->usernme}} Mailling">
<meta itemprop="keywords" name="keywords" content="{{ucfirst($settings['site_name'])}} - {{Auth::user()->usernme}} Mailling"/>
<meta name="author" content="{{ucfirst($settings['site_name'])}}" />

<link rel="stylesheet" href="https://unpkg.com/multiple-select@1.5.2/dist/multiple-select.min.css">

@endsection
@extends('layouts.dashboard')
@section('content')

<div class="page_title_section dashboard_title">

    <div class="page_header">
        <div class="container">
            <div class="row">

                <div class="col-xl-9 col-lg-7 col-md-7 col-12 col-sm-7">

                    <h1>Mailling System
                    </h1>
                </div>
                <div class="col-xl-3 col-lg-5 col-md-5 col-12 col-sm-5">
                    <div class="sub_title_section">
                        <ul class="sub_title">
                            <li> <a href="{{url('/')}}"> Home </a>&nbsp; / &nbsp; </li>
                            <li>Mailling System
                            </li>
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
   
    <!--  deposit wrapper start -->
    <div class="deposit_list_wrapper float_left">

        <div class="row">

            <div class="col-md-12 col-lg-12 col-sm-12 col-12">
                <div class="sv_heading_wraper">

                    <h3>Mailling System
                    </h3>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">

                        <form class="" method="Post" action="{{route('mailing')}}" enctype="multipart/form-data">
                            @csrf    
                             <div class="form-group mb-5">
                                <label class="">Select User</label>

                             <select    class="form-control" name="user_id[]" multiple data-live-search="true">
                                    @foreach($users as $user)
                                    <option value="{{$user->id}}" >  {{$user->first_name}} {{$user->last_name}} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group mb-5">
                                <label>Title</label>
                                <input type="text" name="title"  class="form-control" placeholder="Enter Title">
                            </div>

                            <div class="form-group">
                                <label>Message</label>
                                <textarea  class="form-control" rows="10" name="message"></textarea>
                            </div>
                    </div>
                    <div class="box-footer text-center">
                        <button type="submit" class="btn btn-primary mb-5">Send</button>
                    </div>
                    </form>  





            </div>
        </div>
    </div>
</div>
<!-- /.row -->
</section>
<!-- /.content -->


@section('script')
    <script src="https://unpkg.com/multiple-select@1.5.2/dist/multiple-select.min.js"></script>
  
@endsection




@endsection

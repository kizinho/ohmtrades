@section('title')
<title>{{ucfirst($settings['site_name'])}} &mdash; {{Auth::user()->usernme}} Maintenance mode</title>
<meta  name="description" content="{{Auth::user()->usernme}} Maintenance mode">
<meta itemprop="keywords" name="keywords" content="{{ucfirst($settings['site_name'])}} - {{Auth::user()->usernme}} Maintenance mode"/>
<meta name="author" content="{{ucfirst($settings['site_name'])}}" />

<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />

@endsection
@extends('layouts.dashboard')
@section('content')

<div class="page-content">

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h2 class="page-title">Maintenance Mode</h2>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">

                        <form class="" method="Post" action="{{route('maintenance')}}" enctype="multipart/form-data">
                            @csrf    
                            <input type="hidden" name="ip" value="{{$ip}}"  class="form-control">

                            <div class="box-footer text-center">
                                <button type="submit" class="btn btn-primary mb-5">Off your Website</button>
                            </div>
                        </form>  
                        <form class="" method="Post" action="{{route('maintenance-post')}}" enctype="multipart/form-data">
                            @csrf    

                            <div class="box-footer text-center">
                                <button type="submit" class="btn btn-primary mb-5">On your Website</button>
                            </div>
                        </form>  

                        <!-- /.content -->


                        @section('script')

                        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
                        @endsection




                        @endsection

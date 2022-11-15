
@extends('layouts.dashboard')
@section('content')
  <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 font-size-18">Add Wallet Confirmation</h4>

                                   

                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <img class="mb-4" src="{{asset('frontend/img/success.png')}}" style="width:200px">
                        <!-- end page title -->
                              <h6>We sent you a link to make sure you are the owner , kindly follow the link in your email to complete this action.</h6>
                            <p>We use this to avoid loosing your wallet , check your inbox or spam inbox.</p>
                        </div>
                    </div> <!-- container-fluid -->
                </div>

@endsection


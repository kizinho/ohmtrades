@extends('layouts.dashboard')

@section('content')

<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Fund Deposit</h4>



                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="card">
                        <div class="card-body pt-0 mt-3">

                            <form method="post"action="{{url('account/deposit')}}">
                                @csrf
                                <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected">
                                    <span class="input-group-btn input-group-prepend"><button class="btn btn-info bootstrap-touchspin-down" type="button">Amount</button>
                                    </span><span class="input-group-addon bootstrap-touchspin-prefix input-group-prepend">
                                    </span>
                                    <input data-toggle="touchspin" type="text" name="amount" placeholder="enter amount" class="form-control dd">
                                    <span class="input-group-btn input-group-append"><button class="btn btn-info bootstrap-touchspin-up" type="button">$</button></span>
                                </div>
                                <br>
                                <div class="text-center m-t-5">
                                    <button type="submit" class="btn btn-primary waves-effect waves-light">Deposit</button>
                                </div>
                            </form>





                        </div> 

                    </div> 
                </div></div>

        </div> <!-- container-fluid -->
    </div>   


    @endsection


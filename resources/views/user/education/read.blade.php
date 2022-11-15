
@extends('layouts.dashboard')
@section('content')

<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">
     <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Withdrawal Wallets</h4>



                    </div>
                </div>
            </div>
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">{{ucfirst($signal->title)}}</h4>


                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="pt-3">
                                <div class="row justify-content-center">
                                    <div class="col-xl-8">
                                        <div>
                                            <div class="text-center">
                                                <div class="mb-4">
                                                    <span  class="badge bg-light font-size-12">
                                                        <i class="bx bx-purchase-tag-alt align-middle text-muted me-1"></i> {{$signal->trading_pair}}
                                                    </span>
                                                </div>
                                                <h4>{{ucfirst($signal->title)}}</h4>
                                                <p class="text-muted mb-4"><i class="mdi mdi-calendar me-1"></i>  {{ date('F d, Y', strtotime($signal->created_at)) }}</p>
                                            </div>

                                            <hr>
                                            <div class="text-center">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <div>
                                                            <p class="text-muted mb-2">Categories</p>
                                                            <h5 class="font-size-15">{{$signal->trading_pair}}</h5>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="mt-4 mt-sm-0">
                                                            <p class="text-muted mb-2">Date</p>
                                                            <h5 class="font-size-15">10 Apr, 2020</h5>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="mt-4 mt-sm-0">
                                                            <p class="text-muted mb-2">Post by</p>
                                                            <h5 class="font-size-15">Admin</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>

                                            <div class="my-5">
                                                <img src="{{asset($signal->image)}}" alt="" class="img-thumbnail mx-auto d-block">
                                            </div>

                                            <hr>

                                            <div class="mt-4">
                                                <div class="text-muted font-size-14">
                                                    <p>{!! $signal->content !!}</p>




                                                </div>




                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end card body -->
                    </div>
                    <!-- end card -->
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->

        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->










    @endsection


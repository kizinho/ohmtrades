
@extends('layouts.dashboard')
@section('content')



<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18"> Education Pack</h4>



                    </div>
                </div>
            </div>
            <div class="row">

                @foreach($plans as $key => $plan)
                <div class="col-xl-3 col-md-6">
                    <div class="card plan-box">
                        <div class="card-body p-4">
                            <div class="d-flex">
                                <div class="flex-grow-1 text-center">
                                    <h5>{{$plan->name}}</h5>
                                </div>

                            </div>
                            <div class="py-4">
                                <h2><sup><small>ends</small></sup> in <span class="font-size-10"></span><small>{{$plan->compound->name}}</small></h2>
                            </div>


                            <div class="plan-features mt-1">
                                <p><i class="bx bx-checkbox-square text-info me-2"></i> Unlimited Signals </p>
                                <p><i class="bx bx-checkbox-square text-info me-2"></i> Amount: ${{number_format($plan->amount)}}</p>

                            </div>
                              <form method="post" action="{{route('select-gateway')}}">
                                    @csrf
                                          <input type="hidden" name="type" value="EducationLicense" class="form-control">
                                                <input type="hidden" name="amount" value="{{$plan->amount}}" class="form-control">
                                    <input type="hidden" name="plan" value="{{$plan->id}}">
                            <div class="text-center plan-btn">
                                <button  href="javascript: void(0);" class="btn btn-primary btn-sm waves-effect select_plan waves-light ">Subscribe Now</button>
                            </div>
                              </form>
                        </div>

                    </div>
                </div>
                @endforeach

            </div>   



        </div> <!-- container-fluid -->
    </div>







    @endsection


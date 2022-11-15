
@extends('layouts.dashboard')
@section('content')


<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Referrals</h4>


                    </div>
                </div>
            </div>
            <!-- end page title -->


            <div class="row">

                <div class="col-xl-12">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card mini-stats-wid">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <p class="text-muted pull-left ">Affiliate link</p>

                                            <h4 class="mb-5 mt-5">
                                                <div class="text-center">
                                                    <img  src="        {{$image_qrcode}}"/>
                                                </div>
                                                <div class="text-center mt-4">
                                                    <input id="inputReferralLink" value="{{url('/')}}/{{Auth::user()->username}}" class="form-control text-center" readonly>
                                                    <div class="mt-2">
                                                        <label for="inputReferralLink" style="color:red">Copy</label> 
                                                        <span class="fa fa-copy text-success  embd-btn" style="cursor: pointer; color: green"></span>
                                                    </div>

                                                </div>
                                            </h4>
                                        </div>
                                        <br>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card mini-stats-wid">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <p class="text-muted pull-left ">Total Users Referred</p>

                                            <h4 class="mb-5 mt-5">
                                                <div class="text-center">
                                                    @if(!empty($second_refs))
                                                    @php
                                                    $second = $second_refs->count();
                                                    @endphp
                                                    @else
                                                    @php
                                                    $second = 0;
                                                    @endphp
                                                    @endif
                                                    @if(!empty($third_refs))
                                                    @php
                                                    $third = $third_refs->count();
                                                    @endphp
                                                    @else
                                                    @php
                                                    $third = 0;
                                                    @endphp
                                                    @endif
                                                    @if(!empty($fourth_refs))
                                                    @php
                                                    $fourth = $fourth_refs->count();
                                                    @endphp
                                                    @else
                                                    @php
                                                    $fourth = 0;
                                                    @endphp
                                                    @endif
                                                    @if(!empty($five_refs))
                                                    @php
                                                    $five = $five_refs->count();
                                                    @endphp
                                                    @else
                                                    @php
                                                    $five = 0;
                                                    @endphp
                                                    @endif
                                                    @if(!empty($six_refs))
                                                    @php
                                                    $six = $six_refs->count();
                                                    @endphp
                                                    @else
                                                    @php
                                                    $six = 0;
                                                    @endphp
                                                    @endif
                                                    @if(!empty($seven_refs))
                                                    @php
                                                    $seven = $seven_refs->count();
                                                    @endphp
                                                    @else
                                                    @php
                                                    $seven = 0;
                                                    @endphp
                                                    @endif
                                                     @if(!empty($eight_refs))
                                                    @php
                                                    $eight = $eight_refs->count();
                                                    @endphp
                                                    @else
                                                    @php
                                                    $eight = 0;
                                                    @endphp
                                                    @endif
                                                     @if(!empty($nine_refs))
                                                    @php
                                                    $nine = $nine_refs->count();
                                                    @endphp
                                                    @else
                                                    @php
                                                    $nine = 0;
                                                    @endphp
                                                    @endif
                                                     @if(!empty($ten_refs))
                                                    @php
                                                    $ten = $ten_refs->count();
                                                    @endphp
                                                    @else
                                                    @php
                                                    $ten = 0;
                                                    @endphp
                                                    @endif
                                                    {{number_format($refs->count() + $second + $third+ $fourth + $five+$six+$seven+$eight+$nine+$ten)}}
                                                </div>

                                            </h4>
                                        </div>
                                        <br>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card mini-stats-wid">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <p class="text-muted pull-left ">Earned</p>

                                            <h4 class="mb-5 mt-5">
                                                <div class="text-center">
                                                    ${{number_format($commission,2)}}
                                                </div>

                                            </h4>
                                        </div>
                                        <br>

                                    </div>
                                </div>
                            </div>
                        </div>
<!--                        <div class="col-md-4">
                            <div class="card mini-stats-wid">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            @if($ranking >= 100)
                                            <p class="text-muted pull-left ">Ranked (<i class="fa fa-wallet text-success"></i>&nbsp;Diamond)</p>
                                            <h4 class="mb-5 mt-5">
                                                <div class="text-center">
                                                    ${{number_format(2500,2)}}
                                                </div>

                                            </h4>
                                            @elseif($ranking >= 50)
                                            <p class="text-muted pull-left ">Ranked (<i class="fa fa-bank text-success"></i>&nbsp;Super Star)</p>
                                            <h4 class="mb-5 mt-5">
                                                <div class="text-center">
                                                    ${{number_format(1000,2)}}
                                                </div>

                                            </h4>
                                            @elseif($ranking >= 20)
                                            <p class="text-muted pull-left ">Ranked (<i class="fa fa-handshake-o text-success"></i>&nbsp;Boss)</p>
                                            <h4 class="mb-5 mt-5">
                                                <div class="text-center">
                                                    ${{number_format(300,2)}}
                                                </div>

                                            </h4>
                                            @elseif($ranking >= 10)
                                            <p class="text-muted pull-left ">Ranked (<i class="fa fa-lock text-success"></i>&nbsp;Legend)</p>
                                            <h4 class="mb-5 mt-5">
                                                <div class="text-center">
                                                    ${{number_format(150,2)}}
                                                </div>

                                            </h4>
                                            @elseif($ranking >= 3)
                                            <p class="text-muted pull-left ">Ranked (<i class="fa fa-box text-success"></i>&nbsp;Founder)</p>
                                            <h4 class="mb-5 mt-5">
                                                <div class="text-center">
                                                    ${{number_format(50,2)}}
                                                </div>

                                            </h4>


                                            @else
                                            <p class="text-muted pull-left ">Ranked</p>
                                            <h4 class="mb-5 mt-5">
                                                <div class="text-center">
                                                    ${{number_format(0,2)}}
                                                </div>

                                            </h4>

                                            @endif
                                        </div>
                                        <br>

                                    </div>
                                </div>
                            </div>
                        </div>-->
                    </div>
                </div>
            </div>


            @if(!$refs->isEmpty())     
            <div class="card mt-5">
                <div class="card-body">
                    <h4 class="card-title">Level 1</h4>
                    <div class="table-responsive">
                        <table class="table align-middle table-nowrap">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col" style="width: 70px;">#</th>

                                    <th scope="col">Name</th>
                                    <th scope="col">Active</th>
                                    <th scope="col">Date Joined</th>
                                    <th scope="col">Email</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($refs as $refUser)
                                <tr>
                                    <td>
                                        {{$loop->iteration}}
                                    </td>
                                    @foreach($refUser->userRef as $ref)

                                    <td>
                                        <p class="text-muted mb-0">{{$ref->first_name}} {{$ref->last_name}}</p>
                                    </td>
                                    <td>
                                        @if(empty($ref->activeIn))
                                        <span class="badge badge-pill badge-soft-danger font-size-11">Pending</span>
                                        @else
                                        <span class="badge badge-pill badge-soft-success font-size-11">Active</span>
                                        @endif
                                    </td>

                                    <td>
                                        {{ date('F d, Y', strtotime($ref->created_at)) }} {{ date('g:i A', strtotime($ref->created_at)) }}
                                    </td>
                                     <td>
                                        <p class="text-muted mb-0">{{$ref->email}}</p>
                                    </td>
                                </tr>
                                @endforeach
                                @endforeach

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
            @endif   
            @if(!empty($second_refs))
            @if(!$second_refs->isEmpty())     
            <div class="card mt-5">
                <div class="card-body">
                    <h4 class="card-title">Level 2</h4>
                    <div class="table-responsive">
                        <table class="table align-middle table-nowrap">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col" style="width: 70px;">#</th>

                                    <th scope="col">Name</th>
                                    <th scope="col">Active</th>
                                    <th scope="col">Date Joined</th>
                                    <th scope="col">Email</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($second_refs as $refUser)
                                <tr>
                                    <td>
                                        {{$loop->iteration}}
                                    </td>
                                    @foreach($refUser->userRef as $ref)

                                    <td>
                                        <p class="text-muted mb-0">{{$ref->first_name}} {{$ref->last_name}}</p>
                                    </td>
                                    <td>
                                        @if(empty($ref->activeIn))
                                        <span class="badge badge-pill badge-soft-danger font-size-11">Pending</span>
                                        @else
                                        <span class="badge badge-pill badge-soft-success font-size-11">Active</span>
                                        @endif
                                    </td>

                                    <td>
                                        {{ date('F d, Y', strtotime($ref->created_at)) }} {{ date('g:i A', strtotime($ref->created_at)) }}
                                    </td>
                                       <td>
                                        <p class="text-muted mb-0">{{$ref->email}}</p>
                                    </td>
                                </tr>
                                @endforeach
                                @endforeach

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
            @endif
            @endif   

            @if(!empty($third_refs))
            @if(!$third_refs->isEmpty())     
            <div class="card mt-5">
                <div class="card-body">
                    <h4 class="card-title">Level 3</h4>
                    <div class="table-responsive">
                        <table class="table align-middle table-nowrap">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col" style="width: 70px;">#</th>

                                    <th scope="col">Name</th>
                                    <th scope="col">Active</th>
                                    <th scope="col">Date Joined</th>
                                    <th scope="col">Email</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($third_refs as $refUser)
                                <tr>
                                    <td>
                                        {{$loop->iteration}}
                                    </td>
                                    @foreach($refUser->userRef as $ref)

                                    <td>
                                        <p class="text-muted mb-0">{{$ref->first_name}} {{$ref->last_name}}</p>
                                    </td>
                                    <td>
                                        @if(empty($ref->activeIn))
                                        <span class="badge badge-pill badge-soft-danger font-size-11">Pending</span>
                                        @else
                                        <span class="badge badge-pill badge-soft-success font-size-11">Active</span>
                                        @endif
                                    </td>

                                    <td>
                                        {{ date('F d, Y', strtotime($ref->created_at)) }} {{ date('g:i A', strtotime($ref->created_at)) }}
                                    </td>
                                       <td>
                                        <p class="text-muted mb-0">{{$ref->email}}</p>
                                    </td>
                                </tr>
                                @endforeach
                                @endforeach

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
            @endif
            @endif   

            @if(!empty($fourth_refs))
            @if(!$fourth_refs->isEmpty())     
            <div class="card mt-5">
                <div class="card-body">
                    <h4 class="card-title">Level 4</h4>
                    <div class="table-responsive">
                        <table class="table align-middle table-nowrap">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col" style="width: 70px;">#</th>

                                    <th scope="col">Name</th>
                                    <th scope="col">Active</th>
                                    <th scope="col">Date Joined</th>
                                    <th scope="col">Email</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($fourth_refs as $refUser)
                                <tr>
                                    <td>
                                        {{$loop->iteration}}
                                    </td>
                                    @foreach($refUser->userRef as $ref)

                                    <td>
                                        <p class="text-muted mb-0">{{$ref->first_name}} {{$ref->last_name}}</p>
                                    </td>
                                    <td>
                                        @if(empty($ref->activeIn))
                                        <span class="badge badge-pill badge-soft-danger font-size-11">Pending</span>
                                        @else
                                        <span class="badge badge-pill badge-soft-success font-size-11">Active</span>
                                        @endif
                                    </td>

                                    <td>
                                        {{ date('F d, Y', strtotime($ref->created_at)) }} {{ date('g:i A', strtotime($ref->created_at)) }}
                                    </td>
                                       <td>
                                        <p class="text-muted mb-0">{{$ref->email}}</p>
                                    </td>
                                </tr>
                                @endforeach
                                @endforeach

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
            @endif
            @endif   

            @if(!empty($five_refs))
            @if(!$five_refs->isEmpty())     
            <div class="card mt-5">
                <div class="card-body">
                    <h4 class="card-title">Level 5</h4>
                    <div class="table-responsive">
                        <table class="table align-middle table-nowrap">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col" style="width: 70px;">#</th>

                                    <th scope="col">Name</th>
                                    <th scope="col">Active</th>
                                    <th scope="col">Date Joined</th>
                                    <th scope="col">Email</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($five_refs as $refUser)
                                <tr>
                                    <td>
                                        {{$loop->iteration}}
                                    </td>
                                    @foreach($refUser->userRef as $ref)

                                    <td>
                                        <p class="text-muted mb-0">{{$ref->first_name}} {{$ref->last_name}}</p>
                                    </td>
                                    <td>
                                        @if(empty($ref->activeIn))
                                        <span class="badge badge-pill badge-soft-danger font-size-11">Pending</span>
                                        @else
                                        <span class="badge badge-pill badge-soft-success font-size-11">Active</span>
                                        @endif
                                    </td>

                                    <td>
                                        {{ date('F d, Y', strtotime($ref->created_at)) }} {{ date('g:i A', strtotime($ref->created_at)) }}
                                    </td>
                                       <td>
                                        <p class="text-muted mb-0">{{$ref->email}}</p>
                                    </td>
                                </tr>
                                @endforeach
                                @endforeach

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
            @endif
            @endif

            @if(!empty($six_refs))
            @if(!$six_refs->isEmpty())     
            <div class="card mt-5">
                <div class="card-body">
                    <h4 class="card-title">Level 6</h4>
                    <div class="table-responsive">
                        <table class="table align-middle table-nowrap">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col" style="width: 70px;">#</th>

                                    <th scope="col">Name</th>
                                    <th scope="col">Active</th>
                                    <th scope="col">Date Joined</th>
                                    <th scope="col">Email</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($six_refs as $refUser)
                                <tr>
                                    <td>
                                        {{$loop->iteration}}
                                    </td>
                                    @foreach($refUser->userRef as $ref)

                                    <td>
                                        <p class="text-muted mb-0">{{$ref->first_name}} {{$ref->last_name}}</p>
                                    </td>
                                    <td>
                                        @if(empty($ref->activeIn))
                                        <span class="badge badge-pill badge-soft-danger font-size-11">Pending</span>
                                        @else
                                        <span class="badge badge-pill badge-soft-success font-size-11">Active</span>
                                        @endif
                                    </td>

                                    <td>
                                        {{ date('F d, Y', strtotime($ref->created_at)) }} {{ date('g:i A', strtotime($ref->created_at)) }}
                                    </td>
                                       <td>
                                        <p class="text-muted mb-0">{{$ref->email}}</p>
                                    </td>
                                </tr>
                                @endforeach
                                @endforeach

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
            @endif
            @endif

            @if(!empty($seven_refs))
            @if(!$seven_refs->isEmpty())     
            <div class="card mt-5">
                <div class="card-body">
                    <h4 class="card-title">Level 7</h4>
                    <div class="table-responsive">
                        <table class="table align-middle table-nowrap">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col" style="width: 70px;">#</th>

                                    <th scope="col">Name</th>
                                    <th scope="col">Active</th>
                                    <th scope="col">Date Joined</th>
                                    <th scope="col">Email</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($seven_refs as $refUser)
                                <tr>
                                    <td>
                                        {{$loop->iteration}}
                                    </td>
                                    @foreach($refUser->userRef as $ref)

                                    <td>
                                        <p class="text-muted mb-0">{{$ref->first_name}} {{$ref->last_name}}</p>
                                    </td>
                                    <td>
                                        @if(empty($ref->activeIn))
                                        <span class="badge badge-pill badge-soft-danger font-size-11">Pending</span>
                                        @else
                                        <span class="badge badge-pill badge-soft-success font-size-11">Active</span>
                                        @endif
                                    </td>

                                    <td>
                                        {{ date('F d, Y', strtotime($ref->created_at)) }} {{ date('g:i A', strtotime($ref->created_at)) }}
                                    </td>
                                       <td>
                                        <p class="text-muted mb-0">{{$ref->email}}</p>
                                    </td>
                                </tr>
                                @endforeach
                                @endforeach

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
            @endif
            @endif
            
            
             @if(!empty($eight_refs))
            @if(!$eight_refs->isEmpty())     
            <div class="card mt-5">
                <div class="card-body">
                    <h4 class="card-title">Level 8</h4>
                    <div class="table-responsive">
                        <table class="table align-middle table-nowrap">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col" style="width: 70px;">#</th>

                                    <th scope="col">Name</th>
                                    <th scope="col">Active</th>
                                    <th scope="col">Date Joined</th>
                                    <th scope="col">Email</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($eight_refs as $refUser)
                                <tr>
                                    <td>
                                        {{$loop->iteration}}
                                    </td>
                                    @foreach($refUser->userRef as $ref)

                                    <td>
                                        <p class="text-muted mb-0">{{$ref->first_name}} {{$ref->last_name}}</p>
                                    </td>
                                    <td>
                                        @if(empty($ref->activeIn))
                                        <span class="badge badge-pill badge-soft-danger font-size-11">Pending</span>
                                        @else
                                        <span class="badge badge-pill badge-soft-success font-size-11">Active</span>
                                        @endif
                                    </td>

                                    <td>
                                        {{ date('F d, Y', strtotime($ref->created_at)) }} {{ date('g:i A', strtotime($ref->created_at)) }}
                                    </td>
                                       <td>
                                        <p class="text-muted mb-0">{{$ref->email}}</p>
                                    </td>
                                </tr>
                                @endforeach
                                @endforeach

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
            @endif
            @endif
             @if(!empty($nine_refs))
            @if(!$nine_refs->isEmpty())     
            <div class="card mt-5">
                <div class="card-body">
                    <h4 class="card-title">Level 9</h4>
                    <div class="table-responsive">
                        <table class="table align-middle table-nowrap">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col" style="width: 70px;">#</th>

                                    <th scope="col">Name</th>
                                    <th scope="col">Active</th>
                                    <th scope="col">Date Joined</th>
                                    <th scope="col">Email</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($nine_refs as $refUser)
                                <tr>
                                    <td>
                                        {{$loop->iteration}}
                                    </td>
                                    @foreach($refUser->userRef as $ref)

                                    <td>
                                        <p class="text-muted mb-0">{{$ref->first_name}} {{$ref->last_name}}</p>
                                    </td>
                                    <td>
                                        @if(empty($ref->activeIn))
                                        <span class="badge badge-pill badge-soft-danger font-size-11">Pending</span>
                                        @else
                                        <span class="badge badge-pill badge-soft-success font-size-11">Active</span>
                                        @endif
                                    </td>

                                    <td>
                                        {{ date('F d, Y', strtotime($ref->created_at)) }} {{ date('g:i A', strtotime($ref->created_at)) }}
                                    </td>
                                       <td>
                                        <p class="text-muted mb-0">{{$ref->email}}</p>
                                    </td>
                                </tr>
                                @endforeach
                                @endforeach

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
            @endif
            @endif
             @if(!empty($ten_refs))
            @if(!$ten_refs->isEmpty())     
            <div class="card mt-5">
                <div class="card-body">
                    <h4 class="card-title">Level 10</h4>
                    <div class="table-responsive">
                        <table class="table align-middle table-nowrap">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col" style="width: 70px;">#</th>

                                    <th scope="col">Name</th>
                                    <th scope="col">Active</th>
                                    <th scope="col">Date Joined</th>
                                    <th scope="col">Email</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($ten_refs as $refUser)
                                <tr>
                                    <td>
                                        {{$loop->iteration}}
                                    </td>
                                    @foreach($refUser->userRef as $ref)

                                    <td>
                                        <p class="text-muted mb-0">{{$ref->first_name}} {{$ref->last_name}}</p>
                                    </td>
                                    <td>
                                        @if(empty($ref->activeIn))
                                        <span class="badge badge-pill badge-soft-danger font-size-11">Pending</span>
                                        @else
                                        <span class="badge badge-pill badge-soft-success font-size-11">Active</span>
                                        @endif
                                    </td>

                                    <td>
                                        {{ date('F d, Y', strtotime($ref->created_at)) }} {{ date('g:i A', strtotime($ref->created_at)) }}
                                    </td>
                                       <td>
                                        <p class="text-muted mb-0">{{$ref->email}}</p>
                                    </td>
                                </tr>
                                @endforeach
                                @endforeach

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
            @endif
            @endif
        </div> <!-- container-fluid -->
    </div>


















    @section('script')


    <script>
        $('.embd-btn').click(function () {
            var copyInput = document.getElementById("inputReferralLink");
            copyInput.select();
            document.execCommand("copy");
            let message = "Referral link Copied Successfully: " + copyInput.value;
            $("#snackbar_success").html(message);
            messageAlertSuccess();
        });

    </script>

    @endsection

    @endsection


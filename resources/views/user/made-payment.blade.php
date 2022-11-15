  
@extends('layouts.dashboard')

@section('content')

<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Make Payment</h4>



                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="card">
                <div class="bg-success bg-soft">
                    <div class="row">
                        <div class="col-7">
                            <div class="text-white p-3">
                                <h5 class="text-white">
                                    Pay with  @if($coin->id == 1) Bitcoin @elseif($coin->id == 2) Ethereum @else Usdt @endif</h5>
                                @if($type == "deposit")
                                @elseif($type == "EducationLicense")

                                <p class="text-primary">{{$user_education_license->amount_check}} @if($coin->id == 1) BTC @elseif($coin->id == 2) ETH @else USDT (trc20) @endif </p>
                                @else

                                <p class="text-primary">{{$invest->amount_check}} @if($coin->id == 1) BTC @elseif($coin->id == 2) ETH @else USDT (trc20) @endif </p>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>

                <div class="card-body pt-0 mt-3">
                    <div class="row">
                        <div class="col-xl-6 col-md-6">

                            <img class="img-fluid" src="{{$image_qrcode}}"/>
                        </div>

                        <div class="col-xl-6 col-md-6">
                            <div class="pt-4">

                                @if($type == "deposit")
                                 <div class="mb-2"><small>Transaction #{{$user_money->transaction_id}} created successfully.</small></div>
                                <h5>Transfer <span class="text-success">{{$user_money->amount_check}}</span> @if($coin->id == 1) BTC @elseif($coin->id == 2)  ETH @else USDT (trc20) @endif to the wallet listed below</h5>
                               
                                @elseif($type == "EducationLicense")

                                <div class="mb-2"><small>Transaction #{{$user_education_license->transaction_id}} created successfully.</small></div>
                                <h5>Transfer <span class="text-success">{{$user_education_license->amount_check}}</span> @if($coin->id == 1) BTC @elseif($coin->id == 2)  ETH @else USDT (trc20) @endif to the wallet listed below</h5>
                                @else

                                <div class="mb-2">Transaction #{{$invest->transaction_id}} created successfully.</div>
                                <h5>Transfer <span class="text-success">{{$invest->amount_check}}</span> @if($coin->id == 1) BTC @elseif($coin->id == 2)  ETH @else USDT (trc20) @endif to the wallet listed below</h5>
                                @endif
                                <div class="text-warning"><small>Transaction will be confirmed 3 times in Blockchain.</small></div>

                                <div class="text-danger mb-4"><small>Attention! Blockchain fee is collected while using network.</small></div>
                                <input type="text" id="inputReferralLink" value="{{$sendaddress}}" readonly="" class="form-control font-14">
                                <div class="mt-2 text-center">
                                    <label for="inputReferralLink" style="color:red">Copy</label> 
                                    <span class="fa fa-copy text-success  embd-btn" style="cursor: pointer; color: green"></span>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
<!--
            <hr>
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="card">
                        <div class="card-body pt-0 mt-3">

                            <div class="text-center font-size-16 mb-4">I have made payment fill this form below </div>

                            <form action="{{url('upload-proof')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                @if($type == "EducationLicense")
                                <input  type="hidden" name="amount" value="{{$user_education_license->amount}}" class="form-control">
                                <input  type="hidden" name="plan" value="{{$user_education_license->plan->name}} Pack" class="form-control">
                                <input  type="hidden" name="actions" value="pack" class="form-control">
                                <input  type="hidden" name="id" value="{{$user_education_license->id}}" class="form-control">
                                @elseif($type == "deposit")
                                <input   type="hidden" name="amount" value="{{$user_money->amount}}" class="form-control">
                                <input  type="hidden" name="actions" value="fundDeposit" class="form-control">
                                <input  type="hidden" name="id" value="{{$user_money->id}}" class="form-control">
                                @else
                                <input   type="hidden" name="amount" value="{{$invest->amount}}" class="form-control">
                                <input  type="hidden"  name="plan" value="{{$invest->plan->name}} Plan" class="form-control">
                                <input  type="hidden" name="actions" value="deposit" class="form-control">
                                <input  type="hidden" name="id" value="{{$invest->id}}" class="form-control">
                                @endif
                                <div class="mb-3">
                                    <label class="form-label">Choose file (you can select multiple)</label>

                                    <div class="input-group">
                                        <input  type="file" name="images[]" class="form-control" accept="image/*" multiple />

                                        <span class="input-group-text"><i class="mdi mdi-image"></i></span>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Message</label>

                                    <div class="input-group">
                                        <textarea  type="text" name="message" class="form-control"></textarea>

                                        <span class="input-group-text"><i class="mdi mdi-map-marker"></i></span>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary waves-effect waves-light">Submit now</button>
                                </div>
                            </form>





                        </div> 

                    </div> 
                </div></div>-->



























        </div> <!-- container-fluid -->
    </div>   
    @section('script')


    <script>
        $('.embd-btn').click(function () {
            var copyInput = document.getElementById("inputReferralLink");
            copyInput.select();
            document.execCommand("copy");
            let message = "Address Copied Successfully: " + copyInput.value;
            $("#snackbar_success").html(message);
            messageAlertSuccess();
        });

    </script>

    @endsection



    @endsection

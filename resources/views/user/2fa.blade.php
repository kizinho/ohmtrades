
@extends('layouts.dashboard')
@section('content')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">2factor Authenticator</h4>



                    </div>
                </div>
            </div>
            <div style="text-align: center;">
                <img  src="        {{$image}}"/>

            </div>

            <br/>
            <h3  style="text-align: center">Download Authenticator mobile app from Playstore or IOS store
            </h3>
            <br/>
            <h4 style="text-align: center">Open your 2fa mobile app and scan the code to be able to login with your account next time
            </h4>
            <br/>
            <h4 style="text-align: center">  or </h4>
            <br/>

            <h4 style="text-align: center">  copy below secret code to your 2factor mobile app</h4>
            <br/>
            <div class="box-header with-border">
                <h4 class="box-subtitle">

                    <div class="text-center">
                        <div class="b-profile__item">
                            <input id="inputReferralLink" style="border-radius: 8px;border: 1px solid #ddd; height:40px;background: #ddd;color: #222;width: 50%;text-align: center" value="{{$secret}}" class="js-invest-value " readonly>
                            <div class="mt-2">
                                <label for="inputReferralLink" style="color:red">2factor secret code </label> <span class="fa fa-copy text-success  embd-btn" style="cursor: pointer; color: green"></span>
                            </div>
                        </div>
                    </div>
                </h4>
                <div class="row">
                <div class="col-md-4 offset-md-4">
                    <form action="{{url('2fa/pin')}}" method="post">
                        @csrf


                        <div class="mb-3">
                            <label class="form-label">Enter Pin from app</label>

                            <div class="input-group">
                                <input  type="text" name="pin" class="form-control">

                                <span class="input-group-text"><i class="mdi mdi-key"></i></span>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary waves-effect waves-light">Verify pin</button>
                        </div>
                    </form>
                </div>
            </div>

            </div>

        </div> <!-- container-fluid -->
    </div>




    @section('script')


    <script>
        $('.embd-btn').click(function () {
            var copyInput = document.getElementById("inputReferralLink");
            copyInput.select();
            document.execCommand("copy");
            let message = "2fa secret code Copied Successfully: " + copyInput.value;
            $("#snackbar_success").html(message);
            messageAlertSuccess();
        });

    </script>

    @endsection

    @endsection


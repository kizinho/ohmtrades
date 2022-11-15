@section('title')
<title>{{ucfirst($settings['site_name'])}} &mdash; User Register Account</title>
<meta  name="description" content="User Register Account">
<meta itemprop="keywords" name="keywords" content="{{ucfirst($settings['site_name'])}} - User Register Account"/>
<meta name="author" content="{{ucfirst($settings['site_name'])}}" />
@endsection

@extends('layouts.app')
@section('sub')
<div class="banner banner-static">
    <div class="banner-cpn">
        <div class="container">
            <div class="content row">

                <div class="banner-text">
                    <h1 class="page-title">Create Account</h1>
                    <p>register and activate your account</p>						
                </div>
                <div class="page-breadcrumb">
                    <ul class="breadcrumb">
                        <li><a href="{{url('/')}}">Home</a></li>
                        <li class="active"><span>Create Account</span></li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
    <div class="banner-bg imagebg" style="box-shadow:inset 0 0 0 2000px #3c763dad ">
        <img src="frontend/image/auth.jpg" alt="" />
    </div>
</div>
@endsection
@section('content')

<div class="section section-contents section-contact section-pad" style="
     background-image: url(frontend/image/auth-pad.jpg);background-size: cover;box-shadow:inset 0 0 0 2000px #252728b8;color: #fff!important">
    <div class="container">
        <div class="content row">
            <div class="col-sm-5 col-sm-offset-3">

                <p class="text-center">
                    Already have an account? <a href="{{url('login')}}">Login here</a></p>
             

                <form id="register-user" class="uk-grid uk-form">
                        <div class="form-group row">
                    <div class="form-field col-md-12 form-m-bttm">
                        <input  id="username" type="text" placeholder="Username*" class="form-control required">
                    </div>

                </div> 
                    
                      <div class="form-group row">
                    <div class="form-field col-md-12 form-m-bttm">
                        <input  id="first_name" type="text" placeholder="First Name*" class="form-control required">
                    </div>

                </div>
                
                 <div class="form-group row">
                    <div class="form-field col-md-12 form-m-bttm">
                        <input  id="last_name" type="text" placeholder="Last Name*" class="form-control required">
                    </div>

                </div>
                    
                     <div class="form-group row">
                    <div class="form-field col-md-12 form-m-bttm">
                        <input  id="email" type="email" placeholder="Email*" class="form-control required" autocomplete="off">
                    </div>

                </div> 
                        <div class="form-group row">
                    <div class="form-field col-md-12 form-m-bttm">
                        <input  id="confirm_email" type="email" placeholder="Confirm Email*" class="form-control required" autocomplete="off">
                    </div>

                </div> 
                    <div class="form-group row">
                    <div class="form-field col-md-12 form-m-bttm">
                        <input  id="password" type="password" placeholder="Password*" class="form-control required">
                    </div>

                </div>
                     <div class="form-group row">
                    <div class="form-field col-md-12 form-m-bttm">
                        <input  id="confirm_password" type="password" placeholder="Confirm Password*" class="form-control required">
                    </div>

                </div>
                
                    @if(!empty($name))
                    <div class="text-center">
                        <div class="btn btn-primary" style="    border: 2px solid #7e7b14!important;
    background-color: #7e7b14!important;
    box-sizing: border-box;display: inherit;">Referred by {{$name}}</div>
                </div>
                    <br/>
                    @endif
                    <div id="refresh" class="center">  {!! captcha_img() !!}</div>
                    <br>
                     <div class="form-group row">
                    <div class="form-field col-md-12 form-m-bttm">
                        <input  id="captcha" type="text" placeholder="Enter Code*" class="form-control required">
                    </div>

                </div>
                    <input  id="ref" type="hidden" value="@if(!empty($sponsor)){{$sponsor}}@endif" class="form-control required" readonly>
                  
<!--                   
                    <div class="text-center">

                        <label><input class="" id="check2" type="checkbox"> I Agree to  <a href="{{url('terms-of-use')}}">Terms of Use</a></label>
                    </div>-->

                    <div class="text-center">
                        <button class="btn" id="control" type="submit" name="submit">Register</button>
                        <button class="btn" id="control-name" type="submit" name="submit"  style="display: none">please wait ..</button>


                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@section('script')
<script>
    $('#register-user').submit(function (event) {
        event.preventDefault();
//        var checkbox = document.getElementById("check2");
//        if (checkbox.checked) {
//        } else {
//            $("#snackbar_error").html(" Terms and Conditions must be checked ");
//            messageAlertError();
//            return false;
//        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function () {
                $("#control-name").show();
                $("#control").hide();
            },
            complete: function () {
                $("#control-name").hide();
                $("#control").show();
            }
        });
        jQuery.ajax({
            url: "{{url('/sign-up')}}",
            type: 'POST',
            data: {
                first_name: jQuery('#first_name').val(),
                last_name: jQuery('#last_name').val(),
                email: jQuery('#email').val(),
                password: jQuery('#password').val(),
                confirm_password: jQuery('#confirm_password').val(),
                confirm_email: jQuery('#confirm_email').val(),
                ref: jQuery('#ref').val(),
                username: jQuery('#username').val(),
                captcha: jQuery('#captcha').val()
            },
            success: function (data) {
                if (data.status === 401) {
                    var message = data.message;
                    $("#snackbar_error").html(message);
                    messageAlertError();
                    $("#control").show();
                    $("#refresh").load(window.location.href + " #refresh");
                    return false;
                }
                if (data.status === 422) {
                    var message = data.message;
                    $("#snackbar_error").html(message);
                    messageAlertError();
                    $("#refresh").load(window.location.href + " #refresh");
                    $("#control").show();
                    return false;
                }
                if (data.status === 200) {
                    var message = data.message;
                    $("#snackbar_success").html(message);
                    messageAlertSuccess();
                    window.location.href = "{{url('/office')}}";
                    return false;
                }
            }

        });
    });

</script>

@endsection

@endsection
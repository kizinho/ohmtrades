@section('title')
<title>{{ucfirst($settings['site_name'])}} :::Contact Us</title>
<meta  name="description" content="Contact Us">
<meta itemprop="keywords" name="keywords" content="{{ucfirst($settings['site_name'])}} - Contact Us"/>
<meta name="author" content="{{ucfirst($settings['site_name'])}}" />

@endsection
@extends('layouts.app')
@section('sub')
<div class="banner banner-static">
    <div class="banner-cpn">
        <div class="container">
            <div class="content row">

                <div class="banner-text">
                    <h1 class="page-title">Contact Us</h1>
                    <p>get in touch with us, we are always available</p>						
                </div>
                <div class="page-breadcrumb">
                    <ul class="breadcrumb">
                        <li><a href="{{url('/')}}">Home</a></li>
                        <li class="active"><span>Contact Us</span></li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
    <div class="banner-bg imagebg" style="box-shadow:inset 0 0 0 2000px #3c763dad ">
        <img src="frontend/image/banner-contact.jpg" alt="" />
    </div>
</div>
@endsection
@section('content')




<!-- Content -->
	<div class="section section-contents section-contact section-pad">
		<div class="container">
			<div class="content row">

				<h2 class="heading-lg">Contact Us</h2>
				<div class="contact-content row">
					<div class="drop-message col-md-7 res-m-bttm">
						<form id="contact" class="form-quote">
								<div class="form-group row">
									<div class="form-field col-md-12 form-m-bttm">
                                                                            <input  id="name" type="text" placeholder="Full Name *" class="form-control required">
									</div>
									
								</div>
								<div class="form-group row">
									<div class="form-field col-md-12 form-m-bttm">
                                                                            <input  id="email" type="email" placeholder="Email *" class="form-control required email">
									</div>
									
								</div>
								
								<div class="form-group row">
									<div class="form-field col-md-12">
                                                                            <textarea  id="message" placeholder="Messages *" class="txtarea form-control required"></textarea>
									</div>
								</div>
								<button type="submit" class="btn" id="control">Submit</button>
						<button type="submit" class="btn" id="control-name" style="display:none">Sending ..</button>
						
							</form>
					</div>
					<div class="contact-details col-md-4 col-md-offset-1">
						<ul class="contact-list">
<!--							<li><em class="fa fa-map" aria-hidden="true"></em>
								    <strong> US Address: </strong> <span> 1270 Sixth Avenue, New York, USA.</span>
                                                                 
                                                                    <span>Phone : +447418349729</span>
							</li>
                                                        <li><em class="fa fa-map" aria-hidden="true"></em>
								    <strong> UK Address: </strong><span>
                                                                        22 Bishopsgate, London EC2N 4AJ, United Kingdom</span>
                                                                   
                                                                    <span>Phone : +19175146371</span>
							</li>-->
							
							<li><em class="fa fa-envelope" aria-hidden="true"></em>
								<span>Email : <a href="mailto:{{$settings['site_email']}}">{{$settings['site_email']}}</a></span>
							</li>
							<li>
								<em class="fa fa-clock-o" aria-hidden="true"></em><span>Mon - Fri: 8AM - 7PM </span>
							</li>
						</ul>
					</div>
				</div>

			</div>
		</div>
	</div>
	<!-- End Content -->



@section('script')
<script>

    $('#contact').submit(function (event) {
        event.preventDefault();
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
            url: "{{url('/contact')}}",
            type: 'POST',
            data: {
                name: jQuery('#name').val(),
                email: jQuery('#email').val(),
                action: jQuery('#action').val(),
                message: jQuery('#message').val()


            },
            success: function (data) {
                if (data.status === 401) {
                    var message = data.message;
                    $("#snackbar_error").html(message);
                    messageAlertError();

                    return false;
                }
                if (data.status === 200) {
                    var message = data.message;
                    $("#snackbar_success").html(message);
                    messageAlertSuccess();
                    $("#contact")[0].reset();
                    return false;
                }
            }

        });
    });

</script> 
@endsection
@endsection
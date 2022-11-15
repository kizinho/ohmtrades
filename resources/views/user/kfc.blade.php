@section('title')
<title>{{ucfirst($settings['site_name'])}} &mdash; KYC Verification</title>
<meta  name="description" content=" KYC Verification">
<meta itemprop="keywords" name="keywords" content="{{ucfirst($settings['site_name'])}} -  KYC Verification"/>
<meta name="author" content="{{ucfirst($settings['site_name'])}}" />

@endsection
@extends('layouts.homeuser')
@section('content')

  <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="container-full">
        <!-- Content Header (Page header) -->	 

        <div class="content-wrapper" style="min-height: 661px;">
            <div class="container-full">
                <!-- Content Header (Page header) -->
                <div class="content-header">
                    <span class="d-none d-sm-block"> <br/><br/></span>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="breadcrumb-item active">KYC Verify</li>
                    </ol>
                </div>

                <!-- Main content -->
                <!-- Main content -->
                <section class="content col-md-6 offset-md-3 mt-5">
                   <div class="box">
			<div class="box-header with-border">
			  <h4 class="box-title">KYC Verification</h4>
			  <h6 class="box-subtitle">Submit your ID CARD/PHOTO</h6>
                          @if(!empty(Auth::user()->kyc) && Auth::user()->kyc_status == false)
                          <h4 class="badge badge-sm badge-danger mb-10">In review (Pending)</h4>
                          @else
                           <h4 class="badge badge-sm badge-success mb-10">Verified</h4>
                          @endif
			</div>
			<!-- /.box-header -->
			<div class="box-body">
			  <div class="row">
				<div class="col">
                                    <form  method="post" method="POST" id="p" action="{{route('kyc-status')}}" enctype="multipart/form-data" novalidate="">
					 @csrf  
                                        <div class="row">
						<div class="col-12">						
							
							<div class="form-group">
								<h5>Image Input Field <span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="file" name="file" class="form-control" required accept="image/*"> <div class="help-block"></div></div>
							</div>
							
						</div>
					  </div>
						
						<div class="text-center">
                                                    <button type="submit"  id="sp" class="btn btn-rounded btn-info">Submit</button>
						</div>
					</form>

				</div>
				<!-- /.col -->
			  </div>
			  <!-- /.row -->
			</div>
			<!-- /.box-body -->
		  </div>
            </div>
            <!-- /.row -->
            </section>
            <!-- /.content -->





            @section('script')
<script>
       $('#p').submit(function (event) {
                 let disable = document.getElementById('sp');
                disable.setAttribute('disabled', 'true');
            });

    </script>

            @endsection

            @endsection


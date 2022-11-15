@section('title')
<title>{{ucfirst($settings['site_name'])}} &mdash; Settings</title>
<meta  name="description" content="Settings">
<meta itemprop="keywords" name="keywords" content="{{ucfirst($settings['site_name'])}} - Settings"/>
<meta name="author" content="{{ucfirst($settings['site_name'])}}" />


@endsection
@extends('layouts.dashboard')
@section('content')

<div class="page_title_section dashboard_title">

    <div class="page_header">
        <div class="container">
            <div class="row">

                <div class="col-xl-9 col-lg-7 col-md-7 col-12 col-sm-7">

                    <h1>Basic Settings
                    </h1>
                </div>
                <div class="col-xl-3 col-lg-5 col-md-5 col-12 col-sm-5">
                    <div class="sub_title_section">
                        <ul class="sub_title">
                            <li> <a href="{{url('/')}}"> Home </a>&nbsp; / &nbsp; </li>
                            <li>Basic Settings
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('layouts.nav_dashboard')
<!-- Main section Start -->
<div class="l-main mb-5 mt-5">         
    <div class="clearfix"></div>
    <br/>
    <!--  deposit wrapper start -->
    <div class="deposit_list_wrapper float_left">

        <div class="row">

            <div class="col-md-12 col-lg-12 col-sm-12 col-12">
                <div class="sv_heading_wraper">

                    <h3>Basic Settings
                    </h3>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">

                        <form class="" method="Post" action="{{route('settings')}}" enctype="multipart/form-data">
                            @csrf    
                            <div class="form-group">
                                <label class="active">Site Name</label>
                                <input type="text" name="site_name" value="{{$setting['site_name']}}" class="form-control" placeholder="Enter Site  Name">
                            </div>
                            <div class="form-group">
                                <label class="active">Site Phone Number</label>
                                <input type="text" name="site_phone" value="{{$setting['site_phone']}}" class="form-control" placeholder="Enter Site Phone Number">
                            </div>
                            <div class="form-group">
                                <label class="active">Site Url</label>
                                <input type="text" name="site_url" value="{{$setting['site_url']}}" class="form-control" placeholder="Enter Site Url">
                            </div>
                              <div class="form-group">
                                <label class="active">Referral Bonus Level 1</label>
                                <input type="text" name="level_1" value="{{$setting['level_1']}}" class="form-control" placeholder="Enter Bonus">
                            </div>
                              <div class="form-group">
                                <label class="active">Referral Bonus Level 2</label>
                                <input type="text" name="level_2" value="{{$setting['level_2']}}" class="form-control" placeholder="Enter Bonus">
                            </div>
                             <div class="form-group">
                                <label class="active">Referral Bonus Level 3</label>
                                <input type="text" name="level_3" value="{{$setting['level_3']}}" class="form-control" placeholder="Enter Bonus">
                            </div>
                              <div class="form-group">
                                <label class="active">Time for Make Payment</label>
                                <input type="number" name="time_pay" value="{{$setting['time_pay']}}" class="form-control" placeholder="in Hours">
                            </div>
                              <div class="form-group">
                                <label class="active">Level 1 Education Pack Referral Bonus</label>
                                <input type="text" name="level_eduction_license_1" value="{{$setting['level_eduction_license_1']}}" class="form-control" placeholder="Enter Bonus">
                            </div>
                              <div class="form-group">
                                <label class="active">Level 2 and 7 Education Pack Referral Bonus</label>
                                <input type="text" name="level_eduction_license_2_7" value="{{$setting['level_eduction_license_2_7']}}" class="form-control" placeholder="Enter Bonus">
                            </div>
                            <div class="form-group">
                                <label class="active">Site Email</label>
                                <input type="text" name="site_email" value="{{$setting['site_email']}}" class="form-control" placeholder="Site Email">
                            </div>
                            <div class="form-group">
                                <label class="active">Site Send Notify Email</label>
                                <input type="text" name="send_notify_email" value="{{$setting['send_notify_email']}}" class="form-control" placeholder="site Notify Email">
                            </div>
                            <div class="form-group">
                                <label class="active">Referral Percentage</label>
                                <input type="text" name="ref_percentage" value="{{$setting['ref_percentage']}}" class="form-control" placeholder="Referral Percentage">
                            </div>
                            <div class="form-group">
                                <label class="active">Address</label>
                                <textarea type="text" name="address" class="form-control" placeholder="Address">{{$setting['address']}}</textarea>
                            </div>
                            <div class="form-group">
                                <label class="active">Site Short Code Name</label>
                                <input type="text" name="site_code" value="{{$setting['site_code']}}" class="form-control" placeholder="site short code name">
                            </div>
                            <div class="form-group">
                                <label class="active">Site Location</label>
                                <input type="text" name="location" value="{{$setting['location']}}" class="form-control" placeholder="Location">
                            </div>
                            <div class="form-group">
                                <label class="active">Video Link</label>
                                <input type="text" name="video_link" value="{{$setting['video_link']}}" class="form-control" placeholder="Video Link">
                            </div>
                            <div class="form-group">
                                <label class="active">Site Copy Right Name</label>
                                <input type="text" name="copy_right" value="{{$setting['copy_right']}}" class="form-control" placeholder="Copy Right">
                            </div>
                            <div class="form-group">
                                <label class="active">Deposite Charge</label>
                                <input type="text" name="deposit_investment_charge" value="{{$setting['deposit_investment_charge']}}" class="form-control" placeholder="Deposit Charge">
                            </div>
                            <div class="form-group">
                                <label class="active">Minimum Withdraw</label>
                                <input type="text" name="min_withdraw" value="{{$setting['min_withdraw']}}" class="form-control" placeholder="Minimum Withdraw">
                            </div>
                            <div class="form-group">
                                <label class="active">Withdraw Charge</label>
                                <input type="text" name="withdraw_charge" value="{{$setting['withdraw_charge']}}" class="form-control" placeholder="Withdraw Charge">
                            </div>
                            <div class="form-group">
                                <label class="active">BlockIO Secrent Pin </label>
                                <input type="text" name="block_io_pin" value="{{$setting['block_io_pin']}}" class="form-control" placeholder="Your Blockio Password">
                            </div>

                            <div class="form-group">
                                <img id="footer-logo-img" class="img-center"  style="width:230px;height:60px" src="{{asset($settings['logo']) }}" alt="">
                                <label class="active">Site Logo</label>
                                <input type="file" name="logo"  class="form-control">
                            </div>
                            <div class="form-group">
                                <img id="footer-logo-img" class="img-center"  style="width:230px;height:60px" src="{{asset($settings['favicon']) }}" alt="">
                                <label class="active">Favicon Logo</label>
                                <input type="file" name="favicon"  class="form-control" >
                            </div>
                            <div class="form-group">
                                <label class="">Investment Payment Mode</label>

                                <select  name="mode" class="form-control">
                                    <option value="" selected disabled>Select Mode</option>

                                    <option value="0" {{$setting['investment_payment_mode'] == false ? 'selected' : '' }}> Daily </option>
                                    <option value="1" {{$setting['investment_payment_mode'] == true ? 'selected' : '' }}> Compound Date</option>

                                </select>
                            </div>
                            <div class="form-group">
                                <label class="">Auto Withdraw</label>

                                <select  name="auto_withdraw" class="form-control">
                                    <option value="" selected disabled>Select Mode</option>

                                    <option value="0" {{$setting['auto_withdraw'] == false ? 'selected' : '' }}> Off </option>
                                    <option value="1" {{$setting['auto_withdraw'] == true ? 'selected' : '' }}> On</option>

                                </select>
                            </div>

<!--                            <div class="form-group">
                                <label class="active">Email Template</label>
                                <textarea id="area1" class="form-control" rows="15" name="email_body">{{$setting['email_body']}}</textarea>
                            </div>-->
                    </div>
                    <div class="box-footer text-center">
                        <button type="submit" class="btn btn-success mb-5">Save</button>
                    </div>
                    </form>  



                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->




@endsection


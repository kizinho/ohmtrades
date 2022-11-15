@section('title')
<title>{{ucfirst($settings['site_name'])}} &mdash; Confirm Withdrawal</title>
<meta  name="description" content="Confirm Withdrawal">
<meta itemprop="keywords" name="keywords" content="{{ucfirst($settings['site_name'])}} - Confirm Withdrawal"/>
<meta name="author" content="{{ucfirst($settings['site_name'])}}" />

@endsection
@extends('layouts.dashboard')
@section('content')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Confirm Withdrawal </h4>


                    </div>

                </div>
            </div>
        </div>
        
  

       
        <div class="col-md-6 offset-md-3 ">
            <div class="card">
                   
                        <div class="alert light-warning input-text text-center">
                         
                            <span><span class="deposit_active p-1">Payout charges</span>  <b>{{number_format($settings['withdraw_charge'])}}%</b></span>
                        </div>
                            <div class="table-responsive">
                                <form   method="POST" action="{{route('withdraw-fund')}}" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" value="{{$withdraw['transaction_id']}}" name="transaction_id">
                                    <table class="table table-striped mb-0">
                                        <thead class="thead-light">

                                        </thead>
                                        <tbody>
                                              <tr>
                                                <th>Processing time:</th>
                                                <td>1-2 working days</td>
                                            </tr>
                                      
                                           <tr>
                                                <th>Account:</th>
                                                <td>       <span class="deposit_active p-1">{{$withdraw['address_name']}}</span> {{$withdraw['address']}}</td>
                                            </tr>
                                             
                                            <tr>
                                                <th>Debit Amount:</th>
                                                <td>${{number_format($withdraw['total_amount'],2)}}</td>
                                            </tr>

                                            <tr>
                                                <th>Payout Fee:</th>
                                                <td>
                                              ${{number_format($withdraw['withdraw_charge'],2)}}
                                                </td>
                                            </tr>

                                            <tr>
                                                <th>Credit Amount:</th>
                                                <td>${{number_format($withdraw['amount'] - $withdraw['withdraw_charge'],2)}}</td>
                                            </tr>
                                           
                                         <tr>

                                                <td colspan="2">
                                                    <div class="text-center">
                                                        <button type="submit" class="btn btn-outline-success mb-5">Confirm</button>
                                                    </div>
                                                </td>

                                            </tr>
                                           
                                        </tbody>
                                    </table>
                                </form>
                            </div>
                        </div><br>




              
                <!-- /.content -->	  
            </div>
        </div>

    </div>
    

        @endsection



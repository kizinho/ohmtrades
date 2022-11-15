@section('title')
<title>{{ucfirst($settings['site_name'])}} &mdash; Manage Education Pack</title>
<meta  name="description" content="Manage Education Pack">
<meta itemprop="keywords" name="keywords" content="{{ucfirst($settings['site_name'])}} - Manage Education Pack"/>
<meta name="author" content="{{ucfirst($settings['site_name'])}}" />


@endsection
@extends('layouts.dashboard')
@section('content')

<div class="page_title_section dashboard_title">

    <div class="page_header">
        <div class="container">
            <div class="row">

                <div class="col-xl-9 col-lg-7 col-md-7 col-12 col-sm-7">

                    <h1>Education Pack Plan
                    </h1>
                </div>
                <div class="col-xl-3 col-lg-5 col-md-5 col-12 col-sm-5">
                    <div class="sub_title_section">
                        <ul class="sub_title">
                            <li> <a href="{{url('/')}}"> Home </a>&nbsp; / &nbsp; </li>
                            <li>Education Pack Plan
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

                    <h3>Education Pack Settings
                    </h3>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <button type="button" class="btn btn-theme btn-circle btn-success" data-toggle="modal" data-target="#modal-default">
                            Add New Education Pack Plan
                        </button>
                        <div class="modal fade" id="modal-default" >
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">

                                    <div class="modal-header ">
                                        <h4 class="modal-title">Add Education Pack Plan</h4>

                                        <button type="button" class="close btn btn-theme  btn-primary" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <div class="modal-body">
                                        <form class="" method="Post" action="{{url('add-eduction-plan-setting')}}" enctype="multipart/form-data">
                                            @csrf    

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="">Education Pack Name</label>
                                                        <input  type=text name=name value="" class="form-control" placeholder="Name" required="required" data-error="Name is required.">
                                                        <div class="help-block with-errors"></div>
                                                    </div>
                                                </div>


                                                <div class="col-md-6">
                                                    <div class="form-group"> 
                                                        <label class="">Amount</label>
                                                        <input  type=number name=amount class="form-control" placeholder="Amount" required="required">
                                                        <div class="help-block with-errors"></div>
                                                    </div>
                                                </div>
                                               

                                              
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <select  name="compound_id" class="form-control">
                                                            <option value="" selected disabled>Select Compound</option>
                                                            @foreach($compounds as $compound)
                                                            <option value="{{$compound->id}}"> {{$compound->name}} </option>
                                                            @endforeach

                                                        </select>
                                                    </div>
                                                </div>

                                                

                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-theme btn-circle btn-primary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-theme btn-circle btn-success">Add</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                        <!-- /.modal -->
                        <div class="clearfix"></div>
                        <br/>
                        <div class="">

                            <!-- right column -->
                            <div class="">
                                <!-- general form elements disabled -->
                                <div class="">

                                    <!-- /.card-header -->
                                    <div class="" style="overflow: auto!important">

                                        <table id="example5" class="table">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Amount</th>
                                                    <th>Compound</th>
                                                    <th>Date Created</th>
                                                
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($plans as $plan)
                                                <tr>
                                                    <td>{{$plan->name}}</td>
                                                    <td> USD{{$plan->amount}}</td>
                                                    <td>{{$plan->compound->name}}</td>
                                                    <td>{{ date('F d, Y', strtotime($plan->created_at)) }}</td>
                                                    <td style='white-space: nowrap'>
                                                        <button type="button" class="btn btn-theme btn-circle btn-success" data-toggle="modal" data-target="#edit{{$plan->id}}">
                                                            <i class="fa fa-edit "></i>
                                                        </button>

                                                        <form  class="deleted" style="display: inline-block!important"  role="form" method="POST"
                                                               action="{{route('delete-eduction-plan-setting',['id'=>$plan->id])}}" >
                                                            @csrf   
                                                            <button type="submit"class="btn btn-theme btn-circle btn-danger">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </form> 

                                                    </td>
                                                </tr>
                                            </tbody>
                                            <div class="modal fade" id="edit{{$plan->id}}">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">

                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Edit Education Pack - {{$plan->name}}</h4>
                                                            <button type="button" class="close btn btn-theme  btn-primary" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>

                                                        <div class="modal-body">
                                                            <form class="" method="Post" action="{{route('edit-eduction-plan-setting',['id'=>$plan->id])}}" enctype="multipart/form-data">
                                                                @csrf  
                                                                <div class="form-group">
                                                                    <label class="active">Name</label>
                                                                    <input type="text" name="name" value="{{$plan->name}}" class="form-control" placeholder="Name">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label class="active">Amount</label>
                                                                    <input type="text" name="amount" value="{{$plan->amount}}" class="form-control" placeholder="Amount">
                                                                </div>
                                                                   
                                                               
                                                                <div class="form-group">
                                                                    <label class="active">Compound</label>

                                                                    <select  name="compound_id" class="form-control">
                                                                        <option value="" selected disabled>Select Compund</option>
                                                                        @foreach($compounds as $compound)
                                                                        <option value="{{$compound->id}}" {{$plan->compound_id == $compound->id ? 'selected' : '' }}> {{$compound->name}} </option>
                                                                        @endforeach



                                                                    </select>
                                                                </div>
                                                                
                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                            <button type="button" class="btn btn-theme btn-circle btn-primary" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-theme btn-circle btn-success">Save</button>
                                                        </div>
                                                        </form>
                                                    </div>
                                                    <!-- /.modal-content -->
                                                </div>
                                                <!-- /.modal-dialog -->
                                            </div>

                                            @empty
                                            <div class="text-center ">
                                                <h5 class="grey-text">No Education Pack created yet.</h5>
                                            </div>

                                            @endforelse
                                            <th>Name</th>
                                            <th>Amount</th>
                                            <th>Compound</th>
                                            <th>Date Created</th>
                                            <th>Actions</th>
                                            </tr>
                                            </tfoot>
                                        </table>

                                        {{$plans->appends($_GET)->links()}}
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                            </div>
                            <!--/.col (right) -->





                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
            </section>
            <!-- /.content -->

        </div>
    </div>



            @endsection



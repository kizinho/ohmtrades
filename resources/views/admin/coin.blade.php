@section('title')
<title>{{ucfirst($settings['site_name'])}} &mdash; Manage Wallet Address</title>
<meta  name="description" content="Manage Wallet Address">
<meta itemprop="keywords" name="keywords" content="{{ucfirst($settings['site_name'])}} -Manage Wallet Address"/>
<meta name="author" content="{{ucfirst($settings['site_name'])}}" />
@endsection
@extends('layouts.dashboard')
@section('content')

<div class="page_title_section dashboard_title">

    <div class="page_header">
        <div class="container">
            <div class="row">

                <div class="col-xl-9 col-lg-7 col-md-7 col-12 col-sm-7">

                    <h1>Wallet Address Settings
                    </h1>
                </div>
                <div class="col-xl-3 col-lg-5 col-md-5 col-12 col-sm-5">
                    <div class="sub_title_section">
                        <ul class="sub_title">
                            <li> <a href="{{url('/')}}"> Home </a>&nbsp; / &nbsp; </li>
                            <li>Wallet Addres Settings
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

                    <h3>Wallet Address Settings
                    </h3>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="">

                            <!-- right column -->
                            <div class="">
                                <!-- general form elements disabled -->
                                <div class="">

                                    <!-- /.card-header -->
                                    <div class="" style="overflow: auto!important">

                                        <table id="example5" class="table ">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Address</th>
                                                    <th>Api Key</th>
                                                    <th>Photo</th>
                                                    <th>Status</th>
                                                    <th>Date Created</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($coins as $coin)
                                                <tr>
                                                    <td>{{$coin->name}}</td>
                                                    <td>{{$coin->address}}</td>
                                                    <td>{{$coin->api_key}}</td>
                                                    <td> <img src="{{asset($coin->photo)}}" align=absmiddle hspace=1 height=17></td>
                                                    <td> 
                                                        @if($coin->status == false)
                                                        <span class="badge badge-sm badge-danger mb-10">Disabled</span>
                                                        @else
                                                        <span class="badge badge-sm badge-success mb-10">Active</span>
                                                        @endif
                                                    </td>

                                                    <td>{{ date('F d, Y', strtotime($coin->created_at)) }}</td>
                                                    <td style='white-space: nowrap'>
                                                        <button type="button" class="btn btn-theme btn-circle btn-success" data-toggle="modal" data-target="#edit{{$coin->id}}">
                                                            <i class="fa fa-edit"></i>
                                                        </button>



                                                    </td>
                                                </tr>
                                            </tbody>
                                            <div class="modal fade" id="edit{{$coin->id}}">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">

                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Edit Coin - {{$coin->name}}</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>

                                                        <div class="modal-body">
                                                            <form class="" method="Post" action="{{route('edit-coin',['id'=>$coin->id])}}" enctype="multipart/form-data">
                                                                @csrf  
                                                                <div class="form-group">
                                                                    <label class="active">Name</label>
                                                                    <input type="text" name="name" value="{{$coin->name}}" class="form-control" placeholder="Name">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="active">Address</label>
                                                                    <input type="text" name="address" value="{{$coin->address}}" class="form-control" placeholder="Address">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="active">Api Key</label>
                                                                    <input type="text" name="api_key" value="{{$coin->api_key}}" class="form-control" placeholder="Enter Api Key">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="active">Status</label>

                                                                    <select  name="status" class="form-control">
                                                                        <option value="" selected disabled>Select Status</option>

                                                                        <option value="0" {{$coin->status == false ? 'selected' : '' }}> Disabled </option>
                                                                        <option value="1" {{$coin->status == true ? 'selected' : '' }}> Active</option>

                                                                    </select>
                                                                </div>
                                                                
                                                                
                                                                <div class="form-group">
                                                                    <label class="active">Photo</label>
                                                                    <img src="{{asset($coin->photo)}}" align=absmiddle hspace=1 height=17>
                                                                    <input type="file" name="photo"  class="form-control">
                                                                </div>
                                                                <!--                                                                <div class="form-group">
                                                                                                                                    <label>Qcode Scan</label>
                                                                                                                                    <img src="{{asset($coin->q_code)}}" align=absmiddle hspace=1 height=17>
                                                                                                                                    <input type="file" name="q_code"  class="form-control">
                                                                                                                                </div>-->


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
                                                <h5 class="grey-text">No Coin created yet.</h5>
                                            </div>

                                            @endforelse
                                            <th>Name</th>
                                            <th>Address</th>
                                            <th>Api Key</th>
                                            <th>Photo</th>
                                            <th>Qcode Scan</th>
                                            <th>Date Created</th>
                                            <th>Actions</th>
                                            </tr>
                                            </tfoot>
                                        </table>

                                        {{$coins->appends($_GET)->links()}}
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



@section('title')
<title>{{ucfirst($settings['site_name'])}} &mdash; Manage Signals</title>
<meta  name="description" content="Manage Signals">
<meta itemprop="keywords" name="keywords" content="{{ucfirst($settings['site_name'])}} - Manage Signals"/>
<meta name="author" content="{{ucfirst($settings['site_name'])}}" />


@endsection
@extends('layouts.dashboard')

<link rel="stylesheet" href="https://cdn.quilljs.com/1.3.6/quill.snow.css" />
<style>
    .nice-select{
        display: none!important
    }
</style>
@section('content')

<div class="page_title_section dashboard_title mb-5">

    <div class="page_header">
        <div class="container">
            <div class="row">

                <div class="col-xl-9 col-lg-7 col-md-7 col-12 col-sm-7">

                    <h1>Send Signals
                    </h1>
                </div>
                <div class="col-xl-3 col-lg-5 col-md-5 col-12 col-sm-5">
                    <div class="sub_title_section">
                        <ul class="sub_title">
                            <li> <a href="{{url('/')}}"> Home </a>&nbsp; / &nbsp; </li>
                            <li>Send Signals
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

                    <h3>Send Signals
                    </h3>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <button type="button" class="btn btn-theme btn-circle btn-success" data-toggle="modal" data-target="#modal-default">
                            Send New Signal
                        </button>
                        <div class="modal fade" id="modal-default" >
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">

                                    <div class="modal-header ">
                                        <h4 class="modal-title">Send New Signal</h4>

                                        <button type="button" class="close btn btn-theme  btn-primary" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <div class="modal-body">
                                        <form class="" method="Post" id="signal">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="">Title</label>
                                                        <input  type=text name=title value="" class="form-control" placeholder="Title" required="required">
                                                        <div class="help-block with-errors"></div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="">Trading Pair</label>
                                                        <input  type=text name=trading_pair value="" class="form-control" placeholder="Trading Pair" required="required" data-error="Trading Pair is required.">
                                                        <div class="help-block with-errors"></div>
                                                    </div>
                                                </div>


                                                <div class="col-md-6">
                                                    <div class="form-group"> 
                                                        <label class="">Image</label>
                                                        <input  type=file name=image class="form-control" placeholder="Image" required="required">
                                                        <div class="help-block with-errors"></div>
                                                    </div>
                                                </div>
                                                <input id="password" type=hidden name=max value="0" class="form-control" placeholder="Max" required="required">



                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="">Analytic Link</label>
                                                        <input type=text class="form-control" size=30 name="analytic_link"  placeholder="Analytic Link">

                                                        <div class="help-block with-errors"></div>
                                                    </div>
                                                </div>


                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="">Content</label>
                                                        <div id="editor" style="height: 250px" >

                                                        </div>
                                                    </div>
                                                </div>



                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-theme btn-circle btn-primary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-theme btn-circle btn-success"  id="control">Send</button>
                                                <button type="submit" class="btn btn-theme btn-circle btn-primary" style="display:none"  id="control-name" >please wait ......</button>
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

                                        <table class="myTable table datatables cs-table crm_customer_table_inner_Wrapper">
                                            <thead>
                                                <tr>
                                                    <th>Title</th>
                                                    <th>Trading Pair</th>
                                                    <th>image</th>
                                                    <th>Analytic Link</th>
                                                    <th>Date Created</th>

                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($signals as $signal)
                                                <tr>
                                                    <td>{{$signal->title}}</td>
                                                    <td>{{$signal->trading_pair}}</td>
                                                    <td><img src="{{asset($signal->image)}}" width="80" height="80"></td>
                                                    <td> {{$signal->analytic_link}}</td>

                                                    <td>{{ date('F d, Y', strtotime($signal->created_at)) }}</td>
                                                    <td style='white-space: nowrap'>
                                                        <a href="{{route('edit-signals-single',['id'=>$signal->id])}}"> <button type="button" class="btn btn-theme btn-circle btn-success">
                                                                <i class="fa fa-edit "></i>
                                                            </button></a>

                                                        <form  class="deleted" style="display: inline-block!important"  role="form" method="POST"
                                                               action="{{route('delete-signals',['id'=>$signal->id])}}" >
                                                            @csrf   
                                                            <button type="submit"class="btn btn-theme btn-circle btn-danger">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </form> 

                                                    </td>
                                                </tr>
                                            </tbody>
                                     

                                            @empty
                                            <div class="text-center ">
                                                <h5 class="grey-text">No Signal created yet.</h5>
                                            </div>

                                            @endforelse
                                            <th>Title</th>
                                            <th>Trading Pair</th>
                                            <th>image</th>
                                            <th>Analytic Link</th>
                                            <th>Date Created</th>

                                            <th>Actions</th>
                                            </tr>
                                            </tfoot>
                                        </table>

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
    @section('script')
   <script src="{{asset('admin/admin/assets/js/vendor/highlight.js')}}"></script>
     <script src="{{asset('admin/admin/assets/js/vendor/quill.min.js')}}"></script>
    <script src="{{asset('admin/admin/assets/js/image-resize.min.js')}}"></script>

    <script>

var quill = new Quill('#editor', {
    theme: 'snow',
    modules: {

        syntax: true,
        imageResize: {
            displaySize: true


        },

        toolbar: [
            [{'header': [1, 2, 3, 4, 5, 6, false]}],
            ['bold', 'italic', 'underline'],
            [{'color': []}, {'background': []}],
            [{'align': []}],
            [{'list': 'ordered'}, {'list': 'bullet'}, 'blockquote'],
            ['link', 'image', 'code-block', 'video'],
            ['clean']
        ]
    }
});

    </script>     
    <script>
        $('form#signal').submit(function (event) {
            event.preventDefault();
            var myEditor = document.querySelector('#editor');
            var html = myEditor.children[0].innerHTML;
            var formData = new FormData($(this)[0]);
            formData.append("content", html);
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
                    $(".modal").hide();
                    $(".modal").removeClass("in");
                    $(".modal-backdrop").remove();
                    $('body').removeClass('modal-open');
                    $('body').css('padding-right', '');
                }
            });
            jQuery.ajax({
                url: "{{url('add-signals')}}",
                type: 'POST',
                data: formData,
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function (responseText) {
                    if (responseText.status === 401) {
                        jQuery.each(responseText.message, function (key, value) {
                            var message = ('' + value + '');
                            $("#snackbar_error").html(message);
                            messageAlertError();
                        });

                        return false;
                    }
                    if (responseText.status === 422) {
                        var message = responseText.message;

                        $("#snackbar_error").html(message);
                        messageAlertError();

                        return false;
                    }
                    if (responseText.status === 412) {
                        var message = responseText.message;

                        $("#snackbar_error").html(message);
                        messageAlertError();

                        return false;
                    }
                    if (responseText.status === 200) {
                        var message = responseText.message;
                        $("#snackbar_success").html(message);
                        messageAlertSuccess();
                        window.location.href = "{{url('/send-signals')}}";
                        return false;
                    }
                }
            });
        });
    </script>
    @endsection

    @endsection



@section('title')
<title>{{ucfirst($settings['site_name'])}} &mdash; Manage {{$signal->trading_pair}}</title>
<meta  name="description" content="Manage {{$signal->trading_pair}}">
<meta itemprop="keywords" name="keywords" content="{{ucfirst($settings['site_name'])}} - Manage {{$signal->trading_pair}}"/>
<meta name="author" content="{{ucfirst($settings['site_name'])}}" />


@endsection
@extends('layouts.dashboard')

<link rel="stylesheet" href="//cdn.quilljs.com/1.3.6/quill.snow.css" />
<style>
    .nice-select{
        display: none!important
    }
</style>
@section('content')

<div class="page_title_section dashboard_title">

    <div class="page_header">
        <div class="container">
            <div class="row">

                <div class="col-xl-9 col-lg-7 col-md-7 col-12 col-sm-7">

                    <h1>{{$signal->title}}
                    </h1>
                </div>
                <div class="col-xl-3 col-lg-5 col-md-5 col-12 col-sm-5">
                    <div class="sub_title_section">
                        <ul class="sub_title">
                            <li> <a href="{{url('/')}}"> Home </a>&nbsp; / &nbsp; </li>
                            <li>{{$signal->title}}
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

                    <h3>{{$signal->trading_pair}}
                    </h3>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">

                        <form class="" method="Post" id="edit" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="{{$signal->id}}" class="form-control">
                            <div class="form-group">
                                <label class="active">Title</label>
                                <input type="text" name="title" value="{{$signal->title}}" class="form-control" placeholder="Title">
                            </div>
                            <br/>
                            <div class="form-group">
                                <label class="active">Trading Pair</label>
                                <input type="text" name="trading_pair" value="{{$signal->trading_pair}}" class="form-control" placeholder="Trading Pair">
                            </div>
                            <br/>
                            <img src="{{asset($signal->image)}}" width="80" height="80">
                            <br/>
                            <div class="form-group">

                                <label class="active">Image</label>
                                <input type="file" name="image"  class="form-control">
                            </div>

                            <div class="form-group">
                                <label class="active">Analytic Link</label>
                                <input type="text" name="analytic_link" value="{{$signal->analytic_link}}" class="form-control" placeholder="Percentage">
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="">Content</label>
                                    <div id="editor" style="height: 250px" >
                                        {!! $signal->content !!}
                                    </div>
                                </div>
                            </div>


                    </div>
                    <div class="modal-footer justify-content-between">
                        <a href="{{url('send-signals')}}"> <button type="button" class="btn btn-theme btn-circle btn-primary">Back</button></a>
                        <button type="submit" class="btn btn-theme btn-circle btn-success"  id="control">Save</button>
                        <button type="submit" class="btn btn-theme btn-circle btn-primary"  id="control-name" style="display:none">please wait ......</button>

                    </div>
                    </form>

                    <div class="clearfix"></div>
                    <br/>

                </div>
            </div>
        </div>
        <!-- /.row -->
        </section>
        <!-- /.content -->

    </div>
</div>
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/10.7.2/highlight.min.js" integrity="sha512-s+tOYYcC3Jybgr9mVsdAxsRYlGNq4mlAurOrfNuGMQ/SCofNPu92tjE7YRZCsdEtWL1yGkqk15fU/ark206YTg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
    $('form#edit').submit(function (event) {
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
            url: "{{url('edit-signals')}}",
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



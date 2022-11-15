
@extends('layouts.dashboard')
@section('content')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Education Signal News</h4>



                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-12 col-lg-12">
                    <div class="card">

                        <div>
                            <div class="row justify-content-center results-hi">
                                <div class="col-xl-8">
                                    <div>


                                        <div class="row mt-4">
                                            @foreach($signals as $signal)
                                            <div class="col-sm-6">
                                                <div class="card p-1 border shadow-none">
                                                    <div class="p-3">
                                                        <h5><a href="{{url('read/'.$signal->slug)}}" class="text-white">{{ucfirst($signal->title)}}</a></h5>
                                                        <p class="text-muted mb-0">   {{ date('F d, Y', strtotime($signal->created_at)) }}</p>
                                                    </div>

                                                    <div class="position-relative">
                                                        <img src="{{asset($signal->image)}}" alt="" class="img-thumbnail">
                                                    </div>

                                                    <div class="p-3">
                                                        <ul class="list-inline">
                                                            <li class="list-inline-item me-3">
                                                                <a href="{{url('read/'.$signal->slug)}}" class="text-muted">
                                                                    <i class="bx bx-purchase-tag-alt align-middle text-muted me-1"></i> {{$signal->trading_pair}}
                                                                </a>
                                                            </li>
                                                           
                                                        </ul>
                                                        <p>{!! $signal->getAbbreviated()  !!}</p>

                                                        <div>
                                                            <a href="{{url('read/'.$signal->slug)}}" class="text-primary">Read more <i class="mdi mdi-arrow-right"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach

                                        </div>
                                        @if($signals->isEmpty())
                                        <div class="text-center">
                                            <h5><span class="text-white">No News at the moment , come back later</span></h5>
                                        </div>
                                        @endif

                                        <hr class="my-4">

                                        <div class="text-center">





                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>

            </div>
            <!-- end row -->

        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->



    @section('script')
    <script type="text/javascript">


        $(window).on('hashchange', function () {
            if (window.location.hash) {
                var page = window.location.hash.replace('#', '');
                if (page === Number.NaN || page <= 0) {
                    return false;
                }
            }
        });


        $(document).on('click', '#pagination-wrapper-hi a', function (e) {
            $('li').removeClass('active');
            $(this).parent('li').addClass('active');
            var page = $(this).attr('href').split('page=')[1];

            e.preventDefault();


            $('.results-hi').load($(this).attr('href') + ' .results-hi');
            $('.pagination-wrapper-hi').load($(this).attr('href') + ' .pagination-wrapper-hi');
            $('html, body').animate({
                scrollTop: $(".page-title-box").offset().top
            });
            location.hash = page;
        });


    </script>


</script>

@endsection

@endsection


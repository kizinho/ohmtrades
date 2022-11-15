
@extends('layouts.dashboard')
@section('content')

<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Education License History</h4>



                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="card mt-5">
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table align-middle table-nowrap results-hi">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col" style="width: 70px;">#</th>
                                    <th scope="col">Transaction ID</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Payment Status</th>
                                    <th scope="col">Signal Status</th>
                                    <th scope="col">Date</th>


                                </tr>
                            </thead>
                            <tbody>
                                @forelse($deposits as $hi)
                                <tr>
                                    <td>
                                        {{$loop->iteration}}
                                    </td>
                                    <td>
                                        <p class="text-muted mb-0">{{$hi->transaction_id}}</p>
                                    </td>
                                    <td>
                                        <p class="text-muted mb-0">{{number_format($hi->amount,2)}} USD</p>
                                    </td>




                                    <td>
                                        @if($hi->status_deposit == false)
                                        <span class="badge badge-pill badge-soft-danger font-size-11">Pending</span>
                                        @else
                                        <span class="badge badge-pill badge-soft-success font-size-11">Completed</span>
                                        @endif
                                    </td>
                                    <td> @if(empty($hi->due_pay))
                                        <span class="badge badge-pill badge-soft-danger font-size-11">not active</span>
                                        @else
                                        <span class="badge badge-pill badge-soft-warning font-size-11">Expired {{$hi->due_pay->diffForHumans()}}</span>
                                        @endif</td>
                                    <td>
                                        {{ date('F d, Y', strtotime($hi->created_at)) }} {{ date('g:i A', strtotime($hi->created_at)) }}
                                    </td>
                                </tr>

                                @endforeach

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

            <div class="pagination-wrapper-hi" id="pagination-wrapper-hi">

                {{ $deposits->links('vendor.pagination.custom') }}
            </div>


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






@extends('layouts.dashboard')
@section('content')

<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Withdrawal Wallets</h4>



                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="text-center">
                <button type="button" class="btn btn-primary mb-5" data-bs-toggle="modal" data-bs-target="#addWallet"
                        data-bs-whatever="@newWallet">Add New Wallet</button>
       
            
                </div>
            <div class="modal fade" id="addWallet" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="background-color:rgb(13 92 19 / 37%)  !important">
                <div class="modal-dialog">
                    <form method="post" action="{{url('confirm-wallet')}}">
                        @csrf 
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Withdrawal Address</h5>
                            </div>
                            <div class="modal-body">

                                <div class="mb-3">
                                    <input type="text" name="address" class="form-control" value="" placeholder="Wallet Address" required="" class="">

                                </div>
                                <div class="mb-3">
                                    <label for="message-text" class="col-form-label">For Automatic Payment:</label>
                                    <select name="preferable" class="form-control">
                                        <option value="" selected disabled>Choose preferred</option>
                                        <option value="1">Yes
                                        </option>
                                        <option value="0">No
                                        </option>

                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="message-text" class="col-form-label">Wallet Type:</label>
                                    <select name="wallet_type" class="form-control" id="id_wallet_type">
                                        <option value="" selected disabled>Choose wallet</option>
                                        @foreach($coinsEnable as $coin_c)
                                        @if(empty($coin_c->usercoinUser))
                                        <option value="{{$coin_c->id}}"> {{$coin_c->name}}
                                        </option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Add Wallet</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div> <!-- end preview-->
    @if(!$user->coin->isEmpty())

    <div class="card mt-5">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table align-middle table-nowrap">
                    <thead class="table-light">
                        <tr>
                            <th scope="col" style="width: 70px;">#</th>

                            <th scope="col">Name</th>
                            <th scope="col">Address</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($user->coin as $coins)
                        <tr>
                            <td>
                                <div>
                                    <a href="/account/remove-withdraw-address/{{$coins->id}}" > <li class="fas fa-remove w-r text-danger"></li> </a> &nbsp; 
                                    <img class="rounded-circle avatar-xs" style="width:30px;height: 30px" src="{{asset($coins->coin->photo)}}" alt="">
                                </div>
                            </td>
                            <td>
                                <p class="text-muted mb-0">@if($coins->coin_id == 1) BTC @else ETH  @endif  wallet</p>
                            </td>
                            <td>
                                <p class="text-muted mb-0">{{$coins->address}}</p>
                            </td>

                            <td>
                                <ul class="list-inline font-size-20 contact-links mb-0">
                                    <li class="list-inline-item px-2">
                                        <div>
                                            <span style="color: red; float: right;font-size: 12px"> @if($coins->preferable == true)
                                                preferable <span class="b-wallet2-label">Yes      <a href="/account/remove/{{$coins->id}}" class="b-wallet2-delete w-p">
                                                        <img src="{{asset('wallet-delete.png')}}" style="width: 20px;height: 20px">
                                                    </a></span>
                                                @else preferable <span class="b-wallet2-label">No   <a href="/account/add/{{$coins->id}}" class="b-wallet2-delete w-p">
                                                        <img src="{{asset('wallet-add.png')}}" style="width: 20px;height: 20px">
                                                    </a></span>  @endif</span>
                                        </div>
                                    </li>
                                    
                                </ul>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>

        </div>
    </div>

    @endif
















</div> <!-- container-fluid -->
</div>










@endsection


@extends('master.main')
@section('content')

<title>Wallet - Squid Market</title>
@include('includes.flash.validation')
@include('includes.flash.success')
@include('includes.flash.error')
<section class="section mt-3 mb-3">
    <div class="container">
        <div class="page-title justify-content-center">
            <h5><img src=<?php echo \App\Tools\Converter::convert_into_base64(
                public_path('img/icons/wallet.png')
            ); ?> width="17px" style="margin-top:-3px"> Wallet</h5>
        </div>
    </div>
</section>

<section class="section mt-0">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-8">

                <div class="pc-tab">
                    <nav>
                        <ul>
                            <li class="tab2 active"><a href="">XMR</a></li>
                            <li class="tab3"><a href="{{ route('exchange') }}">Exchange (Coming Soon)</a></li>
                        </ul>
                    </nav>
                    <section>

                        <div class="tab2 d-block">
                            <div class="wallet-card-group mb-3">
                                <div class="wallet-card">
                                    <p>Balance:</p>
                                    <h3>{{ auth()->user()->balance() }} XMR </h3>
                                </div>
                            </div>

                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-9">
                                            <p class="mb-0">Payment and Withdrawal</p>
                                            <p class="mb-0 fs-6"></p>
                                            <p class="small text-black-50">Paying on Squid Market is made easy. Paying
                                                for new purchases is wallet-less. Refunds, Order credits and Dispute
                                                credits are held in escrow and deposited into the on-market wallet. You
                                                can withdraw those funds here.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <form action="{{ route('post.withdraw') }}" method="post">
                                @csrf
                                <div class="card">
                                    <div class="card-header">Withdraw</div>
                                    <div class="card-body">
                                        <form class="user-form">
                                            <div class="form-group">
                                                <label>Withdrawal Address</label>
                                                <input class="form-control" type="text" id="monero_wallet_address"
                                                    name="monero_wallet_address"
                                                    style="font-family: Courier; font-size: 90%; background-color: #fff; color: #000; font-weight: bold">
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Value (XMR)</label>
                                                        <input class="form-control" type="text" id="value" name="value"
                                                            style="" placeholder="in USD">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>PIN</label>
                                                        <input class="form-control" type="password" id="pin" name="pin"
                                                            maxlength="6" style="">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <button type="submit" class="btn btn-xs btn-primary">Withdraw</a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</section>


@stop
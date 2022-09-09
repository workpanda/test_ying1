<?php namespace App\Tools; ?>
@extends('master.main')
@section('content')

<title>All Orders - Squid Market</title>
@include('includes.flash.validation')
@include('includes.flash.success')
@include('includes.flash.error')
<section class="section mt-3 mb-3">
    <div class="container">
        <div class="page-title justify-content-center">
            <h5><img src=<?php echo Converter::convert_into_base64(
                public_path('img/icons/cart-plus.png')
            ); ?> width="17px" style="margin-top:-3px"> Sale Details</h5>
        </div>
    </div>
</section>

<section class="section mt-0">
    <div class="container">
        <div class="account-card">
            <div class="row">
                <div class="col-md-12 col-lg-2">
                    <ul class="nav nav-account">
                        <li class="nav-item">
                            <a href="{{ route('sales', ['status' => 'all']) }}">
                                <img src=<?php echo Converter::convert_into_base64(
                                    public_path('img/icons/list.png')
                                ); ?> width="16px" style="margin-right:3px"> All
                                Sales({{ $user->sales()->count() }})</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('sales', ['status' => 'purchased']) }}">
                                <img src=<?php echo Converter::convert_into_base64(
                                    public_path('img/icons/money.png')
                                ); ?> width="16px" style="margin-right:3px">Purchased
                                Sales({{$user->totalSales('purchased')}})</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('sales', ['status' => 'shipped']) }}">
                                <img src=<?php echo Converter::convert_into_base64(
                                    public_path('img/icons/shipped.png')
                                ); ?> width="16px" style="margin-right:3px">Shipped
                                Sales({{$user->totalSales('shipped')}})
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('sales', ['status' => 'delivered']) }}">
                                <img src=<?php echo Converter::convert_into_base64(
                                    public_path('img/icons/gift.png')
                                ); ?> width="16px" style="margin-right:3px">Delivered
                                Sales({{$user->totalSales('delivered')}})
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('sales', ['status' => 'disputed']) }}">
                                <img src=<?php echo Converter::convert_into_base64(
                                    public_path('img/icons/dispute.png')
                                ); ?> width="16px" style="margin-right:3px">Disputed
                                Sales({{$user->totalSales('disputed')}})
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('sales', ['status' => 'cancelled']) }}">
                                <img src=<?php echo Converter::convert_into_base64(
                                    public_path('img/icons/cancel.png')
                                ); ?> width="16px" style="margin-right:3px">Canceled
                                Sales({{$user->totalSales('canceled')}})
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-12 col-lg-10">
                    <div class="p-2 h6 fw-bold bg-primary text-white rounded">Ordered ID: {{ $order->id }}</div>

                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-4 mb-3">
                            <div class="h-100">
                                <div class="feature-card border mb-0 h-100">
                                    <div class="feature-media">
                                        <a class="feature-image" href="#">
                                            <img src="{{ asset('img/03.jpg') }}" alt="product"
                                                style="border-radius: 5px">
                                        </a>
                                    </div>
                                    <div class="feature-content">
                                        <p class="mb-0 fw-bold"><img src=<?php echo Converter::convert_into_base64(
                                            public_path(
                                                'img/icons/star-fill-grey.png'
                                            )
                                        ); ?> width="17px" style="margin-top:-3px"> {{ $order->product->name }}
                                            <img src=<?php echo Converter::convert_into_base64(
                                                public_path(
                                                    'img/icons/star-fill-grey.png'
                                                )
                                            ); ?> width="17px" style="margin-top:-3px">
                                        </p>
                                        <span class="mb-0 fw-bold">Order Amount:</span><span>
                                            {{ $order->quantity }}</span><br>
                                        <span class="mb-0 fw-bold">Payment Currency:</span><span>
                                            @if($order->paytype == 'bic') Bitcoin @elseif($order->product->paytype ==
                                            'xmr') XMR @else Bitcoin and XMR @endif</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-3 mb-3">
                            <div class="h-100">
                                <div class="product-card border rounded mb-0 h-100 text-center">
                                    <p class="mb-0 fw-bold">Payment QR-Code:</p>
                                    <img src="{{asset('img/QR.png') }}" alt="qrcode" width="100">
                                    <div class="qr-text mt-3">bc1q8s23wj4tc5cdadsgsk4354nsdnksldklgkjskk7k9</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-3 mb-3">
                            <div class="h-100">
                                <div class="product-card border rounded mb-0 h-100 text-center">
                                    <p class="mb-0 fw-bold">Payment Status: <span class="fw-normal text-danger">Requires
                                            3 Confirmations</span></p>
                                    <img src="{{ asset('img/payment-required.jpg') }}" alt="payment required"
                                        width="100">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-2 mb-3">
                            <p class="fw-bold">Order Status:</p>
                            <label
                                class="@if($order->status=='waiting') order-status-active @else order-status @endif w-100 mb-1">Waiting</label>
                            <label
                                class="@if($order->status=='accepted') order-status-active @else order-status @endif w-100 mb-1">Accepted</label>
                            <label
                                class="@if($order->status=='shipped') order-status-active @else order-status @endif w-100 mb-1">Shipped</label>
                            <label
                                class="@if($order->status=='delivered') order-status-active @else order-status @endif w-100 mb-1">Delivered</label>
                            <label
                                class="@if($order->status=='disputed') order-status-active @else order-status @endif w-100 mb-1">Disputed</label>
                            <label
                                class="@if($order->status=='canceled') order-status-active @else order-status @endif w-100 mb-1">Canceled</label>
                        </div>
                    </div>
                    <hr>

                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-3 mb-3">
                            <p class="fw-bold">Order Actions:</p>
                            <a href="{{ route('newconversation', ['vendor' => $order->buyer->id]) }}"
                                class="btn btn-xs btn-outline-primary w-100 mb-2"><img src=<?php echo Converter::convert_into_base64(
                                    public_path(
                                        'img/icons/messenger-skyblue.png'
                                    )
                                ); ?> width="13px" style="margin-right:3px;margin-top:-3px">
                                Contact Buyer</a>
                            <a href="#" class="btn btn-xs btn-dark w-100 mb-2"><img src=<?php echo Converter::convert_into_base64(
                                public_path('img/icons/emoji.png')
                            ); ?> width="13px" style="margin-top:-3px"> Dispute
                                Not Active</a>
                            @if($order->status=='canceled')
                            <a href="#" class="btn btn-xs btn-dark w-100 mb-2"><img src=<?php echo Converter::convert_into_base64(
                                public_path('img/icons/cancel.png')
                            ); ?> width="13px" style="margin-right:3px;margin-top:-3px"> Cancel
                                Not Active</a>
                            @else
                            <a href="{{ route('post.changeorderstatus', ['order' => $order->id, 'status' => 'cancelled']) }}"
                                class="btn btn-xs btn-outline-danger w-100 mb-0"><img src=<?php echo Converter::convert_into_base64(
                                    public_path('img/icons/x-circle-red.png')
                                ); ?> width="13px" style="margin-right:3px;margin-top:-3px">
                                Cancel Order</a>
                            @endif
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-3 mb-3">
                            <p class="fw-bold">Payment Address:</p>
                            <div class="qr-text">
                                bc1q8s23wj4tc5cdadsgsk4354nsdnksldklgkjskk7k9
                            </div>
                            <p class="mb-0 fw-bold">Amount to Pay:</p>
                            <p class="">0.06449923 <img src="{{ asset('img/XMR2.png') }}" width="18" height="18"
                                    alt="xmr"></p>
                            <p class="mb-0 fw-bold">Amount Received:</p>
                            <p class="">0.00000000 <img src="{{ asset('img/XMR2.png') }}" width="18" height="18"
                                    alt="xmr"></p>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-3 mb-3">
                            <p class="fw-bold">Encrypted Delivery Details:</p>
                            <textarea class="form-control" style="height: 170px;">{{ $order->address }}</textarea>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-3 mb-3">
                            <p class="fw-bold">Your PGP Key:</p>
                            <textarea class="form-control"
                                style="height: 170px;">{{ auth()->user()->pgp_key }}</textarea>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

@stop
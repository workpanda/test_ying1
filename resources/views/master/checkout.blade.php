<?php namespace App\Tools; ?>
@extends('master.main')
@section('content')

<title>Checkout -Squid Market</title>

@include('includes.flash.validation')
@include('includes.flash.success')
@include('includes.flash.error')
<section class="section mt-3 mb-3">
    <div class="container">
        <div class="page-title justify-content-center">
            <h5><img src=<?php echo Converter::convert_into_base64(
                public_path('img/icons/cart-check.png')
            ); ?> width="15px" style="margin-top:-3px"> Checkout</h5>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="account-card">
            <h5 class="account-title">Checkout Details</h5>
            @forelse($products as $product)
            <form method="post" action="{{ route('post.checkout') }}">
                @csrf
                <div class="row">
                    <div class="col-sm-12 col-md-5 col-lg-5 mb-3">
                        <div class="h-100">
                            <div class="feature-card border mb-0">
                                <div class="feature-media">
                                    <a class="feature-image" href="#">
                                        <img src="{{ $product['image'] }}" alt="product" style="border-radius: 5px">
                                    </a>
                                </div>
                                <div class="feature-content">
                                    <p class="mb-0 fw-bold">Products:</p>
                                    <p class="mb-0"><i class="bi-star-fill"></i> {{ $product['product_name'] }} <i
                                            class="bi-star-fill"></i></p>
                                    <span class="mb-0 fw-bold">Order Amount:</span><span>
                                        {{$product['quantity']}}</span><br>
                                    <span class="mb-0 fw-bold">Payment Currency : XMR</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-3 col-lg-3 mb-3">
                        <div class="h-100">
                            <div class="product-card border rounded mb-0 h-100">
                                <span class="mb-0 fw-bold">Product Price:</span><span> {{ \App\Tools\Converter::currencyConverter($product['price'],
                                    auth()->user()->currency, $product['currency']); }}
                                    {{ auth()->user()->currency }}</span>
                                <p class="mb-0 fw-bold">Shipping Price</p>
                                <p class="mb-0">{{ $product['delivery_method'][$product['delivery_method_num']] }}</p>
                                <span class="mb-0 fw-bold">Price Total:</span><span> {{ $product['total'] }}
                                    {{ auth()->user()->currency }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4 col-lg-4 mb-3">
                        <div class="h-100">
                            @if($product['deliveryinfo'] == "")
                            <div
                                class="product-card border rounded d-flex justify-content-center align-items-center h-100 mb-0 pt-5 pb-5">
                                <a href="{{ route('cart') }}" class="badge bg-danger">No delivery instuctions go back to
                                    cart!</a>
                            </div>
                            @else
                            <div class="d-flex flex-column" style="margin-top:-26px">
                                <span style="font-weight:bold;font-size:16px">Address:</span>
                                <textarea class="form-control" name="address"
                                    style="min-height:128px">{{ $product['deliveryinfo'] }}</textarea>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                @empty
                <div>No Checkouts</div>
                @endforelse

                <div class="checkout-charge ms-auto me-0 border">
                    <ul>
                        <li>
                            <span>Total</span>
                            <span>{{ $totalPrice }} {{ auth()->user()->currency }}</span>
                        </li>
                    </ul>
                </div>
                <div class="d-flex align-items-center justify-content-center mt-2">
                    <span>Your Pin : </span>
                    <input type="password" name="pin" placeholder="123456" class="form-control" style="width:300px" />
                </div>
                <div class="checkout-proced mt-3 mb-3">
                    <a href="{{ route('cart') }}" class="btn btn-danger"><img src="{{ 'img/icons/cart-check.png' }}"
                            width="15px" style="margin-top:-3px" /> Return to cart</a>
                </div>
                <div class="checkout-proced mt-3 mb-3">
                    <!-- <label for="toggle-makeorder" class="w-100"> -->
                    <button class="btn btn-success" type="submit"><img src="{{ 'img/icons/dolar-circle.png' }}"
                            width="15px" style="margin-top:-3px" /> Pay
                        with
                        Balance</button>
                    <!-- </label> -->
                </div>
                <div class="checkout-proced mt-3 mb-3">
                    <a href="#" class="btn btn-success"><img src="{{ 'img/icons/dolar-circle.png' }}" width="15px"
                            style="margin-top:-3px" /> Direct Payment</a>
                </div>
            </form>
        </div>
    </div>
</section>

<input type="checkbox" id="toggle-makeorder" />
<div class="makeorder">
    <p class="text-danger text-center fw-bold" style="font-size:20px">Are you sure you want order?</p>
    <hr>
    <form method="post" action="{{ route('post.checkout') }}">
        @csrf
        <div class="row mb-2">
            <div class="col-sm-4">
                Adress:
            </div>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="address" placeholder="Address" />
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-sm-4">
                Pin:
            </div>
            <div class="col-sm-8">
                <input type="password" class="form-control" name="pin" placeholder="123456" />
            </div>
        </div>
        <hr>
        <div class="mt-4 d-flex justify-content-evenly">
            <button class="btn btn-success btn-sm" type="submit">Yes I Want</button>
            <a href="" class="btn btn-danger btn-sm">No I don't Want</a>
        </div>
    </form>
</div>

@stop
@extends('master.main')
@section('content')

<title>Cart - Squid Market</title>

@include('includes.flash.validation')
@include('includes.flash.success')
@include('includes.flash.error')
<section class="section mt-3 mb-3">
    <div class="container">
        <div class="page-title justify-content-center">
            <h5><img src="{{ asset('img/icons/list.png') }}" width="17px" style="margin-top:-3px"> Stimulate |
                {{ $product->name }}</h5>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="alert alert-success text-center" role="alert" style="display: none">
            You have successfully added or changed your shopping cart content
        </div>
        <div class="account-card">
            <div class="row d-flex justify-content-between">
                <div class="col-sm-5 col-md-5 col-lg-5 mb-3">
                    <p class="fw-bold">Product Details</p>
                    <div class="h-100">
                        <div class="feature-card border mb-0 d-flex flex-column">
                            <div class="d-flex justify-content-between w-100">
                                <div style="text-decoration:underline;font-weight:bold;font-size:16px">
                                    {{$product->name}}</div>
                                <div style="font-size:16px">Price:<i
                                        class="text-danger fw-bold">${{ $product->price + $product->ships_price }}</i>
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="feature-media">
                                    <a class="feature-image" href="#">
                                        <img src="{{ $product->image }}" alt="product" style="border-radius: 5px">
                                    </a>
                                </div>
                                <div class="feature-content">
                                    <div class="form-group mb-1" style="position: relative">
                                        <div class="d-flex align-items-center"
                                            style="position: absolute; left: 100px; top: 5px;width:35px;height:35px">
                                            <img src="{{ $product->seller->avatar }}" width="30" height="30" alt="xmr">
                                            <h6>&nbsp;{{ $product->seller->username }}({{ \App\Models\Product::totalfeaturedproductsofseller($product->sller) }})
                                            </h6>
                                        </div>
                                        <input type="text" class="form-control" value="Sold By : " width="100%"
                                            readonly>
                                    </div>
                                    <div class="form-group mb-1 d-flex justify-content-between align-items-center"
                                        style="position: relative">
                                        <h6 style="width:60%">Payment Currency:</h6>
                                        @if($product->paytype== 'xmr')
                                        <img src="{{asset('img/XMR2.png')}}" width="40" height="40" alt="xmr"
                                            style="position: absolute; right: 3px; top: 2px">
                                        @else
                                        <img src="{{asset('img/bitcoin.png')}}" width="40" height="40" alt="xmr"
                                            style="position: absolute; right: 3px; top: 2px">
                                        @endif
                                        <input type="text" class="form-control"
                                            value="{{ $product->paytype == 'xmr' ? 'XMR' : 'BIC' }}" width="70%"
                                            readonly>
                                    </div>
                                    <?php if ($product->type == 'physical') {
                                        $value = 'Physical';
                                    } else {
                                        if ($product->autofilled == '0') {
                                            $value = 'Digital';
                                        } else {
                                            $value = 'Digital | Autodispatch';
                                        }
                                    } ?>
                                    <?php if ($product->paymethod == 'fe') {
                                        $value1 = 'FE';
                                    } else {
                                        $value1 = 'Escrow';
                                    } ?>
                                    <div class="form-group d-flex align-items-center">
                                        <h6 style="width:60%">Product Type:</h6>
                                        <input type="text" class="form-control" value="{{ $value }} | {{ $value1 }}"
                                            readonly>
                                    </div>
                                    <div class="form-group">
                                        <h6>Shipping Price:</h6>
                                        <select class="form-select" selected="" aria-label="select" readonly>
                                            <option value="1" selected="">Normal Letter Mail - Price
                                                ${{ $product->ships_price }} - {{ $product->ships_time }} Days
                                                Average
                                            </option>
                                        </select>
                                    </div>
                                    @php
                                    $from = strtolower($product->ships_from);
                                    $to = strtolower($product->ships_to);
                                    @endphp
                                    <div class="form-group mb-1 d-flex align-items-center" style="position: relative">
                                        <h6 style="width:35%">Shipping Route:</h6>
                                        <img src="https://ipdata.co/flags/{{ $from }}.png" width="30px" alt="Flag"><i
                                            class="bi bi-arrow-right"></i><img
                                            src="https://ipdata.co/flags/{{ $to }}.png" alt="Flag" width="30px">
                                    </div>
                                    <div class="form-group">
                                        <label class="fw-bold">Order Quantity:</label>
                                        <input type="number" class="form-control" placeholder="1" name="quantity"
                                            value="{{ $product->quantity }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3 col-md-3 col-lg-3 mb-3">
                    <p class="fw-bold">Product Description</p>
                    <div class="h-100">
                        <textarea class="form-control" style="height: 360px;" name="deliveryinfo" placeholder=""
                            readonly>{{ $product->description }}</textarea>
                    </div>
                </div>
                <div class="col-sm-3 col-md-3 col-lg-3 mb-3">
                    <p class="fw-bold">Terms and Conditions:</p>
                    <div class="mb-1">
                        <textarea class="form-control" style="height: 240px;" name="deliveryinfo" placeholder=""
                            readonly>{{ $product->conditions }}</textarea>
                    </div>
                    <a href="{{ route('newconversation', ['vendor' => $product->seller->id]) }}"
                        class="btn btn-sm btn-info w-100 mb-1 text-light">
                        <i class="bi-envelope"></i> CONTACT VENDOR
                    </a>
                    <form class="mb-1" method="post"
                        action="{{ route('post.favorites', ['product' => $product->id]) }}">
                        @csrf
                        <button class="p-1 btn btn-success w-100">
                            @if(auth()->user()->isFavorite($product))
                            <img src="{{ asset('img/icons/heart-fill.png') }}" width="13px" style="margin-top:-3px">
                            Remove from Wishlist
                            @else
                            <img src="{{ asset('img/icons/heart.png') }}" width="13px" style="margin-top:-3px"> Add
                            to Wishlist
                            @endif
                        </button>
                    </form>
                    <form method="post" action="{{ route('post.addtocart', ['product' => $product->id]) }}">
                        @csrf
                        <button class="p-1 btn btn-primary w-100"><img src="{{ asset('img/icons/cart.png') }}"
                                width="13px" style="margin-top:-4px"> Add to Cart</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@stop
@extends('master.main')
@section('content')

<title>Detail - Squid Market</title>

@include('includes.flash.validation')
@include('includes.flash.success')
@include('includes.flash.error')
<section class="section mt-3 mb-3">
    <div class="container">
        <div class="page-title justify-content-center">
            <h5><img src="{{ asset('img/icons/star-fill.png') }}" width="18px" /> {{ $product->category->name }} |
                {{ $product->name }} <img src="{{ asset('img/icons/star-fill.png') }}" width="18px" /></h5>
        </div>
    </div>
</section>
<section class="section">
    <div class="container">
        <div class="account-card">
            <div class="row">
                <div class="col-sm-6 col-md-4 col-lg-4 mb-3">
                    <div class="h-100">
                        <h5 class="account-title">Product Description</h5>
                        <textarea class="form-control" style="height: 250px;" readonly>
                        {{ $product->description }}
						</textarea>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-4 mb-3">
                    <div class="h-100">
                        <h5 class="account-title d-lg-block d-md-block d-none">&nbsp;</h5>
                        <div class="profile-image-2">
                            <a href="{{ route('seller', ['seller' => $product->seller->username]) }}"><img
                                    src="{{ $product->seller->avatar }}" alt="user"></a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-4 mb-3">
                    <div class="h-100">
                        <h5 class="account-title">Vendor Details</h5>
                        <div class="feature-card bg-dark text-white">
                            <div class="feature-media">
                                <a class="feature-image" href="#">
                                    <img src="{{ $product->image }}" alt="product">
                                </a>
                            </div>
                            <div class="feature-content">
                                <p class="mb-0">Vendor:
                                    <a
                                        href="{{ route('seller', ['seller' => $product->seller->username]) }}">{{ $product->seller->username }}({{ \App\Models\Product::totalfeaturedproductsofseller($product->seller->id) }})</a>
                                </p>
                                <p class="mb-0">Squid Points: 1SP</p>
                                <div class="feature-rating">
                                    Rating:
                                    <i class="bi-star"></i>
                                    <i class="bi-star"></i>
                                    <i class="bi-star"></i>
                                    <i class="bi-star"></i>
                                    <i class="bi-star"></i>
                                    <a href="#">(3 Reviews)</a>
                                </div>
                                <p class="mb-0">Registered: {{ date('M Y', strtotime($product->seller->seller_since)) }}
                                </p>
                                <p>Total sales:
                                    {{ \App\Models\Product::totalfeaturedproductsofseller($product->seller->id) }}</p>
                                <a href="{{ route('newconversation', ['vendor' => $product->seller->id]) }}"
                                    class="product-add mb-2 mb-2">
                                    <img src="{{ asset('img/icons/messenger-black.png') }}" width="14px"
                                        style="margin-top:-3px;margin-right:2px">
                                    <span>Chat With Vendor</span>
                                </a>
                                <a href="{{ route('seller', ['seller' => $product->seller->username]) }}"
                                    class="product-add bg-danger text-white">
                                    <img src="{{ asset('img/icons/helpdesk.png') }}" width="14px"
                                        style="margin-top:-3px;margin-right:2px">
                                    <span>Vist Vendor Profile</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-md-4 col-lg-4 mb-3">
                    <div class="h-100">
                        <h5 class="account-title">Terms & Conditions</h5>
                        <textarea class="form-control" style="height: 470px;" readonly>
                            {{ $product->conditions }}
						</textarea>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-4 mb-3">
                    <div class="h-100">
                        <h5 class="account-title">Product Details</h5>
                        <div class="user-form border rounded p-2">
                            <div class="form-group d-flex justify-content-between">
                                <label>Product Price:</label>
                                <div class="d-flex align-items-center">
                                    @php
                                    $price = \App\Tools\Converter::currencyConverter($product->price,
                                    auth()->user()->currency, $product->currency);
                                    $ships_with = json_decode($product->ships_with, true);
                                    $ships_price = json_decode($product->ships_price, true);
                                    $ships_time = json_decode($product->ships_time, true);
                                    @endphp
                                    <span class="text-danger fw-bold"
                                        style="font-size:16px;margin-left:3px;margin-top:1px">
                                        {{ $price }}
                                        {{ auth()->user()->currency }}</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Select Amount:</label>
                                <input type="number" class="form-control" value="1">
                            </div>
                            <div class="form-group">
                                <label>Select Shipping</label>
                                <select class="form-select" aria-label="Shipping select">
                                    @if($ships_with[3]) != null)
                                    <option value="1">{{$ships_with[1]}} - Price {{ \App\Tools\Converter::currencyConverter($ships_price[1],
                                    auth()->user()->currency, $product->currency); }} {{ auth()->user()->currency }}
                                        -
                                        {{$ships_time[1]}}
                                        Days Average
                                    </option>
                                    <option value="2">{{$ships_with[2]}} - Price {{ \App\Tools\Converter::currencyConverter($ships_price[2],
                                    auth()->user()->currency, $product->currency); }} {{ auth()->user()->currency }} -
                                        {{$ships_time[2]}}
                                        Days Average
                                    </option>
                                    <option value="3">{{$ships_with[3]}} - Price {{ \App\Tools\Converter::currencyConverter($ships_price[3],
                                    auth()->user()->currency, $product->currency); }} {{ auth()->user()->currency }} -
                                        {{$ships_time[3]}}
                                        Days Average
                                    </option>
                                    @elseif($ships_with[2] != null)
                                    <option value="1">{{$ships_with[1]}} - Price {{ \App\Tools\Converter::currencyConverter($ships_price[1],
                                    auth()->user()->currency, $product->currency); }} {{ auth()->user()->currency }} -
                                        {{$ships_time[1]}}
                                        Days Average
                                    </option>
                                    <option value="2">{{$ships_with[2]}} - Price {{ \App\Tools\Converter::currencyConverter($ships_price[2],
                                    auth()->user()->currency, $product->currency); }} {{ auth()->user()->currency }} -
                                        {{$ships_time[2]}}
                                        Days Average
                                    </option>
                                    @else
                                    <option value="1">{{$ships_with[1]}} - Price {{ \App\Tools\Converter::currencyConverter($ships_price[1],
                                    auth()->user()->currency, $product->currency); }} {{ auth()->user()->currency }} -
                                        {{$ships_time[1]}}
                                        Days Average
                                    </option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group d-flex justify-content-between">
                                <label>Shipping Route:</label>
                                @php
                                $from = strtolower($product->ships_from);
                                $to = strtolower($product->ships_to);
                                @endphp
                                @if($product->type == 'Physical')
                                <div class="d-flex align-items-center justify-content-center p-2"><img
                                        src="https://countryflagsapi.com/png/{{ $from }}" width="28px" height="14px"
                                        alt="Flag"><img class="mx-1"
                                        src="{{ asset('img/icons/arrow-right-black.png') }}" width="17px"
                                        style="margin-top:-3px"><img src="https://countryflagsapi.com/png/{{ $to }}"
                                        alt="Flag" height="14px" width="28px">
                                </div>
                                @endif
                            </div>
                            <div class="form-group d-flex justify-content-between">
                                <label>Payment System:</label>
                                @if($product->type=='Physical' and $product->paymethod=='escrow')
                                <span>Physical | Escrow</span>
                                @elseif($product->type=='Physical' and $product->paymethod=='fe')
                                <span>Physical | <span style="color:red">FE</span></span>
                                @elseif($product->autofilled=='1')
                                <span>Digital | Auto-Dispatch</span>
                                @elseif($product->type=='Digital' and $product->paymethod=='escrow')
                                <span>Digital | Escrow</span>
                                @elseif($product->type=='Digital' and $product->paymethod=='fe')
                                <span>Digital | <span style="color:red">FE</span></span>
                                @endif
                            </div>
                            <div class="form-group d-flex justify-content-between">
                                <label>Crypto Accepted:</label>
                                <img src="{{ asset('img/XMR2.png') }}" width="20" height="20" alt="xmr">

                            </div>
                            <div class="form-group d-flex justify-content-between">
                                <label>Product Rating:</label>
                                <div>
                                    <i class="bi-star"></i>
                                    <i class="bi-star"></i>
                                    <i class="bi-star"></i>
                                    <i class="bi-star"></i>
                                    <i class="bi-star"></i>
                                </div>
                            </div>
                            <form method="post" action="{{ route('post.favorites', ['product' => $product->id]) }}">
                                @csrf
                                <button class="product-add mb-2">
                                    @if(auth()->user()->isFavorite($product))
                                    <img src="{{ asset('img/icons/heart-fill.png') }}" width="16px"
                                        style="margin-right:2px"> Remove Favorites
                                    @else
                                    <img src="{{ asset('img/icons/heart.png') }}" width="16px" style="margin-right:2px">
                                    Add
                                    to Favorites
                                    @endif
                                </button>
                            </form>
                            <form method="post" action="{{ route('post.addtocart', ['product' => $product->id]) }}">
                                @csrf
                                <button class="product-add bg-success text-white">
                                    <img src="{{ asset('img/icons/cart.png') }}" width="16px" style="margin-right:2px">
                                    Add
                                    to Cart
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-4 mb-3">
                    <div class="h-100">
                        <h5 class="account-title">Vendor Public PGP Key</h5>
                        <textarea class="form-control" style="height: 470px;" readonly>
                            {{ $product->seller->pgp_key }}
                        </textarea>
                    </div>
                </div>

            </div>

        </div>

    </div>
</section>

@stop
@extends('master.main')
@section('content')
<title>Wishlist - Squid Market</title>
@include('includes.flash.validation')
@include('includes.flash.success')
@include('includes.flash.error')
<section class="section mt-3 mb-0">
    <div class="container">
        <div class="page-title justify-content-center">
            <h5 class="fw-bold"><img src="{{ asset('img/icons/helpdesk.png') }}" width="17px" style="margin-top:-3px">
                Wishlist and Favorites </h5>
        </div>
    </div>
</section>
<section class="section">
    <div class="container">
        <div class="account-card">
            <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-6">
                @forelse($favorites as $favorite)
                <div class="col">
                    <div class="product-card">
                        <div class="product-media">
                            <div class="product-label-lg">
                                <label class="label-text label-marquee" style="height:44px;">
                                    <a href="{{ route('detailview', ['product' => $product->id]) }}"
                                        class="onlytworow">{{ $favorite->product->name }}</a>
                                </label>
                            </div>
                            <a class="product-image"
                                href="{{ route('detailview', ['product' => $favorite->product->id]) }}">
                                <img src="{{ $favorite->product->image }}" alt="product">
                            </a>
                        </div>
                        <div class="product-content">
                            <div class="product-label-lg">
                                <a href="{{ route('seller', ['seller' => $favorite->product->seller->username]) }}"
                                    class="label-text text">{{ $favorite->product->seller->username }}({{ \App\Models\Product::totalfeaturedproductsofseller($favorite->product->seller->id) }})
                                </a>
                            </div>
                            <div class="product-label-lg">
                                <label class="label-text gray"><i class="bi-coin"></i>
                                    @if($favorite->product->type=='Physical' and
                                    $favorite->product->paymethod=='escrow')
                                    <span>Physical | Escrow</span>
                                    @elseif($favorite->product->type=='Physical' and
                                    $favorite->product->paymethod=='fe')
                                    <span>Physical | <span style="color:red">FE</span></span>
                                    @elseif($favorite->product->autofilled=='1')
                                    <span>Digital | Auto-Dispatch</span>
                                    @elseif($favorite->product->type=='Digital' and
                                    $favorite->product->paymethod=='escrow')
                                    <span>Digital | Escrow</span>
                                    @elseif($favorite->product->type=='Digital' and $favorite->product->paymethod=='fe')
                                    <span>Digital | <span style="color:red">FE</span></span>
                                    @endif
                                </label>
                            </div>
                            <div class="product-rating">
                                <i class="active bi-star"></i>
                                <i class="active bi-star"></i>
                                <i class="active bi-star"></i>
                                <i class="active bi-star"></i>
                                <i class="bi-star"></i>
                                <a href="#">(3)</a>
                            </div>
                            <div class="d-flex align-items-center justify-content-center">
                                <img src="{{ asset('img/XMR2.png') }}" width="20" height="20" alt="xmr">
                                @php
                                $price = \App\Tools\Converter::currencyConverter($favorite->product->price,
                                auth()->user()->currency, $favorite->product->currency);
                                @endphp
                                <h6 class="product-price">{{ $price }} {{ auth()->user()->currency }}</h6>
                            </div>
                            @php
                            $from = strtolower($favorite->product->ships_from);
                            $to = strtolower($favorite->product->ships_to);
                            @endphp
                            @if($favorite->product->type == 'Physical')
                            <div class="d-flex align-items-center justify-content-center p-2"><img
                                    src="https://countryflagsapi.com/png/{{ $from }}" width="28px" height="14px"
                                    alt="Flag"><img class="mx-1" src="{{ asset('img/icons/arrow-right-black.png') }}"
                                    width="17px" style="margin-top:-3px"><img
                                    src="https://countryflagsapi.com/png/{{ $to }}" alt="Flag" height="14px"
                                    width="28px">
                            </div>
                            @else
                            <div style="padding:14.5px"></div>
                            @endif
                            <!-- <button class="product-add mb-2"><span>Add to Whishlist</span><i class="bi-heart"></i></button>
                        <button class="product-add bg-success text-white"><span>Add to Cart</span><i
                                class="bi-cart"></i></button> -->
                            <form method="post"
                                action="{{ route('post.favorites', ['product' => $favorite->product->id]) }}">
                                @csrf
                                <button class="product-add mb-2">
                                    @if(auth()->user()->isFavorite($favorite->product))
                                    <img src="{{ asset('img/icons/heart-fill.png') }}" width="16px"
                                        style="margin-right:2px"> Remove Favorites
                                    @else
                                    <img src="{{ asset('img/icons/heart.png') }}" width="16px" style="margin-right:2px">
                                    Add
                                    to Favorites
                                    @endif
                                </button>
                            </form>
                            <form method="post"
                                action="{{ route('post.addtocart', ['product' => $favorite->product->id]) }}">
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
                @empty
                <div class="h3 mt-20" style="text-align: center">Looks Empty :( </div>
                @endforelse
            </div>
        </div>
    </div>
    </div>
</section>

@stop
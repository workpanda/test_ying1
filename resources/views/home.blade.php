<?php

namespace App\Tools; ?>
@extends('master.main')
@section('content')

<title>Home - Squid Market</title>
@include('master.homething')
<div style="margin-top:-40px;padding:0px">
    @include('includes.flash.validation')
    @include('includes.flash.success')
    @include('includes.flash.error')
</div>
<section class="section recent-part">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-heading">
                    <h2 class="text-uppercase h3">Feature listings</h2>
                </div>
            </div>
        </div>
        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-6">
            @forelse($featuredProducts as $product)
            <div class="col">
                <div class="product-card">
                    <div class="product-media">
                        <div class="product-label-lg">
                            <label class="label-text label-marquee" style="height:44px;">
                                <a href="{{ route('detailview', ['product' => $product->id]) }}"
                                    class="onlytworow">{{ $product->name }}</a>
                            </label>
                        </div>
                        <a class="product-image" href="{{ route('detailview', ['product' => $product->id]) }}">
                            <img src="{{ $product->image }}" alt="product">
                        </a>
                    </div>
                    <div class="product-content">
                        <div class="product-label-lg">
                            <a href="{{ route('seller', ['seller' => $product->seller->username]) }}"
                                class="label-text text">{{ $product->seller->username }}({{ \App\Models\Product::totalfeaturedproductsofseller($product->seller->id) }})
                            </a>
                        </div>
                        <div class="product-label-lg">
                            <label class="label-text gray"><i class="bi-coin"></i>
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
                            <img src=<?php echo Converter::convert_into_base64(
                                public_path('img/XMR2.png')
                            ); ?> width="20" height="20" alt="xmr">
                            @php
                            $price = \App\Tools\Converter::currencyConverter($product->price,
                            auth()->user()->currency, $product->currency);
                            @endphp
                            <h6 class="product-price">{{ $price }} {{ auth()->user()->currency }}</h6>
                        </div>
                        @php
                        $from = strtolower($product->ships_from);
                        $to = strtolower($product->ships_to);
                        @endphp
                        @if($product->type == 'Physical')
                        <div class="d-flex align-items-center justify-content-center p-2"><img
                                src="https://countryflagsapi.com/png/{{ $from }}" width="28px" height="14px"
                                alt="Flag"><img class="mx-1" src=<?php echo Converter::convert_into_base64(
                                    public_path(
                                        'img/icons/arrow-right-black.png'
                                    )
                                ); ?> width="17px" style="margin-top:-3px"><img
                                src="https://countryflagsapi.com/png/{{ $to }}" alt="Flag" height="14px" width="28px">
                        </div>
                        @else
                        <div style="padding:14.5px"></div>
                        @endif
                        <!-- <button class="product-add mb-2"><span>Add to Whishlist</span><i class="bi-heart"></i></button>
                        <button class="product-add bg-success text-white"><span>Add to Cart</span><i
                                class="bi-cart"></i></button> -->
                        <form method="post" action="{{ route('post.favorites', ['product' => $product->id]) }}">
                            @csrf
                            <button class="product-add mb-2">
                                @if(auth()->user()->isFavorite($product))
                                <img src=<?php echo Converter::convert_into_base64(
                                    public_path('img/icons/heart-fill.png')
                                ); ?> width="16px" style="margin-right:2px"> Remove Favorites
                                @else
                                <img src=<?php echo Converter::convert_into_base64(
                                    public_path('img/icons/heart.png')
                                ); ?> width="16px" style="margin-right:2px"> Add
                                to Favorites
                                @endif
                            </button>
                        </form>
                        <form method="post" action="{{ route('post.addtocart', ['product' => $product->id]) }}">
                            @csrf
                            <button class="product-add bg-success text-white">
                                <img src=<?php echo Converter::convert_into_base64(
                                    public_path('img/icons/cart.png')
                                ); ?> width="16px" style="margin-right:2px"> Add
                                to Cart
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @empty
            @endforelse
        </div>
    </div>
</section>

@if(session()->has('overlay') and session()->get('overlay') === 'OK')
<details class="dark" open>
    <summary>
        <div class="details-modal-overlay"></div>
    </summary>
    <div class="details-modal modal-lg">
        <div class="details-modal-close">
            <!-- <i class="bi-x" style="font-size: 30px"></i> -->
            <img src=<?php echo Converter::convert_into_base64(
                public_path('img/icons/close.png')
            ); ?> width="20px">
        </div>
        <div class="details-modal-title">Squid Market links and Information</div>
        <div class="details-modal-title-subtitle">These are the only offical links for <span class="text-white">Squid
                Market!</span> Bookmark them, write them down, save them!!<br>Signed by the main admin key, you can find
            it <a href="#" class="text-white">here</a></div>
        <div class="details-modal-content">
            <textarea class="form-control" style="height: 370px;" readonly>
-----BEGIN PGP SIGNED MESSAGE-----

Hash: SHA256
				
This message is signed with the main admin key located at /pgp.txt

Current Squid Market onions;
squid2e3gr3pmaikukidllstulxvkb7a247gkruihzvyk3gqwpolqeavice2e3gr3pmaikukidllstulxvkb7a247gkruihzvyk3gqwpolqeavice2e3gr3pmaikukidllstulxvkb7a247gkruihzvyk3gqwpolqeavice2e3gr3pmaikukidllstulxvkb7a247gkruihzvyk3gqwpolqea

-----BEGIN PGP SIGNATURE-----
				
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
=r/EX
-----END PGP PUBLIC KEY BLOCK-----</textarea>
        </div>
    </div>
</details>
<?php session()->forget('overlay'); ?>
@endif

<!-- @foreach($featuredProducts as $featuredProduct)
@include('includes.components.product.featured', ['product' => $featuredProduct])
@endforeach -->

@stop
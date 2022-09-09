<?php namespace App\Tools; ?>
@extends('master.main')
@section('content')

<title>Cart - Squid Market</title>

@include('includes.flash.validation')
@include('includes.flash.success')
@include('includes.flash.error')
<section class="section mt-3 mb-3">
    <div class="container">
        <div class="page-title justify-content-center">
            <h5><img src=<?php echo Converter::convert_into_base64(
                public_path('img/icons/cart.png')
            ); ?> width="15px" style="margin-top:-3px"> Cart</h5>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="alert alert-success text-center" role="alert" style="display: none">
            You have successfully added or changed your shopping cart content
        </div>
        <div class="account-card">
            @forelse($products as $product)
            <!-- <div class="row"> -->
            <form action="{{ route('post.savecart', ['product' => $product['product_id']]) }}" method="post"
                class="row d-flex justify-content-between">
                @csrf
                <div class="col-sm-12 col-md-12 col-lg-5 mb-3">
                    <p class="fw-bold">Order Details</p>
                    <div class="h-100">
                        <div class="feature-card border mb-0">
                            <div class="feature-media">
                                <a class="feature-image" href="#">
                                    <img src="{{ $product['image'] }}" alt="product" style="border-radius: 5px">
                                </a>
                            </div>
                            <div class="feature-content">
                                <p class="mb-0"> {{ $product['product_name'] }} </p>
                                <p class="mb-0">
                                    <strong>{{ $product['seller'] }}({{ \App\Models\Product::totalfeaturedproductsofseller($product['seller_id']) }})
                                        -
                                        <i class="bi-star-fill"></i>
                                        <i class="bi-star-fill"></i>
                                        <i class="bi-star-fill"></i>
                                        <i class="bi-star-fill"></i>
                                        <i class="bi-star"></i></strong>
                                </p>
                                <!-- <div class="input-group mb-3">
                                    <span class="input-group-text">$</span>
                                    <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                                    <span class="input-group-text">.00</span>
                                </div> -->
                                <div class="form-group mb-1" style="position: relative">
                                    <img src="{{asset('img/XMR2.png')}}" width="40" height="40" alt="xmr"
                                        style="position: absolute; right: 3px; top: 2px">
                                    <input type="text" class="form-control" value="XMR" width="100%" readonly>
                                </div>
                                <?php if ($product['type'] == 'physical') {
                                    $value = 'Physical';
                                } else {
                                    if ($product['autofilled'] == '0') {
                                        $value = 'Digital';
                                    } else {
                                        $value = 'Digital | Autodispatch';
                                    }
                                } ?>
                                <div class="form-group">
                                    <input type="text" class="form-control" value="{{ $value }}" readonly>
                                </div>
                                <div class="form-group">
                                    <select class="form-select" aria-label="select" name="delivery_method_num" readonly>
                                        @if(count($product['delivery_method']) == 3)
                                        <option value="0" @if($product['delivery_method_num']==0) selected @endif>
                                            {{ $product['delivery_method'][0] }}</option>
                                        <option value="1" @if($product['delivery_method_num']==1) selected @endif>
                                            {{ $product['delivery_method'][1] }}</option>
                                        <option value="2" @if($product['delivery_method_num']==2) selected @endif>
                                            {{ $product['delivery_method'][2] }}</option>
                                        @elseif(count($product['delivery_method']) == 2)
                                        <option value="0" @if($product['delivery_method_num']==0) selected @endif>
                                            {{ $product['delivery_method'][0] }}</option>
                                        <option value="1" @if($product['delivery_method_num']==1) selected @endif>
                                            {{ $product['delivery_method'][1] }}</option>
                                        @elseif(count($product['delivery_method']) == 1)
                                        <option value="0" @if($product['delivery_method_num']==0) selected @endif>
                                            {{ $product['delivery_method'][0] }}</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="fw-bold">Order Quantity:</label>
                                    <input type="text" class="form-control" placeholder="1" name="quantity"
                                        value="{{ $product['quantity'] }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-3 mb-3">
                    <p class="fw-bold">NOTE / DELIVERY INFO</p>
                    <div class="h-100">
                        <textarea class="form-control" style="height: 284px;" name="deliveryinfo"
                            placeholder="Enter your delivery instructions and details here and click Save Changes. Squid Market will encrypt it with the vendor's Public PGP Key.">{{ $product['deliveryinfo'] }}</textarea>
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-3 mb-3">
                    <p class="fw-bold">Order Action:</p>
                    <div class="product-card border rounded mb-0">
                        <p class="fw-bold mb-0">Order Type:</p>
                        <div class="form-check form-switch">
                            <input class="form-check-input" name="paymethod" type="radio" value="escrow"
                                @if($product['paymethod']=='escrow' ) checked @endif>
                            <label class="form-check-label" for="fe">ESCROW</label>
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" name="paymethod" type="radio" value="fe"
                                @if($product['paymethod']=='fe' ) checked @endif>
                            <label class="form-check-label" for="escrow">FINALIZE EARLY (FE)</label>
                        </div>

                        <button type="submit" class="btn btn-success btn-sm w-100 mt-3"><img src=<?php echo Converter::convert_into_base64(
                            public_path('img/icons/edit.png')
                        ); ?> width="15px" style="margin-top:-3px">
                            Save Changes
                        </button>
                        <a href="{{ route('post.removetocart', ['product' => $product['product_id']]) }}"
                            class="btn btn-primary btn-sm w-100 mt-2"><img src=<?php echo Converter::convert_into_base64(
                                public_path('img/icons/cart.png')
                            ); ?> width="15px" style="margin-top:-3px"> Remove
                            Products</a>
                    </div>
                </div>
            </form>
            <!-- </div> -->
            @empty
            <div>No Orders</div>
            @endforelse

            <div class="checkout-charge ms-auto me-0 border">
                <ul>
                    <li>
                        <span>Total</span>
                        <span>{{ $totalPrice }}
                            {{ auth()->user()->currency }}</span>
                    </li>
                </ul>
            </div>
            <div class="checkout-proced mt-3 mb-3">
                <a href="{{ route('home') }}" class="btn btn-danger"><img src=<?php echo Converter::convert_into_base64(
                    public_path('img/icons/home.png')
                ); ?> width="15px" style="margin-top:-3px"> Continue Shopping</a>
            </div>
            @if(empty($products))
            <div class="checkout-proced mt-3 mb-3">
                <a class=" btn btn-success inactive"><img src=<?php echo Converter::convert_into_base64(
                    public_path('img/icons/cart-check.png')
                ); ?> width="15px" style="margin-top:-3px">
                    Continue to
                    Checkout</a>
            </div>
            @else
            <div class="checkout-proced mt-3 mb-3">
                <a href="{{ route('checkout') }}" class="btn btn-success "><img src=<?php echo Converter::convert_into_base64(
                    public_path('img/icons/cart-check.png')
                ); ?> width="15px" style="margin-top:-3px">
                    Continue to
                    Checkout</a>
            </div>
            @endif
        </div>

    </div>
</section>

@stop
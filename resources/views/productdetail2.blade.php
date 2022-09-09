@extends('master.main')
@section('content')

<title>Product Details - Squid Market</title>
@include('includes.flash.validation')
@include('includes.flash.success')
@include('includes.flash.error')
<div class="container-fluid pt-4 px-4" style="background-color:#dcebeb">
    <div class="text-center bg-light rounded p-4 mb-3">
        <div class="row p-4">
            <div class="col-md-6 col-lg-6 p-4" style="border-right:1px solid lightgrey">
                <img src="{{ $product->image }}" />
            </div>
            <div class="col-md-6 col-lg-6 p-4">
                <h3 class="text-start fw-bold mb-4 mt-2">{{ $product->name }}</h3>
                <div class="d-flex justify-content-between mb-4 ">
                    <div>
                        <label class="bg-primary text-white rounded p-1">
                            {{ $product->category->parent->name }}</label>
                        <label class="bg-success text-white rounded p-1">{{ $product->category->name }}</label>
                    </div>
                    <a href="#" class="text-danger text-decoration-underline" style="font-size:18px">Report</a>
                </div>
                <h4 class="text-start mb-3">Payment Type : @if($product->paymethod=='fe')
                    <span style="color:red"> FE</span></span>
                    @else
                    Escrow</span>
                    @endif
                </h4>
                <div class="d-flex mb-3">
                    @if($product->paytype == 'bic')
                    <img src="{{ asset('img/bitcoin.png') }}" width="25" height="25" alt="bitcoin"
                        style="margin-right:5px">
                    @elseif($product->paytype == 'xmr')
                    <img src="{{ asset('img/XMR2.png') }}" width="25" height="25" alt="XMR" style="margin-right:5px">
                    @endif
                    <h6 class="price" style="font-size:18px"> {{ $product->price }} =
                        ${{ $product->price * 151.21  }}
                        <!-- \App\Tools\Converter::moneroLastPrice() -->
                    </h6>
                </div>
                @php
                $from = strtolower($product->ships_from);
                $to = strtolower($product->ships_to);
                @endphp
                <h4 class="text-start mb-3">Shipping Route : <img src="https://ipdata.co/flags/{{ $from }}.png"
                        width="30px" alt="Flag"><i class="bi bi-arrow-right"></i><img
                        src="https://ipdata.co/flags/{{ $to }}.png" alt="Flag" width="30px">
                </h4>
                <h4 class="text-start mb-3">Measurement : {{ $product->quantity }} {{ $product->mesure }}</h4>
                <h4 class="text-start mb-3">Available Stock : 15234</h4>
                <div class="mb-3">
                    <h5 class="text-start">Quantity : </h5>
                    <input type="number" class="form-control" placeholder="1" value="{{ $product->quantity }}">
                </div>
                <form class="text-start mb-3" method="post"
                    action="{{ route('post.addtocart', ['product' => $product->id]) }}">
                    @csrf
                    <button class="btn btn-info btn-sm text-white">Add to Cart</button>
                </form>
                <div class="form-group mb-1" style="position: relative">
                    <div class="d-flex align-items-center"
                        style="position: absolute; left: 100px; top: 5px;width:35px;height:35px">
                        <img src="{{ $product->seller->avatar }}" width="40" height="40" alt="xmr">
                        <h4>&nbsp;&nbsp;{{ $product->seller->username }}({{ \App\Models\Product::totalfeaturedproductsofseller($product->sller) }})
                        </h4>
                    </div>
                    <input type="text" class="form-control" value="Sold By : " width="100%" readonly>
                </div>
            </div>
        </div>
    </div>
    <div class="text-center bg-light rounded p-4 mb-3">
        <div class="product-tabs inner-bottom-xs  wow fadeInUp animated"
            style="visibility: visible; animation-name: fadeInUp;">
            <div class="tab-wrap">
                <!-- active tab on page load gets checked attribute -->
                <input type="radio" id="tab1" name="tabGroup1" class="tab" checked>
                <label for="tab1">Description</label>

                <input type="radio" id="tab2" name="tabGroup1" class="tab">
                <label for="tab2">Terms and Conditions</label>

                <div class="tab__content">
                    {{ $product->description }}
                </div>

                <div class="tab__content">
                    {{ $product->conditions }}
                </div>
            </div>
        </div>
    </div>
    <div class="text-center bg-light rounded p-4 mb-3">
        <label class="product_review">Product Reviews</label>
        <div class="review_content">
            <span>There are no reivews</span>
        </div>
    </div>
    <div class="text-center bg-light rounded p-4 mb-3">
        <label class="product_review">Related Products</label>
        <div class="review_content">
            <span>There are no related products</span>
        </div>
    </div>
</div>
</div>

@stop
<?php namespace App\Tools; ?>
@extends('master.main')
@section('content')

<title>All Sales - Squid Market</title>
@include('includes.flash.validation')
@include('includes.flash.success')
@include('includes.flash.error')
<section class="section mt-3 mb-3">
    <div class="container">
        <div class="page-title justify-content-center">
            <h5><img src=<?php echo Converter::convert_into_base64(
                public_path('img/icons/list.png')
            ); ?> width="17px" style="margin-top:-3px"> All Sales</h5>
        </div>
    </div>
</section>

<section class="section mt-0">
    <div class="container">
        <div class="account-card">
            <div class="row">
                <div class="col-md-12 col-lg-2">
                    <ul class="nav nav-account">
                        <li @if($status=='all' ) class="nav-item active" @else class="nav-item" @endif>
                            <a href="{{ route('sales', ['status' => 'all']) }}">
                                <img src=<?php echo Converter::convert_into_base64(
                                    public_path('img/icons/list.png')
                                ); ?> width="16px" style="margin-right:3px"> All
                                Sales({{ $user->sales()->count() }})</a>
                        </li>
                        <li @if($status=='purchased' ) class="nav-item active" @else class="nav-item" @endif>
                            <a href="{{ route('sales', ['status' => 'purchased']) }}">
                                <img src=<?php echo Converter::convert_into_base64(
                                    public_path('img/icons/money.png')
                                ); ?> width="16px" style="margin-right:3px">Purchased
                                Sales({{$user->totalSales('purchased')}})</a>
                        </li>
                        <li @if($status=='shipped' ) class="nav-item active" @else class="nav-item" @endif>
                            <a href="{{ route('sales', ['status' => 'shipped']) }}">
                                <img src=<?php echo Converter::convert_into_base64(
                                    public_path('img/icons/shipped.png')
                                ); ?> width="16px" style="margin-right:3px">Shipped
                                Sales({{$user->totalSales('shipped')}})
                            </a>
                        </li>
                        <li @if($status=='delivered' ) class="nav-item active" @else class="nav-item" @endif>
                            <a href="{{ route('sales', ['status' => 'delivered']) }}">
                                <img src=<?php echo Converter::convert_into_base64(
                                    public_path('img/icons/gift.png')
                                ); ?> width="16px" style="margin-right:3px">Delivered
                                Sales({{$user->totalSales('delivered')}})
                            </a>
                        </li>
                        <li @if($status=='disputed' ) class="nav-item active" @else class="nav-item" @endif>
                            <a href="{{ route('sales', ['status' => 'disputed']) }}">
                                <img src=<?php echo Converter::convert_into_base64(
                                    public_path('img/icons/dispute.png')
                                ); ?> width="16px" style="margin-right:3px">Disputed
                                Sales({{$user->totalSales('disputed')}})
                            </a>
                        </li>
                        <li @if($status=='cancelled' ) class="nav-item active" @else class="nav-item" @endif>
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

                    <div class="p-2 h6 fw-bold bg-primary text-white rounded mb-3"><img src=<?php echo Converter::convert_into_base64(
                        public_path('img/icons/tags.png')
                    ); ?> width="17px" style="margin-right:3px" /> Sales</div>

                    @forelse($sales as $order)
                    <div class="account-title bg-light p-2 mb-0 border border-bottom-0">
                        <a href="{{ route('detailview', ['product' => $order->product->id]) }}" id="orderproduct">
                            <h6 class="fw-bold onlyonerow" style="width:400px">{{ $order->product->name }}</h6>
                        </a>
                        <div>
                            <a href="{{ route('sale', ['order' => $order->id]) }}" class="btn btn-info btn-xs"><img src=<?php echo Converter::convert_into_base64(
                                public_path('img/icons/eye-black.png')
                            ); ?> width="13px" style="margin-right:3px;margin-top:-3px"> View Sale</a>
                            <a href="{{ route('newconversation', ['vendor' => $order->buyer->id]) }}"
                                class="btn btn-info btn-xs"><img src=<?php echo Converter::convert_into_base64(
                                    public_path('img/icons/messenger-dark.png')
                                ); ?> width="13px" style="margin-right:3px;margin-top:-3px"> Messages</a>
                            @if($order->status == 'canceled')
                            <label
                                style="background-color:var(--primary);color:white;padding:2px 5px;border-radius:5px"><img
                                    src=<?php echo Converter::convert_into_base64(
                                        public_path('img/icons/cancel.png')
                                    ); ?> width="16px" style="margin-right:3px">Canceled</label>
                            @elseif($order->status == 'waiting')
                            <a href="{{ route('post.changeorderstatus', ['order' => $order->id, 'status' => 'accepted']) }}"
                                class="btn btn-success btn-xs"><img src=<?php echo Converter::convert_into_base64(
                                    public_path('img/icons/chekc.png')
                                ); ?> width="13px" style="margin-right:3px;margin-top:-3px"> Accept Order</a>
                            @endif
                        </div>
                    </div>
                    <div class="table-responsive mb-4">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Total Price</th>
                                    <th scope="col">Qty</th>
                                    <th scope="col">Payment Type</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Buyer</th>
                                    <th scope="col">Shipping with</th>
                                    <th scope="col">Purchased at</th>
                                    <th scope="col">Auto Finalizer at</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $order->total }}</td>
                                    <td>{{ $order->quantity }}</td>
                                    <td>
                                        @if($order->paymethod == 'fe')
                                        <label
                                            style="background-color:var(--primary);color:white;padding:2px 5px;border-radius:5px">Finalize
                                            Early</label>
                                        @elseif($order->paymethod == 'escrow')
                                        <label
                                            style="background-color:var(--green);color:white;padding:2px 5px;border-radius:5px">Normal
                                            Escrow</label>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-status">
                                            <button type="button"
                                                class="btn btn-paid {{ $order->status=='purchased' ? active : '' }}"><i
                                                    class="bi-currency-dollar"></i> Paid</button>
                                            <button type="button"
                                                class="btn btn-shipped {{ $order->status=='shipped' ? active : '' }}"><i
                                                    class="bi-truck"></i>
                                                Shipped</button>
                                            <button type="button"
                                                class="btn btn-delivered {{ $order->status=='delivered' ? active : '' }}"><i
                                                    class="bi-gift"></i>
                                                Delivered</button>
                                            <button type="button"
                                                class="btn btn-disputed {{ $order->status=='disputed' ? active : '' }}"><i
                                                    class="bi-exclamation-triangle"></i> Disputed</button>
                                        </div>
                                    </td>
                                    <td>{{ $order->buyer->username }}</td>
                                    <td>{{ $order->product->shippingwith }}</td>
                                    <td>{{ $order->created_at }}</td>
                                    <td>{{ $order->updated_at }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    @empty
                    <div>Looks Empty :(</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</section>

@stop
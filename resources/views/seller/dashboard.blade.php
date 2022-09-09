<?php namespace App\Tools; ?>
@extends('master.main')
@section('content')
<title>Dashboard - Squid Market</title>

@include('includes.flash.success')
@include('includes.flash.error')
@include('includes.flash.validation')
<section class="section mt-3 mb-1">
    <div class="container">
        <div class="page-title justify-content-center">
            <h5><img src=<?php echo Converter::convert_into_base64(
                public_path('img/icons/panel.png')
            ); ?> width="17px" style="margin-top:-3px"> Profile</h5>
        </div>
    </div>
</section>

<section class="section mt-0 mb-1 text-center">
    <div class="container">
        <div class="account-card">
            <div class="account-title justify-content-center">
                <h4>Create New Products</h4>
            </div>
            <div class="account-content">
                <div class="row">
                    <div class="col-lg-6 mb-1">
                        <div class="icon-box text-center">
                            <img src="{{ asset('img/physical-product.png') }}" alt="Physical Product">
                        </div>
                        <a href="{{ route('createphysical', ['section' => 'add']) }}" class="btn btn-primary btn-sm"><i
                                class="bi-plus-lg"></i> Create Physical Product</a>
                    </div>
                    <div class="col-lg-6 mb-1">
                        <div class="icon-box text-center">
                            <img src="{{ asset('img/digital-product.png') }}" alt="Digital Product">
                        </div>
                        <a href="{{ route('createdigital', ['section' => 'add']) }}" class="btn btn-primary btn-sm"><i
                                class="bi-plus-lg"></i> Create Digital Product</a>
                    </div>
                </div>
            </div>
        </div>
        <form>
            <div class="account-card">
                <div class="account-title">
                    <h4>My Products</h4>
                </div>
                <div class="account-content">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Title</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Purchased</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($products as $product)
                                @php
                                $price = \App\Tools\Converter::currencyConverter($product->price,
                                auth()->user()->currency, $product->currency);
                                @endphp
                                <tr>
                                    <td class="d-flex justify-content-center">
                                        <div class="table-image">
                                            <img src="{{ $product->image }}" alt="product">

                                        </div>
                                        <h6>{{ $product->name }}</h6>
                                    </td>
                                    <td>{{ $product->type }}</td>
                                    <td>{{ $price }} {{ auth()->user()->currency }}</td>
                                    <td>0</td>
                                    <td>{{ $product->quantity }}</td>
                                    <td>{{ $product->category->name }}</td>
                                    <td class="table-action d-flex justify-content-center">
                                        <a class="view tabula-tooltip"
                                            href="{{ $product->type == 'Physical' ? route('createphysical', ['section' => 'edit', 'product' => $product->id]) : route('createdigital', ['section' => 'edit', 'product' => $product->id]) }}"
                                            data-title="Edit"><i><img src=<?php echo Converter::convert_into_base64(
                                                public_path(
                                                    'img/icons/edit-green.png'
                                                )
                                            ); ?> width="17px" style="margin-top:3px"></i></a>
                                        <a class="view tabula-tooltip" href="#" data-title="Promote"><i><img src=<?php echo Converter::convert_into_base64(
                                            public_path(
                                                'img/icons/megaphone-green.png'
                                            )
                                        ); ?> width="17px" style="margin-top:3px"></i></a>
                                        <a href="{{ route('confirm', ['product' => $product->id]) }}"
                                            class="btn btn-primary btn-sm" type="submit">Delete</a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7">Looks empty :( </td>
                                </tr>
                                @endforelse
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
<!-- <section class="section mt-0 mb-3 text-center">
    <div class="container">
        <div class="account-card">
            <div class="form-group mt-10">
                <div class="label">
                    <label for="description">Description</label>
                </div>
                <textarea id="description" name="description" rows="18" style="width: 98.8%">{{ $seller->seller_description }}
                </textarea>
                @error('description')
                <div class="error">
                    <small class="text-danger">{{ $errors->first('description') }}</small>
                </div>
                @enderror
            </div>
            <button class="btn btn-primary btn-sm" type="submit">Save</button>
            </form>
        </div>
    </div>
    </div> -->
@stop
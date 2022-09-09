@extends('master.main')
@section('content')

<title>Product - Squid Market</title>

<div class="content-master">
    @include('includes.flash.success')
    @include('includes.flash.error')
    <div class="container h2 mb-15">{{ $section != 'add' ? 'Edit product' : 'Add new product' }}</div>
    @include('includes.components.browserbar')
    @yield('product-form')
</div>

@stop
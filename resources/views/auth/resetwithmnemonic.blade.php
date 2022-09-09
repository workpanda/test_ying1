<?php namespace App\Tools; ?>
@extends('master.main')
@section('no-content')

<title>Mnemonic Password Recovery - Squid Market </title>

<body class="bg-dark">
    <div class="backdrop"></div>
    <section class="user-form-part">
        <div class="user-form-logo"><img style="width:400px;" src=<?php echo Converter::convert_into_base64(
            public_path('logo.png')
        ); ?> alt="logo"></div>

        <div class="container">
            <ul class="nav nav-tabs">
                <li><a href="{{route('login')}}" class="tab-link">Login</a></li>
                <li><a href="{{route('register')}}" class="tab-link">Sign up</a></li>
                <li><a href="#" class="tab-link">Check Mirror</a></li>
            </ul>
        </div>

        <section class="section mt-3">
            <div class="container">
                <div class="page-title">
                    <h5 class="fw-bold"><img src=<?php echo Converter::convert_into_base64(
                        public_path('img/icons/key-white.png')
                    ); ?> width="24px" style="margin-top:-3px"> Mnemonic Password Recovery</h5>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('resetpassword') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Mnemonic Password Recovery</li>
                    </ol>
                </div>
            </div>
        </section>

        <section class="section">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6 col-lg-5">
                        <div class="account-card shadow-lg">
                            <div class="icon-box text-center">
                                <img src=<?php echo Converter::convert_into_base64(
                                    public_path('img/icons/key.png')
                                ); ?> width="24px" style="margin-top:-3px">
                                <h4>Mnemonic Password Recovery</h4>
                            </div>

                            <div class="alert alert-warning text-center" role="alert">
                                When you reset your password, you wont be able to read your previous encrypted messages.
                            </div>
                            <p class="text-center text-dark"><strong>Enter your username and Mnemonic and your new
                                    password:</strong></p>

                            <form class="user-form" action="{{ route('post.resetwithmnemonic') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Username" name="username">
                                </div>
                                @error('username')
                                <p class="text-danger">{{ $errors->first('username') }}</p>
                                @enderror
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Mnemonic" name="mnemonic">
                                </div>
                                @error('mnemonic')
                                <p class="text-danger">{{ $errors->first('mnemonic') }}</p>
                                @enderror
                                <div class="form-group">
                                    <input type="password" class="form-control" id="password" placeholder="New password"
                                        name="password">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" id="password_confirmation"
                                        placeholder="Confirm new password" name="password_confirmation">
                                </div>
                                @error('password')
                                <p class="text-danger">{{ $errors->first('password') }}</p>
                                @enderror
                                <div class="form-group d-flex justify-content-center">
                                    <button type="submit" class="btn btn-primary btn-sm"><img src=<?php echo Converter::convert_into_base64(
                                        public_path(
                                            'img/icons/key-white-fill.png'
                                        )
                                    ); ?> width="15px" style="margin-top:-3px">
                                        Reset Password</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>
</body>

@stop
<?php namespace App\Tools; ?>
@extends('master.main')
@section('content')
<title>Conversations - Squid Market</title>

@include('includes.flash.success')
@include('includes.flash.error')
@include('includes.flash.validation')
<section class="section mt-3">
    <div class="container">
        <div class="page-title justify-content-center">
            <h5><img src="{{ asset('img/icons/messenger.png') }}" width="17px" style="margin-top:-3px"> Message Inbox
            </h5>
        </div>
    </div>
</section>
@php
$conv = \App\Models\Conversation::myLastMsg();
@endphp
<section class="section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="account-card shadow-lg">
                    <div class="icon-box text-center">
                        <img src=<?php echo Converter::convert_into_base64(
                            public_path('img/icons/messenger-black.png')
                        ); ?> style="margin-top:-3px;width:80px;height:60px">
                    </div>
                    <p><strong>Message Inbox Login</strong></p>
                    <p>Your Message Inbox is encrypted by Quest.</p>
                    <p>To access your private messages please enter your password.</p>
                    <p>Please remember that making any deals outside of Quest will result in a permanent ban.</p>
                    <p>Never trust any vendors asking you by private message to send the payment on forehand.</p>
                    <p>If you notice or encounter any strange of weird messages, Please report them to our helpdesk.
                    </p>
                    <form action="{{ route('openconversationmessages', ['selectedconv' => $conv]) }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label>Enter Password:</label>
                            <input type="password" class="form-control" name="password">
                        </div>
                        @include('includes.forms.captcha')
                        <div class="form-group d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary btn-sm"><img src=<?php echo Converter::convert_into_base64(
                                public_path('img/icons/key_.png')
                            ); ?> width="17px" style="margin-top:-3px">
                                Open Message Inbox
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@stop
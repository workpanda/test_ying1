@extends('master.main')
@section('content')

<title>Mnemonic - Squid Market </title>
<?php session()->forget('firstlogin'); ?>
<section class="section">
    <div class="container">
        <div class="alert alert-danger text-center text-uppercase">
            <h4 class="text-danger fw-bold">Your MNEMONIC, settings PIN & Automatically generated personal pharse</h4>
        </div>

        <div class="account-card" style="margin-bottom:10px">
            <div class="account-content text-center">
                <p><strong>Please take note of the securit credentials listed below. These are the Importance of each of
                        them.</strong></p>
                <ol>
                    <li><strong class="text-danger">MNEMONIC:</strong> It is Required if you loose your
                        <strong>PASSWORD</strong> or <strong>PIN</strong> and you want to recover it. Wihout this
                        <strong>MNEMONIC PHRASE</strong>. You will not be able to Retrieve your password or pin if
                        forgotten.
                    </li>
                    <li><strong class="text-danger">Squid GENERATED PASSPHRASE:</strong> We wont Let you create
                        Passphrase, Lets Generate it for you. You are given a random Squid Actor's out of Millions of
                        them. You get 1 as your Personal Phrase</li>
                </ol>
            </div>
        </div>

        <div class="account-card">
            <div class="account-content">
                <div class="row">
                    <div class="col-md-9 col-lg-6 alert fade show mb-3">
                        <div class="profile-card address h-100 mb-0">
                            <h6 class="text-danger">MNEMONIC</h6>
                            <p class="fw-bold" style="overflow-wrap: break-word">{{ auth()->user()->mnemonic }}</p>
                        </div>
                    </div>
                    <div class="col-md-9 col-lg-6 alert fade show mb-3">
                        <div class="profile-card address h-100 mb-0">
                            <h6 class="text-danger">Squid GENERATED PHRASE</h6>
                            <p class="fw-bold">{{ auth()->user()->phrase }}</p>
                        </div>
                    </div>
                </div>

                <p class="fw-bold h5 text-uppercase text-danger text-center">Please copy these information down
                    somewhere safe because it will be shown to you just this once. If you loose these info, You wont be
                    able to access your settings page or even able to change your password if forgotten, You can change
                    your personal phrase in your settings.</p>
                <p class="text-center">Remember that the login page will never ask for your mnemonic or your PIN. Be
                    careful, If you lose your PIN of 2FA private key and you cannot remember your mnemonic, your account
                    cannot be reset and this will result in loss of all your coins!</p>

                <div class="text-center"><a href="{{ route('home') }}" class="btn btn-primary">Yes! I have copied |
                        LETS
                        CONTINUE</a>
                </div>
            </div>
        </div>
    </div>
</section>

@stop
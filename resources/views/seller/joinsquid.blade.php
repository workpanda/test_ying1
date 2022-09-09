<?php namespace App\Tools; ?>
@extends('master.main')
@section('content')
<title>Join Squid - Squid Market</title>

<section class="section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-7">
                <div class="account-card shadow-lg">
                    <form action="{{ route('post.becomeseller') }}" method="post">
                        @csrf
                        <div class="icon-box text-center">
                            <img src=<?php echo Converter::convert_into_base64(
                                public_path('img/icons/key.png')
                            ); ?> style="margin-top:-3px;width:40px;height:40px">
                            <h4>Join as Squid Vendor</h4>
                        </div>
                        <div class="account-content text-center">
                            <textarea id="joinQuest" class="form-control" rows="8" cols="100" style="height: 240px;"
                                readonly>
Before moving forward please make sure you have added a Payment address to your account.
Also make sure you have added your PGP Key and activated 2FA.

Oonce you have done this, you can send the adequate amount for the Vendor Fee 750 USD.
After your payment has been confirmed (3 Confirmations) you will be able to clilk Confirm Vendorship.

Quest rules for Vendors:
Any form fo Child abuse/pormography is strictly forbidden to the highest of standards!

We do not allow the sale of items than can fatally harm another living entity.

At Quest we hold the right to ban your account at any time if we suspect any form of scamming.

We only request real product photos and not from the internet. Therefore all photos in your listings must be authenticated by your vendorname.

As a Vendor you will not attempt to impersonate another member and or vendopr.

As a Vendor you are not allowed to share contact details such as wickr, signal or private urls.
							</textarea>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered mt-3">
                                <thead>
                                    <tr>
                                        <th>Currency</th>
                                        <th>Payment Address</th>
                                        <th>Fee</th>
                                        <th>Received</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="d-flex justify-content-evenly">
                                                <img src=<?php echo Converter::convert_into_base64(
                                                    public_path('img/XMR2.png')
                                                ); ?> width="30" height="30" alt="xmr" style="margin-right: 3px">
                                                <div style="margin-top: 3px">XMR</div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="qr-text">bc1q8s23wj4tc5cdadsgsk4354nsdnksldklgkjskk7k9</div>
                                            <img src=<?php echo Converter::convert_into_base64(
                                                public_path('img/QR.png')
                                            ); ?> alt="qrcode" width="100">
                                        </td>
                                        <td>{{ $sellerFee }}</td>
                                        <td>{{ $totalReceived }}</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex justify-content-evenly">
                                                <img src=<?php echo Converter::convert_into_base64(
                                                    public_path(
                                                        'img/bitcoin.png'
                                                    )
                                                ); ?> width="30" height="30" alt="xmr" style="margin-right: 3px">
                                                <div style="margin-top: 3px">BTC</div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="qr-text">
                                                bc1q8s23wj4tc5cdadsgsk4354nsdnksldklgkjskk7k9
                                            </div>
                                            <img src=<?php echo Converter::convert_into_base64(
                                                public_path('img/QR.png')
                                            ); ?> alt="qrcode" width="100">
                                        </td>
                                        <td>{{ $sellerFee }}</td>
                                        <td>{{ $totalReceived }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        @if(is_null($user->pgp_key) or auth()->user()->two_factor == 0)
                        <div class="form-group d-flex justify-content-center mt-3">
                            <a href="{{ route('pgp') }}" class="btn btn-primary btn-sm"><img src=<?php echo Converter::convert_into_base64(
                                public_path('img/icons/dispute.png')
                            ); ?> width="15px" style="margin-top:-3px">
                                To become a Vendor first add your PGP Key and activate 2FA </a>
                        </div>
                        @else
                        <div class="form-group d-flex justify-content-center mt-3">
                            <button type="submit" class="btn btn-primary btn-sm"><img src=<?php echo Converter::convert_into_base64(
                                public_path('img/icons/check-circle.png')
                            ); ?> width="15px" style="margin-top:-3px">
                                Upgrade Account to Vendor </button>
                        </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@stop
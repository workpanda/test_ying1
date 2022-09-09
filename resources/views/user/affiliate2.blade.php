@extends('master.main')
@section('content')
<title>Referrals - Squid Market</title>

<section class="section mt-3 mb-3">
    <div class="container">
        <div class="page-title justify-content-center">
            <h5><i class="bi-person-plus"></i> Referrals</h5>
        </div>
    </div>
</section>
<section class="section mt-0">
    <div class="container">
        <div class="account-card">
            <h4 class="account-title">Referral</h4>
            <p>Earn money with us through our referral program!</p>
            <p>Refer users and earn up to 40% of the profit we make from their spendings on this website.</p>
            <p>Find your referral link below:</p>
            <p>Your Referral Link</p>
            <div class="qr-text qr-text-lg">
                {{ route('register', ['reference' => auth()->user()->reference_code]) }}
            </div>
        </div>
    </div>
</section>


@stop
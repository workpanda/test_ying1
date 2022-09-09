<?php namespace Aoo\Tools; ?>
@extends('master.main')
@section('content')

<section class="section mt-3 mb-3">
    <div class="container">
        <div class="page-title justify-content-center mb-0">
            <h5><img src=<?php echo Converter::convert_into_base64(
                public_path('img/icons/helpdesk.png')
            ); ?> width="17px" style="margin-top:-3px"> Admin PGP</h5>
        </div>
    </div>
</section>

<section class="section mt-0">
    <div class="container">

        <div class="account-card">
            <div class="account-title">
                <h4>Admin PGP & Moderator PGP keys</h4>
            </div>

            <div class="row">

                <div class="col-sm-18 col-md-18 col-lg-6 mb-3">
                    <p class="fw-bold">Phoenix PGP Key:</p>
                    <textarea class="form-control" style="height: 570px;" readonly>

-----BEGIN PGP PUBLIC KEY BLOCK-----

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
=r/EX
-----END PGP PUBLIC KEY BLOCK-----</textarea>
                </div>
                <div class="col-sm-18 col-md-18 col-lg-6 mb-3">
                    <p class="fw-bold">MockingJay PGP Key:</p>
                    <textarea class="form-control" style="height: 570px;" readonly>

-----BEGIN PGP PUBLIC KEY BLOCK-----

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
=r/EX
-----END PGP PUBLIC KEY BLOCK-----</textarea>
                </div>


            </div>
        </div>
    </div>
</section>


@stop
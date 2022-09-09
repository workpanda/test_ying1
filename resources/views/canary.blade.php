<?php namespace App\Tools; ?>
@extends('master.main')
@section('content')

<section class="section mt-3 mb-3">
    <div class="container">
        <div class="page-title justify-content-center mb-0">
            <h5><img src=<?php echo Converter::convert_into_base64(
                public_path('img/icons/helpdesk.png')
            ); ?> width="17px" style="margin-top:-3px"> Canary</h5>
        </div>
    </div>
</section>


<section class="section mt-0 mb-3">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-10 col-lg-10 mb-3">

                <div class="account-card">
                    <div class="icon-box text-center">
                        <img src=<?php echo Converter::convert_into_base64(
                            public_path('img/canary.png')
                        ); ?> style="width: 60px; height: 60px" />
                        <h4>Squid Canary:</h4>
                    </div>

                    <div class=" row">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <p class="fw-bold text-center">Squid Market PGP Key:</p>
                            <textarea class="form-control text-center" style="height: 570px;">

-----BEGIN PGP SIGNED MESSAGE-----
Hash: SHA512

Canary update October 17 2021.
All Quest servers are stable uncompromised and in control of Quest staff.
The latest bitcoin hash is:
00000000000000000004a87422fe0140dbc3d7497152445b6a7f881332a1e852

Next canary update will be within 3 weeks, signed by the main Quest PGP or one of it's Administrators.
-----BEGIN PGP SIGNATURE-----

iQIzBAEBCgAdFiEEfeyKR0chj/tbm7mUGgGhmCStHTwFAmFsnT0ACgkQGgGhmCSt
HTyabBAAu6AsFVXrjV7/HiEGBnk/crSu9ULq6KfyvI1v1bRkymFFUVEKcKMfvKGM
Y+eWoQrZXwB2j4tn1AH+LQzpRfKx1GrXc2Mdikz4FnkHFICLLCouaZKgBVv7wk5l
P6s6WOcNIxEwtSvK6JUDKQpJtc3SCKNfx0N0qiuRUVVMlbH8Ck1zp3Bj9kFZI/Xl
v2yKbrzKM8P08xM7qgymgmygpMAtThDtsAW3jyElHR3wyv1OlH44Yu8gLqxgDPdE
DWs0dEobqmoFUzAh8Iwg7rZn13p6sDLdUZOvMEMxABZfJ0dWtmTyC1DzOxPZmg+l
vs6dmVqO+81cocr8o7DmJhihgPHXzLbFkkJPJeKIvHbuWEMDi7XV87eG4P5Zlp1G
M7LZrFBBzY2NqdUkmeib4YhB00ExTMmzgxFHGwCG4lCUmol9aZwrNUJr4CuUMCVO
LdUgMUALAUGDK1D2/mC7SGJb3ofACXR3Q7eEVPKmQ47a5x7CcI2XfpXV7hkMXGPt
jlUup1BQQsfHbEsQGJuzgiGsc9ZOmnYBBkJzPoSiAsjqeHoDf16dClQ2C3s8QqSH
BOGkJZVHlZR7tLp0jHfPgsUb6WhphL2O8jLSEpmRdMxIOPGAsIVQl6PoMeiH6BTo
O5PTmW1Hx6JRZvISsEkXmrwm+AI3LK/GoFY1L5MoLZ4W128RWi0=
=YRlm
-----END PGP SIGNATURE-----
</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@stop
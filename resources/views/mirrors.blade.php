<?php namespace App\Tools; ?>
@extends('master.main')
@section('content')

<section class="section mt-3 mb-3">
    <div class="container">
        <div class="page-title justify-content-center mb-0">
            <h5><img src=<?php echo Converter::convert_into_base64(
                public_path('img/icons/list.png')
            ); ?> width="17px" style="margin-top:-3px"> Mirrors</h5>
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
                            public_path('img/icons/list-black.png')
                        ); ?> style="margin-top:-3px;width:40px;height:40px">
                        <h4>Current Squid Mirrors:</h4>
                    </div>

                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <p class="fw-bold text-center">Squid Market PGP Key:</p>
                            <textarea class="form-control text-center" style="height: 370px;">

-----BEGIN PGP SIGNED MESSAGE-----
Hash: SHA512

questxwvkwvsw2qgeeljz4fbv6cq2kbmapo7tw5heu4nng2ufgykapid.onion
questx5olhiv35lrydy5glk6x64zcxlrepgqic7jlzi3uqyurqtltfad.onion
questx4pxdwytknsodzsraxwajkseonfbu2lc74pnmy74tok3lnuhmad.onion
questxpskfwwxcjlroiqye4y6m2ce4tcuu6r7wd5zt3wychqszukj2qd.onion
questx7deerotyvnoejn7omvsx26m6nvxsxeb642dqps2zxw5peqc6qd.onion
questxi4tp34jbd7vowuk6njqc7bi6xlqqziwz7rwbtj4ckj23j4jmqd.onion
questxrbeu2f2m6sqobh35xfsyc5pfvesdfngwdc3q2x2zhntbjt6aqd.onion
questxnwyufqbzufn2h2hezifkty3feipyjbj73e77r3abq2bvy4ikqd.onion
questx24eprwsvoilphdrdpihcfsxza5aeje3x4mlifugc2zclx2zmid.onion
questxkqz7yhkdvwe7e4k6i4t7vo6i22ccvtuyf7b5zyobau4faqbxad.onion
-----BEGIN PGP SIGNATURE-----

iQIzBAEBCgAdFiEEfeyKR0chj/tbm7mUGgGhmCStHTwFAmFa2yQACgkQGgGhmCSt
HTylgw//XM4YYMexZyw1kNlmaX5oYmx96FLjoDLk262+jTSsULZZfGU7sgkOKRtn
f/LE/Pzql4gHpv4Rr1x98NdlDyb2WQZ6ghxHS8YCIAjPj7F8em/lMmnwnCJeNIIf
fmwH+lyM0PLYn1r1RWXW6hSzz0cVxOxO6JlbqDV4WdFmK+R6nfOrKrps0mQIHLGq
vnAEab4NCf06P932GHfNygXLCvXXmEzD/k4sQZ6ZN6HNO4xl79YCpSZPxYfa7DLM
lPB1y1J/bi3x9Aki87Z2eSpF/+f5xvkBtxZsfBmpbAj9Hqbps3u32TSYYDdyugEU
1Dzy+oumQFX7zIciwMJRdjKdUxSZaq77uBgO56O+qBtxNNkaWmesCQOjebNELjGE
5nNVcbnojj85Y3AWaVMS5sCfUMVqFa6YribwDexmBq1vlEkIN0h1MwXnrhQDlEBx
zar4X1LudAo+ndCJVOTPxuotw96G2/u27vBeBXKK406iDm5+GXUq3rF4YEiEOCXb
+D/Pnlzdz9992D1xsaNPWi/sVZMf2WplMYA7gMg+pE3nQwdh0SpNdbOfQfUSJdVR
rlOYvZlzOR+FV6sI+EeCVi6SxPQwVdqPCnVAwx2iP5x1gB74jbJo+yUx6pIJfaVz
Fbh6Uz+Q0e7p8O8ThXwhuWmftqSlHYXFKxurlsOnueRX9fk/ZfQ=
=+EOO
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
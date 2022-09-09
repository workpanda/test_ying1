<?php

namespace App\Tools; ?>
<footer>
    <footer class="footer-part">
        <div class="row" style="margin-left: 5%">
            <div class="col-sm-6 col-xl-3">
                <div class="footer-widget">
                    <a class="footer-logo" href="#"><img src="{{asset('logo.png')}}" alt="logo"></a>
                    <ul class="footer-social mb-3">
                        <ul class="footer-social">
                            <li><a href="#"><img src="{{asset('img/social-5.png')}}" alt="social icon"></a></li>
                        </ul>
                </div>
            </div>
            <div class="col-sm-6 col-6 col-xl-2">
                <div class="footer-widget">
                    <h3 class="footer-title">Information</h3>
                    <div class="footer-links">
                        <ul>
                            <li><a href="{{ route('about') }}">FAQ</a></li>
                            <li><a href="#">Rules</a></li>
                            <li><a href="{{ route('mirrors') }}">Mirrors</a></li>
                            <li><a href="{{ route('ticket') }}">Helpdesk</a></li>
                            <li><a href="{{ route('adminpgp') }}">Market PGP</a></li>
                            <li><a href="{{ route('canary') }}">Canary</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-6 col-xl-2">
                <div class="footer-widget">
                    <h3 class="footer-title">Links</h3>
                    <div class="footer-links">
                        <ul>
                            <li>Dread</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-6 col-xl-3">
                <div class="footer-widget">
                    <h3 class="footer-title">Exchange Rate</h3>
                    <div class="footer-links">
                        <ul>
<li>1 XMR = USD {{ Converter::moneroLastPrice() }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-6 col-xl-2">
                <div class="footer-widget">
                    <h3 class="footer-title">Currencies</h3>
                    <ul class="d-flex">
                        <li><a href="#"><img src="{{asset('img/XMR2.png')}}" width="30" height="30" alt="xmr"></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="footer-bottom">
                    <p class="footer-copytext text-center">&copy; All Copyrights Reserved</p>
                </div>
            </div>
        </div>
    </footer>

</footer>
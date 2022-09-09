<?php namespace App\Tools; ?>
@extends('master.main')
@section('content')

<title>FAQ - Squid Market</title>

<section class="section mt-3 mb-3">
    <div class="container">
        <div class="page-title justify-content-center mb-0">
            <h5> <img src=<?php echo Converter::convert_into_base64(
                public_path('img/icons/plus-circle.png')
            ); ?> width="17px" style="margin-top:-3px">
                FAQ</h5>
        </div>
    </div>
</section>

<section class="section mt-0">
    <div class="container">
        <div class="account-card">
            <div class="row">
                <div class="col-md-12 col-lg-6 mb-3">
                    <div class="icon-box text-center">
                        <img src=<?php echo Converter::convert_into_base64(
                            public_path('img/icons/user-plus-black.png')
                        ); ?> style="margin-top:-3px;width:40px;height:40px">
                        <h4>Customer Frequently Asked Questions</h4>
                    </div>
                    <div class="accordion">
                        <div class="option">
                            <input type="checkbox" id="toggle1" class="toggle" />
                            <label class="title" for="toggle1">What must I do first?</label>
                            <div class="content">
                                <div>
                                    <p>When you just signed up the first 2 things to do are: </p>
                                    <p class="faq-q"><span>1</span> Add your payment address in your preferred currency
                                        address to receive refunds. </p>
                                    <p class="faq-a">You can do this on the Payment settings page under Settings.</p>
                                    <p class="faq-q"><span>2</span> For extra security add your Public PGP Key and
                                        enable 2FA. </p>
                                    <p class="faq-a">You can do this on the PGP Settings page under Settings and
                                        afterwards on the 2FA Settings page also under Settings.</p>
                                </div>
                            </div>
                        </div>

                        <div class="option">
                            <input type="checkbox" id="toggle2" class="toggle" />
                            <label class="title" for="toggle2">How can I pay for my order?</label>
                            <div class="content">
                                <div>
                                    <p>We accept 2 different Crypto Currencies: </p>
                                    <p class="faq-q"><span>1</span> You can pay your order with Bitcoin by sending it to
                                        the address on the order page.</p>
                                    <p class="faq-a">When you checkout, you will automatically be taken to the order
                                        page.</p>
                                    <p class="faq-q"><span>2</span> You can also pay with Monero and it works the same
                                        as noted above with Bitcoin.</p>
                                    <p class="faq-a">When you checkout, you will automatically ve taken to the order
                                        page.</p>
                                    <p>All orders will show up as paid after it they have received 3 confirmations.</p>
                                </div>
                            </div>
                        </div>

                        <div class="option">
                            <input type="checkbox" id="toggle3" class="toggle" />
                            <label class="title" for="toggle3">Where do I give my delivery details?</label>
                            <div class="content">
                                <div>
                                    <p>When you have added your product in your basket, you have 2 options:</p>
                                    <p class="faq-q"><span>1</span> If it's for a product that requires shipping you can
                                        enter your details</p>
                                    <p class="faq-a">on the cart page; don't forget to click on save changes. <br>
                                        Once you click save changes it will ensure that when checking out your details
                                        get encrypted.</p>
                                    <p class="faq-q"><span>2</span> If it's for a product that does not require any
                                        shipping then you can leave it blank.</p>
                                    <p class="faq-a">In most cases these products will be delivered automatically to
                                        your order page after payment.<br>
                                        If the product does not have automatic delivery, then the vendor will send it to
                                        your private inbox after payment. </p>
                                </div>
                            </div>
                        </div>

                        <div class="option">
                            <input type="checkbox" id="toggle4" class="toggle" />
                            <label class="title" for="toggle4">I think I got scammed, what must I do?</label>
                            <div class="content">
                                <div>
                                    <p>When you have added your product in your basket, you have 2 options:</p>
                                </div>
                            </div>
                        </div>

                        <div class="option">
                            <input type="checkbox" id="toggle5" class="toggle" />
                            <label class="title" for="toggle5">What must I do if I get an error page?</label>
                            <div class="content">
                                <div>
                                    <p>When you have added your product in your basket, you have 2 options:</p>
                                </div>
                            </div>
                        </div>

                        <div class="option">
                            <input type="checkbox" id="toggle6" class="toggle" />
                            <label class="title" for="toggle6">Is it safe to make deals outside of Quest?</label>
                            <div class="content">
                                <div>
                                    <p>When you have added your product in your basket, you have 2 options:</p>
                                </div>
                            </div>
                        </div>

                        <div class="option">
                            <input type="checkbox" id="toggle7" class="toggle" />
                            <label class="title" for="toggle7">Is it safe to use Finalize Early listings?</label>
                            <div class="content">
                                <div>
                                    <p>When you have added your product in your basket, you have 2 options:</p>
                                </div>
                            </div>
                        </div>

                        <div class="option">
                            <input type="checkbox" id="toggle8" class="toggle" />
                            <label class="title" for="toggle8">How does Escrow work?</label>
                            <div class="content">
                                <div>
                                    <p>When you have added your product in your basket, you have 2 options:</p>
                                </div>
                            </div>
                        </div>

                        <div class="option">
                            <input type="checkbox" id="toggle9" class="toggle" />
                            <label class="title" for="toggle9">How does Finalize Early work?</label>
                            <div class="content">
                                <div>
                                    <p>When you have added your product in your basket, you have 2 options:</p>
                                </div>
                            </div>
                        </div>

                        <div class="option">
                            <input type="checkbox" id="toggle10" class="toggle" />
                            <label class="title" for="toggle10">How can I leave feedback?</label>
                            <div class="content">
                                <div>
                                    <p>When you have added your product in your basket, you have 2 options:</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-md-12 col-lg-6 mb-3">
                    <div class="icon-box text-center">
                        <img src=<?php echo Converter::convert_into_base64(
                            public_path('img/icons/helpdesk-black.png')
                        ); ?> style="margin-top:-3px;width:40px;height:40px">
                        <h4>Vendor Frequently Asked Questions</h4>
                    </div>
                    <div class="accordion">
                        <div class="option">
                            <input type="checkbox" id="toggle21" class="toggle" />
                            <label class="title" for="toggle21">How can I become a vendor?</label>
                            <div class="content">
                                <div>
                                    <p>When you just signed up the first 2 things to do are: </p>
                                    <p class="faq-q"><span>1</span> Add your payment address in your preferred currency
                                        address to receive refunds. </p>
                                    <p class="faq-a">You can do this on the Payment settings page under Settings.</p>
                                    <p class="faq-q"><span>2</span> For extra security add your Public PGP Key and
                                        enable 2FA. </p>
                                    <p class="faq-a">You can do this on the PGP Settings page under Settings and
                                        afterwards on the 2FA Settings page also under Settings.</p>
                                </div>
                            </div>
                        </div>

                        <div class="option">
                            <input type="checkbox" id="toggle22" class="toggle" />
                            <label class="title" for="toggle22">How do I add a new product?</label>
                            <div class="content">
                                <div>
                                    <p>We accept 2 different Crypto Currencies: </p>
                                    <p class="faq-q"><span>1</span> You can pay your order with Bitcoin by sending it to
                                        the address on the order page.</p>
                                    <p class="faq-a">When you checkout, you will automatically be taken to the order
                                        page.</p>
                                    <p class="faq-q"><span>2</span> You can also pay with Monero and it works the same
                                        as noted above with Bitcoin.</p>
                                    <p class="faq-a">When you checkout, you will automatically ve taken to the order
                                        page.</p>
                                    <p>All orders will show up as paid after it they have received 3 confirmations.</p>
                                </div>
                            </div>
                        </div>

                        <div class="option">
                            <input type="checkbox" id="toggle23" class="toggle" />
                            <label class="title" for="toggle23">Am I allowed to sell anything on Quest?</label>
                            <div class="content">
                                <div>
                                    <p>When you have added your product in your basket, you have 2 options:</p>
                                </div>
                            </div>
                        </div>

                        <div class="option">
                            <input type="checkbox" id="toggle24" class="toggle" />
                            <label class="title" for="toggle24">I think a Customer is trying to scam me?</label>
                            <div class="content">
                                <div>
                                    <p>When you have added your product in your basket, you have 2 options:</p>
                                </div>
                            </div>
                        </div>

                        <div class="option">
                            <input type="checkbox" id="toggle25" class="toggle" />
                            <label class="title" for="toggle25">A Customer has not yet released my funds?</label>
                            <div class="content">
                                <div>
                                    <p>When you have added your product in your basket, you have 2 options:</p>
                                </div>
                            </div>
                        </div>

                        <div class="option">
                            <input type="checkbox" id="toggle26" class="toggle" />
                            <label class="title" for="toggle26">Is it safe to make deals outside of Quest?</label>
                            <div class="content">
                                <div>
                                    <p>When you have added your product in your basket, you have 2 options:</p>
                                </div>
                            </div>
                        </div>

                        <div class="option">
                            <input type="checkbox" id="toggle27" class="toggle" />
                            <label class="title" for="toggle27">Can I request Finalize Early?</label>
                            <div class="content">
                                <div>
                                    <p>When you have added your product in your basket, you have 2 options:</p>
                                </div>
                            </div>
                        </div>

                        <div class="option">
                            <input type="checkbox" id="toggle28" class="toggle" />
                            <label class="title" for="toggle28">How long do funds stay in Escrow?</label>
                            <div class="content">
                                <div>
                                    <p>When you have added your product in your basket, you have 2 options:</p>
                                </div>
                            </div>
                        </div>

                        <div class="option">
                            <input type="checkbox" id="toggle29" class="toggle" />
                            <label class="title" for="toggle29">Can I give Quest suggestions?</label>
                            <div class="content">
                                <div>
                                    <p>When you have added your product in your basket, you have 2 options:</p>
                                </div>
                            </div>
                        </div>

                        <div class="option">
                            <input type="checkbox" id="toggle30" class="toggle" />
                            <label class="title" for="toggle30">Can I become a Vendor for free on Quest?</label>
                            <div class="content">
                                <div>
                                    <p>When you have added your product in your basket, you have 2 options:</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</section>


@stop
@extends('master.main')
@section('content')

<section class="section mt-3 mb-3">
    <div class="container">
        <div class="page-title justify-content-center mb-0">
            <h5><img src=<?php echo Converter::convert_into_base64(
                public_path('img/icons/chat.png')
            ); ?> width="17px" style="margin-top:-3px"> Helpdesk</h5>
        </div>
    </div>
</section>

<section class="section mt-0 mb-3">
    <div class="container">
        <div class="account-card">
            <div class="row">
                <div class="col-md-4 col-lg-4 mb-3">
                    <h4 class="mb-3">Helpdesk Tickets:</h4>
                    <ul class="nav nav-account">
                        <li class="nav-item active">
                            <a href="#" class="justify-content-center"><?php echo Converter::convert_into_base64(
                                public_path('img/icons/plus-circle.png')
                            ); ?> New Helpdesk
                                Ticket</a>
                        </li>
                    </ul>
                    <div class="alert alert-warning text-center" role="alert">
                        Your have no Helpdesk tickets
                    </div>
                </div>

                <div class="col-md-8 col-lg-8">
                    <form class="contact-form">
                        <h4 class="mb-3">Create Helpdesk Ticket</h4>
                        <div class="form-group">
                            <label>Subject:</label>
                            <input class="form-control" type="text" placeholder="Enter Subject">
                        </div>
                        <div class="form-group">
                            <label>Subject Message:</label>
                            <textarea class="form-control" placeholder="Enters Message"></textarea>
                        </div>
                        <button type="submit" class="form-btn-group">
                            Open Helpdesk Ticket <i class="bi-chat"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@stop
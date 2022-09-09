@extends('master.main')
@section('content')
<title> Messages - Squid Market</title>

@include('includes.flash.success')
@include('includes.flash.error')
@include('includes.flash.validation')
<section class="section mt-3 mb-3">
    <div class="container">
        <div class="page-title justify-content-center mb-0">
            <h5><i class="bi-inbox"></i> Messages with {{ $conversation->otherUser() }} </h5>
        </div>
    </div>
</section>

<form action="{{ route('post.conversationmessages', ['conversation' => $conversation->id]) }}" method="POST">
    @csrf
    <section class="section mt-0 mb-3">
        <div class="container">
            <div class="account-card">
                <div class="col-md-8 col-lg-12">
                    <form class="contact-form mb-3">
                        <h4 class="mb-3">Messages - {{ $conversation->otherUser() }} <small><a
                                    href="{{route('conversations')}}">Back to messages</a></small></h4>
                        @foreach($conversationMessages->reverse() as $conversationMessage)
                        <br>
                        <div class="card">
                            <div class="card-body">
                                @if($conversationMessage->issuer_id == auth()->user()->id)
                                {{ $conversationMessage->decryptMessage() }}
                                @else
                                <?php echo $conversationMessage->violateMessage(); ?>
                                @endif
                            </div>
                            <div class="card-footer text-end">
                                {{ $conversationMessage->creationDate() }}
                                <strong>{{ $conversationMessage->user->username }} </strong>
                            </div>
                        </div>
                        @endforeach
                        <br>
                        @if($conversation->otherUser() !== 'STAFF MESSAGE')
                        <div class="form-group">
                            <label>Compose Message:</label>
                            <textarea class="form-control" id="message" name="message"
                                placeholder="Type Message Here..."></textarea>
                            @error('message')
                            <div class="error">
                                <small class="text-danger">{{ $errors->first('message') }}</small>
                            </div>
                            @enderror
                        </div>
                        <label for="encrypted">Auto encrypt</label>
                        <input type="checkbox" id="encrypted" name="encrypted" value="1">
                        <br>
                        @include('includes.forms.captcha')
                        <button type="submit" class="form-btn-group">
                            Send Message <i class="bi-plus-circle"></i>
                        </button>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </section>
</form>

@stop
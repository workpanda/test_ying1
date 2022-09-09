@extends('master.main')
@section('content')

<title>Messages - Squid Market</title>

<section class="section mt-3 mb-3">
    <div class="container">
        <div class="page-title justify-content-center mb-0">
            <h5><i class="bi-chat"></i> Message Inbox</h5>
        </div>
    </div>
</section>
<section class="section mt-0 mb-3">
    <div class="container">
        <div class="account-card">
            <div class="row">
                <div class="col-md-4 col-lg-4 mb-3">
                    <h4 class="mb-3">Messages:</h4>
                    <ul class="nav nav-account">
                        <li class="nav-item active">
                            <a href="" class="justify-content-center"><i class="bi-plus-circle"></i> New Message</a>
                        </li>
                    </ul>

                    <table class="table-responsive" style="width: 100%">
                        <thead>
                            <tr>
                                <th>Username</th>
                                <th>New Messages </th>
                                <th>All</th>
                                <th>View</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($conversations as $conversation)
                            <tr>
                                <td style="white-space: nowrap">{{ $conversation->otherUser() }}</td>
                                <td>{{ $conversation->unreadMessages() }}</td>
                                <td>{{ $conversation->totalMessages() }}</td>
                                <td><a
                                        href="{{ route('conversationmessages', ['conversation' => $conversation->id]) }}">Go</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $conversations->links('includes.components.pagination') }}
                </div>

                <div class="col-md-8 col-lg-8">
                    <form action="{{ route('post.conversations') }}" method="post">
                        @csrf
                        <form class="contact-form">
                            <h4 class="mb-3">Create New Message</h4>
                            <div class="form-group">
                                <label>Username:</label>
                                <input class="form-control" type="text" id="username" name="username"
                                    value="{{ $user }}" placeholder="Enter Username">
                                @error('username')
                                <div class="error">
                                    <small class="text-danger">{{ $errors->first('username') }}</small>
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Message:</label>
                                <textarea class="form-control" id="message" name="message"
                                    placeholder="Enter Message"></textarea>
                                @error('message')
                                <div class="error">
                                    <small class="text-danger">{{ $errors->first('message') }}</small>
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="encrypted">Auto encrypt</label>
                                <input type="checkbox" id="encrypted" name="encrypted" value="1">
                                @include('includes.forms.captcha')
                                <button type="submit" class="form-btn-group">
                                    Send New Message <i class="bi-chat"></i>
                                </button>
                            </div>
                        </form>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>


@stop
@extends('master.main')
@section('content')
<title>Chat Message - Squid Market</title>

<section class="section mt-3 mb-0">
    <div class="container">
        <div class="page-title justify-content-center">
            <h5 class="fw-bold"><img src="{{ asset('img/icons/messenger.png') }}" width="17px" style="margin-top:-3px">
                Message Inbox</h5>
        </div>
    </div>
</section>

<div class="mb-5">
    <input type="checkbox" id="toogle-uChat">
    <section class="main-grid container" style="padding-left:0px; padding-right: 0px;">
        <aside class="main-side">
            <header class="common-header">
                <div class="common-header-start">
                    <button class="u-flex js-user-nav align-items-center">
                        <label for="toggle-info-me">
                            <img class="profile-image" src="{{ auth()->user()->avatar }}" alt="User"
                                style="cursor:pointer">
                        </label>
                        <span style="font-size:16px">&nbsp;{{ auth()->user()->username }}(Me)</span>
                    </button>
                </div>
                <nav class="common-nav">
                    <ul class="common-nav-list">
                        <li class="common-nav-item">
                            <button class="common-button">
                                <label for="toggle-new-message">
                                    <img src="{{ asset('img/icons/chat-grey.png') }}" width="18px"
                                        style="cursor:pointer" />
                                </label>
                            </button>
                        </li>
                        <!-- <li class="common-nav-item">
                            <button class="common-button">
                                <span class="icon icon-menu" aria-label="menu"></span>
                            </button>
                        </li> -->
                    </ul>
                </nav>
            </header>

            <section class="common-alerts">
                @include('includes.flash.validation')
                @include('includes.flash.success')
                @include('includes.flash.error')
            </section>
            <section class="common-search">
                <button><img src="{{ asset('img/icons/search.png') }}" width="15px" style="margin-top:-3px"></button>
                <input type="search" class="text-input" placeholder="Search">
            </section>
            <section class="chats">
                <ul class="chats-list">
                    @forelse($conversations as $conv)
                    <a href="{{ route('selectconv', ['conversation' => $conv->id]) }}">
                        <li class="chats-item">
                            <label for=""
                                class="toogle-uChat @if($conv->id == $selectedconv->id) toggle-uChat-active @endif">
                                <div class="chats-item-button js-chat-button" role="button" tabindex="0">
                                    <img class="profile-image" @if($conv->otherUser()->username=='STAFF MESSAGE')
                                    src="{{ asset('img/user.jpg') }}" @else src="{{ $conv->otherUser()->avatar }}"
                                    @endif alt="User">
                                    @if(Cache::has('user-is-online-' . $conv->otherUser()->id))
                                    <span class="user-online"></span>
                                    @else
                                    <span class="user-offline"></span>
                                    @endif
                                    <header class="chats-item-header">
                                        <h3 class="chats-item-title">{{ $conv->otherUser()->username }}</h3>
                                        <time
                                            class="chats-item-time">@if($conv->conversationMessages()->latest()->first()
                                            !=
                                            null){{ $conv->conversationMessages()->latest()->first()->creationDate() }}
                                            @endif</time>
                                    </header>
                                    <div class="chats-item-content">
                                        <p class="chats-item-last">
                                            @if($conv->conversationMessages()->latest()->first() != null)
                                            @if($conv->conversationMessages()->latest()->first()->issuer_id ==
                                            auth()->user()->id)
                                            {{ $conv->conversationMessages()->latest()->first()->decryptMessage() }}
                                            @else
                                            <?php echo $conv
                                                ->conversationMessages()
                                                ->latest()
                                                ->first()
                                                ->violateMessage(); ?>
                                            @endif
                                            @endif
                                        </p>
                                        <ul class="chats-item-info">
                                            <li class="chats-item-info-item u-hide"><span class="icon-silent"></span>
                                            </li>
                                            @if($conv->unreadMessages() != 0)
                                            <li class="chats-item-info-item"><span
                                                    class="unread-messsages">{{ $conv->unreadMessages() }}</span>
                                            </li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </label>
                        </li>
                    </a>
                    @empty
                    @endforelse
                </ul>
            </section>
        </aside>
        <main class="main-content" style="height: 700px;">

            <header class="common-header">
                <div class="common-header-start">
                    <label for="toogle-uChat" class="common-button is-only-mobile u-margin-end js-back ps-0">
                        <span class="icon icon-back"><i class="bi-forward"></i></span>
                    </label>
                    @if(!is_null($selectedconv) and $selectedconv->otherUser()->username != 'STAFF MESSAGE')
                    <button class="u-flex js-side-info-button text-start">
                        <label for="toggle-info">
                            <img class="profile-image" src="{{ $selectedconv->otherUser()->avatar }}"
                                style="cursor:pointer" alt="User">
                        </label>

                        <div class="common-header-content mx-0">
                            <h2 class="common-header-title">{{ $selectedconv->otherUser()->username }}</h2>
                            <p class="common-header-status small text-secondary">
                                {{ date('H:i M d', strtotime($selectedconv->otherUser()->last_login)) }}</p>
                        </div>
                    </button>
                    @elseif(!is_null($selectedconv) and $selectedconv->otherUser()->username == 'STAFF MESSAGE')
                    <span class="d-flex align-items-center fw-bold">STAFF MESSAGE : <span class="text-danger">You can't
                            reply</span></span>
                    @else
                    @endif
                </div>
                <nav class="common-nav">
                    <ul class="common-nav-list">
                        <li class="common-nav-item">
                            <button class="common-button">
                                <label for="toggle-report">
                                    <span class="icon"><img src="{{ asset('img/icons/report.png') }}" width="15px"
                                            height="15px" style="margin-top:-3px"> <span>&nbsp;Report</span></span>
                                </label>
                            </button>
                        </li>
                        <li class="common-nav-item">
                            <button class="common-button">
                                <span class="icon icon-attach"><img src="{{ asset('img/icons/user-plus-black.png') }}"
                                        width="17px" height="15px" style="margin-top:-3px"><span>&nbsp;Invite
                                        Admin</span></span>
                            </button>
                        </li>
                        <!-- <li class="common-nav-item">
                            <button class="common-button u-animation-click js-side-info-button">
                                <span class="icon icon-menu" aria-label="menu"></span>
                            </button>
                        </li> -->
                    </ul>
                </nav>
            </header>
            @php
            if(is_null($selectedconv))
            $messages = [];
            else
            $messages = $selectedconv->messages();
            @endphp
            <div class="messanger" style="background-image:url({{ asset('img/message_back.png') }});">
                <ol class="messanger-list">
                    <!-- <li class="common-message is-time">
                        <p class="common-message-content">Today</p>
                    </li> -->
                    @forelse($messages as $message)
                    <li class="d-flex @if($message->issuer_id == auth()->user()->id) is-you @else is-other @endif">
                        <div class="d-flex flex-column align-items-center" id="user">
                            <img class="rounded-circle flex-shrink-0" src="{{ $message->user->avatar }}" alt=":("
                                style="width: 40px; height: 40px;">
                            <span>{{ $message->user->username }}</span>
                        </div>
                        <div class="common-message">
                            <p class="common-message-content">
                                @if($message->issuer_id == auth()->user()->id)
                                {{ $message->decryptMessage() }}
                                @else
                                <?php echo $message->violateMessage(); ?>
                                @endif
                            </p>
                            @if($message->read==1)
                            <span class="status is-seen"><i class="bi-check-all"></i></span>
                            @else
                            <span class="status"><i class="bi-check"></i></span>
                            @endif
                            <time datetime>{{ $message->creationDate() }}</time>
                        </div>
                    </li>
                    @if($message->checkViolate() == 'Yes' and $message->issuer_id != auth()->user()->id)
                    <div class="@if($message->issuer_id == auth()->user()->id) is-you @else is-other @endif">
                        <div class="d-flex align-items-center">
                            <img src="{{ asset('img/icons/warning-red.png') }}" width="15px" />
                            <i class="text-danger fw-bold ">This
                                might be a scammer, do not contact him outside the market, be
                                careful!</i>
                        </div>
                    </div>
                    @endif
                    @empty
                    @endforelse
                </ol>
            </div>
            @if(!is_null($selectedconv) and $selectedconv->otherUser()->username != 'STAFF MESSAGE')
            <form method="post" class="message-box"
                action="{{ route('post.conversationmessages', ['conversation' => $selectedconv->id]) }}">
                @csrf
                <!-- <button class="common-button"><span class="icon"><i class="bi-emoji-smile"></i></span></button> -->
                <input type="text" class="text-input" id="message-box" name="message" placeholder="Type a message"
                    contenteditable>
                <button id="submit-button" class="common-button" type="submit">Send</button>
            </form>
            @endif
            <!-- <button id="submit-button" class="common-button">
                    <span class="icon">
                        <label for="upload" class="file-upload__label"><i class="bi-image"></i></label>
                        <input id="upload" class="file-upload__input" type="file" name="file-upload"></span>
                </button> -->
        </main>
        <input type="checkbox" id="toggle-info" style="display:none" />
        <aside class="main-info">
            <header class="common-header">
                <!-- <button class="common-button js-close-main-info"><span class="icon"><i
                            class="bi-x-lg"></i></span></button> -->
                <div class="common-header-content">
                    <h3 class="common-header-title">Info</h3>
                </div>
            </header>
            @if(!is_null($selectedconv))
            <div class="main-info-content">
                <section class="common-box">
                    <img class="main-info-image" src="{{ $selectedconv->otherUser()->avatar }}" alt="User">
                    <h4 class="big-title text-center">{{ $selectedconv->otherUser()->username }}</h4>
                    <h6 class="big-title text-center">
                        @if($selectedconv->otherUser()->seller == 1)
                        Seller Since {{ date('M Y', strtotime($selectedconv->otherUser()->seller_since)) }}
                        <div class="product-rating">
                            <i class="active bi-star"></i>
                            <i class="active bi-star"></i>
                            <i class="active bi-star"></i>
                            <i class="active bi-star"></i>
                            <i class="bi-star"></i>
                            <a href="#">(3)</a>
                        </div>
                        @else
                        Joined Squid : {{ date('M Y', strtotime($selectedconv->otherUser()->created_at)) }}
                        <div class="product-rating">
                            <i class="active bi-star"></i>
                            <i class="active bi-star"></i>
                            <i class="active bi-star"></i>
                            <i class="active bi-star"></i>
                            <i class="bi-star"></i>
                            <a href="#">(3)</a>
                        </div>
                        @endif
                    </h6>
                </section>
                <section class="common-box">
                    <h5 class="section-title">About</h5>
                    @if($selectedconv->otherUser()->seller == 1)
                    <p>Total Sales : {{ $selectedconv->otherUser()->totalSales('delivered') }}</p>
                    <p>Total Products :
                        {{ \App\Models\Product::totalfeaturedproductsofseller($selectedconv->otherUser()->id) }}</p>
                    <p>{{ $selectedconv->otherUser()->seller_description }}</p>
                    @else
                    <p>Total Purchaes : {{ $selectedconv->otherUser()->totalOrdersCompleted() }}</p>
                    <p>{{ $selectedconv->otherUser()->description }}</p>
                    @endif
                </section>
            </div>
            @endif
        </aside>
        <input type="checkbox" id="toggle-info-me" style="display:none" />
        <aside class="main-info-me">
            <header class="common-header">
                <!-- <button class="common-button js-close-main-info"><span class="icon"><i
                            class="bi-x-lg"></i></span></button> -->
                <div class="common-header-content">
                    <h3 class="common-header-title">Info</h3>
                </div>
            </header>
            <div class="main-info-content">
                <section class="common-box">
                    <img class="main-info-image" src="{{ auth()->user()->avatar }}" alt="User">
                    <h4 class="big-title text-center">{{ auth()->user()->username }}</h4>
                    <h6 class="big-title text-center">
                        @if(auth()->user()->seller == 1)
                        Seller Since {{ date('M Y', strtotime(auth()->user()->seller_since)) }}
                        <div class="product-rating">
                            <i class="active bi-star"></i>
                            <i class="active bi-star"></i>
                            <i class="active bi-star"></i>
                            <i class="active bi-star"></i>
                            <i class="bi-star"></i>
                            <a href="#">(3)</a>
                        </div>
                        @else
                        Joined Squid : {{ date('M Y', strtotime(auth()->user()->created_at)) }}
                        <div class="product-rating">
                            <i class="active bi-star"></i>
                            <i class="active bi-star"></i>
                            <i class="active bi-star"></i>
                            <i class="active bi-star"></i>
                            <i class="bi-star"></i>
                            <a href="#">(3)</a>
                        </div>
                        @endif
                    </h6>
                </section>
                <section class="common-box">
                    <h5 class="section-title">About</h5>
                    @if(auth()->user()->seller == 1)
                    <p>Total Sales : {{ auth()->user()->totalSales('delivered') }}</p>
                    <p>Total Products : {{ \App\Models\Product::totalfeaturedproductsofseller(auth()->user()->id) }}</p>
                    <p>{{ auth()->user()->seller_description }}</p>
                    @else
                    <p>Total Purchaes : {{ auth()->user()->totalOrdersCompleted() }}</p>
                    <p>{{ auth()->user()->description }}</p>
                    @endif
                </section>
            </div>
        </aside>
        <input type="checkbox" id="toggle-new-message" style="display:none" />
        <aside class="send-new-message">
            <header class="common-header">
                <!-- <button class="common-button js-close-main-info"><span class="icon"><i
                            class="bi-x-lg"></i></span></button> -->
                <div class="common-header-content d-flex align-items-center">
                    <img src="{{ asset('img/icons/chat-grey.png') }}" width="16px" />
                    <h3 class="common-header-title">&nbsp;Send New Message</h3>
                </div>
            </header>
            <div class="main-info-content">
                <section class="common-box">
                    <form method="post" action="{{ route('post.conversations') }}">
                        @csrf
                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label text-start">To:</label>
                            <div class="col-sm-8 d-flex align-items-center justify-content-between">
                                <input type="text" class="form-control" id="username" name="username" value=""
                                    placeholder="To">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label text-start">Message:</label>
                            <div class="col-sm-8 d-flex align-items-center justify-content-between">
                                <textarea class="form-control" id="message" name="message"
                                    placeholder="message..."></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <button class="btn btn-success btn-sm" type="submit" style="float:right">Submit</button>
                        </div>
                    </form>
                </section>
                <section class="common-box">

                </section>
            </div>
        </aside>
        <input type="checkbox" id="toggle-report" style="display:none" />
        <aside class="send-report">
            <header class="common-header">
                <!-- <button class="common-button js-close-main-info"><span class="icon"><i
                            class="bi-x-lg"></i></span></button> -->
                <div class="common-header-content d-flex align-items-center">
                    <img src="{{ asset('img/icons/report.png') }}" width="16px" />
                    <h3 class="common-header-title">&nbsp;Report</h3>
                </div>
            </header>
            <div class="main-info-content">
                <section class="common-box">
                    <form method="post" action="">
                        @csrf
                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label text-start">Suspect User:</label>
                            <div class="col-sm-8 d-flex align-items-center justify-content-between">
                                <input type="text" class="form-control" id="suspect" name="suspect"
                                    value="{{ $selectedconv->otherUser()->username }}" placeholder="Suspect User"
                                    readonly>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label text-start">Report Content:</label>
                            <div class="col-sm-9 d-flex align-items-center justify-content-between">
                                <textarea class="form-control" id="message" name="message"
                                    placeholder="message..."></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <button class="btn btn-success btn-sm" type="submit" style="float:right">Submit</button>
                        </div>
                    </form>
                </section>
                <section class="common-box">

                </section>
            </div>
        </aside>
    </section>
</div>

@stop
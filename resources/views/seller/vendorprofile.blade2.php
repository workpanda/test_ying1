@extends('master.main')
@section('content')

<title>Profile - Squid Market</title>

<section class="section mt-3 mb-0">
    <div class="container">
        <div class="page-title justify-content-center">
            <h5 class="fw-bold"><i class="bi-person"></i> Vendor: {{ $seller->username }} </h5>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="account-card">
            <div class="row">
                <div class="col-sm-6 col-md-3 col-lg-3 mb-3">
                    <div class="h-100">
                        <h5 class="account-title">
                            {{ $seller->username }} | Last Active: {{ $seller->lastLogin() }}
                        </h5>
                        <div class="profile-image">
                            <img src="{{ asset('profilepic.jpeg') }}" alt="user">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3 col-lg-3 mb-3">
                    <div class="h-100">
                        <h5 class="account-title">Profile Description</h5>
                        <textarea class="form-control" readonly=""
                            style="height: 300px;">{!! Illuminate\Support\Str::markdown(strip_tags($seller->seller_description)) !!}</textarea>
                    </div>
                </div>

                <div class="col-sm-6 col-md-3 col-lg-3 mb-3">
                    <div class="h-100">
                        <h5 class="account-title">Vendor Public PGP:</h5>
                        <textarea class="form-control" readonly=""
                            style="height: 300px;">{{ $seller->pgp_key }}</textarea>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3 col-lg-3 mb-3">
                    <div class="h-100">
                        <h5 class="account-title">Past Markets</h5>
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <p>coming soon!</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row row-cols-1 row-cols-md-1 row-cols-lg-4 row-cols-xl-4">
                <div class="col mt-3">
                    <a href="{{ route('conversations', ['user' => $seller->username]) }}"
                        class="btn btn-sm btn-dark w-100 mb-2">
                        Message Vendor
                        <span class="badge bg-secondary"></span>
                    </a>
                    <button type="button" class="btn btn-sm btn-dark w-100">
                        FE Enabled: @if($seller->finalizeEarly()) Yes @else No @endif
                    </button>
                </div>
                <div class="col mt-3">
                    <form action="{{ route('post.fan', ['seller' => $seller->username]) }}" method="post"
                        class="inblock">
                        @csrf
                        <button class="btn btn-sm btn-dark w-100 mb-2">
                            {{ !auth()->user()->isFan($seller) ? 'Follow user' : 'Unfollow user' }}
                        </button>
                    </form>
                    <a href="" class="btn btn-sm btn-dark w-100 mb-2">
                        View All Products
                    </a>
                </div>
                <div class="col mt-3">
                    <button type="button" class="btn btn-sm btn-dark w-100 mb-2">
                        Total Followers: {{ $seller->totalFans() }}
                    </button>
                    <button type="button" class="btn btn-sm btn-dark w-100">
                        Total Feedback: {{ $seller->totalFeedbacks() }}
                    </button>
                </div>
                <div class="col mt-3">
                    <button type="button" class="btn btn-sm btn-dark w-100 mb-2">
                        Total Disputes: {{ $seller->totalDisputes() }}
                    </button>
                    <button type="button" class="btn btn-sm btn-dark w-100">
                        Registered as Vendor: {{ $seller->sellerSince() }}
                    </button>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-4 mb-2">
                    <a href="#" class="btn btn-xs btn-danger w-100 mb-0">
                        <i class="bi-x-circle"></i> Disputes Won/Lost:
                    </a>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-4 mb-2">
                    <a href="#" class="btn btn-xs btn-danger w-100 mb-0">
                        <i class="bi-x-circle"></i> Feedback Left:
                    </a>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-4 mb-2">
                    <a href="#" class="btn btn-xs btn-danger w-100 mb-0">
                        <i class="bi-x-circle"></i> Warning: 0/3
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="account-card">
            <h5 class="account-title"> Feedback </h5>
            <div class="col">
                <div class="table-responsive">
                    <table class="table table-bordered mt-3">
                        <thead>
                            <tr>
                                <th class="text-start">Recent Feedback Score:</th>
                                <th>All</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-start"><i class="bi-plus-circle-fill text-success"></i> Positive</td>
                                <td>{{ $seller->totalFeedbacks('positive') }}</td>
                            </tr>
                            <tr>
                                <td class="text-start"><i class="bi-stop-circle-fill text-secondary"></i> Neutral</td>
                                <td>{{ $seller->totalFeedbacks('neutral') }}</td>
                            </tr>
                            <tr>
                                <td class="text-start"><i class="bi-dash-circle-fill text-danger"></i> Negative</td>
                                <td>{{ $seller->totalFeedbacks('negative') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="section">
    <div class="container">
        <div class="account-card">
            <h5 class="account-title"> Recent Reviews </h5>
            <div class="col">
                <div class="table-responsive">
                    <table class="table table-bordered mt-1">
                        <thead>
                            <th>Rating</th>
                            <th>Username</th>
                            <th>Review</th>
                            <th>Timing</th>
                            <th>Product</th>
                        </thead>
                        <tbody>
                            @forelse($feedbacks as $feedback)
                            <tr>
                                <td>{{ number_format($feedback->rating, 2) }} of 5</td>
                                <td>{{ $feedback->hiddenUser() }}</td>
                                <td style="text-align: left">{{ $feedback->message }}</td>
                                <td>{{ $feedback->freshness() }}</td>
                                <td><a href="{{ route('product', ['product' => $feedback->product->id]) }}">view</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6">Looks empty :(</td>
                            </tr>
                            @endforelse
                            <tr>
                                <td colspan="6">{{ $feedbacks->links('includes.components.pagination') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

@stop
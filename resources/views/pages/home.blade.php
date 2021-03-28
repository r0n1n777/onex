@extends('layouts.dashboard')

@section('content')
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v9.0" nonce="ZauXBGlE"></script>

    <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
        <div class="container">
            <div class="page-header-content pt-4">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto mt-4">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="activity"></i></div>
                            Personal Dashboard
                        </h1>
                        <div class="page-header-subtitle">Brief overview of your information and see where you're at.</div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main page content-->
    <div class="container mt-n10">
        <div class="row">
            <div class="col-12 mb-4" data-aos="fade-up" data-aos-delay="100">
                <div class="card h-100">
                    <div class="card-body h-100 d-flex flex-column justify-content-center py-5 py-xl-4">
                        <div class="row align-items-center">
                            <div class="col-xl-8 col-xxl-8">
                                <div class="text-center text-xl-left text-xxl-center px-4 mb-4 mb-xl-0 mb-xxl-4">
                                    <h1 class="text-primary">Welcome to ONEX IT Solutions</h1>
                                    <p class="text-gray-700 mb-0">Browse your information, track your earnings and bonuses. Monitor your business with us with our fully-optimized dashboard.</p>
                                </div>
                            </div>
                            <div class="col-xl-4 col-xxl-4 text-center"><img class="img-fluid" src="assets/img/logo.png" style="max-width: 7rem" /></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xxl-6 col-xl-6 mb-4" data-aos="fade-up" data-aos-delay="100">
                <div class="card mb-4 h-100 shadow-sm">
                    <div class="card-header bg-gradient-primary-to-secondary text-white">
                        Account Information
                    </div>
                    <div class="card-body d-flex flex-column">
                        @if ($user->activated == true)
                        <div class="rounded bg-success text-white p-3 mb-3">
                            <i data-feather="check" class="mr-1 feather-lg"></i>
                            <b>Active - </b>
                            <span class="text-sm">Your account is activated.</span>
                        </div>
                        @elseif ($user->activated == false)
                        <div class="rounded bg-warning text-white p-3 mb-3">
                            <i data-feather="alert-circle" class="mr-1 feather-lg"></i>
                            <b>Pending - </b>
                            <span class="text-sm">Your account is still in pending status. In order to activate your account, kindly pay the activation fee and contact us for support.</span>
                        </div>
                        @endif
                        <div class="form-row align-items-center">
                            <div class="col-xl-4 col-xxl-4 my-2 text-center">
                                <img class="img-fluid rounded-circle mb-2" src="{{ $path }}" style="max-width: 7rem" />
                            </div>
                            <div class="col-xl-8 col-xxl-8 my-2">
                                <div class="form-row align-items-center">
                                    <div class="col-xl-6 col-xxl-6">
                                        <label class="text-sm">Full Name</label>
                                        <span class="form-control text-capitalize h-100 mb-1">{{ $user->fname.' '.$user->lname }}</span>
                                    </div>
                                    <div class="col-xl-6 col-xxl-6">
                                        <label class="text-sm">Username</label>
                                        <span class="form-control h-100 mb-1">{{ $user->uname }}</span>
                                    </div>
                                </div>
                                <div class="form-row align-items-center">
                                    <div class="col-xl-6 col-xxl-6">
                                        <label class="text-sm">Email Address</label>
                                        <span class="form-control h-100 mb-1">{{ $user->email }}</span>
                                    </div>
                                    <div class="col-xl-6 col-xxl-6">
                                        <label class="text-sm">Phone Number</label>
                                        <span class="form-control h-100 mb-1">{{ $user->phone }}</span>
                                    </div>
                                </div>
                                <div class="form-row align-items-center">
                                    <div class="col-xl-6 col-xxl-6">
                                        <label class="text-sm">Gender</label>
                                        <span class="form-control h-100">{{ $user->gender }}</span>
                                    </div>
                                    <div class="col-xl-6 col-xxl-6">
                                        <label class="text-sm">Date Joined</label>
                                        <span class="form-control h-100">{{ date( "F d, Y", strtotime($user->created_at)) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-light text-white">
                        <div class="d-flex align-items-center justify-content-between small text-body">
                            <a class="btn btn-primary btn-sm" href="{{ route('profile') }}">
                                <i data-feather="edit" class="mr-1"></i>
                                Update Profile Information
                            </a>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary btn-sm">
                                    <i data-feather="log-out" class="mr-1"></i>
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-6 col-xl-6 mb-4" data-aos="fade-up" data-aos-delay="100">
                <div class="card mb-4 h-100 shadow-sm">
                    <div class="card-header bg-gradient-primary-to-secondary text-white">
                        Affiliate Link
                    </div>
                    <div class="card-body h-100">
                        <span class="rounded border-primary text-primary m-3">
                            <b><u id="affiliate-link">http://www.onex.ph/register/{{ $user->uname }}</u></b>
                        </span>
                        <div class="m-3">
                            Share this link to anyone who wants to start their business with ONEX and
                            earn a reward when they register using your affiliate link.
                        </div>
                        <button id="copy-button" class="btn btn-primary font-weight-500 m-3">
                            <i data-feather="copy" class="mr-1"></i>
                            Copy Affiliate Link
                        </button>
                        <span id="copied" class="text-sm text-success d-none">
                            Copied to Clipboard
                        </span>
                        <div class="m-3">
                            You can also share this link in Facebook to reach more potential partners to success. This will directly be shared into your Facebook Profile Page.
                        </div>
                        <div class="fb-share-button m-3" data-href="http://onex.ph/register/{{ $user->uname }}" data-layout="button" data-size="large">
                            <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">
                                Share
                            </a>
                        </div>
                    </div>
                    <a class="card-footer bg-light text-white" href="{{ route('affiliates') }}">
                        <div class="d-flex align-items-center justify-content-between small text-body">
                            Open Affiliate Page
                            <i data-feather="arrow-right"></i>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="row"> 
            <div class="col-xxl-8 col-xl-8 mb-4" data-aos="fade-up" data-aos-delay="100">
                <div class="card card-header-actions mb-4 h-100 shadow-sm">
                    <div class="card-header bg-gradient-primary-to-secondary text-white">
                        Account Status
                    </div>
                    
                    <div class="card-body">
                        <h2 class="mt-3">
                            <h1>{{ $data->tierTitle }}</h1>
                        </h2>
                        <span class="text-sm">
                            @if ($data->numDirectInvites < 5)
                            <i class="feather-sm align-middle mr-1" data-feather="alert-circle" stroke="#e81500"></i>
                            You need 5 Direct Invites to reach <b>Regular</b> status.
                            @else
                            <i class="feather-sm align-middle mr-1" data-feather="check"></i>
                            Congratulations! Your account is now on <b>Regular</b> status.
                            @endif
                        </span>
                        <br />
                        <span class="text-sm">
                            @if ($data->numDirectInvites < 5)
                            <i>When you reached the <b>Regular</b> status for your account, you will be eligible to earn more with our <b>Binary System</b> bonuses.</i>
                            @else 
                            <i>You can now earn more with your account status. With our <b>Binary System</b>, earning incentives and bonuses are much more easier.</i>
                            @endif
                        </span>
                        <br /><br />
                        @if ($data->numDirectInvites == 0)
                        <span class="text-sm badge badge-success-soft">You don't have any <b>Activated Invites</b> yet.</span>
                        @else 
                        <span class="text-sm badge badge-success-soft mb-2">Showing all your <b>Activated Invites.</b></span><br />
                        @foreach ($data->directInvites as $invite)                        
                        <div class="d-inline badge badge-success-soft border border-success m-2">
                            <img width="30px" class="rounded-circle" src="{{ $invite->path }}" />
                            <span class="text-sm text-capitalize">{{ $invite->fname }}</span>
                            <span class="text-sm"><b>{{ $invite->tierTitle }}</b></span>
                        </div>
                        @endforeach
                        @endif
                        <br />
                        <br />
                        @if ($data->numDirectInvitesPending == 0)
                        <span class="text-sm badge badge-primary-soft">You don't have any <b>Pending Invites</b> yet.</span>
                        @else 
                        <span class="text-sm badge badge-primary-soft mb-2">Showing all your <b>Pending Invites.</b></span><br />
                        @foreach ($data->directInvitesPending as $invite)                        
                        <div class="d-inline badge badge-primary-soft border border-primary m-2">
                            <img width="30px" class="rounded-circle" src="{{ $invite->path }}" />
                            <span class="text-sm text-capitalize">{{ $invite->fname }}</span>
                            <span class="text-sm"><b>{{ $invite->tierTitle }}</b></span>
                        </div>
                        @endforeach
                        @endif
                    </div>
                    <a class="card-footer bg-light text-white" href="#!">
                        <div class="d-flex align-items-center justify-content-between small text-body">
                            View More Details
                            <i data-feather="arrow-right"></i>
                            <span class="badge badge-primary-soft text-primary ml-auto">Maintenance</span>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-xxl-4 col-xl-4 mb-4" data-aos="fade-up" data-aos-delay="100">
                <div class="card bg-gradient-primary-to-secondary text-white mb-4 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="mr-3">
                                <div class="text-white-75 small">Active Invites</div>
                                <div class="text-lg font-weight-bold">{{ $data->numDirectInvites }}</div>
                            </div>
                            <i class="feather-xl text-white-50" data-feather="user-check"></i>
                        </div>
                    </div>
                </div>
                <div class="card bg-gradient-primary-to-secondary text-white mb-4 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="mr-3">
                                <div class="text-white-75 small">Pending Invites</div>
                                <div class="text-lg font-weight-bold">{{ $data->numDirectInvitesPending }}</div>
                            </div>
                            <i class="feather-xl text-white-50" data-feather="user-check"></i>
                        </div>
                    </div>
                </div>
                <div class="card bg-gradient-primary-to-secondary text-white mb-4 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="mr-3">
                                <div class="text-white-75 small">Total Earnings</div>
                                <div class="text-lg font-weight-bold">&#8369;{{ $data->earnings }}</div>
                            </div>
                            <i class="feather-xl text-white-50" data-feather="dollar-sign"></i>
                        </div>
                    </div>
                </div>
                <div class="card bg-gradient-primary-to-secondary text-white mb-4 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="mr-3">
                                <div class="text-white-75 small">Total Balance</div>
                                <div class="text-lg font-weight-bold">&#8369;{{ $data->balance }}</div>
                            </div>
                            <i class="feather-xl text-white-50" data-feather="chevrons-up"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

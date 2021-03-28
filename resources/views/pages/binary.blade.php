@extends('layouts.dashboard')

@section('content')
<header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
    <div class="container">
        <div class="page-header-content pt-4">
            <div class="row align-items-center justify-content-between">
                <div class="col-auto mt-4">
                    <h1 class="page-header-title">
                        <div class="page-header-icon"><i data-feather="activity"></i></div>
                        Binary Tree
                    </h1>
                    <div class="page-header-subtitle">Earning incentives and bonuses are much easier with Binary!</div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- Main page content-->
<div class="container mt-n10">
    <div class="row text-align-center">
        <div class="col-xl-12 col-xxl-12 mb-4" data-aos="fade-up" data-aos-delay="100">
            <div class="card h-100 shadow-sm">
                <div class="card-body h-100 d-flex flex-column justify-content-center py-5">
                    <div class="row align-items-center">
                        <div class="col-xl-3 col-xxl-3 d-flex justify-content-center">
                            <img class="rounded-circle img-fluid mb-2" src="{{ $path }}" style="max-width: 10rem" />
                        </div>
                        <div class="col-xl-4 col-xxl-4">
                            <div class="text-center text-xl-left px-4 mb-4 mb-xl-0 mb-xxl-4">
                                <h1 class="text-capitalize text-primary">{{ $user->fname.' '.$user->lname }}</h1>
                                <p class="text-muted text-sm mb-0">
                                    <b><img class="rounded-circle align-middle mr-1" src="{{ asset('assets/img/dp/'.$user->gender.'.png') }}" width="15px" />{{ $user->gender }}</b><br />
                                    <b><i data-feather="at-sign" class="mr-1 align-middle"></i>{{ $user->uname }}</b><br />
                                    <b><i data-feather="phone" class="mr-1 align-middle"></i>{{ $user->phone }}</b><br />
                                    <b><i data-feather="mail" class="mr-1 align-middle"></i>{{ $user->email }}</b><br />
                                    <b><i data-feather="calendar" class="mr-1 align-middle"></i>Date Joined: {{ date('F d, Y', strtotime($user->created_at)) }}</b><br />
                                    <b>Account Status:&nbsp;{{ $tier->tierTitle }}</b>
                                </p>
                            </div>
                        </div>
                        <div class="col-xl-5 col-xxl-5">
                            @if ($tier->tierTitle == "Regular")
                            You are now eligible to earn more with our <b>Binary System</b>. You can now strategically position your direct invites in your binary tree.<br /><br />
                            <a class="btn btn-primary" href="{{ route('binary') }}">Go to Binary Tree<i data-feather="log-in" class="ml-1 align-middle"></i></a>
                            @else
                            Once you've reached the <b>Regular Status</b> for your account, you will be eligible in earning more incentives and bonuses. You have to invite 5 activated members under you to reach next level.<br /><br />
                            Current Account Status: <b>{{ $tier->tierTitle }}</b>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="container mt-n5">
        <div class="row text-align-center">
            @foreach ($affiliates as $affiliate)
                <div class="col mb-3" data-aos="fade-up" data-aos-delay="150">    
                    <div class="row h-100">
                        <div class="card h-100 w-100 text-center mt-n3 m-1 shadow-sm">
                            @if ($affiliate->activated == true)
                            <div class="card-header bg-success text-white">
                                <i data-feather="check" class="mr-1 align-middle"></i>Activated<br />
                            @else 
                            <div class="card-header bg-warning text-white">
                                <i data-feather="alert-circle" class="mr-1 align-middle"></i>Pending<br />
                            @endif
                                <img src="{{ $affiliate->path }}" class="img-fluid rounded-circle" style="max-width: 5em" />        
                            </div>
                            <div class="card-body p-1 pb-3">
                                <div class="col d-flex justify-content-center">
                                    <p class="text-muted text-sm mb-0">
                                        <b class="text-capitalize text-primary">{{ $affiliate->fname.' '.$affiliate->lname }}</b><br />
                                        <b><img class="rounded-circle align-middle mr-1" src="{{ asset('assets/img/dp/'.$affiliate->gender.'.png') }}" width="15px" />{{ $user->gender }}</b><br />
                                        <b><i data-feather="at-sign" class="mr-1 align-middle"></i>{{ $affiliate->uname }}</b><br />
                                        <b><i data-feather="phone" class="mr-1 align-middle"></i>{{ $affiliate->phone }}</b><br />
                                        <b><i data-feather="mail" class="mr-1 align-middle"></i>{{ $affiliate->email }}</b><br />
                                        <b><i data-feather="calendar" class="mr-1 align-middle"></i>Date Joined: {{ date('F d, Y', strtotime($affiliate->created_at)) }}</b><br />
                                        <b>Account Status:&nbsp;{{ $affiliate->tierTitle }}</b>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="container">
        <div class="row text-align-center">
            @foreach ($affiliatesPending as $affiliate)
                <div class="col mb-3" data-aos="fade-up" data-aos-delay="150">    
                    <div class="row h-100">
                        <div class="card h-100 w-100 text-center mt-n3 m-1 shadow-sm">
                            @if ($affiliate->activated == true)
                            <div class="card-header bg-success text-white">
                                <i data-feather="check" class="mr-1 align-middle"></i>Activated<br />
                            @else 
                            <div class="card-header bg-warning text-white">
                                <i data-feather="alert-circle" class="mr-1 align-middle"></i>Pending<br />
                            @endif
                                <img src="{{ $affiliate->path }}" class="img-fluid rounded-circle" style="max-width: 5em" />        
                            </div>
                            <div class="card-body p-1 pb-3">
                                <div class="col d-flex justify-content-center">
                                    <p class="text-muted text-sm mb-0">
                                        <b class="text-capitalize text-primary">{{ $affiliate->fname.' '.$affiliate->lname }}</b><br />
                                        <b><img class="rounded-circle align-middle mr-1" src="{{ asset('assets/img/dp/'.$affiliate->gender.'.png') }}" width="15px" />{{ $user->gender }}</b><br />
                                        <b><i data-feather="at-sign" class="mr-1 align-middle"></i>{{ $affiliate->uname }}</b><br />
                                        <b><i data-feather="phone" class="mr-1 align-middle"></i>{{ $affiliate->phone }}</b><br />
                                        <b><i data-feather="mail" class="mr-1 align-middle"></i>{{ $affiliate->email }}</b><br />
                                        <b><i data-feather="calendar" class="mr-1 align-middle"></i>Date Joined: {{ date('F d, Y', strtotime($affiliate->created_at)) }}</b><br />
                                        <b>Account Status:&nbsp;{{ $affiliate->tierTitle }}</b>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
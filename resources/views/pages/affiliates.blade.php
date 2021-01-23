@extends('layouts.dashboard')

@section('content')
<header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
    <div class="container">
        <div class="page-header-content pt-4">
            <div class="row align-items-center justify-content-between">
                <div class="col-auto mt-4">
                    <h1 class="page-header-title">
                        <div class="page-header-icon"><i data-feather="activity"></i></div>
                        Affiliates
                    </h1>
                    <div class="page-header-subtitle">Detailed information about your referrals and invites.</div>
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
                            <img class="img-fluid mb-2" src="{{ $path }}" style="max-width: 10rem" />
                        </div>
                        <div class="col-xl-8 col-xxl-8">
                            <div class="text-center text-xl-left px-4 mb-4 mb-xl-0 mb-xxl-4">
                                <h1 class="text-capitalize text-primary">{{ $user->fname.' '.$user->lname }}</h1>
                                <p class="text-muted text-sm mb-0">
                                    <b><img class="rounded-circle align-middle mr-1" src="{{ asset('assets/img/dp/'.$user->gender.'.png') }}" width="15px" />{{ $user->gender }}</b><br />
                                    <b><i data-feather="at-sign" class="mr-1 align-middle"></i>{{ $user->uname }}</b><br />
                                    <b><i data-feather="phone" class="mr-1 align-middle"></i>{{ $user->phone }}</b><br />
                                    <b><i data-feather="mail" class="mr-1 align-middle"></i>{{ $user->email }}</b><br />
                                    <b><i data-feather="calendar" class="mr-1 align-middle"></i>Date Joined: {{ date('F d, Y', strtotime($user->created_at)) }}</b>
                                </p>
                            </div>
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
                                        <b><i data-feather="calendar" class="mr-1 align-middle"></i>Date Joined: {{ date('F d, Y', strtotime($affiliate->created_at)) }}</b>
                                    </p>
                                </div>
                            </div>
                            <div class="card-footer p-1 pt-3">
                                <button type="button" class="btn btn-primary btn-sm m-1">
                                    <i data-feather="users" class="mr-1 align-middle"></i>
                                    View Invites
                                </button>
                                <button type="button" class="btn btn-primary btn-sm m-1">
                                    <i data-feather="user" class="mr-1 align-middle"></i>
                                    View Profile
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
@extends('layouts.dashboard')

@section('content')
<header class="page-header page-header-compact border-bottom bg-gradient-primary-to-secondary mb-4">
    <div class="container-fluid">
        <div class="page-header-content">
            <div class="row align-items-center justify-content-between pt-3">
                <div class="col-auto mb-3">
                    <h1 class="page-header-title text-white">
                        <div class="page-header-icon"><i data-feather="users"></i></div>
                        Affiliates
                    </h1>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- Main page content-->
<div class="container mt-4">
    <!-- Account page navigation-->
    <nav class="nav nav-borders">
        <a class="nav-link ml-0 active" href="{{ route('profile') }}">Profile</a>
        <a class="nav-link" href="{{ route('payout') }}">Payout</a>
        <a class="nav-link" href="{{ route('security') }}">Security</a>
    </nav>
    <hr class="mt-0 mb-4" />
    <div class="row">
        <div class="col-xl-4 col-xxl-4 mb-4" data-aos="fade-up" data-aos-delay="100">
            <!-- Profile picture card-->
            <div class="card shadow-sm">
                <div class="card-header bg-gradient-primary-to-secondary text-white">Profile Picture</div>
                <div class="card-body text-center">
                    
                </div>
            </div>
        </div>
        <div class="col-xl-8">
            <!-- Account details card-->
            <div class="card shadow-sm mb-4" data-aos="fade-up" data-aos-delay="200">
                <div class="card-header bg-gradient-primary-to-secondary text-white">Account Details</div>
                <div class="card-body">
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
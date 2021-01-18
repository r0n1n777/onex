@extends('layouts.dashboard')

@section('content')
<header class="page-header page-header-compact border-bottom bg-gradient-primary-to-secondary mb-4">
    <div class="container-fluid">
        <div class="page-header-content">
            <div class="row align-items-center justify-content-between pt-3">
                <div class="col-auto mb-3">
                    <h1 class="page-header-title text-white">
                        <div class="page-header-icon"><i data-feather="lock"></i></div>
                        Account Settings - Security
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
        <a class="nav-link ml-0" href="{{ route('profile') }}">Profile</a>
        <a class="nav-link" href="{{ route('payout') }}">Payout</a>
        <a class="nav-link active" href="{{ route('security') }}">Security</a>
    </nav>
    <hr class="mt-0 mb-4" />
    <div class="row">
        <div class="col-lg-8" data-aos="fade-up" data-aos-delay="100">
            <!-- Change password card-->
            <div class="card mb-4">
                <div class="card-header bg-gradient-primary-to-secondary text-white">Change Password</div>
                <div class="card-body">
                    <form action="{{ route('changePassword') }}" method="POST">
                        @csrf
                        <!-- Form Group (current password)-->
                        <div class="form-group">
                            <label class="small mb-1" for="currentpassword">Current Password</label>
                            <input class="form-control @error('currentpassword') is-invalid @enderror" id="currentpassword" name="currentpassword" type="password" placeholder="Enter current password" />
                            @error ('currentpassword')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <!-- Form Group (new password)-->
                        <div class="form-group">
                            <label class="small mb-1" for="password">New Password</label>
                            <input class="form-control @error('password') is-invalid @enderror" id="password" name="password" type="password" placeholder="Enter new password" />
                            @error ('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <!-- Form Group (confirm password)-->
                        <div class="form-group">
                            <label class="small mb-1" for="passwordconfirm">Confirm Password</label>
                            <input class="form-control @error('passwordconfirm') is-invalid @enderror" id="passwordconfirm" name="passwordconfirm" type="password" placeholder="Confirm new password" />
                            @error ('passwordconfirm')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <button class="btn btn-primary" type="submit">
                            <i data-feather="save" class="mr-1"></i>
                            Save Password
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('layouts.dashboard')

@section('content')
    <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
        <div class="container">
            <div class="page-header-content pt-4">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto mt-4">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="activity"></i></div>
                            Admin Dashboard
                        </h1>
                        <div class="page-header-subtitle">Welcome to the Admin Dashboard! Only Administrators of ONEX are the ones who can open and use this page.</div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main page content-->
    <div class="container mt-n10">
        <div class="row">
            <div class="col-xxl-6 col-xl-6 mb-4" data-aos="fade-up" data-aos-delay="100">
                <div class="card mb-4 h-100 shadow-sm">
                    <div class="card-header bg-gradient-primary-to-secondary text-white">
                        List of Pending Accounts ({{ count($pendingAccounts) }})
                    </div>
                    <div class="card-body d-flex flex-column">
                        @foreach ($pendingAccounts as $account)
                        <div class="p-1 mb-1">
                            <span><b class="text-capitalize">{{ $account->fname.' '.$account->lname }}</b>@ {{ $account->uname }}</span>
                            <span>{{ $account->phone }}</span><br />
                        </div>
                        @endforeach
                    </div>
                    <div class="card-footer bg-light text-white">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

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
            <div class="col-12 mb-4" data-aos="fade-up" data-aos-delay="100">
                <div class="card h-100">
                    <div class="card-header">Overview of Members Count</div>
                    <div class="card-body h-100 d-flex flex-column justify-content-center">
                        <div class="row align-items-center">
                            <div class="col-xl-4 col-xxl-4 text-center">
                                <div class="text-center text-xl-left text-xxl-center  p-4 mb-4 bg-gradient-primary-to-secondary rounded">
                                    <h3 class="text-white">Total Number of Members</h3>
                                    <h1 class="text-white">{{ count($accounts) }}</h1>
                                </div>
                            </div>
                            <div class="col-xl-4 col-xxl-4 text-center">
                                <div class="text-center text-xl-left text-xxl-center  p-4 mb-4 bg-warning rounded">
                                    <h3 class="text-white">Pending Accounts</h3>
                                    <h1 class="text-white">{{ $pendingCount }}</h1>
                                </div>
                            </div>
                            <div class="col-xl-4 col-xxl-4">
                                <div class="text-center text-xl-left text-xxl-center p-4 mb-4 bg-success rounded">
                                    <h3 class="text-white">Activated Accounts</h3>
                                    <h1 class="text-white">{{ $activeCount }}</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xxl-12 col-xl-12 mb-4" data-aos="fade-up" data-aos-delay="100">
                <div class="card mb-4">
                    <div class="card-header bg-gradient-primary-to-secondary text-white">List of Members/Accounts ({{ count($accounts) }})</div>
                    <div class="card-body">
                        <div class="datatable">
                            <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Status</th>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Email Address</th>
                                        <th>Date Joined</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($accounts as $account)
                                    <tr>
                                        <th class="text-center">
                                            @if ($account->activated == false)
                                                <button class="btn btn-success btn-sm">Activate</button>
                                            @else
                                                <button class="btn btn-primary btn-sm">Deactivate</button>
                                            @endif
                                        </th>
                                        <th>
                                            @if ($account->activated)
                                                <div class="badge badge-success badge-pill">Activated</div>
                                            @else
                                                <div class="badge badge-warning badge-pill">Pending</div>
                                            @endif
                                        </th>
                                        <td class="text-capitalize">{{ $account->fname.' '.$account->lname }}</td>
                                        <td>{{ $account->phone }}</td>
                                        <td>{{ $account->email }}</td>
                                        <td>{{ date("F d, Y", strtotime($account->created_at)) }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
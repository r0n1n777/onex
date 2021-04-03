@extends('layouts.dashboard')

@section('content')
    <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
        <div class="container">
            <div class="page-header-content pt-4">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto mt-4">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="server"></i></div>
                            Admin Dashboard
                        </h1>
                        <div class="page-header-subtitle">Welcome to the Admin Dashboard! Only Administrators of ONEX are the ones who can access and use this page.</div>
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
                                            <button class="btn btn-success btn-sm confirmation"
                                                id="{{ $account->id }}"
                                                name="{{ $account->fname.' '.$account->lname }}"
                                                phone="{{ $account->phone }}"
                                                email="{{ $account->email }}"
                                                date="{{ date("F d, Y", strtotime($account->created_at)) }}"
                                                data-toggle="modal" 
                                                data-target="#activate">
                                                <i data-feather="check" class="mr-1"></i>
                                                Activate
                                            </button>
                                            @else
                                            <button class="btn btn-primary btn-sm confirmation"
                                                id="{{ $account->id }}"
                                                name="{{ $account->fname.' '.$account->lname }}"
                                                phone="{{ $account->phone }}"
                                                email="{{ $account->email }}"
                                                date="{{ date("F d, Y", strtotime($account->created_at)) }}"
                                                data-toggle="modal"
                                                data-target="#deactivate">
                                                <i data-feather="x" class="mr-1"></i>
                                                Deactivate
                                            </button>
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

    <div id="activate" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="activate" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-gradient-primary-to-secondary">
                    <h5 id="title" class="modal-title text-white">Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="text-white" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure to Activate this Account?</p>
                    <span class="name text-capitalize font-weight-bold"></span><br />
                    <span class="phone"></span><br />
                    <span class="email"></span><br />
                    Date Joined: <span class="date"></span>
                </div>
                <div class="modal-footer">
                    <form action="{{ route('activate') }}" method="POST">
                        @csrf
                        <input type="hidden" class="id" name="id" value="" />
                        <button type="submit" class="btn btn-success">
                            <i data-feather="check" class="mr-1"></i>Activate
                        </button>
                    </form>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">
                        <i data-feather="chevron-left" class="mr-1"></i>Close
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div id="deactivate" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="deactivate" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-gradient-primary-to-secondary">
                    <h5 id="title" class="modal-title text-white">Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="text-white" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p id="question">Are you sure to Deactivate this Account?</p>
                    <span class="name text-capitalize font-weight-bold"></span><br />
                    <span class="phone"></span><br />
                    <span class="email"></span><br />
                    Date Joined: <span class="date"></span>
                </div>
                <div class="modal-footer">
                    <form action="{{ route('activate') }}" method="POST">
                        @csrf
                        <input type="hidden" class="id" name="id" value="" />
                        <button type="submit" class="btn btn-primary">
                            <i data-feather="x" class="mr-1"></i>Deactivate
                        </button>
                    </form>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">
                        <i data-feather="chevron-left" class="mr-1"></i>Close
                    </button>
                </div>
            </div>
        </div>
    </div>

    @if (session('result'))
    <script>
        $(document).ready(function(){
            $('#result').modal('show');
        });
    </script>

    <div id="result" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="confirmation" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-gradient-primary-to-secondary">
                    <h5 id="title" class="modal-title text-white">Success Operation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="text-white" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p id="question">Success! The Account is now 
                        <b class="text-capitalize">
                        @if (Session::get('result')->activated == true)    
                        <span class="text-success">
                            <i data-feather="check" class="feather-lg"></i>
                            Active.
                        </span>
                        @else
                        <span class="text-warning">
                            <i data-feather="alert-triangle" class="feather-lg"></i>
                            Pending.
                        </span>
                        @endif
                        </b>
                    </p> 
                    <span class="name text-capitalize font-weight-bold">{{ Session::get('result')->fname.' '.Session::get('result')->lname }}</span><br />
                    <span class="phone">{{ Session::get('result')->phone }}</span><br />
                    <span class="email">{{ Session::get('result')->email }}</span><br />
                    Date Joined: <span class="date">{{ date("F d, Y", strtotime(Session::get('result')->date)) }}</span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">
                        <i data-feather="chevron-left" class="mr-1"></i>Close
                    </button>
                </div>
            </div>
        </div>
    </div>

    @endif
@endsection

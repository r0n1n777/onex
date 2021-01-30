@extends('layouts.dashboard')

@section('content')
<header class="page-header page-header-compact border-bottom bg-gradient-primary-to-secondary mb-4">
    <div class="container-fluid">
        <div class="page-header-content">
            <div class="row align-items-center justify-content-between pt-3">
                <div class="col-auto mb-3">
                    <h1 class="page-header-title text-white">
                        <div class="page-header-icon"><i data-feather="dollar-sign"></i></div>
                        Account Settings - Payout
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
        <a class="nav-link active" href="{{ route('payout') }}">Payout</a>
        <a class="nav-link" href="{{ route('security') }}">Security</a>
    </nav>
    <hr class="mt-0 mb-4" />
    <div class="row">
        <div class="col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="100">
            <div class="card h-100 border-left-lg border-left-primary">
                <div class="card-body">
                    <div class="small text-muted">Total Balance</div>
                    <div class="h3">&#8369;{{ $balance }}</div>
                    <a class="text-arrow-icon small" href="#!" data-toggle="modal" data-target="#request-payout">
                        Request for Payout
                        <i data-feather="arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="100">
            <div class="card h-100 border-left-lg border-left-primary">
                <div class="card-body">
                    <div class="small text-muted">Total Earnings</div>
                    <div class="h3">&#8369;{{ $earnings }}</div>
                    <a class="text-arrow-icon small" href="#!">
                        View More Details
                        <i data-feather="arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="200">
            @if ($user->activated == true)
            <div class="card h-100 border-left-lg border-left-success">
            @elseif ($user->activated == false)
            <div class="card h-100 border-left-lg border-left-warning">
            @endif
                <div class="card-body">
                    <div class="small text-muted">Account Status</div>
                    <div class="h3 align-items-center">
                        @if ($user->activated == true)
                        <i data-feather="check" class="mr-1"></i>
                        Active
                        @elseif ($user->activated == false)
                        <div class="row">
                            <div class="col">
                                <i data-feather="alert-triangle" class="mr-1"></i>
                                Pending
                            </div>
                        </div>
                        <div class="row">
                            <div class="col text-sm text-muted">
                                It looks like you haven't paid the activation fee for your account yet.
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if ($errors->has('add-payout'))
    <script>
    $(document).ready(function(){
        $('#add-payout').modal('show');
    });
    </script>
    @endif

    @if ($errors->has('request-payout'))
    <script>
    $(document).ready(function(){
        $('#request-payout').modal('show');
    });
    </script>
    @endif

    <!-- Add Payment Option Modal-->
    <div id="add-payout" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="add-payout" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-gradient-primary-to-secondary text-white">
                    <b>Add Payout Option</b>
                    <button class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('addPayout') }}">
                        @csrf
                        <div class="row p-2">
                            <div class="col">
                                <div class="form-group">
                                    <label class="text-sm" for="payout">Select Outlet</label>
                                    <select id="payout" class="custom-select" name="payout">
                                        <option>Gcash</option>
                                        <option>Paymaya</option>
                                        <option>Coins.ph</option>
                                        <option>BDO</option>
                                        <option>BPI</option>
                                        <option>PNB</option>
                                        <option>LBC</option>
                                        <option>Palawan Express</option>
                                        <option>cebuana Lhuillier</option>
                                        <option>M-Lhuillier</option>
                                        <option>Western Union</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row p-2">
                            <div class="col">
                                <div class="form-group">
                                    <label class="text-sm" for="number">Account Number/Code</label>
                                    <input id="number" class="form-control @error('number') is-invalid @enderror" type="text" name="number" />
                                    @error ('number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row p-2">
                            <div class="col">
                                <div class="form-group">
                                    <label class="text-sm" for="name">Account Name</label>
                                    <input id="name" class="form-control text-capitalize @error('name') is-invalid @enderror" type="text" name="name" />
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <button class="btn btn-primary" type="submit">Add Payout Option</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Request Payout Modal-->
    <form method="POST" action="{{ route('requestPayout') }}">
        @csrf
        <div id="request-payout" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="add-payout" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-gradient-primary-to-secondary text-white">
                        <b>Request for Payout</b>
                        <button class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                            <div class="row p-2">
                                <div class="col">
                                    @if ($user->activated == true)
                                    <div class="rounded bg-success text-white p-3 mb-3">
                                        <i data-feather="check" class="mr-1 feather-lg"></i>
                                        <b>Account Active - </b>
                                        <span class="text-sm">You are eligible for a payout.</span>
                                    </div>
                                    @elseif ($user->activated == false)
                                    <div class="rounded bg-warning text-white p-3 mb-3">
                                        <i data-feather="alert-circle" class="mr-1 feather-lg"></i>
                                        <b>Account Pending - </b>
                                        <span class="text-sm">Your account is still in pending status. You are not eligible for a payout yet. Please activate your account first, pay the activation fee and contact us for support.</span>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        @if ($user->activated == true)
                            <div class="row p-2">
                                <div class="col">
                                    <div class="form-group">
                                        <label class="text-sm" for="payout">Total Balance</label>
                                        <div class="form-control" name="balance">&#8369;{{ $balance }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row p-2">
                                <div class="col">
                                    <div class="form-group">
                                        <label class="text-sm" for="number">Choose Payout Method</label>
                                        @if ($payoutOptions->isEmpty())
                                            <br />
                                            <span class="text-primary text-sm">You don't have any payout method yet, please add one first before continuing.</span><br /><br />
                                            <button id="add-payout-button" class="btn btn-sm btn-primary" type="button" data-toggle="modal" data-target="#add-payout" data-dismiss="modal">
                                                <i data-feather="plus" class="mr-1"></i>
                                                Add Payout Method
                                            </button>
                                        @else
                                        <select id="payout" class="custom-select text-capitalize" name="pid">
                                            @foreach ($payoutOptions as $payoutOption)
                                                <option value="{{ $payoutOption->id }}">{{ $payoutOption->payout }}&nbsp;/&nbsp;<span class="text-capitalize">{{ $payoutOption->name }}&nbsp;/&nbsp;{{ $payoutOption->number }}</option>
                                            @endforeach
                                        </select>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @if (!$payoutOptions->isEmpty())
                            
                            <div class="row p-2">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="text-sm" for="name">Amount</label>
                                        <input id="amount" class="form-control text-capitalize @error('amount') is-invalid @enderror" type="text" name="amount" />
                                        @error('amount')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <i class="text-muted text-sm">Disclaimer: 10% tax will be deducted from your payout to be sent to your chosen account.</i>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <button class="btn btn-primary" type="submit">
                                        <i data-feather="plus" class="mr-1"></i>
                                        Request Payout
                                    </button>
                                </div>
                            </div>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </form>
    
    <div class="card card-header-actions mb-4" data-aos="fade-up" data-aos-delay="100">
        <div class="card-header bg-gradient-primary-to-secondary text-white">
            Payout Options
            <button id="add-payout-button" class="btn btn-sm btn-primary" type="button" data-toggle="modal" data-target="#add-payout">
                <i data-feather="plus" class="mr-1"></i>
                Add Payout Method
            </button>
        </div>
        <div class="card-body">
            @if ($payoutOptions->isEmpty())
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <i data-feather="alert-circle" class="feather-xl mr-2"></i>
                    You haven't added any payout options into your account.
                </div>
            </div>
            @endif
            @foreach($payoutOptions as $payout)
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <i data-feather="credit-card" class="feather-xl"></i>
                    <div class="ml-4">
                        <div class="small"><b>{{ $payout->payout }}</b></div>
                        <div class="text-xs text-muted text-capitalize">Account Name: {{ $payout->name }}</div>
                        <div class="text-xs text-muted">Account Number: {{ $payout->number }}</div>
                    </div>
                </div>
                <div class="ml-4 small">
                    <form action="{{ route('deletePayout') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{ $payout->id }}" />
                        <button type="submit" class="btn btn-link">
                            <i data-feather="delete" class="mr-1"></i>
                            Delete
                        </button>
                    </form>
                </div>
            </div>
            <hr />
            @endforeach
        </div>
    </div>
    <!-- Billing history card-->
    <div class="card mb-4" data-aos="fade-up" data-aos-delay="100">
        <div class="card-header bg-gradient-primary-to-secondary text-white">Payout History</div>
        <div class="card-body p-0">
            <!-- Billing history table-->
            <div class="table-responsive table-billing-history">
                <table class="table mb-0">
                    <thead>
                        <tr>
                            <th scope="col">Transaction ID</th>
                            <th scope="col">Date</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Payout Method/Account Name/Number</th>                        
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!count($payouts))
                        <tr>
                            <td><span class="text-muted">You haven't requested a payout yet.</td>
                        </tr>
                        @else
                            @foreach ($payouts as $payout)
                            <tr>
                                <td>#&nbsp;{{ $payout->id }}</td>
                                <td>{{ date('F d, Y', strtotime($payout->created_at)) }}</td>
                                <td>&#8369;{{ $payout->amount }}</td>
                                <td>{{ $payout->payoutOption->payout }}&nbsp;/&nbsp;<span class="text-capitalize">{{ $payout->payoutOption->name }}</span>&nbsp;/&nbsp;{{ $payout->payoutOption->number }}</td>
                                <td>
                                    @if ($payout->status == true)
                                    <span class="rounded p-1 text-white bg-success">
                                        <i data-feather="check" class="mr-1"></i>
                                        Paid
                                    </span>
                                    @elseif ($payout->status == false)
                                    <span class="rounded p-1 text-white bg-warning">
                                        <i data-feather="alert-circle" class="mr-1"></i>
                                        Pending
                                    </span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
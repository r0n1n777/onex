@extends('layouts.dashboard')

@section('content')
<div class="modal fade" tabindex="-1" role="dialog" id="add-binary">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" action="{{ route('binary-add') }}">
                @csrf
                <div class="modal-header bg-gradient-primary-to-secondary">
                    <h5 class="modal-title text-white">Add Member to Binary Tree</h5>
                </div>
                <div class="modal-body">
                    <h4>You can only add "Regular" Members to the Binary Tree. Help others to reach Regular Status in order for them to be added into your Binary Tree.</h4>
                    <div class="form-group">
                        <label class="small mb-1" for="gender">Select Regular Member</label>
                        <select class="custom-select">
                            @foreach ($regularDirectInvites as $invite)
                            <option class="text-capitalize" value="{{ $invite->id }}">{{ $invite->fname.' '.$invite->lname }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success"><i data-feather="plus" class="mr-1"></i>Add to Binary</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal"><i data-feather="x" class="mr-1"></i>Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
<header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
    <div class="container">
        <div class="page-header-content pt-4">
            <div class="row align-items-center justify-content-between">
                <div class="col-auto mt-4">
                    <h1 class="page-header-title">
                        <div class="page-header-icon"><i data-feather="share-2"></i></div>
                        Binary Tree
                    </h1>
                    <div class="page-header-subtitle">Earning incentives and bonuses are much easier with Binary!</div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- Main page content-->
<div class="container mt-n10 binary-container">
    <div class="row text-align-center">
        <div class="col mb-3" data-aos="fade-up" data-aos-delay="150">    
            <div class="row no-gutters"> <!-- Stage 1 -->
                <div class="col-12"> 
                    <div class="card shadow-sm text-center border-0 w-100 align-items-center">
                        <div class="card-header bg-success text-white rounded-0 w-100">
                            {{ $user->fname.' '.$user->lname }}
                        </div>
                        <div class="card-body p-0">
                            <img class="rounded-circle img-fluid mb-2 binary-img border border-primary mt-2" src="{{ $path }}" />
                        </div>
                        <div class="bg-primary" style="width:10px !important; height:30px !important;">&nbsp;</div>
                    </div>
                </div>
            </div>
            <div class="row no-gutters">
                <div class="col"></div>
                <div class="col bg-primary" style="height:10px;"></div>
                <div class="col bg-primary" style="height:10px;"></div>
                <div class="col"></div>
            </div>
            <div class="row"> <!-- Stage 2 -->
                <div class="col-6">
                    <div class="card shadow-sm text-center border-0 w-100 align-items-center">
                        <div class="card-body p-0 text-center">
                            <img class="rounded-circle img-fluid mb-2 binary-img border border-primary mt-2" src="{{ asset('assets/img/logo.png') }}" />
                        </div>
                        <button class="btn btn-success mb-1" data-toggle="modal" data-target="#add-binary">
                            <i data-feather="plus"></i>
                        </button>
                        <div class="bg-primary" style="width:10px !important; height:30px !important;">&nbsp;</div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card shadow-sm text-center border-0 w-100 align-items-center">
                        <div class="card-body p-0 text-center">
                            <img class="rounded-circle img-fluid mb-2 binary-img border border-primary mt-2" src="{{ asset('assets/img/logo.png') }}" />
                        </div>
                        <button class="btn btn-success mb-1" data-toggle="modal" data-target="#add-binary">
                            <i data-feather="plus"></i>
                        </button>
                        <div class="bg-primary" style="width:10px !important; height:30px !important;">&nbsp;</div>
                    </div>
                </div>
            </div>
            <div class="row no-gutters">
                <div class="col"></div>
                <div class="col bg-primary" style="height:10px;"></div>
                <div class="col bg-primary" style="height:10px;"></div>
                <div class="col"></div>
                <div class="col"></div>
                <div class="col bg-primary" style="height:10px;"></div>
                <div class="col bg-primary" style="height:10px;"></div>
                <div class="col"></div>
            </div>
            <div class="row"> <!-- Stage 3 -->
                <div class="col-3">
                    <div class="card shadow-sm text-center border-0 w-100 align-items-center">
                        <div class="card-body p-0">
                            <img class="rounded-circle img-fluid mb-2 binary-img border border-primary mt-2" src="{{ asset('assets/img/logo.png') }}" />
                        </div>
                        <button class="btn btn-success mb-1" data-toggle="modal" data-target="#add-binary">
                            <i data-feather="plus"></i>
                        </button>
                        <div class="bg-primary" style="width:10px !important; height:30px !important;">&nbsp;</div>
                    </div>
                    <div class="row no-gutters">
                        <div class="col"></div>
                        <div class="col bg-primary" style="height:10px;"></div>
                        <div class="col bg-primary" style="height:10px;"></div>
                        <div class="col"></div>
                    </div>
                    <div class="row no-gutters">
                        <div class="col-6">
                            <div class="card shadow-sm text-center border-0 w-100 align-items-center">
                                <div class="card-body p-0 text-center">
                                    <img class="rounded-circle img-fluid mb-2 binary-img border border-primary mt-2" src="{{ asset('assets/img/logo.png') }}" />
                                </div>
                                <button class="btn btn-success mb-1" data-toggle="modal" data-target="#add-binary">
                                    <i data-feather="plus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card shadow-sm text-center border-0 w-100 align-items-center">
                                <div class="card-body p-0 text-center">
                                    <img class="rounded-circle img-fluid mb-2 binary-img border border-primary mt-2" src="{{ asset('assets/img/logo.png') }}" />
                                </div>
                                <button class="btn btn-success mb-1" data-toggle="modal" data-target="#add-binary">
                                    <i data-feather="plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card shadow-sm text-center border-0 w-100 align-items-center">
                        <div class="card-body p-0">
                            <img class="rounded-circle img-fluid mb-2 binary-img border border-primary mt-2" src="{{ asset('assets/img/logo.png') }}" />
                        </div>
                        <button class="btn btn-success mb-1" data-toggle="modal" data-target="#add-binary">
                            <i data-feather="plus"></i>
                        </button>
                        <div class="bg-primary" style="width:10px !important; height:30px !important;">&nbsp;</div>
                    </div>
                    <div class="row no-gutters">
                        <div class="col"></div>
                        <div class="col bg-primary" style="height:10px;"></div>
                        <div class="col bg-primary" style="height:10px;"></div>
                        <div class="col"></div>
                    </div>
                    <div class="row no-gutters">
                        <div class="col-6">
                            <div class="card shadow-sm text-center border-0 w-100 align-items-center">
                                <div class="card-body p-0 text-center">
                                    <img class="rounded-circle img-fluid mb-2 binary-img border border-primary mt-2" src="{{ asset('assets/img/logo.png') }}" />
                                </div>
                                <button class="btn btn-success mb-1" data-toggle="modal" data-target="#add-binary">
                                    <i data-feather="plus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card shadow-sm text-center border-0 w-100 align-items-center">
                                <div class="card-body p-0 text-center">
                                    <img class="rounded-circle img-fluid mb-2 binary-img border border-primary mt-2" src="{{ asset('assets/img/logo.png') }}" />
                                </div>
                                <button class="btn btn-success mb-1" data-toggle="modal" data-target="#add-binary">
                                    <i data-feather="plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card shadow-sm text-center border-0 w-100 align-items-center">
                        <div class="card-body p-0">
                            <img class="rounded-circle img-fluid mb-2 binary-img border border-primary mt-2" src="{{ asset('assets/img/logo.png') }}" />
                        </div>
                        <button class="btn btn-success mb-1" data-toggle="modal" data-target="#add-binary">
                            <i data-feather="plus"></i>
                        </button>
                        <div class="bg-primary" style="width:10px !important; height:30px !important;">&nbsp;</div>
                    </div>
                    <div class="row no-gutters">
                        <div class="col"></div>
                        <div class="col bg-primary" style="height:10px;"></div>
                        <div class="col bg-primary" style="height:10px;"></div>
                        <div class="col"></div>
                    </div>
                    <div class="row no-gutters">
                        <div class="col-6">
                            <div class="card shadow-sm shadow-smtext-center border-0 w-100 align-items-center">
                                <div class="card-body p-0 text-center">
                                    <img class="rounded-circle img-fluid mb-2 binary-img border border-primary mt-2" src="{{ asset('assets/img/logo.png') }}" />
                                </div>
                                <button class="btn btn-success mb-1" data-toggle="modal" data-target="#add-binary">
                                    <i data-feather="plus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card shadow-sm text-center border-0 w-100 align-items-center">
                                <div class="card-body p-0 text-center">
                                    <img class="rounded-circle img-fluid mb-2 binary-img border border-primary mt-2" src="{{ asset('assets/img/logo.png') }}" />
                                </div>
                                <button class="btn btn-success mb-1" data-toggle="modal" data-target="#add-binary">
                                    <i data-feather="plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card shadow-sm text-center border-0 w-100 align-items-center">
                        <div class="card-body p-0">
                            <img class="rounded-circle img-fluid mb-2 binary-img border border-primary mt-2" src="{{ asset('assets/img/logo.png') }}" />
                        </div>
                        <button class="btn btn-success mb-1" data-toggle="modal" data-target="#add-binary">
                            <i data-feather="plus"></i>
                        </button>
                        <div class="bg-primary" style="width:10px !important; height:30px !important;">&nbsp;</div>
                    </div>
                    <div class="row no-gutters">
                        <div class="col"></div>
                        <div class="col bg-primary" style="height:10px;"></div>
                        <div class="col bg-primary" style="height:10px;"></div>
                        <div class="col"></div>
                    </div>
                    <div class="row no-gutters">
                        <div class="col-6">
                            <div class="card shadow-sm text-center border-0 w-100 align-items-center">
                                <div class="card-body p-0 text-center">
                                    <img class="rounded-circle img-fluid mb-2 binary-img border border-primary mt-2" src="{{ asset('assets/img/logo.png') }}" />
                                </div>
                                <button class="btn btn-success mb-1" data-toggle="modal" data-target="#add-binary">
                                    <i data-feather="plus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card shadow-sm text-center border-0 w-100 align-items-center">
                                <div class="card-body p-0 text-center">
                                    <img class="rounded-circle img-fluid mb-2 binary-img border border-primary mt-2" src="{{ asset('assets/img/logo.png') }}" />
                                </div>
                                <button class="btn btn-success mb-1" data-toggle="modal" data-target="#add-binary">
                                    <i data-feather="plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
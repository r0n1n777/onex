@extends('layouts.dashboard')

@section('content')

@if($errors->any())
    <script>
    $(document).ready(function(){
        $('#error-binary').modal('show');
    });
    </script>
@endif

<div class="modal fade" tabindex="-1" role="dialog" id="view-user">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-gradient-primary-to-secondary">
                <h5 class="modal-title text-white">Member Information</h5>
            </div>
            <div class="modal-body text-center">
                <span class="imgpath"></span>
                <h3 class="name text-capitalize mt-4"></h3>
                <i data-feather="mail" class="mr-1 align-middle"></i><span class="email"></span><br />
                <i data-feather="phone" class="mr-1 align-middle"></i><span class="phone"></span><br />
                <i data-feather="at-sign" class="mr-1 align-middle"></i><span class="uname"></span><br />
                <span class="gender text-capitalize"></span><br />
                <span class="datejoined"></span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal"><i data-feather="x" class="mr-1"></i>Close</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="error-binary">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-gradient-primary-to-secondary">
                <h5 class="modal-title text-white">Error in Adding the User to the Binary</h5>
            </div>
            <div class="modal-body">
                <h4>@if($errors->any()){{ $errors->first() }}@endif</h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal"><i data-feather="x" class="mr-1"></i>Close</button>
            </div>
        </div>
    </div>
</div>
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
                        @if (count($regularDirectInvites))
                        <label class="small mb-1" for="gender">Select Regular Member</label>
                        <select class="custom-select" name="user_id">    
                            @foreach ($regularDirectInvites as $invite)
                            <option class="text-capitalize" value="{{ $invite['id'] }}">{{ $invite['fname'].' '.$invite['lname'] }}</option>
                            @endforeach
                        </select>
                        @else
                        <h4 class="text-primary">You don't have any Regular Members to add.</h4>
                        @endif
                        <input class="binary-referrer-id" type="hidden" value="" name="referrer_id" />
                        <input class="binary-position" type="hidden" value="" name="position" />
                    </div>
                </div>
                <div class="modal-footer">
                    @if (count($regularDirectInvites))
                    <span class="text-danger"><i>This action is irreversible, continue with caution.</i></span>
                    <button type="submit" class="btn btn-success"><i data-feather="plus" class="mr-1"></i>Add to Binary</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal"><i data-feather="x" class="mr-1"></i>Cancel</button>
                    @endif
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
<div class="container mt-n10">
    <div class="row">
        <div class="col-12 mb-4" data-aos="fade-up" data-aos-delay="100">
            <div class="card h-100">
                <div class="card-header">Binary Tree Summary</div>
                <div class="card-body h-100 d-flex flex-column justify-content-center">
                    <div class="row align-items-center">
                        <div class="col-xl-3 col-xxl-3">
                            <div class="card bg-gradient-primary-to-secondary text-white mb-4 shadow-sm h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="mr-3">
                                            <div class="text-white-75 text-lg">Binary Tree Earnings</div>
                                            <div class="text-lg font-weight-bold">&#8369;{{ $binaryEarnings }}</div>
                                        </div>
                                        <i class="feather-xl text-white-50" data-feather="chevrons-up"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-xxl-3">
                            <div class="card bg-gradient-primary-to-secondary text-white mb-4 shadow-sm h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="mr-3">
                                            <div class="text-white-75 text-lg">Left Members</div>
                                            <div class="text-lg font-weight-bold">{{ $binaryLeft }}</div>
                                        </div>
                                        <i class="feather-xl text-white-50" data-feather="corner-down-left"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-xxl-3">
                            <div class="card bg-gradient-primary-to-secondary text-white mb-4 shadow-sm h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="mr-3">
                                            <div class="text-white-75 text-lg">Right Members</div>
                                            <div class="text-lg font-weight-bold">{{ $binaryRight }}</div>
                                        </div>
                                        <i class="feather-xl text-white-50" data-feather="corner-down-right"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-xxl-3">
                            <div class="card bg-gradient-primary-to-secondary text-white mb-4 shadow-sm h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="mr-3">
                                            <div class="text-white-75 text-lg">Paired Members</div>
                                            <div class="text-lg font-weight-bold">{{ $binaryPairings }}</div>
                                        </div>
                                        <i class="feather-xl text-white-50" data-feather="users"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container mt-2 binary-container">
    <div class="row text-align-center">
        <div class="col mb-3" data-aos="fade-up" data-aos-delay="150">    
            <div class="row no-gutters"> <!-- Stage 1 -->
                <div class="col-12"> 
                    <div class="card shadow-sm text-center rounded-0 border-0 w-100 align-items-center">
                        <div class="card-header bg-success text-white rounded-0 w-100">
                            {{ $binary['user'][0]['fname'].' '.$binary['user'][0]['lname'] }}
                        </div>
                        <div class="card-body pb-4">
                            <img class="rounded-circle img-fluid mb-2 binary-img border border-success mt-2" src="{{ asset($binary['user'][0]['path']) }}" /><br />
                            <b><i data-feather="user" class="mr-1 align-middle"></i>{{ $binary['user'][0]['gender'] }}</b><br />
                            <b><i data-feather="at-sign" class="mr-1 align-middle"></i>{{ $binary['user'][0]['uname'] }}</b><br />
                            <b><i data-feather="phone" class="mr-1 align-middle"></i>{{ $binary['user'][0]['phone'] }}</b><br />
                            <b><i data-feather="mail" class="mr-1 align-middle"></i>{{ $binary['user'][0]['email'] }}</b><br />
                            <b><i data-feather="calendar" class="mr-1 align-middle"></i>Date Joined: {{ date( "F d, Y", strtotime($binary['user'][0]['created_at'])) }}</b><br />
                        </div>
                    </div>

                    <div class="row no-gutters bg-light"> <!-- Stage 2 -->
                        @php $title = 'left' @endphp
                        @foreach($binary[$binaryId] as $b)
                        <div class="col-6 px-1 border border-white">
                            @if ($title == 'left')
                                <div class="w-100 text-center bg-gradient-primary-to-secondary text-white-75 font-weight-bold text-lg p-2 rounded-top">Left</div>
                            @else
                                <div class="w-100 text-center bg-gradient-primary-to-secondary text-white-75 font-weight-bold text-lg p-2 rounded-top">Right</div>
                            @endif
                            @php $title = 'right' @endphp
                            <div class="card shadow-sm text-center rounded-0 border-0 w-100 align-items-center">
                                @if(!empty($b) && !array_key_exists('position', $b))
                                <div class="card-header bg-success text-white w-100 rounded-0">
                                    <button class="btn btn-sm btn-light view-user-button" data-toggle="modal" data-target="#view-user" 
                                        fname="{{$b['fname']}}"
                                        lname="{{$b['lname']}}"
                                        uname="{{$b['uname']}}"
                                        gender="{{$b['gender']}}"
                                        email="{{$b['email']}}"
                                        phone="{{$b['phone']}}"
                                        datejoined="{{date( "F d, Y", strtotime($b['created_at']))}}"
                                        imgpath={{ asset($b['path'])}}>
                                    <i data-feather="user" class="align-middle"></i></button>
                                    <a class="btn btn-sm btn-light" href="{{ route('binary-user', ['id' => $b['id']]) }}"><i data-feather="share-2" class="align-middle"></i></a>
                                </div>
                                <div class="card-body p-0 text-center">
                                    <a tabindex="0"
                                    data-toggle="popover" title="{{ucwords($b['fname'].' '.$b['lname'])}}" data-placement="bottom" 
                                    data-trigger="focus"
                                    data-content='
                                    <span>{{$b['gender']}}</span><br />
                                    <span>{{$b['email']}}</span><br />
                                    <span>{{$b['phone']}}</span><br />
                                    <span>{{date( "F d, Y", strtotime($b['created_at']))}}</span><br /><br />
                                    <a class="btn btn-sm btn-primary text-white" href="{{ route('binary-user', ['id' => $b['id']]) }}">Show Binary Tree</a>'
                                    data-html="true">
                                    <img class="rounded-circle img-fluid mb-2 binary-img border border-success mt-2" src="{{ asset($b['path']) }}" />
                                    </a>
                                </div>
                                @else 
                                <div class="card-header rounded-0 bg-warning text-white w-100">
                                    <button class="btn btn-light btn-sm binary-button" data-toggle="modal" data-target="#add-binary" position="{{ $b['position'] }}" referrer="{{ $user->id }}">
                                        <i data-feather="plus"></i>
                                    </button>
                                </div>
                                <div class="card-body p-0 text-center">
                                    <img class="rounded-circle img-fluid mb-2 binary-img binary-button border border-warning mt-2" src="{{ asset('assets/img/logo.png') }}" data-toggle="modal" data-target="#add-binary" position="{{ $b['position'] }}" referrer="{{ $user->id }}" />
                                </div>
                                @endif
                            </div>

                            @if(!empty($b) && !array_key_exists('position', $b))
                            <div class="row no-gutters"> <!-- Stage 3 -->
                                @foreach($binary[$b['id']] as $c)
                                <div class="col-6 border-light">
                                    <div class="card shadow-sm text-center rounded-0 border-0 w-100 align-items-center">
                                        @if(!empty($c) && !array_key_exists('position', $c))
                                        <div class="card-header bg-success text-white w-100 rounded-0 binary-header-lg">
                                            <span class="binary-lg">
                                            <a class="btn btn-sm btn-light view-user-button" data-toggle="modal" data-target="#view-user" 
                                                fname="{{$c['fname']}}"
                                                lname="{{$c['lname']}}"
                                                uname="{{$c['uname']}}"
                                                gender="{{$c['gender']}}"
                                                email="{{$c['email']}}"
                                                phone="{{$c['phone']}}"
                                                datejoined="{{date( "F d, Y", strtotime($c['created_at']))}}"
                                                imgpath={{asset($c['path'])}}>
                                            <i data-feather="user" class="align-middle"></i></a>
                                            <a class="btn btn-sm btn-light" href="{{ route('binary-user', ['id' => $c['id']]) }}"><i data-feather="share-2" class="align-middle"></i></a>
                                            </span>
                                        </div>
                                        <div class="card-body p-0 text-center">
                                            <a tabindex="0"
                                            data-toggle="popover" title="{{ucwords($c['fname'].' '.$c['lname'])}}" data-placement="bottom" 
                                            data-trigger="focus"
                                            data-content='
                                            <span>{{$c['gender']}}</span><br />
                                            <span>{{$c['email']}}</span><br />
                                            <span>{{$c['phone']}}</span><br />
                                            <span>{{date( "F d, Y", strtotime($c['created_at']))}}</span><br /><br />
                                            <a class="btn btn-sm btn-primary text-white" href="{{ route('binary-user', ['id' => $c['id']]) }}">Show Binary Tree</a>'
                                            data-html="true">
                                            <img class="rounded-circle img-fluid mb-2 binary-img border border-success mt-2" src="{{ asset($c['path']) }}" />
                                            </a>
                                        </div>
                                        @else 
                                        <div class="card-header rounded-0 bg-warning text-white w-100 binary-header-lg">
                                            <span class="binary-lg">
                                            <button class="btn btn-light btn-sm binary-button" data-toggle="modal" data-target="#add-binary" position="{{ $c['position'] }}" referrer="{{ $b['id'] }}">
                                                <i data-feather="plus"></i>
                                            </button>
                                            </span>
                                        </div>
                                        <div class="card-body p-0 text-center">
                                            <img class="rounded-circle img-fluid mb-2 binary-img binary-button border border-warning mt-2" src="{{ asset('assets/img/logo.png') }}" data-toggle="modal" data-target="#add-binary" position="{{ $c['position'] }}" referrer="{{ $b['id'] }}" />
                                        </div>
                                        @endif
                                    </div>

                                    @if(!empty($c) && !array_key_exists('position', $c))
                                    <div class="row no-gutters"> <!-- Stage 4 -->
                                        @foreach($binary[$c['id']] as $d)
                                        <div class="col-6 border-light">
                                            <div class="card shadow-sm text-center rounded-0 border-0 w-100 align-items-center">
                                                @if(!empty($d) && !array_key_exists('position', $d))
                                                <div class="card-header bg-success text-white w-100 rounded-0 binary-header-sm">
                                                    <span class="binary-sm">
                                                    <button class="btn btn-sm btn-light view-user-button" data-toggle="modal" data-target="#view-user" 
                                                        fname="{{$d['fname']}}"
                                                        lname="{{$d['lname']}}"
                                                        uname="{{$d['uname']}}"
                                                        gender="{{$d['gender']}}"
                                                        email="{{$d['email']}}"
                                                        phone="{{$d['phone']}}"
                                                        datejoined="{{date( "F d, Y", strtotime($d['created_at']))}}"
                                                        imgpath={{asset($d['path'])}}>
                                                    <i data-feather="user" class="align-middle"></i></button>
                                                    <a class="btn btn-sm btn-light" href="{{ route('binary-user', ['id' => $d['id']]) }}"><i data-feather="share-2" class="align-middle"></i></a>
                                                    </span>
                                                </div>
                                                <div class="card-body p-0 text-center">
                                                    <a tabindex="0"
                                                    data-toggle="popover" title="{{ucwords($d['fname'].' '.$d['lname'])}}" data-placement="bottom" 
                                                    data-trigger="focus"
                                                    data-content='
                                                    <span>{{$d['gender']}}</span><br />
                                                    <span>{{$d['email']}}</span><br />
                                                    <span>{{$d['phone']}}</span><br />
                                                    <span>{{date( "F d, Y", strtotime($d['created_at']))}}</span><br /><br />
                                                    <a class="btn btn-sm btn-primary text-white" href="{{ route('binary-user', ['id' => $d['id']]) }}">Show Binary Tree</a>'
                                                    data-html="true">
                                                    <img class="rounded-circle img-fluid mb-2 binary-img border border-success mt-2" src="{{ asset($d['path']) }}" />
                                                    </a>
                                                </div>
                                                @else 
                                                <div class="card-header rounded-0 bg-warning text-white w-100 binary-header-sm">
                                                    <span class="binary-sm">
                                                    <button class="btn btn-light btn-sm binary-button" data-toggle="modal" data-target="#add-binary" position="{{ $d['position'] }}" referrer="{{ $c['id'] }}">
                                                        <i data-feather="plus"></i>
                                                    </button>
                                                    </span>
                                                </div>
                                                <div class="card-body p-0 text-center">
                                                    <img class="rounded-circle img-fluid mb-2 binary-img binary-button border border-warning mt-2" src="{{ asset('assets/img/logo.png') }}" data-toggle="modal" data-target="#add-binary" position="{{ $d['position'] }}" referrer="{{ $c['id'] }}" />
                                                </div>
                                                @endif
                                            </div>

                                            @if(!empty($d) && !array_key_exists('position', $d))
                                            <div class="row no-gutters level-xsm"> <!-- Stage 5 -->
                                                @foreach($binary[$d['id']] as $e)
                                                <div class="col-6 border-light">
                                                    <div class="card shadow-sm text-center rounded-0 border-0 w-100 align-items-center">
                                                        @if(!empty($e) && !array_key_exists('position', $e))
                                                        <div class="card-header bg-success text-white w-100 rounded-0 binary-header-xsm">
                                                            <span class="binary-xsm">
                                                            <button class="btn btn-sm btn-light view-user-button" data-toggle="modal" data-target="#view-user" 
                                                                fname="{{$e['fname']}}"
                                                                lname="{{$e['lname']}}"
                                                                uname="{{$e['uname']}}"
                                                                gender="{{$e['gender']}}"
                                                                email="{{$e['email']}}"
                                                                phone="{{$e['phone']}}"
                                                                datejoined="{{date( "F d, Y", strtotime($e['created_at']))}}"
                                                                imgpath={{asset($e['path'])}}>
                                                            <i data-feather="user" class="align-middle"></i></button>
                                                            <a class="btn btn-sm btn-light" href="{{ route('binary-user', ['id' => $e['id']]) }}"><i data-feather="share-2" class="align-middle"></i></a>
                                                            </span>
                                                        </div>
                                                        <div class="card-body p-0 text-center">
                                                            <a tabindex="0"
                                                            data-toggle="popover" title="{{ucwords($e['fname'].' '.$e['lname'])}}" data-placement="bottom" 
                                                            data-trigger="focus"
                                                            data-content='
                                                            <span>{{$e['gender']}}</span><br />
                                                            <span>{{$e['email']}}</span><br />
                                                            <span>{{$e['phone']}}</span><br />
                                                            <span>{{date( "F d, Y", strtotime($e['created_at']))}}</span><br /><br />
                                                            <a class="btn btn-sm btn-primary text-white" href="{{ route('binary-user', ['id' => $e['id']]) }}">Show Binary Tree</a>'
                                                            data-html="true">
                                                            <img class="rounded-circle img-fluid mb-2 binary-img border border-success mt-2" src="{{ asset($e['path']) }}" />
                                                            </a>
                                                        </div>
                                                        @else
                                                        <div class="card-header rounded-0 bg-warning text-white w-100 binary-header-xsm">
                                                            <span class="binary-xsm">
                                                            <button class="btn btn-light btn-sm binary-button" data-toggle="modal" data-target="#add-binary" position="{{ $e['position'] }}" referrer="{{ $d['id'] }}">
                                                                <i data-feather="plus"></i>
                                                            </button>
                                                            </span>
                                                        </div> 
                                                        <div class="card-body p-0 text-center">
                                                            <img class="rounded-circle img-fluid mb-2 binary-img binary-button border border-warning mt-2" src="{{ asset('assets/img/logo.png') }}" data-toggle="modal" data-target="#add-binary" position="{{ $e['position'] }}" referrer="{{ $d['id'] }}" />
                                                        </div>
                                                        @endif
                                                    </div>

                                                    @if(!empty($e) && !array_key_exists('position', $e))
                                                    <div class="row no-gutters level-xsm"> <!-- Stage 6 -->
                                                        @foreach($binary[$e['id']] as $f)
                                                        <div class="col-6 border-light">
                                                            <div class="card shadow-sm text-center rounded-0 border-0 w-100 align-items-center">
                                                                @if(!empty($f) && !array_key_exists('position', $f))
                                                                <div class="card-header bg-success text-white w-100 rounded-0 binary-header-xsm">
                                                                    <span class="binary-xsm">
                                                                    <button class="btn btn-sm btn-light view-user-button" data-toggle="modal" data-target="#view-user" 
                                                                        fname="{{$f['fname']}}"
                                                                        lname="{{$f['lname']}}"
                                                                        uname="{{$f['uname']}}"
                                                                        gender="{{$f['gender']}}"
                                                                        email="{{$f['email']}}"
                                                                        phone="{{$f['phone']}}"
                                                                        datejoined="{{date( "F d, Y", strtotime($f['created_at']))}}"
                                                                        imgpath={{asset($f['path'])}}>
                                                                    <i data-feather="user" class="align-middle"></i></button>
                                                                    <a class="btn btn-sm btn-light" href="{{ route('binary-user', ['id' => $f['id']]) }}"><i data-feather="share-2" class="align-middle"></i></a>
                                                                    </span>
                                                                </div>
                                                                <div class="card-body p-0 text-center">
                                                                    <a tabindex="0"
                                                                    data-toggle="popover" title="{{ucwords($f['fname'].' '.$f['lname'])}}" data-placement="bottom" 
                                                                    data-trigger="focus"
                                                                    data-content='
                                                                    <span>{{$f['gender']}}</span><br />
                                                                    <span>{{$f['email']}}</span><br />
                                                                    <span>{{$f['phone']}}</span><br />
                                                                    <span>{{date( "F d, Y", strtotime($f['created_at']))}}</span><br /><br />
                                                                    <a class="btn btn-sm btn-primary text-white" href="{{ route('binary-user', ['id' => $f['id']]) }}">Show Binary Tree</a>'
                                                                    data-html="true">
                                                                    <img class="rounded-circle img-fluid mb-2 binary-img border border-success mt-2" src="{{ asset($f['path']) }}" />
                                                                    </a>
                                                                </div>
                                                                @else
                                                                <div class="card-header rounded-0 bg-warning text-white w-100 binary-header-xsm">
                                                                    <span class="binary-xsm">
                                                                    <button class="btn btn-light btn-sm binary-button" data-toggle="modal" data-target="#add-binary" position="{{ $f['position'] }}" referrer="{{ $e['id'] }}">
                                                                        <i data-feather="plus"></i>
                                                                    </button>
                                                                    </span>
                                                                </div> 
                                                                <div class="card-body p-0 text-center">
                                                                    <img class="rounded-circle img-fluid mb-2 binary-img binary-button border border-warning mt-2" src="{{ asset('assets/img/logo.png') }}" data-toggle="modal" data-target="#add-binary" position="{{ $f['position'] }}" referrer="{{ $e['id'] }}" />
                                                                </div>
                                                                @endif
                                                            </div>

                                                            @if(!empty($f) && !array_key_exists('position', $f))
                                                            <div class="row no-gutters level-xsm"> <!-- Stage 7 -->
                                                                @foreach($binary[$f['id']] as $g)
                                                                <div class="col-6 border-light">
                                                                    <div class="card shadow-sm text-center rounded-0 border-0 w-100 align-items-center">
                                                                        @if(!empty($g) && !array_key_exists('position', $g))
                                                                        <div class="card-header bg-success text-white w-100 rounded-0 binary-header-xsm">
                                                                            <span class="binary-xsm">
                                                                            <button class="btn btn-sm btn-light view-user-button" data-toggle="modal" data-target="#view-user" 
                                                                                fname="{{$g['fname']}}"
                                                                                lname="{{$g['lname']}}"
                                                                                uname="{{$g['uname']}}"
                                                                                gender="{{$g['gender']}}"
                                                                                email="{{$g['email']}}"
                                                                                phone="{{$g['phone']}}"
                                                                                datejoined="{{date( "F d, Y", strtotime($g['created_at']))}}"
                                                                                imgpath={{asset($g['path'])}}>
                                                                            <i data-feather="user" class="align-middle"></i></button>
                                                                            <a class="btn btn-sm btn-light" href="{{ route('binary-user', ['id' => $g['id']]) }}"><i data-feather="share-2" class="align-middle"></i></a>
                                                                            </span>
                                                                        </div>
                                                                        <div class="card-body p-0 text-center">
                                                                            <a tabindex="0"
                                                                            data-toggle="popover" title="{{ucwords($g['fname'].' '.$g['lname'])}}" data-placement="bottom" 
                                                                            data-trigger="focus"
                                                                            data-content='
                                                                            <span>{{$g['gender']}}</span><br />
                                                                            <span>{{$g['email']}}</span><br />
                                                                            <span>{{$g['phone']}}</span><br />
                                                                            <span>{{date( "F d, Y", strtotime($g['created_at']))}}</span><br /><br />
                                                                            <a class="btn btn-sm btn-primary text-white" href="{{ route('binary-user', ['id' => $g['id']]) }}">Show Binary Tree</a>'
                                                                            data-html="true">
                                                                            <img class="rounded-circle img-fluid mb-2 binary-img border border-success mt-2" src="{{ asset($g['path']) }}" />
                                                                            </a>
                                                                        </div>
                                                                        @else
                                                                        <div class="card-header rounded-0 bg-warning text-white w-100 binary-header-xsm">
                                                                            <span class="binary-xsm">
                                                                            <button class="btn btn-light btn-sm binary-button" data-toggle="modal" data-target="#add-binary" position="{{ $g['position'] }}" referrer="{{ $f['id'] }}">
                                                                                <i data-feather="plus"></i>
                                                                            </button>
                                                                            </span>
                                                                        </div> 
                                                                        <div class="card-body p-0 text-center">
                                                                            <img class="rounded-circle img-fluid mb-2 binary-img binary-button border border-warning mt-2" src="{{ asset('assets/img/logo.png') }}" data-toggle="modal" data-target="#add-binary" position="{{ $g['position'] }}" referrer="{{ $f['id'] }}" />
                                                                        </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                @endforeach
                                                            </div>
                                                            @endif
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                    @endif
                                                </div>
                                                @endforeach
                                            </div>
                                            @endif
                                        </div>
                                        @endforeach
                                    </div>
                                    @endif
                                </div>
                                @endforeach
                            </div>
                            @endif
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row text-align-center">
        <div class="card bg-secondary mb-4 shadow-sm h-100 w-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="mr-3">
                        <div class="text-white text-lg">In order to go deeper in your Binary Tree, you may view anyone by clicking on their picture and select the "Show Binary Tree" button.</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row text-align-center alert-small-screen">
        <div class="card bg-primary mb-4 shadow-sm h-100 w-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="mr-3">
                        <div class="text-white text-lg">Binary Tree can't be viewed properly in smaller screens, try rotating your device or open the site in a larger screen.</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
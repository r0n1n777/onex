@extends('layouts.dashboard')

@section('content')
<header class="page-header page-header-compact border-bottom bg-gradient-primary-to-secondary mb-4">
    <div class="container-fluid">
        <div class="page-header-content">
            <div class="row align-items-center justify-content-between pt-3">
                <div class="col-auto mb-3">
                    <h1 class="page-header-title text-white">
                        <div class="page-header-icon"><i data-feather="user"></i></div>
                        Account Settings - Profile
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
                    <!-- Profile picture image-->
                    <img class="center-cropped-md rounded-circle img-fluid" src="{{ $path }}" alt="" />
                    <!-- Profile picture help block-->
                    <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
                    <!-- Profile picture upload button-->

                    <div id="profile-picture-modal-error" class="modal" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-gradient-primary-to-secondary text-white">
                                    <b>Something went wrong.</b>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true" class="text-white">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col" id="profile-picture-modal-error-content">

                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer"></div>
                            </div>
                        </div>
                    </div>

                    <div id="profile-picture-modal" class="modal" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-gradient-primary-to-secondary text-white">
                                    <b>Crop your Picture</b>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close-profile-picture-modal">
                                        <span aria-hidden="true" class="text-white">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col ml-auto">
                                            <div id="picture-box"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-primary" id="crop-upload-picture">Crop and Upload Picture</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <form id="form-picture-file" enctype="multipart/form-data" method="POST" action="{{ route('uploadProfilePicture') }}">
                        @csrf
                        <input id="picture-file" name="profile-picture" type="file" class="d-none" />
                    </form>    
                    <button id="upload-button" class="btn btn-primary" type="button" onclick="$('#picture-file').click();">
                        <i data-feather="camera" class="mr-1"></i>
                        Upload New Picture
                    </button>
                </div>
            </div>
        </div>
        <div class="col-xl-8">
            <!-- Account details card-->
            <div class="card shadow-sm mb-4" data-aos="fade-up" data-aos-delay="200">
                <div class="card-header bg-gradient-primary-to-secondary text-white">Account Details</div>
                <div class="card-body">
                    <form action="{{ route('profileUpdate') }}" method="POST">
                        @csrf
                        <!-- Form Group (username)-->
                        <div class="form-group">
                            <label class="small mb-1" for="uname">Username</label>
                            <input class="form-control" id="uname" type="text" placeholder="Enter your username" value="{{ $user->uname }}" disabled />
                        </div>
                        <!-- Form Row-->
                        <div class="form-row">
                            <!-- Form Group (first name)-->
                            <div class="form-group col-md-6">
                                <label class="small mb-1" for="fname">First name</label>
                                <input class="form-control text-capitalize @error('fname') is-invalid @enderror" id="fname" name="fname" type="text" value="{{ $user->fname }}" />
                                @error('fname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <!-- Form Group (last name)-->
                            <div class="form-group col-md-6">
                                <label class="small mb-1" for="lname">Last name</label>
                                <input class="form-control text-capitalize @error('lname') is-invalid @enderror" id="lname" name="lname" type="text" value="{{ $user->lname }}" />
                                @error('lname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <!-- Form Group (email address)-->
                        <div class="form-group">
                            <label class="small mb-1" for="email">Email address</label>
                            <input class="form-control @error('email') is-invalid @enderror" id="email" name="email" type="text" placeholder="Enter your email address" value="{{ $user->email }}" />
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <!-- Form Row-->
                        <div class="form-row">
                            <!-- Form Group (phone number)-->
                            <div class="form-group col-md-6">
                                <label class="small mb-1" for="phone">Phone number</label>
                                <input class="form-control" id="phone" type="text" value="{{ $user->phone }}" disabled />
                            </div>
                            <!-- Form Group (birthday)-->
                            <div class="form-group col-md-6">
                                <label class="small mb-1" for="gender">Gender</label>
                                <select class="custom-select @error('gender') is-invalid @enderror" id="gender" name="gender" value="{{ $user->gender }}">
                                    <option>Male</option>
                                    <option>Female</option>
                                </select>
                                @error('gender')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <!-- Save changes button-->
                        <button class="btn btn-primary" type="submit">
                            <i data-feather="save" class="mr-1"></i>
                            Save changes
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
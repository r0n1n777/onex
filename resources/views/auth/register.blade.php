@extends('layouts/app')

@section('content')

<section class="bg-primary">
    <div class="container bg-light shadow-sm">
        <div class="row justify-content-center p-5">
            <div class="col-xl-10">
                <div class="card shadow-sm mb-4 border-none">
                <div class="card-header bg-gradient-primary-to-secondary text-white">Account Registration</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                        @csrf
                            <!-- Form Group (username)-->
                            <div class="form-group">
                                <label class="small mb-1" for="uname">Username (how your name will appear to other users on the site)</label>
                                <input class="form-control @error('uname') is-invalid @enderror" id="uname" name="uname" type="text" placeholder="juandelacruz777" value="{{ old('uname') }}" />
                                @error('uname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <!-- Form Row-->
                            <div class="form-row">
                                <!-- Form Group (first name)-->
                                <div class="form-group col-md-6">
                                    <label class="small mb-1" for="fname">First name</label>
                                    <input class="text-capitalize form-control @error('fname') is-invalid @enderror" id="fname" name="fname" type="text" placeholder="Juan" value="{{ old('fname') }}" />
                                    @error('fname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <!-- Form Group (last name)-->
                                <div class="form-group col-md-6">
                                    <label class="small mb-1" for="lname">Last name</label>
                                    <input class="text-capitalize form-control @error('lname') is-invalid @enderror" id="lname" name="lname" type="text" placeholder="Dela Cruz" value="{{ old('lname') }}" />
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
                                <input class="form-control @error('email') is-invalid @enderror" id="email" name="email" type="email" placeholder="juandelacruz@email.com" value="{{ old('email') }}" />
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
                                    <label class="small mb-1" for="gender">Gender</label>
                                    <select class="custom-select @error('gender') is-invalid @enderror" id="gender" name="gender" value="{{ old('gender') }}">
                                        <option>Male</option>
                                        <option>Female</option>
                                    </select>
                                    @error('gender')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <!-- Form Group (phone number)-->
                                <div class="form-group col-md-6">
                                    <label class="small mb-1" for="phone">Phone number</label>
                                    <input class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" placeholder="09123456789" value="{{ old('phone') }}" maxlength="11" />
                                    @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- Form Row-->
                            <div class="form-row">
                                <!-- Form Group (phone number)-->
                                <div class="form-group col-md-6">
                                    <label class="small mb-1" for="password">Password</label>
                                    <input class="form-control @error('password') is-invalid @enderror" id="password" name="password" type="password" placeholder="Choose your password" maxlength="25" />
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <!-- Form Group (phone number)-->
                                <div class="form-group col-md-6">
                                    <label class="small mb-1" for="password-confirm">Confirm Password</label>
                                    <input class="form-control @error('password-confirm') is-invalid @enderror" id="password-confirm" name="password_confirmation" type="password" placeholder="Confirm your password" maxlength="25" />
                                    @error('password-confirm')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                @isset($referrer)
                                <div class="form-group col-md-6">
                                    <label class="small mb-1">Referrer's Information</label>
                                    <span class="form-control border-warning bg-warning text-dark"><b class="text-capitalize">{{ $referrer->fname }} {{ $referrer->lname }}</b> - {{ $referrer->uname }}</span>
                                </div>
                                @endisset
                                @isset($invalid_link)
                                <div class="form-group col-md-6 bg-light p-2 rounded">
                                    <strong class="text-primary">Invalid Referral Link</strong><br />
                                    <span class="text-dark" role="alert">
                                        Make sure that you have the correct link that should have been provided 
                                        to you by your referrer otherwise, you can continue without having a referrer.
                                    </span>
                                </div>
                                @endisset
                                <input id="referrer_id" name="referrer_id" type="hidden" value="@isset($referrer) {{ $referrer->id }} @endisset" />
                            </div>
                            <!-- Save changes button-->
                            <button class="btn btn-primary" type="submit">Create your Account</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
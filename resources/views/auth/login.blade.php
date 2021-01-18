@extends('layouts/app')

@section('content')
<section class="bg-primary">
    <div class="container bg-light shadow-sm">
        <div class="row justify-content-center p-5">
            <div class="col-xl-10">
                <div class="card shadow-sm mb-4 border-none">
                <div class="card-header bg-gradient-primary-to-secondary text-white">Account Login</div>
                    <div class="card-body">
                        @isset($passwordchanged)
                        <div class="form-control bg-success text-white mb-3">
                            <i data-feather="check" class="mr-1"></i>
                            <b>{{ $passwordchanged }}</b>
                        </div>
                        @endisset
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group">
                            <label class="small mb-1" for="uname">Username</label>
                            <input class="form-control @error('uname') is-invalid @enderror" id="uname" name="uname" type="text" value="{{ old('uname') }}" />
                            @error('uname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="small mb-1" for="password">Password</label>
                            <input class="form-control @error('password') is-invalid @enderror" id="password" name="password" type="password" />
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

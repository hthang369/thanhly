@extends('layouts.app')

@push('styles')
<link href="{{ asset('css/login.css') }}" rel="stylesheet">
@endpush
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="login-wrap p-4">
                <div class="icon mx-auto mb-2 bg-primary rounded-circle d-flex align-items-center justify-content-center">
                    <span class="fa fa-user-o"></span>
                </div>
                <h3 class="text-center text-white mb-4">{{ __('Login') }}</h3>
                @if(session('notice'))
                <p style="color:red">
                    {{session('notice')}}
                </p>
                @endif
                <form method="POST" action="{{ route('login') }}" class="login-form">
                    @csrf
                    <div class="form-group row">
                        <div class="col">
                            <input id="email" type="text"
                                class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}"
                                autocomplete="email" autofocus
                                placeholder="{{ __('E-Mail Address') }}">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col">
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror"
                                name="password" autocomplete="current-password"
                                placeholder="{{ __('Password') }}">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col">
                            <button type="submit" class="btn btn-primary btn-block">
                                {{ __('Login') }}
                            </button>
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col">
                            <div class="d-flex justify-content-between">
                                <div class="custom-control custom-checkbox d-flex align-items-center">
                                    <input type="checkbox" class="custom-control-input" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="custom-control-label text-white" for="remember">{{ __('Remember Me') }}</label>
                                </div>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

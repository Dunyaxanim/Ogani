@extends('custom_auth.layouts.app')

@section('_content')
    <div style="height: 100vh" class="d-flex justfay-content-center">
        <div class="card card-info col-4 m-auto">
            @if (session('error'))
                <div class="alert alert-warning">
                    {{ session('error') }}
                </div>
            @endif
            <div class="card-header">
                <h3 class="card-title">{{ __('Login Form') }}</h3>
            </div>
            <form action="{{ route('loginform') }}" method="POST">
                @csrf
                    <div class="card-body">
                        <div class="row mb-3">
                            <label for="email"
                                class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                        {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">Sign in</button>
                        <a href="{{ route('home') }}" class="btn btn-default float-right">Cancel</a> <br>
                        <a style="color:cornflowerblue; cursor: pointer; text-decoration:none"
                            href="{{ route('registerindex') }}">Dont you have an account?</a><br>
                            <a style="color:cornflowerblue; cursor: pointer; text-decoration:none"
                            href="{{ route('forgot-password') }}">Forgot your password?</a>
                    </div>
            </form>
        </div>
    </div>
@endsection

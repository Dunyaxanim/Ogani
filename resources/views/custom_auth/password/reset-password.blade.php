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
                <h3 class="card-title">{{ __('Reset password') }}</h3>
            </div>
            <form action="{{ route('forgot-password-post') }}" method="POST">
                @csrf
                <div style="padding:20px">
                    <input type="text" hidden name="token" value="{{ $token[0] }}">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Password</label><br>
                        <input type="password" class="form-control my-2" id="exampleInputEmail1"
                            aria-describedby="emailHelp" placeholder="Enter password" name="password"> <br>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Password confirmation</label><br>
                        <input type="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                            placeholder="Enter password confirmation" name="password_confirmation"> <br>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection

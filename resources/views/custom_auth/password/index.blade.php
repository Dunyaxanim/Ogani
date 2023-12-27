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
            <form action="{{ route('forgot-password') }}" method="POST">
                @csrf
                <div style="padding:20px">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label><br>
                        <input type="email" class="form-control my-1" id="exampleInputEmail1" aria-describedby="emailHelp"
                            placeholder="Enter email" name="email"> <br>
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                            else.
                        </small>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>

        </div>
    </div>
@endsection

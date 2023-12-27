@extends('custom_auth.layouts.app')

@section('_content')
    <div class="profil-page">
        <section class="">
            <div class="container-fluid m-auto">
                <div class="content_custom">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="card card-primary card-outline">
                                <div class="card-body box-profile">
                                    <div class="text-center">
                                        <div style="height: 150px;">
                                            @if ($user->img != null)
                                                <img src="{{ Storage::url($user->img) }}" alt="User profile picture"
                                                    style="object-fit: cover; height:100%; border-radius:50%;">
                                            @else
                                                <img src="https://cdn-icons-png.flaticon.com/512/4151/4151021.png"
                                                    alt="User profile picture"
                                                    style="object-fit: cover; height:100%; border-radius:50%;">
                                            @endif
                                        </div>
                                        <form action="{{ route('logout_test') }}" method="post">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-dark my-1">Logout</button>
                                        </form>
                                        @if ($user->img != null)
                                            <form action="{{ route('removePhoto', $user) }}" method="post">
                                                @csrf
                                                <button type="submit" class="btn btn-outline-dark my-1">Photo
                                                    remove</button>
                                            </form>
                                        @endif

                                    </div>
                                    <h3 class="profile-username text-center">{{ $user->name }}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header p-2">
                                    <ul class="nav nav-pills">
                                        <li class="nav-item"><a class="nav-link" href="#settings"
                                                data-toggle="tab">{{ __('Settings') }}</a>
                                        </li>
                                    </ul>
                                </div><!-- /.card-header -->
                                <div class="card-body">
                                    <div class="tab-content">
                                        <div class="active tab-pane" id="activity">
                                            <div class="tab-pane" id="settings">
                                                <form class="form-horizontal"
                                                    action="{{ route('updateProfil', Auth::user()) }}" method="POST"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="card-body">
                                                        <div class="row mb-3">
                                                            <label for="name"
                                                                class="col-md-4 col-form-label ">{{ __('Name') }}</label>
                                                            <div class="col-md-6">
                                                                <input id="name" type="name"
                                                                    class="form-control @error('name') is-invalid @enderror"
                                                                    name="name" value="{{ old('name', $user->name) }}"
                                                                    autocomplete="name" autofocus>
                                                                @error('name')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <label for="last_name"
                                                                class="col-md-4 col-form-label ">{{ __('Last name') }}</label>

                                                            <div class="col-md-6">
                                                                <input id="last_name" type="last_name"
                                                                    class="form-control @error('last_name') is-invalid @enderror"
                                                                    name="last_name"
                                                                    value="{{ old('last_name', $user->last_name) }}"
                                                                    autocomplete="last_name" autofocus>

                                                                @error('lastname')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <label for="email"
                                                                class="col-md-4 col-form-label ">{{ __('Email Address') }}</label>

                                                            <div class="col-md-6">
                                                                <input id="email" type="email"
                                                                    class="form-control @error('email') is-invalid @enderror"
                                                                    name="email" value="{{ old('email', $user->email) }}"
                                                                    autocomplete="email" autofocus>

                                                                @error('email')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <label for="phone"
                                                                class="col-md-4 col-form-label ">{{ __('Phone') }}</label>

                                                            <div class="col-md-6">
                                                                <input id="phone" type="phone"
                                                                    class="form-control @error('phone') is-invalid @enderror"
                                                                    name="phone" value="{{ old('phone', $user->phone) }}"
                                                                    autocomplete="phone" autofocus>

                                                                @error('phone')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <label for="img"
                                                                class="col-md-4 col-form-label ">{{ __('Image') }}</label>
                                                            <div class="col-md-6">
                                                                <input id="img" type="file" class="form-control"
                                                                    name="img">
                                                                @error('img')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer">
                                                        <button type="submit"
                                                            class="btn btn-info">{{ __('Save') }}</button>
                                                        <a href="{{ route('home') }}"
                                                            class="btn btn-warning">{{ __('Cancle') }}</a>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- /.tab-pane -->
                                        </div>
                                        <!-- /.tab-content -->
                                    </div><!-- /.card-body -->
                                </div>
                                <!-- /.nav-tabs-custom -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header p-2">
                                    <ul class="nav nav-pills">
                                        <li class="nav-item"><a class="nav-link"
                                                data-toggle="tab">{{ __('Change password') }}</a>
                                        </li>
                                    </ul>
                                </div><!-- /.card-header -->
                                <div class="card-body">
                                    <div class="tab-content">
                                        <div class="active tab-pane" id="activity">
                                            <div class="tab-pane" id="settings">
                                                <form class="form-horizontal"
                                                    action="{{ route('updatePassword', Auth::user()) }}" method="POST"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <input id="name" type="hidden" value="{{ Auth::user()->email }}" class="form-control" name="email">
                                                    <div class="card-body">
                                                        <div class="row mb-3">
                                                            <label for="name"
                                                                class="col-md-4 col-form-label ">{{ __('Old password') }}</label>
                                                            <div class="col-md-6">
                                                                <input id="name" type="password"
                                                                    class="form-control @error('password') is-invalid @enderror"
                                                                    name="password"
                                                                    autocomplete="password" autofocus>
                                                                @error('password')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer">
                                                        <button type="submit"
                                                            class="btn btn-info">{{ __('Save') }}</button>
                                                        <a href="{{ route('home') }}"
                                                            class="btn btn-warning">{{ __('Cancle') }}</a>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- /.tab-pane -->
                                        </div>
                                        <!-- /.tab-content -->
                                    </div><!-- /.card-body -->
                                </div>
                                <!-- /.nav-tabs-custom -->
                            </div>
                            <!-- /.col -->
                        </div>
                    </div>
                </div>
        </section>
        @if (\Session::has('message'))
            <div class="alert alert-success deleted-message col-3 position-absolute">
                <ul class="list-unstyled">
                    <li>{!! \Session::get('message') !!}</li>
                </ul>
            </div>
        @endif
        @if (\Session::has('error'))
            <div class="alert alert-success deleted-message col-3 position-absolute">
                <ul class="list-unstyled">
                    <li>{!! \Session::get('error') !!}</li>
                </ul>
            </div>
        @endif
    </div>
@endsection
@section('_scripts')
    <script>
        const message = document.querySelector('.deleted-message')
        if (message) {
            setTimeout(() => {
                message.classList.add("fade");
            }, 2000);
        }
    </script>
@endsection

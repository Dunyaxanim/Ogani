@extends('admin.layouts.app')
@section('_content')
    <?php $routeName = 'admin.user-'; ?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{ __('Create Form') }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Dashboard') }}</a></li>
                            {{-- <li class="breadcrumb-item active"><a href="{{ route('userlist') }}">All Sliders</a></li> --}}
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-6">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Create Blog</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->

                            <form role="form"
                                action="{{ isset($model) ? route($routeName . 'update', $model) : route($routeName . 'create') }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                @if (isset($model))
                                    @method('put')
                                @endif
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">{{ __('Name') }}</label>
                                        <input type="name" class="form-control @error('name') is-invalid @enderror"
                                            id="exampleInputEmail1" placeholder="{{ __('Enter name') }}"
                                            value="{{ old('name', isset($model) ? $model->name : '') }}" name="name">
                                        @error('name')
                                            <span class="text-danger" style="font-size: 14x">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">{{ __('Last Name') }}</label>
                                        <input type="name" class="form-control @error('last_name') is-invalid @enderror"
                                            id="exampleInputEmail1" placeholder="{{ __('Enter name') }}"
                                            value="{{ old('last_name', isset($model) ? $model->last_name : '') }}"
                                            name="last_name">
                                        @error('last_name')
                                            <span class="text-danger" style="font-size: 14x">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">{{ __('Email') }}</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            id="exampleInputEmail1" placeholder="Enter email"
                                            value="{{ old('email', isset($model) ? $model->email : '') }}" name="email">
                                        @error('email')
                                            <span class="text-danger" style="font-size: 14x">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">{{ __('Phone') }}</label>
                                        <input type="phone" class="form-control @error('phone') is-invalid @enderror"
                                            id="exampleInputEmail1" placeholder="Enter phone"
                                            value="{{ old('phone', isset($model) ? $model->phone : '') }}" name="phone">
                                        @error('phone')
                                            <span class="text-danger" style="font-size: 14x">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    @if(!isset($model))
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">{{ __('Password') }}</label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                                            id="exampleInputEmail1" placeholder="Enter password"
                                            value="{{ old('password', isset($model) ? $model->password : '') }}"
                                            name="password">
                                        @error('password')
                                            <span class="text-danger" style="font-size: 14x">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">{{ __('Password confirmation') }}</label>
                                        <input type="password" class="form-control" id="exampleInputEmail1"
                                            placeholder="Enter password confirmation" name="password_confirmation">
                                    </div>
                                    @endif
                                    @if (\Request::route()->getName() == 'admin.user-create-form' || \Request::route()->getName() == 'admin.user-show')
                                        <div class="form-group">
                                        <label for="exampleFormControlSelect1">{{__("Type")}}</label>
                                        <select class="form-control" id="exampleFormControlSelect1" name="type">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            {{-- @foreach($categories as $category)
                                             <option  value="{{$category->id}}"
                                                @isset($model) @if($category->id == $model->category_id) selected @endif @endisset>{{$category->title}}</option>
                                            @endforeach --}}
                                        </select>
                                        @error('type')
                                            <span class="text-danger" style="font-size: 14x">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    @endif
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->

                    </div>
                    <!--/.col (left) -->
                    <!-- right column -->

                    <!--/.col (right) -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
    </div>
@endsection

{{-- 
@section('_scripts')
 <script>
      document.getElementById('open_time').value = {{$model->open_time}};
</script>
@endsection --}}

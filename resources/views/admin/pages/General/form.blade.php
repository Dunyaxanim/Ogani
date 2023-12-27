@extends('admin.layouts.app')
@section('_content')
    <?php $routeName = 'admin.general-'; ?>
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
                            {{-- <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{__("Dashboard")}}</a></li> --}}
                            <li class="breadcrumb-item active"><a
                                    href="{{ route($routeName . 'index') }}">{{ __('List data') }}</a></li>
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
                        <div class="card card-primary card-tabs">
                            <!-- /.card-header -->
                            <!-- form start -->

                            <form role="form"
                                action="{{ isset($model) ? route($routeName . 'update', $model) : route($routeName . 'create') }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                @if (isset($model))
                                    @method('put')
                                @endif
                                <div class="card-header p-0 pt-1">
                                    <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                        @foreach (config('translatable.locales') as $lang)
                                            <li class="nav-item ">
                                                <a class="nav-link {{ $loop->first ? 'active show' : '' }}@error("$lang.title") text-danger @enderror"
                                                    id="custom-tabs-one-home-tab" data-toggle="pill"
                                                    href="#tab-{{ $lang }}" role="tab"
                                                    aria-controls="custom-tabs-one-home"
                                                    aria-selected="true">{{ $lang }}</a>
                                            </li>
                                        @endforeach

                                    </ul>
                                </div>
                                <div class="card-body">
                                    <div class="tab-content" id="custom-tabs-one-tabContent">
                                        @foreach (config('translatable.locales') as $key => $lang)
                                            <div class="tab-pane fade {{ $loop->first ? 'active show' : '' }}"
                                                id="tab-{{ $lang }}" role="tabpanel"
                                                aria-labelledby="custom-tabs-one-home-tab">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">{{ $lang }} Title</label>
                                                    <input type="text"
                                                        class="form-control @error('title') is-invalid @enderror"
                                                        id="exampleInputEmail1" placeholder="Enter title"
                                                        {{-- value="{{isset($model) ? $model->translateOrDefault($lang)->title : ""}}" --}}
                                                        value="{{ old("$lang.title", isset($model) ? $model->translateOrDefault($lang)->title : '') }}"
                                                        name="{{ $lang }}[title]">
                                                    @error('title')
                                                        <span class="text-danger"
                                                            style="font-size: 14x">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">{{ $lang }}
                                                        {{ __('Company Name') }}</label>
                                                    <input type="text"
                                                        class="form-control @error('company_name') is-invalid @enderror"
                                                        id="exampleInputEmail1" placeholder="Enter company name"
                                                        value="{{ old("$lang.company_name", isset($model) ? $model->translateOrDefault($lang)->company_name : '') }}"
                                                        name="{{ $lang }}[company_name]">
                                                    @error('company_name')
                                                        <span class="text-danger"
                                                            style="font-size: 14x">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">{{ $lang }}
                                                        {{ __('Address') }}</label>
                                                    <input type="text"
                                                        class="form-control @error('address') is-invalid @enderror"
                                                        id="exampleInputEmail1" placeholder="Enter address"
                                                        value="{{ old("$lang.address", isset($model) ? $model->translateOrDefault($lang)->address : '') }}"
                                                        name="{{ $lang }}[address]">
                                                    @error('address')
                                                        <span class="text-danger"
                                                            style="font-size: 14x">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">{{ __('Phone') }}</label>
                                        <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                            id="exampleInputEmail1" placeholder="Enter phone"
                                            value="{{ old('phone', isset($model) ? $model->phone : '') }}" name="phone">
                                        @error('phone')
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
                                        <label for="exampleInputEmail1">{{ __('Open time') }}</label>
                                        <input type="time" class="form-control @error('open_time') is-invalid @enderror"
                                            id="open_time" placeholder="Enter open time" name="open_time">
                                        @error('open_time')
                                            <span class="text-danger" style="font-size: 14x">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">{{ __('Shipping price') }}</label>
                                        <input type="text"
                                            class="form-control @error('shipping_price') is-invalid @enderror"
                                            id="exampleInputEmail1" placeholder="Enter shipping price"
                                            value="{{ old('shipping_price', isset($model) ? $model->shipping_price : '') }}"
                                            name="shipping_price">
                                        @error('shipping_price')
                                            <span class="text-danger" style="font-size: 14x">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">{{ __('Logo img') }}</label>
                                        <input type="file" class="form-control @error('logo_img') is-invalid @enderror"
                                            id="exampleInputEmail1" placeholder="Enter logo img" name="logo_img">
                                        @error('logo_img')
                                            <span class="text-danger" style="font-size: 14x">{{ $message }}</span>
                                        @enderror
                                    </div>
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

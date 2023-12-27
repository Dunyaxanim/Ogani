@extends('admin.layouts.app')
@section('_content')
    <?php $routeName = 'admin.map-'; ?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Map Create Form</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            {{-- <li class="breadcrumb-item"><a href="{{ route('admin/') }}">{{__("Dashboard")}}</a></li> --}}
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
                    <div class="col-md-6">
                        <div class="card card-primary">
                            <form role="form"
                                action="{{ isset($model) ? route($routeName . 'update', $model) : route($routeName . 'create') }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                @if (isset($model))
                                    @method('put')
                                @endif
                                <div class="card card-primary card-tabs">
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
                                                        <label for="exampleInputEmail1">{{ $lang }}
                                                            {{ __('Country') }}</label>
                                                        <input type="text"
                                                            class="form-control @error('country') is-invalid @enderror"
                                                            id="exampleInputEmail1" placeholder="Enter country"
                                                            value="{{ old("$lang.country", isset($model) ? $model->translateOrDefault($lang)->country : '') }}"
                                                            name="{{ $lang }}[country]">
                                                        @error('country')
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

                                            <div class="form-group">
                                                <label for="exampleInputEmail1">{{ __('Phone') }}</label>
                                                <input type="text"
                                                    class="form-control @error('phone') is-invalid @enderror"
                                                    id="exampleInputEmail1" placeholder="Enter phone" name="phone"
                                                    value="{{ old('phone', isset($model) ? $model->phone : '') }}">
                                                @error('phone')
                                                    <span class="text-danger" style="font-size: 14x">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleInputEmail1">{{ __('Link') }}</label>
                                                <input type="text"
                                                    class="form-control @error('link') is-invalid @enderror"
                                                    id="exampleInputEmail1" placeholder="Enter link" name="link"
                                                    value="{{ old('link', isset($model) ? $model->link : '') }}">
                                                @error('link')
                                                    <span class="text-danger" style="font-size: 14x">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

{{-- 
@section('_scripts')
 <script>
      document.getElementById('open_time').value = {{$model->open_time}};
</script>
@endsection --}}

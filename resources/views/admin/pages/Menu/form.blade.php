@extends('admin.layouts.app')
@section('_content')
    <?php $routeName = 'admin.menu-'; ?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Menu Create Form</h1>
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
                    <!-- left column -->
                    <div class="col-md-6">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <!-- /.card-header -->
                            <!-- form start -->

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
                                            @foreach (config('translatable.locales') as $lang)
                                                <div class="tab-pane fade {{ $loop->first ? 'active show' : '' }}"
                                                    id="tab-{{ $lang }}" role="tabpanel"
                                                    aria-labelledby="custom-tabs-one-home-tab">
                                                    <div class="form-group">
                                                        <label>Title</label>
                                                        <input type="text" placeholder="Title"
                                                            name="{{ $lang }}[title]"
                                                            value="{{ old($lang . 'title', isset($model) ? $model->translateOrDefault($lang)->title : '') }}"
                                                            class="form-control">
                                                        @error("$lang.title")
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            @endforeach

                                        </div>
                                    </div>

                                </div>

                                <div class="form-group p-3">
                                    <label>Url</label>
                                    <input type="text" placeholder="Url" name="url"
                                        value="{{ old('url', $model->url ?? '') }}" class="form-control">
                                    @error('url')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
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

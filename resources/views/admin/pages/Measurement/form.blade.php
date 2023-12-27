@extends('admin.layouts.app')
@section('_content')
    <?php $routeName = 'admin.measurement-'; ?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Measurement Create Form</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            {{-- <li class="breadcrumb-item"><a href="{{ route('admin/') }}">{{__("Dashboard")}}</a></li> --}}
              <li class="breadcrumb-item active"><a href="{{ route($routeName.'form') }}">{{ __("Create") }}</a></li>
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
                                <h3 class="card-title">{{ __('Create Blog') }}</h3>
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
                                        <label for="exampleInputEmail1">{{ __('Title') }}</label>
                                        <input type="text" class="form-control @error('title') is-invalid @enderror"
                                            id="exampleInputEmail1" placeholder="Enter title" name="title"
                                            value="{{old("title", isset($model) ? $model->title : '' )}}">
                                        @error('title')
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

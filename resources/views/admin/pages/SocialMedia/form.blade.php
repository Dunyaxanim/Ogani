@extends('admin.layouts.app')
@section('_content')
<?php  $routeName= 'admin.social-media-' ?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Social Media Create Form</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            {{-- <li class="breadcrumb-item"><a href="{{ route('admin/') }}">{{__("Dashboard")}}</a></li> --}}
              <li class="breadcrumb-item active"><a href="{{ route($routeName.'index') }}">{{ __("List data") }}</a></li>
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
                         
                            <form role="form" action="{{ isset($model) ? route($routeName.'update', $model) : route($routeName.'create')}}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @if(isset($model))
                                    @method('put')
                                @endif
                                <div class="card-body">
                                      
                                    <div class="form-group">
                                      <label for="exampleInputEmail1">Link</label>
                                      <input type="text" class="form-control @error('link') is-invalid @enderror"
                                          id="exampleInputEmail1" placeholder="Enter link"
                                          value="{{old("link", isset($model) ? $model->link : '' )}}"
                                          name="link">
                                      @error('link')
                                          <span class="text-danger" style="font-size: 14x">{{ $message }}</span>
                                      @enderror
                                  </div>

                                  <div class="form-group">
                                    <label for="exampleInputEmail1">Icon</label>
                                    <input type="text" class="form-control @error('icon') is-invalid @enderror"
                                        id="exampleInputEmail1" placeholder="Enter icon"
                                        value="{{old("icon", isset($model) ? $model->icon : '' )}}"
                                        name="icon">
                                    @error('icon')
                                        <span class="text-danger" style="font-size: 14x">{{ $message }}</span>
                                    @enderror
                                </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Save</button>
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
@section("_scripts")
 <script>
      document.getElementById('open_time').value = {{$model->open_time}};
</script>
@endsection --}}

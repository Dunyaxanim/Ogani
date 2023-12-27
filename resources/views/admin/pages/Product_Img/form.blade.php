@extends('admin.layouts.app')
@section('_content')
    <?php $routeName = 'admin.product-img-'; ?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{ __('Product images Form') }}</h1>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">{{ __('Create Image') }}</h3>
                            </div>
                            <form role="form"
                                action="{{ isset($model) ? route($routeName . 'update', $model) : route($routeName . 'create') }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                @if (isset($model))
                                    @method('put')
                                @endif
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">{{ __('Image') }}</label>
                                        <input type="hidden" value="{{ $product->id }}" name="product_id">
                                        <input type="file" class="form-control @error('img') is-invalid @enderror"
                                            id="exampleInputEmail1" placeholder="Enter img" name="img">
                                        @error('img')
                                            <span class="text-danger" style="font-size: 14x">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @isset($images)
            <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <div class="card-title">
                                    {{ __('Product Images') }}
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @foreach ($images as $img)
                                        <div class="col-sm-2 m-3">
                                            <div style="height: 200px; width: 200px; overflow: hidden;" >
                                                <img style="object-fit:fill; height: auto; display: block;width: 100%" src="{{ Storage::url($img->img) }}" class="img-fluid mb-2"
                                                    alt="{{ $product->title }}" />
                                            </div>
                                            <form class="delete-form"
                                                action="{{ route('admin.product-img-destroy', $img) }}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button class="btn btn-danger mt-2">{{ __('Delete') }}</button>
                                            </form>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        @endisset
        
    </div>
@endsection

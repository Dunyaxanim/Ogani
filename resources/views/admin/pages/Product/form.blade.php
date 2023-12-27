@extends('admin.layouts.app')
@section('_content')
    <?php $routeName = 'admin.product-'; ?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{ __('Product Form') }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            {{-- <li class="breadcrumb-item"><a href="{{ route('admin.') }}">{{__("Dashboard")}}</a></li> --}}
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
                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">{{ __('Please fill form') }}</h3>
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
                                                        {{ __('Title') }}</label>
                                                    <input type="text"
                                                        class="form-control @error('title') is-invalid @enderror"
                                                        id="exampleInputEmail1" placeholder="Enter title"
                                                        value="{{ old("$lang.title", isset($model) ? $model->translateOrDefault($lang)->title : '') }}"
                                                        name="{{ $lang }}[title]">
                                                    @error("$lang.title")
                                                        <span class="text-danger"
                                                            style="font-size: 14x">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                
                                                <div class=" pad">
                                                    <div class="mb-3">
                                                        <label for="exampleInputEmail1">{{ $lang }}
                                                            {{ __('Description') }}</label>
                                                            <textarea class="textarea" placeholder="Place some text here"
                                                            style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"
                                                            name="{{ $lang }}[description]">
                                                            {{ old("$lang.description", isset($model) ? $model->translateOrDefault($lang)->description : '') }}
                                                           </textarea>
                                                        @error('description')
                                                            <span class="text-danger"
                                                                style="font-size: 14x">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">{{ $lang }}
                                                        {{ __('Slug') }}</label>
                                                    <input type="text"
                                                        class="form-control @error('slug') is-invalid @enderror"
                                                        id="exampleInputEmail1" placeholder="Enter slug"
                                                        value="{{ old("$lang.slug", isset($model) ? $model->translateOrDefault($lang)->slug : '') }}"
                                                        name="{{ $lang }}[slug]">
                                                    @error("$lang.slug")
                                                        <span class="text-danger"
                                                            style="font-size: 14x">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        @endforeach
                                        <div class="row">

                                            <div class="form-group col-3">
                                                <label for="exampleInputEmail1">{{ __('Price') }}</label>
                                                <input type="number"
                                                    class="form-control @error('price') is-invalid @enderror"
                                                    id="exampleInputEmail1" placeholder="Enter price"
                                                    value="{{ old('price', isset($model) ? $model->price : '') }}"
                                                    name="price">
                                                @error('price')
                                                    <span class="text-danger" style="font-size: 14x">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group col-3">
                                                <label for="exampleInputEmail1">{{ __('Discount price') }}</label>
                                                <input type="number"
                                                    class="form-control @error('discount_price') is-invalid @enderror"
                                                    id="exampleInputEmail1" placeholder="Enter price"
                                                    value="{{ old('discount_price', isset($model) ? $model->discount_price : '') }}"
                                                    name="discount_price">
                                                @error('discount_price')
                                                    <span class="text-danger" style="font-size: 14x">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row">

                                            <div class="form-group col-2">
                                                <label for="exampleFormControlSelect1">{{ __('Category') }}</label>
                                                <select class="form-control" id="exampleFormControlSelect1"
                                                    name="category_id">
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}"
                                                            @isset($model) @if ($category->id == $model->category_id) selected @endif @endisset>
                                                            {{ $category->title }}</option>
                                                    @endforeach
                                                </select>
                                                @error('category_id')
                                                    <span class="text-danger" style="font-size: 14x">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group col-2">
                                                <label for="exampleInputEmail1">{{ __('Weight') }}</label>
                                                <input type="number"
                                                    class="form-control @error('weight') is-invalid @enderror"
                                                    id="exampleInputEmail1" placeholder="Enter weight"
                                                    value="{{ old('weight', isset($model) ? $model->weight : '') }}"
                                                    name="weight">
                                                @error('weight')
                                                    <span class="text-danger"
                                                        style="font-size: 14x">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group col-1">
                                                <label for="exampleFormControlSelect1">{{ __('Quantity') }}</label>
                                                <select class="form-control" id="exampleFormControlSelect1"
                                                    name="measurement">
                                                    @foreach ($measurements as $measurement)
                                                        <option value="{{ $measurement->id }}"
                                                            @isset($model) @if ($measurement->id == $model->measurement_id) selected @endif @endisset>
                                                            {{ $measurement->title }}</option>
                                                    @endforeach
                                                </select>
                                                @error('measurement_id')
                                                    <span class="text-danger"
                                                        style="font-size: 14x">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group col-1">
                                                <label for="exampleFormControlSelect1">{{ __('Status') }}</label>
                                                <select class="form-control" id="exampleFormControlSelect1"
                                                    name="status">
                                                    @foreach ($enums as $enum)
                                                        <option value="{{ $enum->value }}"
                                                            @isset($model) @if ($enum->value == $model->status) selected @endif @endisset>
                                                            {{ $enum->value == 1 ? 'true' : 'false' }}</option>
                                                    @endforeach
                                                </select>
                                                @error('status')
                                                    <span class="text-danger"
                                                        style="font-size: 14x">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group col-1">
                                                <label for="exampleFormControlSelect1">{{ __('Stock') }}</label>
                                                <select class="form-control" id="exampleFormControlSelect1"
                                                    name="stock">
                                                    @foreach ($stockEnums as $stock)
                                                        <option value="{{ $stock->value }}"
                                                            @isset($model) @if ($stock->value == $model->stock) selected @endif @endisset>
                                                            {{ $stock->value == 1 ? 'true' : 'false' }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('stock')
                                                    <span class="text-danger"
                                                        style="font-size: 14x">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group col-3">
                                                <label for="exampleInputEmail1">{{ __('Img') }}</label>
                                                <input type="file"
                                                    class="form-control @error('img') is-invalid @enderror"
                                                    id="exampleInputEmail1" placeholder="Enter img" name="img">
                                                @error('img')
                                                    <span class="text-danger"
                                                        style="font-size: 14x">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                                    </div>
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

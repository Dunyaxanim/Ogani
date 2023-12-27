@extends('admin.layouts.app')
@section('_content')
    <?php $routeName = 'admin.blog-'; ?>
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{ 'Blog Table' }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            {{-- <li class="breadcrumb-item"><a href="{{ route('') }}">Dashboard</a></li> --}}
                            <li class="breadcrumb-item active"><a
                                    href="{{ route($routeName . 'create-form') }}">{{ __('Create new') }}</a>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <section class="">
            <div class="">

                <div class="col-12">

                    <div class="card">
                        @if (\Session::has('message'))
                            <div class="alert alert-success deleted-message col-3 position-absolute">
                                <ul class="list-unstyled">
                                    <li>{!! \Session::get('message') !!}</li>
                                </ul>
                            </div>
                        @endif
                        <div class="d-flex align-items-center justify-content-between px-5 pt-3">
                            <h3 class="card-title mr-auto">{{ __('All data list') }}</h3>
                            <a type="button" class="btn btn-primary p-2 mr-2"
                                href="{{ route($routeName . 'create-form') }}">{{ __('Create') }}</a>
                        </div>
                        <div class="card-body">

                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>{{ __('product_id') }}</th>
                                        <th>{{ __('qty') }}</th>
                                        <th>{{ __('price') }}</th>
                                        <th>{{ __('sub_total') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($model as $key => $data)
                                        <tr>
                                            <td>{{ $data->product_id }}</td>
                                            <td>{{ $data->qty }}</td>
                                            <td>{{ $data->price }}</td>
                                            <td>{{ $data->sub_total }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-center">
                            {{-- {{ $blogs->links() }} --}}
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
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
    <script>
        const blogs = document.querySelectorAll('.selected-blog')
        console.log(blogs);
        blogs.forEach(blog => {
            blog.addEventListener('click', function() {
                if (blog.checked) {
                    console.log('Checkbox işaretlendi');
                }
            });
        });
    </script>
@endsection

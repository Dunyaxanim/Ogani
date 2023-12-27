@extends('admin.layouts.app')
@section('_content')
    <?php $routeName = 'admin.order-'; ?>
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{ 'Blog Table' }}</h1>
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
                        <div class="card-body">

                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>{{ __('total') }}</th>
                                        <th>{{ __('Email') }}</th>
                                        <th>{{ __('Phone') }}</th>
                                        <th>{{ __('address') }}</th>
                                        <th>{{ __('status') }}</th>
                                        <th>{{ __('created_at') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($model as $key => $data)
                                        <tr>
                                            <td>{{ $data->total }}</td>
                                            <td>{{ $data->user->email }}</td>
                                            <td>{{ $data->phone }}</td>
                                            <td>{{ $data->address }}</td>
                                           
                                            @if($data->status==1)
                                                <td style="color: green">{{ __("Activ") }}</td>
                                            @else
                                            <td style="color: red">{{ __("Deactive") }}</td>
                                            @endif 
                                            <td>{{ $data->created_at }}</td>
                                            <td class="project-actions text-right">
                                                <a class="btn btn-primary btn-sm "
                                                    href="{{ route('admin.order-item-index', $data) }}">
                                                    <i class="fas fa-folder pr-1"></i>
                                                    {{ __('View') }}
                                                </a>
                                                {{-- <button class="btn btn-danger btn-sm " data-toggle="modal"
                                                  data-target="#exampleModalCenter{{ $data->id }}">
                                                    <i class="fas fa-trash pr-1"></i>
                                                    {{ __('Delete') }}
                                                </button>
                                                <div class="modal fade" id="exampleModalCenter{{ $data->id }}" tabindex="-1"
                                                    role="dialog" aria-labelledby="exampleModalCenterTitle"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLongTitle">
                                                                    {{ __('Delete data') }}</h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                {{ __('Are you sure to delete?') }}
                                                            </div>
                                                            <div class="modal-footer">
                                                                <a type="button" class="btn btn-info text-white"
                                                                    data-dismiss="modal">{{ __('Close') }}</a>
                                                                <form class="delete-form"
                                                                    action="{{ route($routeName . 'destroy', $data) }}"
                                                                    method="POST">
                                                                    @method('DELETE')
                                                                    @csrf
                                                                    <button
                                                                        class="btn btn-danger">{{ __('Delete') }}</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> --}}
                                            </td>
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

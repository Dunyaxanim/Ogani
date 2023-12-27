@extends("admin.layouts.app")
@section('_content')
<?php $routeName='admin.user-' ?>
    <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>User Table</h1>
          </div>
          <div class="col-sm-6">
             <ol class="breadcrumb float-sm-right">
              {{-- <li class="breadcrumb-item"><a href="{{ route('') }}">Dashboard</a></li> --}}
              <li class="breadcrumb-item active"><a href="{{ route($routeName.'create-form') }}">Create new</a></li>
            </ol>
          </div>
        </div>
      </div>
    </section>
    <section class="">
      <div class="">
        <div class="col-12">
          <div class="card">
            <div class="d-flex align-items-center justify-content-between px-5 pt-3">
              <h3 class="card-title mr-auto">Product data</h3>
              @if($model->toArray()==null)
               <a type="button" class="btn btn-primary p-2 mr-2"  href="{{route('admin.general-create-form')}}">{{__("Create")}}</a>
              @endif
            </div>
            @if (\Session::has('message'))
              <div class="alert alert-success deleted-message fade-out">
                  <ul class="list-unstyled">
                      <li>{!! \Session::get('message') !!}</li>
                  </ul>
              </div>
            @endif
            <div class="card-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>{{ __("Image") }}</th>
                  <th>{{ __("Name") }}</th>
                  <th>{{ __("Last name") }}</th>
                  <th>{{ __("Type") }}</th>
                  <th>{{ __("Email") }}</th>
                  <th>{{ __("Phone") }}</th>
                  <th>{{ __("Actions") }}</th>
                  {{-- <th>{{ __("Password") }}</th> --}}
                </tr>
                </thead>
                <tbody>
                  @foreach($model as $key => $data)
                    <tr>
                      <td><img style="height: 70px; width:70px; margin:auto;" src="{{Storage::url($data->logo_img)}}" alt=""></td>
                      <td>{{$data->name}}</td>
                      <td>{{$data->last_name}}</td>
                      <td>{{$data->type}}</td>
                      <td>{{$data->email}}</td>
                      <td>{{$data->phone}}</td>
                      {{-- <td>{{$data->password}}</td> --}}
                      <td class="project-actions text-right">
                          <a class="btn btn-primary btn-sm mb-2" href="{{ route($routeName.'show', $data) }}">
                              <i class="fas fa-folder">
                              </i>
                              {{ __("View") }}
                          </a>
                           <form class="delete-form" action="{{ route($routeName.'destroy', $data) }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button  class="btn btn-danger btn-sm"><i class="fas fa-trash"></i>{{ __("Delete") }}</button>
                          </form>
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
  @section("_scripts")
  <script>
    const message = document.querySelector('.deleted-message')
    if(message){
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
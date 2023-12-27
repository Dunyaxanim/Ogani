@extends("admin.layouts.app")
@section('_content')
<?php $routeName='admin.map-' ?>
    <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{ ("Map Table") }}</h1>
          </div>
          <div class="col-sm-6">
             <ol class="breadcrumb float-sm-right">
              {{-- <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{__("Dashboard")}}</a></li> --}}
              <li class="breadcrumb-item active"><a href="{{ route($routeName.'create-form') }}">{{ __("List data") }}</a></li>
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
              <h3 class="card-title mr-auto">{{ __("All data list") }}</h3>
                @if($model->toArray()==null)
               <a type="button" class="btn btn-primary p-2 mr-2"  href="{{route($routeName.'create-form')}}">{{__("Create")}}</a>
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
                 <th>{{ ("Country") }}</th>
                 <th>{{ ("Address") }}</th>
                 <th>{{ ("Phone") }}</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($model as $key => $data)
                    <tr>
                     <td>{{$data->country}}</td>
                     <td>{{$data->address}}</td>
                     <td>{{$data->phone}}</td>
                      <td class="project-actions text-right">
                          <a class="btn btn-primary btn-sm " href="{{ route($routeName.'show', $data) }}">
                              <i class="fas fa-folder pr-1"></i>
                              {{ __("View") }}
                          </a>
                          <button class="btn btn-danger btn-sm " data-toggle="modal" data-target="#exampleModalCenter{{ $data->id }}">
                            <i class="fas fa-trash pr-1"></i>
                            {{__("Delete")}}
                          </button>
                          <div class="modal fade" id="exampleModalCenter{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLongTitle">{{__("Delete data")}}</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  {{__("Are you sure to delete?")}}
                                </div>
                                <div class="modal-footer">
                                  <a type="button" class="btn btn-info text-white" data-dismiss="modal">{{__("Close")}}</a>
                                   <form class="delete-form" action="{{ route($routeName.'destroy', $data) }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button class="btn btn-danger">{{__("Delete")}}</button>
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>
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
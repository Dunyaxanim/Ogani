@extends('admin.layouts.app')
@section('_content')
  <div class="content-wrapper">
    <section class="content">
      <div class="row">
        <div class="col-md-9">
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title">Inbox</h3>

              <div class="card-tools">
                <div class="input-group input-group-sm">
                  <input type="text" class="form-control" placeholder="Search Mail">
                  <div class="input-group-append">
                    <div class="btn btn-primary">
                      <i class="fas fa-search"></i>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
              <div class="mailbox-controls">
                <!-- Check all button -->
                </button>
                <div class="btn-group">
                  <button type="button" class="btn btn-default btn-sm"><i class="far fa-trash-alt"></i></button>
                </div>
                <!-- /.btn-group -->
              </div>
              @foreach($messages as $message)
                <div class="table-responsive mailbox-messages">
                <table class="table table-hover table-striped">
                  <tbody>
                  <tr>
                    <td class="mailbox-name"><a href="read-mail.html">{{ $message->name }}</a></td>
                    <td class="mailbox-subject"><b>{{ $message->email }}</b>{{ $message->message }}</td>
                    <td class="mailbox-attachment"></td>
                    <td class="mailbox-date">{{ $message->getTimeAgoAttribute() }}</td>
                  </tr>
                  </tbody>
                </table>
                <!-- /.table -->
              </div>
              @endforeach
              
              <!-- /.mail-box-messages -->
            </div>
            <!-- /.card-body -->
            <div class="card-footer p-0">
               <div class="btn-group">
                  <button type="button" class="btn btn-default btn-sm"><i class="far fa-trash-alt"></i></button>
                </div>
            </div>
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
    @endsection
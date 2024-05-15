@extends('admin.layouts.layout')
@section('content')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Change Password</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Change Password</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-default">
        <!--   <div class="card-header">
            <h3 class="card-title">Select2 (Default Theme)</h3>

          
          </div> -->
          <!-- /.card-header -->
            @if(Session::has('success_message'))
        <div class="alert alert-success alert-dismissable">
          <i class="fa fa-check"></i>
          <button aria-hidden="true" data-dismiss="alert" class="close" type="button">x</button>
          {{Session::get('success_message')}}
        </div>
      @endif
      @if(Session::has('error_message'))
        <div class="alert alert-danger alert-dismissable">
          <i class="fa fa-check"></i>
          <button aria-hidden="true" data-dismiss="alert" class="close" type="button">x</button>
          {{Session::get('error_message')}}
        </div>
      @endif

          <div class="card-body">
            <form method="POST" action="{{ url('/admin/change_password') }}">
                      {!! csrf_field() !!}

            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Old Password</label>
                <input type="password" class="form-control" name="old_password">
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                  <label>New Password</label>
                  <input type="password" class="form-control" name="password">
                   @if($errors->has('password'))
                           <div class="text-danger">{{ $errors->first('password') }}</div>
                        @endif

                </div>
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
              <div class="col-md-12">
                <div class="form-group">
                  <label>Confirm New Password</label>
                 <input type="password" class="form-control" name="cpassword">
                </div>
                <!-- /.form-group -->
               
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->

         
            <!-- /.row -->
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            <input type="submit" class="btn btn-primary" value="Submit" id="">
          </div>
          </form>
        </div>
        <!-- /.card -->

        <!-- SELECT2 EXAMPLE -->
       
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  @endsection
  
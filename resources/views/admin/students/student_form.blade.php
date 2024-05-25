@extends('admin.layouts.layout')

@section('content')

<div class="wrapper">


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add Students</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Add Students</li>
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
            <h3 class="card-title">Add Student</h3>
          </div> -->
          <!-- /.card-header -->
          <div class="card-body">
            <form action="{{ url('/admin/student_action') }}" id="student_form" method="post" enctype="multipart/form-data">
                      {!! csrf_field() !!}
                       <input type="hidden" class="form-control" name="id" value="{{$id}}">

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Name</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                    </div>
                    <input type="text" class="form-control" name="name" required="required" 
                    value="@if($id>0){{trim($student_detail[0]->name)}}@endif" >
                  </div>
                  <!-- /.input group -->
                </div>
              </div>
                <!-- /.form-group -->
           
                <!-- /.form-group -->
                              <div class="col-md-6">

               <div class="form-group">
                  <label>Email</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                    </div>
                    <input type="text" class="form-control" name="email" required="required"
                    value="@if($id>0){{trim($student_detail[0]->email)}}@endif">
                    <br>
                      @if($errors->has("email"))

                      <span class="text-danger">{{ $errors->first("email") }}</span>

                      @endif
                  </div>
                  <!-- /.input group -->
                </div>
              </div>
              <div class="col-md-6">

               <div class="form-group">
                  <label>Password</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                    </div>
                    <input type="password" class="form-control" name="password"
                    value="">
                    <br>
                      @if($errors->has("password"))

                      <span class="text-danger">{{ $errors->first("password") }}</span>

                      @endif
                  </div>
                  <!-- /.input group -->
                </div>
              </div>
              <div class="col-md-6">

               <div class="form-group">
                  <label>Confirm Password</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                    </div>
                    <input type="password" class="form-control" name="password"
                    value="">
                    <br>
                      @if($errors->has("confirm_pasword"))

                      <span class="text-danger">{{ $errors->first("confirm_pasword") }}</span>

                      @endif
                  </div>
                  <!-- /.input group -->
                </div>
              </div>
                            <div class="col-md-6">

                 <div class="form-group">
                  <label>Profile Image</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                    </div>
                    <input type="file" class="form-control" name="profile_img"
                    >
                     <?php if(!empty($student_detail[0]->profile_img)){?>
                     <img class="img-responsive" src="{{ url('/public') }}/uploads/{{$student_detail[0]->profile_img}}" width="50px;" alt="profile_img">
                     <?php } ?>

                    <br>
                    
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
              <div class="col-md-6">
                <div class="form-group">
                  <label>Courses<span class="mandatory" style="color:red"> *</span></label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                    </div>
                    
                    <select class="form-select form-control" name="course_id" multiple="">
                      <option value="">Select Courses</option>
                      @foreach($course_list as $c_list)
                        @if($c_list->deleted_at == NULL)

                        <option value="{{ $c_list->course_id }}" @if($id>0) @if($c_list->course_id == $student_detail[0]->course_id) selected @endif @endif>{{ $c_list->title }}</option>
                        @endif
                      @endforeach
                    </select>  
                  </div>  
                </div>
              </div>
              <!-- /.col -->
              
              <!-- /.col -->
            </div>
            <!-- /.row -->

       
              
          </div>
           <div class="card-footer">
            <input type="submit" class="btn btn-primary" value="Submit" id="">
            <input type="button"   class="btn btn-primary" value="Go Back" onClick="history.go(-1);"  />
          </div>
        </form>

            <!-- /.row -->
          </div>


        
          <!-- /.card-body -->
         
        </div>
        <!-- /.card -->

    

    
       
       
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
@endsection



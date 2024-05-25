@extends('admin.layouts.layout')

@section('current_page_css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
<style type="text/css">
  #toast-container > div{
    width:311px;
  }
</style>
@endsection

@section('js_bottom')
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
<script type="text/javascript">
  $(".remove_courses").click(function(){
    var customer_id = $(".student_id").val();
    $.ajax({
      type: "POST",
      url: "{{ url('admin/remove_courses') }}",
      data: {customer_id:customer_id,"_token": "{{ csrf_token() }}"},
      cache: false,
      success: function(data){
         if(data == 1){
          toastr.options.timeOut = 1500; // 1.5s
          toastr.success('The student has been removed from the courses');
          $(".remove_courses").hide();
          
         }
         
      }
    });
  });
</script>
@endsection

@section('content')

<div class="wrapper">


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Student View</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Student View</li>
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
            <form action="{{ url('/admin/student_action') }}" id="student_form" method="post">
                      {!! csrf_field() !!}
                       <input type="hidden" class="form-control student_id" name="id" value="{{$id}}">

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>First Name</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                    </div>
                    <input type="text" class="form-control" name="fname" required="required" 
                    value="@if($id>0){{trim($student_detail[0]->name)}}@endif" disabled>
                  </div>
                  <!-- /.input group -->
                </div>
              </div>
                <!-- /.form-group -->
           
              <!-- /.col -->
              <div class="col-md-6">
                <div class="form-group">
                  <label>Last Name</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                    </div>
                    <input type="text" class="form-control" name="lname" required="required"
                    value="@if($id>0){{trim($student_detail[0]->last_name)}}@endif" disabled>
                  </div>
                  <!-- /.input group -->
                </div>
              </div>
                <!-- /.form-group -->
                              <div class="col-md-6">

               <div class="form-group">
                  <label>Email</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                    </div>
                    <input type="text" class="form-control" name="email" required="required"
                    value="@if($id>0){{trim($student_detail[0]->email)}}@endif" disabled>
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
                  <label>Profile Image</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                    </div>
                     <?php if(!empty($student_detail[0]->profile_img)){?>
                     <img class="img-responsive" src="{{ url('/public') }}/assets/img/{{$student_detail[0]->profile_img}}" width="50px;" alt="profile_img">
                     <?php }else{?>
                      <img class="img-responsive" src="{{ url('/public') }}/assets/img/student_default.png" width="50px;" alt="profile_img">
                     <?php }?>

                    <br>
                    
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
              
            </div>
            <!-- /.row -->

       
              <div class="row">
             
              <!-- /.col -->
              <div class="col-md-6">
               <!--  <div class="form-group">
                  <label>Password</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                    </div>
                    <input type="password" class="form-control" name="password"  required="required">
                       @if($errors->has('password'))
                           <div class="text-danger">{{ $errors->first('password') }}</div>
                        @endif
                  </div> -->
                  <!-- /.input group -->
                <!-- </div> -->
             
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
          
          
        </form>
         <div class="card-footer">
            @if($student_detail[0]->course_id != NULL)
            <input type="button"   class="btn btn-primary remove_courses" value="Remove from courses"  />
            @endif
          </div>
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



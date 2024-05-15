@extends('admin.layouts.layout')
@section('content')
<div class="wrapper">
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Course Form</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Course Form</li>
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
          <div class="card-header">
            <h3 class="card-title">Add Course</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <form action="{{ url('/admin/course_action') }}" id="course_form" method="post" enctype="multipart/form-data">
                      {!! csrf_field() !!}
             <input type="hidden" class="form-control" name="id" value="{{$id}}">


            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Title<span class="mandatory" style="color:red"> *</span></label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                    </div>
                    <input type="text" class="form-control" name="title"   value="@if($id>0){{trim($course_detail[0]->title)}}@endif">
                     @if ($errors->has('title'))
                      <span class="" style="color:red">
                        {{ $errors->first('title') }}
                      </span>
                @endif
                  </div>
                  <!-- /.input group -->
                </div>
              </div>
              <div class="col-md-6">
                <label>Subscription Type<span class="mandatory" style="color:red"> *</span></label>
                <select class="form-control" name="subscription_type" id="subscription_type">
                      <option value="Free">Free</option>
                      
                      <option value="Paid">Paid</option>
                      
                      
                    </select>
                
              </div>
                <div class="col-md-6">
                <div class="form-group">
                  <label>Image<span class="mandatory" style="color:red"> *</span></label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                    </div>
                    <input type="file" class="form-control" name="course_img" >
                     <div class="input-group">
                      <br>
                    <div class="input-group-prepend">
                    </div>
                    

                     <?php 

                     if($id>0){


                     if(!empty($course_detail[0]->course_img)){?>
                     <img class="img-responsive" src="{{ url('/public/uploads/courses') }}/{{$course_detail[0]->course_img}}" width="100px;" alt="course_img">
                     <?php }else{?>
                      <img class="img-responsive" src="{{ url('/public') }}/assets/img/student_default.png" width="50px;" alt="profile_img">
                     <?php }}?>

                    <br>
                    
                  </div>
                  </div>
                  <!-- /.input group -->
                </div>
              </div>
            </div>

              <div class="row">
        <div class="col-md-12">
          <div class="card card-outline card-info">
            <div class="card-header">
              <h3 class="card-title">
                Description
              </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body" >
              <textarea id="summernote"  style="height: 300px;" name="description">
                
                <?php if($id>0){
                 echo  trim($course_detail[0]->description);
               } ?>
              </textarea>
            </div>
          
          </div>
        </div>
        <!-- /.col-->
      </div>

        
         
            <!-- /.row -->
          </div>
           <div class="card-footer">
            <input type="submit" class="btn btn-primary" value="Submit" id="">
              <input type="button"   class="btn btn-primary" value="Go Back" onClick="history.go(-1);"  />
          </div>


        </form>

      </div>
        </div>
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>

@endsection

@section('js_bottom')

 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
<script>
  $(function () {
    // Summernote
    $('#summernote').summernote()

    // CodeMirror
    CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
      mode: "htmlmixed",
      theme: "monokai"
    });
  })
</script>
<script>
window.addEventListener('load', function() {
    $("#course_form").validate({
        rules: {
            title: {
                required: true,
            },
            course_img: {
                required: true,
            },
            description: {
                required: true,
            }
        },
        messages: {
            title: {
                required: "Title is required",
            },
            
            course_img: {
                required: "Course Image is required",
            },
          
            description: {
                required: "Description is required",
            },
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        }
    });
});
</script>
@stop























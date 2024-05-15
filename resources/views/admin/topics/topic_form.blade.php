@extends('admin.layouts.layout')
@section('content')
<div class="wrapper">
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Topic Form</h1>
          </div>
         <!--  <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Course Form</li>
            </ol>
          </div> -->
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">Add Topic</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <form action="{{ url('/admin/topic_action') }}" id="topic_form" method="post" enctype="multipart/form-data">
                      {!! csrf_field() !!}
             <input type="hidden" class="form-control" name="id" value="{{$id}}">


            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Title<span class="mandatory" style="color:red"> *</span></label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                    </div>
                    <input type="text" class="form-control" name="title"   value="@if($id>0){{trim($topic_detail[0]->title)}}@endif">
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
                <div class="form-group">
                  <label>Courses<span class="mandatory" style="color:red"> *</span></label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                    </div>
                    <select class="form-select form-control" name="course_id">
                      <option value="">Select Course</option>
                      <?php if($id>0){
                     
                       foreach($course_list as $course){?>
                      <option value="{{ $course->course_id }}" @if($course->course_id == $topic_detail[0]->course_id) selected @endif>
                        {{ $course->title }}
                      </option>


                     <?php } }else{
                        foreach($course_list as $course){?>
                      <option value="{{ $course->course_id }}">
                        {{ $course->title }}
                      </option>

                    <?php   } }
                      ?>

                     
                    </select>
                  </div>
                  <!-- /.input group -->
                </div>
              </div>
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
    $("#topic_form").validate({
        rules: {
            title: {
                required: true,
            },
            course_id: {
                required: true,
            },
            
        },
        messages: {
            title: {
                required: "Title is required",
            },
            
            course_id: {
                required: "Course is required",
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























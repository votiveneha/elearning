@extends('admin.layouts.layout')
@section('content')
<div class="wrapper">
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Theory Form</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Theory Form</li>
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
            <h3 class="card-title">Add Theory</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <form action="{{ url('/admin/theory_action') }}" id="theory_form" method="post" enctype="multipart/form-data">
                      {!! csrf_field() !!}
             <input type="hidden" class="form-control" name="id" value="{{$id}}">


            <div class="row">
              <!-- <div class="col-md-4">
                <div class="form-group">
                  <label>Title<span class="mandatory" style="color:red"> *</span></label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                    </div>
                    <input type="text" class="form-control" name="title"  >
                     @if ($errors->has('title'))
                      <span class="" style="color:red">
                        {{ $errors->first('title') }}
                      </span>
                @endif
                  </div>
                  
                </div>
              </div> -->
              <div class="col-md-6">
                <div class="form-group">
                  <label>Courses<span class="mandatory" style="color:red"> *</span></label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                    </div>
                    <select class="form-select form-control" id="course-dropdown" name="course_id">
                      <option value="">Select Course</option>
                      <?php if($id>0){
                     
                       foreach($course_list as $course){?>
                      <option value="{{ $course->course_id }}" @if($course->course_id == $subtopic_detail[0]->course_id) selected @endif>
                        {{ $course->title }}
                      </option>


                     <?php } }else{
                        foreach($course_list as $course){?>
                      <option value="{{ $course->course_id }}">
                        {{ $course->title }}
                      </option>

                    <?php   } }
                      ?></select>
                  </div>
                  <!-- /.input group -->
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Topics<span class="mandatory" style="color:red"> *</span></label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                    </div>
                     <select class="form-select form-control" id="topic-dropdown" name="topic_id">
                      <option value="">Select Topics</option>
                   
                   
                    </select>
                  </div>
                  <!-- /.input group -->
                </div>
              </div>


        
         
            <!-- /.row -->
          </div>

            <div class="row">


              <div class="col-md-6">
                <div class="form-group">
                  <label>Chapter<span class="mandatory" style="color:red"> *</span></label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                    </div>
                    <select class="form-select form-control" id="chapter-dropdown" name="st_id">
                      <option value="">Select Chapter</option>


                    </select>
                  </div>
                  <!-- /.input group -->
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Upload Pdf<span class="mandatory" style="color:red"> *</span></label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                    </div>
                <input type="file" class="form-control" name="theory_pdf" >
                  @if ($errors->has('theory_pdf'))
                <span class="help-block" style="color:red">
                  {{ $errors->first('theory_pdf') }}
                </span>
                @endif
                  </div>
                  <!-- /.input group -->
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
        $(document).ready(function () {
          $('#course-dropdown').on('change', function () {
                var course_id = this.value;
                $("#topic-dropdown").html('');
                $.ajax({
                    url: "{{url('/admin/fetch-topics')}}",
                    type: "POST",
                    data: {
                        country_id: course_id,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (result) {
                        $('#topic-dropdown').html('<option value="">-- Select Topic --</option>');
                        $.each(result.topics, function (key, value) {
                            $("#topic-dropdown").append('<option value="' + value
                                .topic_id + '">' + value.title + '</option>');
                        });
                 
                    }
                });
            });
          });
    </script>

      <script>
        $(document).ready(function () {
          $('#topic-dropdown').on('change', function () {
                var topic_id = this.value;
                $("#chapter-dropdown").html('');
                $.ajax({
                    url: "{{url('/admin/fetch-chapters')}}",
                    type: "POST",
                    data: {
                        topic_id: topic_id,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (result) {
                        $('#chapter-dropdown').html('<option value="">-- Select Chapter --</option>');
                        $.each(result.chapters, function (key, value) {
                            $("#chapter-dropdown").append('<option value="' + value
                                .st_id + '">' + value.title + '</option>');
                        });
                        
                    }
                });
            });
          });
    </script>




 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>

<script>
window.addEventListener('load', function() {
    $("#theory_form").validate({

        rules: {

           title: {
                required: true,
            },
            course_id: {
                required: true,
            },
            topic_id: {
                required: true,
            },

              st_id: {
                required: true,
            },

            theory_pdf: {
                required: true,
            },
         
         
        },
        messages: {

            title: {
                required: "title is required",
            },
           
            course_id: {
                required: "Course is required",
            },
             topic_id: {
                required: "Topic is required",
            },
            st_id: {
                required: "Chapter is required",
            },
             theory_pdf: {
                required: "Pdf is required",
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























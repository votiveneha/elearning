@extends('admin.layouts.layout')
@section('content')
<div class="wrapper">
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit email management</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Email management</li>
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
            <h3 class="card-title">Edit email management</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            @if (\Session::has('success'))
              <div class="alert alert-success">
                  {!! \Session::get('success') !!}
              </div>
          @endif
            <form action="{{ url('/admin/email_management_action') }}" method="post">
                      {!! csrf_field() !!}
             <input type="hidden" class="form-control" name="id" value="{{$email_management->email_management_id}}">


            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Email Confirmation Page<span class="mandatory" style="color:red"> *</span></label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                    </div>
                    <textarea id="summernote" class="form-control" name="email_confirmation_page" style="height:500px;">{{ $email_management->email_confirmation_page }}</textarea>
                
                  </div>
                  <!-- /.input group -->
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Email Confirmation Message<span class="mandatory" style="color:red"> *</span></label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                    </div>
                    <textarea id="summernote1" class="form-control" name="email_confirmation_mail" style="height:500px;">{{ $email_management->email_confirmation_mail }}</textarea>
                
                  </div>
                  <!-- /.input group -->
                </div>
              </div>
                
            </div>


        
         
            <!-- /.row -->
          </div>
           <div class="card-footer">
            <input type="submit" class="btn btn-primary" value="Submit" id="">
              <!-- <input type="button"   class="btn btn-primary" value="Go Back" onClick="history.go(-1);"  /> -->
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
    $('#summernote').summernote();
    $('#summernote1').summernote();

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

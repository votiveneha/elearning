@extends('admin.layouts.layout')

@section('current_page_js')
<script type="text/javascript">
	function addOptions(){
		$(".options_group").append('<input type="text" class="form-control" name="options[]" style="width:90%">');
	}
</script>
@endsection

@section('content')
<div class="wrapper">


  <!-- Main Sidebar Container -->


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Question Form</h1>
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
            <h3 class="card-title">Add Questions</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <form action="{{ url('/admin/post_questions') }}" id="question_form" method="post">
                      {!! csrf_field() !!}
                       

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Select Course</label>
                  <div class="input-group">
                  	<?php
                  		$course = DB::table("courses")->get();
                  	?>
                    <select class="form-control" name="difficulty_level">
                    	<option value="">Select Course</option>
                    	@foreach($course as $cors)
                    	<option value="{{ $cors->course_id }}">{{ $cors->title }}</option>
                    	@endforeach
                    	
                    </select>
                    
                  </div>
                  <!-- /.input group -->
                </div>
              </div>	
              <div class="col-md-6">
                <div class="form-group">
                  <label>Questions</label>
                  <div class="input-group">
                    
                    <input type="text" class="form-control" name="questions1" >
                  </div>
                  <!-- /.input group -->
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Options</label>
                  <div class="input-group options_group">
                   
                    	<input type="text" class="form-control" name="options[]" style="width:90%"><button type="button" onclick="addOptions()"><i class="fa fa-plus"></i></button>
                    
                    
                    
                  </div>

                  <!-- /.input group -->
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Correct Answer</label>
                  <div class="input-group">
                    
                    <input type="text" class="form-control" name="correct_answer" >
                  </div>
                  <!-- /.input group -->
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Marks</label>
                  <div class="input-group">
                    
                    <input type="text" class="form-control" name="marks" >
                  </div>
                  <!-- /.input group -->
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Time</label>
                  <div class="input-group">
                    
                    <input type="text" class="form-control" name="time" >
                  </div>
                  <!-- /.input group -->
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Difficulty Level</label>
                  <div class="input-group">
                    <select class="form-control" name="difficulty_level">
                    	<option value="">Select Level</option>
                    	<option value="1">Easy</option>
                    	<option value="2">Hard</option>
                    	<option value="3">Medium</option>
                    </select>
                    
                  </div>
                  <!-- /.input group -->
                </div>
              </div>
            </div>
            <!-- /.row -->

              

        
         
            <!-- /.row -->
          </div>
           <div class="card-footer">
            <input type="submit" class="btn btn-primary" value="Submit" id="">
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
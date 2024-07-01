@extends('admin.layouts.layout')
@section('title', 'Student List')
@section("other_css")

<!-- DATA TABLES -->

<link href="{{ url('/') }}/design/admin/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<meta name="_token" content="{!! csrf_token() !!}" />

@stop
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Student History List</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Student History List</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
          

            <div class="card table-responsive">
              <div class="card-header">
                <h3 class="card-title">Student History List</h3>
                
              </div>

              <!-- /.card-header -->
              <div class="card-body table-responsive">
                 @if(Session::has('message'))
                 <div class="alert alert-success alert-dismissable">
                  <i class="fa fa-check"></i>
                  <button aria-hidden="true" data-dismiss="alert" class="close" type="button">x</button>
                {{Session::get('message')}}</div>

                    @endif
                     @if(Session::has('error'))
        <div class="alert alert-danger alert-dismissable">
          <i class="fa fa-check"></i>
          <button aria-hidden="true" data-dismiss="alert" class="close" type="button">x</button>
          {{Session::get('error')}}
        </div>
      @endif
                <table id="student_list" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Test Type</th>
                    <th>Course Name</th>
                    <th>Topic Name</th>
                    <th>Chapter Name</th>
                    <th>Total Questions</th>
                    <th>Attempted Questions</th>
                    <th>Correct Answers</th>
                    <th>Test Status</th>
                    
                  </tr>
                  </thead>
                  <tbody>
                  <?php $i=1; ?>
                  @foreach ($session_history as $session_his)
                  <?php
      
      
                  if($session_his->quiz_type == "exam_builder"){
                      


                      $exam_builder = DB::table("exam_builder")->where("reference_id",$session_his->reference_id)->first();

                      $total_question = $exam_builder->total_questions;

                      $exam_builder_topics = $exam_builder->topics_id;
                      $topic_ids = explode(",",$exam_builder_topics);
                      $topics_array = array();
                      $question_array = array();
                      $question_count_sum = 0;
                      foreach ($topic_ids as $t_ids) {
                        $topic = DB::table("topics")->where("topic_id",$t_ids)->first();
                        $topics_array[] = $topic->title;
                        $question = DB::table("question_bank")->where("topic_id",$t_ids)->groupBy("q_id")->get();
                        
                      }

                      $topics_title = implode(",",$topics_array);
                      $quiz_type = "Exam Builder";


                      $attempted_question = DB::table("question_analysis")->where("student_id",$student_id)->where("student_answer","!=",NULL)->where("reference_id",$session_his->reference_id)->groupBy('question_id')->get();

                      $date=date_create($session_his->created_at);
                      
                      //echo $session_his->created_at;
                      if($total_question != NULL){
                        $session_progress = count($attempted_question)/$total_question*100;
                      }else{
                        $session_progress = 0;
                      }
                      
                      $course = DB::table("courses")->where("course_id",$session_his->course_id)->first();

                      $topic = DB::table("topics")->where("topic_id",$session_his->topic_id)->first();
                      

                      
                    }else{
                      $topic = DB::table("topics")->where("topic_id",$session_his->topic_id)->first();
                      $topics_title = $topic->title;
                      $quiz_type = "Quiz";
                      $total_question_quiz = DB::table("question_bank")->where("chapter_id",$session_his->chapter_id)->groupBy('q_id')->get();

                      $total_question = count($total_question_quiz);

                    $attempted_question = DB::table("question_analysis")->where("student_id",$student_id)->where("student_answer","!=",NULL)->where("reference_id",$session_his->reference_id)->groupBy('question_id')->get();

                    $date=date_create($session_his->created_at);
                    
                    //echo $session_his->created_at;

                    $session_progress = count($attempted_question)/$total_question*100;
                    
                    $course = DB::table("courses")->where("course_id",$session_his->course_id)->first();

                    }
                    
                    

                  ?>
                  <tr>
                    <td>{{$i}}</td>
                    <td>{{ $student_data->name }} </td>
                    <td>{{ $student_data->email }} </td>
                    <td>{{ $quiz_type }} </td>
                    <td>{{ $course->title }} </td>
                    <td>{{ $topics_title }} </td>
                    <td>
                      <?php
                        if($quiz_type == "Quiz"){
                          $chapter = DB::table("subtopics")->where("st_id",$session_his->chapter_id)->first();
                          echo $chapter->title;
                        }
                      ?>
                    </td>
                    <td>
                      
                      {{ $total_question }}
                    </td>
                    <td>
                      
                      {{ count($attempted_question) }}
                    </td>
                    <td>
                      <?php
                        $options = DB::table("question_analysis")->where("course_id",$session_his->course_id)->where("topic_id",$session_his->topic_id)->where("chapter_id",$session_his->chapter_id)->where("student_id",$student_data->id)->where("reference_id",$session_his->reference_id)->get();
                        // echo "<pre>";
                        // print_r($options);
                        $correct_answer = array();
                        foreach ($options as $op) {

                          if($op->student_answer == $op->option_id && $op->correct_answer == "correct"){
                            
                            $correct_answer[] = "correct";
                          }
                        }
                        echo count($correct_answer);
                      ?>
                    </td>
                     <td>
                       <?php
                        $test_status_data = DB::table("session_analysis")->where("reference_id",$session_his->reference_id)->first();

                        
                       ?>
                       @if($test_status_data)
                        Complete
                       @else
                        Not Complete
                       @endif
                     </td>
                    
                  </tr>
                  <?php $i++; ?>
                  @endforeach            
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>


@endsection




@section('js_bottom')






<!-- Bootstrap -->

<script src="{{ url('/') }}/public/design/admin/js/bootstrap.min.js" type="text/javascript"></script>

<!-- DATA TABES SCRIPT -->
<script src="https://jqueryvalidation.org/files/dist/jquery.validate.min.js"></script>



   
<!--Export table button CSS-->


<script>

   $('.toggle-class').on("change", function() {
    var status = $(this).prop('checked') == true ? 1 : 0; 
    var id = $(this).data('id'); 
    $.ajax({
      type: "POST",
      dataType: "json",
      url: "<?php echo url('/student/student_status'); ?>",
      data: {'status': status, 'id': id},
          headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Include CSRF token in headers
    },
       success: function(data){

        if(data.success){
          toastr.success('status changeed successfully');
        }
        else{
          toastr.error('Failed to change status');

        }
        },
      
    });
  })

</script>

@stop



@extends('Front.layouts.layout')
@section('title', 'User Dashboard')

@section('current_page_js')
<script type="text/javascript">
  function next_btn(){
    var topics_array = [];
    $("input:checkbox[name=course_topics]:checked").each(function(){
        topics_array.push($(this).val());
    });
    
    var question_type = $("input:radio[name=attempted-questions]:checked").val();
    var difficulty_level = $("input:radio[name=difficulty_level]:checked").val();
    var session_length = $("input:radio[name=session_length]:checked").val();
    console.log("topics_array",JSON.stringify(topics_array));
    $.ajax({
      type: "post",
      url: "{{ url('/user/submit_exam_builder') }}",
      data: {"course_id":"<?php echo $course_id; ?>","topics":JSON.stringify(topics_array),"question_type":question_type,"difficulty_level":difficulty_level,"session_length":session_length,"_token":"{{ csrf_token() }}"},
      cache: false,
      success: function(data){
         console.log("data",data);
         window.location.href = "{{ url('/user/start_quiz') }}/"+data;
      }
    });
  }
</script>
@endsection


@section('content')
<div class="row">


<div class="col-md-12">

   <div class="chose-q">
   <div class="mb-4"> <h4 class="mb-1 p-0"><b>Choose your topics </b></h4>
            <p class="m-0 p-0"> Tick the Boxes to choose topics</p></div>

   <div class="tick-box">
    @foreach($topic_data as $t_data)
    @if($t_data->status == 1 && $t_data->deleted_at == NULL)
    <?php
      $topic_questions = DB::table("question_bank")->where("topic_id",$t_data->topic_id)->groupBy("q_id")->get();
      $i = 0;
      foreach($topic_questions as $t_qu){
        if($t_qu->quiz_exam == "Exam Builder" || $t_qu->quiz_exam == "Both"){
                        $i++;
                    }
      }

    ?>
   <div class="tick-radio">
    <div>
    <input type="checkbox" id="course_topics" name="course_topics" value="{{ $t_data->topic_id }}">
    <label for="vehicle1">{{ $t_data->title }}</label>
  </div>
  <small> {{ $i }} Questions</small>

   </div>
   @endif
   @endforeach

      

      </div>

<div class="mt-4">
<div class="mb-2">
 <h4 class="mb-1 p-0"><b>Choose question type </b></h4>
            </div>
<div class="any-quest">
<div class="select-difi">
<input type="radio" class="btn-check" name="attempted-questions" id="success-outlinedx" autocomplete="off" value="Attempted">
<label class="btn btn-outline-success" for="success-outlinedx">Attempted</label>

<input type="radio" class="btn-check" name="attempted-questions" id="danger-outlinedy" autocomplete="off" value="Not attempted">
<label class="btn btn-outline-success" for="danger-outlinedy">Not attempted</label>

<input type="radio" class="btn-check" name="attempted-questions" id="success-outlinedbz" autocomplete="off" value="Any Questions">
<label class="btn btn-outline-success" for="success-outlinedbz"> Any Questions</label>


</div>

</div>

</div>

<div class="mt-4">
<div class="mb-2">
 <h4 class="mb-1 p-0"><b>Select Difficulty </b></h4>
            </div>
<div class="select-difi">
<input type="radio" class="btn-check" name="difficulty_level" id="success-outlined" autocomplete="off" value="Easy">
<label class="btn btn-outline-success" for="success-outlined">Easy</label>

<input type="radio" class="btn-check" name="difficulty_level" id="danger-outlined" autocomplete="off" value="Medium">
<label class="btn btn-outline-success" for="danger-outlined">Medium</label>

<input type="radio" class="btn-check" name="difficulty_level" id="success-outlinedb" autocomplete="off" value="Hard">
<label class="btn btn-outline-success" for="success-outlinedb">Hard</label>

<input type="radio" class="btn-check" name="difficulty_level" id="danger-outlineda" autocomplete="off" value="Mix it up">
<label class="btn btn-outline-success" for="danger-outlineda">Mix it up</label>
</div>

</div>




<div class="mt-4">
<div class="mb-2">
 <h4 class="mb-1 p-0"><b>Session Length</b></h4>
            </div>
<div class="select-difi">
<input type="radio" class="btn-check" name="session_length" id="success-outlinedy" autocomplete="off" value="Short">
<label class="btn btn-outline-success" for="success-outlinedy">Short
10 mins - 20 mins</label>

<input type="radio" class="btn-check" name="session_length" id="danger-outlinedk" autocomplete="off" value="Medium">
<label class="btn btn-outline-success" for="danger-outlinedk">Medium
30 mins - 45 mins</label>

<input type="radio" class="btn-check" name="session_length" id="success-outlinedbx" autocomplete="off" value="Long">
<label class="btn btn-outline-success" for="success-outlinedbx">Long
60 mins - 90 mins</label>

</div>

</div>

<a href="#" class="next-chose" onclick="next_btn()"> Next </a>


            </div>

          </div>



</div>
@include('Front.layouts.footer')
@endsection
@extends('Front.layouts.layout')
@section('title', 'Session Analysis')

@section('current_page_css')
<style type="text/css">
  .label_one{
    background-color: #4F8AC7 !important;
    padding: 5px 12px !important;
    color: #FFF !important;
    border-bottom-left-radius: 20px !important;
    border-top-left-radius: 20px !important;
    font-size: 14px !important;
  }

  .label_two{
    background-color: #67AA6F !important;
    padding: 5px 12px !important;
    font-size: 15px !important;
    color: #FFF !important;
    margin-left: 2px !important;
    margin-right: 2px !important;
    font-size: 14px !important;
  }

  .label_three{
    background-color: #D9D9D9 !important;
    padding: 8px !important;
    color: #FFF !important;
    padding: 5px 12px !important;
    border-bottom-right-radius: 20px !important;
    border-top-right-radius: 20px !important;
    font-size: 15px !important;
    font-size: 14px !important;
  }
</style>
@endsection

@section('current_page_js')
<script src="https://cdn.jsdelivr.net/npm/mathjax@3.0.0/es5/tex-mml-chtml.js"></script>
<script type="text/javascript">
  var correct_answer = $(".correct_answer").val();
  var correct_ans = correct_answer/"<?php echo $session_analysis1->total_questions; ?>";
  console.log("correct_answer",correct_ans.toFixed(2));
  $(".correct_answer_session").html(correct_ans.toFixed(2)*100+"%");
  // $(".label_incorrect").show();
  // $(".label_incorrect").siblings().remove();
  var questions_length = $(".attempt-quesa").length;
  for(var i = 1;i<=questions_length;i++){
    if ($('.label_correct-'+i).length){
        $(".label_incorrect-"+i).remove();
    }
    if ($('.label_attempted-'+i).length){
        $(".label_incorrect-"+i).remove();
    }
  }

  var timer_type = "<?php echo $timer_type; ?>";
  console.log("timer_type",timer_type);
  if(timer_type == "Timed"){
    var avg_time_length = $(".avg_time").length;
    for(var i = 1;i<=avg_time_length;i++){
      
      if(i == 1){
        var prev_timer = "<?php echo $timer; ?>";
        var timer_split = prev_timer.split('.');
        var new_time = parseInt(timer_split[0])*60+parseInt(timer_split[1]);
        console.log("new_time",new_time);
        var avg_time_prev = $(".avg_time-"+i).val();
        console.log("avg_time_prev",avg_time_prev);
        var new_time_first = new_time - avg_time_prev;
        $(".label_one-"+i).html(new_time_first);
      }else{
        var avg_time_prev = $(".avg_time-"+(i-1)).val();
        //console.log("avg_time_prev",$(".avg_time-"+i).val());
        var avg_time_next = $(".avg_time-"+i).val();
        var avg_time = avg_time_prev - avg_time_next;
        console.log("avg_time",avg_time);
        var new_avg_time;
        if(avg_time < 0){
          new_avg_time = avg_time * -1;
        }else{
          new_avg_time = avg_time;
        }
        
        $(".label_one-"+i).html(new_avg_time);
      }
      // var avg_time_prev = $(".avg_time-"+(i-1)).val();
      // console.log("avg_time_prev",avg_time_prev);
    }
  }else{
    var avg_time_length = $(".avg_time").length;
    for(var i = 1;i<=avg_time_length;i++){
      
      if(i == 1){
        var avg_time_prev = $(".avg_time-"+i).val();
        //console.log("avg_time_prev",avg_time_prev);
        $(".label_one-"+i).html(avg_time_prev);
      }else{
        var avg_time_prev = $(".avg_time-"+(i-1)).val();
        //console.log("avg_time_prev",$(".avg_time-"+i).val());
        var avg_time_next = $(".avg_time-"+i).val();
        var avg_time = avg_time_next - avg_time_prev;
        var new_avg_time;
        if(avg_time < 0){
          new_avg_time = avg_time * -1;
        }else{
          new_avg_time = avg_time;
        }
        $(".label_one-"+i).html(new_avg_time);
      }
      // var avg_time_prev = $(".avg_time-"+(i-1)).val();
      // console.log("avg_time_prev",avg_time_prev);
    }
  }
  
  var time_sum = 0;
  $(".label_span").each(function(){
    var label_span_val = $(this).text();
    
    time_sum = time_sum + parseInt(label_span_val);
  });

  if(time_sum<60){
    var digit_count = time_sum.toString().length;
    var time_sum_sec1;
    if(digit_count < 2){
      time_sum_sec1 = "0"+time_sum;
    }else{
      time_sum_sec1 = time_sum;
    }
    $(".total_time_mins").html("0:"+time_sum_sec1);
  }else{
    var time_sum_min = parseInt(time_sum/60);

    var time_sum_sec = time_sum%60;
    var digit_count = time_sum_sec.toString().length;
    var time_sum_sec1;
    if(digit_count < 2){
      time_sum_sec1 = "0"+time_sum_sec;
    }else{
      time_sum_sec1 = time_sum_sec;
    }
    
    $(".total_time_mins").html(time_sum_min+":"+time_sum_sec1);
  }
  var total_questions = $(".attempt-quesa").length;
  var total_avg_time = time_sum/60;
  console.log("total_avg_time",total_avg_time);
  var total_avg = total_avg_time/total_questions;
  var avg_time = total_avg.toFixed(2);
  $(".avg_time_minutes").html(avg_time);

  
  
</script>
@endsection

@section('content')
	<div class="col-md-12">
   <div class="class-box-se" style="background-color: inherit;">
    <h3 class="setion-ana">Session Analysis </h3>

<div class="flex-br">
<div class="seesion-box">
  <div class="d-flex">
  <div class="mr-3a a1">
<label> <i class='bx bx-task'></i></label>
</div>
<div class="tex-bk">
<h5> {{ $session_analysis1->attempted_questions}}/{{ $session_analysis1->total_questions}}</h5>
<p>Completed</p>
</div>
</div>
</div>


<div class="seesion-box">
  <div class="d-flex ">
  <div class="mr-3a a2">
<label> <i class='bx bx-check-double'></i></label>
</div>

<div class="tex-bk">
<h5 class="correct_answer_session">
  <?php
    // $attempted_questions = $session_analysis1->attempted_questions;
    // $total_questions = $session_analysis1->total_questions;
    // $correct_answers = $attempted_questions/$total_questions * 100;
    // echo number_format((float)$correct_answers, 2, '.', '')."%";
  ?>
</h5>
<p>Correct</p>
</div>
</div>
</div>

<div class="seesion-box">
  <div class="d-flex ">
<div class="mr-3a a3">
<label> <i class='bx bx-time-five'></i></label>
</div>

<div class="tex-bk">
  <?php 
  if(strpos($reference_id,'quiz')){
    $subtopic_data = DB::table("subtopics")->where("st_id",$st_id)->first();

    if($subtopic_data->quiz_time == "Timed"){
      $avg_mins = $session_analysis1->time_spent_seconds /$session_analysis1->total_questions;
      $mins1 = $avg_mins/60;
      ?>
      <h5><span class="avg_time_minutes"> {{ $mins1 }}</span> <small>minutes</small></h5>
      <p>Avg. Time per Questions</p>
      <?php
    }else{
      $sum = 0;

      foreach($session_analysis as $s_an){
        
        $sum = $sum + $s_an->time_spent_seconds;
      }

      $sum1 = $sum/count($session_analysis);
      ?>

      <h5><span class="avg_time_minutes"><?php echo number_format((float)$sum1, 2, '.', ''); ?></span> Seconds</small></h5>

      <p>Avg. Time per Questions</p>
      <?php
    }  
  }else{
    $avg_mins = (int)$session_analysis1->time_spent_seconds/(int)$session_analysis1->total_questions;
    $mins1 = $avg_mins/60;
    ?>
    <h5><span class="avg_time_minutes"></span> <small>minutes</small></h5>
    <p>Avg. Time per Questions</p>
    <?php
  }
  
  ?>

</div>
</div>
</div>

<div class="seesion-box">
  <div class="d-flex ">
 <div class="mr-3a a4">
<label> <i class='bx bx-stopwatch'></i></label>
</div>

<div class="tex-bk">
  <?php
  if(strpos($reference_id,'quiz')){
    if($subtopic_data->quiz_time == "Timed"){
      $mins = (int)$session_analysis1->time_spent_seconds;
      ?>
      <h5>{{ $mins }} <small>minutes</small></h5>
      <p>Total Time Spent</p>
      <?php
    }else{
      ?>
      <h5><span class="total_time_mins"><?php echo $session_analysis1->time_spent_seconds; ?></span> minutes</small></h5>
      <p>Total Time Spent</p>
      <?php
    }  
  }else{
    $mins = $session_analysis1->time_spent_seconds;
      ?>
      <h5><span class="total_time_mins"><?php echo $mins; ?></span> <small>minutes</small></h5>
      <p>Total Time Spent</p>
      <?php
  }
  ?>
  

</div>
</div>
</div>
</div>

<!-- <div class="funct-box">

<div class="seesion-box">
  <div class="d-flex  align-content-center">
 <div class="mr-3a a5">
<label><i class='bx bx-book-open'></i></label>
</div>

<div class="tex-bk">
<h5>Functions (I), Functions (II)</h5>
<p>Recommended Topics to Study</p>
</div>
</div>
</div>
</div> -->



<!-- <div class="col-md-12 mt-4">
<div class="recomend-topic">
<h5 class="pb-2 pt-2"> Recommended topics to study</h5>

<div class="topic-bar">


<div class="chepter-box">
  <a href="#">
  <div class="box1 bx3-c">
<h2><img src="{{ url('/public') }}/assets/img/folder-openyelow.png"> Functions </h2>

<p class="m-0"><i class="bx bx-chevron-right"></i> </p>
</div>
</a>
</div>
<div class="chepter-box">
  <a href="#">
  <div class="box1 bx4-c">
<h2><img src="{{ url('/public') }}/assets/img/folder-open-green.png"> Functions </h2>

<p class="m-0"><i class="bx bx-chevron-right"></i> </p>
</div>
</a>
</div>
<div class="chepter-box">
  <a href="#">
  <div class="box1 bx5-c">
<h2><img src="{{ url('/public') }}/assets/img/folder-open-yellow.png"> Functions </h2>

<p class="m-0"><i class="bx bx-chevron-right"></i> </p>
</div>
</a>
</div>


</div>


</div>
</div> -->
<?php
  $i = 1;
  $j = 1;
  $correct_answer = array();
  //print_r($session_array);
?>

@foreach($session_analysis as $qu)
<?php

  $options = DB::table("question_analysis")->where("course_id",$qu->course_id)->where("topic_id",$qu->topic_id)->where("chapter_id",$qu->chapter_id)->where("question_id",$qu->question_id)->where("student_id",Auth::guard("customer")->user()->id)->where("reference_id",$reference_id)->get();
  //echo $qu->question_id;
  
?>
<div class="attempt-quesa">
  <div class="rel-funct">
    
    <p class="atmpt"> @if($qu->attempted_status != NULL)
     Attempted 
     @else
      Not Attempted 
    @endif</p>
<h3>Question {{ $i }} - <span>{!! $qu->questions !!}</span> </h3>
<input type="hidden" name="">
<input type="hidden" name="avg_time" class="avg_time avg_time-{{ $i }}" value="{{ $qu->time_spent_seconds }}">
<div class="color-bx"> <label class="label_one "> Average Time: 
  @if($qu->time_spent_seconds == NULL)
    <span class="label_span">0</span> seconds</label>
  @else
    <span class="label_span label_one-{{ $i }}">{{ $qu->time_spent_seconds }}</span> seconds</label>
  @endif
  
@if($qu->attempted_status == NULL)
 <label class="label_two label_attempted-{{ $i }}">0% Correct</label>  
@endif    
<label class="label_two label_incorrect-{{ $i }}">0% Correct</label>  
@foreach($options as $op)
  @if($op->correct_answer == "correct" && $op->student_answer == $op->option_id)
     <label class="label_two label_correct-{{ $i }}"> 100% got it Correct</label> 
     <?php
      $correct_answer[$j] = "correct";
      $j++;
     ?> 
  @else

  @endif
  
@endforeach

<label class="label_three"> You spent : 
  @if($qu->time_spent_seconds == NULL)
    <span>0</span> seconds</label>  </div>
  @else
    <span class="label_one-{{ $i }}">{{ $qu->time_spent_seconds }}</span> seconds</label>  </div>
  @endif

</div>
<br>

@foreach($options as $op)
    
    @if($op->correct_answer == "correct")
      <div class="correct-ans"> <div class="d-flex">
        <p><i class="bx bxs-check-circle clr"></i> <label>{!! $op->options !!}</label></p></div>
        <p style="color: #00BD65;"><i class="bx bx-check-double clr"></i> Correct</p>
      </div>
    @else
      @if($op->option_id == $op->student_answer)
      <div class="incore-ans">
       <div class="d-flex"> <p><i class="bx bxs-check-circle clrpx"></i> <label>{!! $op->options !!}</label></p>
       </div>
        <p style="color: #F44336;"><i class="bx bx-x clr-cancel"></i> Incorrect</p>
      </div>
      @else
        <div class="correct-ans-incor">
           <div class="d-flex">
          <p><i class="bx bx-radio-circle blscr"></i> <label>{!! $op->options !!}</label></p>
        </div>

        </div>
      @endif
    @endif
  

@endforeach

<?php
  $questions_data = DB::table("question_bank")->where("course_id",$qu->course_id)->where("topic_id",$qu->topic_id)->where("chapter_id",$qu->chapter_id)->where("q_id",$qu->question_id)->groupBy('q_id')->first();
?>
<p class="mt-2 f-p"><b> Explanation :</b> <br>
  {!! $questions_data->correct_answer_explanation !!}

</p>
</div>
<?php
  $i++;
?>

@endforeach
@foreach($questions as $qu)
  @if(!in_array($qu->q_id, $session_array))
  <?php

  $options = DB::table("question_bank")->where("course_id",$qu->course_id)->where("topic_id",$qu->topic_id)->where("chapter_id",$qu->chapter_id)->where("q_id",$qu->q_id)->get();
  
?>
<div class="attempt-quesa">
  <div class="rel-funct">
    
    <p class="atmpt">Not Attempted</p>
<h3>Question {{ $i }} - <span>{!! $qu->title !!}</span> </h3>

<div class="color-bx"> <label class="label_one"> Average Time: 0 seconds</label>
  
<label class="label_two">0% Correct</label>  


<label class="label_three"> You spent : 0 seconds</label>  </div>
</div>
<br>

@foreach($options as $op)
    
    @if($op->correct_answer == "correct")
      <div class="correct-ans"> <div class="d-flex">
        <p><i class="bx bxs-check-circle clr"></i> <label>{!! $op->Options !!}</label></p></div>
        <p style="color: #00BD65;"><i class="bx bx-check-double clr"></i> Correct</p>
      </div>
    @else
      
        <div class="correct-ans-incor">
           <div class="d-flex">
          <p><i class="bx bx-radio-circle blscr"></i> <label>{!! $op->Options !!}</label></p>
        </div>

        </div>
      
    @endif
  

@endforeach


<p class="mt-2 f-p"><b> Explanation :</b> <br>
  {!! $qu->correct_answer_explanation !!}

</p>
</div>
<?php
  $i++;
?>
@endif
@endforeach

<input type="hidden" name="correct_answer" class="correct_answer" value="<?php echo count($correct_answer); ?>">


</div>
</div>
@endsection
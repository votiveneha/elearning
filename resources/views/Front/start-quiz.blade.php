@extends('Front.layouts.layout')
@section('title', 'Start Quiz')
@section("current_page_js")
<script type="text/javascript">
	$(".start-quz").click(function(){
    //alert("hello");
    
  });

  console.log(document.cookie);

</script>	
@endsection

@section('content')
	<section class="quiz-man">
      <div class="container-fluid" data-aos="fade-up">
  <div class="class-box" style="top:0px;">
    <div class="row">
    <div class="col-md-9 m-auto">
      <a href="#" class="d-flex key-space" onclick="history.back()" style="position: relative;bottom: 28px;"><span class="material-symbols-outlined mr-2">
keyboard_backspace
</span> Back </a>
  <div class="col-md-6 m-auto">
<div class="theory-box-quiz">
<!--   <div class="eleps-circle">
<img src="{{ url('/public') }}/assets/img/ellipse.png">
 </div> -->
 <div class="text-quize">
<h5>{{ $course_title->title }}</h5>
<p>{{ $topic_name }}</p>
<p>Total marks <b>{{ $marks }} Marks</b></p>
<p class="alrm-ct">@if($subtopic_data->timer != "Not Timed")<b><i class='bx bx-alarm' style="font-size: 21px;position: relative;top: 2px;"></i> {{ $total_time }} mins <i class='bx bxs-circle' style="font-size: 8px;"></i></b>@else <b><i class='bx bx-alarm' style="font-size: 21px;position: relative;top: 2px;"></i>Not Timed</b> @endif Total Question: <strong>{{ $question_count }}</strong> </p>

</div>
<a href="{{ url('/user/quiz') }}/{{ $course_id }}/{{ $topic_id }}/{{ $st_id }}" class="start-quz">Start Quiz </a>
</div>
          </div>


</div>
</div>
</div>
</div>
</section>
@endsection
@extends('Front.layouts.layout')
@section('title', 'Start Quiz')

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
<p>@if($topic_titles){{ $topic_titles }}@endif</p>
<p>Total marks <b>{{ $marks }} Marks</b></p>
<p class="alrm-ct"><b><i class='bx bx-alarm' style="font-size: 21px;position: relative;top: 2px;"></i> {{ $total_time }} mins <i class='bx bxs-circle' style="font-size: 8px;"></i></b> Total Question: <strong>{{ $question_count }}</strong> </p>

</div>
<a href="@if($question_count<=0 && $total_time=='0:00') # @else {{ url('/user/quiz') }}/{{ $reference_id }}?question=1 @endif" class="start-quz">Start Quiz </a>
</div>
          </div>


</div>
</div>
</div>
</div>
</section>
@endsection
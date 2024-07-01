@extends('Front.layouts.layout')
@section('title', 'Session History')


@section('current_page_js')
<script type="text/javascript">
  function resumeTest(quiz_type,course_id,topic_id,chapter_id,reference_id){

    if(quiz_type == "exam_builder"){
      window.location.href = "{{ url('/user/quiz/') }}/"+reference_id;
    }else{
      window.location.href = "{{ url('/user/quiz/') }}/"+course_id+"/"+topic_id+"/"+chapter_id+"?question=1&&reference_id="+reference_id;
    }

    
    //window.open("{{ url('/user/quiz/') }}/"+course_id+"/"+topic_id+"/"+chapter_id+"?question=1&&reference_id="+reference_id);
  }
  function testResult(quiz_type,course_id,topic_id,chapter_id,reference_id){

    if(quiz_type == "exam_builder"){
      window.location.href = "{{ url('/user/session_analysis/') }}/"+reference_id;
    }else{
      window.location.href = "{{ url('/user/session_analysis/') }}/"+course_id+"/"+topic_id+"/"+chapter_id+"?reference_id="+reference_id;
    }

    
    //window.open("{{ url('/user/session_analysis/') }}/"+course_id+"/"+topic_id+"/"+chapter_id+"?reference_id="+reference_id);
  }
  jQuery($ => {  
  let $pageContainer = $('.page-container');
  let $content = $pageContainer.children('.content');
  let $pageLinks = $('#pagin li a.page');
  let $prev = $('#prev');
  let $next = $('#next');
  
  let pageSize = 10;
  let pageCount = Math.ceil($('.content').length / 2);
  let currentPage = $pageContainer.data('page') || 1;

  let setActivePage = page => {
    let start = pageSize * (page - 1);
    let end = pageSize * page;
    $content.hide().slice(start, end).show();

    $prev.toggleClass('disabled', page <= 1);
    $next.toggleClass('disabled', page >= pageCount);    
    $pageLinks.removeClass("current").eq(page - 1).addClass('current');    
    $pageContainer.data('page', page);
  }

  setActivePage(currentPage);

  $pageLinks.on('click', e => setActivePage($(e.target).closest('li').index()));
  $prev.on('click', e => setActivePage($pageContainer.data('page') - 1));
  $next.on('click', e => setActivePage($pageContainer.data('page') + 1));
});
</script>
@endsection

@section('current_page_css')
<style type="text/css">
.sesn label {
    color: #939393;
    font-size: 16px;
}
.box-senvb h4 {
    text-align: center;
    font-size: 14px;
    border-bottom: 1px solid #e7e7e7;
    padding: 7px;
}
.topics-sesion .accordion-list {
    padding: 12px;
    background: #FFF;
    border-radius: 5px;
}
.topics-sesion {
    padding: 25px;
    margin-top: 75px;
    padding-bottom: 25px;
    padding-top: 25px !important;
}
.resime-box p{
margin-bottom: 0px;
}
.resume-btn {
    border: 1px solid #ccc;
    background: #efefef;
    border-radius: 2px;
    padding: 4px 9px;
    font-size: 14px;
}
#pagin {
  clear: both;
  padding: 0;
  margin: 0 auto;
}
#pagin li a.current {
    background: #2567d5;
	color: #ffffff;
}
#pagin li a {
    position: relative;
    display: block;
    padding: 0.5rem 0.75rem;
    margin-left: -1px;
    line-height: 1.25;
    color: #2567d5;
    background-color: #fff;
    border: 1px solid #dee2e6;
}
#pagin li {   
	border: 1px solid transparent;   
	border-radius: 2px;
}
ul#pagin {
    display: flex;
    justify-content: center;
    margin-top: 35px;
    margin-bottom: 35px;
}
#pagin li {
  float: left;
      margin-right: 2px;
    line-height: 1.8;
}
#pagin li a:hover svg path {
    fill: #ffffff !important;
}
#pagin li a {
      border-color: #ebedf2;
    color: #343a40;
    font-size: 0.875rem;
    -webkit-transition-duration: 0.3s;
    -moz-transition-duration: 0.3s;
    -o-transition-duration: 0.3s;
    transition-duration: 0.3s;
}

#pagin li a.current {
      background: #2567d5;
    color: #ffffff;
}

#pagin li a.disabled {
  pointer-events: none;
  opacity: 0.4;
}

#pagin li a:hover {
  
}

#pagin li a:active,
#pagin li a.current:active {
  
}

#pagin li a:hover {
    background: #2567d5;
    color: #ffffff;
}

li {
  list-style-type: none;
}
</style>
@endsection

@section('content')
      <section  class="topics-sesion section-bg pt-5">
      <div class="container p-0">
   <div class="row page-container">
 
    <div class="sesn"><h4><b>Attempt History </b><br></h4></div>
    <?php $i=0; ?>
    @foreach($session_history as $session_his)

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


        $attempted_question = DB::table("question_analysis")->where("student_id",Auth::guard("customer")->user()->id)->where("student_answer","!=",NULL)->where("reference_id",$session_his->reference_id)->groupBy('question_id')->get();

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

      $attempted_question = DB::table("question_analysis")->where("student_id",Auth::guard("customer")->user()->id)->where("student_answer","!=",NULL)->where("reference_id",$session_his->reference_id)->groupBy('question_id')->get();

      $date=date_create($session_his->created_at);
      
      //echo $session_his->created_at;

      $session_progress = count($attempted_question)/$total_question*100;
      
      $course = DB::table("courses")->where("course_id",$session_his->course_id)->first();

      }
      
      

    ?>
    @if($total_question != NULL)
    <div class="content" >
    <div class="box-senvb">
   <h4>{{ date_format($date,"M d, Y") }}</h4>
</div>
<div class="accordion-list">
  <p><strong>({{ $quiz_type }}) {{ $course->title }}:  </strong> 
    {{ $topics_title }}
  </p>
    <div class="d-flex justify-content-between align-items-center resime-box">
  <span class="material-symbols-outlined">
more_time
</span>
<?php
  $test_status_data = DB::table("session_analysis")->where("reference_id",$session_his->reference_id)->first();

  
?>
<div class="progress" style="height:15px; width: 80%;">

  <div class="progress-bar progress-bar-striped progress-bar-animated progress-bar-info"
       style="width:@if($test_status_data) @if($session_progress < 100) {{ $session_progress }}% @else 100% @endif @else {{ $session_progress }}% @endif ;@if($test_status_data) @if($session_progress < 100) background-color:  #d9534f !important;  {{ $session_progress }}% @else background-color: green !important; @endif  @endif"
       role="progressbar"
       aria-valuenow="90"
       aria-valuemin="0"
       aria-valuemax="100"> </div> 
</div>
<p> <?php echo count($attempted_question); ?>/<?php echo $total_question; ?> 

@if($test_status_data)
<button type="button" class="resume-btn" onclick="testResult('{{ $session_his->quiz_type }}','{{ base64_encode($session_his->course_id) }}','{{ base64_encode($session_his->topic_id) }}','{{ base64_encode($session_his->chapter_id) }}','{{ base64_encode($session_his->reference_id) }}')">
Complete
</button>
@else
<button type="button" class="resume-btn" onclick="resumeTest('{{ $session_his->quiz_type }}','{{ base64_encode($session_his->course_id) }}','{{ base64_encode($session_his->topic_id) }}','{{ base64_encode($session_his->chapter_id) }}','{{ base64_encode($session_his->reference_id) }}')">
Resume
</button>
@endif
</p>

</div>
          
</div>

</div>
<?php
  $i++;
?>
@endif
@endforeach
 

</div>
<ul id="pagin">
  <li>
    <a style="cursor: pointer;" id="prev">
      <svg width="8" height="12" viewBox="0 0 8 12" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" clip-rule="evenodd" d="M7.15493e-08 6L6 12L7.41 10.59L2.83 6L7.41 1.41L6 7.15493e-08L7.15493e-08 6Z" fill="#212934"/>
      </svg>
    </a>
  </li>
  <?php
    
    $page_divide = (int)count($session_history)/10;
    $page_mod = count($session_history)%10;
    if($page_mod > 0){
      $page_no = $page_divide + 1;
    }else{
      $page_no = $page_divide;
    }
    for($i = 1; $i<=$page_no; $i++){
      ?>
        <li><a class="page @if($i == 1) current @endif" style="cursor: pointer;">{{ $i }}</a></li>
      <?php
    }
  ?>

  <li>
    <a style="cursor: pointer;" id="next">
      <svg width="7" height="11" viewBox="0 0 7 11" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" clip-rule="evenodd" d="M6.1748 5.75421L1.1748 0.754211L-0.000195489 1.92921L3.81647 5.75421L-0.000195398 9.57921L1.1748 10.7542L6.1748 5.75421Z" fill="#212934"/>
      </svg>
    </a>
  </li>
</ul>
   </div>
@include('Front.layouts.footer')

</section>
@endsection
@extends('Front.layouts.layout')
@section('title', 'Session History')


@section('current_page_js')
<script type="text/javascript">
  function resumeTest(course_id,topic_id,chapter_id,reference_id){

    window.location.href = "{{ url('/user/quiz/') }}/"+course_id+"/"+topic_id+"/"+chapter_id+"?question=1&&reference_id="+reference_id;
    //window.open("{{ url('/user/quiz/') }}/"+course_id+"/"+topic_id+"/"+chapter_id+"?question=1&&reference_id="+reference_id);
  }
  function testResult(course_id,topic_id,chapter_id,reference_id){

    window.location.href = "{{ url('/user/session_analysis/') }}/"+course_id+"/"+topic_id+"/"+chapter_id+"?reference_id="+reference_id;
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
    padding: 0;
    margin-top: 85px;
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
  margin-right: 10px;
}

#pagin li a {
  display: block;
  color: #717171;
  font: bold 11px;
  padding: 5px 8px;
  -webkit-border-radius: 3px;
  -moz-border-radius: 3px;
  border-radius: 3px;
  -webkit-box-shadow: 0px 1px 3px 0px rgba(0, 0, 0, 0.35);
  -moz-box-shadow: 0px 1px 3px 0px rgba(0, 0, 0, 0.35);
  box-shadow: 0px 1px 3px 0px rgba(0, 0, 0, 0.35);
  background: #f9f9f9;
  background: -webkit-linear-gradient(top, #f9f9f9 0%, #e8e8e8 100%);
  background: -moz-linear-gradient(top, #f9f9f9 0%, #e8e8e8 100%);
  background: -o-linear-gradient(top, #f9f9f9 0%, #e8e8e8 100%);
  background: -ms-linear-gradient(top, #f9f9f9 0%, #e8e8e8 100%);
  background: linear-gradient(top, #f9f9f9 0%, #e8e8e8 100%);
  filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f9f9f9', endColorstr='#e8e8e8', GradientType=0);
}

/*#pagin li a.current {
  color: white;
  text-shadow: 0px 1px #3f789f;
  -webkit-box-shadow: 0px 1px 2px 0px rgba(0, 0, 0, 0.8);
  -moz-box-shadow: 0px 1px 2px 0px rgba(0, 0, 0, 0.8);
  box-shadow: 0px 1px 2px 0px rgba(0, 0, 0, 0.8);
  background: #7cb9e5;
  background: -webkit-linear-gradient(top, #7cb9e5 0%, #57a1d8 100%);
  background: -moz-linear-gradient(top, #7cb9e5 0%, #57a1d8 100%);
  background: -o-linear-gradient(top, #7cb9e5 0%, #57a1d8 100%);
  background: -ms-linear-gradient(top, #7cb9e5 0%, #57a1d8 100%);
  background: linear-gradient(top, #7cb9e5 0%, #57a1d8 100%);
  filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#7cb9e5', endColorstr='#57a1d8', GradientType=0);
}*/

#pagin li a.disabled {
  pointer-events: none;
  opacity: 0.4;
}

#pagin li a:hover {
  -webkit-box-shadow: 0px 1px 3px 0px rgba(0, 0, 0, 0.55);
  -moz-box-shadow: 0px 1px 3px 0px rgba(0, 0, 0, 0.55);
  box-shadow: 0px 1px 3px 0px rgba(0, 0, 0, 0.55);
  background: #fff;
  background: -webkit-linear-gradient(top, #fff 0%, #e8e8e8 100%);
  background: -moz-linear-gradient(top, #fff 0%, #e8e8e8 100%);
  background: -o-linear-gradient(top, #fff 0%, #e8e8e8 100%);
  background: -ms-linear-gradient(top, #fff 0%, #e8e8e8 100%);
  background: linear-gradient(top, #fff 0%, #e8e8e8 100%);
  filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fff', endColorstr='#e8e8e8', GradientType=0);
}

#pagin li a:active,
#pagin li a.current:active {
  -webkit-box-shadow: inset 0px 1px 3px 0px rgba(0, 0, 0, 0.5), 0px 1px 1px 0px rgba(255, 255, 255, 1) !important;
  -moz-box-shadow: inset 0px 1px 3px 0px rgba(0, 0, 0, 0.5), 0px 1px 1px 0px rgba(255, 255, 255, 1) !important;
  box-shadow: inset 0px 1px 3px 0px rgba(0, 0, 0, 0.5), 0px 1px 1px 0px rgba(255, 255, 255, 1) !important;
}

#pagin li a.current:hover {
  -webkit-box-shadow: 0px 1px 2px 0px rgba(0, 0, 0, 0.9);
  -moz-box-shadow: 0px 1px 2px 0px rgba(0, 0, 0, 0.9);
  box-shadow: 0px 1px 2px 0px rgba(0, 0, 0, 0.9);
  background: #99cefc;
  background: -webkit-linear-gradient(top, #99cefc 0%, #57a1d8 100%);
  background: -moz-linear-gradient(top, #99cefc 0%, #57a1d8 100%);
  background: -o-linear-gradient(top, #99cefc 0%, #57a1d8 100%);
  background: -ms-linear-gradient(top, #99cefc 0%, #57a1d8 100%);
  background: linear-gradient(top, #99cefc 0%, #57a1d8 100%);
  filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#99cefc', endColorstr='#57a1d8', GradientType=0);
}

li {
  list-style-type: none;
}
</style>
@endsection

@section('content')
      <section  class="topics-sesion section-bg pt-5">
      <div class="container">
   <div class="row page-container">
 
    <div class="sesn"><h4><b>Attempt History </b><br></h4></div>
    <?php $i=0; ?>
    @foreach($session_history as $session_his)

    <?php
      $total_question = DB::table("question_bank")->where("chapter_id",$session_his->chapter_id)->groupBy('q_id')->get();

      $attempted_question = DB::table("question_analysis")->where("student_id",Auth::guard("customer")->user()->id)->where("student_answer","!=",NULL)->where("reference_id",$session_his->reference_id)->groupBy('question_id')->get();

      $date=date_create($session_his->created_at);
      
      //echo $session_his->created_at;
      $session_progress = count($attempted_question)/count($total_question)*100;
      
      $course = DB::table("courses")->where("course_id",$session_his->course_id)->first();

      $topic = DB::table("topics")->where("topic_id",$session_his->topic_id)->first();

    ?>
    <div class="content">
    <div class="box-senvb">
   <h4>{{ date_format($date,"M d, Y") }}</h4>
</div>
<div class="accordion-list">
  <p><strong>{{ $course->title }}:  </strong> {{ $topic->title }}</p>
    <div class="d-flex justify-content-between align-items-center resime-box">
  <span class="material-symbols-outlined">
more_time
</span>
<?php
  $test_status_data = DB::table("session_analysis")->where("reference_id",$session_his->reference_id)->first();

  
?>
<div class="progress" style="height:15px; width: 80%;">
  <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger"
       style="width:@if($test_status_data) 100% @else {{ $session_progress }}% @endif ;@if($test_status_data) background-color: green !important; @endif"
       role="progressbar"
       aria-valuenow="90"
       aria-valuemin="0"
       aria-valuemax="100"> </div> 
</div>
<p> <?php echo count($attempted_question); ?>/<?php echo count($total_question); ?> 

@if($test_status_data)
<button type="button" class="resume-btn" onclick="testResult('{{ base64_encode($session_his->course_id) }}','{{ base64_encode($session_his->topic_id) }}','{{ base64_encode($session_his->chapter_id) }}','{{ base64_encode($session_his->reference_id) }}')">
Complete
</button>
@else
<button type="button" class="resume-btn" onclick="resumeTest('{{ base64_encode($session_his->course_id) }}','{{ base64_encode($session_his->topic_id) }}','{{ base64_encode($session_his->chapter_id) }}','{{ base64_encode($session_his->reference_id) }}')">
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

</section>
@endsection
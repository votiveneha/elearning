@extends('Front.layouts.layout')
@section('title', 'Course view')
@section('content')

<style type="text/css">
  
  .topics {
    padding: 0;
     margin-top: 5px; 
}
.class-box {
    padding: 25px;
    position: relative;
     top: 4px; 
}

.chapter_list img{
 width: 40px;
}

@media (min-width: 320px) and (max-width: 767px){
  .class-box {
    padding: 10px;
    position: relative;
     top: 4px; 
}

}
</style>
<div class="row">


<div class="col-md-12">

   <div class="accordion-list">
    <h4><b>{{ $course_title->title }} </b></h4>
    <?php
      $i = 1;
    ?>
    <ul>

      @foreach($topics as $topic)
      @if($topic->status == 1 && $topic->deleted_at == NULL)
      <li>
        <a data-bs-toggle="collapse" class="collapse" data-bs-target="#accordion-list-{{ $i }}"><span><?php echo $i; ?></span> {{ $topic->title }} <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
        <div id="accordion-list-{{ $i }}" class="collapse" data-bs-parent=".accordion-list">
          
          <div class="course-ilsit chapter_list">
            <?php

              $chapter = DB::table("subtopics")->where("topic_id",$topic->topic_id)->orderBy("ordering_id","ASC")->get();

              //print_r($chapter);
            ?>
            <ul> 
              @foreach($chapter as $ch)
              @if($ch->status == 1 && $ch->deleted_at == NULL)
              @if($ch->type == "Theory")
              <li><a href="{{ url('/user/theory') }}/{{ base64_encode($ch->st_id) }}"><img src="{{ url('/public') }}/assets/img/theory_img.png">{{ $ch->title }}</a>
              @endif
              @if($ch->type == "Quiz")

              <li><a href="{{ url('/user/start_quiz') }}/{{ base64_encode($ch->course_id) }}/{{ base64_encode($ch->topic_id) }}/{{ base64_encode($ch->st_id) }}"><img src="{{ url('/public') }}/assets/img/quiz_img.png">{{ $ch->title }}</a>
                <?php
                  $view_button = DB::table("question_analysis")->where("course_id",$ch->course_id)->where("topic_id",$ch->topic_id)->where("chapter_id",$ch->st_id)->where("student_id",Auth::guard("customer")->user()->id)->get();
                  //print_r($view_button);
                ?>
                <!-- @if(count($view_button)>0)
                <a href="{{ url('/user/session_analysis_view') }}/{{ base64_encode($ch->course_id) }}/{{ base64_encode($ch->topic_id) }}/{{ base64_encode($ch->st_id) }}">View Last Result</a>
                @endif -->
              @endif
              </li>
              @endif
              @endforeach
            </ul>
            
        </div>
      </li>
      <?php
        $i++;
      ?>
      @endif
      @endforeach
      
    </ul>
            </div>

          </div>



</div>

@endsection
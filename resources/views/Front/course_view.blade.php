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
    
    <h4><b> {{ $course_title }} </b></h4>
              <ul>
                 <?php
                  $i = 1;
                 ?>
                 @foreach($groupedData as $course)
                 @if($course->status == 1 && $course->deleted_at == NULL)
                <li>
                  <a data-bs-toggle="collapse" class="collapse" data-bs-target="#accordion-list-{{$i}}"><span>{{$i}}</span> {{ $course->topic_title }} <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                  <div id="accordion-list-{{$i}}" class="collapse @if($i == 1) show @endif" data-bs-parent=".accordion-list">
                    
                    <div class="course-ilsit">

                      <!-- <h3><a href="{{ url('/user/theory/') }}/{{ base64_encode(1) }}" class="d-flex align-items-center">  -->
                        <!-- <span class="material-symbols-outlined">menu_book</span>   -->
                        <?php $subtopics_id = explode(",",$course->chapter_id);
                        
                        foreach($subtopics_id as $st_id){
                          $result = app()->call('App\Http\Controllers\UserController@theoryOrnot', ['course_id' => $course->course_id, 'topic_id' => $course->topic_id , 'st_id' => $st_id  ]);
                          
                         }
                         ?> 
                         <!-- - Basic Trigonometry Ratios & Revisions (I) -->
                          </a></h3>
                      <ul class="subtopics_li"> 
                        <?php $subtopics_list = explode(",",$course->subtopics_list);?>
                          <?php $subtopics_list = explode(",",$course->subtopics_list);?>
                          @foreach($subtopics_list as $list)
                           <?php
                            $subtopic_title = DB::table("subtopics")->where("st_id",$list)->first();
                           ?>
                           
                           @if($result['check'] == "Theory")
                           <h3>
                          <a href="{{ url('/user/theory/') }}/{{ base64_encode($course->course_id) }}" class="d-flex align-items-center"> <span class="material-symbols-outlined">menu_book</span>  
                             {{$result['check']}}- {{$subtopic_title->title}}
                          </a></h3>
                          @else
                           @if(!empty($subtopic_title))
                           <li><a href="{{ url('/user/start_quiz') }}/{{ base64_encode($course_id) }}/{{ base64_encode($course->topic_id) }}/{{ base64_encode($list) }}"><img src="{{ url('/public') }}/assets/img/ancre.png">{{$subtopic_title->title}}</a> </li>
                           @else
                           <li><div class="no_chapter_found">No chapter found</div></li>
                           @endif 
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
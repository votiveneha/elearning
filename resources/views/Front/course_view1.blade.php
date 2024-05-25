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
              <li>
                <?php
                  $user_data = DB::table("theory_read")->where("user_id",Auth::guard("customer")->user()->id)->where("st_id",$ch->st_id)->first();
                ?>
                <div class="theory_with_read_btn">
                  <a href="{{ url('/user/theory') }}/{{ base64_encode($ch->st_id) }}"><img src="{{ url('/public') }}/assets/img/theory_img.png">{{ $ch->title }}</a>
                  @if(!empty($user_data))
				<div class="sb-checkbox-qz">
					<input type="checkbox" name="read_check" class="sb-checkbox__input read_check" id="checkeds" checked="">
					<label class="sb-checkbox__label sb-checkbox__label--green" for="checkeds"></label>
				</div>
                  @endif
                </div>
                
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


<div class="row">
<div class="col-md-12">
<!--<div class="add-box">
  <div class="d-flex justify-content-between align-items-center">
    <div>
<h3>Select a Course</h3>
<p> You’ve learned 70% of your goal this week! Keep it up and improve your progress.</p>

</div>

<a href="#">See more</a>
</div>

</div>-->



</div>

<div class="subtext">
    <h4><b>Exam Builder</b></h4>
  </div>
  
  <?php
  $i = 1;
?>
@foreach($course_data as $c_data)

@if($c_data->status == 1 && $c_data->deleted_at == NULL)
@if($c_data->subscription_type == NULL || $c_data->subscription_type == "Free")
  <?php
    $total_subtopic = DB::table("exam_builder")->where("course_id",$c_data->course_id)->where("student_id",Auth::guard('customer')->user()->id)->get();

    $total_topic = DB::table("topics")->where("course_id",$c_data->course_id)->get();

    $total_sub = array();
    foreach ($total_subtopic as $t_sub) {
      $total_sub[] = $t_sub->topics_id;
    }
    $t_sub = implode(",",$total_sub);
    $t_sub1 = explode(",", $t_sub);

    $t_sub2 = count(array_unique(array_filter($t_sub1)));
    
    if(count($total_subtopic) != 0){
      $exam_percent = round($t_sub2/count($total_topic)*100);
    }else{
      $exam_percent = 0;
    }
    
  ?> 
  <div class="col-12 col-sm-8 col-md-6 col-lg-3">
      <a href="#"><div class="card userproc">
        <div class="icn-prc">
          <i class='bx bx-calculator'></i>
        </div>
        <div class="card-body">
          <h4 class="card-title">{{ $c_data->title }}</h4>
            <div class="card-cont">
            <ul>
              <li>YEAR 11</li>
              <li>YEAR 12</li>
            </ul>
            <!--<div class="progress" role="progressbar" aria-label="Example with label" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
              <div class="progress-bar" style="width: {{ $exam_percent }}%">{{ $exam_percent }}%</div>
            </div>-->
            <div class="progress-container" role="progressbar" aria-label="Example with label" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                <div class="progress" style="width: {{ $exam_percent }}%"></div>
                <div class="percentage" style="width: 100%">{{ $exam_percent }}%</div>  
            </div>
            <div class="btm-infos">
              <a href="{{ url('/user/exam_builder_view') }}/{{ base64_encode($c_data->course_id) }}" class="card-link">View</a>
            </div>
            </div>
        </div>
      </div></a>
    </div>
  
  
 
  





<?php
  $i++;
?>


@endif
@endif
@endforeach
<?php
  $user_email = Auth::guard("customer")->user()->email;
  $payment_data = DB::table("payments")->where("customer_email",$user_email)->get();
  
  if(count($payment_data)>0){
    $paid_courses = true;
  }else{
    $paid_courses = false;
  }

  $stripe = new \Stripe\StripeClient("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");
  
  $invoices = $stripe->invoices->all();
  //echo "<pre>";
  //print_r($invoices);
  $in_array = array();
  foreach ($invoices as $key => $in) {
    if($in->customer_email == $user_email){
      $payment_db_product = $stripe->invoices->retrieve($in->id, [])->lines['data'][0]->plan->product;

               
      $product = $stripe->products->retrieve($payment_db_product, []);
      
      array_push($in_array, array("email"=>$in->customer_email,"created"=>$in->created,"plan"=>$product->name,"plan_start"=>$in->lines['data'][0]->period->start,"plan_end"=>$in->lines['data'][0]->period->end));
      //echo $in->customer_email;
      
    }
  }
  //print_r($in_array);
  // foreach ($variable as $key => $value) {
  //   # code...
  // }


  if($in_array){
    $active_plan = $in_array[0]["plan"];
    $plan_end = $in_array[0]["plan_end"]."<br>";
    $current_date = date('m/d/Y h:i:s', time());
    $date = strtotime($current_date); 

    if($plan_end > $date){
      $plan_active = true;
    }else{
      $plan_active = false;
    }
  }else{
    $plan_active = false;
  }
?>
@if($paid_courses)
@foreach($course_data as $c_data)
@if($c_data->status == 1 && $c_data->deleted_at == NULL)
@if($c_data->subscription_type == "Paid")
  <?php
    $total_subtopic = DB::table("exam_builder")->where("course_id",$c_data->course_id)->where("student_id",Auth::guard('customer')->user()->id)->get();

    $total_topic = DB::table("topics")->where("course_id",$c_data->course_id)->get();

    $total_sub = array();
    foreach ($total_subtopic as $t_sub) {
      $total_sub[] = $t_sub->topics_id;
    }
    $t_sub = implode(",",$total_sub);
    $t_sub1 = explode(",", $t_sub);

    $t_sub2 = count(array_unique(array_filter($t_sub1)));
    
    if(count($total_subtopic) != 0){
      $exam_percent = round($t_sub2/count($total_topic)*100);
    }else{
      $exam_percent = 0;
    }
    
  ?> 
  <div class="col-12 col-sm-8 col-md-6 col-lg-3">
      <a href="#"><div class="card userproc">
        <div class="icn-prc">
          <i class='bx bx-calculator'></i>
        </div>
        <div class="card-body">
          <h4 class="card-title">{{ $c_data->title }}</h4>
            <div class="card-cont">
            <ul>
              <li>YEAR 11</li>
              <li>YEAR 12</li>
            </ul>
            <!--<div class="progress" role="progressbar" aria-label="Example with label" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
              <div class="progress-bar" style="width: {{ $exam_percent }}%">{{ $exam_percent }}%</div>
            </div>-->
            <div class="progress-container" role="progressbar" aria-label="Example with label" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                <div class="progress" style="width: {{ $exam_percent }}%"></div>
                <div class="percentage" style="width: 100%">{{ $exam_percent }}%</div>  
            </div>
            <div class="btm-infos">
              <a href="{{ url('/user/exam_builder_view') }}/{{ base64_encode($c_data->course_id) }}" class="card-link">View</a>
            </div>
            </div>
        </div>
      </div></a>
    </div>
  
  
 
  





<?php
  $i++;
?>


@endif
@endif
@endforeach
@endif
</div>
@include('Front.layouts.footer')
<!--<div class="col-md-12">
       <div class="add-box">
  <div class="pd-bane">
    <div>
<h3> Welcome to Mathify!</h3>
<!-- <p> You’ve learned 70% of your goal this week! Keep it up and improve your progress.</p> -->

<!--</div>

<!-- <a href="#">See more</a> -->
<!--</div>

</div>
</div>-->
  
	<!-- <div class="wc-txt">
		<h4><b>Courses</b></h4>
	</div>



  <div class="col-12 col-sm-8 col-md-6 col-lg-3">
      <div class="card courses-dash">
        <img src="https://mathifyhsc.com/dev/public/uploads/courses/stu1709987109.png">
        <div class="card-body">
          <h4 class="card-title">Mathematics Advanced (2U)</h4>
          <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus at neque in justo vehicula.</p>
          <div class="btm-infos">
          <a href="https://mathifyhsc.com/dev/user/course_views/NQ==" class="card-link">View</a>
          <p class="enr">23,350+ Enrolled
      </p></div>
        </div>
      </div>
    </div> -->



@endsection
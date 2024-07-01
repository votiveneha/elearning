@extends('Front.layouts.layout')
@section('title', 'Exam Builder')

@section('current_page_css')
<style type="text/css">
  .card.userproc {
    margin-bottom: 12px;
  }
</style>
@endsection

@section('content')
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

<div class="wc-txt">
		<h4><b>Exam Builder</b></h4>
	</div>
	
	<?php
  $i = 1;
  $user_id = Auth::guard("customer")->user()->id;
  $payment_data = DB::table("payments")->where("customer_id",$user_id)->get();
  $user_data = DB::table("users")->where("email",$user_id)->first();
  //echo $user_data->course_id;
  if(count($payment_data)>0 && $payment_data[0]->payment_status == "Successful"){
    if($payment_data[0]->plan_name != NULL){

      $paid_courses = true;
    }else{
      
      $paid_courses = false;
    }
  }else{
    $paid_courses = false;
  }
?>
@if($paid_courses == false)
@foreach($course_data as $c_data)

@if($c_data->status == 1 && $c_data->deleted_at == NULL)
  @if($c_data->subscription_type == NULL || $c_data->subscription_type == "Free")
  <?php
    $total_subtopic = DB::table("subtopics")->where("course_id",$c_data->course_id)->get();
    $theory_topic = DB::table("theory_read")->where("course_id",$c_data->course_id)->where("user_id",Auth::guard("customer")->user()->id)->get();
    $quiz_topic = DB::table("session_analysis")->where("course_id",$c_data->course_id)->where("student_id",Auth::guard("customer")->user()->id)->get();
    //echo count($quiz_topic);
    $read_topic = count($theory_topic) + count($quiz_topic);
    $read_topic_one = $read_topic/2;
    if(count($total_subtopic) != 0){
      $read_percent = round($read_topic_one/count($total_subtopic) * 100);
    }else{
      $read_percent = 0;
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
            <!-- <div class="progress" role="progressbar" aria-label="Example with label" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
              <div class="progress-bar" style="width: {{ $read_percent }}%">{{ $read_percent }}%</div>
            </div>
            <div class="progress-container progress" role="progressbar" aria-label="Example with label" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
              <div class="progress-run"></div>  
            </div>
            <div class="percentage-stats">{{ $read_percent }}%</div>-->
            
              <div class="progress-container" role="progressbar" aria-label="Example with label" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                <div class="progress" style="width: {{ $read_percent }}%"></div>
                <div class="percentage" style="width: 100%">{{ $read_percent }}%</div>  
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
<?php
  $user_id = Auth::guard("customer")->user()->id;
  $payment_data = DB::table("payments")->where("customer_id",$user_id)->get();
  $user_data = DB::table("users")->where("id",$user_id)->first();
  

  if(count($payment_data)>0 && $payment_data[0]->payment_status == "Successful"){
    if($payment_data[0]->plan_name != NULL){

      $paid_courses = true;
    }else{
      
      $paid_courses = false;
    }
    
  }else{
    $paid_courses = false;
  }


  
  
?>
@if($paid_courses)
@foreach($course_data as $c_data)

@if($c_data->status == 1 && $c_data->deleted_at == NULL)
  @if($c_data->subscription_type == "Paid")
  <?php
    $total_subtopic = DB::table("subtopics")->where("course_id",$c_data->course_id)->get();
    $theory_topic = DB::table("theory_read")->where("course_id",$c_data->course_id)->where("user_id",Auth::guard("customer")->user()->id)->get();
    $quiz_topic = DB::table("session_analysis")->where("course_id",$c_data->course_id)->where("student_id",Auth::guard("customer")->user()->id)->get();
    //echo count($quiz_topic);
    $read_topic = count($theory_topic) + count($quiz_topic);
    $read_topic_one = $read_topic/2;
    if(count($total_subtopic) != 0){
      $read_percent = round($read_topic_one/count($total_subtopic) * 100);
    }else{
      $read_percent = 0;
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
            <!-- <div class="progress" role="progressbar" aria-label="Example with label" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
              <div class="progress-bar" style="width: {{ $read_percent }}%">{{ $read_percent }}%</div>
            </div>
            <div class="progress-container progress" role="progressbar" aria-label="Example with label" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
              <div class="progress-run"></div>  
            </div>
            <div class="percentage-stats">{{ $read_percent }}%</div>-->
            
              <div class="progress-container" role="progressbar" aria-label="Example with label" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                <div class="progress" style="width: {{ $read_percent }}%"></div>
                <div class="percentage" style="width: 100%">{{ $read_percent }}%</div>  
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
@endsection
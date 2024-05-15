@extends('Front.layouts.layout')
@section('title', 'Exam Builder')

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
</div>
@include('Front.layouts.footer')
@endsection
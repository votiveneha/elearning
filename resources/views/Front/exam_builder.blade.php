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

  $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
  
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
@if($paid_courses && $plan_active)
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
@endsection
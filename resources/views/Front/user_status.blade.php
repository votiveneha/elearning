@extends('Front.layouts.layout')
@section('title', 'User Dashboard')


@section('content')
<div id="main" class="dashboard_main">

      <section  class="topics section-bg mt-0">
      <div class="container p-0">
	  <div class="row wc-txt">
		<h4>
			<span class="page-title-icon text-white me-2">
                  <i class='bx bx-home-alt'></i>
            </span> <b>Welcome Back! <span><?php echo Auth::guard("customer")->user()->name; ?></span></b>
		</h4>
	  </div>
	  
	  <div class="row statis">
              <div class="col-md-3 info-stats stretch-card grid-margin">
                <?php
    
    // $solved_questions = DB::select('select DISTINCT question_id from question_analysis where student_id = ?', [Auth::guard("customer")->user()->id]);
    $solved_questions = DB::table('question_analysis')->distinct()->where("student_id",Auth::guard("customer")->user()->id)->get(['question_id']);
    $total_questions = DB::table('question_bank')->distinct()->get(['q_id']);

    $solved_per = round(count($solved_questions)/count($total_questions)*100);
    $unsolved_per = count($total_questions) - count($solved_questions);
  ?>
                <div class="card bg-gradient-danger card-img-holder text-white">
                  <div class="card-body">
                    <img src="https://mathifyhsc.com/dev/public/assets/img/circle-bg.png" class="card-img-absolute" alt="circle-image">
                    <h4 class="font-weight-normal mb-3">Total Questions <i class='bx bx-book-content'></i>
                    </h4>
                    <h2 class="mb-0">{{ count($total_questions) }}</h2>
                  </div>
                </div>
              </div>
              <div class="col-md-3 info-stats stretch-card grid-margin">
                <div class="card bg-gradient-info card-img-holder text-white">
                  <div class="card-body">
                    <img src="https://mathifyhsc.com/dev/public/assets/img/circle-bg.png" class="card-img-absolute" alt="circle-image">
                    <h4 class="font-weight-normal mb-3">Solved Questions <i class='bx bx-check-circle'></i>
                    </h4>
                    <h2 class="mb-0">{{ count($solved_questions) }}</h2>
                  </div>
                </div>
              </div>
              <div class="col-md-3 info-stats stretch-card grid-margin">
                <div class="card bg-gradient-success card-img-holder text-white">
                  <div class="card-body">
                    <img src="https://mathifyhsc.com/dev/public/assets/img/circle-bg.png" class="card-img-absolute" alt="circle-image">
                    <h4 class="font-weight-normal mb-3">Unsolved Questions <i class='bx bx-window-close'></i>
                    </h4>
                    <h2 class="mb-0">{{ $unsolved_per }}</h2>
                  </div>
                </div>
              </div>
			  <div class="col-md-3 info-stats stretch-card grid-margin">
                <div class="card bg-gradient-success card-img-holder text-white">
                  <div class="card-body">
                    <img src="https://mathifyhsc.com/dev/public/assets/img/circle-bg.png" class="card-img-absolute" alt="circle-image">
                    <?php
                      // $total_hours_spent = DB::table('session_analysis')->where("student_id",Auth::guard("customer")->user()->id)->get();
                      // $time_spent = 0;  
                      // foreach($total_hours_spent as $time){

                      //   if($time->time_spent_seconds != "NaN"){
                      //     $time1 = explode(":",$time->time_spent_seconds);
                      //     if(count($time1)>1){
                      //       $time2 = $time1[0]*60 + $time1[1];
                      //       $time_spent = $time_spent + $time2;
                      //     }
                          
                      //   }
                      // }
                      // $time_spent1 = $time_spent/3600;
                      // $time_spent2 = number_format((float)$time_spent1, 2, '.', '');
                    ?>
                    <h4 class="font-weight-normal mb-3">Total Hours Spent <i class='bx bx-timer'></i>
                    </h4>
                    <h2 class="mb-0">68 hrs</h2>
                  </div>
                </div>
              </div>
            </div>	
 
	   <div class="row stats_score">
		<div class="col-md-12 mb-4">
<script>
window.onload = function () {

var chart = new CanvasJS.Chart("chartContainer", {
  animationEnabled: true,
  theme: "light2",
  title:{
    text: "Progress Score"
  },
  axisX:{
    valueFormatString: "DD MMM",
    crosshair: {
      enabled: true,
      snapToDataPoint: true
    }
  },
  axisY: {
    title: "",
    includeZero: true,
    crosshair: {
      enabled: true
    }
  },
  toolTip:{
    shared:true
  },  
  legend:{
    cursor:"pointer",
    verticalAlign: "bottom",
    horizontalAlign: "left",
    dockInsidePlotArea: true,
    itemclick: toogleDataSeries
  },
  data: [{
    type: "line",
    showInLegend: true,
    name: "",
    markerType: "square",
    xValueFormatString: "DD MMM, YYYY",
    color: "#F08080",
    dataPoints: [
      { x: new Date(2017, 0, 3), y: 650 },
      { x: new Date(2017, 0, 4), y: 700 },
      { x: new Date(2017, 0, 5), y: 710 },
      { x: new Date(2017, 0, 6), y: 658 },
      { x: new Date(2017, 0, 7), y: 734 },
      { x: new Date(2017, 0, 8), y: 963 },
      { x: new Date(2017, 0, 9), y: 847 },
      { x: new Date(2017, 0, 10), y: 853 },
      { x: new Date(2017, 0, 11), y: 869 },
      { x: new Date(2017, 0, 12), y: 943 },
      { x: new Date(2017, 0, 13), y: 970 },
      { x: new Date(2017, 0, 14), y: 869 },
      { x: new Date(2017, 0, 15), y: 890 },
      { x: new Date(2017, 0, 16), y: 930 }
    ]
  },
  {
    type: "line",
    showInLegend: true,
    name: "",
    lineDashType: "dash",
    dataPoints: [
      { x: new Date(2017, 0, 3), y: 510 },
      { x: new Date(2017, 0, 4), y: 560 },
      { x: new Date(2017, 0, 5), y: 540 },
      { x: new Date(2017, 0, 6), y: 558 },
      { x: new Date(2017, 0, 7), y: 544 },
      { x: new Date(2017, 0, 8), y: 693 },
      { x: new Date(2017, 0, 9), y: 657 },
      { x: new Date(2017, 0, 10), y: 663 },
      { x: new Date(2017, 0, 11), y: 639 },
      { x: new Date(2017, 0, 12), y: 673 },
      { x: new Date(2017, 0, 13), y: 660 },
      { x: new Date(2017, 0, 14), y: 562 },
      { x: new Date(2017, 0, 15), y: 643 },
      { x: new Date(2017, 0, 16), y: 570 }
    ]
  }]
});
chart.render();

function toogleDataSeries(e){
  if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
    e.dataSeries.visible = false;
  } else{
    e.dataSeries.visible = true;
  }
  chart.render();
}

}



</script>

      <div id="chartContainer" style="height: 300px; width: 100%;"></div>
<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>

</div>
	  </div>
	  
	  
	  
	  
	  
  <!-- <div class="row">
    <div class="col-md-6">
	<div class="wc-txt">
		<h4><b>User Stats</b></h4>
	</div>
<div class="user-st">

<p> Total Question</p>
<div class="chart-box">
  <div class="w-100">
<div class="d-flex justify-content-between align-content-center w-100">
 <?php
    
    // $solved_questions = DB::select('select DISTINCT question_id from question_analysis where student_id = ?', [Auth::guard("customer")->user()->id]);
    $solved_questions = DB::table('question_analysis')->distinct()->where("student_id",Auth::guard("customer")->user()->id)->get(['question_id']);
    $total_questions = DB::table('question_bank')->distinct()->get(['q_id']);

    $solved_per = round(count($solved_questions)/count($total_questions)*100);
    $unsolved_per = 100 - $solved_per;
  ?>
  <div class="lablo"><label></label> <span>Solved</span>  </div>
  <p>{{ $solved_per }}% </p>
</div>

<div class="d-flex justify-content-between align-content-center w-100">
  <div class="lablo"><label class="px-b"></label> <span>Unsolved</span>  </div>
  <p>{{ $unsolved_per }}% </p>
</div>
</div>

<div class="cirle w-50">
  <section class="circle-chart p-0">
   <svg viewbox="0 0 35.83098862 35.83098862" width="120" height="120" xmlns="http://www.w3.org/2000/svg">
    <circle class="circle-chart__background" stroke="#DAD7FE" stroke-width="4" fill="none" cx="17.91549431" cy="17.91549431" r="15.91549431" />
    <circle class="circle-chart__circle" stroke="#8B84FE" stroke-width="4" stroke-dasharray="{{ $solved_per }},100" stroke-linecap="none" fill="none" cx="17.91549431" cy="17.91549431" r="15.91549431" />
    <g class="circle-chart__info">
      <text class="circle-chart__percent" x="16.91549431" y="16.5" alignment-baseline="central" text-anchor="middle" font-size="8">Solved</text>
      <text class="circle-chart__subline" x="16.91549431" y="21.5" alignment-baseline="central" text-anchor="middle" font-size="3"> Questions</text>
    </g>
  </svg>
</section>
</div>
</div>
</div>
</div>

 <div class="col-md-6">
 <div class="wc-txt">
		<h4><b>Total Hours Spent</b></h4>
	</div>
<div class="user-st">

<div class="chart-box" style="justify-content: center !important;">
<div class="cirle text-center">
 <div class="semi-donut margin" style="--percentage : 80; --fill: #FF9289 ; margin: auto;">
  <p>736<br>
<small>Total Hours</small></p>
</div>
   <p class="mt-3"> Long before you sit down to put the make sure you breathe</p>
</div>
</div>
</div>
</div>




</div> -->

		<div class="row box-stats mt-4">
<!--<div class="col-md-12">
       @if(Session::has('message'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ Session::get('message') }}   
    </div>
@endif
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

 
	<div class="subtext" style="margin-top: 0px;">
    <h4><b>Courses</b></h4>
  </div>

<?php
  $i = 1;
?>
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
                  <a href="{{ url('/user/course_views') }}/{{ base64_encode($c_data->course_id) }}" class="card-link">View</a>
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
  
  // $p_data = $payment_data->invoice_id;
  
  
  // $payment_db_product = $stripe->invoices->retrieve($p_data, [])->lines['data'][0]->plan->product;

                        
  // $product = $stripe->products->retrieve($payment_db_product, []);
  // echo $product->name;
?>
@if($paid_courses)
@foreach($course_data as $c_data)

@if($c_data->status == 1 && $c_data->deleted_at == NULL)
  
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
              <?php
                $payment_db = DB::table("payments")->get();
                $payment_db_product = "";
                foreach ($payment_db as $p_db) {
                    $payment_db_product = $stripe->invoices->retrieve($p_db->invoice_id, [])->lines['data'][0]->plan->product;

                }
                
                
                
              ?>
              
                <div class="btm-infos">
                  <a href="{{ url('/user/course_views') }}/{{ base64_encode($c_data->course_id) }}" class="card-link">View</a>
                </div>
             
            
            </div>
        </div>
      </div></a>
    </div>
  
  
 
  





<?php
  $i++;
?>

@endif

@endforeach
@endif
</div>
   </div>
@include('Front.layouts.footer')
</section>







</div>
@endsection
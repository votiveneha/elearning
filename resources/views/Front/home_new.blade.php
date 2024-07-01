@extends('Front.layouts.landing_layout')
@section('title', 'Home')

@section('current_page_css')
<style type="text/css">
@media (min-width: 320px) and (max-width: 767px) {

  .crve img {
      position: inherit !important;
      top: -49px;
      right: -2%;
      width: 50%;
  }
  .obejt-fit-box img {
      position: relative;
      left: 29px !important;
      width: 100%;
              top: 13px;
  }
}
</style>
@endsection

@section('content')
<section class="baner-section">
    <div class="container">
    <div class="row">
      <div class="col-md-5 top-heading">
        <h2 class="mathify-heading-large pt-5">
       <p>Learn & Revise<br>HSC Maths</p>
     </h2>

     <div class="prea-text">
   <p>   Mathify provides you with everything you need to prepare for your HSC Math exams. Online subtopic quizzes, topic exams, theory booklets and mock papers all on one platform.<br><br>
Our powerful analytics for every question and quiz you complete also allows you to see how you compare to other students.</p>

</div>
<div class="join-btn">
  <a href="{{ url('/register') }}">Sign up for free</a>
</div>

      </div>



 <div class="col-md-7 m-auto">
<div class="monitore-screen">

<img src="{{ url('/public') }}/assets1/img/new_home_banner1.png">

</div>

<h3 class="mathifx-heading3-normal-x">
  <p style="text-align: center;">
            Now Live For Maths Advanced (2U) Year 11 & 12.</p>
          </h3>
</div>




</div>
</div>



  </section>


<section class="mathifxp-size-normal">
  <div class="container">
  <div class="row">
     <div class="col-md-12 ">
      <div class="h-second">
      <h2> With Content Specifically <br> Aligned to the <span>HSC Syllabus</span></h2>
</div>
</div>
</div>
</div>
</section>


<section>
  <div class="container">
  <div class="row">
<div class="col-md-6">
<div class="sytel-cs">

<h2> </h2>

<h3 class="mathifx-heading3-normal"> Theory Booklets That Cover the Entire Course</h3>
<p> Bite - sized online study notes that can condense an entire textbook chapter into just 10 minutes of reading</p>
<ul>
<li><i class='bx bxs-check-circle'></i> No need to write your own notes ever again</li>
<li><i class='bx bxs-check-circle'></i> Concise and easy to digest</li>
<li><i class='bx bxs-check-circle'></i> Covering all year 11 & 12 content. Print versions coming soon.</li>
</ul>

<!-- <a href="#" class="view-simple">View Sample Booklet <i class='bx bx-chevron-right'></i></a> -->
</div>
</div>

<div class="col-md-6 sutdy-sy">
<img src="{{ url('/public') }}/assets1/img/hat-way.png">
</div>





    </div>
  </div>
</section>


<section class="" id="myelement">

  <div class="container">
  <div class="row">

<div class="col-md-6 sutdy-sy">
<img src="{{ url('/public') }}/assets1/img/verti-tab.png">
</div>
<div class="col-md-6">
<div class="sytel-cs">
<h3 class="mathifx-heading3-normal"> Challenging Revision Questions</h3>
<p>Remove the guesswork with questions that actually prepare you for exams. Practice the exact topic & areas you need with our unique mock exam questions, all written by subject experts.</p>
<ul>
<li><i class='bx bxs-check-circle'></i> Rigorously reviewed, HSC - style exam questions</li>
<li><i class='bx bxs-check-circle'></i>With 1500+ questions, never waste time sifting through the internet for questions again</li>
<li><i class='bx bxs-check-circle'></i> Track your performance and results</li>
</ul>

<!-- <a href="#" class="view-simple">Explore Topic Exams</a> -->
</div>
</div>


</div>
</div>

</section>  



<section>
  <div class="container">
  <div class="row">
<div class="col-md-6">
<div class="sytel-cs">
<h3 class="mathifx-heading3-normal"> Build Your Own Customisable Exam</h3>
<p> Mathify allows you to take control of your practice with the ability to mix topics and difficulty level. Our system will generate a unique exam for you each time based on your preferences. Practice, identify your weaknesses and improve. </p>
<ul>
<li><i class='bx bxs-check-circle'></i> Available for all topics</li>
<li><i class='bx bxs-check-circle'></i> Perfect for your Year 11 & 12 term assessments</li>
<li><i class='bx bxs-check-circle'></i> Unlimited access the duration of your subscription</li>
</ul>

<!-- <a href="#" class="view-simple">View Sample Booklet <i class='bx bx-chevron-right'></i></a> -->
</div>
</div>


<div class="col-md-6 sutdy-sy">
<img src="{{ url('/public') }}/assets1/img/verti-tab-2.png">
</div>


    </div>
  </div>
</section>

<section class=" p-0" >


  <div class="container">
  <div class="row" id="myelement-blue">

<div class="col-md-6">
<div class="sytel-cs">
<h3 class="mathifx-heading3-normal-box">Review your performance after every question</h3>
<p>Measure how you perform in every exam, with mock insights that compare your answer to each question with other users</p>
<ul>
<li><i class='bx bxs-check-circle'></i> Every response to our questions & quizzes is recorded on our database to determine the percentage of students that got each question correct</li>
<li><i class='bx bxs-check-circle'></i>Time data also shows how long you spent on each question compared to the average student</li>

</ul>
<!-- 
<a href="#" class="view-simple">Explore Topic Exams</a> -->
</div>
</div>

<div class="col-md-6 sutdy-sy crve">
<img src="{{ url('/public') }}/assets1/img/iPad Mini.png">
</div>
</div>
</div>

</section>  

<section id="bag-bliue">
  <div class="container">
  <div class="row">

<div class="col-md-6 sutdy-sy">
<img src="{{ url('/public') }}/assets1/img/curv-bar.png">
</div>

<div class="col-md-6">
<div class="sytel-cs">
<h3 class="mathifx-heading3-normal"> Complete Worked Solutions</h3>
<p>Unlike standard textbooks, we provide full solutions and explanations for every problem, so you can learn how to maximise your marks and feel more confident after every quiz</p>
<ul>
<li><i class='bx bxs-check-circle'></i> Detailed explanations help you to connect concepts and prepare for any exam</li>
<li><i class='bx bxs-check-circle'></i> Consolidate the material you've already studied</li>
<li><i class='bx bxs-check-circle'></i> Written and reviewed by HSC experts</li>
</ul>

<!-- <a href="#" class="view-simple">View Sample Booklet <i class='bx bx-chevron-right'></i></a> -->
</div>
</div>
    </div>
  </div>
</section>

<section>
  <div class="container">
  <div class="row align-desk">

<div class="col-md-7 sutdy-sy obejt-fit">
<img src="{{ url('/public') }}/assets1/img/OBJECTS.png" >
</div>

<div class="col-md-4">
<div class="sytel-cs">
<h3 class="mathifx-normal-text"> FREE Exam <br>Workshops</h3>
<p>All members get access to our LIVE exam workshops before assessment periods, at no extra cost. 
</p>


<!-- <a href="#" class="view-simple">View Sample Booklet <i class='bx bx-chevron-right'></i></a> -->
</div>
</div>
    </div>
  </div>
</section>

<section class=" p-0" >


  <div class="container">
  <div class="row" id="guarantee_block">

<div class="col-md-6">
<div class="sytel-cs box_grnt">
<h2 class="mathifx-heading3-normal-box">100% Satisfaction guaranteed</h2>
<p>All purchases through our site are covered by our 2 week refund guarantee so you can remain confident you've made the right choice. Simply contact our friendly team anytime within the first 2 weeks of your purchase. </p>

<div class="join-btn">
	<a href="{{ url('/register') }}">Join Now</a>
</div>
<!-- 
<a href="#" class="view-simple">Explore Topic Exams</a> -->
</div>
</div>

<div class="col-md-6 sati_image">
<img src="{{ url('/public') }}/assets1/img/satisfaction.png">
</div>
</div>
</div>

</section>

<section class="review_block" >
	<div class="container">
		<div class="row">
			<div class="head-rev">
				<h2 class="mathifx-heading3-normal-box">Learn why our students love <span>Mathify's</span> extensive HSC platform</h2>
			</div>
		</div>
	</div>
</section>

<section class="testimony">
  <div class="container">
	<div class="row">
		<div class="col-md-4">
			<div class="info--review">
				<div class="rating">
					<span class="checked"><i class='bx bxs-star'></i></span>
					<span class="checked"><i class='bx bxs-star'></i></span>
					<span class="checked"><i class='bx bxs-star'></i></span>
					<span class="checked"><i class='bx bxs-star'></i></span>
					<span class="checked"><i class='bx bxs-star'></i></span>
				</div>
				<div class="info">
					<p>"Having all the content organised into topics and subtopics helped me study exactly what I needed, especially when it came to term assessments when there weren't any papers to practice off"</p>
					<h4>Clover. M</h4>
					<span>Student</span>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="info--review">
				<div class="rating">
					<span class="checked"><i class='bx bxs-star'></i></span>
					<span class="checked"><i class='bx bxs-star'></i></span>
					<span class="checked"><i class='bx bxs-star'></i></span>
					<span class="checked"><i class='bx bxs-star'></i></span>
					<span class="checked"><i class='bx bxs-star'></i></span>
				</div>
				<div class="info">
					<p>"My son found the resources of great help especially when studying for his exams. Being able to study off the worked solutions provided was something he couldn't do with his school textbooks and it helped to greatly improve his marks"</p>
					<h4>Liz. S</h4>
					<span>Parent</span>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="info--review">
				<div class="rating">
					<span class="checked"><i class='bx bxs-star'></i></span>
					<span class="checked"><i class='bx bxs-star'></i></span>
					<span class="checked"><i class='bx bxs-star'></i></span>
					<span class="checked"><i class='bx bxs-star'></i></span>
					<span class="checked"><i class='bx bxs-star'></i></span>
				</div>
				<div class="info">
					<p>"By far the best maths resource I have come across, I only wish I had found it sooner! They have broken down the maths syllabus, and created booklets for each point, filled with practice questions, quizzes, exam tips, worked solutions (for every question) and mock HSC and trial exams"</p>
					<h4>Daniel B.</h4>
					<span>Student</span>
				</div>
			</div>
		</div>
	</div>
  </div>
</section>

<section class="">


  <div class="container">
  <div class="row account-block" id="myelement-blue">

<div class="col-md-6 acct-text">
<div class="sytel-cs box_grnt">
<h2 class="mathifx-heading3-normal-box">Create a free account</h2>
<p>No credit card required. Access our free resources and quizzes</p>

<div class="join-btn">
	<a href="{{ url('/register') }}">Join Now</a>
</div>
<!-- 
<a href="#" class="view-simple">Explore Topic Exams</a> -->
</div>
</div>

<div class="col-md-6 ig-acct">
<img src="https://mathifyhsc.com/public/assets1/img/account.png">
</div>
</div>
</div>

</section>
  
 

<!-- <section class="mathifxp-size-normal pt-3">
  <div class="container">
  <div class="row">
     <div class="col-md-12 mb-5">
      <div class="h-second">
      <h2>More About the Mathify Package</h2>
    </div>
     </div>

<div class="col-md-3">
  <div class="more-coure">
<img src="assets/img/a1z.png">

<div class="coure-name">
Theory Booklets
</div>
</div>
</div>


<div class="col-md-3">
  <div class="more-coure">
<img src="assets/img/a2.png">

<div class="coure-name">
Quizzes & Exams
</div>
</div>
</div>

<div class="col-md-3">
  <div class="more-coure">
<img src="assets/img/a3.png">

<div class="coure-name">
Exam Builder
</div>
</div>
</div>

<div class="col-md-3">
  <div class="more-coure">
<img src="assets/img/a4.png">

<div class="coure-name">
Session Analysis
</div>
</div>
</div>

</div>
</div>
</section> -->



<!-- <section class=" pt-3 adhedbox">
  <div class="container">
  <div class="row">
     <div class="col-md-12 mb-5">
<div class="ready-to">
<h1> Ready To Get Ahead?  </h1>
<h5 class="pt-3">Access Mathify's Specialist Resources <br>Today </h5>

</div>

     </div>
   </div>
 </div>
</section> -->


@endsection
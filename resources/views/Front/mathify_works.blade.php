@extends('Front.layouts.landing_layout')
@section('title', 'Home')

@section('content')
<section class="howit-works">
    
<div class="container">
  <div class="row">
    <div class="col-md-6">
      <div class="mathi-works">
<h2> How <span>MathifyHSC <img src="{{ url('/public') }}/assets1/img/text-wave.png"></span><br> Works</h2>
<p> We believe organisation is key. That’s why we’ve structured every single topic in both Year 11 & 12 into further subtopics.</p>

</div>
</div>
    <div class="col-md-5">
<div class="get-complet">
  <img src="{{ url('/public') }}/assets1/img/n2.png">
<p>Get complete online access to our subtopic study guides, designed to cover every different type of exam question.  </p>

<img src="{{ url('/public') }}/assets1/img/n1.png">
<p>No more need to write your own notes or scour the internet for past paper questions. We have everything all in one place for your convenience with structured resources. </p>

</div>
</div>
</div>
</div>
  </section>


  <section class="within-works">   
<div class="container">
  <div class="row">

<div class="col-md-6">
<div class="subtext">
<h2> Within <span>each subtopic </span> students will find: </h2>

</div>
  <div class="d-flex align-items-start develop-sum">
   <div class="nav flex-column nav-pills
me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical"> 

<button
class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill"
data-bs-target="#v-pills-home" type="button" role="tab"
aria-controls="v-pills-home" aria-selected="true"><img src="{{ url('/public') }}/assets1/img/l1.svg" style="width: 70px;"> A professionally developed summary 
booklet.</button>

 <button
class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill"
data-bs-target="#v-pills-profile" type="button" role="tab"
aria-controls="v-pills-profile" aria-selected="false"><img src="{{ url('/public') }}/assets1/img/l2.svg"> Complete collection of practice exam 
questions testing that EXACT subtopic.</button> 

</div>

 
</div>


</div>

<div class="col-md-6">
<div class="tab-content" id="v-pills-tabContent"> 
  <div class="tab-pane
fade show active" id="v-pills-home" role="tabpanel"
aria-labelledby="v-pills-home-tab"><img src="{{ url('/public') }}/assets1/img/student-find.png"></div> 

<div class="tab-pane fade"
id="v-pills-profile" role="tabpanel"
aria-labelledby="v-pills-profile-tab">...</div>
  </div> 
  </div>
  </div>
</div>
</section>


  <section class="booklet">   
<div class="container">
  <div class="row back-deep">
  <div class="col-5-c">
    <div class="deep-live">
      <h2>Theory <span>Booklet</span> Deep Dive </h2>
      <p> Unlike conventional textbooks, we filter out the fluff to teach you ONLY the content you need to maximise marks. With a focus on exam applications, our booklets show the literal step by step guides to the various types of problems you’ll encounter. You won’t find this anywhere else!</p>

    </div>

    <div class="proble-ex">
      <img src="{{ url('/public') }}/assets1/img/problem-img.png">
<p> Example problems and exercise problems are provided, with solutions to study off.</p>

    </div>

  </div>

  <div class="col-3-w-25">
    <div class="deep-live-center">
    <h3> How do we structure each booklet?</h3>

    <img src="{{ url('/public') }}/assets1/img/live-persion.png">
</div>


  </div>

    <div class="col-5-c">
      
        <div class="proble-ex">
      <img src="{{ url('/public') }}/assets1/img/problem-img.png">
<p> Example problems and exercise problems are provided, with solutions to study off.</p>

    </div>


  <div class="proble-ex">
      <img src="{{ url('/public') }}/assets1/img/problem-img.png">
<p> Example problems and exercise problems are provided, with solutions to study off.</p>

    </div>



    </div>


  </div>
</div>
</section>


 <section class="currently-box">
    
<div class="container">
  <div class="row">
<div class="col-md-12">
  <p> Currently our theory booklets are only available as read-only online PDFs. We are working on offering hardcopy versions which can be delivered to your house!</p>
  <!-- <img src="assets/img/whit-bg.png" style="opacity: 0.5;"> -->
</div>
  </div>
</div>
</section>



 <section class="mocu-bg">   
<div class="container">
  <div class="row">
<div class="col-md-6">

<img src="{{ url('/public') }}/assets1/img/desktop-less.png">
</div>

<div class="col-md-6">
  <div class="mock-question">
  <h5>Our <span> Mock Exam </span> Questions</h5>
  <p> For every single subtopic, we’ve crafted our own unique set of unique mock exam questions that challenge students, preparing them for whatever is thrown at them in exams.</p>

  <div class="shul-icon">

    <h3>How should I complete the  mock exam questions? </h3>
    <ul>
<li><i class='bx bx-chevron-right'></i> When completing one of our quizzes, make sure to complete your working out on your own paper </li>
<li><i class='bx bx-chevron-right'></i>  Once you think you’ve gotten an answer, select the most appropriate option</li>
<li><i class='bx bx-chevron-right'></i> At the end of each quiz, our system will automatically mark your submission based on your selection. </li>
<li><i class='bx bx-chevron-right'></i> For the working out, you can consult our exemplar solutions to ensure you did not lose any other marks for working out</li>
    </ul>


</div>

</div>
</div>
  </div>
</div>
</section>


<section class=" pt-5">
  <div class="container">
  <div class="row">
     <div class="col-md-12 mb-5">
<div class="ready-to-less">

  <img src="{{ url('/public') }}/assets1/img/object.png">
<h1> Custom Exam <span> Builder </span><img src="{{ url('/public') }}/assets1/img/wave.png" class="wave-img"> </h1>
<br>
<p>Finished working through our course content and looking for more? Our exam builder is designed to provide students more opportunities practicing EXACTLY the topic they need. Simply select the topics you wish to practice, the difficulty you wish to be examined on, and the length of the quiz before getting started </p>
 <img src="{{ url('/public') }}/assets1/img/exam-b.png" class="resour-text">
</div>

     </div>
   </div>
 </div>
</section>



  <section class="why-c">   
<div class="container">
  <div class="row overla-ping">


 
  <div class="col-md-4">
<div class="box-verl">
<h5> Full Worked Solutions</h5>
<p>We provide fully worked and explained solutions for EVERY question you find on our platform. Unlike textbooks and the short solutions provided by past papers, our in depth solutions demonstrate exactly what’s required of students, whilst also providing actual explanations for each step. </p>

</div>
  </div>
   <div class="col-md-4">
<div class="box-verl">
<h5> Performance Analysis</h5>
<p>We understand that sometimes it’s hard to measure where you’re at or where you should be. That’s why for every question completed through our online modules, you’ll find out what percentage of other students in your cohort got the same question correct. You’ll also see how long other students take on average!</p>

</div>
  </div>

   <div class="col-md-4">
<div class="box-verl">
<h5> Workshops & More</h5>
<p>We understand that quality live teaching is sometimes irreplacable. Every subscribed member will receive tickets to our HSC maths workshops at ZERO extra cost. </p>

</div>
  </div>
</div>
 <div class="row v-text">
<div class="col-md-5">
<div class="proble-ex proble-ex-tab">
     <center> <img src="{{ url('/public') }}/assets1/img/problem-img.png"></center>
<p style="text-align: center;"> Our online platform redefines how students can learn & prepare for exams. The structured learning materials means that our platform offers everything students need to excel. All that’s left to do is to take the next step.</p>
    </div> 

</div>
<div class="col-md-2">
<img src="{{ url('/public') }}/assets1/img/down-jk.png">
</div>
  <div class="col-md-5">
    <div class="why-scn">
<h1> Why Choose <br> <span>MathifyHSC?</span></h1>
</div>
  
</div>

  </div>
</div>
</section>
@endsection
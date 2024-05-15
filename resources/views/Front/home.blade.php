@extends('Front.layouts.landing_layout')
@section('title', 'Home')

@section('content')
<section class="baner-section">
    <div class="container-fluid">
    <div class="row">
      <div class="col-md-12 top-heading">
        <h2 class="learnworlds-heading-large pt-5">
       <p style="text-align: center;">HSC Maths, <span style="color: rgb(33, 150, 243);">Made Easy</span></p>
     </h2>

      </div>
<div class="prea-text">
   <p>   Get ready to access our full collection of theory booklets, topic exams, quizzes and papers.<br>
Backed by powerful analytics for every question you complete.</p>

</div>
<div class="hsc-baner">
<form action="" method="post">
              <input type="email" name="email" class="learnworlds-input" placeholder="E-mail address">
              <input type="submit" value="Keep me updated" class="subscri-tect">
            </form>

          </div>

 <div class="col-md-10 m-auto">
<div class="monitore-screen">

<img src="{{ url('/public') }}/assets1/img/banner1.png">

</div>
</div>

<h3 class="learnworlds-heading3-normal">
  <p style="text-align: center;">
            Releasing For Maths Advanced (2U) in Early May.</p>
          </h3>


</div>
</div>

<div class="learnworlds-divider-wrapper on-top js-learnworlds-divider js-learnworlds-divider-top js-learnworlds-divider-triangle -learnworlds-divider-triangle lw-brand-fill flip"><svg class="learnworlds-divider" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" preserveAspectRatio="none"><path class="learnworlds-divider-fill js-learnworlds-divider-fill" d="M0,6V0h1000v100L0,6z"></path></svg></div>

  </section>


<section class="learnworlds-size-normal">
  <div class="container">
  <div class="row">
     <div class="col-md-12 ">
      <div class="h-second">
      <h2> Learn why our students love Mathify's 
extensive HSC platform</h2>
</div>
</div>
</div>
</div>
</section>




  <section id="testimonials" class="testimonials section-bg">
      <div class="container" data-aos="fade-up">

        <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
          <div class="swiper-wrapper">

            <div class="swiper-slide">
              <div class="testimonial-wrap">
                <div class="testimonial-item">
                  <img src="{{ url('/public') }}/assets1/img/testimonials/testimonials-1.jpg" class="testimonial-img" alt="">
                  
                  <p>
                  
                    "My son found the resources of great help especially when studying for his exams. Being able to study off the worked solutions provided was something he couldn't do with his school textbooks and it helped to greatly improve his marks"
                 
                  </p>
                  <h3>Liz. S</h3>
                  <h4>STUDENT</h4>
                </div>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-wrap">
                <div class="testimonial-item">
                  <img src="{{ url('/public') }}/assets1/img/testimonials/testimonials-2.jpg" class="testimonial-img" alt="">
                 
                  <p>
                 
                   "By far the best maths resource I have come across, I only wish I had found it sooner! They have broken down the maths syllabus, and created booklets for each point, filled with practice questions, quizzes, exam tips, worked solutions (for every question) and mock HSC and trial exams"
                
                  </p>
                   <h3>Daniel. B</h3>
                  <h4>STUDENT</h4>
                </div>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-wrap">
                <div class="testimonial-item">
                  <img src="{{ url('/public') }}/assets1/img/testimonials/testimonials-3.jpg" class="testimonial-img" alt="">
                 
                  <p>
               
                    "Having all the content organised into topics and subtopics helped me study exactly what I needed, especially when it came to term assessments when there weren't any papers to practice off"
                  
                  </p>
                   <h3>Clover. M</h3>
                  <h4>STUDENT</h4>
                </div>
              </div>
            </div><!-- End testimonial item -->



          </div>
          <div class="swiper-pagination"></div>

           <!-- buttons -->
    <div class="swiper-button-prev"> </div>
    <div class="swiper-button-next"></div>
        </div>

      </div>


  </section><!-- End Hero -->

<section>
  <div class="container">
  <div class="row">
  <div class="col-md-12 top-heading pb-5zx">
        <h2 class="learnworlds-heading-large">
       <p style="text-align: center;">With Content Specifically Aligned to
the <span style="color: rgb(33, 150, 243);">HSC Syllabus</span></p>
     </h2>

      </div>

<div class="col-md-6 sutdy-sy">
<img src="{{ url('/public') }}/assets1/img/s1.png">
</div>

<div class="col-md-6">
<div class="sytel-cs">
<h3 class="learnworlds-heading3-normal"> Study the ins-and-outs with complete theory notes</h3>
<p> Bite - sized theory booklets that can condense an entire textbook chapter into just 10 minutes of reading</p>
<ul>
<li><i class='bx bxs-check-circle'></i> No need to write your own notes ever again</li>
<li><i class='bx bxs-check-circle'></i> Concise and easy to digest</li>
<li><i class='bx bxs-check-circle'></i> Covering all year 11 & 12 content</li>
</ul>

<a href="#" class="view-simple">View Sample Booklet <i class='bx bx-chevron-right'></i></a>
</div>
</div>



    </div>
  </div>
</section>
<br><br><br><br>

<section class="secti1" id="myelement">
<img src="{{ url('/public') }}/assets1/img/trips.png" class="cbvn">

  <div class="container">
  <div class="row">

<div class="col-md-6">
<div class="sytel-cs">
<h3 class="learnworlds-heading3-normal"> Practice Makes Perfect, we have plenty of it</h3>
<p>Remove the guesswork. Quiz yourself with our unique mock exam questions, categorised into topics & subtopics for your convenience</p>
<ul>
<li><i class='bx bxs-check-circle'></i> Rigorously reviewed, HSC - style exam questions</li>
<li><i class='bx bxs-check-circle'></i>With 1200+ questions, never waste time sifting through the internet for questions again</li>
<li><i class='bx bxs-check-circle'></i> Untimed quizzes and timed exams</li>
</ul>

<!-- <a href="#" class="view-simple">Explore Topic Exams</a> -->
</div>
</div>

<div class="col-md-6 sutdy-sy">
<img src="{{ url('/public') }}/assets1/img/s3.png">
</div>
</div>
</div>
<img src="{{ url('/public') }}/assets1/img/botm.png" class="cbvn1">
</section>  

<section class="secti2">
  <div class="container">
  <div class="row">

<div class="col-md-6 sutdy-sy">
<img src="{{ url('/public') }}/assets1/img/s4.png">
</div>

<div class="col-md-6">
<div class="sytel-cs">
<h3 class="learnworlds-heading3-normal"> Custom Exam Builder</h3>
<p> Take control of your practice with the ability to mix topics and difficulty level. Our system will generate a unique exam for you each time based on your preferences.  Practice, identify your weaknesses and improve. </p>
<ul>
<li><i class='bx bxs-check-circle'></i> Available for all 12 topics</li>
<li><i class='bx bxs-check-circle'></i> Perfect for your Year 11 & 12 term assessments</li>
<li><i class='bx bxs-check-circle'></i> Unlimited access the duration of your subscription</li>
</ul>

<!-- <a href="#" class="view-simple">View Sample Booklet <i class='bx bx-chevron-right'></i></a> -->
</div>
</div>



    </div>
  </div>
</section>

<section class="secti3" id="myelement">
<img src="{{ url('/public') }}/assets1/img/trips.png" class="cbvn">

  <div class="container">
  <div class="row">

<div class="col-md-6">
<div class="sytel-cs">
<h3 class="learnworlds-heading3-normal">Review your performance after every question</h3>
<p>Measure how you perform in every exam, with mock insights that compare your answer to each question with other users</p>
<ul>
<li><i class='bx bxs-check-circle'></i> Every response to our questions & quizzes is recorded on our database to determine the percentage of students that got each question correct</li>
<li><i class='bx bxs-check-circle'></i>Time data also shows how long you spent on each question compared to the average student</li>

</ul>

<!-- <a href="#" class="view-simple">Explore Topic Exams</a> -->
</div>
</div>

<div class="col-md-6 sutdy-sy">
<img src="{{ url('/public') }}/assets1/img/4.png">
</div>
</div>
</div>
<img src="{{ url('/public') }}/assets1/img/botm.png" class="cbvn1">
</section>  

<section class="secti4">
  <div class="container">
  <div class="row">

<div class="col-md-6 sutdy-sy">
<img src="{{ url('/public') }}/assets1/img/6.png">
</div>

<div class="col-md-6">
<div class="sytel-cs">
<h3 class="learnworlds-heading3-normal"> Complete Worked Solutions</h3>
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


<section class="secti5" id="myelement">
<img src="{{ url('/public') }}/assets1/img/trips.png" class="cbvn">

  <div class="container">
  <div class="row">

<div class="col-md-6">
<div class="sytel-cs">
<h3 class="learnworlds-heading3-normal">Track Your Progress</h3>
<p>Review your learning progress and make the most of your time. Avoid any missing days and ensure your learning is consistent</p>
<ul>
<li><i class='bx bxs-check-circle'></i> 
Track how many questions you've completed so far</li>
<li><i class='bx bxs-check-circle'></i>See how many hours you've spent each day learning</li>

</ul>

<!-- <a href="#" class="view-simple">Explore Topic Exams</a> -->
</div>
</div>

<div class="col-md-6 sutdy-sy">
<img src="{{ url('/public') }}/assets1/img/tab.png">
</div>
</div>
</div>
<img src="{{ url('/public') }}/assets1/img/botm.png" class="cbvn1">
</section>  


<section class="secti6">
  <div class="container">
  <div class="row">

<div class="col-md-6 sutdy-sy">
<img src="{{ url('/public') }}/assets1/img/dfb.png" style="width: 200px;">
</div>

<div class="col-md-6">
<div class="sytel-cs">
<h3 class="learnworlds-heading3-normal"> FREE Exam Workshops</h3>
<p>All members get access to our LIVE exam workshops before assessment periods, at no extra cost. 
</p>


<!-- <a href="#" class="view-simple">View Sample Booklet <i class='bx bx-chevron-right'></i></a> -->
</div>
</div>
    </div>
  </div>
</section>

<section class="learnworlds-size-normal pt-3 secti7">
  <div class="container">
  <div class="row">
     <div class="col-md-12 mb-5">
      <div class="h-second">
      <h2>More About the Mathify Package</h2>
    </div>
     </div>

<div class="col-md-3">
  <div class="more-coure">
<img src="{{ url('/public') }}/assets1/img/a1z.png">

<div class="coure-name">
Theory Booklets
</div>
</div>
</div>


<div class="col-md-3">
  <div class="more-coure">
<img src="{{ url('/public') }}/assets1/img/a2.png">

<div class="coure-name">
Quizzes & Exams
</div>
</div>
</div>

<div class="col-md-3">
  <div class="more-coure">
<img src="{{ url('/public') }}/assets1/img/a3.png">

<div class="coure-name">
Exam Builder
</div>
</div>
</div>

<div class="col-md-3">
  <div class="more-coure">
<img src="{{ url('/public') }}/assets1/img/a4.png">

<div class="coure-name">
Session Analysis
</div>
</div>
</div>

</div>
</div>
</section>



<section class=" pt-3 adhedbox">
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
</section>
@endsection
@extends('Front.layouts.landing_layout')
@section('title', 'Home')

@section('content')
<section class="learnworlds-size-normal">
  <div class="container-fluid">
  <div class="row">
     <div class="col-md-9 m-auto">
      <div>
  <!-- <center> <h5 class="ther-bok"> Theory Booklets</h5></center>    -->
      <div class="h-second speci-fix">
      <h2>Mock Exam Problems</h2>
      <center><p> Unlike standard textbooks, every one of our questions are designed
to mimic the real questions you'll encounter in assessments</p></center>
</div>
</div>
<style type="text/css">
  .learnworlds-size-normal .row{
   padding-left: 55px;
    padding-right: 55px;
  }
</style>
<center><img src="{{ url('/public') }}/assets1/img/illu7.png" class="w-100"></center>
</div>

<div class="col-md-9 m-auto mt-5">
  <div class="h-second speci-fix">
      <h2>Categorised into Each Topic & Subtopic</h2>
      <center><p class="pt-0"> So you know exactly what you're practicing</p></center>
</div>
</div>

<div class="row pt-5">



<div class="col-md-7 theor-img">
<img src="{{ url('/public') }}/assets1/img/b1.png">

</div>

<div class="col-md-5 theory-box">

<h3>Quizzes for each subtopic</h3>

<div class="booklet-li">
  <ul> 
    <li><i class='bx bxs-check-circle'></i> Exam - style questions that challenge your conceptual understanding
of what you've just learnt</li>
 <li><i class='bx bxs-check-circle'></i> Gain confidence knowing these are the questions you'll see in real exams</li>
 <li><i class='bx bxs-check-circle'></i> Consistently updated & added</li>

  </ul>

</div>
</div>

</div>

<div class="row pt-5">





<div class="col-md-5 theory-box chaleng-rig">

<h3>Challenging Topic Exams</h3>

<div class="booklet-li">
  <ul> 
    <li><i class='bx bxs-check-circle'></i>  Available at the end of each year 11 & 12 topic</li>
 <li><i class='bx bxs-check-circle'></i>Perfect for term assessment preparation</li>
 <li><i class='bx bxs-check-circle'></i> Streamline exam techniques and time management skills</li>

  </ul>

</div>
</div>

<div class="col-md-7 theor-img">
<img src="{{ url('/public') }}/assets1/img/b2.png">

</div>

</div>


<div class="row pt-5">



<div class="col-md-7 theor-img">
<img src="{{ url('/public') }}/assets1/img/b3.png">

</div>

<div class="col-md-5 theory-box">

<h3>Complete Three - Hour Trial Papers</h3>

<div class="booklet-li">
  <ul> 
    <li><i class='bx bxs-check-circle'></i>  Full exam papers that contain the most important question types </li>
 <li><i class='bx bxs-check-circle'></i> Difficult problems to ensure you're prepared for anything</li>

 <li><i class='bx bxs-check-circle'></i> Mock HSC papers also available</li>


  </ul>

</div>
</div>

</div>

<div class="row pt-5">





<div class="col-md-5 theory-box chaleng-rig">

<h3>Worked Solutions.
For Every Question.</h3>

<div class="booklet-li">
  <ul> 
    <li><i class='bx bxs-check-circle'></i>  Each question comes with full mark model answers shown at the end</li>
 <li><i class='bx bxs-check-circle'></i> Written explanations to ensure students understand each logical step</li>
 <li><i class='bx bxs-check-circle'></i> Available for every quiz, exam and mock papers</li>

  </ul>

</div>
</div>

<div class="col-md-7 theor-img">
<img src="{{ url('/public') }}/assets1/img/b4.png">

</div>

</div>

</div>
</div>
</section>

<section class="adhedbox mt-5">
  <div class="container">
  <div class="row">
     <div class="col-md-12 mb-5">
<div class="ready-to">
<h1> Ready To Get Ahead?  </h1>
<h5 class="pt-3">Access Mathify's Specialist Resources <br>Today </h5>

    <div class="hsc-baner-yelo w-75 m-auto mt-4">
    <form action="" method="post" style="width: 100%;">
          <input type="email" name="email" placeholder="E-mail address" class="learnworlds-input-yelo">
          <input type="submit" value="Subscribe for Updates!" class="subscri-tect-yelo">
        </form>
      </div>


</div>



     </div>
   </div>
 </div>
</section>
@endsection
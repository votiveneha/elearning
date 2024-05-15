@extends('Front.layouts.landing_layout')
@section('title', 'Home')

@section('content')
<section class="learnworlds-size-normal">
  <div class="container-fluid">
  <div class="row">
     <div class="col-md-9 m-auto">
      <div>
  <center> <h5 class="ther-bok"> Theory Booklets</h5></center>   
      <div class="h-second speci-fix">
      <h2>Course - Specific Notes Designed
For High Yield Learning</h2>
      <center><p> Switch To Resources That Help You Absorb What's Actually Important</p></center>
</div>
</div>

<center><img src="{{ url('/public') }}/assets1/img/illu11.png" class="w-100"></center>
</div>


<div class="row pt-5">



<div class="col-md-7 theor-img">
<img src="{{ url('/public') }}/assets1/img/x1.png">

</div>

<div class="col-md-5 theory-box">

<h3>Bite-sized booklets for efficient studying</h3>

<div class="booklet-li">
  <ul> 
    <li><i class='bx bxs-check-circle'></i>  Structured theory condenses what used to be an entire chapter into just 10 minutes of reading</li>
 <li><i class='bx bxs-check-circle'></i> Only learn what's important. No more and no less</li>
 <li><i class='bx bxs-check-circle'></i> Access every booklet seamlessly through our online platform</li>

  </ul>

</div>
</div>

</div>

<div class="row pt-5">



<div class="col-md-7 theor-img">
<img src="{{ url('/public') }}/assets1/img/x2.png">

</div>

<div class="col-md-5 theory-box">

<h3>We've got every nook and cranny covered</h3>

<div class="booklet-li">
  <ul> 
    <li><i class='bx bxs-check-circle'></i>  Organised so you don't have to be</li>
 <li><i class='bx bxs-check-circle'></i>Learn exactly what's required of you</li>
 <li><i class='bx bxs-check-circle'></i> Printed hardcopies coming soon...</li>

  </ul>

</div>
</div>

</div>


<div class="row pt-5">



<div class="col-md-7 theor-img">
<img src="{{ url('/public') }}/assets1/img/x3.png">

</div>

<div class="col-md-5 theory-box">

<h3>Step-by-step breakdowns of common questions</h3>

<div class="booklet-li">
  <ul> 
    <li><i class='bx bxs-check-circle'></i>  Step by step worked solutions for you to remember </li>
 <li><i class='bx bxs-check-circle'></i> Adopt the most effective methods for answering exam questions</li>


  </ul>

</div>
</div>

</div>

<div class="row pt-5">



<div class="col-md-7 theor-img">
<img src="{{ url('/public') }}/assets1/img/x4.png">

</div>

<div class="col-md-5 theory-box">

<h3>Over 100+ Booklets</h3>

<div class="booklet-li">
  <ul> 
    <li><i class='bx bxs-check-circle'></i>  Comprehensive coverage so you can leave the guesswork out of learning</li>
 <li><i class='bx bxs-check-circle'></i> Build confidence that you'll be prepared for any exam</li>
 <li><i class='bx bxs-check-circle'></i> Comprehensive coverage so you can leave the guesswork out of learning</li>

  </ul>

</div>
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
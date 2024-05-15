@extends('Front.layouts.landing_layout')
@section('title', 'Home')

@section('content')
<section class="learnworlds-size-normal">
  <div class="container">
  <div class="row">
     <div class="col-md-12 m-auto">
      <div>
      <div class="pricing-head pt-4 pb-4">
     <h3><span> Acing Your Exams</span><br>
     <label>Is Just a Click Away<label></h3>

<p><i class='bx bx-check-circle'></i>  All members will have access to FREE accounts, with an<br> option to upgrade and access all available content</p>

</div>
</div>
</div>

<div class="col-md-12 m-auto about-vb">

<h2> Your Membership At a Glance:</h2>

</div>


<div class="col-md-4 mebrt-text">
<h4> Learn</h4>
<ul>
  <li><i class='bx bxs-check-circle'></i> 100+ theory booklets </li>
   <li><i class='bx bxs-check-circle'></i> Help and support</li>
    <li><i class='bx bxs-check-circle'></i> All Year 11 & 12 content </li>
</ul>



</div>
<div class="col-md-4 mebrt-text">
<h4> Practice</h4>
<ul>
  <li><i class='bx bxs-check-circle'></i> 1500+ questions </li>
   <li><i class='bx bxs-check-circle'></i> Subtopic quizzes</li>
    <li><i class='bx bxs-check-circle'></i> Topic exams </li>
    <li><i class='bx bxs-check-circle'></i> Customisable tests </li>

</ul>


</div>
<div class="col-md-4 mebrt-text">
<h4> Review</h4>
<ul>
  <li><i class='bx bxs-check-circle'></i> Full worked solutions </li>
   <li><i class='bx bxs-check-circle'></i> Cohort data for every question</li>
    <li><i class='bx bxs-check-circle'></i> Session analysis </li>
    <li><i class='bx bxs-check-circle'></i> Topic breakdown</li>
</ul>

</div>


<div class="col-md-12 afford-text pt-5 ">

<h3 class="pb-3"> Mathify's affordable prices level the playing field</h3>
<p>We provide everything you'll need for HSC maths: booklets, question banks, expertly written solutions you won't find anywhere else, exam builder software to practice any topic and performance analysis helping you find your vulnerabilities.</p>

<p>Even as a relatively new company, we're committed to widening access to expert
help and resources for HSC maths.  </p>

<p>Our pricing is simple and affordable, available wherever and whenever you can
get online.</p>
</div>
<?php
  $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
  $product1 = $stripe->products->retrieve('prod_Q64MNNEvhv7i07', []);
  $price = $stripe->prices->retrieve($product1->default_price, []);
  $price_default = $price->unit_amount/100;

  $product2 = $stripe->products->retrieve('prod_Q64NANzl3zhC4s', []);
  $price1 = $stripe->prices->retrieve($product2->default_price, []);
  $price_default1 = $price1->unit_amount/100;

  $product3 = $stripe->products->retrieve('prod_Q64OVqbEf4P8mq', []);

  $price2 = $stripe->prices->retrieve($product3->default_price, []);
  $price_default2 = $price2->unit_amount/100;

  $user_email = Auth::guard("customer")->user()->email;

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



  $active_plan = $in_array[0]["plan"];
  $plan_end = $in_array[0]["plan_end"]."<br>";
  $current_date = date('m/d/Y h:i:s', time());
  $date = strtotime($current_date); 

  if($plan_end > $date){
    $plan_active = true;
  }
?>
<style>
.prices-level.active {
    border: 3px solid #0098ef; 
   
}

.subscribe_active {
  
  cursor: not-allowed; 
}
</style>
<div class="col-md-4">
  <div class="prices-level @if($active_plan == $product1->name && $plan_active) active @endif">
<h5>{{ $product1->name }}</h5>

<h1>${{ $price_default }}/Month</h1>
<p>Billed monthly as ${{ $price_default }}</p>

<a href="https://buy.stripe.com/test_00g2ap3fdfivfT29AD" class="@if($active_plan == $product1->name && $plan_active) subscribe_active @endif">Subscribe</a>
</div>  
</div>

<div class="col-md-4">
  <div class="prices-level @if($active_plan == $product2->name && $plan_active) active @endif">
<h5>{{ $product2->name }}</h5>

<h1>${{ $price_default1 }}/Six Month</h1>
<p>Billed every 6 months as ${{ $price_default1 }}</p>

<a href="https://buy.stripe.com/test_9AQeXb175fiv7mw3cg" class="@if($active_plan == $product2->name && $plan_active) subscribe_active @endif">Subscribe</a>
</div>  
</div>

<div class="col-md-4">
  <div class="prices-level @if($active_plan == $product3->name && $plan_active) active @endif">
<h5>{{ $product3->name }}</h5>

<h1>${{ $price_default2 }}/Year</h1>
<p>Billed every 1 Year as ${{ $price_default2 }}</p>

<a href="https://buy.stripe.com/test_cN2g1f1756LZ0Y88wy" class="@if($active_plan == $product3->name && $plan_active) subscribe_active @endif">Subscribe</a>
</div>  
</div>
<!-- <script async src="https://js.stripe.com/v3/pricing-table.js"></script>
<stripe-pricing-table pricing-table-id="prctbl_1PGFWrF36dkxk0XmcNPZ041C"
publishable-key="pk_test_51MY6QMF36dkxk0XmJOpfxK2AZcLfcx8xI7CEMSEF1nNPIVKsJ6JYKly02iqxP3ppxfNvt28ORlwM4Wi78TroccFj00OsTpzuw6">
</stripe-pricing-table> -->

</div>


</div>

</section>

<section class="naver-stop">
  <div class="container">
  <div class="row">
<div class="col-md-12">
  <div class="stop-omprov">
  <h2> Never stop improving your score, with<br>
1500+ HSC Math Questions</h2>
<p> Each HSC question comes with fully worked solutions, time - taken<br>
data, and comparison to how others responded.</p>

<div class="grnee-btn">

<i class='bx bx-check'></i>
We take the quality of our questions and solutions very seriously. We continually edit and update our questions based off user feedback to improve any explanation or fix any problems. Users can easily contact us at anytime to leave any feedback

</div>

</div>
</div>
</div>
</div>


</section>
@endsection
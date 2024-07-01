@extends('Front.layouts.landing_layout')
@section('title', 'pricing')

@section('current_page_js')

@endsection

@section('content')
<section class="learnworlds-size-normal" style="padding: 120px 0;">
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
  $stripe = new \Stripe\StripeClient('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');
  $product1 = $stripe->products->retrieve('prod_Q7MAzTXMC8sHkv', []);
  
  $price = $stripe->prices->retrieve($product1->default_price, []);

  $price_default = $price->unit_amount/100;

  $product2 = $stripe->products->retrieve('prod_Q6X8MuJXVZ6si0', []);
  $price1 = $stripe->prices->retrieve($product2->default_price, []);

  $price_default1 = $price1->unit_amount/100;

  $product3 = $stripe->products->retrieve('prod_QMK3MsBa5dQLNN', []);



  $price2 = $stripe->prices->retrieve($product3->default_price, []);
  $price_default2 = $price2->unit_amount/100;



  $user = Auth::guard("customer")->user();

  if($user){
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
      $active_plan = "";
    }

    
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
  <div class="prices-level @if($user) @if($active_plan == $product1->name && $plan_active) active @endif @endif">
  @if($price->recurring->interval_count == 1 && $price->recurring->interval == "month")  
<h5>Monthly Subscription</h5>
@endif
<h1>${{ $price_default }}/Month</h1>
<p>Billed monthly as ${{ $price_default }}</p>
<?php
  $user = Auth::guard("customer")->user();
  $plan_data = array("interval_count"=>$price->recurring->interval_count,"interval"=>$price->recurring->interval,"price_default"=>$price_default);

?>
@if($user)
<a href="https://buy.stripe.com/5kAcOB1NJdiobvi4gj" class="@if($active_plan == $product1->name && $plan_active) subscribe_active @endif monthly_subscription" onclick="suscribe_plan('{{ $user->id }}','{{ $user->name }}','{{ $user->email }}','{{ $price->recurring->interval_count }}','{{ $price->recurring->interval }}','{{ $price_default }}')">Purchase Now</a>

@else
<a href="{{ url('/login') }}">Get started for free</a>
@endif

</div>  
</div>

<div class="col-md-4">
  <div class="prices-level @if($user) @if($active_plan == $product2->name && $plan_active) active @endif @endif">

    @if($price1->recurring->interval_count == 6 && $price1->recurring->interval == "month")
    
<h5>Bi-Annual Subscription</h5>
@endif
<h1>${{ $price_default1 }}/Six Month</h1>
<p>Billed every 6 months as ${{ $price_default1 }}</p>

@if($user)
<a href="https://buy.stripe.com/6oEbKxdwr5PWbvieUY" class="@if($active_plan == $product2->name && $plan_active) subscribe_active @endif" onclick="suscribe_plan('{{ $user->id }}','{{ $user->name }}','{{ $user->email }}','{{ $price1->recurring->interval_count }}','{{ $price1->recurring->interval }}','{{ $price_default1 }}')">Purchase Now</a>
@else
<a href="{{ url('/login') }}">Get started for free</a>
@endif

</div>  
</div>

<div class="col-md-4">
  <div class="prices-level @if($user) @if($active_plan == $product3->name && $plan_active) active @endif @endif">
    @if($price2->recurring->interval_count == 3 && $price2->recurring->interval == "month")
<h5>3 Month Special Offer</h5>
@endif
<h1>${{ $price_default2 }}</h1>
<p>25% OFF Regular Price</p>
@if($user)
<a href="https://buy.stripe.com/aEU01P63Zcek6aY8wC" class="@if($active_plan == $product3->name && $plan_active) subscribe_active @endif" onclick="suscribe_plan('{{ $user->id }}','{{ $user->name }}','{{ $user->email }}','{{ $price2->recurring->interval_count }}','{{ $price2->recurring->interval }}','{{ $price_default2 }}')" class="btn btn-danger" style="background: #d9534f;">Purchase Now</a>
@else
<a href="{{ url('/login') }}" class="btn btn-danger" style="background: #d9534f;">Get started for free</a>
@endif

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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script type="text/javascript">
  function suscribe_plan(user_id,user_name,user_email,interval_count,interval,price_default){
    
    sessionStorage.setItem("user_id", user_id);
    sessionStorage.setItem("user_name", user_name);
    sessionStorage.setItem("user_email", user_email);
    sessionStorage.setItem("interval_count", interval_count);
    sessionStorage.setItem("interval", interval);
    sessionStorage.setItem("price_default", price_default);
  //   $.ajax({
  //   type: "GET",
  //   url: "{{ url('user/store_data') }}",
  //   data: {user_id:user_id,user_name:user_name,user_email:user_email,interval_count:interval_count,interval:interval,price_default:price_default,payment_status:"Pending"},
  //   cache: false,
  //   success: function(data){
  //      //$("#resultarea").text(data);
  //   }
  // });
  }
  
</script>
@endsection
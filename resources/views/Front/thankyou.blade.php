@extends('Front.layouts.landing_layout')
@section('title', 'Home')

@section('current_page_js')

@endsection

@section('content')

<style type="text/css">
 .backg-side {
    background-color: #2670d7;
    height: 100vh;
    display: flex;
    align-items: center;
}
.mathfly-side{
  padding: 40px;
      color: #FFF;
}
.thankyou {
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}
.thanky-box {
    padding: 10px;
    text-align: center;
}

.mathfly-side h4{
color: #FFF;
font-size: 18px;
}
.mathfly-side h4 span {
    margin-right: 10px;
    text-transform: capitalize;
}
</style>
<section class="learnworlds-size-normal">
  <div class="container-fluid">
  <div class="row">
<div class="col-md-6 backg-side">

<div class="mathfly-side">
<div class="price-infor mt-5">

<h4>
Subscribed to <span class="monthly_plan"></span></h4>
<!-- <h3 class="price"><sup><small>per<span class="interval"></span>
</small></sup></h3> -->


</div>
<div class="user-oinofor">
<h4><span>Student name- </span><?php echo Auth::guard('customer')->user()->name; ?> </h4>
<h4><span>Email- </span><?php echo Auth::guard('customer')->user()->email; ?> </h4>


</div>


</div>
</div>


<div class="col-md-6">
<div class="thankyou">
<div class="thanky-box">
 <header class="site-header">
 	<img src="https://www.shutterstock.com/image-vector/valid-seal-icon-blue-tick-600nw-775336747.jpg" style="width:100px;">
    <h1 class="site-header_title">THANK YOU <?php echo Auth::guard("customer")->user()->name; ?> </h1>
  </header>

  <div class="main-content">
    <i class="fa fa-check main-content_checkmark"></i>
    <p class="main-content_body">Your plan has been purchased</p>
    <a href="{{ url('/user/dashboard') }}" class="btn btn-primary">Go To Dashboard</a>
  </div>
</div>

</div>

</div>










</div>


</div>
</div>
</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script type="text/javascript">
	var user_id = sessionStorage.getItem("user_id");
	var user_name = sessionStorage.getItem("user_name");

	var user_email = sessionStorage.getItem("user_email");
	var interval_count = sessionStorage.getItem("interval_count");
	var interval = sessionStorage.getItem("interval");
	var price_default = sessionStorage.getItem("price_default");
    if(interval == "month" && interval_count == "1"){
    	//console.log("price_default",parseFloat(price_default).toFixed(2));
    	$(".monthly_plan").html("Monthly Plan");
    	$(".price").html("$"+parseFloat(price_default).toFixed(2)+" per "+interval);
    	$(".interval").html(interval);
    }
    if(interval == "month" && interval_count == "6"){
    	//console.log("price_default",parseFloat(price_default).toFixed(2));
    	$(".monthly_plan").html("Biannual Plan");
    	$(".price").html("$"+parseFloat(price_default).toFixed(2)+" per "+interval_count+" "+interval);
    	$(".interval").html(interval);
    }
    if(interval == "year" && interval_count == "1"){
    	//console.log("price_default",parseFloat(price_default).toFixed(2));
    	$(".monthly_plan").html("Annual Plan");
    	$(".price").html("$"+parseFloat(price_default).toFixed(2)+" per "+interval);
    	$(".interval").html(interval);
    }
	
	$(".subtotal").html(price_default);
	$(".total").html(price_default);
	console.log("user_data",user_id); 
	$.ajax({
	  type: "GET",
	  url: "{{ url('user/store_data') }}",
	  data: {user_id:user_id,user_name:user_name,user_email:user_email,interval_count:interval_count,interval:interval,price_default:price_default},
	  cache: false,
	  success: function(data){
	     //$("#resultarea").text(data);
	  }
	});
</script>

@endsection
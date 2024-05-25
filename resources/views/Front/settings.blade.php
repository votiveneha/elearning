@extends('Front.layouts.layout')
@section('title', 'User Dashboard')

@section('current_page_css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
<style type="text/css">
  #toast-container > div{
    width:311px;
  }
</style>
@endsection

@section('current_page_js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
<script type="text/javascript">
  $(".cancel_subscription").click(function(){
    var customer_id = "<?php echo Auth::guard("customer")->user()->id; ?>"
    $.ajax({
      type: "POST",
      url: "{{ url('user/cancel_subscription') }}",
      data: {customer_id:customer_id,"_token": "{{ csrf_token() }}"},
      cache: false,
      success: function(data){
         if(data == 1){
          toastr.options.timeOut = 1500; // 1.5s
          toastr.success('Suscription cancalled Successfully');
          $(".cancel_subscription").hide();
          $(".subscription_plan_textbox").val("None");
         }
         
      }
    });
  });
</script>
@endsection


@section('content')
<div id="main">

      <section  class="topics setting_set section-bg pt-5">
      <div class="container">
   <div class="row">
    <div class="col-md-12">
<div class="chose-q user-detal">
   <div class="mb-4"> <h4 class="mb-1 p-0"><b>Settings </b></h4>
            <p style="color: #256ad6;"> User Details</p>
            <form action="{{ url('/user/profile_action') }}" id="course_form" method="post" enctype="multipart/form-data" class="w-50-half ">
                      {!! csrf_field() !!}
               <input type="hidden" name="id" class="form-control" placeholder="" value="<?php echo $user_data->id;?>">
              <div class="mt-3">
              <label>First Name</label>
              <input type="text" name="first_name" class="form-control" placeholder="" value="<?php echo $user_data->first_name;?>"></div>
              <div class="mt-3">
              <label>Last Name</label>
              <input type="text" name="last_name" class="form-control" placeholder="" value="<?php echo $user_data->last_name;?>"></div>
               <div class="mt-3">
              <label>Upload Image</label>
              <input type="file" name="profile_img" class="form-control">
               @if($user_data->profile_img !="")
              <img class="img-responsive" src="{{ url('/public/uploads/users') }}/{{$user_data->profile_img}}" width="50px;" alt="profile_img">
              @endif
           </div>
               <div class="mt-3">
              <label>Email Address </label>
              <input type="text" class="form-control" placeholder="danny@domain.com" value="<?php echo $user_data->email;?>" disabled></div>
              <div class="mt-3">
                 <p style="color: #256ad6; margin: 0;">Payment Details</p>
              <label>Subscription</label>
              <?php
                $get_subscription = DB::table("payments")->where("customer_email",$user_data->email)->first();
                $user_data = DB::table("users")->where("email",$user_data->email)->first();
                
                if(empty($get_subscription) || $get_subscription->payment_status == "Cancelled"){
                  $plan_name = "None";
                }else{
                  if($get_subscription->plan_name == "1 month"){
                    $plan_name = "Monthly Plan";
                  }
                  if($get_subscription->plan_name == "6 month"){
                    $plan_name = "Biannual Plan";
                  }
                  if($get_subscription->plan_name == "1 year"){
                    $plan_name = "Annual Plan";
                  }
                }
                
                
              ?>
              <input type="text"  class="form-control subscription_plan_textbox" value="{{ $plan_name }}" readonly=""></div>
               <br>
               <input type="submit" class="btn btn-primary" value="Update Profile" id="">
               @if($plan_name != "None")
               <input type="button" class="btn btn-danger cancel_subscription" value="Cancel Subscription"  style="float:right;">
               @endif
            </form>
</div>
</div>

 <!-- <div class="foter-suport">    
          <h3> <p> Contact Support </p>
          <small>sales@mathify.com </small></h3>
        </div> -->
</div>
</div>
   </div>
@include('Front.layouts.footer')
</section>
</div>
@endsection
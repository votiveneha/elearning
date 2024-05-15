@extends('Front.layouts.layout')
@section('title', 'Login')

@section('current_page_css')
<style type="text/css">
  form .error {
    color: #ff0000;
  }
  form .input {
    width: 100% !important;
  }
</style>
@endsection

@section('current_page_js')
<script type="text/javascript">
  // Wait for the DOM to be ready
$(function() {
  // Initialize form validation on the registration form.
  // It has the name attribute "registration"
  $("form[name='registration']").validate({
    // Specify validation rules
    rules: {
      // The key name on the left side is the name attribute
      // of an input field. Validation rules are defined
      // on the right side
      name:{
        required:true,
        normalizer: function( value ) {
          return $.trim( value );
        }
      },
      
      email: {
        required: true,
        // Specify that email should be validated
        // by the built-in "email" rule
        normalizer: function( value ) {
          return $.trim( value );
        },
        
        email: true
      },
      password: {
        required: true,
        minlength: 8
      },
      c_password: {
        required: true,
        minlength: 8,
        equalTo: "#password"
      }
    },
    // Specify validation error messages
    messages: {
      name: "Please enter the name",
      
      password: {
        required: "Please enter a password",
        minlength: "Password must be at least 8 characters long"
      },
      email:{
        required: "Please enter the email",
        email:  "Please enter a valid email address"
      },
      c_password: {
        required: "Please enter the confirm password",
        minlength: "Password must be at least 8 characters long",
        equalTo: "Passwords must be same"
      }
    },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function(form) {
      form.submit();
    }
  });
});
</script>
@endsection

@section('content')
<!-- ======= About Section ======= -->
    <section>
      <div class="container loinpage">
        <div class="row centr-form">
        <div class="col-md-5 login-screen-main">
          <div class="login-screen">
          <h3><img src="{{ url('/public') }}/assets/img/logo.png"> </h3>
          <h5>Sign Up with Mathify</h5>
          @if (\Session::has('error'))
              <div class="alert alert-danger">
                  {!! \Session::get('error') !!}
              </div>
          @endif
          @if (\Session::has('success'))
              <div class="alert alert-success">
                  {!! \Session::get('success') !!}
              </div>
          @endif
          <form method="post" action="{{ url('/submit_registration') }}" name="registration">
            @csrf
           <div class="input-group favi-can">
             <i class='bx bx-user'></i>
                <input type="text" name="name" class="form-control input" placeholder="What's your name?"/>
              </div>
             
              
           <div class="input-group favi-can">
              <i class='bx bx-envelope'></i>
                <input type="email" name="email" class="form-control input" placeholder="What's your e-mail?"/>
              </div>
              
            
                  <div class="input-group favi-can">
                 <i class='bx bx-lock-open'></i>
                  <input type="password" name="password" id="password" class="form-control input" placeholder="Your password?"/>
              </div>
             
              <div class="input-group favi-can">
                 <i class='bx bx-lock-open'></i>
                  <input type="password" name="c_password" class="form-control input" placeholder="Enter it once more, please"/>
              </div>
             <!-- <div class="input-group favi-can">
              <label for="Choose a Subscription">Choose a Subscription</label>
              <div class="suscription_radio">
                <?php
                  $monthly_plan = $stripe->products->retrieve('prod_Q64MNNEvhv7i07', []);
                  $monthly_price = $stripe->prices->retrieve($monthly_plan->default_price, []);
                  $monthly_amount = "$".number_format((float)$monthly_price->unit_amount/100, 2, '.', '');

                  $biannual_plan = $stripe->products->retrieve('prod_Q64NANzl3zhC4s', []);
                  
                  $biannual_price = $stripe->prices->retrieve($biannual_plan->default_price, []);
                  
                  $biannual_amount = "$".number_format((float)$biannual_price->unit_amount/100, 2, '.', '');

                  $annual_plan = $stripe->products->retrieve('prod_Q64OVqbEf4P8mq', []);
                  $annual_price = $stripe->prices->retrieve($annual_plan->default_price, []);
                  
                  $annual_amount = "$".number_format((float)$annual_price->unit_amount/100, 2, '.', '');
                  
                  
                ?>
                <div class="suscription">
                  <input type="radio" name="subscription" value="free"><label>Free</label>
                </div>
                <div class="suscription">
                  <input type="radio" name="subscription" value="monthly_subscription"><label>{{ $monthly_plan->name }}({{ $monthly_amount }} {{ $monthly_price->currency }}/{{ $monthly_price->recurring->interval }})</label>
                </div>
                <div class="suscription">
                  <input type="radio" name="subscription" value="biannual_subscription"><label>{{ $biannual_plan->name }}({{ $biannual_amount }} {{ $biannual_price->currency }}/{{ $biannual_price->recurring->interval_count }} {{ $biannual_price->recurring->interval }})</label>
                </div>
                <div class="suscription">
                  <input type="radio" name="subscription" value="annual_subscription"><label>{{ $annual_plan->name }}({{ $annual_amount }} {{ $annual_price->currency }}/{{ $annual_price->recurring->interval }})</label>
                </div>
              </div>
             </div>  -->
            <!-- <div class="d-flex justify-content-between rem-pass mb-3">

            <div class="checkbox">
            <label class="pri-txt"><input type="checkbox" value="" style="position: relative; top: 4px;"> I agree to the <a href="#">Terms</a> of Use and <a href="#"> Privacy Notice</a> </label>
            </div>
       

          </div>
          <br> -->
              <button type="submit" class="btn btn-success login-btn"><span class="glyphicon glyphicon-off"></span> Start your learning journey</button>
              <div class="dont-asc mt-3">
           <p class="m-0 mb-2"> Already Have an account</p>
           <a href="{{ url('/login') }}" style="color: #2571d7;"> Click here to login</a>

   </div>
         
          </form>


          
      </div>
      </div>
      </div>
    </section>

    <!-- End About Section -->
@endsection
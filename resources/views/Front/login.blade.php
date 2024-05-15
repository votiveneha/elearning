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
  $("form[name='login']").validate({
    // Specify validation rules
    rules: {
      // The key name on the left side is the name attribute
      // of an input field. Validation rules are defined
      // on the right side
      
      
      email: {
        required: true,
        // Specify that email should be validated
        // by the built-in "email" rule
        email: true
      },
      password: {
        required: true,
        minlength: 8
      }
    },
    // Specify validation error messages
    messages: {
      
      password: {
        required: "Please enter a password",
        minlength: "Password must be at least 8 characters long"
      },
      email:{
        required: "Please enter the email",
        email:  "Please enter a valid email address"
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
          <h5> Sign in with Mathify</h5>
          @if (\Session::has('error'))
              <div class="alert alert-danger">
                  {!! \Session::get('error') !!}
              </div>
          @endif
          <form action="{{ url('/submit_login') }}" id="" method="post" name="login">
                      @csrf
           <div class="input-group favi-can">
              <i class='bx bx-envelope'></i>
                <input type="text" name="email" class="form-control input" placeholder="What's your e-mail?"/>
              </div>
         
                  <div class="input-group favi-can">
                 <i class='bx bx-lock-open'></i>
                  <input type="Password" name="password" class="form-control input" placeholder="Your password?"/>
              </div>
            <!-- <div class="d-flex justify-content-between rem-pass">
            <div class="checkbox">
              <label class="d-flex align-items-center"><input type="checkbox" value=""/> Remember me</label>
            </div>
         <p> <a href="#">Forgot Password?</a></p>

          </div> -->

              <button type="submit" class="btn btn-success login-btn"><span class="glyphicon glyphicon-off"></span> Login</button>
            <div class="dont-asc mt-3">
           <p class="m-0 mb-2"> Don't have an account?</p>
           <a href="{{ url('/register') }}" style="color: #2571d7;"> Click here to register</a>

   </div>
          


          
      </div>
      </div>
      </div>
    </section>

    <!-- End About Section -->
@endsection
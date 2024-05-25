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
 #term_conditions-error {
    position: relative;
    top: 41px;
}

.terms_label1 {
    margin-top: -22px !important;
    line-height: 19px;
    font-size: 15px;
}

.login-btn {
    width: 100%;
    background: linear-gradient(90deg, rgb(37 112 215) 0%, rgb(37 128 217) 49%, rgb(36 165 222) 100%);
    border: 0px solid #256cd6;
    padding: 10px;
    transition: 0.5s;
    position: relative;
    top: 12px;
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
      },
      term_conditions: {
        required: true,
        normalizer: function( value ) {
          return $(".terms_label").addClass("terms_label1");
        },
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
      },
      term_conditions: {
        required: "Please check our terms & condition",
        
      }
    },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function(form) {
      $(".term_conditions-error").insertAfter(".terms_label");
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
              <div class="input-group">
                 
                <input id="checkbox" type="checkbox" name="term_conditions" style="height:auto !important;" />
                <label for="checkbox" class="terms_label" style="margin-left: 22px;margin-top: -18px;text-align: left;"> By creating an account, you agree to the <a href="{{ url('/terms') }}">Terms and Conditions</a>.</label>
              </div>
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
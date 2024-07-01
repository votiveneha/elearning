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
          <?php
            $email_management = DB::table("email_management")->where('email_management_id','1')->first();
          ?>
          <!-- <h5>A confirmation email is on its way. To continue, check your email, and follow the activation link.</h5>
          
          <p>
            You can do this anywhere, e.g. on your phone.If you use the browser you're on now it will remember you.
          </p>
          <p>After this, you'll be able to buy a course and start preparing.</p> -->
          {!! $email_management->email_confirmation_page !!}
          

          
      </div>
      </div>
      </div>
    </section>

    <!-- End About Section -->
@endsection
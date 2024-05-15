<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Mathify | Login</title>

  <!-- Google Font: Source Sans Pro -->
    <!-- Favicons -->
  <link href="{{ url('/public') }}/assets/img/favicon.png" rel="icon">
  <link href="{{ url('/public') }}/assets/img/apple-touch-icon.png" rel="apple-touch-icon">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ url('/') }}/public/design/admin/plugins/fontawesome-free/css/all.min.css">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ url('/') }}/public/design/admin/css/adminlte.min.css">
  <style type="text/css">
  form .error {
    color: #ff0000;
  }
  form .input {
    width: 100% !important;
  }
</style>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="../../index2.html" class="h1"><img src="{{ url('/public') }}/assets/img/logo.png"></a>
    </div>
    <div class="card-body">
        <p class="login-box-msg">
            Sign in to start your session
        </p>
        @if (Session::has('message'))
        <span class="login-box-msg" style="text-align: center;">
            <strong style="color:#FF0000">{{ Session::get('message') }}</strong>
        </span>
        @endif

        <form  role="form" id="login" name="login" method="POST" action="{{ url('/admin/login') }}">
               {{ csrf_field() }}
            <div class="input-group mb-3">
                <input type="email" class="form-control" name="email" placeholder="Email">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                    </div>
                </div>
            </div>
            <div class="input-group mb-3">
                <input type="password" class="form-control" name="password" placeholder="Password">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
                @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
                @endif
            </div>
        <div class="row">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>

        </div>
      </form>

    <!--   <div class="social-auth-links text-center mt-2 mb-3">
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
        </a>
      </div> -->
      <!-- /.social-auth-links -->

      <!-- <p class="mb-1">
        <a href="forgot-password.html">I forgot my password</a>
      </p>
      <p class="mb-0">
        <a href="register.html" class="text-center">Register a new membership</a>
      </p> -->
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->

<script src="{{ url('/') }}/public/design/admin/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{ url('/') }}/public/design/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
</body>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
<script type="text/javascript">
$(function() {
  $("form[name='login']").validate({
    rules: {
     email: {
        required: true,
        email: true
      },
      password: {
        required: true,
      }
    },
    // Specify validation error messages
    messages: {
      
      password: {
        required: "Please enter a password",
      },
      email:{
        required: "Please enter the email",
        email:  "Please enter a valid email address"
      }
    },
 
    submitHandler: function(form) {
      form.submit();
    }
  });
});
</script>
</html>

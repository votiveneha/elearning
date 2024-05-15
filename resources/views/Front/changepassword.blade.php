
@extends('Front.layouts.layout')
@section('title', 'User Dashboard')
@section('current_page_css')
<style type="text/css">
  form .error {
    color: #ff0000;
  }
  form .input {
    width: 100% !important;
  }
</style>

@section('content')
<div id="main">

      <section  class="topics section-bg pt-5">
      <div class="container">
   <div class="row">
    <div class="col-md-12">
<div class="chose-q user-detal">
   <div class="mb-4"> <h4 class="mb-1 p-0"><b>Change Password </b></h4>
   	    @if(Session::has('success_message'))
        <div class="alert alert-success alert-dismissable">
          <i class="fa fa-check"></i>
          {{Session::get('success_message')}}
        </div>
      @endif
      @if(Session::has('error_message'))
        <div class="alert alert-danger alert-dismissable">
          <i class="fa fa-check"></i>
          {{Session::get('error_message')}}
        </div>
      @endif
         <p style="color: #256ad6;"> User Details</p>
            <form action="{{ url('/user/change_password') }}" name="change_password" method="post" enctype="multipart/form-data" class="w-50-half ">
                      {!! csrf_field() !!}
              
              <div class="mt-3">
              <label>Old Password</label>
              <input type="password" name="old_password" class="form-control" placeholder="" >
          </div>
                       <div class="mt-3">

              <label>New Password</label>
              <input type="password" name="password" id="password" class="form-control" placeholder="" >
              @if($errors->has('password'))
                           <div class="text-danger">{{ $errors->first('password') }}</div>
                        @endif</div>
              <div class="mt-3"></div>
              
             
              <div class="mt-3">
              <label>Confirm New Password</label>
              <input type="password"  name="confirm_password" class="form-control" placeholder=""></div>
               <br>
              <input type="submit" class="btn btn-primary" value="Change Password" id="">


            </form>
</div>
</div>

 <div class="foter-suport">    
          <h3> <p> Contact Support </p>
          <small>sales@mathify.com </small></h3>
        </div>
</div>
</div>
   </div>

</section>
</div>
@endsection

@section('current_page_js')

<script type="text/javascript">

$(function() {
  $("form[name='change_password']").validate({
    rules: {
      old_password: "required",
      password: {
        required: true,
        minlength: 8
      },
      confirm_password: {
        required: true,
        minlength: 8,
        equalTo: "#password"
      }
    },
    messages: {
      old_password: "Please enter old name",
      password: {
        required: "Please enter a password",
        minlength: "Password must be at least 8 characters long"
      },
      confirm_password: {
        required: "Please enter the confirm password",
        minlength: "Password must be at least 8 characters long",
        equalTo: "Passwords must be same"
      }
    },
    submitHandler: function(form) {
      form.submit();
    }
  });
});
</script>

@endsection

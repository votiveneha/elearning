@extends('Front.layouts.layout')
@section('title', 'Change Password')


@section('content')
<div id="main">

      <section  class="topics section-bg pt-5">
      <div class="container-fluid">
   <div class="row">
    <div class="col-md-12">
<div class="chose-q user-detal">
   <div class="mb-4"> <h4 class="mb-1 p-0"><b>Change Password </b></h4>
            
            <form action="{{ url('/user/postuser_ChangePassword') }}" class="w-50-half ">
              <div class="mt-3">
              <label>Old Password</label>
              <input type="password" name="" class="form-control" placeholder="Danny"></div>
              <div class="mt-3">
              <label>New Password</label>
              <input type="password" name="" class="form-control" placeholder="Lau">
            @if($errors->has('password'))
                           <div class="text-danger">{{ $errors->first('password') }}</div>
                        @endif</div>
               <div class="mt-3">
              <label>Confirm Password</label>
              <input type="password" name="" class="form-control" placeholder="danny@domain.com"></div><br>
              <input type="submit" name="btn" class="btn btn-primary"></div>

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
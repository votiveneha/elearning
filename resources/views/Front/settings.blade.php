@extends('Front.layouts.layout')
@section('title', 'User Dashboard')


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
              <input type="text"  class="form-control" placeholder="None"></div>
               <br>
               <input type="submit" class="btn btn-primary" value="Update Profile" id="">


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
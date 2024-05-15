@extends('Front.layouts.layout')
@section('title', 'User Dashboard')
@section('current_page_css')
<style type="text/css">
	.dash_con{
		overflow: hidden;
	    text-overflow: ellipsis;
	    display: -webkit-box;
	    -webkit-line-clamp: 2;
	    -webkit-box-orient: vertical;
	}
</style>
@endsection
@section('content')
<div class="row box-stats">
<!--<div class="col-md-12">
			 @if(Session::has('message'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ Session::get('message') }}		
    </div>
@endif
<div class="add-box">
  <div class="pd-bane">
    <div>
<h3> Welcome to Mathify!</h3>
<!-- <p> You’ve learned 70% of your goal this week! Keep it up and improve your progress.</p> -->

<!--</div>

<!-- <a href="#">See more</a> -->
<!--</div>

</div>
</div>-->
	

<?php
	$i = 1;
?>
@foreach($course_data as $c_data)

@if($c_data->status == 1 && $c_data->deleted_at == NULL)

	<div class="col-12 col-sm-8 col-md-6 col-lg-4">
      <div class="card courses-dash">
        <img src="{{ url('/public') }}/uploads/courses/{{ $c_data->course_img }}">
        <div class="card-body">
          <h4 class="card-title">{{ $c_data->title }}</h4>
          <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus at neque in justo vehicula suscipit ut eget mi. Pellentesque vitae porta mi.</p>
          <div class="btm-infos">
          <a href="{{ url('/user/course_views') }}/{{ base64_encode($c_data->course_id) }}" class="card-link">View</a>
          <p class="enr">23,350+ Enrolled</a>
		  </div>
        </div>
      </div>
    </div>
	<div class="col-12 col-sm-8 col-md-6 col-lg-4">
      <div class="card courses-dash">
        <img src="{{ url('/public') }}/uploads/courses/{{ $c_data->course_img }}">
        <div class="card-body">
          <h4 class="card-title">{{ $c_data->title }}</h4>
          <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus at neque in justo vehicula suscipit ut eget mi. Pellentesque vitae porta mi.</p>
          <div class="btm-infos">
          <a href="{{ url('/user/course_views') }}/{{ base64_encode($c_data->course_id) }}" class="card-link">View</a>
          <p class="enr">23,350+ Enrolled</a>
		  </div>
        </div>
      </div>
    </div>
	<div class="col-12 col-sm-8 col-md-6 col-lg-4">
      <div class="card courses-dash">
        <img src="{{ url('/public') }}/uploads/courses/{{ $c_data->course_img }}">
        <div class="card-body">
          <h4 class="card-title">{{ $c_data->title }}</h4>
          <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus at neque in justo vehicula suscipit ut eget mi. Pellentesque vitae porta mi.</p>
		  <div class="btm-infos">
          <a href="{{ url('/user/course_views') }}/{{ base64_encode($c_data->course_id) }}" class="card-link">View</a>
          <p class="enr">23,350+ Enrolled</a>
		  </div>
        </div>
      </div>
    </div>




<?php
	$i++;
?>
@endif

@endforeach

</div>
@endsection
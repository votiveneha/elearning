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
<div class="row">
<div class="col-md-12">
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

</div>

<!-- <a href="#">See more</a> -->
</div>

</div>
</div>

<?php
	$i = 1;
?>
@foreach($course_data as $c_data)

@if($c_data->status == 1 && $c_data->deleted_at == NULL)
<div class="col-md-4">
<div class="subject-box">
	<div class="inline-bx">
  <div class="img-subject">
<img src="{{ url('/public') }}/uploads/courses/{{ $c_data->course_img }}">

</div>
<div class="fielxi">
<div class="sub-name-about">
<h5>{{ $c_data->title }}</h5>
<div class="dash_con">{!! $c_data->description !!}</div>
</div>

<div class="btm-btn">
<a href="{{ url('/user/course_views') }}/{{ base64_encode($c_data->course_id) }}">View</a> <p>23,350+ Enrolled </p>
  </div>
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
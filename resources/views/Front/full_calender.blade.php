@extends('Front.layouts.layout')
@section('title', 'Course view')

@section('current_page_js')

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
<script>
	$(document).ready(function () {
	var events1 = JSON.parse('<?php echo $response; ?>');   console.log("events1",events1);
	$('#calendar').fullCalendar({


		  navLinks: true, // can click day/week names to navigate views
		  editable: true,
		  eventLimit: true, // allow "more" link when too many events
		  events:events1,
		  firstDay: 1
		});
	});
	  
</script>
@endsection
@section('content')
<div class="container">
	<h2>Progress in number of questions</h2>
	<div id='calendar'></div>
</div>
		
		
<!-- Vendor JS Files -->
 
@endsection
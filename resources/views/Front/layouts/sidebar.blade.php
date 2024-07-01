<div id="mySidebar" class="sidebar" style="width: 80px;">
  <div class="toplogo"> <a href="{{ url('/user/dashboard') }}" class="logo-box"><span class="favi-logo"><img src="{{ url('/public') }}/assets/img/final_logo.png" style="width:130px;"> </span>
  	<!-- <span class="icon-text"><img src="{{ url('/public') }}/assets/img/text-logo.png"></span> -->
  </a>
  
  </div><br>
 
<a href="{{ url('/user/dashboard') }}"><i class="material-symbols-outlined">
pie_chart
</i>
<span class="icon-text"></span>Dashboard</a><br>  
<!-- <a class="list-items" href="{{ url('/user/courses_list') }}"><i class="material-symbols-outlined">
grid_view
</i><span class="icon-text">Courses</span></a><br> -->

<a href="{{ url('/user/full-calender') }}"><i class="material-symbols-outlined">
calendar_month
</i><span class="icon-text"></span>User Progress</a>
<br>

<a href="{{ url('/user/session_history') }}"><i class="material-symbols-outlined">
history
</i>
<span class="icon-text"></span>Attempt History</a><br>



<a href="{{ url('/user/settings') }}"><i class="material-symbols-outlined">
settings
</i><span class="icon-text"></span>Settings<span></span></a>
<br>
<a href="{{ url('/user/exam_builder') }}"><i class="material-symbols-outlined">
content_paste_search
</i><span class="icon-text"></span>Exam Builder</a>

</div>


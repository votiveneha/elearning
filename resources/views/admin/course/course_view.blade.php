@extends('Front.layouts.layout')
@section('title', 'Course view')
@section('content')

<style type="text/css">
  
  .topics {
    padding: 0;
     margin-top: 5px; 
}
.class-box {
    padding: 25px;
    position: relative;
     top: 4px; 
}
@media (min-width: 320px) and (max-width: 767px){
  .class-box {
    padding: 10px;
    position: relative;
     top: 4px; 
}

}
</style>

 <section class="section-bg" style="margin-top: 0px;">
      <div class="container-fluid">
  <div class="class-box" style="top: 0px !important;">
<div class="row">


<div class="col-md-12">

   <div class="accordion-list">
    <h4><b> Maths 101 </b></h4>
              <ul>
                <li>
                  <a data-bs-toggle="collapse" class="collapse" data-bs-target="#accordion-list-1"><span>01</span> Trigonometry (Year 11) <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                  <div id="accordion-list-1" class="collapse show" data-bs-parent=".accordion-list">
                    
                    <div class="course-ilsit">
                      <h3><a href="{{ url('/user/theory') }}" class="d-flex align-items-center"> <span class="material-symbols-outlined">
menu_book
</span> Theory - Basic Trigonometry Ratios & Revisions (I) </a></h3>
                      <ul> 
                        <li><a href="{{ url('/user/start_quiz') }}"><img src="{{ url('/public') }}/assets/img/ancre.png"> Basic Trigonometry Ratios & Revisions (I)  </a> </li>
                        <li><a href="#"><img src="{{ url('/public') }}/assets/img/ancre.png"> Basic Trigonometry Ratios & Revisions (I)  </a> </li>
                        <li><a href="#"><img src="{{ url('/public') }}/assets/img/ancre.png"> Basic Trigonometry Ratios & Revisions (I)  </a> </li>
                        <li><a href="#"><img src="{{ url('/public') }}/assets/img/ancre.png"> Basic Trigonometry Ratios & Revisions (I)  </a> </li>
                        <li><a href="#"><img src="{{ url('/public') }}/assets/img/ancre.png"> Basic Trigonometry Ratios & Revisions (I)  </a> </li>
                        <li><a href="#"><img src="{{ url('/public') }}/assets/img/ancre.png"> Basic Trigonometry Ratios & Revisions (I)  </a> </li>
                        <li><a href="#"><img src="{{ url('/public') }}/assets/img/ancre.png"> Basic Trigonometry Ratios & Revisions (I)  </a> </li>
                        <li><a href="#"><img src="{{ url('/public') }}/assets/img/ancre.png"> Basic Trigonometry Ratios & Revisions (I)  </a> </li>


                      </ul>




                  </div>
                </li>

                <li>
                  <a data-bs-toggle="collapse" data-bs-target="#accordion-list-2" class="collapsed"><span>02</span> Functions (Year 1) <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                  <div id="accordion-list-2" class="collapse" data-bs-parent=".accordion-list">
                    <p>
                      Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi. Id interdum velit laoreet id donec ultrices. Fringilla phasellus faucibus scelerisque eleifend donec pretium. Est pellentesque elit ullamcorper dignissim. Mauris ultrices eros in cursus turpis massa tincidunt dui.
                    </p>
                  </div>
                </li>

                <li>
                  <a data-bs-toggle="collapse" data-bs-target="#accordion-list-3" class="collapsed"><span>03</span> Diffrentiations (Year 1) <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                  <div id="accordion-list-3" class="collapse" data-bs-parent=".accordion-list">
                    <p>
                      Eleifend mi in nulla posuere sollicitudin aliquam ultrices sagittis orci. Faucibus pulvinar elementum integer enim. Sem nulla pharetra diam sit amet nisl suscipit. Rutrum tellus pellentesque eu tincidunt. Lectus urna duis convallis convallis tellus. Urna molestie at elementum eu facilisis sed odio morbi quis
                    </p>
                  </div>
                </li>

              </ul>
            </div>

          </div>



</div>
</div>
</div>
</section>
@endsection
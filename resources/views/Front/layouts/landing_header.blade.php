 <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div class="container-fluid d-flex align-items-center justify-content-between">

     <!--  <h1 class="logo"><a href="index.html">Multi</a></h1> -->
      <!-- Uncomment below if you prefer to use an image logo -->
       <a href="{{ url('/') }}" class="logo"><img src="{{ url('/public') }}/assets1/img/logo.png" alt="" class="img-fluid"></a>

      <nav id="navbar" class="navbar">
        <ul>
            <li class="dropdown">
            <a href="{{ url('/courses') }}"><span>Courses</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              @foreach($courses_data as $c_data)
              <li><a href="{{ url('/courses') }}">{{ $c_data->title }}</a></li>
              
              @endforeach
            </ul>
          </li>
            <li class="dropdown">
            <a href="#"><span>Features</span> <i class="bi bi-chevron-down"></i></a>
            <ul>

              <li><a href="{{ url('/theory_booklets') }}">Theory Booklets</a></li>
              <li><a href="{{ url('/topic_exams') }}">Topic Exams</a></li>
              <!-- <li><a href="{{ url('/pricing') }}">Pricing</a></li> -->
              <li><a href="#">Trial Tests</a></li>
             
            </ul>
          </li>
          <li><a class="getstarted scrollto" href="{{ url('/login') }}">Join the Waitlist</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header>
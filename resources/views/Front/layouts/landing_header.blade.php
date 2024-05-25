 <style type="text/css">
   #navbarDropdown{
    color: #4D4D4D;
    display: flex;
    font-weight: 500;
   }

   .mr-1z label{
    height: 45px !important;
    width: 45px !important;
    background-color: #e4e4ff;
    border-radius: 50px;
    overflow: hidden;
    border: 1px solid #e4e4ff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 800;
   }
   <?php
            $email_data = Auth::guard("customer")->user();
          ?>
          @if($email_data)


          #header {
  background: #fff;
  transition: all 0.5s;
  z-index: 997;
  padding: 1px 0;
}
#header.header-scrolled {
    padding: 3px 0;
    box-shadow: 0px 2px 15px rgba(0, 0, 0, 0.1);
}
.navbar .dropdown:hover>ul {
    opacity: 1;
    top: 83%;
    visibility: visible;
}
          @endif

 </style>
 <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div class="container-fluid d-flex align-items-center justify-content-between">

     <!--  <h1 class="logo"><a href="index.html">Multi</a></h1> -->
      <!-- Uncomment below if you prefer to use an image logo -->
       <a href="{{ url('/') }}" class="logo"><img src="{{ url('/public') }}/assets1/img/logo.png" alt="" class="img-fluid"></a>

      <nav id="navbar" class="navbar">
        <ul>
            <li class="dropdown">
            <a href="{{ url('/mathify_works') }}"><span>How Mathify Works</span></a>
            
          </li>
            <li class="dropdown">
            <a href="{{ url('/courses') }}"><span>Courses</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              @foreach($courses_data as $c_data)
              @if($c_data->title == "Mathematics Advanced (2U)")
              <li><a href="{{ url('/courses') }}">{{ $c_data->title }}</a></li>
              @endif
              @endforeach
            </ul>
          </li>
            <li class="dropdown">
            <a href="#"><span>Features</span> <i class="bi bi-chevron-down"></i></a>
            <ul>

              <li><a href="{{ url('/theory_booklets') }}">Theory Booklets</a></li>
              <li><a href="{{ url('/topic_exams') }}">Topic Exams</a></li>
              
              <!-- <li><a href="#">Trial Tests</a></li> -->
             
            </ul>
          </li>
          <li>
            <a href="{{ url('/pricing') }}"><span>Pricing</span></a>
            
          </li>
          <?php
            $email_data = Auth::guard("customer")->user();
          ?>
          @if($email_data)
          <li>
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
     <li class="nav-item dropdown">
          <a href="#" class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
     <div class="mr-1z"> <label>
       <?php
          $user = Auth::guard("customer")->user();
          //echo $user->name;die;
          if($user){
            $user_name = explode(" ",$user->name);
            //print_r($user);die;
            if(count($user_name)>1){
              echo strtoupper($user_name[0][0])."".strtoupper($user_name[1][0]);
            }else{
              echo strtoupper($user_name[0][0]);
            }
          }
          
       ?>
       <!-- <img src="{{ url('/public/assets/img') }}/user2-160x160.jpg"> -->
     </label></div>
     
     <?php
        $user = Auth::guard("customer")->user();
     ?>
   <p>@if($user){{ $user->name }} <br><small>{{ $user->email }}@endif</small></p> 
    </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="{{ url('/user/settings') }}">Profile</a></li>

            <li><a class="dropdown-item" href="{{ url('/user/change_password') }}">Change Password</a></li>
            <li><a class="dropdown-item" href="{{ url('/user/pricing') }}">Purchase Plan</a></li>
            <li><a class="dropdown-item" href="{{ url('/user/logout') }}">Logout</a></li>
           
          </ul>
        </li>
      </ul>
          </li>
          @else
          <li><a class="getstarted scrollto" href="{{ url('/login') }}">Sign In/Sign Up</a></li>
          @endif
          
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header>
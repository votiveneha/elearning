<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  
  
  @if($_SERVER['REQUEST_URI'] == "/")
  <title> MathifyHSC: Specialist Math Resources & Questions for HSC Students</title>
  <meta content="Specialist math resources & questions designed for HSC Students. Mathify provides 100+ bite - sized math study booklets and 1500+ HSC practice exam questions." name="description">
  @endif
  @if($_SERVER['REQUEST_URI'] == "/mathify_works")
  <title> Learn more about how our online platform helps HSC students excel</title>
  <meta content="Our resources redefine how students can best prepare for their HSC math exams. Structured learning materials provide you all the tools to improve in your weakest areas or revise important topics." name="description">
  @endif
  @if($_SERVER['REQUEST_URI'] == "/pricing")
  <title> Mathify Pricing
</title>
  <meta content="We offer free accounts and resources for all HSC students that sign up. If you’d like to upgrade and access all our premium content, our affordable pricing plans start from just $3 per week to access." name="description">
  @endif
  @if($_SERVER['REQUEST_URI'] == "/about_us")
  <title> About Us
</title>
  <meta content="Since launching in early 2023, Mathify has continually evolved and sought to improve its resources to deliver only the best services to HSC students. " name="description">
  @endif
  @if($_SERVER['REQUEST_URI'] == "/courses")
  <title> Maths Advanced Course
</title>
  <meta content="We’ve unpacked all the content for HSC Maths Advanced (2U) in Year 11 and 12 to keep your learning organised. Topics are broken down into bite sized chunks so it’s easier to learn, remember and practice" name="description">
  @endif
  @if($_SERVER['REQUEST_URI'] == "/theory_booklets")
  <title> HSC Theory Booklets
</title>
  <meta content="Each of our bite – sized booklets cover exactly everything you need for a subtopic. Step by step solutions to common exam problems and important points summarised to be your perfect study tool." name="description">
  @endif
  @if($_SERVER['REQUEST_URI'] == "/topic_exams")
  <title> Mock Exam Problems 
</title>
  <meta content="Over 1500 mock exam questions each come with exemplar worked solutions, meaning that every possible area is covered for our students. Perfect for HSC preparation." name="description">
  @endif
  @if($_SERVER['REQUEST_URI'] == "/terms")
  <title> Terms and Conditions 
</title>
  <meta content="MathifyHSC’s terms and conditions of use for accessing our website and resources">
  @endif
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{ url('/public') }}/assets1/img/favicon.png" rel="icon">
  <link href="{{ url('/public') }}/assets1/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ url('/public') }}/assets1/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="{{ url('/public') }}/assets1/vendor/aos/aos.css" rel="stylesheet">
  <link href="{{ url('/public') }}/assets1/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="{{ url('/public') }}/assets1/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="{{ url('/public') }}/assets1/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="{{ url('/public') }}/assets1/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="{{ url('/public') }}/assets1/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="{{ url('/public') }}/assets1/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ url('/public') }}/assets1/css/style.css" rel="stylesheet">

</head>

<body>

 @include('Front.layouts.landing_header')

  @yield('content')

@include('Front.layouts.landing_footer')


  <!-- Vendor JS Files -->
  <script src="{{ url('/public') }}/assets1/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="{{ url('/public') }}/assets1/vendor/aos/aos.js"></script>
  <script src="{{ url('/public') }}/assets1/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="{{ url('/public') }}/assets1/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="{{ url('/public') }}/assets1/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="{{ url('/public') }}/assets1/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="{{ url('/public') }}/assets1/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="{{ url('/public') }}/assets1/js/main.js"></script>

</body>

</html>
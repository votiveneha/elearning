<!DOCTYPE html>
<html lang="en">
   <head>

    <!-- Google tag (gtag.js) --><script async src="https://www.googletagmanager.com/gtag/js?id=G-RQ8B04R992"></script><script>  window.dataLayer = window.dataLayer || [];  function gtag(){dataLayer.push(arguments);}  gtag('js', new Date());  gtag('config', 'G-RQ8B04R992');</script>
    
      <?php if(isset($page_data)){ ?>
      <title><?php echo $page_data->seo_title; ?></title>  
      <meta name="title" content="<?php echo $page_data->seo_title; ?>">
      <meta name="keywords" content="<?php echo $page_data->seo_keyword; ?>">
      <meta name="description" content="<?php echo $page_data->seo_description; ?>">
      <meta name="author" content="<?php echo $page_data->seo_author; ?>">
      <?php }else{ ?>
      <title>grambunny | @yield("title")</title>
      <?php } ?>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="app-url" content="{{ asset('/') }}">
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <link href="https://fonts.googleapis.com/css?family=Nanum+Gothic:400,700,800" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800&display=swap" rel="stylesheet">

      <link rel="stylesheet" href="{{ asset('assets/fonts/icomoon/style.css') }}?var=<?php echo rand();?>" type="text/css">

      <link href="{{ asset('assets/fonts/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
      <link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
      <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/magnific-popup.css') }}">
      <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/jquery-ui.css') }}">
      <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/owl.carousel.min.css') }}">
      <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/owl.theme.default.min.css') }}">
      <link rel="stylesheet"  type="text/css"href="{{ asset('assets/css/bootstrap-datepicker.css')}}">
      <link rel="stylesheet" type="text/css" href="{{ asset('assets/fonts/flaticon/font/flaticon.css')}}">
   <!--    <link rel="stylesheet" type="text/css" href="{{asset("public/assets/css/aos.css")}}"> -->
      <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/rangeslider.css')}}">
      <!--  <link href="css/animate.min.css" rel="stylesheet">   -->

      <link rel="shortcut icon" href="{{ asset('public/design/front/img/favicon.png') }}" type="image/x-icon">
      <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css')}}">
  
      <?php if((Request::segment(3) == 'bussiness-details')){ ?> 

      <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/customthird.css')}}">

      <?php }else{ ?>

      <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/custom.css')}}">  

      <?php } ?>

      <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
      <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/xzoom.css')}}" media="all" /> 

      <link href="https://fonts.googleapis.com/css2?family=PT+Sans+Narrow&display=swap" rel="stylesheet">
      <script>
         window.mapState = {
         
             initMap: false
         
           }
         
           
         
           function initMap () {
         
               window.mapState.initMap = true
         
           }
         
           
      </script>
       <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB-ANulZRLHUhROP47UlRNTBXrvVl102fU&libraries=places&callback=initAutocomplete"></script>
      {{-- <script type="text/javascript">
         (function(e){var t,o={className:"autosizejs",append:"",callback:!1,resizeDelay:10},i='<textarea tabindex="-1" style="position:absolute; top:-999px; left:0; right:auto; bottom:auto; border:0; padding: 0; -moz-box-sizing:content-box; -webkit-box-sizing:content-box; box-sizing:content-box; word-wrap:break-word; height:0 !important; min-height:0 !important; overflow:hidden; transition:none; -webkit-transition:none; -moz-transition:none;"/>',n=["fontFamily","fontSize","fontWeight","fontStyle","letterSpacing","textTransform","wordSpacing","textIndent"],s=e(i).data("autosize",!0)[0];s.style.lineHeight="99px","99px"===e(s).css("lineHeight")&&n.push("lineHeight"),s.style.lineHeight="",e.fn.autosize=function(i){return this.length?(i=e.extend({},o,i||{}),s.parentNode!==document.body&&e(document.body).append(s),this.each(function(){function o(){var t,o;"getComputedStyle"in window?(t=window.getComputedStyle(u,null),o=u.getBoundingClientRect().width,e.each(["paddingLeft","paddingRight","borderLeftWidth","borderRightWidth"],function(e,i){o-=parseInt(t[i],10)}),s.style.width=o+"px"):s.style.width=Math.max(p.width(),0)+"px"}function a(){var a={};if(t=u,s.className=i.className,d=parseInt(p.css("maxHeight"),10),e.each(n,function(e,t){a[t]=p.css(t)}),e(s).css(a),o(),window.chrome){var r=u.style.width;u.style.width="0px",u.offsetWidth,u.style.width=r}}function r(){var e,n;t!==u?a():o(),s.value=u.value+i.append,s.style.overflowY=u.style.overflowY,n=parseInt(u.style.height,10),s.scrollTop=0,s.scrollTop=9e4,e=s.scrollTop,d&&e>d?(u.style.overflowY="scroll",e=d):(u.style.overflowY="hidden",c>e&&(e=c)),e+=w,n!==e&&(u.style.height=e+"px",f&&i.callback.call(u,u))}function l(){clearTimeout(h),h=setTimeout(function(){var e=p.width();e!==g&&(g=e,r())},parseInt(i.resizeDelay,10))}var d,c,h,u=this,p=e(u),w=0,f=e.isFunction(i.callback),z={height:u.style.height,overflow:u.style.overflow,overflowY:u.style.overflowY,wordWrap:u.style.wordWrap,resize:u.style.resize},g=p.width();p.data("autosize")||(p.data("autosize",!0),("border-box"===p.css("box-sizing")||"border-box"===p.css("-moz-box-sizing")||"border-box"===p.css("-webkit-box-sizing"))&&(w=p.outerHeight()-p.height()),c=Math.max(parseInt(p.css("minHeight"),10)-w||0,p.height()),p.css({overflow:"hidden",overflowY:"hidden",wordWrap:"break-word",resize:"none"===p.css("resize")||"vertical"===p.css("resize")?"none":"horizontal"}),"onpropertychange"in u?"oninput"in u?p.on("input.autosize keyup.autosize",r):p.on("propertychange.autosize",function(){"value"===event.propertyName&&r()}):p.on("input.autosize",r),i.resizeDelay!==!1&&e(window).on("resize.autosize",l),p.on("autosize.resize",r),p.on("autosize.resizeIncludeStyle",function(){t=null,r()}),p.on("autosize.destroy",function(){t=null,clearTimeout(h),e(window).off("resize",l),p.off("autosize").off(".autosize").css(z).removeData("autosize")}),r())})):this}})(window.jQuery||window.$);
         
         
         
         var __slice=[].slice;(function(e,t){var n;n=function(){function t(t,n){var r,i,s,o=this;this.options=e.extend({},this.defaults,n);this.$el=t;s=this.defaults;for(r in s){i=s[r];if(this.$el.data(r)!=null){this.options[r]=this.$el.data(r)}}this.createStars();this.syncRating();this.$el.on("mouseover.starrr","span",function(e){return o.syncRating(o.$el.find("span").index(e.currentTarget)+1)});this.$el.on("mouseout.starrr",function(){return o.syncRating()});this.$el.on("click.starrr","span",function(e){return o.setRating(o.$el.find("span").index(e.currentTarget)+1)});this.$el.on("starrr:change",this.options.change)}t.prototype.defaults={rating:void 0,numStars:5,change:function(e,t){}};t.prototype.createStars=function(){var e,t,n;n=[];for(e=1,t=this.options.numStars;1<=t?e<=t:e>=t;1<=t?e++:e--){n.push(this.$el.append("<span class='glyphicon .glyphicon-star-empty'></span>"))}return n};t.prototype.setRating=function(e){if(this.options.rating===e){e=void 0}this.options.rating=e;this.syncRating();return this.$el.trigger("starrr:change",e)};t.prototype.syncRating=function(e){var t,n,r,i;e||(e=this.options.rating);if(e){for(t=n=0,i=e-1;0<=i?n<=i:n>=i;t=0<=i?++n:--n){this.$el.find("span").eq(t).removeClass("glyphicon-star-empty").addClass("glyphicon-star")}}if(e&&e<5){for(t=r=e;e<=4?r<=4:r>=4;t=e<=4?++r:--r){this.$el.find("span").eq(t).removeClass("glyphicon-star").addClass("glyphicon-star-empty")}}if(!e){return this.$el.find("span").removeClass("glyphicon-star").addClass("glyphicon-star-empty")}};return t}();return e.fn.extend({starrr:function(){var t,r;r=arguments[0],t=2<=arguments.length?__slice.call(arguments,1):[];return this.each(function(){var i;i=e(this).data("star-rating");if(!i){e(this).data("star-rating",i=new n(e(this),r))}if(typeof r==="string"){return i[r].apply(i,t)}})}})})(window.jQuery,window);$(function(){return $(".starrr").starrr()})
         
         
         
         $(function(){
         
         $('#new-review').autosize({append: "\n"});
         
         var reviewBox = $('.post-review-box');
         
         var newReview = $('#new-review');
         
         var openReviewBtn = $('#open-review-box');
         
         var closeReviewBtn = $('#close-review-box');
         
         var ratingsField = $('#ratings-hidden');
         
         
         openReviewBtn.click(function(e)
         
         {
         
         reviewBox.slideDown(400, function()
         
           {
         
             $('#new-review').trigger('autosize.resize');
         
             newReview.focus();
         
           });
         
         // openReviewBtn.fadeOut(100);
         
         closeReviewBtn.show();
         
         });
         
         
         
         closeReviewBtn.click(function(e)
         
         {
         
         e.preventDefault();
         
         reviewBox.slideUp(300, function()
         
           {
         
             newReview.focus();
         
             openReviewBtn.fadeIn(200);
         
           });
         
         closeReviewBtn.hide();
         
         
         
         });
         
         
         
         $('.starrr').on('starrr:change', function(e, value){
         
         ratingsField.val(value);
         
         });
         
         });
         
      </script> --}}
      <!--   CITIES  MODAL END-->
      {{-- <script>
         $(document).ready(function() {
                          
           var owl = $("#owl-demo");
                        
           owl.owlCarousel({
         
           autoPlay : 3000,
         
           stopOnHover : true,
         
           items : 3, //10 items above 1000px browser width
         
           itemsDesktop : [1000,3], //5 items between 1000px and 901px
         
           itemsDesktopSmall : [900,2], // 3 items betweem 900px and 601px
         
           itemsTablet: [600,1], //2 items between 600 and 0;
         
           itemsMobile : false // itemsMobile disabled - inherit from itemsTablet option
                            
           });
         
              
           // Custom Navigation Events
         
           $(".next").click(function(){
         
             owl.trigger('owl.next');
         
           })
         
           $(".prev").click(function(){
         
             owl.trigger('owl.prev');
         
           })
         
         });
         
      </script> --}}
      @yield("styles")   
   </head>
   <body>

  <style type="text/css">
span#session_qty
li.cart_icon_sec.dcart {
margin-right: 10px;
}
span#session_qty {
position: absolute;
top: 25px;
right: -10px;
} 

.position-relative {
    margin-right: 20px;
}
  </style>

      <div class="site-wrap" id="app">
         <div class="site-mobile-menu ">
            <div class="site-mobile-menu-header">
               <div class="site-mobile-menu-close mt-3">
                  <span class="icon-close2 js-menu-toggle"></span>
               </div>
            </div>
            <div class="site-mobile-menu-body"></div>
         </div>
     <!--     <div class="top-header-area"  >
            <div class="container h-100">
               <div class="row h-100 align-items-center">
                  <div class="col-6">
                     <div class="top-header-content">
                     
                         <a href="#"><i class="fa fa-envelope"></i> <span>info.colorlib@gmail.com</span></a>
                     
                         <a href="#"><i class="fa fa-phone"></i> <span>(12) 345 6789</span></a>
                     
                     </div>
                     
                     </div>
                  <div class="col-12">
                     <div class="top-header-content">
                        <div class="top-social-area ml-auto">
                            <div class="tpOpsn"><i class="fa fa-mobile"></i><a href="https://apps.apple.com/in/app/grambunny/id1522416640" target="_blank">Apple App</a> <span style="color: #222;">|</span> <a href="https://play.google.com/store/apps/details?id=com.grambunny.grambunnyseller" target="_blank">Android App</a></div>
                           <div class="tpOpsn"><i class="fa fa-comments"></i> <span></span><a href="#">Live Chat</a></div>
                           <div class="pull-right">
                              <?php if(is_null(Auth::guard("vendor")->user())){ ?> 
                              
                                 <li>
                                 
                                 <a href="{{ route('merchant.login') }}" class="cta"><span class=" round">Merchant Login</span>
                                     </a>
                                 
                                 </li>
                              <?php } ?> 
                              <?php if(is_null(Auth::guard("user")->user())){ 
                                 $cart_uid = session('cart_uid');
                                 
                                 ?>
                              <li>
                                 <a href="{{ route("signInPage",["redirect_url" => url()->current()]) }}" class="cta"><span class=" round">Customer Login</span></a> 
                              </li>
                              <?php }else{ $cart_uid = auth()->guard('user')->user()->id; } ?>
                              <?php 
                                 $ps_qty = DB::table('cart')->where('user_id', $cart_uid)->sum('cart.quantity');
                                 
                                     
                                     if(empty($ps_qty)){ $ps_qty = 0; } ?>
                              <li class="cart_icon_sec dcart">
                                 <a <?php if(!empty($ps_qty)){ ?>href="{{ url('/').'/cart' }}" <?php } ?> ><i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
                                 <b>(</b><b id="session_qty_bk">{{$ps_qty}}</b><b>)</b>
                              </li>
                           </div>
                           
                              <div class="tpOpsn"><i class="fa fa-headphones"></i>
                              
                                  <select>
                              
                                      <option>Help</option>
                              
                                      <option>Option 1</option>
                              
                                      <option>Option 2</option>
                              
                                      <option>Option 3</option>
                              
                                  </select>
                              
                              </div> 
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div> -->
         <header class="site-navbar container py-0 " role="banner"  >
            <!-- <div class="container"> -->
            <div class="row align-items-center">
               <div class="col-md-3 col-sm-9 col-9">
                  <h1 class="mb-0 site-logo"><a href="{{ url('/') }}" class="text-white mb-0"><img class="logoMail" src="{{ asset('assets/images/logo.png') }}"></a></h1>
               </div>
               <div class="col-md-9 d-md-block d-sm-none d-none">
                  <nav class="site-navigation position-relative text-right" role="navigation">
                     <ul class="site-menu js-clone-nav mr-auto d-md-block d-sm-none">
                        <li class="active"><a href="{{ url('/') }}">Home</a></li>
                        <li><a href="{{ route("page.aboutUs") }}">About us</a></li>
                        <!-- 
                        <li class="has-children">
                           <a href="#"  >About</a>
                           <ul class="dropdown">
                              <li><a href="#">The Company</a></li>
                              <li><a href="#">The Leadership</a></li>
                              <li><a href="#">Philosophy</a></li>
                              <li><a href="#">Careers</a></li>
                           </ul>
                        </li>
                        -->
                        <li><a href="{{ route("page.help") }}">Help</a></li>
                        <li><a href="{{ route("page.faq") }}">FAQ</a></li>
                        <li><a href="{{route("page.contactUs")}}">Contact</a></li>
                        <li><a href="">  
                                
                              <?php if(is_null(Auth::guard("user")->user())){ 
                                 $cart_uid = session('cart_uid');
                                 
                                 ?>
                                  <?php if(is_null(Auth::guard("vendor")->user())){ ?> 
                              <li>
                                 <a href="{{ route("signInPage",["redirect_url" => url()->current()]) }}" class="cta" id="cloginurl"><span class=" round customer_btn">Customer Login</span></a> 
                              </li>

                              <?php }else{ ?> <a href="{{ route("signInPage",["redirect_url" => url()->current()]) }}" class="cta" id="cloginurl"></a> <?php } ?>
                              
                              <?php }else{ $cart_uid = auth()->guard('user')->user()->id; } ?>
                               
                              <?php 
                                 $ps_qty = DB::table('cart')->where('user_id', $cart_uid)->sum('cart.quantity');
                                 
                                     
                          if(empty($ps_qty)){ $ps_qty = 0; } ?>
                            <?php if(is_null(Auth::guard("user")->user())){ ?>
                          <?php if(is_null(Auth::guard("vendor")->user())){ ?> 
                              
                          <li><a href="{{ route('merchant.login') }}" class="cta"><span class=" round customer_btn">Merchant Login</span></a></li>
                              
                         <?php }else{ ?>
                         
                         <li><a href="{{ route('merchant.dashboard') }}" class="cta"><span class=" round customer_btn">Merchant Dashboard</span></a></li>

                          <?php } }?> 

                          </a></li>
                        
                        <!-- <li><a href="login.html">Log In</a></li> -->
                        @if(Auth::guard("user")->check())
                        <li class="has-children">
                           <a href="#" class="cta"><span class="text-white round">{{ Auth::guard("user")->user()->name.' '
                           .Auth::guard("user")->user()->lname }}</span></a>
                           <ul class="dropdown">
                              <li><a href="{{ route("userAccount") }}">My Account</a></li>
                              <li><a href="{{ route("myevents") }}">My Events</a></li>
                              <li><a href="{{ route("myorders") }}">My Orders</a></li>
                              <li><a href="{{ route("userLogout") }}">Logout</a></li>
                           </ul>
                        </li>
                        @else
                        <!-- <li style="display: none;"><a href="{{ route("signInPage") }}" class="cta"><span class="text-white round">Log in/Register</span></a></li> -->
                        @endif
                         <li class="cart_icon_sec dcart">
                                 <a <?php if(!empty($ps_qty)){ ?>href="{{ url('/').'/cart' }}" <?php } ?> ><i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                 </a>
                                 
                              </li>

                     </ul>

                     <span id="session_qty">({{$ps_qty}})</span>

                  </nav>
               </div>
               <div class="d-md-none d-sm-block ml-auto py-3 col-3 text-black" style="position: relative; top: 3px;">
                  <a href="#" class="site-menu-toggle js-menu-toggle text-black"><span class="icon-menu home-mobile-bar"></span></a>
               </div>
            </div>
            <!-- </div> -->
         </header>
         @yield("content")     
         <div class="tpOpsn for-FixedChat" id="livechat"><a style="cursor: pointer;"><i class=""></i> </a></div>
         <footer class="site-footer">
            <div class="footFirst" >
               <div class="container">
                  <div class="row footer_row">
                     <div class="row p-3">
                        <div class="col-md-3 foter_3">
                           <div class="footlogo"><img src="{{ asset('assets/images/logo.png') }}"></div>
                          <!--  <div class="f_firt_content">
                              <p> A community connecting cannabis consumers, pataients, ratailers, doctors, and brands since 2008</p>
                           </div> -->

                            <?php $career = DB::table('advertisement')->where('status','=','1')->where('id',7)->first();

                           $career1 = DB::table('advertisement')->where('status','=','1')->where('id',8)->first();

                           $career2 = DB::table('advertisement')->where('status','=','1')->where('id',9)->first();

                           $career3 = DB::table('advertisement')->where('status','=','1')->where('id',10)->first();

                           $career4 = DB::table('advertisement')->where('status','=','1')->where('id',11)->first();

                           $career5 = DB::table('advertisement')->where('status','=','1')->where('id',12)->first();

                           $career6 = DB::table('advertisement')->where('status','=','1')->where('id',13)->first();

                           $career7 = DB::table('advertisement')->where('status','=','1')->where('id',14)->first();

                           ?>

                           <div class="app_logo">
                              @if(!empty($career->image))
                            <a href="{{$career->content }}" target="_blank"><img src="{{ url('/') }}/uploads/advertisement/{{ $career->image }}"></a> 
                            @endif
                            @if(!empty($career1->image))
                            <a href="{{$career1->content }}" target="_blank"><img src="{{ url('/') }}/uploads/advertisement/{{ $career1->image }}"></a>
                            @endif
                           </div>
                           <div class="social_footer_icon">
                              @if(!empty($career2->image))
                              <a href="{{$career2->content }}" target="_blank" class="pl-0 pr-3"><img src="{{ url('/') }}/uploads/advertisement/{{ $career2->image }}"></a>
                              @endif
                              @if(!empty($career3->image))
                              <a href="{{$career3->content }}" target="_blank" class="pl-3 pr-3"><img src="{{ url('/') }}/uploads/advertisement/{{ $career3->image }}"></a>
                               @endif
                               @if(!empty($career4->image))
                              <a href="{{$career4->content }}" target="_blank" class="pl-3 pr-3"><img src="{{ url('/') }}/uploads/advertisement/{{ $career4->image }}"></a>
                               @endif
                               @if(!empty($career5->image))
                              <a href="{{$career5->content }}" target="_blank" class="pl-3 pr-3"><img src="{{ url('/') }}/uploads/advertisement/{{ $career5->image }}"></a>
                              @endif
                              @if(!empty($career6->image))
                              <a href="{{$career6->content }}" target="_blank" class="pl-3 pr-3"><img src="{{ url('/') }}/uploads/advertisement/{{ $career6->image }}"></a>
                              @endif
                              @if(!empty($career7->image))
                              <a href="{{$career7->content }}" target="_blank" class="pl-3 pr-3"><img src="{{ url('/') }}/uploads/advertisement/{{ $career7->image }}"></a>
                              @endif
                           </div>
                           <!-- <div class="app_logo">
                            <a href="https://play.google.com/store/apps/details?id=com.grambunny&pli=1" target="_blank"><img src="https://www.grambunny.com/public/assets/images/g-app2.png"></a> 
                            <a href="https://apps.apple.com/in/app/grambunnymerchant/id6443857993" target="_blank"><img src="https://www.grambunny.com/public/assets/images/i-app2.png"></a>
                           </div>
                           <div class="social_footer_icon">
                              <a href="javascript:void(0)" class="pl-0 pr-3"><img src="https://www.grambunny.com/public/assets/images/s1.png"></a>
                              <a href="javascript:void(0)" class="pl-3 pr-3"><img src="https://www.grambunny.com/public/assets/images/s2.png"></a>
                              <a href="javascript:void(0)" class="pl-3 pr-3"><img src="https://www.grambunny.com/public/assets/images/s3.png"></a>
                              <a href="javascript:void(0)" class="pl-3 pr-3"><img src="https://www.grambunny.com/public/assets/images/s4.png"></a>
                              <a href="javascript:void(0)" class="pl-3 pr-3"><img src="https://www.grambunny.com/public/assets/images/s5.png"></a>
                              <a href="javascript:void(0)" class="pl-3 pr-3"><img src="https://www.grambunny.com/public/assets/images/s6.png"></a>
                           </div> -->

                            <div class="poweredby">Powered by HeyMobie</div>


                        </div>
                        <div class="col-md-3 foter_2">
                           <h2 class="footer-heading mb-4">About</h2>
                           <ul class="list-unstyled">
                          
                          <?php /* if(is_null(Auth::guard("vendor")->user())){ ?> 
                              
                          <li><a href="{{ route('merchant.login') }}" >Merchant Login</a></li>
                              
                         <?php }else{ ?>
                         
                         <li><a href="{{ route('merchant.dashboard') }}" >Merchant Dashboard</a></li>

                          <?php } */ ?> 

                              <li><a href="javascript:void(0)">company</a></li>
                              <!-- <li><a href="#">investors</a></li> -->
                              <li><a href="javascript:void(0)">careers</a></li>
                            
                              <li><a href="javascript:void(0)">Advocacy</a></li>
                              <li><a href="javascript:void(0)">Download the app</a></li>
                              <!--  <li><a href="{{ route("page.aboutUs") }}">About Us</a></li>  
                                 <li><a href="{{route("page.contactUs")}}">Contact Us</a></li> -->
                           </ul>
                        </div>

                         <div class="col-md-3 foter_2">
                           <h2 class="footer-heading mb-4">Get to Know Us</h2>
                           <ul class="list-unstyled">
                              <!--<li><a href="#">Refund Policy</a></li>-->
                              <li><a href="{{ route("page.aboutUs") }}">About us</a></li>
                              <li><a href="{{ route("page.help") }}">Help</a></li>
                              <li><a href="{{ route("page.faq") }}">FAQ</a></li>
                               <li><a href="{{route("page.contactUs")}}">Contact</a></li>
                           </ul>
                        </div>
                           <div class="col-md-3 foter_2">
                           <h2 class="footer-heading mb-4">Legal</h2>
                           <ul class="list-unstyled">
                              <!--<li><a href="#">Refund Policy</a></li>-->
                              <li><a href="{{ route("page.terms") }}">Terms Of use</a></li>
                              <li><a href="{{ route("page.privacy") }}">Privacy Policy</a></li>
                              <li><a href="javascript:void(0)">cookie Policy</a></li>
                              <li><a href="javascript:void(0)">Referral program</a></li>
                           </ul>
                        </div>

                          
                     </div>
                  </div>
               </div>
            </div>
                  <div class="footSecond" >
               <div class="container">
               
                   <div class="row">
               
                       <div class="col-md-12">
               
                           <div class="foot_msg" style="text-align: center;"><p>© 2019 grambunny. All Rights Reserved.</p></div>
               
                       </div>
               
                      
               
                   </div>
               
               </div>
               
               </div>
         </footer>
         <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
               <div class="modal-content">
                  <div class="modal-header">
                     <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                     </button>
                  </div>
                  <div class="modal-body">
                     <form action="">
                        <div class="form-group">
                           <label for="email">Email</label>
                           <input type="text" name="email" id="email" class="form-control">
                        </div>
                        <div class="form-group">
                           <label for="password">Password</label>
                           <input type="text" name="password" id="password" class="form-control">
                        </div>
                     </form>
                  </div>
                  <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                     <button type="button" class="btn btn-primary">Login</button>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div id="frame">
         <div id="sidepanel">
            <div id="profile">
               <div class="wrap">
                  <p>Online Merchant</p>
               </div>
            </div>
            <div id="contacts"></div>
         </div>
         <div class="content">
            <div class="contact-profile">
               <img src="" alt="" id="mmerchant" />
               <p id="nmerchant"></p>
            </div>
            <div class="messages" id="messages"></div>
            <div class="message-input">
               <div class="wrap">
                  <input type="text" name="cmessage" id="cmessage" value="" placeholder="Write your message..." />
                  <input type="hidden" name="cuserid" id="cuserid" value="@if(Auth::guard("user")->check()){{ Auth::guard("user")->user()->id}}@endif">
                  <input type="hidden" name="cmerchantid" id="cmerchantid" value="">
                  <button class="submit" onclick="myChat()" ><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
               </div>
            </div>
         </div>
      </div>
      <!-- chat system end -->

<!--     <div class="mylivechat">
         <script type="text/javascript">function add_chatinline(){var hccid=90602094;var nt=document.createElement("script");nt.async=true;nt.src="https://mylivechat.com/chatinline.aspx?hccid="+hccid;var ct=document.getElementsByTagName("script")[0];ct.parentNode.insertBefore(nt,ct);}
            add_chatinline(); 
         </script>
      </div> -->

      <script src="{{ asset('js/app.js')}}?var=<?php echo rand();?>"></script>
      <script src="{{ asset('assets/js/jquery-migrate-3.0.1.min.js')}}"></script>
      <script src="{{asset('assets/js/jquery-ui.js')}}"></script>
      <script src="{{asset('assets/js/popper.min.js')}}"></script>
      <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
      <script src="{{asset('assets/js/owl.carousel.min.js')}}"></script>
      <script src="{{asset('assets/js/jquery.stellar.min.js')}}"></script>
      <script src="{{asset('assets/js/jquery.countdown.min.js')}}"></script>
      <script src="{{asset('assets/js/jquery.magnific-popup.min.js')}}"></script>
      <script src="{{asset('assets/js/bootstrap-datepicker.min.js')}}"></script>
      <script src="{{asset('assets/js/aos.js') }}"></script>
      <script src="{{ asset('assets/js/rangeslider.min.js')}}"></script>
      <script src="{{ asset('assets/js/main.js')}}"></script>
      <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js'></script>
      <script src="{{asset('assets/js/xzoom.min.js')}}"></script>
      <script type="text/javascript"> 
         jQuery(document).ready(function ($) {
         
         
         $('#mapauto').click(function () {
         
         $('#merchant').val('');
         
         }); 
         
         $('#merchant').click(function () {
         
         $('#mapauto').val('');
         
         });    
         
         
          $('#livechat').on('click', function() {
         
         
         
           var cuserid = $('#cuserid').val();
         
           
         
           if(cuserid!=''){ 
         
         
         
           $.ajax({
         
             type: "post",
         
             headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') },
         
             data: {
         
                     "_token": "{{ csrf_token() }}",
         
                     "chat_data": {cuserid:cuserid},
         
                     },
         
             url: "{{url('/chatmlist')}}",       
         
         
         
             success: function(msg) { 
         
         
         
             $('#contacts').html(msg);
         
         
         
              }
         
             });
         
         
         
         
         
            $('#frame').toggle();
         
         
         
           } 
         
         
         
          });
         
         
         
         $('body').on('click', '.contact',function() { 
         
         
         
            mimags = $(this).attr('id'); 
         
            mnames = $(this).text();
         
            merchid = $(this).attr("value");
         
         
         
            $('#nmerchant').html(mnames);
         
            $('#mmerchant').attr("src",mimags);
         
            $('#cmerchantid').val(merchid);     
         
         
         
          });
         
                     
         
         });  
         
         
         
         function myChat() {
         
          
         
         var cmessage = $('#cmessage').val();
         
         var cuserid = $('#cuserid').val();
         
         var cmerchantid = $('#cmerchantid').val();
         
         
         
         if(cmessage==''){ return false; }
         
         
         
         $.ajax({
         
         type: "post",
         
         headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') },
         
         data: {
         
                 "_token": "{{ csrf_token() }}",
         
                 "chat_data": {cmessage:cmessage, cuserid:cuserid, cmerchantid:cmerchantid},
         
                 },
         
         url: "{{url('/chatsystem')}}",       
         
         
         
         success: function(msg) { 
         
         
         
         $('#cmessage').val('');
         
         $('#messages').html(msg);
         
         
         
          }
         
         });
         
         
         
         }; 
         
         
         
         function timeChat() {
         
          
         
         var cuserid = $('#cuserid').val();
         
         var cmerchantid = $('#cmerchantid').val();
         
         
         if(cmessage!='' && cmerchantid!=''){ 
         
         
         $.ajax({
         
         type: "post",
         
         headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') },
         
         data: {
         
                 "_token": "{{ csrf_token() }}",
         
                 "chat_data": {cuserid:cuserid, cmerchantid:cmerchantid},
         
                 },
         
         url: "{{url('/chathistory')}}",       
         
         
         
         success: function(msg) { 
         
         
         
         $('#messages').html(msg);
         
         
         
          }
         
         });
         
         
         
         }else{ return false; } 
         
         
         
         }; 
         
         
         
         var myVar = setInterval(timeChat, 2000);
         
         
         
         
         
           (function ($) {
         
         $(document).ready(function() {
         
             $('.xzoom, .xzoom-gallery').xzoom({zoomWidth: 400, title: true, tint: '#333', Xoffset: 15});
         
             $('.xzoom2, .xzoom-gallery2').xzoom({position: '#xzoom2-id', tint: '#ffa200'});
         
             $('.xzoom3, .xzoom-gallery3').xzoom({position: 'lens', lensShape: 'circle', sourceClass: 'xzoom-hidden'});
         
             $('.xzoom4, .xzoom-gallery4').xzoom({tint: '#006699', Xoffset: 15});
         
             $('.xzoom5, .xzoom-gallery5').xzoom({tint: '#006699', Xoffset: 15});
         
         
         
             //Integration with hammer.js
         
             var isTouchSupported = 'ontouchstart' in window;
         
         
         
             if (isTouchSupported) {
         
                 //If touch device
         
                 $('.xzoom, .xzoom2, .xzoom3, .xzoom4, .xzoom5').each(function(){
         
                     var xzoom = $(this).data('xzoom');
         
                     xzoom.eventunbind();
         
                 });
         
                 
         
                 $('.xzoom, .xzoom2, .xzoom3').each(function() {
         
                     var xzoom = $(this).data('xzoom');
         
                     $(this).hammer().on("tap", function(event) {
         
                         event.pageX = event.gesture.center.pageX;
         
                         event.pageY = event.gesture.center.pageY;
         
                         var s = 1, ls;
         
         
         
                         xzoom.eventmove = function(element) {
         
                             element.hammer().on('drag', function(event) {
         
                                 event.pageX = event.gesture.center.pageX;
         
                                 event.pageY = event.gesture.center.pageY;
         
                                 xzoom.movezoom(event);
         
                                 event.gesture.preventDefault();
         
                             });
         
                         }
         
         
         
                         xzoom.eventleave = function(element) {
         
                             element.hammer().on('tap', function(event) {
         
                                 xzoom.closezoom();
         
                             });
         
                         }
         
                         xzoom.openzoom(event);
         
                     });
         
                 });
         
         
         
             $('.xzoom4').each(function() {
         
                 var xzoom = $(this).data('xzoom');
         
                 $(this).hammer().on("tap", function(event) {
         
                     event.pageX = event.gesture.center.pageX;
         
                     event.pageY = event.gesture.center.pageY;
         
                     var s = 1, ls;
         
         
         
                     xzoom.eventmove = function(element) {
         
                         element.hammer().on('drag', function(event) {
         
                             event.pageX = event.gesture.center.pageX;
         
                             event.pageY = event.gesture.center.pageY;
         
                             xzoom.movezoom(event);
         
                             event.gesture.preventDefault();
         
                         });
         
                     }
         
         
         
                     var counter = 0;
         
                     xzoom.eventclick = function(element) {
         
                         element.hammer().on('tap', function() {
         
                             counter++;
         
                             if (counter == 1) setTimeout(openfancy,300);
         
                             event.gesture.preventDefault();
         
                         });
         
                     }
         
         
         
                     function openfancy() {
         
                         if (counter == 2) {
         
                             xzoom.closezoom();
         
                             $.fancybox.open(xzoom.gallery().cgallery);
         
                         } else {
         
                             xzoom.closezoom();
         
                         }
         
                         counter = 0;
         
                     }
         
                 xzoom.openzoom(event);
         
                 });
         
             });
         
             
         
             $('.xzoom5').each(function() {
         
                 var xzoom = $(this).data('xzoom');
         
                 $(this).hammer().on("tap", function(event) {
         
                     event.pageX = event.gesture.center.pageX;
         
                     event.pageY = event.gesture.center.pageY;
         
                     var s = 1, ls;
         
         
         
                     xzoom.eventmove = function(element) {
         
                         element.hammer().on('drag', function(event) {
         
                             event.pageX = event.gesture.center.pageX;
         
                             event.pageY = event.gesture.center.pageY;
         
                             xzoom.movezoom(event);
         
                             event.gesture.preventDefault();
         
                         });
         
                     }
         
         
         
                     var counter = 0;
         
                     xzoom.eventclick = function(element) {
         
                         element.hammer().on('tap', function() {
         
                             counter++;
         
                             if (counter == 1) setTimeout(openmagnific,300);
         
                             event.gesture.preventDefault();
         
                         });
         
                     }
         
         
         
                     function openmagnific() {
         
                         if (counter == 2) {
         
                             xzoom.closezoom();
         
                             var gallery = xzoom.gallery().cgallery;
         
                             var i, images = new Array();
         
                             for (i in gallery) {
         
                                 images[i] = {src: gallery[i]};
         
                             }
         
                             $.magnificPopup.open({items: images, type:'image', gallery: {enabled: true}});
         
                         } else {
         
                             xzoom.closezoom();
         
                         }
         
                         counter = 0;
         
                     }
         
                     xzoom.openzoom(event);
         
                 });
         
             });
         
         
         
             } else {
         
                 //If not touch device
         
         
         
                 //Integration with fancybox plugin
         
                 $('#xzoom-fancy').bind('click', function(event) {
         
                     var xzoom = $(this).data('xzoom');
         
                     xzoom.closezoom();
         
                     $.fancybox.open(xzoom.gallery().cgallery, {padding: 0, helpers: {overlay: {locked: false}}});
         
                     event.preventDefault();
         
                 });
         
                
         
                 //Integration with magnific popup plugin
         
                 $('#xzoom-magnific').bind('click', function(event) {
         
                     var xzoom = $(this).data('xzoom');
         
                     xzoom.closezoom();
         
                     var gallery = xzoom.gallery().cgallery;
         
                     var i, images = new Array();
         
                     for (i in gallery) {
         
                         images[i] = {src: gallery[i]};
         
                     }
         
                     $.magnificPopup.open({items: images, type:'image', gallery: {enabled: true}});
         
                     event.preventDefault();
         
                 });
         
             }
         
         });
         
         })(jQuery);
         
      </script>
      <!--   CITIES  MODAL END-->
      <script>
         $(document).ready(function() {
         
         
         
           var owl = $("#owl-demo");
         
         
         
           owl.owlCarousel({
         
         autoPlay : 3000,
         
             stopOnHover : true,
         
           items : 3, //10 items above 1000px browser width
         
           itemsDesktop : [1000,3], //5 items between 1000px and 901px
         
           itemsDesktopSmall : [900,2], // 3 items betweem 900px and 601px
         
           itemsTablet: [600,1], //2 items between 600 and 0;
         
           itemsMobile : false // itemsMobile disabled - inherit from itemsTablet option
         
           
         
           });
         
         
         
           // Custom Navigation Events
         
           $(".next").click(function(){
         
             owl.trigger('owl.next');
         
           })
         
           $(".prev").click(function(){
         
             owl.trigger('owl.prev');
         
           })
         
         });
         
      </script>
      <script type="text/javascript">
         (function(e){var t,o={className:"autosizejs",append:"",callback:!1,resizeDelay:10},i='<textarea tabindex="-1" style="position:absolute; top:-999px; left:0; right:auto; bottom:auto; border:0; padding: 0; -moz-box-sizing:content-box; -webkit-box-sizing:content-box; box-sizing:content-box; word-wrap:break-word; height:0 !important; min-height:0 !important; overflow:hidden; transition:none; -webkit-transition:none; -moz-transition:none;"/>',n=["fontFamily","fontSize","fontWeight","fontStyle","letterSpacing","textTransform","wordSpacing","textIndent"],s=e(i).data("autosize",!0)[0];s.style.lineHeight="99px","99px"===e(s).css("lineHeight")&&n.push("lineHeight"),s.style.lineHeight="",e.fn.autosize=function(i){return this.length?(i=e.extend({},o,i||{}),s.parentNode!==document.body&&e(document.body).append(s),this.each(function(){function o(){var t,o;"getComputedStyle"in window?(t=window.getComputedStyle(u,null),o=u.getBoundingClientRect().width,e.each(["paddingLeft","paddingRight","borderLeftWidth","borderRightWidth"],function(e,i){o-=parseInt(t[i],10)}),s.style.width=o+"px"):s.style.width=Math.max(p.width(),0)+"px"}function a(){var a={};if(t=u,s.className=i.className,d=parseInt(p.css("maxHeight"),10),e.each(n,function(e,t){a[t]=p.css(t)}),e(s).css(a),o(),window.chrome){var r=u.style.width;u.style.width="0px",u.offsetWidth,u.style.width=r}}function r(){var e,n;t!==u?a():o(),s.value=u.value+i.append,s.style.overflowY=u.style.overflowY,n=parseInt(u.style.height,10),s.scrollTop=0,s.scrollTop=9e4,e=s.scrollTop,d&&e>d?(u.style.overflowY="scroll",e=d):(u.style.overflowY="hidden",c>e&&(e=c)),e+=w,n!==e&&(u.style.height=e+"px",f&&i.callback.call(u,u))}function l(){clearTimeout(h),h=setTimeout(function(){var e=p.width();e!==g&&(g=e,r())},parseInt(i.resizeDelay,10))}var d,c,h,u=this,p=e(u),w=0,f=e.isFunction(i.callback),z={height:u.style.height,overflow:u.style.overflow,overflowY:u.style.overflowY,wordWrap:u.style.wordWrap,resize:u.style.resize},g=p.width();p.data("autosize")||(p.data("autosize",!0),("border-box"===p.css("box-sizing")||"border-box"===p.css("-moz-box-sizing")||"border-box"===p.css("-webkit-box-sizing"))&&(w=p.outerHeight()-p.height()),c=Math.max(parseInt(p.css("minHeight"),10)-w||0,p.height()),p.css({overflow:"hidden",overflowY:"hidden",wordWrap:"break-word",resize:"none"===p.css("resize")||"vertical"===p.css("resize")?"none":"horizontal"}),"onpropertychange"in u?"oninput"in u?p.on("input.autosize keyup.autosize",r):p.on("propertychange.autosize",function(){"value"===event.propertyName&&r()}):p.on("input.autosize",r),i.resizeDelay!==!1&&e(window).on("resize.autosize",l),p.on("autosize.resize",r),p.on("autosize.resizeIncludeStyle",function(){t=null,r()}),p.on("autosize.destroy",function(){t=null,clearTimeout(h),e(window).off("resize",l),p.off("autosize").off(".autosize").css(z).removeData("autosize")}),r())})):this}})(window.jQuery||window.$);
         
         
         
         var __slice=[].slice;(function(e,t){var n;n=function(){function t(t,n){var r,i,s,o=this;this.options=e.extend({},this.defaults,n);this.$el=t;s=this.defaults;for(r in s){i=s[r];if(this.$el.data(r)!=null){this.options[r]=this.$el.data(r)}}this.createStars();this.syncRating();this.$el.on("mouseover.starrr","span",function(e){return o.syncRating(o.$el.find("span").index(e.currentTarget)+1)});this.$el.on("mouseout.starrr",function(){return o.syncRating()});this.$el.on("click.starrr","span",function(e){return o.setRating(o.$el.find("span").index(e.currentTarget)+1)});this.$el.on("starrr:change",this.options.change)}t.prototype.defaults={rating:void 0,numStars:5,change:function(e,t){}};t.prototype.createStars=function(){var e,t,n;n=[];for(e=1,t=this.options.numStars;1<=t?e<=t:e>=t;1<=t?e++:e--){n.push(this.$el.append("<span class='glyphicon .glyphicon-star-empty'></span>"))}return n};t.prototype.setRating=function(e){if(this.options.rating===e){e=void 0}this.options.rating=e;this.syncRating();return this.$el.trigger("starrr:change",e)};t.prototype.syncRating=function(e){var t,n,r,i;e||(e=this.options.rating);if(e){for(t=n=0,i=e-1;0<=i?n<=i:n>=i;t=0<=i?++n:--n){this.$el.find("span").eq(t).removeClass("glyphicon-star-empty").addClass("glyphicon-star")}}if(e&&e<5){for(t=r=e;e<=4?r<=4:r>=4;t=e<=4?++r:--r){this.$el.find("span").eq(t).removeClass("glyphicon-star").addClass("glyphicon-star-empty")}}if(!e){return this.$el.find("span").removeClass("glyphicon-star").addClass("glyphicon-star-empty")}};return t}();return e.fn.extend({starrr:function(){var t,r;r=arguments[0],t=2<=arguments.length?__slice.call(arguments,1):[];return this.each(function(){var i;i=e(this).data("star-rating");if(!i){e(this).data("star-rating",i=new n(e(this),r))}if(typeof r==="string"){return i[r].apply(i,t)}})}})})(window.jQuery,window);$(function(){return $(".starrr").starrr()})
         
         
         
         $(function(){
         
         
         
         $('#new-review').autosize({append: "\n"});
         
         
         
         var reviewBox = $('.post-review-box');
         
         var newReview = $('#new-review');
         
         var openReviewBtn = $('#open-review-box');
         
         var closeReviewBtn = $('#close-review-box');
         
         var ratingsField = $('#ratings-hidden');
         
         
         
         openReviewBtn.click(function(e)
         
         {
         
         reviewBox.slideDown(400, function()
         
           {
         
             $('#new-review').trigger('autosize.resize');
         
             newReview.focus();
         
           });
         
         // openReviewBtn.fadeOut(100);
         
         closeReviewBtn.show();
         
         });
         
         
         
         closeReviewBtn.click(function(e)
         
         {
         
         e.preventDefault();
         
         reviewBox.slideUp(300, function()
         
           {
         
             newReview.focus();
         
             openReviewBtn.fadeIn(200);
         
           });
         
         closeReviewBtn.hide();
         
         
         
         });
         
         
         
         $('.starrr').on('starrr:change', function(e, value){
         
         ratingsField.val(value);
         
         });
         
         });
         
      </script>
      @yield("scripts")
   </body>
   <style type="text/css">
     @media only screen and (max-width: 640px) {
span.round.merchnat_btn {
    background-color: unset !important;
    color: #fff !important;
    border: unset !important;
      margin-bottom: 0px !important;
}
span.round.customer_btn {
    background-color: unset !important;
    color: #fff !important;
}
}
   </style>
</html>
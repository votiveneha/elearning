<!DOCTYPE html>



<html>



<head>



    <meta charset="UTF-8">



    <title>Merchant | Dashboard</title>



    <meta name="csrf-token" content="{{ csrf_token() }}">



    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>



    @section("style")

   <link rel="shortcut icon" href="{{ asset('/design/front/img/favicon.png') }}" type="image/x-icon">

    <!-- bootstrap 3.0.2 -->



    <link href="{{asset("/design/admin/css/bootstrap.min.css")}}" rel="stylesheet" type="text/css" />



    <!-- font Awesome -->



    <link href="{{asset('/design/admin/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />



    <!-- bootstrap wysihtml5 - text editor -->



    <link href="{{ asset('/design/admin/css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}" rel="stylesheet" type="text/css" />







    <link href="{{ asset('/design/admin/css/timepicker/bootstrap-timepicker.min.css') }}" rel="stylesheet" />







    <link href="{{ asset('/design/admin/css/datepicker/datepicker3.css') }}" rel="stylesheet" />



    <!-- Theme style -->



    <link href="{{ asset('/design/admin/css/AdminLTE.css') }}?var=<?php echo rand(); ?>" rel="stylesheet" type="text/css" />

    <script src="https://use.fontawesome.com/c1d89ec83d.js"></script>





    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->



    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->



    <!--[if lt IE 9]>



          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>



          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>



        <![endif]-->







    @show



    @yield("other_css")











</head>

<style type="text/css">

    #frame .content {

        padding: 0px !important;

    }



    #frame .content .message-input .wrap input {

        padding: 14px 32px 10px 8px !important;

    }



    #frame .content .message-input .wrap button {

        height: 40px !important;

    }



    a.navbar-btn.sidebar-toggle:hover {

        background-color: #EC7324;

        border-radius: 4px !important;

    }

</style>



<body class="skin-blue">



    <!-- header logo: style can be found in header.less -->



    <header class="header">



        <a href="{{ url('/merchant/dashboard') }}" class="logo">



            <!-- Add the class icon to your logo image or logo icon to add the margining -->



            <p class="merchat-logo">
                 <?php     $access_type = Auth::guard('vendor')->user()->type;
                 if(($access_type == 1) || ($access_type == 2)){
                    echo "Sub-Merchant Management";
                 }
                 else{
                    echo " Merchant Management";
                 }
                 ?>

            </p>



        </a>



        <!-- Header Navbar: style can be found in header.less -->



        <nav class="navbar navbar-static-top" role="navigation">



            <!-- Sidebar toggle button-->



            <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">



                <span class="sr-only">Toggle navigation</span>



                <span class="icon-bar"></span>



                <span class="icon-bar"></span>



                <span class="icon-bar"></span>



            </a>



            <div class="navbar-right">



                <ul class="nav navbar-nav">







                    <!-- User Account: style can be found in dropdown.less -->



                    <li class="dropdown user user-menu">



                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">



                            <span><i class="fa fa-user-circle-o" aria-hidden="true" style="font-size: 25px;"></i></span>



                        </a>



                        <ul class="dropdown-menu">



                            <!-- Menu Footer-->



                            <li class="user-footer">



                                <!--<div class="pull-left">



                                        <a href="#" class="btn btn-default btn-flat">Profile</a>



                                    </div>-->



                                <div class="pull-right">



                                    <a href="{{ url('/merchant/update_profile') }}" class="btn btn-default btn-flat">View Profile</a>



                                </div>



                            </li>











                            <li class="user-footer">



                                <!--<div class="pull-left">



                                        <a href="#" class="btn btn-default btn-flat">Profile</a>



                                    </div>-->



                                <div class="pull-right">



                                    <a href="{{ url('/merchant/change_password') }}" class="btn btn-default btn-flat">Manage Password</a>



                                </div>



                            </li>



                <li class="user-footer">



                <div class="pull-right">



                  <a href="{{ url('/merchant/account_delete') }}" class="btn btn-default btn-flat">Account Delete</a>



                  </div>



<!--                                 <div class="pull-right">



                                    <a href="{{ route('vendor.membershipPlans') }}" class="btn btn-default btn-flat">Manage Membership</a>



                                </div> -->



                            </li>



                            <li class="user-footer">



                                <!--<div class="pull-left">



                                        <a href="#" class="btn btn-default btn-flat">Profile</a>



                                    </div>-->



                                <div class="pull-right">



                                    <a href="{{ url('/merchant/logout') }}" class="btn btn-default btn-flat">Sign out</a>



                                </div>



                            </li>



                        </ul>



                    </li>



                </ul>



            </div>



        </nav>



    </header>



    <div class="wrapper row-offcanvas row-offcanvas-left">



        <!-- Left side column. contains the logo and sidebar -->



        <aside class="left-side sidebar-offcanvas">



            <!-- sidebar: style can be found in sidebar.less -->



            <section class="sidebar">



                <!-- sidebar menu: : style can be found in sidebar.less -->





                <ul class="sidebar-menu" data-widget="tree">



                    <li class="@if((Request::segment(2) == 'dashboard'))active @endif">



                        <a href="{{ url('/merchant/dashboard') }}">



                            <i class="fa fa-dashboard"></i> <span>Dashboard</span>



                        </a>



                    </li>







                    <!--<li class="@if((Request::segment(2) == 'my_wallet'))active @endif">



                            <a href="{{ url('/vendor/my_wallet') }}">



                                <i class="fa fa-inr"></i> <span>Wallet Account</span>



                            </a>



                        </li>







                        <li class="@if((Request::segment(2) == 'paymentlisting') || (Request::segment(2) == 'payment_view'))active @endif">



                            <a href="{{ url('/vendor/paymentlisting') }}">



                                <i class="fa fa-exchange"></i> <span>Order Summary</span>



                            </a>



                        </li>-->



                    <li class="@if(Request::segment(2) == 'shopping-cart')active @endif">



                        <a href="{{ url('/merchant/shopping-cart') }}"><i class="fa fa-th-large"></i> Shopping Cart Setting</a>



                    </li>



                    <?php //echo Request::segment(2); 

                    ?>





                    <li class="treeview @if((Request::segment(2) == 'product-form') || (Request::segment(2) == 'all-product-list') || (Request::segment(2) == 'merchant-product-view') || (Request::segment(2) == 'merchant-product-inventory')|| (Request::segment(2) == 'admin-merchant-product-form') || (Request::segment(2) == 'my-product-list') || (Request::segment(2) == 'admin-product-list'))active @endif">

                        <a href="{{ url('/merchant/all-product-list') }}"><i class="fa fa-th-large"></i> <span>Product Management</span>

                            <span class="pull-right-container">

                                <i class="fa fa-angle-left pull-right"></i>

                            </span>

                        </a>

                        <ul class="treeview-menu">

                            <li><a href="{{ url('/merchant/all-product-list') }}">All Products</a></li>

                            <li><a href="{{ url('/merchant/my-product-list') }}">My Products</a></li>

                            <li><a href="{{ url('/merchant/admin-product-list') }}">Admin Product</a></li>

                        </ul>

                    </li>



                     <li class="treeview @if((Request::segment(2) == 'event-form') || (Request::segment(2) == 'all-event-list') || (Request::segment(2) == 'merchant-event-view') || (Request::segment(2) == 'merchant-event-inventory')|| (Request::segment(2) == 'admin-merchant-event-form') || (Request::segment(2) == 'my-event-list') || (Request::segment(2) == 'admin-event-list'))active @endif">

                        <a href="{{ url('/merchant/all-event-list') }}"><i class="fa fa-th-large"></i> <span>Event Management</span>

                            <span class="pull-right-container">

                                <i class="fa fa-angle-left pull-right"></i>

                            </span>

                        </a>

                        <ul class="treeview-menu">

                            <li><a href="{{ url('/merchant/all-event-list') }}">All Events</a></li>

                            <li><a href="{{ url('/merchant/my-event-list') }}">My Events</a></li>

                            <li><a href="{{ url('/merchant/admin-event-list') }}">Admin Event</a></li>

                        </ul>

                    </li>



                    <!--<li class="@if((Request::segment(2) == 'service-form') || (Request::segment(2) == 'service-list') || (Request::segment(2) == 'menu_list') || (Request::segment(2) == 'menu-form')|| (Request::segment(2) == 'menu_categorylist') || (Request::segment(2) == 'category-form') || (Request::segment(2) == 'menu_cate_item_list') || (Request::segment(2) == 'category-item-form'))active @endif">



                       <a href="{{ url('/merchant/service-list') }}"><i class="fa fa-truck"></i>Services Management</a>



                       </li>-->















                    <!--<li class="@if((Request::segment(2) == 'scheduled_order') || (Request::segment(2) == 'scheduled_order_view'))active @endif">



                            <a href="{{ url('/vendor/scheduled_order') }}">



                                <i class="fa fa-calendar"></i> <span>Scheduled Order </span>



                            </a>



                        </li>-->







                    <li class="@if((Request::segment(2) == 'coupon-code') || (Request::segment(2) == 'coupon-form')  || (Request::segment(2) == 'coupon-edit-form'))active @endif">



                        <a href="{{ url('/merchant/coupon-code') }}">



                            <i class="fa fa-tag fa-lg" aria-hidden="true"></i>



                            <span>Coupons Management</span>



                        </a>



                    </li>







                    <li class="@if((Request::segment(2) == 'order-list') || (Request::segment(2) == 'order_view'))active @endif">



                        <a href="{{ url('/merchant/order-list') }}">



                            <i class="fa fa-exchange"></i> <span>Order Management</span>



                        </a>



                    </li>



                      <li class="@if((Request::segment(2) == 'event-list') || (Request::segment(2) == 'event_view'))active @endif">



                    <a href="{{ url('/merchant/event-list') }}">



                    <i class="fa fa-exchange"></i> <span>Event Order</span>



                    </a>



                    </li>





                    <li class="@if((Request::segment(2) == 'report-order-list') || (Request::segment(2) == 'report-order-list'))active @endif">



                        <a href="{{ url('/merchant/order_report') }}">



                            <i class="fa fa-file"></i> <span>Reporting Management</span>



                        </a>



                    </li>





                    <li class="@if((Request::segment(2) == 'product-order-list') || (Request::segment(2) == 'product_report'))active @endif">

                        <a href="{{ url('/merchant/product_report') }}">

                            <i class="fa fa-file"></i> <span>Product Sale Reports</span>

                        </a>
                    </li>

                    <!--<li class="@if((Request::segment(2) == 'return-list')) )active @endif">



                        <a href="{{ url('/merchant/return-list') }}">



                        <i class="fa fa-exchange"></i> <span>Return Order Management</span>



                        </a>



                        </li> -->







                    <li class="@if((Request::segment(2) == 'payment-list') || (Request::segment(2) == 'payment-details'))active @endif">



                        <a href="{{ url('/merchant/payment-list') }}">



                            <i class="fa fa-usd" aria-hidden="true"></i>



                            <span>Payment History</span>



                        </a>



                    </li>
                    
                    <?php     $access_type = Auth::guard('vendor')->user()->type;?>
                    @if($access_type == 0 )
           <li class="@if((Request::segment(2) == 'add-sub-merchant') || (Request::segment(2) == 'add-sub-merchant'))active @endif">

                   
   <a href="{{ url('/merchant/sub-merchant-list') }}">
                            <i class="fa fa-user" aria-hidden="true"></i>
                            <span>Staff Management</span>
                        </a>
                  

  </li>
           
            @endif  

                    





                    <!-- 

                        <li class="@if((Request::segment(2) == 'bank-account'))active @endif">



                          <a href="{{ url('/merchant/bank-account') }}">



                            <i class="fa fa-usd" aria-hidden="true"></i>



                            <span>Bank Account</span>



                          </a>



                        </li>







                        <li class="@if((Request::segment(2) == 'social-media'))active @endif">



                          <a href="{{ url('/merchant/social-media') }}">



                            <i class="fa fa-user" aria-hidden="true"></i>



                            <span>Social Media</span>



                          </a>



                        </li> -->







                    <!-- <li class="@if((Request::segment(2) == 'review_list') || (Request::segment(2) == 'page-form'))active @endif">



                            <a href="{{ url('/merchant/review_list') }}">



                                <i class="fa fa-star"></i> <span>Review & Rating </span>



                            </a>



                        </li>







                        <li class="@if((Request::segment(2) == 'review_rating_report') || (Request::segment(2) == 'review_rating_items'))active @endif">



                            <a href="{{ url('/merchant/review_rating_report') }}">



                                <i class="fa fa-star"></i> <span>Review & Rating Reports</span>



                            </a>



                        </li>



						            



                        



                        <li class="@if((Request::segment(2) == 'send_notification'))active @endif">



                            <a href="{{ url('/vendor/send_notification') }}">



                                <i class="fa fa-bell"></i> <span>Send Notification to User </span>



                            </a>



                        </li>-->















                    <!-- <li class="@if((Request::segment(2) == 'view_menu_template'))active @endif">



                            <a href="{{ url('/vendor/view_menu_template') }}">



                                <i class="fa fa-dashboard"></i> <span>View Menu Template </span>



                            </a>



                        </li> -->







                </ul>



            </section>



            <!-- /.sidebar -->



        </aside>











        @yield("content")



    </div><!-- ./wrapper -->







    <!-- add new calendar event modal -->



    <!-- jQuery 2.0.2 -->



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>



    <!-- jQuery UI 1.10.3 -->



    <script src="{{ asset('design/admin/js/jquery-ui-1.10.3.min.js') }}" type="text/javascript"></script>



    <!-- Bootstrap -->



    <script src="{{ asset('/design/admin/js/bootstrap.min.js') }}" type="text/javascript"></script>



    <!-- Bootstrap WYSIHTML5 -->



    <script src="{{ asset('/design/admin/js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}" type="text/javascript"></script>



    <!-- AdminLTE App -->



    <script src="{{ asset('/design/admin/js/AdminLTE/app.js') }}" type="text/javascript"></script>



    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->



    <script src="{{ asset('design/admin/js/AdminLTE/dashboard.js') }}" type="text/javascript"></script>



    <script src="https://jqueryvalidation.org/files/dist/jquery.validate.min.js"></script>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>

  <script type="text/javascript">

    $(function() {

      $("#datepicker").datepicker({

        // autoclose: true,

        todayHighlight: true

      });

    });

  </script>





    <script type="text/javascript">

        function mlivechat() {



            var cmerchantid = $('#cmerchantid').val();



            if (cmerchantid != '') {



                $.ajax({



                    type: "post",



                    headers: {

                        'X-CSRF-Token': $('meta[name=csrf-token]').attr('content')

                    },



                    data: {



                        "_token": "{{ csrf_token() }}",



                        "chat_data": {

                            cmerchantid: cmerchantid

                        },



                    },



                    url: "{{url('/mchatmlist')}}",



                    success: function(msg) {



                        $('#contacts').html(msg);



                    }



                });



                $('#frame').toggle();



            }



        };





        $('body').on('click', '.contact', function() {



            mimags = $(this).attr('id');



            mnames = $(this).text();



            merchid = $(this).attr("value");



            $('#nmerchant').html(mnames);



            $('#mmerchant').attr("src", mimags);



            $('#cuserid').val(merchid);



            $('#mmerchant').show();



        });







        function myChat() {



            var cmessage = $('#cmessage').val();



            var cuserid = $('#cuserid').val();



            var cmerchantid = $('#cmerchantid').val();



            if (cmessage == '') {

                return false;

            }



            $.ajax({



                type: "post",



                headers: {

                    'X-CSRF-Token': $('meta[name=csrf-token]').attr('content')

                },



                data: {



                    "_token": "{{ csrf_token() }}",



                    "chat_data": {

                        cmessage: cmessage,

                        cuserid: cuserid,

                        cmerchantid: cmerchantid

                    },



                },



                url: "{{url('/mchatsystem')}}",



                success: function(msg) {



                    $('#cmessage').val('');



                    $('#messages').html(msg);



                }



            });



        };



       /* function timeChat() {



            var cuserid = $('#cuserid').val();



            var cmerchantid = $('#cmerchantid').val();



            if (cmessage != '' && cmerchantid != '') {



                $.ajax({



                    type: "post",



                    headers: {

                        'X-CSRF-Token': $('meta[name=csrf-token]').attr('content')

                    },



                    data: {



                        "_token": "{{ csrf_token() }}",



                        "chat_data": {

                            cuserid: cuserid,

                            cmerchantid: cmerchantid

                        },



                    },





                    url: "{{url('/mchathistory')}}",



                    success: function(msg) {



                        $('#messages').html(msg);



                    }



                });





            } else {

                return false;

            }





        };



        var myVar = setInterval(timeChat, 3000); */

    </script>





    <script type="text/javascript">

        function delete_wal()



        {



            var conf = confirm("Are you sure to delete this record?");



            if (conf)



            {



                return true;



            } else



            {



                return false;



            }



        }











        function delete_parent(child_val)



        {



            if (child_val > 0)



            {



                alert("Some data connect with that so, please delete 1st that.");



                return false;



            } else



            {



                var conf = confirm("Are you sure to delete this record?");



                if (conf)



                {



                    return true;



                } else



                {



                    return false;



                }



            }



        }

    </script>







    @yield("js_bottom")

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment-with-locales.min.js"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>

    <script>

        $(function() {

            $('#mondatetimepicker31').datetimepicker({

                format: 'LT'

            });

        });

        $(function() {

      $('#mondatetimepicker32').datetimepicker({

        format: 'LT'

      });

    });

    </script>

</body>



</html>
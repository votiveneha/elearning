<!DOCTYPE html>
<html class="bg-black">
    <head>
        <meta charset="UTF-8">
        <title>Admin Log in</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- bootstrap 3.0.2 -->
        <link href="{{ url('/') }}/design/admin/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="{{ url('/') }}/design/admin/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="{{ url('/') }}/design/admin/css/AdminLTE.css?var=<?php echo rand();?>" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="bg-black">


			 @yield("content")
        <!-- jQuery 2.0.2 -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="{{ url('/') }}/design/admin/js/bootstrap.min.js" type="text/javascript"></script>     
		
<script src="https://jqueryvalidation.org/files/dist/jquery.validate.min.js"></script>
<!-- 		<script>
		 $(document).on('click', '#sign_in', function(){ 
		 	
			var form = $("#signin");
				form.validate();
			var valid =	form.valid();
		 });
		</script>    -->

    </body>
</html>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width">
<meta http-equiv="X-UA-Compatible" content="IE=edge"> 
<meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7" />
<title>SPORT TOURNAMENT</title>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" >
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/font-awesome.min.css" >
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/master.css"> 
<link rel="stylesheet" type="text/css" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" /> 
<!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/newstyle.css"> -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/owl.theme.css">
<link rel="icon" href="<?php echo base_url(); ?>assets/images/favicon.ico" type="image/x-icon">


<script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery.validate.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/owl.carousel.min.js"></script>
<script src="<?php echo base_url();?>assets/js/scroll/jquery.scrollbox.js"></script>

<link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i" rel="stylesheet">
</head>
<body>
<header>
    <div class="header new">
        <div class="page-new old">
            <nav class="navbar navbar-default" role="navigation">
                <div class="navigation">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>assets/images/logo.png" class="img-responsive"></a>
                    </div>
        
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse hdr_clps_blck" id="bs-example-navbar-collapse-1">
                        <div class="row">
						<?php if($this->uri->segment('1') != 'profile-page'){ ?>
						<form method="post" id="search_form"   name="search">
                            <ul class="nav navbar-nav">
                                <li class="active li_first"><a href="<?php echo base_url(); ?>tournaments">Tournament</a></li>
								<?php $tournament = $this->Common_model->getAll('tournament'); ?>
                                <li class="li_sec"><a href="#" class="all-br"><?php echo count($tournament); ?></a></li>
                                <li class="search-li">
                                    <div class="input-append">
                                        <input type="text" id="search_tournament" name="search_tournament" placeholder="Search game and tournaments">
										<!--<a href="#"> <span class="add-on"><i class="fa fa-search"></i></span></a>-->
										<button class="add-on pull-right" disabled name="search" type="submit"><img src="<?php echo base_url();?>assets/images/srch_head2.png" /></button>
                                    </div>
                                </li>
                            </ul>
                          </form>  
						<?php  }else{  ?>
						 <form id="search_form" method="post" action="<?php echo base_url().'search-users/';?>" name="search">
                            <ul class="nav navbar-nav">
                                <li class="active li_first"><a href="<?php echo base_url(); ?>tournaments">Tournament</a></li>
								<?php $tournament = $this->Common_model->getAll('tournament'); ?>
                                <li class="li_sec"><a href="#" class="all-br"><?php echo count($tournament); ?></a></li>
                                <li class="search-li">
                                    <div class="input-append">
                                        <input type="text" id="search_users" name="search_users" placeholder="Search game and users">
										<!--<a href="#"> <span class="add-on"><i class="fa fa-search"></i></span></a>-->
										<button class="add-on pull-right" disabled  name="search" type="submit"><img src="<?php echo base_url();?>assets/images/srch_head2.png" /></button>
                                    </div>
                                </li>
                            </ul>
                          </form>  
						<?php } ?>
                            <ul class="nav navbar-nav navbar-right">
							<?php $users = $this->Common_model->getsingle('users',array('id' => $this->session->userdata('userid'))); //print_r($user).'hello'; ?>
                                <li class="profile " id="devprofile"><a href="<?php echo base_url(); ?>profile-page"><?php if($users->image){ ?><img src="<?php echo base_url(); ?>user_image/<?php echo $user->image; ?>"><?php }else{ ?><img src="<?php echo base_url(); ?>assets/images/no-image.png"><?php } ?> <!--SCN96--><span class="user-name"><?php if(!empty($user)){echo ucwords($user->username);} ?></span></a> &nbsp; <a id="load_dynamic" href="<?php echo base_url(); ?>home">Home </a> &nbsp; <a id="load_dynamic" href="<?php echo base_url(); ?>online-wallet"> <?php echo $user->wallet; ?> <?php echo $users->currency; ?></a></li>
                                 <!--user request-->
                                <li class="dropdown">
                                    <a href="javascript:void(0);" id="read_notification" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell-o"></i>
								<?php $notification_data_val = $this->Common_model->getAllwhere('notifications',array('is_read' => 0,'type' => 'ACCEPTREQUEST','friend_user_id' => $this->session->userdata('userid'))); //echo '<pre>';print_r($notification_data_val); ?>			
									<?php if(count($notification_data_val) != '0'){ ?>
									<span class="pending_icon"><?php echo count($notification_data_val); ?></span>
									<?php } ?>
									</a>
                                    <ul class="dropdown-menu">
									<div class="req3">
                                        <div class="requests req4">
										  
                                            <P>Notifications</P>
  <?php
   $notices = $this->Common_model->get_all_results_with_join('notifications.*,users.username,users.image','notifications','users','notifications.user_id = users.id',array('notifications.user_id !='=>$this->session->userdata('userid'),'friend_user_id'=>$this->session->userdata('userid')),'notification_id','desc',5);
  //echo '<pre>'; print_r($notices);die;
   $unreadnotice = $this->Common_model->countwhereuser('notifications',array('user_id !='=>$this->session->userdata('userid'),'friend_user_id'=>$this->session->userdata('userid')));
 
  if(!empty($notices)){
  foreach($notices as $notification){
  ?>
										
			 <div class="requ-box">
				<div class="requ-profile">
				<?php if(!empty($notification->image)){ ?>
                <img src="<?php echo base_url(); ?>user_image/<?php echo $notification->image; ?>" />
                  <?php }else{ ?>
				<img src="<?php echo base_url(); ?>assets/images/no-image.png" />
				<?php } ?>
				</div>
			<div class="requ-data">
			<?php if($notification->type == 'Like'){ ?> 
			<?php $names = $this->Common_model->getsingle('users',array('id' => $notification->friend_user_id)); ?>
                <p><a href="<?php echo base_url(); ?>Welcome/single_notification/<?php echo $notification->post_id; ?>/<?php echo $notification->notification_id; ?>" ><span class="dark-name"><?php echo ucwords($notification->username); ?></span> like on <span class="dark-name"><span class="dark-name"><?php echo ucwords($names->username); ?></span> Post</span></a>  </p>	
			<?php }elseif($notification->type == 'Share'){ ?> 
			<?php $names = $this->Common_model->getsingle('users',array('id' => $notification->friend_user_id)); ?>
                <p><a href="<?php echo base_url(); ?>Welcome/single_notification/<?php echo $notification->post_id; ?>/<?php echo $notification->notification_id; ?>" ><span class="dark-name"><?php echo ucwords($notification->username); ?></span> share on <span class="dark-name"><span class="dark-name"><?php echo ucwords($names->username); ?></span> Post</span></a>  </p>	
			<?php }elseif($notification->type == 'ACCEPTREQUEST'){ ?> 
                <p><a href="<?php echo base_url(); ?>user-profile/<?php echo $notification->user_id; ?>" ><span class="dark-name">Me</span> become friends with <span class="dark-name"><?php echo ucwords($notification->username); ?></span></a>  </p>	
            <?php }elseif($notification->type == 'SENDREQUEST'){ ?> 
			<?php $names = $this->Common_model->getsingle('users',array('id' => $notification->friend_user_id)); ?>
                <p><a href="<?php echo base_url(); ?>user-profile/<?php echo $notification->user_id; ?>" ><span class="dark-name"><?php echo ucwords($notification->username); ?></span> sent <span class="dark-name"><?php echo ucwords($names->username); ?></span> a friend request  </a></p>			
			<?php }elseif($notification->type == 'Comment'){ ?>
			<?php $names = $this->Common_model->getsingle('users',array('id' => $notification->friend_user_id)); ?>
			 <p><a href="<?php echo base_url(); ?>Welcome/single_notification/<?php echo $notification->post_id; ?>/<?php echo $notification->notification_id; ?>" ><span class="dark-name"><?php echo ucwords($notification->username); ?></span> commented on <span class="dark-name"><?php echo ucwords($names->username); ?></span> Post </a></p>
			<?php } ?>
			</div>  
			</div>
		<?php	}if($unreadnotice > count($notices)){ ?>
			<p class="c_mre_noti">
		    	<a href="<?php echo base_url(); ?>more-notification">See More</a>
			</p>
		<?php }}else{ echo '<p class="no_recrd_avail">No record available</p>';} ?>
          </div>										
		</div>
    </ul>
</li>
<!--user request-->
    <li class="dropdown">
    <a href="javascript:void(0);" id="req_notification" class="dropdown-toggle" data-toggle="dropdown"><img src="<?php echo base_url(); ?>assets/images/top_head_usr.png" class="usr_head">
		<?php $notification_data_req = $this->Common_model->getAllwhere('notifications',array('is_read' => 0,'type' => 'SENDREQUEST','friend_user_id' => $this->session->userdata('userid'))); ?>			
	<?php if(count($notification_data_req) != '0'){ ?>
	<span class="pending_icon"><?php echo count($notification_data_req); ?></span>
		<?php } ?>
</a>
 <ul class="dropdown-menu">
	<div class="req1">
   <div class="requests req2">	  
       <P>Friend Requests</P>
		<?php 											
		$friend_request = $this->Common_model->jointwotable('users','id','friends','user_id',array('friends.friend_user_id' => $this->session->userdata('userid'),'friends.request_status' => 0),'users.image,friends.friend_id,users.username,friends.friend_user_id,friends.user_id');										
		if(!empty($friend_request)){
		foreach($friend_request as $frnd_sug){                                    
		$uid = $this->session->userdata('userid');
		$res = $this->db->query("select * from friends where ((friend_user_id = '".$frnd_sug->user_id."' and user_id = '".$uid."') or (friend_user_id = '".$uid."' and user_id = '".$frnd_sug->user_id."')) and request_status = 0")->row_array(); 
      ?>
        <div class="requ-box">
         <div class="requ-profile">
		 <?php if(!empty($frnd_sug->image)){ ?>
        <img src="<?php echo base_url(); ?>user_image/<?php echo $frnd_sug->image; ?>" />
        <?php }else{ ?>
		<img src="<?php echo base_url(); ?>assets/images/no-image.png" />
		<?php } ?>
	</div>
  <div class="requ-data">
    <p class="name"><?php echo ucwords($frnd_sug->username); ?></p>
  <a href="javascript:void(0)" class="conf accept_request" data-listid="<?php echo $res['friend_id']; ?>"  data-frndsug="<?php echo $frnd_sug->username; ?>" data-frndid="<?php echo $frnd_sug->user_id; ?>" >Confirm</a> <a href="javascript:void(0);" class="del_request" data-listid="<?php echo $res['friend_id']; ?>">Delete request</a>   
</div>                                              
 </div>
	<?php }}else{ echo '<p class="no_recrd_avail">No record available</p>';} ?>
       </div>
	</div>
 </ul>
                                </li>
                                <!--Chat-->
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-comment"></i>
									<!--<span class="pending_icon">16</span>-->
									</a>
                                    <ul class="dropdown-menu">
                                        <div class="chat1">
                                            <P>Chat</P>
                                            <div class="requ-box1">
                                                                                                                 <?php  $this->load->view('chat');?> 
                                            </div>
                                        </div>
                                    </ul>
                                </li>
								
								  <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-comment"></i>
                                    <!--<span class="pending_icon">16</span>-->
       </a>
                <ul class="dropdown-menu">
                <div class="chat1">
                    <P>Chat</P>
                    <div class="requ-box1">                                      <?php   $this->load->view('live_support');?> 
                    </div>
                </div>
            </ul>
    </li>
								
								
								
								
                                <!--Sign-out-setting-->
                                <li class="dropdown sign_out_othr_nav">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="<?php echo base_url(); ?>assets/images/head_arrow.png" class="arr1" /></a>
                                    <ul class="dropdown-menu">
                                        <!--<li><a href="<?php echo base_url();?>welcome/hall_of_fame">
                                        Hall of Fame</a></li>-->
                                        <!--<li><a href="#">Blog</a></li>-->
                                        <!--<li><a href="<?php //echo base_url(); ?>features">Freatures</a></li>-->
                                        <li><a href="<?php echo base_url(); ?>contact-us">Contact us</a></li>
                                        <li><a href="<?php echo base_url(); ?>Welcome/logout">Sign out</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div><!-- /.navbar-collapse -->
                    </div><!-- /.container-fluid -->
                </div>
            </nav>
        </div>
        <div class="mobi-new">
        	<ul class="ul-fisrt">
        		<li class="logo-li"><a href="#"><img src="assets/images/logo.png" class="img-responsive"></a></li>
        		<li><a href="tournaments.html">Tournament</a></li>
        		<li><a href="#" class="all-br">795</a></li>
        		<li class="profile pull-right"><a href="profile_page.html"><img src="assets/images/user.jpg"></a></li>
        	</ul>
        	<ul class="nav navbar-nav">
        		 <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user-o"></i></a>
                    <ul class="dropdown-menu">
					
                        <div class="requests">
						
                            <P>Friend Requests</P>
	<?php 
		$friend_request = $this->Common_model->jointwotable('users','id','friends','user_id',array('friends.friend_user_id' => $this->session->userdata('userid'),'friends.request_status' => 0),'users.image,friends.friend_id,users.username,friends.friend_user_id,friends.user_id');
		//  echo '<pre>'; print_r($friend_request);die;
	if(empty($friend_request) && (!$this->input->is_ajax_request())){
	$this->session->set_flashdata('notfound','Friend Request not available');
	}
    foreach($friend_request as $frnd_sug){
	$uid = $this->session->userdata('userid');
	$res = $this->db->query("select * from friends where ((friend_user_id = '".$frnd_sug->user_id."' and user_id = '".$uid."') or (friend_user_id = '".$uid."' and user_id = '".$frnd_sug->user_id."')) and request_status = 0")->row_array();
	?>
                            <div class="requ-box">
                                <div class="requ-profile">
                                    <!--<img src="assets/images/user.jpg"> -->
                                    <img src="<?php echo base_url(); ?>user_image/<?php echo $frnd_sug->image; ?>" />									
                                </div>
                                <div class="requ-data">
                                    <p class="name"><?php echo ucwords($frnd_sug->username); ?></p>
                                     <a href="javascript:void(0)" class="conf accept_request" data-listid="<?php echo $res['friend_id']; ?>" data-username="<?php echo $this->session->userdata('firstname'); ?>" data-frndsug="<?php echo $frnd_sug->username; ?>" data-frndid="<?php echo $frnd_sug->user_id; ?>" >Confirm</a> <a href="">Delete request</a>      
                                </div>                                              
                            </div>
							<?php } ?>
                        </div>
						
                    </ul>
                </li>
                <!--Chat-->
                <li class="dropdown chat-demo">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-comment"></i></a>
                    <ul class="dropdown-menu">
                        <div class="chat1">
                            <P>Chat</P>
                            <div class="requ-box">
                                <div class="requ-profile">
                                    <img src="assets/images/user.jpg">  
                                </div>
                                <div class="requ-data">
                                    <p class="name">CR7</p>
                                    <p><span class="msg">Yes ha ha</span></p>   
                                </div>                                              
                            </div>
                        </div>
                    </ul>
                </li>
    			<li class="dropdown requ-demo">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-caret-down"></i></a>
                    <ul class="dropdown-menu">
                        <li><a href="hall_of_fame.html">
                        Hall of Fame</a></li>
                        <li><a href="#">Blog</a></li>
                        <li><a href="our_features.html">Freatures</a></li>
                        <li><a href="contact-us.html">Contact us</a></li>
                        <li><a href="index.html">Sign out</a></li>
                    </ul>
                </li>

        		<li class="search-li pull-right">
		            <div class="input-append">
		                <input type="text" id="" name="" placeholder="Search game and tournaments"><a href="#"> <span class="add-on"><i class="fa fa-search"></i></span></a>
		            </div>
		        </li>
        	</ul>
        </div>
    </div>
</header>
<script>
   $(document).on('click','.accept_request',function(){ 
		
			///$( this ).before( '<i class="fa fa-spinner fa-pulse"></i>' );
			var listid = $(this).attr("data-listid");
			var frnd_id = $(this).attr("data-frndid");
			var frndsug = $(this).attr("data-frndsug");
			var username = $(this).attr("data-username");
			$.post("<?php echo base_url().'Welcome/respondRequest'; ?>",  
			{ listid: listid, frnd_id: frnd_id,  frndsug: frndsug,username: username},
					function(response){ 
							 $(".req2").load(location.href + " .req1");
							//$("#successmsg").show().text('accept successfully');John and Tim are friends
							//$("#successmsg").show().text(response.username+ ' and ' +response.friend_name+ ' are friends');
							//$("#frnd_list").load(location.href + " #frnd_list_sub");
							//$('#friend_re').show();
			}, "json");
		});
		$(document).on('click','.del_request',function(){
			//$( this ).before( '<i class="fa fa-spinner fa-pulse"></i>' );
			var catid = $(this).attr('data-listid');
			$.post("<?php echo base_url().'Welcome/cancel'; ?>",  
			{ catid: catid },
					function(response){
                          //$("#erormsg").show().text('Delete Friend Request');						
						  $(".req2").load(location.href + " .req1");
			}, "json");
		});
		
		
		$(document).on('click','#read_notification',function(){				
			$.post("<?php echo base_url().'Welcome/read_notification'; ?>",  
			{},
					function(response){
                        
			}, "json"); 
	   });
	   
	   $(document).on('click','#req_notification',function(){				
			$.post("<?php echo base_url().'Welcome/request_notification'; ?>",  
			{},
					function(response){
                        
			}, "json"); 
	   });
</script>
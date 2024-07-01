

<style type="text/css">
  .purchase_plan_btn a {
    border: 1px solid #0069d1;
    text-align: center;
    padding: 6px 9px !important;
    border-radius: 5px;
    color: #FFF;
    background: #0070d1;
}
.purchase_plan_btn a:hover {
   
    color: #0070d1 !important;
    background: #FFF;
   
}
</style>
<div class="container-fluid">
    <div class="row">
<div class="col-md-12 admin-profile">
  
  <div class="top-header">
  <div id="btn02" class="header_toggle" onclick="toggleSidebar()"> <i class='bx bx-chevron-right' id="header-toggle"></i> </div>
 <nav class="navbar">
  <div class="container">
    @if(Auth::guard("customer")->user())
    <?php
      $user_id = Auth::guard("customer")->user()->id;
      $payment_data = DB::table("payments")->where("customer_id",$user_id)->first();
      //print_r($payment_data);
    ?>
    @if(empty($payment_data) || $payment_data->payment_status == "Cancelled" || $payment_data->plan_name == NULL)
    
    <div class="purchase_plan_btn">
       <a href="{{ url('/user/pricing') }}">Upgrade Plan</a>
     </div>
     
     @endif
     @endif
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
            @if(empty($payment_data) || $payment_data->payment_status == "Cancelled" || $payment_data->plan_name == NULL)
            <li><a class="dropdown-item" href="{{ url('/user/pricing') }}">Upgrade Plan</a></li>
            @endif
            <li><a class="dropdown-item" href="{{ url('/user/logout') }}">Logout</a></li>
           
          </ul>
        </li>
      </ul>
  </div>
</nav>

</div>
<?php
if($_SERVER['REQUEST_URI'] == "/dev/user/exam_builder"){
      ?>
      </div>
    </div>
      <?php
    }
   ?> 
</div>
  </div>
</div>
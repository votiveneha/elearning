<?php
  $email_data = Auth::guard("customer")->user();
  if($email_data){
    $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
    $invoices = $stripe->invoices->all();

    $user_email = Auth::guard("customer")->user()->email;
    $payent_data = DB::table("payments")->where("customer_email",$user_email)->get();
    $p_data = array();
    foreach ($payent_data as $pay_data) {
      $p_data[] = $pay_data->pay_id;
    }
    foreach ($invoices as $invoice) {
      if($user_email == $invoice->customer_email){
        $paymentIntents = $stripe->paymentIntents->retrieve($invoice->payment_intent, []);
        $amount_paid = number_format((float)$invoice->amount_paid/100, 2, '.', '');
        
        if(!in_array($paymentIntents->id, $p_data)){
          DB::table("payments")->insert([
            ['customer_id' => $invoice->customer, 'pay_id' => $paymentIntents->id, 'customer_email' => $invoice->customer_email,'amount' => $amount_paid,'invoice_id' => $invoice->id,'payment_status' => $paymentIntents->status,'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')]
          ]);
        }
        

      }
    }
  }
  // echo "<pre>";
  // print_r($invoices);
?>
<div class="container-fluid">
    <div class="row">
<div class="col-md-12 admin-profile">
  
  <div class="top-header">
  <div id="btn02" class="header_toggle" onclick="toggleSidebar()"> <i class='bx bx-chevron-right' id="header-toggle"></i> </div>
 <nav class="navbar">
  <div class="container">
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
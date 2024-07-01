<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\User;
use App\Models\Payments;
use Hash;
use DB;
use Auth;
use Mail;
use Illuminate\Support\Str;
use Stripe;
use Session;

class HomeController extends Controller
{
    public function index(){
        if(isset($_REQUEST['token'])){

            $user = DB::table("users")->where("email",$_REQUEST['email'])->first();
            

            if($user->email_verification_status != 1){
                $result = DB::table('users')
                    ->where('email', $_REQUEST['email'])
                    ->update(['email_verification_token' => base64_decode($_REQUEST['token']),'email_verification_status' => 1]);
                    
                    session::flash('success', 'Email has been verified successfully. Please login'); 
                }else{
                    return "Link Expired";
                }

            
        }
    	return view("Front.login");
    }

    public function home(){
        $data['courses_data'] = DB::table("courses")->where("status",1)->where("deleted_at",NULL)->orderBy('ordering_id', 'ASC')->get();
        return view("Front.home_new")->with($data);
    }

    public function error_page(){
        $data['courses_data'] = DB::table("courses")->where("status",1)->where("deleted_at",NULL)->orderBy('ordering_id', 'ASC')->get();
        return view("Front.error_page")->with($data);
    }

    public function courses(){
        $data['courses_data'] = DB::table("courses")->where("status",1)->where("deleted_at",NULL)->orderBy('ordering_id', 'ASC')->get();
        return view("Front.courses")->with($data);
    }

    public function mathify_works(){
        $data['courses_data'] = DB::table("courses")->where("status",1)->where("deleted_at",NULL)->orderBy('ordering_id', 'ASC')->get();
        return view("Front.mathify_works")->with($data);
    }

    public function topic_exams(){
        $data['courses_data'] = DB::table("courses")->where("status",1)->where("deleted_at",NULL)->orderBy('ordering_id', 'ASC')->get();
        return view("Front.topicexams")->with($data);
    }

    public function privacy(){
        $data['courses_data'] = DB::table("courses")->where("status",1)->where("deleted_at",NULL)->orderBy('ordering_id', 'ASC')->get();
        return view("Front.privacy")->with($data);
    }

    public function terms(){
        $data['courses_data'] = DB::table("courses")->where("status",1)->where("deleted_at",NULL)->orderBy('ordering_id', 'ASC')->get();
        return view("Front.terms")->with($data);
    }

    public function about_us(){
        $data['courses_data'] = DB::table("courses")->where("status",1)->where("deleted_at",NULL)->orderBy('ordering_id', 'ASC')->get();
        return view("Front.about_us")->with($data);
    }

    public function theory_booklets(){
        $data['courses_data'] = DB::table("courses")->where("status",1)->where("deleted_at",NULL)->orderBy('ordering_id', 'ASC')->get();
        return view("Front.theory_booklets")->with($data);
    }

    public function pricing_page(){
        $data['courses_data'] = DB::table("courses")->where("status",1)->where("deleted_at",NULL)->orderBy('ordering_id', 'ASC')->get();
        $user = Auth::guard("customer")->user();
        if($user){
            return view("Front.mathify-premium-user")->with($data);
        }else{
            return view("Front.mathify-premium")->with($data);
        }
        
    }

    public function register(){
        
    	return view("Front.register");
    }

    public function register1(){
    	return view("Front.register1");
    }

    public function submit_registration(Request $request){
       
    	$name = $request->name;
        $email = $request->email;
        $password = $request->password;
        $c_password = $request->c_password;
        $subscription = $request->subscription;

        $checkUserEmail = DB::table("users")->where("email",$email)->first();
        //print_r($checkUserEmail);die;
        if(empty($checkUserEmail)){
            
           
      
            $user = new User();

            $user->name = $name;
            $user->email = $email;
            $user->password = Hash::make($password);
            $user->role = "student";
            $user->subscription_plan = $subscription;
            $user->status = "1";
           $user_save = $user->save();
            //$user_save = 8;
           //echo $email;die;
            if($user_save){

                
             

                $user_data = array(
                  'email'  => $request->get('email'),
                  'password' => $request->get('password')
                );
                $token = mt_rand(100000,999999);
                //return view("Front.registration_email",['name' => $name,'email'=>$email,'token'=>$token]);
 try {
   Mail::send('Front.registration_email', ['name' => $name,'email'=>$email,'token'=>$token], function($message) use($request){
                $message->to($request->email);
                $message->from('help@mathifyhsc.com.au','Mathify');
                $message->subject('Register User');
            });
   
    
                
                    
                    return redirect()->route('email_confirmation');
                    
                
} catch (\Exception $e) {
    if(Auth::guard("customer")->attempt($user_data))
                {
                    
                    return redirect()->back()->with('error', 'Email error');
                    
                }
}
            
             

//return redirect()->back()->with('success', 'Email has been sent for verication. Please check now.');
            
             


                
               
                
                //return redirect()->back()->with('success', 'Registered Successfully.');
            }else{
                return redirect()->back()->with('error', 'Server error');
            }
        }else{
            
            if($checkUserEmail->email_verification_token){
                return redirect()->back()->with('error', 'Email already exist');
            }else{
                $user_update = DB::table('users')

                ->where('id', $checkUserEmail->id)

                ->update(['name' =>  $name,'password' =>  Hash::make($password)

                            ]);
                $token = mt_rand(100000,999999);
                //return view("Front.registration_email",['name' => $name,'email'=>$email,'token'=>$token]);
                try {
   Mail::send('Front.registration_email', ['name' => $name,'email'=>$email,'token'=>$token], function($message) use($request){
                $message->to($request->email);
                $message->from('help@mathifyhsc.com.au','Mathify');
                $message->subject('Register User');
            });
   
    
               
                    
                    return redirect()->route('email_confirmation');
                    
                
} catch (\Exception $e) {
    return redirect()->back()->with('error', 'Email error');
}
            
             

return redirect()->back()->with('success', 'Email has been sent for verification. Please check now.');
            }
        }
    }

    public function email_confirmation(Request $request){
        return view("Front.email_confirmation");
    }

    public function submit_registration1(Request $request){
    	$info = array(
            'name' => "Alex"
        );
        Mail::send("Front.registration_email", $info, function ($message)
        {
            $message->to('votive.lalu12@hotmail.com', 'W3SCHOOLS')
                ->subject('Basic test eMail from W3schools.');
            $message->from('elearning@mathifyhsc.com', 'Alex');
        });
        echo "Successfully sent the email";
    	

    }

    public function submit_login(Request $request){
        $user_data = array(
          'email'  => $request->get('email'),
          'password' => $request->get('password')
        );
        $user = User::where('email', '=', $request->email)->where("role","student")->first();
        //print_r($user);die;
        //echo Auth::guard("customer")->attempt($user_data);die;
        if(Auth::guard("customer")->attempt($user_data) and $user->status == 1 and $user->deleted_at == NULL and !empty($user_data))
        {
            if($user->email_verification_status != NULL){
                return redirect()->route('user_dashboard');
            }else{
                $date1 = date("Y-m-d");
                $date = $user->created_at;
                $date2 = date("Y-m-d", strtotime($date));
                if($date2<$date1){
                    return redirect()->route('user_dashboard');
                }else{
                    return redirect()->back()->with('error', 'Email or Password is incorrect');
                }
            }
            
            
            
            
        }
        else
        {
            return redirect()->back()->with('error', 'Email or Password is incorrect');
        }
    }

    public function user_dashboard(Request $request){
        $data['course_data'] = DB::table("courses")->orderBy('ordering_id', 'ASC')->get();
        return view("Front.user_dashboard")->with($data);
    }

    public function change_password(){
        return view("Front.change_password");
        
    }

    public function postuser_ChangePassword(Request $request)
    {
        $auth = Auth::user();
        if (!Hash::check($request->get('old_password'), $auth->password)) 
        {
            session::flash('password_error', 'Current password is invalid');
            return redirect()->route('user_ChangePassword');
        }else{
            $user_id = Auth::User()->id;
            $user = User::find($user_id);
            $user->password = Hash::make($request->new_password);
            $user->save();
            session::flash('password_success', 'Password updated successfully');
            return redirect()->route('user_ChangePassword');
        }
    }

    public function user_logout(){
        Auth::guard("customer")->logout();
        return redirect()->route('login');
    }
}

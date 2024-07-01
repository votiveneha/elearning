<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Admin;
use App\Models\Courses;
use App\Models\Payments;
use App\Models\Paymentlink;
use Illuminate\Support\Str;
Use DB;

use Hash;

use Session;

use Redirect;

use Stripe;




class AdminController extends Controller

{

    public function __construct(){

    	$this->middleware('admin'); // Class admin does not exist

    }



    public function index(){ 

    	$student_list = DB::table('students')

        ->select('*')

        ->orderBy('id', 'asc')

        ->get();

        $course_list = DB::table('courses')

        ->select('*')

        ->whereNull('courses.deleted_at') 

        ->orderBy('course_id', 'desc')

        ->get();

         $topic_list = DB::table('topics')

        ->select('*')

        ->whereNull('topics.deleted_at') 

        ->orderBy('topic_id', 'desc')

        ->get();

        $student_count = count($student_list);

        $course_count = count($course_list);

        $topic_count  = count($topic_list);

        $data_onview = array('student_count'=>$student_count,'course_count'=>$course_count,'topic_count'=>$topic_count);
        
        

        return view('admin.dashboard')->with($data_onview);

    }

    public function show_payment(){
        $data['payments'] = DB::table("payments")->orderBy('payment_id', 'DESC')->get();
        //print_r($data['payments']);die;
        
        return view('admin.payment.show_payment')->with($data);
    } 

    public function email_management(){
        $data['email_management'] = DB::table("email_management")->where('email_management_id', '1')->first();
        //print_r($data['payments']);die;
        
        return view('admin.edit_email_management')->with($data);
    } 

    public function email_management_action(Request $request){
        $update_email_management = DB::table('email_management')

            ->where('email_management_id', "1")

            ->update(['email_confirmation_page' =>  $request->email_confirmation_page,'email_confirmation_mail' =>  $request->email_confirmation_mail

						]);
        //print_r($data['payments']);die;
        
        Session::flash('success', 'Content Updated Successfully'); 
        return redirect()->to('/admin/edit_email_management');
    } 



	public function showPasswordForm(){


    	return view('admin.changepassword');

	}



	public function updatepassword(Request $request)

	{
		

		$admin_id = Auth::guard('admin')->user()->id;

		$credentials = [

                'password' => $request->old_password,

                'id' =>  $admin_id

        ];
        if(Auth::guard('admin')->attempt($credentials))

		{

			$this->validate($request,["password" => "required_with:cpassword|same:cpassword"]);

			$update_password = DB::table('users')

            ->where('id', $admin_id)

            ->update(['password' =>  Hash::make($request->password)

						]);
            
            Session::flash('success_message', 'Password Update Sucessfully.'); 



			//$request->session()->keep('message','Old Password Not Match Sucessfully!');

			return redirect()->to('/admin/change_password');

		}

		else

		{	
                
			Session::flash('error_message', 'Old Password Not Match.'); 

			//return Redirect::away('/admin/change_password');

			//return redirect("/admin/change_password");

			//session()->keep('message','Old Password Not Match!');

            return redirect()->to("/admin/change_password");  

		}

	}

	

	function showactivelog()

	{

		$log_data = DB::table('login_history')

					->Join('users', 'login_history.log_userid', '=', 'users.id')					

					->orderBy('login_history.log_id','desc')

					->get();

					

		$data_onview = array('log_data' =>$log_data

					  		 ); 	

    	return view('admin.active_loglist')->with($data_onview);					

	}

	

	public function showactivelog_delete($id)

	{

		DB::table('login_history')->where('log_id', '=', $id)->delete();

		Session::flash('message', 'User Log Information Deleted Sucessfully!');

		return Redirect('/admin/active_log');

	}



	function showmenulog()

	{

		$log_data = DB::table('view_menu_history')

					->select('view_menu_history.*', 'users.name','users.lname','restaurant.rest_name')

					->leftJoin('users', 'view_menu_history.user_id', '=', 'users.id')

					->Join('restaurant', 'view_menu_history.rest_id', '=', 'restaurant.rest_id')

					->get();

					

		$data_onview = array('log_data' =>$log_data	); 	

    	return view('admin.menu_loglist')->with($data_onview);					

	}

	

	public function showmenulog_delete($id)

	{

		DB::table('view_menu_history')->where('id', '=', $id)->delete();

		Session::flash('message', 'User Viewmenu Log Information Deleted Sucessfully!');

		return Redirect('/admin/viewmenu_log');

	}



	public function showsetting()

	{

		//show_data

		$admin_detail = DB::table('admins')

					->select('*')

					->get();

					

		$data_onview = array('admin_detail' =>$admin_detail	); 	

    	return view('admin.general_setting_form')->with($data_onview);

	}



	public function update_admin_setting()

	{

		$admin_id = Auth::guard('admin')->user()->id;

			DB::table('admins')

            ->where('id', $admin_id)

            ->update(['show_data' => (Request::get('show_data'))]);

			Session::flash('message', 'Setting Update Sucessfully!'); 

			return redirect()->to('/admin/general_setting');	

	}

	

}
<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;

use Illuminate\Http\Request;
use App\Models\Students;
use Session;
use Hash;
use DB;

class StudentController extends Controller
{

    public function __construct(){

        $this->middleware('admin'); // Class admin does not exist

    }
    public function student_list(){
        DB::connection()->enableQueryLog();

        $student_list = DB::table('users')

        ->select('*')
        
        ->whereNull('users.deleted_at') 

        ->orderBy('id', 'desc')

        ->get();

        $data_onview = array('student_list' =>$student_list);
        return View('admin.students.student_list')->with($data_onview);

    }

    public function student_form(Request $request){

        if($request->id){

        $id = base64_decode($request->id);
        $student_detail  = DB::table('users')->where('id', '=' ,$id)->get();
        $course_list  = DB::table('courses')->where('subscription_type', "Paid")->where('status', "1")->get();
        $student_list  = DB::table('users')->where('id', '!=' ,$id)->get();
        $data_onview = array('student_detail' =>$student_detail,'id'=>$id,'student_list'=>$student_list,'course_list'=>$course_list);
        return View('admin.students.student_form')->with($data_onview);

        }else{
        $id = 0;
        $student_detail  = DB::table('users')->where('id', '=' ,$id)->get();

        $user_list  = DB::table('users')->where('id', '!=' ,$id)->get();
        $course_list  = DB::table('courses')->where('subscription_type', "Paid")->where('status', "1")->get();
        $data_onview = array('id'=>$id,'user_list'=>$user_list,'student_detail'=>$student_detail,'course_list'=>$course_list);
        return View('admin.students.student_form')->with($data_onview);
        
        }
    }

    public function student_action(Request $request)
    {

        $request->all();
        $id = $request->id;

        if($id==0){

            //$this->validate($request,["email" => "required|email|unique:students","password" => "required_with:confirm_pasword|same:confirm_pasword"]);
            $studentemail  = DB::table('users')->where('email', '=' , $request->email)->first();
            //print_r($studentemail);die;
            if(!empty($studentemail)){
                return redirect()->back()->withErrors(["email" => "The email has already been taken."])->withInput();
            }

            $file = $request->file('profile_img');
            //echo $file->getClientOriginalName();
            $destinationPath = '/uploads';
            $imageName = time().'.'.$request->profile_img->extension(); 
            $file->move(public_path('/uploads'),$imageName);
            

            $student = new Students;
            $student->name = trim($request->name);
            $student->course_id = trim($request->course_id);
            $student->email = trim($request->email);
            $student->password = Hash::make($request->password);
            $student->profile_img = $imageName;
            $student->save();
            //$student_id = $student->id;
            Session::flash('message', 'Student Inserted Sucessfully!');
            return redirect()->to('/admin/studentlist');

        }else
        {   
            // $studentemail  = DB::table('users')->where('email', '=' , $request->email)->where('id','!=',$id)->first();
            //  if(!empty($studentemail)){
            //     return redirect()->back()->withErrors(["email" => "The email has already been taken."])->withInput();
            // }
             DB::table('users')
                ->where('id', $id)
                ->update(['first_name' => trim($request->fname),
                    'course_id' => $request->course_id,
                    'last_name'=>  trim($request->lname)


                ]);
            Session::flash('message', 'Student Information Updated Sucessfully!');
            return redirect()->to('/admin/studentlist');
        }

    }


    public function student_delete($id){

        $id = base64_decode($id);
        $students = Students::find($id);
        $students->delete();
        $student = Students::find($id);
        if (!$student) {
            Session::flash('message', 'Student Information Deleted Successfully!');
        } else {
            Session::flash('error', 'Student not found or could not be deleted!');
        }
        return Redirect('/admin/studentlist');
    }

        public function subtopic_delete($id){

        $id = base64_decode($id);
        $topics = Subtopics::find($id);
        $topics->delete();
        Session::flash('message', 'Sub-topic Deleted Sucessfully!');
        return Redirect('/admin/subtopiclist');
    }


    public function student_view(Request $request,$id){

        $id  = base64_decode($id);

        if($id){

        $student_detail  = DB::table('users')->where('id', '=' ,$id)->get();
        $student_list  = DB::table('users')->where('id', '!=' ,$id)->get();
        $data_onview = array('student_detail' =>$student_detail,'id'=>$id,'student_list'=>$student_list);
        return View('admin.students.student_view')->with($data_onview);

        }
    }

    public function remove_courses(Request $request){
        $customer_id = $request->customer_id;


        $update_courses_status = DB::table('users')
                    ->where('id', $request->customer_id)
                    ->update(['course_id' => NULL]);
        $update_payment_status = DB::table('payments')
                    ->where('customer_id', $request->customer_id)
                    ->update(['payment_status' => "Cancelled"]);            

        return $update_courses_status;             
    }

    public function student_status(Request $request){
        $result = DB::table('users')
                ->where('id', $request->id)
                ->update(
                    ['status' => $request->status]
                );
                if ($result) {
                return response()->json(['success' => true, 'message' => 'Status updated successfully']);} else {
            return response()->json(['success' => false, 'message' => 'Failed to update status']);
        }    }



}



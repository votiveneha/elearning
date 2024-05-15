<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Courses;
use App\Models\Topics;

use Session;
use DB;

class CoursesController extends Controller
{

    public function __construct(){

        $this->middleware('admin'); // Class admin does not exist

    }

   
    public function course_list(){
        DB::connection()->enableQueryLog();
        $course_list = courses::orderBy('ordering_id', 'ASC')
                     ->whereNull('deleted_at')
                     ->get();

        $data_onview = array('course_list' =>$course_list);

     

        return View('admin.course.course_list')->with($data_onview);

    }

    public function course_form(Request $request){


        $id = base64_decode($request->id);
       

        if($id){

        $id = base64_decode($request->id);
        $course_detail  = DB::table('courses')->where('course_id', '=' ,$id)->get();
        $course_list  = DB::table('courses')->where('course_id', '!=' ,$id)->get();
        $data_onview = array('course_detail' =>$course_detail,'id'=>$id,'course_list'=>$course_list);
       
        return View('admin.course.course_edit')->with($data_onview);

        }else{

        $id =0;
        $course_list  = DB::table('courses')->where('course_id', '!=' ,$id)->get();
        $data_onview = array('id'=>$id,'course_id'=>$course_list);
         
        return View('admin.course.course_form')->with($data_onview);

        }
    }

    public function course_action(Request $request)
    {

        $request->all();
        

        $id = $request->id;
        // Validate the incoming request...
        $title = $request->input('title');
        // Generate slug from the title
        $slug = Str::slug($title);
        if($id==0){

            if ($request->hasFile('course_img')) {
                $image = $request->file('course_img');
                $imageName = "stu".time().'.'.$image->getClientOriginalExtension();
                $image->move(public_path('/uploads/courses'), $imageName);
            }
            $validatedData = $request->validate([
                'title' => 'required|unique:courses,title,NULL,id,deleted_at,NULL|max:255'
            ]);

                           

            $courses = new Courses;
            $courses->title = trim($request->title);
            $courses->course_img = $imageName;
            $courses->slug = $slug;
            $courses->status = "1";
            $courses->subscription_type = $request->subscription_type;
            $courses->description = trim($request->description);
            $courses->save();
            $course_id = $courses->course_id;
            Session::flash('message', 'Course Inserted Sucessfully!');
            return redirect()->to('/admin/courselist');

        }else
        {
            if ($request->hasFile('course_img')) {
            $image = $request->file('course_img');
            $imageName = "stu".time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('/uploads/courses'), $imageName);
        }
        else{
            $course_detail  = DB::table('courses')->where('course_id', '=' ,$id)->first();
            $imageName = $course_detail->course_img;
        }
         $count_course = DB::table('courses')
                    ->where('title', $request->title)
                    ->where('course_id', '!=', $request->id)
                    ->count();
            if($count_course > 0){
                 $validatedData = $request->validate([
                 'title' => 'required|unique:courses|max:255'
             ]);
            }
         DB::table('courses')
                ->where('course_id', $id)
                ->update(['title' => trim($request->title),
                    'slug'=>  $slug,
                    'course_img'=> $imageName,
                    'description'=>trim($request->description),
                    'subscription_type'=>$request->subscription_type
                ]);
            Session::flash('message', 'Course Updated Sucessfully!');
            return redirect()->to('/admin/courselist');
        }


    }

    public function course_view(Request $request,$id){

        $id = base64_decode($id);
        if($id){
        $course_id = $request->id;
        $course_detail  = DB::table('courses')->where('course_id', '=' ,$course_id)->get();
        $course_list  = DB::table('courses')->where('course_id', '!=' ,$course_id)->get();
        $data_onview = array('course_detail' =>$course_detail,'course_id'=>$course_id,'course_list'=>$course_list);
        return View('admin.course.course_view')->with($data_onview);

        }
    }

    public function course_status(Request $request){
       $result =  DB::table('courses')
                ->where('course_id', $request->course_id)
                ->update(
                    ['status' => $request->status]
                );
          if ($result) {
                        return response()->json(['success' => true, 'message' => 'Status updated successfully']);} else {
            return response()->json(['success' => false, 'message' => 'Failed to update status']);
        }
    }

    public function course_delete($id){

        $id = base64_decode($id);

        $courses = Courses::find($id);
        $courses->delete();
        $course = Courses::find($id);
        if (!$course) {
            Session::flash('message', 'Course Deleted Successfully!');
        } else {
            Session::flash('error', 'Course not found or could not be deleted!');
        }
        return Redirect('/admin/courselist');
    }


    public function fetch_topics(Request $request)
    {
        $data['topics'] = Topics::where("course_id", $request->country_id)
                                ->get(["topic_id","title"]);
        return response()->json($data);
    }

    public function update_order(Request $request)
    {    
        $courses = Courses::all();
    

        foreach ($courses as $course) {

            foreach ($request->order as $order) {

                if ($order['course_id'] == $course->course_id) {

                    $course->update(['ordering_id' => $order['ordering_id']]);
                }
            }
        }

        return response(['message' => 'Update Successfully'], 200);
    }

}

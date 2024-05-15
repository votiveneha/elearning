<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Topics;
use App\Models\Subtopics;
use Session;
use DB;

class TopicController extends Controller
{

    public function __construct(){

        $this->middleware('admin'); // Class admin does not exist

    }

   
    public function topic_list(){
        DB::connection()->enableQueryLog();
        // $topic_list = DB::table('topics')
        // ->select('*')
        // ->orderBy('topic_id', 'desc')
        // ->get();
        $topic_list = DB::table('topics')
        ->select('topics.*', 'courses.title as course_title')
        ->leftJoin('courses', 'topics.course_id', '=', 'courses.course_id')
        ->whereNull('topics.deleted_at') 
        ->orderBy('topics.ordering_id', 'asc')
        ->get();

        $data_onview = array('topic_list' =>$topic_list );
        return View('admin.topics.topic_list')->with($data_onview);

    }

    public function topic_form(Request $request){

        $id = base64_decode($request->id);
        $course_list  = DB::table('courses')->whereNull('courses.deleted_at')->get();


        if($id){

        $topic_detail  = DB::table('topics')->where('topic_id', '=' ,$id)->get();
        $topic_list  = DB::table('topics')->where('topic_id', '!=' ,$id)->get();
        $data_onview = array('topic_detail' =>$topic_detail,'id'=>$id,'course_list'=>$course_list,'topic_list'=>$topic_list);
        return View('admin.topics.topic_form')->with($data_onview);

        }else{


        $topic_list  = DB::table('topics')->where('topic_id', '!=' ,$id)->get();
        $data_onview = array('id'=>$id,'topic_list'=>$topic_list,'course_list'=>$course_list);
         
        return View('admin.topics.topic_form')->with($data_onview);

        }
    }

    public function topic_action(Request $request)
    {

        $request->all();

        
        $id = $request->id;
        // Validate the incoming request...
        $title = $request->input('title');
        // Generate slug from the title
        $slug = Str::slug($title);
        if($id==0){
            $request->all();
            $validatedData = $request->validate([
                'title' => 'required|unique:topics,title,NULL,id,deleted_at,NULL|max:255'
        ]);



            $topics = new Topics;
            $topics->title = trim($request->title);
            $topics->course_id = trim($request->course_id);
            $topics->slug = $slug;
            $topics->status = "1";
            $topics->save();
            $topic_id = $topics->topic_id;
            Session::flash('message', 'Topic Inserted Sucessfully!');
            return redirect()->to('/admin/topiclist');

        }else
        {
            $count_topic = DB::table('topics')
                    ->where('title', $request->title)
                    ->where('topic_id', '!=', $request->id)
                    ->count();
            if($count_topic > 0){
                 $validatedData = $request->validate([
                 'title' => 'required|unique:topics|max:255'
             ]);
            }
            DB::table('topics')
                ->where('topic_id', $id)
                ->update(['title' => trim($request->title),
                    'slug'=>  $slug,
                    'course_id'=> trim($request->course_id),
                ]);
            Session::flash('message', 'Topic Updated Sucessfully!');
            return redirect()->to('/admin/topiclist');
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
        DB::table('courses')
                ->where('course_id', $request->course_id)
                ->update(
                    ['status' => $request->status]
                );
        return response()->json(['success' => true]);
    }

    public function topic_delete($id){

        $id = base64_decode($id);

        $topics = Topics::find($id);
        $topics->delete();
        $topic = Topics::find($id);
        if (!$topic) {
            Session::flash('message', 'Topic Deleted Successfully!');
        } else {
            Session::flash('error', 'Topic not found or could not be deleted!');
        }
        return Redirect('/admin/topiclist');
    }

    public function topic_status(Request $request){

        $result = DB::table('topics')
                ->where('topic_id', $request->topic_id)
                ->update(
                    ['status' => $request->status]
                      );
          if ($result) {
                        return response()->json(['success' => true, 'message' => 'Status updated successfully']);} else {
            return response()->json(['success' => false, 'message' => 'Failed to update status']);
        }
    }

    // Sub Topic Management 

    public function subtopic_list(Request $request){

        $topic_list = DB::table('subtopics')
        ->select('subtopics.*', 'courses.title as course_title', 'topics.title as topic_title')
        ->leftJoin('courses', 'subtopics.course_id', '=', 'courses.course_id')
        ->leftJoin('topics','subtopics.topic_id', '=' , 'topics.topic_id')
        ->whereNull('subtopics.deleted_at') 
        
        ->orderBy('subtopics.ordering_id', 'ASC')
        ->get();

        $data_onview = array('topic_list' =>$topic_list );
        return View('admin.sub-topics.subtopic_list')->with($data_onview);

    }

    public function subtopic_list1(Request $request){

        $topic_list = DB::table('subtopics')
        ->select('subtopics.*', 'courses.title as course_title', 'topics.title as topic_title')
        ->leftJoin('courses', 'subtopics.course_id', '=', 'courses.course_id')
        ->leftJoin('topics','subtopics.topic_id', '=' , 'topics.topic_id')
        ->whereNull('subtopics.deleted_at') 
        ->where('subtopics.topic_id',base64_decode($request->topic_id)) 
        ->orderBy('subtopics.ordering_id', 'ASC')
        ->get();

        $data_onview = array('topic_list' =>$topic_list,'topic_id'=> $request->topic_id,'course_id'=> $request->course_id);
        return View('admin.sub-topics.subtopic_list')->with($data_onview);

    }

     public function subtopic_form(Request $request){


        $id = base64_decode($request->id);
        $course_list  = DB::table('courses')->whereNull('courses.deleted_at')->get();
        $topic_list  = DB::table('topics')->whereNull('topics.deleted_at')->get();

        if($id){

        $subtopic_detail  = DB::table('subtopics')->where('st_id', '=' ,$id)->get();
        $subtopic_list  = DB::table('subtopics')->where('st_id', '!=' ,$id)->get();
        $data_onview = array('subtopic_detail' =>$subtopic_detail,'id'=>$id,'course_list'=>$course_list,'subtopic_list'=>$subtopic_list,'topic_list'=>$topic_list);
        return View('admin.sub-topics.subtopic_form')->with($data_onview);

        }else{

        $id =0;
        $subtopic_list  = DB::table('subtopics')->where('topic_id', '!=' ,$id)->get();
        $data_onview = array('id'=>$id,'subtopic_list'=>$subtopic_list,'course_list'=>$course_list,'topic_list'=>$topic_list);
         
        return View('admin.sub-topics.subtopic_form')->with($data_onview);

        }
    }

    public function subtopic_form1(Request $request){


        $id = base64_decode($request->id);
        $topic_id = base64_decode($request->topic_id);
        $course_id = base64_decode($request->course_id);
        $course_list  = DB::table('courses')->whereNull('courses.deleted_at')->get();
        $topic_list  = DB::table('topics')->whereNull('topics.deleted_at')->get();

        if($id){
           
        $subtopic_detail  = DB::table('subtopics')->where('st_id', '=' ,$id)->get();
        $course_title = DB::table("courses")->where("course_id",$subtopic_detail[0]->course_id)->first();
        $topic_title = DB::table("topics")->where("topic_id",$subtopic_detail[0]->topic_id)->first();
        $subtopic_list  = DB::table('subtopics')->where('st_id', '!=' ,$id)->get();
        $data_onview = array('subtopic_detail' =>$subtopic_detail,'id'=>$id,'course_list'=>$course_list,'subtopic_list'=>$subtopic_list,'topic_list'=>$topic_list,'topic_id'=>$topic_id,'course_title'=>$course_title,'topic_title'=>$topic_title);
        return View('admin.sub-topics.subtopic_form')->with($data_onview);

        }else{

        $id =0;
        $course_title = DB::table("courses")->where("course_id",$course_id)->first();
        $topic_title = DB::table("topics")->where("topic_id",$topic_id)->first();
        $subtopic_list  = DB::table('subtopics')->where('topic_id', '!=' ,$id)->get();
        $data_onview = array('id'=>$id,'subtopic_list'=>$subtopic_list,'course_list'=>$course_list,'topic_list'=>$topic_list,'topic_id'=>$topic_id,'course_title'=>$course_title,'topic_title'=>$topic_title);
         
        return View('admin.sub-topics.subtopic_form')->with($data_onview);

        }
    }


    public function subtopic_delete($id){

        $id = base64_decode($id);

        $sub_topic = DB::table("subtopics")->where("st_id",$id)->first(); 

        $subtopics = Subtopics::find($id);
        $subtopics->delete();
        $subtopic = Subtopics::find($id);
        if (!$subtopic) {
            Session::flash('message', 'Chapter Deleted Successfully!');
        } else {
            Session::flash('error', 'Chapter not found or could not be deleted!');
        }
        return Redirect('/admin/subtopiclist1/'.base64_encode($sub_topic->course_id)."/".base64_encode($sub_topic->topic_id));
    }

    public function subtopic_action(Request $request)
    {

        $id = $request->id;
        $topic_id = base64_encode($request->topic_id);
        $course_id = base64_encode($request->course_id);
       

      
        // Validate the incoming request...
        $title = $request->input('title');
        // Generate slug from the title
        $slug = Str::slug($title);
        if($id==0){
               $validatedData = $request->validate([
            'title' => 'required|unique:subtopics,title,NULL,id,deleted_at,NULL|max:255'
        ]);
            $type = $request->type;
            
            if($type == "Quiz"){
                $timer = $request->timer_type;
            }else{
                $timer = "";
            }
               
            $subtopics = new Subtopics;
            $subtopics->title = trim($request->title);
            $subtopics->course_id = trim($request->course_id);
            $subtopics->topic_id = trim($request->topic_id);
            $subtopics->slug = $slug;
            $subtopics->status = "1";
            $subtopics->type = $type;
            $subtopics->timer = $timer;
            $subtopics->quiz_time = $request->quiz_time;
            $subtopics->save();
            $st_id = $subtopics->st_id;
            Session::flash('message', 'Chapter Inserted Sucessfully!');
            return redirect()->to('/admin/subtopiclist1/'.$course_id."/".$topic_id);
            
            
            

        }else
        {
           $count_subtopic = DB::table('subtopics')
                    ->where('title', $request->title)
                    ->where('st_id', '!=', $request->id)
                    ->count();
            // if($count_subtopic > 0){
            //      $validatedData = $request->validate([
            //      'title' => 'required|unique:subtopics|max:255'
            //  ]);
            // }
            if($request->type == "Quiz"){
                $timer = $request->timer_type;
            }else{
                $timer = "";
            }
            DB::table('subtopics')
                ->where('st_id', $id)
                ->update(['title' => trim($request->title),
                    'slug'=>  $slug,
                    'type'=>  $request->type,
                    'timer'=>  $timer,
                    'timer'=>  $timer,
                    'quiz_time'=> $request->quiz_time,
                    'topic_id'=> trim($request->topic_id),

                ]);
            Session::flash('message', 'Chapter Updated Sucessfully!');
            return redirect()->to('/admin/subtopiclist1/'.base64_encode($request->course_id)."/".base64_encode($request->topic_id));
        }


    }

    public function subtopic_status(Request $request){

        $result = DB::table('subtopics')
                ->where('st_id', $request->st_id)
                ->update(
                    ['status' => $request->status]
                );
            
        if ($result) {
            return response()->json(['success' => true, 'message' => 'Status updated successfully']);
        } else {
            return response()->json(['success' => false, 'message' => 'Failed to update status']);
        }
    }

    
    public function update_chapterorder(Request $request)
    {    
        $subtopics = Subtopics::all();
    

        foreach ($subtopics as $subtopicVal) {

            foreach ($request->order as $order) {

                if ($order['st_id'] == $subtopicVal->st_id) {

                    $subtopicVal->update(['ordering_id' => $order['ordering_id']]);
                }
            }
        }

        return response(['message' => 'Update Successfully'], 200);
    }

    public function update_topicrorder(Request $request)
    {    
        $topics = Topics::all();
    

        foreach ($topics as $topicVal) {

            foreach ($request->order as $order) {

                if ($order['topic_id'] == $topicVal->topic_id) {

                    $topicVal->update(['ordering_id' => $order['ordering_id']]);
                }
            }
        }

        return response(['message' => 'Update Successfully'], 200);
    }


    

     
    


}

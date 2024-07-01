<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Storage;
use Illuminate\Routing\Controller as BaseController;
use App\Models\User;
use App\Models\SessionAnalysis;
use App\Models\NewSessionAnalysis;
use Response;
use App\Models\Courses;
use App\Models\Topics;
use App\Models\Subtopics;
use App\Models\Exambuilder;
use App\Models\Savetime;
use App\Models\Readtheory;
use App\Models\Payments;
use App\Models\Exambuilderquestions;
use Hash;
use Session;
use DB;
use Auth;
use Stripe;
use Mail;
use App\Models\QuestionBank;

class UserController extends Controller
{

    public function course_view(Request $request){
        $id = base64_decode($request->id);
        $groupedData = DB::table('courses')
                        ->join('topics', 'courses.course_id', '=', 'topics.course_id')
                        ->leftJoin('subtopics', 'topics.topic_id', '=', 'subtopics.topic_id')
                        ->select('topics.topic_id', 'topics.course_id', 'topics.title AS topic_title', 'courses.title AS course_title','topics.status as status','topics.deleted_at as deleted_at')
                        ->selectRaw('GROUP_CONCAT(subtopics.st_id ORDER BY subtopics.st_id ASC) AS chapter_id')
                        ->selectRaw('GROUP_CONCAT(topics.topic_id) AS topics_id_list')
                        ->selectRaw('GROUP_CONCAT(subtopics.st_id ORDER BY subtopics.st_id ASC) AS subtopics_list')
                        ->where('topics.course_id', $id)
                        
                        ->groupBy('topics.topic_id', 'topics.course_id', 'topics.title', 'courses.title')
                        ->orderBy('topics.ordering_id')
                        ->orderBy('subtopics.ordering_id', 'asc') // assuming subtopics.ordering_id exists
                        ->get();
                        // echo "<pre>";
                        // print_r($groupedData);die;
        $course_title = !empty($groupedData->toArray()) ? $groupedData[0]->course_title : "No Data Found";
        $course_id = $id;
        return view('Front.course_view', compact('groupedData','course_title','course_id'));
    }

    public function course_view1(Request $request){
        $id = base64_decode($request->id);
        $data['id'] = $id;
        $data['topics'] = DB::table("topics")->where("course_id",$id)->orderBy('ordering_id','asc')->get();
        
        $data['course_title'] = DB::table("courses")->where("course_id",$id)->first();
        $data['user_data'] = DB::table("theory_read")->where("user_id",Auth::guard("customer")->user()->id)->first();
        $data['course_data'] = DB::table("courses")->where("course_id",$id)->orderBy('ordering_id', 'ASC')->get();
        Session::put("course_id",$id);
        //print_r($data['course_title']);die;

        return view('Front.course_view1')->with($data);
    }

    public function cancel_subscription(Request $request){
        $customer_id = $request->customer_id;

        $get_subscription = DB::table("payments")->where("customer_id",$customer_id)->first();

        $update_payment_status = DB::table('payments')
                    ->where('customer_id', $request->customer_id)
                    ->update(['payment_status' => "Cancelled"]);



//         try {
//    Mail::send('Front.subscription_email', ['name' => 'neha','email'=>'votivephp.neha@gmail.com','plan_name'=>'monthly plan'], function($message) use($request){
//                 $message->to('votivephp.neha@gmail.com');
//                 $message->from('elearning_three@mathifyhsc.com.au','elearning');
//                 $message->subject('Cancel Subscription');
//             });
//    return $update_payment_status;
   
// } catch (\Exception $e) {
//     return $update_payment_status;
// }            

        

    }

    public function pricing_page(){
        return view('Front.purchase_product');
    }

    public function theory(Request $request){
        $id =base64_decode($request->id);
         $data['queries'] = DB::table('theory')
        ->where('st_id', '=', $id)
        ->where('status', '=', 1)
        ->where('deleted_at', '=', NULL)
        ->first();
        $data['theory_id'] = $id;
        //print_r($data['queries']);die;
       
        // $pdfUrl = Storage::url('uploads/{{$queries->theory_pdf}}');
        // // echo $pdfUrl;die;
        // $pdfContent = Storage::url('uploads/{{$queries->theory_pdf}}'); // Get the 
        // $headers = ['Content-Type' => 'application/pdf']; // Set the response headers
        // $pdfResponse = new Response($pdfContent, 200, $headers); // Create the PDF 
        return view("Front.theory")->with($data);
    }

    public function read_theory(Request $request){
        
        $user_data = DB::table("theory_read")->where("user_id",Auth::guard("customer")->user()->id)->where("st_id",$request->theory_id)->first();
        if(empty($user_data)){
            $read_th = new Readtheory();
            $read_th->user_id = Auth::guard("customer")->user()->id;
            $read_th->st_id = $request->theory_id;
            $read_th->course_id = Session::get("course_id");
            $read_th->save();
        }
        

    }

    public function start_quiz(Request $request){
        $course_id = base64_decode($request->course_id);
        $topic_id = base64_decode($request->topic_id);
        $st_id = base64_decode($request->st_id);
        $data['course_id'] = $request->course_id;
        $data['topic_id'] = $request->topic_id;
        $data['st_id'] = $request->st_id;
        $quiz = QuestionBank::where("course_id",$course_id)->where("topic_id",$topic_id)->where("chapter_id",$st_id)->where("status",1)->where("deleted_at",NULL)->groupBy('q_id')->get();
        //print_r($quiz);die;
        $i = 0;
        $marks = 0;
        //$total_time = 0;
        foreach($quiz as $q){
            if($q->quiz_exam == "Quiz" || $q->quiz_exam == "Both"){
                $i = $i+1;
                $marks = $marks+$q->marks;
                //$total_time = $total_time + $q->time_length;
            }
        }

        $get_timer = DB::table("subtopics")->where("st_id",$st_id)->first();
        $topic_name = DB::table("topics")->where("topic_id",$topic_id)->first();
        $data['topic_name'] = $topic_name->title;

        $total_time = $get_timer->quiz_time;

        $min = intval($total_time/60);
        $sec = $total_time%60;
        $sec1 = strlen($sec);
        if($sec1 < 2){
            $sec2 = "0".$sec;
        }else{
            $sec2 = $sec;
        }
        // $mins = number_format($min, 2, '.', '');
        // $mins1 = str_replace(".",":",$mins);
        Session::put("timer", $min.":".$sec2);
        $data['question_count'] = $i;
        $data['marks'] = $marks;
        $data['total_time'] = $min.":".$sec2;

        $data['course_title'] = DB::table("courses")->where("course_id",$course_id)->first();
        $data['subtopic_data'] = DB::table("subtopics")->where("st_id",$st_id)->first();

        $reference_id = "quiz-".rand(10000,99999);
        $data['reference_id'] = $reference_id;
        Session::put("reference_id",$reference_id);

    	return view("Front.start-quiz")->with($data);
    }

    public function start_quiz_exam(Request $request){
        
        $reference_id = base64_decode($request->reference_id);
        $data['reference_id'] = $request->reference_id;
        
        $exam_data = DB::table("exam_builder")->where("reference_id",$reference_id)->first();
        $get_exam_data = $exam_data->topics_id;

        $topic_ids = explode(",",$get_exam_data);
        
        if($exam_data->topics_id && $exam_data->question_type && $exam_data->difficulty_level && $exam_data->session_length){

        $exam_titles = explode(",",$exam_data->topics_id);
        $topic_titles = array();
        foreach ($exam_titles as $e_t) {
            $t_titles = DB::table("topics")->where("topic_id",$e_t)->first();
            $topic_titles[] = $t_titles->title;
        }
        $data['topic_titles'] = implode(",",$topic_titles);
        
        $qu_ids23 = array();
        $qu_ids = array();
        $qu_data = array();
        if($exam_data->question_type == "Attempted"){
            $qu_data = DB::table("question_analysis")->where("student_id",Auth::guard("customer")->user()->id)->where("quiz_type","exam_builder")->where("attempted_status","!=",NULL)->groupBy('question_id')->get();
            foreach ($qu_data as $q_d) {
                $qu_ids[] = $q_d->question_id;
            }

        }
        if($exam_data->question_type == "Not attempted"){
            
            $qu_data23 = DB::table("question_analysis")->where("student_id",Auth::guard("customer")->user()->id)->where("quiz_type","exam_builder")->where("attempted_status","!=",NULL)->whereIn("topic_id",$topic_ids)->groupBy('question_id')->get();
            foreach ($qu_data23 as $q_d) {
                $qu_ids23[] = $q_d->question_id;
            }
            
                $qu_data = DB::table("question_bank")->whereIn("topic_id",$topic_ids)->whereNotIn("q_id",$qu_ids23)->groupBy('q_id')->get();

                foreach ($qu_data as $q_d) {
                    if($q_d->quiz_exam == "Exam Builder" || $q_d->quiz_exam == "Both"){
                        $qu_ids[] = $q_d->q_id;
                    }
                }
                

        }
        
        
        $q_id_string = implode(",",$qu_ids);
        
        
        Session::put("reference_id", $reference_id);
        

        $question_array = array();
        
        $question_count = 0;
        $question_time = 0;
        foreach($topic_ids as $topic_id){

            

            if($exam_data->question_type == "Any Questions"){
                if($exam_data->difficulty_level == "Mix it up"){
                
                    $question_data = DB::table("question_bank")->where("course_id",$exam_data->course_id)->where("topic_id",$topic_id)->groupBy('q_id')->get();
                

                }else{
                    $question_data = DB::table("question_bank")->where("course_id",$exam_data->course_id)->where("topic_id",$topic_id)->where("difficulty_level",$exam_data->difficulty_level)->groupBy('q_id')->get();
                }
            }else{
                if($exam_data->difficulty_level == "Mix it up"){
                
                    $question_data = DB::table("question_bank")->where("course_id",$exam_data->course_id)->where("topic_id",$topic_id)->whereIn("q_id",$qu_ids)->groupBy('q_id')->get();
                

                }else{
                    $question_data = DB::table("question_bank")->where("course_id",$exam_data->course_id)->where("topic_id",$topic_id)->where("difficulty_level",$exam_data->difficulty_level)->whereIn("q_id",$qu_ids)->groupBy('q_id')->get();
                }
            }
            

            
            
            foreach ($question_data as $q_data) {
                if($q_data->quiz_exam == "Exam Builder" || $q_data->quiz_exam == "Both"){
                    $question_array[] = $q_data;
                }
                
            }
           
            
        }
        // echo "<pre>";
        // print_r($question_array);die;
        shuffle($question_array);
        $question_time = 0;
        $marks = 0;
        $qu_array = array();
        // echo "<pre>";
        // print_r($question_array);die;
        foreach ($question_array as $q_array) {
            //echo $q_array->time_length."<br>";
            $qu_array[] = $q_array; 
            $question_time = $question_time + $q_array->time_length;
            $marks = $marks + $q_array->marks;
            //echo $question_time."<br>";
            if($exam_data->session_length == "Short"){
                if($question_time >= 600 && $question_time <= 1200){
                    break;
                }
            }
            if($exam_data->session_length == "Medium"){
                if($question_time >= 1800 && $question_time <= 2700){
                    break;
                }
            }
            if($exam_data->session_length == "Long"){
                if($question_time >= 3600 && $question_time <= 5400){
                    break;
                }
            }
        }

        if($exam_data->session_length == "Short"){
            $total_time_min = $question_time/60;
            $total_time_sec1 = $question_time%60;
            $sec1 = strlen($total_time_sec1);
            if($sec1 < 2){
                $total_time_sec = "0".$total_time_sec1;
            }else{
                $total_time_sec = $total_time_sec1;
            }
         }
        if($exam_data->session_length == "Medium"){
            $total_time_min = $question_time/60;
            $total_time_sec1 = $question_time%60;
            $sec1 = strlen($total_time_sec1);
            if($sec1 < 2){
                $total_time_sec = "0".$total_time_sec1;
            }else{
                $total_time_sec = $total_time_sec1;
            }
        }
        if($exam_data->session_length == "Long"){
            $total_time_min = $question_time/60;
            $total_time_sec1 = $question_time%60;
            $sec1 = strlen($total_time_sec1);
            if($sec1 < 2){
                $total_time_sec = "0".$total_time_sec1;
            }else{
                $total_time_sec = $total_time_sec1;
            }
        }

        $total_time_m = (int)$total_time_min;
        $total_time_s = $total_time_sec;

        $data['total_time'] = $total_time_m.":".$total_time_s;
        Session::put("timer", $data['total_time']);
        Session::put("qu_array", $qu_array);

        $questions_id = array();
        foreach ($qu_array as $q_array) {
            $questions_id[] = $q_array->q_id;
        }
        $q_ids = implode(",",$questions_id);

        $exam_builder_update = DB::table('exam_builder')
                    ->where('reference_id', $reference_id)
                    ->update(['q_ids' => $q_ids,'total_questions' => count($qu_array)]);
        
        $data['marks'] = $marks;
        $data['question_count'] = count($qu_array);
        
        }else{
            $data['marks'] = "0";
            $data['total_time'] = "0:00";
            $data['question_count'] = "0";
            $data['topic_titles'] = "";
        }
        // echo "<pre>";
        // print_r($qu_array);die;
        
        
        // echo $question_count."<br>";
        // echo $question_time/60;
        // echo "<pre>";
        // print_r($question_array[0]);
        $data['course_title'] = DB::table("courses")->where("course_id",$exam_data->course_id)->first();
        
        return view("Front.start_quiz_exam")->with($data);

    }

    public function quiz(Request $request){
        $course_id = base64_decode($request->course_id);
        $topic_id = base64_decode($request->topic_id);
        $st_id = base64_decode($request->st_id);
        
        if($request->course_id && $request->topic_id && $request->st_id){
            
            if(isset($_GET['reference_id'])){
                $data['reference_id'] = base64_decode($_GET['reference_id']);
                Session::put("reference_id",$data['reference_id']);
            }else{
                $data['reference_id'] = Session::get("reference_id");
            }

            $get_timer = DB::table("quiz_timer")->where("reference_id",$data['reference_id'])->first();
            $topic_name = DB::table("topics")->where("topic_id",$topic_id)->first();
            $data['topic_name'] = $topic_name->title;
            if($get_timer){
                $data['get_timer'] = $get_timer->timer_value;
            }else{
                $data['get_timer'] = "";
            }
            
            
            $data['course_id'] = base64_decode($request->course_id);
            $data['topic_id'] = base64_decode($request->topic_id);
            $data['st_id'] = base64_decode($request->st_id);
            $data['timer'] = Session::get("timer");
            $data['quiz'] = QuestionBank::where("course_id",$course_id)->where("topic_id",$topic_id)->where("chapter_id",$st_id)->orderBy('ordering_id', 'ASC')->groupBy('q_id')->get();
            $data['subtopic_data'] = DB::table("subtopics")->where("st_id",$st_id)->first();
            $data['attempt_count'] = DB::table("question_analysis")->where("reference_id",$data['reference_id'])->groupBy('question_id')->get();
            $q_id_array = array();
            foreach($data['quiz'] as $q_array){
                $q_id_array[] = $q_array->q_id;
                
            }
            Session::put("q_id_array",$q_id_array);
            // echo "<pre>";
            // print_r($data['quiz']);die;
        	return view("Front.quiz")->with($data);
        }else{
            $ses_ref_id = Session::get("qu_array");

            if(!$ses_ref_id){
                $data['reference_id'] = base64_decode($request->reference_id);
                Session::put("reference_id",$data['reference_id']);
            }else{
                $data['reference_id'] = Session::get("reference_id");
            }

            $exam_data = DB::table("exam_builder")->where("reference_id",$data['reference_id'])->first();
            $topic_ids = explode(",",$exam_data->topics_id);
            $topic_titles1 = array();
            foreach ($topic_ids as $t_id) {
                $topic_title_data = DB::table("topics")->where("topic_id",$t_id)->first();
                $topic_titles1[] = $topic_title_data->title;
            }
            $data['topic_titles1'] = implode(",",$topic_titles1);

            $get_timer = DB::table("quiz_timer")->where("reference_id",$data['reference_id'])->first();
            //echo base64_decode($request->reference_id);die;
            if($get_timer){
                $data['get_timer'] = $get_timer->timer_value;
            }else{
                $data['get_timer'] = "";
            }
            $qu_array = Session::get("qu_array");
            if($qu_array){
                $qu_array = Session::get("qu_array");
                $q_id_array = array();
                foreach($qu_array as $q_array){
                    $q_id_array[] = $q_array->q_id;
                    
                }
                
            }else{
                
                $question_ids = $exam_data->q_ids;
                $q_ids = explode(",",$question_ids); 
                $qu_array = array();
                foreach ($q_ids as $q_id) {
                    $qu_array1 = QuestionBank::where("question_id",$q_id)->orderBy('ordering_id', 'ASC')->groupBy('q_id')->get();
                    $qu_array[] = $qu_array1;
                }
                
                $q_id_array = array();
                foreach($qu_array as $q_array){
                    $q_id_array[] = $q_array->q_id;
                    
                }

                
            }
            // echo "<pre>";
            //     print_r($qu_array);die;
            $data['reference_id'] = Session::get("reference_id");
            $data['quiz'] = $qu_array;
            $data['timer'] = Session::get("timer");
            $data['topic_name'] = "";
            //print_r($qu_array);
            
            Session::put("q_id_array",$q_id_array);
            
            return view("Front.quiz_exam")->with($data);
        }
    }

    public function submit_quiz(Request $request){

        //$reference_id = $request->reference_id;
        $reference_id = Session::get("reference_id");
        $q_id = $request->q_id;
        //echo $request->total_time;die;
        $questions_data = QuestionBank::where("q_id",$q_id)->orderBy('ordering_id', 'ASC')->get();
        //echo "<pre>";
        //print_r($questions_data);die;
        $session_data = NewSessionAnalysis::where("question_id",$q_id)->where("reference_id",$reference_id)->get();
        //echo count($session_data);die;
        // print_r($session_data);
        

        if(count($session_data) == 0){
            //echo "hello";
            foreach($questions_data as $q_data){
                $new_session_analysis = new NewSessionAnalysis();
                $new_session_analysis->student_id = Auth::guard("customer")->user()->id;
                $new_session_analysis->course_id = $q_data->course_id;
                $new_session_analysis->question_id = $q_data->q_id;
                $new_session_analysis->question_ordering_id = $request->question_no;
                $new_session_analysis->option_id = $q_data->option_id;
                $new_session_analysis->course_id = $q_data->course_id;
                $new_session_analysis->topic_id = $q_data->topic_id;
                $new_session_analysis->chapter_id = $q_data->chapter_id;
                $new_session_analysis->questions = $q_data->title;
                $new_session_analysis->options = $q_data->Options;
                $new_session_analysis->correct_answer = $q_data->correct_answer;
                $new_session_analysis->student_answer = $request->answer_val1;
                $new_session_analysis->attempted_status = $request->answer_val1;
                $new_session_analysis->reference_id = $reference_id;
                $new_session_analysis->time_spent_seconds = $request->ans_time;
                $new_session_analysis->quiz_type = $request->quiz_type;
                $new_session_analysis->save();
            }

            $session_analysis = new SessionAnalysis();
            $session_analysis->student_id = Auth::guard("customer")->user()->id;
            $session_analysis->course_id = $request->course_id;
            $session_analysis->topic_id = $request->topic_id;
            $session_analysis->subtopic_id = $request->subtopic_id;
            $session_analysis->total_questions = $request->total_questions;
            $session_analysis->attempted_questions = $request->attempted_questions;
            //$session_analysis->quiz_json = $request->quiz_json;
            $session_analysis->reference_id = $reference_id;
            $session_analysis->time_spent_seconds = $request->total_time;
            $session_analysis->quiz_type = $request->quiz_type;
            $session_analysis->save();
        }else{
            
            foreach($session_data as $s_data){
                $new_session_analysis = NewSessionAnalysis::find($s_data->analysis_id);
                
                
                $new_session_analysis->student_answer = $request->answer_val1;
                $new_session_analysis->attempted_status = $request->answer_val1;
                //$new_session_analysis->time_spent_seconds = $request->ans_time;
                $new_session_analysis->save();
                
            }
             
        }
    }

    public function submit_question_answer(Request $request){
        $reference_id = $request->reference_id;
        $q_id = $request->q_id;
        //echo $request->answer_val1;die;
        $questions_data = QuestionBank::where("q_id",$q_id)->orderBy('ordering_id', 'ASC')->get();
        $session_data = NewSessionAnalysis::where("question_id",$q_id)->where("reference_id",$reference_id)->get();
        // echo count($session_data);die;
        
        $reference_id = Session::get("reference_id");
        if(count($session_data) == 0){
            foreach($questions_data as $q_data){
                $new_session_analysis = new NewSessionAnalysis();
                $new_session_analysis->student_id = Auth::guard("customer")->user()->id;
                $new_session_analysis->course_id = $q_data->course_id;
                $new_session_analysis->question_id = $q_data->q_id;
                $new_session_analysis->question_ordering_id = $request->question_no;
                $new_session_analysis->option_id = $q_data->option_id;
                $new_session_analysis->course_id = $q_data->course_id;
                $new_session_analysis->topic_id = $q_data->topic_id;
                $new_session_analysis->chapter_id = $q_data->chapter_id;
                $new_session_analysis->questions = $q_data->title;
                $new_session_analysis->options = $q_data->Options;
                $new_session_analysis->correct_answer = $q_data->correct_answer;
                $new_session_analysis->student_answer = $request->answer_val1;
                $new_session_analysis->attempted_status = $request->answer_val1;
                $new_session_analysis->reference_id = $reference_id;
                $new_session_analysis->time_spent_seconds = $request->ans_time;
                $new_session_analysis->quiz_type = $request->quiz_type;
                $new_session_analysis->question_ordering_id = $request->question_ordering_id;
                $new_session_analysis->save();
            }

            // $session_analysis = new SessionAnalysis();
            // $session_analysis->student_id = Auth::guard("customer")->user()->id;
            // $session_analysis->course_id = $request->course_id;
            // $session_analysis->topic_id = $request->topic_id;
            // $session_analysis->subtopic_id = $request->subtopic_id;
            // $session_analysis->total_questions = $request->total_questions;
            // $session_analysis->attempted_questions = $request->attempted_questions;
            // //$session_analysis->quiz_json = $request->quiz_json;
            // $session_analysis->reference_id = $reference_id;
            // $session_analysis->time_spent_seconds = $request->total_time;
            // $session_analysis->save();
        }else{
            
            
            
            foreach($session_data as $s_data){
                
                $new_session_analysis = NewSessionAnalysis::find($s_data->analysis_id);
                

                $new_session_analysis->student_answer = $request->answer_val1;
                $new_session_analysis->attempted_status = $request->answer_val1;
                //$new_session_analysis->time_spent_seconds = $request->ans_time;

                $new_session_analysis->save();
                
            }
             
        }

        

    }



    public function session_analysis(Request $request){
        $course_id = base64_decode($request->course_id);
        $topic_id = base64_decode($request->topic_id);
        $st_id = base64_decode($request->st_id);
        
        $data['q_id_array'] = Session::get("q_id_array");

        if($course_id && $topic_id && $st_id){

                $data['st_id'] = $st_id;

                $timer_type = DB::table("subtopics")->where("st_id",$st_id)->first();
                $data['timer_type'] = $timer_type->timer;
                $data['timer'] = Session::get("timer");

                if(isset($_GET["reference_id"])){
                    $data['reference_id'] = base64_decode($_GET["reference_id"]);
                }else{
                    $data['reference_id'] = Session::get("reference_id");
                }
                
                $data['questions'] = QuestionBank::where("course_id",$course_id)->where("topic_id",$topic_id)->where("chapter_id",$st_id)->groupBy('q_id')->get();
                $data['session_analysis'] = NewSessionAnalysis::where("course_id",$course_id)->where("topic_id",$topic_id)->where("chapter_id",$st_id)->where("reference_id",$data['reference_id'])->where("student_id",Auth::guard("customer")->user()->id)->groupBy('question_id')->get();
                $session_array = array();
                foreach ($data['session_analysis'] as $ses_an) {
                    $session_array[] = $ses_an->question_id;
                }
                $data['session_array'] = $session_array;
                $data['session_analysis1'] = SessionAnalysis::where("course_id",$course_id)->where("topic_id",$topic_id)->where("subtopic_id",$st_id)->where("reference_id",$data['reference_id'])->where("student_id",Auth::guard("customer")->user()->id)->first();
            }else{
                
               
                $data['timer_type'] = "";
                $data['timer'] = Session::get("timer");
                 
                $questions_data = Session::get("qu_array");

                if($request->reference_id){
                    $data['reference_id'] = base64_decode($request->reference_id);
                }else{
                    $data['reference_id'] = Session::get("reference_id");
                }

                if($questions_data){
                    $data['questions'] = $questions_data;
                    $data['q_id_array'] = Session::get("q_id_array");
                }else{
                    $exam_data = DB::table("exam_builder")->where("reference_id",$data['reference_id'])->first();
                    $data['qu_ids'] = explode(",",$exam_data->q_ids);
                    $q_array = array();

                    foreach ($data['qu_ids'] as $q_id) {
                        $ques = QuestionBank::where("q_id",$q_id)->first();
                        $q_array[] = $ques;
                    }
                    $data['questions'] = $q_array;
                    $data['q_id_array'] = $data['qu_ids'];
                }
                
                //$data['session_array'] = array();
               

               

                $data['session_analysis'] = NewSessionAnalysis::where("reference_id",$data['reference_id'])->where("student_id",Auth::guard("customer")->user()->id)->orderBy('analysis_id', 'ASC')->groupBy('question_id')->get();

                $session_array = array();
                foreach ($data['session_analysis'] as $ses_an) {
                    $session_array[] = $ses_an->question_id;
                }

                $data['session_array'] = $session_array;
                $data['session_analysis1'] = SessionAnalysis::where("reference_id",$data['reference_id'])->where("student_id",Auth::guard("customer")->user()->id)->first();
            }
        
    	return view("Front.session_analysis")->with($data);
    }

    public function save_timer(Request $request){
        $reference_id = $request->reference_id;
        $timer_value = $request->timer_value;

        $get_timer = DB::table("quiz_timer")->where("reference_id",$reference_id)->first();

        if($get_timer){
            DB::table('quiz_timer')
                    ->where("reference_id",$reference_id)
                    ->update(['timer_value' => $timer_value]);
        }else{
            $save_time = new Savetime();
            $save_time->timer_value = $timer_value;
            $save_time->reference_id = $reference_id;
            $save_time->save();
        }

    }

    public function session_history(Request $request){
        $data['session_history'] = DB::table("question_analysis")->where("student_id",Auth::guard("customer")->user()->id)->groupBy('reference_id')->orderBy('created_at', 'DESC')->get();
        
        return view("Front.session_history")->with($data);
    }

    public function session_analysis_view(Request $request){
        $course_id = base64_decode($request->course_id);
        $topic_id = base64_decode($request->topic_id);
        $st_id = base64_decode($request->st_id);
        $data['st_id'] = $st_id;

        $last_reference_id = NewSessionAnalysis::where("course_id",$course_id)->where("topic_id",$topic_id)->where("chapter_id",$st_id)->where("student_id",Auth::guard("customer")->user()->id)->orderBy('analysis_id', 'ASC')->groupBy('question_id')->latest()->first();
        //echo $last_reference_id->reference_id;
        $data['reference_id'] = $last_reference_id->reference_id;
        $data['session_analysis'] = NewSessionAnalysis::where("course_id",$course_id)->where("topic_id",$topic_id)->where("chapter_id",$st_id)->where("reference_id",$last_reference_id->reference_id)->where("student_id",Auth::guard("customer")->user()->id)->orderBy('analysis_id', 'ASC')->groupBy('question_id')->get();
        $data['session_analysis1'] = SessionAnalysis::where("course_id",$course_id)->where("topic_id",$topic_id)->where("subtopic_id",$st_id)->where("reference_id",$last_reference_id->reference_id)->where("student_id",Auth::guard("customer")->user()->id)->first();

        
        return view("Front.session_analysis")->with($data);
    }

    public function exam_builder(){

        $data['course_data'] = DB::table("courses")->orderBy('ordering_id', 'ASC')->get();
        return view("Front.exam_builder")->with($data);
    }

    public function exam_builder_view(Request $request){
        $course_id = base64_decode($request->course_id);
        $data['topic_data'] = DB::table("topics")->where("course_id",$course_id)->orderBy('ordering_id', 'asc')->get();
        $data['course_id'] = $course_id;
        // echo "<pre>";
        // print_r($data['topic_data']);die;
        return view("Front.exam_builder_view")->with($data);
    }

    public function submit_exam_builder(Request $request){
        $course_id = $request->course_id;
        $topics = implode(",",json_decode($request->topics));
        $question_type = $request->question_type;
        $difficulty_level = $request->difficulty_level;
        $session_length = $request->session_length;
        $reference_id = "exam-".rand(10000,99999);

        $exambuilder = new Exambuilder();
        $exambuilder->student_id = Auth::guard("customer")->user()->id;
        $exambuilder->course_id = $course_id;
        $exambuilder->topics_id = $topics;
        $exambuilder->question_type = $question_type;
        $exambuilder->difficulty_level = $difficulty_level;
        $exambuilder->session_length = $session_length;
        $exambuilder->reference_id = $reference_id;
        $exambuilder->quiz_type = "exam";
        $exambuilder->save();
        
        return base64_encode($reference_id);
        
    }

    public function user_status(){
        $data['course_data'] = DB::table("courses")->orderBy('ordering_id', 'ASC')->get();
        $stripe = new \Stripe\StripeClient("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");
        $data['stripe'] = $stripe;
        //$payment_intents = $stripe->paymentIntents->all();
        $user_email = Auth::guard('customer')->user()->email;

        $student_id = Auth::guard('customer')->user()->id;

        $total_time_spent = DB::select("select sum(time_spent_seconds) as time_spent_seconds from (select * from question_analysis where student_id = ".$student_id." group by question_id) as q_analysis");
        $total_time = $total_time_spent[0]->time_spent_seconds;

        $time_spent_hour = $total_time/3600;
        $time_spent_min =$total_time%3600;

        if($time_spent_min<3600){
            $time_spent_min1 = $time_spent_min/60;
        }else{
            $time_spent_min1 = $time_spent_min;
        }

        $data['time_spent_hour'] = (int)$time_spent_hour." hrs:".(int)$time_spent_min1." min";
        
        
        
        
        return view("Front.user_status")->with($data);
    }

    public function settings(){
        $data['user_data'] = Auth::guard('customer')->user();
        return view("Front.settings")->with($data);
    }

    public function theoryOrnot($course_id, $topic_id, $st_id)
    {
        $queries = DB::table('theory')
        ->where('course_id', '=', $course_id)
        ->where('topic_id', '=', $topic_id)
        ->where('st_id', '=', $st_id)
        ->first();
        $check = !empty($queries) ? "Theory" : "";
        $theory_id   =   !empty($queries) ? $queries->theory_id : "";
        $data_onview = array('check'=>$check,'theory_id'=>$theory_id);
        return ($data_onview);
    }

    public function quizOrnot($course_id, $topic_id, $st_id)
    {
        $queries = DB::table('question_bank')
        ->where('course_id', '=', $course_id)
        ->where('topic_id', '=', $topic_id)
        ->where('st_id', '=', $st_id)
        ->first();
        $check = !empty($queries) ? "Quiz" : "";
        $question_id   =   !empty($queries) ? $queries->question_id : "";
        $data_onview = array('check'=>$check,'theory_id'=>$theory_id);
        return ($data_onview);
    }

    public function showPasswordForm(){
        $data['user_data'] = Auth::guard('customer')->user();
        return view("Front.changepassword")->with($data);
    }

    public function change_password(Request $request){


        $user_id = Auth::guard('customer')->user()->id;
        $credentials = [
                'password' => $request->old_password,
                'id' =>  $user_id
            ];
        if(Auth::guard('customer')->attempt($credentials))

        {
            $this->validate($request,["password" => "required_with:confirm_password|same:confirm_password"]);
            DB::table('users')
            ->where('id', $user_id)
            ->update(['password' =>  Hash::make($request->password)]);
            Session::flash('success_message', 'Password Update Sucessfully.');
            return redirect()->to('/user/change_password');

        }else{
            Session::flash('error_message', 'Old Password Not Match.');
            return redirect()->to("/user/change_password");
        }

    }

    public function profile_action(Request $request){

        $id = $request->id;
        if ($request->hasFile('profile_img')) {
            $image = $request->file('profile_img');
            $imageName = "stu".time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('/uploads/users'), $imageName);
        }
        else{
            $user_detail  = DB::table('users')->where('id', '=' ,$id)->first();
            $imageName = $user_detail->profile_img;
        }
        $name = trim($request->first_name).' '.trim($request->last_name);
        DB::table('users')
                ->where('id', $id)
                ->update([
                    'name'       => $name,
                    'first_name' => trim($request->first_name),
                    'last_name'  => trim($request->last_name),
                    'profile_img'=> $imageName
                ]);
            Session::flash('message', 'Profile Updated Sucessfully!');
            return redirect()->to('/user/dashboard');

    }

    public function thankyou(){
        $data['courses_data'] = DB::table("courses")->where("status",1)->where("deleted_at",NULL)->orderBy('ordering_id', 'ASC')->get();
        return view("Front.thankyou")->with($data);
    }

    public function store_data(Request $request){
        $user_id = $request->user_id;
        $user_name = $request->user_name;
        $user_email = $request->user_email;
        $interval_count = $request->interval_count;
        $interval = $request->interval;
        $price_default = $request->price_default;

        // if($request->payment_status == "Pending"){
        //     $payment_status = $request->payment_status;
        // }else{
        //     $payment_status = $request->payment_status;
        // }

        $payments = new Payments;
        $payments->customer_id = $user_id;
        $payments->customer_name = $user_name;
        $payments->customer_email = $user_email;
        $payments->amount = $price_default;
        $payments->plan_name = $interval_count." ".$interval;
        $payments->payment_status = "Successful";
        $payments->save();
        
        
    }


}    
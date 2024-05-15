<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use File;
use Session;
use Illuminate\Support\Str;
use App\Models\Questions;
use App\Models\QuestionBank;
use DB,Validator;
use Hash;
use Auth;

class AdminquesController1 extends Controller{

    public function __construct(){

    	$this->middleware('admin'); // Class admin does not exist

    }

	public function index(){
		return view("admin.add_questions");
	}

	public function post_questions(Request $request){
		$questions = $request->questions1;
		$options = $request->options;
		$correct_answer = $request->correct_answer;
		$marks = $request->marks;
		$time = $request->time;

		$options_value = implode(",",$options);

		$questions_model = new Questions();

		$questions_model->question = $questions; 
		$questions_model->options = $options_value; 
		$questions_model->correct_answer = $correct_answer; 
		$questions_model->default_marks = $marks; 
		$questions_model->default_time = $time; 
		$questions_model->save();

		
	}

	public function add_questions_bank(Request $request){

		$chapter_id = base64_decode($request->chapter_id);
		$data['chapter_id'] = $chapter_id;
		$data['chapter_data'] = DB::table("subtopics")->where("st_id",$chapter_id)->first();
		if (isset($_GET['question_type'])) {
		  $data['question_type'] = $_GET['question_type'];
		}else{
		  $data['question_type'] = "";		
		}

		return view("admin.add_questions_bank")->with($data);
	}

	public function uploadMedia(Request $request)
{
    if ($request->hasFile('upload')) {
        $originName = $request->file('upload')->getClientOriginalName();
        $fileName = pathinfo($originName, PATHINFO_FILENAME);
        $extension = $request->file('upload')->getClientOriginalExtension();
        $fileName = $fileName . '_' . time() . '.' . $extension;
        $path = base_path() .'/public/uploads/';
        $fileName = $request->file('upload')->move($path, $fileName)->getFilename();

        $CKEditorFuncNum = $request->input('CKEditorFuncNum');
        $url = asset('/public/uploads/' . $fileName);
        $msg = 'Image uploaded successfully';
        $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url')</script>";

        @header('Content-type: text/html; charset=utf-8');
        echo $response;
    }
    return false;
}

	public function edit_questions_bank(Request $request){
		

		$id = base64_decode($request->id);
		$chapter_id = base64_decode($request->chapter_id);
		if(isset($_GET['question_type'])){
		  	$question_type = $_GET['question_type'];
		  }else{
		  	$question_type = "";
		  }	

		

		if($id){

		  $question_details  = DB::table("question_bank")->where('q_id','=',$id)->first();
		  $chapter_data = DB::table("subtopics")->where("st_id",$question_details->chapter_id)->first();
		  
          $options  = DB::table("question_bank")->where('q_id','=',$question_details->q_id)->get();
          $data_onview = array('id'=>$id,'question_details'=>$question_details,'options'=>$options,'chapter_data'=>$chapter_data,'chapter_id'=>$chapter_id,'question_type'=>$question_type);
          return view("admin.edit_questions_bank")->with($data_onview);
		 }
	}

	public function fetch_subtopics(Request $request){
		$data['subtopics'] = DB::table("subtopics")->where("course_id", $request->course_id)->where("topic_id", $request->topic_id)
                                ->get(["st_id","title"]);
        return response()->json($data);
	}

	public function post_questions_bank(Request $request){

		// echo "<pre>";
		// dd($request);die;
		$chapter_id = base64_decode($request->chapter_id);
            

		$question_title = $request->question_title;
		$question_exam = $request->question_exam;
		$course = $request->course;
		$topics = $request->topics;
		$chapter = $request->chapter;
		$answer_explanation = $request->answer_explanation;
		$options = $request->options;
		$correct_answer_check = $request->correct_answer_check;
		$time_length = $request->time_length;
		$difficulty_level = $request->difficulty_level;
		$marks = $request->marks;

		$questions_data = QuestionBank::all()->last();
		//print_r($correct_answer_check);die;
		if(!empty($questions_data)){
			$new_q_id = $questions_data->q_id+1;
		}else{
			$new_q_id = 1;
		}
		
		$i = 0;
		//print_r($correct_answer_check);die;
		//echo $correct_answer_check[3];die;
		foreach($options as $op){
			$questions_model = new QuestionBank();

			$questions_model->q_id = $new_q_id; 
			$questions_model->option_id = $i+1; 
			$questions_model->title = $question_title; 
			$questions_model->quiz_exam = $question_exam; 
			$questions_model->course_id = $course; 
			$questions_model->topic_id = $topics; 
			$questions_model->chapter_id = $chapter; 
			$questions_model->correct_answer_explanation = $answer_explanation; 
			$questions_model->Options = $op; 
			$questions_model->correct_answer = $correct_answer_check[$i]; 
			$questions_model->time_length = $time_length; 
			$questions_model->difficulty_level = $difficulty_level; 
			$questions_model->marks = $marks; 
			
			$questions_model->save();
			$i++;
		}	
		Session::flash('message', 'Question added successfully');
		//return route()->redirect("show_questions");
		if($request->chapter_text == "chapter_text"){
			return redirect()->to('/admin/show_questions/'.base64_encode($request->chapter));
		}else{

			return redirect()->to('/admin/show_questions?question_type='.$_GET['question_type']);
		}
		

	}

	public function show_questions(Request $request){
		$chapter_id = base64_decode($request->chapter_id);
		
		$data['chapter_id'] = $chapter_id;
		if($chapter_id){
			$data['questions_data'] = DB::table("question_bank")->where("chapter_id",$chapter_id)->orderBy('ordering_id', 'ASC')
            ->groupBy('q_id')->get();
            $data['add_questions'] = "quiz_exam";
		}else{
			
			if($_GET['question_type'] == "quiz"){
				$data['questions_data'] = DB::table("question_bank")->where("quiz_exam","Quiz")->orWhere("quiz_exam","Both")->orderBy('ordering_id', 'ASC')
            	->groupBy('q_id')->get();
            	$data['add_questions'] = $_GET['question_type'];
			}
			if($_GET['question_type'] == "exam_builder"){

				$data['questions_data'] = DB::table("question_bank")->where("quiz_exam","Exam Builder")->orWhere("quiz_exam","Both")->orderBy('ordering_id', 'ASC')
            	->groupBy('q_id')->get();
            	$data['add_questions'] = $_GET['question_type'];
			}
			
		}
		

		return view("admin.show_questions")->with($data);
	}

	public function question_delete(Request $request){
		$id = base64_decode($request->id);
		$question_data = QuestionBank::where("q_id",$id)->first();
		$question_bank = QuestionBank::where("q_id",$id)->delete();

        // $question_bank->delete();
        // $question = QuestionBank::find($id);

        if ($question_bank) {
            Session::flash('message', 'Question Information Deleted Successfully!');
        } else {
            Session::flash('error', 'Question not found or could not be deleted!');
        }
        
        //echo $question_data->chapter_id;die;
        if($request->chapter_id){
        	return redirect()->to('/admin/show_questions/'.base64_encode($question_data->chapter_id));
        }else{
        	return redirect()->to('/admin/show_questions?question_type='.$_GET["question_type"]);
        }

	}

	public function question_status(Request $request){
       $result = DB::table('question_bank')
                    ->where('q_id', $request->question_id)
                    ->update(['status' => $request->status]);
                    if ($result) {
                    	return response()->json(['success' => true, 'message' => 'Status updated successfully']);} else {
        	return response()->json(['success' => false, 'message' => 'Failed to update status']);
        }

    }

public function post_questions_bank_edit(Request $request){

		$chapter_id = base64_decode($request->chapter_id);
		$course_id = $request->course_id;
		$topic_id = $request->topic_id;
            
        $q_id = $request->question_id;
		$question_title = $request->question_title;
		$question_exam = $request->question_exam;
		
		$answer_explanation = $request->answer_explanation;
		$options = $request->options;
		$correct_answer_check = $request->correct_answer_check;
		$time_length = $request->time_length;
		$difficulty_level = $request->difficulty_level;
		$marks = $request->marks;
		
		//print_r($options);die;

		

		
		$i = 0;
		//print_r($correct_answer_check);die;
		//echo $correct_answer_check[3];die;
		foreach($options as $op){
			
			$questions_data = DB::table("question_bank")->where("q_id",$i+1)->get();
			
			if(!empty($questions_data)){
				$result = DB::table('question_bank')
                    ->where('option_id', $i+1)
                    ->where('q_id', $q_id)
                    ->update(['title' => $question_title,'quiz_exam' => $question_exam,'correct_answer_explanation' => $answer_explanation,'Options' => $op,'correct_answer' => $correct_answer_check[$i],'time_length' => $time_length,'difficulty_level' => $difficulty_level,'marks' => $marks]);
                }else{
                	$questions_model = new QuestionBank();

					$questions_model->q_id = $q_id; 
					$questions_model->option_id = $i+1; 
					$questions_model->title = $question_title; 
					$questions_model->quiz_exam = $question_exam; 
					$questions_model->course_id = $course_id; 
					$questions_model->topic_id = $topic_id; 
					$questions_model->chapter_id = $chapter_id; 
					$questions_model->correct_answer_explanation = $answer_explanation; 
					$questions_model->Options = $op; 
					$questions_model->correct_answer = $correct_answer_check[$i]; 
					$questions_model->time_length = $time_length; 
					$questions_model->difficulty_level = $difficulty_level; 
					$questions_model->marks = $marks; 
					
					$questions_model->save();
                }
			
			 
			// $questions_model->title = $question_title; 
			// $questions_model->quiz_exam = $question_exam; 
			
			// $questions_model->correct_answer_explanation = $answer_explanation; 
			// $questions_model->Options = $op; 
			// $questions_model->correct_answer = $correct_answer_check[$i]; 
			// $questions_model->time_length = $time_length; 
			// $questions_model->difficulty_level = $difficulty_level; 
			// $questions_model->marks = $marks; 
			
			// $questions_model->update();
			$i++;
		}	
		//Session::flash('message', 'Question updated successfully');
		//return route()->redirect("show_questions");
		

    Session::flash('message', 'Question updated successfully');
    if($request->chapter_id){
    	return redirect()->to('/admin/show_questions/'.base64_encode($request->chapter_id));
    }else{

    	return redirect()->to('/admin/show_questions?question_type='.$_GET['question_type']);
    }
}

public function update_questionorder(Request $request)
    {    
        $questions = QuestionBank::all();
    

        foreach ($questions as $questionsVal) {

            foreach ($request->order as $order) {

                if ($order['question_id'] == $questionsVal->question_id) {

                    $questionsVal->update(['ordering_id' => $order['ordering_id']]);
                }
            }
        }

        return response(['message' => 'Update Successfully'], 200);
    }

}	
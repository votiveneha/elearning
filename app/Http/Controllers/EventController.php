<?php
  
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use App\Models\Event;
use DB;
use Auth;
  
class EventController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index(Request $request)
    {
        $user_id = Auth::guard("customer")->user()->id;
        $sql = "select COUNT(*) as title ,DATE(q_an.created_at) as start from (select *  FROM `question_analysis` WHERE `student_id` = ".$user_id." GROUP BY `question_id`) as q_an  GROUP BY DATE(q_an.created_at);";
        $data1 = DB::select($sql);
        $data2 = array();
        foreach ($data1 as $question_count) {
          array_push($data2, array("title"=>$question_count->title." questions","start"=>$question_count->start));
          
        }
        //echo json_encode($data2);die;
        //print_r($data2);die;

        $data['response'] = json_encode($data2);
        // echo "<pre>";
        // print_r(response()->json($data));die;
  
        return view('Front.full_calender')->with($data);
    }
 
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function ajax(Request $request)
    {
 
        switch ($request->type) {
           case 'add':
              $event = Event::create([
                  'title' => $request->title,
                  'start' => $request->start,
                  'end' => $request->end,
              ]);
 
              return response()->json($event);
             break;
  
           case 'update':
              $event = Event::find($request->id)->update([
                  'title' => $request->title,
                  'start' => $request->start,
                  'end' => $request->end,
              ]);
 
              return response()->json($event);
             break;
  
           case 'delete':
              $event = Event::find($request->id)->delete();
  
              return response()->json($event);
             break;
             
           default:
             # code...
             break;
        }
    }
}
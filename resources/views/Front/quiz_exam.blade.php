@extends('Front.layouts.layout')
@section('title', 'Quiz')

@section("current_page_js")
<script src="https://cdn.jsdelivr.net/npm/mathjax@3.0.0/es5/tex-mml-chtml.js"></script>
<script type="text/javascript">
  var total_questions = $(".pallate").length;
  $(".attempted").html($(".active-q").length+"/"+total_questions);
  var remaining_questions_nat = $(".not-atempt").length;
  var remaining_questions_skip = $(".skiped").length;
  var remaining_questions = remaining_questions_nat + remaining_questions_skip;
  $(".remaining_questions").html(remaining_questions);

  var question_count = "<?php echo count($quiz); ?>"; 
  if(question_count == 1){
    $(".next-btn-1").removeAttr("onclick");
    $(".pre-btn-1").removeAttr("onclick");
  }
  


  var quiz = [];
  var session_quiz_array1 = JSON.stringify(quiz);
  sessionStorage.setItem("quiz_json", session_quiz_array1);
  var timer = $(".ans_time-1");
  var seconds = 0;

  var q_timer = setInterval(function() {
    seconds++;
    timer.val(seconds);
  }, 1000);
  function next_btn(i,q_id){
    //alert(i);
    var total_div = $('.qustion-box-one').length;
    if(i == total_div){
      $(".next-btn").removeAttr("onclick");
    }else{
      var next_box = i+1;
      $(".qustion-box-one").hide();
      $(".qustion-box-one-"+next_box).show();
    }

    var question_title = $(".question_title-"+i).text();
    //alert(question_title);

    if($("input:radio[name='question_options-"+i+"']").is(":checked")) {
      
      var j;
      var answer_val = $("input:radio[name='question_options-"+i+"']:checked").val();
      var session_quiz_json = sessionStorage.getItem("quiz_json");
      var question_id = $(".question_id-"+i).val();
      console.log("quiz",session_quiz_json);
      var session_quiz_array1 = JSON.parse(session_quiz_json);
      session_quiz_array1.push({"question_id":question_id,"question":question_title,"answer":answer_val});
      var quiz1 = JSON.stringify(session_quiz_array1);
      sessionStorage.setItem("quiz_json", quiz1);
      
    }else{
      var ans_time = $(".ans_time-"+i).val();
      if(ans_time <= 15){
        $(".pallate-color-"+i).removeClass("not-atempt");
        $(".pallate-color-"+i).addClass("skiped");
      }
    }

    var answer_val1 = $("input:radio[name='question_options-"+i+"']:checked").val();
    var course_id = "";
    var topic_id = "";
    var subtopic_id = "";
    var active_div = $('.qust-no .active-q').length;
    var total_questions = $(".pallate").length;
    var total_time = $(".timer").val();
    var ans_time = $(".ans_time-"+i).val();
    //alert(ans_time);
    $.ajax({
      type: "post",
      url: "{{ url('/user/submit_question_answer') }}",
      data: {"q_id":q_id,"answer_val1":answer_val1,"reference_id":'{{ $reference_id }}',"attempted_questions":active_div,"total_questions":total_questions,"course_id":course_id,"topic_id":topic_id,"subtopic_id":subtopic_id,"total_time":total_time,"ans_time":ans_time,"quiz_type":"exam_builder","_token":"{{ csrf_token() }}"},
      cache: false,
      success: function(data){
         
      }
    });

    
    
    //clearInterval(q_timer);
    //alert(".ans_time-"+(i+1));
    var timer1 = $(".ans_time-"+(i+1));
    var seconds1 = 0;

    var q_timer1 = setInterval(function() {
      seconds1++;
      timer1.val(seconds1);
    }, 1000);
    console.log("total_div",total_div);
    console.log("(i+1)",(i+1));
    if(total_div == (i+1)){
      $(".next-btn-"+(i+1)).removeAttr("onclick");
      //$(".submit-btn").attr("onclick","submit_quiz1()");
    }

    window.history.replaceState(null, null, "?question="+(i+1));
  }
  var url_string = window.location.href; 
  var url = new URL(url_string);
  var c = url.searchParams.get("question");
  console.log(c);
  $(".qustion-box-one").hide();
  $(".qustion-box-one-"+c).show();
  function prev_btn(i){
    //alert(i);
    if(i == 1){
      $(".pre-btn").removeAttr("onclick");
    }else{
      var next_box = i-1;
      $(".qustion-box-one").hide();
      $(".qustion-box-one-"+next_box).show();
    }

    window.history.replaceState(null, null, "?question="+(i-1));
    
  }

  function question_pallate(i){
    $(".qustion-box-one").hide();
    $(".qustion-box-one-"+i).show();
    window.history.replaceState(null, null, "?question="+(i));
  }
  function answerClick(i){
    //alert(i);
    if($("input:radio[name='question_options-"+i+"']").is(":checked")) {
      $(".pallate-color-"+i).removeClass("not-atempt");
      $(".pallate-color-"+i).removeClass("skiped");
      $(".pallate-color-"+i).addClass("active-q");
      var active_div = $('.qust-no .active-q').length;
      var total_questions = $(".pallate").length;
      var attempted_div = active_div+"/"+total_questions;
      var remaining_questions = $('.qust-no .not-atempt').length;
      $(".attempted").html(attempted_div);
      $(".remaining_questions").html(remaining_questions);
      //next_btn(i,q_id);
    }

  }
  function submit_quiz1(){
    var total_div = $('.qustion-box-one').length;
    var answer_val1 = $("input:radio[name='question_options-"+total_div+"']:checked").val();
    var q_id = $(".question_id-"+total_div).val();
    var active_div = $('.qust-no .active-q').length;
    
    var total_questions = $(".pallate").length;
    var total_time = $(".timer1").val();
    var timer2 = "<?php echo $timer; ?>";
    var new_time = timer2.split(":");
    var timer3 = parseInt(new_time[0])*60 + parseInt(new_time[1]);
    console.log("timer3",timer3);
    var time_spend = timer3-total_time;
    
    

    
    var time_min = parseInt(time_spend/60); 
    var time_sec1 = parseInt(time_spend%60); 
    var digit_count = time_sec1.toString().length;
    var time_sec;
    if(digit_count < 2){
      time_sec = "0"+time_sec1;
    }else{
      time_sec = time_sec1;
    }
    var time_spent = time_min+":"+time_sec;
    
    //alert(timer2-total_time);
    var course_id = "";
    var topic_id = "";
    var subtopic_id = "";
    var ans_time = $(".ans_time-"+total_div).val();
    $.ajax({
      type: "post",
      url: "{{ url('/user/submit_quiz') }}",
      data: {"q_id":q_id,"answer_val1":answer_val1,"attempted_questions":active_div,"total_questions":total_questions,"course_id":course_id,"topic_id":topic_id,"subtopic_id":subtopic_id,"total_time":time_spent,"ans_time":ans_time,"quiz_type":"exam_builder","_token":"{{ csrf_token() }}"},
      cache: false,
      success: function(data){
         window.location.href = "{{ url('/user/session_analysis') }}/{{ base64_encode($reference_id) }}";
           
         
      }
    });
  }
  var timer2 = "<?php echo $timer; ?>";
  console.log("timer2",timer2);
  
  var interval = setInterval(function() {

    var new_time = getCookie("quiz_time_minutes-"+"<?php echo $reference_id; ?>");
    
    //console.log("quiz_time_minutes",new_time);
    if(new_time){
      var timer = new_time.split(':');
    }else{
      var get_timer = "<?php echo $get_timer; ?>";
      var time_min = parseInt(get_timer/60);
      var time_sec = parseInt(get_timer%60);
      var digit_count = time_sec.toString().length;
      if(digit_count < 2){
        time_sec1 = "0"+time_sec;
      }else{
        time_sec1 = time_sec;
      }
      var get_db_time = time_min+":"+time_sec1;
      if(get_timer){
        var timer = get_db_time.split(':');
      }else{
        var timer = timer2.split(':');
      }
      
    }
    
    //by parsing integer, I avoid all extra string processing
    var minutes = parseInt(timer[0], 10);
    var seconds = parseInt(timer[1], 10);

    --seconds;
    minutes = (seconds < 0) ? --minutes : minutes;
    console.log("seconds",seconds);
    
    
    if (minutes < 0) clearInterval(interval);
    seconds = (seconds < 0) ? 59 : seconds;
    seconds = (seconds < 10) ? '0' + seconds : seconds;
    //minutes = (minutes < 10) ?  minutes : minutes;
    $('.countdown').html(minutes + ':' + seconds);
    var new_time = parseInt(minutes*60) + parseInt(seconds);
    //console.log(new_time);
    // $(".ans_time-1").val(new_time);
    $(".timer1").val(new_time);
    timer2 = minutes + ':' + seconds;
    
    $(".timer").val(timer2);
    $.ajax({
      type: "post",
      url: "{{ url('/user/save_timer') }}",
      data: {"reference_id":"{{ $reference_id }}","timer_value":new_time,"_token":"{{ csrf_token() }}"},
      cache: false,
      success: function(data){
         
      }
    });


    if(timer2 == "0:00"){
      var total_questions = $(".pallate").length;
      for(var i = 1;i<=total_questions;i++){
        var q_id = $(".question_id-"+i).val();
        if(i != total_questions){
          next_btn(i,q_id);
          
        }
        
      }
      submit_quiz1();
      clearInterval(interval);
      
    }
    var now = new Date();
    var minutes1 = 120;
    now.setTime(now.getTime() + (minutes1 * 60 * 1000));
    document.cookie="quiz_time_minutes-"+"<?php echo $reference_id; ?>"+"="+minutes+":"+seconds;  
    document.cookie = "expires=" + now.toUTCString() + ";"
  }, 1000);
  function getCookie(name) {
    // Split cookie string and get all individual name=value pairs in an array
    let cookieArr = document.cookie.split(";");
    
    // Loop through the array elements
    for(let i = 0; i < cookieArr.length; i++) {
        let cookiePair = cookieArr[i].split("=");
        
        /* Removing whitespace at the beginning of the cookie name
        and compare it with the given string */
        if(name == cookiePair[0].trim()) {
            // Decode the cookie value and return
            return decodeURIComponent(cookiePair[1]);
        }
    }
    
    // Return null if not found
    return null;
  }
</script>
@endsection

@section('content')
   <section  style="background-color: #f8f8f8; height: 100vh; padding: 0px;" onload="startTime()" >
      <div class="container-fluid" data-aos="fade-up">
    <div class="row quiz_questions" style="padding-top: 33px; ">
  <div class="col-md-9 main-quest" >
    <div class="col-md-11 m-auto ">
      <div class="d-flex justify-content-between align-content-center func-tn">
        <h5 class="funt-far"> {{ $topic_titles1 }}</h5>
        
        <p class="m-0 fiv-con"><i class='bx bx-time-five'></i><span class="countdown"></span></p>
        <input type="hidden" name="timer1" class="timer1" value="">
        <input type="hidden" name="timer" class="timer" value="">
    </div>
        <?php
            $i = 1;

          ?>
          @foreach($quiz as $qu)
          @if($qu->status == 1 && $qu->deleted_at == NULL)
          @if($qu->quiz_exam == "Exam Builder" || $qu->quiz_exam == "Both")
        <div class="qustion-box-one qustion-box-one-{{ $i }}" style="@if($i != 1) display: none;@endif">
          
        <div class="question-main">
      <div class="title mb-3 mt-2">
        <input type="hidden" name="question_id" class="question_id-{{ $i }}" value="{{ $qu->q_id }}">
        <input type="hidden" name="ans_time" class="ans_time-{{ $i }}" value="">
        <div class="question_marks_title">
        <h6 class="tp-q">Question {{ $i }}</h6>
          @if($qu->marks <= 1)
            <span class="question_marks question_marks-{{ $i }}">[{{ $qu->marks }} mark]</span>
          @else
            <span class="question_marks question_marks-{{ $i }}">[{{ $qu->marks }} marks]</span>
          @endif
          
        </div>  
        <span class="question_title question_title-{{ $i }}">{!! $qu->title !!}</span>
        
        
        
        <!-- <div class="q-img">
        <img src="https://mathifyhsc.com/dev/public/assets/img/image 318.png">
      </div> -->
      </div>
      <?php
        $options = DB::table("question_bank")->where("course_id",$qu->course_id)->where("topic_id",$qu->topic_id)->where("chapter_id",$qu->chapter_id)->where("topic_id",$qu->topic_id)->where("q_id",$qu->q_id)->get();

        $options_session = DB::table("question_analysis")->where("reference_id",$reference_id)->where("question_id",$qu->q_id)->first();
        
       
        
      ?>
      <div class="row">
        <div class="col-md-12">
            @foreach($options as $op)
            <label class="customradio"><span class="radiotextsty">{!! $op->Options !!}</span>
            <input type="radio" name="question_options-{{ $i }}" value="{!! $op->option_id !!}" onclick="answerClick({{ $i }})" @if(!empty($options_session)) @if($op->option_id == $options_session->student_answer) checked @endif @endif>
            <span class="checkmark"></span>
            </label>
            @endforeach
          
         <!--  <div class="cat-ans">
         <input type="radio" id="cat" name="animal" value="" />
<label for="cat"><span>1</span>  bla bla</label>
</div>

   <div class="cat-ans">
         <input type="radio" id="cat2" name="animal" value="" />
<label for="cat2"><span>2</span> cat Lorem ipsum do bla bla</label>
</div>

   <div class="cat-ans">
         <input type="radio" id="cat3" name="animal" value="" />
<label for="cat3"><span>3</span>  lorem acc actual expoumd bla bla</label>
</div>   

 <div class="cat-ans">
         <input type="radio" id="cat4" name="animal" value="" />
<label for="cat4"><span>4</span>  lorem acc actual expoumd bla bla</label>
</div> -->   
<div class="nex-pre-btn">
<a style="cursor: pointer;" class="pre-btn pre-btn-{{ $i }}" onclick="prev_btn({{ $i }})"> Previous</a>
<a style="cursor: pointer;" class="next-btn next-btn-{{ $i }}" onclick="next_btn({{$i }},{{ $qu->q_id }})"> Next</a>
</div>


        </div>


      </div>
      <!--./row-->
    </div>
    

 </div>
 <?php
      $i++;
    ?>
    @endif
    @endif
    @endforeach
 </div>


          </div>

           <div class="col-md-3">
           <div class="elepsed-time">
            <div>
             <div class="watch-box">
<?php
          $user = Auth::guard("customer")->user();
          //echo $user->name;die;
          $user_name = explode(" ",$user->name);
          //print_r($user);die;
          
          
       ?> 
<div class="profle-c">
  <h2>
    <?php
      if(count($user_name)>1){
        echo strtoupper($user_name[0][0])."".strtoupper($user_name[1][0]);
      }else{
        echo strtoupper($user_name[0][0]);
      }
    ?>
  </h2>
</div>
     
     <div class="info-ex">
      <?php

      ?>
      <h5>{{ $user->name }}</h5>
      <p> Attempted: <b class="attempted"> 3/16</b></p>
       <p> Remaining: <b class="remaining_questions"> 13</b></p>

    </div>





         </div>
         <div class="watch-quet">
       <h5> Questions</h5>
  <div class="staus-que">

<p><span class="atp"></span> Attempted </p>
<p><span class="atp1"></span> Skipped </p>
<p><span class="atp2"></span> Not Attempted </p>


  </div>

     <div class="qust-no">
      <?php
            $i = 1;

          ?>

          @foreach($quiz as $qu)
          @if($qu->status == 1 && $qu->deleted_at == NULL)
          @if($qu->quiz_exam == "Exam Builder" || $qu->quiz_exam == "Both")
          <?php
            $options_session = DB::table("question_analysis")->where("reference_id",$reference_id)->where("question_id",$qu->q_id)->first();

          ?>
          @if($options_session)
          @if($options_session->student_answer)
            <a style="cursor: pointer;" class="pallate pallate-color-{{ $i }} active-q" onclick="question_pallate({{ $i }})">{{ $i }}</a>
          @else  
            {{ $options_session->student_answer }}
            @if($options_session->student_answer == NULL)
              <a style="cursor: pointer;" class="pallate pallate-color-{{ $i }} skiped" onclick="question_pallate({{ $i }})">{{ $i }}</a>
            @endif
          @endif
          @else
            <a style="cursor: pointer;" class="pallate pallate-color-{{ $i }} not-atempt" onclick="question_pallate({{ $i }})">{{ $i }}</a>
          @endif
      <?php
      $i++;
    ?>
    @endif
    @endif
    @endforeach
       <!-- <a href="#" class="active-q">2</a>
        <a href="#" class="active-q">3</a>
         <a href="#" class="not-atempt">4</a>
          <a href="#" class="skiped">5</a>
           <a href="#" class="skiped">6</a>
            <a href="#" class="not-atempt">7</a>
             <a href="#" class="not-atempt">8</a>
              <a href="#" class="not-atempt">9</a>
               <a href="#" class="not-atempt">10</a> -->
               
</div>
<center><a href="#" class="submit-btn" onclick="submit_quiz1()"> Submit</a></center>
<div class="quite_btn"><center><a href="{{ url('user/dashboard') }}" class="qt-btn"> Quit Exam</a></center></div>
         </div>
</div>

           </div>

          </div>



</div>
<br><br>

</div>
</section>
@endsection
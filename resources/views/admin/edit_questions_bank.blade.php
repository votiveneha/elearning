@extends('admin.layouts.layout')

@section('current_page_js')
<style type="text/css">
  /* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
  background-color: #fefefe;
  margin: auto;
  padding: 20px;
  border: 1px solid #888;
  width: 80%;
}

/* The Close Button */
.close {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}
</style>
@endsection

@section('current_page_css')
<style type="text/css">
  .cke_contents{
    height:100px !important;
  }
  /* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 9999; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
  background-color: #fefefe;
  margin: auto;
  padding: 20px;
  border: 1px solid #888;
  width: 50%;
}

/* The Close Button */
.close {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
  text-align: right;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}
.error{
  color:red;
}
</style>
@endsection

@section('js_bottom')
<script src="{{ url('/public') }}/ckeditor/ckeditor.js"></script>
<script src="https://cdn.jsdelivr.net/npm/mathjax@3.0.0/es5/tex-mml-chtml.js"></script>

<script>
        //$('textarea[name="DSC"]').ckeditor();
        CKEDITOR.replace('question_content', {
        
            toolbarGroups: [
        
       {
          "name": "basicstyles",
          "groups": ["basicstyles"]
        },
        {
          "name": "links",
          "groups": ["links"]
        },
        {
          "name": "paragraph",
          "groups": ['list', 'indent', 'blocks', 'align', 'bidi', 'paragraph', 'justify']
        },
        {
          "name": "document",
          "groups": ["mode"]
        },
        {
          "name": "insert",
          "groups": ["insert"]
        },
        {
          "name": "styles",
          "groups": ["styles"]
        },
        {
          "name": "about",
          "groups": ["about"]
        }
        
      ],
      filebrowserUploadUrl: "{{ route('admin.question.uploadMedia', ['_token' => csrf_token()]) }}",
      filebrowserUploadMethod: 'form',
      removeDialogTabs: 'image:advanced;link:advanced',
      // Remove the redundant buttons from toolbar groups defined 
        //extraPlugins:'mathjax',
           mathJaxLib : 'https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.4/latest.js?config=TeX-MML-AM_CHTML'
        });
        CKEDITOR.replace('answer_explanation', {
        
            toolbarGroups: [
        
       {
          "name": "basicstyles",
          "groups": ["basicstyles"]
        },
        {
          "name": "links",
          "groups": ["links"]
        },
        {
          "name": "paragraph",
          "groups": ['list', 'indent', 'blocks', 'align', 'bidi', 'paragraph', 'justify']
        },
        {
          "name": "document",
          "groups": ["mode"]
        },
        {
          "name": "insert",
          "groups": ["insert"]
        },
        {
          "name": "styles",
          "groups": ["styles"]
        },
        {
          "name": "about",
          "groups": ["about"]
        }
        
      ],
      filebrowserUploadUrl: "{{ route('admin.question.uploadMedia', ['_token' => csrf_token()]) }}",
      filebrowserUploadMethod: 'form',
      removeDialogTabs: 'image:advanced;link:advanced',
      // Remove the redundant buttons from toolbar groups defined 
        //extraPlugins:'mathjax',
           mathJaxLib : 'https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.4/latest.js?config=TeX-MML-AM_CHTML'
        });
        var options_length = $(".options_textarea").length;
        //console.log("options_text",options_text);
        for(var i = 1;i<=options_length;i++){
          CKEDITOR.replace('options-'+i, {
          
              toolbarGroups: [
          
         {
            "name": "basicstyles",
            "groups": ["basicstyles"]
          },
          {
            "name": "links",
            "groups": ["links"]
          },
          {
            "name": "paragraph",
            "groups": ['list', 'indent', 'blocks', 'align', 'bidi', 'paragraph', 'justify']
          },
          {
            "name": "document",
            "groups": ["mode"]
          },
          {
            "name": "insert",
            "groups": ["insert"]
          },
          {
            "name": "styles",
            "groups": ["styles"]
          },
          {
            "name": "about",
            "groups": ["about"]
          }
          
        ],
        filebrowserUploadUrl: "{{ route('admin.question.uploadMedia', ['_token' => csrf_token()]) }}",
      filebrowserUploadMethod: 'form',
      removeDialogTabs: 'image:advanced;link:advanced',
        // Remove the redundant buttons from toolbar groups defined 
          //extraPlugins:'mathjax',
             mathJaxLib : 'https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.4/latest.js?config=TeX-MML-AM_CHTML'
          });
        } 

        var counter = options_length+1;
        $(".check").click(function(){
            $(this).val("correct");
          });
        CKEDITOR.instances.question_content.on('key',function(){
          $(".preview_latex_error").hide();
        });
        function add_options(){
          $(".option_answer").append('<input type="hidden" name="ck_count" class="ck_count ck_count-'+counter+'" value="'+counter+'"><input type="hidden" name="correct_answer_check[]" value="incorrect" /><input type="checkbox" name="correct_answer_check[]" class="check-'+counter+'" value="incorrect"> Correct Answer<br><textarea name="options[]" class="materialize-textarea" id="options-'+counter+'"></textarea><br><button type="button" class="btn btn-primary myBtn_options12" id="myBtn_options-'+counter+'">Preview Latex</button><br>');

          $(".option_modal_div").append('<div id="myModal_options-'+counter+'" class="modal"><div class="modal-content"><span class="close close_options-'+counter+'" style="color:black;">×</span><div class="preview_latex_code_options-'+counter+'"></div></div></div>');
          $(".check-"+counter).click(function(){
            $(this).val("correct");
          });
          
          CKEDITOR.replace('options-'+counter, {
        
            toolbarGroups: [
        
       {
          "name": "basicstyles",
          "groups": ["basicstyles"]
        },
        {
          "name": "links",
          "groups": ["links"]
        },
        {
          "name": "paragraph",
          "groups": ['list', 'indent', 'blocks', 'align', 'bidi', 'paragraph', 'justify']
        },
        {
          "name": "document",
          "groups": ["mode"]
        },
        {
          "name": "insert",
          "groups": ["insert"]
        },
        {
          "name": "styles",
          "groups": ["styles"]
        },
        {
          "name": "about",
          "groups": ["about"]
        }
        
      ],
      filebrowserUploadUrl: "{{ route('admin.question.uploadMedia', ['_token' => csrf_token()]) }}",
      filebrowserUploadMethod: 'form',
      removeDialogTabs: 'image:advanced;link:advanced',
      // Remove the redundant buttons from toolbar groups defined 
        //extraPlugins:'mathjax',
           mathJaxLib : 'https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.4/latest.js?config=TeX-MML-AM_CHTML'
        });
          
             // Get the modal
var modal1 = document.getElementById("myModal_options-"+counter);

// Get the button that opens the modal
var btn1= document.getElementById("myBtn_options-"+counter);

// Get the <span> element that closes the modal
var span1 = document.getElementsByClassName("close_options-"+counter)[0];

// When the user clicks the button, open the modal 
var ck_count = $(".ck_count-"+counter).val();


$("#myBtn_options-"+ck_count).click(function(){
   //alert(ck_count);
   //var counter1 = counter-1;
    var editor_value = CKEDITOR.instances["options-"+ck_count].getData();
  if(editor_value != ""){
    modal1.style.display = "block";
  }else{
    $(".preview_latex_error").text("Please add the content");
  }
  
  
          
           //var mathml = MathJax.tex2mml(editor_value);
          
          $(".preview_latex_code_options-"+ck_count).empty().append("<p>" +editor_value+ "</p>");
              MathJax.typeset([".preview_latex_code_options-"+ck_count]);
});

// btn1.onclick = function() {

//   var editor_value = CKEDITOR.instances["options-"+counter].getData();
//   if(editor_value != ""){
//     modal.style.display = "block";
//   }else{
//     $(".preview_latex_error").text("Please add the content");
//   }
  
  
          
//            //var mathml = MathJax.tex2mml(editor_value);
//           //alert(editor_value);
//           $(".preview_latex_code").empty().append("<p>" +editor_value+ "</p>");
//               MathJax.typeset([".preview_latex_code"]);
//           }

          // When the user clicks on <span> (x), close the modal
          span1.onclick = function() {
            modal1.style.display = "none";
          }

          // When the user clicks anywhere outside of the modal, close it
          window.onclick = function(event) {
            if (event.target == modal1) {
              modal1.style.display = "none";
            }
          }
          counter++;
        }
        $("#cke_3_contents").removeAttr("style");
        $(document).ready(function () {
          $('#course-dropdown').on('change', function () {
                var course_id = this.value;
                
                $("#topic-dropdown").html('');
                $.ajax({
                    url: "{{url('/admin/fetch-topics')}}",
                    type: "POST",
                    data: {
                        country_id: course_id,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (result) {
                        $('#topic-dropdown').html('<option value="">-- Select Topic --</option>');
                        $.each(result.topics, function (key, value) {
                            $("#topic-dropdown").append('<option value="' + value
                                .topic_id + '">' + value.title + '</option>');
                        });
                        $('#city-dropdown').html('<option value="">-- Select City --</option>');
                    }
                });
            });
            $('#topic-dropdown').on('change', function () {
                var topic_id = this.value;
                var course_id = $("#course-dropdown").val();
                //alert(topic_id);
                $("#subtopic-dropdown").html('');
                $.ajax({
                    url: "{{url('/admin/fetch-subtopics')}}",
                    type: "POST",
                    data: {
                        course_id: course_id,
                        topic_id: topic_id,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (result) {
                        console.log("result",result.subtopics);
                        $('#subtopic-dropdown').html('<option value="">-- Select Chapter --</option>');
                        $.each(result.subtopics, function (key, value) {
                            $("#subtopic-dropdown").append('<option value="' + value
                                .st_id + '">' + value.title + '</option>');
                        });
                        //$('#city-dropdown').html('<option value="">-- Select City --</option>');
                    }
                });
            });
          });
        function preview_latex(){
          var editor_value = CKEDITOR.instances['question_content'].getData();
          
           //var mathml = MathJax.tex2mml(editor_value);
          //alert(editor_value);
          $(".preview_latex_code").empty().append("<p>" +editor_value+ "</p>");
    MathJax.typeset([".preview_latex_code"]);
          //$(".preview_latex_code").html(editor_value);
        }
        function preview_latex_ans_exp(){
          var editor_value = CKEDITOR.instances['answer_explanation'].getData();
          //alert("hello");
          $(".preview_latex_ans_exp").html(editor_value);
        }
        // Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  var editor_value = CKEDITOR.instances['question_content'].getData();
  console.log("editor_value",editor_value);
  if(editor_value != ""){
    modal.style.display = "block";
  }else{
    $(".preview_latex_error").text("Please add the content");
  }
  
  
          
           //var mathml = MathJax.tex2mml(editor_value);
          //alert(editor_value);
          $(".preview_latex_code").empty().append("<p>" +editor_value+ "</p>");
    MathJax.typeset([".preview_latex_code"]);
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

        // Get the modal
var modal24 = document.getElementById("myModal_ans");

// Get the button that opens the modal
var btn24 = document.getElementById("myBtn_ans");

// Get the <span> element that closes the modal
var span1 = document.getElementsByClassName("close_ans")[0];

// When the user clicks the button, open the modal 
btn24.onclick = function() {
  var editor_value = CKEDITOR.instances['answer_explanation'].getData();
  if(editor_value != ""){
    modal24.style.display = "block";
  }else{
    $(".preview_latex_error_ans").text("Please add the content");
  }
  
  
          
           //var mathml = MathJax.tex2mml(editor_value);
          //alert(editor_value);
          $(".preview_latex_code_ans").empty().append("<p>" +editor_value+ "</p>");
    MathJax.typeset([".preview_latex_code_ans"]);
}

// When the user clicks on <span> (x), close the modal
span1.onclick = function() {
  
  modal24.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal24) {
    modal24.style.display = "none";
  }
}

var textarea_count = $(".option_answer textarea").length;

console.log("textarea_count",textarea_count);

//var t = 1;

for(var t = 1;t<=textarea_count;t++){
  $(".option_modal_div").append('<div id="myModal_options-'+t+'" class="modal"><div class="modal-content"><span class="close_options close close_options-'+t+'" style="color:black;">×</span><div class="preview_latex_code_options-'+t+'"></div></div></div>');

}

$(".close_options").click(function(){
  $(".modal").hide();
});

function getPreview(i){
  var modal23 = document.getElementById("myModal_options-"+i);
  //alert(modal23);
  // Get the button that opens the modal
  var btn23 = document.getElementById("myBtn_options-"+i);

  // Get the <span> element that closes the modal
  var span2 = document.getElementsByClassName("close_options")[0];

  // When the user clicks the button, open the modal 

    var editor_value = CKEDITOR.instances["options-"+i].getData();
    if(editor_value != ""){
      modal23.style.display = "block";
      
      //$("#myModal_options-"+i).show();
    }else{

      $(".preview_latex_error_options").text("Please add the content");
    }
    
    
            
             //var mathml = MathJax.tex2mml(editor_value);
            //alert(editor_value);
            $(".preview_latex_code_options-"+i).empty().append("<p>" +editor_value+ "</p>");
      MathJax.typeset([".preview_latex_code_options-"+i]);
  

 

  // When the user clicks anywhere outside of the modal, close it
  window.onclick = function(event) {
    if (event.target == modal23) {
      modal23.style.display = "none";
    }
  }
  
}





$(function () {
    

    $("input[name=question_exam]:radio").click(function () {
        if ($('input[name=question_exam]:checked').val() == "Quiz") {
            $('.chapter-dropdown').show();
            
        } else if ($('input[name=question_exam]:checked').val() == "Exam Builder") {
            $('.chapter-dropdown').hide();
            $('.chapter-dropdown').removeClass("error");

        }else if ($('input[name=question_exam]:checked').val() == "Both") {
            $('.chapter-dropdown').show();

        }
    });
});
// Wait for the DOM to be ready
$(function() {
  // Initialize form validation on the registration form.
  // It has the name attribute "registration"
  $("#question_form").validate({
    ignore: [],  
    // Specify validation rules
    rules: {
      // The key name on the left side is the name attribute
      // of an input field. Validation rules are defined
      // on the right side
      question_exam: "required",
      course: "required",
      topics: "required",
      //chapter: "required",
      time_length: "required",
      difficulty_level: "required",
      marks: "required",
      
    question_title: {
       required: function(textarea) {
         CKEDITOR.instances['question_content'].updateElement();
         var editorcontent = textarea.value.replace(/<[^>]*>/gi, '');
         return editorcontent.length === 0;
       }
    },
    answer_explanation: {
       required: function(textarea) {
         CKEDITOR.instances['answer_explanation'].updateElement();
         var editorcontent = textarea.value.replace(/<[^>]*>/gi, '');
         return editorcontent.length === 0;
       }
    }
    },
    errorPlacement: function(error, element) 
                {
                    if (element.attr("name") == "question_title") 
                   {
                    error.insertAfter("#cke_question_content");
                    } else if(element.attr("name") == "question_exam"){
                      error.insertAfter(".questions_available");
                    
                    }else{
                      error.insertAfter(element);
                    }
                },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function(form) {
      form.submit();
      
    }
  });
});

    </script>

@endsection

@section('content')
<div class="wrapper">


  <!-- Main Sidebar Container -->


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
     <!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close" style="color:black;">&times;</span>
    <div class="preview_latex_code">
                    
                  </div>
  </div>

</div>

   <!-- The Modal -->
<div id="myModal_ans" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close close_ans" style="color:black;">&times;</span>
    <div class="preview_latex_code_ans">
                    
                  </div>
  </div>

</div>
<!-- The Modal -->
<div id="myModal_options" class="modal modal_option">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close close_options" style="color:black;">&times;</span>
    <div class="preview_latex_code_options">
                    
                  </div>
  </div>

</div>
<div class="option_modal_div"></div>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Question Form</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Question Form</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">Edit Questions</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            
            <form action="{{ url('/admin/post_questions_bank_edit') }}?question_type={{ $question_type }}" id="question_form" method="post">
                      {!! csrf_field() !!}
                       

            <div class="row">
              <!-- <div class="col-md-6">
                <label>Question Title</label>
                <div class="form-group">
                  <div class="input-group">
                    
                    <input type="text" class="form-control" name="question_title" >
                    @if (\Session::has('error'))
              <span class="" style="color:red">
                  {!! \Session::get('error') !!}
              </span>
          @endif
                  </div>
                </div>
              </div> -->
              <div class="col-md-12">
                <div class="form-group">
                  <label>Question Content</label>
                  <div class="input-group">
                    <input type="hidden" name="question_id" value="{{ $id }}">
                    <input type="hidden" name="chapter_id" value="{{ $chapter_id }}">
                    <input type="hidden" name="course_id" value="{{ $question_details->course_id }}">
                    <input type="hidden" name="topic_id" value="{{ $question_details->topic_id }}">
                    
                    <textarea name="question_title" class="materialize-textarea" id="question_content">
                      {!! $question_details->title !!}
                    </textarea>
                  </div><br>
                  
                  <div class="preview_latex_button">
                    <button type="button" class="btn btn-primary" id="myBtn">Preview Latex</button>
                  </div>
                  <div class="preview_latex_error" style="color:red"></div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label>Questions available in:</label>
                  <div class="input-group questions_available">
                  @if($question_type == "quiz")   
                  <div class="icheck-primary d-inline">
                    <input type="radio" id="radioPrimary1" name="question_exam" value="Quiz" @if($question_details->quiz_exam == "Quiz") checked @endif>
                    <label for="radioPrimary1">
                      Quiz
                    </label>
                  </div><br><br>
                  <div class="icheck-primary d-inline">
                    <input type="radio" id="radioPrimary3" name="question_exam" value="Both" @if($question_details->quiz_exam == "Both") checked @endif>
                    <label for="radioPrimary3">
                      Quiz and Exam Builder both
                    </label>
                  </div><br><br>
                  @endif
                  @if($question_type == "exam_builder")
                  <div class="icheck-primary d-inline">
                    <input type="radio" id="radioPrimary2" name="question_exam" value="Exam Builder" @if($question_details->quiz_exam == "Exam Builder") checked @endif>
                    <label for="radioPrimary2" >
                      Exam Builder
                    </label>
                  </div><br><br>
                  <div class="icheck-primary d-inline">
                    <input type="radio" id="radioPrimary3" name="question_exam" value="Both" @if($question_details->quiz_exam == "Both") checked @endif>
                    <label for="radioPrimary3">
                      Exam Builder and Quiz both
                    </label>
                  </div><br><br>
                  @endif
                  @if($question_type == "quiz_exam")
                    <div class="icheck-primary d-inline">
                      <input type="radio" id="radioPrimary1" name="question_exam" value="Quiz" @if($question_details->quiz_exam == "Quiz") checked @endif>
                      <label for="radioPrimary1">
                        Quiz
                      </label>
                    </div><br><br>
                    <div class="icheck-primary d-inline">
                    <input type="radio" id="radioPrimary2" name="question_exam" value="Exam Builder" @if($question_details->quiz_exam == "Exam Builder") checked @endif>
                    <label for="radioPrimary2" >
                      Exam Builder
                    </label>
                  </div><br><br>
                    <div class="icheck-primary d-inline">
                      <input type="radio" id="radioPrimary3" name="question_exam" value="Both">
                      <label for="radioPrimary3">
                        Quiz and Exam Builder both
                      </label>
                    </div><br><br>
                  @endif 
                  </div>
                </div>
              </div>
              
              
              
             <!--  <div class="col-md-4">
                <div class="form-group">
                  <label>Course</label>
                  <div class="input-group">
                    <?php
                      $course = DB::table("courses")->where("course_id",$question_details->course_id)->first();
                    ?>
                    <input type="text" class="form-control" name="course" value="{{ $course->title }}" readonly="">
                    
                  </div>
                </div>
              </div> -->
              <div class="col-md-4">
                <div class="form-group">
                  <?php
                    $course1 = DB::table("courses")->where("course_id",$question_details->course_id)->first();
                  ?>
                  <label>Select Course</label>
                  <div class="input-group">
                    <?php
                      $course = DB::table("courses")->get();
                    ?>
                    <select class="form-control" name="course" id="course-dropdown">
                      <option value="">Select Course</option>
                      @foreach($course as $cors)
                      <option value="{{ $cors->course_id }}" @if($course1->course_id == $cors->course_id) selected @endif>{{ $cors->title }}</option>
                      @endforeach
                      
                    </select>
                    
                  </div>
                </div>
              </div>
              <!-- <div class="col-md-4">
                <div class="form-group">
                  <label>Topics</label>
                  <div class="input-group">
                    <?php
                      $topics = DB::table("topics")->where("topic_id",$question_details->topic_id)->first();
                    ?>
                    <input type="text" class="form-control" name="topics" value="{{ $topics->title }}">
                    
                  </div>
                </div>
              </div> -->
              <div class="col-md-4">
                <div class="form-group">
                  <label>Select Topics</label>
                  <div class="input-group">
                    <?php
                      $topics = DB::table("topics")->where("course_id",$course1->course_id)->get();
                      $topics1 = DB::table("topics")->where("topic_id",$question_details->topic_id)->first();

                    ?>
                    <select class="form-control" name="topics" id="topic-dropdown">
                      <option value="">Select Topics</option>
                      @foreach($topics as $ts)
                      <option value="{{ $ts->topic_id }}" @if($ts->topic_id == $topics1->topic_id) selected @endif>{{ $ts->title }}</option>
                      @endforeach
                      
                    </select>
                    
                  </div>
                </div>
              </div>
              @if(!empty($chapter_data))
              <div class="col-md-4 chapter-dropdown">
                <div class="form-group">
                  <label>Select Chapter</label>
                  <div class="input-group">
                    <?php
                      $chapters = DB::table("subtopics")->where("topic_id",$topics1->topic_id)->get();
                      $chapter = DB::table("subtopics")->where("st_id",$chapter_data->st_id)->first();
                    ?>
                    <select class="form-control" name="chapter" id="subtopic-dropdown">
                      <option value="">Select Chapters</option>
                      @foreach($chapters as $ch)
                      <option value="{{ $ch->st_id }}" @if($chapter->st_id == $ch->st_id) selected @endif>{{ $ch->title }}</option>
                      @endforeach
                      
                    </select>
                    
                  </div>
                  
                </div>
              </div>  
              <!-- <div class="col-md-4 chapter-dropdown">
                <div class="form-group">
                  <label>Chapter</label>
                  <div class="input-group">
                    <?php
                      $chapter = DB::table("subtopics")->where("st_id",$chapter_data->st_id)->first();
                    ?>
                    <input type="text" class="form-control" name="chapter" value="{{ $chapter->title }}" readonly="">
                    
                  </div>
                  
                </div>
              </div> -->
              @endif
              <div class="col-md-4">
                <div class="form-group">
                  <label>Time Length(Seconds)</label>
                  <div class="input-group">
                    <input type="text" name="time_length" class="form-control" value="{{ $question_details->time_length }}">
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Difficulty Level</label>
                  <div class="input-group">
                    
                    <select class="form-control" name="difficulty_level" id="difficulty_level">
                      <option value="">Select Difficulty Level</option>
                      <option value="Easy" @if($question_details->difficulty_level == "Easy") selected @endif>Easy</option>
                      <option value="Medium" @if($question_details->difficulty_level == "Medium") selected @endif>Medium</option>
                      <option value="Hard" @if($question_details->difficulty_level == "Hard") selected @endif>Hard</option>
                    </select>
                    
                  </div>
                  
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Marks</label>
                  <div class="input-group">
                    <input type="text" name="marks" class="form-control" value="{{ $question_details->marks }}">
                  </div>
                  
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label>Correct Answer Explanation</label>
                  <div class="input-group">
                    <textarea name="answer_explanation" class="materialize-textarea" id="answer_explanation">
                      {!! $question_details->correct_answer_explanation !!}
                    </textarea>
                  </div><br>
                  <button type="button" class="btn btn-primary" id="myBtn_ans">Preview Latex</button>
                  <div class="preview_latex_error_ans" style="color:red"></div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label>Add Options</label>
                  <div class="input-group option_answer">
                    <!-- <input type="hidden" name="correct_answer_check[]" value="incorrect" /> -->
                    <?php
                      $i = 1;
                    ?>
                    @foreach($options as $op)
                    <input type="hidden" class="op_number-{{ $i }}" name="op_number" value="{{ $i }}" />
                    <input type="hidden" name="correct_answer_check[]" value="{{ $op->correct_answer }}" />
                    <input type="checkbox" name="correct_answer_check[]" class="check" value="incorrect" @if($op->correct_answer == "correct") checked @endif> Correct Answer<br>
                    <textarea name="options[]" class="materialize-textarea options_textarea" id="options-{{ $i }}" col="10">{!! $op->Options !!}</textarea><br>
                    <button type="button" class="btn btn-primary getPreview" id="myBtn_options-{{ $i }}" onclick="getPreview('{{ $i }}')">Preview Latex</button><br>
                    <div class="preview_latex_error_options" style="color:red"></div>
                    <?php $i++; ?>
                    @endforeach
                  </div><br>
                  
                  <button style="text-align:center" type="button" class="btn btn-primary" onclick="add_options()">Add options</button>
                </div>
              </div>
              
            </div>
            <!-- /.row -->

              

        
         
            <!-- /.row -->
          </div>
           <div class="card-footer">
            <input type="submit" id="submit_btn" class="btn btn-primary" value="Submit" id="">
          </div>
        </form>
            <!-- /.row -->
          </div>


        
          <!-- /.card-body -->
         
        </div>
        <!-- /.card -->

    

    
       
       
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
       
    </section>
    <!-- /.content -->

  </div>
  <!-- /.content-wrapper -->


  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>

@endsection
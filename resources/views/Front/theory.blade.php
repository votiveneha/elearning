@extends('Front.layouts.layout')
@section('title', 'Course view')

@section('current_page_css')
<style type="text/css">
  ::-webkit-scrollbar {
    width: 0 !important;
}
@media print {
  body {
    display: none;
  }
}
</style>
@endsection

@section("current_page_js")
<script type="text/javascript">


// document.onmousedown = disableRightclick;
// var message = "Right click not allowed !!";
// document.querySelector('#myFrame').scrolling = "no";
// function disableRightclick(evt){
//     if(evt.button == 2){
//         //alert(message);
//         return false;    
//     }
// }
// document.addEventListener('contextmenu', function(e){
// 	e.preventDefault();
// });

// document.addEventListener('keydown',function(e){
// 	if(e.ctrlKey || e.metaKey){
// 		e.preventDefault();
// 	}
// });

$(".pdf-line").hover(function(){
  $.ajax({
    type: "POST",
    url: "{{ url('/user/read_theory') }}",
    data: {"theory_id":"{{ $theory_id }}",_token: '{{csrf_token()}}'},
    cache: false,
    success: function(data){
       $("#resultarea").text(data);
    }
  });
});

</script>
@endsection
@section('content')

<div class="row">
      <a href="#" class="d-flex key-space" onclick="history.back()">
      	
      	<span class="material-symbols-outlined mr-2">
keyboard_backspace
</span> Back </a>
@if($queries)
  <div class="col-md-10 m-auto">
<div class="theory-box">

  <div class="pdf-line">
 	<?php
 		$theory = DB::table("subtopics")->where("st_id",$queries->st_id)->first();
 	?>
  <p>  Theory - {{ $theory->title }}</p>

 <center > 
        <!-- <iframe id="fraDisabled" src="{{ url('/public') }}/assets/img/{{ $queries->theory_pdf }}#toolbar=0" width="100%" height="500"/> -->

          <?php
//           echo url('/public')."/assets/img/".$queries->theory_pdf;
//            $pdf = public_path()."/assets/img/".$queries->theory_pdf[0];
// $imagick = new Imagick();
  
//         $imagick->readImage($pdf);
  
//         $saveImagePath = public_path('/assets/img/pdf_images/');
//         $imagick->writeImages($saveImagePath, true);
  
//         echo response()->file($saveImagePath);

          ?>
        
          @if($queries->pdf_link)
          <div class="">
            <iframe src="{{ $queries->pdf_link }}" width="640" height="480" allow="autoplay"></iframe>
          </div>
          @else
            <iframe id="myFrame" src="{{ url('/public') }}/assets/img/{{ $queries->theory_pdf }}#toolbar=0" width="100%" height="500" frameborder="0" onload="injectJS()"></iframe>
          @endif
          
          <!-- <iframe id="myFrame" src="{{ url('/public') }}/assets/img/{{ $queries->theory_pdf }}#toolbar=0" width="100%" height="500" frameborder="0" onload="injectJS()"></iframe> -->
         <!-- <embed id="fraDisabled" src="{{ url('/public') }}/assets/img/{{ $queries->theory_pdf }}#toolbar=0" width="100%" height="500">  -->
        </embed> 
    </center> 

  </div>

</div>
          </div>
 @else         
<style type="text/css">
.chose-q h2 {
    text-align: center;
    font-size: 19px;
}
</style>
<div class="col-md-12">
<div class="chose-q">
<center><img src="{{ url('/public') }}/assets/img/no_data_found.png" style="width: 150px;" class="mb-3">
</center>
   <h2> No Theory found </h2>
  </div>
  </div>
@endif
</div>
<script>

</script>
@endsection
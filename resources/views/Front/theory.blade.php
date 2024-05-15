@extends('Front.layouts.layout')
@section('title', 'Course view')

@section('current_page_css')
<style type="text/css">
  ::-webkit-scrollbar {
    display: none;
}
</style>
@endsection

@section("current_page_js")
<script type="text/javascript">
document.onmousedown = disableRightclick;
var message = "Right click not allowed !!";
document.querySelector('#myFrame').scrolling = "no";
function disableRightclick(evt){
    if(evt.button == 2){
        //alert(message);
        return false;    
    }
}
document.addEventListener('contextmenu', event => event.preventDefault());
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

 <center> 
        <!-- <iframe id="fraDisabled" src="{{ url('/public') }}/assets/img/{{ $queries->theory_pdf }}#toolbar=0" width="100%" height="500"/> -->
          <iframe id="myFrame" src="{{ url('/public') }}/assets/img/{{ $queries->theory_pdf }}#toolbar=0" style="pointer-events: none;" width="100%" height="500" frameborder="0" scrolling="no"></iframe>
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

@endsection
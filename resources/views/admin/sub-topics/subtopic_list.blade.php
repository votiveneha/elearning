@extends('admin.layouts.layout')
@section('title','Sub-topic List')
@section('current_page_css')
<style>
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
</style>
@endsection
@section('js_bottom')

<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script>
function addTheory(i){
  //alert(i);
  // $(".modal").attr("id","myModal-"+i);
  // $(".course_id").addClass("course_id-"+i);
  // $(".topic_id").addClass("topic_id-"+i);
  // $(".st_id").addClass("st_id-"+i);
  $("#myModal-"+i).show();
  // var course_id = $(".course_id_"+i).val();
  // //alert(course_id);
  // var topic_id = $(".topic_id_"+i).val();
  // var st_id = $(".st_id_"+i).val();
  // $(".course_id-"+i).val(course_id);
  // $(".topic_id-"+i).val(topic_id);
  // $(".st_id-"+i).val(st_id);
}
$(".close").click(function(){

  $(".modal").hide();
});
var modal = document.getElementById("myModal");
// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

</script>
@endsection
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Chapter Management</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Chapter List</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
          

            <div class="card">
              <div class="card-header">
                <h1 class="card-title">Chapter List</h1>
                <div style="float:right; margin-right:10px; margin-top:10px;">
                  <a href="{{ url('/admin/subtopic-form1') }}/{{ $course_id }}/{{ $topic_id }}" class="btn btn-primary" style="color:#FFFFFF"> Add New Chapter</a>
                </div>
              </div>

              <!-- /.card-header -->
              <div class="card-body">
                 @if(Session::has('message'))
                 <div class="alert alert-success alert-dismissable">
                  <i class="fa fa-check"></i>
                  <button aria-hidden="true" data-dismiss="alert" class="close" type="button">x</button>
                {{Session::get('message')}}</div>

                    @endif
                     @if(Session::has('error'))
        <div class="alert alert-danger alert-dismissable">
          <i class="fa fa-check"></i>
          <button aria-hidden="true" data-dismiss="alert" class="close" type="button">x</button>
          {{Session::get('error')}}
        </div>
      @endif
                <table id="chapter_list" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <!-- <th>Image</th> -->
                    <th>Course</th>
                    <th>Topic</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th>Action</th>
                    <th>Another Actions</th>
                  </tr>
                  </thead>
                  <tbody id="chapterBodyContents">
                                      <?php $i=1; ?>

                  @foreach ($topic_list as $list)
                  <tr class="chaptertableRow" data-st_id="{{ $list->st_id }}">
                    <td class="serial-number"> {{ $i }}</td>
                    <td>{{ $list->title }}</td>
                    <td>{{ $list->course_title }}</td>
                    <td>{{ $list->topic_title }}</td>
                    <td>{{ $list->type }}</td>
                    <td>
                   
                    <input data-id="{{$list->st_id}}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $list->status ? 'checked' : '' }}>
                    </td>
                    <td>

                      <!-- <a href="{{ route('course.view', base64_encode($list->course_id)) }}"><i class="fa fa-eye"></i></a> -->
                      <input type="hidden" name="course_id-{{ $i }}" class="course_id_{{ $i }}" value="{{ $list->course_id }}">
                      <input type="hidden" name="topic_id-{{ $i }}" class="topic_id_{{ $i }}"  value="{{ $list->topic_id }}">
                      <input type="hidden" name="st_id-{{ $i }}" class="st_id_{{ $i }}" value="{{ $list->st_id }}">
                    <a href="{{ route('subtopic.edit', base64_encode($list->st_id)) }}"><i class="fa fa-edit"></i></a>
                      
                      
                      <a title="Delete Topic" href="{{ url('/admin/subtopic-delete/') }}/{{base64_encode($list->st_id)}} }}/{{$topic_id }}" onclick="return confirm('Are you sure you want to delete this record?')"><i class="fa fa-trash"></i></a>
                      
                      
                      
                    </td>
                    <td>
                      @if($list->type == "Theory")
                      <a href="#" class="btn btn-success" id="myBtn-{{ $i }}" onclick="addTheory('{{ $i }}')">Add Theory</a>
                      @endif
                      @if($list->type == "Quiz")
                      <a href="{{ url('admin/show_questions') }}/{{ base64_encode($list->st_id) }}" class="btn btn-success" id="myBtn-{{ $i }}")">Add Questions</a>
                      @endif
                    </td>
                  </tr>
                                      
                  <!-- The Modal -->
    <div id="myModal-{{ $i }}" class="modal">

      <!-- Modal content -->
      <div class="modal-content">
        <span class="close" style="color:black;">&times;</span>
        <div class="upload_pdf">
          <form action="{{ url('/admin/theory_action') }}" class="theory_form-{{ $i }}" id="theory_form" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Upload PDF<span class="mandatory" style="color:red"> *</span></label>
                  <input type="hidden" name="course_id" class="course_id-{{ $i }}" value="{{ $list->course_id }}">
                      <input type="hidden" name="topic_id" class="topic_id-{{ $i }}" value="{{ $list->topic_id }}">
                      <input type="hidden" name="st_id" class="st_id-{{ $i }}" value="{{ $list->st_id }}">
                  <input type="file" class="form-control" name="theory_pdf" id="theory_pdf"><br>
                  <?php
                    $theory = DB::table("theory")->where("course_id",$list->course_id)->where("topic_id",$list->topic_id)->where("st_id",$list->st_id)->first();

                    if(!empty($theory)){
                      ?>
                      <embed src="{{ url('/public') }}/assets/img/{{ $theory->theory_pdf }}#toolbar=0" width="200" height="200"> 
                      </embed>
                      <?php
                    }
                  ?>
                </div>
                <input type="submit" class="btn btn-primary" value="Submit" id="">
              </div>
            </div>
          </form>  
        </div>
      </div>

    </div>
     <?php $i++; ?>
                  @endforeach            
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>


  <!-- Control Sidebar -->

  <!-- /.control-sidebar -->

<!-- ./wrapper -->
@endsection

@section('js_bottom')
<script src="{{ url('/') }}/public/design/admin/js/bootstrap.min.js" type="text/javascript"></script>

<!-- DATA TABES SCRIPT -->
<script src="https://jqueryvalidation.org/files/dist/jquery.validate.min.js"></script>
<script>

   $('.toggle-class').on("change", function() {
    var status = $(this).prop('checked') == true ? 1 : 0; 
    var st_id = $(this).data('id'); 
    $.ajax({
      type: "GET",
      dataType: "json",
      url: "<?php echo url('/admin/subtopic_status'); ?>",
      data: {'status': status, 'st_id': st_id},
       success: function(data){

        if(data.success){
          toastr.success('status changeed successfully');
        }
        else{
          toastr.error('Failed to change status');

        }
        },
      
    });
  })

$(".theory_form-9").validate({
  rules: {
    theory_pdf: {
      required: true
      
    }
  }
});
</script>



@stop








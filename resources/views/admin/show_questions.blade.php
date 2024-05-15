@extends('admin.layouts.layout')
@section("other_css")

<!-- DATA TABLES -->

<link href="{{ url('/') }}/design/admin/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<meta name="_token" content="{!! csrf_token() !!}" />

@stop
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Questions Management</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Questions List</li>
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
                <h3 class="card-title">Questions List</h3>
                <div style="float:right; margin-right:10px; margin-top:10px;">
                  <a href="{{ url('/admin/add_questions_bank') }}/@if($chapter_id){{ base64_encode($chapter_id) }}@endif?question_type={{ $add_questions }}" class="btn btn-primary" style="color:#FFFFFF"> Add New Questions</a>
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
                <div class="table-responsive">
                <table id="question_list1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Question Content</th>
                    <th>Question Available In</th>
                    <th>Course</th>
                    <th>Topic</th>
                    <th>Chapter</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody id="questionBodyContents">
                  <?php $i=1; ?>
                  @foreach ($questions_data as $list)
                  @if($list->deleted_at == NULL)
                  <tr class="tableRow" data-question_id="{{ $list->question_id }}">
                    <td class="serial-number"> {{ $i }}</td>
                    <td>{!! $list->title !!}</td>
                    <td>{{ $list->quiz_exam }}</td>
                    <td>
                      <?php
                        $course = DB::table("courses")->where("course_id",$list->course_id)->first();
                        echo $course->title;
                      ?>
                    </td>
                    <td>
                      <?php
                        $topic = DB::table("topics")->where("topic_id",$list->topic_id)->first();
                        echo $topic->title;
                      ?>
                    </td>
                    <td>
                      <?php
                        if($list->chapter_id){
                          $subtopic = DB::table("subtopics")->where("st_id",$list->chapter_id)->first();

                        echo $subtopic->title;
                        }
                        
                      ?>
                    </td>
                        <td>
                    <input data-id="{{$list->q_id}}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $list->status ? 'checked' : '' }}>
                    </td>
                     
                    <td>

                      <!-- <a href="{{ route('course.view', base64_encode($list->course_id)) }}"><i class="fa fa-eye"></i></a> -->

                    <a href="{{ route('question.edit', ['id'=>base64_encode($list->q_id),'chapter_id'=>base64_encode($chapter_id)]) }}?question_type={{ $add_questions }}"><i class="fa fa-edit"></i></a>
                      @if($chapter_id)
                      <a title="Delete User" href="{{ route('question.delete',['id'=>base64_encode($list->q_id),'chapter_id'=>$chapter_id] ) }}" onclick="return confirm('Are you sure you want to delete this record?')"><i class="fa fa-trash"></i></a>
                      @else
                      <a title="Delete User" href="{{ route('question.delete',base64_encode($list->q_id)) }}?question_type={{ $add_questions }}" onclick="return confirm('Are you sure you want to delete this record?')"><i class="fa fa-trash"></i></a>
                      @endif
                    </td>
                  </tr>
                  
                  
                 
                 
                     <?php $i++; ?>
                     @endif
                                    @endforeach            
                  </tbody>
                <!--   <tfoot>
                  <tr>
                    <th>Rendering engine</th>
                    <th>Browser</th>
                    <th>Platform(s)</th>
                    <th>Engine version</th>
                    <th>CSS grade</th>
                  </tr>
                  </tfoot> -->
                </table>
                </div>
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






<!-- Bootstrap -->

<script src="{{ url('/') }}/public/design/admin/js/bootstrap.min.js" type="text/javascript"></script>

<!-- DATA TABES SCRIPT -->
<script src="https://jqueryvalidation.org/files/dist/jquery.validate.min.js"></script>
  
<!--Export table button CSS-->



<script src="https://cdn.jsdelivr.net/npm/mathjax@3.0.0/es5/tex-mml-chtml.js"></script>
<script>

   $('.toggle-class').on("change", function() {
    var status = $(this).prop('checked') == true ? 1 : 0; 
    var question_id = $(this).data('id');

    $.ajax({
      type: "Post",
      dataType: "json",
      url: "<?php echo url('/admin/question_status'); ?>",
      data: {'status': status, 'question_id': question_id},
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Include CSRF token in headers
    },
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

</script>
@stop








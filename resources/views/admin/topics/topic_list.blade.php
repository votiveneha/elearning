@extends('admin.layouts.layout')
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Topic Management</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Topic List</li>
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
                <h3 class="card-title">Topic List</h3>
                <div style="float:right; margin-right:10px; margin-top:10px;">
                  <a href="{{ url('/admin/topic-form') }}" class="btn btn-primary" style="color:#FFFFFF"> Add New Topic</a>
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
                <table id="topic_list" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <!-- <th>Image</th> -->
                    <th>Course</th>
                    <th>Status</th>
                    <th>Action</th>
                    <th>Another Actions</th>
                  </tr>
                  </thead>
                  <tbody id="topicBodyContents">
                                      <?php $i=1; ?>

                  @foreach ($topic_list as $list)
                   <tr class="topictableRow" data-topic_id="{{ $list->topic_id }}">

                    <td class="serial-number"> {{ $i }}</td>
                    <td>{{ $list->title}}</td>
                    <td>{{ $list->course_title}}</td>
                    <td>
                   
                    <input data-id="{{$list->topic_id}}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $list->status ? 'checked' : '' }}>
                    </td>
                    <td>

                      <!-- <a href="{{ route('course.view', base64_encode($list->course_id)) }}"><i class="fa fa-eye"></i></a> -->

                    <a href="{{ route('topic.edit', base64_encode($list->topic_id)) }}"><i class="fa fa-edit"></i></a>
                      
                      <a title="Delete Topic" href="{{ route('topic.delete', base64_encode($list->topic_id)) }}" onclick="return confirm('Are you sure you want to delete this record?')"><i class="fa fa-trash"></i></a>
                      
                    </td>
                    <td>
                      
                      <a href="{{ url('/admin/subtopiclist1/') }}/{{ base64_encode($list->course_id) }}/{{ base64_encode($list->topic_id) }}" class="btn btn-success" id="myBtn-{{ $i }}" onclick="addTheory('{{ $i }}')">Add Chapters</a>
                    </td>
                  </tr>
                     <?php $i++; ?>

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



<script>

   $(document).on("change", ".toggle-class", function() {
    var status = $(this).prop('checked') == true ? 1 : 0; 
    var topic_id = $(this).data('id'); 
    $.ajax({
      type: "post",
      dataType: "json",
      url: "<?php echo url('/admin/topic_status'); ?>",
      data: {'status': status, 'topic_id': topic_id},
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
});

</script>
@stop








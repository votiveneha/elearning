@extends('admin.layouts.layout')
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Course Management</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Course List</li>
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
                <h3 class="card-title">Course List</h3>
                <div style="float:right; margin-right:10px; margin-top:10px;">
                  <a href="{{ url('/admin/course-form') }}" class="btn btn-primary" style="color:#FFFFFF"> Add New Course</a>
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
                    <div id="result" class="box" style="display:none">
        <!-- Event result: -->
    </div>
                <table id="course_list" class="table table-bordered table-striped display">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Description</th>
                    <th>Subscription</th>
                    <th>Status</th>
                    
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody id="courseBodyContents">
                  <?php $i=1; ?>
                  @foreach ($course_list as $list)
                  <tr class="tableRow" data-course_id="{{ $list->course_id }}">
                    <td class="serial-number"> {{ $i }}</td>
                    <td>{{ $list->title}}</td>
                    <td>
                     <?php


                     if(!empty($list->course_img)){?>
                     <img class="img-responsive" src="{{ url('/public/uploads/courses') }}/{{$list->course_img}}" width="100px;" alt="course_img">
                     <?php }else{?>
                      <img class="img-responsive" src="{{ url('/public') }}/assets/img/student_default.png" width="50px;" alt="profile_img">
                     <?php }?>
</td>
                    <?php $description = strip_tags($list->description);
  $description = str_replace("\r\n", "", $description);  // Remove newline characters

                    ?>
                   
                    <td>{{str_replace('&nbsp;', '', $description)}}</td>
                    <td>
                      @if($list->subscription_type == NULL)
                        Free
                      @else
                      {{ $list->subscription_type }}
                      @endif
                    </td>
                     <td>
                    <input data-id="{{$list->course_id}}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $list->status ? 'checked' : '' }}>
                    </td>
                    
                    <td>

                      <!-- <a href="{{ route('course.view', base64_encode($list->course_id)) }}"><i class="fa fa-eye"></i></a> -->

                    <a href="{{ route('course.edit', base64_encode($list->course_id)) }}"><i class="fa fa-edit"></i></a>
                      
                      <a title="Delete User" href="{{ route('course.delete', base64_encode($list->course_id)) }}" onclick="return confirm('Are you sure you want to delete this record?')"><i class="fa fa-trash"></i></a>
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



<!-- DATA TABES SCRIPT -->
  
<!--Export table button CSS-->



<script>

   $('.toggle-class').on("change", function() {
    var status = $(this).prop('checked') == true ? 1 : 0; 
    var course_id = $(this).data('id'); 
    $.ajax({
      type: "POST",
      dataType: "json",
      url: "<?php echo url('/admin/course_status'); ?>",
      data: {'status': status, 'course_id': course_id},
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








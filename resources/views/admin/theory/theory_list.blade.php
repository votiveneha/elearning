@extends('admin.layouts.layout')
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Theory Management</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Theory List</li>
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
                <div style="float:right; margin-right:10px; margin-top:10px;">
                  <a href="{{ url('/admin/theory-form') }}" class="btn btn-primary" style="color:#FFFFFF"> Add New Theory</a>
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
                <table id="theory_list" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Course</th>
                    <th>Topic</th>
                    <th>Chapter</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody id="">
                  @foreach ($theory_list as $list)
                  <tr class="" data-course_id="{{ $list->theory_id }}">
                    <td> {{ $loop->iteration }}</td>
                    <td>{{ $list->title}}</td>
                    <td>
                        {{$list->course_title}}
                    </td>

                    <td>
                        {{$list->topic_title}}

                    </td>
                     <td>
                         {{$list->subtopic_title}}
                    </td>

                     <td>
                    <input data-id="{{$list->theory_id}}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $list->status ? 'checked' : '' }}>
                    </td>
                    <td>

                      <!-- <a href="{{ route('course.view', base64_encode($list->course_id)) }}"><i class="fa fa-eye"></i></a> -->

                    <a href="{{ route('theory.edit', base64_encode($list->theory_id)) }}"><i class="fa fa-edit"></i></a>
                      
                      <a title="Delete Theory" href="{{ route('theory.delete', base64_encode($list->theory_id)) }}" onclick="return confirm('Are you sure you want to delete this record?')"><i class="fa fa-trash"></i></a>
                    </td>
                  </tr>
                  
                  
                 
                 
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



<script type="text/javascript">
        $(document).ready(function() {
     $('#theory_list').DataTable({
                        dom: 'Bfrtip',
                        responsive :true,
                        buttons: [
                             'csv', 'excel'
                        ]
                    });
});

 
</script>
<script>

   $('.toggle-class').on("change", function() {
    var status = $(this).prop('checked') == true ? 1 : 0; 
    var theory_id = $(this).data('id'); 
    $.ajax({
      type: "POST",
      dataType: "json",
      url: "<?php echo url('/admin/theory_status'); ?>",
      data: {'status': status, 'theory_id': theory_id},
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








@extends('admin.layouts.layout')
@section('title', 'Student List')
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
            <h1>Student Management</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Student List</li>
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
          

            <div class="card table-responsive">
              <div class="card-header">
                <h3 class="card-title">Student List</h3>
                <div style="float:right; margin-right:10px; margin-top:10px;">
                  <a href="{{ url('/admin/student-form') }}" class="btn btn-primary" style="color:#FFFFFF"> Add New Student</a>
                </div>
              </div>

              <!-- /.card-header -->
              <div class="card-body table-responsive">
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
                <table id="student_list" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php $i=1; ?>
                  @foreach ($student_list as $list)

                  <tr>
                    <td>{{$i}}</td>
                    <td>{{ $list->name }} </td>
                    <td>{{$list->email}}</td>
                     <td>
                    <input data-id="{{$list->id}}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $list->status ? 'checked' : '' }}>
                    </td>
                    
                    <td>
                      <a href="{{ route('student.view', base64_encode($list->id)) }}"><i class="fa fa-eye"></i></a>

                      <a href="{{ url('/admin/student-form/') }}/{{ base64_encode($list->id) }}"><i class="fa fa-edit"></i></a>
                      <a href="{{ route('student.delete', base64_encode($list->id)) }}" onclick="return confirm('Are you sure you want to delete this record?')"><i class="fa fa-trash"></i></a>
                    </td>
                  </tr>
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


@endsection




@section('js_bottom')






<!-- Bootstrap -->

<script src="{{ url('/') }}/public/design/admin/js/bootstrap.min.js" type="text/javascript"></script>

<!-- DATA TABES SCRIPT -->
<script src="https://jqueryvalidation.org/files/dist/jquery.validate.min.js"></script>



   
<!--Export table button CSS-->


<script>

   $('.toggle-class').on("change", function() {
    var status = $(this).prop('checked') == true ? 1 : 0; 
    var id = $(this).data('id'); 
    $.ajax({
      type: "POST",
      dataType: "json",
      url: "<?php echo url('/student/student_status'); ?>",
      data: {'status': status, 'id': id},
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



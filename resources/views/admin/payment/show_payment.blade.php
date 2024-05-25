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

            <h1>Payment Management</h1>

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

                <h3 class="card-title">Payment List</h3>

                

              </div>



              <!-- /.card-header -->

              <div class="card-body">

                 

                <div class="table-responsive">

                <table id="question_list1" class="table table-bordered table-striped">

                  <thead>

                  <tr>

                    <th>ID</th>

                    <th>Customer Name</th>

                    <th>Customer Email</th>

                    <th>Plan Name</th>

                    <th>Amount</th>

                    
                    <th>Plan Status</th>
                    

                    <!-- <th>Status</th> -->

                    <!-- <th>Action</th> -->

                  </tr>

                  </thead>

                  <tbody id="questionBodyContents">

                  <?php $i=1; ?>

                  @foreach ($payments as $list)

                  

                  <tr class="tableRow" data-question_id="{{ $list->payment_id }}">

                    <td class="serial-number"> {{ $i }}</td>

                    

                    <td>

                      <?php

                        

                        




                        

                        echo $list->customer_name;

                        //print_r($product);

                      ?>

                    </td>

                    <td>{{ $list->customer_email }}</td>

                    <td>
                      @if($list->plan_name == "1 month")
                        Monthly Subscription
                      @endif
                      @if($list->plan_name == "6 month")
                        Bi-annual Subscription
                      @endif
                      @if($list->plan_name == "1 year")
                        Annual Subscription
                      @endif
                    </td>

                    <td>${{ $list->amount }}</td>

                    

                    <td>{{ $list->payment_status }}</td>
                    <!-- <td>

                      <input data-id="{{$list->payment_id}}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $list->status ? 'checked' : '' }}>

                    </td> -->

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

    var payment_id = $(this).data('id');



    $.ajax({

      type: "Post",

      dataType: "json",

      url: "<?php echo url('/admin/payment_status'); ?>",

      data: {'status': status, 'payment_id': question_id},

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
















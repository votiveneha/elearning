@extends('admin.layouts.layout')

@section('content')

<div class="wrapper">


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Student View</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Student View</li>
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
        <!--   <div class="card-header">
            <h3 class="card-title">Add Student</h3>
          </div> -->
          <!-- /.card-header -->
          <div class="card-body">
            <form action="{{ url('/admin/student_action') }}" id="student_form" method="post">
                      {!! csrf_field() !!}
                       <input type="hidden" class="form-control" name="id" value="{{$id}}">

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>First Name</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                    </div>
                    <input type="text" class="form-control" name="fname" required="required" 
                    value="@if($id>0){{trim($student_detail[0]->name)}}@endif" disabled>
                  </div>
                  <!-- /.input group -->
                </div>
              </div>
                <!-- /.form-group -->
           
              <!-- /.col -->
              <div class="col-md-6">
                <div class="form-group">
                  <label>Last Name</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                    </div>
                    <input type="text" class="form-control" name="lname" required="required"
                    value="@if($id>0){{trim($student_detail[0]->last_name)}}@endif" disabled>
                  </div>
                  <!-- /.input group -->
                </div>
              </div>
                <!-- /.form-group -->
                              <div class="col-md-6">

               <div class="form-group">
                  <label>Email</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                    </div>
                    <input type="text" class="form-control" name="email" required="required"
                    value="@if($id>0){{trim($student_detail[0]->email)}}@endif" disabled>
                    <br>
                      @if($errors->has("email"))

                      <span class="text-danger">{{ $errors->first("email") }}</span>

                      @endif
                  </div>
                  <!-- /.input group -->
                </div>
              </div>
                            <div class="col-md-6">

                 <div class="form-group">
                  <label>Profile Image</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                    </div>
                     <?php if(!empty($student_detail[0]->profile_img)){?>
                     <img class="img-responsive" src="{{ url('/public') }}/assets/img/{{$student_detail[0]->profile_img}}" width="50px;" alt="profile_img">
                     <?php }else{?>
                      <img class="img-responsive" src="{{ url('/public') }}/assets/img/student_default.png" width="50px;" alt="profile_img">
                     <?php }?>

                    <br>
                    
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->

       
              <div class="row">
             
              <!-- /.col -->
              <div class="col-md-6">
               <!--  <div class="form-group">
                  <label>Password</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                    </div>
                    <input type="password" class="form-control" name="password"  required="required">
                       @if($errors->has('password'))
                           <div class="text-danger">{{ $errors->first('password') }}</div>
                        @endif
                  </div> -->
                  <!-- /.input group -->
                <!-- </div> -->
             
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
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

<script src="{{ url('/') }}/design/admin/plugins/jquery/jquery.min.js"></script>
<script src="{{ url('/') }}/design/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="{{ url('/') }}/design/admin/plugins/select2/js/select2.full.min.js"></script>
<script src="{{ url('/') }}/design/admin/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
<script src="{{ url('/') }}/design/admin/plugins/moment/moment.min.js"></script>
<script src="{{ url('/') }}/design/admin/plugins/inputmask/jquery.inputmask.min.js"></script>
<script src="{{ url('/') }}/design/admin/plugins/daterangepicker/daterangepicker.js"></script>
<script src="{{ url('/') }}/design/admin/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<script src="{{ url('/') }}/design/admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<script src="{{ url('/') }}/design/admin/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<script src="{{ url('/') }}/design/admin/plugins/bs-stepper/js/bs-stepper.min.js"></script>
<script src="{{ url('/') }}/design/admin/plugins/dropzone/min/dropzone.min.js"></script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date picker
    $('#reservationdate').datetimepicker({
        format: 'L'
    });

    //Date and time picker
    $('#reservationdatetime').datetimepicker({ icons: { time: 'far fa-clock' } });

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({
      timePicker: true,
      timePickerIncrement: 30,
      locale: {
        format: 'MM/DD/YYYY hh:mm A'
      }
    })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Timepicker
    $('#timepicker').datetimepicker({
      format: 'LT'
    })

    //Bootstrap Duallistbox
    $('.duallistbox').bootstrapDualListbox()

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    $('.my-colorpicker2').on('colorpickerChange', function(event) {
      $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
    })

    $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    })

  })
  // BS-Stepper Init
  document.addEventListener('DOMContentLoaded', function () {
    window.stepper = new Stepper(document.querySelector('.bs-stepper'))
  })

  // DropzoneJS Demo Code Start
  Dropzone.autoDiscover = false

  // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
  var previewNode = document.querySelector("#template")
  previewNode.id = ""
  var previewTemplate = previewNode.parentNode.innerHTML
  previewNode.parentNode.removeChild(previewNode)

  var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
    url: "/target-url", // Set the url
    thumbnailWidth: 80,
    thumbnailHeight: 80,
    parallelUploads: 20,
    previewTemplate: previewTemplate,
    autoQueue: false, // Make sure the files aren't queued until manually added
    previewsContainer: "#previews", // Define the container to display the previews
    clickable: ".fileinput-button" // Define the element that should be used as click trigger to select files.
  })

  myDropzone.on("addedfile", function(file) {
    // Hookup the start button
    file.previewElement.querySelector(".start").onclick = function() { myDropzone.enqueueFile(file) }
  })

  // Update the total progress bar
  myDropzone.on("totaluploadprogress", function(progress) {
    document.querySelector("#total-progress .progress-bar").style.width = progress + "%"
  })

  myDropzone.on("sending", function(file) {
    // Show the total progress bar when upload starts
    document.querySelector("#total-progress").style.opacity = "1"
    // And disable the start button
    file.previewElement.querySelector(".start").setAttribute("disabled", "disabled")
  })

  // Hide the total progress bar when nothing's uploading anymore
  myDropzone.on("queuecomplete", function(progress) {
    document.querySelector("#total-progress").style.opacity = "0"
  })

  // Setup the buttons for all transfers
  // The "add files" button doesn't need to be setup because the config
  // `clickable` has already been specified.
  document.querySelector("#actions .start").onclick = function() {
    myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED))
  }
  document.querySelector("#actions .cancel").onclick = function() {
    myDropzone.removeAllFiles(true)
  }
  // DropzoneJS Demo Code End
</script>
<script type="text/javascript">

    function check_valid()



  {



    jQuery.validator.addMethod("pass", function (value, element) {



      if (/(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}/.test(value)) {



        return true;



      } else {



        return false;



      };



    });





    jQuery.validator.addMethod("vname", function (value, element) {



      if (/^[a-zA-Z][a-z\s]*$/.test(value)) {



        return true;



      } else {



        return false;



      };



    });



    // jQuery.validator.addMethod("add", function (value, element) {



    //  if (/^[a-zA-Z][a-z\s]*$/.test(value)) {



    //    return true;



    //  } else {



    //    return false;



    //  };



    // });




    jQuery.validator.addMethod("lname", function (value, element) {



      if (/^[a-zA-Z][a-z\s]*$/.test(value)) {



        return true;



      } else {



        return false;



      };



    });



    var form = $("#student_form");

    form.validate({

      rules: {

        name:{

          required:true,

          vname:true

        },

        lname: {

          required: true,

          lname:true

        },

        user_mob: {


          //required: true,



          //minlength:10,



          //maxlength:10



        },



        email: {



          required: true,



          email:true



        },



        password: {



          required: false,



          minlength:8,



          pass:false,



        },



        confirmpassword: {



          required: false,



          minlength:8,



          equalTo : "#password",



        },



        user_address: {



          required: true,



        },



        state: {



          required: false,



        },



        city: {



          required: false,



        },



        zipcode: {



          required: false,



        }



      },



      messages: {



        name:{



          required:'Please enter name.',



          vname:"Please enter only letters."



        },



        lname: {



          required:'Please enter last name.',



          lname:'Please enter only letters.'



        },



        user_mob: {



          required:'Please enter mobile number.',



          minlength:'Please enter valid mobile number.',



          maxlength:'Please enter valid mobile number.'



        },



        email: {



          required:'Please enter email address.',



          email:'Please enter an valid email address.',



        },



        password: {



          required:'Please enter password.',



          minlength:'Password must be at least 8 characters.',



          pass:"at least one number, one lowercase and one uppercase letter.",



        },



        confirmpassword: {



          required:'Please enter confirm password.',



          minlength:'Password must be at least 8 characters.',



          equalTo:'confirm password and password should be same, please enter correct.'



        },



        user_address: {



          required:'Please enter postal address.',



        },



        state: {



          required:'Please enter state.',



        },



        city: {



          required:'Please enter city name.',



        },



        zipcode: {



          required:'Please enter zipcoad.',



        }



      }



    });



    var valid = form.valid();



    if(valid){



      // var dummy1 = $('#dummy1').val();



      // var dummy2 = $('#dummy2').val();



      // var dummy3 = $('#dummy3').val();



      // var dummy_counter = 0;



      // if((dummy1==0) && (dummy2==0) && (dummy3==0))



      // {



      //  dummy_counter = 1;



      // }



      // else



      // {



      //  if( (dummy1==0) || (dummy2==0) || (dummy3==0) )



      //  {



      //    alert('Default user not match with other User , So Please select only default user or  different user!');



      //    dummy_counter = 0;



      //  }



      //  else if( (dummy1==dummy2) || (dummy2==dummy3) || (dummy1==dummy3) )



      //  {



      //    alert('User can not be same, So Please select different user!');



      //    dummy_counter = 0;



      //  }



      //  else



      //  {



      //    dummy_counter = 1;



      //  }



      // }



      // if(dummy_counter==1)



      // {



        var frm_val = $('#user_frm').serialize();



        $(form).submit();



      // }



      // else



      // {



      //  return false;



      // }



        /*var frm_val = $('#user_frm').serialize();



        $(form).submit();*/



      }



      else



      {



        return false;



      }



    }



  </script>

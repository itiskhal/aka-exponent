<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="shortcut icon" href="assets/images/final-128x68.png" type="image/x-icon">
  <title>Signup Page</title>
  
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
 
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  
  <link rel="stylesheet" href="dist/css/skins/skin-blue.min.css">

  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

<!-- iCheck for checkboxes and radio inputs -->
<link rel="stylesheet" href="plugins/iCheck/all.css">

<!-- Select2 -->
<link rel="stylesheet" href="bower_components/select2/dist/css/select2.min.css">
</head>

<body class="hold-transition layout-top-nav skin-blue sidebar-mini">
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">
    
    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top">
      
      <!-- Navbar Right Menu -->
      <div class="container-fluid">
        <div class="navbar-header">
          <a href="index.html" class="navbar-brand"><b>A.K.A EXPONENT</b></a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>
        <ul class="nav navbar-nav navbar-right">
          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="index.html">
              <span class="hidden-xs"><b>Home</b></span>
            </a>
          </li>
          
        </ul>
      </div>
    </nav>
  </header>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        User Registration
        <small>Please read the terms and conditions below and enter the details to register</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
    
    <div class="box box-primary">
        <div class="box-body">
        We take your privacy very seriously and we encourage you to review this policy.
        <br/><br/>
        Information collected: We may collect and process the following personal data about You:
        <ul>
          <li>
            Information that You provide by filling in forms on this Site. This includes information provided at the time of registering to use this Site, subscribing to Our services/products, posting material or requesting further services/products. We may also ask You for information when You report a problem with Our site.
          </li>
          <li>
            If You contact Us, We may keep a record of that correspondence.
          </li>
          <li>
            When you take tests we may keep a record of your answers in order to make them available for you in the form of test history.
          </li>
          <li>
            We may also ask You to complete surveys that We use for research purposes, although You do not have to respond to them.
          </li>
          <li>
            Details of Your visits to our Site and the resources that You access:
            <ul>
              <li>
                IP addresses: We may collect information about Your computer, including where available Your IP address, operating system and browser type, for system administration and to report aggregate information to Our advertisers. This is statistical data about Our users’ browsing actions and patterns, and does not identify any individual.
              </li>
              <li>
                Cookies: Our website uses cookies to distinguish You from other users of the Site. This helps Us to provide You with a good experience when You browse the Site and also allows Us to improve our Site. For detailed information on the cookies We use and the purposes for which We use them, see Our Cookie Policy.
              </li>
            </ul>
          </li>
        </ul>
        </div><!-- /.box-body -->
    </div><!-- /.box -->
    <div class="box box-primary">
    <form role="form" action="signs.php" onSubmit="return validateForm()" method="POST">
              <div class="box-body">

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                    <label>Full Name</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input id="name" name="name" type="text" class="form-control" placeholder="Please enter your full name" required>
                    </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <label>DOB (yyyy/mm/dd)</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input id="dob" name="dob" type="text" class="form-control" data-inputmask="'alias': 'yyyy/mm/dd'" data-mask placeholder="yyyy/mm/dd" required>
                    </div>
                  </div>
              </div>
              
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                        <label>Gender</label>
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa  fa-group"></i></span>
                            <select class="form-control" id="gender" name="gender">
                              <option>Not Disclosed</option>
                              <option>Male</option>
                              <option>Female</option>
                            </select>
                        </div>
                  </div>
                </div>
                <div class="col-md-6">  
                  <div class="form-group">
                      <label>School / College Name</label>
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa  fa-graduation-cap"></i></span>
                        <input id="college" name="college" type="text" class="form-control" placeholder="Please enter your school/college name" required>
                      </div>
                    </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                        <input id="email" name="email" type="email" class="form-control" placeholder="Email">
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Contact Number (Enter 10 digits mobile number)</label>
        
                        <div class="input-group">
                          <div class="input-group-addon">
                            <i class="fa fa-phone"></i>
                          </div>
                          <input id="contact" name="contact" type="number" class="form-control" placeholder="9999999999" required>
                        </div>
                        <!-- /.input group -->
                      </div>
                </div>
              </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputPassword1">Password</label>
                      <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                          <input id="password" name="password" type="password" class="form-control" placeholder="Password" required>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputPassword2">Please re-enter the Password</label>
                      <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                          <input id="cpassword" name="cpassword" type="password" class="form-control" placeholder="Re-Enter Password" required>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" required> I accept the Terms and Conditions mentioned. <br/>By signing up, you agree to our Terms and Conditions mentioned. We take looking after your data very seriously and recommend you review our Data Policy. You may receive communications from us and can opt out at any time.
                    <br>
                  </label>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
              
            </form>
    </section>
  </div>
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- Default to the left -->
    <strong>&copy; Copyright 2019 A.K.A Exponent -&nbsp;</strong> All rights reserved
  </footer>

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Select2 -->
<script src="bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- InputMask -->
<script src="plugins/input-mask/jquery.inputmask.js"></script>
<script src="plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- date-range-picker -->
<script src="bower_components/moment/min/moment.min.js"></script>
<script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- bootstrap datepicker -->
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- bootstrap color picker -->
<script src="bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
<!-- bootstrap time picker -->
<script src="plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- SlimScroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="plugins/iCheck/icheck.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- Page script -->
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A' })
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
        $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    })

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass   : 'iradio_minimal-red'
    })
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    //Timepicker
    $('.timepicker').timepicker({
      showInputs: false
    })
  })
</script>

</body>
</html>
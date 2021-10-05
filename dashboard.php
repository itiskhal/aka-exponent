<?php
include_once 'dbConnection.php';
session_start();
$email=$_SESSION['email'];
$name = $_SESSION['name'];
$uid = $_SESSION['uid'];
$usertype = $_SESSION['usertype'];
if(!(isset($_SESSION['email']))){
header("location:login.php");
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="shortcut icon" href="assets/images/final-128x68.png" type="image/x-icon">
  <title>Dashboard</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="bower_components/morris.js/morris.css">
  <link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css">
  <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <script src="./ckeditor/ckeditor.js"></script>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<script>
	CKEDITOR.replace( 'editor1', {
	
		toolbar: [
			{ name: 'document', items: [ 'Print' ] },
			{ name: 'clipboard', items: [ 'Undo', 'Redo' ] },
			{ name: 'styles', items: [ 'Format', 'Font', 'FontSize' ] },
			{ name: 'basicstyles', items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'RemoveFormat', 'CopyFormatting' ] },
			{ name: 'colors', items: [ 'TextColor', 'BGColor' ] },
			{ name: 'align', items: [ 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock' ] },
			{ name: 'links', items: [ 'Link', 'Unlink' ] },
			{ name: 'paragraph', items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote' ] },
			{ name: 'insert', items: [ 'Image', 'Table' ] },
			{ name: 'tools', items: [ 'Maximize' ] },
			{ name: 'editing', items: [ 'Scayt' ] }
		],
		
		customConfig: '',
		
		disallowedContent: 'img{width,height,float}',
		extraAllowedContent: 'img[width,height,align]',
		// Enabling extra plugins, available in the full-all preset: http://ckeditor.com/presets-all
		extraPlugins: 'tableresize,uploadimage,uploadfile',
		
		height: 800,
		// An array of stylesheets to style the WYSIWYG area.
		// Note: it is recommended to keep your own styles in a separate file in order to make future updates painless.
		contentsCss: [ 'https://cdn.ckeditor.com/4.8.0/full-all/contents.css', 'mystyles.css' ],
		// This is optional, but will let us define multiple different styles for multiple editors using the same CSS file.
		bodyClass: 'document-editor',
		// Reduce the list of block elements listed in the Format dropdown to the most commonly used.
		format_tags: 'p;h1;h2;h3;pre',
		// Simplify the Image and Link dialog windows. The "Advanced" tab is not needed in most cases.
		removeDialogTabs: 'image:advanced;link:advanced',
		
		stylesSet: [
			/* Inline Styles */
			{ name: 'Marker', element: 'span', attributes: { 'class': 'marker' } },
			{ name: 'Cited Work', element: 'cite' },
			{ name: 'Inline Quotation', element: 'q' },
			/* Object Styles */
			{
				name: 'Special Container',
				element: 'div',
				styles: {
					padding: '5px 10px',
					background: '#eee',
					border: '1px solid #ccc'
				}
			},
			{
				name: 'Compact table',
				element: 'table',
				attributes: {
					cellpadding: '5',
					cellspacing: '0',
					border: '1',
					bordercolor: '#ccc'
				},
				styles: {
					'border-collapse': 'collapse'
				}
			},
			{ name: 'Borderless Table', element: 'table', styles: { 'border-style': 'hidden', 'background-color': '#E6E6FA' } },
			{ name: 'Square Bulleted List', element: 'ul', styles: { 'list-style-type': 'square' } }
		]
	} );
</script>
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="#" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A.K.A</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>A.K.A Exponent</b></span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          
          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              <img src="dist/img/default-50x50.jpg" class="user-image" alt="User Image">
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs"> <?php echo $name; ?> </span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
                <img src="dist/img/default-50x50.jpg" class="img-circle" alt="User Image">
                <p>
                  <?php echo $name; 
                    if($usertype==2)  echo'<small>Student Account</small>';  
                    else if($usertype==1)  echo'<small>Admin Account</small>';  
                    else echo'<small>Student Account</small>';  
                  ?>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="dashboard.php?q=5" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="logout.php" class="btn btn-default btn-flat">Logout</a>
                </div>
              </li>
            </ul>
          </li>
          
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

<!-- Sidebar user panel (optional) -->
<div class="user-panel">
  <div class="pull-left image">
    <img src="dist/img/default-50x50.jpg" class="img-circle" alt="User Image">
  </div>
  <div class="pull-left info">
    <p> <?php echo $name; ?></p>
    <!-- Status -->
    <?php
      if($usertype==2)
        echo'<a href="#">Student Account</a>';
      else if($usertype==1)
        echo'<a href="#">Administrator Account</a>';
      else
        echo'<a href="#">Master Admin</a>';
    ?>
    
  </div>
</div>

<!-- Sidebar Menu -->
<ul class="sidebar-menu" data-widget="tree">
  <li class="header">MAIN NAVIGATION</li>
  <!-- Optionally, you can add icons to the links -->
  <li <?php if(@$_GET['q']==0) echo'class="active"'; ?>><a href="dashboard.php?q=0"><i class="fa fa-dashboard"></i> <span>DASHBOARD</span></a></li>
  <li <?php if(@$_GET['q']==10) echo'class="active"'; ?>><a href="dashboard.php?q=10"><i class="fa fa-bars"></i> <span>ALL TESTS</span></a></li>
 
  <?php if($usertype==0 or $usertype==1)
    echo  '<li><a href="dashboard.php?q=1"><i class="fa fa-briefcase"></i> <span>ADD TEST</span></a></li>';
  ?>

  <?php if($usertype==0 or $usertype==1)
    echo '<li><a href="dashboard.php?q=2"><i class="fa fa-calendar-plus-o"></i> <span>TEST CONTROLS</span></a></li>';        
  ?>

  <?php if($usertype==0 or $usertype==1)
    echo '<li><a href="dashboard.php?q=3"><i class="fa fa-newspaper-o"></i> <span>USER CONTROLS</span></a></li>';
  ?>

  <li  <?php if(@$_GET['q']==4) echo'class="active"'; ?>><a href="dashboard.php?q=4"><i class="fa fa-trophy"></i> <span>LEADERBOARD</span></a></li>       
  <li class="header"></li>
  <li  <?php if(@$_GET['q']==5) echo'class="active"'; ?>><a href="dashboard.php?q=5"><i class="fa fa-user"></i> <span>MY PROFILE</span></a></li>
  <li  <?php if(@$_GET['q']==7) echo'class="active"'; ?>><a href="dashboard.php?q=7"><i class="fa fa-key"></i> <span>CHANGE PASSWORD</span></a></li>
  <li><a href="logout.php"><i class="fa fa-sign-out"></i> <span>LOGOUT</span></a></li>        
</ul>
<!-- /.sidebar-menu -->
</section>
<!-- /.sidebar -->
  </aside>

  <div class="content-wrapper">
    <section class="content-header">
      
      <?php
        if(@$_GET['q']==0)
          echo '<h1>Welcome&nbsp;'.$name.'<small>&nbsp;Your Dashboard</small></h1>
            <ol class="breadcrumb">
              <li class="active"><a href="dashboard.php?q=0"><i class="fa fa-dashboard"></i> Home</a></li>
            </ol>';
        else if(@$_GET['q']==1 AND ($usertype==0 OR $usertype==1))
          echo '<h1>Add Test</h1>
            <ol class="breadcrumb">
              <li class="active"><a href="dashboard.php?q=0"><i class="fa fa-dashboard"></i> Home</a></li>
              <li class="active"><a href="dashboard.php?q=1"><i class="fa fa-dashboard"></i> Add Test</a></li>
            </ol>';
        else if(@$_GET['q']==10)
          echo '<h1>All Tests</h1>
            <ol class="breadcrumb">
              <li class="active"><a href="dashboard.php?q=0"><i class="fa fa-dashboard"></i> Home</a></li>
              <li class="active"><a href="dashboard.php?q=10"><i class="fa fa-dashboard"></i> All Tests</a></li>
            </ol>';
        else if(@$_GET['q']==2 AND ($usertype==0 OR $usertype==1))
          echo '<h1>Test Controls</h1>
            <ol class="breadcrumb">
              <li class="active"><a href="dashboard.php?q=0"><i class="fa fa-dashboard"></i> Home</a></li>
              <li class="active"><a href="dashboard.php?q=2"><i class="fa fa-dashboard"></i> Test Controls</a></li>
            </ol>';
        else if(@$_GET['q']==3 AND ($usertype==0 OR $usertype==1))
          echo '<h1>User Controls</h1>
            <ol class="breadcrumb">
              <li class="active"><a href="dashboard.php?q=0"><i class="fa fa-dashboard"></i> Home</a></li>
              <li class="active"><a href="dashboard.php?q=3"><i class="fa fa-dashboard"></i> User Controls</a></li>
            </ol>';
        else if(@$_GET['q']==4)
          echo '<h1>Leaderboard</h1>
            <ol class="breadcrumb">
              <li class="active"><a href="dashboard.php?q=0"><i class="fa fa-dashboard"></i> Home</a></li>
              <li class="active"><a href="dashboard.php?q=4"><i class="fa fa-dashboard"></i> Leaderboard</a></li>
            </ol>';
        else if(@$_GET['q']==5)
          echo '<h1>My Profile</h1>
            <ol class="breadcrumb">
              <li class="active"><a href="dashboard.php?q=0"><i class="fa fa-dashboard"></i> Home</a></li>
              <li class="active"><a href="dashboard.php?q=5"><i class="fa fa-dashboard"></i> My Profile</a></li>
            </ol>';
        else if(@$_GET['q']==7)
          echo '<h1>Change Password</h1>
            <ol class="breadcrumb">
              <li class="active"><a href="dashboard.php?q=0"><i class="fa fa-dashboard"></i> Home</a></li>
              <li class="active"><a href="dashboard.php?q=7"><i class="fa fa-dashboard"></i> Change Password</a></li>
            </ol>';
        else if(@$_GET['q']==12)
          echo '<h1>Enter Questions</h1>';
        else if(@$_GET['q']==11)
          echo '<h1>Test Instructions</h1>';
        else if(@$_GET['q']==13)
          echo '<h1>Edit test</h1>';
        else echo '<h1>Welcome</h1>';    
      ?>
    </section>

    <section class="content">
        <?php 

        if(@$_GET['q']==0) { 
          echo  '
            <div class="row">
              <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-aqua">
                  <div class="inner">
                    <h3><i class="ion ion-person"></i></h3>
                    <p>My Profile</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-person"></i>
                  </div>
                  <a href="dashboard.php?q=5" class="small-box-footer">Click for more info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-green">
                  <div class="inner">
                    <h3><i class="ion ion-clipboard"></i></h3>
                    <p>All Tests</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-clipboard"></i>
                  </div>
                  <a href="dashboard.php?q=10" class="small-box-footer">Click for more info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div>';
              if($usertype==0 or $usertype==1)
              echo '<div class="col-lg-3 col-xs-6">
                <div class="small-box bg-purple">
                  <div class="inner">
                    <h3><i class="ion ion-person-add"></i></h3>
                    <p>User Controls</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-person-add"></i>
                  </div>
                  <a href="dashboard.php?q=3" class="small-box-footer">Click for more info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div>

              <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-yellow">
                  <div class="inner">
                    <h3><i class="ion ion-ios-plus-outline"></i></h3>
                    <p>Add Test</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-ios-plus-outline"></i>
                  </div>
                  <a href="dashboard.php?q=1" class="small-box-footer">Click for more info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div>
              </div>
              <div class="row">
              <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-red">
                  <div class="inner">
                    <h3><i class="ion ion-ios-gear"></i></h3>
                    <p>Test Controls</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-ios-gear"></i>
                  </div>
                  <a href="dashboard.php?q=2" class="small-box-footer">Click for more info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              
            </div>';
            echo 
            '
            <div class="col-lg-3 col-xs-6">
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h3><i class="ion ion-trophy"></i></h3>
                  <p>Leaderboard</p>
                </div>
                <div class="icon">
                  <i class="ion ion-trophy"></i>
                </div>
                <a href="dashboard.php?q=4" class="small-box-footer">Click for more info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>

            <div class="col-lg-3 col-xs-6">
              <div class="small-box bg-blue">
                <div class="inner">
                  <h3><i class="ion ion-key"></i></h3>
                  <p>Change Password</p>
                </div>
                <div class="icon">
                  <i class="ion ion-key"></i>
                </div>
                <a href="dashboard.php?q=7" class="small-box-footer">Click for more info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
            
          </div>
          ';
        }

        if(@$_GET['q']==10) {
          $result = mysqli_query($con,"SELECT * FROM tests ORDER BY date DESC") or die('Error');
          echo  '<div class="panel"><div class="table-responsive"><table id="example1" class="table table-bordered table-striped">
          <thead><tr><th><b>S.N.</b></th><th><b>Topic</b></th><th><b>Category</b></th><th><b>Total questions</b></th><th><b>Marks for right answer</b></th><th><b>Marks deducted for wrong answer</b></th><th><b>Total Marks</b></th><th><b>Time Limit</b></th><th><b>Test Status</b></th></tr></thead>
          ';
          $c=1;
          echo '<tbody>';
          while($row = mysqli_fetch_array($result)) {
            $title = $row['title'];
            $total = $row['totalquestions'];
            $rights = $row['rightmarks'];
            $wrongs = $row['wrongmarks'];
            $time = $row['duration'];
            $tid = $row['tid'];
            $teststatus = $row['teststatus'];
            $testcategory = $row['category'];
            $q12=mysqli_query($con,"SELECT score FROM history WHERE tid='$tid' AND uid='$uid'" )or die('Error98');
            $rowcount=mysqli_num_rows($q12);
           
              echo '<tr><td>'.$c++.'</td><td>'.$title.'</td><td>'.$testcategory.'</td><td>'.$total.'</td><td>'.$rights.'</td><td>'.$wrongs.'</td><td>'.$rights*$total.'</td><td>'.$time.'&nbsp;min</td>                
              <td>';
                if($rowcount == 0 AND $teststatus == 1){
                echo '<button type="button" class="btn btn-block btn-success btn-xs" onclick="window.open(`dashboard.php?q=11&t='.$total.'&uid='.$uid.'&step=2&tid='.$tid.'`,`_self`);">Start Test</button>';
                }
                else if($rowcount == 0 AND $teststatus == 0){
                  echo '<button type="button" class="btn btn-block btn-success btn-xs disabled">Start Test</button>';
                }
                else{
                  echo '<button type="button" class="btn btn-block btn-primary btn-xs" onclick="window.open(`result.php?uid='.$uid.'&tid='.$tid.'`,`Test Window`,`toolbar=false,menubar=false,scrollbars=yes,location=0,height=768,width=700`)">View Result</button>';
                }              
              echo'</td></tr>';
            
            }
            $c=0;
            echo '<tbody></table></div></div>';
        }

        if(@$_GET['q']=='11') {
          $total=@$_GET['total'];
          $uid=@$_GET['uid'];
          $tid=@$_GET['tid'];      
          echo '
              <div class="panel">
                <div>&nbsp;</div>
                <ul>
                <li>All questions are of multiple choice and there can be only one right answer</li>
                <li>The test cannot be paused or saved to complete later</li>
                <li>Use of calculators is not recommended as the intention of the test is to learn on own and basic calculator is provided on the test page</li>
                <li>Place yourself in a peaceful and calm environment, while taking the test to keep yourself undisturbed and focused</li>
                </ul>

                <div>&nbsp;</div>              
                
                <div class="row">    
                  <div class="col-md-1">
                    <button type="button" class="btn btn-block btn-success btn-xs" onclick="window.open(`test.php?q=quiz&t='.$total.'&uid='.$uid.'&step=2&tid='.$tid.'`,`Test Window`,`toolbar=false,menubar=false,scrollbars=yes,height=768,width=1366,location=0,resizable=false`);">Start Test</button>
                  </div>
                  <div class="col-md-1">
                    <button type="button" class="btn btn-block btn-danger btn-xs" onclick="window.open(`dashboard.php?q=10`,`_self`);">Go Back</button>
                  </div>
                </div>

              </div>';
                  
                  }        
        
        if(@$_GET['q']==1 AND ($usertype==0||$usertype==1)) {
          echo '<form role="form" action="queries.php?q=addquiz&uid='.$uid.'" onSubmit="return validateForm()" method="POST">
              <div class="box-body">

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                    <label>Exam Title</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa  fa-graduation-cap"></i></span>
                        <input id="name" name="name" type="text" class="form-control" placeholder="Enter the exam title" required>
                    </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                    <label>Total Number of Questions</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa  fa-question-circle"></i></span>
                        <input id="total" name="total" type="number" class="form-control" placeholder="Enter total number of questions" required>
                    </div>
                    </div>
                  </div>
              </div>
              
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Enter marks for right answer</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-check-circle"></i></span>
                        <input id="rights" name="rights" type="number" class="form-control" placeholder="Enter marks for right answer" required>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">  
                  <div class="form-group">
                    <label>Enter negative marks for wrong answer</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa  fa-times-circle"></i></span>
                        <input id="wrong" name="wrong" type="number" class="form-control" placeholder="Enter negative marks for wrong answer without sign" required>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Enter time limit for the test in minutes</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa  fa-hourglass-1"></i></span>
                        <input id="time" name="time" type="number" class="form-control" placeholder="Enter time limit for the test in minutes" required>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Write exam description here...</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa  fa-bars"></i></span>
                        <input id="desc" name="desc" type="text" class="form-control" placeholder="Write exam description here..." required>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Enter the test category</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa  fa-hourglass-1"></i></span>
                        <input id="category" name="category" type="text" class="form-control" placeholder="Enter the test category" required>
                    </div>
                  </div>
                </div>
              </div>
              
              <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>';
        }

        if(@$_GET['q']==12 AND ($usertype==0||$usertype==1)) 
        {
          echo '<form role="form" action="queries.php?q=addqns&n='.@$_GET['n'].'&tid='.@$_GET['tid'].'" onSubmit="return validateForm()" method="POST">
              <div class="box-body">';
          for($i=1;$i<=@$_GET['n'];$i++)
            {
                echo '  <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                <label>Enter Question '.$i.'</label>
                                <textarea class="ckeditor" id="qns'.$i.'" name="qns'.$i.'" required>
                                </textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                <label>Enter the options in the following order (abc||def||ghi||jkl) </label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-fighter-jet"></i></span>
                                    <input id="choices'.$i.'" name="choices'.$i.'" type="text" class="form-control" placeholder="Enter All Options" required>
                                </div>
                                </div>
                            </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Enter the right answer</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-fighter-jet"></i></span>
                                    <input id="answer'.$i.'" name="answer'.$i.'" type="text" class="form-control" placeholder="Enter the right answer" required>
                                </div>
                            </div>
                        </div>
                        </div>
                        </br>
                ';
            }
        echo '<button type="submit" class="btn btn-primary">Submit</button>
        </div>
        </form>';
        }

        if(@$_GET['q']==13 AND ($usertype==0||$usertype==1)) 
        {
          $tid = @$_GET['tid'];
          $getQuestions = mysqli_query($con,"SELECT * FROM questions WHERE tid='$tid'") or die('Error');
          $getTestDetails = mysqli_query($con,"SELECT * FROM tests WHERE tid='$tid'") or die('Error');
          $i=1;
          echo '<div class="box-body">';
          //edit test details
          while($row = mysqli_fetch_array($getTestDetails)) {
            $title=$row['title'];
            $rightmarks=$row['rightmarks'];
            $wrongmarks=$row['wrongmarks'];
            $duration=$row['duration'];
            $description=$row['description'];
            $category=$row['category'];
            echo '<form role="form" action="queries.php?q=edittestdetails&tid='.@$_GET['tid'].'" onSubmit="return validateForm()" method="POST">
                  <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                        <label>Edit Exam Title</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa  fa-graduation-cap"></i></span>
                            <input id="name" name="name" type="text" class="form-control" value="'.$title.'" required>
                        </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                      <div class="form-group">
                        <label>Edit the test category</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa  fa-hourglass-1"></i></span>
                            <input id="category" name="category" type="text" class="form-control" value="'.$category.'" required>
                        </div>
                      </div>
                    </div>
                  </div>
                  
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Edit marks for right answer</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-check-circle"></i></span>
                            <input id="rights" name="rights" type="number" class="form-control" value="'.$rightmarks.'" required>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">  
                      <div class="form-group">
                        <label>Edit negative marks for wrong answer</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa  fa-times-circle"></i></span>
                            <input id="wrong" name="wrong" type="number" class="form-control" value="'.$wrongmarks.'" required>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Edit time limit for the test in minutes</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa  fa-hourglass-1"></i></span>
                            <input id="time" name="time" type="number" class="form-control" value="'.$duration.'" required>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Edit exam description</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa  fa-bars"></i></span>
                            <input id="desc" name="desc" type="text" class="form-control" value="'.$description.'" required>
                        </div>
                      </div>
                    </div>
                  </div>
                  
            ';
            echo '
                <input type="hidden" id="tid" name="tid" type="text" class="form-control" value="'.$tid.'" required>
                <button type="submit" class="btn btn-primary">Submit</button>
                </form>
                <br/>
                ';
          }
          echo '</div>';
          //edit questions
          echo '<div class="box-body">';
          while($row = mysqli_fetch_array($getQuestions)) {
            $qns=$row['question'];
            $qid=$row['qid'];
            $choice=$row['options'];
            $answer=$row['answer'];
            echo '<form role="form" action="queries.php?q=editqn&tid='.@$_GET['tid'].'" onSubmit="return validateForm()" method="POST">
                <div class="row">
                  <div class="col-md-12">
                      <div class="form-group">
                      <label>Edit Question '.$i.'</label>
                      <textarea class="ckeditor" id="question" name="question" required>
                        '.$qns.'
                      </textarea>
                      </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                      <div class="form-group">
                      <label>Edit the options</label>
                      <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-fighter-jet"></i></span>
                          <input id="choice" name="choice" type="text" class="form-control" value="'.$choice.'" required>
                      </div>
                      </div>
                  </div>
            
                  <div class="col-md-6">
                      <div class="form-group">
                          <label>Edit the right answer</label>
                          <div class="input-group">
                              <span class="input-group-addon"><i class="fa fa-fighter-jet"></i></span>
                              <input id="answer" name="answer" type="text" class="form-control" value="'.$answer.'" required>
                          </div>
                      </div>
                  </div>
                </div>
                <input type="hidden" id="qid" name="qid" type="text" class="form-control" value="'.$qid.'" required>
                <input type="hidden" id="tid" name="tid" type="text" class="form-control" value="'.$tid.'" required>';
                echo '<button type="submit" class="btn btn-primary">Submit</button>
                </form>
                <br/>
                ';
                $i++;
          }
          echo '</div>';

        }

        if(@$_GET['q']==2 AND ($usertype==0||$usertype==1))
        {
          $result = mysqli_query($con,"SELECT * FROM tests ORDER BY title ASC") or die('Error');
          echo  '<div class="panel"><div class="table-responsive"><table id="example1" class="table table-bordered table-striped">
          <thead><tr><th><b>S.N.</b></th><th><b>Topic</b></th><th><b>Category</b></th><th><b>Total questions</b></th><th><b>Marks for Right Answer</b></th><th><b>Marks for wrong Answer</b></th><th><b>Total Marks</b></th><th><b>Time limit</b></th><th><b>Test Status</b></th>';
          if(($usertype==0)||($usertype==1))
            echo'<th><b>Delete Test</b></th><th><b>Edit Test</b></th>';
          else echo'<th><b>Edit Test</b></th>';
          echo '</tr></thead>';
          $c=1;
          echo '<tbody>';
          while($row = mysqli_fetch_array($result)) {
            $title = $row['title'];
            $total = $row['totalquestions'];
            $rights = $row['rightmarks'];
            $wrongs = $row['wrongmarks'];
            $time = $row['duration'];
            $tid = $row['tid'];
            $teststatus = $row['teststatus'];
            $category = $row['category'];
            echo '<tr><td>'.$c++.'</td><td>'.$title.'</td><td>'.$category.'</td><td>'.$total.'</td><td>'.$rights.'</td><td>-'.$wrongs.'</td><td>'.$rights*$total.'</td><td>'.$time.'&nbsp;min</td>';
            if($teststatus == 1)
            {
              echo '<td><form role="form" action="queries.php?q=deactivatetest&tid='.$tid.'" method="POST">
                    <button type="submit" class="btn btn-block btn-success btn-xs">Active</button></form></td>';
            }
            else
            {
              echo '<td><form role="form" action="queries.php?q=activatetest&tid='.$tid.'" method="POST">
                    <button type="submit" class="btn btn-block btn-danger btn-xs">De-Active</button></form></td>';
            }

            if(($usertype == 0)||($usertype==1))
            echo '<td><form role="form" action="queries.php?q=deletetest&tid='.$tid.'" method="POST">
                    <button type="submit" class="btn btn-block btn-danger btn-xs">Delete</button></form></td>';

            echo'<td>
                  <form role="form" action="dashboard.php?q=13&tid='.$tid.'" method="POST">
                  <button type="submit" class="btn btn-block btn-warning btn-xs">Edit Test</button></form>
                 </td>
                
            </tr>';
            }
            $c=0;
            echo '</tbody></table></div></div>';
        }

        if(@$_GET['q']==3 AND ($usertype==0||$usertype==1)) {

          echo '
            <div class="row">
              <div class="col-md-4">
                <div class="box box-primary">
                  <form role="form" action="queries.php?q=activateusert" method="POST">
                    <div class="box-body">
                      <div class="form-group">
                        <label>Activate User</label>
                        <input type="text" class="form-control" id="aEmail" name="aEmail" placeholder="Enter user email to activate">
                      </div>
                    </div>
                    <div class="box-footer">
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                  </form>
                </div>
              </div>

              <div class="col-md-4">
                <div class="box box-primary">
                  <form role="form" action="queries.php?q=deactivateusert" method="POST">
                    <div class="box-body">
                      <div class="form-group">
                        <label>De-Activate User</label>
                        <input type="text" class="form-control" id="dEmail" name="dEmail" placeholder="Enter user email to deactivate">
                      </div>
                    </div>
                    <div class="box-footer">
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                  </form>
                </div>
              </div>

              <div class="col-md-4">
                <div class="box box-primary">
                  <form role="form" action="queries.php?q=resetpasswordt" method="POST">
                    <div class="box-body">
                      <div class="form-group">
                        <label>Reset User Password</label>
                        <input type="text" class="form-control" id="rEmail" name="rEmail" placeholder="Enter user email to reset the password">
                      </div>
                    </div>
                    <div class="box-footer">
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                  </form>
                </div>
            </div>
            </div>
          ';
          if($usertype==0)
          echo'
            <div class="row">
              <div class="col-md-4">
                <div class="box box-primary">
                  <form role="form" action="queries.php?q=makeadmin" method="POST">
                    <div class="box-body">
                      <div class="form-group">
                        <label>Make an User Admin</label>
                        <input type="text" class="form-control" id="adminEmail" name="adminEmail" placeholder="Enter user email to change to admin">
                      </div>
                    </div>
                    <div class="box-footer">
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          ';
          $result = mysqli_query($con,"SELECT * FROM users ORDER BY name ASC") or die('Error');
          echo  '<div class="panel"><div class="table-responsive"><table id="example1" class="table table-bordered table-striped">
          <thead><tr><th><b>S.N.</b></th><th><b>Name</b></th><th><b>Institute Name</b></th><th><b>Marks Obtained</b></th><th><b>Total Marks</b></th><th><b>User Status</b></th><th><b>Reset Password</b></th></tr></thead>';
          $c=1;
          echo '<tbody>';
          while($row = mysqli_fetch_array($result)) {
            $uemail = $row['email'];
            $uname = $row['name'];
            $college = $row['college'];
            $marksobtained = $row['score'];
            $totalscore = $row['maxscore'];
            $ustatus = $row['ustatus'];
            $utype = $row['usertype'];
            if($utype==2)
              {
                echo '<tr><td>'.$c++.'</td><td>'.$uname.'</td><td>'.$college.'</td><td>'.$marksobtained.'</td><td>'.$totalscore.'</td>';
                if($ustatus==1)
                {
                  echo '<td><form role="form" action="queries.php?q=deactivateuser&uemail='.$uemail.'" method="POST">
                        <button type="submit" class="btn btn-block btn-success btn-xs">Active</button></form></td>';
                }
                else 
                {
                  echo '<td><form role="form" action="queries.php?q=activateuser&uemail='.$uemail.'" method="POST">
                        <button type="submit" class="btn btn-block btn-danger btn-xs">De-Active</button></form></td>';
                }
                echo '<td><form role="form" action="queries.php?q=resetpassword&uemail='.$uemail.'" method="POST">
                      <button type="submit" class="btn btn-block btn-primary btn-xs">Reset</button></form></td>';
              }
          }
          echo '</tr></tbody></table></div>';
        }

        if(@$_GET['q']==4) {
          $result = mysqli_query($con,"SELECT * FROM users ORDER BY perc DESC") or die('Error');
          echo  '<div class="panel"><div class="table-responsive"><table id="example1" class="table table-bordered table-striped">
          <thead><tr><th><b>Rank</b></th><th><b>Name</b></th><th><b>Institute Name</b></th><th><b>Marks Obtained</b></th><th><b>Total Marks</b></th><th><b>Percentage</b></th></tr></thead>';
          $c=1;
          echo '<tbody>';
          while($row = mysqli_fetch_array($result)) {
            $uemail = $row['email'];
            $uname = $row['name'];
            $college = $row['college'];
            $marksobtained = $row['score'];
            $totalscore = $row['maxscore'];
            $ustatus = $row['ustatus'];
            $utype = $row['usertype'];
            $perc = $row['perc'];
            if($utype==2 OR $usertype==0 OR $usertype==1)
            echo '<tr><td>'.$c++.'</td><td>'.$uname.'</td><td>'.$college.'</td><td>'.$marksobtained.'</td><td>'.$totalscore.'</td><td>'.$perc.'</td></tr>';
          }
          echo '</tbody></table></div></div>';
        }

        if(@$_GET['q']==5) {
          $getuserinfo = mysqli_query($con,"SELECT * FROM users WHERE email='$email'") or die('Error');
          $info = mysqli_fetch_array($getuserinfo);
          $college = $info['college'];
          $marksobtained = $info['score'];
          $totalscore = $info['maxscore'];
          $perc = $info['perc'];
          $contact = $info['contact'];
          $dob = $info['dob'];
          $gender = $info['gender'];
          $reg = $info['regdate'];
          $uid = $info['uid'];
          $name = $info['name'];
          $email = $info['email'];
          echo'
            <div class="row">
              <div class="col-md-3">
                <div class="box box-primary">
                  <div class="box-body box-profile">
                    <img class="profile-user-img img-responsive img-circle" src="dist/img/default-50x50.jpg" alt="User profile picture">
                    <h3 class="profile-username text-center">'.$name.'</h3>';
                    if($usertype==2)  echo'<p class="text-muted text-center">Student Account</p>'; 
                    else if($usertype==1)  echo'<p class="text-muted text-center">Admin Account</p>';
                    else echo'<p class="text-muted text-center">Master Admin</p>';
                    echo'
                    <ul class="list-group list-group-unbordered">
                      <li class="list-group-item">
                        <b>Marks Obtained</b> <a class="pull-right">'.$marksobtained.'</a>
                      </li>
                      <li class="list-group-item">
                        <b>Total Marks</b> <a class="pull-right">'.$totalscore.'</a>
                      </li>
                      <li class="list-group-item">
                        <b>Percentage</b> <a class="pull-right">'.$perc.'%</a>
                      </li>
                    </ul>
                    <a href="dashboard.php?q=7" class="btn btn-primary btn-block"><b>Change Password</b></a>
                  </div>
                </div>
              </div>

              <form role="form" action="queries.php?q=updatedetails&uid='.$uid.'" onSubmit="return validateForm()" method="POST">
              <div class="col-md-9">
                <div class="box box-primary">

                  <div class="row box-body">
                    <div class="col-md-12 form-group">
                      <label>Full Name</label>
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-user"></i></span>
                          <input id="name" name="name" type="text" class="form-control" placeholder="Please enter your full name" value="'.$name.'" required disabled>
                        </div>
                    </div>
                  </div>

                  <div class="row box-body">
                    <div class="col-md-4 form-group">
                      <label>DOB <small>(yyyy/mm/dd)</small></label>
                      
                      <div class="input-group">
                          <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                          </div>
                        <input id="dob" name="dob" type="text" class="form-control" data-mask placeholder="yyyy/mm/dd" value="'.$dob.'" required>
                      </div>
                    </div>
                    <div class="col-md-4 form-group">
                        <label>Gender</label>
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa  fa-group"></i></span>
                          <input id="gender" name="gender" type="text" class="form-control" placeholder="M||F" value="'.$gender.'" required>
                        </div>
                    </div>
                    <div class="col-md-4 form-group">
                        <label>Contact Number</label>
                        <div class="input-group">
                          <div class="input-group-addon">
                            <i class="fa fa-phone"></i>
                          </div>
                          <input id="contact" name="contact" type="number" class="form-control" placeholder="9999999999" value="'.$contact.'" required>
                        </div>
                        <!-- /.input group -->
                    </div>
                  </div>

                  <div class="row box-body">
                    <div class="form-group col-md-6">
                      <label for="exampleInputEmail1">Email address</label>
                      <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                          <input id="email" name="email" type="email" class="form-control" placeholder="Email" value="'.$email.'" required>
                      </div>
                    </div>
                    <div class="form-group col-md-6">
                      <label>Institute Name</label>
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa  fa-graduation-cap"></i></span>
                        <input id="college" name="college" type="text" class="form-control" placeholder="Please enter your school/college name" value="'.$college.'" required>
                      </div>
                    </div>
                  </div>
                  
                  <div class="row box-body">
                    <div class="col-md-2">
                    <button type="submit" class="btn btn-primary">Update Details</button>
                    </div>
                  </div>
                </div>
              </div>
              </form>



            </div>
          ';
        }

        if(@$_GET['q']==7) {
          echo '
          <div class="row">
          <div class="col-md-6">
              <!-- general form elements -->
              <div class="box box-primary">
                <form role="form" action="queries.php?q=cngpass" method="POST">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="existingPassword">Existing Password</label>
                      <input type="password" class="form-control" id="password" name="password" placeholder="Existing Password">
                    </div>
                    <div class="form-group">
                      <label for="newPassowrd">New Password</label>
                      <input type="password" class="form-control" id="npassword" name="npassword" placeholder="New Password">
                    </div>
                    <div class="form-group">
                      <label for="newPassowrd">Re-type New Password</label>
                      <input type="password" class="form-control" id="cnpassword" name="cnpassword" placeholder="Re-type New Password">
                    </div>
                  </div>
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </form>
          </div>
          </div>
          </div>
          ';
      }
        ?>

        
        </section>
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>&copy; Copyright 2019 A.K.A Exponent -&nbsp;</strong> All rights reserved
  </footer>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="bower_components/raphael/raphael.min.js"></script>
<script src="bower_components/morris.js/morris.min.js"></script>
<!-- Sparkline -->
<script src="bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="bower_components/moment/min/moment.min.js"></script>
<script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>

<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->
     <!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<script src="dist/js/demo.js"></script>

<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
</body>
</html>

<?php 
include_once 'dbConnection.php';
  $tid=@$_GET['tid'];
  $uid=@$_GET['uid'];
  $testchecking=mysqli_query($con,"SELECT * FROM history WHERE tid='$tid' AND uid='$uid'" );
  $row=mysqli_fetch_array($testchecking);
  if($row && (@$_GET['q']== 'quiz'))
  {
    echo "<script>alert('You have already taken this test. Go back')</script>";
    echo "<script>window.close();</script>";
  }
?>

<script type="text/javascript">
    var cnt=0;
    window.onblur = function() { 
        cnt++;
        if(cnt==1){
			alert("You are trying to navigate away from this page");
		}
		if(cnt==3){
			alert("You have tried again to navigate away from this page! ");
		}
		if(cnt>4)
		{
			window.close(); 
		}
    }
    var cntkey=0;
    window.onkeydown = function(e) {
		if (e.ctrlKey || e.altKey) 
		{
        cntkey++;
        if(cntkey==1){
			alert("You are trying to navigate away from this page");
		}
		if(cntkey==3){
			alert("You have tried again to navigate away from this page! ");
		}
		if(cntkey>4)
		{
			window.close(); 
		}
		}
		return false;
	}
</script>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="shortcut icon" href="assets/images/final-128x68.png" type="image/x-icon">
  <title>Test Page</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    <script type="text/javascript">
            function fullscreen(){

            }

            function timeout(){
                var hours=Math.floor(timeLeft/3600);
                var minute=Math.floor((timeLeft-(hours*60*60)-30)/60);
                var second=timeLeft%60;
                if(timeLeft<=0)
                {   
                    clearTimeout(tm);
                    document.getElementById("submitan").submit();
                }
                else
                { 
                  if(hours<10 && hours!=(-1))
                    {
                        hours="0"+hours;
                    }
                    else if(hours==(-1))
                    {
                        hours="0"+"0";
                    }
                    else hours=hours;

                    if(minute<10 && minute!=(-1))
                    {
                        minute="0"+minute;
                    }
                    else if(minute==(-1)) minute="0"+"0";
                    else minute=minute;
                    
                    if(second<10 && second!=(-1))
                    {
                        second="0"+second;
                    }
                    else if(second==(-1)) second="0"+"0"
                    else second=second;
                    document.getElementById("time").innerHTML=hours+":"+minute+":"+second;
                }
                timeLeft--;
                var tm = setTimeout(function(){timeout()},1000);
            }
            
        </script>

        <script>
            function insert(num){
                document.form.textview.value = document.form.textview.value+num;
            }

            function equal(){
                var exp = document.form.textview.value;
                if(exp){
                    document.form.textview.value = eval(exp);
                } 
            }

            function clean(){
                document.form.textview.value = "";
            }

            function back(){
                var exp = document.form.textview.value;
                document.form.textview.value = exp.substring(0,exp.length-1);
            }
        </script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
</head>
<?php 
if(@$_GET['q']== 'quiz' && @$_GET['step']== 2)
  echo'<body class="hold-transition skin-blue fixed sidebar-mini"   onload="fullscreen();timeout();">';
else 
  echo'<body class="hold-transition skin-blue fixed sidebar-mini"   onload="fullscreen();">';
?>
<?php
 include_once 'dbConnection.php';
  if(!(isset($_SESSION['email']))){
}
else
{
$name = $_SESSION['name'];
$email=$_SESSION['email'];
include_once 'dbConnection.php';
}?>

<!-- Site wrapper -->
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="#" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A.K.A</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>A.K.A Exponent</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
      <?php 
            $tid=@$_GET['tid'];
            $testtime=mysqli_query($con,"SELECT duration FROM tests WHERE tid='$tid'" );
            $testtime1=mysqli_fetch_array($testtime);
            $testtime2=$testtime1['duration']*60;
            if(@$_GET['q']== 'quiz' && @$_GET['step']== 2)
            echo'
        <div class="col-md-12">
        <div class="box box-solid">
        <div class="box-header">
                <script type="text/javascript">
                  var timeLeft='.$testtime2.';
                </script>
                <h1 class="box-title" style="float:left">Timeleft:&nbsp;&nbsp;</h1>
                <h1 class="box-title" id="time" style="float:left">Timeout</h1>
              </div>
          </div>
          </div>
          ';?>
      </div>
    </nav>
  </header>
  
<aside class="main-sidebar">
<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">

  <!-- Sidebar Menu -->
  <ul class="sidebar-menu" data-widget="tree">
    <!-- Optionally, you can add icons to the links -->
    <div>""</div>
          
    <li class="header">Calculator</li>
    <div>""</div>
    <div class="col-md-12">
      <div class="box box-solid">
                <div class="box-header with-border">
                    <form name="form">
                        <input class="form-control" name="textview">
                    </form>
                    <table>
                        <tr>
                            <td><input class="btn btn-default" type="button" value="C" onclick="clean()"></td>
                            <td><input class="btn btn-default" type="button" value="<" onclick="back()"></td>
                            <td><input class="btn btn-default" type="button" value="/" onclick="insert('/')"></td>
                            <td><input class="btn btn-default" type="button" value="X" onclick="insert('*')"></td>
                        </tr>
                        <tr>
                            <td><input class="btn btn-default" type="button" value="7" onclick="insert(7)"></td>
                            <td><input class="btn btn-default" type="button" value="8" onclick="insert(8)"></td>
                            <td><input class="btn btn-default" type="button" value="9" onclick="insert(9)"></td>
                            <td><input class="btn btn-default" type="button" value="-" onclick="insert('-')"></td>
                        </tr>
                        <tr>
                            <td><input class="btn btn-default" type="button" value="4" onclick="insert(4)"></td>
                            <td><input class="btn btn-default" type="button" value="5" onclick="insert(5)"></td>
                            <td><input class="btn btn-default" type="button" value="6" onclick="insert(6)"></td>
                            <td><input class="btn btn-default" type="button" value="+" onclick="insert('+')"></td>
                        </tr>
                        <tr>
                            <td><input class="btn btn-default" type="button" value="1" onclick="insert(1)"></td>
                            <td><input class="btn btn-default" type="button" value="2" onclick="insert(2)"></td>
                            <td><input class="btn btn-default" type="button" value="3" onclick="insert(3)"></td>
                            <td rowspan=5><input class="btn btn-default" style="height:106" type="button" value="=" onclick="equal()"></td>
                        </tr>
                        <tr>
                            <td colspan=2><input class="btn btn-default" style="width:106" type="button" value="0" onclick="insert(0)"></td>
                            <td><input class="btn btn-default" type="button" value="." onclick="insert('.')"></td>
                        </tr>
                    </table>
                </div>
            </div>
      </div>
  </ul>

  <!-- /.sidebar-menu -->
</section>
<!-- /.sidebar -->
</aside>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      
            <div class="box box-solid">
                <div class="box-header with-border">
                  <!--quiz start-->
                <?php

                  if(@$_GET['q']== 'quiz' && @$_GET['step']== 2) {
                    $tid=@$_GET['tid'];
                    $uid=@$_GET['uid'];
                    $sn=1;
                    $total=@$_GET['t'];
                    $q=mysqli_query($con,"SELECT * FROM questions WHERE tid='$tid'" );
                    echo '<form role="form" id="submitan" action="queries.php?q=submitans&uid='.$uid.'&tid='.@$_GET['tid'].'" method="POST">';                    
                    while($row=mysqli_fetch_array($q) )
                    {
                      $qns=$row['question'];
                      $qid=$row['qid'];
                      $choice=$row['options'];
                      $choices=explode("||",$choice);
                      $noOfStrings=count($choices);
                      echo '<b>Question &nbsp;'.$sn.'&nbsp;::&nbsp;'.$qns.'</b><br />';
                      
                      for($i=0;$i<$noOfStrings;$i++){   
                        echo'<input type="radio" name="ans'.$qid.'" value="'.$choices[$i].'">'.$choices[$i];
                        echo'<br/>';
                      }
                      echo'<br />';
                      $sn=$sn+1;
                    }
                    echo '<br /><button type="submit" class="btn btn-primary">Submit</button></div></form>';
                  }
                  
                  if(@$_GET['q'] == 'aftertest'){
                    $uid = @$_GET['uid'];
                    $tid = @$_GET['tid'];


                    echo '
                    <div class="row">
                      <div class="col-lg-3 col-xs-6">
                        <div class="small-box bg-green">
                          <div class="inner">
                            <h3><i class="ion ion-clipboard"></i></h3>
                            <p>View Answers</p>
                          </div>
                          <div class="icon">
                            <i class="ion ion-clipboard"></i>
                          </div>
                          <a href="test.php?q=viewresult&uid='.$uid.'&tid='.$tid.'" class="small-box-footer">Click here to view answers <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                      </div>
                    </div>
                    ';
                    echo '<button type="button" onclick="window.close()">Exit</button>';
                  }
                  
                  if(@$_GET['q'] == 'viewresult'){
                    $uid = @$_GET['uid'];
                    $tid = @$_GET['tid'];
                    $sn=1;

                    $q=mysqli_query($con,"SELECT * FROM questions WHERE tid='$tid'" );
                    echo'<div>';
                    while($row=mysqli_fetch_array($q) )
                    {
                      $qns=$row['question'];
                      $qid=$row['qid'];
                      $choice=$row['options'];
                      $answer=$row['answer'];
                      $choices=explode("||",$choice);
                      $noOfStrings=count($choices);
                      
                      $q1=mysqli_query($con,"SELECT * FROM answers WHERE tid='$tid' and uid='$uid' and qid='$qid'");
                      $ans = mysqli_fetch_array($q1);
                      $answered = $ans['answer'];

                      echo '<b>Question &nbsp;'.$sn.'&nbsp;::&nbsp;'.$qns.'</b><br />';
                      echo '<b>Right Answer is &nbsp;::&nbsp;'.$answer.'</b><br />';
                      for($i=0;$i<$noOfStrings;$i++){
                      if($choices[$i]==$answered AND $answer==$answered)
                        echo'
                          <div class="checkbox">
                            <label>
                              <input type="checkbox" disabled checked> 
                              <p  style="color:green;font-size:20px;"><b>'.$choices[$i].'</b></p>
                            </label>
                          </div>
                        ';
                      else if($choices[$i]==$answered)
                        echo'
                          <div class="checkbox">
                            <label>
                              <input type="checkbox" disabled checked>
                              <p  style="color:red;font-size:20px;"><b>'.$choices[$i].'</b></p>
                            </label>
                          </div>
                        ';
                      else
                        echo'
                          <div class="checkbox">
                            <label>
                              <input type="checkbox" disabled>
                              '.$choices[$i].'
                            </label>
                          </div>
                        ';
                      }
                      $sn=$sn+1;
                    }
                    echo '<button type="button" onclick="window.close()">Exit</button>';
                    echo '</div>';
                  }
                ?>
      </div>
    
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<script>
  $(document).ready(function () {
    $('.sidebar-menu').tree()
  })
</script>
</body>
</html>

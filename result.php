<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="shortcut icon" href="assets/images/final-128x68.png" type="image/x-icon">
  <title>Results</title>
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
</head>
<body>
<?php
    include_once 'dbConnection.php';
    if(!(isset($_SESSION['email']))){
    }
    else
    {
    $name = $_SESSION['name'];
    $email=$_SESSION['email'];
    include_once 'dbConnection.php';
    }
?>
<?php
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
    echo'</div>';  
?>
</body>
</html>
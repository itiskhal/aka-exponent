<?php
include_once 'dbConnection.php';
$email = $_POST['uname'];
$password = $_POST['password'];

$email = stripslashes($email);
$email = addslashes($email);
$password = stripslashes($password); 
$password = addslashes($password);
$password=md5($password);
$result = mysqli_query($con,"SELECT email FROM users WHERE email = '$email' and password = '$password'") or die(mysqli_error($con));
$userdata = mysqli_query($con,"SELECT * FROM users WHERE email = '$email' and password = '$password'") or die(mysqli_error($con));
$row = mysqli_fetch_array($userdata);
$count=mysqli_num_rows($result);
if($count==1){
session_start();
if(isset($_SESSION['email'])){
session_unset();}
$_SESSION["name"] = $row['name'];
$_SESSION["key"] = $row['email'];
$_SESSION["email"] = $row['email'];
$_SESSION["uid"] = $row['uid']; 
$_SESSION["usertype"] = $row['usertype']; 
$_SESSION["userstatus"] = $row['ustatus']; 
$userstatus = $row['ustatus'];
if($userstatus) 
//echo '<script>window.open(`dashboard.php?q=10`,`_self`,`toolbar=false,menubar=false,scrollbars=yes,resizable=false`)</script>';
header("location:dashboard.php?q=0");
else 
  {
    echo "<script>alert('Your account is inavtive. Please contact administrator to activate your account')</script>";
    echo "<script>location.href='login.php'</script>";
  }
}
else 
  {
    echo "<script>alert('Username or Password incorrect')</script>";
    echo "<script>location.href='login.php'</script>";
  }
?>
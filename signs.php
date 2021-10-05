<?php
include_once 'dbConnection.php';
ob_start();
$uid=uniqid();
$name = $_POST['name'];
$name= ucwords(strtolower($name));
$dob = $_POST['dob'];
$gender = $_POST['gender'];
$college = $_POST['college'];
$email = $_POST['email'];
$contact = $_POST['contact'];
$password = $_POST['password'];
$cpassword = $_POST['cpassword'];
$name = stripslashes($name);
$name = addslashes($name);
$name = ucwords(strtolower($name));
$gender = stripslashes($gender);
$gender = addslashes($gender);
$email = stripslashes($email);
$email = addslashes($email);
$college = stripslashes($college);
$college = addslashes($college);
$contact = stripslashes($contact);
$contact = addslashes($contact);
$dob = stripslashes($dob);
$dob = addslashes($dob);
$password = stripslashes($password);
$password = addslashes($password);
$password = md5($password);
$cpassword = stripslashes($cpassword);
$cpassword = addslashes($cpassword);
$cpassword = md5($cpassword);
$utype = 2;
$score = 0;
$maxscore = 0;
$perc = 0;
$ustatus = 1;
if($password==$cpassword)
{
    $q3=mysqli_query($con,"INSERT INTO users VALUES  ('$uid', '$name' , '$password' , '$dob' , '$gender' , '$college','$email' ,'$contact', '$utype', '$score' , '$maxscore' , '$perc' ,NOW() , '$ustatus')");
}
if($q3)
{
header("location:login.php");
}
else if($password!=$cpassword)
{
echo "<script>alert('Passwords are not matching. Please renter the passwords')</script>";
header("<script>location.href='signup.php'</script>");
}
else
{
echo "<script>alert('User already registered with this email')</script>";
header("<script>location.href='signup.php'</script>");
}
?>
<?php
include_once 'dbConnection.php';
session_start();
$email=$_SESSION['email'];
$usertype = $_SESSION['usertype'];

// Add test
if(isset($_SESSION['key'])){
    if(@$_GET['q']== 'addquiz') {
    $name = $_POST['name'];
    $name= ucwords(strtolower($name));
    $total = $_POST['total'];
    $rights = $_POST['rights'];
    $wrong = $_POST['wrong'];
    $time = $_POST['time'];
    $desc = $_POST['desc'];
    $category = $_POST['category'];
    $id=uniqid();
    $uid=@$_GET['uid'];
    $q1=mysqli_query($con,"INSERT INTO tests VALUES  ('$id','$name','$total', '$rights' , '$wrong','$time' ,'$desc', NOW(), '$uid', '0', '$category')");    
    header("location:dashboard.php?n=$total&tid=$id&q=12");
}
}

// Add questions
if(isset($_SESSION['key'])){
    if(@$_GET['q']== 'addqns') {
    $n=@$_GET['n'];
    $tid=@$_GET['tid'];
    for($i=1;$i<=$n;$i++)
    {
        $qid=uniqid();
        $qns=$_POST['qns'.$i];
        $choices=$_POST['choices'.$i];
        $answer=$_POST['answer'.$i];
        $q3=mysqli_query($con,"INSERT INTO questions VALUES ('$qid','$tid','$qns','$choices','$answer')");
    }
    header("location:dashboard.php?q=0");
    }
}

// Change password
if(@$_GET['q']== 'cngpass') {
    $password = $_POST['password'];
    $password = stripslashes($password); 
    $password = addslashes($password);
    $password = md5($password);
    
    $npassword = $_POST['npassword'];
    $npassword = stripslashes($npassword); 
    $npassword = addslashes($npassword);
    $npassword = md5($npassword);
    
    $cnpassword = $_POST['cnpassword'];
    $cnpassword = stripslashes($cnpassword); 
    $cnpassword = addslashes($cnpassword);
    $cnpassword = md5($cnpassword);

    $result = mysqli_query($con,"SELECT password FROM users WHERE email='$email'");
    $row10 = mysqli_fetch_array($result);
    $cnfpassword = $row10['password'];

    if($npassword==$cnpassword)
    {
        if($cnfpassword==$password)
        {
        $cngpass = mysqli_query($con,"UPDATE users SET password='$npassword' WHERE email='$email'");
        echo "<script>alert('Password changed successfully')</script>";
        echo "<script>location.href='dashboard.php?q=0'</script>";
        }
        else
        {
            echo "<script>alert('Incorrect current password. Try again !!!')</script>";
            echo "<script>location.href='dashboard.php?q=7'</script>";
        }
    }
    else{
        echo "<script>alert('New password not matching. Try again !!!')</script>";
        echo "<script>location.href='dashboard.php?q=7'</script>";
    }
}

// Reset user password using button
if(@$_GET['q'] == 'resetpassword') {
    $uemail = @$_GET['uemail'];
    $resetpass = 'test1234';
    $resetpass = md5($resetpass);
    $cngpass = mysqli_query($con,"UPDATE users SET password='$resetpass' WHERE email='$uemail'");
    header("location:dashboard.php?q=3");
   }

// Reset user password using text box
if(@$_GET['q'] == 'resetpasswordt') {
    $uemail = $_POST['rEmail'];
    $resetpass = 'test1234';
    $resetpass = md5($resetpass);    
    $getuserdetails = mysqli_query($con,"SELECT * from users WHERE email='$uemail'");
    $getuserdetails1 = mysqli_fetch_array($getuserdetails);
    if($getuserdetails1['usertype']==2 OR $usertype==0)
    {
        $cngpass = mysqli_query($con,"UPDATE users SET password='$resetpass' WHERE email='$uemail'");
        header("location:dashboard.php?q=3");
    }
    else header("location:dashboard.php?q=3");  
}

// Activate user using button
if(@$_GET['q'] == 'activateuser') {
    $uemail = @$_GET['uemail'];
    $activateuser = mysqli_query($con,"UPDATE users SET ustatus=1 WHERE email='$uemail'");
    header("location:dashboard.php?q=3");    
}

// Activate user using text box
if(@$_GET['q'] == 'activateusert') {
    $uemail = $_POST['aEmail'];
    $getuserdetail = mysqli_query($con,"SELECT * from users WHERE email='$uemail'");
    $getuserdetails2 = mysqli_fetch_array($getuserdetail);
    if($getuserdetails2['usertype']==2 OR $usertype==0)
    {
        $activateuser = mysqli_query($con,"UPDATE users SET ustatus=1 WHERE email='$uemail'");
        header("location:dashboard.php?q=3");  
    }
    else header("location:dashboard.php?q=3");      
}

// Deactivate user using button
if(@$_GET['q'] == 'deactivateuser') {
    $uemail = @$_GET['uemail'];
    $deactivateuser = mysqli_query($con,"UPDATE users SET ustatus=0 WHERE email='$uemail'");
    header("location:dashboard.php?q=3");    
}

// Deactivate user using text box
if(@$_GET['q'] == 'deactivateusert') {
    $uemail = $_POST['dEmail'];
    $getuserdetai = mysqli_query($con,"SELECT * from users WHERE email='$uemail'");
    $getuserdetails3 = mysqli_fetch_array($getuserdetai);
    if($getuserdetails3['usertype']==2 OR $usertype==0)
    {
        $deactivateuser = mysqli_query($con,"UPDATE users SET ustatus=0 WHERE email='$uemail'");
        header("location:dashboard.php?q=3");
    }    
    else header("location:dashboard.php?q=3");
}

// Activate test
if(@$_GET['q'] == 'activatetest') {
    $tid = @$_GET['tid'];
    $activatetest = mysqli_query($con,"UPDATE tests SET teststatus=1 WHERE tid='$tid'");
    header("location:dashboard.php?q=2");    
}

// Deactivate test 
if(@$_GET['q'] == 'deactivatetest') {
    $tid = @$_GET['tid'];
    $deactivatetest = mysqli_query($con,"UPDATE tests SET teststatus=0 WHERE tid='$tid'");
    header("location:dashboard.php?q=2");    
}

// Make an user Admin
if(@$_GET['q'] == 'makeadmin') {
    $adminEmail = $_POST['adminEmail'];
    $makeadmin = mysqli_query($con,"UPDATE users SET usertype=1 WHERE email='$adminEmail'");
    header("location:dashboard.php?q=3&email'.$adminEmail.'");    
}

// Submit test and evaluate
if(@$_GET['q'] == 'submitans') {
    $tid = @$_GET['tid'];
    $uid = @$_GET['uid'];
    $q=mysqli_query($con,"SELECT * FROM questions WHERE tid='$tid'" );
    $q1=mysqli_query($con,"SELECT * FROM tests WHERE tid='$tid'" );
    
    $row1=mysqli_fetch_array($q1);
    $rightmarks=$row1['rightmarks'];
    $wrongmarks=$row1['wrongmarks'];
    $duration=$row1['duration'];
    $right=0;
    $wrong=0;
    $totalmarks=$row1['totalquestions']*$rightmarks;
    while($row=mysqli_fetch_array($q) )
    {
      $qns=$row['question'];
      $qid=$row['qid'];
      $choice=$row['options'];
      $choices=explode("||",$choice);
      $noOfStrings=count($choices);
      $answer=$row['answer'];
      $aid=uniqid();
      $answered=$_POST['ans'.$qid];
      if(is_null($answered))
      {
          $answered='notans';
      }
      $q2=mysqli_query($con,"INSERT INTO answers VALUES ('$aid','$tid','$qid','$uid','$answered')") or die(mysqli_error($con));
      
      if($answer==$answered) $right=$right+1;
      else if($answered=='notans') $wrong=$wrong;
      else $wrong=$wrong+1;
    }
    $score=($rightmarks*$right)-($wrongmarks*$wrong);
    $hid=uniqid();

    $q3=mysqli_query($con,"INSERT INTO history VALUES ('$hid','$uid','$tid',NOW(),'$duration','$score')")  or die(mysqli_error($con));

    $q4 = mysqli_query($con,"UPDATE users SET maxscore=(maxscore+$totalmarks) WHERE uid='$uid'");    
    $q5 = mysqli_query($con,"UPDATE users SET score=(score+$score) WHERE uid='$uid'");  
    
    $q6 = mysqli_query($con,"SELECT * FROM users WHERE uid='$uid'");
    $user = mysqli_fetch_array($q6);
    $scorenew = $user['score'];
    $maxscorenew = $user['maxscore'];
    $total = ($scorenew/$maxscorenew)*100;
    $q7 = mysqli_query($con,"UPDATE users SET perc=$total WHERE uid='$uid'");
    
    header("location:test.php?q=aftertest&uid=$uid&tid=$tid");                                                                                                                      
}

// Update user details
if(@$_GET['q'] == 'updatedetails') 
{  
    $email = $_POST['email']; 
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $college = $_POST['college'];
    $contact = $_POST['contact'];
    $gender = stripslashes($gender);
    $gender = addslashes($gender);
    $college = stripslashes($college);
    $college = addslashes($college);
    $contact = stripslashes($contact);
    $contact = addslashes($contact);
    $dob = stripslashes($dob);
    $dob = addslashes($dob);
    $email = stripslashes($email);
    $email = addslashes($email);
    $uid = @$_GET['uid'];
    $updatedetails = mysqli_query($con,"UPDATE users SET email='$email',dob='$dob',gender='$gender',college='$college',contact='$contact' WHERE uid='$uid'")or die(mysqli_error($con));
    
    echo "<script>alert('Details Updated Successfully. Please login again to see the changes')</script>";
    echo "<script>location.href='logout.php'</script>";
}

// Delete Test
if(@$_GET['q'] == 'deletetest') 
{ 
    $testid = @$_GET['tid'];
    //$checktest = mysqli_query($con,"SELECT * FROM history WHERE tid='$testid'");
    //if(is_null(mysqli_fetch_array($checktest))) {
        $deletequestions = mysqli_query($con,"DELETE FROM questions WHERE tid='$testid' ") or die('Error');
        $deletetest = mysqli_query($con,"DELETE FROM tests WHERE tid='$testid' ") or die('Error');
        echo "<script>alert('Test deleted successfully !!!')</script>";
        echo "<script>location.href='dashboard.php?q=2'</script>";
    //}
    // else {
    // echo "<script>alert('Cannot delete the test')</script>";
    // echo "<script>location.href='dashboard.php?q=2'</script>";
    // }
}

// Edit Questions
if(@$_GET['q'] == 'editqn') 
{ 
    $tid = $_POST['tid'];
    $qid = $_POST['qid'];
    $question = $_POST['question'];
    $choice = $_POST['choice'];
    $answer = $_POST['answer'];
    $updatequestion = mysqli_query($con,"UPDATE questions SET question='$question',options='$choice',answer='$answer' WHERE qid='$qid'")or die(mysqli_error($con));
    if($updatequestion){
        echo "<script>alert('Question changes have been updated successfully')</script>";
        echo "<script>location.href='dashboard.php?q=2'</script>";
    }
    else 
        echo 
        "<script>alert('Try Again !!!')</script>
         <script>location.href='dashboard.php?q=13&tid=$tid'</script>";
}

// Edit Questions
if(@$_GET['q'] == 'edittestdetails') 
{ 
    $tid = $_POST['tid'];
    $title = $_POST['name'];
    $category = $_POST['category'];
    $rightmarks = $_POST['rights'];
    $wrongmarks = $_POST['wrong'];
    $duration = $_POST['time'];
    $description = $_POST['desc'];
    $updatetest = mysqli_query($con,"UPDATE tests SET title='$title',category='$category',rightmarks='$rightmarks',wrongmarks='$wrongmarks',duration='$duration',description='$description' WHERE tid='$tid'")or die(mysqli_error($con));
    if($updatetest){
        echo "<script>alert('Test changes have been updated successfully')</script>";
        echo "<script>location.href='dashboard.php?q=2'</script>";
    }
    else 
        echo 
        "<script>alert('Try Again !!!')</script>
         <script>location.href='dashboard.php?q=13&tid=$tid'</script>";
}
?>
<?php
    session_start();
    include("../ConnectDB/connectDB.php");
    
    $email = $_POST['email'];
    $pass = $_POST['pass'];
     //$pass = md5($_POST['pass']);


    $sql1 = "select * from tbemployee where email='$email' and password='$pass';";
    $resultck = mysqli_query($link, $sql1);
   //$num1 = MYSQLI_NUM_ROWS($sql1);
         if($email == "")
         {
                 echo"<script>";
                 echo"window.location.href='../index.php?email=null';";
                 echo"</script>";
         }
             else if($pass == "")
             {
                 echo"<script>";
                 echo"window.location.href='../index.php?pass=null';";
                 echo"</script>";
             }
             else if(!mysqli_num_rows($resultck))
             {
                 echo"<script>";
                 echo"window.location.href='../index.php?login=false';";
                 echo"</script>";
             }
             else 
             {
                 $sql = "select * from tbemployee where Email = '$email' and password = '$pass';";
                 $resultget = mysqli_query($link, $sql);
                 
                 if(mysqli_num_rows($resultget) <= 0){
                     echo"<meta http-equiv-'refress' content='1;URL=../index.php'>";
                 }
                 else{
                    
                     while($user = mysqli_fetch_array($resultget))
                     {
                         if($user['auther_id'] == 1)
                         {
                             $_SESSION['ses_id'] = session_id();
                             $_SESSION['email'] = $user['Email'];
                             $_SESSION['emp_name'] = $user['Emp_Name'];
                             $_SESSION['emp_id'] = $user['Emp_ID'];
                             $_SESSION['img_path'] = $user['img_path'];
                             $_SESSION['auther_id'] = 1;
                             echo"<meta http-equiv='refresh' content='1;URL=../Admin/Main.php'>";
                         }
                         else if($user['auther_id'] == 2)
                         {
                             $_SESSION['ses_id'] = session_id();
                             $_SESSION['email'] = $user['Email'];
                             $_SESSION['emp_name'] = $user['Emp_Name'];
                             $_SESSION['emp_id'] = $user['Emp_ID'];
                             $_SESSION['img_path'] = $user['img_path'];
                             $_SESSION['auther_id'] = 2;
                             echo"<meta http-equiv='refresh' content='1;URL=../User/Main.php'>";
                         }
                         else
                         {
                             $_SESSION['ses_id'] = session_id();
                             $_SESSION['auther_id'] > 2 ;
                             echo"<script>";
                             echo"window.location.href='logout.php?permission=found';";
                             echo"</script>";
                         }

                     }
                 }
             }    
?>
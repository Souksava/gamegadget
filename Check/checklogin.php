<?php
    session_start();
    include("../Administrator/oop/connect.php");
    
    $email = $_POST['email'];
    $pass = $_POST['pass'];
     //$pass = md5($_POST['pass']);

     $pass = md5($pass);
     $resultck = mysqli_query($conn, "call login_customer('$email','$pass')");
   //$num1 = MYSQLI_NUM_ROWS($sql1);
         if($email == "")
         {
                 echo"<script>";
                 echo"window.location.href='../Login/Login?email=not';";
                 echo"</script>";
         }
             else if($pass == "")
             {
                echo"<script>";
                echo"window.location.href='../Login/Login?pass=not';";
                echo"</script>";
             }
             else if(!mysqli_num_rows($resultck))
             {
                echo"<script>";
                echo"window.location.href='../Login/Login?found=true';";
                echo"</script>";
             }
             else 
             {
                 
                 if(mysqli_num_rows($resultck) <= 0){
                     echo"<meta http-equiv-'refress' content='1;URL=../Login/Login'>";
                 }
                 else{
                     while($user = mysqli_fetch_array($resultck))
                     {                       
                        $_SESSION['game_gadget_customer_ses_id'] = session_id();
                        $_SESSION['cus_id'] = $user['cus_id'];
                        $_SESSION['email'] = $user['email'];
                        $_SESSION['cus_name'] = $user['cus_name'];
                        $_SESSION['cus_surname'] = $user['cus_surname'];
                        $_SESSION['gender'] = $user['gender'];
                        $_SESSION['tel'] = $user['tel'];
                        $_SESSION['tel_app'] = $user['tel_app'];
                        $_SESSION['address'] = $user['address'];
                        echo"<meta http-equiv='refresh' content='1;URL=../Home?login=true'>";
                         
                    }
                } 
            }   
?>

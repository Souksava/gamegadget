<?php
 include ('connect.php');
date_default_timezone_set("Asia/Bangkok");
$datenow = time();
$Date = date("Y-m-d",$datenow);
$Time = date("H:i:s",$datenow);
class obj{
    public $conn;
    public $search;
    public static function login($email,$pass){
        global $conn;
        session_start();
        $pass = md5($pass);
        $resultck = mysqli_query($conn, "call login('$email','$pass')");
        if($email == "")
        {
            echo"<script>";
            echo"window.location.href='Login?email=null';";
            echo"</script>";
        }
        else if($pass == "")
        {
            echo"<script>";
            echo"window.location.href='Login?pass=null';";
            echo"</script>";
        }
        else if(!mysqli_num_rows($resultck))
        {
            echo"<script>";
            echo"window.location.href='Login?login=false';";
            echo"</script>";
        }
        else 
        {
            if(mysqli_num_rows($resultck) <= 0){
                echo"<meta http-equiv-'refress' content='1;URL=/'>";
            }
            else{
               
                while($user = mysqli_fetch_array($resultck))
                {
                    if($user['status'] == 1)
                    {
                        $_SESSION['game_gadget_lao_ses_id'] = session_id();
                        $_SESSION['emp_id'] = $user['emp_id'];
                        $_SESSION['email'] = $user['email'];
                        $_SESSION['emp_name'] = $user['emp_name'];
                        $_SESSION['img_path'] = $user['img_path'];
                        $_SESSION['game_gadget_lao_ses_status_id'] = 1;
                        echo"<meta http-equiv='refresh' content='1;URL=Admin/Main'>";
                    }
                    else if($user['status'] == 2)
                    {
                        $_SESSION['game_gadget_lao_ses_id'] = session_id();
                        $_SESSION['emp_id'] = $user['emp_id'];
                        $_SESSION['email'] = $user['email'];
                        $_SESSION['emp_name'] = $user['emp_name'];
                        $_SESSION['img_path'] = $user['img_path'];
                        $_SESSION['game_gadget_lao_ses_status_id'] = 2;
                        echo"<meta http-equiv='refresh' content='1;URL=User/Main'>";
                    }
                    else
                    {
                        $_SESSION['game_gadget_lao_ses_id'] = session_id();
                        session_start();
                        unset($_SESSION['game_gadget_lao_ses_id']);
                        unset($_SESSION['emp_id']);
                        unset($_SESSION['email']);
                        unset($_SESSION['emp_name']);
                        unset($_SESSION['img_path']);
                        unset($_SESSION['game_gadget_lao_ses_status_id']);
                        session_destroy();
                        echo"<script>";
                        echo"window.location.href='/?permission=found';";
                        echo"</script>";
                    }

                }
            }
        }  
    }
    public static function logout(){
        session_start();
        unset($_SESSION['game_gadget_lao_ses_id']);
        unset($_SESSION['emp_id']);
        unset($_SESSION['email']);
        unset($_SESSION['emp_name']);
        unset($_SESSION['img_path']);
        unset($_SESSION['game_gadget_lao_ses_status_id']);
        session_destroy();
        global $session_path;
        echo"<script>";
        echo"window.location.href='$session_path';";
        echo"</script>";
    }
   
}
$obj = new obj();
?>
<?php
 include ('connect.php');
date_default_timezone_set("Asia/Bangkok");
$datenow = time();
$Date = date("Y-m-d",$datenow);
$Time = date("H:i:s",$datenow);
class obj{
    public $conn;
    public $search;
    public static function login($email,$password){
        global $conn;
        // $password = "') or '1'='1';");//";
        session_start();
        $resultck = mysqli_query($conn, "select * from employee where email='$email' and binary pass=md5('$password')");
        if($email == "")
        {
            echo"<script>";
            echo"window.location.href='home?email=null';";
            echo"</script>";
        }
        else if($password == "")
        {
            echo"<script>";
            echo"window.location.href='home?pass=null';";
            echo"</script>";
        }
        else if(!mysqli_num_rows($resultck))
        {
            echo"<script>";
            echo"window.location.href='home?login=false';";
            echo"</script>";
        }
        else 
        {
            $resultget = mysqli_query($conn, "select * from employee where email='$email' and binary pass=md5('$password')"); 
            if(mysqli_num_rows($resultget) <= 0){
                echo"<meta http-equiv-'refress' content='1;URL=/'>";
            }
            else{
               
                while($user = mysqli_fetch_array($resultget))
                {
                    if($user['stt_id'] == 1)
                    {
                        $_SESSION['ses_seven_id'] = session_id();
                        $_SESSION['email'] = $user['email'];
                        $_SESSION['emp_name'] = $user['emp_name'];
                        $_SESSION['emp_id'] = $user['emp_id'];
                        $_SESSION['img_path'] = $user['img_path'];
                        $_SESSION['ses_status_id'] = 1;
                        echo"<meta http-equiv='refresh' content='1;URL=Manager/Main'>";
                    }
                    else if($user['stt_id'] == 2)
                    {
                        $_SESSION['ses_seven_id'] = session_id();
                        $_SESSION['email'] = $user['email'];
                        $_SESSION['emp_name'] = $user['emp_name'];
                        $_SESSION['emp_id'] = $user['emp_id'];
                        $_SESSION['img_path'] = $user['img_path'];
                        $_SESSION['ses_status_id'] = 2;
                        echo"<meta http-equiv='refresh' content='1;URL=User/Main'>";
                    }
                    else if($user['stt_id'] == 3)
                    {
                        $_SESSION['ses_seven_id'] = session_id();
                        $_SESSION['email'] = $user['email'];
                        $_SESSION['emp_name'] = $user['emp_name'];
                        $_SESSION['emp_id'] = $user['emp_id'];
                        $_SESSION['img_path'] = $user['img_path'];
                        $_SESSION['ses_status_id'] = 3;
                        echo"<meta http-equiv='refresh' content='1;URL=User_Stock/Main'>";
                    }
                    else if($user['stt_id'] == 4)
                    {
                        $_SESSION['ses_seven_id'] = session_id();
                        $_SESSION['email'] = $user['email'];
                        $_SESSION['emp_name'] = $user['emp_name'];
                        $_SESSION['emp_id'] = $user['emp_id'];
                        $_SESSION['img_path'] = $user['img_path'];
                        $_SESSION['ses_status_id'] = 4;
                        echo"<meta http-equiv='refresh' content='1;URL=Check_Stock/Main'>";
                    }
                    else
                    {
                        $_SESSION['ses_seven_id'] = session_id();
                        session_start();
                        unset($_SESSION['ses_seven_id']);
                        unset($_SESSION['email']);
                        unset($_SESSION['emp_name']);
                        unset($_SESSION['emp_id']);
                        unset($_SESSION['img_path']);
                        unset($_SESSION['ses_status_id']);
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
        global $path;
        session_start();
        unset($_SESSION['ses_seven_id']);
        unset($_SESSION['email']);
        unset($_SESSION['emp_name']);
        unset($_SESSION['emp_id']);
        unset($_SESSION['img_path']);
        unset($_SESSION['ses_status_id']);
        session_destroy();
        echo"<script>";
        echo"window.location.href='$path';";
        echo"</script>";
    }
   
}
$obj = new obj();
?>
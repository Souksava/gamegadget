<?php
    session_start();
    unset($_SESSION['ses_id']);
    unset($_SESSION['cus_id']);
    unset($_SESSION['cus_name']);
    unset($_SESSION['cus_surname']);
    unset($_SESSION['cus_email']);
    unset($_SESSION['fb_access_token']);
    session_destroy();
    echo"<meta http-equiv='refresh' content='1;URL=../Home?logout=true'>";
?>
<?php
include ('../oop/connect.php');
$accept = "ອະນຸມັດ";
$not_accept = "ບໍ່ອະນຸມັດ";
$result = mysqli_query($conn,"select count(form_id) as count from form where (stt_accept='$accept' or stt_accept='$not_accept') and seen2='0'");
$fetch = mysqli_fetch_array($result,MYSQLI_ASSOC);
echo $fetch['count'];
?>

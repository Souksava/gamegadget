<?php
include ('../oop/connect.php');
$acc_accept = "ຍັງບໍ່ອະນຸມັດ";
$result = mysqli_query($conn,"select count(form_id) as count from form where stt_accept='$acc_accept' and seen1='0'");
$fetch = mysqli_fetch_array($result,MYSQLI_ASSOC);
echo $fetch['count'];
?>

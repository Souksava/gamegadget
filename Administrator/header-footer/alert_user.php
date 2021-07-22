<?php
include ('../oop/connect.php');
$accept = "ອະນຸມັດ";
$not_accept = "ບໍ່ອະນຸມັດ";
$order = "ສັ່ງຊື້";
$result = mysqli_query($conn,"select count(order_id) as count from orders where (status='$accept' or status='$not_accept') and seen2='0'");
$fetch = mysqli_fetch_array($result,MYSQLI_ASSOC);
$result2 = mysqli_query($conn,"select count(sell_id) as count from sell where status='$order' and seen1='0'");
$fetch2 = mysqli_fetch_array($result2,MYSQLI_ASSOC);
echo $fetch['count'] +  $fetch2['count'];
?>

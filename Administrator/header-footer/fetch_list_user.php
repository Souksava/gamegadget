<?php
include ('../oop/connect.php');
    $accept = "ອະນຸມັດ";
    $not_accept = "ບໍ່ອະນຸມັດ";
    $order = "ສັ່ງຊື້";
    $result = mysqli_query($conn,"select order_id,emp_name from orders f left join employees e on f.emp_id=e.emp_id where (f.status='$accept' or f.status='$not_accept') and seen2='0'");
    $result2 = mysqli_query($conn,"select sell_id,cus_name from sell f left join customers e on f.cus_id=e.cus_id where f.status='$order' and seen1='0'");

if(mysqli_num_rows($result) > 0 || mysqli_num_rows($result2) > 0)
{
    foreach($result as $list){
?>
    <div class="dropdown-item">
        <i class="fas fa-envelope mr-2"></i> ຕອບຮັບການສັ່ງຊື້ເລກທີ: <?php echo $list['order_id'] ?> ສັ່ງຊື້ໂດຍ <?php echo $list['emp_name'] ?>
    </div>
    <div class="dropdown-divider"></div>
<?php
    }
    foreach($result2 as $list2){
?>
    <div class="dropdown-item">
        <i class="fas fa-envelope mr-2"></i> ລູກຄ້າສັ່ງຊື້ຈາກເວັບໄຊໃບສັ່ງຊື້ເລກທີ: <?php echo $list2['sell_id'] ?> ໂດຍ <?php echo $list2['cus_name'] ?>
    </div>
        <div class="dropdown-divider"></div>
<?php
    }
}
else{
    echo '<br>
        <hr size="1" width="90%">
        <p align="center">ບໍ່ມີຂໍ້ມູນ</p>
        <hr size="1" width="90%">
        ';
}

?>

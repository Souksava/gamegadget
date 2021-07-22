<?php
include ('../oop/connect.php');
    $acc_accept = "ຍັງບໍ່ອະນຸມັດ";
    $result = mysqli_query($conn,"select order_id,emp_name from orders f left join employees e on f.emp_id=e.emp_id where f.status='$acc_accept' and seen1='0'");

if(mysqli_num_rows($result) > 0)
{
    foreach($result as $list){
?>
    <div class="dropdown-item">
        <i class="fas fa-envelope mr-2"></i> ມີລາຍການສັ່ງຊື້ສິນຄ້າເລກທີ <?php echo $list['order_id'] ?> ໂດຍ <?php echo $list['emp_name'] ?>
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
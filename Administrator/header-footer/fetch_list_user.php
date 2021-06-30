<?php
include ('../oop/connect.php');
    $accept = "ອະນຸມັດ";
    $not_accept = "ບໍ່ອະນຸມັດ";
    $result = mysqli_query($conn,"select form_id,emp_name,usr_acc from form f left join employee e on f.emp_id=e.emp_id where (stt_accept='$accept' or stt_accept='$not_accept') and seen2='0'");

if(mysqli_num_rows($result) > 0)
{
    foreach($result as $list){
?>
    <div class="dropdown-item">
        <i class="fas fa-envelope mr-2"></i> ມີຕອບຮັບຟອມເບີກເລກທີ <?php echo $list['form_id'] ?> ໂດຍ <?php echo $list['usr_acc'] ?>
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
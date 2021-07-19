
<?php
    if(isset($_POST["query"])){
        $sell_iddetail = $_POST["query"];
      include ('../../oop/obj.php');
      $customerdetail = mysqli_query($conn,"SELECT cus_name,cus_surname,gender,address,s.img_path,place_deli,note,status_cash,tel,tel_app FROM sell s LEFT JOIN customers c ON s.cus_id=c.cus_id WHERE s.sell_id='$sell_iddetail'");
      if(mysqli_num_rows($customerdetail) > 0){
        $rowdetail = mysqli_fetch_array($customerdetail,MYSQLI_ASSOC);
?>
<div class="card">
    <div class="card-header">
        ລາຍລະອຽດລູກຄ້າ
    </div>
    <div class="card-body">
        <div align="center">
            <?php 
                if($rowdetail["img_path"] == ""){
                    $rowdetail["img_path"] = "image.jpeg";
                }
            ?>
            <a href="../../image/<?php echo $rowdetail["img_path"] ?>">
                <img src="../../image/<?php echo $rowdetail["img_path"] ?>" class="img-circle elevation-2" alt="" width="120px" />
            </a>
        </div>
        <div>
            <p>
                ປະເພດການຈ່າຍ: <?php echo $rowdetail["status_cash"] ?> <br>
                ເບີໂທລະສັບ: <?php echo $rowdetail["tel"] ?><br>
                What's App: <?php echo $rowdetail["tel_app"] ?><br>
                ທີ່ຢູ່ປັດຈຸບັນ: <?php echo $rowdetail["address"] ?>
            </p>
            <p>
               <h3>ສະຖານທີຈັດສົ່ງ</h3> 
               <?php echo $rowdetail["place_deli"] ?>
            </p>
        </div>
    </div>
</div>
<?php
      }
    }
?>
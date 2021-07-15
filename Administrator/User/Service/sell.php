<?php
  $title = "ຂາຍສິນຄ້າ";
  $path="../../";
  $links = "../";
  $session_path = "../../";
  include ("../../header-footer/header.php");
    $resultTHB = mysqli_query($conn,"select * from rate where rate_id='THB'");
    $row_THB = mysqli_fetch_array($resultTHB,MYSQLI_ASSOC);
    $THB = $row_THB["rate_buy"];
    $resultUSD = mysqli_query($conn,"select * from rate where rate_id='USD'");
    $row_USD = mysqli_fetch_array($resultUSD,MYSQLI_ASSOC);
    $USD = $row_USD["rate_buy"];

?>
<div class="container-fluid font12">
    <div class="row">
        <div class="col-md-8">
            <form action="Sell" id="form_sell" method="POST">
                <div class="input-group">
                    <input type="text" id="pro_id_sell" name="pro_id_sell" placeholder="ລະຫັດສິນຄ້າ"
                        class="form-control" autofocus>
                    <input type="number" min="0" id="qty_sell" name="qty_sell" placeholder="ຈຳນວນ" class="form-control">
                    <div class="input-group-prepend">
                        <button type="submit" name="btnAdd_sell" class="btn btn-outline-primary">ເພີ່ມລາຍການ</button>
                    </div>
                </div>
            </form>
        </div>
    </div><br>
    <div class="row">
        <div class="col-md-8">
            <div class="row">
                <div class="col-xs-12 col-sm-6">
                    <a href="board_sell.php" target="_blank">ລາຍການສິນຄ້າ</a>
                </div>
                <div class="col-xs-12 col-sm-6" align="right">
                    ເລກທີບິນ: <label class="sell_id"></label>
                </div>
            </div>
            <?php
                $amount = 0;
                $obj->select_sell_cookie();
                if(isset($_COOKIE['list_sell'])){
            ?>
            <div class="table-responsive">
                <table class="table" style="width: 980px;">
                    <tr>
                        <th style="width: 30px;" scope="col">No.</th>
                        <th style="width: 57px;" scope="col">ສິນຄ້າ</th>
                        <th style="width: 120px;" scope="col">ລະຫັດສິນຄ້າ</th>
                        <th style="width: 120px;" scope="col">ຊື່ສິນຄ້າ</th>
                        <th style="width: 60px;" scope="col">ຈຳນວນ</th>
                        <th style="width: 160px;" scope="col">ລາຄາ</th>
                        <th style="width: 100px;" scope="col">ລວມ</th>
                        <th style="width: 35px;"></th>
                    </tr>
                    <?php
                        $no_ = 0;
                        $amount = 0;
                        foreach($cart_data as $row){
                        $amount += $row["qty"] * $row["newprice"];
                        $total = 0;
                        $total += $row["qty"] * $row["newprice"];
                    ?>
                    <tr>
                        <td><?php echo $no_ += 1; ?></td>
                        <?php
                            if($row['img_path'] == ''){
                            ?>
                        <td>
                            <a href="<?php echo $path?>image/image.jpeg"><img src="<?php echo $path?>image/image.jpeg"
                                    alt=" class=" img-circle elevation-2 alt="" width="55px"></a>
                        </td>
                        <?php
                            }
                            else{
                            ?>
                        <td>
                            <a href="<?php echo $path?>image/<?php echo $row['img_path'] ?>"><img
                                    src="<?php echo $path?>image/<?php echo $row['img_path'] ?>" alt=""
                                    class="img-circle elevation-2" alt="" width="55px"></a>
                        </td>
                        <?php
                            }
                        ?>
                        <td><?php echo $row["pro_id"] ?></td>
                        <td><?php echo $row["cate_name"] ?> <?php echo $row["brand_name"] ?>
                            <?php echo $row["pro_name"] ?></td>
                        <td><?php echo $row["qty"] ?> <?php echo $row["unit_name"] ?></td>
                        <td>
                            <h6 style="color: #CE3131;">ລາຄາ <?php echo number_format($row['newprice'],2); ?> ກີບ
                            </h6>
                            <h7>ລາຄາປົກກະຕິ <?php echo number_format($row['price'],2); ?> ກີບ</h7>
                            <div style="color: #7E7C7C;font-size: 12px;">ສ່ວນຫຼຸດ
                                <?php echo number_format($row['promotion'],2); ?> ກີບ
                                (<?php echo number_format($row['perzen'],2); ?> %)</div>
                        </td>
                        <td><?php echo number_format($total,2) ?></td>
                        <td>
                            <a href="Sell?listsell=<?php echo $row["pro_id"] ?>" class="fa fa-trash toolcolor"></a>
                        </td>
                    </tr>
                    <?php
                        }
                    ?>
                </table>
            </div>
            <hr size="3" align="center" width="100%">
            <?php
                    }
                    else{
                        echo'
                        <div align="center">
                            <hr size="1" style="width: 90%;"/>
                                ຍັງບໍ່ມີຂໍ້ມູນ
                            <hr size="1" style="width: 90%;"/>
                        </div>
                    ';
                    }
                    ?>
        </div>
        <div class="col-lg-3 font12">
            <div class="row row-cols-1 row-cols-md-1">
                <div class="col mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 align="center" class="card-title"></h5>
                            <p class="card-text">
                            <form action="Sell" id="form_save" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-12 form-control2">
                                        <label for="">ສະລິບການໂອນເງິນ</label>
                                        <input type="file" name="img_path" id="img" onchange="loadFile(event)">
                                        <input type="hidden" name="sell_id" id="sell_id">
                                    </div>
                                    <div class="col-md-12 form-control2">
                                        <img src="../../image/camera.jpg" id="output" width="100%" height="120">
                                    </div>
                                    <div class="col-md-12 form-control2">
                                        <label for="">ຄ່າຈັດສົ່ງ</label>
                                        <input type="number" name="delivery" id="delivery" placeholder="ຄ່າຈັດສົ່ງ">
                                    </div>
                                    <div class="col-md-12" align="center">
                                        <button type="button" name="btnSale" name="btncontinue" data-toggle="modal"
                                            data-target="#exampleModalSell" class="btn btn-outline-success">
                                            ດຳເນີນການຂາຍ
                                        </button><br>
                                        <div class="modal fade" id="exampleModalSell" tabindex="-1" role="dialog"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">ປິດການຂາຍສິນຄ້າ
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row" align="left">
                                                            <div class="col-md-12 form-control2">
                                                                <label for="">ຈຳນວນຮັບເງິນມາ</label>
                                                                <input type="text" name="getmoney2"
                                                                    placeholder="ຈຳນວນຮັບເງິນມາ" id="getmoney2" value=""
                                                                    autofocus>
                                                                <input type="hidden" name="getmoney" placeholder=""
                                                                    id="getmoney" value="">
                                                                <input type="hidden" name="amount"
                                                                    value="<?php echo $amount?>">
                                                            </div>
                                                            <div class="col-md-12 form-control2">
                                                                <label for="">ມູນຄ່າທັງໝົດ</label>
                                                                <input type="text" placeholder="ມູນຄ່າທັງໝົດ"
                                                                    value="<?php echo number_format($amount,2)." LAK" ?>"
                                                                    disabled>
                                                            </div>
                                                            <div class="col-md-12 form-control2">
                                                                <label for="">ເງິນທອນກີບ</label>
                                                                <input type="text" placeholder="ເງິນທອນກີບ" id="repay"
                                                                    value="0" disabled>
                                                            </div>
                                                            <div class="col-md-12 form-control2">
                                                                <label for="">ບາດ</label>
                                                                <input type="text" placeholder="ບາດ" id="thb" disabled>
                                                            </div>
                                                            <div class="col-md-12 form-control2">
                                                                <label for="">ໂດລ້າ</label>
                                                                <input type="text" placeholder="ໂດລ້າ" id="usd" value=""
                                                                    disabled>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-outline-secondary"
                                                            data-dismiss="modal">ຍົກເລີກ</button>
                                                        <button type="submit" name="btn_save" id="btn_save"
                                                            class="btn btn-outline-success" onclick="">
                                                            ປິດການຂາຍ
                                                            <span class="" id="load_save"></span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr size="3" align="center" width="100%">
                                    <div class="col-md-12">
                                        ຍອມລວມ (ລວມພາສີມູນຄ່າເພີ່ມ)
                                        <h5 style="color: #CE3131;"><?php echo number_format($amount,2) ?> LAK</h5>
                                        <h5 style="color: #7E7C7C;"><?php echo number_format($amount/$THB,2) ?> THB</h5>
                                        <h5 style="color: #7E7C7C;"><?php echo number_format($amount/$USD,2) ?> USD</h5>
                                    </div>

                                </div>
                            </form>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
        URL.revokeObjectURL(output.src) // free memory
    }
};
</script>
<script>
loadorder_bill();

function loadorder_bill() {
    $.ajax({
        url: "sell_id.php",
        success: function(result) {
            $('#sell_id').val(result); //insert text of test.php into your div
            $('.sell_id').text(result); //insert text of test.php into your div
            setTimeout(function() {
                loadorder_bill(); //this will send request again and again;
            }, 2000);
        }
    });
}
</script>
<?php
    include ("../../header-footer/footer.php");
    if(isset($_GET['list'])=='null'){
        echo'<script type="text/javascript">
        swal("", "ກະລຸນາເພີ່ມລາຍການສັ່ງຊື້ກ່ອນ", "info");
        </script>';
    }
    if(isset($_GET['save'])=='fail'){
        echo'<script type="text/javascript">
        swal("", "ບັນທຶກຂໍ້ມູນບໍ່ສຳເລັດ", "error");
        </script>';
      }
      if(isset($_GET['save2'])=='success'){
        echo'<script type="text/javascript">
        swal("", "ບັນທຶກຂໍ້ມູນສຳເລັດ", "success");
        </script>';
      }
      if(isset($_GET['product'])=='null'){
        echo'<script type="text/javascript">
        swal("", "ລະຫັດສິນຄ້າບໍ່ຖືກຕ້ອງ", "info");
        </script>';
      }
      if(isset($_GET['stock'])=='over'){
        echo'<script type="text/javascript">
        swal("", "ຈຳນວນສິນຄ້າເກີນສະຕ໋ອກ", "info");
        </script>';
      }
      if(isset($_GET['stock'])=='over'){
        $msg = $_GET["msg"];
        $productid = $_GET["productid"];
        echo'<script type="text/javascript">
        swal("", "ບໍ່ສາມາດເພີ່ມສິນຄ້າໄດ້ ເນື່ອງສິນຄ້າຊື່: '.$productid.' '.$msg.' ທີ່ທ່ານສັ່ງຊື້ເກີນຈຳນວນໃນສະຕ໋ອກ", "info");
        </script>';
      }
      if(isset($_GET['stock2'])=='over2'){
        $msg = $_GET["msg2"];
        $productid = $_GET["productid2"];
        echo'<script type="text/javascript">
        swal("", "ບໍ່ສາມາດຂາຍສິນຄ້າໄດ້ ເນື່ອງສິນຄ້າຊື່: '.$productid.' '.$msg.' ທີ່ທ່ານສັ່ງຊື້ເກີນຈຳນວນໃນສະຕ໋ອກ", "info");
        </script>';
      }
  ?>
<script>
$(document).ready(function() {
    $("#getmoney2").keyup(function() {
        var getmoney = $('#getmoney2').val();
        getmoney = getmoney.split(',').join('');
        $("#getmoney").val(getmoney);
        var repay = getmoney - <?php echo $amount ?>;
        $("#repay").val(repay.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") + " LAK");
        if ($("#getmoney2").val() === "" || $("#getmoney2").val() === "0") {
            $("#repay").val(0);
            $("#thb").val(0);
            $("#usd").val(0);
        } else {
            var thb = repay / <?php echo $THB ?>;
            var usd = repay / <?php echo $USD ?>;
            $("#thb").val(thb + " THB");
            $("#usd").val(usd + " USD");
        }
        // number keyup format
        var val = $('#getmoney2').val();
        val = val.replace(/[^0-9\.]/g, '');

        if (val != "") {
            valArr = val.split('.');
            valArr[0] = (parseInt(valArr[0], 10)).toLocaleString();
            val = valArr.join('.');
        }

        this.value = val;
        // End keyup format
    });

});
</script>
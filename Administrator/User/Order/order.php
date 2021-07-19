<?php
  $title = "ສັ່ງຊື້ສິນຄ້າ";
  $path="../../";
  $links = "../";
  $session_path = "../../";
  include (''.$path.'header-footer/header.php');
?>
<style>
.click:hover {
    cursor: pointer;
}
</style>
<div style="width: 100%;">
    <a href="Order?alert=1">ກວດສອບສິນຄ້າ</a>&nbsp <img src="<?php echo $path ?>icon/hidemenu.ico" width="10px">
</div>
<div class="row">
    <div class="col-md-7">

        <div class="table-responsive">
            <table id="table" data-pagination="true" data-search="true" data-toolbar="#toolbar"
                data-advanced-search="true" data-id-table="advancedTable" data-show-columns="true" data-resizable="true"
                data-page-list="[10, 25, 50, 100, all]" data-search-highlight="true" style="width: 850px;">
                <thead>
                    <tr>
                        <!-- <th></th> -->
                        <th>No.</th>
                        <th class="display_none"></th>
                        <th class="display_none"></th>
                        <th data-sortable="true">ສິນຄ້າ</th>
                        <th data-field="id" data-sortable="true">ລະຫັດ</th>
                        <th data-field="name" data-sortable="true">ຊື່ສິນຄ້າ</th>
                        <th data-field="qty" data-sortable="true">ຈຳນວນ</th>
                        <th data-field="qtyalert" data-sortable="true">ເງື່ອນໄຂການສັ່ງຊື້</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $no_ = 0;
                        if(isset($_GET["alert"])){
                            $select_product = mysqli_query($conn,"call select_product_alert();");
                        }
                        else{
                            $select_product = mysqli_query($conn,"call select_product();");
                        }
                        foreach($select_product as $row){
                        $no_ ++;
                    ?>
                    <tr class="click btnUpdate_emp">
                        <!-- <td class="icon-center">
                            <a href="#" class="fa fa-pen toolcolor btnUpdate_emp" onclick="modal_update()"></a>&nbsp;
                            &nbsp;
                        </td> -->
                        <td><?php echo $no_; ?></td>
                        <td class="display_none"><?php echo $row["img_path"] ?></td>
                        <td class="display_none"><?php echo $row["qty"] ?></td>
                        <?php 
                            if($row["img_path"] == ""){
                                $row["img_path"] = "image.jpeg";
                            }
                        ?>
                        <td> <a href="<?php echo $path;?>image/<?php echo $row["img_path"] ?>" target="_blank">
                                <img src="<?php echo $path;?>image/<?php echo $row["img_path"] ?>"
                                    class="img-circle elevation-2" alt="" width="50px">
                            </a>
                        </td>
                        <td><?php echo $row["pro_id"] ?></td>
                        <td><?php echo $row["cated_name"] ?> <?php echo $row["brand_name"] ?>
                            <?php echo $row["pro_name"] ?>
                        </td>
                        <td><?php echo $row["qty"] ?> <?php echo $row["unit_name"] ?></td>
                        <td><?php echo $row["qtyalert"] ?></td>
                    </tr>
                    <?php 
                        }
                        mysqli_free_result($select_product);  
                        mysqli_next_result($conn);
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-md-5">
        <div class="card">
            <div class="card-body">
                <h5 align="center" class="card-title"></h5>
                <p class="card-text">
                <form action="Order" id="form_save" method="POST" class="needs-validation" novalidate>
                    <div>
                        ເລກທີໃບສັ່ງຊື້: <label class="order_id"></label>
                    </div>

                        <div class="row">
                            <div class="col-md-4 form-group">
                                    <select name="sup_id" id="sup_id" class="selectcenter form-control" required>
                                        <option value="" disabled selected>--- ຜູ້ສະໜອງ ---</option>
                                        <?php
                                            $result_suppliery = mysqli_query($conn,"call select_supplier()");
                                            foreach($result_suppliery as $rowsup){
                                        ?>
                                        <option value="<?php echo $rowsup['sup_id'] ?>">
                                            <?php echo $rowsup['company'] ?>
                                        </option>
                                        <?php
                                            }
                                            mysqli_free_result($result_suppliery);  
                                            mysqli_next_result($conn);
                                        ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        ກະລຸນາເລືອກຜູ້ສະໜອງ
                                    </div>
                            </div>
                            <div class="col-md-4 form-group">
                                    <select name="rate_id" id="rate_id" class="selectcenter form-control" required>
                                        <option value="" disabled selected>--- ສະກຸນເງິນ ---</option>
                                        <?php
                                            $result_rate = mysqli_query($conn,"call select_rate()");
                                            foreach($result_rate as $rowrate){
                                        ?>
                                        <option value="<?php echo $rowrate['rate_id'] ?>">
                                            <?php echo $rowrate['rate_id'] ?>
                                        </option>
                                        <?php
                                            }
                                            mysqli_free_result($result_rate);  
                                            mysqli_next_result($conn);
                                        ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        ກະລຸນາເລືອກສະກຸນເງິນ
                                    </div>
                            </div>
                            <div class="col-md-4">
                                <div align="center-right">
                                    <button type="button" name="btnAdd" id="btn_order"
                                        class="btn btn-outline-success btn-block" data-toggle="modal"
                                        data-target="#exampleModal2" style="padding: 8px 0px 8px 0px">ສັ່ງຊື້</button>
                                    <div class="modal fade font14" id="exampleModal2" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">ຢຶນຢັນ</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span></button>
                                                </div>
                                                <div class="modal-body" align="center">
                                                    ທ່ານຕ້ອງການຈະບັນທຶກຂໍ້ມູນຟອມເຂົ້າໃນລະບົບ ຫຼື ບໍ່ ?
                                                    <input type="hidden" id="order_id" name="order_id">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-outline-secondary"
                                                        data-dismiss="modal">ຍົກເລີກ</button>
                                                    <button type="submit" name="btnSaveOrder" id="btnSaveOrder"
                                                        class="btn btn-outline-success" onclick="">
                                                        ບັນທຶກ
                                                        <span class="" id="load_save"></span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                        $amount = 0;
                        $obj->select_order_cookie();
                        if(isset($_COOKIE['list_order'])){
                    ?>
                    <div class="table-responsive2" style="text-align: center;">
                        <table class="table font12" style="width: 750px">
                            <tr>
                                <th style="width: 30px;">#</th>
                                <th>ສິນຄ້າ</th>
                                <th>ລະຫັດສິນຄ້າ</th>
                                <th>ຊື່ສິນຄ້າ</th>
                                <th>ຈຳນວນ</th>
                                <th>ລາຄາ</th>
                                <th>ລວມ</th>
                                <th style="width: 75px;"><a href="#" data-toggle="modal" style="color: white;"
                                        data-target="#exampleModalClear" class="clear">ລ້າງ</a></th>
                            </tr>
                            <?php
                                $no_ = 0;
                                foreach($cart_data as $row){
                                $amount += $row["qty"] * $row["price"];
                                $total = 0;
                                $total += $row["qty"] * $row["price"];
                            ?>
                            <tr>
                                <td><?php echo $no_ += 1; ?></td>
                                <?php
                                    if($row['img_path'] == ''){
                                    ?>
                                <td>
                                    <a href="<?php echo $path?>image/image.jpeg"><img
                                            src="<?php echo $path?>image/image.jpeg" alt=" class=" img-circle
                                            elevation-2 alt="" width="55px"></a>
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
                                <td><?php echo $row["cate_name"] ?> <?php echo $row["cated_name"] ?>
                                    <?php echo $row["brand_name"] ?>
                                    <?php echo $row["pro_name"] ?> </td>
                                <td><?php echo $row["qty"] ?> <?php echo $row["unit_name"] ?></td>
                                <td><?php echo number_format($row["price"],2) ?></td>
                                <td><?php echo number_format($total,2) ?></td>
                                <td>
                                    <a href="#" class="fa fa-trash toolcolor btnDelete_cookie"></a>
                                </td>
                            </tr>
                            <?php
                                }
                            ?>
                        </table>
                    </div>
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
                    <div class="col-md-12" align="right">
                        <br>
                        <h5 style="color: #CE3131;">ມູນຄ່າ: <?php echo number_format($amount,2) ?></h5>
                        <input type="hidden" name="amount" id="amount" value="<?php echo $amount ?>">
                    </div>

                </form>
                </p>
            </div>
        </div>
    </div>
</div>

<form action="Order" id="formClear" method="POST" enctype="multipart/form-data">
    <div class="modal fade" id="exampleModalClear" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ຢືນຢັນການລົບຂໍ້ມູນ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" align="center">
                    ທ່ານຕ້ອງການລ້າງລາຍການ ຫຼື ບໍ່ ?
                    <input type="hidden" id="btnClear" name="btnClear">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">ຍົກເລີກ</button>
                    <button type="submit" name="btnclear_Order" id="btnclear_Order"
                        class="btn btn-outline-danger">ລ້າງລາຍການ <span class="" id="load_Clear"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- modal form delete -->
<form action="Order" id="formDelete_cookie_one" method="POST" enctype="multipart/form-data">
    <div class="modal fade" id="exampleModalDelete_cookie" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ຢືນຢັນການລົບຂໍ້ມູນ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" align="center">
                    ທ່ານຕ້ອງການລົບຂໍ້ມູນ ຫຼື ບໍ່ ?
                    <input type="hidden" id="cookie_pro_id" name="cookie_pro_id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">ຍົກເລີກ</button>
                    <button type="submit" name="btnDelete_cookie_one" id="btnDelete_cookie_one"
                        class="btn btn-outline-danger">
                        ລົບ
                        <span class="" id="load_delete_cookie_one"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- modal form add -->
<form action="Order" id="Form_Add" method="POST" enctype="multipart/form-data" class="row g-3 needs-validation"
    novalidate>
    <div class="modal fade" id="exampleModalUpdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ເພີ່ມລາຍການສັ່ງຊື້</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row" align="left">
                        <div class="col-md-12 col-sm-6 form-control2">
                            <input type="hidden" name="pro_id_order" id="pro_id_order">
                            <label>ຮູບສິນຄ້າ</label>
                            <div class="col-md-12 col-sm-6 form-control2">
                                <img src="../../image/img_5f44c26b27f5c.jpg" id="output" width="100%" height="250">
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-6 form-group">
                            <label>ຈຳນວນ</label>
                            <input type="number" min="0" name="qty" id="qty" placeholder="ຈຳນວນ" class="form-control"
                                required>
                            <div class="invalid-feedback">
                                ກະລຸນາປ້ອນຈຳນວນ
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-6 form-group">
                            <label>ລາຄາ</label>
                            <input type="number" min="0" name="price" id="price" placeholder="ລາຄາ" class="form-control"
                                required>
                            <div class="invalid-feedback">
                                ກະລຸນາປ້ອນລາຄາ
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">ຍົກເລີກ</button>
                    <button type="submit" name="btnAddOrder" id="btnAddOrder" class="btn btn-outline-success"
                        onclick="">ເພີ່ມ
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
<?php
 include (''.$path.'header-footer/footer.php');
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
?>
<script>
$(function() {
    $('#table').bootstrapTable();
});
</script>
<script>
$(document).ready(function() {
    $(document).on("click", "#table tbody tr", function() {
        $('.click').on('click', function() {
            // $('#table').bootstrapTable();
            $('#exampleModalUpdate').modal('show');
            $tr = $(this).closest('tr');
            var data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();

            console.log(data);
            $('#pro_id_order').val(data[4]);
            if (data[1] === '') {
                document.getElementById("output").src = ('../../image/camera.jpg');
            } else {
                document.getElementById("output").src = ('../../image/' + data[1]);
            }
        });
    });
});
</script>
<script>
// Example starter JavaScript for disabling form submissions if there are invalid fields
(function() {
    'use strict'

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.querySelectorAll('.needs-validation')

    // Loop over them and prevent submission
    Array.prototype.slice.call(forms)
        .forEach(function(form) {
            form.addEventListener('submit', function(event) {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }

                form.classList.add('was-validated')
            }, false)
        })
})();
</script>
<script>
// function modal_update() {
$(document).ready(function() {
    $('.btnDelete_cookie').on('click', function() {
        // $('#table').bootstrapTable();
        $('#exampleModalDelete_cookie').modal('show');
        $tr = $(this).closest('tr');
        var data = $tr.children("td").map(function() {
            return $(this).text();
        }).get();

        console.log(data);
        $('#cookie_pro_id').val(data[2]);
    });
});
// }
</script>
<script>
loadorder_bill();

function loadorder_bill() {
    $.ajax({
        url: "order_id.php",
        success: function(result) {
            $('#order_id').val(result); //insert text of test.php into your div
            $('.order_id').text(result); //insert text of test.php into your div
            setTimeout(function() {
                loadorder_bill(); //this will send request again and again;
            }, 2000);
        }
    });
}
</script>
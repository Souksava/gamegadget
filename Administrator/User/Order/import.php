<?php
  $title = "ນຳເຂົ້າສິນຄ້າ";
  $path="../../";
  $links = "../";
  $session_path = "../../";
  include (''.$path.'header-footer/header.php');
?>
<div style="width: 100%;">
    <div style="width: 48%; float: left;">
        <b>ລາຍການສິນຄ້າ</b>&nbsp <img src="../../icon/hidemenu.ico" width="10px">
    </div>
    <div style="width: 46%; float: right;" align="right">
        <form action="Import" id="form_add" method="POST" enctype="multipart/form-data" class="needs-validation"
            novalidate>
            <a href="#" data-toggle="modal" data-target="#exampleModalemp">
                <img src="../../icon/add.ico" alt="" width="25px">
            </a>
            <div class="modal fade" id="exampleModalemp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">ນຳເຂົ້າສິນຄ້າ</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row" align="left">
                                <div class="col-md-12 col-sm-6 form-group">
                                    <label>ລະຫັດສິນຄ້າ</label>
                                    <input type="text" name="pro_id_import" id="pro_id_import" placeholder="ລະຫັດສິນຄ້າ"
                                        class="form-control" required>
                                    <div class="invalid-feedback">
                                        ກະລຸນາປ້ອນລະຫັດສິນຄ້າ
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-6 form-group">
                                    <label>ຈຳນວນ</label>
                                    <input type="number" min="0" name="qty" id="qty" class="form-control"
                                        placeholder="ຈຳນວນ" required>
                                    <div class="invalid-feedback">
                                        ກະລຸນາປ້ອນຈຳນວນ
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-6 form-group">
                                    <label>ລາຄາ</label>
                                    <input type="number" min="0" name="price" id="price" class="form-control"
                                        placeholder="ລາຄາ" required>
                                    <div class="invalid-feedback">
                                        ກະລຸນາປ້ອນລາຄາ
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-6 form-group">
                                    <label>ໝາຍເຫດ</label>
                                    <input type="text" name="remark" id="remark" placeholder="ໝາຍເຫດ"
                                        class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary"
                                data-dismiss="modal">ຍົກເລີກ</button>
                            <button type="submit" name="btnAddImport" id="btnAddImport"
                                class="btn btn-outline-primary">ເພີ່ມລາຍການ
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="clearfix"></div><br>
<div class="container-fluid font12">
    <div class="row">
        <div class="col-md-8">
            <?php
            $amount = 0;
            $obj->select_import_cookie();
            if(isset($_COOKIE['list_import'])){
        ?>
            <div class="table-responsive">
                <table class="table-bordered" style="width: 1200px;text-align: center;">
                    <tr style="font-size: 18px;">
                        <th style="width: 45px;"><a href="#" data-toggle="modal" data-target="#exampleModalClear"
                                class="clear" style="color: white;">ລ້າງ</a></th>
                        <th style="width: 45px;">ລຳດັບ</th>
                        <th style="width: 60px;">ສິນຄ້າ</th>
                        <th style="width: 90px;">ລະຫັດສິນຄ້າ</th>
                        <th style="width: 180px;">ຊື່ສິນຄ້າ</th>
                        <th style="width: 55px;">ຈຳນວນ</th>
                        <th style="width: 120px;">ລາຄາ</th>
                        <th style="width: 150px;">ລວມ</th>
                        <th style="width: 150px;">ໝາຍເຫດ</th>
                    </tr>
                    <?php
                        $no_ = 0;
                        foreach($cart_data as $row){
                        $amount += $row["qty"] * $row["price"];
                        $total = 0;
                        $total += $row["qty"] * $row["price"];
                    ?>
                    <tr>
                        <td>
                            <a href="#" class="fa fa-trash toolcolor btnDelete_cookie"></a>
                        </td>
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
                        <td><?php echo $row["cate_name"] ?> <?php echo $row["cated_name"] ?>
                            <?php echo $row["brand_name"] ?>
                            <?php echo $row["pro_name"] ?> </td>
                        <td><?php echo $row["qty"] ?> <?php echo $row["unit_name"] ?></td>
                        <td><?php echo number_format($row["price"],2) ?></td>
                        <td><?php echo number_format($total,2) ?></td>
                        <td><?php echo $row["remark"] ?></td>
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
            <br>
            <!-- pagination -->
        </div>
        <div class="col-lg-3 font12">
            <div class="row row-cols-1 row-cols-md-1">
                <div class="col mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 align="center" class="card-title"></h5>
                            <p class="card-text">
                            <form action="Import" id="formSave" method="POST" enctype="multipart/form-data"
                                class="row g-3 needs-validation" novalidate>
                                <div class="row">
                                    <div class="col-md-12">
                                        ຍອມລວມ <br>
                                        <h5 style="color: #CE3131;"> <?php echo number_format($amount,2) ?> ກີບ</h5>
                                    </div>
                                    <hr size="3" align="center" width="100%">
                                    <div class="col-md-12 form-group">
                                        <label>ຜູ້ສະໜອງ</label>
                                        <select name="sup_id_import" id="sup_id_import"
                                            class="selectcenter form-control" required>
                                            <option value="" disabled selected>--- ເລືອກຜູ້ສະໜອງ ---</option>
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
                                    <div class="col-md-12 form-group">
                                        <label>ເລກທີໃບນຳເຂົ້າ</label>
                                        <input type="text" id="import_no" class="form-control" name="import_no"
                                            placeholder="ເລກທີໃບນຳເຂົ້າ" required>
                                            <div class="invalid-feedback">
                                            ກະລຸນາປ້ອນເລກທີໃບນຳເຂົ້າ
                                        </div>
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <label>ເລກທີໃບສັ່ງຊື້</label>
                                        <input type="text" id="order_id_import" class="form-control"
                                            name="order_id_import" placeholder="ເລກທີໃບສັ່ງຊື້" required>
                                            <div class="invalid-feedback">
                                            ກະລຸນາປ້ອນເລກທີໃບນຳເຂົ້າ
                                        </div>
                                    </div>
                                    <div class="col-md-12" align="center">
                                        <input type="hidden" name="btnStock" id="btnStock">
                                        <button type="button" name="btnAdd" class="btn btn-outline-success"
                                            data-toggle="modal" data-target="#exampleModal2">ບັນທຶກການນຳເຂົ້າ</button>
                                        <div class="modal fade font14" id="exampleModal2" tabindex="-1" role="dialog"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">ຢຶນຢັນ</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body" align="center">
                                                        ທ່ານຕ້ອງການບັນທຶກການນຳເຂົ້າສິນຄ້າ ຫຼື ບໍ່ ?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-outline-secondary"
                                                            data-dismiss="modal">ຍົກເລີກ</button>
                                                        <button type="submit" name="btnSave" id="btnSave"
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
                            </form>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- /.content-wrapper -->
<br>

<!-- modal form delete -->
<form action="Import" id="formDelete_cookie_one" method="POST" enctype="multipart/form-data">
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
                    <input type="hidden" id="cookie_pro_id_import" name="cookie_pro_id_import">
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
<form action="Import" id="formClear" method="POST" enctype="multipart/form-data">
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
                    <input type="hidden" id="btnClear_import" name="btnClear_import">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">ຍົກເລີກ</button>
                    <button type="submit" name="btnclear_Import" id="btnclear_Import"
                        class="btn btn-outline-danger">ລ້າງລາຍການ <span class="" id="load_Clear"></span>
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
  if(isset($_GET['order'])=='wrong'){
    echo'<script type="text/javascript">
    swal("", "ເລກທີໃບສັ່ງຊື້ບໍ່ຖືກຕ້ອງ ຫຼື ເລກທີ່ໃບສັ່ງຊື້ບໍ່ໄດ້ຮັບການອະນຸມັດ", "error");
    </script>';
  }
  if(isset($_GET['product'])=='null'){
    echo'<script type="text/javascript">
    swal("", "ລະຫັດສິນຄ້າບໍ່ຖືກຕ້ອງ", "info");
    </script>';
  }
  ?>
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
        $('#cookie_pro_id_import').val(data[3]);
    });
       
});
// }
</script>
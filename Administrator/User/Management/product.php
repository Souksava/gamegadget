<?php
  $title = "ຈັດການຂໍ້ມູນສິນຄ້າ";
  $path = "../../";
  $links = "../";
  $session_path = "../../";
  include (''.$path.'header-footer/header.php');
?>
<div style="text-align: right;">
    <a href="#" align="right" data-toggle="modal" data-target="#exampleModalInsertEmp">
        <img src="<?php echo $path ?>/icon/add.ico" alt="" width="30px">
    </a>
</div>
<form action="Product" method="POST" id="formSaveEmp" enctype="multipart/form-data" class="row g-3 needs-validation"
    novalidate>
    <div class="modal fade" id="exampleModalInsertEmp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ເພີ່ມຂໍ້ມູນສິນຄ້າ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row" align="left">
                        <div class="col-md-12 form-group">
                            <label for="" class="">ລະຫັດສິນຄ້າ</label>
                            <input type="text" class="form-control" name="pro_id" id="pro_id" value=""
                                placeholder="ລະຫັດສິນຄ້າ" required>
                            <div class="invalid-feedback">
                                ກະລຸນາປ້ອນລະຫັດສິນຄ້າ
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="" class="">ຊື່ສິນຄ້າ</label>
                            <input type="text" class="form-control" name="pro_name" id="pro_name" value=""
                                placeholder="ຊື່ສິນຄ້າ" required>
                            <div class="invalid-feedback">
                                ກະລຸນາປ້ອນຊື່ສິນຄ້າ
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="" class="">ຈຳນວນ</label>
                            <input type="text" class="form-control" name="qty" id="qty" value="" placeholder="ຈຳນວນ"
                                required>
                            <div class="invalid-feedback">
                                ກະລຸນາປ້ອນຈຳນວນ
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="" class="">ລາຄາ</label>
                            <input type="text" class="form-control" name="price" id="price" value="" placeholder="ລາຄາ"
                                required>
                            <div class="invalid-feedback">
                                ກະລຸນາປ້ອນລາຄາ
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="" class="">ປະເພດສິນຄ້າ</label>
                            <select name="cated_id" id="cated_id" class="form-control" required>
                                <option value="">ເລືອກປະເພດສິນຄ້າ</option>
                                <?php
                                    $select_cate = mysqli_query($conn,"call select_categorydetail();");
                                    foreach($select_cate as $row_cate){
                                ?>
                                <option value="<?php echo $row_cate["cated_id"] ?>">
                                    <?php echo $row_cate["cated_name"] ?></option>
                                <?php 
                                    }
                                    mysqli_free_result($select_cate);  
                                    mysqli_next_result($conn);
                                ?>
                            </select>
                            <div class="invalid-feedback">
                                ກະລຸນເລືອກປະເພດສິນຄ້າ
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="" class="">ຫົວໜ່ວຍສິນຄ້າ</label>
                            <select name="unit_id" id="unit_id" class="form-control" required>
                                <option value="">ເລືອກຫົວໜ່ວຍສິນຄ້າ</option>
                                <?php
                                    $select_unit = mysqli_query($conn,"call select_unit();");
                                    foreach($select_unit as $row_unit){
                                ?>
                                <option value="<?php echo $row_unit["unit_id"] ?>"><?php echo $row_unit["unit_name"] ?>
                                </option>
                                <?php 
                                    }
                                    mysqli_free_result($select_unit);  
                                    mysqli_next_result($conn);
                                ?>
                            </select>
                            <div class="invalid-feedback">
                                ກະລຸນາເລືອກຫົວໜ່ວຍສິນຄ້າ
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="" class="">ຍີ່ຫໍ້ສິນຄ້າ</label>
                            <select name="brand_id" id="brand_id" class="form-control" required>
                                <option value="">ເລືອກຍີ່ຫໍ້ສິນຄ້າ</option>
                                <?php
                                    $select_brand = mysqli_query($conn,"call select_brand();");
                                    foreach($select_brand as $row_brand){
                                ?>
                                <option value="<?php echo $row_brand["brand_id"] ?>">
                                    <?php echo $row_brand["brand_name"] ?></option>
                                <?php 
                                    }
                                    mysqli_free_result($select_brand);  
                                    mysqli_next_result($conn);
                                ?>
                            </select>
                            <div class="invalid-feedback">
                                ກະລຸນາເລືອກຍີ່ຫໍ້ສິນຄ້າ
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="" class="">ເວລາຮັບປະກັນ</label>
                            <input type="text" class="form-control" name="guarantee" id="guarantee" value=""
                                placeholder="ເວລາຮັບປະກັນ" required>
                            <div class="invalid-feedback">
                                ກະລຸນາເວລາຮັບປະກັນ
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="" class="">ຫົວໜ່ວຍເວລາ</label>
                            <select name="type" id="type" class="form-control" required>
                                <option value="">ເລືອກຫົວໜ່ວຍເວລາ</option>
                                <option value="ວັນ">ວັນ</option>
                                <option value="ເດືອນ">ເດືອນ</option>
                                <option value="ປີ">ປີ</option>
                            </select>
                            <div class="invalid-feedback">
                                ກະລຸນາເລືອກຫົວໜ່ວຍເວລາ
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="" class="">ໂປຼໂມຊັນ ຫຼື ສ່ວນຫຼຸດ</label>
                            <input type="text" name="promotion" id="promotion" class="form-control" value=""
                                placeholder="ໂປຼໂມຊັນ ຫຼື ສ່ວນຫຼຸດ" required>
                            <div class="invalid-feedback">
                                ກະລຸນາປ້ອນໂປໂມຊັນ
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="" class="">ເງື່ອນໄຂການສັ່ງຊື້</label>
                            <input type="text" class="form-control" name="qtyalert" id="qtyalert" value=""
                                placeholder="ເງື່ອນໄຂການສັ່ງຊື້" required>
                            <div class="invalid-feedback">
                                ກະລຸນາປ້ອນເງື່ອນໄຂການສັ່ງຊື້
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="" class="">ສະຖານະສິນຄ້າ</label>
                            <select name="status" id="status" class="form-control" required>
                                <option value="">ເລືອກສະຖານະສິນຄ້າ</option>
                                <option value="Normal">Normal</option>
                                <option value="Hot">Hot</option>
                                <option value="Best Seller">Best Seller</option>
                                <option value="Top View">Top View</option>
                            </select>
                            <div class="invalid-feedback">
                                ກະລຸນາເລືອກສະຖານະສິນຄ້າ
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <label>ຮູບພາບ</label>
                            <input type="file" class="form-control" name="img_path" id="img_path"
                                onchange="loadFile(event)">
                        </div>
                        <div class="col-md-12 col-sm-6 form-control2">
                            <img src="../../image/camera.jpg" id="output" width="100%" height="250">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">ຍົກເລີກ</button>
                    <button type="submit" name="btnSave" id="btnSave" class="btn btn-outline-primary" onclick="">
                        ເພີ່ມຂໍ້ມູນ
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
<form action="Product" method="POST" id="formUpdate" enctype="multipart/form-data" class="row g-3 needs-validation"
    novalidate>
    <div class="modal fade" id="exampleModalUpdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ແກ້ໄຂຂໍ້ມູນສິນຄ້າ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row" align="left">
                        <div class="col-md-12 form-group">
                            <label for="" class="">ຊື່ສິນຄ້າ</label>
                            <input type="hidden" name="pro_id_update" id="pro_id_update">
                            <input type="text" class="form-control" name="pro_name_update" id="pro_name_update" value=""
                                placeholder="ຊື່ສິນຄ້າ" required>
                            <div class="invalid-feedback">
                                ກະລຸນາປ້ອນຊື່ສິນຄ້າ
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="" class="">ຈຳນວນ</label>
                            <input type="number" class="form-control" name="qty_update" id="qty_update" value=""
                                placeholder="ຈຳນວນ" required>
                            <div class="invalid-feedback">
                                ກະລຸນາປ້ອນຈຳນວນ
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="" class="">ລາຄາ</label>
                            <input type="number" min="0" class="form-control" name="price_update" id="price_update"
                                value="" placeholder="ລາຄາ" required>
                            <div class="invalid-feedback">
                                ກະລຸນາປ້ອນລາຄາ
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="" class="">ປະເພດສິນຄ້າ</label>
                            <select name="cated_id_update" id="cated_id_update" class="form-control" required>
                                <option value="">ເລືອກປະເພດສິນຄ້າ</option>
                                <?php
                                    $select_cate = mysqli_query($conn,"call select_categorydetail();");
                                    foreach($select_cate as $row_cate){
                                ?>
                                <option value="<?php echo $row_cate["cated_id"] ?>">
                                    <?php echo $row_cate["cated_name"] ?></option>
                                <?php 
                                    }
                                    mysqli_free_result($select_cate);  
                                    mysqli_next_result($conn);
                                ?>
                            </select>
                            <div class="invalid-feedback">
                                ກະລຸນເລືອກປະເພດສິນຄ້າ
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="" class="">ຫົວໜ່ວຍສິນຄ້າ</label>
                            <select name="unit_id_update" id="unit_id_update" class="form-control" required>
                                <option value="">ເລືອກຫົວໜ່ວຍສິນຄ້າ</option>
                                <?php
                                    $select_unit = mysqli_query($conn,"call select_unit();");
                                    foreach($select_unit as $row_unit){
                                ?>
                                <option value="<?php echo $row_unit["unit_id"] ?>"><?php echo $row_unit["unit_name"] ?>
                                </option>
                                <?php 
                                    }
                                    mysqli_free_result($select_unit);  
                                    mysqli_next_result($conn);
                                ?>
                            </select>
                            <div class="invalid-feedback">
                                ກະລຸນາເລືອກຫົວໜ່ວຍສິນຄ້າ
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="" class="">ຍີ່ຫໍ້ສິນຄ້າ</label>
                            <select name="brand_id_update" id="brand_id_update" class="form-control" required>
                                <option value="">ເລືອກຍີ່ຫໍ້ສິນຄ້າ</option>
                                <?php
                                    $select_brand = mysqli_query($conn,"call select_brand();");
                                    foreach($select_brand as $row_brand){
                                ?>
                                <option value="<?php echo $row_brand["brand_id"] ?>">
                                    <?php echo $row_brand["brand_name"] ?></option>
                                <?php 
                                    }
                                    mysqli_free_result($select_brand);  
                                    mysqli_next_result($conn);
                                ?>
                            </select>
                            <div class="invalid-feedback">
                                ກະລຸນາເລືອກຍີ່ຫໍ້ສິນຄ້າ
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="" class="">ເວລາຮັບປະກັນ</label>
                            <input type="number" class="form-control" name="guarantee_update" id="guarantee_update"
                                value="" placeholder="ເວລາຮັບປະກັນ" required>
                            <div class="invalid-feedback">
                                ກະລຸນາເວລາຮັບປະກັນ
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="" class="">ຫົວໜ່ວຍເວລາ</label>
                            <select name="type_update" id="type_update" class="form-control" required>
                                <option value="">ເລືອກຫົວໜ່ວຍເວລາ</option>
                                <option value="ວັນ">ວັນ</option>
                                <option value="ເດືອນ">ເດືອນ</option>
                                <option value="ປີ">ປີ</option>
                            </select>
                            <div class="invalid-feedback">
                                ກະລຸນາເລືອກຫົວໜ່ວຍເວລາ
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="" class="">ໂປຼໂມຊັນ ຫຼື ສ່ວນຫຼຸດ</label>
                            <input type="number" name="promotion_update" id="promotion_update" class="form-control"
                                value="" placeholder="ໂປຼໂມຊັນ ຫຼື ສ່ວນຫຼຸດ" required>
                            <div class="invalid-feedback">
                                ກະລຸນາປ້ອນໂປຼໂມຊັນ
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="" class="">ເງື່ອນໄຂການສັ່ງຊື້</label>
                            <input type="number" class="form-control" name="qtyalert_update" id="qtyalert_update" value=""
                                placeholder="ເງື່ອນໄຂການສັ່ງຊື້" required>
                            <div class="invalid-feedback">
                                ກະລຸນາປ້ອນເງື່ອນໄຂການສັ່ງຊື້
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="" class="">ສະຖານະສິນຄ້າ</label>
                            <select name="status_update" id="status_update" class="form-control" required>
                                <option value="Normal">Normal</option>
                                <option value="Hot">Hot</option>
                                <option value="Best Seller">Best Seller</option>
                                <option value="Top View">Top View</option>
                            </select>
                            <div class="invalid-feedback">
                                ກະລຸນາເລືອກສະຖານະສິນຄ້າ
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <label>ຮູບພາບ</label>
                            <input type="file" class="form-control" name="img_path_update" id="img_path_update"
                                onchange="loadFile2(event)">
                        </div>
                        <div class="col-md-12 col-sm-6 form-control2">
                            <img src="../../image/camera.jpg" id="output2" width="100%" height="250">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">ຍົກເລີກ</button>
                    <button type="submit" name="btnUpdate" id="btnUpdate" class="btn btn-outline-success" onclick="">
                        ແກ້ໄຂຂໍ້ມູນ
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
<form action="Product" id="formDelete" method="POST" enctype="multipart/form-data">
    <div class="table-responsive">
        <div id="toolbar">
            <div class="input-group mb-3">
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModalDelete">
                    <i class="fa fa-trash"></i> ລົບ</button>
            </div>
        </div>

        <table id="table" data-pagination="true" data-search="true" data-toolbar="#toolbar" data-advanced-search="true"
            data-click-to-select="true" data-id-table="advancedTable" data-show-columns="true" data-resizable="true"
            data-id-field="id" data-page-list="[10, 25, 50, 100, all]" data-search-highlight="true"
            style="width: 1800px;">
            <thead>
                <tr>
                    <th data-field="state" data-checkbox="true"></th>
                    <th style="width: 50px;text-align: center;">ເຄື່ອງມື</th>
                    <th>No.</th>
                    <th class="display_none"></th>
                    <th class="display_none"></th>
                    <th class="display_none"></th>
                    <th class="display_none"></th>
                    <th class="display_none"></th>
                    <th class="display_none"></th>
                    <th data-sortable="true">ສິນຄ້າ</th>
                    <th data-field="id" data-sortable="true">ລະຫັດ</th>
                    <th data-field="name" data-sortable="true">ຊື່ສິນຄ້າ</th>
                    <th data-field="qty" data-sortable="true">ຈຳນວນ</th>
                    <th data-field="price" data-sortable="true">ລາຄາ</th>
                    <th data-field="total" data-sortable="true">ລວມ</th>
                    <th data-field="discount" data-sortable="true">ສ່ວນຫຼຸດ</th>
                    <th data-field="varanty" data-sortable="true">ຮັບປະກັນ</th>
                    <th data-field="qtyalert" data-sortable="true">ເງື່ອນໄຂການສັ່ງຊື້</th>
                    <th data-field="status" data-sortable="true">ສະຖານະສິນຄ້າ</th>
                    <th class="display_none"></th>
                    <th class="display_none"></th>
                    <th class="display_none"></th>
                    <th class="display_none"></th>
                </tr>
            </thead>
            <tbody>
                <?php 
                  $no_ = 0;
                  $select_product = mysqli_query($conn,"call select_product();");
                  foreach($select_product as $row){
                  $no_ ++;
                  $total = $row["qty"] * $row["price"];
            ?>
                <tr>
                    <td></td>
                    <td class="icon-center">
                        <a href="#" class="fa fa-pen toolcolor btnUpdate_emp" onclick="modal_update()"></a>&nbsp; &nbsp;
                    </td>
                    <td><?php echo $no_; ?></td>
                    <td class="display_none"><?php echo $row["img_path"] ?></td>
                    <td class="display_none"><?php echo $row["cated_id"] ?></td>
                    <td class="display_none"><?php echo $row["brand_id"] ?></td>
                    <td class="display_none"><?php echo $row["unit_id"] ?></td>
                    <td class="display_none"><?php echo $row["pro_name"] ?></td>
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
                    <td><?php echo $row["cated_name"] ?> <?php echo $row["brand_name"] ?> <?php echo $row["pro_name"] ?>
                    </td>
                    <td><?php echo $row["qty"] ?> <?php echo $row["unit_name"] ?></td>
                    <td><?php echo number_format($row["price"],2) ?></td>
                    <td><?php echo number_format($total,2) ?></td>
                    <td><?php echo number_format($row["promotion"],2) ?></td>
                    <td><?php echo $row["guarantee"] ?> <?php echo $row["type"] ?></td>
                    <td><?php echo $row["qtyalert"] ?></td>
                    <td><?php echo $row["status"] ?></td>
                    <td class="display_none"><?php echo $row["price"] ?></td>
                    <td class="display_none"><?php echo $row["guarantee"] ?></td>
                    <td class="display_none"><?php echo $row["type"] ?></td>
                    <td class="display_none"><?php echo $row["promotion"] ?></td>
                </tr>
                <?php 
                }
                mysqli_free_result($select_product);  
                mysqli_next_result($conn);
            ?>
            </tbody>
        </table>
    </div>
    <div class="modal fade" id="exampleModalDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                    <input type="hidden" name="id" id="id">
                    ທ່ານຕ້ອງການລົບຂໍ້ມູນ ຫຼື ບໍ່ ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">ຍົກເລີກ</button>
                    <button type="submit" name="btnDelete" id="btnDelete" class="btn btn-outline-danger ">
                        ລົບ
                        <span class="" id="load_delete"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
</div>
<?php
 include (''.$path.'header-footer/footer.php');
 if(isset($_POST['btnSave'])){
    $pro_id = $_POST['pro_id'];
    $pro_name = $_POST['pro_name'];
    $qty = $_POST['qty'];
    $price = $_POST['price'];
    $cate_id = $_POST['cated_id'];
    $unit_id = $_POST['unit_id'];
    $brand_id = $_POST['brand_id'];
    $guarantee = $_POST['guarantee'];
    $type = $_POST['type'];
    $promotion = $_POST['promotion'];
    $qtyalert = $_POST['qtyalert'];
    $status = $_POST['status'];
        $resultckid = mysqli_query($conn,"select * from product where pro_id='$pro_id';");
        if(mysqli_num_rows($resultckid) > 0){
            echo"<script>";
            echo"window.location.href='Product?proid=same';";
            echo"</script>";
        }
        else {
            if($_FILES["img_path"]["name"] == ""){
                $pro_img = "";
            }
            else{
            $ext = pathinfo(basename($_FILES["img_path"]["name"]), PATHINFO_EXTENSION);
            $new_image_name = "img_".uniqid().".".$ext;
            $image_path = "../../image/";
            $upload_path = $image_path.$new_image_name;
            move_uploaded_file($_FILES["img_path"]["tmp_name"], $upload_path);
            $pro_img = $new_image_name;
            }
            $resultinsert = mysqli_query($conn, "insert into product(pro_id,pro_name,qty,price,cated_id,unit_id,brand_id,guarantee,type,promotion,qtyalert,img_path,status) values('$pro_id','$pro_name','$qty','$price','$cate_id','$unit_id','$brand_id','$guarantee','$type','$promotion','$qtyalert','$pro_img','$status')");
            if(!$resultinsert){
                echo"<script>";
                echo"window.location.href='Product?save=fail';";
                echo"</script>";
            }
            else {
                echo"<script>";
                echo"window.location.href='Product?save2=success';";
                echo"</script>";
            }
        }
}


 if(isset($_POST["btnDelete"])){
    $logic = 0;
        if(isset($_POST["btSelectItem"])){
            foreach($_POST["btSelectItem"] as $checkid){
                $Check_Product = mysqli_query($conn,"select * from selldetail where pro_id='$checkid'");
                if(mysqli_num_rows($Check_Product) > 0){
                    $logic = 1;
                    echo"<script>";
                    echo"window.location.href='Product?Checkdelete=true&&sells=$checkid';";
                    echo"</script>";
                    break;
                }
                $Check_import = mysqli_query($conn,"select * from imports where pro_id='$checkid'");
                if(mysqli_num_rows($Check_import) > 0){
                    $logic = 1;
                    echo"<script>";
                    echo"window.location.href='Product?Checkdelete=true&&imports=$checkid';";
                    echo"</script>";
                    break;
                }
                $Check_orderdetail = mysqli_query($conn,"select * from orderdetail where pro_id='$checkid'");
                if(mysqli_num_rows($Check_orderdetail) > 0){
                    $logic = 1;
                    echo"<script>";
                    echo"window.location.href='Product?Checkdelete=true&&orders=$checkid';";
                    echo"</script>";
                    break;
                }
            }
            if($logic == 0){
                $delete = 0;
                foreach($_POST["btSelectItem"] as $id){
                    $resultsec = mysqli_query($conn, "select img_path from product where pro_id='$id'"); 
                    $data = mysqli_fetch_array($resultsec, MYSQLI_ASSOC);
                    $path2 = __DIR__.DIRECTORY_SEPARATOR.'../../image'.DIRECTORY_SEPARATOR.$data['img_path'];
                    if(file_exists($path2) && !empty($data['img_path'])){
                        unlink($path2);
                    }
                    $delete_many = mysqli_query($conn,"call delete_product('$id')");
                    if(!$delete_many){
                        $delete = 1;
                        echo"<script>";
                        echo"window.location.href='Product?del=fail';";
                        echo"</script>";
                    }
                    mysqli_free_result($delete_many);  
                    mysqli_next_result($conn);
                }
                if($delete == 0){
                    echo"<script>";
                    echo"window.location.href='Product?del2=success';";
                    echo"</script>";
                }
                
            }
        }
        else{
            echo"<script>";
            echo"window.location.href='Product?Checkbox=null';";
            echo"</script>";
        }
}

if(isset($_POST['btnUpdate'])){
    $pro_id_update = trim($_POST['pro_id_update']);
    $pro_name_update = $_POST['pro_name_update'];
    $qty_update = $_POST['qty_update'];
    $price_update = $_POST['price_update'];
    $cated_id_update = $_POST['cated_id_update'];
    $unit_id_update = $_POST['unit_id_update'];
    $brand_id_update = $_POST['brand_id_update'];
    $guarantee_update = $_POST['guarantee_update'];
    $type_update = $_POST['type_update'];
    $promotion_update = $_POST['promotion_update'];
    $qtyalert_update = $_POST['qtyalert_update'];
    $status_update = $_POST['status_update'];
        if($_FILES['img_path_update']['name'] == ""){
            $resultupdate = mysqli_query($conn,"call update_product('$pro_id_update','$qty_update','$price_update','$cated_id_update','$unit_id_update','$brand_id_update','$guarantee_update','$type_update','$promotion_update','$qtyalert_update','$status_update','$pro_name_update')");
            if(!$resultupdate){
                echo"<script>";
                echo"window.location.href='Product?update=fail';";
                echo"</script>";
            }
            else {
                echo"<script>";
                echo"window.location.href='Product?update2=success';";
                echo"</script>";
            }
        }
        else {
            //ເມື່ອປ່ຽນຮູບພາບແລ້ວລົບພາບເກົ່າ
            $resultsec = mysqli_query($conn, "select img_path from product where pro_id='$pro_id_update';");
            $data2 = mysqli_fetch_array($resultsec, MYSQLI_ASSOC);
            $path = __DIR__.DIRECTORY_SEPARATOR.'../../image'.DIRECTORY_SEPARATOR.$data2['img_path'];
            if(file_exists($path) && !empty($data2['img_path'])){
                unlink($path);
            }
            //ສິ້ນສຸດ
            //ຕັ້ງຊື່ຮູບພາບອັດຕະໂນມັດ
            $ext = pathinfo(basename($_FILES['img_path_update']['name']), PATHINFO_EXTENSION);
            $new_image_name = 'img_'.uniqid().".".$ext;
            $image_path = "../../image/";
            $upload_path = $image_path.$new_image_name;
            move_uploaded_file($_FILES['img_path_update']['tmp_name'], $upload_path);
            $pro_image = $new_image_name;
            //ສິນສຸດການຕັ້ງຊື່
            $resultupdate = mysqli_query($conn,"call update_product2('$pro_id_update','$qty_update','$price_update','$cated_id_update','$unit_id_update','$brand_id_update','$guarantee_update','$type_update','$promotion_update','$qtyalert_update','$status_update','$pro_name_update','$pro_image')");
            // $resultupdate = mysqli_query($conn, "update product set pro_name='$pro_name_update',qty='$qty_update',price='$price_update',cated_id='$cated_id_update',unit_id='$unit_id_update',brand_id='$brand_id_update',guarantee='$guarantee_update',type='$type_update',promotion='$promotion_update',qtyalert='$qtyalert_update',img_path='$pro_image',status='$status_update' where pro_id='$pro_id_update';");
            if(!$resultupdate){
                echo"<script>";
                echo"window.location.href='Product?update=fail';";
                echo"</script>";
            }
            else {
                echo"<script>";
                echo"window.location.href='Product?update2=success';";
                echo"</script>";
            }
        }
}


if(isset($_GET["Checkbox"])=="null"){
    echo'<script type="text/javascript">
    swal("", "ກະລຸນາເລືອກລາຍການກ່ອນ !", "info");
    </script>';
  }  
if(isset($_GET["proid"])=="same"){
    echo'<script type="text/javascript">
    swal("", "ລະຫັດສິນຄ້ານີ້ມີຢູ່ແລ້ວ ກະລຸນາປ້ອນລະຫັດສິນຄ້າທີ່ແຕກຕ່າງ !", "info");
    </script>';
  }  
if(isset($_GET["save"])=="fail"){
    echo'<script type="text/javascript">
    swal("", "ບັນທຶກຂໍ້ມູນຜິດພາດ !", "error");
    </script>';
  }  
  if(isset($_GET["save2"])=="success"){
    echo'<script type="text/javascript">
    swal("", "ບັນທຶກຂໍ້ມູນສຳເລັດ !", "success");
    </script>';
  }  
  if(isset($_GET["update"])=="fail"){
    echo'<script type="text/javascript">
    swal("", "ແກ້ໄຂຂໍ້ມູນຜິດພາດ !", "error");
    </script>';
  }  
  if(isset($_GET["update2"])=="success"){
    echo'<script type="text/javascript">
    swal("", "ແກ້ໄຂຂໍ້ມູນສຳເລັດ !", "success");
    </script>';
  }  
  if(isset($_GET["del"])=="fail"){
    echo'<script type="text/javascript">
    swal("", "ລົບຂໍ້ມູນຜິດພາດ !", "error");
    </script>';
  }  
  if(isset($_GET["del2"])=="success"){
    echo'<script type="text/javascript">
    swal("", "ລົບຂໍ້ມູນສຳເລັດ !", "success");
    </script>';
  }  
  if(isset($_GET["order"])=="has"){
    echo'<script type="text/javascript">
    swal("", "ບໍ່ສາມາດລົບຂໍ້ມູນໄດ້ ເນື່ອງລະຫັດສິນຄ້ານີ້ໄດ້ເຄື່ອນໄຫວການສັ່ງຊື້ແລ້ວ !", "error");
    </script>';
  }  
  if(isset($_GET["import"])=="has"){
    echo'<script type="text/javascript">
    swal("", "ບໍ່ສາມາດລົບຂໍ້ມູນໄດ້ ເນື່ອງລະຫັດສິນຄ້ານີ້ໄດ້ເຄື່ອນໄຫວການນຳເຂົ້າສິນຄ້າແລ້ວ !", "error");
    </script>';
  }  
  if(isset($_GET["sell"])=="has"){
    echo'<script type="text/javascript">
    swal("", "ບໍ່ສາມາດລົບຂໍ້ມູນໄດ້ ເນື່ອງລະຫັດສິນຄ້ານີ້ໄດ້ເຄື່ອນໄຫວການຂາຍສິນຄ້າແລ້ວ !", "error");
    </script>';
  } 
  if(isset($_GET["Checkdelete"])=="true" && isset($_GET["orders"])){
    $msg = $_GET["orders"];
    echo'<script type="text/javascript">
    swal("", "ບໍ່ສາມາດລົບຂໍ້ມູນໄດ້ເນື່ອງຈາກລະຫັດສິນຄ້າ: '.$msg.' ນີ້ມີຢູ່ໃນຕາຕະລາງການສັ່ງຊື້ແລ້ວ ", "error");
    </script>';
  }   
  if(isset($_GET["Checkdelete"])=="true" && isset($_GET["delete"])){
    $msg = $_GET["delete"];
    echo'<script type="text/javascript">
    swal("", "ບໍ່ສາມາດລົບຂໍ້ມູນໄດ້ເນື່ອງຈາກລະຫັດສິນຄ້າ: '.$msg.' ໄດ້ເຄື່ອນໄຫວໃນຕາຕະລາງອື່ນແລ້ວ ", "error");
    </script>';
  }   
  if(isset($_GET["Checkdelete"])=="true" && isset($_GET["imports"])){
    $msg = $_GET["imports"];
    echo'<script type="text/javascript">
    swal("", "ບໍ່ສາມາດລົບຂໍ້ມູນໄດ້ເນື່ອງຈາກລະຫັດສິນຄ້າ: '.$msg.' ນີ້ມີຢູ່ໃນຕາຕະລາງການນຳເຂົ້າສິນຄ້າແລ້ວ ", "error");
    </script>';
  }   
  if(isset($_GET["Checkdelete"])=="true" && isset($_GET["sells"])){
    $msg = $_GET["sells"];
    echo'<script type="text/javascript">
    swal("", "ບໍ່ສາມາດລົບຂໍ້ມູນໄດ້ເນື່ອງຈາກລະຫັດສິນຄ້າ: '.$msg.' ນີ້ມີຢູ່ໃນຕາຕະລາງການຂາຍສິນຄ້າແລ້ວ ", "error");
    </script>';
  }   
?>
<script>
$(function() {
    $('#table').bootstrapTable();
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
function modal_update() {
    $(document).ready(function() {
        $('.btnUpdate_emp').on('click', function() {
            // $('#table').bootstrapTable();
            $('#exampleModalUpdate').modal('show');
            $tr = $(this).closest('tr');
            var data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();

            console.log(data);
            $('#cated_id_update').val(data[4]);
            $('#brand_id_update').val(data[5]);
            $('#unit_id_update').val(data[6]);
            $('#pro_name_update').val(data[7]);
            $('#qty_update').val(data[8]);
            $('#pro_id_update').val(data[10]);
            $('#guarantee_update').val(data[20]);
            $('#promotion_update').val(data[22]);
            $('#qtyalert_update').val(data[17]);
            $('#status_update').val(data[18]);
            $('#price_update').val(data[19]);
            $('#type_update').val(data[21]);
            if (data[3] === '') {
                document.getElementById("output2").src = ('../../image/camera.jpg');
            } else {
                document.getElementById("output2").src = ('../../image/' + data[3]);
            }
        });
    });
}
</script>
<script>
var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
        URL.revokeObjectURL(output.src) // free memory
    }
};
var loadFile2 = function(event) {
    var output2 = document.getElementById('output2');
    output2.src = URL.createObjectURL(event.target.files[0]);
    output2.onload = function() {
        URL.revokeObjectURL(output2.src) // free memory
    }
};
</script>
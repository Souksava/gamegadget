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
<form action="Username" method="POST" id="formSaveEmp" enctype="multipart/form-data" class="row g-3 needs-validation"
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
                            <input type="text" class="form-control" name="emp_id" id="emp_id" value=""
                                placeholder="ລະຫັດສິນຄ້າ" required>
                            <div class="invalid-feedback">
                                ກະລຸນາປ້ອນລະຫັດສິນຄ້າ
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="" class="">ຊື່ສິນຄ້າ</label>
                            <input type="text" class="form-control" name="emp_id" id="emp_id" value=""
                                placeholder="ຊື່ສິນຄ້າ" required>
                            <div class="invalid-feedback">
                                ກະລຸນາປ້ອນຊື່ສິນຄ້າ
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="" class="">ຈຳນວນ</label>
                            <input type="text" class="form-control" name="emp_id" id="emp_id" value=""
                                placeholder="ຈຳນວນ" required>
                            <div class="invalid-feedback">
                                ກະລຸນາປ້ອນຈຳນວນ
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="" class="">ລາຄາ</label>
                            <input type="text" class="form-control" name="emp_id" id="emp_id" value=""
                                placeholder="ລາຄາ" required>
                            <div class="invalid-feedback">
                                ກະລຸນາປ້ອນລາຄາ
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="" class="">ປະເພດສິນຄ້າ</label>
                            <select name="" id="" class="form-control">
                                <option value="">ເລືອກປະເພດສິນຄ້າ</option>
                                <option value="ຫູຝັງ Bluetooth & Wireless">ຫູຝັງ Bluetooth & Wireless</option>
                                <option value="">ລຳໂພງ ຄອມພິວເຕີ</option>
                            </select>
                            <div class="invalid-feedback">
                                ກະລຸນເລືອກປະເພດສິນຄ້າ
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="" class="">ຫົວໜ່ວຍສິນຄ້າ</label>
                            <select name="" id="" class="form-control">
                                <option value="">ເລືອກຫົວໜ່ວຍສິນຄ້າ</option>
                                <option value="ຫູຝັງ Bluetooth & Wireless">ກ່ອງ</option>
                                <option value="">ໜ່ວຍ</option>
                            </select>
                            <div class="invalid-feedback">
                                ກະລຸນາເລືອກຫົວໜ່ວຍສິນຄ້າ
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="" class="">ຍີ່ຫໍ້ສິນຄ້າ</label>
                            <select name="" id="" class="form-control">
                                <option value="">ເລືອກຍີ່ຫໍ້ສິນຄ້າ</option>
                                <option value="ຫູຝັງ Bluetooth & Wireless">ກ່ອງ</option>
                                <option value="">ໜ່ວຍ</option>
                            </select>
                            <div class="invalid-feedback">
                                ກະລຸນາເລືອກຍີ່ຫໍ້ສິນຄ້າ
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="" class="">ເວລາຮັບປະກັນ</label>
                            <input type="text" class="form-control" name="emp_id" id="emp_id" value=""
                                placeholder="ເວລາຮັບປະກັນ">
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="" class="">ຫົວໜ່ວຍເວລາ</label>
                            <select name="" id="" class="form-control">
                                <option value="">ເລືອກຫົວໜ່ວຍເວລາ</option>
                                <option value="">ວັນ</option>
                                <option value="">ເດືອນ</option>
                                <option value="">ປີ</option>
                            </select>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="" class="">ໂປຼໂມຊັນ ຫຼື ສ່ວນຫຼຸດ</label>
                            <input type="text" class="form-control" name="emp_id" id="emp_id" value=""
                                placeholder="ໂປຼໂມຊັນ ຫຼື ສ່ວນຫຼຸດ">
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="" class="">ເງື່ອນໄຂການສັ່ງຊື້</label>
                            <input type="text" class="form-control" name="emp_id" id="emp_id" value=""
                                placeholder="ເງື່ອນໄຂການສັ່ງຊື້" required>
                            <div class="invalid-feedback">
                                ກະລຸນາປ້ອນເງື່ອນໄຂການສັ່ງຊື້
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="" class="">ສະຖານະສິນຄ້າ</label>
                            <select name="" id="" class="form-control">
                                <option value="">ເລືອກສະຖານະສິນຄ້າ</option>
                                <option value="">Normal</option>
                                <option value="">Hot</option>
                                <option value="">Best Seller</option>
                                <option value="">Top View</option>
                            </select>
                            <div class="invalid-feedback">
                                ກະລຸນາເລືອກສະຖານະສິນຄ້າ
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <label>ຮູບພາບ</label>
                            <input type="file" class="form-control" name="profile_path" id="profile_path"
                                onchange="loadFile(event)">
                        </div>
                        <div class="col-md-12 col-sm-6 form-control2">
                            <img src="../../image/camera.jpg" id="output" width="100%" height="250">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">ຍົກເລີກ</button>
                    <button type="submit" name="btn_loadSave" id="btn_loadSave" class="btn btn-outline-primary"
                        onclick="">
                        ເພີ່ມຂໍ້ມູນ
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
<form action="Employee" method="POST" id="formUpdate" enctype="multipart/form-data" class="row g-3 needs-validation"
    novalidate>
    <div class="modal fade" id="exampleModalUpdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ແກ້ໄຂຂໍ້ມູນຫົວໜ່ວຍ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row" align="left">
                        <div class="col-md-12 form-group">
                            <label for="" class="">ລະຫັດສິນຄ້າ</label>
                            <input type="text" class="form-control" name="emp_id" id="emp_id" value=""
                                placeholder="ລະຫັດສິນຄ້າ" required>
                            <div class="invalid-feedback">
                                ກະລຸນາປ້ອນລະຫັດສິນຄ້າ
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="" class="">ຊື່ສິນຄ້າ</label>
                            <input type="text" class="form-control" name="emp_id" id="emp_id" value=""
                                placeholder="ຊື່ສິນຄ້າ" required>
                            <div class="invalid-feedback">
                                ກະລຸນາປ້ອນຊື່ສິນຄ້າ
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="" class="">ຈຳນວນ</label>
                            <input type="text" class="form-control" name="emp_id" id="emp_id" value=""
                                placeholder="ຈຳນວນ" required>
                            <div class="invalid-feedback">
                                ກະລຸນາປ້ອນຈຳນວນ
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="" class="">ລາຄາ</label>
                            <input type="text" class="form-control" name="emp_id" id="emp_id" value=""
                                placeholder="ລາຄາ" required>
                            <div class="invalid-feedback">
                                ກະລຸນາປ້ອນລາຄາ
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="" class="">ປະເພດສິນຄ້າ</label>
                            <select name="" id="" class="form-control">
                                <option value="">ເລືອກປະເພດສິນຄ້າ</option>
                                <option value="ຫູຝັງ Bluetooth & Wireless">ຫູຝັງ Bluetooth & Wireless</option>
                                <option value="">ລຳໂພງ ຄອມພິວເຕີ</option>
                            </select>
                            <div class="invalid-feedback">
                                ກະລຸນເລືອກປະເພດສິນຄ້າ
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="" class="">ຫົວໜ່ວຍສິນຄ້າ</label>
                            <select name="" id="" class="form-control">
                                <option value="">ເລືອກຫົວໜ່ວຍສິນຄ້າ</option>
                                <option value="ຫູຝັງ Bluetooth & Wireless">ກ່ອງ</option>
                                <option value="">ໜ່ວຍ</option>
                            </select>
                            <div class="invalid-feedback">
                                ກະລຸນາເລືອກຫົວໜ່ວຍສິນຄ້າ
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="" class="">ຍີ່ຫໍ້ສິນຄ້າ</label>
                            <select name="" id="" class="form-control">
                                <option value="">ເລືອກຍີ່ຫໍ້ສິນຄ້າ</option>
                                <option value="ຫູຝັງ Bluetooth & Wireless">ກ່ອງ</option>
                                <option value="">ໜ່ວຍ</option>
                            </select>
                            <div class="invalid-feedback">
                                ກະລຸນາເລືອກຍີ່ຫໍ້ສິນຄ້າ
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="" class="">ເວລາຮັບປະກັນ</label>
                            <input type="text" class="form-control" name="emp_id" id="emp_id" value=""
                                placeholder="ເວລາຮັບປະກັນ">
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="" class="">ຫົວໜ່ວຍເວລາ</label>
                            <select name="" id="" class="form-control">
                                <option value="">ເລືອກຫົວໜ່ວຍເວລາ</option>
                                <option value="">ວັນ</option>
                                <option value="">ເດືອນ</option>
                                <option value="">ປີ</option>
                            </select>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="" class="">ໂປຼໂມຊັນ ຫຼື ສ່ວນຫຼຸດ</label>
                            <input type="text" class="form-control" name="emp_id" id="emp_id" value=""
                                placeholder="ໂປຼໂມຊັນ ຫຼື ສ່ວນຫຼຸດ">
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="" class="">ເງື່ອນໄຂການສັ່ງຊື້</label>
                            <input type="text" class="form-control" name="emp_id" id="emp_id" value=""
                                placeholder="ເງື່ອນໄຂການສັ່ງຊື້" required>
                            <div class="invalid-feedback">
                                ກະລຸນາປ້ອນເງື່ອນໄຂການສັ່ງຊື້
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="" class="">ສະຖານະສິນຄ້າ</label>
                            <select name="" id="" class="form-control">
                                <option value="">ເລືອກສະຖານະສິນຄ້າ</option>
                                <option value="">Normal</option>
                                <option value="">Hot</option>
                                <option value="">Best Seller</option>
                                <option value="">Top View</option>
                            </select>
                            <div class="invalid-feedback">
                                ກະລຸນາເລືອກສະຖານະສິນຄ້າ
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <label>ຮູບພາບ</label>
                            <input type="file" class="form-control" name="profile_path" id="profile_path"
                                onchange="loadFile(event)">
                        </div>
                        <div class="col-md-12 col-sm-6 form-control2">
                            <img src="../../image/camera.jpg" id="output" width="100%" height="250">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">ຍົກເລີກ</button>
                    <button type="submit" name="btn_loadSave" id="btn_loadSave" class="btn btn-outline-success"
                        onclick="">
                        ແກ້ໄຂຂໍ້ມູນ
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>

<div class="table-responsive">
    <div id="toolbar">
        <div class="input-group mb-3">
            <button type="submit" class="btn btn-danger" data-toggle="modal" data-target="#exampleModalDelete">
                <i class="fa fa-trash"></i> ລົບ</button>
        </div>
    </div>

    <table id="table" data-pagination="true" data-search="true" data-toolbar="#toolbar" data-advanced-search="true"
        data-click-to-select="true" data-id-table="advancedTable" data-show-columns="true" data-resizable="true"
        data-id-field="name" data-page-list="[10, 25, 50, 100, all]" data-search-highlight="true"
        style="width: 1800px;">
        <thead>
            <tr>
                <th data-field="state" data-checkbox="true"></th>
                <th style="width: 50px;text-align: center;">ເຄື່ອງມື</th>
                <th>No.</th>
                <th data-sortable="true">ສິນຄ້າ</th>
                <th data-field="id" data-sortable="true">ລະຫັດ</th>
                <th data-field="name" data-sortable="true">ຊື່ສິນຄ້າ</th>
                <th data-field="category" data-sortable="true">ປະເພດສິນຄ້າ</th>
                <th data-field="brand" data-sortable="true">ຍີ່ຫໍ້</th>
                <th data-field="qty" data-sortable="true">ຈຳນວນ</th>
                <th data-field="price" data-sortable="true">ລາຄາ</th>
                <th data-field="discount" data-sortable="true">ສ່ວນຫຼຸດ</th>
                <th data-field="varanty" data-sortable="true">ຮັບປະກັນ</th>
                <th data-field="qtyalert" data-sortable="true">ເງື່ອນໄຂການສັ່ງຊື້</th>
                <th data-field="status" data-sortable="true">ສະຖານະສິນຄ້າ</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td></td>
                <td style="width: 50px;text-align: center;">
                    <a href="#" data-toggle="modal" data-target="#exampleModalUpdate"
                        class="fa fa-pen toolcolor btnUpdate_emp"></a>&nbsp; &nbsp;
                </td>
                <td>1</td>
                <td> <a href="<?php echo $path;?>image/img_5f1beac4d3794.jpeg" target="_blank">
                        <img src="<?php echo $path;?>image/img_5f1beac4d3794.jpeg" class="img-circle elevation-2" alt=""
                            width="50px">
                    </a>
                </td>
                <td>0311000101</td>
                <td>HG13 CHIEF</td>
                <td>ຫູຟັງ ຫູຟັງ Headset & Earphones</td>
                <td>Fantech</td>
                <td>1 ກ່ອງ</td>
                <td>300,000.00</td>
                <td>101,000.00</td>
                <td>2 ປີ</td>
                <td>1</td>
                <td>HOT</td>
            </tr>
        </tbody>
    </table>
</div>
<form action="employee" id="formDelete" method="POST" enctype="multipart/form-data">
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
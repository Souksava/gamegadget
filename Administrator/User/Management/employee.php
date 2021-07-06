<?php
  $title = "ຈັດການຂໍ້ມູນພະນັກງານ";
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
                    <h5 class="modal-title" id="exampleModalLabel">ເພີ່ມຂໍ້ມູນພະນັກງານ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row" align="left">
                        <div class="col-md-12 form-group">
                            <label for="" class="">ລະຫັດພະນັກງານ</label>
                            <input type="text" class="form-control" name="emp_id" id="emp_id" value=""
                                placeholder="ລະຫັດພະນັກງານ" required>
                            <div class="invalid-feedback">
                                ກະລຸນາປ້ອນລະຫັດພະນັກງານ
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="" class="">ຊື່ພະນັກງານ</label>
                            <input type="text" class="form-control" name="emp_name" id="emp_name" value=""
                                placeholder="ຊື່ພະນັກງານ" required>
                            <div class="invalid-feedback">
                                ກະລຸນາປ້ອນຊື່ພະນັກງານ
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <label>ນາມສະກຸນ</label>
                            <input type="text" class="form-control" name="surname" id="surname" value=""
                                placeholder="ນາມສະກຸນ">
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="" class="">ນາມສະກຸນ</label>
                            <select class="form-control" name="emp_id" id="emp_id" required>
                                <option value="">ເລືອກເພດ</option>
                                <option value="ຍິງ">ຍິງ</option>
                                <option value="ຊາຍ">ຊາຍ</option>
                            </select>
                            <div class="invalid-feedback">
                                ກະລຸນາເລືອກເພດ
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <label>ວັນເດືອນປີເກີດ</label>
                            <input type="date" class="form-control" name="dob" id="dob" value="">
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="" class="">ທີ່ຢູ່ປັດຈຸບັນ</label>
                            <textarea class="form-control" name="address" id="address" cols="30" rows="5"
                                placeholder="ທີ່ຢູ່ປັດຈຸບັນ" required></textarea>
                            <div class="invalid-feedback">
                                ກະລຸນາປ້ອນທີ່ຢູ່ປັດຈຸບັນ
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="" class="">ອີເມວ</label>
                            <input type="type" class="form-control" name="email" id="email" value="" placeholder="ອີເມວ"
                                required>
                            <div class="invalid-feedback">
                                ກະລຸນາປ້ອນຊື່ອີເມວ
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="" class="">ລະຫັດເຂົ້າໃຊ້ລະບົບ</label>
                            <input type="password" class="form-control" name="pass" id="pass" value=""
                                placeholder="ລະຫັດເຂົ້າໃຊ້ລະບົບ" required>
                            <div class="invalid-feedback">
                                ກະລຸນາປ້ອນລະຫັດເຂົ້າໃຊ້ລະບົບ
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="" class="">ສະຖານະຜູ້ໃຊ້ລະບົບ</label>
                            <select class="form-control" name="status_id" id="status_id" required>
                                <option value="">ເລືອກສະຖານະຜູ້ໃຊ້ລະບົບ</option>
                                <option value="ຍິງ">ເຈົ້າຂອງຮ້ານ</option>
                                <option value="ຊາຍ">ພະນັກງານຂາຍ</option>
                                <option value="ຊາຍ">ປິດການໃຊ້ງານ</option>
                            </select>
                            <div class="invalid-feedback">
                                ກະລຸນາເລືອກເພດ
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
                    <h5 class="modal-title" id="exampleModalLabel">ແກ້ໄຂຂໍ້ມູນພະນັກງານ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row" align="left">
                        <div class="col-md-12 form-group">
                            <label for="" class="">ຊື່ພະນັກງານ</label>
                            <input type="text" class="form-control" name="emp_name" id="emp_name" value=""
                                placeholder="ຊື່ພະນັກງານ" required>
                            <div class="invalid-feedback">
                                ກະລຸນາປ້ອນຊື່ພະນັກງານ
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <label>ນາມສະກຸນ</label>
                            <input type="text" class="form-control" name="surname" id="surname" value=""
                                placeholder="ນາມສະກຸນ">
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="" class="">ນາມສະກຸນ</label>
                            <select class="form-control" name="emp_id" id="emp_id" required>
                                <option value="">ເລືອກເພດ</option>
                                <option value="ຍິງ">ຍິງ</option>
                                <option value="ຊາຍ">ຊາຍ</option>
                            </select>
                            <div class="invalid-feedback">
                                ກະລຸນາເລືອກເພດ
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <label>ວັນເດືອນປີເກີດ</label>
                            <input type="date" class="form-control" name="dob" id="dob" value="">
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="" class="">ທີ່ຢູ່ປັດຈຸບັນ</label>
                            <textarea class="form-control" name="address" id="address" cols="30" rows="5"
                                placeholder="ທີ່ຢູ່ປັດຈຸບັນ" required></textarea>
                            <div class="invalid-feedback">
                                ກະລຸນາປ້ອນທີ່ຢູ່ປັດຈຸບັນ
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="" class="">ອີເມວ</label>
                            <input type="type" class="form-control" name="email" id="email" value="" placeholder="ອີເມວ"
                                required>
                            <div class="invalid-feedback">
                                ກະລຸນາປ້ອນຊື່ອີເມວ
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="" class="">ລະຫັດເຂົ້າໃຊ້ລະບົບ</label>
                            <input type="password" class="form-control" name="pass" id="pass" value=""
                                placeholder="ລະຫັດເຂົ້າໃຊ້ລະບົບ" required>
                            <div class="invalid-feedback">
                                ກະລຸນາປ້ອນລະຫັດເຂົ້າໃຊ້ລະບົບ
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="" class="">ສະຖານະຜູ້ໃຊ້ລະບົບ</label>
                            <select class="form-control" name="status_id" id="status_id" required>
                                <option value="">ເລືອກສະຖານະຜູ້ໃຊ້ລະບົບ</option>
                                <option value="ຍິງ">ເຈົ້າຂອງຮ້ານ</option>
                                <option value="ຊາຍ">ພະນັກງານຂາຍ</option>
                                <option value="ຊາຍ">ປິດການໃຊ້ງານ</option>
                            </select>
                            <div class="invalid-feedback">
                                ກະລຸນາເລືອກເພດ
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
            <!-- 
            <input type="text" class="form-control" id="inCus" placeholder="ຄົ້ນຫາ ຊື່ ແລະ ນາມສະກຸນ"
                aria-label="Recipient's username" aria-describedby="basic-addon2">
            <div class="input-group-append">
                <button class="btn btn-outline-success" type="button"><i class="fas fa-search"></i></button>
            </div>
            &nbsp; &nbsp; -->
            <button type="submit" class="btn btn-danger" data-toggle="modal" data-target="#exampleModalDelete"><i
                    class="fa fa-trash"></i> ລົບ</button>
        </div>
    </div>

    <table id="table" data-pagination="true" data-search="true" data-toolbar="#toolbar" data-advanced-search="true"
        data-click-to-select="true" data-id-table="advancedTable" data-show-columns="true" data-resizable="true"
        data-id-field="name" data-page-list="[10, 25, 50, 100, all]" data-search-highlight="true"
        style="width: 2000px;">
        <thead>
            <tr>
                <th data-field="state" data-checkbox="true"></th>
                <th style="width: 50px;">ເຄື່ອງມື</th>
                <th>No.</th>
                <th data-field="id" data-sortable="true">ລະຫັດພະນັກງານ</th>
                <th data-field="name" data-sortable="true">ຊື່ພະນັກງານ</th>
                <th data-field="surname" data-sortable="true">ນາມສະກຸນ</th>
                <th data-field="gender" data-sortable="true">ເພດ</th>
                <th data-field="name" data-sortable="true">ວັນເດືອນປີເກີດ</th>
                <th data-field="tel" data-sortable="true">ເບີໂທລະສັບ</th>
                <th data-field="address" data-sortable="true">ທີ່ຢູ່ປັດຈຸບັນ</th>
                <th data-field="email" data-sortable="true">ທີ່ຢູ່ອີເມວ</th>
                <th data-field="password" data-sortable="true">ລະຫັດເຂົ້າໃຊ້ລະບົບ</th>
                <th data-field="auther" data-sortable="true">ສິດເຂົ້າໃຊ້ລະບົບ</th>
                <th data-field="picture" data-sortable="true">ຮູບພາບ</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td></td>
                <td>
                    <a href="#" data-toggle="modal" data-target="#exampleModalUpdate"
                        class="fa fa-pen toolcolor btnUpdate_emp"></a>&nbsp; &nbsp;
                </td>
                <td>1</td>
                <td>001</td>
                <td>ນົບພະລັດ</td>
                <td>ໄຊຍະວົງ</td>
                <td>ຊາຍ</td>
                <td>10/01/1997</td>
                <td>020 5583 2233</td>
                <td>ບ້ານ ດອນດອຍ ເມືອງສີສັດຕະນາກ ນະຄອນຫຼວງວຽງຈັນ</td>
                <td>nopphalat@gmail.com</td>
                <td>sdf295sdfsjg203452233TE24ef</td>
                <td>ເຈົ້າຂອງຮ້ານ</td>
                <td> <a href="<?php echo $path;?>image/image.jpeg" target="_blank">
                        <img src="<?php echo $path;?>image/image.jpeg" class="img-circle elevation-2" alt=""
                            width="50px">
                    </a></td>
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
})()
</script>
<script>
var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
        URL.revokeObjectURL(output.src) // free memory
    }
};
</script>
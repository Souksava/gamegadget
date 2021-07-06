<?php
  $title = "ຈັດການຂໍ້ມູນໝວດໝູ່ສິນຄ້າ";
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
                    <h5 class="modal-title" id="exampleModalLabel">ເພີ່ມຂໍ້ມູນໝວດໝູ່ສິນຄ້າ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row" align="left">
                        <div class="col-md-12 form-group">
                            <label for="" class="">ຊື່ໝວດໝູ່</label>
                            <input type="text" class="form-control" name="emp_id" id="emp_id" value=""
                                placeholder="ຊື່ໝວດໝູ່" required>
                            <div class="invalid-feedback">
                                ກະລຸນາປ້ອນຊື່ຊື່ໝວດໝູ່ສິນຄ້າ
                            </div>
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
                    <h5 class="modal-title" id="exampleModalLabel">ແກ້ໄຂຂໍ້ມູນໝວດໝູ່</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row" align="left">
                        <div class="col-md-12 form-group">
                            <label for="" class="">ຊື່ໝວດໝູ່</label>
                            <input type="text" class="form-control" name="emp_id" id="emp_id" value=""
                                placeholder="ຊື່ໝວດໝູ່" required>
                            <div class="invalid-feedback">
                                ກະລຸນາປ້ອນຊື່ຊື່ໝວດໝູ່ສິນຄ້າ
                            </div>
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
        data-id-field="name" data-page-list="[10, 25, 50, 100, all]" data-search-highlight="true" style="width: 1000px;">
        <thead>
            <tr>
                <th data-field="state" data-checkbox="true"></th>
                <th style="width: 50px;">ເຄື່ອງມື</th>
                <th>No.</th>
                <th data-field="id" data-sortable="true">ລະຫັດ</th>
                <th data-field="name" data-sortable="true">ຊື່ໝວດໝູ່</th>
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
                <td>1</td>
                <td>ຫູຝັງ</td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <a href="#" data-toggle="modal" data-target="#exampleModalUpdate"
                        class="fa fa-pen toolcolor btnUpdate_emp"></a>&nbsp; &nbsp;
                </td>
                <td>2</td>
                <td>2</td>
                <td>ລຳໂພງ</td>
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
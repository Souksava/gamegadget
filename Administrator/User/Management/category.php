<?php
  $title = "ຈັດການຂໍ້ມູນປະເພດສິນຄ້າ";
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
<form action="Category" method="POST" id="formSaveEmp" enctype="multipart/form-data" class="row g-3 needs-validation"
    novalidate>
    <div class="modal fade" id="exampleModalInsertEmp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ເພີ່ມຂໍ້ມູນປະເພດສິນຄ້າ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row" align="left">
                        <div class="col-md-12 form-group">
                            <label for="" class="">ຊື່ປະເພດສິນຄ້າ</label>
                            <input type="text" class="form-control" name="cated_name" id="cated_name" value=""
                                placeholder="ຊື່ປະເພດສິນຄ້າ" required>
                            <div class="invalid-feedback">
                                ກະລຸນາປ້ອນຊື່ປະເພດສິນຄ້າ
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="" class="">ຊື່ໝວດໝູ່ສິນຄ້າ</label>
                            <select name="cate_id" id="cate_id" class="form-control" required>
                                <option value="">ເລືອກໝວດໝູ່</option>
                                <?php
                                $type = mysqli_query($conn,"call select_category()");
                                foreach($type as $rowtype){
                                ?>
                                <option value="<?php echo $rowtype["cate_id"] ?>"><?php echo $rowtype["cate_name"] ?>
                                </option>
                                <?php
                                }
                                mysqli_free_result($type);  
                                mysqli_next_result($conn);
                            ?>
                            </select>
                            <div class="invalid-feedback">
                                ກະລຸນາເລືອກໝວດໝູ່ສິນຄ້າ
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">ຍົກເລີກ</button>
                    <button type="submit" name="btnSave" id="btn_loadSave" class="btn btn-outline-primary" onclick="">
                        ເພີ່ມຂໍ້ມູນ
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
<form action="Category" method="POST" id="formUpdate" enctype="multipart/form-data" class="row g-3 needs-validation"
    novalidate>
    <div class="modal fade" id="exampleModalUpdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ແກ້ໄຂຂໍ້ມູນປະເພດ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row" align="left">
                        <div class="col-md-12 form-group">
                            <label for="" class="">ຊື່ປະເພດສິນຄ້າ</label>
                            <input type="text" class="form-control" name="cated_name_update" id="cated_name_update"
                                value="" placeholder="ຊື່ປະເພດສິນຄ້າ" required>
                            <input type="hidden" name="cated_id_update" id="cated_id_update">
                            <div class="invalid-feedback">
                                ກະລຸນາປ້ອນຊື່ປະເພດສິນຄ້າ
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="" class="">ຊື່ໝວດໝູ່ສິນຄ້າ</label>
                            <select name="cate_id_update" id="cate_id_update" class="form-control" required>
                                <option value="">ເລືອກໝວດໝູ່</option>
                                <?php
                                $type_update = mysqli_query($conn,"call select_category()");
                                foreach($type_update as $rowtype_update){
                                ?>
                                <option value="<?php echo $rowtype_update["cate_id"] ?>">
                                    <?php echo $rowtype_update["cate_name"] ?></option>
                                <?php
                                }
                                mysqli_free_result($type_update);  
                                mysqli_next_result($conn);
                            ?>
                            </select>
                            <div class="invalid-feedback">
                                ກະລຸນາເລືອກໝວດໝູ່ສິນຄ້າ
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">ຍົກເລີກ</button>
                    <button type="submit" name="btnUpdate" id="btn_loadSave" class="btn btn-outline-success" onclick="">
                        ແກ້ໄຂຂໍ້ມູນ
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
<form action="Category" id="formDelete" method="POST" enctype="multipart/form-data">
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
            style="width: 1000px;">
            <thead>
                <tr>
                    <th data-field="state" data-checkbox="true"></th>
                    <th style="width: 50px;">ເຄື່ອງມື</th>
                    <th>No.</th>
                    <th data-field="id" data-sortable="true">ລະຫັດ</th>
                    <th class="display_none"></th>
                    <th data-field="name" data-sortable="true">ຊື່ປະເພດສິນຄ້າ</th>
                    <th data-field="type" data-sortable="true">ຊື່ໝວດໝູ່</th>
                </tr>
            </thead>
            <tbody>
                <?php
                  $no_ = 0;
                $select_category = mysqli_query($conn,"call select_categorydetail();");
                foreach($select_category as $row){
                $no_ ++;
            ?>
                <tr>
                    <td></td>
                    <td>
                        <a href="#" class="fa fa-pen toolcolor btnUpdate_emp" onclick="modal_update();"></a>&nbsp;
                        &nbsp;
                    </td>
                    <td><?php echo $no_; ?></td>
                    <td><?php echo $row["cated_id"]; ?></td>
                    <td class="display_none"><?php echo $row["cate_id"]; ?></td>
                    <td><?php echo $row["cated_name"]; ?></td>
                    <td><?php echo $row["cate_name"]; ?></td>
                </tr>
                <?php
                }
                mysqli_free_result($select_category);  
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
    $cate_name = $_POST['cated_name']; 
    $cate_id = $_POST['cate_id'];
        $sqlckid = "select * from categorydetail where cated_name='$cate_name';";
        $resultckid = mysqli_query($conn,$sqlckid);
        if(mysqli_num_rows($resultckid) > 0){
            echo"<script>";
            echo"window.location.href='Category?category=same';";
            echo"</script>";
        }
        else {
            $sqlinsert = "insert into categorydetail(cated_name,cate_id) values('$cate_name','$cate_id');";
            $resultinsert = mysqli_query($conn, $sqlinsert);
            if(!$resultinsert){
                echo"<script>";
                echo"window.location.href='Category?save=fail';";
                echo"</script>";
            }
            else {
                echo"<script>";
                echo"window.location.href='Category?save2=success';";
                echo"</script>";
            }
        }
}
if(isset($_POST['btnUpdate'])){
    $cated_id = $_POST['cated_id_update'];
    $cate_name = $_POST['cated_name_update']; 
    $cate_id = $_POST['cate_id_update'];
    $resultupdate = mysqli_query($conn, "update categorydetail set cated_name='$cate_name',cate_id='$cate_id' where cated_id='$cated_id';");
    if(!$resultupdate){
        echo"<script>";
        echo"window.location.href='Category?update=fail';";
        echo"</script>";
    }
    else {
        echo"<script>";
        echo"window.location.href='Category?update2=success';";
        echo"</script>";
    }
}
if(isset($_POST["btnDelete"])){
    $logic = 0;
        if(isset($_POST["btSelectItem"])){
            foreach($_POST["btSelectItem"] as $checkid){
                $Check_Product = mysqli_query($conn,"select * from product where cated_id='$checkid'");
                if(mysqli_num_rows($Check_Product) > 0){
                    $logic = 1;
                    echo"<script>";
                    echo"window.location.href='Category?Checkdelete=true&&idtable=$checkid';";
                    echo"</script>";
                    break;
                }
            }
            if($logic == 0){
                $delete = 0;
                foreach($_POST["btSelectItem"] as $id){
                    $delete_many = mysqli_query($conn,"call delete_categorydetail('$id')");
                    if(!$delete_many){
                        $delete = 1;
                        echo"<script>";
                        echo"window.location.href='Category?del=fail';";
                        echo"</script>";
                        break;
                    }
                    mysqli_free_result($delete_many);  
                    mysqli_next_result($conn);
                }
                if($delete == 0){
                    echo"<script>";
                    echo"window.location.href='Category?del2=success';";
                    echo"</script>";
                }
                
            }
        }
        else{
            echo"<script>";
            echo"window.location.href='Category?Checkbox=null';";
            echo"</script>";
        }
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
  if(isset($_GET["category"])=="product"){
    echo'<script type="text/javascript">
    swal("", "ບໍ່ສາມາດລົບຂໍ້ມູນໄດ້ເນື່ອງຈາກປະເພດສິນຄ້ານີ້ມີຢູ່ໃນສິນຄ້າແລ້ວ !", "error");
    </script>';
  }  
  if(isset($_GET["Checkbox"])=="null"){
    echo'<script type="text/javascript">
    swal("", "ກະລຸນາເລືອກລາຍການກ່ອນ !", "info");
    </script>';
  }  
  if(isset($_GET["Checkdelete"])=="true"){
    $msg = $_GET["idtable"];
    echo'<script type="text/javascript">
    swal("", "ບໍ່ສາມາດລົບຂໍ້ມູນໄດ້ເນື່ອງຈາກລະຫັດປະເພດສິນຄ້າ: '.$msg.' ນີ້ມີຢູ່ໃນຕາຕະລາງສິນຄ້າແລ້ວ ", "error");
    </script>';
  }  
if(isset($_GET["category"])=="same"){
    echo'<script type="text/javascript">
    swal("", "ບໍ່ສາມາດບັນທຶກຂໍ້ມູນໄດ້ ເນື່ອງຈາກປະເພດສິນຄ້ານີ້ມີຢູ່ແລ້ວ !", "info");
    </script>';
  }  
  if(isset($_GET["save"])=="fail"){
    echo'<script type="text/javascript">
    swal("", "ບໍ່ສາມາດບັນທຶກຂໍ້ມູນໄດ້ !", "error");
    </script>';
  }  
  if(isset($_GET["save2"])=="success"){
    echo'<script type="text/javascript">
    swal("", "ບັນທຶກຂໍ້ມູນສຳເລັດ !", "success");
    </script>';
  }  
  if(isset($_GET["update"])=="fail"){
    echo'<script type="text/javascript">
    swal("", "ບໍ່ສາມາດແກ້ໄຂຂໍ້ມູນໄດ້ !", "error");
    </script>';
  }  
  if(isset($_GET["update2"])=="success"){
    echo'<script type="text/javascript">
    swal("", "ແກ້ໄຂຂໍ້ມູນສຳເລັດ !", "success");
    </script>';
  }  
?>
<script>
$(function() {
    $('#table').bootstrapTable();
});
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
            $('#cated_id_update').val(data[3]);
            $('#cate_id_update').val(data[4]);
            $('#cated_name_update').val(data[5]);
        });
    });
}
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
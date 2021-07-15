<?php
  $title = "ຈັດການຂໍ້ມູນຜູ້ສະໜອງ";
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
<form action="Supplier" method="POST" id="formSaveEmp" enctype="multipart/form-data" class="row g-3 needs-validation"
    novalidate>
    <div class="modal fade" id="exampleModalInsertEmp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ເພີ່ມຂໍ້ມູນຜູ້ສະໜອງ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row" align="left">
                        <div class="col-md-12 form-group">
                            <label for="" class="">ບໍລິສັດ</label>
                            <input type="text" class="form-control" name="company" id="company" value=""
                                placeholder="ບໍລິສັດ" required>
                            <div class="invalid-feedback">
                                ກະລຸນາປ້ອນຊື່ບໍລິສັດ
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="" class="">ເບີໂທລະສັບ</label>
                            <input type="text" class="form-control" name="tel" id="tel" value=""
                                placeholder="ເບີໂທລະສັບ" required>
                            <div class="invalid-feedback">
                                ກະລຸນາປ້ອນເບີໂທລະສັບ
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <label>ເບີແຟັກ</label>
                            <input type="text" class="form-control" name="fax" id="fax" value=""
                                placeholder="ເບີແຟັກ">
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
                            <input type="email" class="form-control" name="email" id="email" value="" placeholder="ອີເມວ"
                                required>
                            <div class="invalid-feedback">
                                ກະລຸນາປ້ອນຊື່ອີເມວ
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">ຍົກເລີກ</button>
                    <button type="submit" name="btnSave" id="btnSave" class="btn btn-outline-primary"
                        onclick="">
                        ເພີ່ມຂໍ້ມູນ
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
<form action="Supplier" method="POST" id="formUpdate" enctype="multipart/form-data" class="row g-3 needs-validation"
    novalidate>
    <div class="modal fade" id="exampleModalUpdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ແກ້ໄຂຂໍ້ມູນຜູ້ສະໜອງ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row" align="left">
                        <div class="col-md-12 form-group">
                            <label for="" class="">ບໍລິສັດ</label>
                            <input type="hidden" name="sup_id_update" id="sup_id_update">
                            <input type="text" class="form-control" name="company_update" id="company_update" value=""
                                placeholder="ບໍລິສັດ" required>
                            <div class="invalid-feedback">
                                ກະລຸນາປ້ອນຊື່ບໍລິສັດ
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="" class="">ເບີໂທລະສັບ</label>
                            <input type="text" class="form-control" name="tel_update" id="tel_update" value=""
                                placeholder="ເບີໂທລະສັບ" required>
                            <div class="invalid-feedback">
                                ກະລຸນາປ້ອນເບີໂທລະສັບ
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <label>ເບີແຟັກ</label>
                            <input type="text" class="form-control" name="fax_update" id="fax_update" value=""
                                placeholder="ເບີແຟັກ">
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="" class="">ທີ່ຢູ່ປັດຈຸບັນ</label>
                            <textarea class="form-control" name="address_update" id="address_update" cols="30" rows="5"
                                placeholder="ທີ່ຢູ່ປັດຈຸບັນ" required></textarea>
                            <div class="invalid-feedback">
                                ກະລຸນາປ້ອນທີ່ຢູ່ປັດຈຸບັນ
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="" class="">ອີເມວ</label>
                            <input type="email" class="form-control" name="email_update" id="email_update" value="" placeholder="ອີເມວ"
                                required>
                            <div class="invalid-feedback">
                                ກະລຸນາປ້ອນຊື່ອີເມວ
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">ຍົກເລີກ</button>
                    <button type="submit" name="btnUpdate" id="btnUpdate" class="btn btn-outline-success"
                        onclick="">
                        ແກ້ໄຂຂໍ້ມູນ
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
<form action="Supplier" id="formDelete" method="POST" enctype="multipart/form-data">
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
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModalDelete"><i
                    class="fa fa-trash"></i> ລົບ</button>
        </div>
    </div>

    <table id="table" data-pagination="true" data-search="true" data-toolbar="#toolbar" data-advanced-search="true"
        data-click-to-select="true" data-id-table="advancedTable" data-show-columns="true" data-resizable="true"
        data-id-field="id" data-page-list="[10, 25, 50, 100, all]" data-search-highlight="true"
        style="width: 1600px;">
        <thead>
            <tr>
                <th data-field="state" data-checkbox="true"></th>
                <th style="width: 50px;">ເຄື່ອງມື</th>
                <th>No.</th>
                <th data-field="id" data-sortable="true">ລະຫັດ</th>
                <th data-field="name" data-sortable="true">ຊື່ບໍລິສັດ</th>
                <th data-field="tel" data-sortable="true">ເບີໂທລະສັບ</th>
                <th data-field="fax" data-sortable="true">ເບີແຟັກ</th>
                <th data-field="address" data-sortable="true">ທີ່ຢູ່ປັດຈຸບັນ</th>
                <th data-field="email" data-sortable="true">ທີ່ຢູ່ອີເມວ</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $no_ = 0;
                $select_sup = mysqli_query($conn,"call select_supplier();");
                foreach($select_sup as $row){
                $no_ ++;
            ?>
            <tr>
                <td></td>
                <td>
                    <a href="#" class="fa fa-pen toolcolor btnUpdate_emp" onclick="modal_update();"></a>&nbsp;
                    &nbsp;
                </td>
                <td><?php echo $no_; ?></td>
                <td><?php echo $row["sup_id"]; ?></td>
                <td><?php echo $row["company"]; ?></td>
                <td><?php echo $row["tel"]; ?></td>
                <td><?php echo $row["fax"]; ?></td>
                <td><?php echo $row["address"]; ?></td>
                <td><?php echo $row["email"]; ?></td>
            </tr>
            <?php
                }
                mysqli_free_result($select_sup);  
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
    $company = $_POST['company'];
    $address = $_POST['address'];
    $tel = $_POST['tel'];
    $fax = $_POST['fax'];
    $email = $_POST['email'];
        $resultckid = mysqli_query($conn,"select * from suppliers where company='$company';");
        if(mysqli_num_rows($resultckid) > 0){
            echo"<script>";
            echo"window.location.href='Supplier?supplier=same';";
            echo"</script>";
        }
        else {
            $resultinsert = mysqli_query($conn, "insert into suppliers(company,address,tel,fax,email) values('$company','$address','$tel','$fax','$email');");
            if(!$resultinsert){
                echo"<script>";
                echo"window.location.href='Supplier?save=fail';";
                echo"</script>";
            }
            else {
                echo"<script>";
                echo"window.location.href='Supplier?save2=success';";
                echo"</script>";
            }
        }
}
if(isset($_POST['btnUpdate'])){
    $sup_id_update = $_POST['sup_id_update'];
    $company_update = $_POST['company_update'];
    $address_update = $_POST['address_update'];
    $tel_update = $_POST['tel_update'];
    $fax_update = $_POST['fax_update'];
    $email_update = $_POST['email_update'];
        $resultupdate = mysqli_query($conn,"update suppliers set company='$company_update',address='$address_update',tel='$tel_update',fax='$fax_update',email='$email_update' where sup_id='$sup_id_update';");
        if(!$resultupdate){
            echo"<script>";
            echo"window.location.href='Supplier?update=fail';";
            echo"</script>";
        }
        else {
            echo"<script>";
            echo"window.location.href='Supplier?update2=success';";
            echo"</script>";
        }               
}
if(isset($_POST["btnDelete"])){
    $logic = 0;
        if(isset($_POST["btSelectItem"])){
            foreach($_POST["btSelectItem"] as $checkid){
                $Check_Product = mysqli_query($conn,"select * from orders where sup_id='$checkid'");
                if(mysqli_num_rows($Check_Product) > 0){
                    $logic = 1;
                    echo"<script>";
                    echo"window.location.href='Supplier?Checkdelete=true&&orders=$checkid';";
                    echo"</script>";
                    break;
                }
                $Check_imp = mysqli_query($conn,"select * from imports where sup_id='$checkid'");
                if(mysqli_num_rows($Check_imp) > 0){
                    $logic = 1;
                    echo"<script>";
                    echo"window.location.href='Supplier?Checkdelete=true&&imports=$checkid';";
                    echo"</script>";
                    break;
                }
            }
            if($logic == 0){
                $delete = 0;
                foreach($_POST["btSelectItem"] as $id){
                    $delete_many = mysqli_query($conn,"call delete_supplier('$id')");
                    if(!$delete_many){
                        $delete = 1;
                        echo"<script>";
                        echo"window.location.href='Supplier?del=fail';";
                        echo"</script>";
                    }
                    mysqli_free_result($delete_many);  
                    mysqli_next_result($conn);
                }
                if($delete == 0){
                    echo"<script>";
                    echo"window.location.href='Supplier?del2=success';";
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
if(isset($_GET["Checkdelete"])=="true" && isset($_GET["imports"])){
    $msg = $_GET["imports"];
    echo'<script type="text/javascript">
    swal("", "ບໍ່ສາມາດລົບຂໍ້ມູນໄດ້ເນື່ອງຈາກລະຫັດຜູ້ສະໜອງ: '.$msg.' ນີ້ມີຢູ່ໃນຕາຕະລາງການນຳເຂົ້າສິນຄ້າແລ້ວ ", "error");
    </script>';
  }   
  if(isset($_GET["Checkdelete"])=="true" && isset($_GET["orders"])){
    $msg = $_GET["orders"];
    echo'<script type="text/javascript">
    swal("", "ບໍ່ສາມາດລົບຂໍ້ມູນໄດ້ເນື່ອງຈາກລະຫັດຜູ້ສະໜອງ: '.$msg.' ນີ້ມີຢູ່ໃນຕາຕະລາງການສັ່ງຊື້ແລ້ວ ", "error");
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
  if(isset($_GET["Checkbox"])=="null"){
    echo'<script type="text/javascript">
    swal("", "ກະລຸນາເລືອກລາຍການກ່ອນ !", "info");
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
  if(isset($_GET["supplier"])=="same"){
    echo'<script type="text/javascript">
    swal("", "ຊື່ບໍລິສັດນີ້ມີຢູ່ແລ້ວ ກະລຸນາໃສ່ຊື່ທີ່ແຕກຕ່າງ !", "info");
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
})()
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
            $('#sup_id_update').val(data[3]);
            $('#company_update').val(data[4]);
            $('#tel_update').val(data[5]);
            $('#fax_update').val(data[6]);
            $('#address_update').val(data[7]);
            $('#email_update').val(data[8]);



        });
    });
}
</script>
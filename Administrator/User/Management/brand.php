<?php
  $title = "ຈັດການຂໍ້ມູນຍີ່ຫໍ້ສິນຄ້າ";
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
<form action="Brand" method="POST" id="formSaveEmp" enctype="multipart/form-data" class="row g-3 needs-validation"
    novalidate>
    <div class="modal fade" id="exampleModalInsertEmp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ເພີ່ມຂໍ້ມູນຍີ່ຫໍ້ສິນຄ້າ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row" align="left">
                        <div class="col-md-12 form-group">
                            <label for="" class="">ຊື່ຍີ່ຫໍ້ສິນຄ້າ</label>
                            <input type="text" class="form-control" name="brand_name" id="brand_name" value=""
                                placeholder="ຊື່ຍີ່ຫໍ້ສິນຄ້າ" required>
                            <div class="invalid-feedback">
                                ກະລຸນາປ້ອນຊື່ຍີ່ຫໍ້ສິນຄ້າ
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="" class="">ຮູບພາບຍີ່ຫໍ້</label>
                            <input type="file" class="form-control" name="bimg_path" id="bimg_path" onchange="loadFile(event)"
                                value="">
                        </div>
                        <div class="col-md-12 form-group">
                            <img src="<?php echo $path ?>image/camera.jpg" id="output" width="100%" height="250">
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
<form action="Brand" method="POST" id="formUpdate" enctype="multipart/form-data" class="row g-3 needs-validation"
    novalidate>
    <div class="modal fade" id="exampleModalUpdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ແກ້ໄຂຂໍ້ມູນຍີ່ຫໍ້</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row" align="left">
                        <div class="col-md-12 form-group">
                            <label for="" class="">ຊື່ຍີ່ຫໍ້ສິນຄ້າ</label>
                            <input type="text" class="form-control" name="brand_name_update" id="brand_name_update"
                                value="" placeholder="ຊື່ຍີ່ຫໍ້ສິນຄ້າ" required>
                                <input type="hidden" name="brand_id_update" id="brand_id_update">
                            <div class="invalid-feedback">
                                ກະລຸນາປ້ອນຊື່ຍີ່ຫໍ້ສິນຄ້າ
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="" class="">ຮູບພາບຍີ່ຫໍ້</label>
                            <input type="file" class="form-control" name="bimg_path_update" id="bimg_path_update" onchange="loadFile2(event)"
                                value="">
                        </div>
                        <div class="col-md-12 form-group">
                            <img src="<?php echo $path ?>image/camera.jpg" id="output2" width="100%" height="250">
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
<form action="Brand" id="formDelete" method="POST" enctype="multipart/form-data">
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
                    <th class="icon-center" style="width: 50px;text-align: center;">ເຄື່ອງມື</th>
                    <th style="width: 50px;">No.</th>
                    <th style="width: 80px;" data-field="id" data-sortable="true">ລະຫັດ</th>
                    <th class="display_none"></th>
                    <th style="width: 150px;" data-field="name" data-sortable="true">ຊື່ຍີ່ຫໍ້ສິນຄ້າ</th>
                    <th>ຮູບພາບ</th>
                </tr>
            </thead>
            <tbody>
                <?php
                  $no_ = 0;
                  $select_brand = mysqli_query($conn,"call select_brand();");
                  foreach($select_brand as $row){
                  $no_ ++;
            ?>
                <tr>
                    <td></td>
                    <td class="icon-center">
                        <a href="#" class="fa fa-pen toolcolor btnUpdate_emp" onclick="modal_update()"></a>&nbsp; &nbsp;
                    </td>
                    <td style="width: 50px;"><?php echo $no_ ?></td>
                    <td style="width: 80px;"><?php echo $row["brand_id"] ?></td>
                    <td class="display_none"><?php echo $row["bimg_path"] ?></td>
                    <td style="width: 150px;"><?php echo $row["brand_name"] ?></td>
                    <?php
                    if($row["bimg_path"] == ""){
                        $row["bimg_path"] = "image.jpeg";
                    }
                    ?>
                    <td class="icon-center">
                        <a href="<?php echo $path;?>image/<?php echo $row["bimg_path"] ?>" target="_blank">
                            <img src="<?php echo $path;?>image/<?php echo $row["bimg_path"] ?>"
                                class="img-circle elevation-2" alt="" width="50px">
                        </a>
                    </td>
                </tr>
                <?php
                }
                mysqli_free_result($select_brand);  
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
    $brand_name = $_POST['brand_name']; 
    $check_brand = mysqli_query($conn,"select * from brand where brand_name='$brand_name'");
    if(mysqli_num_rows($check_brand) > 0){
        echo"<script>";
        echo"window.location.href='Brand?brand=same';";
        echo"</script>";
    }
    else {
            $ext = pathinfo(basename($_FILES["bimg_path"]["name"]), PATHINFO_EXTENSION);
            $new_image_name = "img_".uniqid().".".$ext;
            $image_path = "../../image/";
            $upload_path = $image_path.$new_image_name;
            move_uploaded_file($_FILES["bimg_path"]["tmp_name"], $upload_path);
            $pro_img = $new_image_name;
            $resultinsert = mysqli_query($conn, "insert into brand(brand_name,bimg_path) values('$brand_name','$pro_img');");
            if(!$resultinsert){
                echo"<script>";
                echo"window.location.href='Brand?save=fail';";
                echo"</script>";
            }
            else {
                echo"<script>";
                echo"window.location.href='Brand?save2=success';";
                echo"</script>";
            }
        }
}
if(isset($_POST['btnUpdate'])){
    $brand_id = $_POST['brand_id_update'];
    $brand_name = $_POST['brand_name_update']; 
        if($_FILES['bimg_path_update']['name'] == ""){
            $resultupdate = mysqli_query($conn,"update brand set brand_name='$brand_name' where brand_id='$brand_id';");
            if(!$resultupdate){
                echo"<script>";
                echo"window.location.href='Brand?update=fail';";
                echo"</script>";
            }
            else {
                echo"<script>";
                echo"window.location.href='Brand?update2=success';";
                echo"</script>";
            }
        }
        else {
            //ເມື່ອປ່ຽນຮູບພາບແລ້ວລົບພາບເກົ່າ
            $resultsec = mysqli_query($conn, "select bimg_path from brand where brand_id='$brand_id';");
            $data2 = mysqli_fetch_array($resultsec, MYSQLI_ASSOC);
            $path = __DIR__.DIRECTORY_SEPARATOR.'../../image'.DIRECTORY_SEPARATOR.$data2['img_path'];
            if(file_exists($path) && !empty($data2['bimg_path'])){
                unlink($path);
            }
            //ສິ້ນສຸດ
            //ຕັ້ງຊື່ຮູບພາບອັດຕະໂນມັດ
            $ext = pathinfo(basename($_FILES['bimg_path_update']['name']), PATHINFO_EXTENSION);
            $new_image_name = 'img_'.uniqid().".".$ext;
            $image_path = "../../image/";
            $upload_path = $image_path.$new_image_name;
            move_uploaded_file($_FILES['bimg_path_update']['tmp_name'], $upload_path);
            $pro_image = $new_image_name;
            //ສິນສຸດການຕັ້ງຊື່
            $sqlupdate = "update brand set brand_name='$brand_name',bimg_path='$pro_image' where brand_id='$brand_id';";
            $resultupdate = mysqli_query($conn,$sqlupdate);
            if(!$resultupdate){
                echo"<script>";
                echo"window.location.href='Brand?update=fail';";
                echo"</script>";
            }
            else {
                echo"<script>";
                echo"window.location.href='Brand?update2=success';";
                echo"</script>";
            }
        }
}
if(isset($_POST["btnDelete"])){
    $logic = 0;
        if(isset($_POST["btSelectItem"])){
            foreach($_POST["btSelectItem"] as $checkid){
                $Check_Product = mysqli_query($conn,"select * from product where brand_id='$checkid'");
                if(mysqli_num_rows($Check_Product) > 0){
                    $logic = 1;
                    echo"<script>";
                    echo"window.location.href='Brand?Checkdelete=true&&idtable=$checkid';";
                    echo"</script>";
                    break;
                }
            }
            if($logic == 0){
                $delete = 0;
                foreach($_POST["btSelectItem"] as $id){
                    $resultsec = mysqli_query($conn, "select bimg_path from brand where brand_id='$id'"); 
                    $data = mysqli_fetch_array($resultsec, MYSQLI_ASSOC);
                    $path2 = __DIR__.DIRECTORY_SEPARATOR.'../../image'.DIRECTORY_SEPARATOR.$data['bimg_path'];
                    if(file_exists($path2) && !empty($data['bimg_path'])){
                        unlink($path2);
                    }
                    $delete_many = mysqli_query($conn,"call delete_brand('$id')");
                    if(!$delete_many){
                        $delete = 1;
                        echo"<script>";
                        echo"window.location.href='Brand?del=fail';";
                        echo"</script>";
                    }
                    mysqli_free_result($delete_many);  
                    mysqli_next_result($conn);
                }
                if($delete == 0){
                    echo"<script>";
                    echo"window.location.href='Brand?del2=success';";
                    echo"</script>";
                }
                
            }
        }
        else{
            echo"<script>";
            echo"window.location.href='Brand?Checkbox=null';";
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
    swal("", "ບໍ່ສາມາດລົບຂໍ້ມູນໄດ້ເນື່ອງຈາກຍີ່ຫໍ້ສິນຄ້ານີ້ມີຢູ່ໃນສິນຄ້າແລ້ວ !", "error");
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
    swal("", "ບໍ່ສາມາດລົບຂໍ້ມູນໄດ້ເນື່ອງຈາກລະຫັດຍີ່ຫໍ້ສິນຄ້າ: '.$msg.' ນີ້ມີຢູ່ໃນຕາຕະລາງສິນຄ້າແລ້ວ ", "error");
    </script>';
  }  
if(isset($_GET["brand"])=="same"){
    echo'<script type="text/javascript">
    swal("", "ບໍ່ສາມາດບັນທຶກຂໍ້ມູນໄດ້ ເນື່ອງຈາກຍີ່ຫໍ້ສິນຄ້ານີ້ມີຢູ່ແລ້ວ !", "info");
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
            $('#brand_id_update').val(data[3]);
            $('#brand_name_update').val(data[5]);

            if (data[4] === '') {
                document.getElementById("output2").src = ('../../image/camera.jpg');
            } else {
                document.getElementById("output2").src = ('../../image/' + data[4]);
            }
        });
    });
}
</script>
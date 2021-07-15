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
<form action="Type" method="POST" id="formSaveEmp" enctype="multipart/form-data" class="row g-3 needs-validation"
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
                            <input type="text" class="form-control" name="cate_name" id="cate_name" value=""
                                placeholder="ຊື່ໝວດໝູ່" required>
                            <div class="invalid-feedback">
                                ກະລຸນາປ້ອນຊື່ໝວດໝູ່ສິນຄ້າ
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="" class="">ຮູບພາບໝວດໝູ່</label>
                            <input type="file" class="form-control" name="img_path" id="img_path"
                                onchange="loadFile(event)" required>
                            <div class="invalid-feedback">
                                ກະລຸນາເລືອກຟາຍຮູບປະເພດ
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <img src="<?php echo $path ?>image/camera.jpg" id="output" width="100%" height="250">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">ຍົກເລີກ</button>
                    <button type="submit" name="btn_Save" id="btn_Save" class="btn btn-outline-primary" onclick="">
                        ເພີ່ມຂໍ້ມູນ
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
<form action="Type" method="POST" id="formUpdate" enctype="multipart/form-data" class="row g-3 needs-validation"
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
                            <input type="hidden" name="cate_id_update" id="cate_id_update" class="cate_id_update">
                            <input type="text" class="form-control" name="cate_name_update" id="cate_name_update"
                                class="cate_name_update" value="" placeholder="ຊື່ໝວດໝູ່" required>
                            <div class="invalid-feedback">
                                ກະລຸນາປ້ອນຊື່ໝວດໝູ່ສິນຄ້າ
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="" class="">ຮູບພາບໝວດໝູ່</label>
                            <input type="file" class="form-control" name="img_path2" id="img_path2" class="img_path2"
                                onchange="loadFile2(event)">
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
<form action="Type" id="formDelete" method="POST" enctype="multipart/form-data">
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
                    <th class="icon-center">ເຄື່ອງມື</th>
                    <th data-field="no" data-sortable="true">No.</th>
                    <th data-field="id" data-sortable="true">ລະຫັດ</th>
                    <th class="display_none"></th>
                    <th>ICON</th>
                    <th data-field="name" data-sortable="true">ຊື່ໝວດໝູ່</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no_ = 0;
                $select_type = mysqli_query($conn,"call select_category()");
                foreach($select_type as $row){
                $no_ ++;
            ?>
                <tr>
                    <!-- data-toggle="modal" data-target="#exampleModalUpdate" -->
                    <td></td>
                    <td class="icon-center">
                        <a href="#" class="fa fa-pen toolcolor btnUpdate_emp" onclick="modal_update()"></a>&nbsp; &nbsp;
                    </td>
                    <td><?php echo $no_ ?></td>
                    <td><?php echo $row["cate_id"] ?></td>
                    <td class="display_none"><?php echo $row["img_path"] ?></td>
                    <?php 
                if($row["img_path"] == ""){
                    $row["img_path"] = "image.jpeg";
                }
                ?>
                    <td class="icon-center">
                        <a href="<?php echo $path;?>image/<?php echo $row["img_path"] ?>" target="_blank">
                            <img src="<?php echo $path;?>image/<?php echo $row["img_path"] ?>"
                                class="img-circle elevation-2" alt="" width="50px">
                        </a>
                    </td>
                    <td><?php echo $row["cate_name"] ?></td>
                </tr>
                <?php
                }
                mysqli_free_result($select_type);  
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
 if(isset($_POST['btn_Save'])){
    $cate_name = $_POST['cate_name']; 
        $resultckid = mysqli_query($conn,"select * from category where cate_name='$cate_name';");
        if(mysqli_num_rows($resultckid) > 0){
            echo"<script>";
            echo"window.location.href='Type?type=same';";
            echo"</script>";
        }
        else {
            $ext = pathinfo(basename($_FILES["img_path"]["name"]), PATHINFO_EXTENSION);
            $new_image_name = "img_".uniqid().".".$ext;
            $image_path = "../../image/";
            $upload_path = $image_path.$new_image_name;
            move_uploaded_file($_FILES["img_path"]["tmp_name"], $upload_path);
            $pro_img = $new_image_name;
            $resultinsert = mysqli_query($conn, "insert into category(cate_name,img_path) values('$cate_name','$pro_img');");
            if(!$resultinsert){
                echo"<script>";
                echo"window.location.href='Type?save=fail';";
                echo"</script>";
            }
            else {
                echo"<script>";
                echo"window.location.href='Type?save2=success';";
                echo"</script>";
            }
        }
}
if(isset($_POST['btnUpdate'])){
    $cate_id = $_POST['cate_id_update'];
    $cate_name = $_POST['cate_name_update']; 
        if($_FILES['img_path2']['name'] == ""){
            $resultupdate = mysqli_query($conn,"update category set cate_name='$cate_name' where cate_id='$cate_id';");
            if(!$resultupdate){
                echo"<script>";
                echo"window.location.href='Type?update=fail';";
                echo"</script>";
            }
            else {
                echo"<script>";
                echo"window.location.href='Type?update2=success';";
                echo"</script>";
            }
        }
        else {
            //ເມື່ອປ່ຽນຮູບພາບແລ້ວລົບພາບເກົ່າ
            $resultsec = mysqli_query($conn, "select img_path from category where cate_id='$cate_id';");
            $data2 = mysqli_fetch_array($resultsec, MYSQLI_ASSOC);
            $path = __DIR__.DIRECTORY_SEPARATOR.'../../image'.DIRECTORY_SEPARATOR.$data2['img_path'];
            if(file_exists($path) && !empty($data2['img_path'])){
                unlink($path);
            }
            //ສິ້ນສຸດ
            //ຕັ້ງຊື່ຮູບພາບອັດຕະໂນມັດ
            $ext = pathinfo(basename($_FILES['img_path2']['name']), PATHINFO_EXTENSION);
            $new_image_name = 'img_'.uniqid().".".$ext;
            $image_path = "../../image/";
            $upload_path = $image_path.$new_image_name;
            move_uploaded_file($_FILES['img_path2']['tmp_name'], $upload_path);
            $pro_image = $new_image_name;
            //ສິນສຸດການຕັ້ງຊື່
            $sqlupdate = "update category set cate_name='$cate_name',img_path='$pro_image' where cate_id='$cate_id';";
            $resultupdate = mysqli_query($conn,$sqlupdate);
            if(!$resultupdate){
                echo"<script>";
                echo"window.location.href='Type?update=fail';";
                echo"</script>";
            }
            else {
                echo"<script>";
                echo"window.location.href='Type?update2=success';";
                echo"</script>";
            }
        }
}
if(isset($_POST["btnDelete"])){
    $logic = 0;
        if(isset($_POST["btSelectItem"])){
            foreach($_POST["btSelectItem"] as $checkid){
                $Check_Product = mysqli_query($conn,"select * from categorydetail where cate_id='$checkid'");
                if(mysqli_num_rows($Check_Product) > 0){
                    $logic = 1;
                    echo"<script>";
                    echo"window.location.href='Type?Checkdelete=true&&idtable=$checkid';";
                    echo"</script>";
                    break;
                }
            }
            if($logic == 0){
                $delete = 0;
                foreach($_POST["btSelectItem"] as $id){
                    $resultsec = mysqli_query($conn, "select img_path from category where cate_id='$id'"); 
                    $data = mysqli_fetch_array($resultsec, MYSQLI_ASSOC);
                    $path2 = __DIR__.DIRECTORY_SEPARATOR.'../../image'.DIRECTORY_SEPARATOR.$data['img_path'];
                    if(file_exists($path2) && !empty($data['img_path'])){
                        unlink($path2);
                    }
                    $delete_many = mysqli_query($conn,"call delete_category('$id')");
                    if(!$delete_many){
                        $delete = 1;
                        echo"<script>";
                        echo"window.location.href='Type?del=fail';";
                        echo"</script>";
                    }
                    mysqli_free_result($delete_many);  
                    mysqli_next_result($conn);
                }
                if($delete == 0){
                    echo"<script>";
                    echo"window.location.href='Type?del2=success';";
                    echo"</script>";
                }
                
            }
        }
        else{
            echo"<script>";
            echo"window.location.href='Type?Checkbox=null';";
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
    swal("", "ບໍ່ສາມາດລົບຂໍ້ມູນໄດ້ເນື່ອງຈາກໝວດໝູ່ສິນຄ້ານີ້ມີຢູ່ໃນສິນຄ້າແລ້ວ !", "error");
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
    swal("", "ບໍ່ສາມາດລົບຂໍ້ມູນໄດ້ເນື່ອງຈາກລະຫັດໝວດໝູ່ສິນຄ້າ: '.$msg.' ນີ້ມີຢູ່ໃນຕາຕະລາງປະເພດສິນຄ້າແລ້ວ ", "error");
    </script>';
  }  
if(isset($_GET["type"])=="same"){
    echo'<script type="text/javascript">
    swal("", "ບໍ່ສາມາດບັນທຶກຂໍ້ມູນໄດ້ ເນື່ອງຈາກໝວດໝູ່ສິນຄ້ານີ້ມີຢູ່ແລ້ວ !", "info");
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
            $('#cate_id_update').val(data[3]);
            $('#cate_name_update').val(data[6]);

            if (data[4] === '') {
                document.getElementById("output2").src = ('../../image/camera.jpg');
            } else {
                document.getElementById("output2").src = ('../../image/' + data[4]);
            }
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
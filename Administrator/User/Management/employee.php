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
<form action="Employee" method="POST" id="formSaveEmp" enctype="multipart/form-data" class="row g-3 needs-validation"
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
                            <input type="text" class="form-control" name="emp_id" id="emp_id" value=""placeholder="ລະຫັດພະນັກງານ"
                                 required>
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
                            <select class="form-control" name="gender" id="gender" required>
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
                            <label for="" class="">ເບີໂທລະສັບ</label>
                            <input type="text" class="form-control" name="tel" id="tel" value=""
                                placeholder="ເບີໂທລະສັບ">
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
                            <input type="email" class="form-control" name="email" id="email" value=""
                                placeholder="ອີເມວ" required>
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
                                <?php
                                $status = mysqli_query($conn,"select * from status");
                                foreach($status as $row_status){
                                ?>
                                <option value="<?php echo $row_status['id'] ?>"><?php echo $row_status['name'] ?>
                                </option>
                                <?php
                                }
                                ?>
                            </select>
                            <div class="invalid-feedback">
                                ກະລຸນາເລືອກສະຖານະ
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
                    <button type="submit" name="btnSave" id="btn_loadSave" class="btn btn-outline-primary" onclick="">
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
                            <input type="hidden" name="emp_id_update" id="emp_id_update">
                            <input type="text" class="form-control" name="emp_name_update" id="emp_name_update" value=""
                                placeholder="ຊື່ພະນັກງານ" required>
                            <div class="invalid-feedback">
                                ກະລຸນາປ້ອນຊື່ພະນັກງານ
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <label>ນາມສະກຸນ</label>
                            <input type="text" class="form-control" name="surname_update" id="surname_update" value=""
                                placeholder="ນາມສະກຸນ">
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="" class="">ນາມສະກຸນ</label>
                            <select class="form-control" name="gender_update" id="gender_update" required>
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
                            <input type="date" class="form-control" name="dob_update" id="dob_update" value="">
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="" class="">ເບີໂທລະສັບ</label>
                            <input type="text" class="form-control" name="tel_update" id="tel_update" value=""
                                placeholder="ເບີໂທລະສັບ">
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
                            <input type="type" class="form-control" name="email_update" id="email_update" value=""
                                placeholder="ອີເມວ" required>
                            <div class="invalid-feedback">
                                ກະລຸນາປ້ອນຊື່ອີເມວ
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="" class="">ລະຫັດເຂົ້າໃຊ້ລະບົບ</label>
                            <input type="password" class="form-control" name="pass_update" id="pass_update" value=""
                                placeholder="ລະຫັດເຂົ້າໃຊ້ລະບົບ" required>
                            <div class="invalid-feedback">
                                ກະລຸນາປ້ອນລະຫັດເຂົ້າໃຊ້ລະບົບ
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="" class="">ສະຖານະຜູ້ໃຊ້ລະບົບ</label>
                            <select class="form-control" name="status_id_update" id="status_id_update" required>
                                <option value="">ເລືອກສະຖານະຜູ້ໃຊ້ລະບົບ</option>
                                <?php
                                $status2 = mysqli_query($conn,"select * from status");
                                foreach($status2 as $row_status2){
                                ?>
                                <option value="<?php echo $row_status2['id'] ?>"><?php echo $row_status2['name'] ?>
                                </option>
                                <?php
                                }
                                ?>
                            </select>
                            <div class="invalid-feedback">
                                ກະລຸນາເລືອກສະຖານະ
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
                    <button type="submit" name="btnUpdate" id="btnUpdate" class="btn btn-outline-success"
                        onclick="">
                        ແກ້ໄຂຂໍ້ມູນ
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
<form action="Employee" id="formDelete" method="POST" enctype="multipart/form-data">
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
            style="width: 2300px;">
            <thead>
                <tr>
                    <th data-field="state" data-checkbox="true"></th>
                    <th style="width: 50px;">ເຄື່ອງມື</th>
                    <th>No.</th>
                    <th class="display_none"></th>
                    <th data-field="id" data-sortable="true">ລະຫັດພະນັກງານ</th>
                    <th data-field="name" data-sortable="true">ຊື່ພະນັກງານ</th>
                    <th data-field="surname" data-sortable="true">ນາມສະກຸນ</th>
                    <th data-field="gender" data-sortable="true">ເພດ</th>
                    <th data-field="dob" data-sortable="true">ວັນເດືອນປີເກີດ</th>
                    <th data-field="tel" data-sortable="true">ເບີໂທລະສັບ</th>
                    <th data-field="address" data-sortable="true">ທີ່ຢູ່ປັດຈຸບັນ</th>
                    <th data-field="email" data-sortable="true">ທີ່ຢູ່ອີເມວ</th>
                    <th data-field="password" data-sortable="true">ລະຫັດເຂົ້າໃຊ້ລະບົບ</th>
                    <th class="display_none"></th>
                    <th data-field="auther" data-sortable="true">ສິດເຂົ້າໃຊ້ລະບົບ</th>
                    <th class="display_none"></th>
                    <th data-field="picture" data-sortable="true">ຮູບພາບ</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no_ = 1;
                $result_employee = mysqli_query($conn,"call select_employee()");
                foreach($result_employee as $row){
            ?>
                <tr>
                    <td></td>
                    <td>
                        <a href="#"
                            class="fa fa-pen toolcolor btnUpdate_emp" onclick="modal_update()"></a>&nbsp; &nbsp;
                    </td>
                    <td><?php echo $no_ ++ ?></td>
                    <td class="display_none"><?php echo $row["img_path"] ?></td>
                    <td><?php echo $row["emp_id"] ?></td>
                    <td><?php echo $row["emp_name"] ?></td>
                    <td><?php echo $row["emp_surname"] ?></td>
                    <td><?php echo $row["gender"] ?></td>
                    <td><?php echo date("d/m/Y",strtotime($row["dob"])) ?></td>
                    <td><?php echo $row["tel"] ?></td>
                    <td><?php echo $row["address"] ?></td>
                    <td><?php echo $row["email"] ?></td>
                    <td><?php echo $row["pass"] ?></td>
                    <td class="display_none"><?php echo $row["status"] ?></td>
                    <td><?php echo $row["name"] ?></td>
                    <td class="display_none"><?php echo $row["dob"] ?></td>
                    <?php
                    if($row["img_path"] == ""){
                        $row["img_path"] = "image.jpeg";
                    }
                ?>
                    <td> <a href="<?php echo $path;?>image/<?php echo $row["img_path"] ?>" target="_blank">
                            <img src="<?php echo $path;?>image/<?php echo $row["img_path"] ?>"
                                class="img-circle elevation-2" alt="" width="50px">
                        </a></td>
                </tr>
                <?php
                }
                mysqli_free_result($result_employee);  
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
    $emp_id = $_POST['emp_id']; 
    $emp_name = $_POST['emp_name'];
    $emp_surname = $_POST['surname'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $tel = $_POST['tel'];
    $pass = $_POST['pass'];
    $status = $_POST['status_id'];
        $resultckid = mysqli_query($conn, "select * from employees where emp_id='$emp_id';");
        $resultckname = mysqli_query($conn,"select * from employees where emp_name='$emp_name';");
        $resultemail = mysqli_query($conn,"select * from employees where email='$email';");
        if(mysqli_num_rows($resultckid) > 0){
            echo"<script>";
            echo"window.location.href='Employee?empid=same';";
            echo"</script>";
        }
        elseif (mysqli_num_rows($resultckname) > 0) {
            echo"<script>";
            echo"window.location.href='Employee?name=same';";
            echo"</script>";
        }
        elseif (mysqli_num_rows($resultemail) > 0) {
            echo"<script>";
            echo"window.location.href='Employee?email=same';";
            echo"</script>";
        }
        else {
            if($_FILES["img_path"]["name"] == "")
            {
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
            $resultinsert = mysqli_query($conn, "call insert_employee('$emp_id','$emp_name','$emp_surname','$gender','$dob','$address','$tel','$email','$pass','$status','$pro_img')");
            if(!$resultinsert){
                echo"<script>";
                echo"window.location.href='Employee?save=fail';";
                echo"</script>";
            }
            else {
                echo"<script>";
                echo"window.location.href='Employee?save2=success';";
                echo"</script>";
            }
        }
}
if(isset($_POST['btnUpdate'])){
    $emp_id = $_POST['emp_id_update']; 
    $name = $_POST['emp_name_update'];
    $surname = $_POST['surname_update'];
    $gender = $_POST['gender_update'];
    $dob = $_POST['dob_update'];
    $address = $_POST['address_update'];
    $email = $_POST['email_update'];
    $tel = $_POST['tel_update'];
    $pass = $_POST['pass_update'];
    $status = $_POST['status_id_update'];
    if(trim($dob) == ""){
        $dob = "0000-00-00";
    }
    $flag = preg_match('/^[a-f0-9]{32}$/', $pass);
    if($flag){ // flag true means string is a valid md5 encrypation
        echo"";
    }else{
        $pass = md5($pass);
    }

    $resultmp = mysqli_query($conn,"select * from employees where emp_id='$emp_id'");//ດຶງຄ່າອີເມວ ແລະ ລະຫັດຜ່ານ ໂດຍໃຊ້ໄອດີພະນັກງານ
    $rowmp = mysqli_fetch_array($resultmp,MYSQLI_ASSOC);
    $get_img = mysqli_query($conn, "select img_path from employees where emp_id='$emp_id'");
    $data = mysqli_fetch_array($get_img,MYSQLI_ASSOC);
    if($email == $rowmp['email'] && $pass == $rowmp['pass']){//ຖ້າອີເມວ ແລະ ລະຫັດຜ່ານທັງ 2 ຄືກັນກັບອີເມວ ແລະ ລະຫັດຜ່ານຂອງລະໄອດີພະນັກງານ ແມ່ນທຳການອັບເດດຂໍ້ມູນ
        if($_FILES['img_path_update']['name'] == ""){//ກວດສອບຄ່າຟາຍຮູບມາວ່າເປັນຄ່າວ່າງ ຫຼື ບໍ່
            $Pro_image = $data['img_path'];
        }
        else{//ຖ້າຄ່າຟາຍຮູບບໍ່ເປັນຄ່າວ່າງໃຫ້ເຮັດວຽກໃນຈຸດນີ້
            $ext = pathinfo(basename($_FILES['img_path_update']['name']), PATHINFO_EXTENSION);
            $new_image_name = 'img_'.uniqid().".".$ext;
            $image_path = $path.'image/';
            $upload_path = $image_path.$new_image_name;
            move_uploaded_file($_FILES['img_path_update']['tmp_name'], $upload_path);
            $Pro_image = $new_image_name;
            // $path2 = __DIR__.DIRECTORY_SEPARATOR.$image_path.DIRECTORY_SEPARATOR.$data['img_path']; //cant find path
            $path2 = $image_path.$data['img_path'];
            if(file_exists($path2) && !empty($data['img_path'])){
                unlink($path2);                  
            }
        }
        $result = mysqli_query($conn,"call update_employee('$emp_id','$name','$surname','$gender','$dob','$address','$tel','$email','$pass','$status','$Pro_image')");
        // $result = mysqli_query($conn,"update employee set emp_name='$name',emp_surname='$surname',gender='$gender',tel='$tel',address='$address',email='$email',pass='$pass',auther_id='$auther_id',stt_id='$sttid',img_path='$Pro_image' where emp_id ='$emp_id'");
        if(!$result){
            echo"<script>";
            echo"window.location.href='Employee?update=fail';";
            echo"</script>";
        }
        else{
            echo"<script>";
            echo"window.location.href='Employee?update2=success';";
            echo"</script>";
        }
    }
    else{//ຖ້າວ່າອີເມວ ແລະ ລະຫັດຜ່ານ ບໍ່ຄືກັນກັບໄອດີພະນັກງານແມ່ນໃຫ້ເຮັດວຽກໃນຈຸດນີ້
        if($email != $rowmp['email'] || $pass != $rowmp['pass']){
            $check_email = mysqli_query($conn,"select * from employee where email='$email';");//ກວດສອບອີເມວທີ່ປ້ອນເຂົ້າມາວ່າມີບໍ່
            $check_pass = mysqli_query($conn,"select * from employee where pass='$pass';");//ກວດສອບລະຫັດຜ່ານທີ່ປ້ອນເຂົ້າມາວ່າມີບໍ່
            if(mysqli_num_rows($check_email) > 0){//ຖ້າອີມວທີ່ປ້ອນເຂົ້າມານັ້ນມີຄົນໃຊ້ແລ້ວໃຫ້ກວດລະຫັດເຂົ້າສູ່ລະບົບ
                if(mysqli_num_rows($check_pass) > 0){//ຖ້າລະຫັດຜ່ານ ຫຼື ອີເມວຄືກັນກັບຄົນອື່ນແມ່ນໃຫ້ເຮັດວຽກໜ້ານີ້
                    echo"<script>";
                    echo"window.location.href='Employee?mp=same';";
                    echo"</script>";
                }
                else{//ຖ້າອີເມວຄືກັນ ແຕ່ລະຫັດຜ່ານແຕກຕ່າງໃຫ້ທຳການອັບເດດ
                    if($_FILES['img_path_update']['name'] == ""){//ກວດສອບຄ່າຟາຍຮູບມາວ່າເປັນຄ່າວ່າງ ຫຼື ບໍ່
                        $Pro_image = $data['img_path'];
                    }
                    else{//ຖ້າຄ່າຟາຍຮູບບໍ່ເປັນຄ່າວ່າງໃຫ້ເຮັດວຽກໃນຈຸດນີ້
                        $ext = pathinfo(basename($_FILES['img_path_update']['name']), PATHINFO_EXTENSION);
                        $new_image_name = 'img_'.uniqid().".".$ext;
                        $image_path = $path.'image/';
                        $upload_path = $image_path.$new_image_name;
                        move_uploaded_file($_FILES['img_path_update']['tmp_name'], $upload_path);
                        $Pro_image = $new_image_name;
                        $path2 = $image_path.$data['img_path'];
                        if(file_exists($path2) && !empty($data['img_path'])){
                            unlink($path2);
                            
                        }
                    }
                    $result = mysqli_query($conn,"call update_employee('$emp_id','$name','$surname','$gender','$dob','$address','$tel','$email','$pass','$status','$Pro_image')");
                    if(!$result){
                        echo"<script>";
                        echo"window.location.href='Employee?update=fail';";
                        echo"</script>";
                    }
                    else{
                        echo"<script>";
                        echo"window.location.href='Employee?update2=success';";
                        echo"</script>";
                    }
                }
            }
            else if(mysqli_num_rows($check_pass) > 0){//ຖ້າລະຫັດຜ່ານທີ່ປ້ອນເຂົ້າມານັ້ນມີຄົນໃຊ້ແລ້ວໃຫ້ກວດສອບອີເມວ
                if(mysqli_num_rows($check_email) > 0){//ຖ້າອີເມວ ຫຼື ລະຫັດຜ່ານຄືກັນກັບຂອງຄົນອື່ນແມ່ນໃຫ້ເຮັດວຽກໜ້ານີ້
                    echo"<script>";
                    echo"window.location.href='Employee?mp=same';";
                    echo"</script>";
                }
                else{
                    if($_FILES['img_path_update']['name'] == ""){//ກວດສອບຄ່າຟາຍຮູບມາວ່າເປັນຄ່າວ່າງ ຫຼື ບໍ່
                        $Pro_image = $data['img_path'];
                    }
                    else{//ຖ້າຄ່າຟາຍຮູບບໍ່ເປັນຄ່າວ່າງໃຫ້ເຮັດວຽກໃນຈຸດນີ້
                        $ext = pathinfo(basename($_FILES['img_path_update']['name']), PATHINFO_EXTENSION);
                        $new_image_name = 'img_'.uniqid().".".$ext;
                        $image_path = $path.'image/';
                        $upload_path = $image_path.$new_image_name;
                        move_uploaded_file($_FILES['img_path_update']['tmp_name'], $upload_path);
                        $Pro_image = $new_image_name;
                        $path2 = $image_path.$data['img_path'];
                        if(file_exists($path2) && !empty($data['img_path'])){
                            unlink($path2);
                            
                        }
                    }
                    $result = mysqli_query($conn,"call update_employee('$emp_id','$name','$surname','$gender','$dob','$address','$tel','$email','$pass','$status','$Pro_image')");
                    if(!$result){
                        echo"<script>";
                        echo"window.location.href='Employee?update=fail';";
                        echo"</script>";
                    }
                    else{
                        echo"<script>";
                        echo"window.location.href='Employee?update2=success';";
                        echo"</script>";
                    }
                }
            }
            else{//ກໍລະນີທີ່ອີເມວ ແລະ ລະຫັດຜ່ານບໍ່ຄືໃຜເລີຍແມ່ນໃຫ້ເຮັດວຽກໃນຈຸດນີ້
                if($_FILES['img_path_update']['name'] == ""){//ກວດສອບຄ່າຟາຍຮູບມາວ່າເປັນຄ່າວ່າງ ຫຼື ບໍ່
                    $Pro_image = $data['img_path'];
                }
                else{//ຖ້າຄ່າຟາຍຮູບບໍ່ເປັນຄ່າວ່າງໃຫ້ເຮັດວຽກໃນຈຸດນີ້
                    $ext = pathinfo(basename($_FILES['img_path_update']['name']), PATHINFO_EXTENSION);
                    $new_image_name = 'img_'.uniqid().".".$ext;
                    $image_path = $path.'image/';
                    $upload_path = $image_path.$new_image_name;
                    move_uploaded_file($_FILES['img_path_update']['tmp_name'], $upload_path);
                    $Pro_image = $new_image_name;
                    $path2 = $image_path.$data['img_path'];
                    if(file_exists($path2) && !empty($data['img_path'])){
                        unlink($path2);
                        
                    }
                }
                $result = mysqli_query($conn,"call update_employee('$emp_id','$name','$surname','$gender','$dob','$address','$tel','$email','$pass','$status','$Pro_image')");
                if(!$result){
                    echo"<script>";
                    echo"window.location.href='Employee?update=fail';";
                    echo"</script>";
                }
                else{
                    echo"<script>";
                    echo"window.location.href='Employee?update2=success';";
                    echo"</script>";
                }
            }
        }
    }
}
if(isset($_POST["btnDelete"])){
    $logic = 0;
        if(isset($_POST["btSelectItem"])){
            foreach($_POST["btSelectItem"] as $checkid){
                $Check_Product = mysqli_query($conn,"select * from sell where emp_id='$checkid'");
                if(mysqli_num_rows($Check_Product) > 0){
                    $logic = 1;
                    echo"<script>";
                    echo"window.location.href='Employee?Checkdelete=true&&sells=$checkid';";
                    echo"</script>";
                    break;
                }
                $Check_import = mysqli_query($conn,"select * from imports where emp_id='$checkid'");
                if(mysqli_num_rows($Check_import) > 0){
                    $logic = 1;
                    echo"<script>";
                    echo"window.location.href='Employee?Checkdelete=true&&imports=$checkid';";
                    echo"</script>";
                    break;
                }
                $Check_orderdetail = mysqli_query($conn,"select * from orders where emp_id='$checkid'");
                if(mysqli_num_rows($Check_orderdetail) > 0){
                    $logic = 1;
                    echo"<script>";
                    echo"window.location.href='Employee?Checkdelete=true&&orders=$checkid';";
                    echo"</script>";
                    break;
                }
            }
            if($logic == 0){
                $delete = 0;
                foreach($_POST["btSelectItem"] as $id){
                    $resultsec = mysqli_query($conn, "select img_path from employees where emp_id='$id'"); 
                    $data = mysqli_fetch_array($resultsec, MYSQLI_ASSOC);
                    $path2 = __DIR__.DIRECTORY_SEPARATOR.'../../image'.DIRECTORY_SEPARATOR.$data['img_path'];
                    if(file_exists($path2) && !empty($data['img_path'])){
                        unlink($path2);
                    }
                    $delete_many = mysqli_query($conn,"call delete_employee('$id')");
                    if(!$delete_many){
                        $delete = 1;
                        echo"<script>";
                        echo"window.location.href='Employee?del=fail';";
                        echo"</script>";
                    }
                    mysqli_free_result($delete_many);  
                    mysqli_next_result($conn);
                }
                if($delete == 0){
                    echo"<script>";
                    echo"window.location.href='Employee?del2=success';";
                    echo"</script>";
                }
                
            }
        }
        else{
            echo"<script>";
            echo"window.location.href='Employee?Checkbox=null';";
            echo"</script>";
        }
}
if(isset($_GET["Checkdelete"])=="true" && isset($_GET["orders"])){
    $msg = $_GET["orders"];
    echo'<script type="text/javascript">
    swal("", "ບໍ່ສາມາດລົບຂໍ້ມູນໄດ້ເນື່ອງຈາກລະຫັດພະນັກງານ: '.$msg.' ນີ້ມີຢູ່ໃນຕາຕະລາງການສັ່ງຊື້ແລ້ວ ", "error");
    </script>';
  }   
  if(isset($_GET["Checkdelete"])=="true" && isset($_GET["imports"])){
    $msg = $_GET["imports"];
    echo'<script type="text/javascript">
    swal("", "ບໍ່ສາມາດລົບຂໍ້ມູນໄດ້ເນື່ອງຈາກລະຫັດພະນັກງານ: '.$msg.' ນີ້ມີຢູ່ໃນຕາຕະລາງການນຳເຂົ້າສິນຄ້າແລ້ວ ", "error");
    </script>';
  }   
  if(isset($_GET["Checkdelete"])=="true" && isset($_GET["sells"])){
    $msg = $_GET["sells"];
    echo'<script type="text/javascript">
    swal("", "ບໍ່ສາມາດລົບຂໍ້ມູນໄດ້ເນື່ອງຈາກລະຫັດພະນັກງານ: '.$msg.' ນີ້ມີຢູ່ໃນຕາຕະລາງການຂາຍສິນຄ້າແລ້ວ ", "error");
    </script>';
  }   
if(isset($_GET["empid"])=="same"){
    echo'<script type="text/javascript">
    swal("", "ບໍ່ສາມາດບັນທຶກຂໍ້ມູນໄດ້ ເນື່ອງຈາກລະຫັດຜູ້ໃຊ້ນີ້ມີຢູ່ແລ້ວ ກະລຸນາໃສ່ລະຫັດທີ່ແຕກຕ່າງ !", "info");
    </script>';
  }  
  if(isset($_GET["name"])=="same"){
    echo'<script type="text/javascript">
    swal("", "ບໍ່ສາມາດບັນທຶກຂໍ້ມູນໄດ້ ເນື່ອງຈາກຊື່ຜູ້ໃຊ້ນີ້ມີຢູ່ແລ້ວ ກະລຸນາໃສ່ຊື່ທີ່ແຕກຕ່າງ!", "info");
    </script>';
  }  
  if(isset($_GET["email"])=="same"){
    echo'<script type="text/javascript">
    swal("", "ບໍ່ສາມາດບັນທຶກຂໍ້ມູນໄດ້ ເນື່ອງຈາກອີ່ເມວຜູ້ໃຊ້ນີ້ມີຢູ່ແລ້ວ ກະລຸນາໃສ່ອີເມວທີ່ແຕກຕ່າງ !", "info");
    </script>';
  }  
if(isset($_GET["Checkbox"])=="null"){
    echo'<script type="text/javascript">
    swal("", "ກະລຸນາເລືອກລາຍການກ່ອນ !", "info");
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
  if(isset($_GET['mp'])=='same'){
    echo'<script type="text/javascript">
    swal("", "ບໍ່ສາມາດແກ້ໄຂຂໍ້ມູນໄດ້ເນື່ອງຈາກອີເມວນີ້ມີແລ້ວ ກະລຸນາໃສ່ອີເມວອື່ນ !!", "info");
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
            $('#emp_id_update').val(data[4]);
            $('#emp_name_update').val(data[5]);
            $('#surname_update').val(data[6]);
            $('#gender_update').val(data[7]);
            $('#dob_update').val(data[15]);
            $('#tel_update').val(data[9]);
            $('#address_update').val(data[10]);
            $('#email_update').val(data[11]);
            $('#pass_update').val(data[12]);
            $('#status_id_update').val(data[13]);

            if (data[3] === '') {
                document.getElementById("output2").src = ('../../image/camera.jpg');
            } else {
                document.getElementById("output2").src = ('../../image/' + data[3]);
            }
        });
    });
}
</script>
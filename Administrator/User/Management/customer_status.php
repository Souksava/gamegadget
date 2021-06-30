<?php
  $title = "ຂໍ້ມູນສະຖານະລູກຄ້າ";
  $path="../../";
  $links = "../";
  $session_path = "../../";
  include ("../../header-footer/header.php");
  if(isset($_POST['id'])){
    $obj->delete_customer_status(trim($_POST['id']));
  }
  if(isset($_POST['stt_id'])){
    $obj->insert_customer_status(trim($_POST['stt_id']),trim($_POST['stt_name']));
  }
  if(isset($_POST['stt_name_update'])){
    $obj->update_customer_status(trim($_POST['stt_id_update']),trim($_POST['stt_name_update']));
  }
?>
<div style="width: 100%;">
    <div style="width: 48%; float: left;">
        <b>ລາຍການ<?php echo $title ?></b>&nbsp <img src="../../icon/hidemenu.ico" width="10px">
    </div>
    <div style="width: 46%; float: right;" align="right">
        <form action="customer-status" id="form1" method="POST" enctype="multipart/form-data">
            <a href="#" data-toggle="modal" data-target="#exampleModalcustomer_status">
                <img src="../../icon/add.ico" alt="" width="25px">
            </a>
            <div class="modal fade" id="exampleModalcustomer_status" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">ເພີ່ມຂໍ້ມູນສະຖານະລູກຄ້າ</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row" align="left">
                                <div class="col-md-12 col-sm-6 form-control2">
                                    <label>ລະຫັດສະຖານະລູກຄ້າ</label>
                                    <input type="text" name="stt_id" id="stt_id" placeholder="ລະຫັດສະຖານະລູກຄ້າ"
                                        class="form-control">
                                    <i class="fas fa-check-circle "></i>
                                    <i class="fas fa-exclamation-circle "></i>
                                    <small class="">Error message</small>
                                </div>
                                <div class="col-md-12 col-sm-6 form-control2">
                                    <label>ຊື່ສະຖານະລູກຄ້າ</label>
                                    <input type="text" name="stt_name" id="stt_name" placeholder="ຊື່ສະຖານະລູກຄ້າ"
                                        class="form-control">
                                    <i class="fas fa-check-circle "></i>
                                    <i class="fas fa-exclamation-circle "></i>
                                    <small class="">Error message</small>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary"
                                data-dismiss="modal">ຍົກເລີກ</button>
                            <button type="submit" name="btnSave" id="btnSave" class="btn btn-outline-primary">
                                ບັນທຶກ
                                <span class="" id="load"></span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <form action="customer-status" id="formUpdate" method="POST" enctype="multipart/form-data">
            <div class="modal fade" id="exampleModalUpdate" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">ແກ້ໄຂຂໍ້ມູນສະຖານະລູກຄ້າ</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row" align="left">
                                <div class="col-md-12 col-sm-6 form-control2">
                                    <label>ຊື່ສະຖານະລູກຄ້າ</label>
                                    <input type="hidden" name="stt_id_update" id="stt_id_update"
                                        placeholder="ລະຫັດສະຖານະລູກຄ້າ">
                                    <input type="text" name="stt_name_update" id="stt_name_update"
                                        placeholder="ຊື່ສະຖານະລູກຄ້າ" class="form-control">
                                    <i class="fas fa-check-circle "></i>
                                    <i class="fas fa-exclamation-circle "></i>
                                    <small class="">Error message</small>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary"
                                data-dismiss="modal">ຍົກເລີກ</button>
                            <button type="submit" name="btnUpdate" id="btnUpdate" class="btn btn-outline-success">
                                ແກ້ໄຂ
                                <span class="" id="load_update"></span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="clearfix"></div><br>
<?php
      $obj->select_customer_status('%%','0');
      if(mysqli_num_rows($result_customer_status) > 0){
    ?>
<div class="table-responsive">
    <table class="table font12" style="width: 1500px;">
        <tr>
            <th>ລະຫັດສະຖານະລູກຄ້າ</th>
            <th>ຊື່ສະຖານະລູກຄ້າ</th>
            <th></th>

        </tr>
        <?php
            foreach($result_customer_status as $row){
        ?>
        <tr>
            <td><?php echo $row['stt_id'] ?></td>
            <td><?php echo $row['stt_name'] ?></td>
            <td>
                <a href="#" data-toggle="modal" data-target="#exampleModalUpdate"
                    class="fa fa-pen toolcolor btnUpdate_customer_status"></a>&nbsp; &nbsp;
                <a href="#" data-toggle="modal" data-target="#exampleModalDelete"
                    class="fa fa-trash toolcolor btnDelete_customer_status"></a>
            </td>
        </tr>
        <?php
            }   
            mysqli_free_result($result_customer_status);  
            mysqli_next_result($conn);
        ?>
    </table>
</div>
<?php
          } 
          else{
        ?>
<hr size="1" width="90%">
<p align="center">ຍັງບໍ່ມີຂໍ້ມູນ</p>
<hr size="1" width="90%">
<?php
          }
        ?>



<form action="customer-status" id="formDelete" method="POST" enctype="multipart/form-data">
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
                    <button type="submit" name="btnDelete" id="btnDelete" class="btn btn-outline-danger">
                        ລົບ
                        <span class="" id="load_delete"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>


<script type="text/javascript">
const myform = document.getElementById('form1');
const stt_id = document.getElementById('stt_id');
const stt_name = document.getElementById('stt_name');
const loaddata = document.getElementById('load');
const btnSave = document.getElementById('btnSave');
myform.addEventListener('submit', (e) => {
    e.preventDefault();
    checkInputs();
});

function checkInputs() {
    const stt_idValue = stt_id.value.trim();
    const stt_nameValue = stt_name.value.trim();

    if (stt_idValue === '') {
        setErrorFor(stt_id, 'ກະລຸນາປ້ອນລະຫັດສະຖານະລູກຄ້າ');
    } else {
        setSuccessFor(stt_id);
    }
    if (stt_nameValue === '') {
        setErrorFor(stt_name, 'ກະລຸນາປ້ອນຊື່ສະຖານະລູກຄ້າ');
    } else {
        setSuccessFor(stt_name);
    }
    if (stt_nameValue !== '' && stt_idValue !== '') {
        setloading(loaddata, btnSave);
        document.getElementById("form1").action = "customer-status";
        document.getElementById("form1").submit();
    }
}
</script>

<script type="text/javascript">
const myformUpdate = document.getElementById('formUpdate');
const stt_name_update = document.getElementById('stt_name_update');
const loaddata_update = document.getElementById('load_update');
const btnUpdate = document.getElementById('btnUpdate');
myformUpdate.addEventListener('submit', (e) => {
    e.preventDefault();
    checkInputsUpdate();
});

function checkInputsUpdate() {
    const stt_name_updateValue = stt_name_update.value.trim();
    if (stt_name_updateValue === '') {
        setErrorFor(stt_name_update, 'ກະລຸນາປ້ອນສະຖານະລູກຄ້າ');
    } else {
        setSuccessFor(stt_name_update);
    }
    if (stt_name_updateValue !== '') {
        setloading(loaddata_update, btnUpdate);
        document.getElementById("formUpdate").action = "customer-status";
        document.getElementById("formUpdate").submit();
    }
}
// update customer status
const myformudelete = document.getElementById('formDelete');
const loaddata_delete = document.getElementById('load_delete');
const btnDelete = document.getElementById('btnDelete');
myformudelete.addEventListener('submit', (e) => {
    e.preventDefault();
    checkInputs3();
});

function checkInputs3() {
    setloading(loaddata_delete, btnDelete);
    document.getElementById("formDelete").action = "customer-status";
    document.getElementById("formDelete").submit();

}
$('.btnUpdate_customer_status').on('click', function() {
    $('#exampleModalUpdate').modal('show');
    $tr = $(this).closest('tr');
    var data = $tr.children("td").map(function() {
        return $(this).text();
    }).get();

    console.log(data);

    $('#stt_id_update').val(data[0]);
    $('#stt_name_update').val(data[1]);
});
$('.btnDelete_customer_status').on('click', function() {
    $('#exampleModalDelete').modal('show');
    $tr = $(this).closest('tr');
    var data = $tr.children("td").map(function() {
        return $(this).text();
    }).get();
    console.log(data);
    $('#id').val(data[0]);
});
</script>

<!-- sweetalert -->
<?php
  // check if stt_id exist
  if(isset($_GET['sttid'])=='same'){
    echo'<script type="text/javascript">
    swal("", "ບໍ່ສາມາດເພີ່ມຂໍ້ມູນໄດ້ເນື່ອງຈາກລະຫັດສະຖານະລູກຄ້ານີ້ມີແລ້ວ ກະລຸນາໃສ່ລະຫັດອື່ນ !!", "info");
    </script>';
  }
    // check if stt_name exist
    if(isset($_GET['sttname'])=='same'){
      echo'<script type="text/javascript">
      swal("", "ບໍ່ສາມາດເພີ່ມຂໍ້ມູນໄດ້ເນື່ອງຈາກຊື່ສະຖານະລູກຄ້ານີ້ມີແລ້ວ ກະລຸນາໃສ່ຊື່ອື່ນ !!", "info");
      </script>';
    }
  //check save
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
    // check if stt_name_update exist
    if(isset($_GET['sttname'])=='same'){
      echo'<script type="text/javascript">
      swal("", "ບໍ່ສາມາດເພີ່ມຂໍ້ມູນໄດ້ເນື່ອງຈາກຊື່ສະຖານະລູກຄ້ານີ້ມີແລ້ວ ກະລຸນາໃສ່ຊື່ອື່ນ !!", "info");
      </script>';
    }
  //check update
  if(isset($_GET['update'])=='fail'){
    echo'<script type="text/javascript">
    swal("", "ແກ້ໄຂຂໍ້ມູນບໍ່ສຳເລັດ", "error");
    </script>';
  }
  if(isset($_GET['update2'])=='success'){
    echo'<script type="text/javascript">
    swal("", "ແກ້ໄຂຂໍ້ມູນສຳເລັດ", "success");
    </script>';
  }
  // check if customer_status_id exist in customer
  if(isset($_GET['delete'])=='warning'){
    echo'<script type="text/javascript">
    swal("", "ບໍ່ສາມາດລົບຂໍ້ມູນຜູ້ສະໜອງນີ້ໄ້ດເນື່ອງຈາກລະຫັດຜູ້ສະໜອງນີ້ເຄີຍໝູນໃຊ້ໃນຂໍ້ມູນນັບສະຕ໋ອກ", "error");
    </script>';
  }
  // check delete
  if(isset($_GET['del'])=='fail'){
    echo'<script type="text/javascript">
    swal("", "ລົບຂໍ້ຂໍ້ມູນບໍ່ສຳເລັດ", "error");
    </script>';
  }
  if(isset($_GET['del2'])=='success'){
    echo'<script type="text/javascript">
    swal("", "ລົບຂໍ້ຂໍ້ມູນສຳເລັດ", "success");
    </script>';
  }
?>

<?php
    include ("../../header-footer/footer.php");
  ?>
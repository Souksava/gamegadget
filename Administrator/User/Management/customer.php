<?php
  $title = "ຂໍ້ມູນລູກຄ້າ";
  $path="../../";
  $links = "../";
  $session_path = "../../";
  include ("../../header-footer/header.php");

  if(isset($_POST['id'])){
    $obj->delete_customer(trim($_POST['id']));
  }
  if(isset($_POST['cus_id'])){
    $obj->insert_customer(trim($_POST['cus_id']),trim($_POST['company']),trim($_POST['tel']),trim($_POST['email']),trim($_POST['address']),trim($_POST['stt_id']));
  }
  if(isset($_POST['cus_id_update'])){
    $obj->update_customer(trim($_POST['cus_id_update']),trim($_POST['company_update']),trim($_POST['tel_update']),trim($_POST['email_update']),trim($_POST['address_update']),trim($_POST['stt_id_update']));
  }
?>
<div style="width: 100%;">
    <div style="width: 48%; float: left;">
        <b>ລາຍການລູກຄ້າ</b>&nbsp <img src="../../icon/hidemenu.ico" width="10px">
    </div>
    <div style="width: 46%; float: right;" align="right">
        <form action="customer" id="form1" method="POST" enctype="multipart/form-data">
            <a href="#" data-toggle="modal" data-target="#exampleModalcustomer">

                <img src="../../icon/add.ico" alt="" width="25px">

            </a>

            <div class="modal fade" id="exampleModalcustomer" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">ເພີ່ມຂໍ້ມູນລູກຄ້າ</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row" align="left">
                                <div class="col-md-12 col-sm-6 form-control2">
                                    <label>ລະຫັດລູກຄ້າ</label>
                                    <input type="text" name="cus_id" id="cus_id" placeholder="ລະຫັດລູກຄ້າ"
                                        class="form-control">
                                    <i class="fas fa-check-circle "></i>
                                    <i class="fas fa-exclamation-circle "></i>
                                    <small class="">Error message</small>
                                </div>
                                <div class="col-md-12 col-sm-6 form-control2">
                                    <label>ຊື່ບໍລີສັດ</label>
                                    <input type="text" name="company" id="company" placeholder="ຊື່ບໍລີສັດ"
                                        class="form-control">
                                    <i class="fas fa-check-circle "></i>
                                    <i class="fas fa-exclamation-circle "></i>
                                    <small class="">Error message</small>
                                </div>
                                <div class="col-md-12 col-sm-6 form-control2">
                                    <label>ເບີໂທລະສັບ</label>
                                    <input type="text" name="tel" id="tel" placeholder="ເບີໂທລະສັບ"
                                        class="form-control">
                                    <i class="fas fa-check-circle "></i>
                                    <i class="fas fa-exclamation-circle "></i>
                                    <small class="">Error message</small>
                                </div>
                                <div class="col-md-12 col-sm-6 form-control2">
                                    <label>ທີ່ຢູ່ປັດຈຸບັນ</label>
                                    <input type="text" name="address" id="address" placeholder="ທີ່ຢູ່ປັດຈຸບັນ"
                                        class="form-control">
                                    <i class="fas fa-check-circle "></i>
                                    <i class="fas fa-exclamation-circle "></i>
                                    <small class="">Error message</small>
                                </div>
                                <div class="col-md-12 col-sm-6 form-control2">
                                    <label>ອີເມວ</label>
                                    <input type="text" name="email" id="email" placeholder="ອີເມວ" class="form-control">
                                    <i class="fas fa-check-circle "></i>
                                    <i class="fas fa-exclamation-circle "></i>
                                    <small class="">Error message</small>
                                </div>
                                <div class="col-md-12 col-sm-6 form-control2">
                                    <label>ສະຖານະລູກຄ້າ</label>
                                    <select name="stt_id" id="stt_id">
                                        <option value="" disabled selected>--- ເລືອກສະຖານະລູກຄ້າ ---</option>
                                        <?php
                                        $obj->select_customer_status('%%','0');
                                            foreach($result_customer_status as $row2){
                                        ?>
                                        <option value="<?php echo $row2['stt_id'] ?>"><?php echo $row2['stt_name'] ?>
                                        </option>
                                        <?php
                                           }
                                           mysqli_free_result($result_customer_status);  
                                           mysqli_next_result($conn);
                                        ?>
                                    </select>
                                    <i class="fas fa-check-circle "></i>
                                    <i class="fas fa-exclamation-circle "></i>
                                    <small class="">Error message</small>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary"
                                data-dismiss="modal">ຍົກເລີກ</button>
                            <button type="submit" name="Save" id="btnSave" class="btn btn-outline-primary" onclick="">
                                ບັນທຶກ
                                <span class="" id="load_save"></span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <br>
        <form action="customer" id="formUpdate" method="POST" enctype="multipart/form-data">
            <div class="modal fade" id="exampleModalUpdate" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">ແກ້ໄຂຂໍ້ມູນລູກຄ້າ</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row" align="left">
                                <div class="col-md-12 col-sm-6 form-control2">
                                    <label>ຊື່ບໍລີສັດ</label>
                                    <input type="hidden" name="cus_id_update" id="cus_id_update"
                                        placeholder="ລະຫັດລູກຄ້າ">
                                    <input type="text" name="company_update" id="company_update"
                                        placeholder="ຊື່ບໍລີສັດ" class="form-control">
                                    <i class="fas fa-check-circle "></i>
                                    <i class="fas fa-exclamation-circle "></i>
                                    <small class="">Error message</small>
                                </div>
                                <div class="col-md-12 col-sm-6 form-control2">
                                    <label>ເບີໂທລະສັບ</label>
                                    <input type="text" name="tel_update" id="tel_update" placeholder="ເບີໂທລະສັບ"
                                        class="form-control">
                                    <i class="fas fa-check-circle "></i>
                                    <i class="fas fa-exclamation-circle "></i>
                                    <small class="">Error message</small>
                                </div>
                                <div class="col-md-12 col-sm-6 form-control2">
                                    <label>ທີ່ຢູ່ປັດຈຸບັນ</label>
                                    <input type="text" name="address_update" id="address_update"
                                        placeholder="ທີ່ຢູ່ປັດຈຸບັນ" class="form-control">
                                    <i class="fas fa-check-circle "></i>
                                    <i class="fas fa-exclamation-circle "></i>
                                    <small class="">Error message</small>
                                </div>
                                <div class="col-md-12 col-sm-6 form-control2">
                                    <label>ອີເມວ</label>
                                    <input type="text" name="email_update" id="email_update" placeholder="ອີເມວ"
                                        class="form-control">
                                    <i class="fas fa-check-circle "></i>
                                    <i class="fas fa-exclamation-circle "></i>
                                    <small class="">Error message</small>
                                </div>
                                <div class="col-md-12 col-sm-6 form-control2">
                                    <label>ສະຖານະລູກຄ້າ</label>
                                    <select name="stt_id_update" id="stt_id_update">
                                        <option value="" disabled selected>--- ເລືອກສະຖານະລູກຄ້າ ---</option>
                                        <?php
                                        $obj->select_customer_status('%%','0');
                                            foreach($result_customer_status as $row2){
                                        ?>
                                        <option value="<?php echo $row2['stt_id'] ?>"><?php echo $row2['stt_name'] ?>
                                        </option>
                                        <?php
                                           }
                                           mysqli_free_result($result_customer_status);  
                                           mysqli_next_result($conn);
                                        ?>
                                    </select>
                                    <i class="fas fa-check-circle "></i>
                                    <i class="fas fa-exclamation-circle "></i>
                                    <small class="">Error message</small>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary"
                                data-dismiss="modal">ຍົກເລີກ</button>
                            <button type="submit" name="btnUpdate" id="btnUpdate" class="btn btn-outline-success "
                                onclick="">
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

<div id="result"></div>
<div class="clearfix"></div><br>

<!-- <div class="table-responsive">
      <table class="table font12" style="width: 1500px;">
        <tr>
            <th>ລະຫັດສະຖານະລູກຄ້າ</th>
            <th>ຊື່ສະຖານະລູກຄ້າ</th>
            <th>ລະຫັດສະຖານະລູກຄ້າ</th>
            <th>ຊື່ສະຖານະລູກຄ້າ</th>
            <th>ລະຫັດສະຖານະລູກຄ້າ</th>
            <th>ຊື່ສະຖານະລູກຄ້າ</th>
            <th></th>

        </tr>
        <tr>
            <td>1</td>
            <td>c</td>
            <td>1</td>
            <td>c</td>
            <td>1</td>
            <td>c</td>
            <td>
            <a href="#" data-toggle="modal" data-target="#exampleModalUpdate" class="fa fa-pen toolcolor btnUpdate_cust"></a>&nbsp; &nbsp; 
              <a href="#" data-toggle="modal" data-target="#exampleModalDelete" class="fa fa-trash toolcolor btnDelete_cust"></a>
            </td>
        </tr>
      </table>
    </div> -->




</div>

<form action="customer" id="formDelete" method="POST" enctype="multipart/form-data">
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


<script type="text/javascript">
const myform = document.getElementById('form1');
const cus_id = document.getElementById('cus_id');
const company = document.getElementById('company');
const tel = document.getElementById('tel');
const stt_id = document.getElementById('stt_id');
const load_save = document.getElementById("load_save");
const btnLoad_save = document.getElementById("btnSave");
myform.addEventListener('submit', (e) => {
    e.preventDefault();
    checkInputs();
});

function checkInputs() {
    const cus_idValue = cus_id.value.trim();
    const companyValue = company.value.trim();
    const telValue = tel.value.trim();
    const stt_idValue = stt_id.value.trim();

    if (cus_idValue === '') {
        setErrorFor(cus_id, 'ກະລຸນາປ້ອນລະຫັດລູກຄ້າ');
    } else {
        setSuccessFor(cus_id);
    }
    if (companyValue === '') {
        setErrorFor(company, 'ກະລຸນາປ້ອນຊື່ລູກຄ້າ');
    } else {
        setSuccessFor(company);
    }
    if (telValue === '') {
        setErrorFor(tel, 'ກະລຸນາປ້ອນເບີໂທລະສັບ');
    } else {
        setSuccessFor(tel);
    }
    if (stt_idValue === '') {
        setErrorFor(stt_id, 'ກະລຸນາປ້ອນລະຫັດສະຖານະລູກຄ້າ');
    } else {
        setSuccessFor(stt_id);
    }
    if (cus_idValue !== '' && companyValue !== '' && telValue !== '' && stt_idValue !== '') {
        setloading(load_save, btnLoad_save);
        document.getElementById("form1").action = "customer";
        document.getElementById("form1").submit();
    }
}
</script>

<script type="text/javascript">
const myformUpdate = document.getElementById('formUpdate');
const cus_id_update = document.getElementById('cus_id_update');
const company_update = document.getElementById('company_update');
const tel_update = document.getElementById('tel_update');
const stt_id_update = document.getElementById('stt_id_update');
const load_update = document.getElementById("load_update");
const btnLoad_update = document.getElementById("btnUpdate");
myformUpdate.addEventListener('submit', (e) => {
    e.preventDefault();
    checkInputsUpdate();
});

function checkInputsUpdate() {
    const cus_id_updateValue = cus_id_update.value.trim();
    const company_updateValue = company_update.value.trim();
    const tel_updateValue = tel_update.value.trim();
    const stt_id_updateValue = stt_id_update.value.trim();


    if (company_updateValue === '') {
        setErrorFor(company_update, 'ກະລຸນາປ້ອນຊື່ລູກຄ້າ');
    } else {
        setSuccessFor(company_update);
    }
    if (tel_updateValue === '') {
        setErrorFor(tel_update, 'ກະລຸນາປ້ອນເບີໂທລະສັບ');
    } else {
        setSuccessFor(tel_update);
    }
    if (stt_id_updateValue === '') {
        setErrorFor(stt_id_update, 'ກະລຸນາປ້ອນລະຫັດສະຖານະລູກຄ້າ');
    } else {
        setSuccessFor(stt_id_update);
    }
    if (cus_id_updateValue !== '' && company_updateValue !== '' && tel_updateValue !== '' && stt_id_updateValue !==
        '') {
        setloading(load_update, btnLoad_update);
        document.getElementById("formUpdate").action = "customer";
        document.getElementById("formUpdate").submit();
    }
}
const myformudelete = document.getElementById('formDelete');
const id = document.getElementById("id");
const load_delete = document.getElementById("load_delete");
const btnLoad_delete = document.getElementById("btnDelete");
myformudelete.addEventListener('submit', (e) => {
    e.preventDefault();
    checkInputs3();
});

function checkInputs3() {

    setloading(load_delete,btnLoad_delete)
    document.getElementById("formDelete").action = "customer";
    document.getElementById("formDelete").submit();

}
</script>

<!-- sweetalert -->
<?php
  // check if cus_id exist
  if(isset($_GET['id'])=='same'){
    echo'<script type="text/javascript">
    swal("", "ບໍ່ສາມາດເພີ່ມຂໍ້ມູນໄດ້ເນື່ອງຈາກລະຫັດສະຖານະລູກຄ້ານີ້ມີແລ້ວ ກະລຸນາໃສ່ລະຫັດອື່ນທີ່ແຕກຕ່າງ !!", "info");
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
  // check if customer_id exist in form
  if(isset($_GET['delete'])=='warning'){
    echo'<script type="text/javascript">
    swal("", "ບໍ່ສາມາດລົບຂໍ້ມູນຜູ້ສະໜອງນີ້ໄ້ດເນື່ອງຈາກລະຫັດລູກຄ້ານີ້ເຄີຍໝູນໃຊ້ໃນຂໍ້ມູນຟອມເບີກສິນຄ້າ", "error");
    </script>';
  }
    // check if customer_id exist in distribute
    if(isset($_GET['delete'])=='warning'){
      echo'<script type="text/javascript">
      swal("", "ບໍ່ສາມາດລົບຂໍ້ມູນຜູ້ສະໜອງນີ້ໄ້ດເນື່ອງຈາກລະຫັດລູກຄ້ານີ້ເຄີຍໝູນໃຊ້ໃນຂໍ້ມູນຟອມເບີກສິນຄ້າ", "error");
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
  if(isset($_GET['form'])=='fail'){
    echo'<script type="text/javascript">
    swal("", "ບໍ່ສາມາດລົບຂໍ້ມູນໄດ້ ເນື່ອງຈາກລະຫັດລູກຄ້ານີ້ໄດ້ເຄືຍທຳການສ້າງຟອມແລ້ວ", "error");
    </script>';
  }
?>

<script>
$(document).ready(function() {

    load_data('%%', '0');

    function load_data(query, page) {
        $.ajax({
            url: "fetch_customer.php",
            method: "POST",
            data: {
                query: query,
                page: page
            },
            success: function(data) {
                $('#result').html(data);
            }
        });
    }
    $('#search').keyup(function() {
        var page = "0";
        var search = $(this).val();
        if (search != '') {
            load_data(search, page);
        } else {
            load_data('%%', page);
        }
    });
    $(document).on('click', '.page-links', function() {
        var page = this.id;
        console.log(page);
        var search = $('#search').val();
        if (search != '') {
            load_data(search, page);
        } else {
            load_data('%%', page);
        }
    });
});
</script>


<?php
    include ("../../header-footer/footer.php");
  ?>
<?php
  $title = "ການອະນຸມັດ";
  $path = "../../";
  $links = "../";
  $session_path = "../../";
  include ("../../header-footer/header.php");
?>

<div style="width: 100%;">
    <b>ລາຍການຟອມເບີກ</b>&nbsp <img src="<?php echo $path ?>icon/hidemenu.ico" width="10px">
</div>
<br>
<div class="row">
    <div class="col-md-7">
        <div id="result2">
            <?php
                include ($path."header-footer/loading.php");
            ?>
        </div>
    </div>
    <div class="col-md-5">
        <div class="card">
            <div class="card-body">
                <h5 align="center" class="card-title"></h5>
                <p class="card-text">
                <div class="row">
                    <div class="col-md-6">
                        <div>
                            <button type="button" name="Discard" class="btn btn-outline-danger" data-toggle="modal"
                                data-target="#exampleModal_discard">ລົບຟອມເບີກ</button>
                            <div class="modal fade font14" id="exampleModal_discard" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">ຢຶນຢັນ</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span></button>
                                        </div>
                                        <div class="modal-body" align="center">
                                            ທ່ານບໍ່ຕ້ອງການລົບຟອມເບີກ ຫຼື ບໍ່ ?
                                        </div>
                                        <form action="acception" id="formDelete" method="POST">
                                            <input type="hidden" name="del_form" id="del_form">
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-secondary"
                                                    data-dismiss="modal">ຍົກເລີກ</button>
                                                <button type="submit" name="btnDelete" id="btnDelete"
                                                    class="btn btn-outline-danger ">
                                                    ລົບ
                                                    <span class="" id="load_delete"></span>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div align="right">
                            <button type="button" name="btnAdd" class="btn btn-outline-success" data-toggle="modal"
                                data-target="#exampleModal2">ພິມຟອມເບີກ</button>
                            <div class="modal fade font14" id="exampleModal2" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">ຢຶນຢັນ</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span></button>
                                        </div>
                                        <div class="modal-body" align="center">
                                            ທ່ານຕ້ອງການພິມລາຍງານ ຫຼື ບໍ່ ?
                                        </div>
                                        <form action="#" id="FormReport" method="POST">
                                            <input type="hidden" name="form_id_Report" id="form_id_Report">
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-secondary"
                                                    data-dismiss="modal">ຍົກເລີກ</button>
                                                <button type="submit" name="btnReport" id="btnReport"
                                                    class="btn btn-outline-success">
                                                    ພິມລາຍງານ
                                                    <span class="" id="load_report"></span>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="result">
                <?php
                    include ($path."header-footer/loading.php");
                ?>
            </div>
        </div>
    </div>
    </p>

</div>
</div>
</div>
</div>
</div>
<?php
    if(isset($_POST['del_form'])){
        $obj->del_form2($_POST['del_form']);
    }
   
?>
<!-- sweetalert -->
<?php
  //check save

  if(isset($_GET['id'])=='null'){
    echo'<script type="text/javascript">
    swal("", "ກະລຸນາເລືອກເລກທີຟອມເບີກສິນຄ້າ", "info");
    </script>';
  }
  if(isset($_GET['distribute'])=='has'){
    echo'<script type="text/javascript">
    swal("", "ບໍ່ສາມາດລົບຂໍ້ມູນໄດ້ ເນື່ອງຈາກເລກທີຟອມເບີກນີ້ໄດ້ເຄື່ອນໄຫວໃນການເບິກຈ່າຍສິນຄ້າແລ້ວ", "warning");
    </script>';
  }

  if(isset($_GET['putback'])=='has'){
    echo'<script type="text/javascript">
    swal("", "ບໍ່ສາມາດລົບຂໍ້ມູນໄດ້ ເນື່ອງຈາກເລກທີຟອມເບີກນີ້ໄດ້ເຄື່ອນໄຫວໃນການນຳສິນຄ້າກັບຄືນແລ້ວ", "warning");
    </script>';
  }
  if(isset($_GET['acception'])=='not'){
    echo'<script type="text/javascript">
    swal("", "ບໍ່ສາມາດລົບຂໍ້ມູນໄດ້ ເນື່ອງຈາກເລກທີຟອມເບີກນີ້ໄດ້ຮັບການອະນຸມັດແລ້ວ", "warning");
    </script>';
  }
  if(isset($_GET['del'])=='fail'){
    echo'<script type="text/javascript">
    swal("", "ການລົບຂໍ້ມູນຜິດພາດ", "error");
    </script>';
  }
  if(isset($_GET['del2'])=='success'){
    echo'<script type="text/javascript">
    swal("", "ລົບຂໍ້ມູນສຳເລັດ", "success");
    </script>';
  }
?>

<script>
$(window).load(function() {
    var search = $('#search').val();
    if (search != '') {

    } else {
        var search = "%%";
    }
    var page = 0;
    var emp_id = '<?php echo $_SESSION['emp_id'] ?>';
    load_data(search, page, emp_id);
    load_data2();

    function load_data(query, page, emp_id) {
        $.ajax({
            url: "fetch_accept2.php",
            method: "POST",
            data: {
                query: query,
                page: page,
                emp_id: emp_id
            },
            success: function(data) {
                $('#result2').html(data);
            }
        });
    }
    $('#search').keyup(function() {
        var page = 0;
        var emp_id = '<?php echo $_SESSION['emp_id'] ?>';
        var search = $(this).val();
        if (search != '') {
            load_data(search, page, emp_id);
        } else {
            load_data('%%', page);
        }
    });
    $(document).on('click', '.page-links', function() {
        var page = this.id;
        var emp_id = '<?php echo $_SESSION['emp_id'] ?>';
        console.log(page);
        var search = $('#search').val();
        if (search != '') {
            load_data(search, page, emp_id);
        } else {
            load_data('%%', page, emp_id);
        }
    });

    function load_data2(query) {
        $.ajax({
            url: "fetch_accept.php",
            method: "POST",
            data: {
                query: query
            },
            success: function(data) {
                $('#result').html(data);
            }
        });
    }
    $(document).on('click', '.btnUpdate_accept', function() {
        var form_id = $('#form_id').val();
        console.log(form_id);
        if (form_id != '') {
            load_data2(form_id);
        } else {
            load_data2();
        }
    });
});
</script>
<script>
const FormReport = document.getElementById('FormReport');
const load_save = document.getElementById("load_report");
const btnLoad_save = document.getElementById("btnReport");
FormReport.addEventListener('submit', (e) => {
    e.preventDefault();
    checkInputs();
});

function checkInputs() {
    setloading(load_save, btnLoad_save);
    document.getElementById("FormReport").action = "#";
    document.getElementById("FormReport").submit();
}
const myformudelete = document.getElementById('formDelete');
const load_delete = document.getElementById("load_delete");
const btnLoad_delete = document.getElementById("btnDelete");
myformudelete.addEventListener('submit', (e) => {
    e.preventDefault();
    checkInputs3();
});

function checkInputs3() {

    setloading(load_delete, btnLoad_delete)
    document.getElementById("formDelete").action = "acception";
    document.getElementById("formDelete").submit();

}
</script>
<!-- /.content-wrapper -->
<br>
<?php
    include ("../../header-footer/footer.php");
  ?>
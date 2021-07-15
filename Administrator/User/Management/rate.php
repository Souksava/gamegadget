<?php
  $title = "ຈັດການຂໍ້ມູນອັດຕາແລກປ່ຽນ";
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
<form action="Rate" method="POST" id="formSaveEmp" enctype="multipart/form-data" class="row g-3 needs-validation"
    novalidate>
    <div class="modal fade" id="exampleModalInsertEmp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ເພີ່ມຂໍ້ມູນ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row" align="left">
                        <div class="col-md-12 form-group">
                            <label for="" class="">ສະກຸນເງິນ</label>
                            <input type="text" class="form-control" name="rate_id" id="rate_name" value=""
                                placeholder="ສະກຸນເງິນ" required>
                            <div class="invalid-feedback">
                                ກະລຸນາປ້ອນຊື່ສະກຸນເງິນ
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="" class="">ເລດຊື້</label>
                            <input type="text" class="form-control" name="rate_buy" id="rate_buy" value=""
                                placeholder="ເລດຊື້" required>
                            <div class="invalid-feedback">
                                ກະລຸນາປ້ອນເລດຊື້
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="" class="">ເລດຂາຍ</label>
                            <input type="text" class="form-control" name="rate_sell" id="rate_sell" value=""
                                placeholder="ຊື່ຍີ່ຫໍ້ສິນຄ້າ" required>
                            <div class="invalid-feedback">
                                ກະລຸນາປ້ອນເລດຂາຍ
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
<form action="Rate" method="POST" id="formUpdate" enctype="multipart/form-data" class="row g-3 needs-validation"
    novalidate>
    <div class="modal fade" id="exampleModalUpdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ແກ້ໄຂຂໍ້ມູນ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row" align="left">
                        <div class="col-md-12 form-group">
                            <label for="" class="">ເລດຊື້</label>
                            <input type="hidden" class="form-control" name="rate_id_update" id="rate_id_update" value="">
                            <input type="text" class="form-control" name="rate_buy_update" id="rate_buy_update" value="" placeholder="ເລດຊື້">
                            <div class="invalid-feedback">
                                ກະລຸນາປ້ອນເລດຊື້
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="" class="">ເລດຂາຍ</label>
                            <input type="text" class="form-control" name="rate_sell_update" id="rate_sell_update" value=""
                                placeholder="ເລດຂາຍ" required>
                            <div class="invalid-feedback">
                                ກະລຸນາປ້ອນເລດຂາຍ
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
<form action="Rate" id="formDelete" method="POST" enctype="multipart/form-data">
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
                <th style="width: 50px;text-align: center;">ເຄື່ອງມື</th>
                <th>No.</th>
                <th data-field="id" data-sortable="true">ສະກຸນເງິນ</th>
                <th data-field="buy" data-sortable="true">ຊື້</th>
                <th data-field="sell" data-sortable="true">ຂາຍ</th>

            </tr>
        </thead>
        <tbody>
            <?php
                $no_ = 0;
                $select_rate = mysqli_query($conn,"call select_rate()");
                foreach($select_rate as $row){
                $no_ ++;
            ?>
            <tr>
                <td></td>
                <td class="icon-center">
                    <a href="#" class="fa fa-pen toolcolor btnUpdate_emp" onclick="modal_update()"></a>&nbsp; &nbsp;
                </td>
                <td><?php echo $no_; ?></td>
                <td><?php echo $row["rate_id"]; ?></td>
                <td><?php echo $row["rate_buy"]; ?></td>
                <td><?php echo $row["rate_sell"]; ?></td>
            </tr>
            <?php
                }
                mysqli_free_result($select_rate);  
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
 if(isset($_POST["btnSave"])){
     $rate_id = $_POST["rate_id"];
     $rate_buy = $_POST["rate_buy"];
     $rate_sell = $_POST["rate_sell"];
     $check_rate = mysqli_query($conn,"select * from rate where rate_id='$rate_id'");
     if(mysqli_num_rows($check_rate) > 0){
        echo"<script>";
        echo"window.location.href='Rate?rate=same';";
        echo"</script>";
     }
     else{
         $resultRate = mysqli_query($conn,"insert into rate values('$rate_id','$rate_buy','$rate_sell');");
         if(!$resultRate){
            echo"<script>";
            echo"window.location.href='Rate?save=fail';";
            echo"</script>";
         }
         else{
            echo"<script>";
            echo"window.location.href='Rate?save2=success';";
            echo"</script>";
         }
     }

 }
 if(isset($_POST["btnUpdate"])){
    $rate_id_update = $_POST["rate_id_update"];
    $rate_buy_update = $_POST["rate_buy_update"];
    $rate_sell_update = $_POST["rate_sell_update"];
    $resultupdate = mysqli_query($conn,"update rate set rate_buy='$rate_buy_update',rate_sell='$rate_sell_update' where rate_id='$rate_id_update'");
    if(!$resultupdate){
        echo"<script>";
        echo"window.location.href='Rate?update=fail';";
        echo"</script>";
    }
    else{
        echo"<script>";
        echo"window.location.href='Rate?update2=success';";
        echo"</script>";
    }

 }

 if(isset($_POST["btnDelete"])){
    $logic = 0;
        if(isset($_POST["btSelectItem"])){
            foreach($_POST["btSelectItem"] as $checkid){
                if($checkid == 'LAK' || $checkid == 'THB' || $checkid == 'USD'){
                    $logic = 1;
                    echo"<script>";
                    echo"window.location.href='Rate?rate=found';";
                    echo"</script>";
                    break;
                }
            }
            if($logic == 0){
                $delete = 0;
                foreach($_POST["btSelectItem"] as $id){
                    $delete_many = mysqli_query($conn,"call delete_rate('$id')");
                    if(!$delete_many){
                        $delete = 1;
                        echo"<script>";
                        echo"window.location.href='Rate?del=fail';";
                        echo"</script>";
                    }
                    mysqli_free_result($delete_many);  
                    mysqli_next_result($conn);
                }
                if($delete == 0){
                    echo"<script>";
                    echo"window.location.href='Rate?del2=success';";
                    echo"</script>";
                }
                
            }
        }
        else{
            echo"<script>";
            echo"window.location.href='Rate?Checkbox=null';";
            echo"</script>";
        }
}
 if(isset($_GET["rate"])=="same"){
    echo'<script type="text/javascript">
    swal("", "ສະກຸນເງິນນີ້ມີຢູ່ແລ້ວ ກະລຸນາໃສ່ສະກຸນເງິນທີ່ແຕກຕ່າງ !", "info");
    </script>';
  }  
if(isset($_GET["rate"])=="found"){
    echo'<script type="text/javascript">
    swal("", "ບໍ່ສາມາດລົບຂໍ້ມູນໄດ້ ເນື່ອງຈາກສະກຸນເງິນ LAK, THB ແລະ USD ສະຫງວນໄວ້ !", "error");
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
            $('#rate_id_update').val(data[3]);
            $('#rate_buy_update').val(data[4]);
            $('#rate_sell_update').val(data[5]);

        });
    });
}
</script>
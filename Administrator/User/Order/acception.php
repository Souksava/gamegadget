<?php
  $title = "ການອະນຸມັດ";
  $path = "../../";
  $links = "../";
  $session_path = "../../";
  include ("../../header-footer/header.php");
?>
<style>
.click:hover {
    cursor: pointer;
}
</style>
<div style="width: 100%;">
    <b>ການອະນຸມັດ</b>&nbsp <img src="<?php echo $path ?>icon/hidemenu.ico" width="10px">
</div>
<br>
<div class="row">
    <div class="col-md-7">
        <div class="table-responsive">
            <div id="toolbar">
                <div class="input-group mb-3">

                </div>
            </div>

            <table id="table" data-pagination="true" data-search="true" data-toolbar="#toolbar"
                data-advanced-search="true" data-click-to-select="true" data-id-table="advancedTable"
                data-show-columns="true" data-resizable="true" data-page-list="[10, 25, 50, 100, all]"
                data-search-highlight="true" style="width: 1200px;">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th data-field="id">ເລກທີບິນ</th>
                        <th data-field="company" data-sortable="true">ຜູ້ສະໜອງ</th>
                        <th data-field="amount" data-sortable="true">ລວມ</th>
                        <th data-field="emp_name" data-sortable="true">ຜູ້ສັ່ງຊື້</th>
                        <th data-field="date" data-sortable="true">ວັນທີ</th>
                        <th data-field="time" data-sortable="true">ເວລາ</th>
                        <th data-field="status" data-sortable="true">ສະຖານະ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                  $no_ = 0;
                  $select_product = mysqli_query($conn,"select order_id,emp_name,company,amount,order_date,order_time,o.status,seen2 from orders o left join employees e on o.emp_id=e.emp_id left join suppliers s  on o.sup_id=s.sup_id order by order_date desc");
                  foreach($select_product as $row){
                  $no_ ++;
            ?>
                    <tr class="click" <?php if($row["seen2"] == 0){ echo"style='background-color: #DBF0F7;'";} ?>>
                        <td><?php echo $no_; ?></td>
                        <td><?php echo $row["order_id"] ?></td>
                        <td><?php echo $row["company"] ?></td>
                        <td><?php echo number_format($row["amount"],2) ?></td>
                        <td><?php echo $row["emp_name"] ?></td>
                        <td><?php echo date("d/m/Y",strtotime($row["order_date"])) ?></td>
                        <td><?php echo $row["order_time"] ?></td>
                        <td><?php echo $row["status"] ?></td>
                    </tr>
                    <?php 
                }
                mysqli_free_result($select_product);  
                mysqli_next_result($conn);
            ?>
                </tbody>
            </table>
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
                                data-target="#exampleModal_discard">ລົບໃບສັ່ງຊື້</button>
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
                                            ທ່ານບໍ່ຕ້ອງການລົບໃບສັ່ງຊື້ ຫຼື ບໍ່ ?
                                        </div>
                                        <form action="Acception" id="formDelete" method="POST">
                                            <input type="hidden" name="del_order" id="del_order">
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-secondary"
                                                    data-dismiss="modal">ຍົກເລີກ</button>
                                                <button type="submit" name="btnDeleteOrder" id="btnDeleteOrder"
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
                                data-target="#exampleModal2">ພິມໃບສັ່ງຊື້</button>
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
                                        <form action="ReportBillOrder" id="FormReport" method="POST" target="_blank">
                                            <input type="hidden" name="order_id_report" id="order_id_report">
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
            <div id="result_acception">
                <?php
                    include ($path."header-footer/loading.php");
                ?>
            </div>
        </div>
    </div>
    </p>

</div>
<input type="hidden" name="order_id_fetch" id="order_id_fetch">
<?php
    if(isset($_POST['btnDeleteOrder'])){
        $order_id_del = $_POST["del_order"];
        $check_order = mysqli_query($conn,"select * from orders where order_id='$order_id_del' and status='ອະນຸມັດ'");
        if(mysqli_num_rows($check_order) > 0){
            echo"<script>";
            echo"window.location.href='Acception?order=accept';";
            echo"</script>";
        }
        else{
            $result_del_detail = mysqli_query($conn,"delete from orderdetail where order_id='$order_id_del'");
            if(!$result_del_detail){
                echo"<script>";
                echo"window.location.href='Acception?save=fail';";
                echo"</script>";
            }
            else{
                $result_del_order = mysqli_query($conn,"delete from orders where order_id='$order_id_del'");
                if(!$result_del_order){
                    echo"<script>";
                    echo"window.location.href='Acception?save=fail';";
                    echo"</script>";
                }
                else{
                    echo"<script>";
                    echo"window.location.href='Acception?save2=success';";
                    echo"</script>";
                }
            }
        }
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
  if(isset($_GET['order'])=='accept'){
    echo'<script type="text/javascript">
    swal("", "ບໍສາມາດບໍ່ໃບສັ່ງຊື້ນີ້ໄດ້ ເນື່ອງຈາກໃບສັ່ງຊື້ນີ້ໄດ້ຮັບການອະນຸມັດແລ້ວ", "warning");
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

<!-- /.content-wrapper -->
<br>
<?php
    include ("../../header-footer/footer.php");
?>
<script>
$(function() {
    $('#table').bootstrapTable();
});
</script>
<script>
$(document).ready(function() {
    $(document).on("click", "#table tbody tr", function() {
        $('.click').on('click', function() {
            // $('#table').bootstrapTable();
            $('#exampleModalUpdate').modal('show');
            $tr = $(this).closest('tr');
            var data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();

            console.log(data);
            $('#order_id_fetch').val(data[1]);
            $('#order_id_report').val(data[1]);
            $('#del_order').val(data[1]);
        });
    });
    load_data_selldetail("");

    function load_data_selldetail(query) {
        $.ajax({
            url: "fetch_acception.php",
            method: "POST",
            data: {
                query: query
            },
            success: function(data) {
                $("#result_acception").html(data);
            }
        });
    }
    $(document).on('click', '.click', function() {
        var id = $("#order_id_fetch").val();
        if (id != "") {
            load_data_selldetail(id);
        } else {
            load_data_selldetail("");
        }
    });
});
</script>
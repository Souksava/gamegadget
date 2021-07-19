<?php
  $title = "ສັ່ງຊື້ອອນລາຍ";
  $path="../../";
  $links = "../";
  $session_path = "../../";
  include ("../../header-footer/header.php");
  ?>
<style>
tr {
    cursor: pointer;
}
</style>
<!-- modal selldetail -->
<form action="Online" id="form_confirm" method="POST">
    <div class="modal fade" id="exampleModalfetch" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ລາຍລະອຽດການສັ່ງຊື້</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <input type="hidden" id="sell_iddetail" name="sell_iddetail">
                            <div id="result_selldetail">
                                <?php
                                    include ($path."header-footer/loading.php");
                                ?>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <div class="card">
                                <div class="card-header">
                                    ລູກຄ້າ
                                </div>
                                <div class="card-body">
                                    <input type="hidden" id="sell_id_cus" name="sell_id_cus">

                                    <div id="result_customer">
                                        <?php
                                            include ($path."header-footer/loading.php");
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">ຍົກເລີກ</button>
                    <button type="submit" name="btnConfirm" id="btnConfirm" class="btn btn-outline-primary" onclick="">
                        ຢືນຢັນການສັ່ງຊື້
                        <span class="" id="load_Delete"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
<div class="container-fluid font12">
    <?php
        $result_online = mysqli_query($conn,"select sell_id,cus_name,sell_date,sell_time,amount,s.status,status_cash,s.img_path,sell_type,cupon_key,cupon_price,place_deli,seen1 from sell s left join customers c on s.cus_id=c.cus_id WHERE status='ສັ່ງຊື້' order by sell_date desc;");
        if(mysqli_num_rows($result_online) > 0){
    ?>
    <div class="table-responsive">
        <table id="table" data-pagination="true" data-search="true" data-toolbar="#toolbar" data-advanced-search="true"
            data-click-to-select="true" data-id-table="advancedTable" data-show-columns="true" data-resizable="true"
            data-id-field="name" data-page-list="[10, 25, 50, 100, all]" data-search-highlight="true"
            style="width: 1800px;">
            <thead>
                </tr>
                <th data-field="no" data-sortable="true">ລຳດັບ</th>
                <th data-field="billno" data-sortable="true">ເລກທີບິນ</th>
                <th data-field="customer" data-sortable="true">ລູກຄ້າ</th>
                <th data-field="amount" data-sortable="true">ມູນຄ່າລວມ</th>
                <th data-field="status" data-sortable="true">ສະຖານະ</th>
                <th data-field="pay" data-sortable="true">ການຈ່າຍ</th>
                <th data-field="type_sell" data-sortable="true">ປະເພດຂາຍ</th>
                <th data-field="bcel" data-sortable="true">ພາບລິບການໂອນ</th>
                <th data-field="date" data-sortable="true">ວັນທີເວລາ</th>
                <th data-field="remark" data-sortable="true">ໝາຍເຫດ </th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $no_ = 0;
                    foreach($result_online as $row){
                        $no_ ++;
                ?>
                <tr class="btn_fetch" <?php if($row["seen1"] == 0){ echo"style='background-color: #DBF0F7;'";} ?>>
                    <td><?php echo $no_; ?></td>
                    <td><?php echo $row["sell_id"]; ?></td>
                    <td><?php echo $row["cus_name"]; ?></td>
                    <td><?php echo number_format($row["amount"],2); ?></td>
                    <td><?php echo $row["status"]; ?></td>
                    <td><?php echo $row["status_cash"]; ?></td>
                    <td><?php echo $row["sell_type"]; ?></td>
                    <td>
                        <img src="../../image/image.jpeg" class="img-circle elevation-2" alt="" width="55px" />
                    </td>
                    <td><?php echo date("d/m/Y",strtotime($row["sell_date"])); ?> <?php echo $row["sell_time"]; ?></td>
                    <td></td>
                </tr>
                <?php
                    }
                ?>
            </tbody>
        </table>
    </div>
    <?php
        }
        else{
            echo'
            <div align="center">
                <hr size="1" style="width: 90%;"/>
                    ຍັງບໍ່ມີຂໍ້ມູນ
                <hr size="1" style="width: 90%;"/>
            </div>
        ';
        }
    ?>
</div>
<?php
    include ("../../header-footer/footer.php");
    if(isset($_POST["btnConfirm"])){
        $id = $_POST["sell_iddetail"];
        $result = mysqli_query($conn,"update sell set status='ສັ່ງຊື້ສຳເລັດ' where sell_id='$id'");
        if(!$result){
            echo"<script>";
            echo"window.location.href='Online?save=fail';";
            echo"</script>";
        }
        else{
            echo"<script>";
            echo"window.location.href='Online?save2=success';";
            echo"</script>";
        }
    }
    if(isset($_GET['save'])=='fail'){
        echo'<script type="text/javascript">
        swal("", "ຢືນຢັນການສັ່ງຊື້ຜິດພາດ", "error");
        </script>';
      }
      if(isset($_GET['save2'])=='success'){
        echo'<script type="text/javascript">
        swal("", "ຢືນຢັນການສັ່ງຊື້ສຳເລັດ", "success");
        </script>';
      }
?>
<script>
$(function() {
    $('#table').bootstrapTable();
});
</script>

<script>
    $(document).on('click', '.btn_fetch', function() {
        $('#exampleModalfetch').modal('show');
        $tr = $(this).closest('tr');
        var data = $tr.children("td").map(function() {
            return $(this).text();
        }).get();

        console.log(data);
        $('#sell_iddetail').val(data[1]);
        $('#sell_id_cus').val(data[1]);
    });

</script>

<script>
$(document).ready(function() {
    load_data_selldetail("");
    load_data_customerdetail("");


    function load_data_selldetail(query) {
        $.ajax({
            url: "fetch_selldetail.php",
            method: "POST",
            data: {
                query: query
            },
            success: function(data) {
                $("#result_selldetail").html(data);
            }
        });
    }
    function load_data_customerdetail(query) {
        $.ajax({
            url: "fetch_customer.php",
            method: "POST",
            data: {
                query: query
            },
            success: function(data) {
                $("#result_customer").html(data);
            }
        });
    }
    $(document).on('click', '.btn_fetch', function() {
        var id_sell = $("#sell_iddetail").val();
        var id_cus = $("#sell_id_cus").val();
        if (id_sell != "" && id_cus != "") {
            load_data_selldetail(id_sell);
            load_data_customerdetail(id_cus);
        } else {
            load_data_selldetail("");
            load_data_customerdetail("");
        }
    });

});
</script>
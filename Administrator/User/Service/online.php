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
<form action="Confirm" id="form_confirm" method="POST" target="_blank">
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
                    <input type="hidden" name="id" id="id">
                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <div class="table-responsive2" style="text-align: center;">
                                <table class="table font12" style="width: 750px">
                                    <tr>
                                        <th style="width: 30px;">#</th>
                                        <th>ສິນຄ້າ</th>
                                        <th>ລະຫັດສິນຄ້າ</th>
                                        <th>ຊື່ສິນຄ້າ</th>
                                        <th>ຈຳນວນ</th>
                                        <th>ລາຄາ</th>
                                        <th>ລວມ</th>
                                    </tr>

                                    <tr>
                                        <td>1</td>
                                        <td>
                                            <a href="<?php echo $path?>image/img_5f1beac4d3794.jpeg"><img
                                                    src="<?php echo $path?>image/img_5f1beac4d3794.jpeg" alt=" class="
                                                    img-circle elevation-2 alt="" width="55px"></a>
                                        </td>
                                        <td>0311000101</td>
                                        <td>ຫູຟັງ Headset & Earphones Fantech HG13 CHIEF</td>
                                        <td>1 ກ່ອງ</td>
                                        <td>200,000.00</td>
                                        <td>200,000.00</td>
                                    </tr>

                                </table>
                            </div>
                            <div class="col-md-12" align="right">
                                <br>
                                <h5 style="color: #CE3131;">ມູນຄ່າ: 200,000.00 LAK</h5>
                                <input type="hidden" name="amount" id="amount" value="">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <div class="card">
                                <div class="card-header">
                                    ລາຍລະອຽດລູກຄ້າ
                                </div>
                                <div class="card-body">
                                    <div align="center">
                                        <a href="../../image/image.jpeg">
                                            <img src="../../image/image.jpeg"
                                                class="img-circle elevation-2" alt="" width="120px" />
                                        </a>
                                    </div>
                                    <div>
                                        <p>
                                            ປະເພດການຈ່າຍ: ເງິນສົດ<br>
                                            ເບີໂທລະສັບ: 020 5509 9269<br>
                                            What's App: 020 5509 9269
                                        </p>
                                        <p>
                                        <h3>ສະຖານທີຈັດສົ່ງ</h3>
                                         ບ້ານ ດອນໜູນ ເມືອງໄຊທານີ ນະຄອນຫຼວງວຽງຈັນ
                                        </p>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 form-group">
                                        <label for="">ຄ່າສົ່ງ</label>
                                        <input type="text" class="form-control" placeholder="ຄ່າສົ່ງ">
                                        </div>
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
    <div class="table-responsive">
        <table id="table" data-pagination="true" data-search="true" data-toolbar="#toolbar" data-advanced-search="true"
            data-click-to-select="true" data-id-table="advancedTable" data-show-columns="true" data-resizable="true"
            data-id-field="name" data-page-list="[10, 25, 50, 100, all]" data-search-highlight="true"
            style="width: 1800px;">
            <thead>
                </tr>
                <th data-field="no" data-sortable="true">ລຳດັບ</th>
                <th data-field="billno" data-sortable="true">ເລກທີບິນ</th>
                <th data-field="emp_name" data-sortable="true">ພະນັກງານ</th>
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
                <tr class="btn_fetch">
                    <td>1</td>
                    <td>79</td>
                    <td>ນົບພະລັກ</td>
                    <td>ເທບພະຈັນ</td>
                    <td>200,000.00</td>
                    <td>ສັ່ງຊື້</td>
                    <td>ເງິນສົດ</td>
                    <td>Online</td>
                    <td>
                        <img src="../../image/image.jpeg" class="img-circle elevation-2" alt="" width="55px" />
                    </td>
                    <td>29/06/2021 10:30:59</td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
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
    $('.btn_fetch').on('click', function() {
        $('#exampleModalfetch').modal('show');
        $tr = $(this).closest('tr');
        var data = $tr.children("td").map(function() {
            return $(this).text();
        }).get();

        console.log(data);

        $('#id').val(data[1]);
    });
});
</script>
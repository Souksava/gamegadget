<?php
  $title = "ສັ່ງຊື້ສິນຄ້າ";
  $path="../../";
  $links = "../";
  $session_path = "../../";
  include (''.$path.'header-footer/header.php');
?>
<style>
.click:hover {
    cursor: pointer;
}
</style>
<div style="width: 100%;">
    <a href="#">ກວດສອບສິນຄ້າ</a>&nbsp <img src="<?php echo $path ?>icon/hidemenu.ico" width="10px">
</div>
<div class="row">
    <div class="col-md-7">
        
<div class="table-responsive">
    <table id="table" data-pagination="true" data-search="true" data-toolbar="#toolbar" data-advanced-search="true"
        data-click-to-select="true" data-id-table="advancedTable" data-show-columns="true" data-resizable="true"
        data-id-field="name" data-page-list="[10, 25, 50, 100, all]" data-search-highlight="true"
        style="width: 1000px;">
        <thead>
            <tr>
                <th>No.</th>
                <th data-sortable="true">ສິນຄ້າ</th>
                <th data-field="id" data-sortable="true">ລະຫັດ</th>
                <th data-field="name" data-sortable="true">ຊື່ສິນຄ້າ</th>
                <th data-field="category" data-sortable="true">ປະເພດສິນຄ້າ</th>
                <th data-field="brand" data-sortable="true">ຍີ່ຫໍ້</th>
                <th data-field="qty" data-sortable="true">ຈຳນວນ</th>
                <th data-field="qtyalert" data-sortable="true">ເງື່ອນໄຂການສັ່ງຊື້</th>
            </tr>
        </thead>
        <tbody>
            <tr class="click" data-toggle="modal" data-target="#exampleModalUpdate">
                <td>1</td>
                <td> <a href="<?php echo $path;?>image/img_5f1beac4d3794.jpeg" target="_blank">
                        <img src="<?php echo $path;?>image/img_5f1beac4d3794.jpeg" class="img-circle elevation-2" alt=""
                            width="50px">
                    </a>
                </td>
                <td>0311000101</td>
                <td>HG13 CHIEF</td>
                <td>ຫູຟັງ ຫູຟັງ Headset & Earphones</td>
                <td>Fantech</td>
                <td>1 ກ່ອງ</td>
                <td>1</td>
            </tr>
        </tbody>
    </table>
</div>
    </div>
    <div class="col-md-5">
        <div class="card">
            <div class="card-body">
                <h5 align="center" class="card-title"></h5>
                <p class="card-text">
                <form action="form" id="form_save" method="POST">
                    <div>
                        ເລກທີໃບສັ່ງຊື້: <label class="order_id"></label>
                    </div>
                    <form action="Order" method="POST" id="form_save">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-control2">
                                    <select name="sup_id" id="sup_id" class="selectcenter">
                                        <option value="" disabled selected>--- ຜູ້ສະໜອງ ---</option>
                                        <option value="">
                                            JIRO Computer
                                        </option>
                                    </select>
                                    <i class="fas fa-check-circle "></i>
                                    <i class="fas fa-exclamation-circle "></i>
                                    <small class="">Error message</small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div align="center-right">
                                    <button type="button" name="btnAdd" id="btn_order"
                                        class="btn btn-outline-success btn-block" data-toggle="modal"
                                        data-target="#exampleModal2" style="padding: 8px 0px 8px 0px">ສັ່ງຊື້</button>
                                    <div class="modal fade font14" id="exampleModal2" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">ຢຶນຢັນ</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span></button>
                                                </div>
                                                <div class="modal-body" align="center">
                                                    ທ່ານຕ້ອງການຈະບັນທຶກຂໍ້ມູນຟອມເຂົ້າໃນລະບົບ ຫຼື ບໍ່ ?
                                                    <input type="hidden" id="order_id" name="order_id">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-outline-secondary"
                                                        data-dismiss="modal">ຍົກເລີກ</button>
                                                    <button type="submit" name="Save" id="btnSave_load"
                                                        class="btn btn-outline-success" onclick="">
                                                        ບັນທຶກ
                                                        <span class="" id="load_save"></span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
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
                                <th style="width: 75px;"><a href="#" data-toggle="modal"
                                        data-target="#exampleModalClear" class="clear">ລ້າງ</a></th>
                            </tr>

                            <tr>
                                <td>1</td>
                                <td>
                                    <a href="<?php echo $path?>image/img_5f1beac4d3794.jpeg"><img
                                            src="<?php echo $path?>image/img_5f1beac4d3794.jpeg" alt=" class=" img-circle
                                            elevation-2 alt="" width="55px"></a>
                                </td>
                                <td>0311000101</td>
                                <td>ຫູຟັງ Headset & Earphones Fantech HG13 CHIEF</td>
                                <td>1 ກ່ອງ</td>
                                <td>200,000.00</td>
                                <td>200,000.00</td>
                                <td>
                                    <a href="#" data-toggle="modal" data-target="#exampleModalDelete_cookie"
                                        class="fa fa-trash toolcolor btnDelete_cookie"></a>
                                </td>
                            </tr>

                        </table>
                    </div>
                    <div class="col-md-12" align="right">
                        <br>
                        <h5 style="color: #CE3131;">ມູນຄ່າ: 200,000.00 LAK</h5>
                        <input type="hidden" name="amount" id="amount" value="">
                    </div>

                </form>
                </p>
            </div>
        </div>
    </div>
</div>

<form action="Order" id="formClear" method="POST" enctype="multipart/form-data">
    <div class="modal fade" id="exampleModalClear" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                    ທ່ານຕ້ອງການລ້າງລາຍການ ຫຼື ບໍ່ ?
                    <input type="hidden" id="btnClear" name="btnClear">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">ຍົກເລີກ</button>
                    <button type="submit" name="btnclear_form" id="btnclear_form"
                        class="btn btn-outline-danger">ລ້າງລາຍການ <span class="" id="load_Clear"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- modal form delete -->
<form action="form" id="formDelete_cookie_one" method="POST" enctype="multipart/form-data">
    <div class="modal fade" id="exampleModalDelete_cookie" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ຢືນຢັນການລົບຂໍ້ມູນ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" align="center">
                    <input type="hidden" name="del_list_form_id" id="del_list_form_id">
                    ທ່ານຕ້ອງການລົບຂໍ້ມູນ ຫຼື ບໍ່ ?
                    <input type="hidden" id="cookie_pro_id" name="cookie_pro_id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">ຍົກເລີກ</button>
                    <button type="submit" name="btnDelete_cookie_one" id="btnDelete_cookie_one"
                        class="btn btn-outline-danger">
                        ລົບ
                        <span class="" id="load_delete_cookie_one"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- modal form add -->
<form action="Order" id="Form_Add" method="POST" enctype="multipart/form-data">
    <div class="modal fade" id="exampleModalUpdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ເພີ່ມລາຍການສັ່ງຊື້</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row" align="left">
                        <div class="col-md-12 col-sm-6 form-control2">
                            <input type="hidden" name="pro_id_order" id="pro_id_order">
                            <label>ຮູບສິນຄ້າ</label>
                            <div class="col-md-12 col-sm-6 form-control2">
                                <img src="../../image/img_5f44c26b27f5c.jpg" id="output" width="100%" height="250">
                            </div>
                            <i class="fas fa-check-circle "></i>
                            <i class="fas fa-exclamation-circle "></i>
                            <small class="">Error message</small>
                        </div>
                        <div class="col-md-12 col-sm-6 form-control2">
                            <label>ຈຳນວນ</label>
                            <input type="number" min="0" name="qty" id="qty" placeholder="ຈຳນວນ" class="form-control">
                            <i class="fas fa-check-circle "></i>
                            <i class="fas fa-exclamation-circle "></i>
                            <small class="">Error message</small>
                        </div>
                        <div class="col-md-12 col-sm-6 form-control2">
                            <label>ລາຄາ</label>
                            <input type="number" min="0" name="price" id="price" placeholder="ລາຄາ"
                                class="form-control">
                            <i class="fas fa-check-circle "></i>
                            <i class="fas fa-exclamation-circle "></i>
                            <small class="">Error message</small>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">ຍົກເລີກ</button>
                    <button type="submit" name="btnUpdate" id="btnUpdate" class="btn btn-outline-success"
                        onclick="">ເພີ່ມ
                        <span class="" id="load_update"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
<?php
 include (''.$path.'header-footer/footer.php');
?>
<script>
$(function() {
    $('#table').bootstrapTable();
});
</script>
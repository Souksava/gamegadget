<?php
  $title = "ນຳເຂົ້າສິນຄ້າ";
  $path="../../";
  $links = "../";
  $session_path = "../../";
  include (''.$path.'header-footer/header.php');
?>
<div style="width: 100%;">
    <div style="width: 48%; float: left;">
        <b>ລາຍການສິນຄ້າ</b>&nbsp <img src="../../icon/hidemenu.ico" width="10px">
    </div>
    <div style="width: 46%; float: right;" align="right">
        <form action="Import" id="form_add" method="POST" enctype="multipart/form-data">
            <a href="#" data-toggle="modal" data-target="#exampleModalemp">
                <img src="../../icon/add.ico" alt="" width="25px">
            </a>
            <div class="modal fade" id="exampleModalemp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">ນຳເຂົ້າສິນຄ້າ</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row" align="left">
                                <div class="col-md-12 col-sm-6 form-control2">
                                    <label>ລະຫັດສິນຄ້າ</label>
                                    <input type="text" name="pro_id_import" id="pro_id_import" placeholder="ລະຫັດສິນຄ້າ"
                                        class="form-control">
                                    <i class="fas fa-check-circle "></i>
                                    <i class="fas fa-exclamation-circle "></i>
                                    <small class="">Error message</small>
                                </div>
                                <div class="col-md-12 col-sm-6 form-control2">
                                    <label>ຈຳນວນ</label>
                                    <input type="number" min="0" name="qty" id="qty" class="form-control"
                                        placeholder="ຈຳນວນ">
                                    <i class="fas fa-check-circle "></i>
                                    <i class="fas fa-exclamation-circle "></i>
                                    <small class="">Error message</small>
                                </div>
                                <div class="col-md-12 col-sm-6 form-control2">
                                    <label>ລາຄາ</label>
                                    <input type="number" min="0" name="price" id="price" class="form-control"
                                        placeholder="ລາຄາ">
                                    <i class="fas fa-check-circle "></i>
                                    <i class="fas fa-exclamation-circle "></i>
                                    <small class="">Error message</small>
                                </div>
                                <div class="col-md-12 col-sm-6 form-control2">
                                    <label>ໝາຍເຫດ</label>
                                    <input type="text" name="remark" id="remark" placeholder="ໝາຍເຫດ"
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
                            <button type="submit" name="btnAdd" id="btnAdd" class="btn btn-outline-primary">ບັນທຶກ
                                <span class="" id="load_add"></span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="clearfix"></div><br>
<div class="container-fluid font12">
    <div class="row">
        <div class="col-md-8">
            <div class="table-responsive">
                <table class="table-bordered" style="width: 1200px;text-align: center;">
                    <tr style="font-size: 18px;">
                        <th style="width: 45px;"><b href="#" data-toggle="modal" data-target="#exampleModalClear"
                                class="clear">ລ້າງ</b></th>
                        <th style="width: 45px;">ລຳດັບ</th>
                        <th style="width: 60px;">ສິນຄ້າ</th>
                        <th style="width: 90px;">ລະຫັດສິນຄ້າ</th>
                        <th style="width: 180px;">ຊື່ສິນຄ້າ</th>
                        <th style="width: 55px;">ຈຳນວນ</th>
                        <th style="width: 120px;">ລາຄາ</th>
                        <th style="width: 150px;">ລວມ</th>
                        <th style="width: 150px;">ໝາຍເຫດ</th>
                    </tr>
                    <tr>
                        <td>
                            <a href="#" data-toggle="modal" data-target="#exampleModaldel"
                                class="fa fa-trash toolcolor btnDelete_cookie"></a>
                        </td>
                        <td>1</td>
                        <td>
                            <a href="<?php echo $path?>image/image.jpeg"><img src="<?php echo $path?>image/image.jpeg"
                                    alt=" class=" img-circle elevation-2 alt="" width="55px"></a>
                        </td>
                        <td>0311000101</td>
                        <td>ຫູຟັງ Headset & Earphones Fantech HG13 CHIEF</td>
                        <td>1 ກ່ອງ</td>
                        <td>200,000.00</td>
                        <td>200,000.00</td>
                        <td></td>
                    </tr>
                </table>
            </div>
            <br>
            <!-- pagination -->
        </div>
        <div class="col-lg-3 font12">
            <div class="row row-cols-1 row-cols-md-1">
                <div class="col mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 align="center" class="card-title"></h5>
                            <p class="card-text">
                            <form action="Import" id="formSave" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-12">
                                        ຍອມລວມ <br>
                                        <h5 style="color: #CE3131;"> 200,000.00 ກີບ</h5>
                                    </div>
                                    <hr size="3" align="center" width="100%">
                                    <div class="col-md-12 form-control2">
                                        <label>ຜູ້ສະໜອງ</label>
                                        <select name="sup_id_import" id="sup_id_import" class="selectcenter">
                                            <option value="" disabled selected>--- ເລືອກຜູ້ສະໜອງ ---</option>
                                            <option value="">
                                                Jiro Computer
                                            </option>
                                        </select>
                                        <i class="fas fa-check-circle "></i>
                                        <i class="fas fa-exclamation-circle "></i>
                                        <small class="">Error message</small>
                                    </div>
                                    <div class="col-md-12 form-control2">
                                        <label>ເລກທີໃບນຳເຂົ້າ</label>
                                        <input type="text" id="import_no" name="import_no" placeholder="ເລກທີໃບນຳເຂົ້າ">
                                        <i class="fas fa-check-circle "></i>
                                        <i class="fas fa-exclamation-circle "></i>
                                        <small class="">Error message</small>
                                    </div>
                                    <div class="col-md-12 form-control2">
                                        <label>ເລກທີໃບສັ່ງຊື້</label>
                                        <input type="text" id="order_id_import" name="order_id_import"
                                            placeholder="ເລກທີໃບສັ່ງຊື້">
                                        <i class="fas fa-check-circle "></i>
                                        <i class="fas fa-exclamation-circle "></i>
                                        <small class="">Error message</small>
                                    </div>
                                    <div class="col-md-12" align="center">
                                        <input type="hidden" name="btnStock" id="btnStock">
                                        <button type="button" name="btnAdd" class="btn btn-outline-success"
                                            data-toggle="modal" data-target="#exampleModal2">ບັນທຶກການນຳເຂົ້າ</button>
                                        <div class="modal fade font14" id="exampleModal2" tabindex="-1" role="dialog"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">ຢຶນຢັນ</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body" align="center">
                                                        ທ່ານຕ້ອງການບັນທຶກການນຳເຂົ້າສິນຄ້າ ຫຼື ບໍ່ ?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-outline-secondary"
                                                            data-dismiss="modal">ຍົກເລີກ</button>
                                                        <button type="submit" name="btnSave" id="btnSave"
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
                            </form>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- /.content-wrapper -->
<br>

<!-- modal form delete -->
<form action="Import" id="formDelete_cookie_one" method="POST" enctype="multipart/form-data">
    <div class="modal fade" id="exampleModaldel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                    ທ່ານຕ້ອງການລົບຂໍ້ມູນ ຫຼື ບໍ່ ?
                    <input type="hidden" id="cookie_pro_id_import" name="cookie_pro_id_import">
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
<form action="Import" id="formClear" method="POST" enctype="multipart/form-data">
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
                    <input type="hidden" id="btnClear_import" name="btnClear_import">
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
<?php
 include (''.$path.'header-footer/footer.php');
  ?>
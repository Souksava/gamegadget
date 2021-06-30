<?php
    $title = "ນຳເຂົ້າສິນຄ້າ";
    $path="../../";
    $links = "../";
    $session_path = "../../";
    include ("../../header-footer/header.php");
    $amount = 0;
?>

<div style="width: 100%;">
    <div style="width: 48%; float: left;">
        <b>ລາຍການສິນຄ້າ</b>&nbsp <img src="../../icon/hidemenu.ico" width="10px"> 
    </div>
    <div style="width: 46%; float: right;" align="right">
        <form action="import" id="form1" method="POST" enctype="multipart/form-data">
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
                                    <input type="hidden" name="stock" id="stock">
                                    <input type="text" name="code" id="code" placeholder="ລະຫັດສິນຄ້າ" class="form-control">
                                    <i class="fas fa-check-circle "></i>
                                    <i class="fas fa-exclamation-circle "></i>
                                    <small class="">Error message</small>
                                </div>
                                <div class="col-md-12 col-sm-6 form-control2">
                                    <label>Serial Number</label>
                                    <input type="text" name="serial" id="serial" class="form-control" placeholder="Serial Number">
                                    <i class="fas fa-check-circle "></i>
                                    <i class="fas fa-exclamation-circle "></i>
                                    <small class="">Error message</small>
                                </div>
                                <div class="col-md-12 col-sm-6 form-control2">
                                    <label>ຈຳນວນ</label>
                                    <input type="number" min="0" name="qty" id="qty" class="form-control" placeholder="ຈຳນວນ">
                                    <i class="fas fa-check-circle "></i>
                                    <i class="fas fa-exclamation-circle "></i>
                                    <small class="">Error message</small>
                                </div>
                                <div class="col-md-12 col-sm-6 form-control2">
                                    <label>ລາຄາ</label>
                                    <input type="number" min="0" name="price" id="price" class="form-control" placeholder="ລາຄາ">
                                    <i class="fas fa-check-circle "></i>
                                    <i class="fas fa-exclamation-circle "></i>
                                    <small class="">Error message</small>
                                </div>
                                <div class="col-md-12 col-sm-6 form-control2">
                                    <label>ເລກທີໃບສັ່ງຊື້ D.N.V</label>
                                    <input type="text" name="dnv" id="dnv" class="form-control" placeholder="ເລກທີໃບສັ່ງຊື້ D.N.V">
                                    <i class="fas fa-check-circle "></i>
                                    <i class="fas fa-exclamation-circle "></i>
                                    <small class="">Error message</small>
                                </div>
                                <div class="col-md-12 col-sm-6 form-control2">
                                    <label>ເລກທີບິນນຳເຂົ້າສິນຄ້າ</label>
                                    <input type="text" name="imp_no" id="imp_no" class="form-control" placeholder="ເລກທີບິນນຳເຂົ້າສິນຄ້າ">
                                    <i class="fas fa-check-circle "></i>
                                    <i class="fas fa-exclamation-circle "></i>
                                    <small class="">Error message</small>
                                </div>
                                <div class="col-md-12 col-sm-6 form-control2">
                                    <label>ໝາຍເລກເຄືອງ</label>
                                    <input type="text" name="pro_no" id="pro_no" class="form-control" placeholder="ໝາຍເລກເຄືອງ">
                                    <i class="fas fa-check-circle "></i>
                                    <i class="fas fa-exclamation-circle "></i>
                                    <small class="">Error message</small>
                                </div>
                                <div class="col-md-12 col-sm-6 form-control2">
                                    <label>ໝາຍເຫດ</label>
                                    <input type="text" name="remark" id="remark" placeholder="ໝາຍເຫດ" class="form-control">
                                    <i class="fas fa-check-circle "></i>
                                    <i class="fas fa-exclamation-circle "></i>
                                    <small class="">Error message</small>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary"
                                data-dismiss="modal">ຍົກເລີກ</button>
                            <button type="submit" name="btnSave" class="btn btn-outline-primary">ບັນທຶກ</button>
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
            <?php 
               $obj->select_stock_list();
                if(isset($_COOKIE['stock_list'])){
            ?>
            <div class="table-responsive">
                <table class="table" style="width: 1500px;">
                    <tr>
                        <th style="width: 80px;" scope="col">ສິນຄ້າ</th>
                        <th style="width: 120px;" scope="col">ລະຫັດສິນຄ້າ</th>
                        <th style="width: 180px;" scope="col">ຊື່ສິນຄ້າ</th>
                        <th style="width: 120px;" scope="col">Serial</th>
                        <th style="width: 100px;" scope="col">ລຸ້ນເຄື່ອງ</th>
                        <th style="width: 100px;" scope="col">ຈຳນວນ</th>
                        <th style="width: 100px;" scope="col">ລາຄາ</th>
                        <th style="width: 120px;" scope="col">ລວມ</th>
                        <th style="width: 60px;" scope="col">D.N.V</th>
                        <th style="width: 180px;" scope="col">ເລກທີບິນນຳເຂົ້າສິນຄ້າ</th>
                        <th style="width: 120px;" scope="col">ໝາຍເລກເຄືອງ</th>
                        <th style="width: 120px;" scope="col">ໝາຍເຫດ</th>
                        <th style="width: 75px;"><a href="#" data-toggle="modal" data-target="#exampleModalClear" class="clear">ລ້າງ</a></th>
                    </tr>
                    <?php
                      
                        foreach($cart_data as $keys => $values){
                        $amount += $values['qty'] * $values['price'];
                    ?>
                    <tr>
                        <td style="display: none;"><?php echo $values['serial'] ?></td>
                       <?php
                            if($values['img_path'] == ''){
                        ?>
                         <td>
                         <a href="<?php echo $path ?>image/logo.png" target="_blank">
                         <img src="<?php echo $path ?>image/logo.png" class="img-circle elevation-2" alt="" width="30px">
                               
                            </a>
                        </td>
                        <?php
                            }
                            else{
                        ?>
                         <td>
                         <a href="<?php echo $path ?>image/<?php echo $values['img_path']; ?>" target="_blank">
                         <img src="<?php echo $path ?>image/<?php echo $values['img_path']; ?>" class="img-circle elevation-2" alt="" width="30px">
                            </a>
                        </td>
                        <?php
                            }
                       ?>
                        <td><?php echo $values['code'] ?></td>
                        <td>
                            <?php echo $values['cate_name'] ?> <?php echo $values['brand_name'] ?><br>
                            <?php echo $values['name'] ?>
                        </td>
                        <td><?php echo $values['serial'] ?></td>
                        <td><?php echo $values['gen'] ?></td>
                        <td><?php echo $values['qty'] ?>  <?php echo $values['unit_name'] ?></td>
                        <td><?php echo number_format($values['price'],2) ?></td>
                        <td><?php echo number_format($values['qty'] * $values['price'],2) ?></td>
                        <td><?php echo $values['dnv'] ?></td>
                        <td><?php echo $values['import_no'] ?></td>
                        <td><?php echo $values['pro_no'] ?></td>
                        <td><?php echo $values['remark'] ?></td>
                        <td>
                        <a href="#" data-toggle="modal" data-target="#exampleModalDelete"
                                class="fa fa-trash toolcolor btnDelete_stock"></a>&nbsp; &nbsp;
                        </td>
                    </tr>
                    <?php
                        }
                    ?>
                </table>
                <hr size="3" align="center" width="100%">
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
                            <form action="import" id="formSave" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-6">
                                    ຍອມລວມ
                                    </div>
                                    <div class="col-md-6" align="right">
                                        <h4 style="color: #CE3131;"> <?php echo number_format($amount,2) ?> ກີບ</h4>
                                    </div>
                                    <hr size="3" align="center" width="100%">
                                    <div class="col-md-12 form-control2">
                                        <label>ຜູ້ສະໜອງ</label>
                                        <select name="sup_id" id="sup_id" class="selectcenter">
                                            <option value="" disabled selected>--- ເລືອກຜູ້ສະໜອງ ---</option>
                                            <?php
                                                $obj->select_supplier_count("%%");
                                                foreach($resultsupplier_count as $rowsup){
                                            ?>
                                            <option value="<?php echo $rowsup['sup_id'] ?>"><?php echo $rowsup['company'] ?></option>
                                            <?php 
                                                }
                                                mysqli_free_result($resultsupplier_count);  
                                                mysqli_next_result($conn);
                                            ?>
                                        </select>
                                        <i class="fas fa-check-circle "></i>
                                        <i class="fas fa-exclamation-circle "></i>
                                        <small class="">Error message</small>
                                    </div>
                                    <div class="col-md-12 form-control2">
                                        <label>ເລດເງີນ</label>
                                        <select name="rate_id" id="rate_id" class="selectcenter">
                                            <option value="" disabled selected>--- ເລືອກເລດເງີນ ---</option>
                                            <?php
                                                $obj->select_rate();
                                                foreach($resultrate as $rowrate){
                                            ?>
                                            <option value="<?php echo $rowrate['rate_id'] ?>"><?php echo $rowrate['rate_id'] ?></option>
                                            <?php 
                                                }
                                                mysqli_free_result($resultrate);  
                                                mysqli_next_result($conn);
                                            ?>
                                        </select>
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
                                                            <button type="submit" name="btnStock" class="btn btn-outline-success">ບັນທຶກ</button>
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
<form action="import" id="formDelete" method="POST" enctype="multipart/form-data">
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
                    <button type="submit" name="btnDelete_stock" class="btn btn-outline-danger">ລົບ</button>
                </div>
            </div>
        </div>
    </div>
</form>
<form action="import" id="formClear" method="POST" enctype="multipart/form-data">
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
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">ຍົກເລີກ</button>
                    <button type="submit" name="clear-stock" class="btn btn-outline-danger">ລ້າງລາຍການ</button>
                </div>
            </div>
        </div>
    </div>
</form>
<?php
  if(isset($_GET['code'])=='null'){
    echo'<script type="text/javascript">
    swal("", "ລະຫັດສິນຄ້າບໍ່ມີໃນລະບົບ !", "info");
    </script>';
  }
  if(isset($_GET['serial'])=='stock'){
    echo'<script type="text/javascript">
    swal("", "ໝາຍເລກ Serial Number ນີ້ມີຢູ່ໃນສະຕ໋ອກສິນຄ້າແລ້ວ !", "info");
    </script>';
  }
  if(isset($_GET['no'])=='has'){
    echo'<script type="text/javascript">
    swal("", "ໝາຍເລກເຄື່ອງນີ້ມີຢູ່ສະຕ໋ອກສິນຄ້າແລ້ວ !", "info");
    </script>';
  }
  if(isset($_GET['serial-list'])=='same'){
    echo'<script type="text/javascript">
    swal("", "ໝາຍເລກ Serial Number ມີຢູ່ໃນລາຍການແລ້ວ !", "info");
    </script>';
  }
  if(isset($_GET['list-no'])=='same'){
    echo'<script type="text/javascript">
    swal("", "ໝາຍເລກເຄື່ອງນີ້ມີຢູ່ໃນລາຍການແລ້ວ !", "info");
    </script>';
  }
  if(isset($_GET['list'])=='null'){
    echo'<script type="text/javascript">
    swal("", "ກະລຸນາເພີ່ມລາຍການກ່ອນ !", "info");
    </script>';
  }
  if(isset($_GET['save'])=='fail'){
    echo'<script type="text/javascript">
    swal("", "ບໍ່ສາມາດບັນທຶກຂໍ້ມູນໄດ້ ກະລຸນາລອງໃໝ່ອີກຄັ້ງ !", "info");
    </script>';
  }
  if(isset($_GET['save2'])=='success'){
    echo'<script type="text/javascript">
    swal("", "ບັນທຶກຂໍ້ມູນສຳເລັດ !", "success");
    </script>';
  }
?>

<!-- check form import input not null -->
<script type="text/javascript">
        const myform = document.getElementById('form1');
        const stock = document.getElementById('stock');
        const code = document.getElementById('code');
        const serial = document.getElementById('serial');
        const qty = document.getElementById('qty');
        const price = document.getElementById('price');
        const pro_no = document.getElementById('pro_no');
        myform.addEventListener('submit',(e) => {
          e.preventDefault();
        checkInputs();
        });
        function checkInputs(){
            const stockValue = stock.value.trim();
          const codeValue = code.value.trim();
          const serialValue = serial.value.trim();
          const qtyValue = qty.value.trim();
          const priceValue = price.value.trim();
          const pro_noValue = pro_no.value.trim();
          if(codeValue === ''){
            setErrorFor(code, 'ກະລຸນາປ້ອນລະຫັດສິນຄ້າ');
          }
          else{
            setSuccessFor(code);
          }
          if(serialValue === ''){
            setErrorFor(serial, 'ກະລຸນາປ້ອນໝາຍເລກ Serial Number');
          }
          else{
            setSuccessFor(serial);
          }
          if(qtyValue === ''){
            setErrorFor(qty, 'ກະລຸນາປ້ອນຈຳນວນ');
          }
          else{
            setSuccessFor(qty);
          }
          if(priceValue === ''){
            setErrorFor(price, 'ກະລຸນາປ້ອນລາຄາ');
          }
          else{
            setSuccessFor(price);
          }
          if(pro_noValue === ''){
            setErrorFor(pro_no, 'ກະລຸນາປ້ອນໝາຍເລກເຄືອງ');
          }
          else{
            setSuccessFor(pro_no);
          }        
          if(codeValue !== '' && serial !=='' && serialValue !== '' && qtyValue !== '' && priceValue !== '' && pro_noValue !== '' ){
            document.getElementById("form1").action = "import";
            document.getElementById("form1").submit();
          }
        }
</script>

<!-- check save form import input not null -->
<script type="text/javascript">
        const myform2 = document.getElementById('formSave');
        const btnStock = document.getElementById('btnStock');
        const sup_id = document.getElementById('sup_id');
        const rate_id = document.getElementById('rate_id');
        myform2.addEventListener('submit',(e) => {
          e.preventDefault();
        checkInputs2();
        });
        function checkInputs2(){
            const btnStockValue = btnStock.value.trim();
          const sup_idValue = sup_id.value.trim();
          const rate_idValue = rate_id.value.trim();
          if(sup_idValue === ''){
            setErrorFor(sup_id, 'ກະລຸນາປ້ອນລະຫັດຜູ້ສະໜອງຜູ້ນຳເຂົ້າ');
          }
          else{
            setSuccessFor(sup_id);
          }
          if(rate_idValue === ''){
            setErrorFor(rate_id, 'ກະລຸນາປ້ອນເລດເງີນ');
          }
          else{
            setSuccessFor(rate_id);
          }        
          if(sup_idValue !== '' && rate_idValue !==''){
            document.getElementById("formSave").action = "import";
            document.getElementById("formSave").submit();
          }
        }
        $('.btnDelete_stock').on('click', function() {
        $('#exampleModalDelete').modal('show');
        $tr = $(this).closest('tr');
        var data = $tr.children("td").map(function() {
            return $(this).text();
        }).get();
        console.log(data);
        $('#id').val(data[0]);
    })
</script>



<!-- sweetalert -->
<?php
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
  // check delete
  if(isset($_GET['del'])=='fail'){
    echo'<script type="text/javascript">
    swal("", "ລົບຂໍ້ມູນບໍ່ສຳເລັດ", "error");
    </script>';
  }
  if(isset($_GET['del2'])=='success'){
    echo'<script type="text/javascript">
    swal("", "ລົບຂໍ້ມູນສຳເລັດ", "success");
    </script>';
  }
?>



<?php
    include ("../../header-footer/footer.php");
  ?>
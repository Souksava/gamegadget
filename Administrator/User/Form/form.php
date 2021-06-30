<?php
  $title = "ສ້າງຟອມ";
  $path = "../../";
  $links = "../";
  $session_path = "../../";
  include (''.$path.'PHPMailer/PHPMailerAutoload.php');
  include (''.$path.'header-footer/mail.php');
  include ("../../header-footer/header.php");

  $amount = 0;
?>
<div style="width: 100%;">
    <b>ລາຍການຟອມ</b>&nbsp <img src="<?php echo $path ?>icon/hidemenu.ico" width="10px">
</div>
<br>
<div class="row">
    <div class="col-md-7">
        <?php 
        $output = '';
        if(isset($_POST['page'])){
           $page = $_POST['page'];
           if($page == '' || $page == 0 || $page == 1){
              $page = 0;
              }
              else{
                 $page = ($page*15)-15;
              }
        }
        else{
           $page = 0;
        }
            if(isset($_GET['id'])){
                $obj->select_form_check();
                if(mysqli_num_rows($result_form_check) > 0)
{
 $output .= '
  <div class="table-responsive">
   <table class="table font12" style="width: 800px;">
    <tr>
        <th style="width: 120px;">ລະຫັດສິນຄ້າ</th>
        <th style="width: 150px;">ຊື່ສິນຄ້າ</th>
        <th style="width: 150px;">ລຸ້ນເຄື່ອງຂອງສິນຄ້າ</th>
        <th style="width: 150px;">ຈຳນວນ</th>
        <th style="width: 100px;">ຮູບພາບສິນຄ້າ</th>
        <th style="width: 30px;"></th>
    </tr>
 ';
 while($row = mysqli_fetch_array($result_form_check))
 {
  $output .= '
  <tr  class="result">
  <td>'.$row["code"].'</td>
  <td style="display: none;">'.$row["pro_name"].'</td>
  <td style="display: none;">'.$row["cate_id"].'</td>
  <td style="display: none;">'.$row["brand_id"].'</td>
  <td>'.$row["cate_name"].' '.$row["brand_name"].'<br>'.$row["pro_name"].'</td>
  <td>'.$row["gen"].'</td>
  <td style="display: none;">'.$row["unit_id"].'</td>
  <td style="display: none;">'.$row["qty"].'</td>
  <td>'.$row["qtyalert"].' '.$row["unit_name"].'</td>
  <td style="display: none;">'.$row["img_path"].'</td>
  ';
  if($row['img_path'] != ''){
  $output .= '
  <td>
      <a href="'.$path.'image/'.$row['img_path'].'" target="_blank">
          <img src="'.$path.'image/'.$row['img_path'].'" class="img-circle elevation-2"
              alt="" width="55px">
      </a>
  </td>
  ';
  }
  else{
  $output .= '
  <td>
      <a href="'.$path.'image/image.jpeg" target="_blank">
          <img src="'.$path.'image/image.jpeg" class="img-circle elevation-2"
              alt="" width="55px">
      </a>
  </td>
  ';
  }
  $output .='
  <td>
  <a href="#" data-toggle="modal" data-target="#exampleModalUpdate"
      class="fa fa-plus toolcolor btnUpdate_form"></a>&nbsp; &nbsp;
    </td>
 </tr>
  ';
 }
 mysqli_free_result($result_form_check);  
 mysqli_next_result($conn);
 $output .='
   </table>
</div>
<br>
 ';
 echo $output;
 

   $obj->select_form_check_count();
   $count = mysqli_num_rows($result_form_check_count);
   mysqli_free_result($result_form_check_count);  
   mysqli_next_result($conn);
   $a = ceil($count/15);
   if(isset($_POST['page'])){
      if($_POST['page'] > 1){
         $previous = $_POST['page'] - 1;
         echo '      
         <nav aria-label="...">
            <ul class="pagination">
               <li class="page-item">
                  <a href="#" class="btn btn-danger page-links" id="'.$previous.'" style="color: white!important;" value="'.$previous.'">ກັບຄືນ</a>
               </li>
       ';
      }
      else{
         echo' <nav aria-label="...">
                  <ul class="pagination">';
      }
   }
   else{
      echo' <nav aria-label="...">
               <ul class="pagination">';
   }
   $i = 0;
   $page_next = 0;
   $page_next2 = 1;
   if(isset($_POST['page'])){
      $page_next = $_POST['page'];
      $page_next2 = $_POST['page'];
      if($_POST['page'] == 0 || $_POST['page'] == ''){
         $page_next2 = 1;
      }
   }
   for($b=1;$b<=$a;$b++){
      $i = $b;
      if($page_next2 == $b){
         echo '
         <li class="page-item active" aria-current="page">
            <span class="page-link">
            '.$b.'
            <span class="sr-only">(current)</span>
            </span>
         </li>
         ';
      }
      else{
         echo '
         <li class="page-item">
            <a href="#" id="'.$b.'" class="btn btn-danger page-link page-links" value="'.$b.'">'.$b.'</a>
         </li>
         ';
      }
   }
     if($page_next == 0){
        $page_next = 1;
     }
      if($page_next < $i){
         if($page_next == 0){
            $page_next += 1;
         }
         $next = $page_next + 1;
         echo '      

                     <li class="page-item">
                        <a href="#" class="btn btn-success page-links" id="'.$next.'" value="'.$next.'" style="color: white!important;" href="#">ໜ້າຖັດໄປ</a>
                     </li>
                  </ul>
               </nav>
';

      }
      else{
         echo'';
      }
   
}
else
{
 echo '<br>
 <hr size="1" width="90%">
<p align="center">ບໍ່ມີຂໍ້ມູນ</p>
<hr size="1" width="90%">
 ';
}

        }
            else{
                echo'<div id="result">';
                include ($path."header-footer/loading.php");
                echo'</div>';
            }
        ?>
    </div>
    <div class="col-md-5">
        <div class="card">
            <div class="card-body">
                <h5 align="center" class="card-title"></h5>
                <p class="card-text">
                <form action="form" id="form_save" method="POST">
                    <div>
                        <?php 
                                $getid = mysqli_query($conn,"select max(form_id) as form_id from form;");
                                $fetch_id = mysqli_fetch_array($getid,MYSQLI_ASSOC);
                                $formid = $fetch_id['form_id'] + 1;
                            ?>
                        ເລກທີຟອມເບີກ: <?php echo $formid ?>
                        <input type="hidden" name="form_id" id="form_id" value="<?php echo $formid ?>">
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-control2">
                                <select name="cus_id" id="cus_id" class="selectcenter">
                                    <option value="" disabled selected>--- ເລືອກລູກຄ້າ ---</option>
                                    <?php
                                        $obj->select_customer_count('%%');
                                        foreach($resultcustomer_count as $rowcus){
                                        ?>
                                    <option value="<?php echo $rowcus['cus_id'] ?>"><?php echo $rowcus['company'] ?>
                                    </option>
                                    <?php
                                        }
                                        ?>
                                </select>
                                <i class="fas fa-check-circle "></i>
                                <i class="fas fa-exclamation-circle "></i>
                                <small class="">Error message</small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-control2">
                                <input type="text" name="packing" id="packing" placeholder="Packing No">
                                <i class="fas fa-check-circle "></i>
                                <i class="fas fa-exclamation-circle "></i>
                                <small class="">Error message</small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div align="center-right">
                                <button type="button" name="btnAdd" class="btn btn-outline-success btn-block"
                                    data-toggle="modal" data-target="#exampleModal2"
                                    style="padding: 8px 0px 8px 0px">ບັນທຶກຟອມ</button>
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
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-secondary"
                                                    data-dismiss="modal">ຍົກເລີກ</button>
                                                <button type="submit" name="Save" id="btnSave"
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
                    <?php
            $obj->select_form_cookie();
            if(isset($_COOKIE['list_form'])){
?>
                    <div class="table-responsive2" style="text-align: center;">
                        <table class="table font12" style="width: 750px">
                            <tr>
                                <th style="width: 50px">ສິນຄ້າ</th>
                                <th style="width: 150px">ລະຫັດສິນຄ້າ</th>
                                <th>ຊື່ສິນຄ້າ</th>
                                <th>ລຸ້ນເຄື່ອງຂອງສິນຄ້າ</th>
                                <th style="width: 70px">ຈຳນວນ</th>
                                <th style="width: 75px;"><a href="#" data-toggle="modal"
                                        data-target="#exampleModalClear" class="clear">ລ້າງ</a></th>
                            </tr>
                            <?php
                                foreach($cart_data as $row){
                                    $amount += $row['qty'];
                                ?>
                            <tr>
                                <?php
                                    if($row['img_path'] == ''){
                                    ?>
                                <td>
                                    <a href="<?php echo $path?>image/logo.png"><img
                                            src="<?php echo $path?>image/logo.png" alt=" class=" img-circle elevation-2
                                            alt="" width="55px"></a>
                                </td>
                                <?php
                                    }
                                    else{
                                    ?>
                                <td>
                                    <a href="<?php echo $path?>image/<?php echo $row['img_path'] ?>"><img
                                            src="<?php echo $path?>image/<?php echo $row['img_path'] ?>" alt=""
                                            class="img-circle elevation-2" alt="" width="55px"></a>
                                </td>
                                <?php
                                    }
                                    ?>
                                <td><?php echo $row['code'] ?></td>
                                <td>
                                    <?php echo $row['cate_name'] ?> <?php echo $row['brand_name'] ?> <br>
                                    <?php echo $row['name'] ?>
                                </td>
                                <td><?php echo $row['gen'] ?></td>
                                <td><?php echo $row['qty'] ?> <?php echo $row['unit_name'] ?></td>
                                <td>
                                    <a href="#" data-toggle="modal" data-target="#exampleModalDelete"
                                        class="fa fa-trash toolcolor btnDelete_check"></a>&nbsp; &nbsp;
                                </td>
                            </tr>
                            <?php
                        }
                    ?>
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
                    <div class="col-md-12" align="right">
                        <br>
                        <h4 style="color: #CE3131;"> <?php echo $amount ?> PCT.</h4>
                        <input type="hidden" name="amount" id="amount" value="<?php echo $amount ?>">
                    </div>
                </form>
                </p>
            </div>
        </div>
    </div>
</div>

<form action="form" id="formClear" method="POST" enctype="multipart/form-data">
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
                    <button type="submit" name="clear_form" class="btn btn-outline-danger">ລ້າງລາຍການ</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- modal form delete -->
<form action="form" id="formDelete" method="POST" enctype="multipart/form-data">
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
                    <input type="hidden" name="del_list_form_id" id="del_list_form_id">
                    ທ່ານຕ້ອງການລົບຂໍ້ມູນ ຫຼື ບໍ່ ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">ຍົກເລີກ</button>
                    <button type="submit" name="btnDelete_form" id="btnDelete" class="btn btn-outline-danger">
                        ລົບ
                        <span class="" id="load_delete"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- modal form add -->
<form action="form" id="formUpdate" method="POST" enctype="multipart/form-data">
    <div class="modal fade" id="exampleModalUpdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ເພີ່ມຂໍ້ມູນສ້າງຟອມ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row" align="left">
                        <div class="col-md-12 col-sm-6 form-control2">
                            <input type="hidden" name="form_add" id="form_add">
                            <label>ຮູບສິນຄ້າ</label>
                            <div class="col-md-12 col-sm-6 form-control2">
                                <img src="../../image/camera.jpg" id="output2" width="100%" height="250">
                            </div>
                            <i class="fas fa-check-circle "></i>
                            <i class="fas fa-exclamation-circle "></i>
                            <small class="">Error message</small>
                        </div>
                        <div class="col-md-12 col-sm-6 form-control2">
                            <label>ຈຳນວນ</label>
                            <input type="hidden" name="code" id="code">
                            <input type="number" min="1" name="qty" id="qty" placeholder="ຈຳນວນ" class="form-control">
                            <i class="fas fa-check-circle "></i>
                            <i class="fas fa-exclamation-circle "></i>
                            <small class="">Error message</small>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">ຍົກເລີກ</button>
                    <button type="submit" name="btnUpdate" id="btnAdd" class="btn btn-outline-success"
                        onclick="">ເພີ່ມ
                        <span class="" id="load_add"></span>    
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- check form input not null -->
<script type="text/javascript">
const myform = document.getElementById('formUpdate');
const qty = document.getElementById('qty');
const load_add = document.getElementById("load_add");
const btnLoad_add = document.getElementById("btnAdd");
myform.addEventListener('submit', (e) => {
    e.preventDefault();
    checkInputs();
});

function checkInputs() {
    const qtyValue = qty.value.trim();
    if (qtyValue === '') {
        setErrorFor(qty, 'ກະລຸນາປ້ອນຈຳນວນ');
    } else {
        setSuccessFor(qty);
    }
    if (qtyValue !== '') {
        setloading(load_add,btnLoad_add);
        document.getElementById("formUpdate").action = "form";
        document.getElementById("formUpdate").submit();
    }
}
const getform = document.getElementById('form_save');
const cus_id = document.getElementById('cus_id');
const form_id = document.getElementById('form_id');
const amount = document.getElementById('amount');
const packing = document.getElementById('packing');
const load_save = document.getElementById("load_save");
const btnLoad_save = document.getElementById("btnSave");
getform.addEventListener('submit', (e) => {
    e.preventDefault();
    checkInputs2();
});

function checkInputs2() {
    const cus_idValue = cus_id.value.trim();
    const amountValue = amount.value.trim();
    const form_idValue = form_id.value.trim();
    const packingValue = packing.value.trim();
    if (cus_idValue === '') {
        setErrorFor(cus_id, 'ປ້ອນລູກຄ້າ');
    } else {
        setSuccessFor(cus_id);
    }
    if (packingValue === '') {
        setErrorFor(packing, 'Packing No');
    } else {
        setSuccessFor(packing);
    }
    if (cus_idValue !== '' && packingValue !== '') {
        setloading(load_save,btnLoad_save);
        document.getElementById("form_save").action = "form";
        document.getElementById("form_save").submit();
    }
}
const myformudelete = document.getElementById('formDelete');
const del_list_form_id = document.getElementById("del_list_form_id");
const load_delete = document.getElementById("load_delete");
const btnLoad_delete = document.getElementById("btnDelete");
myformudelete.addEventListener('submit', (e) => {
    e.preventDefault();
    checkInputs3();
});

function checkInputs3() {

    setloading(load_delete,btnLoad_delete)
    document.getElementById("formDelete").action = "form";
    document.getElementById("formDelete").submit();

}
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
  if(isset($_GET['input'])=='than'){
    echo'<script type="text/javascript">
    swal("", "ຈຳນວນເບີກນັ້ນມີຫຼາຍກວ່າຈຳນວນສິນຄ້າຢູ່ໃນສະຕ໋ອກ", "info");
    </script>';
  }
  if(isset($_GET['qty'])=='null'){
    echo'<script type="text/javascript">
    swal("", "ຈຳນວນສິນຄ້າໃນສະຕ໋ອກແມ່ນມີ 0 ກະລຸນາປ້ອນຈຳນວນສີນຄ້າທີ່ມີຫຼາຍກວ່າ 0", "info");
    </script>';
  }
  if(isset($_GET['list'])=='null'){
    echo'<script type="text/javascript">
    swal("", "ກະລຸນາເພີ່ມລາຍການເບີກຈ່າຍສິນຄ້າ", "info");
    </script>';
  }

?>

<script>
$(document).ready(function() {

    load_data('%%', '0');

    function load_data(query, page) {
        $.ajax({
            url: "fetch_form.php",
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

<script>
$(window).load(function() {
    $('.btnUpdate_form').on('click', function() {
        $('#exampleModalUpdate').modal('show');
        $tr = $(this).closest('tr');
        var data = $tr.children("td").map(function() {
            return $(this).text();
        }).get();

        console.log(data);
        $('#code').val(data[0]);
        if (data[7] === '') {
            document.getElementById("output2").src = ('<?php echo $path ?>image/camera.jpg');
        } else {
            document.getElementById("output2").src = ('<?php echo $path ?>image/' + data[7]);
        }
    });
    $('.btnDelete_check').on('click', function() {
        $('#exampleModalDelete').modal('show');
        $tr = $(this).closest('tr');
        var data = $tr.children("td").map(function() {
            return $(this).text();
        }).get();
        console.log(data);
        $('#del_list_form_id').val(data[1]);
    });
});
</script>
<!-- /.content-wrapper -->
<br>
<?php
    include ("../../header-footer/footer.php");
  ?>
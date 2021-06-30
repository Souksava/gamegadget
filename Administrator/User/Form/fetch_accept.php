<?php
  $path="../../";
  include (''.$path.'oop/obj.php');
//fetch.php
$output = '';
$amount = 0;
if(isset($_POST["query"]))
{
    $form = $_POST['query'];
    $update_seen = mysqli_query($conn,"update form set seen2='1' where form_id='$form'");
    $result = mysqli_query($conn,"select img_path,fd.code,pro_name,cate_name,brand_name,unit_name,gen,fd.qty from formdetail fd left join form f on fd.form_id=f.form_id left join products p on fd.code=p.code left join category c on p.cate_id=c.cate_id left join unit u on p.unit_id=u.unit_id left join brand b on p.brand_id=b.brand_id where fd.form_id='$form'");
    $result2 = mysqli_query($conn,"select sum(qty) as amount from formdetail fd left join form f on fd.form_id=f.form_id where fd.form_id='$form'");
    $rowamount = mysqli_fetch_array($result2,MYSQLI_ASSOC);
    $amount = $rowamount['amount'];
}
else
{
    $result = mysqli_query($conn,"select img_path,fd.code,pro_name,cate_name,brand_name,unit_name,gen,fd.qty from formdetail fd left join form f on fd.form_id=f.form_id left join products p on fd.code=p.code left join category c on p.cate_id=c.cate_id left join unit u on p.unit_id=u.unit_id left join brand b on p.brand_id=b.brand_id where fd.form_id='0'");
}
if(mysqli_num_rows($result) > 0)
{
 $output .= '
  <div class="table-responsive">
  <table class="table font12" style="width: 600px">
    <tr>
        <th style="width: 60px">ສິນຄ້າ</th>
        <th style="width: 100px">ລະຫັດສິນຄ້າ</th>
        <th style="width: 120px">ຊື່ສິນຄ້າ</th>
        <th style="width: 150px">ລຸ້ນເຄື່ອງຂອງສິນຄ້າ</th>
        <th style="width: 80px">ຈຳນວນ</th>
    </tr>
 ';
 while($row = mysqli_fetch_array($result))
 {
  $output .= '
  <tr  class="result btnUpdate_accept">
  ';
  if($row['img_path'] == ''){
    $output .='
    <td><img src="'.$path.'image/logo.png"  width="55px" class="img-circle elevation-2" /></td>
    ';
  }
  else{
    $output .='
    <td><img src="'.$path.'image/'.$row['img_path'].'"  width="55px" class="img-circle elevation-2" /></td>
    ';
  }
  $output .='
    <td>'.$row["code"].'</td>
    <td>'.$row["cate_name"].' '.$row["brand_name"].' <br>'.$row["pro_name"].'</td>
    <td>'.$row["gen"].'</td>
    <td>'.$row["qty"].' '.$row["unit_name"].'</td>
 </tr>
  ';
 }
 mysqli_free_result($result);  
 mysqli_next_result($conn);
 $output .='
   </table>
</div>
<div class="col-md-12" align="right">
<br>
<h4 style="color: #CE3131;"> '.$amount.' Pct.</h4>
</div>
<br>
 ';
 echo $output;
}
else
{
 echo '<br>
 <hr size="1" width="90%">
<p align="center">ບໍ່ມີຂໍ້ມູນ</p>
<hr size="1" width="90%">
 ';
}
?>

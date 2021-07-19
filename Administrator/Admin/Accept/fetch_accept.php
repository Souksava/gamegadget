<?php
  $path="../../";
  include (''.$path.'oop/obj.php');
//fetch.php
$output = '';
$amount = 0;
$rate = '';
if(isset($_POST["query"]))
{
    $order_id = $_POST['query'];
    $update_seen = mysqli_query($conn,"update orders set seen1='1' where order_id='$order_id'");
    $result = mysqli_query($conn,"SELECT o.pro_id,pro_name,o.qty,o.price,p.cated_id,cated_name,cate_name,p.unit_id,unit_name,p.brand_id,brand_name,qtyalert,p.img_path,order_id FROM orderdetail o LEFT JOIN product p ON o.pro_id=p.pro_id LEFT JOIN categorydetail c ON p.cated_id=c.cated_id LEFT JOIN category ty ON c.cate_id=ty.cate_id LEFT JOIN unit u ON p.unit_id=u.unit_id LEFT JOIN brand b ON p.brand_id=b.brand_id WHERE o.order_id='$order_id'");
    $result_rate = mysqli_query($conn,"select * from orders where order_id='$order_id'");
    $get_rate = mysqli_fetch_array($result_rate,MYSQLI_ASSOC);
    $rate = $get_rate["rate_id"];
}
else
{
    $result = mysqli_query($conn,"SELECT o.pro_id,pro_name,o.qty,o.price,p.cated_id,cated_name,cate_name,p.unit_id,unit_name,p.brand_id,brand_name,qtyalert,p.img_path,order_id FROM orderdetail o LEFT JOIN product p ON o.pro_id=p.pro_id LEFT JOIN categorydetail c ON p.cated_id=c.cated_id LEFT JOIN category ty ON c.cate_id=ty.cate_id LEFT JOIN unit u ON p.unit_id=u.unit_id LEFT JOIN brand b ON p.brand_id=b.brand_id WHERE o.order_id='0'");
    $result_rate = mysqli_query($conn,"select * from orders where order_id='0'");
    $get_rate = mysqli_fetch_array($result_rate,MYSQLI_ASSOC);
    $rate = $get_rate["rate_id"];
}

if(mysqli_num_rows($result) > 0)
{
 $output .= '
  <div class="table-responsive">
  <table class="table font12" style="width: 600px">
    <tr>
        <th style="width: 30px">#</th>
        <th style="width: 60px">ສິນຄ້າ</th>
        <th style="width: 100px">ລະຫັດສິນຄ້າ</th>
        <th style="width: 250px">ຊື່ສິນຄ້າ</th>
        <th style="width: 80px">ຈຳນວນ</th>
        <th style="width: 80px">ລາຄາ</th>
        <th style="width: 150px">ລວມ</th>
    </tr>
 ';
 $no_ = 0;
 $amount = 0;
 while($row = mysqli_fetch_array($result))
 {
    $total = 0;
    $total = $row["qty"] * $row["price"];
    $amount += $total;
     $no_ ++;
  $output .= '
  <tr>
  <td>'.$no_.'</td>
  ';
  if($row['img_path'] == ''){
    $output .='
    <td><img src="'.$path.'image/image.jpeg"  width="55px" class="img-circle elevation-2" /></td>
    ';
  }
  else{
    $output .='
    <td><img src="'.$path.'image/'.$row['img_path'].'"  width="55px" class="img-circle elevation-2" /></td>
    ';
  }
  $output .='
    <td>'.$row["pro_id"].'</td>
    <td>'.$row["cate_name"].' '.$row["cated_name"].'<br> '.$row["brand_name"].'  '.$row["pro_name"].'</td>
    <td>'.$row["qty"].' '.$row["unit_name"].'</td>
    <td>'.number_format($row["price"],2).'</td>
    <td>'.number_format($total,2).'</td>
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
<h4 style="color: #CE3131;"> '.number_format($amount,2).' '.$rate.'</h4>
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

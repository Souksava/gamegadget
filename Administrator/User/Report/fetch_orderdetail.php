<style>
    tr{
        cursor: pointer;
    }
</style>
<?php
    $rank=0;
  $path="../../";
  include (''.$path.'oop/obj.php');
  $output = '';


 if(isset($_POST["query"]))
{
    $order_id = $_POST["query"];
    $result_report_orderdetail = mysqli_query($conn,"SELECT o.pro_id,pro_name,o.qty,o.price,o.qty*o.price as total,p.cated_id,cated_name,cate_name,p.unit_id,unit_name,p.brand_id,brand_name,qtyalert,p.img_path,order_id FROM orderdetail o LEFT JOIN product p ON o.pro_id=p.pro_id LEFT JOIN categorydetail c ON p.cated_id=c.cated_id LEFT JOIN category ty ON c.cate_id=ty.cate_id LEFT JOIN unit u ON p.unit_id=u.unit_id LEFT JOIN brand b ON p.brand_id=b.brand_id WHERE o.order_id='$order_id'");
    $result_rate = mysqli_query($conn,"select * from orders where order_id='$order_id'");
    $get_rate = mysqli_fetch_array($result_rate,MYSQLI_ASSOC);
    $rate = $get_rate["rate_id"];
}
else
{
    $result_report_orderdetail = mysqli_query($conn,"SELECT o.pro_id,pro_name,o.qty,o.price,p.cated_id,cated_name,cate_name,p.unit_id,unit_name,p.brand_id,brand_name,qtyalert,p.img_path,order_id FROM orderdetail o LEFT JOIN product p ON o.pro_id=p.pro_id LEFT JOIN categorydetail c ON p.cated_id=c.cated_id LEFT JOIN category ty ON c.cate_id=ty.cate_id LEFT JOIN unit u ON p.unit_id=u.unit_id LEFT JOIN brand b ON p.brand_id=b.brand_id WHERE o.order_id='0'");
}
$amount = 0;
if(mysqli_num_rows($result_report_orderdetail) > 0)
{
 $output .= '
  <div class="table-responsive2">
  <table class="table-bordered" style="width: 700px;text-align: center;" style="font-size: 12px;">
    <tr>
        <th align="center" style="width: 25px;">#</th>
        <th align="center" style="width: 60px;">ສີນຄ້າ</th>
        <th align="center" style="width: 180px;">ຊື່ສິນຄ້າ</th>
        <th align="center" style="width: 50px;">ຈຳນວນ</th>
        <th align="center" style="width: 70px;">ລາຄາ</th>
        <th align="center" style="width: 90px;">ລວມ</th>
    </tr>
 ';
 $no_ =  $rank;
 $amount = 0;
 while($row = mysqli_fetch_array($result_report_orderdetail))
 {
$amount = $amount + $row["total"];
$no_ += 1;
  $output .= '
    <tr>
        <td align="center">'.$no_.'</td>
        ';
        if($row["img_path"] == ""){
           $row["img_path"] = "image.jpeg";
        }
        $output .='
        <td>
           <img src="../../image/'.$row["img_path"].'" class="img-circle elevation-2" alt="" width="55px" />
        </td>
        <td align="center">'.$row["cate_name"].' '.$row["brand_name"].' <br> '.$row["pro_name"].'</td>
        <td align="center">'.$row["qty"].'</td>
        <td align="center">'.number_format($row["price"],2).' '.$rate.'</td>
        <td align="center">'.number_format($row["total"],2).' '.$rate.'</td>
    </tr>
  ';
 }
 mysqli_free_result($result_report_orderdetail);  
 mysqli_next_result($conn);
 $output .='
   </table>
</div><br>
<h3 align="right">ມູນຄ່າລວມ: '.number_format($amount,2).' '.$rate.'</h3>
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

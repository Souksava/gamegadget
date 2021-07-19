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
   $update_status_sell = $_POST["query"];
   mysqli_query($conn,"update sell set seen1='1' where sell_id='$update_status_sell'");
   $result_billdetail = mysqli_query($conn,"select sell_id,d.pro_id,pro_name,cate_name,cated_name,brand_name,unit_name,p.img_path,d.qty,d.price,p.price as pro_price,d.promotion,(d.promotion/p.price) * 100 as perzen,d.qty*d.price as total,color_name,p.qty as pro_qty from selldetail d left join product p on d.pro_id=p.pro_id left join categorydetail i  on p.cated_id=i.cated_id left join category c on i.cate_id=c.cate_id left join brand b on p.brand_id=b.brand_id left join unit u on p.unit_id=u.unit_id left join product_color o on d.color_id=o.color_id where sell_id='$update_status_sell';");
}
else
{
    $result_billdetail = mysqli_query($conn,"select d.pro_id,pro_name,cate_name,cated_name,brand_name,unit_name,p.img_path,d.qty,d.price,p.price as pro_price,d.promotion,(d.promotion/p.price) * 100 as perzen,d.qty*d.price as total,color_name,p.qty as pro_qty from selldetail d left join product p on d.pro_id=p.pro_id left join categorydetail i  on p.cated_id=i.cated_id left join category c on i.cate_id=c.cate_id left join brand b on p.brand_id=b.brand_id left join unit u on p.unit_id=u.unit_id left join product_color o on d.color_id=o.color_id where sell_id='0';");
}
$amount = 0;
if(mysqli_num_rows($result_billdetail) > 0)
{
 $output .= '
  <div class="table-responsive2">
  <table class="table-bordered" style="width: 700px;text-align: center;" style="font-size: 12px;">
    <tr>
        <th align="center" style="width: 15px;">#</th>
        <th align="center" style="width: 60px;">ສີນຄ້າ</th>
        <th align="center" style="width: 120px;">ຊື່ສິນຄ້າ</th>
        <th align="center" style="width: 30px;">ຈຳນວນ</th>
        <th align="center" style="width: 40px;">ລາຄາ</th>
        <th align="center" style="width: 50px;">ລວມ</th>
    </tr>
 ';
 $no_ =  $rank;
 $amount = 0;
 while($row = mysqli_fetch_array($result_billdetail))
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
        <td align="center"> '.$row["cate_name"].'  '.$row["cated_name"].' '.$row["brand_name"].' <br> '.$row["pro_name"].'</td>
        <td align="center">'.$row["qty"].'</td>
        <td align="center">'.number_format($row["price"],2).'</td>
        <td align="center">'.number_format($row["total"],2).'</td>
    </tr>
  ';
 }
 mysqli_free_result($result_billdetail);  
 mysqli_next_result($conn);
 $output .='
   </table>
</div><br>
<h3 align="right" style="color: #CE3131;">ມູນຄ່າລວມ: '.number_format($amount,2).' ກີບ</h3>
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

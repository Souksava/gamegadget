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
  if(isset($_POST['page'])){
     $page = $_POST['page'];
     if($page == '' || $page == 0 || $page == 1){
        $page = 0;
        }
        else{
           $page = ($page*50)-50;
           $rank = (($page*50)-50) / 50 + 1;
        }
  }
  else{
    $page = 0;
 }
 if(isset($_POST["date1"]) || isset($_POST["date2"]))
{
   $date1 = $_POST["date1"];
   $date2 = $_POST["date2"];
   $result_pay_limit = mysqli_query($conn,"select d.pro_id,pro_name,sum(d.qty) as total_qty,sum(d.qty*d.price) as total,count(d.pro_id) as count_product,p.img_path,cate_name,cated_name,brand_name,unit_name from selldetail d left join sell s on d.sell_id=s.sell_id left join product p on d.pro_id=p.pro_id left join categorydetail i on p.cated_id=i.cated_id left join category c on i.cate_id=c.cate_id left join brand b on p.brand_id=b.brand_id left join unit u on p.unit_id=u.unit_id where sell_date between '$date1' and '$date2' group by d.pro_id order by count(d.pro_id) desc limit $page,50;");
}
else
{
    $date1 = $_POST["date1"];
    $date2 = $_POST["date2"];
    $result_pay_limit = mysqli_query($conn,"select d.pro_id,pro_name,sum(d.qty) as total_qty,sum(d.qty*d.price) as total,count(d.pro_id) as count_product,p.img_path,cate_name,cated_name,brand_name,unit_name from selldetail d left join sell s on d.sell_id=s.sell_id left join product p on d.pro_id=p.pro_id left join categorydetail i on p.cated_id=i.cated_id left join category c on i.cate_id=c.cate_id left join brand b on p.brand_id=b.brand_id left join unit u on p.unit_id=u.unit_id where sell_date between '' and '' group by d.pro_id order by count(d.pro_id) desc limit $page,50;");
}
$amount = 0;
if(mysqli_num_rows($result_pay_limit) > 0)
{
 $output .= '
  <div class="table-responsive">
  <table class="table-bordered" style="width: 1200px;text-align: center;" id="tblemplyee">
    <tr style="font-size: 18px;">
        <th style="width: 25px;">#</th>
        <th style="width: 60px;" scope="col">ສິນຄ້າ</th>
        <th style="width: 90px;" scope="col">ລະຫັດສິນຄ້າ</th>
        <th style="width: 140px;" scope="col">ຊື່ສິນຄ້າ</th>
        <th style="width: 80px;" scope="col">ຈຳນວນ</th>
        <th style="width: 130px;" scope="col">ລວມ</th>
    </tr>
 ';
 $no_ =  $rank;
 $amount = 0;
 while($row = mysqli_fetch_array($result_pay_limit))
 {
    $amount += $row["total"];
    $no_ += 1;
    $output .= '
        <tr class="btn_fetch">
            <td>'.$no_.'</td>
            ';
            if($row["img_path"] == ""){
                $row["img_path"] = "image.jpeg";
            }
            $output .='
            <td style="text-align: center;">
                <img src="../../image/'.$row["img_path"].'" class="img-circle elevation-2" alt="" width="55px" />
            </td>
            <td>'.$row["pro_id"].'</td>
            <td> '.$row["cate_name"].' '.$row["cated_name"].' '.$row["brand_name"].' '.$row["pro_name"].'</td>
            <td>'.$row["total_qty"].' '.$row["unit_name"].'</td>
            <td>'.number_format($row["total"],2).' ກີບ</td>
        </tr>
    ';
 }
 mysqli_free_result($result_pay_limit);  
 mysqli_next_result($conn);
 $output .='
   </table>
</div>
 ';
 echo $output;
 if(isset($_POST["date1"]) || isset($_POST["date2"]))
{
    $date1 = $_POST["date1"];
    $date2 = $_POST["date2"];
   $result_pay = mysqli_query($conn,"select d.pro_id,pro_name,sum(d.qty) as total_qty,sum(d.qty*d.price) as total,count(d.pro_id) as count_product,p.img_path,cate_name,cated_name,brand_name,unit_name from selldetail d left join sell s on d.sell_id=s.sell_id left join product p on d.pro_id=p.pro_id left join categorydetail i on p.cated_id=i.cated_id left join category c on i.cate_id=c.cate_id left join brand b on p.brand_id=b.brand_id left join unit u on p.unit_id=u.unit_id where sell_date between '$date1' and '$date2' group by d.pro_id order by count(d.pro_id) desc");

}
 else
 {
    $date1 = $_POST["date1"];
    $date2 = $_POST["date2"];
    $result_pay = mysqli_query($conn,"select d.pro_id,pro_name,sum(d.qty) as total_qty,sum(d.qty*d.price) as total,count(d.pro_id) as count_product,p.img_path,cate_name,cated_name,brand_name,unit_name from selldetail d left join sell s on d.sell_id=s.sell_id left join product p on d.pro_id=p.pro_id left join categorydetail i on p.cated_id=i.cated_id left join category c on i.cate_id=c.cate_id left join brand b on p.brand_id=b.brand_id left join unit u on p.unit_id=u.unit_id where sell_date between '' and '' group by d.pro_id order by count(d.pro_id) desc");
 }

 $count = mysqli_num_rows($result_pay);
 mysqli_free_result($result_pay);  
 mysqli_next_result($conn);
 $a = ceil($count/50);
 if(isset($_POST['page'])){
    if($_POST['page'] > 1){
       $previous = $_POST['page'] - 1;
       echo '     
       <nav aria-label="..." class="table-responsive4">
          <ul class="pagination">
             <li class="page-item">
                <a href="#" class="btn btn-danger page-links_table" id="'.$previous.'" style="color: white!important;width: 70px;" value="'.$previous.'">ກັບຄືນ</a>
             </li>
     ';
    }
    else{
       echo' <nav aria-label="..." class="table-responsive4">
                <ul class="pagination">';
    }
 }
 else{
    echo' <nav aria-label="..." class="table-responsive4">
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
          <a href="#" id="'.$b.'" class="btn btn-danger page-link page-links_table" value="'.$b.'">'.$b.'</a>
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
                      <a href="#" class="btn btn-success page-links_table" id="'.$next.'" value="'.$next.'" style="color: white!important;width: 90px;" href="#">ໜ້າຖັດໄປ</a>
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
?>

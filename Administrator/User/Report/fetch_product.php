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
 if(isset($_POST["query"]))
{
   $highlight = $_POST['query'];
   $query = "%".$_POST["query"]."%";
   $result_customer_limit = mysqli_query($conn,"select p.pro_id,pro_name,cate_name,cated_name,brand_name,unit_name,p.img_path,p.qty,p.price,p.price - p.promotion as newprice,p.promotion,(p.promotion/p.price) * 100 as perzen,p.qty*(p.price - p.promotion) as total from  product p left join categorydetail i  on p.cated_id=i.cated_id left join category c on i.cate_id=c.cate_id left join brand b on p.brand_id=b.brand_id left join unit u on p.unit_id=u.unit_id where p.pro_id like '$query' or pro_name like '$query' or brand_name like '$query' or unit_name like '$query' or cate_name like '$query' order by pro_name asc limit $page,50;");
}
else
{
    $result_customer_limit = mysqli_query($conn,"select p.pro_id,pro_name,cate_name,cated_name,brand_name,unit_name,p.img_path,p.qty,p.price,p.price - p.promotion as newprice,p.promotion,(p.promotion/p.price) * 100 as perzen,p.qty*(p.price - p.promotion) as total from  product p left join categorydetail i  on p.cated_id=i.cated_id left join category c on i.cate_id=c.cate_id left join brand b on p.brand_id=b.brand_id left join unit u on p.unit_id=u.unit_id where p.pro_id like '%%' or pro_name like '%%' or brand_name like '%%' or unit_name like '%%' or cate_name like '%%' order by pro_name asc limit $page,50;");
}

if(mysqli_num_rows($result_customer_limit) > 0)
{
 $output .= '
    <div class="table-responsive">
        <table class="table-bordered" style="width: 1900px;text-align: center;">
            <tr style="font-size: 18px;">
                <th style="width: 25px;">#</th>
                <th style="width: 60px;" scope="col">ສິນຄ້າ</th>
                <th style="width: 90px;" scope="col">ລະຫັດສິນຄ້າ</th>
                <th style="width: 140px;" scope="col">ຊື່ສິນຄ້າ</th>
                <th style="width: 100px;" scope="col">ຈຳນວນ</th>
                <th style="width: 170px;" scope="col">ລາຄາ</th>
                <th style="width: 170px;" scope="col">ລວມ</th>
            </tr>
    ';
 $no_ =  $rank;
 $amout = 0;
 while($row = mysqli_fetch_array($result_customer_limit))
 {
$total =  $row["qty"] * $row["newprice"];
$amout += $row["qty"] * $row["newprice"];
$no_ += 1;
  $output .= '
    <tr>
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
        <td>'.$row["qty"].' '.$row["unit_name"].'</td>
        <td align="left" style="padding-left: 15px;">
            <h6 style="color: #CE3131;">ລາຄາ '.number_format($row["newprice"],2).' ກີບ</h6>
            <h7>ລາຄາປົກກະຕິ '.number_format($row["price"],2).' ກີບ</h7>
            <div style="color: #7E7C7C;font-size: 12px;">ສ່ວນຫຼຸດ '.number_format($row["promotion"],2).'  ກີບ ('.number_format($row["perzen"],2).' %)</div>
        </td>
        <td><h6 style="color: #CE3131;">'.number_format($total,2).' ກີບ</h6></td>
    </tr>
  ';
 }
 mysqli_free_result($result_customer_limit);  
 mysqli_next_result($conn);
 $output .='
   </table>
</div>
 ';
 echo $output;
 if(isset($_POST["query"]))
 {
    $query = "%".$_POST["query"]."%";
   $result_customer = mysqli_query($conn,"select p.pro_id,pro_name,cate_name,cated_name,brand_name,unit_name,p.img_path,p.qty,p.price,p.price - p.promotion as newprice,p.promotion,(p.promotion/p.price) * 100 as perzen,p.qty*(p.price - p.promotion) as total from  product p left join categorydetail i  on p.cated_id=i.cated_id left join category c on i.cate_id=c.cate_id left join brand b on p.brand_id=b.brand_id left join unit u on p.unit_id=u.unit_id where p.pro_id like '$query' or pro_name like '$query' or brand_name like '$query' or unit_name like '$query' or cate_name like '$query' order by pro_name asc");
 }
 else
 {
    $result_customer = mysqli_query($conn,"select p.pro_id,pro_name,cate_name,cated_name,brand_name,unit_name,p.img_path,p.qty,p.price,p.price - p.promotion as newprice,p.promotion,(p.promotion/p.price) * 100 as perzen,p.qty*(p.price - p.promotion) as total from  product p left join categorydetail i  on p.cated_id=i.cated_id left join category c on i.cate_id=c.cate_id left join brand b on p.brand_id=b.brand_id left join unit u on p.unit_id=u.unit_id where p.pro_id like '%%' or pro_name like '%%' or brand_name like '%%' or unit_name like '%%' or cate_name like '%%' order by pro_name asc");
 }

 $count = mysqli_num_rows($result_customer);
 mysqli_free_result($result_customer);  
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
                      <a href="#" class="btn btn-success page-links_table id="'.$next.'" value="'.$next.'" style="color: white!important;width: 90px;" href="#">ໜ້າຖັດໄປ</a>
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
<script type="text/javascript">
var highlight = "<?php echo $_POST['query']; ?>";
$('.result_data').highlight([highlight]);
</script>
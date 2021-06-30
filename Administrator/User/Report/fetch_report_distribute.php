<?php
  $path="../../";
  include (''.$path.'oop/obj.php');
//fetch.php
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
if(isset($_POST["da"]))
{
   $obj->select_reportdis($_POST['da'],$_POST['db'],$page);
}
else
{
   $obj->select_reportdis("0000-00-00",$Date,$page);
}
if(mysqli_num_rows($resultreportdis) > 0)
{
 $output .= '
  <div class="table-responsive">
   <table class="table font12" style="width: 1500px;">
    <tr>
    <th style="width: 120px;">serial</th>
    <th>d.n.v</th>
    <th>ລະຫັດສິນຄ້າ</th>
    <th>ສິນຄ້າ</th>
    <th>ຈຳນວນ</th>
    <th>ຊື່ບໍ່ລິສັດ</th>
    <th>ວັນທີ</th>
    <th>ພະນັກງານ</th>
    <th>ຮູບພາບ</th>
    </tr>
 ';
 while($row = mysqli_fetch_array($resultreportdis))
 {
  $output .= '
   <tr  class="result">
   <td>'.$row["serial"].'</td>
   <td>'.$row["dnv"].'</td>
   <td>'.$row["code"].'</td>
   <td>'.$row["cate_name"].' '.$row["brand_name"].' <br> '.$row["pro_name"].'</td>
   <td>'.$row["qty"].' '.$row["unit_name"].'</td>
   <td>'.$row["imp_date"].'</td>
   <td>'.$row["emp_name"].'</td>
   <td style="display:none;">'.$row['img_path'].'</td>
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
   </tr>
  ';
 }
 mysqli_free_result($resultreportdis);  
 mysqli_next_result($conn);
 $output .='
   </table>
</div>
 ';
 echo $output;
 
 if(isset($_POST["da"]))
 {
   $obj->select_reportdis_count($_POST['da'],$_POST['db']);
 }
 else
 {
    $obj->select_reportdis_count("0000-00-00",$Date);
 }
   $count = mysqli_num_rows($resultreportdis_count);
   mysqli_free_result($resultreportdis_count);  
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
?>
<script type="text/javascript">

</script>
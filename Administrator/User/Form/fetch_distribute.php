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
if(isset($_POST["query"]))
{
   $highlight = $_POST['query'];
   $obj->select_formdetail("%".$_POST['query']."%",$page);
}
else
{
   $obj->select_formdetail("%%",$page);
}
if(mysqli_num_rows($resultformdetail) > 0)
{
 $output .= '
  <div class="table-responsive">
   <table class="table font12" style="width: 1400px;">
    <tr>
        <th style="width: 30px;">ສິນຄ້າ</th>
        <th style="width: 180px;">ລະຫັດສິນຄ້າ</th>
        <th style="width: 150px;">ຊື່ສິນຄ້າ</th>
        <th style="width: 120px;">ລຸ້ນເຄື່ອງ</th>
        <th style="width: 80px;">ຈຳນວນ</th>
        <th style="width: 150px;">ຜູ້ສ້າງຟອມ</th>
        <th style="width: 50px;">ເລກທີ</th>
        <th style="width: 150px;">ລູກຄ້າ</th>
        <th style="width: 120px;">ສະຖານະ</th>
        <th style="width: 30px;"></th>
    </tr>
 ';
 while($row = mysqli_fetch_array($resultformdetail))
 {
  $output .= '
   <tr  class="result">
    <td style="display:none;">'.$row['img_path'].'</td>
    ';
    if($row['img_path'] == ''){
    $output .= '
    <td><img src="'.$path.'image/logo.png" style="width: 55px;heigt: 100px;" class="img-circle elevation-2"></td>
    ';
    }
    else{
        $output .='
        <td>
            <a href="'.$path.'image/'.$row['img_path'].'" target="_blank">
                <img src="'.$path.'image/'.$row['img_path'].'" alt="" style="width: 55px;heigt: 100px;" class="img-circle elevation-2" />
            </a>
        </td>
        ';
    }
    $output .='
    <td>'.$row["code"].'</td>
    <td>
    '.$row["cate_name"].' '.$row["brand_name"].'<br>  
    '.$row["pro_name"].'
    </td>
    <td>'.$row["gen"].'</td>
    <td style="display:none;">'.$row['qty'].'</td>
    <td>'.$row["qty"].' '.$row["unit_name"].'</td>
    <td>'.$row["emp_name"].'</td>
    <td>'.$row["form_id"].'</td>
    <td>'.$row["company"].'</td>
    <td>'.$row["stt_accept"].'</td>
    <td>
        <a href="#" data-toggle="modal" data-target="#exampleModalUpdate"
        class="fa fa-plus toolcolor btnUpdate_dist"></a>&nbsp; &nbsp;
    </td>
   </tr>
  ';
 }
 mysqli_free_result($resultformdetail);  
 mysqli_next_result($conn);
 $output .='
   </table>
</div>
 ';
 echo $output;
 
 if(isset($_POST["query"]))
 {
   $obj->select_formdetail_count("%".$_POST['query']."%");
 }
 else
 {
    $obj->select_formdetail_count("%%");
 }
   $count = mysqli_num_rows($resultformdetail_count);
   mysqli_free_result($resultformdetail_count);  
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
var highlight = "<?php echo $_POST['query']; ?>";
$('.result').highlight([highlight]);
$('.btnUpdate_dist').on('click', function() {
        $('#exampleModalUpdate').modal('show');
        $tr = $(this).closest('tr');
        var data = $tr.children("td").map(function() {
            return $(this).text();
        }).get();
        console.log(data);

        if(data[0] === ''){
            document.getElementById("output2").src = ('<?php echo $path ?>image/camera.jpg');
        }
        else{
            document.getElementById("output2").src = ('<?php echo $path ?>image/'+data[0]);
        }
        $('#code').val(data[2]);
        $('#qty').val(data[5]);
        $('#form_id').val(data[8]);

    });
</script>
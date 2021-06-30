<?php
  session_start();
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
$emp_id = '';
if(isset($_POST['emp_id'])){
    $emp_id = $_POST['emp_id'];
}
else{
    $emp_id = $_SESSION['emp_id'];
}
if(isset($_POST["query"]))
{
   $highlight = $_POST['query'];
   $obj->select_form2("%".$_POST['query']."%",$page,$emp_id);
}
else
{
   $obj->select_form2("%%",$page,$emp_id);
}
if(mysqli_num_rows($resultform2) > 0)
{
 $output .= '
  <div class="table-responsive">
  <table class="table font12" style="width: 1000px">
    <tr>
        <th style="width: 100px">ເລກທີຟອມ</th>
        <th style="width: 150px">ຜູ້ສ້າງຟອມ</th>
        <th style="width: 150px">ລູກຄ້າ</th>
        <th style="width: 100px">ຈຳນວນທັງໝົດ</th>
        <th style="width: 120px">Packing No</th>
        <th style="width: 80px">ວັນທີ</th>
        <th style="width: 80px">ເວລາ</th>
        <th style="width: 100px">ສະຖານະ</th>
    </tr>
 ';
 while($row = mysqli_fetch_array($resultform2))
 {
  $output .= '

   <tr  class="result btnUpdate_accept">
   
    <td>'.$row["form_id"].'</td>
    <td>'.$row["emp_name"].'</td>
    <td>'.$row["company"].'</td>
    <td>'.$row["amount"].'</td>
    <td>'.$row["packing_no"].'</td>
    <td>'.date("d/m/Y",strtotime($row["form_date"])).'</td>
    <td>'.$row["form_time"].'</td>
    <td>'.$row["stt_accept"].'</td>
   </tr>
 
  ';
 }
 mysqli_free_result($resultform2);  
 mysqli_next_result($conn);
 $output .='
   </table>
</div>
 ';
 echo $output;
 
 if(isset($_POST["query"]))
 {
   $obj->select_form2_count("%".$_POST['query']."%",$emp_id);
 }
 else
 {
    $obj->select_form2_count("%%",$emp_id);
 }
   $count = mysqli_num_rows($resultform2_count);
   mysqli_free_result($resultform2_count);  
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
$('.btnUpdate_accept').on('click', function() {
        // $('#exampleModalUpdate').modal('show');
        $tr = $(this).closest('tr');
        var data = $tr.children("td").map(function() {
            return $(this).text();
        }).get();

        console.log(data);
        $('#del_form').val(data[0]);
        $('#form_id_Report').val(data[0]);
    });
</script>
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
   $obj->select_customer("%".$_POST['query']."%",$page);
}
else
{
   $obj->select_customer("%%",$page);
}
if(mysqli_num_rows($resultcustomer) > 0)
{
 $output .= '
  <div class="table-responsive">
   <table class="table font12" style="width: 1500px;">
    <tr>
     <th>ລະຫັດລູກຄ້າ</th>
     <th>ຊື່ບໍລິສັດ</th>
     <th>ເບີໂທລະສັບ</th>
     <th>ທີ່ຢູ່ປັດຈຸບັນ</th>
     <th>ອີເມວ</th>
     <th>ສະຖານະລູກຄ້າ</th>
     <th></th>
    </tr>
 ';
 while($row = mysqli_fetch_array($resultcustomer))
 {
  $output .= '
   <tr  class="result">
    <td>'.$row["cus_id"].'</td>
    <td>'.$row["company"].'</td>
    <td>'.$row["tel"].'</td>
    <td>'.$row["address"].'</td>
    <td>'.$row["email"].'</td>
    <td style="display: none;">'.$row["stt_id"].'</td>
    <td>'.$row["stt_name"].'</td>
    <td>
      <a href="#" data-toggle="modal" data-target="#exampleModalUpdate" class="fa fa-pen toolcolor btnUpdate_cust"></a>&nbsp; &nbsp; 
      <a href="#" data-toggle="modal" data-target="#exampleModalDelete" class="fa fa-trash toolcolor btnDelete_cust"></a>
    </td>
   </tr>
  ';
 }
 mysqli_free_result($resultcustomer);  
 mysqli_next_result($conn);
 $output .='
   </table>
</div>
 ';
 echo $output;
 
 if(isset($_POST["query"]))
 {
   $obj->select_customer_count("%".$_POST['query']."%");
 }
 else
 {
    $obj->select_customer_count("%%");
 }
   $count = mysqli_num_rows($resultcustomer_count);
   mysqli_free_result($resultcustomer_count);  
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
   // <a href="#" id="'.$b.'" style="color: red;" class="page-links" value="'.$b.'" >'.$b.'</a>    
   // <a href="#" id="'.$b.'" class="page-links" value="'.$b.'" >'.$b.'</a>
   // <a href="#" id="'.$next.'" class="page-links" value="'.$next.'" >
   //    Next
   // </a>
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
   $('.btnUpdate_cust').on('click', function() {
      $('#exampleModalUpdate').modal('show');
      $tr = $(this).closest('tr');
      var data = $tr.children("td").map(function() {
         return $(this).text();
      }).get();

      console.log(data);

      $('#cus_id_update').val(data[0]);
      $('#company_update').val(data[1]);
      $('#tel_update').val(data[2]);
      $('#address_update').val(data[3]);
      $('#email_update').val(data[4]);
      $('#stt_id_update').val(data[5]);
   });
   $('.btnDelete_cust').on('click', function() {
        $('#exampleModalDelete').modal('show');
        $tr = $(this).closest('tr');
        var data = $tr.children("td").map(function() {
            return $(this).text();
        }).get();
        console.log(data);
        $('#id').val(data[0]);
    });
</script>
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
   $result_report_order_limit = mysqli_query($conn,"select order_id,emp_name,company,amount,order_date,order_time,o.status,seen2,rate_id,rate_buy from orders o left join employees e on o.emp_id=e.emp_id left join suppliers s  on o.sup_id=s.sup_id where order_date between '$date1' and '$date2' order by order_date asc limit $page,50");
}
else
{
    $result_report_order_limit = mysqli_query($conn,"select order_id,emp_name,company,amount,order_date,order_time,o.status,seen2,rate_id,rate_buy from orders o left join employees e on o.emp_id=e.emp_id left join suppliers s  on o.sup_id=s.sup_id where order_date between '' and '' order by order_date asc limit $page,50");
}
$amount = 0;
if(mysqli_num_rows($result_report_order_limit) > 0)
{
 $output .= '
  <div class="table-responsive">
  <table class="table-bordered" style="width: 1500px;text-align: center;">
    <tr style="font-size: 18px;">
        <th style="width: 40px">No.</th>
        <th style="width: 120px">ເລກທີບິນ</th>
        <th style="width: 150px">ຜູ້ສະໜອງ</th>
        <th style="width: 150px">ລວມ</th>
        <th style="width: 150px">ຜູ້ສັ່ງຊື້</th>
        <th style="width: 120px">ວັນທີ</th>
        <th style="width: 120px">ເວລາ</th>
        <th style="width: 120px">ສະຖານະ</th>
    </tr>
 ';
 $no_ =  $rank;
 while($row = mysqli_fetch_array($result_report_order_limit))
 {
$amount = $amount + $row["amount"];
$no_ += 1;
  $output .= '
    <tr class="btn_fetch">
      <td>'.$no_.'</td>
      <td>'.$row["order_id"].'</td>
      <td>'.$row["company"].'</td>
      <td>'.number_format($row["amount"],2).' '.$row["rate_id"].'</td>
      <td>'.$row["emp_name"].'</td>
      <td>'.date("d/m/Y",strtotime($row["order_date"])).'</td>
      <td>'.$row["order_time"].'</td>
      <td>'.$row["status"].'</td>
    </tr>
  ';
 }
 mysqli_free_result($result_report_order_limit);  
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
    $result_report_order = mysqli_query($conn,"select order_id,emp_name,company,amount,order_date,order_time,o.status,seen2,rate_id,rate_buy from orders o left join employees e on o.emp_id=e.emp_id left join suppliers s  on o.sup_id=s.sup_id where order_date between '$date1' and '$date2' order by order_date asc;");
}
 else
 {
    $result_report_order = mysqli_query($conn,"select order_id,emp_name,company,amount,order_date,order_time,o.status,seen2,rate_id,rate_buy from orders o left join employees e on o.emp_id=e.emp_id left join suppliers s  on o.sup_id=s.sup_id where order_date between '' and '' order by order_date asc;");
 }

 $count = mysqli_num_rows($result_report_order);
 mysqli_free_result($result_report_order);  
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
<script>
   $('.btn_fetch').on('click',function(){
      $('#exampleModalfetch').modal('show');
      $tr = $(this).closest('tr');
        var data = $tr.children("td").map(function() {
            return $(this).text();
        }).get();

        console.log(data);

        $('#id').val(data[1]);
   });
</script>
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
   $result_report_sell_limit = mysqli_query($conn,"select sell_id,cus_name,sell_date,sell_time,amount,sell_type,getmoney,s.img_path,note,s.status,status_cash,emp_name from sell s left join customers c on s.cus_id=c.cus_id left join employees e on s.emp_id=e.emp_id where  sell_date between '$date1' and '$date2' order by s.sell_id asc limit $page,50;");
}
else
{
    $result_report_sell_limit = mysqli_query($conn,"select sell_id,cus_name,sell_date,sell_time,amount,sell_type,getmoney,s.img_path,note,s.status,status_cash,emp_name from sell s left join customers c on s.cus_id=c.cus_id left join employees e on s.emp_id=e.emp_id where sell_date between '' and '' order by s.sell_id asc limit $page,50;");

}
$amount = 0;
if(mysqli_num_rows($result_report_sell_limit) > 0)
{
 $output .= '
  <div class="table-responsive">
  <table class="table-bordered" style="width: 1500px;text-align: center;" id="tblemplyee">
    <tr style="font-size: 18px;">
        <th style="width: 35px;">ລຳດັບ</th>
        <th style="width: 120px;">ເລກທີບິນ</th>
        <th style="width: 150px;">ລູກຄ້າ</th>
        <th style="width: 120px;">ມູນຄ່າລວມ</th>
        <th style="width: 100px;">ສະຖານະ</th>
        <th style="width: 100px;">ການຈ່າຍ</th>
        <th style="width: 100px;">ປະເພດຂາຍ</th>
        <th style="width: 180px;">ພາບລິບການໂອນ</th>
        <th style="width: 120px;">ວັນທີເວລາ</th>
        <th style="width: 180px;">ໝາຍເຫດ </th>
    </tr>
 ';
 $no_ =  $rank;
 while($row = mysqli_fetch_array($result_report_sell_limit))
 {
$amount = $amount + $row["amount"];
$no_ += 1;
  $output .= '
    <tr class="btn_fetch">
      <td>'.$no_.'</td>
      <td>'.$row["sell_id"].'</td>
      <td>'.$row["cus_name"].'</td>
      <td>'.number_format($row["amount"],2).'</td>
      <td>'.$row["status"].'</td>
      <td>'.$row["status_cash"].'</td>
      <td>'.$row["sell_type"].'</td>
      ';
      if($row["img_path"] == ""){
          $row["img_path"] = "image.jpeg";
      }
      $output .='
      <td style="text-align: center;">
          <img src="../../image/'.$row["img_path"].'" class="img-circle elevation-2" alt="" width="55px" />
      </td>
      <td>'.date("d/m/Y",strtotime($row["sell_date"])).'</td>
      <td>'.$row["note"].'</td>
    </tr>
  ';
 }
 mysqli_free_result($result_report_sell_limit);  
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
   $result_report_sell = mysqli_query($conn,"select sell_id,cus_name,sell_date,sell_time,amount,s.status,status_cash,sell_type,getmoney,s.img_path,note,emp_name from sell s left join customers c on s.cus_id=c.cus_id left join employees e on s.emp_id=e.emp_id where  sell_date between '$date1' and '$date2' order by s.sell_id asc");
}
 else
 {
    $result_report_sell = mysqli_query($conn,"select sell_id,cus_name,sell_date,sell_time,amount,s.status,status_cash,emp_name,sell_type,getmoney,s.img_path,note from sell s left join customers c on s.cus_id=c.cus_id left join employees e on s.emp_id=e.emp_id where  sell_date between '' and '' order by s.sell_id asc");

 }

 $count = mysqli_num_rows($result_report_sell);
 mysqli_free_result($result_report_sell);  
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
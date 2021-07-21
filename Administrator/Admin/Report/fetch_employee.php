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
   $result_customer_limit = mysqli_query($conn,"select emp_id,emp_name,emp_surname,gender,dob,address,tel,email,md5(pass) as pass,e.status,name,work_start,end_work,img_path,DATEDIFF('$Date',dob)/365 AS age from employees e left join status s on e.status=s.id where emp_id like '$query' or emp_name like '$query' or emp_surname like '$query' or gender like '$query' or email like '$query' order by emp_name asc limit $page,50;");
}
else
{
    $result_customer_limit = mysqli_query($conn,"select emp_id,emp_name,emp_surname,gender,dob,address,tel,email,md5(pass) as pass,e.status,name,work_start,end_work,img_path,DATEDIFF('$Date',dob)/365 AS age from employees e left join status s on e.status=s.id where emp_id like '%%' or emp_name like '%%' or emp_surname like '%%' or gender like '%%' or email like '%%' order by emp_name asc limit '$page',50;");
}

if(mysqli_num_rows($result_customer_limit) > 0)
{
 $output .= '
    <div class="table-responsive">
        <table class="table-bordered" style="width: 1900px;text-align: center;">
            <tr style="font-size: 18px;">
                <th style="width: 50px;">ລຳດັບ</th>
                <th style="width: 150px;">ລະຫັດພະນັກງານ</th>
                <th style="width: 150px;">ຊື່ພະນັກງານ</th>
                <th style="width: 150px;">ນາມສະກຸນ</th>
                <th style="width: 80px;">ເພດ</th>
                <th style="width: 120px;">ວັນເດືອນປີເກີດ</th>
                <th style="width: 350px;">ທີ່ຢູ່ປັດຈຸບັນ</th>
                <th style="width: 180px;">ເບີໂທລະສັບ</th>
                <th style="width: 220px;">ອີເມວ</th>
                <th style="width: 200px;">ລະຫັດ</th>
                <th style="width: 170px;">ຮູບພາບ</th>
            </tr>
    ';
 $no_ =  $rank;
 while($row = mysqli_fetch_array($result_customer_limit))
 {
$no_ += 1;
  $output .= '
    <tr>
        <td>'.$no_.'</td>
        <td>'.$row["emp_id"].'</td>
        <td>'.$row["emp_name"].'</td>
        <td>'.$row["emp_surname"].'</td>
        <td>'.$row["gender"].'</td>
        <td>'.date("d/m/Y",strtotime($row["dob"])).'</td>
        <td>'.$row["address"].'</td>
        <td>'.$row["tel"].'</td>
        <td>'.$row["email"].'</td>
        <td>'.$row["pass"].'</td>
        ';
        if($row["img_path"] == ""){
            $row["img_path"] = "image.jpeg";
        }
        $output .='
        <td style="text-align: center;">
            <img src="../../image/'.$row["img_path"].'" class="img-circle elevation-2" alt="" width="55px" />
         </td>
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
    $result_customer = mysqli_query($conn,"select emp_id,emp_name,emp_surname,gender,dob,address,tel,email,md5(pass) as pass,e.status,name,work_start,end_work,img_path,DATEDIFF('$Date',dob)/365 AS age from employees e left join status s on e.status=s.id where emp_id like '$query' or emp_name like '$query' or emp_surname like '$query' or gender like '$query' or email like '$query' order by emp_name");
 }
 else
 {
    $result_customer = mysqli_query($conn,"select emp_id,emp_name,emp_surname,gender,dob,address,tel,email,md5(pass) as pass,e.status,name,work_start,end_work,img_path,DATEDIFF('$Date',dob)/365 AS age from employees e left join status s on e.status=s.id where emp_id like '%%' or emp_name like '%%' or emp_surname like '%%' or gender like '%%' or email like '%%' order by emp_name asc");
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
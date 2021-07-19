<?php
  $path="../../";
  include (''.$path.'oop/connect.php');
    $result = mysqli_query($conn,"call get_order()");
    $sell = mysqli_fetch_array($result,MYSQLI_ASSOC);
  echo $sell["order_id"];
?>
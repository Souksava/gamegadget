<?php
  $path="../../";
  include (''.$path.'oop/connect.php');
    $result = mysqli_query($conn,"call get_sell()");
    $sell = mysqli_fetch_array($result,MYSQLI_ASSOC);
  echo $sell["sell_id"];
?>
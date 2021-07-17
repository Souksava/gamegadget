<?php
$conn = mysqli_connect("Localhost", "root", "", "game_gadget");
date_default_timezone_set("Asia/Bangkok");
$datenow2 = time();
$Date2 = date("Y-m-d",$datenow2);
$Time2 = date("H:i:s",$datenow2);
$Year2 = date("Y",$datenow2);
?>
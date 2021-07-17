<?php
if(!session_id()){
    session_start();
}
require 'vendor/autoload.php';
$app_id = "2577809559124970";
$fb = new \Facebook\Facebook([
  'app_id' => $app_id,
  'app_secret' => '9090fd84e967ab35055b7949a42fc1ed',
  'default_graph_version' => 'v2.10',
  //'default_access_token' => '{access-token}', // optional
]);

?>
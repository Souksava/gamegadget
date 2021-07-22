<?php
$mail = new PHPMailer();
$mail->isSMTP();
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'ssl';
$mail->Host = 'smtp.gmail.com';
$mail->Port = '465';
$mail->isHTML();
$mail->Username = 'souksavath.52221881@gmail.com';
$mail->Password = 'S52221881';
$mail->SetFrom('admin@gamegadgetlao.com');
?>
<?php
$mail = new PHPMailer();
$mail->isSMTP();
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'ssl';
$mail->Host = 'smtp.gmail.com';
$mail->Port = '465';
$mail->isHTML();
$mail->Username = 'admin@sevendigital.la';
$mail->Password = 'Seven@1234';
$mail->SetFrom('no-reply@sevendigital.com');
?>
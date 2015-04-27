<?php

require_once './PHPMailer/branches/qmail/class.phpmailer.php';
require_once './PHPMailer/branches/qmail/class.smtp.php';

$mail = new PHPMailer(); // create a new object
$mail->IsSMTP(); // enable SMTP
$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
$mail->SMTPAuth = true; // authentication enabled
$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
$mail->SMTPSecure = 'tls';
$mail->Host = "smtp.gmail.com";
$mail->Port = 587;
$mail->IsHTML(true);
$mail->Username = "admin@isr.uqu.edu.sa";
$mail->Password = "26101984_hope_";
$mail->SetFrom("admin@isr.uqu.edu.sa");
$mail->Subject = "Test";
$mail->CharSet = 'UTF-8';
$mail->Body = "بخخخخخخخخخخخخخ";
$mail->AddAddress("ahmed.sharaf.84@gmail.com");
if (!$mail->Send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message has been sent";
}
?>

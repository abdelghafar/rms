<?php

session_start();
require_once '../../lib/config.php';
require_once '../../lib/Messaging.php';
require_once '../../lib/Reseaches.php';
require_once '../../lib/research_Authors.php';

$UserId = $_SESSION['User_Id'];
$Research_id = $_POST['researchId'];
$Research_Author = new research_Authors();
$person_id = $Research_Author->GetCorrAuthor($Research_id);
$dest = $person_id;
$subject = mysql_escape_string($_POST['subject']);
$body = mysql_escape_string($_POST['message']);
$submit_date = date(DateTime_Format);
$isRead = 0;
$research_id = $_POST['researchId'];

$msg = new Messaging();
$res = $msg->SendMessage($subject, $body, "", $UserId, $dest, $submit_date, $isRead, $research_id);
if ($res == 1)
    echo '<p style="text-align: right">' . 'تم ارسال الرسالة بنجاح' . '</p>';
else
    echo '<p style="text-align: right">' . 'لقد فشلت عملية ارسال الرسالة برجاء اعادة المحاولة بعد فترة' . '</p>';
?>

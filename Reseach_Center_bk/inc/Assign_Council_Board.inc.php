<?php
session_start();
require_once('../../lib/Reseaches.php');
require_once '../../lib/Council_board.php';
require_once '../../lib/research_review.php';


$researchId = $_POST['researchId'];

$submission_date = date('Y-m-d');
$responce_Status_id = 2;
$IsOk = FALSE;
$obj = new research_review();
if (empty($_POST['chklst'])) {
    $IsOk = TRUE;
    exit();
}
if (!empty($_POST['chklst'])) {
    foreach ($_POST['chklst'] as $check) {
        $obj->Save(0, $check, $researchId, $submission_date, $responce_Status_id, "", "", "", 1);
        $IsOk = TRUE;
    }
}
?>
<html>
    <head></head>
    <body style="background-color: #ededed;">
    <center>
        <p style=" font-size: 16px;font-weight: bold;color:red; alignment-adjust:central;  ">
            <?php
            if ($IsOk == FALSE) {
                echo 'من فضلك اختر محكم واحد علي الاقل' . '<br/>';
                exit();
            }
            if ($IsOk == TRUE)
                echo 'تم تسجيل أعضاء المجلس بنجاح  من فضلك اغلق هذه النافذة' . '<br/>';
            else
                echo 'لقد حدث خطأ من قبل النظام برجاء اعادة المحاولة في وقت لاحق' . '<br/>';
            ?>
        </p>


    </center>

</body>
</html>

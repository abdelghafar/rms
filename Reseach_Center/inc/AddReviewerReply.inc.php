<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<?php
require_once '../../lib/reseach_status.php';
require_once '../../lib/research_review.php';

$seqId = $_POST['seqId'];
$researchCode = $_POST['research_Code'];
$research_Status = $_POST['jqxdropdownlist'];
$track_date = $_POST['track_date'];
$notes = $_POST['notes'];

$obj = new Research_Status();
$research_Status_id = $obj->GetStatusId($research_Status);
?>

<body style="background-color: #ededed;">
    <?
    try {
        $obj = new research_review();
        $obj->SetResearchReply($seqId, $research_Status_id, $track_date, '', $notes);
        ?>
        <p>
            تم تسجبل رد المحكم بنجاح
        </p>
        <?
    } catch (Exception $e) {
        ?>
        <p>
            لقد حدث خطأ غير معروف برجاء اعادة المحاولة بعد فترة
        </p>
        <?
    }
    ?>

</body>
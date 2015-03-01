<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>

<body style="background-color: #ededed;">

    <?php
    require_once '../../lib/research_review.php';

    $research_Id = $_POST['research_id'];
    $reviewer_person_Id = $_POST['person_Id'];
    
    $responce_Status_id = $_POST['jqxdropdownlist'];
    $responce_date = $_POST['track_date'];
    $attachment_url = "";
    $notes = "";

    if (isset($_POST['notes']) && strlen($_POST['notes']) > 0) {
        $notes = mysql_escape_string($_POST['notes']);
    }

    $obj = new Research_Review();

    if ($_FILES['file']['error'] != 4) {
        $fileExtension = end(explode(".", $_FILES["file"]["name"]));
        $fileName = md5(date('Y-m-d H:i:s')) . '.' . $fileExtension;
        if (file_exists("../../uploads/Reviewer_Reply/" . $fileName)) {
            echo $_FILES["file"]["name"] . " already exists. ";
        } else {
            $rs = move_uploaded_file($_FILES["file"]["tmp_name"], "../../uploads/Reviewer_Reply/" . $fileName);
            $attachment_url = "uploads/Reviewer_Reply/" . $fileName;
        }
    }
    $rs2 = $obj->SetReviewerReply($reviewer_person_Id, $research_Id, $responce_Status_id, $responce_date, $attachment_url, $notes, 2);
    ?>
    <h1 style="text-align: center">
        تم حفظ البيانات بنجاح - برجاء اغلاق هذه النافذة
    </h1>
</body>
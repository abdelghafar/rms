<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" href="../css/reigster-layout.css"/> 
</head>
<body style="background-color: #ededed;">
    <?php
    require_once '../../lib/research_docs.php';
    $isValid = TRUE;
    if ($_POST['research_Code'] == "" || !isset($_POST['research_Code']) || $_POST['research_Code'] == '___-__-___') {
        echo '<p>' . 'من فضلك ادخل رقم البحث' . '</p>';
        $isValid = FALSE;
    }
    $research_Code = $_POST['research_Code'];
    $research = new Reseaches();
    $research_id = $research->GetResearchId($research_Code);

    if (!isset($_FILES['file']['name']) || empty($_FILES['file']['name'])) {
        echo '<p>' . 'من فضلك قم بتحميل الملف' . '</p>';
        $isValid = FALSE;
    }
    if ($isValid == TRUE) {
        $fileExtension = end(explode(".", $_FILES["file"]["name"]));
        $fileName = md5(date('Y-m-d H:i:s')) . '.' . $fileExtension;
        if (file_exists("../upload/" . $fileName)) {
            echo $_FILES["file"]["name"] . " already exists. ";
        } else {
            move_uploaded_file($_FILES["file"]["tmp_name"], "../upload/" . $fileName);
        }
        $notes = $_POST['notes'];
        $doc_cat_id = $_POST['doc_Cat_list'];
        $doc = new Research_Documents();
        $a = $doc->Save(0, $research_Code, $doc_cat_id, $fileName, $notes);
        if ($a == 1)
            echo '<p>' . 'تم حفظ البيانات بنجاح' . '</p>';
    }
    else
        echo '<p>' . 'من فضلك أدخل جميع البيانات بشكل صحيح' . '</p>';
    ?>
</body>
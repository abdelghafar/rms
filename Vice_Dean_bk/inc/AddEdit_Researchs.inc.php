<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="../../common/css/reigster-layout.css"/> 
        <title></title>
    </head>
    <body>
        <?php
        require_once '../../lib/CenterResearch.php';
        require_once '../../lib/persons.php';
        require_once '../../lib/reseach_track.php';
        require_once '../../lib/Reseaches.php';
        require_once '../../lib/research_Authors.php';

        $isValid = TRUE;

        $Research_id = 0;
        if (isset($_POST['Research_id'])) {
            $Research_id = $_POST['Research_id'];
        }

        if (!isset($_POST['research_Code']) || strlen($_POST['research_Code']) == 0 || $_POST['research_Code'] == '________ ') {
            $isValid = FALSE;
            echo "<p class='error'>*" . 'من فضلك ادخل رقم البحث' . "</p>";
        }
        if (!isset($_POST['Research_title']) || strlen($_POST['Research_title']) == 0) {
            $isValid = FALSE;
            echo "<p class='error'>*" . 'من فضلك ادخل اسم البحث باللغة العربية' . "</p>";
        }
        if (!isset($_POST['FirstName_ar']) || strlen($_POST['FirstName_ar']) == 0) {
            $isValid = FALSE;
            echo "<p class='error'>*" . 'من فضلك ادخل الاسم الاول للباحث الرئيسي' . "</p>";
        }
        if (!isset($_POST['FatherName_ar']) || strlen($_POST['FatherName_ar']) == 0) {
            $isValid = FALSE;
            echo "<p class='error'>*" . 'من فضلك ادخل اسم الاب للباحث الرئيسي' . "</p>";
        }
        if (!isset($_POST['GrandName_ar']) || strlen($_POST['GrandName_ar']) == 0) {
            $isValid = FALSE;
            echo "<p class='error'>*" . 'من فضلك ادخل اسم الجد للباحث الرئيسي' . "</p>";
        }
        if (!isset($_POST['FamilyName_ar']) || strlen($_POST['FamilyName_ar']) == 0) {
            $isValid = FALSE;
            echo "<p class='error'>*" . 'من فضلك ادخل اسم العائلة للباحث الرئيسي' . "</p>";
        }
        if (!isset($_POST['txt_year']) || strlen($_POST['txt_year']) == 0 || $_POST['txt_year'] == '____') {
            $isValid = FALSE;
            echo "<p class='error'>*" . 'من فضلك ادخل سنة التقديم' . "</p>";
        }
        if (!isset($_POST['empCode']) || strlen($_POST['empCode']) == 0 || $_POST['empCode'] == '_______') {
            $isValid = FALSE;
            echo "<p class='error'>*" . 'من فضلك ادخل رقم منسوب الباحث الرئيسي' . "</p>";
        }

        $research_Code_Year = $_POST['research_Code'][0] . $_POST['research_Code'][1] . $_POST['research_Code'][2];
        $research_Code_Center_Code = $_POST['research_Code'][3] . $_POST['research_Code'][4];
        $txt_year = $_POST['txt_year'];
        //Verfiy Year 
        if ($txt_year[1] . $txt_year[2] . $txt_year[3] != $research_Code_Year) {
            echo "<p class='error'>*" . 'يجب أن تتطابق سنة التقديم مع سنة التقديم في رقم البحث' . "</p>";
            $isValid = FALSE;
        }
        //Verfiy Research Center
        $LstResearchCenterId = $_POST['LstResearchCenter'];
        $obj = new CenterResearch();
        $CenterCode = $obj->GetCenterCode($LstResearchCenterId);
        if ($CenterCode != $research_Code_Center_Code) {
            echo "<p class='error'>*" . 'يجب ان يتاطبق المركز البحثي مع كود المركز البحث في رقم البحث' . "</p>";
            $isValid = FALSE;
        }
        $title_ar = trim($_POST['Research_title']);
        $research_code = $_POST['research_Code'];
        $center_id = $_POST['LstResearchCenter'];
        $Status_Id = $_POST['LstResearchStatus'];
        $FirstName_ar = $_POST['FirstName_ar'];
        $FatherName_ar = $_POST['FatherName_ar'];
        $GrandName_ar = $_POST['GrandName_ar'];
        $FamilyName_ar = $_POST['FamilyName_ar'];
        $research_year = $_POST['txt_year'];
        $Status_date = date('Y-m-d');
        $major_field = '';
        $speical_field = '';
        $proposed_duration = 0;
        $Approve_session_no = 0;
        $Approve_date = '';
        $title_en = '';
        $url = '';
        $abstract_ar = '';
        $abstract_en = '';

        if ($isValid == TRUE) {
            $empCode = $_POST['empCode'];
            $person = new Persons();
            $personId = $person->IsExist($empCode);
            if ($personId != 0) {
                $researcher = new Reseaches();
                //$researcher->Save($Research_id, $title_ar, '', 0, '', '', $research_code, '', '', '', '', '', 3, $Status_date, $center_id, $research_year);
                $researcher->Save($Research_id, $title_ar, $title_en, $proposed_duration, $major_field, $speical_field, $research_code, $Approve_session_no, $Approve_date, $url, $abstract_ar, $abstract_en, $Status_Id, $Status_date, $center_id, $research_year);
                $research_id = $researcher->GetMaxId();
                $track = new Reseaches_track();
                $track->Save($research_id, $Status_Id, $Status_date, "");
                $research_author = new research_Authors();
                $research_author->Save($research_id, $personId, 0);
                $research_author->SetCorrAuthor($personId, $research_id);
            } else {
                $person = new Persons();
                $person->Save(0, $FirstName_ar, "", $FatherName_ar, "", $GrandName_ar, "", $FamilyName_ar, "", 0, "", "", "", "", "", "", "", "", "", $empCode, "", "", "", "", "", "", "", "");
                $personId = $person->GetLastPersonId();
                $researcher = new Reseaches();
                //$researcher->Save($Research_id, $title_ar, '', 0, '', '', $research_code, '', '', '', '', '', 3, $Status_date, $center_id, $research_year);
                $researcher->Save($Research_id, $title_ar, $title_en, $proposed_duration, $major_field, $speical_field, $research_code, $Approve_session_no, $Approve_date, $url, $abstract_ar, $abstract_en, $Status_Id, $Status_date, $center_id, $research_year);

                $research_id = $researcher->GetMaxId();
                $track = new Reseaches_track();
                $track->Save($research_id, $Status_Id, $Status_date, "");
                $research_author = new research_Authors();
                $research_author->Save($research_id, $personId, 0);
                $research_author->SetCorrAuthor($personId, $research_id);
            }
            echo '<p>' . 'تم حفظ البيانات بنجاح' . '</p>';
        }
        ?>
    </body>
</html>

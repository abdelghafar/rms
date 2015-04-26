<?php
session_start();
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once '../lib/research_stuff.php';

if (isset($_GET['q']) && isset($_GET['person_id']) && isset($_GET['role_id']) && isset($_GET['file_name']) && isset($_GET['resume_url'])) {
    $research_id = filter_input(INPUT_GET, 'q', FILTER_VALIDATE_INT);
    $person_id = filter_input(INPUT_GET, 'person_id', FILTER_VALIDATE_INT);
    $role_id = filter_input(INPUT_GET, 'role_id', FILTER_VALIDATE_INT);
    $agreement_file = filter_input(INPUT_GET, 'file_name', FILTER_SANITIZE_STRING);
    $resume_file = filter_input(INPUT_GET, 'resume_url', FILTER_SANITIZE_STRING);

    $obj = new research_stuff();
    if ($obj->IsExist($research_id, $person_id) == 0) {
        if ($agreement_file != 'null' && $resume_file != 'null') {
            $return_id = $obj->Save($research_id, $person_id, 3, research_stuff_categories::$person_based);
            $agreement_url = "uploads/" . $research_id . "/" . $_SESSION['tmp_consultant_agreement_url'];
            $resume_url = "uploads/" . $research_id . "/" . $_SESSION['tmp_consultant_resume_url'];

            $obj->SetResearchStuffAgreement($return_id, $agreement_url);
            $obj->SetResearchStuffResume($return_id, $resume_url);
            echo 200;
            return;
        } else {
            echo '<br/>' . 'من فضلك قم بتحميل الموافقة الخطية و السيرة الذاتية للمستشار' . '<br/>';
            return;
        }

    } else {
        echo '<br/>' . 'لقد تم حفظ هذا الشخص من قبل' . '<br/>';
        return;
    }

} else {
    echo 'param ar required....';
}

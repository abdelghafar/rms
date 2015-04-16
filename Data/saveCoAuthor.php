<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/*
 * Save the Co-Is to the DB with Agreement letter and corresponding  CV.
 */

require_once '../lib/research_stuff.php';

if (isset($_GET['q']) && isset($_GET['person_id']) && isset($_GET['file_name']) && isset($_GET['resume_url'])) {

    $research_id = filter_input(INPUT_GET, 'q', FILTER_VALIDATE_INT);
    $person_id = filter_input(INPUT_GET, 'person_id', FILTER_VALIDATE_INT);
    $agreement_file = filter_input(INPUT_GET, 'file_name', FILTER_SANITIZE_STRING);
    $resume_file = filter_input(INPUT_GET, 'resume_url', FILTER_SANITIZE_STRING);

    $obj = new research_stuff();
    $operation_completed = 0;
    if ($obj->IsExist($research_id, $person_id) == 0) {
        if ($agreement_file != 'null' && $resume_file != 'null') {
            $return_id = $obj->Save($research_id, $person_id, 2, research_stuff_categories::$person_based);
            $agreement_url = "uploads/" . $research_id . "/" . $agreement_file;
            $resume_url = "uploads/" . $research_id . "/" . $resume_file;

            $obj->SetResearchStuffAgreement($return_id, $agreement_url);
            $obj->SetResearchStuffResume($return_id, $resume_url);
            echo 200;
            return;
        } else {
            echo '<br/>' . 'من فضلك قم بتحميل الموافقة الخطية و السيرة الذاتية للباحث المشارك' . '<br/>';
            return;
//            $operation_completed = 0;
        }
        echo $operation_completed;
    } else {
//        echo '<br/>' .'لقد تم حفظ هذا الشخص من قبل'. '<br/>';
        $operation_completed = 0;
        //echo $operation_completed;
    }
} else {
    echo 'param ar required....';
}


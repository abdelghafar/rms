<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once '../lib/research_stuff.php';
require_once '../lib/Reseaches.php';
if (isset($_GET['q']) && isset($_GET['person_id'])) {
    $research_id = filter_input(INPUT_GET, 'q', FILTER_VALIDATE_INT);
    $person_id = filter_input(INPUT_GET, 'person_id', FILTER_VALIDATE_INT);
    $obj = new research_stuff();
    if ($obj->IsExist($research_id, $person_id) == 0) {
        $return_id = $obj->Save($research_id, $person_id, 2);
        if (isset($_GET['file_name'])) {
            $url = filter_input(INPUT_GET, 'file_name', FILTER_SANITIZE_STRING);
            $url = "uploads/coAuthor_agreement/" . $url;
            $obj->SetCoAuthor_agreement_url($research_id, $person_id, $url);
        }
        $msg = "";
        if ($return_id != 0) {
            $msg = 'Error in insert stmt';
        }
    } else {
        echo 'لقد تم تسجبل هذا الشخص من قبل';
    }
}
echo 'param ar required....';

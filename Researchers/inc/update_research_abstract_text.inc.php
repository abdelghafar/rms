<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once '../../lib/Reseaches.php';
if (isset($_GET['q'])) {
    $project_id = filter_input(INPUT_GET, 'q', FILTER_VALIDATE_INT);
    $obj = new Reseaches();
    $data = $_POST['FCKeditor1_Val'];
    $isOk = 0;
    if (strlen($data) != 0) {
        $obj->SetAbstractArText($project_id, $data);
        $isOk = 1;
    } else {
        echo 'من فضلك ادخل البيانات';
    }
    $data = $_POST['FCKeditor2_Val'];
    if (strlen($data) != 0) {
        $obj->SetAbstractEnText($project_id, $data);
        $isOk = 1;
    } else {
        echo 'من فضلك ادخل البيانات';
    }
    if ($isOk == 1) {
        echo $isOk;
    }
}
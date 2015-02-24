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
    if (strlen($data) != 0) {
        echo $obj->SetIntroductionText($project_id, $data);
    } else {
        echo 'من فضلك ادخل البيانات';
    }
}
<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if ($file['upload']['error'] == 0) {
    $fileExtension = end(explode(".", $_FILES["upload"]["name"]));
    $fileName = md5(date('Y-m-d H:i:s')) . '.' . $fileExtension;
    echo sha1_file($_FILES["upload"]["tmp_name"]) . '<br/>';
    echo $_FILES["upload"]["size"] . '<br/>';
    if (file_exists("../../uploads/test/" . $fileName)) {
        echo $_FILES["upload"]["name"] . " already exists. ";
    } else {
        $rs = move_uploaded_file($_FILES["upload"]["tmp_name"], "../../../uploads/test/" . $fileName);
        echo $rs;
    }
}
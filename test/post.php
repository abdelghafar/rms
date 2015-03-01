<?php

session_start();
if (!isset($_GET['session_id'])) {
    header("Location:post.php?session_id=" . session_id());
}
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//print_r($_POST);
//print_r($_FILES);

$encoded = base64_encode(12);
$str = urlencode($encoded);

echo $str . '<br/>';

$strdecode = 'MQ%3D%3D';
echo base64_decode(urldecode($strdecode));
echo 'session_id:' . session_id();

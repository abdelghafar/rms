<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once '../../lib/config.php';
require_once '../../lib/mysqlConnection.php';
require_once '../../lib/Reseaches.php';

$conn = new MysqlConnect();
if (isset($_GET['q'])) {
    $research_id = filter_input(INPUT_GET, 'q');
    $res = new Reseaches();
    $rs = $res->Research_Submit($research_id);
    echo $rs;
}
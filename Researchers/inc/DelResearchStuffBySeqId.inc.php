<?php
session_start();
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 08/04/15
 * Time: 12:33 ص
 */
require_once '../../lib/research_stuff.php';

if (isset($_GET['q'])) {
    $seq_id = filter_input(INPUT_GET, 'q', FILTER_VALIDATE_INT);
    $obj = new research_stuff();
    try {
        $rs = $obj->Delete($seq_id);
        if ($rs == 1)
            echo 'تم الحذف بنجاح';
    } catch (Exception $e) {
        echo $e->getMessage();
    }

} else {
    echo 'person_id and rcode are required..';
}
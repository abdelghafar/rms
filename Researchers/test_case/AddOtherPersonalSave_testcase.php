<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 24/04/15
 * Time: 10:08 م
 */
session_start();
require_once '../../lib/config.php';
require_once '../../lib/mysqlConnection.php';
require_once '../../lib/research_stuff.php';
require_once '../../lib/stuff_roles.php';

$research_stuff_obj = new research_stuff();
$project_busy_roles = $research_stuff_obj->GetMaxValueRole(1, 5);

$stuff_roles = new stuff_roles();
$total_roles = $stuff_roles->GetMaxValue(5);

$allowed_project_roles = $total_roles - $project_busy_roles;

echo 'allowed_project_roles=' . $allowed_project_roles;

$allowed_project_roles = 5;
$input_count = 3;

if ($input_count <= $allowed_project_roles) {
    //okay
} else {
    throw new Exception('u can not exceed the man limit');
}



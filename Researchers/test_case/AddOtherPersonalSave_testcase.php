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

$parent_role_id = 5;
$OtherPersonalCount = 2;
$project_id = 1;

$research_stuff_obj = new research_stuff();
$project_busy_roles = $research_stuff_obj->GetMaxValueRole($project_id, $parent_role_id);

$stuff_roles = new stuff_roles();
$total_roles = $stuff_roles->GetMaxValue($parent_role_id);

$allowed_project_slots = $total_roles - $project_busy_roles;

if ($OtherPersonalCount <= $allowed_project_slots) {
    echo 'u can insert only ' . $OtherPersonalCount;
} else {
    echo 'u can not insert more than n roles';
}



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
$OtherPersonalCount = 1;
$project_id = 1;

$research_stuff_obj = new research_stuff();
$project_busy_roles = $research_stuff_obj->GetMaxValueRole($project_id, $parent_role_id);

$stuff_roles = new stuff_roles();
$total_roles = $stuff_roles->GetMaxValue($parent_role_id);

$allowed_project_slots = $total_roles - $project_busy_roles;

if ($OtherPersonalCount <= $allowed_project_slots) {
    $initial_value = $project_busy_roles;
    for ($i = 0; $i < $OtherPersonalCount; $i++) {
        $next_role_id = $stuff_roles->GetNextRoleId($parent_role_id, $initial_value);
        $output = $research_stuff_obj->Save($project_id, 0, $next_role_id, research_stuff_categories::$role_based);
        echo $output . '<br/>';
    }

} else {
    echo 'u can not insert more than ' . $allowed_project_slots . ' roles';
}



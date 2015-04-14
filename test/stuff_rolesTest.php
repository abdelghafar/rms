<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 14/04/15
 * Time: 11:18 ص
 */

require_once '../lib/stuff_roles.php';
require_once '../lib/research_stuff.php';

$obj = new research_stuff();
$person_id = 1;
$project_id = 1;
$role_id = stuff_roles_system::$PI;
$seq_id = $obj->GetSeqId($project_id, $person_id, $role_id, research_stuff_categories::$person_based);
echo '<br/>' . 'seq_id=', $seq_id;
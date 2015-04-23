<?php
require_once '../research_stuff.php';
$obj = new research_stuff();
$role_id = 8;
$research_id = 10;
echo $obj->IsRoleResearchExists($role_id, $research_id);

?>
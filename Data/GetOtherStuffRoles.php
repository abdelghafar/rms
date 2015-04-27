<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 07/04/15
 * Time: 12:10 م
 */
require_once '../lib/config.php';
require_once '../lib/mysqlConnection.php';

$con = new MysqlConnect();
$stmt = "SELECT seq_id,role_name,role_name_en FROM stuff_roles where parent_role_id=4";
$result = $con->ExecuteNonQuery($stmt);
while ($row = mysql_fetch_array($result)) {
    $rs[] = array('seq_id' => $row['seq_id'], 'role_name' => $row['role_name_en'] . " / " . $row['role_name']);
}
echo json_encode($rs);
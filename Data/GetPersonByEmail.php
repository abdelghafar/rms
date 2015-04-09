<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 09/04/15
 * Time: 05:23 م
 */
require_once '../lib/config.php';
require_once '../lib/mysqlConnection.php';
$conn = new MysqlConnect();
if (isset($_GET['q'])) {
    $empCode = $_GET['q'];
    $stmt = "select person_id,Position, name_ar as `name`,`College`, `Dept`, `empCode`, `Email` from persons where `Email` like '%" . $empCode . "%'";
    $result = $conn->ExecuteNonQuery($stmt);
    while ($row = mysql_fetch_array($result)) {
        $person[] = array('person_id' => $row['person_id'], 'name' => $row['name'], 'College' => $row['College'], 'Dept' => $row['Dept'], 'empCode' => $row['empCode'], 'Email' => $row['Email'], 'Position' => $row['Position']);
    }
    echo json_encode($person);
} else {
    echo json_encode('Parameter Required...');
}

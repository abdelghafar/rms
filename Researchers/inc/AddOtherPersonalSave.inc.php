<?php
session_start();
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 07/04/15
 * Time: 01:55 م
 */
require_once '../../lib/config.php';
require_once '../../lib/mysqlConnection.php';
require_once '../../lib/research_stuff.php';
if (isset($_GET['q']) && isset($_GET['p'])) {
    $parent_role_id = filter_input(INPUT_GET, 'q', FILTER_SANITIZE_NUMBER_INT);
    $OtherPersonalCount = filter_input(INPUT_GET, 'p', FILTER_SANITIZE_NUMBER_INT);
    if ($parent_role_id == 0) {
        echo '<p class="error">*' . 'من فضلك اختر النوع المشاركة' . '</p>';
        exit();
    }
    $conn = new MysqlConnect();
    $stmt = 'SELECT seq_id,role_name FROM stuff_roles  where parent_role_id= ' . $parent_role_id . ' and value<=' . $OtherPersonalCount;

    $rs = $conn->ExecuteNonQuery($stmt);
    $roles = array();
    $operation_completed = 0;
    while ($row = mysql_fetch_array($rs)) {
        $roles[] = array('seq_id' => $row['seq_id'], 'role_name' => $row['role_name']);
        $obj = new research_stuff();
        $obj->Save($_SESSION[q], 0, $row['seq_id'], research_stuff_categories::$role_based);
        $operation_completed++;
    }
    if ($operation_completed == count($roles))
        echo '<p class="error">' . 'تم حفظ البيانات بنجاح' . '</p>';
    else
        echo '<p class="error">' . 'خطأفي حفط البيانات ' . '</p>';
}
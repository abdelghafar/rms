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
require_once '../../lib/stuff_roles.php';

if (isset($_GET['q']) && isset($_GET['p'])) {
    $parent_role_id = filter_input(INPUT_GET, 'q', FILTER_SANITIZE_NUMBER_INT);
    $OtherPersonalCount = filter_input(INPUT_GET, 'p', FILTER_SANITIZE_NUMBER_INT);
    $project_id = $_SESSION['q'];

    if ($parent_role_id == 0) {
        echo '<p class="error">*' . 'من فضلك اختر النوع المشاركة' . '</p>';
        exit();
    }

    $research_stuff_obj = new research_stuff();
    $project_busy_roles = $research_stuff_obj->GetMaxValueRole($project_id, $parent_role_id);

    $stuff_roles = new stuff_roles();
    $total_roles = $stuff_roles->GetMaxValue($parent_role_id);

    $allowed_project_slots = $total_roles - $project_busy_roles;

    if ($OtherPersonalCount <= $allowed_project_slots) {
        $initial_value = $project_busy_roles;
        $insert_result = 0;
        for ($i = 0; $i < $OtherPersonalCount; $i++) {
            $next_role_id = $stuff_roles->GetNextRoleId($parent_role_id, $initial_value);
            $output = $research_stuff_obj->Save($project_id, 0, $next_role_id, research_stuff_categories::$role_based);
            $initial_value++;
            $insert_result++;
        }
        if ($insert_result == 0) {
            echo '<p class="error">' . 'لقد حدث خطأ في عملية الادخال برجاء اعادة المحاولة بعد فترة' . '</p>';
        } else {
            '<p class="error">' . 'لقد تم حفظ البيانات بنجاح' . '</p>';
        }

    } else {
        echo '<p class="error">' . 'لقد بلغت الحد الأقصى' . '</p>';
    }

}
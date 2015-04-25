<?php
session_start();
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 25/04/15
 * Time: 02:22 ص
 */

require_once '../../lib/persons.php';
require_once '../../lib/research_stuff.php';
require_once '../../lib/Reseaches.php';
require_once '../../lib/project_budget.php';

if (isset($_GET['research_stuff_id']) && isset($_GET['parent_role_id'])) {
    $research_stuff_id = filter_input(INPUT_GET, 'research_stuff_id', FILTER_VALIDATE_INT);
    $parent_role_id = filter_input(INPUT_GET, 'parent_role_id', FILTER_VALIDATE_INT);
    $research_stuff = new research_stuff();
    $research_id = $_SESSION['q'];
    $lastRoleBasedMember = $research_stuff->GetLastRoleBasedMember($research_id, $parent_role_id);
    $res = 0;
    if ($lastRoleBasedMember == $research_stuff_id) {
        $res = $research_stuff->CanDelete($research_stuff_id);
        if ($res == 1) {
            //delete ;
            $res = $research_stuff->Delete($research_stuff_id);
            $project_budget = new project_budget();
            $project_budget->DeleteByResearchStuffId($research_stuff_id);
        } else {
            //can not delete
            $res = "لا يمكن حذف هذا الشخص من فضلك تأكد من انه غير مشارك في اي مهمة";
        }
    } else {
        $res = "من فضلك قم بحذف العنصر الاخير أولا";
    }
    echo $res;
}
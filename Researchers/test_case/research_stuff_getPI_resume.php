<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 25/04/15
 * Time: 02:51 م
 */
session_start();

if ($_SESSION['Authorized'] == null) {
    header('Location: https://uqu.edu.sa/e_services/esso/gotoApp/DSR');
} else if ($_SESSION['Authorized'] == 0) {
    header('Location: https://uqu.edu.sa/e_services/esso/gotoApp/DSR');
}
require_once '../../lib/Reseaches.php';
require_once '../../lib/persons.php';
require_once '../../lib/research_stuff.php';
require_once '../../lib/stuff_roles.php';

$research_stuff = new research_stuff();
$pi_seqId = $research_stuff->GetSeqId($projectId, $personId, stuff_roles_system::$PI, research_stuff_categories::$person_based);
$pi_resume = $research_stuff->GetResearchStuffResume($pi_seqId);
echo($pi_resume);
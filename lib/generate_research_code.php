<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 12/04/15
 * Time: 12:04 م
 */
require_once 'Settings.php';
require_once 'Reseaches.php';
require_once 'technologies.php';
/*
 * code in the form Yr$PIO$Round_number$Program_code$Serial
 *                  2$3$1$1$4 = 11 digits
 */
if (isset($_GET['q'])) {
    $project_id = filter_input(INPUT_GET, 'q', FILTER_VALIDATE_INT);
    $setting = new Settings();
    $year = $setting->GetCurrYear();

    $research_obj = new Reseaches();
    $research = $research_obj->GetResearch($project_id);
    $tech_id = $research['center_id'];

    $tech = new Technologies();
    echo $tech->GetTechCode($tech_id);


}
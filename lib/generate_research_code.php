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
    $yr = $year[2] . $year[3];

    $research_obj = new Reseaches();
    $research = $research_obj->GetResearch($project_id);
    $tech_id = $research['center_id'];
    $tech = new Technologies();
    $tech_code = $tech->GetTechCode($tech_id);


    $round = $setting->GetCurrRound();

    $program_code = $research['program'];
    $serial = 133;
    $s = sprintf("%04d", $serial);
    echo $s;
    $stmt = "Select count(*) From researches where research_year=" . $year . " and center_id=" . $tech_id . " and round=" . $round . " and program=" . $program_code . " and isDraft=0";

//    echo $stmt;
    //echo $yr . '$' . $tech_code . '$' . $round . '$' . $program_code . '$' . $serial;

}
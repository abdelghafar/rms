<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once '../../lib/Reseaches.php';

$projectId = $_GET['q'];
$obj = new Reseaches();
$arabicAbs = $obj->GetAbstract_ar_url($projectId);
$engAbs = $obj->GetAbstract_en_url($projectId);
$into = $obj->GetIntro_url($projectId);
$review = $obj->GetLitReview_url($projectId);
$research_method = $obj->GetResearch_method_url($projectId);
$value = $obj->GetValueToKingdomUrl($projectId);
$refs = $obj->GetRefsUrl($projectId);


$arabicAbs_file = 0;
$engAbs_file = 0;
$into_file = 0;
$review_file = 0;
$research_method_ok = 0;
$value_ok = 0;
$ref_ok = 0;
$msg = "";
if (strlen($arabicAbs) != 0) {
    $arabicAbs_file = 1;
} else {
    $msg.= "<li>" . "من فضلك قم بتحميل الملخص باللغة العربية" . "</li>";
}
if (strlen($engAbs) != 0) {
    $engAbs_file = 1;
} else {
    $msg.= "<li>" . "من فضلك قم بتحميل الملخص باللغة الانجلزية" . "</li>";
}
if (strlen($into) != 0) {
    $into_file = 1;
} else {
    $msg.= "<li>" . "من فضلك قم بتحميل مقدمة المشروع" . "</li>";
}
if (strlen($review) != 0) {
    $review_file = 1;
} else {
    $msg.= "<li>" . "من فضلك قم بتحميل المسح الأدبي" . "</li>";
}

if (strlen($research_method) != 0) {
    $research_method_ok = 1;
} else {
    $msg.= "<li>" . "من فضلك قم بتحميل منهجية البحث" . "</li>";
}

if (strlen($value) != 0) {
    $value_ok = 1;
} else {
    $msg.= "<li>" . "من فضلك قم بتحميل القيمة للدولة" . "</li>";
}

if (strlen($refs) != 0) {
    $ref_ok = 1;
} else {
    $msg.= "<li>" . "من فضلك قم بتحميل المراجع" . "</li>";
}


if ($arabicAbs_file == 1 && $engAbs_file == 1 && $into_file == 1 && $review_file == 1 && $research_method_ok == 1 && $value_ok == 1 && $ref_ok == 1) {

    echo '<script>' . ' window.location.assign("project_stuff.php?q=' . $projectId . '");' . '</script>';
} else {
    echo $msg;
}
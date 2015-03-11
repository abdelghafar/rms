<?php

function get_time_difference_php($created_time) {

    $str = strtotime($created_time);
    $today = strtotime(date('Y-m-d H:i:s'));

    // It returns the time difference in Seconds...
    $time_differnce = $today - $str;

    // To Calculate the time difference in Years...
    $years = 60 * 60 * 24 * 365;

    // To Calculate the time difference in Months...
    $months = 60 * 60 * 24 * 30;

    // To Calculate the time difference in Days...
    $days = 60 * 60 * 24;

    // To Calculate the time difference in Hours...
    $hours = 60 * 60;

    // To Calculate the time difference in Minutes.
    $minutes = 60;

    if ($created_time == '0000-00-00 00:00:00') {
        return 'غير محدد';
    } else if ($created_time == 'غير محدد')
        return $created_time;

    if (intval($time_differnce / $years) > 1) {
        return " منذ " . intval($time_differnce / $years) . " سنوات";
    } else if (intval($time_differnce / $years) > 0) {
        return " منذ " . intval($time_differnce / $years) . " سنة ";
    } else if (intval($time_differnce / $months) > 1) {
        return " منذ " . intval($time_differnce / $months) . " شهور";
    } else if (intval(($time_differnce / $months)) > 0) {
        return " منذ " . intval(($time_differnce / $months)) . " شهر ";
    } else if (intval(($time_differnce / $days)) > 1) {
        return " منذ " . intval(($time_differnce / $days)) . " أيام";
    } else if (intval(($time_differnce / $days)) > 0) {
        return " منذ " . intval(($time_differnce / $days)) . " يوم";
    } else if (intval(($time_differnce / $hours)) > 1) {
        return " منذ " . intval(($time_differnce / $hours)) . " ساعات";
    } else if (intval(($time_differnce / $hours)) > 0) {
        return " منذ " . intval(($time_differnce / $hours)) . " ساعة";
    } else if (intval(($time_differnce / $minutes)) > 1) {
        return " منذ " . intval(($time_differnce / $minutes)) . " دقائق";
    } else if (intval(($time_differnce / $minutes)) > 0) {
        return " منذ " . intval(($time_differnce / $minutes)) . " دقيقة ";
    } else if (intval(($time_differnce)) > 1) {
        return " منذ " . intval(($time_differnce)) . " منذ لحظات ";
    } else {
        return "منذ لحظات";
    }
}

function encode($url) {
    return urlencode(base64_encode($url));
}

function decode($data) {
    return base64_decode(urldecode($data));
}

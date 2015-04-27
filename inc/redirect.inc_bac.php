<?php

session_start();
$_SESSION['Authorized'] = 0;
$_SESSION['EmpCode'] = 0;
$_SESSION['UserEmail'] = '';
$_SESSION['User_Name'] = '';


try {
    # Call nuSOAP Library
    require_once('nusoap_lib/nusoap.php');
    require_once '../lib/persons.php';
    require_once '../UquAPI/get_uqu_instructors.php';
    # SSO for Applications
    $wsdl = "https://uqu.edu.sa/sso/ws.php?wsdl";
    $client = new nusoap_client($wsdl, 'wsdl');

    $param = [
        'SSO_UQU_WEB_POST' => $_POST['SSO_UQU_WEB'],
        'SSO_UQU_WEB_COOKIE' => $_COOKIE['SSO_UQU_WEB'],
        'IP' => get_ip()
    ];
    $results = $client->call('ws_uqu_sso', $param);
    $ex = explode('@', $results);
    $status = $ex[0];
    if ($status == 'Authorized') {
        $userCode = $ex[1];
        $userEmail = $ex[2];
        $_SESSION['Authorized'] = 1;
        $_SESSION['EmpCode'] = $userCode;
        $_SESSION['UserEmail'] = $userEmail;
        $_SESSION['User_Name'] = $userCode . '@' . $userEmail;
        $person_id = 0;
        $p = new Persons();
        $u = $p->findByEmployeeCode($userCode);
        if ($u == 0) {
            $peron_details = get_uqu_instructors($userCode);
            $person_id = $p->ImportPerson($peron_details);
        } else {
            $person_id = $u;
        }
        $_SESSION['person_id'] = $person_id;
        echo '<script>window.location.assign("../index.php");</script>';
    } else {
        $_SESSION['Authorized'] = 0;
        $redirectTo = $ex[1];
        header('Location: ' . $redirectTo);
    }
} catch (Exception $ex) {
    $_SESSION['Authorized'] = 0;
    echo 'Exception: ' . $ex->getMessage();
}

function get_ip() {
    //Just get the headers if we can or else use the SERVER global
    if (function_exists('apache_request_headers')) {
        $headers = apache_request_headers();
    } else {
        $headers = $_SERVER;
    }
    //Get the forwarded IP if it exists
    if (array_key_exists('X-Forwarded-For', $headers) && filter_var($headers['X-Forwarded-For'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {

        $the_ip = $headers['X-Forwarded-For'];
    } elseif (array_key_exists('HTTP_X_FORWARDED_FOR', $headers) && filter_var($headers['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)
    ) {
        $the_ip = $headers['HTTP_X_FORWARDED_FOR'];
    } else {

        $the_ip = filter_var($_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4);
    }
    return $the_ip;
}
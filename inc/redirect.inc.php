<?php

session_start();
$_SESSION['Authorized'] = 0;
$_SESSION['EmpCode'] = 0;
$_SESSION['UserEmail'] = '';
$_SESSION['User_Name'] = '';
$_SESSION['program'] = 0;
$_SESSION['program_id'] = 0;


try {
    # Call nuSOAP Library
    
    require_once '../lib/persons.php';
    require_once '../lib/program.php';
    require_once '../lib/submitRound.php';
    
    require_once('nusoap_lib/nusoap.php');
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

//$_SESSION['person_id'] = 252; // فيصل
//$_SESSION['person_id'] = 3; // عبدالله
//$_SESSION['person_id'] = 2; // السيد فؤاد
//$_SESSION['person_id'] = 382; // باسم
//$_SESSION['person_id'] = 123; // نعيمة
//$_SESSION['person_id'] = 1029; // نورة
//$_SESSION['person_id'] = 4; // عبدالغفار
//$_SESSION['person_id'] = 8;
//$_SESSION['person_id'] = 4168; //هشام عرابي
        
        select_program($person_id);
        
        


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

function select_program($person_id) {
    
    
    $person = new Persons();
    $person_rs = $person->GetPerson($person_id);

    $submitround = new SubmitRound();
    $submitround_rs = $submitround->GetCurrentRound();

    if ($submitround_data = mysql_fetch_array($submitround_rs)) {
        $submission_start_date = $submitround_data['start_date'];
    }

    if ($person_data = mysql_fetch_array($person_rs)) {
        $Position = $person_data['Position'];
        $RANK_DATE = $person_data['rank_date'];
        $Nationality = $person_data['Nationality'];
        $Gender = $person_data['Gender'];
        $_SESSION['name_ar'] = $person_data['name_ar'];


        $submission_timestamp = strtotime($submission_start_date);

        $rank_timestamp = strtotime($RANK_DATE);

        $Rank_Period_days = floor(abs(($submission_timestamp - $rank_timestamp) / (60 * 60 * 24)));




        if ($Position === "محاضر" or $Position === "معيد" or ($Position === "أستاذ مساعد" and $Rank_Period_days < 720)) {
            if ($Nationality === "سعودي") {
                $program = "ra2d";
                $_SESSION['program_alias'] = "رائد / Raed";
            }
        } else {
            if ($Position === "أستاذ" or $Position === "أستاذ مشارك" or ($Position === "أستاذ مساعد" and $Rank_Period_days >= 720)) {
                if ($Gender == 2) {
                    $program = "wa3da";
                    $_SESSION['program_alias'] = " واعدة / Waeda";
                } else {
                    $program = "ba7th";
                    $_SESSION['program_alias'] = "باحث / Baheth";
                }
            } else {
                //end 
            }
        }
        echo "Name = " . $_SESSION['name_ar'] . "ps = " . $Position . " R_da   " . $RANK_DATE . "  Sub_dat " . $submission_start_date . "  Nat " . $Nationality . " Gend  " . $Gender . " Per " . $Rank_Period_days;
        echo "<br> program = " . $program;

        $_SESSION['program_code'] = $program;

        $t = new program();
        $program_id = $t->GetProgramId($program);

        $_SESSION['program_id'] = $program_id;
        $_SESSION['program'] = $program_id;
    }
}
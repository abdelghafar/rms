<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 08/04/15
 * Time: 11:26 م
 */
session_start();
if ($_SESSION['Authorized'] == 1) {
    echo 'Welcome ' . $_SESSION['UserEmail'] . '<br/>';
    echo 'EmpCode :' . $_SESSION['EmpCode'] . '<br/>';
} else {
    echo 'Not Authorized...';
}
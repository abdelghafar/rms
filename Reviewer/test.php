<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of projectPlan
 *
 * @author ahmed
 */
require_once 'oracleConnection.php';
$conn = new OracleConnect();

$stmt = "SELECT * FROM vrsh_instructors WHERE EMPLOYEE_ID=" . 3990636;


$result = $conn->ExecuteQuery($stmt);
print_r($result);

/*class projectPhase {

    public function __construct() {
        $connection = new OracleConnect();
    }

    public function GetPersonDataById($person_Id) {
        $conn = new OracleConnect();

        $stmt = "SELECT * FROM vrsh_instructors WHERE EMPLOYEE_ID=" . $person_Id;


        $result = $conn->ExecuteQuery($stmt);
        print_r($result);

    }

}*/
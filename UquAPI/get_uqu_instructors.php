<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 09/04/15
 * Time: 11:32 ص
 */
function get_uqu_instructors($employee_code)
{

    $dbstr1 = " (DESCRIPTION =
    (ADDRESS = (PROTOCOL = TCP)(HOST = 172.16.101.22)(PORT = 1521))
    (ADDRESS = (PROTOCOL = TCP)(HOST = 172.16.101.23)(PORT = 1521))
    (LOAD_BALANCE = yes)
    (CONNECT_DATA =
      (SERVER = DEDICATED)
      (SERVICE_NAME = PROD1)
    )
  )";
    echo '<meta charset="utf-8">';
    $conn = oci_pconnect('rsh', 'rsh#2015$', $dbstr1, 'AL32UTF8') or die(ocierror());

    if (!$conn) {
        $e = oci_error();
        trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
    } else {
        $dateFormatSet = oci_parse($conn, 'Alter Session SET NLS_DATE_FORMAT = "DD-MM-YYYY"');
        oci_execute($dateFormatSet);
        $stid = oci_parse($conn, 'SELECT * FROM vrsh_instructors WHERE EMPLOYEE_ID =' . $employee_code);
        oci_execute($stid);
        while (($row = oci_fetch_array($stid, OCI_ASSOC))) {
            print_r($row);
            echo '<br/>' . '----------------------' . '<br/>';
            $person = array('FORM_CODE' => $row['FORM_CODE'],
                'FORM_DESC' => $row['FORM_DESC'],
                'ACTUAL_DEPT_CODE' => $row['ACTUAL_DEPT_CODE'],
                'SITE_FACULTY_NAME' => $row['SITE_FACULTY_NAME'],
                'EMPLOYEE_ID' => $row['EMPLOYEE_ID'],
                'EMPLOYEE_NAME' => $row['EMPLOYEE_NAME'],
                'EMPLOYEE_NAME_S' => $row['EMPLOYEE_NAME_S'],
                'NATIONAL_ID' => $row['NATIONAL_ID'],
                'NATIONALITY_CODE' => $row['NATIONALITY_CODE'],
                'NATIONALITY_DESC' => $row['NATIONALITY_DESC'],
                'GENDER' => $row['GENDER'],
                'GENDER_DESC' => $row['GENDER_DESC'],
                'EMPLOYEE_STATUS_CODE' => $row['EMPLOYEE_STATUS_CODE'],
                'EMPLOYEE_STATUS' => $row['EMPLOYEE_STATUS'],
                'RANK_DATE' => $row['RANK_DATE'],
                'RANK_CODE' => $row['RANK_CODE'],
                'RANK_DESC' => $row['RANK_DESC'],
                'CERTIFICATE_CODE' => $row['CERTIFICATE_CODE'],
                'EMPLOYEE_CERTIFICATE' => $row['EMPLOYEE_CERTIFICATE'],
                'MOBILE_NO' => $row['MOBILE_NO'],
                'EMAIL' => $row['EMAIL']
            );
        }
        return $person;
    }
}
application/x-httpd-php Oracle_test.php
HTML document text
<!DOCTYPE html>

<html>

<head>
    <title>Oracle Test Connection</title>
    <meta charset="utf-8">
</head>

<body>

<?php
$dbstr1 = " (DESCRIPTION =
    (ADDRESS = (PROTOCOL = TCP)(HOST = 172.16.101.22)(PORT = 1521))
    (ADDRESS = (PROTOCOL = TCP)(HOST = 172.16.101.23)(PORT = 1521))
    (LOAD_BALANCE = yes)
    (CONNECT_DATA =
      (SERVER = DEDICATED)
      (SERVICE_NAME = PROD1)
    )
  )";

$conn = oci_pconnect('rsh', 'rsh#2015$', $dbstr1, 'AL32UTF8') or die(ocierror());

if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
} else {
    $dateFormatSet = oci_parse($conn, 'Alter Session SET NLS_DATE_FORMAT = "DD-MM-YYYY"');
    oci_execute($dateFormatSet);
    $stid = oci_parse($conn, 'select * from vrsh_instructors');
    oci_execute($stid);

    //$rows = oci_fetch_array($stid, OCI_ASSOC);
    //$rows = oci_fetch_object($stid);
}
?>
<pre>
            <?php
            require_once 'mysqlConnection.php';
            $mysqlconn = new MysqlConnect();
            $current_date = date('Y-m-d H:i:s');

            while (($row = oci_fetch_array($stid, OCI_ASSOC))) {
                if ($row['FORM_DESC'] !== null)
                    $FORM_DESC = $row['FORM_DESC'];
                else
                    $FORM_DESC = '';

                if ($row['SITE_FACULTY_NAME'] !== null)
                    $SITE_FACULTY_NAME = $row['SITE_FACULTY_NAME'];
                else
                    $SITE_FACULTY_NAME = '';

                if ($row['FACULTY_NAME'] !== null)
                    $FACULTY_NAME = $row['FACULTY_NAME'];
                else
                    $FACULTY_NAME = '';

                if ($row['DEPT_NAME'] !== null)
                    $DEPT_NAME = $row['DEPT_NAME'];
                else
                    $DEPT_NAME = '';

                if ($row['EMPLOYEE_ID'] !== null)
                    $EMPLOYEE_ID = $row['EMPLOYEE_ID'];
                else
                    $EMPLOYEE_ID = 0;

                if ($row['EMPLOYEE_NAME'] !== null)
                    $EMPLOYEE_NAME = $row['EMPLOYEE_NAME'];
                else
                    $EMPLOYEE_NAME = '';

                if ($row['NATIONAL_ID'] !== null)
                    $NATIONAL_ID = $row['NATIONAL_ID'];
                else
                    $NATIONAL_ID = '';

                if ($row['NATIONALITY_DESC'] !== null)
                    $NATIONALITY_DESC = $row['NATIONALITY_DESC'];
                else
                    $NATIONALITY_DESC = '';

                if ($row['GENDER_DESC'] !== null)
                    $GENDER_DESC = $row['GENDER_DESC'];
                else
                    $GENDER_DESC = '';

                if ($row['EMPLOYEE_STATUS'] !== null)
                    $EMPLOYEE_STATUS = $row['EMPLOYEE_STATUS'];
                else
                    $EMPLOYEE_STATUS = '';

                if ($row['RANK_DATE'] !== null)
                    $RANK_DATE = $row['RANK_DATE'];
                else
                    $RANK_DATE = '';

                if ($row['RANK_DESC'] !== null)
                    $RANK_DESC = $row['RANK_DESC'];
                else
                    $RANK_DESC = '';

                if ($row['EMPLOYEE_CERTIFICATE'] !== null)
                    $EMPLOYEE_CERTIFICATE = $row['EMPLOYEE_CERTIFICATE'];
                else
                    $EMPLOYEE_CERTIFICATE = '';

                if ($row['MOBILE_NO'] !== null)
                    $MOBILE_NO = $row['MOBILE_NO'];
                else
                    $MOBILE_NO = '';

                if ($row['EMAIL'] !== null)
                    $EMAIL = $row['EMAIL'];
                else
                    $EMAIL = '';

                $CAT_ID = 1; // for stuff data
                //print_r($row);

                $stmt = "insert into oracle_data (FORM_DESC,SITE_FACULTY_NAME,FACULTY_NAME,DEPT_NAME,EMPLOYEE_ID,EMPLOYEE_NAME,NATIONAL_ID,NATIONALITY_DESC,
                                                 ,GENDER_DESC,EMPLOYEE_STATUS,RANK_DATE,RANK_DESC,EMPLOYEE_CERTIFICATE,MOBILE_NO,EMAIL,SYN_STAMP) 
                        values 
                                ('" . $FORM_DESC . "','" . $SITE_FACULTY_NAME . "','" . $FACULTY_NAME . "','" . $DEPT_NAME . "'," . $EMPLOYEE_ID . ",'" . $EMPLOYEE_NAME . "','" .
                    $NATIONAL_ID . "','" . $NATIONALITY_DESC . "','" . $GENDER_DESC . "','" . $EMPLOYEE_STATUS . "','" . $RANK_DATE . "','" . $RANK_DESC . "','" .
                    $EMPLOYEE_CERTIFICATE . "','" . $MOBILE_NO . "','" . $EMAIL . "'," . $CAT_ID . ",'" . $current_date . "')";
                echo $stmt . "<br>";
                $result = $mysqlconn->ExecuteNonQuery($stmt);

                //echo "<br>" . "  " . $EMPLOYEE_NAME . " " . $MOBILE_NO . " " . $EMAIL;
            }

            oci_free_statement($stid);
            oci_close($conn);
            ?>
        </pre>

</body>
</html>
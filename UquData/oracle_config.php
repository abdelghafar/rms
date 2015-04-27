<html>

    <head>
        <title>Oracle Test Connection</title>
        <meta charset="utf-8">
    </head>

    <body>
        <?php
        require_once '../lib/persons.php';
        
        $p = new Persons();
        
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
            $stid = oci_parse($conn, 'SELECT * FROM vrsh_instructors WHERE EMPLOYEE_ID = 3990976');

            oci_execute($stid);

            while (($row = oci_fetch_array($stid, OCI_ASSOC))) {

                $person = array('FORM_CODE' => $row['FORM_CODE'],
                    'FORM_DESC' => $row['FORM_DESC'],
                    'ACTUAL_DEPT_CODE' => $row['ACTUAL_DEPT_CODE'],
                    'SITE_FACULTY_NAME' => $row['SITE_FACULTY_NAME'],
                    'EMPLOYEE_ID' => $row['EMPLOYEE_ID'],
                    'EMPLOYEE_NAME' => $row['EMPLOYEE_NAME'],
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


            echo '<br/>' . $row['EMPLOYEE_ID'] . '  ' . $row['EMPLOYEE_NAME'] . '----------------------';
                echo $p->ImportPerson($person);
                $imported_emp_count++;
            }
            echo "<br> total_stuff_records_imported = " . $imported_emp_count;
            //return $person;
        }

//$stid = oci_parse($conn, 'select * from vrsh_instructors');
//oci_execute($stid);
//oci_fetch_all($stid, $res);
//echo "<pre>\n";
//var_dump($res);
//echo "</pre>\n";


        /* oci_fetch_all($stid, $res);
          $row = oci_fetch_array($res, OCI_ASSOC);


          echo "<table border='1'>\n";
          foreach ($res as $row) {
          echo "<tr> row .. \n";
          echo "<td>" .$row['EMPLOYEE_NAME']."<td>";
          echo "<td>" .$row['RANK_DATE']."<td>";
          echo "</tr>\n";
          }
          while (($row = oci_fetch_array($stid, OCI_ASSOC))) {
          // var_dump($row);
          echo "<tr> row .. \n";
          echo "<td>" .$row['EMPLOYEE_NAME']."<td>";
          echo "<td>" .$row['RANK_DATE']."<td>";
          /*foreach ($row as $item) {
          echo "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
          }
          echo "</tr>\n";
          }
          echo "</table>\n"; */
        ?>


    </body>
</html>
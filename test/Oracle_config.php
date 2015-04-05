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
            echo 'conn okay..';
        }

//$stid = oci_parse($conn, 'select * from vrsh_instructors');
//oci_execute($stid);
//oci_fetch_all($stid, $res);
//echo "<pre>\n";
//var_dump($res);
//echo "</pre>\n";

        $dateFormatSet = oci_parse($conn, 'Alter Session SET NLS_DATE_FORMAT = "DD-MM-YYYY"');
        oci_execute($dateFormatSet);
        $stid = oci_parse($conn, 'SELECT * FROM vrsh_instructors WHERE EMPLOYEE_ID =4331164');

        oci_execute($stid);
        oci_fetch_all($stid, $res);
        $row = oci_fetch_array($res, OCI_ASSOC)
        print_r($row);
        echo "<table border='1'>\n";
        /*foreach ($res as $row) {
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
        echo "</table>\n";*/
        ?>


</body>
</html>
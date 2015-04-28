<?php

class OracleConnect
{

    public function __construct()
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

        $conn = oci_pconnect('rsh', 'rsh#2015$', $dbstr1, 'AL32UTF8') or die(ocierror());
        if (!$conn) {
            $e = oci_error();
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);

        } else {
            $dateFormatSet = oci_parse($conn, 'Alter Session SET NLS_DATE_FORMAT = "DD-MM-YYYY"');
            oci_execute($dateFormatSet);
            return TRUE;
        }
    }

    public function ExecuteQuery($stmt)
    {
        echo $stmt;
        $stid = oci_parse($conn, $stmt);
        return oci_execute($stid);

    }

}

?>

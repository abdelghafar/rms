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
while (($row = oci_fetch_array($stid, OCI_ASSOC))) {
    print_r($row);
}

oci_free_statement($stid);
oci_close($conn);
?>
</pre>

</body>
</html>
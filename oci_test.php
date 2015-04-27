<?php
try {
    $conn = oci_pconnect('rsh', 'rsh#2015$', '(DESCRIPTION =
		(ADDRESS = (PROTOCOL = TCP)(HOST = 172.16.101.22)(PORT = 1521))
		(ADDRESS = (PROTOCOL = TCP)(HOST = 172.16.101.23)(PORT = 1521))
		(LOAD_BALANCE = yes)
		(CONNECT_DATA =
		  (SERVER = DEDICATED)
		  (SERVICE_NAME = PROD1)
		)
	  )');

    if (!$conn) {
        throw new Exception(oci_error()['message'], 500);
    } else {
        echo '<span style="color:green">Connected Successfully.</span>';
    }
} catch (Exception $ex) {
    echo '<span style="color:FF0000">Exception Error: </span>' . $ex->getMessage();
}
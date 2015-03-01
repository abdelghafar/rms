<?php

$conn = new mysqli('localhost', 'root', '123456789', 'testDb');
if (!$conn) {
    die('Could not connect: ' . mysql_error());
}
$sql1 = "UPDATE users set `name` = 'ahmedsss' where id=2";
$sql2 = "INSERT INTO users (name) values ('kossu')";
$sql3 = "INSERT INTO users (name) values ('ssss')";

$conn->autocommit(FALSE);
$res = $conn->query($sql1);
$error = array();
if ($res === false) {
    array_push($error, $res);
}
$res = $conn->query($sql2);

if ($res === false) {
    array_push($error, $res);
}
$res = $conn->query($sql3);
$insert_id = $conn->insert_id;

if ($res === false) {
    array_push($error, $res);
}
if (empty($error)) {
    $conn->commit();
    echo 'Transaction completed successfully!' . '<br/>';
    echo 'Insert Id:' . $insert_id;
    $conn->autocommit(TRUE);
} else {
    $conn->rollback();
    echo 'Transaction rollback' . '<br/>';
}
?>

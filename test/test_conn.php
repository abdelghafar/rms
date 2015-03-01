<?php

$servername = "localhost";
$username = "dsr_uisr";
$password = "2zxrXZwET~e+";
$db = "dsr_rms";
// Create connection
$conn = new mysqli($servername, $username, $password, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";

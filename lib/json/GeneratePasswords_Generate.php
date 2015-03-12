<?php

require_once '../GeneratePasswords.php';
$pass = generatePassword(12, 2, 1, 3);
echo ($pass);
?>

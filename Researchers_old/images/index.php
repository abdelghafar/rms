<?
session_start();
header('HTTP/1.1 403 Forbidden');
session_destroy();
?>
<html>
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<h1>403 Forbidden or No Permission to Access</h1>

<h2>For Login Click <a href="../../login.php">Here</a></h2>
</body>
</html>

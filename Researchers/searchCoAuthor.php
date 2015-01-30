<?php
session_start();
if (isset($_GET['q'])) {
    $q = $_GET['q'];
    echo '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0//EN" "http://www.w3.org/TR/REC-html40/strict.dtd">';
    echo 'u r searching for ' . $q;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0//EN" "http://www.w3.org/TR/REC-html40/strict.dtd">
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <script src="../js/jquery-ui/dev/jquery-1.9.0.js" type="text/javascript"></script>
        <link href="../js/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <script src="../js/bootstrap/js/bootstrap.js" type="text/javascript"></script>
    </head>
    <body>
        <div class="col-sm-3 col-md-5 pull-left" >
            <form class="navbar-form" role="search">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search" name="q">
                    <div class="input-group-btn">
                        <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                    </div>
                </div>
            </form>
        </div>

    </body>
</html>

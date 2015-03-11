<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <script type="text/javascript" src="../../js/jquery-ui/js/jquery-1.9.0.js"></script>
        <script src="../../js/bootstrap/js/bootstrap.js" type="text/javascript"></script>
        <link href="../../js/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <script type="text/javascript">
            $(document).ready(function () {
                $.ajax({url: 'sample.php', success: function (data, textStatus, jqXHR) {
                        if (data == 1)
                        {
                            $('#msg').html('<span class="glyphicon glyphicon-ok" style="color: green;font-size: 20px;">okay</span>');
                        }
                        else
                        {
                            $('#msg').html('<span class="glyphicon glyphicon-remove" style="color: red;font-size: 20px;">' + 'pdf file must be PDF/A-1' + '</span>');
                        }
                    }
                });
            });
        </script>
    </head>
    <body>
        <div id="msg" style="width: 500px; height: 200px;"></div>
    </body>
</html>

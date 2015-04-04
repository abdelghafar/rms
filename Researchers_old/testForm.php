<?
header('HTTP/1.1 403 Unauthorized');
//$ret = array('status' => 'FALSE', 'txt' => 'Unauthorized access. Please check if You are still logged in.');
//print json_encode($ret);
echo '<h1>Unauthorized access. Please check if You are still logged in.</h1>';
exit();
?>
    <html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
    <form name="form" method="POST" enctype="multipart/form-data" action="inc/test.inc.php">
        <p>
            rcode:
        </p>
        <input id='rcode' name='rcode'/>

        <p>
            rname:
        </p>
        <input id='rname' name='rname'/>

        <p>
            ar_abstract:
        </p>
        <input id='ar_abstract' name='ar_abstract'/>

        <p>
            en_abstract:
        </p>
        <input id='en_abstract' name='en_abstract'/>

        <input type="submit" value="Submit" name="Submit"/>
    </form>

    </body>
    </html>
<?
echo urlencode(base64_encode(1));
echo '<br/>';
echo base64_decode(urldecode('MQ%3D%3D'));
?>
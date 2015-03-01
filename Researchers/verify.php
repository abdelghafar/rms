<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<?
require_once '../lib/Smarty/libs/Smarty.class.php';
$smarty = new Smarty();

$smarty->assign('style_css', '../style.css');
$smarty->assign('style_responsive_css', '../style.responsive.css');
$smarty->assign('jquery_js', '../jquery.js');
$smarty->assign('script_js', '../script.js');
$smarty->assign('script_responsive_js', '../script.responsive.js');
$smarty->assign('index_php', '../index.php');
$smarty->assign('Researchers_register_php', '../Researchers/register.php');
$smarty->assign('login_php', '../login.php');
$smarty->assign('fqa_php', '../fqa.php');
$smarty->assign('contactus_php', '../contactus.php');

$smarty->display('../templates/Loggedin.tpl');
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        require_once '../lib/mysqlConnection.php';
        require_once '../lib/users.php';
        $email = $_GET['email'];
        $hash = $_GET['hash'];
        echo $token . '<br/>';
        echo $email . '<br/>';
        echo $hash . '<br/>';
        
        $stmt = "Select users.user_id From users join persons on persons.person_id = users.person_id where md5(persons.email)='" . $email . "' and md5(users.hash)='" . $hash . "'";
        echo $stmt . '<br/>';
        $conn = new MysqlConnect();
        $rs = $conn->ExecuteNonQuery($stmt);
        $user_id = 0;
        while ($row = mysql_fetch_array($rs))
            $user_id = $row['user_id'];

        $user = new Users();
        $user->ActivateUser($user_id);
        echo 'Activation Done ...!';
        ?>
    </body>
</html>
<?
$smarty->display('../templates/footer.tpl');
?>
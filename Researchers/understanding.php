<?
session_start();
require_once '../lib/understanding.php';
if ($_SESSION['Authorized'] == null) {
    header('Location: https://uqu.edu.sa/e_services/esso/gotoApp/DSR');
} else if ($_SESSION['Authorized'] == 0) {
    header('Location: https://uqu.edu.sa/e_services/esso/gotoApp/DSR');
}
$obj = new Understanding();
$content = $obj->GetUnderstanding($_SESSION['program']);


require_once '../js/fckeditor/fckeditor.php';
require_once '../lib/CenterResearch.php';
require_once '../lib/Smarty/libs/Smarty.class.php';
$smarty = new Smarty();

$smarty->assign('style_css', '../style.css');
$smarty->assign('style_responsive_css', '../style.responsive.css');
$smarty->assign('jquery_js', '../jquery.js');
$smarty->assign('script_js', '../script.js');
$smarty->assign('script_responsive_js', '../script.responsive.js');

$smarty->assign('index_php', '../index.php');
$smarty->assign('research_projects_php', 'Researchers_View.php');
$smarty->assign('logout_php', '../inc/logout.inc.php');
$smarty->assign('about_php', '../aboutus.php');

$smarty->assign('login_php', '../login.php');
$smarty->assign('fqa_php', '../fqa.php');
$smarty->assign('contactus_php', '../contactus.php');

$smarty->display('../templates/header.tpl');

$program = $_SESSION['program'];
?>
    <html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <script>
            function agree() {
                $.ajax({url: 'ajax/setSession.php?q=0', success: function (data) {
                    window.location.assign('research_submit.php');
                }});
            }
            function notAgree() {
                window.location.assign('index.php');
            }
        </script>
    </head>
    <body>
    <div id="content" style="width: 100%; height: auto;min-height: 90px;">
        <?
        echo $content;
        ?>
    </div>
    <table>
        <tr>
            <td>
                <input type="submit" value="not agree" onclick="notAgree();"/>
            </td>
            <td>
                <input type="submit" value="Agree" onclick="agree();"/>
            </td>
        </tr>
    </table>
    </body>
    </html>
<?
$smarty->display('../templates/footer.tpl');

<?
session_start();
require_once '../lib/understanding.php';
$obj = new Understanding();
$content = $obj->GetUnderstanding(1);

if (trim($_SESSION['User_Id']) == 0 || !isset($_SESSION['User_Id'])) {
    header('Location:../Login.php');
} else {
    $rule = $_SESSION['Rule'];
    if ($rule != 'Researcher') {
        header('Location:../Login.php');
    }
}
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
$smarty->assign('Researchers_register_php', '../Researchers/register.php');
$smarty->assign('logout_php', '../inc/logout.inc.php');
$smarty->assign('fqa_php', '../fqa.php');
$smarty->assign('contactus_php', '../contactus.php');
$smarty->display('../templates/Loggedin.tpl');
$program = $_SESSION['program'];
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <script>
            function agree()
            {
                window.location.assign('research_submit.php?program=' + '<? echo $program; ?>');
            }
            function notAgree()
            {
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
                    <input type="submit" value="Agree" onclick="agree();" />
                </td>
            </tr>
        </table>
    </body>
</html>
<?
$smarty->display('../templates/footer.tpl');

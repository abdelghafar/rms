<?php
session_start();
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
require_once '../lib/Reseaches.php';
require_once '../lib/users.php';
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
if (isset($_GET['q'])) {
    $projectId = $_GET['q'];
    $obj = new Reseaches();
    $UserId = $_SESSION['User_Id'];
    $u = new Users();
    $personId = $u->GetPerosnId($UserId, $rule);
    $isAuthorized = $obj->IsAuthorized($projectId, $personId);
    $CanEdit = $obj->CanEdit($projectId);
    if ($isAuthorized == 1 && $CanEdit == 1) {
        $introduction_text = $obj->GetIntroductionText($projectId);
    } else {
        echo '<div class="errormsgbox" style="width: 850px;height: 30px;"><h4>This project is locked from the admin</h4></div>';
        exit();
    }
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <script type="text/javascript" src="../js/jqwidgets/scripts/jquery-1.10.2.min.js"></script>
        <link rel="stylesheet" type="text/css" href="../js/jquery-ui/dev/themes/ui-lightness/jquery.ui.all.css">
        <link href="../common/css/reigster-layout.css" rel="stylesheet" type="text/css"/>
        <script type="text/javascript">
            $(document).ready(function () {
                $('#submit_button').click(function () {
                    var inst = FCKeditorAPI.GetInstance("FCKeditor1");
                    var sValue = inst.GetHTML();
                    $('#FCKeditor1_Val').val(sValue);
                    $.ajax({
                        url: "inc/update_research_introduction_text.inc.php" + '<?
if (isset($projectId)) {
    echo '?q=' . $projectId;
}
?>',
                        type: "post",
                        datatype: "html",
                        data: $("#frm").serialize(),
                        success: function (data) {
                            window.location.assign('research_abstract_ar.php?q=' + '<? echo $projectId; ?>');
                        }
                    });
                });
            });
        </script>
    </head>
    <body>
        <fieldset style="width: 95%;text-align: right;"> 
            <legend>
                <label>
                    مقدمة المشروع
                </label>
            </legend>
            <form id="frm" method="post">
                <input type="hidden" id="FCKeditor1_Val" name="FCKeditor1_Val"/> 
                <table style="direction: rtl;border: 1px;width: 100%;">
                    <tr style="margin-top: 25px;">
                        <td style="width: 200px;">
                            المقدمة / Introduction 
                            <span class="required">*</span>
                        </td>
                        <td>
                            <?
                            $oFCKeditor = new FCKeditor('FCKeditor1');
                            $oFCKeditor->BasePath = '../js/fckeditor/';
                            $oFCKeditor->ToolbarSet = 'Advanced';
                            $oFCKeditor->Width = 790;
                            $oFCKeditor->Height = 400;
                            if (isset($projectId)) {
                                $oFCKeditor->Value = $introduction_text;
                            }
                            $oFCKeditor->Create();
                            ?>
                        </td>
                    </tr>
                </table>
            </form>
        </fieldset>
        <div id="Result" style="width: 800px; height: 50px;">

        </div>
        <table style="width: 100%;">
            <tr>
                <td>
                    <a id="submit_button" href="#" style="float: right;margin-left: 25px;margin-top: 20px;">
                        <img src="images/next.png" style="border: none;" alt="next"/>
                        <div>
                            <span>
                                التالي / Next
                            </span>
                        </div>
                    </a>
                </td>
                <td>
                    <a href="research_submit.php?q=<? echo $projectId; ?>" style="float: left;margin-left: 25px;margin-top: 20px;" onclick="GetData();">
                        <img src="images/back.png" style="border: none;" alt="back"/>
                        <div>
                            <span>
                                Prevoius / السابق
                            </span>
                        </div>
                    </a>
                </td>
            </tr>
        </table>
    </body>
</html>

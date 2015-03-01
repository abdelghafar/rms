<?
session_start();
require_once('../lib/Reseaches.php');
require_once '../lib/ResearchCenter_Reviewers.php';
require_once('../lib/CenterResearch.php');

$c_researches = new CenterResearch();
$center_id = $c_researches->GetResearchCenterByUserName($_SESSION['User_Name']);
$researchId = $_GET['research_id'];
$research_Code = $_GET['research_code'];

$obj = new ResearchCenter_Reviewers();
$rs = $obj->GetRCenterReviwers($center_id);
?>
<head>
    <script type="text/javascript" src="../js/dataTables/media/js/jquery.dataTables.js"></script>
    <link rel="stylesheet" type="text/css" href="../js/jquery-ui/dev/themes/ui-lightness/jquery.ui.all.css"/>
    <link rel="stylesheet" type="text/css" href="../js/dataTables/media/css/demo_table_jui.css"/>
    <link rel="stylesheet" type="text/css" href="../js/dataTables/media/themes/ui-lightness/jquery-ui-1.8.4.custom.css"/>
    <link rel="stylesheet" type="text/css" href="css/reigster-layout.css"/>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#grid').dataTable({
                sPaginationType: "full_numbers",
                bJQueryUI: true,
                bLengthChange: true,
                width: 500,
                oLanguage: {
                    sUrl: "../js/dataTables/media/ar_Ar.txt"}
            });
        });
    </script>
</head>

<div class="panel_row">
    <div class="panel-cell" style="padding-left: 25px;padding-top: 10px;">
        <p> 
            رقم البحث
        </p> 
    </div>
    <div class="panel-cell">
        <p class="small"> 
            <?
            echo $research_Code;
            ?>
        </p>

    </div>
</div>
<form action="inc/Assign_Reviewer.inc.php" method="post">
    <input type="hidden" value="<? echo $researchId; ?>" name="researchId" /> 
    <fieldset style="width: 95%;text-align: right;"> 
        <legend>
            <label>
                المحكمين
            </label>
        </legend>

        <table id="grid" class="display" style="text-align: right;font-size:14px; font-weight: bold;border: 1px solid gray;" dir="rtl" >
            <thead>
                <tr>
                    <th><em>م</em></th>
                    <th>اختر</th>
                    <th>اسم المحكم-اللغة العربية</th>
                    <th>التخصص العام  </th>
                    <th>التخصص الدقيق</th>
                    <th>الجوال</th>
                    <th>اليربد الالكتروني</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $x = 1;
                while ($row = mysql_fetch_array($rs)) {
                    ?>
                    <tr>
                        <td><?
                            echo $x;
                            $x++; //$row['id']; 
                            ?></td>
                        <td>
                            <input type="checkbox" name="chklst[]" value="<? echo $row['Person_id']; ?> "/>
                        </td>
                        <td><? echo $row['name']; ?></td>
                        <td ><? echo $row['Major_Field']; ?></td>
                        <td><? echo $row['Speical_Field']; ?></td>
                        <td><? echo $row['Mobile']; ?></td>

                        <td><? echo $row['Email']; ?></td>

                    </tr>
                    <?php
                }
                ?>
            </tbody>

        </table>
    </fieldset>
    <input type="submit" value="تسجيـل" id='sendButton' style="margin-top: 20px;"/>
</form>


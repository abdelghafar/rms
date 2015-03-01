<?
session_start();
require_once('../lib/Reseaches.php');
$research = new Reseaches();
$researchCode = $_GET['research_code'];
$researchId = $research->GetResearchId($researchCode);
$array = $research->GetResearchDetails($researchId);
$row = mysql_fetch_array($array);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="../common/css/reigster-layout.css"/> 
        <script type="text/javascript" src="../js/jqwidgets/scripts/gettheme.js"></script> 
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxcore.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxinput.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxdatetimeinput.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxcalendar.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxtooltip.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxswitchbutton.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxbuttons.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxmaskedinput.js"></script>
        <script src="../js/jqwidgets/jqwidgets/globalization/globalize.js" type="text/javascript"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxvalidator.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxdropdownlist.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxscrollbar.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxlistbox.js"></script>
        <link rel="stylesheet" href="../js/jqwidgets/jqwidgets/styles/jqx.base.css" type="text/css" />
        <link rel="stylesheet" href="../js/jqwidgets/jqwidgets/styles/jqx.energyblue.css" type="text/css"/>
        <title></title>
    </head>
    <body style="background-color: #ededed;">
        <fieldset style="width: 95%;text-align: right;"> 
            <legend>
                <label>
                    بيانات البحث
                </label>
            </legend>
            <table class="display" style=" text-align: right;font-size:14px; font-weight: bold;border: 1px solid gray;" dir="rtl" >
                <tr class="odd">
                    <td style="width: 50px;">
                        <p>
                            رقم البحث:
                        </p>
                    </td>
                    <td>
                        <?
                        echo $row['research_code'];
                        ?>
                    </td>
                </tr>
                <tr class="even">
                    <td>
                        <p>
                            عنوان البحث-اللغة العربية:
                        </p>
                    </td>
                    <td>

                        <?
                        echo $row['title_ar'];
                        ?> 
                    </td>
                </tr>
                <tr class="odd">
                    <td>
                        <p>
                            عنوان البحث-اللغة الانجليزية:
                        </p>
                    </td>
                    <td>
                        <?
                        echo $row['title_en'];
                        ?> 
                    </td>
                </tr>
                <tr class="even">
                    <td>
                        <p>
                            التخصص العام:
                        </p>
                    </td>
                    <td>
                        <?
                        echo $row['major_field'];
                        ?> 
                    </td>
                </tr>
                <tr class="odd">
                    <td>
                        <p>
                            التخصص الدقيق:
                        </p>
                    </td>
                    <td>
                        <?
                        echo $row['special_field'];
                        ?> 
                    </td>
                </tr>
                <tr class="even">
                    <td>
                        <p>
                            الفترة الزمنية المقترحة- بالشهر:
                        </p>
                    </td>
                    <td>
                        <?
                        echo $row['proposed_duration'];
                        ?> 
                    </td>
                </tr>
                <tr class="odd" style="vertical-align: top;">
                    <td>
                        <p>
                            الملخص - اللغة العربية:
                        </p>
                    </td>
                    <td>
                        <?
                        echo $row['abstract_ar'];
                        ?> 
                    </td>
                </tr>
                <tr class="even" style="vertical-align: top;">
                    <td>
                        <p>
                            الملخص-اللغة الانجليزية:
                        </p>
                    </td>
                    <td>
                        <?
                        echo $row['abstract_en'];
                        ?> 
                    </td>
                </tr>
                <tr class="odd">
                    <td>
                        <p>
                            المحتوي:
                        </p>
                    </td>
                    <td>
                        <?
                        echo '<a href="../' . $row['url'] . '">' . 'تحميل' . '</a>';
                        ?>
                    </td>
                </tr>
            </table>

        </fieldset>
    </body>
</html>

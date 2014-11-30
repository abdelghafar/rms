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
        <link rel="stylesheet"  type="text/css" href="../common/css/reigster-layout.css"/> 
        <link rel="stylesheet" type="text/css" href="../js/dataTables/media/css/demo_table_jui.css">
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
                <tr class="odd" style="width: 20px;">
                    <td>
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
                        echo '<a href="../' . $row['url'] . '"/>تحميل' . '</a>';
                        ?>
                    </td>
                </tr>
            </table>

        </fieldset>
    </body>
</html>

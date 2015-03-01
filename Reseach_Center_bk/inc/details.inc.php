<?php
session_start();
include_once '../../lib/Reseaches.php';
if (empty($_GET['id'])) {
    echo 'Parameter id is not set';
} else {
    $id = base64_decode(filter_input(INPUT_GET, 'id'), true);
    $research = new Reseaches();
    $result = $research->GetResearchDetails($id);
    while ($row = mysql_fetch_array($result)) {
        $title_ar = $row['title_ar'];
        $title_en = $row['title_en'];
        $major_field = $row['major_field'];
        $special_field = $row['special_field'];
        $proposed_duration = $row['proposed_duration'];
        $research_code = $row['research_code'];
        $abstract_ar = $row['abstract_ar'];
        $abstract_en = $row['abstract_en'];
        $url = $row['url'];
        $budget = $row['budget'];
    }
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <style>
            .classic-font{
                font-size:14px;
                color: black; 
                line-height: 100%; 
                text-decoration: none;
            }
        </style>
    </head>
    <body>
        <div class="panel panel-default">
            <div class="panel-heading" style="text-align: right;">
                <h4>
                    تفاصيل البحث
                </h4>
                <h4><?php echo $research_code; ?></h4>
            </div>
            <div class="panel-body">
                <table class="table table-bordered" style="text-align: right;font-size:12px;" dir="rtl" >
                    <tr>
                        <td class="active" style="width: 150px;text-align: left;">
                            <span class="label label-primary" style="font-size: 13px;">
                                عنوان البحث-اللغة العربية:
                            </span>
                        </td>
                        <td>
                            <span class="classic-font">
                                <?
                                echo $title_ar;
                                ?> 
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td class="active" style="text-align: left;">
                            <span class="label label-primary" style="font-size: 13px;">
                                عنوان البحث-اللغة الانجليزية:
                            </span>
                        </td>
                        <td>

                            <?
                            echo $title_en;
                            ?> 

                        </td>
                    </tr>
                    <tr>
                        <td class="active" style="text-align: left;">
                            <span class="label label-primary" style="font-size: 13px;">
                                التخصص العام:
                            </span>
                        </td>
                        <td>
                            <?
                            echo $major_field;
                            ?> 
                        </td>
                    </tr>
                    <tr>
                        <td class="active" style="text-align: left;">
                            <span class="label label-primary" style="font-size: 13px;">
                                التخصص الدقيق:
                            </span>
                        </td>
                        <td>
                            <?
                            echo $special_field;
                            ?> 
                        </td>
                    </tr>
                    <tr>
                        <td class="active" style="text-align: left;">
                            <span class="label label-primary" style="font-size: 13px;">
                                الفترة الزمنية المقترحة- بالشهر:
                            </span>
                        </td>
                        <td>
                            <?
                            echo $proposed_duration;
                            ?> 
                        </td>
                    </tr>
                    <tr>
                        <td class="active" style="text-align: left;">
                            <span class="label label-primary" style="font-size: 13px;">
                                الملخص - اللغة العربية:
                            </span>
                        </td>
                        <td class="classic-font">
                            <?
                            echo $abstract_ar;
                            ?> 
                        </td>
                    </tr>
                    <tr>
                        <td class="active" style="text-align: left;">
                            <span class="label label-primary" style="font-size: 13px;">
                                الملخص-اللغة الانجليزية:
                            </span>
                        </td>
                        <td>
                            <?
                            echo $abstract_en;
                            ?> 
                        </td>
                    </tr>
                    <tr>
                        <td class="active" style="text-align: left;">
                            <span class="label label-primary" style="font-size: 13px;">
                                نموذج -2
                            </span>
                        </td>
                        <td style="vertical-align:middle;">
                            <?
                            echo '<h4 style="margin-top: 0px;margin-bottom: 0px;">' . '<a style="text-decoration:none" href="../' . $url . '">' . "تحميل" . '</a>' . '</h4>';
                            ?>
                        </td>
                    </tr>
                </table>
            </div>
        </div>


    </body>
</html>

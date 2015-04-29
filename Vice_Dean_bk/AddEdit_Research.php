<?
session_start();
if (trim($_SESSION['User_Id']) == 0 || !isset($_SESSION['User_Id'])) {
    header('Location:../Login.php');
} else {
    $rule = $_SESSION['Rule'];
    if ($rule != 'Vice_Dean')
        header('Location:../Login.php');
}
require_once '../lib/Reseaches.php';

if (isset($_GET['Research_id'])) {
    $Research_id = $_GET['Research_id'];
    $obj = new Reseaches();
    $rs = $obj->GetResearchDetailsMin($Research_id);
    $row = mysql_fetch_array($rs);
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>                
            اضافة - تعديل مشروع بحثي
        </title>
        <link rel="stylesheet" href="../common/css/reigster-layout.css"/> 
        <script type="text/javascript" src="../js/jqwidgets/scripts/gettheme.js"></script> 
        <script type="text/javascript" src="../js/jqwidgets/scripts/jquery-1.10.2.min.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxcore.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxinput.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxdatetimeinput.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxcalendar.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxtooltip.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxswitchbutton.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxbuttons.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxdropdownlist.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxscrollbar.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxlistbox.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxmaskedinput.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/globalization/jquery.global.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxvalidator.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxinput.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxcombobox.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxdata.js"></script>
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxdata.export.js"></script>

        <link rel="stylesheet" href="../js/jqwidgets/jqwidgets/styles/jqx.base.css" type="text/css" />
        <link rel="stylesheet" href="../js/jqwidgets/jqwidgets/styles/jqx.energyblue.css" type="text/css"/> 
        <style type="text/css">
            .demo-iframe {
                border: none;
                width: 510px;
                height: 100px;
                display: block;
            }
        </style>
        <script type="text/javascript">
            $(document).ready(function() {
                var theme = "energyblue";
                $(".textbox").jqxInput({rtl: true, height: 25, width: 420, minLength: 1, theme: theme});
                $(".smalltextbox").jqxInput({rtl: true, height: 25, width: 100, minLength: 1, theme: theme});
                $(".textArea").jqxInput({rtl: true, height: 100, width: 300, minLength: 1, theme: theme});
                $("#sendButton").jqxButton({width: '100', height: '30', theme: theme});
                $("#txt_year").jqxMaskedInput({rtl: true, width: 100, height: 25, theme: theme, mask: '####', value: '<?
if (isset($Research_id))
    echo $row['research_year'];
?>'});
                $("#empCode").jqxMaskedInput({rtl: true, width: 100, height: 25, theme: theme, mask: '#######', value: '<?
if (isset($Research_id))
    echo $row['empCode'];
?>'});
                $("#research_Code").jqxMaskedInput({rtl: true, width: 100, height: 25, theme: theme, mask: '########', value: '<?
if (isset($Research_id)) {
    echo $row['research_code'];
}
?>'});
                $("#sendButton").on('click', function() {
                    $("#AddEdit_Research").jqxValidator('validate');
                });
                $('#AddEdit_Research').jqxValidator({
                    rules: [
                        {input: '#research_Code', message: 'من فضلك ادخل رقم البحث', action: 'keyup, blur', rule: 'required', position: 'left'}
                    ], theme: theme
                });
                $("#AddEdit_Research").on('validationSuccess', function() {
                    $("#form-iframe").fadeIn('fast');
                });

            });
        </script>
        <script type="text/javascript">
            $(document).ready(function() {
                var theme = "energyblue";
                // prepare the data of Research_Center DropDown
                var source =
                        {
                            datatype: "json",
                            datafields: [
                                {name: 'id'},
                                {name: 'center_name'}
                            ],
                            url: '../lib/json/Research_Center_GetPairValues.php',
                            async: false
                        };
                var dataAdapter = new $.jqx.dataAdapter(source);
                $("#LstResearchCenter").jqxDropDownList(
                        {
                            source: dataAdapter,
                            theme: theme,
                            width: 180,
                            height: 25,
                            selectedIndex: 0,
                            displayMember: 'center_name',
                            valueMember: 'id',
                            rtl: true});
                $("#LstResearchCenter").val('<? if (isset($Research_id)) echo $row['center_id']; ?>');
            });</script>
        <script type="text/javascript">
            $(document).ready(function() {

                var theme = "energyblue";
                // prepare the data for Research_Status DropDown
                var source =
                        {
                            datatype: "json",
                            datafields: [
                                {name: 'status_id'},
                                {name: 'status_name'}
                            ],
                            url: '../lib/json/reesearch_status_GetAll.php',
                            async: false
                        };
                var dataAdapter = new $.jqx.dataAdapter(source);
                $("#LstResearchStatus").jqxDropDownList(
                        {
                            source: dataAdapter,
                            theme: theme,
                            width: 180,
                            height: 25,
                            selectedIndex: 0,
                            displayMember: 'status_name',
                            valueMember: 'status_id',
                            rtl: true
                        });
                $("#LstResearchStatus").val('<? if (isset($Research_id)) echo $row['Status_Id']; ?>');
            });
        </script>
    </head>
    <body style="background-color: #ededed;">
        <form id="AddEdit_Research" enctype="multipart/form-data" method="POST" action="inc/AddEdit_Researchs.inc.php" target="form-iframe">
            <input type="hidden" value ='<? echo $Research_id; ?>' name ="Research_id"/> 
            <fieldset style="width: 600px;">
                <legend>
                    <label>
                        اضافة مشروع بحثي
                    </label>
                </legend>
                <div class="panel_row">

                    <div class="panel-cell" style="width: 130px;text-align: left;padding-left: 10px;"> 
                        <p>
                            رقم المشروع 
                        </p>
                    </div>
                    <div class="panel-cell" style="vertical-align: middle"> 

                        <div id="research_Code" name="research_Code">

                        </div>
                    </div>
                </div> 

                <div class="panel_row">

                    <div class="panel-cell" style="width:130px;text-align: left;padding-left: 10px;"> 
                        <p>
                            عنوان البحث-باللغة العربية
                        </p>

                    </div>
                    <div class="panel-cell" style="vertical-align: middle"> 
                        <input type="text" id="Research_title" name="Research_title" class="textbox" value="<?
                        if (isset($Research_id)) {
                            echo $row['title_ar'];
                        }
                        ?>"/>
                    </div>
                </div> 

                <div class="panel_row">

                    <div class="panel-cell" style="width:130px;text-align: left;padding-left: 10px;"> 
                        <p>
                            اسم الباحث الرئيسي
                        </p>

                    </div>
                    <div class="panel-cell" style="vertical-align: middle"> 
                        <input id="FirstName-ar" class="smalltextbox" type="text" placeholder="الاسم الاول" name="FirstName_ar" value="<?
                        if (isset($Research_id)) {
                            echo $row['FirstName_ar'];
                        }
                        ?>"/>  
                        <input id="FatherName-ar" class="smalltextbox" type="text" placeholder="اسم الأب" name="FatherName_ar" value="<?
                        if (isset($Research_id)) {
                            echo $row['FatherName_ar'];
                        }
                        ?>"/> 
                        <input id="GrandName-ar" class="smalltextbox" type="text" placeholder="اسم الجد" name="GrandName_ar" value="<?
                        if (isset($Research_id)) {
                            echo $row['GrandName_ar'];
                        }
                        ?>"/> 
                        <input id="FamilyName-ar" class="smalltextbox" type="text" placeholder="لقب العائلة" name="FamilyName_ar" value="<?
                        if (isset($Research_id)) {
                            echo $row['FamilyName_ar'];
                        }
                        ?>" /> 
                    </div>
                </div> 


                <div class="panel_row">

                    <div class="panel-cell" style="width: 130px;text-align: left;padding-left: 10px;"> 
                        <p>
                            المركز البحثي
                        </p>

                    </div>
                    <div class="panel-cell" style="vertical-align: middle"> 
                        <div name="LstResearchCenter" id="LstResearchCenter"></div>
                    </div>
                </div> 
                <div class="panel_row">

                    <div class="panel-cell" style="width: 132px;text-align: left;padding-left: 10px;"> 
                        <p>
                            سنة التقديم
                        </p>

                    </div>
                    <div class="panel-cell" style="vertical-align: middle;"> 
                        <div id="txt_year" name="txt_year"></div>
                    </div>
                </div> 
                <div class="panel_row">

                    <div class="panel-cell" style="width: 132px;text-align: left;padding-left: 10px;"> 
                        <p>
                            رقم المنسوب
                        </p>

                    </div>
                    <div class="panel-cell" style="vertical-align: middle;"> 
                        <div id="empCode" name="empCode"></div>
                    </div>
                </div> 
                <div class="panel_row">

                    <div class="panel-cell" style="width: 132px;text-align: left;padding-left: 10px;"> 
                        <p>
                            حالة البحث
                        </p>

                    </div>
                    <div class="panel-cell" style="vertical-align: middle"> 
                        <div name="LstResearchStatus" id="LstResearchStatus"></div>
                    </div>
                </div> 
            </fieldset>
            <div class="panel_row" style="width: 630px;padding-top: 10px;">
                <div class="panel-cell"style="width: 132px;padding-left: 10px;">
                    <input type="submit" value="حفظ" id="sendButton"/>
                </div>
                <div class="panel-cell" style="vertical-align: middle">
                    <iframe id="form-iframe" name="form-iframe" class="demo-iframe" frameborder="0">

                    </iframe>
                </div>
            </div>
        </form>
    </body>
</html>

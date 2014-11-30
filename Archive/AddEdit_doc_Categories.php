<?
session_start();
require_once '../lib/doc_categories.php';
$doc_cat_id = 0;
if (!isset($_GET['doc_cat_id']) || $_GET['doc_cat_id'] == 0) {
    //ToDo:Insert
} else {
    //ToDO:Update 
    $doc_cat_id = $_GET['doc_cat_id'];
    $obj = new Document_categories();
    $result = $obj->GetBySeqId($doc_cat_id);
    $cat_name = "";
    $cat_note = "";
    while ($row = mysql_fetch_array($result)) {
        $cat_name = $row['cat_name'];
        $cat_note = $row['notes'];
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
        <link rel="stylesheet" href="css/reigster-layout.css"/> 
        <script type="text/javascript" src="../js/jqwidgets/scripts/gettheme.js"></script> 
        <script type="text/javascript" src="../js/jquery-ui/js/jquery-1.9.0.js"></script>
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

        <link rel="stylesheet" href="../js/jqwidgets/jqwidgets/styles/jqx.base.css" type="text/css" />
        <link rel="stylesheet" href="../js/jqwidgets/jqwidgets/styles/jqx.energyblue.css" type="text/css"/> 
        <script type="text/javascript">
            $(document).ready(function() {
                $(".textbox").jqxInput({rtl: true, height: 25, width: 300, minLength: 1, theme: 'energyblue'});
                $(".textArea").jqxInput({rtl: true, height: 100, width: 300, minLength: 1, theme: 'energyblue'});
                $("#sendButton").jqxButton({width: '100px', height: '30px', theme: 'energyblue'});
                $('#AddEdit_doc_Categories_frm').jqxValidator({rules: [
                        {input: '#doc_cat', message: 'من فضلك ادخل اسم الفئة', action: 'keyup,blur', rule: 'minLength=3,required', rtl: true, position: 'topcenter'}
                    ], theme: 'energyblue', animation: 'fade'});
            });
        </script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#sendButton').on('click', function() {
                    $('#AddEdit_doc_Categories_frm').jqxValidator('validate');
                });
                $('#sendButton').on('click', function() {
                    $('#AddEdit_doc_Categories_frm').submit();
                });
            });
        </script>

    </head>
    <body style="background-color: #ededed;">
        <form id="AddEdit_doc_Categories_frm" method="POST" action="inc/AddEdit_doc_Categories.inc.php">
            <input type="hidden" name="seq_id" value="<?
            echo $doc_cat_id;
            ?>"/>
            <fieldset style="width: 400px;">
                <legend>
                    <label>
                        اضافة-تعديل فئات المستندات
                    </label>

                </legend>
                <div class="panel_row">
                    <div class="panel-cell">
                        <p class="required">*</p>
                    </div>
                    <div class="panel-cell" style="width: 100px;text-align: left;padding-left: 10px;"> 
                        <p>
                            اسم الفئة
                        </p>

                    </div>
                    <div class="panel-cell" style="vertical-align: middle"> 
                        <input type="text" class="textbox" id="doc_cat" name="cat_name" value="<?
                        echo $cat_name;
                        ?>" />
                    </div>
                </div> 
                <div class="panel_row">
                    <div class="panel-cell" style="width: 100px;text-align: left;padding-left: 10px;"> 

                        <p>
                            ملاحظات
                        </p>
                    </div>
                    <div class="panel-cell" style="vertical-align: middle"> 

                        <textarea id="cat_notes" name="cat_notes" class="textArea" style="vertical-align: top;"  rows="4" cols="20">
                            <?
                            echo $cat_note;
                            ?>
                        </textarea>
                    </div>
                </div> 
            </fieldset>
        </form>
        <input type="submit" value="حفظ" id="sendButton"/>

    </body>
</html>

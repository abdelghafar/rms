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
                $(".textbox").jqxInput({rtl: true, height: 25, width: 300, minLength: 1, theme: theme});
                $(".textArea").jqxInput({rtl: true, height: 100, width: 300, minLength: 1, theme: theme});
                $("#sendButton").jqxButton({width: '100', height: '30', theme: theme});
                $("#research_Code").jqxMaskedInput({rtl: true, width: 100, height: 25, theme: theme, mask: '########'});
                $("#sendButton").on('click', function() {
                    $("#AddEdit_Research_docs").jqxValidator('validate');
                });
                $('#AddEdit_Research_docs').jqxValidator({
                    rules: [
                        {input: '#research_Code', message: 'من فضلك ادخل رقم البحث', action: 'keyup, blur', rule: 'required', position: 'left'}
                    ], theme: theme
                });
                $("#AddEdit_Research_docs").on('validationSuccess', function() {
                    $("#form-iframe").fadeIn('fast');
                });

            });
        </script>
        <script type="text/javascript">
            $(document).ready(function() {
                Reload_Data();
            });
        </script>
        <script type="text/javascript">
            function Reload_Data() {
                var theme = "energyblue";
                var source =
                        {
                            datatype: "json",
                            datafields: [
                                {name: 'id'},
                                {name: 'cat_name'}
                            ],
                            url: '../lib/json/doc_categories_GetList.php',
                            async: false
                        };
                var dataAdapter = new $.jqx.dataAdapter(source);
                $("#doc_Cat_list").jqxDropDownList(
                        {
                            source: dataAdapter,
                            displayMember: 'cat_name',
                            valueMember: 'id',
                            width: '150px',
                            height: '25px',
                            theme: theme,
                            selectedIndex: 0,
                            rtl: true
                        });
            }
        </script>
    </head>
    <body style="background-color: #ededed;">
        <form id="AddEdit_Research_docs" enctype="multipart/form-data" method="POST" action="inc/AddEdit_Research_docs.inc.php" target="form-iframe">
            <fieldset style="width: 600px;">
                <legend>
                    <label>
                        اضافة مستندات مشروع بحثي
                    </label>
                </legend>
                <div class="panel_row">

                    <div class="panel-cell" style="width: 130px;text-align: left;padding-left: 10px;"> 

                        <p>
                            رقم المشروع 
                        </p>

                    </div>
                    <div class="panel-cell" style="vertical-align: middle"> 

                        <div id="research_Code"></div>
                    </div>
                </div> 

                <div class="panel_row">

                    <div class="panel-cell" style="width:130px;text-align: left;padding-left: 10px;"> 
                        <p>
                            فئة المستند
                        </p>

                    </div>
                    <div class="panel-cell" style="vertical-align: middle"> 
                        <div name="doc_Cat_list" id="doc_Cat_list"></div>
                    </div>
                </div> 

                <div class="panel_row">

                    <div class="panel-cell" style="width: 128px;text-align: left;padding-left: 10px;"> 
                        <p>
                            المستند
                        </p>

                    </div>
                    <div class="panel-cell" style="vertical-align: middle"> 
                        <input type="file" name="file" id="file" style="width:300px;" dir="ltr"/>
                    </div>
                </div> 
                <div class="panel_row">

                    <div class="panel-cell" style="width: 132px;text-align: left;padding-left: 10px;"> 
                        <p>
                            ملاحظات
                        </p>

                    </div>
                    <div class="panel-cell" style="vertical-align: top;"> 
                        <textarea id="notes" name="notes" class="textArea" cols="20" rows="10" style="vertical-align: top;">
                        
                        </textarea>
                    </div>
                </div> 

            </fieldset>
            <div class="panel_row">
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

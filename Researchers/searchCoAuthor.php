<?php
session_start();

require_once '../lib/persons.php';
if (isset($_GET['q'])) {
    $q = $_GET['q'];

    $p = new Persons();
    $rs = $p->GetPersonByEmpCode($q);
    while ($row = mysql_fetch_array($rs)) {
        echo $row['Email'] . '<br/>';
        echo $row['Person_id'];
    }
    if (mysql_affected_rows() == 0) {
        echo 'Not registed EmpCode';
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
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
        <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxdata.js"></script>

        <link rel="stylesheet" href="../js/jqwidgets/jqwidgets/styles/jqx.base.css" type="text/css" />
        <link rel="stylesheet" href="../js/jqwidgets/jqwidgets/styles/jqx.energyblue.css" type="text/css"/> 
        <script type="text/javascript">
            $(document).ready(function () {
                var Curr_theme = 'energyblue';
                var tmpPersonData = null;
                var tmpPerson_id = null;
                var tmpName = null;
                var tmpGender = null;
                var tmpEmpCode = null;
                var tmpSpeicalField = null;
                var tmpMajor_Field = null;
                var tmpEmail = null;
                var tmpDept = null;
                var tmpCollege = null;
                $("#SearchByEmpCode").jqxMaskedInput({width: '250px', height: '35px', rtl: true, mask: '#######', theme: Curr_theme});
                $("#searchButton").jqxButton({width: 50, height: 35, theme: Curr_theme});
                $('#searchButton').on('click', function () {
                    $.ajax({
                        url: "Data/GetPersonByEmpCode.php?empCode=" + SearchByEmpCodeVal,
                        type: "GET",
                        dataType: "json",
                        beforeSend: function () {
                            $('#coAuthorName').html("<img src='common/images/ajax-loader.gif' />");
                        },
                        success: function (data) {
                            if (data === null)
                            {
                                tmpPerson_id = null;
                                tmpName = null;
                                tmpGender = null;
                                tmpEmpCode = null;
                                tmpSpeicalField = null;
                                tmpMajor_Field = null;
                                tmpEmail = null;
                                tmpDept = null;
                                tmpCollege = null;
                                $('#coAuthorName').html('هذا الرقم غير مسجل برجاء تسجيل الباحث أولا');

                            } else {
                                tmpPersonData = data;
                                console.log(tmpPersonData);
                                tmpPerson_id = data[0]['person_id'];
                                tmpName = data[0]['name'];
                                tmpGender = data[0]['gender'];
                                tmpEmpCode = data[0]['empCode'];
                                tmpSpeicalField = data[0]['Speical_Field'];
                                tmpMajor_Field = data[0]['Major_Field'];
                                tmpEmail = data[0]['Email'];
                                tmpDept = data[0]['Dept'];
                                tmpCollege = data[0]['College'];
                                $('#coAuthorName').html(tmpName);
                            }
                        }
                    });

                });
            });
        </script>

    </head>
    <body>
        <div id="search" style="direction: rtl;float: right;padding-right: 15px;padding-top: 10px;">
            <form id='searchfrom' action="#" method="post">
                <label for="txtSearch">
                    رقم المنسوب
                </label>
                <input id="SearchByEmpCode" type="text" placeholder="رقم المنسوب" name="txtSearch"/>
                <input id="searchButton" type="submit" value="بحث"/>

            </form>
        </div>


    </body>
</html>

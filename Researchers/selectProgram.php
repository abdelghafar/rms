<?
session_start();

//$_SESSION['Authorized'] = 1;


//$_SESSION['person_id'] = 252; // فيصل
//$_SESSION['person_id'] = 3; // عبدالله
//$_SESSION['person_id'] = 2; // السيد فؤاد
//$_SESSION['person_id'] = 382; // باسم
//$_SESSION['person_id'] = 123; // نعيمة
//$_SESSION['person_id'] = 1029; // نورة
//$_SESSION['person_id'] = 4; // عبدالغفار
//$_SESSION['person_id'] = 8;
//$_SESSION['person_id'] = 4168; //هشام عرابي

//$_SESSION['program'] = 0;
//$_SESSION['program_id'] = 0;
//$_SESSION['Authorized'] =0;
        
//require_once '../lib/persons.php';
//require_once '../lib/program.php';
//require_once '../lib/submitRound.php';

if ($_SESSION['Authorized'] == null) {
    header('Location: https://uqu.edu.sa/e_services/esso/gotoApp/DSR');
} else if ($_SESSION['Authorized'] == 0) {
    header('Location: https://uqu.edu.sa/e_services/esso/gotoApp/DSR');
}

//$submitround = new SubmitRound();
//$submitround_rs = $submitround->GetCurrentRound();
//
//if ($submitround_data = mysql_fetch_array($submitround_rs)) {
//    $submission_start_date = $submitround_data['start_date'];
//}

//echo $_SESSION['person_id'];
//$person = new Persons();
//$person_rs = $person->GetPerson($_SESSION['person_id']);
require_once '../js/fckeditor/fckeditor.php';
require_once '../lib/CenterResearch.php';
require_once '../lib/Smarty/libs/Smarty.class.php';
$smarty = new Smarty();

$smarty->assign('style_css', '../style.css');
$smarty->assign('style_responsive_css', '../style.responsive.css');
$smarty->assign('jquery_js', '../jquery.js');
$smarty->assign('script_js', '../script.js');
$smarty->assign('Researchers_register_php', '../Researchers/register.php');
$smarty->assign('index_php', '../index.php');
$smarty->assign('research_projects_php', 'selectProgram.php');
$smarty->assign('logout_php', '../inc/logout.inc.php');
$smarty->assign('about_php', '../aboutus.php');
$smarty->assign('login_php', '../login.php');
$smarty->assign('fqa_php', '../fqa.php');
$smarty->assign('contactus_php', '../contactus.php');

$smarty->display('../templates/header.tpl');
?>
<head>
    <meta charset="UTF-8">
    <title></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
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
    <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxmaskedinput.js"></script>
    <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxvalidator.js"></script>
    <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxdropdownlist.js"></script>
    <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxscrollbar.js"></script>
    <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxnumberinput.js"></script>
    <script src="../js/jqwidgets/jqwidgets/globalization/globalize.js" type="text/javascript"></script>
    <link href="../js/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css"/>

    <link rel="stylesheet" href="../js/jqwidgets/jqwidgets/styles/jqx.base.css" type="text/css"/>
    <link rel="stylesheet" href="../js/jqwidgets/jqwidgets/styles/jqx.energyblue.css" type="text/css"/>

    <script src="../js/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

</head>
<body>
    <?php
    if(!isset($_SESSION['person_id']))
    {
        echo "<script type='text/javascript'>
            window.location.assign('https://uqu.edu.sa/egate/');
         </script>";
    }
 else {
        if(((isset($_SESSION['person_id'])) ||  $_SESSION['person_id']>0 ) && ($_SESSION['program_id'] > 0))
            echo "<script type='text/javascript'>
            window.location.assign('Researchers_View.php');
         </script>";
        else {
            echo "<h2 style='text-lign:center;color:red'> لا ينطبق عليك شروط التقديم فى برامج المنح البحثية المقدمة <br><br> You do not Meet the Grant programs prerequisites </h2> ";
        }
    }
?>


        

</body>
    <?
    $smarty->display('../templates/footer.tpl');


    //echo $_SESSION['program_id'];
/* require_once '../js/fckeditor/fckeditor.php';
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
  ?>
  <head>
  <meta charset="UTF-8">
  <title></title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
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
  <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxmaskedinput.js"></script>
  <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxvalidator.js"></script>
  <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxdropdownlist.js"></script>
  <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxscrollbar.js"></script>
  <script type="text/javascript" src="../js/jqwidgets/jqwidgets/jqxnumberinput.js"></script>
  <script src="../js/jqwidgets/jqwidgets/globalization/globalize.js" type="text/javascript"></script>
  <link href="../js/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css"/>

  <link rel="stylesheet" href="../js/jqwidgets/jqwidgets/styles/jqx.base.css" type="text/css"/>
  <link rel="stylesheet" href="../js/jqwidgets/jqwidgets/styles/jqx.energyblue.css" type="text/css"/>

  <script src="../js/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
  <script type='text/javascript'>
  $(document).ready(function () {
  $('#wa3da').click(function () {
  $.ajax({url: 'ajax/setProgramSession.php?program=wa3da', success: function (data, textStatus, jqXHR) {
  window.location.assign('Researchers_View.php');
  } });

  });
  $('#ba7th').click(function () {
  $.ajax({url: 'ajax/setProgramSession.php?program=ba7th', success: function (data, textStatus, jqXHR) {
  window.location.assign('Researchers_View.php');
  } });

  });
  $('#ra2d').click(function () {
  $.ajax({url: 'ajax/setProgramSession.php?program=ra2d', success: function (data, textStatus, jqXHR) {
  window.location.assign('Researchers_View.php');
  } });

  });
  });
  </script>
  </head>
  <body>
  <?php
  if ($_SESSION['gender'] == 0) {
  if ($_SESSION['User_Id'] == 1) {
  echo '<button id="ra2d" type="button" class="btn btn-success btn-lg" style="width: 350px; height: 100px;margin-left: 80px;">
  أبحاث سابك
  <br>SABIC Researches
  </button>
  <button id="ba7th" type="button" class="btn btn-primary btn-lg" style="width: 350px; height: 100px;">
  أبحاث المعلم محمد بن لادن
  <br>Mohammed ben Laden Researches
  </button>';
  } else {
  echo '<button id="ra2d" type="button" class="btn btn-success btn-lg" style="width: 300px; height: 100px;margin-left: 80px;">
  برنامج رائد
  <br>Raed Program
  </button>

  <button id="ba7th" type="button" class="btn btn-primary btn-lg" style="width: 300px; height: 100px;">
  برنامج باحث
  <br>Baheth Program
  </button>';
  }
  } else {
  echo '<button id="wa3da" type="button" class="btn btn-warning btn-lg" style="width: 300px; height: 100px;margin-left: 80px">
  برنامج واعدة
  <br>Waaeda Program
  </button>

  <button id="ba7th" type="button" class="btn btn-primary btn-lg" style="width: 300px; height: 100px;">برنامج باحث
  <br>Baheth Program
  </button>';
  }
  ?>

  </body>
  <?
  $smarty->display('../templates/footer.tpl');

 */

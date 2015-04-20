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

$_SESSION['program'] = 0;

require_once '../lib/persons.php';
require_once '../lib/program.php';
require_once '../lib/submitRound.php';

if (isset($_SESSION['Authorized'])) {
    if ($_SESSION['Authorized'] != 1) {
        header('Location:../login.php');
    }
}
$submitround = new SubmitRound();
$submitround_rs = $submitround->GetCurrentRound();

if ($submitround_data = mysql_fetch_array($submitround_rs)) {
    $submission_start_date = $submitround_data['start_date'];
}


$person = new Persons();
$person_rs = $person->GetPerson($_SESSION['person_id']);

if ($person_data = mysql_fetch_array($person_rs)) {
    $Position = $person_data['Position'];
    $RANK_DATE = $person_data['rank_date'];
    $Nationality = $person_data['Nationality'];
    $Gender = $person_data['Gender'];
    $_SESSION['name_ar'] = $person_data['name_ar'];


    $submission_timestamp = strtotime($submission_start_date);

    $rank_timestamp = strtotime($RANK_DATE);

    $Rank_Period_days = floor(abs(($submission_timestamp - $rank_timestamp) / (60 * 60 * 24)));

    //echo "Name = " . $_SESSION['name_ar'] . "ps = " . $Position . " R_da   " . $RANK_DATE . "  Sub_dat " . $submission_start_date . "  Nat " . $Nationality . " Gend  " . $Gender . " Per " . $Rank_Period_days;


    if ($Position === "محاضر" or $Position === "معيد" or ($Position === "أستاذ مساعد" and $Rank_Period_days < 720)) {
        if ($Nationality === "سعودي") {
            $program = "ra2d";
            $_SESSION['program_alias'] = "رائد / ra2d";
        }
    } else {
        if ($Position === "أستاذ" or $Position === "أستاذ مشارك" or ($Position === "أستاذ مساعد" and $Rank_Period_days >= 720)) {
            if ($Gender == 2) {
                $program = "wa3da";
                $_SESSION['program_alias'] = " واعدة / wa3da";
            } else {
                $program = "ba7th";
                $_SESSION['program_alias'] = "باحث / ba7th";
            }
        } else {
            //end 
        }
    }
    //echo "<br> program = " . $program;

    $t = new program();
    $program_id = $t->GetProgramId($program);
    $_SESSION['program'] = $program_id;

    if ($_SESSION['program'] == 0) {
        echo "<script type='text/javascript'>
            window.location.assign('../index.php');
         </script>";
    } else {
        echo "<script type='text/javascript'>
            window.location.assign('Researchers_View.php');
         </script>";
    }
    //header('Location: Researchers_View.php');
}


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

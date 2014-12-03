<?php

session_start();
require_once '../../lib/persons.php';
require_once '../../lib/users.php';
require_once '../../lib/ResearchCenter_Reviewers.php';
require_once '../../lib/GeneratePasswords.php';

require_once('../../lib/CenterResearch.php');
$c_researches = new CenterResearch();
$center_id = $c_researches->GetResearchCenterByUserName($_SESSION['User_Name']);

$personId = 0;
$FirstName_ar = mysql_escape_string($_POST['FirstName_ar']);
$FirstName_en = mysql_escape_string($_POST['FirstName_en']);
$FatherName_ar = mysql_escape_string($_POST['FatherName_ar']);
$FatherName_en = mysql_escape_string($_POST['FatherName_en']);
$GrandName_ar = mysql_escape_string($_POST['GrandName_ar']);
$GrandName_en = mysql_escape_string($_POST['GrandName_en']);
$FamilyName_ar = mysql_escape_string($_POST['FamilyName_ar']);
$FamilyName_en = mysql_escape_string($_POST['FamilyName_en']);
$Major_Field = mysql_escape_string($_POST['major_field']);
$Speical_Field = mysql_escape_string($_POST['special_field']);
$Email = mysql_escape_string($_POST['email']);
$Mobile = mysql_escape_string($_POST['mobile']);
$IBAN = $_POST['IBAN'];

$isValid = True;
if (empty($FirstName_ar) || strlen($FirstName_ar) == 0) {
    $isValid = FALSE;
}
if (empty($FirstName_en) || strlen($FirstName_en) == 0) {
    $isValid = FALSE;
}
if (empty($FatherName_ar) || strlen($FatherName_ar) == 0) {
    $isValid = FALSE;
}
if (empty($FatherName_en) || strlen($FatherName_en) == 0) {
    $isValid = FALSE;
}
if (empty($GrandName_ar) || strlen($GrandName_ar) == 0) {
    $isValid = FALSE;
}
if (empty($GrandName_en) || strlen($GrandName_en) == 0) {
    $isValid = FALSE;
}
if (empty($FamilyName_ar) || strlen($FamilyName_ar) == 0) {
    $isValid = FALSE;
}
if (empty($FamilyName_en) || strlen($FamilyName_en) == 0) {
    $isValid = FALSE;
}

if (empty($Major_Field) || strlen($Major_Field) == 0) {
    $isValid = FALSE;
}
if (empty($Speical_Field) || strlen($Speical_Field) == 0) {
    $isValid = FALSE;
}
if (empty($Email) || strlen($Email) == 0) {
    $isValid = FALSE;
}
if ($isValid == FALSE) {
    echo '<p>' . 'من فضلك أكمل باقي البيانات' . '</p>';
    exit();
}

$person = new Persons();

$Action = $_POST['Action'];


switch ($Action) {
    case "Update": {

            $personId = $_POST['person_id'];
//            $Result = $person->Save($personId, $FirstName_ar, $FirstName_en, $FatherName_ar, $FatherName_en, $GrandName_ar, $GrandName_en, $FamilyName_ar, $FamilyName_en, 1, '', '', '', '', $Major_Field, $Speical_Field, '', '', '', '', '', $Email, $Mobile, '', '', '', '', '', $IBAN);
            $Result = $person->Save($personId, $FirstName_ar, $FirstName_en, $FatherName_ar, $FatherName_en, $GrandName_ar, $GrandName_en, $FamilyName_ar, $FamilyName_en, 1, '', '', '', '', $Major_Field, $Speical_Field, '', '', '', '', '', $Email, $Mobile, '', '', '', '', '', $IBAN, '');
            var_dump($Result);
            break;
        }
    case "Insert": {

            $isExitId = $person->IsExistByEmail($Email);
            if ($isExitId == 0) {
//                $SavePersonResult = $person->Save($personId, $FirstName_ar, $FirstName_en, $FatherName_ar, $FatherName_en, $GrandName_ar, $GrandName_en, $FamilyName_ar, $FamilyName_en, 1, '', '', '', '', $Major_Field, $Speical_Field, '', '', '', '', '', $Email, $Mobile, '', '', '', '', '', $IBAN);

                $LastPersonId = $person->Save($personId, $FirstName_ar, $FirstName_en, $FatherName_ar, $FatherName_en, $GrandName_ar, $GrandName_en, $FamilyName_ar, $FamilyName_en, 1, '', '', '', '', $Major_Field, $Speical_Field, '', '', '', '', '', $Email, $Mobile, '', '', '', '', '', $IBAN, '');

                $obj = new ResearchCenter_Reviewers();
                $SaveToResearchCenter = $obj->Save($center_id, $LastPersonId);

                //Create Basic Reviewer Account 
                $user = new Users();
                $userName = generatePassword(8);
                $SaveUserAcc = $user->Save(0, $userName, '', '', $LastPersonId, 'Reviewer', 1, 0, '', '', 1, '', '');

                if ($SaveToResearchCenter == 1 && $SaveUserAcc == 1) {
                    $Result = 1;
                } else {
                    $Result = 0;
                }
            } else {
                //Add to RCenter_Reviwers
                $obj = new ResearchCenter_Reviewers();
                $SaveToResearchCenter = $obj->Save($center_id, $isExitId);
                if ($SaveToResearchCenter == 1) {
                    $Result = 1;
                } else {
                    $Result = 0;
                }
            }
        }
}

if ($Result == 1) {
    $mesg = 'تم حفظ البيانات بنجاح';
} else {
    $mesg = 'لقد فشلت عملية حفظ البيانات برجاء اعادة المحاولة لاحقا';
}

echo $mesg;


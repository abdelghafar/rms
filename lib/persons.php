<?php

require_once 'mysqlConnection.php';
require_once 'users.php';

class Persons {

    public function __construct() {
        $connection = new MysqlConnect();
    }

    public function Save($id, $FirstName_ar, $FirstName_en, $FatherName_ar, $FatherName_en, $GrandName_ar, $GrandName_en, $FamilyName_ar, $FamilyName_en, $gender, $Nationality, $BirthDate, $CountryOfBirth, $Position, $Major_Field, $Speical_Field, $university, $College, $Dept, $empCode, $EqamaCode, $Email, $Mobile, $Fax, $city, $country, $POX, $Postal_Code, $IBAN, $ResumeUrl) {

        $conn = new MysqlConnect();
        $stmt = "";
        if ($id == 0) {
            $stmt = "Insert into persons(FirstName_ar,FirstName_en,FatherName_ar,FatherName_en,GrandName_ar,GrandName_en,FamilyName_ar,FamilyName_en,Gender,Nationality,DateOfBirth,CountryOfBirth,Position,Major_Field,Speical_Field,university,College,Dept,empCode,EqamaCode,Email,Mobile,Fax,city,country,POX,Postal_Code,IBAN) values('" . $FirstName_ar . "','" . $FirstName_en . "','" . $FatherName_ar . "','" . $FatherName_en . "','" . $GrandName_ar . "','" . $GrandName_en . "','" . $FamilyName_ar . "','" . $FamilyName_en . "','" . $gender . "','" . $Nationality . "','" . $BirthDate . "','" . $CountryOfBirth . "','" . $Position . "','" . $Major_Field . "','" . $Speical_Field . "','" . $university . "','" . $College . "','" . $Dept . "','" . $empCode . "','" . $EqamaCode . "','" . $Email . "','" . $Mobile . "','" . $Fax . "','" . $city . "','" . $country . "','" . $POX . "','" . $Postal_Code . "','" . $IBAN . "')";
            $res = $conn->ExecuteNonQuery($stmt);
            return mysql_insert_id();
        } else {
            $stmt = "update persons set FirstName_ar='" . $FirstName_ar . "',FirstName_en='" . $FirstName_en . "',FatherName_ar='" . $FatherName_ar . "',FatherName_en='" . $FatherName_en . "',GrandName_ar='" . $GrandName_ar . "',GrandName_en='" . $GrandName_en . "',FamilyName_ar='" . $FamilyName_ar . "',FamilyName_en='" . $FamilyName_en . "' , Nationality='" . $Nationality . "',DateOfBirth='" . $BirthDate . "',CountryOfBirth='" . $CountryOfBirth . "',Position='" . $Position . "',Major_Field='" . $Major_Field . "',Speical_Field='" . $Speical_Field . "',College='" . $College . "',Dept='" . $Dept . "',empCode=" . $empCode . ",EqamaCode=" . $EqamaCode . ",Mobile='" . $Mobile . "',Fax='" . $Fax . "',city='" . $city . "',country='" . $country . "',POX='" . $POX . "',Postal_Code='" . $Postal_Code . "',IBAN='" . $IBAN . "' ,ResumeUrl ='" . $ResumeUrl . "' where `Person_id`=" . $id;
            echo $stmt;
            $res = $conn->ExecuteNonQuery($stmt);
        }
        return $res;
    }

    public function GetPerson($PersonId) {
        $stmt = "SELECT  `Person_id` ,  `FirstName_ar` ,  `FirstName_en` ,  `FatherName_ar` ,  `FatherName_en` ,  `GrandName_ar` ,  `GrandName_en` ,  `FamilyName_ar` ,  `FamilyName_en` ,  `Gender` ,  `Nationality` , `DateOfBirth` ,  `CountryOfBirth` ,  `Position` ,  `Major_Field` ,  `Speical_Field` ,  `university` ,  `College` ,  `Dept` ,  `empCode` ,  `EqamaCode` ,  `Email` ,  `Mobile` ,  `Fax` ,  `city` ,  `country` ,  `POX` , `Postal_Code` ,  `IBAN` ,  `SWIFT` , ResumeUrl FROM  `persons` where `Person_id`=" . $PersonId;
        $result = mysql_query($stmt);
        return $result;
    }

    public function GetLastPersonId() {
        $stmt = "SELECT max(person_id) FROM persons ORDER BY person_id ASC";
        $result = mysql_query($stmt);
        $id = 0;
        while ($row = mysql_fetch_array($result)) {
            $id = $row[0];
        }
        return $id;
    }

    public function IsExist($EqamaCode) {
        $stmt = "SELECT person_id FROM persons Where EqamaCode='" . $EqamaCode . "'";
        $result = mysql_query($stmt);
        $id = 0;
        while ($row = mysql_fetch_array($result)) {
            $id = $row[0];
        }
        return $id;
    }

    public function IsExistByEmail($Email) {
        $stmt = "SELECT person_id FROM persons Where Email='$Email'";
        $result = mysql_query($stmt);
        $person_id = 0;
        while ($row = mysql_fetch_array($result)) {
            $person_id = $row['person_id'];
        }
        return $person_id;
    }

    public function GetPersonByEmail($Email) {
        $stmt = "SELECT  `Person_id` ,  `FirstName_ar` ,  `FirstName_en` ,  `FatherName_ar` ,  `FatherName_en` ,  `GrandName_ar` ,  `GrandName_en` ,  `FamilyName_ar` ,  `FamilyName_en` ,  `Gender` ,  `Nationality` , `DateOfBirth` ,  `CountryOfBirth` ,  `Position` ,  `Major_Field` ,  `Speical_Field` ,  `university` ,  `College` ,  `Dept` ,  `empCode` ,  `EqamaCode` ,  `Email` ,  `Mobile` ,  `Fax` ,  `city` ,  `country` ,  `POX` , `Postal_Code` ,  `IBAN` ,  `SWIFT` FROM  `persons` where `Email`=" . $Email;
        $result = mysql_query($stmt);
        return $result;
    }

    public function Delete($personId) {
        $stmt = "DELETE from persons where `Person_id`=" . $personId;
        $result = mysql_query($stmt);
        return $result;
    }

}

?>

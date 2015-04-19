<?php

require_once 'mysqlConnection.php';
require_once 'users.php';

class Persons
{

    public function __construct()
    {
        $connection = new MysqlConnect();
    }

    public function Save($id, $FirstName_ar, $FirstName_en, $FatherName_ar, $FatherName_en, $GrandName_ar, $GrandName_en, $FamilyName_ar, $FamilyName_en, $gender, $Nationality, $BirthDate, $CountryOfBirth, $Position, $Major_Field, $Speical_Field, $university, $College, $Dept, $empCode, $EqamaCode, $Email, $Mobile, $Fax, $city, $country, $POX, $Postal_Code, $IBAN, $ResumeUrl)
    {
        $conn = new MysqlConnect();
        $stmt = "";
        if ($id == 0) {
            $stmt = "Insert into persons(FirstName_ar,FirstName_en,FatherName_ar,FatherName_en,GrandName_ar,GrandName_en,FamilyName_ar,FamilyName_en,Gender,Nationality,DateOfBirth,CountryOfBirth,Position,Major_Field,Speical_Field,university,College,Dept,empCode,EqamaCode,Email,Mobile,Fax,city,country,POX,Postal_Code,IBAN,name_ar,name_en) values('" . $FirstName_ar . "','" . $FirstName_en . "','" . $FatherName_ar . "','" . $FatherName_en . "','" . $GrandName_ar . "','" . $GrandName_en . "','" . $FamilyName_ar . "','" . $FamilyName_en . "','" . $gender . "','" . $Nationality . "','" . $BirthDate . "','" . $CountryOfBirth . "','" . $Position . "','" . $Major_Field . "','" . $Speical_Field . "','" . $university . "','" . $College . "','" . $Dept . "','" . $empCode . "','" . $EqamaCode . "','" . $Email . "','" . $Mobile . "','" . $Fax . "','" . $city . "','" . $country . "','" . $POX . "','" . $Postal_Code . "','" . $IBAN . "',concat(`FirstName_ar`,' ',`FatherName_ar`,' ',`GrandName_ar`,' ',`FamilyName_ar`),concat(`FirstName_en`,' ',`FatherName_en`,' ',`GrandName_en`,' ',`FamilyName_en`)" . ")";
            $res = $conn->ExecuteNonQuery($stmt);
            return mysql_insert_id();
        } else {
            $stmt = "update persons set FirstName_ar='" . $FirstName_ar . "',FirstName_en='" . $FirstName_en . "',FatherName_ar='" . $FatherName_ar . "',FatherName_en='" . $FatherName_en . "',GrandName_ar='" . $GrandName_ar . "',GrandName_en='" . $GrandName_en . "',FamilyName_ar='" . $FamilyName_ar . "',FamilyName_en='" . $FamilyName_en . "' , Nationality='" . $Nationality . "',DateOfBirth='" . $BirthDate . "',CountryOfBirth='" . $CountryOfBirth . "',Position='" . $Position . "',Major_Field='" . $Major_Field . "',Speical_Field='" . $Speical_Field . "',College='" . $College . "',Dept='" . $Dept . "', Mobile='" . $Mobile . "',Fax='" . $Fax . "',city='" . $city . "',country='" . $country . "',POX='" . $POX . "',Postal_Code='" . $Postal_Code . "',IBAN='" . $IBAN . "' ,ResumeUrl ='" . $ResumeUrl . "',`name_ar` = concat(`FirstName_ar`,' ',`FatherName_ar`,' ',`GrandName_ar`,' ',`FamilyName_ar`),name_en=concat(`FirstName_en`,' ',`FatherName_en`,' ',`GrandName_en`,' ',`FamilyName_en`) " . "where `Person_id`=" . $id;
            $res = $conn->ExecuteNonQuery($stmt);
        }
        return $res;
    }

    public function GetPerson($PersonId)
    {
        $stmt = "SELECT  `Person_id` ,  `FirstName_ar` ,  `FirstName_en` ,  `FatherName_ar` ,  `FatherName_en` ,  `GrandName_ar` ,  `GrandName_en` ,  `FamilyName_ar` ,  `FamilyName_en` ,  `Gender` ,  `Nationality` , `DateOfBirth` ,  `CountryOfBirth` ,  `Position` ,  `Major_Field` ,  `Speical_Field` ,  `university` ,  `College` ,  `Dept` ,  `empCode` ,  `EqamaCode` ,  `Email` ,  `Mobile` ,  `Fax` ,  `city` ,  `country` ,  `POX` , `Postal_Code` ,  `IBAN` ,  `SWIFT` , ResumeUrl FROM  `persons` where `Person_id`=" . $PersonId;
        $result = mysql_query($stmt);
        return $result;
    }

    public function GetPersonByEmpCode($EmpCode)
    {
        $stmt = "SELECT  `Person_id` ,  `FirstName_ar` ,  `FirstName_en` ,  `FatherName_ar` ,  `FatherName_en` ,  `GrandName_ar` ,  `GrandName_en` ,  `FamilyName_ar` ,  `FamilyName_en` ,  `Gender` ,  `Nationality` , `DateOfBirth` ,  `CountryOfBirth` ,  `Position` ,  `Major_Field` ,  `Speical_Field` ,  `university` ,  `College` ,  `Dept` ,  `empCode` ,  `EqamaCode` ,  `Email` ,  `Mobile` ,  `Fax` ,  `city` ,  `country` ,  `POX` , `Postal_Code` ,  `IBAN` ,  `SWIFT` FROM  `persons` where `empcode`=" . $EmpCode . ' limit 0,1';
        $result = mysql_query($stmt);
        return $result;
    }

    public function IsExist($EqamaCode)
    {
        $stmt = "SELECT person_id FROM persons Where EqamaCode='" . $EqamaCode . "'";
        $result = mysql_query($stmt);
        $id = 0;
        while ($row = mysql_fetch_array($result)) {
            $id = $row[0];
        }
        return $id;
    }

    public function IsExistByEmail($Email)
    {
        $stmt = "SELECT person_id FROM persons Where Email='$Email'";
        $result = mysql_query($stmt);
        $person_id = 0;
        while ($row = mysql_fetch_array($result)) {
            $person_id = $row['person_id'];
        }
        return $person_id;
    }

    public function findByEmployeeCode($employee_code)
    {
        $stmt = "SELECT person_id FROM persons Where empCode=" . $employee_code;
        $result = mysql_query($stmt);
        $person_id = 0;
        while ($row = mysql_fetch_array($result)) {
            $person_id = $row['person_id'];
        }
        return $person_id;
    }

    public function GetPersonByEmail($Email)
    {
        $stmt = "SELECT `Person_id` ,  `FirstName_ar` ,  `FirstName_en` ,  `FatherName_ar` ,  `FatherName_en` ,  `GrandName_ar` ,  `GrandName_en` ,  `FamilyName_ar` ,  `FamilyName_en` ,  `Gender` ,  `Nationality` , `DateOfBirth` ,  `CountryOfBirth` ,  `Position` ,  `Major_Field` ,  `Speical_Field` ,  `university` ,  `College` ,  `Dept` ,  `empCode` ,  `EqamaCode` ,  `Email` ,  `Mobile` ,  `Fax` ,  `city` ,  `country` ,  `POX` , `Postal_Code` ,  `IBAN` ,  `SWIFT` FROM  `persons` where `Email`=" . $Email;
        $result = mysql_query($stmt);
        return $result;
    }

    public function Delete($personId)
    {
        $stmt = "DELETE from persons where `Person_id`=" . $personId;
        $result = mysql_query($stmt);
        return $result;
    }

    //added
    public function GetPersonName($personId)
    {
        $stmt = "SELECT name_ar FROM persons Where Person_id=" . $personId;
        $result = mysql_query($stmt);
        while ($row = mysql_fetch_array($result)) {
            $name_ar = $row['name_ar'];
        }
        return $name_ar;
    }

    public function ImportPerson($person_details)
    {
        $conn = new MysqlConnect();
        $stmt = "INSERT INTO persons (Gender,Nationality,Position,College,empCode,EqamaCode,Email,Mobile,name_ar,rank_date,EMPLOYEE_CERTIFICATE,EMPLOYEE_STATUS_CODE,EMPLOYEE_STATUS,CAT_CODE,name_en) Values ('" . $person_details['GENDER'] . "','" . $person_details['NATIONALITY_DESC'] . "','" . $person_details['RANK_DESC'] . "','" . $person_details['SITE_FACULTY_NAME'] . "','" . $person_details['EMPLOYEE_ID'] . "','" . $person_details['NATIONAL_ID'] . "','" . $person_details['EMAIL'] . "','" . $person_details['MOBILE_NO'] . "','" . $person_details['EMPLOYEE_NAME'] . "','" . $person_details['RANK_DATE'] . "','" . $person_details['EMPLOYEE_CERTIFICATE'] . "'," . $person_details['EMPLOYEE_STATUS_CODE'] . ",'" . $person_details['EMPLOYEE_STATUS'] . "','" . $person_details['FORM_CODE'] . "','" . $person_details['EMPLOYEE_NAME_S'] . "')";
//        echo $stmt;
        $res = $conn->ExecuteNonQuery($stmt);
        return mysql_insert_id();
    }

    public function SetResumeUrl($person_id, $url)
    {
        $conn = new MysqlConnect();
        $stmt = "update persons set ResumeUrl='" . $url . "' where Person_id=" . $person_id;
        $rs = $conn->ExecuteNonQuery($stmt);
        return mysql_affected_rows();
    }

    public function GetResumeUrl($person_id)
    {
        $con = new MysqlConnect();
        $stmt = "Select ResumeUrl From persons where person_id=" . $person_id;
        $rs = $con->ExecuteNonQuery($stmt);
        $ResumeUrl = "";
        while ($row = mysql_fetch_array($rs)) {
            $ResumeUrl = $row['ResumeUrl'];
        }
        return $ResumeUrl;
    }
}

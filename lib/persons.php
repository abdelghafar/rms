<?php

require_once 'mysqlConnection.php';

class Persons
{

    public function __construct()
    {
        $connection = new MysqlConnect();
    }

    public function Save($id,$name_ar, $name_en, $gender, $Nationality, $Position, $university, $College, $Dept,$Email, $Mobile,$cat_code,$ni_image_url)
    {
        $conn = new MysqlConnect();
        $stmt = "insert into persons (name_ar,name_en,gender,nationality,Position,university,college,dept,email,mobile,cat_code,ni_image_url) VALUES ('".$name_ar."','".$name_en."',".$gender.",'".$Nationality."','".$Position."','".$university."','".$College."','".$Dept."','".$Email."','".$Mobile."',".$cat_code.",'".$ni_image_url."')";
        if ($id == 0) {
            $res = $conn->ExecuteNonQuery($stmt);
            return mysql_insert_id();
        } else {
            throw new ErrorException('Not implemented function');
        }
        return $res;
    }

    public function GetPerson($PersonId)
    {
        $stmt = "SELECT  *  FROM  `persons` where `Person_id`=" . $PersonId;
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
//        echo $stmt;
        $rs = $conn->ExecuteNonQuery($stmt);
        return mysql_affected_rows();
    }

    public function GetResumeUrl($person_id)
    {
        $con = new MysqlConnect();
        $stmt = "Select ResumeUrl From persons where Person_id=" . $person_id;

        $rs = $con->ExecuteNonQuery($stmt);
        $ResumeUrl = "";
        while ($row = mysql_fetch_array($rs)) {
            $ResumeUrl = $row['ResumeUrl'];
        }
        return $ResumeUrl;
    }
}
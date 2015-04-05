<?php
require_once 'mysqlConnection.php';

class Users {

    public function __construct() {
        $connection = new MysqlConnect();
    }

    public function Save($user_id, $userName, $pass, $hash, $personId, $rule, $isActive, $Sys_GroupId, $FromDate, $ThruDate, $isTemp, $alias_name, $Last_Access) {

        if ($user_id == 0) {
            $Creation_date = date('Y-m-d');
            $pass = md5($pass);
            $stmt = "insert into users (user_name,pass,`hash`,person_id,rule,`isActive`,`Sys_GroupId`,`FromDate`,`ThruDate`,`isTemp`,alias_name,`Last_Access`,creation_date) values ('$userName','$pass','$hash',$personId,'$rule',$isActive,$Sys_GroupId,'$FromDate','$ThruDate',$isTemp,'$alias_name','$Last_Access','$Creation_date')";
        } else {
            
        }
        $conn = new MysqlConnect();
        $rs = $conn->ExecuteNonQuery($stmt);
        return mysql_insert_id();
    }

    public function GetUser($userId) {
        $stmt = "select user_id,user_name,pass,person_id,rule,`isActive`,`Sys_GroupId`,`FromDate`,`ThruDate`,`isTemp`,alias_name,`Last_Access` from users where user_id =$userId";
        $conn = new MysqlConnect();
        $rs = $conn->ExecuteNonQuery($stmt);
        while ($row = mysql_fetch_array($rs)) {
            $result = array('user_id' => $row['user_id'],
                'user_name' => $row['user_name'],
                'pass' => $row['pass'],
                'person_id' => $row['person_id'],
                'rule' => $row['rule'],
                'isActive' => $row['isActive'],
                'Sys_GroupId' => $row['Sys_GroupId'],
                'FromDate' => $row['FromDate'],
                'ThruDate' => $row['ThruDate'],
                'isTemp' => $row['isTemp'],
                'alias_name' => $row['alias_name'],
                'Last_Access' => $row['Last_Access']
            );
        }
        return $result;
    }

    public function ChnagePassword($userId, $Password) {
        $Password = md5($Password);
        $stmt = "update users set pass='$Password' where user_id=" . $userId;
        $conn = new MysqlConnect();
        $rs = $conn->ExecuteNonQuery($stmt);
        return $rs;
    }

    public function ChnagePasswordWithDate($userId, $Password, $fromDate, $thruDate) {
        $hash_password = md5($Password);
        $stmt = "update users set pass='$hash_password', fromDate='$fromDate',thruDate='$thruDate' where user_id=" . $userId;
        $conn = new MysqlConnect();
        $rs = $conn->ExecuteNonQuery($stmt);
        return $rs;
    }

    public function ActivateUser($userId) {
        $stmt = "Update users set isActive=1 where user_id=" . $userId;
        $conn = new MysqlConnect();
        $conn->ExecuteNonQuery($stmt);
        return;
    }

    public function SetLastAccess($userId) {
        $stmt = "update users set `Last_Access` = now() where user_id=" . $userId;
        $conn = new MysqlConnect();
        $conn->ExecuteNonQuery($stmt);
        return;
    }

    public function IsExist($user_Name) {
        $stmt = "Select user_id from users where user_name ='" . $user_Name . "'";
        $result = mysql_query($stmt);
        $id = 0;
        while ($row = mysql_fetch_array($result)) {
            $id = $row["user_id"];
        }
//echo $id;
        if ($id == 0)
            return 1; //user name not exist
        else
            return 0; //user name exists 
    }

    public function Login($userName, $password) {
        $stmt = "Select user_id from users where isActive=1 and user_name ='" . $userName . "' and pass='" . md5($password) . "'";
        
        $result = mysql_query($stmt);
        while ($row = mysql_fetch_array($result)) {
            $id = $row["user_id"];
        }
        return $id;
    }

    public function IsTemp($userId) {
        $stmt = "select `isTemp` from users where user_id = " . $userId;
        $result = mysql_query($stmt);
        while ($row = mysql_fetch_array($result)) {
            $isTemp = $row["isTemp"];
        }
        return $isTemp;
    }

    public function GetFromDate($userId) {
        $stmt = "select `FromDate` from users where `isTemp`=1 and user_id=" . $userId;
        $result = mysql_query($stmt);
        while ($row = mysql_fetch_array($result)) {
            $FromDate = $row[0];
        }
        return $FromDate;
    }

    public function GetThruDate($userId) {
        $stmt = "select `ThruDate` from users where `isTemp`=1 and user_id=" . $userId;
        $result = mysql_query($stmt);
        while ($row = mysql_fetch_array($result)) {
            $ThruDate = $row[0];
        }
        return $ThruDate;
    }

    public function GetUserName($user_id) {
        $stmt = "Select user_name from users where user_id  =" . $user_id;

        $result = mysql_query($stmt);
        $name = '';
        while ($row = mysql_fetch_array($result)) {
            $name = $row["user_name"];
        }
        return $name;
    }

    public function GetAliasName($user_id) {
        $stmt = "Select alias_name from users where user_id  =" . $user_id;

        $result = mysql_query($stmt);
        $name = '';
        while ($row = mysql_fetch_array($result)) {
            $name = $row["alias_name"];
        }
        return $name;
    }

    public function GetUserRule($user_id) {
        $stmt = "Select rule from users where user_id  =" . $user_id;

        $result = mysql_query($stmt);
        $rule = '';
        while ($row = mysql_fetch_array($result)) {
            $rule = $row["rule"];
        }

        return $rule;
    }

    public function GetPerosnId($UserId, $Rule) {
        $stmt = "select users.person_id from users where users.user_id=" . $UserId . " and rule = '" . $Rule . "' ; ";

        $result = mysql_query($stmt);
        $PersonId = 0;
        while ($row = mysql_fetch_array($result)) {
            $PersonId = $row["person_id"];
        }
        return $PersonId;
    }

    public function GetUserByPersonId($PersonId, $Rule) {
        $stmt = "select users.user_id,user_name from users where users.person_id= '$PersonId' and rule = '$Rule' ";
        $result = mysql_query($stmt);
        return $result;
    }

    public function GetResearchCenterAcc() {
        $stmt = "select users.user_id, user_name, alias_name,case when date_Format(`Last_Access`,'%d-%m-%Y %h:%m%s') = '00-00-0000 00:00:00' Then 'غير محدد' else `Last_Access` end as `Last_Access` from users where rule='Reseach_Center'";
        $result = mysql_query($stmt);
        return $result;
    }

    public function GetListOfUsers($Rule) {
        $stmt = "select concat(`FirstName_ar`,' ',`FatherName_ar`,' ',`GrandName_ar`,' ',`FamilyName_ar`) as name_ar ,`Position`,`College`,`Email`,creation_date, `Last_Access`  from persons join users on persons.`Person_id` = users.person_id and users.rule='$Rule'";
        $result = mysql_query($stmt);
        return $result;
    }

    public function GetUserGender($user_id) {
        $stmt = "select persons.Gender from persons join users on persons.person_id= users.person_id where users.user_id=" . $user_id;
        $result = mysql_query($stmt);
        $gender = '';
        while ($row = mysql_fetch_array($result)) {
            $gender = $row["Gender"];
        }
        return $gender;
    }

}

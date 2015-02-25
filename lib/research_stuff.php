<?php

require_once 'mysqlConnection.php';

class research_stuff {

    private $table_name = 'research_stuff';

    public function __construct() {
        $connection = new MysqlConnect();
    }

    public function Save($research_id, $person_id, $role_id) {
        $conn = new MysqlConnect();
        $stmt = "Insert into " . $this->table_name . " (research_id,person_id,role_id) Values(" . $research_id . "," . $person_id . "," . $role_id . ")";
        $conn->ExecuteNonQuery($stmt);
        return mysql_insert_id();
    }

    public function IsExist($ResearchId, $PersonId) {
        $con = new MysqlConnect();
        $stmt = "SELECT `seq_no` FROM " . $this->table_name . " WHERE `research_id`=" . $ResearchId . " and `person_id`=" . $PersonId;
        //echo $stmt; 
        $rs = $con->ExecuteNonQuery($stmt);
        $result = 0;
        while ($row = mysql_fetch_array($rs)) {
            $result = $row[0];
        }
        if ($result > 0) {
            return 1;
        } else {
            return 0;
        }
    }

    //get all stuff
    public function GetProjectStuff($projectId) {
        $con = new MysqlConnect();
        $stmt = "SELECT persons.name_ar,persons.Major_Field,stuff_roles.role_name,persons.`Position` from research_stuff join persons on research_stuff.person_id =persons.Person_id join stuff_roles on stuff_roles.seq_id=research_stuff.role_id where research_stuff.research_id=" . $projectId;
        return $con->ExecuteNonQuery($stmt);
    }

    //get all stuff except the PI
    public function GetProjectMembers($projectId) {
        $con = new MysqlConnect();
        $stmt = "SELECT concat(persons.FirstName_ar,' ',persons.FatherName_ar,' ',persons.GrandName_ar,' ' ,persons.FamilyName_ar ) AS name_ar,stuff_roles.role_name,persons.empCode,research_stuff.person_id from persons join research_stuff on research_stuff.person_id = persons.Person_id  join stuff_roles on stuff_roles.seq_id = research_stuff.role_id where research_stuff.research_id=" . $projectId . " and research_stuff.role_id  != 1";
        return $con->ExecuteNonQuery($stmt);
    }

    public function DeleteStuff($ResearchId, $PersonId) {
        $conn = new MysqlConnect();
        $stmt = "Delete From " . $this->table_name . " where research_id=" . $ResearchId . " and person_id=" . $PersonId;
        echo $stmt;
        $conn->ExecuteNonQuery($stmt);
    }

    //get,set accept_letter urls-------------------------------------------------------
    public function SetCoAuthor_agreement_url($research_id, $person_id, $url) {
        $stmt = "update " . $this->table_name . " set `agreement_url` = '" . $url . "' where research_id =" . $research_id . " and person_id=" . $person_id;
        $conn = new MysqlConnect();
        $conn->ExecuteNonQuery($stmt);
        return mysql_affected_rows();
    }

    public function GetAccept_letter_url_url($projectId) {
        $stmt = "Select agreement_url From researches where seq_id =" . $projectId;
        $conn = new MysqlConnect();
        $result = $conn->ExecuteNonQuery($stmt);
        $url = null;
        while ($row = mysql_fetch_array($result)) {
            $url = $row[0];
        }
        return $url;
    }

    //Get,set stuff resume_url
    public function SetResumeUrl($research_id, $person_id, $url) {
        $stmt = "update " . $this->table_name . " set `resume_url` = '" . $url . "' where research_id =" . $research_id . " and person_id=" . $person_id;
        $conn = new MysqlConnect();
        $conn->ExecuteNonQuery($stmt);
        return mysql_affected_rows();
    }

    public function GetResumeUrl($projectId) {
        $stmt = "Select resume_url From researches where seq_id =" . $projectId;
        $conn = new MysqlConnect();
        $result = $conn->ExecuteNonQuery($stmt);
        $url = null;
        while ($row = mysql_fetch_array($result)) {
            $url = $row[0];
        }
        return $url;
    }

}

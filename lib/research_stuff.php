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

    //get all stuff
    public function GetProjectStuff($projectId) {
        $con = new MysqlConnect();
        $stmt = "SELECT concat(persons.FirstName_ar,' ',persons.FatherName_ar,' ',persons.GrandName_ar,' ' ,persons.FamilyName_ar ) AS name_ar,stuff_roles.role_name,persons.empCode,research_stuff.person_id from persons join research_stuff on research_stuff.person_id = persons.Person_id  join stuff_roles on stuff_roles.seq_id = research_stuff.role_id where research_stuff.research_id=" . $projectId;
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

}

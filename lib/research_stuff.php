<?php

require_once 'mysqlConnection.php';

class research_stuff_categories
{

    static $role_based = 'role_based';
    static $person_based = 'personal_based';

}

class research_stuff
{

    private $table_name = 'research_stuff';

    public function __construct()
    {
        $connection = new MysqlConnect();
    }

    public function Save($research_id, $person_id, $role_id, $type)
    {
        $conn = new MysqlConnect();
        if ($type == research_stuff_categories::$person_based) {
            $stmt = "Insert into " . $this->table_name . " (research_id,person_id,role_id,type) Values(" . $research_id . "," . $person_id . "," . $role_id . ",'" . $type . "')";
        } else if ($type == research_stuff_categories::$role_based) {
            $stmt = "Insert into " . $this->table_name . " (research_id,role_id,type) Values(" . $research_id . "," . $role_id . ",'" . $type . "')";
        }
        $conn->ExecuteNonQuery($stmt);
        return mysql_insert_id();
    }

    public function IsExist($ResearchId, $PersonId)
    {
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

    /**
     * @param $role_id
     * @param $research_id
     *
     */
    public function IsRoleResearchExists($role_id, $research_id)
    {
        $con = new MysqlConnect();
        $stmt = "Select count(*) as 'count' From research_stuff Where research_id=" . $research_id . ' and role_id=' . $role_id;
        $rs = $con->ExecuteNonQuery($stmt);
        $sum = 0;
        while ($row = mysql_fetch_array($rs)) {
            $sum = $row[0];
        }
        if ($sum > 0) {
            return 1;
        } else
            return 0;
    }


    public function GetSeqId($research_id, $person_id, $role_id, $type)
    {
        $pcon = new MysqlConnect();
        $stmt = "SELECT * FROM research_stuff WHERE research_id=" . $research_id . " and person_id=" . $person_id . " and role_id=" . $role_id . " and type= '" . $type . "'";
        echo $stmt;
        $rs = $pcon->ExecuteNonQuery($stmt);
        $id = 0;
        while ($row = mysql_fetch_array($rs)) {
            $id = $row['seq_no'];
        }
        return $id;
    }

    //get all stuff
    public function GetProjectStuff($projectId)
    {
        $con = new MysqlConnect();
        $stmt = "SELECT  name_ar,stuff_roles.role_name,persons.empCode,research_stuff.person_id from persons join research_stuff on research_stuff.person_id = persons.Person_id  join stuff_roles on stuff_roles.seq_id = research_stuff.role_id where research_stuff.research_id=" . $projectId;
        return $con->ExecuteNonQuery($stmt);
    }

    //get all stuff except the PI
    public function GetProjectMembers($projectId)
    {
        $con = new MysqlConnect();
        $stmt = "SELECT name_ar,stuff_roles.role_name,persons.empCode,research_stuff.person_id from persons join research_stuff on research_stuff.person_id = persons.Person_id  join stuff_roles on stuff_roles.seq_id = research_stuff.role_id where research_stuff.research_id=" . $projectId . " and research_stuff.role_id  != 1";
        return $con->ExecuteNonQuery($stmt);
    }

    public function DeleteStuff($ResearchId, $PersonId)
    {
        $conn = new MysqlConnect();
        $stmt = "Delete From " . $this->table_name . " where research_id=" . $ResearchId . " and person_id=" . $PersonId;
        $conn->ExecuteNonQuery($stmt);
    }

    public function Delete($seq_id)
    {
        $conn = new MysqlConnect();
        $stmt = "Delete From " . $this->table_name . " where seq_no=" . $seq_id;
        $conn->ExecuteNonQuery($stmt);
        return mysql_affected_rows();
    }

    //get,set accept_letter urls-------------------------------------------------------
    public function SetResearchStuffAgreement($seq_no, $url)
    {
        $stmt = "update " . $this->table_name . " set `agreement_url` = '" . $url . "' where seq_no=" . $seq_no;
        $conn = new MysqlConnect();
        $conn->ExecuteNonQuery($stmt);
        return mysql_affected_rows();
    }

    public function GetResearchStuffAgreement($seq_no)
    {
        $stmt = "Select agreement_url From " . $this->table_name . " where seq_no =" . $seq_no;
        $conn = new MysqlConnect();
        $result = $conn->ExecuteNonQuery($stmt);
        $url = null;
        while ($row = mysql_fetch_array($result)) {
            $url = $row[0];
        }
        return $url;
    }

    //get set resume file
    public function SetResearchStuffResume($seq_no, $url)
    {
        $stmt = "update " . $this->table_name . " set `resume_url` = '" . $url . "' where seq_no =" . $seq_no;
        $conn = new MysqlConnect();
        $conn->ExecuteNonQuery($stmt);
        return mysql_affected_rows();
    }

    public function GetResearchStuffResume($seq_no)
    {
        $stmt = "Select resume_url From " . $this->table_name . " where seq_no =" . $seq_no;
        $conn = new MysqlConnect();
        $result = $conn->ExecuteNonQuery($stmt);
        $url = null;
        while ($row = mysql_fetch_array($result)) {
            $url = $row[0];
        }
        return $url;
    }

    public function GetProjectAllStuffs($projectId)
    {
        $conn = new MysqlConnect();
        $stmt = "SELECT p.person_id,name_ar,rs.role_id, sr.role_name, sr.seq_id FROM persons p INNER JOIN research_stuff rs ON p.person_id = rs.person_id INNER JOIN stuff_roles sr ON rs.role_id = sr.seq_id WHERE research_id =" . $projectId . " ORDER BY rs.role_id, seq_id";
        //echo $stmt;
        $result = $conn->ExecuteNonQuery($stmt);
        return $result;
    }

    public function GetProjectDuration($projectId)
    {
        $conn = new MysqlConnect();
        $stmt = "SELECT proposed_duration FROM researches WHERE seq_id =" . $projectId;
        //echo $stmt;
        $result = $conn->ExecuteNonQuery($stmt);
        return $result;
    }

    public function GetProjectOtherPersonalStuff($project_id)
    {
        $conn = new MysqlConnect();
        $stmt = "SELECT research_stuff.seq_no , role_name , parent_role_id FROM research_stuff join stuff_roles ON research_stuff.role_id = stuff_roles.seq_id where research_id = " . $project_id . " and type='role_based' and stuff_roles.parent_role_id in (select seq_id from stuff_roles where stuff_roles.parent_role_id=4)";
        //echo $stmt;
        $rs = $conn->ExecuteNonQuery($stmt);
        while ($row = mysql_fetch_array($rs, MYSQL_ASSOC)) {
            $result[] = array(
                'seq_no' => $row['seq_no'],
                'role_name' => $row['role_name'],
                'parent_role_id' => $row['parent_role_id'],
                'parent_role' => ''
            );
        }

        for ($i = 0; $i < count($result); $i++) {
            $stmt = "SELECT role_name FROM stuff_roles where seq_id=" . $result[$i]['parent_role_id'];
            $rs = $conn->ExecuteNonQuery($stmt);
            $parent_role = "";
            while ($row = mysql_fetch_array($rs, MYSQL_ASSOC)) {
                $parent_role = $row['role_name'];
            }
            $result[$i]['parent_role'] = $parent_role;
        }
        return $result;
    }

    public function GetProjectTeam($projectId)
    {
        $conn = new MysqlConnect();
        $stmt = "SELECT rs.seq_no,rs.person_id,rs.role_id,rs.type, sr.role_name, sr.role_name_en, rs.agreement_url , rs.resume_url, rs.finishing_scholarship_url, sr.max_compensation_val, sr.seq_id FROM research_stuff rs INNER JOIN stuff_roles sr ON rs.role_id = sr.seq_id WHERE research_id =" . $projectId . " ORDER BY rs.role_id, seq_id";
        //echo $stmt;
        $result = $conn->ExecuteNonQuery($stmt);
        return $result;
    }

    public function CanDelete($research_stuff_id)
    {
        $conn = new MysqlConnect();
        $stmt = "SELECT count(*) FROM `stuff_tasks` WHERE `research_stuff_id`= " . $research_stuff_id;
        $result = $conn->ExecuteNonQuery($stmt);
        $count = 0;
        while ($row = mysql_fetch_array($result)) {
            $count = $row[0];
        }
        if ($count == 0)
            return 1; //u can del
        else
            return 0;
        //u can not delete
    }


    /**
     * @param $research_id
     * @param $parent_role_id
     * @return int
     *
     */
    public function GetMaxValueRole($research_id, $parent_role_id)
    {
        $con = new MysqlConnect();
        $stmt = "select IFNULL(MAX(value),0) AS value from research_stuff join stuff_roles on research_stuff.role_id=stuff_roles.seq_id where parent_role_id=" . $parent_role_id . " and research_stuff.research_id=" . $research_id;
        $rs = $con->ExecuteNonQuery($stmt);
        $value = 0;
        while ($row = mysql_fetch_array($rs)) {
            $value = $row[0];
        }
        return $value;
    }

    /***
     * @param $research_id
     * @param $parent_role_id
     * @return int
     */
    public function GetLastRoleBasedMember($research_id, $parent_role_id)
    {
        $con = new MysqlConnect();
        $stmt = "SELECT IFNULL(MAX(seq_no),0) AS seq_no FROM research_stuff JOIN stuff_roles ON research_stuff.role_id = stuff_roles.seq_id WHERE parent_role_id =" . $parent_role_id . " AND research_stuff.research_id =" . $research_id . " LIMIT 0 , 1";
        $rs = $con->ExecuteNonQuery($stmt);
        $seq_no = 0;
        while ($row = mysql_fetch_array($rs)) {
            $seq_no = $row[0];
        }
        return $seq_no;
    }

}

<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of projectPlan
 *
 * @author ahmed
 */
require_once 'mysqlConnection.php';

class Outcomes {

    public function __construct() {
        $connection = new MysqlConnect();
    }
    
    public function Save($seqId, $projectId, $outcomeTitle, $outcomeDesc) {
        $conn = new MysqlConnect();
        if ($seqId == 0)
            $stmt = "insert into project_outcome (project_id,outcome_title,outcome_desc) values (" . $projectId . ",'" . $outcomeTitle . "','" . $outcomeDesc . "')";
        else
            $stmt = "update project_outcome set `project_id` = $projectId ,`outcome_title` ='" . $outcomeTitle . "' , `outcome_desc` ='" . $outcomeDesc . "' WHERE `seq_id` = $seqId";
        //echo $stmt;
        $result = $conn->ExecuteNonQuery($stmt);
        return $result;
        /* $conn->ExecuteNonQuery($stmt);
          return mysql_insert_id(); */
    }
    
   
    public function edit_outcome_objective($objective_id,$outcome_id) {
        $conn = new MysqlConnect();
            $stmt = "update project_objectivies set `outcome_id` = ". $outcome_id . " WHERE `seq_id` = ". $objective_id;
        //echo $stmt;
        $result = $conn->ExecuteNonQuery($stmt);
        return $result;
        /* $conn->ExecuteNonQuery($stmt);
          return mysql_insert_id(); */
    }
    
    public function GetOutcomeData($seqId) {
        $conn = new MysqlConnect();
        $stmt = "SELECT * FROM project_outcome WHERE seq_id=" . $seqId;
        $result = $conn->ExecuteNonQuery($stmt);
        $row = mysql_fetch_array($result);
        return $row;
    }
    
    public function GetOutcomes($projectId) {
        $conn = new MysqlConnect();
        $stmt = "SELECT * FROM project_outcome WHERE project_id=" . $projectId;
        $rs = $conn->ExecuteNonQuery($stmt);
        return $rs;
    }

    public function Delete($seqId) {
        $conn = new MysqlConnect();
        $stmt = "Delete from project_outcome where seq_id =" . $seqId;
        
        $result =$conn->ExecuteNonQuery($stmt);
        return $result;
    }
    
     public function isExist($project_id, $seq_id, $title) {
        $conn = new MysqlConnect();
        $stmt = "SELECT count(seq_id) as obj_count FROM project_outcome WHERE outcome_title='" . $title .
                "' AND project_id = " . $project_id;
        $result = $conn->ExecuteNonQuery($stmt);
        $row = mysql_fetch_array($result);

        if ($seq_id == 0) {

            if ($row['obj_count'] > 0)
                return true;
            else
                return false;
        } else {
            $stmt2 = "SELECT seq_id FROM project_outcome WHERE outcome_title='" . $title .
                    "' AND project_id = " . $project_id;

            //echo $stmt2;
            $result2 = $conn->ExecuteNonQuery($stmt2);
            $row2 = mysql_fetch_array($result2);
            //echo $row['poem_count']." ". $row2[id]."--". $poem_id ;
            if ($row['obj_count'] > 1 || ($row['obj_count'] == 1 && $seq_id != $row2[seq_id]))
                return true;
            else
                return false;
        }
    }
    
    public function GetOutcomeObjectives($outcomeId) {
        $conn = new MysqlConnect();
        $stmt = "SELECT pc.seq_id, pc.outcome_title, pc.project_id, po.seq_id as objective_id ,po.obj_title
                FROM project_outcome pc INNER JOIN project_objectivies po ON pc.seq_id = po.outcome_id 
                 WHERE pc.seq_id =" . $outcomeId .
                " ORDER BY pc.seq_id , po.seq_id";
        
        
        $rs = $conn->ExecuteNonQuery($stmt);
        return $rs;
    }

    public function GetAllOutcomeObjectives($projectId) {
        $conn = new MysqlConnect();
        $stmt = "SELECT pc.seq_id, pc.outcome_title, pc.project_id, po.seq_id as objective_id ,po.obj_title,po.outcome_id
                FROM project_outcome pc INNER JOIN project_objectivies po ON pc.seq_id = po.outcome_id 
                 WHERE pc.project_id =" . $projectId .
                " ORDER BY pc.seq_id , po.seq_id";
        
        $rs = $conn->ExecuteNonQuery($stmt);
        return $rs;
    }
  
     public function hasReleatedData($id) {
        $conn = new MysqlConnect();
        $stmt = "SELECT outcome_id FROM goals_outcomes WHERE outcome_id=" . $id . " LIMIT 1";
        $result = $conn->ExecuteNonQuery($stmt);
        if (mysql_num_rows($result) > 0)
            return true;
        else
            return false;
    }
    
    public function ProjectHasOutcomes($project_id) {
        $conn = new MysqlConnect();
        $stmt = "SELECT seq_id FROM project_outcome WHERE project_id=" . $project_id . " LIMIT 1";
        $rs = $conn->ExecuteNonQuery($stmt);

        return $rs;
    }
    
     public function GetEmptyOutcomes($project_id) {
        $conn = new MysqlConnect();
        $stmt = "SELECT project_outcome.seq_id, project_outcome.outcome_title, project_outcome.project_id, goals_outcomes.seq_id
                 FROM dsr_rms.project_outcome project_outcome
                 LEFT OUTER JOIN dsr_rms.goals_outcomes goals_outcomes ON ( project_outcome.seq_id = goals_outcomes.outcome_id )
                 WHERE (
                    (project_outcome.project_id = ". $project_id . ")
                 AND 
                    (goals_outcomes.seq_id IS NULL)
                 )
                 ORDER BY project_outcome.seq_id ASC";
        
        //echo $stmt;
        $rs = $conn->ExecuteNonQuery($stmt);

        return $rs;
    }

    public function GetEmptyObjectives($project_id) {
        $conn = new MysqlConnect();
        $stmt = "SELECT goals_outcomes.seq_id, project_objectivies.obj_title, project_objectivies.project_id, project_objectivies.seq_id
                 FROM dsr_rms.project_objectivies project_objectivies
                 LEFT OUTER JOIN dsr_rms.goals_outcomes goals_outcomes ON ( project_objectivies.seq_id = goals_outcomes.obj_id )
                 WHERE (
                        (goals_outcomes.seq_id IS NULL)
                 AND 
                        (project_objectivies.project_id =" . $project_id . " )
                  )
                 ORDER BY project_objectivies.seq_id ASC";

        $rs = $conn->ExecuteNonQuery($stmt);

        return $rs;
    }
    
     public function GetProjectOutcomes($project_id) {
        $conn = new MysqlConnect();
        $stmt = "SELECT *
                 FROM project_outcome
                 WHERE project_id =" . $project_id .
                 " ORDER BY seq_id ASC";

        $rs = $conn->ExecuteNonQuery($stmt);

        return $rs;
    }
}

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

class GoalsOutcomes {

    public function __construct() {
        $connection = new MysqlConnect();
    }

    public function Save($seqId, $goalId, $outcomeId, $obj_id) {
        $conn = new MysqlConnect();

        if ($seqId == 0) {
            $stmt = "insert into goals_outcomes (goal_id ,outcome_id,obj_id) values (" . $goalId . "," . $outcomeId . "," . $obj_id . ")";
            //echo $stmt;
            $result = $conn->ExecuteNonQuery($stmt);
            return $result;
        }
        else
            return FALSE;
        /* $conn->ExecuteNonQuery($stmt);
          return mysql_insert_id(); */
    }

    public function Delete($seqId) {
        $conn = new MysqlConnect();
        $stmt = "Delete from goals_outcomes where seq_id =" . $seqId;

        $result = $conn->ExecuteNonQuery($stmt);
        return $result;
    }

    public function isExist($project_id, $seq_id, $title) {
        $conn = new MysqlConnect();
        $stmt = "SELECT count(seq_id) as obj_count FROM goals_outcomes WHERE outcome_title='" . $title .
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

    public function GetOutcomeObjectivesGoals($outcomeId) {
        $conn = new MysqlConnect();
        $stmt = "SELECT pc.seq_id as outcome_id, pc.outcome_title, pc.project_id, po.seq_id as objective_id ,po.obj_title, pg.seq_id as goal_id, pg.goal_title
                FROM project_outcome pc INNER JOIN goals_outcomes go  ON pc.seq_id = go.outcome_id 
                INNER JOIN project_objectivies po ON po.seq_id = go.obj_id 
                INNER JOIN program_goals pg ON pg.seq_id = go.goal_id 
                 WHERE pc.seq_id =" . $outcomeId .
                " ORDER BY pc.seq_id , po.seq_id";


        $rs = $conn->ExecuteNonQuery($stmt);
        return $rs;
    }

    public function GetAllOutcomesObjectivesGoals($projectId) {
        $conn = new MysqlConnect();
        $stmt = "SELECT pc.seq_id as outcome_id, pc.outcome_title, pc.project_id, po.seq_id as objective_id ,po.obj_title, pg.seq_id as goal_id, pg.goal_title
                FROM project_outcome pc INNER JOIN goals_outcomes go  ON pc.seq_id = go.outcome_id 
                INNER JOIN project_objectivies po ON po.seq_id = go.obj_id 
                INNER JOIN program_goals pg ON pg.seq_id = go.goal_id 
                 WHERE pc.project_id =" . $projectId .
                " ORDER BY pc.seq_id , po.seq_id";

        $rs = $conn->ExecuteNonQuery($stmt);
        return $rs;
    }

    public function GetOutcomeGoalObjective($outcome_id,$goal_id,$obj_Id) {
        $conn = new MysqlConnect();
        $stmt = "select seq_id FROM goals_outcomes WHERE outcome_id =" . $outcome_id . " AND goal_id = " . $goal_id . " AND obj_id = " . $obj_Id .
                " LIMIT 1";
        //echo $stmt;
        $rs = $conn->ExecuteNonQuery($stmt);
        $row = mysql_fetch_array($rs);
        return $row[seq_id];
        
        
    }
    
    public function GetOutcomeObjectives($outcome_id) {
        $conn = new MysqlConnect();
        $stmt = "SELECT DISTINCT project_objectivies.seq_id, project_objectivies.obj_title
                FROM dsr_rms.project_objectivies project_objectivies
                INNER JOIN dsr_rms.goals_outcomes goals_outcomes ON ( project_objectivies.seq_id = goals_outcomes.obj_id )
                WHERE (goals_outcomes.outcome_id =". $outcome_id. ")
                ORDER BY project_objectivies.seq_id ASC";
        //echo $stmt;
        $rs = $conn->ExecuteNonQuery($stmt);
        return $rs;
        
        
    }
    
    public function GetOutcomeObjectivesAllGoals($outcome_id,$objective_id) {
        $conn = new MysqlConnect();
        $stmt = "SELECT goals_outcomes.outcome_id, goals_outcomes.goal_id, goals_outcomes.obj_id
                 FROM dsr_rms.goals_outcomes goals_outcomes
                 WHERE 
                    (goals_outcomes.outcome_id =". $outcome_id. ")
                 AND 
                    (goals_outcomes.obj_id =". $objective_id. ")
                ORDER BY goals_outcomes.goal_id ASC";
                
        //echo $stmt;
        $rs = $conn->ExecuteNonQuery($stmt);
        return $rs;
        
        
    }
    public function GetprojectProgram($project_id) {
        $conn = new MysqlConnect();
        $stmt = "select program FROM researches WHERE seq_id =" . $project_id . " LIMIT 1";
        //echo $stmt;
        $rs = $conn->ExecuteNonQuery($stmt);
        $row = mysql_fetch_array($rs);
        return $row[program];
    }
    
}

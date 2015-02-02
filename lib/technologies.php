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

class Technologies {

    private $tableName = 'technologies';

    public function __construct() {
        $connection = new MysqlConnect();
    }

    public function Save($seq_id, $title, $desc, $isVisible, $ordering) {
        $conn = new MysqlConnect();
        if ($seq_id == null || $seq_id == 0) {
            $stmt = "insert into " . $this->tableName . " (title,`desc`,isVisible,ordering) values ('" . $title . "','" . $desc . "'," . $isVisible . "," . $ordering . ")";
            //echo $stmt . '<br/>';
            $conn->ExecuteNonQuery($stmt);
            return mysql_insert_id();
        } else {
            $stmt = "Update " . $this->tableName . " Set title='" . $title . "',`desc`='" . $desc . "',isVisible=" . $isVisible . ",ordering=" . $ordering . " where seq_id=" . $seq_id;
            echo $stmt . '<br/>';
            $conn->ExecuteNonQuery($stmt);
            return mysql_affected_rows();
        }
    }

    public function GetVisibileTechnologies() {
        $conn = new MysqlConnect();
        $stmt = "SELECT title,`desc` FROM  technologies where isVisible=1 order by ordering";
        $rs = $conn->ExecuteNonQuery($stmt);
        return $rs;
    }

    public function GetAllTechnologies() {
        $conn = new MysqlConnect();
        $stmt = "SELECT title,`desc`,isVisible,ordering FROM technologies order by ordering";
        $rs = $conn->ExecuteNonQuery($stmt);
        return $rs;
    }

    public function Delete($seqId) {
        $conn = new MysqlConnect();
        $stmt = "Delete from " . $this->tableName . " where seq_id =" . $seqId;
        $conn->ExecuteNonQuery($stmt);
    }

}

//$t = new Technologies();
//echo $t->Save(1, 'update test', 'updatae test', 1437, true, 2);

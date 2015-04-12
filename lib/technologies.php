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

class Technologies
{

    private $tableName = 'technologies';

    public function __construct()
    {
        $connection = new MysqlConnect();
    }

    public function Save($seq_id, $title, $desc, $isVisible)
    {
        $conn = new MysqlConnect();
        if ($seq_id == 0) {
            $stmt = "insert into " . $this->tableName . " (title,tech_desc,isVisible) values ('" . $title . "','" . $desc . "'," . $isVisible . ")";

            $conn->ExecuteNonQuery($stmt);
            return mysql_insert_id();
        } else {
            $stmt = "Update " . $this->tableName . " Set title='" . $title . "',tech_desc='" . $desc . "',isVisible=" . $isVisible . " where seq_id=" . $seq_id;

            $conn->ExecuteNonQuery($stmt);
            return mysql_affected_rows();
        }
    }

    public function GetVisibileTechnologies()
    {
        $conn = new MysqlConnect();
        $stmt = "SELECT title,tech_desc FROM  technologies where isVisible=1";
        $rs = $conn->ExecuteNonQuery($stmt);
        return $rs;
    }

    public function GetAllTechnologies()
    {
        $conn = new MysqlConnect();
        $stmt = "SELECT seq_id,title,tech_desc,isVisible FROM technologies";
        $rs = $conn->ExecuteNonQuery($stmt);
        return $rs;
    }

    public function Delete($seqId)
    {
        $conn = new MysqlConnect();
        $stmt = "Delete from " . $this->tableName . " where seq_id =" . $seqId;
        echo $stmt;
        $conn->ExecuteNonQuery($stmt);
    }

    public function GetTechnologies($seq_id)
    {
        $conn = new MysqlConnect();
        $stmt = "SELECT seq_id,title,tech_desc,isVisible,tech_code,lang_code FROM " . $this->tableName . " where seq_id=" . $seq_id;

        $rs = $conn->ExecuteNonQuery($stmt);
        return $rs;
    }

    public function GetPairValues()
    {
        $conn = new MysqlConnect();
        $stmt = "SELECT seq_id,title FROM " . $this->tableName;
        $rs = $conn->ExecuteNonQuery($stmt);
        $result = Array("PairValues" => Array());
        while ($row = mysql_fetch_array($rs)) {
            array_push($result['PairValues'], Array($row['seq_id'], $row['title']));
        }
        return $result;
    }

    public function GetTechCode($tech_id)
    {
        $conn = new MysqlConnect();
        $stmt = "SELECT tech_code FROM " . $this->tableName . " where seq_id=" . $tech_id;
        $rs = $conn->ExecuteNonQuery($stmt);
        $code = null;
        while ($row = mysql_fetch_array($rs)) {
            $code = $row['tech_code'];
        }
        return $rs;
    }

}

//$t = new Technologies();
//echo $t->Save(1, 'update test', 'updatae test', 1437, true, 2);

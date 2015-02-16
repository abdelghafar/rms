<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of budget_items
 *
 * @author ahmed
 */
require_once 'mysqlConnection.php';

class budget_items {

    private $tableName = 'tracks';

    public function __construct() {
        
    }

    public function Save($item_id, $item_title, $item_alias, $isSys) {
        $conn = new MysqlConnect();
        if ($item_id == 0) {
            $stmt = "insert into " . $this->tableName . " (item_title,item_alias,isSys) values ('" . $item_title . "','" . $item_alias . "'," . $isSys . ")";

            echo $stmt . '<br/>';
            $conn->ExecuteNonQuery($stmt);
            return mysql_insert_id();
        } else {
            $stmt = "Update " . $this->tableName . " Set item_title='" . $item_title . "', item_alias='" . $item_alias . "',isSys=" . $isSys . " where item_id=" . $item_id;
            echo $stmt;
            $conn->ExecuteNonQuery($stmt);
            return mysql_affected_rows();
        }
    }

}

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
        return $conn->ExecuteNonQuery($stmt);
    }

    public function DeleteStuff($ResearchId, $PersonId) {
        $conn = new MysqlConnect();
        $stmt = "Delete From " . $this->table_name . " where research_id=" . $ResearchId . " and person_id=" . $PersonId;
        echo $stmt;
        $conn->ExecuteNonQuery($stmt);
    }

}

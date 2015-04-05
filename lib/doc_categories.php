<?php

require_once 'mysqlConnection.php';

class Document_categories {

    public function __construct() {
        $connection = new MysqlConnect();
        ;
    }

    public function isExsit($cat_name) {
        $stmt = "SELECT seq_id from doc_categories where cat_name ='" . $cat_name . "'";
        $conn = new MysqlConnect();
        $seq_id = 0;

        $result = $conn->ExecuteNonQuery($stmt);
        while ($row = mysql_fetch_array($result)) {
            $seq_id = $row['seq_id'];
        }
        return $seq_id;
    }

    public function Save($seqId, $cat_name, $notes) {
        if ($seqId == 0) {
            $stmt = "INSERT INTO doc_categories (cat_name,notes) Values ('" . $cat_name . "','" . $notes . "')";
            $conn = new MysqlConnect();
            $rs = $this->isExsit($cat_name);
            if ($rs == 0) {
                $result = $conn->ExecuteNonQuery($stmt);
                return $result;
            } else {
                return $rs;
            }
        } else {
            $stmt = "UPDATE doc_categories set cat_name='" . $cat_name . "' , notes ='" . $notes . "' Where seq_id=" . $seqId;
            $conn = new MysqlConnect();
            $result = $conn->ExecuteNonQuery($stmt);
            return $result;
        }
    }

    public function GetList() {
        $stmt = "SELECT seq_id , cat_name,notes From doc_categories";
        $conn = new MysqlConnect();
        $result = $conn->ExecuteNonQuery($stmt);
        return $result;
    }

    public function Delete($seqId) {
        $stmt = "delete from doc_categories where seq_id=" . $seqId;
        $conn = new MysqlConnect();
        echo $stmt;
        $result = $conn->ExecuteNonQuery($stmt);
        return $result;
    }

    public function GetBySeqId($seqId) {
        $stmt = "SELECT cat_name,notes From doc_categories Where seq_id=" . $seqId;
        $conn = new MysqlConnect();
        $result = $conn->ExecuteNonQuery($stmt);
        return $result;
    }

}

?>

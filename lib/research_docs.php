<?php

require_once 'mysqlConnection.php';

class Research_Documents {

    public function __construct() {
        $connection = new MysqlConnect();
    }

    public function Save($seqId, $title, $research_id, $doc_cat_id, $doc_url, $size, $hash, $notes) {
        if ($seqId == 0) {
            $stmt = "INSERT INTO research_docs (research_id,doc_cat_id,doc_url,size,hash,notes,title) Values (" . $research_id . "," . $doc_cat_id . ",'" . $doc_url . "'," . $size . ",'" . $hash . "','" . $notes . "','" . $title . "')";
            $conn = new MysqlConnect();
            $result = $conn->ExecuteNonQuery($stmt);
            return $result;
        }
    }

    public function GetResearchListDocuments($research_id) {
        $stmt = "SELECT research_docs.seq_id, research_docs.doc_cat_id,research_docs.title research_docs.doc_url,research_docs.size,research_docs.hash,research_docs.notes, researches.research_code, doc_categories.cat_name FROM research_docs JOIN researches ON research_docs.research_id = researches.seq_id JOIN doc_categories ON doc_categories.seq_id = research_docs.doc_cat_id where research_docs.research_id=" . $research_id;
        $conn = new MysqlConnect();
        $result = $conn->ExecuteNonQuery($stmt);
        return $result;
    }

    public function GetAllDocuments() {
        $stmt = "SELECT research_docs.seq_id, research_docs.doc_cat_id, research_docs.doc_url,research_docs.size, research_docs.notes, researches.research_code,research_docs.hash, doc_categories.cat_name FROM research_docs JOIN researches ON research_docs.research_id = researches.seq_id JOIN doc_categories ON doc_categories.seq_id = research_docs.doc_cat_id";
        $conn = new MysqlConnect();
        $result = $conn->ExecuteNonQuery($stmt);
        return $result;
    }

    public function Delete($seqId) {
        $stmt = "delete from research_docs where seq_id=" . $seqId;
        $conn = new MysqlConnect();
        $result = $conn->ExecuteNonQuery($stmt);
        return $result;
    }

}

?>

<?php

/**
 * Description of attachmentCatController
 *
 * @author ahmed
 */
require_once filter_input(INPUT_SERVER, DOCUMENT_ROOT) . DIRECTORY_SEPARATOR . 'rms' . DIRECTORY_SEPARATOR . 'lib' . DIRECTORY_SEPARATOR . 'config.php';
require_once filter_input(INPUT_SERVER, DOCUMENT_ROOT) . DIRECTORY_SEPARATOR . 'rms' . DIRECTORY_SEPARATOR . 'lib' . DIRECTORY_SEPARATOR . 'base' . DIRECTORY_SEPARATOR . 'connection.php';
require_once filter_input(INPUT_SERVER, DOCUMENT_ROOT) . DIRECTORY_SEPARATOR . 'rms' . DIRECTORY_SEPARATOR . 'lib' . DIRECTORY_SEPARATOR . 'model' . DIRECTORY_SEPARATOR . 'attachment_cat.php';

class attachmentCatController {

    static $TBL_NAME = 'attachment_cat';
    static $PK = 'seq_id';

    public static function Save(attachment_cat $p) {
        $conn = connection::Connect();
        if ($p->getSeq_id() == NULL) {
            $sql = "INSERT INTO " . self::$TBL_NAME . " (Cat_name,Notes) Values (?,?)";
            $stmt = $conn->prepare($sql);
            if ($stmt === false) {
                trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
            }
            $stmt->bind_param('ss', $p->getCat_name(), $p->getNotes());
            $stmt->execute();
            return array('affected_rows' => $conn->affected_rows, 'insert_id' => $conn->insert_id);
        } else {
            echo "Update is called...";
            $sql = "update" . " " . self::$TBL_NAME . " " . "set `Cat_name` = ? , `Notes` = ? where seq_id=?";
            $stmt = $conn->prepare($sql);
            if ($stmt === false) {
                trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
            }
            $stmt->bind_param('ssi', $p->getCat_name(), $p->getNotes(), $p->getSeq_id());
            $stmt->execute();
            return array('affected_rows' => $conn->affected_rows);
        }
    }
    
    public function GetAll() {
        $conn = connection::Connect();
        $sql = "SELECT seq_id,Cat_name,Notes FROM " . self::$TBL_NAME;
        $rs = $conn->query($sql);
        $array = array();
        while ($row = mysqli_fetch_array($rs)) {
            $obj = attachment_cat::createObject();
            $obj->setSeq_id($row['seq_id']);
            $obj->setCat_name($row['Cat_name']);
            $obj->setNotes($row['Notes']);
            $array[] = $obj;
        }
        return $array;
    }

}

<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 29/04/15
 * Time: 01:27 م
 */
require_once 'mysqlConnection.php';

class countries {

    public function GetAll_Json()
    {
        $conn = new MysqlConnect();
        $stmt = "SELECT * FROM  `countries` order by title_ar ASC ";
        $rs = $conn->ExecuteNonQuery($stmt);
        $list = array();
        while($row = mysql_fetch_array($rs)){
            $list[] = array('seq_id'=>$row['seq_id'],'title_ar'=>$row['title_ar']);
        }
        echo json_encode($list);
    }
}
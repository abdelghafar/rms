<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 29/04/15
 * Time: 01:27 م
 */
require_once 'mysqlConnection.php';

class countries {

    static  $table_name = 'countries';

    public static function GetAll_Json()
    {
        $conn = new MysqlConnect();
        $stmt = "SELECT * FROM  `countries` order by title_ar ORDER BY  `countries`.`title_ar` ASC ";
        $rs = $conn->ExecuteNonQuery($stmt);
        while($row = mysql_fetch_array($rs)){
            $rs = array('seq_id'=>$row['seq_id'],'title_ar'=>$row['title_ar']);
        }
        echo $rs;
    }

}

countries::GetAll_Json();
<?php

require_once 'mysqlConnection.php';

class Messaging {

    public function __construct() {
        $connection = new MysqlConnect();
    }

    public function SendMessage($title, $content, $url, $src, $dest, $submit_date, $isRead, $research_id) {
        $submit_date = date(DateTime_Format);
        $stmt = "insert into messaging (title,content,url,src,dest,submit_date,`isRead`,research_id) values ('$title','$content','$url',$src,$dest,'$submit_date',$isRead,$research_id)";
        $conn = new MysqlConnect();
        $rs = $conn->ExecuteNonQuery($stmt);
        return $rs;
    }

    public function GetInbox($userId) {
        $stmt = "select msg_id, title,submit_date from messaging where dest =$userId";
        $conn = new MysqlConnect();
        $rs = $conn->ExecuteNonQuery($stmt);
        return $rs;
    }

    public function GetSentMessages($userId) {
        $stmt = "select msg_id, title,submit_date from messaging where src =$userId";
        $conn = new MysqlConnect();
        $rs = $conn->ExecuteNonQuery($stmt);
        return $rs;
    }

    public function MarkAsRead($MsgId) {
        $read_date = date(DateTime_Format);
        $stmt = "update messaging set `isRead`=1 , `read_date`='$read_date' where `msg_id`=$MsgId ";
        $conn = new MysqlConnect();
        $rs = $conn->ExecuteNonQuery($stmt);
        return $rs;
    }

}

?>

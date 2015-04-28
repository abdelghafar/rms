<?php

require_once 'mysqlConnection.php';

class Research_Update_Request
{

    public function __construct()
    {
        $connection = new MysqlConnect();
    }

    public function Save($seq_id, $research_id, $title, $msg, $url, $request_date)
    {
        if ($seq_id == 0) {
            $stmt = "insert into research_update_request (research_id,title,msg,url,request_date) values ($research_id,'$title','$msg','$url','$request_date')";
            $conn = new MysqlConnect();
            $res = $conn->ExecuteNonQuery($stmt);
            return $res;
        } else {
            $stmt = "update research_update_request set research_id=$research_id ,title='$title' , msg='$msg' , url='$url' , request_date='$request_date' where seq_id = $seq_id";
            $conn = new MysqlConnect();
            $res = $conn->ExecuteNonQuery($stmt);
            return $res;
        }
    }

    public function Delete($seq_id)
    {
        $stmt = "Delete From research_update_request where seq_id=$seq_id";
        $conn = new MysqlConnect();
        $res = $conn->ExecuteNonQuery($stmt);
        return $res;
    }

}

?>

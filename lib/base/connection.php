<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of connection
 *
 * @author ahmed
 */
require_once filter_input(INPUT_SERVER, DOCUMENT_ROOT) . DIRECTORY_SEPARATOR . 'rms' . DIRECTORY_SEPARATOR . 'lib' . DIRECTORY_SEPARATOR . 'config.php';

class connection {

    public static function Connect() {
        $conn = new mysqli(Db_host, Db_User, User_PWD, Db_Name);
        $conn->set_charset('utf8');
        return $conn;
    }

}

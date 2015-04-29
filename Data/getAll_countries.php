<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 29/04/15
 * Time: 09:59 م
 */
require_once '../lib/countries.php';
$obj = new countries();
$obj->GetAll_Json();
<?php
session_start();
require_once '../lib/countries.php';
$obj = new countries();
$obj->GetAll_Json();
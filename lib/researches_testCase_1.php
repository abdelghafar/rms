<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 27/04/15
 * Time: 12:51 م
 */

require_once 'Reseaches.php';

$r = new Reseaches();
$e = $r->GenerateResearchCode(5);
echo $e;

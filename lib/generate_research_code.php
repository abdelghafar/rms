<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 12/04/15
 * Time: 12:04 م
 */

require_once 'Reseaches.php';

$r = new Reseaches();
$code = $r->GenerateResearchCode(7);
$r->UpdateResearchCode(7, $code);



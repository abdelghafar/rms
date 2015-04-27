<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 09/04/15
 * Time: 11:43 ص
 */
require_once 'get_uqu_instructors.php';
require_once '../lib/persons.php';
$u = get_uqu_instructors(4330113);
print_r($u);
$p = new Persons();
echo $p->ImportPerson($u);
$emp_code = $p->findByEmployeeCode(4330113);
if ($emp_code == 0) {
    //emp not exists;
    echo '<br/>'.'emp not exists'.'<br/>';
    echo $p->ImportPerson($u);
} else {
    //emp exists
    echo '<br/><br/>'.'emp exists:'.$emp_code;
}